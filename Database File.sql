-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 04:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cpp_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `cmp_id` varchar(36) NOT NULL,
  `stud_id` varchar(36) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `cmp_date` date NOT NULL DEFAULT current_timestamp(),
  `cmp_text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`cmp_id`, `stud_id`, `room_id`, `cmp_date`, `cmp_text`) VALUES
('65a928ca7049e', '65a90728992a5', '65a91f53d6040', '2024-01-18', 'No RO water is provided as mentioned aminity'),
('65a929834d9c2', '6597a5cb79f3f', '65a91e29e163d', '2024-01-18', 'Parking is not available'),
('660febcb5e09e', '6597a5cb79f3f', '65a91efa10a69', '2024-04-05', 'Parking is not provided.');

-- --------------------------------------------------------

--
-- Table structure for table `fav_rooms`
--

CREATE TABLE `fav_rooms` (
  `fav_id` varchar(36) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `stud_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fav_rooms`
--

INSERT INTO `fav_rooms` (`fav_id`, `room_id`, `stud_id`) VALUES
('65a921b50e87e', '65a91d3829d06', '6597a5cb79f3f'),
('65a9298f9470f', '65a91efa10a69', '65a90728992a5'),
('65e093a303226', '65a91d3829d06', '65a907621e546'),
('661fbe13d1fef', '65a91e29e163d', '6597a5cb79f3f');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` varchar(36) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `owner_id` varchar(36) NOT NULL,
  `msg_date` date NOT NULL DEFAULT current_timestamp(),
  `msg_subject` varchar(200) NOT NULL,
  `msg_text` varchar(500) NOT NULL,
  `msg_reply` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `room_id`, `owner_id`, `msg_date`, `msg_subject`, `msg_text`, `msg_reply`) VALUES
