-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: mysql-174554.srv.hoster.ru
-- Время создания: Апр 17 2022 г., 19:16
-- Версия сервера: 5.6.40
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `srv174554_b63cb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `forKIT`
--

CREATE TABLE `forKIT` (
  `id` int(11) NOT NULL,
  `parent_object` text NOT NULL,
  `child_object` text NOT NULL,
  `date` char(20) NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forKIT`
--

INSERT INTO `forKIT` (`id`, `parent_object`, `child_object`, `date`, `ip`) VALUES
(77, 'первый объект', 'второй', '1649619045', '194.15.116.199'),
(82, 'Камушки', 'Москва', '1649619704', '194.15.116.199');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `forKIT`
--
ALTER TABLE `forKIT`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `forKIT`
--
ALTER TABLE `forKIT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
