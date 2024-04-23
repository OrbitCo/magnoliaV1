<?php

declare(strict_types=1);

namespace Pg\modules\start\models;

use Pg\Libraries\Intercom\IntercomClient;

/**
 * Start model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class IntercomModel extends \Model
{
    const USER_MODE = 'SITE';
    
    const ADMIN_MODE = 'PG';
    
    protected $ci;
    
    protected $client;
    
    public $app_id;
    
    public $api_key;
    
    public $api_secret;
    
    public $user_id;
    
    public $user_email;
    
    public $user_name;
    
    public $is_used = false;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->ci = &get_instance();
        
        $auth_type = $this->ci->session->userdata('auth_type');
        if (in_array($auth_type, ['admin', 'module'])) {
            $this->is_used = !empty($_ENV['USE_' . self::ADMIN_MODE . '_INTERCOM']);
            $prefix = self::ADMIN_MODE;
            $this->user_id = SITE_VIRTUAL_PATH; 
        } else {
            $this->is_used = !empty($_ENV['USE_' . self::USER_MODE . '_INTERCOM']);
            $prefix = self::USER_MODE;
            $this->user_id = '';
        }
        
        if (!$this->is_used) {
            return;
        }
       
        $this->app_id = $_ENV[$prefix . '_INTERCOM_APP_ID'];
        $this->api_key = $_ENV[$prefix . '_INTERCOM_API_KEY'];
        $this->api_secret = $_ENV[$prefix . '_INTERCOM_API_SECRET'];

        $this->user_email = $this->ci->session->userdata('email') ?: '';
        $this->user_name = $this->ci->session->userdata('name') ?: '';
        
        $this->client = new IntercomClient($this->app_id, $this->api_key);        
        
        if (in_array($auth_type, ['admin', 'module'])) {
            $this->sendAdminEvent();
        }
    }
    
    public function sendUserEvent($event_name, $user_id, array $user_data=[])
    {
        if (!$this->is_used) {
            return;
        }
        
        if ($user_id == $this->user_id) {
            $user_email = $this->user_email;
            $user_name = $this->user_name;
        } else {
            $user_email = $user_data['email'];
            
            if (!empty($user_data['fname']) || !empty($user_data['sname'])) {
                $user_name = trim($user_data['fname'] . ' ' . $user_data['sname']);
            } else {
                $user_name = '';
            }
        }
        
        $metadata = [
            'custom_domain' => SITE_SERVER,
            'language_override' => $this->ci->pg_language->current_lang['name'],
            //'trackEvent' => 'user_register',
            'user_hash' => hash_hmac('sha256', $user_id, $this->api_secret)
        ];
        
        if (!empty($user_data['id'])) {
            $metadata['user_id'] = $user_data['id'];
            $metadata['email'] = $user_data['email'];
            $metadata['name'] = $user_data['fname'] . ' ' . $user_data['sname'];
        }           

        try {
            $this->client->users->create([
                'email' => $user_email,
                'name' => $user_name,                
            ]);
           
            $this->client->events->create([
                'event_name' => $event_name,
                'created_at' => time(),
                'email' => $user_email,
                'metadata' => $metadata,
            ]); 
        } catch (\Exception $e) {
  
        }
    }
    
    public function sendAdminEvent()
    {        
        if (!$this->is_used) {
            return;
        }
        
        $trackevent = (PACKAGE_NAME == 'all') ? 'trial_admin' : 'license_admin';

        try {
            $this->client->users->create([
                'user_id' => $this->user_id,
                'email' => $this->user_email,
                'name' => $this->user_name,
            ]);
            $this->client->events->create([
                'event_name' => 'dating-' . $trackevent,
                'created_at' => time(),
                'email' => $this->user_email,
                'metadata' => [
                    'user_id' => $this->user_id,
                    'email' => $this->user_email,
                    'name' => $this->user_name,
                    'custom_domain' => SITE_SERVER,
                    'language_override' => $this->ci->pg_language->current_lang['name'],
                    'trackEvent' => $trackevent,
                    'user_hash' => hash_hmac('sha256', $this->user_id, $this->api_secret)
                ],
            ]); 
        } catch (\Exception $e) {
            
        }
    }
}
