<?php

/**
 * Name as ID
 *
 * If set to TRUE an 'id' attribute with the value of the 'name' will be
 * generated automatically in all elements (where applicable)
 */
$config['nameasid'] = true;

/**
 * Replace
 *
 * These parameters set the replace vs. combine behaviour for
 * multi-value attributes defined in $config['globals'] and $config['defaults']
 *
 * 1st parameter sets CLASSES replacement behaviour
 * 2nd parameter sets STYLES replacement behaviour
 * 3rd parameter sets SCRIPTS ('on...') replacement behaviour
 */
$config['replace'] = 'TRUE|TRUE|TRUE';

/**
 * XSS Clean Post Data
 *
 * If set to TRUE all post data retrieved via $this->get_post()
 * will be xss_cleaned automatically
 */
$config['xss_clean_post'] = true;

/**
 * Prefixes and Suffixes
 *
 * Wraps these prefixes and suffixes around elements
 * Please use double quotes when using control characters (e.g. "\n")
 */
$config['group_prefix']    = '';        // wraps around checkgroups and radiogroups
$config['group_suffix']    = '';
$config['element_prefix']    = '';        // wraps around all elements
$config['element_suffix']    = '<br />';
$config['label_prefix']    = '';        // wraps around labels
$config['label_suffix']    = '';
$config['field_prefix']    = '';        // wraps around fieldsets (inside), inputs, buttons, textareas, selects, captchas & recaptchas
$config['field_suffix']    = '';

/**
 * Error Tags
 *
 * Opening tag of a single error, e.g. '<span class="error">- '
 * Closing tag of a signle error, e.g. '</span>'
 *
 * This allows you to wrap all single errors within a styled element
 */
$config['error_open'] = '<div class="error">- ';
$config['error_close'] = '</div>';

/**
 * Error String Tags
 *
 * Opening tag of the error string, e.g. '<div id="errors">'
 * Closing tag of the error string, e.g. '</div>'
 *
 * This allows you to wrap all single errors within a styled element
 */
$config['error_string_open'] = '<div id="errors">';
$config['error_string_close'] = '</div>';

/**
 * Error Class
 *
 * This class will be added to the element and its label if validation rules do not pass
 */
$config['error_class'] = 'error';

/**
 * Inline Error
 *
 * If set to 'TRUE' the error message will be shown directly after the element
 * You can also set the inline error message opening and closing tag.
 */
$config['error_inline'] = false;
$config['error_inline_open'] = '';
$config['error_inline_close'] = '';

/**
 * Error Flag
 *
 * This class will be added to the element and its label if validation rules do not pass
 * To include the error message with an image title attribute you can use the placeholder {error}
 */
$config['error_flag'] = '';

/**
 * Global Attributes
 *
 * Define global standard attributes
 */
$config['globals'] = [];

/**
 * Default Attributes
 *
 * Define standard attributes to element types or specific elements (by name)
 *
 * NEW!!
 * To change label attributes for an element type or specific element name
 * add 'label' => array('attribute' => 'value') to the respective array
 * (see 'checkbox' for example)
 */
$config['defaults'] = [
    'label' => [// all label configuration is done here now!!
        'position'       => 'before',
        'class'          => 'left',
        'required_class' => 'required',
        'required_flag'  => '<span class="required">*</span>',
    ],
    'fieldset' => [
        'element_suffix' => '',                                // do not use an element_suffix for fieldsets
    ],
    'text' => [
        //'onkeypress' => "this.style.borderColor='#000'"       // reset border color after error
        'class' => 'element',
    ],
    'password' => [
        //'onkeypress' => "this.style.borderColor='#000'"       // reset border color after error
        'class' => 'element',
    ],
    'upload' => [
        'upload_path'   => 'uploads',
        'allowed_types' => 'pdf|doc|jpg|gif|png',
    ],
    'checkbox' => [
        'element_suffix' => '',                                // do not use an element_suffix for checkboxes
        'class'          => 'check',                                    // assign a CSS class to the <input type="checkbox" />
        'label'          => [
            'position' => 'after',                            // display the label after the actual checkbox
            'class'    => 'check',                                // assign a CSS class to the <label>
        ],
    ],
    'radio' => [
        'element_suffix' => '',
        'class'          => 'check',
        'label'          => [
            'position' => 'after',
            'class'    => 'check',
        ],
    ],
    'submit' => [
        'element_suffix' => '',                                // do not use an element_suffix for submit buttons
        'class'          => 'button',
    ],
    'reset' => [
        'class' => 'button',
    ],
    // always define defaults for specific elements (below) after defaults by element type (above)
    'multiple' => [
        'style' => 'height: 120px',
    ],
];

/**
 * Recaptcha Settings
 *
 * Please provide your public and private key
 * to make the recaptcha element work
 */
$config['recaptcha_api_server']            = 'http://api.recaptcha.net';
$config['recaptcha_api_secure_server']    = 'https://api-secure.recaptcha.net';
$config['recaptcha_ssl']                = 'FALSE';
$config['recaptcha_verify_server']        = 'api-verify.recaptcha.net';
$config['recaptcha_key_public']            = '6Lfb2AsAAAAAADTMauKAoblPuBhEsb_jm9731SZI ';    // Complete with your key
$config['recaptcha_key_private']        = '6Lfb2AsAAAAAADGZ6R-2hcalzt6rsLfdpUuSJ6Yr ';    // Complete with your key
$config['recaptcha_theme']                = 'white';
$config['recaptcha_lang']                = 'ru';    // Valid language codes on http://recaptcha.net/apidocs/captcha/client.html

/* End of file form.php */
/* Location: ./application/config/form.php */
