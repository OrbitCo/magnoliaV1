<?php

declare(strict_types=1);

namespace Pg\modules\file_uploads\models;

if (!defined('FILE_UPLOADS_TABLE')) {
    define('FILE_UPLOADS_TABLE', DB_PREFIX . 'file_uploads');
}

/**
 * File uploads config model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 */
class FileUploadsConfigModel extends \Model
{
    public $fields_all = [
        'id',
        'gid',
        'name',
        'max_size',
        'name_format',
        'file_formats',
        'date_add',
    ];
    public $file_formats = [];
    public $file_categories = [];

    public function __construct()
    {
        parent::__construct();

        if (count($this->file_categories) == 0) {
            if (@require(APPPATH . 'config/file_uploads_mimes' . EXT)) {
                $this->file_categories = $mimes_categories;
            }
        }

        if (count($this->file_formats) == 0) {
            $this->ci->load->library('upload');
            $this->ci->upload->mimes_types('');
            $this->file_formats = $this->ci->upload->mimes;
        }
        $this->ci->cache->registerService(FILE_UPLOADS_TABLE);
    }

    public function getConfigList()
    {
        $data = [];
        $fields     = implode(", ", $this->fields_all);
        $nameTable  = FILE_UPLOADS_TABLE;
        $results = $this->ci->cache->get(FILE_UPLOADS_TABLE, 'getConfigList', function () use ($fields, $nameTable) {
            $ci = &get_instance();
            $ci->db->select($fields)
                ->from($nameTable)
                ->order_by('gid ASC');
            $results = $ci->db->get()->result_array();

            return $results;
        });

        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $this->format_config($r);
            }
        }

        return $data;
    }

    public function getConfigById($config_id)
    {
        $data = [];
        $fields     = implode(", ", $this->fields_all);
        $nameTable  = FILE_UPLOADS_TABLE;
        $result = $this->ci->cache->get(FILE_UPLOADS_TABLE, 'getConfigById' . $config_id, function () use ($fields, $config_id, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("id", $config_id)
                ->get()->result_array();

            return $result;
        });
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function getConfigByGid($config_gid)
    {
        $data = [];
        $fields     = implode(", ", $this->fields_all);
        $nameTable  = FILE_UPLOADS_TABLE;
        $result = $this->ci->cache->get(FILE_UPLOADS_TABLE, 'getConfigByGid_' . $config_gid, function () use ($fields, $config_gid, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("gid", $config_gid)
                ->get()->result_array();

            return $result;
        });
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function saveConfig($config_id, $data)
    {
        if (is_null($config_id)) {
            $data["date_add"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(FILE_UPLOADS_TABLE, $data);
            $config_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $config_id);
            $this->ci->db->update(FILE_UPLOADS_TABLE, $data);
        }
        $this->ci->cache->flush(FILE_UPLOADS_TABLE);

        return $config_id;
    }

    public function deleteConfig($config_id)
    {
        $data = $this->get_config_by_id($config_id);
        if (empty($data)) {
            return false;
        }

        $data = $this->format_config($data);

        $this->ci->db->where('id', $config_id);
        $this->ci->db->delete(FILE_UPLOADS_TABLE);
        $this->ci->cache->flush(FILE_UPLOADS_TABLE);
    }

    public function formatConfig($data)
    {
        if (!empty($data["file_formats"])) {
            $data["file_formats"] = unserialize($data["file_formats"]);
            if (!empty($data["file_formats"])) {
                foreach ($data["file_formats"] as $format) {
                    $data["enable_formats"][$format] = 1;
                }
                $this->ci->load->helper('upload');
                $data['allowed_mimes'] = get_mimes_types_by_files_types($data["file_formats"]);
            }
            $data["file_formats_str"] = implode("|", $data["file_formats"]);
        } else {
            $data["file_formats_str"] = "";
        }

        return $data;
    }

    public function validateConfig($config_id = null, $data = [])
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["name"])) {
            $return["data"]["name"] = strip_tags($data["name"]);
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('error_title_invalid', 'file_uploads');
            }
        }

        if (isset($data["gid"])) {
            $return["data"]["gid"] = strip_tags($data["gid"]);
            $return["data"]["gid"] = preg_replace("/[\n\t\s]{1,}/", "-", trim($return["data"]["gid"]));
            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l('error_gid_invalid', 'file_uploads');
            }
        } elseif (!$config_id) {
            $return["errors"][] = l('error_gid_invalid', 'file_uploads');
        }

        if (isset($data["max_size"])) {
            $return["data"]["max_size"] = intval($data["max_size"]);
            if ($return["data"]["max_size"] < 0) {
                $return["errors"][] = l('error_max_size', 'file_uploads');
            }
        }

        if (isset($data["name_format"])) {
            $return["data"]["name_format"] = $data["name_format"];
        }

        if (isset($data["file_formats"])) {
            if (!is_array($data["file_formats"])) {
                $return["errors"][] = l('error_empty_file_formats', 'file_uploads');
            } else {
                $return["data"]["file_formats"] = serialize($data["file_formats"]);
            }
        }

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_config' => 'deleteConfig',
            'format_config' => 'formatConfig',
            'get_config_by_gid' => 'getConfigByGid',
            'get_config_by_id' => 'getConfigById',
            'get_config_list' => 'getConfigList',
            'save_config' => 'saveConfig',
            'validate_config' => 'validateConfig',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
