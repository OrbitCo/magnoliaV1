<?php

declare(strict_types=1);

namespace Pg\modules\mobile\controllers;

/**
 * Mobile version API controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * */
class ApiMobile extends \Controller
{

    private $user_id;

    /**
     * ApiMobile constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MobileModel');

        $this->user_id = (int)$this->ci->session->userdata('user_id');
    }

    private function saveLang($lang_id = null)
    {
        if (!$lang_id) {
            $sess_lang_id = (int)$this->session->userdata('lang_id');
            $lang_id = !empty($sess_lang_id) ? $sess_lang_id : $this->pg_language->get_default_lang_id();
        }
        $this->session->set_userdata('lang_id', $lang_id);
        $this->session->sess_update();
        return $lang_id;
    }

    private function getAppUrls(): array
    {
        $settings = $this->MobileModel->getSettings();
        return [
            'android_url' => $settings['android_url'],
            'ios_url' => $settings['ios_url'],
        ];
    }

    private function getCssUrl(): string
    {
        $this->load->library('pg_theme');
        $theme_settings = $this->pg_theme->return_active_settings($this->pg_theme->get_current_theme_type());
        return $this->pg_theme->theme_default_url . $theme_settings['theme'] . '/sets/' . $theme_settings['scheme'] . '/css/';
    }

    private function getLogoPath()
    {
        $this->load->library('pg_theme');
        $theme_data = $this->pg_theme->format_theme_settings($this->router->class);
        return $theme_data['mini_logo']['path'];
    }

    /**
     * @api {post} /mobile/init Initialization mobile version
     * @apiGroup Mobile
     * @apiParam {int} [lang_id] language id
     * @apiParam {boolean} [is_app] is mobile application
     */
    public function init($lang_id = null)
    {
        $this->load->model(['Users_model', 'Properties_model', 'payments/models/Payment_currency_model']);

        $saved_lang_id = $this->saveLang($lang_id);

        $mconfig = [
            'favorites' => false,
            'friendlist' => false,
            'im' => false,
            'like_me' => false,
            'likes' => false,
        ];

        $modules = $this->pg_module->return_modules();

        foreach ($modules as $module) {
            $mconfig[$module['module_gid']] = $module['is_disabled'] ? false : true;
        }

        if ($mconfig['users']) {
            $mconfig['my_guests'] = true;
        }

        if ($mconfig['chats']) {
            $this->load->model('Chats_model');
            $chatActive = $this->Chats_model->getActive();
            $mconfig['videochat'] = !empty($chatActive) && $chatActive->getGid() == 'pg_videochat';
        }

        $data = [
            'data' => [
                'cssUrl' => $this->getCssUrl(),
                'cssFolderUrl' => $this->getCssUrl(),
                'siteUrl' => site_url(),
                'appUrls' => $this->getAppUrls(),
                'logo' => $this->getLogoPath(),
                'services_add_money' => site_url() . 'users/account/update/',
                'users_count' => $this->Users_model->getActiveUsersCount(),
                'is_use_notifications' => (bool)$this->MobileModel->getSettings()['use_notifications']
            ],
            'modules' => $mconfig,
            'l' => $this->MobileModel->langsReplace($this->pg_language->pages->return_module('mobile', $saved_lang_id)),
            'language' => $this->pg_language->get_lang_by_id($saved_lang_id),
            'languages' => $this->pg_language->languages,
            'userData' => false,
            'properties' => [
                'userTypes' => $this->Properties_model->getProperty('user_type', $saved_lang_id),
                'lookingUserTypes' => $this->Properties_model->getProperty('looking_user_type', $saved_lang_id),
                'age' => [
                    'min' => $this->pg_module->get_module_config('users', 'age_min'),
                    'max' => $this->pg_module->get_module_config('users', 'age_max'),
                ],
                'currency' => $this->Payment_currency_model->default_currency,
            ]
        ];

        if ($this->session->userdata('auth_type') == 'user') {
            $data['userData'] = $this->Users_model->getUserById($this->session->userdata('user_id'), true, false);
        }

        $data['not_editable_fields'] = $this->Users_model->fields_not_editable;
        if (!$this->pg_module->is_module_installed('perfect_match')) {
            $data['not_editable_fields'][] = 'looking_user_type';
            $data['not_editable_fields'][] = 'partner_age';
        }

        if (filter_input(INPUT_POST, 'is_app')) {
            $data['l'] = $this->pg_language->pages->return_module('mobile_app', $saved_lang_id);
            if (empty($data['l'])) {
                log_message('error', 'empty_app_langs');
            }
        } else {
            $data['l'] = $this->MobileModel->langsReplace(
                $this->pg_language->pages->return_module('mobile', $saved_lang_id)
            );
        }

        $data['data']['is_app'] = $this->MobileModel->isApp();
        $data['data']['is_demo'] = $_ENV['DEMO_MODE'];
        $data['subscription_direct'] = 1;
        $data['service_direct'] = 1;
        $this->set_api_content('data', $data);
    }

