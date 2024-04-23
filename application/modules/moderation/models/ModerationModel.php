<?php

declare(strict_types=1);

namespace Pg\modules\moderation\models;

use Pg\Libraries\EventDispatcher;
use Pg\modules\moderation\models\events\EventModeration;

define('MODERATION_ITEMS_TABLE', DB_PREFIX . 'moderation_items');

/**
 * Moderation Model
 *
 * модель никогда не меняет статуса уже активного элемента
 * каждый вызов add_moderation_item добавляет запись в соотв с типом мод.объекта
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class ModerationModel extends \Model
{
    const MODULE_GID = 'moderation';
    const EVENT_OBJECT_CHANGED = 'moderation_object_changed';
    const MODULE_TABLE = MODERATION_ITEMS_TABLE;
    const SORT_DEFAULT = 'date_add DESC';
    const TYPE_MODERATION_ITEM = 'moderation_item';
    const STATUS_ADDED = 'added';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';
    const STATUS_DELETED = 'deleted';
    const NOTIFICATION_GID = 'moderation_status';

    public $types;
    protected $fields        = [
        self::MODULE_TABLE => [
            'id',
            'id_type',
            'id_object',
            'date_add',
        ],
    ];
    public $dashboard_events = [
        self::EVENT_OBJECT_CHANGED,
    ];

    public function __construct()
    {
        parent::__construct();

        $this->ci->load->model(['moderation/models/Moderation_type_model',
            'moderation/models/Moderation_badwords_model']);
    }

    public function getModerationType($type_name)
    {
        if (!isset($this->types[$type_name])) {
            $type_data = $this->ci->Moderation_type_model->getTypeByName($type_name);
            if (!is_array($type_data) || !count($type_data)) {
                return false;
            }
            $this->types[$type_data["id"]] = $type_data;
            $this->types[$type_name] = $type_data;
        }

        return $this->types[$type_name];
    }

    public function getModerationTypeById($type_id)
    {
        if (!isset($this->types[$type_id])) {
            $type_data = $this->ci->Moderation_type_model->get_type_by_id($type_id);
            if (!is_array($type_data) || !count($type_data)) {
                return false;
            }
            $this->types[$type_id]           = $type_data;
            $this->types[$type_data["name"]] = $type_data;
        }

        return $this->types[$type_id];
    }

    public function getModerationTypeStatus($type_name)
    {
        $type_data = $this->getModerationType($type_name);
        switch ($type_data["mtype"]) {
            case "0":
                $status = 1;
                break;
            case "1":
                $status = 1;
                break;
            case "2":
                $status = 0;
                break;
        }

        return $status;
    }

    public function approve($item_id)
    {
        $item_data = $this->getModerationItem($item_id);
        $type_data = $this->getModerationTypeById($item_data["id_type"]);

        if ($type_data["model"] && $type_data["module"] && $type_data["method_set_status"]) {
            $model_name = ucfirst($type_data["model"]);
            $model_path = strtolower($type_data["module"] . "/models/") . $model_name;
            $this->ci->load->model($model_path);
            $this->ci->{$model_name}->{$type_data["method_set_status"]}((int)$item_data["id_object"],
                1);
        }
        $obj = current($this->getModerationObject([
            'where' => ['id' => $item_id]
        ]));
        $this->deleteModerationItemById($item_id);
        $this->sendEvent(self::EVENT_OBJECT_CHANGED, [
            'id' => $item_id,
            'type' => self::TYPE_MODERATION_ITEM,
            'status' => self::STATUS_APPROVED,
            'obj' => $obj
        ]);

        $this->ci->load->model('menu/models/Indicators_model');
        $this->ci->Indicators_model->delete('new_moderation_item', $item_data["id_object"], true);
    }

    public function decline($item_id, $reason = '')
    {
        $obj = current($this->getModerationObject([
            'where' => ['id' => $item_id]
        ]));
        $this->sendEvent(self::EVENT_OBJECT_CHANGED, [
            'id' => $item_id,
            'type' => self::TYPE_MODERATION_ITEM,
            'status' => self::STATUS_DECLINED,
            'obj' => $obj,
            'reason' => $reason
        ]);
        $item_data = $this->getModerationItem($item_id);
        $type_data = $this->getModerationTypeById($item_data["id_type"]);
        if ($type_data["model"] && $type_data["module"] && $type_data["method_set_status"] && $type_data["allow_to_decline"]) {
            $model_name = ucfirst($type_data["model"]);
            $model_path = strtolower($type_data["module"] . "/models/") . $model_name;
            $this->ci->load->model($model_path);
            $this->ci->{$model_name}->{$type_data["method_set_status"]}((int)$item_data["id_object"], 0);
        }
        $this->deleteModerationItemById($item_id);
        $this->ci->load->model('menu/models/Indicators_model');
        $this->ci->Indicators_model->delete('new_moderation_item', $item_data["id_object"], true);
    }

    public function addModerationItem($type_name, $obj_id)
    {
        $type_data = $this->getModerationType($type_name);
        if ($type_data["mtype"] != 0) {
            $type_id = intval($type_data["id"]);

            $item_id = $this->getModerationItemId($type_name, $obj_id);
            $attrs["date_add"] = date("Y-m-d H:i:s");
            if ($item_id > 0) {
                $this->ci->db->where('id', $item_id);
                $this->ci->db->update(MODERATION_ITEMS_TABLE, $attrs);
            } else {
                $attrs["id_type"] = $type_id;
                $attrs["id_object"] = $obj_id;
                $this->ci->db->insert(MODERATION_ITEMS_TABLE, $attrs);
                $item_id = $this->ci->db->insert_id();
            }

            $this->sendEvent(self::EVENT_OBJECT_CHANGED,
                [
                    'id' => $item_id,
                    'type' => self::TYPE_MODERATION_ITEM,
                    'status' => self::STATUS_ADDED,
                ]);

            $this->ci->load->model('menu/models/Indicators_model');
            $this->ci->Indicators_model->add(
                'new_moderation_item',
                $obj_id,
                0,
                $type_data['id']
            );

            return true;
        }
        
        return false;
    }

    /**
     * Send notifications
     *
     * @param array $data
     * @param string $status
     * @param string $reason
     *
     * @return void
     */
    public function sendNotification(array $data, string $status, $reason = '')
    {
        $is_send = false;
        $obj_content = '';
        $media_preview = '';
        if (isset($data['upload_gid'])) {
            $user = $data['owner_info'];
            if ($data['upload_gid'] == 'gallery_video') {
                if (isset($data['video_content']['file_url'])) {
                    $media_preview = '<video controls width="400" height="300">'
                            . '<source src="' . $data['video_content']['file_url']  . '" type="video/mp4">'
                            .'<a href="' . site_url('users/profile/gallery/video') . '">'
                                . '<img title="' . $data['fname'] . '" src="' . $data['video_content']['thumbs']['big'] . '" width="400" height="300" />'
                            . '</a>'
                        . '</video>';
                } elseif (isset($data['video_content']['embed']) && $data['video_content']['embed']) {
                     $media_preview = '<a href="' . site_url('users/profile/gallery/video') . '">'
                                . '<img title="' . $data['fname'] . '" src="' . $data['video_content']['thumbs']['big'] . '" width="400" height="300" />'
                            . '</a>';
                }
            } elseif ($data['upload_gid'] == 'gallery_image') {
                $media_preview = '<a href="' . site_url('users/profile/gallery/photo') . '">'
                        . '<img src="'. $data['media']['mediafile']['thumbs']['big'] .'">'
                   . '</a>';
                $obj_content =  "<div>" . l('text_notification_declined_gallery', 'users', $user['lang_id']) . "</div>";
            } elseif ($data['upload_gid'] == 'gallery_audio') {
                if (isset($data['fname'])) {
                    $media_preview = '<a href="' . site_url('users/profile/gallery/audio') . '">' . $data['fname'] . '</a>';
                }
            }
        } else {
            $is_send = true;
            $user = $data;
            if ($status == self::STATUS_DECLINED) {
                $obj_content =  "<div>" . l('text_notification_declined', 'users', $user['lang_id']) . "</div>";
                if (!empty($user['media']['user_logo_moderation'])) {
                    $media_preview = '<img src="'. $user['media']['user_logo_moderation']['thumbs']['big'] .'">';
                } else {
                    $media_preview = '<img src="'. $user['media']['user_logo']['thumbs']['big'] .'">';
                }
            } else {
                $media_preview = '<img src="'. $user['media']['user_logo']['thumbs']['big'] .'">';
            }
        }

        if (!empty($user)) {
            if (!empty($reason)) {
                $options = $this->pg_language->ds->get_reference('moderation', 'rejection_reason', $user['lang_id']);
                if (strpos($options['option'][$reason], '[legal-terms]') !== false) {
                    $this->ci->load->helper('content');
                    $legal_terms = get_page_link('legal-terms');
                    $options['option'][$reason] = str_replace('[legal-terms]', $legal_terms, $options['option'][$reason]);
                }
            }

            $notification_data = [
                'fname' => $user['output_name'],
                'sname' => $user['sname'] ?? '',
                'status' => $obj_content . "<br><div>" . $options['option'][$reason] . "</div><br><div>" . l('field_photo_requirements', 'moderation', $user['lang_id']) . "</div>",
                'preview' => $media_preview,
                'is_send' => $is_send
            ];

            $this->ci->load->model('Notifications_model');
            $this->ci->Notifications_model->sendNotification($user['email'], 'moderation_status', $notification_data, '', $user['lang_id']);
        }
    }

    public function sendEvent($event_gid, $event_data)
    {
        $event_data['module'] = self::MODULE_GID;
        $event_data['action'] = $event_gid;

        $event = new EventModeration();
        $event->setData($event_data);

        $event_handler = EventDispatcher::getInstance();
        $event_handler->dispatch($event, $event_gid);
    }

    public function issetModerationItem($type_name, $obj_id)
    {
        $type_data = $this->get_moderation_type($type_name);
        $type_id   = intval($type_data["id"]);

        $this->ci->db->select('COUNT(*) AS cnt')
            ->from(MODERATION_ITEMS_TABLE)
            ->where('id_type', $type_id)
            ->where('id_object', $obj_id);
        $result = $this->ci->db->get()->result();
        if (!empty($result) && intval($result[0]->cnt)) {
            return true;
        } else {
            return false;
        }
    }

    private function getModerationItemId($type_name, $obj_id)
    {
        $type_data = $this->get_moderation_type($type_name);
        $type_id   = intval($type_data["id"]);

        $this->ci->db->select('id')
            ->from(MODERATION_ITEMS_TABLE)
            ->where('id_type', $type_id)
            ->where('id_object', $obj_id);
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->id);
        } else {
            return false;
        }
    }

    public function getModerationItem($id)
    {
        $id = intval($id);
        if (!$id) {
            return false;
        }
        $this->ci->db->select('id, id_type, id_object, date_add')->from(MODERATION_ITEMS_TABLE)->where("id",
            $id);
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return get_object_vars($result[0]);
        } else {
            return false;
        }
    }

    public function deleteModerationItemById($id)
    {
        if (!$id) {
            return false;
        }

        $this->ci->db->delete(MODERATION_ITEMS_TABLE, ['id' => $id]);
        return;
    }

    public function deleteModerationItemsByTypeId($type_id)
    {
        if (!intval($type_id)) {
            return false;
        }

        $results = $this->ci->db->select('id')
            ->from(MODERATION_ITEMS_TABLE)
            ->where('id_type', $type_id)
            ->get()
            ->result_array();

        $ids = [];

        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $ids[] = $result['id'];
            }
            unset($results);
        }

        $this->ci->db->where('id_type', $type_id)
            ->delete(MODERATION_ITEMS_TABLE);

        if (!empty($ids)) {
            $this->sendEvent(self::EVENT_OBJECT_CHANGED,
                [
                'id' => $ids,
                'type' => self::TYPE_MODERATION_ITEM,
                'status' => self::STATUS_DELETED,
            ]);
        }

        return;
    }

    public function deleteModerationItemByObj($type_name, $obj_id)
    {
        $type_data = $this->getModerationType($type_name);
        $type_id   = intval($type_data["id"]);

        if (is_array($obj_id) && count($obj_id)) {
            $obj_id_arr = $obj_id;
        } elseif (is_numeric($obj_id) && $obj_id > 0) {
            $obj_id_arr[] = intval($obj_id);
        } else {
            return false;
        }

        $results = $this->ci->db->select('id')
            ->from(MODERATION_ITEMS_TABLE)
            ->where('id_type', $type_id)
            ->where_in('id_object', $obj_id_arr)
            ->get()
            ->result_array();

        $ids = [];

        if (!empty($results) && is_array($results)) {
            foreach ($results as $result) {
                $ids[] = $result['id'];
            }
            unset($results);
        }

        $this->ci->db->where('id_type', $type_id)
            ->where_in('id_object', $obj_id_arr)
            ->delete(MODERATION_ITEMS_TABLE);

        if (!empty($ids)) {
            $this->sendEvent(self::EVENT_OBJECT_CHANGED, [
                'id' => $ids,
                'type' => self::TYPE_MODERATION_ITEM,
                'status' => self::STATUS_DELETED,
            ]);
        }

        return;
    }

    public function getModerationListCount($type_name = "")
    {
        if ($type_name) {
            $type_data = $this->get_moderation_type($type_name);
            $this->ci->db->where('id_type', $type_data["id"]);
        }
        $this->ci->db->select('COUNT(*) AS cnt')->from(MODERATION_ITEMS_TABLE);
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->cnt);
        } else {
            return 0;
        }
    }

    public function getModerationList($type_name = "", $page = null, $list_per_page
                              = null, $parse_html = true)
    {
        $this->ci->db->select('id, id_type, id_object, date_add')->from(MODERATION_ITEMS_TABLE);
        if ($type_name) {
            $type_data = $this->getModerationType($type_name);
            $this->ci->db->where('id_type', $type_data["id"]);
        }

        $this->ci->db->order_by("date_add DESC");
        if (!is_null($page) && !is_null($list_per_page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($list_per_page, $list_per_page * ($page - 1));
        }

        $result = $this->ci->db->get()->result();
        if (empty($result)) {
            return false;
        }

        foreach ($result as $item) {
            $type = $this->getModerationTypeById($item->id_type);
            $item->type_name = $type["name"];
            $item->type = $type;
            $object_ids[$item->type_name][] = $item->id_object;
            if (strlen($type["view_link"])) {
                $item->view_link = site_url() . $type["view_link"] . $item->id_object;
            }
            if (strlen($type["edit_link"])) {
                $item->edit_link = site_url() . $type["edit_link"] . $item->id_object;
            }
            if (strlen($type["method_delete_object"])) {
                $item->avail_delete = true;
            }
            if (strlen($type["method_mark_adult"])) {
                $item->mark_adult = true;
            }
            if (strlen($type["method_set_status"]) && intval($type["allow_to_decline"])) {
                $item->avail_decline = true;
            }
            $list[] = get_object_vars($item);
        }

        if ($parse_html && isset($object_ids) && is_array($object_ids)) {
            foreach ($object_ids as $type_name => $ids) {
                /// получем параметры типа
                $type = $this->types[$type_name];
                if ($type["method_get_list"]) {
                    /// подключаем модель
                    $model_name = ucfirst($type["model"]);
                    $model_path = strtolower($type["module"] . "/models/") . $model_name;
                    $this->ci->load->model($model_path);

                    /// получаем данные обектов по ids (возвращается массив: id_object => object_data)
                    $objects_data[$type_name] = $this->ci->{$model_name}->{$type["method_get_list"]}($ids);
                }
            }

            foreach ($list as $key => $item) {
                if (isset($objects_data[$item["type_name"]][$item["id_object"]])) {
                    /// assign в шаблон, складываем html в переменную
                    $this->ci->view->assign('data', $objects_data[$item["type_name"]][$item["id_object"]]);
                    $list[$key]["user_data"] = $objects_data[$item["type_name"]][$item["id_object"]];
                    $list[$key]["html"] = $this->ci->view->fetch($item["type"]["template_list_row"], 'admin', $item["type"]["module"]);
                }
            }
        }

        return $list;
    }

    /**
     * Moderation Object
     *
     * @param array $params
     *
     * @return array
     */
    public function getModerationObject(array $params)
    {
        $this->ci->db->select((implode(',', $this->fields[self::MODULE_TABLE])));
        $this->ci->db->from(self::MODULE_TABLE);
        if (isset($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        if (isset($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }
        if (isset($params['where_sql'])) {
            foreach ($params['where_sql'] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }
        $result = current($this->ci->db->get()->result_array());
        if (!empty($result)) {
            $type = $this->getModerationTypeById($result['id_type']);
            if ($type["method_get_list"]) {
                $model_name = ucfirst($type["model"]);
                $model_path = strtolower($type["module"] . "/models/") . $model_name;
                $this->ci->load->model($model_path);
                return $this->ci->{$model_name}->{$type["method_get_list"]}([$result['id_object']]);
            }
        }
        return false;
    }

    public function getModerationByObjectIds($ids)
    {
        return $this->ci->db->select(implode(',', $this->fields[self::MODULE_TABLE]))
                ->from(self::MODULE_TABLE)
                ->where_in('id_object', $ids)
                ->get()
                ->result_array();
    }

    public function getModerationByIds($ids)
    {
        return
                $this->ci->db->select(implode(',',
                        $this->fields[self::MODULE_TABLE]))
                ->from(self::MODULE_TABLE)
                ->where_in('id', $ids)
                ->order_by(self::SORT_DEFAULT)
                ->get()
                ->result_array();
    }

    public function formatModerationObjects($data, $is_generate_html = true, $template
                              = '')
    {
        $types = $this->ci->Moderation_type_model->get_types();
        foreach ($types as $type) {
            $this->types[$type['id']]   = $type;
            $this->types[$type['name']] = $type;
        }

        $group_object_ids_by_type = [];

        foreach ($data as $key => $item) {
            if (!isset($this->types[$item['id_type']])) {
                $data[$key] = [];
                continue;
            }

            $item['type'] = $this->types[$item['id_type']];

            $item['type_name'] = $item['type']['name'];

            if (strlen($item['type']['view_link'])) {
                $item['view_link'] = site_url() . $item['type']['view_link'] . $item['id_object'];
            }

            if (strlen($item['type']['edit_link'])) {
                $item['edit_link'] = site_url() . $item['type']['edit_link'] . $item['id_object'];
            }

            if (strlen($item['type']['method_delete_object'])) {
                $item['avail_delete'] = true;
            }

            if (strlen($item['type']['method_mark_adult'])) {
                $item['mark_adult'] = true;
            }

            if (strlen($item['type']['method_set_status']) && intval($item['type']['allow_to_decline'])) {
                $item['avail_decline'] = true;
            }

            $group_object_ids_by_type[$item['type_name']][] = $item['id_object'];

            $data[$key] = $item;
        }

        if ($is_generate_html && !empty($group_object_ids_by_type)) {
            $objects_data = [];

            foreach ($group_object_ids_by_type as $type_name => $ids) {
                $type = $this->types[$type_name];
                if ($type["method_get_list"]) {
                    $model_name = ucfirst($type["model"]);
                    $model_path = strtolower($type["module"] . "/models/") . $model_name;
                    $this->ci->load->model($model_path);
                    $objects_data[$type_name] = $this->ci->{$model_name}->{$type["method_get_list"]}($ids);
                }
            }

            foreach ($data as $key => $item) {
                if (isset($objects_data[$item["type_name"]][$item["id_object"]])) {
                    $this->ci->view->assign('template', $template);
                    $objects_data[$item["type_name"]][$item["id_object"]]['dashboard_status'] = $item["dashboard_status"];

                    $this->ci->view->assign('data', $objects_data[$item["type_name"]][$item["id_object"]]);
                    if (isset($objects_data[$item["type_name"]][$item["id_object"]]['admin_link'])) {
                        $data[$key]["admin_link"] = $objects_data[$item["type_name"]][$item["id_object"]]['admin_link'];
                    }

                    $data[$key]["html"] = $this->ci->view->fetch($item["type"]["template_list_row"], 'admin', $item["type"]["module"]);
                } else {
                    $data[$key]["html"] = '';
                }
            }
        }

        return $data;
    }

    public function convertToListByIds($data)
    {
        $data_by_ids = [];

        foreach ($data as $value) {
            $data_by_ids[$value['id']] = $value;
        }

        return $data_by_ids;
    }

    public function formatDashboardRecords($data)
    {
        $format_data = $this->formatModerationObjects($data, true, 'dashboard');

        foreach ($format_data as $key => $value) {
            $this->ci->view->assign('data', $value);
            $format_data[$key]['content'] = $this->ci->view->fetch('dashboard', 'admin', 'moderation');
        }

        return $format_data;
    }

    public function getDashboardData($object_id, $status)
    {
        if ($status != self::STATUS_ADDED) {
            return false;
        }
        $object = $this->get_moderation_item($object_id);
        $type   = $this->get_moderation_type_by_id($object['id_type']);
        if (ucfirst($type['module']) . '_model' == $type['model']) {
            $model_path = $type['model'];
        } else {
            $model_path = $type['module'] . '/models/' . $type['model'];
        }
        $this->ci->load->model($model_path);
        if (method_exists($this->ci->{$type['model']}, 'getDashboardOptions')) {
            $object = array_merge($object,
                $this->ci->{$type['model']}->getDashboardOptions($object['id_object']));
        } else {
            $object['dashboard_header']      = 'header_moderation_object';
            $object['dashboard_action_link'] = 'admin/moderation';
        }
        return $object;
    }

    /**
     * Get moderation data
     *
     * @param string $type
     *
     * @return array
     */
    public function getModerationData($type)
    {
        $id_type = $this->getModerationType($type)['id'];
        $this->ci->db->select(implode(',', $this->fields[self::MODULE_TABLE]));
        $this->ci->db->from(self::MODULE_TABLE);
        $this->ci->db->where('id_type', $id_type);
        return $this->ci->db->get()->result_array();
    }

    public function declineModerationData($user_id)
    {
        $this->ci->load->model('menu/models/Indicators_model');
        $type_data = $this->ci->Moderation_type_model->getModerationType([
            'where' => ['method_set_status !=' => '']
        ]);
        foreach ($type_data as $data) {
            if ($data['is_user_delete'] != 0) {
                $this->ci->load->model($data['module'] . '/models/' . $data['model']);
                if (method_exists($this->ci->{$data['model']}, 'getModerationIdsByUserId')) {
                    $ids = $this->ci->{$data['model']}->getModerationIdsByUserId($user_id);
                    $this->deleteModerationItemByObj($data['name'], $ids);
                    if (!empty($ids)) {
                        foreach ($ids as $id) {
                            $this->ci->{$data['model']}->{$data["method_set_status"]}($id, 0);
                             $this->ci->Indicators_model->delete('new_moderation_item', $id, true);
                        }
                    }
                }
            }
        }
    }

    public function installBatch(array $data)
    {
        foreach ($data as $type => $items) {
            $id_type = $this->getModerationType($type)['id'];
            if ($id_type) {
                foreach ($items as $item) {
                    $this->ci->db->insert(MODERATION_ITEMS_TABLE, [
                        'id_type' => $id_type,
                        'id_object' => $item['id_object'],
                        'date_add' => $item['date_add'],
                    ]);
                    $item_id = $this->ci->db->insert_id();
                    $this->ci->load->model('menu/models/Indicators_model');
                    $this->ci->Indicators_model->add('new_moderation_item', $item['id_object'], $item['id_user']);
                    $this->sendEvent(self::EVENT_OBJECT_CHANGED, [
                        'id' => $item_id,
                        'type' => self::TYPE_MODERATION_ITEM,
                        'status' => self::STATUS_ADDED,
                    ]);
                }
            }
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'add_moderation_item' => 'addModerationItem',
            'delete_moderation_item_by_id' => 'deleteModerationItemById',
            'delete_moderation_item_by_obj' => 'deleteModerationItemByObj',
            'delete_moderation_items_by_type_id' => 'deleteModerationItemsByTypeId',
            'get_moderation_item' => 'getModerationItem',
            'get_moderation_list' => 'getModerationList',
            'get_moderation_list_count' => 'getModerationListCount',
            'get_moderation_type' => 'getModerationType',
            'get_moderation_type_by_id' => 'getModerationTypeById',
            'get_moderation_type_status' => 'getModerationTypeStatus',
            'isset_moderation_item' => 'issetModerationItem',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
