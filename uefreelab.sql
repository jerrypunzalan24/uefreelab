-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2018 at 09:24 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uefreelab`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(25) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(25) CHARACTER SET latin1 NOT NULL,
  `username` varchar(25) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `username`, `password`, `role`) VALUES
(1, 'research', 'development', 'rnd', '$2y$12$d1ObGglZBuf/awMaVRYbi.UsvcTJrAXpUEl0fKBRXw9n40cTmOBqe', 0),
(2, 'meme', 'boi', 'memeboi', '$2y$10$Lxzzke77/uwdFVBcunDSD.cwduVLq.5Hv8AsX6ki02vqW3B.I4gwS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `lab_id` int(11) NOT NULL,
  `lab_name` varchar(5) NOT NULL,
  `lab_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`lab_id`, `lab_name`, `lab_capacity`) VALUES
(1, 'ALA', 36),
(2, 'ALB', 36),
(3, 'ALC', 36),
(4, 'BLA', 36),
(5, 'BLB', 36),
(6, 'CLA', 36),
(7, 'CLB', 37),
(8, 'CLC', 36);

-- --------------------------------------------------------

--
-- Table structure for table `reserved_lab`
--

CREATE TABLE `reserved_lab` (
  `reserved_lab_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `status` int(11) NOT NULL,
  `schedule` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserved_lab`
--

INSERT INTO `reserved_lab` (`reserved_lab_id`, `lab_id`, `time_in`, `time_out`, `status`, `schedule`, `description`) VALUES
(82, 7, '11:30:00', '12:30:00', 1, 'MWF', 'Introduction to Information Technology (with Computer Fundamentals)'),
(83, 8, '15:00:00', '16:00:00', 1, 'MWF', 'Database Management Systems 1*'),
(84, 6, '17:00:00', '18:00:00', 1, 'MWF', 'Computer Organizations and Architecture (w/ Assembly Language)*'),
(85, 3, '15:30:00', '18:30:00', 1, 'SAT', 'Management of Technology'),
(86, 6, '16:30:00', '18:00:00', 1, 'TTH', 'Special ICT Course 1'),
(87, 3, '14:00:00', '15:00:00', 1, 'MWF', 'Digital Electronics and Logic Design'),
(88, 8, '08:30:00', '09:30:00', 1, 'MWF', 'Systems Quality Assurance*'),
(89, 4, '13:30:00', '15:00:00', 1, 'TTH', 'Systems Quality Assurance*'),
(90, 8, '09:30:00', '10:30:00', 1, 'MWF', 'Analysis and Design of Algorithms'),
(91, 1, '10:30:00', '12:00:00', 1, 'TTH', 'Fundamentals of Business Analytics'),
(92, 1, '15:00:00', '16:30:00', 1, 'TTH', 'Fundamentals of Business Analytics'),
(93, 6, '10:30:00', '11:30:00', 1, 'MWF', 'Database Management Systems 1*'),
(94, 6, '13:00:00', '14:00:00', 1, 'MWF', 'Database Management Systems 1*'),
(95, 6, '16:00:00', '17:00:00', 1, 'MWF', 'Database Management Systems 1*'),
(96, 3, '17:00:00', '18:00:00', 1, 'MWF', 'Data Structures and Algorithm'),
(97, 7, '15:00:00', '16:00:00', 1, 'MWF', 'Software Engineering*'),
(98, 4, '13:30:00', '15:00:00', 1, 'TTH', 'Software Engineering*'),
(99, 4, '17:30:00', '19:00:00', 1, 'TTH', 'Compiler Theory and Design'),
(100, 8, '09:30:00', '10:30:00', 1, 'MWF', 'Systems Analysis, Design and Prototyping'),
(101, 8, '15:00:00', '16:00:00', 1, 'MWF', 'Systems Analysis, Design and Prototyping'),
(102, 4, '16:00:00', '17:00:00', 1, 'MWF', 'Systems Analysis, Design and Prototyping'),
(103, 8, '15:00:00', '16:30:00', 1, 'TTH', 'Computer Applications (with Presentation Skills)'),
(104, 6, '11:30:00', '12:30:00', 1, 'MWF', 'Computer Organizations and Architecture (w/ Assembly Language)*'),
(105, 6, '16:00:00', '17:00:00', 1, 'MWF', 'Computer Organizations and Architecture (w/ Assembly Language)*'),
(106, 1, '18:00:00', '19:00:00', 1, 'MWF', 'Introduction to Information Technology (with Computer Fundamentals)'),
(107, 7, '07:30:00', '08:30:00', 1, 'MWF', 'Software Engineering*'),
(108, 4, '08:30:00', '09:30:00', 1, 'MWF', 'Software Engineering*'),
(109, 2, '11:30:00', '12:30:00', 1, 'MWF', 'Software Engineering*'),
(110, 3, '13:00:00', '14:00:00', 1, 'MWF', 'Operating Systems*'),
(111, 6, '07:30:00', '09:00:00', 1, 'TTH', 'Operating Systems*'),
(112, 6, '09:00:00', '10:30:00', 1, 'TTH', 'Operating Systems*'),
(113, 8, '12:00:00', '13:30:00', 1, 'TTH', 'Software Engineering*'),
(114, 3, '13:30:00', '15:00:00', 1, 'TTH', 'Artificial Intelligence, Expert Systems and Robotics*'),
(115, 1, '17:00:00', '18:00:00', 1, 'MWF', 'Special ICT Course 3'),
(116, 1, '18:00:00', '19:30:00', 1, 'TTH', 'Special ICT Course 3'),
(117, 6, '07:30:00', '09:00:00', 1, 'TTH', 'Special ICT Course 1'),
(118, 7, '12:00:00', '13:30:00', 1, 'TTH', 'Special ICT Course 1'),
(119, 6, '13:30:00', '15:00:00', 1, 'TTH', 'Hardware, Software and Peripherals*'),
(120, 1, '16:30:00', '18:00:00', 1, 'TTH', 'Special ICT Course 1'),
(121, 3, '12:00:00', '15:00:00', 1, 'SAT', 'Project Management'),
(122, 8, '17:00:00', '18:00:00', 1, 'MWF', 'Computer Applications (with Presentation Skills)'),
(123, 7, '16:30:00', '18:00:00', 1, 'TTH', 'Computer Applications (with Presentation Skills)'),
(124, 8, '08:30:00', '09:30:00', 1, 'MWF', 'Database Management Systems 1*'),
(125, 8, '07:30:00', '09:00:00', 1, 'TTH', 'Database Management Systems 1*'),
(126, 3, '12:00:00', '13:30:00', 1, 'TTH', 'Database Management Systems 1*'),
(127, 7, '07:30:00', '08:30:00', 1, 'MWF', 'Systems Analysis, Design and Prototyping'),
(128, 8, '10:30:00', '11:30:00', 1, 'MWF', 'Systems Analysis, Design and Prototyping'),
(129, 8, '07:30:00', '09:00:00', 1, 'TTH', 'Systems Analysis, Design and Prototyping'),
(130, 3, '09:00:00', '10:30:00', 1, 'TTH', 'Systems Analysis, Design and Prototyping'),
(131, 8, '12:00:00', '13:30:00', 1, 'TTH', 'Systems Analysis, Design and Prototyping'),
(132, 3, '13:30:00', '15:00:00', 1, 'TTH', 'Mngt. Information Systems w/ Information Resource'),
(133, 8, '07:30:00', '08:30:00', 1, 'MWF', 'Database Management Systems 1*'),
(134, 2, '11:30:00', '12:30:00', 1, 'MWF', 'Database Management Systems 1*'),
(135, 1, '13:30:00', '15:00:00', 1, 'TTH', 'Database Management Systems 1*'),
(136, 6, '09:30:00', '10:30:00', 1, 'MWF', 'Special ICT Course 3'),
(137, 6, '10:30:00', '11:30:00', 1, 'MWF', 'Special ICT Course 3'),
(138, 6, '11:30:00', '12:30:00', 1, 'MWF', 'Special ICT Course 1'),
(139, 6, '14:00:00', '15:00:00', 1, 'MWF', 'Special ICT Course 3'),
(140, 6, '10:30:00', '12:00:00', 1, 'TTH', 'Special ICT Course 3'),
(141, 6, '12:00:00', '13:30:00', 1, 'TTH', 'Data Communications and Networking'),
(142, 6, '15:00:00', '16:30:00', 1, 'TTH', 'Special ICT Course 2'),
(143, 6, '16:30:00', '18:00:00', 1, 'TTH', 'Special ICT Course 2'),
(144, 8, '07:30:00', '08:30:00', 1, 'MWF', 'Special ICT Course 1'),
(145, 6, '08:30:00', '09:30:00', 1, 'MWF', 'Special ICT Course 1'),
(146, 6, '13:00:00', '14:00:00', 1, 'MWF', 'Special ICT Course 1'),
(147, 1, '09:30:00', '11:30:00', 0, 'SAT', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `studentnumber` varchar(11) COLLATE utf16_unicode_ci NOT NULL,
  `firstname` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  `lastname` varchar(25) COLLATE utf16_unicode_ci NOT NULL,
  `subject` varchar(10) COLLATE utf16_unicode_ci NOT NULL,
  `course` varchar(5) COLLATE utf16_unicode_ci NOT NULL,
  `reserved_lab_id` int(11) NOT NULL,
  `terminal_id1` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `hours` float NOT NULL,
  `count` int(11) NOT NULL,
  `time_out` time NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `studentnumber`, `firstname`, `lastname`, `subject`, `course`, `reserved_lab_id`, `terminal_id1`, `status`, `hours`, `count`, `time_out`, `active`) VALUES
(7, '20150144620', 'Jerry', 'Punzalan', 'CCP-113', 'BSCS', 147, 1, 1, 34.0536, 7, '14:54:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terminals`
--

CREATE TABLE `terminals` (
  `terminal_id` int(11) NOT NULL,
  `name` varchar(10) COLLATE utf16_unicode_ci NOT NULL,
  `lab_id` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `terminals`
--

INSERT INTO `terminals` (`terminal_id`, `name`, `lab_id`, `ip`) VALUES
(1, 'ALA-1', 1, '192.168.254.111'),
(2, 'ALA-2', 1, ''),
(3, 'ALA-3', 1, ''),
(4, 'ALA-4', 1, ''),
(5, 'ALA-5', 1, ''),
(6, 'ALA-6', 1, ''),
(7, 'ALA-7', 1, ''),
(8, 'ALA-8', 1, ''),
(9, 'ALA-9', 1, ''),
(10, 'ALA-10', 1, ''),
(11, 'ALA-11', 1, ''),
(12, 'ALA-12', 1, ''),
(13, 'ALA-13', 1, ''),
(14, 'ALA-14', 1, ''),
(15, 'ALA-15', 1, ''),
(16, 'ALA-16', 1, ''),
(17, 'ALA-17', 1, ''),
(18, 'ALA-18', 1, ''),
(19, 'ALA-19', 1, ''),
(20, 'ALA-20', 1, ''),
(21, 'ALA-21', 1, ''),
(22, 'ALA-22', 1, ''),
(23, 'ALA-23', 1, ''),
(24, 'ALA-24', 1, ''),
(25, 'ALA-25', 1, ''),
(26, 'ALA-26', 1, ''),
(27, 'ALA-27', 1, ''),
(28, 'ALA-28', 1, ''),
(29, 'ALA-29', 1, ''),
(30, 'ALA-30', 1, ''),
(31, 'ALA-31', 1, ''),
(32, 'ALA-32', 1, ''),
(33, 'ALA-33', 1, ''),
(34, 'ALA-34', 1, ''),
(35, 'ALA-35', 1, ''),
(36, 'ALA-36', 1, ''),
(37, 'ALB-1', 2, ''),
(38, 'ALB-2', 2, ''),
(39, 'ALB-3', 2, ''),
(40, 'ALB-4', 2, ''),
(41, 'ALB-5', 2, ''),
(42, 'ALB-6', 2, ''),
(43, 'ALB-7', 2, ''),
(44, 'ALB-8', 2, ''),
(45, 'ALB-9', 2, ''),
(46, 'ALB-10', 2, ''),
(47, 'ALB-11', 2, ''),
(48, 'ALB-12', 2, ''),
(49, 'ALB-13', 2, ''),
(50, 'ALB-14', 2, ''),
(51, 'ALB-15', 2, ''),
(52, 'ALB-16', 2, ''),
(53, 'ALB-17', 2, ''),
(54, 'ALB-18', 2, ''),
(55, 'ALB-19', 2, ''),
(56, 'ALB-20', 2, ''),
(57, 'ALB-21', 2, ''),
(58, 'ALB-22', 2, ''),
(59, 'ALB-23', 2, ''),
(60, 'ALB-24', 2, ''),
(61, 'ALB-25', 2, ''),
(62, 'ALB-26', 2, ''),
(63, 'ALB-27', 2, ''),
(64, 'ALB-28', 2, ''),
(65, 'ALB-29', 2, ''),
(66, 'ALB-30', 2, ''),
(67, 'ALB-31', 2, ''),
(68, 'ALB-32', 2, ''),
(69, 'ALB-33', 2, ''),
(70, 'ALB-34', 2, ''),
(71, 'ALB-35', 2, ''),
(72, 'ALB-36', 2, ''),
(73, 'ALC-1', 3, ''),
(74, 'ALC-2', 3, ''),
(75, 'ALC-3', 3, ''),
(76, 'ALC-4', 3, ''),
(77, 'ALC-5', 3, ''),
(78, 'ALC-6', 3, ''),
(79, 'ALC-7', 3, ''),
(80, 'ALC-8', 3, ''),
(81, 'ALC-9', 3, ''),
(82, 'ALC-10', 3, ''),
(83, 'ALC-11', 3, ''),
(84, 'ALC-12', 3, ''),
(85, 'ALC-13', 3, ''),
(86, 'ALC-14', 3, ''),
(87, 'ALC-15', 3, ''),
(88, 'ALC-16', 3, ''),
(89, 'ALC-17', 3, ''),
(90, 'ALC-18', 3, ''),
(91, 'ALC-19', 3, ''),
(92, 'ALC-20', 3, ''),
(93, 'ALC-21', 3, ''),
(94, 'ALC-22', 3, ''),
(95, 'ALC-23', 3, ''),
(96, 'ALC-24', 3, ''),
(97, 'ALC-25', 3, ''),
(98, 'ALC-26', 3, ''),
(99, 'ALC-27', 3, ''),
(100, 'ALC-28', 3, ''),
(101, 'ALC-29', 3, ''),
(102, 'ALC-30', 3, ''),
(103, 'ALC-31', 3, ''),
(104, 'ALC-32', 3, ''),
(105, 'ALC-33', 3, ''),
(106, 'ALC-34', 3, ''),
(107, 'ALC-35', 3, ''),
(108, 'ALC-36', 3, ''),
(109, 'BLA-1', 4, ''),
(110, 'BLA-2', 4, ''),
(111, 'BLA-3', 4, ''),
(112, 'BLA-4', 4, ''),
(113, 'BLA-5', 4, ''),
(114, 'BLA-6', 4, ''),
(115, 'BLA-7', 4, ''),
(116, 'BLA-8', 4, ''),
(117, 'BLA-9', 4, ''),
(118, 'BLA-10', 4, ''),
(119, 'BLA-11', 4, ''),
(120, 'BLA-12', 4, ''),
(121, 'BLA-13', 4, ''),
(122, 'BLA-14', 4, ''),
(123, 'BLA-15', 4, ''),
(124, 'BLA-16', 4, ''),
(125, 'BLA-17', 4, ''),
(126, 'BLA-18', 4, ''),
(127, 'BLA-19', 4, ''),
(128, 'BLA-20', 4, ''),
(129, 'BLA-21', 4, ''),
(130, 'BLA-22', 4, ''),
(131, 'BLA-23', 4, ''),
(132, 'BLA-24', 4, ''),
(133, 'BLA-25', 4, ''),
(134, 'BLA-26', 4, ''),
(135, 'BLA-27', 4, ''),
(136, 'BLA-28', 4, ''),
(137, 'BLA-29', 4, ''),
(138, 'BLA-30', 4, ''),
(139, 'BLA-31', 4, ''),
(140, 'BLA-32', 4, ''),
(141, 'BLA-33', 4, ''),
(142, 'BLA-34', 4, ''),
(143, 'BLA-35', 4, ''),
(144, 'BLA-36', 4, ''),
(145, 'BLB-1', 5, ''),
(146, 'BLB-2', 5, ''),
(147, 'BLB-3', 5, ''),
(148, 'BLB-4', 5, ''),
(149, 'BLB-5', 5, ''),
(150, 'BLB-6', 5, ''),
(151, 'BLB-7', 5, ''),
(152, 'BLB-8', 5, ''),
(153, 'BLB-9', 5, ''),
(154, 'BLB-10', 5, ''),
(155, 'BLB-11', 5, ''),
(156, 'BLB-12', 5, ''),
(157, 'BLB-13', 5, ''),
(158, 'BLB-14', 5, ''),
(159, 'BLB-15', 5, ''),
(160, 'BLB-16', 5, ''),
(161, 'BLB-17', 5, ''),
(162, 'BLB-18', 5, ''),
(163, 'BLB-19', 5, ''),
(164, 'BLB-20', 5, ''),
(165, 'BLB-21', 5, ''),
(166, 'BLB-22', 5, ''),
(167, 'BLB-23', 5, ''),
(168, 'BLB-24', 5, ''),
(169, 'BLB-25', 5, ''),
(170, 'BLB-26', 5, ''),
(171, 'BLB-27', 5, ''),
(172, 'BLB-28', 5, ''),
(173, 'BLB-29', 5, ''),
(174, 'BLB-30', 5, ''),
(175, 'BLB-31', 5, ''),
(176, 'BLB-32', 5, ''),
(177, 'BLB-33', 5, ''),
(178, 'BLB-34', 5, ''),
(179, 'BLB-35', 5, ''),
(180, 'BLB-36', 5, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indexes for table `reserved_lab`
--
ALTER TABLE `reserved_lab`
  ADD PRIMARY KEY (`reserved_lab_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `terminals`
--
ALTER TABLE `terminals`
  ADD PRIMARY KEY (`terminal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `lab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reserved_lab`
--
ALTER TABLE `reserved_lab`
  MODIFY `reserved_lab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `terminals`
--
ALTER TABLE `terminals`
  MODIFY `terminal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
