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
 * Postgre Utility Class
 *
 * @category    Database
 *
 * @author      ExpressionEngine Dev Team
 *
 * @link        http://codeigniter.com/user_guide/database/
 */
class CI_DB_postgre_utility extends CI_DB_utility
{
    /**
     * List databases
     *
     * @return bool
     */
    public function _list_databases()
    {
        return "SELECT datname FROM pg_database";
    }

    // --------------------------------------------------------------------

    /**
     * Optimize table query
     *
     * Is table optimization supported in Postgre?
     *
     * @param   string  the table name
     *
     * @return object
     */
    public function _optimize_table($table)
    {
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Repair table query
     *
     * Are table repairs supported in Postgre?
     *
     * @param   string  the table name
     *
     * @return object
     */
    public function _repair_table($table)
    {
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Postgre Export
     *
     * @param   array   Preferences
     *
     * @return mixed
     */
    public function _backup($params = [])
    {
        // Currently unsupported
        return $this->db->display_error('db_unsuported_feature');
    }

    /**
     * The functions below have been deprecated as of 1.6, and are only here for backwards
     * compatibility.  They now reside in dbforge().  The use of dbutils for database manipulation
     * is STRONGLY discouraged in favour if using dbforge.
     */

    /**
     * Create database
     *
     * @param   string  the database name
     *
     * @return bool
     */
    public function _create_database($name)
    {
        return "CREATE DATABASE " . $name;
    }

    // --------------------------------------------------------------------

    /**
     * Drop database
     *
     * @param   string  the database name
     *
     * @return bool
     */
    public function _drop_database($name)
    {
        return "DROP DATABASE " . $name;
    }
}

/* End of file postgre_utility.php */
/* Location: ./system/database/drivers/postgre/postgre_utility.php */
