-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 13 2019 г., 22:22
-- Версия сервера: 5.7.24
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fsystem`
--

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL DEFAULT '0',
  `prev_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT 'This is some boring default description for this very topic',
  `user_id` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prev_id` (`prev_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `level`, `prev_id`, `title`, `description`, `user_id`, `created_at`) VALUES
(1, 0, NULL, 'Me and Friends', 'another one', 1, '2019-07-14 00:55:53'),
(2, 1, 1, 'This explains the beginning of my life all', 'This is some boring default description for this very topic', 2, '2019-07-14 00:55:53'),
(3, 0, NULL, 'Another one', 'Do they keep attempting to organise that wine tasting course', 3, '2019-07-14 00:55:53'),
(4, 1, 2, 'What is it', 'we recommend checking with their partner or sneaking a peek', 2, '2019-07-14 00:55:53'),
(5, 1, 3, 'My life from the beginning was very fun', 'meet them outside at the end of the day and', 2, '2019-07-14 00:55:53'),
(6, 1, 3, 'Why am i that good', 'helo', 1, '2019-07-14 00:55:53'),
(21, 3, 14, 'another you', 'another me', 1, '2019-07-14 01:17:29'),
(7, 2, 5, 'In order to go', 'change me, please', 2, '2019-07-14 00:55:53'),
(8, 3, 7, 'Decided to stay here', 'll be heading out for a drink somewhere nearby to', 1, '2019-07-14 00:55:53'),
(9, 0, NULL, 'the way to the end of my life.', 'Invite their closest friends and instruct them to meet you', 1, '2019-07-14 00:55:53'),
(10, 2, 2, 'bla bla bla', 's a surprise partyTake them on an', 1, '2019-07-14 00:55:53'),
(11, 1, 9, 'as I grew up living with my moms', 'Jump in the car for a day trip to a', 2, '2019-07-14 00:55:53'),
(12, 2, 11, 'friend and my friend. But there were a', 'or head into the city for the', 3, '2019-07-14 00:55:53'),
(13, 2, 11, 'Right now', 'Make sure you include a tasty lunch location and take', 1, '2019-07-14 00:55:53'),
(14, 2, 2, 'lot of fights and I was very hyper', 'Choose their office as the delivery address so they can', 1, '2019-07-14 00:55:53'),
(15, 1, 3, 'Maybe another', 'Find out how to pick the perfect arrangement for them', 2, '2019-07-14 00:55:53'),
(16, 2, 6, 'back then. I have ADHD so back then', 'orange lily and coloured drinTreat them to their favourite', 1, '2019-07-14 00:55:53'),
(17, 2, 5, 'when I was little; I was very hyper', 'or recreate one they have mentioned fond memories', 3, '2019-07-14 00:55:53'),
(18, 0, NULL, 'What was it', 'Most of us remember picking our dream cake from the', 1, '2019-07-14 00:55:53'),
(19, 1, 18, 'and would not stop moving around the place. I', 'or tucking into ice cream cake before it', 3, '2019-07-14 00:55:53'),
(22, 0, NULL, 'totally new topic', 'as you ca nsess', 1, '2019-07-14 01:17:57'),
(23, 1, 22, 'and now from boss account', 'yee', 2, '2019-07-14 01:18:22'),
(24, 2, 23, 'anoce again', 'aaa', 2, '2019-07-14 01:18:32'),
(25, 2, 23, 'beautiful', 'woohoo', 2, '2019-07-14 01:18:42');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`) VALUES
(1, 'dima', '$2y$10$AaRRT.bkxszqRyh9ShpnQuaYrEjM1HXOvG/Gd8r4JG0f5U6txOspi'),
(2, 'boss', '$2y$10$AaRRT.bkxszqRyh9ShpnQuaYrEjM1HXOvG/Gd8r4JG0f5U6txOspi'),
(3, 'user123', '$2y$10$AaRRT.bkxszqRyh9ShpnQuaYrEjM1HXOvG/Gd8r4JG0f5U6txOspi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
