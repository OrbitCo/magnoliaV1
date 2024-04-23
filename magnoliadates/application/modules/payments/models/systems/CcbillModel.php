<?php

declare(strict_types=1);

namespace Pg\modules\payments\models\systems;

use Pg\modules\payments\models\PaymentDriverModel;

/**
 * CCBill payment system driver model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright 2017 CCBill <http://www.ccbill.com/>
 * @author CCBill <damiancommerce@gmail.com>
 *
 * @version $Revision: 1 $ $Date: 2018-04-02 15:07:07 -0700 (Ср, 01 апр 2017) $ $Author: ccbill $
 */
class CcbillModel extends PaymentDriverModel
{
  //$install_lang["system_field_client_accnum"] = "Client Account No";
    public $payment_data = [
        'gid'           => 'ccbill',
        'name'          => 'CCBill',
        'settings_data' => 'a:6:{s:13:"ccbill_client_accnum";s:6:"XXXXXX";s:13:"ccbill_client_subacc";s:4:"XXXX";s:4:"ccbill_salt";s:0:"";s:9:"ccbill_form_name";s:0:"";s:13:"ccbill_is_flexform";s:0:"";s:13:"ccbill_currency_code";s:3:"978"}',   // "USD" - 840  "EUR" - 978  "AUD" - 036  "CAD" - 124  "GBP" - 826  "JPY" - 392
        'logo'          => 'logo_ccbill.png',
    ];
    public $settings = [
        "ccbill_client_accnum" => ["type" => "text", "content" => "string", "size" => "middle"],
        "ccbill_client_subacc" => ["type" => "text", "content" => "string", "size" => "middle"],
        "ccbill_salt"          => ["type" => "text", "content" => "string", "size" => "middle"],
        "ccbill_form_name"     => ["type" => "text", "content" => "string", "size" => "middle"],
        "ccbill_is_flexform"   => ["type" => "text", "content" => "string", "size" => "middle"],
        "ccbill_currency_code" => ["type" => "text", "content" => "string", "size" => "middle"],
    ];

    // variables returned from response
    protected $variables =
        [
            "Action"          => "action",
            "customer_fname"  => "customerFirstName",
            "customer_lname"  => "customerLastName",
            "subscription_id" => "subscriptionId",
            "address1"        => "address1",
            "city"            => "city",
            "state"           => "state",
            "country"         => "country",
            "zipcode"         => "zipcode",
            "formName"        => "formName",
            "responseDigest"  => "responseDigest",
            "initialPrice"    => "amount",
            "ip_address"      => "ipAddress",
            "zc_orderid"      => "id_payment",
        ];

    const DAYS_IN_MONTH = 30;
    const DAYS_IN_YEAR = 365;
    const MIN_PERIOD_IN_DAYS = 2;

    public function funcRequest($payment_data, $system_settings)
    {
      
        $return = ["errors" => [], "info" => [], "data" => $payment_data];


        $isFlex = $system_settings['settings_data']['ccbill_is_flexform'] == "true";

        $priceVarName  = $isFlex ? "initialPrice"  : "formPrice";
        $periodVarName = $isFlex ? "initialPeriod" : "formPeriod";

        $billingPeriodInDays = $this->getBillingPeriod($payment_data);


 

        $currencyCode = $system_settings["settings_data"]["ccbill_currency_code"];
        $salt         = $system_settings["settings_data"]["ccbill_salt"];

        $formName = $system_settings['settings_data']['ccbill_form_name'];

        $postUrl = $isFlex ?
                   'https://api.ccbill.com/wap-frontflex/flexforms/' . $formName
                 : 'https://bill.ccbill.com/jpost/signup.cgi';


        // sandbox
        // $postUrl = 'https://sandbox-api.ccbill.com/wap-frontflex/flexforms/'. $formName;

        $transactionAmount = number_format($payment_data["amount"], 2, '.', '');

        $stringToHash = $transactionAmount . $billingPeriodInDays . $currencyCode . $salt;

        $hash = md5($stringToHash);

        $send_data = [
            $priceVarName  => $transactionAmount, // $system_settings["settings_data"]["ccbill_"],
            $periodVarName => $billingPeriodInDays,
            "clientAccnum" => $system_settings["settings_data"]["ccbill_client_accnum"],
            "clientSubacc" => $system_settings["settings_data"]["ccbill_client_subacc"],
            "formName"     => $formName,
            "currencyCode" => $currencyCode,
            "formDigest"   => $hash,
            "zc_orderid"   => $payment_data["id"],
        ];
        $this->send_data($postUrl, $send_data, "post"); // TODO: URL here too

        return $return;
    }

