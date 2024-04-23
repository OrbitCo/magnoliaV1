<?php

namespace Pg\modules\users\models;

use Pg\libraries\EventDispatcher;
use Pg\modules\users\models\events\EventUsers;

use Pg\libraries\Cache\Manager as CacheManager;

class UsersExtendedRegistrationModel extends UsersModel
{
    public $registration_form_gid = "registration_form";

    public function validate($user_id = null, $data = [], $file_name = "", $section_gid = null, $type = 'select')
    {
        $return = ["errors" => [], "data" => []];

        $auth = $this->ci->session->userdata("auth_type");
        $this->ci->config->load('reg_exps', true);
        if (isset($data["roles"])) {
            $return["data"]["roles"] = $data["roles"];
        }

        if (isset($data["user_logo"])) {
            $return["data"]["user_logo"] = strip_tags($data["user_logo"]);
        }

        if (isset($data["user_logo_moderation"])) {
            $return["data"]["user_logo_moderation"] = strip_tags($data["user_logo_moderation"]);
        }
        $this->ci->load->model('Moderation_model');

        if (isset($data["fk_referral_id"]) && is_numeric($data["fk_referral_id"]) && $this->ci->pg_module->get_module_config('referral_links', 'is_active')) {
            $return["data"]["fk_referral_id"] = intval(strip_tags($data["fk_referral_id"]));
            $is_user  = $this->getUserById($return["data"]["fk_referral_id"]);
            if (!$is_user) {
                unset($return["data"]["fk_referral_id"]);
            }
        }
        $name_expr = $this->ci->config->item('name', 'reg_exps');
        if (isset($data["fname"])) {
            $return["data"]["fname"] = strip_tags($data["fname"]);
            $bw_count = $this->ci->Moderation_badwords_model->checkBadwords($this->moderation_type[1],
                $return["data"]["fname"]);
            if ($bw_count || strpbrk($return["data"]["fname"], $name_expr) !== false) {
                $return['errors']['fname'] = l('error_badwords_fname', 'users');
            }
        }

        if (isset($data["sname"])) {
            $return["data"]["sname"] = strip_tags($data["sname"]);
            $bw_count = $this->ci->Moderation_badwords_model->checkBadwords($this->moderation_type[1], $return["data"]["sname"]);
            if ($bw_count || strpbrk($return["data"]["sname"], $name_expr) !== false) {
                $return['errors']['sname'] = l('error_badwords_sname', self::MODULE_GID);
            }
        }

        if (isset($data["user_type"])) {
            $user_types = $this->getUserTypes();
            if ($type == 'select') {
                if (is_array($data["user_type"])) {
                    $user_type = in_array("undefined", $data["user_type"]) ? array_slice($data["user_type"], 1) : $data["user_type"];
                    $return["data"]["user_type"] = count($user_type) > 1 ? 0 : $user_type[0];
                } else {
                    if (in_array($data["user_type"], $user_types) === true) {
                        $return["data"]["user_type"] = $data["user_type"];
                    } else {
                        $return["errors"]["user_type"] = l('error_user_type_select', self::MODULE_GID);
                    }
                }
            } else {
                if (in_array($data["user_type"], $user_types) === true) {
                    $return["data"]["user_type"] = $data["user_type"];
                } else {
                    $return["errors"]["user_type"] = l('error_user_type_select', self::MODULE_GID);
                }
            }
            $return["success"]["user_type"] = "";
        }

        if ($this->ci->pg_module->is_module_installed('perfect_match')) {
            if (isset($data["looking_user_type"])) {
                $return["data"]["looking_user_type"]    = $data["looking_user_type"];
                $return["success"]["looking_user_type"] = "";
            }

            $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
            $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');
            if (isset($data['age_min'])) {
                $return["data"]["age_min"] = intval($data['age_min']);
                if ($return["data"]["age_min"] < $age_min || $return["data"]["age_min"] > $age_max) {
                    $return["data"]["age_min"] = $age_min;
                }
            }
            if (isset($data['age_max'])) {
                $return["data"]["age_max"] = intval($data['age_max']);
                if ($return["data"]["age_max"] < $age_min || $return["data"]["age_max"] > $age_max) {
                    $return["data"]["age_max"] = $age_max;
                }
                if (!empty($return["data"]["age_min"]) && $return["data"]["age_min"] > $return["data"]["age_max"]) {
                    $return["data"]["age_min"] = $age_min;
                }
            }
        }

        if (isset($data["nickname"])) {
            $login_expr = $this->ci->config->item('nickname', 'reg_exps');
            $return["data"]["nickname"] = strip_tags($data["nickname"]);
            if (empty($return["data"]["nickname"]) || !preg_match($login_expr, $return["data"]["nickname"])) {
                $return["errors"]["nickname"] = l('error_nickname_incorrect', self::MODULE_GID);
            }
            $params = [];
            $params["where"]["nickname"] = $return["data"]["nickname"];
            if ($user_id) {
                $params["where"]["id <>"] = $user_id;
            }
            $count = $this->getUsersCount($params);
            if ($count > 0) {
                $return["errors"]["nickname"] = l('error_nickname_already_exists', self::MODULE_GID);
            }
            if (empty($return["errors"]["nickname"])) {
                $return["success"]["nickname"] = "";
            }
            $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type[1], $return["data"]["nickname"]);
            if ($bw_count) {
                $return['errors']['nickname'] = l('error_badwords_nickname', self::MODULE_GID);
            }
        }

