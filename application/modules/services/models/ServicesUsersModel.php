<?php

declare(strict_types=1);

namespace Pg\modules\services\models;

if (!defined('SERVICES_USERS_TABLE')) {
    define('SERVICES_USERS_TABLE', DB_PREFIX . 'services_users');
}

/**
 * Users services model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2012-09-20 09:47:07 +0300 (Пт, 20 сент 2012) $ $Author: abatukhtin $
 */
class ServicesUsersModel extends \Model
{
    private $services_fields = [
        'id',
        'id_user',
        'service_gid',
        'template_gid',
        'service',
        'template',
        'payment_data',
        'date_created',
        'date_modified',
        'date_expired',
        'status',
        'count',
        'id_users_package',
        'id_users_membership',
    ];

    public function getCount($user_id = 0, $count_name)
    {
        $count = 0;
        $services = $this->get_services_list(['id_user' => $user_id, 'status' => '1']);
        foreach ($services as $id => $value) {
            $data = @unserialize($value['service_data']);
            if (isset($data[$count_name])) {
                $count = $count + $data[$count_name];
            }
        }

        return $count;
    }

    public function saveService($service_id = null, $attrs = [])
    {
        if (!empty($attrs["service"])) {
            $attrs["service"] = serialize($attrs["service"]);
        }
        if (!empty($attrs["template"])) {
            $attrs["template"] = serialize($attrs["template"]);
        }
        if (isset($attrs["payment_data"]) && is_array($attrs["payment_data"])) {
            $attrs["payment_data"] = serialize($attrs["payment_data"]);
        }
        foreach ($attrs as $field => $attr) {
            if (!in_array($field, $this->services_fields)) {
                unset($attrs[$field]);
            }
        }
        if (is_null($service_id)) {
            $attrs["date_created"] = $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(SERVICES_USERS_TABLE, $attrs);
            $service_id = $this->ci->db->insert_id();
        } else {
            $attrs["date_modified"] = date("Y-m-d H:i:s");
            $this->ci->db->where('id', $service_id);
            $this->ci->db->update(SERVICES_USERS_TABLE, $attrs);
        }

        return $service_id;
    }

    public function updateService($params, $attrs = [])
    {
        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            $this->ci->db->where($params["where"]);
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

        if (isset($attrs["service_data"]) && is_array($attrs["service_data"])) {
            $attrs["service_data"] = serialize($attrs["service_data"]);
        }
        if (!isset($attrs["date_modified"])) {
            $attrs["date_modified"] = date("Y-m-d H:i:s");
        }
        $this->ci->db->update(SERVICES_USERS_TABLE, $attrs);

        return $this->ci->db->affected_rows();
    }

