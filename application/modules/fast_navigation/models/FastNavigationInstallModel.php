<?php

declare(strict_types=1);

namespace Pg\modules\fast_navigation\models;

use Pg\modules\fast_navigation\models\FastNavigationModel;

/**
 * Fast_navigation module
 *
 * @copyright   Copyright (c) 2000-2016
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class FastNavigationInstallModel extends \Model
{
    /**
     * Cronjobs configuration
     */
    private $cronjobs = [
        [
            "name"     => "Update the list of words to search for admin",
            "module"   => FastNavigationModel::MODULE_GID,
            "model"    => "Fast_navigation_model",
            "method"   => "updateFastNavigationCron",
            "cron_tab" => "33 3 1 * *",
            "status"   => "1",
        ],
    ];

    /**
     * Install links to cronjobs
     *
     * @return void
     */
    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        foreach ((array) $this->cronjobs as $cron_data) {
           /* not use validate_cron if module not Install*/
           /* $validation_data = $this->ci->Cronjob_model->validate_cron(null, $cron_data);
            if (!empty($validation_data['errors'])) {
                continue;
            }
            $this->ci->Cronjob_model->save_cron(null, $validation_data['data']);
           */
            $this->ci->Cronjob_model->save_cron(null, $cron_data);
        }
    }

    /**
     * Uninstall links to cronjobs
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [
            'where' => ['module' => FastNavigationModel::MODULE_GID],
        ];
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
    }

     /**
     * Install module data
     *
     * @return void
     */
    public function arbitraryInstalling()
    {
        $this->ci->load->model('Fast_navigation_model');
        $this->ci->Fast_navigation_model->dataСollection();
    }

    public function __call($name, $args)
    {
        $methods = [
            '_arbitrary_installing' => 'arbitraryInstalling',
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
