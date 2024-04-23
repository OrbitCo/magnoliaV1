<?php

declare(strict_types=1);

namespace Pg\modules\notifications\models;

/**
 * Access_permissions module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class NotificationsUsersModel extends \Model
{
    /**
     *  Notifications users list table
     */
    public const TABLE_USERS_LIST = 'notifications_users';

    /**
     * Period attributes
     *
     * @var array
     */
    protected $fields = [
        self::TABLE_USERS_LIST => [
            'id',
            'id_user',
            'gid_notification'
        ]
    ];

    /**
     * Class constructor
     *
     * @return NotificationsUsersModel
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(self::TABLE_USERS_LIST);
    }

    /**
     * User notifications
     *
     * @param integer $id_user
     *
     * @return array
     */
    public function getUserNotifications($id_user)
    {
        $nameTable  = DB_PREFIX . self::TABLE_USERS_LIST;
        $result =  $this->ci->cache->get(self::TABLE_USERS_LIST, 'getUserNotifications'.$id_user, function () use ($id_user, $nameTable) {
            $ci = &get_instance();
            return $ci->db->select('gid_notification')
                ->from($nameTable)
                ->where('id_user', $id_user)
                ->get()
                ->result_array();
        });

        $data = [];
        foreach ($result as $value) {
            $data[] = $value['gid_notification'];
        }

        return $data;
    }

    /**
     * Is user by notification
     *
     * @param string $gid
     * @param integer $id_user
     *
     * @return boolean
     */
    public function isUserNotyfication($gid, $id_user)
    {
        $nameTable  = DB_PREFIX . self::TABLE_USERS_LIST;
        $fields     = implode(',', $this->fields[self::TABLE_USERS_LIST]);
        $result     =  $this->ci->cache->get(self::TABLE_USERS_LIST, 'isUserNotyfication'.$gid."IdUser".$id_user, function () use ($gid, $id_user, $nameTable, $fields) {
            $ci = &get_instance();
            return $ci->db->select($fields)
                ->from($nameTable)
                ->where('gid_notification', $gid)
                ->where('id_user', $id_user)
                ->get()
                ->result_array();
        });

        return !empty($result);
    }

    /**
     * Save user notifications list
     *
     * @param integer $id_user
     * @param array $notifications
     *
     * @return void
     */
    public function saveUserNotifications($id_user, $notifications)
    {
        $this->ci->db->where('id_user', $id_user);
        $this->ci->db->delete(DB_PREFIX . self::TABLE_USERS_LIST);
        $this->ci->cache->flush(self::TABLE_USERS_LIST);
        if (!empty($notifications)) {
            foreach ($notifications as $notification) {
                $this->ci->db->insert(DB_PREFIX . self::TABLE_USERS_LIST, [
                    'id_user' => $id_user,
                    'gid_notification' => $notification
                ]);
                $this->ci->db->insert_id();
            }
        }
    }
}
