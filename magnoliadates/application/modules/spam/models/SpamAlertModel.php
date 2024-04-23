<?php

declare(strict_types=1);

namespace Pg\modules\spam\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\spam\models\events\EventSpam;

define("SPAM_ALERTS_TABLE", DB_PREFIX . "spam_alerts");

/**
 * Spam alert Model
 *
 * @package PG_RealEstate
 * @subpackage Spam
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class SpamAlertModel extends \Model
{
    /**
     * Table fields
     *
     * @var array
     */
    public $fields = [
        "id",
        "id_type",
        "id_object",
        "id_poster",
        "id_reason",
        "message",
        "mark",
        "date_add",
        "spam_status",
    ];

    /**
     * Format settings
     *
     * @var array
     */
    private $format_settings = [
        "use_format"     => true,
        "get_poster"     => true,
        "get_type"       => true,
        "get_content"    => true,
        "get_link"       => false,
        "get_object"     => false,
        "get_reason"     => false,
        "get_deletelink" => false,
        "get_subpost"    => false,
    ];

    /**
     * Moderation type
     *
     * @var string
     */
    private $moderation_type = "spam";

    /**
     * Cache array for used types
     *
     * @var array
     */
    private $spam_types = [];

    /**
     * Possible alert status
     *
     * @var array
     */
    private $spam_status_arr = ["banned", "unbanned", "removed"];

    /**
     * Constructor
     *
     * return Spam alert object
     * required Spam_type_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model("spam/models/Spam_type_model");
    }

    /**
     * Get spam type by GID
     *
     * @param string $type_gid
     *
     * @return array
     */
    public function getTypeByGid($type_gid)
    {
        if (!isset($this->types[$type_gid])) {
            $type_data = $this->ci->Spam_type_model->get_type_by_id($type_gid);
            if (!is_array($type_data) || !count($type_data)) {
                return false;
            }
            $this->spam_types[$type_data["id"]] = $type_data;
            $this->spam_types[$type_gid] = $type_data;
        }

        if (is_array($this->spam_types[$type_gid]) && count($this->spam_types[$type_gid])) {
            return $this->spam_types[$type_gid];
        } else {
            return false;
        }
    }

    /**
     * Get spam alert by ID
     *
     * @param integer $id spam alert ID
     * @param
     */
    public function getAlertById($id, $formatted = false)
    {
        $id = intval($id);

        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(SPAM_ALERTS_TABLE);
        $this->ci->db->where("id", $id);

        //_compile_select;
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            $rt = get_object_vars($result[0]);
            if ($formatted) {
                $rt = $this->format_alert([$rt]);
                return $rt[0];
            } else {
                return $rt;
            }
        } else {
            return false;
        }
    }

    /**
     * Save alert
     *
     * @param array $data
     *
     * @return boolean
     */
    public function saveAlert($id, $data)
    {
        $is_new = !$id;

        if (!$id) {
            $data["date_add"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(SPAM_ALERTS_TABLE, $data);
            $id = $this->ci->db->insert_id();

            $type = $this->Spam_type_model->get_type_by_id($data['id_type']);
            $save_data['obj_count'] = $type["obj_count"] + 1;
            $save_data['obj_need_approve'] = $type["obj_need_approve"] + 1;
            $this->ci->Spam_type_model->save_type($type['id'], $save_data);
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
            $this->ci->db->update(SPAM_ALERTS_TABLE, $data);
        }

        if ($is_new) {
            $event_status = SpamModel::STATUS_ALERT_ADDED;
        } else {
            $event_status = SpamModel::STATUS_ALERT_SAVED;
        }

        $this->sendEvent(SpamModel::EVENT_ALERT_CHANGED, [
            'id' => $id,
            'type' => SpamModel::TYPE_SPAM_ALERT,
            'status' => $event_status,
        ]);

        return $id;
    }

    protected function sendEvent($event_gid, $event_data)
    {
        $event_data['module'] = SpamModel::MODULE_GID;
        $event_data['action'] = $event_gid;

        $event = new EventSpam();
        $event->setData($event_data);

        $event_handler = EventDispatcher::getInstance();
        $event_handler->dispatch($event, $event_gid);
    }

    /**
     * Remove alert by ID
     *
     * @param integer $id            alert ID
     * @param boolean $remove_object
     */
    public function deleteAlert($id, $remove_object = false)
    {
        $alert = $this->get_alert_by_id($id, true);
        if (!$alert) {
            return "";
        }

        if ($remove_object && $alert["type"]["module"] && $alert["type"]["model"] && $alert["type"]["callback"]) {
            try {
                $this->ci->load->model($alert["type"]["module"] . "/models/" . $alert["type"]["model"], $alert["type"]["model"], true);
                $error = $this->ci->{$alert["type"]["model"]}->{$alert["type"]["callback"]}("delete", $alert["id_object"]);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }

            if ($error && $error != "removed") {
                return $error;
            }
        }

        $type = $alert["type"];
        if ($alert["spam_status"] == "none") {
            $save_data["obj_need_approve"] = $type["obj_need_approve"] - 1;
        }
        $save_data["obj_count"] = $type["obj_count"] - 1;
        $this->ci->Spam_type_model->save_type($type['id'], $save_data);

        $this->ci->db->where("id", $id);
        $this->ci->db->delete(SPAM_ALERTS_TABLE);

        $this->sendEvent(SpamModel::EVENT_ALERT_CHANGED, [
            'id' => $id,
            'type' => SpamModel::TYPE_SPAM_ALERT,
            'status' => $remove_object ? SpamModel::STATUS_CONTENT_DELETED : SpamModel::STATUS_ALERT_DELETED,
        ]);

        return "";
    }

    /**
     * Return alerts as array
     *
     * @param integer $page
     * @param string  $limits
     * @param array   $order_by
     * @param array   $params
     *
     * @return array
     */
    private function getAlertsListInternal($page = null, $limits = null, $order_by = null, $params = [])
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(SPAM_ALERTS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $r;
            }

            return $this->format_alert($data);
        }

        return [];
    }

    /**
     * Return alerts as array
     *
     * @param array $params
     *
     * @return integer
     */
    private function getAlertsCountInternal($params = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(SPAM_ALERTS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    /**
     * Return alerts as array
     *
     * @param integer $page
     * @param string  $limits
     * @param array   $order_by
     * @param string  $type_gid
     *
     * @return array
     */
    public function getAlertsList($page = null, $limits = null, $order_by = null, $type_gid = null)
    {
        $params = [];
        if ($type_gid) {
            $type = $this->get_type_by_gid($type_gid);
            $params["where"]["id_type"] = $type["id"];
        }

        return $this->getAlertsListInternal($page, $limits, $order_by, $params);
    }

    /**
     * Return number of alerts
     *
     * @param string $type_gid
     *
     * @return integer
     */
    public function getAlertsCount($type_gid = null, $object_id = null)
    {
        $params = [];

        if ($type_gid) {
            $type = $this->get_type_by_gid($type_gid);
            $params["where"]["id_type"] = $type["id"];
        }

        if ($object_id > 0) {
            $params["where"]["id_object"] = $object_id;
        }

        return $this->getAlertsCountInternal($params);
    }

    /**
     * Validate alert
     *
     * @param integer $id
     * @param array   $data
     *
     * @return array
     */
    public function validateAlert($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["id_type"])) {
            $return['data']['id_type'] = strval($data["id_type"]);
            if (empty($return['data']['id_type'])) {
                $return["errors"][] = l("error_empty_type", "spam");
            } else {
                $type = $this->Spam_type_model->get_type_by_id($return['data']['id_type']);
                if (!$type) {
                    $return["errors"][] = l("error_invalid_type", "spam");
                } else {
                    $return["data"]["id_type"] = $type["id"];
                }
            }
        } elseif (!$id) {
            $return["errors"][] = l("error_empty_type", "spam");
        }

        if (isset($data["id_object"])) {
            $return["data"]["id_object"] = intval($data['id_object']);
            if (empty($data["id_object"])) {
                $return["errors"][] = l("error_empty_object", "spam");
            }
        } elseif (!$id) {
            $return["errors"][] = l("error_empty_object", "spam");
        }

        if (isset($data["id_poster"])) {
            $return["data"]["id_poster"] = intval($data['id_poster']);
            if (empty($data["id_poster"])) {
                $return["errors"][] = l("error_empty_poster", "spam");
            } else {
                if ($type && $type["gid"] && $return["data"]["id_object"]) {
                    $check = $this->is_alert_from_poster($type["gid"], $return["data"]["id_poster"], $return["data"]["id_object"]);
                    if ($check) {
                        $return["errors"][] = l("error_alert_from_poster", "spam");
                    }
                }
            }
        } elseif (!$id) {
            $return["errors"][] = l("error_empty_poster", "spam");
        }

        if (isset($data["id_reason"])) {
            $return["data"]["id_reason"] = intval($data["id_reason"]);
            if ($type && $type["gid"] == "select_text") {
                if (!empty($return["data"]["id_reason"])) {
                    $return["errors"][] = l("error_empty_reason", "spam");
                }
            }
        }

        if (isset($data["message"])) {
            $return["data"]["message"] = trim(strip_tags($data["message"]));
            if (!empty($return["data"]["message"])) {
                $this->ci->load->model("moderation/models/Moderation_badwords_model");
                $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $return["data"]["message"]);
                if ($bw_count) {
                    $return["errors"][] = l("error_badwords_message", "spam");
                }
            }
        }

        if (isset($data["spam_status"])) {
            $return["data"]["spam_status"] = intval($data["spam_status"]);
        }

        return $return;
    }

    /**
     * Ban alert
     *
     * @param integer $id
     *
     * @return boolean
     */
    public function banAlert($id)
    {
        $alert = $this->get_alert_by_id($id, true);
        if (!$alert) {
            return false;
        }
        if (!$alert["type"]["module"] || !$alert["type"]["model"] || !$alert["type"]["callback"]) {
            return false;
        }

        try {
            $this->ci->load->model($alert["type"]["module"] . "/models/" . $alert["type"]["model"], $alert["type"]["model"], true);
            $status = $this->ci->{$alert["type"]["model"]}->{$alert["type"]["callback"]}("ban", $alert["id_object"]);
        } catch (\Exception $e) {
            $status = "removed";
        }

        if (!in_array($status, $this->spam_status_arr)) {
            return $status;
        }
        if ($status == "removed") {
            $this->delete_alert($id);

            return l('success_removed_alert', 'spam');
        } else {
            $type = $alert["type"];
            if ($alert["spam_status"] == "none") {
                $save_data["obj_need_approve"] = $type["obj_need_approve"] - 1;
                $this->ci->Spam_type_model->save_type($type['id'], $save_data);
            }

            //update
            $data["spam_status"] = $status;
            $this->save_alert($id, $data);

            return $data;
        }
    }

    /**
     * Unban alert
     *
     * @param integer $id
     *
     * @return array/string
     */
    public function unbanAlert($id)
    {
        $alert = $this->get_alert_by_id($id, true);
        if (!$alert) {
            return false;
        }
        if (!$alert["type"]["module"] || !$alert["type"]["model"] || !$alert["type"]["callback"]) {
            return false;
        }

        try {
            $this->ci->load->model($alert["type"]["module"] . "/models/" . $alert["type"]["model"], $alert["type"]["model"], true);
            $status = $this->ci->{$alert["type"]["model"]}->{$alert["type"]["callback"]}("unban", $alert["id_object"]);
        } catch (\Exception $e) {
            $status = "removed";
        }

        if (!in_array($status, $this->spam_status_arr)) {
            throw new \Exception($status);
        }

        $this->delete_alert($id);

        return $status;
    }

    /**
     * Unban alert
     *
     * @param integer $id
     *
     * @return array/string
     */
    public function deleteContent($id)
    {
        $alert = $this->get_alert_by_id($id, true);
        if (!$alert) {
            return false;
        }
        if (!$alert["type"]["module"] || !$alert["type"]["model"] || !$alert["type"]["callback"]) {
            return false;
        }

        try {
            $this->ci->load->model($alert["type"]["module"] . "/models/" . $alert["type"]["model"], $alert["type"]["model"], true);
            $status = $this->ci->{$alert["type"]["model"]}->{$alert["type"]["callback"]}("delete", $alert["id_object"]);
        } catch (\Exception $e) {
            $status = "removed";
        }

        if (!in_array($status, $this->spam_status_arr)) {
            throw new \Exception($status);
        }

        $this->delete_alert($id);

        $this->sendEvent(SpamModel::EVENT_ALERT_CHANGED, [
            'id' => $id,
            'type' => SpamModel::TYPE_SPAM_ALERT,
            'status' => SpamModel::STATUS_CONTENT_DELETED,
        ]);

        return $status;
    }

    /**
     * Check exists alert to object from porter
     *
     * @param string  $type_gid
     * @param integer $poster_id
     * @param integer $object_id
     *
     * @return boolean
     */
    public function isAlertFromPoster($type_gid, $poster_id, $object_id)
    {
        $type = $this->get_type_by_gid($type_gid);
        $params = [];
        $params["where"]["id_type"] = $type["id"];
        $params["where"]["id_poster"] = $poster_id;
        $params["where"]["id_object"] = $object_id;

        return $this->getAlertsCountInternal($params) > 0;
    }

    /**
     * Set format settings
     *
     * @param array $data
     *
     * @return array
     */
    public function setFormatSettings($data)
    {
        foreach ($data as $key => $value) {
            if (isset($this->format_settings[$key])) {
                $this->format_settings[$key] = $value;
            }
        }
    }

    /**
     * Format alert
     *
     * @param array $data
     *
     * @return array
     */
    public function formatAlert($data)
    {
        if (!$this->format_settings["use_format"]) {
            return $data;
        }

        $types_is_loaded = false;

        $users_search = [];
        $types_search = [];
        $contents_search = [];
        $links_search = [];
        $objects_search = [];
        $reasons_search = [];
        $subpost_search = [];
        $deletelinks_search = [];

        foreach ($data as $key => $alert) {
            $data[$key] = $alert;
            //get_poster
            if ($this->format_settings["get_poster"]) {
                $users_search[] = $alert["id_poster"];
            }
            //get form
            if ($this->format_settings["get_type"]) {
                $types_search[] = $alert["id_type"];
            }
            //get content
            if ($this->format_settings["get_content"]) {
                $contents_search[$alert["id_type"]][] = $alert["id_object"];
            }
            //get link
            if ($this->format_settings["get_link"]) {
                $links_search[$alert["id_type"]][] = $alert["id_object"];
            }
            //get deletelink
            if ($this->format_settings["get_deletelink"]) {
                $deletelinks_search[$alert["id_type"]][] = $alert["id_object"];
            }
            //get object
            if ($this->format_settings["get_object"]) {
                $objects_search[$alert["id_type"]][] = $alert["id_object"];
            }
            //get object
            if ($this->format_settings["get_subpost"]) {
                $subpost_search[$alert["id_type"]][] = $alert["id_object"];
            }
            //get reason
            if ($this->format_settings["get_reason"] && $alert["id_reason"]) {
                $reasons_search[] = $alert["id_reason"];
            }
            $data[$key]["message"] = nl2br($alert["message"]);
            $data[$key]["spam_status"] = in_array($data[$key]["spam_status"], $this->spam_status_arr) ?
                $data[$key]["spam_status"] : "none";
        }

        if ($this->format_settings["get_poster"] && !empty($users_search)) {
            $this->ci->load->model("Users_model");
            $users_data = $this->ci->Users_model->get_users_list_by_key(null, null, null, [], $users_search);
            foreach ($data as $key => $alert) {
                $data[$key]["poster"] = (isset($users_data[$alert["id_poster"]])) ?
                    $users_data[$alert["id_poster"]] : $this->ci->Users_model->format_default_user($alert["id_poster"]);
            }
        }

        if ($this->format_settings["get_type"] && !empty($types_search)) {
            $types_data = $this->ci->Spam_type_model->get_types(0, $types_search);

            foreach ($types_data as $type_data) {
                $this->spam_types[$type_data["id"]] = $type_data;
                $this->spam_types[$type_data["gid"]] = $type_data;
            }
            //$this->spam_types[$type_data["id"]] = $type_data;
            //$this->spam_types[$type_gid] = $type_data;
            foreach ($data as $key => $alert) {
                $data[$key]["type"] = (isset($types_data[$alert["id_type"]])) ?
                    $types_data[$alert["id_type"]] : $this->ci->Spam_type_model->format_default_type($alert["id_type"]);
            }
            $types_is_loaded = true;
        }

        if ($this->format_settings["get_content"] && !empty($contents_search)) {
            if (!$types_is_loaded) {
                $types_data = $this->ci->Spam_type_model->get_types(0, $types_search);
                foreach ($types_data as $type_data) {
                    $this->spam_types[$type_data["id"]] = $type_data;
                    $this->spam_types[$type_data["gid"]] = $type_data;
                }
                $types_is_loaded = true;
            }
            $contents_data = [];
            foreach ($this->spam_types as $type_data) {
                if (!isset($contents_search[$type_data["id"]]) || !$type_data["module"] || !$type_data["model"] || !$type_data["callback"]) {
                    continue;
                }

                try {
                    $this->ci->load->model($type_data["module"] . "/models/" . $type_data["model"], $type_data["model"], true);
                    $contents_data[$type_data["id"]] = $this->ci->{$type_data["model"]}->{$type_data["callback"]}(
                        "get_content",
                        $contents_search[$type_data["id"]]);
                } catch (\Exception $e) {
                }
            }
            foreach ($data as $key => $alert) {
                $data[$key]["content"] = isset($contents_data[$alert["id_type"]][$alert["id_object"]]) ?
                    $contents_data[$alert["id_type"]][$alert["id_object"]] : "";
            }
        }

        if ($this->format_settings["get_link"] && !empty($links_search)) {
            if (!$types_is_loaded) {
                $types_data = $this->ci->Spam_type_model->get_types(0, $types_search);
                foreach ($types_data as $type_data) {
                    $this->spam_types[$type_data["id"]] = $type_data;
                    $this->spam_types[$type_data["gid"]] = $type_data;
                }
                $types_is_loaded = true;
            }
            $links_data = [];
            foreach ($this->spam_types as $type_data) {
                if (!isset($links_search[$type_data["id"]]) || !$type_data["module"] || !$type_data["model"] || !$type_data["callback"]) {
                    continue;
                }

                try {
                    $this->ci->load->model($type_data["module"] . "/models/" . $type_data["model"], $type_data["model"], true);
                    $links_data[$type_data["id"]] = $this->ci->{$type_data["model"]}->{$type_data["callback"]}(
                        "get_link",
                        $links_search[$type_data["id"]]);
                } catch (\Exception $e) {
                }
            }
            foreach ($data as $key => $alert) {
                $data[$key]["link"] = isset($links_data[$alert["id_type"]][$alert["id_object"]]) ?
                    $links_data[$alert["id_type"]][$alert["id_object"]] : "";
            }
        }

        if ($this->format_settings["get_deletelink"] && !empty($deletelinks_search)) {
            if (!$types_is_loaded) {
                $types_data = $this->ci->Spam_type_model->get_types(0, $types_search);
                foreach ($types_data as $type_data) {
                    $this->spam_types[$type_data["id"]] = $type_data;
                    $this->spam_types[$type_data["gid"]] = $type_data;
                }
                $types_is_loaded = true;
            }
            $links_data = [];
            foreach ($this->spam_types as $type_data) {
                if (!isset($deletelinks_search[$type_data["id"]]) || !$type_data["module"] || !$type_data["model"] || !$type_data["callback"]) {
                    continue;
                }
                try {
                    $this->ci->load->model($type_data["module"] . "/models/" . $type_data["model"], $type_data["model"], true);
                    $deletelinks_data[$type_data["id"]] = $this->ci->{$type_data["model"]}->{$type_data["callback"]}(
                        "get_deletelink",
                        $deletelinks_search[$type_data["id"]]);
                } catch (\Exception $e) {
                }
            }

            foreach ($data as $key => $alert) {
                $data[$key]["delete_link"] = isset($deletelinks_data[$alert["id_type"]][$alert["id_object"]]) ?
                    $deletelinks_data[$alert["id_type"]][$alert["id_object"]] : "";
            }
        }

        if ($this->format_settings["get_object"] && !empty($objects_search)) {
            if (!$types_is_loaded) {
                $types_data = $this->ci->Spam_type_model->get_types(0, $types_search);
                foreach ($types_data as $type_data) {
                    $this->spam_types[$type_data["id"]] = $type_data;
                    $this->spam_types[$type_data["gid"]] = $type_data;
                }
                $types_is_loaded = true;
            }
            $objects_data = [];
            foreach ($this->spam_types as $type_data) {
                if (!isset($objects_search[$type_data["id"]]) || !$type_data["module"] || !$type_data["model"] || !$type_data["callback"]) {
                    continue;
                }
                try {
                    $this->ci->load->model($type_data["module"] . "/models/" . $type_data["model"], $type_data["model"]);
                    $objects_data[$type_data["id"]] = $this->ci->{$type_data["model"]}->{$type_data["callback"]}(
                        "get_object",
                        $objects_search[$type_data["id"]]);
                } catch (\Exception $e) {
                }
            }
            foreach ($data as $key => $alert) {
                $data[$key]["object"] = isset($objects_data[$alert["id_type"]][$alert["id_object"]]) ?
                    $objects_data[$alert["id_type"]][$alert["id_object"]] : "";
            }
        }

        if ($this->format_settings["get_subpost"] && !empty($subpost_search)) {
            if (!$types_is_loaded) {
                $types_data = $this->ci->Spam_type_model->get_types(0, $types_search);
                foreach ($types_data as $type_data) {
                    $this->spam_types[$type_data["id"]] = $type_data;
                    $this->spam_types[$type_data["gid"]] = $type_data;
                }
                $types_is_loaded = true;
            }
            $subpost_data = [];
            foreach ($this->spam_types as $type_data) {
                if (!isset($subpost_search[$type_data["id"]]) || !$type_data["module"] || !$type_data["model"] || !$type_data["callback"]) {
                    continue;
                }
                try {
                    $this->ci->load->model($type_data["module"] . "/models/" . $type_data["model"], $type_data["model"]);
                    $subpost_data[$type_data["id"]] = $this->ci->{$type_data["model"]}->{$type_data["callback"]}(
                        "get_subpost",
                        $subpost_search[$type_data["id"]]);
                } catch (\Exception $e) {
                }
            }
            foreach ($data as $key => $alert) {
                $data[$key]["subpost"] = isset($subpost_data[$alert["id_type"]][$alert["id_object"]]) ?
                    $subpost_data[$alert["id_type"]][$alert["id_object"]] : "";
            }
        }

        if ($this->format_settings["get_reason"] && !empty($reasons_search)) {
            $this->ci->load->model("spam/models/Spam_reason_model");

            $lang_id = $this->ci->pg_language->current_lang_id;

            $reference = $this->ci->pg_language->ds->get_reference($this->ci->Spam_reason_model->module_gid, $this->ci->Spam_reason_model->content[0], $lang_id);
            foreach ($data as $key => $alert) {
                $data[$key]["reason"] = isset($reference["option"][$alert["id_reason"]]) ?
                    $reference["option"][$alert["id_reason"]] : "";
            }
        }

        return $data;
    }

    /**
     * Mark alert as read
     *
     * @param integer $id
     *
     * @return void
     */
    public function markAlertAsRead($id)
    {
        $data["mark"] = "1";
        $this->save_alert((int) $id, $data);

        return;
    }

    /**
     * Mark contact as unread
     *
     * @param integer $id
     *
     * @return void
     */
    public function markAlertAsUnread($id)
    {
        $data["mark"] = "0";
        $this->save_alert((int) $id, $data);

        return;
    }

    public function getObjectAlertsCount($type_id, $object_id)
    {
        return $this->getAlertsCountInternal(
            ["where" => ["id_type" => $type_id, "id_object" => $object_id]]);
    }

    public function __call($name, $args)
    {
        $methods = [
            'ban_alert' => 'banAlert',
            'delete_alert' => 'deleteAlert',
            'delete_content' => 'deleteContent',
            'format_alert' => 'formatAlert',
            'get_alert_by_id' => 'getAlertById',
            'get_alerts_count' => 'getAlertsCount',
            'get_alerts_list' => 'getAlertsList',
            'get_type_by_gid' => 'getTypeByGid',
            'is_alert_from_poster' => 'isAlertFromPoster',
            'mark_alert_as_read' => 'markAlertAsRead',
            'mark_alert_as_unread' => 'markAlertAsUnread',
            'save_alert' => 'saveAlert',
            'set_format_settings' => 'setFormatSettings',
            'unban_alert' => 'unbanAlert',
            'validate_alert' => 'validateAlert',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
