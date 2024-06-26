<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package     CodeIgniter
 *
 * @author      ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2008, EllisLab, Inc.
 * @license     http://codeigniter.com/user_guide/license.html
 *
 * @link        http://codeigniter.com
 * @since       Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * Loader Class
 *
 * Loads views and files
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 *
 * @author      ExpressionEngine Dev Team
 *
 * @category    Loader
 *
 * @link        http://codeigniter.com/user_guide/libraries/loader.html
 */
class CI_Loader
{
    // All these are set automatically. Don't mess with them.
    public $_ci_ob_level;
    public $_ci_view_path = '';
    public $_ci_is_php5 = false;
    public $_ci_is_instance = false; // Whether we should use $this or $CI =& get_instance()
    public $_ci_cached_vars = [];
    public $_ci_classes = [];
    public $_ci_loaded_files = [];
    public $_ci_models = [];
    public $_ci_helpers = [];
    public $_ci_plugins = [];
    public $_ci_varmap = ['unit_test' => 'unit', 'user_agent' => 'agent'];

    /**
     * Constructor
     *
     * Sets the path to the view files and gets the initial output buffering level
     */
    public function __construct()
    {
        $this->_ci_is_php5 = floor(floatval(phpversion())) >= 5;
        $this->_ci_view_path = APPPATH . 'views/';
        $this->_ci_ob_level = ob_get_level();
        log_message('debug', "Loader Class Initialized");
    }

    // --------------------------------------------------------------------

    /**
     * Class Loader
     *
     * This function lets users load and instantiate classes.
     * It is designed to be called from a user's app controllers.
     *
     * @param   string  the name of the class
     * @param   mixed   the optional parameters
     * @param   string  an optional object name
     *
     * @return void
     */
    public function library($library = '', $params = null, $object_name = null)
    {
        if ($library == '') {
            return false;
        }

        if (!is_null($params) and !is_array($params)) {
            $params = null;
        }

        if (is_array($library)) {
            foreach ($library as $class) {
                $this->_ci_load_class($class, $params, $object_name);
            }
        } else {
            $this->_ci_load_class($library, $params, $object_name);
        }

        $this->_ci_assign_to_models();
    }

    // --------------------------------------------------------------------

    /**
     * Model Loader
     *
     * This function lets users load and instantiate models.
     *
     * @param $model
     * @param string $name
     * @param bool $db_conn
     * @param bool $create_object
     * @param bool $return_status
     *
     * @return bool
     */
    public function model($model, $name = '', $db_conn = false, $create_object = true, $return_status = false)
    {
        if (is_array($model)) {
            $load_status = true;
            foreach ($model as $babe) {
                $load_status = $this->model($babe) && $load_status;
            }

            return $load_status;
        }

        if ($model == '') {
            return false;
        }

        // Is the model in a sub-folder? If so, parse out the filename and path.
        if (strpos($model, '/') === false) {
            $path = '';
        } else {
            $x = explode('/', $model);
            $model = end($x);
            unset($x[count($x) - 1]);
            $path = implode('/', $x) . '/';
        }

        if ($name == '') {
            $name = $model;
        }

        if (in_array($name, $this->_ci_models, true)) {
            return true;
        }

        $CI = &get_instance();
        if (isset($CI->{$name})) {
            if ($return_status) {
                return false;
            }
            show_error('The model name you are loading is the name of a resource that is already being used: ' . $name);
        }

        // TODO: переделать после приведения к PSR
        $str_model = strpos($model, '_model') ?: strpos($model, 'Model');
        $module = strtolower(
            implode(
                '_',
                preg_split(
                    '/(?=[A-Z])/',
                    substr($model, 0, $str_model),
                    -1,
                    PREG_SPLIT_NO_EMPTY
                )
            )
        );

        if ($path) {
            $model_path = MODULEPATH . $path . $model . EXT;
        } else {
            $model_path = MODULEPATH . $module . '/models/' . $model . EXT;
        }

        // TODO: убрать после приведения к PSR
        if (!file_exists($model_path)) {
            if ($path) {
                $model_path = MODULEPATH . $path . strtolower($model) . EXT;
            } else {
                $model_path = MODULEPATH . $module . '/models/' . strtolower($model) . EXT;
            }
        }

        // TODO: убрать после приведения к PSR
        if (!file_exists($model_path)) {
            $chunks = explode('_', $model);
            $model = '';
            foreach ($chunks as $chunk) {
                $model .= ucfirst($chunk);
            }

            if ($path) {
                $model_path = MODULEPATH . $path . $model . EXT;
            } else {
                if (
                    !empty($_ENV['CUSTOM_MODE']) &&
                    file_exists(MODULEPATH . $module . '/models/' . $_ENV['CUSTOM_MODE'] . $model . EXT)
                ) {
                    $model_path = MODULEPATH . $module . '/models/' . $_ENV['CUSTOM_MODE'] . $model . EXT;
                } else {
                    $model_path = MODULEPATH . $module . '/models/' . $model . EXT;
                }
            }
        }

        if (!file_exists($model_path)) {
            show_error('Unable to locate the model you have specified: ' . $model);
        }

        if ($db_conn !== false and !class_exists('CI_DB', false)) {
            if ($db_conn === true) {
                $db_conn = '';
            }

            $CI->load->database($db_conn, false, true);
        }

        if (!class_exists('Model', false)) {
            load_class('Model', false);
        }

        // TODO: убрать после приведения к PSR
        //require_once $model_path;

        if ($create_object) {
            // TODO: убрать после приведения к PSR
            $model = ucfirst($model);
            if (!class_exists($model, false)) {
                // Try with namespace
                $model = $this->pathToNamespace($model_path);
            }

            $CI->$name = new $model();
            $CI->$name->_assign_libraries();
            $this->_ci_models[] = $name;
        }

        return true;
    }

