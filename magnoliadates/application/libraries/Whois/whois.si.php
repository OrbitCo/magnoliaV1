<?php

if (!defined('__SI_HANDLER__')) {
    define('__SI_HANDLER__', 1);
}

require_once 'whois.parser.php';

class si_handler
{
    public function parse($data_str, $query)
    {
        $translate = [
            'nic-hdl' => 'handle',
            ];

        $contacts = [
                    'registrant' => 'owner',
                    'tech-c'     => 'tech',
                        ];

        $r['regyinfo'] = [
                  'referrer'  => 'http://www.arnes.si',
                  'registrar' => 'ARNES',
                  ];

        $reg = generic_parser_a($data_str['rawdata'], $translate, $contacts, 'domain', 'Ymd');

        $r['regrinfo'] = $reg;

        return ($r);
    }
}
