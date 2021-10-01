-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 09 2021 г., 14:47
-- Версия сервера: 10.4.19-MariaDB
-- Версия PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `contact_book`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `phone_number`, `email`) VALUES
(5, 'Семён', 'Бидон', '+375 25 247-15-87', NULL),
(6, 'Пал', 'Палыч', '+375 29 245-29-08', 'chtosdengami@mail.ru'),
(7, 'Contact', 'Contactov', '375 29 111222333', NULL),
(8, 'Толя', 'Васильков', '375259385678', 'tolikebolik@mail.ru'),
(9, 'Валера', 'Конышев', '+375 25 44356789', NULL),
(10, 'Лёха', 'Сивый', '+375 33 777 77 77', 'pacan@mail.ru'),
(11, 'Anna', 'Karenina', '+375 44 666 43 78', 'poezd@mail.ru'),
(12, 'Алексей', 'Геннадьевич', '+375663356777', 'nachalnik@gmail.com'),
(13, 'Grisha', 'Grandmasterbit', '+375 45 66544567', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `temp_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `remember_token`, `firstname`, `lastname`, `temp_token`) VALUES
(16, 'Alexander', '$2y$10$4.inOf8fG2RoKWsAnsEfZ.D9Nk9s83ProxIHUCXVi8amvoq7vgO5W', '$2y$10$GZmKIsLR3Cl336p4eTEBbO39mKp7OqBwgKfOS49HvcNHMUfoeya4q', 'Alexander', 'Marunenko', '$2y$10$HIS3ts1Aa5yPiUV9351.neO.c3yswZgLT1x0TTowUrHFY4VqqPGRy'),
(17, 'Dimon', '$2y$10$GsxoTb/3WziCBXZdIxttxuAncJpksW/lrVmbVC5qxu9MxUjkTAUme', '$2y$10$W5GWaA6rOnj8vJ44JLSYU.HYCx1ifQ7PnPB.JsaRq8s2W.hw4RXg.', 'Dimon', 'Dimonov', '$2y$10$X4vK4SFHeyAWyDemo0GRM.jr7J5/.qO3wKOROEXsisyZsQEKyLGeC'),
(18, 'Elena', '$2y$10$BF47JwLHUCMP8BNunDJ9xezVdlZvD2qV3mA291CSB0e2jZx.xneOe', '$2y$10$qACWzhBoLdyjd9so/CNgweQHk.EleEmXy8WWjkGVSplGkk1dBLHO.', 'Elena', 'Babushkina', '$2y$10$PRkZcvorTHwm5pZ5ufAUr.l.JH4OXFO3G6a.jUQ4nUzhtWN4woT66'),
(19, 'Goshan112', '$2y$10$PPeaShhv.l.HF1txBI5RyOR.YSLPzHMfHjFG5MwzUrQhqMxJOLGw6', '$2y$10$95f0byTq9XxrLkPE1VSQ.eDV7csH.ANf7ucKNmttiSFRgX68N6dvK', 'Гоша', 'Юбилейынй', '$2y$10$cWMfCwlf8pLTyI6VrX.BFe.lhe9IJKN022PYY7j2YuMEBuWpIah.K');

-- --------------------------------------------------------

--
-- Структура таблицы `users_contacts`
--

CREATE TABLE `users_contacts` (
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users_contacts`
--

INSERT INTO `users_contacts` (`user_id`, `contact_id`) VALUES
(18, 7),
(17, 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
