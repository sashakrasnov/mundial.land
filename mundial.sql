-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 10:17 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mundial`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` tinytext,
  `email` tinytext CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `passw` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bday` date DEFAULT NULL,
  `dt_in` date DEFAULT NULL,
  `dt_out` date DEFAULT NULL,
  `phone` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `sms` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `scn` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `fb_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `vk_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `confirmed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `auth_key` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ts` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `email`, `passw`, `bday`, `dt_in`, `dt_out`, `phone`, `sms`, `scn`, `fb_id`, `vk_id`, `confirmed`, `auth_key`, `updated`, `ts`) VALUES
(74, 'Иванов Иван', 'mask@inbox.ru', '2af9b1ba42dc5eb01743e6b3759b6e4b', '2000-12-01', '2018-12-03', '2017-11-11', '123456', 1, 0, 0, 0, 0, 'e0e86e63cf1495cb9609518a80976a40', '2018-05-02 12:21:30', '2018-04-26 22:30:53'),
(75, 'sasfasdf', 'info@sashakrasnov.com', 'null', NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 'e51166c2c91c2571dd8ec9564352c675', '2018-04-30 07:21:03', '2018-04-26 22:35:34'),
(76, 'shshfdg', 'admin@admin.com', '2af9b1ba42dc5eb01743e6b3759b6e4b', NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 'fab13ec3a2c5bca4182eed689022ddf5', '2018-04-27 11:41:13', '2018-04-26 22:39:18'),
(78, 'Mary Albefjfcebefh Thurnson', 'mggtqpkycd_1524217955@tfbnw.net', 'd21144d143a386d1031e6a05d2f94023', '2012-01-02', '2013-01-13', '2017-12-12', NULL, 1, 1, 101297964067082, 0, 0, '5d73af954533558d1feb34268c4e39e3', '2018-04-30 21:21:20', '2018-04-30 20:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `u_param` varchar(12) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `p_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`id`, `user_id`, `u_param`, `p_id`) VALUES
(1085, 78, 'u_countries', 30),
(1086, 78, 'u_langs', 44),
(1087, 78, 'u_champs', 63),
(1120, 74, 'u_champs', 3),
(1121, 74, 'u_countries', 4),
(1122, 74, 'u_countries', 21),
(1123, 74, 'u_langs', 3),
(1124, 74, 'u_matches', 1),
(1125, 74, 'u_matches', 2),
(1126, 74, 'u_matches', 4),
(1127, 74, 'u_matches', 5),
(1128, 74, 'u_matches', 13),
(1129, 74, 'u_matches', 15),
(1130, 74, 'u_matches', 16),
(1131, 74, 'u_matches', 18),
(1132, 74, 'u_matches', 23),
(1133, 74, 'u_matches', 25),
(1134, 74, 'u_matches', 26),
(1135, 74, 'u_matches', 27),
(1136, 74, 'u_matches', 32),
(1137, 74, 'u_matches', 33),
(1138, 74, 'u_matches', 34),
(1139, 74, 'u_matches', 37),
(1140, 74, 'u_matches', 40),
(1141, 74, 'u_matches', 43),
(1142, 74, 'u_matches', 44),
(1143, 74, 'u_matches', 46),
(1144, 74, 'u_matches', 59),
(1145, 74, 'u_matches', 60),
(1146, 74, 'u_matches', 61),
(1147, 74, 'u_matches', 62),
(1148, 74, 'u_matches', 63);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fb_id` (`fb_id`),
  ADD KEY `vk_id` (`vk_id`);
ALTER TABLE `users` ADD FULLTEXT KEY `email` (`email`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`);
ALTER TABLE `users_data` ADD FULLTEXT KEY `param` (`u_param`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1149;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
