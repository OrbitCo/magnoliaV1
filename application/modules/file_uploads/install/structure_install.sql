DROP TABLE IF EXISTS `[prefix]file_uploads`;
CREATE TABLE IF NOT EXISTS `[prefix]file_uploads` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `gid` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `max_size` int(3) NOT NULL,
  `name_format` enum('generate','format') NOT NULL DEFAULT 'generate',
  `file_formats` text NOT NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]files`;
CREATE TABLE IF NOT EXISTS `[prefix]files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `file_url` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `is_new` tinyint(4) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
