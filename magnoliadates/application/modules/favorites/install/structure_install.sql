DROP TABLE IF EXISTS `[prefix]favorites`;
CREATE TABLE `[prefix]favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_dest_user` int(11) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user_id_dest_user` (`id_user`,`id_dest_user`),
  KEY `id_dest_user` (`id_dest_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]favorites_callbacks`;
CREATE TABLE `[prefix]favorites_callbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `event_status` varchar(20) NOT NULL DEFAULT '',
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_status` (`event_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[prefix]favorites` (`id`, `id_user`, `id_dest_user`, `date_add`) VALUES
(null, 23, 18, '2017-12-19 21:10:23');