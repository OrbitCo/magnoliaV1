<?php

declare(strict_types=1);

namespace Pg\modules\properties\controllers;

use Pg\Libraries\View;
use Pg\modules\users\models\UsersTypesModel;

class AdminProperties extends \Controller
{
    
    /**
     * Class constructor
     *
     * @return AdminProperties
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Menu_model','Properties_model']);
        $this->Menu_model->set_menu_active_item('admin_menu', 'content_items');
    }

    /**
     * Index page
     *
     * @return void
     */
    public function index()
    {
        $lang_id = $this->pg_language->current_lang_id;
        $this->pg_language->ds->return_module($this->Properties_model->module_gid, $lang_id);
        $ds = $this->pg_language->ds->lang[$lang_id][$this->Properties_model->module_gid];

        foreach ($this->Properties_model->properties as $gid) {
            $properties[$gid] = $ds[$gid];
        }

        $this->view->setBackLink(site_url() . 'admin/start/menu/content_items');
        $this->view->assign('properties', $properties);
        $this->view->setHeader(l('admin_header_properties', 'properties'));
        $this->view->render('menu');
    }

    /**
     * Property page
     *
     * @param string $ds_gid
     * @param integer $lang_id
     *
     * @return void
     */
    public function property($ds_gid, $lang_id = null)
    {
        if (!$ds_gid) {
            $this->view->setRedirect(site_url() . 'admin/properties/index');
        } elseif (!$lang_id || !array_key_exists($lang_id, $this->pg_language->languages)) {
            $lang_id = $this->pg_language->current_lang_id;
        }
        $reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, $ds_gid, $lang_id);
        $header = l('admin_header_properties', 'properties') . ' : ' . $reference['header'];

        $this->view->setBackLink(site_url() . 'admin/properties/index');
        $this->view->setHeader($header);

