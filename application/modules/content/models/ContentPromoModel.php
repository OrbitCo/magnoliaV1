<?php

declare(strict_types=1);

namespace Pg\modules\content\models;

/**
 * Content module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

if (!defined('CONTENT_PROMO_TABLE')) {
    define('CONTENT_PROMO_TABLE', DB_PREFIX . 'content_promo');
}

/**
 * Content promo data model
 *
 * @package     PG_Dating
 * @subpackage  Content
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class ContentPromoModel extends \Model
{
    /**
     * Properties of promo object in data source
     *
     * @var array
     */
    public $fields = [
        "id",
        "id_lang",
        "content_type",
        "promo_text",
        "promo_image",
        "promo_flash",
        "block_width",
        "block_width_unit",
        "block_height",
        "block_height_unit",
        "block_align_hor",
        "block_align_ver",
        "block_image_repeat",
        "promo_video",
        "promo_video_image",
        "promo_video_data",
    ];

    /**
     * Upload photo (GUID)
     *
     * @var string
     */
    public $upload_gid = "promo-content-img";

    /**
     * Upload promo photo (GUID)
     *
     * @var string
     */
    public $file_upload_gid = "promo-content-flash";

    /**
     * Upload promo video (GUID)
     *
     * @var string
     */
    public $video_gid = 'promo-video';

    /**
     * Settings for formatting promo object
     *
     * @var array
     */
    protected $format_settings = [
        'use_format' => true,
        'get_output' => false,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(CONTENT_PROMO_TABLE);
    }

    /**
     * Return promo object by language
     *
     * @param integer $id_lang language identifier
     *
     * @return array
     */
    public function getPromo($id_lang)
    {
        $data = [];
        $nameTable  = CONTENT_PROMO_TABLE;
        $fields     = implode(", ", $this->fields);
        $nameCache  = 'getPromo' . implode("_", $this->fields);
        $result =  $this->ci->cache->get(CONTENT_PROMO_TABLE, $nameCache, function () use ($id_lang, $fields, $nameTable) {
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("id_lang", $id_lang)
                ->get()
                ->result_array();
            return $result;
        });

        if (!empty($result)) {
            $data = $this->format_promo($result[0]);
        }

        return $data;
    }

    /**
     * Format promo object data
     *
     * @param array $data promo data
     *
     * @return array
     */
    public function formatPromo($data)
    {
        $data["postfix"] = $data["id_lang"];

        if (!empty($data["promo_image"])) {
            $this->ci->load->model('Uploads_model');
            $data["media"]["promo_image"] = $this->ci->Uploads_model->format_upload($this->upload_gid, $data["postfix"], $data["promo_image"]);
        }

        if (!empty($data["promo_flash"])) {
            $this->ci->load->model('File_uploads_model');
            $data["media"]["promo_flash"] = $this->ci->File_uploads_model->format_upload($this->file_upload_gid, $data["postfix"], $data["promo_flash"]);
        }

        if ($data["block_width_unit"] != "auto") {
            $styles["width"] = $data["block_width"] . $data["block_width_unit"];
        }

        if ($data["block_height_unit"] != "auto") {
            $styles["height"] = $data["block_height"] . $data["block_height_unit"];
        }

        if (!empty($data["promo_image"]) && $data["content_type"] == 't') {
            $styles["background-image"] = "url('" . $data["media"]["promo_image"]["file_url"] . "')";
            $styles["background-position"] = $data["block_align_hor"] . " " . $data["block_align_ver"];
            $styles["background-repeat"] = $data["block_image_repeat"];
        }
        if (!empty($styles)) {
            $data["styles"] = $styles;
            $data["style_str"] = '';
            foreach ($styles as $selector => $value) {
                $data["style_str"] .= $selector . ': ' . $value . "; ";
            }
        }

        // get_video
        if ($this->ci->pg_module->is_module_installed('video_uploads')) {
            if (!empty($data['promo_video_data'])) {
                $data['promo_video_data'] = $data['promo_video_data'] ? unserialize($data['promo_video_data']) : [];
            }
            if (!empty($data['promo_video']) && $data['promo_video_data']['data']['upload_type'] == 'embed') {
                $this->ci->load->model('Video_uploads_model');
                $data['promo_video_content'] = $this->ci->Video_uploads_model->format_upload(
                    $this->video_gid,
                    $data['postfix'],
                    $data['promo_video_data']['data'],
                    $data['promo_video_image'],
                    $data['promo_video_data']['data']['upload_type']
                );
            } elseif (!empty($data['promo_video']) && $data['promo_video_data']['status'] == 'end') {
                $this->ci->load->model('Video_uploads_model');
                $data['promo_video_content'] = $this->ci->Video_uploads_model->format_upload(
                    $this->video_gid,
                    $data['postfix'],
                    $data['promo_video'],
                    $data['promo_video_image'],
                    $data['promo_video_data']['data']['upload_type']
                );
            }
        }

        return $data;
    }

    /**
     * Save promo object to data source
     *
     * @param integer $id_lang    language identifier
     * @param array   $data       promo data
     * @param string  $img_file   photo upload
     * @param string  $flash_file flash upload
     *
     * @return
     */
    public function savePromo($id_lang, $data, $img_file = '', $flash_file = '')
    {
        if (!$id_lang) {
            return false;
        }

        $data['id_lang'] = $id_lang;

        if (!$this->exists_promo($id_lang)) {
            $this->ci->db->insert(CONTENT_PROMO_TABLE, $data);
        } else {
            $this->ci->db->where('id_lang', $id_lang);
            $this->ci->db->update(CONTENT_PROMO_TABLE, $data);
        }

        if (!empty($img_file) && isset($_FILES[$img_file]) && is_array($_FILES[$img_file]) && is_uploaded_file($_FILES[$img_file]["tmp_name"])) {
            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->upload($this->upload_gid, $id_lang . "/", $img_file);

            if (empty($img_return["errors"])) {
                $img_data["promo_image"] = $img_return["file"];
                $this->save_promo($id_lang, $img_data);
            }
        }

        if (!empty($flash_file) && isset($_FILES[$flash_file]) && is_array($_FILES[$flash_file]) && is_uploaded_file($_FILES[$flash_file]["tmp_name"])) {
            $this->ci->load->model("File_uploads_model");
            $flash_return = $this->ci->File_uploads_model->upload($this->file_upload_gid, $id_lang . "/", $flash_file);

            if (empty($flash_return["errors"])) {
                $flash_data["promo_flash"] = $flash_return["file"];
                $this->save_promo($id_lang, $flash_data);
            }
        }
        $this->ci->cache->flush(CONTENT_PROMO_TABLE);
        return true;
    }

    /**
     * Validate promo object for saving to data source
     *
     * @param array  $data       promo data
     * @param string $img_file   photo upload
     * @param string $flash_file flash upload
     *
     * @return array
     */
    public function validatePromo($data, $img_file = '', $flash_file = '')
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["id_lang"])) {
            $return["data"]["id_lang"] = intval($data["id_lang"]);
        }

        if (isset($data["content_type"])) {
            $return["data"]["content_type"] = trim(strip_tags($data["content_type"]));
        }

        if (isset($data["block_width"])) {
            $return["data"]["block_width"] = intval($data["block_width"]);
        }

        if (isset($data["block_width_unit"])) {
            $return["data"]["block_width_unit"] = strval($data["block_width_unit"]);
            if (!$return["data"]["block_width_unit"]) {
                $return["data"]["block_width_unit"] = 'auto';
            }
        }

        if (isset($data["block_height"])) {
            $return["data"]["block_height"] = intval($data["block_height"]);
        }

        if (isset($data["block_height_unit"])) {
            $return["data"]["block_height_unit"] = strval($data["block_height_unit"]);
            if (!$return["data"]["block_height_unit"]) {
                $return["data"]["block_height_unit"] = 'auto';
            }
        }

        if (isset($data["block_align_hor"])) {
            $return["data"]["block_align_hor"] = strval($data["block_align_hor"]);
            if (!$return["data"]["block_align_hor"]) {
                $return["data"]["block_align_hor"] = 'center';
            }
        }

        if (isset($data["block_align_ver"])) {
            $return["data"]["block_align_ver"] = strval($data["block_align_ver"]);
            if (!$return["data"]["block_align_ver"]) {
                $return["data"]["block_align_ver"] = 'center';
            }
        }

        if (isset($data["block_image_repeat"])) {
            $return["data"]["block_image_repeat"] = strval($data["block_image_repeat"]);
            if (!$return["data"]["block_image_repeat"]) {
                $return["data"]["block_image_repeat"] = 'no-repeat';
            }
        }

        if (isset($data["promo_text"])) {
            $return["data"]["promo_text"] = trim($data["promo_text"]);
        }

        if (isset($data['promo_video'])) {
            $return['data']['promo_video'] = strval($data['promo_video']);
        }

        if (isset($data['promo_video_image'])) {
            $return['data']['promo_video_image'] = strval($data['promo_video_image']);
        }

        if (isset($data['promo_video_data'])) {
            $return['data']['promo_video_data'] = serialize($data['promo_video_data']);
        }

        if (!empty($img_file) && isset($_FILES[$img_file]) && is_array($_FILES[$img_file]) && is_uploaded_file($_FILES[$img_file]["tmp_name"])) {
            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->validate_upload($this->upload_gid, $img_file);
            if (!empty($img_return["error"])) {
                $return["errors"][] = implode("<br>", $img_return["error"]);
            }
        }

        if (!empty($flash_file) && isset($_FILES[$flash_file]) && is_array($_FILES[$flash_file]) && is_uploaded_file($_FILES[$flash_file]["tmp_name"])) {
            $this->ci->load->model("File_uploads_model");
            $flash_return = $this->ci->File_uploads_model->validate_upload($this->file_upload_gid, $flash_file);

            if (!empty($flash_return["error"])) {
                $return["errors"][] = implode("<br>", $flash_return["error"]);
            }
        }

        return $return;
    }

    /**
     * Remove promo object by language
     *
     * @param integer $id_lang language identifier
     *
     * @return void
     */
    public function deletePromo($id_lang)
    {
        $this->ci->db->where('id_lang', $id_lang);
        $this->ci->db->delete(CONTENT_PROMO_TABLE);
        $this->ci->cache->flush(CONTENT_PROMO_TABLE);
        return;
    }

    /**
     * Check promo object is exists by language
     *
     * @param integer $id_lang language identifier
     *
     * @return boolean
     */
    public function existsPromo($id_lang)
    {
        $nameTable  = CONTENT_PROMO_TABLE;
        $result =  $this->ci->cache->get(CONTENT_PROMO_TABLE, 'existsPromo' . $id_lang, function () use ($id_lang, $nameTable) {
            $ci = &get_instance();
            $ci->db->select('COUNT(*) AS cnt')->from($nameTable)->where('id_lang', $id_lang);
            $result = $ci->db->get()->result();
            return $result;
        });

        if (!empty($result) && intval($result[0]->cnt) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Processing events on added language
     *
     * Add fields depended on language
     *
     * @param integer $id_lang language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackAdd($id_lang)
    {
        $default_id_lang = $this->ci->pg_language->get_default_lang_id();
        $default_data = $this->get_promo($default_id_lang);

        $data = [
            "id_lang"            => $id_lang,
            "content_type"       => isset($default_data["content_type"]) ? $default_data["content_type"] : "",
            "promo_text"         => isset($default_data["promo_text"]) ? $default_data["promo_text"] : "",
            "block_width"        => isset($default_data["block_width"]) ? $default_data["block_width"] : "",
            "block_width_unit"   => isset($default_data["block_width_unit"]) ? $default_data["block_width_unit"] : "",
            "block_height"       => isset($default_data["block_height"]) ? $default_data["block_height"] : "",
            "block_height_unit"  => isset($default_data["block_height_unit"]) ? $default_data["block_height_unit"] : "",
            "block_align_hor"    => isset($default_data["block_align_hor"]) ? $default_data["block_align_hor"] : "",
            "block_align_ver"    => isset($default_data["block_align_ver"]) ? $default_data["block_align_ver"] : "",
            "block_image_repeat" => isset($default_data["block_image_repeat"]) ? $default_data["block_image_repeat"] : "",
        ];

        $validate_data = $this->validate_promo($data);
        if (empty($validate_data["errors"]) && !$this->exists_promo($id_lang)) {
            $this->save_promo($id_lang, $validate_data["data"]);
        }
    }

    /**
     * Processing events on remove language
     *
     * Remove fields depended on language
     *
     * @param integer $id_lang language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackDelete($id_lang)
    {
        $this->delete_promo($id_lang);
    }

    /**
     * Processing event on upload video
     *
     * @param integer $lang_id language identifier
     * @param string  $status  upload status
     * @param array   $data    upload data
     * @param array   $errors  upload errors
     *
     * @return void
     */
    public function videoCallback($lang_id, $status, $data, $errors)
    {
        $promo_data = $this->get_promo($lang_id);

        if (isset($data['video'])) {
            $update['promo_video'] = $data['video'];
        }
        if (isset($data['image'])) {
            $update['promo_video_image'] = $data['image'];
        }
        $update['promo_video_data'] = $promo_data['promo_video_data'];
        if ($status == 'start' || !isset($update['promo_video_data']['data'])) {
            $update['promo_video_data']['data'] = [];
        }
        if (!empty($data)) {
            $update['promo_video_data']['data'] = array_merge($update['promo_video_data']['data'], $data);
        }

        $update['promo_video_data']['status'] = $status;
        $update['promo_video_data']['errors'] = $errors;

        $validate_data = $this->validate_promo($update);
        $this->save_promo($lang_id, $validate_data['data']);

        return;
    }

    /**
     * Save promo video object from upload file
     *
     * @param integer $lang_id    language identifier
     * @param string  $video_name video upload name
     * @param string  $embed      embed data
     *
     * @return array
     */
    public function saveVideo($lang_id, $video_name, $embed)
    {
        if (!$this->ci->pg_module->is_module_installed('video_uploads')) {
            return $return;
        }

        $return = ['errors' => [], 'data' => [], 'success' => false];

        if (!$lang_id) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $promo_data = $this->get_promo($lang_id);

        $embed_data = [];
        if (!empty($embed)) {
            $this->ci->load->library('VideoEmbed');
            $embed_data = $this->ci->videoembed->get_video_data($embed);
            if ($embed_data !== false) {
                $embed_data['string_to_save'] = $this->ci->videoembed->get_string_from_video_data($embed_data);
                $embed_data['upload_type'] = 'embed';
                $embed_data['name'] = '';
                $embed_data['description'] = '';
            } else {
                $return["errors"][] = l('error_embed_wrong', 'content');
            }
        }

        if (isset($_FILES[$video_name]) && is_array($_FILES[$video_name]) && $_FILES[$video_name]['error'] != 4) {
            if (!is_uploaded_file($_FILES[$video_name]['tmp_name'])) {
                $return['errors'][] = l('error_upload_video', 'content');

                return $return;
            }
        } else {
            $video_name = '';
        }

        if (!empty($data['promo_video'])) {
            if ($data['promo_video_data']['data']['upload_type'] == 'embed') {
                if ($video_name) {
                    $return['errors'][] = l('error_max_video_reached', 'content');
                }
            } elseif ($video_name || $embed_data) {
                $return['errors'][] = l('error_max_video_reached', 'content');
            }
        }

        if (empty($return['errors'])) {
            if ($video_name) {
                $this->ci->load->model('Video_uploads_model');
                $video_data = [
                    'name'        => '',
                    'description' => '',
                ];

                $video_return = $this->ci->Video_uploads_model->upload($this->video_gid, $promo_data['postfix'], $video_name, $lang_id, $video_data);
                if (!empty($video_return['errors'])) {
                    $return['errors'] = $video_return['errors'];
                } else {
                    $return['data']['file'] = $video_return['file'];
                }
                $return['success'] = true;
            } elseif ($embed_data) {
                $this->ci->load->model('Uploads_model');
                $save_data["promo_video_image"] = $this->ci->Uploads_model->generate_filename('.jpg');
                $save_data["promo_video_data"] = serialize(['data' => $embed_data]);
                $save_data["promo_video"] = 'embed';
                $this->save_promo($lang_id, $save_data);
                $return['success'] = true;
            }
        }
        $this->ci->cache->flush(CONTENT_PROMO_TABLE);
        return $return;
    }

    /**
     * Save promo video object from local file
     *
     * @param integer $lang_id    language identifier
     * @param string  $video_name video upload name
     *
     * @return array
     */
    public function saveLocalVideo($lang_id, $video_name)
    {
        if (!$this->ci->pg_module->is_module_installed('video_uploads')) {
            return $return;
        }

        $return = ['errors' => [], 'data' => []];

        if (empty($video_name)) {
            $return['errors'][] = l('error_empty_video', 'content');

            return $return;
        }

        $promo_data = $this->get_promo($lang_id);

        if (!empty($promo_data['promo_video'])) {
            $return['errors'][] = l('error_max_video_reached', 'content');
        } else {
            $this->ci->load->model('Video_uploads_model');
            $video_data = [
                'name'        => '',
                'description' => '',
            ];

            $video_return = $this->ci->Video_uploads_model->upload_exists($this->video_gid, $promo_data['postfix'], $video_name, $lang_id, $video_data);
            if (!empty($video_return['errors'])) {
                $return['errors'] = $video_return['errors'];
            } else {
                $return['data']['file'] = $video_return['file'];
            }
        }
        $this->ci->cache->flush(CONTENT_PROMO_TABLE);
        return $return;
    }

    /**
     * Remove video object by language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function deleteVideo($lang_id)
    {
        if (!$lang_id) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $promo_data = $this->get_promo($lang_id);

        if ($promo_data['promo_video_data']['data']['upload_type'] != 'embed') {
            $this->ci->load->model('Video_uploads_model');
            $this->ci->Video_uploads_model->delete_upload($this->video_config_id, $promo_data['postfix'], $promo_data['promo_video'], $promo_data['promo_video_image'], $promo_data['promo_video_data']['data']['upload_type']);
        }

        $save_data = [
            'promo_video'       => '',
            'promo_video_image' => '',
            'promo_video_data'  => '',
        ];
        $this->ci->cache->flush(CONTENT_PROMO_TABLE);
        $this->save_promo($lang_id, $save_data);
    }

    /**
     * Return data of promo video type
     *
     * @return array
     */
    public function getVideoType()
    {
        $this->ci->load->model('Video_uploads_model');

        return $this->ci->Video_uploads_model->get_config($this->video_gid);
    }

    /**
     * Change settings for promo formatting
     *
     * @param string $name  parameter name
     * @param mixed  $value parameter value
     *
     * @return void
     */
    public function setFormatSettings($name, $value = false)
    {
        if (!is_array($name)) {
            $name = [$name => $value];
        }
        foreach ($name as $key => $item) {
            $this->format_settings[$key] = $item;
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'delete_promo' => 'deletePromo',
            'delete_video' => 'deleteVideo',
            'exists_promo' => 'existsPromo',
            'format_promo' => 'formatPromo',
            'get_promo' => 'getPromo',
            'get_video_type' => 'getVideoType',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'save_local_video' => 'saveLocalVideo',
            'save_promo' => 'savePromo',
            'save_video' => 'saveVideo',
            'set_format_settings' => 'setFormatSettings',
            'validate_promo' => 'validatePromo',
            'video_callback' => 'videoCallback',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
