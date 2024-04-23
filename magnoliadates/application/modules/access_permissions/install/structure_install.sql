DROP TABLE IF EXISTS `[prefix]access_permissions_modules`;
CREATE TABLE IF NOT EXISTS `[prefix]access_permissions_modules` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `module_gid` varchar(25) NOT NULL,
  `controller` varchar(25) NOT NULL,
  `method` varchar(100) DEFAULT NULL,
  `methods` text DEFAULT NULL,
  `not_methods` text DEFAULT NULL,
  `access` tinyint(3) NOT NULL,
  `data` text NOT NULL,
  `exclude` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_gid` (`module_gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]access_permissions_group_period`;
CREATE TABLE IF NOT EXISTS `[prefix]access_permissions_group_period` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `period` smallint(5) NOT NULL,
  `period_type` enum('years','months','days','hours') NOT NULL  DEFAULT 'days',
  `pay_type` enum('account','account_and_direct','direct') NOT NULL  DEFAULT 'account_and_direct',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]access_permissions_users`;
CREATE TABLE IF NOT EXISTS `[prefix]access_permissions_users` (
   `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_user` int(3) NOT NULL,
  `group_gid` varchar(100) NOT NULL,
  `id_period` int(3) NOT NULL,
  `data` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_activated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_expired` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[prefix]access_permissions_users` (`id`, `id_user`, `group_gid`, `id_period`, `data`, `is_active`, `date_activated`, `date_expired`) VALUES
(NULL, 24, 'premium', 1, 'a:14:{s:2:"id";s:1:"4";s:3:"gid";s:7:"premium";s:10:"is_default";s:1:"0";s:9:"is_active";s:1:"1";s:8:"is_trial";s:1:"0";s:12:"trial_period";s:1:"0";s:8:"priority";s:1:"0";s:12:"date_created";s:19:"2017-12-15 13:33:15";s:13:"date_modified";s:19:"2017-12-15 13:33:15";s:6:"name_1";s:7:"Premium";s:13:"description_1";s:17:"The premium group";s:12:"current_name";s:7:"Premium";s:19:"current_description";s:17:"The premium group";s:6:"period";a:5:{s:2:"id";s:1:"1";s:6:"period";s:2:"30";s:11:"period_type";s:4:"days";s:8:"pay_type";s:18:"account_and_direct";s:13:"premium_group";s:5:"15.00";}}', 1, '2019-02-19 18:32:58', '2028-01-18 18:32:58'),
(NULL, 25, 'premium', 1, 'a:14:{s:2:"id";s:1:"4";s:3:"gid";s:7:"premium";s:10:"is_default";s:1:"0";s:9:"is_active";s:1:"1";s:8:"is_trial";s:1:"0";s:12:"trial_period";s:1:"0";s:8:"priority";s:1:"0";s:12:"date_created";s:19:"2017-12-15 13:33:15";s:13:"date_modified";s:19:"2017-12-15 13:33:15";s:6:"name_1";s:7:"Premium";s:13:"description_1";s:17:"The premium group";s:12:"current_name";s:7:"Premium";s:19:"current_description";s:17:"The premium group";s:6:"period";a:5:{s:2:"id";s:1:"1";s:6:"period";s:2:"30";s:11:"period_type";s:4:"days";s:8:"pay_type";s:18:"account_and_direct";s:13:"premium_group";s:5:"15.00";}}', 1, '2017-12-19 18:50:23', '2028-01-18 18:50:23'),
(NULL, 23, 'silver', 1, 'a:14:{s:2:"id";s:1:"3";s:3:"gid";s:6:"silver";s:10:"is_default";s:1:"0";s:9:"is_active";s:1:"1";s:8:"is_trial";s:1:"0";s:12:"trial_period";s:1:"0";s:8:"priority";s:1:"0";s:12:"date_created";s:19:"2017-12-15 13:33:15";s:13:"date_modified";s:19:"2017-12-15 13:33:15";s:6:"name_1";s:6:"Silver";s:13:"description_1";s:16:"The silver group";s:12:"current_name";s:6:"Silver";s:19:"current_description";s:16:"The silver group";s:6:"period";a:5:{s:2:"id";s:1:"1";s:6:"period";s:2:"30";s:11:"period_type";s:4:"days";s:8:"pay_type";s:18:"account_and_direct";s:12:"silver_group";s:4:"7.00";}}', 1, '2017-12-19 18:10:18', '2028-01-18 18:10:18'),
(NULL, 27, 'silver', 1, 'a:14:{s:2:"id";s:1:"3";s:3:"gid";s:6:"silver";s:10:"is_default";s:1:"0";s:9:"is_active";s:1:"1";s:8:"is_trial";s:1:"0";s:12:"trial_period";s:1:"0";s:8:"priority";s:1:"0";s:12:"date_created";s:19:"2017-12-15 13:33:15";s:13:"date_modified";s:19:"2017-12-15 13:33:15";s:6:"name_1";s:6:"Silver";s:13:"description_1";s:16:"The silver group";s:12:"current_name";s:6:"Silver";s:19:"current_description";s:16:"The silver group";s:6:"period";a:5:{s:2:"id";s:1:"1";s:6:"period";s:2:"30";s:11:"period_type";s:4:"days";s:8:"pay_type";s:18:"account_and_direct";s:12:"silver_group";s:4:"7.00";}}', 1, '2017-12-20 08:29:20', '2028-01-19 08:29:20'),
(NULL, 30, 'silver', 1, 'a:14:{s:2:"id";s:1:"3";s:3:"gid";s:6:"silver";s:10:"is_default";s:1:"0";s:9:"is_active";s:1:"1";s:8:"is_trial";s:1:"0";s:12:"trial_period";s:1:"0";s:8:"priority";s:1:"0";s:12:"date_created";s:19:"2017-12-15 13:33:15";s:13:"date_modified";s:19:"2017-12-15 13:33:15";s:6:"name_1";s:6:"Silver";s:13:"description_1";s:16:"The silver group";s:12:"current_name";s:6:"Silver";s:19:"current_description";s:16:"The silver group";s:6:"period";a:5:{s:2:"id";s:1:"1";s:6:"period";s:2:"30";s:11:"period_type";s:4:"days";s:8:"pay_type";s:18:"account_and_direct";s:12:"silver_group";s:4:"7.00";}}', 1, '2017-12-22 08:55:47', '2028-01-21 08:55:47'),
(NULL, 32, 'silver', 2, 'a:14:{s:2:"id";s:1:"3";s:3:"gid";s:6:"silver";s:10:"is_default";s:1:"0";s:9:"is_active";s:1:"1";s:8:"is_trial";s:1:"0";s:12:"trial_period";s:1:"0";s:8:"priority";s:1:"0";s:12:"date_created";s:19:"2017-12-15 13:33:15";s:13:"date_modified";s:19:"2017-12-15 13:33:15";s:6:"name_1";s:6:"Silver";s:13:"description_1";s:16:"The silver group";s:12:"current_name";s:6:"Silver";s:19:"current_description";s:16:"The silver group";s:6:"period";a:5:{s:2:"id";s:1:"2";s:6:"period";s:2:"60";s:11:"period_type";s:4:"days";s:8:"pay_type";s:18:"account_and_direct";s:12:"silver_group";s:5:"12.00";}}', 1, '2017-12-22 09:05:40', '2028-02-20 09:05:40');