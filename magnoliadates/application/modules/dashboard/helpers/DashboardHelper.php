<?php

declare(strict_types=1);

namespace Pg\modules\dashboard\helpers {

    if (!function_exists('dashboardWall')) {
        function dashboardWall()
        {
            $ci = &get_instance();
            $ci->load->model('Dashboard_model');

            $events_raw = $ci->Dashboard_model->getEventsList();
            $events = $ci->Dashboard_model->formatEvents($events_raw);

            $user_type = $ci->session->userdata("user_type");
            if ($user_type == 'moderator') {
                /**
                 * Filtrating events for the moderator
                 */
                $moderator_events = [];

                $ci->load->model('Moderators_model');
                $methods = $ci->Moderators_model->get_module_methods('payments');
                $permission_data = $ci->session->userdata("permission_data");

                $payments_approve = false;
                if (isset($permission_data['payments']['paymentsList']) && $permission_data['payments']['paymentsList'] == 1) {
                    $payments_approve = true;
                }

                $moderation_item_approve = false;
                if (isset($permission_data['moderation']['index']) && $permission_data['moderation']['index'] == 1) {
                    $moderation_item_approve = true;
                }

                $banners_approve = false;
                if (isset($permission_data['banners']['index']) && $permission_data['banners']['index'] == 1) {
                    $banners_approve = true;
                }

                if ($payments_approve || $moderation_item_approve) {
                    foreach ($events as $event) {
                        if (
                            ($payments_approve && $event['module'] == 'payments' && $event['type'] == 'payment') ||
                            ($moderation_item_approve && $event['module'] == 'moderation' && $event['type'] == 'moderation_item') ||
                            ($banners_approve && $event['module'] == 'banners' && $event['type'] == 'user_banner')
                        ) {
                            $moderator_events[] = $event;
                        }
                    }
                }
                $events = $moderator_events;
            }

            if (empty($events)) {
                return false;
            }

            $lang_id = $ci->pg_language->current_lang_id;
            $rejection_reason = $ci->pg_language->ds->get_reference('moderation', 'rejection_reason', $lang_id);

            foreach ($rejection_reason['option'] as $key => $option) {
                if (strpos($option, '[legal-terms]') !== false) {
                    $ci->load->helper('content');
                    $legal_terms = get_page_link('legal-terms');
                    $rejection_reason['option'][$key] = str_replace('[legal-terms]', $legal_terms, $option);
                }
            }

            $ci->view->assign('rejection_reason', $rejection_reason);

            $ci->view->assign('cookie_site_server', parse_url(SITE_SERVER, PHP_URL_HOST));
            $ci->view->assign('cookie_site_path', '/' . SITE_SUBFOLDER);
            $ci->view->assign('events', $events);

            return $ci->view->fetch('helper_wall', null, 'dashboard');
        }
    }

}

namespace {

    if (!function_exists('dashboard_wall')) {
        function dashboard_wall()
        {
            return Pg\modules\dashboard\helpers\dashboardWall();
        }
    }

}
