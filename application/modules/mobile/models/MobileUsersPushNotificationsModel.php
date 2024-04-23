<?php

declare(strict_types=1);

namespace Pg\modules\mobile\models;

use Kreait\Firebase\Messaging\RawMessageFromArray;
use Kreait\Firebase;
use Pg\modules\blacklist\models\BlacklistModel;

/**
 * Class MobileUsersPushNotificationsModel
 *
 * @package Pg\modules\mobile\models
 *
 * @copyright   Copyright (c) 2000-2020
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class MobileUsersPushNotificationsModel extends MobileModel
{
    /**
     * DB table mobile_users_push_notifications.
     *
     * @var string
     */
    public const DB_TABLE_MOBILE_USERS_PUSH_NOTIFICATIONS = DB_PREFIX . 'mobile_users_push_notifications';

    /**
     * Mobile module tables properties.
     *
     * @var array
     */
    protected $fields = [
        self::DB_TABLE_MOBILE_USERS_PUSH_NOTIFICATIONS => [
            'id',
            'id_user',
            'gid',
            'is_subscribed',
            'date_modified'
        ]
    ];

    /**
     * Get User Push Notifications
     *
     * @param array $params
     * @param bool $is_format
     *
     * @return array
     */
    public function getUserPushNotifications(array $params, bool $is_format = false): array
    {
        $result = $this->getData(self::DB_TABLE_MOBILE_USERS_PUSH_NOTIFICATIONS, $params);

        return ($is_format === true && !empty($result)) ? $this->format($result) : $result;
    }

    /**
     * Set User Push Notifications
     *
     * @param array $attrs
     *
     * @return void
     */
    public function setUserPushNotifications(array $attrs)
    {
        $params = [
            'where' => [
                'id_user' => $attrs['id_user'],
                'gid' => $attrs['gid']
            ]
        ];
        $result = $this->getData(self::DB_TABLE_MOBILE_USERS_PUSH_NOTIFICATIONS, $params);
        if (!empty($result) || $attrs['is_subscribed'] === 0) {
            $this->removeData(self::DB_TABLE_MOBILE_USERS_PUSH_NOTIFICATIONS, $params);
        } else {
            $this->setData(self::DB_TABLE_MOBILE_USERS_PUSH_NOTIFICATIONS, $attrs);
        }
    }

    /**
     * Validate
     *
     * @param array $data
     *
     * @return array[]
     */
    public function validate(array $data): array
    {
        $result = ['errors' => [], 'data' => []];

        if (!empty($data['id_user'])) {
            $result['data']['id_user'] = (int) $data['id_user'];
        } else {
            $result['errors']['id_user'] = l('error_system', 'start');
        }

        if (!empty($data['module']) && !empty($data['gid'])) {
            $result['data']['gid'] = $data['module'] . '__' . $data['gid'];
        } else {
            $result['errors']['module'] = l('error_system', 'start');
        }

        if (isset($data['is_subscribed'])) {
            $result['data']['is_subscribed'] = (int) $data['is_subscribed'];
        } else {
            $result['errors']['is_subscribed'] = l('error_system', 'start');
        }

        return $result;
    }

    /**
     * Format
     *
     * @param array $data
     *
     * @return array
     */
    public function format(array $data): array
    {
        $this->ci->load->model('mobile/models/MobilePushNotificationsModel');

        $notifications = $this->ci->MobilePushNotificationsModel->getPushNotificationsList([
            'where' => [
                'status' => 1
            ]
        ], true);

        $user_subscriptions = array_column($data, 'is_subscribed', 'gid');
        foreach ($notifications as &$item) {
            $item['is_subscribed'] = false;
            if (!empty($user_subscriptions[$item['module'] . '__' . $item['gid']])) {
                $item['is_subscribed'] = true;
            }
        }

        return $notifications;
    }

    /**
     * Check if the user is subscribed
     *
     * @param array $params
     *
     * @return bool
     */
    public function isSubscribed(array $params): bool
    {
        return (bool) $this->getData(self::DB_TABLE_MOBILE_USERS_PUSH_NOTIFICATIONS, $params);
    }

    /**
     * Push notification.
     *
     * @param array $data
     *
     * @throws Firebase\Exception\MessagingException
     * @throws Firebase\Exception\FirebaseException
     *
     * @return false|void
     */
    public function pushNotification(array $data)
    {
        $blocked_ids = (new BlacklistModel())->getBlockedIds($data['viewer_id']);
        if (!empty($blocked_ids) && in_array($data['id_user'], $blocked_ids, true)) {
            return false;
        }

        $msg = [
            'link' => '',
            'message' => '',
            'title' => '',
            'activity' => '',
            'module' => '',
            'receiver_id' => '',
        ];

        $registrationId = $this->getRegTokensByUserId($data['id_user']);
        if (empty($registrationId)) {
            return false;
        }

        if (($data['module'] !== 'mobile') && ($data['gid'] !== 'admin_ticket')) {
            $is_subscribed = $this->isSubscribed(['where' => [
                'id_user' => $data['id_user'], 'module' => $data['module'], 'gid' => $data['gid']
            ]]);
            if (empty($is_subscribed)) {
                return false;
            }
        }

        foreach ($data as $k => $v) {
            $msg[$k] = strval($v);
        }

        if (!is_array($registrationId)) {
            $registrationId = [$registrationId];
        }

        $messaging = (new Firebase\Factory())
            ->withServiceAccount(dirname(SITE_PATH) . '/gaccess.json')
            ->createMessaging();

        $message = new RawMessageFromArray([
            'notification' => [
                'title' => (string)$data['title'] ?? $_SERVER['HTTP_HOST'],
                'body' => (string)$data['body'] ?? l('new_message', 'mobile'),
            ],
            'data' => $msg
        ]);

        $report = $messaging->sendMulticast($message, $registrationId);

        if ($report->failures()->count()) {
            $invalid_tokens = $report->invalidTokens();
            if ($invalid_tokens) {
                $this->deleteFcmByRegistrationIds($invalid_tokens);
            }
        }
    }
}
