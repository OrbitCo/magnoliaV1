<?php

/**
 * Date management
 *
 * @package PG_Core
 * @subpackage Helpers
 *
 * @category    helpers
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Mikhail Makeev <mmakeev@pilotgroup.net>
 *
 * @version $Revision: 68 $ $Date: 2010-01-11 16:02:23 +0300 (Пн, 11 янв 2010) $ $Author: irina $
 **/

if (!function_exists('tpl_date_format')) {
    function tpl_date_format($string, $format = "%b %e, %Y", $default_date = null, $default = '')
    {
        $timestamp = tpl_make_timestamp($string);
        if ($string != '' && $timestamp > 0) {
            $ci = &get_instance();

            return $ci->pg_date->strftime($format, $timestamp);
        } elseif ($timestamp == 0) {
            if (!$string && !empty($default_date)) {
                $string = $default_date;
            } else {
                $string = date('Y-m-d');
            }

            $ci = &get_instance();
            $timestamp = tpl_make_timestamp($string);
            return $ci->pg_date->strftime($format, $timestamp);

        } elseif ($string != '0000-00-00 00:00:00' && $timestamp < 0) {
            $date = date_create($string);
            return strftime($format, strtotime($string));
        } elseif (!empty($default_date)) {
            return strftime($format, tpl_make_timestamp($default_date));
        } else {
            return $default;
        }
    }
}

if (!function_exists('tpl_make_timestamp')) {
    function tpl_make_timestamp($string = "now")
    {
        // is mysql timestamp format of YYYYMMDDHHMMSS?
        if (is_numeric($string) && strlen($string) == 14) {
            return mktime(substr($string, 8, 2),
                substr($string, 10, 2),
                substr($string, 12, 2),
                substr($string, 4, 2),
                substr($string, 6, 2),
                substr($string, 0, 4));
        } else {
            return strtotime($string);
        }
    }
}

if (!function_exists('tpl_convert_date_format')) {
    function tpl_convert_date_format($format)
    {
        $convert = [
            '%e' => 'd',
            '%a' => 'D',
            '%A' => 'l',
            '%b' => 'M',
            '%B' => 'F',
            '%C' => '', // Century
            '%d' => 'd',
            '%D' => 'm/d/y',
            '%e' => 'j',
            '%g' => 'y',
            '%G' => 'Y',
            '%h' => 'M',
            '%H' => 'H',
            '%I' => 'h',
            '%j' => 'z', //
            '%m' => 'm',
            '%M' => 'i',
            '%n' => "\n",
            '%p' => 'a',
            '%r' => 'g:i a',
            '%R' => 'G:i',
            '%S' => 's',
            '%t' => "\t",
            '%T' => 'H:i:s',
            '%u' => 'w', //
            '%U' => 'W',
            '%V' => 'W',
            '%W' => 'W',
            '%w' => 'w',
            '%x' => '',
            '%X' => '',
            '%y' => 'y',
            '%Y' => 'Y',
            '%Z' => 'T',
            '%%' => '%',
        ];
        foreach ($convert as $key => $value) {
            $format = str_replace($key, $value, $format);
        }

        return $format;
    }
}

if (!function_exists('tpl_date_diff')) {
    function tpl_date_diff($date, $date_now = null, $date_format = null, $return_if_now_is_smaller = true)
    {
        if (empty($date) || $date == \Pg\modules\services\models\ServicesModel::DB_DEFAULT_DATE) {
            return 'never_expires';
        }
        $date_now = (empty($date_now)) ? "now" : $date_now;

        $date_time_from = new DateTime($date);
        $date_time_to = new DateTime($date_now);
        if ($return_if_now_is_smaller && $date_time_from < $date_time_to) {
            return false;
        }

        $interval = $date_time_from->diff($date_time_to);

        if (empty($date_format)) {
            $date_format = ($interval->days <= 0) ?
                    (
                        ($interval->h <= 0) ?
                            '%i '.l('date_diff_minutes', 'services').' '.
                            '%s '.l('date_diff_seconds', 'services') :
                            '%h '.l('date_diff_hours', 'services')
                    ) :
                    '%a '.l('date_diff_days', 'services');
        }
        return $interval->format($date_format);
    }
}

if (!function_exists('tpl_date_diff_from_now')) {
    function tpl_date_diff_from_now($date, $return_if_now_is_smaller = true)
    {
        $res = tpl_date_diff($date, null, null, $return_if_now_is_smaller);
        if ($res == 'never_expires') {
            return l('date_diff_never_expires', 'services');
        }
        return (empty($res)) ? '' : $res.' '.l('date_diff_left', 'services');
    }
}
