-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2026 at 05:33 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

DROP TABLE IF EXISTS `event_details`;
CREATE TABLE IF NOT EXISTS `event_details` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `event_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_category` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  KEY `fk_event_user` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_details`
--

INSERT INTO `event_details` (`event_id`, `user_id`, `event_name`, `event_description`, `event_category`, `keywords`, `video_url`, `image_url`, `start_date`, `end_date`) VALUES
(6, 1, 'Meeting', 'this is a meeting talking about how to increase out profit margins', 'businesses meeting', 'Meeting, profit', 'https://youtu.be/Ades3pQbeh8?si=iQpKk-QXK9xyKfJs', 'https://m.media-amazon.com/images/M/MV5BMTNjNGU4NTUtYmVjMy00YjRiLTkxMWUtNzZkMDNiYjZhNmViXkEyXkFqcGc@', '2026-04-01', '2026-04-28'),
(5, 1, ' Party', 'this is a birthday for my younger sibling on the 10th', 'Birthday', 'birthday, party and childrens ', 'https://youtu.be/Ades3pQbeh8?si=iQpKk-QXK9xyKfJs', 'https://m.media-amazon.com/images/M/MV5BMTNjNGU4NTUtYmVjMy00YjRiLTkxMWUtNzZkMDNiYjZhNmViXkEyXkFqcGc@', '2026-05-01', '2026-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `forename` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `forename`, `surname`, `username`, `password`, `age`, `gender`, `email`) VALUES
(11, 'A', 'a', 'a', '$2y$10$/T4pyrNxGPin7YNO4IEcCuAgUlSqbwDDP0fJRv9fR1WjRYp4owgpm', 20, 'female', 'garcezr797@gmail.com'),
(1, 'Digo', 'Garcez', 'Troe', '$2y$10$mSEOzgZtWGI1DPgBPuhdL.NMYO00uv00iIRYBP/GjETH8svd58e/.', 20, 'male', 'Cardiff@Cardiffmet.ac .uk'),
(10, 'Rodrigo', 'Garcez', 'Digo', '$2y$10$d.E.hWGuqmWsYU74ac1Sseh2JwqYt0bE.H.fEyXstOtk9G8SMFxGW', 20, 'male', 'garcezr797@gmail.com'),
(12, 'b', 'b', 'b', '$2y$10$Wy9sP91s/PwZKsKRAbQsTuMMX2yYEYJ6if2iv9RxYCNeBgKeUYLqK', 20, 'female', 'garcezr797@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
