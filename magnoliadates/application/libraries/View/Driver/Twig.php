<?php

namespace Pg\Libraries\View\Driver;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class Twig implements IDriver
{
    public const COMMON_NAMESPACE = 'app';

    private $cache_dir = 'twig/compiled';
    private $cache_enabled = true;
    private $is_debugging = false;
    private $tpl_extension = 'twig';
    private $twig;
    private $vars = [];

    public function __construct()
    {
        if (!empty($_ENV['TPL_CLEAR_CACHE'])) {
            $this->clearCache();
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->tpl_extension;
    }

    /**
     * @param $is_debugging
     */
    public function setDebugging($is_debugging)
    {
        $this->is_debugging = $is_debugging;
    }

    /**
     * @param $use_cache
     */
    public function useCache($use_cache)
    {
        $this->cache_enabled = (bool) $use_cache;
    }

    /**
     * @throws LoaderError
     */
    private function getLoader(array $theme): FilesystemLoader
    {
        $loader = new FilesystemLoader();
        $loader->setPaths(SITE_PHYSICAL_PATH . $theme['theme_module_path']);
        $loader->addPath(SITE_PHYSICAL_PATH . $theme['theme_path'], self::COMMON_NAMESPACE);

        return $loader;
    }

    /**
     * @throws LoaderError
     */
    private function init($theme)
    {
        $this->twig = new Environment($this->getLoader($theme), [
            'cache'         => $this->cache_enabled ? (TEMPPATH . $this->cache_dir) : false,
            'debug'         => $this->is_debugging,
            'autoescape'    => false,
            'auto_reload'   => $_ENV['TPL_AUTO_RELOAD'],
        ]);

        $this->twig->registerUndefinedFunctionCallback(function ($function_name) {
            if (!function_exists($function_name)) {
                $function = function () use ($function_name) {
                    return "twig function '$function_name' not exists";
                };
            } else {
                $function = $function_name;
            }

            return new TwigFunction($function_name, $function);
        });

        $this->twig->addExtension(new Twig\Extension());
    }

    /**
     * @return string
     */
    public function getTplExtension(): string
    {
        return $this->tpl_extension;
    }

    /**
     * @param $ext
     *
     * @return $this
     */
    public function setTplExtension($ext): Twig
    {
        $this->tpl_extension = $ext;

        return $this;
    }

    public function assign($key, $value)
    {
        $this->vars[$key] = $value;
    }

    /**
     * @throws LoaderError
     */
    public function view($resource_name, $module_gid, array $theme)
    {
        $this->init($theme);

        try {
            $tpl_name = $resource_name . '.' . $this->tpl_extension;

            return $this->twig->resolveTemplate([$tpl_name, '@' . self::COMMON_NAMESPACE . '/' . $tpl_name])
                              ->render($this->vars);
        } catch (\Twig_Error_Loader $ex) {
            if ($this->twig->isDebug()) {
                return $ex->getMessage() . '<br>' . $ex->getFile() . ':' . $ex->getLine();
            }
        }
    }

    /**
     * @param $module
     */
    public function clearCache($module = null)
    {
        $adapter = new Local(
            TEMPPATH
        );

        $filesystem = new Filesystem($adapter);
        $filesystem->deleteDir($this->cache_dir);
    }
}
