<?php

declare(strict_types=1);

namespace Pg\modules\polls\helpers {

    if (!function_exists('showPollPlaceBlock')) {
        function showPollPlaceBlock($params)
        {
            $ci = &get_instance();

            if (empty($params['id_poll'])) {
                $params['id_poll'] = 0;
            }

            $poll_block = show_poll_place($params['id_poll'], $params['one_poll_place']);
            if (!$poll_block) {
                return false;
            }

            $ci->view->assign('poll_block', $poll_block);

            return $ci->view->fetch('poll_place_block', 'user', 'polls');
        }
    }

    if (!function_exists('showPollPlace')) {

        /**
         * @param type $params['id_poll']
         * @param type $params['one_poll_place']
         *
         * @return html
         */
        function showPollPlace($id_poll, $one_poll_place)
        {
            $ci           = &get_instance();
            $ci->load->model('Polls_model');
            $id_user      = $ci->session->userdata('user_id');
            $denied_polls = $ci->Polls_model->get_denied_polls($id_user);
            // Show precise poll
            if ($id_poll) {
                // Check polls existence
                if ($ci->Polls_model->is_exists($id_poll)) {
                    // If current user may pass the poll
                    if (!in_array($id_poll, $denied_polls)) {
                        return get_form($id_poll, $one_poll_place);
                    } else {
                        // Template will decide whether to show results or just a text message
                        if ($one_poll_place || $ci->Polls_model->show_results($id_poll)) {
                            return get_results($id_poll, $one_poll_place);
                        } // else show random poll
                    }
                } //else show random poll
            } elseif ($one_poll_place) {
                return false;
            }
            // If we reached here, show random poll
            // Get language and user type
            $language  = $ci->pg_language->current_lang_id;
            $user_type = $ci->session->userdata("user_type");

            // Pick a random poll...
            $id_poll_rnd = $ci->Polls_model->get_random_id(null, $language, $user_type, $denied_polls);
            if ($id_poll_rnd) {
                return get_form($id_poll_rnd, $one_poll_place);
            } else {
                // ...or results
                $id_poll_rnd = $ci->Polls_model->get_random_id(true);
                if ($id_poll_rnd) {
                    return get_results($id_poll_rnd, $one_poll_place);
                }
            }
        }
    }

    if (!function_exists('getForm')) {
        function getForm($id_poll, $one_poll_place)
        {
            if (is_null($id_poll)) {
                return false;
            }

            $ci = &get_instance();
            $ci->load->model('Polls_model');

            $poll     = $ci->Polls_model->get_poll_by_id($id_poll);
            $language = $ci->pg_language->current_lang_id;

            $user_type = $ci->session->userdata("user_type");
            $params    = [];
            if ($user_type) {
                $params['where_sql'][] = " ( poll_type = 0 or poll_type = '$user_type' or poll_type = 3 ) ";
            } else {
                $params['where_sql'][] = ' ( poll_type = 0 or poll_type = 4 ) ';
            }
            $id_user = $ci->session->userdata('user_id');
            if ($id_user) {
                $denied_polls = $ci->Polls_model->get_denied_polls($id_user);
                if ($denied_polls) {
                    $params['where_not_in']['id'] = array_unique($denied_polls);
                }
            }
            $polls_count = $ci->Polls_model->get_polls_count($params);

            $ci->view->assign('one_poll_place', $one_poll_place);
            $ci->view->assign('poll_data', $poll);
            $ci->view->assign('cur_lang', $language);
            $ci->view->assign('polls_count', $polls_count);

            return $ci->view->fetch('poll_form', 'user', 'polls');
        }
    }

    if (!function_exists('getResults')) {
        function getResults($id_poll, $one_poll_place = false)
        {
            if (is_null($id_poll)) {
                return false;
            }

            $ci = &get_instance();
            $ci->load->model('Polls_model');

            $poll     = $ci->Polls_model->get_poll_by_id($id_poll);
            $language = $ci->pg_language->current_lang_id;

            $max_answers = $ci->pg_module->get_module_config('polls', 'max_answers');
            if (!$max_answers) {
                $max_answers = 10;
            }
            $max_results = 0;

            // Results sorting
            for ($i = 1; $i <= $max_answers; ++$i) {
                if (isset($poll['results'][$i])) {
                    $max_results = $max_results + floor($poll['results'][$i]);
                }
            }

            if (1 == $poll['sorter']) {
                asort($poll['results']);
            } elseif (2 == $poll['sorter']) {
                arsort($poll['results']);
            }

            $user_type = $ci->session->userdata("user_type");
            $params    = [];
            if ($user_type) {
                $params['where_sql'][] = " ( poll_type = 0 or poll_type = '$user_type' or poll_type = 3 ) ";
            } else {
                $params['where_sql'][] = ' ( poll_type = 0 or poll_type = 4 ) ';
            }
            $id_user = $ci->session->userdata('user_id');
            if ($id_user) {
                $denied_polls = $ci->Polls_model->get_denied_polls($id_user);
                if ($denied_polls) {
                    $params['where_not_in']['id'] = array_unique($denied_polls);
                }
            }
            $polls_count = $ci->Polls_model->get_polls_count($params);

            $ci->view->assign('one_poll_place', $one_poll_place);
            $ci->view->assign('polls_count', $polls_count);
            $ci->view->assign('poll_data', $poll);
            $ci->view->assign('poll_lang', $poll['language']);
            $ci->view->assign('cur_lang', $language);
            $ci->view->assign('max_results', $max_results);
            $ci->view->assign('max_answers', $max_answers);

            return $ci->view->fetch('poll_results', 'user', 'polls');
        }
    }