    /**
     * @api {post} /mobile/changeLang Change language
     * @apiGroup Mobile
     * @apiParam {int} lang_id language id
     * @apiParam {boolean} [is_app] is mobile application
     */
    public function changeLang()
    {
        $lang_id = filter_input(INPUT_POST, 'lang_id');

        if (!$lang_id) {
            log_message('error', 'languages API: Empty lang id');
            $this->set_api_content('error', l('api_error_empty_lang_id', 'languages'));
            return false;
        }

        $this->load->model(['Properties_model', 'Users_model']);

        if ($this->session->userdata('auth_type') == 'user') {
            $id_user = (int)$this->session->userdata('user_id');
            $this->Users_model->saveUser($this->session->userdata('user_id'), ['lang_id' => $lang_id]);
        }

        if (filter_input(INPUT_POST, 'is_app')) {
            $langs = $this->pg_language->pages->return_module('mobile_app', $lang_id);
        } else {
            $langs = $this->MobileModel->langsReplace($this->pg_language->pages->return_module('mobile', $lang_id));
        }

        $this->session->set_userdata('lang_id', $lang_id);
        $this->session->sess_update();
        $this->set_api_content('data', [
            'language' => $this->pg_language->get_lang_by_id($lang_id),
            'l' => $langs,
            'properties' => [
                'userTypes' => $this->Properties_model->get_property('user_type', $lang_id),
                'lookingUserTypes' => $this->Properties_model->getProperty('looking_user_type', $lang_id),
            ]
        ]);
    }

    public function getConfig()
    {
        // TODO: $this->pg_module->get_module_config($module, $gid);
    }

