<?php

declare(strict_types=1);

namespace Pg\modules\countries\models;

class CountriesLocationSelectModel extends \Model
{
    private $list;
    private $tpl_prefix = 'helper_location_select_';
    private $tpl_suffix = '.tpl';

    /**
     * Get currently selected template
     *
     * @return string
     */
    public function getCurrentTpl()
    {
        $tpl = $this->ci->pg_module->get_module_config('countries', 'location_select_tpl');
        if (empty($tpl)) {
            return current($this->getTplList());
        } else {
            return $tpl;
        }
    }

    /**
     * Get filename of the currently selected template
     *
     * @return string
     */
    public function getCurrentTplFile()
    {
        return $this->tpl_prefix . $this->getCurrentTpl();
    }

    /**
     * Update the list of the available templates
     *
     * @return array
     */
    private function updateTplList()
    {
        $this->list = [];
        $theme_data = $this->ci->pg_theme->format_theme_settings('countries');
        $dir = new \DirectoryIterator(SITE_PHYSICAL_PATH . $theme_data['theme_module_path']);
        foreach ($dir as $file_info) {
            if (!$file_info->isFile()) {
                continue;
            }
            $file_name = $file_info->getBasename($this->tpl_suffix);
            if (stripos($file_name, $this->tpl_prefix) === 0) {
                $this->list[] = str_ireplace([$this->tpl_prefix, $this->tpl_suffix], '', $file_name);
            }
        }

        return $this->list;
    }

    /**
     * Update the list of the available templates
     *
     * @param boolean $force_update
     *
     * @return array
     */
    public function getTplList($force_update = false)
    {
        if (empty($this->list) || $force_update) {
            $this->updateTplList();
        }

        return $this->list;
    }
}
