<?php

declare(strict_types=1);

namespace Pg\modules\languages\models;

use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;

/**
 * Class LanguagesToolsModel
 *
 * @package Pg\modules\languages\models
 *
 * @copyright   Copyright (c) 2000-2020
 * @author  Pilot Group Ltd <http://www.pilotgroup.net/>
 */
class LanguagesToolsModel extends \Model
{
    /**
     * Lang file extension
     *
     * @var string
     */
    private $lang_file_ext = '.php';

    /**
     * No file extension
     *
     * @var string
     */
    private $lang_file_ext_not_dot = 'php';

    /**
     * Filled
     *
     * @param $default_lang_code
     * @param $langs_dir
     *
     * @throws FileNotFoundException
     *
     * @return void
     */
    private function filled($default_lang_code, $langs_dir): void
    {
        $default_lang_files = $this->getLangContent($langs_dir . $default_lang_code . DIRECTORY_SEPARATOR);

        if (false === $default_lang_files) {
            //TODO: error
            return;
        }
        foreach (new \DirectoryIterator($langs_dir) as $lang_dir) {
            if ($lang_dir->isDot() || !$lang_dir->isDir() || $lang_dir->getBasename() === $default_lang_code) {
                continue;
            }
            $lang_files = $this->getLangContent($langs_dir . $lang_dir->getBasename() . DIRECTORY_SEPARATOR);
            $filled_lang_files = (array)$this->fillEmpty($lang_files, $default_lang_files);
            $sorted_lang_files = $this->sort($filled_lang_files);
            $this->rewriteFiles($lang_dir, $sorted_lang_files);
        }
    }

    /**
     * 1) Fills empty strings with values from the default lang
     * 2) Sorts the result
     * 3) Saves it to the same file
     *
     * @param string $default_lang_code
     * @param null $langs_path
     * @throws FileNotFoundException
     */
    public function fillSort(string $default_lang_code, $langs_path = null)
    {
        if ($langs_path) {
            $this->filled($default_lang_code, $langs_path);
        } else {
            $dir_end = DIRECTORY_SEPARATOR . 'langs' . DIRECTORY_SEPARATOR;
            foreach (new \DirectoryIterator(MODULEPATH) as $module_dir) {
                if ($module_dir->isDot() || !$module_dir->isDir()) {
                    continue;
                }
                $langs_dir = $module_dir->getRealPath() . $dir_end;

                $this->filled($default_lang_code, $langs_dir);
            }
        }
    }

    /**
     * Fill empty $lang_files strings with the $default_files values
     *
     * @param array $lang_files
     * @param array $default_files
     *
     * @return array|false
     */
    private function fillEmpty(array $lang_files, array $default_files)
    {
        if (empty($lang_files)) {
            //TODO: error
            return false;
        }
        foreach ($default_files as $default_file => $default_content) {
            foreach ($default_content as $gid => $string) {
                if (!isset($lang_files[$default_file][$gid])) {
                    $lang_files[$default_file][$gid] = $string;
                }
            }
        }

        return $lang_files;
    }

    /**
     * Sort
     *
     * @param array $langs_arr
     *
     * @return array
     */
    private function sort(array $langs_arr = []): array
    {
        foreach ($langs_arr as &$lang_arr) {
            if (!empty($lang_arr)) {
                ksort($lang_arr);
            }
        }

        return $langs_arr;
    }

    /**
     * Save new data into language files
     *
     * @param \SplFileInfo $lang_dir
     * @param array $lang_files
     *
     * @throws FileNotFoundException
     */
    private function rewriteFiles(\SplFileInfo $lang_dir, array $lang_files)
    {
        $adapter = new Local($lang_dir->getRealPath() . DIRECTORY_SEPARATOR);
        $filesystem = new Filesystem($adapter);
        foreach ($lang_files as $file => $content) {
            if (!is_array($content)) {
                //TODO: error
                continue;
            }
            if (!file_exists($lang_dir->getRealPath()) &&
                !mkdir($concurrentDirectory = $lang_dir->getRealPath()) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }

            $prepared_content = $this->prepareFileContent($content);
            $filesystem->update($file . $this->lang_file_ext, $prepared_content);
        }
    }

    /**
     * Converts data into the ready for the record string.
     *
     * @param array $data
     *
     * @return string
     */
    private function prepareFileContent(array $data): string
    {
        $html = "<?php\n\n";
        if (!is_array(current($data))) {
            $html .= $this->ci->pg_language->pages->generate_install_lang($data);
        } else {
            $html .= $this->ci->pg_language->ds->generate_install_lang($data);
        }

        return $html;
    }

    /**
     * Generates language files array.
     *
     * @param string $lang_path
     *
     * @return boolean|array
     */
    public function getLangContent($lang_path)
    {
        if (!is_dir($lang_path)) {
            return false;
        }
        $strings = [];
        foreach (new \DirectoryIterator($lang_path) as $lang_file) {
            if ($lang_file->isDot()) {
                continue;
            }
            if ($lang_file->getExtension() != $this->lang_file_ext_not_dot) {
                continue;
            }
            $install_lang = [];
            include($lang_file->getRealPath());
            $strings[$lang_file->getBasename($this->lang_file_ext)] = $install_lang;
        }

        return $strings;
    }

    public function getLangContentFromPagesAndDs($lang_path)
    {
        if (!is_dir($lang_path)) {
            return false;
        }
        $strings = [];
        foreach (new \DirectoryIterator($lang_path) as $lang_file) {
            if ($lang_file->isDot()) {
                continue;
            }
            if ($lang_file->getBasename() != "pages.php" && $lang_file->getBasename() != "ds.php") {
                continue;
            }

            $install_lang = [];
            include($lang_file->getRealPath());
            if (!empty($install_lang)) {
                $strings[$lang_file->getBasename($this->lang_file_ext)] = $install_lang;
            }
        }

        return $strings;
    }
}
