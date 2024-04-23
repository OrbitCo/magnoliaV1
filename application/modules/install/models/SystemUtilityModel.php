<?php

declare(strict_types=1);

namespace Pg\modules\install\models;

/**
 * Install module.
 *
 *
 * @copyright   Copyright (c) 2000-2020 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */

/**
 * Install Main Model.
 *
 *
 * @category    models
 *
 * @copyright   Copyright (c) 2000-2020 PG Core
 * @author      Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class SystemUtilityModel extends \Model
{
    const DS = DIRECTORY_SEPARATOR;

    /**
     * SystemUtilityModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getModulesData()
    {
        return $this->ci->pg_module->get_modules();
    }

    public function setModulesData($data)
    {
        foreach ($data as $gid => $new_version) {
            $content = $this->ci->Install_model->get_module_config($gid);
            $content['version'] = $new_version;
            $this->setFileData($content);
        }
    }

    private function setFileData($content)
    {
        $file_path = SITE_PHYSICAL_PATH . TEMP_FOLDER . 'modules/' . $content['module'] . '/install';
        $full_name = $file_path . '/module.php';

        if (!is_dir($file_path)) {
            mkdir($file_path, 0777, true);
        }
        if (!is_file($full_name)) {
            touch($full_name);
        }

        $start = <<<'EOD'
<?php

$module =
EOD;

        file_put_contents($full_name, $start . $this->varExport($content, true) . ';');
    }

    public function varExport($expression, $return = false)
    {
        $export = var_export($expression, true);
        $export = preg_replace('/^([ ]*)(.*)/m', '$1$1$2', $export);
        $array = preg_split("/\r\n|\n|\r/", $export);
        $array = preg_replace(["/\s*array\s\($/", "/\)(,)?$/", "/\s=>\s$/"], [null, ']$1', ' => ['], $array);
        $export = join(PHP_EOL, array_filter(['['] + $array));
        if ($return === true) {
            return $export;
        }
        echo $export;
    }
}
