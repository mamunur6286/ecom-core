-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2018 at 01:41 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `adminuser` varchar(255) NOT NULL,
  `adminpass` varchar(255) NOT NULL,
  `adminemail` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminid`, `adminname`, `adminuser`, `adminpass`, `adminemail`, `level`) VALUES
(1, 'Mamunur', 'admin', '1234', 'admin@gmail.com', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandid` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandid`, `brand`) VALUES
(1, 'Acer'),
(2, 'Samsung'),
(3, 'Canon'),
(5, 'IPHONE6'),
(14, 'Itel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catid` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catid`, `category`) VALUES
(24, 'Wireless Mouses'),
(23, 'Mouse'),
(5, 'Laptop'),
(6, 'Air condition'),
(7, 'Computer Box.'),
(16, 'Mobile'),
(9, 'Charger'),
(22, 'Keyboard'),
(19, 'Computer'),
(18, 'Monitor'),
(15, 'Headphonj'),
(27, 'Camera'),
(28, 'Refregeration');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `customerCity` varchar(255) NOT NULL,
  `customerCountry` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`customerId`, `customerName`, `image`, `customerCity`, `customerCountry`, `address`, `email`, `phone`, `password`) VALUES
(6, 'Md Joni Islam', 'upload/d49255ff01e980adbefad72920f31e.jpg', 'Bangladesh(1500)', 'Bangladesh', 'Dabalaya,Rajarhut,Kurigram', 'joni@gmail.com', '01756722748', 'joni'),
(4, 'Manunur Rashid Mamun', 'upload/409c234a29774ce6e285f413adc8fd.jpg', 'Kurigram (1200)', 'Bangladesh', 'Textile More', 'mamunur6286@gmail.com', '01990181993', '1234'),
(5, 'Junnur Hassan', 'upload/7a6cf4b6bf51f954f934abcf8dd47d.jpg', 'Bangladesh(1300)', 'Bangladesh', 'Textile more', 'mamunur62866@gmail.com', '01730233032', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `messageId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`messageId`, `name`, `email`, `phone`, `message`, `date`, `status`) VALUES
(1, 'Md Mamunur Rashid', 'mamunur200020@gmail.com', '01730233032', 'hello viewer.', '2018-05-03 12:06:07', 1),
(2, 'Md Mamunur Rashid', 'junnur@gmail.com', '01730233032', 'hello admin.I by a product.But I have no product.', '2018-05-03 22:01:19', 1),
(4, 'Md Padar Chondro Ray', 'padar20@gmail.com', '01739384932', 'Hello,admin I am padar chondro ray .I read in computer technology at kurigram polytechnic institute.', '2018-08-07 17:41:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `productName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) DEFAULT NULL,
  `orderDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `customerId`, `productId`, `productName`, `image`, `quantity`, `price`, `orderDate`, `status`) VALUES
(16, 4, 9, 'Filter', 'c60ba8bbc5a010f94fa047a5268239.jpg', '1', '10000', '2018-08-08 16:47:31', 1),
(15, 4, 3, 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '1', '50000', '2018-08-08 16:47:31', 1),
(17, 4, 11, 'Iphone 6', 'cc008277fd49e694a0a897202923b0.jpg', '1', '50000', '2018-08-16 22:20:26', 0),
(13, 4, 4, 'Computer Box ', '74547d6c2907fc0c55b5773a150f88.jpg', '7', '1000', '2018-08-08 09:49:34', 1),
(12, 4, 3, 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '1', '50000', '2018-08-08 09:49:34', 1),
(11, 4, 5, 'Iphone 6', 'ca34bbc7c1a601970952b883173d5d.png', '1', '50000', '2018-08-08 09:43:19', 1),
(9, 4, 7, 'Camere', 'cb81f4ec30443dc792124c4962804d.png', '9', '19000', '2018-08-07 21:02:52', 1),
(10, 4, 6, 'Monitor', '662fec272bdc8456b1efde8c76dee9.jpg', '1', '8000', '2018-08-07 21:02:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(1, 'Samsung S8', 16, 2, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 10000, '453258305f641f0b4849949ea012ec.png', 0),
(2, 'Monitor', 18, 1, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 10000, 'c8e56db864707d59898bfb39c9d8bb.jpg', 0),
(3, 'Laptop', 5, 1, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 50000, '45fbda0b1cc9566b92410f5ca39ca0.jpg', 0),
(4, 'Computer Box ', 7, 2, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 1000, '74547d6c2907fc0c55b5773a150f88.jpg', 0),
(5, 'Iphone 6', 16, 14, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 50000, 'ca34bbc7c1a601970952b883173d5d.png', 1),
(6, 'Monitor', 18, 2, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 8000, '662fec272bdc8456b1efde8c76dee9.jpg', 1),
(7, 'Camere', 27, 3, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 19000, 'cb81f4ec30443dc792124c4962804d.png', 1),
(8, 'CC Camera', 27, 3, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 19000, '9198af5f4e3c1a9e0166e280b1201a.jpg', 1),
(9, 'Filter', 6, 5, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 10000, 'c60ba8bbc5a010f94fa047a5268239.jpg', 1),
(10, 'Air Coloer', 16, 5, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 50000, 'aeac8ac9a34cb28f80b72c723299c1.jpg', 1),
(11, 'Iphone 6', 16, 5, 'Name: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\nName: Number: New_OfferContent:Robi-te worldcup dekhun FREE! bit.ly/MySportsApp download kore 29Tk refill-e 1GB FREE MySports shathe Robi/AT e 25 p/m ar onno opert-e 60p/m call rate(30 din)Time: 2018-07-11  10:48:13\r\n', 50000, 'cc008277fd49e694a0a897202923b0.jpg', 1),
(12, 'Mamun', 28, 1, 'dfdfd', 100, '568ef2113822913b381c75d47d5e3b.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_total_order`
--

CREATE TABLE `tbl_total_order` (
  `orderId` int(11) NOT NULL,
  `customerId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_total_order`
--

INSERT INTO `tbl_total_order` (`orderId`, `customerId`, `productId`, `productName`, `image`, `price`, `quantity`, `orderDate`) VALUES
(1, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-04 07:34:05'),
(2, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-04 07:11:47'),
(3, '4', '11', 'Iphone 6', 'cc008277fd49e694a0a897202923b0.jpg', '50000', '1', '2018-08-04 06:49:00'),
(4, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-03 16:42:56'),
(5, '4', '6', 'Monitor', '662fec272bdc8456b1efde8c76dee9.jpg', '8000', '1', '2018-08-03 16:42:56'),
(6, '4', '7', 'Camere', 'cb81f4ec30443dc792124c4962804d.png', '19000', '1', '2018-08-03 16:42:56'),
(7, '4', '8', 'CC Camera', '9198af5f4e3c1a9e0166e280b1201a.jpg', '19000', '1', '2018-08-03 16:42:55'),
(8, '4', '5', 'Iphone 6', 'ca34bbc7c1a601970952b883173d5d.png', '50000', '1', '2018-08-03 16:42:55'),
(9, '4', '10', 'Iphone 6', 'aeac8ac9a34cb28f80b72c723299c1.jpg', '50000', '1', '2018-08-03 16:12:09'),
(10, '4', '6', 'Monitor', '662fec272bdc8456b1efde8c76dee9.jpg', '8000', '1', '2018-08-03 16:11:56'),
(11, '4', '9', 'Filter', 'c60ba8bbc5a010f94fa047a5268239.jpg', '10000', '1', '2018-08-03 16:11:56'),
(12, '4', '8', 'CC Camera', '9198af5f4e3c1a9e0166e280b1201a.jpg', '19000', '1', '2018-08-03 16:11:56'),
(13, '4', '10', 'Iphone 6', 'aeac8ac9a34cb28f80b72c723299c1.jpg', '50000', '1', '2018-08-03 11:24:28'),
(32, '6', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-04 12:44:00'),
(15, '6', '11', 'Iphone 6', 'cc008277fd49e694a0a897202923b0.jpg', '50000', '1', '2018-08-04 05:34:16'),
(16, '6', '9', 'Filter', 'c60ba8bbc5a010f94fa047a5268239.jpg', '10000', '1', '2018-08-04 05:34:16'),
(17, '5', '1', 'Samsung S7', '453258305f641f0b4849949ea012ec.png', '10000', '1', '2018-08-03 16:13:18'),
(18, '5', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-03 16:13:18'),
(19, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-04 07:34:05'),
(20, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-04 07:11:47'),
(21, '4', '11', 'Iphone 6', 'cc008277fd49e694a0a897202923b0.jpg', '50000', '1', '2018-08-04 06:49:00'),
(22, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-03 16:42:56'),
(31, '6', '8', 'CC Camera', '9198af5f4e3c1a9e0166e280b1201a.jpg', '19000', '3', '2018-08-04 18:09:38'),
(24, '4', '9', 'Filter', 'c60ba8bbc5a010f94fa047a5268239.jpg', '10000', '1', '2018-08-03 16:11:56'),
(25, '4', '8', 'CC Camera', '9198af5f4e3c1a9e0166e280b1201a.jpg', '19000', '1', '2018-08-03 16:11:56'),
(26, '4', '10', 'Iphone 6', 'aeac8ac9a34cb28f80b72c723299c1.jpg', '50000', '1', '2018-08-03 11:24:28'),
(28, '6', '11', 'Iphone 6', 'cc008277fd49e694a0a897202923b0.jpg', '50000', '1', '2018-08-04 05:34:16'),
(29, '6', '9', 'Filter', 'c60ba8bbc5a010f94fa047a5268239.jpg', '10000', '1', '2018-08-04 05:34:16'),
(33, '6', '8', 'CC Camera', '9198af5f4e3c1a9e0166e280b1201a.jpg', '19000', '1', '2018-08-04 12:44:00'),
(34, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-04 09:34:24'),
(35, '4', '8', 'CC Camera', '9198af5f4e3c1a9e0166e280b1201a.jpg', '19000', '5', '2018-08-05 07:34:40'),
(36, '4', '5', 'Iphone 6', 'ca34bbc7c1a601970952b883173d5d.png', '50000', '1', '2018-08-06 04:41:40'),
(37, '4', '11', 'Iphone 6', 'cc008277fd49e694a0a897202923b0.jpg', '50000', '1', '2018-08-06 04:45:49'),
(38, '4', '5', 'Iphone 6', 'ca34bbc7c1a601970952b883173d5d.png', '50000', '1', '2018-08-06 06:15:09'),
(39, '4', '5', 'Iphone 6', 'ca34bbc7c1a601970952b883173d5d.png', '50000', '1', '2018-08-07 14:40:20'),
(40, '4', '10', 'Air Coloer', 'aeac8ac9a34cb28f80b72c723299c1.jpg', '50000', '1', '2018-08-07 14:40:20'),
(41, '4', '5', 'Iphone 6', 'ca34bbc7c1a601970952b883173d5d.png', '50000', '1', '2018-08-07 14:38:56'),
(42, '4', '5', 'Iphone 6', 'ca34bbc7c1a601970952b883173d5d.png', '50000', '1', '2018-08-08 03:43:19'),
(43, '4', '6', 'Monitor', '662fec272bdc8456b1efde8c76dee9.jpg', '8000', '1', '2018-08-07 15:02:52'),
(44, '4', '7', 'Camere', 'cb81f4ec30443dc792124c4962804d.png', '19000', '9', '2018-08-07 15:02:52'),
(45, '4', '4', 'Computer Box ', '74547d6c2907fc0c55b5773a150f88.jpg', '1000', '7', '2018-08-08 03:49:34'),
(46, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-08 03:49:34'),
(47, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-08 03:52:40'),
(48, '4', '9', 'Filter', 'c60ba8bbc5a010f94fa047a5268239.jpg', '10000', '1', '2018-08-08 10:47:31'),
(49, '4', '3', 'Laptop', '45fbda0b1cc9566b92410f5ca39ca0.jpg', '50000', '1', '2018-08-08 10:47:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishId` int(11) NOT NULL,
  `customerId` varchar(255) NOT NULL,
  `productId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `wishDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`messageId`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_total_order`
--
ALTER TABLE `tbl_total_order`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `messageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_total_order`
--
ALTER TABLE `tbl_total_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
