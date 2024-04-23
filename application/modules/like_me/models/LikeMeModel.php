<?php

declare(strict_types=1);

namespace Pg\modules\like_me\models;

use Pg\Libraries\Analytics;
use Pg\modules\users\models\SearchCriteria;
use Pg\modules\users\models\UsersModel;

if (!defined('TABLE_LIKE_ME')) {
    define('TABLE_LIKE_ME', DB_PREFIX . 'like_me');
}

/**
 * Like me main model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Nikita Savanaev <nsavanaev@pilotgroup.net>
 */
class LikeMeModel extends \Model
{
    public const MODULE_GID = 'like_me';
    public const PLAY_LOCATION_GLOBAL = 'global';
    public const PLAY_LOCATION_LOCAL = 'local';

    public const USERS_PER_PAGE = 100;

    public const DB_DATE_FORMAT = 'Y-m-d H:i:s';
    public const DB_DATE_FORMAT_SEARCH = 'Y-m-d H:i';
    public const DB_DEFAULT_DATE = '0000-00-00 00:00:00';

    public $users_per_page = 100;

    private $ds_gid = 'chat_message';
    private $modules_category = [
        'communication',
        'action',
    ];
    private $_not_include_modules = [
        'im',
        'mailbox'
    ];

    private $fields = [
        'id',
        'id_user',
        'id_profile',
        'status_match',
        'date_created',
    ];

    public $play_locations = [self::PLAY_LOCATION_GLOBAL, self::PLAY_LOCATION_LOCAL];

    public $play_location = self::PLAY_LOCATION_GLOBAL;

    /**
     *  Settings
     *
     *  @return array
     */
    public function getSettings()
    {
        $data = [
            'matches_per_page' => $this->ci->pg_module->get_module_config('like_me', 'matches_per_page'),
            'play_local_used'  => $this->ci->pg_module->get_module_config('like_me', 'play_local_used'),
            'play_local_area'  => $this->ci->pg_module->get_module_config('like_me', 'play_local_area'),
            'play_more'        => $this->ci->pg_module->get_module_config('like_me', 'play_more'),
            'chat_message'     => $this->ci->pg_module->get_module_config('like_me', 'chat_message'),
            'chat_more'        => $this->ci->pg_module->get_module_config('like_me', 'chat_more'),
        ];

        return $this->formatSettings($data);
    }

    /**
     *  Include module
     *
     *  @param integer $select
     *
     *  @return array
     */
    public function getActionModules($select = null)
    {
        $return = [];
        $data = ($this->ci->session->userdata("auth_type") == "user") ? [$select] : $this->getModules();
        foreach ($data as $value) {
            $model_name = ucfirst($value . '_model');
            $this->ci->load->model($value . '/models/' . $model_name);

            if ($value == 'chats') {
                $chats = $this->ci->$model_name->getActive();
                if (!$chats) {
                    continue;
                }
            }

            if (method_exists($this->ci->$model_name, 'moduleCategoryAction')) {
                $return[$value] = $this->ci->$model_name->moduleCategoryAction();
                $return[$value]['selected'] = ($select == $value) ? 1 : 0;
            }
        }

        return $return;
    }

    /**
     *  Load modules
     *
     *  @return array
     */
    private function getModules(): array
    {
        $result = [];
        $modules = $this->ci->pg_module->get_modules();
        foreach ($modules as $module) {
            if (in_array($module['category'], $this->modules_category)) {
                if (!in_array($module['module_gid'], $this->_not_include_modules)) {
                    $result[] = $module['module_gid'];
                }
            }
        }

        return $result;
    }

    /**
     *  Description action
     *
     *  @param string $setting_gid
     *
     *  @return array
     */
    private function getMessageFields($setting_gid)
    {
        foreach ($this->ci->pg_language->languages as $lid => $lang) {
            $r = $this->ci->pg_language->ds->get_reference('like_me', $this->ds_gid, $lid);
            $lang_data[$lid] = $r["option"][$setting_gid];
        }

        return $lang_data;
    }

