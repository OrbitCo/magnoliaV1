<?php

declare(strict_types=1);

namespace Pg\modules\services\models;

use Pg\Libraries\EventDispatcher;

use Pg\modules\services\models\events\EventServices;

define('SERVICES_TEMPLATES_TABLE', DB_PREFIX.'services_templates');
define('SERVICES_TABLE', DB_PREFIX.'services');
define('SERVICES_LOG_TABLE', DB_PREFIX.'services_log');

/**
 * Services main model.
 *
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class ServicesModel extends \Model
{
    public const DB_DEFAULT_DATE = '0000-00-00 00:00:00';

    public const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Payment type gid prefix.
     *
     * @var string
     */
    public const PAYMENT_TYPE_GID_PREFIX = 'services_';

    /**
     * Module GUID.
     *
     * @var string
     */
    public const MODULE_GID = 'services';

    /**
     * Template object properties.
     *
     * data_admin = array("key" => "type") type = text/string/int/price/checkbox
     * data_user = array("key" => "type") type = text/string/int/price/checkbox/hidden (hidden - user form controller will be wait get or post data)
     *
     * @var array
     */
    private $template_fields = [
        'id',
        'gid',
        'callback_module',
        'callback_model',
        'callback_buy_method',
        'callback_activate_method',
        'callback_validate_method',
        'price_type',
        'data_admin',
        'data_user',
        'lds',
        'date_add',
        'moveable',
        'is_membership',
        'data_membership',
        'alert_activate',
    ];

    /**
     * Services object properties.
     *
     * @var array
     */
    private $service_fields = [
        'id',
        'gid',
        'template_gid',
        'type',
        'user_type_disabled',
        'user_type_disabled_code',
        'pay_type',
        'status',
        'cant_activate_from_services',
        'price',
        'can_free',
        'data_admin',
        'lds',
        'id_membership',
        'date_add',
    ];

    private $services_all = null;

    private $templates_all = null;

    /**
     * Class constructor.
     *
     * @return Services_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(SERVICES_TEMPLATES_TABLE);
        $this->ci->cache->registerService(SERVICES_TABLE);
        //TODO (nsavanaev) add cache
        $this->ci->cache->registerService(SERVICES_LOG_TABLE);
    }

    private function getAllServices()
    {
        if ($this->services_all === null) {
            $fields = $this->service_fields;

            $this->services_all = $this->ci->cache->get(SERVICES_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(', ', $fields))
                    ->from(SERVICES_TABLE)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return;
                }
                foreach ($results_raw as $value) {
                    $results[$value['id']] = $value;
                }

                return $results;
            });
        }

        return $this->services_all;
    }

    private function getAllTemplates()
    {
        if ($this->templates_all === null) {
            $fields = $this->template_fields;

            $this->templates_all = $this->ci->cache->get(SERVICES_TEMPLATES_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results_raw = $ci->db->select(implode(', ', $fields))
                    ->from(SERVICES_TEMPLATES_TABLE)
                    ->get()->result_array();

                if (empty($results_raw) || !is_array($results_raw)) {
                    return;
                }
                foreach ($results_raw as $value) {
                    $results[$value['id']] = $value;
                }

                return $results;
            });
        }

        return $this->templates_all;
    }

    public function getTemplateById($id, $lang_id = '')
    {
        $templates = $this->getAllTemplates();

        foreach ($templates as $template) {
            if ($template['id'] == $id) {
                $format = $this->formatTemplates([$template], $lang_id);

                return $format[0];
            }
        }
    }

    public function getTemplateByGid($gid, $lang_id = '')
    {
        $templates = $this->getAllTemplates();

        foreach ($templates as $template) {
            if ($template['gid'] == $gid) {
                $format = $this->formatTemplates([$template], $lang_id);

                return $format[0];
            }
        }
    }

    /**
     * Format template data.
     *
     * @param array $data    templates data
     * @param int   $lang_id language identifier
     *
     * @return array
     */
    public function formatTemplate($data, $lang_id = '')
    {
        $templates = $this->formatTemplates([$data], $lang_id);

        return $templates[0];
    }

    /**
     * Format templates data.
     *
     * @param array $data    templates data
     * @param int   $lang_id language identifier
     *
     * @return array
     */
    public function formatTemplates($data, $lang_id = '')
    {
        foreach ($data as $key => &$template) {
            if (!empty($template['data_admin'])) {
                $temp = unserialize($template['data_admin']);
                if (is_array($temp)) {
                    foreach ($temp as $param => $type) {
                        $template['data_admin_array'][$param] = [
                            'gid' => $param,
                            'type' => $type,
                            'name' => l('admin_param_name_'.$template['id'].'_'.$param, 'services', $lang_id),
                            'name_lang_gid' => 'admin_param_name_'.$template['id'].'_'.$param,
                        ];
                        /*
                         * @todo:
                         * 1. move validation settings to $template["data_admin"]
                         * 2. use regexp
                         */
                        if ($param == 'period') {
                            $template['data_admin_array'][$param]['validate_rules']['min'] = 1;
                        }
                    }
                } else {
                    $template['data_admin_array'] = [];
                }
            } else {
                $template['data_admin_array'] = [];
            }

            if (!empty($template['data_user'])) {
                $temp = unserialize($template['data_user']);
                if (!empty($temp)) {
                    foreach ($temp as $param => $type) {
                        $template['data_user_array'][$param] = [
                            'gid' => $param,
                            'type' => $type,
                            'name' => l('user_param_name_'.$template['id'].'_'.$param, 'services', $lang_id),
                            'name_lang_gid' => 'user_param_name_'.$template['id'].'_'.$param,
                        ];
                    }
                } else {
                    $template['data_user_array'] = [];
                }
            } else {
                $template['data_user_array'] = [];
            }

            if (!empty($template['data_membership'])) {
                $temp = unserialize($template['data_membership']);
                if (!empty($temp)) {
                    foreach ($temp as $param => $type) {
                        $template['data_membership_array'][$param] = [
                            'gid' => $param,
                            'type' => $type,
                            'name' => l('membership_param_name_'.$template['id'].'_'.$param, 'services', $lang_id),
                            'name_lang_gid' => 'membership_param_name_'.$template['id'].'_'.$param,
                        ];
                    }
                } else {
                    $template['data_membership_array'] = [];
                }
            } else {
                $template['data_membership_array'] = [];
            }

            if (!empty($template['lds'])) {
                $temp = unserialize($template['lds']);
                if (!empty($temp)) {
                    foreach ($temp as $id => $ds) {
                        $template['lds_array'][] = [
                            'module' => $template['callback_module'],
                            'ds' => $ds,
                        ];
                    }
                } else {
                    $template['lds_array'] = [];
                }
            } else {
                $template['lds_array'] = [];
            }

            $template['name'] = l('template_name_'.$template['id'], 'services', $lang_id);
        }

        return $data;
    }

    public function getTemplateList($params = [], $filter_object_ids = null, $order_by = null, $lang_id = '')
    {
        $this->ci->db->select(implode(', ', $this->template_fields))->from(SERVICES_TEMPLATES_TABLE);

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field.' '.$dir);
            }
        }

        $results = $this->ci->db->get()->result_array();

        $templates = [];

        foreach ($results as $r) {
            $templates[$r['gid']] = $r;
            $templates[$r['gid']]['name'] = l('template_name_'.$r['id'], 'services');
        }

        if (!empty($templates)) {
            $templates = $this->formatTemplates($templates);
        }

        return $templates;
    }

    public function getTemplateCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(SERVICES_TEMPLATES_TABLE);

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }

        $results = $this->ci->db->get()->result_array();

        if (!empty($results) && is_array($results)) {
            return $results[0]['cnt'];
        }

        return 0;
    }

    public function validateTemplate($id, $data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['gid'])) {
            $data['gid'] = strip_tags($data['gid']);
            $data['gid'] = preg_replace("/[^a-z0-9\-_]+/i", '', $data['gid']);

            $return['data']['gid'] = $data['gid'];

            if (empty($return['data']['gid'])) {
                $return['errors'][] = l('error_template_code_incorrect', 'services');
            }
        }

        if (isset($data['callback_module'])) {
            $return['data']['callback_module'] = $data['callback_module'];
        }

        if (isset($data['callback_model'])) {
            $return['data']['callback_model'] = $data['callback_model'];
        }

        if (isset($data['callback_buy_method'])) {
            $return['data']['callback_buy_method'] = $data['callback_buy_method'];
        }

        if (isset($data['callback_activate_method'])) {
            $return['data']['callback_activate_method'] = $data['callback_activate_method'];
        }

        if (isset($data['callback_validate_method'])) {
            $return['data']['callback_validate_method'] = $data['callback_validate_method'];
        }

        if (isset($data['price_type'])) {
            $return['data']['price_type'] = intval($data['price_type']);
        }

        if (isset($data['moveable'])) {
            $return['data']['moveable'] = intval($data['moveable']);
        }

        if (isset($data['data_admin'])) {
            $return['data']['data_admin'] = serialize($data['data_admin']);
        }

        if (isset($data['data_user'])) {
            $return['data']['data_user'] = serialize($data['data_user']);
        }

        if (isset($data['lds'])) {
            $return['data']['lds'] = serialize($data['lds']);
        }

        if (isset($data['is_membership'])) {
            $return['data']['is_membership'] = intval($data['is_membership']);
        }

        if (isset($data['data_membership'])) {
            $return['data']['data_membership'] = serialize($data['data_membership']);
        }

        return $return;
    }

    public function saveTemplate($id, $data, $name = null)
    {
        if (is_null($id)) {
            $data['date_add'] = date('Y-m-d H:i:s');
            $this->ci->db->insert(SERVICES_TEMPLATES_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(SERVICES_TEMPLATES_TABLE, $data);
        }

        if (!empty($name)) {
            $this->ci->pg_language->pages->set_string_langs(
                'services',
                'template_name_'.$id,
                $name,
                array_keys($this->ci->pg_language->languages)
            );
        }

        $this->ci->cache->flush(SERVICES_TEMPLATES_TABLE);

        $this->templates_all = null;

        return $id;
    }

    public function deleteTemplate($id)
    {
        $this->ci->db->where('id', $id);
        $this->ci->db->delete(SERVICES_TEMPLATES_TABLE);
        $this->ci->pg_language->pages->delete_string('services', 'template_name_'.$id);

        $this->ci->cache->flush(SERVICES_TEMPLATES_TABLE);

        $this->templates_all = null;
    }

    public function deleteTemplateByGid($gid)
    {
        $template_data = $this->getTemplateByGid($gid);
        $this->deleteTemplate($template_data['id']);
    }

    public function getServiceById($id)
    {
        $services = $this->getAllServices();

        foreach ($services as $service) {
            if ($service['id'] == $id) {
                $format = $this->formatServices([$service]);

                return $format[0];
            }
        }
    }

    public function getServiceByGid($gid)
    {
        $services = $this->getAllServices();

        foreach ($services as $service) {
            if ($service['gid'] == $gid) {
                $format = $this->formatServices([$service]);

                return $format[0];
            }
        }
    }

    public function getServiceList($params = [], $filter_object_ids = null, $order_by = null, $lang_id = '')
    {
        $this->ci->db->select(implode(', ', $this->service_fields))->from(SERVICES_TABLE);

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field.' '.$dir);
            }
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            $results = $this->formatServices($results, $lang_id);
        }

        return $results;
    }

    public function cacheAllServices()
    {
        return $this->formatServices($this->getAllServices());
    }

    public function cacheAllTemplates($lang_id = '')
    {
        return $this->formatTemplates($this->getAllTemplates($lang_id));
    }

    public function formatService($data)
    {
        if (!$data) {
            return [];
        }

        $result = $this->formatServices([$data]);

        return $result[0];
    }

    public function formatServices($data, $lang_id = '')
    {
        $templates = $this->getAllTemplates($lang_id);

        $templates = $this->formatTemplates($templates, $lang_id);

        $template_by_gid = [];
        foreach ($templates as $template) {
            $template_by_gid[$template['gid']] = $template;
        }

        foreach ($data as $k => $service) {
            if (!empty($service['template_gid']) && isset($template_by_gid[$service['template_gid']])) {
                $data[$k]['template'] = $template_by_gid[$service['template_gid']];
            } else {
                $data[$k]['template'] = null;
            }

            if (!empty($data[$k]['data_admin']) && !is_array($data[$k]['data_admin'])) {
                if (!empty($service['data_admin'])) {
                    $data[$k]['data_admin'] = (array) unserialize($service['data_admin']);
                } else {
                    $data[$k]['data_admin'] = [];
                }
            }

            if (isset($service['id'])) {
                $data[$k]['name'] = l('service_name_'.$service['id'], 'services', $lang_id);
                $data[$k]['lang'] = 'service_name_'.$service['id'];
                $data[$k]['module'] = 'services';
                $data[$k]['gid'] = $service['gid'];
                $data[$k]['description'] = l('service_name_'.$service['id'].'_description', 'services', $lang_id);
                $data[$k]['alert'] = l('service_name_'.$service['id'].'_alert', 'services', $lang_id);
                $data[$k]['name_lang_gid'] = 'service_name_'.$service['id'];
                $data[$k]['description_lang_gid'] = 'service_name_'.$service['id'].'_description';
                $data[$k]['alert_lang_gid'] = 'service_name_'.$service['id'].'_alert';
                if (!empty($data[$k]['user_type_disabled'])) {
                    $data[$k]['user_type_disabled_array'] = (array) unserialize($data[$k]['user_type_disabled']);
                } else {
                    $data[$k]['user_type_disabled_array'] = [];
                }
            }
        }

        return $data;
    }

    public function getServiceCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(SERVICES_TABLE);

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_not_in']) && is_array($params['where_not_in']) && count($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $results[0]['cnt'];
        }

        return 0;
    }

    public function validateService($id, $data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['gid'])) {
            $data['gid'] = strip_tags($data['gid']);
            $data['gid'] = preg_replace("/[^a-z0-9\-_]+/i", '', $data['gid']);

            $return['data']['gid'] = $data['gid'];

            if (empty($return['data']['gid'])) {
                $return['errors'][] = l('error_service_code_incorrect', 'services');
            } else {
                $param['where']['gid'] = $return['data']['gid'];
                if ($id) {
                    $param['where']['id <>'] = $id;
                }
                $gid_counts = $this->getServiceCount($param);
                if ($gid_counts > 0) {
                    $return['errors'][] = l('error_service_code_exists', 'services');
                }
            }
        }

        if (isset($data['template_gid'])) {
            $return['data']['template_gid'] = $data['template_gid'];
        }

        if (isset($data['type'])) {
            $return['data']['type'] = strval($data['type']);
        }

        if (isset($data['user_type_disabled'])) {
            if (!is_array($data['user_type_disabled'])) {
                $data['user_type_disabled'] = [];
            }
            $return['data']['user_type_disabled'] = $data['user_type_disabled'];
            $return['data']['user_type_disabled_code'] = $this->userTypesToDec($data['user_type_disabled']);
        }

        if (isset($data['pay_type'])) {
            $return['data']['pay_type'] = intval($data['pay_type']);
        }

        if (isset($data['status'])) {
            $return['data']['status'] = intval($data['status']);
        }

        if (isset($data['cant_activate_from_services'])) {
            $return['data']['cant_activate_from_services'] = $data['cant_activate_from_services'] ? 1 : 0;
        }

        if (isset($data['price'])) {
            $return['data']['price'] = max(floatval($data['price']), 0);

            if (!$data['price'] && $id) {
                $service_raw = $this->getServiceById($id);
                if ($service_raw['can_free'] == 0) {
                    $return['errors'][] = l('error_service_price_empty', 'services');
                }
            }
        }

        if (isset($data['can_free'])) {
            $return['data']['can_free'] = $data['can_free'] ? 1 : 0;
        }

        if (isset($data['data_admin']) && !empty($data['data_admin'])) {
            $template_data = $this->getTemplateByGid($data['template_gid']);
            foreach ($data['data_admin'] as $key => $value) {
                switch ($template_data['data_admin_array'][$key]['type']) {
                    case 'string':
                        $value = trim(strip_tags($value));

                        break;
                    case 'int':
                        $value = intval($value);

                        break;
                    case 'price':
                        $value = sprintf('%01.2f', floatval($value));

                        break;
                    case 'text':
                        break;
                    case 'checkbox':
                        $value = (intval($value) > 0) ? 1 : 0;

                        break;
                }
                if (isset($template_data['data_admin_array'][$key]['validate_rules'])) {
                    foreach ($template_data['data_admin_array'][$key]['validate_rules'] as $rule_name => $rule) {
                        if ($rule_name == 'min') {
                            if ($value < $rule) {
                                /**
                                 * @todo show error msg and don't save value at all
                                 */
                                $value = 1;
                            }
                        }
                    }
                }
                $data['data_admin'][$key] = $value;
            }
            $return['data']['data_admin'] = serialize($data['data_admin']);
        }

        if (isset($data['lds']) && !empty($data['lds'])) {
            $return['data']['lds'] = serialize($data['lds']);
        }

        if (isset($data['id_membership']) && !empty($data['id_membership'])) {
            $return['data']['id_membership'] = intval($data['id_membership']);
        }

        return $return;
    }

    public function saveService($id, $data, $name = [], $description = [])
    {
        if (is_null($id)) {
            $data['date_add'] = date('Y-m-d H:i:s');
            $this->ci->db->insert(SERVICES_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(SERVICES_TABLE, $data);
        }

        $lang_ids = array_keys($this->ci->pg_language->languages);

        if (!empty($name)) {
            $this->ci->pg_language->pages->set_string_langs(
                'services',
                'service_name_'.$id,
                $name,
                $lang_ids
            );
        }
        if (!empty($description)) {
            $this->ci->pg_language->pages->set_string_langs(
                'services',
                'service_name_'.$id.'_description',
                $description,
                $lang_ids
            );
        }

        if ($data['status'] == 0 && $this->getServiceById($id)['gid'] == 'admin_approve') {
            if ($this->ci->pg_module->get_module_config('users', 'user_approve') == 2) {
                $this->ci->pg_module->set_module_config('users', 'user_approve', 0);
            }
        }

        $this->ci->cache->flush(SERVICES_TABLE);

        $this->services_all = null;

        return $id;
    }

    public function deleteService($id)
    {
        $this->ci->db->where('id', $id);
        $this->ci->db->delete(SERVICES_TABLE);
        $this->ci->pg_language->pages->delete_string('services', "service_name_{$id}");
        $this->ci->pg_language->pages->delete_string('services', "service_name_{$id}_description");

        $this->ci->cache->flush(SERVICES_TABLE);

        $this->services_all = null;
    }

    public function deleteServiceByGid($gid)
    {
        $template_data = $this->getServiceByGid($gid);
        $this->deleteService($template_data['id']);
    }

    public function addServiceLog($id_user, $id_service, $user_data)
    {
        $this->ci->db->insert(SERVICES_LOG_TABLE, [
            'id_user' => $id_user,
            'id_service' => $id_service,
            'user_data' => serialize($user_data),
            'date_add' => date('Y-m-d H:i:s'),
        ]);
    }

    public function validateServicePayment($id_service, $user_data, $price)
    {
        $return = ['errors' => [], 'data' => []];
        $service_data = $this->get_service_by_id($id_service);
        $template_data = $this->get_template_by_gid($service_data['template_gid']);

        $return['data']['price'] = $price = floatval($price);

        if (!empty($template_data['data_user_array'])) {
            foreach ($template_data['data_user_array'] as $gid => $param) {
                $value = isset($user_data[$gid]) ? $user_data[$gid] : '';
                switch ($param['type']) {
                    case 'string':
                        $value = trim(strip_tags($value));

                        break;
                    case 'int':
                        $value = intval($value);

                        break;
                    case 'price':
                        $value = sprintf('%01.2f', floatval($value));

                        break;
                    case 'text':
                        break;
                    case 'checkbox':
                        $value = (intval($value) > 0) ? 1 : 0;

                        break;
                    case 'hidden':
                        if (empty($value)) {
                            $return['errors'][] = l('error_parametr_incorrect', 'services').$param['name'];
                        }

                        break;
                }
                $return['data']['data_user'][$gid] = $value;
            }
        }

        return $return;
    }

    public function validateServiceOriginalModel($id_service, $user_data, $id_user, $price)
    {
        $service_data = $this->get_service_by_id($id_service);
        $template_data = $this->get_template_by_gid($service_data['template_gid']);

        $model_name = ucfirst($template_data['callback_model']);
        $model_path = strtolower($template_data['callback_module'].'/models/').$model_name;
        $this->ci->load->model($model_path);

        return $this->ci->{$model_name}->{$template_data['callback_validate_method']}($id_user, $user_data, $service_data, $price);
    }

    public function accountPayment($service_data, $id_user, $user_data, $activate_immediately = false, $is_ajax = false)
    {
        if ($this->ci->pg_module->is_module_installed('users_payments')) {
            $this->ci->load->model('Users_payments_model');
            $is_paid = $this->ci->Users_payments_model->writeOffUserAccount(
                $id_user,
                $service_data['price'],
                l('service_payment', 'services').$service_data['name'],
                self::PAYMENT_TYPE_GID_PREFIX.$service_data['gid'],
                ['lang' => $service_data['lang'], 'module' => $service_data['module']]
            );
            if ($is_paid === true) {
                $payment_data = [
                    'id_user' => $id_user,
                    'amount' => $service_data['price'],
                    'payment_data' => [
                        'id_service' => $service_data['id'],
                        'user_data' => $user_data,
                        'activate_immediately' => ($activate_immediately ? 1 : 0),
                    ],
                ];
                $this->paymentServiceStatus($payment_data, 1, $is_ajax);
                $this->addEventPayment($payment_data);
                $this->addServiceLog($id_user, $service_data['id'], $user_data);

                return true;
            }

            return $is_paid;
        }

        return false;
    }

    public function systemPayment($system_gid, $id_user, $id_service, $user_data, $price, $activate_immediately = false, $check_html_action = true)
    {
        // log info
        $this->add_service_log($id_user, $id_service, $user_data);

        $service_data = $this->get_service_by_id($id_service);
        $t = $this->format_services([$service_data]);
        $service_data = $t[0];

        $this->ci->load->model('payments/models/Payment_currency_model');
        $currency_gid = $this->ci->Payment_currency_model->default_currency['gid'];
        $payment_data['name'] = l('service_payment', 'services').$service_data['name'];
        $payment_data['offline_line_1'] = l('service_payment', 'services');
        $payment_data['offline_line_2'] = $service_data['name'];
        $payment_data['lang'] = $service_data['lang'];
        $payment_data['module'] = $service_data['module'];
        $payment_data['id_service'] = $id_service;
        $payment_data['gid'] = $service_data['gid'];
        $payment_data['user_data'] = $user_data;
        $payment_data['activate_immediately'] = $activate_immediately ? 1 : 0;
        $payment_data['lang'] = $service_data['lang'];

        $this->ci->load->helper('payments');
        \Pg\modules\payments\helpers\sendPayment(
            self::PAYMENT_TYPE_GID_PREFIX.$service_data['gid'],
            $id_user,
            $price,
            $currency_gid,
            $system_gid,
            $payment_data,
            $check_html_action
        );
    }

    // callback method for payment module
    public function paymentServiceStatus($payment_data, $payment_status, $is_ajax = false)
    {
        if ($payment_status == 1) {
            $user_id = $payment_data['id_user'];
            $service_id = $payment_data['payment_data']['id_service'];
            $price = $payment_data['amount'];
            $count = !empty($payment_data['payment_data']['count']) ? $payment_data['payment_data']['count'] : 1;
            if (!empty($payment_data['payment_data']['id_users_package'])) {
                $users_package_id = intval($payment_data['payment_data']['id_users_package']);
            } else {
                $users_package_id = 0;
            }
            if (!empty($payment_data['payment_data']['id_users_membership'])) {
                $users_membership_id = intval($payment_data['payment_data']['id_users_membership']);
                $membership_id = intval($payment_data['payment_data']['id_membership']);
            } else {
                $users_membership_id = 0;
            }
            $activate_immediately = !empty($payment_data['payment_data']['activate_immediately']) || $users_membership_id;

            $service = $this->format_service($this->get_service_by_id($service_id));
            $template = $this->get_template_by_gid($service['template_gid']);
            if (!empty($membership_id)) {
                $this->ci->load->model('Memberships_model');
                $membership_data = $this->ci->Memberships_model->getMembershipById($membership_id);
                $service['data_admin']['period'] = $this->ci->Memberships_model->getMembershipDays($membership_data);
                $service['data_admin']['period_count'] = $membership_data['period_count'];
                $service['data_admin']['period_type'] = $membership_data['period_type'];
            }

            $model_name = ucfirst($template['callback_model']);
            $model_path = strtolower($template['callback_module'].'/models/').$model_name;
            $method_name = $template['callback_activate_method'];

            $this->ci->load->model($model_path);
            $id_user_service = $this->ci->{$model_name}->{$template['callback_buy_method']}($user_id, $price, $service, $template, $payment_data['payment_data'], $users_package_id, $count);
            if (!$activate_immediately || !$id_user_service) {
                return;
            }

            // TODO: убрать после приведения к PSR
            if (!method_exists($this->ci->$model_name, $method_name)) {
                $chunks = explode('_', $method_name);
                $method_name = array_shift($chunks);
                foreach ($chunks as $chunk) {
                    $method_name .= ucfirst($chunk);
                }
            }
            if (method_exists($this->ci->$model_name, $method_name)) {
                $this->ci->{$model_name}->{$method_name}($user_id, $id_user_service, $is_ajax);
            }
        }
    }

    /**
     * Check service is available.
     *
     * @param string $service_gid service GUID
     *
     * @return bool
     */
    public function isServiceActive($service_gid = '')
    {
        $service = $this->getServiceByGid($service_gid);

        return $service['status'] ? 1 : 0;
    }

    /**
     * Returns langs data.
     *
     * @param array $items
     * @param array $langs_ids
     *
     * @return array
     */
    public function exportLangs($items, $langs_ids = null)
    {
        $services = [];
        foreach ($items as $type => $gids) {
            switch ($type) {
                case 'param':
                case 'user_param': {
                        $method = 'get_template_by_gid';
                    foreach ($gids as $template => $param_gids) {
                        $element = $this->{$method}($template);
                        $prefix = $type == 'param' ? 'admin_' : 'user_';
                        if (is_array($param_gids)) {
                            foreach ($param_gids as $k => $v) {
                                $services[$template.'_'.$v] = $prefix.'param_name_'.$element['id'].'_'.$v;
                            }
                        } else {
                            $services[$template.'_'.$param_gids] = $prefix.'param_name_'.$element['id'].'_'.$param_gids;
                        }
                    }

                    break;
                }
                case 'service_description':
                    break;
                default: {
                        $method = 'get_'.$type.'_by_gid';
                    foreach ($gids as $gid) {
                        $element = null;
                        if (method_exists($this, $method)) {
                            $element = $this->{$method}($gid);
                        }
                        if ($element) {
                            $services[$gid] = $type.'_name_'.$element['id'];
                            if (!empty($langs_data[$gid.'_description'])) {
                                $services[$gid.'_description'] = $type.'_name_'.$element['id'].'_description';
                            }
                            if (!empty($langs_data[$gid.'_alert'])) {
                                $services[$gid.'_alert'] = $type.'_name_'.$element['id'].'_alert';
                            }
                        }
                    }
                }
            }
        }
        $langs_db = $this->ci->pg_language->export_langs('services', $services, $langs_ids);

        $lang_codes = array_keys($langs_db);
        foreach ($langs_ids as $lang_code) {
            foreach ($services as $key => $value) {
                $lang_data[$key][$lang_code] = $langs_db[$value][$lang_code];
            }
        }

        return $lang_data;
    }

    /**
     * Updates langs data.
     *
     * @param array $services
     * @param array $langs_data
     *
     * @return bool
     */
    public function updateLangs($services, $langs_data)
    {
        foreach ($services as $type => $gids) {
            switch ($type) {
                case 'admin_param':
                case 'user_param':
                case 'membership_param': {
                    foreach ($gids as $template => $param_gids) {
                        $element = $this->getTemplateByGid($template);
                        $prefix = substr($type, 0, -5);
                        if (is_array($param_gids)) {
                            foreach ($param_gids as $k => $v) {
                                $lang_data = $langs_data[$template.'_'.$v];
                                $this->ci->pg_language->pages->set_string_langs('services', $prefix.'param_name_'.$element['id'].'_'.$v, $lang_data, array_keys($lang_data));
                            }
                        } else {
                            $lang_data = $langs_data[$template.'_'.$param_gids];
                            $this->ci->pg_language->pages->set_string_langs('services', $prefix.'param_name_'.$element['id'].'_'.$param_gids, $lang_data, array_keys($lang_data));
                        }
                    }

                    break;
                }
                case 'service_description':
                    break;
                default: {
                        $method = 'get'.ucfirst($type).'ByGid';
                    if (!method_exists($this, $method)) {
                        return false;
                    }
                    foreach ($gids as $gid) {
                        $element = $this->$method($gid);
                        if ($element) {
                            $lang_data = $langs_data[$gid];

                            $this->ci->pg_language->pages->set_string_langs('services', $type.'_name_'.$element['id'], $lang_data, array_keys($lang_data));
                            if (!empty($langs_data[$gid.'_description'])) {
                                $lang_data = $langs_data[$gid.'_description'];
                                $this->ci->pg_language->pages->set_string_langs('services', $type.'_name_'.$element['id'].'_description', $lang_data, array_keys($lang_data));
                            }
                            if (!empty($langs_data[$gid.'_alert'])) {
                                $lang_data = $langs_data[$gid.'_alert'];
                                $this->ci->pg_language->pages->set_string_langs('services', $type.'_name_'.$element['id'].'_alert', $lang_data, array_keys($lang_data));
                            }
                        }
                    }
                }
            }
        }

        $this->ci->cache->flush(SERVICES_TABLE);
        $this->ci->cache->flush(SERVICES_TEMPLATES_TABLE);

        $this->services_all = null;
        $this->templates_all = null;

        return true;
    }

    // seo
    public function getSeoSettings($method = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method);
        }
        $actions = ['form'];
        $return = [];
        foreach ($actions as $action) {
            $return[$action] = $this->getSeoSettingsInternal($action);
        }

        return $return;
    }

    public function getSeoSettingsInternal($method)
    {
        if ($method == 'form') {
            return [
                'templates' => ['nickname', 'fname', 'sname', 'email'],
                'url_vars' => [],
                'url_postfix' => [
                    'gid' => ['gid' => 'literal'],
                ],
            ];
        }
    }

    /**
     * Return urls for site map.
     */
    public function getSitemapXmlUrls()
    {
        $return = [];

        return $return;
    }

    /**
     * Return urls for site map.
     */
    public function getSitemapUrls()
    {
        $block = [];

        return $block;
    }

    /**
     * Create services for membership.
     *
     * @param int $membership_id membership identifier
     *
     * @return void
     */
    public function createMembershipServices($membership_id)
    {
        $service_counter = (int) $this->ci->pg_module->get_module_config('services', 'service_counter');

        $templates_data = $this->formatTemplates($this->getAllTemplates());

        foreach ($templates_data as $template_data) {
            if (!$template_data['is_membership']) {
                continue;
            }

            $data_admin = [];

            foreach ($template_data['data_membership_array'] as $name => $type) {
                switch ($type) {
                    case 'int':
                        $data_admin[$name] = 0;

                        break;
                    default:
                        $data_admin[$name] = '';

                        break;
                }
            }

            $lds = [];

            foreach ($template_data['lds_array'] as $name => $value) {
                $lds[$name] = $value;
            }

            $service_counter++;

            $service_data = [
                'gid' => 'service_'.$service_counter,
                'template_gid' => $template_data['gid'],
                'pay_type' => 1,
                'type' => 'membership',
                'data_admin' => serialize($data_admin),
                'lds' => serialize($lds),
                'status' => 0,
                'id_membership' => $membership_id,
            ];
            $service_id = $this->saveService(null, $service_data);

            $lang_data = [];

            foreach ($this->ci->pg_language->languages as $lid => $data) {
                $lang_data[$lid] = l('template_name_'.$template_data['id'], 'services', $lid);
            }

            $this->ci->pg_language->pages->set_string_langs('services', 'service_name_'.$service_id, $lang_data, array_keys($lang_data));
        }

        $this->ci->pg_module->set_module_config('services', 'service_counter', $service_counter);
    }

    /**
     * Remove services from memberships.
     *
     * @param int $membership_id membership identifier
     *
     * @return void
     */
    public function deleteMembershipServices($membership_id)
    {
        $services_data = $this->getServiceList(['where' => ['id_membership' => $membership_id]]);
        foreach ($services_data as $service_data) {
            $this->deleteService($service_data['id']);
        }
    }

    /**
     * Update status of memberships services.
     *
     * Available status: 1 - active, 0 - inactive
     *
     * @param int   $membership_id       membership identifier
     * @param int   $status              activity status
     * @param array $active_services_ids active memebership services
     *
     * @return void
     */
    public function updateMembershipServicesStatus($membership_id, $status, $active_services_ids = [])
    {
        $services_data = $this->getServiceList(['where' => ['id_membership' => $membership_id]]);
        foreach ($services_data as $service_data) {
            $service_status = ($status && in_array($service_data['id'], $active_services_ids)) ? 1 : 0;
            $save_data = ['status' => $service_status];
            $this->saveService($service_data['id'], $save_data);
        }
    }

    /**
     * Update data of memberships services.
     *
     * @param int   $membership_id           membership identifier
     * @param array $membership_service_data service data
     *
     * @return void
     */
    public function updateMembershipServicesData($membership_id, $membership_service_data)
    {
        $services_data = $this->getServiceList(['where' => ['id_membership' => $membership_id]]);
        foreach ($services_data as $service_data) {
            $validate_data = $this->validateService($service_data['id'], $membership_service_data);
            if (!empty($validate_data['errors'])) {
                continue;
            }
            $this->saveService($service_data['id'], $validate_data['data']);
        }
    }

    /**
     * Update status of service.
     *
     * Available status: 1 - active, 0 - inactive
     *
     * @param int $service_id service identifier
     * @param int $status     activity status
     *
     * @return void
     */
    public function updateServiceStatus($service_id, $status)
    {
        $this->saveService($service_id, ['status' => $status]);
    }

    /**
     * Convert data from array to numeric.
     *
     * @param array $data membership user types
     *
     * @return int
     */
    private function userTypesToDec($data)
    {
        $lang_id = $this->ci->pg_language->current_lang_id;

        $this->ci->load->model('Properties_model');
        $user_types = $this->ci->Properties_model->get_property('user_type', $lang_id);
        if (empty($user_types['option'])) {
            return 0;
        }

        $binary_string = '';
        foreach ($user_types['option'] as $type => $name) {
            $binary_string = (in_array($type, $data) ? '1' : '0').$binary_string;
        }

        return bindec($binary_string);
    }

    private function addEventPayment($payment_data)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventServices();
        $payment_data['payment_type_gid'] = 'services';
        $event->setData($payment_data);
        $event_handler->dispatch($event, 'users_get_service');
    }

    public function activateService($service_id)
    {
        $this->saveService($service_id, ['status' => 1]);
    }

    public function deactivateService($service_id)
    {
        $this->saveService($service_id, ['status' => 0]);
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_seo_settings' => 'getSeoSettings',
            'account_payment' => 'accountPayment',
            'add_service_log' => 'addServiceLog',
            'cache_all_services' => 'cacheAllServices',
            'cache_all_templates' => 'cacheAllTemplates',
            'create_membership_services' => 'createMembershipServices',
            'delete_service' => 'deleteService',
            'delete_service_by_gid' => 'deleteServiceByGid',
            'delete_template' => 'deleteTemplate',
            'delete_template_by_gid' => 'deleteTemplateByGid',
            'export_langs' => 'exportLangs',
            'format_service' => 'formatService',
            'format_services' => 'formatServices',
            'format_template' => 'formatTemplate',
            'format_templates' => 'formatTemplates',
            'get_service_by_gid' => 'getServiceByGid',
            'get_service_by_id' => 'getServiceById',
            'get_service_count' => 'getServiceCount',
            'get_service_list' => 'getServiceList',
            'get_sitemap_urls' => 'getSitemapUrls',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'get_template_by_gid' => 'getTemplateByGid',
            'get_template_by_id' => 'getTemplateById',
            'get_template_count' => 'getTemplateCount',
            'get_template_list' => 'getTemplateList',
            'is_service_active' => 'isServiceActive',
            'payment_service_status' => 'paymentServiceStatus',
            'save_service' => 'saveService',
            'save_template' => 'saveTemplate',
            'system_payment' => 'systemPayment',
            'update_langs' => 'updateLangs',
            'validate_service' => 'validateService',
            'validate_service_original_model' => 'validateServiceOriginalModel',
            'validate_service_payment' => 'validateServicePayment',
            'validate_template' => 'validateTemplate',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method '.$name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
