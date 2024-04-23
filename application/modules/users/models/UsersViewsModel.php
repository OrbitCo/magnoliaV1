<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\Libraries\Cache\Manager as CacheManager;

define('VIEWS_TABLE', DB_PREFIX . 'users_views');
define('VIEWERS_TABLE', DB_PREFIX . 'users_viewers');

/**
 * Users views model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-04-11 15:07:07 +0300 $ $Author: dpopenov $
 */
class UsersViewsModel extends \Model
{

    const DB_TABLE_CURRENT_PROFILE_VIEWERS = DB_PREFIX . 'current_profile_viewers';

    const NOTIFICATION_GID = 'users_view';

    const USERS_VIEW_COOKIE_NAME = 'users_view';

    private $fields_views = [
        'id_user',
        'id_viewer',
        'view_date',
    ];

    private $fields_viewers = [
        'id_user',
        'id_viewer',
        'view_date',
    ];

    private $field_date = 'view_date';

    const CACHE_NAME = 'UsersViewsModel';

    /**
     * UsersViewsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(self::CACHE_NAME, CacheManager::PROVIDER_REDIS);
    }

    public function updateViews($id_user, $id_viewer)
    {
        if (!$id_user || !$id_viewer) {
            return false;
        }
        $this->sendNotification($id_user, $id_viewer);
        $params = [
            'id_user' => $id_user,
            'id_viewer' => $id_viewer,
            'view_date' => date(UsersModel::DB_DATE_SIMPLE_FORMAT)
        ];
        $sql = $this->ci->db->insert_string(VIEWS_TABLE, $params) . " ON DUPLICATE KEY UPDATE `view_date`='{$params['view_date']}'";
        $this->ci->db->query($sql);

        $params['view_date'] = date(UsersModel::DB_DATE_FORMAT);
        $sql = $this->ci->db->insert_string(VIEWERS_TABLE, $params) . " ON DUPLICATE KEY UPDATE `view_date`='{$params['view_date']}'";
        $this->ci->db->query($sql);

        $this->ci->load->model('Users_model');
        $this->ci->Users_model->saveUser($id_user, ['views_count' => $this->getViewersCountDaily($id_user)]);
        $this->ci->cache->flush(self::CACHE_NAME);
        return true;
    }

    /**
     * Send notifications
     *
     * @param int $id_user
     * @param int $id_viewer
     *
     * @return void
     */
    public function sendNotification($id_user, $id_viewer)
    {

        $this->ci->load->model(['Notifications_model', 'Users_model']);
        $dest_user_data = $this->ci->Users_model->getUserById($id_viewer, true);
        $user_data = $this->ci->Users_model->getUserById($id_user);

        $is_new = current($this->getViews('unique', 1, 1, null, ['where' => [
            'id_user' => $id_user,
            'id_viewer' => $id_viewer,
            'view_date + INTERVAL 1 HOUR >=' => date(UsersModel::DB_DATE_FORMAT)
        ]]));

        if (empty($is_new)) {
            if (
                $this->ci->pg_module->is_module_installed('mobile') &&
                $this->ci->pg_module->get_module_config('mobile', 'use_notifications')
            ) {
                $this->ci->load->model('mobile/models/MobileUsersPushNotificationsModel');
                $title = l('notification_user_view', 'users', $user_data['lang_id']);
                $body = str_replace("[viewer]", $dest_user_data['nickname'], l('text_viewer', 'mobile_app', $user_data['lang_id']));
                $this->ci->MobileUsersPushNotificationsModel->pushNotification([
                    'id_user' => (int)$id_user,
                    'title' => (string)$title,
                    'body' => (string)$body,
                    'activity' => 'ProfileActivity',
                    'module' => UsersModel::MODULE_GID,
                    'gid' => self::NOTIFICATION_GID,
                    'viewer_id' => (int)$id_viewer,
                    'link' => site_url() . 'users/profile/' . $id_viewer
                ]);
            }

            $notification_data = [
                'fname' => UsersModel::formatUserName($dest_user_data),
                'nickname' => UsersModel::formatUserName($user_data),
                'image' => $dest_user_data['media']['user_logo']['thumbs']['middle'],
                'link_1' => $dest_user_data['link'],
                'link_2' => site_url() . 'users/my_guests',
            ];
            $this->ci->Notifications_model->sendNotification(
                $user_data['email'],
                self::NOTIFICATION_GID,
                $notification_data,
                '',
                $user_data['lang_id']
            );
        }
    }

