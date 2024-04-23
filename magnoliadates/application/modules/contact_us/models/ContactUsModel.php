<?php

declare(strict_types=1);

namespace Pg\modules\contact_us\models;

define('CONTACT_REASONS_TABLE', DB_PREFIX . 'contact_us');

/**
 * Contact us main model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class ContactUsModel extends \Model
{

    const MODULE_GID = 'contact_us';

    private $fields = [
        'id',
        'mails',
        'date_add',
    ];

    private $_moderation_type = 'contact_us';

    /**
     * ContactUsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(CONTACT_REASONS_TABLE);
    }

    public function getReasonById($id)
    {
        $fields     = implode(", ", $this->fields);
        $nameTable  = CONTACT_REASONS_TABLE;
        $result = $this->ci->cache->get(CONTACT_REASONS_TABLE, 'getReasonById' . $id, function () use ($id, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("id", $id)->get()->result_array();

            return $result;
        });

        if (!empty($result)) {
            return $this->formatReasons($result)[0];
        }

        return [];
    }

    public function getReasonList($params = [], $filter_object_ids = null, $order_by = null)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(CONTACT_REASONS_TABLE);

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
                if (in_array($field, $this->fields_news)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $data[] = $r;
            }

            return $this->format_reasons($data);
        }

        return [];
    }

    public function getReasonCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(CONTACT_REASONS_TABLE);

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

    public function saveReason($id, $data, $langs)
    {
        if (is_null($id)) {
            $data["date_add"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(CONTACT_REASONS_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(CONTACT_REASONS_TABLE, $data);
        }

        if (!empty($langs)) {
            $languages = $this->ci->pg_language->languages;
            if (!empty($languages)) {
                foreach ($languages as $language) {
                    $lang_ids[] = $language["id"];
                }
                $this->ci->pg_language->pages->set_string_langs('contact_us', "contact_us_reason_" . $id, $langs, $lang_ids);
            }
        }
        $this->ci->cache->flush(CONTACT_REASONS_TABLE);
        return $id;
    }

    public function validateReason($id, $data)
    {
        $return = ["errors" => [], "data" => [], 'temp' => [], 'langs' => []];

        if (isset($data["mails"])) {
            if (empty($data["mails"])) {
                $return['errors'][] = l('error_email_mandatory_field', 'contact_us');
            }
            $data["mails"] = explode(',', $data["mails"]);
            foreach ($data["mails"] as $k => $mail) {
                $mail = trim(strip_tags($mail));
                if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $return['errors'][] = l('error_user_email_incorrect', 'contact_us');
                    continue;
                }
                if (!empty($mail)) {
                    $data["mails"][$k] = $mail;
                } else {
                    unset($data["mails"][$k]);
                }
            }
            $return["data"]["mails"] = serialize($data["mails"]);
        }

        if (isset($data['name'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['name']);
            if ($langs === false) {
                $return["errors"][] = l('error_reason_mandatory_field', 'contact_us');
            } else {
                $return["langs"] = $langs;
            }
        }

        return $return;
    }

    public function deleteReason($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(CONTACT_REASONS_TABLE);
        $this->ci->cache->delete(CONTACT_REASONS_TABLE, 'getReasonById' . $id);
        $this->ci->pg_language->pages->delete_string("contact_us", "contact_us_reason_" . $id);

        return;
    }

    public function formatReasons($data)
    {
        $languages = $this->ci->pg_language->languages;
        foreach ($data as $k => $reason) {
            $reason["name"] = !empty($reason["id"]) ? l('contact_us_reason_' . $reason["id"], 'contact_us') : '';
            foreach ($languages as $lang) {
                $reason["names"][$lang['id']] = !empty($reason["id"]) ? l('contact_us_reason_' . $reason["id"], 'contact_us', $lang['id']) : '';
            }
            $reason["mails"] = unserialize($reason["mails"]);
            if (!empty($reason["mails"]) && is_array($reason["mails"])) {
                $reason["mails_string"] = implode(", ", $reason["mails"]);
            } else {
                $reason["mails_string"] = "";
            }
            $data[$k] = $reason;
        }

        return $data;
    }

    public function validateSettings($data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["default_alert_email"])) {
            $return["data"]["default_alert_email"] = trim(strip_tags($data["default_alert_email"]));

            if (!filter_var($return["data"]["default_alert_email"], FILTER_VALIDATE_EMAIL)) {
                $return["errors"][] = l('error_default_alert_email_incorrect', 'contact_us');
            }
        }

        return $return;
    }

    public function getSettings()
    {
        $data = $this->ci->cache->get(CONTACT_REASONS_TABLE, 'getSettings', function () {
            $ci = &get_instance();
            $data = [
                "default_alert_email" => $ci->pg_module->get_module_config('contact_us', 'default_alert_email'),
            ];
            return $data;
        });
        return $data;
    }

    public function setSettings($data)
    {
        foreach ($data as $setting => $value) {
            $this->ci->pg_module->set_module_config('contact_us', $setting, $value);
        }
        $this->ci->cache->delete(CONTACT_REASONS_TABLE, 'getSettings');
        return;
    }

    public function sendContactForm($data)
    {
        $return = ["errors" => [], "data" => []];

        $this->ci->load->model('Notifications_model');

        if (!empty($data["reason_data"]) && !empty($data["reason_data"]["mails"])) {
            $mails = $data["reason_data"]["mails"];
        } else {
            $mails[] = $this->ci->pg_module->get_module_config('contact_us', 'default_alert_email');
        }

        if (empty($mails)) {
            $return["errors"][] = l('error_no_recipients', 'contact_us');
        } else {
            foreach ($mails as $mail) {
                $send_data = $this->ci->Notifications_model->send_notification($mail, 'contact_us_form', $data);
                if (!empty($send_data["errors"])) {
                    foreach ($send_data["errors"] as $error) {
                        $return["errors"][] = $error;
                    }
                }
            }
        }

        return $return;
    }

    private function checkBadwords($string)
    {
        $this->ci->load->model('moderation/models/Moderation_badwords_model');

        return $this->ci->Moderation_badwords_model->check_badwords($this->_moderation_type, $string);
    }

    public function validateContactForm($data)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["user_name"])) {
            $return["data"]["user_name"] = trim(strip_tags($data["user_name"]));

            if (empty($return["data"]["user_name"])) {
                $return["errors"]['user_name'] = l('error_user_name_incorrect', 'contact_us');
            } elseif ($this->checkBadwords($return['data']['user_name'])) {
                $return['errors']['user_name'] = l('error_badwords_message', 'contact_us');
            }
        }

        if (isset($data["user_email"])) {
            $return["data"]["user_email"] = trim(strip_tags($data["user_email"]));

            if (!filter_var($return["data"]["user_email"], FILTER_VALIDATE_EMAIL)) {
                $return["errors"]['user_email'] = l('error_user_email_incorrect', 'contact_us');
            }
        }

        if (isset($data["subject"])) {
            $return["data"]["subject"] = trim(strip_tags($data["subject"]));

            if (empty($return["data"]["subject"])) {
                $return["errors"]['subject'] = l('error_subject_incorrect', 'contact_us');
            } elseif ($this->checkBadwords($return['data']['subject'])) {
                $return['errors']['subject'] = l('error_badwords_message', 'contact_us');
            }
        }

        if (isset($data["message"])) {
            $return["data"]["message"] = trim(strip_tags($data["message"]));

            if (empty($return["data"]["message"])) {
                $return["errors"]['message'] = l('error_message_incorrect', 'contact_us');
            } elseif ($this->checkBadwords($return['data']['message'])) {
                $return['errors']['message'] = l('error_badwords_message', 'contact_us');
            }
        }

        if (isset($data["id_reason"])) {
            $return["data"]["id_reason"] = intval($data["id_reason"]);
            if (!empty($return["data"]["id_reason"])) {
                $return["data"]["reason_data"] = $this->get_reason_by_id($return["data"]["id_reason"]);
                $return["data"]["reason"] = $return["data"]["reason_data"]["name"];
            } else {
                $return["data"]["reason"] = l('no_reason_filled', 'contact_us');
            }
        }

        if (isset($data["captcha_code"])) {
            $this->ci->load->model('start/models/Start_captcha_model');
            if (
                $this->ci->Start_captcha_model->
                isCaptcha($data['captcha_code']) === false
            ) {
                $return["errors"]['captcha_code'] = l('error_captcha_code_incorrect', self::MODULE_GID);
            }
        }

        $data["data"]["form_date"] = date("Y-m-d H:i:s");

        return $return;
    }

    ////// seo
    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        } else {
            $actions = ['index'];
            $return = [];
            foreach ($actions as $action) {
                $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
            }

            return $return;
        }
    }

    public function getSeoSettingsInternal($method, $lang_id = '')
    {
        if ($method == "index") {
            return [
                'templates'   => [],
                'url_vars'    => [],
                'url_postfix' => [],
                'optional'    => [],
            ];
        }
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        $user_data = [];

        if ($var_name_from == $var_name_to) {
            return $value;
        }

        show_404();
    }

    public function getSitemapXmlUrls($generate = true)
    {
        $this->ci->load->helper('seo');
        $user_settings = $this->ci->pg_seo->get_settings('user', 'contact_us', 'index');
        if (!$user_settings['noindex']) {
            if ($generate === true) {
                $languages = $this->ci->pg_language->languages;
                $this->ci->pg_seo->set_lang_prefix('user');
                foreach ($languages as $lang_id => $lang_data) {
                    if ($this->ci->pg_language->is_active($lang_id) === true) {
                        $lang_code = $this->ci->pg_language->get_lang_code_by_id($lang_id);
                        $this->ci->pg_seo->set_lang_prefix('user', $lang_code);
                        $return[] = [
                            "url"      => rewrite_link('contact_us', 'index', [], false, $lang_code),
                            "priority" => $user_settings['priority'],
                            "page" => 'index',
                        ];
                    }
                }
            } else {
                $return[] = [
                        "url"      => rewrite_link('contact_us', 'index'),
                        "priority" => $user_settings['priority'],
                        "page" => 'index',
                ];
            }
        }

        return $return;
    }

    public function getSitemapUrls()
    {
        $this->ci->load->helper('seo');
        $auth = $this->ci->session->userdata("auth_type");

        $block[] = [
            "name"      => l('header_contact_us_form', 'contact_us'),
            "link"      => rewrite_link('contact_us', 'index'),
            "clickable" => true,
        ];

        return $block;
    }

    ////// banners callback method
    public function bannerAvailablePages()
    {
        $return[] = ["link" => "contact_us/index", "name" => l('header_contact_us_form', 'contact_us')];

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_banner_available_pages' => 'bannerAvailablePages',
            'get_seo_settings' => 'getSeoSettings',
            'get_reason_count' => 'getReasonCount',
            'delete_reason' => 'deleteReason',
            'get_reason_by_id' => 'getReasonById',
            'get_reason_list' => 'getReasonList',
            'get_settings' => 'getSettings',
            'request_seo_rewrite' => 'requestSeoRewrite',
            'set_settings' => 'setSettings',
            'validate_contact_form' => 'validateContactForm',
            'send_contact_form' => 'sendContactForm',
            'save_reason' => 'saveReason',
            'validate_reason' => 'validateReason',
            'validate_settings' => 'validateSettings',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'get_sitemap_urls' => 'getSitemapUrls',
            'format_reasons' => 'formatReasons',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
