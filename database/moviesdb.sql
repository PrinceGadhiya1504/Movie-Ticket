DROP DATABASE IF EXISTS `MoviesDb`;
CREATE DATABASE `MoviesDb`;
USE `MoviesDb`;

CREATE TABLE `Users`
(
    `Id` INT PRIMARY KEY AUTO_INCREMENT,
    `Username` VARCHAR(50) NOT NULL,
    `PasswordHash` VARCHAR(500) NOT NULL,
    `UserType` VARCHAR(10) NOT NULL,
    `FullName` VARCHAR(100) NOT NULL,
    `MobileNumber` VARCHAR(10) NOT NULL
);

CREATE TABLE `Movies`
(
    `Id` INT PRIMARY KEY AUTO_INCREMENT,
    `Name` VARCHAR(100) NOT NULL,
    `Description` VARCHAR(500) NOT NULL,
    `ReleaseDate` DATE NOT NULL,
    `Language` VARCHAR(100) NOT NULL,
    `TicketPrice` INT NOT NULL,
    `ImageName` VARCHAR(255) NOT NULL
);

CREATE TABLE `Bookings`
(
    `Id` INT PRIMARY KEY AUTO_INCREMENT,
    `IsPaid` INT(1) NOT NULL DEFAULT 0,
    `UserId` INT NOT NULL,
    `MovieId` INT NOT NULL,
    `BookingDateTime` DATETIME NOT NULL,
    `ShowDateTime` DATETIME NOT NULL,

    CONSTRAINT `FkUserIdInBookings` FOREIGN KEY (`UserId`) REFERENCES `Users`(`Id`),
    CONSTRAINT `FkMovieIdInBookings` FOREIGN KEY (`MovieId`) REFERENCES `Movies`(`Id`)
);

CREATE TABLE `BookedSeats`
(
    `Id` INT PRIMARY KEY AUTO_INCREMENT,
    `BookingId` INT NOT NULL,
    `Seats` VARCHAR(2) NOT NULL,

    CONSTRAINT `FkBookingIdInBookedSeats` FOREIGN KEY (`BookingId`) REFERENCES `Bookings`(`Id`)
);
