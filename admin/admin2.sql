-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2018 at 05:24 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `fname` tinytext NOT NULL,
  `email` varchar(64) NOT NULL,
  `passw` varchar(32) NOT NULL,
  `org_id` tinyint(3) UNSIGNED NOT NULL,
  `city_id` tinyint(3) UNSIGNED NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `auth_key` varchar(32) CHARACTER SET ascii NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `email`, `passw`, `org_id`, `city_id`, `updated`, `auth_key`) VALUES
(1, 'Ssss Kkkk', 'mask@inbox.ru', '3d38f243bec37fa43a0d51dcd60c18c8', 1, 0, '2018-05-19 15:07:44', '8ffd318322f95d71b52ebe146a13e843');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` tinytext NOT NULL,
  `descr` varchar(8191) DEFAULT NULL,
  `org_id` tinyint(3) UNSIGNED NOT NULL,
  `lang_id` tinyint(3) UNSIGNED NOT NULL,
  `dt` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `city_id` tinyint(3) UNSIGNED NOT NULL,
  `price` smallint(5) UNSIGNED NOT NULL,
  `count_min` smallint(5) UNSIGNED NOT NULL,
  `count_max` smallint(5) UNSIGNED NOT NULL,
  `count_free` smallint(5) UNSIGNED NOT NULL,
  `count_paid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `link` tinytext,
  `upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hash_idx` varchar(32) DEFAULT NULL,
  `admin_id` tinyint(3) UNSIGNED NOT NULL,
  `img_ext` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `descr`, `org_id`, `lang_id`, `dt`, `status`, `city_id`, `price`, `count_min`, `count_max`, `count_free`, `count_paid`, `link`, `upd`, `hash_idx`, `admin_id`, `img_ext`) VALUES
