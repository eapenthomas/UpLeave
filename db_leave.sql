-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 07:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_leave`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_approval`
--

CREATE TABLE `tbl_approval` (
  `a_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `l_id` int(11) DEFAULT NULL,
  `st_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `daydiff` float NOT NULL,
  `appliedtime` varchar(30) NOT NULL,
  `remark` varchar(150) NOT NULL,
  `document` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_approval`
--

INSERT INTO `tbl_approval` (`a_id`, `emp_id`, `l_id`, `st_date`, `to_date`, `status`, `daydiff`, `appliedtime`, `remark`, `document`) VALUES
(24, 10008, 3, '2024-03-19', '0000-00-00', 1, 7, '2024-03-04 05:30:27', 'principal', 0x646f63752f43617463682e4d652e49662e596f752e43616e2e456e676c6973682d5757572e4d592d535542532e434f2e737274),
(25, 10008, 3, '2024-03-19', '2024-03-26', 1, 7, '2024-03-04 05:30:27', '', 0x646f63752f43617463682e4d652e49662e596f752e43616e2e456e676c6973682d5757572e4d592d535542532e434f2e737274),
(26, 10008, 3, '2024-03-08', '2024-03-08', 1, 0.5, '2024-03-03 16:15:39', '', ''),
(27, 10008, 1, '2024-03-06', '2024-03-06', 1, 0.5, '2024-03-03 16:23:06', '', ''),
(28, 10008, 1, '2024-03-06', '2024-03-06', 1, 0.5, '2024-03-05 18:13:36', '', ''),
(29, 10008, 5, '2024-03-07', '2024-03-09', 1, 2, '2024-03-05 18:14:31', '', 0x646f63752f74626c5f6c656176652d646f63756d656e74202831292e62696e);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deanrecommendation`
--

CREATE TABLE `tbl_deanrecommendation` (
  `dr_id` int(11) NOT NULL,
  `r_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_deanrecommendation`
--

INSERT INTO `tbl_deanrecommendation` (`dr_id`, `r_id`, `status`, `comments`) VALUES
(3, 5, 1, ''),
(4, 6, 1, ''),
(5, 4, 1, ''),
(6, 7, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `dept_id` int(11) NOT NULL,
  `deptname` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`dept_id`, `deptname`) VALUES
(1, 'MCA'),
(2, 'CSE'),
(3, 'IT'),
(4, 'EC'),
(5, 'MECH'),
(6, 'CIVIL'),
(7, 'administration'),
(8, 'Basic science'),
(9, 'AI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `emp_id` int(11) DEFAULT NULL,
  `empname` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`emp_id`, `empname`, `email`, `phone`, `doj`, `status`, `dept_id`, `post_id`) VALUES
(10001, 'Dr. Lillykutty Jacob', 'prinicipal@ajce.in', '8745896891', '2022-02-01', 1, 7, 1),
(10002, 'Dr. Binu C Yeldose', 'tesslykad@gmail.com', '8749696891', '2020-07-01', 1, 7, 2),
(10003, 'Dr.Lisa Mathew', 'hod@ajce.in', '9207066221', '2012-01-08', 1, 8, 3),
(10004, 'Joseph Alex', 'jose@ajce.in', '9451277783', '2021-01-05', 1, 3, 4),
(10005, 'Dr Joshua', 'jhod@ajce.in', '9207066887', '2020-05-09', 1, 5, 3),
(10008, 'Eapen Thomas', 'eapenthomas2026@mca.ajce.in', '8078285153', '2024-02-12', 1, 5, 4),
(10009, 'shambu', 's', '9784561321', '2024-02-16', 1, 5, 4),
(98745, 'WERTYUI', 'eapentkadamapuzha@gmail.com', '7591915153', '2024-02-27', 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hodrecommendation`
--

CREATE TABLE `tbl_hodrecommendation` (
  `r_id` int(11) NOT NULL,
  `req_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hodrecommendation`
--

INSERT INTO `tbl_hodrecommendation` (`r_id`, `req_id`, `status`, `comments`) VALUES
(4, 94, 1, 'good student\r\n'),
(5, 101, 1, 'hahaha'),
(6, 101, 1, ''),
(7, 103, 1, 'hod');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave`
--

CREATE TABLE `tbl_leave` (
  `req_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `l_id` int(11) DEFAULT NULL,
  `session` varchar(10) NOT NULL,
  `st_date` date NOT NULL,
  `to_date` date DEFAULT NULL,
  `document` blob DEFAULT NULL,
  `reason` varchar(150) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `daydiff` float NOT NULL,
  `appliedtime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave`
--

INSERT INTO `tbl_leave` (`req_id`, `emp_id`, `l_id`, `session`, `st_date`, `to_date`, `document`, `reason`, `status`, `daydiff`, `appliedtime`) VALUES
(94, 10008, 3, 'FN', '2024-03-08', '2024-03-08', '', 'cold', 4, 0.5, '2024-03-03 16:15:39'),
(97, 10008, 1, 'FN', '2024-03-06', '2024-03-06', '', 'sick', 1, 0.5, '2024-03-03 16:23:06'),
(101, 10008, 3, 'Full Day', '2024-03-19', '2024-03-26', 0x646f63752f43617463682e4d652e49662e596f752e43616e2e456e676c6973682d5757572e4d592d535542532e434f2e737274, 'Higher Studies', 4, 7, '2024-03-04 05:30:27'),
(102, 10008, 1, 'FN', '2024-03-06', '2024-03-06', '', 'sick', 2, 0.5, '2024-03-05 18:13:36'),
(103, 10008, 5, 'Full Day', '2024-03-07', '2024-03-09', 0x646f63752f74626c5f6c656176652d646f63756d656e74202831292e62696e, 'exam duty', 5, 2, '2024-03-05 18:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leavetype`
--

CREATE TABLE `tbl_leavetype` (
  `l_id` int(11) NOT NULL,
  `leavetype` varchar(30) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `totalleave` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leavetype`
--

INSERT INTO `tbl_leavetype` (`l_id`, `leavetype`, `description`, `totalleave`) VALUES
(1, 'Casual Leave', 'Provided for urgent or unforeseen matters to the employees.', 15),
(2, 'Vacation Leave', 'Scheduled time off for planned rest and personal pursuits.', 45),
(3, 'Study Leave', 'Time off granted for educational pursuits or professional development.', 180),
(4, 'Maternity Leave', 'Taking care of newborn ,recoveries', 90),
(5, 'Duty Leave', 'Authorized time off for official duties or responsibilities.', NULL),
(6, 'long Leave', ' Extended period of time off from work for various reasons such as travel, personal commitments, or ', NULL),
(7, 'Compensatory Leave', 'additional time off granted to employees in recognition of extra hours worked beyond their regular s', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `emp_id` int(11) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  `Gcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`emp_id`, `password`, `Gcode`) VALUES
(10001, 'principal123', 0),
(10002, 'dean123', 130666),
(10003, '5f4dcc3b5aa765d61d8327deb882cf99', 0),
(10004, '5f4dcc3b5aa765d61d8327deb882cf99', 0),
(10005, '9ad110b6373ea8e60d3e6df0270e4271', 0),
(10008, 'ea42372c3ef240f8513c59ba931e63b1', 181623),
(10009, '5078cf31f0a956fb77f063530e37e82e', 0),
(98745, 'CE6mOZ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `post_id` int(11) NOT NULL,
  `post_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`post_id`, `post_name`) VALUES
(1, 'principal'),
(2, 'academicdean'),
(3, 'hod'),
(4, 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_approval`
--
ALTER TABLE `tbl_approval`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `l_id` (`l_id`);

--
-- Indexes for table `tbl_deanrecommendation`
--
ALTER TABLE `tbl_deanrecommendation`
  ADD PRIMARY KEY (`dr_id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD UNIQUE KEY `unique_phone` (`phone`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `fk_emp` (`emp_id`);

--
-- Indexes for table `tbl_hodrecommendation`
--
ALTER TABLE `tbl_hodrecommendation`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `req_id` (`req_id`);

--
-- Indexes for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `l_id` (`l_id`);

--
-- Indexes for table `tbl_leavetype`
--
ALTER TABLE `tbl_leavetype`
  ADD PRIMARY KEY (`l_id`),
  ADD UNIQUE KEY `leavetype` (`leavetype`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_approval`
--
ALTER TABLE `tbl_approval`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_deanrecommendation`
--
ALTER TABLE `tbl_deanrecommendation`
  MODIFY `dr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_hodrecommendation`
--
ALTER TABLE `tbl_hodrecommendation`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_leavetype`
--
ALTER TABLE `tbl_leavetype`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98746;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_approval`
--
ALTER TABLE `tbl_approval`
  ADD CONSTRAINT `tbl_approval_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tbl_login` (`emp_id`),
  ADD CONSTRAINT `tbl_approval_ibfk_2` FOREIGN KEY (`l_id`) REFERENCES `tbl_leavetype` (`l_id`);

--
-- Constraints for table `tbl_deanrecommendation`
--
ALTER TABLE `tbl_deanrecommendation`
  ADD CONSTRAINT `tbl_deanrecommendation_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `tbl_hodrecommendation` (`r_id`);

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `fk_emp` FOREIGN KEY (`emp_id`) REFERENCES `tbl_login` (`emp_id`),
  ADD CONSTRAINT `tbl_employee_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `tbl_department` (`dept_id`),
  ADD CONSTRAINT `tbl_employee_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`post_id`);

--
-- Constraints for table `tbl_hodrecommendation`
--
ALTER TABLE `tbl_hodrecommendation`
  ADD CONSTRAINT `tbl_hodrecommendation_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `tbl_leave` (`req_id`);

--
-- Constraints for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD CONSTRAINT `tbl_leave_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tbl_login` (`emp_id`),
  ADD CONSTRAINT `tbl_leave_ibfk_2` FOREIGN KEY (`l_id`) REFERENCES `tbl_leavetype` (`l_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
