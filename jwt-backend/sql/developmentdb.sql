-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 14, 2024 at 03:06 PM
-- Server version: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- PHP Version: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `achievement_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT 'http://localhost/images/default-trophy.png',
  `progress_limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`achievement_id`, `title`, `description`, `image_path`, `progress_limit`) VALUES
(1, 'Test Achievement', 'This is a secret test achievement. To get this achievement u need to be the developer of the assignment.', 'http://localhost/images/default-trophy.png', NULL),
(2, 'test 2', NULL, 'http://localhost/images/default-trophy.png', NULL),
(3, 'test 3', NULL, 'http://localhost/images/default-trophy.png', NULL),
(4, 'test 4', NULL, 'http://localhost/images/default-trophy.png', NULL),
(10, 'test', 'yay', 'http://localhost/images/default-trophy.png', NULL),
(11, 'test', 'test', 'http://localhost/images/default-trophy.png', NULL),
(12, 'Test', 'test', 'http://localhost/images/default-trophy.png', NULL),
(13, 'Test', 'test', 'http://localhost/images/default-trophy.png', NULL),
(14, 'Test', 'test', 'http://localhost/images/default-trophy.png', NULL),
(15, 'Test', 'testy', 'http://localhost/images/default-trophy.png', NULL),
(16, 'Test', 'test', 'http://localhost/images/default-trophy.png', NULL),
(17, 'Test', 'test', 'http://localhost/images/default-trophy.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_role`, `password`, `email`) VALUES
(1, 'admin', 'admin', '$2y$10$GCgKBHC7wfSDZINZK1scbu6H2608/shCBqbJiAG6rY72S0bmch/Fe', 'admin@admin.com'),
(2, 'user', 'user', '$2y$10$7PptTjhPwZQ3jvHDyBYoluF7arS3W/Pt/0W.ZfpP90SOmYeHNhOG6', 'user@user.com'),
(6, 'Gecko', 'user', '$2y$10$RLzM9040lCEdfI.Gn94hL.M8psWPKhvUqtu/nXNWCIfnhcpwvvRZO', 'kian.steffes@gmail.com'),
(7, 'Ahrnuld', 'user', '$2y$10$uODiGVUVqkqbjoxw/Z7CO.AtEYD/ozssaQMh3gsiYIphIlLkfRdsy', 'Mark.deHaan@Inholland.nl'),
(8, 'Eve', 'user', '$2y$10$Q2JK2DLDb8roXdsIEzpsVOwPWPZ.NsVav2e/lQbrgh2PHB/SQ243q', 'Eve@ikzoekmotivatie.nl'),
(9, 'Kian', 'user', '$2y$10$7JIaE8qLirF6QDA02RSTXODE5RwyOZPfyZmsvSEfbUXvkGrMzaQPy', 'kian.steffes@gmail.com'),
(10, 'Cat', 'user', '$2y$10$Lzcv.bbIh9grXblhyfGfdOCEZ9XqW/waVHdbufOV2oZRxDkjevYAW', 'cat@meow.com'),
(11, 'Dog', 'user', '$2y$10$QA0WzSYz9vXljnL2Xp7ZBOdpAdBhD7VzSkm/HCJ0YLkBzhbpO2jE.', 'meat@fallout.com'),
(12, 'test', 'user', '$2y$10$WLAokUq2AVLSUV4o42ZuDOHJyJnDx9KbbBPKevxCoJE8/yX.DdT9u', 'test@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_achievements`
--

CREATE TABLE `users_achievements` (
  `users_achievements_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `achievement_id` int(11) NOT NULL,
  `progress` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_achievements`
--

INSERT INTO `users_achievements` (`users_achievements_id`, `user_id`, `achievement_id`, `progress`) VALUES
(1, 2, 1, NULL),
(2, 6, 1, NULL),
(3, 6, 2, NULL),
(4, 6, 3, NULL),
(7, 7, 2, NULL),
(8, 7, 3, NULL),
(9, 7, 4, NULL),
(10, 10, 2, NULL),
(11, 11, 3, NULL),
(12, 8, 2, NULL),
(13, 8, 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`achievement_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_achievements`
--
ALTER TABLE `users_achievements`
  ADD PRIMARY KEY (`users_achievements_id`),
  ADD KEY `user_id_FK` (`user_id`),
  ADD KEY `achievement_id_FK` (`achievement_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_achievements`
--
ALTER TABLE `users_achievements`
  MODIFY `users_achievements_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_achievements`
--
ALTER TABLE `users_achievements`
  ADD CONSTRAINT `achievement_id_FK` FOREIGN KEY (`achievement_id`) REFERENCES `achievements` (`achievement_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
