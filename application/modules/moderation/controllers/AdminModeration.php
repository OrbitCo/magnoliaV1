<?php

declare(strict_types=1);

namespace Pg\modules\moderation\controllers;

use Pg\modules\moderation\models\ModerationModel;
use Pg\Libraries\View;
use phpDocumentor\Reflection\Types\Void_;

/**
 * Moderation admin side controller
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
class AdminModeration extends \Controller
{
    /**
     * Constructor
     *
     * @return Admin_Moderation
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Menu_model', 'Moderation_model']);
        $this->Menu_model->set_menu_active_item('admin_menu', 'moderation_menu_item');
    }

    /**
     *
     */
    public function index($type_name = "all", $page = 1)
    {
        $moder_type_name = (!empty($type_name) && $type_name != 'all') ? $type_name : "";

        $count = $this->Moderation_model->getModerationListCount($moder_type_name);
        $items_on_page = $this->pg_module->get_module_config('start', 'admin_items_per_page');
        $this->load->helper('sort_order');
        $page = get_exists_page_number($page, $count, $items_on_page);

        $_SESSION["mobjects_list"]["type_name"] = $type_name;
        $_SESSION["mobjects_list"]["page"] = $page;

        if ($count > 0) {
            // get tags
            $list = $this->Moderation_model->getModerationList($moder_type_name, $page, $items_on_page);
            $this->view->assign('list', $list);
        }

        $this->load->helper("navigation");
        $page_data = get_admin_pages_data(site_url() . "admin/moderation/index/" . $type_name . "/", $count, $items_on_page, $page, 'briefPage');
        $this->view->assign('page_data', $page_data);

        $this->view->assign('type_name', $type_name);

        $moder_types = $this->Moderation_type_model->get_types();
        if (is_array($moder_types) && count($moder_types)) {
            foreach ($moder_types as $key => $mtype) {
                $moder_types[$key]["count"] = $this->Moderation_model->get_moderation_list_count($mtype["name"]);
            }
        }

        $lang_id = $this->pg_language->current_lang_id;
        $rejection_reason = $this->pg_language->ds->get_reference('moderation', 'rejection_reason', $lang_id);

        foreach ($rejection_reason['option'] as $key => $option) {
            if (strpos($option, '[legal-terms]') !== false) {
                $this->load->helper('content');
                $legal_terms = get_page_link('legal-terms');
                $rejection_reason['option'][$key] = str_replace('[legal-terms]', $legal_terms, $option);
            }
        }

        $this->view->assign('rejection_reason', $rejection_reason);

        $this->view->assign('moder_types', $moder_types);

        $this->view->setHeader(l('admin_header_moderation_managment', 'moderation'));
        $this->view->render('admin_moder_list');
    }

    /*
    * Удаляет объект по записи в таблице модераций
    *
    */
    public function deleteObject($id_entry, $reason)
    {
        if (intval($id_entry)) {
            $item_data = $this->Moderation_model->get_moderation_item($id_entry);
            $object_id = $item_data["id_object"];
            $type_data = $this->Moderation_model->get_moderation_type_by_id($item_data["id_type"]);

            if ($object_id && $type_data["model"] && $type_data["module"] && $type_data["method_delete_object"]) {
                if ($reason !== false) {
                    $this->sendNotification($item_data['id'], 'declined', $reason);
                }

                /// подключаем модель
                $model_name = ucfirst($type_data["model"]);
                $model_path = strtolower($type_data["module"] . "/models/") . $model_name;
                $this->load->model($model_path);

                /// удаляем объект
                $this->{$model_name}->{$type_data["method_delete_object"]}($object_id);

                //// удаляем запись в модерации (вдруг осталась после делейта объекта)
                $this->Moderation_model->delete_moderation_item_by_id($id_entry);
            }
        }
        redirect(site_url() . "admin/moderation/index/" . $_SESSION["mobjects_list"]["type_name"] . "/" . $_SESSION["mobjects_list"]["page"]);

        return;
    }

    /*
    * Помечает контент только для взрослых
    *
    */
    public function markAdultObject($id_entry, $reason = null)
    {
        if (intval($id_entry)) {
            $item_data = $this->Moderation_model->get_moderation_item($id_entry);
            $object_id = $item_data["id_object"];
            $type_data = $this->Moderation_model->get_moderation_type_by_id($item_data["id_type"]);

            if ($object_id && $type_data["model"] && $type_data["module"] && $type_data["method_mark_adult"]) {
                /// подключаем модель
                $model_name = ucfirst($type_data["model"]);
                $model_path = strtolower($type_data["module"] . "/models/") . $model_name;
                $this->load->model($model_path);

                /// удаляем объект
                $this->{$model_name}->{$type_data["method_mark_adult"]}($object_id);

                $this->load->model('menu/models/Indicators_model');
                $this->Indicators_model->delete('new_moderation_item', $object_id, true);
            }
        }
        $this->system_messages->addMessage(View::MSG_SUCCESS, l("file_adulted", "moderation"));
        $this->approve($id_entry);

        return;
    }

    /*
    * Удаляет запись в таблице модераций
    *
    */
    public function delete($id_entry)
    {
        if ((int)$id_entry == 0) {
            show_404();
        }
        if (intval($id_entry)) {
            $this->Moderation_model->delete_moderation_item_by_id($id_entry);
        }
        $this->system_messages->addMessage(View::MSG_SUCCESS,
            l('admin_status_deleted', ModerationModel::MODULE_GID));
        $this->view->setRedirect(site_url() . "admin/moderation/index/" .
            $_SESSION["mobjects_list"]["type_name"] . "/" . $_SESSION["mobjects_list"]["page"]);

        return;
    }

    public function approve($id_entry, $is_dashboard = false)
    {
        if ((int)$id_entry == 0) {
            show_404();
        }
        $this->Moderation_model->approve($id_entry);
        $this->system_messages->addMessage(View::MSG_SUCCESS, l("admin_status_approved", "moderation"));
        if ($is_dashboard) {
            exit;
        } else {
            $this->view->setRedirect(site_url('admin/moderation/index/' .
                $_SESSION["mobjects_list"]["type_name"] . '/' .
                $_SESSION["mobjects_list"]["page"]));
        }
    }

    public function massApprove()
    {
        $ids = $this->input->post('ids', true);
        foreach ($ids as $id) {
            $this->Moderation_model->approve($id);
        }
        $this->system_messages->addMessage(View::MSG_SUCCESS, l("admin_status_approved", "moderation"));
        $this->view->assign(['redirect' => site_url('admin/moderation/index/' .
            $_SESSION["mobjects_list"]["type_name"] . '/' .
            $_SESSION["mobjects_list"]["page"])]);
        $this->view->render();
    }

    /**
     * Decline item
     *
     * @param integer $id_entry
     * @param string $reason
     * @param false $is_dashboard
     *
     * @return void
     */
    public function decline($id_entry, $reason = '', $is_dashboard = false)
    {
        if ((int)$id_entry == 0) {
            show_404();
        }
        $this->Moderation_model->decline($id_entry, $reason);
        $this->system_messages->addMessage(View::MSG_SUCCESS,
            l('admin_status_declined', ModerationModel::MODULE_GID));

        if ($is_dashboard) {
            exit;
        } else {
            $this->view->setRedirect(site_url('admin/moderation/index/' .
                $_SESSION["mobjects_list"]["type_name"] . '/' .
                $_SESSION["mobjects_list"]["page"]));
        }
    }

    public function settings()
    {
        $moder_types = $this->Moderation_type_model->get_types();
        if (is_array($moder_types) && count($moder_types)) {
            foreach ($moder_types as $key => $mtype) {
                $moder_types[$key]["count"] = $this->Moderation_model->get_moderation_list_count($mtype["name"]);
            }
        }
        $this->view->assign('moder_types', $moder_types);
        $this->view->assign('form_save_link', site_url() . "admin/moderation/settings_save");

        $this->view->setHeader(l('admin_header_moderation_settings_managment', 'moderation'));
        $this->view->render('admin_moder_settings');
    }

    public function settingsSave()
    {
        $mtype = $this->input->post("mtype");
        $types_id = $this->input->post("type_id");
        $check_badwords = $this->input->post("check_badwords");
        if (is_array($mtype) && count($mtype) > 0) {
            foreach ($types_id as $type_id) {
                $type_id = intval($type_id);
                if ($type_id) {
                    $attrs["mtype"] = isset($mtype[$type_id]) ? strval(intval($mtype[$type_id])) : -1;
                    $attrs["check_badwords"] = isset($check_badwords[$type_id]) ? intval($check_badwords[$type_id]) : 0;
                    $this->Moderation_type_model->save_type($type_id, $attrs);
                }
            }
            $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_save_settings', 'moderation'));
        }
        redirect(site_url() . "admin/moderation/settings");
    }

    public function badwords($type = "")
    {
        if ($type == "add" && isset($_POST) && !empty($_POST)) {
            $word = $this->input->post("word", true);
            $errors = $this->Moderation_badwords_model->set_badword($word);
            if (count($errors)) {
                $this->system_messages->addMessage(View::MSG_ERROR, $errors);
            }
        }

        if ($type == "check_text" && isset($_POST) && !empty($_POST)) {
            $check_data["text"] = $this->input->post("text");
            $check_data["modified"] = $this->Moderation_badwords_model->search_in_text($check_data["text"]);
            $this->view->assign('check_data', $check_data);
        }
        $this->view->assign('type', $type);

        $badwords = $this->Moderation_badwords_model->get_badwords();
        $this->view->assign('badwords', $badwords);

        $this->view->setHeader(l('admin_header_moderation_badwords_managment', 'moderation'));
        $this->view->render('admin_moder_badwords');
    }

    public function deleteBadword($id)
    {
        $id = intval($id);
        if ($id) {
            $this->Moderation_badwords_model->delete_badword($id);
        }
        redirect(site_url() . "admin/moderation/badwords");
    }

    /**
     * Send notification
     *
     * @param integer $item_id
     * @param string $status
     * @param string $reason
     *
     * @return void
     */
    public function sendNotification($item_id, $status, $reason = '')
    {
        $obj = current($this->Moderation_model->getModerationObject([
            'where' => ['id' => $item_id]
        ]));
        $is_send = false;
        $user = [];
        $media_preview = '';
        if (isset($obj['upload_gid'])) {
            $user = $obj['owner_info'];
            if ($obj['upload_gid'] == 'gallery_video') {
                if (isset($obj['video_content']['file_url'])) {
                    $media_preview = '<video controls width="400" height="300"><source src="' . $obj['video_content']['file_url']  . '" type="video/mp4"></video>';
                } elseif (isset($obj['video_content']['embed']) && $obj['video_content']['embed']) {
                     $media_preview = $obj['video_content']['embed'];
                }
            } elseif ($obj['upload_gid'] == 'gallery_image') {
                if (isset($obj['media']['mediafile']['thumbs']['big'])) {
                    $media_preview = '<img src="'. $obj['media']['mediafile']['thumbs']['big'] .'">';
                }
            } elseif ($obj['upload_gid'] == 'gallery_audio') {
                if (isset($obj['fname'])) {
                    $media_preview = $obj['fname'];
                }
            }
        } else {
            $is_send = true;
            $user = $obj;
            $mediafile = $status == ModerationModel::STATUS_APPROVED ? $user['media']['user_logo']['thumbs']['big'] : $user['media']['user_logo_moderation']['thumbs']['big'];
            $media_preview = '<img src="'. $mediafile .'">';
        }

        if (!empty($user)) {
            $lang_id = !empty($user['lang_id']) ? $user['lang_id'] : $this->pg_language->current_lang_id;
            $options = $this->pg_language->ds->get_reference('moderation', 'rejection_reason', $lang_id);

            if (strpos($options['option'][$reason], '[legal-terms]') !== false) {
                $this->load->helper('content');
                $legal_terms = get_page_link('legal-terms');
                $options['option'][$reason] = str_replace('[legal-terms]', $legal_terms, $options['option'][$reason]);
            }

            $avatar_content = '';
            if (isset($user['account'])) {
                $avatar_content =  " \n\n " . l('text_notification_declined', 'users', $lang_id);
            }

            $notification_data = [
                'fname' => $user['fname'] ?? $user['output_name'],
                'sname' => $user['sname'] ?? '',
                'status' => l('file_' . $status, 'moderation', $lang_id) . ". " . $avatar_content . "\n\n" . $options['option'][$reason] . "\n",
                'preview' => $media_preview,
                'is_send' => $is_send
            ];

            $this->load->model('Notifications_model');
            $this->Notifications_model->sendNotification($user['email'], 'moderation_status', $notification_data, '', $lang_id);
        }
    }
}
