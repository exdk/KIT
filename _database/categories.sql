-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: mysql-174554.srv.hoster.ru
-- Время создания: Апр 18 2022 г., 10:27
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
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `number` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=963 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent_id`, `number`) VALUES
(1, 'Кошки', 0, 1),
(2, 'Трехцветные', 1, 1),
(3, 'Белые', 1, 2),
(4, 'Рыжие', 1, 3),
(5, 'Рыже-серые', 4, 1),
(6, 'Рыже-красные', 4, 2),
(7, 'Синие', 1, 4),
(8, 'Собаки', 0, 2),
(9, 'Большие', 8, 1),
(10, 'Средние', 8, 2),
(11, 'Маленькие', 8, 3),
(12, 'Ручные', 8, 4),
(13, 'Черепахи', 0, 3),
(14, 'Сухопутные', 13, 1),
(15, 'Водные', 13, 2),
(16, 'Быстрые', 13, 3),
(17, 'Кусачие', 13, 4),
(18, 'Серо-буро-малиновые', 2, 1),
(19, 'Малиново-черно-белые', 2, 2),
(20, 'Совсем белые', 3, 1),
(21, 'Идеально-белые', 20, 1),
(22, 'Слегка белые', 20, 2),
(23, 'Буро-малиново-серые', 18, 1),
(24, 'Прям большие', 9, 1),
(25, 'Гигантские', 9, 2),
(26, 'Больше комнаты', 9, 3),
(27, 'Больше двухкомнатной', 26, 1),
(28, 'Больше трехкомнатной', 27, 1),
(29, 'Степан', 14, 1),
(30, 'Машка', 14, 2),
(31, 'Матвей', 14, 3),
(32, 'Речные', 15, 1),
(33, 'Морские', 15, 2),
(34, 'Океанские', 15, 3),
(35, 'Мелкоречные', 32, 1),
(36, 'Среднеречные', 32, 2),
(37, 'Тихоокеанские', 34, 1),
(38, 'Индийскоокеанские', 34, 2),
(39, 'Северноледовитоокеанские (бедолаги)', 34, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