        if (isset($data["user_open_id"])) {
            $return["data"]["user_open_id"] = trim($data["user_open_id"]);
        }

        if (isset($data["id_country"])) {
            $return["data"]["id_country"] = $data["id_country"];
        }

        if (isset($data["id_region"])) {
            $return["data"]["id_region"] = intval($data["id_region"]);
        }

        if (isset($data["id_city"])) {
            $return["data"]["id_city"] = intval($data["id_city"]);
        }

        if (isset($data['lat'])) {
            $return['data']['lat'] = floatval($data['lat']);
        }

        if (isset($data['lon'])) {
            $return['data']['lon'] = floatval($data['lon']);
        }

        if (isset($data["phone"])) {
            $return["data"]["phone"] = trim(strip_tags($data["phone"]));
        }

        if (isset($data["address"])) {
            $return["data"]["address"] = trim(strip_tags($data["address"]));
        }

        if (isset($data["birth_date"])) {
            if (!empty($data["birth_date"])) {
                $data["birth_date"] = $this->pg_date->strTranslate($data["birth_date"]);
                $birth_date = trim(strip_tags($data["birth_date"]));
                $return["data"]["birth_date"] = date(self::DB_DATE_SIMPLE_FORMAT, strtotime($birth_date));

                $datetime = date_create($return["data"]["birth_date"]);
                if ($datetime) {
                    $user_age = $datetime->diff(date_create('today'))->y;
                } else {
                    $user_age = 0;
                }

                if ($this->ci->pg_module->is_module_installed('perfect_match')) {
                    if ($user_age < $age_min) {
                        $return["errors"]["birth_date"] = str_replace("[age]", $age_min, l("error_user_too_young", self::MODULE_GID));
                    } elseif ($user_age > $age_max) {
                        $return["errors"]["birth_date"] = str_replace("[age]", $age_max, l("error_user_too_old", self::MODULE_GID));
                    } else {
                        $return["success"]["birth_date"] = "";
                    }
                } else {
                    $return["success"]["birth_date"] = "";
                }
            }

            if (empty($return["data"]["birth_date"])) {
                $return["errors"]["birth_date"] = str_replace("[age]", $age_min, l("error_user_too_young", self::MODULE_GID));
            }
        }
        if (isset($data["age"])) {
            $return["data"]["age"] = intval($data["age"]);
        }

        if (isset($data["show_adult"])) {
            $return["data"]["show_adult"] = intval($data["show_adult"]);
        }

        if (isset($data["profile_completion"])) {
            $return["data"]["profile_completion"] = intval($data["profile_completion"]);
        }

        if (isset($data["postal_code"])) {
            $return["data"]["postal_code"] = trim(strip_tags($data["postal_code"]));
        }

        if (empty($user_id) && !isset($data["group_id"])) {
            $this->ci->load->model('users/models/Groups_model');
            $return["data"]["group_id"] = $this->ci->Groups_model->getDefaultGroupId();
        } elseif (isset($data["group_id"])) {
            $return["data"]["group_id"] = intval($data["group_id"]);
        }

