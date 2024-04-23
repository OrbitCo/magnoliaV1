<?php

use Pg\modules\services\models\ServicesModel;

$demo_date         = date(ServicesModel::DB_DATE_FORMAT);
$demo_date_expired = date(ServicesModel::DB_DATE_FORMAT, strtotime("+30 days"));

$services_users = [
     1 =>
   [
    'id_user' => '1',
    'service_gid' => 'users_featured',
    'template_gid' => 'users_featured_template',
    'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
    ],
    'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
    ],
    'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
    ],
    'date_created' => $demo_date,
    'date_modified' => $demo_date,
    'date_expired' => $demo_date_expired,
    'status' => '0',
    'count' => '0',
    'id_users_package' => '0',
    'id_users_membership' => '0',
     ],
     2 =>
     [
     'id_user' => '2',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     3 =>
     [
     'id_user' => '3',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     4 =>
     [
     'id_user' => '4',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     5 =>
     [
     'id_user' => '5',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     6 =>
     [
     'id_user' => '6',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     7 =>
     [
     'id_user' => '7',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     8 =>
     [
     'id_user' => '8',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     9 =>
     [
     'id_user' => '9',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'pay_type' => '2',
      'status' => '1',
      'price' => '10',
      'data_admin' =>
       [
        'period' => '30',
      ],
      'lds' => '',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => '30',
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => '',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
      ],
      'name' => 'Featured users',
      'description' => 'Стать фичеред',
      'alert' => '',
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     10 =>
     [
     'id_user' => '21',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     11 =>
     [
     'id_user' => '18',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     12 =>
     [
     'id_user' => '19',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     13 =>
     [
     'id_user' => '20',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     14 =>
     [
     'id_user' => '22',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     15 =>
     [
     'id_user' => '23',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     16 =>
     [
     'id_user' => '23',
     'service_gid' => 'up_in_search',
     'template_gid' => 'up_in_search_template',
     'service' =>
     [
      'id' => '6',
      'gid' => 'up_in_search',
      'template_gid' => 'up_in_search_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '6',
        'gid' => 'up_in_search_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_up_in_search',
        'callback_validate_method' => 'service_validate_up_in_search',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Lift Up in search',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Lift Up period (days)',
            'name_lang_gid' => 'admin_param_name_6_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Lift Up in search',
      'lang' => 'service_name_6',
      'module' => 'services',
      'description' => 'Lift my profile up in search',
      'alert' => false,
      'name_lang_gid' => 'service_name_6',
      'description_lang_gid' => 'service_name_6_description',
      'alert_lang_gid' => 'service_name_6_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '6',
      'gid' => 'up_in_search_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_up_in_search',
      'callback_validate_method' => 'service_validate_up_in_search',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Lift Up in search',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Lift Up period (days)',
          'name_lang_gid' => 'admin_param_name_6_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '6',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     17 =>
     [
     'id_user' => '23',
     'service_gid' => 'highlight_in_search',
     'template_gid' => 'highlight_in_search_template',
     'service' =>
     [
      'id' => '5',
      'gid' => 'highlight_in_search',
      'template_gid' => 'highlight_in_search_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '5',
        'gid' => 'highlight_in_search_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_highlight_in_search',
        'callback_validate_method' => 'service_validate_highlight_in_search',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Highlight in search',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Highlight period (days)',
            'name_lang_gid' => 'admin_param_name_5_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Highlight in search',
      'lang' => 'service_name_5',
      'module' => 'services',
      'description' => 'Highlight my profile in search',
      'alert' => false,
      'name_lang_gid' => 'service_name_5',
      'description_lang_gid' => 'service_name_5_description',
      'alert_lang_gid' => 'service_name_5_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '5',
      'gid' => 'highlight_in_search_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_highlight_in_search',
      'callback_validate_method' => 'service_validate_highlight_in_search',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Highlight in search',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Highlight period (days)',
          'name_lang_gid' => 'admin_param_name_5_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '5',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     18 =>
     [
     'id_user' => '24',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     19 =>
     [
     'id_user' => '24',
     'service_gid' => 'highlight_in_search',
     'template_gid' => 'highlight_in_search_template',
     'service' =>
     [
      'id' => '5',
      'gid' => 'highlight_in_search',
      'template_gid' => 'highlight_in_search_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '5',
        'gid' => 'highlight_in_search_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_highlight_in_search',
        'callback_validate_method' => 'service_validate_highlight_in_search',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Highlight in search',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Highlight period (days)',
            'name_lang_gid' => 'admin_param_name_5_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Highlight in search',
      'lang' => 'service_name_5',
      'module' => 'services',
      'description' => 'Highlight my profile in search',
      'alert' => false,
      'name_lang_gid' => 'service_name_5',
      'description_lang_gid' => 'service_name_5_description',
      'alert_lang_gid' => 'service_name_5_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '5',
      'gid' => 'highlight_in_search_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_highlight_in_search',
      'callback_validate_method' => 'service_validate_highlight_in_search',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Highlight in search',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Highlight period (days)',
          'name_lang_gid' => 'admin_param_name_5_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '5',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     20 =>
     [
     'id_user' => '24',
     'service_gid' => 'up_in_search',
     'template_gid' => 'up_in_search_template',
     'service' =>
     [
      'id' => '6',
      'gid' => 'up_in_search',
      'template_gid' => 'up_in_search_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '6',
        'gid' => 'up_in_search_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_up_in_search',
        'callback_validate_method' => 'service_validate_up_in_search',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Lift Up in search',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Lift Up period (days)',
            'name_lang_gid' => 'admin_param_name_6_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Lift Up in search',
      'lang' => 'service_name_6',
      'module' => 'services',
      'description' => 'Lift my profile up in search',
      'alert' => false,
      'name_lang_gid' => 'service_name_6',
      'description_lang_gid' => 'service_name_6_description',
      'alert_lang_gid' => 'service_name_6_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '6',
      'gid' => 'up_in_search_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_up_in_search',
      'callback_validate_method' => 'service_validate_up_in_search',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Lift Up in search',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Lift Up period (days)',
          'name_lang_gid' => 'admin_param_name_6_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '6',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     21 =>
     [
     'id_user' => '25',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     22 =>
     [
     'id_user' => '25',
     'service_gid' => 'highlight_in_search',
     'template_gid' => 'highlight_in_search_template',
     'service' =>
     [
      'id' => '5',
      'gid' => 'highlight_in_search',
      'template_gid' => 'highlight_in_search_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '5',
        'gid' => 'highlight_in_search_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_highlight_in_search',
        'callback_validate_method' => 'service_validate_highlight_in_search',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Highlight in search',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Highlight period (days)',
            'name_lang_gid' => 'admin_param_name_5_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Highlight in search',
      'lang' => 'service_name_5',
      'module' => 'services',
      'description' => 'Highlight my profile in search',
      'alert' => false,
      'name_lang_gid' => 'service_name_5',
      'description_lang_gid' => 'service_name_5_description',
      'alert_lang_gid' => 'service_name_5_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '5',
      'gid' => 'highlight_in_search_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_highlight_in_search',
      'callback_validate_method' => 'service_validate_highlight_in_search',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Highlight in search',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Highlight period (days)',
          'name_lang_gid' => 'admin_param_name_5_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '5',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     23 =>
     [
     'id_user' => '26',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     24 =>
     [
     'id_user' => '27',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     25 =>
     [
     'id_user' => '28',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     26 =>
     [
     'id_user' => '29',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     27 =>
     [
     'id_user' => '30',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     28 =>
     [
     'id_user' => '31',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     29 =>
     [
     'id_user' => '32',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     30 =>
     [
     'id_user' => '33',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     31 =>
     [
     'id_user' => '34',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'name' => 'Payment for service: Featured users',
      'offline_line_1' => 'Payment for service: ',
      'offline_line_2' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'id_service' => '1',
      'gid' => 'users_featured',
      'user_data' => '0',
      'activate_immediately' => '1',
      'comment' => 'Hey, I\'ve sent the money to the bank account you\'ve given, please check',
      'system_gid' => 'offline',
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     32 =>
     [
     'id_user' => '35',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     33 =>
     [
     'id_user' => '36',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ],
     34 =>
     [
     'id_user' => '37',
     'service_gid' => 'users_featured',
     'template_gid' => 'users_featured_template',
     'service' =>
     [
      'id' => '1',
      'gid' => 'users_featured',
      'template_gid' => 'users_featured_template',
      'type' => 'tariff',
      'user_type_disabled' => null,
      'user_type_disabled_code' => '0',
      'pay_type' => '2',
      'status' => '1',
      'cant_activate_from_services' => '0',
      'price' => '10',
      'can_free' => '1',
      'data_admin' =>
       [
        'period' => 30,
      ],
      'lds' => '',
      'id_membership' => '0',
      'date_add' => $demo_date,
      'data_admin_array' =>
       [
        'period' => 30,
      ],
      'template' =>
       [
        'id' => '1',
        'gid' => 'users_featured_template',
        'callback_module' => 'users',
        'callback_model' => 'Users_model',
        'callback_buy_method' => 'service_buy',
        'callback_activate_method' => 'service_activate_users_featured',
        'callback_validate_method' => 'service_validate_users_featured',
        'price_type' => '1',
        'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
        'data_user' => 'a:0:{}',
        'lds' => '',
        'date_add' => $demo_date,
        'moveable' => '0',
        'is_membership' => '1',
        'data_membership' => 'a:0:{}',
        'alert_activate' => '0',
        'name' => 'Featured users',
        'data_admin_array' =>
         [
          'period' =>
           [
            'gid' => 'period',
            'type' => 'int',
            'name' => 'Featured period (days)',
            'name_lang_gid' => 'admin_param_name_1_period',
          ],
        ],
        'data_user_array' =>
         [
        ],
        'data_membership_array' =>
         [
        ],
        'lds_array' =>
         [
        ],
      ],
      'name' => 'Featured users',
      'lang' => 'service_name_1',
      'module' => 'services',
      'description' => 'Become a featured member',
      'alert' => false,
      'name_lang_gid' => 'service_name_1',
      'description_lang_gid' => 'service_name_1_description',
      'alert_lang_gid' => 'service_name_1_alert',
      'user_type_disabled_array' =>
       [
      ],
     ],
     'template' =>
     [
      'id' => '1',
      'gid' => 'users_featured_template',
      'callback_module' => 'users',
      'callback_model' => 'Users_model',
      'callback_buy_method' => 'service_buy',
      'callback_activate_method' => 'service_activate_users_featured',
      'callback_validate_method' => 'service_validate_users_featured',
      'price_type' => '1',
      'data_admin' => 'a:1:{s:6:"period";s:3:"int";}',
      'data_user' => 'a:0:{}',
      'lds' => '',
      'date_add' => $demo_date,
      'moveable' => '0',
      'is_membership' => '1',
      'data_membership' => 'a:0:{}',
      'alert_activate' => '0',
      'name' => 'Featured users',
      'data_admin_array' =>
       [
        'period' =>
         [
          'gid' => 'period',
          'type' => 'int',
          'name' => 'Featured period (days)',
          'name_lang_gid' => 'admin_param_name_1_period',
        ],
      ],
      'data_user_array' =>
       [
      ],
      'data_membership_array' =>
       [
      ],
      'lds_array' =>
       [
      ],
      'template' =>
       [
        'date_add' => $demo_date,
      ],
     ],
     'payment_data' =>
     [
      'id_service' => '1',
      'user_data' => false,
      'activate_immediately' => 1,
     ],
     'date_created' => $demo_date,
     'date_modified' => $demo_date,
     'date_expired' => $demo_date_expired,
     'status' => '0',
     'count' => '0',
     'id_users_package' => '0',
     'id_users_membership' => '0',
     ]
];

$services_log = [
    ['id_user' => '15', 'id_service' => '12', 'user_data' => false],
    ['id_user' => '2', 'id_service' => '12', 'user_data' => false],
    ['id_user' => '1', 'id_service' => '12', 'user_data' => false],
    ['id_user' => '1', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '2', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '3', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '4', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '6', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '7', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '8', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '9', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '10', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '21', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '18', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '19', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '20', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '22', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '23', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '23', 'id_service' => '6', 'user_data' => false],
    ['id_user' => '23', 'id_service' => '5', 'user_data' => false],
    ['id_user' => '24', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '24', 'id_service' => '5', 'user_data' => false],
    ['id_user' => '24', 'id_service' => '6', 'user_data' => false],
    ['id_user' => '25', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '25', 'id_service' => '5', 'user_data' => false],
    ['id_user' => '26', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '27', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '28', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '29', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '30', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '31', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '32', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '33', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '34', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '35', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '36', 'id_service' => '1', 'user_data' => false],
    ['id_user' => '37', 'id_service' => '1', 'user_data' => false]
];
