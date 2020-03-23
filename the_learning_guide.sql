-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2020 at 06:19 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `the_learning_guide`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE `analysis` (
  `id` int(11) NOT NULL,
  `keyword` varchar(25) NOT NULL,
  `no_total_search` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulletin_question`
--

CREATE TABLE `bulletin_question` (
  `id` int(11) NOT NULL,
  `que_1` int(11) NOT NULL,
  `que_2` int(11) NOT NULL,
  `que_3` int(11) NOT NULL,
  `que_4` int(11) NOT NULL,
  `que_5` int(11) NOT NULL,
  `que_6` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bulletin_id` int(11) NOT NULL,
  `isDelete` int(11) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulletin_question`
--

INSERT INTO `bulletin_question` (`id`, `que_1`, `que_2`, `que_3`, `que_4`, `que_5`, `que_6`, `user_id`, `bulletin_id`, `isDelete`, `updated_date`, `created_date`) VALUES
(1, 25, 0, 1, 0, 1, 27, 2, 28, 0, '2019-03-19 12:29:13', '2019-03-19 12:29:13'),
(2, 43, 1, 0, 0, 1, 77, 2, 28, 0, '2019-03-19 12:30:12', '2019-03-19 12:30:12'),
(3, 34, 0, 0, 0, 0, 51, 2, 29, 0, '2019-05-16 10:44:01', '2019-05-16 10:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `bulletin_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `is_view` enum('Y','N') NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`id`, `type`, `title`, `link`, `is_view`, `created_date`) VALUES
(1, 'Blog', 'test', 'http://localhost/the-learning-guide/bulletin-detail/c4ca4238a0b923820dcc509a6f75849b', 'N', '2019-08-14 02:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `AdminId` int(11) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Password` text,
  `ProfilePicture` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`AdminId`, `EmailId`, `Name`, `Password`, `ProfilePicture`) VALUES