    public function removeViewersCounter($viewers_data = [])
    {
        if (!empty($viewers_data)) {
            foreach ($viewers_data as $row) {
                $this->db->where('id_user', $row['id_user']);
                $this->db->where('id_viewer', $row['id_viewer']);
                $this->db->update(VIEWERS_TABLE, ['is_new' => 0]);
            }
            $this->ci->cache->flush(self::CACHE_NAME);
        }
    }

    public function getViewersCountUnique($id_user)
    {
        $callback = [$this,'getViewsCount'];
        return $this->ci->cache->get(self::CACHE_NAME, 'getViewersCountUnique' . $id_user, function () use ($callback, $id_user) {

            return call_user_func($callback, 'unique', ['id_user' => (int)$id_user]);
        });
    }

    public function getViewsCountUnique($id_user)
    {
        $callback = [$this,'getViewsCount'];
        return $this->ci->cache->get(
            self::CACHE_NAME,
            'getViewsCountUnique' . $id_user,
            function () use ($callback, $id_user) {
                return call_user_func($callback, 'unique', ['id_viewer' => (int)$id_user]);
            }
        );
    }

    /**
     * @param type  $id_user
     * @param type  $page
     * @param type  $items_on_page
     * @param type  $order_by
     * @param array $params
     *
     * @return array who view me unique for all time
     */
    public function getViewersUnique($id_user, $page = null, $items_on_page = null, $order_by = null, $params = [])
    {
        $params['where']['id_user'] = (int)$id_user;
        return $this->getViews('unique', $page, $items_on_page, $order_by, $params);
    }

    /**
     * @param type  $id_user
     * @param type  $page
     * @param type  $items_on_page
     * @param type  $order_by
     * @param array $params
     *
     * @return array who i view unique for all time
     */
    public function getViewsUnique($id_user, $page = null, $items_on_page = null, $order_by = null, $params = [])
    {
        return $this->getViews('unique', $page, $items_on_page, $order_by, ['where' => ['id_viewer' => (int)$id_user]]);
    }

    public function getViewersCountDaily($id_user, $period = 'all')
    {
        $callback = [$this,'getViewsCount'];
        $result = $this->ci->cache->get(self::CACHE_NAME, 'getViewersCountDaily' . $id_user . 'period' . $period, function () use ($callback, $id_user, $period) {
            $result  = call_user_func($callback, 'daily', ['id_user' => (int)$id_user], $period);
            return $result;
        });
        return $result;
    }

    public function getViewsCountDaily($id_user, $period = 'all')
    {
        $callback = [$this,'getViewsCount'];
        $result = $this->ci->cache->get(self::CACHE_NAME, 'getViewsCountDaily' . $id_user . 'period' . $period, function () use ($callback, $id_user, $period) {
            $result  = call_user_func($callback, 'daily', ['id_viewer' => (int)$id_user], $period);
            return $result;
        });

        return $result;
    }



