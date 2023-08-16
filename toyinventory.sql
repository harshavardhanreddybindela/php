-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 04:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toyinventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`name`, `password`) VALUES
('admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `iybigiftinventory`
--

CREATE TABLE `iybigiftinventory` (
  `GiftId` int(11) NOT NULL,
  `GiftName` varchar(100) NOT NULL,
  `GiftPrice` decimal(10,2) NOT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedDate` date DEFAULT NULL,
  `ModifiedBy` varchar(50) NOT NULL,
  `ModifiedDate` date DEFAULT NULL,
  `available_quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iybigiftinventory`
--

INSERT INTO `iybigiftinventory` (`GiftId`, `GiftName`, `GiftPrice`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `available_quantity`) VALUES
(12, 'Airplane Toy', 107.79, '', NULL, '', NULL, 1),
(13, 'Kitchen Kit', 105.60, '', NULL, '', NULL, 1),
(14, 'SLU Logo Toy', 94.64, '', NULL, '', NULL, 0),
(15, 'Action Figure', 46.39, '', NULL, '', NULL, 3),
(16, 'Billiken Toy', 38.05, '', NULL, '', NULL, 1),
(17, 'Ludo', 41.07, '', NULL, '', NULL, 1),
(18, 'Building Blocks', 81.18, '', NULL, '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `iybigiftsin`
--

CREATE TABLE `iybigiftsin` (
  `Id` int(11) NOT NULL,
  `GiftReceivingStatus` varchar(50) NOT NULL,
  `GiftReceivedDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `GiftId` int(11) NOT NULL,
  `GiftName` varchar(100) NOT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedDate` date DEFAULT NULL,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `ModifiedDate` varchar(50) DEFAULT NULL,
  `GiftPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iybigiftsin`
--

INSERT INTO `iybigiftsin` (`Id`, `GiftReceivingStatus`, `GiftReceivedDate`, `GiftId`, `GiftName`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`, `GiftPrice`) VALUES
(1, 'Donated', '2023-08-15 23:10:34', 1, 'Kitchen Kit', '', NULL, NULL, NULL, 105.60),
(2, 'Donated', '2023-08-15 23:10:34', 2, 'Action Figure', '', NULL, NULL, NULL, 46.39),
(3, 'Donated', '2023-08-15 23:10:34', 2, 'Action Figure', '', NULL, NULL, NULL, 46.39),
(4, 'Purchased', '2023-08-15 23:10:34', 4, 'Building Blocks', '', NULL, NULL, NULL, 81.18),
(6, 'Purchased', '2023-08-15 23:10:34', 6, 'Ludo', '', NULL, NULL, NULL, 41.07),
(9, 'Donated', '2023-08-15 23:10:34', 11, 'SLU Logo Toy', '', NULL, NULL, NULL, 94.64),
(10, 'Purchased', '2023-08-09 05:00:00', 15, 'Action Figure', '', NULL, NULL, NULL, 46.39);

-- --------------------------------------------------------

--
-- Table structure for table `iybigiftsout`
--

CREATE TABLE `iybigiftsout` (
  `Id` int(11) NOT NULL,
  `GiftId` int(11) NOT NULL,
  `GiftName` varchar(100) NOT NULL,
  `Shelter` varchar(100) NOT NULL,
  `KiddoDOB` date NOT NULL,
  `KiddoGender` varchar(10) NOT NULL,
  `DateOfDelivery` date NOT NULL,
  `BirthdayHeroName` varchar(100) NOT NULL,
  `GiftOutTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedDate` date DEFAULT NULL,
  `ModifiedBy` varchar(50) NOT NULL,
  `ModifiedDate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `iybigiftsout`
--

INSERT INTO `iybigiftsout` (`Id`, `GiftId`, `GiftName`, `Shelter`, `KiddoDOB`, `KiddoGender`, `DateOfDelivery`, `BirthdayHeroName`, `GiftOutTime`, `CreatedBy`, `CreatedDate`, `ModifiedBy`, `ModifiedDate`) VALUES
(1, 5, 'Remote Control Car ', 'SLU', '2023-07-31', 'male', '2023-08-07', 'Harsha', '2023-08-15 22:57:39', '', NULL, '', NULL),
(2, 14, 'SLU Logo Toy', 'SLU', '2023-08-01', 'male', '2023-08-02', 'Harsha', '2023-08-16 13:29:35', '', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iybi kiddo information`
--

CREATE TABLE `iybi kiddo information` (
  `BirthdayHeroName` varchar(100) NOT NULL,
  `KiddoDOB` date NOT NULL,
  `KiddoGender` varchar(10) NOT NULL,
  `DateOfDelivery` date NOT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedDate` date DEFAULT NULL,
  `ModifiedBy` varchar(50) NOT NULL,
  `ModifiedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iybishelter`
--

CREATE TABLE `iybishelter` (
  `ShelterName` varchar(100) NOT NULL,
  `CreatedBy` varchar(50) NOT NULL,
  `CreatedDate` date DEFAULT NULL,
  `ModifiedBy` varchar(50) NOT NULL,
  `ModifiedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iybigiftinventory`
--
ALTER TABLE `iybigiftinventory`
  ADD PRIMARY KEY (`GiftId`);

--
-- Indexes for table `iybigiftsin`
--
ALTER TABLE `iybigiftsin`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_articles_users1` (`GiftId`);

--
-- Indexes for table `iybigiftsout`
--
ALTER TABLE `iybigiftsout`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `GiftId` (`GiftId`),
  ADD KEY `idx_iybigiftsout_BirthdayHeroName` (`BirthdayHeroName`);

--
-- Indexes for table `iybi kiddo information`
--
ALTER TABLE `iybi kiddo information`
  ADD KEY `fk_iybi kiddo infdormation_users1` (`BirthdayHeroName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iybigiftinventory`
--
ALTER TABLE `iybigiftinventory`
  MODIFY `GiftId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `iybigiftsin`
--
ALTER TABLE `iybigiftsin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `iybigiftsout`
--
ALTER TABLE `iybigiftsout`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `iybigiftsin`
--
ALTER TABLE `iybigiftsin`
  ADD CONSTRAINT `fk_articles_users1` FOREIGN KEY (`GiftId`) REFERENCES `iybigiftinventory` (`GiftId`);

--
-- Constraints for table `iybigiftsout`
--
ALTER TABLE `iybigiftsout`
  ADD CONSTRAINT `iybigiftsout_ibfk_1` FOREIGN KEY (`GiftId`) REFERENCES `iybigiftinventory` (`GiftId`);

--
-- Constraints for table `iybi kiddo information`
--
ALTER TABLE `iybi kiddo information`
  ADD CONSTRAINT `fk_iybi kiddo infdormation_users1` FOREIGN KEY (`BirthdayHeroName`) REFERENCES `iybigiftsout` (`BirthdayHeroName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
