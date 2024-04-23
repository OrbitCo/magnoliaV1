<?php

declare(strict_types=1);

namespace Pg\modules\news\models;

/**
 * News module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

define('NEWS_FEEDS_TABLE', DB_PREFIX . 'news_feeds');

/**
 * News feeds model
 *
 * @package     PG_Dating
 * @subpackage  News
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PilotGroup.NET Powered by PG Dating Pro
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class FeedsModel extends \Model
{
    /**
     * Feed properties in data source
     *
     * @var array
     */
    private $fields = [
        'id',
        'link',
        'title',
        'description',
        'site_link',
        'encoding',
        'status',
        'id_lang',
        'max_news',
        'date_add',
    ];

    /**
     * Feeds cache
     *
     * @var array
     */
    private $feeds_cache = [];

    /**
     * Return feed object by identifier
     *
     * @param integer $id feed identifier
     *
     * @return array
     */
    public function getFeedById($id)
    {
        if (!isset($this->feeds_cache[$id])) {
            $result = $this->ci->db->select(implode(", ", $this->fields))
                               ->from(NEWS_FEEDS_TABLE)
                               ->where("id", $id)
                               ->get()
                               ->result_array();
            if (!empty($result)) {
                $data = $result[0];
                $this->feeds_cache[$id] = $data;
            } else {
                $this->feeds_cache[$id] = [];
            }
        }

        return $this->feeds_cache[$id];
    }

    /**
     * Return feeds objects as array
     *
     * @param integer $page              page of results
     * @param integer $items_on_page     items per page
     * @param array   $order_by          sorting data
     * @param array   $params            sql criteria of query to data source
     * @param array   $filter_object_ids filters identifiers
     *
     * @return array
     */
    public function getFeedsList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = null)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(NEWS_FEEDS_TABLE);

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
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields)) {
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
                $data[] = $r;
                $this->feeds_cache[$r["id"]] = $r;
            }

            return $data;
        }

        return [];
    }

    /**
     * Return number of feeds objects in data source
     *
     * @param array $params            sql criteria of query to data source
     * @param array $filter_object_ids filters identifiers
     *
     * @return integer
     */
    public function getFeedsCount($params = [], $filter_object_ids = null)
    {
        $this->ci->db->select("COUNT(*) AS cnt");
        $this->ci->db->from(NEWS_FEEDS_TABLE);

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
     * Save feed object to data source
     *
     * @param integer $id   feed identifier
     * @param array   $data feed data
     *
     * @return integer
     */
    public function saveFeed($id, $data)
    {
        if (empty($id)) {
            $data["date_add"] = date("Y-m-d H:i:s");
            $this->ci->db->insert(NEWS_FEEDS_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(NEWS_FEEDS_TABLE, $data);
            if (isset($this->feeds_cache[$id])) {
                unset($this->feeds_cache[$id]);
            }
        }

        return $id;
    }

    /**
     * Validate feed object for saving to data source
     *
     * @param integer $id   feed identifier
     * @param array   $data feed data
     *
     * @return array
     */
    public function validateFeed($id, $data)
    {
        $return = ["errors" => [], "data" => [], "items" => []];

        if (isset($data["id_lang"])) {
            $return["data"]["id_lang"] = intval($data["id_lang"]);
        }

        if (isset($data["max_news"])) {
            $return["data"]["max_news"] = intval($data["max_news"]);
            if (empty($return["data"]["max_news"])) {
                $return["errors"][] = l('error_feed_max_news_incorrect', 'news');
            }
        }

        if (isset($data["link"])) {
            $return["data"]["link"] = trim(strip_tags($data["link"]));

            if (empty($return["data"]["link"])) {
                $return["errors"][] = l('error_feed_link_incorrect', 'news');
            } else {
                $flag_update_feed = false;

                if (!empty($id)) {
                    $feed_data = $this->getFeedById($id);
                    if ($feed_data["link"] != $return["data"]["link"]) {
                        $flag_update_feed = true;
                    }
                } else {
                    $flag_update_feed = true;
                }

                if ($flag_update_feed) {
                    $feed_content = $this->getFeedContent($return["data"]["link"]);
                    if (!empty($feed_content["errors"])) {
                        foreach ($feed_content["errors"] as $error) {
                            $return["errors"][] = $error;
                        }
                    } else {
                        $return["items"] = $feed_content["items"];
                        $return["data"]["title"] = !empty($feed_content["channel"]["title"]) ? $feed_content["channel"]["title"] : '';
                        $return["data"]["description"] = !empty($feed_content["channel"]["description"]) ? $feed_content["channel"]["description"] : '';
                        $return["data"]["site_link"] = !empty($feed_content["channel"]["permalink"]) ? $feed_content["channel"]["permalink"] : '';
                        $return["data"]["encoding"] = !empty($feed_content["channel"]["encoding"]) ? $feed_content["channel"]["encoding"] : '';
                    }
                }
            }
        }

        return $return;
    }

    /**
     * Remove feed object by identifier
     *
     * @param integer $id_feed feed identifier
     *
     * @return void
     */
    public function deleteFeed($id_feed)
    {
        if (!empty($id_feed)) {
            $this->ci->db->where('id', $id_feed);
            $this->ci->db->delete(NEWS_FEEDS_TABLE);
            if (isset($this->feeds_cache[$id_feed])) {
                unset($this->feeds_cache[$id_feed]);
            }
        }

        return;
    }

    /**
     * Return content provided by feed
     *
     * @param string  $link           feed url
     * @param integer $max_item_count max item from feed
     *
     * @return array
     */
    public function getFeedContent($link, $max_item_count = 5)
    {
        $return = ["errors" => [], "channel" => [], "items" => []];

        $this->ci->load->library('SimplePie_autoloader');
        $this->ci->load->library('SimplePie');

        $this->ci->simplepie->set_feed_url($link);
        // @todo don't forget disable cache before debuging
        $this->ci->simplepie->set_cache_location(SITE_PHYSICAL_PATH . 'temp/cache');
        $this->ci->simplepie->enable_cache(true);
        // force_fsockopen can help read feed in some cases, if false used CURL if exist
        $this->ci->simplepie->force_fsockopen(true);
        $this->ci->simplepie->handle_content_type();
        $this->ci->simplepie->init();

        // throw error if exist
        if ($this->simplepie->error()) {
            $return["errors"][] = l('error_feed_link', 'news');//$this->ci->simplepie->error();
        } else {
            $return["channel"] = [
                "title"        => $this->ci->simplepie->get_title(),
                "author"       => $this->ci->simplepie->get_author(),
                "description"  => $this->ci->simplepie->get_description(),
                "permalink"    => $this->ci->simplepie->get_permalink(),
                "encoding"     => $this->ci->simplepie->get_encoding(),
                "favicon"      => $this->ci->simplepie->get_favicon(),
                "items_cnt"    => $this->ci->simplepie->get_item_quantity(),
                "language"     => $this->ci->simplepie->get_language(),
                "type"         => $this->ci->simplepie->get_type(),
                "image_url"    => $this->ci->simplepie->get_image_url(),
                "image_link"   => $this->ci->simplepie->get_image_link(),
                "image_title"  => $this->ci->simplepie->get_image_title(),
                "image_width"  => $this->ci->simplepie->get_image_width(),
                "image_height" => $this->ci->simplepie->get_image_height(),
            ];

            $items = $this->ci->simplepie->get_items(0, $max_item_count);
            if (!empty($items)) {
                foreach ($items as $key => $rss_item) {
                    $return["items"][] = [
                        "title"       => $rss_item->get_title(),
                        "description" => $rss_item->get_description(),
                        "content"     => $rss_item->get_content(),
                        "date"        => $rss_item->get_date('Y-m-d H:i:s'),
                        "unique_id"   => $rss_item->get_id(true),
                        "link"        => $rss_item->get_link(),
                        "permalink"   => $rss_item->get_permalink(),
                        "image"       => $rss_item->get_enclosure(),
                    ];
                }
            }
        }

        return $return;
    }

    /**
     * Save news data from feed
     *
     * @param integer $id_feed feed identifier
     * @param array   $items   items data
     *
     * @return integer/false
     */
    public function saveFeedNews($id_feed, $items)
    {
        if (empty($items)) {
            return false;
        }

        $feed_data = $this->getFeedById($id_feed);
        $this->ci->load->model(['News_model', 'Uploads_model']);
        $count = 0;
        foreach ($items as $rss_item) {
            $data = [
                'gid' => $rss_item["title"],
                'status' => 1,
                'id_lang' => $feed_data["id_lang"],
                'news_type' => "feed",
                'feed_link' => $rss_item["link"],
                'feed_id'   => $id_feed,
            ];

            foreach ($this->ci->pg_language->languages as $lang_data) {
                $data['name'][$lang_data['id']] = html_entity_decode($rss_item["title"]);
                $data['annotation'][$lang_data['id']] = html_entity_decode($rss_item["description"]);
                $data['content'][$lang_data['id']] = html_entity_decode($rss_item["content"]);
            }

            $validate_data = $this->ci->News_model->validateNews(null, $data);
            if (empty($validate_data["errors"])) {
                $news_id = $this->ci->News_model->saveNews(null, $validate_data["data"]);
                $image = isset($rss_item['image']->{'link'}) ? $rss_item['image']->{'link'} : $rss_item['image']->{'thumbnails'}[0];
                $this->ci->News_model->uploadLogoUrl($news_id, $image);
                ++$count;
            }
        }

        return $count;
    }

    /**
     * Import news objects from feed by cron
     *
     * @return void
     */
    public function cronFeedParser()
    {
        $params["where"]["status"] = 1;
        $feeds = $this->get_feeds_list(null, null, null, $params);
        $return = [];

        foreach ($feeds as $feed) {
            $content = $this->get_feed_content($feed["link"], $feed["max_news"]);
            if (!empty($content["errors"])) {
                $return[] = $feed["title"] . ": " . implode("; ", $content["errors"]);
            } else {
                $saved_news = $this->save_feed_news($feed["id"], $content["items"]);
                if ($saved_news) {
                    $return[] =  $feed["title"] . ": " . str_replace("[count]", $saved_news, l('success_parse_feed', 'news'));
                } else {
                    $return[] =  $feed["title"] . ": " . l('success_no_feed_news', 'news');
                }
            }
        }
        echo implode("<br>", $return);
    }

    public function __call($name, $args)
    {
        $methods = [
            'cron_feed_parser' => 'cronFeedParser',
            'delete_feed' => 'deleteFeed',
            'get_feed_by_id' => 'getFeedById',
            'get_feed_content' => 'getFeedContent',
            'get_feeds_count' => 'getFeedsCount',
            'get_feeds_list' => 'getFeedsList',
            'save_feed' => 'saveFeed',
            'save_feed_news' => 'saveFeedNews',
            'validate_feed' => 'validateFeed',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
