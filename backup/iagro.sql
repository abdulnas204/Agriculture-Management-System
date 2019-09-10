-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2015 at 10:40 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iagro`
--
CREATE DATABASE IF NOT EXISTS `iagro` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `iagro`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(25) NOT NULL,
  `login_id` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(10) NOT NULL AUTO_INCREMENT,
  `article_type` varchar(25) NOT NULL,
  `publish_date` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `article_description` text NOT NULL,
  `article_img1` varchar(100) NOT NULL,
  `article_img2` varchar(100) NOT NULL,
  `article_img3` varchar(100) NOT NULL,
  `article_img4` varchar(100) NOT NULL,
  `article_img5` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_type`, `publish_date`, `title`, `article_description`, `article_img1`, `article_img2`, `article_img3`, `article_img4`, `article_img5`, `status`) VALUES
(2, '', '2015-12-07', 'fnvbn34534', 'vbnvbn546456456dfsdg', '', '', '', '', '', 'Active'),
(4, '', '2015-12-07', 'fnvbn34534', 'vbnvbn546456456dfsdg', '', '', '', '', '', 'Active'),
(5, '', '2015-12-07', 'fnvbn34534', 'vbnvbn546456456dfsdg', '', '', '', '', '', 'Active'),
(6, '', '2015-12-07', 'fnvbn34534', 'vbnvbn546456456dfsdg', '', '', '', '', '', 'Active'),
(7, 'News', '2015-12-13', 'Areca nut', 'soil improvement.', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  `category_type` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`, `category_type`, `description`, `img`, `status`) VALUES
(1, 'Dry fruits', 'Selling product', 'This is test record for dry fruit', '', 'active'),
(2, 'Dry fruits', 'Selling product', 'This is test record for dry fruit', '', 'active'),
(3, 'Mace', 'Produce', 'This is test record for mace', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `country_id`, `state_id`, `city`, `description`, `status`) VALUES
(1, 0, 0, 'mumbai', 'fdhhhdg45', 'Active'),
(2, 2, 1, 'Mangalore', 'city from karnataka', 'Active'),
(3, 2, 1, 'Bangalore', 'test', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(10) NOT NULL AUTO_INCREMENT,
  `country` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country`, `description`, `status`) VALUES
(1, 'Paris', 'editr test', 'Active'),
(2, 'India', 'editr test', 'Active'),
(3, 'America', 'test', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(25) NOT NULL,
  `address` text NOT NULL,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `customer_type` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `address`, `country_id`, `state_id`, `city_id`, `pincode`, `contact_no`, `mobile_no`, `email_id`, `password`, `customer_type`, `status`) VALUES
