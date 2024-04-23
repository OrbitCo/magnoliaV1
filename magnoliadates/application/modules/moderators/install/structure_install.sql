DROP TABLE IF EXISTS `[prefix]ausers_moderate_methods`;
CREATE TABLE `[prefix]ausers_moderate_methods` (
`id` INT( 3 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`module` VARCHAR( 25 ) NOT NULL ,
`method` VARCHAR( 100 ) NOT NULL ,
`is_default` TINYINT( 1 ) DEFAULT '1',
`group_id` TINYINT( 3 ) DEFAULT '1',
`is_hidden` TINYINT( 1 ) DEFAULT '0',
`parent_module` VARCHAR( 25 ) DEFAULT ''
) ENGINE = MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]ausers_moderate_method_groups`;
CREATE TABLE `[prefix]ausers_moderate_method_groups` (
`id` INT( 3 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`gid` VARCHAR( 25 ) NOT NULL,
`sort_order` TINYINT( 3 ) DEFAULT '1'
) ENGINE = MYISAM DEFAULT CHARSET=utf8;
