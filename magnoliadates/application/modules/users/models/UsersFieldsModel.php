<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

/**
 * Users module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class UsersFieldsModel extends \Model
{

    /**
     * User fields
     *
     * @var array
     */
    public $fields = [
        'looking_user_type' => [
            'type' => 'select',
            'data' => 'lookingUserType'
         ],
        'age_min' => [
            'type' => 'select',
            'data' => 'lookingUserType'
         ],
        'age_max' => [
            'type' => 'select',
            'data' => 'lookingUserType'
         ],
        'nickname' => [
            'type' => 'text',
            'data' => 'nickname'
        ],
        'fname' => [
            'type' => 'text',
            'data' => 'fname'
        ],
        'sname' => [
            'type' => 'text',
            'data' => 'sname'
        ],
        'fname_sname' => [
            'type' => 'text|text',
            'data' => 'fnameSname'
        ],
        'location' => [
            'type' => 'autocomplete',
            'data' => 'location'
        ],
        'birth_date' => [
            'type' => 'datepicker',
            'data' => 'birthDate'
        ],
        'id_city' => [
            'type' => 'hidden',
        ],
        'id_country' => [
            'type' => 'hidden',
        ],
        'id_region' => [
            'type' => 'hidden',
        ],
        'lat' => [
            'type' => 'hidden',
        ],
        'lon' => [
            'type' => 'hidden',
        ],
        'region_name' => [
            'type' => 'text',
        ],
    ];

    /**
     * User fields format to str
     *
     * @var array
     */
    public $fields_str = [
        'looking_user_type' => 'lookingUserTypeStr',
        'age_min' => 'lookingUserTypeStr',
        'age_max' => 'lookingUserTypeStr',
        'nickname' => 'nicknameStr',
        'fname' => 'fnameSnameStr',
        'sname' => 'fnameSnameStr',
        'id_country' => 'locationStr',
        'id_region' => 'locationStr',
        'id_city' => 'locationStr',
        'lat' => 'locationStr',
        'lon' => 'locationStr',
        'birth_date' => 'birthDateStr'
    ];

    /**
     * User data
     *
     * @var array
     */
    public $userdata = [];

    /**
     * Constructor
     *
     * @return UsersFieldsModel
     */
    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model(['Users_model', 'Field_editor_model']);

        $this->addCustomFields();
    }


    /**
     * Field data
     *
     * @param string $field
     *
     * @return array
     */
    public function getFieldData(string $field)
    {
        return [
            'type' => $this->fields[$field]['type'],
            'data' => $this->getData($field),
            'view_type' => $this->fields[$field]['settings']['view_type'] ?? '',
        ];
    }

    /**
     * Return data
     *
     * @param string $field
     *
     * @return mixed
     */
    public function getData($field)
    {
        if (method_exists($this, $this->fields[$field]['data'])) {
            return $this->{$this->fields[$field]['data']}($field);
        }
        return false;
    }

    /**
     * Looking user type
     *
     * @return array
     */
    public function lookingUserType()
    {
        $this->ci->load->model('Properties_model');
        $user = $this->getUserData();
        $age_range = range(
            $this->ci->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_min'),
            $this->ci->pg_module->get_module_config(UsersModel::MODULE_GID, 'age_max')
        );
        return [
            'value' => [
                'looking_user_type' => $user['looking_user_type'],
                'age_min' => $user['age_min'],
                'age_max' => $user['age_max']
            ],
            'option' => [
                'looking_user_type' => $this->ci->Properties_model->getProperty(
                    'looking_user_type',
                    $this->ci->pg_language->current_lang_id
                )['option'],
                'age_min' => $age_range,
                'age_max' => $age_range
            ]
         ];
    }

     /**
     * User date of birth
     *
     * @return array
     */
    public function birthDate()
    {
        return [
            'value' => $this->getUserData()['birth_date_raw']
        ];
    }

    /**
     * Nikname
     *
     * @return array
     */
    public function nickname()
    {
        return [
            'value' => $this->ci->session->userdata['nickname']
        ];
    }

    /**
     * First name and Second name
     *
     * @return array
     */
    public function fnameSname()
    {
        return [
            $this->fname(),
            $this->sname()
        ];
    }

    /**
     * First name
     *
     * @return array
     */
    public function fname()
    {
        return [
            'field' => 'fname',
            'value' => $this->ci->session->userdata['fname'],
            'name' => l('field_name', UsersModel::MODULE_GID)
        ];
    }

    /**
     * Second name
     *
     * @return array
     */
    public function sname()
    {
        return [
            'field' => 'sname',
            'value' => $this->ci->session->userdata['sname'],
            'name' => l('field_sname', UsersModel::MODULE_GID)
        ];
    }

    /**
     * Location data
     *
     * @return array
     */
    public function location()
    {
        $this->ci->load->helper('countries');
        $user = $this->getUserData();
        return [
            'value' => \Pg\modules\countries\helpers\locationSelect([
                'module' => 'countries',
                'select_type' => 'city',
                'is_button' => true,
                'id_country' => $user['id_country'],
                'id_region' => $user['id_region'],
                'id_city' => $user['id_city'],
                'var_country_name' => 'id_country',
                'var_region_name' => 'id_region',
                'var_city_name' => 'id_city'
            ])
        ];
    }

    /**
     * User data
     *
     * @return array
     */
    public function getUserData($refresh_cache = false)
    {
        if (empty($this->userdata) || $refresh_cache) {
            $this->userdata = $this->ci->Users_model->getUserById($this->ci->session->userdata['user_id'], true);
        }
        return $this->userdata;
    }

    /**
     * Create string user data
     *
     * @param array $data
     *
     * @return string
     */
    public function getFieldDataStr($data, $refresh_cache = false)
    {
        $user = $this->getUserData($refresh_cache);
        foreach ($data as $field => $value) {
            if (array_key_exists($field, $this->fields_str) === true) {
                return $this->{$this->fields_str[$field]}($user, $field);
            }
        }
        return '';
    }

    /**
     * Update user session
     *
     * @param array $data
     *
     * @return void
     */
    public function updateSessionByFields(array $data)
    {
        foreach ($data as $field => $value) {
            $this->ci->session->set_userdata($field, $value);
            $this->userdata[$field] = $value;
        }
    }

    public function nicknameStr($user, $field)
    {
        return $user[$field];
    }

    /**
     * Looking user type (String)
     *
     * @param array $user
     *
     * @return string
     */
    public function lookingUserTypeStr($user)
    {
        return $user['looking_user_type_str'] . ',&nbsp;' .
            l('field_aged', UsersModel::MODULE_GID) . '&nbsp;' .
            $user['age_min'] . '&nbsp;-&nbsp;' . $user['age_max'];
    }

    /**
     * First name and Second name (String)
     *
     * @param array $user
     *
     * @return string
     */
    public function fnameSnameStr($user)
    {
        return $user['fname'] . '&nbsp;' . $user['sname'];
    }

     /**
     * User date of birth
     *
     * @return array
     */
    public function birthDateStr($user)
    {
        if (strtotime($user["birth_date"])) {
            return tpl_date_format($user["birth_date"], $this->ci->pg_date->get_format('date_literal', 'st'));
        } else {
            return tpl_date_format($user["birth_date_raw"], $this->ci->pg_date->get_format('date_literal', 'st'));
        }
    }

    /**
     * Location data (String)
     *
     * @param array $user
     *
     * @return string
     */
    public function locationStr($user)
    {
        if (!empty($user["id_country"])) {
            $this->ci->load->helper('countries');
            $user_for_location = [
                $this->ci->session->userdata['user_id'] => [
                    'country' => $user["id_country"],
                    'region'  => $user["id_region"],
                    'city'    => $user["id_city"]
                ]
            ];
            return  \Pg\modules\countries\helpers\citiesOutputFormat($user_for_location)[$this->ci->session->userdata['user_id']];
        } else {
            return $this->getUserData()['location'];
        }
    }

    /**
     * Add custom field data
     *
     * @return void
     */
    public function addCustomFields()
    {
        $this->ci->Field_editor_model->initialize(UsersModel::MODULE_GID);
        $sections = $this->ci->Field_editor_model->getSectionList();
        $sections_gids = array_keys($sections);
        $fields_for_select = $this->ci->Field_editor_model->getFieldsForSelect($sections_gids);
        $this->ci->Users_model->setAdditionalFields($fields_for_select);
        $user = $this->getUserData();
        foreach ($sections as $sgid => $sdata) {
            $fields[$sgid] = $this->ci->Field_editor_model->getFormFieldsList($user, ['where' => ['section_gid' => $sgid]]);
            foreach ($fields[$sgid] as $key => $value) {
                $this->fields[$value['field_name']]['type'] = $value['field_type'];
                $this->fields[$value['field_name']]['data'] = $value['field_type'] . 'CustomFieldType';
                $this->fields[$value['field_name']]['settings'] = $value['settings_data_array'];
                $this->fields_str[$value['field_name']] = $value['field_type'] . 'CustomFieldTypeStr';
            }
        }
    }

    /**
     * Return select data (custom field)
     *
     * @param $field
     * @return array
     */
    public function selectCustomFieldType($field)
    {
        $user = $this->getUserData();
        $item = substr($field, 3);
        $data = $this->ci->Field_editor_model->getFormFieldsList($user, ['where' => ['gid' => $item]])[$item];

        return [
            'value' => [
                $data['field_name'] => $user[$field] ?: $data['settings_data_array']['default_value']
            ],
            'option' => [
                $data['field_name'] => $data['options']['option']
            ],
            'settings' => [
                $data['field_name'] => $data['settings_data_array']
            ]
        ];
    }

    /**
     * Return select data (custom field) (String)
     *
     * @param array  $user
     * @param string $field
     *
     * @return string
     */
    public function selectCustomFieldTypeStr($user, $field)
    {
        $item = substr($field, 3);
        $this->ci->Users_model->setAdditionalFields([$field]);
        return $this->Field_editor_model->
            formatItemFieldsForView(['where' => ['gid' => $item]], $user)[$item]['value'];
    }

    /**
     * Custom field [multiselect]
     *
     * @param string $field
     *
     * @return array
     */
    public function multiselectCustomFieldType($field)
    {
        $user = $this->getUserData();
        $item = substr($field, 3);
        $data = $this->ci->Field_editor_model->getFormFieldsList($user, ['where' => ['gid' => $item]])[$item];
        return [
            'value' => [
                $data['field_name'] => $this->Field_editor_model->
                    formatItemFieldsForView(['where' => ['gid' => $item]], $user)[$item]['value_array'] ??
                    $data['settings_data_array']['default_value']
            ],
            'option' => [
                $data['field_name'] => $data['options']['option']
            ]
         ];
    }

    /**
     * Custom field [multiselect]
     *
     * @param array $user
     * @param string $field
     *
     * @return string
     */
    public function multiselectCustomFieldTypeStr($user, $field)
    {
        $item = substr($field, 3);
        $this->ci->Users_model->setAdditionalFields([$field]);
        return $this->Field_editor_model->
            formatItemFieldsForView(['where' => ['gid' => $item]], $user)[$item]['value_str'];
    }

    /**
     * Custom field [textarea]
     *
     * @param string $field
     *
     * @return array
     */
    public function textareaCustomFieldType($field)
    {
        $user = $this->getUserData();
        $item = substr($field, 3);
        $data = $this->ci->Field_editor_model->getFormFieldsList($user, ['where' => ['gid' => $item]])[$item];
        return  [
            'field' => $field,
            'value' => $this->ci->Field_editor_model->
            getFormFieldsList($user, ['where' => ['gid' => $item]])[$item]['value'] ?: $data['settings_data_array']['default_value']
         ];
    }

    /**
     * Custom field [textarea]
     *
     * @param array $user
     * @param string $field
     *
     * @return string
     */
    public function textareaCustomFieldTypeStr($user, $field)
    {
        $item = substr($field, 3);
        $this->ci->Users_model->setAdditionalFields([$field]);
        return $this->Field_editor_model->
            formatItemFieldsForView(['where' => ['gid' => $item]], $user)[$item]['value'];
    }

    /**
     * Custom field [text]
     *
     * @param string $field
     *
     * @return array
     */
    public function textCustomFieldType($field)
    {
        $user = $this->getUserData();
        $item = substr($field, 3);
        $data = $this->ci->Field_editor_model->getFormFieldsList($user, ['where' => ['gid' => $item]])[$item];
        $value = $data['value'];
        return  [
            'field' => $field,
            'value' => $value ?: $data['settings_data_array']['default_value']
         ];
    }

    /**
     * Custom field [text]
     *
     * @param array $user
     * @param string $field
     *
     * @return string
     */
    public function textCustomFieldTypeStr($user, $field)
    {
        $item = substr($field, 3);
        $this->ci->Users_model->setAdditionalFields([$field]);
        $value = $this->Field_editor_model->formatItemFieldsForView(['where' => ['gid' => $item]], $user)[$item]['value'];

        if (empty($value)){
            $tmp = $this->ci->Field_editor_model->getFormFieldsList($user, ['where' => ['gid' => $item]])[$item];
            $value = $tmp['settings_data_array']['default_value'];
        }

        return $value;
    }

    /**
     * Custom field [checkbox]
     *
     * @param string $field
     *
     * @return array
     */
    public function checkboxCustomFieldType($field)
    {
        $item = substr($field, 3);
        $user = $this->getUserData();
        $data = $this->ci->Field_editor_model->getFormFieldsList($user, ['where' => ['gid' => $item]])[$item];
        return  [
            'field' => $field,
            'value' => $this->ci->Field_editor_model->
                getFormFieldsList($user, ['where' => ['gid' => $item]])[$item]['value'] ?: $data['settings_data_array']['default_value'],
            'option' => l('field_status_yes', 'users')
        ];
    }

    /**
     * Custom field [checkbox]
     *
     * @param array $user
     * @param string $field
     *
     * @return string
     */
    public function checkboxCustomFieldTypeStr($user, $field)
    {
        $item = substr($field, 3);
        $this->ci->Users_model->setAdditionalFields([$field]);
        return  l($this->Field_editor_model->formatItemFieldsForView(
            ['where' => ['gid' => $item]],
            $user
        )[$item]['value'] ?
            'option_checkbox_yes' : 'option_checkbox_no', 'start');
    }

    /**
     * Custom field [range]
     *
     * @param string $field
     *
     * @return array
     */
    public function rangeCustomFieldType($field)
    {
        $item = substr($field, 3);
        $data = $this->ci->Field_editor_model->getFormFieldsList(
            $this->getUserData(),
            ['where' => ['gid' => $item]]
        )[$item];

        $this->ci->load->helper('start');
        return [
            'value' => \Pg\modules\start\helpers\slider([
                'id' =>  $field . '_slider',
                'single' => 1,
                'active_always' => 1,
                'min' => $data['settings_data_array']['min_val'],
                'max' => $data['settings_data_array']['max_val'],
                'value' => $data['value'],
                'field_name' => $field
            ])
        ];
    }

    /**
     * Custom field [range]
     *
     * @param array $user
     * @param string $field
     *
     * @return string
     */
    public function rangeCustomFieldTypeStr($user, $field)
    {
        $item = substr($field, 3);
        $this->ci->Users_model->setAdditionalFields([$field]);
        return $this->Field_editor_model->
            formatItemFieldsForView(['where' => ['gid' => $item]], $user)[$item]['value'];
    }
}
