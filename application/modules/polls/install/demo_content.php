<?php
$date = date('Y-m-d h:i:s');
return [
    [
        'question' => [
            'en' => 'How did you find us?',
            'ru' => 'Как вы нашли  нас?',
        ],
        'answers' => [
            1 => [
                'en'    => 'Advice from friends',
                'ru'    => 'По совету друзей',
                'color' => 'D6969A',
            ],
            2 => [
                'en'    => 'Newspapers, magazines',
                'ru'    => 'Газеты, журналы',
                'color' => 'DC7F41',
            ],
            3 => [
                'en'    => 'TV advertising',
                'ru'    => 'ТВ реклама',
                'color' => '76D173',
            ],
            4 => [
                'en'    => 'Word of mouth',
                'ru'    => 'Сарафанное радио',
                'color' => '3E77D4',
            ],
        ],
        'status'         => 1,
        'poll_type'      => 0,
        'answer_type'    => 0,
        'sorter'         => 0,
        'show_results'   => 1,
        'date_start'     => $date,
        'use_comments'   => 1,
        'language'       => 0,
        'use_expiration' => 0,
        'responses'      => [
            [
                'user_id'  => 2,
                'agent'    => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36',
                'ip'       => '192.168.5.68',
                'date_add' => $date,
                'answer_10' => 2,
            ],
            [
                'user_id'  => 3,
                'agent'    => 'Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/20100101 Firefox/24.0 AlexaToolbar/alxf-2.19',
                'ip'       => '192.168.5.68',
                'date_add' => $date,
                'answer_4' => 2,
            ],
            [
                'user_id'  => 4,
                'agent'    => 'Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/20100101 Firefox/24.0 AlexaToolbar/alxf-2.19',
                'ip'       => '192.168.5.68',
                'date_add' => $date,
                'answer_1' => 2,
            ],
        ],
    ],
    [
        'question' => [
            'en' => 'What is your favorite movie type?',
            'ru' => 'Какие фильмы вам нравятся?', ],
        'answers' => [
            1 => [
                'en'    => 'Animation',
                'ru'    => 'Мультфильмы',
                'color' => 'A5B858',
            ],
            2 => [
                'en'    => 'Comedy',
                'ru'    => 'Комедии',
                'color' => '753894',
            ],
            3 => [
                'en'    => 'Drama',
                'ru'    => 'Художественные фильмы',
                'color' => '1C9A31',
            ],
            4 => [
                'en'    => 'Horror',
                'ru'    => 'Ужасы',
                'color' => 'C4F70E',
            ],
            5 => [
                'en'    => 'Action',
                'ru'    => 'Боевики',
                'color' => 'E2AA18',
            ],
            6 => [
                'en'    => 'Adventure',
                'ru'    => 'Приключения',
                'color' => '7AD470',
            ],
            7 => [
                'en'    => 'Documentary',
                'ru'    => 'Документальное кино',
                'color' => '655DAF',
            ],
            8 => [
                'en'    => 'Detective fiction',
                'ru'    => 'Детективы',
                'color' => '85201B',
            ],
        ],
        'status'         => 1,
        'poll_type'      => 0,
        'answer_type'    => 0,
        'sorter'         => 0,
        'show_results'   => 1,
        'date_start'     => $date,
        'use_comments'   => 1,
        'language'       => 0,
        'use_expiration' => 0,
        'responses'      => [
            [
                'user_id'  => 5,
                'agent'    => 'Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/20100101 Firefox/24.0 AlexaToolbar/alxf-2.19',
                'ip'       => '192.168.5.68',
                'date_add' => $date,
                'answer_6' => 2,
                'comment'  => 'Sherlock the best',
            ],
            [
                'user_id'  => 6,
                'agent'    => 'Mozilla/5.0 (Windows NT 6.1; rv:24.0) Gecko/20100101 Firefox/24.0 AlexaToolbar/alxf-2.19',
                'ip'       => '192.168.5.68',
                'date_add' => $date,
                'answer_5' => 4,
            ],
            [
                'user_id'  => 7,
                'agent'    => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36',
                'ip'       => '192.168.5.68',
                'date_add' => $date,
                'answer_1' => 3,
            ],
        ],
    ],
];
