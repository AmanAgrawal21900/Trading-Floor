-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 11:10 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trading_floor`
--

-- --------------------------------------------------------

--
-- Table structure for table `c_purchase`
--

CREATE TABLE `c_purchase` (
  `id` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `cname` varchar(255) NOT NULL,
  `shares` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_purchase`
--

INSERT INTO `c_purchase` (`id`, `symbol`, `cname`, `shares`) VALUES
(1, 'AAPL', 'Apple Inc', 5),
(1, 'A', 'Agilent Technologies Inc.', 8),
(1, 'B', 'Barnes Group Inc.', 5),
(3, 'AAPL', 'Apple Inc', 1),
(3, 'A', 'Agilent Technologies Inc.', 5),
(1, 'G', 'Genpact Ltd', 3),
(1, 'D', 'Dominion Energy Inc', 5),
(1, 'H', 'Hyatt Hotels Corporation - Class A', 2),
(1, 'AC', 'Associated Capital Group Inc - Class A', 3),
(4, 'GOOG', 'Alphabet Inc - Class C', 1),
(4, 'E', 'Eni Spa - ADR', 3);

-- --------------------------------------------------------

--
-- Table structure for table `c_transactions`
--

CREATE TABLE `c_transactions` (
  `id` int(11) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `shares` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `action` varchar(50) NOT NULL,
  `transacted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_transactions`
--

INSERT INTO `c_transactions` (`id`, `symbol`, `shares`, `price`, `action`, `transacted`) VALUES
(1, 'AAPL', 5, '168.83', 'Bought', '2022-03-23 04:45:09'),
(1, 'A', 5, '139.35', 'Bought', '2022-03-23 04:45:39'),
(1, 'B', 5, '41.82', 'Bought', '2022-03-23 04:45:47'),
(1, 'GOOG', 1, '2804.17', 'Bought', '2022-03-23 04:46:30'),
(1, 'A', -2, '139.35', 'Sold', '2022-03-23 04:47:28'),
(1, 'A', 1, '139.35', 'Bought', '2022-03-23 05:41:06'),
(1, 'A', 1, '139.35', 'Bought', '2022-03-23 05:41:24'),
(1, 'A', -1, '139.35', 'Sold', '2022-03-23 05:41:59'),
(1, 'A', 5, '139.35', 'Bought', '2022-03-23 06:30:11'),
(1, 'A', -5, '139.35', 'Sold', '2022-03-23 06:30:25'),
(1, 'A', 5, '139.35', 'Bought', '2022-03-23 08:21:17'),
(3, 'AAPL', 1, '168.83', 'Bought', '2022-03-23 09:45:15'),
(3, 'A', 5, '139.35', 'Bought', '2022-03-23 09:45:56'),
(3, 'A', 5, '139.35', 'Bought', '2022-03-23 09:46:20'),
(3, 'A', -5, '139.35', 'Sold', '2022-03-23 09:47:13'),
(1, 'G', 3, '44.40', 'Bought', '2022-03-23 13:10:05'),
(1, 'D', 5, '81.81', 'Bought', '2022-03-23 14:06:33'),
(1, 'A', -3, '136.03', 'Sold', '2022-03-23 14:07:27'),
(1, 'GOOG', -1, '2789.31', 'Sold', '2022-03-23 14:08:59'),
(1, 'AAPL', 2, '170.31', 'Bought', '2022-03-24 06:16:40'),
(1, 'AAPL', -2, '170.31', 'Sold', '2022-03-24 06:17:09'),
(1, 'H', 3, '93.30', 'Bought', '2022-03-24 08:43:06'),
(1, 'A', 1, '134.19', 'Bought', '2022-03-24 08:45:18'),
(1, 'H', -1, '93.30', 'Sold', '2022-03-24 08:46:55'),
(1, 'AC', 5, '40.47', 'Bought', '2022-03-24 09:27:02'),
(1, 'AC', -2, '40.47', 'Sold', '2022-03-24 09:27:48'),
(4, 'GOOG', 1, '2829.49', 'Bought', '2022-03-27 10:23:54'),
(4, 'E', 5, '29.75', 'Bought', '2022-03-27 10:27:16'),
(4, 'E', -2, '29.75', 'Sold', '2022-03-27 10:27:50'),
(1, 'A', 1, '113.75', 'Bought', '2022-05-09 18:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `c_users`
--

CREATE TABLE `c_users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phash` varchar(255) NOT NULL,
  `cash` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_users`
--

INSERT INTO `c_users` (`userid`, `username`, `email`, `phash`, `cash`) VALUES
(1, 'Aman', 'aman@gmail.com', '$2y$10$IfjHyDujY2Pbb5KawVbBH.CifKmnPO1g.EJVMp86Q8vzkub9oj/ay', '6987.76'),
(2, 'Mohit Jain', 'mohit@gmail.com', '$2y$10$uzhuOxop/p.ARmCFs1bcO.Bq.mLGpsMQNcO/UiC1dDyQLS37MLJGe', '10000.01'),
(3, 'Rathin Nair', 'rathin@gmail.com', '$2y$10$vOrPxjq0mdSdcYPA4RZXaOviC0CNAfa8wgusz6/upOEypRnpAd.qW', '9134.46'),
(4, 'Ashish', 'ashish@gmail.com', '$2y$10$Yeifbr5l5ObM0RvmQrElGeWNPo65DEhatx/tIDDoJUHbYdcy72uQy', '7081.26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c_users`
--
ALTER TABLE `c_users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_users`
--
ALTER TABLE `c_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
