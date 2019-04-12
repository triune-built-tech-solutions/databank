-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2017 at 04:22 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itf`
--

-- --------------------------------------------------------

--
-- Table structure for table `ver_comp_acct`
--

CREATE TABLE `ver_comp_acct` (
  `id` int(11) NOT NULL,
  `office_type` int(11) DEFAULT NULL,
  `office_location` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `auto_date` varchar(15) DEFAULT NULL,
  `added_by` varchar(100) DEFAULT NULL,
  `comp_verd` int(11) DEFAULT '0',
  `var_est_cash` int(11) DEFAULT '0',
  `amount` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ver_comp_acct`
--

INSERT INTO `ver_comp_acct` (`id`, `office_type`, `office_location`, `month`, `year`, `auto_date`, `added_by`, `comp_verd`, `var_est_cash`, `amount`) VALUES
(1, 3, 32, 11, 2012, '16/02/2013 20:1', 'admin11', 17, 1719589930, 1177505490);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ver_comp_acct`
--
ALTER TABLE `ver_comp_acct`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ver_comp_acct`
--
ALTER TABLE `ver_comp_acct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
