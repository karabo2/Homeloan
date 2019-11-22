-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2019 at 08:32 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id11666997_lifecheqhomeloan`
--

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `purchase` double NOT NULL,
  `deposit` double NOT NULL,
  `years` int(11) NOT NULL,
  `rate` double NOT NULL,
  `monthlypay` double NOT NULL,
  `interestpay` double NOT NULL,
  `totalpay` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`name`, `purchase`, `deposit`, `years`, `rate`, `monthlypay`, `interestpay`, `totalpay`) VALUES
('Dave', 100, 0, 1, 0.01, 8, -4, 96),
('karabo', 200000, 0, 5, 0.1, 4249, 54940, 254940),
('Car', 3000, 0, 3, 0.1025, 97, 492, 3492),
('LM', 350000, 35000, 5, 0.098, 6662, 84720, 399720),
('house', 50000, 0, 5, 0.14, 1163, 19780, 69780);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