(1, 'арпавпрвапрваЭ"', 'првапрвапрвапрвапрвапр', 1, 2, '2018-05-23 18:22:18', 1, 1, 456, 12, 13, 3, 123, '', '2018-05-17 13:48:24', 'c20ad4d76fe97759aa27a0c99bff6710', 0, NULL),
(5, 'sdgsdfgsd fgsdfg', 'sdfgsdgsdfgsdfg', 1, 3, '2018-05-16 23:55:00', 0, 2, 123, 21, 123, 1, 0, 'gsgssdfgsfgsdf', '2018-05-18 17:57:57', '37693cfc748049e45d87b8c7d8b9aacd', 1, NULL),
(6, 'sdgsdfgsd fgsdfg', '<div class="input-group mb-3">\n  <div class="input-group-prepend">\n    <span class="input-group-text">Upload</span>\n  </div>\n  <div class="custom-file">\n    <input type="file" class="custom-file-input" id="inputGroupFile01">\n    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>\n  </div>\n</div>\n\n<div class="input-group mb-3">\n  <div class="custom-file">\n    <input type="file" class="custom-file-input" id="inputGroupFile02">\n    <label class="custom-file-label" for="inputGroupFile02">Choose file</label>\n  </div>\n  <div class="input-group-append">\n    <span class="input-group-text" id="">Upload</span>\n  </div>\n</div>\n\n<div class="input-group mb-3">\n  <div class="input-group-prepend">\n    <button class="btn btn-outline-secondary" type="button">Button</button>\n  </div>\n  <div class="custom-file">\n    <input type="file" class="custom-file-input" id="inputGroupFile03">\n    <label class="custom-file-label" for="inputGroupFile03">Choose file</label>\n  </div>\n</div>\n\n<div class="input-group">\n  <div class="custom-file">\n    <input type="file" class="custom-file-input" id="inputGroupFile04">\n    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>\n  </div>\n  <div class="input-group-append">\n    <button class="btn btn-outline-secondary" type="button">Button</button>\n  </div>\n</div>', 1, 3, '2018-05-16 23:55:00', -1, 4, 123, 21, 123, 1, 0, '', '2018-05-18 16:22:24', '17e62166fc8586dfa4d1bc0e1742c08b', 1, NULL),
(13, 'vvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'cccccccccccccccccccccccc', 1, 2, '2018-06-01 17:55:00', 1, 11, 17, 5, 20, 3, 0, '', '2018-05-18 17:01:48', '7f6ffaa6bb0b408017b62254211691b5', 1, 'jpg'),
(14, 'vvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'ccccccccccccccccccccccccc', 1, 2, '2018-06-01 17:55:00', -1, 11, 17, 5, 20, 3, 0, '', '2018-05-17 13:48:19', '7f6ffaa6bb0b408017b62254211691b5', 1, NULL),
(15, 'Квиз по Стартреку', 'Самый интересный квиз', 1, 5, '2018-06-01 19:40:00', -1, 8, 1000, 50, 100, 2, 0, 'http://skrasnov.com', '2018-05-17 13:47:31', '3ef815416f775098fe977004015c6193', 1, NULL),
(16, 'аывпвап1!"№;%', 'вапр ва.юбь.бью.ь', 1, 5, '2018-05-27 01:47:00', -1, 1, 123, 534, 3456, 234, 0, '', '2018-05-17 14:06:31', '9bf31c7ff062936a96d3c8bd1f8f2ff3', 1, NULL),
(17, 'hghfhdfhdfghdfh', 'dsfgsdfgsdfgsdg', 1, 2, '2018-05-17 22:02:00', -1, 4, 234, 11, 234, 11, 0, '', '2018-05-18 16:56:48', 'a1d0c6e83f027327d8461063f4ac58a6', 1, 'jpeg'),
(20, 'Basic examples', '<select class="selectpicker" multiple data-max-options="2">\r\n  <option>Mustard</option>\r\n  <option>Ketchup</option>\r\n  <option>Relish</option>\r\n</select>\r\n\r\n<select class="selectpicker" multiple>\r\n  <optgroup label="Condiments" data-max-options="2">\r\n    <option>Mustard</option>\r\n    <option>Ketchup</option>\r\n    <option>Relish</option>\r\n  </optgroup>\r\n  <optgroup label="Breads" data-max-options="2">\r\n    <option>Plain</option>\r\n    <option>Steamed</option>\r\n    <option>Toasted</option>\r\n  </optgroup>\r\n</select>\r\n', 1, 6, '2018-05-24 18:49:00', -1, 1, 1000, 11, 17, 5, 0, '', '2018-05-18 16:56:35', 'c74d97b01eae257e44aa9d5bade97baf', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `descr` tinytext NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tg_admins`
--

CREATE TABLE `tg_admins` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `uname` varchar(32) NOT NULL,
  `org_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `city_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tg_admins`
--

INSERT INTO `tg_admins` (`id`, `uname`, `org_id`, `city_id`) VALUES
(162, 'qqq', 1, 4),
(163, 'www', 1, 4),
(164, 'eee', 1, 4),
(165, 'rrr', 1, 10),
(166, 'ttt', 1, 10),
(167, 'yyy', 1, 10),
(168, 'uuu', 1, 6),
(169, 'iii', 1, 6),
(170, 'ooo', 1, 6),
(171, 'sss', 1, 11),
(172, 'ddd', 1, 11),
(173, 'fff', 1, 11),
(174, 'ggg', 1, 1),
(175, 'hhh', 1, 1),
(176, 'jjj', 1, 1),
(177, 'kkk', 1, 9),
(178, 'lll', 1, 9),
(179, 'zzz', 1, 9),
(180, 'xxx', 1, 5),
(181, 'vvv', 1, 5),
(182, 'bbb', 1, 8),
(183, 'nnn', 1, 8),
(184, 'mmm', 1, 8),
(185, '111', 1, 2),
(186, '222', 1, 2),
(187, '333', 1, 2),
(188, '444', 1, 7),
(189, '555', 1, 7),
(190, '666', 1, 7),
(191, '777', 1, 3),
(192, '888', 1, 3),
(193, '999', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `auth_key` (`auth_key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `lang_id` (`lang_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `hash_idx` (`hash_idx`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `tg_admins`
--
ALTER TABLE `tg_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tg_admins`
--
ALTER TABLE `tg_admins`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
