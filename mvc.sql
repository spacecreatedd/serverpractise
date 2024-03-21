-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 21 2024 г., 04:34
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronym` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `job` int(11) NOT NULL,
  `specialization` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `surname`, `patronym`, `date_of_birth`, `job`, `specialization`) VALUES
(357, 'tessssssssssssss', 'abo', 'boba', '2024-02-20', 1, 1),
(358, 'Alim', 'Aliim', 'aliiiim', '2024-03-14', 1, 1),
(359, 'Num', 'kim', 'qweasd', '2024-03-05', 2, 2),
(360, 'dima', 'danilov', 'danilovv', '2024-03-01', 1, 2),
(363, '123', '123', '123', '2024-01-01', 2, 1),
(368, 'xsfdsaf', 'fafafda', 'sfdgdsgfs', '2024-03-29', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `job`) VALUES
(1, 'уролог'),
(2, 'стоматолог');

-- --------------------------------------------------------

--
-- Структура таблицы `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronym` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `patient`
--

INSERT INTO `patient` (`id`, `name`, `surname`, `patronym`, `date_of_birth`, `image`) VALUES
(115, 'zhenya', 'kim', 'qwe', '2024-03-22', 'Array'),
(116, 'дима', 'данилов', 'чушпанчиков', '2024-03-28', 'Array'),
(118, 'asas', 'ccdsac', 'cdvdavd', '2024-03-23', 'Array');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`) VALUES
(1, 'тестовое название', 'ааааааааа'),
(2, 'лалалала', 'абабаба'),
(3, 'еще один тестовый заголовок', 'еще один тестовый текст');

-- --------------------------------------------------------

--
-- Структура таблицы `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `record`
--

INSERT INTO `record` (`id`, `patient_id`, `doctor_id`, `date`) VALUES
(15, 115, 357, '2024-03-30'),
(16, 116, 360, '2024-03-29'),
(17, 116, 363, '2024-01-01'),
(18, 116, 363, '2024-01-01'),
(19, 115, 359, '2024-03-14'),
(24, 115, 360, '2024-03-22');

-- --------------------------------------------------------

--
-- Структура таблицы `specs`
--

CREATE TABLE `specs` (
  `id` int(11) NOT NULL,
  `spec` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `specs`
--

INSERT INTO `specs` (`id`, `spec`) VALUES
(1, 'пластика'),
(2, 'ринопластика');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `role`) VALUES
(33, 'test', 'qwe', '76d80224611fc919a5d54f0ff9fba446', 'register'),
(34, 'kim', 'kim', 'fb1eaf2bd9f2a7013602be235c305e7a', 'admin'),
(35, 'ye', 'yeeei', 'a7a01329fe60bde7941d8183d258c4bd', 'register'),
(37, 'qwe', 'asdf', '912ec803b2ce49e4a541068d495ab570', 'register'),
(38, 'дима', 'данилов', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'register'),
(39, 'spc', 'created', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'register'),
(42, 'yeei', 'qweasd', '3fd47724ed7e96abf4c0d21d6e2a3905', 'register'),
(43, 'grg', 'nfs', '2521ef5d58fc027d3121662b7d8f9ac2', 'register'),
(44, 'mnvmvnmnvmv', 'mvnmnvmnv', '03e1cc6d54933bb47dd451bd24255a35', 'register'),
(45, 'qqqq', 'aaaaa', '2d02e669731cbade6a64b58d602cf2a4', 'register');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job` (`job`),
  ADD KEY `specialization` (`specialization`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pacient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Индексы таблицы `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT для таблицы `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `specs`
--
ALTER TABLE `specs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`job`) REFERENCES `jobs` (`id`),
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`specialization`) REFERENCES `specs` (`id`);

--
-- Ограничения внешнего ключа таблицы `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
