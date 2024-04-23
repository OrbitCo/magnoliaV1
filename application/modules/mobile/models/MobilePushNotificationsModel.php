<?php

declare(strict_types=1);

namespace Pg\modules\mobile\models;

/**
 * Class MobilePushNotificationsModel
 * @package Pg\modules\mobile\models
 *
 * @copyright   Copyright (c) 2000-2020
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class MobilePushNotificationsModel extends MobileModel
{
    /**
     * DB table mobile_push_notifications.
     *
     * @var string
     */
    const DB_TABLE_MOBILE_PUSH_NOTIFICATIONS = DB_PREFIX . 'mobile_push_notifications';

    /**
     * Mobile module tables properties.
     *
     * @var array
     */
    protected $fields = [
        self::DB_TABLE_MOBILE_PUSH_NOTIFICATIONS => [
            'id',
            'module',
            'gid',
            'status',
            'date_modified'
        ]
    ];

    /**
     * Push notifications list.
     *
     * @param array $params
     * @param bool $is_format
     *
     * @return array
     */
    public function getPushNotificationsList(array $params = [], bool $is_format = false): array
    {
        $result = $this->getData(self::DB_TABLE_MOBILE_PUSH_NOTIFICATIONS, $params);

        return ($is_format === true) ? $this->formatPushNotifications($result) : $result;
    }

    /**
     * Push notification.
     *
     * @param array $params
     * @param bool $is_format
     *
     * @return array
     */
    public function getPushNotification(array $params, bool $is_format = false): array
    {
        $result = $this->getData(self::DB_TABLE_MOBILE_PUSH_NOTIFICATIONS, $params);

        return ($is_format === true && !empty($result)) ? $this->formatPushNotification($result) : $result;
    }

    /**
     * Format push notifications list.
     *
     * @param array $data
     *
     * @return array
     */
    public function formatPushNotifications(array $data): array
    {
        foreach ($data as $key => $notification) {
            $data[$key]['name'] = l('push_' . $notification['gid'], $notification['module']);
            $data[$key]['status'] = (bool) $notification['status'];
        }

        return $data;
    }

    /**
     * Format push notification.
     *
     * @param array $data
     *
     * @return array
     */
    public function formatPushNotification(array $data): array
    {
        if (!empty($data)) {
            return current($this->formatPushNotifications([0 => $data]));
        }

        return [];
    }

    /**
     * Set Push Notifications
     *
     * @param array $notifications
     *
     * @return void
     */
    public function setPushNotifications(array $notifications)
    {
        foreach ($notifications as $module => $item) {
            $this->setPushNotification([
                'module' => (string) $module,
                'gid' => (string) key($item),
                'status' => current($item) ? 1 : 0
            ]);
        }
    }

    /**
     * Change push notification.
     *
     * @param array $attrs
     *
     * @return void
     */
    public function setPushNotification(array $attrs)
    {
        if (!empty($attrs)) {
            $this->setData(self::DB_TABLE_MOBILE_PUSH_NOTIFICATIONS, $attrs, null, [
                'where' => ['module' => $attrs['module'], 'gid' => $attrs['gid']],
            ]);
        }
    }

    /**
     * Add push notifications list.
     *
     * @param array $data
     *
     * @return void
     */
    public function callbackAddPushNotifications(array $data)
    {
        foreach ($data as $value) {
            $notification = $this->getPushNotification([
                'where' => ['gid' => $value['gid']],
            ]);
            if (empty($notification)) {
                $this->setData(self::DB_TABLE_MOBILE_PUSH_NOTIFICATIONS, $value);
            }
        }
    }

    /**
     * Delete push notifications list.
     *
     * @param array $gids
     *
     * @return void
     */
    public function callbackDeletePushNotifications(array $gids)
    {
        if (!empty($gids)) {
            $this->ci->db->where_in('gid', $gids);
            $this->ci->db->delete(self::DB_TABLE_MOBILE_PUSH_NOTIFICATIONS);
        }
    }
}
