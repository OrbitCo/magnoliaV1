<?php

declare(strict_types=1);

namespace Pg\modules\menu\helpers {

    if (!function_exists('getAdminMainMenu')) {

        function getAdminMainMenu()
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');

            // add link to menu
            $menu_data = $ci->Menu_model->getMenuByGid('admin_menu');

            $user_type = $ci->session->userdata("user_type");
            if ($user_type == "admin") {
                $menu_data["check_permissions"] = false;
                $permissions = [];
            } else {
                $menu_data["check_permissions"] = true;
                $permissions = $ci->session->userdata("permission_data");
            }
            
            $menu_items = $ci->Menu_model->getMenuActiveItemsList($menu_data["id"],
                $menu_data["check_permissions"],
                ['moderate_sections' => 'admin_main_menu'],
                0,
                $permissions);
            if ($user_type != 'admin') {
               /**
                * If its' moderator, we should unset menu item, if moderator have
                * no access to the even one menu subitem
                */
                $menu_copy = $menu_items;
                foreach ($menu_items as $mkey => $menu_data) {
                    if ($menu_data['gid'] != 'main_items' && isset($menu_data['sub'])) {
                        foreach ($menu_data['sub'] as $msub_key => $menu_item) {
                            if ($menu_item['controller'] == 'admin_start' && $menu_item['module'] == 'start') {
                                if (!isset($menu_item['sub'])) {
                                    unset($menu_copy[$mkey]['sub'][$msub_key]);
                                } else {
                                    if ($menu_item['gid'] == 'payments_menu_item') {
                                        /**
                                         * Unset payments indicator, if moderator have no access to the paymentList
                                         */
                                        if (!isset($permissions['payments']['paymentsList']) ||
                                            empty($permissions['payments']['paymentsList'])) {
                                            $menu_copy[$mkey]['sub'][$msub_key]['indicator'] = '';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                $menu_items = $menu_copy;
            }
            $ci->view->assign("menu", $menu_items);
            $ci->view->assign("use_material_design_icons", 1);
            
            $html = $ci->view->fetch("main_menu", 'admin', 'menu');
            echo $html;
        }
    }

    if (!function_exists('getAdminLevel1Menu')) {

        function getAdminLevel1Menu($gid)
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');

            // add link to menu
            $menu_data = $ci->Menu_model->getMenuByGid($gid);

            if (empty($menu_data)) {
                return false;
            }
            
            $user_type = $ci->session->userdata("user_type");
            if ($user_type == "admin") {
                $menu_data["check_permissions"] = false;
                $permissions = [];
            } else {
                $menu_data["check_permissions"] = true;
                $permissions = $ci->session->userdata("permission_data");
            }
            $menu_items = $ci->Menu_model->getMenuActiveItemsList($menu_data["id"],
                $menu_data["check_permissions"],
                ['moderate_sections' => 'admin_menu_level1'],
                0,
                $permissions);
          
            $ci->view->assign("menu", $menu_items);
            $html = $ci->view->fetch("level1_menu", null, 'menu');
            echo $html;
        }
    }

    if (!function_exists('getAdminLevel2Menu')) {

        function getAdminLevel2Menu($gid)
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');

            // add link to menu
            $menu_data = $ci->Menu_model->getMenuByGid($gid);

            $user_type = $ci->session->userdata("user_type");
            if ($user_type == "admin") {
                $menu_data["check_permissions"] = false;
                $permissions = [];
            } else {
                $menu_data["check_permissions"] = true;
                $permissions = $ci->session->userdata("permission_data");
            }

            $menu_items = $ci->Menu_model->getMenuActiveItemsList($menu_data["id"],
                $menu_data["check_permissions"],
                [],
                0,
                $permissions);
            $ci->view->assign("menu", $menu_items);
            $html = $ci->view->fetch("level2_menu", 'admin', 'menu');
            echo $html;
        }
    }

    if (!function_exists('getMenu')) {

        function getMenu($gid, $template = '')
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');

            if (!$template) {
                $template = $gid;
            }

            // add link to menu
            $menu_data = $ci->Menu_model->getMenuByGid($gid);
            $menu_items = $ci->Menu_model->getMenuActiveItemsList($menu_data["id"], $menu_data["check_permissions"]);

            $ci->view->assign("template", $template);
            $ci->view->assign("menu", $menu_items);
            $html = $ci->view->fetch($template, 'user', 'menu');
            return $html;
        }
    }

    if (!function_exists('getMenuItem')) {

        function getMenuItem($item_gid, $template)
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');
            $item = $ci->Menu_model->getMenuItemByGid($item_gid);
            $ci->view->assign("item", $item);
            return $ci->view->fetch($template, 'user', 'menu');
        }
    }
    
    if (!function_exists('getMenuItems')) {

        function getMenuItems($gid, $item_gid, $template = '')
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');
            $items = [];

            if (!$template) {
                $template = $gid;
            }

            // add link to menu
            $menu_data = $ci->Menu_model->getMenuByGid($gid);
            $menu_items = $ci->Menu_model->getMenuActiveItemsList($menu_data["id"], $menu_data["check_permissions"]);

            foreach ($menu_items as $item) {
                if ($item['gid'] == $item_gid) {
                    $items = $item;
                }
            }

            $ci->view->assign("menu_items", $items);
            return $ci->view->fetch($template, 'user', 'menu');
        }
    }

    if (!function_exists('getBreadcrumbs')) {

        function getBreadcrumbs($template = '')
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');

            if (!$template) {
                $template = 'helper_breadcrumbs';
            }

            // add link to menu
            $breadcrumbs = $ci->Menu_model->get_breadcrumbs();
            if (empty($breadcrumbs)) {
                return "";
            }

            $ci->view->assign("social_mode", PRODUCT_NAME == 'social');

            $ci->view->assign("breadcrumbs", $breadcrumbs);
            $html = $ci->view->fetch($template, 'user', 'menu');

            return $html;
        }
    }

