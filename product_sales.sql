-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 04:30 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(100) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mno` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `mno`) VALUES
('11', 'admin', '1234', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `cid` varchar(500) DEFAULT NULL,
  `pid` varchar(500) DEFAULT NULL,
  `sold_qty` varchar(500) DEFAULT NULL,
  `cost` varchar(500) DEFAULT NULL,
  `total` varchar(500) DEFAULT NULL,
  `billno` varchar(500) NOT NULL,
  `status` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`cid`, `pid`, `sold_qty`, `cost`, `total`, `billno`, `status`) VALUES
('1211', '1290', '2', '100', '200', '1', 'closed'),
('1411', '1001', '3', '600', '1800', '2', 'closed'),
('1211', '1290', '10', '500', '5000', '3', 'closed'),
('1211', '1094', '5', '2500', '12500', '4', 'closed'),
('1211', '1094', '28', '14000', '392000', '5', 'closed'),
('1211', '1001', '2', '400', '800', '6', 'closed');

--
-- Triggers `billing`
--
DELIMITER $$
CREATE TRIGGER `t1` BEFORE INSERT ON `billing` FOR EACH ROW BEGIN
SET new.total=new.sold_qty*new.cost;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cid` varchar(500) NOT NULL,
  `cname` varchar(500) NOT NULL,
  `mno` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cid`, `cname`, `mno`) VALUES
('1', 'Ram', '1029384650'),
('1211', 'sandeep', '6362367037'),
('1411', 'Deeps', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `dept` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`dept`) VALUES
('groceries');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `eid` varchar(500) NOT NULL,
  `ename` varchar(500) NOT NULL,
  `emno` varchar(200) NOT NULL,
  `edept` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`eid`, `ename`, `emno`, `edept`) VALUES
('1111', 'Sandy', '1234123412', 'billing'),
('1112', 'Rakshi', '0987654321', 'Women'),
('123456', 'sam', '1472583690', 'Health');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` varchar(500) NOT NULL,
  `pname` varchar(500) NOT NULL,
  `pcost` varchar(500) NOT NULL,
  `pqty` varchar(500) NOT NULL,
  `poffer` varchar(200) NOT NULL,
  `pdept` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `pname`, `pcost`, `pqty`, `poffer`, `pdept`) VALUES
('1', 'Wheat Flour', '100', '100', 'Buy 1 get 1 Free', 'groceries'),
('1001', 'Almonds', '200', '500', '20% off', 'groceries'),
('1094', 'Shirt', '500', '30', '20% off ', 'menfashion'),
('12', 'turmeric powder', '100', '50', '10% off', 'groceries'),
('1212', 'lipstick', '350', '5', '10% off', 'womenfashion'),
('1290', 'Chilli powder', '50', '10', '10% off', 'groceries');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `cid` varchar(200) NOT NULL,
  `pcost` varchar(200) NOT NULL,
  `pqty` varchar(200) NOT NULL,
  `sid` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billno`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`dept`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
