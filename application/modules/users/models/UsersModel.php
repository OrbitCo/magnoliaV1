<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\Libraries\Analytics;
use Pg\Libraries\EventDispatcher;
use Pg\modules\couples\models\CouplesModel;
use Pg\modules\network\models\NetworkUsersModel;
use Pg\modules\users\models\events\EventUsers;
use Pg\Libraries\Cache\Manager as CacheManager;
use SMTPValidateEmail\Validator as SmtpEmailValidator;

if (!defined('USERS_TABLE')) {
    define('USERS_TABLE', DB_PREFIX . 'users');
}
if (!defined('USERS_SITE_VISIT_TABLE')) {
    define('USERS_SITE_VISIT_TABLE', DB_PREFIX . 'users_site_visit');
}


/**
 * Users main model.
 *
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class UsersModel extends \Model
{
    const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    const DB_DATE_SIMPLE_FORMAT = 'Y-m-d';

    const DB_DATE_FORMAT_SEARCH = 'Y-m-d H:i';

    const DB_DEFAULT_DATE = '0000-00-00 00:00:00';

    const HIDDEN_DATE_FORMAT = '%Y-%m-%d';

    const GROUPS = 'all';

    const FEATURED_SERVICE = 'users_featured';

    /**
     * Available user types.
     *
     * @var array
     */
    protected $user_types = [];

    protected $user_types_groups = [
        'types' => [],
        'groups' => [
            self::GROUPS => [],
        ],
    ];

    public $processed_statuses = [
        self::STATUS_NOT_ACTIVITY,
        self::STATUS_NOT_APPROVED,
        self::STATUS_NOT_CONFIRMED,
    ];

    const MODULE_GID = 'users';

    const EVENT_USER_CHANGED = 'users_changed';

    const STATUS_ADDED = 'user_added';

    const STATUS_SAVED = 'user_saved';

    const STATUS_DELETED = 'user_deleted';

    const STATUS_APPROVED = 'user_approved';

    const STATUS_ADMIN_APPROVED = 'user_admin_approved';

    const STATUS_NOT_CONFIRMED = 'user_not_confirmed';

    const STATUS_NOT_APPROVED = 'user_not_approved';

    const STATUS_ADMIN_DECLINED = 'user_admin_declined';

    const STATUS_NOT_ACTIVITY = 'user_not_activity';

    const TYPE_USER = 'user';

    const ORIGINAL_IMG_PATH = 'original/';

    const BLUR_POWER = 50;

    const METERS_IN_KM = 1000;

    const METERS_IN_MILE = 1609.344;

    const KM_IN_RAD = 111.3;

    const MILES_IN_RAD = 69.1;

    const KM_TO_MILE_RATIO = 0.621371192;

    const DEFAULT_CIRCLE_RADIUS = 20;

    public $dashboard_events = [
        self::EVENT_USER_CHANGED,
    ];

    public $is_dashboard = true;

    public $is_load_form = false;

    public $fields = [
        'account', // payment group
        'activated_end_date', // service group
        'activity', // status group
        'address', // location full
        'age', // base group
        'approved', // status group
        'birth_date', // base field
        'is_terms',
        'confirm', // status group
        'date_created',
        'date_last_activity',
        'date_modified',
        'email', // contacts group
        'featured_end_date', // service group
        'fname', // base group
        'group_id', // membership group
        'hide_on_site_end_date', // service group
        'highlight_in_search_end_date', // service group
        'id', // base group
        'id_country', // location group
        'id_region', // location group
        'id_city', // location group
        'id_seo_settings', // служебные
        'lang_id', // base group
        'leader_bid',
        'leader_text',
        'leader_write_date',
        'logo_comments_count',
        'nickname', // base group
        'online_status', // status group
        'password',
        'phone', // contacts
        'profile_completion', // служебные
        'postal_code', // location full
        'search_field',
        'show_adult', // служебные
        'site_status', // status
        'sname', // basse
        'user_logo', // media
        'user_logo_moderation', // служебные
        'user_logo_postmoderation', // служебные
        'user_logo_declined', // служебные
        'user_logo_mime', // служебные
        'user_open_id',
        'user_type', // base
        'up_in_search_end_date', // services
        'views_count', // base
        'lat', //location
        'lon', // location
        'roles', // membership,
        'last_ip_addr',
        'checked_email', // email validator
        'last_checked_email_date', // email validator
        'valid_email', // email validator
        'changed_email', // email validator
        'confirm_code_new_email', // email validator
    ];

    public $fields_all = [];

    public $safe_fields = [
        'age',
        'city',
        'country',
        'date_last_activity',
        'id',
        'id_country',
        'id_region',
        'id_city',
        'is_activated',
        'is_featured',
        'is_hide_on_site',
        'is_highlight_in_search',
        'is_up_in_search',
        'lang_id',
        'link',
        'location',
        'logo_comments_count',
        'media',
        'nickname',
        'online_status',
        'output_name',
        'region',
        'region-code',
        'site_status',
        'statuses',
        'user_logo',
        'user_type',
        'user_type_str',
        'views_count',
        'approved',
        'location',
        'country',
        'region',
        'city',
    ];

    public $fields_register = [
        'birth_date',
        'email',
        'nickname',
        'password',
        'user_type',
    ];

    public $fields_not_editable = [
        'user_type',
    ];

    public $fields_for_activation = [
        'birth_date',
        'id_region',
        'id_country',
        'nickname',
        'user_logo',
        'user_type',
    ];

    public $fields_completion = [
        'email',
        'nickname',
        'user_type',
        'fname',
        'sname',
        'user_logo',
        'id_country',
        'id_region',
        'id_city',
        'birth_date',
    ];

    public $services_buy_gids = [
        'user_activate_in_search',
        'users_featured',
        'admin_approve',
        'hide_on_site',
        'highlight_in_search',
        'up_in_search',
        'ability_delete',
    ];

    public $profile_before;

    public $profile_after;

    /**
     * Ratings data properties.
     *
     * @var array
     */
    //TODO (nsavanaev) вынести в модуль rating
    protected $fields_ratings = [
        'rating_count',
        'rating_sorter',
        'rating_value',
        'rating_type',
    ];

    /**
     * Settings data.
     *
     * @var array
     */
    public static $fields_settings = [
        'email', 'adult', 'notifications', 'subscriptions',
    ];

    public $upload_config_id = 'user-logo';

    public $moderation_type = ['user_logo', 'user_data'];

    public $form_editor_type = self::MODULE_GID;

    public $advanced_search_form_gid = 'advanced_search';

    protected $dop_fields = [];

    protected $demo_user = [
        'email' => 'basil@mail.com',
        'nickname' => 'Basil',
        'password' => '123456',
        'birth_date' => '1989-08-30',
        'region_name' => 'United Kingdom, London',
        'id_country' => 'GB',
        'id_region' => '4',
        'id_city' => '4',
        'user_type' => 'male',
    ];

    /**
     *  Is module (couples) installed.
     *
     * @var bool
     */
    public $is_couples_installed = false;

    /**
     * Blacklist.
     *
     * @var array
     */
    protected $blacklist = [];

    /**
     * UsersModel constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // TODO: cache
        $this->ci->cache->registerService('users');
        if ($this->ci->pg_module->is_module_installed('couples')) {
            $this->is_couples_installed = true;
            $this->fields = CouplesModel::addFields(USERS_TABLE, $this->fields);
        }
        if ($this->ci->pg_module->is_module_installed('network')) {
            $this->fields = NetworkUsersModel::getUsersFields($this->fields);
        }
        if ($this->ci->pg_module->is_module_installed('ratings')) {
            $this->fields = array_merge($this->fields, $this->fields_ratings);
        }
        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            $this->fields[] = 'looking_user_type';
            $this->fields[] = 'age_min';
            $this->fields[] = 'age_max';
            $this->demo_user['looking_user_type'] = 'female';
            $this->fields_for_activation[] = 'looking_user_type';
            $this->fields_register[] = 'looking_user_type';
            $this->safe_fields[] = 'looking_user_type';
            $this->safe_fields[] = 'looking_user_type_str';
        }
        $this->fields_all = $this->fields;
    }

    /**
     * Get user types.
     *
     * @return array
     */
    public function getUserTypes($group = null)
    {
        $this->ci->load->model('users/models/Users_types_model');
        // TODO: cache
        // TODO: remove one property
        $this->user_types = array_column(
            $this->ci->Users_types_model->getTypes(),
            'name'
        );
        $this->user_types_groups['types'] = $this->user_types;
        if ($group) {
            return $this->user_types_groups['groups'][$group];
        }

        return $this->user_types_groups['types'];
    }

    public function getUserTypesGroups($params = [], $langs_ids = null)
    {
        $this->user_types_groups['types'] = $this->user_types;
        $this->ci->load->model('users/models/Groups_model');

        $groups = $this->ci->Groups_model->getGroupsList($params, $langs_ids);

        foreach ($groups as $group) {
            $this->user_types_groups['groups'][self::GROUPS][$group['gid']] = $group;
        }

        return $this->user_types_groups['groups'];
    }

    /**
     * Return available user types with names.
     *
     * @return array
     */
    public function getUserTypesNames()
    {
        $user_types = [];
        foreach ($this->getUserTypes() as $user_type) {
            $user_types[$user_type] = l($user_type, 'users');
        }

        return $user_types;
    }

    public function setAdditionalFields($fields)
    {
        $this->dop_fields = $fields;
        $this->fields_all = (!empty($this->dop_fields)) ? array_merge(
            $this->fields,
            $this->dop_fields
        ) : $this->fields;
    }

    public function getUserById($user_id, $formatted = false, $safe_format = false)
    {
        $fields = $this->fields_all;

        // TODO: cache
        $result = $this->ci->cache->get('users', $user_id, function () use ($fields, $user_id) {
            $ci = &get_instance();

            $result = $ci->db->select(implode(', ', $fields))
                ->from(USERS_TABLE)
                ->where('id', $user_id)
                ->get()->result_array();

            if (empty($result)) {
                return;
            }

            return $result[0];
        });

        if ($result === null) {
            return false;
        }

        if ($formatted) {
            $result = $this->formatUser($result, $safe_format);
        } else {
            $this->setUserOutputName($result);
        }

        return $result;
    }

    protected function getUser(array $data)
    {
        $this->ci->db->select(implode(', ', $this->fields_all))
            ->from(USERS_TABLE);
        foreach ($data as $field => $value) {
            $this->ci->db->where($field, $value);
        }
        $result = $this->ci->db
            ->order_by('id')
            ->limit(1)
            ->get()->result_array();
        if (empty($result)) {
            return false;
        }

        return $result[0];
    }

    public function getUserByLoginPassword($login, $password)
    {
        $user = $this->getUser(['nickname' => $login]);
        if (empty($user) || password_verify($password, $user['password']) === false) {
            return false;
        }

        return $user;
    }

    public function getUserByLogin($login)
    {
        return $this->getUser(['nickname' => $login]);
    }

    public function getUserByEmailPassword($email, $password)
    {
        $user = $this->getUser(['email' => $email]);
        if (empty($user) || password_verify($password, $user['password']) === false) {
            return false;
        }

        return $user;
    }

    public function getUserByEmail($email)
    {
        return $this->getUser(['email' => $email]);
    }

    public function getUserByConfirmCode($code)
    {
        return $this->getUser(['confirm_code' => $code]);
    }

    public function getUserByOpenId($open_id)
    {
        return $this->getUser(['user_open_id' => $open_id]);
    }

    public function getAllUsersId()
    {
        $result = $this->ci->db
            ->select('id')
            ->from(USERS_TABLE)
            ->get()->result_array();
        $return = [];
        foreach ($result as $row) {
            $return[] = $row['id'];
        }

        return $return;
    }

    public function getUsersList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = [], $formatted = true, $safe_format = false, $lang_id = '')
    {
        if (isset($params['fields'])) {
            $this->setAdditionalFields($params['fields']);
            unset($params['fields']);
        }

        $controller = $this->ci->router->fetch_class(true);

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');

            $is_check_from_another = false;

            if (in_array($controller, ['like_me', 'users'])) {
                $is_check_from_another = true;
            }

            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id, $is_check_from_another)) {
                $this->ci->db->where_not_in('id', $blocked_ids);
            }
        }

        $fields = $this->fields_all;
        $get_data_callback = function ($resort_by_keys = false) use ($fields, $params, $page, $items_on_page, $filter_object_ids, $order_by) {
            $ci = &get_instance();

            $ci->db->select(implode(', ', $fields))
                ->from(USERS_TABLE);

            if (isset($params['where'])) {
                foreach ($params['where'] as $field => $value) {
                    $ci->db->where($field, $value);
                }
            }

            if (isset($params['like'])) {
                foreach ($params['like'] as $field => $value) {
                    $ci->db->like($field, $value);
                }
            }

            if (isset($params['where_in'])) {
                foreach ($params['where_in'] as $field => $value) {
                    $ci->db->where_in($field, $value);
                }
            }

            if (isset($params['where_not_in'])) {
                foreach ($params['where_not_in'] as $field => $value) {
                    $ci->db->where_not_in($field, $value);
                }
            }

            if (isset($params['where_sql'])) {
                foreach ($params['where_sql'] as $value) {
                    $ci->db->where($value, null, false);
                }
            }

            if (!empty($filter_object_ids)) {
                $ci->db->where_in('id', $filter_object_ids);
            }

            if (is_array($order_by)) {
                foreach ($order_by as $field => $dir) {
                    if (in_array($field, $fields) || $field == 'fields') {
                        $ci->db->order_by($field . ' ' . $dir);
                    }
                }
            }

            if (!is_null($page)) {
                $page = $page ?: 1;
                $ci->db->limit($items_on_page, $items_on_page * ($page - 1));
            }

            $results_raw = $ci->db->get()->result_array();

            if (empty($results_raw) || !is_array($results_raw)) {
                return [];
            }

            if ($resort_by_keys) {
                $results = [];

                foreach ($results_raw as $result_raw) {
                    $results[$result_raw['id']] = $result_raw;
                }
            } else {
                $results = $results_raw;
            }

            return $results;
        };

        if (!empty($filter_object_ids) && empty($params) && empty($order_by)) {
            // TODO: cache
            $results = $this->ci->cache->mget('users', $filter_object_ids, $get_data_callback);
        } else {
            $results = $get_data_callback($filter_object_ids);
        }

        if ($formatted) {
            $results = $this->formatUsers($results, $safe_format);
        } else {
            $this->setUserOutputName($data);
        }

        return $results;
    }

    public function getUsersListByKey($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = [], $formatted = true, $safe_format
    = false)
    {
        $list = $this->getUsersList($page, $items_on_page, $order_by, $params, $filter_object_ids, $formatted, $safe_format);
        $ids = !empty($filter_object_ids) ? $filter_object_ids : (!empty($params['where_in']['id']) ? $params['where_in']['id'] : []);
        if (!empty($ids)) {
            $this->ci->load->model('users/models/Users_deleted_model');
            foreach ($list as $l) {
                $data[$l['id']] = $l;
            }
            foreach ($ids as $id) {
                if (!isset($data[$id])) {
                    $data[$id] = array_merge(
                        $this->formatDefaultUser($id),
                        $this->ci->Users_deleted_model->getUserByUserId($id, true)
                    );
                } elseif (empty($data[$id]['approved']) && $this->ci->session->userdata('auth_type') !== 'admin') {
                    $data[$id] = $this->formatDefaultUser($id, '', '', 'blocked');
                }
            }

            return $data;
        }
        if (!empty($list)) {
            foreach ($list as $l) {
                $data[$l['id']] = $l;
            }

            return $data;
        }
    }

    public function getFeaturedUsers($count = 20, $user_type = 0)
    {
        if ($this->ci->pg_module->is_module_installed('services')) {
            if ($this->ci->session->userdata('auth_type') == 'user') {
                $user_id = $this->ci->session->userdata('user_id');
                $this->ci->load->model('Blacklist_model');
                $blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id);
            }

            $this->ci->load->model('services/models/Services_users_model');
            $ids = $this->ci->Services_users_model->getUsersIdsByServiceGid('users_featured');
            $this->ci->db
                ->select(implode(', ', $this->fields))
                ->from(USERS_TABLE)
                ->where('approved', '1')
                ->where('user_logo !=', '')
                ->where(" featured_end_date != '" . self::DB_DEFAULT_DATE .
                    "' AND featured_end_date >= '" . date(self::DB_DATE_FORMAT) . "'", null, false);
            if (!empty($user_type)) {
                $this->ci->db->where('user_type', $user_type);
            }

            if (!empty($blocked_ids)) {
                $this->ci->db->where_not_in('id', $blocked_ids);
            }

            if (!empty($ids)) {
                $this->ci->db->where_in('id', $ids);
                //TODO ???
                $this->ci->db->order_by("FIND_IN_SET(id, '" . implode(',', $ids) . "')");
            }

            $result = $this->ci->db
                ->limit($count, 0)
                ->get()->result_array();

            return $this->formatUsers($result);
        }

        return [];
    }

    public function getActiveUsers($count = 20, $user_type = 0, $params = [])
    {
        $params['where']['confirm'] = '1';
        $params['where']['approved'] = '1';
        $params['where']['activity'] = '1';

        if ($user_type) {
            $params['where']['user_type'] = $user_type;
        }

        $order_by['date_last_activity'] = 'DESC';

        if (!empty($params['order_by'])) {
            $order_by = [$params['order_by']['field'] => $params['order_by']['direction']];
        }

        if ($this->is_couples_installed === true) {
            $params['where']['is_coupled !='] = 1;
        }

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $params['where_not_in']['id'] = $blocked_ids;
            }
        }

        return $this->getUsersList(1, $count, $order_by, $params);
    }

    public function getNewUsers($count = 20, $user_type = 0)
    {
        $params = [
            'where' => [
                'confirm' => '1',
                'approved' => '1',
                'activity' => '1',
            ],
        ];

        if ($this->is_couples_installed === true) {
            $params['where']['is_coupled !='] = 1;
        }

        if ($user_type) {
            $params['where']['user_type'] = $user_type;
        }

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $params['where_not_in']['id'] = $blocked_ids;
            }
        }

        return $this->getUsersList(1, $count, ['date_created' => 'DESC'], $params, [], true);
    }

    public function getUsersCount($params = [], $filter_object_ids = null)
    {
        if (isset($params['where']) && is_array($params['where']) && count($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params['like']) && is_array($params['like']) && count($params['like'])) {
            foreach ($params['like'] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }

        if (isset($params['where_in']) && is_array($params['where_in']) && count($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (isset($params['where_sql']) && is_array($params['where_sql']) && count($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }
        $result = $this->ci->db->count_all_results(USERS_TABLE);

        return $result;
    }

    public function getActiveUsersList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null, $formatted = true)
    {
        $params['where']['approved'] = 1;
        $params['where']['confirm'] = 1;

        return $this->getUsersList($page, $items_on_page, $order_by, $params, $filter_object_ids, $formatted);
    }

    public function getActiveUsersCount($params = [], $filter_object_ids = null)
    {
        $params['where']['approved'] = 1;
        $params['where']['confirm'] = 1;

        return $this->getUsersCount($params, $filter_object_ids);
    }

    public function getActiveUsersTypesCount($params = [], $filter_object_ids = null)
    {
        $params['where']['approved'] = 1;
        $params['where']['confirm'] = 1;
        if (!empty($params['where']) && is_array($params['where'])) {
            $this->ci->db->where($params['where']);
        }
        if (!empty($params['like']) && is_array($params['like'])) {
            foreach ($params['like'] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }
        if (!empty($params['where_in']) && is_array($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (!empty($params['where_sql']) && is_array($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }
        if (!empty($filter_object_ids) && is_array($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }

        return $this->ci->db->select('user_type, COUNT(user_type) AS count')
            ->from(USERS_TABLE)
            ->group_by('user_type')
            ->get()->result_array();
    }

    public function updateUserStatus($user_id, $attrs)
    {
        $this->ci->db
            ->where('id_contact', $user_id)
            ->update(IM_CONTACT_LIST_TABLE, $attrs);

        return true;
    }

    public function simplyUpdateUser($user_id, $attrs)
    {
        $fe_settings = $this->ci->config->item('editor_type', 'field_editor');
        $fe_prefix = !empty($fe_settings['users']['field_prefix']) ? $fe_settings['users']['field_prefix'] : '';
        foreach ($this->fields_not_editable as $field_not_editable) {
            unset($attrs[$field_not_editable], $attrs[$fe_prefix . $field_not_editable]);
        }

        $this->ci->db
            ->where('id', $user_id)
            ->update(USERS_TABLE, $attrs);

        $result = $this->ci->db->affected_rows();

        // TODO: cache
        $this->ci->cache->delete('users', $user_id);

        return $result;
    }

    public function saveUser($user_id = null, $attrs = [], $file_name = '', $use_icon_moderation = true, $load_image = false)
    {
        $is_new_user = is_null($user_id);
        $referral_code = null;

        if (!$is_new_user && !$load_image) {
            $this->profile_before = $this->getUserById($user_id);
            if (!$this->profile_before) {
                // user not exists
                return false;
            }
        }

        if (!empty($attrs['birth_date'])) {
            $attrs['birth_date'] = date(
                self::DB_DATE_FORMAT,
                strtotime($attrs['birth_date'])
            );
        }

        if (!empty($attrs['code'])) {
            $attrs['confirm_code_new_email'] = $attrs['code'];
            unset($attrs['code']);
        }

        if ($is_new_user) {
            if (isset($attrs['roles'])) {
                $attrs['roles'] = $this->rolesEncode($attrs['roles']);
            }
            if (empty($attrs['date_created'])) {
                $attrs['date_created'] = $attrs['date_modified'] = date(self::DB_DATE_FORMAT);
            }
            if (isset($attrs['referral_code'])) {
                $referral_code = $attrs['referral_code'];
                unset($attrs['referral_code']);
            }
            if ($this->ci->pg_module->is_module_installed('network')) {
                $this->ci->load->model('network/models/Network_users_model');
                $attrs = $this->ci->Network_users_model->preCreate($attrs);
            }
            $this->ci->db
                ->insert(USERS_TABLE, $attrs);
            $user_id = $this->ci->db->insert_id();
        } else {
            $attrs['date_modified'] = date(self::DB_DATE_FORMAT);
            $fe_settings = $this->ci->config->item('editor_type', 'field_editor');
            $fe_prefix = !empty($fe_settings['users']['field_prefix']) ? $fe_settings['users']['field_prefix'] : '';
            foreach ($this->fields_not_editable as $field_not_editable) {
                unset($attrs[$field_not_editable], $attrs[$fe_prefix . $field_not_editable]);
            }
            if ($this->ci->pg_module->is_module_installed('network')) {
                $this->ci->load->model('network/models/Network_users_model');
                $this->ci->Network_users_model->userUpdated($user_id, $attrs);
            }
            if (!empty($attrs['confirm'])) {
                $this->ci->load->library('Analytics');
                $event = $this->ci->analytics->getEvent('registration', 'verified', 'user');
                $this->ci->analytics->track($event);
            }

            $this->ci->db
                ->where('id', $user_id)
                ->update(USERS_TABLE, $attrs);
        }

        $this->updateAge([$user_id]);

        if ($file_name && $user_id) {
            $this->ci->load->model(['Moderation_model', 'Uploads_model']);
            $mstatus = (int)$this->ci->Moderation_model->getModerationTypeStatus($this->moderation_type[0]);
            if (isset($_FILES[$file_name]['tmp_name']) && is_uploaded_file($_FILES[$file_name]['tmp_name'])) {
                if ($mstatus == 0 || $mstatus == 1) {
                    //premoderation / postmoderation
                    $img_return = $this->ci->Uploads_model->upload($this->upload_config_id, $user_id, $file_name, self::ORIGINAL_IMG_PATH);
                } else {
                    $img_return = $this->ci->Uploads_model->upload($this->upload_config_id, $user_id, $file_name);
                }
            } elseif (file_exists($file_name)) {
                $img_return = $this->ci->Uploads_model->uploadExist($this->upload_config_id, $user_id, $file_name);
            }

            if (empty($img_return['errors']) && !empty($img_return['file'])) {
                if (empty($is_new_user)) {
                    $this->ci->load->library('Analytics');
                    $event = $this->ci->analytics->getEvent('registration', 'profile_complete', 'user');
                    $this->ci->analytics->track($event);
                }

                $mtype = $this->ci->Moderation_model->getModerationType($this->moderation_type[0]);

                if ($mtype['mtype'] > 0 && $use_icon_moderation && $this->session->userdata('auth_type') == 'user') {
                    $this->ci->Moderation_model->addModerationItem($this->moderation_type[0], $user_id);
                    if ($mtype['mtype'] == 1 && $this->session->userdata('auth_type') == 'user') {
                        //postmoderation
                        $img_data['user_logo'] = $img_return['file'];
                        $img_data['user_logo_moderation'] = '';
                        //save old user logo
                        $img_data['user_logo_postmoderation'] = $this->profile_before['user_logo'];
                    } elseif ($mtype['mtype'] == 2 && $this->session->userdata('auth_type') == 'user') {
                        //premoderation
                        $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $user_id . '/', $this->profile_before['user_logo_moderation']);
                        $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $user_id . '/', $this->profile_before['user_logo_moderation'], self::ORIGINAL_IMG_PATH);
                        $this->ci->Uploads_model->blurImage($this->upload_config_id, $user_id, $img_return['file'], self::BLUR_POWER);
                        $img_data['user_logo_moderation'] = $img_return['file'];
                        $img_data['user_logo_postmoderation'] = $this->profile_before['user_logo'];
                    }
                } else {
                    $img_data['user_logo'] = $img_return['file'];
                }
                if ($mtype['mtype'] > 0 && $this->session->userdata('auth_type') == 'user') {
                    $this->ci->load->model('menu/models/Indicators_model');
                    $this->ci->Indicators_model->add('new_moderation_item', $user_id);
                }

                $this->saveUser($user_id, $img_data, '', true, false);
            }
        }

        $available_activation = $this->checkAvailableUserActivation($user_id);
        $this->ci->db
            ->set('activity', $available_activation['status'])
            ->where('id', $user_id)
            ->update(USERS_TABLE);
        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->session->userdata['activity'] = $available_activation['status'];
        }

        $this->updateProfileCompletion([$user_id]);

        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->form_editor_type);
        $fields_for_select = $this->ci->Field_editor_model->getFieldsForSelect();
        $this->ci->Field_editor_model->updateFulltextField($user_id);

        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            $this->ci->load->model('Perfect_match_model');
            $this->ci->Perfect_match_model->userUpdated($attrs, $user_id);
        }

        if (
            $this->ci->pg_module->get_module_config(
                'referral_links',
                'is_active'
            ) && isset($attrs['fk_referral_id'])
        ) {
            $this->ci->load->model('Referral_links_model');
            $this->ci->Referral_links_model->updateReferral($attrs, $user_id, $referral_code);
        }

        if ($this->ci->pg_module->is_module_installed('nearest_users')) {
            $this->ci->load->model('Nearest_users_model');
            $search_settings = $this->ci->Nearest_users_model->getSearchData(null, $user_id);
            if (!empty($attrs['lat']) || !empty($attrs['lon'])) {
                $search_settings['lon'] = $attrs['lon'];
                $search_settings['lat'] = $attrs['lat'];
                $this->ci->session->set_userdata('nearest_users_search', $search_settings);
            }
        }

        if ($this->is_dashboard === true) {
            $this->sendEvent(self::EVENT_USER_CHANGED, [
                'id' => $user_id,
                'type' => self::TYPE_USER,
                'status' => $this->userStatus($user_id),
            ]);
        }

        if (!$is_new_user && !$load_image) {
            $this->profile_after = $this->getUserById($user_id);
            $this->updateUserProfile($user_id);

            // TODO: cache
            $this->ci->cache->delete('users', $user_id);
        }

        return $user_id;
    }

    protected function userStatus($user_id): string
    {
        $is_admin = $this->ci->session->userdata('auth_type') === 'admin';

        $user = $this->getUserById($user_id);
        if ($user['confirm'] == 0) {
            return self::STATUS_NOT_CONFIRMED;
        } elseif ($user['approved'] == 0) {

            return $is_admin ? self::STATUS_ADMIN_DECLINED : self::STATUS_NOT_APPROVED;
        }

        return $is_admin ? self::STATUS_ADMIN_APPROVED : self::STATUS_SAVED;
    }

    /**
     * User status check.
     *
     * @param int $user_id
     *
     * @return bool
     */
    public function isActivityUser($user_id)
    {
        return (bool)current($this->ci->db->select('approved')
            ->from(USERS_TABLE)
            ->where('id', $user_id)
            ->get()->result_array())['approved'];
    }

    public function sendEvent($event_gid, $event_data)
    {
        $event_data['module'] = self::MODULE_GID;
        $event_data['action'] = $event_gid;

        $event = new EventUsers();
        $event->setData($event_data);

        $event_handler = EventDispatcher::getInstance();
        $event_handler->dispatch($event, $event_gid);
    }

    public function checkAvailableUserActivation($user_id): array
    {
        $result = ['status' => 0, 'fields' => [], 'logout' => false];
        $user = $this->getUserById($user_id);
        if ($user) {
            if (!empty($user['net_is_incomer'])) {
                $result['status'] = 1;
            } else {
                foreach ($this->fields_for_activation as $attr) {
                    if (!(isset($user[$attr]) && $user[$attr])) {
                        $result['fields'][] = $attr;
                    }
                    if ($attr == 'user_logo' && isset($user['user_logo_moderation']) && $user['user_logo_moderation']) {
                        unset($result['fields'][array_search('user_logo', $result['fields'])]);
                        $result['fields'][] = 'user_logo_moderation';
                    }
                }
                $is_activity = 1;
                if ($this->ci->pg_module->is_module_installed('services')) {
                    $this->ci->load->model('Services_model');
                    $service = $this->ci->Services_model->getServiceByGid('user_activate_in_search');
                    if ($service['status'] == 1) {
                        $is_activity = (int)(strtotime($user['activated_end_date'])) > time() ? 1 : 0;
                    }
                }
                $result['status'] = ($result['fields'] || $is_activity == 0) ? 0 : 1;
            }
        } else {
            $result['logout'] = $user_id == $this->ci->session->userdata['user_id'];
        }

        return $result;
    }

    public function setUserConfirm($user_id, $status = 1)
    {
        return is_null($user_id) ? false : $this->saveUser($user_id, ['confirm' => $status]);
    }

    public function setUserApprove($user_id, $status = 1)
    {
        $attrs['approved'] = (int)$status;

        if ($status == 1) {
            $user = $this->getUserById($user_id);
            $this->ci->load->model('Notifications_model');
            $this->ci->Notifications_model->sendNotification($user['email'], 'users_approved', ['name' => self::formatUserName($user)], '', $user['lang_id']);
        }

        if (is_null($user_id)) {
            return false;
        }

        $this->saveUser($user_id, $attrs);
        // TODO: cache
        $this->ci->cache->delete('users', $user_id);

        return $user_id;
    }

    public function setUserActivity($user_id, $status = 1)
    {
        $attrs['activity'] = (int)$status;

        if ($user_id) {
            // TODO: cache
            $this->ci->cache->delete('users', $user_id);

            return $this->saveUser($user_id, $attrs);
        }

        return false;

        return is_null($user_id) ? false : $this->saveUser($user_id, $attrs);
    }

    public function activateUser($user_id, $status = 1)
    {
        if (getenv('DEMO_MODE') || getenv('FIX_USER')) {
            $login_settings = $this->ci->config->item('login_settings', 'demo_data');
            $user = $this->getUserByEmail($login_settings['user']['login']);
            if ($user['id'] == $user_id || $user_id == 16) {
                return ['error' => l('error_demo_mode', 'start')];
            }
        }
        $this->ci->load->model('users/models/Users_blocked_callbacks_model');
        $this->ci->Users_blocked_callbacks_model->executeCallbacks([$user_id], (string)$status);

        return $this->setUserApprove($user_id, $status);
    }

    public function validate($user_id = null, $data = [], $file_name = '', $section_gid = null, $type = 'select')
    {
        $return = ['errors' => [], 'data' => []];

        $auth = $this->ci->session->userdata('auth_type');
        $this->ci->config->load('reg_exps', true);
        if (isset($data['roles'])) {
            $return['data']['roles'] = $data['roles'];
        }

        if (isset($data['user_logo'])) {
            $return['data']['user_logo'] = strip_tags($data['user_logo']);
        }

        if (isset($data['email_confirmation_code']) && !empty($data['email_confirmation_code'])) {
            $return['data']['email_confirmation_code'] = strip_tags($data['email_confirmation_code']);
        }

        if (isset($data['user_logo_moderation'])) {
            $return['data']['user_logo_moderation'] = strip_tags($data['user_logo_moderation']);
        }
        $this->ci->load->model('Moderation_model');

        if (isset($data['referral_code']) && $data['referral_code'] && $this->ci->pg_module->get_module_config('referral_links', 'is_active')) {
            $this->ci->load->model('Referral_links_model');
            $ref_data = $this->ci->Referral_links_model->getReferralData(['uniq_code' => strip_tags($data['referral_code'])]);
            if ($ref_data) {
                $is_user = $this->getUserById($ref_data['user_id']);
                if (!$is_user) {
                    unset($return['data']['referral_code']);
                } else {
                    if ($ref_data['is_used'] || ($ref_data['ref_email'] != $data['email'] && $this->ci->pg_module->get_module_config('referral_links', 'email_validation'))) {
                        unset($return['data']['referral_code']);
                    } else {
                        $return['data']['fk_referral_id'] = $ref_data['user_id'];
                        $return['data']['referral_code'] = $ref_data['uniq_code'];
                    }
                }
            } else {
                unset($return['data']['referral_code']);
            }
        }

        $name_expr = $this->ci->config->item('name', 'reg_exps');
        if (!empty($data['fname'])) {
            $return['data']['fname'] = strip_tags($data['fname']);
            $bw_count = $this->ci->Moderation_badwords_model->checkBadwords($this->moderation_type[1], $return['data']['fname']);
            if ($bw_count || !preg_match($name_expr, $return['data']['fname'])) {
                $return['errors']['fname'] = l('error_badwords_fname', 'users');
            }
        }

        if (!empty($data['sname'])) {
            $return['data']['sname'] = strip_tags($data['sname']);
            $bw_count = $this->ci->Moderation_badwords_model->checkBadwords($this->moderation_type[1], $return['data']['sname']);
            if ($bw_count || !preg_match($name_expr, $return['data']['sname'])) {
                $return['errors']['sname'] = l('error_badwords_sname', self::MODULE_GID);
            }
        }

        if (isset($data['user_type'])) {
            $user_types = $this->getUserTypes();
            if ($type == 'select') {
                if (is_array($data['user_type'])) {
                    $user_type = in_array('undefined', $data['user_type']) ? array_slice($data['user_type'], 1) : $data['user_type'];
                    $return['data']['user_type'] = $user_type;
                } else {
                    if (in_array($data['user_type'], $user_types) === true) {
                        $return['data']['user_type'] = $data['user_type'];
                    } else {
                        $return['errors']['user_type'] = l('error_user_type_select', self::MODULE_GID);
                    }
                }
            } else {
                if (in_array($data['user_type'], $user_types) === true) {
                    $return['data']['user_type'] = $data['user_type'];
                } else {
                    $return['errors']['user_type'] = l('error_user_type_select', self::MODULE_GID);
                }
            }
            $return['success']['user_type'] = '';
        }

        if ($this->is_couples_installed === true) {
            if (CouplesModel::isCouplesFields($data) === true) {
                $this->ci->load->model('Couples_model');
                $return['couple'] = $this->ci->Couples_model->validate($data, null);
            }
        }

        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            if (isset($data['looking_user_type'])) {
                $return['data']['looking_user_type'] = $data['looking_user_type'];
                $return['success']['looking_user_type'] = '';
            }

            $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
            $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');
            if (isset($data['age_min'])) {
                $return['data']['age_min'] = (int)$data['age_min'];
                if ($return['data']['age_min'] < $age_min || $return['data']['age_min'] > $age_max) {
                    $return['data']['age_min'] = $age_min;
                }
            }
            if (isset($data['age_max'])) {
                $return['data']['age_max'] = (int)$data['age_max'];
                if ($return['data']['age_max'] < $age_min || $return['data']['age_max'] > $age_max) {
                    $return['data']['age_max'] = $age_max;
                }
                if (!empty($return['data']['age_min']) && $return['data']['age_min'] > $return['data']['age_max']) {
                    $return['data']['age_min'] = $age_min;
                }
            }
        }

        if (isset($data['nickname'])) {
            $login_expr = $this->ci->config->item('nickname', 'reg_exps');
            $return['data']['nickname'] = !empty($data['nickname']) ? strip_tags($data['nickname']) : '';
            if (empty($return['data']['nickname']) || !preg_match($login_expr, $return['data']['nickname'])) {
                $return['errors']['nickname'] = l('error_nickname_incorrect', self::MODULE_GID);
            }
            $params = [];
            $params['where']['nickname'] = $return['data']['nickname'];
            if ($user_id) {
                $params['where']['id <>'] = $user_id;
            }
            $count = $this->getUsersCount($params);
            if ($count > 0) {
                $return['errors']['nickname'] = l('error_nickname_already_exists', self::MODULE_GID);
            }
            if (empty($return['errors']['nickname'])) {
                $return['success']['nickname'] = '';
            }
            $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type[1], $return['data']['nickname']);
            if ($bw_count) {
                $return['errors']['nickname'] = l('error_badwords_nickname', self::MODULE_GID);
            }
        }

        if (isset($data['user_open_id'])) {
            $return['data']['user_open_id'] = trim($data['user_open_id']);
        }

        $this->ci->load->model('Countries_model');
        if (isset($data['id_country'])) {
            $return['data']['id_country'] = $data['id_country'];
            if (isset($data['id_region'])) {
                $return['data']['id_region'] = (int)$data['id_region'];
                $regions = $this->ci->Countries_model->getRegions($return['data']['id_country'], null, ['where' => ['id' => $return['data']['id_region']]]);
                if (empty($regions)) {
                    $return['data']['id_region'] = '';
                    $return['data']['id_city'] = '';
                } else {
                    if (isset($data['id_city'])) {
                        $return['data']['id_city'] = (int)$data['id_city'];
                        $cities = $this->ci->Countries_model->getCities(null, null, null, ['where' => [
                            'country_code' => $return['data']['id_country'],
                            'id_region' => $return['data']['id_region'],
                            'id' => $return['data']['id_city'],
                        ]]);
                        if (empty($cities)) {
                            $return['data']['id_city'] = '';
                        } else {
                            if (isset($data['lat'])) {
                                $return['data']['lat'] = (float)$data['lat'];
                            }

                            if (isset($data['lon'])) {
                                $return['data']['lon'] = (float)$data['lon'];
                            }
                        }
                    }
                }
            }
        }

        if (isset($data['phone'])) {
            $return['data']['phone'] = trim(strip_tags((string)$data['phone']));
        }

        if (isset($data['address'])) {
            $return['data']['address'] = trim(strip_tags($data['address']));
        }

        if (isset($data['birth_date'])) {
            if (!empty($data['birth_date'])) {
                $data['birth_date'] = $this->pg_date->strTranslate($data['birth_date']);
                $birth_date = trim(strip_tags($data['birth_date']));
                $return['data']['birth_date'] = date(self::DB_DATE_SIMPLE_FORMAT, strtotime($birth_date));

                $datetime = date_create($return['data']['birth_date']);
                if ($datetime) {
                    $user_age = $datetime->diff(date_create('today'))->y;
                } else {
                    $user_age = 0;
                }

                if ($this->ci->pg_module->is_module_installed('perfect_match')) {
                    if ($user_age < $age_min) {
                        $return['errors']['birth_date'] = str_replace('[age]', $age_min, l('error_user_too_young', self::MODULE_GID));
                    } elseif ($user_age > $age_max) {
                        $return['errors']['birth_date'] = str_replace('[age]', $age_max, l('error_user_too_old', self::MODULE_GID));
                    } else {
                        $return['success']['birth_date'] = '';
                    }
                } else {
                    $return['success']['birth_date'] = '';
                }
            }

            if (empty($return['data']['birth_date'])) {
                $return['errors']['birth_date'] = str_replace('[age]', $age_min, l('error_user_too_young', self::MODULE_GID));
            }
        }
        if (isset($data['age'])) {
            $return['data']['age'] = (int)$data['age'];
        }

        if (isset($data['show_adult'])) {
            $return['data']['show_adult'] = (int)$data['show_adult'];
        }

        if (isset($data['profile_completion'])) {
            $return['data']['profile_completion'] = (int)$data['profile_completion'];
        }

        if (isset($data['postal_code'])) {
            $return['data']['postal_code'] = trim(strip_tags($data['postal_code']));
        }

        if (empty($user_id) && !isset($data['group_id'])) {
            $this->ci->load->model('users/models/Groups_model');
            $return['data']['group_id'] = $this->ci->Groups_model->getDefaultGroupId();
        } elseif (isset($data['group_id'])) {
            $return['data']['group_id'] = (int)$data['group_id'];
        }
        if (isset($data['email'])) {
            $return['data']['email'] = strip_tags($data['email']);
            if (!filter_var($return['data']['email'], FILTER_VALIDATE_EMAIL)) {
                $return['errors']['email'] = l('error_email_incorrect', self::MODULE_GID);
            } else {
                unset($params);
                $params['where']['email'] = $return['data']['email'];
                if ($user_id) {
                    $params['where']['id <>'] = $user_id;
                    if ($this->is_couples_installed === true) {
                        $params['where']['couple_id <>'] = $user_id;
                    }
                }
                $count = $this->getUsersCount($params);
                if ($count > 0) {
                    $return['errors']['email'] = l('error_email_already_exists', self::MODULE_GID);
                }
            }
            if (empty($return['errors']['email'])) {
                $return['success']['email'] = '';
            }
        }
        if (isset($data['password'])) {
            if (empty($data['password'])) {
                $return['errors']['password'] = l('error_password_empty', self::MODULE_GID);
            } elseif ($this->ci->pg_module->get_module_config(self::MODULE_GID, 'use_repassword') && $data['password'] != $data['repassword']) {
                $return['errors']['repassword'] = l('error_pass_repass_not_equal', self::MODULE_GID);
            } else {
                $password_expr = $this->ci->config->item('password', 'reg_exps');
                $data['password'] = trim(strip_tags($data['password']));
                if (!preg_match($password_expr, $data['password'])) {
                    $return['errors']['password'] = l('error_password_incorrect', self::MODULE_GID);
                } else {
                    $return['data']['password'] = $data['password'];
                }
            }
        }

        if (in_array($auth, ['user', 'admin']) !== true && isset($data['captcha_confirmation'])) {
            $this->ci->load->model('start/models/Start_captcha_model');
            if ($this->ci->Start_captcha_model->isCaptcha($data['captcha_confirmation']) === false) {
                $return['errors']['captcha_confirmation'] = l('error_invalid_captcha', self::MODULE_GID);
            }
        }

        if (empty($data['confirmation']) && empty($user_id) && $auth !== 'admin') {
            $return['errors']['confirmation'] = l('error_no_confirmation', self::MODULE_GID);
        } elseif ($auth === 'admin' && empty($user_id)) {
            $return['data']['is_terms'] = 0;
        } else {
            if (empty($user_id)) {
                $return['data']['is_terms'] = 1;
            }
        }

        if ($this->ci->pg_module->is_module_installed('network')) {
            if (isset($data['is_network'])) {
                $return['data']['net_user_decision'] = $data['is_network'] == '1' ? 'agree' : 'disagree';
            }
        }

        if (
            !empty($file_name) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name])
            && is_uploaded_file($_FILES[$file_name]['tmp_name'])
        ) {
            $this->ci->load->model('Uploads_model');
            $img_return = $this->ci->Uploads_model->validate_upload(
                $this->upload_config_id,
                $file_name
            );
            if (!empty($img_return['error'])) {
                $return['errors'][] = implode('<br>', $img_return['error']);
            }
            $return['data']['user_logo_mime'] = $_FILES[$file_name]['type'];
        }

        if (isset($data['confirm'])) {
            $return['data']['confirm'] = (int)$data['confirm'];
        }

        if (isset($data['approved'])) {
            $return['data']['approved'] = (int)$data['approved'];
        }

        if (isset($data['activity'])) {
            $return['data']['activity'] = (int)$data['activity'];
        }

        if (!is_null($section_gid)) {
            $this->ci->load->model('Field_editor_model');
            $params = [];
            if (!empty($section_gid)) {
                $params['where']['section_gid'] = $section_gid;
            }
            if ($type == 'save') {
                $validate_data = $this->ci->Field_editor_model->validateFieldsForSave($params, $data);
            } else {
                $validate_data = $this->ci->Field_editor_model->validateFieldsForSelect($params, $data);
            }

            if (
                $this->is_couples_installed === true && empty($return['couple']) && $user_id
                && CouplesModel::isCouplesFields($data) === true
            ) {
                $this->ci->load->model('Couples_model');
                if ($type == 'save') {
                    $data = $this->ci->Couples_model->validate($data, $section_gid);
                    $return['couple'] = $this->ci->Field_editor_model->validateFieldsForSave($params, $data['data']);
                } elseif ($type == 'select') {
                    $data = $this->ci->Couples_model->validate($data, $section_gid);
                    $return['couple'] = $this->ci->Field_editor_model->validateFieldsForSelect($params, $data['data']);
                }
            }

            $return['data'] = array_merge(
                $return['data'],
                $validate_data['data']
            );
            if (!empty($validate_data['errors'])) {
                $return['errors'] = array_merge($return['errors'], $validate_data['errors']);
            }
        }

        if (!$user_id) {
            foreach ($this->fields_register as $field) {
                if (!(isset($return['data'][$field]) && $return['data'][$field])) {
                    $return['errors'][] = l('error_empty_fields', self::MODULE_GID);
                    break;
                }
            }
        }

        return $return;
    }

    /**
     * Delete user
     * @param int $user_id
     * @param array $callbacks_gid
     * @return false
     */
    public function deleteUser($user_id, $callbacks_gid = [])
    {
        $user_id = (int)$user_id;
        if (getenv('DEMO_MODE') || getenv('FIX_USER')) {
            $login_settings = $this->ci->config->item('login_settings', 'demo_data');
            $user = $this->getUserByEmail($login_settings['user']['login']);
            if ((int)$user['id'] === $user_id || $user_id === 16) {
                return false;
            }
        }
        $auth = $this->ci->session->userdata('auth_type');
        if ($auth !== 'admin') {
            $callbacks_gid = ['users_delete', 'media_user', 'media_gallery'];
        }
        $this->setCallbacks($user_id, $callbacks_gid);
        $this->sendEvent(self::EVENT_USER_CHANGED, [
            'id' => $user_id,
            'type' => self::TYPE_USER,
            'status' => self::STATUS_DELETED,
        ]);
    }

    public function setUserOutputName(&$user)
    {
        $controller = $this->ci->router->fetch_class(true);
        if (substr($controller, 0, 6) != 'admin_') {
            $hide_user_names = $this->ci->pg_module->get_module_config('users', 'hide_user_names');
        } else {
            $hide_user_names = 0;
        }
        if ($hide_user_names && !(!empty($user['id']) && $this->ci->session->userdata('user_id') == $user['id'])) {
            $user['fname'] = $user['sname'] = '';
        }
        $user['nickname_str'] = !empty($user['nickname']) ? $user['nickname'] : '';
        if (!(empty($user['fname']) && empty($user['sname'])) && !$hide_user_names) {
            $user['output_name'] = trim($user['fname'] . ' ' . $user['sname']);
        } else {
            $user['output_name'] = $user['nickname'] ?? '';
        }

        if ($this->is_couples_installed === true) {
            $this->ci->load->model('Couples_model');
            if (!empty($user['user_type']) && $user['user_type'] == 'couple' && $user['is_coupled'] != 1) {
                $user['output_name'] = $this->ci->Couples_model->getCouplesName($user);
            }
        }

        if (empty($user['approved'])) {
            $user['output_name'] .= ' (' . l('field_deactivate_user', 'users') . ')';
        }

        return $user['output_name'];
    }

    public function formatUsers($data, $safe_format = false, $lang_id = null)
    {
        // TODO: array of users identifiers for format list
        $user_ids = [];

        if (!$lang_id) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $this->ci->load->model(['Uploads_model', 'Properties_model', 'users/models/Users_statuses_model']);
        $user_types = $this->ci->Properties_model->getProperty('user_type', $lang_id);
        $looking_user_types = $this->ci->Properties_model->getProperty('looking_user_type', $lang_id);
        $pm_installed = $this->ci->pg_module->is_module_installed('perfect_match');
        $is_admin = $this->ci->session->userdata('auth_type') == 'admin';
        $viewer_id = $this->ci->session->userdata('user_id');

        foreach ($data as $key => $user) {
            if (!empty($user['password'])) {
                unset($user['password']);
            }

            if (!empty($user['account'])) {
                $user['account'] = (float)$user['account'];
            }

            if (!empty($user['id'])) {
                $user['postfix'] = $user['id'];
                $user_ids[$user['id']]['country'] = $user['id_country'] ?? '';
                $user_ids[$user['id']]['region'] = $user['id_region'] ?? '';
                $user_ids[$user['id']]['city'] = $user['id_city'] ?? '';
            }

            $cur_time = time();
            $user['is_activated'] = 0;
            if (!empty($user['activated_end_date'])) {
                $user['unix_activated_end_date'] = (int)strtotime($user['activated_end_date']);
                if ($user['unix_activated_end_date'] > $cur_time) {
                    $user['is_activated'] = 1;
                }
            }

            $user['is_featured'] = 0;
            if (!empty($user['featured_end_date'])) {
                $user['unix_featured_end_date'] = (int)strtotime($user['featured_end_date']);
                if ($user['unix_featured_end_date'] > $cur_time) {
                    $user['is_featured'] = 1;
                }
            }
            $user['is_hide_on_site'] = 0;
            if (!empty($user['hide_on_site_end_date'])) {
                $user['unix_hide_on_site_end_date'] = (int)strtotime($user['hide_on_site_end_date']);
                if ($user['unix_hide_on_site_end_date'] > $cur_time) {
                    $user['is_hide_on_site'] = 1;
                }
            }
            $user['is_highlight_in_search'] = 0;
            if (!empty($user['highlight_in_search_end_date'])) {
                $user['unix_highlight_in_search_end_date'] = (int)strtotime($user['highlight_in_search_end_date']);
                if ($user['unix_highlight_in_search_end_date'] > $cur_time) {
                    $user['is_highlight_in_search'] = 1;
                }
            }
            $user['is_up_in_search'] = 0;
            if (!empty($user['up_in_search_end_date'])) {
                $user['unix_up_in_search_end_date'] = (int)strtotime($user['up_in_search_end_date']);
                if ($user['unix_up_in_search_end_date'] > $cur_time) {
                    $user['is_up_in_search'] = 1;
                }
            }

            if (!empty($user['user_type'])) {
                $user['user_type_str'] = !empty($user_types['option'][$user['user_type']]) ?
                    $user_types['option'][$user['user_type']] : '';
            }

            if (isset($user['looking_user_type'])) {
                if (!empty($user['looking_user_type'])) {
                    $user['looking_user_type_str'] = !empty($looking_user_types['option'][$user['looking_user_type']]) ?
                        $looking_user_types['option'][$user['looking_user_type']] : '';
                } else {
                    if ($pm_installed) {
                        $user['looking_user_type_str'] = !empty($looking_user_types['option'][$user['looking_user_type']]) ?
                            $looking_user_types['option'][$user['looking_user_type']] : '';
                    }
                }
            }

            $this->setUserOutputName($user);

            if ($pm_installed) {
                $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
                $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');

                if (isset($user['age_min']) && ($user['age_min'] < $age_min || $user['age_min'] > $age_max)) {
                    $user['age_min'] = $age_min;
                }
                if (isset($user['age_max'])) {
                    if ($user['age_max'] < $age_min || $user['age_max'] > $age_max) {
                        $user['age_max'] = $age_max;
                    }
                    if (!empty($user['age_min']) && $user['age_min'] > $user['age_max']) {
                        $user['age_min'] = $age_min;
                    }
                }
            }

            // TODO: blacklist flags
            $user['you_in_blacklist'] = 0;
            $user['is_blocked'] = 0;

            if (isset($user['roles'])) {
                $user['roles'] = $this->rolesDecode($user['roles']);
            }

            if (((!empty($user['id']) && $user['id'] == $viewer_id) || $is_admin) && !empty($user['user_logo_moderation'])) {
                $user['media']['user_logo_moderation'] = $this->ci->Uploads_model->formatUpload($this->upload_config_id, $user['postfix'], $user['user_logo_moderation'], self::ORIGINAL_IMG_PATH);
            } elseif (!empty($user['user_logo_moderation'])) {
                $user['media']['user_logo_moderation'] = $this->ci->Uploads_model->formatUpload($this->upload_config_id, $user['postfix'], $user['user_logo_moderation']);
            } elseif (!empty($user['user_logo'])) {
                $user['media']['user_logo'] = $this->ci->Uploads_model->formatUpload($this->upload_config_id, $user['postfix'], $user['user_logo']);
            } elseif (!empty($user['user_logo_declined']) && $is_admin) {
                $user['media']['user_logo_declined'] = $this->ci->Uploads_model->formatUpload($this->upload_config_id, $user['postfix'], $user['user_logo_declined'], self::ORIGINAL_IMG_PATH);
            } else {
                $user['media']['user_logo']['is_default'] = 1;
                $user['media']['user_logo'] = $this->ci->Uploads_model->formatDefaultUpload($this->upload_config_id);
            }

            if (!empty($user['user_logo_mime'])) {
                $user['media']['type'] = $user['user_logo_mime'];
            }

            if ($this->ci->router->is_api_class) {
                unset($user['media']['user_logo']['thumbs_data']);
            }

            if (isset($user['online_status']) && isset($user['site_status'])) {
                $user['statuses'] = $this->ci->Users_statuses_model->formatStatus($user['online_status'], $user['site_status']);
            }
            if (!empty($user['birth_date'])) {
                // TODO: birth_date_raw used in birthdays
                $user['birth_date_raw'] = $user['birth_date'];
                $page_data['date_format'] = $this->ci->pg_date->get_format('date_literal', 'st');
                $user['birth_date_tstamp'] = strtotime($user['birth_date']);
                $user['birth_date_hidden'] = strftime(self::HIDDEN_DATE_FORMAT, (int)strtotime($user['birth_date']));
            } else {
                $user['birth_date_raw'] = self::DB_DEFAULT_DATE;
            }

            if (isset($user['rating_sorter'])) {
                $user['rating_sorter'] = round($user['rating_sorter'], 1);
            }
            if (isset($user['rating_value'])) {
                $user['rating_value'] = round($user['rating_value'], 1);
            }

            $data[$key] = $user;
        }

        if (!empty($user_ids)) {
            $this->ci->load->helper('countries');
            $users_locations_data = \Pg\modules\countries\helpers\getLocationData($user_ids, 'city', $lang_id);
            $user_locations = \Pg\modules\countries\helpers\citiesOutputFormat($user_ids, $users_locations_data, $lang_id);
            foreach ($data as $key => $user) {
                $data[$key]['location'] = $user_locations[$user['id']] ?? '';
                $data[$key]['country'] = !empty($user['id_country']) ? $users_locations_data['country'][$user['id_country']]['name'] ?? '' : '';
                $data[$key]['region'] = !empty($user['id_country']) ? $users_locations_data['region'][$user['id_region']]['name'] ?? '' : '';
                $data[$key]['region-code'] = !empty($user['id_region']) ? $users_locations_data['region'][$user['id_region']]['code'] ?? '' : '';
                $data[$key]['city'] = !empty($user['id_city']) ? $users_locations_data['city'][$user['id_city']]['name'] ?? '' : '';
            }

            // TODO: blacklist
            if ($viewer_id) {
                $blacklist_user_ids = $user_ids;
                if (isset($blacklist_user_ids[$viewer_id])) {
                    unset($blacklist_user_ids[$viewer_id]);
                }
                foreach ($this->blacklist as $user_id => $blacklist_data) {
                    if (isset($blacklist_user_ids[$user_id])) {
                        unset($blacklist_user_ids[$user_id]);
                    }
                }
                if ($blacklist_user_ids && $this->ci->pg_module->is_module_installed('blacklist')) {
                    $blacklist_user_ids = array_keys($blacklist_user_ids);
                    $this->ci->load->model('Blacklist_model');
                    $blacklist_data = $this->ci->Blacklist_model->getListByParams([
                        'where_sql' => [
                            'id_user IN (' . implode(',', $blacklist_user_ids)
                            . ') OR id_dest_user IN (' . implode(',', $blacklist_user_ids) . ')',
                        ],
                    ]);
                    $blacklist_by_user_id = [];
                    $blocked_by_user_id = [];
                    foreach ($blacklist_data as $blacklist_item) {
                        if ($blacklist_item['id_dest_user'] == $viewer_id) {
                            $blacklist_by_user_id[$blacklist_item['id_user']] = 1;
                        } elseif ($blacklist_item['id_user'] == $viewer_id) {
                            $blocked_by_user_id[$blacklist_item['id_dest_user']] = 1;
                        }
                    }

                    foreach ($data as $key => $user) {
                        if (isset($this->blacklist[$user['id']])) {
                            $data[$key]['you_in_blacklist'] = $this->blacklist[$user['id']]['you_in_blacklist'];
                            $data[$key]['is_blocked'] = $this->blacklist[$user['id']]['is_blocked'];
                        } else {
                            if (isset($blacklist_by_user_id[$user['id']])) {
                                $data[$key]['you_in_blacklist'] = 1;
                            }
                            if (isset($blocked_by_user_id[$user['id']])) {
                                $data[$key]['is_blocked'] = 1;
                            }
                            $this->blacklist[$user['id']]['you_in_blacklist'] = $data[$key]['you_in_blacklist'];
                            $this->blacklist[$user['id']]['is_blocked'] = $data[$key]['is_blocked'];
                        }
                    }
                } elseif ($this->blacklist) {
                    foreach ($data as $key => $user) {
                        if (isset($this->blacklist[$user['id']])) {
                            $data[$key]['you_in_blacklist'] = $this->blacklist[$user['id']]['you_in_blacklist'];
                            $data[$key]['is_blocked'] = $this->blacklist[$user['id']]['is_blocked'];
                        }
                    }
                }
            }
        }

        if ($safe_format) {
            foreach ($data as $key => $user) {
                $data[$key] = array_intersect_key(
                    $data[$key],
                    array_flip($this->safe_fields)
                );
            }
        }

        $this->ci->load->helper('date_format');
        $date_formats = $this->ci->pg_date->get_format('date_literal', 'st');

        $this->ci->load->helper('seo');

        if (PRODUCT_NAME == 'social' && $this->ci->pg_module->is_module_installed('wall_events')) {
            $section_code = 'wall';
            $section_name = l('filter_section_wall', 'users');
        } else {
            $section_code = 'profile';
            $section_name = l('filter_section_profile', 'users');
        }

        // seo data
        foreach ($data as $key => $user) {
            if (isset($user['user_type'])) {
                $user['type-code'] = $user['user_type'];
            }
            if (isset($user['user_type_str'])) {
                $user['type-name'] = $user['user_type_str'];
            }
            if (isset($user['looking_user_type']) && $pm_installed) {
                $user['looking-code'] = $user['looking_user_type'];
            }
            if (isset($user['looking_user_type_str'])) {
                $user['looking-name'] = $user['looking_user_type_str'];
            }
            if (isset($user['output_name'])) {
                $user['name'] = $user['output_name'];
            }
            if (isset($user['fname'])) {
                $user['first-name'] = $user['fname'];
            }
            if (isset($user['sname'])) {
                $user['second-name'] = $user['sname'];
            }
            if (isset($user['date_created'])) {
                $user['registered-date'] = tpl_date_format(
                    $user['date_created'],
                    $date_formats
                );
            }
            if (isset($user['birth_date'])) {
                $user['birth-date'] = $user['birth_date'] = tpl_date_format(
                    $user['birth_date'],
                    $date_formats
                );
            }
            if (isset($user['online_status'])) {
                $user['online-status-code'] = $user['online_status'] ? 'online' : 'offline';
            }
            if (isset($user['online_status'])) {
                $user['online-status-name'] = l(
                    'status_online_' . $user['online_status'],
                    'users'
                );
            }

            $user['section-code'] = $section_code;
            $user['section-name'] = $section_name;
            $user['link'] = rewrite_link(self::MODULE_GID, 'view', $user);
            $data[$key] = $user;
        }

        return $data;
    }

    public function formatDefaultUser($id = null, $lang_id = '', $module = '', $type = 'deleted')
    {
        $this->ci->load->model('Uploads_model');
        $auth = $this->ci->session->userdata('auth_type');

        if (($auth === 'admin' || $module === 'mailbox') && $id != 0 && $type != 'blocked') {
            $this->ci->load->model('users/models/Users_deleted_model');
            $data = $this->ci->Users_deleted_model->getUserByUserId($id, true);
            if (empty($data)) {
                $data = ['output_name' => ''];
            }
        } elseif ($auth === 'admin' && $id == 0) {
            $data = [
                'nickname' => 'Administrator',
                'output_name' => 'Administrator',
            ];
        } elseif ($type == 'blocked') {
            $data = [
                'id' => $id,
                'postfix' => $id ?: '',
                'link' => site_url() . 'users/untitled/' . $id,
                'birth_date' => '',
                'is_blocked' => true,
                'approved' => 0,
                'output_name' => $id ? l('field_deactivate_user', 'users', $lang_id) : l('guest', 'users', $lang_id),
                'output_name_str' => $id ? strip_tags(l('field_deactivate_user', 'users', $lang_id)) : l('guest', 'users', $lang_id),
                'media' => [
                    'user_logo' => $this->ci->Uploads_model->formatDefaultUpload($this->upload_config_id),
                ],
            ];
        } else {
            $data = [
                'postfix' => $id ?: '',
                'link' => site_url() . 'users/untitled',
                'birth_date' => '',
                'output_name' => $id ? l('user_deleted', 'users', $lang_id) : l('guest', 'users', $lang_id),
                'output_name_str' => $id ? strip_tags(l('user_deleted', 'users', $lang_id)) : l('guest', 'users', $lang_id),
                'media' => [
                    'user_logo' => $this->ci->Uploads_model->formatDefaultUpload($this->upload_config_id),
                ],
            ];
            if ($id) {
                $data['is_deleted'] = true;
            } else {
                $data['is_guest'] = true;
            }
        }

        if ($this->ci->pg_module->is_module_installed('wall_events')) {
            $section_code = 'wall';
            $section_name = l('filter_section_wall', 'users');
        } else {
            $section_code = 'profile';
            $section_name = l('filter_section_profile', 'users');
        }

        // seo data
        $data['type-code'] = 'unknown';
        $data['type-name'] = 'unknown';
        $data['looking-code'] = 'unknown';
        $data['looking-name'] = 'unknown';
        $data['name'] = $data['output_name'];
        $data['first-name'] = 'unknown';
        $data['second-name'] = 'unknown';
        $data['registered-date'] = 'unknown';
        $data['birth-date'] = 'unknown';
        $data['online-status-code'] = 'offline';
        $data['online-status-name'] = l('status_online_0', 'users');
        $data['section-code'] = $section_code;
        $data['section-name'] = $section_name;

        return $data;
    }

    public function formatUser($data, $safe_format = false, $lang_id = '')
    {
        $return = [];
        if (!empty($data)) {
            $return = $this->formatUsers([$data], $safe_format, $lang_id)[0];
            if ($this->is_couples_installed === true && !empty($data['couple'])) {
                if ($data['user_type'] === CouplesModel::USER_TYPE) {
                    $return['couple'] = $this->formatUsers([$data['couple']], $safe_format, $lang_id)[0];
                }
            }
        }

        return $return;
    }

    // seo
    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        }
        $actions = ['account', 'account_delete', 'settings',
            'login_form', 'search', 'confirm', 'restore', 'profile',
            'view', 'registration', 'my_visits', 'my_guests',];
        $return = [];
        foreach ($actions as $action) {
            $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
        }

        return $return;
    }

    protected function getSeoSettingsInternal($method, $lang_id = '')
    {
        if ($method == 'account') {
            return [
                'templates' => ['nickname', 'fname', 'sname', 'output_name'],
                'url_vars' => [],
                'url_postfix' => [
                    'action' => ['action' => 'literal'],
                    'page' => ['page' => 'numeric'],
                ],
                'optional' => [],
            ];
        } elseif ($method == 'account_delete') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [],
                'optional' => [],
            ];
        } elseif ($method == 'settings') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [],
                'optional' => [],
            ];
        } elseif ($method == 'login_form') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [],
                'optional' => [],
            ];
        } elseif ($method == 'restore') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [],
                'optional' => [],
            ];
        } elseif ($method == 'profile') {
            return [
                'templates' => ['nickname', 'first-name', 'second-name',
                    'type-code',
                    'type-name', 'looking-code', 'looking-name', 'name',
                    'location',
                    'country', 'region', 'region-code', 'city', 'age',
                    'birth-date',
                    'registered-date', 'online-status-code', 'online-status-name',
                    'section-code', 'section-name', 'fname', 'sname',
                    'user_type',
                    'output_name',],
                'url_vars' => [],
                'url_postfix' => [
                    'section-code' => ['section-code' => 'literal',
                        'section-name' => 'literal',],
                    'subsection-code' => ['subsection-code' => 'literal',
                        'subsection-name' => 'literal',],
                ],
                'optional' => [],
            ];
        } elseif ($method == 'view') {
            return [
                'templates' => ['nickname', 'first-name', 'second-name',
                    'type-code',
                    'type-name', 'looking-code', 'looking-name', 'name',
                    'location',
                    'country', 'region', 'region-code', 'city', 'age',
                    'birth-date',
                    'registered-date', 'online-status-code', 'online-status-name',
                    'section-code', 'section-name', 'fname', 'sname',
                    'user_type',
                    'output_name',],
                'url_vars' => [
                    'id' => ['id' => 'literal', 'nickname_str' => 'literal'],
                ],
                'url_postfix' => [
                    'section-code' => ['section-code' => 'literal',
                        'section-name' => 'literal',],
                    'subsection-code' => ['subsection-code' => 'literal',
                        'subsection-name' => 'literal',],
                ],
                'optional' => [
                    [
                        'type-code' => 'literal',
                        'type-name' => 'literal',
                        'looking-code' => 'literal',
                        'looking-name' => 'literal',
                        'name' => 'literal',
                        'first-name' => 'literal',
                        'second-name' => 'literal',
                        'location' => 'literal',
                        'country' => 'literal',
                        'region' => 'literal',
                        'region-code' => 'literal',
                        'city' => 'literal',
                        'age' => 'literal',
                        'birth-date' => 'literal',
                        'registered-date' => 'literal',
                        'online-status-code' => 'literal',
                        'online-status-name' => 'literal',
                    ],
                ],
            ];
        } elseif ($method == 'registration') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [],
                'optional' => [],
            ];
        } elseif ($method == 'confirm') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [
                    'code' => ['code' => 'literal'],
                ],
                'optional' => [],
            ];
        } elseif ($method == 'search') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [
                    'order' => ['order' => 'literal'],
                    'order_direction' => ['order_direction' => 'literal'],
                    'page' => ['page' => 'numeric'],
                ],
                'optional' => [],
            ];
        } elseif ($method == 'my_visits') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [
                    'period' => ['period' => 'literal'],
                    'page' => ['page' => 'numeric'],
                ],
                'optional' => [],
            ];
        } elseif ($method == 'my_guests') {
            return [
                'templates' => [],
                'url_vars' => [],
                'url_postfix' => [
                    'period' => ['period' => 'literal'],
                    'page' => ['page' => 'numeric'],
                ],
                'optional' => [],
            ];
        }
    }

    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        $user_data = [];
        if ($var_name_from == $var_name_to) {
            return $value;
        }

        if ($var_name_from == 'nickname_str' && $var_name_to == 'id') {
            if ($this->is_couples_installed === true) {
                $value = trim(explode(' ', $value)[0]);
            }
            $user_data = $this->getUserByLogin($value);

            return $user_data['id'];
        }

        if ($var_name_from == 'section-name' && $var_name_to == 'section-code') {
            switch ($this->ci->uri->rsegments[2]) {
                case 'profile':
                    $sections = ['view', 'gallery', 'personal', 'subscriptions'];
                    if ($this->ci->pg_module->is_module_installed('wall_events')) {
                        array_unshift($sections, 'wall');
                    }

                    $search_value = false;

                    $langs = $this->ci->pg_language->languages;
                    foreach ($sections as $section) {
                        foreach ($langs as $lid => $lang_data) {
                            if (
                                $value === l(
                                    'filter_section_' . $section,
                                    'users',
                                    $lid
                                )
                            ) {
                                $search_value = $section;
                                break;
                            }
                        }
                        if ($search_value) {
                            break;
                        }
                    }

                    if (!$search_value) {
                        $this->ci->load->model('Field_editor_model');
                        $this->ci->Field_editor_model->initialize($this->form_editor_type);
                        $sections = $this->ci->Field_editor_model->getSectionList([], [], array_keys($langs));
                        foreach ($sections as $section) {
                            foreach ($langs as $lid => $lang_data) {
                                if ($value === $section['name_' . $lid]) {
                                    $search_value = $section['gid'];
                                    break;
                                }
                            }
                            if ($search_value) {
                                break;
                            }
                        }
                    }

                    if (!$search_value) {
                        $search_value = current($sections);
                    }

                    $value = $search_value;
                    break;
                case 'view':
                    $sections = ['profile', 'gallery'];

                    if ($this->ci->pg_module->is_module_installed('wall_events')) {
                        array_unshift($sections, 'wall');
                    }

                    $search_value = false;

                    $langs = $this->ci->pg_language->languages;
                    foreach ($sections as $section) {
                        foreach ($langs as $lid => $lang_data) {
                            if (
                                $value === l(
                                    'filter_section_' . $section,
                                    'users',
                                    $lid
                                )
                            ) {
                                $search_value = $section;
                                break;
                            }
                        }
                        if ($search_value) {
                            break;
                        }
                    }

                    if (!$search_value) {
                        $search_value = current($sections);
                    }

                    $value = $search_value;
                    break;
            }

            return $value;
        }

        show_404();
    }

    public function getSitemapXmlUrls($generate = true, $is_full = true)
    {
        $this->ci->load->helper('seo');

        $lang_canonical = true;

        if ($this->ci->pg_module->is_module_installed('seo')) {
            $lang_canonical = $this->ci->pg_module->get_module_config(
                'seo',
                'lang_canonical'
            );
        }

        if ($lang_canonical) {
            $default_lang_id = $this->ci->pg_language->get_default_lang_id();
            $default_lang_code = $this->ci->pg_language->get_lang_code_by_id($default_lang_id);
            $langs[$default_lang_id] = $default_lang_code;
        } else {
            foreach ($this->ci->pg_language->languages as $lang_id => $lang_data) {
                $langs[$lang_id] = $lang_data['code'];
            }
        }

        $return = [];

        $user_settings = $this->ci->pg_seo->get_settings(
            'user',
            'users',
            'login_form'
        );
        if (!$user_settings['noindex']) {
            $return[] = [
                'url' => rewrite_link(
                    'users',
                    'login_form',
                    [],
                    false,
                    null,
                    $lang_canonical
                ),
                'priority' => 0.4,
            ];
        }

        $user_settings = $this->ci->pg_seo->get_settings(
            'user',
            'users',
            'login_form'
        );
        if (!$user_settings['noindex']) {
            $return[] = [
                'url' => rewrite_link(
                    'users',
                    'registration',
                    [],
                    false,
                    null,
                    $lang_canonical
                ),
                'priority' => 0.4,
            ];
        }

        $user_settings = $this->ci->pg_seo->get_settings(
            'user',
            'users',
            'login_form'
        );
        if (!$user_settings['noindex']) {
            $return[] = [
                'url' => rewrite_link('users', 'search', [], false, null, $lang_canonical),
                'priority' => 0.5,
            ];
        }

        $user_settings = $this->ci->pg_seo->get_settings('user', 'users', 'view');
        if (!$user_settings['noindex']) {
            $criteria = [
                'where' => [
                    'approved' => '1',
                    'confirm' => '1',
                    'activity' => '1',
                    'hide_on_site_end_date <' => date(self::DB_DATE_FORMAT_SEARCH),
                ],
            ];

            $order_array = [
                'up_in_search_end_date' => 'DESC',
                'id' => 'DESC',
            ];

            if ($is_full === true) {
                $users = $this->getUsersList(1, 1000, $order_array, $criteria);
                foreach ($users as $user) {
                    $return[] = [
                        'url' => rewrite_link('users', 'view', $user, false, null, $lang_canonical),
                        'priority' => 0.6,
                        'page' => 'view',
                    ];
                }
            } else {
                $return[] = [
                    'url' => rewrite_link('users', 'view', 'id'),
                    'priority' => 0.6,
                    'page' => 'view',
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

        $users_block = [
            'name' => l('header_profile', 'users'),
            'link' => rewrite_link(
                'users',
                'profile',
                ['section-code' => 'view', 'section-name' => l(
                    'filter_section_view',
                    'users'
                )]
            ),
            'clickable' => ($auth == 'user'),
            'items' => [
                [
                    'name' => l('header_login', 'users'),
                    'link' => rewrite_link('users', 'login_form'),
                    'clickable' => !($auth == 'user'),
                ],
                [
                    'name' => l('link_edit_account', 'users'),
                    'link' => rewrite_link('users', 'account'),
                    'clickable' => ($auth == 'user'),
                ],
                [
                    'name' => l('link_edit_profile', 'users'),
                    'link' => rewrite_link('users', 'profile'),
                    'clickable' => ($auth == 'user'),
                ],
                [
                    'name' => l('header_account_settings', 'users'),
                    'link' => rewrite_link('users', 'settings'),
                    'clickable' => ($auth == 'user'),
                ],
                [
                    'name' => l('header_my_visits', 'users'),
                    'link' => rewrite_link('users', 'my_visits'),
                    'clickable' => ($auth == 'user'),
                ],
                [
                    'name' => l('header_my_guests', 'users'),
                    'link' => rewrite_link('users', 'my_guests'),
                    'clickable' => ($auth == 'user'),
                ],
                [
                    'name' => l('header_find_people', 'users'),
                    'link' => rewrite_link('users', 'search'),
                    'clickable' => ($auth == 'user'),
                ],
            ],
        ];

        if ($this->ci->pg_module->is_module_installed('banners')) {
            $users_block['items'][] = [
                'name' => l('header_my_banners', 'banners'),
                'link' => site_url() . 'users/account/banners',
                'clickable' => ($auth == 'user'),
            ];
        }
        $users_block['items'][] = [
            'name' => l('link_logout', 'users'),
            'link' => site_url() . 'users/logout',
            'clickable' => ($auth == 'user'),
        ];

        $block[] = $users_block;

        return $block;
    }

    // banners callback method
    public function bannerAvailablePages()
    {
        return [
            ['link' => 'users/profile', 'name' => l('header_profile', 'users')],
            ['link' => 'users/login_form', 'name' => l('header_login', 'users')],
            ['link' => 'start/index/registration', 'name' => l('header_register', 'users')],
            ['link' => 'users/account', 'name' => l('link_edit_account', 'users')],
            ['link' => 'users/search', 'name' => l('header_find_people', 'users')],
            ['link' => 'users/ajaxLoadUsers', 'name' => l('header_users_list', 'users')],
            ['link' => 'users/ajax_search', 'name' => l('header_find_people', 'users') . '(ajax)'],
            ['link' => 'users/view', 'name' => l('header_view_profile', 'users')],
        ];
    }

    // moderation functions
    public function moderGetList($object_ids)
    {
        $users = $this->getUsersList(null, null, null, [
            'where_in' => ['id' => $object_ids],
        ]);
        $return = [];
        if (!empty($users)) {
            foreach ($users as $user) {
                $return[$user['id']] = $user;
            }
        }

        return $return;
    }

    public function moderSetStatus($object_id, $status)
    {
        $this->ci->load->model(['Notifications_model', 'Uploads_model', 'Moderation_model']);
        $user = $this->getUserById($object_id, true);
        $backup_user = [];

        switch ($status) {
            case 0:
                $backup_user = [
                    'user_logo_moderation' => '',
                    'user_logo_declined' => $user['user_logo_moderation'],
                ];
                $this->ci->Uploads_model->deleteUpload(
                    $this->upload_config_id,
                    $object_id . '/',
                    $user['user_logo_declined'],
                    self::ORIGINAL_IMG_PATH
                );
                $this->ci->Uploads_model->deleteUpload(
                    $this->upload_config_id,
                    $object_id . '/',
                    $user['user_logo_declined']
                );
                $mtype = $this->ci->Moderation_model->getModerationType($this->moderation_type[0]);
                if ($mtype['mtype'] == 0 || $mtype['mtype'] == 1) {
                    //postmoderation
                    $backup_user['user_logo'] = '';
                    $backup_user['user_logo_declined'] = $user['user_logo'];
                    $this->ci->Uploads_model->deleteUpload(
                        $this->upload_config_id,
                        $object_id . '/',
                        $user['user_logo_declined'],
                        self::ORIGINAL_IMG_PATH
                    );
                    $this->ci->Uploads_model->deleteUpload(
                        $this->upload_config_id,
                        $object_id . '/',
                        $user['user_logo_declined']
                    );

                    if ($user['user_logo_postmoderation']) {
                        //set previously uploaded logo
                        $img_data = $this->ci->Uploads_model->uploadUrl(
                            $this->upload_config_id,
                            $object_id,
                            $this->ci->Uploads_model->getMediaUrl($this->upload_config_id, $object_id)
                            . self::ORIGINAL_IMG_PATH . $user['user_logo_postmoderation']
                        );
                        if (empty($img_data['errors'])) {
                            $backup_user['user_logo'] = $img_data['file'];
                            $backup_user['user_logo_postmoderation'] = '';
                        }
                    }
                }
                break;
            case 1:
                if ($user['user_logo_moderation']) {
                    $file_path = $this->ci->Uploads_model->getMediaPath($this->upload_config_id, $object_id) . self::ORIGINAL_IMG_PATH;
                    $new_path = $this->ci->Uploads_model->getMediaPath($this->upload_config_id, $object_id);

                    $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $object_id . '/', $user['user_logo']);
                    $this->ci->Uploads_model->moveUpload($this->upload_config_id, $file_path, $user['user_logo_moderation'], $new_path);
                    $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $object_id . '/', $user['user_logo_moderation'], self::ORIGINAL_IMG_PATH);
                    $backup_user['user_logo'] = $user['user_logo_moderation'];
                    $backup_user['user_logo_moderation'] = '';
                }
                if ($user['user_logo_postmoderation']) {
                    //after postmoderation approve delete backup logo files
                    $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $object_id . '/', $user['user_logo_postmoderation']);
                    $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $object_id . '/', $user['user_logo_postmoderation'], self::ORIGINAL_IMG_PATH);
                    $backup_user['user_logo_postmoderation'] = '';
                }
                break;
        }
        $this->saveUser($object_id, $backup_user);
    }

    public function addContact($id_user, $id_contact)
    {
        $this->ci->load->model('Linker_model');
        $this->ci->Linker_model->addLink('users_contacts', $id_user, $id_contact);
        $this->ci->Linker_model->addLink('users_contacts', $id_contact, $id_user);
    }

    public function deleteContact($id_user, $id_contact)
    {
        $this->ci->load->model('Linker_model');
        $this->ci->Linker_model->deleteLinks('users_contacts', [
            'where_in' => [
                'id_link_1' => [$id_user, $id_contact],
                'id_link_2' => [$id_user, $id_contact],
            ],
        ]);
    }

    public function deleteUserContacts($id_user)
    {
        $this->ci->load->model('Linker_model');
        $this->ci->Linker_model->deleteLinks('users_contacts', [
            'where' => [
                'id_link_1' => $id_user,
                'id_link_2' => $id_user,
            ],
        ]);
    }

    public function getFulltextData($id, $fields)
    {
        $return = ['main_fields' => [], 'fe_fields' => [],
            'default_lang_id' => $this->ci->pg_language->get_default_lang_id(),
            'object_lang_id' => 1,];
        $this->set_additional_fields($fields);
        $data = $this->getUserById($id);
        $hide_user_names = $this->ci->pg_module->get_module_config(
            'users',
            'hide_user_names'
        );
        $return['object_lang_id'] = $data['lang_id'];
        $return['main_fields'] = [
            'fname' => $hide_user_names ? '' : $data['fname'],
            'sname' => $hide_user_names ? '' : $data['sname'],
            'nickname' => $data['nickname'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'postal_code' => $data['postal_code'],
            'birth_date' => $data['birth_date'],
        ];
        $user_for_location[$data['id']] = [$data['id_country'], $data['id_region'],
            $data['id_city'],];
        $this->ci->load->helper('countries');
        $user_locations = \Pg\modules\countries\helpers\citiesOutputFormat($user_for_location, [], false);
        $return['main_fields']['location'] = (isset($user_locations[$data['id']])) ? $user_locations[$data['id']] : '';

        foreach ($fields as $field) {
            $return['fe_fields'][$field] = $data[$field];
        }

        return $return;
    }

    public function updateAge($filter_object_ids = [])
    {
        if (is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }
        $now_date = date(self::DB_DATE_SIMPLE_FORMAT);
        $this->ci->db->set(
            'age',
            "YEAR('$now_date') - YEAR(birth_date) - IF(RIGHT('$now_date',5) < RIGHT(birth_date,5),1,0)",
            false
        )->update(USERS_TABLE);

        //TODO: cache
        if (is_array($filter_object_ids) && count($filter_object_ids)) {
            foreach ($filter_object_ids as $filter_object_id) {
                $this->ci->cache->delete('users', $filter_object_id);
            }
        } else {
            $this->ci->cache->flush('users');
        }

        return $this->ci->db->affected_rows();
    }

    /**
     * Update user account.
     *
     * @param int $user_id
     * @param float $amount
     *
     * @return void
     */
    public function updateAccount($user_id, $amount)
    {
        $this->ci->db->set('account', 'account + ' . $amount, false);
        $this->ci->db->where('id', $user_id);
        $this->ci->db->update(USERS_TABLE);
    }

    public function getFullYears($birthday)
    {
        $datetime1 = date_create($birthday);
        $datetime2 = date_create();
        $interval = date_diff($datetime1, $datetime2);

        return $interval->format('%y');
    }

    /**
     * User birthday.
     *
     * @param string $birthday
     *
     * @return int
     */
    public static function getUserAge($birthday)
    {
        $birthday_str = strtotime($birthday);
        $day = date('d', $birthday_str);
        $month = date('m', $birthday_str);
        $year = date('Y', $birthday_str);
        if ($month > date('m') || ($month == date('m') && $day > date('d'))) {
            return date('Y') - $year - 1;
        }

        return date('Y') - $year;
    }

    /**
     * User birthday.
     *
     * @param string $year
     *
     * @return int
     */
    public static function getDefaultDateByYear($year)
    {
        // TODO: strtotime('-' . $year .' year')
        return date(self::DB_DATE_SIMPLE_FORMAT, strtotime((date('Y') - $year) . '-' . date('m') . '-' . date('d')));
    }

    public function updateProfileCompletion($filter_object_ids = [])
    {
        $table_fields = $this->ci->db->list_fields(USERS_TABLE);
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->form_editor_type);
        $fe_fields = $this->ci->Field_editor_model->getFieldsList();

        $fields_completion = $this->fields_completion;
        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            $fields_completion[] = 'looking_user_type';
            $fields_completion[] = 'age_min';
            $fields_completion[] = 'age_max';
        }
        foreach ($fe_fields as $fe_field) {
            if (in_array($fe_field['field_name'], $table_fields)) {
                $fields_completion[] = $fe_field['field_name'];
            }
        }

        $fields_count = count($fields_completion);
        $fields_sql = [];
        foreach ($fields_completion as $field) {
            if ($field == 'birth_date') {
                $fields_sql[] = "IF(ISNULL({$field}), 0 , ({$field}!='0000-00-00 00:00:00'))";
            } else {
                $fields_sql[] = "IF(ISNULL({$field}), 0 , ({$field}>''))";
            }
        }

        if (!empty($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in('id', $filter_object_ids);
        }

        if ($fields_sql) {
            $this->ci->db->set(
                'profile_completion',
                'ROUND((' . implode('+', $fields_sql) . ")/{$fields_count}*100)",
                false
            )->update(USERS_TABLE);
        }

        // TODO: cache
        if (!empty($filter_object_ids) && count($filter_object_ids) > 0) {
            foreach ($filter_object_ids as $filter_object_id) {
                $this->ci->cache->delete('users', $filter_object_id);
            }
        } else {
            $this->ci->cache->flush('users');
        }
    }

    public function serviceSetUserActivateInSearch($id_user, $period = null)
    {
        $user = $this->getUserById($id_user);
        if ((int)strtotime($user['activated_end_date']) > time()) {
            $uts = strtotime($user['activated_end_date']);
        } else {
            $uts = time();
        }
        if (!is_null($period)) {
            $data['activated_end_date'] = date(self::DB_DATE_FORMAT, $uts + $period * 60 * 60 * 24);
        } else {
            $data['activated_end_date'] = date(self::DB_DATE_FORMAT, $uts);
        }
        $data['activity'] = '1';

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $this->ci->session->userdata['activity'] = 1;
        }
        $this->saveUser($id_user, $data);

        return $data['activated_end_date'];
    }

    public function serviceSetUsersFeatured($id_user, $period = '')
    {
        $user = $this->getUserById($id_user);
        if (strtotime($user['featured_end_date']) > time()) {
            $uts = strtotime($user['featured_end_date']);
        } else {
            $uts = time();
        }
        if (!is_null($period)) {
            $data['featured_end_date'] = date(
                self::DB_DATE_FORMAT,
                $uts + $period * 60 * 60 * 24
            );
        } else {
            $data['featured_end_date'] = self::DB_DEFAULT_DATE;
        }
        $this->save_user($id_user, $data);

        return $data['featured_end_date'];
    }

    public function isUserFeatured($user_id)
    {
        $this->ci->db->select('featured_end_date')
            ->from(USERS_TABLE)
            ->where('id', $user_id)
            ->where('featured_end_date >', date(self::DB_DATE_FORMAT_SEARCH))
            ->where('UNIX_TIMESTAMP(featured_end_date) >', '86400');
        $results = $this->ci->db->get()->result_array();
        $return = ['is_featured' => 0];
        if (isset($results[0]['featured_end_date'])) {
            $return['is_featured'] = 1;
            $return['featured_end_date'] = $results[0]['featured_end_date'];
        }

        return $return;
    }

    public function isUserActivated($user_id)
    {
        $this->ci->db->select('activated_end_date, (UNIX_TIMESTAMP(activated_end_date) - UNIX_TIMESTAMP())/86400 AS period')
            ->from(USERS_TABLE)
            ->where('id', $user_id)
            ->where('activated_end_date >', date(self::DB_DATE_FORMAT_SEARCH))
            ->where('UNIX_TIMESTAMP(activated_end_date) >', '86400');
        $results = $this->ci->db->get()->row_array();
        $return = ['is_activity' => 0, 'period' => null];
        if (isset($results['activated_end_date'])) {
            $return['is_activity'] = 1;
            $return['activated_end_date'] = $results['activated_end_date'];
            $return['period'] = $results['period'];
        }

        return $return;
    }

    public function serviceSetAdminApprove($user_id)
    {
        $data['approved'] = '1';
        $this->save_user($user_id, $data);
    }

    public function serviceSetHideOnSite($id_user, $period = '')
    {
        $user = $this->getUserById($id_user);
        if (strtotime($user['hide_on_site_end_date']) > 86400) {
            $uts = strtotime($user['hide_on_site_end_date']);
        } else {
            $uts = time();
        }
        if ($period) {
            $data['hide_on_site_end_date'] = date(
                self::DB_DATE_FORMAT,
                $uts + $period * 60 * 60 * 24
            );
        } else {
            $data['hide_on_site_end_date'] = self::DB_DEFAULT_DATE;
        }
        $this->saveUser($id_user, $data);

        return $data['hide_on_site_end_date'];
    }

    public function serviceSetHighlightInSearch($id_user, $period = '')
    {
        $user = $this->getUserById($id_user);
        if (strtotime($user['highlight_in_search_end_date']) > time()) {
            $uts = strtotime($user['highlight_in_search_end_date']);
        } else {
            $uts = time();
        }
        if ($period) {
            $data['highlight_in_search_end_date'] = date(
                self::DB_DATE_FORMAT,
                $uts + $period * 60 * 60 * 24
            );
        } else {
            $data['highlight_in_search_end_date'] = self::DB_DEFAULT_DATE;
        }
        $this->saveUser($id_user, $data);

        return $data['highlight_in_search_end_date'];
    }

    public function serviceSetUpInSearch($id_user, $period = '')
    {
        $user = $this->getUserById($id_user);
        if (strtotime($user['up_in_search_end_date']) > 86400) {
            $uts = strtotime($user['up_in_search_end_date']);
        } else {
            $uts = time();
        }
        if ($period) {
            $data['up_in_search_end_date'] = date(
                self::DB_DATE_FORMAT,
                $uts + $period * 60 * 60 * 24
            );
        } else {
            $data['up_in_search_end_date'] = self::DB_DEFAULT_DATE;
        }
        $this->saveUser($id_user, $data);

        return $data['up_in_search_end_date'];
    }

    public function serviceCronUserActivateInSearch()
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(USERS_TABLE)
            ->where('activated_end_date <', date(self::DB_DATE_FORMAT_SEARCH))
            ->where('UNIX_TIMESTAMP(activated_end_date) >', '86400');
        $results = $this->ci->db->get()->result_array();
        $clean = 0;
        if (!empty($results) && is_array($results) && $results[0]['cnt'] > 0) {
            // TODO: cache - убрать из кэша
            $data['activated_end_date'] = self::DB_DEFAULT_DATE;
            $data['activity'] = '0';
            $this->ci->db->where(
                'activated_end_date <',
                date(self::DB_DATE_FORMAT_SEARCH)
            )
                ->where('UNIX_TIMESTAMP(activated_end_date) >', '86400')
                ->update(USERS_TABLE, $data);
            $clean = $results[0]['cnt'];
        }
        echo 'Make clean(Users activated): ' . $clean . ' Users was deactivated';
    }

    public function serviceCronUsersFeatured()
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(USERS_TABLE)
            ->where('featured_end_date <', date(self::DB_DATE_FORMAT_SEARCH))
            ->where('UNIX_TIMESTAMP(featured_end_date) >', '86400');
        $results = $this->ci->db->get()->result_array();
        $clean = 0;
        if (!empty($results) && is_array($results) && $results[0]['cnt'] > 0) {
            // TODO: cache - убрать из кэша
            $data['featured_end_date'] = self::DB_DEFAULT_DATE;
            $this->ci->db->where(
                'featured_end_date <',
                date(self::DB_DATE_FORMAT_SEARCH)
            )
                ->where('UNIX_TIMESTAMP(featured_end_date) >', '86400')
                ->update(USERS_TABLE, $data);
            $clean = $results[0]['cnt'];
        }
        echo 'Make clean(Users featured): ' . $clean . ' Users was removed';
    }

    public function serviceCronHideOnSite()
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(USERS_TABLE)
            ->where('hide_on_site_end_date <', date(self::DB_DATE_FORMAT_SEARCH))
            ->where('UNIX_TIMESTAMP(hide_on_site_end_date) >', '86400');
        $results = $this->ci->db->get()->result_array();
        $clean = 0;
        if (!empty($results) && is_array($results) && $results[0]['cnt'] > 0) {
            // TODO: cache - убрать из кэша
            $data['hide_on_site_end_date'] = self::DB_DEFAULT_DATE;
            $this->ci->db->where(
                'hide_on_site_end_date <',
                date(self::DB_DATE_FORMAT_SEARCH)
            )
                ->where('UNIX_TIMESTAMP(hide_on_site_end_date) >', '86400')
                ->update(USERS_TABLE, $data);
            $clean = $results[0]['cnt'];
        }
        echo 'Make clean(hide on site): ' . $clean . ' Users was removed';
    }

    public function serviceCronHighlightInSearch()
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(USERS_TABLE)
            ->where(
                'highlight_in_search_end_date <',
                date(self::DB_DATE_FORMAT_SEARCH)
            )
            ->where('UNIX_TIMESTAMP(highlight_in_search_end_date) >', '86400');
        $results = $this->ci->db->get()->result_array();
        $clean = 0;
        if (!empty($results) && is_array($results) && $results[0]['cnt'] > 0) {
            // TODO: cache - убрать из кэша
            $data['highlight_in_search_end_date'] = self::DB_DEFAULT_DATE;
            $this->ci->db->where(
                'highlight_in_search_end_date <',
                date(self::DB_DATE_FORMAT_SEARCH)
            )
                ->where(
                    'UNIX_TIMESTAMP(highlight_in_search_end_date) >',
                    '86400'
                )
                ->update(USERS_TABLE, $data);
            $clean = $results[0]['cnt'];
        }
        echo 'Make clean(highlight in search): ' . $clean . ' Users was removed';
    }

    public function serviceCronUpInSearch()
    {
        $this->ci->db->select('COUNT(*) AS cnt')->from(USERS_TABLE)
            ->where('up_in_search_end_date <', date(self::DB_DATE_FORMAT_SEARCH))
            ->where('UNIX_TIMESTAMP(up_in_search_end_date) >', '86400');
        $results = $this->ci->db->get()->result_array();
        $clean = 0;
        if (!empty($results) && is_array($results) && $results[0]['cnt'] > 0) {
            // TODO: cache - убрать из кэша
            $data['up_in_search_end_date'] = self::DB_DEFAULT_DATE;
            $this->ci->db->where(
                'up_in_search_end_date <',
                date(self::DB_DATE_FORMAT_SEARCH)
            )
                ->where('UNIX_TIMESTAMP(up_in_search_end_date) >', '86400')
                ->update(USERS_TABLE, $data);
            $clean = $results[0]['cnt'];
        }
        echo 'Make clean(up in search): ' . $clean . ' Users was removed';
    }

    public function serviceCronRegionLeader()
    {
        $this->ci->load->model('Services_model');
        $service_data = $this->ci->Services_model->get_service_by_gid('region_leader');
        $write_period = $service_data['data_admin_array']['write_off_period'] * 60 * 60;
        $write_amount = $service_data['data_admin_array']['write_off_amount'];

        $this->ci->db->select('COUNT(*) AS cnt')->from(USERS_TABLE)->where("leader_bid > 0 AND ( UNIX_TIMESTAMP()-UNIX_TIMESTAMP(leader_write_date)>'" . $write_period . "' )");
        $results = $this->ci->db->get()->result_array();
        $clean = 0;
        if (!empty($results) && is_array($results) && $results[0]['cnt'] > 0) {
            $this->ci->db->set('leader_bid', 'leader_bid-' . $write_amount, false);
            $this->ci->db->set('leader_write_date', date(self::DB_DATE_FORMAT));
            $this->ci->db->where("leader_bid > 0 AND ( UNIX_TIMESTAMP()-UNIX_TIMESTAMP(leader_write_date)>'" . $write_period . "' )");
            $this->ci->db->update(USERS_TABLE);
            $clean = $results[0]['cnt'];
        }

        // TODO: cache - убрать из кэша
        $this->ci->db->where('leader_bid < 0');
        $this->ci->db->update(USERS_TABLE, ['leader_bid' => 0]);

        echo 'Reculc bids(Users region leader): ' . $clean . ' users was updated';
    }

    public function getCommonCriteria($data, $is_public_data = true)
    {
        $criteria = [
            'where' => [
                'confirm' => 1,
                'activity' => 1,
                'hide_on_site_end_date <' => date(self::DB_DATE_FORMAT_SEARCH),
            ],
        ];
        if ($is_public_data === true) {
            $criteria['where']['approved'] = 1;
        }
        if ($this->is_couples_installed === true) {
            $criteria['where']['is_coupled !='] = 1;
        }
        if (!empty($data['age_min'])) {
            $criteria['where']['age >='] = intval($data['age_min']);
        }
        if (!empty($data['age_max'])) {
            $criteria['where']['age <='] = intval($data['age_max']);
        }
        if (!empty($data['user_type'])) {
            if (is_array($data['user_type'])) {
                $criteria['where_in']['user_type'] = $data['user_type'];
            } else {
                $criteria['where']['user_type'] = $data['user_type'];
            }
        }
        if (!empty($data['looking_user_type'])) {
            $criteria['where']['looking_user_type'] = $data['looking_user_type'];
        }
        if (!empty($data['online_status']) && $data['online_status']) {
            $criteria['where']['online_status'] = 1;
        }

        if ($this->ci->session->userdata('auth_type') == 'user') {
            $user_id = $this->ci->session->userdata('user_id');
            $criteria['where']['id !='] = $user_id;

            $this->ci->load->model('Blacklist_model');
            if ($blocked_ids = $this->ci->Blacklist_model->getBlockedIds($user_id)) {
                $criteria['where_not_in']['id'] = $blocked_ids;
            }
        }

        if (isset($data['radius']) && !empty($data['radius']) && !empty($data['lat']) && !empty($data['lon'])) {
            $data['distance'] = $data['radius'] / self::METERS_IN_MILE;

            $data['distance'] = intval($data['distance'] * $data['distance']);
            $data['radius'] = $data['radius'] / self::METERS_IN_KM;

            $data['min_lon'] = $data['lon'] - $data['radius'] / abs(cos(deg2rad((float)$data['lat'])) * self::KM_IN_RAD);
            $data['max_lon'] = $data['lon'] + $data['radius'] / abs(cos(deg2rad((float)$data['lat'])) * self::KM_IN_RAD);
            $data['min_lat'] = $data['lat'] - ($data['radius'] / self::KM_IN_RAD);
            $data['max_lat'] = $data['lat'] + ($data['radius'] / self::KM_IN_RAD);

            if (!empty($data['min_lat'])) {
                $criteria['where']['lat >='] = (float)$data['min_lat'];
            }
            if (!empty($data['max_lat'])) {
                $criteria['where']['lat <='] = (float)$data['max_lat'];
            }
            if (!empty($data['min_lon'])) {
                $criteria['where']['lon >='] = (float)$data['min_lon'];
            }
            if (!empty($data['max_lon'])) {
                $criteria['where']['lon <='] = (float)$data['max_lon'];
            }
            if (!empty($data['distance']) && !empty($data['lat']) && !empty($data['lon'])) {
                $criteria['where']['(POW((69.1*(lon - ' . $data['lon'] . ')*cos(' . $data['lat'] . '/57.3)),"2")+POW((69.1*(lat - ' . $data['lat'] . ')),"2")) <='] = $data['distance'];
            }
        } else {
            if (!empty($data['id_country'])) {
                $criteria['where']['id_country'] = $data['id_country'];
            }
            if (!empty($data['id_region'])) {
                $data['id_region'] = intval($data['id_region']);
                $criteria['where']['id_region'] = $data['id_region'];
            }
            if (!empty($data['id_city'])) {
                $data['id_city'] = intval($data['id_city']);
                $criteria['where']['id_city'] = $data['id_city'];
            }
        }

        return $criteria;
    }

    public function getAdvancedSearchCriteria($data)
    {
        $criteria = [];
        if ($this->ci->pg_module->get_module_config('users', 'hide_user_names')) {
            unset($data['fname'], $data['sname']);
        }

        if (!empty($data['fname'])) {
            $criteria['like']['fname'] = trim(strip_tags($data['fname']));
        }
        if (!empty($data['sname'])) {
            $criteria['like']['sname'] = trim(strip_tags($data['sname']));
        }
        if (!empty($data['nickname'])) {
            $criteria['like']['nickname'] = trim(strip_tags($data['nickname']));
        }

        if (!empty($data['id'])) {
            if (is_array($data['id'])) {
                $criteria['where_in']['id'] = $data['id'];
            } else {
                $criteria['where']['id'] = $data['id'];
            }
        }

        return $criteria;
    }

    public function getDefaultSearchData()
    {
        $this->ci->load->model('Properties_model');
        $user_type = $this->ci->session->userdata('user_type');
        $user_types = $this->ci->Properties_model->get_property('user_type');
        if ($user_type !== false && isset($user_types['option'][$user_type])) {
            unset($user_types['option'][$user_type]);
        }
        if (!empty($user_types['option'])) {
            $data['user_type'] = current(array_keys($user_types['option']));
        }
        $data['age_min'] = $this->ci->pg_module->get_module_config('users', 'age_min');
        $data['age_max'] = $this->ci->pg_module->get_module_config('users', 'age_max');
        if ($this->is_couples_installed === true) {
            $data['is_coupled'] = 0;
        }
        $this->ci->load->model('Field_editor_model');
        $this->ci->load->model('field_editor/models/Field_editor_forms_model');
        $this->ci->Field_editor_model->initialize($this->form_editor_type);
        $form = $this->ci->Field_editor_forms_model->getFormByGid($this->advanced_search_form_gid, $this->form_editor_type);
        $form = $this->ci->Field_editor_forms_model->formatOutputForm($form, [], true);
        if ($form['field_data']) {
            foreach ($form['field_data'] as $field_data) {
                if (isset($field_data['field_content']['value'])) {
                    $data[$field_data['field_content']['field_name']] = $field_data['field_content']['value'];
                }
            }
        }

        return $data;
    }

    public function getMinimumSearchData()
    {
        $data['age_min'] = $this->ci->pg_module->get_module_config('users', 'age_min');
        $data['age_max'] = $this->ci->pg_module->get_module_config('users', 'age_max');

        return $data;
    }

    public function updateOnlineStatus($user_id, $status)
    {
        if ($status) {
            $this->ci->db->set('date_last_activity', date(self::DB_DATE_FORMAT))
                ->set('last_ip_addr', $this->ci->input->ip_address())
                ->where('id', $user_id)
                ->update(USERS_TABLE);
        }

        if ($user_id == $this->ci->session->userdata('user_id')) {
            $user_site_status = $this->ci->session->userdata('site_status');
        } else {
            $user = $this->getUserById($user_id);
            $user_site_status = !empty($user['site_status']) ? $user['site_status'] : $status;
        }
        if (!$status) {
            $user_site_status = 0;
        }

        $this->ci->db
            ->set('online_status', $status)
            ->where('id', $user_id)
            ->update(USERS_TABLE);

        if ($this->ci->db->affected_rows()) {
            $this->ci->load->model('users/models/Users_statuses_model');

            $site_statuses = $this->ci->Users_statuses_model->statuses;

            $event_status = isset($site_statuses[$user_site_status]) ? $site_statuses[$user_site_status] : 0;
            if ($event_status) {
                $this->ci->Users_statuses_model->executeCallbacks($event_status, $user_id);
            }

            // TODO: cache
            $this->ci->cache->delete('users', $user_id);
        }

        // Network event
        if ($this->ci->pg_module->is_module_installed('network')) {
            $this->ci->load->model('network/models/Network_events_model');
            $this->ci->Network_events_model->emit(
                $status ? 'active' : 'inactive',
                [
                    'id_user' => $user_id,
                ]
            );
        }
    }

    public function emailValidator($user_data)
    {
        $validator = new SmtpEmailValidator($user_data['email'], 'sender@example.org');
        $results = $validator->validate();

        $data = [
            'checked_email' => 1,
            'valid_email' => 0,
            'last_checked_email_date' => date(self::DB_DATE_FORMAT),
        ];

        if ($results[$user_data['email']]) {
            $data['valid_email'] = 1;
        }

        if (!$data['valid_email']) {
            $this->ci->load->model('notifications/models/Notifications_users_model');
            $this->ci->Notifications_users_model->saveUserNotifications($user_data['id'], null);
        }

        $this->saveUser($user_data['id'], $data);
    }

    public function cronValidateEmails()
    {
        if ($this->pg_module->get_module_config(self::MODULE_GID, 'user_advanced_email_validate')) {
            $where['checked_email'] = '0';
            $users = $this->getUsersList(1, 100, ['id' => 'DESC'], ['where' => $where], null, false);
            foreach ($users as $user) {
                $this->emailValidator($user);
            }
        }
    }

    public function cronBlockInactiveUsers()
    {
        if ($this->pg_module->get_module_config(self::MODULE_GID, 'user_advanced_email_validate')) {
            $where['checked_email'] = '1';
            $where['valid_email'] = '0';
            $where['date_last_activity <'] = date(self::DB_DATE_FORMAT_SEARCH, time() - 60 * 60 * 24 * 180);
            $users = $this->getUsersList(
                1,
                10000,
                null,
                ['where' => $where],
                null,
                false
            );
            $users_ids = [];
            foreach ($users as $user) {
                $users_ids[] = (int)$user['id'];
            }
            if ($users_ids) {
                $this->ci->db->where_in('id', $users_ids)->set('approved', '0')->update(USERS_TABLE);
            }
        }
    }

    public function cronSetOfflineStatus()
    {
        $where['online_status'] = '1';
        $where['date_last_activity <'] = date(self::DB_DATE_FORMAT_SEARCH, time() - 600);
        $where['date_last_activity !='] = self::DB_DEFAULT_DATE;
        $users = $this->getUsersList(
            1,
            10000,
            null,
            ['where' => $where],
            null,
            false
        );
        $users_ids = [];
        foreach ($users as $user) {
            $users_ids[] = (int)$user['id'];
        }
        if ($users_ids) {
            $this->ci->db->where_in('id', $users_ids)->set('online_status', '0')->update(USERS_TABLE);

            // TODO: cache - переделать на обновление
            foreach ($users_ids as $user_id) {
                $this->ci->cache->delete('users', $user_id);
            }

            // Network event
            if ($this->ci->pg_module->is_module_installed('network')) {
                $this->ci->load->model('network/models/Network_events_model');
                foreach ($users_ids as $user_id) {
                    $this->ci->Network_events_model->emit(
                        'inactive',
                        [
                            'id_user' => $user_id,
                        ]
                    );
                }
            }

            $this->ci->load->model('users/models/Users_statuses_model');
            $this->ci->Users_statuses_model->executeCallbacks(0, $users_ids);
        }
    }

    /* SERVICES */

    /**
     * Check service is available.
     *
     * @param int $id_user user identifier
     * @param string $template_gid template guid
     *
     * @return array
     */
    protected function serviceAvailableDefaultAction($id_user, $template_gid)
    {
        $return['available'] = 0;
        $return['content'] = '';
        $return['content_buy_block'] = false;
        $services_available = false;

        if ($this->ci->pg_module->is_module_installed('services')) {
            $this->ci->load->model('services/models/Services_users_model');
            $service_access = $this->ci->Services_users_model->isServiceAccess(
                $id_user,
                $template_gid
            );
            $services_available = (bool)$service_access['use_status'];
        }

        $return['services_available'] = $services_available;

        if ($services_available) {
            $return['content_buy_block'] = true;
        } else {
            $return['content'] = l('service_not_found', 'services');
            $return['available'] = 1;
        }

        return $return;
    }

    public function serviceAvailableHideOnSiteAction($id_user)
    {
        return $this->serviceAvailableDefaultAction(
            $id_user,
            'hide_on_site_template'
        );
    }

    public function serviceAvailableHighlightInSearchAction($id_user)
    {
        return $this->serviceAvailableDefaultAction(
            $id_user,
            'highlight_in_search_template'
        );
    }

    public function serviceAvailableUpInSearchAction($id_user)
    {
        return $this->serviceAvailableDefaultAction(
            $id_user,
            'up_in_search_template'
        );
    }

    public function serviceAvailableAbilityDeleteAction($id_user)
    {
        $result = $this->serviceAvailableDefaultAction($id_user, 'ability_delete_template');
        if ($result['services_available']) {
            $result['available'] = 0;
            $result['content_buy_block'] = true;
            $result['content'] = $this->ci->Services_users_model->availableServiceBlock($id_user, 'ability_delete_template');
        } else {
            $result['available'] = 1;
            $result['content_buy_block'] = false;
            $result['content'] = site_url() . 'users/account_delete';
        }
        $result['gid'] = 'ability_delete';

        return $result;
    }

    public function serviceAvailableUserActivateInSearchAction($id_user)
    {
        $return = ['available' => 0, 'content' => '', 'content_buy_block' => false];
        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }
        $activated = $this->isUserActivated($id_user);
        $this->ci->load->model('Services_model');
        $service = $this->ci->Services_model->getServiceByGid('user_activate_in_search');
        if (!empty($service['status']) && !$activated['is_activity']) {
            $return['content_buy_block'] = true;
        } elseif ($service['status'] == 0) {
            $return['available'] = 1;
        } else {
            $return['activated_end_date'] = $this->serviceSetUserActivateInSearch($id_user, null);
            $return['available'] = 1;
        }

        return $return;
    }

    public function serviceAvailableUsersFeaturedAction()
    {
        $return['available'] = 0;
        $return['content'] = '';
        $return['content_buy_block'] = false;

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }

        $this->ci->load->model('Services_model');
        $services_params = [];
        $services_params['where']['template_gid'] = 'users_featured_template';
        $services_params['where']['status'] = 1;
        $services_count = $this->ci->Services_model->getServiceCount($services_params);
        if ($services_count) {
            $return['content_buy_block'] = true;
        } else {
            $return['content'] = l('service_not_found', 'services');
            $return['available'] = 1;
        }

        return $return;
    }

    public function serviceAvailableAdminApproveAction($id_user)
    {
        $return['available'] = 0;
        $return['content'] = '';
        $return['content_buy_block'] = false;

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }

        $this->ci->load->model('Services_model');
        $services_params = [];
        $services_params['where']['gid'] = 'admin_approve';
        $services_params['where']['status'] = 1;
        $services_count = $this->ci->Services_model->getServiceCount($services_params);
        if ($services_count) {
            $return['content_buy_block'] = true;
        } else {
            $this->serviceSetAdminApprove($id_user);
            $return['available'] = 1;
        }

        return $return;
    }

    public function serviceValidateUserActivateInSearch($user_id, $data, $service_data = [], $price = '')
    {
        return $this->serviceValidate('user_activate_in_search', $user_id, $data, $service_data, $price);
    }

    public function serviceValidateUsersFeatured($user_id, $data, $service_data = [], $price = '')
    {
        return $this->serviceValidate('users_featured', $user_id, $data, $service_data, $price);
    }

    public function serviceValidateAdminApprove($user_id, $data, $service_data = [], $price = '')
    {
        return $this->serviceValidate('admin_approve', $user_id, $data, $service_data, $price);
    }

    public function serviceValidateHideOnSite($user_id, $data, $service_data = [], $price = '')
    {
        return $this->serviceValidate('hide_on_site', $user_id, $data, $service_data, $price);
    }

    public function serviceValidateHighlightInSearch($user_id, $data, $service_data = [], $price = '')
    {
        return $this->serviceValidate('highlight_in_search', $user_id, $data, $service_data, $price);
    }

    public function serviceValidateUpInSearch($user_id, $data, $service_data = [], $price = '')
    {
        return $this->serviceValidate('up_in_search', $user_id, $data, $service_data, $price);
    }

    public function serviceValidateAbilityDelete($user_id, $data, $service_data = [], $price = '')
    {
        return $this->serviceValidate('ability_delete', $user_id, $data, $service_data, $price);
    }

    public function serviceBuyRegionLeader($id_user, $price, $service, $template, $payment_data, $users_package_id = 0, $count = 1)
    {
        $user = $this->getUserById($id_user);
        if ($user['leader_bid'] > 0) {
            $bid = $user['leader_bid'] + $price;
        } else {
            $bid = $price;
        }
        $text = $payment_data['user_data']['text'];

        $data = [
            'leader_bid' => $bid,
            'leader_text' => $text,
            'leader_write_date' => date(self::DB_DATE_FORMAT),
        ];
        $this->saveUser($id_user, $data);

        $this->serviceBuy($id_user, $price, $service, $template, $payment_data, $users_package_id, 0, 0);

        $return['status'] = 1;
        $return['message'] = l('success_service_activating', 'services');

        return $return;
    }

    public function serviceValidateRegionLeader($user_id, $data, $service_data, $price)
    {
        $return = ['errors' => [], 'data' => $data];
        if ($service_data['data_admin_array']['min_bid'] > (float)$price) {
            $return['errors'][] = l(
                'error_service_leader_min_bid_error',
                'users'
            );
        }
        if (empty($data['text'])) {
            $return['errors'][] = l('error_leader_text_is_empty', 'users');
        }

        return $return;
    }

    public function serviceBuy($id_user, $price, $service, $template, $payment_data, $users_package_id
    = 0, $count = 1, $status = 1)
    {
        if ($this->ci->pg_module->is_module_installed('services')) {
            if (!empty($payment_data['id_users_membership'])) {
                $membership_id = (int)$payment_data['id_users_membership'];
            } else {
                $membership_id = 0;
            }
            $this->ci->load->model('services/models/Services_users_model');

            if ($service['gid'] === 'hide_on_site') {
                $this->ci->load->model('users/models/UsersViewsModel');
                $this->ci->UsersViewsModel->deleteByViewerId((int)$id_user);
            }

            return $this->ci->Services_users_model->saveService(null, [
                'id_user' => $id_user,
                'service_gid' => $service['gid'],
                'template_gid' => $template['gid'],
                'service' => $service,
                'template' => $template,
                'payment_data' => $payment_data,
                'id_users_package' => $users_package_id,
                'id_users_membership' => $membership_id,
                'status' => $status,
                'count' => $count,
            ]);
        }

        return false;
    }

    protected function serviceValidate($service_gid, $user_id, $data, $service_data = [], $price = '')
    {
        return ['errors' => [], 'data' => $data];
    }

    public function serviceActivateAbilityDelete($id_user, $id_user_service, $is_ajax = 0)
    {
        $id_user_service = intval($id_user_service);
        $return = ['status' => 0, 'message' => ''];
        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }
        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->getUserServiceById(
            $id_user,
            $id_user_service
        );
        if (empty($user_service) || !$user_service['status']) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $this->deleteUser($id_user);
            $user_service['count']--;
            if ($user_service['count'] < 1) {
                $user_service['status'] = 0;
            }
            $this->ci->Services_users_model->saveService(
                $id_user_service,
                $user_service
            );
            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');

            $auth_type = $this->ci->session->userdata('auth_type');
            if ($auth_type != 'admin') {
                $this->ci->load->model('users/models/Auth_model');
                $this->ci->Auth_model->logoff();
                if (!$is_ajax) {
                    redirect();
                }
            }
        }

        return $return;
    }

    public function serviceActivateAdminApprove($id_user, $id_user_service)
    {
        $id_user_service = intval($id_user_service);
        $return = ['status' => 0, 'message' => ''];
        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }
        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->getUserServiceById(
            $id_user,
            $id_user_service
        );
        if (empty($user_service) || !$user_service['status'] || $user_service['count'] < 1) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $this->serviceSetAdminApprove($id_user);
            $user_service['count']--;
            if ($user_service['count'] < 1) {
                $user_service['status'] = 0;
            }
            $this->ci->Services_users_model->saveService(
                $id_user_service,
                $user_service
            );
            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');
        }

        return $return;
    }

    public function serviceActivateHideOnSite($id_user, $id_user_service)
    {
        $id_user_service = intval($id_user_service);
        $return = ['status' => 0, 'message' => ''];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }

        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->get_user_service_by_id(
            $id_user,
            $id_user_service
        );
        if (empty($user_service) || !$user_service['status'] || $user_service['count'] < 1) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $user_service['date_expired'] = $this->serviceSetHideOnSite(
                $id_user,
                $user_service['service']['data_admin']['period']
            );
            $user_service['count']--;
            if ($user_service['count'] < 1) {
                $user_service['status'] = 0;
            }
            $this->ci->Services_users_model->saveService(
                $id_user_service,
                $user_service
            );
            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');
        }

        return $return;
    }

    public function serviceActivateHighlightInSearch($id_user, $id_user_service)
    {
        $id_user_service = intval($id_user_service);
        $return = ['status' => 0, 'message' => ''];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }

        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->get_user_service_by_id(
            $id_user,
            $id_user_service
        );
        if (empty($user_service) || !$user_service['status'] || $user_service['count'] < 1) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $user_service['date_expired'] = $this->serviceSetHighlightInSearch(
                $id_user,
                $user_service['service']['data_admin']['period']
            );
            $user_service['count']--;
            if ($user_service['count'] < 1) {
                $user_service['status'] = 0;
            }
            $this->ci->Services_users_model->saveService(
                $id_user_service,
                $user_service
            );
            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');
        }

        return $return;
    }

    public function serviceActivateUpInSearch($id_user, $id_user_service, $admin
    = false)
    {
        $id_user_service = intval($id_user_service);
        $return = ['status' => 0, 'message' => ''];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }

        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->get_user_service_by_id(
            $id_user,
            $id_user_service
        );
        if (empty($user_service) || !$user_service['status']) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $user_service['date_expired'] = $this->service_set_up_in_search(
                $id_user,
                $user_service['service']['data_admin']['period']
            );
            $user_service['count']--;
            if ($user_service['count'] < 1) {
                $user_service['status'] = 0;
            }
            $this->ci->Services_users_model->save_service(
                $id_user_service,
                $user_service
            );
            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');
        }

        return $return;
    }

    public function serviceActivateUsersFeatured($id_user, $id_user_service)
    {
        $id_user_service = intval($id_user_service);
        $return = ['status' => 0, 'message' => ''];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }

        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->get_user_service_by_id(
            $id_user,
            $id_user_service
        );
        if (empty($user_service) || !$user_service['status']) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $user_service['date_expired'] = $this->serviceSetUsersFeatured(
                $id_user,
                $user_service['service']['data_admin']['period']
            );
            $user_service['count']--;
            if ($user_service['count'] < 1) {
                $user_service['status'] = 0;
            }
            $this->ci->Services_users_model->save_service(
                $id_user_service,
                $user_service
            );

            $this->userTopEvent($id_user);

            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');
        }

        return $return;
    }

    protected function userTopEvent($id = null)
    {
        if ($this->ci->pg_module->is_module_installed('ratings')) {
            if ($id) {
                $event_handler = EventDispatcher::getInstance();
                $event = new \Pg\modules\ratings\models\events\EventRatings();
                $event_data = [];
                $event_data['id'] = $id;
                $event_data['action'] = 'ratings_top_user';
                $event_data['module'] = 'ratings';
                $event->setData($event_data);
                $event_handler->dispatch($event, 'ratings_top_user');
            }
        }
    }

    public function serviceActivateUserActivateInSearch($id_user, $id_user_service)
    {
        $return = ['status' => 0, 'message' => ''];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $return;
        }

        $this->ci->load->model('services/models/Services_users_model');
        $user_service = $this->ci->Services_users_model->get_user_service_by_id(
            $id_user,
            $id_user_service
        );
        if (empty($user_service) || !$user_service['status']) {
            $return['status'] = 0;
            $return['message'] = l('error_service_activating', 'services');
        } else {
            $user_service['date_expired'] = $this->serviceSetUserActivateInSearch(
                $id_user,
                $user_service['service']['data_admin']['period']
            );
            $user_service['count']--;
            if ($user_service['count'] < 1) {
                $user_service['status'] = 0;
            }
            $this->ci->Services_users_model->save_service(
                $id_user_service,
                $user_service
            );
            $return['status'] = 1;
            $return['message'] = l('success_service_activating', 'services');
        }

        return $return;
    }

    public function serviceStatusHighlightInSearch($user_data)
    {
        $result = ['status' => false, 'service' => [], 'user_service' => []];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $result;
        }

        if (empty($user_data['confirm']) || empty($user_data['approved']) || empty($user_data['activity'])) {
            return $result;
        }

        if (!empty($user_data['is_highlight_in_search'])) {
            return $result;
        }

        $this->ci->load->model(['Services_model', 'services/models/Services_users_model']);

        $result['service'] = $this->ci->Services_model->formatService(
            $this->ci->Services_model->getServiceByGid('highlight_in_search')
        );

        $result['name'] = $result['service']['name'];
        $result['description'] = $result['service']['description'];

        $result['user_service'] = $this->ci->Services_users_model->getServicesList([
            'where' => [
                'service_gid' => 'highlight_in_search',
                'id_user' => $user_data['id'],
                'status' => 1,
                'count >' => 0,
            ],
        ]);

        $result['status'] = (bool)($result['service']['status'] || $result['user_service']);

        return $result;
    }

    public function serviceStatusUpInSearch($user_data)
    {
        $result = ['status' => false, 'service' => [], 'user_service' => []];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $result;
        }

        if (empty($user_data['confirm']) || empty($user_data['approved']) || empty($user_data['activity'])) {
            return $result;
        }

        if (!empty($user_data['is_up_in_search'])) {
            return $result;
        }

        $this->ci->load->model(['Services_model', 'services/models/Services_users_model']);

        $result['service'] = $this->ci->Services_model->formatService(
            $this->ci->Services_model->getServiceByGid('up_in_search')
        );

        $result['name'] = $result['service']['name'];
        $result['description'] = $result['service']['description'];

        $result['user_service'] = $this->ci->Services_users_model->getServicesList([
            'where' => [
                'service_gid' => 'up_in_search',
                'id_user' => $user_data['id'],
                'status' => 1,
                'count >' => 0,
            ],
        ]);

        $result['status'] = (bool)($result['service']['status'] || $result['user_service']);

        return $result;
    }

    public function serviceStatusHideOnSite($user_data)
    {
        $result = ['status' => false, 'service' => [], 'user_service' => []];

        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $result;
        }

        if (empty($user_data['id']) || !empty($user_data['is_hide_on_site'])) {
            return $result;
        }

        $this->ci->load->model(['Services_model', 'services/models/Services_users_model']);

        $result['service'] = $this->ci->Services_model->formatService(
            $this->ci->Services_model->getServiceByGid('hide_on_site')
        );

        $result['name'] = $result['service']['name'];
        $result['description'] = $result['service']['description'];

        $result['user_service'] = $this->ci->Services_users_model->getServicesList([
            'where' => [
                'service_gid' => 'hide_on_site',
                'id_user' => $user_data['id'],
                'status' => 1,
                'count >' => 0,
            ],
        ]);
        $result['status'] = (bool)($result['service']['status'] || $result['user_service']);

        return $result;
    }

    public function serviceStatusUsersFeatured($user_data)
    {
        $result = ['status' => false, 'service' => [], 'user_service' => []];
        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $result;
        }
        if (empty($user_data['confirm']) || empty($user_data['approved'])) {
            return $result;
        }

        $this->ci->load->model(['Services_model', 'services/models/Services_users_model']);

        $result['service'] = $this->ci->Services_model->formatService(
            $this->ci->Services_model->getServiceByGid(self::FEATURED_SERVICE)
        );

        if (!empty($result['service'])) {
            $result['name'] = $result['service']['name'];
            $result['description'] = $result['service']['description'];
        }

        $result['user_service'] = $this->ci->Services_users_model->getServicesList([
            'where' => [
                'service_gid' => self::FEATURED_SERVICE,
                'id_user' => $user_data['id'],
                'status' => 1,
                'count >' => 0,
            ],
        ]);

        if (!empty($result['service'])) {
            $result['status'] = (bool)($result['service']['status'] || $result['user_service']);
        } else {
            $result['status'] = (bool)($result['user_service']);
        }

        return $result;
    }

    public function serviceStatusActivateInSearch($user_data)
    {
        $result = ['status' => false, 'service' => [], 'user_service' => []];
        if (!$this->ci->pg_module->is_module_installed('services')) {
            return $result;
        }
        if (empty($user_data['confirm']) || empty($user_data['approved'])) {
            return $result;
        }

        $this->ci->load->model(['Services_model', 'services/models/Services_users_model']);

        $result['service'] = $this->ci->Services_model->formatService(
            $this->ci->Services_model->getServiceByGid('user_activate_in_search')
        );

        $result['name'] = $result['service']['name'];
        $result['description'] = $result['service']['description'];

        $result['user_service'] = $this->ci->Services_users_model->getServicesList([
            'where' => [
                'service_gid' => 'user_activate_in_search',
                'id_user' => $user_data['id'],
                'status' => 1,
                'count >' => 0,
            ],
        ]);
        $result['status'] = (bool)($result['service']['status'] || $result['user_service']);

        return $result;
    }

    public function servicesStatus($user_data)
    {
        if (!$this->ci->pg_module->is_module_installed('services')) {
            return ['status' => false, 'service' => [], 'user_service' => []];
        }

        $this->ci->load->model('Services_model');
        $this->ci->Services_model->cacheAllServices();

        return [
            'highlight_in_search' => $this->serviceStatusHighlightInSearch($user_data),
            'up_in_search' => $this->serviceStatusUpInSearch($user_data),
            'hide_on_site' => $this->serviceStatusHideOnSite($user_data),
            'users_featured' => $this->serviceStatusUsersFeatured($user_data),
            'user_activate_in_search' => $this->serviceStatusActivateInSearch($user_data),
        ];
    }

    public function commentsCountCallback($count, $id)
    {
        $attrs['logo_comments_count'] = $count;
        $this->save_user($id, $attrs);
    }

    public function commentsObjectCallback()
    {
        return [];
    }

    /**
     * Callback for spam module.
     *
     * @param string $action action name
     * @param int $user_ids user identifiers
     *
     * @return string
     */
    public function spamCallback($action, $data)
    {
        switch ($action) {
            case 'ban':
                $this->saveUser((int)$data, ['banned' => 1]);

                return 'banned';
            case 'unban':
                $this->saveUser((int)$data, ['banned' => 0]);

                return 'unbanned';
            case 'delete':
                $this->deleteUser((int)$data);

                return 'removed';
            case 'get_content':
                if (empty($data)) {
                    return [];
                }
                $new_data = [];
                $return = [];
                foreach ($data as $id) {
                    if (
                        ($this->getUsersCount(['where_in' => [
                            'id' => $id,]])) == 0
                    ) {
                        $return[$id]['content']['view'] = $return[$id]['content']['list']
                            = "<span class='spam_object_delete'>" . l(
                                'error_is_deleted_users_object',
                                'spam'
                            ) . '</span>';
                        $return[$id]['user_content'] = l(
                            'author_unknown',
                            'spam'
                        );
                    } else {
                        $new_data[] = $id;
                    }
                }
                $users = $this->getUsersList(
                    null,
                    null,
                    null,
                    null,
                    (array)$new_data
                );
                foreach ($users as $user) {
                    $return[$user['id']]['content']['list'] = $return[$user['id']]['content']['view']
                        = '<a href="' . site_url() . 'admin/users/edit/personal/' . $user['id'] . '">' . $user['output_name'] . '</a>, ' . $user['user_type_str'];
                    $return[$user['id']]['user_content'] = $user['output_name'];
                }

                return $return;
            case 'get_subpost':
                return [];
            case 'get_link':
                if (empty($data)) {
                    return [];
                }
                $users = $this->getUsersList(
                    null,
                    null,
                    null,
                    null,
                    (array)$data
                );
                $return = [];
                foreach ($users as $user) {
                    $return[$user['id']] = site_url() . 'admin/users/edit/personal/' . $user['id'];
                }

                return $return;
            case 'get_deletelink':
                return [];
            case 'get_object':
                if (empty($data)) {
                    return [];
                }
                $users = $this->getUsersListByKey(
                    null,
                    null,
                    null,
                    null,
                    (array)$data
                );

                return $users;
        }
    }

    /**
     * Set callback
     * @param int $id_user
     * @param array $callbacks_gid
     * @return void
     */
    protected function setCallbacks(int $id_user, array $callbacks_gid)
    {
        $data = $this->getUserById($id_user);
        if (empty($data['id']) || in_array('users_delete', $callbacks_gid, true)) {
            $this->callbackUserDelete($id_user, '', $callbacks_gid);
        } else {
            $this->ci->load->model('users/models/Users_delete_callbacks_model');
            $this->ci->Users_delete_callbacks_model->executeCallbacks($id_user, $callbacks_gid);
        }
    }

    public function callbackUserDelete($id_user, $callback_type, $callbacks_gid)
    {
        $data = $this->getUserById($id_user);

        if (
            $this->is_couples_installed === true &&
            $data['user_type'] === 'couple' && (int)$data['is_coupled'] !== 1
        ) {
            $data['couple'] = $this->getUserById($data['couple_id']);
        }

        if (!empty($data['id'])) {
            $this->ci->db->where('id', $id_user);
            $this->ci->db->delete(USERS_TABLE);
            if (empty($data['net_is_incomer']) && $this->ci->pg_module->is_module_installed('network')) {
                $this->ci->load->model('network/models/Network_users_model');
                $this->ci->Network_users_model->userDeleted($data);
            }
            $this->ci->cache->delete('users', $id_user);
            $this->ci->load->model('Uploads_model');
            if ($data['user_logo_moderation']) {
                $this->ci->Uploads_model->deleteUpload(
                    $this->upload_config_id,
                    $id_user . '/',
                    $data['user_logo_moderation'],
                    self::ORIGINAL_IMG_PATH
                );
                $this->ci->Uploads_model->deleteUpload(
                    $this->upload_config_id,
                    $id_user . "/",
                    $data['user_logo_moderation']
                );
            }
            if ($data['user_logo']) {
                $this->ci->Uploads_model->deleteUpload(
                    $this->upload_config_id,
                    $id_user . '/',
                    $data['user_logo'],
                    self::ORIGINAL_IMG_PATH
                );
                $this->ci->Uploads_model->deleteUpload(
                    $this->upload_config_id,
                    $id_user . "/",
                    $data['user_logo']
                );
            }

            // delete moderation
            $this->ci->load->model(['Moderation_model', 'Payments_model']);
            $this->ci->Moderation_model->deleteModerationItemByObj($this->moderation_type[0], $id_user);
            $this->ci->Moderation_model->declineModerationData($id_user);
            $this->ci->Payments_model->declinePaymentsData($id_user);

            if ($this->ci->pg_module->is_module_installed('associations')) {
                $this->ci->load->model('Associations_model');
                $this->ci->Associations_model->callbackUserDelete($id_user);
            }

            if ($this->ci->pg_module->is_module_installed('questions')) {
                $this->ci->load->model('Questions_model');
                $this->ci->Questions_model->callbackUserDelete($id_user);
            }

            if ($this->ci->pg_module->is_module_installed('winks')) {
                $this->ci->load->model('Winks_model');
                $this->ci->Winks_model->callbackUserDelete($id_user);
            }

            if ($this->ci->pg_module->is_module_installed('friendlist')) {
                $this->ci->load->model('Friendlist_model');
                $this->ci->Friendlist_model->callbackUserDelete($id_user);
            }

            if ($this->ci->pg_module->is_module_installed('banners')) {
                $this->ci->load->model('Banners_model');
                $this->ci->Banners_model->declineBannersData($id_user);
            }

            // delete user connections
            if ($this->ci->pg_module->is_module_installed('users_connections')) {
                $this->ci->load->model('Users_connections_model');
                $this->ci->Users_connections_model->deleteUserConnections($id_user);
            }

            // delete im messages
            if ($this->ci->pg_module->is_module_installed('im')) {
                $this->ci->load->model('im/models/Im_messages_model');
                $this->ci->Im_messages_model->deleteMessageByUserId($id_user);
            }

            // delete perfect_match
            if ($this->ci->pg_module->is_module_installed('perfect_match')) {
                $this->ci->load->model('Perfect_match_model');
                $this->ci->Perfect_match_model->callbackUserDelete($id_user);
            }

            $this->deleteUserContacts($id_user);
        } else {
            $data['id'] = $id_user;
        }

        // save deleted user
        $this->ci->load->model('users/models/Users_deleted_model');
        $data['callbacks'] = $callbacks_gid;
        $this->ci->Users_deleted_model->saveDeletedUser($data);

        if (
            $this->is_couples_installed === true &&
            $data['user_type'] === 'couple' && (int)$data['is_coupled'] !== 1
        ) {
            $this->callbackUserDelete($data['couple']['id'], $callback_type, $callbacks_gid);
        }
    }

    public function clearUserContentCron()
    {
        $this->ci->load->model(['users/models/Users_deleted_model', 'users/models/Users_delete_callbacks_model']);
        $user_ids = $this->ci->Users_deleted_model->getAllUsersId(0);
        foreach ($user_ids as $id_user) {
            $callbacks_gid = $this->ci->Users_deleted_model->getUserCallbackGid($id_user, 0);
            $this->ci->Users_delete_callbacks_model->executeCallbacks($id_user, $callbacks_gid);
            $this->ci->Users_deleted_model->setStatusDeleted($id_user, 1);
        }
    }

    public function handlerActive($data)
    {
        return $this->updateOnlineStatus($data['id_user'], 1);
    }

    public function handlerInactive($data)
    {
        return $this->updateOnlineStatus($data['id_user'], 0);
    }

    /**
     * Return available user types.
     *
     * @param bool $only_code only type code
     * @param int $lang_id language identifier
     *
     * @return array
     */
    public function getUserTypesFromProperties($only_code = false, $lang_id = null)
    {
        if (empty($lang_id)) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $this->ci->load->model('Properties_model');
        $user_types = $this->ci->Properties_model->getProperty('user_type', $lang_id);

        if ($only_code) {
            return array_keys($user_types['option']);
        }

        return $user_types;
    }

    /**
     * Return user type by default.
     *
     * @return string
     */
    public function getUserTypeDefault()
    {
        $user_types = $this->getUserTypes(true);
        if (empty($user_types)) {
            return '';
        }

        return current($user_types);
    }

    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        $this->ci->load->model('users/models/Groups_model');
        $this->ci->Groups_model->langDedicateModuleCallbackAdd($lang_id);
    }

    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return false;
        }

        $this->ci->db->where('lang_id', $lang_id)->update(USERS_TABLE, [
            'lang_id' => $this->ci->pg_language->get_default_lang_id(),
        ]);
        $this->ci->cache->flush('users');

        $this->ci->load->model('users/models/Groups_model');
        $this->ci->Groups_model->langDedicateModuleCallbackDelete($lang_id);

        return true;
    }

    /**
     * Install user fields of ratings.
     *
     * @param array $fields fields data
     *
     * @return void
     */
    public function installRatingsFields($fields = [])
    {
        if (empty($fields)) {
            return;
        }
        $this->ci->load->dbforge();
        $table_fields = $this->ci->db->list_fields(USERS_TABLE);
        foreach ((array)$fields as $field_name => $field_data) {
            if (!in_array($field_name, $table_fields)) {
                $this->ci->dbforge->add_column(
                    USERS_TABLE,
                    [$field_name => $field_data]
                );
            }
        }

        // TODO: cache
        $this->ci->cache->flush('users');
    }

    /**
     * Uninstall fields of ratings.
     *
     * @param array $fields fields data
     *
     * @return void
     */
    public function deinstallRatingsFields($fields = [])
    {
        if (empty($fields)) {
            return;
        }
        $this->ci->load->dbforge();
        $table_fields = $this->ci->db->list_fields(USERS_TABLE);
        foreach ($fields as $field_name) {
            if (in_array($field_name, $table_fields)) {
                $this->ci->dbforge->drop_column(USERS_TABLE, $field_name);
            }
        }

        // TODO: cache
        $this->ci->cache->flush('users');
    }

    /**
     * Process event of ratings module.
     *
     * @param string $action action name
     * @param array $data ratings data
     *
     * @return mixed
     */
    public function callbackRatings($action, $data)
    {
        switch ($action) {
            case 'update':
                $user_data['rating_type'] = $data['type_gid'];
                $user_data['rating_sorter'] = $data['rating_sorter'];
                $user_data['rating_value'] = $data['rating_value'];
                $user_data['rating_count'] = $data['rating_count'];
                $this->saveUser($data['id_object'], $user_data);
                break;
            case 'get_object':
                if (empty($data)) {
                    return [];
                }
                $users = $this->getUsersListByKey(
                    null,
                    null,
                    null,
                    null,
                    (array)$data
                );

                return $users;
                break;
        }
    }

    public function getRatingObjectById($id, $formatted = false, $safe_format
    = false)
    {
        $result = $this->ci->db->select(implode(', ', $this->fields_all))
            ->from(USERS_TABLE)
            ->where('id', $id)
            ->get()->result_array();
        if (empty($result)) {
            return false;
        } elseif ($formatted) {
            return $this->formatUser($result[0], $safe_format);
        }

        return $result[0];
    }

    public function getUsersByIds($fields, $user_ids)
    {
        return $this->getUsersList(null, null, null, ['fields' => $fields], $user_ids, false);
    }

    public function reFormatUsers($data)
    {
        if (!empty($data)) {
            $this->ci->load->model('Field_editor_model');
            $this->ci->Field_editor_model->initialize($this->form_editor_type);
            $fe_fields = $this->ci->Field_editor_model->getFieldsList();

            $fields_additional = ['id'];
            foreach ($fe_fields as $fe_field) {
                $fields_additional[] = $fe_field['field_name'];
            }

            foreach ($data as $user) {
                $ids[] = $user['id'];
            }

            $results = $this->getUsersByIds($fields_additional, $ids);

            $additional_results = [];
            foreach ($results as $key => $value) {
                foreach ($fields_additional as $field_additional) {
                    $additional_results[$value['id']][$field_additional] = $value[$field_additional];
                }
            }

            foreach ($data as $key => $user) {
                if (isset($additional_results[$user['id']])) {
                    $data[$key] = array_merge($user, $additional_results[$user['id']]);
                }
            }

            return $data;
        }

        return [];
    }

    /**
     *  Demo user.
     *
     * @param array $user
     *
     * @return array
     */
    public function demoUser(array $user)
    {
        return array_merge($user, $this->demo_user);
    }

    public function getVisit($user_id)
    {
        $result = $this->ci->db
            ->select()
            ->from(USERS_SITE_VISIT_TABLE)
            ->where('user_id', $user_id)
            ->where('date', date(self::DB_DATE_SIMPLE_FORMAT))
            ->get()
            ->result_array();
        if (empty($result)) {
            return false;
        }

        return $result[0];
    }

    public function setVisit($user_id)
    {
        $this->ci->db->onDuplicate(USERS_SITE_VISIT_TABLE, [
            'user_id' => $user_id,
            'date' => date(self::DB_DATE_SIMPLE_FORMAT)
        ]);
    }

    public function userSiteVisitEvent($id = null)
    {
        if ($id) {
            $event_handler = EventDispatcher::getInstance();
            $event = new EventUsers();
            $event_data = [];
            $event_data['id'] = $id;
            $event_data['action'] = 'users_site_visit';
            $event_data['module'] = self::MODULE_GID;
            $event->setData($event_data);
            $event_handler->dispatch($event, 'users_site_visit');
        }
    }

    public function bonusCounterCallback($counter = [])
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventUsers();
        $event->setData($counter);
        $event_handler->dispatch($event, 'bonus_counter');
    }

    public function bonusActionCallback($data = [])
    {
        $counter = [];
        if (!empty($data)) {
            $counter = $data['counter'];
            $action = $data['action'];
            $counter['is_new_counter'] = $data['is_new_counter'];
            $counter['repetition'] = $data['bonus']['repetition'];
            if ($action['action'] == 'users_site_visit') {
                if (isset($counter['date_modified'])) {
                    $last_date = strtotime(date_format(date_create($counter['date_modified']), self::DB_DATE_SIMPLE_FORMAT));
                    $cur_date = strtotime(date(self::DB_DATE_SIMPLE_FORMAT));
                    $gap_time = $cur_date - $last_date;
                    if ($gap_time > 86400) {
                        $counter['count'] = 1;
                    } else {
                        $counter['count'] = $counter['count'] + 1;
                    }
                } else {
                    $counter['count'] = 1;
                }
            }
            if ($action['action'] == 'users_add_location') {
                $counter['count'] = 1;
            }
            if ($action['action'] == 'users_add_profile_logo') {
                $counter['count'] = 1;
            }
            if ($action['action'] == 'users_update_user_profile') {
                $user = $this->getUserById($counter['id_user']);
                $counter['count'] = $user['profile_completion'];
            }

            $this->bonusCounterCallback($counter);
        }
    }

    public function updateUserProfile($id = null)
    {
        if ($id) {
            $user_before = $this->profile_before;
            $user_after = $this->profile_after;
            $this->profile_before = null;
            $this->profile_after = null;

            if ($user_after['user_logo'] != $user_before['user_logo']) {
                $this->addProfileLogo($id);
            }

            if ($user_after['id_country'] && $user_after['id_region']) {
                $this->addLocation($id);
            }
            $event_handler = EventDispatcher::getInstance();
            $event = new EventUsers();
            $event_data = [];
            $event_data['id'] = $id;
            $event_data['action'] = 'users_update_user_profile';
            $event_data['module'] = self::MODULE_GID;
            $event->setData($event_data);
            $event_handler->dispatch($event, 'users_update_user_profile');
        }
    }

    public function addProfileLogo($id = null)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventUsers();
        $event_data = [];
        $event_data['id'] = $id;
        $event_data['action'] = 'users_add_profile_logo';
        $event_data['module'] = self::MODULE_GID;
        $event->setData($event_data);
        $event_handler->dispatch($event, 'users_add_profile_logo');
    }

    public function addLocation($id = null)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventUsers();
        $event_data = [];
        $event_data['id'] = $id;
        $event_data['action'] = 'users_add_location';
        $event_data['module'] = self::MODULE_GID;
        $event->setData($event_data);
        $event_handler->dispatch($event, 'users_add_location');
    }

    public function formatDashboardRecords($data)
    {
        $format_data = $this->formatUsers($data);
        foreach ($format_data as $key => $value) {
            $this->ci->view->assign('data', $value);
            $format_data[$key]['type']['module'] = self::MODULE_GID;
            $format_data[$key]['content'] = $this->ci->view->fetch('dashboard', 'admin', 'users');
        }

        return $format_data;
    }

    public function getDashboardData($user_id, $status)
    {
        $is_processed = false;

        if (in_array($status, $this->processed_statuses) === true) {
            $is_processed = true;
        } elseif ($status == self::STATUS_SAVED && isset($this->profile_before['status']) && $this->profile_before['status'] == 1 && isset($this->profile_after['status']) && $this->profile_after['status'] == 0) {
            $is_processed = true;
        }

        if (!$is_processed) {
            return false;
        }

        if (!empty($this->profile_after)) {
            $data = $this->profile_after;
        } else {
            $data = $this->getUserById($user_id);
        }
        if ($data['confirm'] == 0) {
            $data['dashboard_header'] = 'header_moderation_user_confirm';
            $data['dashboard_action_link'] = 'admin/users/index/not_confirm/';
            $data['dashboard_action_name'] = 'link_user_action';
        } else {
            $data['dashboard_header'] = 'header_moderation_user_status';
            $data['dashboard_action_link'] = 'admin/users/index/not_active/';
            $data['dashboard_action_name'] = 'link_user_action';
        }

        return $data;
    }

    public function getDashboardOptions($user_id)
    {
        $data = !empty($this->profile_after) ? $this->profile_after : $this->getUserById($user_id);

        return [
            'dashboard_header' => 'header_moderation_user_logo',
            'dashboard_action_link' => 'admin/moderation/index/',
            'dashboard_action_name' => 'link_user_action',
            'fname' => $data['fname'],
            'sname' => $data['sname'],
            'nickname' => $data['nickname'],
        ];
    }

    /**
     * Add roles to user.
     *
     * @param mixed $user User id or array of user data including roles
     * @param array $new_roles
     *
     * @return array
     */
    public function addRoles($user, array $new_roles)
    {
        if (is_int($user)) {
            $db_user = $this->getUserById($user);
            $user = $this->saveUser(
                $db_user['id'],
                [
                    'roles' => array_unique(array_merge(
                        $this->rolesDecode($db_user['roles']),
                        $new_roles
                    )),
                ]
            );
        } else {
            $user['roles'] = array_unique(array_merge(
                $this->rolesDecode($user['roles']),
                $new_roles
            ));
        }

        return $user;
    }

    /**
     * Get user roles.
     *
     * @param int $user_id
     *
     * @return array
     */
    public function getUserRoles($user_id)
    {
        $data = ($user = $this->getUserById($user_id)) ? $this->rolesDecode($user['roles']) : ['guest'];

        return $this->formatUserRoles($data, $user['user_type']);
    }

    /**
     * Format roles.
     *
     * @param array $roles
     *
     * @return array
     */
    protected function formatUserRoles($roles, $user_type)
    {
        $format = [];
        if ($this->ci->pg_module->is_module_installed('access_permissions')) {
            $this->ci->load->model('Access_permissions_model');
            $format = $this->ci->Access_permissions_model->formatRoles($roles, $user_type);
            if (!empty($format['errors']) && $this->ci->session->userdata('auth_type') !== 'admin') {
                $this->system_messages->addMessage(\Pg\Libraries\View::MSG_ERROR, $format['errors']);
                $this->ci->load->model('users/models/Auth_model');
                $this->ci->Auth_model->logoff();
                redirect();
            }
        }

        return !empty($format) ? $format : $roles;
    }

    /**
     * Decode roles.
     *
     * @param string $roles
     *
     * @return array
     * @throws \InvalidArgumentException
     *
     */
    protected function rolesDecode($roles)
    {
        if (is_string($roles)) {
            $roles = explode(',', $roles);
        } elseif (!is_array($roles)) {
            throw new \InvalidArgumentException('(users) Wrong roles format');
        }

        return $roles;
    }

    /**
     * Encode roles.
     *
     * @param array $roles
     *
     * @return string
     * @throws \InvalidArgumentException
     *
     */
    protected function rolesEncode($roles)
    {
        if (is_array($roles)) {
            $roles = implode(',', $roles);
        } elseif (!is_string($roles)) {
            throw new \InvalidArgumentException('(users) Wrong roles format');
        }

        return $roles;
    }

    /**
     * User registration.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function registerUser(array $data)
    {
        $user_id = (int)$this->saveUser(null, $data, 'user_icon');
        $data['id'] = $user_id;
        if (empty($user_id)) {
            return false;
        }
        if (empty($data['nickname'])) {
            $this->simplyUpdateUser($user_id, [
                'nickname' => str_pad((string)$user_id, 5, '0', STR_PAD_LEFT),
            ]);
        }
        $this->ci->session->set_userdata('is_reg', 1);
        $this->ci->load->model('users/models/Groups_model');
        if ((int)$this->ci->Groups_model->isTrialGroup() === 1) {
            $this->ci->load->model('Access_permissions_model');
            $group = $this->ci->Groups_model->getTrialGroup();
            $this->ci->Access_permissions_model->applyGroup($group, $user_id);

            /*print_r($group); exit;*/
            $user_service['date_expired'] = $this->serviceSetHideOnSite(
                $user_id,
                10
            );
        }
        $this->setGroupServices($user_id);
        $this->addToNetwork($user_id, $data['net_user_decision'] ?? 'unknown');

        $event = new EventUsers();
        $event->setSearchFrom($user_id);
        $event->setData($data);
        EventDispatcher::getInstance()->dispatch($event, 'user_register');

        return $user_id;
    }

    /**
     * Set default group services.
     *
     * @param type $user_id
     *
     * @return void
     */
    public function setGroupServices($user_id)
    {
        if ($this->ci->pg_module->is_module_installed('access_permissions')) {
            $this->ci->load->model(['Access_permissions_model',
                'access_permissions/models/Access_permissions_groups_model',
                'access_permissions/models/Access_permissions_modules_model',]);
            $group = $this->ci->Access_permissions_groups_model->getGroupByGid(
                \Pg\modules\access_permissions\models\AccessPermissionsGroupsModel::DEFAULT_GROUP
            );
            $this->ci->Access_permissions_model->updateServicesByGroup($group, $user_id);
        }
    }

    /**
     * Add to network.
     *
     * @param int $user_id
     * @param string $status
     *
     * @return void
     */
    public function addToNetwork(int $user_id, string $status)
    {
        if ($this->ci->pg_module->is_module_installed('network')) {
            if ($this->ci->pg_module->is_module_active('network')) {
                $this->ci->load->model('Network_model');
                $network_requirements = $this->ci->Network_model->validateRequirementsCli();
                $is_set = [];
                foreach ($network_requirements['data'] as $requirement) {
                    $is_set[] = $requirement['value'];
                }
                $value_set = array_search('No', $is_set);
                if ($value_set === false) {
                    $this->ci->load->model('network/models/Network_users_model');
                    $this->ci->Network_users_model->saveUserDecision($user_id, $status);
                }
            }
        }
    }

    /**
     * Save view count.
     *
     * @paran integer $count number of available actions
     *
     * @return void
     */
    public function setViewCount($count)
    {
        if ($count > 0) {
            $this->ci->pg_module->set_module_config(self::MODULE_GID, 'guest_view_profile_limit', 1);
            $this->ci->pg_module->set_module_config(self::MODULE_GID, 'guest_view_profile_num', $count);
        } else {
            $this->ci->pg_module->set_module_config(self::MODULE_GID, 'guest_view_profile_limit', 0);
        }
    }

    /**
     * Site view user checker.
     *
     * @param array $data
     *
     * @return void
     */
    public static function siteVisits($data)
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventUsers();
        $event->setSiteVisits($data['user_agent']);
        $event_handler->dispatch($event, 'visits');
    }

    public function backendGetAccount($params)
    {
        $this->id_user = $params['id_user'];
        $results = [];
        foreach ($params['user'] as $user) {
            // TODO: убрать после приведения к PSR
            if (!method_exists($this, $user)) {
                $chunks = explode('_', $user);
                $user = array_shift($chunks);
                foreach ($chunks as $chunk) {
                    $user .= ucfirst($chunk);
                }

                if (!method_exists($this, $user)) {
                    continue;
                }
            }

            // TODO: refactor to use modules own methods
            $results[$user] = $this->$user();
        }

        return $results;
    }

    public function getAccount()
    {
        $user_id = $this->ci->session->userdata('user_id');

        $ci = &get_instance();

        $result = $ci->db->select('account')
            ->from(USERS_TABLE)
            ->where('id', $user_id)
            ->get()->result_array();

        if (empty($result)) {
            return 0;
        }

        return $result[0];
    }

    public function saveSettings($settings)
    {
        foreach ($settings as $config_gid => $value) {
            $this->ci->pg_module->set_module_config('users', $config_gid, $value);

            if ($config_gid == 'user_approve' && $this->ci->pg_module->is_module_installed('services')) {
                $this->ci->load->model('Services_model');
                $service_raw = $this->ci->Services_model->getServiceByGid('admin_approve');
                if ($value == 2) {
                    $this->ci->Services_model->activateService($service_raw['id']);
                } else {
                    $this->ci->Services_model->deactivateService($service_raw['id']);
                }
            }
        }
    }

    /**
     * Validate user settings.
     *
     * @param array $settings
     *
     * @return array
     */
    public function validateSettings($settings)
    {
        $return = ['data' => $settings];
        if ($settings['age_min'] >= $settings['age_max']) {
            $return['errors'][] = l('field_age_min', self::MODULE_GID) . ' > ' . l('field_age_max', self::MODULE_GID);
        } elseif ($settings['age_min'] < 0) {
            $return['errors'][] = l('field_age_min', self::MODULE_GID) . ' > 0';
        }

        return $return;
    }

    public function registrationSettings()
    {
        return [
            'is_perfect_match' => $this->pg_module->is_module_installed('perfect_match'),
            'age_min' => $this->pg_module->get_module_config(self::MODULE_GID, 'age_min'),
            'age_max' => $this->pg_module->get_module_config(self::MODULE_GID, 'age_max'),
            'use_repassword' => $this->pg_module->get_module_config(self::MODULE_GID, 'use_repassword'),
        ];
    }

    public function checkGuestAccess($profile_id, $viewer_id)
    {
        if (!empty($viewer_id)) {
            // Not guest
            return true;
        } elseif (!$this->ci->pg_module->get_module_config('users', 'guest_view_profile_limit')) {
            // Guest; unlimited
            return true;
        }

        // Guest; limited
        $cookie = [
            'name' => 'profiles_viewed',
            'expire' => 604800, // 1 week
            'domain' => COOKIE_SITE_SERVER,
            'path' => '/' . SITE_SUBFOLDER,
        ];

        $this->ci->load->helper('cookie');

        $allowed_views = $this->ci->pg_module->get_module_config('users', 'guest_view_profile_num');
        if (empty($allowed_views)) {
            set_cookie(array_merge($cookie, ['value' => []]));

            return false;
        }

        $curr_cookie = get_cookie('profiles_viewed');
        if (empty($curr_cookie)) {
            $viewed_arr = [];
        } else {
            $viewed_arr = unserialize($curr_cookie);
        }

        if ($this->ci->pg_module->get_module_config('users', 'guest_view_profile_count_only_diff')) {
            $viewed_count = count(array_keys($viewed_arr));
        } else {
            $viewed_count = array_sum($viewed_arr);
        }

        if ($viewed_count >= $allowed_views) {
            return false;
        }
        if (!isset($viewed_arr[$profile_id])) {
            $viewed_arr[$profile_id] = 1;
        } else {
            $viewed_arr[$profile_id]++;
        }
        $cookie['value'] = serialize($viewed_arr);
        set_cookie($cookie);

        return true;
    }

    /**
     * Is service activation data.
     *
     * @param string $gid
     *
     * @return array
     */
    public function isActiveService(string $gid)
    {
        $this->ci->load->model('Services_model');
        $service = $this->ci->Services_model->getServiceByGid($gid);
        if ($service['status']) {
            return ['status' => 1];
        }
        $this->setUserActivity($this->ci->session->userdata('user_id'), 1);

        return [
            'status' => 0,
            'success' => l('success_activate_user', self::MODULE_GID),
        ];
    }

    /**
     * Count Users Registration.
     *
     * @return void
     */
    public function cronCountUsersRegistration()
    {
        $this->ci->load->model(['Ausers_model', 'Notifications_model']);
        $email = $this->ci->pg_module->get_module_config('notifications', 'mail_from_email');
        $name = $this->ci->Ausers_model->getUserById(1)['output_name'];
        $count = $this->getUsersCount(['where' => [
            'date_created >=' => date(self::DB_DATE_FORMAT_SEARCH, time() - 3600 * 6),
        ]]);
        $this->ci->Notifications_model->sendNotification($email, 'users_count_registration', [
            'count' => $count,
            'name' => $name,
        ]);
    }

    /**
     * Format user name.
     *
     * @param array $data
     *
     * @return string
     */
    public static function formatUserName(array $data = []): string
    {
        return $data['output_name'] ?? $data['nickname'];
    }

    public function getModerationIdsByUserId($user_id): array
    {
        return [$user_id];
    }

    /**
     * Get list
     *
     * @param array $params
     *
     * @return array
     */
    public function getList(array $params): array
    {
        if (!empty($params['fields'])) {
            $this->setAdditionalFields($params['fields']);
        }

        $fields = $this->fields_all;
        $get_data_callback = function ($resort_by_keys = false) use ($fields, $params) {
            $ci = &get_instance();

            $ci->db->select(implode(', ', $fields))
                ->from(USERS_TABLE);

            if (isset($params['where'])) {
                foreach ($params['where'] as $field => $value) {
                    $ci->db->where($field, $value);
                }
            }

            if (isset($params['like'])) {
                foreach ($params['like'] as $field => $value) {
                    $ci->db->like($field, $value);
                }
            }

            if (isset($params['where_in'])) {
                foreach ($params['where_in'] as $field => $value) {
                    $ci->db->where_in($field, $value);
                }
            }

            if (isset($params['where_not_in'])) {
                foreach ($params['where_not_in'] as $field => $value) {
                    $ci->db->where_not_in($field, $value);
                }
            }

            if (isset($params['where_sql'])) {
                foreach ($params['where_sql'] as $value) {
                    $ci->db->where($value, null, false);
                }
            }

            if (!empty($params['filter_object_ids'])) {
                $ci->db->where_in('id', $params['filter_object_ids']);
            }

            if (is_array($params['order_by'])) {
                foreach ($params['order_by'] as $field => $dir) {
                    if (in_array($field, $fields) || $field == 'fields') {
                        $ci->db->order_by($field . ' ' . $dir);
                    }
                }
            } else {
                $ci->db->order_by($params['order_by']);
            }

            if (!empty($params['items_on_page'])) {
                $page = $params['page'] ?: 1;
                $ci->db->limit($params['items_on_page'], $params['items_on_page'] * ($page - 1));
            }

            $results_raw = $ci->db->get()->result_array();

            if (empty($results_raw) || !is_array($results_raw)) {
                return [];
            }

            if ($resort_by_keys) {
                $results = [];

                foreach ($results_raw as $result_raw) {
                    $results[$result_raw['id']] = $result_raw;
                }
            } else {
                $results = $results_raw;
            }

            return $results;
        };

        if (!empty($params['filter_object_ids'])) {
            $results = $this->ci->cache->mget('users', $params['filter_object_ids'], $get_data_callback);
        } else {
            $results = $get_data_callback();
        }

        return $results;
    }

    /**
     * Update
     *
     * @param array $attrs
     * @param array $params
     *
     * @return void
     */
    public function update(array $attrs, array $params)
    {
        if (!empty($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (!empty($params['like'])) {
            foreach ($params['like'] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }

        if (!empty($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (!empty($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $field => $value) {
                $this->ci->db->where_not_in($field, $value);
            }
        }

        if (!empty($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        foreach ($attrs as $field => $value) {
            $is_escape = true;
            if (isset($params['is_not_escape'])) {
                $is_escape = in_array($field, $params['is_not_escape']) === false;
            }
            $this->ci->db->set($field, $value, $is_escape);
        }

        $this->ci->db->update(USERS_TABLE);

        $this->ci->cache->flush('users');
    }

    /**
     * @param string $name
     * @param array $args
     *
     * @return type
     * @throws \Exception
     *
     */
    public function __call($name, $args)
    {
        $methods = [
            '_banner_available_pages' => 'bannerAvailablePages',
            '_moder_get_list' => 'moderGetList',
            '_moder_set_status' => 'moderSetStatus',
            'add_contact' => 'addContact',
            'callback_ratings' => 'callbackRatings',
            'activate_user' => 'activateUser',
            'callback_user_delete' => 'callbackUserDelete',
            'check_available_user_activation' => 'checkAvailableUserActivation',
            'clear_user_content_cron' => 'clearUserContentCron',
            'comments_count_callback' => 'commentsCountCallback',
            'comments_object_callback' => 'commentsObjectCallback',
            'cron_block_inactive_users' => 'cronBlockInactiveUsers',
            'cron_set_offline_status' => 'cronSetOfflineStatus',
            'cron_validate_emails' => 'cronValidateEmails',
            'deinstall_ratings_fields' => 'deinstallRatingsFields',
            'delete_contact' => 'deleteContact',
            'delete_user' => 'deleteUser',
            'delete_user_contacts' => 'deleteUserContacts',
            'format_default_user' => 'formatDefaultUser',
            'format_user' => 'formatUser',
            'format_users' => 'formatUsers',
            'get_active_users' => 'getActiveUsers',
            'get_active_users_count' => 'getActiveUsersCount',
            'get_active_users_list' => 'getActiveUsersList',
            'get_active_users_types_count' => 'getActiveUsersTypesCount',
            'get_advanced_search_criteria' => 'getAdvancedSearchCriteria',
            'get_all_users_id' => 'getAllUsersId',
            'get_common_criteria' => 'getCommonCriteria',
            'get_default_search_data' => 'getDefaultSearchData',
            'get_featured_users' => 'getFeaturedUsers',
            'get_fulltext_data' => 'getFulltextData',
            'get_minimum_search_data' => 'getMinimumSearchData',
            'get_new_users' => 'getNewUsers',
            'get_rating_object_by_id' => 'getRatingObjectById',
            'get_seo_settings' => 'getSeoSettings',
            'get_sitemap_urls' => 'getSitemapUrls',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'get_user_by_confirm_code' => 'getUserByConfirmCode',
            'get_user_by_email' => 'getUserByEmail',
            'get_user_by_email_password' => 'getUserByEmailPassword',
            'get_user_by_id' => 'getUserById',
            'get_user_by_login' => 'getUserByLogin',
            're_format_users' => 'reFormatUsers',
            'request_seo_rewrite' => 'requestSeoRewrite',
            'service_activate_ability_delete' => 'serviceActivateAbilityDelete',
            'service_activate_admin_approve' => 'serviceActivateAdminApprove',
            'service_activate_hide_on_site' => 'serviceActivateHideOnSite',
            'service_activate_highlight_in_search' => 'serviceActivateHighlightInSearch',
            'service_activate_up_in_search' => 'serviceActivateUpInSearch',
            'service_activate_user_activate_in_search' => 'serviceActivateUserActivateInSearch',
            'service_activate_users_featured' => 'serviceActivateUsersFeatured',
            'service_available_ability_delete_action' => 'serviceAvailableAbilityDeleteAction',
            'service_available_admin_approve_action' => 'serviceAvailableAdminApproveAction',
            'service_available_hide_on_site_action' => 'serviceAvailableHideOnSiteAction',
            'service_available_highlight_in_search_action' => 'serviceAvailableHighlightInSearchAction',
            'service_available_up_in_search_action' => 'serviceAvailableUpInSearchAction',
            'service_available_user_activate_in_search_action' => 'serviceAvailableUserActivateInSearchAction',
            'service_available_users_featured_action' => 'serviceAvailableUsersFeaturedAction',
            'service_buy' => 'serviceBuy',
            'service_buy_region_leader' => 'serviceBuyRegionLeader',
            'service_cron_hide_on_site' => 'serviceCronHideOnSite',
            'service_cron_highlight_in_search' => 'serviceCronHighlightInSearch',
            'service_cron_region_leader' => 'serviceCronRegionLeader',
            'service_cron_up_in_search' => 'serviceCronUpInSearch',
            'service_cron_user_activate_in_search' => 'serviceCronUserActivateInSearch',
            'service_cron_users_featured' => 'serviceCronUsersFeatured',
            'service_set_admin_approve' => 'serviceSetAdminApprove',
            'service_set_hide_on_site' => 'serviceSetHideOnSite',
            'service_set_highlight_in_search' => 'serviceSetHighlightInSearch',
            'service_set_up_in_search' => 'serviceSetUpInSearch',
            'service_set_user_activate_in_search' => 'serviceSetUserActivateInSearch',
            'service_set_users_featured' => 'serviceSetUsersFeatured',
            'service_status_activate_in_search' => 'serviceStatusActivateInSearch',
            'service_status_hide_on_site' => 'serviceStatusHideOnSite',
            'service_status_highlight_in_search' => 'serviceStatusHighlightInSearch',
            'service_status_up_in_search' => 'serviceStatusUpInSearch',
            'service_status_users_featured' => 'serviceStatusUsersFeatured',
            'service_validate_ability_delete' => 'serviceValidateAbilityDelete',
            'service_validate_admin_approve' => 'serviceValidateAdminApprove',
            'service_validate_hide_on_site' => 'serviceValidateHideOnSite',
            'service_validate_highlight_in_search' => 'serviceValidateHighlightInSearch',
            'service_validate_region_leader' => 'serviceValidateRegionLeader',
            'service_validate_up_in_search' => 'serviceValidateUpInSearch',
            'service_validate_user_activate_in_search' => 'serviceValidateUserActivateInSearch',
            'set_additional_fields' => 'setAdditionalFields',
            'get_user_by_login_password' => 'getUserByLoginPassword',
            'get_user_by_open_id' => 'getUserByOpenId',
            'get_user_type_default' => 'getUserTypeDefault',
            'get_user_types' => 'getUserTypesFromProperties',
            'get_users_count' => 'getUsersCount',
            'get_users_list' => 'getUsersList',
            'get_users_list_by_key' => 'getUsersListByKey',
            'handler_active' => 'handlerActive',
            'handler_inactive' => 'handlerInactive',
            'install_ratings_fields' => 'installRatingsFields',
            'is_user_activated' => 'isUserActivated',
            'is_user_featured' => 'isUserFeatured',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'set_user_activity' => 'setUserActivity',
            'set_user_approve' => 'setUserApprove',
            'service_validate_users_featured' => 'serviceValidateUsersFeatured',
            'services_status' => 'servicesStatus',
            'set_user_confirm' => 'setUserConfirm',
            'set_user_output_name' => 'setUserOutputName',
            'update_age' => 'updateAge',
            'simply_update_user' => 'simplyUpdateUser',
            'spam_callback' => 'spamCallback',
            'update_online_status' => 'updateOnlineStatus',
            'update_profile_completion' => 'updateProfileCompletion',
            'update_user_status' => 'updateUserStatus',
            'save_user' => 'saveUser',
            'backend_get_account' => 'backendGetAccount',
            'get_account' => 'getAccount',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
