<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

/**
 * User types model
 *
 * @package     PG_Dating
 *
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define("USERS_TYPES_TABLE", DB_PREFIX . "users_types");

/**
 * Users types main model
 *
 * @package     PG_Dating
 * @subpackage  Users
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2016 PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class UsersTypesModel extends \Model
{
    /**
     * Model GUID
     *
     * @var string
     */
    public const USER_TYPE = 'user_type';

    public const LOOKING_USER_TYPE = 'looking_user_type';

    public const USER_TYPE_PLURAL = 'user_type_plural';

    protected $fields = [
        'id',
        'name',
        'parent_id',
        'date_created',
    ];

    public const CACHE_NAME = "UsersTypesModel";

    private $users_types_cache = [];

    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(USERS_TYPES_TABLE);
    }

    /**
     * Create user type
     *
     * @param string $type user type neme
     *
     * @return array
     */
    public function createUserType(string $type): array
    {
        $guid_data = $this->createGUID($type);
        if (empty($guid_data["errors"])) {
            $this->addTypes([$guid_data['data']]);
            if ($this->ci->pg_module->is_module_installed('access_permissions')) {
                $this->ci->load->model('access_permissions/models/Access_permissions_model');
                $this->ci->Access_permissions_model->calbackAddUserType($guid_data['data']['name']);
            }
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return $guid_data;
    }

    public function addTypes(array $user_types): bool
    {
        foreach ($user_types as $user_type) {
            $this->ci->db->ignore()->insert(USERS_TYPES_TABLE, $user_type);
        }
        $this->ci->cache->flush(USERS_TYPES_TABLE);
        // TODO: update `user_type` field in USERS_TABLE
        return true;
    }

    public function deleteTypes(array $user_types)
    {
        $this->ci->db->where_in('name', $user_types);
        $this->ci->db->delete(USERS_TYPES_TABLE);
        if ($this->ci->pg_module->is_module_installed('access_permissions')) {
            $this->ci->load->model('access_permissions/models/Access_permissions_model');
            foreach ($user_types as $type) {
                $this->ci->Access_permissions_model->calbackDeleteUserType($type);
            }
        }
        $this->ci->cache->flush(USERS_TYPES_TABLE);
    }

    protected function getType($field, $value)
    {
        if (empty($this->users_types_cache[$field][$value])) {
            $this->users_types_cache[$field][$value] = $this->ci->db->select(implode(', ', $this->fields))
                ->from(USERS_TYPES_TABLE)
                ->where($field, $value)
                ->get()->result_array();
        }

        return $this->users_types_cache[$field][$value];
    }

    public function getTypes()
    {
        $fields = implode(', ', $this->fields);

        return $this->ci->cache->get(self::CACHE_NAME, 'all', function () use ($fields) {
            $ci = &get_instance();

            return $ci->db->select($fields)
                ->from(USERS_TYPES_TABLE)
                ->get()->result_array();
        });
    }

    public function getCountTypes()
    {
        return $this->ci->cache->get(self::CACHE_NAME, 'getCountTypes', function () {
            $ci = &get_instance();

            return $ci->db->count_all_results(USERS_TYPES_TABLE);
        });
    }

    public function getFirstType()
    {
        $fields = implode(', ', $this->fields);

        return $this->ci->cache->get(self::CACHE_NAME, 'getFirstType', function () use ($fields) {
            $ci = &get_instance();

            return $ci->db->select($fields)
                ->from(USERS_TYPES_TABLE)
                ->order_by('id')
                ->limit(1)
                ->get()->result_array();
        });
    }

    public function getTypeById($id)
    {
        if (!is_int($id)) {
            throw new \BadMethodCallException('Invalid param');
        }

        return $this->getType('id', $id)[0];
    }

    public function getTypeByName($name)
    {
        $result = $this->getType('name', $name);
        if (!empty($result)) {
            return $result[0];
        }

        return false;
    }

    public function getTypeWithChildren($id)
    {
        if (!is_int($id)) {
            throw new \BadMethodCallException('Invalid param');
        }
        $table = USERS_TYPES_TABLE;
        $fields = 'T2.' . implode(',T2.', $this->fields);
        $query = "SELECT $fields
                FROM (
                    SELECT
                        @r AS _id,
                        (SELECT @r := parent_id FROM $table WHERE id = _id) AS parent_id,
                        @l := @l + 1 AS lvl
                    FROM
                        (SELECT @r := $id, @l := 0) vars,
                        $table t
                    WHERE @r <> 0) T1
                JOIN $table T2
                ON T1._id = T2.id
                ORDER BY T1.lvl DESC;";

        return $this->ci->db->query($query)->result_array();
    }

    public function getAncestors($id)
    {
        //TBD
    }

    /**
     * Create GUID
     *
     * @param string|null $name
     *
     * @return array
     */
    public function createGUID(string $name = null): array
    {
        $return = [];

        if (!is_null($name)) {
            $this->ci->load->library('Translit');
            $return['data']['name'] = strip_tags($name);
            $return['data']['name'] = mb_strtolower($this->ci->translit->convert('ru', $return['data']['name']));
            $return['data']['name'] = preg_replace("/[\s+|-]/", '_', $return['data']['name']);
            if (empty($return['data']['name'])) {
                $return['errors'][] = l('error_group_name', 'users');
            } else {
                $gid_counts = $this->getTypeByName($return['data']['name']);
                if ($gid_counts) {
                    $return['errors'][] = l('error_group_name_already_exists', 'users');
                }
            }
        }
        $this->ci->cache->flush(self::CACHE_NAME);

        return $return;
    }
}