    /**
     * @api {post} /mobile/verifyPurchase Verify purchase
     * @apiGroup Mobile
     * @apiParam {string} type device
     * @apiParam {int} packageName package name
     * @apiParam {int} productId product id
     * @apiParam {int} purchaseToken purchase token
     */
    public function verifyPurchase($type = 'android')
    {
        $user_id = $this->session->userdata('user_id');
        $user_type = $this->session->userdata('user_type');

        if ($type == 'ios') {
            $this->verifyPurchaseIos($user_id, $user_type);
        }

        // Оставить проверку закомментированной
        /*$api_key       = $this->pg_module->get_module_config('mobile', 'api_key');
        $client_id = $this->pg_module->get_module_config('mobile', 'client_id');
        $client_secret = $this->pg_module->get_module_config('mobile', 'client_secret');

        $is_token_expired = $this->MobileModel->getAccessTokenExpired();

        if ($is_token_expired) {
            $result = false;

            $refresh_token = $this->MobileModel->getRefreshToken();

            $params = [
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'refresh_token' => $refresh_token,
                'grant_type' => 'refresh_token',
            ];

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $token_info = json_decode($result, true);
            $is_updated = $this->MobileModel->setUpdateTokenInfo($token_info);
        } else {
            $token_info = $this->MobileModel->getTokenInfo();
        }

        $input_post = [
            'package_name' => filter_input(INPUT_POST, 'packageName'),
            'product_id' => filter_input(INPUT_POST, 'productId'),
            'purchase_token' => filter_input(INPUT_POST, 'purchaseToken'),
        ];

        $url = "https://www.googleapis.com/androidpublisher/v2/applications/" . $input_post['package_name'] . "/purchases/products/" . $input_post['product_id'] . "/tokens/" . $input_post['purchase_token'] . "?key=" . $api_key;

        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_HTTPHEADER => ['Authorization: ' . $token_info['token_type'] . ' ' . $token_info['access_token']],
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_VERBOSE => 1,
        );

        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if ($result["purchaseState"] == '0' && $result["consumptionState"] == '0') {*/
        $product_id = filter_input(INPUT_POST, 'productId');
        $product = $this->MobileModel->getProductBySku($product_id);
        if ($product['model'] == 'subscription') {
            $this->load->model(['Users_model', 'Access_permissions_model',
                'access_permissions/models/Access_permissions_groups_model',
                'access_permissions/models/Access_permissions_settings_model',
                'access_permissions/models/Access_permissions_users_model',
            ]);

            $groups = $this->Access_permissions_groups_model->formatGroups(
                $this->Users_model->getUserTypesGroups(['where' => ['is_active' => 1]])
            );

            $subscription_type = $this->Access_permissions_settings_model->getSubscriptionType('subscription_type');
            if ($subscription_type == 'user_types') {
                $periods = $this->Access_permissions_settings_model->getAccessData(
                    $this->Access_permissions_model->roles['user']
                )->getPriceGroups($user_type);
            } else {
                $periods = $this->Access_permissions_settings_model->getAccessData(
                    $this->Access_permissions_model->roles['user']
                )->getPriceGroups('user');
            }

            $groups = $this->Access_permissions_model->formatGroups($groups, $periods);

            foreach ($groups as $group) {
                foreach ($group['periods'] as $period) {
                    $val = $group['gid'] . '_' .$period['id'];
                    if ($subscription_type == 'user_types') {
                        $val = $user_type . '_' . $val;
                    }
                    if ($val == $product['group_period_id']) {
                        $group_data = $this->ci->Access_permissions_settings_model
                            ->getAccessData('user', ['user_type' => $user_type])
                            ->getGroupData($group['gid'], ['where' => ['id' => $period['id']]]);
                        $this->Access_permissions_model->applyGroup($group_data, $user_id);
                        break;
                    }
                }
            }
            $this->MobileModel->updatePayment($product['price'], 'access_permissions');
        } elseif ($product['model'] == 'service') {
            $this->load->model('Services_model');
            $data = $this->Services_model->get_service_by_gid($product['service_gid']);

            // log info
            $this->Services_model->addServiceLog($user_id, $data['id'], []);
            $payment_data = [
                "id_user"      => $user_id,
                "amount"       => $product['price'],
                "payment_data" => [
                    "id_service"           => $data['id'],
                    "user_data"            => [],
                    "activate_immediately" => true,
                ],
            ];
            $this->Services_model->paymentServiceStatus($payment_data, 1, false);

            $this->load->model('users/models/Auth_model');
            $this->Auth_model->update_user_session_data($user_id);
            $this->MobileModel->updatePayment($product['price'], 'service');
        } else {
            if (!empty($product['price'])) {
                $amount = $product['price'];
            } else {
                $amount = 0;
            }

            $this->MobileModel->updatePayment($amount);
        }

        $date = date('Y-m-d H:i:s');

        $this->db->insert(DB_PREFIX . 'inapp_google', [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'token' => $token,
            'status' => 0,
            'date_created' => $date,
            'date_updated' => $date,
            'date_expires' => '0000-00-00 00:00:00',
        ]);

        $data['message'] = l('success_purchase', 'mobile');

        $this->set_api_content('data', $data);
    }

    private function verifyPurchaseIos($user_id, $user_type)
    {
        $product_id = filter_input(INPUT_POST, 'product_id');
        $product = $this->MobileModel->getProductBySku($product_id);
        if ($product['model'] == 'subscription') {
            $this->load->model(['Users_model', 'Access_permissions_model', 'Services_model',
                'access_permissions/models/Access_permissions_groups_model',
                'access_permissions/models/Access_permissions_settings_model',
                'access_permissions/models/Access_permissions_users_model',
            ]);

            $groups = $this->Access_permissions_groups_model->formatGroups(
                $this->Users_model->getUserTypesGroups(['where' => ['is_active' => 1]])
            );

            $subscription_type = $this->Access_permissions_settings_model->getSubscriptionType('subscription_type');
            if ($subscription_type == 'user_types') {
                $periods = $this->Access_permissions_settings_model->getAccessData(
                    $this->Access_permissions_model->roles['user']
                )->getPriceGroups($user_type);
                $this->view->assign('subscription_user_type', true);
            } else {
                $periods = $this->Access_permissions_settings_model->getAccessData(
                    $this->Access_permissions_model->roles['user']
                )->getPriceGroups('user');
            }

            $groups = $this->Access_permissions_model->formatGroups($groups, $periods);

            foreach ($groups as $group) {
                foreach ($group['periods'] as $period) {
                    $val = $group['gid'] . '_' .$period['id'];
                    if ($subscription_type == 'user_types') {
                        $val = $user_type . '_' . $val;
                    }
                    if ($val == $product['group_period_id']) {
                        $group_data = $this->ci->Access_permissions_settings_model
                            ->getAccessData('user', ['user_type' => $user_type])
                            ->getGroupData($group['gid'], ['where' => ['id' => $period['id']]]);
                        $this->Access_permissions_model->applyGroup($group_data, $user_id);
                        break;
                    }
                }
            }
            $this->MobileModel->updatePayment($product['price'], 'access_permissions');
        } elseif ($product['model'] == 'service') {
            $this->load->model('Services_model');
            $data = $this->Services_model->get_service_by_gid($product['service_gid']);

            // log info
            $this->Services_model->addServiceLog($user_id, $data['id'], []);
            $payment_data = [
                "id_user"      => $user_id,
                "amount"       => $product['price'],
                "payment_data" => [
                    "id_service"           => $data['id'],
                    "user_data"            => [],
                    "activate_immediately" => true,
                ],
            ];
            $this->Services_model->paymentServiceStatus($payment_data, 1, false);

            $this->load->model('users/models/Auth_model');
            $this->Auth_model->update_user_session_data($user_id);
            $this->MobileModel->updatePayment($product['price'], 'service');
        } else {
            if (!empty($product['price'])) {
                $amount = $product['price'];
            } else {
                $amount = 0;
            }
            $this->MobileModel->updatePayment($amount);
        }

        $data['message'] = l('success_purchase', 'mobile');
        $this->set_api_content('data', $data);
    }

