<?php

declare(strict_types=1);

namespace Pg\modules\comments\models;

if (!defined('TABLE_COMMENTS_TYPES')) {
    define('TABLE_COMMENTS_TYPES', DB_PREFIX . 'comments_types');
}

/**
 * Comments types model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:07:07 +0400 $
 */
class CommentsTypesModel extends \Model
{
    private $fields_types = [
        'id',
        'gid',
        'status',
        'module',
        'model',
        'method_count',
        'method_object',
        'settings',
    ];

    private $fields_types_str;

    private $default_types_params = [
        'use_likes'        => 1,
        'guest_access'     => 0,
        'char_count'       => 1000,
    ];

    private $cached_types_by_gid = [];
    private $cached_types_by_id = [];

    /**
     * Controller
     */
    public function __construct()
    {
        parent::__construct();

        $this->fields_types_str = implode(', ', $this->fields_types);
    }

    /*
     * COMMENTS TYPES FUNCTIONS
     */

    public function addCommentsType($params, $status = '1')
    {
        $comments_types = $this->get_comments_type_by_gid($params['gid']);
        if (!empty($comments_types['gid'])) {
            return false;
        }
        $params['status'] = $status;
        $this->setPreparedTypesParams($params);
        $this->ci->db->insert(TABLE_COMMENTS_TYPES, $params);

        return $this->ci->db->affected_rows();
    }

    public function deleteCommentsType($gid)
    {
        $this->ci->load->model('Comments_model');
        $this->ci->Comments_model->delete_comments_by_gid($gid);
        $this->ci->db->where('gid', $gid)->delete(TABLE_COMMENTS_TYPES);

        return $this->ci->db->affected_rows();
    }

    public function getCommentsTypeByGid($gid)
    {
        if (empty($this->cached_types_by_gid[$gid])) {
            $this->setCommentsTypesCache();
        }
        if (empty($this->cached_types_by_gid[$gid])) {
            return [];
        } else {
            return $this->cached_types_by_gid[$gid];
        }
    }

    public function getCommentsTypeById($id)
    {
        if (empty($this->cached_types_by_id[$id])) {
            $this->setCommentsTypesCache();
        }
        if (empty($this->cached_types_by_id[$id])) {
            return [];
        } else {
            return $this->cached_types_by_id[$id];
        }
    }

    public function getCommentsTypes($page = 1, $items_on_page = 20)
    {
        if (empty($this->cached_types_by_id)) {
            $this->setCommentsTypesCache();
        }
        if ($page && $items_on_page) {
            $page = intval($page);
            if ($page <= 0) {
                $page = 1;
            }
            $result = array_slice($this->cached_types_by_id, $page - 1, $items_on_page);
        } else {
            $result = $this->cached_types_by_id;
        }

        return $result;
    }

    private function setCommentsTypesCache()
    {
        $this->ci->db->select($this->fields_types_str)->from(TABLE_COMMENTS_TYPES);
        $result = $this->ci->db->get()->result_array();
        $this->cached_types_by_id = $this->cached_types_by_gid = [];
        foreach ($result as $type) {
            $this->getPreparedTypesParams($type);
            $this->cached_types_by_gid[$type['gid']] = $this->cached_types_by_id[$type['id']] = $type;
        }

        return $result;
    }

    /*public function setCommentsTypesCache($params = array(), $page = 1, $items_on_page = 20){
        $this->ci->db->select($this->fields_types_str)->from(TABLE_COMMENTS_TYPES);
        if($params){
            $this->ci->db->where($params);
        }
        if(isset($params['gid']) || isset($params['id'])){
            $result = $this->ci->db->get()->row_array();
            if(!empty($result)){
                $this->getPreparedTypesParams($result);
            }
            return $result;
        }else{
            if($page && $items_on_page){
                $this->ci->db->limit($items_on_page, $items_on_page*($page-1));
            }
            $result = $this->ci->db->get()->result_array();
            $result_format = array();
            foreach($result as $key => $type){
                $result_format[$type['gid']] = $type;
                $this->getPreparedTypesParams($result_format[$type['gid']]);
            }
            return $result_format;
        }
    }*/

