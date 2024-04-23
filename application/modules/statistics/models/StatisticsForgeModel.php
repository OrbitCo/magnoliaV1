<?php

/**
 * Statistics module
 *
 * @package     PG_Dating
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

declare(strict_types=1);

namespace Pg\modules\statistics\models;

/**
 * Statistics model to forge database
 *
 * @package     PG_Dating
 * @subpackage  Statistics
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2014 PG Dating Pro - php dating software
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class StatisticsForgeModel extends \Model
{
    /**
     * Table name
     *
     * @var string
     */
    const MODULE_TABLE = "statistics";

    /**
     * Install module fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackAdd($lang_id = false)
    {
        /*
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();

        $fields = array('name_' . $lang_id => array('type' => 'TEXT', 'null' => TRUE));
        $this->ci->dbforge->add_column(self::MODULE_TABLE, $fields);

        $default_lang_id = $this->ci->pg_language->get_default_lang_id();
        if ($lang_id != $default_lang_id) {
            $this->ci->db->set('name_' . $lang_id, 'name_' . $default_lang_id, false);
            $this->ci->db->update(self::MODULE_TABLE);
        }
        */
    }

    /**
     * Uninstall module fields depended on language
     *
     * @param integer $lang_id language identifier
     *
     * @return void
     */
    public function langDedicateModuleCallbackDelete($lang_id = false)
    {
        /*
        if (!$lang_id) {
            return;
        }

        $this->ci->load->dbforge();

        $fields_exists = $this->ci->db->list_fields(self::MODULE_TABLE);

        $fields = array(
            'name_' . $lang_id,
        );
        foreach ($fields as $field_name) {
            if (!in_array($field_name, $fields_exists)) {
                continue;
            }
            $this->ci->dbforge->drop_column(self::MODULE_TABLE, $field_name);
        }
        */
    }
}
