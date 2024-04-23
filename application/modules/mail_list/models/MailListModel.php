<?php

declare(strict_types=1);

namespace Pg\modules\mail_list\models;

use Pg\modules\couples\models\CouplesModel;

if (!defined('SUBSCRIPTIONS_USERS_TABLE')) {
    define('SUBSCRIPTIONS_USERS_TABLE', DB_PREFIX . 'subscriptions_users');
}
if (!defined('MAIL_LIST_FILTERS_TABLE')) {
    define('MAIL_LIST_FILTERS_TABLE', DB_PREFIX . 'mail_list_filters');
}

class MailListModel extends \Model
{
    private $fields_user = [
        'id',
        'date_created',
        'email',
        'nickname',
        'user_type',
        'password',
        'confirm',
        'approved',
        'fname',
        'sname',
        'lang_id',
        'group_id',
        'birth_date',
        'email',
        'id_country',
        'id_region',
        'id_city',
    ];
    private $fields_subscriptions_users = [
        'id_user',
        'id_subscription',
    ];
    private $fields_filters = [
        'id',
        'search_data',
        'date_search',
    ];

    public function __construct()
    {
        parent::__construct();
        if ($this->ci->pg_module->is_module_installed('couples')) {
            $this->fields_user = CouplesModel::addFields(USERS_TABLE, $this->fields_user);
        }
        // Add table name as prefixes
        array_walk($this->fields_user, function (&$item) {
            $item = USERS_TABLE . "." . $item;
        });
    }