    public function getCommentsTypesCnt()
    {
        $count = $this->ci->db->count_all(TABLE_COMMENTS_TYPES);

        return $count;
    }

    public function saveCommentsType($id, $params = [])
    {
        $this->setPreparedTypesParams($params, $id);
        $this->ci->db->where('id', $id);
        $this->ci->db->update(TABLE_COMMENTS_TYPES, $params);

        return $this->ci->db->affected_rows();
    }

    private function setPreparedTypesParams(&$params, $id = 0)
    {
        if (!isset($params['settings']) || !is_array($params['settings'])) {
            $params['settings'] = [];
        }
        if ($id) {
            $comments_type = $this->get_comments_type_by_id($id);
            $params['settings'] = array_merge($comments_type['settings'], $params['settings']);
        }
        foreach ($this->default_types_params as $key => $value) {
            if (!isset($params['settings'][$key])) {
                $params['settings'][$key] = $value;
            }
            if ($params['settings'][$key] === false) {
                $params['settings'][$key] = 0;
            }
        }
        $params['settings'] = serialize($params['settings']);
        foreach ($params as $param => $value) {
            if (!in_array($param, $this->fields_types)) {
                unset($params[$param]);
            }
        }
    }

    private function getPreparedTypesParams(&$params)
    {
        if ($params) {
            $settings = unserialize($params['settings']);
            if (!is_array($settings)) {
                $settings = [];
            }
            $params['settings'] = array_merge($this->default_types_params, $settings);
        }
    }

    public function updateLangs($ctypes, $langs_file)
    {
        foreach ($ctypes as $ctype) {
            $this->ci->pg_language->pages->set_string_langs('comments', 'ctype_' . $ctype, $langs_file['ctype_' . $ctype], array_keys($langs_file['ctype_' . $ctype]));
        }
    }

    public function exportLangs($ctypes, $langs_ids)
    {
        $gids = [];
        foreach ($ctypes as $ctype) {
            $gids[] = 'ctype_' . $ctype;
        }

        return $this->ci->pg_language->export_langs('comments', $gids, $langs_ids);
    }

    public function validate($id, $data)
    {
        $return = ['errors' => [], 'data' => []];

        if ($id) {
            $comments_type = $this->get_comments_type_by_id($id);
        } else {
            $comments_type['settings'] = [];
        }

        if (isset($data['status'])) {
            $return['data']['status'] = $data['status'] ? '1' : '0';
        }

        if (isset($data['settings'])) {
            $return['data']['settings'] = $comments_type['settings'];

            if (isset($data['settings']['use_likes'])) {
                $return['data']['settings']['use_likes'] = $data['settings']['use_likes'] ? 1 : 0;
            }

            if (isset($data['settings']['use_spam'])) {
                $return['data']['settings']['use_spam'] = $data['settings']['use_spam'] ? 1 : 0;
            }

            if (isset($data['settings']['use_moderation'])) {
                $return['data']['settings']['use_moderation'] = $data['settings']['use_moderation'] ? 1 : 0;
            }

            if (isset($data['settings']['guest_access'])) {
                $return['data']['settings']['guest_access'] = $data['settings']['guest_access'] ? 1 : 0;
            }

            if (isset($data['settings']['char_count'])) {
                $return['data']['settings']['char_count'] = intval($data['settings']['char_count']);
                if ($return['data']['settings']['char_count'] < 1) {
                    $return['errors'][] = l('error_char_count', 'comments');
                }
            }
        }

        return $return;
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_comments_type' => 'addCommentsType',
            'delete_comments_type' => 'deleteCommentsType',
            'export_langs' => 'exportLangs',
            'get_comments_type_by_gid' => 'getCommentsTypeByGid',
            'get_comments_type_by_id' => 'getCommentsTypeById',
            'get_comments_types' => 'getCommentsTypes',
            'get_comments_types_cnt' => 'getCommentsTypesCnt',
            'set_comments_types_cache' => 'setCommentsTypesCache',
            'save_comments_type' => 'saveCommentsType',
            'update_langs' => 'updateLangs',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
