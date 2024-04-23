<?php

declare(strict_types=1);

namespace Pg\modules\media\models;

define('MEDIA_ALBUM_TABLE', DB_PREFIX . 'media_album');
/**
 * Album types model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <mchernov@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: mchernov $
 */
class MediaAlbumModel extends \Model
{
    private $_update_fields = ['status', 'is_adult', 'permissions'];

    public $album_items_limit = 10000; // limit for SQL requests with IN

    public function __construct()
    {
        parent::__construct();
        $this->ci->cache->registerService(MEDIA_ALBUM_TABLE);
    }

    public function getAlbumsByMediaId($ids)
    {
        $ids = is_array($ids) ? $ids : (array) $ids;
        if (!$ids) {
            return [];
        }
        $result = $this->ci->db->select('album_id')->from(MEDIA_ALBUM_TABLE)->where_in("media_id", $ids)->get()->result_array();

        if (empty($result)) {
            return [];
        }

        return $this->format_albums_by_media($result);
    }

    private function formatAlbumsByMedia($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = $value['album_id'];
        }

        return $data;
    }

    public function getMediaIdsInAlbum($album_id)
    {
        $result = $this->ci->cache->get(MEDIA_ALBUM_TABLE, $album_id, function () use ($album_id) {
            $result = $this->ci->db->select('media_id')->from(MEDIA_ALBUM_TABLE)->where("album_id", $album_id)->get()->result_array();

            return $result;
        });

        if (empty($result)) {
            return [];
        }

        return $this->format_media_ids_in_album($result);
    }

    public function formatMediaIdsInAlbum($data)
    {
        $return = [];
        foreach ($data as $key => $value) {
            $return[] = $value['media_id'];
        }

        return $return;
    }

    public function addMediaInAlbum($media_id, $album_id)
    {
        $result = ['status' => 0, 'error' => ''];
        $this->ci->load->model('Media_model');
        $this->ci->load->model('media/models/Albums_model');
        $album = $this->ci->Albums_model->get_album_by_id($album_id);
        if ($album['media_count'] >= $this->album_items_limit) {
            $result['error'] = l('error_album_limit_achieved', 'media');

            return $result;
        }
        $media = $this->ci->Media_model->get_media_by_id($media_id, false);
        if ($media) {
            $data['media_id'] = $media_id;
            $data['album_id'] = $album_id;
            $data['date_add'] = date('Y-m-d H:i:s');
            $data['status'] = $media['status'];
            $data['is_adult'] = $media['is_adult'];
            $data['permissions'] = $media['permissions'];
            $this->ci->db->insert(MEDIA_ALBUM_TABLE, $data);
            $this->ci->Albums_model->update_albums_media_count($album_id);
            $result['status'] = 1;

            return $result;
        }
        $result['error'] = l('error_add_in_ablum', 'media');

        $this->ci->cache->delete(MEDIA_ALBUM_TABLE, $album_id);

        return $result;
    }

    public function deleteMediaFromAlbum($media_id, $album_id)
    {
        $this->ci->db->where("media_id", $media_id);
        $this->ci->db->where("album_id", $album_id);
        $this->ci->db->delete(MEDIA_ALBUM_TABLE);
        $this->ci->load->model('media/models/Albums_model');
        $this->ci->Albums_model->update_albums_media_count($album_id);

        $this->ci->cache->delete(MEDIA_ALBUM_TABLE, $album_id);

        return true;
    }

    public function deleteAlbum($album_id)
    {
        $this->ci->db->where("album_id", $album_id)->delete(MEDIA_ALBUM_TABLE);

        $this->ci->cache->delete(MEDIA_ALBUM_TABLE, $album_id);

        return true;
    }

    public function deleteAlbums($albums_ids)
    {
        $this->ci->db->where_in("album_id", $albums_ids)->delete(MEDIA_ALBUM_TABLE);

        foreach ($albums_ids as $album_id) {
            $this->ci->cache->delete(MEDIA_ALBUM_TABLE, $album_id);
        }

        return true;
    }

    public function getFirstMediaIdInAlbums($album_ids, $params = [])
    {
        $medias = [];
        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            $this->ci->db->where($params["where"]);
        }
        if (isset($params["where_in"]) && is_array($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (isset($params["where_sql"]) && is_array($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }
        $this->ci->db->where_in('album_id', $album_ids)->group_by('album_id');
        $result = $this->ci->db->select('album_id, MAX(media_id) AS media_id')->from(MEDIA_ALBUM_TABLE)->get()->result_array();
        foreach ($result as $row) {
            $medias[$row['album_id']] = $row['media_id'];
        }
        foreach ($album_ids as $aid) {
            if (empty($medias[$aid])) {
                $medias[$aid] = 0;
            }
        }

        return $medias;
    }

    public function deleteMediaFromAllAlbums($media_id, $update_albums_count = true)
    {
        $albums = $this->get_albums_by_media_id($media_id);
        if ($albums) {
            if (is_array($media_id)) {
                $this->ci->db->where_in("media_id", $media_id)->delete(MEDIA_ALBUM_TABLE);
            } else {
                $this->ci->db->where("media_id", $media_id)->delete(MEDIA_ALBUM_TABLE);
            }
            if ($update_albums_count) {
                $this->ci->load->model('media/models/Albums_model');
                $this->ci->Albums_model->update_albums_media_count($albums);
            }

            foreach ($albums as $album_id) {
                $this->ci->cache->delete(MEDIA_ALBUM_TABLE, $album_id);
            }
        }

        return $albums;
    }

    public function getAlbumsMediaCount($albums_ids = [], $params = [])
    {
        $albums_ids = (array) $albums_ids;
        $this->ci->db->select('album_id, COUNT(media_id) AS cnt')->from(MEDIA_ALBUM_TABLE)->group_by('album_id');
        if ($albums_ids) {
            $this->ci->db->where_in('album_id', $albums_ids);
        }
        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            $this->ci->db->where($params["where"]);
        }
        if (isset($params["where_in"]) && is_array($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (isset($params["where_sql"]) && is_array($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value);
            }
        }
        $result = $this->ci->db->get()->result_array();
        $return = [];
        foreach ($result as $row) {
            $return[$row['album_id']] = $row['cnt'];
        }
        foreach ($albums_ids as $aid) {
            if (!isset($return[$aid])) {
                $return[$aid] = 0;
            }
        }

        return $return;
    }

    public function getAlbumMediaCount($album_id)
    {
        $show_adult = $this->ci->session->userdata('show_adult');
        if (!$show_adult) {
            $this->ci->db->where('is_adult', 0);
        }
        $this->ci->db->where('album_id', $album_id);

        return $this->ci->db->count_all_results(MEDIA_ALBUM_TABLE);
    }

    public function updateMediaAlbumItems($data, $media_ids)
    {
        $data = array_intersect_key($data, array_flip($this->_update_fields));
        $media_ids = (array) $media_ids;
        if ($data && $media_ids) {
            $albums_ids = $this->get_albums_by_media_id($media_ids);
            if ($albums_ids) {
                $this->ci->db->where_in('media_id', $media_ids)->update(MEDIA_ALBUM_TABLE, $data);
                $this->ci->load->model('media/models/Albums_model');
                $this->ci->Albums_model->update_albums_media_count($albums_ids);

                foreach ($albums_ids as $album_id) {
                    $this->ci->cache->delete(MEDIA_ALBUM_TABLE, $album_id);
                }

                return $this->ci->db->affected_rows();
            }
        }

        return false;
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_media_in_album' => 'addMediaInAlbum',
            'delete_album' => 'deleteAlbum',
            'delete_albums' => 'deleteAlbums',
            'delete_media_from_album' => 'deleteMediaFromAlbum',
            'delete_media_from_all_albums' => 'deleteMediaFromAllAlbums',
            'format_albums_by_media' => 'formatAlbumsByMedia',
            'format_media_ids_in_album' => 'formatMediaIdsInAlbum',
            'get_album_media_count' => 'getAlbumMediaCount',
            'get_albums_by_media_id' => 'getAlbumsByMediaId',
            'get_albums_media_count' => 'getAlbumsMediaCount',
            'get_first_media_id_in_albums' => 'getFirstMediaIdInAlbums',
            'get_media_ids_in_album' => 'getMediaIdsInAlbum',
            'update_media_album_items' => 'updateMediaAlbumItems',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