        if (isset($data["email"])) {
            $email_expr              = $this->ci->config->item('email', 'reg_exps');
            $return["data"]["email"] = strip_tags($data["email"]);
            if (empty($return["data"]["email"]) || !preg_match($email_expr, $return["data"]["email"])) {
                $return["errors"]["email"] = l('error_email_incorrect', self::MODULE_GID);
            } else {
                unset($params);
                $params["where"]["email"] = $return["data"]["email"];
                if ($user_id) {
                    $params["where"]["id <>"] = $user_id;
                }
                $count = $this->getUsersCount($params);
                if ($count > 0) {
                    $return["errors"]["email"] = l('error_email_already_exists', self::MODULE_GID);
                }
            }
            if (empty($return["errors"]["email"])) {
                $return["success"]["email"] = "";
            }
        }
        if (isset($data["password"])) {
            if (empty($data["password"])) {
                $return["errors"]["password"] = l('error_password_empty', self::MODULE_GID);
            } elseif ($this->ci->pg_module->get_module_config(self::MODULE_GID, 'use_repassword') && $data["password"] != $data["repassword"]) {
                $return["errors"]["repassword"] = l('error_pass_repass_not_equal', self::MODULE_GID);
            } else {
                $password_expr    = $this->ci->config->item('password', 'reg_exps');
                $data["password"] = trim(strip_tags($data["password"]));
                if (!preg_match($password_expr, $data["password"])) {
                    $return["errors"]["password"] = l('error_password_incorrect', self::MODULE_GID);
                } else {
                    $return["data"]["password"] = $data["password"];
                }
            }
        }

        if (in_array($auth, ['user', 'admin']) !== true && $this->ci->router->is_api_class == false && !empty($data['captcha_confirmation'])) {
            $this->ci->load->model('start/models/Start_captcha_model');
            if ($this->ci->Start_captcha_model->
                isCaptcha($data['captcha_confirmation']) === false) {
                $return["errors"]['captcha_confirmation'] = l('error_invalid_captcha', self::MODULE_GID);
            }
        }

        if (empty($data["confirmation"]) && empty($user_id) && $auth !== 'admin') {
            $return["errors"]['confirmation'] = l('error_no_confirmation', self::MODULE_GID);
        }

        if (!empty($file_name) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->validate_upload($this->upload_config_id,
                $file_name);
            if (!empty($img_return["error"])) {
                $return["errors"][] = implode("<br>", $img_return["error"]);
            }
        }

        if (isset($data["confirm"])) {
            $return["data"]["confirm"] = intval($data["confirm"]);
        }

        if (isset($data["approved"])) {
            $return["data"]["approved"] = intval($data["approved"]);
        }

        if (isset($data["activity"])) {
            $return["data"]["activity"] = intval($data["activity"]);
        }

        if (!is_null($section_gid)/* <custom_R> */ || empty($user_id)/* </custom_R> */) {
            $this->ci->load->model('Field_editor_model');
            $params = [];
            if (!empty($section_gid)) {
                /* <custom_R> */
                // $params["where"]["section_gid"] = $section_gid;
                if (is_array($section_gid) !== false) {
                    $params["where_in"]["section_gid"] = $section_gid;
                } else {
                    $params["where"]["section_gid"] = $section_gid;
                }
                /* </custom_R> */
            }
            if ($type == 'save') {
                $validate_data = $this->ci->Field_editor_model->validateFieldsForSave($params, $data);
            } else {
                $validate_data = $this->ci->Field_editor_model->validateFieldsForSelect($params, $data);
            }
            $return["data"] = array_merge($return["data"],
                $validate_data["data"]);
            if (!empty($validate_data["errors"])) {
                $return["errors"] = array_merge($return["errors"], $validate_data["errors"]);
            }
        }

        if (!$user_id) {
            foreach ($this->fields_register as $field) {
                if (!(isset($return["data"][$field]) && $return["data"][$field])) {
                    $return["errors"][] = l('error_empty_fields', self::MODULE_GID);
                    break;
                }
            }
        }

        return $return;
    }

}
