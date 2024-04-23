<?php
namespace Pg\modules\users\models;

use Pg\libraries\Cache\Manager as CacheManager;

if (!defined('USERS_TABLE')) {
    define('USERS_TABLE', DB_PREFIX . 'users');
}


if (!defined('BASEPATH')) {

    exit('No direct script access allowed');

}

class UsersImportBaseModel extends \Model

{
    public function __construct()
    {
        parent::__construct();
        $this->ci->load->model('Users_model');
    }

    public function generateRandomString($length = 5) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function cronImportBase() {
        set_time_limit(0);
        $time_start = microtime(true);

        $tableName = "2500_PHILIPINES";                                       // Указываем имя таблицы из которой будем переносить данные
        $fotoDirection = SITE_PHYSICAL_PATH . "temp/import_users/2500_PHILIPINES/";      // Указываем путь к фото
        $usersByTime = 10;                                                 // В зависимости от производительности сервера выставлям количество обрабатываемых профилей
        $deltaId = 10000;                                                // Разница между текущим (последнем) профилем и профилем из базы

        $addImage = true;
        $addGalleryImage = true;

        $last_id = $this->ci->pg_module->get_module_config('users', 'import_last_user_id');
        $age_min = $this->ci->pg_module->get_module_config('users', 'age_min');
        $age_max = $this->ci->pg_module->get_module_config('users', 'age_max');

        $this->ci->load->model('Uploads_model');
        $this->ci->load->model('Media_model');

        $fieldIdName = 'id';
        $fields = $fieldIdName.', name, email, gender, birthday, country, city, Height, Description';
        $fieldsAccordance = [
            'email' => 'email',
            'birth_date' => 'birthday',
            'fe_about_me' => 'Description',
        ];
        
        $this->ci->db->select($fields);
        $this->ci->db->from($tableName);
        $this->ci->db->order_by($fieldIdName.' ASC');
        $this->ci->db->limit($usersByTime);
        if ($last_id > 0) {
            $this->ci->db->where($fieldIdName.' > ' . $last_id);
        }

        $rawData = $this->ci->db->get()->result_array();
        
        foreach ($rawData as $rawUserData) {
            $a = explode(' ', $rawUserData['name']);
            $rawUserData['name'] = $a[0];

            if (strlen($rawUserData['name']) < 6) {
                $s = $this->generateRandomString();
                $rawUserData['name'] .= $s;
                $user['fname'] = $user['nickname'] = $rawUserData['name'];
            } else {
                $user['fname'] = $user['nickname'] = $rawUserData['name'];
            }

            $user = [
                'id' => $rawUserData[$fieldIdName] + $deltaId,
                'import_id' => $rawUserData['id'],
                'lang_id' => 1,
                'approved' => 1,
                'activity' => 1,
                'confirm' => 1,
                'group_id' => 1,
                'age_min' => $age_min,
                'age_max' => $age_max,
                'age' => date('Y') - date('Y', strtotime($rawUserData['birthday'])),
                'nickname' => $rawUserData['name'],
                'fname' => $rawUserData['name'],
                'search_field' => $rawUserData['name'].';',
                'date_created' => date(\Pg\modules\users\models\UsersModel::DB_DATE_FORMAT),
                'date_modified' => date(\Pg\modules\users\models\UsersModel::DB_DATE_FORMAT),
                'date_last_activity' => date(\Pg\modules\users\models\UsersModel::DB_DATE_FORMAT),
                'baseName' => $tableName,
            ];

            foreach ($fieldsAccordance as $key => $value){
                $user[$key] = $rawUserData[$value];
            }

            $this->ci->load->model('Users_model');
            $existing_user = $this->ci->Users_model->getUserByEmail($user['email']);

            if (!empty($existing_user)) {
                $this->ci->pg_module->set_module_config('users', 'import_last_user_id', $user['id']);
                continue;
            }

            $user['user_type'] = ($rawUserData['gender'] == 'Female') ? 'female' : 'male';
            $user['looking_user_type'] = ($user['user_type'] == 'male') ? 'female' : 'male';

            if (empty($user['fe_about_me'])) {
                $user['fe_about_me'] = ' ';
            }

            /* switch ($rawUserData['body']) {
                case "Average":
                    $user['fe_body'] = 2;
                    break;

                case "Athletic":
                    $user['fe_body'] = 1;
                    break;

                case "Heavy":
                    $user['fe_body'] = 5;
                    break;

                case "Curvy":
                    $user['fe_body'] = 4;
                    break;

                case "Pumped up":
                    $user['fe_body'] = 1;
                    break;

                case "Slim":
                    $user['fe_body'] = 6;
                    break;

                default:
                    $user['fe_body'] = 0;
                    break;
            } */

            /* switch ($rawUserData['hair']) {
                case "Auburn":
                    $user['fe_hair'] = 1;
                    break;

                case "Black":
                    $user['fe_hair'] = 3;
                    break;

                case "Blond":
                    $user['fe_hair'] = 4;
                    break;

                case "Brown":
                    $user['fe_hair'] = 5;
                    break;

                case "Other":
                    $user['fe_hair'] = 9;
                    break;

                case "Red":
                    $user['fe_hair'] = 6;
                    break;

                case "Grey":
                    $user['fe_hair'] = 7;
                    break;

                default:
                    $user['fe_hair'] = 0;
                    break;
            } */

            /* switch ($rawUserData['country']) {
                case 'Belarus':
                    $rawUserData['country_code'] = 'BY';
                    break;
                case 'Russia':
                    $rawUserData['country_code'] = 'RU';
                    break;
                case 'Ukraine':
                    $rawUserData['country_code'] = 'UA';
                    break;
                case 'Moldova':
                    $rawUserData['country_code'] = 'MD';
                    break;
            } */

            $this->ci->load->model('Countries_model');
            $locations = reset($this->ci->Countries_model->get_locations(
                $rawUserData['city'],
                array("priority" => "ASC"),
                $this->ci->pg_language->current_lang_id,
                $this->ci->pg_language->languages,
                'PH',
                null,
                null,
                5
            )['cities']);

            if (empty($locations)) {
                $cityCount = $this->ci->db->count_all_results(DB_PREFIX . 'cnt_cities');
                srand();
                $key = rand(0, $cityCount-1);
                $this->ci->db->select('*');
                $this->ci->db->from(DB_PREFIX . 'cnt_cities');
                $this->ci->db->limit(1, $key);
                $locations = $this->ci->db->get()->result_array()[0];
                $query = $this->ci->db->last_query();
            }

            $user['id_country'] = $locations['country_code'];
            $user['id_region'] = $locations['id_region'];
            $user['id_city'] = $locations['id'];
            $user['lat'] = $locations['latitude'];
            $user['lon'] = $locations['longitude'];

            if ($addImage) {
                $isLogoSet = false;
                $mandatoryWays = [];
                $queryFile = $fotoDirection . $rawUserData[$fieldIdName] . '[_.]*';
                $mandatoryWays = glob($queryFile);

                foreach ($mandatoryWays as $currentWay) {
                    $age_diff = date('Y') - date('Y', filemtime($currentWay));
                    $new_birth_date = date('Y-m-d', strtotime($user['birth_date'] . ' +' .  $age_diff . ' year'));
                    $new_age = date('Y') - date('Y', strtotime($new_birth_date));

                    if ($new_age >= $age_min && $new_age < $user['age']) {
                        $user['age'] = $new_age;
                        $user['birth_date'] = $new_birth_date;
                    }

                    $filename = substr(strrchr($currentWay, '/'), 1);

                    $mediaType = (!$isLogoSet) ? 'user-logo' : 'gallery_image';
                    if (!$isLogoSet) {
                        $isLogoSet = true;
                    } elseif (!$addGalleryImage) {
                        break;
                    }

                    $path = SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000) . '/' . (($user['id'] / 1000) % 1000) . '/' . (($user['id'] / 100) % 100) . '/' . $user['id'] . '/';

                    $config_data = $this->ci->Uploads_model->get_config($mediaType);
                        //              creating directory
                    if (!file_exists(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000))) {
                            mkdir(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000), 0755, true);
                    } elseif (!file_exists(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000) . '/' . (($user['id'] / 1000) % 1000))) {
                        mkdir(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000) . '/' . (($user['id'] / 1000) % 1000), 0755, true);
                    } elseif (!file_exists(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000) . '/' . (($user['id'] / 1000) % 1000) . '/' . (($user['id'] / 100) % 100))) {
                    mkdir(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000) . '/' . (($user['id'] / 1000) % 1000) . '/' . (($user['id'] / 100) % 100), 0755, true);
                    } elseif (!file_exists(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000) . '/' . (($user['id'] / 1000) % 1000) . '/' . (($user['id'] / 100) % 100) . '/' . $user['id'])) {
                        mkdir(SITE_PHYSICAL_PATH . 'uploads/'.$mediaType.'/' . (($user['id'] / 10000) % 10000) . '/' . (($user['id'] / 1000) % 1000) . '/' . (($user['id'] / 100) % 100) . '/' . $user['id'], 0755, true);
                    }

                    mkdir($path, 0755, true);
                    copy($currentWay, $path . $filename);

                    if (isset($config_data["thumbs"]) && !empty($config_data["thumbs"])) {
                        $this->ci->Uploads_model->create_thumbs($filename, $path, $config_data["thumbs"]);
                    }

                    if ($mediaType == 'user-logo') {
                        $user['user_logo'] = $filename;
                    } else {
                        $image_size = getimagesize($path . $filename);
                        $image_size['mime'] = !empty($image_size['mime']) ? $image_size['mime'] : 'image/jpg';

                        $data = [
                            "date_add" => date('Y-m-d H:i:s'),
                            "permissions" => 4,
                            "mime" => $image_size['mime'],
                            "id_user" => $user['id'],
                            "id_owner" => $user['id'],
                            'upload_gid' => $mediaType,
                            "type_id" => $this->ci->Media_model->album_type_id,
                            'status' => 1,
                            'mediafile' => $filename,
                            'fname' => $filename,
                            'settings' => serialize(array('height' => $image_size[1], 'width' => $image_size[0])),
                        ];

                        $this->ci->db->insert(DB_PREFIX . 'media', $data);
                    }
                }
            }

            $this->ci->load->model('Media_model');
            $media = $this->ci->Media_model->getMediaByUserId($user['id']);
            $extension = preg_replace('/[\d_]+/', '', $media[0]['mediafile']);
            if (empty($extension)) {
                $extension = '.gif';
            }
            $user['user_logo'] = $rawUserData['id'] . '_1' . $extension;

            $this->ci->db->insert(DB_PREFIX . 'users', $user);

            if ($this->ci->pg_module->is_module_installed('perfect_match')) {
                $this->ci->load->model('Perfect_match_model');
                $this->ci->Perfect_match_model->userUpdated($user, $user['id']);
            }
        }

        if (!empty($rawData)) {
            $last_id = end($rawData)[$fieldIdName];
            echo "Last id $last_id";
            $this->ci->pg_module->set_module_config('users', 'import_last_user_id', $last_id);
        }

        $time = microtime(true) - $time_start;
        echo '<pre>';
        print_r("Выполнялось $time секунд");
        echo '</pre>';

        $this->forceRefresh();
    }

    public function updateLogo() {
        $this->ci->db->select('*');
        $this->ci->db->from(DB_PREFIX . 'users');
        $this->ci->db->limit(10);
        $this->ci->db->where('user_logo NOT REGEXP ' . $this->ci->db->escape("\\."));
        // print_r($this->ci->db->_compile_select()); exit;
        $rawData = $this->ci->db->get()->result_array();

        $media_extensions = ['.gif', '.png', '.jpg', '.jpeg'];

        foreach ($rawData as $user) {
            if ($user['import_id'] == 0) {
                continue;
            }
            $logo_path = $this->ci->Uploads_model->getMediaPath('user-logo', $user['id']);

            foreach ($media_extensions as $extension) {
                $file_path = $logo_path . $user['user_logo'] . $extension;
                if (file_exists($file_path)) {
                    $save_data['user_logo'] = $user['user_logo'] . $extension;
                    $this->ci->db->where('id', $user['id']);
                    $this->ci->db->update(DB_PREFIX . 'users', $save_data);
                    continue 2;
                }
            }
        }

        $this->forceRefresh();
    }

    public function forceRefresh() {
        echo "<script>
            window.location.href = '" . site_url() . "admin/cronjob/run/32';
        </script>";
        exit;
    }

}
