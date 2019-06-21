-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 21 2019 г., 18:34
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `munchkin_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_cards`
--

CREATE TABLE `mnc_cards` (
  `id` int(11) NOT NULL,
  `card_author` int(11) DEFAULT NULL,
  `card_name` varchar(70) NOT NULL,
  `card_text` varchar(500) NOT NULL,
  `card_art` varchar(70) NOT NULL DEFAULT '',
  `card_value` int(11) NOT NULL,
  `card_target` int(11) NOT NULL,
  `card_type` int(11) NOT NULL,
  `card_action` int(11) NOT NULL,
  `card_price` int(11) NOT NULL,
  `card_treasures` varchar(10) NOT NULL DEFAULT '',
  `card_levels` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mnc_cards`
--

INSERT INTO `mnc_cards` (`id`, `card_author`, `card_name`, `card_text`, `card_art`, `card_value`, `card_target`, `card_type`, `card_action`, `card_price`, `card_treasures`, `card_levels`) VALUES
(1, 1, 'number', 'number', '', 10, 1, 1, 0, 1000, '', ''),
(2, 1, 'number', 'number', '', 10, 1, 1, 0, 1000, '', ''),
(3, 1, 'number', 'number', '', 10, 1, 1, 0, 1000, '', ''),
(4, 1, 'number', 'number', '', 10, 1, 1, 0, 1000, '', ''),
(5, 1, 'number', 'number', '', 10, 1, 1, 0, 1000, '', ''),
(6, 1, 'number', 'number', '', 10, 1, 1, 0, 1000, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_decks`
--

CREATE TABLE `mnc_decks` (
  `id` int(11) NOT NULL,
  `deck_author` int(11) NOT NULL,
  `deck_name` varchar(65) NOT NULL,
  `deck_image` varchar(70) NOT NULL DEFAULT '',
  `deck_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mnc_decks`
--

INSERT INTO `mnc_decks` (`id`, `deck_author`, `deck_name`, `deck_image`, `deck_status`) VALUES
(1, 1, 'Jopa', '0', 1),
(2, 1, 'Jopa', '0', 1),
(3, 1, 'new_deck1', '0', 1),
(4, 1, '123123', '', 2),
(5, 1, 'test_deck1', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_deck_card`
--

CREATE TABLE `mnc_deck_card` (
  `id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_games`
--

CREATE TABLE `mnc_games` (
  `id` int(11) NOT NULL,
  `game_rules` text NOT NULL,
  `game_name` varchar(255) NOT NULL DEFAULT '',
  `game_password` varchar(70) NOT NULL DEFAULT '',
  `game_type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_game_deck`
--

CREATE TABLE `mnc_game_deck` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_logs`
--

CREATE TABLE `mnc_logs` (
  `id` int(11) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `log_value` longblob NOT NULL,
  `log_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_users`
--

CREATE TABLE `mnc_users` (
  `id` int(11) NOT NULL,
  `user_login` varchar(50) NOT NULL DEFAULT '',
  `user_password` varchar(70) NOT NULL DEFAULT '',
  `user_avatar` varchar(75) NOT NULL DEFAULT 'user.png',
  `user_regDate` date NOT NULL DEFAULT '0000-00-00',
  `user_role` int(1) NOT NULL DEFAULT 1,
  `user_birthday` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mnc_users`
--

INSERT INTO `mnc_users` (`id`, `user_login`, `user_password`, `user_avatar`, `user_regDate`, `user_role`, `user_birthday`) VALUES
(1, 'test1', 'e10adc3949ba59abbe56e057f20f883e', 'efb3caf9053a425308dd165b950e3260.png', '2018-11-23', 2, '3131-03-21'),
(2, 'test2', 'e10adc3949ba59abbe56e057f20f883e', '1269a9f7638d6bd2bc183a977416a670.png', '2018-11-23', 1, '1151-03-18'),
(3, 'itachinight', '202cb962ac59075b964b07152d234b70', 'user.png', '2019-04-15', 1, '0000-00-00'),
(4, '123', '202cb962ac59075b964b07152d234b70', 'user.png', '2019-06-21', 1, '0000-00-00'),
(5, 'itachinight123', '202cb962ac59075b964b07152d234b70', 'user.png', '2019-06-21', 1, '0000-00-00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `mnc_cards`
--
ALTER TABLE `mnc_cards`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mnc_decks`
--
ALTER TABLE `mnc_decks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mnc_deck_card`
--
ALTER TABLE `mnc_deck_card`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mnc_games`
--
ALTER TABLE `mnc_games`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mnc_game_deck`
--
ALTER TABLE `mnc_game_deck`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mnc_logs`
--
ALTER TABLE `mnc_logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mnc_users`
--
ALTER TABLE `mnc_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `mnc_cards`
--
ALTER TABLE `mnc_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `mnc_decks`
--
ALTER TABLE `mnc_decks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `mnc_deck_card`
--
ALTER TABLE `mnc_deck_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mnc_games`
--
ALTER TABLE `mnc_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mnc_game_deck`
--
ALTER TABLE `mnc_game_deck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mnc_logs`
--
ALTER TABLE `mnc_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mnc_users`
--
ALTER TABLE `mnc_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
