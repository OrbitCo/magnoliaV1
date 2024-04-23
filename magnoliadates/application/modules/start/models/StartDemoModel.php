<?php

declare(strict_types=1);

namespace Pg\modules\start\models;

/**
 * Start module
 *
 * @copyright	Copyright (c) 2000-2017
 * @author	Pilot Group Ltd <https://www.pilotgroup.net/>
 */
class StartDemoModel extends \Model
{

    /**
     * Folder for demo content
     *
     * @var string
     */
    const DEMO_CONTENT_FOLDER = 'demo';

    /**
     * Marketplace url
     *
     * @var string
     */
    const MARKETPLACE_URL = 'https://marketplace.datingpro.com/';

    /**
     * Marketplace url
     *
     * @var string
     */
    const PRICING_URL = 'https://marketplace.datingpro.com/information/pricing/';
    
    /**
     * Upgrade info url
     *
     * @var string
     */
    const UPGRADE_URL = 'https://www.datingpro.com/academy/faq/what-is-your-upgrade-policy/';

    /**
     * Packages link
     *
     * @var string
     */
    const PACKAGES_LINK = 'https://marketplace.datingpro.com/information/pricing?utm_source=CRM+newsletter&utm_medium=email&utm_campaign=DP-demo-pack-2017';

    /**
     * Start package name
     *
     * @var string
     */
    const START_PACKAGE ='start';

    /**
     * Business package name
     *
     * @var string
     */
    const BUSINESS_PACKAGE ='business';

    /**
     * Premium package name
     *
     * @var string
     */
    const PREMIUM_PACKAGE ='premium';
    
    /**
     * Logo type (text/image)
     * 
     * @var string
     */
    const GENERATE_LOGO_TYPE = 'text';

    /**
     * Packag style classes
     *
     * @var array
     */
    public static $package_classes = [
        self::START_PACKAGE => 'warning',
        self::BUSINESS_PACKAGE => 'info',
        self::PREMIUM_PACKAGE => 'success'
    ];

    /**
     * List of packages
     * @var array
     */
    public static $packages_list = [
        self::START_PACKAGE => [
            self::START_PACKAGE,
            self::BUSINESS_PACKAGE,
            self::PREMIUM_PACKAGE
        ],
        self::BUSINESS_PACKAGE => [
            self::BUSINESS_PACKAGE,
            self::PREMIUM_PACKAGE
        ],
        self::PREMIUM_PACKAGE => [
            self::PREMIUM_PACKAGE
        ]
    ];
    
    private static $start_page = [
        'start/index/homepage',
        'users/search',
        'users/view/23/profile',
        'media/all',
        'admin/start',
        'users/view/23/wall',
        'users/view/23/gallery',
        'users/profile',
        'users/account',
        'access_permissions/index',
        'users/settings/',
        'ratings/topRated',
        'like_me',
        'store',
        'events',
        'companions'
    ];
    
    private $settings_step = [
        'edit_colourset' => 'editColourset',
        'design' => 'setDesign',
        'edit_design' => 'editDesign',
        'brand' => 'setBrand',
        'money' => 'setMoney',
        'edit_memberships' => 'editMemberships',
        'edit_services' => 'editServices',
        'skip_settings' => 'skipSettings'
    ];

    /**
     * Class constructor
     *
     * @return StartDemoModel
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public static function getStartPage($key)
    {
        return self::$start_page[$key] ?: 'start/index/homepage';
    }

    /**
     * Path to demo content
     *
     * @return string
     */
    private static function getDemoPath()
    {
        return MODULEPATH . 'start/install/' . PRODUCT_NAME . '/' . self::DEMO_CONTENT_FOLDER;
    }

    /**
     * Package name
     *
     * @param array $data
     *
     * @return string Package name
     */
    public static function getPackage(array $data)
    {
        $modules_packages = require self::getDemoPath() . '/modules_packages.php';
        if (isset($modules_packages[$data['auth_type']][$data['class']])) {
            return isset($modules_packages[$data['auth_type']][$data['class']][$data['method']]) ?
                        $modules_packages[$data['auth_type']][$data['class']][$data['method']] :
                $modules_packages[$data['auth_type']][$data['class']]['*'];
        } else {
            return false;
        }
    }

    /**
     * Return list of packages
     * 
     * @param string $package
     *
     * @return array
     */
    public static function getPackagesList($package)
    {
        if (isset(self::$packages_list[$package])) {
            return self::$packages_list[$package]; 
        } else {
            return false;
        }
    }