    public function funcResponce($payment_data, $system_settings)
    {
      // Debug: log the response
      // file_put_contents("ccbill_log.txt", "\r\n\r\n\r\n=============== " . date("Y-m-d | h:i:sa") . " ==========\r\n\r\n", FILE_APPEND);
      // file_put_contents("ccbill_log.txt", json_encode($payment_data), FILE_APPEND);

        $isFlex = $system_settings['settings_data']['ccbill_is_flexform'] == "true";

        $priceVarName  = $isFlex ? "initialPrice"  : "formPrice";
        $periodVarName = $isFlex ? "initialPeriod" : "formPeriod";

        $currencyCode = $system_settings["settings_data"]["ccbill_currency_code"];
        $salt         = $system_settings["settings_data"]["ccbill_salt"];

      // Verify the result
        $verify = $this->verifyData($payment_data, $system_settings);

        $verifyText = $verify ? "true" : "false";

      // file_put_contents("ccbill_log.txt", "\r\n\r\nVerify Result: " . $verifyText, FILE_APPEND);

        $return = ["errors" => [], "info" => [], "data" => [], "type" => "exit"];

        if (!$verify) {
            exit;
        }// end if

        foreach ($this->variables as $payment_var => $site_var) {
            $return["data"][$site_var] = isset($payment_data[$payment_var]) ? $this->ci->input->xss_clean($payment_data[$payment_var]) : "";
        }// end foreach

        $orderId = $payment_data['zc_orderid'];
        $orderAmount = 0;

        if (isset($payment_data['initialPrice'])) {
            $orderAmount       = $payment_data['initialPrice'];
        }
        if (isset($payment_data['formPrice'])) {
            $orderAmount       = $payment_data['formPrice'];
        }

        $this->ci->load->model("Payments_model");
        $site_payment_data = $this->ci->Payments_model->get_payment_by_id($orderId);

        if (floatval($site_payment_data["amount"]) != floatval($orderAmount)) {// ||
            $error = true;
            // file_put_contents("ccbill_log.txt", "\r\n\r\nerror", FILE_APPEND);
        }

      // file_put_contents("ccbill_log.txt", "\r\n\r\nno error: " . json_encode($return["data"]), FILE_APPEND);

      // We know the payment was successful if we got here
        $return["data"]["status"] = 1;

      // file_put_contents("ccbill_log.txt", "\r\n\r\nreturning", FILE_APPEND);


        return $return;
    }

    public function getSettingsMap()
    {

        /*
        foreach ($this->settings as $param_id => $param_data) {
            $this->settings[$param_id]["name"] = l('system_field_' . $param_id, 'payments');
        }
        */
        // Hard code labels for now
        $this->settings["ccbill_client_accnum"]["name"] = "Client Account No";
        $this->settings["ccbill_client_subacc"]["name"] = "Client Subaccount No";
        $this->settings["ccbill_salt"]["name"]          = "Salt";
        $this->settings["ccbill_form_name"]["name"]     = "Form Name";
        $this->settings["ccbill_is_flexform"]["name"]   = "Is FlexForm";
        $this->settings["ccbill_currency_code"]["name"] = "Currency Code";

        return $this->settings;
    }

