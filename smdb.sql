-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2019 at 09:52 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountId` int(11) NOT NULL,
  `AccountName` varchar(250) NOT NULL,
  `UsersId` int(11) NOT NULL,
  `ReferredById` varchar(250) DEFAULT NULL,
  `CodeId` int(11) NOT NULL,
  `TotalMVP` int(11) NOT NULL DEFAULT 0,
  `CurrentMVP` int(11) NOT NULL DEFAULT 0,
  `IncentivePoints` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsProfitShareMax` tinyint(1) NOT NULL DEFAULT 0,
  `DateCreated` date NOT NULL,
  `DateActive` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountId`, `AccountName`, `UsersId`, `ReferredById`, `CodeId`, `TotalMVP`, `CurrentMVP`, `IncentivePoints`, `IsActive`, `IsProfitShareMax`, `DateCreated`, `DateActive`) VALUES
(9, 'ACDA68ED3E35', 12, NULL, 8, 1, 1, 0, 1, 1, '2019-07-26', '2019-07-23'),
(10, 'ACE27AF28054', 12, 'AC1879258907', 9, 1, 1, 0, 1, 1, '2019-07-26', '2019-07-26'),
(11, 'AC1879258907', 13, '0', 4, 20, 13, 0, 1, 1, '2019-07-26', '2019-07-27'),
(12, 'AC1BE1A0D68A', 13, 'AC1879258907', 5, 1, 1, 0, 1, 1, '2019-07-26', '2019-07-26'),
(13, 'AC2019072616315113', 13, 'AC1879258907', 10, 3, 3, 0, 1, 1, '2019-07-26', '2019-07-26'),
(14, 'AC19082210574214', 14, 'AC1879258907', 11, 1, 1, 0, 1, 1, '2019-08-22', '2019-08-22'),
(15, 'AC19082307591212', 12, 'AC1879258907', 15, 15, 15, 0, 1, 0, '2019-08-23', '2019-08-23'),
(16, 'AC19082603020313', 13, NULL, 16, 15, 15, 0, 1, 0, '2019-08-26', '2019-08-26'),
(17, 'AC19082807201912', 12, 'ACDA68ED3E35', 21, 105, 60, 0, 1, 0, '2019-08-28', '2019-08-28'),
(18, 'AC19082807202412', 12, 'AC19082807201912', 20, 3, 3, 0, 1, 1, '2019-08-28', '2019-08-28'),
(19, 'AC19082807203112', 12, 'AC19082807201912', 19, 1, 1, 0, 1, 1, '2019-08-28', '2019-08-28'),
(20, 'AC19082807203712', 12, 'AC19082807201912', 18, 3, 3, 0, 1, 1, '2019-08-28', '2019-08-28'),
(21, 'AC19082807204312', 12, 'AC19082807201912', 17, 1, 1, 0, 1, 1, '2019-08-28', '2019-08-28'),
(22, 'AC19082808122612', 12, 'AC19082807201912', 12, 3, 3, 0, 1, 1, '2019-08-28', '2019-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `CodeId` int(11) NOT NULL,
  `Code` text NOT NULL,
  `OwnerId` int(11) DEFAULT NULL,
  `PackageId` int(11) NOT NULL,
  `IsUsed` tinyint(1) NOT NULL DEFAULT 0,
  `IsActive` tinyint(1) NOT NULL DEFAULT 1,
  `DateUsed` datetime DEFAULT NULL,
  `DateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `codes`
--