    private function getViewsCount($type = 'unique', $params, $period = 'all')
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
              $user_id = $this->ci->session->userdata('user_id');
              $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $this->ci->db->where_not_in("id_user", $blocked_ids);
                $this->ci->db->where_not_in("id_viewer", $blocked_ids);
            }
        }

        if ($type == 'unique') {
            $db_table = VIEWERS_TABLE;
        } else {
            $date_field = $this->field_date;
            $db_table = VIEWS_TABLE;
            $dates = $this->getPeriodDates($period);
            if (!empty($dates['from'])) {
                $params["{$date_field} >="] = $dates['from'];
            }
            if (!empty($dates['to'])) {
                $params["{$date_field} <="] = $dates['to'];
            }
        }
        return $this->ci->db->where($params)->from($db_table)->count_all_results();
    }

    private function getPeriodDates($period)
    {
        $dates = [];
        switch ($period) {
            case 'today':
                $dates['from'] = $dates['to'] = date(UsersModel::DB_DATE_SIMPLE_FORMAT);
                break;
            case 'week':
                $dates['from'] = date(UsersModel::DB_DATE_SIMPLE_FORMAT, time() - 3600 * 24 * 7);
                $dates['to'] = date(UsersModel::DB_DATE_SIMPLE_FORMAT);
                break;
            case 'month':
                $dates['from'] = date(UsersModel::DB_DATE_SIMPLE_FORMAT, time() - 3600 * 24 * 30);
                $dates['to'] = date(UsersModel::DB_DATE_SIMPLE_FORMAT);
                break;
            case 'all':
            default:
                break;
        }
        return $dates;
    }

    /**
     * @param type  $id_user
     * @param type  $page
     * @param type  $items_on_page
     * @param type  $order_by
     * @param array $params
     *
     * @return array who view me unique for every day
     */
    public function getViewersDaily($id_user, $page = null, $items_on_page = null, $order_by = null, $params = [], $period = 'all')
    {
        return $this->getViews('daily', $page, $items_on_page, $order_by, ['where' => ['id_user' => (int)$id_user]], $period);
    }

    /**
     * @param type  $id_user
     * @param type  $page
     * @param type  $items_on_page
     * @param type  $order_by
     * @param array $params
     *
     * @return array who i view unique for every day
     */
    public function getViewsDaily($id_user, $page = null, $items_on_page = null, $order_by = null, $params = [], $period = 'all')
    {
        return $this->getViews('daily', $page, $items_on_page, $order_by, ['where' => ['id_viewer' => (int)$id_user]], $period);
    }

    public function getViewsDailyUnique($id_user, $page = null, $items_on_page = null, $order_by = null, $params = [], $period = 'all')
    {
        if ($period == 'all') {
            return $this->getViewsUnique($id_user, $page, $items_on_page, $order_by, $params);
        }

        $views_daily = $this->getViewsDaily($id_user, null, null, $order_by, $params, $period);
        $views_ids = [];
        foreach ($views_daily as $view) {
            $views_ids[$view['id_user']] = $view['id_user'];
        }
        $result = [];
        if ($views_ids) {
            $params['where_in']['id_user'] = $views_ids;
            $result = $this->getViewsUnique($id_user, $page, $items_on_page, $order_by, $params);
        }

        return $result;
    }

    public function getViewersDailyUnique($id_user, $page = null, $items_on_page = null, $order_by = null, $params = [], $period = 'all', $is_new = 0)
    {
        if ($is_new) {
            $params['where']['is_new'] = 1;
        }

        if ($period == 'all') {
            return $this->getViewersUnique($id_user, $page, $items_on_page, $order_by, $params);
        }

        $viewers_daily = $this->getViewersDaily($id_user, null, null, $order_by, $params, $period);
        $viewers_ids = [];
        foreach ($viewers_daily as $viewer) {
            $viewers_ids[$viewer['id_viewer']] = $viewer['id_viewer'];
        }
        $result = [];
        if ($viewers_ids) {
            $params['where_in']['id_viewer'] = $viewers_ids;
            $result = $this->getViewersUnique($id_user, $page, $items_on_page, $order_by, $params);
        }

        return $result;
    }

    public function getViewersCountDailyUnique($id_user, $period = 'all')
    {
        if ($period == 'all') {
            return $this->getViewersCountUnique($id_user);
        }

        $viewers_daily = $this->getViewersDaily($id_user, null, null, null, [], $period);
        $viewers_ids = [];
        foreach ($viewers_daily as $viewer) {
            $viewers_ids[$viewer['id_viewer']] = $viewer['id_viewer'];
        }

        return count($viewers_ids);
    }

    public function getViewsCountDailyUnique($id_user, $period = 'all')
    {
        if ($period == 'all') {
            return $this->getViewsCountUnique($id_user);
        }

        $viewers_daily = $this->getViewsDaily($id_user, null, null, null, [], $period);
        $viewers_ids = [];
        foreach ($viewers_daily as $viewer) {
            $viewers_ids[$viewer['id_user']] = $viewer['id_user'];
        }

        return count($viewers_ids);
    }

    public function saveProfileViewer($user_id = null)
    {
        $user_id = intval($user_id);
        $viewer_id = $this->ci->session->userdata('user_id');

        $is_hide_on_site = $this->ci->Users_model->getUserById($viewer_id, true)['is_hide_on_site'];

        if (!empty($user_id) && $user_id != $viewer_id && $is_hide_on_site === 0) {
            $this->ci->db->insert(self::DB_TABLE_CURRENT_PROFILE_VIEWERS, [
                'user_id' => $user_id,
                'viewer_id' => $viewer_id,
                'expire_after_ts' => time() + 60 * 10 //expire_after 10 minutes
            ]);
            $this->ci->cache->flush(self::CACHE_NAME);
        }
    }

    public function deleteExpiredViewers()
    {
        $this->ci->db->where('expire_after_ts <', time())->delete(self::DB_TABLE_CURRENT_PROFILE_VIEWERS);
        $this->ci->cache->flush(self::CACHE_NAME);
    }

    public function deleteViewersByIds($ids)
    {
        if (!empty($ids) && is_array($ids)) {
            $this->ci->db->where_in('id', $ids)->delete(self::DB_TABLE_CURRENT_PROFILE_VIEWERS);
            $this->ci->cache->flush(self::CACHE_NAME);
        }
    }

    public function deleteByViewerId(int $id)
    {
        $this->ci->db->where_in('viewer_id', $id)->delete(self::DB_TABLE_CURRENT_PROFILE_VIEWERS);
        $this->ci->cache->flush(self::CACHE_NAME);
    }

    public function getCurrentProfileViewers($user_id = null)
    {
        $return = ['viewers' => [], 'ids_to_delete_notifications' => []];
        $user_id = intval($user_id);
        $viewers_data = $this->ci->db->select()->from(self::DB_TABLE_CURRENT_PROFILE_VIEWERS)
        ->where('user_id', $user_id)
        ->where('expire_after_ts >', time())
        ->get()->result_array();

        if (!empty($viewers_data)) {
            $viewers_ids = array_map(function ($v) {
                return $v['viewer_id'];
            }, $viewers_data);
            $items_ids = array_map(function ($v) {
                return $v['id'];
            }, $viewers_data);

            $this->ci->load->model('Users_model');

            $return['viewers'] = $this->ci->Users_model->getUsersList(null, null, null, null, $viewers_ids, true, true);

            $return['ids_to_delete'] = $items_ids;
        }

        return $return;
    }

    public function backendGetViewersCount()
    {
        $user_id = $this->ci->session->userdata('user_id');
        $viewers_data = $this->getCurrentProfileViewers($user_id);

        if (!empty($viewers_data['ids_to_delete'])) {
            $this->deleteViewersByIds($viewers_data['ids_to_delete']);
        }

        $return = ['count' => count($this->getViewersDailyUnique($user_id, null, null, ['view_date' => 'DESC'], [], 'all', 1))];

        if (!empty($viewers_data['viewers'])) {
            $return['viewers'] = $viewers_data['viewers'];
        }

        $return['viewers_langs'] = [
            'title' => l('profile_view_notificaiton_title', 'users'),
            'message' => l('profile_view_notificaiton_message', 'users'),
        ];

        return $return;
    }

    private function getViews($type = 'unique', $page = null, $items_on_page = null, $order_by = null, $params = [], $period = 'all')
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                  $this->ci->db->where_not_in("id_user", $blocked_ids);
                  $this->ci->db->where_not_in("id_viewer", $blocked_ids);
            }
        }

        if ($type == 'unique') {
            $db_fields = $this->fields_viewers;
            $db_table = VIEWERS_TABLE;
        } else {
            $db_fields = $this->fields_views;
            $date_field = $this->field_date;
            $db_table = VIEWS_TABLE;
            $dates = $this->getPeriodDates($period);
            if (!empty($dates['from'])) {
                $this->ci->db->where("{$date_field} >=", $dates['from']);
            }
            if (!empty($dates['to'])) {
                $this->ci->db->where("{$date_field} <=", $dates['to']);
            }
        }
        $this->ci->db->select(implode(", ", $db_fields))->from($db_table);

        if (!empty($params["where"]) && is_array($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (!empty($params["where_in"]) && is_array($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (!empty($params["where_sql"]) && is_array($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $db_fields)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = (int)($page) ?: 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        return $this->ci->db->get()->result_array();
    }

    public function __call($name, $args)
    {
        $methods = [
            'backend_get_viewers_count' => 'backendGetViewersCount',
            'get_viewers_count_daily' => 'getViewersCountDaily',
            'get_viewers_count_daily_unique' => 'getViewersCountDailyUnique',
            'get_viewers_count_unique' => 'getViewersCountUnique',
            'get_viewers_daily' => 'getViewersDaily',
            'get_viewers_daily_unique' => 'getViewersDailyUnique',
            'get_viewers_unique' => 'getViewersUnique',
            'get_views_count_daily' => 'getViewsCountDaily',
            'get_views_count_daily_unique' => 'getViewsCountDailyUnique',
            'get_views_count_unique' => 'getViewsCountUnique',
            'get_views_daily' => 'getViewsDaily',
            'get_views_daily_unique' => 'getViewsDailyUnique',
            'get_views_unique' => 'getViewsUnique',
            'remove_viewers_counter' => 'removeViewersCounter',
            'update_views' => 'updateViews',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
