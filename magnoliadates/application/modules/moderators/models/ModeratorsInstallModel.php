<?php

declare(strict_types=1);

namespace Pg\modules\moderators\models;

/**
 * Moderators install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Nikita Savanaev <nsavanaev@pilotgroup.net>
 */
class ModeratorsInstallModel extends \Model
{
    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();

        //// load langs
        $this->ci->load->model('Install_model');
    }

    public function arbitraryInstalling()
    {
        if (PRODUCT_NAME == 'dating') {
            $this->ci->db->insert_batch(AUSERS_MODERATE_METHOD_GROUPS_TABLE, [
                ['gid' => 'mg_other', 'sort_order' => '7'],
                ['gid' => 'mg_interface', 'sort_order' => '1'],
                ['gid' => 'mg_content', 'sort_order' => '5'],
                ['gid' => 'mg_gift_store', 'sort_order' => '3'],
                ['gid' => 'mg_payments', 'sort_order' => '4'],
                ['gid' => 'mg_users', 'sort_order' => '2'],
                ['gid' => 'mg_modules', 'sort_order' => '6']
            ], true);
        }
    }
    
    public function arbitraryDeinstalling()
    {
        $this->ci->load->model('Moderators_model');
        $this->ci->Moderators_model->delete_user();
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
