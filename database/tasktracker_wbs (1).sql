-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2023 at 07:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tasktracker_wbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(10) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_designation` varchar(50) NOT NULL,
  `emp_email` varchar(50) NOT NULL,
  `emp_mob` bigint(11) NOT NULL,
  `emp_dept` varchar(50) NOT NULL,
  `emp_pwd` varchar(50) NOT NULL,
  `emp_rm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`id`, `emp_name`, `emp_designation`, `emp_email`, `emp_mob`, `emp_dept`, `emp_pwd`, `emp_rm`) VALUES
(1, 'Anurag Joshi', 'Associate Account Director', 'anurag.joshi@webeesocial.com', 9999843492, 'CS', '1234', ''),
(2, 'Deepanshu Rawat', 'Sr. Executive - Business Development', 'deepanshu.rawat@webeesocial.com', 9910227749, 'CS', '1234', ''),
(3, 'Shubham Ahlawat', 'Sr. Account Executive', 'shubham.ahlawat@webeesocial.com', 8882295717, 'CS', '1234', ''),
(4, 'Deepali Khemka', 'Associate Account Manager', 'deepali.khemka@webeesocial.com', 9968928171, 'CS', '1234', ''),
(5, 'Renuka', 'Account Executive', 'renuka.sethia@webeesocial.com', 8826332072, 'CS', '1234', ''),
(6, 'Vikram Pratap Malhotra', 'Associate Account Manager', 'vikram.malhotra@webeesocial.com', 9910774523, 'CS', '1234', ''),
(7, 'Alice Tanushree', 'Jr. Account Executive', 'alice.chaudhary@webeesocial.com', 9306502953, 'CS', '1234', ''),
(8, 'Bhavesh', 'Digital Marketing Intern', 'bhavesh.webeesocial@gmail.com', 8882216163, 'CS', '1234', ''),
(9, 'Ayushi Gupta', 'Associate Account Manager', 'ayushi.gupta@webeesocial.com', 9873288691, 'CS', '1234', ''),
(10, 'Pradeep Rajput', 'Sr. Media Planner', 'pradeep.rajput@webeesocial.com', 9582156184, 'Media', '1234', ''),
(11, 'Pallavi Chauhan', 'Sr. Executive - Digital Marketing', 'pallavi.chauhan@webeesocial.com', 9773832455, 'Media', '1234', ''),
(12, 'Shubham Dhyani', 'Sr. Executive - Digital Marketing', 'shubham.dhyani@webeesocial.com', 8800340587, 'Media', '1234', ''),
(13, 'Lata Sanwal', 'Sr. Executive - Digital Marketing', 'lata.sanwal@gmail.com', 8375875718, 'Media', '1234', ''),
(14, 'Roshan Jajoriya', 'Senior UI Developer', 'roshan.jajoriya@webeesocial.com', 7503102892, 'Tech', '1234', ''),
(15, 'Chetan Singh', 'PHP Developer', 'chetan.singh@webeesocial.com', 97535, 'Tech', '1234', ''),
(16, 'Ajay Kumar', 'Jr. PHP Developer', 'ajay.kumar@webeesocial.com', 9718804685, 'Tech', '12345', ''),
(17, 'Himanshu Sharma', 'Jr. Web Developer', 'himanshu.sharma@webeesocial.com', 9855765742, 'Tech', '1234', ''),
(18, 'Princy Sharma', 'Finance Executive', 'finance@webeesocial.com', 8920277441, 'Finance', '1234', ''),
(19, 'Deepsha Saha', 'Copy Supervisor', 'deepsha.saha@webeesocial.com', 9874596788, 'Copy', '1234', ''),
(20, 'Shaifali Saini', 'Associate Copy Supervisor', 'shefali.saini@webeesocial.com', 9716658955, 'Copy', '1234', ''),
(21, 'Niyati', 'Sr. Copywriter', 'niyati.kaushik@webeesocial.com', 9870601148, 'Copy', '1234', ''),
(22, 'Ritushree Bharali', 'Copywriter', 'ritushree.bharali@webeesocial.com', 6001564544, 'Copy', '1234', ''),
(23, 'Manvi Gupta', 'Copywriter', 'manvi.gupta@webeesocial.com', 6387598236, 'Copy', '1234', ''),
(24, 'Aiman', 'Jr. Content writer', 'aiman.parween@webeesocial.com', 9142403012, 'Copy', '1234', ''),
(25, 'Ritika Singh', 'Copywriter', 'ritika.singh@webeesocial.com', 8588953043, 'Copy', '1234', ''),
(26, 'Jhanavi Verma', 'Content Writer Intern', 'jhanavi.webeesocial@gmail.com', 8178627804, 'Copy', '1234', ''),
(27, 'Aishni', 'Copywriter', 'Aishni.jain@webeesocial.com', 9582316999, 'Copy', '1234', ''),
(28, 'Vrinda', 'Sr. Copywriter', 'vrinda.bharara@webeesocial.com', 8750940693, 'Copy', '1234', ''),
(29, 'Animesh Priyadarshi', 'Art Director', 'animesh.kumar@webeesocial.com', 9958241034, 'Design', '1234', ''),
(30, 'Tarun Chauhan', 'Art Supervisor', 'tarun.singh@webeesocial.com', 7987629830, 'Design', '1234', ''),
(31, 'Shreyansh', 'Art Director', 'shreyansh.jain@webeesocial.com', 8860211293, 'Design', '1234', ''),
(32, 'Himanshu Lodhiwal', 'Graphic Designer', 'himanshu.lodhiwal@webeesocial.com', 9599613143, 'Design', '1234', ''),
(33, 'Yashpal', 'Graphic Designer', 'yashpal@webeesocial.com', 9953840569, 'Design', '1234', ''),
(34, 'Anila Mehra', 'Graphic Designer', 'anila.mehra@webeesocial.com', 7838674342, 'Design', '1234', ''),
(35, 'Ishika Ghosh', 'Graphic Design Intern', 'ishika.webeesocial@gmail.com', 84870, 'Design', '1234', ''),
(36, 'Almas Ameer', 'Graphic Design Intern', 'almas.webeesocial@gmail.com', 7652074576, 'Design', '1234', ''),
(37, 'Krishna Lamani', 'Graphic Design Intern', 'krishna.webeesocial@gmail.com', 9359963647, 'Design', '1234', ''),
(38, 'Shabana Khatoon', 'HR & Admin Executive', 'hr@webeesocial.com', 9625335880, 'HR', '1234', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id` int(20) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `notes` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_task`
--

INSERT INTO `tbl_task` (`id`, `emp_id`, `project_name`, `description`, `start_date`, `end_date`, `notes`, `date_created`, `date_updated`) VALUES
(32, 16, 'Theodore Wynn', 'Asperiores veniam n', '1985-09-17 04:16:00', '2007-10-05 12:25:00', 'Voluptas omnis earum', '2023-02-20 22:30:11', '2023-02-20 22:30:11'),
(39, 16, 'Makup Secret', 'sakdflksaasdfasdf', '2023-08-19 10:00:00', '2023-08-19 19:00:00', 'asdfasdf', '2023-02-21 11:40:41', '2023-02-21 11:40:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