    if (!function_exists('linkedInstallSetMenu')) {

        function linkedInstallSetMenu($gid, $type = "create", $name = '', $check_permissions = 0)
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');
            if ($type == 'create') {
                return $ci->Menu_model->saveMenu(null, ['gid' => $gid, 'name' => $name, 'check_permissions' => $check_permissions]);
            } elseif ($type == 'none') {
                $menu = $ci->Menu_model->getMenuByGid($gid);
                return $menu['id'];
            } elseif ($type == 'delete') {
                $ci->Menu_model->deleteMenuByGid($gid);
                return '';
            } else {
                return 0;
            }
        }
    }

    if (!function_exists('linkedInstallSetMenuItem')) {

        function linkedInstallSetMenuItem(
            $gid,
            $menu_id,
            $type = "create",
            $parent_id = 0,
            $link = '/',
            $icon = '',
            $material_icon = '',
            $status = 1,
            $sorter = 1,
            $indicator_gid = '',
            $is_external = 0
        ) {
            $ci = &get_instance();
            $ci->load->model('Menu_model');
            $item = $ci->Menu_model->getMenuItemByGid($gid, $menu_id);

            if ($type == 'create' && empty($item['id'])) {
                $item_data = ['gid' => $gid, 'menu_id' => $menu_id, 'parent_id' => $parent_id, 'link' => $link, 'icon' => $icon,
                    'material_icon' =>  $material_icon,
                    'status' => $status, 'sorter' => $sorter, 'is_external' => $is_external, 'indicator_gid' => (string) $indicator_gid];
                return $ci->Menu_model->saveMenuItem(null, $item_data);
            } elseif ($type == 'none' && $item) {
                return $item['id'];
            } elseif ($type == 'delete') {
                $items = $ci->Menu_model->getMenuItemsList($menu_id, false, ['where' => ['gid' => $gid]], null, null, true);
                if (!empty($items)) {
                    foreach ($items as $item) {
                        $ci->Menu_model->deleteMenuItem($item['id']);
                    }
                }
                return '';
            } else {
                return 0;
            }
        }
    }

    if (!function_exists('linkedInstallSetMenuItemLang')) {
        // $lang_data is lang_id => value for update AND lang_id array for export
        function linkedInstallSetMenuItemLang($item_id, $menu_id, $type = "update", $lang_data = [], $lang_tooltip_data
                                   = [], $lang_type = "value")
        {
            $ci = &get_instance();
            $ci->load->model('Menu_model');
            if ($type == 'update' && !empty($lang_data)) {
                return $ci->Menu_model->save_menu_item_lang($item_id, $menu_id, $lang_data, $lang_tooltip_data);
            } elseif ($type == 'export') {
                $return = $ci->Menu_model->_get_item_string_data($menu_id, $item_id, $lang_data, $lang_type);

                return $return;
            }

            return 0;
        }
    }

    if (!function_exists('linkedInstallProcessMenuItems')) {
        // $process_type = 'create', 'update', 'export'
        // $lang_data is lang_id => value for update AND lang_id array for export
        function linkedInstallProcessMenuItems(&$structure, $process_type, $menu_gid, $parent_id, &$items, $lang_prefix = "", $lang_data
                                   = [], $lang_tooltip_data = [])
        {
            $menu_data = $structure[$menu_gid];
            if (empty($menu_data["id"])) {
                $menu_data["id"] = $structure[$menu_gid]["id"] = linkedInstallSetMenu($menu_gid, "none");
            }
            if (empty($menu_data["id"])) {
                return [];
            }
            if ($process_type == "export") {
                $return = [];
            }

            if (!empty($items) && is_array($items)) {
                foreach ($items as $item_gid => $item_data) {
                    if ($process_type == "create") {
                        if (!isset($item_data["action"])) {
                            $item_data["action"] = '';
                        }
                        if (!isset($item_data["link"])) {
                            $item_data["link"] = '/';
                        }
                        if (!isset($item_data["icon"])) {
                            $item_data["icon"] = '';
                        }
                        if (!isset($item_data["material_icon"])) {
                            $item_data["material_icon"] = '';
                        }
                        if (!isset($item_data["status"])) {
                            $item_data["status"] = 0;
                        }
                        if (!isset($item_data["sorter"])) {
                            $item_data["sorter"] = 0;
                        }
                        if (!isset($item_data["is_external"])) {
                            $item_data["is_external"] = 0;
                        }
                        if (!isset($item_data["indicator_gid"])) {
                            $item_data["indicator_gid"] = '';
                        }
                        $items[$item_gid]["id"] = linkedInstallSetMenuItem($item_gid,
                            $menu_data['id'],
                            $item_data["action"],
                            $parent_id,
                            $item_data["link"],
                            $item_data['icon'],
                            $item_data['material_icon'],
                            $item_data["status"],
                            $item_data["sorter"],
                            $item_data["indicator_gid"],
                            $item_data["is_external"]);
                        if (!empty($items[$item_gid]["items"])) {
                            linkedInstallProcessMenuItems($structure,
                                $process_type,
                                $menu_gid,
                                (int) $items[$item_gid]["id"],
                                $items[$item_gid]["items"]);
                        }
                    } elseif ($process_type == "update") {
                        $new_prefix         = $lang_prefix . '_' . $item_gid;
                        $new_prefix_tooltip = $lang_prefix . '_' . $item_gid . "_tooltip";
                        if (!empty($lang_data[$new_prefix])) {
                            $item_lang_data = $lang_data[$new_prefix];
                        } else {
                            $item_lang_data = null;
                        }
                        if (!empty($lang_data[$new_prefix_tooltip])) {
                            $item_lang_tooltip_data = $lang_data[$new_prefix_tooltip];
                        } else {
                            $item_lang_tooltip_data = null;
                        }
                        $item_id = isset($items[$item_gid]["id"]) ? $items[$item_gid]["id"] : null;
                        if (!$item_id) {
                            $items[$item_gid]["id"] = $item_id = linkedInstallSetMenuItem($item_gid,
                                $menu_data["id"],
                                "none");
                        }
                        linkedInstallSetMenuItemLang($item_id,
                            $menu_data["id"],
                            "update",
                            $item_lang_data,
                            $item_lang_tooltip_data);

                        if (!empty($items[$item_gid]["items"])) {
                            linkedInstallProcessMenuItems($structure,
                                $process_type,
                                $menu_gid,
                                $item_id,
                                $items[$item_gid]["items"],
                                $new_prefix,
                                $lang_data,
                                $lang_tooltip_data);
                        }
                    } elseif ($process_type == "export") {
                        $new_prefix         = $lang_prefix . '_' . $item_gid;
                        $new_prefix_tooltip = $lang_prefix . '_' . $item_gid . "_tooltip";
                       

                        if (isset($items[$item_gid]["id"])) {
                            $item_id = $items[$item_gid]["id"];
                        }
                        if (!isset($item_id) || !$item_id) {
                            $items[$item_gid]["id"] = $item_id = linkedInstallSetMenuItem($item_gid,
                                $menu_data["id"],
                                "none");
                        }

                        if ('create' == $items[$item_gid]["action"]) {
                            $return[$new_prefix]         = linkedInstallSetMenuItemLang($item_id,
                                $menu_data["id"],
                                "export",
                                $lang_data);
                            $return[$new_prefix_tooltip] = linkedInstallSetMenuItemLang($item_id,
                                $menu_data["id"],
                                "export",
                                $lang_data,
                                [],
                                'tooltip');
                        }
                        if (!empty($items[$item_gid]["items"])) {
                            $temp   = linkedInstallProcessMenuItems($structure,
                                $process_type,
                                $menu_gid,
                                $item_id,
                                $items[$item_gid]["items"],
                                $new_prefix,
                                $lang_data);
                            $return = array_merge($return, $temp);
                        }
                    }
                }
            }
            if ($process_type == "export") {
                return $return;
            } else {
                return;
            }
        }
    }

    if (!function_exists('linkedInstallDeleteMenuItems')) {

        function linkedInstallDeleteMenuItems($menu_gid, $items)
        {
            $menu_id = linkedInstallSetMenu($menu_gid, "none");
            if (!$menu_id) {
                return false;
            }
            if (!empty($items)) {
                foreach ($items as $item_gid => $item_data) {
                    if (isset($item_data["action"])) {
                        if ($item_data["action"] == 'create') {
                            linkedInstallSetMenuItem($item_gid, $menu_id, "delete");
                        }
                        if (!empty($items[$item_gid]["items"])) {
                            linkedInstallDeleteMenuItems($menu_gid, $items[$item_gid]["items"]);
                        }
                    }
                }
            }

            return;
        }
    }

    if (!function_exists('buttonActionMenu')) {

        function buttonActionMenu($params)
        {
            $ci   = &get_instance();
            $ci->view->assign("user_id", $params['user_id']);
            $html = $ci->view->fetch('helper_actions_menu', 'user', 'menu');
            return $html;
        }
    }

    if (!function_exists('mobileTopMenu')) {

        function mobileTopMenu()
        {
            $ci   = &get_instance();
            $html = $ci->view->fetch('helper_mobile_top_menu', 'user', 'menu');
            return $html;
        }
    }
}

