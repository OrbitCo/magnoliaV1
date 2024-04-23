<?php

declare(strict_types=1);

namespace Pg\modules\comments\models;

use Pg\Libraries\Traits\ModuleModel;

if (!defined('TABLE_COMMENTS')) {
    define('TABLE_COMMENTS', DB_PREFIX . 'comments');
}

/**
 * Comments main model
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
class CommentsModel extends \Model
{
    
    use ModuleModel;
    
    private $fields_comments = [
        'id',
        'gid',
        'id_object',
        'id_user',
        'id_owner',
        'user_name',
        'text',
        'likes',
        'date',
        'status'
    ];
    private $fields_comments_str;
    private $moderation_type = "comments";

    /**
     * Controller
     */
    public function __construct()
    {
        parent::__construct();

        $this->fields_comments_str = implode(', ', $this->fields_comments);
    }

    /*
     * COMMENTS FUNCTIONS
     */
    private function getCommentsInternal($params, $limit = null)
    {
        $items_on_page = $this->ci->pg_module->get_module_config('comments', 'items_per_page');
        if (!is_array($params)) {
            return [];
        }

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
        if (isset($params["order_by"])) {
            $this->ci->db->select($this->fields_comments_str)->from(TABLE_COMMENTS)->order_by('id ' . $params["order_by"]);
        } else {
            $this->ci->db->select($this->fields_comments_str)->from(TABLE_COMMENTS)->order_by('id DESC');
        }

        if (is_null($limit)) {
            $this->ci->db->limit($items_on_page);
        } elseif ($limit) {
            if (is_array($limit)) {
                $this->ci->db->limit($limit[0], $limit[1]);
            } else {
                $this->ci->db->limit($limit);
            }
        }
        $result['comments'] = $this->ci->db->get()->result_array();
        $result['max_id']   = $result['min_id']   = 0;
        $user_id            = ($this->ci->session->userdata('auth_type') == 'user') ? $this->ci->session->userdata('user_id') : 0;
        $user_ids           = [];
        $can_edit           = $this->isObjectModuleAuthorCanEdit($result['comments']);
        foreach ($result['comments'] as $key => &$comment) {
            if ($comment['status'] == '0') {
                unset($result['comments'][$key]);
            } else {
                $user_ids[$comment['id_user']] = $comment['id_user'];

                if ($can_edit) {
                    $comment['can_edit'] = $can_edit;
                } else {
                    $comment['can_edit'] = ($user_id && ($user_id == $comment['id_user'] || $user_id == $comment['id_owner'])) ? 1 : 0;
                }

                $comment['is_author'] = ($user_id && $user_id == $comment['id_user']) ? 1 : 0;
                $comment['is_liked']  = $this->ci->input->cookie('comment_like_' . $comment['id']) ? 1 : 0;
                $comment['can_like']  = (!$comment['is_author'] && $user_id) ? 1 : 0;
                if ($result['max_id'] == 0 || $result['max_id'] < $comment['id']) {
                    $result['max_id'] = intval($comment['id']);
                }
                if ($result['min_id'] == 0 || $result['min_id'] > $comment['id']) {
                    $result['min_id'] = intval($comment['id']);
                }
            }
        }

        $result['users'] = $this->getCommentsUsers($user_ids);

        foreach ($result['comments'] as $k => &$comment) {
            if (!empty($result['users'][$comment['id_user']]['is_blocked']) && $result['users'][$comment['id_user']]['is_blocked']) {
                    unset($result['comments'][$k]);
                    continue;
            }
            $comment['user']  = isset($result['users'][$comment['id_user']]) ? $result['users'][$comment['id_user']] : [];
            $comment['fname'] = $result['users'][$comment['id_user']]['fname'];
            $comment['sname'] = $result['users'][$comment['id_user']]['sname'];
        }
        
        $result['count'] = !empty($result['comments']) ? count($result['comments']) : 0;
        if (isset($params['where']['gid']) && isset($params['where']['id_object'])) {
            $result['gid']    = $params['where']['gid'];
            $result['id_obj'] = $params['where']['id_object'];
        } elseif (isset($params['where']['id'])) {
            $result['gid']    = $result['comments'] ? $result['comments'][0]['gid'] : '';
            $result['id_obj'] = $result['comments'] ? $result['comments'][0]['id_object'] : 0;
        } else {
            $result['gid']    = '';
            $result['id_obj'] = 0;
        }
        $result['count_all'] = $this->getCommentsCnt($result['gid'], $result['id_obj']);
        $result['bd_min_id'] = $this->getCommentsMinId($result['gid'], $result['id_obj']);

        return $result;
    }

    public function validateComment($data)
    {
        $return              = ['errors' => [], 'comment' => ''];
        $return["text"]      = trim(strip_tags($data['text']));
        $return["user_name"] = trim(strip_tags($data['user_name']));
        if (empty($return["text"])) {
            $return["errors"][] = l('error_comment_text', 'comments');
        }
        $this->ci->load->model('moderation/models/Moderation_badwords_model');
        $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type,
            $return["text"]);
        $bw_count = $bw_count || $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type,
                $return["user_name"]);
        if ($bw_count) {
            $return["errors"][] = l('error_badwords_message', 'comments');
        }

        return $return;
    }

    public function getCommentsByGidObj($gid, $id_obj, $status = '1', $order_by
                              = 'desc')
    {
        $params['order_by']           = $order_by;
        $params['where']['gid']       = $gid;
        $params['where']['id_object'] = $id_obj;
        if (!is_null($status)) {
            $params['where']['status'] = $status;
        }

        return $this->getCommentsInternal($params);
    }

    public function getCommentsRangeByGidObj($gid, $id_obj, $from_id = 0, $to_id
                              = 0, $include_min_max = false, $limit = 100, $status = '1', $order_by = 'desc')
    {
        $params['order_by']           = $order_by;
        $par                          = $include_min_max ? '=' : '';
        $params['where']['gid']       = $gid;
        $params['where']['id_object'] = $id_obj;
        if (!is_null($status)) {
            $params['where']['status'] = $status;
        }
        if ($from_id) {
            $params['where']["id >$par"] = $from_id;
        }
        if ($to_id) {
            $params['where']["id <$par"] = $to_id;
        }

        return $this->getCommentsInternal($params, $limit);
    }

    public function getCommentsPage($gid, $id_obj, $page = 1)
    {
        $items_on_page                = $this->ci->pg_module->get_module_config('comments',
            'items_per_page');
        $limit[0]                     = $items_on_page;
        $limit[1]                     = ($page - 1) * $items_on_page;
        $params['where']['gid']       = $gid;
        $params['where']['id_object'] = $id_obj;
        $params['where']['status']    = '1';

        return $this->getCommentsInternal($params, $limit);
    }

    public function getCommentById($id, $status = null)
    {
        $params['where']['id'] = $id;
        if (!is_null($status)) {
            $params['where']['status'] = $status;
        }

        return $this->getCommentsInternal($params);
    }

    public function getCommentByUserId($id_user)
    {
        $params['where']['id_user'] = $id_user;

        return $this->getCommentsInternal($params);
    }

    public function getCommentsCnt($gid, $id_obj, $status = '1')
    {
        $where['gid']       = $gid;
        $where['id_object'] = intval($id_obj);
        if (!is_null($status)) {
            $where['status'] = $status;
        }
        $count = intval($this->ci->db->where($where)->from(TABLE_COMMENTS)->count_all_results());

        return $count;
    }

    public function getCommentsMinId($gid, $id_obj, $status = '1')
    {
        $where['gid']       = $gid;
        $where['id_object'] = intval($id_obj);
        if (!is_null($status)) {
            $where['status'] = $status;
        }
        $this->ci->db->where($where)->from(TABLE_COMMENTS)->select_min('id');
        $min_id = intval($this->ci->db->get()->row()->id);

        return $min_id;
    }

    public function addComment($gid, $id_obj, $text, $user_name = '', $id_owner = 0)
    {
        $data['gid']       = $gid;
        $data['id_object'] = intval($id_obj);
        $data['text']      = $text;
        $data['user_name'] = $user_name;
        $data['id_user']   = ($this->ci->session->userdata('auth_type') == 'user') ? $this->ci->session->userdata('user_id') : 0;
        $data['id_owner']  = intval($id_owner);
        $data['date']      = date('Y-m-d H:i:s');

        $this->ci->load->model('Moderation_model');
        $data['status'] = $this->ci->Moderation_model->get_moderation_type_status($this->moderation_type) ? '1' : '0';
        $mtype          = $this->ci->Moderation_model->get_moderation_type($this->moderation_type);

        $this->ci->db->insert(TABLE_COMMENTS, $data);
        $id = $this->ci->db->insert_id();
        if ($mtype['mtype'] > 0) {
            $this->ci->Moderation_model->add_moderation_item($this->moderation_type,
                $id);

            $this->ci->load->model('menu/models/Indicators_model');
            $this->ci->Indicators_model->add('new_moderation_item', $id);
        }

        $this->countCallback($data['gid'], $data['id_object']);

        return $id;
    }

    private function countCallback($gid, $id_obj = 0)
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $comments_type = $this->ci->Comments_types_model->getCommentsTypeByGid($gid);
        $module = $comments_type['module'];
        $model = $comments_type['model'];
        $method = $comments_type['method_count'];

        if (!$this->ci->pg_module->is_module_installed($module)) {
            return;
        }

        $this->ci->load->model($module . '/models/' . $model, '', false, true, true);

        if (!method_exists($this->ci->$model, $method)) {
            $chunks = explode('_', $method);
            $method = array_shift($chunks);
            foreach ($chunks as $chunk) {
                $method .= ucfirst($chunk);
            }

            if (!method_exists($this->ci->$model, $method)) {
                return;
            }
        }

        $count = $id_obj ? $this->getCommentsCnt($gid, $id_obj) : 0;
        $this->ci->$model->$method($count, $id_obj);
    }

    private function objectCallback($gid, $id_obj = 0)
    {
        $this->ci->load->model('comments/models/Comments_types_model');
        $comments_type = $this->ci->Comments_types_model->get_comments_type_by_gid($gid);
        $module        = $comments_type['module'];
        $model         = $comments_type['model'];
        $method        = $comments_type['method_object'];

        if (!$this->ci->pg_module->is_module_installed($module)) {
            return [];
        }

        $this->ci->load->model($module . '/models/' . $model, '', false, true, true);

        if (!method_exists($this->ci->$model, $method)) {
            $chunks = explode('_', $method);
            $method = array_shift($chunks);
            foreach ($chunks as $chunk) {
                $method .= ucfirst($chunk);
            }

            if (!method_exists($this->ci->$model, $method)) {
                return [];
            }
        }

        $return = $this->ci->$model->$method($id_obj);
        if (empty($return)) {
            $return["body"]   = "<span class='spam_object_delete'>" . l("error_is_deleted_" . $gid . "_object", "spam") . "</span>";
            $return["author"] = l("author_unknown", "spam");
        }

        return $return;
    }

    public function saveComment($id, $params = [])
    {
        $this->ci->db->where('id', $id)->update(TABLE_COMMENTS, $params);
        $comment = $this->get_comment_by_id($id);
        if (!empty($comment['comments'][0])) {
            $this->countCallback($comment['comments'][0]['gid'],
                $comment['comments'][0]['id_object']);
        }

        return $this->ci->db->affected_rows();
    }

    public function deleteCommentById($id)
    {
        $is_deleted = 0;
        $comment    = $this->get_comment_by_id($id);
        if (!empty($comment['comments'][0])) {
            $this->ci->db->where('id', $id)->delete(TABLE_COMMENTS);
            $is_deleted = $this->ci->db->affected_rows();
            $this->ci->load->model('Moderation_model');
            $this->ci->Moderation_model->delete_moderation_item_by_obj($this->moderation_type, $id);
            $this->ci->load->model('menu/models/Indicators_model');
            $this->ci->Indicators_model->delete('new_moderation_item', $id, true);
            $this->countCallback($comment['comments'][0]['gid'],
                $comment['comments'][0]['id_object']);
        }

        return $is_deleted;
    }

    public function deleteCommentsByGid($gid)
    {
        $this->ci->db->where('gid', $gid)->delete(TABLE_COMMENTS);
        $is_deleted = $this->ci->db->affected_rows();
        $this->countCallback($gid, 0);
        
        return $is_deleted;
    }

    public function deleteCommentsByGidObj($gid, $id_obj)
    {
        $this->ci->db->where('gid', $gid)->where('id_object', $id_obj)->delete(TABLE_COMMENTS);
        $is_deleted = $this->ci->db->affected_rows();
        $this->countCallback($gid, $id_obj);

        return $is_deleted;
    }

    private function getCommentsUsers($user_ids)
    {
        if (empty($user_ids) || !is_array($user_ids)) {
            return [];
        }
        $comments_users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $user_ids, true);
        if (is_array($comments_users)) {
            foreach ($comments_users as $k => $comments_user) {
                // DPC-6670
                $user_logo = null;

                if (!$user_logo && !empty($comments_user['media']['user_logo'])) {
                    if (file_exists($comments_user['media']['user_logo']['file_path'])
                        && file_exists($comments_user['media']['user_logo']['path'] . 'small-' . $comments_user['media']['user_logo']['file_name'])) {
                        $user_logo = $comments_user['media']['user_logo']['thumbs']['small'];
                    }
                }

                if (!$user_logo && !empty($comments_user['media']['user_logo_moderation'])) {
                    if (file_exists($comments_user['media']['user_logo_moderation']['file_path'])
                        && file_exists($comments_user['media']['user_logo_moderation']['path'] . 'small-' . $comments_user['media']['user_logo_moderation']['file_name'])) {
                        $user_logo = $comments_user['media']['user_logo_moderation']['thumbs']['small'];
                    }
                }

                if (!$user_logo && !empty($comments_user['media']['user_logo_postmoderation'])) {
                    if (file_exists($comments_user['media']['user_logo_postmoderation']['file_path'])
                        && file_exists($comments_user['media']['user_logo_postmoderation']['path'] . 'small-' . $comments_user['media']['user_logo_postmoderation']['file_name'])) {
                        $user_logo = $comments_user['media']['user_logo_postmoderation']['thumbs']['small'];
                    }
                }
                $user_ids[$comments_user['id']] = [
                    'id' => $comments_user['id'],
                    'output_name' => $comments_user['output_name'],
                    'nickname' => $comments_user['nickname'],
                    'fname' => $comments_user['fname'],
                    'sname' => $comments_user['sname'],
                    'user_logo' =>  $user_logo, //$comments_user['media']['user_logo']['thumbs']['small'],
                    'is_blocked' => !empty($comments_user['is_blocked']) ? 1 : 0,
                    'is_guest' => !empty($comments_user['is_guest']) ? 1 : 0,
                    'is_deleted' => !empty($comments_user['is_deleted']) ? 1 : 0
                ];
            }
        }
        return $user_ids;
    }

    public function likeComment($id, $sign = '+', $count = 1)
    {
        $this->ci->db->where('id', $id)->set('likes',
            "IF(likes {$sign} {$count} < 0, 0, likes {$sign} {$count})",
            false)->update(TABLE_COMMENTS);
        $this->ci->db->where('id', $id)->from(TABLE_COMMENTS);
        $likes = intval($this->ci->db->get()->row()->likes);

        return $likes;
    }

    ///// moderation functions
    public function moderGetList($object_ids)
    {
     
        $comments = $this->getComments(null, null, [], [
            'where_in' => ['id' => $object_ids],
        ], null);
       
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                $return[$comment["id"]] = $comment;
            }
            return $return;
        } else {
            return [];
        }
    }

    public function moderSetStatus($object_id, $status)
    {
        $this->saveComment($object_id, ['status' => "$status"]);
    }

    public function moderDeleteObject($object_id)
    {
        $this->deleteCommentById($object_id);
    }

    /**
     * Get objects list
     * banners - default return all object
     *
     * @return array
     */
    public function getComments($page = 1, $items_on_page = 20, $order_by = null, $params
                              = [], $filter_object_ids = null, $is_format = true)
    {
        $this->ci->db->select(implode(", ", $this->fields_comments));
        $this->ci->db->from(TABLE_COMMENTS);

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

        if (isset($params['limit']['count'])) {
            if (isset($params['limit']['from'])) {
                $this->ci->db->limit($params['limit']['count'],
                    $params['limit']['from']);
            } else {
                $this->ci->db->limit($params['limit']['count']);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $filter_object_ids = array_slice($filter_object_ids, 0, 5000);
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                if (in_array($field, $this->fields_comments)) {
                    $this->ci->db->order_by($field . " " . $dir);
                }
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }
        $result = $this->ci->db->get()->result_array();

        foreach ($result as &$event) {
            if (isset($event['data'])) {
                $event['data'] = unserialize($event['data']);
            }
        }
        /* DPC-4996 */
        if ($is_format) {
            return $this->formatComments($result);
        } else {
            return $result;
        }
        /* /DPC-4996 */
    }

    public function formatComments($comments)
    {
        if (empty($comments)) {
            return [];
        }
        
        $this->ci->load->model('Users_model');
        
        $users = [
            0 => $this->ci->Users_model->formatDefaultUser(1),
        ];
 
        $users_ids = array_map(function ($v) {
            if ($v['id_user']) {
                return $v['id_user'];
            }
        }, $comments);
        
        $users_ids = array_filter($users_ids);

        $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], array_unique($users_ids), true);

        $this->ci->load->model('Media_model');
        $this->ci->load->model('Wall_events_model');
          
        foreach ($comments as $key => $e) {
            /* DPC-4996 */
            $formatted_events[$key] = $comments[$key];

            if ($e['id_user']) {
                foreach ($users as $user_key => $user_value) {
                    if ($e['id_user'] == $user_value['id']) {
                        $formatted_events[$key]['user_info'] = $user_value;
                    }
                }
            }

            if ($e['gid'] == 'media') {
                if ($e['id_object']) {
                    $obj = $this->ci->Media_model->getMediaById($e['id_object']);
                    $formatted_events[$key]['receiver'] = $this->ci->Users_model->getUserById($obj['id_user']);
                }
            }

            if ($e['gid'] == 'wall_events') {
                if ($e['id_object']) {
                    $obj = $this->ci->Wall_events_model->getEventById($e['id_object']);
                    $formatted_events[$key]['receiver'] = $this->ci->Users_model->getUserById($obj['id_wall']);
                }
            }

            if ($e['gid'] == 'user_avatar') {
                if ($e['id_object']) {
                    $formatted_events[$key]['receiver'] = $this->ci->Users_model->getUserById($e['id_object']);
                }
            }
            
            /* /DPC-4996 */
            /*
            if (isset($users[$e['id_user']])) {
                $formatted_events[$key]['user_info'] = $users[$e['id_user']];
            } else {
                $formatted_events[$key]['user_info'] = $users[0];
            }
            */
        }

        return $formatted_events;
    }

    public function getCommentsByKey($page = 1, $items_on_page = 20, $order_by
                              = null, $params = [], $filter_object_ids = null, $format_items = true, $format_owner
                              = false, $format_user = false, $safe_format = false)
    {
        $media        = $this->get_comments($page,
            $items_on_page,
            $order_by,
            $params,
            $filter_object_ids,
            $format_items,
            $format_owner,
            $format_user,
            $safe_format);
        $media_by_key = [];
        foreach ($media as $m) {
            $media_by_key[$m['id']] = $m;
        }

        return $media_by_key;
    }
    /*
     * Work like get_media method, but return number of objects
     * necessary for pagination
     * banners - default return all object
     */

    public function getCommentsCount($params = [], $filter_object_ids = null)
    {
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

        if (isset($params['limit']['count'])) {
            if (isset($params['limit']['from'])) {
                $this->ci->db->limit($params['limit']['count'],
                    $params['limit']['from']);
            } else {
                $this->ci->db->limit($params['limit']['count']);
            }

            return count($this->ci->db->select('*')->from(TABLE_COMMENTS)->get()->result_array());
        } else {
            return $this->ci->db->count_all_results(TABLE_COMMENTS);
        }
    }

    /**
     * Callback for spam module
     *
     * @param string  $action   action name
     * @param integer $user_ids user identifiers
     *
     * @return string
     */
    public function spamCallback($action, $data)
    {
        switch ($action) {
            case "delete":
                $this->delete_comment_by_id((int) $data);

                return "removed";
                break;
            case 'get_content':
                if (empty($data)) {
                    return [];
                }
                $new_data = [];
                $return   = [];
                foreach ($data as $id) {
                    if (($this->get_comments_count(['where_in' => ['id' => $id]])) == 0) {
                        $return[$id]["content"]["view"] = $return[$id]["content"]["list"]
                            = "<span class='spam_object_delete'>" . l("error_is_deleted_comments_object",
                                "spam") . "</span>";
                        $return[$id]["user_content"]    = l("author_unknown",
                            "spam");
                    } else {
                        $new_data[] = $id;
                    }
                }
                $events = $this->get_comments(null,
                    null,
                    null,
                    null,
                    (array) $new_data,
                    true,
                    false,
                    true);
                foreach ($events as $event) {
                    $return[$event['id']]["content"]["view"] = $return[$event['id']]["content"]["list"]
                        = $event['text'];
                    if ($event['user_name'] == '') {
                        $return[$event['id']]["user_content"] = $event['user_info']['output_name'];
                    } else {
                        $return[$event['id']]["user_content"] = $event['user_name'] . ' (' . l("guest",
                                "comments") . ')';
                    }
                }

                return $return;
                break;
            case 'get_subpost':
                if (($this->get_comments_count(['where_in' => ['id' => $data]])) == 0) {
                    return [];
                }
                $events = $this->get_comments(null,
                    null,
                    null,
                    null,
                    (array) $data);
                $return = [];
                foreach ($events as $event) {
                    $return[$event['id']] = $this->objectCallback($event['gid'],
                        $event['id_object']);
                }

                return $return;
                break;
            case 'get_link':
                return [];
                break;
            case 'get_deletelink':
                if (($this->get_comments_count(['where_in' => ['id' => $data]])) == 0) {
                    return [];
                }
                $events = $this->get_comments(null,
                    null,
                    null,
                    null,
                    (array) $data);
                $return = [];
                foreach ($events as $event) {
                    $return[$event['id']] = site_url() . 'admin/spam/delete_content/';
                }

                return $return;
                break;
            case 'get_object':
                if (($this->get_comments_count(['where_in' => ['id' => $data]])) == 0) {
                    return [];
                }
                $medias = $this->get_comments_by_key(null,
                    null,
                    null,
                    null,
                    (array) $data);

                return $medias;
                break;
        }
    }
    
    /**
     * Coments by users ids
     * @param array $users_ids
     * @return mixed
     */
    private function getCommentByUserIds(array $users_ids)
    {
        return $this->getComments(null, null, null, [
            'where_in' => ['id_user' => $users_ids],
        ], null, false);
    }

    /**
     * Callback User BLocked
     * @param array $users_ids
     * @param string $is_blocked
     * @return void
     */
    public function callbackUserBLocked(array $users_ids, string $is_blocked)
    {
        $this->ci->db->where_in('id_user', $users_ids)
            ->update(TABLE_COMMENTS, ['status' => $is_blocked]);
        $comments = $this->getCommentByUserIds($users_ids);
        foreach ($comments as $comment) {
            $this->countCallback($comment['gid'], $comment['id_object']);
        }
    }
    
    public function callbackUserDelete($id_user)
    {
        $this->delete_messages_by_user_id($id_user);
    }

    private function deleteMessagesByUserId($id_user)
    {
        $is_deleted = 0;
        $comment    = $this->get_comment_by_user_id($id_user);
        if (!empty($comment['comments'][0])) {
            $this->ci->db->where('id_user', $id_user)->delete(TABLE_COMMENTS);
            $is_deleted = $this->ci->db->affected_rows();
            $this->ci->load->model('menu/models/Indicators_model');
            foreach ($comment['comments'] as $k => $val) {
                $this->ci->Indicators_model->delete('new_moderation_item', $val['id'], true);
                $this->countCallback($comment['comments'][$k]['gid'],
                    $comment['comments'][$k]['id_object']);
            }
        }

        return $is_deleted;
    }

    private function isObjectModuleAuthorCanEdit($comments_data = [])
    {
        $is_owner = false;

        if (!empty($comments_data)) {
            $this->ci->load->model('comments/models/Comments_types_model');
            $comments_type = $this->ci->Comments_types_model->get_comments_type_by_gid($comments_data[0]['gid']);

            if (isset($comments_type['settings']['comments_author_can_edit'],
                    $comments_type['settings']['comments_get_object_author_method']) && $comments_type['settings']['comments_author_can_edit']) {
                $this->ci->load->model($comments_type['module'] . '/models/' . $comments_type['model']);
                $is_owner = $this->ci->{$comments_type['model']}->{$comments_type['settings']['comments_get_object_author_method']}($comments_data[0]['id_object']);
            }
        }

        return $is_owner;
    }

    public function getDashboardOptions($id_object)
    {
        $object = $this->get_comment_by_id($id_object)['comments'][0];
        return [
            'dashboard_header' => 'header_moderation_object',
            'dashboard_action_link' => 'admin/moderation',
            'comment' => $object['text'],
            'fname' => $object['fname'],
            'sname' => $object['sname'],
        ];
    }

    public function getModerationIdsByUserId($user_id)
    {

        $data = $this->ci->db->select('id')
                                ->from(TABLE_COMMENTS)
                                ->where('status', '0')
                                ->where('id_user', $user_id)
                                ->get()->result_array();
        $result = [];
        if (!empty($data)) {
            foreach ($data as $value) {
                $result[] = $value['id'];
            }
        }
        return $result;
    }

    public function __call($name, $args)
    {
        $methods = [
            '_moder_delete_object' => 'moderDeleteObject',
            '_moder_get_list' => 'moderGetList',
            '_moder_set_status' => 'moderSetStatus',
            'add_comment' => 'addComment',
            'callback_user_delete' => 'callbackUserDelete',
            'delete_comment_by_id' => 'deleteCommentById',
            'delete_comments_by_gid' => 'deleteCommentsByGid',
            'delete_comments_by_gid_obj' => 'deleteCommentsByGidObj',
            'delete_messages_by_user_id' => 'deleteMessagesByUserId',
            'format_comments' => 'formatComments',
            'get_comment_by_id' => 'getCommentById',
            'get_comment_by_user_id' => 'getCommentByUserId',
            'get_comments' => 'getComments',
            'get_comments_by_gid_obj' => 'getCommentsByGidObj',
            'get_comments_by_key' => 'getCommentsByKey',
            'get_comments_cnt' => 'getCommentsCnt',
            'like_comment' => 'likeComment',
            'save_comment' => 'saveComment',
            'spam_callback' => 'spamCallback',
            'validate_comment' => 'validateComment',
            'get_comments_count' => 'getCommentsCount',
            'get_comments_min_id' => 'getCommentsMinId',
            'get_comments_page' => 'getCommentsPage',
            'get_comments_range_by_gid_obj' => 'getCommentsRangeByGidObj',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
