<?php

declare(strict_types=1);

namespace Pg\modules\languages\helpers {

    if (!function_exists('langSelect')) {
        function langSelect($params)
        {
            $ci = &get_instance();

            $count_active = 0;
            foreach ($ci->pg_language->languages as $language) {
                if ($language["status"]) {
                    ++$count_active;
                }
            }

            $ci->view->assign("count_active", $count_active);
            $ci->view->assign("current_lang", $ci->pg_language->current_lang_id);
            $ci->view->assign("languages", $ci->pg_language->languages);

            $params['template'] = (isset($params['template']) && !empty($params['template'])) ?
                    $params['template'] : 'helper_lang_select';

            return $ci->view->fetch($params['template'], 'user', 'languages');
        }
    }

    if (!function_exists('langEditor')) {
        function langEditor()
        {
            if (INSTALL_DONE && $_ENV['ADD_LANG_MODE']) {
                $ci = &get_instance();
                $lang_editor = $ci->system_messages->get_data('lang-editor');
                $ci->view->assign('lang_editor', $lang_editor);

                return $ci->view->fetch('lang_editor', 'user', 'languages');
            } else {
                return "";
            }
        }
    }

    if (!function_exists('langRowSelect')) {
        function langRowSelect()
        {
            $ci = &get_instance();

            $count_active = 0;
            foreach ($ci->pg_language->languages as $language) {
                if ($language["status"]) {
                    ++$count_active;
                }
            }

            if ($count_active < 2) {
                return false;
            }

            $languages = [];
            foreach ($ci->pg_language->languages as $lang){
                if ((int)$lang['status'] == 1){
                    $languages[] = $lang;
                }
            }

            $ci->view->assign("count_active", $count_active);
            $ci->view->assign("current_lang", $ci->pg_language->current_lang_id);
            $ci->view->assign("languages", $languages);

            return $ci->view->fetch('helper_lang_row_select', 'user', 'languages');
        }
    }

}

namespace {

    if (!function_exists('lang_select')) {
        function lang_select($params = [])
        {
            return Pg\modules\languages\helpers\langSelect($params);
        }
    }

    if (!function_exists('lang_editor')) {
        function lang_editor()
        {
            return Pg\modules\languages\helpers\langEditor();
        }
    }

    if (!function_exists('lang_row_select')) {
        function lang_row_select()
        {
            return Pg\modules\languages\helpers\langRowSelect();
        }
    }

}
