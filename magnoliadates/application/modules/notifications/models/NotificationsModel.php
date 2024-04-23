<?php

declare(strict_types=1);

namespace Pg\modules\notifications\models;

if (!defined('NF_NOTIFICATIONS_TABLE')) {
    define('NF_NOTIFICATIONS_TABLE', DB_PREFIX . 'notifications');
}

/**
 * Notifications main model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class NotificationsModel extends \Model
{
    public const MODULE_GID = 'notifications';

    public $notifications_list_settings = [
        'mailbox_new_message',
        'secret_gifts',
        'send_vip_msg',
        'tickets_for_user',
        'friends_request',
        'virtual_gifts',
        'association',
        'like_me_overlap',
        'questions_new_question',
        'questions_answer',
        'favorites_add',
        'users_view',
        'moderation_status'
    ];

    public $template_var = [
        'domain' => '[domain]'
    ];

    public $attrs = [
        'id',
        'module',
        'gid',
        'send_type',
        'id_template_default',
        'date_add',
        'date_update'
    ];

    public const CACHE_NAME = 'NotificationsModel';

    /**
     * NotificationsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(NF_NOTIFICATIONS_TABLE);
    }

    public function getNotificationByGid($gid)
    {
        $nameTable  = NF_NOTIFICATIONS_TABLE;
        $attrs      = implode(", ", $this->attrs);
        $result =  $this->ci->cache->get(self::CACHE_NAME, 'getNotificationByGid'.$gid, function () use ($gid, $nameTable, $attrs) {
            $ci = &get_instance();

            return $ci->db->select($attrs)
                ->from($nameTable)
                ->where("gid", $gid)
                ->get()
                ->result_array();
        });

        return !empty($result) ? current($result) : [];
    }

    public function getNotificationById($id)
    {
        $nameTable  = NF_NOTIFICATIONS_TABLE;
        $attrs      = implode(", ", $this->attrs);
        $result =  $this->ci->cache->get(self::CACHE_NAME, 'getNotificationById'.$id, function () use ($id, $nameTable, $attrs) {
            $ci = &get_instance();
            return $ci->db->select($attrs)
                ->from($nameTable)
                ->where("id", $id)
                ->get()->result_array();
        });

        return !empty($result) ? current($result) : [];
    }

    /**
     * Settings gids
     *
     * @return array
     */
    public function getSettingsGids()
    {
        $whereIn    =  $this->notifications_list_settings;
        $nameTable  =   NF_NOTIFICATIONS_TABLE;
        $results =  $this->ci->cache->get(self::CACHE_NAME, 'getSettingsGids', function () use ($whereIn, $nameTable) {
            $ci = &get_instance();
            $ci->db->select('gid');
            $ci->db->from($nameTable);
            $ci->db->where_in('gid', $whereIn);

            return $ci->db->get()->result_array();
        });

        $data = [];
        if (!empty($results)) {
            foreach ($results as $item) {
                $data[] = $item['gid'];
            }
        }

        return $data;
    }

    public function getNotificationsList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids
                              = null, $get_langs = false)
    {
        $this->ci->db->select(implode(", ", $this->attrs))->from(NF_NOTIFICATIONS_TABLE);

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

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->attrs)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $data    = [];
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $this->formatNotification($r, $get_langs);
            }
        }

        return $data;
    }

    public function getNotificationsCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(NF_NOTIFICATIONS_TABLE);

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

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function formatNotification($data, $get_langs = false)
    {
        $data["name_i"] = "notification_" . $data["id"];
        $data["name"]   = ($get_langs) ? $this->formatName(l($data["name_i"], 'notifications')) : "";
        $data["label_name"]   = ($get_langs) ? $this->formatName(l('notification_' . $data['gid'], $data['module'])) : "";

        return $data;
    }

    private function formatName($name)
    {
        return str_replace($this->template_var['domain'], site_url(), $name);
    }

    public function saveNotification($id, $data, $langs = null)
    {
        if (is_null($id)) {
            $data["date_add"]    = $data["date_update"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(NF_NOTIFICATIONS_TABLE, $data);
            $id                  = $this->ci->db->insert_id();
        } else {
            $data["date_update"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $id);
            $this->ci->db->update(NF_NOTIFICATIONS_TABLE, $data);
        }

        if (isset($data["gid"]) && isset($langs)) {
            $languages = $this->ci->pg_language->languages;
            $lang_ids  = array_keys($languages);
            $this->ci->pg_language->pages->set_string_langs('notifications', "notification_" . $id, $langs, $lang_ids);
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return $id;
    }

    public function validateNotification($id, $data, $langs = null)
    {
        $return = ["errors" => [], "data" => [], 'langs' => []];

        if (isset($data["module"])) {
            $return["data"]["module"] = trim(strip_tags($data["module"]));
        }

        if (isset($langs)) {
            $langs_data = $this->ci->pg_language->getNamesDifferentLangs($langs);
            if ($langs_data === false) {
                $return["errors"][] = l('error_name_mandatory_field', 'notifications');
            } else {
                $return["langs"] = $langs_data;
            }
        }

        if (isset($data["gid"])) {
            $gid = !empty($data['gid']) ? $data['gid'] : $return["langs"][$this->ci->pg_language->current_lang_id];
            $gid_data = $this->ci->pg_language->createGUID($gid, '_');
            if (!empty($gid_data['errors'])) {
                $return["errors"][] = $gid_data['errors'];
            }
            $params = ['where' => ['gid' => $gid_data['gid']]];
            if ($id) {
                $params['where']['id <>'] = $id;
            }
            $count = $this->getNotificationsCount($params);
            if ($count > 0) {
                $return["errors"][] = l('error_gid_empty', 'notifications');
            } else {
                $return["data"]["gid"] = $gid_data['gid'];
            }
        }

        if (isset($data["send_type"])) {
            $return["data"]["send_type"] = strip_tags($data["send_type"]);
        }

        if (isset($data["id_template_default"])) {
            $return["data"]["id_template_default"] = intval($data["id_template_default"]);
        }

        return $return;
    }

    public function deleteNotification($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(NF_NOTIFICATIONS_TABLE);
        $this->ci->cache->flush(NF_NOTIFICATIONS_TABLE);
    }

    public function deleteNotificationByGid($gid)
    {
        $this->ci->db->where("gid", $gid);
        $this->ci->db->delete(NF_NOTIFICATIONS_TABLE);
        $this->ci->cache->flush(NF_NOTIFICATIONS_TABLE);
    }

    /**
     * @param string $email
     * @param string $gid
     * @param array $data
     * @param string $gid_template
     * @param string $id_lang
     * @param bool $is_validate_email
     *
     * @return bool|array
     */
    public function sendNotification($email, $gid, $data = [], $gid_template = '', $id_lang = '', $is_validate_email = true)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }
        $notification_data = $this->getNotificationByGid($gid);
        if (empty($notification_data)) {
            return false;
        }

        $this->ci->load->model([
            'notifications/models/Notifications_users_model',
            'Users_model',
            'notifications/models/Templates_model',
            'notifications/models/Sender_model'
        ]);

        if (!empty($is_validate_email)) {
            $user = $this->ci->Users_model->getUserByEmail($email);
            $id_lang = $id_lang ?: $user['lang_id'];

            if (!empty($user)) {
                if ($user["checked_email"] && !$user["valid_email"] && ($gid != 'users_change_email_confirm')) {
                    return false;
                }

                if (in_array($notification_data['gid'], $this->notifications_list_settings, true) === true) {
                    $is_notify = (!empty($data['is_send']) && $data['is_send'] === true) ? true : $this->ci->Notifications_users_model->isUserNotyfication($notification_data['gid'], $user['id']);

                    if ($is_notify === false) {
                        return false;
                    }
                }
            }
        }

        if (!$gid_template) {
            $template_data = $this->ci->Templates_model->get_template_by_id($notification_data["id_template_default"]);
            $gid_template  = $template_data["gid"];
        } else {
            $template_data = $this->ci->Templates_model->get_template_by_gid($gid_template);
        }

        $return["content"] = $content = $this->ci->Templates_model->compileTemplate($gid_template, $data, $id_lang);

        if ($notification_data["send_type"] == 'que') {
            $this->ci->Sender_model->push($email, $content["subject"], $content["content"], $template_data["content_type"]);
        } else {
            $errors = $this->ci->Sender_model->sendLetter($email, $content["subject"], $content["content"], $template_data["content_type"]);
            if ($errors !== true) {
                $return["errors"] = $errors;
            }
        }

        return $return;
    }

    public function getNotificationContent($gid, $data, $gid_template = '', $id_lang = '')
    {
        $notification_data = $this->get_notification_by_gid($gid);

        $this->ci->load->model('notifications/models/Templates_model');
        if (!$gid_template) {
            $template_data = $this->ci->Templates_model->get_template_by_id($notification_data["id_template_default"]);
            $gid_template  = $template_data["gid"];
        }

        return $this->ci->Templates_model->compile_template($gid_template, $data, $id_lang);
    }

    public function updateLangs($data, $langs_file, $lang_ids)
    {
        $tpl_lang_ids = $lang_ids     = (array) $lang_ids;

        if (!empty($data['templates'])) {
            // Save templates langs
            $this->ci->load->model('notifications/models/Templates_model');
            $tpl_lang_ids[] = $default_lang   = $this->ci->pg_language->get_default_lang_id();

            foreach ($data['templates'] as $tpl) {
                $template         = $this->ci->Templates_model->get_template_by_gid($tpl['gid']);
                if ($template) {
                    $template_content = $this->ci->Templates_model->get_template_content($template['id'], $tpl_lang_ids);

                    $template_lang_data = [];

                    $subject_gid = 'tpl_' . $tpl['gid'] . '_subject';
                    $content_gid = 'tpl_' . $tpl['gid'] . '_content';

                    $default_subject = isset($langs_file[$subject_gid][$default_lang]) ? (string) $langs_file[$subject_gid][$default_lang] : null;
                    $default_content = isset($langs_file[$content_gid][$default_lang]) ? (string) $langs_file[$content_gid][$default_lang] : null;

                    if (!$default_subject) {
                        $default_subject = $template_content[$default_lang]['subject'];
                    }

                    if (!$default_content) {
                        $default_content = $template_content[$default_lang]['content'];
                    }

                    foreach ($lang_ids as $id_lang) {
                        $subject = (string) $langs_file[$subject_gid][$id_lang];
                        $content = (string) $langs_file[$content_gid][$id_lang];

                        $template_content[$id_lang]["subject"] = ($subject) ? $subject : $default_subject;
                        $template_content[$id_lang]["content"] = ($content) ? $content : $default_content;
                    }
                    $this->ci->Templates_model->set_template_content($template['id'], $template_content);
                }
            }
        }
        if (!empty($data['notifications'])) {
            // Save notifications langs
            foreach ($data['notifications'] as $notification) {
                $n = $this->get_notification_by_gid($notification['gid']);
                if ($n) {
                    $this->ci->pg_language->pages->set_string_langs(
                        'notifications',
                        'notification_' . $n['id'],
                        $langs_file['notification_' . $notification['gid']],
                        $lang_ids
                    );
                }
            }
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return true;
    }

    public function exportLangs($data, $langs_ids = [])
    {
        $langs = [];
        $this->ci->load->model('notifications/models/Templates_model');
        foreach ($data['templates'] as $tpl) {
            $tpl     = $this->ci->Templates_model->get_template_by_gid($tpl['gid']);
            $content = $this->ci->Templates_model->get_template_content($tpl['id'], $langs_ids);
            foreach ($langs_ids as $lang_id) {
                $langs['tpl_' . $tpl['gid'] . '_subject'][$lang_id] = $content[$lang_id]['subject'];
                $langs['tpl_' . $tpl['gid'] . '_content'][$lang_id] = $content[$lang_id]['content'];
            }
        }
        $this->ci->load->model('Notifications_model');
        $gids          = [];
        $notifications = [];
        if (!empty($data['notifications']) && is_array($data['notifications'])) {
            foreach ($data['notifications'] as $notification) {
                $n_id                       = $this->get_notification_by_gid($notification['gid']);
                $gids[$n_id['id']]          = 'notification_' . $n_id['id'];
                $notifications[$n_id['id']] = $n_id;
            }
        }

        $notifications_langs = $this->ci->pg_language->export_langs('notifications', $gids, $langs_ids);
        $format_notifications_langs = [];
        foreach ($notifications_langs as $key => $notification) {
            $keys = array_keys($gids, $key);
            $notification_id = array_shift($keys);
            $format_notifications_langs['notification_' . $notifications[$notification_id]['gid']] = $notification;
        }

        return array_merge($langs, $format_notifications_langs);
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_notification' => 'deleteNotification',
            'delete_notification_by_gid' => 'deleteNotificationByGid',
            'export_langs' => 'exportLangs',
            'format_notification' => 'formatNotification',
            'get_notification_by_gid' => 'getNotificationByGid',
            'get_notification_by_id' => 'getNotificationById',
            'get_notification_content' => 'getNotificationContent',
            'get_notifications_count' => 'getNotificationsCount',
            'get_notifications_list' => 'getNotificationsList',
            'save_notification' => 'saveNotification',
            'send_notification' => 'sendNotification',
            'update_langs' => 'updateLangs',
            'validate_notification' => 'validateNotification',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
