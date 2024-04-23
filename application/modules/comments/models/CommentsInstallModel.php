<?php

declare(strict_types=1);

namespace Pg\modules\comments\models;

/**
 * Comments install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:50:07 +0400 $
 */
class CommentsInstallModel extends \Model
{
    private $menu = [
        'admin_menu' => [
            'action' => 'none',
            'items'  => [
                'settings_items' => [
                    'action' => 'none',
                    'items'  => [
                        'system-items' => [
                            'action' => 'none',
                            'items'  => [
                                'comments_menu_item' => ['action' => 'create', 'link' => 'admin/comments', 'status' => 1, 'sorter' => 2],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    private $moderation_types = [
        [
            "name"                     => "comments",
            "mtype"                    => "0",
            "module"                   => "comments",
            "model"                    => "Comments_model",
            "check_badwords"           => "1",
            "method_get_list"          => "_moder_get_list",
            "method_set_status"        => "_moder_set_status",
            "method_delete_object"     => "_moder_delete_object",
            "allow_to_decline"         => "1",
            "template_list_row"        => "moder_block",
        ],
    ];

    private $spam = [
        [
            "gid"          => "comments_object",
            "form_type"    => "select_text",
            "send_mail"    => true,
            "status"       => true,
            "module"       => "comments",
            "model"        => "Comments_model",
            "callback"     => "spam_callback",
        ],
    ];

    /**
     * Check system requirements of module
     */
    public function validateRequirements()
    {
        $result = ["data" => [], "result" => true];

        //check for Mbstring
        $good            = function_exists("mb_substr");
        $result["data"][] = [
            "name"   => "Mbstring extension (required for feeds parsing) is installed",
            "value"  => $good ? "Yes" : "No",
            "result" => $good,
        ];
        $result["result"] = $result["result"] && $good;

        return $result;
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data["name"])) {
                $name = $menu_data["name"];
            }
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]["items"]);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('comments', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, 'update', $gid, 0, $this->menu[$gid]['items'], $gid, $langs_file);
        }

        return true;
    }

    public function installMenuLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->helper('menu');

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, 'export', $gid, 0, $this->menu[$gid]['items'], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    public function installModeration()
    {
        // Moderation
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->moderation_types as $mtype) {
            $mtype['date_add'] = date("Y-m-d H:i:s");
            $this->ci->Moderation_type_model->save_type(null, $mtype);
        }
    }

    public function installModerationLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('comments', 'moderation', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');
        $this->ci->Moderation_type_model->update_langs($this->moderation_types, $langs_file);
    }

    public function installModerationLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');

        return ['moderation' => $this->ci->Moderation_type_model->export_langs($this->moderation_types, $langs_ids)];
    }

    /**
     * Install spam links
     */
    public function installSpam()
    {
        // add spam type
        $this->ci->load->model("spam/models/Spam_type_model");

        foreach ((array) $this->spam as $spam_data) {
            $validate_data = $this->ci->Spam_type_model->validate_type(null, $spam_data);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Spam_type_model->save_type(null, $validate_data["data"]);
        }
    }

    /**
     * Import spam languages
     *
     * @param array $langs_ids
     */
    public function installSpamLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        $this->ci->load->model("spam/models/Spam_type_model");
        $langs_file = $this->ci->Install_model->language_file_read("comments", "spam", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty spam langs data");

            return false;
        }

        $this->ci->Spam_type_model->update_langs($this->spam, $langs_file, $langs_ids);

        return true;
    }

    /**
     * Export spam languages
     *
     * @param array $langs_ids
     */
    public function installSpamLangExport($langs_ids = null)
    {
        $this->ci->load->model("spam/models/Spam_type_model");
        $langs = $this->ci->Spam_type_model->export_langs($this->spam, $langs_ids);

        return ["spam" => $langs];
    }

    /**
     * Uninstall spam links
     */
    public function deinstallSpam()
    {
        //add spam type
        $this->ci->load->model("spam/models/Spam_type_model");
        foreach ($this->spam as $spam_data) {
            $this->ci->Spam_type_model->delete_type($spam_data["gid"]);
        }
    }

    public function deinstallMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->menu as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                linked_install_set_menu($gid, 'delete');
            } else {
                linked_install_delete_menu_items($gid, $this->menu[$gid]['items']);
            }
        }
    }

    public function deinstallModeration()
    {
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->moderation_types as $mtype) {
            $type = $this->ci->Moderation_type_model->get_type_by_name($mtype["name"]);
            $this->ci->Moderation_type_model->delete_type($type['id']);
        }
    }

    public function installUsers()
    {
        $this->ci->load->model(['users/models/Users_blocked_callbacks_model', 'users/models/Users_delete_callbacks_model']);
        $this->ci->Users_delete_callbacks_model->addCallback('comments', 'Comments_model', 'callback_user_delete', '', 'comments');
        $this->ci->Users_blocked_callbacks_model->addCallback([
            'module' => 'comments',
            'model' => 'Comments_model',
            'callback' => 'callbackUserBLocked',
            'callback_gid' => 'comments'
        ]);
    }

    public function deinstallUsers()
    {
        $this->ci->load->model(['users/models/Users_blocked_callbacks_model', 'users/models/Users_delete_callbacks_model']);
        $this->ci->Users_delete_callbacks_model->deleteCallbacksByModule('comments');
        $this->ci->Users_blocked_callbacks_model->deleteCallbacksByModule('comments');
    }

    public function arbitraryInstalling()
    {
    }

    public function arbitraryDeinstalling()
    {
    }

    public function __call($name, $args)
    {
        $methods = [
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_deinstalling' => 'arbitraryDeinstalling',
            '_validate_requirements' => 'validateRequirements',
        ];

        if (isset($methods[$name])) {
            $method = $methods[$name];
        } else {
            $search = ['_lang_update', '_lang_export'];
            $replace = ['LangUpdate', 'LangExport'];

            $method = str_replace($search, $replace, $name);
        }

        if (!method_exists($this, $method)) {
            return;
        }

        return call_user_func_array([$this, $method], $args);
    }
}
