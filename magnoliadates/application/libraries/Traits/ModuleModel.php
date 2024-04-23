<?php

namespace Pg\Libraries\Traits;

/**
 * Module model trait
 *
 * @copyright   Copyright (c) 2000-2019
 *
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
trait ModuleModel
{

    /**
     * Format module name
     *
     * @param string $module module gid
     *
     * @return string
     */
    public function ucfirstModule(string $module): string
    {
        if (strpos($module, '_') === false) {
            $ucfirst_module = ucfirst($module);
        } else {
            $ucfirst_module = '';
            $arr_module = explode('_', $module);
            foreach ($arr_module as $m) {
                $ucfirst_module .= ucfirst($m);
            }
        }
        return $ucfirst_module;
    }
}
