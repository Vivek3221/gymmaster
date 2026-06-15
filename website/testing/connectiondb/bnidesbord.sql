-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 05:31 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnidesbord`
--

-- --------------------------------------------------------

--
-- Table structure for table `company_target`
--

CREATE TABLE `company_target` (
  `company_target_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `target_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_target`
--

INSERT INTO `company_target` (`company_target_id`, `user_id`, `target_name`) VALUES
(13, 3, 'Add 200 new members in BNI'),
(14, 3, 'Retain 70% members');

-- --------------------------------------------------------

--
-- Table structure for table `customer_target`
--

CREATE TABLE `customer_target` (
  `customer_target_id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `company_target_id` int(50) NOT NULL,
  `department_type_id` int(50) NOT NULL,
  `department_target_id` int(100) NOT NULL,
  `customer_name_assign` varchar(150) NOT NULL,
  `department_strategies_name` varchar(150) NOT NULL,
  `customer_mission_Target` int(50) NOT NULL,
  `customer_mission_Actual` int(50) NOT NULL,
  `green_condition` varchar(100) NOT NULL,
  `green_val` int(100) NOT NULL,
  `red_condition` varchar(100) NOT NULL,
  `red_val` int(100) NOT NULL,
  `yellow_condition` varchar(100) NOT NULL,
  `yellow_value` int(100) NOT NULL,
  `status` int(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_target`
--

INSERT INTO `customer_target` (`customer_target_id`, `user_id`, `company_target_id`, `department_type_id`, `department_target_id`, `customer_name_assign`, `department_strategies_name`, `customer_mission_Target`, `customer_mission_Actual`, `green_condition`, `green_val`, `red_condition`, `red_val`, `yellow_condition`, `yellow_value`, `status`, `date`) VALUES
(68, 3, 13, 26, 14, 'Rahul Bhugra', 'Organize 6 Mega Visitors Days', 6, 3, '>', 70, '==', 60, '<', 50, 0, '0000-00-00'),
(76, 3, 13, 27, 15, 'tytryt', 'df', 1, 1, '>', 0, '>', 0, '>', 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `demo_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` (`demo_id`, `user_id`, `name`) VALUES
(18, 3, 'dsd'),
(19, 3, 'fff'),
(20, 3, ''),
(21, 3, 'dsf'),
(22, 3, 'dfdf'),
(23, 3, 'ss'),
(24, 3, 's'),
(25, 3, 'd'),
(26, 3, 'fdg'),
(27, 3, 'dfdf'),
(28, 3, 'df'),
(29, 3, 'df'),
(30, 3, 'df'),
(31, 3, 'df'),
(32, 3, 'dsf'),
(33, 3, 'dfd'),
(34, 3, 'ss'),
(35, 3, 's'),
(36, 3, 'd'),
(37, 3, 'fdg'),
(38, 3, 'dfdf'),
(39, 3, 'df'),
(40, 3, 'df'),
(41, 3, 'df'),
(42, 3, 'df'),
(43, 3, 'dsf'),
(44, 3, 'dfd'),
(45, 3, 'dfds'),
(46, 3, 'dsf'),
(47, 3, 'dfd'),
(48, 3, 'c'),
(49, 3, 'xc'),
(50, 3, 'xc'),
(51, 3, 'cx'),
(52, 3, 'cx'),
(53, 3, 'cx'),
(54, 3, 'cx'),
(55, 3, 'cx'),
(56, 3, 'cx'),
(57, 3, 'c'),
(58, 3, 'xcv'),
(59, 3, 'cxv'),
(60, 3, 'cx'),
(61, 3, 'cx'),
(62, 3, 'cx'),
(63, 3, 'cx'),
(64, 3, 'cx'),
(65, 3, 'cx'),
(66, 3, 'cxv'),
(67, 3, 'xcv'),
(68, 3, 'xc'),
(69, 3, 'cx'),
(70, 3, 'xc'),
(71, 3, 'cxv'),
(72, 3, 'cx'),
(73, 3, 'cx'),
(74, 3, 'cx'),
(75, 3, 'cx'),
(76, 3, 'xc'),
(77, 3, 'xc'),
(78, 3, 'xc'),
(79, 3, 'bvc'),
(80, 3, 'vb'),
(81, 3, 'vb'),
(82, 3, 'vc'),
(83, 3, 'vcb'),
(84, 3, 'vb'),
(85, 3, 'vc'),
(86, 3, 'vb'),
(87, 3, 'v'),
(88, 3, 'bhj'),
(89, 3, 'hj'),
(90, 3, 'hj'),
(91, 3, 'hj'),
(92, 3, 'hg'),
(93, 3, 'hg'),
(94, 3, 'hj'),
(95, 3, 'hj'),
(96, 3, 'hg'),
(97, 3, 'h'),
(98, 3, 'hj'),
(99, 3, 'h'),
(100, 3, 'hjre'),
(101, 3, 'rfg'),
(102, 3, 'sd'),
(103, 3, 'f'),
(104, 3, 'gfg'),
(105, 3, 'fg'),
(106, 3, 'fg'),
(107, 3, 'fg'),
(108, 3, 'dff'),
(109, 3, 'fg'),
(110, 3, 'fg'),
(111, 3, 'fg'),
(112, 3, 'df'),
(113, 3, 'rt'),
(114, 3, 'o'),
(115, 3, 'ou'),
(116, 3, 'lol'),
(117, 3, 'lol'),
(118, 3, 'lo'),
(119, 3, 'lo'),
(120, 3, 'ol'),
(121, 3, 'ol'),
(122, 3, 'o'),
(123, 3, 'ol'),
(124, 3, 'olk'),
(125, 3, 'kk'),
(126, 3, 'k'),
(127, 3, 'k'),
(128, 3, 'u'),
(129, 3, 'ui'),
(130, 3, 'k'),
(131, 3, 'j'),
(132, 3, 'j'),
(133, 3, 'j'),
(134, 3, 'j'),
(135, 3, 'y'),
(136, 3, 'yg'),
(137, 3, 'y'),
(138, 3, 'ui'),
(139, 3, 'uy'),
(140, 3, 'g'),
(141, 3, 't'),
(142, 3, 'y'),
(143, 3, 'k'),
(144, 3, 'l'),
(145, 3, 'u'),
(146, 3, 'ui'),
(147, 3, 'p'),
(148, 3, 'p'),
(149, 3, 'o'),
(150, 3, 'i'),
(151, 3, 'uy'),
(152, 3, 'y'),
(153, 3, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `department_target`
--

CREATE TABLE `department_target` (
  `department_target_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `department_type_id` int(50) NOT NULL,
  `department_target_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_target`
--

INSERT INTO `department_target` (`department_target_id`, `user_id`, `department_type_id`, `department_target_name`) VALUES
(13, 3, 26, '20 new members in 2017'),
(15, 3, 27, 'ghgfhg');

-- --------------------------------------------------------

--
-- Table structure for table `department_type`
--

CREATE TABLE `department_type` (
  `department_type_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `department_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_type`
--

INSERT INTO `department_type` (`department_type_id`, `user_id`, `department_name`) VALUES
(26, 3, 'Highflyer'),
(28, 3, 'tedf');

-- --------------------------------------------------------

--
-- Table structure for table `desbord_president`
--

CREATE TABLE `desbord_president` (
  `desbord_President_id` int(50) NOT NULL,
  `admin_id` int(50) NOT NULL,
  `Chapter_name` varchar(100) NOT NULL,
  `President_name` varchar(100) NOT NULL,
  `Weekly_Call` int(100) NOT NULL,
  `per_of_Grey` int(100) NOT NULL,
  `Monthly_one_two` int(150) NOT NULL,
  `Monthly_Fundamental` int(150) NOT NULL,
  `Monthly_LT` int(100) NOT NULL,
  `Focus_Visitors` int(100) NOT NULL,
  `Social_Chapter` int(100) NOT NULL,
  `Chapter_Retention` int(100) NOT NULL,
  `Total_Score` int(100) NOT NULL,
  `Individual_Ranking` int(100) NOT NULL,
  `LTRT_Attendance` int(150) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desbord_president`
--

INSERT INTO `desbord_president` (`desbord_President_id`, `admin_id`, `Chapter_name`, `President_name`, `Weekly_Call`, `per_of_Grey`, `Monthly_one_two`, `Monthly_Fundamental`, `Monthly_LT`, `Focus_Visitors`, `Social_Chapter`, `Chapter_Retention`, `Total_Score`, `Individual_Ranking`, `LTRT_Attendance`, `status`) VALUES
(1, 3, 'Highflyer', 'amit kumar', 15, 10, 20, 0, 5, 5, 0, 20, 20, 35, 10, 0),
(2, 3, 'Elites', 'sumit yadav', 5, 15, 30, 0, 5, 5, 10, 15, 0, 78, 10, 0),
(3, 3, 'Mavericks', 'rahul singh', 5, 15, 30, 5, 0, 5, 23, 0, 0, 47, 10, 0),
(4, 3, 'Mascots', 'ajay ssn', 15, 10, 15, 5, 5, 5, 10, 10, 0, 88, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `desbord_st`
--

CREATE TABLE `desbord_st` (
  `desbord_st_id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `Chapter_name` varchar(150) NOT NULL,
  `st_name` varchar(150) NOT NULL,
  `Weekly_Fundsheet` int(100) NOT NULL,
  `per_of_Grey` int(100) NOT NULL,
  `Monthly_one_two` int(150) NOT NULL,
  `Visitors_entry_done` int(150) NOT NULL,
  `Renewal_Cheques` int(100) NOT NULL,
  `LTRT_Attendance` int(100) NOT NULL,
  `Chapter_Retention` int(100) NOT NULL,
  `Total_Score` int(100) NOT NULL,
  `Individual_Ranking` int(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desbord_st`
--

INSERT INTO `desbord_st` (`desbord_st_id`, `admin_id`, `Chapter_name`, `st_name`, `Weekly_Fundsheet`, `per_of_Grey`, `Monthly_one_two`, `Visitors_entry_done`, `Renewal_Cheques`, `LTRT_Attendance`, `Chapter_Retention`, `Total_Score`, `Individual_Ranking`, `status`) VALUES
(1, 3, 'Highflyer', 'asaq', 15, 10, 15, 15, 10, 0, 10, 0, 60, 0),
(2, 3, 'Elites', 'waat', 5, 5, 15, 10, 0, 0, 10, 10, 53, 0),
(3, 3, 'Mavericks', 'dsad', 10, 15, 5, 0, 15, 10, 5, 0, 78, 0),
(4, 3, 'Mascots', 'aaaa', 10, 10, 10, 10, 0, 15, 15, 15, 45, 0);

-- --------------------------------------------------------

--
-- Table structure for table `desbord_vice_president`
--

CREATE TABLE `desbord_vice_president` (
  `desbord_vice_President_id` int(150) NOT NULL,
  `admin_id` int(50) NOT NULL,
  `Chapter_name` varchar(50) NOT NULL,
  `vice_President_name` varchar(100) NOT NULL,
  `Monthly_VP` int(150) NOT NULL,
  `per_of_Grey_chapter` int(150) NOT NULL,
  `Monthly_one_two` int(150) NOT NULL,
  `Net_Memebrship_Addition` int(150) NOT NULL,
  `Control_Letters_Sent` int(100) NOT NULL,
  `LTRT_Attendance` int(100) NOT NULL,
  `Chapter_Retention` int(100) NOT NULL,
  `Total_Score` int(100) NOT NULL,
  `Individual_Ranking` int(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desbord_vice_president`
--

INSERT INTO `desbord_vice_president` (`desbord_vice_President_id`, `admin_id`, `Chapter_name`, `vice_President_name`, `Monthly_VP`, `per_of_Grey_chapter`, `Monthly_one_two`, `Net_Memebrship_Addition`, `Control_Letters_Sent`, `LTRT_Attendance`, `Chapter_Retention`, `Total_Score`, `Individual_Ranking`, `status`) VALUES
(2, 3, 'Elites', 'Yahs Bindal', 10, 15, 10, 10, 10, 5, 10, 10, 55, 0),
(3, 3, 'Mavericks', 'Kamal ', 15, 10, 15, 15, 10, 10, 5, 10, 78, 0),
(4, 3, 'Mascots', 'amit dd', 5, 10, 15, 10, 15, 5, 15, 15, 5, 0),
(6, 3, 'Highflyer1', 'sonutiw', 10, 10, 0, 0, 0, 0, 0, 0, 88, 0);

-- --------------------------------------------------------

--
-- Table structure for table `target_percentage`
--

CREATE TABLE `target_percentage` (
  `target_percentage_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `company_target_id` int(50) NOT NULL,
  `department_target_id` int(50) NOT NULL,
  `target_percentage` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target_percentage`
--

INSERT INTO `target_percentage` (`target_percentage_id`, `user_id`, `company_target_id`, `department_target_id`, `target_percentage`) VALUES
(1, 3, 13, 13, 22),
(2, 3, 13, 14, 22),
(3, 3, 14, 15, 0),
(4, 3, 13, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_register`
--

CREATE TABLE `user_register` (
  `user_id` int(150) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_pass` varchar(150) NOT NULL,
  `user_profile_image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_register`
--

INSERT INTO `user_register` (`user_id`, `first_name`, `last_name`, `user_email`, `user_pass`, `user_profile_image`) VALUES
(2, 'jon', 'corner', 'fdghgf$@gmail.com', '123456', ''),
(3, 'admin', 'admin', 'admin@gmail.com', '123456', '3_0001.jpg'),
(4, 'reetendra', 'hjhg', 'thakurreetendra1@gmail.com', '1234', '4_user.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_target`
--
ALTER TABLE `company_target`
  ADD PRIMARY KEY (`company_target_id`);

--
-- Indexes for table `customer_target`
--
ALTER TABLE `customer_target`
  ADD PRIMARY KEY (`customer_target_id`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`demo_id`);

--
-- Indexes for table `department_target`
--
ALTER TABLE `department_target`
  ADD PRIMARY KEY (`department_target_id`);

--
-- Indexes for table `department_type`
--
ALTER TABLE `department_type`
  ADD PRIMARY KEY (`department_type_id`);

--
-- Indexes for table `desbord_president`
--
ALTER TABLE `desbord_president`
  ADD PRIMARY KEY (`desbord_President_id`);

--
-- Indexes for table `desbord_st`
--
ALTER TABLE `desbord_st`
  ADD PRIMARY KEY (`desbord_st_id`);

--
-- Indexes for table `desbord_vice_president`
--
ALTER TABLE `desbord_vice_president`
  ADD PRIMARY KEY (`desbord_vice_President_id`);

--
-- Indexes for table `target_percentage`
--
ALTER TABLE `target_percentage`
  ADD PRIMARY KEY (`target_percentage_id`);

--
-- Indexes for table `user_register`
--
ALTER TABLE `user_register`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_target`
--
ALTER TABLE `company_target`
  MODIFY `company_target_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `customer_target`
--
ALTER TABLE `customer_target`
  MODIFY `customer_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `demo_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT for table `department_target`
--
ALTER TABLE `department_target`
  MODIFY `department_target_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `department_type`
--
ALTER TABLE `department_type`
  MODIFY `department_type_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `desbord_president`
--
ALTER TABLE `desbord_president`
  MODIFY `desbord_President_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `desbord_st`
--
ALTER TABLE `desbord_st`
  MODIFY `desbord_st_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `desbord_vice_president`
--
ALTER TABLE `desbord_vice_president`
  MODIFY `desbord_vice_President_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `target_percentage`
--
ALTER TABLE `target_percentage`
  MODIFY `target_percentage_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_register`
--
ALTER TABLE `user_register`
  MODIFY `user_id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
