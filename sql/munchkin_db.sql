-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 14 2018 г., 00:56
-- Версия сервера: 5.5.50
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE IF NOT EXISTS `mnc_cards` (
  `id` int(11) NOT NULL,
  `card_name` int(11) NOT NULL,
  `card_text` int(11) NOT NULL,
  `card_art` int(11) NOT NULL,
  `card_value` int(11) NOT NULL,
  `card_target` int(11) NOT NULL,
  `card_type` int(11) NOT NULL,
  `card_action` int(11) NOT NULL,
  `card_price` int(11) NOT NULL,
  `card_treasures` int(11) NOT NULL,
  `card_levels` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_decks`
--

CREATE TABLE IF NOT EXISTS `mnc_decks` (
  `id` int(11) NOT NULL,
  `deck_author` int(11) NOT NULL,
  `deck_image` int(11) NOT NULL,
  `deck_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_deck_card`
--

CREATE TABLE IF NOT EXISTS `mnc_deck_card` (
  `id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_games`
--

CREATE TABLE IF NOT EXISTS `mnc_games` (
  `id` int(11) NOT NULL,
  `game_rules` text NOT NULL,
  `game_name` varchar(255) NOT NULL DEFAULT '',
  `game_password` varchar(70) NOT NULL DEFAULT '',
  `game_type` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_game_deck`
--

CREATE TABLE IF NOT EXISTS `mnc_game_deck` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `deck_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_logs`
--

CREATE TABLE IF NOT EXISTS `mnc_logs` (
  `id` int(11) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_value` longblob NOT NULL,
  `log_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mnc_users`
--

CREATE TABLE IF NOT EXISTS `mnc_users` (
  `id` int(11) NOT NULL,
  `user_login` varchar(50) NOT NULL DEFAULT '',
  `user_password` varchar(70) NOT NULL DEFAULT '',
  `user_avatar` varchar(75) NOT NULL DEFAULT '',
  `user_regDate` date NOT NULL DEFAULT '0000-00-00',
  `user_role` int(1) NOT NULL DEFAULT '1',
  `user_birthday` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

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
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `mnc_decks`
--
ALTER TABLE `mnc_decks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
