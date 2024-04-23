<?php

declare(strict_types=1);

namespace Pg\modules\payments\models\systems;

use Pg\modules\payments\models\PaymentDriverModel;

/**
 * Paypal payment system driver model
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
class PaypalModel extends PaymentDriverModel
{
    public $payment_data = [
        'gid'           => 'paypal',
        'name'          => 'Paypal',
        'settings_data' => 'a:1:{s:9:"seller_id";s:0:"";}',
        'logo'          => 'logo_paypal.png',
    ];
    public $settings = [
        "seller_id" => ["type" => "text", "content" => "string", "size" => "middle"],
    ];
    protected $variables = [
        "business"    => "seller_id",
        "mc_gross"    => "amount",
        "mc_currency" => "currency",
        "custom"      => "id_payment",
        "test_ipn"    => "test_mode",
    ];

    public function funcRequest($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => $payment_data];

        $send_data = [
            "business"      => $system_settings["settings_data"]["seller_id"],
            "amount"        => $payment_data["amount"],
            "currency_code" => $payment_data["currency_gid"],
            "charset"       => 'utf-8',
            "custom"        => $payment_data["id_payment"],
            "test_ipn"      => "0",
            "rm"            => "2",
            "return"        => site_url(),
            "notify_url"    => site_url() . "payments/responce/paypal",
            "cancel_return" => site_url(),
            "cmd"           => "_xclick",
            "item_name"     => $payment_data["payment_data"]["name"],
        ];
        $this->sendData("https://www.paypal.com/cgi-bin/webscr", $send_data, "post");

        return $return;
    }

    public function funcResponce($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => [], "type" => "exit"];

        // verify
        $verify = $this->verifyData($payment_data);

        if (!$verify) {
            exit;
        }

        foreach ($this->variables as $payment_var => $site_var) {
            $return["data"][$site_var] = isset($payment_data[$payment_var]) ? $this->ci->input->xss_clean($payment_data[$payment_var]) : "";
        }

        $this->ci->load->model("Payments_model");
        $site_payment_data = $this->ci->Payments_model->get_payment_by_id($return["data"]['id_payment']);
        if (
            floatval($site_payment_data["amount"]) != floatval($return["data"]['amount']) ||
            $site_payment_data["currency_gid"] != $return["data"]['currency']
        ) {
            $error = true;
        }

        //// get status
        $return["data"]["status"] = 0;
        if (isset($payment_data['payment_status'])) {
            switch ($payment_data['payment_status']) {
                case "Completed":
                    $return["data"]["status"] = 1;

                    break;
                case "Pending":
                    $return["data"]["status"] = 0;

                    break;
                default:
                    $return["data"]["status"] = -1;

                    break;
            }
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

    private function verifyData($payment_data)
    {
        $req = 'cmd=_notify-validate';

        foreach ($payment_data as $key => $value) {
            $req .= '&' . $key . '=' . urlencode(stripslashes($value));
        }

        $verify_url = 'www.paypal.com';

        if (function_exists('curl_init')) {
            $ch = curl_init('https://' . $verify_url . '/cgi-bin/webscr');
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Connection: Close']);
            $res = curl_exec($ch);
            curl_close($ch);
        } else {
            $header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

            $fp = fsockopen('ssl://' . $verify_url, 443, $errno, $errstr, 10);
            fputs($fp, $header . $req);

            while (!feof($fp)) {
                $res = fgets($fp, 1024);

                break;
            }
        }

        if (strcmp($res, "VERIFIED") == 0) {
            return true;
        } elseif (strcmp($res, "INVALID") == 0) {
        }

        return false;
    }
}
