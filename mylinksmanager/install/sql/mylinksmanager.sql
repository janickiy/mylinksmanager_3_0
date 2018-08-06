CREATE TABLE IF NOT EXISTS `%prefix%aut` (
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `%prefix%catalog` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `image` mediumblob,
  `image_mime` varchar(40) DEFAULT NULL,
  `parent_id` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `%prefix%links` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `reciprocal_link` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `time_check` datetime DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `full_description` text,
  `htmlcode_banner` text,
  `cat_id` int(9) NOT NULL,
  `status` enum('new','show','hide','black') NOT NULL DEFAULT 'hide',
  `token` varchar(64) DEFAULT NULL,
  `check_link` enum('yes','no') NOT NULL DEFAULT 'yes',
  `views` int(6) NOT NULL DEFAULT '0',
  `reason` varchar(255) DEFAULT NULL,
  `number_check` int(7) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `%prefix%settings` (
  `language` enum('en','ru') NOT NULL,
  `all_number_links` int(6) NOT NULL DEFAULT '0',
  `all_number_new` int(6) NOT NULL DEFAULT '0',
  `columns_number` int(3) NOT NULL DEFAULT '0',
  `number_chars_description_min` int(6) NOT NULL DEFAULT '10',
  `number_chars_description_max` int(6) NOT NULL DEFAULT '300',
  `number_chars_fulldescription_min` int(6) NOT NULL DEFAULT '30',
  `number_chars_fulldescription_max` int(6) NOT NULL DEFAULT '1500',
  `number_html_chars` int(6) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `new_links_notification` enum('yes','no') NOT NULL DEFAULT 'yes',
  `rules` text NOT NULL,
  `htmlcode_site1` text NOT NULL,
  `htmlcode_site2` text NOT NULL,
  `htmlcode_site3` text NOT NULL,
  `htmlcode_banner1` text NOT NULL,
  `htmlcode_banner2` text NOT NULL,
  `htmlcode_banner3` text NOT NULL,
  `template_mail_1` text NOT NULL,
  `template_mail_2` text NOT NULL,
  `template_mail_3` text NOT NULL,
  `template_mail_4` text NOT NULL,
  `template_mail_5` text NOT NULL,
  `template_mail_6` text NOT NULL,
  `template_mail_7` text NOT NULL,
  `from_add_message` text NOT NULL,
  `add_links_without_check` enum('yes','no') NOT NULL DEFAULT 'yes',
  `check_links` enum('yes','no') NOT NULL DEFAULT 'yes',
  `limit_reciprocal_links` enum('yes','no') NOT NULL DEFAULT 'yes',
  `number_reciprocal_links_limit` int(6) NOT NULL DEFAULT '0',
  `common_host` enum('yes','no') NOT NULL DEFAULT 'yes',
  `check_get_parameter` enum('yes','no') NOT NULL DEFAULT 'no',
  `add_to_blacklist` enum('yes','no') NOT NULL DEFAULT 'yes',
  `check_interval` int(6) NOT NULL DEFAULT '0',
  `number_check` int(6) NOT NULL DEFAULT '3',
  `request_captcha` enum('yes','no') NOT NULL DEFAULT 'yes',
  `check_url` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `%prefix%catalog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

ALTER TABLE `%prefix%links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);