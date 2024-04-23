<?php

declare(strict_types=1);

namespace Pg\modules\start\controllers;

use Pg\Libraries\View;
use Pg\modules\start\models\StartModel;

/**
 * Start admin side controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class AdminStart extends \Controller
{
    /**
     * link to CodeIgniter object
     *
     * @var object
     */
    private $numerics_settings = [
        "start" => [
            'admin_items_per_page',
            'index_items_per_page',
        ],
        "mailbox" => [
            'items_per_page',
            'attach_limit',
        ],
        "news" => [
            'userside_items_per_page',
        ],
        "payments" => [
            'items_per_page',
        ],
        'users' => [
            'items_per_page',
        ],
        'wall_events' => [
            'items_per_page',
        ],
        'media' => [
            'items_per_page',
        ],
        'banners' => [
            'items_per_page',
        ],
    ];
    private $other_settings = [
        "countries" => [
            ['var' => 'output_country_format', 'type' => 'text'],
            ['var' => 'output_region_format', 'type' => 'text'],
            ['var' => 'output_city_format', 'type' => 'text'],
        ],
        'chatbox' => [
            ['var' => 'chatbox_settings_send_btn','values' => ['enter','shift_enter'], 'type' => 'select'],
        ]
    ];
    private $date_formats = [
        'date_literal',
        'date_time_numeric',
        'date_time_literal',
    ];
    private $date_formats_pages = [
        'date_literal' => [
            'users/profile/',
            'users/my_visits/',
            'users/my_guests/',
            'users/account/services/',
            'users/view/',
            'users/my_guests/',
            'users/my_visits/',
        ],
        'date_time_literal' => [
            'admin/reviews/index/',
            'admin/reviews/types/',
            'admin/ausers/index/',
            'admin/users/index/',
            'admin/payments/index/',
            'admin/menu/index/',
            'admin/notifications/index/',
            'admin/notifications/templates/',
            'admin/news/index/',
            'admin/news/feeds/',
            'admin/mail_list/users/',
            'admin/seo/robots/',
            'mailbox/index/ (mailbox)',
            'start/homepage/ (wall events)',
            'users/profile/wall/ (wall events)',
            'users/view/ (wall events)',
            'friendlist/',
            'users/my_guests/',
            'users/my_visits/',
            'users/account/services/',
            'payments/statistic',
            'news/index/',
            'news/view/',
            'im',
            'comments',
            'media',
        ],
    ];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $settings_for_modules = array_unique(array_merge(array_keys($this->numerics_settings), array_keys($this->other_settings)));
        foreach ($settings_for_modules as $module) {
            if (!$this->pg_module->is_module_installed($module)) {
                unset($this->numerics_settings[$module], $this->other_settings[$module]);
            }
        }
    }

    public function index()
    {
        if ($this->session->userdata("auth_type") != 'admin') {
            redirect(site_url() . "admin/ausers/login");
        }

        $this->view->setHeader(l("header_admin_homepage", 'start', null, null, ['name' => $this->session->userdata('name')]));
        if ($this->session->userdata("user_type") == "moderator") {
            $this->view->render('index_moderator');
        } else {
            $this->view->render('index');
        }
    }

    public function error($error_type = '', $request_method = '')
    {
        if ($request_method == 'ajax') {
            $this->view->assign('ajax', '1');
        }
        if ($error_type == 'moderator') {
            $this->system_messages->addMessage(View::MSG_ERROR, l('moderator_access_error', StartModel::MODULE_GID));
        }
        $this->view->render('error');
    }

    public function modLogin()
    {
        $this->load->model('Menu_model');
        $this->Menu_model->set_menu_active_item('admin_menu', 'add_ons_items');

        $data["action"] = site_url() . "admin/install/login";
        $this->view->assign("data", $data);

        $this->view->setHeader(l("header_modinstaller_login", 'start'));
        $this->view->render('modules_login');

    }

    public function menu($menu_item_gid)
    {
        $this->load->model('Menu_model');
        $this->Menu_model->set_menu_active_item('admin_menu', $menu_item_gid);

        // add link to menu
        $menu_data = $this->Menu_model->get_menu_by_gid('admin_menu');
        $menu_item = $this->Menu_model->get_menu_item_by_gid($menu_item_gid, $menu_data["id"]);

        $user_type = $this->session->userdata("user_type");
        if ($user_type == "admin") {
            $menu_data["check_permissions"] = false;
            $permissions = [];
        } else {
            $menu_data["check_permissions"] = true;
            $permissions = $this->session->userdata("permission_data");
        }

        $menu_items = $this->Menu_model->get_menu_active_items_list($menu_data["id"], $menu_data["check_permissions"], ['moderate_sections' => 'page_sections'], $menu_item["id"], $permissions);

        $this->view->assign("menu", $menu_item);
        $this->view->assign("options", $menu_items);
        $this->view->setHeader($menu_item["value"]);
        $this->view->render('menu_list');

    }

    /**
     * CAPTCHA settings
     *
     * @return void
     */
    public function captcha()
    {
        $this->load->model(['Menu_model', 'start/models/Start_captcha_model']);

        if ($this->input->post('validGoogleCaptchaToken', true)) {
            $token      = trim($this->input->post('validGoogleCaptchaToken', true));
            $secretKye  = trim($this->input->post('validGoogleCaptchaSecretKye', true));
            echo  json_encode($this->Start_captcha_model->isGoogleCaptcha($token, ['secret_key' => $secretKye], true));

            return;
        }

        $this->Menu_model->set_menu_active_item('admin_menu', 'system-items');
        $validate = [];
        if ($this->input->post('data')) {
            $post_data = $this->input->post('data', true);
            $validate = $this->Start_captcha_model->validateCaptcha($post_data);
            if (!empty($validate['error'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, $validate['error']);
            } else {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_settings_saved', StartModel::MODULE_GID));
                $this->Start_captcha_model->setCaptcha($validate);
            }
        }

        $captcha = $this->Start_captcha_model->formatCaptcha(
            $this->Start_captcha_model->getCaptcha($validate)
        );

        $captcha['types'] = $this->Start_captcha_model->captcha_types;
        $this->view->setHeader(l("admin_header_settings_captcha", StartModel::MODULE_GID));
        $this->view->setBackLink(site_url('admin/start/menu/system-items'));
        $this->view->assign("captcha", $captcha);
        $this->view->render('captcha_settings');
    }

    public function settings($section = "overview")
    {
        $this->load->model('Menu_model');
        $this->Menu_model->set_menu_active_item('admin_menu', 'system-items');

        if ($this->input->post('btn_save')) {
            $errors = [];
            $post_data = $this->input->post('settings', true);

            if ($section == 'numerics') {
                foreach ($this->numerics_settings as $module => $settings) {
                    foreach ($settings as $var) {
                        $value = !empty($post_data[$module][$var]) ? intval($post_data[$module][$var]) : 0;
                        if ($value <= 0) {
                            $errors[] = l('error_numerics_empty', 'start', '', 'text', ['field' => l($module . "_" . $var . "_field", "start")]);
                        } else {
                            $this->pg_module->set_module_config($module, $var, $value);
                        }
                    }
                }
            } elseif ($section == 'countries') {
                $save_data = [];

                if (isset($post_data['output_country_format'])) {
                    $save_data['output_country_format'] = trim(strip_tags($post_data['output_country_format']));
                    if (empty($save_data['output_country_format'])) {
                        $errors[] = l('error_output_country_format_empty', 'start');
                    }
                }

                if (isset($post_data['output_region_format'])) {
                    $save_data['output_region_format'] = trim(strip_tags($post_data['output_region_format']));
                    if (empty($save_data['output_region_format'])) {
                        $errors[] = l('error_output_region_format_empty', 'start');
                    }
                }

                if (isset($post_data['output_city_format'])) {
                    $save_data['output_city_format'] = trim(strip_tags($post_data['output_city_format']));
                    if (empty($save_data['output_city_format'])) {
                        $errors[] = l('error_output_city_format_empty', 'start');
                    }
                }

                if (empty($errors)) {
                    foreach ($save_data as $var => $value) {
                        $this->pg_module->set_module_config($section, $var, $value);
                    }
                }
            } else {
                $settings = $this->other_settings[$section];
                foreach ($settings as $subsection => $var) {
                    $field_type = 'text';
                    if (is_array($var)) {
                        $field_type = $var['type'];
                        $field_values = !empty($var['values']) ? $var['values'] : [];
                        $var = $var['var'];
                    }
                    $value = !empty($post_data[$var]) ? $post_data[$var] : '';
                    $error = '';
                    if (!empty($error)) {
                        $errors[] = $error;
                    } else {
                        $this->pg_module->set_module_config($section, $var, $value);
                    }
                }
            }

            if (empty($errors)) {
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_update_numerics_data', 'start'));
            } else {
                $this->system_messages->addMessage(View::MSG_ERROR, $errors);
            }
        }

        if ($section == 'overview') {
            foreach ($this->numerics_settings as $module => $settings) {
                $settings_data["numerics"][$module]["name"] = l($module . "_settings_module", "start");
                foreach ($settings as $var) {
                    $settings_data["numerics"][$module]['vars'][] = [
                        "field"      => $var,
                        "field_name" => l($module . "_" . $var . "_field", "start"),
                        "value"      => $this->pg_module->get_module_config($module, $var),
                    ];
                }
            }
            foreach ($this->other_settings as $module => $settings) {
                $settings_data["other"][$module]["name"] = l($module . "_settings_module", "start");
                foreach ($settings as $var) {
                    $field_type = 'text';
                    $field_values = [];
                    if (is_array($var)) {
                        $field_type = $var['type'];
                        $field_values = !empty($var['values']) ? $var['values'] : [];
                        $var = $var['var'];
                    }
                    $vars_value = $this->pg_module->get_module_config($module, $var);
                    $vars_value_int = intval($vars_value);
                    if (!empty($field_values[$vars_value_int])) {
                        $vars_value_name = l($module . "_" . $var . "_" . $field_values[$vars_value_int] . "_value", "start");
                    } else {
                        $vars_value_name = '';
                    }
                    $settings_data["other"][$module]['vars'][] = [
                        "field"        => $var,
                        "field_name"   => l($module . "_" . $var . "_field", "start"),
                        "value"        => $vars_value,
                        "value_name"   => $vars_value_name,
                        'field_type'   => $field_type,
                        'field_values' => $field_values,
                    ];
                }
            }
            $this->view->setHeader(l("admin_header_settings_overview", 'start'));
        } elseif ($section == 'numerics') {
            foreach ($this->numerics_settings as $module => $settings) {
                $settings_data[$module]["name"] = l($module . "_settings_module", "start");
                foreach ($settings as $var) {
                    $settings_data[$module]['vars'][] = [
                        "field"      => $var,
                        "field_name" => l($module . "_" . $var . "_field", "start"),
                        "value"      => $this->pg_module->get_module_config($module, $var),
                    ];
                }
            }
            $this->view->setHeader(l("admin_header_settings_numerics", 'start'));
        } elseif ($section == 'date_formats') {
            $this->view->assign('date_formats_pages', $this->date_formats_pages);
            $settings_data["name"] = l($section . "_settings_module", "start");
            foreach ($this->date_formats as $var) {
                $settings_data['vars'][] = [
                    "field"      => $var,
                    "field_name" => l($section . "_" . $var . "_field", "start"),
                    "value"      => $this->pg_date->strftime($this->pg_date->get_format($var, 'st'), time()),
                ];
            }
            $this->view->setHeader(l("admin_header_settings_date_formats", 'start'));
        } else {
            $settings_data["name"] = l($section . "_settings_module", "start");
            foreach ($this->other_settings[$section] as $var) {
                $field_type = 'text';
                if (is_array($var)) {
                    $field_type = $var['type'];
                    $field_values = !empty($var['values']) ? $var['values'] : [];
                    $var = $var['var'];
                }
                $vars_value = $this->pg_module->get_module_config($section, $var);
                $vars_value_int = intval($vars_value);
                if (!empty($field_values[$vars_value_int])) {
                    $vars_value_name = l($section . "_" . $var . "_" . $field_values[intval($vars_value)] . "_value", "start");
                } else {
                    $vars_value_name = '';
                }

                $settings_data['vars'][] = [
                    "field"        => $var,
                    "field_name"   => l($section . "_" . $var . "_field", "start"),
                    "value"        => $vars_value,
                    "value_name"   => $vars_value_name,
                    'field_type'   => $field_type,
                    'field_values' => $field_values,
                ];
            }
            if ($section === 'countries') {
                $this->view->setHeader(l("admin_header_settings_countries", 'start'));
            } else {
                $this->view->setHeader(l("header_settings_numerics_list", 'start'));
            }
        }

        $this->view->assign("section", $section);
        $this->view->assign("settings_data", $settings_data);
        $this->view->assign("numerics_settings", $this->numerics_settings);
        $this->view->assign("other_settings", $this->other_settings);
        $this->view->render('numerics_list');

    }

    public function dateFormats($format_id)
    {
        if (!in_array($format_id, array_keys($this->date_formats))) {
            $this->settings('date_formats');
        }

        $this->load->model('Menu_model');
        $this->Menu_model->set_menu_active_item('admin_menu', 'system-items');

        if ($this->input->post('btn_save')) {
            $generic_tpl = '';

            $tpl = $this->input->post('tpl', true);
            $tpl = trim(strip_tags($tpl));
            if (empty($tpl)) {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_date_format_empty', 'start'));
            } else {
                // Fill $data with used patterns
                foreach ($this->pg_date->available_formats[$format_id] as $f_id => $available) {
                    $value = $this->input->post($f_id, true);
                    if (in_array($value, $available)) {
                        $data[$f_id] = $value;
                    }
                }
                $generic_tpl = $this->pg_date->create_generic_tpl($tpl, $data);
                $this->pg_date->save_format($generic_tpl, $format_id);
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_date_format_update', 'start'));
            }
        } else {
            $generic_tpl = $this->pg_module->get_module_config('start', 'date_format_' . $format_id);
        }

        $format = [
            'current'   => $this->pg_date->parse_generic_template($generic_tpl, 'js'),
            'available' => $this->pg_date->available_formats[$format_id],
            'name'      => l('date_formats_' . $format_id . '_field', 'start'),
            'gid'       => $format_id,
        ];
        $this->view->setHeader(l('header_settings_numerics_list', 'start'));
        $this->view->assign('section', 'date_formats');
        $this->view->assign('format', $format);
        $this->view->assign('settings_name', l('date_formats_settings_module', 'start'));
        $this->view->assign('other_settings', $this->other_settings);
        $this->view->render('date_formats');

    }

    public function ajaxGetExample()
    {
        $uf_tpl = $this->input->get('tpl', true);
        $format_id = $this->input->get('format_id', true);
        if (empty($uf_tpl) || empty($format_id)) {
            return false;
        }

        // Fill $data with used patterns
        foreach ($this->pg_date->available_formats[$format_id] as $f_id => $available) {
            $value = $this->input->get($f_id, true);
            if (in_array($value, $available)) {
                $data[$f_id] = $value;
            }
        }
        $generic_tpl = $this->pg_date->create_generic_tpl($uf_tpl, $data);
        echo $this->pg_date->strftime($generic_tpl, null, 'generic');
    }

    public function langInlineEditor($is_textarea = 0)
    {
        $this->view->assign("langs", $this->pg_language->languages);
        $this->view->assign('is_textarea', $is_textarea);
        $this->view->render('helper_lang_inline_editor');

    }

    public function wysiwygUploader($module = '', $id = 0, $upload_config_gid = '', $field = 'upload')
    {
        $module = trim(strip_tags($module));
        $id = intval($id);
        $upload_config_gid = trim(strip_tags($upload_config_gid));
        $field = trim(strip_tags($field));

        $this->load->model('Start_model');
        $upload = $this->Start_model->do_wysiwyg_upload($module, $id, $upload_config_gid, $field);
        $message = '';
        $url = '';
        if ($upload['error']) {
            $message = $upload['error'];
        } elseif ($upload['is_uploaded']) {
            $url = $upload['upload_url'];
        }
        $funcNum = intval($this->input->get('CKEditorFuncNum', true));
        $ckeditor = trim(strip_tags($this->input->get('CKEditor', true)));
        $langcode = trim(strip_tags($this->input->get('langCode', true)));
        echo("<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>");

    }

    public function geolocation()
    {
        $this->load->model('Menu_model');
        $this->Menu_model->set_menu_active_item('admin_menu', 'system-items');

        if ($this->input->post('btn_save')) {
            $geolocation_onoff = intval($this->input->post('geolocation_onoff', true));
            $this->pg_module->set_module_config('start', 'geolocation_onoff', $geolocation_onoff);
        } else {
            $geolocation_onoff = $this->pg_module->get_module_config('start', 'geolocation_onoff');
        }
        $this->view->assign('geolocation_onoff', $geolocation_onoff);

        $this->view->setHeader(l("header_settings_geolocation", 'start'));
        $this->view->render('geolocation_settings');

    }

    /**
     * Multilanguage copyrights' editing
     */
    public function copyright()
    {
        $this->load->model(['Menu_model', 'start/models/Start_Copyright_model']);
        $this->Menu_model->set_menu_active_item('admin_menu', 'system-items');
        $languages = $this->pg_language->languages;
        $lang_id = $this->pg_language->get_default_lang_id();

        $data = $this->Start_Copyright_model->getCopyright(true);
        if ($this->input->post('btn_save')) {
            $post_data = [];

            foreach ($languages as $lid => $lang_data) {
                $post_data['index_page_' . $lid] = $this->input->post('index_page_' . $lid, true);
                $post_data['internal_' . $lid] = $this->input->post('internal_' . $lid, true);
                $post_data['cpanel_' . $lid] = $this->input->post('cpanel_' . $lid);
            }
            $validate_data = $this->Start_Copyright_model->validateCopyright(['lang_id' => $lang_id, 'data' => $post_data]);
            if (!empty($validate_data['errors'])) {
                foreach ($validate_data['errors'] as $error) {
                    $this->system_messages->addMessage(View::MSG_ERROR, $error);
                }
            } else {
                $this->Start_Copyright_model->saveCopyright($validate_data['data']);
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_save_copyright', 'start'));

                $url = site_url() . 'admin/start/copyright/';
                redirect($url);
            }
            $data = array_merge($data, $post_data);
        }

        $this->view->assign('data', $data);
        $this->view->assign('languages', $languages);
        $this->view->assign('current_lang', $this->session->userdata('lang_id'));
        $this->view->setHeader(l('admin_header_settings_copyright', StartModel::MODULE_GID));
        $this->view->setBackLink(site_url('admin/start/menu/system-items'));
        $this->view->render('copyright');
    }
}
