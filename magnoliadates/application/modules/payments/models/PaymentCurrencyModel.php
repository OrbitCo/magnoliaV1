<?php

declare(strict_types=1);

namespace Pg\modules\payments\models;

/**
 * Currencies model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (РЎСЂ, 02 Р°РїСЂ 2010) $ $Author: kkashkova $
 */
class PaymentCurrencyModel extends \Model
{
    /**
     * Database table name
     *
     * @var string
     */
    public const DB_TABLE_PAYMENTS_CURRENCY = DB_PREFIX . 'payments_currency';

    /**
     * Fields table
     *
     * @var array
     */
    private $fields = [
        'id',
        'gid',
        'abbr',
        'name',
        'per_base',
        'template',
        'is_default',
    ];
    private $currency_cache = [];

    public $default_currency = [];
    public $base_currency = [];
    public $currencies = [];

    private $currencies_all = null;

    /**
     * Currency rates updaters
     *
     * @var array
     */
    public $rates_updaters = ["yahoo", "xe"];

    public const CACHE_NAME  = 'currencies';

    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(self::DB_TABLE_PAYMENTS_CURRENCY);
        $this->default_currency = $this->getCurrencyDefault();
    }

    private function getAllCurrencies()
    {
        if ($this->currencies_all === null) {
            $model = $this;

            $this->currencies_all = $this->ci->cache->get(self::DB_TABLE_PAYMENTS_CURRENCY, 'all', function () use ($model) {
                $results_raw = $model->ci->db->select(implode(", ", $model->fields))
                    ->from(self::DB_TABLE_PAYMENTS_CURRENCY)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return null;
                }
                $results = [];
                foreach ($results_raw as $value) {
                    $results[$value['id']] = $value;
                    $results[$value['gid']] = $value;
                }

                return $results;
            });
        }

        return $this->currencies_all;
    }

    public function getCurrencyByGid(string $gid)
    {
        $currencies = $this->getAllCurrencies();

        foreach ($currencies as $currency) {
            if ($currency['gid'] === $gid) {
                $currency['is_default'] = 0;
                $this->currency_cache[$gid] = $currency;
            }
        }

        return $this->currency_cache[$gid] ?? [];
    }

    public function getCurrencyById(int $id)
    {
        $currencies = $this->getAllCurrencies();

        if (isset($currencies[$id])) {
            // $currencies[$id]['is_default'] = 0;
            $this->currency_cache[$id] = $currencies[$id];
        }

        return $this->currency_cache[$id] ?? [];
    }

    public function getCurrencyDefault($base = false)
    {
        $result = [];
        $currency_id = (int)$this->ci->session->userdata("currency_id");
        if ($currency_id && !$base) {
            $result = $this->getCurrencyById($currency_id);
            if (!empty($result)) {
                $result['is_default'] = 1;
                $this->currency_cache[$result["gid"]] = $result;
            }
        } else {
            $currencies = $this->getAllCurrencies();

            foreach ($currencies as $currency) {
                if ($currency['is_default']) {
                    $result = $this->currency_cache[$currency["gid"]] = $currency;

                    break;
                }
            }
        }

        return $result;
    }

    public function getCurrencyList($params = [], $filter_object_ids = null, $order_by = null)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(self::DB_TABLE_PAYMENTS_CURRENCY);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                $r['is_default'] = 0;
                if (empty($this->currency_cache[$r["gid"]])) {
                    $this->currency_cache[$r["gid"]] = $r;
                } else {
                    $r = $this->currency_cache[$r["gid"]];
                }
                $data[] = $r;
            }

            return $data;
        }

        return [];
    }

    public function getCurrencyListByKey($params = [], $filter_object_ids = null, $order_by = null)
    {
        $list = $this->get_currency_list($params, $filter_object_ids, $order_by);
        if (!empty($list)) {
            foreach ($list as $l) {
                $this->currencies[$l['id']] = $this->currencies[$l['gid']] = $data[$l['gid']] = $l;
            }

            return $data;
        }

        return [];
    }

    public function getCurrencyCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(self::DB_TABLE_PAYMENTS_CURRENCY);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    public function validateCurrency($id, $data)
    {
        $return = ["errors" => [], "data" => []];
        $this->ci->config->load('reg_exps', true);
        $name_expr = $this->ci->config->item('name', 'reg_exps');
        if (isset($data["gid"])) {
            $data["gid"] = strip_tags($data["gid"]);
            $data["gid"] = preg_replace("/[^a-z0-9]+/i", '', $data["gid"]);

            $return["data"]["gid"] = $data["gid"];

            if (empty($return["data"]["gid"])) {
                $return["errors"][] = l('error_currency_code_incorrect', 'payments');
            }

            $param["where"]["gid"] = $return["data"]["gid"];
            if (!empty($id)) {
                $param["where"]["id <>"] = $id;
            }
            $gid_count = $this->get_currency_count($param);
            if ($gid_count > 0) {
                $return["errors"][] = l('error_currency_code_already_exists', 'payments');
            }
        }

        if (isset($data["abbr"])) {
            $return["data"]["abbr"] = strip_tags($data["abbr"]);
            if (empty($return["data"]["abbr"])) {
                $return["errors"][] = l('error_abbr_required', 'payments');
            }
        }

        if (isset($data["template"])) {
            $return["data"]["template"] = $data["template"];
        }

        if (isset($data["name"])) {
            $return["data"]["name"] = $data["name"];
            if (empty($return["data"]["name"])) {
                $return["errors"][] = l('error_currency_name_required', 'payments');
            }
        }

        if (isset($data["per_base"])) {
            $return["data"]["per_base"] = (float) $data["per_base"];
        }

        if (isset($data["is_default"])) {
            $return["data"]["is_default"] = intval($data["is_default"]);
        }

        return $return;
    }

    public function saveCurrency($id, $data)
    {
        if (is_null($id)) {
            $this->ci->db->insert(self::DB_TABLE_PAYMENTS_CURRENCY, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(self::DB_TABLE_PAYMENTS_CURRENCY, $data);
        }
        unset($this->currency_cache[$data["gid"]]);

        $this->ci->cache->flush(self::DB_TABLE_PAYMENTS_CURRENCY);

        return $id;
    }

    public function setDefault($id)
    {
        $data["is_default"] = '0';
        $this->ci->db->update(self::DB_TABLE_PAYMENTS_CURRENCY, $data);

        $data["is_default"] = '1';
        $this->ci->db->where('id', $id);
        $this->ci->db->update(self::DB_TABLE_PAYMENTS_CURRENCY, $data);

        $this->ci->cache->flush(self::DB_TABLE_PAYMENTS_CURRENCY);
    }

    public function deleteCurrency($id)
    {
        $this->ci->db->where("id", $id);
        $this->ci->db->delete(self::DB_TABLE_PAYMENTS_CURRENCY);

        $this->ci->cache->flush(self::DB_TABLE_PAYMENTS_CURRENCY);
    }

    public function deleteCurrencyByGid($gid)
    {
        $this->ci->db->where("gid", $gid);
        $this->ci->db->delete(self::DB_TABLE_PAYMENTS_CURRENCY);
        unset($this->currency_cache[$gid]);
        $this->ci->cache->flush(self::DB_TABLE_PAYMENTS_CURRENCY);
    }

    /**
     * Return value into base currency
     *
     * @param float $value currency value
     * @param string $currency_gid currency GUID
     *
     * @return float|int
     */
    public function getValueIntoBaseCurrency($value, $currency_gid)
    {
        $base_currency = $this->ci->pg_module->get_module_config("payments", "base_currency");
        if ($currency_gid == $base_currency) {
            return $value;
        }

        $data = $this->get_currency_by_gid($currency_gid);
        if (!empty($data)) {
            return $value * $data["per_base"];
        }

        return 0;
    }

    /**
     * Update currencies rates
     *
     * @param string $rates_update_driver rates service
     */
    public function updateCurrencyRates($rates_update_driver)
    {
        $return = ["erros" => [], "data" => []];

        $base_currency = $this->ci->pg_module->get_module_config("payments", "base_currency");

        if (!$rates_update_driver || !in_array($rates_update_driver, $this->rates_updaters)) {
            $return["errors"][] = l("error_incorrect_rates_driver", "payments");

            return $return;
        }

        ob_start();
        phpinfo(INFO_MODULES);
        $contents = ob_get_contents();
        ob_end_clean();
        $use_curl = strpos($contents, "curl") !== false;

        $currencies = $this->get_currency_list();
        if (empty($currencies)) {
            $return["errors"][] = l("error_empty_currencies", "payments");

            return $return;
        }

        $model_name = $rates_update_driver . "_currency_rates_model";

        $keyApplication = $this->ci->pg_module->get_module_config('payments', 'rates_update_key');

        try {
            $this->ci->load->model("payments/models/" . $model_name, $model_name);
            $results = $this->ci->{$model_name}->update_rates($base_currency, $currencies, $use_curl, $keyApplication);
        } catch (Exception $e) {
            $return["errors"][] = $e->getMessage();

            return $return;
        }

        foreach ($results as $currency_gid => $per_base) {
            $data = $this->get_currency_by_gid($currency_gid);
            if (empty($data)) {
                continue;
            }
            $validate_data = $this->validate_currency($data["id"], ["per_base" => $per_base]);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->save_currency($data["id"], $validate_data["data"]);
        }

        return $return;
    }

    /**
     * Automatic update currencies rates
     */
    public function cronUpdateCurrencyRates()
    {
        $use_rates_update = $this->ci->pg_module->get_module_config("payments", "use_rates_update");
        if (!$use_rates_update) {
            exit;
        }

        $rates_update_driver = $this->ci->pg_module->get_module_config("payments", "rates_update_driver");
        $this->updateCurrencyRates($rates_update_driver);
    }

    /**
     * Return currecnies from cache
     */
    public function returnCurrencies()
    {
        if (!isset($this->currencies) || empty($this->currencies)) {
            $this->get_currency_list_by_key();
        }

        return $this->currencies;
    }

    public function convertToUSD($amount, $currency)
    {
        if ($currency == 'USD') {
            return $amount;
        }

        return $this->convertToCurrency($amount, $currency, 'USD');
    }

    public function convertToCurrency($amount, $currency_gid_from, $currency_gid_to)
    {
        $pattern_value = '/\[value\|([^]]*)\]/';

        $currency_from = $this->getCurrencyByGid($currency_gid_from);
        $currency_to = $this->getCurrencyByGid($currency_gid_to);

        if ($currency_from['per_base'] > 0 && $currency_to['per_base'] > 0) {
            $amount *= $currency_from['per_base'] / $currency_to['per_base'];
        }

        return $amount;
    }

    public function __call($name, $args)
    {
        $methods = [
            'cron_update_currency_rates' => 'cronUpdateCurrencyRates',
            'delete_currency' => 'deleteCurrency',
            'delete_currency_by_gid' => 'deleteCurrencyByGid',
            'get_currency_by_gid' => 'getCurrencyByGid',
            'get_currency_by_id' => 'getCurrencyById',
            'get_currency_count' => 'getCurrencyCount',
            'get_currency_default' => 'getCurrencyDefault',
            'get_currency_list' => 'getCurrencyList',
            'get_currency_list_by_key' => 'getCurrencyListByKey',
            'get_value_into_base_currency' => 'getValueIntoBaseCurrency',
            'return_currencies' => 'returnCurrencies',
            'save_currency' => 'saveCurrency',
            'set_default' => 'setDefault',
            'update_currency_rates' => 'updateCurrencyRates',
            'validate_currency' => 'validateCurrency',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
