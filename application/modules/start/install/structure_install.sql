DROP TABLE IF EXISTS `[prefix]start_desktop_notify_users`;
CREATE TABLE IF NOT EXISTS `[prefix]start_desktop_notify_users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_user` int(3) NOT NULL,
  `gid_notification` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE (`id_user`, `gid_notification`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]copyright`;
CREATE TABLE IF NOT EXISTS `[prefix]copyright` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `gid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;