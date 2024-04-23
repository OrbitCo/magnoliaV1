ALTER TABLE  `[prefix]users` ADD  `looking_user_type` VARCHAR(50) NOT NULL AFTER  `user_type`;
ALTER TABLE  `[prefix]users` ADD  `age_min` VARCHAR(50) NOT NULL AFTER  `age`;
ALTER TABLE  `[prefix]users` ADD  `age_max` VARCHAR(50) NOT NULL AFTER  `age_min`;

DROP TABLE IF EXISTS `[prefix]perfect_match`;
CREATE TABLE IF NOT EXISTS `[prefix]perfect_match` (
  `id_user` int(10) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `id_country` char(2) NOT NULL,
  `id_region` int(3) NOT NULL,
  `id_city` int(3) NOT NULL,
  `lat` decimal(11,7) NOT NULL,
  `lon` decimal(11,7) NOT NULL,
  `age` tinyint(3) NOT NULL,
  `looking_user_type` varchar(255) NOT NULL,
  `looking_id_country` char(2) NOT NULL,
  `looking_id_region` int(3) NOT NULL,
  `looking_id_city` int(3) NOT NULL,
  `looking_lat` decimal(11,7) NOT NULL,
  `looking_lon` decimal(11,7) NOT NULL,
  `age_min` tinyint(3) NOT NULL,
  `age_max` tinyint(3) NOT NULL,
  `full_criteria` text,
  `is_need_notify` tinyint(1) NOT NULL default '1',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[prefix]perfect_match` (`id_user`, `user_type`,`id_country`,`id_region`, `id_city`, `lat`, `lon`, `age`) SELECT `id`, `user_type`, `id_country`, `id_region`, `id_city`, `lat`, `lon`, `age` FROM `[prefix]users`;
