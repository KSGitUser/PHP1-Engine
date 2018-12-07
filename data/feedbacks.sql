-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 07 2018 г., 14:24
-- Версия сервера: 8.0.12
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `urok6`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedbacks`
--

CREATE TABLE `feedbacks` (
  `f_id` int(11) NOT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `f_email` varchar(255) DEFAULT NULL,
  `f_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedbacks`
--

INSERT INTO `feedbacks` (`f_id`, `f_name`, `f_email`, `f_text`) VALUES
(12, 'Ivan', 'ivan@ivan.ru', '  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores perspiciatis'),
(15, 'alex', 'alex@alex.ru', '  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores perspiciatis'),
(16, 'Olga', 'olga@olga.ru', '  Lorem   asdasdasdad'),
(17, 'Dasha', 'dasha@dasha.ru', '  Lorem ipsum dolor sit amet consectetur, adipisicing elit'),
(21, 'Man', 'man@man.ru', '  Lorem ipsum     sdfsdfsdfsdf           '),
(24, 'Lena', 'lena@lena.ru', 'Lorem ipsum');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`f_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