    /**
     * @api {post} /mobile/productList Product list
     * @apiGroup Mobile
     */
    public function productList()
    {
        $type = $this->input->post('type', true);
        $model = $this->input->post('model', true);

        $model = $model ?? 'account';

        $data = $this->MobileModel->getProductList([$type], $model);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $data[$key]['name'] = l('product_' . $value["id"], 'mobile_product');
            }
        }
        $this->set_api_content('data', $data);
    }

    /**
     * @api {post} /mobile/setFcmRegistrationToken Set registration token
     * @apiGroup Mobile
     * @apiParam {int} device_id device id
     * @apiParam {int} registration_id registration id
     */
    public function setFcmRegistrationToken()
    {
        $user_id = (int)$this->session->userdata('user_id');
        $device_id = filter_input(INPUT_POST, 'device_id');
        $reg_id = filter_input(INPUT_POST, 'registration_id');
        if (empty($reg_id)) {
            return;
        }
        $this->MobileModel->setFcmRegistrationId($user_id, $reg_id, $device_id);
    }

    /**
     * @api {post} /mobile/deleteFcmRegistrationToken Delete registration token
     * @apiGroup Mobile
     * @apiParam {int} user_id user id
     * @apiParam {int} device_id device id
     * @apiParam {int} registration_id registration id
     */
    public function deleteFcmRegistrationToken()
    {
        $user_id = (int)filter_input(INPUT_POST, 'user_id');
        $device_id = filter_input(INPUT_POST, 'device_id');
        $registration_id = filter_input(INPUT_POST, 'registration_id');
        if (empty($user_id)) {
            return;
        }
        $this->MobileModel->deleteFcmRegistrationId($user_id, $device_id, $registration_id);
    }

    /**
     * @api {post} /mobile/isUsePushNotifications Get status notifications
     * @apiGroup Mobile
     */
    public function isUsePushNotifications(): bool
    {
        return (bool)$this->MobileModel->getSettings()['use_notifications'];
    }

    /**
     * @api {post} /mobile/getPushNotifications Get notifications
     * @apiGroup Mobile
     */
    public function getPushNotifications()
    {
        $this->load->model('mobile/models/MobileUsersPushNotificationsModel');
        $data = [
            'notifications' => $this->MobileUsersPushNotificationsModel->getUserPushNotifications([], true)
        ];
        $this->set_api_content('data', $data);
    }

    /**
     * @api {post} /mobile/setPushNotifications Set notifications
     * @apiGroup Mobile
     * @apiParam {string} notification notification gid
     * @apiParam {boolean} status status
     */
    public function setPushNotifications()
    {
        $notification = [
            'id_user' => $this->user_id,
            'module' => filter_input(INPUT_POST, 'module', FILTER_SANITIZE_STRING),
            'gid' => filter_input(INPUT_POST, 'notification', FILTER_SANITIZE_STRING),
            'is_subscribed' => filter_input(INPUT_POST, 'is_subscribed', FILTER_VALIDATE_BOOLEAN),
        ];
        $this->load->model('mobile/models/MobileUsersPushNotificationsModel');
        $validate = $this->MobileUsersPushNotificationsModel->validate($notification);

        if (!empty($validate['errors'])) {
            $this->set_api_content('errors', $validate['errors']);
        } else {
            $this->MobileUsersPushNotificationsModel->setUserPushNotifications($validate['data']);
        }
    }
}