(1, 'test@test.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', 'AdminProfile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblsetting`
--

CREATE TABLE `tblsetting` (
  `SettingId` int(11) NOT NULL,
  `SettingKey` varchar(200) NOT NULL,
  `SettingValue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsetting`
--

INSERT INTO `tblsetting` (`SettingId`, `SettingKey`, `SettingValue`) VALUES
(1, 'Admin_Title', 'Admin Panel | School Review'),
(2, 'Admin_Logo', 'admin_logo.png'),
(3, 'FrontEnd_Title', 'School Review'),
(4, 'FrontEnd_Logo', 'logo.png'),
(5, 'favicon', 'favicon.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(2) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emailPassword` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `country` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `postcode` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `ForgotString` varchar(50) NOT NULL,
  `status` bigint(1) NOT NULL DEFAULT '1',
  `isDelete` bigint(1) NOT NULL DEFAULT '0',
  `createDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `fname`, `lname`, `email`, `gender`, `age`, `profession`, `password`, `emailPassword`, `address`, `country`, `state`, `city`, `postcode`, `phone`, `ForgotString`, `status`, `isDelete`, `createDate`, `updateDate`) VALUES
(0, 'Admin', '', '', '', 1, '', '', '', '', 0, 0, 0, 0, '', '', 0, 0, '2018-12-24 17:56:01', '2019-03-15 15:09:04'),
(1, 'fname', 'lname', 'flname@gmail.com', 'male', 25, 'teacher', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 0, 2, 0, 4115, '', '', 1, 0, '2018-12-24 17:56:01', '2019-01-02 12:38:35'),
(2, 'Hitesh', 'Dangia', 'hiteshd84@gmail.com', 'male', 20, 'other', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 0, 4, 0, 123789, '7600032122', '', 1, 0, '2018-12-24 18:53:57', '2019-05-22 18:45:25'),
(3, 'Einstinen', 'Scientist', 'einstien@gmail.com', 'male', 35, 'teacher', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 0, 2, 0, 4115, '0789456123', '', 1, 0, '2019-01-02 11:30:36', '2019-01-07 16:45:11'),
(4, 'Remo', 'D\'souza', 'remo@gmail.com', 'male', 40, 'parent', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 0, 4, 0, 4115, '0789456123', '', 1, 0, '2019-01-07 17:35:17', '2019-01-07 17:35:17'),
(5, 'Tina', 'takkar', 'tina@gmail.com', 'female', 25, 'teacher', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', 0, 2, 0, 25222, '123456789', '', 1, 0, '2019-05-05 16:06:47', '2019-05-17 15:23:21'),
(7, 'fname', 'lname', 'flname@gmail.com', 'male', 25, 'teacher', '21232f297a57a5a743894a0e4a801fc3', 'admin', '', 0, 2, 0, 4115, '', '', 1, 0, '2019-05-07 02:00:00', '2019-05-17 15:18:34'),
(8, 'Jack', 'smith', 'hitesh@gmail.com', 'male', 50, 'student', '80e2235fd9a018996178a07a6a3f4fff', 'hitesh', '', 0, 1, 0, 33033, '9898989898', '', 1, 0, '2019-05-18 13:17:25', '2019-05-17 15:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulletin`
--

CREATE TABLE `tbl_bulletin` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `image_credit` text NOT NULL,
  `images` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=school, 2=teacher',
  `keyword_tags` varchar(255) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `schoolId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bulletin`
--

INSERT INTO `tbl_bulletin` (`id`, `title`, `description`, `image`, `image_credit`, `images`, `type`, `keyword_tags`, `teacherId`, `schoolId`, `status`, `isDelete`, `created_date`, `updated_date`) VALUES
(1, 'test', '<p>st</p>\r\n', '5d52e7eae0524_download (1).jpg', 'test', 'null', 1, 'test', 0, 1, 1, 0, '2019-08-13 22:10:12', '2019-08-18 11:33:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulletin_review`
--

CREATE TABLE `tbl_bulletin_review` (
  `review_id` int(11) NOT NULL,
  `review_fname` varchar(50) NOT NULL,
  `review_lname` varchar(50) NOT NULL,
  `review_email` varchar(150) NOT NULL,
  `review_message` text NOT NULL,
  `review_file` text NOT NULL,
  `review_anonymous` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calendar`
--

CREATE TABLE `tbl_calendar` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_description` text NOT NULL,
  `task_date` date NOT NULL,
  `task_end_date` date NOT NULL,
  `task_time` time NOT NULL,
  `task_end_time` time NOT NULL,
  `type` char(1) NOT NULL DEFAULT 'N' COMMENT 'N=New,C=Completed,',
  `task_school_tag` varchar(255) NOT NULL,
  `task_type` varchar(255) NOT NULL,
  `task_address` varchar(255) NOT NULL,
  `free_event` int(11) NOT NULL COMMENT '0-free 1-cost',
  `task_cost` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `approval` int(11) NOT NULL DEFAULT '2' COMMENT '2-inactive 1-active',
  `share_user` varchar(255) NOT NULL,
  `rsvp_date` date NOT NULL,
  `rsvp_contact` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `isDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `id` int(11) NOT NULL,
  `stateId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`id`, `stateId`, `name`, `status`, `isDelete`, `created_date`, `updated_date`) VALUES
(1, 1, 'Canberra', 1, 0, '2019-01-02 17:12:53', '0000-00-00 00:00:00'),
(2, 2, 'Albury-Wodonga', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(3, 2, 'Armidale', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(4, 2, 'Ballina', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(5, 2, 'Balranald', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(6, 2, 'Batemans Bay', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(7, 2, 'Bathurst', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(8, 2, 'Bega', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(9, 2, 'Bourke', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(10, 2, 'Bowral', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(11, 2, 'Broken Hill', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(12, 2, 'Byron Bay', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(13, 2, 'Camden', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(14, 2, 'Campbelltown', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(15, 2, 'Cobar', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(16, 2, 'Coffs Harbour', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(17, 2, 'Cooma', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(18, 2, 'Coonabarabran', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(19, 2, 'Coonamble', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(20, 2, 'Cootamundra', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(21, 2, 'Corowa', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(22, 2, 'Cowra', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(23, 2, 'Deniliquin', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(24, 2, 'Dubbo', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(25, 2, 'Forbes', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(26, 2, 'Forster', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(27, 2, 'Glen Innes', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(28, 2, 'Gosford', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(29, 2, 'Goulburn', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(30, 2, 'Grafton', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(31, 2, 'Griffith', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(32, 2, 'Gundagai', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(33, 2, 'Gunnedah', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(34, 2, 'Hay', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(35, 2, 'Inverell', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(36, 2, 'Junee', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(37, 2, 'Katoomba', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(38, 2, 'Kempsey', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(39, 2, 'Kiama', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(40, 2, 'Kurri Kurri', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(41, 2, 'Lake Cargelligo', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(42, 2, 'Lismore', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(43, 2, 'Lithgow', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(44, 2, 'Maitland', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(45, 2, 'Moree', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(46, 2, 'Moruya', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(47, 2, 'Murwillumbah', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(48, 2, 'Muswellbrook', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(49, 2, 'Nambucca Heads', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(50, 2, 'Narrabri', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(51, 2, 'Narrandera', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(52, 2, 'Newcastle', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(53, 2, 'Nowra-Bomaderry', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(54, 2, 'Orange', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(55, 2, 'Parkes', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(56, 2, 'Parramatta', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(57, 2, 'Penrith', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(58, 2, 'Port Macquarie', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(59, 2, 'Queanbeyan', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(60, 2, 'Raymond Terrace', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(61, 2, 'Richmond', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(62, 2, 'Scone', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(63, 2, 'Singleton', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(64, 2, 'Sydney', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(65, 2, 'Tamworth', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(66, 2, 'Taree', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(67, 2, 'Temora', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(68, 2, 'Tenterfield', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(69, 2, 'Tumut', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(70, 2, 'Ulladulla', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(71, 2, 'Wagga Wagga', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(72, 2, 'Wauchope', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(73, 2, 'Wellington', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(74, 2, 'West Wyalong', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(75, 2, 'Windsor', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(76, 2, 'Wollongong', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(77, 2, 'Wyong', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(78, 2, 'Yass', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(79, 2, 'Young', 1, 0, '2019-01-02 17:17:50', '0000-00-00 00:00:00'),
(80, 3, 'Alice Springs', 1, 0, '2019-01-02 17:18:59', '0000-00-00 00:00:00'),
(81, 3, 'Anthony Lagoon', 1, 0, '2019-01-02 17:18:59', '0000-00-00 00:00:00'),
(82, 3, 'Darwin', 1, 0, '2019-01-02 17:18:59', '0000-00-00 00:00:00'),
(83, 3, 'Katherine', 1, 0, '2019-01-02 17:18:59', '0000-00-00 00:00:00'),
(84, 3, 'Tennant Creek', 1, 0, '2019-01-02 17:18:59', '0000-00-00 00:00:00'),
(85, 4, 'Ayr', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(86, 4, 'Beaudesert', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(87, 4, 'Blackwater', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(88, 4, 'Bowen', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(89, 4, 'Brisbane', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(90, 4, 'Buderim', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(91, 4, 'Bundaberg', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(92, 4, 'Caboolture', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(93, 4, 'Cairns', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(94, 4, 'Charleville', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(95, 4, 'Charters Towers', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(96, 4, 'Cooktown', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(97, 4, 'Dalby', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(98, 4, 'Deception Bay', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(99, 4, 'Emerald', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(100, 4, 'Gatton', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(101, 4, 'Gladstone', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(102, 4, 'Gold Coast', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(103, 4, 'Goondiwindi', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(104, 4, 'Gympie', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(105, 4, 'Hervey Bay', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(106, 4, 'Ingham', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(107, 4, 'Innisfail', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(108, 4, 'Kingaroy', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(109, 4, 'Mackay', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(110, 4, 'Mareeba', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(111, 4, 'Maroochydore', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(112, 4, 'Maryborough', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(113, 4, 'Moonie', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(114, 4, 'Moranbah', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(115, 4, 'Mount Isa', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(116, 4, 'Mount Morgan', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(117, 4, 'Moura', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(118, 4, 'Redcliffe', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(119, 4, 'Rockhampton', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(120, 4, 'Roma', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(121, 4, 'Stanthorpe', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(122, 4, 'Toowoomba', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(123, 4, 'Townsville', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(124, 4, 'Warwick', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(125, 4, 'Weipa', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(126, 4, 'Winton', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(127, 4, 'Yeppoon', 1, 0, '2019-01-02 17:20:46', '0000-00-00 00:00:00'),
(128, 5, 'Adelaide', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(129, 5, 'Ceduna', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(130, 5, 'Clare', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(131, 5, 'Coober Pedy', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(132, 5, 'Gawler', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(133, 5, 'Goolwa', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(134, 5, 'Iron Knob', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(135, 5, 'Leigh Creek', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(136, 5, 'Loxton', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(137, 5, 'Millicent', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(138, 5, 'Mount Gambier', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(139, 5, 'Murray Bridge', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(140, 5, 'Naracoorte', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(141, 5, 'Oodnadatta', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(142, 5, 'Port Adelaide Enfield', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(143, 5, 'Port Augusta', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(144, 5, 'Port Lincoln', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(145, 5, 'Port Pirie', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(146, 5, 'Renmark', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(147, 5, 'Victor Harbor', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(148, 5, 'Whyalla', 1, 0, '2019-01-02 17:21:44', '0000-00-00 00:00:00'),
(149, 6, 'Beaconsfield', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(150, 6, 'Bell Bay', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(151, 6, 'Burnie', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(152, 6, 'Devonport', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(153, 6, 'Hobart', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(154, 6, 'Kingston', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(155, 6, 'Launceston', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(156, 6, 'New Norfolk', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(157, 6, 'Queenstown', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(158, 6, 'Richmond', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(159, 6, 'Rosebery', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(160, 6, 'Smithton', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(161, 6, 'Stanley', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(162, 6, 'Ulverstone', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(163, 6, 'Wynyard', 1, 0, '2019-01-02 17:22:35', '0000-00-00 00:00:00'),
(164, 7, 'Albury-Wodonga', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(165, 7, 'Ararat', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(166, 7, 'Bacchus Marsh', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(167, 7, 'Bairnsdale', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(168, 7, 'Ballarat', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(169, 7, 'Beechworth', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(170, 7, 'Benalla', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(171, 7, 'Bendigo', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(172, 7, 'Castlemaine', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(173, 7, 'Colac', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(174, 7, 'Echuca', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(175, 7, 'Geelong', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(176, 7, 'Hamilton', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(177, 7, 'Healesville', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(178, 7, 'Horsham', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(179, 7, 'Kerang', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(180, 7, 'Kyabram', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(181, 7, 'Kyneton', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(182, 7, 'Lakes Entrance', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(183, 7, 'Maryborough', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(184, 7, 'Melbourne', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(185, 7, 'Mildura', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(186, 7, 'Moe', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(187, 7, 'Morwell', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(188, 7, 'Port Fairy', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(189, 7, 'Portland', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(190, 7, 'Sale', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(191, 7, 'Sea Lake', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(192, 7, 'Seymour', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(193, 7, 'Shepparton', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(194, 7, 'Sunbury', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(195, 7, 'Swan Hill', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(196, 7, 'Traralgon', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(197, 7, 'Yarrawonga', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(198, 7, 'Wangaratta', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(199, 7, 'Warragul', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(200, 7, 'Werribee', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(201, 7, 'Wonthaggi', 1, 0, '2019-01-02 17:23:43', '0000-00-00 00:00:00'),
(202, 8, 'Broome', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(203, 8, 'Bunbury', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(204, 8, 'Busselton', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(205, 8, 'Coolgardie', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(206, 8, 'Dampier', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(207, 8, 'Derby', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(208, 8, 'Fremantle', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(209, 8, 'Geraldton', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(210, 8, 'Kalgoorlie', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(211, 8, 'Kambalda', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(212, 8, 'Katanning', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(213, 8, 'Kwinana', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(214, 8, 'Mandurah', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(215, 8, 'Meekatharra', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(216, 8, 'Mount Barker', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(217, 8, 'Narrogin', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(218, 8, 'Newman', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(219, 8, 'Northam', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(220, 8, 'Perth', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(221, 8, 'Port Hedland', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(222, 8, 'Tom Price', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00'),
(223, 8, 'Wyndham', 1, 0, '2019-01-02 17:25:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `follow_up` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_details`
--

CREATE TABLE `tbl_contact_details` (
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `contact_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_details`
--

INSERT INTO `tbl_contact_details` (`address`, `email`, `phone`, `contact_date`) VALUES
('123 Test Street, Australia 1', 'example@test.com', '0123456798', '2019-06-11 13:27:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `footer_heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`id`, `name`, `title`, `footer_heading`, `description`, `status`, `isDelete`, `created_date`, `updated_date`) VALUES
(1, 'terms', 'Terms And Use', 'Terms And Use', '<h2>Website Terms and Conditions</h2>\r\n\r\n<p>This website: <a href=\"http://www.cwsystems.com.au/\">http://www.cwsystems.com.au/</a> (&ldquo;<strong>Website</strong>&rdquo;) is owned and operated by CW Systems Pty Ltd ACN 138 897 088 (&ldquo;<strong>CW Systems</strong>&rdquo;, &ldquo;<strong>we</strong>&rdquo;, &ldquo;<strong>our</strong>&rdquo; or &ldquo;<strong>us</strong>&rdquo;) for the benefit of individuals and entities interested in CW Systems&rsquo; services.</p>\r\n\r\n<p>These website terms and conditions (&ldquo;<strong>Terms of Use</strong>&rdquo;) apply to your use of the Website and by using the Website you agree to be bound by these Terms of Use.&nbsp;</p>\r\n\r\n<p>Please read these Terms of Use prior to purchasing any products from and/or using our service.&nbsp; &nbsp;If you do not agree to these Terms of Use, you should not obtain or use information, services or products from this Website.</p>\r\n\r\n<p><strong>Information</strong></p>\r\n\r\n<p><strong>All information displayed on the Website is current at the time of display and any reference to currency is a reference to Australian Dollars. </strong>We take every reasonable care to ensure accuracy of all information listed. However, CW Systems is not liable for any errors in pricing and description.&nbsp; It is your responsibility to enquire with us directly to ensure the accuracy and currency of the material or information you seek to rely upon.</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p>We may from time to time, before your purchasing any products from this Website, require you to enter into the relevant agreement for the purchase of the products, and execute all other necessary documents. &nbsp;</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>User Account, Requests for Quotation and Orders</strong><br />\r\nTo make a request for quotation and access some features of the website, you must register an account with us. To register an account, you must:</p>\r\n\r\n<ol>\r\n	<li>give us accurate and current personal information including your name, address, and a valid email address.</li>\r\n	<li>you must be at least 18 years old, and have the capacity to enter into a legally binding agreement with us.</li>\r\n</ol>\r\n\r\n<p>You are solely responsible for the activity that occurs on your account (including requests for quotation and orders placed using your account), and you must keep your account password secure. We are not responsible for any unauthorised activity on your account if you fail to keep your account login information secure. We may refer fraudulent or abusive or illegal activity to the relevant authorities.</p>\r\n\r\n<p><br />\r\nYou must not use another person&rsquo;s account without our, and/or the other person&rsquo;s, express permission. If you suspect or become aware of any unauthorised use of your account or that your password is no longer secure, you must notify us immediately and take immediate steps to re-secure your account (including by changing your password).</p>\r\n\r\n<p>Any requests for quotation and/or orders places through our website will be subject to our then current terms and conditions of sale, which may be viewed here [insert link] or shall otherwise be made available to you at the time of submitting the request for quotation and/or order.</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p>If you discover that you have made a mistake with your request for quotation after you have submitted it through the website, please contact our Sales team immediately. However, we cannot guarantee that we will be able to amend your request in accordance with your instructions.&nbsp; Until the time when we accept your request, we reserve the right to refuse to process your request and you have the right to cancel your request.</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>Use of the website</strong></p>\r\n\r\n<p><strong>You must not:</strong></p>\r\n\r\n<ol>\r\n	<li>use the website (including any of CW Systems&rsquo; social media sites) for any activities, or post or transmit to or via the websites any information or materials, which:\r\n	<ol>\r\n		<li>breaches any laws or regulations, infringes a third party&#39;s rights or privacy, or which are contrary to any applicable standards or codes;</li>\r\n		<li>interferes with other users, or defames, harasses, threatens, bullies, or offends any person, or which inhibits any other user from using the website;</li>\r\n	</ol>\r\n	</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>is obscene, indecent, discriminatory, inflammatory or pornographic or which could give rise to civil or criminal proceedings;</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li>use the websites to send unsolicited commercial or bulk electronic messages;</li>\r\n	<li>make any fraudulent or speculative enquiries, reservations or requests using the websites;</li>\r\n	<li>provide false information when registering or changing your registration details;</li>\r\n	<li>tamper with, hinder the operation of or make unauthorised modifications to the website</li>\r\n	<li>knowingly transmit any virus or other disabling feature to or via the websites; or</li>\r\n	<li>attempt any of the above acts or permit another person to do any of the above acts.</li>\r\n</ol>\r\n\r\n<p><strong>Indemnity</strong></p>\r\n\r\n<p>To the full extent permitted by law, you agree to indemnify CW Systems and keep CW Systems indemnified from and against any liability and any loss or damage CW Systems may sustain, as a result of any breach, act or omission, arising directly or indirectly of these Terms of Use by you or your representatives.</p>\r\n\r\n<p><strong>Liability</strong></p>\r\n\r\n<p><strong>CW Systems&rsquo; liability is limited, to the extent permissible by law and at its option, to:</strong></p>\r\n\r\n<ul>\r\n	<li>in relation to products:</li>\r\n	<li>the replacement of the products or the supply of equivalent products;</li>\r\n	<li>the repair of the products;</li>\r\n	<li>the payment of the cost of replacing the products or of acquiring equivalent products; or</li>\r\n	<li>the payment of the cost of having the products repaired.</li>\r\n	<li>where the products are services:</li>\r\n	<li>the supply of service again; or</li>\r\n	<li>the payment of the cost of having the services supplied again.</li>\r\n</ul>\r\n\r\n<p><strong>To the extent permitted by law, all other warranties whether implied or otherwise, not set out in these Terms of Use are excluded and CW Systems is not liable in contract, tort (including, without limitation, negligence or breach of statutory duty) or otherwise to compensate you for:</strong></p>\r\n\r\n<ul>\r\n	<li>any increased costs or expenses;</li>\r\n	<li>any loss of profit, revenue, business, contracts or anticipated savings;</li>\r\n	<li>any loss or expense resulting from a claim by a third party; or</li>\r\n	<li>any special, indirect or consequential loss or damage of any nature whatsoever caused by CW Systems&rsquo; failure to complete or delay in completing the order to deliver the products.</li>\r\n</ul>\r\n\r\n<p>CW Systems is not responsible and accept no liability for loss or damage arising from Website failures or downtime.</p>\r\n\r\n<p><strong>Links</strong></p>\r\n\r\n<p>If you wish to establish a link to CW Systems Website from your website, you must seek our prior written consent.</p>\r\n\r\n<p>This Website may from time to time contain hyperlinks to other Websites.&nbsp; Such links are provided for convenience only and CW Systems is not responsible for the content and maintenance of or privacy compliance in relation to any linked Website. Any hyperlink on our Website to another Website does not necessarily imply our endorsement, support, or sponsorship of the operator of that Website or of the information and/or products that they provide.</p>\r\n\r\n<p><strong>Trademark</strong></p>\r\n\r\n<p>CW Systems&rsquo; logos (whether registered or otherwise) and any other affiliated logos owned by CW Systems may not be used without prior, specific, written consent by CW Systems.</p>\r\n\r\n<p><strong>Copyright and Intellectual Property</strong></p>\r\n\r\n<p>Copyright in the content on this Website is the property of CW Systems or owned by other third parties who have granted licence/s to CW Systems. Material on this Website may be viewed and may be reproduced in hard copy for your personal reference. Unless otherwise permitted by law, the material and information on this Website may not otherwise be reproduced or displayed and may not be distributed to any person or incorporated into any other website or materials without prior written approval from CW Systems.&nbsp;</p>\r\n\r\n<p>Intellectual property rights for software, scripts, programming code, animation, and processes used in this Website are the sole property of CW Systems including without limitation, all copyrights and other proprietary rights inherent therein.</p>\r\n\r\n<p><strong>Security Risk</strong></p>\r\n\r\n<p>Third parties may intercept or modify transmissions to and from this Website and it is possible that computer viruses or other defects may be contained in files obtained from or through this Website. CW Systems is not liable for any damage that may be a result of your use of this Website or of any linked Website.</p>\r\n\r\n<p><strong>Content Submitted Online </strong></p>\r\n\r\n<p>Where you post or submit content to our website (such as customer information, photos, order details, designs, etc) you warrant that you:</p>\r\n\r\n<ol>\r\n	<li>have the permission of the person/s to whom the content relates to submit it to the website, and if they appear in any photo for them and their image or likeness to be subject to these Terms, including use by CW Systems in accordance with CW Systems&rsquo; Privacy Policy; and</li>\r\n	<li>have the right to submit the content (including copyright); the content is your own original creation; and that you unconditionally and irrevocably consent to any act or omission which might infringe any moral rights you may have in the content (as defined in the Copyright Act 1968 (Cth)).</li>\r\n</ol>\r\n\r\n<p>CW Systems may copy, reproduce, publish, display, alter, or distort user submitted content, and use it for any purpose, (including without limitation, any future promotions or campaigns involving CW Systems) at any time in the future, and via any media.</p>\r\n\r\n<p>CW Systems does not accept any responsibility or liability where content is downloaded from the website, nor in relation to any matters after such download. Third parties may comment on, link to, re-post, or otherwise deal with the user submitted content once it is submitted, and CW Systems does not accept any liability for such actions.</p>\r\n\r\n<p>Any personal information you provide about yourself, or the person/s appearing in user submitted content, may be used by CW Systems to conduct campaigns, research and marketing activities (including informing you about special offers from CW Systems, and to become part of databases maintained by CW Systems or its associated entities), and otherwise be used in accordance with CW Systems&rsquo; Privacy Policy.</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<p><strong>Privacy Policy</strong></p>\r\n\r\n<p>All personal information obtained by using CW Systems&rsquo; Website is governed by CW Systems&rsquo; Privacy Policy. By using the Website you agree with CW Systems&rsquo; Privacy Policy. If you do not agree to CW Systems&rsquo; Privacy Policy, you should not provide your personal information to CW Systems.</p>\r\n\r\n<p>Upon accepting these Terms and the Privacy Policy you agree that the personal information collected may also be used to promote and inform you on other CW Systems products and services, which may interest you. You may notify us at any time that you no longer wish to receive any direct marketing by email: <a href=\"mailto:sales@cwsystems.com.au\">sales@cwsystems.com.au</a>.</p>\r\n\r\n<p><strong>General</strong></p>\r\n\r\n<p>No waiver of any of these terms and conditions or failure to exercise a right or remedy by CW Systems will be considered to imply or constitute a further waiver by CW Systems of the same or any other term, condition, right or remedy.</p>\r\n\r\n<p>CW Systems reserves the right to modify any of the Terms of Use and Privacy Policy at any time.</p>\r\n\r\n<p>These Terms of Use are governed by the laws of New South Wales, Australia. If any part of these Terms of Use is found to be invalid or unenforceable, it shall be served without affecting the remainder.</p>', 1, 0, '2019-05-16 16:43:48', '2019-05-16 17:03:29'),
(2, 'privacy-policy', 'PRIVACY POLICY', 'PRIVACY POLICY', '<h2>PRIVACY POLICY</h2>\r\n\r\n<ol>\r\n	<li><strong>About this policy </strong></li>\r\n</ol>\r\n\r\n<p>CW Systems Pty Ltd ACN 138 897 088 (herein referred to as &lsquo;<strong>CW Systems&rsquo;</strong> &lsquo;<strong>we</strong>&rsquo;, &lsquo;<strong>us</strong>&rsquo; or &lsquo;<strong>our</strong>&rsquo;) are committed to protecting the privacy of your personal information in accordance with Australian privacy laws.</p>\r\n\r\n<p>Our Privacy Policy sets out how we and our related entities collect, use, disclose and manage your personal information.</p>\r\n\r\n<p>Our Privacy Policy complies with the Australian Privacy Principles set out in the Privacy Act 1988 (Cth) as amended from time to time (&lsquo;Privacy Act&rsquo;).</p>\r\n\r\n<p>When you engage us to provide you with any goods or services, apply or complete an application for commercial credit, communicate with us through email, by telephone, in writing, participate in any of our promotional activities, or use any of our other services, including our websites, you agree to the use and disclosure of your personal information in the manner described in this policy. This policy is also relevant and applies to other individuals we deal with in connection with commercial credit we provide, such as guarantors and directors.</p>\r\n\r\n<p>We may from time to time review and update this Privacy Policy so please check our website periodically to stay informed of any updates.&nbsp; All personal information collected and held by us will be governed by the most recently updated Privacy Policy.&nbsp;</p>\r\n\r\n<ol>\r\n	<li><strong>Types of personal information we collect</strong></li>\r\n</ol>\r\n\r\n<p>The kinds of personal information we may collect from you will depend on what type of interaction you have with us.&nbsp; Personal information we may collect from you includes, among other things:</p>\r\n\r\n<ul>\r\n	<li>identity particulars - such as your name, address, date of birth, occupation, telephone numbers and e-mail address;</li>\r\n	<li>personal information we collect from you when assessing , processing and managing an application by you for commercial credit;</li>\r\n	<li>personal information you provide to us when you participate in a promotion, competition, promotional activity, survey, market research, subscribe to our mailing list;</li>\r\n	<li>your bank, credit or debit account details when you make a purchase;</li>\r\n	<li>your records of communication with us;</li>\r\n	<li>if you visit our website, your website usage information such as your IP address.</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li><strong>The purpose for collecting your personal information</strong></li>\r\n</ol>\r\n\r\n<p>We will generally only collect and use your personal information for the primary purposes of:</p>\r\n\r\n<ul>\r\n	<li>our general business operations;</li>\r\n	<li>effectively providing you with our goods and services;</li>\r\n	<li>where applicable, assessing and processing an application for commercial credit, and for administrative purposes in relation to the ongoing management of your commercial credit arrangement;</li>\r\n	<li>communicating with you;</li>\r\n	<li>responding to your inquires or complaints;</li>\r\n	<li>meeting our legal and regulatory obligations;</li>\r\n	<li>conducting, improving and developing a relationship with you;</li>\r\n	<li>direct marketing (such as providing you with information about our products and promotional notices and offers); and</li>\r\n	<li>improving our websites.</li>\r\n</ul>\r\n\r\n<p>Your personal information is only collected by lawful and fair means and where practicable, only from you or from a person acting or authorised to act on your behalf. Where you have applied for commercial credit account with us, we may also make enquiries in respect of commercial credit with third parties with your consent.&nbsp; This could include persons nominated by you as trade references, credit reporting bodies (&ldquo;CRBs&rdquo;) and your bankers.</p>\r\n\r\n<p>We will take reasonable steps to ensure that you are aware of:</p>\r\n\r\n<ul>\r\n	<li>the likely use of the information;</li>\r\n	<li>the right of access to the information;</li>\r\n	<li>the identity and contact details of our employee/representative collecting your personal information;</li>\r\n	<li>any law requiring collection of the information; and</li>\r\n	<li>the main consequences of failure to provide your personal information.</li>\r\n</ul>\r\n\r\n<ol>\r\n	<li><strong>How we may use and disclose your personal information</strong></li>\r\n</ol>\r\n\r\n<p>&nbsp;We may <strong>use</strong> your personal information for:</p>\r\n\r\n<ul>\r\n	<li>the primary purposes for which it was collected, such as those described above;</li>\r\n	<li>assessing and processing an application for, or administrative and management of, and commercial credit account with us;</li>\r\n	<li>administering and responding to your enquiry or feedback about our products and/or services;</li>\r\n	<li>conducting, and allowing you to participate in, a promotion, competition, promotional activity, survey, market research or customer behavioural activity;</li>\r\n	<li>promoting and marketing our current and future products and services to you, informing you of upcoming events and special promotions and offers and analysing our products and services so as to improve and develop new products and services (but giving you the opportunity to opt out of such direct marketing)</li>\r\n	<li>improving the operation of our websites.</li>\r\n</ul>\r\n\r\n<p>We may <strong>disclose</strong> personal information we collect from you:</p>\r\n\r\n<ul>\r\n	<li>to our related companies, suppliers, consultants, contractors or agents for the primary proposes for which it was collected or for other purposes directly related to the purpose for which the personal information is collected. For example, your name and telephone number may be disclosed to our supplier to enable that supplier to respond to your request for information about a particular product;</li>\r\n	<li>for direct marketing by, but giving you the opportunity to opt out of such direct marketing; We will include our contact details in any direct marketing.</li>\r\n	<li>to relevant Federal, State, Territory medical, health and safety&nbsp; authorities (as required);</li>\r\n	<li>where the law requires or authorises us to do so;</li>\r\n	<li>to others that you have been informed of at the time any personal information is collected from you;</li>\r\n	<li>with your consent (express or implied), to others.</li>\r\n</ul>\r\n\r\n<p>Where the Privacy Act permits us to do so, we may also disclose your credit related information (in respect of commercial credit) to CRBs such as Veda or Dunn &amp; Bradstreet, if you apply for commercial credit or request to increase in your commercial credit limit with CW SYSTEMS.</p>\r\n\r\n<p>Where CW SYSTEMS collects information that we are likely to disclose to a CRB, please note:</p>\r\n\r\n<ul>\r\n	<li>the CRBs may include that information in reports provided to CW SYSTEMS to assist it to assess your creditworthiness;</li>\r\n	<li>if you fail to meet payment obligations in relation to commercial credit or commit a serious credit infringement, CW SYSTEMS may be entitled to disclose this to the CRB;</li>\r\n	<li>if you are an individual you may access information from CW SYSTEMS in accordance with this privacy policy and may access this information for the purpose of requesting CW SYSTEMS to correct the information or make a complaint to CW SYSTEMS.</li>\r\n</ul>\r\n\r\n<p>CW SYSTEMS will only disclose personal information to CRBs where CW SYSTEMS is a member of a recognised External Dispute Resolution Scheme (&lsquo;EDR Scheme&rsquo;). If CW SYSTEMS disclosing your personal information to CRBs, we will provide you written notice prior to that disclosure, as well as the details of the recognised EDR Scheme.</p>\r\n\r\n<p>We do not disclose your personal information for any secondary purposes unless your consent has been given or as required by law, and we will not sell or license any personal information that we collect from you.</p>\r\n\r\n<ol>\r\n	<li><strong>How your personal information is stored and secured </strong></li>\r\n</ol>\r\n\r\n<p>We take reasonable steps to protect your personal information from loss, misuse or unauthorised access by restricting access to the information in electronic format and by appropriate physical and communications security.</p>\r\n\r\n<p>If a substantial data breach has or may have occurred (for example, your personal information was shared with unauthorised persons) we will notify you as soon as is practicable.</p>\r\n\r\n<p>We only keep your personal information for as long as it is required for the purpose for which it was collected or as otherwise required by law. We will take appropriate measures to destroy or permanently de-identity your personal information if we no longer need to retain it.&nbsp; These measures may vary depending on the type of information concerned, the way it was collected and how it was stored.</p>\r\n\r\n<ol>\r\n	<li><strong>Using our Website and Cooke</strong></li>\r\n</ol>\r\n\r\n<p>As with most websites, when you visit our website or use an application on our website, we may record anonymous information such as IP address, time, date, referring URL, pages accessed and documents downloaded type of browser and operating system.</p>\r\n\r\n<p>We also uses &ldquo;cookies&rdquo;. A cookie is a small file that stays on your computer until, depending on whether it is a sessional or persistent cookie, you turn your computer off or it expires. Cookies may collect and store your personal information. You may adjust your internet browser to disable cookies. If cookies are disabled you may still use our website, but the website may be limited in the use of some of the features.</p>\r\n\r\n<p>Our website may also contain links to or from other websites. We are not responsible for the privacy practices of other websites. This privacy policy applies only to the information we collect on our website. We encourage you to read the privacy policies of other websites you link to from our website.</p>\r\n\r\n<ol>\r\n	<li><strong>Marketing and Opting-Out </strong></li>\r\n</ol>\r\n\r\n<p>We may use your personal information for:</p>\r\n\r\n<ul>\r\n	<li>promoting and marketing of our current and future products and services;</li>\r\n	<li>informing you of upcoming events and special promotions and offers; and</li>\r\n	<li>analysing our products and services so as to improve and develop new products and services.</li>\r\n</ul>\r\n\r\n<p>We may exchange your personal information between our related entities and so they can also assist in the marketing of our products and services to you.</p>\r\n\r\n<p>We will only offer you products or services, where we reasonably believe that they could be of interest or benefit to you.</p>\r\n\r\n<p>At the point we collect information from you, you may be asked to &ldquo;opt in&rdquo; to consent to us using or disclosing your personal information.&nbsp; You will generally be given the opportunity to &ldquo;opt out&rdquo; from receiving marketing communications from us.&nbsp; You may &ldquo;opt out&rdquo; from receiving these communications by clicking on an unsubscribe link at the end of an email or by contacting us with this request.</p>\r\n\r\n<ol>\r\n	<li><strong>Cross border disclosure</strong></li>\r\n</ol>\r\n\r\n<p>Your personal information may also be processed by, or disclosed to employees, representatives, or other third parties operating outside of Australia who work for, or are engaged by us in other countries, including the United Kingdom.&nbsp; For example, we may use a server hosted overseas to store data, which may include your personal information.</p>\r\n\r\n<p>&nbsp;We will take reasonable steps, in the circumstances, before your personal information is disclosed to an overseas recipient, to ensure that the overseas recipient does not breach privacy laws in relation to your personal information (&lsquo;the reasonable steps&rsquo;).</p>\r\n\r\n<p>The reasonable steps may not apply if you consent to the disclosure of your personal information to an overseas recipient and we reasonably believe that the overseas receipt is subject to laws that are suitability similar to privacy laws in Australia.&nbsp;</p>\r\n\r\n<p>If you consent to the disclosure of your personal information to an overseas recipient, the overseas recipient may not be accountable under the Privacy Act, and you will not be able to seek redress for breaches under the Privacy Act.</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<ol>\r\n	<li><strong>Accurate and up-to-date information </strong></li>\r\n</ol>\r\n\r\n<p>We take reasonable steps to ensure your personal information is accurate, up-to-date and not misleading by updating its records whenever true and correct changes to the data come to its attention.</p>\r\n\r\n<p>If you believe your information is incorrect, incomplete or not current, you can request that we update this information by contacting our Privacy Officer. To contact our Privacy Officer please see contact details below in paragraph 16.</p>\r\n\r\n<p>We will correct information we hold about you if we discover, or you are able to show to a reasonable standard, the information is incorrect. If you seek correction and we disagrees that the information is incorrect, we will provide you with its reasons for taking that view.</p>\r\n\r\n<p>We disregard information that seems likely to be inaccurate or out-of-date by reason of the time that has elapsed since it was collected or by reason of any other information in our possession.</p>\r\n\r\n<p><strong>&nbsp;</strong></p>\r\n\r\n<ol>\r\n	<li><strong>Access to your personal information</strong></li>\r\n</ol>\r\n\r\n<p>We acknowledges that you have a general right of access to information concerning you, and to have inaccurate information corrected. You are able to access the personal information we hold about you by contacting our Privacy Officer. If access is refused to your personal information for reasons permitted by the Privacy Act, we will give you a notice explaining our decision to the extent practicable and your options.</p>\r\n\r\n<p>To contact our Privacy Officer please see contact details below. If you make an access request, we may ask you to verify your identity and put your request in writing for security reasons.&nbsp; We may charge a reasonable administration fee to cover the costs of meeting your request. We will reply to your request for access within 30 days of notification by you.</p>\r\n\r\n<ol>\r\n	<li><strong>Dealing with unsolicited information </strong></li>\r\n</ol>\r\n\r\n<p>We take all reasonable steps to ensure that all unsolicited information is destroyed or de-identified immediately.</p>\r\n\r\n<ol>\r\n	<li><strong>Anonymity when dealing with </strong><strong>us</strong></li>\r\n</ol>\r\n\r\n<p>Only where it practicable to do so, we may allow you the option not to identify yourself when dealing with us.</p>\r\n\r\n<ol>\r\n	<li><strong>Collecting sensitive information</strong></li>\r\n</ol>\r\n\r\n<p>CW SYSTEMS does not collect sensitive information, unless it is specifically relevant and necessary for the purpose of our business activities and functions, and your consent is first obtained. All sensitive information that is collected is used in accordance with this privacy policy.</p>\r\n\r\n<ol>\r\n	<li><strong>Government identifiers </strong></li>\r\n</ol>\r\n\r\n<p>We do not use government identifiers (e.g. tax file numbers or Medicare numbers) to identify individuals.</p>\r\n\r\n<ol>\r\n	<li><strong>Complaints</strong> <strong>and disputes</strong></li>\r\n</ol>\r\n\r\n<p>If you have reason to believe that we has not complied with our obligations relating to your personal information under this Privacy Policy or under the Privacy Act, please refer any compliant to queries to our Privacy Officer (details below).</p>\r\n\r\n<p>We will ensure your compliant is handled by our Privacy Officer in an appropriate and reasonable manner. Were necessary we may consult with our related entities and partners in order to deal with your complaint. A written notice of our decision regarding your complaint will be provided to you. If you are not satisfied with the outcome, then you may contact the Office of the Australian Privacy Commissioner:</p>\r\n\r\n<p><strong>Office of the Australian Information Commissioner</strong><br />\r\n<strong>Website: </strong><a href=\"http://www.oaic.gov.au/\">www.oaic.gov.au</a><br />\r\n<strong>Phone:</strong> 1300 363 992</p>\r\n\r\n<ol>\r\n	<li><strong>Who should you contact for further information?</strong></li>\r\n</ol>\r\n\r\n<p>Please refer any queries or complaints about our Privacy Policy or privacy issues to our:</p>\r\n\r\n<table style=\"width:106%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><a href=\"mailto:info@colemangreig.com.au?subject=Privacy%20Enquiry\"><strong>Privacy Officer</strong></a></p>\r\n\r\n			<p>CW SYSTEMS Pty Ltd</p>\r\n\r\n			<p>5 Tollis Place</p>\r\n\r\n			<p>Seven Hills NSW 2147</p>\r\n			</td>\r\n			<td>\r\n			<p><br />\r\n			<strong>Phone: </strong>02 9624 0700</p>\r\n\r\n			<p><strong>Email:</strong><strong>&nbsp;&nbsp; <a href=\"mailto:sales@cwsystems.com.au?subject=Web%20Enquiry\">sales@cwsystems.com.au</a></strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>Our Privacy Officer will consider your question or complaint and respond to you in a reasonable timeframe.</p>\r\n\r\n<p><strong><em>&nbsp;</em></strong></p>\r\n', 1, 0, '2019-05-16 16:43:48', '2019-05-16 16:49:21'),
(3, 'content-integrity-policy', 'Content & Integrity Policy', 'Content & Integrity Policy', '<p>If it&rsquo;s right, write. If it&rsquo;s written and it&rsquo;s wrong, you won&rsquo;t last for very long.</p>\r\n\r\n<p>We believe that our community should feel comfortable about sharing their honest experiences and feedback about the listed schools and teachers. However, fraudulent comments and unmeritorious comments that are damaging will be removed and the user blocked.Sent on:WedI will ellaborate laterHere is the privacy policy and website terms of use policy... Please copy and paste them into the appropriate pages. I will then modify. Please create a section in the admin where I can start amending this content</p>\r\n', 1, 0, '2019-05-16 16:43:48', '2019-05-16 16:51:19'),
(4, 'paid-content-partnerships', 'Paid Content Partnerships ', 'Paid Content Partnerships ', '<p>We do not endorse anyone or anything unless we wholeheartedly believe in it. We only work with people and brands we trust because we will never suggest, partner with or recommend anything below average.</p>\r\n\r\n<p>If an agent acting on behalf of a business or the business we have partnered with acts in an unethical and/or illegal manner, we reserve the right to terminate that partnership without notice to ensure that no harm is done to our students, parents, teachers, schools, brand and other affiliations.</p>\r\n\r\n<p>From time to time we may offer a discounted rate or a free experience as part of the reviewing process. This in no way impacts the assessment of that person or thing and it will only be included across our collateral if we believe it to be worthy.</p>\r\n\r\n<p>We may also receive money to promote things we deem to be worthy via sponsored posts, promotions or links. If this does occur, we will always disclose this.</p>\r\n', 1, 0, '2019-05-16 16:43:48', '2019-05-16 16:53:53'),
(5, 'faq', 'FAQ', 'FAQ', '<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n', 1, 0, '2019-05-16 16:43:48', '2019-05-16 18:46:21'),
(6, 'stories', 'About us', 'About us', '<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n', 1, 0, '2019-05-16 16:43:48', '2019-05-16 18:45:39'),
(7, 'services', 'Service', 'service', '<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n', 1, 0, '2019-05-16 16:43:48', '2019-05-16 18:46:37'),
(8, 'team', 'Meet the team', 'Meet the team', '<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n\r\n<h3><strong>HISTORY, PURPOSE AND USAGE</strong></h3>\r\n\r\n<p><em>Lorem ipsum</em>, or&nbsp;<em>lipsum</em>&nbsp;as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&#39;s&nbsp;<em>De Finibus Bonorum et Malorum</em>&nbsp;for use in a type specimen book. It usually begins with:</p>\r\n', 1, 0, '2019-05-16 16:43:48', '2019-05-16 18:46:54'),
(9, 'partners', '{\"option\":[\"Yeronga Uniforms\",\"Docustudy \\u00ae\"],\"optvalue\":[\"http:\\/\\/www.google.com\",\"http:\\/\\/www.google.com\"]}', 'http://www.google.com', '', 1, 0, '2019-05-16 16:43:48', '2019-06-18 11:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_conversion`
--

CREATE TABLE `tbl_conversion` (
  `id` int(11) NOT NULL,
  `schoolId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `conversion` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `lang_id` int(11) NOT NULL,
  `language` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`lang_id`, `language`, `status`, `isDelete`, `created_date`, `updated_date`) VALUES
(1, 'English', 1, 0, '2019-05-13 18:35:24', '2019-05-13 18:47:50'),
(2, 'Spanish', 1, 0, '2019-05-13 19:34:14', '2019-05-13 19:36:46'),
(3, 'Chinese', 1, 0, '2019-05-13 19:35:20', '0000-00-00 00:00:00'),
(4, 'Russian', 1, 0, '2019-05-13 19:37:07', '0000-00-00 00:00:00'),
(5, 'Arabic', 1, 0, '2019-05-13 19:38:13', '0000-00-00 00:00:00'),
(6, 'Japanese', 1, 0, '2019-05-13 19:38:19', '0000-00-00 00:00:00'),
(7, 'German', 1, 0, '2019-05-13 19:38:26', '0000-00-00 00:00:00'),
(8, 'Italian', 1, 0, '2019-05-13 19:38:31', '0000-00-00 00:00:00'),
(9, 'Greek', 1, 0, '2019-05-13 19:38:38', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter`
--

CREATE TABLE `tbl_newsletter` (
  `id` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `profession` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pageviews`
--

CREATE TABLE `tbl_pageviews` (
  `id` int(11) NOT NULL,
  `schoolId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `bulletinId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pageviews`
--

INSERT INTO `tbl_pageviews` (`id`, `schoolId`, `teacherId`, `bulletinId`, `userId`, `ip`, `created_date`) VALUES
(1, 1, 0, 0, 0, '10.0.0.51', '2019-07-01 10:57:28'),
(2, 1, 0, 0, 0, '::1', '2019-08-07 15:33:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `schoolId` int(11) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `review` text NOT NULL,
  `facilities` int(3) NOT NULL,
  `culture` int(3) NOT NULL,
  `staff` int(3) NOT NULL,
  `curricullum` int(3) NOT NULL,
  `fees` int(3) NOT NULL,
  `knowledge_expertise` int(3) NOT NULL,
  `professionalism` int(3) NOT NULL,
  `helpfulness_willingness` int(3) NOT NULL,
  `attitude` int(3) NOT NULL,
  `communication_skills` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

CREATE TABLE `tbl_school` (
  `id` int(11) NOT NULL,
  `school_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-general 2-primary 3-secondary',
  `category` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `telephone_2` varchar(150) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `website` varchar(255) NOT NULL,
  `prospectus` text NOT NULL,
  `school_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `principal` varchar(255) NOT NULL,
  `dep_principal` varchar(255) NOT NULL,
  `head_of_secondary` varchar(255) NOT NULL,
  `no_of_students` int(10) NOT NULL,
  `no_of_teachers` int(10) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT '0' COMMENT '0= primary, 1= secondary, 2=tertiary, 3=special school',
  `sub_type` varchar(255) NOT NULL,
  `subtype` varchar(255) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `department_type` varchar(50) NOT NULL,
  `boarding` tinyint(1) NOT NULL DEFAULT '0',
  `private_school_bus` tinyint(1) NOT NULL,
  `school_care` tinyint(1) NOT NULL,
  `school_care_number` varchar(50) NOT NULL,
  `speech_phthologist` varchar(255) NOT NULL,
  `occupational_therapist` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `parent_association` varchar(255) NOT NULL,
  `parent_association_president` varchar(255) NOT NULL,
  `international_students` tinyint(1) NOT NULL DEFAULT '0',
  `cricos_number` varchar(100) NOT NULL,
  `infrastructure_special_needs` varchar(255) NOT NULL,
  `enrolments_officer` varchar(100) NOT NULL,
  `enrolments_officer_email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `address_3` varchar(255) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `reception` varchar(255) NOT NULL,
  `po_box` varchar(255) NOT NULL,
  `primary_campus` varchar(255) NOT NULL,
  `secondary_campus` varchar(255) NOT NULL,
  `motto` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `student_support` tinyint(1) NOT NULL,
  `student_counsellor` varchar(255) NOT NULL,
  `uniform` tinyint(1) NOT NULL,
  `ib_diploma_programme` varchar(255) NOT NULL,
  `special_needs_support` tinyint(1) NOT NULL,
  `special_need_category` text NOT NULL,
  `scholarship_offer` tinyint(1) NOT NULL,
  `busstop_campus` tinyint(1) NOT NULL,
  `international_baccalaureate` tinyint(1) NOT NULL,
  `selective` tinyint(1) NOT NULL,
  `fees_grade` tinyint(1) NOT NULL,
  `fees_grade_1` varchar(255) NOT NULL,
  `funding_year` varchar(10) NOT NULL,
  `funding_amount` varchar(10) NOT NULL,
  `careers_adviser` tinyint(1) NOT NULL,
  `photos` text NOT NULL,
  `videos` text NOT NULL,
  `school_logo` text NOT NULL,
  `show_primary` tinyint(1) NOT NULL,
  `show_secondary` tinyint(1) NOT NULL,
  `head_of_primary` varchar(255) NOT NULL,
  `corporate_no` varchar(15) NOT NULL,
  `business_no` varchar(20) NOT NULL,
  `education_portfolio` varchar(255) NOT NULL,
  `facilities` varchar(255) NOT NULL,
  `facilities_contact` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_sponsored` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `approval` tinyint(1) NOT NULL,
  `reference_by` varchar(25) NOT NULL,
  `reference_email` varchar(50) NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `capmus_location` varchar(255) NOT NULL,
  `telephone_title` text NOT NULL,
  `telephone_campus` varchar(255) NOT NULL,
  `chancellor` varchar(255) NOT NULL,
  `vice_chancellor` varchar(255) NOT NULL,
  `student_support_officer` varchar(255) NOT NULL,
  `student_support_email` varchar(255) NOT NULL,
  `student_association` varchar(255) NOT NULL,
  `student_association_contact` varchar(255) NOT NULL,
  `annual_fees` varchar(255) NOT NULL,
  `onsite_parking` tinyint(1) NOT NULL,
  `train_station` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_school`
--

INSERT INTO `tbl_school` (`id`, `school_type`, `category`, `email`, `telephone`, `telephone_2`, `mobile`, `website`, `prospectus`, `school_number`, `name`, `principal`, `dep_principal`, `head_of_secondary`, `no_of_students`, `no_of_teachers`, `type`, `sub_type`, `subtype`, `sector`, `department_type`, `boarding`, `private_school_bus`, `school_care`, `school_care_number`, `speech_phthologist`, `occupational_therapist`, `gender`, `religion`, `parent_association`, `parent_association_president`, `international_students`, `cricos_number`, `infrastructure_special_needs`, `enrolments_officer`, `enrolments_officer_email`, `city`, `state`, `address_1`, `address_2`, `address_3`, `latitude`, `longitude`, `reception`, `po_box`, `primary_campus`, `secondary_campus`, `motto`, `about`, `student_support`, `student_counsellor`, `uniform`, `ib_diploma_programme`, `special_needs_support`, `special_need_category`, `scholarship_offer`, `busstop_campus`, `international_baccalaureate`, `selective`, `fees_grade`, `fees_grade_1`, `funding_year`, `funding_amount`, `careers_adviser`, `photos`, `videos`, `school_logo`, `show_primary`, `show_secondary`, `head_of_primary`, `corporate_no`, `business_no`, `education_portfolio`, `facilities`, `facilities_contact`, `instagram`, `facebook`, `start_date`, `end_date`, `is_sponsored`, `status`, `approval`, `reference_by`, `reference_email`, `isDelete`, `created_date`, `updated_date`, `capmus_location`, `telephone_title`, `telephone_campus`, `chancellor`, `vice_chancellor`, `student_support_officer`, `student_support_email`, `student_association`, `student_association_contact`, `annual_fees`, `onsite_parking`, `train_station`) VALUES
(1, 3, '', 'school@gmail.com', '2575978', '', '', 'www.myschool.com', '', 0, 'HM school edit', 'prinicapl name', '', '', 100, 35, 'primary,secondary,tertiary,special needs', '', 'tafe,college,university', 'public,private', '', 0, 0, 0, '', '', '', 'male', 'Hindu', '', '', 1, '555555', '', 'enrolment officer name', 'enrolment officer email', 'my city name', '2', 'address', '', '', '', '', '!#!!#!!#!', '33033', 'primary_campus address!#!1!#!asfd!#!asdf', 'secound address!#!2!#!asdf!#!asdf', 'school motto decription', '<p>my school about</p>\r\n', 1, '', 0, 'Yes', 0, '', 1, 0, 1, 1, 2, '8001-15000', '', '', 0, '[\"5d4aa7229b27d_3.jpg\",\"5d4aa72450bda_2.jpg\",\"5d4aa72b7fb93_3.jpg\",\"5d4aa754a7834_55.jpg\"]', '', '', 1, 1, '', 'asdfasdfasdfasd', 'business', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, 1, 0, '', '', 0, '2019-07-01 10:57:21', '2019-08-07 17:28:21', '', '', '', '', '', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_media`
--

CREATE TABLE `tbl_social_media` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_social_media`
--

INSERT INTO `tbl_social_media` (`id`, `facebook`, `instagram`, `linkedin`, `youtube`, `twitter`, `status`, `isDelete`, `created_date`, `updated_date`) VALUES
(1, 'http://www.facebook.com/', 'https://www.instagram.com/', 'https://in.linkedin.com/', 'https://www.youtube.com/', 'https://twitter.com/', 1, 0, '2019-01-29 12:37:26', '2019-05-16 18:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortName` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`id`, `name`, `shortName`, `status`, `isDelete`) VALUES
(1, 'Australian Capital Territory', 'ACT', 1, 0),
(2, 'New South Wales', 'NSW', 1, 0),
(3, 'Northern Territory', 'NT', 1, 0),
(4, 'Queensland', 'QLD', 1, 0),
(5, 'South Australia', 'SA', 1, 0),
(6, 'Tasmania', 'TAS', 1, 0),
(7, 'Victoria', 'VIC', 1, 0),
(8, 'Western Australia', 'WA', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `id` int(11) NOT NULL,
  `title` varchar(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `qualifications` varchar(255) NOT NULL,
  `teach_school` int(11) NOT NULL,
  `previous_school` int(11) NOT NULL,
  `year_started_teach` year(4) NOT NULL,
  `units_teach` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `tutoring_services` tinyint(1) NOT NULL,
  `preferred_hours` varchar(255) NOT NULL,
  `preferred_days` text NOT NULL,
  `teacher_status` tinyint(1) NOT NULL COMMENT '0=teaching,1=retired',
  `social_link` varchar(255) NOT NULL,
  `document` text NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `motto` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `need_experience` tinyint(1) NOT NULL,
  `special_need_category` text NOT NULL,
  `working_with_children` tinyint(1) NOT NULL,
  `wwcc_number` varchar(255) NOT NULL,
  `multilanguage` tinyint(1) NOT NULL,
  `language` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_sponsored` tinyint(1) NOT NULL COMMENT '1=is featured teacher',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `approval` tinyint(1) NOT NULL,
  `reference_by` varchar(255) NOT NULL,
  `reference_email` varchar(50) NOT NULL,
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_traffic`
--

CREATE TABLE `tbl_traffic` (
  `traffic_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_traffic`
--

INSERT INTO `tbl_traffic` (`traffic_id`, `url`, `ip`, `created_date`) VALUES
(1, 'http://10.0.0.102/the-learning-guide/admin/', '10.0.0.22', '2019-06-28 12:27:30'),
(2, 'http://10.0.0.102/the-learning-guide/admin/Home', '10.0.0.22', '2019-06-28 12:27:30'),
(3, 'http://10.0.0.102/the-learning-guide/admin/Home/top_school', '10.0.0.22', '2019-06-28 12:27:30'),
(4, 'http://10.0.0.102/the-learning-guide/admin/Home/new_user_chart', '10.0.0.22', '2019-06-28 12:27:31'),
(5, 'http://10.0.0.102/the-learning-guide/admin/Home/review_counter', '10.0.0.22', '2019-06-28 12:27:31'),
(6, 'http://10.0.0.102/the-learning-guide/admin/Home/new_review', '10.0.0.22', '2019-06-28 12:27:31'),
(7, 'http://10.0.0.102/the-learning-guide/admin/Home/traffic_weekly_engagement', '10.0.0.22', '2019-06-28 12:27:31'),
(8, 'http://10.0.0.102/the-learning-guide/admin/Home/top_teacher', '10.0.0.22', '2019-06-28 12:27:31'),
(9, 'http://10.0.0.102/the-learning-guide/admin/Home/traffic_monthly_engagement', '10.0.0.22', '2019-06-28 12:27:31'),
(10, 'http://10.0.0.102/the-learning-guide/admin/manage-school', '10.0.0.22', '2019-06-28 12:27:34'),
(11, 'http://10.0.0.102/the-learning-guide/admin/School/ajax_school/0', '10.0.0.22', '2019-06-28 12:27:35'),
(12, 'http://10.0.0.102/the-learning-guide/admin/add-school', '10.0.0.22', '2019-06-28 12:27:37'),
(13, 'http://10.0.0.102/the-learning-guide/admin/manage-review/school', '10.0.0.22', '2019-06-28 12:27:38'),
(14, 'http://10.0.0.102/the-learning-guide/admin/Review/ajax_data/0', '10.0.0.22', '2019-06-28 12:27:39'),
(15, 'http://10.0.0.102/the-learning-guide/admin/manage-bulletin', '10.0.0.22', '2019-06-28 12:27:41'),
(16, 'http://10.0.0.102/the-learning-guide/admin/Bulletin/ajax_bulletin/0', '10.0.0.22', '2019-06-28 12:27:41'),
(17, 'http://10.0.0.102/the-learning-guide/admin/add-bulletin', '10.0.0.22', '2019-06-28 12:27:43'),
(18, 'http://10.0.0.102/the-learning-guide/admin/insta-feed', '10.0.0.22', '2019-06-28 12:27:44'),
(19, 'http://10.0.0.102/the-learning-guide/admin/Bulletin/ajax_insta_feed/0', '10.0.0.22', '2019-06-28 12:27:44'),
(20, 'http://10.0.0.102/the-learning-guide/admin/manage-calendar', '10.0.0.22', '2019-06-28 12:27:47'),
(21, 'http://10.0.0.102/the-learning-guide/admin/Calendar/ajax_calendar/0', '10.0.0.22', '2019-06-28 12:27:47'),
(22, 'http://10.0.0.102/the-learning-guide/admin/add-calendar', '10.0.0.22', '2019-06-28 12:27:48'),
(23, 'http://10.0.0.102/the-learning-guide/admin/users', '10.0.0.22', '2019-06-28 12:27:49'),
(24, 'http://10.0.0.102/the-learning-guide/admin/Users/ajax_users/0', '10.0.0.22', '2019-06-28 12:27:50'),
(25, 'http://10.0.0.102/the-learning-guide/admin/contact', '10.0.0.22', '2019-06-28 12:29:02'),
(26, 'http://10.0.0.102/the-learning-guide/admin/Contact/ajax_contact/0', '10.0.0.22', '2019-06-28 12:29:03'),
(27, 'http://10.0.0.102/the-learning-guide/admin/edit-contact', '10.0.0.22', '2019-06-28 12:29:04'),
(28, 'http://10.0.0.102/the-learning-guide/admin/newsletter', '10.0.0.22', '2019-06-28 12:31:23'),
(29, 'http://10.0.0.102/the-learning-guide/admin/Contact/ajax_newsletter/0', '10.0.0.22', '2019-06-28 12:31:24'),
(30, 'http://10.0.0.102/the-learning-guide/admin/manage-stories', '10.0.0.22', '2019-06-28 12:31:26'),
(31, 'http://10.0.0.102/the-learning-guide/admin/manage-services', '10.0.0.22', '2019-06-28 12:31:28'),
(32, 'http://10.0.0.102/the-learning-guide/admin/manage-team', '10.0.0.22', '2019-06-28 12:31:29'),
(33, 'http://10.0.0.102/the-learning-guide/admin/manage-partners', '10.0.0.22', '2019-06-28 12:31:30'),
(34, 'http://10.0.0.102/the-learning-guide/admin/manage-faq', '10.0.0.22', '2019-06-28 12:31:31'),
(35, 'http://10.0.0.102/the-learning-guide/admin/manage-terms', '10.0.0.22', '2019-06-28 12:31:32'),
(36, 'http://10.0.0.102/the-learning-guide/admin/manage-privacy', '10.0.0.22', '2019-06-28 12:31:33'),
(37, 'http://10.0.0.102/the-learning-guide/admin/manage-content-policy', '10.0.0.22', '2019-06-28 12:31:34'),
(38, 'http://10.0.0.102/the-learning-guide/admin/manage-paid-content-partnerships', '10.0.0.22', '2019-06-28 12:31:35'),
(39, 'http://10.0.0.102/the-learning-guide/admin/Configuration/setting', '10.0.0.22', '2019-06-28 12:31:37'),
(40, 'http://10.0.0.102/the-learning-guide', '10.0.0.22', '2019-06-28 12:31:53'),
(41, 'http://10.0.0.102/the-learning-guide/who-we-are', '10.0.0.22', '2019-06-28 12:35:14'),
(42, 'http://10.0.0.102/the-learning-guide/services', '10.0.0.22', '2019-06-28 12:35:15'),
(43, 'http://10.0.0.102/the-learning-guide/team', '10.0.0.22', '2019-06-28 12:35:15'),
(44, 'http://10.0.0.102/the-learning-guide/contact', '10.0.0.22', '2019-06-28 12:35:16'),
(45, 'http://10.0.0.102/the-learning-guide/faq', '10.0.0.22', '2019-06-28 12:35:17'),
(46, 'http://10.0.0.102/the-learning-guide/terms', '10.0.0.22', '2019-06-28 12:35:17'),
(47, 'http://10.0.0.102/the-learning-guide/privacy-policy', '10.0.0.22', '2019-06-28 12:35:18'),
(48, 'http://10.0.0.102/the-learning-guide/content-integrity-policy', '10.0.0.22', '2019-06-28 12:35:18'),
(49, 'http://10.0.0.102/the-learning-guide/paid-content-partnerships', '10.0.0.22', '2019-06-28 12:35:19'),
(50, 'http://10.0.0.102/the-learning-guide/schools', '10.0.0.22', '2019-06-28 12:37:37'),
(51, 'http://10.0.0.102/the-learning-guide/teachers', '10.0.0.22', '2019-06-28 12:38:03'),
(52, 'http://10.0.0.102/the-learning-guide/bulletin', '10.0.0.22', '2019-06-28 12:38:09'),
(53, 'http://10.0.0.102/the-learning-guide/user/Bulletin/loadRecord/0', '10.0.0.22', '2019-06-28 12:38:11'),
(54, 'http://10.0.0.102/the-learning-guide/calendar', '10.0.0.22', '2019-06-28 12:39:56'),
(55, 'http://10.0.0.102/the-learning-guide/user/calendar/get_upcomint_event', '10.0.0.22', '2019-06-28 12:39:56'),
(56, 'http://10.0.0.102/the-learning-guide/user/calendar/get_all_event', '10.0.0.22', '2019-06-28 12:39:56'),
(57, 'http://10.0.0.102/the-learning-guide/my-profile', '10.0.0.22', '2019-06-28 12:44:45'),
(58, 'http://10.0.0.102/the-learning-guide/user/Login/ProfileUpdate', '10.0.0.22', '2019-06-28 12:44:53'),
(59, 'http://10.0.0.102/the-learning-guide/change-password', '10.0.0.22', '2019-06-28 12:45:01'),
(60, 'http://10.0.0.102/the-learning-guide/user/Login/Logout', '10.0.0.22', '2019-06-28 12:45:06'),
(61, 'http://10.0.0.102/the-learning-guide/admin/Login/Auth', '10.0.0.22', '2019-06-28 12:48:17'),
(62, 'http://10.0.0.102/the-learning-guide/admin/Login', '10.0.0.22', '2019-06-28 12:48:17'),
(63, 'http://10.0.0.102/the-learning-guide/admin', '10.0.0.22', '2019-06-28 12:48:43'),
(64, 'http://10.0.0.102/the-learning-guide/admin/Login/Logout', '10.0.0.22', '2019-06-28 13:11:02'),
(65, 'http://10.0.0.102/the-learning-guide/login', '10.0.0.22', '2019-06-28 16:17:38'),
(66, 'http://10.0.0.102/the-learning-guide', '10.0.0.51', '2019-07-01 10:56:18'),
(67, 'http://10.0.0.102/the-learning-guide/schools', '10.0.0.51', '2019-07-01 10:56:21'),
(68, 'http://10.0.0.102/the-learning-guide/admin/', '10.0.0.51', '2019-07-01 10:56:43'),
(69, 'http://10.0.0.102/the-learning-guide/admin/Login/Auth', '10.0.0.51', '2019-07-01 10:56:49'),
(70, 'http://10.0.0.102/the-learning-guide/admin/Home', '10.0.0.51', '2019-07-01 10:56:49'),
(71, 'http://10.0.0.102/the-learning-guide/admin/Home/top_school', '10.0.0.51', '2019-07-01 10:56:50'),
(72, 'http://10.0.0.102/the-learning-guide/admin/Home/top_teacher', '10.0.0.51', '2019-07-01 10:56:50'),
(73, 'http://10.0.0.102/the-learning-guide/admin/Home/review_counter', '10.0.0.51', '2019-07-01 10:56:50'),
(74, 'http://10.0.0.102/the-learning-guide/admin/Home/new_user_chart', '10.0.0.51', '2019-07-01 10:56:50'),
(75, 'http://10.0.0.102/the-learning-guide/admin/Home/traffic_weekly_engagement', '10.0.0.51', '2019-07-01 10:56:50'),
(76, 'http://10.0.0.102/the-learning-guide/admin/Home/new_review', '10.0.0.51', '2019-07-01 10:56:50'),
(77, 'http://10.0.0.102/the-learning-guide/admin/Home/traffic_monthly_engagement', '10.0.0.51', '2019-07-01 10:56:50'),
(78, 'http://10.0.0.102/the-learning-guide/admin/manage-school', '10.0.0.51', '2019-07-01 10:56:56'),
(79, 'http://10.0.0.102/the-learning-guide/admin/School/ajax_school/0', '10.0.0.51', '2019-07-01 10:56:56'),
(80, 'http://10.0.0.102/the-learning-guide/admin/add-school', '10.0.0.51', '2019-07-01 10:56:58'),
(81, 'http://10.0.0.102/the-learning-guide/admin/Importschool/import_general', '10.0.0.51', '2019-07-01 10:57:21'),
(82, 'http://10.0.0.102/the-learning-guide/school/c4ca4238a0b923820dcc509a6f75849b', '10.0.0.51', '2019-07-01 10:57:28'),
(83, 'http://10.0.0.102/the-learning-guide/Home/fetch_rating', '10.0.0.51', '2019-07-01 10:57:31'),
(84, 'http://10.0.0.102/the-learning-guide/assets/user/img/controls.png', '10.0.0.51', '2019-07-01 10:57:31'),
(85, 'http://10.0.0.102/the-learning-guide/login', '10.0.0.51', '2019-07-01 10:57:33'),
(86, 'http://10.0.0.102/the-learning-guide/user/Login/auth', '10.0.0.51', '2019-07-01 10:57:39'),
(87, 'http://10.0.0.102/the-learning-guide/Home/submit_review', '10.0.0.51', '2019-07-01 10:57:55'),
(88, 'http://10.0.0.102/the-learning-guide/admin/School/upload_files', '10.0.0.51', '2019-07-03 15:50:46'),
(89, 'http://localhost/the-learning-guide/admin', '::1', '2019-07-09 15:51:07'),
(90, 'http://localhost/the-learning-guide/admin/Home', '::1', '2019-07-09 15:51:07'),
(91, 'http://localhost/the-learning-guide/admin/Home/top_school', '::1', '2019-07-09 15:51:08'),
(92, 'http://localhost/the-learning-guide/admin/Home/traffic_weekly_engagement', '::1', '2019-07-09 15:51:08'),
(93, 'http://localhost/the-learning-guide/admin/Home/top_teacher', '::1', '2019-07-09 15:51:08'),
(94, 'http://localhost/the-learning-guide/admin/Home/new_review', '::1', '2019-07-09 15:51:08'),
(95, 'http://localhost/the-learning-guide/admin/Home/review_counter', '::1', '2019-07-09 15:51:08'),
(96, 'http://localhost/the-learning-guide/admin/Home/new_user_chart', '::1', '2019-07-09 15:51:08'),
(97, 'http://localhost/the-learning-guide/admin/Home/traffic_monthly_engagement', '::1', '2019-07-09 15:51:08'),
(98, 'http://localhost/the-learning-guide/admin/manage-bulletin', '::1', '2019-07-09 15:51:12'),
(99, 'http://localhost/the-learning-guide/admin/Bulletin/ajax_bulletin/0', '::1', '2019-07-09 15:51:13'),
(100, 'http://localhost/the-learning-guide/admin/add-bulletin', '::1', '2019-07-09 15:51:14'),
(101, 'http://10.0.0.102/the-learning-guide/admin/add-bulletin', '10.0.0.51', '2019-07-09 15:53:42'),
(102, 'http://10.0.0.102/the-learning-guide', '10.0.0.16', '2019-08-07 14:46:06'),
(103, 'http://10.0.0.102/the-learning-guide/schools', '10.0.0.16', '2019-08-07 14:50:17'),
(104, 'http://localhost/the-learning-guide', '::1', '2019-08-07 14:52:41'),
(105, 'http://localhost/the-learning-guide/schools', '::1', '2019-08-07 14:52:42'),
(106, 'http://localhost/the-learning-guide/schools', '127.0.0.1', '2019-08-07 15:07:41'),
(107, 'http://localhost/the-learning-guide/school', '::1', '2019-08-07 15:10:31'),
(108, 'http://localhost/the-learning-guide/school/', '::1', '2019-08-07 15:12:21'),
(109, 'http://localhost/the-learning-guide/bulletin', '::1', '2019-08-07 15:13:22'),
(110, 'http://localhost/the-learning-guide/user/Bulletin/loadRecord/0', '::1', '2019-08-07 15:13:24'),
(111, 'http://localhost/the-learning-guide/school/c4ca4238a0b923820dcc509a6f75849b', '::1', '2019-08-07 15:33:18'),
(112, 'http://localhost/the-learning-guide/Home/fetch_rating', '::1', '2019-08-07 15:33:21'),
(113, 'http://localhost/the-learning-guide/assets/user/img/controls.png', '::1', '2019-08-07 15:33:21'),
(114, 'http://localhost/the-learning-guide/admin/Login/Auth', '::1', '2019-08-07 15:52:38'),
(115, 'http://localhost/the-learning-guide/admin/manage-school', '::1', '2019-08-07 15:52:41'),
(116, 'http://localhost/the-learning-guide/admin/School/ajax_school/0', '::1', '2019-08-07 15:52:41'),
(117, 'http://localhost/the-learning-guide/admin/add-school/1', '::1', '2019-08-07 15:53:06'),
(118, 'http://localhost/the-learning-guide/admin/School/upload_files', '::1', '2019-08-07 15:55:38'),
(119, 'http://localhost/the-learning-guide/admin/School/create_update_school/1', '::1', '2019-08-07 15:55:50'),
(120, 'http://localhost/the-learning-guide/admin/School/create_update_school_special/1', '::1', '2019-08-07 16:47:23'),
(121, 'http://localhost/the-learning-guide/admin/School/create_update_school_primary/1', '::1', '2019-08-07 16:49:00'),
(122, 'http://localhost/the-learning-guide/schools/c4ca4238a0b923820dcc509a6f75849b', '::1', '2019-08-07 16:58:16'),
(123, 'http://localhost/the-learning-guide/admin/', '::1', '2019-08-10 17:34:20'),
(124, 'http://localhost/the-learning-guide/admin/Login', '::1', '2019-08-10 17:34:29'),
(125, 'http://localhost/the-learning-guide/admin/Home/', '::1', '2019-08-10 17:34:56'),
(126, 'http://localhost/the-learning-guide/admin/logout', '::1', '2019-08-10 17:44:12'),
(127, 'http://localhost/the-learning-guide/admin/add-teacher', '::1', '2019-08-10 17:46:26'),
(128, 'http://localhost/the-learning-guide/admin/Bulletin/upload_files', '::1', '2019-08-13 22:09:47'),
(129, 'http://localhost/the-learning-guide/admin/Bulletin/create_update_bulletin', '::1', '2019-08-13 22:10:12'),
(130, 'http://localhost/the-learning-guide/admin/bulletin', '::1', '2019-08-13 22:10:13'),
(131, 'http://localhost/the-learning-guide/admin/add-bulletin/1', '::1', '2019-08-13 22:10:16'),
(132, 'http://localhost/the-learning-guide/admin/add-calendar', '::1', '2019-08-13 22:10:43'),
(133, 'http://localhost/the-learning-guide/admin/add-school', '::1', '2019-08-13 22:10:52'),
(134, 'http://localhost/the-learning-guide/admin/School/create_update_school', '::1', '2019-08-13 22:12:02'),
(135, 'http://localhost/the-learning-guide/admin/Bulletin/create_update_bulletin/1', '::1', '2019-08-18 11:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(15) NOT NULL,
  `txn_id` text NOT NULL,
  `payment_amt` float NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `payment_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_event`
--

CREATE TABLE `transaction_event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(15) NOT NULL,
  `txn_id` text NOT NULL,
  `payment_amt` float NOT NULL,
  `currency_code` varchar(10) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `payment_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulletin_question`
--
ALTER TABLE `bulletin_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `tblsetting`
--
ALTER TABLE `tblsetting`
  ADD PRIMARY KEY (`SettingId`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bulletin`
--
ALTER TABLE `tbl_bulletin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bulletin_review`
--
ALTER TABLE `tbl_bulletin_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_calendar`
--
ALTER TABLE `tbl_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_conversion`
--
ALTER TABLE `tbl_conversion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pageviews`
--
ALTER TABLE `tbl_pageviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_school`
--
ALTER TABLE `tbl_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social_media`
--
ALTER TABLE `tbl_social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_traffic`
--
ALTER TABLE `tbl_traffic`
  ADD PRIMARY KEY (`traffic_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_event`
--
ALTER TABLE `transaction_event`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bulletin_question`
--
ALTER TABLE `bulletin_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `AdminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblsetting`
--
ALTER TABLE `tblsetting`
  MODIFY `SettingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_bulletin`
--
ALTER TABLE `tbl_bulletin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_bulletin_review`
--
ALTER TABLE `tbl_bulletin_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_calendar`
--
ALTER TABLE `tbl_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;
--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_conversion`
--
ALTER TABLE `tbl_conversion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `lang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_newsletter`
--
ALTER TABLE `tbl_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pageviews`
--
ALTER TABLE `tbl_pageviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_school`
--
ALTER TABLE `tbl_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_social_media`
--
ALTER TABLE `tbl_social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_traffic`
--
ALTER TABLE `tbl_traffic`
  MODIFY `traffic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_event`
--
ALTER TABLE `transaction_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