namespace {

    if (!function_exists('get_admin_main_menu')) {

        function get_admin_main_menu()
        {
            return Pg\modules\menu\helpers\getAdminMainMenu();
        }
    }

    if (!function_exists('get_admin_level1_menu')) {

        function get_admin_level1_menu($gid)
        {
            return Pg\modules\menu\helpers\getAdminLevel1Menu($gid);
        }
    }

    if (!function_exists('get_admin_level2_menu')) {

        function get_admin_level2_menu($gid)
        {
            return Pg\modules\menu\helpers\getAdminLevel2Menu($gid);
        }
    }

    if (!function_exists('get_menu')) {

        function get_menu($gid, $template = '')
        {
            return Pg\modules\menu\helpers\getMenu($gid, $template);
        }
    }
    
    if (!function_exists('get_menu_items')) {

        function get_menu_items($gid, $item_gid, $template = '')
        {
            return Pg\modules\menu\helpers\getMenuItems($gid, $item_gid, $template);
        }
    }

    if (!function_exists('get_menu_item')) {

        function get_menu_item($item_gid, $template = '')
        {
            return Pg\modules\menu\helpers\getMenuItem($item_gid, $template);
        }
    }

    if (!function_exists('get_breadcrumbs')) {

        function get_breadcrumbs($template = '')
        {
            return Pg\modules\menu\helpers\getBreadcrumbs($template);
        }
    }

