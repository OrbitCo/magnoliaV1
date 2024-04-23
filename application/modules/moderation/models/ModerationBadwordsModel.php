<?php

declare(strict_types=1);

namespace Pg\modules\moderation\models;

define('MODERATION_BADWORDS_TABLE', DB_PREFIX . 'moderation_badwords');

/**
 * Moderation badwords model
 *
 * @package PG_Dating
 * @subpackage application
 *
 * @category    modules
 *
 * @copyright Pilot Group <http://www.pilotgroup.net/>
 * @author Katya Kashkova <katya@pilotgroup.net>
 *
 * @version $Revision: 2 $ $Date: 2010-04-02 15:07:07 +0300 (Ср, 02 апр 2010) $ $Author: kkashkova $
 */
class ModerationBadwordsModel extends \Model
{
    public $badwords_params_cache = [];

    public function getBadwords()
    {
        $this->ci->db->select('id, original')->from(MODERATION_BADWORDS_TABLE)->order_by("search");
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            foreach ($result as $item) {
                $list[] = get_object_vars($item);
            }

            return $list;
        } else {
            return [];
        }
    }

    public function setBadword($word)
    {
        $errors = [];
        $word_arr = explode(" ", trim(strip_tags($word)));
        foreach ($word_arr as $word) {
            $data["original"] = trim($word);
            $data["original"] = str_replace(["_", ",", ":", ";"], " ", $data["original"]);
            $data["original"] = preg_replace("/[\n\t]/u", "", $data["original"]);

            $data["search"] = mb_strtoupper(preg_replace("/[^\pL\s0-9\.]/u", "", $data["original"]), 'utf8');
            if (!strlen($data["original"]) || !strlen($data["search"])) {
                continue;
            }

            $data["search_len"] = strlen($data["search"]);
            $data["search_ord"] = ord($data["search"]);

            $similar_arr = $this->get_similar_words($data["search"]);
            if (count($similar_arr) > 0) {
                $errors[] = l('badwords_in_base_exists', 'moderation') . ": " . implode(", ", $similar_arr);
            } else {
                $this->ci->db->insert(MODERATION_BADWORDS_TABLE, $data);
            }
        }
        $this->badwords_params_cache = [];

        return $errors;
    }

    public function remapBadwords()
    {
        $this->ci->db->select('id, search')->from(MODERATION_BADWORDS_TABLE);
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            foreach ($result as $item) {
                $data["search_len"] = strlen($item->search);
                $data["search_ord"] = ord($item->search);
                $this->ci->db->where("id", $item->id);
                $this->ci->db->update(MODERATION_BADWORDS_TABLE, $data);
            }
        }
    }

    public function deleteBadword($id)
    {
        $this->ci->db->where("id", intval($id));
        $this->ci->db->delete(MODERATION_BADWORDS_TABLE);
        $this->badwords_params_cache = [];
    }

    public function getSimilarWords($search_word)
    {
        $this->ci->db->select('id, original')->from(MODERATION_BADWORDS_TABLE)->where("search", $search_word);
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            foreach ($result as $item) {
                $list[] = $item->original;
            }

            return $list;
        } else {
            return [];
        }
    }

    public function getBadwordsParams()
    {
        if (empty($this->badwords_params_cache)) {
            $return = [];
            $this->ci->db->select("DISTINCT search_len")->from(MODERATION_BADWORDS_TABLE);
            $result = $this->ci->db->get()->result();
            if (!empty($result)) {
                foreach ($result as $item) {
                    $return["len"][] = $item->search_len;
                }
            }
            $this->ci->db->select("DISTINCT search_ord")->from(MODERATION_BADWORDS_TABLE);
            $result = $this->ci->db->get()->result();
            if (!empty($result)) {
                foreach ($result as $item) {
                    $return["ord"][] = $item->search_ord;
                }
            }
        }
        $this->badwords_params_cache = $return;

        return $this->badwords_params_cache;
    }

    public function searchInText($text)
    {
        $text = str_replace(["_", ",", ":", ";"], " ", $text);
        $text = preg_replace("/[\n\t]/u", " ", $text);
        $text = mb_strtoupper(preg_replace("/[^\pL\s0-9\.]/u", "", $text), 'utf8');
        $text_array = preg_split("/[\s]+/", $text);
        $text_array_mb = mb_split(" ", $text);
        $text_array = array_unique($text_array);

        $this->ci->db->select("id, search")->from(MODERATION_BADWORDS_TABLE)->where_in("search", $text_array_mb);
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            $return["text"] = " " . $text . " ";
            foreach ($result as $item) {
                $return["text"] = str_replace(" " . $item->search . " ", " <span class='bwmark'>" . $item->search . "</span> ", $return["text"]);
            }
            $return["count"] = count($result);
        } else {
            $return["text"] = $text;
            $return["count"] = 0;
        }

        return $return;
    }

    public function checkBadwords($mtype, $text)
    {
        $this->ci->load->model('moderation/models/Moderation_type_model');
        $type_data = $this->ci->Moderation_type_model->get_type_by_name($mtype);
        if (empty($type_data) || $type_data["check_badwords"] == 0) {
            return 0;
        }
        $text = str_replace(["_", ",", ":", ";"], " ", $text);
        $text = preg_replace("/[\n\t]/u", " ", $text);
        $text = mb_strtoupper(preg_replace("/[^\pL\s0-9\.]/u", "", $text), 'utf8');
        $text_array = preg_split("/[\s]+/", $text);
        $text_array = array_unique($text_array);

        $this->ci->db->select("COUNT(*) AS cnt")->from(MODERATION_BADWORDS_TABLE)->where_in("search", $text_array);
        $result = $this->ci->db->get()->result();
        if (!empty($result)) {
            return intval($result[0]->cnt);
        } else {
            return 0;
        }
    }

    public function __call($name, $args)
    {
        $methods = [
            'check_badwords' => 'checkBadwords',
            'delete_badword' => 'deleteBadword',
            'get_badwords' => 'getBadwords',
            'get_badwords_params' => 'getBadwordsParams',
            'get_similar_words' => 'getSimilarWords',
            'remap_badwords' => 'remapBadwords',
            'search_in_text' => 'searchInText',
            'set_badword' => 'setBadword',
        ];

        if (!isset($methods[$name])) {
            throw new \Exception('Unknown method ' . $method);
        }

        return call_user_func_array([$this, $methods[$name]], $args);
    }
}