    /**
     *  Liked profile ids
     *
     *  @param integer $user_id
     *
     *  @return array
     */
    public function getLikedProfileIds($user_id = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $this->ci->db->where_not_in("id_profile", $blocked_ids);
            }
        }

        $return = [];
        $this->ci->db->select('id_profile');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_user', $user_id);
        $results = $this->ci->db->get()->result_array();
        foreach ($results as $row) {
            $return[] = $row['id_profile'];
        }

        return $return;
    }

    /**
     *  Get liked
     *
     *  @param array $data
     *
     *  @return integer
     */
    public function getLikedCheck($data = [])
    {
        $this->ci->db->select('id');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_profile', $data['id_user']);
        $this->ci->db->where('id_user', $data['id_profile']);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return 1;
        }

        return 0;
    }

    /**
     *  Count matches list
     *
     *  @param integer $user_id
     *
     *  @return integer
     */
    public function getCountMatchesList($user_id = null)
    {
        $this->ci->db->select('COUNT(id_profile) AS cnt');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_user', $user_id);
        $this->ci->db->where('status_match', 1);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    /**
     *  Count profiles list
     *
     *  @param integer $profile_id
     *
     *  @return integer
     */
    public function getCountProfilesList($profile_id = null)
    {
        $this->ci->db->select('COUNT(id) AS cnt');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_profile', $profile_id);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    /**
     *  Count profiles list
     *
     *  @param integer $id_user
     *
     *  @return integer
     */
    public function getCountProfilesListByUserId($id_user = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($id_user)) {
                $this->ci->db->where_not_in("id_profile", $blocked_ids);
            }
        }

        $this->ci->db->select('COUNT(id) AS cnt');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_user', $id_user);

        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    /**
     *  Count profiles list
     *
     *  @param integer $id_user
     *
     *  @return integer
     */
    public function getCountUsersListByProfileId($id_user = null)
    {
        $this->ci->db->select('COUNT(id) AS cnt');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_profile', $id_user);
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            return intval($results[0]["cnt"]);
        }

        return 0;
    }

    /**
     *  Profile ids
     *
     *  @param integer $user_id
     *
     *  @return array
     */
    private function getProfileIds($user_id = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $this->ci->db->where_not_in("id_profile", $blocked_ids);
            }
        }

        $this->ci->db->select('id_profile');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_user', $user_id);
        $this->ci->db->where('status_match', 1);
        $results = $this->ci->db->get()->result_array();
        $return = [];
        foreach ($results as $row) {
            $return[] = $row['id_profile'];
        }

        return $return;
    }

    /**
     *  Matches list
     *
     *  @param integer $page
     *  @param integer $items_on_page
     *  @param integer $user_id
     *
     *  @return array
     */
    public function getMatchesList($page = 1, $items_on_page = null, $user_id = null)
    {
        $return = [];
        $data = $this->getProfileIds($user_id);
        if (!empty($data)) {
            $return = $this->getUsersInternal($page, $items_on_page, $data);
        }

        return $return;
    }

    /**
     *  Like list
     *
     *  @param integer $page
     *  @param integer $items_on_page
     *  @param integer $user_id
     *
     *  @return array
     */
    public function getLikeList($page = 1, $items_on_page = null, $user_id = null)
    {
        $return = [];
        $data = $this->getLikeProfileIds($page, $items_on_page, $user_id);
        if (!empty($data)) {
            $return = $this->getUsersInternal(null, null, $data);
        }

        return $return;
    }

    /**
     *  Like me list
     *
     *  @param integer $page
     *  @param integer $items_on_page
     *  @param integer $user_id
     *
     *  @return array
     */
    public function getLikeMeList($page = 1, $items_on_page = null, $user_id = null)
    {
        $return = [];
        $data = $this->getLikeMeProfileIds($user_id);
        if (!empty($data)) {
            $return = $this->getUsersInternal($page, $items_on_page, $data);
        }

        return $return;
    }

    /**
     *  Profile ids
     *
     *  @param integer $user_id
     *
     *  @return array
     */
    private function getLikeProfileIds($page = 1, $items_on_page = null, $user_id = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $this->ci->db->where_not_in("id_profile", $blocked_ids);
            }
        }

        $this->ci->db->select('id_profile');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_user', $user_id);
        $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        $results = $this->ci->db->get()->result_array();
        $return = [];
        foreach ($results as $row) {
            $return[] = $row['id_profile'];
        }

        return $return;
    }

    /**
     *  Profile ids
     *
     *  @param integer $user_id
     *
     *  @return array
     */
    private function getLikeMeProfileIds($user_id = null)
    {
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $this->ci->db->where_not_in("id_user", $blocked_ids);
            }
        }

        $this->ci->db->select('id_user');
        $this->ci->db->from(TABLE_LIKE_ME);
        $this->ci->db->where('id_profile', $user_id);
        $results = $this->ci->db->get()->result_array();
        $return = [];
        foreach ($results as $row) {
            $return[] = $row['id_user'];
        }

        return $return;
    }

    /**
     *  Users list
     *
     *  @param integer $page
     *  @param integer $items_on_page
     *  @param array $data
     *
     *  @return array
     */
    private function getUsersInternal($page = 1, $items_on_page = null, $data = [])
    {
        return $this->ci->Users_model->getUsersListByKey($page, $items_on_page, ['date_created' => 'DESC'], [], $data);
    }

    /**
     *  Format settings
     *
     *  @param array $data
     *
     *  @return array
     */
    private function formatSettings($data = [])
    {
        $data['play_more'] = unserialize($data['play_more']);
        $data['chat_message'] = $this->getMessageFields($data['chat_message']);
        $data['chat_more'] = $this->getActionModules($data['chat_more']);

        return $data;
    }

    /**
     *  Validate settings
     *
     *  @param array $data
     *
     *  @return array
     */
    public function validateSettings($data)
    {
        $return = ["errors" => [], "data" => []];
        if (isset($data['matches_per_page'])) {
            $return["data"]["matches_per_page"] = intval($data["matches_per_page"]);
            if ($return["data"]["matches_per_page"] <= 0) {
                $return["errors"][] = l("error_matches_per_page_incorrect", "like_me");
            }
        }
        if (isset($data['play_local_used'])) {
            $return["data"]["play_local_used"] = intval($data["play_local_used"]);
            if (!empty($data['play_local_area'])) {
                $return["data"]["play_local_area"] = trim(strip_tags($data["play_local_area"]));
                if (empty($return["data"]["play_local_area"])) {
                    $return["errors"][] = l("error_play_local_area_incorrect", "like_me");
                }
            } else {
                $return["data"]["play_local_used"] = '';
                $return["data"]["play_local_area"] = '';
            }
        }
        if (isset($data['play_more'])) {
            $return["data"]["play_more"] = serialize($data["play_more"]);
        }

        if (isset($data['chat_message'])) {
            foreach ($this->ci->pg_language->languages as $key => $value) {
                if (!empty($data['chat_message'][$value['id']])) {
                    $return['ds'][$value['id']] = strip_tags($data['chat_message'][$value['id']]);
                }
            }
        }

        if (isset($data['chat_more'])) {
            $return["data"]["chat_more"] = trim(strip_tags($data["chat_more"]));
        }

        return $return;
    }

    /**
     *  Validate Action
     *
     *  @param array $data
     *
     *  @return array
     */
    public function validatePlayAction($data = [])
    {
        $return = ['data' => []];
        if (isset($data['action']) && $data['action'] != 'skip') {
            if (isset($data['profile_id'])) {
                if (empty($data["profile_id"])) {
                    $return["errors"][] = l("error_profile_id_incorrect", "like_me");
                } else {
                    $return["data"]["id_user"] = $this->ci->session->userdata('user_id');
                    $return["data"]["id_profile"] = $data["profile_id"];
                    $return["data"]["status_match"] = ($data['action'] == 'unlike') ? 0 : $this->getLikedCheck($return["data"]);
                }
            }
        }

        return $return;
    }

    /**
     *  Save Action
     *
     *  @param array $attrs
     *
     *  @return integer
     */
    public function savePlayAction(array $attrs = [])
    {
        $is_liked = (!empty($attrs['id_user']) && !empty($attrs['id_profile'])) ? $this->getLikedCheck(['id_profile' => $attrs['id_user'], 'id_user' => $attrs['id_profile']]) : 0;
        if ($is_liked) {
            $this->removeILikes($attrs['id_user'], $attrs['id_profile']);
        } else {
            if (!empty($attrs)) {
                if (empty($this->ci->session->userdata('is_liked'))) {
                    $this->ci->session->set_userdata(['is_liked' => 1]);
                    $this->ci->load->library('Analytics');
                    $event = $this->ci->analytics->getEvent('like_me', 'engaged', 'user');
                    $this->ci->analytics->track($event);
                }

                $attrs["date_created"] = date(self::DB_DATE_FORMAT);
                $this->ci->db->insert(TABLE_LIKE_ME, $attrs);

                return $this->ci->db->insert_id();
            }
        }

        return false;
    }

    /**
     *  Change status
     *
     *  @param array $params
     *
     *  @return void
     */
    public function changeStatus($params = [])
    {
        $this->ci->db->where('id_user', $params['id_profile']);
        $this->ci->db->where('id_profile', $params['id_user']);
        $this->ci->db->update(TABLE_LIKE_ME, ['status_match' => 1]);
    }

    /**
     *  Remove matches
     *
     *  @param integer $user_id
     *  @param integer $profile_id
     *
     *  @return void
     */
    public function removeMatches($user_id, $profile_id)
    {
        $this->removeILikes($user_id, $profile_id);
        $this->removeHeLikes($profile_id, $user_id);
    }

    /**
     *  Remove likes
     *
     *  @param integer $user_id
     *  @param integer $profile_id
     *
     *  @return void
     */
    private function removeILikes($user_id, $profile_id)
    {
        $this->ci->db->where('id_user', $user_id);
        $this->ci->db->where('id_profile', $profile_id);
        $this->ci->db->delete(TABLE_LIKE_ME);
    }

    /**
     *  Remove likes
     *
     *  @param integer $profile_id
     *  @param integer $user_id
     *
     *  @return void
     */
    private function removeHeLikes($profile_id, $user_id)
    {
        $this->ci->db->where('id_user', $profile_id);
        $this->ci->db->where('id_profile', $user_id);
        $this->ci->db->delete(TABLE_LIKE_ME);
    }

    /**
     *  Save message
     *
     *  @param array $lang_data
     *
     *  @return array
     */
    public function setMessageFields($lang_data)
    {
        foreach ($lang_data as $lid => $string) {
            if (empty($string)) {
                $is_err = true;

                continue;
            } elseif (!array_key_exists($lid, $this->ci->pg_language->languages)) {
                continue;
            }
        }
        if (!$is_err) {
            foreach ($lang_data as $lid => $string) {
                $option = $this->ci->pg_language->ds->get_reference('like_me', $this->ds_gid, $lid);
                $option["option"]["text"] = $string;
                $this->ci->pg_language->ds->set_module_reference('like_me', $this->ds_gid, $option, $lid);
            }
        }

        return $lang_data;
    }

    /**
     *  Save settings
     *
     *  @param array $data
     *
     *  @return void
     */
    public function setSettings($data)
    {
        foreach ($data as $setting => $value) {
            $this->ci->pg_module->set_module_config('like_me', $setting, $value);
        }
    }

    /**
     *  Seo settings
     *
     *  @param string $method
     *  @param integer $lang_id
     *
     *  @return void
     */
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
        switch ($method) {
            case 'index':
                return [
                    "templates" => [],
                    "url_vars"  => [],
                ];

                break;
        }
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        if ($var_name_from == $var_name_to) {
            return $value;
        }

        return $value;
    }

    public function getSitemapXmlUrls()
    {
        $this->ci->load->helper('seo');
        $return = [];

        return $return;
    }

    public function getSitemapUrls()
    {
        $this->ci->load->helper('seo');
        $auth = $this->ci->session->userdata("auth_type");
        $block = [];

        $block[] = [
            "name"      => l('header_main_sections', 'like_me'),
            "link"      => rewrite_link('like_me', 'index'),
            "clickable" => ($auth == "user"),
            "items"     => [
                [
                    "name"      => l('cart', 'like_me'),
                    "link"      => rewrite_link('like_me', 'cart'),
                    "clickable" => ($auth == "user"),
                ],
            ],
        ];

        return $block;
    }

    public function bannerAvailablePages()
    {
        $return[] = ["link" => "like_me/product", "name" => l('header_main', 'like_me')];

        return $return;
    }

    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();

        $fields_n['name_' . $lang_id] = ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false];
        $this->ci->dbforge->add_column(TABLE_LIKE_ME, $fields_n);

        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_' . $lang_id, 'name_' . $default_lang_id, false);
            $this->ci->db->update(TABLE_LIKE_ME);
        }
        $fields_d['description_' . $lang_id] = ['type' => 'TEXT', 'null' => false];
        $this->ci->dbforge->add_column(TABLE_LIKE_ME, $fields_d);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('description_' . $lang_id, 'description_' . $default_lang_id, false);
            $this->ci->db->update(TABLE_LIKE_ME);
        }
    }

    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $fields_exists = $this->ci->db->list_fields(TABLE_LIKE_ME);

        $fields = ['name_' . $lang_id, 'description_' . $lang_id];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(TABLE_LIKE_ME, $field_name);
        }
    }

    public function getLikedUsers()
    {
        $max_liked_in_session = $this->ci->pg_module->get_module_config('like_me', 'max_liked_in_session');

        $liked_users = $this->ci->session->userdata('like_me_selected');
        if (!is_array($liked_users)) {
            $liked_users = $this->getLikedProfileIds($this->ci->session->userdata('user_id'));
            if (count($liked_users) <= $max_liked_in_session) {
                $this->ci->session->set_userdata(['like_me_selected' => $liked_users]);
            } else {
                $this->ci->session->set_userdata(['like_me_selected' => null]);
            }
        }

        return $liked_users;
    }

    public function getSearchCriteria($from_id = 0, $is_reload = false)
    {
        $search_criteria = new SearchCriteria();
        $search_criteria->exсludeCurrentUser();

        if ($this->play_location == self::PLAY_LOCATION_LOCAL) {
            $this->ci->load->model('users/models/Users_utils_model');
            $current_user_data = $this->ci->Users_utils_model->getCurrentUserData();
            $search_criteria->equal('id_country', $current_user_data['id_country']);
            $search_criteria->equal('id_region', $current_user_data['id_region']);
        }

        if (!$is_reload) {
            if ($from_id > 0) {
                $search_criteria->lessThan('id', $from_id);
            }
            $search_criteria->excludeUsers($this->getLikedUsers());
        } elseif ($is_reload) {
            $this->removeAllLikes();
        }

        return $search_criteria->getCriteria();
    }

    public function getUsers($last_liked_user_id = 0, $reload = false)
    {
        $criteria = $this->getSearchCriteria($last_liked_user_id, $reload);
        $this->ci->load->model('Users_model');

        return $this->ci->Users_model->getUsersList(1, self::USERS_PER_PAGE, ['id' => 'DESC'], $criteria);
    }

    public function formatUsers($users)
    {
        $ids = $this->getLikedProfileIds($this->ci->session->userdata('user_id'));
        foreach ($users as &$user) {
            if (in_array($user['id'], $ids) === true) {
                $user['is_liked'] = 1;
            }
        }

        return $users;
    }

    private function removeAllLikes()
    {
        $user_id = intval($this->ci->session->userdata("user_id"));
        $this->ci->session->set_userdata(['like_me_selected' => null]);

        $this->ci->db->where('id_user', $user_id);
        $this->ci->db->delete(TABLE_LIKE_ME);

        $this->ci->db->set('status_match', 0);
        $this->ci->db->where('id_profile', $user_id);
        $this->ci->db->update(TABLE_LIKE_ME);
    }

    public function setPlayLocation($play_location)
    {
        if (in_array($play_location, $this->play_locations)) {
            $this->play_location = $play_location;
        } else {
            $this->play_location = self::PLAY_LOCATION_GLOBAL;
        }
    }

    /**
     *  Verifying access to the page
     *
     *  @return boolean
     */
    public function isAccess()
    {
        if (($_ENV['DEMO_MODE'] || TRIAL_MODE) && $this->ci->uri->segment(3) == 'demo_guide') {
            return true;
        }
        $this->ci->load->model('Users_model');
        $user = $this->ci->Users_model->getUserById($this->session->userdata('user_id'), true);
        if (empty($user['user_logo'])) {
            return false;
        }

        return true;
    }

    /**
     * Send message
     *
     * @param array $data
     *
     * @return void
     */
    public function sendMessage($data = [], $on_site = false)
    {
        $this->ci->load->model(['Users_model', 'Chatbox_model', 'Notifications_model']);

        $user = $this->ci->Users_model->getUserById($this->session->userdata['user_id'], true);

        if ($this->ci->pg_module->is_module_installed('chatbox') && $on_site) {
            $message = null;

            if ($data) {
                $message = ' ' .  $user['output_name'] . ' ' . l('like_you_message', 'like_me');

                if ($data['status_match']) {
                    $text = str_replace('%user%', $user['output_name'], l('congratulations_message', 'like_me'));
                    $message .= "\n\n" . ' ' .  $text;
                }

                $this->ci->Chatbox_model->addMessage($data['id_profile'], $data['id_profile'], $message, true, true);
            }
        }

        if ($data['status_match'] && !$on_site) {
            $profile = $this->ci->Users_model->getUserById($data['id_profile'], true);

            $alert = [
                "user_nickname" => UsersModel::formatUserName($user),
                "profile_nickname" => UsersModel::formatUserName($profile),
                'link_1' => $user['link'],
                'image' => $user['media']['user_logo']['thumbs']['middle']
            ];

            $this->ci->Notifications_model->sendNotification($profile['email'], 'like_me_overlap', $alert, '', $profile['lang_id']);
        }
    }

    /**
     * Querying
     *
     * @param array $data
     *
     * @return array
     */
    public function getParams($data = [], $profile_ids = [])
    {
        $user_id = $this->ci->session->userdata('user_id');

        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            $this->ci->load->model('Perfect_match_model');
            $search_data = $this->ci->Perfect_match_model->getUserParams($user_id);
        } else {
            $search_data['full_criteria'] = [];
        }

        $this->ci->load->model('Users_model');
        $params = $this->ci->Users_model->getCommonCriteria($search_data['full_criteria']);

        if (!empty($data['profile_id'])) {
            $liked = $this->ci->session->userdata('like_me_selected');
            if (!is_array($liked)) {
                $liked = [];
            }
            $liked = array_unique(array_merge($liked, $profile_ids));
            if (!empty($liked)) {
                $params['where_sql'][] = "id NOT IN (" . implode(', ', $liked) . ")";
            }
            $params['where']['id >'] = intval($data['profile_id']);
            $params['where']['id !='] = intval($user_id);
        } else {
            $selected = [$user_id];
            $liked = $this->getLikedProfileIds($user_id);
            $liked = array_merge($liked, $profile_ids);
            if (!empty($liked)) {
                $selected = array_unique(array_merge($liked, $selected));
            }
            $this->ci->session->set_userdata(['like_me_selected' => $selected]);
            if (($key = array_search($data['exclude_user_id'], $selected)) !== false) {
                unset($selected[$key]);
            }
            $params['where_sql'][] = "id NOT IN (" . implode(', ', $selected) . ")";
        }

        return $params;
    }
}
