DROP TABLE IF EXISTS `[prefix]chatbox`;
CREATE TABLE IF NOT EXISTS `[prefix]chatbox` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `linked_id` bigint(11) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `message` blob NOT NULL,
  `dir` enum('i','o') NOT NULL,
  `is_read` tinyint(3) NOT NULL DEFAULT '0',
  `full_load` tinyint(3) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_readed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `attaches_count` int(3) NOT NULL DEFAULT '0',
  `is_notify` tinyint(1) NOT NULL DEFAULT '0',
  `is_system_msg` tinyint(1) NOT NULL DEFAULT '0',
  `search_field` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  FULLTEXT KEY `search_field` (`search_field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]chatbox_attaches`;
CREATE TABLE  IF NOT EXISTS  `[prefix]chatbox_attaches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` bigint(11) unsigned NOT NULL,
  `user_id` int(3) NOT NULL,
  `contact_id` int(3) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `mime` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]chatbox_contact_list`;
CREATE TABLE IF NOT EXISTS `[prefix]chatbox_contact_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `count_new` int(3) NOT NULL,
  `date_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_contact_id` (`user_id`,`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;