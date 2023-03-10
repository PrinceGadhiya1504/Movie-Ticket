-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 04:37 PM
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
(34, 30, 'A1'),
(35, 30, 'A2'),
(36, 31, 'A3'),
(37, 31, 'A4'),
(38, 32, 'A3'),
(39, 32, 'A4'),
(40, 32, 'B3'),
(41, 32, 'B4'),
(42, 32, 'C4'),
(43, 32, 'D4'),
(44, 32, 'F4'),
(45, 32, 'F2'),
(46, 32, 'E2'),
(47, 32, 'E1'),
(48, 32, 'D1'),
(49, 32, 'C1'),
(50, 32, 'B1'),
(51, 32, 'A1'),
(52, 32, 'A2'),
(53, 32, 'B2'),
(54, 32, 'C2'),
(55, 32, 'D2'),
(56, 32, 'F1'),
(57, 32, 'C3'),
(58, 32, 'D3'),
(59, 32, 'F3'),
(60, 32, 'E3'),
(61, 32, 'E4'),
(62, 32, 'A5'),
(63, 32, 'A6'),
(64, 32, 'B6'),
(65, 32, 'B5'),
(66, 32, 'C5'),
(67, 32, 'C6'),
(68, 32, 'D6'),
(69, 32, 'D5'),
(70, 32, 'E5'),
(71, 32, 'E6'),
(72, 32, 'F6');

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
(30, 0, 2, 8, '2023-03-04 00:00:00', '2023-03-04', '9:00 AM', 400),
(31, 0, 2, 8, '2023-03-04 00:00:00', '2023-03-04', '3:00 PM', 400),
(32, 0, 2, 8, '2023-03-04 00:00:00', '2023-03-07', '3:00 PM', 7000);

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
(8, 'Bahubali', 'In the kingdom of Mahishmati, Shivudu falls in love with a young warrior woman. While trying to woo her, he learns about the conflict-ridden past of his family and his true legacy.', '2023-03-04', 'Hind', 200, 'Bahubali.png', '9:00 AM', '3:00 PM'),
(9, 'RRR', 'A fearless revolutionary and an officer in the British force, who once shared a deep bond, decide to join forces and chart out an inspirational path of freedom against the despotic rulers.', '2022-03-24', 'Hindi', 200, 'RRR.jpg', '12:00 PM', '6:00 PM');

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
(2, 'jayesh', '$2y$10$a6jr1r9c4eRHB9brQ9/nIemOkMnH1eImULp9L.0cZB3jqFpihrCMS', '', 'jayesh', '84661334');

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `Bookings`
--
ALTER TABLE `Bookings`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `Movies`
--
ALTER TABLE `Movies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BookedSeats`
--
ALTER TABLE `BookedSeats`
  ADD CONSTRAINT `FkBookingIdInBookedSeats` FOREIGN KEY (`BookingId`) REFERENCES `Bookings` (`Id`);

--
-- Constraints for table `Bookings`
--
ALTER TABLE `Bookings`
  ADD CONSTRAINT `FkMovieIdInBookings` FOREIGN KEY (`MovieId`) REFERENCES `Movies` (`Id`),
  ADD CONSTRAINT `FkUserIdInBookings` FOREIGN KEY (`UserId`) REFERENCES `Users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
