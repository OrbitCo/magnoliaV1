DROP TABLE IF EXISTS `[prefix]twilio_video_chat`;
CREATE TABLE `[prefix]twilio_video_chat` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `user_to_id` int(11) NOT NULL,
  `sid` varchar(50) NOT NULL,
  `room_name` varchar(80) NOT NULL,
  `status` text NOT NULL,
  `token` text NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(10,2) NULL DEFAULT 0.00,
  `participant_connect` text NULL DEFAULT null,
  `date_created` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`creator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
