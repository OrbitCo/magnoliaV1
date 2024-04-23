<?php

declare(strict_types=1);

namespace Pg\modules\languages\controllers;

/**
 * Languages user side controller
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 **/
class Languages extends \Controller
{
    public function changeLang($lang_id)
    {
        $lang_id = intval($lang_id);
        $this->session->set_userdata("lang_id", $lang_id);
        $old_code = $this->pg_language->languages[$this->pg_language->current_lang_id]["code"];
        $this->pg_language->current_lang_id = $lang_id;
        $code = $this->pg_language->languages[$lang_id]["code"];
        $_SERVER["HTTP_REFERER"] = str_replace("/" . $old_code . "/", "/" . $code . "/", $_SERVER["HTTP_REFERER"]);
        $site_url = str_replace("/" . $code . "/", "", site_url());

        if (
            $this->session->userdata('auth_type') == 'user' &&
            $this->pg_module->is_module_installed('users')
        ) {
            $this->load->model('Users_model');
            $save_data['lang_id'] = $lang_id;
            $this->Users_model->saveUser($this->session->userdata('user_id'), $save_data);
        }

        if (strpos($_SERVER["HTTP_REFERER"], $site_url) !== false) {
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            redirect();
        }
    }

    public function ajaxPagesSave($module_gid, $gid, $lang_id = '')
    {
        if ($_ENV['ADD_LANG_MODE']) {
            $value = $this->input->post("text", true);

            if (!empty($gid)) {
                $this->pg_language->pages->set_string($module_gid, $gid, $value, $lang_id);
            }
            echo $value;
        }
        echo "";
    }
}
