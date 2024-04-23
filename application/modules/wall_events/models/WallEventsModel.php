<?php

declare(strict_types=1);

namespace Pg\modules\wall_events\models;

if (!defined('TABLE_WALL_EVENTS')) {
    define('TABLE_WALL_EVENTS', DB_PREFIX . 'wall_events');
}

/**
 * Wall events model
 *
 * @package PG_Dating
 * @subpackage application
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class WallEventsModel extends \Model
{
    public const PERM_PRIVATE = 0;
    public const PERM_FRIENDS = 1;
    public const PERM_REGISTERED = 2;
    public const PERM_ALL = 3;
    public const DB_DATE_FORMAT = 'Y-m-d H:i:s';

    private $fields = [
        'id',
        'event_type_gid',
        'id_wall',
        'id_poster',
        'id_object',
        'date_add',
        'date_update',
        'data',
        'permissions',
        'status',
        'comments_count'
    ];
    private $fields_str;
    private $max_event_data_count = 50;
    public $wall_event_gid = 'wall_post';
    public $event_type = false;
    public $image_upload_gid = 'wall-image';
    public $video_upload_gid = 'wall-video';
    public $audio_upload_gid = 'wall-audio';
    private $upload_config;
    private $moderation_type = "wall_events";
    public function __construct()
    {
        parent::__construct();

        $this->fields_str = implode(', ', $this->fields);
        $this->ci->load->model(['video_uploads/models/Video_uploads_config_model', 'uploads/models/Uploads_config_model']);
        $upload_config = $this->ci->Uploads_config_model->getConfigByGid($this->image_upload_gid);
        $this->upload_config[$this->image_upload_gid] = $this->ci->Uploads_config_model
            ->formatConfig($upload_config);
        $this->upload_config[$this->video_upload_gid] = $this->ci->Video_uploads_config_model
            ->getConfigByGid($this->video_upload_gid);

        if ($this->ci->pg_module->is_module_installed('audio_uploads')) {
            $this->ci->load->model('audio_uploads/models/Audio_uploads_config_model');
            $this->upload_config[$this->audio_upload_gid] = $this->ci->Audio_uploads_config_model
                ->getConfigByGid($this->audio_upload_gid);
        }
        $this->ci->cache->registerService(TABLE_WALL_EVENTS);
    }

    public function initializeEventType($gid)
    {
        $this->ci->load->model('wall_events/models/Wall_events_types_model');
        $this->event_type = $this->ci->Wall_events_types_model->getWallEventsType($gid);
    }

    public function addEvent($event_type_gid, $id_wall, $id_poster, $data, $permissions = 3, $id_object = 0, $file_name = '')
    {
        if (!$this->event_type) {
            $this->initializeEventType($event_type_gid);
            if (!$this->event_type) {
                return false;
            }
        }
        $date = date(self::DB_DATE_FORMAT);
        $data['event_date'] = $date;
        $attrs = [
            'event_type_gid' => $event_type_gid,
            'id_wall' => $id_wall,
            'data' => [$data],
            'permissions' => $permissions,
            'id_poster' => $id_poster,
            'id_object' => $id_object,
            'date_update' => $date,
        ];
        $joined_event = $this->getJoinedEvent($event_type_gid, $id_wall, $id_poster);
        if ($joined_event) {
            $do_join = true;
            foreach ($joined_event['data'] as $join_data) {
                if (!empty($join_data['videos'])) {
                    foreach ($join_data['videos'] as $jd_video) {
                        if ($jd_video['status'] != 'end' && empty($jd_video['errors'])) {
                            $do_join = false;

                            break 2;
                        }
                    }
                }
                if (!empty($join_data['audios'])) {
                    foreach ($join_data['audios'] as $jd_audio) {
                        if ($jd_audio['status'] != 'end' && empty($jd_audio['errors'])) {
                            $do_join = false;

                            break 2;
                        }
                    }
                }
            }
            if ($do_join) {
                foreach ($joined_event['data'] as $join_data) {
                    $attrs['data'][] = $join_data;
                }
            } else {
                $joined_event = false;
            }
        }
        if (!$joined_event) {
            $attrs['date_add'] = $date;
        } else {
            $attrs['date_add'] = $joined_event['date_add'];
        }
        $id = $this->save_event($attrs, []);

        if ($id && $joined_event) {
            $where['id'] = $joined_event['id'];
            $this->delete_events($where, false);
        } else {
            $this->clearEvents($id_wall);
        }

        if (!empty($file_name) && !empty($id) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
            $return = $this->add_event_data($id, [], $file_name);
        }
        if ($joined_event) {
            $return['joined_id'] = intval($joined_event['id']);
        }
        $return['id'] = $id;
        $this->ci->cache->flush(TABLE_WALL_EVENTS);

        return $return;
    }

    private function saveEvent($attrs, $where = [])
    {
        if (!empty($attrs['data']) && is_array($attrs['data'])) {
            $attrs['data'] = serialize($attrs['data']);
        }
        if (!empty($where) && is_array($where)) {
            $this->ci->db->where($where)->update(TABLE_WALL_EVENTS, $attrs);

            return $this->ci->db->affected_rows();
        }
        $this->ci->db->insert(TABLE_WALL_EVENTS, $attrs);
        $return = $this->ci->db->insert_id();

        return $return;

        $this->ci->cache->flush(TABLE_WALL_EVENTS);
    }

    public function addEventData($id, $data, $file_name)
    {
        $result['errors'] = [];
        $event = $this->get_event_by_id($id);
        if ($event) {
            $data_count = 0;
            foreach ($event['data'] as $e_data) {
                if (!empty($e_data['images'])) {
                    $data_count += count($e_data['images']);
                }
                if (!empty($e_data['videos'])) {
                    $data_count += count($e_data['videos']);
                }
                if (!empty($e_data['audios'])) {
                    $data_count += count($e_data['audios']);
                }
            }
            if ($data_count >= $this->max_event_data_count) {
                $result['id'] = $id;
                $result['errors'][] = l('error_files_limit', 'wall_events');

                return $result;
            }

            if (!empty($file_name) && isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && is_uploaded_file($_FILES[$file_name]["tmp_name"])) {
                $upload_gid = $this->getUploadGid($_FILES[$file_name]['name']);
                if ($upload_gid == $this->image_upload_gid) {
                    $this->ci->load->model('Uploads_model');
                    $upload_return = $this->ci->Uploads_model->upload($this->image_upload_gid, $id, $file_name);
                    if (empty($upload_return['errors'])) {
                        $data[0]['images'][] = [
                            'file' => $upload_return['file'],
                            'id' => $id,
                        ];
                        $result['name'] = $upload_return['file'];
                    } else {
                        $result['errors'][] = $upload_return["errors"];
                    }
                    $event['data'][0] = array_merge_recursive((array) $data[0], (array) $event['data'][0]);
                    $result['is_saved'] = $this->save_event($event, ['id' => $id]);
                } elseif ($upload_gid == $this->video_upload_gid) {
                    $this->ci->load->model('Video_uploads_model');
                    usleep(2);
                    $video_data['key'] = substr(md5(microtime()), 0, 10);
                    $event['data'][0]['videos'][$video_data['key']]['status'] = 'start';
                    $this->save_event($event, ['id' => $id]);

                    $upload_return = $this->ci->Video_uploads_model->upload($this->video_upload_gid, $id, $file_name, $id, $video_data);
                    $event = $this->get_event_by_id($id);
                    if (empty($upload_return['errors'])) {
                        $result['name'] = $upload_return['file'];
                        $event['data'][0]['videos'][$video_data['key']]['file'] = $upload_return['file'];
                    } else {
                        $result['errors'][] = $upload_return['errors'];
                        $event['data'][0]['videos'][$video_data['key']]['errors'] = $upload_return['errors'];
                    }
                    $result['is_saved'] = $this->save_event($event, ['id' => $id]);
                } elseif ($this->ci->pg_module->is_module_installed('audio_uploads') && $upload_gid == $this->audio_upload_gid) {
                    $song_name = $_FILES[$file_name]['name'];
                    $this->ci->load->model('Audio_uploads_model');
                    usleep(2);
                    $audio_data = [];
                    $upload_return = $this->ci->Audio_uploads_model->upload($this->audio_upload_gid, $id, $file_name, $id, $audio_data, 'generate');
                    if (isset($upload_return['file'])) {
                        $audio_data['key'] = str_replace(['.mp3', '.wav'], '', $upload_return['file']);
                    } else {
                        $audio_data['key'] = substr(md5(microtime()), 0, 10);
                    }
                    $event['data'][0]['audios'][$audio_data['key']]['status'] = 'start';
                    $this->save_event($event, ['id' => $id]);

                    $event = $this->get_event_by_id($id);
                    if (empty($upload_return['errors'])) {
                        $result['name'] = $upload_return['file'];
                        $event['data'][0]['audios'][$audio_data['key']]['file'] = $upload_return['file'];
                        $event['data'][0]['audios'][$audio_data['key']]['song_name'] = str_replace(['.mp3', '.wav'], '', $song_name);
                    } else {
                        $result['errors'] = $upload_return['errors'];
                        $event['data'][0]['audios'][$audio_data['key']]['errors'] = $upload_return['errors'];
                    }
                    $result['is_saved'] = $this->save_event($event, ['id' => $id]);
                } else {
                    $result['errors'][] = l('error_invalid_file_type', 'wall_events');
                }
            } else {
                $event['data'][0] = array_merge_recursive((array) $data[0], (array) $event['data'][0]);
                $result['is_saved'] = $this->save_event($event, ['id' => $id]);
            }
        } else {
            $result['errors'][] = l('error_event_not_found', 'wall_events');
        }
        $result['id'] = $id;
        $this->ci->cache->flush(TABLE_WALL_EVENTS);

        return $result;
    }

    public function getEventById($id)
    {
        $where      = ['where' => ['id' => $id]];
        $callback   = [$this,'fetchEvents'];
        $result = $this->ci->cache->get(TABLE_WALL_EVENTS, 'getEventById'.$id, function () use ($callback, $where) {
            $result  = call_user_func($callback, $where);

            return $result;
        });

        if (!empty($result[0])) {
            return $result[0];
        }

        return [];
    }

    public function getEvents($params = [], $items_on_page = null, $page = null)
    {
        if (!empty($params)) {
            $result = $this->fetchEvents($params, $items_on_page, $page);
        } else {
            $param      = [$params,$items_on_page,$page];
            $callback   = [$this,'fetchEvents'];
            $result = $this->ci->cache->get(TABLE_WALL_EVENTS, 'getEventsI'.$items_on_page.'P'.$page, function () use ($callback, $param) {
                $result  = call_user_func_array($callback, $param);

                return $result;
            });
        }

        return $result;
    }

    private function fetchEvents($params = [], $items_on_page = null, $page = null)
    {
        if (!empty($params['where']) && is_array($params['where'])) {
            $this->ci->db->where($params['where']);
        }
        if (!empty($params['where_in']) && is_array($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (!empty($params['where_sql']) && is_array($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }
        if (!is_null($items_on_page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        } else {
            $this->ci->db->limit(1000);
        }
        $result = $this->ci->db->select($this->fields_str)
                ->from(TABLE_WALL_EVENTS)
                ->order_by('id', 'DESC')
                ->get()->result_array();
        foreach ($result as &$event) {
            $unserialized = @unserialize($event['data']);
            if (!$unserialized) {
                log_message('error', '(wall_events) Invalid serialized data');
            } else {
                $event['data'] = $unserialized;
            }
        }

        return $result;
    }

    public function formatEvents($events, $use_spam = true)
    {
        if (empty($events) || !is_array($events)) {
            return [];
        }

        $this->ci->load->model('wall_events/models/Wall_events_types_model');
        $events_types = $this->ci->Wall_events_types_model->getWallEventsTypes();

        $formatted_events = [];

        foreach ($events as $key => $e) {
            $e_by_gid[$e['event_type_gid']][$key] = $e;
        }

        foreach ($e_by_gid as $gid => $es) {
            $module = $events_types[$gid]['module'];
            $model = $events_types[$gid]['model'];
            $method = $events_types[$gid]['method_format_event'];
            if ($this->ci->pg_module->is_module_installed($module) && $this->ci->load->model($module . '/models/' . $model, '', false, true, true)) {
                $formatted_events += $this->ci->{$model}->{$method}($es, $use_spam);
            }
        }

        ksort($formatted_events);

        return $formatted_events;
    }

    public function formatWallEvents($events, $format_user = false, $safe_format = false)
    {
        $this->ci->load->model(["Uploads_model", "Video_uploads_model"]);

        $is_audio_uploads_installed = $this->ci->pg_module->is_module_installed('audio_uploads');
        if ($is_audio_uploads_installed) {
            $this->ci->load->model("Audio_uploads_model");
        }

        if ($format_user) {
            $this->ci->load->model('Users_model');

            $users_ids = array_map(function ($v) {
                return $v['id_poster'];
            }, $events);
            $users_ids = array_filter($users_ids);
            $users_ids = array_unique($users_ids);

            if (!empty($users_ids)) {
                $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $users_ids, true);
            }
        }

        $formatted_events = [];

        foreach ($events as $key => $e) {
            $e['user_info'] = isset($users) ? $users[$e['id_poster']] : [];

            if (!empty($e['user_info']['is_blocked']) && $e['user_info']['is_blocked'] === true) {
                continue;
            }

            foreach ($e['data'] as $datakey => $data) {
                if (!empty($data['images'])) {
                    foreach ($data['images'] as $img) {
                        $image_data = $this->ci->Uploads_model->format_upload($this->image_upload_gid, $img['id'], $img['file']);
                        $image_data['photo_title'] = str_replace('[id]', $img['id'], l('text_wall_photo', 'wall_events'));
                        $image_data['photo_alt'] = str_replace('[id]', $img['id'], l('text_wall_photo', 'wall_events'));
                        $e['media'][$datakey]['img'][] = $image_data;
                    }
                }

                if (!empty($data['videos'])) {
                    foreach ($data['videos'] as $video) {
                        if (!empty($video['video'])) {
                            if (!isset($video['isHTML5'])) {
                                $video['isHTML5'] = 0;
                            }
                            if (!isset($video['video_image'])) {
                                $video['video_image'] = "";
                            }
                            if (!isset($video['upload_type'])) {
                                $video['upload_type'] = "local";
                            }

                            $formatted_video = $this->ci->Video_uploads_model->format_upload($this->video_upload_gid, $e['id'], $video['video'], $video['video_image'], $video['upload_type'], $video['isHTML5']);
                            $formatted_video['status'] = $video['status'];

                            $errors = [];
                            foreach ($video['errors'] as $error) {
                                if (!empty($error)) {
                                    $errors[] = $error;
                                }
                            }

                            $formatted_video['errors'] = !empty($errors) ? $errors : "";

                            $e['media'][$datakey]['video'][] = $formatted_video;
                        } else {
                            $errors = [];
                            foreach ($video['errors'] as $error) {
                                if (!empty($error)) {
                                    $errors[] = $error;
                                }
                            }

                            $e['media'][$datakey]['video'][] = [
                                'video' => '',
                                'status' => $video['status'],
                                'errors' => !empty($errors) ? $errors : "",
                            ];
                        }
                    }
                }

                if ($is_audio_uploads_installed && !empty($data['audios'])) {
                    foreach ($data['audios'] as $audio) {
                        if (!empty($audio)) {
                            if (!isset($audio['isHTML5'])) {
                                $audio['isHTML5'] = 0;
                            }
                            if (!isset($audio['upload_type'])) {
                                $audio['upload_type'] = "local";
                            }
                            if (!isset($audio['file'])) {
                                $audio['file'] = "";
                            }

                            $formatted_audio = $this->ci->Audio_uploads_model->format_upload($this->audio_upload_gid, $e['id'], $audio['file'], $audio['upload_type'], $audio['isHTML5']);
                            $formatted_audio['status'] = $audio['status'];

                            if (isset($audio['errors'])) {
                                $errors = [];
                                foreach ($audio['errors'] as $error) {
                                    if (!empty($error)) {
                                        $errors[] = $error;
                                    }
                                }

                                $formatted_audio['errors'] = !empty($errors) ? $errors : "";
                            }

                            $e['media'][$datakey]['audio'][] = $formatted_audio;
                        } else {
                            $e['media'][$datakey]['audio'][] = [
                                'audio' => '',
                                'status' => $audio['status'],
                                'errors' => !empty($errors) ? $errors : "",
                            ];
                        }
                    }
                }

                if (!empty($data['embed_data'])) {
                    if (array_key_exists('video', $data['embed_data'])) {
                        $formatted_video = $this->ci->Video_uploads_model->format_upload($this->video_upload_gid, '', $data['embed_data'], '', 'embed');
                        $e['media'][$datakey]['video'][] = $formatted_video;
                    } elseif ($is_audio_uploads_installed && array_key_exists('audio', $data['embed_data'])) {
                        $formatted_audio = $this->ci->Audio_uploads_model->format_upload($this->audio_upload_gid, '', $data['embed_data'], '', 'embed');
                        $e['media'][$datakey]['audio'][] = $formatted_audio;
                    }
                }
            }

            $is_event_data = false;
            if (empty($e['media'])) {
                foreach ($e['data'] as $e_data) {
                    if (!empty($e_data['text'])) {
                        $is_event_data = true;

                        break;
                    }
                }
            } else {
                $is_event_data = true;
            }

            if ($is_event_data) {
                $this->ci->view->assign('event', $e);
                $e['html'] = $this->ci->view->fetch('wall_events_wall_post', null, 'wall_events');
                $formatted_events[$key] = $e;
            }
        }

        return $formatted_events;
    }

    private function getJoinedEvent($event_type_gid, $id_wall, $id_poster)
    {
        $params['where']['event_type_gid'] = $event_type_gid;
        $params['where']['id_wall'] = $id_wall;
        $params['where']['id_poster'] = $id_poster;
        $params['where']['date_update >='] = date("Y-m-d H:i:s", time() - $this->event_type['settings']['join_period'] * 60);
        $params['where']['comments_count'] = '0';
        $events = $this->getEvents($params);

        //check max_event_data_count for prevent mega events with lots of data requiring big sql requests
        if (!empty($events[0]['data'])) {
            $data_count = count($events[0]['data']);
            foreach ($events[0]['data'] as $e_data) {
                if (!empty($e_data['images'])) {
                    $data_count += count($e_data['images']) - 1;
                }
                if (!empty($e_data['videos'])) {
                    $data_count += count($e_data['videos']) - 1;
                }
                if (!empty($e_data['audios'])) {
                    $data_count += count($e_data['audios']) - 1;
                }
            }
            if ($data_count >= $this->max_event_data_count) {
                return false;
            }

            return $events[0];
        }

        return false;
    }

    public function deleteEvents($where, $delete_uploads = true)
    {
        $events = $this->get_events(['where' => $where]);
        if ($delete_uploads) {
            $this->ci->load->model('Uploads_model');
            $this->ci->load->model('Video_uploads_model');
            $is_audio_uploads_installed = $this->ci->pg_module->is_module_installed('audio_uploads');
            if ($is_audio_uploads_installed) {
                $this->ci->load->model('Audio_uploads_model');
            }

            foreach ($events as $e) {
                $id = $e['id'];
                foreach ($e['data'] as $edata) {
                    if (!empty($edata['images'])) {
                        foreach ($edata['images'] as $img) {
                            $this->ci->Uploads_model->delete_upload($this->image_upload_gid, $img['id'], $img['file']);
                        }
                    }
                    if (!empty($edata['videos'])) {
                        foreach ($edata['videos'] as $video) {
                            if (empty($video['video_image'])) {
                                $video['video_image'] = '';
                            }
                            $this->ci->Video_uploads_model->delete_upload($this->video_upload_gid, $e['id'], $video['file'], $video['video_image']);
                        }
                    }
                    if (!empty($edata['audios'])) {
                        foreach ($edata['audios'] as $audio) {
                            if (!empty($audio['file'])) {
                                $this->ci->Audio_uploads_model->delete_upload($this->audio_upload_gid, $e['id'], $audio['file']);
                            }
                        }
                    }
                }
            }
            $this->ci->Uploads_model->delete_path($this->image_upload_gid, $id);
        }
        $this->ci->db->where($where);
        $this->ci->db->delete(TABLE_WALL_EVENTS);
        $this->ci->cache->flush(TABLE_WALL_EVENTS);

        return $this->ci->db->affected_rows();
    }

    public function getEventsCount($params = [])
    {
        if (!empty($params['where']) && is_array($params['where'])) {
            $this->ci->db->where($params['where']);
        }
        if (!empty($params['where_in']) && is_array($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (!empty($params['where_sql']) && is_array($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }
        $result = $this->ci->db->count_all_results(TABLE_WALL_EVENTS);

        return $result;
    }

    private function clearEvents($id_wall)
    {
        $config = $this->ci->pg_module->get_module_all_config('wall_events');
        $where = [];
        if ($config['events_max_count']) {
            if ($config['live_period']) {
                $where = [];
                $where['id_wall'] = $id_wall;
                $where['date_update >='] = date("Y-m-d H:i:s", time() - $config['live_period'] * 60 * 60 * 24);
                $events_in_date = $this->get_events_count($where);
                if ($events_in_date >= $config['events_max_count']) {
                    $where = [];
                    $where['id_wall'] = $id_wall;
                    $where['date_update <'] = date("Y-m-d H:i:s", time() - $config['live_period'] * 60 * 60 * 24);

                    return $this->delete_events($where);
                }
            }
            $this->ci->db->select('id')->from(TABLE_WALL_EVENTS)->where('id_wall', $id_wall)->order_by('id', 'DESC')->limit($config['events_max_count']);
            $events_in_count = $this->ci->db->get()->result_array();
            if (count($events_in_count) == $config['events_max_count']) {
                $last_event_in_count = array_pop($events_in_count);
                $where = [];
                $where['id_wall'] = $id_wall;
                $where['id <'] = $last_event_in_count['id'];

                return $this->delete_events($where);
            }
        } elseif ($config['live_period']) {
            $where = [];
            $where['id_wall'] = $id_wall;
            $where['date_update <'] = date("Y-m-d H:i:s", time() - $config['live_period'] * 60 * 60 * 24);

            return $this->delete_events($where);
        }
        $this->ci->cache->flush(TABLE_WALL_EVENTS);

        return false;
    }

    public function updatePermissions($id_wall, $event_type_gid, $permissions)
    {
        $where['id_wall'] = intval($id_wall);
        $where['event_type_gid'] = trim(strip_tags($event_type_gid));
        $permissions = intval($permissions);
        $this->ci->db->where($where)->set('permissions', $permissions)->update(TABLE_WALL_EVENTS);
        $this->ci->cache->flush(TABLE_WALL_EVENTS);

        return $this->ci->db->affected_rows();
    }

    // video callback
    public function videoCallback($id, $status, $data, $errors)
    {
        $result['errors'] = [];
        $result['is_saved'] = 0;
        $event = $this->get_event_by_id($id);
        if ($event) {
            $data_key = false;
            foreach ($event['data'] as $key => $edata) {
                if (!empty($edata['videos'][$data['file_data']['key']])) {
                    $video_data = $edata['videos'][$data['file_data']['key']];
                    $data_key = $key;

                    break;
                }
            }
            if ($data_key !== false) {
                $video_data['isHTML5'] = (!empty($data['isHTML5'])) ? $data['isHTML5'] : 0;
                $video_data['errors'] = (!empty($video_data['errors'])) ? $video_data['errors'] : "";
                if (isset($data['video'])) {
                    $video_data['video'] = $data['video'];
                }
                if (isset($data['image'])) {
                    $video_data['video_image'] = $data['image'];
                }
                $video_data['status'] = $status;
                $video_data['errors'] = array_merge((array) $video_data['errors'], (array) $errors);

                $event['data'][$data_key]['videos'][$data['file_data']['key']] = $video_data;

                $result['is_saved'] = $this->save_event($event, ['id' => $event['id']]);
            }
        }

        return $result;
    }

    public function audioСallback($id, $status, $data, $errors)
    {
        $result['errors'] = [];
        $result['is_saved'] = 0;
        $event = $this->get_event_by_id($id);
        if ($event) {
            $data_key = false;
            foreach ($event['data'] as $key => $edata) {
                if (!empty($edata['audios'][$data['file_data']['key']])) {
                    $audio_data = $edata['audios'][$data['file_data']['key']];
                    $data_key = $key;

                    break;
                }
            }
            if ($data_key !== false) {
                $audio_data['isHTML5'] = (!empty($data['isHTML5'])) ? $data['isHTML5'] : 0;
                $audio_data['errors'] = (!empty($audio_data['errors'])) ? $audio_data['errors'] : "";
                if (isset($data['audio'])) {
                    $audio_data['audio'] = $data['audio'];
                }
                if (isset($data['image'])) {
                    $audio_data['audio_image'] = $data['image'];
                }
                $audio_data['status'] = $status;
                $audio_data['errors'] = array_merge((array) $audio_data['errors'], (array) $errors);

                $event['data'][$data_key]['audios'][$data['file_data']['key']] = $audio_data;

                $result['is_saved'] = $this->save_event($event, ['id' => $event['id']]);
            }
        }

        return $result;
    }

    public function validate($event_data, $file_name = '', $required_fields = [])
    {
        $validate_data['data'] = $validate_data['errors'] = [];
        if (isset($event_data['id_wall'])) {
            $validate_data['data']['id_wall'] = intval($event_data['id_wall']);
            $this->ci->load->model('Users_model');
            $owner = $this->ci->Users_model->get_user_by_id($validate_data['data']['id_wall']);
            if (!$owner) {
                $validate_data['errors'][] = l('error_user_not_found', 'wall_events');
            }
        }
        $validate_data['data']['data'] = $event_data['data'];

        if (!empty($event_data['data']['text'])) {
            $this->ci->load->library('VideoEmbed');
            $text = trim(strip_tags($event_data['data']['text']));
            //parse video urls to embed codes
            $text = $this->ci->videoembed->replace_urls_to_embed_in_text($text);

            $this->ci->load->model('moderation/models/Moderation_badwords_model');
            $bw_count = $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $text);
            if (!empty($validate_data['data']['user_name'])) {
                $user_name = $validate_data['data']['user_name'];
            } else {
                $user_name = '';
            }
            $bw_count = $bw_count || $this->ci->Moderation_badwords_model->check_badwords($this->moderation_type, $user_name);
            if ($bw_count) {
                $validate_data["errors"][] = l('error_badwords_message', 'wall_events');
            }

            $validate_data['data']['data']['text'] = $text;
        }

        if (!empty($event_data['id_poster'])) {
            $validate_data['data']['id_poster'] = intval($event_data['id_poster']);
        }

        $embed_data = [];
        if (!empty($event_data['data']['embed_code'])) {
            $this->ci->load->library('VideoEmbed');
            $embed_data = $this->ci->videoembed->get_video_data($event_data['data']["embed_code"]);
            if ($embed_data !== false) {
                $embed_data["string_to_save"] = $this->videoembed->get_string_from_video_data($embed_data);
                $validate_data['data']['data']['embed_data'] = $embed_data;
                //sendEvent for bonus
                $this->ci->load->model("media/models/Media_model");
                $this->ci->Media_model->sendEventUpload('video', $validate_data['data']['id_poster']);
            } else {
                $validate_data["errors"][] = l('error_embed_wrong', 'wall_events');
            }
            unset($validate_data['data']['data']['embed_code']);
        }
        if (!empty($file_name)) {
            if (isset($_FILES[$file_name]) && is_array($_FILES[$file_name]) && !($_FILES[$file_name]["error"])) {
                $upload_gid = $this->getUploadGid($_FILES[$file_name]['name']);
                if ($upload_gid == $this->image_upload_gid) {
                    $this->ci->load->model("Uploads_model");
                    $file_return = $this->ci->Uploads_model->validate_upload($this->image_upload_gid, $file_name);
                    if (!empty($file_return["error"])) {
                        $validate_data["errors"][] = (is_array($file_return["error"])) ? implode("<br>", $file_return["error"]) : $file_return["error"];
                    } else {
                        //sendEvent for bonus
                        $this->ci->load->model("media/models/Media_model");
                        if (isset($validate_data['data']['id_poster'])) {
                            $this->ci->Media_model->sendEventUpload('image', $validate_data['data']['id_poster']);
                        }
                    }
                } elseif ($upload_gid == $this->video_upload_gid) {
                    $this->ci->load->model("Video_uploads_model");
                    $file_return = $this->ci->Video_uploads_model->validate_upload($this->video_upload_gid, $file_name);
                    if (!empty($file_return["error"])) {
                        $validate_data["errors"][] = (is_array($file_return["error"])) ? implode("<br>", $file_return["error"]) : $file_return["error"];
                    } else {
                        //sendEvent for bonus
                        $this->ci->load->model("media/models/Media_model");
                        $this->ci->Media_model->sendEventUpload('video', $validate_data['data']['id_poster']);
                    }
                } elseif ($upload_gid == $this->audio_upload_gid) {
                    $this->ci->load->model("Audio_uploads_model");
                    $file_return = $this->ci->Audio_uploads_model->validate_upload($this->audio_upload_gid, $file_name);
                    if (!empty($file_return["error"])) {
                        $validate_data["errors"][] = (is_array($file_return["error"])) ? implode("<br>", $file_return["error"]) : $file_return["error"];
                    } else {
                        //sendEvent for bonus
                        $this->ci->load->model("media/models/Media_model");
                        $this->ci->Media_model->sendEventUpload('audio', $validate_data['data']['id_poster']);
                    }
                } else {
                    $validate_data["errors"][] = l('error_invalid_file_type', 'wall_events');
                }
                $validate_data["data"]['mime'] = $_FILES[$file_name]["type"];
            } elseif (!empty($_FILES[$file_name]["error"])) {
                $validate_data["errors"][] = $_FILES[$file_name]["error"];
            }
        }

        foreach ($required_fields as $required_field) {
            if (empty($validate_data['data']['data'][$required_field])) {
                $validate_data['errors'][] = l('error_empty_data', 'wall_events');
            }
        }

        return $validate_data;
    }

    private function getUploadGid($file_name)
    {
        $file_data = explode('.', $file_name);
        $extension = strtolower(end($file_data));

        $result = '';
        foreach ($this->upload_config as $upload_gid => $upload_config) {
            foreach ($upload_config['file_formats'] as $file_format) {
                if ($file_format == $extension) {
                    $result = $upload_gid;

                    break 2;
                }
            }
        }

        return $result;
    }

    public function commentsCountCallback($count, $id = 0)
    {
        $where = $id ? ['id' => $id] : [];
        $attrs['comments_count'] = $count;
        $this->save_event($attrs, $where);
        $this->ci->cache->flush(TABLE_WALL_EVENTS);
    }

    public function commentsObjectCallback($id = 0)
    {
        $return = [];

        $callback   = [$this,'get_wall_events'];
        $return = $this->ci->cache->get(TABLE_WALL_EVENTS, 'commentsObjectCallback'.$id, function () use ($callback, $id) {
            $result  = call_user_func($callback, null, null, null, null, (array) $id);

            return $result;
        });
        if (!empty($object)) {
            $return["body"] = $object[0]["html_delete"] ? $object[0]["html_delete"] : $object[0]["html"];
            $return["author"] = $object[0]["html_delete"] ? l("author_unknown", "spam") : $object[0]["user_info"]["output_name"];
        }

        return $return;
    }

    /**
     * Get objects list
     * banners - default return all object
     *
     * @return array
     */
    public function getWallEvents($page = 1, $items_on_page = 20, $order_by = null, $params = [], $filter_object_ids = null, $format_items = true, $format_owner = false, $format_user = false, $safe_format = false)
    {
        $this->ci->db->select(implode(", ", $this->fields));
        $this->ci->db->from(TABLE_WALL_EVENTS);

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
                $this->ci->db->limit($params['limit']['count'], $params['limit']['from']);
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
                if (in_array($field, $this->_fields)) {
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
            $event['data'] = unserialize($event['data']);
        }

        if ($format_items) {
            $result = $this->formatEvents($result);
        }

        if ($format_user && !empty($result)) {
            foreach ($result as $key => $e) {
                $users_ids[] = $e['id_poster'];
            }
            $this->ci->load->model('Users_model');
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $users_ids, false);
            $users = $this->ci->Users_model->formatUsers($users, $safe_format);
            $default_user = $this->ci->Users_model->formatDefaultUser(1);
            foreach ($result as $key => $e) {
                $result[$key]['user_info'] = isset($users[$e['id_poster']]) ?
                    $users[$e['id_poster']] : $default_user;
            }
        }

        return $result;
    }

    public function getWallEventsByKey($page = 1, $items_on_page = 20, $order_by = null, $params = [], $filter_object_ids = null, $format_items = true, $format_owner = false, $format_user = false, $safe_format = false)
    {
        $media = $this->getWallEvents($page, $items_on_page, $order_by, $params, $filter_object_ids, $format_items, $format_owner, $format_user, $safe_format);
        $media_by_key = [];
        foreach ($media as $m) {
            $media_by_key[$m['id']] = $m;
        }

        return $media_by_key;
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
                $where['id'] = (int) $data;
                $this->delete_events($where);

                return "removed";

                break;
            case 'get_content':
                if (empty($data)) {
                    return [];
                }
                $new_data = [];
                $return = [];
                foreach ($data as $id) {
                    if (($this->get_events_count(['where_in' => ['id' => $id]])) == 0) {
                        $return[$id]["content"]["view"] = $return[$id]["content"]["list"] = "<span class='spam_object_delete'>" . l("error_is_deleted_wall_events_object", "spam") . "</span>";
                        $return[$id]["user_content"] = l("author_unknown", "spam");
                    } else {
                        $new_data[] = $id;
                    }
                }

                $events = $this->get_wall_events(null, null, null, null, (array) $new_data, false, false, true);
                $events = $this->format_events($events, false);

                foreach ($events as $event) {
                    if (empty($event['html_delete'])) {
                        if (preg_match_all("/id=\"default_player_([0-9]+)\">/is", $event['html'], $match)) {
                            $return[$event['id']]["rand"] = $match[1];
                            foreach ($match[1] as $key => $rand) {
                                $event['html'] = str_replace($rand, $rand . "_" . $key, $event['html']);
                            }
                        }
                    }
                    $return[$event['id']]["content"]["view"] = $return[$event['id']]["content"]["list"] = !empty($event['html_delete']) ? $event['html_delete'] : $event['html'];
                    $return[$event['id']]["user_content"] = !empty($event['html_delete']) ?
                        l("author_unknown", "spam") :
                        (isset($event['user_info']) ? $event['user_info']['output_name'] : '');
                }

                return $return;

                break;
            case 'get_subpost':
                return [];

                break;
            case 'get_link':
                return [];

                break;
            case 'get_deletelink':
                if (empty($data)) {
                    return [];
                }
                $events = $this->get_wall_events(null, null, null, null, (array) $data);
                $return = [];
                foreach ($events as $event) {
                    $return[$event['id']] = site_url() . 'admin/spam/delete_content/';
                }

                return $return;

                break;
            case 'get_object':
                if (empty($data)) {
                    return [];
                }
                $medias = $this->get_wall_events_by_key(null, null, null, null, (array) $data);

                return $medias;

                break;
        }
    }

    public function callbackUserDelete($id_user)
    {
        $this->deleteEventsByUserId($id_user);
    }

    private function deleteEventsByUserId($id_user)
    {
        $where['id_poster'] = $id_user;

        return $this->delete_events($where);
    }

    public function validateSettings($data)
    {
        $return = ['errors' => [], 'data' => []];

        if (isset($data['live_period'])) {
            $return['data']['live_period'] = intval($data['live_period']);
            if ($return['data']['live_period'] < 0) {
                $return['errors'][] = l('error_live_period', 'wall_events');
            }
        }

        if (isset($data['items_per_page'])) {
            $return['data']['items_per_page'] = intval($data['items_per_page']);
            if ($return['data']['items_per_page'] <= 0) {
                $return['errors'][] = l('error_items_per_page', 'wall_events');
            }
        }

        if (isset($data['events_max_count'])) {
            $return['data']['events_max_count'] = intval($data['events_max_count']);
            if ($return['data']['events_max_count'] <= 0) {
                $return['errors'][] = l('error_events_max_count', 'wall_events');
            }
        }

        return $return;
    }

    /**
     * Callback User BLocked
     *
     * @param array $users_ids
     * @param string $is_blocked
     *
     * @return void
     */
    public function callbackUserBLocked(array $users_ids, string $is_blocked)
    {
        $this->ci->db->where_in('id_poster', $users_ids)
            ->update(TABLE_WALL_EVENTS, ['status' => $is_blocked]);
        $this->ci->cache->flush(TABLE_WALL_EVENTS);
    }

    public function __call($name, $args)
    {
        $methods = [
            '_format_wall_events' => 'formatWallEvents',
            'add_event' => 'addEvent',
            'add_event_data' => 'addEventData',
            'audio_callback' => 'audioCallback',
            'callback_user_delete' => 'callbackUserDelete',
            'comments_count_callback' => 'commentsCountCallback',
            'delete_events' => 'deleteEvents',
            'format_events' => 'formatEvents',
            'get_event_by_id' => 'getEventById',
            'comments_object_callback' => 'commentsObjectCallback',
            'get_events' => 'getEvents',
            'get_events_count' => 'getEventsCount',
            'get_wall_events' => 'getWallEvents',
            'get_wall_events_by_key' => 'getWallEventsByKey',
            'initialize_event_type' => 'initializeEventType',
            'save_event' => 'saveEvent',
            'spam_callback' => 'spamCallback',
            'update_permissions' => 'updatePermissions',
            'video_callback' => 'videoCallback',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
