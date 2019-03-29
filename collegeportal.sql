-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 08:30 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegeportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_information`
--

CREATE TABLE `admin_information` (
  `admin_id` bigint(20) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_information`
--

INSERT INTO `admin_information` (`admin_id`, `admin_name`, `admin_username`, `admin_password`) VALUES
(1, 'Administrator', 'admin', '123'),
(2, 'pk', 'adminn', '132');

-- --------------------------------------------------------

--
-- Table structure for table `class_information`
--

CREATE TABLE `class_information` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_information`
--

INSERT INTO `class_information` (`class_id`, `class_name`) VALUES
(1, '12th'),
(2, '13th');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject_information`
--

CREATE TABLE `class_subject_information` (
  `cs_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_subject_information`
--

INSERT INTO `class_subject_information` (`cs_id`, `class_id`, `subject_id`) VALUES
(1, 1, 1),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `datesheet_information`
--

CREATE TABLE `datesheet_information` (
  `datesheet_id` int(11) NOT NULL,
  `exam_type_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datesheet_information`
--

INSERT INTO `datesheet_information` (`datesheet_id`, `exam_type_id`, `class_id`, `subject_id`, `room_id`, `start_time`, `end_time`, `date`) VALUES
(1, 1, 1, 1, 1, '10:00', '11:00', '2018-05-30'),
(2, 1, 1, 3, 1, '10:00', '11:00', '2018-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `event_information`
--

CREATE TABLE `event_information` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_detail` text NOT NULL,
  `event_status` varchar(10) NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_information`
--

INSERT INTO `event_information` (`event_id`, `event_title`, `event_detail`, `event_status`, `event_date`) VALUES
(11, 'KK', '<p>KK</p>\r\n', 'active', '2018-04-28'),
(12, 'll', '<p>ll</p>\r\n', 'active', '2018-03-24'),
(13, 'dsa', '<p>sdasd</p>\r\n', 'active', '2018-03-31'),
(14, 'dssad', '<p>dsasa</p>\r\n', 'active', '2018-03-28'),
(15, 'zxcsa', '<p>sadasds</p>\r\n', 'active', '2018-03-28'),
(16, '4', '<p>fasfs</p>\r\n', 'active', '2018-03-28'),
(17, 'dss', '<p>dsfdsfd</p>\r\n', 'active', '2018-03-28'),
(18, 'sdsasd', '<p>sdsfds</p>\r\n', 'active', '2018-03-28'),
(19, 'xcxcx', '<p>sdsadsa</p>\r\n', 'active', '2018-03-28'),
(20, 'sadsadsad', '<p>asdsasa</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'active', '2018-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `exam_information`
--

CREATE TABLE `exam_information` (
  `exam_id` int(11) NOT NULL,
  `exam_type_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_information`
--

INSERT INTO `exam_information` (`exam_id`, `exam_type_id`, `start_date`, `end_date`, `class_id`) VALUES
(1, 1, '2018-05-24', '2018-05-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_type_information`
--

CREATE TABLE `exam_type_information` (
  `et_id` int(11) NOT NULL,
  `exam_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_type_information`
--

INSERT INTO `exam_type_information` (`et_id`, `exam_type`) VALUES
(1, 'Mid Exam'),
(2, 'Final Exam');

-- --------------------------------------------------------

--
-- Table structure for table `makeup_information`
--

CREATE TABLE `makeup_information` (
  `mu_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `makeup_date` date NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent_information`
--

CREATE TABLE `parent_information` (
  `parent_id` int(11) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `parent_address` text NOT NULL,
  `parent_phone` varchar(11) NOT NULL,
  `parent_gender` varchar(10) NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `parent_username` varchar(255) NOT NULL,
  `parent_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent_information`
--

INSERT INTO `parent_information` (`parent_id`, `parent_name`, `parent_address`, `parent_phone`, `parent_gender`, `parent_email`, `parent_username`, `parent_password`) VALUES
(1, 'Parent One', 'Address of the Parent One', '02001234567', 'male', 'parent1@mail.com', 'parent1', '123');

-- --------------------------------------------------------

--
-- Table structure for table `parent_teacher_chat_information`
--

CREATE TABLE `parent_teacher_chat_information` (
  `msg_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `send_from` tinyint(1) NOT NULL,
  `unread` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent_teacher_chat_information`
--

INSERT INTO `parent_teacher_chat_information` (`msg_id`, `parent_id`, `teacher_id`, `msg`, `send_from`, `unread`, `date`) VALUES
(1, 1, 1, 'O Teacher', 0, 0, '2018-05-15 13:31:24'),
(2, 1, 1, 'ki hal wa tera', 0, 0, '2018-05-15 13:31:29'),
(3, 1, 1, '????', 0, 0, '2018-05-15 13:31:31'),
(4, 1, 1, '112', 1, 0, '2018-05-20 06:31:48'),
(5, 1, 1, 'sad\\', 0, 0, '2018-05-20 06:59:47'),
(6, 1, 1, 'sdsad', 0, 0, '2018-05-20 06:59:50'),
(7, 1, 1, '35132', 0, 0, '2018-05-20 06:59:55'),
(8, 1, 1, '2312', 0, 0, '2018-05-20 06:59:56'),
(9, 1, 1, '321312', 0, 0, '2018-05-20 06:59:58'),
(10, 1, 1, 'dssad', 1, 0, '2018-05-20 07:21:51'),
(11, 1, 1, '123213', 0, 0, '2018-05-20 07:22:07'),
(12, 1, 1, 'dsdsa', 1, 0, '2018-05-20 07:22:17'),
(13, 1, 1, 'asdsa', 1, 0, '2018-05-20 07:22:18'),
(14, 1, 1, 'wfsdfaw', 1, 0, '2018-05-20 07:22:20'),
(15, 1, 1, 'fdgfd', 1, 0, '2018-05-23 08:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `promoted_students_information`
--

CREATE TABLE `promoted_students_information` (
  `previous_class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `promoted_class_id` int(11) NOT NULL,
  `promote_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promoted_students_information`
--

INSERT INTO `promoted_students_information` (`previous_class_id`, `student_id`, `promoted_class_id`, `promote_date`) VALUES
(1, 1, 2, '2018-06-03'),
(1, 2, 2, '2018-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `room_information`
--

CREATE TABLE `room_information` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_information`
--

INSERT INTO `room_information` (`room_id`, `room_name`, `room_no`) VALUES
(1, 'CS Room', 1),
(2, 'Exam Hall', 45);

-- --------------------------------------------------------

--
-- Table structure for table `student_assignment_information`
--

CREATE TABLE `student_assignment_information` (
  `sa_id` int(11) NOT NULL,
  `ta_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `assignment_file` text NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_assignment_information`
--

INSERT INTO `student_assignment_information` (`sa_id`, `ta_id`, `student_id`, `assignment_file`, `upload_date`) VALUES
(0, 1, 1, '../../assets/files/assignments/1721781302SENG321-2008_Group4_RS1.0.doc', '2018-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `student_assignment_marks_information`
--

CREATE TABLE `student_assignment_marks_information` (
  `ta_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `o_marks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_assignment_marks_information`
--

INSERT INTO `student_assignment_marks_information` (`ta_id`, `student_id`, `o_marks`) VALUES
(1, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_information`
--

CREATE TABLE `student_attendance_information` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `lecture_topic` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_status` varchar(5) NOT NULL,
  `attendance_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_attendance_information`
--

INSERT INTO `student_attendance_information` (`class_id`, `subject_id`, `lecture_topic`, `student_id`, `attendance_status`, `attendance_date`) VALUES
(1, 1, 'dsfsd', 1, 'a', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'a', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'a', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'a', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'a', '2018-05-12'),
(1, 1, 'fdg', 1, 'p', '2018-05-12'),
(1, 1, 'fdg', 2, 'a', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'a', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 2, 'p', '2018-05-12'),
(1, 1, 'dsfsd', 1, 'p', '2018-05-29'),
(1, 1, 'dsfsd', 2, 'a', '2018-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `student_exam_marks_information`
--

CREATE TABLE `student_exam_marks_information` (
  `exam_type_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `o_marks` int(11) NOT NULL,
  `marks_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_exam_marks_information`
--

INSERT INTO `student_exam_marks_information` (`exam_type_id`, `class_id`, `subject_id`, `teacher_id`, `student_id`, `o_marks`, `marks_date`) VALUES
(1, 1, 3, 2, 1, 23, '2018-05-31'),
(1, 1, 3, 2, 2, 25, '2018-05-31'),
(1, 1, 1, 1, 1, 34, '2018-05-31'),
(1, 1, 1, 1, 2, 23, '2018-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `student_information`
--

CREATE TABLE `student_information` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `student_address` text NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_gender` varchar(10) NOT NULL,
  `student_cnic` varchar(13) NOT NULL,
  `student_phone` varchar(12) NOT NULL,
  `student_image` text NOT NULL,
  `student_username` varchar(255) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `registration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_information`
--

INSERT INTO `student_information` (`student_id`, `class_id`, `roll_no`, `student_name`, `parent_id`, `student_address`, `student_email`, `student_gender`, `student_cnic`, `student_phone`, `student_image`, `student_username`, `student_password`, `registration_date`) VALUES
(1, 1, 1, 'student', 1, 'student 11th address', 'student1@mail.com', 'male', '0231231231231', '923067815260', '../../assets/images/background - Copy (4).png8', 'student11', '123', '2018-01-01'),
(2, 1, 2, 'ok', 1, '11', 'st@m.com', 'female', '0987665433436', '923088564690', '../../assets/images/background - Copy (4).png8', 'student11 2', '123', '2018-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `student_quiz_marks_information`
--

CREATE TABLE `student_quiz_marks_information` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `o_marks` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `marks_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_teacher_chat_information`
--

CREATE TABLE `student_teacher_chat_information` (
  `msg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `from_send` tinyint(1) NOT NULL,
  `unread` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_teacher_chat_information`
--

INSERT INTO `student_teacher_chat_information` (`msg_id`, `student_id`, `teacher_id`, `msg`, `from_send`, `unread`, `date`) VALUES
(1, 2, 2, 'Oye OK from teacher 2', 1, 0, '2018-05-18 06:30:24'),
(2, 2, 2, 'G Teacher from OK', 0, 0, '2018-05-18 06:31:08'),
(3, 2, 1, 'Hello Hello G ????', 0, 0, '2018-05-18 06:31:25'),
(4, 2, 1, '1`21`', 1, 0, '2018-05-18 06:33:00'),
(5, 2, 1, 'Hello OK from Teacher 1', 1, 0, '2018-05-18 06:39:23'),
(6, 2, 1, 'G sir from ok', 0, 0, '2018-05-18 06:39:54'),
(7, 1, 1, 'Oye Student ???', 1, 0, '2018-05-19 12:49:23'),
(8, 1, 1, 'dfds', 1, 0, '2018-05-19 12:50:52'),
(9, 1, 1, 'sds', 0, 0, '2018-05-19 12:51:12'),
(10, 1, 1, 'Hello Teacher ???', 0, 0, '2018-05-19 13:00:54'),
(11, 1, 1, 'Helllooooooo123123', 0, 0, '2018-05-19 13:02:14'),
(12, 1, 1, 'sa', 1, 0, '2018-05-19 13:30:23'),
(13, 1, 1, 'adsadd', 0, 0, '2018-05-19 13:31:12'),
(14, 1, 1, 'ss', 1, 0, '2018-05-19 13:31:59'),
(15, 1, 1, 'wqe', 0, 0, '2018-05-19 13:32:32'),
(16, 1, 1, 'Hello Teacher g', 0, 0, '2018-05-19 16:05:54'),
(17, 1, 1, 'Kya hal hai ???', 0, 0, '2018-05-19 16:06:02'),
(18, 1, 1, 'G Beta g ', 1, 0, '2018-05-19 16:06:24'),
(19, 1, 1, 'Al\'hamdulilah Theak hu ap sunao', 1, 0, '2018-05-19 16:06:41'),
(20, 1, 1, 'Main b theak hu Sir g', 0, 0, '2018-05-20 06:15:57'),
(21, 1, 1, 'or kya kr rahy ho ap sir g ?', 0, 0, '2018-05-20 06:16:19'),
(22, 1, 1, 'dsa', 0, 0, '2018-05-20 06:19:14'),
(23, 1, 1, 'Hello', 1, 0, '2018-05-23 07:55:29'),
(24, 1, 1, 'Hello from teacher', 1, 0, '2018-05-23 08:30:59'),
(25, 1, 1, 'www', 1, 0, '2018-05-23 08:31:20'),
(26, 1, 1, 'msg from student', 0, 0, '2018-05-23 08:32:44'),
(27, 2, 1, '1`3223', 0, 0, '2018-05-23 08:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `subject_information`
--

CREATE TABLE `subject_information` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `t_marks` int(11) NOT NULL,
  `p_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_information`
--

INSERT INTO `subject_information` (`subject_id`, `subject_name`, `t_marks`, `p_marks`) VALUES
(1, 'English', 100, 40),
(2, 'Urdu', 100, 40),
(3, 'Math', 100, 40);

-- --------------------------------------------------------

--
-- Table structure for table `subject_syllbus_information`
--

CREATE TABLE `subject_syllbus_information` (
  `ss_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_contents` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_assignment_information`
--

CREATE TABLE `teacher_assignment_information` (
  `ta_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `assignment_file` text NOT NULL,
  `upload_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_assignment_information`
--

INSERT INTO `teacher_assignment_information` (`ta_id`, `class_id`, `subject_id`, `description`, `assignment_file`, `upload_date`, `start_date`, `end_date`) VALUES
(1, 1, 1, 'ljnl', '../../assets/files/assignments/953673690C++ tutorials Complete Document.docx', '2018-05-16', '0000-00-00', '2018-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_information`
--

CREATE TABLE `teacher_information` (
  `teacher_id` int(11) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `teacher_address` text NOT NULL,
  `teacher_qualification` varchar(255) NOT NULL,
  `teacher_gender` varchar(10) NOT NULL,
  `teacher_email` varchar(255) NOT NULL,
  `teacher_phone` varchar(11) NOT NULL,
  `teacher_cnic` varchar(13) NOT NULL,
  `teacher_image` text NOT NULL,
  `teacher_username` varchar(255) NOT NULL,
  `teacher_password` varchar(255) NOT NULL,
  `hire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_information`
--

INSERT INTO `teacher_information` (`teacher_id`, `teacher_name`, `teacher_address`, `teacher_qualification`, `teacher_gender`, `teacher_email`, `teacher_phone`, `teacher_cnic`, `teacher_image`, `teacher_username`, `teacher_password`, `hire_date`) VALUES
(1, 'Teacher', 'teacher address', 'BSCS', 'male', 'teacher1@mail.com', '01232123123', '0321030212039', '../../assets/images/logo.png', 'teacher1', '123', '2016-06-01'),
(2, 'Teacher Two', 'tow', 'two', 'female', '123@ma.com', '12222222222', '1232132123112', '../../assets/images/background - Copy (2).png', 'teacher2', '123', '2018-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_lecture_information`
--

CREATE TABLE `teacher_lecture_information` (
  `tl_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `lecture_no` int(11) NOT NULL,
  `description` text NOT NULL,
  `upload_date` date NOT NULL,
  `lecture_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject_information`
--

CREATE TABLE `teacher_subject_information` (
  `ts_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_subject_information`
--

INSERT INTO `teacher_subject_information` (`ts_id`, `teacher_id`, `class_id`, `subject_id`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `timetable_information`
--

CREATE TABLE `timetable_information` (
  `timetable_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `room_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable_information`
--

INSERT INTO `timetable_information` (`timetable_id`, `class_id`, `subject_id`, `teacher_id`, `start_time`, `end_time`, `room_id`, `day`) VALUES
(2, 1, 1, 1, '10:00:00', '23:00:00', 2, 'tuesday');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_information`
--
ALTER TABLE `admin_information`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `class_information`
--
ALTER TABLE `class_information`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_subject_information`
--
ALTER TABLE `class_subject_information`
  ADD PRIMARY KEY (`cs_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `datesheet_information`
--
ALTER TABLE `datesheet_information`
  ADD PRIMARY KEY (`datesheet_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `event_information`
--
ALTER TABLE `event_information`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `exam_information`
--
ALTER TABLE `exam_information`
  ADD PRIMARY KEY (`exam_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `exam_type_id` (`exam_type_id`);

--
-- Indexes for table `exam_type_information`
--
ALTER TABLE `exam_type_information`
  ADD PRIMARY KEY (`et_id`);

--
-- Indexes for table `makeup_information`
--
ALTER TABLE `makeup_information`
  ADD PRIMARY KEY (`mu_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `parent_information`
--
ALTER TABLE `parent_information`
  ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `parent_teacher_chat_information`
--
ALTER TABLE `parent_teacher_chat_information`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `room_information`
--
ALTER TABLE `room_information`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `student_assignment_information`
--
ALTER TABLE `student_assignment_information`
  ADD PRIMARY KEY (`sa_id`),
  ADD KEY `ta_id` (`ta_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_assignment_marks_information`
--
ALTER TABLE `student_assignment_marks_information`
  ADD KEY `ta_id` (`ta_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_attendance_information`
--
ALTER TABLE `student_attendance_information`
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_exam_marks_information`
--
ALTER TABLE `student_exam_marks_information`
  ADD KEY `class_id` (`class_id`),
  ADD KEY `exam_type_id` (`exam_type_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_information`
--
ALTER TABLE `student_information`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `student_quiz_marks_information`
--
ALTER TABLE `student_quiz_marks_information`
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `student_teacher_chat_information`
--
ALTER TABLE `student_teacher_chat_information`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `subject_information`
--
ALTER TABLE `subject_information`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_syllbus_information`
--
ALTER TABLE `subject_syllbus_information`
  ADD PRIMARY KEY (`ss_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `teacher_assignment_information`
--
ALTER TABLE `teacher_assignment_information`
  ADD PRIMARY KEY (`ta_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `teacher_information`
--
ALTER TABLE `teacher_information`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teacher_lecture_information`
--
ALTER TABLE `teacher_lecture_information`
  ADD PRIMARY KEY (`tl_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `teacher_subject_information`
--
ALTER TABLE `teacher_subject_information`
  ADD PRIMARY KEY (`ts_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `timetable_information`
--
ALTER TABLE `timetable_information`
  ADD PRIMARY KEY (`timetable_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `room_id` (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_information`
--
ALTER TABLE `admin_information`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_information`
--
ALTER TABLE `class_information`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `class_subject_information`
--
ALTER TABLE `class_subject_information`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `datesheet_information`
--
ALTER TABLE `datesheet_information`
  MODIFY `datesheet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_information`
--
ALTER TABLE `event_information`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `exam_information`
--
ALTER TABLE `exam_information`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `exam_type_information`
--
ALTER TABLE `exam_type_information`
  MODIFY `et_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `makeup_information`
--
ALTER TABLE `makeup_information`
  MODIFY `mu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_information`
--
ALTER TABLE `parent_information`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parent_teacher_chat_information`
--
ALTER TABLE `parent_teacher_chat_information`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `room_information`
--
ALTER TABLE `room_information`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_information`
--
ALTER TABLE `student_information`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_teacher_chat_information`
--
ALTER TABLE `student_teacher_chat_information`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `subject_information`
--
ALTER TABLE `subject_information`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject_syllbus_information`
--
ALTER TABLE `subject_syllbus_information`
  MODIFY `ss_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_assignment_information`
--
ALTER TABLE `teacher_assignment_information`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_information`
--
ALTER TABLE `teacher_information`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_lecture_information`
--
ALTER TABLE `teacher_lecture_information`
  MODIFY `tl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_subject_information`
--
ALTER TABLE `teacher_subject_information`
  MODIFY `ts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timetable_information`
--
ALTER TABLE `timetable_information`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_subject_information`
--
ALTER TABLE `class_subject_information`
  ADD CONSTRAINT `class_subject_information_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `class_subject_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `datesheet_information`
--
ALTER TABLE `datesheet_information`
  ADD CONSTRAINT `datesheet_information_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datesheet_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datesheet_information_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `room_information` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_information`
--
ALTER TABLE `exam_information`
  ADD CONSTRAINT `exam_information_ibfk_1` FOREIGN KEY (`exam_type_id`) REFERENCES `exam_type_information` (`et_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_information_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `makeup_information`
--
ALTER TABLE `makeup_information`
  ADD CONSTRAINT `makeup_information_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `makeup_information_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `makeup_information_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `makeup_information_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `room_information` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent_teacher_chat_information`
--
ALTER TABLE `parent_teacher_chat_information`
  ADD CONSTRAINT `parent_teacher_chat_information_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parent_information` (`parent_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parent_teacher_chat_information_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_assignment_information`
--
ALTER TABLE `student_assignment_information`
  ADD CONSTRAINT `student_assignment_information_ibfk_1` FOREIGN KEY (`ta_id`) REFERENCES `teacher_assignment_information` (`ta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_assignment_information_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_information` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_assignment_marks_information`
--
ALTER TABLE `student_assignment_marks_information`
  ADD CONSTRAINT `student_assignment_marks_information_ibfk_1` FOREIGN KEY (`ta_id`) REFERENCES `teacher_assignment_information` (`ta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_assignment_marks_information_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student_information` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_attendance_information`
--
ALTER TABLE `student_attendance_information`
  ADD CONSTRAINT `student_attendance_information_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_attendance_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_attendance_information_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student_information` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_exam_marks_information`
--
ALTER TABLE `student_exam_marks_information`
  ADD CONSTRAINT `student_exam_marks_information_ibfk_1` FOREIGN KEY (`exam_type_id`) REFERENCES `exam_type_information` (`et_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_marks_information_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_marks_information_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_marks_information_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_exam_marks_information_ibfk_5` FOREIGN KEY (`student_id`) REFERENCES `student_information` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_information`
--
ALTER TABLE `student_information`
  ADD CONSTRAINT `student_information_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parent_information` (`parent_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_information_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_quiz_marks_information`
--
ALTER TABLE `student_quiz_marks_information`
  ADD CONSTRAINT `student_quiz_marks_information_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_quiz_marks_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_quiz_marks_information_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student_information` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_quiz_marks_information_ibfk_4` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_teacher_chat_information`
--
ALTER TABLE `student_teacher_chat_information`
  ADD CONSTRAINT `student_teacher_chat_information_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_information` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_teacher_chat_information_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_syllbus_information`
--
ALTER TABLE `subject_syllbus_information`
  ADD CONSTRAINT `subject_syllbus_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_syllbus_information_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_assignment_information`
--
ALTER TABLE `teacher_assignment_information`
  ADD CONSTRAINT `teacher_assignment_information_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_assignment_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_lecture_information`
--
ALTER TABLE `teacher_lecture_information`
  ADD CONSTRAINT `teacher_lecture_information_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_lecture_information_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_lecture_information_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_subject_information`
--
ALTER TABLE `teacher_subject_information`
  ADD CONSTRAINT `teacher_subject_information_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_subject_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_subject_information_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetable_information`
--
ALTER TABLE `timetable_information`
  ADD CONSTRAINT `timetable_information_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class_information` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_information_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_information` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_information_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_information` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetable_information_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `room_information` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
