<?php

declare(strict_types=1);

namespace Pg\modules\mobile\controllers;

use Pg\Libraries\View;
use Pg\modules\mobile\models\MobileModel;
use Pg\modules\users\models\UsersModel;

/**
 * Mobile version admin controller
 *
 * @package PG_Dating
 * @subpackage application
 * @category modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class AdminMobile extends \Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['MobileModel', 'MenuModel']);
        $this->MenuModel->setMenuActiveItem('admin_menu', 'add_ons_items');
    }

    public function index()
    {
        $menu_data = $this->MenuModel->getMenuByGid('admin_menu');
        $menu_item = $this->MenuModel->getMenuItemByGid('mobile_menu_item', $menu_data["id"]);

        $user_type = $this->session->userdata("user_type");
        if ($user_type == "admin") {
            $menu_data["check_permissions"] = false;
            $permissions = [];
        } else {
            $menu_data["check_permissions"] = true;
            $permissions = $this->session->userdata("permission_data");
        }
        $sections = $this->MenuModel->getMenuActiveItemsList($menu_data["id"], $menu_data["check_permissions"], ['moderate_sections' => 'page_sections'], $menu_item["id"], $permissions);

        $this->view->setHeader(l('admin_header_mobile', MobileModel::MODULE_GID));
        $this->view->assign("options", $sections);
        $this->view->render('menu_list', 'admin', 'start');
    }

    public function appLinks()
    {
        if (filter_input(INPUT_POST, 'btn_save')) {
            $validation_args = [
                'android_url' => FILTER_SANITIZE_URL,
                'ios_url'     => FILTER_SANITIZE_URL,
            ];
            $settings = filter_input_array(INPUT_POST, $validation_args);
            $this->MobileModel->setSettings($settings);
        } else {
            $settings = $this->MobileModel->getSettings();
        }

        $this->view->setHeader(l('sett_app_links', MobileModel::MODULE_GID));
        $this->view->assign('mobile_settings', $settings);
        $this->view->render('links');
    }

    public function billingSettings()
    {
        $api_key = $this->pg_module->get_module_config('mobile', 'api_key');
        $client_id = $this->pg_module->get_module_config('mobile', 'client_id');
        $client_secret = $this->pg_module->get_module_config('mobile', 'client_secret');

        if ($this->input->post('btn_save')) {
            $settings = $this->input->post("settings", true);

            $api_key = $settings['api_key'];
            $client_id = $settings['client_id'];
            $client_secret = $settings['client_secret'];

            $this->pg_module->set_module_config('mobile', 'api_key', $api_key);
            $this->pg_module->set_module_config('mobile', 'client_id', $client_id);
            $this->pg_module->set_module_config('mobile', 'client_secret', $client_secret);
        }

        if (!empty($client_id) && $client_id != "") {
            $refresh_link = "https://accounts.google.com/o/oauth2/auth?client_id=" . $client_id . "&response_type=code&redirect_uri=" . site_url() . "mobile/oauthCallback&scope=https://www.googleapis.com/auth/androidpublisher&approval_prompt=force&access_type=offline";
            $this->view->assign("refresh_link", $refresh_link);
        }

        $this->view->assign("api_key", $api_key);
        $this->view->assign("client_id", $client_id);
        $this->view->assign("client_secret", $client_secret);

        $this->view->setHeader(l('sett_billing', MobileModel::MODULE_GID));
        $this->view->assign("section", "settings");
        $this->view->render("billing_settings");
    }

    public function productList()
    {
        $data = $this->MobileModel->getProductList(['android', 'ios'], 'account');
        //TODO remove
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $data[$key]['name'] = l('product_' . $value["id"], 'mobile_product');
            }
        }
        $this->view->setHeader(l('sett_billing', MobileModel::MODULE_GID));
        $this->view->assign("list", $data);
        $this->view->assign("section", "product_list");
        $this->view->render("billing_settings");
    }

    public function productEdit($id = null)
    {
        if (!empty($id)) {
            $data = $this->MobileModel->getProductById($id);
            foreach ($this->MobileModel->languages as $lang_id => $lang_data) {
                $validate_lang[$lang_id] = l('product_' . $data["id"], 'mobile_product', $lang_id);
            }
        } else {
            $data = [];
        }

        $cur_lang = $this->pg_language->current_lang_id;

        if ($this->input->post('btn_save')) {
            $data = [
                "type" => $this->input->post("type", true),
                "model" => 'account',
                "sku" => $this->input->post("sku", true),
                "price" => abs(floatval($this->input->post('price', true))),
            ];
            $langs = $this->input->post("langs", true);
            if (empty($data['type']) || empty($data['sku']) || empty($data['price']) || empty($langs[$cur_lang])) {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_add_product', 'mobile'));
            } else {
                $this->MobileModel->saveProduct($id, $data, $langs);
                $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_add_product', 'mobile'));
                redirect(site_url() . "admin/mobile/productList");
            }
        }

        // languages
        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign('languages_count', count($this->pg_language->languages));
        $this->view->assign('cur_lang', $cur_lang);

        if (!empty($validate_lang)) {
            $this->view->assign('validate_lang', $validate_lang);
        }

        $this->view->assign('data', $data);

        $this->view->assign("section", "product_list");
        $this->view->render("edit_product");
    }

    public function productDelete($id = null)
    {
        if (is_null($id)) {
            return;
        }
        $this->MobileModel->deleteProduct((int)$id);

        $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_delete_product', 'mobile'));
        redirect(site_url() . "admin/mobile/productList");
    }

    /**
     * Settings Push Notifications
     *
     * @return mixed
     */
    public function pushNotificationsSettings()
    {
        if (filter_input(INPUT_POST, 'btn_save')) {
            $validation_args = [
                'firebase_api_key' => FILTER_SANITIZE_STRING,
                'firebase_auth_domain' => FILTER_SANITIZE_STRING,
                'firebase_database_url' => FILTER_SANITIZE_STRING,
                'firebase_project_id' => FILTER_SANITIZE_STRING,
                'firebase_storage_bucket' => FILTER_SANITIZE_STRING,
                'firebase_messaging_sender_id' => FILTER_SANITIZE_STRING,
                'firebase_public_vapid_key' => FILTER_SANITIZE_STRING,
                'firebase_service_key' => FILTER_SANITIZE_STRING,
                'firebase_app_id'   => FILTER_SANITIZE_STRING,
                'use_notifications' => FILTER_VALIDATE_BOOLEAN,
            ];
            $settings = filter_input_array(INPUT_POST, $validation_args);
            $this->MobileModel->setSettings($settings);

            foreach ($settings as &$setting) {
                if (!empty($setting) && is_string($setting)) {
                    $setting = html_entity_decode($setting, ENT_QUOTES);
                }
            }
        } else {
            $settings = $this->MobileModel->getSettings();
        }

        $this->view->setHeader(l('sett_fcm_settings', MobileModel::MODULE_GID));
        $this->view->assign('mobile_settings', $settings);

        $this->view->assign('section', 'settings');
        $this->view->render('push_notifications_settings');
    }

    public function pushNotificationsList()
    {
        $this->load->model('mobile/models/MobilePushNotificationsModel');

        if (filter_input(INPUT_POST, 'btn_save')) {
            $post_data = $this->input->post('push', true);
            $this->MobilePushNotificationsModel->setPushNotifications($post_data);
        }

        $push_notifications = $this->MobilePushNotificationsModel->getPushNotificationsList([], true);
        $this->view->assign('push_notifications', $push_notifications);
        $this->view->assign('section', 'list');
        $this->view->render('push_notifications_list');
    }

    public function subscriptionList()
    {
        $data = $this->MobileModel->getProductList(['android', 'ios'], 'subscription');
        //TODO remove
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $data[$key]['name'] = l('product_' . $value["id"], 'mobile_product');
            }
        }

        $this->view->setHeader(l('sett_billing', MobileModel::MODULE_GID));
        $this->view->assign("list", $data);
        $this->view->assign("section", "subscription_list");
        $this->view->render("billing_settings");
    }

    public function subscriptionEdit($id = null)
    {
        if (!empty($id)) {
            $data = $this->MobileModel->getProductById($id);
            foreach ($this->pg_language->languages as $lang_id => $lang_data) {
                $validate_lang[$lang_id] = l('product_' . $data["id"], 'mobile_product', $lang_id);
            }
        } else {
            $data = [];
        }

        $cur_lang = $this->pg_language->current_lang_id;

        if ($this->input->post('btn_save')) {
            $data = [
                "type" => $this->input->post("type", true),
                "model" => 'subscription',
                "sku" => trim(strip_tags($this->input->post("sku", true))),
                "price" => abs((float)$this->input->post('price', true)),
                "group_period_id" => trim($this->input->post('group_period_id', true)),
            ];
            if (empty($data['type']) || empty($data['sku']) || empty($data['price']) || empty($data['group_period_id'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, 'Error');
            } else {
                $this->MobileModel->saveProduct($id, $data);
                $this->system_messages->addMessage(View::MSG_SUCCESS, 'Subscription was successfully added');
                redirect(site_url() . "admin/mobile/subscription_list");
            }
        }

        // languages
        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign('languages_count', count($this->pg_language->languages));
        $this->view->assign('cur_lang', $cur_lang);

        if (!empty($validate_lang)) {
            $this->view->assign('validate_lang', $validate_lang);
        }

        $this->view->assign('data', $data);

        $this->load->model(['Users_model', 'Access_permissions_model',
            'access_permissions/models/Access_permissions_groups_model',
            'access_permissions/models/Access_permissions_settings_model',
            'access_permissions/models/Access_permissions_users_model',
        ]);
        $user_types = $this->Users_model->getUserTypes();
        $groups = $this->Access_permissions_groups_model->formatGroups(
            $this->Users_model->getUserTypesGroups(['where' => ['is_active' => 1]])
        );
        $subscription_type = $this->Access_permissions_settings_model->getSubscriptionType('subscription_type');
        if ($subscription_type == 'user_types') {
            $periods = [];
            $period_user_type = [];

            foreach ($user_types as $user_type) {
                $user_type_periods = $this->Access_permissions_settings_model->getAccessData(
                    $this->Access_permissions_model->roles['user']
                )->getPriceGroups($user_type);

                foreach ($user_type_periods as $v) {
                    $period_user_type[] = $user_type;
                }

                $periods = array_merge($periods, $user_type_periods);
            }

            $this->view->assign('period_user_type', $period_user_type);
            $this->view->assign('subscription_user_type', true);
        } else {
            $periods = $this->Access_permissions_settings_model->getAccessData(
                $this->Access_permissions_model->roles['user']
            )->getPriceGroups('user');
        }
        $this->view->assign('groups', $this->Access_permissions_model->formatGroups($groups, $periods));

        $this->view->assign("section", "subscription_list");
        $this->view->render("edit_subscription");
    }

    /**
     * Subscription delete
     *
     * @param integer $id subscription identifier
     *
     * @return void
     */
    public function subscriptionDelete($id = null)
    {
        if (is_null($id)) {
            return;
        }

        $this->MobileModel->deleteProduct((int)$id);

        $this->system_messages->addMessage(View::MSG_SUCCESS, 'Subscription was successfully removed');

        redirect(site_url() . "admin/mobile/subscription_list");
    }

    /**
     * Service list
     *
     * @return mixed
     */
    public function serviceList()
    {
        $data = $this->MobileModel->getProductList(['android', 'ios'], 'service');
        //TODO remove
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $data[$key]['name'] = l('product_' . $value["id"], 'mobile_product');
            }
        }

        $this->view->setHeader(l('sett_billing', MobileModel::MODULE_GID));
        $this->view->assign("list", $data);
        $this->view->assign("section", "service_list");
        $this->view->render("billing_settings");
    }

    /**
     * Service edit
     *
     * @param integer $id service identifier
     *
     * @return mixed
     */
    public function serviceEdit($id = null)
    {
        if (!empty($id)) {
            $data = $this->MobileModel->getProductById($id);
            foreach ($this->pg_language->languages as $lang_id => $lang_data) {
                $validate_lang[$lang_id] = l('product_' . $data["id"], 'mobile_product', $lang_id);
            }
        } else {
            $data = [];
        }

        $cur_lang = $this->pg_language->current_lang_id;

        if ($this->input->post('btn_save')) {
            $data = [
                "type" => $this->input->post("type", true),
                "model" => 'service',
                "sku" => trim(strip_tags($this->input->post("sku", true))),
                "price" => abs((float)$this->input->post('price', true)),
                "service_gid" => trim(strip_tags($this->input->post("service_gid", true))),
            ];
            if (empty($data['type']) || empty($data['sku']) || empty($data['price']) || empty($data['service_gid'])) {
                $this->system_messages->addMessage(View::MSG_ERROR, 'Error');
            } else {
                $this->MobileModel->saveProduct($id, $data);
                $this->system_messages->addMessage(View::MSG_SUCCESS, 'Service was successfully added');
                redirect(site_url() . "admin/mobile/service_list");
            }
        }

        // languages
        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign('languages_count', count($this->pg_language->languages));
        $this->view->assign('cur_lang', $cur_lang);

        if (!empty($validate_lang)) {
            $this->view->assign('validate_lang', $validate_lang);
        }

        $this->view->assign('data', $data);

        $this->load->model(['Services_model']);

        $this->view->assign("services", $this->Services_model->getServiceList([
            'where' => [
                'type' => 'tariff',
                'status' => 1,
            ],
        ]));

        $this->view->assign("section", "service_list");
        $this->view->render("edit_service");
    }

    /**
     * Service delete
     *
     * @param integer $id service identifier
     *
     * @return void
     */
    public function serviceDelete($id = null)
    {
        if (is_null($id)) {
            return;
        }

        $this->MobileModel->deleteProduct((int)$id);

        $this->system_messages->addMessage(View::MSG_SUCCESS, 'Service was successfully removed');

        redirect(site_url() . "admin/mobile/service_list");
    }

    /**
     * Push notifications settings
     *
     * @return void
     */
    public function sendPushNotifications()
    {
        $this->load->model('Properties_model');
        $user_types = $this->Properties_model->get_property('user_type');
        $this->view->assign('user_types', $user_types);

        $user_type = $this->input->post('user_type', true);
        $current_settings["last_active"]["from"] = $this->input->post('last_active_from', true);
        $current_settings["last_active"]["to"]   = $this->input->post('last_active_to', true);
        $current_settings["age_min"] = $this->input->post('age_min', true);
        $current_settings["age_max"] = $this->input->post('age_max', true);
        $current_settings["id"] = $this->input->post('id', true);

        $attrs = [];
        if (!empty($current_settings["last_active"]["from"])) {
            $attrs["where_sql"][] = "date_last_activity >= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings["last_active"]["from"])
            ) . "'";
            $this->view->assign('last_active_from', $current_settings["last_active"]["from"]);
        }
        if (!empty($current_settings["last_active"]["to"])) {
            $attrs["where_sql"][] = "date_last_activity <= '" . date(
                UsersModel::DB_DATE_SIMPLE_FORMAT,
                strtotime($current_settings["last_active"]["to"])
            ) . " 23:59:59'";
            $this->view->assign('last_active_to', $current_settings["last_active"]["to"]);
        }
        if (!empty($current_settings["age_min"])) {
            $attrs["where_sql"][] = "age >= " . $current_settings["age_min"];
            $this->view->assign('age_min', $current_settings["age_min"]);
        }
        if (!empty($current_settings["age_max"])) {
            $attrs["where_sql"][] = "age <= " . $current_settings["age_max"];
            $this->view->assign('age_max', $current_settings["age_max"]);
        }
        if ($user_type != 'all' && $user_type) {
            $attrs["where"]["user_type"] = $user_type;
            $this->view->assign('user_type', $user_type);
        }
        if (!empty($current_settings["id"])) {
            $attrs["where"]["id"] = $current_settings["id"];
            $this->view->assign('id', $current_settings["id"]);
        }

        $registered_user_ids = $this->MobileModel->getRegisteredUserIds();

        $users = $this->Users_model->getUsersList(null, null, null, $attrs, $registered_user_ids);
        $users_ids = array_map(static function ($value) {
            return $value['id'];
        }, $users);
        $users_count = count($users_ids);

        if ($this->input->post('btn_send', true)) {
            $message = $this->input->post('message', true);
            $this->load->model('mobile/models/MobileUsersPushNotificationsModel');
            foreach ($users_ids as $key => $contact_id) {
                $user = $this->Users_model->getUserById($contact_id);
                $this->MobileUsersPushNotificationsModel->pushNotification([
                    'id_user' => (int)$contact_id,
                    'title' => 'Admin has sent you a message',
                    'body' => (string)str_replace("%username%", $user['nickname'], $message),
                    'message' => (string)str_replace("%username%", $user['nickname'], $message),
                    'activity' => 'TicketsActivity',
                    'module' => 'mobile',
                    'gid' => 'admin_ticket',
                ]);
            }
            $this->system_messages->addMessage(
                View::MSG_SUCCESS,
                l('success_send_form', 'tickets')
            );
        }

        $this->view->setHeader(l('sett_send_push', MobileModel::MODULE_GID));
        $this->view->assign('users_count', $users_count);
        $this->view->render('send_notifications');
    }
}
