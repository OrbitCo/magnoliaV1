<?php

declare(strict_types=1);

namespace Pg\modules\landings\models;

if (!defined('LANDINGS_TABLE')) {
    define('LANDINGS_TABLE', DB_PREFIX . 'landings');
}

/* *
 * Landings model
 * @package     PG_Dating
 * @subpackage  application
 * @category    modules
 * @copyright   Copyright (c) 2000-2015 PG_Dating - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class LandingsModel extends \Model
{

    const DB_DATE_FORMAT = 'Y-m-d H:i:s';
    const DB_DATE_FORMAT_SEARCH = 'Y-m-d H:i';
    const DB_DEFAULT_DATE = '0000-00-00 00:00:00';

    /**
     * Routes php
     *
     * @var string
     */
    const ROUTE_PHP_FILE = "config/landings_module_routes.php";

    /**
     * Upload path
     *
     * @var string
     */
    const UPLOAD_PATH = 'landings/';

    /**
     * Landings properties in database
     *
     * @var array
     */
    private $fields = [
        LANDINGS_TABLE => [
            'id',
            'gid',
            'name',
            'link',
            'index_path',
            'is_active',
            'date_created',
            'url_page',
            'is_default_land',
        ],
    ];

    /**
     * Add landing
     *
     * @param int   $landing_id
     * @param array $landing
     *
     * @return int $landing_id
     */
    public function saveLanding($landing_id = null, $landing)
    {
        $landing["date_created"] = date(self::DB_DATE_FORMAT);

        if (isset($landing['upload_delete'])) {
            if ($landing['upload_delete'] == 1) {
                $landing_path = SITE_PHYSICAL_PATH . UPLOAD_DIR . self::UPLOAD_PATH . $landing_id;
                $this->Landings_model->removeDirectoryRecursive($landing_path);
            }
            unset($landing['upload_delete']);
        }

        if (isset($landing['is_default_land']) && $landing['is_default_land']) {
             $this->ci->db->where('is_default_land', 1);
             $this->ci->db->update(LANDINGS_TABLE, ['is_default_land' => 0]);
        }

        if (is_null($landing_id)) {
            $this->ci->db->insert(LANDINGS_TABLE, $landing);
            $landing_id = $this->ci->db->insert_id();
        } else {
            $this->ci->db->where('id', $landing_id);
            $this->ci->db->update(LANDINGS_TABLE, $landing);
        }

        $this->generateLandingsLinksFile();

        return $landing_id;
    }

    /**
     * Delete landing
     *
     * @param int $landing_id
     *
     * @return void
     */
    public function deleteLanding($landing_id)
    {
        $landing = $this->getLandingById($landing_id);
        if (!empty($landing['id'])) {
            $this->ci->db->where('id', $landing_id)->delete(LANDINGS_TABLE);

            $landing_path = SITE_PHYSICAL_PATH . UPLOAD_DIR . self::UPLOAD_PATH . $landing_id;
            if (is_dir($landing_path)) {
                $this->Landings_model->removeDirectoryRecursive($landing_path);
            }
            $this->generateLandingsLinksFile();
        }
    }

    /**
     * Activate landing
     *
     * @param int $landing_id
     *
     * @return void
     */
    public function activateLanding($landing_id, $status = 1)
    {
        $landing["is_active"] = intval($status);

        // if ($landing['is_active'] == 1) {
        //     $this->ci->db->where('is_active', 1);
        //     $this->ci->db->update(LANDINGS_TABLE, array('is_active' => 0));
        // }

        $this->ci->db->where('id', $landing_id);
        $this->ci->db->update(LANDINGS_TABLE, $landing);
        $this->generateLandingsLinksFile();
    }

    /**
     * Get landing by id
     *
     * @param int $landing_id
     *
     * @return array $return
     */
    public function getLandingById($landing_id)
    {
        $this->ci->db->select(implode(", ", $this->fields[LANDINGS_TABLE]))
                ->from(LANDINGS_TABLE)
                ->where("id", $landing_id);

        $result = $this->ci->db->get()->result_array();

        if (!empty($result)) {
            $return = $result[0];
        } else {
            $return = [];
        }

        return $return;
    }

    /**
     * Get landings count
     *
     * @param array $params
     * @param array $filter_object_ids
     *
     * @return int $return
     */
    public function getLandingsCount($params = [], $filter_object_ids = [])
    {
        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["like"]) && is_array($params["like"]) && count($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (isset($filter_object_ids) && is_array($filter_object_ids) && count($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        $return = $this->ci->db->count_all_results(LANDINGS_TABLE);

        return $return;
    }

    /**
     * Get landings list
     *
     * @params int $page
     * @params int $items_on_page
     * @params string $order_by
     * @params array $params
     * @params array $filter_object_ids
     *
     * @return array $return
     */
    public function getLandingsList($page = null, $items_on_page = null, $order_by = null, $params = [], $filter_object_ids = [])
    {
        $this->ci->db->select(implode(", ", $this->fields[LANDINGS_TABLE]));
        $this->ci->db->from(LANDINGS_TABLE);

        if (isset($params["where"]) && is_array($params["where"]) && count($params["where"])) {
            foreach ($params["where"] as $field => $value) {
                $this->ci->db->where($field, $value);
            }
        }

        if (isset($params["like"]) && is_array($params["like"]) && count($params["like"])) {
            foreach ($params["like"] as $field => $value) {
                $this->ci->db->like($field, $value);
            }
        }

        if (isset($params["where_in"]) && is_array($params["where_in"]) && count($params["where_in"])) {
            foreach ($params["where_in"] as $field => $value) {
                $this->ci->db->where_in($field, $value);
            }
        }

        if (isset($params["where_sql"]) && is_array($params["where_sql"]) && count($params["where_sql"])) {
            foreach ($params["where_sql"] as $value) {
                $this->ci->db->where($value, null, false);
            }
        }

        if (!empty($filter_object_ids) && is_array($filter_object_ids)) {
            $this->ci->db->where_in("id", $filter_object_ids);
        }

        if (is_array($order_by) && count($order_by) > 0) {
            foreach ($order_by as $field => $dir) {
                $this->ci->db->order_by($field . " " . $dir);
            }
        }

        if (!is_null($page)) {
            $page = intval($page) ? intval($page) : 1;
            $this->ci->db->limit($items_on_page, $items_on_page * ($page - 1));
        }

        $return = $this->ci->db->get()->result_array();

        return $return;
    }

    /**
     * Validate landing
     *
     * @param array $landing_data
     *
     * @return array $return
     */
    public function validate($landing_id = null, $landing_data = [])
    {
        $this->ci->config->load('reg_exps', true);

        if (isset($landing_data['name'])) {
            $return['data']['name'] = strip_tags($landing_data['name']);
        }

        if (isset($landing_data['is_active'])) {
            $return['data']['is_active'] = intval($landing_data['is_active']);
        }

        if (isset($landing_data['upload_delete'])) {
            $return['data']['upload_delete'] = intval($landing_data['upload_delete']);
        }

        if (isset($landing_data['url_page'])) {
            if ($landing_data['url_page']) {
                $return['data']['url_page'] = $landing_data['url_page'];
            } else {
                $return['data']['url_page'] = null;
            }
        }

        if (isset($landing_data['is_default_land'])) {
            $return['data']['is_default_land'] = intval($landing_data['is_default_land']);
        }

        if (isset($landing_data['link'])) {
            $return['data']['link'] = strtolower(strip_tags($landing_data['link']));
            if (!empty($return['data']['link'])) {
                $return['data']['link'] = str_replace(site_url(), '', $return['data']['link']);
                $params = ['where' => ['link' => $return['data']['link']]];
                if (!is_null($landing_id)) {
                    $params['where']['id <>'] = $landing_id;
                }
                $count = $this->getLandingsCount($params);
                if ($count > 0) {
                    $return["errors"]['link'] = l('error_link_already_exists', 'landings');
                }
            } else {
                $return['errors']['link'] = l('error_url_incorrect', 'landings');
            }
        }

        return $return;
    }

    /**
     * Upload landing page
     *
     * @param int $landing_id
     *
     * @return array $return
     */
    public function uploadLandingArchive($landing_id = null)
    {
        if (isset($_FILES['landing_file']) && is_array($_FILES['landing_file']) && is_uploaded_file($_FILES['landing_file']['tmp_name']) && $landing_id != null) {
            $this->ci->load->helper('upload');

            $record_path = SITE_PHYSICAL_PATH . UPLOAD_DIR . self::UPLOAD_PATH . $landing_id;
            $upload_config = [
                'allowed_types' => 'zip',
                'overwrite' => true,
            ];

            if (!is_dir($record_path)) {
                mkdir($record_path, 0777, true);
            }

            $archive = upload_file('landing_file', $record_path, $upload_config);

            $new_file_name = $record_path . '/landing.zip';
            if (rename_file($archive['data']['full_path'], $new_file_name)) {
                $archive['data']['full_path'] = $new_file_name;
            }

            $return = $this->extractLandingFiles($archive, $landing_id);
            unlink($archive['data']['full_path']);

            return $return;
        }
    }

    /**
     * Extract landing page archive
     *
     * @param array $archive
     *
     * @return array $archive
     */
    public function extractLandingFiles($archive, $landing_id)
    {
        $this->ci->load->library('Unzip');

        $this->ci->unzip->initialize([
            'fileName' => $archive['data']['full_path'],
            'targetDir' => $archive['data']['file_path'],
        ]);

        $files_array = $this->ci->unzip->getList();

        $index_path = $this->searchIndexFile($files_array);
        if ($index_path == false) {
            $archive['errors'][] = l('error_missed_index_file', 'landings');
        } else {
            $archive['data']['file'] = $index_path;
        }

        if (empty($archive['errors'])) {
            $this->removeDirectoryRecursive($archive['data']['file_path'], true);
            $this->ci->unzip->unzipAll();
            $this->configIndexFile($archive['data']['file_path'], $archive['data']['file'], $landing_id);
        }

        return $archive;
    }

    /**
     * Generate landing links file
     *
     * @return void
     */
    public function generateLandingsLinksFile()
    {
        $file_name = SITE_PHYSICAL_PATH . APPLICATION_FOLDER . self::ROUTE_PHP_FILE;

        $handle = fopen($file_name, 'w');

        if (!$handle) {
            return;
        }

        $params['where']['is_active'] = 1;
        $landings = $this->getLandingsList(null, null, null, $params);

        $content = "<?php\n\n" . '$landing_data = array(' . "\n";

        foreach ($landings as $key => $value) {
            $path = $value['id'] . '/' . $value['index_path'];
            $link = rtrim($value['link'], '/');
            $link = preg_replace('#/index$#i', '', $link);
            $content .= "   '/" . $link . "' => '" . $path . "',\n";
        }

        $content .= ');';

        fputs($handle, $content);
        fclose($handle);
    }

    /**
     * Remove upload directory
     *
     * @param string $dir
     *
     * @return bool
     */
    public function removeDirectoryRecursive($dir, $is_clean = false)
    {
        $files = array_diff(scandir($dir), ['.', '..']);

        foreach ($files as $file) {
            if (is_dir($dir . '/' . $file)) {
                $this->removeDirectoryRecursive($dir . '/' . $file);
            } elseif (file_exists($dir . '/' . $file) && $is_clean) {
                if ($file != 'landing.zip') {
                    unlink($dir . '/' . $file);
                }
            } elseif (file_exists($dir . '/' . $file)) {
                unlink($dir . '/' . $file);
            }
        }

        if (!$is_clean) {
            return rmdir($dir);
        }
    }

    /**
     * Config index file
     *
     * @param string $file_name
     * @param int    $landing_id
     *
     * @return void
     */
    public function configIndexFile($upload_path, $index_path, $landing_id)
    {
        $base_path = UPLOAD_DIR . self::UPLOAD_PATH . $landing_id;
       
        $file_name = $upload_path . $index_path;
        $subfolder_name = dirname($index_path);

        $content = file_get_contents($file_name);
        $content = str_replace('[site_url]', site_url(), $content);

        if ($subfolder_name != '.') {
            $content = str_replace('[site_path]', site_url() . '/' . $base_path . '/' . $subfolder_name . '/', $content);
        } else {
            $content = str_replace('[site_path]', site_url() . $base_path . '/', $content);
        }

        $handle = fopen($file_name, 'w');
        fputs($handle, $content);
        fclose($handle);
    }

    /**
     * Search index file in subfolders
     *
     * @param array $files
     *
     * @return mixed
     */
    public function searchIndexFile($files)
    {
        if (isset($files['index.html'])) {
            return 'index.html';
        } elseif (isset($files['index.php'])) {
            return 'index.php';
        } else {
            foreach ($files as $key => $value) {
                $chunks = explode('/', $key);

                if ((sizeof($chunks) == 2) && ($chunks[1] == 'index.php' || $chunks[1] == 'index.html')) {
                    return $key;
                }
            }
        }

        return false;
    }
}
