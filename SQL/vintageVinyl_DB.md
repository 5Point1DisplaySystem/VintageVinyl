-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 01:25 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vintagevinyl`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `albName` varchar(64) DEFAULT NULL,
  `albDescription` blob DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `fk_genre_id` int(11) DEFAULT NULL,
  `fk_artist_id` int(11) DEFAULT NULL,
  `fk_record_label_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `albName`, `albDescription`, `release_date`, `fk_genre_id`, `fk_artist_id`, `fk_record_label_id`, `is_active`) VALUES
(121, 'Ruins', 0x4465736372697074696f6e, NULL, 2, 135, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `artName` varchar(132) NOT NULL,
  `artDescription` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `artName`, `artDescription`) VALUES
(135, 'First Aid kit', '');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `genreName` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `genreName`) VALUES
(1, 'Pop Music'),
(2, 'Indie'),
(3, 'Rock Music'),
(5, 'Folk Music'),
(7, 'Folk Music'),
(8, 'Blues'),
(9, 'Soul Music'),
(10, 'Funk'),
(11, 'Country Music'),
(12, 'Rhythm & Blues'),
(13, 'Electronic Music'),
(14, 'Dance Music'),
(15, 'Punk Rock'),
(16, 'House Music');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime DEFAULT NULL,
  `type` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_album_id` int(11) DEFAULT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci DEFAULT '1',
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `file_name`, `uploaded_on`, `type`, `fk_album_id`, `status`, `fk_user_id`) VALUES
(152, 'firstaid.jpg', '2023-01-25 23:11:26', NULL, 121, '1', 21);

-- --------------------------------------------------------

--
-- Table structure for table `record_label`
--

CREATE TABLE `record_label` (
  `id` int(11) NOT NULL,
  `rlName` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `record_label`
--

INSERT INTO `record_label` (`id`, `rlName`) VALUES
(3, 'Warner Music Group'),
(4, 'EMI'),
(5, 'Sony Music'),
(6, 'BMG'),
(7, 'Universal Music Group'),
(8, 'PolyGram'),
(9, 'Released Independently');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `password` varchar(132) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  `email` varchar(132) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `pw` varchar(132) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `password`, `is_admin`, `email`, `is_active`, `username`, `pw`) VALUES
(21, '$2y$10$BqXI41WFMqPsvf71ruxOhex5MsHM4dvMw60oeplgmT8Vv/FO/BNzy', 0, 'test@email.com', 1, 'testuser', NULL),
(22, '$2y$10$LzYliwbQsZOAbPWo1SzrUeRO/E2o41U4M.vxyIgw0ZVpARnVIwp8m', 1, 'test@email.com', 1, 'testadmin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_genre_id` (`fk_genre_id`),
  ADD KEY `fk_record_label_id` (`fk_record_label_id`),
  ADD KEY `fk_artist_id` (`fk_artist_id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_album_id` (`fk_album_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `record_label`
--
ALTER TABLE `record_label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `record_label`
--
ALTER TABLE `record_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`fk_genre_id`) REFERENCES `genre` (`id`),
  ADD CONSTRAINT `album_ibfk_2` FOREIGN KEY (`fk_record_label_id`) REFERENCES `record_label` (`id`),
  ADD CONSTRAINT `album_ibfk_3` FOREIGN KEY (`fk_artist_id`) REFERENCES `artist` (`id`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_album_id` FOREIGN KEY (`fk_album_id`) REFERENCES `album` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
