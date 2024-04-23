<?php

$module =[
    'module' => 'field_editor',
    'install_name' => 'Field editor',
    'install_descr' => 'Create and manage extra fields in user\'s profile, in search forms ',
    'version' => '5.04',
    'files' => [
        0 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/config/field_editor.php',
        ],
        1 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/js/admin-field-editor-select.js',
        ],
        2 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/js/admin-form-fields.js',
        ],
        3 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/controllers/AdminFieldEditor.php',
        ],
        4 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/install/module.php',
        ],
        5 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/install/permissions.php',
        ],
        6 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/install/settings.php',
        ],
        7 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/install/structure_deinstall.sql',
        ],
        8 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/install/structure_install.sql',
        ],
        9 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/CheckboxFieldModel.php',
        ],
        10 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/FieldTypeModel.php',
        ],
        11 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/LikeFieldModel.php',
        ],
        12 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/MultiselectFieldModel.php',
        ],
        13 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/RangeFieldModel.php',
        ],
        14 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/SelectFieldModel.php',
        ],
        15 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/TextFieldModel.php',
        ],
        16 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/fields/TextareaFieldModel.php',
        ],
        17 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/FieldEditorInstallModel.php',
        ],
        18 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/FieldEditorModel.php',
        ],
        19 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/FieldEditorFormsModel.php',
        ],
        20 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/FieldEditorSearchesModel.php',
        ],
        21 => [
            0 => 'file',
            1 => 'read',
            2 => 'application/modules/field_editor/models/FieldTypesLoaderModel.php',
        ],
        22 => [
            0 => 'dir',
            1 => 'read',
            2 => 'application/modules/field_editor/langs',
        ],
    ],
    'dependencies' => [
        'moderation' => [
            'version' => '1.01',
        ],
        'start' => [
            'version' => '1.03',
        ],
        'menu' => [
            'version' => '2.03',
        ],
    ],
    'linked_modules' => [
        'install' => [
            'moderation' => 'installModeration',
            'menu' => 'installMenu',
        ],
        'deinstall' => [
            'moderation' => 'deinstallModeration',
            'menu' => 'deinstallMenu',
        ],
    ],
];
