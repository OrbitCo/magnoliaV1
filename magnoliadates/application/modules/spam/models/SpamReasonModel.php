<?php

declare(strict_types=1);

namespace Pg\modules\spam\models;

/**
 * Spam reason model
 *
 * @package PG_RealEstate
 * @subpackage Spam
 *
 * @category    models
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 */
class SpamReasonModel extends \Model
{
    /**
     * @var array
     */
    public $content = ["spam_object"];

    /**
     * Module GID
     *
     * @var string
     */
    public $module_gid = "spam";

    /**
     * Return reason by gid
     *
     * @param integer $lang_id
     *
     * @return string
     */
    public function getReason($lang_id = null)
    {
        if (!$lang_id) {
            $lang_id = $this->ci->session->userdata("lang_id");
        }

        return $this->ci->pg_language->ds->get_reference($this->module_gid, "spam_object", $lang_id);
    }

    /**
     * Validate data
     *
     * @param string $option_gid
     * @param array  $langs
     *
     * @return array
     */
    public function validateReason($option_gid, $langs)
    {
        $return = ["errors" => [], 'langs' => []];

        if (!empty($langs)) {
            foreach ($this->ci->pg_language->languages as $lid => $lang_data) {
                if (!isset($langs[$lid])) {
                    $return['errors'][] = l('error_empty_reason_name', "spam");
                    break;
                } else {
                    $return["langs"][$lid] = trim(strip_tags($langs[$lid]));
                    if (empty($return["langs"][$lid])) {
                        $return['errors'][] = l('error_empty_reason_name', "spam");
                        break;
                    }
                }
            }
        }

        return $return;
    }

    /**
     * Save data
     *
     * @param string $option_gid
     * @param array  $langs
     *
     * @return array
     */
    public function saveReason($option_gid, $langs)
    {
        if (empty($option_gid)) {
            $reference = $this->ci->pg_language->ds->get_reference(
                $this->module_gid,
                $this->content[0],
                $this->ci->pg_language->current_lang_id
            );
            if (!empty($reference["option"])) {
                $array_keys = array_keys($reference["option"]);
            } else {
                $array_keys = [0];
            }
            $option_gid = max($array_keys) + 1;
        }

        foreach ($langs as $lid => $string) {
            $reference = $this->ci->pg_language->ds->get_reference(
                $this->module_gid,
                $this->content[0],
                $lid
            );
            $reference["option"][$option_gid] = $string;
            $this->ci->pg_language->ds->set_module_reference(
                $this->module_gid,
                $this->content[0],
                $reference,
                $lid
            );
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'get_reason' => 'getReason',
            'save_reason' => 'saveReason',
            'validate_reason' => 'validateReason',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
