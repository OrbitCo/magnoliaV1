DROP TABLE IF EXISTS `[prefix]winks`;
CREATE TABLE IF NOT EXISTS `[prefix]winks` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_from` INT(10) UNSIGNED NOT NULL COMMENT '@[prefix]users:id',
	`id_to` INT(10) UNSIGNED NOT NULL COMMENT '@[prefix]users:id',
	`type` ENUM('new','replied','ignored','deleted') NOT NULL DEFAULT 'new',
	`date` DATETIME NOT NULL,
	`is_viewed` TINYINT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `users` (`id_from`, `id_to`)
)
ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[prefix]winks` (`id`, `id_from`, `id_to`, `type`, `date`) VALUES
(null, 16, 15, 'new', '2016-07-29 11:44:45'),
(null, 4, 8, 'new', '2016-07-29 11:45:35'),
(null, 10, 7, 'new', '2016-07-29 11:47:02'),
(null, 6, 1, 'new', '2016-07-29 11:47:33'),
(null, 4, 16, 'new', '2016-07-29 11:47:33'),
(null, 22, 5, 'new', '2017-12-19 20:48:15'),
(null, 22, 3, 'new', '2017-12-19 20:59:19'),
(null, 23, 21, 'new', '2017-12-19 21:03:19'),
(null, 24, 20, 'new', '2017-12-19 21:35:02'),
(null, 24, 23, 'replied', '2017-12-19 21:39:35'),
(null, 30, 23, 'new', '2017-12-22 11:55:00'),
(null, 32, 30, 'replied', '2017-12-22 11:55:28'),
(null, 30, 28, 'new', '2017-12-22 11:56:08'),
(null, 30, 6, 'new', '2017-12-22 11:57:14'),
(null, 30, 9, 'new', '2017-12-22 11:57:22'),
(null, 30, 11, 'new', '2017-12-22 11:57:26');