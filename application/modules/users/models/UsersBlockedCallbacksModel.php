<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\Libraries\Traits\ModuleModel;

/**
 * user_information module
 *
 * @copyright   Copyright (c) 2000-2019
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class UsersBlockedCallbacksModel extends \Model
{
    use ModuleModel;

    /**
     * DB table name
     *
     * @var string
     */
    public const USERS_BLOCKED_CALLBACKS_TABLE = DB_PREFIX . 'users_blocked_callbacks';

    /**
     * Modules object properties
     *
     * @var array
     */
    private $fields = [
        'id',
        'module',
        'model',
        'callback',
        'callback_gid'
    ];

    /**
     * Modules object properties
     *
     * @var string
     */
    private $fields_str;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->fields_str = implode(', ', $this->fields);
        $this->ci->cache->registerService(self::USERS_BLOCKED_CALLBACKS_TABLE);
    }

    /**
     * Add callback
     *
     * @param array $data
     *
     * @return integer
     */
    public function addCallback(array $data)
    {
        $this->ci->db->insert(self::USERS_BLOCKED_CALLBACKS_TABLE, $data);
        $this->ci->cache->flush(self::USERS_BLOCKED_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    /**
     * Delete callbacks
     *
     * @param string $module
     *
     * @return mixed
     */
    public function deleteCallbacksByModule(string $module)
    {
        $this->ci->db
            ->where('module', $module)
            ->delete(self::USERS_BLOCKED_CALLBACKS_TABLE);
        $this->ci->cache->flush(self::USERS_BLOCKED_CALLBACKS_TABLE);

        return $this->ci->db->affected_rows();
    }

    /**
     * Get callbacks
     *
     * @return mixed
     */
    private function getCallbacks()
    {
        //TODO refactoring in the new version
        $this->tableExists();

        $fields = $this->fields_str;
        $nameTable = self::USERS_BLOCKED_CALLBACKS_TABLE;

        return $this->ci->cache->get(self::USERS_BLOCKED_CALLBACKS_TABLE, 'getCallbacks', function () use ($fields, $nameTable) {
            $ci = &get_instance();

            return $ci->db
                ->select($fields)
                ->from($nameTable)
                ->get()
                ->result_array();
        });
    }

    /**
     * Execute callbacks
     *
     * @param array $users_ids
     * @param string $is_blocked
     *
     * @return mixd
     */
    public function executeCallbacks(array $users_ids, string $is_blocked)
    {
        $cbs = $this->getCallbacks();
        foreach ($cbs as $cb) {
            $method = $cb['callback'];
            $ucfirst_module = $this->ucfirstModule($cb['module']);
            if (class_exists(NS_MODULES . $cb['module'] . '\\models\\' . $ucfirst_module . 'Model') !== false) {
                $model = ucfirst($cb['module']) . '_model';
                $this->ci->load->model($model);

                try {
                    $this->ci->$model->$method($users_ids, $is_blocked);
                } catch (Exception $e) {
                    //TODO
                }
            }
        }
    }

    /**
     * self::USERS_BLOCKED_CALLBACKS_TABLE exist
     *
     * @return void
     */
    private function tableExists()
    {
        //TODO refactoring in the new version
        $is_table_exists = $this->ci->db->table_exists(self::USERS_BLOCKED_CALLBACKS_TABLE);
        if ($is_table_exists === false) {
            $this->ci->load->dbforge();
            $this->ci->dbforge->add_field([
                    'id' => [
                        'type' => 'INT',
                        'constraint' => 3,
                        'null' => false,
                        'auto_increment' => true
                    ],
                    'module' => [
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => false,
                    ],
                    'model' => [
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => false,
                    ],
                    'callback' => [
                        'type' => 'VARCHAR',
                        'constraint' => '255',
                        'null' => false,
                    ],
                    'callback_gid' => [
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'null' => false,
                    ]
                ]);
            $this->ci->dbforge->add_key('id', true);
            $this->ci->dbforge->create_table(self::USERS_BLOCKED_CALLBACKS_TABLE);
        }
    }
}
