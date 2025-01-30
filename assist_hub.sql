-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2025 at 10:09 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assist_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved_bokking`
--

CREATE TABLE `approved_bokking` (
  `id` int(20) NOT NULL,
  `DateBooking` date NOT NULL,
  `User_id` int(11) NOT NULL,
  `hospital_id` int(20) NOT NULL,
  `Section_id` int(20) NOT NULL,
  `id_bed` int(20) DEFAULT NULL,
  `id_doctor` int(20) DEFAULT NULL,
  `period` varchar(100) DEFAULT NULL,
  `Appointment_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

CREATE TABLE `bed` (
  `id` int(20) NOT NULL,
  `totalBed` int(20) NOT NULL,
  `TotalAvailableBedsForBooking` int(20) NOT NULL,
  `BedCanNotBeReserved` int(20) NOT NULL,
  `hospital_fk_id` int(11) NOT NULL,
  `section_fk_id` int(20) NOT NULL,
  `image` varchar(250) NOT NULL,
  `name` varchar(100) NOT NULL,
  `CostBed` int(20) NOT NULL,
  `night` int(20) NOT NULL,
  `morning` int(20) NOT NULL,
  `IsFull` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed`
--

INSERT INTO `bed` (`id`, `totalBed`, `TotalAvailableBedsForBooking`, `BedCanNotBeReserved`, `hospital_fk_id`, `section_fk_id`, `image`, `name`, `CostBed`, `night`, `morning`, `IsFull`) VALUES
(1, 24, 10, 14, 1, 2, 'SurgeryBed.jpg', 'Surgery Bed', 100, 7, 3, 0),
(2, 15, 4, 11, 1, 1, 'EmergencyBed.jpg', 'Emergency Bed', 76, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_requests`
--

CREATE TABLE `booking_requests` (
  `id` int(20) NOT NULL,
  `id_hospital_fk` int(20) NOT NULL,
  `section_id` int(20) NOT NULL,
  `User_id` int(20) NOT NULL,
  `id_doctor` int(20) DEFAULT NULL,
  `id_bed` int(20) DEFAULT NULL,
  `period` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '-',
  `state` varchar(50) NOT NULL DEFAULT 'Request is in progress',
  `dateBed` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `timeBooking` time NOT NULL,
  `DateBooking` date NOT NULL,
  `cost` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `DoctorType` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Available` tinyint(1) NOT NULL,
  `hospital_fk_id` int(20) NOT NULL,
  `Sections_fk_id` int(20) NOT NULL,
  `TimeAvailable` varchar(20) NOT NULL,
  `Day` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Cost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `image`, `DoctorType`, `Available`, `hospital_fk_id`, `Sections_fk_id`, `TimeAvailable`, `Day`, `Cost`) VALUES
(1, 'Hatim Srour', 'male.jpeg', 'general practitioner', 1, 1, 1, '2:00pm-8:00pm', 'Saturday-Tuesday-Thursday', 25),
(2, 'Sadiq Abdella', 'male.jpeg', 'general practitioner', 0, 1, 1, '4:00pm-10:00pm', 'Saturday-Sunday-Monday', 33),
(3, 'Laila Ahmad', 'Female.jpeg', 'general practitioner', 1, 1, 1, '1:00am-5:00am', 'Saturday-Sunday-Thursday', 40),
(4, 'Tuqa Omer', 'Female.jpeg', 'general practitioner', 0, 1, 1, '6:00pm-11:00pm', 'Friday-Tuesday-Sunday', 21),
(5, 'Nasser Jabour', 'male.jpeg', 'general practitioner', 1, 2, 1, '2:00am-7:00am', 'Monday-Thursday-Tuesday', 42),
(6, 'Bisma Mahmoud', 'Female.jpeg', 'general practitioner', 0, 2, 1, '10:00am-12:00am', 'Saturday-Wednesday-Tuesday', 87),
(7, 'Alam Yasin', 'male.jpeg', 'general practitioner', 0, 3, 1, '3:00pm-6:00pm', 'Wednesday-Tuesday-Monday', 31),
(8, 'Tasmin Dawood', 'Female.jpeg', 'general practitioner', 1, 3, 1, '5:00pm-11:00pm', 'Monday-Thursday-Friday', 53),
(9, 'Sulaiman Sharif', 'male.jpeg', 'general practitioner', 1, 4, 1, '9:00pm-12:00am', 'Sunday-Wednesday-Friday', 38),
(10, 'Ghamza Jabbar', 'Female.jpeg', 'general practitioner', 0, 4, 1, '5:00pm-8:00pm', 'Tuesday-Thursday-Sunday', 91),
(11, 'Omar Ahmed', 'male.jpeg', 'general practitioner', 0, 5, 1, '6:00pm-8:00pm', 'Sunday-Tuesday-Wednesday', 19),
(12, 'Alia Hasan', 'Female.jpeg', 'general practitioner', 1, 5, 1, '12:00pm-2:00pm', 'Saturday-Sunday-Monday', 12),
(13, 'Waleed Habeeb', 'male.jpeg', 'general practitioner', 1, 6, 1, '7:00am-1:00pm', 'Monday-Thursday-Tuesday', 12),
(14, 'Sawsan Hashem', 'Female.jpeg', 'general practitioner', 0, 6, 1, '11:00am-12:00am', 'Wednesday-Tuesday-Monday', 31),
(15, 'Ismail Farag', 'male.jpeg', 'surgeon', 1, 6, 2, '8:00am-12:00am', 'Monday-Thursday-Friday', 33),
(16, 'Bayan Abdi', 'Female.jpeg', 'surgeon', 0, 6, 2, '6:00pm-11:00pm', 'Wednesday-Friday-Saturday', 31),
(17, 'Nibal Jabbar', 'male.jpeg', 'surgeon', 0, 5, 2, '7:00am-12:00am', 'Monday-Thursday-Friday', 87),
(18, 'Nadia Mustafa', 'Female.jpeg', 'surgeon', 1, 5, 2, '1:00am-5:00am', 'Sunday-Friday-Wednesday', 90),
(19, 'Ali Akram', 'male.jpeg', 'surgeon', 1, 4, 2, '9:00pm-12:00am', 'Saturday-Tuesday-Thursday', 39),
(20, 'Jaleelah Farid', 'Female.jpeg', 'surgeon', 0, 4, 2, '10:00am-12:00am', 'Monday-Wednesday-Thursday', 31),
(21, 'Basel Demian', 'male.jpeg', 'surgeon', 0, 3, 2, '2:00am-4:00am', 'Wednesday-Friday-Saturday', 13),
(22, 'Aseel Kalil', 'Female.jpeg', 'surgeon', 1, 3, 2, '3:00pm-6:00pm', 'Sunday-Tuesday-Wednesday', 34),
(23, 'Anwar Ishmael', 'male.jpeg', 'surgeon', 1, 2, 2, '5:00pm-7:00pm', 'Monday-Thursday-Tuesday', 34),
(24, 'Afra Munir', 'Female.jpeg', 'surgeon', 0, 2, 2, '4:00pm-10:00pm', 'Monday-Thursday-Friday', 54),
(25, 'Jawad Mourad', 'male.jpeg', 'surgeon', 1, 1, 2, '6:00pm-11:00pm', 'Sunday-Friday-Wednesday', 64),
(26, 'Nader Sharifi', 'male.jpeg', 'surgeon', 0, 1, 2, '6:00pm-9:00pm\r\n', 'Saturday-Sunday-Monday', 77),
(27, 'Nuha Akhter', 'Female.jpeg', 'surgeon', 1, 1, 2, '9:00pm-12:00am', 'Sunday-Friday-Wednesday', 12),
(28, 'Taima Daoud', 'Female.jpeg', 'surgeon', 0, 1, 2, '3:00pm-6:00pm', 'Tuesday-Thursday-Sunday', 42);

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `fk_id_reigon` int(20) NOT NULL,
  `fk_id_type` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `name`, `image`, `fk_id_reigon`, `fk_id_type`) VALUES
(1, 'Al Basheer Hospital', 'AlBasheerHospital.jpeg', 1, 1),
(2, 'Italian Hospital', 'ItalianHospital.jpeg', 1, 2),
(3, 'Jerash Governmental Hospital', 'JerashGovernmentalHospital.jpeg', 2, 1),
(4, 'Al Safaa Hospital', 'AlSafaaHospital.jpeg', 2, 2),
(5, 'Karak Governmental Hospital', 'KarakGovernmentalHospital.jpg', 3, 1),
(6, 'Al Salam Hospital', 'AlSalamHospital.jpg', 3, 2),
(7, 'Princess Alia Military Hospital', 'PrincessAliaMilitaryHospital.jpeg', 1, 3),
(8, 'Prince Ali Bin Al Hussein Hospital', 'PrinceAliBinAlHusseinHospital.jpeg', 3, 3),
(9, 'Princess Haya Al Hussein Military Hospital', 'PrincessHayaAlHusseinMilitaryHospital.jpeg', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(20) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'The capital, Amman'),
(2, 'Jerash'),
(3, 'Karak');

-- --------------------------------------------------------

--
-- Table structure for table `rejected_reservations`
--

CREATE TABLE `rejected_reservations` (
  `Id` int(20) NOT NULL,
  `User_id` int(20) NOT NULL,
  `Hospital_id` int(20) NOT NULL,
  `Section_id` int(20) NOT NULL,
  `id_bed` int(20) DEFAULT NULL,
  `id_doctor` int(20) DEFAULT NULL,
  `message` varchar(50) NOT NULL DEFAULT 'rejected',
  `refundAmount` int(50) NOT NULL,
  `IsReturnPayment` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sections_hospital`
--

CREATE TABLE `sections_hospital` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections_hospital`
--

INSERT INTO `sections_hospital` (`id`, `name`) VALUES
(1, 'Emergency Department'),
(2, 'Surgery Department');

-- --------------------------------------------------------

--
-- Table structure for table `types_of_hospital`
--

CREATE TABLE `types_of_hospital` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types_of_hospital`
--

INSERT INTO `types_of_hospital` (`id`, `name`) VALUES
(1, 'government '),
(2, 'private'),
(3, 'Military');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(20) NOT NULL,
  `Name_User` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Nationality` varchar(25) NOT NULL,
  `password_User` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `Name_User`, `Phone`, `Nationality`, `password_User`) VALUES
(1, 'raaneem horany', '0791234567', 'Jordanian', 'Lolo20032$');

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `Id` int(20) NOT NULL,
  `NationaltyOrPassportNumber` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Health_Insurance` varchar(100) NOT NULL,
  `File_Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'NoFile',
  `User_Id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`Id`, `NationaltyOrPassportNumber`, `Health_Insurance`, `File_Name`, `User_Id`) VALUES
(1, '1234565', 'No health insurance', 'NoFile', 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `id` int(20) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `note` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`id`, `name`, `image`, `note`, `link`) VALUES
(1, 'بازلي', 'bazley.jpg', 'بازلي عباره عن منصه الكترونية للتبرع بالدم الاولى بالمملكه تربط المتبرعين بالدم القدرين على التبرع \r', 'https://baderjo.org/featured-volunteer-guide/disti'),
(2, '\r\nمنصة \"نَحْنُ\"', 'nahno.jpg', 'هي منصة وطنية بهدف توحيد الجهود المبذولة في مجال العمل التطوعي والمشاركة الشبابية على كافة الأصعدة، ', 'https://www.nahno.org/'),
(4, 'مركز الحسين للسرطان', 'khcc.jpeg', 'مؤسسة الحسين للسرطان مكرسة لإنقاذ حياة مرضى السرطان من خلال توفير أفضل رعاية شمولية بأعلى المعايير، ', 'https://www.khcc.jo/ar/the-early-detection-unit-at');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_bokking`
--
ALTER TABLE `approved_bokking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_id` (`hospital_id`),
  ADD KEY `id_bed` (`id_bed`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `Section_id` (`Section_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `bed`
--
ALTER TABLE `bed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_fk_id` (`hospital_fk_id`),
  ADD KEY `section_fk_id` (`section_fk_id`);

--
-- Indexes for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_hospital_fk` (`id_hospital_fk`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `id_bed` (`id_bed`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_fk_id` (`hospital_fk_id`),
  ADD KEY `Sections_fk_id` (`Sections_fk_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_reigon` (`fk_id_reigon`),
  ADD KEY `fk_id_type` (`fk_id_type`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rejected_reservations`
--
ALTER TABLE `rejected_reservations`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `Hospital_id` (`Hospital_id`),
  ADD KEY `Section_id` (`Section_id`),
  ADD KEY `id_bed` (`id_bed`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indexes for table `sections_hospital`
--
ALTER TABLE `sections_hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types_of_hospital`
--
ALTER TABLE `types_of_hospital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Phone` (`Phone`) USING BTREE;

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `NationaltyOrPassportNumber` (`NationaltyOrPassportNumber`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_bokking`
--
ALTER TABLE `approved_bokking`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed`
--
ALTER TABLE `bed`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_requests`
--
ALTER TABLE `booking_requests`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rejected_reservations`
--
ALTER TABLE `rejected_reservations`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections_hospital`
--
ALTER TABLE `sections_hospital`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `types_of_hospital`
--
ALTER TABLE `types_of_hospital`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approved_bokking`
--
ALTER TABLE `approved_bokking`
  ADD CONSTRAINT `approved_bokking_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `approved_bokking_ibfk_2` FOREIGN KEY (`id_bed`) REFERENCES `bed` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `approved_bokking_ibfk_3` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `approved_bokking_ibfk_4` FOREIGN KEY (`Section_id`) REFERENCES `sections_hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `approved_bokking_ibfk_5` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `bed`
--
ALTER TABLE `bed`
  ADD CONSTRAINT `bed_ibfk_1` FOREIGN KEY (`hospital_fk_id`) REFERENCES `hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `bed_ibfk_2` FOREIGN KEY (`section_fk_id`) REFERENCES `sections_hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD CONSTRAINT `booking_requests_ibfk_3` FOREIGN KEY (`id_hospital_fk`) REFERENCES `hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_requests_ibfk_4` FOREIGN KEY (`section_id`) REFERENCES `sections_hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_requests_ibfk_5` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_requests_ibfk_6` FOREIGN KEY (`id_bed`) REFERENCES `bed` (`id`),
  ADD CONSTRAINT `booking_requests_ibfk_7` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`hospital_fk_id`) REFERENCES `hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`Sections_fk_id`) REFERENCES `sections_hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `hospital`
--
ALTER TABLE `hospital`
  ADD CONSTRAINT `hospital_ibfk_1` FOREIGN KEY (`fk_id_reigon`) REFERENCES `region` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `hospital_ibfk_2` FOREIGN KEY (`fk_id_type`) REFERENCES `types_of_hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `rejected_reservations`
--
ALTER TABLE `rejected_reservations`
  ADD CONSTRAINT `rejected_reservations_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rejected_reservations_ibfk_2` FOREIGN KEY (`Hospital_id`) REFERENCES `hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rejected_reservations_ibfk_3` FOREIGN KEY (`Section_id`) REFERENCES `sections_hospital` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rejected_reservations_ibfk_4` FOREIGN KEY (`id_bed`) REFERENCES `bed` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `rejected_reservations_ibfk_5` FOREIGN KEY (`id_doctor`) REFERENCES `doctor` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_information`
--
ALTER TABLE `user_information`
  ADD CONSTRAINT `user_information_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
