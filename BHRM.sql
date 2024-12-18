-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 07:26 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bhapplication`
--

CREATE TABLE `bhapplication` (
  `id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `hname` varchar(25) NOT NULL,
  `haddress` varchar(25) NOT NULL,
  `contact_no` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `landlord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bhapplication`
--

INSERT INTO `bhapplication` (`id`, `owner`, `hname`, `haddress`, `contact_no`, `status`, `landlord`) VALUES
(1, 'dodge@gmail.com', 'Dodge Boarding House', 'Zamboanggaa', 946464646, 'Approved', 'Dodge'),
(2, 'landlord2@gmail.com', 'Landlord2 BH', 'maranding', 2147483647, 'Approved', 'landlord2');

-- --------------------------------------------------------

--
-- Table structure for table `boardinghouses`
--

CREATE TABLE `boardinghouses` (
  `id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `hname` varchar(25) NOT NULL,
  `haddress` varchar(25) NOT NULL,
  `contact_no` int(255) NOT NULL,
  `landlord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boardinghouses`
--

INSERT INTO `boardinghouses` (`id`, `owner`, `hname`, `haddress`, `contact_no`, `landlord`) VALUES
(1, 'dodge@gmail.com', 'Dodge Boarding House', 'Zamboanggaa', 946464646, 'Dodge'),
(2, 'landlord2@gmail.com', 'Landlord2 BH', 'maranding', 2147483647, 'landlord2');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `id` int(255) NOT NULL,
  `bh_description` varchar(255) NOT NULL,
  `hname` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`id`, `bh_description`, `hname`, `owner`) VALUES
(1, 'pinaka nindot sa tanan', 'Dodge Boarding House', 'dodge@gmail.com'),
(2, 'ambot sa imo', 'Landlord2 BH', 'landlord2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(255) NOT NULL,
  `bar_clear` varchar(255) NOT NULL,
  `bus_per` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `hname` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `bar_clear`, `bus_per`, `image`, `hname`, `owner`) VALUES
(1, 'images/cd0e1a4f0a8567a6a8f04f30d113983b.png', 'images/1-493fe17210.jpg', 'images/azianna.jpg', 'Dodge Boarding House', 'dodge@gmail.com'),
(2, 'images/cd0e1a4f0a8567a6a8f04f30d113983b.png', 'images/1-493fe17210.jpg', 'images/azianna.jpg', 'Landlord2 BH', 'landlord2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(255) NOT NULL,
  `res_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `room_no` int(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `room_slot` varchar(255) NOT NULL,
  `slot_price` int(255) NOT NULL,
  `payment` int(255) NOT NULL,
  `pay_stat` varchar(255) NOT NULL,
  `pay_date` datetime DEFAULT NULL,
  `hname` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `res_id`, `email`, `room_no`, `price`, `room_slot`, `slot_price`, `payment`, `pay_stat`, `pay_date`, `hname`, `owner`) VALUES
(143, 105, 'user@gmail.com', 1, '6000', 'Slot 1, Slot 2, Slot 3', 1000, 0, 'Not Fully Paid', NULL, 'Dodge Boarding House', 'dodge@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `payment` int(255) NOT NULL,
  `pay_date` datetime DEFAULT NULL,
  `pay_stat` varchar(255) NOT NULL,
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `room_no` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `slot_price` int(11) NOT NULL,
  `hname` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `fname`, `lname`, `gender`, `email`, `payment`, `pay_date`, `pay_stat`, `date_in`, `date_out`, `room_no`, `price`, `slot_price`, `hname`, `owner`) VALUES
(1, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', NULL, 1, 0, 0, 'Dodge Boarding House', ''),
(2, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', NULL, 1, 0, 0, 'Dodge Boarding House', ''),
(3, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', NULL, 1, 0, 0, 'Dodge Boarding House', ''),
(4, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', NULL, 1, 0, 0, 'Dodge Boarding House', ''),
(5, 'user', 'user', 'male', 'user@gmail.com', 5000, '2024-12-04 00:00:00', '', '2024-12-04', '2024-12-04', 1, 0, 0, 'Dodge Boarding House', ''),
(6, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', '2024-12-04', 1, 0, 0, 'Dodge Boarding House', ''),
(7, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', NULL, 1, 0, 0, 'Dodge Boarding House', ''),
(8, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', NULL, 1, 0, 0, 'Dodge Boarding House', ''),
(9, 'user', 'user', 'male', 'user@gmail.com', 500, '2024-12-04 00:00:00', '', '2024-12-04', '2024-12-04', 1, 0, 0, 'Dodge Boarding House', ''),
(10, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-04', '2024-12-04', 1, 0, 0, 'Dodge Boarding House', ''),
(11, 'user', 'user', 'male', 'user@gmail.com', 3663, '2024-12-04 00:00:00', '', '2024-12-04', '2024-12-04', 1, 0, 0, 'Dodge Boarding House', ''),
(12, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-04 00:00:00', 'Fully Paid', '2024-12-04', '2024-12-04', 1, 0, 0, 'Dodge Boarding House', ''),
(13, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(14, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(15, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(16, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(17, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(18, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-05', NULL, 1, 0, 0, 'Dodge Boarding House', ''),
(19, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(20, 'user', 'user', 'male', 'user@gmail.com', 5000, '2024-12-05 00:00:00', 'Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(21, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(22, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(23, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(24, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 1, 0, 0, 'Dodge Boarding House', ''),
(25, 'user', 'user', 'male', 'user2@gmail.com', 5000, '2024-12-05 00:00:00', 'Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(26, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(27, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(28, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(29, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(30, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-05', '2024-12-05', 2, 0, 0, 'Dodge Boarding House', ''),
(31, 'user', 'user', 'male', 'user@gmail.com', 700, '2024-12-05 00:00:00', 'Partially Paid', '2024-12-05', '2024-12-06', 1, 0, 0, 'Dodge Boarding House', ''),
(32, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-06 00:00:00', 'Fully Paid', '2024-12-06', '2024-12-06', 2, 0, 0, 'Dodge Boarding House', ''),
(33, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-06', '2024-12-06', 1, 0, 0, 'Dodge Boarding House', ''),
(34, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-06', '2024-12-06', 2, 1000, 0, 'Dodge Boarding House', ''),
(35, 'user', 'user', 'male', 'user@gmail.com', 999, '2024-12-06 00:00:00', 'Partially Paid', '2024-12-06', '2024-12-06', 1, 1000, 0, 'Dodge Boarding House', ''),
(36, 'user', 'user', 'male', 'user2@gmail.com', 500, '2024-12-06 00:00:00', 'Partially Paid', '2024-12-06', '2024-12-06', 1, 1000, 0, 'Dodge Boarding House', ''),
(37, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-06 00:00:00', 'Fully Paid', '2024-12-06', '2024-12-06', 1, 1000, 0, 'Dodge Boarding House', ''),
(38, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-06 00:00:00', 'Fully Paid', '2024-12-06', '2024-12-06', 1, 1000, 0, 'Dodge Boarding House', ''),
(39, 'user', 'user', 'male', 'user2@gmail.com', 800, '1970-01-15 00:00:00', 'Partially Paid', '2024-12-06', '2024-12-06', 1, 1000, 0, 'Dodge Boarding House', ''),
(40, 'user', 'user', 'male', 'user2@gmail.com', 500, '1970-01-14 00:00:00', 'Partially Paid', '2024-12-06', '2024-12-06', 1, 1000, 0, 'Dodge Boarding House', ''),
(41, 'user', 'user', 'male', 'user@gmail.com', 700, '1970-01-14 00:00:00', 'Partially Paid', '2024-12-06', '2024-12-06', 2, 1000, 0, 'Dodge Boarding House', ''),
(42, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-08 00:00:00', 'Fully Paid', '2024-12-08', '2024-12-08', 1, 1000, 0, 'Dodge Boarding House', ''),
(43, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-08', '2024-12-08', 1, 1000, 0, 'Dodge Boarding House', ''),
(44, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-08', '2024-12-08', 1, 1000, 0, 'Dodge Boarding House', ''),
(45, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-08', '2024-12-08', 1, 1000, 0, 'Dodge Boarding House', ''),
(46, 'user', 'user', 'male', 'user@gmail.com', 500, '2024-12-09 00:00:00', 'Partially Paid', '2024-12-09', '2024-12-09', 1, 1000, 0, 'Dodge Boarding House', ''),
(47, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-09', '2024-12-09', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(48, 'user', 'user', 'male', 'user2@gmail.com', 1000, '1970-01-16 00:00:00', 'Fully Paid', '2024-12-09', '2024-12-09', 1, 1000, 0, 'Landlord2 BH', 'landlord2@gmail.com'),
(49, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-09 00:00:00', 'Fully Paid', '2024-12-09', '2024-12-09', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(50, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-10', '2024-12-10', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(51, 'user', 'user', 'male', 'user@gmail.com', 1000, '1970-01-16 00:00:00', 'Fully Paid', '2024-12-10', '2024-12-10', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(52, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(53, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(54, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(55, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(56, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(57, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(58, 'user', 'user', 'male', 'user@gmail.com', 1, '2024-12-11 00:00:00', 'Partially Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(59, 'user3', 'user3', 'male', 'user3@gmail.com', 1000, '2024-12-11 00:00:00', 'Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(60, 'user3', 'user3', 'male', 'user3@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(61, 'user3', 'user3', 'male', 'user3@gmail.com', 1000, '2024-12-11 00:00:00', 'Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(62, 'user3', 'user3', 'male', 'user3@gmail.com', 1000, '2024-12-11 00:00:00', 'Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(63, 'user3', 'user3', 'male', 'user3@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(64, 'user3', 'user3', 'male', 'user3@gmail.com', 0, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-11', '2024-12-11', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(65, 'user3', 'user3', 'male', 'user3@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-11', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(66, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(67, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(68, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(69, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(72, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(73, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(74, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(75, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-12 00:00:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(76, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-12 21:24:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(77, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-12 21:39:00', 'Fully Paid', '2024-12-12', '2024-12-12', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(78, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 21:43:00', 'Fully Paid', '2024-12-12', '2024-12-12', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(79, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-12 21:43:00', 'Fully Paid', '2024-12-12', '2024-12-12', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(80, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-12 22:34:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(81, 'user3', 'user3', 'male', 'user3@gmail.com', 1000, '2024-12-12 22:34:00', 'Fully Paid', '2024-12-12', '2024-12-12', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(82, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-12 22:35:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(83, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 23:07:00', 'Fully Paid', '2024-12-12', '2024-12-12', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(84, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-12 23:25:00', 'Fully Paid', '2024-12-12', '2024-12-12', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(85, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-12 23:29:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(86, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-12 23:33:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(87, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 23:33:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(88, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-12 23:37:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(89, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-12 23:41:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(90, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-12 23:43:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(91, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 00:06:00', 'Fully Paid', '2024-12-12', '2024-12-12', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(92, 'user', 'user', 'male', 'user@gmail.com', 1000, '2024-12-13 07:32:00', 'Fully Paid', '2024-12-12', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(93, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 07:32:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(94, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-13 07:33:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(95, 'yes', 'yes', 'male', 'yes@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', NULL, 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(96, 'yes', 'yes', 'male', 'yes@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', NULL, 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(97, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', NULL, 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(98, 'user', 'user', 'male', 'user2@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', NULL, 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(99, 'yes', 'yes', 'male', 'yes@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', NULL, 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(100, 'yes', 'yes', 'male', 'yes@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', '0000-00-00', 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(101, 'yes', 'yes', 'male', 'yes@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', '0000-00-00', 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(102, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 08:13:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(103, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-13 08:13:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(104, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 08:27:00', 'Fully Paid', '2024-12-13', '2024-12-13', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(105, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-13 08:30:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(106, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 08:30:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(107, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 08:44:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(108, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-13 08:45:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(109, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 08:47:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(110, 'user', 'user', 'male', 'user2@gmail.com', 1000, '2024-12-13 08:48:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(111, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 08:48:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(112, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(113, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 09:48:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(114, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 10:49:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(115, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 11:04:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(116, 'user', 'user', 'male', 'user2@gmail.com', 6000, '2024-12-13 11:13:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(117, 'user', 'user', 'male', 'user2@gmail.com', 6000, '2024-12-13 11:16:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(118, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 11:18:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(119, 'user', 'user', 'male', 'user@gmail.com', 6000, '2024-12-13 11:18:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(120, 'user', 'user', 'male', 'user@gmail.com', 6000, '2024-12-13 11:39:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(121, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 11:54:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(122, 'user', 'user', 'male', 'user2@gmail.com', 6000, '2024-12-13 12:02:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(123, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 12:05:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(124, 'user', 'user', 'male', 'user2@gmail.com', 6000, '2024-12-13 12:14:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(125, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 12:22:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(126, 'user', 'user', 'male', 'user@gmail.com', 6000, '2024-12-13 12:22:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(127, 'user', 'user', 'male', 'user@gmail.com', 6000, '2024-12-13 12:26:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(128, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 12:26:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(129, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '0000-00-00 00:00:00', 'Not Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(130, 'user', 'user', 'male', 'user2@gmail.com', 6000, '2024-12-13 12:30:00', 'Fully Paid', '2024-12-13', '2024-12-13', 1, 6000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(131, 'yes', 'yes', 'male', 'yes@gmail.com', 6000, '2024-12-13 12:59:00', 'Fully Paid', '2024-12-13', '2024-12-13', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(132, 'yes', 'yes', 'male', 'yes@gmail.com', 1000, '2024-12-13 13:15:00', 'Fully Paid', '2024-12-13', '2024-12-13', 3, 1000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(133, 'user', 'user', 'male', 'user@gmail.com', 5000, '2024-12-13 13:31:00', 'Fully Paid', '2024-12-13', '2024-12-13', 2, 5000, 0, 'Dodge Boarding House', 'dodge@gmail.com'),
(134, 'user', 'user', 'male', 'user@gmail.com', 0, '0000-00-00 00:00:00', '', '2024-12-13', NULL, 1, 0, 0, 'Dodge Boarding House', 'dodge@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `tenant_status` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `addons` varchar(255) NOT NULL,
  `room_no` int(255) NOT NULL,
  `capacity` int(255) NOT NULL,
  `room_slot` varchar(255) NOT NULL,
  `current_tenant` int(255) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `tenant_type` varchar(255) NOT NULL,
  `room_floor` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `slot_price` int(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment` int(255) NOT NULL,
  `pay_stat` varchar(255) NOT NULL,
  `pay_date` datetime DEFAULT NULL,
  `res_stat` varchar(255) NOT NULL,
  `res_duration` varchar(255) NOT NULL,
  `res_reason` varchar(255) NOT NULL,
  `hname` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `image`, `fname`, `lname`, `email`, `gender`, `date_in`, `date_out`, `tenant_status`, `school`, `addons`, `room_no`, `capacity`, `room_slot`, `current_tenant`, `amenities`, `tenant_type`, `room_floor`, `price`, `slot_price`, `status`, `payment`, `pay_stat`, `pay_date`, `res_stat`, `res_duration`, `res_reason`, `hname`, `owner`) VALUES
(1, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 00:00:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(2, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'asdada', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 00:00:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(3, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 00:00:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(4, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-18', '2025-01-17', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 00:00:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(5, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-13', '2025-01-12', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 21:24:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(6, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 21:39:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(7, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(8, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'awdasdas', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 21:43:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(9, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 21:43:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(10, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 22:34:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(11, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(12, 'images/6757eb0b767dc8.02114997.jpg', 'user3', 'user3', 'user3@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 22:34:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(13, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(14, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 22:35:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(15, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(16, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(17, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'awdasdas', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(18, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(19, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'asdada', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:07:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(20, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', '', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(21, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-25', '2025-01-24', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(22, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:25:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(23, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-13', '2025-01-12', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:29:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(24, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-13', '2025-01-12', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:33:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(25, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:33:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(26, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-13', '2025-01-12', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(27, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-13', '2025-01-12', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:37:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(28, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:41:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(29, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(30, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-12 23:43:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(31, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-13', '2025-01-12', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(32, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-13', '2025-01-12', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 00:06:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(33, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:32:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(34, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:32:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(35, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:33:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(36, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:34:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(37, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:49:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(38, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:48:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(39, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:57:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(40, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 07:51:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(41, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:04:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(42, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:05:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(43, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'asdada', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:13:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(44, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2', 3, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:13:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(45, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(46, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(47, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'asdada', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:27:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(48, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'awdasdas', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(49, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 1, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:30:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(50, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(51, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:30:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(52, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:44:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(53, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(54, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:45:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(55, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(56, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-18', '2025-01-17', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:47:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(57, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-14', '2025-01-13', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(58, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 2, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:48:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(59, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', '', 1, 6, 'Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'Available', 1000, 'Fully Paid', '2024-12-13 08:48:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(60, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Not Fully Paid', '0000-00-00 00:00:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(61, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 09:48:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(62, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 10:49:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(63, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 11:04:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(64, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(65, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(66, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 11:13:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(67, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 11:16:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(68, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', '', 1, 6, 'Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(69, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 2, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 11:18:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(70, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 11:18:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(71, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 11:39:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(72, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-18', '2025-01-17', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(73, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 11:54:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(74, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(75, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:02:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(76, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'asdada', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 2, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(77, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:05:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(78, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:14:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(79, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', '', 1, 6, 'Slot 1', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(80, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 2, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:22:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(81, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 4, Slot 5', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:22:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(82, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 3, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:26:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(83, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:26:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(84, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', '', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Not Fully Paid', '0000-00-00 00:00:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(85, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(86, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'asdada', 1, 6, 'Slot 1, Slot 2, Slot 3, Slot 4', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:30:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(87, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(88, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(89, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(90, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 0, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(91, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'asdada', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(92, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 6000, 'Fully Paid', '2024-12-13 12:59:00', 'Ended', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(93, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-19', '2025-01-18', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(94, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-25', '2025-01-24', 'Student', 'CKCM', 'lakad matatag', 2, 5, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Reserved', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(95, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'awdasdas', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(96, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(97, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'awdasdas', 3, 1, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 1000, 'Available', 1000, 'Fully Paid', '2024-12-13 13:15:00', 'Ended', '', 'Reservation Ended', 'Dodge Boarding House', 'dodge@gmail.com'),
(98, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(99, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-14', '2025-01-13', 'Student', 'CKCM', 'asdada', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(100, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(101, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-28', '2025-01-27', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com'),
(102, 'images/6757eb0b767dc8.02114997.jpg', 'yes', 'yes', 'yes@gmail.com', 'male', '2024-12-26', '2025-01-25', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Cancelled', '', 'Reservation Cancelled', 'Dodge Boarding House', 'dodge@gmail.com'),
(103, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', '', 1, 6, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Rejected', '1 day', 'No valid information / No Tenant Came', 'Dodge Boarding House', 'dodge@gmail.com'),
(104, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-21', '2025-01-20', 'Student', 'CKCM', 'lakad matatag', 2, 5, 'Whole Room', 0, 'wifi, bedsheets', 'male', 'ground floor', 5000, 1000, 'Available', 5000, 'Fully Paid', '2024-12-13 13:31:00', 'Ended', '', 'Reservation Ended', 'Dodge Boarding House', 'dodge@gmail.com'),
(105, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user@gmail.com', 'male', '2024-12-20', '2025-01-19', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 3, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Confirmed', '', 'Tenant Arrived', 'Dodge Boarding House', 'dodge@gmail.com'),
(106, 'images/6757eb0b767dc8.02114997.jpg', 'user', 'user', 'user2@gmail.com', 'male', '2024-12-27', '2025-01-26', 'Student', 'CKCM', 'lakad matatag', 1, 6, 'Slot 1, Slot 2, Slot 3', 0, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'Available', 0, '', NULL, 'Approved', '1 day', 'Process Completed', 'Dodge Boarding House', 'dodge@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_no` int(255) NOT NULL,
  `capacity` int(255) NOT NULL,
  `current_tenant` int(255) NOT NULL,
  `amenities` varchar(255) NOT NULL,
  `tenant_type` varchar(255) NOT NULL,
  `room_floor` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `slot_price` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `hname` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_no`, `capacity`, `current_tenant`, `amenities`, `tenant_type`, `room_floor`, `price`, `slot_price`, `image`, `status`, `hname`, `owner`) VALUES
(1, 1, 6, 3, 'wifi, bedsheets', 'male', 'ground floor', 6000, 1000, 'images/6757eb0b767dc8.02114997.jpg', 'Available', 'Dodge Boarding House', 'dodge@gmail.com'),
(3, 2, 5, 0, 'wifi, bedsheets', 'male', 'ground floor', 5000, 1000, 'images/6757ed67802462.63033945.jpg', 'Available', 'Dodge Boarding House', 'dodge@gmail.com'),
(5, 1, 3, 0, 'wifi, bedsheets', 'male', 'ground floor', 1000, 0, 'images/675681f1615db3.96582265.jpg', 'Available', 'Landlord2 BH', 'landlord2@gmail.com'),
(7, 3, 1, 0, 'wifi', 'male', 'ground floor', 1000, 1000, 'images/67596acdea3f62.90388957.jpg', 'Available', 'Dodge Boarding House', 'dodge@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `tenant_status` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `hname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `fname`, `lname`, `gender`, `tenant_status`, `school`, `uname`, `pass`, `role`, `hname`) VALUES
(1, './profiles/profile_674fbd7e3d1e00.56959370.png', 'admin', 'admin', 'male', '', '', 'admin@gmail.com', 'yes', 'admin', ''),
(2, './profiles/profile_674fdaf0f1e706.33611863.png', 'dodge', 'suico', 'male', '', '', 'dodge@gmail.com', 'yes', 'landlord', 'Dodge Boarding House'),
(3, 'profiles/674fbe06b1aa58.49001610.png', 'user', 'user', 'male', 'Student', 'CKCM', 'user@gmail.com', 'yes', 'user', ''),
(4, 'profiles/6751a77e1f9204.76638950.jpg', 'user', 'user', 'male', 'Student', 'CKCM', 'user2@gmail.com', 'yes', 'user', ''),
(6, 'profiles/67559d17f13c02.62300745.png', 'user3', 'user3', 'male', 'Student', 'CKCM', 'user3@gmail.com', 'yes', 'user', ''),
(7, './profiles/profile_67564995db6406.57912063.png', 'landlord2', 'landlord2', '', '', '', 'landlord2@gmail.com', 'yes', 'landlord', 'Landlord2 BH'),
(8, 'profiles/67564ef22ff6e4.39455169.png', 'landlord3', 'landlord3', 'male', '', '', 'landlord3@gmail.com', 'yes', 'landlord', ''),
(9, 'profiles/675688600c7761.71301508.png', 'wagwan', 'wagwan', 'male', '', '', 'wagwan@gmail.com', 'yes', 'landlord', ''),
(10, 'profiles/6757ecbbb2c9e6.87689589.png', 'yes', 'yes', 'male', 'Student', 'CKCM', 'yes@gmail.com', 'yes', 'user', ''),
(11, 'profiles/', 'yes', 'yes', 'male', '', '', 'yes2@gmail.com', 'yes', 'landlord', ''),
(12, 'profiles/6757edd9dd56b1.88331674.png', 'asda', 'dasdasd', 'male', 'Student', 'CKCM', 'asdadaa@gmail.com', 'yes', 'user', ''),
(13, 'profiles/', 'ttt', 'ttttt', 'male', 'Student', 'CKCM', 'tttttt@gmail.com', 'yes', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bhapplication`
--
ALTER TABLE `bhapplication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boardinghouses`
--
ALTER TABLE `boardinghouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bhapplication`
--
ALTER TABLE `bhapplication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `boardinghouses`
--
ALTER TABLE `boardinghouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `description`
--
ALTER TABLE `description`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
