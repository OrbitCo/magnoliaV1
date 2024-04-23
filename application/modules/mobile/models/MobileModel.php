<?php

declare(strict_types=1);

namespace Pg\modules\mobile\models;

/**
 * Mobile main model.
 *
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class MobileModel extends \Model
{
    /**
     * Module gid.
     *
     * @var string
     */
    const MODULE_GID = 'mobile';

    /**
     * Scope URL.
     *
     * @var string
     */
    const GOOGLE_SCOPE_URL = 'https://www.googleapis.com/auth/androidpublisher';

    /**
     * DB table mobile_inapp_billing_tokens.
     *
     * @var string
     */
    const TOKENS_TABLE = DB_PREFIX . 'mobile_inapp_billing_tokens';

    /**
     * DB table mobile_inapp_products.
     *
     * @var string
     */
    const PRODUCTS_TABLE = DB_PREFIX . 'mobile_inapp_products';

    /**
     * DB table mobile_inapp_google.
     *
     * @var string
     */
    const IN_APP_GOOGLE_TABLE = DB_PREFIX . 'mobile_inapp_google';

    /**
     * DB table mobile_fcm_registration_tokens.
     *
     * @var string
     */
    const FCM_TOKENS_TABLE = DB_PREFIX . 'mobile_fcm_registration_tokens';

    /**
     * Database date format.
     *
     * @var string
     */
    const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Module settings.
     *
     * @var array
     */
    private $settings = [];

    /**
     * Module settings key.
     *
     * @var array
     */
    private $settings_keys = [
        'ios_url',
        'android_url',
        'firebase_api_key',
        'firebase_auth_domain',
        'firebase_database_url',
        'firebase_project_id',
        'firebase_storage_bucket',
        'firebase_messaging_sender_id',
        'firebase_public_vapid_key',
        'firebase_service_key',
        'firebase_app_id',
        'use_notifications',
    ];

    /**
     * Mobile module tables properties.
     *
     * @var array
     */
    protected $fields = [
        self::TOKENS_TABLE => [
            'token_name',
            'token',
            'token_type',
            'expires',
        ],
        self::PRODUCTS_TABLE => [
            'id',
            'sku',
            'price',
            'type',
            'model',
            'group_period_id',
            'service_gid',
        ],
        self::IN_APP_GOOGLE_TABLE => [
            'id',
            'user_id',
            'product_id',
            'token',
            'date_created',
            'date_updated',
            'date_expires',
            'status',
        ],
        self::FCM_TOKENS_TABLE => [
            'id',
            'user_id',
            'registration_id',
            'device_id',
        ]
    ];

    /**
     * Devices list.
     *
     * @var array
     */
    public $devices = [
        'iPhone',
        'iPad',
        'Android',
    ];

    /**
     * User ID.
     *
     * @var int
     */
    protected $id_user;

    public function __construct()
    {
        parent::__construct();
        $this->id_user = (int)$this->ci->session->userdata('user_id');
    }

    /**
     * Backend method to get menu indicators.
     *
     * @param array $params
     *
     * @return array
     */
    public function backendGetIndicators(array $params): array
    {
        $this->id_user = $params['id_user'] ?: $this->ci->session->userdata('user_id');
        $results = [];
        foreach ($params['indicators'] as $indicator) {
            $results[$indicator] = $this->$indicator();
        }

        return $results;
    }

    /**
     * New tickets.
     *
     * @return mixed
     */
    private function newTickets()
    {
        $this->ci->load->model('Tickets_model');

        return $this->ci->Tickets_model->getCountNewMessages($this->id_user, 1);
    }

    /**
     * New count messages.
     *
     * @return int
     */
    private function newMessages()
    {
        $count_new_mess = 0;
        $this->ci->load->model('im/models/Im_messages_model');
        if ($this->ci->pg_module->is_module_installed('chatbox')) {
            $this->ci->load->model('chatbox/models/Chatbox_contact_list_model');
            $result_chatbox = $this->ci->Chatbox_contact_list_model->backendCheckNewMessages();
            $count_new_mess += (int)$result_chatbox['count_new'];
        } else {
            $result_im = (int)$this->ci->Im_messages_model->getUnreadCount($this->id_user, 'i');
            $count_new_mess += $result_im;
        }

        return $count_new_mess;
    }

    /**
     * New friends.
     *
     * @return mixed
     */
    private function newFriends()
    {
        if ($this->ci->pg_module->is_module_installed('friendlist')) {
            $this->ci->load->model('Friendlist_model');

            return $this->ci->Friendlist_model->getListCount($this->id_user, 'request_in');
        }
    }

    /**
     * New guests.
     *
     * @return int
     */
    private function newGuests()
    {
        $user_id = $this->id_user;
        $this->ci->load->model('users/models/Users_views_model');
        $all_viewers = $this->ci->Users_views_model->getViewersDailyUnique($this->id_user, null, null, ['view_date' => 'DESC'], [], 'all', 1);

        return count($all_viewers);
    }

    /**
     * New files.
     *
     * @return mixed
     */
    private function newFiles()
    {
        $user_id = $this->id_user;
        $this->ci->load->model('file_uploads/models/File_uploads_android_model');

        return $this->ci->File_uploads_android_model->getUnviewedCount($this->id_user);
    }

    /**
     * New chats.
     *
     * @return mixed
     */
    private function newChats()
    {
        $this->ci->load->model('Chats_model');

        return $this->ci->Chats_model->getChatsCount();
    }

    /**
     * New kisses.
     *
     * @return mixed
     */
    private function newKisses()
    {
        $this->ci->load->model('Kisses_model');
        $user_id = $this->id_user;
        return $this->ci->Kisses_model->newKissesCount($this->id_user);
    }

    /**
     * New gifts.
     *
     * @return mixed
     */
    private function newGifts()
    {
        $this->ci->load->model('Virtual_gifts_model');
        $user_id = $this->id_user;

        return $this->ci->Virtual_gifts_model->getUserGiftsCount($this->id_user, [
            'where' => ['status' => 'pending'],
        ]);
    }

    /**
     * Return settings.
     *
     * @param bool $force
     *
     * @return array
     */
    public function getSettings($force = false): array
    {
        if ($force || empty($this->settings)) {
            foreach ($this->settings_keys as $settings_key) {
                $this->settings[$settings_key] = html_entity_decode((string)$this->ci->pg_module->get_module_config(self::MODULE_GID, $settings_key), ENT_QUOTES);
            }
            // TODO: добавить проверку существования или перенести в модель пушей
            //$this->settings['service_key'] = html_entity_decode((string)file_get_contents(dirname(SITE_PATH) . '/gaccess.json'), ENT_QUOTES);
        }

        return $this->settings;
    }

    /**
     * Save settings.
     *
     * @param $settings
     *
     * @return void
     */
    public function setSettings($settings)
    {
        foreach ($settings as $key => $value) {
            if (in_array($key, $this->settings_keys, true) && $value) {
                $this->ci->pg_module->set_module_config(self::MODULE_GID, $key, $value);
            } elseif ($key == 'service_key' && $value) {
                file_put_contents(dirname(SITE_PATH) . '/gaccess.json', $value);
            }
        }
    }

    /**
     * Languages replace.
     *
     * @param $langs
     *
     * @return string|string[]
     */
    public function langsReplace($langs)
    {
        return str_replace('%mobile_search_url%', SITE_VIRTUAL_PATH . 'm/#!/search/', $langs);
    }

    /**
     * Methods for in-app billing in mobile application.
     *
     * @param $token_info
     *
     * @return bool
     */
    public function setUpdateTokenInfo($token_info): bool
    {
        $result = false;
        if (!empty($token_info['access_token']) && !empty($token_info['token_type']) && !empty($token_info['expires_in'])) {
            $result = $this->updateAccessToken($token_info);
        }

        if (!empty($token_info['refresh_token'])) {
            $result = $this->updateRefreshToken($token_info);
        }

        return $result;
    }

    /**
     * Update Access Token.
     *
     * @param array $data
     *
     * @return bool
     */
    private function updateAccessToken(array $data): bool
    {
        $this->setData(
            self::TOKENS_TABLE,
            [
                'token' => $data['access_token'],
                'token_type' => $data['token_type'],
                'expires' => date('U') + $data['expires_in'],
            ],
            null,
            ['where' => ['token_name' => 'access_token']]
        );

        return true;
    }

    /**
     * Update Refresh Token.
     *
     * @param array $data
     *
     * @return bool
     */
    private function updateRefreshToken(array $data): bool
    {
        $this->setData(
            self::TOKENS_TABLE,
            ['token' => $data['refresh_token']],
            null,
            ['where' => ['token_name' => 'refresh_token']]
        );

        return true;
    }

    /**
     * Return refresh token.
     *
     * @return array
     */
    public function getRefreshToken(): array
    {
        return current($this->getData(self::TOKENS_TABLE, [
            'where' => ['token_name' => 'refresh_token'],
        ]))['token'];
    }

    /**
     * Return token info.
     *
     * @return array
     */
    public function getTokenInfo(): array
    {
        $result = current($this->getData(self::TOKENS_TABLE, [
            'where' => ['token_name' => 'access_token'],
        ]));

        return [
            'access_token' => $result['token'],
            'token_type' => $result['token_type'],
        ];
    }

    /**
     * Return access token expired.
     *
     * @return bool
     */
    public function getAccessTokenExpired(): bool
    {
        $result = current($this->getData(self::TOKENS_TABLE, [
            'where' => ['token_name' => 'access_token'],
        ]));
        if (date('U') > $result['expires']) {
            return true;
        }

        return false;
    }

    /**
     * Return product by ID.
     *
     * @param null $id
     *
     * @return array
     */
    public function getProductById($id = null): array
    {
        if (is_null($id)) {
            return [];
        }

        return current($this->getData(self::PRODUCTS_TABLE, [
            'where' => ['id' => $id],
        ]));
    }

    /**
     * Save product.
     *
     * @param int $id
     * @param array $data
     * @param array $langs
     *
     * @return int|null
     */
    public function saveProduct($id = null, $data = [], $langs = [])
    {
        if (empty($data)) {
            return;
        }
        $id = $this->setData(self::PRODUCTS_TABLE, $data, $id);

        if (!empty($langs)) {
            $current_lang_name = $langs[$this->pg_language->current_lang_id];
            foreach ($this->pg_language->languages as $lang) {
                $lang_id = $lang['id'];
                if (!empty($langs[$lang_id])) {
                    $this->pg_language->pages->set_string('mobile_product', 'product_' . $id, $langs[$lang_id], $lang_id);
                } else {
                    $this->pg_language->pages->set_string('mobile_product', 'product_' . $id, $current_lang_name, $lang_id);
                }
            }
        }

        return $id;
    }

    /**
     * Return product list.
     *
     * @param array $type
     * @param string $model
     *
     * @return mixed
     */
    public function getProductList($type = ['android', 'ios'], $model = 'account')
    {
        $data = $this->getData(self::PRODUCTS_TABLE, [
            'where' => ['model' => $model],
            'where_in' => ['type' => (array)$type],
        ]);

        if (!empty($data)) {
            $this->ci->load->model(['Users_model', 'Access_permissions_model', 'Services_model',
                'access_permissions/models/Access_permissions_groups_model',
                'access_permissions/models/Access_permissions_settings_model',
                'access_permissions/models/Access_permissions_users_model',
            ]);

            $user_types = $this->ci->Users_model->getUserTypes();
            $groups = $this->ci->Access_permissions_groups_model->formatGroups(
                $this->ci->Users_model->getUserTypesGroups(['where' => ['is_active' => 1]])
            );

            $subscription_type = $this->ci->Access_permissions_settings_model->getSubscriptionType('subscription_type');
            if ($subscription_type == 'user_types') {
                $periods = [];
                $period_user_type = [];

                foreach ($user_types as $user_type) {
                    if ($this->ci->session->userdata('auth_type') == 'user' && $user_type != $this->ci->session->userdata('user_type')) {
                        continue;
                    }

                    $user_type_periods = $this->ci->Access_permissions_settings_model->getAccessData(
                        $this->ci->Access_permissions_model->roles['user']
                    )->getPriceGroups($user_type);

                    foreach ($user_type_periods as $v) {
                        $period_user_type[] = $user_type;
                    }

                    $periods = array_merge($periods, $user_type_periods);
                }

                $this->view->assign('period_user_type', $period_user_type);
                $this->view->assign('subscription_user_type', true);
            } else {
                $periods = $this->ci->Access_permissions_settings_model->getAccessData(
                    $this->ci->Access_permissions_model->roles['user']
                )->getPriceGroups('user');
            }
            $groups = $this->ci->Access_permissions_model->formatGroups($groups, $periods);

            $services = $this->ci->Services_model->getServiceList([
                'where' => [
                    'type' => 'tariff',
                    'status' => 1,
                ],
            ]);

            foreach ($data as $key => $value) {
                if ($value['model'] == 'subscription') {
                    $data[$key]['name'] = str_replace(
                        '&nbsp;',
                        ' ',
                        $this->getPeriod($groups, $user_types, $subscription_type, $value['group_period_id'])
                    );
                } elseif ($value['model'] == 'service') {
                    foreach ($services as $service) {
                        if ($service['gid'] == $value['service_gid']) {
                            $data[$key]['name'] = $service['name'];
                            break;
                        }
                    }
                } else {
                    $data[$key]['name'] = l('product_' . $value['id'], 'mobile_product');
                }
            }
        }

        return $data;
    }

    /**
     * Return period.
     *
     * @param $groups
     * @param $user_types
     * @param $subscription_type
     * @param $group_period_id
     *
     * @return mixed
     */
    private function getPeriod($groups, $user_types, $subscription_type, $group_period_id)
    {
        foreach ($groups as $group) {
            foreach ($group['periods'] as $period) {
                if ($subscription_type == 'user_types') {
                    foreach ($user_types as $user_type) {
                        if ($user_type . '_' . $group['gid'] . '_' . $period['id'] == $group_period_id) {
                            return $period['period_str'];
                        }
                    }
                } else {
                    if ($group['gid'] . '_' . $period['id'] == $group_period_id) {
                        return $period['period_str'];
                    }
                }
            }
        }

        return '';
    }

    /**
     * Delete product.
     *
     * @param int $id
     *
     * @return void
     */
    public function deleteProduct(int $id)
    {
        $this->ci->db
            ->where('id', $id)
            ->delete(self::PRODUCTS_TABLE);
    }

    /**
     * Return product by sku.
     *
     * @param string $sku
     *
     * @return bool|mixed
     */
    public function getProductBySku(string $sku)
    {
        return current($this->getData(self::PRODUCTS_TABLE, [
                'where' => ['sku' => $sku],
            ])) ?? false;
    }

    /**
     * Update payment.
     *
     * @param float $amount
     * @param string $type_gid
     *
     * @return void
     */
    public function updatePayment($amount = null, $type_gid = 'account')
    {
        if (is_null($amount)) {
            return;
        }
        $this->ci->load->model(['Payments_model',
            'payments/models/Payment_currency_model', 'menu/models/Indicators_model',]);
        $user_id = $this->id_user;

        $payment_data = [
            'payment_type_gid' => $type_gid,
            'id_user' => $user_id,
            'amount' => $amount,
            'currency_gid' => $currency,
            'status' => 1,
            'system_gid' => 'inapp_purchase',
            'payment_data' => ['name' => 'In-app purchase'],
        ];
        $payment_data = $this->ci->Payments_model->validatePayment(null, $payment_data);
        $indicator_id = $this->ci->Payments_model->savePayment(null, $payment_data['data']);
        $this->ci->Indicators_model->delete('new_payment_item', $indicator_id, true);

        if ($type_gid == 'account') {
            $this->ci->Users_model->updateAccount($user_id, $amount);
        }
    }

    /**
     * Save Fcm Registration ID.
     *
     * @param mixed $user_id
     * @param mixed $reg_id
     * @param mixed $device_id
     *
     * @return void
     */
    public function setFcmRegistrationId($user_id, $reg_id, $device_id = '')
    {
        if (empty($reg_id) || empty($user_id)) {
            return;
        }

        $this->ci->db->select("id, user_id, device_id, registration_id")->from(self::FCM_TOKENS_TABLE)->where("user_id", $user_id);

        $result = $this->ci->db->get()->result_array();
        if (!empty($result)) {
            foreach ($result as $r) {
                if ($r['device_id'] === $device_id) {
                    $this->ci->db->set('registration_id', $reg_id)->where('id', $r['id'])->update(self::FCM_TOKENS_TABLE);
                    return;
                }
            }
        }

        $attrs = ['user_id' => $user_id, 'registration_id' => $reg_id, 'device_id' => $device_id ?: ""];
        $this->ci->db->insert(self::FCM_TOKENS_TABLE, $attrs);
    }


    /**
     * Delete Fcm Registration ID.
     *
     * @param mixed $user_id
     * @param mixed $device_id
     * @param mixed $registration_id
     *
     * @return void
     */
    public function deleteFcmRegistrationId($user_id, $device_id = '', $registration_id = '')
    {
        if (empty($user_id)) {
            return;
        }

        $this->removeData(self::FCM_TOKENS_TABLE, [
            'where' => [
                'user_id' => $user_id,
                'device_id' => $device_id,
                'registration_id' => $registration_id,
            ]
        ]);
    }

    public function deleteFcmByRegistrationIds($registration_ids)
    {
        if (empty($registration_ids)) {
            return;
        }

        $this->removeData(self::FCM_TOKENS_TABLE, [
            'where_in' => [
                'registration_id' => $registration_ids
            ]
        ]);
    }

    /**
     * Return reg token by user ID.
     *
     * @param $user_id
     *
     * @return array
     */
    public function getRegTokenByUserId($user_id): array
    {
        if (empty($user_id)) {
            return [];
        }

        return current($this->getData(self::FCM_TOKENS_TABLE, [
                'where' => ['user_id' => $user_id],
            ]))['registration_id'] ?? [];
    }

    /**
     * Return registered user IDs.
     *
     * @param array $params
     * @param int $items_on_page
     * @param int $page
     *
     * @return array
     */
    public function getRegisteredUserIds($params = [], $items_on_page = 20, $page = 1): array
    {
        $result = $this->getData(self::FCM_TOKENS_TABLE, $params, $items_on_page, $page);

        return array_map(static function ($value) {
            return $value['user_id'];
        }, $result);
    }

    /**
     * Is app or no
     *
     * @return int
     */
    public function isApp(): int
    {
        $is_app = 0;
        $this->ci->load->library('user_agent');
        foreach ($this->devices as $device) {
            if (stripos($this->ci->agent->agent_string(), $device) !== false) {
                $is_app = 1;
            }
        }

        return $is_app;
    }

    /**
     * Cron In app Receipt
     *
     * @return void
     */
    public function cronInappReceipt()
    {
        $credentials = dirname(SITE_PHYSICAL_PATH) . '/path_to_json.json';
        if (!file_exists($credentials)) {
            return;
        }

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentials);

        $client = new \Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope(self::GOOGLE_SCOPE_URL);
        $service = new \Google_Service_AndroidPublisher($client);

        $transactions = $this->getData(self::IN_APP_GOOGLE_TABLE, [
            'where' => ['status' => 'active', 'date_expires <=' => date('Y-m-d H:i:s')],
        ], 100, 1);

        foreach ($transactions as $transaction) {
            $purchase = $service->purchases_subscriptions->get('package_name', $transaction['product_id'], $transaction['token']);

            if ($purchase->acknowledgementState && $purchase->autoRenewing) {
                $date_expires = date('Y-m-d H:i:s', round($purchase->expiryTimeMillis / 1000));
                if ($transaction['date_expires'] == '0000-00-00 00:00:00') {
                    $this->setData(self::IN_APP_GOOGLE_TABLE, [
                        'date_expires' => $date_expires,
                    ], $transaction['id']);
                } elseif ($transaction['date_expires'] !== $date_expires) {
                    $product = $this->getProductBySku($transaction['product_id']);
                    if ($product['model'] == 'subscription') {
                        $this->ci->load->model(['Users_model', 'Access_permissions_model',
                            'access_permissions/models/Access_permissions_groups_model',
                            'access_permissions/models/Access_permissions_settings_model',
                            'access_permissions/models/Access_permissions_users_model',
                        ]);

                        $user_types = $this->ci->Users_model->getUserTypes();

                        $groups = $this->ci->Access_permissions_groups_model->formatGroups(
                            $this->ci->Users_model->getUserTypesGroups(['where' => ['is_active' => 1]])
                        );

                        $subscription_type = $this->ci->Access_permissions_settings_model->getSubscriptionType('subscription_type');
                        if ($subscription_type == 'user_types') {
                            $periods = [];

                            foreach ($user_types as $user_type) {
                                $periods[] = $this->ci->Access_permissions_settings_model->getAccessData(
                                    $this->ci->Access_permissions_model->roles['user']
                                )->getPriceGroups($user_type);
                            }
                        } else {
                            $periods = $this->ci->Access_permissions_settings_model->getAccessData(
                                $this->ci->Access_permissions_model->roles['user']
                            )->getPriceGroups('user');
                        }

                        $groups = $this->ci->Access_permissions_model->formatGroups($groups, $periods);

                        foreach ($groups as $group) {
                            foreach ($group['periods'] as $period) {
                                $val = $group['gid'] . '_' . $period['id'];
                                if ($subscription_type == 'user_types') {
                                    $val = $user_type . '_' . $val;
                                }

                                if ($val == $product['group_period_id']) {
                                    $period_id = substr($product['group_period_id'], strlen($group['gid']) + 1);
                                    $group_data = $this->ci->Access_permissions_settings_model
                                        ->getAccessData('user', ['user_type' => $user_type])
                                        ->getGroupData($group['gid'], ['where' => ['id' => $period_id]]);
                                    $this->ci->Access_permissions_model->applyGroup($group_data, $transaction['user_id']);
                                    break;
                                }
                            }
                        }
                        $this->ci->Mobile_model->updatePayment($product['price'], 'access_permissions');
                    } elseif ($product['model'] == 'service') {
                        $this->ci->load->model('Services_model');
                        $data = $this->ci->Services_model->get_service_by_gid($product['service_gid']);
                        $this->ci->Services_model->inAppPayment($data['id'], $transaction['user_id'], [], $product['price'], true);
                        $this->ci->Mobile_model->updatePayment($product['price'], 'service');
                    } else {
                        if (!empty($product['price'])) {
                            $amount = $product['price'];
                        } else {
                            $amount = 0;
                        }

                        $this->ci->Mobile_model->updatePayment($amount);
                    }

                    $this->setData(self::IN_APP_GOOGLE_TABLE, [
                        'date_expires' => $date_expires,
                    ], $transaction['id']);
                }
            } else {
                $this->setData(self::IN_APP_GOOGLE_TABLE, [
                    'status' => 'cancel',
                ], $transaction['id']);
            }
        }
    }

    /**
     * Return data.
     *
     * @param string $table
     * @param array $params
     * @param int $items_on_page
     * @param int $page
     *
     * @return array
     */
    protected function getData(string $table, array $params, $items_on_page = 20, $page = null): array
    {
        $this->ci->db->select(implode(', ', $this->fields[$table]));
        $this->ci->db->from($table);
        $this->queryParams($params);
        if (is_null($page) !== true) {
            $page = $page ?? 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        return $this->ci->db->get()->result_array();
    }

    /**
     * Set data.
     *
     * @param string $table
     * @param array $attrs
     * @param int $id
     * @param array $params
     *
     * @return mixed
     */
    protected function setData(string $table, array $attrs, $id = null, $params = [])
    {
        if (!empty($id)) {
            $this->ci->db->where('id', $id);
            $this->ci->db->update($table, $attrs);
        } elseif (!empty($params)) {
            $this->queryParams($params);
            $this->ci->db->update($table, $attrs);
        } else {
            $this->ci->db->insert($table, $attrs);
            $id = $this->ci->db->insert_id();
        }

        return $id;
    }

    /**
     * Remove data
     *
     * @param string $table
     * @param array $params
     *
     * @return void
     */
    public function removeData(string $table, array $params)
    {
        $this->queryParams($params);
        $this->ci->db->delete($table);
    }

    /**
     * Query params
     *
     * @param array $params
     * @param array $filter_object_ids
     *
     * @return void
     */
    private function queryParams(array $params, array $filter_object_ids = [])
    {
        if (!empty($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (!empty($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (!empty($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (!empty($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (!empty($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (!empty($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }
    }

    /**
     * Return reg tokens by user ID.
     *
     * @param $user_id
     *
     * @return array|void
     */
    public function getRegTokensByUserId($user_id)
    {
        if (empty($user_id)) {
            return [];
        }

        $this->ci->db->select("id, user_id, registration_id")->from(self::FCM_TOKENS_TABLE)->where("user_id", $user_id);
        $result = $this->ci->db->get()->result_array();

        if (!empty($result)) {
            $tokens = [];
            foreach ($result as $r) {
                $tokens[] = $r['registration_id'];
            }
            return $tokens;
        }

        return [];
    }


    /**
     * @throws \Exception
     */
    public function __call($name, $args)
    {
        $methods = [
            'backend_get_indicators' => 'backendGetIndicators',
            'new_friends' => 'newFriends',
            'new_messages' => 'newMessages',
            'get_product_by_id' => 'getProductById',
            'save_product' => 'saveProduct',
            'set_update_token_info' => 'setUpdateTokenInfo',
            'get_refresh_token' => 'getRefreshToken',
            'get_token_info' => 'getTokenInfo',
            'get_access_token_expired' => 'getAccessTokenExpired',
            'get_product_list' => 'getProductList',
            'delete_product' => 'deleteProduct',
            'get_product_by_sku' => 'getProductBySku',
            'update_payment' => 'updatePayment',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
