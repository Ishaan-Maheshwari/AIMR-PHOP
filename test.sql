-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 03:59 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `test_multi_sets`()
    DETERMINISTIC
begin
        select user() as first_col;
        select user() as first_col, now() as second_col;
        select user() as first_col, now() as second_col, now() as third_col;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `Categ_id` int(11) NOT NULL AUTO_INCREMENT,
  `Categ_name` varchar(20) NOT NULL DEFAULT 'Category',
  `SubCateg_name` varchar(20) NOT NULL DEFAULT 'Sub Category',
  `Item_count` int(6) NOT NULL,
  `img_link` text,
  PRIMARY KEY (`Categ_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Categ_id`, `Categ_name`, `SubCateg_name`, `Item_count`, `img_link`) VALUES
(1, 'Books', 'Fiction', 1, 'products/cake-plain.jpg'),
(3, 'Books', 'Science', 1, 'products/cake-plain.jpg'),
(4, 'Vehicles', 'Cars', 1, 'products/cake-plain.jpg'),
(5, 'Vehicles', 'Cycles', 1, 'products/cake-plain.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `ItemId` int(10) NOT NULL AUTO_INCREMENT,
  `ItemLocation` varchar(20) NOT NULL,
  `ItemStatus` varchar(10) DEFAULT NULL,
  `RentPrice` int(5) NOT NULL DEFAULT '0',
  `SellPrice` int(8) NOT NULL DEFAULT '0',
  `ItemName` varchar(30) NOT NULL,
  `Owner` int(5) NOT NULL,
  `ItemCateg` int(11) NOT NULL,
  `Itemdesc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ItemId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemId`, `ItemLocation`, `ItemStatus`, `RentPrice`, `SellPrice`, `ItemName`, `Owner`, `ItemCateg`, `Itemdesc`) VALUES
(1, 'Aligarh', 'AVAILABLE', 15, 200, 'lava zen', 2, 2, 'very good mobile'),
(2, 'Aligarh', 'AVAILABLE', 0, 0, 'laotop make in india', 0, 0, 'very good laptop'),
(3, 'Aligarh', 'AVAILABLE', 1000, 120000, '', 0, 0, NULL),
(4, 'Aligarh', 'AVAILABLE', 10, 5000, '', 0, 0, NULL),
(6, 'Aligarh', 'AVAILABLE', 12, 13, 'EffectiveJS', 1, 3, 'very good book'),
(7, 'Aligarh', 'AVAILABLE', 10, 250, 'ODE Zafar Ahsan', 1, 1, 'New Book for maths students.');

-- --------------------------------------------------------

--
-- Table structure for table `logintable`
--

CREATE TABLE IF NOT EXISTS `logintable` (
  `User_ID` int(5) NOT NULL AUTO_INCREMENT,
  `Name` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `Location` text,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `logintable`
--

INSERT INTO `logintable` (`User_ID`, `Name`, `email`, `pass`, `Location`) VALUES
(1, 'Ishaan', 'ishaan@gmail.com', 'abc123', 'Aligarh'),
(2, 'Manish', 'manish@gmail.com', 'abc123', 'Aligarh'),
(3, 'Ayan', 'ayankhan@gmail.com', 'abc123', 'Aligarh'),
(4, 'Ranjeet', 'ranjeet@gmail.com', 'abc123', 'Aligarh');

-- --------------------------------------------------------

--
-- Table structure for table `rentdb`
--

CREATE TABLE IF NOT EXISTS `rentdb` (
  `logid` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) DEFAULT NULL,
  `owner_id` int(5) DEFAULT NULL,
  `rentedto` int(5) DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requestlog`
--

CREATE TABLE IF NOT EXISTS `requestlog` (
  `ReqId` int(10) NOT NULL AUTO_INCREMENT,
  `ReqAction` varchar(8) DEFAULT NULL,
  `ReqStatus` varchar(10) NOT NULL,
  `ReqBy` int(5) NOT NULL,
  `ReqItem` int(10) NOT NULL,
  `ItemOwner` int(5) NOT NULL,
  PRIMARY KEY (`ReqId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `requestlog`
--

INSERT INTO `requestlog` (`ReqId`, `ReqAction`, `ReqStatus`, `ReqBy`, `ReqItem`, `ItemOwner`) VALUES
(27, 'BUY', 'PENDING', 1, 2, 2),
(28, 'RENT', 'PENDING', 1, 2, 2),
(29, 'RENT', 'PENDING', 1, 7, 1),
(30, 'BUY', 'PENDING', 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `selldb`
--

CREATE TABLE IF NOT EXISTS `selldb` (
  `logid` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) DEFAULT NULL,
  `owner_id` int(5) DEFAULT NULL,
  `soldto` int(5) DEFAULT NULL,
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
