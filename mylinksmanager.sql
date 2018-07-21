-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 21 2018 г., 18:05
-- Версия сервера: 10.1.31-MariaDB
-- Версия PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mylinksmanager`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lm_aut`
--

CREATE TABLE `lm_aut` (
  `password` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lm_aut`
--

INSERT INTO `lm_aut` (`password`) VALUES
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

--
-- Дамп данных таблицы `lm_catalog`
--

INSERT INTO `lm_catalog` (`id`, `name`, `description`, `keywords`, `image`, `image_mime`, `parent_id`) VALUES
(7, 'Category 1', 'Category 1', '', '', '', 0),
(8, 'Category 2', 'Category 2', '', '', '', 0),
(9, 'Category 3', 'Category 3', '', '', '', 0),
(10, 'Category 4', 'Category 4', '', '', '', 0),
(11, 'Subcategory 3', 'Subcategory 3', '', '', '', 10),
(12, 'Subcategory 1', 'Subcategory 1', '', '', '', 10),
(13, 'Subcategory 2', 'Subcategory 2', '', '', '', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `lm_links`
--

CREATE TABLE `lm_links` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `reciprocal_link` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
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
  `views` int(6) NOT NULL DEFAULT '0',
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
  `request_captcha` enum('yes','no') NOT NULL DEFAULT 'yes',
  `show_cy` enum('yes','no') NOT NULL DEFAULT 'yes',
  `show_pr` enum('yes','no') NOT NULL DEFAULT 'yes',
  `check_url` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lm_settings`
--

INSERT INTO `lm_settings` (`language`, `all_number_links`, `all_number_new`, `columns_number`, `number_chars_description_min`, `number_chars_description_max`, `number_chars_fulldescription_min`, `number_chars_fulldescription_max`, `number_html_chars`, `order_views`, `order_links`, `url`, `email`, `new_links_notification`, `rules`, `htmlcode_site1`, `htmlcode_site2`, `htmlcode_site3`, `htmlcode_banner1`, `htmlcode_banner2`, `htmlcode_banner3`, `template_mail_1`, `template_mail_2`, `template_mail_3`, `template_mail_4`, `template_mail_5`, `template_mail_6`, `template_mail_7`, `from_add_message`, `add_links_without_check`, `check_links`, `limit_reciprocal_links`, `number_reciprocal_links_limit`, `common_host`, `check_get_parameter`, `add_to_blacklist`, `check_interval`, `number_check`, `request_captcha`, `show_cy`, `show_pr`, `check_url`) VALUES
('ru', 5, 5, 3, 20, 300, 100, 1000, 300, '2', '2', '', 'admin@my-domain.com', 'yes', 'Обязательным условием размещения вашей ссылки в нашем каталоге - размещение ссылки на наш ресурс у Вас на сайте. Если у Вас на сайте через некоторое время мы не найдём свою ссылку, то удалим Вашу.', '<a href=http://mysite.com>mysite.com</a> - Описание сайта', '', '', '', '', '', 'Здравствуйте!\r\n\r\nИнформация о Вашем сайте добавлена в каталог {[HTTP_HOST]} и после проверки администратора будет доступена по адресу: {[ADRESS]}\r\n------------------------------\r\nНазвание: {[NAME]}\r\nE-mail: {[EMAIL]}\r\nURL: http://{[URL]}\r\nОписание: {[DESCRIPTION]}\r\n------------------------------\r\nНапомню, что обязательным условием размещения Вашей ссылки в нашем каталоге - размещение ссылки на наш ресурс у Вас на сайте.\r\nКод нашей ссылки:\r\n<a title=Мой сайт href=http://mysite.ru>Мой сайт</a> - Описание сайта.\r\nЕсли у Вас на сайте через некоторое время мы не найдём свою ссылку, то удалим Вашу!\r\n\r\nС уважением, администратор сайта {[HTTP_HOST]}\r\n\r\nПисьмо создано автоматической системой оповещения.\r\nДата и время создания сообщения: {[DATE]}', 'Здравствуйте!\r\n\r\nВаш сайт {[URL]} добавлен в каталог ссылок {[HTTP_HOST]}.\r\n\r\nС уважением, администратор сайта {[HTTP_HOST]}\r\n\r\nПисьмо создано автоматической системой оповещения.\r\nДата и время создания сообщения: {[DATE]}', 'Здравствуйте!\r\n\r\nВаша ссылка {[URL]} временно скрыта в каталоге ссылок {[HTTP_HOST]}.\r\nМы не нашли Вашу ссылку на наш сайт по адресу: http://{[URL_LINK]}. Возможно она была перемещена или страница на которой она расположена недоступна. У Вас {[DATE_LIMIT]} дн., чтобы восстановить нашу ссылку, в противном случае Ваша ссылка будет удалена из нашего каталога.\r\n\r\nИзменить url адрес обратной ссылки Вы можете по следующей ссылке: http://{[URL_EDIT]}.\r\n\r\nС уважением, администратор сайта {[HTTP_HOST]}\r\n\r\nПисьмо создано автоматической системой оповещения\r\nДата и время создания сообщения: {[DATE]}', 'Здравствуйте!\r\n\r\nВаша ссылка {[URL]} временно скрыта в каталоге ссылок {[HTTP_HOST]} по причине того, что {[REASON]}. У Вас {[DATE_LIMIT]} дн., чтобы снять запрет для индэксации, в противном случае Ваша ссылка будет удалена из нашего каталога.\r\n\r\nС уважением, администратор сайта {[HTTP_HOST]}\r\n\r\nПисьмо создано автоматической системой оповещения.\r\n\r\nДата и время создания сообщения: {[DATE]}', 'На вашем сайте {[HTTP_HOST]} {[DATE]} добавлена новая ссылка:\r\n--------------------------------------------------\r\nНазвание: {[NAME]}\r\nE-mail: {[EMAIL]}\r\nURL: http://{[URL]}\r\nОписание: {[DESCRIPTION]}\r\n--------------------------------------------------', 'Здравствуйте!\r\n\r\nВаш сайт {[URL]} удален из каталога ссылок {[HTTP_HOST]}.\r\n\r\nС уважением, администратор сайта {[HTTP_HOST]}\r\n\r\nПисьмо создано автоматической системой оповещения.\r\n\r\nДата и время создания сообщения: {[DATE]}', 'Здравствуйте!\r\n\r\nВаш сайт {[URL]} не был добавлен в каталог сайтов {[HTTP_HOST]}, т.к. не прошел проверку.\r\n\r\nС уважением, администратор сайта {[HTTP_HOST]}\r\n\r\nПисьмо создано автоматической системой оповещения.\r\nДата и время создания сообщения: {[DATE]}', 'Ваша ссылка добавлена в очередь на проверку и будет доступна в каталоге после проверки администратора!', 'no', 'yes', 'no', 30, 'no', 'no', 'yes', 7, 3, 'yes', 'yes', 'yes', 'no');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lm_catalog`
--
ALTER TABLE `lm_catalog`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `lm_links`
--
ALTER TABLE `lm_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
