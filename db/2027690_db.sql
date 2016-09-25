-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: fdb12.freehostingeu.com
-- Generation Time: Sep 12, 2016 at 08:29 PM
-- Server version: 5.7.13-log
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2027690_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `company` varchar(100) COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `notes` varchar(100) COLLATE utf8mb4_slovenian_ci DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(15) COLLATE utf8mb4_slovenian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `address`, `company`, `notes`, `date_added`, `username`) VALUES
(12, 'U2FsdGVkX1/PEBz31IgbcVGvFYEi3m9hzrUD0nJraqQ=', 'U2FsdGVkX18xA9yoNkcSTcCE//pYcEjYPzjWTgHeJas=', 'U2FsdGVkX18IRC/IB+HGXM/YEIUasJlvk2U4mlcg1lA=', 'U2FsdGVkX1+7pvUCLiSRIabE5E9AFWudog3Y4uzjc6dTVc0cPpzUp4PEP27iHrMC', 'U2FsdGVkX187bR/2VDFzhApvwc2OsUM2MHp279fi8Qo=', 'U2FsdGVkX1/MLAJSIbEyK0GeTVMcLWCi2VQU37hC5XM=', '2016-07-20 21:42:39', 'dejanzr'),
(14, 'U2FsdGVkX1+aWBPjwmMMkg2xa/4smXnYy8er/XlDss8=', 'U2FsdGVkX19d5NaqRGWv0gfTtUoQj4V+VWoUvluPcgk=', 'U2FsdGVkX1+tErqFoAJkhu2c7uIKUdvh8UM0Toh2QHo=', 'U2FsdGVkX19V4xflpYfePs4u11g84YC5evP60Hn5Sa1sohap1enY99dGnxgZUHqrjOWvLBLbKLuZROwXf/fa+w==', 'U2FsdGVkX1/iUHehjEbNKvLw0X+1/P4TdZApJYwIj4g=', 'U2FsdGVkX1+H1jVOYL8J5Af9xlHAshUj/SBk6UajIK8=', '2016-07-20 21:40:26', 'marko'),
(11, 'U2FsdGVkX19L+HBUBOXgaIWNvoKPErK9UZXRAy0H4yI=', 'U2FsdGVkX1/Y30RAK1SjokEgQX5+8ZorYIZeR9qZoeo=', 'U2FsdGVkX18seUlaLwuGim65SJKB2ap1m8pDbPOntTc=', 'U2FsdGVkX1+Id5DK2iWop3UvgK1+RML5g3qODV19Em0E8aje8dSzXMMQN4JOw0/AyWR3c4PBAbqK4mU1N7siKA==', 'U2FsdGVkX19yn3G3TjfP3qD01/vH9CGR51dUKCVwR1I=', 'U2FsdGVkX1+v9b3p7BwJ/EcNjhHk9uMjL0my88g4Mfc=', '2016-07-20 21:43:09', 'dejanzr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_slovenian_ci NOT NULL,
  `confirm` varchar(255) COLLATE utf8mb4_slovenian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovenian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `confirm`) VALUES
('marko', '$2y$10$62mzzqTveJsDU0yv4DlE9ehf2fxaJgauxktExzOJn1HdZDkutjmj6', 'marko@email.com', 'yes');
--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
