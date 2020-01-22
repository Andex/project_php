-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 22 2020 г., 18:11
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `registration`
--

-- --------------------------------------------------------

--
-- Структура таблицы `hashes`
--

CREATE TABLE `hashes` (
  `id` int(10) NOT NULL,
  `pass_hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='information about password''s hash';

--
-- Дамп данных таблицы `hashes`
--

INSERT INTO `hashes` (`id`, `pass_hash`) VALUES
(5, '4759e3069d83a882086b75c2230c8ddd'),
(4, '5cf4390e39a3edb3228c221c956cf3b2'),
(3, 'dbfg45y_)9;ijhm'),
(6, 'dgrwts'),
(2, 'esbd56yh'),
(1, 'sdfv43465tgb');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `hashes`
--
ALTER TABLE `hashes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`pass_hash`),
  ADD KEY `pass_hash` (`pass_hash`),
  ADD KEY `pass_hash_2` (`pass_hash`),
  ADD KEY `pass_hash_3` (`pass_hash`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
