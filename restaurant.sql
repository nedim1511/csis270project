-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 07:34 PM
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
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `a_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`a_id`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'Ejup', 'Ganic', 'ejupganic@ssst.edu.ba', 'a6747e6d9aaa9d5d2e9f172df3e08a1b9bd56dc159b7cb9d72e457f6');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `e_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `salary` decimal(6,2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(56) NOT NULL,
  `phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`e_id`, `fname`, `lname`, `salary`, `email`, `password`, `phone`) VALUES
(6, 'Vela', 'Makic', '2500.00', 'vela.makic@ssst.edu.ba', 'fd7f59b15deb7ef1bdf1838d9ea69411133ca153b32679be50869fe9', '062-682-066');

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
(40, 'Omellete', 1, 'Breakfast', 'p01mm52c6d74f891.jpg', '3.00', 5),
(41, 'Pancakes', 1, 'Desserts', 'p094fdf89dcb365e.jpg', '3.00', 5),
(42, 'Choco Cake', 0, 'Desserts', 'p094g64f4374eb72.jpg', '1.50', 2),
(43, 'Jagnjetina', 1, 'Dishes', 'p0c596709492e563.jpg', '25.50', 10);

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
  `finished` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `AU_ORDERS` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
INSERT INTO orders_history(old_order, meal, student, name, price) VALUES(new.o_id, new.meal, new.student, (SELECT name from meals where m_id=new.meal), 
(SELECT price from meals where m_id=new.meal));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders_history`
--

CREATE TABLE `orders_history` (
  `o_id` int(10) UNSIGNED NOT NULL,
  `meal` int(10) UNSIGNED NOT NULL,
  `student` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `old_order` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL,
  `price` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_history`
--

INSERT INTO `orders_history` (`o_id`, `meal`, `student`, `date`, `old_order`, `paid`, `name`, `price`) VALUES
(30, 35, 13, '2017-11-30 23:11:39', 19, 1, 'Pancakes', '2.50'),
(31, 42, 13, '2017-11-30 23:15:17', 20, 1, 'Choco Cake', '1.50'),
(32, 17, 13, '2017-12-01 09:17:45', 2, 1, 'Toast', '1.50'),
(33, 5, 15, '2017-12-01 10:40:41', 1, 1, 'Cheeseburger', '3.50'),
(34, 39, 15, '2017-12-01 10:43:13', 2, 1, 'American pancakes', '4.50'),
(35, 5, 15, '2017-12-01 10:47:39', 3, 1, 'Cheeseburger', '3.50'),
(36, 24, 13, '2017-12-01 23:04:15', 1, 1, 'Veal Steak', '10.00'),
(37, 43, 13, '2017-12-02 14:26:32', 1, 1, 'Jagnjetina', '25.50'),
(38, 43, 13, '2017-12-07 15:14:57', 1, 1, 'Jagnjetina', '25.50'),
(39, 40, 13, '2017-12-11 17:20:36', 1, 0, 'Omellete', '3.00');

--
-- Triggers `orders_history`
--
DELIMITER $$
CREATE TRIGGER `AI_ORDERS_HISTORY` AFTER INSERT ON `orders_history` FOR EACH ROW BEGIN
UPDATE students SET owns=owns+(SELECT price FROM meals WHERE m_id=new.meal) where s_id=new.student;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `au_orders_history` AFTER UPDATE ON `orders_history` FOR EACH ROW begin
update students set owns=owns-(SELECT price from meals where m_id=old.meal) WHERE s_id=old.student;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `r_id` int(10) UNSIGNED NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL DEFAULT '3',
  `meal` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `s_id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(56) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `owns` decimal(5,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`s_id`, `fname`, `lname`, `email`, `password`, `activated`, `owns`) VALUES
(13, 'Mehmed', 'Bazdar', 'mehmed.bazdar@stu.ssst.edu.ba', 'b7b14a778f7b3d1d677e40185af339d1a2ba5891608df6932de1ee06', 1, '3.00'),
(14, 'Nedim', 'Kurbegovic', 'nedim.kurbegovic@stu.ssst.edu.ba', 'b7b14a778f7b3d1d677e40185af339d1a2ba5891608df6932de1ee06', 1, '0.00'),
(15, 'Zejd', 'Makic', 'zejd.makic@stu.ssst.edu.ba', '7bf337c31965bc702865260b9023fa4b89810329d123b9826b67df1c', 1, '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `login` (`email`,`password`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `login` (`email`,`password`);

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
-- Indexes for table `orders_history`
--
ALTER TABLE `orders_history`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `orders_history_ibfk_1` (`meal`),
  ADD KEY `orders_history_ibfk_3` (`student`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `meal` (`meal`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `login` (`email`,`password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `a_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `e_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `m_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_history`
--
ALTER TABLE `orders_history`
  MODIFY `o_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `r_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `s_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`student`) REFERENCES `students` (`s_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`meal`) REFERENCES `meals` (`m_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders_history`
--
ALTER TABLE `orders_history`
  ADD CONSTRAINT `orders_history_ibfk_3` FOREIGN KEY (`student`) REFERENCES `students` (`s_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`meal`) REFERENCES `meals` (`m_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
