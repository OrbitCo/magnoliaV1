<?php

declare(strict_types=1);

namespace Pg\modules\spam\models;

define("SPAM_TYPES_TABLE", DB_PREFIX . "spam_types");

/**
 * Spam type Model
 *
 * @package PG_RealEstate
 * @subpackage Spam
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class SpamTypeModel extends \Model
{
    /**
     * Table fields
     *
     * @var array
     */
    public $fields = [
        "id",
        "gid",
        "form_type",
        "send_mail",
        "status",
        "module",
        "model",
        "callback",
        "obj_count",
        "obj_need_approve",
    ];

    /**
     * Format settings
     *
     * @var array
     */
    private $format_settings = [
        "use_format"    => true,
        "get_form_type" => true,
    ];

    /**
     * Types cache
     *
     * @var array
     */
    private $type_cache = [];

    /**
     * Deactivated settings
     *
     * @var array
     */
    private $settings = ["send_alert_to_email"];

    /**
     * Get type by ID/GID
     *
     * @param integer $type_id
     *
     * @return mixed
     */
    public function getTypeById($type_id)
    {
        $field = "id";
        if (!intval($type_id)) {
            $field = "gid";
            $type_id = preg_replace("/[^a-z_]/", "", strtolower($type_id));
        }
        if (!$type_id) {
            return false;
        }

        if (isset($this->type_cache[$type_id])) {
            return $this->type_cache[$type_id];
        }

        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(SPAM_TYPES_TABLE);
        $this->ci->db->where($field, $type_id);

        //_compile_select;
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            $rt = get_object_vars($result[0]);
            $this->type_cache[$rt['id']] = $this->type_cache[$rt['gid']] = $rt;

            return $rt;
        } else {
            return false;
        }
    }

    /**
     * Save type
     *
     * @param array $data
     *
     * @return boolean
     */
    public function saveType($id, $data)
    {
        if (!$id) {
            if (!isset($data["gid"]) || !$data["gid"]) {
                return false;
            }

            $data["gid"] = preg_replace("/[^a-z_]/", "", strtolower($data["gid"]));

            $type = $this->get_type_by_id($data["gid"]);
            if ($type) {
                return $type["id"];
            }

            $this->ci->db->insert(SPAM_TYPES_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $fields = array_flip($this->fields);
            foreach ($data as $key => $value) {
                if (!isset($fields[$key])) {
                    unset($data[$key]);
                }
            }

            if (empty($data)) {
                return false;
            }

            $this->ci->db->where("id", $id);
            $this->ci->db->update(SPAM_TYPES_TABLE, $data);
        }

        return $id;
    }

    /**
     * Remove type by ID or GID
     *
     * @param mixed $type_id integer ID / string GID
     */
    public function deleteType($type_id)
    {
        $type = $this->get_type_by_id($type_id);
        $this->ci->db->where("id", $type["type_id"]);
        $this->ci->db->delete(SPAM_TYPES_TABLE);

        return;
    }

    /**
     * Return all types as array
     *
     * @param boolean $status
     * @param array   $filter_object_ids
     * @param boolean $formatted
     *
     * @return array
     */
    public function getTypes($status = false, $filter_object_ids = null, $formatted = true)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(SPAM_TYPES_TABLE);

        if ($status) {
            $this->ci->db->where("status", "1");
        }

        if (is_array($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $this->type_cache[$r['id']] = $this->type_cache[$r['gid']] = $data[$r['id']] = $r;
            }
            if ($formatted) {
                return $this->format_type($data);
            } else {
                return $data;
            }
        }

        return [];
    }

    /**
     * Validate deactivate settings
     *
     * @param array $data
     *
     * @return array
     */
    public function validateSettings($data)
    {
        $return = ["errors" => [], "data" => []];

        foreach ($this->settings as $field) {
            if (isset($data[$field])) {
                $return["data"][$field] = $data[$field];
            }
        }

        if (isset($return["data"]["send_alert_to_email"]) && !empty($return["data"]["send_alert_to_email"])) {
            $return["data"]["send_alert_to_email"] = strip_tags($return["data"]["send_alert_to_email"]);
            if (!filter_var($return["data"]["send_alert_to_email"], FILTER_VALIDATE_EMAIL)) {
                $return["errors"][] = l("error_email_incorrect", "spam");
            }
        } else {
            $return["errors"][] = l("error_email_incorrect", "spam");
        }

        return $return;
    }

    /**
     * Validate type
     *
     * @param int   $id
     * @param array $data
     *
     * @return array
     */
    public function validateType($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        foreach ($this->fields as $field) {
            if (isset($data[$field])) {
                $return["data"][$field] = $data[$field];
            }
        }

        if (isset($data["id"])) {
            $return['data']['id'] = intval($data['id']);
        }

        if (isset($data["gid"])) {
            $return["data"]["gid"] = trim(strip_tags($data['gid']));
            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l("error_empty_type_gid", "spam");
            }
        } elseif (!$id) {
            $return["errors"][] = l("error_empty_type_gid", "spam");
        }

        if (isset($data["form_type"])) {
            $return["data"]["form_type"] = trim(strip_tags($data['form_type']));
            if (empty($return["data"]["form_type"])) {
                $return["errors"][] = l("error_empty_type_form_type", "spam");
            }
        } elseif (!$id) {
            $return["errors"][] = l("error_empty_type_form_type", "spam");
        }

        if (isset($data["status"])) {
            $return["data"]["status"] = $data["status"] ? 1 : 0;
        }

        if (isset($data["send_mail"])) {
            $return["data"]["send_mail"] = $data["send_mail"] ? 1 : 0;
        }

        if (isset($data["module"])) {
            $return["data"]["send_mail"] = trim(strip_tags($data["module"]));
        }

        if (isset($data["model"])) {
            $return["data"]["model"] = trim(strip_tags($data["model"]));
        }

        if (isset($data["callback"])) {
            $return["data"]["callback"] = trim(strip_tags($data["callback"]));
        }

        if (isset($data["obj_count"])) {
            $return["data"]["obj_count"] = intval($data["obj_count"]);
        }

        if (isset($data["obj_need_approve"])) {
            $return["data"]["obj_need_approve"] = intval($data["obj_need_approve"]);
        }

        return $return;
    }

    /**
     * Format type
     *
     * @param array $data
     *
     * @return array
     */
    public function formatType($data)
    {
        if (!$this->format_settings["use_format"]) {
            return $data;
        }

        if ($this->format_settings["get_form_type"]) {
            $form_types = ld("form_type", "spam");
            foreach ($data as $key => $type) {
                $data[$key] = $type;
                $data[$key]["form"] = isset($form_types["option"][$type["form_type"]]) ? $form_types["option"][$type["form_type"]] : "-";
            }
        }

        foreach ($data as $key => $type) {
            $data[$key]["output_name"] = $data[$key]["gid"];
        }

        return $data;
    }

    /**
     * Format type
     *
     * @param int $type_id
     *
     * @return array
     */
    public function formatDefaultType($type_id)
    {
        $return = [];
        foreach ($this->fields as $field) {
            $return[$field] = "-";
        }
        $return["output_name"] = "-";

        return $return;
    }

    /**
     * Import spam type languages
     *
     * @param array $data
     * @param array $langs_file
     * @param array $langs_ids
     */
    public function updateLangs($data, $langs_file, $langs_ids)
    {
        foreach ((array) $data as $type_data) {
            $this->ci->pg_language->pages->set_string_langs(
                "spam",
                "stat_header_spam_" . $type_data["gid"],
                $langs_file["stat_header_spam_" . $type_data["gid"]],
                $langs_ids);
            $this->ci->pg_language->pages->set_string_langs(
                "spam",
                "error_is_send_" . $type_data["gid"],
                $langs_file["error_is_send_" . $type_data["gid"]],
                $langs_ids);
            $this->ci->pg_language->pages->set_string_langs(
                "spam",
                "error_is_deleted_" . $type_data["gid"],
                $langs_file["error_is_deleted_" . $type_data["gid"]],
                $langs_ids);
        }
    }

    /**
     * Export spam type languages
     *
     * @param array $data
     * @param array $langs_ids
     */
    public function exportLangs($data, $langs_ids = null)
    {
        $gids = [];
        $langs = [];
        foreach ($data as $type_data) {
            $gids[] = "stat_header_spam_" . $type_data["gid"];
        }

        return array_merge($langs, $this->ci->pg_language->export_langs("spam", $gids, $langs_ids));
    }

    /**
     * Activate type
     *
     * @param integer $type_id identifier
     * @param integer $status  lisitng status
     */
    public function activateType($type_id, $status = 1)
    {
        $data["status"] = intval($status);
        $this->save_type($type_id, $data);
    }

    /**
     * Send mail type on/off
     *
     * @param integer $type_id identifier
     * @param integer $status  lisitng status
     */
    public function sendMailType($type_id, $status = 1)
    {
        $data["send_mail"] = intval($status);
        $this->save_type($type_id, $data);
    }

    public function __call($name, $args)
    {
        $methods = [
            'activate_type' => 'activateType',
            'delete_type' => 'deleteType',
            'export_langs' => 'exportLangs',
            'format_default_type' => 'formatDefaultType',
            'format_type' => 'formatType',
            'get_type_by_id' => 'getTypeById',
            'get_types' => 'getTypes',
            'save_type' => 'saveType',
            'send_mail_type' => 'sendMailType',
            'update_langs' => 'updateLangs',
            'validate_settings' => 'validateSettings',
            'validate_type' => 'validateType',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
