<?php

declare(strict_types=1);

namespace Pg\Libraries\Traits;

/**
 * Query
 *
 * @package PG_Dating
 * @subpackage  Pg\Libraries\Traits
 * @category    trait
 *
 * @copyright   Copyright (c) PG Dating Pro - php dating software
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
trait QueryTrait
{
    /**
     * @var string
     */
    protected $table = '';

    /**
     * @var array
     */
    protected $fields_all = [];

    /**
     * @var array
     */
    protected $dop_fields = [];

    /**
     * To fill in options
     *
     * fill in the body of the method:
     *  $this->setTable($table);
     *  $this->setAdditionalFields($fields);
     *  $this->ci->cache->registerService($table);
     *
     * @param string $table
     * @param array $fields
     *
     * @return mixed
     */
    abstract public function applyOptions(string $table, array $fields);

    /**
     * @param string $table
     *
     * @return $this
     */
    protected function setTable(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param array $fields
     * $this->fields_all = fields + dop_fields
     *
     * @return $this
     */
    public function setAdditionalFields(array $fields)
    {
        $this->dop_fields = $fields;
        $this->fields_all = (!empty($this->dop_fields))
            ? array_merge($this->fields, $this->dop_fields)
            : $this->fields;

        return $this;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields_all;
    }

    /**
     * @param array $filters
     *
     * @return false|mixed
     */
    public function getObject(array $filters = [])
    {
        $table = $params['table'] ?? $this->table;
        $fields_str = implode(', ', $this->fields_all);
        $key = 'object' . implode('_', array_keys($filters));

        return $this->ci->cache->get($table, $key, function () use ($filters, $table, $fields_str) {
            $ci = &get_instance();

            $ci->db->select($fields_str)->from($table);
            foreach ($filters as $field => $value) {
                $ci->db->where($field, $value);
            }

            $results = $ci->db->get()->result_array();
            if (!empty($results) && is_array($results)) {
                return current($results);
            }

            return $results;
        });
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->getObject(['id' => $id]);
    }

    /**
     * @param $filters
     *
     * @return array
     */
    protected function getCriteriaInternal($filters): array
    {
        $filters = ['data' => $filters, 'table' => $this->table, 'type' => ''];

        $params = [];

        $params['table'] = !empty($filters['table']) ? $filters['table'] : $this->table;

        $fields = array_flip($this->fields_all);
        foreach ($filters['data'] as $filter_name => $filter_data) {
            if (!is_array($filter_data)) {
                $filter_data = trim($filter_data);
            }
            switch ($filter_name) {
                case 'where':
                case 'where_in':
                case 'where_not_in':
                case 'where_sql':
                    if (empty($filter_data) || !is_array($filter_data)) {
                        break;
                    }
                    if (!array_key_exists($filter_name, $params)) {
                        $params[$filter_name] = [];
                    }
                    $params[$filter_name] = array_merge_recursive($params[$filter_name], (array)$filter_data);

                    break;
                default:
                    if (isset($fields[$filter_name])) {
                        if (is_array($filter_data)) {
                            $params = array_merge_recursive($params, ['where_in' => [$filter_name => $filter_data]]);
                        } else {
                            $params = array_merge_recursive($params, ['where' => [$filter_name => $filter_data]]);
                        }
                    }

                    break;
            }
        }

        return $params;
    }

    /**
     * @param int|null $page
     * @param int|null $limits
     * @param mixed|null $order_by
     * @param array $params
     *
     * @return array
     */
    protected function getListInternal(int $page = null, int $limits = null, $order_by = null, array $params = []): array
    {
        $table = $params['table'] ?? $this->table;
        $fields_str = $table . '.' . implode(', ' . $table . '.', $this->fields_all);

        return $this->ci->cache->get($table, 'list', function () use ($page, $limits, $order_by, $params, $table, $fields_str) {
            $ci = &get_instance();

            $ci->db->select($fields_str);
            $ci->db->from($table);
            $this->where($params);

            if (is_array($order_by) && count($order_by) > 0) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $this->fields_all)) {
                        $ci->db->order_by($field . ' ' . $dir);
                    } elseif ($field == 'order_str') {
                        if (is_array($dir)) {
                            foreach ($dir as $f => $d) {
                                $ci->db->order_by($f . ' ' . $d);
                            }
                        } else {
                            $ci->db->order_by($dir);
                        }
                    }
                }
            } elseif ($order_by) {
                $ci->db->order_by($order_by);
            }

            if (!is_null($page)) {
                $page = $page ?: 1;
                $ci->db->limit($limits, $limits * ($page - 1));
            }

            $results = $ci->db->get()->result_array();

            if (!empty($results) && is_array($results)) {
                return $results;
            }

            return [];
        });
    }

    /**
     * @param array $params
     *
     * @return int
     */
    protected function getCountInternal(array $params = []): int
    {
        $table = $params['table'] ?? $this->table;

        return $this->ci->cache->get($table, 'count', function () use ($params, $table) {
            $ci = &get_instance();

            $ci->db->select('COUNT(*) AS cnt');
            $ci->db->from($table);

            $this->where($params);

            $results = $ci->db->get()->result_array();
            if (!empty($results) && is_array($results)) {
                return (int)$results[0]['cnt'];
            }

            return 0;
        });
    }

    /**
     * @param array $filters
     * @param int|null $page
     * @param int|null $items_on_page
     * @param null $order_by
     *
     * @return array
     */
    public function getList(array $filters = [], int $page = null, int $items_on_page = null, $order_by = null): array
    {
        $params = $this->getCriteriaInternal($filters);

        return $this->getListInternal($page, $items_on_page, $order_by, $params);
    }

    /**
     * @param array $filters
     * @param int|null $page
     * @param int|null $items_on_page
     * @param null $order_by
     *
     * @return array
     */
    public function getListByKey(array $filters = [], int $page = null, int $items_on_page = null, $order_by = null): array
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list = $this->getListInternal($page, $items_on_page, $order_by, $params);
        foreach ($list as $item) {
            $return[$item['id']] = $item;
        }

        return $return;
    }

    /**
     * @param string $field
     * @param array $filters
     * @param int|null $page
     * @param int|null $items_on_page
     * @param null $order_by
     *
     * @return array
     */
    public function getListByField(string $field, array $filters = [], int $page = null, int $items_on_page = null, $order_by = null): array
    {
        $return = [];

        $params = $this->getCriteriaInternal($filters);
        $list = $this->getListInternal($page, $items_on_page, $order_by, $params);
        foreach ($list as $item) {
            $return[$item[$field]] = $item;
        }

        return $return;
    }

    /**
     * @param array $filters
     *
     * @return int
     */
    public function getCount(array $filters = []): int
    {
        $params = $this->getCriteriaInternal($filters);

        return $this->getCountInternal($params);
    }

    /**
     * @param array $data
     * @param int|null $id
     *
     * @return int
     */
    public function save(array $data, int $id = null): int
    {
        if (is_null($id)) {
            $this->ci->db->insert($this->table, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update($this->table, $data);
        }

        $this->ci->cache->flush($this->table);

        return (int) $id;
    }

    /**
     * @param array $filters
     */
    public function delete(array $filters)
    {
        $table = $filters['table'] ?? $this->table;

        $this->where($filters);
        $this->ci->db->delete($table);

        $this->ci->cache->flush($table);
    }

    /**
     * @param array $params
     */
    protected function where(array $params)
    {
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
                $this->ci->db->where($value, null, false);
            }
        } elseif (isset($params['where_sql']) && is_array($params['where_sql']) !== true) {
            $this->ci->db->where($params['where_sql'], null, false);
        }
    }
}
