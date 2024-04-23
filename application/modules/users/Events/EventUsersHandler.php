<?php

declare(strict_types=1);

namespace Pg\modules\users\Events;

use Pg\Libraries\EventDispatcher;
use Pg\Libraries\EventHandler;

class EventUsersHandler extends EventHandler
{
    /**
     * Init handler
     *
     * @return void
     */
    public function init()
    {
        $event_handler = EventDispatcher::getInstance();
        $ci = &get_instance();

        if ($ci->pg_module->is_module_installed('statistics')) {
            $ci->load->model("Statistics_model");
            $events = $ci->Statistics_model->getSystemEvents('users');

            if (isset($events['profile_view']) && $events['profile_view'] == '1') {
                $event_handler->addListener('profile_view', function ($params) {
                    $ci = &get_instance();
                    $ci->load->model("Statistics_model");
                    $file = $ci->Statistics_model->getStatisticsFile('users');
                    $log_path = TEMPPATH . 'logs/statistics/' . $file;
                    $stat_point_arr['gid'] = 'profile_view';
                    $stat_point_arr['params']['from'] = $params->getProfileViewFrom();
                    $stat_point_arr['params']['to'] = $params->getProfileViewTo();
                    $stat_point_arr['params']['date'] = date('Y-m-d H:i:s');

                    $stat_point = json_encode($stat_point_arr);
                    $ci->Statistics_model->checkFile($log_path);
                    $fp = fopen($log_path, "a");
                    fputs($fp, $stat_point . "\r\n");
                    fclose($fp);
                });
            }

            if (isset($events['user_search']) && $events['user_search'] == '1') {
                $event_handler->addListener('user_search', function ($params) {
                    $ci = &get_instance();
                    $ci->load->model("Statistics_model");
                    $file = $ci->Statistics_model->getStatisticsFile('users');
                    $log_path = TEMPPATH . 'logs/statistics/' . $file;
                    $stat_point_arr['gid'] = 'user_search';
                    $stat_point_arr['params']['from'] = $params->getSearchFrom();
                    $stat_point_arr['params']['date'] = date('Y-m-d H:i:s');

                    $stat_point = json_encode($stat_point_arr);
                    $ci->Statistics_model->checkFile($log_path);
                    $fp = fopen($log_path, "a");
                    fputs($fp, $stat_point . "\r\n");
                    fclose($fp);
                });
            }
            if (isset($events['user_register']) && $events['user_register'] == '1') {
                $event_handler->addListener('user_register', function ($params) {
                    $ci = &get_instance();
                    $ci->load->model("Statistics_model");
                    $file = $ci->Statistics_model->getStatisticsFile('users');
                    $log_path = TEMPPATH . 'logs/statistics/' . $file;
                    $stat_point_arr['gid'] = 'user_register';
                    $stat_point_arr['params']['date'] = date('Y-m-d H:i:s');

                    $stat_point = json_encode($stat_point_arr);
                    $ci->Statistics_model->checkFile($log_path);
                    $fp = fopen($log_path, "a");
                    fputs($fp, $stat_point . "\r\n");
                    fclose($fp);
                });
            }
            $visit_event = $ci->Statistics_model->getSystemEvents('visits');
            if (isset($visit_event['visits']) && $visit_event['visits'] == '1') {
                $event_handler->addListener('visits', function ($params) {
                    $ci = &get_instance();
                    $ci->load->model("Statistics_model");
                    $user_agent = $params->getSiteVisits();
                    if ($ci->Statistics_model->getSiteVisitsCookie('visits') != 1) {
                        if ($ci->Statistics_model->isLog($user_agent) === true) {
                            $ci->Statistics_model->setSiteVisitsCookie('visits');
                            $file = $ci->Statistics_model->getStatisticsFile('visits');
                            $log_path = TEMPPATH . 'logs/statistics/' . $file;
                            $stat_point = json_encode([
                                'gid' => 'visits',
                                'params' => [
                                    'user_agent' => $user_agent,
                                    'date' => date('Y-m-d')
                                ]
                            ]);
                            $ci->Statistics_model->checkFile($log_path);
                            $fp = fopen($log_path, "a");
                            fputs($fp, $stat_point . "\r\n");
                            fclose($fp);
                        }
                    }
                });
            }
        }

        if ($_ENV['DEMO_MODE']) {
            $event_handler->addListener('profile_view', function ($params) {
                $ci = &get_instance();
                $ci->load->library('Analytics');
                $event = $ci->analytics->getEvent('main', 'profile_visit', 'user');
                $ci->analytics->track($event);
            });

            $event_handler->addListener('user_register', function ($params) {
                $ci = &get_instance();
                $ci->load->library('Analytics');
                $event = $ci->analytics->getEvent('main', 'registration', 'user');
                $ci->analytics->track($event);
            });

            $event_handler->addListener('users_add_profile_logo', function ($params) {
                $ci = &get_instance();
                $ci->load->library('Analytics');
                $event = $ci->analytics->getEvent('main', 'profile_photo_upload', 'user');
                $ci->analytics->track($event);
            });
        }

        $event_handler->addListener('users_site_visit_bonus_action', function ($params) {
            $ci = &get_instance();
            $ci->load->model("Users_model");
            $data = $params->getData();
            $callback = $data['callback'];
            $ci->Users_model->{$callback}($data);
        });

        $event_handler->addListener('users_update_user_profile_bonus_action', function ($params) {
            $ci = &get_instance();
            $ci->load->model("Users_model");
            $data = $params->getData();
            $callback = $data['callback'];
            $ci->Users_model->{$callback}($data);
        });

        $event_handler->addListener('users_add_profile_logo_bonus_action', function ($params) {
            $ci = &get_instance();
            $ci->load->model("Users_model");
            $data = $params->getData();
            $callback = $data['callback'];
            $ci->Users_model->{$callback}($data);
        });

        $event_handler->addListener('users_add_location_bonus_action', function ($params) {
            $ci = &get_instance();
            $ci->load->model("Users_model");
            $data = $params->getData();
            $callback = $data['callback'];
            $ci->Users_model->{$callback}($data);
        });
        $event_handler->addListener('user_register', function ($params) {
            $ci = &get_instance();
            $ci->load->model('start/models/Start_desktop_notifications_model');
            $ci->Start_desktop_notifications_model->saveUserNotifications(
                $params->getSearchFrom(),
                array_keys($ci->Start_desktop_notifications_model->notifications_gid)
            );
            if ($ci->pg_module->is_module_installed('incomplete_signup')) {
                $ci->load->model('Incomplete_signup_model');
                $email = $params->getData()['email'];
                $ci->Incomplete_signup_model->deleteUnregisteredUserByEmail($email);
            }
        });
        $event_handler->addListener('update_search_result_ids', function ($params) {
            $ci = &get_instance();
            $data = $params->getUsersIdsData();
            $users_search = $ci->session->userdata('users_search');
            $users_search['search_result']['user_ids'] = $data['user_ids'];
            $ci->session->set_userdata('users_search', $users_search);
        });

        $event_handler->addListener('user_visit', function () {
            $ci = &get_instance();
            $ci->load->model("Users_model");
            if ($ci->session->userdata('auth_type') == 'user') {
                $user_id = $ci->session->userdata('user_id');
                $ci->Users_model->setVisit($user_id);
            }
        });
    }
}
