<?php

declare(strict_types=1);

namespace Pg\modules\im\models;

/**
 * IM install model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Dmitry Popenov
 *
 * @version $Revision: 2 $ $Date: 2013-01-30 10:50:07 +0400 $
 */
class ImInstallModel extends \Model
{

    protected $menu = [
        'admin_menu' => [
            'action' => 'none',
            'name'   => '',
            'items'  => [
                'other_items' => [
                    'action' => 'none',
                    'name'   => '',
                    'items'  => [
                        "add_ons_items" => [
                            "action" => "none",
                            'name'   => '',
                            "items"  => [
                                "im_menu_item" => ["action" => "create", "link" => "admin/im", "status" => 1, "sorter" => 4],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_im_menu' => [
            'action' => 'create',
            'name'   => 'IM menu',
            'items'  => [
                'im_settings' => ['action' => 'create', 'link' => 'admin/im', 'status' => 1, "sorter" => 1],
            ],
        ],
    ];
    protected $lang_services = [
        'service'     => ['im'],
        'template'    => ['im_template'],
        'admin_param' => [
            'im_template' => ['period'],
        ],
    ];
    protected $moderation_types = [
        [
            "name"                 => "im",
            "mtype"                => "-1",
            "module"               => "im",
            "model"                => "Im",
            "check_badwords"       => "1",
            "method_get_list"      => "",
            "method_set_status"    => "",
            "method_delete_object" => "",
            "allow_to_decline"     => "0",
            "template_list_row"    => "",
        ],
    ];

    /**
     * Network events configuration
     *
     * @var array
     */
    protected $network_event_handlers = [
        [
            'event'  => 'im.message',
            'module' => 'im',
            'model'  => 'Im_messages_model',
            'method' => 'handler_message',
        ],
    ];

   /**
     * Constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function installMenu()
    {
        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            $name = '';
            if (isset($menu_data["name"])) {
                $name = $menu_data["name"];
            }
            $this->menu[$gid]['id'] = linked_install_set_menu($gid, $menu_data["action"], $name);
            linked_install_process_menu_items($this->menu, 'create', $gid, 0, $this->menu[$gid]["items"]);
        }
    }

    public function installMenuLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $langs_file = $this->ci->Install_model->language_file_read('im', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, 'update', $gid, 0, $this->menu[$gid]['items'], $gid, $langs_file);
        }

        return true;
    }

    public function installMenuLangExport($langs_ids)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->helper('menu');

        $return = [];
        foreach ($this->menu as $gid => $menu_data) {
            $temp = linked_install_process_menu_items($this->menu, 'export', $gid, 0, $this->menu[$gid]['items'], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ['menu' => $return];
    }

    public function deinstallMenu()
    {
        $this->ci->load->helper('menu');
        foreach ($this->menu as $gid => $menu_data) {
            if ($menu_data['action'] == 'create') {
                linked_install_set_menu($gid, 'delete');
            } else {
                linked_install_delete_menu_items($gid, $this->menu[$gid]['items']);
            }
        }
    }

    /**
     * Check system requirements of module
     */
    public function validateRequirements()
    {
        $result = ["data" => [], "result" => true];

        //check for Mbstring
        $good = function_exists("mb_substr");
        $result["data"][] = [
            "name"   => "Mbstring extension (required for feeds parsing) is installed",
            "value"  => $good ? "Yes" : "No",
            "result" => $good,
        ];
        $result["result"] = $result["result"] && $good;

        return $result;
    }

    public function installUsers()
    {
        $this->ci->load->model('users/models/Users_statuses_model');
        $this->ci->Users_statuses_model->add_callback('im', 'im_contact_list_model', 'callback_update_contacts_statuses');
    }

    public function deinstallUsers()
    {
        $this->ci->load->model('users/models/Users_statuses_model');
        $this->ci->Users_statuses_model->delete_callbacks_by_module('im');
    }

    public function installFriendlist()
    {
        $this->ci->load->model('friendlist/models/Friendlist_callbacks_model');
        $this->ci->Friendlist_callbacks_model->add_callback('im', 'im_contact_list_model', 'callback_update_contact_list');
        $this->ci->load->model('im/models/Im_contact_list_model');
        $this->ci->Im_contact_list_model->_import_friendlist();
    }

    public function deinstallFriendlist()
    {
        $this->ci->load->model('friendlist/models/Friendlist_callbacks_model');
        $this->ci->Friendlist_callbacks_model->delete_callbacks_by_module('im');
    }

    public function installServices()
    {
        // add service type and service
        // create service template and service
        $this->ci->load->model('Services_model');
        $template_data = [
            'gid'                      => 'im_template',
            'callback_module'          => 'im',
            'callback_model'           => 'Im_model',
            'callback_buy_method'      => 'service_buy_im',
            'callback_activate_method' => 'service_activate_im',
            'callback_validate_method' => 'service_validate_im',
            'price_type'               => 1,
            'data_admin'               => ['period' => 'int'],
            'data_user'                => '',
            'date_add'                 => date('Y-m-d H:i:s'),
            'moveable'                 => 0,
            'alert_activate'           => 0,
            'is_membership'            => 1,
            'data_membership'          => [],
        ];
        $validated_tpl = $this->ci->Services_model->validate_template(null, $template_data);
        if (empty($validated_tpl['errors'])) {
            $this->ci->Services_model->save_template(null, $validated_tpl['data']);
        }

        $service_data = [
            'gid'          => 'im',
            'template_gid' => 'im_template',
            'pay_type'     => 2,
            'status'       => 1,
            'price'        => 10,
            'type'         => 'tariff',
            'data_admin'   => ['period' => '30'],
            'date_add'     => date('Y-m-d H:i:s'),
        ];
        $validated_srvs = $this->ci->Services_model->validate_service(null, $service_data);
        if (empty($validated_srvs['errors'])) {
            $this->ci->Services_model->save_service(null, $validated_srvs['data']);
        }
    }

    public function installServicesLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Services_model');
        $langs_file = $this->ci->Install_model->language_file_read('im', 'services', $langs_ids);
        $this->ci->Services_model->update_langs($this->lang_services, $langs_file);

        return true;
    }

    public function installServicesLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('Services_model');

        return ['services' => $this->ci->Services_model->export_langs($this->lang_services, $langs_ids)];
    }

    public function deinstallServices()
    {
        $this->ci->load->model("Services_model");
        $this->ci->Services_model->delete_template_by_gid('im_template');
        $this->ci->Services_model->delete_service_by_gid('im');
    }

    public function installModeration()
    {
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->moderation_types as $mtype) {
            $mtype['date_add'] = date("Y-m-d H:i:s");
            $this->ci->Moderation_type_model->save_type(null, $mtype);
        }
    }

    public function installModerationLangUpdate($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $langs_file = $this->ci->Install_model->language_file_read('im', 'moderation', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty moderation langs data');

            return false;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');
        $this->ci->Moderation_type_model->update_langs($this->moderation_types, $langs_file);
    }

    public function installModerationLangExport($langs_ids = null)
    {
        if (!is_array($langs_ids)) {
            $langs_ids = (array) $langs_ids;
        }
        $this->ci->load->model('moderation/models/Moderation_type_model');

        return ['moderation' => $this->ci->Moderation_type_model->export_langs($this->moderation_types, $langs_ids)];
    }

    public function deinstallModeration()
    {
        $this->ci->load->model('moderation/models/Moderation_type_model');
        foreach ($this->moderation_types as $mtype) {
            $type = $this->ci->Moderation_type_model->get_type_by_name($mtype["name"]);
            $this->ci->Moderation_type_model->delete_type($type['id']);
        }
    }

    /**
     * Install network events handler
     *
     * @return void
     */
    public function installNetwork()
    {
        $this->ci->load->model('network/models/Network_events_model');
        foreach ($this->network_event_handlers as $handler) {
            $this->ci->Network_events_model->add_handler($handler);
        }
    }

    /**
     * Uninstall network events handler
     *
     * @return void
     */
    public function deinstallNetwork()
    {
        $this->ci->load->model('network/models/Network_events_model');
        foreach ($this->network_event_handlers as $handler) {
            $this->ci->Network_events_model->delete($handler['event']);
        }
    }

    public function arbitraryInstalling()
    {
    }

    public function arbitraryDeinstalling()
    {
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function installAccessPermissions()
    {
        //$this->ci->load->model('Im_model');
        //$this->ci->Im_model->installAccessPermissions();
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function deinstallAccessPermissions()
    {
        //$this->ci->load->model('Im_model');
        //$this->ci->Im_model->deinstallAccessPermissions();
    }

    public function __call($name, $args)
    {
        $methods = [
            '_prepare_installing' => 'prepareInstalling',
            '_arbitrary_installing' => 'arbitraryInstalling',
            '_arbitrary_lang_install' => 'arbitraryLangInstall',
            '_arbitrary_lang_export' => 'arbitraryLangExport',
            '_arbitrary_deinstalling' => 'arbitraryDeinstalling',
            '_validate_requirements' => 'validateRequirements',
        ];

        if (isset($methods[$name])) {
            $method = $methods[$name];
        } else {
            $search = ['_lang_update', '_lang_export'];
            $replace = ['LangUpdate', 'LangExport'];

            $method = str_replace($search, $replace, $name);
        }

        if (!method_exists($this, $method)) {
            return;
        }

        return call_user_func_array([$this, $method], $args);
    }
}
