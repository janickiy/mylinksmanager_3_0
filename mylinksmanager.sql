-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 10 2017 г., 10:58
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

--
-- База данных: `mylinksmanager_3`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lm_aut`
--

CREATE TABLE `lm_aut` (
  `passw` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lm_aut`
--

INSERT INTO `lm_aut` (`passw`) VALUES
('b59c67bf196a4758191e42f76670ceba');

-- --------------------------------------------------------

--
-- Структура таблицы `lm_catalog`
--

CREATE TABLE `lm_catalog` (
  `id` int(9) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `image` mediumblob,
  `image_mime` varchar(40) DEFAULT NULL,
  `parent_id` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `lm_links`
--

CREATE TABLE `lm_links` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `reciprocal_link` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `time_check` datetime DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `full_description` text,
  `htmlcode_banner` text,
  `cat_id` int(9) DEFAULT NULL,
  `status` enum('new','show','hide','black') NOT NULL DEFAULT 'hide',
  `token` varchar(64) DEFAULT NULL,
  `check_link` enum('yes','no') NOT NULL DEFAULT 'yes',
  `count` int(6) NOT NULL DEFAULT '0',
  `reason` varchar(255) DEFAULT NULL,
  `number_check` int(7) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `lm_settings`
--

CREATE TABLE `lm_settings` (
  `language` enum('en','ru') NOT NULL,
  `all_number_links` int(6) NOT NULL DEFAULT '0',
  `all_number_new` int(6) NOT NULL DEFAULT '0',
  `columns_number` int(3) NOT NULL DEFAULT '0',
  `number_chars_description_min` int(6) NOT NULL DEFAULT '10',
  `number_chars_description_max` int(6) NOT NULL DEFAULT '300',
  `number_chars_fulldescription_min` int(6) NOT NULL DEFAULT '30',
  `number_chars_fulldescription_max` int(6) NOT NULL DEFAULT '1500',
  `number_html_chars` int(6) NOT NULL DEFAULT '0',
  `order_views` enum('1','2') NOT NULL DEFAULT '1',
  `order_links` enum('1','2') NOT NULL DEFAULT '1',
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
  `static` enum('1','2') NOT NULL DEFAULT '2',
  `request_captcha` enum('yes','no') NOT NULL DEFAULT 'yes',
  `show_cy` enum('yes','no') NOT NULL DEFAULT 'yes',
  `show_pr` enum('yes','no') NOT NULL DEFAULT 'yes',
  `check_url` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lm_settings`
--

INSERT INTO `lm_settings` (`language`, `all_number_links`, `all_number_new`, `columns_number`, `number_chars_description_min`, `number_chars_description_max`, `number_chars_fulldescription_min`, `number_chars_fulldescription_max`, `number_html_chars`, `order_views`, `order_links`, `url`, `email`, `new_links_notification`, `rules`, `htmlcode_site1`, `htmlcode_site2`, `htmlcode_site3`, `htmlcode_banner1`, `htmlcode_banner2`, `htmlcode_banner3`, `template_mail_1`, `template_mail_2`, `template_mail_3`, `template_mail_4`, `template_mail_5`, `template_mail_6`, `template_mail_7`, `from_add_message`, `add_links_without_check`, `check_links`, `limit_reciprocal_links`, `number_reciprocal_links_limit`, `common_host`, `check_get_parameter`, `add_to_blacklist`, `check_interval`, `number_check`, `static`, `request_captcha`, `show_cy`, `show_pr`, `check_url`) VALUES
('ru', 5, 5, 3, 20, 300, 100, 1000, 300, '2', '2', '', 'admin@my-domain.com', 'yes', 'РћР±СЏР·Р°С‚РµР»СЊРЅС‹Рј СѓСЃР»РѕРІРёРµРј СЂР°Р·РјРµС‰РµРЅРёСЏ РІР°С€РµР№ СЃСЃС‹Р»РєРё РІ РЅР°С€РµРј РєР°С‚Р°Р»РѕРіРµ - СЂР°Р·РјРµС‰РµРЅРёРµ СЃСЃС‹Р»РєРё РЅР° РЅР°С€ СЂРµСЃСѓСЂСЃ Сѓ Р’Р°СЃ РЅР° СЃР°Р№С‚Рµ. Р•СЃР»Рё Сѓ Р’Р°СЃ РЅР° СЃР°Р№С‚Рµ С‡РµСЂРµР· РЅРµРєРѕС‚РѕСЂРѕРµ РІСЂРµРјСЏ РјС‹ РЅРµ РЅР°Р№РґС‘Рј СЃРІРѕСЋ СЃСЃС‹Р»РєСѓ, С‚Рѕ СѓРґР°Р»РёРј Р’Р°С€Сѓ.', '<a href=http://mysite.com>mysite.com</a> - РћРїРёСЃР°РЅРёРµ СЃР°Р№С‚Р°', '', '', '', '', '', 'Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ!\r\n\r\nРРЅС„РѕСЂРјР°С†РёСЏ Рѕ Р’Р°С€РµРј СЃР°Р№С‚Рµ РґРѕР±Р°РІР»РµРЅР° РІ РєР°С‚Р°Р»РѕРі {[HTTP_HOST]} Рё РїРѕСЃР»Рµ РїСЂРѕРІРµСЂРєРё Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂР° Р±СѓРґРµС‚ РґРѕСЃС‚СѓРїРµРЅР° РїРѕ Р°РґСЂРµСЃСѓ: {[ADRESS]}\r\n------------------------------\r\nРќР°Р·РІР°РЅРёРµ: {[NAME]}\r\nE-mail: {[EMAIL]}\r\nURL: http://{[URL]}\r\nРћРїРёСЃР°РЅРёРµ: {[DESCRIPTION]}\r\n------------------------------\r\nРќР°РїРѕРјРЅСЋ, С‡С‚Рѕ РѕР±СЏР·Р°С‚РµР»СЊРЅС‹Рј СѓСЃР»РѕРІРёРµРј СЂР°Р·РјРµС‰РµРЅРёСЏ Р’Р°С€РµР№ СЃСЃС‹Р»РєРё РІ РЅР°С€РµРј РєР°С‚Р°Р»РѕРіРµ - СЂР°Р·РјРµС‰РµРЅРёРµ СЃСЃС‹Р»РєРё РЅР° РЅР°С€ СЂРµСЃСѓСЂСЃ Сѓ Р’Р°СЃ РЅР° СЃР°Р№С‚Рµ.\r\nРљРѕРґ РЅР°С€РµР№ СЃСЃС‹Р»РєРё:\r\n<a title=РњРѕР№ СЃР°Р№С‚ href=http://mysite.ru>РњРѕР№ СЃР°Р№С‚</a> - РћРїРёСЃР°РЅРёРµ СЃР°Р№С‚Р°.\r\nР•СЃР»Рё Сѓ Р’Р°СЃ РЅР° СЃР°Р№С‚Рµ С‡РµСЂРµР· РЅРµРєРѕС‚РѕСЂРѕРµ РІСЂРµРјСЏ РјС‹ РЅРµ РЅР°Р№РґС‘Рј СЃРІРѕСЋ СЃСЃС‹Р»РєСѓ, С‚Рѕ СѓРґР°Р»РёРј Р’Р°С€Сѓ!\r\n\r\nРЎ СѓРІР°Р¶РµРЅРёРµРј, Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂ СЃР°Р№С‚Р° {[HTTP_HOST]}\r\n\r\nРџРёСЃСЊРјРѕ СЃРѕР·РґР°РЅРѕ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРѕР№ СЃРёСЃС‚РµРјРѕР№ РѕРїРѕРІРµС‰РµРЅРёСЏ.\r\nР”Р°С‚Р° Рё РІСЂРµРјСЏ СЃРѕР·РґР°РЅРёСЏ СЃРѕРѕР±С‰РµРЅРёСЏ: {[DATE]}', 'Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ!\r\n\r\nР’Р°С€ СЃР°Р№С‚ {[URL]} РґРѕР±Р°РІР»РµРЅ РІ РєР°С‚Р°Р»РѕРі СЃСЃС‹Р»РѕРє {[HTTP_HOST]}.\r\n\r\nРЎ СѓРІР°Р¶РµРЅРёРµРј, Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂ СЃР°Р№С‚Р° {[HTTP_HOST]}\r\n\r\nРџРёСЃСЊРјРѕ СЃРѕР·РґР°РЅРѕ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРѕР№ СЃРёСЃС‚РµРјРѕР№ РѕРїРѕРІРµС‰РµРЅРёСЏ.\r\nР”Р°С‚Р° Рё РІСЂРµРјСЏ СЃРѕР·РґР°РЅРёСЏ СЃРѕРѕР±С‰РµРЅРёСЏ: {[DATE]}', 'Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ!\r\n\r\nР’Р°С€Р° СЃСЃС‹Р»РєР° {[URL]} РІСЂРµРјРµРЅРЅРѕ СЃРєСЂС‹С‚Р° РІ РєР°С‚Р°Р»РѕРіРµ СЃСЃС‹Р»РѕРє {[HTTP_HOST]}.\r\nРњС‹ РЅРµ РЅР°С€Р»Рё Р’Р°С€Сѓ СЃСЃС‹Р»РєСѓ РЅР° РЅР°С€ СЃР°Р№С‚ РїРѕ Р°РґСЂРµСЃСѓ: http://{[URL_LINK]}. Р’РѕР·РјРѕР¶РЅРѕ РѕРЅР° Р±С‹Р»Р° РїРµСЂРµРјРµС‰РµРЅР° РёР»Рё СЃС‚СЂР°РЅРёС†Р° РЅР° РєРѕС‚РѕСЂРѕР№ РѕРЅР° СЂР°СЃРїРѕР»РѕР¶РµРЅР° РЅРµРґРѕСЃС‚СѓРїРЅР°. РЈ Р’Р°СЃ {[DATE_LIMIT]} РґРЅ., С‡С‚РѕР±С‹ РІРѕСЃСЃС‚Р°РЅРѕРІРёС‚СЊ РЅР°С€Сѓ СЃСЃС‹Р»РєСѓ, РІ РїСЂРѕС‚РёРІРЅРѕРј СЃР»СѓС‡Р°Рµ Р’Р°С€Р° СЃСЃС‹Р»РєР° Р±СѓРґРµС‚ СѓРґР°Р»РµРЅР° РёР· РЅР°С€РµРіРѕ РєР°С‚Р°Р»РѕРіР°.\r\n\r\nРР·РјРµРЅРёС‚СЊ url Р°РґСЂРµСЃ РѕР±СЂР°С‚РЅРѕР№ СЃСЃС‹Р»РєРё Р’С‹ РјРѕР¶РµС‚Рµ РїРѕ СЃР»РµРґСѓСЋС‰РµР№ СЃСЃС‹Р»РєРµ: http://{[URL_EDIT]}.\r\n\r\nРЎ СѓРІР°Р¶РµРЅРёРµРј, Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂ СЃР°Р№С‚Р° {[HTTP_HOST]}\r\n\r\nРџРёСЃСЊРјРѕ СЃРѕР·РґР°РЅРѕ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРѕР№ СЃРёСЃС‚РµРјРѕР№ РѕРїРѕРІРµС‰РµРЅРёСЏ\r\nР”Р°С‚Р° Рё РІСЂРµРјСЏ СЃРѕР·РґР°РЅРёСЏ СЃРѕРѕР±С‰РµРЅРёСЏ: {[DATE]}', 'Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ!\r\n\r\nР’Р°С€Р° СЃСЃС‹Р»РєР° {[URL]} РІСЂРµРјРµРЅРЅРѕ СЃРєСЂС‹С‚Р° РІ РєР°С‚Р°Р»РѕРіРµ СЃСЃС‹Р»РѕРє {[HTTP_HOST]} РїРѕ РїСЂРёС‡РёРЅРµ С‚РѕРіРѕ, С‡С‚Рѕ {[REASON]}. РЈ Р’Р°СЃ {[DATE_LIMIT]} РґРЅ., С‡С‚РѕР±С‹ СЃРЅСЏС‚СЊ Р·Р°РїСЂРµС‚ РґР»СЏ РёРЅРґСЌРєСЃР°С†РёРё, РІ РїСЂРѕС‚РёРІРЅРѕРј СЃР»СѓС‡Р°Рµ Р’Р°С€Р° СЃСЃС‹Р»РєР° Р±СѓРґРµС‚ СѓРґР°Р»РµРЅР° РёР· РЅР°С€РµРіРѕ РєР°С‚Р°Р»РѕРіР°.\r\n\r\nРЎ СѓРІР°Р¶РµРЅРёРµРј, Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂ СЃР°Р№С‚Р° {[HTTP_HOST]}\r\n\r\nРџРёСЃСЊРјРѕ СЃРѕР·РґР°РЅРѕ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРѕР№ СЃРёСЃС‚РµРјРѕР№ РѕРїРѕРІРµС‰РµРЅРёСЏ.\r\n\r\nР”Р°С‚Р° Рё РІСЂРµРјСЏ СЃРѕР·РґР°РЅРёСЏ СЃРѕРѕР±С‰РµРЅРёСЏ: {[DATE]}', 'РќР° РІР°С€РµРј СЃР°Р№С‚Рµ {[HTTP_HOST]} {[DATE]} РґРѕР±Р°РІР»РµРЅР° РЅРѕРІР°СЏ СЃСЃС‹Р»РєР°:\r\n--------------------------------------------------\r\nРќР°Р·РІР°РЅРёРµ: {[NAME]}\r\nE-mail: {[EMAIL]}\r\nURL: http://{[URL]}\r\nРћРїРёСЃР°РЅРёРµ: {[DESCRIPTION]}\r\n--------------------------------------------------', 'Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ!\r\n\r\nР’Р°С€ СЃР°Р№С‚ {[URL]} СѓРґР°Р»РµРЅ РёР· РєР°С‚Р°Р»РѕРіР° СЃСЃС‹Р»РѕРє {[HTTP_HOST]}.\r\n\r\nРЎ СѓРІР°Р¶РµРЅРёРµРј, Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂ СЃР°Р№С‚Р° {[HTTP_HOST]}\r\n\r\nРџРёСЃСЊРјРѕ СЃРѕР·РґР°РЅРѕ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРѕР№ СЃРёСЃС‚РµРјРѕР№ РѕРїРѕРІРµС‰РµРЅРёСЏ.\r\n\r\nР”Р°С‚Р° Рё РІСЂРµРјСЏ СЃРѕР·РґР°РЅРёСЏ СЃРѕРѕР±С‰РµРЅРёСЏ: {[DATE]}', 'Р—РґСЂР°РІСЃС‚РІСѓР№С‚Рµ!\r\n\r\nР’Р°С€ СЃР°Р№С‚ {[URL]} РЅРµ Р±С‹Р» РґРѕР±Р°РІР»РµРЅ РІ РєР°С‚Р°Р»РѕРі СЃР°Р№С‚РѕРІ {[HTTP_HOST]}, С‚.Рє. РЅРµ РїСЂРѕС€РµР» РїСЂРѕРІРµСЂРєСѓ.\r\n\r\nРЎ СѓРІР°Р¶РµРЅРёРµРј, Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂ СЃР°Р№С‚Р° {[HTTP_HOST]}\r\n\r\nРџРёСЃСЊРјРѕ СЃРѕР·РґР°РЅРѕ Р°РІС‚РѕРјР°С‚РёС‡РµСЃРєРѕР№ СЃРёСЃС‚РµРјРѕР№ РѕРїРѕРІРµС‰РµРЅРёСЏ.\r\nР”Р°С‚Р° Рё РІСЂРµРјСЏ СЃРѕР·РґР°РЅРёСЏ СЃРѕРѕР±С‰РµРЅРёСЏ: {[DATE]}', 'Р’Р°С€Р° СЃСЃС‹Р»РєР° РґРѕР±Р°РІР»РµРЅР° РІ РѕС‡РµСЂРµРґСЊ РЅР° РїСЂРѕРІРµСЂРєСѓ Рё Р±СѓРґРµС‚ РґРѕСЃС‚СѓРїРЅР° РІ РєР°С‚Р°Р»РѕРіРµ РїРѕСЃР»Рµ РїСЂРѕРІРµСЂРєРё Р°РґРјРёРЅРёСЃС‚СЂР°С‚РѕСЂР°!', 'no', 'yes', 'no', 30, 'no', 'no', 'yes', 7, 3, '2', 'yes', 'yes', 'yes', 'no');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lm_catalog`
--
ALTER TABLE `lm_catalog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lm_links`
--
ALTER TABLE `lm_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lm_catalog`
--
ALTER TABLE `lm_catalog`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `lm_links`
--
ALTER TABLE `lm_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