    // TODO: убрать после приведения к PSR
    private function pathToNamespace($path)
    {
        $full_path = str_replace(
            [SITE_PHYSICAL_PATH . 'application', '/', EXT],
            ['', ' ', ''],
            $path
        );

        return NS_PREFIX . str_replace(' ', '\\', ltrim($full_path));
    }

    public function dm_model($model)
    {
        $this->model($model, null, null, false);
    }

    // --------------------------------------------------------------------

    /**
     * Database Loader
     *
     * @param   string  the DB credentials
     * @param   bool    whether to return the DB object
     * @param   bool    whether to enable active record (this allows us to override the config setting)
     *
     * @return object
     */
    public function database($params = '', $return = false, $active_record = false)
    {
        // Grab the super object
        $CI = &get_instance();

        // Do we even need to load the database class?
        if (class_exists('CI_DB') and $return == false and $active_record == false and isset($CI->db) and is_object($CI->db)) {
            return false;
        }

        require_once BASEPATH . 'database/DB' . EXT;

        if ($return === true) {
            return DB($params, $active_record);
        }

        // Initialize the db variable.  Needed to prevent
        // reference errors with some configurations
        $CI->db = '';

        // Load the DB class
        $CI->db = &DB($params, $active_record);

        // Assign the DB object to any existing models
        $this->_ci_assign_to_models();
    }

    // --------------------------------------------------------------------

    /**
     * Load the Utilities Class
     *
     * @return string
     */
    public function dbutil()
    {
        if (!class_exists('CI_DB')) {
            $this->database();
        }

        $CI = &get_instance();

        // for backwards compatibility, load dbforge so we can extend dbutils off it
        // this use is deprecated and strongly discouraged
        $CI->load->dbforge();

        require_once BASEPATH . 'database/DB_utility' . EXT;
        require_once BASEPATH . 'database/drivers/' . $CI->db->dbdriver . '/' . $CI->db->dbdriver . '_utility' . EXT;
        $class = 'CI_DB_' . $CI->db->dbdriver . '_utility';

        $CI->dbutil = new $class();

        $CI->load->_ci_assign_to_models();
    }

    // --------------------------------------------------------------------

    /**
     * Load the Database Forge Class
     *
     * @return string
     */
    public function dbforge()
    {
        if (!class_exists('CI_DB')) {
            $this->database();
        }

        $CI = &get_instance();

        require_once BASEPATH . 'database/DB_forge' . EXT;
        require_once BASEPATH . 'database/drivers/' . $CI->db->dbdriver . '/' . $CI->db->dbdriver . '_forge' . EXT;
        $class = 'CI_DB_' . $CI->db->dbdriver . '_forge';

        $CI->dbforge = new $class();

        $CI->load->_ci_assign_to_models();
    }

