<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\modules\blacklist\models\BlacklistModel;

/**
 * Users module
 *
 * @copyright   Copyright (c) 2000-2021
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class UsersAccessModel extends \Model
{
    /**
     * Excluded users list by user_id
     *
     * @var array
     */
    protected $exclude_users = [];

    /**
     * Access list
     *
     * @var array
     */
    protected $access_users = [];

    /**
     * @var array
     */
    protected $objects = [];

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->objects = [
            new BlacklistModel()
        ];
    }

    /**
     * Is access user
     *
     * @param int $first_user I am (current authorized user)
     * @param int $second_user opponent
     *
     * @return bool
     */
    public function isAccess(int $first_user, int $second_user): bool
    {
        $key = "{$first_user}-{$second_user}";
        if (empty($this->access_users[$key])) {
            $this->access_users[$key] = true;
            foreach ($this->objects as $object) {
                if ($object->isAccess($first_user, $second_user) === false) {
                    $this->access_users[$key] = false;
                    break;
                }
            }
        }

        return $this->access_users[$key];
    }

    /**
     * Get exclude users
     *
     * @param int $user_id
     *
     * @return array
     */
    public function excludeUsers(int $user_id): array
    {
        if (empty($this->access_users[$user_id])) {
            $this->access_users[$user_id] = [];
            foreach ($this->objects as $object) {
                array_push($this->access_users[$user_id], $object->excludeUsers($user_id));
            }
        }

        return current($this->access_users[$user_id]);
    }
}
