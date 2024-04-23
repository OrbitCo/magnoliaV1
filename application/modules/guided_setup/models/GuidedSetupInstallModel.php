<?php
/**
 * SecretGifts module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

declare(strict_types=1);

namespace Pg\modules\guided_setup\models;

/**
 * SecretGifts install model
 *
 * @package     PG_Dating
 * @subpackage  SecretGifts
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class GuidedSetupInstallModel extends \Model
{
    
    /**
     * Fields depended on languages
     *
     * @var array
     */
    private $lang_dm_data = [
        [
            'module' => 'guided_setup',
            'model' => 'Guided_setup_model',
            'method_add' => 'langDedicateModuleCallbackAdd',
            'method_delete' => 'langDedicateModuleCallbackDelete',
        ]
    ];

    /**
     * Class constructor
     *
     * @return Install object
     */
    public function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();
        $this->ci->load->model('Install_model');
        $this->ci->load->model('Guided_setup_model');
    }


    /**
     * Install fields of dedicated languages
     *
     * @return void
     */
    public function prepareInstalling()
    {
        $fields = [];
        $langs_ids = $this->ci->pg_language->languages;
        $this->ci->load->dbforge();

        foreach ($this->ci->pg_language->languages as $lang_id => $value) {
            $fields[$lang_id][0]['name_' . $lang_id] = ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false];
            $fields[$lang_id][1]['name_description_' . $lang_id] = ['type' => 'VARCHAR', 'constraint' => '255', 'null' => false];
            
            $this->ci->dbforge->add_column(GUIDED_SETUP_PAGES_TABLE, $fields[$lang_id][0]);
            $this->ci->dbforge->add_column(GUIDED_SETUP_PAGES_TABLE, $fields[$lang_id][1]);
        }
        
        $pages = $this->ci->Guided_setup_model->getPages([], false);
        $langs_file = $this->ci->Install_model->language_file_read('guided_setup', 'guided_pages');
        foreach ($pages as $page) {
            $data = [];
            foreach ($langs_ids as $lang_id => $value) {
                if (isset($langs_file['guided_page_' . $page['id']])) {
                    $lang = $langs_file['guided_page_' . $page['id']][$lang_id];
                    $data['name_' . $lang_id] = $lang;
                }
                if (isset($langs_file['guided_page_description_' . $page['id']])) {
                    $lang = $langs_file['guided_page_description_' . $page['id']][$lang_id];
                    $data['name_description_' . $lang_id] = $lang;
                }
            }
            if (!empty($data)) {
                $this->ci->db->where('id', $page['id']);
                $this->ci->db->update(GUIDED_SETUP_PAGES_TABLE, $data);
            }
        }
    }

    /**
     * Install module data
     *
     * @return void
     */
    public function arbitraryInstalling()
    {
        foreach ($this->lang_dm_data as $lang_dm_data) {
            $this->ci->pg_language->add_dedicate_modules_entry($lang_dm_data);
        }
    }

    /**
     * Import module languages
     *
     * @param array $langs_ids languages identifiers
     *
     * @return void
     */
    public function arbitraryLangInstall($langs_ids = null)
    {
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
    }

    /**
     * Uninstall module data
     *
     * @return void
     */
    public function arbitraryDeinstalling()
    {
    }
}
