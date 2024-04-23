<?php

declare(strict_types=1);

namespace Pg\modules\user_information\models;

use Pg\Libraries\Setup;

/**
 * user_information module
 *
 * @copyright   Copyright (c) 2000-2019
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class UserInformationInstallModel extends \Model
{

    /**
     * Module data user_information object
     *
     * @var array
     */
    protected $modules_data;

    /**
     * Access Control List
     *
     * @var array
     */
    protected $acl_data;
    
    /**
     * Class constructor
     *
     * @return UserInformationInstallModel
     */
    public function __construct()
    {
        parent::__construct();
        $this->modules_data = Setup::getModuleData(
                UserInformationModel::MODULE_GID,
            Setup::TYPE_MODULES_DATA
        );
    }
    
    /**
     * Install cronjob data
     *
     * @return void
     */
    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        foreach ($this->modules_data['cron_data'] as $cronjob) {
            $this->ci->Cronjob_model->saveCron(null, $cronjob);
        }
    }

    /**
     * Uninstall cronjob data
     *
     * @return void
     */
    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $this->ci->Cronjob_model->deleteCronByParam([
            'where' => ['module' => UserInformationModel::MODULE_GID]
        ]);
    }
}
