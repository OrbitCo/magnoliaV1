<?php

declare(strict_types=1);

namespace Pg\modules\get_token\models;

/**
 * Get token install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <mchernov@pilotgroup.net>
 */
class GetTokenInstallModel extends \Model
{
    protected $action_config = [
        'get_token_mobile_auth' => [
            'is_percent' => 0,
            'once' => 1,
            'available_period' => [
                'once'],
            ],
    ];

    public function arbitraryInstalling()
    {
        if ((extension_loaded('xmlwriter'))) {
            $this->ci->pg_module->set_module_config('get_token', 'use_xml', true);
        }
    }

    public function arbitraryDeinstalling()
    {
    }

    public function installBonuses()
    {
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

    public function installBonusesLangExport()
    {
    }

    public function deinstallBonuses()
    {
    }

    public function __call($name, $args)
    {
        $methods = [
            '_prepare_installing' => 'prepareInstalling',
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_lang_install' => 'arbitraryLangInstall',
            '_arbitrary_lang_export' => 'arbitraryLangExport',
            '_arbitrary_deinstalling' => 'arbitraryDeinstalling',
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
