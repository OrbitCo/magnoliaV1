<?php

declare(strict_types=1);

namespace Pg\modules\widgets\models;

define('WIDGETS_TABLE', DB_PREFIX . 'widgets');

/**
 * Widgets model
 *
 * @package PG_DatingPro
 * @subpackage Widgets
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class WidgetsModel extends \Model
{
    /**
     * Table fields
     *
     * @var array
     */
    private $_fields = [
        'id',
        'gid',
        'module',
        'url',
        'size',
        'colors',
        'settings',
        'date_created',
        'date_modified',
    ];

    /**
     * Format settings
     *
     * @var array
     */
    private $format_settings = [
        'use_format'  => true,
        'get_content' => false,
    ];

    /**
     * Constructor
     *
     * @return Widgets_model
     */
    public function __construct()
    {
        parent::__construct();

        foreach ($this->ci->pg_language->languages as $id => $value) {
            $this->_fields[] = 'title_' . $value['id'];
            $this->_fields[] = 'footer_' . $value['id'];
        }
    }

    /**
     * Get widget by ID
     *
     * @param integer $widget_id widget identifier
     *
     * @return array
     */
    public function getWidgetById($widget_id)
    {
        $this->ci->db->select(implode(', ', $this->_fields));
        $this->ci->db->from(WIDGETS_TABLE);
        $this->ci->db->where('id', $widget_id);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $this->format_widget($results[0]);
        }

        return [];
    }

    /**
     * Get widget by GUID
     *
     * @param string $widget_gid widget guid
     *
     * @return array
     */
    public function getWidgetByGid($widget_gid, $url = null)
    {
        $this->ci->db->select(implode(', ', $this->_fields));
        $this->ci->db->from(WIDGETS_TABLE);
        $this->ci->db->where('gid', $widget_gid);
        if (!empty($url)) {
            $this->ci->db->where('(url=' . $this->ci->db->escape($url) . ' OR url=' . $this->ci->db->escape('') . ')');
        }
        $this->ci->db->order_by('url DESC');
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return $this->format_widget($results[0]);
        }

        return [];
    }

    /**
     * Return search criteria
     *
     * @param array $filters filters data
     */
    private function getSearchCriteria($filters)
    {
        $params = [];

        $fields = array_flip($this->_fields);
        foreach ($filters as $filter_name => $filter_data) {
            if (!$filter_data) {
                continue;
            }
        }

        return $params;
    }

    /**
     * Return widgets as array
     *
     * @param integer $page      page of results
     * @param string  $limits    results limit
     * @param array   $order_by  sorting order
     * @param array   $params    filter criteria
     * @param boolean $formatted results formatting
     *
     * @return array
     */
    private function getWidgetsListInternal($page = null, $limits = null, $order_by = null, $params = [], $formatted = true)
    {
        $this->ci->db->select(implode(', ', $this->_fields));
        $this->ci->db->from(WIDGETS_TABLE);

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

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->_fields)) {
                    $this->ci->db->order_by($field . ' ' . $dir);
                }
            }
        } elseif ($order_by) {
            $this->ci->db->order_by($order_by);
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($limits, $limits * ($page - 1));
        }

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            if ($formatted) {
                $results = $this->format_widgets($results);
            }

            return $results;
        }

        return [];
    }

    /**
     * Return number of widgets
     *
     * @param array $params filters criteria
     *
     * @return integer
     */
    private function getWidgetsCountInternal($params = null)
    {
        $this->ci->db->select('COUNT(*) AS cnt');
        $this->ci->db->from(WIDGETS_TABLE);

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

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]['cnt']);
        }

        return 0;
    }

    /**
     * Return list of filtered widgets
     *
     * @param array   $filters       filter criteria
     * @param integer $page          page of results
     * @param integer $items_on_page items per page
     * @param string  $order_by      sorting order
     * @param boolean $formatted     results formatting
     */
    public function getWidgetsList($filters = [], $page = null, $items_on_page = null, $order_by = null, $formatted = true)
    {
        $params = $this->getSearchCriteria($filters);

        return $this->getWidgetsListInternal($page, $items_on_page, $order_by, $params, $formatted);
    }

    /**
     * Return number of filtered widgets
     *
     * @param array $filters filter criteria
     *
     * @return array
     */
    public function getWidgetsCount($filters = [])
    {
        $params = $this->getSearchCriteria($filters);

        return $this->getWidgetsCountInternal($params);
    }

    /**
     * Save widget
     *
     * @param integer $widget_id widget identifier
     * @param array   $data      widget data
     *
     * @return integer
     */
    public function saveWidget($widget_id, $data)
    {
        if (!$widget_id) {
            $data['date_created'] = $data['date_modified'] = date('Y-m-d H:i:s');
            $this->ci->db->insert(WIDGETS_TABLE, $data);
            $widget_id = $this->ci->db->insert_id();
        } else {
            $data['date_modified'] = date('Y-m-d H:i:s');
            $this->ci->db->where('id', $widget_id);
            $this->ci->db->update(WIDGETS_TABLE, $data);
        }

        return $widget_id;
    }

    /**
     * Remove widget
     *
     * @param string $widget_gid widget guid
     * @param array  $data       widget data
     */
    public function deleteWidget($widget_gid)
    {
        $this->ci->db->where('gid', $widget_gid);
        $this->ci->db->delete(WIDGETS_TABLE);
    }

    /**
     * Validate widget data
     *
     * @param integer $widget_id widget identifier
     * @param array   $data
     *
     * @return array
     */
    public function validateWidget($widget_id, $data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['id'])) {
            $return['data']['id'] = intval($data['id']);
            if (empty($return['data']['id'])) {
                unset($return['data']['id']);
            }
        }

        if (isset($data['gid'])) {
            $return['data']['gid'] = trim(strip_tags($data['gid']));
            if (empty($return['data']['gid'])) {
                unset($return['data']['gid']);
            }
        }

        if (isset($data['module'])) {
            $return['data']['module'] = trim(strip_tags($data['module']));
        }

        if (isset($data['model'])) {
            $return['data']['model'] = trim(strip_tags($data['model']));
        }

        if (isset($data['title'])) {
            $return['data']['title'] = trim(strip_tags($data['title']));
        }

        if (isset($data['footer'])) {
            $return['data']['footer'] = trim(strip_tags($data['footer']));
        }

        if (isset($data['size'])) {
            $return['data']['size'] = intval($data['size']);
        }

        if (isset($data['colors'])) {
            $return['data']['colors'] = serialize($data['colors']);
        }

        if ((empty($data['settings']['id_user']) && empty($data['settings']['user_type'])) && !is_null($widget_id)){
            $return['errors'][] = l('admin_have_to_select_user','widgets');
        }

        if (isset($data['settings'])) {
            $return['data']['settings'] = serialize($data['settings']);
        }

        if (isset($data['date_created'])) {
            $value = strtotime($data['date_created']);
            if ($value > 0) {
                $return['data']['date_created'] = date('Y-m-d', $value);
            } else {
                $return['data']['date_created'] = '0000-00-00 00:00:00';
            }
        }

        if (isset($data['date_modified'])) {
            $value = strtotime($data['date_modified']);
            if ($value > 0) {
                $return['data']['date_modified'] = date('Y-m-d', $value);
            } else {
                $return['data']['date_modified'] = '0000-00-00 00:00:00';
            }
        }

        $default_lang_id = $this->ci->pg_language->current_lang_id;
        if (isset($data['title_' . $default_lang_id])) {
            $return['data']['title_' . $default_lang_id] = trim(strip_tags($data['title_' . $default_lang_id]));
            foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                if ($lid == $default_lang_id) {
                    continue;
                }
                if (!isset($data['title_' . $lid]) || empty($data['title_' . $lid])) {
                    $return['data']['title_' . $lid] = $return['data']['title_' . $default_lang_id];
                } else {
                    $return['data']['title_' . $lid] = trim(strip_tags($data['title_' . $lid]));
                }
            }
        }

        $default_lang_id = $this->ci->pg_language->current_lang_id;
        if (isset($data['footer_' . $default_lang_id])) {
            $return['data']['footer_' . $default_lang_id] = trim(strip_tags($data['footer_' . $default_lang_id]));
            foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                if ($lid == $default_lang_id) {
                    continue;
                }
                if (!isset($data['footer_' . $lid]) || empty($data['footer_' . $lid])) {
                    $return['data']['footer_' . $lid] = $return['data']['footer_' . $default_lang_id];
                } else {
                    $return['data']['footer_' . $lid] = trim(strip_tags($data['footer_' . $lid]));
                }
            }
        }

        return $return;
    }

    /**
     * Change format settings
     *
     * @param string $name  parameter name
     * @param mixed  $value parameter value
     */
    public function setFormatSettings($name, $value = false)
    {
        if (!is_array($name)) {
            $name = [$name => $value];
        }
        if (empty($name)) {
            return;
        }
        foreach ($name as $key => $item) {
            $this->format_settings[$key] = $item;
        }
    }

    /**
     * Format widgets data
     *
     * @param array $data set of widgets
     *
     * @return array
     */
    public function formatWidget($data)
    {
        $data = $this->format_widgets([$data]);
        return $data[0];
    }

    /**
     * Format widgets data
     *
     * @param array $data set of widgets
     *
     * @return array
     */
    public function formatWidgets($data)
    {
        if (!$this->format_settings['use_format']) {
            return $data;
        }

        foreach ($data as $key => $widget) {
            $widget['title'] = $widget['title_' . $this->ci->pg_language->current_lang_id];
            $widget['footer'] = $widget['footer_' . $this->ci->pg_language->current_lang_id];
            $widget['colors'] = $widget['colors'] ? unserialize($widget['colors']) : [];
            $widget['settings'] = $widget['settings'] ? unserialize($widget['settings']) : [];

            if ($this->format_settings['get_content']) {
                if ($this->ci->pg_module->is_module_installed($widget['module'])) {
                    $model_name = ucfirst($widget['gid']);
                    $this->ci->load->model($widget['module'] . '/widgets/' . $model_name, $model_name);
                    $widget['content'] = $this->ci->{$model_name}->generate($widget['settings']);
                }
            }

            $data[$key] = $widget;
        }

        return $data;
    }

    /**
     * Add widgets language fields
     *
     * @param integer $lang_id language identifier
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $this->ci->dbforge->add_column(WIDGETS_TABLE, [
            'title_' . $lang_id => [
                'type' => 'text',
                'null' => true
            ]
        ]);
        $this->ci->dbforge->add_column(WIDGETS_TABLE, [
            'footer_' . $lang_id => [
                'type' => 'text',
                'null' => true
            ]
        ]);

        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('title_' . $lang_id, 'title_' . $default_lang_id, false);
            $this->ci->db->set('footer_' . $lang_id, 'footer_' . $default_lang_id, false);
            $this->ci->db->update(WIDGETS_TABLE);
        }
    }

    /**
     * Remove widgets language fields
     *
     * @param integer $lang_id language identifier
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }
        $this->ci->load->dbforge();

        $fields_exists = $this->ci->db->list_fields(WIDGETS_TABLE);
        $fields = ['title_' . $lang_id, 'footer_' . $lang_id];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(WIDGETS_TABLE, $field_name);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_widget' => 'deleteWidget',
            'format_widget' => 'formatWidget',
            'format_widgets' => 'formatWidgets',
            'get_widget_by_gid' => 'getWidgetByGid',
            'get_widget_by_id' => 'getWidgetById',
            'get_widgets_count' => 'getWidgetsCount',
            'get_widgets_list' => 'getWidgetsList',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'save_widget' => 'saveWidget',
            'set_format_settings' => 'setFormatSettings',
            'validate_widget' => 'validateWidget',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