('65a930a08758r', '65a91e29e163d', '6597959845f9a', '2024-01-18', 'Demo Msg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', 'Okay'),
('65a930b38f0fc', '65a91f53d6040', '659a7e1988506', '2024-01-18', 'False information is uploaded about room', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', 'Sorry about that, I am changing it now'),
('661fc25b0355f', '65a91e29e163d', '6597959845f9a', '2024-04-17', 'Regarding to complaint raised by students', 'Not provided amenities you mentioned', 'Sorry for that i will edit those amenities');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `owner_id` varchar(36) NOT NULL,
  `owner_photo` varchar(500) NOT NULL,
  `owner_fname` varchar(20) NOT NULL,
  `owner_lname` varchar(20) NOT NULL,
  `owner_phno` varchar(11) NOT NULL,
  `owner_email` varchar(60) NOT NULL,
  `owner_username` varchar(30) NOT NULL,
  `owner_password` varchar(30) NOT NULL,
  `acs_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `owner_photo`, `owner_fname`, `owner_lname`, `owner_phno`, `owner_email`, `owner_username`, `owner_password`, `acs_date`) VALUES
('65979560555e9', '../images/owners/default_owner.png', 'Ramesh', 'Rajput', '1234567890', 'rajputramesh45@gmail.com', 'ruser2', 'Ruser@2', '2024-01-05'),
('6597959845f9a', '../images/owners/man2.jpg', 'Deven', 'Patil', '9863254170', 'devenpatil09@gmail.com', 'ruser1', 'Ruser@1', '2024-01-05'),
('659a7e1988506', '../images/owners/man1.jpg', 'Mangesh ', 'Sonawane', '7498780953', 'mangu32sonawane@gmail.com ', 'ruser4', 'Ruser@4', '2024-01-07'),
('65a909bc06404', '../images/owners/default_owner.png', 'Suresh', 'Shinde', '5678941210', 'suresh12@gmail.com ', 'ruser3', 'Ruser@3', '2024-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `request_call`
--

CREATE TABLE `request_call` (
  `req_id` varchar(36) NOT NULL,
  `stud_id` varchar(36) NOT NULL,
  `owner_id` varchar(36) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `req_date` date NOT NULL DEFAULT current_timestamp(),
  `req_status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_call`
--

INSERT INTO `request_call` (`req_id`, `stud_id`, `owner_id`, `room_id`, `req_date`, `req_status`) VALUES
('65a92f8c5e014', '65a90728992a5', '6597959845f9a', '65a91e29e163d', '2024-02-06', ''),
('65acac8f4b2d7', '6597a5cb79f3f', '6597959845f9a', '65a91e29e163d', '2024-01-21', 'accepted'),
('65acac92d96f0', '6597a5cb79f3f', '659a7e1988506', '65a91efa10a69', '2024-02-06', ''),
('65acac979c4a5', '6597a5cb79f3f', '659a7e1988506', '65a91f53d6040', '2024-01-21', ''),
('65e0961282d22', '65a907621e546', '659a7e1988506', '65a91efa10a69', '2024-02-29', ''),
('65e09616509d1', '65a907621e546', '6597959845f9a', '65a91e29e163d', '2024-02-29', ''),
('661fc16c7a747', '6597a5cb79f3f', '6597959845f9a', '65a91d3829d06', '2024-04-17', '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` varchar(36) NOT NULL,
  `owner_id` varchar(36) NOT NULL,
  `room_upload_date` date NOT NULL DEFAULT current_timestamp(),
  `room_gender` varchar(50) NOT NULL,
  `room_rent` varchar(10) NOT NULL,
  `room_add` varchar(500) NOT NULL,
  `room_status` varchar(20) NOT NULL,
  `room_available_date` date NOT NULL,
  `room_type` varchar(12) NOT NULL,
  `room_beds` int(11) NOT NULL,
  `room_lat` varchar(200) NOT NULL,
  `room_lng` varchar(200) NOT NULL,
  `room_am` varchar(1024) NOT NULL,
  `room_tnc` varchar(1024) NOT NULL,
  `room_views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `owner_id`, `room_upload_date`, `room_gender`, `room_rent`, `room_add`, `room_status`, `room_available_date`, `room_type`, `room_beds`, `room_lat`, `room_lng`, `room_am`, `room_tnc`, `room_views`) VALUES
('65a91d3829d06', '6597959845f9a', '2024-01-16', 'Male', '1999', '123, Pitambar  Colony, Deopur, Dhule', 'Available', '2024-02-01', 'Shared', 6, '20.922384162258837', '74.78126951271517', '1. A cupboard for keeping gadgets, books, clothes, etc\r\n2. 24 Hrs water supply', '1. No external persons allowed without permission\n2. No pets allowed ', 182),
('65a91e29e163d', '6597959845f9a', '2024-01-18', 'Fe-Male', '1499', '123,  Vidyanagar, Deopur, Dhule', 'Available', '2024-01-31', 'Personal', 1, '20.922649141616375', '74.78080059122473', '', '1. No pets allowed\r\n2. If any damage to property identified, then it will be charged from tentant.', 104),
('65a91efa10a69', '659a7e1988506', '2024-01-18', 'Fe-Male', '1699', '124, Sharda Nagar, Deopur, Dhule', 'Not Available', '2024-02-01', 'Personal', 1, '20.924975113144455', '74.78343616538244', '1. Food Offering\r\n2. Room Cleaning\r\n3. Washing machine for cloths will be provided', '1. No Alcohol consumption allowed', 41),
('65a91f53d6040', '659a7e1988506', '2024-01-18', 'Male', '1399', '123, Vidya Nagar,Deopur, Dhule', 'Available', '2024-01-31', 'Personal', 1, '20.92224663497477', '74.78025905710501', '1. Room Cleaning\r\n2. Food Offering', '1. No external persons allowed without permission \r\n2. No pets allowed ', 23);

-- --------------------------------------------------------

--
-- Table structure for table `room_aminities`
--

CREATE TABLE `room_aminities` (
  `ram_id` int(11) NOT NULL,
  `ram_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_aminities`
--

INSERT INTO `room_aminities` (`ram_id`, `ram_name`) VALUES
(1, 'Wi-Fi'),
(2, 'RO Water'),
(3, 'Drinking Water'),
(4, 'Electricity'),
(5, 'Bed Blanket'),
(6, 'Bed Mattress'),
(7, 'House Keeping'),
(8, 'Laundry'),
(9, 'Common Bathroom and Toilet'),
(10, 'Separate Bathroom and Toilet for Each Room'),
(11, 'Light Bulbs'),
(12, 'TV'),
(13, 'Study Chair'),
(14, 'Study Table'),
(15, 'Personal Locker'),
(16, 'Parking');

-- --------------------------------------------------------

--
-- Table structure for table `room_aminities_link`
--

CREATE TABLE `room_aminities_link` (
  `ram_id` int(11) NOT NULL,
  `room_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_aminities_link`
--

INSERT INTO `room_aminities_link` (`ram_id`, `room_id`) VALUES
(1, '65a91d3829d06'),
(3, '65a91d3829d06'),
(4, '65a91d3829d06'),
(6, '65a91d3829d06'),
(7, '65a91d3829d06'),
(8, '65a91d3829d06'),
(9, '65a91d3829d06'),
(11, '65a91d3829d06'),
(13, '65a91d3829d06'),
(14, '65a91d3829d06'),
(1, '65b34f7086bee'),
(2, '65b34f7086bee'),
(5, '65b34f7086bee'),
(2, '65b34f93d0460'),
(5, '65b34f93d0460'),
(8, '65b34f93d0460'),
(10, '65b34f93d0460'),
(2, '65a91f53d6040'),
(3, '65a91f53d6040'),
(4, '65a91f53d6040'),
(10, '65a91f53d6040'),
(11, '65a91f53d6040'),
(13, '65a91f53d6040'),
(14, '65a91f53d6040'),
(2, '65a91efa10a69'),
(3, '65a91efa10a69'),
(4, '65a91efa10a69'),
(5, '65a91efa10a69'),
(6, '65a91efa10a69'),
(10, '65a91efa10a69'),
(11, '65a91efa10a69'),
(13, '65a91efa10a69'),
(14, '65a91efa10a69'),
(16, '65a91efa10a69'),
(2, '65a91e29e163d'),
(3, '65a91e29e163d'),
(4, '65a91e29e163d'),
(5, '65a91e29e163d'),
(6, '65a91e29e163d'),
(7, '65a91e29e163d'),
(10, '65a91e29e163d'),
(11, '65a91e29e163d'),
(13, '65a91e29e163d'),
(14, '65a91e29e163d'),
(16, '65a91e29e163d');

-- --------------------------------------------------------

--
-- Table structure for table `room_img`
--

CREATE TABLE `room_img` (
  `img_id` int(11) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `img_path` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_img`
--

INSERT INTO `room_img` (`img_id`, `room_id`, `img_path`) VALUES
(12, '65a91d3829d06', '../images/rooms29121335_468638581.jpg'),
(13, '65a91d3829d06', '../images/rooms88983693_468638582.jpg'),
(14, '65a91d3829d06', '../images/rooms26703971_468638586.jpg'),
(15, '65a91d3829d06', '../images/rooms61815155_468638593.jpg'),
(16, '65a91e29e163d', '../images/rooms96828891_single_room_with_ensuite1.jpg'),
(17, '65a91e29e163d', '../images/rooms37328271_single_room_with_ensuite-768x512.jpg'),
(18, '65a91efa10a69', '../images/rooms55762109_disabled_room1.jpg'),
(19, '65a91efa10a69', '../images/rooms96399823_disabled_room2.jpg'),
(20, '65a91efa10a69', '../images/rooms37781167_disabled_room3.jpg'),
(21, '65a91f53d6040', '../images/rooms28849199_corner_room1.jpg'),
(22, '65a91f53d6040', '../images/rooms84269588_corner_room2.jpg'),
(23, '65a91f53d6040', '../images/rooms18909134_single_communal1.jpg'),
(24, '65b34f7086bee', '../images/rooms79049820_Capture.PNG'),
(25, '65b34f93d0460', '../images/rooms48992223_Capture.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `room_reviews`
--

CREATE TABLE `room_reviews` (
  `rr_id` varchar(36) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `rr_date` date NOT NULL DEFAULT current_timestamp(),
  `rr_rating` int(11) NOT NULL,
  `rr_review` varchar(500) NOT NULL,
  `stud_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_reviews`
--

INSERT INTO `room_reviews` (`rr_id`, `room_id`, `rr_date`, `rr_rating`, `rr_review`, `stud_id`) VALUES
('65a922d249131', '65a91d3829d06', '2024-01-18', 4, 'Good condition of room. \r\nAminities are also given as mentioned.', '6597a5cb79f3f'),
('65a9277644351', '65a91e29e163d', '2024-01-18', 4, 'Good', '6597a5cb79f3f'),
('65a927cd1ad4d', '65a91f53d6040', '2024-01-18', 3, 'Good', '6597a5cb79f3f'),
('65a92823eabd8', '65a91efa10a69', '2024-01-18', 3, 'Good', '6597a5cb79f3f'),
('65a9294d18e30', '65a91f53d6040', '2024-01-18', 2, 'No RO water provided ', '65a90728992a5'),
('65e093d4a2a4b', '65a91d3829d06', '2024-02-29', 5, 'Nice room', '65a907621e546'),
('65e095cb2915b', '65a91e29e163d', '2024-02-29', 3, 'Nice', '65a907621e546');

-- --------------------------------------------------------

--
-- Table structure for table `society_reviews`
--

CREATE TABLE `society_reviews` (
  `sr_id` varchar(36) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `sr_date` date NOT NULL DEFAULT current_timestamp(),
  `sr_rating` varchar(10) NOT NULL,
  `sr_area` varchar(200) NOT NULL,
  `sr_review` varchar(500) NOT NULL,
  `stud_id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `society_reviews`
--

INSERT INTO `society_reviews` (`sr_id`, `room_id`, `sr_date`, `sr_rating`, `sr_area`, `sr_review`, `stud_id`) VALUES
('65a924486abf4', '65a91d3829d06', '2024-01-18', 'Very Good', 'Vidya Nagar ', 'Good area, nearby facilities are also there like medicals, grocery shops, hospitals.', '6597a5cb79f3f'),
('65e0950e167a7', '65a91d3829d06', '2024-02-29', 'Very Good', 'Vidya Nagar ', 'Good area.', '65a907621e546');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_id` varchar(36) NOT NULL,
  `stud_photo` varchar(500) NOT NULL,
  `stud_fname` varchar(20) NOT NULL,
  `stud_lname` varchar(20) NOT NULL,
  `stud_phno` varchar(11) NOT NULL,
  `stud_email` varchar(60) NOT NULL,
  `stud_gender` varchar(6) NOT NULL,
  `stud_edu_bg` varchar(50) NOT NULL,
  `stud_college_name` varchar(50) NOT NULL,
  `stud_hometown` varchar(50) NOT NULL,
  `stud_gd_name` varchar(20) NOT NULL,
  `stud_gd_phno` varchar(10) NOT NULL,
  `stud_username` varchar(30) NOT NULL,
  `stud_password` varchar(30) NOT NULL,
  `acs_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `stud_photo`, `stud_fname`, `stud_lname`, `stud_phno`, `stud_email`, `stud_gender`, `stud_edu_bg`, `stud_college_name`, `stud_hometown`, `stud_gd_name`, `stud_gd_phno`, `stud_username`, `stud_password`, `acs_date`) VALUES
('6597a5cb79f3f', '../images/students/stud1.jpg', 'Ankit', 'Rajput', '9874563220', 'rajputankit230@www.com', 'Male', 'Studying in 3rd year CSE', 'SSVPS', 'Dhule', 'Pradipsing Rajput', '1234567890', 'user1', 'User@1', '2024-01-05'),
('65a906ba6cd18', '../images/students/default_student.png', 'Pranav', 'Shinde', '9874563211', 'pranavshinde@gmail.com', 'Male', 'CSE 3rd year', 'SSVPS', 'Dhule', 'Yuvraj Shinde', '4569871230', 'user2', 'User@2', '2024-01-18'),
('65a907621e546', '../images/students/default_student.png', 'Rohit', 'Shewale', '3365897401', 'rohitshewale@gmail.com', 'Male', 'CSE 3rd year', 'SSVPS', 'Dhule', 'Sharad Shewale', '8963547812', 'user4', 'User@4', '2024-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `student_reviews`
--

CREATE TABLE `student_reviews` (
  `str_id` varchar(36) NOT NULL,
  `stud_id` varchar(36) NOT NULL,
  `owner_id` varchar(36) NOT NULL,
  `str_date` date NOT NULL DEFAULT current_timestamp(),
  `str_rating` int(11) NOT NULL,
  `str_review` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_reviews`
--

INSERT INTO `student_reviews` (`str_id`, `stud_id`, `owner_id`, `str_date`, `str_rating`, `str_review`) VALUES
('65e31ddfd4c87', '6597a5cb79f3f', '6597959845f9a', '2024-03-02', 3, 'Not Maintained Room Nicely.'),
('661fc05363bc1', '65a907621e546', '6597959845f9a', '2024-04-17', 5, 'Good Behaviour, maintained room nicely');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tt_id` varchar(36) NOT NULL,
  `stud_id` varchar(36) NOT NULL,
  `owner_id` varchar(36) NOT NULL,
  `room_id` varchar(36) NOT NULL,
  `added_date` date NOT NULL,
  `removed_date` date NOT NULL,
  `still_tenant` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tt_id`, `stud_id`, `owner_id`, `room_id`, `added_date`, `removed_date`, `still_tenant`) VALUES
('65c37dbc79766', '6597a5cb79f3f', '6597959845f9a', '65a91d3829d06', '2024-02-07', '2024-03-02', 'No'),
('65e31f0768690', '65a907621e546', '6597959845f9a', '65a91e29e163d', '2024-03-02', '2024-04-17', 'No'),
('65e320dc98921', '6597a5cb79f3f', '659a7e1988506', '65a91efa10a69', '2024-03-02', '0000-00-00', 'Yes'),
('661fc06fd00f7', '65a906ba6cd18', '6597959845f9a', '65a91e29e163d', '2024-04-17', '0000-00-00', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `user_owner`
--

CREATE TABLE `user_owner` (
  `user_owner_id` int(11) NOT NULL,
  `owner_id` varchar(36) NOT NULL,
  `owner_username` varchar(40) NOT NULL,
  `owner_password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_owner`
--

INSERT INTO `user_owner` (`user_owner_id`, `owner_id`, `owner_username`, `owner_password`) VALUES
(7, '6597959845f9a', 'ruser1', 'Ruser@1'),
(8, '659a7e1988506', 'ruser4', 'Ruser@4');

-- --------------------------------------------------------

--
-- Table structure for table `user_stud`
--

CREATE TABLE `user_stud` (
  `user_stud_id` int(11) NOT NULL,
  `stud_id` varchar(36) NOT NULL,
  `stud_username` varchar(40) NOT NULL,
  `stud_password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_stud`
--

INSERT INTO `user_stud` (`user_stud_id`, `stud_id`, `stud_username`, `stud_password`) VALUES
(6, '6597a5cb79f3f', 'user1', 'User@1'),
(8, '65a907621e546', 'user4', 'User@4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD UNIQUE KEY `cmp_id` (`cmp_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD UNIQUE KEY `msg_id` (`msg_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `owner_id` (`owner_id`),
  ADD UNIQUE KEY `owner_phno` (`owner_phno`),
  ADD UNIQUE KEY `owner_username` (`owner_username`);

--
-- Indexes for table `request_call`
--
ALTER TABLE `request_call`
  ADD UNIQUE KEY `req_id` (`req_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `room_id` (`room_id`);

--
-- Indexes for table `room_aminities`
--
ALTER TABLE `room_aminities`
  ADD PRIMARY KEY (`ram_id`),
  ADD UNIQUE KEY `ram_id` (`ram_id`);

--
-- Indexes for table `room_img`
--
ALTER TABLE `room_img`
  ADD PRIMARY KEY (`img_id`),
  ADD UNIQUE KEY `img_id` (`img_id`);

--
-- Indexes for table `room_reviews`
--
ALTER TABLE `room_reviews`
  ADD PRIMARY KEY (`rr_id`),
  ADD UNIQUE KEY `rr_id` (`rr_id`);

--
-- Indexes for table `society_reviews`
--
ALTER TABLE `society_reviews`
  ADD PRIMARY KEY (`sr_id`),
  ADD UNIQUE KEY `sr_id` (`sr_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_id`),
  ADD UNIQUE KEY `stud_id` (`stud_id`),
  ADD UNIQUE KEY `stud_username` (`stud_username`),
  ADD UNIQUE KEY `stud_phno` (`stud_phno`);

--
-- Indexes for table `student_reviews`
--
ALTER TABLE `student_reviews`
  ADD PRIMARY KEY (`str_id`),
  ADD UNIQUE KEY `str_id` (`str_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD UNIQUE KEY `tt_id` (`tt_id`);

--
-- Indexes for table `user_owner`
--
ALTER TABLE `user_owner`
  ADD PRIMARY KEY (`user_owner_id`),
  ADD UNIQUE KEY `owner_id` (`owner_id`),
  ADD UNIQUE KEY `owner_username` (`owner_username`);

--
-- Indexes for table `user_stud`
--
ALTER TABLE `user_stud`
  ADD PRIMARY KEY (`user_stud_id`),
  ADD UNIQUE KEY `stud_username` (`stud_username`),
  ADD UNIQUE KEY `stud_id` (`stud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_aminities`
--
ALTER TABLE `room_aminities`
  MODIFY `ram_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_img`
--
ALTER TABLE `room_img`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_owner`
--
ALTER TABLE `user_owner`
  MODIFY `user_owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_stud`
--
ALTER TABLE `user_stud`
  MODIFY `user_stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
