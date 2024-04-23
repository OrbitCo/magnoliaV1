<?php

/**
 * Libraries
 *
 * @package     PG_Core
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

define('LANG_DS_TABLE', DB_PREFIX . 'lang_ds');

/**
 * Languages data source driver
 *
 * Store in database
 *
 * @package     PG_Core
 * @subpackage  Libraries
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class lang_ds_driver
{
    /**
     * Link to CodeIgniter object
     *
     * @var object
     */
    public $ci;

    /**
     * Class constructor
     *
     * @return lang_ds_driver
     */
    public function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->cache->registerService(LANG_DS_TABLE);
    }

    /**
     * Return module content by guid
     *
     * get all module strings from base and put it to cache ($modules_data)
     *
     * @param string  $module_gid module guid
     * @param integer $lang_id    language identifier
     *
     * @return array
     */
    public function get_module($module_gid, $lang_id)
    {
        $fields = ['id', 'gid', 'option_gid', 'type', 'sorter'];

        foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
            $fields[] = "value_" . $lid;
        }

        $results_raw = (array)$this->ci->cache->get(LANG_DS_TABLE, $module_gid, function () use ($fields, $module_gid) {
            $ci = &get_instance();

            $results_raw = (array)$ci->db->select(implode(", ", $fields))
                ->from(LANG_DS_TABLE)
                ->where('module_gid', $module_gid)
                ->order_by("sorter ASC")
                ->get()->result_array();

            if (empty($results_raw) || !is_array($results_raw)) {
                return [];
            }

            return $results_raw;
        });

        $results = [];

        foreach ($results_raw as $result_raw) {
            switch ($result_raw["type"]) {
                case "header":
                    $results[$result_raw["gid"]]["header"] = $result_raw['value_' .  $lang_id];

                    break;
                case "option":
                    $results[$result_raw["gid"]]["option"][$result_raw["option_gid"]] = $result_raw['value_' .  $lang_id];

                    break;
            }
        }

        return $results;
    }

    /**
     * Save data source entry
     *
     * @param string  $module_gid module guid
     * @param string  $gid        entry guid
     * @param array   $data       entry data
     * @param integer $lang_id    language identifier
     *
     * @return void
     */
    public function set_module_reference($module_gid, $gid, $data, $lang_id)
    {
        $lang_value = "value_" . $lang_id;
        $module_lang = $this->get_module($module_gid, $lang_id);

        if (isset($module_lang[$gid])) {
            /// update header
            $this->ci->db->where('module_gid', $module_gid);
            $this->ci->db->where('gid', $gid);
            $this->ci->db->where('type', "header");
            $this->ci->db->update(LANG_DS_TABLE, [$lang_value => $data["header"]]);

            //// adding options
            if (isset($data["option"])) {
                $i = 1;
                foreach ($data["option"] as $option_gid => $option_value) {
                    if (isset($module_lang[$gid]["option"][$option_gid])) {
                        // update
                        $lang_ds_data = [
                            'sorter'    => $i,
                            $lang_value => strval($option_value),
                        ];
                        $this->ci->db->where('type', 'option');
                        $this->ci->db->where('module_gid', $module_gid);
                        $this->ci->db->where('option_gid', $option_gid);
                        $this->ci->db->where('gid', $gid);
                        $this->ci->db->update(LANG_DS_TABLE, $lang_ds_data);
                    } else {
                        // insert
                        $lang_ds_data = [
                            'module_gid' => $module_gid,
                            'gid'        => $gid,
                            'type'       => "option",
                            'sorter'     => $i,
                            'option_gid' => $option_gid,
                            $lang_value  => strval($option_value),
                        ];
                        $this->ci->db->insert(LANG_DS_TABLE, $lang_ds_data);
                    }
                    ++$i;
                }
            }

            //// deleteing not used options
            if (isset($module_lang[$gid]["option"])) {
                foreach ($module_lang[$gid]["option"] as $option_gid => $option_value) {
                    if (!isset($data["option"][$option_gid])) {
                        $this->ci->db->where('type', 'option');
                        $this->ci->db->where('option_gid', $option_gid);
                        $this->ci->db->where('gid', $gid);
                        $this->ci->db->where('module_gid', $module_gid);
                        $this->ci->db->delete(LANG_DS_TABLE);
                    }
                }
            }
        } else {
            if (empty($data["header"])) {
                $data["header"] = "";
            }
            /// insert header
            $lang_ds_data = [
                'module_gid' => $module_gid,
                'gid'        => $gid,
                'type'       => "header",
                'sorter'     => 0,
                $lang_value  => $data["header"],
            ];
            $this->ci->db->insert(LANG_DS_TABLE, $lang_ds_data);

            if (isset($data["option"])) {
                $i = 1;
                foreach ($data["option"] as $option_gid => $option_value) {
                    if (!$option_value) {
                        $option_value = "";
                    }
                    $lang_ds_data = [
                        'module_gid' => $module_gid,
                        'gid'        => $gid,
                        'type'       => "option",
                        'sorter'     => $i,
                        'option_gid' => $option_gid,
                        $lang_value  => $option_value,
                    ];
                    $this->ci->db->insert(LANG_DS_TABLE, $lang_ds_data);
                    ++$i;
                }
            }
        }

        $this->ci->cache->delete(LANG_DS_TABLE, $module_gid);
    }

    /**
     * Resort data source entry
     *
     * @param string $module_gid  module guid
     * @param string $gid         entry guid
     * @param array  $sorter_data sorting data
     * @param array  $languages   languages identifiers
     *
     * @return void
     */
    public function set_reference_sorter($module_gid, $gid, $sorter_data, $languages)
    {
        if (empty($sorter_data)) {
            return false;
        }

        $i = 1;
        foreach ($sorter_data as $index => $option_gid) {
            $update['sorter'] = $i;
            $this->ci->db->where('type', 'option');
            $this->ci->db->where('option_gid', $option_gid);
            $this->ci->db->where('module_gid', $module_gid);
            $this->ci->db->where('gid', $gid);
            $this->ci->db->update(LANG_DS_TABLE, $update);
            ++$i;
        }

        $this->ci->cache->delete(LANG_DS_TABLE, $module_gid);
    }

    /**
     * Remove data source enrty
     *
     * @param string $module_gid module guid
     * @param array  $gids       entries guids
     *
     * @return void
     */
    public function delete_module_reference($module_gid, $gids)
    {
        foreach ($gids as $gid) {
            $this->ci->db->where('module_gid', $module_gid);
            $this->ci->db->where('gid', $gid);
            $this->ci->db->delete(LANG_DS_TABLE);
        }

        $this->ci->cache->delete(LANG_DS_TABLE, $module_gid);
    }

    /**
     * Remove data source module
     *
     * @param string $module_gid module guid
     *
     * @return void
     */
    public function delete_module($module_gid)
    {
        $this->ci->db->where('module_gid', $module_gid);
        $this->ci->db->delete(LANG_DS_TABLE);

        $this->ci->cache->delete(LANG_DS_TABLE, $module_gid);
    }

    /**
     * Install properties depended on language
     *
     * @param integer $lang_id language idnetifier
     *
     * @return void
     */
    public function add_language($lang_id)
    {
        ////// add field to base
        if (!$this->ci->db->table_exists(LANG_DS_TABLE)) {
            $this->create_table();
        }

        $field_name = "value_" . $lang_id;
        if (!$this->ci->db->field_exists($field_name, LANG_DS_TABLE)) {
            $this->ci->load->dbforge();
            $fields = [
                $field_name => ['type' => 'TEXT', 'null' => false],
            ];
            $this->ci->dbforge->add_column(LANG_DS_TABLE, $fields);
        }

        $this->ci->cache->flush(LANG_DS_TABLE);
    }

    /**
     * Uninstall properties depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function delete_language($lang_id)
    {
        ////// delete field from base

        if (!$this->ci->db->table_exists(LANG_DS_TABLE)) {
            $this->create_table();
        }

        $field_name = "value_" . $lang_id;
        if ($this->ci->db->field_exists($field_name, LANG_DS_TABLE)) {
            $this->ci->load->dbforge();
            $this->ci->dbforge->drop_column(LANG_DS_TABLE, $field_name);
        }

        $this->ci->cache->flush(LANG_DS_TABLE);
    }

    /**
     * Copy data to another language
     *
     * @param integer $lang_from source language identifier
     * @param integer $lang_to   destination language idnetifier
     *
     * @return void
     */
    public function copy_language($lang_from, $lang_to)
    {
        $field_name_from = "value_" . $lang_from;
        $field_name_to = "value_" . $lang_to;
        $this->ci->db->query('UPDATE ' . LANG_DS_TABLE . ' SET ' . $field_name_to . '=' . $field_name_from);

        $this->ci->cache->flush(LANG_DS_TABLE);
    }

    /**
     * Install data source structure
     *
     * @return void
     */
    public function create_table()
    {
        $this->ci->load->dbforge();

        $fields = [
            'id' => [
                'type'           => 'INT',
                'constraint'     => 3,
                'null'           => false,
                'auto_increment' => true,
            ],
            'module_gid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'gid' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'option_gid' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => "'header', 'option'",
                'null'       => false,
                'default'    => 'option',
            ],
            'sorter' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'null'       => false,
            ],
        ];

        $this->ci->dbforge->add_field($fields);
        $this->ci->dbforge->add_key('id', true);
        $this->ci->dbforge->add_key('module_gid');
        $this->ci->dbforge->add_key('sorter');
        $this->ci->dbforge->create_table(LANG_DS_TABLE);
    }
}
