<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

use Pg\Libraries\Setup;

/**
 * Users install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class UsersInstallModel extends \Model
{

    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    /**
     * Field editor list
     *
     * @var array
     */
    protected $field_editor;

    /**
     * Module data
     *
     * @var array
     */
    protected $modules_data = [];

    /**
     * Demo content Access_permissions object
     *
     * @var array
     */
    protected $demo_content = [];

    protected $pages = [
            "account",
            "account_delete",
            "settings",
            "login_form",
            "restore",
            "profile",
            "view",
            "registration",
            "confirm",
            "search",
            "my_visits",
            "my_guests",
        ];

    /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();

        $this->modules_data = Setup::getModuleData(UsersModel::MODULE_GID, Setup::TYPE_MODULES_DATA);
        $this->demo_content = Setup::getModuleData(UsersModel::MODULE_GID, Setup::TYPE_DEMO_CONTENT);
        $this->access_permissions = Setup::getModuleData(UsersModel::MODULE_GID, Setup::TYPE_ACCESS_PERMISSIONS);
        $this->field_editor = Setup::getModuleData(UsersModel::MODULE_GID, Setup::TYPE_FIELD_EDITOR);
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
            \Pg\modules\menu\helpers\linkedInstallProcessMenuItems(
                $this->modules_data['menu'],
                'create',
                $gid,
                0,
                $this->modules_data['menu'][$gid]["items"]
            );
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read(
            'users',
            'menu',
            $langs_ids
        );
        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }
        $this->ci->load->model('Menu_model');
        $this->ci->load->helper('menu');

        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            \Pg\modules\menu\helpers\linkedInstallProcessMenuItems(
                $this->modules_data['menu'],
                'update',
                $gid,
                0,
                $this->modules_data['menu'][$gid]["items"],
                $gid,
                $langs_file
            );
        }

        return true;
    }

    public function installMenuLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model('Menu_model');
        $this->ci->load->helper('menu');
        $return = [];
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            $temp   = \Pg\modules\menu\helpers\linkedInstallProcessMenuItems(
                $this->modules_data['menu'],
                'export',
                $gid,
                0,
                $this->modules_data['menu'][$gid]["items"],
                $gid,
                $langs_ids
            );
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    public function deinstallMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->modules_data['menu'] as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                \Pg\modules\menu\helpers\linkedInstallSetMenu($gid, 'delete');
            } else {
                \Pg\modules\menu\helpers\linkedInstallDeleteMenuItems(
                    $gid,
                    $this->modules_data['menu'][$gid]['items']
                );
            }
        }
    }

    public function installNetwork()
    {
        $this->ci->load->model('network/models/Network_events_model');
        foreach ($this->modules_data['network_event_handlers'] as $handler) {
            $this->ci->Network_events_model->addHandler($handler);
        }
    }

    public function deinstallNetwork()
    {
        $this->ci->load->model('network/models/Network_events_model');
        foreach ($this->modules_data['network_event_handlers'] as $handler) {
            $this->ci->Network_events_model->delete($handler['event']);
        }
    }

    public function installUploads()
    {
        // upload config
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data                 = [
            'gid' => 'user-logo',
            'name' => 'User icon',
            'max_height' => 8000,
            'max_width' => 8000,
            'max_size' => 20971520,
            'name_format' => 'generate',
            'file_formats' => ['jpg', 'jpeg', 'gif', 'png', 'webp'],
            'default_img' => 'default-user-logo.png',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $config_data['file_formats'] = serialize($config_data['file_formats']);
        $config_id = $this->ci->Uploads_config_model->save_config(
            null,
            $config_data
        );

        $wm_id = 0;

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'grand',
            'width' => 960,
            'height' => 720,
            'effect' => 'none',
            'watermark_id' => $wm_id,
            'crop_param' => 'resize',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->saveThumb(null, $thumb_data);

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'great',
            'width' => 305,
            'height' => 305,
            'effect' => 'none',
            'watermark_id' => $wm_id,
            'crop_param' => 'crop',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->saveThumb(null, $thumb_data);

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'big',
            'width' => 200,
            'height' => 200,
            'effect' => 'none',
            'watermark_id' => $wm_id,
            'crop_param' => 'crop',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->saveThumb(null, $thumb_data);

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'middle',
            'width' => 100,
            'height' => 100,
            'effect' => 'none',
            'watermark_id' => 0,
            'crop_param' => 'crop',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->saveThumb(null, $thumb_data);

        $thumb_data = [
            'config_id' => $config_id,
            'prefix' => 'small',
            'width' => 60,
            'height' => 60,
            'effect' => 'none',
            'watermark_id' => 0,
            'crop_param' => 'crop',
            'crop_color' => 'ffffff',
            'date_add' => date('Y-m-d H:i:s'),
        ];
        $this->ci->Uploads_config_model->saveThumb(null, $thumb_data);
    }

    public function installSiteMap()
    {
        // Site Map
        $this->ci->load->model('Site_map_model');
        $site_map_data = [
            'module_gid' => 'users',
            'model_name' => 'Users_model',
            'get_urls_method' => 'get_sitemap_urls',
        ];
        $this->ci->Site_map_model->setSitemapModule('users', $site_map_data);
    }

    public function installBanners()
    {
        // add banners module
        $this->ci->load->model(["banners/models/Banner_group_model", "banners/models/Banner_place_model"]);
        $this->ci->Banner_group_model->setModule("users", "Users_model", "bannerAvailablePages");
        $group_id = $this->ci->Banner_group_model->createUniqueGroup([
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'price'         => 1,
            'gid'           => 'users_groups',
            'name'          => 'Users pages'
        ]);
        $all_places = $this->ci->Banner_place_model->getAllPlaces();
        if ($all_places) {
            foreach ($all_places as $key => $value) {
                if ($value['keyword'] != 'bottom-banner' && $value['keyword'] != 'top-banner') {
                    continue;
                }
                $this->ci->Banner_place_model->savePlaceGroup($value['id'], $group_id);
            }
        }
        $this->addBanners($group_id);
    }

    public function addBanners($group_id)
    {
        $this->ci->load->model(['Users_model', 'banners/models/Banner_group_model', 'banners/models/Banner_place_model']);
        $pages = $this->ci->Users_model->bannerAvailablePages();
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

    public function installLinker()
    {
        // add linker entry
        $this->ci->load->model('linker/models/linker_type_model');
        $this->ci->linker_type_model->createType('users_contacts');
    }

    public function installModeration()
    {
        // Moderation
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->modules_data['moderation_types'] as $mtype) {
            $mtype['date_add'] = date("Y-m-d H:i:s");
            $this->ci->Moderation_type_model->saveType(null, $mtype);
        }
    }

    public function installModerationLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read(
            'users',
            'moderation',
            $langs_ids
        );
        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');
        $this->ci->Moderation_type_model->updateLangs(
            $this->modules_data['moderation_types'],
            $langs_file
        );
    }

    public function installModerationLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');

        return ['moderation' => $this->ci->Moderation_type_model->exportLangs(
            $this->modules_data['moderation_types'],
            $langs_ids
        )];
    }

    public function deinstallModeration()
    {
        // Moderation
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->modules_data['moderation_types'] as $mtype) {
            $type = $this->ci->Moderation_type_model->getTypeByName($mtype["name"]);
            $this->ci->Moderation_type_model->deleteType($type['id']);
        }
    }

    /**
     * Moderators module methods
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');

        foreach ($this->modules_data['moderators_methods'] as $method) {
            $this->ci->Moderators_model->saveMethod(null, $method);
        }
    }

    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('users', 'moderators', $langs_ids);
        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'users';
        $methods = $this->ci->Moderators_model->getMethodsLangExport($params);
        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->saveMethod(
                    $method['id'],
                    [],
                    $langs_file[$method['method']]
                );
            }
        }
    }

    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'users';
        $methods = $this->ci->Moderators_model->getMethodsLangExport($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }
        return ['moderators' => $return];
    }

    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('moderators/models/Moderators_model');
        $this->ci->Moderators_model->delete_methods(['where' => ['module' => 'users']]);
    }

    public function installNotifications()
    {
        // add notification
        $this->ci->load->model(['Notifications_model', 'notifications/models/Templates_model']);

        foreach ($this->modules_data['notifications']['templates'] as $tpl) {
            $template_data        = [
                'module' => UsersModel::MODULE_GID,
                'gid' => $tpl['gid'],
                'name' => $tpl['name'],
                'vars' => serialize($tpl['vars']),
                'content_type' => $tpl['content_type'],
                'date_add' => date('Y-m-d H:i:s'),
                'date_update' => date('Y-m-d H:i:s'),
            ];
            $tpl_ids[$tpl['gid']] = $this->ci->Templates_model->saveTemplate(
                null,
                $template_data
            );
        }

        foreach ($this->modules_data['notifications']['notifications'] as $notification) {
            $notification_data = [
                'module' => UsersModel::MODULE_GID,
                'gid' => $notification['gid'],
                'send_type' => $notification['send_type'],
                'id_template_default' => $tpl_ids[$notification['gid']],
                'date_add' => date("Y-m-d H:i:s"),
                'date_update' => date("Y-m-d H:i:s"),
            ];
            $this->ci->Notifications_model->saveNotification(
                null,
                $notification_data
            );
        }
    }

    public function installNotificationsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');

        $langs_file = $this->ci->Install_model->language_file_read(
            'users',
            'notifications',
            $langs_ids
        );

        if (!$langs_file) {
            log_message('info', 'Empty notifications langs data');

            return false;
        }

        $this->ci->Notifications_model->updateLangs(
            $this->modules_data['notifications'],
            $langs_file,
            $langs_ids
        );

        return true;
    }

    public function installNotificationsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Notifications_model');
        $langs = $this->ci->Notifications_model->exportLangs(
            $this->modules_data['notifications'],
            $langs_ids
        );

        return ['notifications' => $langs];
    }

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

    public function installSocialNetworking()
    {
        // add social netorking page
        $this->ci->load->model('social_networking/models/Social_networking_pages_model');

        $data = [
            'like' => [
                'facebook' => 'on',
                'vkontakte' => 'on',
                'google' => 'on',
            ],
            'share' => [
                'facebook' => 'on',
                'vkontakte' => 'on',
                'linkedin' => 'on',
                'twitter' => 'on',
            ],
            'comments' => '1',
        ];

        $page_data = [
            'controller' => 'users',
            'method' => 'registration',
            'name' => 'Registration page',
            'data' => serialize($data),
        ];
        $this->ci->Social_networking_pages_model->savePage(null, $page_data);
    }

    public function deinstallSocialNetworking()
    {
        $this->ci->load->model('social_networking/models/Social_networking_pages_model');
        $this->ci->Social_networking_pages_model->deletePagesByController('users');
    }

    public function arbitraryInstalling()
    {
        // SEO
        $seo_data = [
            'module_gid' => 'users',
            'model_name' => 'Users_model',
            'get_settings_method' => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls',
        ];
        $this->ci->pg_seo->set_seo_module('users', $seo_data);

        $this->ci->load->model('Users_model');
        $this->ci->Users_model->updateAge();
        $this->ci->Users_model->updateProfileCompletion();

        $this->ci->load->model('users/models/Users_delete_callbacks_model');
        $this->ci->Users_delete_callbacks_model->addCallback(
            'users',
            'Users_model',
            'callback_user_delete',
            '',
            'users_delete'
        );
        $this->ci->Users_delete_callbacks_model->addCallback(
            'users',
            'Users_model',
            'callback_user_delete',
            '',
            'users_uploads'
        );

        $this->addDemoContent();
        $this->adddLangCallback();
        $this->addUserTypes();
    }

     /**
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {
        $this->ci->load->model("users/models/Groups_model");
        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $this->ci->Groups_model->langDedicateModuleCallbackAdd($lang_id);
        }
    }

    private function adddLangCallback()
    {
        $lang_dm_data = [
            'module' => 'users',
            'model' => 'Users_model',
            'method_add' => 'lang_dedicate_module_callback_add',
            'method_delete' => 'lang_dedicate_module_callback_delete',
        ];
        $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
    }

    public function addDemoContent()
    {
        // Associating languages id with codes
        foreach ($this->ci->pg_language->languages as $l) {
            $lang[$l['code']] = $l['id'];
            if (!empty($l['is_default'])) {
                $default_lang = $l;
            }
        }

        // Users
        $this->ci->load->model('Users_model');
        $this->ci->load->model('Countries_model');
        $cities = $this->ci->Countries_model->getCities(1, 10);
        foreach ($this->demo_content['users'] as $user) {
            // Replace language code with ID
            if (isset($user['lang_code'])) {
                if (empty($lang[$user['lang_code']])) {
                    $user['lang_id'] = $default_lang['id'];
                } else {
                    $user['lang_id'] = $lang[$user['lang_code']];
                }
                unset($user['lang_code']);
            } else {
                $user['lang_id'] = $default_lang['id'];
            }

            if ($cities) {
                shuffle($cities);
                $rand_city = current($cities);
                $user['id_country'] = $rand_city['country_code'];
                $user['id_region'] = $rand_city['id_region'];
                $user['id_city'] = $rand_city['id'];
                $user['lat'] = $rand_city['latitude'];
                $user['lon'] = $rand_city['longitude'];
            }

            $user_id = $this->ci->Users_model->saveUser(null, $user);

            if (!empty($user_id)) {
                $this->ci->load->model('start/models/Start_desktop_notifications_model');
                $this->ci->Start_desktop_notifications_model->saveUserNotifications(
                    $user_id,
                    array_keys($this->ci->Start_desktop_notifications_model->notifications_gid)
                );
            }
        }

        if (empty($this->demo_content['groups'])) {
            return false;
        } else {
            if (!empty($this->demo_content['groups'])) {
                $this->ci->load->model('users/models/Groups_model');
                foreach ($this->demo_content['groups'] as $group) {
                    foreach ($lang as $key => $id) {
                        if (empty($group['name'][$key])) {
                            $group['name_' . $id] = $group['name']['en'];
                        } else {
                            $group['name_' . $id] = $group['name'][$key];
                        }
                        if (empty($group['description'][$key])) {
                            $group['description_' . $id] = $group['description']['en'];
                        } else {
                            $group['description_' . $id] = $group['description'][$key];
                        }
                    }

                    unset($group['name']);
                    unset($group['description']);
                    $this->ci->Groups_model->saveGroup(null, $group);
                }
            }
        }

        return true;
    }

    protected function addUserTypes()
    {
        $this->ci->load->model('users/models/Users_types_model');
        $this->ci->Users_types_model->addTypes($this->modules_data['user_types']);
    }

    public function arbitraryLangInstall($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read(
            'users',
            'arbitrary'
        );
        if (!$langs_file) {
            log_message('info', 'Empty arbitrary langs data');
            return false;
        }
        foreach ($this->pages as $page) {
            $post_data = [
                'title'          => isset($langs_file["seo_tags_{$page}_title"]) ? $langs_file["seo_tags_{$page}_title"] : null,
                'keyword'        => isset($langs_file["seo_tags_{$page}_keyword"]) ?  $langs_file["seo_tags_{$page}_keyword"] : null,
                'description'    => isset($langs_file["seo_tags_{$page}_description"]) ? $langs_file["seo_tags_{$page}_description"] : null,
                'header'         => isset($langs_file["seo_tags_{$page}_header"]) ? $langs_file["seo_tags_{$page}_header"] : null,
                'og_title'       => isset($langs_file["seo_tags_{$page}_og_title"]) ? $langs_file["seo_tags_{$page}_og_title"] : null,
                'og_type'        => isset($langs_file["seo_tags_{$page}_og_type"]) ? $langs_file["seo_tags_{$page}_og_type"] : null,
                'og_description' => isset($langs_file["seo_tags_{$page}_og_description"]) ? $langs_file["seo_tags_{$page}_og_description"] : null,
                "priority" => 0.8,
            ];
            $this->ci->pg_seo->set_settings("user", "users", $page, $post_data);
        }
    }

    public function arbitraryLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }

        foreach ($this->pages as $page) {
            $settings = $this->ci->pg_seo->get_settings("user", "users", $page, $langs_ids);
            $arbitrary_return["seo_tags_{$page}_title"] = !empty($settings["title"]) ? $settings["title"] : null;
            $arbitrary_return["seo_tags_{$page}_keyword"] = !empty($settings["keyword"]) ? $settings["keyword"] : null; 
            $arbitrary_return["seo_tags_{$page}_description"] = !empty($settings["description"]) ? $settings["description"] : null; 
            $arbitrary_return["seo_tags_{$page}_header"] = !empty($settings["header"]) ? $settings["header"] : null;  
            $arbitrary_return["seo_tags_{$page}_og_title"] = !empty($settings["og_title"]) ? $settings["og_title"] : null; 
            $arbitrary_return["seo_tags_{$page}_og_type"] = !empty($settings["og_type"]) ? $settings["og_type"] : null; 
            $arbitrary_return["seo_tags_{$page}_og_description"] = !empty($settings["og_description"]) ? $settings["og_description"] : null; 
        }


        return ['arbitrary' => $arbitrary_return];
    }

    public function deinstallUploads()
    {
        $this->ci->load->model('uploads/models/Uploads_config_model');
        $config_data = $this->ci->Uploads_config_model->getConfigByGid('user-logo');
        if (!empty($config_data['id'])) {
            $this->ci->Uploads_config_model->deleteConfig($config_data['id']);
        }
    }

    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->deleteSitemapModule('users');
    }

    public function deinstallBanners()
    {
        // delete banners module
        $this->ci->load->model("banners/models/Banner_group_model");
        $this->ci->Banner_group_model->deleteModule("users");
        $this->removeBanners();
    }

    public function removeBanners()
    {
        $this->ci->load->model('banners/models/Banner_group_model');
        $group_id = $this->ci->Banner_group_model->getGroupIdByGid('users_groups');
        $this->ci->Banner_group_model->delete($group_id);
    }

    public function deinstallLinker()
    {
        $this->ci->load->model('linker/models/linker_type_model');
        $this->ci->linker_type_model->deleteType('users_contacts');
    }

    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('users');
        $this->ci->load->model('users/models/Users_delete_callbacks_model');
        $this->ci->Users_delete_callbacks_model->deleteCallbacksByModule('users_delete');
    }

    // looks like not in use
    public function getMenuLangDelete($langs, $menu_gid, $item_gid)
    {
        $lang_data = [];
        foreach ($this->ci->pg_language->languages as $lang) {
            $lang_data[$lang["id"]] = $langs[$lang["code"]][$menu_gid][$item_gid];
        }

        return $lang_data;
    }

    public function installFieldEditor()
    {
        $this->ci->load->model(['Users_model', 'Field_editor_model']);
        $this->ci->Field_editor_model->initialize('users');

        if (TRIAL_MODE) {
            $forms = isset($this->field_editor['fe_trial_forms']) ? $this->field_editor['fe_trial_forms'] : '';
        } else {
            $forms = $this->field_editor['fe_forms'];
        }

        if (!empty($forms)) {
            $this->ci->Field_editor_model->importTypeStructure(
                'users',
                $this->field_editor['fe_sections'],
                $this->field_editor['fe_fields'],
                $forms
            );
        }

        $users_id = $this->ci->Users_model->getAllUsersId();
        foreach ($users_id as $uid) {
            $this->ci->Field_editor_model->updateFulltextField($uid);
        }
    }

    public function installFieldEditorLangUpdate()
    {
        $langs_file = $this->ci->Install_model->language_file_read('users', 'field_editor');

        if (!$langs_file) {
            log_message('info', 'Empty field_editor langs data');
            return false;
        }

        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize('users');
        $this->ci->Field_editor_model->updateSectionsLangs($this->field_editor['fe_sections'], $langs_file);
        $this->ci->Field_editor_model->updateFieldsLangs('users', $this->field_editor['fe_fields'], $langs_file);

        return true;
    }

    public function installFieldEditorLangExport($langs_ids = null)
    {
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize('users');
        list($fe_sections, $fe_fields) = $this->ci->Field_editor_model->export_type_structure(
            'users',
            'application/modules/users/install/user_fields_data.php'
        );
        $sections = $this->ci->Field_editor_model->exportSectionsLangs($fe_sections, $langs_ids);
        $fields   = $this->ci->Field_editor_model->exportFieldsLangs('users', $fe_fields, $langs_ids);
        return ['field_editor' => array_merge($sections, $fields)];
    }

    public function deinstallFieldEditor()
    {
        $this->ci->load->model(['Field_editor_model', 'field_editor/models/Field_editor_forms_model']);
        foreach ($this->field_editor['fe_fields'] as $field) {
            $this->ci->Field_editor_model->deleteFieldByGid($field['data']['gid']);
        }
        $this->ci->Field_editor_model->initialize('users');
        foreach ($this->field_editor['fe_sections'] as $section) {
            $this->ci->Field_editor_model->deleteSectionByGid($section['data']['gid']);
        }
        foreach ($this->field_editor['fe_forms'] as $form) {
            $this->ci->Field_editor_forms_model->deleteFormByGid($form['data']['gid']);
        }
    }

    public function installCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        foreach ($this->modules_data['cron_jobs'] as $cron) {
            $this->ci->Cronjob_model->saveCron(null, $cron);
        }
    }

    public function deinstallCronjob()
    {
        $this->ci->load->model('Cronjob_model');
        $cron_data = [];
        $cron_data["where"]["module"] = "users";
        $this->ci->Cronjob_model->deleteCronByParam($cron_data);
    }

    /**
     * Install data of services module
     *
     * @return void
     */
    public function installServices()
    {
        $this->ci->load->model("Services_model");

        foreach ($this->modules_data['services'] as $services) {
            $validate_data = $this->ci->Services_model->validateTemplate(null, $services['template']);
            if (!empty($validate_data['errors'])) {
                continue;
            }
            $id_tpl = $this->ci->Services_model->saveTemplate(
                null,
                $validate_data['data']
            );

            foreach ($services['services'] as $service) {
                $service['id_template'] = $id_tpl;

                if (PRODUCT_NAME == 'social' && $service['gid'] == 'user_activate_in_search') {
                    $service['status'] = 0;
                }

                $validate_data = $this->ci->Services_model->validateService(
                    null,
                    $service
                );
                if (!empty($validate_data['errors'])) {
                    continue;
                }
                $this->ci->Services_model->saveService(
                    null,
                    $validate_data['data']
                );
            }
        }

        $service_raw = $this->ci->Services_model->getServiceByGid('admin_approve');
        if ($this->ci->pg_module->get_module_config('users', 'user_approve') == 2) {
            $this->ci->Services_model->activateService($service_raw['id']);
        } else {
            $this->ci->Services_model->deactivateService($service_raw['id']);
        }
    }

    /**
     * Import data of services module depended on language
     *
     * @param array $langs_ids languages identifiers
     *
     * @return boolean
     */
    public function installServicesLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('users', 'services', $langs_ids);
        if (!$langs_file) {
            log_message('info', 'Empty services langs data');
            return false;
        }
        $this->ci->load->model('Services_model');
        $this->ci->Services_model->updateLangs(
            $this->modules_data['lang_services'],
            $langs_file
        );

        return true;
    }

    /**
     * Export data of services module depended on language
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installServicesLangExport($langs_ids = null)
    {
        $this->ci->load->model('Services_model');
        return ['services' => $this->ci->Services_model->exportLangs(
            $this->modules_data['lang_services'],
            $langs_ids
        )];
    }

    /**
     * Uninstall data of services module
     *
     * @return void
     */
    public function deinstallServices()
    {
        $this->ci->load->model("Services_model");

        foreach ($this->modules_data['services'] as $services) {
            $this->ci->Services_model->deleteTemplateByGid($services['template']['gid']);
            foreach ($services['services'] as $service) {
                $this->ci->Services_model->deleteServiceByGid($service['gid']);
            }
        }
    }

    /**
     * Install geomap links
     */
    public function installGeomap()
    {
        // add geomap settings
        $this->ci->load->model('geomap/models/Geomap_settings_model');
        foreach ($this->modules_data['geomap'] as $geomap) {
            $validate_data = $this->ci->Geomap_settings_model->validateSettings($geomap['map_settings']);
            if (!empty($validate_data['errors'])) {
                continue;
            }
            $this->ci->Geomap_settings_model->saveSettings(
                $geomap['settings']['map_gid'],
                $geomap['settings']['id_user'],
                $geomap['settings']['id_object'],
                $geomap['settings']['gid'],
                $validate_data['data']
            );
        }
    }

    /**
     * Install languages
     *
     * @param array $langs_ids
     */
    public function installGeomapLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }

        $langs_file = $this->ci->Install_model->language_file_read(
            'users',
            'geomap',
            $langs_ids
        );
        if (!$langs_file) {
            log_message('info', 'Empty geomap langs data');

            return false;
        }

        $this->ci->load->model('geomap/models/Geomap_settings_model');

        $gids = [];
        foreach ($this->modules_data['geomap'] as $geomap) {
            $gids[$geomap['settings']['gid']] = 'map_' . $geomap['settings']['gid'];
        }
        $this->ci->Geomap_settings_model->updateLang(
            $gids,
            $langs_file,
            $langs_ids
        );
    }

    /**
     * Import languages
     *
     * @param array $langs_ids
     */
    public function installGeomapLangExport($langs_ids = null)
    {
        $gids = [];
        foreach ($this->modules_data['geomap'] as $geomap) {
            $gids[$geomap['settings']['gid']] = 'map_' . $geomap['settings']['gid'];
        }
        $this->ci->load->model('geomap/models/Geomap_settings_model');
        return ['geomap' => $this->ci->Geomap_settings_model->exportLang($gids, $langs_ids)];
    }

    /**
     * Uninstall geomap links
     */
    public function deinstallGeomap()
    {
        $this->ci->load->model("geomap/models/Geomap_settings_model");
        foreach ($this->modules_data['geomap'] as $geomap) {
            $this->ci->Geomap_settings_model->deleteSettings(
                $geomap['settings']['map_gid'],
                $geomap['settings']['id_user'],
                $geomap['settings']['id_object'],
                $geomap['settings']['gid']
            );
        }
    }

    public function installComments()
    {
        $comment_type = [
            'gid' => 'user_avatar',
            'module' => 'users',
            'model' => 'Users_model',
            'method_count' => 'comments_count_callback',
            'method_object' => 'comments_object_callback',
            'settings' => ['disable_guest_access' => true],
        ];
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->addCommentsType($comment_type);
    }

    public function installCommentsLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read(
            'users',
            'comments',
            $langs_ids
        );

        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');
            return false;
        }
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->updateLangs(['user_avatar'], $langs_file);
    }

    public function installCommentsLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('comments/models/Comments_types_model');
        return ['comments' => $this->ci->Comments_types_model->exportLangs(
            ['user_avatar'],
            $langs_ids
        )];
    }

    public function deinstallComments()
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $this->ci->Comments_types_model->deleteCommentsType('user_avatar');
    }

    /**
     * Install users data to ratings module
     *
     * @return void
     */
    public function installRatings()
    {
        $this->ci->load->model("Users_model");

        // add ratings type
        $this->ci->load->model("ratings/models/Ratings_type_model");

        $this->ci->Users_model->installRatingsFields((array) $this->modules_data['ratings']["ratings_fields"]);

        foreach ((array) $this->modules_data['ratings']["ratings"] as $rating_data) {
            $validate_data = $this->ci->Ratings_type_model->validateType(null, $rating_data);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Ratings_type_model->saveType(
                null,
                $validate_data["data"]
            );
        }
    }

    /**
     * Import users languages to ratings module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return boolean
     */
    public function installRatingsLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }

        $langs_file = $this->ci->Install_model->language_file_read("users", "ratings", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty ratings langs data");
            return false;
        }

        $this->ci->load->model("Ratings_model");

        foreach ((array) $this->modules_data['ratings']["ratings"] as $rating_data) {
            $this->ci->Ratings_model->updateLangs(
                $rating_data,
                $langs_file,
                $langs_ids
            );
        }

        foreach ($langs_ids as $lang_id) {
            foreach ((array) $this->modules_data['ratings']["rate_types"] as $type_gid => $type_data) {
                $types_data = [];
                foreach ($type_data as $rate_type => $votes) {
                    $votes_data = [];
                    foreach ($votes as $vote) {
                        $votes_data[$vote] = isset($langs_file[$type_gid . '_' . $rate_type . "_votes_" . $vote][$lang_id])
                                ? $langs_file[$type_gid . '_' . $rate_type . "_votes_" . $vote][$lang_id]
                                : $vote;
                    }
                    $types_data[$rate_type] = [
                        "header" => $langs_file[$type_gid . '_' . $rate_type . "_header"][$lang_id],
                        "votes" => $votes_data,
                    ];
                }
                $this->ci->Ratings_model->addRateType($type_gid, $types_data, $lang_id);
            }
        }

        return true;
    }

    /**
     * Export users languages from ratings module
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function installRatingsLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }

        $this->ci->load->model("Ratings_model");

        $langs = [];
        foreach ((array) $this->modules_data['ratings']["ratings"] as $rating_data) {
            $langs = array_merge(
                $langs,
                $this->ci->Ratings_model->exportLangs(
                    $rating_data['gid'],
                    $langs_ids
                )
            );
        }

        return ["ratings" => $langs];
    }

    /**
     * Uninstall users data of ratings module
     *
     * @return void
     */
    public function deinstallRatings()
    {
        $this->ci->load->model(["Users_model", "ratings/models/Ratings_type_model"]);

        foreach ((array) $this->modules_data['ratings']["ratings"] as $rating_data) {
            $this->ci->Ratings_type_model->deleteType($rating_data["gid"]);
        }

        $this->ci->Users_model->deinstallRatingsFields(array_keys((array) $this->modules_data['ratings']["ratings_fields"]));
    }

    /**
     * Install spam links
     */
    public function installSpam()
    {
        // add spam type
        $this->ci->load->model("spam/models/Spam_type_model");

        foreach ((array) $this->modules_data['spam'] as $spam_data) {
            $validate_data = $this->ci->Spam_type_model->validateType(null, $spam_data);
            if (!empty($validate_data["errors"])) {
                continue;
            }
            $this->ci->Spam_type_model->saveType(null, $validate_data["data"]);
        }
    }

    /**
     * Import spam languages
     *
     * @param array $langs_ids
     */
    public function installSpamLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }

        $langs_file = $this->ci->Install_model->language_file_read("users", "spam", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty spam langs data");
            return false;
        }

        $this->ci->load->model("spam/models/Spam_type_model");

        $this->ci->Spam_type_model->updateLangs($this->modules_data['spam'], $langs_file, $langs_ids);

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
        $langs = $this->ci->Spam_type_model->exportLangs((array) $this->modules_data['spam'], $langs_ids);
        return ["spam" => $langs];
    }

    /**
     * Uninstall spam links
     */
    public function deinstallSpam()
    {
        //add spam type
        $this->ci->load->model("spam/models/Spam_type_model");

        foreach ((array) $this->modules_data['spam'] as $spam_data) {
            $this->ci->Spam_type_model->deleteType($spam_data["gid"]);
        }
    }

    public function installBonuses()
    {
    }

    public function installBonusesLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }

        $langs_file = $this->ci->Install_model->language_file_read("bonuses", "ds", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty bonuses langs data");
            return false;
        }

        $this->ci->load->model("bonuses/models/Bonuses_util_model");
        $this->ci->Bonuses_util_model->updateLangs($langs_file);

        $this->ci->load->model("bonuses/models/Bonuses_actions_config_model");
        $this->ci->Bonuses_actions_config_model->setActionsConfig($this->modules_data['action_config']);

        return true;
    }

    public function installBonuses_lang_export()
    {
    }

    public function uninstallBonuses()
    {
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function installAccessPermissions()
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
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function deinstallAccessPermissions()
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
     * Install mobile module
     *
     * @return false
     */
    protected function installMobile()
    {
        if (empty($this->modules_data['push_notifications'])) {
            return false;
        }

        $this->ci->load->model("mobile/models/MobilePushNotificationsModel");
        $this->ci->MobilePushNotificationsModel->callbackAddPushNotifications($this->modules_data['push_notifications']);
    }

    /**
     * Deinstall mobile module
     *
     * @return false
     */
    protected function deinstallMobile()
    {
        if (empty($this->modules_data['push_notifications'])) {
            return false;
        }

        $this->ci->load->model("mobile/models/MobilePushNotificationsModel");
        foreach ($this->modules_data['push_notifications'] as $notification) {
            $gids[] = $notification['gid'];
        }
        $this->ci->MobilePushNotificationsModel->callbackDeletePushNotifications($gids);
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
