-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2019 at 10:04 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category`, `timestamp`) VALUES
('hardware', '2019-04-16 13:42:12'),
('medi', '0000-00-00 00:00:00'),
('media', '2019-04-16 13:43:18'),
('software', '2019-04-16 13:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_subject` varchar(250) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_subject`, `comment_text`, `comment_status`) VALUES
(15, 'files coming soon aagaina', 'asasasa', 1),
(16, 'hieeeeeeeeeee', 'lllllllllllllllllll', 1),
(17, 'ok', 'ok', 1),
(18, 'hieeeeeeeeeee', 'k', 1),
(19, 'files coming soon ', 'sdasda', 1),
(20, 'hieeeeeeeeeee', 'l', 1),
(21, 'hieeeeeeeeeee', 'mmmmmmmmmmmmmmmmm', 1),
(22, 'hieeeeeeeeeee', 'lllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkfgdfvdfvdfgfgfgvdfvdfgvdfffffffffffvvvvvvvggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 1),
(23, 'admin', 'sssss', 1),
(24, 'admin', '\'\';.', 1),
(26, 'admin', 'ssssssssssssssssssss', 1),
(27, 'admin', 'sssssssssssssssssssssssssssssssss', 1),
(29, 'admin', 'xxxxxxxxxx', 1),
(30, 'admin', 'sdsdsdsdsd', 1),
(33, 'admin', 'this is my\r\ncoment', 1),
(34, 'admin', 'tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt \r\n  tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt', 1),
(37, 'admin', 'ssssssss', 1),
(38, 'admin', 'ssssssss', 1),
(39, 'admin', 'sss', 1),
(40, 'admin', 'sssss', 1),
(41, 'admin', 'ssss', 1),
(42, 'admin', 'hp', 1),
(43, 'admin', 'fdfdfvdfg', 1),
(44, 'admin', 'fsdcvsdfgergsvsfgerf', 1),
(45, 'admin', 'cvbcf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `investor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `project`, `amount`, `investor`) VALUES
(1, 'project1', '5000', 'stewart');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `pr_owner` varchar(255) NOT NULL,
  `pr_name` varchar(255) NOT NULL,
  `pr_definition` int(11) NOT NULL,
  `pr_design` int(11) NOT NULL,
  `pr_standards` int(11) NOT NULL,
  `pr_patterns` int(11) NOT NULL,
  `pr_userflows` int(11) NOT NULL,
  `pr_styling` int(11) NOT NULL,
  `pr_functionaltest` int(11) NOT NULL,
  `pr_nonfunctionaltest` int(11) NOT NULL,
  `pr_userdocumentation` int(11) NOT NULL,
  `pr_maintenance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `pr_owner`, `pr_name`, `pr_definition`, `pr_design`, `pr_standards`, `pr_patterns`, `pr_userflows`, `pr_styling`, `pr_functionaltest`, `pr_nonfunctionaltest`, `pr_userdocumentation`, `pr_maintenance`) VALUES
(1, 'admin', 'project1', 100, 100, 7, 19, 70, 60, 49, 66, 66, 56);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_category` varchar(255) NOT NULL,
  `p_status` varchar(255) NOT NULL,
  `p_required` varchar(255) NOT NULL,
  `p_owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `p_name`, `p_category`, `p_status`, `p_required`, `p_owner`) VALUES
(1, 'project1', 'technlology', 'active', '2500', 'admin'),
(2, 'project2', 'geology', 'completed', '5000', 'admin'),
(3, 'project3', 'media', 'active', '7000', 'admin'),
(4, 'project4', 'history', 'suspended ', '9000', 'admin'),
(5, 'project5', 'commerce', 'cancelled ', '8099', 'admin'),
(6, 'project6', 'media', 'active', '7000', 'admin'),
(7, 'project7', 'media', 'active', '7000', 'admin'),
(8, 'ptojec4', 'technlology', 'active', '678', 'stewart'),
(9, 'project 19', 'technlology', 'active', '654', 'admin'),
(10, 'project9', 'technlology', 'active', '500', 'stewart'),
(11, 'project15', 'technlology', 'active', '500', 'stewart'),
(12, 'project 199', 'technlology', 'active', '999', 'stewart'),
(13, 'last project', 'media', 'active', '564', 'admin'),
(14, 'project300', 'media', 'active', '7000', 'admin'),
(15, 'project3005', 'media', 'active', '70007', 'admin'),
(16, 'project3005tt', 'media', 'active', '70007', 'admin'),
(17, 'project3005ttu', 'media', 'active', '70007', 'admin'),
(18, '', '', 'active', '', 'stewart'),
(19, '', '', 'active', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `s_owner` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_description` text NOT NULL,
  `s_start` varchar(255) NOT NULL,
  `s_end` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `s_owner`, `s_name`, `s_description`, `s_start`, `s_end`) VALUES
