<?php

declare(strict_types=1);

namespace Pg\modules\media\models;

use Pg\libraries\Cache\Manager as CacheManager;

define('ALBUM_TYPES_TABLE', DB_PREFIX . 'album_types');

/**
 * Album types model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Chernov <mchernov@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: mchernov $
 */
class AlbumTypesModel extends \Model
{
    private $fields = [
        'id', 'gid', 'gid_upload_type', 'file_count', 'gid_upload_video', 'video_count',
    ];

    private $types_all = null;

    public function __construct()
    {
        parent::__construct();

        $this->ci->cache->registerService(ALBUM_TYPES_TABLE);
    }

    private function getAllTypes()
    {
        if ($this->types_all == null) {
            $fields = $this->fields;

            $this->types_all = $this->ci->cache->get(ALBUM_TYPES_TABLE, 'all', function () use ($fields) {
                $ci = &get_instance();

                $results = $ci->db->select(implode(", ", $fields))
                    ->from(ALBUM_TYPES_TABLE)
                    ->get()->result_array();

                if (empty($results) || !is_array($results)) {
                    return false;
                }

                return $results;
            });
        }

        return $this->types_all;
    }

    public function saveType($type_id, $data)
    {
        if (is_null($type_id)) {
            $this->ci->db->insert(ALBUM_TYPES_TABLE, $data);
            $type_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $type_id);
            $this->ci->db->update(ALBUM_TYPES_TABLE, $data);
        }

        $this->ci->cache->flush(ALBUM_TYPES_TABLE);

        $this->types_all = null;

        return $type_id;
    }

    public function deleteType($type_id)
    {
        if (!$type_id) {
            return;
        }

        $this->ci->db->where('id', $type_id);
        $this->ci->db->delete(ALBUM_TYPES_TABLE);

        $this->ci->cache->flush(ALBUM_TYPES_TABLE);

        $this->types_all = null;
    }

    public function getTypeIdByGid($gid)
    {
        $album_type = $this->getAlbumTypeByGid($gid);

        if (!$album_type) {
            return false;
        }

        return $album_type['id'];
    }

    public function getAlbumTypeByGid($gid)
    {
        $results = $this->getAllTypes();

        foreach ($results as $result) {
            if ($result['gid'] == $gid) {
                return $result;
            }
        }

        return false;
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_album_type_by_gid' => 'getAlbumTypeByGid',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
