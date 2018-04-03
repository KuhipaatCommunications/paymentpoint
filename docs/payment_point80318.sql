-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2018 at 10:08 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payment_point`
--

-- --------------------------------------------------------

--
-- Table structure for table `pp_bd_refund_status`
--

CREATE TABLE `pp_bd_refund_status` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_bd_status_details`
--

CREATE TABLE `pp_bd_status_details` (
  `id` int(11) NOT NULL,
  `status_code` varchar(10) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_child_merchant`
--

CREATE TABLE `pp_child_merchant` (
  `id` int(11) NOT NULL,
  `bd_merchant_id` varchar(50) DEFAULT NULL,
  `cm_name` varchar(250) DEFAULT NULL,
  `cm_email` varchar(250) DEFAULT NULL,
  `mobile_no_1` bigint(20) NOT NULL,
  `mobile_no_2` bigint(20) DEFAULT NULL,
  `land_line_1` bigint(20) DEFAULT NULL,
  `land_line_2` bigint(20) DEFAULT NULL,
  `cm_type_id` int(11) NOT NULL,
  `cm_address_1` text,
  `cm_address_2` text,
  `cm_pincode` int(6) NOT NULL,
  `cm_location` text,
  `cm_city` varchar(50) DEFAULT NULL,
  `cm_district` varchar(50) DEFAULT NULL,
  `cm_state` varchar(100) NOT NULL,
  `cm_country` varchar(100) NOT NULL DEFAULT 'India',
  `cm_status` tinyint(1) NOT NULL DEFAULT '0',
  `cm_created_on` datetime DEFAULT NULL,
  `cm_modified_on` datetime NOT NULL,
  `cm_created_by` int(11) NOT NULL,
  `cm_modified_by` int(11) NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `aprroved_on` datetime DEFAULT NULL,
  `return_url` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_child_merchant_transactions`
--

CREATE TABLE `pp_child_merchant_transactions` (
  `id` int(11) NOT NULL,
  `pp_cm_order_id` varchar(50) NOT NULL,
  `bd_merchant_id` varchar(50) NOT NULL,
  `cm_id` int(11) NOT NULL,
  `cm_order_id` varchar(50) NOT NULL,
  `bd_txn_reference_no` varchar(50) DEFAULT NULL,
  `txn_amount` double(10,2) NOT NULL,
  `currency_type` varchar(3) NOT NULL DEFAULT 'INR',
  `ItemCode` varchar(50) DEFAULT NULL,
  `bd_checksum` varchar(150) DEFAULT NULL,
  `pp_checksum` varchar(150) DEFAULT NULL,
  `txn_status` enum('p','s','f') NOT NULL,
  `bd_status_id` int(11) DEFAULT NULL,
  `bd_txn_date` date DEFAULT NULL,
  `cm_payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_cm_refund`
--

CREATE TABLE `pp_cm_refund` (
  `id` int(11) NOT NULL,
  `txn_id` int(11) NOT NULL,
  `refund_amount` double(10,2) NOT NULL,
  `refund_date` datetime NOT NULL,
  `refund_status_id` int(11) NOT NULL,
  `bd_refund_Id` varchar(50) NOT NULL,
  `error_code_id` int(11) NOT NULL,
  `bd_process_status` varchar(100) NOT NULL,
  `bd_checksum` varchar(100) NOT NULL,
  `pp_checksum` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_db_refund_error`
--

CREATE TABLE `pp_db_refund_error` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `error_reason` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_identity_master`
--

CREATE TABLE `pp_identity_master` (
  `id` int(11) NOT NULL,
  `identity_type_name` varchar(100) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_organization_type`
--

CREATE TABLE `pp_organization_type` (
  `id` int(11) NOT NULL,
  `org_type_name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pp_users_identity_details`
--

CREATE TABLE `pp_users_identity_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Identity_id` int(11) NOT NULL,
  `Identity_no` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pp_bd_refund_status`
--
ALTER TABLE `pp_bd_refund_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_bd_status_details`
--
ALTER TABLE `pp_bd_status_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_child_merchant`
--
ALTER TABLE `pp_child_merchant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_child_merchant_transactions`
--
ALTER TABLE `pp_child_merchant_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_cm_refund`
--
ALTER TABLE `pp_cm_refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_db_refund_error`
--
ALTER TABLE `pp_db_refund_error`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_identity_master`
--
ALTER TABLE `pp_identity_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_organization_type`
--
ALTER TABLE `pp_organization_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pp_users_identity_details`
--
ALTER TABLE `pp_users_identity_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pp_bd_refund_status`
--
ALTER TABLE `pp_bd_refund_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_bd_status_details`
--
ALTER TABLE `pp_bd_status_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_child_merchant`
--
ALTER TABLE `pp_child_merchant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_child_merchant_transactions`
--
ALTER TABLE `pp_child_merchant_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_cm_refund`
--
ALTER TABLE `pp_cm_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_db_refund_error`
--
ALTER TABLE `pp_db_refund_error`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_identity_master`
--
ALTER TABLE `pp_identity_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_organization_type`
--
ALTER TABLE `pp_organization_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pp_users_identity_details`
--
ALTER TABLE `pp_users_identity_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