INSERT INTO `codes` (`CodeId`, `Code`, `OwnerId`, `PackageId`, `IsUsed`, `IsActive`, `DateUsed`, `DateCreated`) VALUES
(1, '80C9E464187D22B24D63EBE16F3AF7F1', NULL, 2, 1, 1, NULL, '2019-06-22 11:28:42'),
(2, '50E9641A74D58DDE8111391EEFE34695', NULL, 2, 1, 1, NULL, '2019-06-22 11:33:39'),
(3, '0DEC9371104135BD5F39A6DD726C80B4', NULL, 2, 1, 1, '2019-06-27 12:12:39', '2019-06-22 11:34:15'),
(4, '837D1F9A0E297861BD0EC0E89ED019EA', NULL, 3, 1, 1, '2019-07-26 15:44:29', '2019-06-22 11:35:45'),
(5, '7FAB7C6CCF92216C0794A1E142FBCE0F', NULL, 1, 1, 1, '2019-07-26 15:47:13', '2019-06-22 11:36:09'),
(6, '3523CB6D4764E85914F864772ADFA170', NULL, 3, 1, 1, '2019-07-24 16:05:17', '2019-06-22 11:43:22'),
(7, '05809A3B123258466328B32A84E82C14', NULL, 1, 1, 1, '2019-07-26 15:31:20', '2019-06-22 11:43:25'),
(8, 'DEFD16F08684546C2846DEF6A03DB757', NULL, 2, 1, 1, '2019-07-26 15:36:27', '2019-06-22 11:43:27'),
(9, '1E60BFBFD5772417BC0F99CC93C092F7', NULL, 2, 1, 1, '2019-07-26 15:36:41', '2019-06-22 12:14:24'),
(10, '45F02AE5CF714E694BFA0838C4D59195', NULL, 3, 1, 1, '2019-07-26 16:31:51', '2019-06-22 12:14:26'),
(11, 'A852A1EE10F6E6FEEDB1EFFAD734F19B', NULL, 2, 1, 1, '2019-08-22 10:57:42', '2019-06-25 14:14:26'),
(12, 'E7E79C59D6E222298B9F32B709D2005A', NULL, 3, 1, 1, '2019-08-28 08:12:26', '2019-06-25 15:00:46'),
(13, '72BBAA5937290AA4BDA96396A84BE250', NULL, 5, 1, 1, '2019-07-25 16:32:33', '2019-06-25 15:02:50'),
(14, 'B61E298D3CFBB6246D7306EF36B18614', NULL, 8, 1, 1, '2019-07-16 13:28:14', '2019-06-25 15:08:03'),
(15, '8E03832E6004E1B2703CD93B99E5FA3E', NULL, 7, 1, 1, '2019-08-23 07:59:12', '2019-08-23 07:58:30'),
(16, '2A35B75E095799154E8408D0A8AE1A58', NULL, 8, 1, 1, '2019-08-26 03:02:03', '2019-08-26 02:59:47'),
(17, '6591EF9FF52DB46AA6FB15B1DCF20518', NULL, 1, 1, 1, '2019-08-28 07:20:43', '2019-08-28 07:18:33'),
(18, 'BF8009A01020042B908E85AAA8E960FD', NULL, 4, 1, 1, '2019-08-28 07:20:37', '2019-08-28 07:18:36'),
(19, 'EB7F2587C2B6F5835A96D88F783D3AEA', NULL, 2, 1, 1, '2019-08-28 07:20:31', '2019-08-28 07:18:38'),
(20, '4A2E852A404119C6C3A28E31EB3F7091', NULL, 4, 1, 1, '2019-08-28 07:20:24', '2019-08-28 07:18:41'),
(21, 'E56A6A9FFB4FA6DDAC600DD308517913', NULL, 8, 1, 1, '2019-08-28 07:20:19', '2019-08-28 07:18:44'),
(22, '40E758A2D58866323AAF6AAD45EE3EAD', NULL, 2, 0, 1, NULL, '2019-08-30 11:47:25'),
(23, 'A91BB81B3C4E0557DC66A589E2BED309', NULL, 4, 0, 1, NULL, '2019-08-30 11:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `EarnId` int(11) NOT NULL,
  `AccountName` varchar(250) NOT NULL,
  `Debit` decimal(11,2) NOT NULL,
  `Credit` decimal(11,2) NOT NULL,
  `Tag` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `DateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`EarnId`, `AccountName`, `Debit`, `Credit`, `Tag`, `Description`, `DateCreated`) VALUES
(1, 'AC1879258907', '0.00', '450.00', 'Referral', 'Referral from AC19082210574214 on 2019-08-22 10:57:55', '2019-08-22 10:57:55'),
(2, 'AC1879258907', '0.00', '450.00', 'Referral', 'Referral from ACDA68ED3E35 on 2019-08-23 07:59:43', '2019-08-23 07:59:43'),
(3, 'AC1879258907', '0.00', '450.00', 'Referral', 'Referral from ACE27AF28054 on 2019-08-23 07:59:53', '2019-08-23 07:59:53'),
(4, 'AC1879258907', '0.00', '450.00', 'Referral', 'Referral from AC19082307591212 on 2019-08-23 07:59:59', '2019-08-23 07:59:59'),
(5, 'AC1879258907', '0.00', '600.00', 'Match', 'Match Sales Bonus in AC12 and AC14 on 2019-08-26 02:16:20', '2019-08-26 02:16:20'),
(12, 'AC19082807201912', '0.00', '3000.00', 'Match', 'Match Sales Bonus in AC18 and AC19 on 2019-08-28 07:33:32', '2019-08-28 07:33:32'),
(13, 'AC19082807201912', '0.00', '3000.00', 'Match', 'Match Sales Bonus in AC18 and AC19 on 2019-08-28 07:34:13', '2019-08-28 07:34:13'),
(14, 'AC19082807201912', '0.00', '450.00', 'Referral', 'Referral from AC19082807202412 on 2019-08-28 07:38:00', '2019-08-28 07:38:00'),
(15, 'AC19082807201912', '0.00', '150.00', 'Referral', 'Referral from AC19082807203112 on 2019-08-28 07:38:10', '2019-08-28 07:38:10'),
(16, 'AC19082807201912', '0.00', '450.00', 'Referral', 'Referral from AC19082807203712 on 2019-08-28 07:38:15', '2019-08-28 07:38:15'),
(17, 'AC19082807201912', '0.00', '150.00', 'Referral', 'Referral from AC19082807204312 on 2019-08-28 07:38:22', '2019-08-28 07:38:22'),
(18, 'AC19082807201912', '0.00', '450.00', 'Referral', 'Referral from AC19082808122612 on 2019-08-28 08:12:42', '2019-08-28 08:12:42'),
(19, 'AC19082807203712', '0.00', '1429.00', 'ProfitShare', 'AC19082807203712 earned ?1428.57 from Profit Share on 2019-08-28 14:07:27', '2019-08-28 14:07:27'),
(20, 'AC19082807204312', '0.00', '1429.00', 'ProfitShare', 'AC19082807204312 earned ?1428.57 from Profit Share on 2019-08-28 14:07:27', '2019-08-28 14:07:27'),
(21, 'AC19082807202412', '0.00', '1429.00', 'ProfitShare', 'AC19082807202412 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(22, 'AC19082807203112', '0.00', '1429.00', 'ProfitShare', 'AC19082807203112 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(23, 'AC19082808122612', '0.00', '1429.00', 'ProfitShare', 'AC19082808122612 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(24, 'AC19082807201912', '0.00', '1429.00', 'ProfitShare', 'AC19082807201912 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(25, 'AC19082603020313', '0.00', '1429.00', 'ProfitShare', 'AC19082603020313 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(26, 'AC19082307591212', '0.00', '1429.00', 'ProfitShare', 'AC19082307591212 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(27, 'AC19082210574214', '0.00', '1429.00', 'ProfitShare', 'AC19082210574214 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(28, 'AC2019072616315113', '0.00', '1429.00', 'ProfitShare', 'AC2019072616315113 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(29, 'AC1BE1A0D68A', '0.00', '1429.00', 'ProfitShare', 'AC1BE1A0D68A earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(30, 'AC1879258907', '0.00', '1429.00', 'ProfitShare', 'AC1879258907 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(31, 'ACE27AF28054', '0.00', '1429.00', 'ProfitShare', 'ACE27AF28054 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(32, 'ACDA68ED3E35', '0.00', '1429.00', 'ProfitShare', 'ACDA68ED3E35 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(33, 'AC19082807204312', '0.00', '357.00', 'ProfitShare', 'AC19082807204312 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(34, 'AC19082808122612', '0.00', '357.00', 'ProfitShare', 'AC19082808122612 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(35, 'AC19082807203112', '0.00', '357.00', 'ProfitShare', 'AC19082807203112 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(36, 'AC19082807203712', '0.00', '357.00', 'ProfitShare', 'AC19082807203712 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(37, 'AC19082807202412', '0.00', '357.00', 'ProfitShare', 'AC19082807202412 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(38, 'AC19082807201912', '0.00', '357.00', 'ProfitShare', 'AC19082807201912 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(39, 'AC19082603020313', '0.00', '357.00', 'ProfitShare', 'AC19082603020313 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(40, 'AC19082307591212', '0.00', '357.00', 'ProfitShare', 'AC19082307591212 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(41, 'AC19082210574214', '0.00', '357.00', 'ProfitShare', 'AC19082210574214 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(42, 'AC2019072616315113', '0.00', '357.00', 'ProfitShare', 'AC2019072616315113 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(43, 'AC1BE1A0D68A', '0.00', '357.00', 'ProfitShare', 'AC1BE1A0D68A earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(44, 'AC1879258907', '0.00', '357.00', 'ProfitShare', 'AC1879258907 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(45, 'ACE27AF28054', '0.00', '357.00', 'ProfitShare', 'ACE27AF28054 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(46, 'ACDA68ED3E35', '0.00', '357.00', 'ProfitShare', 'ACDA68ED3E35 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(47, 'AC19082808122612', '0.00', '1071.00', 'ProfitShare', 'AC19082808122612 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(48, 'AC19082807203712', '0.00', '1071.00', 'ProfitShare', 'AC19082807203712 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(49, 'AC19082807204312', '0.00', '214.00', 'ProfitShare', 'AC19082807204312 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(50, 'AC19082807203112', '0.00', '214.00', 'ProfitShare', 'AC19082807203112 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(51, 'AC19082807202412', '0.00', '1071.00', 'ProfitShare', 'AC19082807202412 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(52, 'AC19082807201912', '0.00', '1071.00', 'ProfitShare', 'AC19082807201912 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(53, 'AC19082603020313', '0.00', '1071.00', 'ProfitShare', 'AC19082603020313 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(54, 'AC19082307591212', '0.00', '1071.00', 'ProfitShare', 'AC19082307591212 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(55, 'AC19082210574214', '0.00', '214.00', 'ProfitShare', 'AC19082210574214 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(56, 'AC2019072616315113', '0.00', '1071.00', 'ProfitShare', 'AC2019072616315113 earned P1071.43 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(57, 'AC1BE1A0D68A', '0.00', '214.00', 'ProfitShare', 'AC1BE1A0D68A earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(58, 'AC1879258907', '0.00', '1071.00', 'ProfitShare', 'AC1879258907 earned P1071.43 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(59, 'ACE27AF28054', '0.00', '214.00', 'ProfitShare', 'ACE27AF28054 earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(60, 'ACDA68ED3E35', '0.00', '214.00', 'ProfitShare', 'ACDA68ED3E35 earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(61, 'AC19082807201912', '0.00', '955.00', 'ProfitShare', 'AC19082807201912 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(62, 'AC19082808122612', '0.00', '955.00', 'ProfitShare', 'AC19082808122612 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(63, 'AC19082603020313', '0.00', '955.00', 'ProfitShare', 'AC19082603020313 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(64, 'AC19082807203712', '0.00', '955.00', 'ProfitShare', 'AC19082807203712 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(65, 'AC19082807202412', '0.00', '955.00', 'ProfitShare', 'AC19082807202412 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(66, 'AC19082307591212', '0.00', '955.00', 'ProfitShare', 'AC19082307591212 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(67, 'AC2019072616315113', '0.00', '955.00', 'ProfitShare', 'AC2019072616315113 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(68, 'AC1879258907', '0.00', '955.00', 'ProfitShare', 'AC1879258907 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(69, 'AC19082808122612', '0.00', '2188.00', 'ProfitShare', 'AC19082808122612 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(70, 'AC19082807202412', '0.00', '2188.00', 'ProfitShare', 'AC19082807202412 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(71, 'AC19082603020313', '0.00', '2667.88', 'ProfitShare', 'AC19082603020313 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(72, 'AC19082807203712', '0.00', '2188.00', 'ProfitShare', 'AC19082807203712 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(73, 'AC19082307591212', '0.00', '2667.88', 'ProfitShare', 'AC19082307591212 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(74, 'AC19082807201912', '0.00', '2667.88', 'ProfitShare', 'AC19082807201912 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(75, 'AC2019072616315113', '0.00', '2188.00', 'ProfitShare', 'AC2019072616315113 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(76, 'AC1879258907', '0.00', '2188.00', 'ProfitShare', 'AC1879258907 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(77, 'AC19082307591212', '0.00', '3333.33', 'ProfitShare', 'AC19082307591212 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(78, 'AC19082603020313', '0.00', '3333.33', 'ProfitShare', 'AC19082603020313 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(79, 'AC19082807201912', '0.00', '3333.33', 'ProfitShare', 'AC19082807201912 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(80, 'AC19082307591212', '0.00', '-7542.00', 'ProfitShare', 'AC19082307591212 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(81, 'AC19082603020313', '0.00', '-7542.00', 'ProfitShare', 'AC19082603020313 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(82, 'AC19082807201912', '0.00', '-7542.00', 'ProfitShare', 'AC19082807201912 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(83, 'AC19082807201912', '0.00', '-16666.67', 'ProfitShare', 'AC19082807201912 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(84, 'AC19082603020313', '0.00', '-16666.67', 'ProfitShare', 'AC19082603020313 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(85, 'AC19082307591212', '0.00', '-16666.67', 'ProfitShare', 'AC19082307591212 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(86, 'AC1879258907', '0.00', '200.00', 'Match', 'Match Sales Bonus in AC15 and AC14 on 2019-08-30 11:56:41', '2019-08-30 11:56:41'),
(87, 'AC1879258907', '0.00', '200.00', 'Match', 'Match Sales Bonus in AC12 and AC13 on 2019-08-30 12:03:03', '2019-08-30 12:03:03'),
(88, 'AC1879258907', '0.00', '600.00', 'Match', 'Match Sales Bonus in AC15 and AC14 on 2019-08-30 12:03:03', '2019-08-30 12:03:03'),
(89, 'AC1879258907', '0.00', '200.00', 'Match', 'Match Sales Bonus in  and  on 2019-08-30 12:08:57', '2019-08-30 12:08:57'),
(90, 'AC1879258907', '0.00', '600.00', 'Match', 'Match Sales Bonus in  and  on 2019-08-30 12:08:57', '2019-08-30 12:08:57'),
(91, 'AC1879258907', '0.00', '200.00', 'Match', 'Match Sales Bonus in AC1BE1A0D68A and AC1BE1A0D68A on 2019-08-30 12:09:56', '2019-08-30 12:09:56'),
(92, 'AC1879258907', '0.00', '600.00', 'Match', 'Match Sales Bonus in AC19082307591212 and AC19082307591212 on 2019-08-30 12:09:56', '2019-08-30 12:09:56'),
(93, 'AC1879258907', '0.00', '200.00', 'Match', 'Match Sales Bonus in AC1BE1A0D68A and AC1BE1A0D68A on 2019-08-30 12:12:56', '2019-08-30 12:12:56'),
(94, 'AC1879258907', '0.00', '600.00', 'Match', 'Match Sales Bonus in AC19082307591212 and AC19082307591212 on 2019-08-30 12:12:56', '2019-08-30 12:12:56'),
(95, 'AC19082807201912', '0.00', '3333.33', 'ProfitShare', 'AC19082807201912 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(96, 'AC19082603020313', '0.00', '3333.33', 'ProfitShare', 'AC19082603020313 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(97, 'AC19082307591212', '0.00', '3333.33', 'ProfitShare', 'AC19082307591212 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(98, 'AC1879258907', '123.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:27:05', '2019-08-30 14:27:05'),
(99, 'AC1879258907', '123.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:28:29', '2019-08-30 14:28:29'),
(100, 'AC1879258907', '5000.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:36:31', '2019-08-30 14:36:31'),
(101, 'AC1879258907', '123.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:37:48', '2019-08-30 14:37:48'),
(102, 'AC1879258907', '0.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:54:39', '2019-08-30 14:54:39'),
(103, 'AC1879258907', '100.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:58:25', '2019-08-30 14:58:25'),
(104, 'AC1879258907', '0.00', '5000.00', 'Encashment', 'Reward earned adjustment on 2019-08-30 15:00:52', '2019-08-30 15:00:52'),
(105, 'AC1879258907', '0.00', '0.00', 'Encashment', 'Reward earned adjustment on 2019-08-30 15:01:09', '2019-08-30 15:01:09'),
(106, 'AC1879258907', '1000.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 15:03:26', '2019-08-30 15:03:26'),
(107, 'AC1879258907', '2500.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 15:08:24', '2019-08-30 15:08:24'),
(108, 'AC1879258907', '0.00', '1000.00', 'Encashment', 'Reward earned adjustment on 2019-08-30 15:12:23', '2019-08-30 15:12:23'),
(109, 'AC19082307591212', '0.00', '883.67', 'ProfitShare', 'AC19082307591212 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(110, 'AC19082807201912', '0.00', '883.67', 'ProfitShare', 'AC19082807201912 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(111, 'AC19082603020313', '0.00', '883.67', 'ProfitShare', 'AC19082603020313 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(112, 'AC19082807201912', '0.00', '166.67', 'ProfitShare', 'AC19082807201912 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(113, 'AC19082307591212', '0.00', '166.67', 'ProfitShare', 'AC19082307591212 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(114, 'AC19082603020313', '0.00', '166.67', 'ProfitShare', 'AC19082603020313 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(115, 'AC19082807201912', '0.00', '0.67', 'ProfitShare', 'AC19082807201912 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(116, 'AC19082603020313', '0.00', '0.67', 'ProfitShare', 'AC19082603020313 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(117, 'AC19082307591212', '0.00', '0.67', 'ProfitShare', 'AC19082307591212 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(118, 'AC19082603020313', '0.00', '16.67', 'ProfitShare', 'AC19082603020313 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(119, 'AC19082807201912', '0.00', '16.67', 'ProfitShare', 'AC19082807201912 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(120, 'AC19082307591212', '0.00', '16.67', 'ProfitShare', 'AC19082307591212 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(121, 'AC1879258907', '0.00', '1200.00', 'Encashment', 'Reward earned adjustment on 2019-09-02 11:34:21', '2019-09-02 11:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `incentivepoints`
--

CREATE TABLE `incentivepoints` (
  `IncentivePointId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `LeftPoints` int(11) NOT NULL,
  `RightPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incentivepoints`
--

INSERT INTO `incentivepoints` (`IncentivePointId`, `AccountId`, `LeftPoints`, `RightPoints`) VALUES
(8, 11, 1, 3),
(9, 11, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `LedgerId` int(11) NOT NULL,
  `AccountName` varchar(250) NOT NULL,
  `Debit` decimal(11,2) NOT NULL,
  `Credit` decimal(11,2) NOT NULL,
  `Tag` varchar(50) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `DateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`LedgerId`, `AccountName`, `Debit`, `Credit`, `Tag`, `Description`, `DateCreated`) VALUES
(1, 'AC1879258907', '450.00', '0.00', 'Referral', 'Referral from AC19082210574214 on 2019-08-22 10:57:55', '2019-08-22 10:57:55'),
(2, 'AC1879258907', '450.00', '0.00', 'Referral', 'Referral from ACDA68ED3E35 on 2019-08-23 07:59:43', '2019-08-23 07:59:43'),
(3, 'AC1879258907', '450.00', '0.00', 'Referral', 'Referral from ACE27AF28054 on 2019-08-23 07:59:53', '2019-08-23 07:59:53'),
(4, 'AC1879258907', '450.00', '0.00', 'Referral', 'Referral from AC19082307591212 on 2019-08-23 07:59:59', '2019-08-23 07:59:59'),
(5, 'AC1879258907', '600.00', '0.00', 'Match', 'Match Sales Bonus in AC12 and AC14 on 2019-08-26 02:16:20', '2019-08-26 02:16:20'),
(6, 'AC19082603020313', '0.00', '15000.00', 'Company', 'Earned from new member AC19082603020313 on 2019-08-26 03:02:03', '2019-08-26 03:02:03'),
(7, 'AC19082807201912', '0.00', '15000.00', 'Company', 'Earned from new member AC19082807201912 on 2019-08-28 07:20:19', '2019-08-28 07:20:19'),
(8, 'AC19082807202412', '0.00', '3000.00', 'Company', 'Earned from new member AC19082807202412 on 2019-08-28 07:20:24', '2019-08-28 07:20:24'),
(9, 'AC19082807203112', '0.00', '1000.00', 'Company', 'Earned from new member AC19082807203112 on 2019-08-28 07:20:31', '2019-08-28 07:20:31'),
(10, 'AC19082807203712', '0.00', '3000.00', 'Company', 'Earned from new member AC19082807203712 on 2019-08-28 07:20:37', '2019-08-28 07:20:37'),
(11, 'AC19082807204312', '0.00', '1500.00', 'Company', 'Earned from new member AC19082807204312 on 2019-08-28 07:20:43', '2019-08-28 07:20:43'),
(12, 'ACDA68ED3E35', '150.00', '0.00', 'Referral', 'Referral from AC19082807201912 on 2019-08-28 07:21:04', '2019-08-28 07:21:04'),
(13, 'ACDA68ED3E35', '150.00', '0.00', 'Referral', 'Referral from AC19082807202412 on 2019-08-28 07:21:11', '2019-08-28 07:21:11'),
(14, 'ACDA68ED3E35', '150.00', '0.00', 'Referral', 'Referral from AC19082807203112 on 2019-08-28 07:21:19', '2019-08-28 07:21:19'),
(15, 'ACDA68ED3E35', '150.00', '0.00', 'Referral', 'Referral from AC19082807203712 on 2019-08-28 07:21:26', '2019-08-28 07:21:26'),
(16, 'ACDA68ED3E35', '150.00', '0.00', 'Referral', 'Referral from AC19082807204312 on 2019-08-28 07:21:32', '2019-08-28 07:21:32'),
(17, 'AC19082807201912', '3000.00', '0.00', 'Match', 'Match Sales Bonus in AC18 and AC19 on 2019-08-28 07:31:20', '2019-08-28 07:31:20'),
(18, 'AC19082807201912', '3000.00', '0.00', 'Match', 'Match Sales Bonus in AC18 and AC19 on 2019-08-28 07:33:32', '2019-08-28 07:33:32'),
(19, 'AC19082807201912', '3000.00', '0.00', 'Match', 'Match Sales Bonus in AC18 and AC19 on 2019-08-28 07:34:13', '2019-08-28 07:34:13'),
(20, 'AC19082807201912', '450.00', '0.00', 'Referral', 'Referral from AC19082807202412 on 2019-08-28 07:38:00', '2019-08-28 07:38:00'),
(21, 'AC19082807201912', '150.00', '0.00', 'Referral', 'Referral from AC19082807203112 on 2019-08-28 07:38:10', '2019-08-28 07:38:10'),
(22, 'AC19082807201912', '450.00', '0.00', 'Referral', 'Referral from AC19082807203712 on 2019-08-28 07:38:15', '2019-08-28 07:38:15'),
(23, 'AC19082807201912', '150.00', '0.00', 'Referral', 'Referral from AC19082807204312 on 2019-08-28 07:38:22', '2019-08-28 07:38:22'),
(24, 'AC19082808122612', '0.00', '4500.00', 'Company', 'Earned from new member AC19082808122612 on 2019-08-28 08:12:26', '2019-08-28 08:12:26'),
(25, 'AC19082807201912', '450.00', '0.00', 'Referral', 'Referral from AC19082808122612 on 2019-08-28 08:12:42', '2019-08-28 08:12:42'),
(26, 'AC19082807203712', '1429.00', '0.00', 'ProfitShare', 'AC19082807203712 earned ?1428.57 from Profit Share on 2019-08-28 14:07:27', '2019-08-28 14:07:27'),
(27, 'AC19082807204312', '1429.00', '0.00', 'ProfitShare', 'AC19082807204312 earned ?1428.57 from Profit Share on 2019-08-28 14:07:27', '2019-08-28 14:07:27'),
(28, 'AC19082807202412', '1429.00', '0.00', 'ProfitShare', 'AC19082807202412 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(29, 'AC19082807203112', '1429.00', '0.00', 'ProfitShare', 'AC19082807203112 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(30, 'AC19082808122612', '1429.00', '0.00', 'ProfitShare', 'AC19082808122612 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(31, 'AC19082807201912', '1429.00', '0.00', 'ProfitShare', 'AC19082807201912 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(32, 'AC19082603020313', '1429.00', '0.00', 'ProfitShare', 'AC19082603020313 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(33, 'AC19082307591212', '1429.00', '0.00', 'ProfitShare', 'AC19082307591212 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(34, 'AC19082210574214', '1429.00', '0.00', 'ProfitShare', 'AC19082210574214 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(35, 'AC2019072616315113', '1429.00', '0.00', 'ProfitShare', 'AC2019072616315113 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(36, 'AC1BE1A0D68A', '1429.00', '0.00', 'ProfitShare', 'AC1BE1A0D68A earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(37, 'AC1879258907', '1429.00', '0.00', 'ProfitShare', 'AC1879258907 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(38, 'ACE27AF28054', '1429.00', '0.00', 'ProfitShare', 'ACE27AF28054 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(39, 'ACDA68ED3E35', '1429.00', '0.00', 'ProfitShare', 'ACDA68ED3E35 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(40, 'AC19082807204312', '357.00', '0.00', 'ProfitShare', 'AC19082807204312 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(41, 'AC19082808122612', '357.00', '0.00', 'ProfitShare', 'AC19082808122612 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(42, 'AC19082807203112', '357.00', '0.00', 'ProfitShare', 'AC19082807203112 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(43, 'AC19082807203712', '357.00', '0.00', 'ProfitShare', 'AC19082807203712 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(44, 'AC19082807202412', '357.00', '0.00', 'ProfitShare', 'AC19082807202412 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(45, 'AC19082807201912', '357.00', '0.00', 'ProfitShare', 'AC19082807201912 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(46, 'AC19082603020313', '357.00', '0.00', 'ProfitShare', 'AC19082603020313 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(47, 'AC19082307591212', '357.00', '0.00', 'ProfitShare', 'AC19082307591212 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(48, 'AC19082210574214', '357.00', '0.00', 'ProfitShare', 'AC19082210574214 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(49, 'AC2019072616315113', '357.00', '0.00', 'ProfitShare', 'AC2019072616315113 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(50, 'AC1BE1A0D68A', '357.00', '0.00', 'ProfitShare', 'AC1BE1A0D68A earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(51, 'AC1879258907', '357.00', '0.00', 'ProfitShare', 'AC1879258907 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(52, 'ACE27AF28054', '357.00', '0.00', 'ProfitShare', 'ACE27AF28054 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(53, 'ACDA68ED3E35', '357.00', '0.00', 'ProfitShare', 'ACDA68ED3E35 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(54, 'AC19082808122612', '1071.00', '0.00', 'ProfitShare', 'AC19082808122612 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(55, 'AC19082807203712', '1071.00', '0.00', 'ProfitShare', 'AC19082807203712 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(56, 'AC19082807204312', '214.00', '0.00', 'ProfitShare', 'AC19082807204312 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(57, 'AC19082807203112', '214.00', '0.00', 'ProfitShare', 'AC19082807203112 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(58, 'AC19082807202412', '1071.00', '0.00', 'ProfitShare', 'AC19082807202412 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(59, 'AC19082807201912', '1071.00', '0.00', 'ProfitShare', 'AC19082807201912 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(60, 'AC19082603020313', '1071.00', '0.00', 'ProfitShare', 'AC19082603020313 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(61, 'AC19082307591212', '1071.00', '0.00', 'ProfitShare', 'AC19082307591212 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(62, 'AC19082210574214', '214.00', '0.00', 'ProfitShare', 'AC19082210574214 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(63, 'AC2019072616315113', '1071.00', '0.00', 'ProfitShare', 'AC2019072616315113 earned P1071.43 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(64, 'AC1BE1A0D68A', '214.00', '0.00', 'ProfitShare', 'AC1BE1A0D68A earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(65, 'AC1879258907', '1071.00', '0.00', 'ProfitShare', 'AC1879258907 earned P1071.43 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(66, 'ACE27AF28054', '214.00', '0.00', 'ProfitShare', 'ACE27AF28054 earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(67, 'ACDA68ED3E35', '214.00', '0.00', 'ProfitShare', 'ACDA68ED3E35 earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(68, 'AC19082807201912', '955.00', '0.00', 'ProfitShare', 'AC19082807201912 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(69, 'AC19082808122612', '955.00', '0.00', 'ProfitShare', 'AC19082808122612 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(70, 'AC19082603020313', '955.00', '0.00', 'ProfitShare', 'AC19082603020313 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(71, 'AC19082807203712', '955.00', '0.00', 'ProfitShare', 'AC19082807203712 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(72, 'AC19082807202412', '955.00', '0.00', 'ProfitShare', 'AC19082807202412 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(73, 'AC19082307591212', '955.00', '0.00', 'ProfitShare', 'AC19082307591212 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(74, 'AC2019072616315113', '955.00', '0.00', 'ProfitShare', 'AC2019072616315113 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(75, 'AC1879258907', '955.00', '0.00', 'ProfitShare', 'AC1879258907 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(76, 'AC19082808122612', '2188.00', '0.00', 'ProfitShare', 'AC19082808122612 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(77, 'AC19082807202412', '2188.00', '0.00', 'ProfitShare', 'AC19082807202412 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(78, 'AC19082603020313', '2667.88', '0.00', 'ProfitShare', 'AC19082603020313 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(79, 'AC19082807203712', '2188.00', '0.00', 'ProfitShare', 'AC19082807203712 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(80, 'AC19082307591212', '2667.88', '0.00', 'ProfitShare', 'AC19082307591212 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(81, 'AC19082807201912', '2667.88', '0.00', 'ProfitShare', 'AC19082807201912 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(82, 'AC2019072616315113', '2188.00', '0.00', 'ProfitShare', 'AC2019072616315113 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(83, 'AC1879258907', '2188.00', '0.00', 'ProfitShare', 'AC1879258907 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(84, 'AC19082307591212', '3333.33', '0.00', 'ProfitShare', 'AC19082307591212 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(85, 'AC19082603020313', '3333.33', '0.00', 'ProfitShare', 'AC19082603020313 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(86, 'AC19082807201912', '3333.33', '0.00', 'ProfitShare', 'AC19082807201912 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(87, 'AC19082307591212', '-7542.00', '0.00', 'ProfitShare', 'AC19082307591212 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(88, 'AC19082603020313', '-7542.00', '0.00', 'ProfitShare', 'AC19082603020313 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(89, 'AC19082807201912', '-7542.00', '0.00', 'ProfitShare', 'AC19082807201912 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(90, 'AC19082807201912', '-16666.67', '0.00', 'ProfitShare', 'AC19082807201912 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(91, 'AC19082603020313', '-16666.67', '0.00', 'ProfitShare', 'AC19082603020313 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(92, 'AC19082307591212', '-16666.67', '0.00', 'ProfitShare', 'AC19082307591212 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(93, 'AC1879258907', '200.00', '0.00', 'Match', 'Match Sales Bonus in AC15 and AC14 on 2019-08-30 11:56:41', '2019-08-30 11:56:41'),
(94, 'AC1879258907', '200.00', '0.00', 'Match', 'Match Sales Bonus in AC12 and AC13 on 2019-08-30 12:03:03', '2019-08-30 12:03:03'),
(95, 'AC1879258907', '600.00', '0.00', 'Match', 'Match Sales Bonus in AC15 and AC14 on 2019-08-30 12:03:03', '2019-08-30 12:03:03'),
(96, 'AC1879258907', '200.00', '0.00', 'Match', 'Match Sales Bonus in  and  on 2019-08-30 12:08:57', '2019-08-30 12:08:57'),
(97, 'AC1879258907', '600.00', '0.00', 'Match', 'Match Sales Bonus in  and  on 2019-08-30 12:08:57', '2019-08-30 12:08:57'),
(98, 'AC1879258907', '200.00', '0.00', 'Match', 'Match Sales Bonus in AC1BE1A0D68A and AC1BE1A0D68A on 2019-08-30 12:09:56', '2019-08-30 12:09:56'),
(99, 'AC1879258907', '600.00', '0.00', 'Match', 'Match Sales Bonus in AC19082307591212 and AC19082307591212 on 2019-08-30 12:09:56', '2019-08-30 12:09:56'),
(100, 'AC1879258907', '200.00', '0.00', 'Match', 'Match Sales Bonus in AC1BE1A0D68A and AC1BE1A0D68A on 2019-08-30 12:12:56', '2019-08-30 12:12:56'),
(101, 'AC1879258907', '600.00', '0.00', 'Match', 'Match Sales Bonus in AC19082307591212 and AC19082307591212 on 2019-08-30 12:12:56', '2019-08-30 12:12:56'),
(102, 'AC19082807201912', '3333.33', '0.00', 'ProfitShare', 'AC19082807201912 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(103, 'AC19082603020313', '3333.33', '0.00', 'ProfitShare', 'AC19082603020313 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(104, 'AC19082307591212', '3333.33', '0.00', 'ProfitShare', 'AC19082307591212 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(105, 'AC1879258907', '123.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:27:06', '2019-08-30 14:27:06'),
(106, 'AC1879258907', '123.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:28:29', '2019-08-30 14:28:29'),
(107, 'AC1879258907', '5000.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:36:31', '2019-08-30 14:36:31'),
(108, 'AC1879258907', '123.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:37:48', '2019-08-30 14:37:48'),
(109, 'AC1879258907', '0.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:54:39', '2019-08-30 14:54:39'),
(110, 'AC1879258907', '100.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 14:58:25', '2019-08-30 14:58:25'),
(111, 'AC1879258907', '0.00', '5000.00', 'Encashment', 'Reward earned adjustment on 2019-08-30 15:00:52', '2019-08-30 15:00:52'),
(112, 'AC1879258907', '0.00', '0.00', 'Encashment', 'Reward earned adjustment on 2019-08-30 15:01:09', '2019-08-30 15:01:09'),
(113, 'AC1879258907', '1000.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 15:03:26', '2019-08-30 15:03:26'),
(114, 'AC1879258907', '2500.00', '0.00', 'Encashment', 'Request payout approved on 2019-08-30 15:08:24', '2019-08-30 15:08:24'),
(115, 'AC1879258907', '0.00', '1000.00', 'Encashment', 'Reward earned adjustment on 2019-08-30 15:12:23', '2019-08-30 15:12:23'),
(116, 'AC19082307591212', '883.67', '0.00', 'ProfitShare', 'AC19082307591212 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(117, 'AC19082807201912', '883.67', '0.00', 'ProfitShare', 'AC19082807201912 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(118, 'AC19082603020313', '883.67', '0.00', 'ProfitShare', 'AC19082603020313 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(119, 'AC19082807201912', '166.67', '0.00', 'ProfitShare', 'AC19082807201912 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(120, 'AC19082307591212', '166.67', '0.00', 'ProfitShare', 'AC19082307591212 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(121, 'AC19082603020313', '166.67', '0.00', 'ProfitShare', 'AC19082603020313 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(122, 'AC19082807201912', '0.67', '0.00', 'ProfitShare', 'AC19082807201912 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(123, 'AC19082603020313', '0.67', '0.00', 'ProfitShare', 'AC19082603020313 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(124, 'AC19082307591212', '0.67', '0.00', 'ProfitShare', 'AC19082307591212 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(125, 'AC19082603020313', '16.67', '0.00', 'ProfitShare', 'AC19082603020313 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(126, 'AC19082807201912', '16.67', '0.00', 'ProfitShare', 'AC19082807201912 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(127, 'AC19082307591212', '16.67', '0.00', 'ProfitShare', 'AC19082307591212 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(128, 'AC1879258907', '0.00', '1200.00', 'Encashment', 'Reward earned adjustment on 2019-09-02 11:34:21', '2019-09-02 11:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `LogId` int(11) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `DateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`LogId`, `Description`, `DateCreated`) VALUES
(1, 'AC19082210574214 added referral to AC1879258907', '2019-08-22 10:57:55'),
(2, 'ACDA68ED3E35 added referral to AC1879258907', '2019-08-23 07:59:43'),
(3, 'ACE27AF28054 added referral to AC1879258907', '2019-08-23 07:59:53'),
(4, 'AC19082307591212 added referral to AC1879258907', '2019-08-23 07:59:59'),
(5, 'AC1879258907 earned Match sale bonus from AC12 and AC14', '2019-08-26 02:16:20'),
(6, 'new account created AC19082603020313 on 2019-08-26 03:02:03', '2019-08-26 03:02:03'),
(7, 'code updated and used by AC19082603020313 on 2019-08-26 03:02:03', '2019-08-26 03:02:03'),
(8, 'new added network AC19082603020313 on 2019-08-26 03:02:03', '2019-08-26 03:02:03'),
(9, 'Earned from new member AC19082603020313 on 2019-08-26 03:02:03', '2019-08-26 03:02:03'),
(10, 'new account created AC19082807201912 on 2019-08-28 07:20:19', '2019-08-28 07:20:19'),
(11, 'code updated and used by AC19082807201912 on 2019-08-28 07:20:19', '2019-08-28 07:20:19'),
(12, 'new added network AC19082807201912 on 2019-08-28 07:20:19', '2019-08-28 07:20:19'),
(13, 'Earned from new member AC19082807201912 on 2019-08-28 07:20:19', '2019-08-28 07:20:19'),
(14, 'new account created AC19082807202412 on 2019-08-28 07:20:24', '2019-08-28 07:20:24'),
(15, 'code updated and used by AC19082807202412 on 2019-08-28 07:20:24', '2019-08-28 07:20:24'),
(16, 'new added network AC19082807202412 on 2019-08-28 07:20:24', '2019-08-28 07:20:24'),
(17, 'Earned from new member AC19082807202412 on 2019-08-28 07:20:24', '2019-08-28 07:20:24'),
(18, 'new account created AC19082807203112 on 2019-08-28 07:20:31', '2019-08-28 07:20:31'),
(19, 'code updated and used by AC19082807203112 on 2019-08-28 07:20:31', '2019-08-28 07:20:31'),
(20, 'new added network AC19082807203112 on 2019-08-28 07:20:31', '2019-08-28 07:20:31'),
(21, 'Earned from new member AC19082807203112 on 2019-08-28 07:20:31', '2019-08-28 07:20:31'),
(22, 'new account created AC19082807203712 on 2019-08-28 07:20:37', '2019-08-28 07:20:37'),
(23, 'code updated and used by AC19082807203712 on 2019-08-28 07:20:37', '2019-08-28 07:20:37'),
(24, 'new added network AC19082807203712 on 2019-08-28 07:20:37', '2019-08-28 07:20:37'),
(25, 'Earned from new member AC19082807203712 on 2019-08-28 07:20:37', '2019-08-28 07:20:37'),
(26, 'new account created AC19082807204312 on 2019-08-28 07:20:43', '2019-08-28 07:20:43'),
(27, 'code updated and used by AC19082807204312 on 2019-08-28 07:20:43', '2019-08-28 07:20:43'),
(28, 'new added network AC19082807204312 on 2019-08-28 07:20:43', '2019-08-28 07:20:43'),
(29, 'Earned from new member AC19082807204312 on 2019-08-28 07:20:43', '2019-08-28 07:20:43'),
(30, 'AC19082807201912 added referral to ACDA68ED3E35', '2019-08-28 07:21:04'),
(31, 'AC19082807202412 added referral to ACDA68ED3E35', '2019-08-28 07:21:11'),
(32, 'AC19082807203112 added referral to ACDA68ED3E35', '2019-08-28 07:21:19'),
(33, 'AC19082807203712 added referral to ACDA68ED3E35', '2019-08-28 07:21:26'),
(34, 'AC19082807204312 added referral to ACDA68ED3E35', '2019-08-28 07:21:32'),
(35, 'AC19082807201912 earned Match sale bonus from AC18 and AC19', '2019-08-28 07:31:20'),
(36, 'AC19082807201912 earned Match sale bonus from AC18 and AC19', '2019-08-28 07:33:32'),
(37, 'AC19082807201912 earned Match sale bonus from AC18 and AC19', '2019-08-28 07:34:13'),
(38, 'AC19082807202412 added referral to AC19082807201912', '2019-08-28 07:38:00'),
(39, 'AC19082807203112 added referral to AC19082807201912', '2019-08-28 07:38:10'),
(40, 'AC19082807203712 added referral to AC19082807201912', '2019-08-28 07:38:15'),
(41, 'AC19082807204312 added referral to AC19082807201912', '2019-08-28 07:38:22'),
(42, 'new account created AC19082808122612 on 2019-08-28 08:12:26', '2019-08-28 08:12:26'),
(43, 'code updated and used by AC19082808122612 on 2019-08-28 08:12:26', '2019-08-28 08:12:26'),
(44, 'new added network AC19082808122612 on 2019-08-28 08:12:26', '2019-08-28 08:12:26'),
(45, 'Earned from new member AC19082808122612 on 2019-08-28 08:12:26', '2019-08-28 08:12:26'),
(46, 'AC19082808122612 added referral to AC19082807201912', '2019-08-28 08:12:42'),
(47, 'AC19082807203712 earned ?1428.57 from Profit Share on 2019-08-28 14:07:27', '2019-08-28 14:07:27'),
(48, 'AC19082807204312 earned ?1428.57 from Profit Share on 2019-08-28 14:07:27', '2019-08-28 14:07:27'),
(49, 'AC19082807202412 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(50, 'AC19082807203112 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(51, 'AC19082808122612 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(52, 'AC19082807201912 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(53, 'AC19082603020313 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(54, 'AC19082307591212 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(55, 'AC19082210574214 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(56, 'AC2019072616315113 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(57, 'AC1BE1A0D68A earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(58, 'AC1879258907 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(59, 'ACE27AF28054 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(60, 'ACDA68ED3E35 earned ?1428.57 from Profit Share on 2019-08-28 14:07:28', '2019-08-28 14:07:28'),
(61, 'AC19082807204312 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(62, 'AC19082808122612 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(63, 'AC19082807203112 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(64, 'AC19082807203712 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(65, 'AC19082807202412 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(66, 'AC19082807201912 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(67, 'AC19082603020313 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(68, 'AC19082307591212 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(69, 'AC19082210574214 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(70, 'AC2019072616315113 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(71, 'AC1BE1A0D68A earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(72, 'AC1879258907 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(73, 'ACE27AF28054 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(74, 'ACDA68ED3E35 earned P357.14 from Profit Share on 2019-08-28 14:11:25', '2019-08-28 14:11:25'),
(75, 'AC19082808122612 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(76, 'AC19082807203712 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(77, 'AC19082807204312 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(78, 'AC19082807203112 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(79, 'AC19082807202412 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(80, 'AC19082807201912 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(81, 'AC19082603020313 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(82, 'AC19082307591212 earned P1071.43 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(83, 'AC19082210574214 earned P214 from Profit Share on 2019-08-28 14:12:03', '2019-08-28 14:12:03'),
(84, 'AC2019072616315113 earned P1071.43 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(85, 'AC1BE1A0D68A earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(86, 'AC1879258907 earned P1071.43 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(87, 'ACE27AF28054 earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(88, 'ACDA68ED3E35 earned P214 from Profit Share on 2019-08-28 14:12:04', '2019-08-28 14:12:04'),
(89, 'AC19082807201912 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(90, 'AC19082808122612 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(91, 'AC19082603020313 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(92, 'AC19082807203712 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(93, 'AC19082807202412 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(94, 'AC19082307591212 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(95, 'AC2019072616315113 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(96, 'AC1879258907 earned P955.38 from Profit Share on 2019-08-28 14:16:08', '2019-08-28 14:16:08'),
(97, 'AC19082808122612 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(98, 'AC19082807202412 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(99, 'AC19082603020313 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(100, 'AC19082807203712 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(101, 'AC19082307591212 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(102, 'AC19082807201912 earned P2667.88 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(103, 'AC2019072616315113 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(104, 'AC1879258907 earned P2188 from Profit Share on 2019-08-28 14:20:29', '2019-08-28 14:20:29'),
(105, 'AC19082307591212 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(106, 'AC19082603020313 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(107, 'AC19082807201912 earned P3333.33 from Profit Share on 2019-08-30 11:45:29', '2019-08-30 11:45:29'),
(108, 'AC19082307591212 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(109, 'AC19082603020313 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(110, 'AC19082807201912 earned P-7542 from Profit Share on 2019-08-30 11:45:38', '2019-08-30 11:45:38'),
(111, 'AC19082807201912 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(112, 'AC19082603020313 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(113, 'AC19082307591212 earned P-16666.67 from Profit Share on 2019-08-30 11:46:07', '2019-08-30 11:46:07'),
(114, 'AC1879258907 earned Match sale bonus from AC15 and AC14', '2019-08-30 11:56:41'),
(115, 'AC1879258907 earned Match sale bonus from AC12 and AC13', '2019-08-30 12:03:03'),
(116, 'AC1879258907 earned Match sale bonus from AC15 and AC14', '2019-08-30 12:03:03'),
(117, 'AC1879258907 earned Match sale bonus from  and ', '2019-08-30 12:08:57'),
(118, 'AC1879258907 earned Match sale bonus from  and ', '2019-08-30 12:08:57'),
(119, 'AC1879258907 earned Match sale bonus from AC1BE1A0D68A and AC1BE1A0D68A', '2019-08-30 12:09:56'),
(120, 'AC1879258907 earned Match sale bonus from AC19082307591212 and AC19082307591212', '2019-08-30 12:09:56'),
(121, 'AC1879258907 earned Match sale bonus from AC1BE1A0D68A and AC1BE1A0D68A', '2019-08-30 12:12:56'),
(122, 'AC1879258907 earned Match sale bonus from AC19082307591212 and AC19082307591212', '2019-08-30 12:12:56'),
(123, 'AC19082807201912 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(124, 'AC19082603020313 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(125, 'AC19082307591212 earned P3333.33 from Profit Share on 2019-08-30 12:47:26', '2019-08-30 12:47:26'),
(126, 'Request payout approved on 2019-08-30 14:27:06', '2019-08-30 14:27:06'),
(127, 'Request payout approved on 2019-08-30 14:28:29', '2019-08-30 14:28:29'),
(128, 'Request payout approved on 2019-08-30 14:36:31', '2019-08-30 14:36:31'),
(129, 'Request payout approved on 2019-08-30 14:37:48', '2019-08-30 14:37:48'),
(130, 'Request payout approved on 2019-08-30 14:54:39', '2019-08-30 14:54:39'),
(131, 'Request payout approved on 2019-08-30 14:58:25', '2019-08-30 14:58:25'),
(132, 'Request payout approved on 2019-08-30 15:03:26', '2019-08-30 15:03:26'),
(133, 'Request payout approved on 2019-08-30 15:08:24', '2019-08-30 15:08:24'),
(134, 'AC19082307591212 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(135, 'AC19082807201912 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(136, 'AC19082603020313 earned P883.67 from Profit Share on 2019-09-02 11:29:20', '2019-09-02 11:29:20'),
(137, 'AC19082807201912 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(138, 'AC19082307591212 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(139, 'AC19082603020313 earned P166.67 from Profit Share on 2019-09-02 11:32:15', '2019-09-02 11:32:15'),
(140, 'AC19082807201912 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(141, 'AC19082603020313 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(142, 'AC19082307591212 earned P0.67 from Profit Share on 2019-09-02 11:32:26', '2019-09-02 11:32:26'),
(143, 'AC19082603020313 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(144, 'AC19082807201912 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35'),
(145, 'AC19082307591212 earned P16.67 from Profit Share on 2019-09-02 11:32:35', '2019-09-02 11:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `matchingpair`
--

CREATE TABLE `matchingpair` (
  `MatchingPairId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `LeftMember` varchar(250) NOT NULL,
  `RightMember` varchar(250) NOT NULL,
  `PlaceNumber` int(11) NOT NULL,
  `IsExcluded` tinyint(1) NOT NULL DEFAULT 0,
  `DateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matchingpair`
--

INSERT INTO `matchingpair` (`MatchingPairId`, `AccountId`, `LeftMember`, `RightMember`, `PlaceNumber`, `IsExcluded`, `DateCreated`) VALUES
(19, 11, '12', '13', 1, 0, '2019-08-30 12:12:56'),
(20, 11, '15', '14', 2, 0, '2019-08-30 12:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `mvp`
--

CREATE TABLE `mvp` (
  `MvpId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `FromAccountId` int(11) NOT NULL,
  `Points` int(11) NOT NULL DEFAULT 1,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mvp`
--

INSERT INTO `mvp` (`MvpId`, `AccountId`, `FromAccountId`, `Points`, `DateCreated`) VALUES
(46, 11, 12, 1, '2019-08-30'),
(47, 11, 13, 3, '2019-08-30'),
(48, 11, 15, 15, '2019-08-30'),
(49, 11, 14, 1, '2019-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `network`
--

CREATE TABLE `network` (
  `NetworkId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `ParentId` int(11) DEFAULT NULL,
  `Position` varchar(10) DEFAULT NULL,
  `DateAssigned` datetime DEFAULT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network`
--

INSERT INTO `network` (`NetworkId`, `AccountId`, `ParentId`, `Position`, `DateAssigned`, `Status`) VALUES
(4, 9, NULL, '1', '2019-08-23 11:06:49', ''),
(5, 10, 15, '1', '2019-08-23 11:07:27', ''),
(6, 11, 9, '1', NULL, ''),
(7, 12, 11, '2', '2019-08-23 08:25:36', ''),
(8, 13, 11, '1', '2019-08-23 08:25:23', ''),
(9, 14, 13, '1', '2019-08-23 08:25:48', ''),
(10, 15, 12, '1', '2019-08-23 11:07:21', ''),
(11, 16, NULL, NULL, NULL, ''),
(12, 17, NULL, NULL, NULL, ''),
(13, 18, 20, '2', '2019-08-28 07:23:59', ''),
(14, 19, 21, '1', '2019-08-28 07:23:54', ''),
(15, 20, 17, '2', '2019-08-28 07:23:46', ''),
(16, 21, 17, '1', '2019-08-28 07:23:39', ''),
(17, 22, 20, '1', '2019-08-28 08:16:23', '');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `PackageId` int(11) NOT NULL,
  `PackageName` varchar(250) NOT NULL,
  `MVP` decimal(11,2) NOT NULL,
  `Cost` decimal(11,2) NOT NULL,
  `MaxProfitSharing` decimal(11,2) NOT NULL,
  `MaxProfitSharingWeekly` decimal(11,2) NOT NULL,
  `DirectSalesBonus` decimal(11,2) NOT NULL,
  `MatchSalesBonus` decimal(11,2) NOT NULL,
  `MatchSalesBonusDailyIncome` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`PackageId`, `PackageName`, `MVP`, `Cost`, `MaxProfitSharing`, `MaxProfitSharingWeekly`, `DirectSalesBonus`, `MatchSalesBonus`, `MatchSalesBonusDailyIncome`) VALUES
(1, 'Starter Package A', '1.00', '1500.00', '2000.00', '2000.00', '150.00', '200.00', '3000.00'),
(2, 'Starter Package B', '1.00', '1000.00', '2000.00', '2000.00', '150.00', '200.00', '3000.00'),
(3, 'Premium Package A', '3.00', '4500.00', '6000.00', '6000.00', '450.00', '600.00', '6000.00'),
(4, 'Premium Package B', '3.00', '3000.00', '6000.00', '6000.00', '450.00', '600.00', '6000.00'),
(5, 'Platinum Package A', '7.00', '10500.00', '14000.00', '14000.00', '750.00', '1400.00', '12000.00'),
(6, 'Platinum Package B', '7.00', '7000.00', '14000.00', '14000.00', '750.00', '1400.00', '12000.00'),
(7, 'Titanium Package A', '15.00', '22500.00', '30000.00', '30000.00', '1050.00', '3000.00', '18000.00'),
(8, 'Titanium Package B', '15.00', '15000.00', '30000.00', '30000.00', '1050.00', '3000.00', '18000.00');

-- --------------------------------------------------------

--
-- Table structure for table `payout`
--

CREATE TABLE `payout` (
  `PayoutId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `Fullname` varchar(250) DEFAULT NULL,
  `TransactionType` varchar(50) NOT NULL,
  `AccountNumber` varchar(250) DEFAULT NULL,
  `AccountName` varchar(250) DEFAULT NULL,
  `Amount` decimal(11,2) NOT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Contact` varchar(250) DEFAULT NULL,
  `Email` varchar(250) NOT NULL,
  `Message` varchar(250) DEFAULT NULL,
  `DateCreated` datetime NOT NULL,
  `IsApproved` tinyint(1) NOT NULL,
  `DateApproved` datetime DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payout`
--

INSERT INTO `payout` (`PayoutId`, `AccountId`, `Fullname`, `TransactionType`, `AccountNumber`, `AccountName`, `Amount`, `Address`, `Contact`, `Email`, `Message`, `DateCreated`, `IsApproved`, `DateApproved`, `IsActive`) VALUES
(1, 11, 'NINO ALCUINO', '', '465464654654646', 'NINO ALCUINO', '5000.00', 'Pardo Cebu city', '09494160011', '', NULL, '2019-08-30 13:26:45', 1, '2019-08-30 14:36:31', 0),
(2, 11, 'NINO', '', '123', '1123', '123.00', 'Pardo', '12321', '', 'test', '2019-08-30 13:41:35', 1, '2019-08-30 14:28:29', 1),
(3, 11, 'ads', '', '21321', '123213', '123.00', 'Pardo', '123', '', NULL, '2019-08-30 14:37:17', 1, '2019-08-30 14:37:48', 1),
(4, 11, '123', '', '213', '123', '21321312.00', 'Pardo', '123213', '', NULL, '2019-08-30 14:45:37', 1, '2019-08-30 14:54:39', 0),
(5, 11, '12321', '', '123213', '123213', '100.00', 'Pardo', '123213', '', NULL, '2019-08-30 14:47:41', 1, '2019-08-30 14:58:25', 1),
(6, 11, 'asd', '', 'asd', 'asd', '1000.00', 'Pardo', '12321321', '', NULL, '2019-08-30 15:02:48', 1, '2019-08-30 15:03:26', 0),
(7, 11, '213', '', '123213', '21321', '2500.00', 'Pardo', 'asdsad1232123', '', NULL, '2019-08-30 15:08:12', 1, '2019-08-30 15:08:24', 1),
(8, 11, 'asd', '', '123', '123', '1200.00', 'Pardo', '213213', '', NULL, '2019-08-30 15:21:56', 0, NULL, 0),
(9, 9, 'NINO', '', '', '', '2000.00', 'PArdo', '09494160011', '', NULL, '2019-09-02 12:45:12', 0, NULL, 1),
(10, 9, 'NINO ALCUINO 1231232132ALCUINO ALCUINO ALCUINO ALCUINO ALC13', '', '', '', '1200.00', 'Pardo', '09', 'alcuinon@gmail.com', NULL, '2019-09-02 12:49:42', 0, NULL, 1),
(11, 9, 'asd', '', '123', '123', '123.00', 'Pardo', '123', 'alcuinon@gmail.com', NULL, '2019-09-02 13:02:39', 0, NULL, 1),
(12, 9, 'asd', '', '', '', '1321.00', '123213', '21321', 'alcuinon@gmail.com', NULL, '2019-09-02 13:03:19', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `PointId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `LeftPoints` int(11) NOT NULL,
  `RightPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`PointId`, `AccountId`, `LeftPoints`, `RightPoints`) VALUES
(17, 11, 1, 3),
(18, 11, -1, -1),
(19, 11, 15, 1),
(20, 11, -3, -3);

-- --------------------------------------------------------

--
-- Table structure for table `profitshare`
--

CREATE TABLE `profitshare` (
  `ProfitShareId` int(11) NOT NULL,
  `Share` decimal(11,2) NOT NULL,
  `ShareEachMember` decimal(11,0) NOT NULL,
  `MemberCount` int(11) NOT NULL,
  `DateCreated` datetime NOT NULL,
  `DatePosted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profitshare`
--

INSERT INTO `profitshare` (`ProfitShareId`, `Share`, `ShareEachMember`, `MemberCount`, `DateCreated`, `DatePosted`) VALUES
(1, '20000.00', '1429', 14, '2019-08-28 10:57:14', '2019-08-28'),
(2, '5000.00', '357', 14, '2019-08-28 14:11:19', '2019-08-28'),
(3, '15000.00', '1071', 14, '2019-08-28 14:11:52', '2019-08-28'),
(4, '10000.00', '3333', 3, '2019-08-28 14:12:10', '2019-08-30'),
(5, '7643.00', '955', 8, '2019-08-28 14:16:01', '2019-08-28'),
(6, '21343.00', '2668', 8, '2019-08-28 14:20:25', '2019-08-28'),
(7, '-22626.00', '-7542', 3, '2019-08-30 11:45:35', '2019-08-30'),
(8, '-50000.00', '-16667', 3, '2019-08-30 11:46:05', '2019-08-30'),
(9, '10000.00', '3333', 3, '2019-08-30 12:47:24', '2019-08-30'),
(10, '2651.00', '884', 3, '2019-09-02 11:29:16', '2019-09-02'),
(11, '500.00', '167', 3, '2019-09-02 11:32:10', '2019-09-02'),
(12, '2.00', '1', 3, '2019-09-02 11:32:22', '2019-09-02'),
(13, '50.00', '17', 3, '2019-09-02 11:32:32', '2019-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `ReferralId` int(11) NOT NULL,
  `AccountId` int(11) NOT NULL,
  `ReferredById` int(11) NOT NULL,
  `InBinary` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `Fullname` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` text NOT NULL,
  `IsActive` tinyint(1) NOT NULL DEFAULT 1,
  `IsUserModeDebug` tinyint(1) NOT NULL DEFAULT 0,
  `IsAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `DateCreated` datetime NOT NULL,
  `Rank` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `Fullname`, `Username`, `Password`, `IsActive`, `IsUserModeDebug`, `IsAdmin`, `DateCreated`, `Rank`) VALUES
(1, 'Nino Alcuino', 'admin', 'fa82fb708ccd005eae73d04728187889', 1, 0, 1, '2019-06-03 19:34:07', ''),
(2, 'Nino Alcuino', 'admin1', '5b62e8a70ed08a756995a624d5831351', 1, 0, 1, '2019-06-03 19:38:06', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UsersId` int(11) NOT NULL,
  `Id` varchar(250) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `EmailVerified` tinyint(1) NOT NULL,
  `Picture` varchar(250) NOT NULL,
  `LastSeen` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsersId`, `Id`, `Fullname`, `Email`, `EmailVerified`, `Picture`, `LastSeen`) VALUES
(12, '117348394121817064173', 'Niño Alcuino', 'alcuinon@gmail.com', 1, 'https://lh3.googleusercontent.com/a-/AAuE7mBkd6B-zOF_qjuKHRHLaBKBI2lQmuPHPL-pHj3HxA=s96-c', '2019-09-03 07:06:12'),
(13, '100985604087755101398', 'Nian Alquez', 'act.nian@gmail.com', 1, 'https://lh3.googleusercontent.com/a-/AAuE7mBoLiWjeVmDwI4jZUeLyFMYTIDvUZYIOSDF-tK-=s96-c', '2019-09-02 11:03:49'),
(14, '108583176610315141461', 'Niño Alcuino', 'systemax.alcuino@gmail.com', 1, 'https://lh3.googleusercontent.com/-OdveGxgOB2c/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rctgAWx63ObOOjakau27tbjo0msTA/s96-c/photo.jpg', '2019-08-23 06:47:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountId`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`CodeId`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`EarnId`);

--
-- Indexes for table `incentivepoints`
--
ALTER TABLE `incentivepoints`
  ADD PRIMARY KEY (`IncentivePointId`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`LedgerId`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`LogId`);

--
-- Indexes for table `matchingpair`
--
ALTER TABLE `matchingpair`
  ADD PRIMARY KEY (`MatchingPairId`);

--
-- Indexes for table `mvp`
--
ALTER TABLE `mvp`
  ADD PRIMARY KEY (`MvpId`);

--
-- Indexes for table `network`
--
ALTER TABLE `network`
  ADD PRIMARY KEY (`NetworkId`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `payout`
--
ALTER TABLE `payout`
  ADD PRIMARY KEY (`PayoutId`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`PointId`);

--
-- Indexes for table `profitshare`
--
ALTER TABLE `profitshare`
  ADD PRIMARY KEY (`ProfitShareId`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`ReferralId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UsersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `AccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `CodeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `EarnId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `incentivepoints`
--
ALTER TABLE `incentivepoints`
  MODIFY `IncentivePointId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `LedgerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `LogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `matchingpair`
--
ALTER TABLE `matchingpair`
  MODIFY `MatchingPairId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mvp`
--
ALTER TABLE `mvp`
  MODIFY `MvpId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `network`
--
ALTER TABLE `network`
  MODIFY `NetworkId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `PackageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payout`
--
ALTER TABLE `payout`
  MODIFY `PayoutId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `PointId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `profitshare`
--
ALTER TABLE `profitshare`
  MODIFY `ProfitShareId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `ReferralId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UsersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
