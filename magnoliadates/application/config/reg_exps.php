<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['string'] = "/.*/";
$config['email'] = "/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/";
$config['login'] = "/^.{5,20}$/";
$config['nickname'] = "/^[A-z0-9_\-]{3,20}$/";
$config['name'] = "/^[^.?\"\\#$%№]{2,25}$/";
$config['prop_name'] = "/^[^<,\"@\/{}()*$%?=>:|;#]*$/";
$config['banner_name'] = "/^.{5,40}$/";
$config['group_name'] = "/^.{2,40}$/";
$config['name_colour_set'] = "/^[A-z_]$/";
$config['password'] = "/^.{6,}$/i";
$config['price'] = "/^\d+\.?\d*$/";
$config['zip'] = "/.{5,8}/";
$config['unsigned_integer'] = "/^\d+$/";
$config['signed_integer'] = "/^[-]?\d+$/";
$config['unsigned_float'] = "/^\d+\.?\d*$/";
$config['signed_float'] = "/^[-]?\d+\.?\d*$/";
$config['url'] = "/^(http:\/\/|https:\/\/|)([^\.\/]+\.)*([a-zA-Z0-9])([a-zA-Z0-9-]*)\.([a-zA-Z]{2,14})(\/.*)?$/i";
$config['html_tags'] = "/^(?!(.*<\/?(A|ABBR|ACRONYM|ADDRESS|AREA|B|BASE|BASEFONT|BDO|BGSOUND|BIG|BLOCKQUOTE|BODY|BR|BUTTON|CAPTION|CENTER|CITE|CODE|COL|COLGROUP|DD|DEL|DFN|DIV|DL|DT|EM|EMBED|FIELDSET|FONT|FORM|FRAME|FRAMESET|H1|H2|H3|H4|H5|H6|HEAD|HR|HTML|I|IFRAME|IMG|INPUT|INS|KBD|LABEL|LEGEND|LI|LINK|MAP|MARQUEE|META|NOBR|NOEMBED|NOFRAMES|NOSCRIPT|OBJECT|OL|OPTGROUP|OPTION|P|PARAM|PRE|Q|SAMP|SCRIPT|SELECT|SMALL|SPAN|STRIKE|STRONG|STYLE|SUB|SUP|TABLE|TBODY|TD|TEXTAREA|TFOOT|TH|THEAD|TITLE|TR|TT|UL|VAR|WBR|XMP)\s{0,}.*>))/i";
$config['not_literal'] = '/[^\pL\pN\pM_]+/ui';
$config['emoji_format_unicode_with_slash'] = "/\\\\u/g";
$config['emoji_format_unicode_without_slash'] = "/u/g";
