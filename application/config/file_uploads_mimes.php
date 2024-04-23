<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$mimes_categories = [
    'documents' => ['doc', 'docx', 'pdf', 'ppt', 'rtf', 'text', 'txt', 'word', 'xls', 'xlsx', 'csv', 'xml'],
    'images'    => ['bmp', 'gif', 'jpeg', 'jpg', 'png'],
    'graphics'  => ['ai', 'eps', 'ps', 'psd'],
    'archives'  => ['zip', 'rar', '7z', 'tar', 'gz', 'tgz'],
    'audio'     => ['mp3', 'wav'],
    'video'     => ['mpeg', 'mpg', 'mov', 'avi', 'wmv', 'flv', 'mkv'],
    'others'    => ['swf'],
];
