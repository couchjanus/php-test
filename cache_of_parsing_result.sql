-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Сер 14 2020 р., 13:52
-- Версія сервера: 5.5.64-MariaDB
-- Версія PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `webstd`
--

-- --------------------------------------------------------

--
-- Структура таблиці `cache_of_parsing_result`
--

CREATE TABLE IF NOT EXISTS `cache_of_parsing_result` (
  `id` int(9) NOT NULL,
  `cdate` int(12) NOT NULL,
  `mdate` int(12) NOT NULL,
  `user_id` int(6) NOT NULL,
  `feed_products__id` int(9) NOT NULL,
  `number_of_offers` int(6) NOT NULL,
  `number_of_ads_without_status` int(6) NOT NULL,
  `number_of_competitors` int(9) NOT NULL,
  `min_price_of_competitors` int(9) NOT NULL,
  `avg_price_of_competitors` int(9) NOT NULL,
  `difference_relative_to_average_price` int(9) NOT NULL,
  `difference_relative_to_minimum_price` int(9) NOT NULL,
  `difference_relative_to_maximum_price` int(9) DEFAULT NULL,
  `price_position_in_the_price_ranking` int(9) NOT NULL,
  `number_of_unrecognized_ads` int(9) NOT NULL,
  `is_last_cache` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=527914 DEFAULT CHARSET=utf8;
-- Помилка читання даних: (#1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'WHERE (`cache_of_parsing_result`.`id` = 1) OR (`cache_of_parsing_result`.`id` = ' at line 1)

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `cache_of_parsing_result`
--
ALTER TABLE `cache_of_parsing_result`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `cdate` (`cdate`),
  ADD KEY `user_id` (`user_id`,`feed_products__id`,`cdate`),
  ADD KEY `user_id_2` (`user_id`,`feed_products__id`,`is_last_cache`),
  ADD KEY `is_last_cache` (`is_last_cache`,`user_id`,`feed_products__id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `cache_of_parsing_result`
--
ALTER TABLE `cache_of_parsing_result`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=527914;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
