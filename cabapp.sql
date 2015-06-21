-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2015 at 07:25 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cabapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_location` varchar(255) NOT NULL DEFAULT 'Hillhead',
  `end_location` varchar(255) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `confirmed` int(1) NOT NULL DEFAULT '0',
  `seats` int(11) NOT NULL DEFAULT '4',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `time`, `start_location`, `end_location`, `creator_id`, `confirmed`, `seats`) VALUES
(1, '2015-06-20 14:40:19', 'Hillhead', 'Airport', 1, 0, 4),
(2, '2015-06-20 14:40:27', 'Hillhead', 'Train Station', 1, 0, 4),
(3, '2015-06-20 16:09:03', 'Hillhead', 'Train Station', 9, 0, 4),
(4, '2015-06-20 16:10:42', 'Hillhead', 'Airport', 9, 0, 4),
(5, '2015-06-04 13:34:00', 'Hillhead', 'Train Station', 10, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `join_booking`
--

CREATE TABLE IF NOT EXISTS `join_booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `join_booking`
--

INSERT INTO `join_booking` (`booking_id`, `user_id`) VALUES
(1, 3),
(2, 4),
(1, 2),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '5',
  `votes` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `forename`, `surname`, `email`, `password`) VALUES
(1, '', '', 'test_user@abdn.ac.uk', '$2a$10$qw6Cv7ikOYk59pVreElA.eTx8iq7SdOHlmYPH8OSIveRlTTvTHn6u'),
(2, '', '', 'testing@testing.testing', '$2a$10$p3qPCjLhn0EnA0EAZWbV3.vqzblttZzLenuaF7fMCfGZaDp0jQlty'),
(3, '', '', 't@t.t', '$2a$10$frCq/IRmWxv02Q6rNNjEcu47.K2eWrTaarHYR9TU4KhWo4rtGqVGq'),
(4, '', '', 'd@d.d', '$2a$10$ug5lTJ2on.1kv9fYBbFAe.ICM01RpoE227n2sdROzmrs10zIHUvxO'),
(5, '', '', 'lewis@test.com', '$2a$10$rMlZMciDQA0HrGYPgF3NxOsfWvfls0HFvDegz3sN.vUE1JBj9pHfW'),
(6, 'Lewis', 'Crouch', 'lewis@crouch.com', '$2a$10$HQTCIru3gMVd.f3wjFdW7.pgtpk0iDhAjo7icYr1N5kMQ5xbnz7wy'),
(9, 'Test', 'Tester', 'tester@testing.test', '$2a$10$lRnbBLs4ERLH7M6IrFMgNu0kYGWui2P0pU4zEeFe8rQB/j4rpAN4K'),
(10, 'Dan', 'Danny', 'dan@danny.dan', '$2a$10$0VbG671OqbAii5dV6kn2P.kMhRJ4qqyFai7hp57cUk1HTkNgqy.rC'),
(11, 'Don', 'Dons', 'don@dons.don', '$2a$10$RaCb47ke09Bo.wNTggQKueQkdJuyI/N/WPwllvyuuR7QZlHNPvmFK'),
(16, 'asdsds', 'dafsjfsaj', 'jafdjfsa@afjf.com', '$2a$10$5gls7iea92OobURTZBKx8ObChpbtEtpa7Wrs2DE2DRZfZURYqSv/.'),
(17, 'hafhfa', 'nfahaf', 'sadj@fm.com', '$2a$10$Kyh7v5y/wjyDRUdy7IPL0.OmN4HZe33Z/HdqJ1lXih0wPtobx9wiO'),
(18, 'Hi', 'Hi', 'Hi@hi.hi', '$2a$10$Yad83LfeiLGbEBFy92mqUuYeNCRRimYvnppfHmyTTYbkpFt7e6bGm'),
(19, 'donna', 'connelly', 'donna@connelly.com', '$2a$10$OxLFhBSCiBYeLBwDwbpn0.RtpkZ7vUI/UwwIvZAW2Xyqh8JvJ5z.S');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
