<?php

declare(strict_types=1);

namespace Pg\modules\network\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\network\models\events\EventNetwork;

define('NET_TEMP_TABLE', DB_PREFIX . 'net_temp');

/**
 * Network users model
 *
 * @package PG_Dating
 * @subpackage application
 * @category modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class NetworkUsersModel extends NetworkModel
{
    public const ACTION_ADD = 'add';
    public const ACTION_UPDATE = 'update';
    public const ACTION_REMOVE = 'remove';
    public const DECISION_AGREE = 'agree';
    public const DECISION_DISAGREE = 'disagree';
    public const DECISION_UNKNOWN = 'unknown';
    public const PROFILE_DATA_FIELD = 'about_me';
    public const PROFILE_DATA_DELIMITER = ': ';
    public const STATUS_NOT_AGREE = 'not_agree';
    public const STATUS_READY = 'ready';
    public const STATUS_PROCESSED = 'processed';
    public const STATUS_ERROR = 'error';
    public const STATUS_OK = 'ok';
    public const TYPE_IN = 'in';
    public const TYPE_OUT = 'out';
    public const VALUE_ALL = 'all';
    public const DATE_FORMAT = 'Y-m-d';
    public const MODERATION_TYPE = 'network_data';

    private static $users_fields = [
        'net_id',
        'net_status',
        'net_info',
        'net_is_incomer',
        'net_user_decision',
    ];
    private $process_temp_time_limit = 60;
    private $process_temp_limit = [
        self::ACTION_ADD => 5,
        self::ACTION_UPDATE => 5,
        self::ACTION_REMOVE => 15,
    ];
    // local field  => net field
    private $profile_data_assoc = [
        'body' => 'body_type',
        'hair' => 'hair_colour',
        'height' => 'height',
        'weight' => 'weight',
    ];
    private $network_cache = [];
    private $check_net_id_uniqueness = true;
    private $fe_fields = [];
    private $skip_action = [];
    public $cfg_filter = [
        'site_type',
        'user_type',
        'orientation',
        'lang',
        'land',
        'country_code',
        'min_age',
        'max_age',
    ];
    private $cfg_settings_limits = 'settings_limits';
    private $cfg_profile_data_limits = 'profile_data_limits';
    private $cfg_temp_processing_limits = 'temp_processing_limits';
    private $common_user_data = [];
    public $db_fields = [
        'id',
        'net_id',
        'local_id',
        'action',
        'type',
        'data',
        'created',
    ];
    public $net_fields_validation = [
        'id' => [
            'type' => 'int',
            'required' => true,
        ],
        'email' => [
            'type' => 'string',
            'required' => true,
        ],
        'user_type' => [
            'type' => 'string',
            'values' => [
                'male',
                'female',
                'transgender',
            ],
            'required' => true,
        ],
        'nickname' => [
            'type' => 'string',
            'required' => true,
        ],
        'fname' => [
            'type' => 'string',
            'required' => false,
        ],
        'sname' => [
            'type' => 'string',
            'required' => false,
        ],
        'lang' => [
            'type' => 'string',
            'required' => true,
        ],
        'icon' => [
            'type' => 'string',
            'required' => true,
        ],
        'country_code' => [
            'type' => 'string',
            'required' => true,
        ],
        'region' => [
            'type' => 'string',
            'required' => true,
        ],
        'city' => [
            'type' => 'string',
            'required' => true,
        ],
        'postal_code' => [
            'string' => 'string',
            'required' => false,
        ],
        'latitude' => [
            'type' => 'decimal',
            'required' => false,
        ],
        'longitude' => [
            'type' => 'decimal',
            'required' => false,
        ],
        'birth_date' => [
            'type' => 'date',
            'required' => true,
        ],
        'photos' => [
            'type' => 'array',
            'required' => false,
        ],
        'profile_data' => [
            'type' => 'array',
            'required' => false,
            'values' => [
                'headline' => [
                    'type' => 'string',
                    'maxlength' => 255,
                ],
                'description' => [
                    'type' => 'string',
                    'maxlength' => 1000,
                ],
                'marital_status' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'occupation' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'purpose' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'race' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'religion' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'height' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'weight' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'body_type' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'eye_colour' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'hair_colour' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'want_children' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'have_children' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'education' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'smoking_habits' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'drinking_habits' => [
                    'type' => 'string',
                    'maxlength' => 100,
                ],
                'hobby' => [
                    'type' => 'string',
                    'maxlength' => 1000,
                ],
            ],
        ],
    ];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('Users_model');
        $this->common_user_data = [
            'confirm' => true,
            'approved' => true,
            'activity' => true,
            'net_status' => self::STATUS_OK,
            'confirm_code' => '',
        ];
        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            $this->net_fields_validation['looking_user_type'] = [
                'type' => ['string', 'array'],
                'values' => ['male', 'female', 'transgender'],
                'required' => true
            ];
            $this->net_fields_validation['age_min'] = [
                'type' => 'int',
                'required' => false,
            ];
            $this->net_fields_validation['age_max'] = [
                'type' => 'int',
                'required' => false,
            ];
        }
    }

    public static function getUsersFields(array $fields)
    {
        return array_merge($fields, self::$users_fields);
    }

    /**
     * Prohibit the processing of the next action.
     *
     * @param string $action
     */
    private function forbidAction($action)
    {
        $this->skip_action[$action] = true;

        return $this;
    }

    /**
     * Check whether the actions processing is allowed or not.
     * If not, allow it.
     *
     * @param string $action
     *
     * @return boolean
     */
    private function isActionForbidden($action)
    {
        if (!empty($this->skip_action[$action])) {
            $this->skip_action[$action] = false;

            return true;
        }

        return false;
    }

    /**
     * Initialize field editor module
     */
    private function initFieldEditor()
    {
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->ci->Users_model->form_editor_type);
        $this->fe_fields = $this->ci->Field_editor_model->get_fields_list();
        foreach ($this->fe_fields as $fe_field) {
            $fields_for_select[] = $fe_field['field_name'];
        }
        $this->ci->Users_model->setAdditionalFields($fields_for_select);
    }

    /**
     * Process user data before creation
     *
     * @param array $user
     *
     * @return array
     */
    public function preCreate(array $user)
    {
        if (!isset($user['net_status'])) {
            $user['net_status'] = self::STATUS_READY;
        }

        return $user;
    }

    /**
     * Get local id by net id
     *
     * @param int $net_id
     *
     * @return int
     */
    public function getLocalIdByNet($net_id)
    {
        if (empty($this->network_cache['local_id'][$net_id])) {
            $results = $this->ci->db->select('id')
                ->from(USERS_TABLE)
                ->where('net_id', $net_id)
                ->get()->result_array();
            if (empty($results)) {
                $this->network_cache['local_id'][$net_id] = 0;
            } else {
                $result = array_shift($results);
                $this->network_cache['local_id'][$net_id] = (int)$result['id'];
            }
        }

        return $this->network_cache['local_id'][$net_id];
    }

    /**
     * Get net id by local id
     *
     * @param int $local_id
     *
     * @return int
     */
    public function getNetIdByLocal($local_id)
    {
        if (empty($this->network_cache['net_id'][$local_id])) {
            $results = $this->ci->db->select('net_id')
                ->from(USERS_TABLE)
                ->where('id', $local_id)
                ->get()->result_array();
            if (empty($results)) {
                $this->network_cache['net_id'][$local_id] = 0;
            } else {
                $result = array_shift($results);
                $this->network_cache['net_id'][$local_id] = (int)$result['net_id'];
            }
        }

        return $this->network_cache['net_id'][$local_id];
    }

    /**
     * Get users from database
     *
     * @param int $count
     *
     * @return array
     */
    public function getProfiles($count = 1)
    {
        // TODO: Переделать через NET_TEMP_TABLE (или не переделать)
        $this->initFieldEditor();
        $params = [
            'where' => [
                'net_id' => '0',
                'net_status' => self::STATUS_READY,
                'user_logo !=' => '',
            ],
        ];
        $users = $this->ci->Users_model->getUsersList(
            1,
            $count,
            null,
            $params,
            [],
            true,
            false,
            ''
        );
        $formatted_users = [];
        foreach ($users as $user) {
            $formatted_users[] = $this->formatUserOut($user);
        }

        return $formatted_users;
    }

    /**
     * Get temp records
     *
     * @param int|array $net_id
     * @param int|array $local_id
     * @param string|array $action
     * @param string|array $type
     * @param array $args
     *
     * @return array
     */
    public function getTempRecords($net_id = null, $local_id = null, $action = null, $type
    = null, $args = null)
    {
        $this->ci->db->select($args ?: $this->db_fields)->from(NET_TEMP_TABLE);
        foreach (['net_id', 'local_id', 'action', 'type'] as $field) {
            if (empty($$field)) {
                continue;
            }
            if (is_array($$field)) {
                $this->ci->db->where_in($field, array_unique($$field));
            } else {
                $this->ci->db->where($field, $$field);
            }
        }

        return $this->ci->db->order_by('created')->get()->result_array();
    }

    /**
     * Delete temp record
     *
     * @param int|array $net_id
     * @param int|array $local_id
     * @param string|array $action
     * @param string|array $type
     *
     * @return boolean
     */
    public function deleteTempRecords($net_id = null, $local_id = null, $action
    = null, $type = null)
    {
        foreach (['net_id', 'local_id', 'action', 'type'] as $field) {
            if (empty($$field)) {
                continue;
            }
            if (is_array($$field)) {
                $this->ci->db->where_in($field, array_unique($$field));
            } else {
                $this->ci->db->where($field, $$field);
            }
        }
        $this->ci->db->delete(NET_TEMP_TABLE);

        return true;
    }

    /**
     * Format temp profile
     *
     * @param array $user
     * @param string $type
     *
     * @return array
     */
    private function formatTempProfile(array $user, $type)
    {
        if (!empty($user['id'])) {
            if (self::TYPE_OUT === $type) {
                $local_id = (int)$user['id'];
            } elseif (self::TYPE_IN === $type) {
                $net_id = (int)$user['id'];
            }
        }
        if (empty($net_id)) {
            if (isset($user['net_id'])) {
                $net_id = (int)$user['net_id'];
            } else {
                $net_id = 0;
            }
        }
        if (empty($user['net_id'])) {
            $user['net_id'] = $net_id;
        }
        if (empty($local_id)) {
            if (isset($user['local_id'])) {
                $local_id = (int)$user['local_id'];
            } else {
                $local_id = 0;
            }
        }
        if (empty($user['local_id'])) {
            $user['local_id'] = $local_id;
        }
        if (!empty($net_id) && self::TYPE_OUT === $type) {
            $user['id'] = $net_id;
        } elseif (!empty($local_id) && self::TYPE_IN === $type) {
            $user['id'] = $local_id;
        }

        return $user;
    }

    /**
     * Check temp record before insertion
     *
     * @param array $temp_record
     */
    private function checkTempRecord(array $temp_record)
    {
        if (self::TYPE_IN === $temp_record['type']) {
            if (self::ACTION_REMOVE === $temp_record['action'] || self::ACTION_ADD === $temp_record['action']) {
                // Check uniqueness
                return !(bool)$this->getTempRecords(
                    $temp_record['net_id'],
                    null,
                    $temp_record['action'],
                    self::TYPE_IN,
                    ['id']
                );
            }
        }

        return true;
    }

    /**
     * Add temp record
     *
     * @param array $users
     * @param string $action
     * @param string $type
     * @param int $batch_max_size
     *
     * @return array
     */
    public function setTempProfiles(array $users, $action, $type, $batch_max_size
    = 50)
    {
        $temp_records = [];
        $batch = [];
        $profiles_count = count($users);
        for ($i = 0, $batch_size = 0; $i < $profiles_count; $i++, $batch_size++) {
            $profile = $this->formatTempProfile($users[$i], $type);
            $temp_record = [
                'net_id' => $profile['net_id'],
                'local_id' => $profile['local_id'],
                'data' => serialize($profile),
                'action' => $action,
                'type' => $type,
            ];
            if (!$this->checkTempRecord($temp_record)) {
                continue;
            }
            $batch[] = $temp_record;
            if ($batch_size > $batch_max_size || $i === $profiles_count - 1) {
                $this->ci->db->insert_batch(NET_TEMP_TABLE, $batch);
                $temp_records = array_merge($temp_records, $batch);
                $batch = [];
                $batch_size = 0;
            }
        }

        return $temp_records;
    }

    /**
     * User deleted callback
     *
     * @param array $user
     *
     * @return array
     */
    public function userDeleted($user)
    {
        if ($this->isActionForbidden(self::ACTION_REMOVE) || (empty($user['id']) && empty($user['net_id']))) {
            return $user;
        }
        $args = [
                'id' => FILTER_VALIDATE_INT,
                'net_id' => FILTER_VALIDATE_INT,
            ];
        $net_data = filter_var_array($user, $args);

        return $this->setTempProfiles(
            [$net_data],
            self::ACTION_REMOVE,
            self::TYPE_OUT
        );
    }

    /**
     * User updated callback
     *
     * @param int $local_id
     * @param array $new_user_data
     *
     * @return array
     */
    public function userUpdated($local_id, array $new_user_data/* , $merge = true */)
    {
        if ($this->isActionForbidden(self::ACTION_UPDATE)) {
            return $new_user_data;
        }
        // TODO: Проверять, изменились ли поля
        if (!empty($local_id) && empty($new_user_data['net_is_incomer'])) {
            $this->initFieldEditor();
            $result = $this->ci->db->select(['net_id', 'net_is_incomer'])
                ->from(USERS_TABLE)
                ->where('id', $local_id)
                ->get()->result_array();
            if (empty($result)) {
                return $new_user_data;
            }
            $net_data = $result[0];
            $net_data['id'] = (int)$local_id;
            if (empty($net_data['net_is_incomer']) && !empty($net_data['net_id'])) {
                $net_user = $this->formatUserOut(array_merge(
                    $new_user_data,
                    $net_data
                ));
                $this->setTempProfiles(
                    [$net_user],
                    self::ACTION_UPDATE,
                    self::TYPE_OUT
                );

                return $net_user;
            }
        }

        return $new_user_data;
    }

    /**
     * Parse users to form an array of statuses
     *
     * @param array $users
     *
     * @return array
     */
    private function prepareStatuses(array $users)
    {
        if (empty($users)) {
            return [];
        }
        $errors_ds = $this->ci->pg_language->ds->get_reference(
            self::MODULE_GID,
            'error',
            $this->ci->pg_language->get_default_lang_id()
        );
        $errors_keys = array_keys($errors_ds['option']);
        $statuses = [];
        $info = [];
        $success = [];
        foreach ($users as $local_id => $status) {
            if ($status > 0) {
                $success[$status] = [(int)$local_id];
                $info_txt = (string)time();
                $status = self::STATUS_OK;
            } elseif (in_array($status, $errors_keys)) {
                $info_txt = $status;
                $status = self::STATUS_ERROR;
            } else {
                $info_txt = '';
            }
            $info[$info_txt][] = $local_id;
            $statuses[$status][] = $local_id;
        }

        return ['id' => $success, 'status' => $statuses, 'info' => $info];
    }

    /**
     * Build sql query to update net statuses at the users table
     *
     * @param array $users
     *
     * @return string
     */
    private function buildStatusesQuery(array $users)
    {
        $statuses = $this->prepareStatuses($users);
        if (empty($statuses)) {
            return '';
        }
        $users_ids = [];
        $start_sql = 'UPDATE `' . USERS_TABLE . '` SET';
        foreach ($statuses as $status => $data) {
            if (empty($data)) {
                continue;
            }
            $mid_sql[$status] = PHP_EOL . '`net_' . $status . '` = CASE' . PHP_EOL;
            foreach ($data as $key => $users) {
                $mid_sql[$status] .= " WHEN `id` IN('" . implode("','", $users) . "') THEN '$key'" . PHP_EOL;
                $users_ids = array_merge($users_ids, $users);
            }
            $mid_sql[$status] .= 'END';
        }
        if (empty($users_ids)) {
            return '';
        }
        $end_sql = PHP_EOL . " WHERE `id` IN ('" . implode(
            "','",
            array_unique($users_ids)
        ) . "');" . PHP_EOL;

        return $start_sql . implode(',', $mid_sql) . $end_sql;
    }

    /**
     * Update net statuses at users table
     *
     * @param array $users
     *
     * @return boolean
     */
    public function setProfilesStatus(array $users)
    {
        $query = $this->buildStatusesQuery($users);
        if (!empty($query)) {
            $result = (bool)$this->ci->db->query($query);
            $this->updateLastId();

            return $result;
        }

        return false;
    }

    /**
     * Get last net id
     *
     * @return int
     */
    public function getLastId()
    {
        return $this->getLastIdCfg() ?:
            $this->getLastIdNewProfiles() ?:
                $this->getLastIdUsers();
    }

    /**
     * Update last net id from parameter or on the basis of available data.
     *
     * @param int $last_id
     *
     * @return int last net id
     */
    public function updateLastId($last_id = null)
    {
        if (empty($last_id) && 0 !== $last_id) {
            $last_id = $this->getLastIdNewProfiles();
            if (empty($last_id)) {
                $last_id = $this->getLastIdUsers();
            }
        }
        if (empty($last_id)) {
            $last_id = 0;
        }
        $this->ci->pg_module->set_module_config(
            self::MODULE_GID,
            'last_id',
            $last_id
        );

        return $last_id;
    }

    /**
     * Get the last net id from net_temp table
     *
     * @return int
     */
    private function getLastIdNewProfiles()
    {
        $results = $this->ci->db->select('MAX(net_id) as last_id')
            ->from(NET_TEMP_TABLE)
            ->get()->result_array();
        if (empty($results)) {
            return 0;
        }
        $result = array_shift($results);

        return (int)$result['last_id'];
    }

    /**
     * Get the last net id from users table
     *
     * @return int
     */
    private function getLastIdUsers()
    {
        $results = $this->ci->db->select('MAX(net_id) as last_id')
            ->from(USERS_TABLE)
            ->get()->result_array();
        if (empty($results)) {
            return 0;
        }
        $result = array_shift($results);

        return (int)$result['last_id'];
    }

    /**
     * Get last net id from module config
     *
     * @return int
     */
    private function getLastIdCfg()
    {
        return (int)$this->ci->pg_module->get_module_config(
            self::MODULE_GID,
            'last_id'
        );
    }

    /**
     * Check file existence over http
     *
     * @param string $url
     *
     * @return boolean
     */
    private function netFileExists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $retcode < 400;
    }

    /**
     * Upload file to the temporary folder
     *
     * @param string $file_url
     * @param string $subfolder
     *
     * @return string File path
     */
    private function uploadTmpFile(string $file_url, string $subfolder = ''): string
    {
        if (!$this->netFileExists($file_url)) {
            return '';
        }
        $file = pathinfo($file_url);
        if (!$file) {
            return '';
        }
        $temp_path = TEMPPATH . self::MODULE_GID . '/' . $subfolder;
        $n = '';
        if ($subfolder && !file_exists($temp_path)) {
            mkdir($temp_path, 0777, true);
        }
        do {
            $dest_full_name = $temp_path . $file['filename'] . $n++ . '.' . $file['extension'];
            $n = (int)$n + 1;
        } while (file_exists($dest_full_name));
        $this->ci->load->helper('file');
        $is_downloaded = download_file($file_url, $dest_full_name, false, 0777);
        if ($is_downloaded) {
            return $dest_full_name;
        }

        return '';
    }

    /**
     * Delete file from the temporary folder
     *
     * @param string $file_name
     * @param string $subfolder
     *
     * @return boolean
     */
    private function deleteTmpFile($file_name, $subfolder = '')
    {
        $file = pathinfo($file_name);
        if (!$file) {
            return false;
        }
        $file_path = TEMPPATH . self::MODULE_GID . '/' . $subfolder . $file['basename'];
        if (file_exists($file_path)) {
            return unlink($file_path);
        }

        return false;
    }

    /**
     * Load photos and save it by user id
     *
     * @param array $photos
     * @param int $user_id
     *
     * @return boolean
     */
    private function loadUserPhotos(array $photos, $user_id)
    {
        $user_id = (int)$user_id;
        if (empty($photos) || empty($user_id)) {
            log_message(
                'error',
                '(' . self::MODULE_GID . ') Wrong _load_user_photos() params (' . gettype($photos) . ', ' . gettype($user_id) . ')'
            );

            return false;
        }
        $local_photos = [];
        foreach ($photos as $photo_url) {
            $tmp_file = $this->uploadTmpFile($photo_url, $user_id . '/');
            if ($tmp_file) {
                $local_photos[] = $tmp_file;
            }
        }
        if (!$local_photos) {
            return false;
        }
        $this->ci->load->model('Media_model');
        $data = [
            'id_user' => $user_id,
            'id_owner' => $user_id,
            'type_id' => $this->ci->Media_model->album_type_id,
            'upload_gid' => $this->ci->Media_model->file_config_gid,
            'status' => 1,
        ];
        $result = [];
        foreach ($local_photos as $local_photo) {
            $result[] = $this->ci->Media_model->saveImage(
                null,
                $data,
                $local_photo,
                false
            );
        }

        return $result;
    }

    /**
     * Check users uniqueness.
     * By default removes non-unique users from temp table.
     *
     * @param array $temp_data users
     * @param boolean $tmp_remove
     *
     * @return array Not unique ids
     */
    private function checkUsersUniqueness(array $temp_data, $tmp_remove = true)
    {
        $temp_net_ids = [];
        $not_unique_net_ids = [];

        foreach ($temp_data as $temp_user) {
            if (!empty($temp_user['net_id'])) {
                $temp_net_ids[] = $temp_user['net_id'];
            }
        }
        if (!empty($temp_net_ids)) {
            $result = $this->ci->db->select('net_id')
                ->from(USERS_TABLE)
                ->where_in('net_id', $temp_net_ids)
                ->get()->result_array();
            if (!empty($result)) {
                foreach ($result as $record) {
                    if (!in_array($record['net_id'], $not_unique_net_ids)) {
                        $not_unique_net_ids[] = $record['net_id'];
                    } else {
                        log_message(
                            'error',
                            '(' . self::MODULE_GID . ') Duplicate users: net_id ' . $record['net_id']
                        );
                    }
                }
                if ($tmp_remove && !empty($not_unique_net_ids)) {
                    $this->deleteTempRecords($not_unique_net_ids);
                }
            }
        }

        return $not_unique_net_ids;
    }

    /**
     * Get user by net_id
     *
     * @param int $net_id
     * @param array $fields List of required fields
     *
     * @return array
     */
    public function getUserByNetId($net_id, array $fields = null, $expect_lots = false)
    {
        if (is_null($fields)) {
            $fields = $this->ci->Users_model->fields_all;
        }
        $this->ci->db->select($fields)
            ->from(USERS_TABLE)
            ->where('net_id', $net_id);
        if ($expect_lots) {
            $this->ci->db->limit(1);
        }
        $temp_data = $this->ci->db->get()->result_array();
        if (!empty($temp_data)) {
            return $temp_data[0];
        }

        return [];
    }

    /**
     * Processes records from the temporary table
     *
     * @return void Number of processed records
     */
    public function processTemp()
    {
        set_time_limit($this->process_temp_time_limit);
        // TODO: Лимит не корректный. Не известно, кого сколько нужно.
        $limit = array_sum($this->process_temp_limit);

        $temp_data = $this->ci->db->select($this->db_fields)
            ->from(NET_TEMP_TABLE)
            ->where('type', self::TYPE_IN)
            ->order_by('created ASC')
            ->limit($limit)
            ->get()->result_array();

        if (!empty($temp_data)) {
            $actions_data = [];
            foreach ($temp_data as $record) {
                $actions_data[$record['action']][] = $record;
            }

            if (!empty($actions_data[self::ACTION_ADD])) {
                $actions_data[self::ACTION_ADD] = array_slice(
                    $actions_data[self::ACTION_ADD],
                    0,
                    $this->process_temp_limit[self::ACTION_ADD]
                );
                $this->addFromTemp($actions_data[self::ACTION_ADD]);
            }
            if (!empty($actions_data[self::ACTION_REMOVE])) {
                $actions_data[self::ACTION_REMOVE] = array_slice(
                    $actions_data[self::ACTION_REMOVE],
                    0,
                    $this->process_temp_limit[self::ACTION_REMOVE]
                );
                $this->removeFromTemp($actions_data[self::ACTION_REMOVE]);
            }
            if (!empty($actions_data[self::ACTION_UPDATE])) {
                $actions_data[self::ACTION_UPDATE] = array_slice(
                    $actions_data[self::ACTION_UPDATE],
                    0,
                    $this->process_temp_limit[self::ACTION_UPDATE]
                );
                $this->updateFromTemp($actions_data[self::ACTION_UPDATE]);
            }
        }
    }

    /**
     * Add net users from temporary table
     *
     * @param array $temp_data Data from temp table
     *
     * @return void
     */
    private function addFromTemp(array $temp_data): void
    {
        if ($this->check_net_id_uniqueness) {
            $skip_net_ids = $this->checkUsersUniqueness($temp_data);
        } else {
            $skip_net_ids = [];
        }

        $this->initFieldEditor();
        $new_temp_data = [];

        foreach ($temp_data as $temp_record) {
            if (in_array($temp_record['net_id'], $skip_net_ids)) {
                continue;
            }
            $user_data = unserialize($temp_record['data']);
            $new_temp_data['local_id'][$temp_record['id']] = $this->addUser($user_data);
            $new_temp_data['type'][$temp_record['id']] = self::TYPE_OUT;
        }

        $this->updateTemp($new_temp_data);
        $this->updateLastId();
    }

    /**
     * Remove from site users, which are marked as removed in temp table
     *
     * @param array $temp_data
     *
     * @return void
     */
    private function removeFromTemp(array $temp_data): void
    {
        if (empty($temp_data)) {
            return;
        }
        $new_temp_data = [];
        foreach ($temp_data as $temp_record) {
            if ($this->deleteUser($temp_record['net_id'])) {
                $new_temp_data['type'][$temp_record['id']] = self::TYPE_OUT;
            }
        }
        $this->updateTemp($new_temp_data);
    }

    /**
     * Update site users, which are marked for update in temp table
     *
     * @param array $temp_data
     *
     * @return void
     */
    private function updateFromTemp(array $temp_data): void
    {
        if (empty($temp_data)) {
            return;
        }
        $updated_net_ids = [];
        $this->initFieldEditor();
        foreach ($temp_data as $temp_record) {
            $user_data = unserialize($temp_record['data']);
            $user_data['id'] = $this->getLocalIdByNet($temp_record['net_id']);
            $this->forbidAction(self::ACTION_UPDATE);
            $this->updateUser($user_data);
            $updated_net_ids[] = $temp_record['net_id'];
        }
        $this->deleteTempRecords($updated_net_ids, null, 'update');
    }

    /**
     * Add net user from temporary table
     *
     * @param array $net_user Net user's data
     *
     * @return int Local user id
     */
    private function addUser(array $net_user)
    {
        $formatted_data = $this->formatUserIn($net_user);

        if (empty($formatted_data)) {
            return false;
        }

        $local_user = array_merge($this->common_user_data, $formatted_data);
        $local_user['net_is_incomer'] = true;

        $is_upload_photos = $this->ci->pg_module->get_module_config(self::MODULE_GID, 'is_upload_photos');
        if ($is_upload_photos) {
            $user_logo = $this->uploadTmpFile($net_user['icon']);
        } else {
            if (preg_match('#https://#', SITE_SERVER)) {
                $net_user['icon'] = preg_replace('#https?:#', '', $net_user['icon']);
            }
            $local_user['user_logo'] = $net_user['icon'];
            $user_logo = null;
        }

        $user_id = $this->ci->Users_model->saveUser(null, $local_user, $user_logo, false);

        $this->moderate($user_id);

        if ($is_upload_photos) {
            $this->deleteTmpFile($net_user['icon']);
        }

        $photos = unserialize($net_user['photos']);
        if ($photos) {
            if ($is_upload_photos) {
                $this->loadUserPhotos($photos, $user_id);
            } else {
                $this->ci->load->model('Media_model');
                foreach ($photos as $photo) {
                    $image_size = getimagesize($photo);

                    if (preg_match('#https://#', SITE_SERVER)) {
                        $photo = preg_replace('#https?:#', '', $photo);
                    }

                    $img_data = [
                        "id_user" => $user_id,
                        "id_owner" => $user_id,
                        "type_id" => $this->ci->Media_model->album_type_id,
                        "upload_gid" => $this->ci->Media_model->file_config_gid,
                        "mediafile" => $photo,
                        "fname" => basename($photo),
                        "settings" => serialize(["width" => $image_size[0],
                            "height" => $image_size[1]]),
                        "status" => 1,
                    ];
                    $this->ci->Media_model->saveImage(null, $img_data);
                }
            }
        }

        $this->forbidAction(self::ACTION_UPDATE);

        return $user_id;
    }

    /**
     * Delete user.
     * Executes all callbacks.
     *
     * @param int $net_id
     *
     * @return boolean
     */
    private function deleteUser(int $net_id): bool
    {
        $user = $this->getUserByNetId($net_id);
        if (empty($user)) {
            return true;
        }
        $this->ci->load->model('users/models/Users_delete_callbacks_model');
        $callbacks = $this->ci->Users_delete_callbacks_model->getAllCallbacksGid();
        $this->forbidAction(self::ACTION_REMOVE);
        $this->ci->Users_model->callbackUserDelete($user['id'], null, $callbacks);

        return true;
    }

    /**
     * Update user
     *
     * @param array $net_user
     */
    private function updateUser(array $net_user)
    {
        $this->forbidAction(self::ACTION_UPDATE);

        $local_user = $this->formatUserIn($net_user);
        if (!empty($net_user['icon'])) {
            $is_upload_photos = $this->ci->pg_module->get_module_config(
                self::MODULE_GID,
                "is_upload_photos"
            );
            if ($is_upload_photos) {
                $user_logo = $this->uploadTmpFile($net_user['icon']);
            } else {
                $local_user['user_logo'] = $net_user['icon'];
                $user_logo = null;
            }
        } else {
            $user_logo = null;
        }

        if (!empty($net_user['id'])) {
            $this->ci->Users_model->saveUser(
                $net_user['id'],
                $local_user,
                $user_logo,
                false
            );
        } else {
            log_message('error', '(' . self::MODULE_GID . ') Empty local_id');
        }
    }

    /**
     * Build sql query to update net table
     *
     * @param array $new_temp_data
     *
     * @return string Sql query
     */
    private function buildTempUpdateQuery(array $new_temp_data)
    {
        if (empty($new_temp_data)) {
            return '';
        }
        $ids = [];
        $sql_mid = [];
        foreach ($new_temp_data as $field => $values) {
            $case = "`$field` = CASE" . PHP_EOL;
            foreach ($values as $id => $value) {
                $case .= "WHEN `id` = '$id' THEN '$value'" . PHP_EOL;
                $ids[] = $id;
            }
            $case .= 'END' . PHP_EOL;
            $sql_mid[] = $case;
        }
        $sql = 'UPDATE `' . NET_TEMP_TABLE . '` SET' . PHP_EOL . implode(
            ',',
            $sql_mid
        )
            . "WHERE `id` IN ('" . implode("','", array_unique($ids)) . "');" . PHP_EOL;

        return $sql;
    }

    /**
     * Update temp table records
     *
     * @param array $new_temp_data
     *
     * @return boolean
     */
    private function updateTemp(array $new_temp_data)
    {
        if (empty($new_temp_data)) {
            return false;
        }
        $query = $this->buildTempUpdateQuery($new_temp_data);
        if (empty($query)) {
            return false;
        }

        return (bool)$this->ci->db->query($query);
    }

    /**
     * Format language
     *
     * @param string $lang_code
     *
     * @return int
     */
    private function formatLangIn($lang_code)
    {
        if (empty($lang_code)) {
            return '';
        }
        if (empty($this->network_cache['lang'][$lang_code])) {
            $this->network_cache['lang'][$lang_code] = (int)$this->ci->pg_language->get_lang_id_by_code($lang_code) ?:
                $this->ci->pg_language->get_default_lang_id();
        }

        return $this->network_cache['lang'][$lang_code];
    }

    /**
     * Format language
     *
     * @param int $lang_id
     *
     * @return string
     */
    private function formatLangOut($lang_id)
    {
        if (empty($lang_id)) {
            return '';
        }
        if (empty($this->network_cache['lang'][$lang_id])) {
            $this->network_cache['lang'][$lang_id] = strtoupper($this->ci->pg_language->get_lang_code_by_id($lang_id) ?:
                $this->ci->pg_language->get_lang_code_by_id($this->ci->pg_language->get_default_lang_id()));
        }

        return $this->network_cache['lang'][$lang_id];
    }

    /**
     * Format region
     *
     * @param string $region
     * @param string $country_code
     *
     * @return int
     */
    private function formatRegionIn($region, $country_code)
    {
        if (empty($this->network_cache['region'][$region])) {
            $this->ci->load->model('Countries_model');
            $region_data = $this->ci->Countries_model->getRegionByName($region, $country_code);
            if (!empty($region_data['id'])) {
                $this->network_cache['region'][$region] = (int)$region_data['id'];
            } else {
                // TODO: Добавлять регионы динамически (?)
                $this->network_cache['region'][$region] = 0;
            }
        }

        return $this->network_cache['region'][$region];
    }

    /**
     * Format region
     *
     * @param int $region_id
     *
     * @return string
     */
    private function formatRegionOut($region_id)
    {
        if (empty($this->network_cache['region'][$region_id])) {
            $this->ci->load->model('Countries_model');
            $region_data = $this->ci->Countries_model->getRegion($region_id);
            if (!empty($region_data['name'])) {
                $this->network_cache['region'][$region_id] = $region_data['name'];
            } else {
                $this->network_cache['region'][$region_id] = '';
            }
        }

        return $this->network_cache['region'][$region_id];
    }

    /**
     * Format city
     *
     * @param string $city_name
     * @param int $region_id
     * @param string $country_code
     *
     * @return int
     */
    private function formatCityIn($city_name, $region_id = null, $country_code = null)
    {
        if (empty($city_name)) {
            return '';
        }
        if (empty($this->network_cache['city'][$city_name])) {
            $this->ci->load->model('Countries_model');
            $city_data = $this->ci->Countries_model->getCityByName(
                $city_name,
                $region_id,
                $country_code
            );
            if (!empty($city_data['id'])) {
                $this->network_cache['city'][$city_name] = $city_data['id'];
            } else {
                // TODO: Добавлять города динамически (?)
                $this->network_cache['city'][$city_name] = '';
            }
        }

        return $this->network_cache['city'][$city_name];
    }

    /**
     * Format city
     *
     * @param int $city_id
     *
     * @return string
     */
    private function formatCityOut($city_id)
    {
        if (empty($city_id)) {
            return '';
        }
        if (empty($this->network_cache['city'][$city_id])) {
            $this->ci->load->model('Countries_model');
            $city_data = $this->ci->Countries_model->getCity($city_id);
            if (!empty($city_data['name'])) {
                $this->network_cache['city'][$city_id] = $city_data['name'];
            } else {
                $this->network_cache['city'][$city_id] = '';
            }
        }

        return $this->network_cache['city'][$city_id];
    }

    /**
     * Format photos
     *
     * @param int $user_id
     * @param int $max_photo_num
     *
     * @return array
     */
    private function formatPhotosOut($user_id, $max_photo_num = 5)
    {
        $this->ci->load->model('Media_model');
        $params = [
            'where' => [
                'id_user' => $user_id,
                'status' => 1,
                'upload_gid' => $this->ci->Media_model->file_config_gid,
            ],
        ];
        $list = $this->ci->Media_model->getMedia(
            1,
            $max_photo_num,
            null,
            $params,
            null,
            true
        );
        if (empty($list)) {
            return [];
        }
        $files = [];
        foreach ($list as $file) {
            $files[] = $file['media']['mediafile']['file_url'];
        }

        return $files;
    }

    /**
     * Format data
     *
     * @param array $user
     *
     * @return string
     */
    private function formatProfileDataIn(array $user)
    {
        if (empty($user['profile_data'])) {
            return [];
        }
        $str_delim = PHP_EOL;
        if (empty($this->fe_fields[self::PROFILE_DATA_FIELD]['field_name'])) {
            log_message(
                'error',
                '(' . self::MODULE_GID . ') Wrong profile data field'
            );

            return [];
        }
        $profile_data_field = $this->fe_fields[self::PROFILE_DATA_FIELD]['field_name'];

        if (is_string($user['profile_data'])) {
            $profile_data = @unserialize($user['profile_data']);
        } else {
            $profile_data = &$user['profile_data'];
        }
        $result = [];
        $result_arr = [];
        foreach ($profile_data as $field => $value) {
            if (!empty($value)) {
                $result_arr[] = $field . self::PROFILE_DATA_DELIMITER . $value;
            }
        }
        $result[$profile_data_field] = implode($str_delim, $result_arr);

        return $result;
    }

    /**
     * Format profile data
     *
     * @param array $user
     *
     * @return array
     */
    private function formatProfileDataOut(array $user)
    {
        $result = [];
        foreach ($this->profile_data_assoc as $local_field => $net_field) {
            if (!empty($user[$this->fe_fields[$local_field]['field_name']])) {
                $option_key = $user[$this->fe_fields[$local_field]['field_name']];
                $result[$net_field] = $this->fe_fields[$local_field]['options']['option'][$option_key];
            }
        }

        return $result;
    }

    /**
     * Format common user fields
     *
     * @param array $user
     *
     * @return array
     */
    private function formatUserCommon(array $user)
    {
        return filter_var_array($user, $this->formatFilter(), false);
    }

    private function formatFilter()
    {
        $filter = [
            'id' => FILTER_VALIDATE_INT,
            'net_id' => FILTER_VALIDATE_INT,
            'fname' => FILTER_SANITIZE_STRING,
            'nickname' => FILTER_SANITIZE_STRING,
            'postal_code' => FILTER_SANITIZE_STRING,
            'sname' => FILTER_SANITIZE_STRING,
            'user_type' => FILTER_SANITIZE_STRING,
            'birth_date' => [
                'filter' => FILTER_CALLBACK,
                'options' => function ($birth_date) {
                    $date = new \DateTime($birth_date);

                    return $date->format(self::DATE_FORMAT);
                },
            ],
        ];
        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            $filter['age_max'] = FILTER_VALIDATE_INT;
            $filter['age_max'] = FILTER_VALIDATE_INT;
            $filter['looking_user_type'] = FILTER_SANITIZE_STRING;
        }

        return $filter;
    }

    /**
     * Format user inside
     *
     * @param array $user
     * @param int $lang_id
     *
     * @return array
     */
    public function format(&$user, $lang_id)
    {
        $field = &$this->fe_fields[self::PROFILE_DATA_FIELD]['field_name'];
        if (!empty($user[$field])) {
            $lang = $this->ci->pg_language->ds->get_reference(
                self::MODULE_GID,
                'profile_data',
                $lang_id
            );
            foreach ($this->profile_data_assoc as $net_field) {
                $user[$field] = str_ireplace(
                    $net_field . self::PROFILE_DATA_DELIMITER,
                    $lang['option'][$net_field] . self::PROFILE_DATA_DELIMITER,
                    $user[$field]
                );
            }
        }

        return $user;
    }

    /**
     * Format user
     *
     * @param array $user
     *
     * @return array
     */
    public function formatUserIn(array $user)
    {
        $formated_user = $this->formatUserCommon($user);

        if (isset($user['email'])) {
            $formated_user['email'] = $user['email'];
        }
        if (isset($user['country_code'])) {
            $formated_user['id_country'] = $user['country_code'];
        }
        if (isset($user['region'])) {
            $id_region = $this->formatRegionIn(
                $user['region'],
                $user['country_code'] ?? null
            );
            $formated_user['id_region'] = $id_region;
        }
        if (isset($user['city'])) {
            $id_city = $this->formatCityIn(
                $user['city'],
                $formated_user['id_region'] ?? null,
                $user['country_code'] ?? null
            );
            $formated_user['id_city'] = $id_city;
        }
        if (isset($user['lang'])) {
            $formated_user['lang_id'] = $this->formatLangIn($user['lang']);
        }

        foreach ($this->formatProfileDataIn($user) as $fe_field => $value) {
            $formated_user[$fe_field] = $value;
        }

        return $formated_user;
    }

    /**
     * Format user
     *
     * @param array $user
     *
     * @return array
     */
    public function formatUserOut(array $user)
    {
        $formated_user = $this->formatUserCommon($user);
        if (isset($user['net_id'])) {
            $formated_user['net_id'] = $user['net_id'];
        }
        if (isset($user['email']) && isset($user['nickname'])) {
            $formated_user['email'] = md5($user['nickname'] . $user['email']);
        }
        if (isset($user['id_country'])) {
            $formated_user['country_code'] = $user['id_country'];
        }
        if (isset($user['id_region'])) {
            $formated_user['region'] = $this->formatRegionOut($user['id_region']);
        }
        if (isset($user['id_city'])) {
            $formated_user['city'] = $this->formatCityOut($user['id_city']);
        }
        if (isset($user['media']['user_logo']['file_url'])) {
            $formated_user['icon'] = $user['media']['user_logo']['file_url'];
        }
        if (isset($user['lang_id'])) {
            $formated_user['lang'] = $this->formatLangOut($user['lang_id']);
        }
        if (isset($user['id'])) {
            $formated_user['id'] = $user['id'];
            $formated_user['photos'] = $this->formatPhotosOut($user['id']);
        }
        $formated_user['profile_data'] = $this->formatProfileDataOut($user);

        return $formated_user;
    }

    /**
     * Get settings
     *
     * @param mixed $cfg_gids
     *
     * @return array
     */
    public function getConfig($cfg_gids = null): array
    {
        if (empty($cfg_gids)) {
            $cfg_gids = array_merge(
                (array)$this->_cfg_data,
                (array)$this->cfg_filter,
                (array)$this->cfg_profile_data_limits,
                (array)$this->cfg_settings_limits,
                (array)$this->cfg_temp_processing_limits
            );
        } elseif (!is_array($cfg_gids)) {
            $cfg_gids = [$cfg_gids];
        }

        return parent::getConfig($cfg_gids);
    }

    /**
     * Get form fields
     *
     * @param int $lang_id
     *
     * @return array
     */
    public function getFormFields($lang_id = null)
    {
        $country_code = $this->ci->pg_language->ds->get_reference(
            self::MODULE_GID,
            'country_code',
            $lang_id
        );
        asort($country_code['option']);
        $lang = $this->ci->pg_language->ds->get_reference(
            self::MODULE_GID,
            'lang',
            $lang_id
        );
        asort($lang['option']);

        return [
            ['site_type' => $this->ci->pg_language->ds->get_reference(
                self::MODULE_GID,
                'site_type',
                $lang_id
            )],
            ['user_type' => $this->ci->pg_language->ds->get_reference(
                self::MODULE_GID,
                'user_type',
                $lang_id
            )],
            ['orientation' => $this->ci->pg_language->ds->get_reference(
                self::MODULE_GID,
                'orientation',
                $lang_id
            )],
            ['lang' => $lang],
            [
                'land' => $this->ci->pg_language->ds->get_reference(
                    self::MODULE_GID,
                    'land',
                    $lang_id
                ),
                'country_code' => $country_code,
            ],
        ];
    }

    /**
     * Get form limits
     *
     * @return array
     */
    public function getFormLimits()
    {
        $config = $this->getConfig($this->cfg_settings_limits);

        return $config[$this->cfg_settings_limits];
    }

    /**
     * Get user profile data limits
     *
     * @return array
     */
    public function getProfileDataLimits()
    {
        $config = $this->getConfig($this->cfg_profile_data_limits);

        return $config[$this->cfg_profile_data_limits];
    }

    /**
     * Get temp processing limits
     *
     * @return array
     */
    public function getTempProcessingLimits()
    {
        $config = $this->getConfig($this->cfg_temp_processing_limits);

        return $config[$this->cfg_temp_processing_limits];
    }

    /**
     * Validate settings.
     *
     * @param array $settings
     *
     * @return array
     */
    public function validateSettings(array $settings): array
    {
        $errors = parent::validateSettings($settings);
        $form_limits = $this->getFormLimits();
        $alike_fields = ['site_type', 'user_type', 'orientation', 'lang', 'land',
            'country_code'];
        foreach ($alike_fields as $field) {
            if (!isset($settings[$field])) {
                continue;
            } elseif (empty($settings[$field])) {
                $errors[$field] = l(
                    "admin_error_{$field}_empty",
                    self::MODULE_GID
                );
            } elseif (!empty($form_limits[$field]) && count($settings[$field]) > $form_limits[$field]) {
                $errors[$field] = l(
                    "admin_error_{$field}_too_many",
                    self::MODULE_GID
                );
            }
        }
        if (!empty($settings['min_age']) || !empty($settings['max_age'])) {
            $age_min = $this->ci->pg_module->get_module_config(
                'users',
                'age_min'
            );
            $age_max = $this->ci->pg_module->get_module_config(
                'users',
                'age_max'
            );
            if ((int)$settings['min_age'] > (int)$settings['max_age']) {
                $errors['max_age'] = l(
                    'admin_error_min_age_bigger_than_max_age',
                    self::MODULE_GID
                );
            }
        }
        if (isset($settings['min_age'])) {
            $settings['min_age'] = (int)$settings['min_age'];
            if (empty($settings['min_age'])) {
                $errors['min_age'] = l(
                    'admin_error_min_age_empty',
                    self::MODULE_GID
                );
            } elseif ($settings['min_age'] < $age_min) {
                $errors['min_age'] = l(
                    'admin_error_min_age_too_small',
                    self::MODULE_GID
                );
            } elseif ($settings['min_age'] > $age_max) {
                $errors['min_age'] = l(
                    'admin_error_min_age_too_big',
                    self::MODULE_GID
                );
            }
        }
        if (isset($settings['max_age'])) {
            $settings['max_age'] = (int)$settings['max_age'];
            if (empty($settings['max_age'])) {
                $errors['max_age'] = l(
                    'admin_error_max_age_empty',
                    self::MODULE_GID
                );
            } elseif ($settings['max_age'] > $age_max) {
                $errors['max_age'] = l(
                    'admin_error_max_age_too_big',
                    self::MODULE_GID
                );
            } elseif ($settings['max_age'] < $age_min) {
                $errors['max_age'] = l(
                    'admin_error_max_age_too_small',
                    self::MODULE_GID
                );
            }
        }

        return $errors;
    }

    /**
     * Save user as ready joining to network
     *
     * @param integer $user_id
     *
     * @return void
     */
    public function saveReady(int $user_id)
    {
        $this->ci->load->model('Users_model');
        $save_data = ['net_status' => self::STATUS_READY];
        $this->Users_model->saveUser($user_id, $save_data);
    }

    /**
     * Save user as not agree joining to network
     *
     * @param integer $user_id
     *
     * @return void
     */
    public function saveNotAgree(int $user_id)
    {
        $this->ci->load->model('Users_model');
        $save_data = ['net_status' => self::STATUS_NOT_AGREE];
        $this->Users_model->saveUser($user_id, $save_data);
    }

    public function getUserDecision($user_id)
    {
        $this->ci->load->model('Users_model');
        $user = $this->Users_model->getUserById($user_id);

        return $user['net_user_decision'];
    }

    public function saveUserDecision($user_id, $decision)
    {
        if ($decision == self::DECISION_AGREE) {
            $this->joinNetwork($user_id);
        }
        $this->ci->load->model('Users_model');
        $this->Users_model->saveUser(
            $user_id,
            [
                'net_user_decision' => $decision,
            ]
        );
    }

    public function bonusCounterCallback($counter = [])
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventNetwork();
        $event->setData($counter);
        $event_handler->dispatch($event, 'bonus_counter');
    }

    public function bonusActionCallback($data = [])
    {
        if (!empty($data)) {
            $counter = $data['counter'];
            $counter['is_new_counter'] = $data['is_new_counter'];
            $counter['repetition'] = $data['bonus']['repetition'];
            $counter['count'] = 1;
            $this->bonusCounterCallback($counter);
        }
    }

    public function joinNetwork($id = null)
    {
        if ($id) {
            $event_handler = EventDispatcher::getInstance();
            $event = new EventNetwork();
            $event_data = [];
            $event_data['id'] = $id;
            $event_data['action'] = 'network_join';
            $event_data['module'] = 'network';
            $event->setData($event_data);
            $event_handler->dispatch($event, 'network_join');
        }
    }

    public function getStat(): array
    {
        $this->ci->load->model('Users_model');
        $net_errors = $this->ci->Users_model->getUsersList(
            null,
            null,
            null,
            ['where' => ['net_status' => 'error']],
            [],
            false,
            true
        );

        return [
            'count' => [
                'total' => $this->ci->Users_model->getUsersCount(),
                'from_network' => $this->ci->Users_model->getUsersCount([
                    'where' => [
                        'net_status' => self::STATUS_OK,
                        'net_is_incomer' => 1,
                    ],
                ]),
                'to_network' => $this->ci->Users_model->getUsersCount([
                    'where' => [
                        'net_status' => self::STATUS_OK,
                        'net_is_incomer' => 0,
                    ],
                ]),
                'agreed' => $this->ci->Users_model->getUsersCount([
                    'where' => [
                        'net_user_decision' => self::DECISION_AGREE,
                    ],
                ]),
                'disagreed' => $this->ci->Users_model->getUsersCount([
                    'where' => [
                        'net_user_decision' => self::DECISION_DISAGREE,
                    ],
                ]),
            ],
            'errors' => array_map(function ($net_error) {
                return [
                    'id' => $net_error['id'],
                    'net_id' => $net_error['net_id'],
                    'net_status' => $net_error['net_status'],
                    'net_info' => $net_error['net_info'],
                    'net_is_incomer' => $net_error['net_is_incomer'],
                ];
            }, $net_errors),
        ];
    }

    /**
     * Moderate
     *
     * @param $user_id
     *
     * @return void
     */
    private function moderate($user_id)
    {
        $this->ci->load->model('ModerationModel');
        $mtype = $this->ci->ModerationModel->getModerationType(self::MODERATION_TYPE);
        if ($mtype['mtype'] > 0) {
            $this->ci->ModerationModel->addModerationItem(self::MODERATION_TYPE, $user_id);
            if ($mtype['mtype'] == 2) {
                $this->ci->Users_model->simplyUpdateUser($user_id, ['confirm' => false]);
            }
        }
    }

    /**
     * Moderation list
     *
     * @param array $object_ids
     *
     * @return array
     * @return array
     */
    public function moderationList(array $object_ids): array
    {
        return $this->ci->Users_model->getUsersListByKey(null, null, null, null, $object_ids);
    }

    /**
     * Set status moderation
     *
     * @param int $object_id
     * @param int $status
     *
     * @return void
     */
    public function moderationSetStatus(int $object_id, int $status)
    {
        $this->ci->Users_model->simplyUpdateUser($object_id, ['confirm' => $status, 'approved' => $status]);
    }

    /**
     * Dashboard Options
     *
     * @param $user_id
     *
     * @return array
     */
    public function getDashboardOptions($user_id): array
    {
        return [
            'dashboard_header' => 'header_moderation_object',
            'dashboard_action_link' => 'admin/users/index/not_active/all'
        ];
    }

    /**
     * @throws \Exception
     */
    public function __call($name, $args)
    {
        $methods = [
            'format_user_in' => 'formatUserIn',
            'format_user_out' => 'formatUserOut',
            'get_config' => 'getConfig',
            'get_form_fields' => 'getFormFields',
            'get_form_limits' => 'getFormLimits',
            'get_last_id' => 'getLastId',
            'get_local_id_by_net' => 'getLocalIdByNet',
            'get_net_id_by_local' => 'getNetIdByLocal',
            'get_profile_data_limits' => 'getProfileDataLimits',
            'get_profiles' => 'getProfiles',
            'get_temp_processing_limits' => 'getTempProcessingLimits',
            'get_temp_records' => 'getTempRecords',
            'get_user_by_net_id' => 'getUserByNetId',
            'pre_create' => 'preCreate',
            'process_temp' => 'processTemp',
            'set_profiles_status' => 'setProfilesStatus',
            'set_temp_profiles' => 'setTempProfiles',
            'user_deleted' => 'userDeleted',
            'user_updated' => 'userUpdated',
            'validate_settings' => 'validateSettings',
            'update_last_id' => 'updateLastId',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
