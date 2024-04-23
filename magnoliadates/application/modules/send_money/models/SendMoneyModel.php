<?php

declare(strict_types=1);

namespace Pg\modules\send_money\models;

/**
 * Send_money module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define('SEND_MONEY_TABLE', DB_PREFIX . 'send_money');

/**
 * Base model
 *
 * @package     PG_Dating
 * @subpackage  Send_money
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2015 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SendMoneyModel extends \Model
{
    const MODULE_GID = 'send_money';

    /**
     * Payment type as write off from account
     */
    const PAYMENT_TYPE_ACCOUNT = 'account';

    /**
     * Payment type as write off from account and direct payment
     */
    const PAYMENT_TYPE_ACCOUNT_AND_DIRECT = 'account_and_direct';

    /**
     * Payment type as direct payment
     */
    const PAYMENT_TYPE_DIRECT = 'direct';

    /**
     * Transaction status waiting
     *
     * @var string
     */
    const STATUS_WAITING = 'waiting';

    /**
     * Transaction status decline
     *
     * @var string
     */
    const STATUS_DECLINE = 'decline';

    /**
     * Transaction status approve
     *
     * @var string
     */
    const STATUS_APPROVE = 'approve';

    /**
     * Send_money object properties
     *
     * @var array
     */
    protected $fields = [
        'id',
        'id_user',
        'id_sender',
        'amount',
        'status',
        'declined_by_sender',
        'date_created',
        'full_amount',
        'is_notify'
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
                $return['errors'][] = l('admin_errors_use_fee', 'send_money');
            }
        }
        if (isset($settings['fee_price']) && !empty($settings['fee_price'])) {
            $return['data']['fee_price'] = floatval($settings['fee_price']);
        }
        if (isset($settings['fee_currency']) && !empty($settings['fee_currency'])) {
            if (in_array($settings['fee_currency'], $settings['currencies'])) {
                $return['data']['fee_currency'] = $settings['fee_currency'];
            } else {
                $return['errors'][] = l('admin_errors_fee_currency', 'send_money');
            }
        }
        if (isset($settings['to_whom'])) {
            if (in_array($settings['to_whom'], ['to_all', 'to_friends'])) {
                $return['data']['to_whom'] = $settings['to_whom'];
            } else {
                $return['errors'][] = l('admin_errors_to_whom', 'send_money');
            }
        }
        if (isset($settings['transfer_type'])) {
            if (in_array($settings['transfer_type'], $this->getAllowedPaymentTypes())) {
                $return['data']['transfer_type'] = $settings['transfer_type'];
            } else {
                $return['errors'][] = l('admin_errors_transfer_type', 'send_money');
            }
        }

        return $return;
    }

    /**
     * Transaction Data
     *
     * @param array $params
     * @param boolean $format
     *
     * @return array
     */
    public function getTransactionData($params = [], $format = true)
    {
        $this->ci->db->select(implode(', ', $this->fields));
        $this->ci->db->from(SEND_MONEY_TABLE);
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

    public function getTransaction($transaction_id = null, $page = null, $items_on_page = 0)
    {
        if (isset($transaction_id)) {
            $result = $this->ci->db
                ->select(implode(", ", $this->fields))
                ->from(SEND_MONEY_TABLE)
                ->where('id', $transaction_id)
                ->order_by('date_created DESC')
                ->get()
                ->row_array();
        } else {
            $this->ci->db
                ->select(implode(", ", $this->fields))
                ->from(SEND_MONEY_TABLE)
                ->order_by('date_created DESC');
                
            if ($page) {
                $this->ci->db->limit($items_on_page, $items_on_page * (min((int)$page, 1) - 1));
            }
            
            $result = $this->ci->db->get()->result_array();
        }

        return $result;
    }

    public function getTransactionsCount()
    {
        return $this->ci->db->from(SEND_MONEY_TABLE)->count_all_results();
    }

    /**
     * Format Transaction Data
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

        $users_ids = [];

        foreach ($data as $item) {
            $users_ids[] = $item['id_sender'];
        }

        $this->ci->load->model(['UsersModel', 'users/models/UsersDeletedModel']);

        $users_list = $this->ci->UsersModel->getUsersListByKey(null, null, null, [], $users_ids);
        $default_user = $this->ci->UsersModel->formatDefaultUser(1);
        $deleted_users = $this->ci->UsersDeletedModel->getUsersList(null, null, null, [
            'where_in' => [
                'id_user' => $users_ids,
            ]
        ]);
            
        foreach ($data as $key => $item) {
            if (isset($users_list[$item['id_sender']]['id'])) {
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

    public function validateTransaction($transaction_id, $validate_data)
    {
        $return = ['errors' => [], 'data' => []];

        $this->ci->load->model('UsersModel');

        $user = $this->ci->UsersModel->getUserById($this->ci->session->userdata('user_id'));

        $pay_type = $this->pg_module->get_module_config('send_money', 'transfer_type');
        if ($pay_type == self::PAYMENT_TYPE_ACCOUNT && ($validate_data['full_amount'] > $user['account'])) {
            $return['errors']['full_amount'] = l('send_money_few_funds', 'send_money');
        }

        $return['data']['amount']      = number_format(floatval($validate_data['amount']), 2, '.', '');
        $return['data']['full_amount'] = number_format(floatval($validate_data['full_amount']), 2, '.', '');

        if (empty($validate_data['id_user'])) {
            $return['errors'][] = l('send_money_no_recipient', 'send_money');
        } else {
            $return['data']['id_user'] = $validate_data['id_user'];
        }

        if (isset($transaction_id)) {
            $return['data']['transaction_id'] = $transaction_id;
        }

        if (!isset($validate_data['id_sender'])) {
            $return['errors'][] = l('send_money_no_sender', 'send_money');
        } else {
            $return['data']['id_sender'] = $validate_data['id_sender'];
            $return['validate']['sender_account'] = $user['account'];
        }

        return $return;
    }

    public function saveTransaction($transaction_id, $transaction_data)
    {
        if (!$transaction_id) {
            $this->ci->db->insert(SEND_MONEY_TABLE, $transaction_data);
            $transaction_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $transaction_data['id']);
            $this->ci->db->update(SEND_MONEY_TABLE, $transaction_data);
        }

        return $transaction_id;
    }

    public function statusTransaction($transaction_id, $status)
    {
        $transaction_data = $this->getTransaction($transaction_id);
        if ($transaction_data['status'] == 'waiting') {
            $this->ci->load->model(['UsersModel', 'ChatboxModel']);
            $recepient = $this->ci->UsersModel->getUserById($transaction_data['id_user']);
            $sender = $this->ci->UsersModel->getUserById($transaction_data['id_sender']);
            if ($status == 'approve') {
                $transaction_data['status'] = 'approved';
                $return = l('send_money_approved', 'send_money');
                $payment_type_gid = 'approve_send_money';
                $payment_data = ['id_user' => $transaction_data['id_user']];
                $message = $recepient['output_name'] . ' - ' 
                . l('payment_stat_send_money', 'send_money', $sender['lang_id']) . ' ' 
                . strtolower(l('send_money_approved', 'send_money', $sender['lang_id']));    
                $this->ci->ChatboxModel->addMessage($transaction_data['id_sender'], $transaction_data['id_sender'], $message, true, true); 
            } elseif ($status == 'decline') {
                $transaction_data['status'] = 'declined';
                if ($this->ci->session->userdata('user_id') == $sender['id']) {
                    $transaction_data['declined_by_sender'] = 1;
                    $return = l('send_money_declined_by_me', 'send_money');
                } elseif ($this->ci->session->userdata('user_id') == $recepient['id']) {
                    $return = l('send_money_declined_by_me', 'send_money');
                    $message = $recepient['output_name'] . ' - ' . l('payment_stat_send_money_decline', 'send_money', $sender['lang_id']);    
                    $this->ci->ChatboxModel->addMessage($transaction_data['id_sender'], $transaction_data['id_sender'], $message, true, true); 
                } else {
                    $return = l('send_money_declined', 'send_money');
                }
                $payment_type_gid = 'decline_send_money';
                $payment_data = ['id_user' => $transaction_data['id_sender']];
            }
           /**
            * Save add on the account statistics
            */
            $this->ci->load->model("UsersPaymentsModel");
            
            $payment_data['amount'] = $transaction_data['amount'];
            $payment_data['operation_message'] = $return;
            
            $this->ci->UsersPaymentsModel->updateUserAccount(
                $payment_data,
                1,
                $payment_type_gid,
                ['lang' => 'payment_stat_send_money'. ($status == 'decline' ? '_'.$status : ''),
                 'module' => self::MODULE_GID]
            );
            
            $this->saveTransaction($transaction_id, $transaction_data);
        } else {
            $return = l('admin_view_no_data', 'send_money');
        }

        return $return;
    }

    /**
     * Update membership payment status
     *
     * callback method for payment module
     *
     * Expected status values: 1, 0, -1
     *
     * @param array   $payment        payment data
     * @param integer $payment_status payment status
     *
     * @return void
     */
    public function paymentSendMoneyStatus($payment, $payment_status)
    {
        if ($payment_status != 1) {
            return;
        }
        $transaction_data = $payment["payment_data"]["transaction"];
        $transaction_data['id_transaction'] = $this->saveTransaction(null, $transaction_data);
        $transaction_data['currency_gid']   = $payment['currency_gid'];
        $this->sendLetter($transaction_data);
    }

    public function sendLetter($data)
    {
        $this->ci->load->model(['notifications/models/NotificationsModel', 'ChatboxModel']);
        $receiver = $this->ci->UsersModel->getUserById($data['id_user']);
        $sender = $this->ci->UsersModel->getUserById($data['id_sender']);
        $return = $this->ci->NotificationsModel->sendNotification(
            $receiver['email'],
            'send_money_msg',
            [
                'money' => $data['amount'] . " " . $data['currency_gid'],
                'approve' => l('send_money_approve', 'send_money', $receiver['lang_id']),
                'decline' => l('send_money_decline', 'send_money', $receiver['lang_id']),
                'sender' => $sender['output_name'],
                'id' => $data['id_transaction']
            ],
            '',
            $receiver['lang_id']
        );

        $message = ' 🎉 ' . l('field_text_send_money_notify', 'send_money', $receiver['lang_id']) 
        . ' ' . $sender['output_name'] . '  <i class="fa fa-long-arrow-alt-right"></i>  <a href="' . site_url() . 'users/account/donate"> ' 
        . l('send_money_view_gifts', 'send_money', $receiver['lang_id']) . '</a>';
        

        $this->ci->ChatboxModel->addMessage($data['id_user'], $data['id_user'], $message, true, true);

        if (!empty($return['errors'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *  Site map xml
     *
     *  @return array
     */
    public function getSitemapXmlUrls()
    {
        $this->ci->load->helper('seo');
        return [];
    }

    public function backendGetRequestMoney()
    {
        $params = [
            'where' => [
                'is_notify' => 0,
                'status' => self::STATUS_WAITING,
                'declined_by_sender' => 0,
                'id_user' => $this->ci->session->userdata('user_id')
            ]
        ];
        $money = $this->getTransactionData($params, true);
        $result = ['notifications' => [], 'new_money' => 0];
        foreach ($money as $item) {
            $result['notifications'][] = [
                'title' => l('field_title_send_money_notify', self::MODULE_GID),
                'text' => l('field_text_send_money_notify', self::MODULE_GID) . ' ' . $item['sender']['output_name'],
                'id' => $item['id'],
                'user_id' => $item['sender']['id'],
                'user_name' => $item['sender']['output_name'],
                'user_icon' => $item['sender']['media']['user_logo']['thumbs']['small'],
                'link' => rewrite_link('users', 'account', 'donate'),
                'more' => 'more',
            ];
        }
        if (!empty($result['notifications'])) {
            $this->ci->db->set('is_notify', '1')->where($params['where'])->update(SEND_MONEY_TABLE);
            $result['new_money'] = 1;
            return $result;
        }
        return false;
    }
}
