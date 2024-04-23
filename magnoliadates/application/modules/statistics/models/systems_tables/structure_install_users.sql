DROP TABLE IF EXISTS `[prefix]statistics_users`;
CREATE TABLE IF NOT EXISTS `[prefix]statistics_users` (
  `object_id` int(3) NOT NULL,
  `search_count` int(11) NOT NULL,
  `search_last_date` datetime,  
  `registered_count` int(11) NOT NULL,
  `registered_total` int(11) NOT NULL,
  `registered_day_1` int(11) NOT NULL,
  `registered_day_2` int(11) NOT NULL,
  `registered_day_3` int(11) NOT NULL,
  `registered_day_4` int(11) NOT NULL,
  `registered_day_5` int(11) NOT NULL,
  `registered_day_6` int(11) NOT NULL,
  `registered_day_7` int(11) NOT NULL,
  `registered_day_8` int(11) NOT NULL,
  `registered_day_9` int(11) NOT NULL,
  `registered_day_10` int(11) NOT NULL,
  `registered_day_11` int(11) NOT NULL,
  `registered_day_12` int(11) NOT NULL,
  `registered_day_13` int(11) NOT NULL,
  `registered_day_14` int(11) NOT NULL,
  `profile_view_count` int(11) NOT NULL,
  `profile_view_total` int(11) NOT NULL,
  `profile_view_last_date` datetime,  
  `profile_viewed_count` int(11) NOT NULL,
  `profile_viewed_total` int(11) NOT NULL,
  `profile_viewed_last_date` datetime,
  UNIQUE `object_id` (`object_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
