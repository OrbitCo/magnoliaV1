<?php

declare(strict_types=1);

namespace Pg\modules\languages\controllers;

use Pg\Libraries\View;
use Pg\modules\users\models\UsersTypesModel;

/**
 * Languages admin side controller
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
 * */
class AdminLanguages extends \Controller
{
    /**
     * link to CodeIgniter object
     *
     * @var object
     */

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->Menu_model->set_menu_active_item('admin_menu', 'content_items');
    }

    /**
     * Display Index page
     */
    public function index()
    {
        $this->langs();
    }

    /**
     * Langs page
     *
     * @return void
     */
    public function langs()
    {
        $this->view->assign('languages', $this->pg_language->languages);
        $this->view->assign(
            'default_lang_id',
            $this->pg_language->get_default_lang_id()
        );
        $this->view->assign('TRIAL_MODE', TRIAL_MODE);
        $this->Menu_model->set_menu_active_item(
            'admin_languages_menu',
            'languages_list_item'
        );
        $this->view->setHeader(l('admin_header_languages_list', 'languages'));
        $this->view->render('list_langs');
    }

    /**
     * Save default lang
     *
     * @param integer $lang_id
     */
    public function langDefault($lang_id)
    {
        if (!empty($lang_id)) {
            if ($this->pg_language->is_active($lang_id)) {
                $this->pg_language->set_default_lang($lang_id);
                $this->system_messages->addMessage(
                    View::MSG_SUCCESS,
                    l('success_defaulted_lang', 'languages', $lang_id)
                );
            } else {
                $this->system_messages->addMessage(
                    View::MSG_ERROR,
                    l('error_default_inactive_lang', 'languages')
                );
            }
        }
        $url = site_url() . "admin/languages/langs";
        redirect($url);
    }

    public function langActive($lang_id, $status = '1')
    {
        if (!empty($lang_id)) {
            $data["status"] = intval($status);
            $this->pg_language->set_lang($lang_id, $data);
            $this->system_messages->addMessage(
                View::MSG_SUCCESS,
                l('success_updated_lang', 'languages')
            );
        }
        $url = site_url() . "admin/languages/langs";
        redirect($url);
    }

    public function langEdit($lang_id = null)
    {
        $data = [];
        if ($lang_id) {
            $data = $this->pg_language->languages[$lang_id];
        }

        if ($this->input->post('btn_save')) {
            $post_data = [
                "name" => $this->input->post('name', true),
                "code" => $this->input->post('code', true),
                "rtl" => $this->input->post('rtl', true),
            ];
            $validate_data = $this->pg_language->validate_lang(
                $lang_id,
                $post_data
            );
            if (!empty($validate_data["errors"])) {
                $this->system_messages->addMessage(
                    View::MSG_ERROR,
                    $validate_data["errors"]
                );
                $data = array_merge($data, $validate_data["data"]);
            } else {
                $data = $validate_data["data"];
                $this->pg_language->set_lang($lang_id, $data);

                if ($lang_id) {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_updated_lang', 'languages')
                    );
                } else {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_added_lang', 'languages')
                    );
                }

                $url = site_url() . "admin/languages/langs";
                redirect($url);
            }
        }

        $this->view->assign('data', $data);

        $this->view->setHeader(l('admin_header_language_edit', 'languages'));
        $this->view->render('edit_lang');
    }

    public function langDelete($lang_id)
    {
        if (!empty($lang_id)) {
            if ($this->pg_language->get_default_lang_id() == $lang_id) {
                $this->system_messages->addMessage(
                    View::MSG_ERROR,
                    l('error_delete_default_lang', 'languages')
                );
            } elseif ($this->pg_language->current_lang_id == $lang_id) {
                $this->system_messages->addMessage(
                    View::MSG_ERROR,
                    l('error_delete_current_lang', 'languages')
                );
            } elseif ($this->pg_language->languages[$lang_id]) {
                $this->pg_language->delete_lang($lang_id);
                $this->system_messages->addMessage(
                    View::MSG_SUCCESS,
                    l('success_deleted_lang', 'languages')
                );
            }
        }
        $url = site_url() . "admin/languages/langs";
        redirect($url);
    }

    public function pages($lang_id = null, $module_id = null)
    {
        $this->view->assign('langs', $this->pg_language->languages);
        $array_ids = array_column($this->pg_language->languages,'id');
        if ($lang_id == null || !in_array($lang_id,$array_ids)) {
            $lang_id = $this->pg_language->current_lang_id;
        }

        $this->view->assign('current_lang_id', $lang_id);

        $modules = $this->pg_module->return_modules();

        $this->view->assign('modules', $modules);
        if ($module_id == null) {
            $first_module = current($modules);
            $module_id = $first_module["id"];
        }
        $this->view->assign('current_module_id', $module_id);

        if ($module_id == 'mobile_app') {
            $current_module = ['module_gid' => 'mobile_app'];
        } else {
            $current_module = $modules[$module_id];
        }

        $this->pg_language->pages->return_module(
            $current_module["module_gid"],
            $lang_id
        );
        $pages = $this->pg_language->pages->lang[$lang_id][$current_module["module_gid"]];
        $this->view->assign('pages', $pages);
        $this->view->assign('TRIAL_MODE', TRIAL_MODE);
        $this->Menu_model->set_menu_active_item(
            'admin_languages_menu',
            'languages_pages_item'
        );

        $this->view->setHeader(l('admin_header_pages_list', 'languages'));
        $this->view->render('list_pages');
    }

    public function pagesDelete($lang_id, $module_id, $gid)
    {
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];
        if ($gid) {
            $this->pg_language->pages->delete_string($module_gid, $gid);
        }
        $url = site_url() . "admin/languages/pages/" . $lang_id . "/" . $module_id;
        redirect($url);
    }

    public function pagesEdit($lang_id, $module_id, $gid = null)
    {
        $modules = $this->pg_module->return_modules();

        if ($module_id == 'mobile_app') {
            $module_gid = 'mobile_app';
        } else {
            $module_gid = $modules[$module_id]["module_gid"];
        }

        if ($gid) {
            $this->view->assign('gid', $gid);
            foreach ($this->pg_language->languages as $lid => $lang) {
                $lang_data[$lid] = $this->pg_language->get_string(
                    $module_gid,
                    $gid,
                    $lid
                );
            }
        } else {
            $lang_data = [];
        }

        if ($this->input->post('btn_save')) {
            $errors = [];
            if (empty($gid)) {
                $post_gid = trim(strip_tags($this->input->post('gid', true)));
                $post_gid = preg_replace('/[^a-z0-9_\-\s]+/i', '', $post_gid);
                $post_gid = preg_replace('/\s+/i', '_', trim($post_gid));
                if (empty($post_gid)) {
                    $errors[] = l('error_gid_incorrect', 'languages');
                }
                if (
                    $this->pg_language->pages->is_string_exists(
                        $module_gid,
                        $post_gid
                    )
                ) {
                    $errors[] = l('error_gid_exists', 'languages');
                } else {
                    $gid = $post_gid;
                }
            }
            $lang_data = $this->input->post('lang_data', true);

            if (!empty($errors)) {
                $this->system_messages->addMessage(View::MSG_ERROR, $errors);
            } else {
                foreach ($lang_data as $lid => $string) {
                    $this->pg_language->pages->set_string(
                        $module_gid,
                        $gid,
                        $string,
                        $lid
                    );
                }

                if (isset($post_gid)) {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_added_page', 'languages')
                    );
                } else {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_updated_page', 'languages')
                    );
                }
                $url = site_url() . "admin/languages/pages/" . $lang_id . "/" . $module_id;
                redirect($url);
            }
        }

        $this->view->assign('lang_data', $lang_data);
        $this->view->assign('langs', $this->pg_language->languages);
        $this->view->assign('current_lang_id', $lang_id);
        $this->view->assign('current_module_id', $module_id);

        $this->view->setHeader(l('admin_header_page_change', 'languages'));
        $this->view->render('edit_page');
    }

    public function ajaxPagesDelete($lang_id, $module_id)
    {
        $strings = $this->input->post("gids", true);
        if (empty($strings)) {
            return;
        }
        $modules = $this->pg_module->return_modules();

        if ($module_id == 'mobile_app') {
            $module_gid = 'mobile_app';
        } else {
            $module_gid = $modules[$module_id]["module_gid"];
        }

        $this->pg_language->pages->delete_strings($module_gid, $strings);

        return;
    }

    public function ajaxPagesSave($lang_id, $module_id)
    {
        $gid = $this->input->post("id", true);
        $value = $this->input->post("text", true);
        $modules = $this->pg_module->return_modules();

        if ($module_id == 'mobile_app') {
            $module_gid = 'mobile_app';
        } else {
            $module_gid = $modules[$module_id]["module_gid"];
        }

        if (!empty($gid)) {
            $this->pg_language->pages->set_string(
                $module_gid,
                $gid,
                $value,
                $lang_id
            );
        }
        echo $value;
    }

    /**
     *  Datasource
     *
     * @param integer $lang_id
     * @param integer $module_id
     *
     * @return void
     */
    public function ds($lang_id = null, $module_id = null)
    {
        $this->view->assign('langs', $this->pg_language->languages);
        if (!$lang_id) {
            $lang_id = $this->pg_language->get_default_lang_id();
        }
        $this->view->assign('current_lang_id', $lang_id);

        $modules = $this->pg_module->return_modules();

        $this->view->assign('modules', $modules);
        if (!$module_id) {
            $first_module = current($modules);
            $module_id = $first_module["id"];
        }
        $this->view->assign('current_module_id', $module_id);

        $this->load->model('Languages_model');
        $current_module = $this->Languages_model->isDisabledDSActions($modules[$module_id]);
        $this->view->assign('current_module', $current_module);

        $this->pg_language->ds->return_module(
            $current_module["module_gid"],
            $lang_id
        );
        $ds = $this->pg_language->ds->lang[$lang_id][$current_module["module_gid"]];

        $this->view->assign('ds', $ds);
        $this->view->assign('TRIAL_MODE', TRIAL_MODE);

        $this->Menu_model->set_menu_active_item(
            'admin_languages_menu',
            'languages_ds_item'
        );
        $this->view->setHeader(l('admin_header_ds_list', 'languages'));
        $this->view->render('list_ds');
    }

    public function dsEdit($lang_id, $module_id, $gid = null)
    {
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];

        if ($gid) {
            $this->view->assign('gid', $gid);
            foreach ($this->pg_language->languages as $lid => $lang) {
                $reference = $this->pg_language->ds->get_reference(
                    $module_gid,
                    $gid,
                    $lid
                );
                $lang_data[$lid] = $reference["header"];
            }
        } else {
            $lang_data = [];
        }

        if ($this->input->post('btn_save')) {
            $errors = [];
            if (empty($gid)) {
                $post_gid = trim(strip_tags($this->input->post('gid', true)));
                $post_gid = preg_replace('/[^a-z0-9_\-\s]+/i', '', $post_gid);
                $post_gid = preg_replace('/\s+/i', '-', trim($post_gid));
                if (empty($post_gid)) {
                    $errors[] = l('error_gid_incorrect', 'languages');
                }
                if ($this->pg_language->ds->is_ds_exists($module_gid, $post_gid)) {
                    $errors[] = l('error_gid_exists', 'languages');
                } else {
                    $gid = $post_gid;
                }
            }
            $lang_data = $this->input->post('lang_data', true);

            if (!empty($errors)) {
                $this->system_messages->addMessage(View::MSG_ERROR, $errors);
            } else {
                foreach ($lang_data as $lid => $string) {
                    $reference = $this->pg_language->ds->get_reference(
                        $module_gid,
                        $gid,
                        $lid
                    );
                    $reference["header"] = $string;
                    $this->pg_language->ds->set_module_reference(
                        $module_gid,
                        $gid,
                        $reference,
                        $lid
                    );
                }

                if (isset($post_gid)) {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_added_ds', 'languages')
                    );
                } else {
                    $this->system_messages->addMessage(
                        View::MSG_SUCCESS,
                        l('success_updated_ds', 'languages')
                    );
                }

                $url = site_url() . "admin/languages/ds/" . $lang_id . "/" . $module_id;
                redirect($url);
            }
        }

        $this->view->assign('lang_data', $lang_data);
        $this->view->assign('langs', $this->pg_language->languages);
        $this->view->assign('current_lang_id', $lang_id);
        $this->view->assign('current_module_id', $module_id);

        $this->view->setHeader(l('admin_header_ds_edit', 'languages'));
        $this->view->render('edit_ds');
    }

    public function dsDelete($lang_id, $module_id, $gid)
    {
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];
        if ($gid) {
            $this->pg_language->ds->delete_reference($module_gid, $gid);
        }
        $url = site_url() . "admin/languages/ds/" . $lang_id . "/" . $module_id;
        redirect($url);
    }

    public function dsItems($lang_id, $module_id, $gid)
    {
        $this->view->assign('current_gid', $gid);

        $this->view->assign('langs', $this->pg_language->languages);
        if (!$lang_id) {
            $lang_id = $this->pg_language->get_default_lang_id();
        }
        $this->view->assign('current_lang_id', $lang_id);

        $modules = $this->pg_module->return_modules();

        $this->load->model('Languages_model');
        $current_module = $this->Languages_model->isDisabledDSActions($modules[$module_id]);
        $this->view->assign('current_module', $current_module);

        $module_gid = $modules[$module_id]["module_gid"];
        $this->view->assign('modules', $modules);
        $this->view->assign('current_module_id', $module_id);
        $this->view->assign('module', $current_module);

        $reference = $this->pg_language->ds->get_reference(
            $module_gid,
            $gid,
            $lang_id
        );
        $this->view->assign('reference', $reference);

        $this->pg_theme->add_js('admin-multilevel-sorter.js');
        $this->Menu_model->set_menu_active_item(
            'admin_languages_menu',
            'languages_ds_item'
        );
        $header = l('admin_header_ds_items', 'languages') . ' : ' . $current_module["module_name"] . ' : ' . $reference["header"];
        $this->view->setBackLink(site_url() . "admin/languages/ds/" . $lang_id . "/" . $module_id);
        $this->view->setHeader($header);
        $this->view->render('items_ds');
    }

    public function dsItemsEdit($lang_id, $module_id, $gid, $option_gid = null)
    {
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];

        $reference = $this->pg_language->ds->get_reference($module_gid, $gid, $lang_id);
        if ($option_gid) {
            foreach ($this->pg_language->languages as $lid => $lang) {
                $r = $this->pg_language->ds->get_reference($module_gid, $gid, $lid);
                $lang_data[$lid] = $r["option"][$option_gid];
            }
        } else {
            $option_gid = "";
            $lang_data = [];
        }

        if ($this->input->post('btn_save')) {
            $lang_data = $this->input->post('lang_data', true);
            $add_flag = false;

            if (empty($option_gid)) {
                $add_flag = true;
                if (!empty($reference["option"])) {
                    $array_keys = array_keys($reference["option"]);
                } else {
                    $array_keys = [0];
                }
                if (in_array($gid, [UsersTypesModel::USER_TYPE, UsersTypesModel::LOOKING_USER_TYPE, UsersTypesModel::USER_TYPE_PLURAL]) !== false) {
                    $this->ci->load->model('users/models/Users_types_model');
                    $guid_data = $this->Users_types_model->createUserType($lang_data[$lang_id]);
                    if (!empty($guid_data["errors"])) {
                        $this->system_messages->addMessage(View::MSG_ERROR, $guid_data['errors']);
                        $this->view->setRedirect(site_url() . 'admin/properties/propertyItems/' . $lang_id . '/' . $gid);
                    } else {
                        $option_gid = $guid_data['data']['name'];
                        $types = [];
                        if ($gid == UsersTypesModel::USER_TYPE_PLURAL) {
                            $types = [UsersTypesModel::LOOKING_USER_TYPE, UsersTypesModel::USER_TYPE];
                        } elseif ($gid == UsersTypesModel::USER_TYPE) {
                            $types = [UsersTypesModel::LOOKING_USER_TYPE, UsersTypesModel::USER_TYPE_PLURAL];
                        } else {
                            $types = [UsersTypesModel::USER_TYPE, UsersTypesModel::USER_TYPE_PLURAL];
                        }
                        foreach ($types as $type) {
                            foreach ($lang_data as $lid => $string) {
                                $looking_reference = $this->pg_language->ds->get_reference($module_gid, $type, $lid);
                                $looking_reference["option"][$option_gid] = $string;
                                $this->pg_language->ds->set_module_reference($module_gid, $type, $looking_reference, $lid);
                            }
                        }
                    }
                } else {
                    $gidopt = !empty($this->input->post('option_gid', true)) ?
                        $this->input->post('option_gid', true) : $lang_data[$this->pg_language->current_lang_id];
                    if (!empty($gidopt)) {
                        $gid_data = $this->pg_language->createGUID($gidopt);
                        if (!empty($gid_data['errors'])) {
                            $errors[] = $gid_data['errors'];
                        }
                        if ($this->pg_language->ds->get_reference($module_gid, $gid_data['gid'], $this->pg_language->current_lang_id)) {
                            $errors[] = l('error_gid_exists', 'languages');
                        } else {
                            $option_gid = $gid_data['gid'];
                        }
                    } else {
                        $errors[] = l('error_gid_incorrect', 'languages');
                    }
                }
            }

            if (!empty($errors)) {
                $this->system_messages->addMessage(View::MSG_ERROR, $errors);
            } else {
                foreach ($lang_data as $lid => $string) {
                    $reference = $this->pg_language->ds->get_reference($module_gid, $gid, $lid);
                    $reference["option"][$option_gid] = $string;
                    $this->pg_language->ds->set_module_reference($module_gid, $gid, $reference, $lid);
                }
                if (isset($add_flag)) {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_added_ds_item', 'languages'));
                } else {
                    $this->system_messages->addMessage(View::MSG_SUCCESS, l('success_updated_ds_item', 'languages'));
                }

                $url = site_url() . "admin/languages/ds_items/" . $lang_id . "/" . $module_id . "/" . $gid;
                redirect($url);
            }
        }

        $this->view->assign('lang_data', $lang_data);
        $this->view->assign('langs', $this->pg_language->languages);
        $this->view->assign('current_lang_id', $lang_id);
        $this->view->assign('current_module_id', $module_id);
        $this->view->assign('current_module_gid', $module_gid);
        $this->view->assign('current_gid', $gid);
        $this->view->assign('option_gid', $option_gid);

        $this->view->setHeader(l('admin_header_ds_item_edit', 'languages'));
        $this->view->render('edit_ds_item');
    }

    public function ajaxDsDelete($lang_id, $module_id)
    {
        $references = $this->input->post("gids", true);
        if (empty($references)) {
            return;
        }
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];
        $this->pg_language->ds->delete_references($module_gid, $references);

        return;
    }

    public function ajaxDsSave($lang_id, $module_id)
    {
        $gid = $this->input->post("id", true);
        $value = $this->input->post("text", true);
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];

        if (!empty($gid)) {
            $reference = $this->pg_language->ds->get_reference(
                $module_gid,
                $gid,
                $lang_id
            );
            $reference["header"] = $value;
            $this->pg_language->ds->set_module_reference(
                $module_gid,
                $gid,
                $reference,
                $lang_id
            );
        }
        echo $value;
    }

    public function ajaxDsItemSave($lang_id, $module_id, $gid)
    {
        $option_gid = $this->input->post("id", true);
        $value = $this->input->post("text", true);
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];

        if (!empty($gid)) {
            $reference = $this->pg_language->ds->get_reference(
                $module_gid,
                $gid,
                $lang_id
            );
            $reference["option"][$option_gid] = $value;
            $this->pg_language->ds->set_module_reference(
                $module_gid,
                $gid,
                $reference,
                $lang_id
            );
        }
        echo $value;
    }

    public function ajaxDsItemDelete($module_id, $gid, $option_gid)
    {
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];

        if (in_array($gid, [UsersTypesModel::USER_TYPE, UsersTypesModel::LOOKING_USER_TYPE]) !== false) {
            $this->load->model('Properties_model');
            $is_type_used = $this->Properties_model->isUserTypeUsed($option_gid);
            if ($is_type_used === true) {
                exit(json_encode(['errors' => l('error_user_type_used', 'properties')]));
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
                    $reference = $this->pg_language->ds->get_reference(
                        $module_gid,
                        $gid,
                        $lid
                    );
                    if (isset($reference["option"][$option_gid])) {
                        unset($reference["option"][$option_gid]);
                        $this->pg_language->ds->set_module_reference(
                            $module_gid,
                            $gid,
                            $reference,
                            $lid
                        );
                    }
                }
            }
        }
    }

    public function ajaxDsItemSaveSorter($module_id, $gid)
    {
        $modules = $this->pg_module->return_modules();
        $module_gid = $modules[$module_id]["module_gid"];

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
        $this->pg_language->ds->set_reference_sorter(
            $module_gid,
            $gid,
            $sorter_data
        );
    }

    public function generateInstallModuleLang($module_gid)
    {
        $code = $this->pg_language->generate_install_module_lang($module_gid);
        header('Content-type: text/plain; charset=utf-8');
        echo $code;
    }

    /**
     * Fill empty values with default
     * Sort lang files content
     */
    public function brush()
    {
        $this->load->model('languages/models/languages_tools_model');
        $this->languages_tools_model->fillSort(
            $this->pg_language->get_default_lang_code()
        );
        $this->view->setRedirect(site_url() . 'admin/languages/langs');
    }

    /**
     * Word search
     * @return mixed
     */
    public function langAutocomplete()
    {
        $lang_id = filter_input(INPUT_POST, 'id_lang', FILTER_VALIDATE_INT);
        $word = filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING);
        $field = "value_$lang_id";

        $typeSearch = $this->ci->input->post('typeSearch', true) ?: "";
        $field_to_search = ($typeSearch == 'text') ? $field : "gid";

        $this->load->model('LanguagesModel');
        $result = $this->LanguagesModel->search([$field, 'module_gid', 'gid'], $field_to_search, $word);

        $this->view->assign($result);
        $this->view->render();
    }
}
