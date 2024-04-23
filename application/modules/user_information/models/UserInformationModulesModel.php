<?php

declare(strict_types=1);

namespace Pg\modules\user_information\models;

use Pg\Libraries\Traits\ModuleModel;

/**
 * user_information module
 *
 * @copyright   Copyright (c) 2000-2019
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */

class UserInformationModulesModel extends \Model
{
    use ModuleModel;

    /**
     * Creating a user archive with personal information
     *
     * @param array $data users information
     *
     * @return void
     */
    public function archiveCreate(array $data = [])
    {
        $this->ci->load->model(['Uploads_model', 'User_information_model']);
        $zip = new \ZipArchive();
        foreach ($data as $value) {
            $this->ci->pg_language->setCurrentLang($value['lang_id'])->load_pages_model();
            $modules_data = $this->getData($value);
            $html_page = $this->getWrapper($modules_data['html']);
            $path = $this->ci->Uploads_model->getMediaPath(UserInformationModel::MODULE_GID, UserInformationModel::secretPath($value));
            $this->ci->Uploads_model->createPath($path);
            $res = $zip->open($path . UserInformationModel::nameArchive($value['user']['nickname']), \ZipArchive::CREATE);
            if ($res === true) {
                $zip->addFromString('index.html', $html_page);
                foreach ($modules_data as $pages) {
                    if (!empty($pages['pages'])) {
                        foreach ($pages['pages'] as $page => $page_data) {
                            $zip->addFromString($page, $this->getWrapper($page_data));
                        }
                    }
                    if (!empty($pages['files'])) {
                        foreach ($pages['files'] as $page => $page_data) {
                            $zip->addFile($page_data, $page);
                        }
                    }
                }
                $zip->close();
                $this->ci->User_information_model->saveArchive($value['archive_id'], [
                    'status' => UserInformationModel::READY,
                    'date_modified' => date(UserInformationModel::DATE_FORMAT)
                ]);
            }
        }
    }

    /**
     * Return modules data
     *
     * @param array $user_data
     *
     * $return array
     *
     * @return array
     */
    public function getData(array $user_data): array
    {
        $result = [];
        $modules = !empty($user_data['data']) ? $user_data['data'] : $this->ci->pg_module->get_modules();

        foreach ($modules as $module_data) {
            $module = is_array($module_data) ? $module_data['module_gid'] : $module_data;
            $ucfirst_module = $this->ucfirstModule($module);
            if (class_exists(NS_MODULES . $module . '\\models\\' . $ucfirst_module . 'UserInformationModel') !== false) {
                $model = $module . 'UserInformationModel';
                $this->ci->load->model([$module . '/models/' . $model, 'UsersModel']);
                $user = $this->ci->UsersModel->getUserById($user_data['user_id'], true);
                $information_type = $this->ci->{$model}->getInformationType();
                $data = $this->ci->{$model}->getUserInformation($user);
                if (!empty($data['html'])) {
                    $result['html'][$information_type] .= $data['html'];
                }
                if (!empty($data['pages'])) {
                    $result[$module]['pages'] = $data['pages'];
                }
                if (!empty($data['files'])) {
                    $result[$module]['files'] = $data['files'];
                }
            }
        }

        return $result;
    }

    /**
     * Start page for displaying information
     *
     * @param mixed $content
     *
     * @return mixed
     */
    public function getWrapper($content)
    {
        $this->ci->view->assign('content', $content);

        return $this->ci->view->fetchFinal('archive_page', 'user', 'user_information');
    }
}