    // --------------------------------------------------------------------

    /**
     * Load View
     *
     * This function is used to load a "view" file.  It has three parameters:
     *
     * 1. The name of the "view" file to be included.
     * 2. An associative array of data to be extracted for use in the view.
     * 3. TRUE/FALSE - whether to return the data or load it.  In
     * some cases it's advantageous to be able to return data so that
     * a developer can process it in some way.
     *
     * @param   string
     * @param   array
     * @param   bool
     *
     * @return void
     */
    public function view($view, $vars = [], $return = false)
    {
        return $this->_ci_load(
            [
                    '_ci_view' => $view,
                    '_ci_vars' => $this->_ci_object_to_array($vars),
                    '_ci_return' => $return
                ]
        );
    }

    // --------------------------------------------------------------------

    /**
     * Load File
     *
     * This is a generic file loader
     *
     * @param   string
     * @param   bool
     *
     * @return string
     */
    public function file($path, $return = false)
    {
        return $this->_ci_load(['_ci_path' => $path, '_ci_return' => $return]);
    }

    // --------------------------------------------------------------------

    /**
     * Set Variables
     *
     * Once variables are set they become available within
     * the controller class and its "view" files.
     *
     * @param   array
     *
     * @return void
     */
    public function vars($vars = [], $val = '')
    {
        if ($val != '' and is_string($vars)) {
            $vars = [$vars => $val];
        }

        $vars = $this->_ci_object_to_array($vars);

        if (is_array($vars) and count($vars) > 0) {
            foreach ($vars as $key => $val) {
                $this->_ci_cached_vars[$key] = $val;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Load Helper
     *
     * This function loads the specified helper file.
     *
     * @param   mixed
     *
     * @return void
     */
    public function helper($helpers = [], $module = null)
    {
        if (!is_array($helpers)) {
            $helpers = [$helpers];
        }

        if (!empty($module)) {
            $ci = &get_instance();
            if (!$ci->pg_module->is_module_active($module)) {
                return false;
            }
        }

        $subclass_prefix = config_item('subclass_prefix');

        foreach ($helpers as $helper) {
            if (!$module) {
                $module = $helper;
            }

            $helper = str_replace(EXT, '', str_replace('_helper', '', $helper));

            if (isset($this->_ci_helpers[$helper])) {
                continue;
            }

            // Is this a helper extension request?
            if (file_exists(APPPATH . 'helpers/' . $subclass_prefix . $helper  . '_helper' . EXT)) {
                if (!file_exists(BASEPATH . 'helpers/' . $helper  . '_helper' . EXT)) {
                    show_error('Unable to load the requested file: helpers/' . $helper  . '_helper' . EXT);
                }

                include_once APPPATH . 'helpers/' . $subclass_prefix . $helper  . '_helper'  . EXT;
                include_once BASEPATH . 'helpers/' . $helper  . '_helper' . EXT;
            } elseif (file_exists(APPPATH . 'modules/' . $module . '/helpers/' . $helper . '_helper' . EXT)) {
                if (INSTALL_DONE && $module != 'install') {
                    $ci = &get_instance();
                    if (!$ci->pg_module->is_module_active($module)) {
                        return false;
                    }
                }
                include_once APPPATH . 'modules/' . $module . '/helpers/' . $helper . '_helper' . EXT;
            }
            // TODO: удалить после приведения к PSR
            elseif (file_exists(APPPATH . 'modules/' . $module . '/helpers/' . ($helper_psr = $this->toPSRName($helper)) . 'Helper' . EXT)) {
                if (INSTALL_DONE && $module != 'install') {
                    $ci = &get_instance();
                    if (!$ci->pg_module->is_module_active($module)) {
                        return false;
                    }
                }
                if (!empty($_ENV['CUSTOM_MODE']) &&
                    file_exists(APPPATH . 'modules/' . $module . "/helpers/{$_ENV['CUSTOM_MODE']}" . $helper_psr . 'Helper' . EXT)) {
                    include_once APPPATH . 'modules/' . $module . "/helpers/{$_ENV['CUSTOM_MODE']}" . $helper_psr . 'Helper' . EXT;
                }
                include_once APPPATH . 'modules/' . $module . '/helpers/' . $helper_psr . 'Helper' . EXT;
            } elseif (file_exists(APPPATH . 'helpers/' . $helper . '_helper' . EXT)) {
                include_once APPPATH . 'helpers/' . $helper . '_helper' . EXT;
            } else {
                if (file_exists(BASEPATH . 'helpers/' . $helper . '_helper' . EXT)) {
                    include_once BASEPATH . 'helpers/' . $helper . '_helper' . EXT;
                }
            }

            $this->_ci_helpers[$helper] = true;
            log_message('debug', 'Helper loaded: ' . $helper . '_helper');
        }
    }

    // --------------------------------------------------------------------

    /**
     * Load Helpers
     *
     * This is simply an alias to the above function in case the
     * user has written the plural form of this function.
     *
     * @param   array
     *
     * @return void
     */
    public function helpers($helpers = [])
    {
        $this->helper($helpers);
    }

    // --------------------------------------------------------------------

    /**
     * Load Plugin
     *
     * This function loads the specified plugin.
     *
     * @param   array
     *
     * @return void
     */
    public function plugin($plugins = [])
    {
        if (!is_array($plugins)) {
            $plugins = [$plugins];
        }

        foreach ($plugins as $plugin) {
            $plugin = strtolower(str_replace(EXT, '', str_replace('_pi', '', $plugin)) . '_pi');

            if (isset($this->_ci_plugins[$plugin])) {
                continue;
            }

            if (file_exists(APPPATH . 'plugins/' . $plugin . EXT)) {
                include_once APPPATH . 'plugins/' . $plugin . EXT;
            } else {
                if (file_exists(BASEPATH . 'plugins/' . $plugin . EXT)) {
                    include_once BASEPATH . 'plugins/' . $plugin . EXT;
                } else {
                    show_error('Unable to load the requested file: plugins/' . $plugin . EXT);
                }
            }

            $this->_ci_plugins[$plugin] = true;
            log_message('debug', 'Plugin loaded: ' . $plugin);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Load Plugins
     *
     * This is simply an alias to the above function in case the
     * user has written the plural form of this function.
     *
     * @param   array
     *
     * @return void
     */
    public function plugins($plugins = [])
    {
        $this->plugin($plugins);
    }

    // --------------------------------------------------------------------

    /**
     * Loads a language file
     *
     * @param   array
     * @param   string
     *
     * @return void
     */
    public function language($file = [], $lang = '')
    {
        $CI = &get_instance();

        if (!is_array($file)) {
            $file = [$file];
        }

        foreach ($file as $langfile) {
            $CI->lang->load($langfile, $lang);
        }
    }

    /**
     * Loads language files for scaffolding
     *
     * @param   string
     *
     * @return arra
     */
    public function scaffold_language($file = '', $lang = '', $return = false)
    {
        $CI = &get_instance();

        return $CI->lang->load($file, $lang, $return);
    }

    // --------------------------------------------------------------------

    /**
     * Loads a config file
     *
     * @param   string
     *
     * @return void
     */
    public function config($file = '', $use_sections = false, $fail_gracefully = false)
    {
        $CI = &get_instance();
        $CI->config->load($file, $use_sections, $fail_gracefully);
    }

    // --------------------------------------------------------------------

    /**
     * Scaffolding Loader
     *
     * This initializing function works a bit different than the
     * others. It doesn't load the class.  Instead, it simply
     * sets a flag indicating that scaffolding is allowed to be
     * used.  The actual scaffolding function below is
     * called by the front controller based on whether the
     * second segment of the URL matches the "secret" scaffolding
     * word stored in the application/config/routes.php
     *
     * @param   string
     *
     * @return void
     */
    public function scaffolding($table = '')
    {
        if ($table === false) {
            show_error('You must include the name of the table you would like to access when you initialize scaffolding');
        }

        $CI = &get_instance();
        $CI->_ci_scaffolding = true;
        $CI->_ci_scaff_table = $table;
    }

    // --------------------------------------------------------------------

    /**
     * Loader
     *
     * This function is used to load views and files.
     * Variables are prefixed with _ci_ to avoid symbol collision with
     * variables made available to view files
     *
     * @param   array
     *
     * @return void
     */
    public function _ci_load($_ci_data)
    {
        // Set the default data variables
        foreach (['_ci_view', '_ci_vars', '_ci_path', '_ci_return'] as $_ci_val) {
            $$_ci_val = (!isset($_ci_data[$_ci_val])) ? false : $_ci_data[$_ci_val];
        }

        // Set the path to the requested file
        if ($_ci_path == '') {
            $_ci_ext = pathinfo($_ci_view, PATHINFO_EXTENSION);
            $_ci_file = ($_ci_ext == '') ? $_ci_view . EXT : $_ci_view;
            $_ci_path = $this->_ci_view_path . $_ci_file;
        } else {
            $_ci_x = explode('/', $_ci_path);
            $_ci_file = end($_ci_x);
        }

        if (!file_exists($_ci_path)) {
            show_error('Unable to load the requested file: ' . $_ci_file);
        }

        // This allows anything loaded using $this->load (views, files, etc.)
        // to become accessible from within the Controller and Model functions.
        // Only needed when running PHP 5

        if ($this->_ci_is_instance()) {
            $_ci_CI = &get_instance();
            foreach (get_object_vars($_ci_CI) as $_ci_key => $_ci_var) {
                if (!isset($this->{$_ci_key})) {
                    $this->{$_ci_key} = &$_ci_CI->{$_ci_key};
                }
            }
        }

        /*
         * Extract and cache variables
         *
         * You can either set variables using the dedicated $this->load_vars()
         * function or via the second parameter of this function. We'll merge
         * the two types and cache them so that views that are embedded within
         * other views can have access to these variables.
         */
        if (is_array($_ci_vars)) {
            $this->_ci_cached_vars = array_merge($this->_ci_cached_vars, $_ci_vars);
        }
        extract($this->_ci_cached_vars);

        /*
         * Buffer the output
         *
         * We buffer the output for two reasons:
         * 1. Speed. You get a significant speed boost.
         * 2. So that the final rendered template can be
         * post-processed by the output class.  Why do we
         * need post processing?  For one thing, in order to
         * show the elapsed page load time.  Unless we
         * can intercept the content right before it's sent to
         * the browser and then stop the timer it won't be accurate.
         */
        ob_start();

        // If the PHP installation does not support short tags we'll
        // do a little string replacement, changing the short tags
        // to standard PHP echo statements.

        if ((bool) @ini_get('short_open_tag') === false and config_item('rewrite_short_tags') == true) {
            echo eval('?>' . preg_replace("/;*\s*\?>/", "; ?>", str_replace('<?=', '<?php echo ', file_get_contents($_ci_path))));
        } else {
            include $_ci_path; // include() vs include_once() allows for multiple views with the same name
        }

        log_message('debug', 'File loaded: ' . $_ci_path);

        // Return the file data if requested
        if ($_ci_return === true) {
            $buffer = ob_get_contents();
            @ob_end_clean();

            return $buffer;
        }

        /*
         * Flush the buffer... or buff the flusher?
         *
         * In order to permit views to be nested within
         * other views, we need to flush the content back out whenever
         * we are beyond the first level of output buffering so that
         * it can be seen and included properly by the first included
         * template and any subsequent ones. Oy!
         *
         */
        if (ob_get_level() > $this->_ci_ob_level + 1) {
            ob_end_flush();
        } else {
            // PHP 4 requires that we use a global
            global $OUT;
            $OUT->append_output(ob_get_contents());
            @ob_end_clean();
        }
    }

    // --------------------------------------------------------------------

    /**
     * Load class
     *
     * This function loads the requested class.
     *
     * @param   string  the item that is being loaded
     * @param   mixed   any additional parameters
     * @param   string  an optional object name
     *
     * @return void
     */
    public function _ci_load_class($class, $params = null, $object_name = null)
    {
        if ($object_name && false !== strpos($class, '\\') && class_exists($class)) {
            // Has namespace
            return $this->_ci_init_class($class, '', $params, $object_name);
        }
        // Get the class name, and while we're at it trim any slashes.
        // The directory path can be included as part of the class name,
        // but we don't want a leading slash
        $class = str_replace(EXT, '', trim($class, '/'));

        // Was the path included with the class name?
        // We look for a slash to determine this
        $subdir = '';
        if (strpos($class, '/') !== false) {
            // explode the path so we can separate the filename from the path
            $x = explode('/', $class);

            // Reset the $class variable now that we know the actual filename
            $class = end($x);

            // Kill the filename from the array
            unset($x[count($x) - 1]);

            // Glue the path back together, sans filename
            $subdir = implode($x, '/') . '/';
        }

        // We'll test for both lowercase and capitalized versions of the file name
        foreach ([ucfirst($class), strtolower($class)] as $class) {
            $subclass = APPPATH . 'libraries/' . $subdir . config_item('subclass_prefix') . $class . EXT;

            // Is this a class extension request?
            if (file_exists($subclass)) {
                $baseclass = BASEPATH . 'libraries/' . ucfirst($class) . EXT;

                if (!file_exists($baseclass)) {
                    log_message('error', "Unable to load the requested class: " . $class);
                    show_error("Unable to load the requested class: " . $class);
                }

                // Safety:  Was the class already loaded by a previous call?
                if (in_array($subclass, $this->_ci_loaded_files)) {
                    // Before we deem this to be a duplicate request, let's see
                    // if a custom object name is being supplied.  If so, we'll
                    // return a new instance of the object
                    if (!is_null($object_name)) {
                        $CI = &get_instance();
                        if (!isset($CI->{$object_name})) {
                            return $this->_ci_init_class($class, config_item('subclass_prefix'), $params, $object_name);
                        }
                    }

                    $is_duplicate = true;
                    log_message('debug', $class . " class already loaded. Second attempt ignored.");

                    return;
                }

                include_once $baseclass;
                include_once $subclass;
                $this->_ci_loaded_files[] = $subclass;

                return $this->_ci_init_class($class, config_item('subclass_prefix'), $params, $object_name);
            }

            // Lets search for the requested library file and load it.
            $is_duplicate = false;
            for ($i = 1; $i < 3; ++$i) {
                $path = ($i % 2) ? APPPATH : BASEPATH;
                $filepath = $path . 'libraries/' . $subdir . $class . EXT;

                // Does the file exist?  No?  Bummer...
                if (!file_exists($filepath)) {
                    continue;
                }

                // Safety:  Was the class already loaded by a previous call?
                if (in_array($filepath, $this->_ci_loaded_files)) {
                    // Before we deem this to be a duplicate request, let's see
                    // if a custom object name is being supplied.  If so, we'll
                    // return a new instance of the object
                    if (!is_null($object_name)) {
                        $CI = &get_instance();
                        if (!isset($CI->{$object_name})) {
                            return $this->_ci_init_class($class, '', $params, $object_name);
                        }
                    }

                    $is_duplicate = true;
                    log_message('debug', $class . " class already loaded. Second attempt ignored.");

                    return;
                }

                include_once $filepath;
                $this->_ci_loaded_files[] = $filepath;

                return $this->_ci_init_class($class, '', $params, $object_name);
            }
        } // END FOREACH
        // One last attempt.  Maybe the library is in a subdirectory, but it wasn't specified?
        if ($subdir == '') {
            $path = strtolower($class) . '/' . $class;

            return $this->_ci_load_class($path, $params);
        }

        // If we got this far we were unable to find the requested class.
        // We do not issue errors if the load call failed due to a duplicate request
        if ($is_duplicate == false) {
            log_message('error', "Unable to load the requested class: " . $class);
            show_error("Unable to load the requested class: " . $class);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Instantiates a class
     *
     * @param   string
     * @param   string
     * @param   string  an optional object name
     *
     * @return null
     */
    public function _ci_init_class($class, $prefix = '', $config = false, $object_name = null)
    {
        // Is there an associated config file for this class?
        if ($config === null) {
            // We test for both uppercase and lowercase, for servers that
            // are case-sensitive with regard to file names
            if (file_exists(APPPATH . 'config/' . strtolower($class) . EXT)) {
                include_once APPPATH . 'config/' . strtolower($class) . EXT;
            } else {
                if (file_exists(APPPATH . 'config/' . ucfirst(strtolower($class)) . EXT)) {
                    include_once APPPATH . 'config/' . ucfirst(strtolower($class)) . EXT;
                }
            }
        }

        if ($prefix == '') {
            if (class_exists('CI_' . $class)) {
                $name = 'CI_' . $class;
            } elseif (class_exists(config_item('subclass_prefix') . $class)) {
                $name = config_item('subclass_prefix') . $class;
            } else {
                $ns_class = NS_LIB . $class;
                if (class_exists($ns_class, false)) {
                    $name = $ns_class;
                } else {
                    $name = $class;
                }
            }
        } else {
            $name = $prefix . $class;
        }

        // Is the class name valid?
        if (!class_exists($name)) {
            log_message('error', "Non-existent class: " . $name);
            show_error("Non-existent class: " . $class);
        }

        // Set the variable name we will assign the class to
        // Was a custom class name supplied?  If so we'll use it
        $class = strtolower($class);

        if (is_null($object_name)) {
            $classvar = (!isset($this->_ci_varmap[$class])) ? $class : $this->_ci_varmap[$class];
        } else {
            $classvar = $object_name;
        }

        // Save the class name and object name
        $this->_ci_classes[$class] = $classvar;

        // Instantiate the class
        $CI = &get_instance();
        if ($config !== null) {
            $CI->{$classvar} = new $name($config);
        } else {
            $CI->{$classvar} = new $name();
        }
    }

    // --------------------------------------------------------------------

    /**
     * Autoloader
     *
     * The config/autoload.php file contains an array that permits sub-systems,
     * libraries, plugins, and helpers to be loaded automatically.
     *
     * @param   array
     *
     * @return void
     */
    public function _ci_autoloader()
    {
        include_once APPPATH . 'config/autoload' . EXT;

        if (!isset($autoload)) {
            return false;
        }

        // Load any custom config file
        if (count($autoload['config']) > 0) {
            $CI = &get_instance();
            foreach ($autoload['config'] as $key => $val) {
                $CI->config->load($val);
            }
        }

        // Autoload plugins, helpers and languages
        foreach (['helper', 'plugin', 'language'] as $type) {
            if (isset($autoload[$type]) and count($autoload[$type]) > 0) {
                $this->{$type}($autoload[$type]);
            }
        }

        // A little tweak to remain backward compatible
        // The $autoload['core'] item was deprecated
        if (!isset($autoload['libraries'])) {
            $autoload['libraries'] = $autoload['core'];
        }

        // Load libraries
        if (isset($autoload['libraries']) and count($autoload['libraries']) > 0) {
            // Load the database driver.
            if (in_array('database', $autoload['libraries'])) {
                $this->database();
                $autoload['libraries'] = array_diff($autoload['libraries'], ['database']);
            }

            // Load scaffolding
            if (in_array('scaffolding', $autoload['libraries'])) {
                $this->scaffolding();
                $autoload['libraries'] = array_diff($autoload['libraries'], ['scaffolding']);
            }

            // Load all other libraries
            foreach ($autoload['libraries'] as $item) {
                $this->library($item);
            }
        }

        // Autoload models
        if (isset($autoload['model'])) {
            $this->model($autoload['model']);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Assign to Models
     *
     * Makes sure that anything loaded by the loader class (libraries, plugins, etc.)
     * will be available to models, if any exist.
     *
     * @param   object
     *
     * @return array
     */
    public function _ci_assign_to_models()
    {
        if (count($this->_ci_models) == 0) {
            return;
        }

        if ($this->_ci_is_instance()) {
            $CI = &get_instance();
            foreach ($this->_ci_models as $model) {
                $CI->{$model}->_assign_libraries();
            }
        } else {
            foreach ($this->_ci_models as $model) {
                $this->{$model}->_assign_libraries();
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Object to Array
     *
     * Takes an object as input and converts the class variables to array key/vals
     *
     * @param   object
     *
     * @return array
     */
    public function _ci_object_to_array($object)
    {
        return (is_object($object)) ? get_object_vars($object) : $object;
    }

    // --------------------------------------------------------------------

    /**
     * Determines whether we should use the CI instance or $this
     *
     * @return bool
     */
    public function _ci_is_instance()
    {
        if ($this->_ci_is_php5 == true) {
            return true;
        }

        global $CI;

        return (is_object($CI)) ? true : false;
    }

    // TODO: удалить после приведения к PSR
    private function toPSRName($name)
    {
        $chunks = explode('_', $name);
        $name = '';
        foreach ($chunks as $chunk) {
            $name .= ucfirst($chunk);
        }

        return $name;
    }
}

/* End of file Loader.php */
/* Location: ./system/libraries/Loader.php */
