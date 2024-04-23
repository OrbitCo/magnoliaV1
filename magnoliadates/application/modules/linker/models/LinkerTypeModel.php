<?php

declare(strict_types=1);

namespace Pg\modules\linker\models;

define('LINKER_TABLE', DB_PREFIX . 'linker');
define('LINKER_TYPES_TABLE', DB_PREFIX . 'linker_types');
define('LINKER_SEPARATED_PREFIX', DB_PREFIX . 'linker_sep_');

/**
 * Linker type Model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class LinkerTypeModel extends \Model
{
    /**
     * Get link type by ID
     *
     * @param integer $type_id
     *
     * @return mixed
     */
    public function getTypeById($type_id)
    {
        $type_id = intval($type_id);
        if (!$type_id) {
            return false;
        }

        $this->ci->db->select('id, gid, separated, lifetime, unique_type');
        $this->ci->db->from(LINKER_TYPES_TABLE);
        $this->ci->db->where('id', $type_id);

        //_compile_select;
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            $rt = get_object_vars($result[0]);
            $rt["table_name"] = ($rt["separated"]) ? LINKER_SEPARATED_PREFIX . $rt["gid"] : LINKER_TABLE;

            return $rt;
        } else {
            return false;
        }
    }

    /**
     * Get link type by GID
     *
     * @param string $type_gid
     *
     * @return mixed
     */
    public function getTypeByGid($type_gid)
    {
        $type_gid = preg_replace("/[^a-z_]/", "", strtolower($type_gid));
        if (!$type_gid) {
            return false;
        }

        $this->ci->db->select('id, gid, separated, lifetime, unique_type');
        $this->ci->db->from(LINKER_TYPES_TABLE);
        $this->ci->db->where('gid', $type_gid);

        //_compile_select;
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            $rt = get_object_vars($result[0]);
            $rt["table_name"] = ($rt["separated"]) ? LINKER_SEPARATED_PREFIX . $rt["gid"] : LINKER_TABLE;

            return $rt;
        } else {
            return false;
        }
    }

    /**
     * Get link type ID by GID
     *
     * @param string $type_gid
     *
     * @return mixed
     */
    public function getTypeIdByGid($type_gid)
    {
        $type = $this->get_type_by_gid($type_gid);
        if ($type !== false && !empty($type["id"])) {
            return $type["id"];
        }

        return false;
    }

    /**
     * Create link type
     *
     * @param string  $gid         linker type GID [a-z_]
     * @param integer $separated   It shows, to create separate table for the link
     * @param integer $lifetime    time in sec., 0-unlimited
     * @param string  $unique_type 'no'/'update'/'noupdate' link replace type
     *
     * @return integer link ID
     */
    public function createType($gid, $separated = 0, $lifetime = 0, $unique_type = 'no')
    {
        $gid = preg_replace("/[^a-z_]/", "", strtolower($gid));

        $id = $this->get_type_id_by_gid($gid);
        if (!$id) {
            $data = [
                'gid'       => $gid,
                'separated' => intval($separated),
            ];

            $this->ci->db->insert(LINKER_TYPES_TABLE, $data);
            $id = $this->get_type_id_by_gid($gid);
        }
        if ($separated) {
            $this->create_table($gid);
        }

        return $id;
    }

    /**
     * Delete link type by ID or GID
     *
     * @param mixed $id integer ID / string GID
     */
    public function deleteType($id)
    {
        if (!is_int($id)) {
            $id = $this->get_type_id_by_gid($id);
        }
        $this->ci->db->where('id', $id);
        $this->ci->db->delete(LINKER_TYPES_TABLE);

        return;
    }

    /**
     * Create a separated table for Link type
     *
     * @param string $gid
     */
    public function createTable($gid)
    {
        $table_name = LINKER_SEPARATED_PREFIX . $gid;
        if (!$this->ci->db->table_exists($table_name)) {
            $this->ci->load->dbforge();

            $fields = [
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 3,
                    'null'           => false,
                    'auto_increment' => true,
                ],
                'id_link_1' => [
                    'type'       => 'INT',
                    'constraint' => 3,
                    'null'       => false,
                ],
                'id_link_2' => [
                    'type'       => 'INT',
                    'constraint' => 3,
                    'null'       => false,
                ],
                'date_add' => [
                    'type' => 'DATETIME',
                ],
                'sorter' => [
                    'type'       => 'INT',
                    'constraint' => 3,
                    'null'       => false,
                ],
            ];
            $this->ci->dbforge->add_field($fields);
            $this->ci->dbforge->add_key('id', true);
            $this->ci->dbforge->add_key(['id_link_1', 'id_link_2']);
            $this->ci->dbforge->add_key('sorter');
            $this->ci->dbforge->create_table($table_name);
        }

        return $table_name;
    }

    public function __call($name, $args)
    {
        $methods = [
            'create_table' => 'createTable',
            'create_type' => 'createType',
            'delete_type' => 'deleteType',
            'get_type_by_gid' => 'getTypeByGid',
            'get_type_by_id' => 'getTypeById',
            'get_type_id_by_gid' => 'getTypeIdByGid',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
