-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 08:10 AM
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
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('abcd', '123');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceid` int(11) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceid`, `studentid`, `date`, `status`) VALUES
(1, '369', '2025-02-19', 'Present'),
(2, '369', '2025-02-19', 'Present'),
(3, '369', '2025-02-19', 'Present'),
(4, '963', '2025-02-20', 'Present'),
(5, '25', '2025-02-20', 'Present'),
(6, '24', '2025-02-20', 'Present'),
(7, '369', '2025-02-20', 'Present'),
(8, '369', '2025-02-20', 'Present'),
(9, '369', '2025-02-21', 'Absent'),
(10, '369', '2025-02-21', 'Absent'),
(11, '369', '2025-02-21', 'Absent'),
(12, '369', '2025-02-21', 'Present'),
(13, '369', '2025-03-10', 'Present'),
(14, '369', '2025-03-11', 'Present'),
(15, '963', '2025-03-11', 'Present'),
(16, '963', '2025-03-11', 'Present'),
(17, '369', '2025-03-11', 'Present'),
(18, '963', '2025-03-11', 'Present'),
(19, '963', '2025-03-11', 'Present'),
(20, '963', '2025-03-11', 'Present'),
(21, '963', '2025-03-11', 'Present'),
(22, '369', '2025-03-12', 'Present'),
(23, '369', '2025-03-13', 'Present'),
(24, '369', '2025-03-13', 'Present'),
(25, '963', '2025-03-13', 'Present'),
(26, '369', '2025-03-14', 'Present'),
(27, '963', '2025-03-14', 'Present'),
(28, '369', '2025-03-15', 'Present'),
(29, '369', '2025-03-20', 'Present'),
(30, '369', '2025-03-31', 'Present'),
(31, '369', '2025-04-04', 'Present'),
(32, '369', '2025-04-12', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` int(11) NOT NULL,
  `coursename` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `coursename`) VALUES
(1, 'cs'),
(6, 'ec'),
(9, 'ee'),
(11, 'science'),
(12, 'ME');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(11) NOT NULL,
  `eventname` varchar(20) NOT NULL,
  `eventdate` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `eventname`, `eventdate`, `description`) VALUES
(1, 'freshers day', '2025-02-28', 'everybody come in color dress'),
(5, 'sports', '2025-03-13', 'prepare for your sports there will no classses');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `feeid` int(11) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `Feespaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`feeid`, `studentid`, `amount`, `date`, `Feespaid`) VALUES
(1, '369', 50000, '2025-03-15', 0),
(2, '369', 50000, '2025-03-17', 25000),
(3, '369', 50000, '2025-03-17', 25000),
(4, '963', 50000, '2025-03-17', 25000),
(5, '369', 50000, '2025-03-31', 49997);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` int(11) NOT NULL,
  `studentid` varchar(20) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `subjectname` varchar(20) NOT NULL,
  `marks` int(200) NOT NULL,
  `grade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`reportid`, `studentid`, `subjectid`, `subjectname`, `marks`, `grade`) VALUES
(5, '369', 2, 'pms', 80, 'a'),
(6, '369', 3, 'kannada', 95, 'a+'),
(7, '369', 6, 'operating system', 100, 'a+'),
(8, '369', 7, 'software engineering', 100, 'a+'),
(9, '963', 2, 'pms', 80, 'a'),
(10, '963', 3, 'kannada', 100, 'a+'),
(11, '963', 6, 'operating system', 95, 'a+'),
(12, '963', 7, 'software engineering', 96, 'a+'),
(13, '369', 7, 'software engineering', 100, 'a+');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` varchar(20) NOT NULL,
  `courseid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `courseid`, `name`, `email`, `password`) VALUES
('177cs22056', 33, 'manu', 'manu677@gmail.com', '$2y$10$UNdSv/ND/p5t99u.ko9oqulx4/jkJV/BCB/OBxJkYPsvEKPMPZ0e6'),
('369', 722, 'sham', 'aerttttyui@gmail.com', '$2y$10$iuzI6JGsIpXYvzIP8QLPvObWUDUPeFPdEs2FS5fzfv55YY/8fgJlu');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` int(11) NOT NULL,
  `subjectname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `subjectname`) VALUES
(2, 'pms'),
(3, 'kannada'),
(6, 'operating system'),
(7, 'software engineering');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `qualification`, `subject`, `password`) VALUES
(1, 'ram', 'MBE', 'FUNDAMETALS OF COMPUTER', ''),
(2, 'Anand', 'MBE', 'DBMS', ''),
(4, 'Prasad', 'BE', 'ITSKILLS', ''),
(5, 'rajat', 'MBE', 'Computer Networking', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`feeid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `feeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
