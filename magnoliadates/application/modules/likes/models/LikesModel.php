<?php

declare(strict_types=1);

namespace Pg\modules\likes\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\likes\models\events\EventLikes;

if (!defined('LIKES_TABLE')) {
    define('LIKES_TABLE', DB_PREFIX . 'likes');
}

if (!defined('LIKES_COUNT_TABLE')) {
    define('LIKES_COUNT_TABLE', DB_PREFIX . 'likes_count');
}

/**
 * Likes model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 */
class LikesModel extends \Model
{
    private $_id_likes = [];

    /**
     * Remembers used like id
     *
     * @param string $id_like
     *
     * @return \Likes_model
     */
    public function rememberGid($id_like)
    {
        $this->_id_likes[] = $id_like;

        return $this;
    }

    /**
     * Recalls used likes id
     *
     * @return array
     */
    public function recallGids()
    {
        return array_unique($this->_id_likes);
    }

    /**
     * Clears remembered likes id
     *
     * @return \Likes_model
     */
    public function clearGids()
    {
        $this->_id_likes = [];

        return $this;
    }

    /**
     * Like action
     *
     * @param int    $id_user
     * @param string $id_like
     * @param bool   $action
     *
     * @throws Exception
     *
     * @return \Likes_model
     */
    public function like($id_user, $id_like, $action = 'like')
    {
        if (empty($id_like) || empty($id_user) || !is_string($action)) {
            log_message('error', 'Error while liking');
            throw new \Exception('Error while liking');
        } elseif ('like' === $action) {
            $this->addLike($id_user);
            $this->add($id_user, $id_like);
        } elseif ('unlike' === $action) {
            $this->delete($id_user, $id_like);
        }
        $this->updateCount($id_like);

        return $this;
    }

    public function addLike($id = null)
    {
        if ($id) {
            $event_handler = EventDispatcher::getInstance();
            $event = new EventLikes();
            $event_data = [];
            $event_data['id'] = $id;
            $event_data['action'] = 'likes_add_like';
            $event_data['module'] = 'likes';
            $event->setData($event_data);
            $event_handler->dispatch($event, 'likes_add_like');
        }
    }

    public function bonusCounterCallback($counter = [])
    {
        $event_handler = EventDispatcher::getInstance();
        $event = new EventLikes();
        $event->setData($counter);
        $event_handler->dispatch($event, 'bonus_counter');
    }

    public function bonusActionCallback($data = [])
    {
        $counter = [];
        if (!empty($data)) {
            $counter = $data['counter'];
            $action = $data['action'];
            $counter['count'] = $counter['count'] + 1;
            $counter['is_new_counter'] = $data['is_new_counter'];
            $counter['repetition'] = $data['bonus']['repetition'];
            $this->bonusCounterCallback($counter);
        }
    }

    /**
     * Add like
     *
     * @param int    $id_user
     * @param string $id_like
     *
     * @throws Exception
     *
     * @return \Likes_model
     */
    private function add($id_user, $id_like)
    {
        if (empty($id_like) || empty($id_user)) {
            log_message('error', 'Error while adding like');
            throw new \Exception('Error while adding like');
        }
        $this->ci->db->insert(LIKES_TABLE, [
            'id_like' => $id_like,
            'id_user' => $id_user,
        ]);

        return $this;
    }

    /**
     * Delete like
     *
     * @param int    $id_user
     * @param string $id_like
     *
     * @throws Exception
     *
     * @return \Likes_model
     */
    private function delete($id_user, $id_like)
    {
        if (empty($id_like) || empty($id_user)) {
            log_message('error', 'Error while removing like');
            throw new \Exception('Error while removing like');
        }
        $this->ci->db->where('id_like', $id_like)
                ->where('id_user', $id_user)
                ->delete(LIKES_TABLE);

        return $this;
    }

    /**
     * Get likes count
     *
     * @param string|array $id_like
     *
     * @return array
     */
    public function getCount($id_like = null)
    {
        $this->ci->db->select('id_like, count')->from(LIKES_COUNT_TABLE);
        if (is_array($id_like)) {
            $this->ci->db->where_in('id_like', $id_like);
        } elseif (isset($id_like)) {
            $this->ci->db->where('id_like', $id_like);
        }
        $count = [];
        foreach ($this->ci->db->get()->result_array() as $like) {
            $count[$like['id_like']] = $like['count'];
        }

        return $count;
    }

