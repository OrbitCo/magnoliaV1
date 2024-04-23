<?php

declare(strict_types=1);

namespace Pg\modules\send_vip\models;

use Pg\modules\access_permissions\models\AccessPermissionsModel;
use Pg\modules\access_permissions\models\AccessPermissionsSettingsModel;

/*
 * Send_vip module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define('SEND_VIP_TABLE', DB_PREFIX.'send_vip');

/**
 * Base model.
 *
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SendVipModel extends \Model
{
    const MODULE_GID = 'send_vip';

    /**
     * Payment type as write off from account.
     */
    const PAYMENT_TYPE_ACCOUNT = 'account';

    /**
     * Payment type as write off from account and direct payment.
     */
    const PAYMENT_TYPE_ACCOUNT_AND_DIRECT = 'account_and_direct';

    /**
     * Payment type as direct payment.
     */
    const PAYMENT_TYPE_DIRECT = 'direct';

    /**
     * Transaction status waiting.
     *
     * @var string
     */
    const STATUS_WAITING = 'waiting';

    /**
     * Transaction status decline.
     *
     * @var string
     */
    const STATUS_DECLINE = 'decline';

    /**
     * Transaction status approve.
     *
     * @var string
     */
    const STATUS_APPROVE = 'approve';

    /**
     * Send_vip object properties.
     *
     * @var array
     */
    protected $fields = [
        'id',
        'id_user',
        'id_sender',
        'membership_obj',
        'status',
        'declined_by_sender',
        'date_created',
        'transfer_fee',
        'is_notify',
    ];

    public function getAllowedPaymentTypes()
    {
        return [
            self::PAYMENT_TYPE_ACCOUNT,
            self::PAYMENT_TYPE_DIRECT,
            self::PAYMENT_TYPE_ACCOUNT_AND_DIRECT,
        ];
    }

    public function validateSettings($settings)
    {
        $return = ['errors' => [], 'data' => []];
        if (isset($settings['use_fee'])) {
            if (in_array($settings['use_fee'], ['use', ''])) {
                $return['data']['use_fee'] = $settings['use_fee'];
            } else {
                $return['errors'][] = l('admin_errors_use_fee', 'send_vip');
            }
        }
        if (isset($settings['fee_price']) && !empty($settings['fee_price'])) {
            $return['data']['fee_price'] = floatval($settings['fee_price']);
        }
        if (isset($settings['fee_currency']) && !empty($settings['fee_currency'])) {
            if (in_array($settings['fee_currency'], $settings['currencies'])) {
                $return['data']['fee_currency'] = $settings['fee_currency'];
            } else {
                $return['errors'][] = l('admin_errors_fee_currency', 'send_vip');
            }
        }
        if (isset($settings['to_whom'])) {
            if (in_array($settings['to_whom'], ['to_all', 'to_friends'])) {
                $return['data']['to_whom'] = $settings['to_whom'];
            } else {
                $return['errors'][] = l('admin_errors_to_whom', 'send_vip');
            }
        }
        if (isset($settings['transfer_type'])) {
            if (in_array($settings['transfer_type'], $this->getAllowedPaymentTypes())) {
                $return['data']['transfer_type'] = $settings['transfer_type'];
            } else {
                $return['errors'][] = l('admin_errors_transfer_type', 'send_vip');
            }
        }

        return $return;
    }

    public function getTransaction($transaction_id = null, $page = null, $items_on_page = 0)
    {
        if (isset($transaction_id)) {
            $result = $this->ci->db
                ->select(implode(', ', $this->fields))
                ->from(SEND_VIP_TABLE)
                ->where('id', $transaction_id)
                ->order_by('date_created DESC')
                ->get()
                ->row_array();
        } else {
            $this->ci->db
                ->select(implode(', ', $this->fields))
                ->from(SEND_VIP_TABLE)
                ->order_by('date_created DESC');

            if ($page) {
                $this->ci->db->limit($items_on_page, $items_on_page * (min((int) $page, 1) - 1));
            }

            $result = (array) $this->ci->db->get()->result_array();
        }

        return $result;
    }

    public function getTransactionsCount()
    {
        return $this->ci->db->from(SEND_VIP_TABLE)->count_all_results();
    }

    public function validateTransaction($validate_data, $koef = 0, $transfer_fee = null)
    {
        $return = ['errors' => [], 'data' => []];
        $this->ci->load->model('UsersModel');
        $user = $this->ci->UsersModel->getUserById($this->ci->session->userdata('user_id'));
        if (empty($validate_data['id_user'])) {
            $return['errors'][] = l('send_vip_no_recipient', 'send_vip');
        } else {
            $return['data']['id_user'] = $validate_data['id_user'];
        }

        if (!isset($validate_data['id_sender'])) {
            $return['errors'][] = l('send_vip_no_sender', 'send_vip');
        } else {
            $return['data']['id_sender'] = $validate_data['id_sender'];
            $return['validate']['sender_account'] = $user['account'];
        }

        if (isset($validate_data['membership'])) {
            $membership = $this->validateMembership($validate_data['membership']);
            if (empty($membership)) {
                $return['errors'][] = l('send_vip_wrong_membership', 'send_vip');
            } else {
                $return['data']['membership_obj'] = $validate_data['membership'];
                $return['data']['membership_name'] = $membership['current_name'];
                if (($koef > 0) && ($koef < 1)) {
                    $price = (float) $membership['period'][$membership['gid'].'_group'] + (float) $membership['period'][$membership['gid'].'_group'] * $koef;
                    $return['data']['transfer_fee'] = number_format((float) $membership['period'][$membership['gid'].'_group'] * $koef, 2, '.', '');
                } elseif ($koef >= 1) {
                    $price = (float) $membership['period'][$membership['gid'].'_group'] + $transfer_fee;
                    $return['data']['transfer_fee'] = number_format((float) $transfer_fee, 2, '.', '');
                } else {
                    $price = $membership['period'][$membership['gid'].'_group'];
                    $return['data']['transfer_fee'] = 0;
                }
                $pay_type = $this->pg_module->get_module_config('send_vip', 'transfer_type');
                if ($pay_type == self::PAYMENT_TYPE_ACCOUNT && ($price > $user['account'])) {
                    $return['errors'][] = l('send_vip_few_funds', 'send_vip');
                } else {
                    $return['data']['amount'] = number_format((float) $membership['period'][$membership['gid'].'_group'], 2, '.', '');
                    $return['data']['full_amount'] = number_format((float) $price, 2, '.', '');
                }
            }
        } else {
            $return['errors'][] = l('send_vip_no_membership', 'send_vip');
        }

        return $return;
    }

    /**
     * Validate membership data.
     *
     * @param string $data
     *
     * @return boolean/array
     */
    private function validateMembership($data)
    {
        if (empty($data)) {
            return false;
        }

        $this->ci->load->model(['AccessPermissionsModel',
            'access_permissions/models/AccessPermissionsSettingsModel', ]);

        $membership_data = explode('_', $data);

        $access_type = $this->ci->AccessPermissionsSettingsModel->getSubscriptionType(
            AccessPermissionsSettingsModel::TYPE);
        if ($access_type == 'user_types') {
            $this->ci->AccessPermissionsSettingsModel->getAccessData(
                $this->ci->AccessPermissionsModel->roles[AccessPermissionsModel::USER]
            )->user_type = $membership_data[1];
        }

        return $this->ci->AccessPermissionsSettingsModel->getAccessData(
            $this->ci->AccessPermissionsModel->roles[AccessPermissionsModel::USER]
        )->getGroupData($membership_data[0], [
            'where' => ['id' => array_pop($membership_data)],
        ]);
    }

    public function formatConfirmData(array $data)
    {
        return [
            'amount' => $data['data']['full_amount'],
            'sender_account' => $data['validate']['sender_account'],
            'membership_name' => $data['data']['membership_name'],
            'transfer_fee' => number_format((float) $data['data']['transfer_fee'], 2, '.', ''),
            'membership_obj' => $data['data']['membership_obj'],
            'full_amount' => $data['data']['full_amount'],
            'id_user' => $data['data']['id_user'],
        ];
    }

    public function saveTransaction($transaction_id, $transaction_data)
    {
        unset($transaction_data['membership_name']);
        unset($transaction_data['amount']);
        unset($transaction_data['full_amount']);

        if (!$transaction_id) {
            $this->ci->db->insert(SEND_VIP_TABLE, $transaction_data);
            $transaction_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $transaction_data['id']);
            $this->ci->db->update(SEND_VIP_TABLE, $transaction_data);
        }

        return $transaction_id;
    }

    public function statusTransaction($transaction_id, $status)
    {
        $transaction_data = $this->getTransaction($transaction_id);
        if ($transaction_data['status'] == 'waiting') {
            $membership = explode('_', $transaction_data['membership_obj']);
            $this->ci->load->model(['access_permissions/models/AccessPermissionsGroupsModel',
                'AccessPermissionsModel', 'UsersModel', 'ChatboxModel']);
            $recepient = $this->ci->UsersModel->getUserById($transaction_data['id_user']);
            $sender = $this->ci->UsersModel->getUserById($transaction_data['id_sender']);

            if ($status == 'approve') {
                $transaction_data['status'] = 'approved';
                $return = l('send_vip_approved', 'send_vip');
                $this->ci->AccessPermissionsModel->paymentStatus([
                    'id_user' => $transaction_data['id_user'],
                    'payment_data' => [
                        'group_gid' => $membership[0],
                        'period_id' => $membership[1],
                    ],
                ], 1);
                $message = $recepient['output_name'] . ' - ' 
                . l('payment_stat_send_vip', 'send_vip', $sender['lang_id']) . ' ' 
                . strtolower(l('send_vip_approved', 'send_vip', $sender['lang_id']));    
                $this->ci->ChatboxModel->addMessage($transaction_data['id_sender'], $transaction_data['id_sender'], $message, true, true); 
            } elseif ($status == 'decline') {
                $transaction_data['status'] = 'declined';
                if ($this->ci->session->userdata('user_id') == $sender['id']) {
                    $transaction_data['declined_by_sender'] = 1;
                    $return = l('send_vip_declined_by_me', 'send_vip');
                } elseif ($this->ci->session->userdata('user_id') == $recepient['id']) {
                    $return = l('send_vip_declined_by_me', 'send_vip');
                    $message = $recepient['output_name'] . ' - ' . l('payment_stat_send_vip_decline', 'send_vip', $sender['lang_id']);    
                    $this->ci->ChatboxModel->addMessage($transaction_data['id_sender'], $transaction_data['id_sender'], $message, true, true); 
                } else {
                    $return = l('send_vip_declined', 'send_vip');
                }
                $price = $this->ci->AccessPermissionsGroupsModel->getPeriodPrice([
                    'group' => $membership[0],
                    'period' => $membership[1],
                ]);
                $this->ci->load->model('UsersPaymentsModel');
                $payment_data = [
                    'id_user' => $transaction_data['id_sender'],
                    'amount' => $price,
                    'operation_message' => $return,
                ];
                $this->ci->UsersPaymentsModel->updateUserAccount(
                    $payment_data,
                    1,
                    'decline_send_vip',
                    ['lang' => 'payment_stat_send_vip_decline', 'module' => self::MODULE_GID]
                );
            }
            $this->saveTransaction($transaction_id, $transaction_data);
        } else {
            $return = l('admin_view_no_data', 'send_vip');
        }

        return $return;
    }

    /**
     * Update membership payment status.
     *
     * callback method for payment module
     *
     * Expected status values: 1, 0, -1
     *
     * @param array $payment        payment data
     * @param int   $payment_status payment status
     *
     * @return void
     */
    public function paymentSendVipStatus($payment, $payment_status)
    {
        if ($payment_status != 1) {
            return;
        }

        $transaction_data = $payment['payment_data']['transaction'];
        $transaction_data['id_transaction'] = $this->saveTransaction(null, $transaction_data);
        $transaction_data['currency_gid'] = $payment['currency_gid'];

        $this->sendLetter($transaction_data);
    }

    public function sendLetter($data)
    {
        $this->ci->load->model(['UsersModel', 'notifications/models/NotificationsModel', 'ChatboxModel']);

        $receiver = $this->ci->UsersModel->getUserById($data['id_user']);
        $sender = $this->ci->UsersModel->getUserById($data['id_sender']);

        $message = ' 🎉 ' . l('field_text_send_vip_notify', 'send_vip', $receiver['lang_id']) 
        . ' ' . $sender['output_name'] . '  <i class="fa fa-long-arrow-alt-right"></i>  <a href="' . site_url() . 'users/account/donate"> ' 
        . l('send_vip_view_gifts', 'send_vip', $receiver['lang_id']) . '</a>';
        $this->ci->ChatboxModel->addMessage($data['id_user'], $data['id_user'], $message, true, true);

        return $this->ci->NotificationsModel->sendNotification(
            $receiver['email'],
            'send_vip_msg',
            [
                'membership' => $data['membership_name'],
                'approve' => l('send_vip_approve', 'send_vip', $receiver['lang_id']),
                'decline' => l('send_vip_decline', 'send_vip', $receiver['lang_id']),
                'id' => $data['id_transaction'],
                'sender' => $sender['output_name'],
            ],
            '',
            $receiver['lang_id']
         );
    }

    /**
     *  Site map xml.
     *
     *  @return array
     */
    public function getSitemapXmlUrls()
    {
        $this->ci->load->helper('seo');

        return [];
    }

    /**
     *Get Сoefficient.
     *
     * @param array $data
     *
     * @return float
     */
    public static function getСoefficient($data)
    {
        return ($data['currency'] == '%') ? (float) $data['transfer_fee'] / 100 : 1;
    }

    /**
     * Transaction Data.
     *
     * @param array $params
     * @param bool  $format
     *
     * @return array
     */
    public function getTransactionData($params = [], $format = true)
    {
        $this->ci->db->select(implode(', ', $this->fields));
        $this->ci->db->from(SEND_VIP_TABLE);

        if (isset($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        if (isset($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (isset($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        $results = $this->ci->db->get()->result_array();

        return ($format === true) ? $this->formatTransactionData($results) : $results;
    }

    /**
     * Format Transaction Data.
     *
     * @param array $data
     *
     * @return array
     */
    public function formatTransactionData($data = [])
    {
        if (empty($data)) {
            return [];
        }

        foreach ($data as $item) {
            $users_ids[] = $item['id_sender'];
        }

        $this->ci->load->model(['UsersModel', 'users/models/UsersDeletedModel']);
        $users_list = $this->ci->UsersModel->getUsersListByKey(null, null, null, [], $users_ids);
        $default_user = $this->ci->UsersModel->formatDefaultUser(1);
        $deleted_users = $this->ci->UsersDeletedModel->getUsersList(null, null, null, [
            'where_in' => [
                'id_user' => $users_ids,
            ],
        ]);

        foreach ($data as $key => $item) {
            if ($users_list[$item['id_sender']]['id']) {
                $data[$key]['sender'] = $users_list[$item['id_sender']];
            } else {
                $data[$key]['sender'] = $default_user;
                foreach ($deleted_users as $deleted_user) {
                    if ($item['id_sender'] == $deleted_user['id_user']) {
                        $data[$key]['sender'] = array_merge($data[$key]['sender'], $deleted_user);
                        break;
                    }
                }
            }
        }

        return $data;
    }

    public function backendGetRequestVip()
    {
        $result = ['notifications' => [], 'new_vip' => 0];

        $params = [
            'where' => [
                'is_notify' => 0,
                'status' => self::STATUS_WAITING,
                'declined_by_sender' => 0,
                'id_user' => $this->ci->session->userdata('user_id'),
            ],
        ];

        $money = $this->getTransactionData($params, true);

        foreach ($money as $item) {
            $result['notifications'][] = [
                'title' => l('field_title_send_vip_notify', self::MODULE_GID),
                'text' => l('field_text_send_vip_notify', self::MODULE_GID).' '.$item['sender']['output_name'],
                'id' => $item['id'],
                'user_id' => $item['sender']['id'],
                'user_name' => $item['sender']['output_name'],
                'user_icon' => $item['sender']['media']['user_logo']['thumbs']['small'],
                'link' => rewrite_link('users', 'account', 'donate'),
                'more' => 'more',
            ];
        }

        if (!empty($result['notifications'])) {
            $this->ci->db->set('is_notify', '1')->where($params['where'])->update(SEND_VIP_TABLE);
            $result['new_vip'] = 1;

            return $result;
        }

        return false;
    }
}