    /**
     *  Packages data
     *
     * @param array $data
     *
     * @return array
     */
    public static function getPackagesData(array $data)
    {
        $package_name = self::getPackage($data);
        return [
            'gids' => self::getPackagesList($package_name),
            'classes' => self::$package_classes,
            'show_more' => str_replace("%url%", self::PACKAGES_LINK, l("package_show_more", StartModel::MODULE_GID))
        ];
    }

    /**
     * Guide file path
     *
     * @param string $lang_code
     *
     * @return string
     */
    public static function getGuideFIlePath($lang_code)
    {
        $filepath = self::getDemoPath() . '/guide_' . $lang_code . '.php';
        if (!file_exists($filepath)) {
            $filepath = self::getDemoPath() . '/guide_en.php';
        }
        return $filepath;
    }

    /**
     * Marketplace data
     *
     * @param string $gid
     *
     * @return array
     */
    public static function getMarketplaceData($gid)
    {
        return [
            'url' => self::MARKETPLACE_URL,
            'page_gid' => $gid
        ];
    }

    /*
     * Package search
     *
     * @param array $data
     *
     * @return boolean
     */
    private static function isPackage($data)
    {
        return in_array(PACKAGE_NAME, $data['packages']);
    }

    /**
     * Upgrade package data
     *
     * @param array $data
     *
     * @return mixed
     */
    public static function getUpgradePackageData($data)
    {
        if (self::isPackage($data) === false) {
            return false;
        }
        return [
            'url' => self::UPGRADE_URL,
            'name' => l('upgrade_package_common', StartModel::MODULE_GID),
            'package' => PACKAGE_NAME
        ];
    }

    public function isPage($data, $auth)
    {
        if (!empty($data)) {
            $key = ($auth == 'user') ? 0 : 1;
            $module = explode('/', $data)[$key];
            if ($this->ci->pg_module->is_module_installed($module)) {
                return true;
            }
        }
        return false;
    }
    
    public function firstOpening($data = [])
    {
        if (is_null($data['step']) === false && !empty($this->settings_step[$data['step']])) {
            return $this->{$this->settings_step[$data['step']]}($data);
        }
    }
    
    protected function skipSettings()   
    {
        $this->pg_module->set_module_config(StartModel::MODULE_GID, 'is_fist_opening', 0);
        return true;
    }

    protected function editColourset($data = []) 
    {
        $result = [];
        if (empty($data['set_id']) || empty($data['theme_id'])) {
            $result['error'][] = l('error_system', 'start');
            return $result;
        } else {
            $data_login = $this->demoLogin();
            if ($data_login === true) {
                $result['data'] = site_url() . 'admin/themes/edit_set/'.$data['theme_id'].'/'.$data['set_id'];
                return $result;
            } else {
                return $data_login;
            }
        }
    }
    
    protected function setDesign($data = [])
    {
        $result = [];
        if (!empty($data['set_id'])) {
            $this->ci->load->model('Themes_model');
            $this->ci->Themes_model->activateSet($data['set_id']);
            $this->ci->Themes_model->regenerateColorset($data['set_id']);
            $result['success'][] = l('success_activate_set', 'themes');
        } else {
            $result['error'][] = l('error_system', 'start');
        }
        return $result;
    }
    
    protected function editDesign()
    {
        $data_login = $this->demoLogin();
        if ($data_login === true) {
            $this->view->setRedirect(site_url() . 'admin/themes/installed_themes');
        } else {
            return $data_login;
        }
    }
    
    protected function setBrand($data = [])
    {
        $result = [];
        if (isset($data['brand'])) {
            $this->ci->load->model(['Themes_model', 'uploads/models/Uploads_config_model']);
            
            $theme_data = $this->getThemeData();            
            if (self::GENERATE_LOGO_TYPE == 'image') {
                $logo = $this->text2Logo($data['brand'], $theme_data);
                if (empty($logo)) {
                    $result['error'][] = l('error_system', 'start');
                }
            } else {                
                $this->ci->Themes_model->saveLogoParams($theme_data['id'], [
                    'id_lang' => $this->ci->pg_language->current_lang_id,
                    'id_set' => $theme_data['cilorset']['id'],
                    'text_logo' => $data['brand']
                ], $theme_data['cilorset']['id'], $this->ci->pg_language->current_lang_id);
            }             
        }
        return $result;
    }
    
