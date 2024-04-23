<?php

declare(strict_types=1);

namespace Pg\modules\users\models;

class FieldEditorModel extends \Model
{
    public $sections = [];
    
    const MODULE_GID = 'users';
    
    public $form_editor_type = self::MODULE_GID;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->ci->load->model('Field_editor_model');
        $this->ci->Field_editor_model->initialize($this->form_editor_type);
    }
    
    public function loadSections($lang_id)
    {
        $this->sections[$lang_id] = (array)$this->ci->Field_editor_model->getSectionList([], [], $lang_id);
    }
    
    public function getSections($lang_id)
    {
        if (!array_key_exists($lang_id, $this->sections)) {
            $this->loadSections($lang_id);
        }
        
        return $this->sections[$lang_id];
    }
    
    public function getUserById($user_id, $lang_id = 0)
    {
        $this->ci->load->model('Users_model');
        
        $this->ci->Users_model->setAdditionalFields(
            $this->ci->Field_editor_model->getFieldsForSelect(array_keys($this->getSections($lang_id))));
            
        return $this->ci->Users_model->getUserById($user_id);
    }
    
    public function formatSections($data, $lang_id)
    {
        $sections = $this->getSections($lang_id);
        
        foreach (array_keys($sections) as $sgid) {
            $sections[$sgid]['fields'] =
                $this->ci->Field_editor_model
                    ->formatItemFieldsForView(['where' => ['section_gid' => $sgid]], $data, $lang_id);
        }
        
        return $sections;
    }
}
