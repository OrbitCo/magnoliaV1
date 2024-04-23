<?php

declare(strict_types=1);

namespace Pg\modules\notifications\models;

if (!defined('NF_SENDER_TABLE')) {
    define('NF_SENDER_TABLE', DB_PREFIX . 'notifications_sender');
}

/**
 * Notifications sender model
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
class SenderModel extends \Model
{
    public $max_send_counter = 3;
    public $send_timeout = 1;
    protected $attrs = ['id', 'email', 'subject', 'message', 'content_type', 'send_counter'];

    public const CACHE_NAME = 'SenderModel';

    /**
     * SenderModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(NF_SENDER_TABLE);
    }

    public function sendLetter($email, $subject, $message, $mail_type = "txt")
    {
        $this->ci->load->library('email');
        $this->ci->email->clear();

        $mailconfig = [
            'charset'              => $this->ci->pg_module->get_module_config('notifications', 'mail_charset'),
            'protocol'             => $this->ci->pg_module->get_module_config('notifications', 'mail_protocol'),
            'mailpath'             => $this->ci->pg_module->get_module_config('notifications', 'mail_mailpath'),
            'smtp_host'            => $this->ci->pg_module->get_module_config('notifications', 'mail_smtp_host'),
            'smtp_user'            => $this->ci->pg_module->get_module_config('notifications', 'mail_smtp_user'),
            'smtp_pass'            => htmlspecialchars_decode($this->ci->pg_module->get_module_config('notifications', 'mail_smtp_pass')),
            'smtp_port'            => $this->ci->pg_module->get_module_config('notifications', 'mail_smtp_port'),
            'useragent'            => $this->ci->pg_module->get_module_config('notifications', 'mail_useragent'),
            'dkim_private_key'     => $this->ci->pg_module->get_module_config('notifications', 'dkim_private_key'),
            'dkim_domain_selector' => $this->ci->pg_module->get_module_config('notifications', 'dkim_domain_selector'),
            'mailtype'             => $mail_type
        ];

        if ($mail_type == 'html') {
            $mailconfig['alt_message'] = $message;
        }

        $this->ci->email->initialize($mailconfig);

        $from_email = $this->ci->pg_module->get_module_config('notifications', 'mail_from_email');
        $from_name = $this->ci->pg_module->get_module_config('notifications', 'mail_from_name');
        $this->ci->email->from($from_email, $from_name);
        $this->ci->email->to($email);

        $this->ci->email->subject($subject);
        $this->ci->email->message($message);

        $result = $this->ci->email->send();
        $this->ci->cache->flush(NF_SENDER_TABLE);
        if ($result === true) {
            return true;
        }

        return $this->ci->email->_debug_msg;
    }

    public function push($email, $subject, $message, $content_type = "text")
    {
        $data = [
            "email"        => $email,
            "subject"      => $subject,
            "message"      => $message,
            "content_type" => $content_type,
            "send_counter" => 0
        ];
        $this->ci->db->insert(NF_SENDER_TABLE, $data);
        $this->ci->cache->flush(NF_SENDER_TABLE);
    }

    public function get($count = 10)
    {
        $nameTable  = NF_SENDER_TABLE;
        $results =  $this->ci->cache->get(self::CACHE_NAME, 'get'.$count, function () use ($count, $nameTable) {
            $ci = &get_instance();
            $ci->db->select('id, email, subject, message, content_type, send_counter')
                ->from($nameTable)
                ->order_by('id')
                ->limit($count, 0);
            $results = $ci->db->get()->result_array();

            return $results;
        });

        if (!empty($results) && is_array($results)) {
            return $results;
        }

        return [];
    }

    public function updateCounter($id, $counter)
    {
        $data = [
            "send_counter" => $counter,
        ];
        $this->ci->db->where('id', $id);
        $this->ci->db->update(NF_SENDER_TABLE, $data);
        $this->ci->cache->flush(NF_SENDER_TABLE);
    }

    public function delete($id)
    {
        if (is_array($id)) {
            $this->ci->db->where_in('id', $id);
        } else {
            $this->ci->db->where('id', $id);
        }
        $this->ci->db->delete(NF_SENDER_TABLE);
        $this->ci->cache->flush(NF_SENDER_TABLE);
    }

    public function sendingSession($count = 10)
    {
        $res = ["sent" => 0, "errors" => 0];

        $letters = $this->get($count);
        if (empty($letters)) {
            return $res;
        }

        foreach ($letters as $letter) {
            $return = $this->send_letter($letter["email"], $letter["subject"], $letter["message"], $letter["content_type"]);
            if ($return === true || $letter["send_counter"] + 1 >= $this->max_send_counter) {
                $this->delete($letter["id"]);
            } else {
                $this->update_counter($letter["id"], $letter["send_counter"] + 1);
            }

            if ($return === true) {
                ++$res["sent"];
            } else {
                ++$res["errors"];
            }
        }

        return $res;
    }

    public function validateMailConfig($data)
    {
        $return = ["data" => [], "errors" => []];

        if (isset($data["mail_charset"])) {
            $return["data"]["mail_charset"] = strip_tags($data["mail_charset"]);
            if (empty($return["data"]["mail_charset"])) {
                $return["errors"][] = l('error_charset_incorrect', 'notifications');
            }
        }

        if (isset($data["mail_protocol"])) {
            $return["data"]["mail_protocol"] = strip_tags($data["mail_protocol"]);
            if (empty($return["data"]["mail_protocol"]) || !in_array($return["data"]["mail_protocol"], ['mail', 'sendmail', 'smtp'])) {
                $return["errors"][] = l('error_protocol_incorrect', 'notifications');
            }
        }

        if (isset($data["mail_mailpath"])) {
            $return["data"]["mail_mailpath"] = strip_tags($data["mail_mailpath"]);
        }

        if (isset($data["mail_smtp_host"])) {
            $return["data"]["mail_smtp_host"] = strip_tags($data["mail_smtp_host"]);
        }

        if (isset($data["mail_smtp_user"])) {
            $return["data"]["mail_smtp_user"] = strip_tags($data["mail_smtp_user"]);
        }

        if (isset($data["mail_smtp_pass"])) {
            $return["data"]["mail_smtp_pass"] = $data["mail_smtp_pass"];
        }

        if (isset($data["mail_smtp_port"])) {
            $return["data"]["mail_smtp_port"] = strip_tags($data["mail_smtp_port"]);
        }

        if (isset($data["mail_useragent"])) {
            $return["data"]["mail_useragent"] = strip_tags($data["mail_useragent"]);
            if (empty($return["data"]["mail_useragent"])) {
                $return["errors"][] = l('error_useragent_incorrect', 'notifications');
            }
        }

        if (isset($data["mail_from_email"])) {
            $return["data"]["mail_from_email"] = strip_tags($data["mail_from_email"]);
            if (empty($data["mail_from_email"])) {
                $return["errors"][] = l('error_from_email_incorrect', 'notifications');
            }
        }

        if (isset($data["mail_from_name"])) {
            $return["data"]["mail_from_name"] = strip_tags($data["mail_from_name"]);
            if (empty($data["mail_from_name"])) {
                $return["errors"][] = l('error_from_name_incorrect', 'notifications');
            }
        }

        if (isset($data["dkim_private_key"])) {
            $return["data"]["dkim_private_key"] = strip_tags($data["dkim_private_key"]);
        }

        if (isset($data["dkim_domain_selector"])) {
            $return["data"]["dkim_domain_selector"] = strip_tags($data["dkim_domain_selector"]);
        }

        return $return;
    }

    public function validateTest($data)
    {
        $return = ["data" => [], "errors" => []];

        if (isset($data["mail_to_email"])) {
            $return["data"]["mail_to_email"] = strip_tags($data["mail_to_email"]);
            if (empty($data["mail_to_email"]) || !preg_match(
                "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",
                $data["mail_to_email"]
            )) {
                $return["errors"][] = l('error_to_email_incorrect', 'notifications');
            }
        }

        return $return;
    }

    public function cronQueSender()
    {
        $data = $this->sending_session(60);
        echo "Letters sent: " . $data["sent"] . "; (" . $data["errors"] . " errors)";
    }

    public function getSendersList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null)
    {
        $this->ci->db->select(implode(", ", $this->attrs))->from(NF_SENDER_TABLE);

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

        $data = [];
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $this->format_senders($r);
            }
        }

        return $data;
    }

    public function getSendersCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(NF_SENDER_TABLE);

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

    public function formatSenders($data, $get_langs = false)
    {
        $data["name_i"] = "sender_" . $data["id"];

        return $data;
    }

    public function send($id = 0)
    {
        $res = ["sent" => 0, "errors" => 0];
        $nameTable  =   NF_SENDER_TABLE;
        $nameCache  =   is_array($id) ? "send".implode('_', $id) : "send".$id;
        $letters =  $this->ci->cache->get(self::CACHE_NAME, $nameCache, function () use ($id, $nameTable) {
            if (is_array($id)) {
                $this->ci->db->where_in('id', $id);
            } else {
                $this->ci->db->where('id', $id);
            }

            $ci = &get_instance();
            $ci->db->select('id, email, subject, message, content_type, send_counter')
                ->from($nameTable)
                ->order_by('id');
            $letters = $ci->db->get()->result_array();

            return $letters;
        });

        if (empty($letters)) {
            return $res;
        }

        foreach ($letters as $letter) {
            $return = $this->sendLetter($letter["email"], $letter["subject"], $letter["message"], $letter["content_type"]);
            if ($return === true || $letter["send_counter"] + 1 >= $this->max_send_counter) {
                $this->delete($letter["id"]);
            } else {
                $this->updateCounter($letter["id"], $letter["send_counter"] + 1);
            }

            if ($return === true) {
                ++$res["sent"];
            } else {
                ++$res["errors"];
            }
        }

        return $res;
    }

    public function __call($name, $args)
    {
        $methods = [
            'cron_que_sender' => 'cronQueSender',
            'format_senders' => 'formatSenders',
            'get_senders_count' => 'getSendersCount',
            'get_senders_list' => 'getSendersList',
            'send_letter' => 'sendLetter',
            'sending_session' => 'sendingSession',
            'update_counter' => 'updateCounter',
            'validate_mail_config' => 'validateMailConfig',
            'validate_test' => 'validateTest',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