    protected function editMemberships()
    {
        $data_login = $this->demoLogin();
        if ($data_login === true) {
            $this->view->setRedirect(site_url() . 'admin/access_permissions/registered');
        } else {
            return $data_login;
        }
    }
    
    protected function editServices()
    {
        $data_login = $this->demoLogin();
        if ($data_login === true) {
            $this->view->setRedirect(site_url() . 'admin/services/index');
        } else {
            return $data_login;
        }
    }
    
    private function demoLogin()
    {
        if ($this->ci->session->userdata('auth_type') != 'admin') {
            $this->ci->load->model('Ausers_model');
            $user_data = $this->ci->Ausers_model->getUserByLoginPassword('admin', 'admin1');
            if (empty($user_data) || !$user_data["status"]) {
                return ['error' => [l('error_login_password_incorrect', 'ausers')]];
            } else {
                $user_data["permission_data"]["start"] = [
                    'index' => 1,
                    'menu'  => 1,
                    'error' => 1
                ];
                $this->session->set_userdata([
                    "auth_type"       => 'admin',
                    "user_id"         => $user_data["id"],
                    "name"            => $user_data["name"],
                    "nickname"        => $user_data["nickname"],
                    "email"           => $user_data["email"],
                    "user_type"       => $user_data["user_type"],
                    "permission_data" => $user_data["permission_data"]
                ]);
                return true;
            }
        } else {
            return true;
        }
    }
    
    private function getThemeData()
    {
        $theme_data = current($this->ci->Themes_model->getInstalledThemesList(['where' => [
            'theme_type' => 'user',
            'active' => 1
        ]]));
        $colorsets_data = $this->ci->Themes_model->getSetsList($theme_data['id']);
        foreach ($colorsets_data as $val) {
            if ($val['active'] == 1) {
                $theme_data['cilorset'] = $val;
            }
        }
        return $theme_data;
    }
    
    private function text2Logo($brand_name, $theme_data)
    {
            $width_logo = iconv_strlen($brand_name)*12.5+10;
            
            if (!file_exists($theme_data['path'] . 'logo/' . $theme_data['cilorset']['id'])) {
                mkdir($theme_data['path'] . 'logo/' . $theme_data['cilorset']['id']);
            }
            
            $lang_code = $this->ci->pg_language->languages[$this->ci->pg_language->current_lang_id]['code'];
            
            $wm_settings = $this->ci->Uploads_config_model->formatWatermark(
                $this->ci->Uploads_config_model->getWatermarkById(1)
            );
            
            $image = imagecreatetruecolor($width_logo, $theme_data['logo_height']);
            imagealphablending($image, false);
            $col=imagecolorallocatealpha($image,255,255,255,127);
            imagefilledrectangle($image,0,0,485, 500,$col);
            imagealphablending($image,true);
            imagesavealpha($image,true);
            imagepng($image, $theme_data['path'] . 'logo/' . $theme_data['cilorset']['id'] .  '/logo_' . $lang_code . '.png', 1);
            imagedestroy($image);
            
            $this->load->library('image_lib');
            $this->image_lib->initialize([
                'wm_type' => 'text',
                'wm_text' => $brand_name,
                'wm_font_path' => $this->ci->Uploads_config_model->fonts_folder . 'arial.ttf',
                'wm_font_color' => $wm_settings['font_color'],
                'wm_shadow_color' => $wm_settings['shadow_color'],
                'wm_shadow_distance' => $wm_settings['shadow_distance'],
                'wm_opacity' => $wm_settings["alpha"],
                'create_thumb' => false,
                'source_image' => $theme_data['path'] . 'logo/' . $theme_data['cilorset']['id'] . '/logo_' . $lang_code . '.png',
                'wm_hor_alignment' => 'C',
                'wm_vrt_alignment' => 'M'
            ]);
            $this->ci->image_lib->watermark();

            $this->ci->Themes_model->saveLogoParams($theme_data['id'], [
                'logo' => 'logo_' . $lang_code . '.png',
                'id_lang' => $this->ci->pg_language->current_lang_id,
                'id_set' => $theme_data['cilorset']['id'],
                'logo_width' => $width_logo,
                'logo_height' => $theme_data['logo_height'],
                'mini_logo_width' => $theme_data['mini_logo_height'],
                'mini_logo_height' => $theme_data['mini_logo_height']
            ], $theme_data['cilorset']['id'], $this->ci->pg_language->current_lang_id);
    }

}
