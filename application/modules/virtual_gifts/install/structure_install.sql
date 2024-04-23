DROP TABLE IF EXISTS `[prefix]virtual_gifts`;
CREATE TABLE IF NOT EXISTS `[prefix]virtual_gifts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) NOT NULL,
  `is_special_price` tinyint(1) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `fk_currency_gid` varchar(5) NOT NULL,
  `priority` int(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `[prefix]virtual_gifts_users`;
CREATE TABLE IF NOT EXISTS `[prefix]virtual_gifts_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(10) NOT NULL,
  `fk_sender_id` int(10) NOT NULL,
  `gift_id` int(10) NOT NULL,
  `is_new` tinyint(1) DEFAULT '0',
  `img` varchar(255) NOT NULL,
  `img_thumb` varchar(255) NOT NULL,
  `is_private` tinyint(1) NOT NULL,
  `comment` blob NOT NULL,
  `status` enum('approved','decline','pending') NOT NULL DEFAULT 'pending',
  `receipt_date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `[prefix]virtual_gifts` (`id`, `img`, `is_special_price`, `price`, `fk_currency_gid`, `priority`, `is_active`, `created_date`) VALUES
(1, 'ef69a1e6d5.png', 0, '1.00', 'USD', 1, 1, '2016-01-12 07:28:14'),
(2, '491b2989e0.png', 0, '1.00', 'USD', 2, 1, '2016-01-12 07:28:14'),
(3, '58785fbf89.png', 0, '1.00', 'USD', 3, 1, '2016-01-12 07:28:14'),
(4, '66b7dc9014.png', 0, '1.00', 'USD', 4, 1, '2016-01-12 07:28:14');

INSERT INTO `[prefix]virtual_gifts_users` (`id`, `fk_user_id`, `fk_sender_id`, `gift_id`, `is_new`, `img`, `img_thumb`, `is_private`, `comment`, `status`, `receipt_date`) VALUES
(1, 1, 4, 1, 0, 'uploads/virtual-gifts/2016/01/12/1/ef69a1e6d5.png', 'uploads/virtual-gifts/2016/01/12/1/big-ef69a1e6d5.png', 1, '''Hey Will, this gift is for you :)''', 'approved', '2017-12-19 10:11:04'),
(2, 22, 24, 2, 0, 'uploads/virtual-gifts/2016/01/12/2/491b2989e0.png', 'uploads/virtual-gifts/2016/01/12/2/big-491b2989e0.png', 0, "Just found your profile and it's your b-day, what are the chances? Have a happy one ;)", 'approved', '2017-12-19 18:36:08'),
(3, 18, 32, 1, 0, 'uploads/virtual-gifts/2016/01/12/1/ef69a1e6d5.png', 'uploads/virtual-gifts/2016/01/12/1/big-ef69a1e6d5.png', 1, 'Happy belated birthday, Bobby!', 'pending', '2017-12-22 12:20:41');
