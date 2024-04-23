<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UpdaterDownloaderModel extends \Model
{
    /**
     * DIRECTORY_SEPARATOR
     *
     * @var string
     */
    protected const DS = DIRECTORY_SEPARATOR;

    /**
     * TEMP PATH
     *
     * @var string
     */
    public const TEMP_UPDATES_PATH = SITE_PHYSICAL_PATH . TRASH_FOLDER . 'updates' . self::DS;

    /**
     * API link
     *
     * @var string
     */
    public const API_URL = 'https://lighthouse.pilotgroup.net/api/';

    /**
     * Token API
     *
     * @var string
     */
    protected $token;

    /**
     * @var GuzzleHttp\Client;
     */
    protected $client;

    /**
     * Last updates list
     *
     * @return array
     */
    public function getLastVersionUpdater(): array
    {
        $return = [];

        try {
            $response = $this->client()->request('POST', $this->APIUrl('check_new_update'), [
                'form_params' => [
                    'version' => [
                        'code' => $this->ci->pg_module->get_module_config('start', 'product_version_code'),
                        'name' => $this->ci->pg_module->get_module_config('start', 'product_version_name'),
                    ],
                    'order_key' => $this->ci->pg_module->get_module_config('start', 'product_order_key')
                ]
            ]);

            $data = $response->getBody()->getContents();
            $content = json_decode($data, true);
            if (!empty($content) && empty($content['errors']) && !empty($content['data']['check'])) {
                $return['data'] = $this->formatUpdaterList($content['data']);
            } elseif (!empty($content['errors'])) {
                $return['errors'] = current($content['errors'])['str'];
            }
        } catch (GuzzleHttp\Exception\ClientException | GuzzleException $e) {
            log_message('error', $e->getRequest());
            $return['errors'] = $e->getRequest();
        }

        return $return;
    }

    /**
     * Format updater list
     *
     * @param array $data
     *
     * @return array
     */
    private function formatUpdaterList(array $data): array
    {
        $format_data = [];

        if (!empty($data['check'])) {
            $version = key($data['list']);

            $format_data = [
                'version' => $version,
                'current_version' => $this->ci->pg_module->get_module_config('start', 'product_version_code'),
                'name' => $this->ci->pg_module->get_module_config('start', 'product_version_name') . " ($version)"
            ];
        }

        return $format_data;
    }

    /**
     * Download to server
     *
     * @param string $version
     *
     * @return void
     */
    public function downloadToServer(string $version)
    {
        try {
            $updater_data = [
                'version' => [
                    'code' => $this->ci->pg_module->get_module_config('start', 'product_version_code'),
                    'name' => $this->ci->pg_module->get_module_config('start', 'product_version_name'),
                ],
                'range' => [$this->ci->pg_module->get_module_config('start', 'product_version_code'), $version]
            ];
            $response = $this->client()->request('POST', $this->APIUrl('download'), [
                'form_params' => $updater_data
            ]);
            $data = $response->getBody()->getContents();
            $content = json_decode($data, true);

            if (!empty($content) && empty($content['errors'])) {
                $is_downloaded = $this->download($content['data']);
                $this->ci->load->model('install/models/UpdaterBuilderModel');
                $this->ci->UpdaterBuilderModel->setUpdaterData($updater_data);
                $is_created = $this->ci->UpdaterBuilderModel->buildUpdater($content['data']);
                $this->successResponse($is_downloaded, $content['data']);
            } else {
                $return['errors'] = implode(' | ', current($content['errors']));
            }
        } catch (GuzzleHttp\Exception\ClientException | GuzzleException $e) {
            log_message('error', $e->getRequest());

            $return['errors'] = $e->getRequest();
        }
    }

    /**
     * Download updaters
     *
     * @param array $data
     *
     * @return bool
     */
    protected function download(array $data): bool
    {
        $is_downloaded = false;
        if (!empty($data['download_link'])) {
            if (!file_exists(self::TEMP_UPDATES_PATH)) {
                mkdir(self::TEMP_UPDATES_PATH, 0777, true);
            }
            foreach ($data['list'] as $k => $name) {
                if (!file_exists(self::TEMP_UPDATES_PATH . $name)) {
                    copy("{$data['download_link']}/{$name}", self::TEMP_UPDATES_PATH . $name);
                    $updater_decompress = new \PharData(self::TEMP_UPDATES_PATH . $name);
                    $updater_decompress->decompress();
                    unlink(self::TEMP_UPDATES_PATH . $name);
                    $phar = new \PharData(self::TEMP_UPDATES_PATH . "{$k}.tar");
                    $phar->extractTo(self::TEMP_UPDATES_PATH);
                    unlink(self::TEMP_UPDATES_PATH . "{$k}.tar");
                }
            }

            $is_downloaded = true;
        }

        return $is_downloaded;
    }

    /**
     * Get token
     *
     * @throws GuzzleException
     * @throws \Exception
     *
     * @return string
     */
    protected function getToken(): string
    {
        if (empty($this->token)) {
            $response = $this->client()->request('GET', self::API_URL . 'get_token/updater.json');
            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);
            if (!empty($data['errors'])) {
                $errors = implode(' | ', current($data['errors']));

                throw new \Exception($errors);
            }
            $this->token = $data['data']['token'];
        }

        return $this->token;
    }

    /**
     * HTTP Client
     *
     * @return Client|GuzzleHttp\Client
     */
    protected function client(): Client
    {
        if (empty($this->client)) {
            $this->client = new Client();
        }

        return $this->client;
    }

    /**
     * API url
     *
     * @param $action
     *
     * @throws GuzzleException
     *
     * @return string
     */
    protected function APIUrl($action): string
    {
        return self::API_URL . "updater/{$action}.json?token=" . $this->getToken();
    }

    /**
     * Success response
     *
     * @param bool $is_downloaded
     * @param array $form_data
     *
     * @return void
     */
    private function successResponse(bool $is_downloaded, array $form_data): void
    {
        try {
            $response = $this->client()->request('POST', $this->APIUrl('downloaded'), [
                'form_params' => $form_data
            ]);
            $data = $response->getBody()->getContents();
            $content = json_decode($data, true);

            if (!empty($content) && empty($content['errors'])) {
                $return['data']['is_success_response'] = true;
            } else {
                $return['errors'] = implode(' | ', current($content['errors']));
            }
        } catch (GuzzleHttp\Exception\ClientException | GuzzleException $e) {
            log_message('error', $e->getRequest());

            $return['errors'] = $e->getRequest();
        }
    }
}
