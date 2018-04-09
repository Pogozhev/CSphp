-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 09 2018 г., 12:29
-- Версия сервера: 10.1.28-MariaDB
-- Версия PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cropsafe`
--

-- --------------------------------------------------------

--
-- Структура таблицы `test_field`
--

CREATE TABLE `test_field` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gisx` float NOT NULL,
  `gisy` float NOT NULL,
  `square` float NOT NULL,
  `crop` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test_field`
--

INSERT INTO `test_field` (`id`, `name`, `gisx`, `gisy`, `square`, `crop`) VALUES
(1, 'yellow_field', 56.4479, 84.8603, 0, ''),
(2, 'yellow_field', 56.4479, 84.8759, 0, ''),
(3, 'yellow_field', 56.4553, 84.8675, 0, ''),
(4, 'black_field', 56.4504, 84.8866, 0, ''),
(5, 'black_field', 56.4449, 84.8804, 0, ''),
(6, 'black_field', 56.443, 84.8836, 0, ''),
(7, 'black_field', 56.4444, 84.8853, 0, ''),
(8, 'black_field', 56.4398, 84.8895, 0, ''),
(9, 'black_field', 56.4398, 84.8871, 0, ''),
(10, 'black_field', 56.4467, 84.8898, 0, ''),
(11, 'blue_field', 56.4353, 84.855, 0, ''),
(12, 'blue_field', 56.4383, 84.8447, 0, ''),
(13, 'blue_field', 56.4388, 84.8502, 0, ''),
(14, 'blue_field', 56.4407, 84.8455, 0, ''),
(15, 'blue_field', 56.4353, 84.8502, 0, ''),
(16, 'blue_field', 56.441, 84.8598, 0, ''),
(17, 'blue_field', 56.4436, 84.856, 0, ''),
(18, 'blue_field', 56.4421, 84.8519, 0, ''),
(19, 'blue_field', 56.4448, 84.8467, 0, ''),
(20, 'blue_field', 56.4435, 84.8431, 0, ''),
(32, 'red_field', 56.4319, 84.8819, 0, 'Potato'),
(33, 'red_field', 56.4369, 84.8819, 0, 'Potato'),
(34, 'red_field', 56.4319, 84.8654, 0, 'Potato'),
(35, 'red_field', 56.4392, 84.869, 0, 'Potato');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `test_field`
--
ALTER TABLE `test_field`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `test_field`
--
ALTER TABLE `test_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
