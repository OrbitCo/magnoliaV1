<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\Libraries\View;

/**
 * Users module
 *
 * @copyright   Copyright (c) 2000-2017
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class UsersFieldsValidationModel extends \Model
{

    /**
     * Validation fields
     *
     * @var array
     */
    public $fields = [
        'email' => 'emailValidation',
        'password' => 'passwordValidation',
        'nickname' => 'nicknameValidation',
        'birth_date' => 'birthDateValidation'
    ];

    /**
     * Constructor
     *
     * @return UsersFieldsValidationModel
     */
    public function __construct()
    {
        parent::__construct();
        if ($this->ci->pg_module->is_module_installed('couples')) {
            $this->fields = \Pg\modules\couples\models\CouplesModel::addValidateFields($this->fields);
        }
    }

    /**
     * Fields rules
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function getRules($data)
    {
        $this->ci->config->load('reg_exps', true);
        if (is_array($data) === true) {
            $rules = [];
            foreach ($data as $field) {
                $rules[$field] = $this->ci->config->item($field, 'reg_exps') ?: $this->ci->config->item('string', 'reg_exps');
            }
            return $rules;
        } else {
            return $this->ci->config->item($data, 'reg_exps');
        }
    }

    /**
     * Field validation
     *
     * @param array $data
     *
     * @return arrya
     */
    public function fieldValidation($data)
    {
        if (isset($this->fields[$data['field']])) {
            return $this->{$this->fields[$data['field']]}($data['value']);
        }
    }

    /**
     * Email validation
     *
     * @param string $data
     *
     * @return array
     */
    public function emailValidation($data)
    {
        $return = [];
        $email = strip_tags($data);
        if (!preg_match($this->getRules('email'), $email) || empty($email)) {
            $return[View::MSG_ERROR]['email'] = l('error_email_incorrect', UsersModel::MODULE_GID);
        } else {
            $is_empty = $this->isUserByField([
                'where' => ['email' => $email]
            ]);
            if ($is_empty === true) {
                $return[View::MSG_ERROR]['email'] = l('error_email_already_exists', UsersModel::MODULE_GID);
            } else {
                $return[View::MSG_SUCCESS]['email'] = View::MSG_SUCCESS;
            }
        }
        return $return;
    }

    /**
     * Password validation
     *
     * @param string $data
     *
     * @return array
     */
    public function passwordValidation($data)
    {
        $return = [];
        $password = trim(strip_tags($data));
        if (!preg_match($this->getRules('password'), $password) || empty($password)) {
            $return[View::MSG_ERROR]['password'] = l('error_password_incorrect', UsersModel::MODULE_GID);
        } else {
            $return[View::MSG_SUCCESS]['password'] = View::MSG_SUCCESS;
        }
        return $return;
    }

    /**
     * Nikcname  validation
     *
     * @param string $data
     *
     * @return array
     */
    public function nicknameValidation($data)
    {
        $return = [];
        $nickname = strip_tags($data);
        if (!preg_match($this->getRules('nickname'), $nickname) || empty($nickname)) {
            $return[View::MSG_ERROR]['nickname'] = l('error_nickname_incorrect', UsersModel::MODULE_GID);
        } else {
            $is_empty = $this->isUserByField([
                'where' => ['nickname' => $nickname]
            ]);
            if ($is_empty === true) {
                $return[View::MSG_ERROR]['nickname'] = l('error_nickname_already_exists', UsersModel::MODULE_GID);
            } else {
                $return[View::MSG_SUCCESS]['nickname'] = View::MSG_SUCCESS;
            }
        }
        return $return;
    }

    /**
     * Birthday validation
     *
     * @param string $data
     *
     * @return array
     */
    public function birthDateValidation($data)
    {
        $return = [];
        $birth_date = trim(strip_tags($this->pg_date->strTranslate($data)));
        $user_age = UsersModel::getUserAge($birth_date);
        $age_min = $this->ci->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min');
        $age_max = $this->ci->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_max');
        if ($user_age < $age_min || $user_age > $age_max) {
            $return[View::MSG_ERROR]['birth_date'] = str_replace(['[min_age]', '[max_age]'], [$age_min, $age_max], l('error_birth_date_incorrect', UsersModel::MODULE_GID));
        } else {
            $return[View::MSG_SUCCESS]['birth_date'] = View::MSG_SUCCESS;
        }
        return $return;
    }

    /**
     * Check users by USERS_TABLE
     *
     * @param array $params
     *
     * @return boolean
     */
    private function isUserByField(array $params)
    {
        if (!empty($params["where"]) && is_array($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        return (bool) $this->ci->db->count_all_results(USERS_TABLE);
    }
}
