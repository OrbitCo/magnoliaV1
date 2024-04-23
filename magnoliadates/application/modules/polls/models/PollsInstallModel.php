<?php

declare(strict_types=1);

namespace Pg\modules\polls\models;

use Pg\Libraries\Setup;

/**
 * Poll install model
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
class PollsInstallModel extends \Model
{

    /**
     * Access permissions list
     *
     * @var array
     */
    protected $access_permissions;

    protected $action_config = [
        'polls_user_voted' => [
            'is_percent' => 0,
            'once' => 0,
            'available_period' => [
                'all'],
            ],
    ];

    private $menu = [
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
                                "polls_menu_item" => ["action" => "create", "link" => "admin/polls", 'icon' => 'bar-chart', "status" => 1, "sorter" => 2],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'admin_polls_menu' => [
            'action' => 'create',
            'name'   => 'Polls section menu',
            'items'  => [
                'polls_list_item' => ['action' => 'create', 'link' => 'admin/polls', 'status' => 1],
            ],
        ],
        'user_top_menu' => [
            'action' => 'none',
            'name'   => '',
            'items'  => [
                'user-menu-activities' => [
                    'action' => 'none',
                    'items'  => [
                        'user_main_polls_item' => ['action' => 'create', 'link' => 'polls', 'status' => 1, 'sorter' => 11],
                    ],
                ],
            ],
        ],
        /*'user_footer_menu' => [
            'action' => 'none',
            'items'  => [
                'footer-menu-links-item' => [
                    'action' => 'none',
                    'items'  => [
                        'footer-menu-polls-item' => ['action' => 'create', 'link' => 'polls',  'status' => 1, 'sorter' => 2],
                    ],
                ],
            ],
        ],*/
    ];

    private $moderation_types = [
        [
            "name"                 => "polls",
            "mtype"                => "-1",
            "module"               => "polls",
            "model"                => "Polls_model",
            "check_badwords"       => "1",
            "method_get_list"      => "",
            "method_set_status"    => "",
            "method_delete_object" => "",
            "allow_to_decline"     => "0",
            "template_list_row"    => "",
        ],
    ];

    /**
     * SEO pages
     *
     * @var array
     */
    private $seo_pages = ['index'];

    /**
     * PollsInstallModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->access_permissions = Setup::getModuleData(
                PollsModel::MODULE_GID,
            Setup::TYPE_ACCESS_PERMISSIONS
        );
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
        $langs_file = $this->ci->Install_model->language_file_read('polls', 'menu', $langs_ids);

        if (!$langs_file) {
            log_message('info', 'Empty menu langs data');

            return false;
        }

        $this->ci->load->helper('menu');

        foreach ($this->menu as $gid => $menu_data) {
            linked_install_process_menu_items($this->menu, 'update', $gid, 0, $this->menu[$gid]["items"], $gid, $langs_file);
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
            $temp = linked_install_process_menu_items($this->menu, 'export', $gid, 0, $this->menu[$gid]["items"], $gid, $langs_ids);
            $return = array_merge($return, $temp);
        }

        return ["menu" => $return];
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

    public function installSiteMap()
    {
        //// Site map
        $this->ci->load->model('Site_map_model');
        $site_map_data = [
            'module_gid'      => 'polls',
            'model_name'      => 'Polls_model',
            'get_urls_method' => 'get_sitemap_urls',
        ];
        $this->ci->Site_map_model->set_sitemap_module('polls', $site_map_data);
    }

    private $moderators_methods = [
        ['module' => 'polls', 'method' => 'index', 'is_default' => 1, 'group_id' => 7, 'is_hidden' => 0, 'parent_module' => '']
    ];

    /**
     * Moderators module methods
     */
    public function installModerators()
    {
        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        foreach ($this->moderators_methods as $method) {
            $this->ci->Moderators_model->save_method(null, $method);
        }
    }

    public function installModeratorsLangUpdate($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read('polls', 'moderators', $langs_ids);

        // install moderators permissions
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'polls';
        $methods = $this->ci->Moderators_model->get_methods_lang_export($params);

        foreach ($methods as $method) {
            if (!empty($langs_file[$method['method']])) {
                $this->ci->Moderators_model->save_method($method['id'], [], $langs_file[$method['method']]);
            }
        }
    }

    public function installModeratorsLangExport($langs_ids)
    {
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'polls';
        $methods =  $this->ci->Moderators_model->get_methods_lang_export($params, $langs_ids);
        foreach ($methods as $method) {
            $return[$method['method']] = $method['langs'];
        }

        return ['moderators' => $return];
    }

    public function deinstallModerators()
    {
        // delete moderation methods in moderators
        $this->ci->load->model('moderators/models/Moderators_model');
        $params['where']['module'] = 'polls';
        $this->ci->Moderators_model->delete_methods($params);
    }

    public function arbitraryInstalling()
    {
        $this->ci->pg_seo->set_seo_module('polls', [
            'module_gid'              => 'polls',
            'model_name'              => 'Polls_model',
            'get_settings_method'     => 'get_seo_settings',
            'get_rewrite_vars_method' => 'request_seo_rewrite',
            'get_sitemap_urls_method' => 'get_sitemap_xml_urls'
        ]);
        $this->addDemoContent();
    }

    public function deinstallSiteMap()
    {
        $this->ci->load->model('Site_map_model');
        $this->ci->Site_map_model->delete_sitemap_module('polls');
    }

    public function installModeration()
    {
        // Moderation
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
        $langs_file = $this->ci->Install_model->language_file_read('polls', 'moderation', $langs_ids);

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
     * Import module languages
     *
     * @param array $langs_ids array languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
        $langs_file = $this->ci->Install_model->language_file_read("polls", "arbitrary", $langs_ids);
        if (!$langs_file) {
            log_message("info", "Empty polls arbitrary langs data");

            return false;
        }

        foreach ($this->seo_pages as $page) {
            $post_data = [
                'title'          => isset($langs_file["seo_tags_{$page}_title"]) ? $langs_file["seo_tags_{$page}_title"] : null,
                'keyword'        => isset($langs_file["seo_tags_{$page}_keyword"]) ?  $langs_file["seo_tags_{$page}_keyword"] : null,
                'description'    => isset($langs_file["seo_tags_{$page}_description"]) ? $langs_file["seo_tags_{$page}_description"] : null,
                'header'         => isset($langs_file["seo_tags_{$page}_header"]) ? $langs_file["seo_tags_{$page}_header"] : null,
                'og_title'       => isset($langs_file["seo_tags_{$page}_og_title"]) ? $langs_file["seo_tags_{$page}_og_title"] : null,
                'og_type'        => isset($langs_file["seo_tags_{$page}_og_type"]) ? $langs_file["seo_tags_{$page}_og_type"] : null,
                'og_description' => isset($langs_file["seo_tags_{$page}_og_description"]) ? $langs_file["seo_tags_{$page}_og_description"] : null,
                "priority"       => 0.5,
            ];
            $this->ci->pg_seo->set_settings("user", "polls", "index", $post_data);
        }
    }

    /**
     * Export module languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return array
     */
    public function arbitraryLangExport($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $arbitrary_return = [];
        $seo_settings = $this->ci->pg_seo->get_all_settings_from_cache('user', 'polls');
        foreach ($seo_settings as $seo_page) {
            $prefix = 'seo_tags_' . $seo_page['method'];
            foreach ($langs_ids as $lang_id) {
                $meta = 'meta_' . $lang_id;
                $og = 'og_' . $lang_id;
                $arbitrary_return[$prefix . '_title'][$lang_id] = $seo_page[$meta]['title'];
                $arbitrary_return[$prefix . '_keyword'][$lang_id] = $seo_page[$meta]['keyword'];
                $arbitrary_return[$prefix . '_description'][$lang_id] = $seo_page[$meta]['description'];
                $arbitrary_return[$prefix . '_header'][$lang_id] = $seo_page[$meta]['header'];
                $arbitrary_return[$prefix . '_og_title'][$lang_id] = $seo_page[$og]['og_title'];
                $arbitrary_return[$prefix . '_og_type'][$lang_id] = $seo_page[$og]['og_type'];
                $arbitrary_return[$prefix . '_og_description'][$lang_id] = $seo_page[$og]['og_description'];
            }
        }

        return ['arbitrary' => $arbitrary_return];
    }

    public function arbitraryDeinstalling()
    {
        $this->ci->pg_seo->delete_seo_module('polls');
    }

    public function addDemoContent()
    {
        $this->ci->load->model('Polls_model');
        $demo_content = include MODULEPATH . 'polls/install/demo_content.php';
        // Associating languages id with codes
        foreach ($this->ci->pg_language->languages as $l) {
            $lang[$l['code']] = $l['id'];
            if (!empty($l['is_default'])) {
                $default_lang = $l;
            }
        }

        foreach ($demo_content as $poll) {
            $poll_data = [];
            $answer_data = [];
            foreach ($lang as $code => $id) {
                if (isset($poll['question'][$code])) {
                    $poll_data['question'][$id] = $poll['question'][$code];
                } else {
                    $poll_data['question'][$id] = $poll['question'][$default_lang['code']];
                }
            }
            foreach ($poll['answers'] as $number => $answer) {
                $answer_data['answers_colors'][$number] = $answer['color'];
                foreach ($lang as $code => $id) {
                    if (isset($answer[$code])) {
                        $answer_data['answers_languages'][$number . '_' . $id] = $answer[$code];
                    } else {
                        $answer_data['answers_languages'][$number . '_' . $id] = $answer[$default_lang['code']];
                    }
                }
            }
            $poll_data = $this->ci->Polls_model->validatePoll($poll_data);
            $answer_data = $this->ci->Polls_model->validateAnswers($answer_data);
            $poll['question'] = $poll_data['data']['question'];
            $poll['answers_languages'] = $answer_data['data']['answers_languages'];
            $poll['answers_colors'] = $answer_data['data']['answers_colors'];
            unset($poll['answers']);
            $responses = $poll['responses'];
            unset($poll['responses']);
            $poll_id = $this->ci->Polls_model->savePoll($poll);

            // Responses
            foreach ($responses as $response) {
                $response['poll_id'] = $poll_id;
                $this->ci->Polls_model->saveRespond($response);
            }
        }

        return true;
    }

    public function installBonuses()
    {
    }

    public function installBonusesLangUpdate($langs_ids = null)
    {
        if (empty($langs_ids)) {
            return false;
        }
        $this->ci->load->model("bonuses/models/Bonuses_util_model");
        $langs_file = $this->ci->Install_model->language_file_read("bonuses", "ds", $langs_ids);

        if (!$langs_file) {
            log_message("info", "Empty bonuses langs data");
            return false;
        }
        $this->ci->Bonuses_util_model->update_langs($langs_file);
        $this->ci->load->model("bonuses/models/Bonuses_actions_config_model");
        $this->ci->Bonuses_actions_config_model->setActionsConfig($this->action_config);
        return true;
    }

    public function installBonusesLangExport()
    {
    }

    public function uninstallBonuses()
    {
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function installAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        } else {
            $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
            foreach ($this->access_permissions as $value) {
                if (isset($value['data'])) {
                    $value['data'] = serialize($value['data']);
                }
                $this->ci->Access_permissions_modules_model->saveModules($value);
            }
        }
    }

    /**
     * Install access permissions
     *
     * @return void
     */
    protected function deinstallAccessPermissions()
    {
        if (empty($this->access_permissions)) {
            return false;
        } else {
            $this->ci->load->model('access_permissions/models/Access_permissions_modules_model');
            foreach ($this->access_permissions as $value) {
                $this->ci->Access_permissions_modules_model->deleteModule($value['module_gid']);
            }
        }
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
            '_get_settings_form' => 'getSettingsForm',
            '_save_settings_form' => 'saveSettingsForm',
            '_validate_settings_form' => 'validateSettingsForm',
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
