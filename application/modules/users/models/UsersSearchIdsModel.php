<?php
declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\users\models\events\EventUsers;

class UsersSearchIdsModel extends \Model
{
    /**
     * Number of users
     *
     * @var string
     */
    const COUNT_USERS = 100;

    /**
     * Callbacks
     *
     * @var array
     */
    private $search_data = [
        'featured_users' => 'getFeaturedUsers',
        'notifications' => false,
        'comments' => false,
        'likes' => false,
        'im' => false,
        'shoutbox' => false,
        'donate' => false,
        'new_users' => 'getNewUsers',
        'active_users' => 'getActiveUsers',
        'questions' => false,
        'mailbox' => false,
        'winks' => false,
        'kisses' => false,
        'media' => false,
        'associations' => false,
        'events' => false,
        'companions' => false,
        'store' => false,
        'secret_gifts' => false
    ];

    /**
     * UsersSearchIdsModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Updating the list of users in the session
     *
     * @param array $user_ids
     *
     * @return void
     */
    public static function updateUsersIdsEvent($user_ids)
    {
        $event = new EventUsers();
        $event->setUsersIdsData(['user_ids' => $user_ids]);
        $event_handler = EventDispatcher::getInstance();
        $event_handler->dispatch($event, 'update_search_result_ids');
    }

    /**
     * Sample user id
     *
     * @param string  $gid
     *
     * @return void
     */
    public function resetUserIds($gid)
    {
        $user_ids = [];
        if (!empty($this->search_data[$gid]) && method_exists($this, $this->search_data[$gid])) {
            $users = $this->{$this->search_data[$gid]}();
            if (!empty($users)) {
                foreach ($users as $s_user) {
                    $user_ids[] = $s_user['id'];
                }
            }
        }
        if (($key = array_search($this->ci->session->userdata("user_id"), $user_ids)) !== false) {
            unset($user_ids[$key]);
        }
        self::updateUsersIdsEvent(array_values($user_ids));
    }

    /**
     * Featured Users
     *
     * @return array
     */
    private function getFeaturedUsers()
    {
        return $this->ci->Users_model->getFeaturedUsers(self::COUNT_USERS);
    }

    /**
     * Active Users
     *
     * @return array
     */
    private function getActiveUsers()
    {
        return $this->ci->Users_model->getActiveUsers(self::COUNT_USERS, 0, [
            'where' => ['id !=' => $this->ci->session->userdata("user_id")]
        ]);
    }

    /**
     * New Users
     *
     * @return array
     */
    private function getNewUsers()
    {
        return $this->ci->Users_model->getNewUsers(self::COUNT_USERS);
    }
}
