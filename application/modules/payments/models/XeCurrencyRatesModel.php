<?php

declare(strict_types=1);

namespace Pg\modules\payments\models;

use KubAT\PhpSimple\HtmlDomParser;

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/**
 * XE currency rates model (from xe.com)
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
class XeCurrencyRatesModel extends \Model
{
    /**
     * Xe url template
     *
     * @var string
     */
    private $xe_url = "http://www.xe.com/currencyconverter/convert/?Amount=1&From=%s&To=%s";

    /**
     * Update exists currency rates
     */
    public function updateRates($base_currency, $currencies, $use_curl = false)
    {
        if (empty($currencies)) {
            return [];
        }

        $return = [];
        foreach ($currencies as $need_currency) {
            if ($need_currency["gid"] == $base_currency) {
                continue;
            }

            $url_rate = sprintf($this->xe_url, $need_currency["gid"], $base_currency);

            if ($use_curl) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url_rate);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
                $content = curl_exec($curl);
                curl_close($curl);
            } else {
                $content = file_get_contents($url_rate);
            }
            $html = HtmlDomParser::str_get_html($content);
            //Cnvrsn
            foreach ($html->find(".uccResultAmount") as $amount) {
                $return[$need_currency["gid"]] = $amount->plaintext;
            }
        }

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'update_rates' => 'updateRates',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