    if (!function_exists('linked_install_set_menu')) {

        function linked_install_set_menu($gid, $type = "create", $name = '', $check_permissions = 0)
        {
            return Pg\modules\menu\helpers\linkedInstallSetMenu($gid, $type, $name, $check_permissions);
        }
    }

    if (!function_exists('linked_install_set_menu_item')) {

        function linked_install_set_menu_item($gid, $menu_id, $type = "create", $parent_id = 0, $link = '/', $icon = '', $material_icon = '', $status
                                   = 1, $sorter = 1, $indicator_gid = '')
        {
            return Pg\modules\menu\helpers\linkedInstallSetMenuItem($gid,
                $menu_id,
                $type,
                $parent_id,
                $link,
                $icon,
                $material_icon,
                $status,
                $sorter,
                $indicator_gid);
        }
    }

    if (!function_exists('linked_install_set_menu_item_lang')) {
        // $lang_data is lang_id => value for update AND lang_id array for export
        function linked_install_set_menu_item_lang($item_id, $menu_id, $type = "update", $lang_data = [], $lang_tooltip_data
                                   = [], $lang_type = "value")
        {
            return Pg\modules\menu\helpers\linkedInstallSetMenuItemLang($item_id,
                $menu_id,
                $type,
                $lang_data,
                $lang_tooltip_data,
                $lang_type);
        }
    }

    if (!function_exists('linked_install_process_menu_items')) {
        // $process_type = 'create', 'update', 'export'
        // $lang_data is lang_id => value for update AND lang_id array for export
        function linked_install_process_menu_items(&$structure, $process_type, $menu_gid, $parent_id, &$items, $lang_prefix
                                   = "", $lang_data = [], $lang_tooltip_data = [])
        {
            return Pg\modules\menu\helpers\linkedInstallProcessMenuItems($structure,
                $process_type,
                $menu_gid,
                $parent_id,
                $items,
                $lang_prefix,
                $lang_data,
                $lang_tooltip_data);
        }
    }

    if (!function_exists('linked_install_delete_menu_items')) {

        function linked_install_delete_menu_items($menu_gid, $items)
        {
            return Pg\modules\menu\helpers\linkedInstallDeleteMenuItems($menu_gid, $items);
        }
    }

    if (!function_exists('buttonActionMenu')) {

        function buttonActionMenu($params)
        {
            return Pg\modules\menu\helpers\buttonActionMenu($params);
        }
    }

    if (!function_exists('mobileTopMenu')) {

        function mobileTopMenu()
        {
            return Pg\modules\menu\helpers\mobileTopMenu();
        }
    }
}
