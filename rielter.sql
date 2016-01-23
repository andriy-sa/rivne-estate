-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Січ 23 2016 р., 22:39
-- Версія сервера: 5.6.27-0ubuntu0.15.04.1
-- Версія PHP: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `rielter`
--

-- --------------------------------------------------------

--
-- Структура таблиці `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Дома,дачі,котеджі'),
(2, 'Квартири'),
(4, 'Земельні ділянки');

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`id`, `name`, `text`, `created_at`) VALUES
(1, 'Олег Петров', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolores eaque magnam nobis non odio optio sequi veniam veritatis voluptatum. Architecto est ipsam officia vel voluptatum! Architecto dolore in minima.', '2016-01-18 22:00:00'),
(2, 'Оксана Валеріївна', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam dolores eaque magnam nobis non odio optio sequi veniam veritatis voluptatum. Architecto est ipsam officia vel voluptatum! Architecto dolore in minima.', '2016-01-19 22:00:00'),
(3, 'Валерій', 'Хороша ріелторська компанія.\r\nЗадоволений послугами, які надали мені.\r\nПретензій немає', '2016-01-20 21:29:35');

-- --------------------------------------------------------

--
-- Структура таблиці `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `districts`
--

INSERT INTO `districts` (`id`, `title`) VALUES
(1, 'Північний'),
(2, 'Боярка');

-- --------------------------------------------------------

--
-- Структура таблиці `estates`
--

CREATE TABLE IF NOT EXISTS `estates` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `coor` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `rieltor_id` int(11) NOT NULL,
  `top` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `estates`
--

INSERT INTO `estates` (`id`, `title`, `address`, `price`, `currency`, `description`, `coor`, `type`, `category_id`, `district_id`, `rieltor_id`, `top`, `published`, `created_at`, `updated_at`) VALUES
(3, 'Будинок цегляний', 'вул. Відінскька 58', 58000, 'грн', '<p>будинок цегляний з центральним опаленням, пічка, 4 кімнати, кухня, ганок, коридор, присадибна ділянка.</p>\r\n\r\n<p>Загальною&nbsp;&nbsp;площею - 400 кв.м, земельна приватизована ділянка - 0,48 га, огорожа, поруч ставок площею - 0,50 га. Можливе використання під готельний бізнес. Можливий обмін. - See more at: http://rio.if.ua/real-estate/id/320/#sthash.MG4uB1GB.dpuf</p>\r\n', '[50.62188761134921,26.2308669090271]', 'Продаж', 1, 2, 4, 1, 1, '2016-01-11 20:36:36', '0000-00-00 00:00:00'),
(4, 'Продається 2х поверховий обжитий дім', 'Соборна 55', 50000, '$', '<p>Будинок в Пронятині (новобудови) на початку вулиці, рівна ділянка 12 сотих, обжитий, утеплений, великі підвали, жила вулиця, 2 гаражі, 2 підводи води (скважина і башня), септик, сад, город, вольєр для собаки, сигналізація. Тернопільська прописка. Торг.</p>\r\n', '[50.60693760818473,26.282730102539062]', 'Продаж', 1, 1, 3, 1, 1, '2016-01-11 20:42:28', '0000-00-00 00:00:00'),
(5, '3-х кімнатна квартира', 'Відінська 55 кв. 155', 20000, '$', '<p>Квартира знаходиться на першому високому поверсі, засклена лоджия, мпв вікна, паркет, житловий стан. Можливий торг.</p>\r\n', '[50.60494936278878,26.220180988311768]', 'Продаж', 2, 2, 4, 1, 1, '2016-01-11 20:46:17', '0000-00-00 00:00:00'),
(6, 'Здаю кімнату для заочників', 'Відінська 88 кв. 17', 1000, 'грн', '<p>Здається одна-дві кімнати. Є індивідуальне опалення. Квартира трьохкімнатна.</p>\r\n', '[50.604486334677134,26.265864372253418]', 'Аренда', 2, 2, 3, 1, 1, '2016-01-11 20:49:01', '0000-00-00 00:00:00'),
(7, 'Візьму на підселення 2 -х дівчат', 'Д. Галицького 50 кв. 999', 700, 'грн', '<p>Здається 2-кімнатна квартира,шукаю 2 -х порядних дівчат на підселення, район Бам&nbsp;<br />\r\nЦіна 700грн + комунальні послуги, холодильник, пральна машина є</p>\r\n', '[50.62021312053433,26.237540245056152]', 'Аренда', 2, 1, 3, 1, 1, '2016-01-11 20:51:23', '2016-01-11 20:53:24');

