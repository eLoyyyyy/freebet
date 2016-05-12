-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2016 at 05:53 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freebetqq101`
--

-- --------------------------------------------------------

--
-- Table structure for table `fb_form_data`
--

CREATE TABLE `fb_form_data` (
  `entries_id` bigint(20) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `website_type` varchar(5) NOT NULL DEFAULT 'QQ101',
  `ip_address` int(10) UNSIGNED NOT NULL,
  `reason_type` varchar(100) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `app_status` int(1) NOT NULL DEFAULT '0',
  `account_id` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `freebet_tbl_accounts`
--

CREATE TABLE `freebet_tbl_accounts` (
  `id` bigint(20) NOT NULL,
  `enc_id` text NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `account_type` int(11) NOT NULL DEFAULT '0',
  `website_type` int(11) NOT NULL DEFAULT '0',
  `activation_status` int(11) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fb_form_data`
--
ALTER TABLE `fb_form_data`
  ADD PRIMARY KEY (`entries_id`),
  ADD KEY `facebook_url` (`facebook_url`),
  ADD KEY `facebook_url_2` (`facebook_url`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `freebet_tbl_accounts`
--
ALTER TABLE `freebet_tbl_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fb_form_data`
--
ALTER TABLE `fb_form_data`
  MODIFY `entries_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `freebet_tbl_accounts`
--
ALTER TABLE `freebet_tbl_accounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
