<?php

declare(strict_types=1);

namespace Pg\modules\news\models;

use Pg\Libraries\Cache\Manager as CacheManager;

/**
 * News module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define('NEWS_TABLE', DB_PREFIX . 'news');

/**
 * News main model
 *
 * @package     PG_Dating
 * @subpackage  News
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class NewsModel extends \Model
{
    const DB_DATE_FORMAT = 'Y-m-d H:i:s';
    const MODULE_GID = 'news';

    /**
     * News object properties in data source
     *
     * @var array
     */
    private $fields_news = [
        'id',
        'gid',
        'img',
        'status',
        'id_lang',
        'news_type',
        'date_add',
        'feed_link',
        'feed_id',
        'feed_unique_id',
        'video',
        'video_image',
        'video_data',
        'comments_count',
        'id_seo_settings',
    ];

    /**
     * Short properties of news
     *
     * @var array
     */
    private $fields_news_cute = [
        'id',
        'gid',
        'img',
        'status',
        'id_lang',
        'news_type',
        'date_add',
        'feed_link',
        'feed_id',
        'feed_unique_id',
        'comments_count',
    ];

    /**
     * News logo upload (GUID)
     *
     * @var string
     */
    public $upload_config_id = 'news-logo';

    /**
     * Video news upload (GUID)
     *
     * @var string
     */
    public $video_config_id = 'news-video';

    /**
     * News RSS logo upload (GUID)
     *
     * @var string
     */
    public $rss_config_id = 'rss-logo';

    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(NEWS_TABLE);
    }

    /**
     * Return news object by identifier
     *
     * @param integer $id       news identifier
     * @param integer $lang_ids languages identifiers
     *
     * @return array/false
     */
    public function getNewsById($id, $lang_ids = null)
    {
        if (empty($lang_ids)) {
            $lang_ids = [$this->ci->pg_language->current_lang_id];
        }

        $fields_news = $this->fields_news;

        foreach ($lang_ids as $lang_id) {
            $fields_news[] = 'name_' . $lang_id;
            $fields_news[] = 'annotation_' . $lang_id;
            $fields_news[] = 'content_' . $lang_id;
        }
        $nameTable  = NEWS_TABLE;
        $fields     = implode(", ", $fields_news);
        $nameCache  = 'getNewsById'.$id."lang".implode("_", $fields_news);

        $result =  $this->ci->cache->get(NEWS_TABLE,$nameCache, function() use ($id,$nameTable,$fields){
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("id", $id)
                ->get()
                ->result_array();
            return $result;
        });

        if (empty($result)) {
            return false;
        } else {
            reset($lang_ids);
            $data = $result[0];
            $lang_id = in_array($data['id_lang'], $lang_ids) ? $data['id_lang'] : current($lang_ids);
            $data['name'] = $data['name_' . $lang_id];
            $data['annotation'] = $data['annotation_' . $lang_id];
            $data['content'] = $data['content_' . $lang_id];

            return $data;
        }
    }

    /**
     * Return news object by GUID
     *
     * @param string $gid news GUID
     *
     * @return array/false
     */
    public function getNewsByGid($gid, $lang_id = null)
    {
        if (!$lang_id) {
            $lang_id = $this->ci->pg_language->current_lang_id;
        }

        $fields_news = $this->fields_news;
        $fields_news[] = 'name_' . $lang_id;
        $fields_news[] = 'annotation_' . $lang_id;
        $fields_news[] = 'content_' . $lang_id;

        $nameTable  = NEWS_TABLE;
        $fields     = implode(", ", $fields_news);
        $nameCache  = 'getNewsByGid'.$gid."lang".implode("_", $fields_news);

        $result =  $this->ci->cache->get(NEWS_TABLE,$nameCache, function() use ($gid,$nameTable,$fields){
            $ci = &get_instance();
            $result = $ci->db->select($fields)
                ->from($nameTable)
                ->where("gid", $gid)
                ->get()
                ->result_array();
            return $result;
        });

        if (empty($result)) {
            return false;
        } else {
            $data = $result[0];
            $data['name'] = $data['name_' . $lang_id];
            $data['annotation'] = $data['annotation_' . $lang_id];
            $data['content'] = $data['content_' . $lang_id];

            return $data;
        }
    }

    /**
     * Format news object
     *
     * @param array $news news object
     *
     * @return array
     */
    public function formatNews($news)
    {
        $feeds = [];

        $is_uploads_install = $this->ci->pg_module->is_module_installed('uploads');
        if ($is_uploads_install) {
            $this->ci->load->model('Uploads_model');
        }

        $is_video_uploads_install = $this->ci->pg_module->is_module_installed('video_uploads');
        if ($is_video_uploads_install) {
            $this->ci->load->model('Video_uploads_model');
        }

        $this->ci->load->helper('date_format');
        $date_formats = $this->ci->pg_date->get_format('date_literal', 'st');

        foreach ($news as $key => $data) {
            if (!empty($data["id"])) {
                $data["prefix"] = date("Y/m/d/", strtotime($data["date_add"])) . $data["id"] . "";
            }

            if ($is_uploads_install) {
                if (!empty($data["img"])) {
                    $data["media"]["img"] = $this->ci->Uploads_model->format_upload($this->upload_config_id, $data["prefix"], $data["img"]);
                } else {
                    $data["media"]["img"] = $this->ci->Uploads_model->format_default_upload($this->upload_config_id);
                }
            }

            if ($is_video_uploads_install) {
                if (!empty($data["video_data"])) {
                    $data["video_data"] = is_string($data["video_data"]) ? unserialize($data["video_data"]) : $data["video_data"];
                }

                if (!empty($data["video"]) && $data["video_data"]["status"] == "end") {
                    $data["video_content"] = $this->ci->Video_uploads_model->format_upload($this->video_config_id, $data["prefix"], $data["video"], $data["video_image"], $data["video_data"]["data"]["upload_type"]);
                }
            }

            if (empty($data['date_add'])) {
                $data['date_add'] = date(self::DB_DATE_FORMAT);
            }

            // seo data
            $data['created-date'] = tpl_date_format($data['date_add'], $date_formats);

            $news[$key] = $data;

            if (!empty($data["feed_id"]) && !in_array($data["feed_id"], $feeds)) {
                $feeds[] = $data["feed_id"];
            }
        }

        if (!empty($feeds)) {
            $this->ci->load->model('news/models/Feeds_model');
            $temp = $this->ci->Feeds_model->getFeedsList(null, null, null, [], $feeds);
            if (!empty($temp)) {
                foreach ($temp as $feed) {
                    $feeds_list[$feed["id"]] = $feed;
                }
                foreach ($news as $key => $data) {
                    if (!empty($data["feed_id"]) && !empty($feeds_list[$data["feed_id"]])) {
                        $news[$key]["feed"] = $feeds_list[$data["feed_id"]];
                    }
                }
            }
        }

        return $news;
    }

    /**
     * Format news object
     *
     * @param array $news news object
     *
     * @return array
     */
    public function formatSingleNews($news)
    {
        return $this->formatNews([$news])[0];
    }

    /**
     * Return news objects as array
     *
     * @param integer $page              page of results
     * @param integer $items_on_page     items per page
     * @param array   $order_by          sorting data
     * @param array   $params            sql criteria of query to data source
     * @param array   $filter_object_ids filters identifiers
     * @param boolean $formated          format results
     *
     * @return array
     */
    public function getNewsList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null, $formated = true)
    {
        $lang_id = $this->ci->pg_language->current_lang_id;

        $fields_news_cute = $this->fields_news_cute;
        $fields_news_cute[] = 'name_' . $lang_id;
        $fields_news_cute[] = 'annotation_' . $lang_id;

        $this->ci->db->select(implode(", ", $fields_news_cute));
        $this->ci->db->from(NEWS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            $fields_news = $this->fields_news;
            $fields_news[] = 'name_' . $lang_id;
            $fields_news[] = 'annotation_' . $lang_id;
            $fields_news[] = 'content_' . $lang_id;

            foreach ($order_by as $field => $dir) {
                if (in_array($field, $fields_news)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $results = $this->ci->db->get()->result_array();
        if (!empty($results) && is_array($results)) {
            foreach ($results as $r) {
                if (!empty($r['name_' . $lang_id])) {
                    $r['name'] = $r['name_' . $lang_id];
                }
                if (!empty($r['annotation_' . $lang_id])) {
                    $r['annotation'] = $r['annotation_' . $lang_id];
                }
                $data[] = $r;
            }

            return ($formated) ? $this->format_news($data) : $data;
        }

        return [];
    }

    /**
     * Return number of news objects in data source
     *
     * @param array $params            sql criteria of query to data source
     * @param array $filter_object_ids filters identifiers
     *
     * @return integer
     */
    public function getNewsCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(NEWS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->cnt);
        } else {
            return 0;
        }
    }

    /**
     * Save news object to data source
     *
     * @param integer $id         news identifier
     * @param array   $data       news data
     * @param string  $file_name  file name of news image upload
     * @param string  $video_name file name of news video upload
     *
     * @return integer
     */
    public function saveNews($id, $data, $file_name = "", $video_name = "")
    {
        if (empty($id)) {
            if (empty($data["id_lang"])) {
                $data["id_lang"] = $this->ci->pg_language->current_lang_id;
            }

            if (empty($data["date_add"])) {
                $data["date_add"] = date("Y-m-d H:i:s");
            }
            $this->ci->db->insert(NEWS_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(NEWS_TABLE, $data);
        }

        if (!empty($file_name) && !empty($id) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $news_data = $this->formatSingleNews($this->getNewsById($id));

            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->upload($this->upload_config_id, $news_data["prefix"], $file_name);

            if (empty($img_return["errors"])) {
                $img_data["img"] = $img_return["file"];
                $this->saveNews($id, $img_data);
            }
        }

        if (!empty($video_name) && !empty($id) && isset($_FILES[$video_name]) && is_array($_FILES[$video_name]) && is_uploaded_file($_FILES[$video_name]["tmp_name"])) {
            if (!isset($news_data)) {
                $news_data = $this->formatSingleNews($this->getNewsById($id));
            }
            $this->ci->load->model("Video_uploads_model");
            $video_data = [
                "name"        => $news_data["name"],
                "description" => $news_data["annotation"],
            ];
            $video_return = $this->ci->Video_uploads_model->upload($this->video_config_id, $news_data["prefix"], $video_name, $id, $video_data);

        }
        $this->ci->cache->flush(NEWS_TABLE);
        return $id;
    }

    /**
     * Upload logo from url
     *
     * @param integer $news_id    news identifier
     * @param string  $image_link image url
     *
     * @return void
     */
    public function uploadLogoUrl($news_id, $image_link)
    {
        $news_data = $this->formatSingleNews(
            $this->getNewsById($news_id)
         );
        $data = $this->ci->Uploads_model->uploadUrl($this->upload_config_id, $news_data["prefix"], $image_link, 'news_icon');
        $this->saveNews($news_id, ['img' => $data["file"]], null, null);
        $this->ci->cache->flush(NEWS_TABLE);
    }

    /**
     * Validate news object for saving to data source
     *
     * @param integer $id         news identifier
     * @param array   $data       news data
     * @param string  $file_name  file name of news image upload
     * @param string  $video_name file name of news video upload
     *
     * @return array
     */
    public function validateNews($id, $data, $file_name = "", $video_name = "")
    {
        $return = ["errors" => [], "data" => []];
        if (!empty($data["id_lang"])) {
            $return["data"]["id_lang"] = $news_data['id_lang'] = intval($data["id_lang"]);
        }

        if (!empty($data['name'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['name']);
            if ($langs === false) {
                $return["errors"][] =  l('error_name_incorrect', 'news');
            } else {
                foreach ($langs as $lid => $value) {
                    $return["data"]['name_' . $lid] = $value;
                }
            }
        } else {
            $return["errors"][] = l('error_name_incorrect', 'news');
        }

        if (!empty($data['annotation'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['annotation']);
            if ($langs === false) {
                $return["errors"][] = l('error_content_annotation_invalid', 'news');
            } else {
                foreach ($langs as $lid => $value) {
                    $return["data"]['annotation_' . $lid] = $value;
                }
            }
        } else {
            $return["errors"][] = l('error_content_annotation_invalid', 'news');
        }

        if (!empty($data['content'])) {
            $langs = $this->ci->pg_language->getNamesDifferentLangs($data['content']);
            if ($langs === false) {
                $return["errors"][] = l('error_content_incorrect', 'news');
            } else {
                foreach ($langs as $lid => $value) {
                    $return["data"]['content_' . $lid] = $value;
                }
            }
        } else {
            $return["errors"][] = l('error_content_incorrect', 'news');
        }

        if (!empty($data["feed_id"])) {
            $return["data"]["feed_id"] = intval($data["feed_id"]);
        }

        if (!empty($data["feed_link"])) {
            $return["data"]["feed_link"] = trim(strip_tags($data["feed_link"]));
        }

        if (!empty($data["feed_unique_id"])) {
            $return["data"]["feed_unique_id"] = trim(strip_tags($data["feed_unique_id"]));
            if (!empty($return["data"]["feed_unique_id"]) && empty($id)) {
                $feed_params["where"]["feed_unique_id"] = $return["data"]["feed_unique_id"];
                $count = $this->getNewsCount($feed_params);
                if ($count > 0) {
                    $return["errors"][] = l('error_feed_news_exists', 'news');
                }
            }
        }

        if (!empty($data["news_type"])) {
            $return["data"]["news_type"] = trim($data["news_type"]);
        }

        if (!empty($data["status"])) {
            $return["data"]["status"] = intval($data["status"]);
        }

        if (!empty($data["video"])) {
            $return["data"]["video"] = strval($data["video"]);
        }

        if (!empty($data["video_data"])) {
            $return["data"]["video_data"] = $data["video_data"];
        }

        if (!empty($data["gid"])) {
            $gid = !empty($data['gid']) ? $data['gid'] : $return["data"]['name_' . $this->ci->pg_language->current_lang_id];
            $gid_data = $this->ci->pg_language->createGUID($gid);
            if (!empty($gid_data['errors'])) {
                $return["errors"][] = $gid_data['errors'];
            }
            $params = ['where' => ['gid' => $gid_data['gid']]];
            if ($id) {
                $params['where']['id <>'] = $id;
            }
            $count = $this->getNewsCount($params);
            if ($count > 0) {
                $return["errors"][] = l('error_gid_already_exists', 'news');
            } else {
                $return["data"]["gid"] = $gid_data['gid'];
            }
        }

        if (!empty($file_name) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->validate_upload($this->upload_config_id, $file_name);
            if (!empty($img_return["error"])) {
                $return["errors"][] = implode("<br>", $img_return["error"]);
            }
        }

        if (!empty($video_name) && isset($_FILES[$video_name]) && is_array($_FILES[$video_name]) && is_uploaded_file($_FILES[$video_name]["tmp_name"])) {
            $this->ci->load->model("Video_uploads_model");
            $video_return = $this->ci->Video_uploads_model->validate_upload($this->video_config_id, $video_name);
            if (!empty($video_return["error"])) {
                $return["errors"][] = implode("<br>", $video_return["error"]);
            }
        }

        return $return;
    }

    /**
     * Remove news object by identifier
     *
     * @param integer $id news identifier
     *
     * @return void
     */
    public function deleteNews($id)
    {
        if (!empty($id)) {
            $news_data = $this->getNewsById($id);
            $this->ci->db->where('id', $id);
            $this->ci->db->delete(NEWS_TABLE);

            if (!empty($news_data["img"])) {
                $news_data = $this->formatSingleNews($news_data);
                $this->ci->load->model("Uploads_model");
                $this->ci->Uploads_model->deleteUpload($this->upload_config_id, $news_data["prefix"], $news_data["img"]);
            }

            if (!empty($news_data["video"])) {
                $news_data = $this->formatSingleNews($news_data);
                $this->ci->load->model("Video_uploads_model");
                $this->ci->Video_uploads_model->deleteUpload($this->video_config_id, $news_data["prefix"], $news_data["video"], $news_data["video_image"]);
            }
        }
        $this->ci->cache->flush(NEWS_TABLE);
        return;
    }

    /**
     * Validate settings of news rss
     *
     * @param array $data      settings data
     * @param array $file_name file name of rss logo upload
     *
     * @return array
     */
    public function validateRssSettings($data, $file_name)
    {
        $return = ["errors" => [], "data" => []];

        if (isset($data["rss_use_feeds_news"])) {
            $return["data"]["rss_use_feeds_news"] = $data["rss_use_feeds_news"] ? 1 : 0;
        }

        if (isset($data["rss_news_max_count"])) {
            $return["data"]["rss_news_max_count"] = intval($data["rss_news_max_count"]);

            if ($return["data"]["rss_news_max_count"] < 1) {
                $return["errors"][] = l('error_sett_rss_news_count_incorrect', 'news');
            }
        }

        if (isset($data["userside_items_per_page"])) {
            $return["data"]["userside_items_per_page"] = intval($data["userside_items_per_page"]);

            if ($return["data"]["userside_items_per_page"] < 1) {
                $return["errors"][] = l('error_sett_userside_page_incorrect', 'news');
            }
        }

        if (isset($data["userhelper_items_per_page"])) {
            $return["data"]["userhelper_items_per_page"] = intval($data["userhelper_items_per_page"]);

            if ($return["data"]["userhelper_items_per_page"] < 1) {
                $return["errors"][] = l('error_sett_userhelper_page_incorrect', 'news');
            }
        }

        if (isset($data["rss_feed_channel_title"])) {
            $return["data"]["rss_feed_channel_title"] = trim(strip_tags($data["rss_feed_channel_title"]));

            if (empty($return["data"]["rss_feed_channel_title"])) {
                $return["errors"][] = l('error_sett_feed_channel_title_incorrect', 'news');
            }
        }

        if (isset($data["rss_feed_channel_description"])) {
            $return["data"]["rss_feed_channel_description"] = trim(strip_tags($data["rss_feed_channel_description"]));

            if (empty($return["data"]["rss_feed_channel_description"])) {
                $return["errors"][] = l('error_sett_feed_channel_description_incorrect', 'news');
            }
        }

        if (isset($data["rss_feed_image_title"])) {
            $return["data"]["rss_feed_image_title"] = trim(strip_tags($data["rss_feed_image_title"]));

            if (empty($return["data"]["rss_feed_image_title"])) {
                $return["errors"][] = l('error_sett_feed_image_title_incorrect', 'news');
            }
        }

        if (!empty($file_name) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->validate_upload($this->rss_config_id, $file_name);
            if (!empty($img_return["error"])) {
                $return["errors"][] = implode("<br>", $img_return["error"]);
            }
        }

        return $return;
    }

    /**
     * Return settings of news rss as array
     *
     * @return array
     */
    public function getRssSettings()
    {
        $data = [
            "userside_items_per_page"      => $this->ci->pg_module->get_module_config('news', 'userside_items_per_page'),
            "userhelper_items_per_page"    => $this->ci->pg_module->get_module_config('news', 'userhelper_items_per_page'),
            "rss_feed_channel_title"       => $this->ci->pg_module->get_module_config('news', 'rss_feed_channel_title'),
            "rss_feed_channel_description" => $this->ci->pg_module->get_module_config('news', 'rss_feed_channel_description'),
            "rss_feed_image_url"           => $this->ci->pg_module->get_module_config('news', 'rss_feed_image_url'),
            "rss_feed_image_title"         => $this->ci->pg_module->get_module_config('news', 'rss_feed_image_title'),
            "rss_use_feeds_news"           => $this->ci->pg_module->get_module_config('news', 'rss_use_feeds_news'),
            "rss_news_max_count"           => $this->ci->pg_module->get_module_config('news', 'rss_news_max_count'),
        ];

        if ($data["rss_feed_image_url"]) {
            $this->ci->load->model('Uploads_model');
            $data["rss_feed_image_media"] = $this->ci->Uploads_model->format_upload($this->rss_config_id, "", $data["rss_feed_image_url"]);
        }

        return $data;
    }

    /**
     * Save settings of news rss to data source
     *
     * @param array  $data      settings data
     * @param strign $file_name file name of rss logo upload
     *
     * @return void
     */
    public function setRssSettings($data, $file_name = '')
    {
        foreach ($data as $setting => $value) {
            $this->ci->pg_module->set_module_config('news', $setting, $value);
        }

        if (!empty($file_name) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $this->ci->load->model("Uploads_model");
            $img_return = $this->ci->Uploads_model->upload($this->rss_config_id, "", $file_name);

            if (empty($img_return["errors"])) {
                $this->ci->pg_module->set_module_config('news', "rss_feed_image_url", $img_return["file"]);
            }
        }

        return;
    }

    ////// seo

    /**
     * Return module settings to rewrite seo urls
     *
     * @param string  $method  method name
     * @param integer $lang_id language identifier
     *
     * @return array
     */
    public function getSeoSettings($method = '', $lang_id = '')
    {
        if (!empty($method)) {
            return $this->getSeoSettingsInternal($method, $lang_id);
        } else {
            $actions = ['index', 'view'];
            $return = [];
            foreach ($actions as $action) {
                $return[$action] = $this->getSeoSettingsInternal($action, $lang_id);
            }

            return $return;
        }
    }

    /**
     * Return module settings to rewrite seo urls (internal)
     *
     * @param string  $method  method name
     * @param integer $lang_id language identifier
     *
     * @return array
     */
    public function getSeoSettingsInternal($method, $lang_id = '')
    {
        if ($method == "index") {
            return [
                "templates"   => [],
                "url_vars"    => [],
                'url_postfix' => [
                    'page' => ['page' => 'numeric'],
                ],
                'optional' => [],
            ];
        } elseif ($method == "view") {
            return [
                "templates" => ['id', 'gid', 'name', 'annotation', 'created-date', 'feed_unique_id'],
                "url_vars"  => [
                    "id" => ['id' => 'literal', "gid" => 'literal'],
                ],
                'url_postfix' => [],
                'optional'    => [
                    ['name' => 'literal', 'created-date' => 'literal'],
                ],
            ];
        }
    }

    /**
     * Transform seo value form query string to method parameter
     *
     * @param string $var_name_from variable name from url
     * @param string $var_name_to   variable name to method parameter
     * @param string $value         variable value
     *
     * @return mixed
     */
    public function requestSeoRewrite($var_name_from, $var_name_to, $value)
    {
        $user_data = [];

        if ($var_name_from == $var_name_to) {
            return $value;
        }

        if ($var_name_from == "gid" && $var_name_to == "id") {
            $news_data = $this->get_news_by_gid($value);

            return $news_data["id"];
        }

        show_404();
    }

    /**
     * Return data for generating xml sitemap
     *
     * @return array
     */
    public function getSitemapXmlUrls($generate = true)
    {
        $this->ci->load->helper('seo');

        $lang_canonical = true;

        if ($this->ci->pg_module->is_module_installed('seo')) {
            $lang_canonical = $this->ci->pg_module->get_module_config('seo', 'lang_canonical');
        }
        $languages = $this->ci->pg_language->languages;
        if ($lang_canonical) {
            $default_lang_id = $this->ci->pg_language->get_default_lang_id();
            $default_lang_code = $this->ci->pg_language->get_lang_code_by_id($default_lang_id);
            $langs[$default_lang_id] = $default_lang_code;
        } else {
            foreach ($languages as $lang_id => $lang_data) {
                $langs[$lang_id] = $lang_data['code'];
            }
        }

        $return = [];

        $user_settings = $this->ci->pg_seo->get_settings('user', 'news', 'index');
        if (!$user_settings['noindex']) {
            if ($generate === true) {
                $this->ci->pg_seo->set_lang_prefix('user');
                foreach ($languages as $lang_id => $lang_data) {
                    if ($this->ci->pg_language->is_active($lang_id) === true) {
                        $lang_code = $this->ci->pg_language->get_lang_code_by_id($lang_id);
                        $this->ci->pg_seo->set_lang_prefix('user', $lang_code);
                        $return[] = [
                            "url"      => rewrite_link('news', 'index', [], false, $lang_code, $lang_canonical),
                            "priority" => $user_settings['priority'],
                            "page" => "index",
                        ];
                    }
                }
            } else {
                $return[] = [
                    "url"      => rewrite_link('news', 'index', [], false, null, $lang_canonical),
                    "priority" => $user_settings['priority'],
                    "page" => "index",
                ];
            }
        }

        $user_settings = $this->ci->pg_seo->get_settings('user', 'news', 'view');
        if (!$user_settings['noindex']) {
            $criteria = [
                'where' => [
                    'status'      => 1,
                    'date_add >=' => date("Y-m-d", time() - 60 * 60 * 24 * 31),
                ],
            ];

            $order_array = ['date_add' => 'DESC'];

            $result = $this->get_news_list(1, null, $order_array, $criteria);
            if ($generate === true) {
                $this->ci->pg_seo->set_lang_prefix('user');
                foreach ($result as $news) {
                    foreach ($languages as $lang_id => $lang_data) {
                        $lang_code = $this->ci->pg_language->get_lang_code_by_id($lang_id);
                        $this->ci->pg_seo->set_lang_prefix('user', $lang_code);
                        $return[] = [
                            "url"      => rewrite_link('news', 'view', $news, false, $lang_code, $lang_canonical),
                            "priority" => $user_settings['priority'],
                            "page" => "view",
                        ];
                    }
                }
            } else {
                foreach ($result as $news) {
                    $return[] = [
                        "url"      => rewrite_link('news', 'view', $news, false, null, $lang_canonical),
                        "priority" => $user_settings['priority'],
                        "page" => "view",
                    ];
                }
            }
        }

        return $return;
    }

    /**
     * Return data for generating site map
     *
     * @return array
     */
    public function getSitemapUrls()
    {
        $this->ci->load->helper('seo');
        $auth = $this->ci->session->userdata("auth_type");

        $block[] = [
            "name"      => l('header_news', 'news'),
            "link"      => rewrite_link('news', 'index'),
            "clickable" => true,
        ];

        return $block;
    }

    /**
     * Return available pages of banners locations as array
     *
     * Callback method of banners module
     *
     * @return array
     */
    public function bannerAvailablePages()
    {
        $return[] = ["link" => "news/index", "name" => l('seo_tags_index_header', 'news')];
        $return[] = ["link" => "news/view", "name" => l('seo_tags_view_header', 'news')];

        return $return;
    }

    /**
     * Return last news to form subscription
     *
     * Callback method of subscriptions module
     *
     * @param integer $lang_id language identifier
     *
     * @return array
     */
    public function getLastNews($lang_id = 1)
    {
        $d = mktime();
        $last_week = mktime(date("H", $d), date("i", $d), date("s", $d), date("n", $d), date("j", $d) - 7, date("Y", $d));
        $attrs = [
            'where' => [
                'id_lang' => $lang_id,
                'status' => 1,
                'date_add >' => date("Y-m-d H:i:s", $last_week),
                'set_to_subscribe' => 0
            ]
        ];
        $content = '';
        $last_news = $this->getNewsList(null, null, ['date_add' => "DESC"], $attrs);
        if ($last_news) {
            foreach ($last_news as $k => $item) {
                $content .= $item['date_add'] . "\r\n" . $item['annotation'] . "\r\n" . l('link_view_more', 'news', $lang_id) . ' ' . site_url() . 'news/view/' . $item['id'] . "\r\n" . "\r\n";
            }
        }

        return ['content' => $content];
    }

    /**
     * Update status of news subscription
     *
     * @param array $params subscription sql criteria
     *
     * @return void
     */
    public function updateNewsSubscriptionStatus($params)
    {
        $data = ['set_to_subscribe' => '1'];

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }
        $this->ci->db->update(NEWS_TABLE, $data);
    }

    /**
     * Process events from video upload module
     *
     * Callback method of video upload module
     *
     * @param integer $id     news object identifier
     * @param string  $status status of news video
     * @param array   $data   video data
     * @param array   $errors video errors
     *
     * @return void
     */
    public function videoCallback($id, $status, $data, $errors)
    {
        $news_data = $this->get_news_by_id($id);
        $news_data = $this->format_single_news($news_data);
        $update = [];
        if (isset($data["video"])) {
            $update["video"] = $data["video"];
        }
        if (isset($data["image"])) {
            $update["video_image"] = $data["image"];
        }

        $update["video_data"] = $news_data["video_data"];

        if ($status == 'start') {
            $update["video_data"] = [];
        }

        if (!isset($update["video_data"]["data"])) {
            $update["video_data"] = $update["video_data"] ?: [];
            $update["video_data"]["data"] = [];
        }

        if (!empty($data)) {
            $update["video_data"]["data"] = array_merge($update["video_data"]["data"], $data);
        }

        $update["video_data"]["status"] = $status;
        $update["video_data"]["errors"] = $errors;
        $update["video_data"] = serialize($update["video_data"]);
        $this->save_news($id, $update);
    }

    /**
     * Update comments count
     *
     * Callback method of comments module
     *
     * @param integer $count comments count
     * @param integer $id    object identifier
     *
     * @return void
     */
    public function commentsCountCallback($count, $id = 0)
    {
        if ($id) {
            $this->ci->db->where('id', $id);
        }
        $data['comments_count'] = $count;
        $this->ci->db->update(NEWS_TABLE, $data);
        $this->ci->cache->flush(NEWS_TABLE);
    }

    /**
     * Generate comment text
     *
     * Callback method of comments module
     *
     * @param integer $id object identifier
     *
     * @return void
     */
    public function commentsObjectCallback($id = 0)
    {
        $return = [];
        $return["body"] = "<a href='" . site_url() . "admin/news/edit/" . $id . "'>" . site_url() . "admin/news/edit/" . $id . "</a>";
        $return["author"] =  "admin";

        return $return;
    }

    /**
     * Install content properties depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        $this->ci->dbforge->add_column(NEWS_TABLE, [
            'name_' . $lang_id => [
                'type' => 'varchar(255)',
                'null' => false
            ]
        ]);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_' . $lang_id, 'name_' . $default_lang_id, false);
            $this->ci->db->update(NEWS_TABLE);
        }
        $this->ci->dbforge->add_column(NEWS_TABLE, [
            'annotation_' . $lang_id => [
                'type' => 'text',
                'null' => false
            ]
        ]);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('annotation_' . $lang_id, 'annotation_' . $default_lang_id, false);
            $this->ci->db->update(NEWS_TABLE);
        }
        $this->ci->dbforge->add_column(NEWS_TABLE, [
            'content_' . $lang_id => [
                'type' => 'text',
                'null' => false
            ]
        ]);
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('content_' . $lang_id, 'content_' . $default_lang_id, false);
            $this->ci->db->update(NEWS_TABLE);
        }
    }

    /**
     * Uninstall content properties depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();
        $fields_exists = $this->ci->db->list_fields(NEWS_TABLE);
        $fields = ['name_' . $lang_id, 'annotation_' . $lang_id,  'content_' . $lang_id];
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(NEWS_TABLE, $field_name);
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            '_banner_available_pages' => 'bannerAvailablePages',
            'comments_count_callback' => 'commentsCountCallback',
            'get_seo_settings' => 'getSeoSettings',
            'comments_object_callback' => 'commentsObjectCallback',
            'delete_news' => 'deleteNews',
            'format_news' => 'formatNews',
            'format_single_news' => 'formatSingleNews',
            'get_last_news' => 'getLastNews',
            'get_news_by_gid' => 'getNewsByGid',
            'get_news_by_id' => 'getNewsById',
            'get_news_count' => 'getNewsCount',
            'get_news_list' => 'getNewsList',
            'get_rss_settings' => 'getRssSettings',
            'get_sitemap_urls' => 'getSitemapUrls',
            'get_sitemap_xml_urls' => 'getSitemapXmlUrls',
            'lang_dedicate_module_callback_add' => 'langDedicateModuleCallbackAdd',
            'lang_dedicate_module_callback_delete' => 'langDedicateModuleCallbackDelete',
            'request_seo_rewrite' => 'requestSeoRewrite',
            'save_news' => 'saveNews',
            'set_rss_settings' => 'setRssSettings',
            'update_news_subscription_status' => 'updateNewsSubscriptionStatus',
            'upload_logo_url' => 'uploadLogoUrl',
            'validate_news' => 'validateNews',
            'validate_rss_settings' => 'validateRssSettings',
            'video_callback' => 'videoCallback',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