(2, 'fgfdgghjufxd', 'sfdtgd v', 0, 0, 0, '654111', '43676674674', '587865878', 'gdfggfghdfg', '123', '', 'Active]'),
(3, 'fgfdgghjufxd', 'sfdtgd v', 0, 0, 0, '654111', '43676674674', '587865878', 'gdfggfghdfg', '123', '', 'Active]'),
(4, 'fgfg', 'dfgfd', 2, 1, 1, '4545', '454', '4545', 'gfg', '123', 'Seller', 'Active'),
(5, 'fgfg', 'dgfdgfdg', 2, 1, 0, '4545', '454', '4545', 'gfg', '123', 'Seller', 'Active'),
(6, 'tytry', 'rrgtyhf', 1, 1, 2, '565', '5656', '45656', '5688', '123', 'Seller', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `produce`
--

CREATE TABLE IF NOT EXISTS `produce` (
  `produce_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `produce` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`produce_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `produce`
--

INSERT INTO `produce` (`produce_id`, `category_id`, `produce`, `description`, `img`, `status`) VALUES
(1, 0, 'dfsssdaaa', 'gsdgfgfgtttt', '', 'Active'),
(2, 3, 'fgfdg', 'erdg', 'download (9).jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `seller_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `produce_id` int(10) NOT NULL,
  `variety_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `img_1` varchar(100) NOT NULL,
  `img_2` varchar(100) NOT NULL,
  `img_3` varchar(100) NOT NULL,
  `img_4` varchar(100) NOT NULL,
  `img_5` varchar(100) NOT NULL,
  `quantity` float(10,2) NOT NULL,
  `quantity_type` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `uploaded_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `seller_id`, `category_id`, `produce_id`, `variety_id`, `title`, `img_1`, `img_2`, `img_3`, `img_4`, `img_5`, `quantity`, `quantity_type`, `description`, `uploaded_date`, `status`) VALUES
(1, 0, 0, 0, 0, 'tytfydhteesrt', '', '', '', '', '', 54.35, '', 'tyhcfgh test test done', '2015-12-26', 'Active'),
(2, 0, 2, 1, 1, 'lost', '', '', '', '', '', 14.00, 'Quintal', 'ghg', '2015-12-23', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_bill`
--

CREATE TABLE IF NOT EXISTS `product_purchase_bill` (
  `product_purchase_bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `customer_name` varchar(25) NOT NULL,
  `customer_address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `customer_contact_number` varchar(15) NOT NULL,
  `purchase_date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`product_purchase_bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_purchase_bill`
--

INSERT INTO `product_purchase_bill` (`product_purchase_bill_id`, `country_id`, `state_id`, `city_id`, `customer_name`, `customer_address`, `pincode`, `customer_contact_number`, `purchase_date`, `status`) VALUES
(1, 1, 1, 1, 'rtf', ' fgdfgf ', '557001', '45787575', '0000-00-00', 'Active'),
(2, 2, 1, 2, 'rtgrer', 'getlost', '25713', '457575', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_record`
--

CREATE TABLE IF NOT EXISTS `product_purchase_record` (
  `purchase_record_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_purchase_bill_id` int(10) NOT NULL,
  `selling_product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`purchase_record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `purchase_order_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) NOT NULL,
  `purchase_request_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `purchase_order_date` date NOT NULL,
  `purchase_order_time` time NOT NULL,
  `purchase_amt` float(10,2) NOT NULL,
  `quantity` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`purchase_order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_bill`
--

CREATE TABLE IF NOT EXISTS `purchase_order_bill` (
  `purchase_order_bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `purchase_order_id` int(10) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `payment_description` text NOT NULL,
  `paid_date` date NOT NULL,
  `paid_amt` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`purchase_order_bill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE IF NOT EXISTS `purchase_request` (
  `purchase_request_id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` float(10,2) NOT NULL,
  `request_date` date NOT NULL,
  `request_date_expire` date NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`purchase_request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_request`
--

INSERT INTO `purchase_request` (`purchase_request_id`, `customer_id`, `product_id`, `quantity`, `request_date`, `request_date_expire`, `note`, `status`) VALUES
(1, 0, 1, 150.00, '2015-12-08', '2015-12-16', 'adnjerwe', 'Active'),
(2, 0, 2, 222.00, '2015-12-23', '2015-12-16', 'renats', 'Active'),
(3, 0, 0, 122.00, '2015-12-14', '2015-12-19', 'dgfhfgh', 'Active'),
(4, 0, 0, 1501.00, '2015-12-23', '2015-12-25', 'test', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `seller_id` int(10) NOT NULL AUTO_INCREMENT,
  `seller_name` varchar(25) NOT NULL,
  `seller_address` text NOT NULL,
  `state_id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `bank_IFSC` varchar(25) NOT NULL,
  `bank_acno` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`seller_id`, `seller_name`, `seller_address`, `state_id`, `country_id`, `city_id`, `pincode`, `contact_number`, `mobile_no`, `email_id`, `password`, `bank_name`, `bank_branch`, `bank_IFSC`, `bank_acno`, `status`) VALUES
(1, 'ren', 'mjhj', 0, 0, 0, '1256', '885', '877', 'fft', '123', 'dfd', 'gjghj', '5111', '4545', 'Active'),
(2, 'sdt', 'sdd', 1, 0, 1, '5464', '785', '456', 'fg', '123', 'dgef', 'dfghfdh', '4565', '45565656', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `selling_product`
--

CREATE TABLE IF NOT EXISTS `selling_product` (
  `selling_prod_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `product_description` text NOT NULL,
  `product_img1` varchar(100) NOT NULL,
  `product_img2` varchar(100) NOT NULL,
  `product_img3` varchar(100) NOT NULL,
  `product_img4` varchar(100) NOT NULL,
  `product_img5` varchar(100) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`selling_prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `selling_product`
--

INSERT INTO `selling_product` (`selling_prod_id`, `category_id`, `product_name`, `product_description`, `product_img1`, `product_img2`, `product_img3`, `product_img4`, `product_img5`, `cost`, `status`) VALUES
(1, 0, 'ren', 'donn', '', '', '', '', '', 1212.00, 'Active'),
(2, 0, 'ren', 'donn', '', '', '', '', '', 1212.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) NOT NULL,
  `state` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id`, `state`, `description`, `status`) VALUES
(1, 0, 'fgf', 'ddd', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `variety`
--

CREATE TABLE IF NOT EXISTS `variety` (
  `variety_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) NOT NULL,
  `produce_id` int(10) NOT NULL,
  `variety` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`variety_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `variety`
--

INSERT INTO `variety` (`variety_id`, `category_id`, `produce_id`, `variety`, `description`, `img`, `status`) VALUES
(1, 0, 0, 'rrd', 'er', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE IF NOT EXISTS `worker` (
  `worker_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `state_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `country_id` int(10) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `work_profile` text NOT NULL,
  `biodata` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `login_id` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `expected_salary` float(10,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`worker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`worker_id`, `name`, `address`, `state_id`, `city_id`, `country_id`, `pincode`, `work_profile`, `biodata`, `date_of_birth`, `login_id`, `password`, `expected_salary`, `status`) VALUES
(1, 'dfgfd', 'ffff', 0, 0, 0, '44', 'hfghfghg', '', '2015-12-25', '', '', 4111.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `worker_request`
--

CREATE TABLE IF NOT EXISTS `worker_request` (
  `worker_request_id` int(10) NOT NULL AUTO_INCREMENT,
  `worker_id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `task` text NOT NULL,
  `country_id` int(10) NOT NULL,
  `state_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL,
  `salary` float(10,2) NOT NULL,
  `salary_type` varchar(20) NOT NULL,
  `seller_status` varchar(20) NOT NULL,
  `worker_status` varchar(20) NOT NULL,
  `seller_comment` text NOT NULL,
  `worker_comment` text NOT NULL,
  PRIMARY KEY (`worker_request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `worker_request`
--

INSERT INTO `worker_request` (`worker_request_id`, `worker_id`, `seller_id`, `from_date`, `to_date`, `task`, `country_id`, `state_id`, `city_id`, `salary`, `salary_type`, `seller_status`, `worker_status`, `seller_comment`, `worker_comment`) VALUES
(1, 1, 0, '2015-12-06', '2016-02-09', 'fgfgfg', 0, 0, 0, 300000.00, '', '', '', 'fdfdfsdf', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
