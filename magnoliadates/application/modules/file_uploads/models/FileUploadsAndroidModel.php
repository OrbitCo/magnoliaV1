<?php

declare(strict_types=1);

namespace Pg\modules\file_uploads\models;

use Pg\Libraries\Cache\Manager as CacheManager;

/**
 * FIle uploads android model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Konstanti Rozhentsov
 * */

define('FILES_TABLE', DB_PREFIX . 'files');

class FileUploadsAndroidModel extends \Model
{

    public $media_path = "";
    public $media_url = "";

    private $file_config_id = 'android-exchange';

    public $fields = [
        'id',
        'user_id',
        'sender_id',
        'file_url',
        'file_path',
        'is_new',
        'file_name',
        'timestamp',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->media_path = SITE_PHYSICAL_PATH . UPLOAD_DIR . 'file-uploads/' . $this->file_config_id . "/";
        $this->media_url = SITE_VIRTUAL_PATH . UPLOAD_DIR . 'file-uploads/' . $this->file_config_id . "/";
        $this->ci->cache->registerService(FIELD_EDITOR_SAVED_SEARCHES);
    }

    public function setUpload($file_name = "", $user_id = null, $sender_id = null)
    {
        if (!empty($file_name) && $user_id != null && $sender_id != null) {
            $data['user_id'] = $user_id;
            $data['sender_id'] = $sender_id;
            $data['file_url'] = $this->media_url . $user_id . "/" . $file_name;
            $data['file_path'] = $this->media_path . $user_id . "/" . $file_name;
            $data['is_new'] = "1";
            $data['file_name'] = $file_name;

            $this->ci->db->insert(FILES_TABLE, $data);
            $file_id = $this->ci->db->insert_id();
            if (!empty($file_id)) {
                $message['message'] = l("success_file_sent", "mobile_app");
            } else {
                $message['message'] = l("error_file_sent", "mobile_app");
            }
            $this->ci->cache->flush(FIELD_EDITOR_SAVED_SEARCHES);
        } else {
            $message['message'] = l("error_file_sent", "mobile_app");
        }
        return $message;
    }

    public function getUploads($user_id, $outgoing = false)
    {
        $user       = $outgoing ? "sender_id" : "user_id";
        $nameTable  = FILES_TABLE;
        $fields     = implode(", ", $this->fields);
        $result = $this->ci->cache->get(FIELD_EDITOR_SAVED_SEARCHES, 'getUploads' . $user . '_' . $user_id, function () use ($user, $user_id, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where($user, $user_id)
                ->order_by("id", "DESC")
                ->get()->result_array();

            return $result;
        });

        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    public function markAsRead($upload_id = null, $data = [])
    {
        $this->ci->db->where('id', $upload_id);
        $this->ci->db->update(FILES_TABLE, $data);
        $this->ci->cache->flush(FIELD_EDITOR_SAVED_SEARCHES);
    }

    public function getUnviewedCount($user_id)
    {
        $nameTable = FILES_TABLE;
        $result = $this->ci->cache->get(FIELD_EDITOR_SAVED_SEARCHES, 'getUnviewedCount' . $user_id, function () use ($user_id, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select("id")
                ->from($nameTable)
                ->where("user_id", $user_id)
                ->where("is_new", "1")
                ->get()->result_array();
            return $result;
        });

        $count = count($result);
        return $count;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_mark_as_read' => 'markAsRead',
            'get_unviewed_count' => 'getUnviewedCount',
            'set_upload' => 'setUpload',
            'get_uploads' => 'getUploads',

        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