        $this->view->assign('current_gid', $ds_gid);
        $this->view->assign('langs', $this->pg_language->languages);
        $this->view->assign('current_lang_id', $lang_id);
        $this->view->assign('reference', $reference);
        $this->view->assign('module_gid', $this->Properties_model->module_gid);
        $this->view->assign('ds_gid', $ds_gid);
        $this->view->render('list');
    }

    /**
     * Property items
     *
     * @param integer $lang_id
     * @param string $ds_gid
     * @param string $option_gid
     *
     * @return void
     */
    public function propertyItems($lang_id, $ds_gid, $option_gid = null)
    {
        if (!$lang_id || !array_key_exists($lang_id, $this->pg_language->languages)) {
            $lang_id = $this->pg_language->current_lang_id;
        }

        $reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, $ds_gid, $lang_id);
        if ($option_gid) {
            $add_flag = false;
            foreach ($this->pg_language->languages as $lid => $lang) {
                $r = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, $ds_gid, $lid);
                $lang_data[$lid] = $r["option"][$option_gid];
            }
        } else {
            $option_gid = "";
            $lang_data = [];
            $add_flag = true;
        }

        if ($this->input->post('btn_save')) {
            $lang_data = $this->input->post('lang_data', true);
            $default_lang_id = $this->pg_language->get_default_lang_id();
            $is_option_empty = false;
            foreach ($lang_data as $id => $l_val) {
                if (empty($l_val)) {
                    if (!empty($lang_data[$default_lang_id])) {
                        $lang_data[$id] = $lang_data[$default_lang_id];
                    } elseif (!empty($lang_data[$lang_id])) {
                        $lang_data[$id] = $lang_data[$lang_id];
                    } else {
                        $is_option_empty = true;
                    }
                }
            }
            if ($is_option_empty === true) {
                 $this->system_messages->addMessage(View::MSG_ERROR, l('error_option_name_required', 'properties'));
                 redirect(site_url() . '/admin/properties/property_items/' . $lang_id . '/' . $ds_gid);
            }
            $this->config->load('reg_exps', true);
            $prop_name_expr = $this->config->item('prop_name', 'reg_exps');

            if (empty($option_gid)) {
                if (!empty($reference["option"])) {
                    $array_keys = array_keys($reference["option"]);
                } else {
                    $array_keys = [0];
                }
                if (in_array($ds_gid, [UsersTypesModel::USER_TYPE, UsersTypesModel::LOOKING_USER_TYPE, UsersTypesModel::USER_TYPE_PLURAL]) !== false) {
                     $this->ci->load->model('users/models/Users_types_model');
                     $guid_data = $this->Users_types_model->createUserType($lang_data[$lang_id]);
                    if (!empty($guid_data["errors"])) {
                        $this->system_messages->addMessage(View::MSG_ERROR, $guid_data['errors']);
                        $this->view->setRedirect(site_url() . 'admin/properties/property_items/' . $lang_id . '/' . $ds_gid);
                    } else {
                        $option_gid = $guid_data['data']['name'];
                        $types = ($ds_gid == UsersTypesModel::USER_TYPE) ?
                           [UsersTypesModel::LOOKING_USER_TYPE, UsersTypesModel::USER_TYPE_PLURAL]
                           : [UsersTypesModel::USER_TYPE, UsersTypesModel::USER_TYPE_PLURAL];
                        foreach ($types as $type) {
                            foreach ($lang_data as $lid => $string) {
                                if (preg_match($prop_name_expr, $string)) {
                                    $looking_reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, $type, $lid);
                                    $looking_reference["option"][$option_gid] = $string;
                                    $this->pg_language->ds->set_module_reference($this->Properties_model->module_gid, $type, $looking_reference, $lid);
                                }
                            }
                        }
                    }
                } else {
                    $option_gid = max($array_keys) + 1;
                }
            }
            $is_err = false;
            foreach ($lang_data as $lid => $string) {
                if (empty($string) || ($ds_gid === UsersTypesModel::USER_TYPE && !preg_match($prop_name_expr, $string))) {
                    $this->system_messages->addMessage(View::MSG_ERROR, l('error_option_name_required', 'properties') . ': ' . $this->pg_language->languages[$lid]['name']);
                    $is_err = true;
                    continue;
                } elseif (!array_key_exists($lid, $this->pg_language->languages)) {
                    continue;
                }
                $reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, $ds_gid, $lid);
                $reference["option"][$option_gid] = $string;
                $this->pg_language->ds->set_module_reference($this->Properties_model->module_gid, $ds_gid, $reference, $lid);
            }
            if (!$is_err) {
                if ($add_flag) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_added_property_item', 'properties'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_updated_property_item', 'properties'));
                }

                $url = site_url() . "admin/properties/property/" . $ds_gid . "/" . $lang_id;
                redirect($url);
            }
        }

        $this->view->assign('lang_data', $lang_data);
        $this->view->assign('langs', $this->pg_language->languages);
        $this->view->assign('current_lang_id', $lang_id);
        $this->view->assign('current_module_gid', $this->Properties_model->module_gid);
        $this->view->assign('current_gid', $ds_gid);
        $this->view->assign('option_gid', $option_gid);
        $this->view->assign('add_flag', $add_flag);

        $this->view->setHeader(l('admin_header_property_item_edit', 'properties'));
        $this->view->render('edit_ds_item');
    }

    public function dsItemDelete($gid, $option_gid)
    {
        
        if (in_array($gid, [UsersTypesModel::USER_TYPE, UsersTypesModel::LOOKING_USER_TYPE]) !== false) {
            $is_type_used = $this->Properties_model->isUserTypeUsed($option_gid);
            if ($is_type_used === true) {
                $this->system_messages->addMessage(View::MSG_ERROR, l('error_user_type_used', 'properties'));
                $this->view->setRedirect(site_url() . 'admin/properties/property/' . $gid);
            }
            $this->load->model('users/models/Users_types_model');
            $this->Users_types_model->deleteTypes([$option_gid]);
            foreach ($this->pg_language->languages as $lid => $lang) {
                $reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, UsersTypesModel::USER_TYPE, $lid);
                if (isset($reference["option"][$option_gid])) {
                    unset($reference["option"][$option_gid]);
                    $this->pg_language->ds->set_module_reference($this->Properties_model->module_gid, UsersTypesModel::USER_TYPE, $reference, $lid);
                }
                $reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, UsersTypesModel::LOOKING_USER_TYPE, $lid);
                if (isset($reference["option"][$option_gid])) {
                    unset($reference["option"][$option_gid]);
                    $this->pg_language->ds->set_module_reference($this->Properties_model->module_gid, UsersTypesModel::LOOKING_USER_TYPE, $reference, $lid);
                }
            }
        } else {
            if ($gid && $option_gid) {
                foreach ($this->pg_language->languages as $lid => $lang) {
                    $reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, $gid, $lid);
                    if (isset($reference["option"][$option_gid])) {
                        unset($reference["option"][$option_gid]);
                        $this->pg_language->ds->set_module_reference($this->Properties_model->module_gid, $gid, $reference, $lid);
                    }
                }
            }
        }
        $this->view->setRedirect(site_url() . 'admin/properties/property/' . $gid);
        return;
    }


    public function ajaxDsItemDelete($gid, $option_gid)
    {
        if ($gid && $option_gid) {
            foreach ($this->pg_language->languages as $lid => $lang) {
                $reference = $this->pg_language->ds->get_reference($this->Properties_model->module_gid, $gid, $lid);
                if (isset($reference["option"][$option_gid])) {
                    unset($reference["option"][$option_gid]);
                    $this->pg_language->ds->set_module_reference($this->Properties_model->module_gid, $gid, $reference, $lid);
                }
            }
        }

        return;
    }

    public function ajaxDsItemSaveSorter($gid)
    {
        $sorter = $this->input->post("sorter");
        foreach ($sorter as $parent_str => $items_data) {
            foreach ($items_data as $item_str => $sort_index) {
                $option_gid = str_replace("item_", "", $item_str);
                $sorter_data[$sort_index] = $option_gid;
            }
        }

        if (empty($sorter_data)) {
            return;
        }
        ksort($sorter_data);
        $this->pg_language->ds->set_reference_sorter($this->Properties_model->module_gid, $gid, $sorter_data);

        return;
    }
}
