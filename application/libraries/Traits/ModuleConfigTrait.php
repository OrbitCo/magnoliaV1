<?php

namespace Pg\Libraries\Traits;

/**
 * Module model trait
 *
 * @copyright   Copyright (c) 2000-2021
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
trait ModuleConfigTrait
{
    /**
     * Keys are: 'key', 'value', 'name', 'lang'
     */
    abstract public function getModuleConfigList();

    /**
     * Get config
     *
     * @param array|null $custom_cfg
     *
     * @return array
     */
    public function getModuleConfig(array $custom_cfg = null): array
    {
        $cfg = $custom_cfg ?: $this->getModuleConfigList();
        foreach ($cfg as &$cfg_settings) {
            $cfg_settings['name'] = l('settings_' . $cfg_settings['key'], self::MODULE_GID);
            $cfg_settings['value'] = $this->ci->pg_module->get_module_config(
                self::MODULE_GID,
                $cfg_settings['key']
            );
        }

        return $cfg;
    }

    /**
     * Save settings
     *
     * @param array $new_cfg_values
     *
     *@throws \Exception
     *
     * @return bool
     */
    public function setModuleConfig(array $new_cfg_values): bool
    {
        foreach ($new_cfg_values as $key => $value) {
            $this->ci->pg_module->set_module_config(self::MODULE_GID, $key, $value);
        }

        return true;
    }
}