(1, 'admin', 'start coding', 'this is some text', '29-10-1999', '17-12-2020'),
(2, 'admin', 'start coding 2', 'this is some text 2', '29-10-1999', '17-12-2029'),
(3, 'admin', 'start coding', 'this is some text', '29-10-1999', '17-12-2020'),
(4, 'admin', 'start coding 2', 'this is some text 2', '29-10-1999', '17-12-2029'),
(5, '', '', 'ssssssss', '2019-04-17', '2019-04-22'),
(6, '', '', 'rhis is my saying', '2019-04-02', '2019-04-18'),
(7, 'admin', '', 'rhis is my saying', '2019-04-02', '2019-04-18'),
(8, 'admin', '', 'sssssssssss', '2019-04-03', '2019-04-03'),
(9, 'admin', 'hello', 'sdasasas', '2019-04-26', '2019-04-24'),
(10, 'admin', 'hello', 'sdasasas xszdddddddddddddddd ddddddddddd dddddddddddddd dddddddddddddddddddddd dddddddddddddddddd dddddddddddd', '2019-04-26', '2019-04-24'),
(11, 'admin', 'rrrrrrrrrrrrrr', 'ererrrrrrrrrr', '2019-04-09', '2019-04-03'),
(12, 'stewart', 'start building th system', 'thats it', '2019-04-19', '2019-04-18'),
(13, 'stewart', '75783', 'lsefs', '2019-04-19', '2019-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `t_project` varchar(255) NOT NULL,
  `t_user` varchar(255) NOT NULL,
  `t_description` varchar(255) NOT NULL,
  `t_end` varchar(255) NOT NULL,
  `t_origin` varchar(255) NOT NULL,
  `t_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `t_project`, `t_user`, `t_description`, `t_end`, `t_origin`, `t_status`) VALUES
(1, 'project1', 'admin', 'do some job', '22-12-2019', 'admin', 'completed'),
(2, 'project1', 'admin', 'do some job and i will be here waiting for you all day ak', '22-12-2019', 'admin', 'completed'),
(3, 'project1', 'admin', 'do some job and i will be here waiting for you all day ak then tomorrow we will be doing other staff ', '22-12-2019', 'admin', 'completed'),
(4, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(5, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(6, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(7, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(8, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(9, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(10, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(11, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(12, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(13, 'ptojec4', 'stewart', 'sssssssssss', '2019-04-06', 'admin', 'open'),
(14, 'project1', 'admin', 'thuis is a men\'s conference', '2019-04-19', 'admin', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `address`, `phone`, `password`, `status`, `role`) VALUES
(11, 'admin', 'skchirewo@gmail.com', '', '', '81dc9bdb52d04dc20036dbd8313ed055', 'active', 'admin'),
(12, 'stewart', 'mail.greenitgroup@gmail.zw', '', '', '81dc9bdb52d04dc20036dbd8313ed055', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
