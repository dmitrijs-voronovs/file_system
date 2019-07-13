-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 12 2019 г., 14:48
-- Версия сервера: 5.7.26
-- Версия PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prev_id` (`prev_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `level`, `prev_id`, `title`, `created_at`) VALUES
(1, 0, NULL, 'Me and Friends', '2019-07-12 17:45:46'),
(2, 1, 1, 'This explains the beginning of my life all', '2019-07-12 17:45:46'),
(3, 0, NULL, 'Another one', '2019-07-12 17:45:46'),
(4, 1, 2, 'What is it', '2019-07-12 17:45:46'),
(5, 1, 3, 'My life from the beginning was very fun', '2019-07-12 17:45:46'),
(6, 1, 3, 'Why am i that good', '2019-07-12 17:45:46'),
(7, 2, 5, 'In order to go', '2019-07-12 17:45:46'),
(8, 3, 7, 'Decided to stay here', '2019-07-12 17:45:46'),
(9, 0, NULL, 'the way to the end of my life.', '2019-07-12 17:45:46'),
(10, 2, 2, 'bla bla bla', '2019-07-12 17:45:46'),
(11, 1, 9, 'as I grew up living with my moms', '2019-07-12 17:45:46'),
(12, 2, 11, 'friend and my friend. But there were a', '2019-07-12 17:45:46'),
(13, 2, 11, 'Right now', '2019-07-12 17:45:46'),
(14, 2, 2, 'lot of fights and I was very hyper', '2019-07-12 17:45:46'),
(15, 1, 3, 'Maybe another', '2019-07-12 17:45:46'),
(16, 2, 6, 'back then. I have ADHD so back then', '2019-07-12 17:45:46'),
(17, 2, 5, 'when I was little; I was very hyper', '2019-07-12 17:45:46'),
(18, 0, NULL, 'What was it', '2019-07-12 17:45:46'),
(19, 1, 18, 'and would not stop moving around the place. I', '2019-07-12 17:45:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
