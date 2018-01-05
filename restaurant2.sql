-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2018 at 05:46 PM
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
-- Database: `restaurant2`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `e_id` int(10) UNSIGNED NOT NULL,
  `salary` decimal(6,2) NOT NULL DEFAULT '0.00',
  `phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`e_id`, `salary`, `phone`) VALUES
(9, '1470.00', '062-682-066'),
(18, '1550.00', '062-682-066');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `m_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `category` enum('Breakfast','Pizzas','Fast food','Soups','Dishes','Pasta','Salads','Desserts') DEFAULT NULL,
  `picture` varchar(100) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `prep_time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`m_id`, `name`, `available`, `category`, `picture`, `price`, `prep_time`) VALUES
(4, 'Chicken Sandwich', 1, 'Fast food', 'ozua7fb7911eb2ce.jpg', '3.00', 6),
(5, 'Cheeseburger', 0, 'Fast food', 'ozuab358887345fb.jpg', '3.50', 4),
(6, 'Bosnian Sandwich', 1, 'Fast food', 'ozuafgfd923bb640.jpg', '3.00', 2),
(9, 'Salty Fritters', 1, 'Breakfast', 'ozuaj8d506d89c47.jpg', '4.00', 5),
(10, 'Polenta', 1, 'Breakfast', 'ozuajk2f61f84682.jpg', '4.00', 5),
(11, 'Margherita', 1, 'Pizzas', 'ozuak94c159d2f34.jpeg', '4.00', 7),
(12, 'Mexicana', 1, 'Pizzas', 'ozuakl59c0895d78.jpeg', '6.00', 4),
(13, 'Lasagnia', 1, 'Pizzas', 'ozual0950dad4bdf.jpeg', '6.00', 10),
(14, 'Capricciosa', 1, 'Pizzas', 'ozualk9ee65a557e.jpg', '5.00', 7),
(15, 'Hamburger', 1, 'Fast food', 'ozuamd6f8c5a282b.jpg', '3.00', 0),
(16, 'Ham Chesse', 1, 'Fast food', 'ozuamx37f0278dbf.jpg', '3.00', 4),
(17, 'Toast', 1, 'Fast food', 'ozuanc7a9ad435a7.jpg', '1.50', 3),
(18, 'French Fries', 1, 'Fast food', 'ozuant1080b30307.jpg', '2.00', 3),
(19, 'Chicken Soup', 1, 'Soups', 'ozuaoh1a383a3a54.jpeg', '3.00', 5),
(20, 'Tomato Soup', 1, 'Soups', 'ozuap6ee7ead1216.jpeg', '3.00', 0),
(21, 'Veal Soup', 1, 'Soups', 'ozuapq910912afae.jpeg', '3.00', 0),
(22, 'Chicken Fillet', 1, 'Dishes', 'ozuaqgb30718379a.jpeg', '5.00', 0),
(23, 'Breaded Pancakes', 1, 'Dishes', 'ozuar28a78f1ea85.jpeg', '4.00', 0),
(24, 'Veal Steak', 1, 'Dishes', 'ozuarlb0db6c65bc.jpeg', '10.00', 15),
(25, 'Minced Veal', 1, 'Dishes', 'ozuas30606a1e7fb.jpeg', '5.00', 0),
(26, 'Sausages', 1, 'Dishes', 'ozuasi8f42927e0f.jpeg', '5.00', 0),
(27, 'Maslenica', 1, 'Dishes', 'ozuaszecae18abc5.jpeg', '6.00', 0),
(28, 'Risotto', 1, 'Dishes', 'ozuath60495e30d1.jpeg', '6.00', 0),
(29, 'Chicken Pasta', 1, 'Pasta', 'ozuaude973461329.jpg', '0.00', 0),
(30, 'Bolognese', 1, 'Pasta', 'ozucc78aed598767.jpg', '5.00', 0),
(31, 'Caprese Salad', 1, 'Salads', 'ozuce1c174b92b49.jpg', '7.00', 7),
(32, 'Tuna Salad', 1, 'Salads', 'ozuceqa9a236d937.jpg', '5.00', 3),
(33, 'Mix Salad', 1, 'Salads', 'ozucf91cae45984c.jpg', '2.00', 3),
(34, 'Chicken Salad', 1, 'Salads', 'ozucg203d9731dec.jpg', '5.00', 9),
(36, 'Monte Cake', 0, 'Desserts', 'ozuchj7981bca2b1.jpg', '2.00', 3),
(39, 'American pancakes', 1, 'Desserts', 'ozv2oj36ddb019c4.png', '4.50', 5),
(40, 'Omellete', 0, 'Breakfast', 'p01mm52c6d74f891.jpg', '3.00', 5),
(41, 'Pancakes', 1, 'Desserts', 'p094fdf89dcb365e.jpg', '3.00', 5),
(42, 'Choco Cake', 0, 'Desserts', 'p094g64f4374eb72.jpg', '1.50', 2),
(43, 'Jagnjetina', 1, 'Dishes', 'p0c596709492e563.jpg', '25.50', 10),
(44, 'Fruit Salad', 1, 'Salads', 'p1fsk7deeaf4fe2e.jpg', '5.00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(10) UNSIGNED NOT NULL,
  `student` int(10) UNSIGNED NOT NULL,
  `meal` int(10) UNSIGNED NOT NULL,
  `comment` varchar(100) DEFAULT 'No comment',
  `time` char(5) NOT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paid` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `student`, `meal`, `comment`, `time`, `finished`, `date`, `paid`) VALUES
