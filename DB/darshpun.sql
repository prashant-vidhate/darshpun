-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2018 at 03:21 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `darshpun`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` bigint(10) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `pan_number` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `bank_ifsc` varchar(25) NOT NULL,
  `account_number` bigint(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_type` varchar(100) DEFAULT 'SAVING'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `user_id`, `pan_number`, `bank_name`, `bank_branch`, `bank_ifsc`, `account_number`, `created_at`, `updated_at`, `account_type`) VALUES
(1, '1', 'ATIPV8311J', 'ICICI', 'Baner', 'ICIC000985', 98568546878, '2018-12-08 00:00:00', '2018-12-08 09:10:16', 'CURRENT');

-- --------------------------------------------------------

--
-- Table structure for table `joining_details`
--

CREATE TABLE `joining_details` (
  `id` bigint(20) NOT NULL,
  `sponser_id` bigint(20) NOT NULL,
  `newly_created_user_id` bigint(20) NOT NULL,
  `joining_date` datetime NOT NULL,
  `joining_amount` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joining_details`
--

INSERT INTO `joining_details` (`id`, `sponser_id`, `newly_created_user_id`, `joining_date`, `joining_amount`, `created_at`, `updated_date`) VALUES
(1, 1, 1, '2018-12-19 05:06:53', 10000, '2018-12-19 05:06:53', '2018-12-19 17:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_role` varchar(100) NOT NULL DEFAULT 'USER'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `created_at`, `updated_date`, `user_role`) VALUES
('DP144522', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2018-12-09', '2018-12-09 11:04:53', 'USER'),
('sysadmin', 'a159b7ae81ba3552af61e9731b20870515944538', '2018-12-16', '2018-12-16 08:34:04', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `sponser_id` bigint(20) NOT NULL,
  `placement_id` bigint(20) NOT NULL,
  `placement_position` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile` bigint(13) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `landmark` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pin_code` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `account_is_active` varchar(20) DEFAULT 'ACTIVE',
  `created_date` date DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `sponser_id`, `placement_id`, `placement_position`, `title`, `firstname`, `middlename`, `lastname`, `date_of_birth`, `gender`, `mobile`, `email`, `location`, `landmark`, `city`, `district`, `state`, `pin_code`, `country`, `deleted`, `account_is_active`, `created_date`, `updated_date`) VALUES
(1, 'DP144522', 0, 0, 'Root', 'Mr', 'L1C1', 'L1C1', 'L1C1', '1993-06-27', 'Male', 868686868, 'a@gmailc.com', '', '', 'moshu', 'oune', 'mh', '26817', 'in', 0, 'ACTIVE', '2018-12-09', '2018-12-09 11:04:53'),
(2, 'sysadmin', 0, 0, 'Root', 'Mr. ', 'Admin', 'Admin', 'Admin', '2018-12-09', 'Male', 1236547855, NULL, NULL, NULL, 'Kopargaon', 'Ahemadnagar', 'Maharashtra', '423601', 'India', 0, 'ACTIVE', '2018-12-09', '2018-12-16 09:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_wallet`
--

CREATE TABLE `user_wallet` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `shopping_fund` float(10,2) NOT NULL,
  `profit_sharing_value` float(10,2) NOT NULL,
  `daily_profit` float(10,2) NOT NULL,
  `direct_referral_income` float(10,2) NOT NULL DEFAULT '0.00',
  `binary_income` float(10,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_wallet`
--

INSERT INTO `user_wallet` (`id`, `user_id`, `shopping_fund`, `profit_sharing_value`, `daily_profit`, `direct_referral_income`, `binary_income`, `created_at`, `updated_date`) VALUES
(1, 1, 5000.00, 99500.00, 500.00, 0.00, 0.00, '2018-12-05 00:00:00', '2018-12-21 16:04:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `joining_details`
--
ALTER TABLE `joining_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wallet`
--
ALTER TABLE `user_wallet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `joining_details`
--
ALTER TABLE `joining_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `user_wallet`
--
ALTER TABLE `user_wallet`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
