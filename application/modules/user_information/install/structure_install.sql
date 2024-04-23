DROP TABLE IF EXISTS `[prefix]user_information`;
CREATE TABLE `[prefix]user_information` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(3) NOT NULL,
  `lang_id` int(3) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `data`  text NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
 `notified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;