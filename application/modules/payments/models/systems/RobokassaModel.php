<?php

declare(strict_types=1);

namespace Pg\modules\payments\models\systems;

use Pg\modules\payments\models\PaymentDriverModel;

/**
 * Robocassa payment system driver model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright DATING PRO LTD <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class RobokassaModel extends PaymentDriverModel
{
    public $payment_data = [
        'gid'           => 'robokassa',
        'name'          => 'Robokassa',
        'settings_data' => 'a:3:{s:14:"merchant_login";s:5:"login";s:14:"merchant_pass1";s:9:"password1";s:14:"merchant_pass2";s:9:"password2";}',
        'logo'          => 'logo_robokassa.png',
    ];
    public $settings = [
        'merchant_login' => ['type' => 'text', 'content' => 'string', 'size' => 'middle'],
        'merchant_pass1' => ['type' => 'text', 'content' => 'string', 'size' => 'middle'],
        'merchant_pass2' => ['type' => 'text', 'content' => 'string', 'size' => 'middle'],
    ];
    protected $variables = [
        "OutSum"         => "amount",
        "InvId"          => "id_payment",
        "SignatureValue" => "hash",
    ];

    /**
     * Abailable languages
     *
     * @var array
     */
    protected $available_languages = ['en', 'ru'];
    protected $checkout_url = 'https://auth.robokassa.ru/Merchant/Index.aspx';

    public function funcRequest($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => $payment_data];

        $user_id = $this->ci->session->userdata('user_id');
        $this->ci->load->model('Users_model');
        $user = $this->ci->Users_model->get_user_by_id($user_id);

        $send_data = [
            'MerchantLogin'  => $system_settings["settings_data"]["merchant_login"],
            'OutSum'         => $payment_data["amount"],
            'InvId'          => $payment_data["id_payment"],
            'Description'    => $payment_data["payment_data"]["name"],
            'SignatureValue' => md5($system_settings["settings_data"]["merchant_login"] . ':' . $payment_data["amount"] . ':' . $payment_data["id_payment"] . ':' . $system_settings["settings_data"]["merchant_pass1"]),
            'Email'          => $user['email'],
        ];

        // for test
        // MerchantLogin=demo&OutSum=11&Description=Покупка в демо магазине&SignatureValue=2c113e992e2c985e43e348ff3c12f32b
        $demo_data = [
                'MerchantLogin'  => "demo",
                'OutSum'         => 11,
                'Description'    => "Покупка в демо магазине",
                'SignatureValue' => "2c113e992e2c985e43e348ff3c12f32b",
        ];

        $current_lang = $this->ci->pg_language->get_lang_by_id($this->ci->pg_language->current_lang_id);
        $current_lang['code'] = strtolower($current_lang['code']);

        if (in_array($current_lang['code'], $this->available_languages)) {
            $send_data['Culture'] = $current_lang['code'];
        }

        $this->send_data($this->checkout_url, $send_data, "post");
        // for test
        //$this->send_data($this->checkout_url, $demo_data, "post");

        // если ошибка 29 - проверить пароли в настройках аккаунта (или сгенерировать новые)
        // если ошибка 26 - проверить правильность id магазина - MerchantLogin

        return $return;
    }

    public function funcResponce($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => [], "type" => "exit"];

        foreach ($this->variables as $payment_var => $site_var) {
            $data[$site_var] = isset($payment_data[$payment_var]) ? $this->ci->input->xss_clean($payment_data[$payment_var]) : "";
        }

        $error = false;

        $this->ci->load->model("Payments_model");
        $site_payment_data = $this->ci->Payments_model->get_payment_by_id($data['id_payment']);
        if (floatval($site_payment_data["amount"]) != floatval($data['amount'])) {
            $error = true;
        }

        $server_side_hash = $data['amount'] . ':' . $data['id_payment'] . ':' . $system_settings["settings_data"]["merchant_pass2"];
        $server_side_hash = strtoupper(trim(md5($server_side_hash)));
        if ($server_side_hash != $data['hash']) {
            $error = true;
        }

        $return["data"] = $data;
        if ($error) {
            $return["data"]["status"] = -1;
        } else {
            $return["data"]["status"] = 1;
        }

        return $return;
    }

    public function getSettingsMap()
    {
        foreach ($this->settings as $param_id => $param_data) {
            $this->settings[$param_id]["name"] = l('system_field_' . $param_id, 'payments');
        }

        return $this->settings;
    }
}