    private function verifyData($payment_data, $system_settings)
    {
      /*
        $req = 'cmd=_notify-validate';

        foreach ($payment_data as $key => $value) {
            $req .= '&' . $key . '=' . urlencode(stripslashes($value));
        }
      */

        $success = false;

        // Load settings
        $isFlex = $system_settings["settings_data"]["ccbill_is_flexform"] == "true";

        $priceVarName  = $isFlex ? "initialPrice"  : "formPrice";
        $periodVarName = $isFlex ? "initialPeriod" : "formPeriod";

        $currencyCode = $system_settings["settings_data"]["ccbill_currency_code"];
        $salt         = $system_settings["settings_data"]["ccbill_salt"];

        // Verify the Result
        $myAction = isset($payment_data["action"]) ? $payment_data["action"] : null;

        if ($myAction == "approve" || $myAction == "decline") {
            $subscriptionId = 0;
            $mySuccess = 0;
            $encrypted = '';
            $decrypted = '';
            $myOrderId = -1;
            $cardType  = '';
            $responseDigest = '';

            if (isset($payment_data['subscription_id'])) {
                $subscriptionId = $payment_data['subscription_id'];
            }
            if (isset($payment_data['subscriptionId'])) {
                $subscriptionId = $payment_data['subscriptionId'];
            }

            if ($myAction == 'approve' && isset($payment_data['email']) && $subscriptionId != 0) {
                $mySuccess = 1;
                $result = 'VERIFIED';

                if (isset($payment_data['subscription_id'])) {
                    $subscriptionId = $payment_data['subscription_id'];
                }
                if (isset($payment_data['customer_fname'])) {
                    $myFirstName    = $payment_data['customer_fname'];
                }
                if (isset($payment_data['customer_lname'])) {
                    $myLastName     = $payment_data['customer_lname'];
                }
                if (isset($payment_data['email'])) {
                    $myEmail        = $payment_data['email'];
                }
                if (isset($payment_data['accountingAmount'])) {
                    $myAmount       = $payment_data['accountingAmount'];
                }
                if (isset($payment_data['initialPrice'])) {
                    $myAmount       = $payment_data['initialPrice'];
                }
                if (isset($payment_data['formPrice'])) {
                    $myAmount       = $payment_data['formPrice'];
                }
                //if(isset($payment_data['currencyCode']))     $myCurrencyCode = $payment_data['currencyCode'];
                if (isset($payment_data['zc_orderid'])) {
                    $myOrderId      = $payment_data['zc_orderid'];
                }
                if (isset($payment_data['cardType'])) {
                    $cardType       = $payment_data['cardType'];
                }
                if (isset($payment_data['responseDigest'])) {
                    $responseDigest = $payment_data['responseDigest'];
                }

                // file_put_contents("ccbill_log.txt", "\r\n\r\nsubscriptionId: " . $subscriptionId, FILE_APPEND);

                if (strlen($subscriptionId . '') > 0) {
                    // Validate the response digest

                    // If using FlexForms, remove leading zeroes from subscription id before computing the hash
                    if ($isFlex) {
                        $subscriptionId = ltrim($subscriptionId, '0');
                    }// end if

                    $stringToHash = $subscriptionId . '1' . $salt;

                   // file_put_contents("ccbill_log.txt", "\r\n\r\nstringToHash: " . $stringToHash, FILE_APPEND);

                    $myDigest = md5($stringToHash);

                    // file_put_contents("ccbill_log.txt", "\r\n\r\nDigest Comparison: " . $myDigest . " : " . $responseDigest, FILE_APPEND);

                    if ($myDigest == $responseDigest) {
                        $success = true;
                    }// end if
                }// end if
            }
            elseif ($myAction == 'decline') {
                //if(isset($_POST['denialId'])) $txId = $_POST['denialId'];
                // $mySuccess = 0;die('failure');
                $success = false;
            }// end if/else
        }// end if response is either approval or denial

        return $success;
    }

    private function getBillingPeriod($payment_data)
    {
        $billingPeriodInDays = self::MIN_PERIOD_IN_DAYS;

        if ($payment_data['payment_data']['module'] == 'services') {
            $this->ci->load->model('services/models/Services_model');
            $service = $this->ci->Services_model->getServiceById($payment_data['payment_data']['id_service']);
            return $service['data_admin']['period'];
        }
        elseif ($payment_data['payment_data']['module'] == 'send_vip') {
            $period_data = explode("_", $payment_data['payment_data']['transaction']['membership_obj']);
            $period_id = $period_data[1];
            $this->ci->load->model('access_permissions/models/Access_permissions_groups_model');
            $period = $this->ci->Access_permissions_groups_model->getPeriodsList(null, ['where' => ['id' => $period_id]]);
            $group_data['period'] = $period[0];
        } else {
            if ($payment_data['payment_data']['module'] != 'access_permissions' ||
              empty($payment_data['payment_data']['group_gid']) ||
              empty($payment_data['payment_data']['period_id'])) {
                return $billingPeriodInDays;
            }
        }

        if ($payment_data['payment_data']['module'] == 'access_permissions') {
            $this->ci->load->model('access_permissions/models/Access_permissions_settings_model');
            $group_data = $this->ci->Access_permissions_settings_model
              ->getAccessData($this->ci->session->userdata['auth_type'])
              ->getGroupData(
                  $payment_data['payment_data']['group_gid'],
                  [
                      'where' => [
                          'id' => $payment_data['payment_data']['period_id']
                      ]
                  ]
              );
        }

        switch ($group_data['period']['period_type']) {
            case 'days':
                $billingPeriodInDays = $group_data['period']['period'];
                break;
            case 'months':
                $billingPeriodInDays = $group_data['period']['period'] * self::DAYS_IN_MONTH;
                break;
            case 'years':
                $billingPeriodInDays = $group_data['period']['period'] * self::DAYS_IN_YEAR;
                break;
        }

        return $billingPeriodInDays;
    }
}
