<?php

declare(strict_types=1);

namespace Pg\modules\notifications\models;

if (!defined('NF_TEMPLATES_TABLE')) {
    define('NF_TEMPLATES_TABLE', DB_PREFIX . 'notifications_templates');
}

if (!defined('NF_TEMPLATES_CONTENT_TABLE')) {
    define('NF_TEMPLATES_CONTENT_TABLE', DB_PREFIX . 'notifications_templates_content');
}

/**
 * Notifications templates model
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
class TemplatesModel extends \Model
{
    /**
     * Notification template path
     *
     * @var string
     */
    public const NOTIFICATIONS_PATH = 'notifications/';

    protected $attrs = ['id', 'module',  'gid', 'name', 'vars', 'content_type', 'date_add', 'date_update'];
    public $global_vars = ['site_url', 'domain', 'mail_from', 'name_from', 'current_date', 'current_time'];

    public const CACHE_NAME = 'TemplatesModel';

    /**
     * TemplatesModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(NF_TEMPLATES_TABLE);
        $this->ci->cache->registerService(NF_TEMPLATES_CONTENT_TABLE);
    }

    public function getTemplateByGid($gid)
    {
        $data   = [];
        $nameTable  = NF_TEMPLATES_TABLE;
        $fields     = implode(", ", $this->attrs);
        $result =  $this->ci->cache->get(self::CACHE_NAME, 'getTemplateByGid'.$gid, function () use ($gid, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("gid", $gid)
                ->get()
                ->result_array();

            return $result;
        });
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function getTemplateById($id)
    {
        $data   = [];
        $nameTable  = NF_TEMPLATES_TABLE;
        $fields     = implode(", ", $this->attrs);
        $result =  $this->ci->cache->get(self::CACHE_NAME, 'getTemplateById'.$id, function () use ($id, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("id", $id)
                ->get()
                ->result_array();

            return $result;
        });
        if (!empty($result)) {
            $data = $result[0];
        }

        return $data;
    }

    public function saveTemplate($id, $data)
    {
        if (empty($id)) {
            $data["date_update"] = $data["date_add"]    = date("Y-m-d H:i:s");
            $this->ci->db->insert(NF_TEMPLATES_TABLE, $data);
            $id                  = $this->ci->db->insert_id();
        } else {
            $data["date_update"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $id);
            $this->ci->db->update(NF_TEMPLATES_TABLE, $data);
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return $id;
    }

    public function validateTemplate($id, $data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["name"])) {
            $return["data"]["name"] = strip_tags($data["name"]);
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('error_name_mandatory_field', 'notifications');
            }
        }

        if (isset($data["module"])) {
            $return["data"]["module"] = trim(strip_tags($data["module"]));
        }

        if (isset($data["gid"])) {
            $return["data"]["gid"] = trim(strip_tags($data["gid"]));
            $return["data"]["gid"] = preg_replace('/[^a-z\-_0-9]+/i', '', $return["data"]["gid"]);
            $return["data"]["gid"] = preg_replace('/[\s\n\t\r]+/', '-', $return["data"]["gid"]);
            $return["data"]["gid"] = preg_replace('/\-{2,}/', '-', $return["data"]["gid"]);

            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l('error_gid_mandatory_field', 'notifications');
            } else {
                $this->ci->db->select('COUNT(*) AS cnt')->from(NF_TEMPLATES_TABLE)->where("gid", $return["data"]["gid"]);
                if (!empty($id)) {
                    $this->ci->db->where("id <>", $id);
                }
                $result = $this->ci->db->get()->result_array();
                if (!empty($result) && $result[0]["cnt"] > 0) {
                    $return["errors"][] = l('error_template_already_exists', 'notifications');
                }
            }
        }

        if (isset($data["vars"])) {
            $vars = explode(",", $data["vars"]);
            foreach ($vars as $k => $v) {
                $vars[$k] = trim(strip_tags($v));
            }
            $return["data"]["vars"] = serialize($vars);
        }

        if (isset($data["content_type"])) {
            $return["data"]["content_type"] = strip_tags($data["content_type"]);
            if (empty($return["data"]["content_type"])) {
                $return["errors"][] = l('error_content_type_mandatory_field', 'notifications');
            }
        }

        return $return;
    }

    public function deleteTemplate($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(NF_TEMPLATES_TABLE);

        $this->ci->db->where("id_template", $id);
        $this->ci->db->delete(NF_TEMPLATES_CONTENT_TABLE);
        $this->ci->cache->delete(self::CACHE_NAME, 'getTemplateById'.$id);

    }

    public function deleteTemplateByGid($gid)
    {
        $data = $this->get_template_by_gid($gid);
        if (empty($data)) {
            return false;
        }
        $this->ci->cache->delete(self::CACHE_NAME, 'getTemplateByGid'.$gid);
        $this->delete_template($data["id"]);
    }

    public function getTemplatesList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids
                              = null)
    {
        $this->ci->db->select(implode(", ", $this->attrs))->from(NF_TEMPLATES_TABLE);

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
                $data[] = $this->format_template($r);
            }
        }

        return $data;
    }

    public function getTemplatesCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(NF_TEMPLATES_TABLE);

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

    public function formatTemplate($data)
    {
        $data["vars"] = (!empty($data["vars"])) ? unserialize($data["vars"]) : "";
        if (!empty($data["vars"])) {
            $data["vars_str"] = implode(",", $data["vars"]);
        }

        return $data;
    }

    public function getTemplateContent($id_template, $lang_ids = [])
    {
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if (empty($lang_ids) || !in_array($default_lang_id, $lang_ids)) {
            $lang_ids[] = $default_lang_id;
        }

        $current_lang_id = $this->ci->pg_language->current_lang_id;
        if (empty($lang_ids) || !in_array($current_lang_id, $lang_ids)) {
            $lang_ids[] = $current_lang_id;
        }

        $this->ci->db->select('id, id_template, id_lang, subject, content')->from(NF_TEMPLATES_CONTENT_TABLE)->where(
            'id_template',
            $id_template
        )->where_in('id_lang', $lang_ids);
        $data    = [];
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[$r["id_lang"]] = $r;
            }
        }

        return $data;
    }

    public function setTemplateContent($id_template, $data)
    {
        if (empty($data)) {
            return;
        }

        $lang_ids = array_keys($data);
        if (empty($lang_ids)) {
            return;
        }

        $saved = $this->get_template_content($id_template, $lang_ids);

        foreach ($data as $id_lang => $content) {
            unset($attrs);
            $attrs["subject"] = $content["subject"];
            $attrs["content"] = $content["content"];

            if (isset($saved[$id_lang])) {
                $this->ci->db->where('id_template', $id_template);
                $this->ci->db->where('id_lang', $id_lang);
                $this->ci->db->update(NF_TEMPLATES_CONTENT_TABLE, $attrs);
            } else {
                $attrs["id_template"] = $id_template;
                $attrs["id_lang"]     = $id_lang;
                $this->ci->db->insert(NF_TEMPLATES_CONTENT_TABLE, $attrs);
            }
        }
        $this->ci->cache->flush(self::CACHE_NAME);

    }

    public function compileTemplate($gid, $vars, $lang_id = false)
    {
        $template_data = $this->formatTemplate($this->getTemplateByGid($gid));

        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if (!$lang_id) {
            $lang_id = $default_lang_id;
        }

        $lang_ids      = (!empty($lang_id)) ? [0 => $lang_id] : [];
        $content_array = $this->getTemplateContent($template_data["id"], $lang_ids);

        $content_default = $content_array[$default_lang_id];
        $content         = (!empty($content_array[$lang_id])) ? $content_array[$lang_id] : $content_array[$default_lang_id];

        if (empty($content["subject"])) {
            $content["subject"] = $content_default["subject"];
        }

        if (empty($content["content"])) {
            $content["content"] = $content_default["content"];
        }

        if (!empty($template_data["vars"])) {
            foreach ($template_data["vars"] as $key) {
                $value = (!empty($vars[$key]) && isset($vars[$key])) ? $vars[$key] : "";
                $content["subject"] = str_replace("[" . $key . "]", $value, $content["subject"]);
                $content["content"] = str_replace("[" . $key . "]", $value, $content["content"]);
            }
        }
        $global_vars = $this->getGlobalVars();
        if (!empty($global_vars)) {
            foreach ($global_vars as $key => $value) {
                $content["subject"] = str_replace("[" . $key . "]", $value, $content["subject"]);
                $content["content"] = str_replace("[" . $key . "]", $value, $content["content"]);
            }
        }

        return $this->formatContent($content, $template_data, $vars, $lang_id);
    }

    public function formatContent($data, $template_data, $vars, $lang_id = false)
    {
        if ($template_data['content_type'] == 'text') {
            return $data;
        }
        $vars['mail_from_name'] = $this->ci->pg_module->get_module_config('notifications', 'mail_from_name');
        $this->ci->view->assign('lang_id', $lang_id);
        $this->ci->view->assign('data', $vars);
        $content = null;

        if (file_exists(SITE_PATH . $this->getContentPathData($template_data))) {
            $content = $this->ci->view->fetch(self::NOTIFICATIONS_PATH . $template_data['gid'], 'user', $template_data['module']);
        }

        $this->ci->view->assign('content', $content ?: $data['content']);
        $data['content'] = $this->ci->view->fetch('content_template', 'user', NotificationsModel::MODULE_GID);

        return $data;
    }

    /**
     * Content path data
     *
     * @param array $data
     *
     * @return string
     */
    public function getContentPathData(array $data)
    {
        return MODULEPATH_RELATIVE . $data['module'] . '/views/flatty/' .  self::NOTIFICATIONS_PATH . $data['gid'] . '.twig';
    }

    public function getGlobalVars()
    {
        $global_vars["site_url"] = site_url();
        $url_data                = parse_url(site_url());
        $global_vars["domain"]   = $url_data["host"];

        $global_vars["mail_from"] = $this->ci->pg_module->get_module_config('notifications', 'mail_from_email');
        $global_vars["name_from"] = $this->ci->pg_module->get_module_config('notifications', 'mail_from_name');

        $global_vars["current_date"] = date($this->ci->pg_date->get_format('date_literal', 'date'));
        $global_vars["current_time"] = date($this->ci->pg_date->get_format('time_literal', 'date'));

        return $global_vars;
    }

    /**
     * Add templates content for the lang
     *
     * @param int $lang_id
     */
    public function addTemplatesContent($lang_id)
    {
        if ((int) $lang_id < 1) {
            return false;
        }

        $nameTable  = NF_TEMPLATES_CONTENT_TABLE;
        $default_tpls =  $this->ci->cache->get(self::CACHE_NAME, 'addTemplatesContent'.$lang_id, function () use ($lang_id, $nameTable) {
            $ci = &get_instance();
            $default_lang = $ci->pg_language->get_default_lang_id();
            $default_tpls = $ci->db->select("$lang_id as id_lang, id_template, subject, content")
                ->from($nameTable)
                ->where('id_lang', $default_lang)
                ->get()->result_array();

            return $default_tpls;
        });

        foreach ($default_tpls as $tpl) {
            $this->ci->db->insert(NF_TEMPLATES_CONTENT_TABLE, $tpl);
        }

        return true;
    }

    /**
     * Delete templates content for the lang
     *
     * @param int $lang_id
     */
    private function deleteTemplatesContent($lang_id)
    {
        if ((int) $lang_id < 1) {
            return false;
        }
        $this->ci->db->where('id_lang', $lang_id);
        $this->ci->db->delete(NF_TEMPLATES_CONTENT_TABLE);
        $this->ci->cache->delete(self::CACHE_NAME, 'addTemplatesContent'.$lang_id);

        return true;
    }

    public function langDedicateModuleCallbackAdd($lang_id)
    {
        $this->add_templates_content($lang_id);
    }

    public function langDedicateModuleCallbackDelete($lang_id)
    {
        $this->delete_templates_content($lang_id);
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_templates_content' => 'addTemplatesContent',
            'compile_template' => 'compileTemplate',
            'delete_template' => 'deleteTemplate',
            'delete_template_by_gid' => 'deleteTemplateByGid',
            'delete_templates_content' => 'deleteTemplatesContent',
            'format_template' => 'formatTemplate',
            'get_global_vars' => 'getGlobalVars',
            'get_template_by_gid' => 'getTemplateByGid',
            'get_template_by_id' => 'getTemplateById',
            'get_template_content' => 'getTemplateContent',
            'get_templates_count' => 'getTemplatesCount',
            'get_templates_list' => 'getTemplatesList',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'save_template' => 'saveTemplate',
            'set_template_content' => 'setTemplateContent',
            'validate_template' => 'validateTemplate',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
