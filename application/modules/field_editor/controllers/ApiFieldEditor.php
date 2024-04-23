<?php

declare(strict_types=1);

namespace Pg\modules\field_editor\controllers;

class ApiFieldEditor extends \Controller
{
    public function form()
    {
        $type = $this->input->post("type", true);
        $form_gid = $this->input->post("form", true);
        if (!$type || !$form_gid) {
            show_404();
        }
        $this->ci->load->model('Field_editor_model');
        $this->ci->load->model('field_editor/models/Field_editor_forms_model');
        $this->ci->Field_editor_model->initialize($type);
        $form = $this->ci->Field_editor_forms_model->getFormByGid($form_gid, $type);
        if (!$form) {
            show_404();
        }
        $form = $this->ci->Field_editor_forms_model->formatOutputForm($form, [], true);
        if ($form['field_data']) {
            foreach ($form['field_data'] as $field_data) {
                if (isset($field_data['field_content']['value'])) {
                    $data[$field_data['field_content']['field_name']] = $field_data['field_content']['value'];
                }
            }
        }
        $this->view->assign('form', $form);
        $this->view->render();
    }
}
