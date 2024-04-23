<?php

declare(strict_types=1);

namespace Pg\modules\likes\models;

/**
 * Likes install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Alexander Batukhtin <abatukhtin@pilotgroup.net>
 */
class LikesInstallModel extends \Model
{
    /**
     * Constructor
     *
     * @return Install object
     */
    protected $action_config = [
        'likes_add_like' => [
            'is_percent' => 0,
            'once' => 0,
            'available_period' => [
                'all'],
            ],
    ];

    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model('Install_model');
    }

    public function installBonusesLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model("bonuses/models/Bonuses_util_model");
        $langs_file = $this->ci->Install_model->language_file_read("bonuses", "ds", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty bonuses langs data");
            return false;
        }
        $this->ci->Bonuses_util_model->update_langs($langs_file);
        $this->ci->load->model("bonuses/models/Bonuses_actions_config_model");
        $this->ci->Bonuses_actions_config_model->setActionsConfig($this->action_config);
        return true;
    }

    public function installUsers()
    {
        $this->ci->load->model('users/models/Users_blocked_callbacks_model');
        $this->ci->Users_blocked_callbacks_model->addCallback([
            'module' => 'likes',
            'model' => 'Likes_model',
            'callback' => 'callbackUserBLocked',
            'callback_gid' => 'likes'
        ]);
    }

    public function deinstallUsers()
    {
        $this->ci->load->model('users/models/Users_blocked_callbacks_model');
        $this->ci->Users_blocked_callbacks_model->deleteCallbacksByModule('likes');
    }

    public function __call($name, $args)
    {
        $methods = [
            '_prepare_installing' => 'prepareInstalling',
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_lang_install' => 'arbitraryLangInstall',
            '_arbitrary_lang_export' => 'arbitraryLangExport',
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
