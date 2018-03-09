-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 09, 2018 at 02:08 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 5.6.31-6+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incipient_dev5_evcsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=>Active , 1=>Inactive',
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `parent_id`, `status`, `created_on`, `updated_on`) VALUES
(2, 'ITechno Solution', 0, 0, 1519901979, 0),
(3, 'ITechno Solution-sub', 2, 0, 1519902614, 1520515529),
(5, 'ITechno Solution-Ahmedabad', 2, 0, 1519905070, 0),
(6, 'Parent Company - 1', 0, 0, 1520515608, 0),
(7, 'Parent Company - 2', 0, 0, 1520515613, 0),
(8, 'Parent Company - 3', 0, 0, 1520515618, 0),
(9, 'Parent Company -4', 0, 0, 1520515622, 0),
(10, 'child Company -1.1', 6, 0, 1520515647, 0),
(11, 'child Company -1.2', 7, 0, 1520515657, 1520515806),
(12, 'child Company -1.3', 6, 0, 1520515662, 0),
(13, 'child Company -1.4', 6, 0, 1520515666, 0),
(14, 'child Company -1.1', 7, 0, 1520515678, 0),
(15, 'child Company -1.2', 7, 0, 1520515683, 0),
(16, 'child Company -1.1', 8, 0, 1520515692, 0),
(17, 'child Company -1.2', 8, 0, 1520515699, 0);

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company_id` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_on` int(11) NOT NULL,
  `updated_on` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
