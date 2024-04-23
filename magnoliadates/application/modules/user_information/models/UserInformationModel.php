<?php

declare(strict_types=1);

namespace Pg\modules\user_information\models;

/**
 * user_information module
 *
 * @copyright   Copyright (c) 2000-2019
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class UserInformationModel extends \Model
{
    /**
     * Module GUID
     *
     * @var string
     */
    const MODULE_GID = 'user_information';

    /**
     * DB table name
     *
     * @var string
     */
    const UI_TABLE = DB_PREFIX . self::MODULE_GID;

    /**
     * Status archive user information (pending)
     *
     * @var string
     */
    const PENDING = 'pending';

    /**
     * Status archive user infomation (during)
     *
     * @var string
     */
    const DURING = 'during';

    /**
     * Status archive user infomation (ready)
     *
     * @var string
     */
    const READY = 'ready';

    /**
     * Date format
     *
     * @var string
     */
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Archive extension
     *
     * @var string
     */
    const EXT = '.zip';

    /**
     * Modules object properties
     *
     * @var array
     */
    private $fields = [
        self::UI_TABLE => [
            'id', 'user_id', 'lang_id', 'nickname', 'data', 'status', 'date_created', 'date_modified', 'notified'
        ]
    ];

    /**
     * Statuses archive user infomation
     *
     * @var array
     */
    public $statuses = [
        self::PENDING,
        self::DURING,
        self::READY
    ];

    /**
     * User ID
     *
     * @var int
     */
    public $user_id;

    /**
     * Return archive information
     *
     * @param int $user_id user identifier
     *
     * @return array
     */
    public function getArchive(int $user_id): array
    {
        $this->ci->db->select(implode(", ", $this->fields[self::UI_TABLE]));
        $this->ci->db->from(self::UI_TABLE);
        $this->ci->db->where('user_id', $user_id);
        $data = $this->ci->db->get()->result_array();
        return !empty($data) ? $this->formateArchive(current($data)) : [];
    }

    /**
     * Return archives information
     *
     * @param array $params
     *
     * @return array
     */
    public function getArchives($params = []): array
    {
        $this->ci->db->select(implode(", ", $this->fields[self::UI_TABLE]));
        $this->ci->db->from(self::UI_TABLE);
        if (isset($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }
        return $this->formateArchives($this->ci->db->get()->result_array());
    }

    /**
     * Check archive information in the database
     *
     * @param int $user_id user identifier
     *
     * @return boolean
     */
    public function isArchive(int $user_id): bool
    {
        $this->ci->db->select('COUNT(id) AS cnt');
        $this->ci->db->from(self::UI_TABLE);
        $this->ci->db->where('user_id', $user_id);
        return (bool) $this->ci->db->get()->result_array()[0]['cnt'];
    }

    /**
     * Validation of information when creating an archive
     *
     * @param array $data
     *
     * @return array
     */
    public function validateArchive(array $data): array
    {
        return $data;
    }

    /**
     * Formatting information when creating an archive
     *
     * @param array $data
     *
     * @return array
     */
    public function formateArchive(array $data): array
    {
        return $data;
    }

    /**
     * Formatting information when creating an archives
     *
     * @param array $data
     *
     * @return array
     */
    public function formateArchives(array $data): array
    {
        $ids = [];
        $result = [];
        if (!empty($data)) {
            foreach ($data as $value) {
                $ids[] = $value['user_id'];
            }
            $users = $this->ci->Users_model->getUsersListByKey(null, null, null, [], $ids, false);
            foreach ($data as $value) {
                $result[$value['user_id']]['archive_id'] = $value['id'];
                $result[$value['user_id']]['status'] = $value['status'];
                $result[$value['user_id']]['data'] = unserialize($value['data'], ['allowed_classes' => false]);
                $result[$value['user_id']]['user'] = $users[$value['user_id']];
                $result[$value['user_id']]['user_id'] = $value['user_id'];
                $result[$value['user_id']]['lang_id'] = $value['lang_id'];
                $result[$value['user_id']]['nickname'] = $value['nickname'];
                $result[$value['user_id']]['date_created'] = $value['date_created'];
            }
        }
        return $result;
    }

    /**
     * Saving information
     *
     * @param int|null $id identifier archive
     * @param array $data user information
     *
     * @return integer
     */
    public function saveArchive($id, array $data)
    {
        if (is_null($id)) {
            $this->ci->db->insert(self::UI_TABLE, $data);
            $id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $id);
            $this->ci->db->update(self::UI_TABLE, $data);
        }
        return $id;
    }

    /**
     * Create user information
     *
     * @param array $modules
     *
     * @return array
     */
    public function create($modules = []): array
    {
        $return = [];
        if ($this->isArchive($this->user_id) === false) {
            $date = date(self::DATE_FORMAT);
            $this->saveArchive(null, [
                'user_id' => $this->user_id,
                'nickname' => $this->ci->session->userdata('nickname'),
                'data' => serialize($modules),
                'status' => self::PENDING,
                'date_created' => $date,
                'notified' => 1,
                'lang_id' => $this->pg_language->current_lang_id
            ]);
            $return['success'] = l('success_pending', 'user_information');
        } else {
            $return = $this->getArchive($this->user_id);
            $return['info'] = l('success_pending', 'user_information');
        }
        return $return;
    }

    /**
     * Delete user information
     *
     * @return array
     */
    public function delete(): array
    {
        $this->deleteArchive(['where' => [
            'user_id' => $this->user_id
        ]]);

        return ['success' => l('success_deleted', 'user_information')];
    }

    /**
     * Status archive
     *
     * @param integer $user_id
     *
     * @return array
     */
    public function status(int $user_id): array
    {
        $this->ci->db->select(implode(", ", $this->fields[self::UI_TABLE]));
        $this->ci->db->from(self::UI_TABLE);
        $this->ci->db->where('user_id', $user_id);

        return (array)current($this->ci->db->get()->result_array());
    }

    /**
     * Backend request notifications
     *
     * @return boolean|array
     */
    public function backendGetRequestNotifications()
    {
        $params = [
            'where' => [
                'user_id' => $this->user_id,
                'status' => 'ready',
                'notified' => 1
            ]
        ];
        $archive = current($this->getArchives($params));
        $result = ['notifications' => []];
        if (!empty($archive)) {
            $link = site_url() . 'users/settings/download_my_data';
            $result['notifications'][] = [
                'title' => l('success_ready', 'user_information'),
                'text' => '<a href="' . $link . '">' . l('success_ready_description', 'user_information') . '</a>'
            ];
            $this->ci->db->set('notified', '0')->where($params['where'])->update(self::UI_TABLE);
            return $result;
        }
        return false;
    }

    /**
     * Delete user information
     *
     * @param array $params
     *
     * @return void
     */
    public function deleteArchive(array $params)
    {
        $this->ci->load->model('Uploads_model');
        $archives = $this->getArchives($params);

        if (!empty($archives)) {
            $ids = [];
            foreach ($archives as $archive) {
                $ids[] = $archive['archive_id'];
                $this->ci->Uploads_model->deleteUpload(self::MODULE_GID, self::secretPath($archive), self::nameArchive($archive['nickname']));
            }
            $this->ci->db->where_in('id', $ids);
            $this->ci->db->delete(self::UI_TABLE);
        }
    }

    /**
     * Secret path to the archive
     *
     * @param array $data user data
     *
     * @return string
     */
    public static function secretPath(array $data): string
    {
        $path = substr(md5($data['user_id']), 20);
        $date_created = explode(' ', $data['date_created']);
        $date_data = explode(':', $date_created[0]);
        $time_data = explode(':', $date_created[1]);
        foreach ($date_data as $d) {
            $path .= '/' . substr(md5($d), 20);
        }
        foreach ($time_data as $t) {
            $path .= '/' . substr(md5($t), 20);
        }
        return $path;
    }

    /**
     * Archive name
     *
     * @param string $name
     *
     * @return string
     */
    public static function nameArchive(string $name): string
    {
        $domain = filter_input(INPUT_SERVER, 'SERVER_NAME') ?: $_SERVER["HTTP_HOST"] ;

        return $domain . '-' . $name . self::EXT;
    }

    /**
     * Create archive by crown
     *
     *  @return void
     */
    public function cronArchiveCreate()
    {
        $this->ci->load->model('user_information/models/User_information_modules_model');
        $data = $this->getArchives(['where' => ['status' => self::PENDING]]);
        $this->ci->User_information_modules_model->archiveCreate($data);
    }

    /**
     * Create archive by crown
     *
     *  @return void
     */
    public function cronArchiveDelete()
    {
        $this->deleteArchive(['where' => [
            'status' => self::READY,
            'date_modified + INTERVAL 2 DAY <=' => date(self::DATE_FORMAT)
        ]]);
    }

    public function __call($name, $args)
    {
        $methods = [
            'backend_get_request_notifications' => 'backendGetRequestNotifications'
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $name);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
