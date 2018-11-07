-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2018 at 06:35 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_info`
--

CREATE TABLE `cart_info` (
  `No.` int(11) NOT NULL,
  `U_ID` varchar(20) NOT NULL,
  `M_ID` int(11) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `Total_Price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie_info`
--

CREATE TABLE `movie_info` (
  `M_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Language` varchar(10) NOT NULL,
  `Genre` varchar(10) NOT NULL,
  `Year` varchar(5) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `Unitprice` varchar(6) NOT NULL,
  `WholesalePrice` int(20) NOT NULL,
  `Picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie_info`
--

INSERT INTO `movie_info` (`M_ID`, `Name`, `Language`, `Genre`, `Year`, `Quantity`, `Unitprice`, `WholesalePrice`, `Picture`) VALUES
(3, 'Debi', 'English', 'Thriller', '2018', 19, '120', 110, 'movieimagesuploads/561604809debi.jpg'),
(12, 'Inception', 'English', 'Thriller', '2012', 20, '120', 110, 'movieimagesuploads/1931263746inception.jpg'),
(13, 'Intersteller', 'English', 'Sci-fi', '2014', 20, '140', 130, 'movieimagesuploads/1145783742intersteller.jpg'),
(15, 'Wall-E', 'English', 'Kids', '2008', 20, '120', 102, 'movieimagesuploads/1319094696walle.jpg'),
(19, 'Razzi - A Spy', 'Hindi', 'Thriller', '2018', 20, '110', 108, 'movieimagesuploads/874427012Raazi.jpg'),
(21, 'Avengers - Infinity War', 'English', 'Sci-fi', '2018', 19, '220', 250, 'movieimagesuploads/1764687480avngrs.jpg'),
(22, 'A Quite Place', 'English', 'Horror', '2018', 20, '180', 160, 'movieimagesuploads/1711633226aqtplc.jpg'),
(23, 'Blade Runner', 'English', 'Thriller', '2018', 20, '200', 185, 'movieimagesuploads/362619813blade-runner-2049-fire-ice_u-L-F9524N0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `Payment_ID` int(20) NOT NULL,
  `U_ID` varchar(20) NOT NULL,
  `M_ID` int(11) NOT NULL,
  `Movie_Name` varchar(50) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Unit_Price` int(10) NOT NULL,
  `Wholesale_Price` int(20) NOT NULL,
  `Total_Price` int(10) NOT NULL,
  `Wholesale_Total_Price` int(11) NOT NULL,
  `Payment_type` varchar(20) NOT NULL,
  `Date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`Payment_ID`, `U_ID`, `M_ID`, `Movie_Name`, `Quantity`, `Unit_Price`, `Wholesale_Price`, `Total_Price`, `Wholesale_Total_Price`, `Payment_type`, `Date`) VALUES
(12, 'u1', 16, 'Harry Potter And The Deathly Hollows - Part 1', 3, 130, 120, 390, 360, 'CashOnDelivery', '2018/07/20'),
(15, 'u2', 3, 'Debi', 16, 120, 100, 1920, 1600, 'CashOnDelivery', '2018/08/21'),
(26, 'u1', 3, 'Debi', 1, 120, 110, 120, 110, 'CashOnDelivery', '2018/08/21'),
(27, 'u1', 21, 'Avengers - Infinity War', 1, 220, 250, 220, 250, 'CashOnDelivery', '2018/08/21');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `U_ID` varchar(20) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `ContactNo` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Picture` varchar(200) NOT NULL,
  `Point` int(4) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`U_ID`, `Name`, `Email`, `DOB`, `Gender`, `ContactNo`, `Address`, `Picture`, `Point`, `Password`, `Usertype`) VALUES
('a', 'Sadiq Islam', 'sadiq.islam96@gmail.com', '1996-07-02', 'Male', '01685006757', 'Mirpur 12,Dhaka', 'userprofilepicturesuploads/1836216727Businessman.png', 0, 'ssssssss@', 'Admin'),
('aa', 'Tahiya Nasin', 'tn@gmail.com', '1993-07-05', 'Female', '123456', 'Mohakhali,Dhaka', 'userprofilepicturesuploads/1006565534Asian female boss.png', 0, 'aaaaaaaa@', 'Admin'),
('u1', 'Abir Ahmed', 'aa@gmail.com', '1995-07-11', 'Male', '000000000', 'Kuril,Dhaka', 'userprofilepicturesuploads/1257010870Engineer.png', 50, 'aaaaaaaa@', 'User'),
('u2', 'Arham Rashed Arin', 'bob@gmail.com', '1993-08-12', 'Male', '234234235', 'Kuril,Dhaka', 'userprofilepicturesuploads/1514251878Admin.png', 50, 'uuuuuuuu@', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_info`
--
ALTER TABLE `cart_info`
  ADD PRIMARY KEY (`No.`);

--
-- Indexes for table `movie_info`
--
ALTER TABLE `movie_info`
  ADD PRIMARY KEY (`M_ID`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`Payment_ID`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`U_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_info`
--
ALTER TABLE `cart_info`
  MODIFY `No.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `movie_info`
--
ALTER TABLE `movie_info`
  MODIFY `M_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `Payment_ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
