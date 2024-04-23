<?php

declare(strict_types=1);

namespace Pg\modules\spam\helpers {

    /**
     * Spam management
     *
     * @package PG_RealEstate
     * @subpackage Spam
     *
     * @category    helpers
     *
     * @copyright Pilot Group <http://www.pilotgroup.net/>
     * @author Mikhail Makeev <mmakeev@pilotgroup.net>
     *
     * @version $Revision: 68 $ $Date: 2010-01-11 16:02:23 +0300 (Пн, 11 янв 2010) $ $Author: irina $
     **/
    if (!function_exists("markAsSpamBlock")) {
        /**
         * Show mark as spam button
         *
         * @param array $data
         *
         * @return html
         */
        function markAsSpamBlock($data)
        {
            $ci = &get_instance();

            if (isset($data["is_owner"]) && !empty($data["is_owner"])) {
                return '';
            }

            if (!isset($data["object_id"]) || !intval($data["object_id"]) ||
               !isset($data["type_gid"]) || !$data["type_gid"]) {
                return '';
            }

            $ci->load->model("spam/models/Spam_alert_model");
            $ci->load->model("spam/models/Spam_type_model");

            $type = $ci->Spam_type_model->get_type_by_id($data["type_gid"]);
            if (!$type || !$type["status"]) {
                return "";
            }
            $ci->view->assign("type", $type);
            $ci->view->assign("object_id", $data["object_id"]);

            $rand = rand(100000, 999999);
            $ci->view->assign("rand", $rand);

            $is_guest = $ci->session->userdata("auth_type") != "user";
            $ci->view->assign("is_guest", $is_guest);

            if ($ci->session->userdata("auth_type") == 'user') {
                $user_id = $ci->session->userdata("user_id");
                $is_send = $ci->Spam_alert_model->is_alert_from_poster($type["gid"], $user_id, $data["object_id"]);
                $ci->view->assign('is_send', $is_send);
            } else {
                $is_send = 0;
                $ci->view->assign('is_send', 0);
            }

            /* deprecation: use view_type */
            if (isset($data["template"])) {
                $data["view_type"] = $data["template"];
            } else {
                $data["template"] = "link";
            }
            $ci->view->assign("template", $data["template"]);
            /* deprecation: use view_type */

            $ci->view->assign("icon_size", isset($data['icon_size']) ? $data['icon_size'] : '');

            if (empty($data["view_type"])) {
                $data["view_type"] = "link";
            }

            return $ci->view->fetch("helper_mark_as_spam_" . $data["view_type"], "user", "spam");
        }
    }

    if (!function_exists("adminHomeSpamBlock")) {
        /**
         * Show statistics block on homepage
         */
        function adminHomeSpamBlock()
        {
            $ci = &get_instance();

            $auth_type = $ci->session->userdata("auth_type");
            if ($auth_type != "admin") {
                return "";
            }

            $user_type = $ci->session->userdata("user_type");

            $show = true;

            $stat_spam = [
                "index_method" => true,
            ];

            if ($user_type == "moderator") {
                $show = false;
                $ci->load->model("Moderators_model");
                $methods_spam = $ci->Moderators_model->get_module_methods("spam");
                if ((is_array($methods_spam) && !in_array("index", $methods_spam))) {
                    $show = true;
                } else {
                    $permission_data = $ci->session->userdata("permission_data");
                    if ((isset($permission_data["spam"]["index"]) && $permission_data["spam"]["index"] == 1)) {
                        $show = true;
                        $stat_spam["index_method"] = (bool) $permission_data["spam"]["index"];
                    }
                }
            }

            if (!$show) {
                return "";
            }

            $ci->load->model("spam/models/Spam_type_model");

            $spam_types = $ci->Spam_type_model->get_types(1);
            $stat_spam['types'] = $spam_types;

            $ci->view->assign("stat_spam", $stat_spam);

            // show template from contact module default user theme
            $html = $ci->view->fetch("helper_home_spam_block", "admin", "spam");

            return $html;
        }
    }

}

namespace {

    if (!function_exists("mark_as_spam_block")) {
        function mark_as_spam_block($data)
        {
            return Pg\modules\spam\helpers\markAsSpamBlock($data);
        }
    }

    if (!function_exists("admin_home_spam_block")) {
        function admin_home_spam_block()
        {
            return Pg\modules\spam\helpers\adminHomeSpamBlock();
        }
    }

}
