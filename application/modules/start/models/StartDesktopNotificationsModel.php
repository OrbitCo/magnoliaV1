<?php

declare(strict_types=1);

namespace Pg\modules\start\models;

/**
 * Start module
 *
 * @copyright   Copyright (c) 2000-2017
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class StartDesktopNotificationsModel extends \Model
{

     /**
     *  Notifications users list table
     */
    const TABLE_USERS_LIST =  'start_desktop_notify_users';

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
     * Notifications gid list
     *
     * @var array
     */
    public $notifications_gid = [
        'bonuses_request' => 'bonuses',
        'chats_request' => 'chats',
        'events_request' => 'events',
        'friendlist_request' => 'friendlist',
        'friendlist_accept' => 'friendlist',
        'mailbox_request' => 'mailbox',
        'referral_links_request' => 'referral_links',
        'secret_gifts' => 'secret_gifts',
        'tickets_request' => 'tickets',
        'virtual_gifts' => 'virtual_gifts',
        'send_money_request' => 'send_money',
        'send_vip_request' => 'send_vip',
        'visitors' => 'users'
    ];

    /**
     * User notifications list settings
     *
     * @var array
     */
    public $user_notifications = [];

    /**
     * Class constructor
     *
     * @return StartDesktopNotificationsModel
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Notifications List
     *
     * @return array
     */
    public function getNotificationsList()
    {
        $data = [];
        foreach ($this->notifications_gid as $gid => $module) {
            if ($this->ci->pg_module->is_module_installed($module)) {
                $data[] = [
                    'gid' => $gid,
                    'name' => l('field_desktop_notify_title_' . $gid, $module)
                ];
            }
        }
        return $data;
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
        $result = $this->ci->db->select('gid_notification')
                ->from(DB_PREFIX . self::TABLE_USERS_LIST)
                ->where('id_user', $id_user)
                ->get()
                ->result_array();
        $data = [];
        foreach ($result as $value) {
            $data[] = $value['gid_notification'];
        }
        $this->user_notifications = $data;
        return $data;
    }

    /**
     * Is notification
     *
     * @param string $gid
     *
     * @return boolean
     */
    public function isNotification($gid)
    {
        if (array_key_exists($gid, $this->notifications_gid) === true) {
            if (empty($this->user_notifications)) {
                $this->getUserNotifications($this->session->userdata('user_id'));
            }
            return in_array($gid, $this->user_notifications);
        }
        return true;
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
        return (bool) current($this->ci->db->select(implode(',', $this->fields[self::TABLE_USERS_LIST]))
                ->from(DB_PREFIX . self::TABLE_USERS_LIST)
                ->where('gid_notification', $gid)
                ->where('id_user', $id_user)
                ->get()
                ->result_array());
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
        if (!empty($notifications)) {
            foreach ($notifications as $gid) {
                $this->ci->db->insert(DB_PREFIX . self::TABLE_USERS_LIST, [
                    'id_user' => $id_user,
                    'gid_notification' => $gid
                ]);
                $this->ci->db->insert_id();
            }
        }
    }
}