(1, 12, 9, '', '10:15', 1, '2018-01-05 00:16:21', 1),
(2, 12, 41, '', '09:45', 1, '2018-01-05 00:17:04', 0),
(3, 12, 19, '', '13:30', 1, '2017-12-10 00:20:14', 0),
(4, 12, 44, '', '14:00', 1, '2017-11-10 00:20:59', 0),
(6, 12, 4, '', '09:30', 1, '2018-01-05 00:49:30', 0),
(7, 20, 19, 'Bey sise', '14:10', 1, '2018-01-05 10:46:31', 1),
(9, 21, 44, '', '15:00', 1, '2018-01-05 10:48:42', 0);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `AU_ORDERS` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
if old.finished <> new.finished then
UPDATE students SET owns=owns+(SELECT price from meals where m_id=new.meal) where s_id=new.student;
end if;
if old.paid <> new.paid then
UPDATE students SET owns=owns-(SELECT price from meals where m_id=new.meal) where s_id=new.student;
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(10) UNSIGNED NOT NULL,
  `owns` decimal(5,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `owns`) VALUES
(12, '14.00'),
(20, '0.00'),
(21, '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(56) NOT NULL,
  `type` enum('STUDENT','EMPLOYEE','ADMIN') DEFAULT 'STUDENT',
  `activated` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `fname`, `lname`, `email`, `password`, `type`, `activated`) VALUES
(5, 'Ejup', 'Ganic', 'ejup.ganic@ssst.edu.ba', 'a6747e6d9aaa9d5d2e9f172df3e08a1b9bd56dc159b7cb9d72e457f6', 'ADMIN', 1),
(9, 'Vela', 'Kurbegovic', 'velca123@gmail.com', '794878b52cdf68293ccfe2c3ba8e5d758eb4cbf8a32ef9ce7c72ea7e', 'EMPLOYEE', 1),
(12, 'Mehmed', 'Bazdar', 'mehmed.bazdar@stu.ssst.edu.ba', '56602143b3858a74cd0b709609b7eb7975b5139c635162896703c1ec', 'STUDENT', 1),
(18, 'Nedim', 'Kurbegovic', 'nedim.kurbegovic@ssst.edu.ba', 'b7b14a778f7b3d1d677e40185af339d1a2ba5891608df6932de1ee06', 'EMPLOYEE', 1),
(20, 'Nejra', 'Mesa', 'nejra.mesa@stu.ssst.edu.ba', '0cc596aa8bbe5d05874b2a1f0a290d385a33a673d1d1ccc15a835857', 'STUDENT', 1),
(21, 'Zejd', 'Makic', 'zejd.makic@stu.ssst.edu.ba', '1a810ba805756908a0c688b64dc95826d3538e6c2e98fb0195b10558', 'STUDENT', 1);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `stu_emp_reg_trigger` AFTER INSERT ON `users` FOR EACH ROW BEGIN
IF new.type='STUDENT' THEN
INSERT INTO STUDENTS(s_id) VALUES(new.u_id);
end if;
IF new.type='EMPLOYEE' THEN
INSERT INTO EMPLOYEES(e_id) VALUES(new.u_id);
END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `orders_ibfk_2` (`meal`),
  ADD KEY `orders_ibfk_1` (`student`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `m_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`e_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`student`) REFERENCES `students` (`s_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`meal`) REFERENCES `meals` (`m_id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
