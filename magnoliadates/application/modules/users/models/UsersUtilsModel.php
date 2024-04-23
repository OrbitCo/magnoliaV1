<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

/**
 * Users utils model
 *
 * Provides methods to manipulate user data
 *
 * @return boolean
 */
class UsersUtilsModel extends \Model
{
    private $current_user_data = null;

    public function isActived(): bool
    {
        if ($this->ci->session->userdata('auth_type') != 'user') {
            return false;
        }
        return $this->ci->session->userdata('activity') === 1;
    }

    public function getCurrentUserData()
    {
        if (is_null($this->current_user_data)) {
            $this->ci->load->model('Users_model');
            $this->current_user_data = $this->ci->Users_model->getUserById(
                $this->ci->session->userdata('user_id'),
                false,
                true);
        }
        return $this->current_user_data;
    }
}
