<?php

declare(strict_types=1);

namespace Pg\modules\start\models;

use Pg\Libraries\View;

/**
 * Start module
 *
 * @copyright    Copyright (c) 2000-2017
 * @author    Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class StartCaptchaModel extends \Model
{
    /**
     * Google reCAPTCHA
     *
     * @var string
     */
    const GOOGLE_CAPTCHA_LINK = 'https://www.google.com/recaptcha/intro/index.html';

    /**
     * Google reCAPTCHA API link
     *
     * @var string
     */
    const GOOGLE_CAPTCHA_API_LINK = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * CAPTCHA types list
     *
     * @var array
     */
    public $captcha_types = [
        'default',
        'google'
    ];

    /**
     * Class constructor
     *
     * @return StartCaptchaModel
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Return CAPTCHA
     *
     * @return array CAPTCHA data settings
     */
    public function getCaptcha()
    {
        return [
            'captcha_type' => $this->pg_module->get_module_config(StartModel::MODULE_GID, 'captcha_type'),
            'captcha' => $this->pg_module->get_module_config(StartModel::MODULE_GID, 'captcha')
        ];
    }

    /**
     * CAPTCHA validation
     *
     * @param array $data
     *
     * @return array
     */
    public function validateCaptcha(array $data)
    {
        $filtered_params = filter_var_array($data,
            [
                'captcha_type' => FILTER_SANITIZE_STRING,
                'google_site_key' => FILTER_SANITIZE_STRING,
                'google_secret_key' => FILTER_SANITIZE_STRING
            ]);
        if ($filtered_params['captcha_type'] == 'google') {
            if (!empty($filtered_params['captcha_type']) && !empty($filtered_params['google_secret_key'])) {
                return [
                    'captcha_type' => $filtered_params['captcha_type'],
                    'captcha' => $this->formatGooglaCaptcha($filtered_params)
                ];
            } else {
                return [View::MSG_ERROR => [l('error_fields_empty', StartModel::MODULE_GID)]];
            }
        } else {
            return ['captcha_type' => 'default'];
        }
    }

    /**
     * Format Googla CAPTCHA
     *
     * @param array $data
     *
     * @return array
     */
    private function formatGooglaCaptcha(array $data)
    {
        return json_encode([
            'google' => [
                'site_key' => $data['google_site_key'],
                'secret_key' => $data['google_secret_key']
            ]
        ]);
    }

    /**
     * CAPTCHA formatting
     *
     * @param array $data
     * @param boolean $format
     *
     * @return array
     */
    public function formatCaptcha(array $data, $format = true)
    {
        if ($data['captcha_type'] == 'google') {
            $captcha = json_decode($data['captcha'], true)['google'];
            $return = [
                'captcha_type' => 'google',
                'site_key' => $captcha['site_key'],
                'secret_key' => $captcha['secret_key'],
                'help_link' => self::GOOGLE_CAPTCHA_LINK,
            ];
        } else {
            if ($format !== false) {
                $this->ci->load->plugin('captcha');
                $this->ci->config->load('captcha_settings');
                $captcha = create_captcha($this->ci->config->item('captcha_settings'));
                $this->ci->session->set_userdata('captcha_word', $captcha['word']);
                $return = [
                    'captcha_type' => 'default',
                    'captcha_image' => $captcha['image'],
                    'captcha_word_length' => strlen($captcha['word'])
                ];
            } else {
                return false;
            }
        }
        return $return;
    }

    /**
     * Set settings CAPTCHA
     *
     * @param array $data
     *
     * @return void
     */
    public function setCaptcha($data)
    {
        foreach ($data as $field => $valye) {
            $this->pg_module->set_module_config(StartModel::MODULE_GID, $field, $valye);
        }
    }

    /**
     * Is CAPTCHA
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function isCaptcha($data)
    {
        if (!empty($data)) {
            $settings = $this->formatCaptcha(
                $this->getCaptcha(),
                false
            );
            if ($settings['captcha_type'] == 'google') {
                return $this->isGoogleCaptcha($data, $settings);
            } else {
                return $this->isDefaultCaptcha($data);
            }
        }
        return false;
    }

    /**
     *  Is CAPTCHA default
     *
     * @param array $data
     *
     * @return boolean
     */
    public function isDefaultCaptcha($data)
    {
        return ($data != $this->ci->session->userdata('captcha_word')) ? false : true;
    }

    /**
     * Is CAPTCHA by google v3
     *
     * @param string $recaptcha
     * @param array $settings
     * @param bool $isTest
     * @return boolean|array
     */
    public function isGoogleCaptcha(string $recaptcha, array $settings, $isTest = false)
    {
        $result = $this->getCurlData(
            self::GOOGLE_CAPTCHA_API_LINK .
            '?secret=' . $settings['secret_key'] .
            '&response=' . $recaptcha
        );

        if ($isTest !== false) {
            return $result;
        }

        if ($result['success'] && $result['score'] >= 0.5) {
            return true;
        }
        return false;
    }

    /**
     * CURL data
     *
     * @param string $url
     *
     * @return array
     */
    private function getCurlData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        $curl_data = curl_exec($curl);
        curl_close($curl);
        return json_decode($curl_data, true);
    }
}
