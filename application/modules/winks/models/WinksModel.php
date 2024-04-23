<?php

declare(strict_types=1);

namespace Pg\modules\winks\models;

use Pg\Libraries\Analytics;

define('WINKS_TABLE', DB_PREFIX . 'winks');

/**
 * Winks model.
 *
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class WinksModel extends \Model
{
    public const MODULE_GID = 'winks';

    /**
     * Table fields.
     *
     * @var array
     */
    private $fields = [
        'id',
        'id_from',
        'id_to',
        'type',
        'date',
        'is_viewed',
    ];

    public $types = ['new', 'replied', 'ignored'];

    /**
     *Winks count by user id.
     *
     * @var array
     */
    private $winks_count_by_user_id = [];

    public function delete($user1, $user2)
    {
        $this->ci->db->where('id_from', $user1)
            ->where('id_to', $user2)
            ->or_where('id_from', $user2)
            ->where('id_to', $user1)
            ->delete(WINKS_TABLE);
    }

    /**
     * Delete winks (type=replied).
     *
     * @return void
     */
    public function deleteIsReplied($user_id)
    {
        $this->ci->db->where('id_to', $user_id)
            ->where('type', 'replied')
            ->delete(WINKS_TABLE);
    }

    public function save($data, $id = null)
    {
        if (empty($id)) {
            if (empty($data['id_from'])) {
                log_message('error', '(winks) Empty sender id');

                return false;
            } elseif (empty($data['id_to'])) {
                log_message('error', '(winks) Empty recipient id');

                return false;
            }

            $this->ci->load->library('Analytics');
            $event = $this->ci->analytics->getEvent('winks', 'engaged', 'user');
            $this->ci->analytics->track($event);

            if (empty($data['date'])) {
                $data['date'] = date('Y-m-d H:i:s');
            }
            foreach ($data as $field => $val) {
                $fields_upd[] = "`$field` = " . $this->ci->db->escape($val);
            }
            $update_str = implode(', ', $fields_upd);
            $sql = $this->ci->db->insert_string(WINKS_TABLE, $data) . " ON DUPLICATE KEY UPDATE {$update_str}";
            $this->ci->db->query($sql);
        } else {
            if (!empty($data['type']) && !in_array($data['type'], $this->types)) {
                log_message('error', '(winks) Wrong type');

                return false;
            }

            $this->ci->load->library('Analytics');
            $event = $this->ci->analytics->getEvent('winks', 'engaged_back', 'user');
            $this->ci->analytics->track($event);

            $this->ci->db->where('id', $id)
                ->update(WINKS_TABLE, $data);
        }

        return true;
    }

    public function getWinkers($user_id)
    {
        $winks = $this->ci->db->select('id_from, id_to')
                ->from(WINKS_TABLE)
                ->where('id_to', $user_id)
                ->or_where('id_from', $user_id)
                ->where('type !=', 'ignored')
                ->get()->result_array();
        $user_ids = [];
        foreach ($winks as $wink) {
            if ($wink['id_from'] == $user_id) {
                $user_ids[] = (int) $wink['id_to'];
            } else {
                $user_ids[] = (int) $wink['id_from'];
            }
        }

        return $user_ids;
    }

    public function getByPair($user1, $user2)
    {
        $pair = $this->ci->db->select(implode(', ', $this->fields))
                ->from(WINKS_TABLE)
                ->where('id_from', $user1)
                ->where('id_to', $user2)
                ->or_where('id_from', $user2)
                ->where('id_to', $user1)
                ->get()->result_array();

        return array_shift($pair);
    }

    public function get($params = [], $page = 1, $items_on_page = 20, $order_by = null, $filter_object_ids = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');

            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id, true)) {
                $this->ci->db->where_not_in('id_from', $blocked_ids);
                $this->ci->db->where_not_in('id_to', $blocked_ids);
            }
        }

        $this->ci->db->select(implode(', ', $this->fields))->from(WINKS_TABLE);

        if (!empty($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (!empty($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (!empty($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
                    $this->ci->db->order_by($field . ' ' . $dir);
                }
            }
        }

        $page = intval($page);
        if (!empty($page)) {
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();

        return $results;
    }

    /**
     * Return number of winks.
     *
     * @param array $params
     *
     * @return array
     */
    public function getCount($params = [])
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');

            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id, true)) {
                $this->ci->db->where_not_in('id_from', $blocked_ids);
                $this->ci->db->where_not_in('id_to', $blocked_ids);
            }
        }

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
        }

        return $this->ci->db->count_all_results(WINKS_TABLE);
    }

    public function setIsViewed($ids)
    {
        $this->ci->db->where_in('id', $ids)
            ->update(WINKS_TABLE, ['is_viewed' => 1]);
    }

    public function format($winks)
    {
        $user_ids = [];
        foreach ($winks as $wink) {
            if (!in_array($wink['id_from'], $user_ids)) {
                $user_ids[] = $wink['id_from'];
            }
            if (!in_array($wink['id_to'], $user_ids)) {
                $user_ids[] = $wink['id_to'];
            }
        }

        if ($user_ids) {
            $this->ci->load->model(['Users_model', 'users/models/Users_deleted_model']);
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $user_ids, true);
            $default_user = $this->ci->Users_model->formatDefaultUser(1);
            $deleted_users = $this->ci->Users_deleted_model->getUsersList(null, null, null, [
                'where_in' => [
                    'id_user' => $user_ids,
                ],
            ]);

            foreach ($user_ids as $uid) {
                if (!isset($users[$uid]['id'])) {
                    $users[$uid] = $default_user;
                    foreach ($deleted_users as $deleted_user) {
                        if ($uid == $deleted_user['id_user']) {
                            $users[$uid] = array_merge($users[$uid], $deleted_user);

                            break;
                        }
                    }
                }
            }
            foreach ($winks as &$wink) {
                $wink['from'] = isset($users[$wink['id_from']]) ? $users[$wink['id_from']] : $default_user;
                $wink['to'] = isset($users[$wink['id_to']]) ? $users[$wink['id_to']] : $default_user;
            }
        }

        return $winks;
    }

    /**
     * Winks count.
     *
     * @param int $user_id
     *
     * @return array
     */
    public function getUserWinksCount($user_id = null)
    {
        if (!$user_id) {
            $user_id = $this->ci->session->userdata('user_id');
        }

        if (!isset($this->winks_count_by_user_id[$user_id])) {
            $this->winks_count_by_user_id[$user_id] = $this->getCount([
                'where' => ['id_to' => $user_id],
                'where_not_in' => [
                    'type' => ['ignored', 'deleted'],
                ],
            ]);
        }

        return $this->winks_count_by_user_id[$user_id];
    }

    public function backendWinksCount()
    {
        $winks_count = $this->getCount([
            'where' => ['id_to' => $this->ci->session->userdata('user_id'), 'is_viewed' => ''],
            'where_not_in' => [
                'type' => ['ignored', 'deleted']
            ]
        ]);

        return ['count' => intval($winks_count)];
    }

    // seo
    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        }
        $actions = ['index'];
        $return = [];
        foreach ($actions as $action) {
            $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
        }

        return $return;
    }

    private function getSeoSettingsInternal($method, $lang_id = '')
    {
        if ($method == 'index') {
            return [
                'title' => l('seo_tags_index_title', 'winks', $lang_id, 'seo'),
                'keyword' => l('seo_tags_index_keyword', 'winks', $lang_id, 'seo'),
                'description' => l('seo_tags_index_description', 'winks', $lang_id, 'seo'),
                'templates' => [],
                'header' => l('seo_tags_index_header', 'winks', $lang_id, 'seo'),
                'url_vars' => [],
                'url_postfix' => [
                    'page' => ['page' => 'numeric'],
                ],
            ];
        }
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        if ($var_name_from == $var_name_to) {
            return $value;
        }
    }

    public function getSitemapXmlUrls($generate = true)
    {
        $this->ci->load->helper('seo');
        if ($this->ci->pg_module->is_module_installed('seo')) {
            $lang_canonical = $this->ci->pg_module->get_module_config('seo', 'lang_canonical');
        } else {
            $lang_canonical = true;
        }
        $languages = $this->ci->pg_language->languages;
        if ($lang_canonical) {
            $default_lang_id = $this->ci->pg_language->get_default_lang_id();
            $default_lang_code = $this->ci->pg_language->get_lang_code_by_id($default_lang_id);
            $langs[$default_lang_id] = $default_lang_code;
        } else {
            foreach ($languages as $lang_id => $lang_data) {
                $langs[$lang_id] = $lang_data['code'];
            }
        }
        $return = [];
        $user_settings = $this->ci->pg_seo->get_settings('user', 'winks', 'index');
        if (!$user_settings['noindex']) {
            if ($generate === true) {
                $languages = $this->ci->pg_language->languages;
                $this->ci->pg_seo->set_lang_prefix('user');
                foreach ($languages as $lang_id => $lang_data) {
                    if ($this->ci->pg_language->is_active($lang_id) === true) {
                        $lang_code = $this->ci->pg_language->get_lang_code_by_id($lang_id);
                        $this->ci->pg_seo->set_lang_prefix('user', $lang_code);
                        $return[] = [
                            'url' => rewrite_link('winks', 'index', [], false, $lang_code),
                            'priority' => $user_settings['priority'],
                            'page' => 'index',
                        ];
                    }
                }
            } else {
                $return[] = [
                    'url' => rewrite_link('winks', 'index', [], false, null, $lang_canonical),
                    'priority' => $user_settings['priority'],
                    'page' => 'index',
                ];
            }
        }

        return $return;
    }

    public function getSitemapUrls()
    {
        $this->ci->load->helper('seo');
        $auth = $this->ci->session->userdata('auth_type');
        $block = [];
        if ('user' === $auth) {
            $block[] = [
                'name' => l('header_winks', 'winks'),
                'link' => rewrite_link('winks', 'index'),
                'clickable' => true,
            ];
        }

        return $block;
    }

    /**
     *  Module category action.
     *
     *  @return array
     */
    public function moduleCategoryAction()
    {
        return [
            'name' => l('wink', 'winks'),
            'helper' => 'wink',
        ];
    }

    public function callbackUserDelete($id_user)
    {
        $winks = $this->get([
            'where' => ['id_from' => $id_user],
        ]);
        if (!empty($winks)) {
            foreach ($winks as $wink) {
                $ids[] = $wink['id'];
            }
            $this->ci->db->where_in('id', $ids)
                    ->update(WINKS_TABLE, ['type' => 'deleted']);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_seo_settings' => 'getSeoSettings',
            'backend_winks_count' => 'backendWinksCount',
            'get_by_pair' => 'getByPair',
            'get_count' => 'getCount',
            'get_sitemap_urls' => 'getSitemapUrls',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'get_winkers' => 'getWinkers',
            'request_seo_rewrite' => 'requestSeoRewrite',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
