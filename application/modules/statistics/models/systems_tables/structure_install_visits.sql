DROP TABLE IF EXISTS `[prefix]statistics_visits`;
CREATE TABLE IF NOT EXISTS `[prefix]statistics_visits` (
  `object_time` varchar(50) NOT NULL,
  `user_agent` varchar(255) NULL,
  `count` int(11) NOT NULL,
  `date` datetime, 
  UNIQUE `object_time` (`object_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
 