    if (!function_exists('showPollResultsBlock')) {

        /**
         * Displays polls results (progressbars)
         *
         * @param type $id_poll
         *
         * @return boolean
         */
        function showPollResultsBlock($id_poll)
        {
            $ci = &get_instance();

            if (is_null($id_poll)) {
                return false;
            }
            $poll = $ci->Polls_model->get_poll_by_id($id_poll);

            $poll['show_results'] = true;

            $max_answers = $ci->pg_module->get_module_config('polls', 'max_answers');
            if (!$max_answers) {
                $max_answers = 10;
            }
            $max_results = 0;

            // Results sorting
            for ($i = 1; $i <= $max_answers; ++$i) {
                if (isset($poll['results'][$i])) {
                    $max_results = $max_results + floor($poll['results'][$i]);
                }
            }

            $ci->view->assign('poll_data', $poll);
            $ci->view->assign('max_results', $max_results);
            $ci->view->assign('max_answers', $max_answers);
            $poll_block = $ci->view->fetch('poll_results', null, 'polls');

            $ci->view->assign('poll_block', $poll_block);

            return $ci->view->fetch('poll_place_block', null, 'polls');
        }
    }

    if (!function_exists('adminHomePollsBlock')) {
        function adminHomePollsBlock()
        {
            $ci = &get_instance();

            $auth_type = $ci->session->userdata("auth_type");
            if ($auth_type != "admin") {
                return '';
            }

            $user_type = $ci->session->userdata("user_type");

            $show = true;

            if ($user_type == 'moderator') {
                $show    = false;
                $ci->load->model('Moderators_model');
                $methods = $ci->Moderators_model->get_module_methods('polls');
                if (is_array($methods) && !in_array('index', $methods)) {
                    $show = true;
                } else {
                    $permission_data = $ci->session->userdata("permission_data");
                    if (isset($permission_data['polls']['index']) && $permission_data['polls']['index'] == 1) {
                        $show = true;
                    }
                }
            }

            if (!$show) {
                return '';
            }

            $ci->load->model('Polls_model');

            $stat_polls["all"]     = $ci->Polls_model->get_polls_count([]);
            $params["where_sql"][] = "( ( use_expiration = 0 OR (use_expiration = 1 AND date_end >= '" . date('Y-m-d H:i:s') . "') )  AND date_start < '" . date('Y-m-d H:i:s') . "' )";
            $stat_polls["active"]  = $ci->Polls_model->get_polls_count($params);

            $ci->view->assign("stat_polls", $stat_polls);

            return $ci->view->fetch('helper_admin_home_block', null, 'polls');
        }
    }

}

namespace {

    if (!function_exists('show_poll_place_block')) {
        function show_poll_place_block($params)
        {
            return Pg\modules\polls\helpers\showPollPlaceBlock($params);
        }
    }

    if (!function_exists('show_poll_place')) {
        function show_poll_place($id_poll, $one_poll_place)
        {
            return Pg\modules\polls\helpers\showPollPlace($id_poll, $one_poll_place);
        }
    }

    if (!function_exists('get_form')) {
        function get_form($id_poll, $one_poll_place)
        {
            return Pg\modules\polls\helpers\getForm($id_poll, $one_poll_place);
        }
    }

    if (!function_exists('get_results')) {
        function get_results($id_poll, $one_poll_place = false)
        {
            return Pg\modules\polls\helpers\getResults($id_poll, $one_poll_place);
        }
    }

    if (!function_exists('show_poll_results_block')) {
        function show_poll_results_block($id_poll)
        {
            return Pg\modules\polls\helpers\showPollResultsBlock($id_poll);
        }
    }

    if (!function_exists('admin_home_polls_block')) {
        function admin_home_polls_block()
        {
            return Pg\modules\polls\helpers\adminHomePollsBlock();
        }
    }

}
