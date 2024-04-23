<?php

declare(strict_types=1);

namespace Pg\modules\menu\models;

if (!defined('INDICATORS_TABLE')) {
    define('INDICATORS_TABLE', DB_PREFIX . 'menu_indicators');
}

if (!defined('INDICATORS_TYPES_TABLE')) {
    define('INDICATORS_TYPES_TABLE', DB_PREFIX . 'menu_indicators_types');
}

/**
 * Indicators model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class IndicatorsModel extends \Model
{
    public $fields = [
        'id',
        'gid',
        'user_id',
        'value',
        'created',
    ];
    public $types_fields = [
        'id',
        'gid',
        'auth_type',
    ];
    private $auth_types = ['user', 'admin', 'mudule'];

    public function __construct()
    {
        parent::__construct();

        if (INSTALL_DONE) {
            $langs = (array) $this->ci->pg_language->languages;
            foreach ($langs as $lang) {
                $this->types_fields[] = 'name_' . $lang['id'];
            }
        }
        $this->ci->cache->registerService(INDICATORS_TABLE);
        $this->ci->cache->registerService(INDICATORS_TYPES_TABLE);
    }

    /**
     * Adds indicator.
     * Depends on "use_indicators" menu setting.
     *
     * @param string $gid
     * @param string $uid
     * @param int    $user_id
     * @param string $value
     *
     * @return boolean
     */
    public function add($gid, $uid = '', $user_id = 0, $value = '')
    {
        if (!$this->ci->pg_module->get_module_config('menu', 'use_indicators')) {
            return false;
        }

        // Delete old indicator
        if (!empty($uid)) {
            $this->delete($gid, $uid, true);
        }

        $data = [
            'gid'     => $gid,
            'value'   => $value,
            'uid'     => $uid,
            'user_id' => $user_id,
        ];

        $this->ci->db->insert(INDICATORS_TABLE, $data);
        $this->ci->cache->flush(INDICATORS_TABLE);

        return $this;
    }

    /**
     * Gets menu indicators
     *
     * @param string $auth_type (admin | module | user)
     * @param int    $user_id
     *
     * @return boolean
     */
    public function get($auth_type = null, $user_id = null)
    {
        if ('user' === $auth_type && empty($user_id)) {
            log_message('ERROR', '(indicators) Empty user id');

            return false;
        }

        $indicatorsTypesTable   = INDICATORS_TYPES_TABLE;
        $indicatorsTable        = INDICATORS_TABLE;
        $result =  $this->ci->cache->get(INDICATORS_TABLE, 'getAuthType'.$auth_type.'userId'.$user_id, function () use ($auth_type, $user_id, $indicatorsTypesTable, $indicatorsTable) {
            $ci = &get_instance();
            $ci->db->select('i.gid')->from($indicatorsTable . ' AS i');
            if (!empty($auth_type)) {
                $ci->db->join($indicatorsTypesTable . ' AS t', 't.gid = i.gid')
                    ->where('t.auth_type', $auth_type);
                if ('user' === $auth_type) {
                    $ci->db->where('i.user_id', $user_id);
                }
            }

            return $ci->db->get()->result_array();
        });

        if (empty($result)) {
            return [];
        }
        $indicators = [];
        foreach ($result as $indicator) {
            if (!empty($indicators[$indicator['gid']])) {
                ++$indicators[$indicator['gid']];
            } else {
                $indicators[$indicator['gid']] = 1;
            }
        }

        return $indicators;
    }

    public function getByType($indicator_type, $user_id = null)
    {
        if (is_null($user_id)) {
            $user_id = $this->ci->session->userdata('user_id');
        }

        $nameTable  = INDICATORS_TABLE;
        $fields     = implode(', ', $this->types_fields);
        $result =  $this->ci->cache->get(INDICATORS_TABLE, 'getByTypeIndicType'.$indicator_type."UserId".$user_id, function () use ($indicator_type, $user_id, $nameTable, $fields) {
            $ci = &get_instance();
            $ci->db->select($fields);
            $ci->db->from($nameTable);
            $ci->db->where('gid', $indicator_type);
            $ci->db->where('user_id', $user_id);

            $result =  $ci->db->get()->result_array();

            return $result;
        });

        return $result;
    }

    /**
     * Removes indicators for the current user
     *
     * @param string $gid
     * @param string $uid
     * @param bool   $all If true, session data will be ignored
     *
     * @return boolean
     */
    public function delete($gid, $uid = null, $all = false)
    {
        if (!$this->ci->pg_module->get_module_config('menu', 'use_indicators')) {
            return $this;
        } elseif (empty($gid)) {
            log_message('ERROR', '(indicators) Empty indicator gid');

            return $this;
        }

        if (!$all) {
            $auth_type = $this->ci->session->userdata('auth_type');
            if ('user' === $auth_type) {
                $this->ci->db->where('user_id', $this->ci->session->userdata('user_id'))
                    ->where('gid', $gid);
                if (!empty($uid)) {
                    $this->ci->db->where_in('uid', $uid);
                }
                $this->ci->db->delete(INDICATORS_TABLE);
            } else {
                // CI's active record can't handle such queries
                $query = 'DELETE i FROM ' . INDICATORS_TABLE . ' i
                    JOIN ' . INDICATORS_TYPES_TABLE . " t ON t.gid = i.gid
                    WHERE t.auth_type = '$auth_type' AND i.gid = '$gid'";
                if (!empty($uid)) {
                    $uid = (array) $uid;
                    foreach ($uid as $key => $value) {
                        $uid[$key] = $this->ci->db->escape($value);
                    }
                    $query .= ' AND uid IN (' . implode(',', $uid) . ')';
                }
                $this->db->query($query);
            }
        } else {
            if (!empty($uid)) {
                $this->ci->db->where_in('uid', $uid);
            }
            $this->ci->db->where('gid', $gid)
                ->delete(INDICATORS_TABLE);
        }
        $this->ci->cache->flush(INDICATORS_TABLE);

        return $this;
    }

    public function deleteByValue($value = '')
    {
        if ($value) {
            $this->db->where('value', $value);
            $this->db->delete(INDICATORS_TABLE);
            $this->ci->cache->flush(INDICATORS_TABLE);
        }
    }

    /**
     * By cron
     */
    public function deleteOld()
    {
        $this->clearEmptyItems();

        $lifetime = (int) $this->ci->pg_module->get_module_config('menu', 'indicator_lifetime');
        if ($lifetime < 1) {
            $lifetime = 24;
        }
        $query = 'DELETE i FROM ' . INDICATORS_TABLE . ' i
                    JOIN ' . INDICATORS_TYPES_TABLE . " t ON t.gid = i.gid
                    WHERE t.delete_by_cron = '1'
                    AND i.user_id = '0'
                    AND i.created < DATE_SUB(NOW(), INTERVAL $lifetime hour)";
        $this->db->query($query);
        $this->ci->cache->flush(INDICATORS_TABLE);

        return $this;
    }

    public function clearEmptyItems()
    {
        $fields     = implode(', ', $this->fields);
        $nameTabel  = INDICATORS_TABLE;
        $indicators =  $this->ci->cache->get(INDICATORS_TABLE, 'clearEmptyItems', function () use ($fields, $nameTabel) {
            $ci = &get_instance();
            $ci->db->select($fields);
            $ci->db->from($nameTabel);
            $ci->db->where('user_id', 0);
            $indicators = $ci->db->get()->result_array();

            return $indicators;
        });

        $data = [];
        foreach ($indicators as $v) {
            $data[$v['gid']][] = $v['uid'];
        }
        if (!empty($data)) {
            foreach ($data as $gid => $d) {
                if ($gid == 'new_moderation_item') {
                    $this->ci->load->model('Moderation_model');
                    $obj = $this->ci->Moderation_model->getModerationByObjectIds($d);
                    foreach ($obj as $o) {
                        $k = array_search($o['id_object'], $d);
                        if ($k) {
                            unset($d[$k]);
                        }
                    }
                    if (!empty($d)) {
                        $this->deleteList([
                            'where' => ['gid' => $gid],
                            'where_in' => ['uid' => $d]
                        ]);
                    }
                }
            }
            $this->ci->cache->flush(INDICATORS_TABLE);
        }
    }

    public function deleteList($params)
    {
        if (isset($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        if (isset($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        $this->ci->cache->flush(INDICATORS_TABLE);
        $this->ci->db->delete(INDICATORS_TABLE);
    }

    /**
     * Saves indicator type
     *
     * @param string $gid
     * @param bool   $delete_by_cron
     * @param string $auth_type
     * @param array  $data['name']
     *
     * @return boolean
     */
    public function saveType($gid = null, $data = [])
    {
        if (empty($data)) {
            log_message('ERROR', '(indicators) Empty indicator data');

            return $this;
        } elseif (!empty($data['auth_type']) && !in_array($data['auth_type'], $this->auth_types)) {
            log_message('ERROR', '(indicators) Wrong indicator auth type');

            return $this;
        }
        $data['delete_by_cron'] = (int) $data['delete_by_cron'];
        if (empty($gid)) {
            $this->ci->db->ignore()->insert(INDICATORS_TYPES_TABLE, $data);
        } else {
            $this->ci->db->where('gid', $gid);
            $this->ci->db->update(INDICATORS_TYPES_TABLE, $data);
        }
        $this->ci->cache->flush(INDICATORS_TYPES_TABLE);

        return $this;
    }

    /**
     * Returns indicators' types
     * Depends on "use_indicators" menu setting.
     *
     * @param $params
     *
     * @return array
     */
    public function getTypes($params = null)
    {
        if (!$this->ci->pg_module->get_module_config('menu', 'use_indicators')) {
            return false;
        }
        $this->ci->db->select(implode(', ', $this->types_fields))
            ->from(INDICATORS_TYPES_TABLE);

        if (!empty($params)) {
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
                    $this->ci->db->where($value, null, false);
                }
            }
        }

        $result = $this->ci->db->get()->result_array();
        $types = [];
        $cur_lang = $this->ci->pg_language->current_lang_id;
        foreach ($result as $set) {
            $types[$set['gid']] = $set;
            $types[$set['gid']]['name'] = $types[$set['gid']]['name_' . $cur_lang];
        }

        return $types;
    }

    public function deleteType($gid)
    {
        if (empty($gid)) {
            log_message('ERROR', '(indicators) Empty type gid');

            return false;
        }
        $this->ci->db->where('gid', $gid)
            ->delete(INDICATORS_TYPES_TABLE);
        $this->delete($gid, null, true);
        $this->ci->cache->flush(INDICATORS_TYPES_TABLE);

        return true;
    }

    /**
     * Adds langs fields
     *
     * @param bool $lang_id
     *
     * @return boolean
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return false;
        }
        $this->ci->load->dbforge();
        $this->ci->dbforge->add_column(INDICATORS_TYPES_TABLE, [
            'name_' . $lang_id => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ]
        ]);
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_' . $lang_id, 'name_' . $default_lang_id, false);
            $this->ci->db->update(INDICATORS_TYPES_TABLE);
        }
        $this->ci->cache->flush(INDICATORS_TYPES_TABLE);

        return true;
    }

    /**
     * Deletes langs fields
     *
     * @param int $lang_id
     *
     * @return boolean
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if ($lang_id !== false) {
            $this->ci->load->dbforge();
            $fields_exists = $this->ci->db->list_fields(INDICATORS_TYPES_TABLE);
            $fields = ['name_' . $lang_id];
            foreach ($fields as $field_name) {
                if (!in_array($field_name, $fields_exists)) {
                    continue;
                }
                $this->ci->dbforge->drop_column(INDICATORS_TYPES_TABLE, $field_name);
            }
        }
    }

    /**
     * Updates langs
     *
     * @param array $data
     * @param array $langs_file
     * @param array $langs_ids
     *
     * @return boolean
     */
    public function updateLangs($data, $langs_file, $langs_ids = null)
    {
        if (empty($data)) {
            log_message('ERROR', '(indicators) Empty data for update');

            return false;
        } elseif (empty($langs_file)) {
            log_message('ERROR', '(indicators) Empty langs for update');

            return false;
        }

        // Get all langs if $langs_ids is empty
        if (empty($langs_ids)) {
            $langs = (array) $this->ci->pg_language->languages;
            foreach ($langs as $lang) {
                $langs_ids[] = $lang['id'];
            }
        }

        $default_lang = $this->ci->pg_language->get_default_lang_id();
        foreach ($data as $indicator) {
            $langs_data = [];
            foreach ($langs_ids as $lang_id) {
                if (!empty($langs_file[$indicator['gid']][$lang_id])) {
                    $name = $langs_file[$indicator['gid']][$lang_id];
                } elseif (!empty($langs_file[$indicator['gid']][$default_lang])) {
                    // Use default lang
                    $name = $langs_file[$indicator['gid']][$default_lang];
                } else {
                    continue;
                }
                $langs_data['name_' . $lang_id] = $name;
            }
            if (!empty($langs_data)) {
                $this->save_type($indicator['gid'], $langs_data);
            }
        }
        $this->ci->cache->flush(INDICATORS_TABLE);
    }

    /**
     * Exports langs
     *
     * @param array $data
     * @param array $langs_ids
     *
     * @return array
     */
    public function exportLangs($data, $langs_ids = null)
    {
        if (empty($data)) {
            log_message('ERROR', '(indicators) Empty data for export');
        }
        $gids = [];
        foreach ($data as $indicator) {
            $gids[] = $indicator['gid'];
        }

        $indicators = $this->get_types(['where_in' => ['gid' => $gids]]);

        // Get all langs if $langs_ids is empty
        if (empty($langs_ids)) {
            $langs = (array) $this->ci->pg_language->languages;
            foreach ($langs as $lang) {
                $langs_ids[] = $lang['id'];
            }
        }

        $langs_data = [];
        foreach ($indicators as $indicator) {
            foreach ($langs_ids as $lang_id) {
                if (!empty($indicator['name_' . $lang_id])) {
                    $langs_data[$indicator['gid']][$lang_id] = $indicator['name_' . $lang_id];
                }
            }
        }

        return $langs_data;
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_old' => 'deleteOld',
            'delete_type' => 'deleteType',
            'export_langs' => 'exportLangs',
            'get_types' => 'getTypes',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'save_type' => 'saveType',
            'update_langs' => 'updateLangs',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
