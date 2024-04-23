DROP TABLE IF EXISTS `[prefix]landings`;
CREATE TABLE IF NOT EXISTS `[prefix]landings` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `gid` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `url_page` varchar(255) NULL DEFAULT NULL,
  `index_path` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_default_land` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
