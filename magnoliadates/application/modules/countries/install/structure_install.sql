DROP TABLE IF EXISTS `[prefix]cnt_cache_countries`;
CREATE TABLE `[prefix]cnt_cache_countries` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `name` varchar(200) NOT NULL,
  `areainsqkm` double NOT NULL,
  `continent` char(2) NOT NULL,
  `currency` char(3) NOT NULL,
  `region_update_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]cnt_cache_regions`;
CREATE TABLE `[prefix]cnt_cache_regions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `country_code` char(2) NOT NULL,
  `code` varchar(10) NOT NULL,
  `id_region` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_code_1` (`country_code`,`code`),
  KEY `country_code` (`country_code`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]cnt_cities`;
CREATE TABLE `[prefix]cnt_cities` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_region` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `country_code` char(2) NOT NULL,
  `region_code` varchar(10) NOT NULL,
  `priority` int(3) NOT NULL,
  `sorted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_region` (`id_region`),
  KEY `country_code` (`country_code`,`region_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]cnt_countries`;
CREATE TABLE `[prefix]cnt_countries` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `name` varchar(200) NOT NULL,
  `areainsqkm` double NOT NULL,
  `continent` char(2) NOT NULL,
  `currency` char(3) NOT NULL,
  `priority` tinyint(3) NOT NULL,
  `sorted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]cnt_regions`;
CREATE TABLE `[prefix]cnt_regions` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `country_code` char(2) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `priority` tinyint(3) NOT NULL,
  `sorted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `country_code` (`country_code`,`priority`),
  KEY `country_code_2` (`country_code`,`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
