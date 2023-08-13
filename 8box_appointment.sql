-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2023 at 08:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `8box_appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aenumber` varchar(6) NOT NULL,
  `aname` varchar(255) NOT NULL,
  `aemail` varchar(255) DEFAULT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aenumber`, `aname`, `aemail`, `apassword`) VALUES
('050601', 'Angelika Valerio', 'angevale@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(1, 1, 1, 1, '2022-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cid` int(11) NOT NULL,
  `ctype` int(2) NOT NULL,
  `cstatus` int(2) NOT NULL,
  `cemail` varchar(255) DEFAULT NULL,
  `cname` varchar(255) DEFAULT NULL,
  `cpassword` varchar(255) DEFAULT NULL,
  `ccompany_name` varchar(255) DEFAULT NULL,
  `ccompany_position` varchar(255) DEFAULT NULL,
  `caddress` varchar(255) DEFAULT NULL,
  `ccontact` varchar(15) DEFAULT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `cdoc` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cid`, `ctype`, `cstatus`, `cemail`, `cname`, `cpassword`, `ccompany_name`, `ccompany_position`, `caddress`, `ccontact`, `profile_pic`, `cdoc`) VALUES
(1, 1, 1, 'client@edoc.com', 'Test Client', '123', '', 'N/A', 'Sta. Mesa, Philippines', '09067891234', '', NULL),
(4, 1, 1, 'steph@gmail.com', 'step bar', '123', '', 'twow', 'ssta.mesa', '0998986799', 'Picture1.png', '2023-03-03');

-- --------------------------------------------------------

--
-- Table structure for table `client_status`
--

CREATE TABLE `client_status` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_status`
--

INSERT INTO `client_status` (`id`, `status`) VALUES
(1, 'existing'),
(2, 'potential');

-- --------------------------------------------------------

--
-- Table structure for table `client_type`
--

CREATE TABLE `client_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_type`
--

INSERT INTO `client_type` (`id`, `type`) VALUES
(1, 'personal'),
(2, 'company/organization');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(11) NOT NULL,
  `enumber` varchar(6) DEFAULT NULL,
  `eemail` varchar(255) DEFAULT NULL,
  `ename` varchar(255) DEFAULT NULL,
  `epassword` varchar(255) DEFAULT NULL,
  `econtact` varchar(15) DEFAULT NULL,
  `eposition` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `enumber`, `eemail`, `ename`, `epassword`, `econtact`, `eposition`) VALUES
(1, '000002', 'employeew@gmail.com', 'testemployee', '123', '09898787789', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mgt_user`
--

CREATE TABLE `mgt_user` (
  `enumber` varchar(6) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mgt_user`
--

INSERT INTO `mgt_user` (`enumber`, `usertype`) VALUES
('050601', 'a'),
('000002', 'e'),
('patien', 'p'),
('emhash', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(2) NOT NULL,
  `pname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `pname`) VALUES
(1, 'CEO'),
(2, 'Senior Web Developer'),
(3, 'Web Developer'),
(4, 'Senior Mobile App Developer'),
(5, 'Mobile App Developer'),
(6, 'Senior Report Developer'),
(7, 'Report Developer'),
(8, 'Senior Implementation Specialist'),
(9, 'Implementation Specialist'),
(10, 'System Analyst'),
(11, 'Accounting Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `eid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  `schedule_type` varchar(10) NOT NULL,
  `schedule_set` varchar(100) NOT NULL,
  `schedule_meeting` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `eid`, `title`, `scheduledate`, `scheduletime`, `nop`, `schedule_type`, `schedule_set`, `schedule_meeting`) VALUES
(1, '1', 'test', '2023-03-24', '11:00:00', 1, 'online', 'via Zoom', 'https://us06web.zoom.us/j/86371181540?pwd=Z09IdG5YRkVTS20vTG5hY1RkNC9rZz'),
(3, '2', 'Website Inquiry', '2023-03-30', '15:00:00', 2, 'onsite', '8box Office', 'https://goo.gl/maps/w3hbQs5Befz3dS9g7'),
(4, '2', 'Website Assistance', '2023-03-29', '06:30:00', 3, 'onsite', '8box Office', 'https://goo.gl/maps/w3hbQs5Befz3dS9g7');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('client@edoc.com', 'c'),
('shnn@gmail.com', 'c'),
('yougnjae@gmail.com', 'c'),
('m@gmail.com', 'c'),
('mark@gmail.com', 'c'),
('jayb@gmail.com', 'c'),
('ste@gmail.com', 'c'),
('steph@gmail.com', 'c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aenumber`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `client_status`
--
ALTER TABLE `client_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_type`
--
ALTER TABLE `client_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `specialties` (`eposition`);

--
-- Indexes for table `mgt_user`
--
ALTER TABLE `mgt_user`
  ADD PRIMARY KEY (`enumber`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`eid`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_status`
--
ALTER TABLE `client_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_type`
--
ALTER TABLE `client_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
