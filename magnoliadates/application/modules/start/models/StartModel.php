<?php

declare(strict_types=1);

namespace Pg\modules\start\models;

if (!defined('WYSIWYG_UPLOAD_PATH')) {
    define('WYSIWYG_UPLOAD_PATH', FRONTEND_PATH . 'wysiwyg/');
}

if (!defined('WYSIWYG_UPLOAD_URL')) {
    define('WYSIWYG_UPLOAD_URL', FRONTEND_URL . 'wysiwyg/');
}

/**
 * Start model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class StartModel extends \Model
{

     /**
     * Module GUID
     *
     * @var string
     */
    const MODULE_GID = 'start';

    public $wysiwyg_upload_config = array(
        'allowed_types' => 'gif|jpg|png|jpeg|bmp|tiff|flv|swf',
        'max_size'      => '10000',
        'max_width'     => '5000',
        'max_height'    => '5000',
        'encrypt_name'  => true,
        'max_filename'  => 12,
    );

    public static $template_page = [
        'social' => 'index_social',
        'dating' => 'index_pleasure'
    ];

    public function clearTrashFolder()
    {
        $result = false;
        if ($handle = opendir(SITE_PHYSICAL_PATH . TRASH_FOLDER)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    @unlink(SITE_PHYSICAL_PATH . TRASH_FOLDER . $file);
                }
            }
            closedir($handle);
            $result = true;
        }

        return $result;
    }

    // banners callback method
    public function bannerAvailablePages()
    {
        $return[] = array("link" => "start/index", "name" => l('header_start_page', 'start'));
        $return[] = array("link" => "start/homepage", "name" => l('header_homepage', 'start'));

        return $return;
    }

    public function backendPingRequest()
    {
        return ['status' => 'pong'];
    }

    public function doWysiwygUpload($module = '', $id = 0, $upload_config_gid = '', $field = 'upload')
    {
        $wysiwyg_upload_config = array();
        if ($upload_config_gid && $module) {
            $model = $module . '_model';
            if ($this->ci->load->model($model, $model, false, true, true)) {
                $wysiwyg_upload_config = !empty($this->ci->{$model}->{$upload_config_gid}) ? $this->ci->{$model}->{$upload_config_gid} : array();
            }
        }
        if (!$wysiwyg_upload_config) {
            $wysiwyg_upload_config = $this->wysiwyg_upload_config;
        }

        $result['error'] = false;
        $result['is_uploaded'] = false;
        $upload = array();

        $subdir = '';
        if ($module) {
            $subdir .= $module . '/';
            if ($id) {
                $subdir .= $id . '/';
            }
        }

        $path = WYSIWYG_UPLOAD_PATH . $subdir;
        $url = WYSIWYG_UPLOAD_URL . $subdir;
        if (!is_dir($path)) {
            @mkdir($path, 0777, true);
        }

        $wysiwyg_upload_config['upload_path'] = $path;
        $this->ci->load->library('upload', $wysiwyg_upload_config);
        if ($this->ci->upload->do_upload($field)) {
            $upload = $this->ci->upload->data();
        } else {
            if ($this->upload->file_temp) {
                $result['error'] = $this->ci->upload->display_errors();

                return $result;
            }
        }

        if ($upload) {
            $result['is_uploaded'] = true;
            $result['img_name'] = $upload['raw_name'];
            $result['img_ext'] = $upload['file_ext'];
            $result['img_full_name'] = $upload['file_name'];
            $result['upload_url'] = $url . $upload['file_name'];
        }

        return $result;
    }

    public function clearWysiwygUploadsDir($dir = '', $id = 0)
    {
        $subdir = '';
        if ($dir) {
            $subdir .= $dir . '/';
            if ($id) {
                $subdir .= $id . '/';
            }
        }
        $path = WYSIWYG_UPLOAD_PATH . $subdir;

        $result = false;
        if ($handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    @unlink($path . $file);
                }
            }
            closedir($handle);
            if ($path != WYSIWYG_UPLOAD_PATH) {
                @rmdir($path);
            }
            $result = true;
        }

        return $result;
    }

    /**
     * Queick modules
     *
     * @params array $theme
     *
     * @return array
     */
    public function quickModules($theme)
    {
        $ql_modules_available = [
            ['name' => 'users', 'options' => []],
            ['name' => 'spam', 'options' => []],
            ['name' => 'media', 'options' => []],
            ['name' => 'comments', 'options' => []],
            ['name' => 'banners', 'options' => []],
            ['name' => 'tickets', 'options' => []],
            ['name' => 'subscriptions', 'options' => []],
            ['name' => 'payments', 'options' => []],
            ['name' => 'news', 'options' => []],
            ['name' => 'languages', 'options' => []],
            ['name' => 'themes', 'options' => [
                'theme' => $theme['scheme_data']['id_theme'],
                'scheme' => $theme['scheme_data']['id']]],
        ];
        $ql_modules = [['name' => 'start', 'options' => []]];
        foreach ($ql_modules_available as $i => $ql_module) {
            if ($this->pg_module->is_module_active($ql_module['name'])) {
                $ql_modules[] = $ql_module;
            }
        }
        return $ql_modules;
    }

    /**
     * Template index name
     *
     * @return string
     */
    public function templateName()
    {
        $fixed_index_page = $this->ci->pg_module->get_module_config(self::MODULE_GID, 'fixed_index_page');
        if ($fixed_index_page) {
            header('X-PJAX-Version: index-fixed');
            $template_name = self::$template_page[PRODUCT_NAME];
            $colorset = $this->ci->pg_theme->return_active_settings();

            
            if(!empty($colorset)) {
                $file_name = 'index_' . $colorset["user"]['scheme'];
                $path = MODULEPATH . "start/views/" . $colorset['user']['theme'] . "/" . $file_name . '.' . $colorset['user']['template_engine'];

                if(file_exists($path)) {
                    $template_name = $file_name;
                }
            }

            return $template_name;
        } else {
            return 'index';
        }
    }
            
    public function __call($name, $args)
    {
        $methods = [
            '_banner_available_pages' => 'bannerAvailablePages',
            'backend_ping_request' => 'backendPingRequest',
            'clear_trash_folder' => 'clearTrashFolder',
            'clear_wysiwyg_uploads_dir' => 'clearWysiwygUploadsDir',
            'do_wysiwyg_upload' => 'doWysiwygUpload',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
