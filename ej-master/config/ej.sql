-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 20 2020 г., 16:22
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ej`
--
CREATE DATABASE IF NOT EXISTS `ej` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ej`;

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(5) NOT NULL,
  `letter` varchar(5) DEFAULT NULL,
  `leader` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `classes`
--

INSERT INTO `classes` (`id`, `number`, `letter`, `leader`) VALUES
(1, 1, 'A', 'Поплавський М.М.'),
(2, 2, NULL, 'Підер лідер'),
(3, 3, 'B', 'Мачка');

-- --------------------------------------------------------

--
-- Структура таблицы `disciplines`
--

DROP TABLE IF EXISTS `disciplines`;
CREATE TABLE IF NOT EXISTS `disciplines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `leader` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `disciplines`
--

INSERT INTO `disciplines` (`id`, `class_id`, `title`, `leader`) VALUES
(1, 1, 'Читанка', 'Мачка'),
(2, 2, 'Я і Україна', 'Пес');

-- --------------------------------------------------------

--
-- Структура таблицы `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `pupil_id` int(11) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `grade` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `grades`
--

INSERT INTO `grades` (`id`, `class_id`, `pupil_id`, `discipline_id`, `add_date`, `grade`) VALUES
(7, 1, 5, 1, '2020-04-20', 'НБ'),
(5, 1, 2, 1, '2020-04-20', '5');

-- --------------------------------------------------------

--
-- Структура таблицы `pupils`
--

DROP TABLE IF EXISTS `pupils`;
CREATE TABLE IF NOT EXISTS `pupils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `pupil` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pupils`
--

INSERT INTO `pupils` (`id`, `class_id`, `pupil`) VALUES
(5, 1, 'Сукош'),
(2, 1, 'Дочь Мачки');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`) VALUES
(3, 'DareDevil539', 'vanyaolenyshak@gmail.com', '$2y$10$roFvEZzGmwboka0fMwdTv.ZGmvxXfIIdqy0rS9ypGtgvOkG33DLHi', 'admin'),
(4, 'shipovnik', 'cvcvb@gmail.com', '$2y$10$JCZ8x7CljeN.1utzlJO/q.FwstLMv/29rkkX3tGVq8edYDN1A111q', 'teacher');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