    /**
     * @param array $params
     * @param int   $page
     * @param int   $items_on_page
     * @param bool  $only_id       If true, returns only a list of user id and won't split result into pages
     *
     * @return mixed
     */
    public function getUsers($params, $page = 1, $items_on_page = null, $only_id = false)
    {
        if (false == $only_id) {
            $this->ci->db->select(implode(', ', $this->fields_user))
                    ->select(implode(', ', $this->fields_subscriptions_users));
        } else {
            $this->ci->db->select(USERS_TABLE . '.id');
        }
        $this->ci->db->from(USERS_TABLE);

        if (isset($params['where']['id_subscription']) && intval($params['where']['id_subscription'])) {
            $this->ci->db->join(SUBSCRIPTIONS_USERS_TABLE, USERS_TABLE . '.id = ' . SUBSCRIPTIONS_USERS_TABLE . '.id_user AND ' .
                    SUBSCRIPTIONS_USERS_TABLE . ".id_subscription='" . intval($params['where']['id_subscription']) . "'");
            unset($params['where']['id_subscription']);
        } elseif (isset($params['where_not']['id_subscription']) && intval($params['where_not']['id_subscription'])) {
            $this->ci->db->join(SUBSCRIPTIONS_USERS_TABLE, USERS_TABLE . '.id = ' . SUBSCRIPTIONS_USERS_TABLE . '.id_user AND ' .
                    SUBSCRIPTIONS_USERS_TABLE . ".id_user=" . USERS_TABLE . '.id', 'left');
            $this->ci->db->where(USERS_TABLE . '.id NOT IN', '(SELECT `id_user` FROM `' . SUBSCRIPTIONS_USERS_TABLE .
                    "` WHERE `id_subscription` = '{$params['where_not']['id_subscription']}')", false);
            $this->ci->db->group_by(USERS_TABLE . '.id');
            unset($params['where_not']['id_subscription']);
        } else {
            $join_subscr = !empty($params['id_subscription']) ? 'AND ' . SUBSCRIPTIONS_USERS_TABLE . '.id_subscription = ' . $params['id_subscription'] : '';
            $this->ci->db->join(SUBSCRIPTIONS_USERS_TABLE, USERS_TABLE . '.id = ' . SUBSCRIPTIONS_USERS_TABLE . ".id_user $join_subscr", 'left');
        }

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                if ($value) {
                    $this->ci->db->where($field, $value);
                }
            }
        }

        if (isset($params['like']) && is_array($params['like']) && count($params['like'])) {
            foreach ($params['like'] as $field => $value) {
                if ($value) {
                    $this->ci->db->like($field, $value);
                }
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (false == $only_id) {
            if (intval($page) <= 0) {
                $page = 1;
            }
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $users = $this->ci->db->get()->result_array();
        if (!empty($users) && is_array($users)) {
            if (false == $only_id) {
                $this->ci->load->model('Users_model');
                foreach ($users as $user) {
                    if (!empty($user['couple_id']) && $user['couple_id'] > 0 && $user['user_type'] == 'couple') {
                        $user['couple'] = $this->ci->Users_model->getUserById($user['couple_id']);
                    }
                    $data[] = $user;
                }
                $data = $this->ci->Users_model->formatUsers($data);
            } else {
                foreach ($users as $user) {
                    $data[] = $user['id'];
                }
            }

            return $data;
        }

        return false;
    }

    public function getUsersCount($params)
    {
        $this->ci->db->select('COUNT(' . USERS_TABLE . '.id) AS cnt');
        $this->ci->db->from(USERS_TABLE);

        if (isset($params['where']['id_subscription']) && intval($params['where']['id_subscription'])) {
            $this->ci->db->join(SUBSCRIPTIONS_USERS_TABLE, USERS_TABLE . '.id = ' . SUBSCRIPTIONS_USERS_TABLE . '.id_user AND ' . SUBSCRIPTIONS_USERS_TABLE . ".id_subscription='" . intval($params['where']['id_subscription']) . "'");
        } elseif (isset($params['where_not']['id_subscription']) && intval($params['where_not']['id_subscription'])) {
            $this->ci->db->select(implode(', ', $this->fields_subscriptions_users));
            $this->ci->db->join(SUBSCRIPTIONS_USERS_TABLE, USERS_TABLE . ".id = " . SUBSCRIPTIONS_USERS_TABLE . ".id_user AND " . SUBSCRIPTIONS_USERS_TABLE . ".id_user=" . USERS_TABLE . ".id", 'left'); // . intval($params['where_not']['id_subscription']) . "'");
            $where = '(' . SUBSCRIPTIONS_USERS_TABLE . '.id_user is null OR ' . SUBSCRIPTIONS_USERS_TABLE . '.id_subscription <>' . $params['where_not']['id_subscription'] . ')';
            $this->ci->db->where($where);
            unset($params['where_not']['id_subscription']);
        }

        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                if ($value) {
                    $this->ci->db->where($field, $value);
                }
            }
        }

        if (isset($params['like']) && is_array($params['like']) && count($params['like'])) {
            foreach ($params['like'] as $field => $value) {
                if ($value) {
                    $this->ci->db->or_like($field, $value);
                }
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value);
            }
        }

        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->cnt);
        } else {
            return 0;
        }
    }

    /**
     * @param int   $id_subscription
     * @param array $id_users
     *
     * @return boolean
     */
    public function subscribeUsers($id_subscription, $id_users)
    {
        if (!intval($id_subscription) || !$id_users) {
            return false;
        }
        $data['id_subscription'] = (int) $id_subscription;
        foreach ($id_users as $id_user) {
            $data['id_user'] = (int) $id_user;
            $this->ci->db->ignore()->insert(SUBSCRIPTIONS_USERS_TABLE, $data);
            $this->ci->db->insert_id();
        }

        return true;
    }

    /**
     * @param int   $id_subscription
     * @param array $id_users
     *
     * @return boolean
     */
    public function unsubscribeUsers($id_subscription, $id_users)
    {
        if (!intval($id_subscription) || !$id_users) {
            return false;
        }
        $data['id_subscription'] = (int) $id_subscription;
        foreach ($id_users as $id_user) {
            $data['id_user'] = (int) $id_user;
            $this->ci->db->where('id_user', $id_user)
                    ->where('id_subscription', $id_subscription)
                    ->delete(SUBSCRIPTIONS_USERS_TABLE);
        }

        return true;
    }

    /**
     * Saves search search criteria
     *
     * @param array $attrs of search criteria
     *
     * @return boolean record id when saved, true when exists, false when error
     */
    public function saveFilter($attrs)
    {
        if (false == is_array($attrs)) {
            return false;
        }
        $data['date_search'] = date('Y-m-d H:i:s');
        $data['search_data'] = serialize($attrs);

        // Check uniqueness
        $this->ci->db->where('search_data', $data['search_data']);
        $this->ci->db->from(MAIL_LIST_FILTERS_TABLE);
        $is_unique = 0 == $this->ci->db->count_all_results();

        if ($is_unique) {
            $this->ci->db->insert(MAIL_LIST_FILTERS_TABLE, $data);

            return $this->ci->db->insert_id();
        }

        return true;
    }

    /**
     * Returns the list of saved filters
     *
     * @param int $page
     * @param int $items_on_page
     *
     * @return array
     */
    public function getFilters($page = 1, $items_on_page = null)
    {
        $this->ci->db->select(implode(', ', $this->fields_filters));
        $this->ci->db->from(MAIL_LIST_FILTERS_TABLE);

        if (0 > intval($page)) {
            $page = 1;
        }

        $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));

        $searches = $this->ci->db->get()->result_array();
        if (!empty($searches) && is_array($searches)) {
            foreach ($searches as $key => $search) {
                $search['search_data'] = unserialize($search['search_data']);
                $data[$key]            = $search;
            }

            return $this->format_filters($data);
        }
    }

    /**
     * @param int $id_filter
     *
     * @return array
     */
    public function getFilter($id_filter)
    {
        $filter = $this->ci->db->select('search_data')
                        ->from(MAIL_LIST_FILTERS_TABLE)
                        ->where('id', $id_filter)
                        ->get()->row();

        return unserialize($filter->search_data);
    }

    public function formatFilters($data)
    {
        $locations = [];

        foreach ($data as $key => $filter) {
            $location = [];

            if (!empty($filter['search_data']['id_country'])) {
                $location[$key] = [$filter['search_data']['id_country']];
                if (!empty($filter['search_data']['id_region'])) {
                    $location[$key][] = $filter['search_data']['id_region'];
                    if (!empty($filter['search_data']['id_city'])) {
                        $location[$key][] = $filter['search_data']['id_city'];
                    }
                }
            }

            $data[$key]['search_data']['subscription'] = l("subscription_{$filter['search_data']['id_subscription']}", 'subscriptions');
        }

        // Format locations
        if (!empty($locations)) {
            $this->ci->load->helper('countries');
            $user_friendly_location = cities_output_format($locations);

            foreach ($data as $key => $filter) {
                $data[$key]['location'] = (isset($user_friendly_location[$key])) ? $user_friendly_location[$key] : '';
            }
        }

        return $data;
    }

    public function getFiltersCount()
    {
        return $this->ci->db->count_all(MAIL_LIST_FILTERS_TABLE);
    }

    /**
     * Removes filter by id
     *
     * @param int $id_filter
     *
     * @return boolean
     */
    public function deleteFilter($id_filter)
    {
        $this->ci->db->where('id', $id_filter)
                ->delete(MAIL_LIST_FILTERS_TABLE);

        return true;
    }

    /**
     * @param array $settings
     *
     * @return array
     */
    public function formatSearchAttrs($settings)
    {
        $search_attrs = [];

        if (!empty($settings['email'])) {
            $search_attrs['like']['email'] = $settings['email'];
        }

        if (!empty($settings['name'])) {
            $search_attrs['where_sql'][] = "(
                fname LIKE '%{$settings['name']}%' OR
                sname LIKE '%{$settings['name']}%' OR
                nickname LIKE '%{$settings['name']}%')";
        }
        
        $date_format = $this->pg_date->get_format('date_time_numeric', 'date');
        if (!empty($settings['date'])) {
            $search_attrs['where']['date_created >'] = date($date_format, strtotime($settings['date']));
        }

        if (!empty($settings['user_type'])) {
            $search_attrs['where']['user_type'] = $settings['user_type'];
        }

        // Location
        if (!empty($settings['id_city'])) {
            $search_attrs['where']['id_city'] = $settings['id_city'];
        } elseif (!empty($settings['id_region'])) {
            $search_attrs['where']['id_region'] = $settings['id_region'];
        } elseif (!empty($settings['id_country'])) {
            $search_attrs['where']['id_country'] = $settings['id_country'];
        }

        // Subscription
        if (!empty($settings['id_subscription'])) {
            if (!empty($settings['filter']) && 'subscribed' == $settings['filter']) {
                $search_attrs['where']['id_subscription'] = $settings['id_subscription'];
            } elseif (!empty($settings['filter']) && 'not_subscribed' == $settings['filter']) {
                $search_attrs['where_not']['id_subscription'] = $settings['id_subscription'];
            }
            $search_attrs['id_subscription'] = $settings['id_subscription'];
        }
        if ($this->ci->pg_module->is_module_installed('couples')) {
            $search_attrs['where']['is_coupled !='] =1;
        }
        return $search_attrs;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_filter' => 'deleteFilter',
            'format_filters' => 'formatFilters',
            'format_search_attrs' => 'formatSearchAttrs',
            'get_filter' => 'getFilter',
            'get_filters' => 'getFilters',
            'get_filters_count' => 'getFiltersCount',
            'get_users' => 'getUsers',
            'get_users_count' => 'getUsersCount',
            'save_filter' => 'saveFilter',
            'subscribe_users' => 'subscribeUsers',
            'unsubscribe_users' => 'unsubscribeUsers',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
