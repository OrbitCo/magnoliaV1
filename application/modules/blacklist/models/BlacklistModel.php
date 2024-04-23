<?php

declare(strict_types=1);

namespace Pg\modules\blacklist\models;

if (!defined('BLACKLIST_TABLE')) {
    define('BLACKLIST_TABLE', DB_PREFIX . 'blacklist');
}

/**
 * Blacklist model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class BlacklistModel extends \Model
{

    const MODULE_GID = 'blacklist';

    private $fields = [
        'id',
        'id_user',
        'id_dest_user',
        'date_add',
    ];

    private $fields_str;

    public function __construct()
    {
        parent::__construct();

        $this->fields_str = implode(', ', $this->fields);
    }

    public function getSitemapUrls()
    {
        $this->ci->load->helper('seo');
        $auth = $this->ci->session->userdata('auth_type');
        $block = [
            [
                'name'      => l('blacklist', 'blacklist'),
                'link'      => rewrite_link('blacklist', 'index'),
                'clickable' => $auth === 'user',
                'items'     => [],
            ],
        ];

        return $block;
    }

    public function getSitemapXmlUrls()
    {
        $this->ci->load->helper('seo');

        return [];
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        if ($var_name_from == $var_name_to) {
            return $value;
        }
    }

    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        } else {
            $actions = ['index'];
            $return = [];
            foreach ($actions as $action) {
                $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
            }

            return $return;
        }
    }

    public function getSeoSettingsInternal($method, $lang_id = '')
    {
        switch ($method) {
            case 'index':
                return [
                    "templates"   => [],
                    "url_vars"    => [],
                    'url_postfix' => [
                        'action' => ['action' => 'literal'],
                        'page'   => ['page'   => 'numeric'],
                    ],
                    'optional' => [],
                ];
        }
    }

    public function bannerAvailablePages()
    {
        return [
            ["link" => "blacklist/index", "name" => l('blacklist', 'blacklist')],
        ];
    }

    private function setCallback($type, $id_user, $id_dest_user)
    {
        $this->ci->load->model('blacklist/models/Blacklist_callbacks_model');
        $this->ci->Blacklist_callbacks_model->execute_callbacks($type, $id_user, $id_dest_user);
    }

    private function delete($params)
    {
        $this->ci->db->where($params)->delete(BLACKLIST_TABLE);

        return $this->ci->db->affected_rows();
    }

    private function get($params, $page = null, $items_on_page = null, $order_by = null)
    {
        if (!empty($params["where"]) && is_array($params["where"])) {
            $this->ci->db->where($params["where"]);
        }

        if (!empty($params["where_sql"]) && is_array($params['where_sql'])) {
            foreach ($params['where_sql'] as $where) {
                $this->ci->db->where($where);
            }
        }

        if (!empty($params["where_in"]) && is_array($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (is_array($order_by) && count($order_by)) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field, $dir);
                }
            }
        }

        if (!is_null($page) && !is_null($items_on_page)) {
            $page = intval($page) > 0 ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        return $this->ci->db->select($this->fields_str)->from(BLACKLIST_TABLE)->get()->result_array();
    }

    public function add($id_user, $id_dest_user)
    {
        $data = [
            'id_user'      => $id_user,
            'id_dest_user' => $id_dest_user,
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $this->ci->db->ignore()->query($this->ci->db->insert_string(BLACKLIST_TABLE, $data));
        $this->setCallback('blacklist_add', $id_user, $id_dest_user);

        return true;
    }

    public function remove($id_user, $id_dest_user)
    {
        $this->delete([
            'id_user'      => $id_user,
            'id_dest_user' => $id_dest_user, ]);
        $this->setCallback('blacklist_remove', $id_user, $id_dest_user);

        return true;
    }

    /**
     * @param type $id_user      int
     * @param type $id_dest_user int
     * @param type $field        string, 'user' - determine if dest_user is blocked by user, 'dest_user' - if user is blocked by dest_user
     *
     * @return boolean
     */
    public function isBlocked($id_user, $id_dest_user)
    {
        return (bool) $this->get([
            'where' => [
                'id_user'      => $id_user,
                'id_dest_user' => $id_dest_user,
            ],
        ]);
    }

    /**
     * Return user list
     *
     * @param type    $id_user       int
     * @param type    $page          int
     * @param type    $items_on_page int
     * @param type    $order_by      array
     * @param type    $search        string
     * @param boolean $formatted     boolean
     *
     * @return type array
     */
    public function getList($id_user = null, $page = null, $items_on_page = null, $order_by = null, $search = '', $formatted = true)
    {
        $list_params = $this->getListParams($id_user);
        if ($search) {
            $list = $this->get($list_params['params'], null, null, $order_by);
            $formatted = true;
        } else {
            $list = $this->get($list_params['params'], $page, $items_on_page, $order_by);
        }

        if ($formatted) {
            $list = $this->formatList($list, $list_params['user_field'], $search);
            if ($search && $page && $items_on_page) {
                $list = array_slice($list, ($page - 1) * $items_on_page, $items_on_page);
            }
        }

        return $list;
    }

    public function getListByParams($params = [])
    {
        return $this->get($params);
    }

    public function getListUsersIds($id_user)
    {
        $list_params = $this->getListParams($id_user);
        $list = $this->get($list_params['params']);
        $ids = [];
        foreach ($list as $list_entry) {
            $ids[] = $list_entry[$list_params['user_field']];
        }

        return $ids;
    }

    public function getListCount($id_user = null, $search = '')
    {
        $count = 0;
        $list_params = $this->getListParams($id_user);
        $user_field = $list_params['user_field'];
        $params = $list_params['params'];
        if ($search) {
            $list = $this->get($params);
            $user_ids = [];
            foreach ($list as $key => $l) {
                $user_ids[$l[$user_field]] = $l[$user_field];
            }
            if ($user_ids) {
                $criteria = $this->getSearchCriteria($search);
                $this->ci->load->model('Users_model');
                $count = $this->ci->Users_model->get_users_count($criteria, $user_ids);
            }
        } else {
            if (!empty($params['where']) && is_array($params['where'])) {
                $this->ci->db->where($params['where']);
            }
            if (!empty($params['where_in']) && is_array($params['where_in'])) {
                foreach ($params['where_in'] as $field => $value) {
                    $this->ci->db->where_in($field, $value);
                }
            }
            $count = $this->ci->db->count_all_results(BLACKLIST_TABLE);
        }

        return intval($count);
    }

    private function getListParams($id_user = null)
    {
        $result['user_field'] = 'id_dest_user';
        $where_user_field = 'id_user';
        if ($id_user) {
            $result['params']['where'][$where_user_field] = $id_user;
        }

        return $result;
    }

    private function formatList($list, $user_field = 'id_user', $search = '')
    {
        $user_ids = $users = [];
        foreach ($list as $key => $l) {
            $user_ids[$l[$user_field]] = $l[$user_field];
        }
        $this->ci->load->model('Users_model');
        if ($user_ids) {
            $criteria = $search ? $this->getSearchCriteria($search) : [];
            $users = $this->ci->Users_model->get_users_list_by_key(null, null, null, $criteria, $user_ids);
        }
        $users[0] = $this->ci->Users_model->format_default_user(1);
        foreach ($list as $key => &$l) {
            $l['user_field'] = $user_field;
            if (!empty($users[$l[$user_field]])) {
                $l['user'] = $users[$l[$user_field]];
            } elseif ($search) {
                unset($list[$key]);
            } else {
                $l['user'] = $users[0];
            }
        }

        return $list;
    }

    private function getSearchCriteria($search)
    {
        $search = trim(strip_tags($search));
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        $temp_criteria = $this->ci->Field_editor_model->return_fulltext_criteria($search);
        $criteria = [
            'fields' => [
                $temp_criteria['user']['field'],
            ],
            'where_sql' => [
                $temp_criteria['user']['where_sql'],
            ],
        ];

        return $criteria;
    }

    public function getBlockedIds($id_user = null, $is_check_from_another = false)
    {
        $my_blacklist = array_column($this->ci->db->select('id_dest_user')->from(BLACKLIST_TABLE)->where('id_user', $id_user)->get()->result_array(), 'id_dest_user');

        if (!$is_check_from_another) {
            return $my_blacklist;
        } else {
            $other_blacklist = array_column($this->ci->db->select('id_user')->from(BLACKLIST_TABLE)->where('id_dest_user', $id_user)->get()->result_array(), 'id_user');
            return array_merge($my_blacklist, $other_blacklist);
        }
    }

    /**
     * Get ids blocked users
     *
     * @param int $user_id
     *
     * @return array
     */
    public function excludeUsers(int $user_id): array
    {
        return $this->getBlockedIds($user_id) ?? [];
    }

    public function __call($name, $args)
    {
        $methods = [
            '_banner_available_pages' => 'bannerAvailablePages',
            'get_list' => 'getList',
            'request_seo_rewrite' => 'requestSeoRewrite',
            'get_sitemap_urls' => 'getSitemapUrls',
            'is_blocked' => 'isBlocked',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'get_seo_settings' => 'getSeoSettings',
            'get_list_count' => 'getListCount',
            'get_list_users_ids' => 'getListUsersIds',
            'get_blocked_ids' => 'getBlockedIds',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
