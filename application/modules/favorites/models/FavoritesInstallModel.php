<?php

declare(strict_types=1);

namespace Pg\modules\favorites\models;

use Pg\Libraries\Setup;

/**
 * Favorites install model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class FavoritesInstallModel extends \Model
{
    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Demo content object
     *
     * @var array
     */
    protected $demo_content;

    /**
    * Module data Favorites object
    *
    * @var array
    */
    protected $modules_data;

    /**
      * Constructor
      *
      * @return Install object
      */
    public function __construct()
    {
        parent::__construct();
        $this->modules_data = Setup::getModuleData(
            FavoritesModel::MODULE_GID,
            Setup::TYPE_MODULES_DATA
        );
        $this->access_permissions = Setup::getModuleData(
            FavoritesModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
        $this->demo_content = Setup::getModuleData(
            FavoritesModel::MODULE_GID,
            Setup::TYPE_DEMO_CONTENT
        );
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $this->modules_data['menu'][$gid]['id'] = \Pg\modules\menu\helpers\linkedInstallSetMenu(
                $gid,
                $menu_data["action"],
                isset($menu_data["name"]) ? $menu_data["name"] : ''
            );
            linked_install_process_menu_items($this->modules_data['menu'], 'create', $gid, 0, $this->modules_data['menu'][$gid]["items"]);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read(FavoritesModel::MODULE_GID, 'menu', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            linked_install_process_menu_items($this->modules_data['menu'], 'update', $gid, 0, $this->modules_data['menu'][$gid]['items'], $gid, $langs_file);
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
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->modules_data['menu'], 'export', $gid, 0, $this->modules_data['menu'][$gid]['items'], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    public function deinstallMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                linked_install_set_menu($gid, 'delete');
            } else {
                linked_install_delete_menu_items($gid, $this->modules_data['menu'][$gid]['items']);
            }
        }
    }

    public function installSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->setSitemapModule(FavoritesModel::MODULE_GID, [
            'module_gid' => FavoritesModel::MODULE_GID,
            'model_name' => 'Favorites_model',
            'get_urls_method' => 'get_sitemap_urls',
        ]);
    }

    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->deleteSitemapModule(FavoritesModel::MODULE_GID);
    }

    public function installBanners()
    {
        $this->ci->load->model(['Favorites_model', 'banners/models/Banner_group_model']);
        $this->ci->Banner_group_model->setModule(FavoritesModel::MODULE_GID, "Favorites_model", "bannerAvailablePages");
        $group_id = $this->ci->Banner_group_model->getGroupIdByGid('users_groups');
        $pages = $this->ci->Favorites_model->bannerAvailablePages();
        if ($pages) {
            foreach ($pages as $key => $value) {
                $this->ci->Banner_group_model->addPage([
                    'group_id' => $group_id,
                    'name' => $value['name'],
                    'link' => $value['link'],
                ]);
            }
        }
    }

    public function deinstallBanners()
    {
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->deleteModule(FavoritesModel::MODULE_GID);
        $group_id = $this->ci->Banner_group_model->getGroupIdByGid('users_groups');
        $this->ci->Banner_group_model->delete($group_id);
    }

    public function arbitraryInstalling()
    {
        $this->ci->pg_seo->set_seo_module(FavoritesModel::MODULE_GID, [
            'module_gid' => FavoritesModel::MODULE_GID,
            'model_name' => 'Favorites_model',
            'get_settings_method' => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ]);
    }

    /**
     * Import module languages
     *
     * @param array $langs_ids array languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read(FavoritesModel::MODULE_GID, 'arbitrary', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty favorites arbitrary langs data');

            return false;
        }
        foreach ($this->modules_data['seo_pages'] as $page) {
            $this->ci->pg_seo->set_settings('user', FavoritesModel::MODULE_GID, $page, [
                'title'          => isset($langs_file["seo_tags_{$page}_title"]) ? $langs_file["seo_tags_{$page}_title"] : null,
                'keyword'        => isset($langs_file["seo_tags_{$page}_keyword"]) ? $langs_file["seo_tags_{$page}_keyword"] : null,
                'description'    => isset($langs_file["seo_tags_{$page}_description"]) ? $langs_file["seo_tags_{$page}_description"] : null,
                'header'         => isset($langs_file["seo_tags_{$page}_header"]) ? $langs_file["seo_tags_{$page}_header"] : null,
                'og_title'       => isset($langs_file["seo_tags_{$page}_og_title"]) ? $langs_file["seo_tags_{$page}_og_title"] : null,
                'og_type'        => isset($langs_file["seo_tags_{$page}_og_type"]) ? $langs_file["seo_tags_{$page}_og_type"] : null,
                'og_description' => isset($langs_file["seo_tags_{$page}_og_description"]) ? $langs_file["seo_tags_{$page}_og_description"] : null,
            ]);
        }
    }

    /**
     * Export module languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function arbitraryLangExport($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user', FavoritesModel::MODULE_GID);
        $lang_ids = array_keys($this->ci->pg_language->languages);
        $arbitrary_return = [];
        foreach ($seo_settings as $seo_page) {
            $prefix = 'seo_tags_' . $seo_page['method'];
            foreach ($lang_ids as $lang_id) {
                $meta = 'meta_' . $lang_id;
                $og = 'og_' . $lang_id;
                $arbitrary_return[$prefix . '_title'][$lang_id] = $seo_page[$meta]['title'];
                $arbitrary_return[$prefix . '_keyword'][$lang_id] = $seo_page[$meta]['keyword'];
                $arbitrary_return[$prefix . '_description'][$lang_id] = $seo_page[$meta]['description'];
                $arbitrary_return[$prefix . '_header'][$lang_id] = $seo_page[$meta]['header'];
                $arbitrary_return[$prefix . '_og_title'][$lang_id] = $seo_page[$og]['og_title'];
                $arbitrary_return[$prefix . '_og_type'][$lang_id] = $seo_page[$og]['og_type'];
                $arbitrary_return[$prefix . '_og_description'][$lang_id] = $seo_page[$og]['og_description'];
            }
        }

        return ['arbitrary' => $arbitrary_return];
    }

    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module(FavoritesModel::MODULE_GID);
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    public function installAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
        foreach ($this->access_permissions as $value) {
            if (isset($value['data'])) {
                $value['data'] = serialize($value['data']);
            }
            $this->ci->Access_permissions_modules_model->saveModules($value);
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_install_model');
        $this->ci->Access_permissions_install_model->addDemoAcl($this->demo_content['acl']);
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    public function deinstallAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        }
        $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
        foreach ($this->access_permissions as $value) {
            $this->ci->Access_permissions_modules_model->deleteModule($value['module_gid']);
        }
    }

    /**
     * Install notifications module
     *
     * @return void
     */
    public function installNotifications()
    {
        $this->ci->load->model(['Notifications_model', 'notifications/models/Templates_model']);
        foreach ($this->modules_data['notifications']['templates'] as $tpl) {
            $template_data = [
                'module' => FavoritesModel::MODULE_GID,
                'gid' => $tpl['gid'],
                'name' => $tpl['name'],
                'vars' => serialize($tpl['vars']),
                'content_type' => $tpl['content_type'],
                'date_add' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s'),
            ];
            $tpl_ids[$tpl['gid']] = $this->ci->Templates_model->saveTemplate(null, $template_data);
        }
        foreach ($this->modules_data['notifications']['notifications'] as $notification) {
            $notification_data = [
                'module' => FavoritesModel::MODULE_GID,
                'gid' => $notification['gid'],
                'send_type' => $notification['send_type'],
                'id_template_default' => $tpl_ids[$notification['gid']],
                'date_add' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s'),
            ];
            $this->ci->Notifications_model->saveNotification(null, $notification_data);
        }
    }

    /**
     * Install notifications lang update
     *
     * @param array $langs_ids
     *
     * @return boolean
     */
    public function installNotificationsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');
        $langs_file = $this->ci->Install_model->language_file_read(FavoritesModel::MODULE_GID, 'notifications', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty notifications langs data');

            return false;
        }
        $this->ci->Notifications_model->updateLangs($this->modules_data['notifications'], $langs_file, $langs_ids);

        return true;
    }

    /**
     * Install notifications lang export
     *
     * @param array $langs_ids
     *
     * @return array
     */
    public function installNotificationsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');
        $langs = $this->ci->Notifications_model->exportLangs($this->modules_data['notifications'], $langs_ids);

        return ['notifications' => $langs];
    }

    /**
     * Deinstall notifications
     *
     * @return void
     */
    public function deinstallNotifications()
    {
        $this->ci->load->model(['Notifications_model', 'notifications/models/Templates_model']);
        foreach ($this->modules_data['notifications']['templates'] as $tpl) {
            $this->ci->Templates_model->deleteTemplateByGid($tpl['gid']);
        }
        foreach ($this->modules_data['notifications']['notifications'] as $notification) {
            $this->ci->Notifications_model->deleteNotificationByGid($notification['gid']);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
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
