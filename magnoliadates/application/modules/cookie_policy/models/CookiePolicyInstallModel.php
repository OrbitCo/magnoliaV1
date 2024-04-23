<?php

declare(strict_types=1);

namespace Pg\modules\cookie_policy\models;

/**
 * Cookie policy module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Cookie policy install model
 *
 * @package     PG_Dating
 * @subpackage  Cookie policy
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class CookiePolicyInstallModel extends \Model
{
    /**
     * Content configuration
     *
     * @var array
     */
    protected $content = [
        'title'        => 'Privacy and security',
        'gid'          => 'privacy-and-security',
        'parent_id'    => '0',
        'status'       => '1',
    ];

    /**
     * Install data of content module
     *
     * @return void
     */
    public function installContent()
    {
        $this->ci->pg_module->set_module_config('cookie_policy', 'page_gid', $this->content['gid']);
    }

    /**
     * Uninstall data of content module
     *
     * @return void
     */
    public function deinstallContent()
    {
        $this->ci->pg_module->set_module_config('cookie_policy', 'page_gid', '');
    }
}