-- --------------------------------------------------------

--
-- Структура таблиці `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'user', 'General User');

-- --------------------------------------------------------

--
-- Структура таблиці `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
`id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `estate_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `photos`
--

INSERT INTO `photos` (`id`, `image`, `estate_id`) VALUES
(1, '06fc1e5ca37f28746117762c8c1d47f5.jpg', 3),
(2, 'b3e29b2a86f7c5f1f3703ef3b1aaa970.jpg', 3),
(3, '8e4d10bfa42f7e7ae62a63cbb1389e4d.png', 4),
(4, '73f163be677b75227acbfb5c4382ad6f.png', 4),
(5, 'a9e095c76aa6e93cc5a46c167f29925c.jpg', 5),
(6, '78c793ed40ad4ddd179af45d8ba4dcac.jpg', 5),
(7, '237ccfdfe4b905476c20cd2a7d1e03d7.jpg', 7),
(8, '41944754fa6e1568f1af7e2a3fbf39c3.jpg', 7),
(9, '51f9ac139c85da6a4bdd73e8f1a04b4d.jpg', 7),
(10, '333ed84dc506b8061323cc978584a38a.jpg', 7);

-- --------------------------------------------------------

--
-- Структура таблиці `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `requests`
--

INSERT INTO `requests` (`id`, `name`, `phone`, `email`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Roman', '45454', 'email', 'ndjfdjkhfjkahsfhasjkfhaskjfhjkasdfsgdfsdfsdfsdfsdfdsfdsdfdddddddddddddddddddddddddddd\r\nddddddddddddddddsgfdhgdfg', '2016-01-21 22:00:00', '0000-00-00 00:00:00'),
(4, 'Kostay', '45456544', 'kostya@mail', 'test message', '2016-01-23 17:42:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблиці `rieltors`
--

CREATE TABLE IF NOT EXISTS `rieltors` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `rieltors`
--

INSERT INTO `rieltors` (`id`, `name`, `phone`, `photo`) VALUES
(3, 'Петров Олександер Сергійович', '+38 (050) 358-47-85\r\n+38 (096) 347-47-13\r\n+38 (063) 115-14-88', '1795eb9d4bd1238a4cfe1a48ab10cd4e.jpg'),
(4, 'Коліщук Андрій Василбович', '+38 (066) 458-96-32\r\n+38 (067) 478-12-45', '3f0f9ceafc220ffb83f606c109c070a1.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `slides`
--

INSERT INTO `slides` (`id`, `title`, `subtitle`, `image`) VALUES
(1, 'Lorem ipsum dolor.', 'Lorem ipsum dolor sit amet, consectetur adipisicing.', 'slide-1.jpg'),
(2, 'Lorem ipsum dolor.2', 'Lorem ipsum dolor sit amet, consectetur adipisicing.2', 'slide-2.jpg'),
(3, 'Lorem ipsum dolor.3', 'Lorem ipsum dolor sit amet, consectetur adipisicing.3', 'slide-3.jpg');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'O4.B9JENb7Yrcmo0GBBENO', 1268889823, 1453581332, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Структура таблиці `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `districts`
--
ALTER TABLE `districts`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `estates`
--
ALTER TABLE `estates`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `photos`
--
ALTER TABLE `photos`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `requests`
--
ALTER TABLE `requests`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `rieltors`
--
ALTER TABLE `rieltors`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `slides`
--
ALTER TABLE `slides`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблиці `districts`
--
ALTER TABLE `districts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблиці `estates`
--
ALTER TABLE `estates`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблиці `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблиці `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблиці `photos`
--
ALTER TABLE `photos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблиці `requests`
--
ALTER TABLE `requests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблиці `rieltors`
--
ALTER TABLE `rieltors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблиці `slides`
--
ALTER TABLE `slides`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблиці `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
