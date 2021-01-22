-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 22 2021 г., 05:34
-- Версия сервера: 5.7.31-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `magazines`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`author_id`, `surname`, `name`, `patronymic`) VALUES
(1, 'Мухатаева', 'Надежда', 'Сергеевна'),
(2, 'Блёсткин', 'Николай', 'Юрьевич'),
(3, 'Кожухов', 'Антон', 'Андреевич'),
(6, 'Не Написал', 'Я', 'Ничего');

-- --------------------------------------------------------

--
-- Структура таблицы `author_magazine`
--

CREATE TABLE `author_magazine` (
  `author_id` int(11) NOT NULL,
  `magazine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author_magazine`
--

INSERT INTO `author_magazine` (`author_id`, `magazine_id`) VALUES
(1, 3),
(1, 25),
(2, 1),
(2, 3),
(3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `magazines`
--

CREATE TABLE `magazines` (
  `magazine_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `issue_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `magazines`
--

INSERT INTO `magazines` (`magazine_id`, `name`, `short_description`, `image`, `issue_date`) VALUES
(1, 'Первый журнал', 'Это короткое описание первого журнала в нашем списке', 'images/40M1EyRqDw/e024ImtFIA17tGadez3KX0KoEmflNsJa1ulP420S.jpg', '2021-01-01'),
(3, 'Второй журнал', 'Короткое описание второго журнала здесь', 'images/otfSvI4cCh/0P0uPCZqRdZjbxvkdqeZLwXo6TRBsQ1TGeQpP32r.jpg', '2020-12-12'),
(25, 'Третий журнал', 'Тратата мы везем с собой кота', 'images/FYqCzkXxd5/0MUXonloOa5JCvMSpOiffJnUGuoPHgMkMQVuGXDb.jpg', '2021-01-10');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `author_magazine`
--
ALTER TABLE `author_magazine`
  ADD PRIMARY KEY (`author_id`,`magazine_id`);

--
-- Индексы таблицы `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`magazine_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `magazines`
--
ALTER TABLE `magazines`
  MODIFY `magazine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
