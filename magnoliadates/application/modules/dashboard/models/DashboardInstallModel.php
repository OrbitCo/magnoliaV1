<?php

declare(strict_types=1);

namespace Pg\modules\dashboard\models;

use Pg\Libraries\Setup;

class DashboardInstallModel extends \Model
{

     /**
     * Module data Dashboard object
     *
     * @var array
     */
    protected $modules_data;

    /**
     * Demo content Dashboard object
     *
     * @var array
     */
    protected $demo_content;

    /**
     * Constructor
     *
     * @return Listings_install_model
     */
    public function __construct()
    {
        parent::__construct();

        $this->modules_data = Setup::getModuleData(
            DashboardModel::MODULE_GID,
            Setup::TYPE_MODULES_DATA
        );
        $this->demo_content = Setup::getModuleData(
            DashboardModel::MODULE_GID,
            Setup::TYPE_DEMO_CONTENT
        );
    }

    /**
     * Install data of cronjobs module
     *
     * @return void
     */
    public function installCronjob()
    {
        // add lift up cronjob
        $this->ci->load->model('Cronjob_model');
        foreach ((array) $this->modules_data['cronjobs'] as $cron_data) {
            $validation_data = $this->ci->Cronjob_model->validate_cron(null, $cron_data);
            if (!empty($validation_data['errors'])) {
                continue;
            }
            $this->ci->Cronjob_model->save_cron(null, $validation_data['data']);
        }
    }

    /**
     * Uninstall data of cronjobs module
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [];
        $cron_data["where"]["module"] = "listings";
        $this->ci->Cronjob_model->delete_cron_by_param($cron_data);
    }

    public function arbitraryInstalling()
    {
        $this->installDemoContent();
    }

    public function arbitraryDeinstalling()
    {
    }

    /**
     * Install demo content
     *
     * @return boolean/void
     */
    protected function installDemoContent()
    {
        if (!empty($this->demo_content)) {
            $this->ci->load->model('Dashboard_model');
            foreach ($this->demo_content as $module => $data) {
                if ($this->ci->pg_module->is_module_installed($module)) {
                    $this->ci->Dashboard_model->installBatch($module, $data);
                }
            }
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            '_arbitrary_installing' => 'arbitraryInstalling',
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