    /**
     * Get likes count
     *
     * @param string|array $id_likes
     *
     * @return array
     */
    public function getCountSlow($id_likes)
    {
        if (empty($id_likes)) {
            log_message('ERROR', 'Error while counting');
            throw new \Exception('Error while counting');
        } elseif (!is_array($id_likes)) {
            $id_likes = [$id_likes];
        }
        $result = $this->ci->db->select('id_like, COUNT(id_like) AS count')
                        ->from(LIKES_TABLE)->group_by('id_like')
                        ->where_in('id_like', $id_likes)
                        ->get()->result_array();
        if (0 === count($result)) {
            $count = array_fill_keys($id_likes, 0);
        } else {
            $count = [];
            foreach ($result as $like) {
                $count[$like['id_like']] = $like['count'];
            }
        }

        return $count;
    }

    /**
     * Update likes count
     *
     * @param string|array $id_likes
     *
     * @return \Likes_model
     */
    public function updateCount($id_likes = null)
    {
        $counts = $this->getCountSlow($id_likes);
        if (0 === count($counts)) {
            return $this;
        }
        $query = 'INSERT INTO ' . LIKES_COUNT_TABLE . ' (id_like, count) VALUES ';
        $values = '';
        foreach ($counts as $id_like => $count) {
            $values .= "('$id_like', '$count'),";
        }
        $query .= substr($values, 0, -1) . ' ON DUPLICATE KEY UPDATE `count` = VALUES (count)';
        $this->ci->db->query($query);

        return $this;
    }

    /**
     * Get likes
     *
     * @param int          $id_user
     * @param string|array $filter  likes id
     *
     * @throws Exception
     *
     * @return array
     */
    public function getLikesByUser($id_user, $filter = null)
    {
        if (empty($id_user)) {
            log_message('ERROR', 'Error while getting likes');
            throw new \Exception('Error while getting likes');
        }
        $this->ci->db->select('id_like')
                ->from(LIKES_TABLE)
                ->where('id_user', $id_user);
        if ($filter) {
            if (is_array($filter)) {
                $this->ci->db->where_in('id_like', $filter);
            } else {
                $this->ci->db->where('id_like', $filter);
            }
        }
        $results = $this->ci->db->get()->result_array();
        if (!$results) {
            return [];
        }
        $id_likes = [];
        foreach ($results as $result) {
            $id_likes[] = $result['id_like'];
        }

        return array_unique($id_likes);
    }

    /**
     * Get likes
     * @param array $params
     * @return array
     */
    public function getLikes(array $params)
    {
        $this->ci->db->select('id_like')
                ->from(LIKES_TABLE);
        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        return $this->ci->db->get()->result_array();
    }

    /**
     * Get users
     *
     * @param string $id_like
     * @param int    $limit
     *
     * @throws Exception
     *
     * @return array
     */
    public function getUsersByLike($id_like, $limit = 5)
    {
        if (empty($id_like)) {
            log_message('error', 'Error while getting users');
            throw new \Exception('Error while getting users');
        }
        $results = $this->ci->db->select('id_user')
                        ->from(LIKES_TABLE)
                        ->where('id_like', $id_like)
                        ->limit($limit, 0)
                        ->get()->result_array();
        if (!$results) {
            return [];
        }
        $id_users = [];
        foreach ($results as $result) {
            $id_users[] = $result['id_user'];
        }
        $this->ci->load->model('Users_model');
        $default_user = $this->ci->Users_model->format_default_user(1);
        $users = $this->ci->Users_model->get_users_list(null, null, null, [], $id_users, true, true);
        foreach ($id_users as $key => $id) {
            if (!$users[$key]["id"]) {
                $users[$key] = $default_user;
            }
        }

        return $users;
    }

    /**
     * Callback User BLocked
     * @param array $users_ids
     * @param string $is_blocked
     * @return void
     */
    public function callbackUserBLocked(array $users_ids, string $is_blocked)
    {
        if ($is_blocked != '1') {
            $likes = $this->getLikes(['where_in' => ['id_user' => $users_ids]]);
            if (!empty($likes)) {
                $data = [];
                foreach ($likes as $like) {
                    $data[] = $like['id_like'];
                }
                $this->ci->db->where_in('id_user', $users_ids)->delete(LIKES_TABLE);
                $this->updateCount($data);
            }
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'clear_gids' => 'clearGids',
            'get_count' => 'getCount',
            'get_count_slow' => 'getCountSlow',
            'get_likes_by_user' => 'getLikesByUser',
            'get_users_by_like' => 'getUsersByLike',
            'recall_gids' => 'recallGids',
            'remember_gid' => 'rememberGid',
            'update_count' => 'updateCount',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
