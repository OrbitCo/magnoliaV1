<?php

declare(strict_types=1);

namespace Pg\modules\payments\models;

/**
 * Payment system driver main model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class PaymentDriverModel extends \Model
{
    public $settings = [];
    public $html_fields = [];
    protected $variables = [];
    public $request_return_type = "redirect";

    public function funcRequest($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => $payment_data];

        return $return;
    }

    public function funcResponce($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => $payment_data];

        return $return;
    }

    public function funcHtml()
    {
        return false;
    }

    public function funcValidate($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => $payment_data];

        return $return;
    }

    public function validateSettings($data)
    {
        $return = ["errors" => [], "data" => []];

        if (!empty($this->settings)) {
            foreach ($this->settings as $param_id => $param_data) {
                if (is_array($param_data)) {
                    $value = isset($data[$param_id]) ? $data[$param_id] : "";
                } else {
                    $value = $param_data;
                }

                switch ($param_data["content"]) {
                    case "float":
                        $value = floatval($value);
                        break;
                    case "int":
                        $value = intval($value);
                        break;
                    case "string":
                        $value = trim(strip_tags($value));
                        break;
                    case "html":
                        break;
                }
                $return["data"][$param_id] = $value;
            }
        }

        return $return;
    }

    public function getSettingsMap()
    {
        return $this->settings;
    }

    public function getHtmlMap()
    {
        return $this->html_fields;
    }

    public function sendData($url, $data = [], $method = "post")
    {
        if ($this->ci->router->is_api_class) {
            return false;
        } elseif ($method === "get") {
            $get = [];
            foreach ($data as $key => $value) {
                $get[] = "$key=$value";
            }
            $get = implode('&', $get);
            if ($this->ci->is_pjax) {
                redirect("{$url}?{$get}", 'hard');
            } else {
                header("Location: {$url}?{$get}");
            }
            exit;
        } elseif ($method === "post") {
            $retHTML = '';
            if (!$this->ci->is_pjax) {
                $retHTML .= '<html><body onLoad="document.send_form.submit();">';
            }
            $retHTML .= '<form method="post" name="send_form" id="send_form" action="' . $url . '">';
            foreach ($data as $key => $value) {
                $retHTML .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
            }
            if ($this->ci->is_pjax) {
                $retHTML .= '</form><script>document.getElementById("send_form").submit();</script>';
            } else {
                $retHTML .= '</form></body></html>';
            }
            print $retHTML;
            exit;
        }

        return false;
    }

    public function funcJs()
    {
        return false;
    }

    public function getJs($payment_data, $system_settings)
    {
        return '';
    }

    public function __call($name, $args)
    {
        $methods = [
            'send_data' => 'sendData',
            'validate_settings' => 'validateSettings',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
