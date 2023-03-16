-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 10:02 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MoviesDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `BookedSeats`
--

CREATE TABLE `BookedSeats` (
  `Id` int(11) NOT NULL,
  `BookingId` int(11) NOT NULL,
  `Seats` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BookedSeats`
--

INSERT INTO `BookedSeats` (`Id`, `BookingId`, `Seats`) VALUES
(1, 1, 'A1'),
(2, 1, 'A2'),
(3, 2, 'A3'),
(4, 2, 'B3'),
(5, 2, 'B4'),
(6, 3, 'A3'),
(7, 3, 'A4');

-- --------------------------------------------------------

--
-- Table structure for table `Bookings`
--

CREATE TABLE `Bookings` (
  `Id` int(11) NOT NULL,
  `IsPaid` int(1) NOT NULL DEFAULT '0',
  `UserId` int(11) NOT NULL,
  `MovieId` int(11) NOT NULL,
  `BookingDateTime` datetime NOT NULL,
  `ShowDate` date NOT NULL,
  `ShowTime` varchar(10) NOT NULL,
  `TotalPrice` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Bookings`
--

INSERT INTO `Bookings` (`Id`, `IsPaid`, `UserId`, `MovieId`, `BookingDateTime`, `ShowDate`, `ShowTime`, `TotalPrice`) VALUES
(1, 0, 2, 1, '2023-03-16 00:00:00', '2023-03-16', '9:00 AM', 500),
(2, 0, 2, 2, '2023-03-16 00:00:00', '2023-03-16', '6:00 PM', 600),
(3, 0, 2, 1, '2023-03-16 00:00:00', '2023-03-16', '3:00 PM', 500);

-- --------------------------------------------------------

--
-- Table structure for table `Movies`
--

CREATE TABLE `Movies` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `ReleaseDate` date NOT NULL,
  `Language` varchar(100) NOT NULL,
  `TicketPrice` int(11) NOT NULL,
  `ImageName` varchar(255) NOT NULL,
  `FirstShowTime` varchar(100) NOT NULL,
  `SecondShowTime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Movies`
--

INSERT INTO `Movies` (`Id`, `Name`, `Description`, `ReleaseDate`, `Language`, `TicketPrice`, `ImageName`, `FirstShowTime`, `SecondShowTime`) VALUES
(1, 'Bahubali', 'In the kingdom of Mahishmati, Shivudu falls in love with a young warrior woman. While trying to woo her, he learns about the conflict-ridden past of his family and his true legacy.', '2023-03-04', 'Hindi', 250, 'Baahubali.jpg', '9:00 AM', '3:00 PM'),
(2, 'RRR', 'A fearless revolutionary and an officer in the British force, who once shared a deep bond, decide to join forces and chart out an inspirational path of freedom against the despotic rulers.', '2022-03-24', 'Hindi', 200, 'RRR.jpg', '12:00 PM', '6:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PasswordHash` varchar(500) NOT NULL,
  `UserType` varchar(10) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `MobileNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Id`, `Username`, `PasswordHash`, `UserType`, `FullName`, `MobileNumber`) VALUES
(1, 'admin', 'admin', 'A', 'admin', '456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BookedSeats`
--
ALTER TABLE `BookedSeats`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkBookingIdInBookedSeats` (`BookingId`);

--
-- Indexes for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FkUserIdInBookings` (`UserId`),
  ADD KEY `FkMovieIdInBookings` (`MovieId`);

--
-- Indexes for table `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BookedSeats`
--
ALTER TABLE `BookedSeats`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Movies`
--
ALTER TABLE `Movies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