    public function getServicesList($params = [], $order_by = null, $filter_object_ids = null, $lang_id = '', $add_expire_data = true)
    {
        $data = [];
        $this->ci->db->select(implode(", ", $this->services_fields))->from(SERVICES_USERS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            $this->ci->db->where($params["where"]);
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
                if (in_array($field, $this->services_fields)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        $results = $this->ci->db->get()->result_array();

        return $this->formatServices($results, $lang_id, $add_expire_data);
    }

    public function formatServices($user_services, $lang_id = '', $add_expire_data = true)
    {
        $result = [];
        foreach ($user_services as $user_service) {
            $id = $user_service['id'];
            $result[$id] = $user_service;
            if (!empty($user_service['service'])) {
                $result[$id]['service'] = @unserialize($user_service['service']);
                if ($add_expire_data && strtotime($user_service['date_expired']) <= 0) {
                    $result[$id] = $this->addExpireData($result[$id]);
                }
            }
            if (!empty($user_service['template'])) {
                $result[$id]['template'] = @unserialize($user_service['template']);
            }
            if (!empty($user_service['payment_data'])) {
                $result[$id]['payment_data'] = @unserialize($user_service['payment_data']);
            }
            if (!(empty($result[$id]['service']))) {
                $result[$id]['name'] = l('service_name_' . $result[$id]['service']['id'], 'services', $lang_id);
            } else {
                $this->ci->load->model('Services_model');
                $service = $this->ci->Services_model->formatService($this->ci->Services_model->getServiceByGid($user_service['service_gid']));
                $result[$id]['name'] = l('service_name_' . $service['id'], 'services', $lang_id);
            }

            if ($user_service['id'] && strtotime($user_service['date_expired']) > 0) {
                $now = new \DateTime('now');
                $expires_date = new \DateTime($user_service['date_expired']);
                $result[$id]['left'] = $now->diff($expires_date, false);
                $days_left = 0;
                if ($result[$id]['left']->days) {
                    $days_left = $result[$id]['left']->days;
                }
                $days_left += (int) ($result[$id]['left']->h > 12);
                if ($result[$id]['left']->invert) {
                    $days_left = -$days_left;
                }
                $result[$id]['is_expired'] = $result[$id]['left']->invert;
                $result[$id]['date_expires'] = $expires_date->format('Y-m-d H:i:s');
                $result[$id]['days_left'] = $days_left;
            }

            if (!isset($result[$id]['is_expired'])) {
                $result[$id]['is_expired'] = false;
            }

            $result[$id]['description'] = !(empty($result[$id]['service'])) ?
                l('service_name_' . $result[$id]['service']['id'] . '_description', 'services', $lang_id) : '';
            $result[$id]['is_active'] = $user_service['count'] && $user_service['status'];
        }

        return $result;
    }

    /**
     * Add service expire data (date and number of days).
     *
     * @param type $service
     *
     * @return type
     */
    private function addExpireData($service)
    {
        if (!empty($service['date_modified']) && !empty($service['service']['data_admin']['period'])) {
            $now = new \DateTime('now');
            $modified_date = new \DateTime($service['date_modified']);
            $periodD = new \DateInterval('PT' . round($service['service']['data_admin']['period'] * 24 * 60) . 'M');
            $expires_date = $modified_date->add($periodD);
            $service['left'] = $now->diff($expires_date, false);
            $days_left = 0;
            if ($service['left']->days) {
                $days_left = $service['left']->days;
            }
            $days_left += (int) ($service['left']->h > 12);
            if ($service['left']->invert) {
                $days_left = -$days_left;
            }
            $service['is_expired'] = $service['left']->invert;
            $service['date_expires'] = $expires_date->format('Y-m-d H:i:s');
            $service['days_left'] = $days_left;
        } else {
            $service['days_left'] = 0;
        }

        return $service;
    }

    public function getServiceById($id)
    {
        $this->ci->db->select(implode(", ", $this->services_fields))->from(SERVICES_USERS_TABLE)->where('id', $id);
        $results = $this->format_services($this->ci->db->get()->result_array());

        return array_shift($results);
    }

    public function getUserServiceById($id_user, $id)
    {
        $this->ci->db->select(implode(", ", $this->services_fields))->from(SERVICES_USERS_TABLE)->where('id', $id)->where('id_user', $id_user);
        $results = $this->format_services($this->ci->db->get()->result_array());

        return array_shift($results);
    }

    /**
     * Users ids
     *
     * @param string $gid
     *
     * @return array
     */
    public function getUsersIdsByServiceGid($gid)
    {
        if (!empty($gid)) {
            $this->ci->db->select('id_user')->from(SERVICES_USERS_TABLE);
            $this->ci->db->where('service_gid', $gid);
            $this->ci->db->order_by('date_modified DESC');
            $result = $this->ci->db->get()->result_array();
            $return = [];
            foreach ($result as $row) {
                $return[] = $row['id_user'];
            }
            return $return;
        }
        return [];
    }

    /**
     * Check service is available
     *
     * @param integer $id_user      user identifier
     * @param string  $template_gid service guid
     *
     * @return array
     */
    public function availableServiceBlock($id_user, $template_gid)
    {
        $this->ci->load->model('Services_model');

        $template_data = $this->ci->Services_model->get_template_by_gid($template_gid);
        $template_data = $this->ci->Services_model->format_template($template_data);
        $this->ci->view->assign('template', $template_data);

        $params = [];
        $params["where"]['id_user'] = $id_user;
        $params["where"]['template_gid'] = $template_gid;
        $params["where"]['status'] = '1';
        $params["where"]['count > '] = '0';

        $data['user_services'] = $this->get_services_list($params);

        if ($this->ci->pg_module->is_module_installed('packages')) {
            $user_packages_ids = [];
            foreach ($data['user_services'] as $user_service) {
                if ($user_service['id_users_package']) {
                    $user_packages_ids[$user_service['id_users_package']] = $user_service['id_users_package'];
                }
            }
            if ($user_packages_ids) {
                $this->ci->load->model('packages/models/Packages_users_model');
                $user_packages = $this->ci->Packages_users_model->get_user_packages_list(null, [], $user_packages_ids);
            }
            foreach ($data['user_services'] as &$user_service) {
                if ($user_service['id_users_package']) {
                    $user_service['package_name'] = !empty($user_packages[$user_service['id_users_package']]) ? $user_packages[$user_service['id_users_package']]['package_info']['name'] : '';
                    $user_service['package_till_date'] = !empty($user_packages[$user_service['id_users_package']]) ? $user_packages[$user_service['id_users_package']]['till_date'] : '';
                }
            }
        }

        $data["id_user"] = $id_user;

        $this->ci->load->library('user_agent');
        if ($this->ci->agent->is_referral()) {
            $this->ci->session->set_userdata(['service_redirect' => $this->ci->agent->referrer()]);
        }

        $data["date_format"] = $this->ci->pg_date->get_format('date_literal', 'st');
        $data["date_time_format"] = $this->ci->pg_date->get_format('date_time_literal', 'st');
        $this->ci->view->assign('block_data', $data);

        return $this->ci->view->fetch('ajax_user_package_for_activate', 'user', 'services');
    }

    /**
     * Check service is available
     *
     * @param integer $id_user      user identifier
     * @param string  $template_gid service template GUID
     *
     * @return boolean
     */
    public function isServiceAccess($id_user, $template_gid)
    {
        $this->ci->load->model('Services_model');

        $params = ['where' => ['template_gid' => $template_gid, 'price != ' => 0, 'status' => 1]];
        $services = $this->ci->Services_model->get_service_list($params);

        $params = ['where' => ['template_gid' => $template_gid, 'price = ' => 0, 'status' => 1]];
        $free_services = $this->ci->Services_model->get_service_list($params);

        /*$result['service'] = $this->ci->Services_model->format_service($this->ci->Services_model->get_service_by_gid($service_gid));
        $result['service']['is_free'] = ($result['service'] && !$result['service']['price'] && $result['service']['template']['price_type'] == 1);
        $result['service']['is_free_status'] = (!empty($result['service']['status']) && !$result['service']['price'] && $result['service']['template']['price_type'] == 1);*/

        $params = ['where' => ['id_user' => $id_user, 'template_gid' => $template_gid, 'status' => '1', 'count > ' => '0']];
        $result['user_services'] = $this->get_services_list($params);

        $result['buy_status'] = $result['service_status'] = !empty($services) ? true : false;
        $result['activate_status'] = (!empty($free_services) || !empty($result['user_services']));
        $result['use_status'] = ($result['activate_status'] || $result['buy_status']);

        return $result;
    }

    public function getUserServices($user_id, $lang_id, $only_active = false)
    {
        $order_by = [
            'status' => 'DESC',
            'count'  => 'DESC',
            'date_created' => 'DESC',
        ];
        $where = [];
        $where['where_sql'][] = "id_user = $user_id AND (id_users_membership = '0' AND (id_users_package = '0' OR status = '0'))";
        $user_services = $this->getServicesList($where, $order_by, null, $lang_id);
        $services_data = [];
        foreach ($user_services as $user_service) {
            if ($only_active !== 2 && $user_service['is_active']) {
                continue;
            }
            $gid = $user_service['service_gid'];
            $data = [
                'id'        => $user_service['id'],
                'gid'       => $gid,
                'name'      => $user_service['name'],
                'is_active' => $user_service['is_active'],
                'days_left' => filter_var($user_service['days_left'], FILTER_VALIDATE_INT),
                'date_expires' => $user_service['date_expires'],
            ];
            if (empty($services_data[$gid])) {
                $services_data[$gid] = $data;
            }

            $services_data[$gid]['is_expired'] = $user_service['is_expired'];

            if ($only_active && $services_data[$gid]['is_expired']) {
                unset($services_data[$gid]);
            }
        }

        return $services_data;
    }

    public function __call($name, $args)
    {
        $methods = [
            'available_service_block' => 'availableServiceBlock',
            'format_services' => 'formatServices',
            'get_count' => 'getCount',
            'get_service_by_id' => 'getServiceById',
            'get_services_list' => 'getServicesList',
            'get_user_service_by_id' => 'getUserServiceById',
            'is_service_access' => 'isServiceAccess',
            'save_service' => 'saveService',
            'update_service' => 'updateService',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
