-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 04:29 PM
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
-- Database: `webleeddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloodcenter`
--

CREATE TABLE `bloodcenter` (
  `bcID` int(4) NOT NULL,
  `bcName` varchar(45) NOT NULL,
  `bcPhoneNo` varchar(12) NOT NULL,
  `bcBloodQtyA` int(5) DEFAULT NULL,
  `bcBloodQtyB` int(5) DEFAULT NULL,
  `bcBloodQtyO` int(5) DEFAULT NULL,
  `bcBloodQtyAB` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bloodcenter`
--

INSERT INTO `bloodcenter` (`bcID`, `bcName`, `bcPhoneNo`, `bcBloodQtyA`, `bcBloodQtyB`, `bcBloodQtyO`, `bcBloodQtyAB`) VALUES
(1001, 'Hospital Sultanah Aminah', '1234567890', 500, 300, 700, 200),
(1002, 'Hospital Tengku Ampuan Afzan', '0987654321', 400, 250, 600, 150);

-- --------------------------------------------------------

--
-- Table structure for table `bloodsample`
--

CREATE TABLE `bloodsample` (
  `sampleNo` int(4) NOT NULL,
  `bloodType` varchar(2) NOT NULL,
  `status` varchar(13) NOT NULL,
  `bcID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bloodsample`
--

INSERT INTO `bloodsample` (`sampleNo`, `bloodType`, `status`, `bcID`) VALUES
(4001, 'A', 'Available', 1001),
(4002, 'O', 'Available', 1002);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `donID` int(4) NOT NULL,
  `donPassword` varchar(20) NOT NULL,
  `donName` varchar(45) NOT NULL,
  `donGender` char(1) NOT NULL,
  `donAge` int(3) NOT NULL,
  `donBloodType` varchar(2) NOT NULL,
  `donBloodQty` int(3) NOT NULL,
  `donWeight` int(3) NOT NULL,
  `donFrequency` int(1) NOT NULL,
  `eligibleStatus` char(1) NOT NULL,
  `staffID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`donID`, `donPassword`, `donName`, `donGender`, `donAge`, `donBloodType`, `donBloodQty`, `donWeight`, `donFrequency`, `eligibleStatus`, `staffID`) VALUES
(1616, 'password', 'Amir', 'M', 27, 'A', 0, 77, 0, '', 2001),
(3001, 'donpass1', 'Mira', 'F', 30, 'A', 1, 70, 3, 'Y', 2001),
(3002, 'donpass2', 'Ali', 'M', 28, 'O', 1, 65, 2, 'Y', 2002);

-- --------------------------------------------------------

--
-- Table structure for table `healthcareprovider`
--

CREATE TABLE `healthcareprovider` (
  `hpID` int(4) NOT NULL,
  `hpPassword` varchar(20) NOT NULL,
  `sampleNo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `healthcareprovider`
--

INSERT INTO `healthcareprovider` (`hpID`, `hpPassword`, `sampleNo`) VALUES
(5001, 'hppass1', 4001),
(5002, 'hppass2', 4002);

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `rewardID` int(4) NOT NULL,
  `rewardType` int(1) NOT NULL,
  `rewardName` varchar(45) NOT NULL,
  `rewardDonFrequency` int(1) NOT NULL,
  `donID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`rewardID`, `rewardType`, `rewardName`, `rewardDonFrequency`, `donID`) VALUES
(6001, 1, '3 Outpatient treatme', 3, 3001),
(6002, 2, '1 Outpatient treatme', 2, 3002);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(4) NOT NULL,
  `staffPassword` varchar(20) NOT NULL,
  `staffName` varchar(25) NOT NULL,
  `staffPhoneNo` varchar(12) NOT NULL,
  `bcID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffPassword`, `staffName`, `staffPhoneNo`, `bcID`) VALUES
(2001, 'pass1234', 'Alia', '1112223333', 1001),
(2002, 'pass5678', 'Abu', '4445556666', 1002);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bloodcenter`
--
ALTER TABLE `bloodcenter`
  ADD PRIMARY KEY (`bcID`);

--
-- Indexes for table `bloodsample`
--
ALTER TABLE `bloodsample`
  ADD PRIMARY KEY (`sampleNo`),
  ADD KEY `BCID` (`bcID`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`donID`),
  ADD KEY `STAFFID` (`staffID`);

--
-- Indexes for table `healthcareprovider`
--
ALTER TABLE `healthcareprovider`
  ADD PRIMARY KEY (`hpID`),
  ADD KEY `SAMPLENO` (`sampleNo`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`rewardID`),
  ADD KEY `DONID` (`donID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD KEY `BCID` (`bcID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bloodsample`
--
ALTER TABLE `bloodsample`
  ADD CONSTRAINT `bloodsample_ibfk_1` FOREIGN KEY (`BCID`) REFERENCES `bloodcenter` (`BCID`);

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_ibfk_1` FOREIGN KEY (`STAFFID`) REFERENCES `staff` (`STAFFID`);

--
-- Constraints for table `healthcareprovider`
--
ALTER TABLE `healthcareprovider`
  ADD CONSTRAINT `healthcareprovider_ibfk_1` FOREIGN KEY (`SAMPLENO`) REFERENCES `bloodsample` (`SAMPLENO`);

--
-- Constraints for table `reward`
--
ALTER TABLE `reward`
  ADD CONSTRAINT `reward_ibfk_1` FOREIGN KEY (`donid`) REFERENCES `donor` (`DONID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`BCID`) REFERENCES `bloodcenter` (`BCID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
