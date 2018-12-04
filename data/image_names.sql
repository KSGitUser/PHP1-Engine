-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 04 2018 г., 11:52
-- Версия сервера: 5.7.23-log
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
-- База данных: `images_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `image_names`
--

CREATE TABLE `image_names` (
  `img_id` int(11) NOT NULL,
  `small_file_name` text NOT NULL,
  `big_file_name` text NOT NULL,
  `views_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image_names`
--

INSERT INTO `image_names` (`img_id`, `small_file_name`, `big_file_name`, `views_number`) VALUES
(2, '162398-awesome-nature.jpg', '162398-awesome-nature.jpg', 9),
(3, '23_9128_oboi_venecija_960x800.jpg', '23_9128_oboi_venecija_960x800.jpg', 19),
(4, 'Monument-to-Nicholas-I-in-Saint-Petersburg-960x800.jpg', 'Monument-to-Nicholas-I-in-Saint-Petersburg-960x800.jpg', 12),
(5, 'Rome-Colosseum-Antient-960x800.jpg', 'Rome-Colosseum-Antient-960x800.jpg', 0),
(6, 'cathedral_templait_france.png', 'cathedral_templait_france.png', 0),
(7, 'download_img.png', 'download_img.png', 0),
(8, 'download_img_2.png', 'download_img_2.png', 2),
(9, 'download_img_3.png', 'download_img_3.png', 0),
(10, 'nastol.com.ua-120619.jpg', 'nastol.com.ua-120619.jpg', 0),
(11, 'nastol.com.ua-267026.jpg', 'nastol.com.ua-267026.jpg', 0),
(12, 'vibrance_23_4284_oboi_dom_960x800.jpg', 'vibrance_23_4284_oboi_dom_960x800.jpg', 0),
(13, 'westminster_abbey_img.png', 'westminster_abbey_img.png', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `image_names`
--
ALTER TABLE `image_names`
  ADD PRIMARY KEY (`img_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `image_names`
--
ALTER TABLE `image_names`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
