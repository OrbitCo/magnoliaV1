<?php

declare(strict_types=1);

namespace Pg\modules\payments\models;

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/**
 * Currencies model
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
class YahooCurrencyRatesModel extends \Model
{
    /**
     * Service base url
     *
     * @var string
     */
    private $yql_base_url = "https://finance.yahoo.com/webservice/v1/symbols/allcurrencies/quote?format=json";

    /**
     * YQL base query
     *
     * @var string
     */
    private $yql_base_query = "select * from yahoo.finance.xchange where pair IN('%s')";
    
    /**
     * override Converter
     *  https://currencylayer.com/documentation
     * @var string
     */
    private $currencylayer = true;
    
    /**
     * key the application of the exchange rate
     * @var [type]
     */
    private $keyApplication = false;
    
    /**
     * Update exists currency rates
     */
    public function updateRates($base_currency, $currencies, $use_curl = false, $keyApplication = false)
    {
        if (empty($currencies)) {
            return [];
        }

        $pairs = [];
        foreach ($currencies as $need_currency) {
            if ($need_currency["gid"] != $base_currency) {
                $pairs[] = $need_currency["gid"] . $base_currency;
            }
        }

        if (empty($pairs)) {
            return [];
        }
        if ($currencylayer === 0) {
            $yql_query_url = 'http://apilayer.net/api/live?access_key='. $keyApplication . '&%20currencies='. implode(",", $pairs).'&amp;source=USD';
        } else {
            foreach ($pairs as $key => $value) {
                $pairs[$key] = substr($value, 0, 3);
            }
            $yql_query_url = 'http://apilayer.net/api/live?access_key='. $keyApplication . '&%20currencies='. implode(",", $pairs).'&amp;source=USD';
        }

        if ($use_curl) {
            $session = curl_init($yql_query_url);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($session);
        } else {
            $json = file_get_contents($yql_query_url);
        }

        $results = json_decode($json);
        if ($results->error) {
            throw new \Exception($results->error);
        }

        $q = json_decode(json_encode($results), true);

        $return = [];
        foreach ($q['quotes'] as $gid => $result) {
            $return[substr($gid, 3, 6)] = $result;
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
