<?php

declare(strict_types=1);

namespace Pg\modules\payments\models\systems;

use Pg\modules\payments\models\PaymentDriverModel;

/**
 * Offline payment driver model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class OfflineModel extends PaymentDriverModel
{
    public $payment_data = [
        'gid'           => 'offline',
        'name'          => 'Offline payment',
        'settings_data' => '',
        'logo'          => 'logo_offline.png',
    ];
    public $settings = [
    ];
    protected $variables = [
    ];
    public $html_fields = [
        "comment" => ["type" => "textarea", "content" => "string", "size" => "long"],
    ];
    public $info_fields = [
        "comment" => ["type" => "textarea", "content" => "string", "size" => "long"],
    ];

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
        return true;
    }

    public function funcValidate($payment_data, $system_settings)
    {
        $return = ["errors" => [], "info" => [], "data" => $payment_data];

        if (!empty($this->html_fields)) {
            foreach ($this->html_fields as $param_id => $param_data) {
                if ($param_data["content"] == "string") {
                    $return["data"][$param_id] = trim(strip_tags($payment_data[$param_id]));
                } elseif ($param_data["content"] == "int") {
                    $return["data"][$param_id] = intval($payment_data[$param_id]);
                } else {
                    $return["data"][$param_id] = $payment_data[$param_id];
                }
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
    
    public function getHtmlMap()
    {
        foreach ($this->html_fields as $param_id => $param_data) {
            $this->html_fields[$param_id]["name"] = l('html_field_' . $param_id, 'payments');
        }

        return $this->html_fields;
    }
}
