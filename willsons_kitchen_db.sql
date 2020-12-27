-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2017 at 08:26 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `willsons_kitchen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(2) NOT NULL,
  `a_name` varchar(20) NOT NULL,
  `a_pswd` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_pswd`) VALUES
(1, 'admin1', 'a4db21c69d5d1db6f8b3a9a4ca53c769');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `b_id` int(10) NOT NULL,
  `b_sum` int(5) NOT NULL,
  `b_total` int(5) NOT NULL,
  `b_date` date NOT NULL,
  `b_uid` int(8) NOT NULL,
  `b_address` varchar(80) NOT NULL,
  `b_tid` int(3) DEFAULT NULL,
  `b_status` varchar(15) NOT NULL,
  `b_delivery` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`b_id`, `b_sum`, `b_total`, `b_date`, `b_uid`, `b_address`, `b_tid`, `b_status`, `b_delivery`) VALUES
(1, 740, 777, '2017-08-30', 1, 'Dadar TT', 1, 'paid', 'delivered'),
(2, 380, 399, '2017-08-31', 1, 'R.C.F. Colony, Type 4, 5/28', 2, 'paid', 'accepted'),
(3, 340, 357, '2017-08-31', 1, 'R.C.F. Colony, Type 4, 5/28', 2, 'paid', ''),
(4, 430, 452, '2017-08-31', 1, 'R.C.F. Colony, Type 4, 5/28', 2, 'paid', 'accepted'),
(5, 300, 315, '2017-09-04', 1, 'R.C.F. Colony, Type 4, 5/28', 2, 'paid', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `c_id` int(8) NOT NULL,
  `c_uid` int(8) NOT NULL,
  `c_mid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `m_id` int(3) NOT NULL,
  `m_name` varchar(80) NOT NULL,
  `m_desc` varchar(200) NOT NULL,
  `m_nveg` varchar(10) NOT NULL,
  `m_price` int(4) NOT NULL,
  `m_cat` int(3) DEFAULT NULL,
  `m_taste` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`m_id`, `m_name`, `m_desc`, `m_nveg`, `m_price`, `m_cat`, `m_taste`) VALUES
(1, 'dahi kebab (6pcs)', 'indulge in veg tawa kebabs with crispy crust and gooey spicy center', 'veg', 150, 1, 'spicy'),
(2, 'paneer malai tikka (8pcs)', 'marinated cubes of cottage cheese marinated in fresh cream with awadhi spices & cooked in tandoor', 'veg', 200, 1, 'spicy'),
(3, 'paneer manjari tikka', 'cottage cheese cubes stuffed with cream and cheese flavoured with red chillies & green spices', 'veg', 250, 1, 'extra-spicy'),
(4, 'tandoori bharwa mushroom', 'mushrooms marinated with ginger, red chillies lime & chef`s special spices', 'veg', 160, 1, ''),
(5, 'mushroom khazana (8pcs)', 'mushrooms cooked in exotic spices with creamy center full of dry fruits', 'veg', 200, 1, 'spicy'),
(6, 'tandoori bharwa aloo', 'grilled golden potato treats with aromatic center filled with paneer and condiments', 'veg', 140, 1, 'spicy'),
(7, 'makhmali seekh kebab', 'scintillating seekhs with paneer, cheese & spices', 'veg', 200, 1, 'extra-spicy'),
(8, 'tandoori chiken', 'chicken marinated in yoghurt, ginger, garlic & spices, cooked to perfection in tandoor', 'non-veg', 260, 1, 'spicy'),
(9, 'murg malai tikka', 'chicken cubes marinated with crushed garlic & aromatic spices', 'non-veg', 250, 1, 'spicy'),
(10, 'tandoori chicken tikka', 'chicken cubes marinated in yoghurt, ginger, garlic & spices, cooked delicately in the tandor', 'non-veg', 230, 1, 'extra-spicy'),
(11, 'pahari chicken tikka', 'chicken cubes marinated in mint flavoured spices & cooked in the tandoor', 'non-veg', 230, 1, 'extra-spicy'),
(12, 'chicken manjira', 'marinated chicken cubes filled with creamy cheese cooked tenderly in the tandoor for special flavour', 'non-veg', 280, 1, 'spicy'),
(13, 'chicken cheese seekh kebab', 'juicy chicken seekh with a cheesy twist', 'non-veg', 250, 1, 'spicy'),
(14, 'chicken tangri mumtaz', 'stuffed chicken tangri (leg pieces) with rare spices', 'non-veg', 280, 1, 'spicy'),
(15, 'mutton seekh kebab', 'mutton keema with aromatic spices delicately for a delicious tandoor experience', 'non-veg', 250, 1, 'spicy'),
(16, 'mutton malai seekh', 'mutton cubes flavoured by rich spices & creamy malai which will melt in mouth', 'non-veg', 250, 1, 'spicy'),
(17, 'tomato soup', '', 'veg', 80, 2, ''),
(18, 'dal palak soup', '', 'veg', 90, 2, ''),
(19, 'tomato dhaniya ka shorba', '', 'veg', 80, 2, ''),
(20, 'mulligatawny soup', '', 'veg', 90, 2, ''),
(21, 'veg clear soup', '', 'veg', 70, 2, ''),
(22, 'sweet corn soup', '', 'veg', 80, 2, ''),
(23, 'manchow with noodles', '', 'veg', 90, 2, ''),
(24, 'hot n sour veg', '', 'veg', 80, 2, ''),
(25, 'chicken clear soup', '', 'non-veg', 100, 2, ''),
(26, 'chicken manchow', '', 'non-veg', 120, 2, ''),
(27, 'mutton akani shorba', '', 'non-veg', 120, 2, ''),
(28, 'hot n sour chicken', '', 'non-veg', 100, 2, ''),
(29, 'panch mukhi daal', 'moong, channa, masoor, urad & tuar lentils cooked with traditional Rajasthani spice mix', 'veg', 150, 3, ''),
(30, 'daal makhani', 'a traditional preparation of black lentils simmered overnight finished with cream, butter & spices', 'veg', 150, 3, ''),
(31, 'yellow daal tadka', 'yellow dal tempered with asafoetida, garlic, cumin in desi ghee tadka', 'veg', 120, 3, ''),
(32, 'daal palak', 'tuar daal tenderly cooked in fresh spinach wuth aromatic spices', 'veg', 120, 3, ''),
(33, 'chilly paneer (dry)', '', 'veg', 150, 4, ''),
(34, 'chilly paneer (gravy)', '', 'veg', 180, 4, ''),
(35, 'veg manchurian (dry)', '', 'veg', 150, 4, ''),
(36, 'veg manchurian (gravy)', '', 'veg', 180, 4, ''),
(37, 'honey chilly potato', '', 'veg', 150, 4, ''),
(38, 'veg crispy', '', 'veg', 150, 4, ''),
(39, 'mushroom (dry)', '', 'veg', 120, 4, ''),
(40, 'mushroom (gravy)', '', 'veg', 150, 4, ''),
(41, 'chilly chicken (dry)', '', 'non-veg', 180, 4, ''),
(42, 'chilly chicken (gravy)', '', 'non-veg', 220, 4, ''),
(43, 'chicken lollipop (6pcs)', '', 'non-veg', 200, 4, ''),
(44, 'chicken manchurian (dry)', '', 'non-veg', 180, 4, ''),
(45, 'chicken manchurian (gravy)', '', 'non-veg', 220, 4, ''),
(46, 'malai kofta', 'koftas cooked in cashew curry', 'veg', 180, 5, ''),
(47, 'corn palak', 'tender corn tossed with tangy tomatoes, with an array of spices & chillies in spinach gravy', 'veg', 150, 5, ''),
(48, 'mushroom mutter', 'fresh mushrooms with peas in a creammy gravy', 'veg', 150, 5, ''),
(49, 'veg kolhapuri', 'vegetables cooked in tomato based gravy with aromatic kolhapuri spices', 'veg', 150, 5, 'extra-spicy'),
(50, 'veg hulchul', 'assorted vegetables cooked in sromatic spices in an iron wok', 'veg', 200, 5, ''),
(51, 'paneer lababdar', 'lip smacking spicy paneer cubes cooked in creamy tomato gravy', 'veg', 200, 5, 'spicy'),
(52, 'paneer kadhai', 'indian cottage cheese (paneer) cooked in onion tomato gravy with kadhai masala', 'veg', 200, 5, 'spicy'),
(53, 'lemon chilly paneer', 'paneer cubes cooked in chef`s special spicy lemon & chilly masala', 'veg', 250, 5, ''),
(54, 'mutter paneer', 'creamy paneer cubes and crispy peas in tomato based curry', 'veg', 250, 5, ''),
(55, 'palak paneer', 'paneer in a thick paste made from pureed spinach and seasoned with garlic, garam masala & other spices', 'veg', 180, 5, ''),
(56, 'butter chicken', 'grilled chicken scintillating butter and cashew based curry', 'non-veg', 260, 5, ''),
(57, 'kadhai chicken', 'tender chunks of chicken tossed with the tang of tomatoes, an array of spices and chillies', 'non-veg', 150, 5, 'spicy'),
(58, 'lemon chicken', 'chicken pieces cooked in chef`s special spicy lemon & peppery masala', 'non-veg', 250, 5, 'spicy'),
(59, 'dahi chicken', 'chicken marinated in spices & yoghurt, finished with kewra water', 'non-veg', 280, 5, ''),
(60, 'methi chicken', 'marinated pieces of chicken legs cooked with the aroma of kasoori methi', 'non-veg', 250, 5, 'spicy'),
(61, 'mutton rogan josh', 'scrumptous mutton morsets cooked in kashmiri spices using red chillis in tomato gravy', 'non-veg', 300, 5, 'extra-spicy'),
(62, 'bhuna josh', 'pan fried lamb dry cooked with Indian spices', 'non-veg', 250, 5, ''),
(63, 'egg curry', 'boiled eggs made to perfection in a coconut creamy, tangy gravy', 'non-veg', 180, 5, 'spicy'),
(64, 'mutton keema mutter', 'minced mutton & green peas cooked with aromatic spices', 'non-veg', 200, 5, 'spicy'),
(65, 'veg fried rice', '', 'veg', 150, 6, ''),
(66, 'chicken fried rice', '', 'non-veg', 200, 6, ''),
(67, 'chicken schezwan rice', '', 'non-veg', 220, 6, ''),
(68, 'veg noodles', '', 'veg', 160, 6, ''),
(69, 'chicken noodles', '', 'non-veg', 200, 6, ''),
(70, 'rice noodles combination', '', 'veg', 200, 6, ''),
(71, 'veg schezwan fried rice', '', 'veg', 180, 6, ''),
(72, 'egg schezwan fried rice', '', 'non-veg', 180, 6, ''),
(73, 'egg fried rice', '', 'non-veg', 150, 6, ''),
(74, 'plain rice', 'steamed basmati rice', 'veg', 100, 7, ''),
(75, 'vegetable pulav', '', 'veg', 150, 7, ''),
(76, 'peas pulav', '', 'veg', 150, 7, ''),
(77, 'jeera pulav', '', 'veg', 150, 7, ''),
(78, 'veg biryani', 'assorted garden fresh vegetables & basmati rice cooked with onion, tomato and indian spices', 'veg', 150, 7, ''),
(79, 'dal khichdi', 'basmati rice tenderly cooked with yellow daal and enhanced with desi ghee tadka', 'veg', 150, 7, ''),
(80, 'chicken biryani', 'an age old recipe with slow cooked basmati rice with chicken on dum ', 'non-veg', 220, 7, ''),
(81, 'mutton biryani', 'an Awadhi treat of basmati rice cooked with assorted spices & mutton cooked to perfection', 'non-veg', 250, 7, ''),
(82, 'egg biryani', 'a melange of delicately boiled eggs slowly cooked with long basmati rice with seasonal veggies & spices', 'non-veg', 180, 7, ''),
(83, 'Tandoori roti', '', 'veg', 15, 8, ''),
(84, 'tandoori butter roti', '', 'veg', 20, 8, ''),
(85, 'plain naan', '', 'veg', 30, 8, ''),
(86, 'garlic naan', '', 'veg', 40, 8, ''),
(87, 'butter naan', '', 'veg', 35, 8, ''),
(88, 'missi roti', '', 'veg', 30, 8, ''),
(89, 'lacha paratha', '', 'veg', 40, 8, ''),
(90, 'stuffed kulcha', '', 'veg', 40, 8, ''),
(91, 'methi paratha', '', 'veg', 40, 8, ''),
(92, 'aloo paratha', '', 'veg', 40, 8, ''),
(93, 'pudina paratha', '', 'veg', 40, 8, ''),
(94, 'keema naan', '', 'veg', 80, 8, ''),
(95, 'chicken keema naan', '', 'non-veg', 60, 8, ''),
(96, 'chicken charming', 'crispy veggies sauteed in olive oil with tender cooked chicken breast', 'non-veg', 250, 9, ''),
(97, 'warm essential egg salad', 'boiled eggs tossed in crispy green veggies with a dash of olive', 'non-veg', 180, 9, ''),
(98, 'minced meat magic', 'minced chicken meat cooked in spices tossed with brown rice & a dash of olive oil', 'non-veg', 220, 9, ''),
(99, 'chicken salt & pepper', 'tender chicken breast tossed with chef`s special flavoured spices', 'non-veg', 280, 9, ''),
(100, 'chef`s classic choice', 'chef`s choice of brown rice with chicken/egg/paneer with cauted crispy vegetables', 'non-veg', 220, 9, ''),
(101, 'wonder veggies', 'variety of crispy vegetables tossed in olive oil', 'veg', 250, 9, ''),
(102, 'scrambled surprise', 'brown rice with scrambles chicken/egg/boiled egg morsets', 'non-veg', 180, 9, ''),
(103, 'veg micro meal', 'sabji, dal, rice, 2 rotis', 'veg', 79, 10, ''),
(104, 'veg mini meal', 'sabji, dal, salad, pickle, rice, sweet', 'veg', 129, 10, ''),
(105, 'veg max meal', 'sabji, dal, pulav, 2 rotis, salad, raita, sweeet', 'veg', 179, 10, ''),
(106, 'non veg micro meal', 'chicken curry, 2 rotis, rice', 'non-veg', 99, 10, ''),
(107, 'non veg mini meal', 'chicken curry, dal, rice, 2 rotis, pickle, sweet', 'non-veg', 159, 10, ''),
(108, 'chicken max meal box', 'chicken curry, paneer masala, dal, pulav, 2 rotis, salad, raita, sweet', 'non-veg', 179, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE `menu_category` (
  `mc_id` int(2) NOT NULL,
  `mc_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`mc_id`, `mc_name`) VALUES
(4, 'chinese'),
(3, 'daal'),
(8, 'indian bread'),
(5, 'indian main course'),
(7, 'indian rice'),
(10, 'meal box'),
(6, 'rice & noodles'),
(2, 'soup'),
(1, 'starter'),
(9, 'Weight watcher`s delight');

-- --------------------------------------------------------

--
-- Table structure for table `menu_special`
--

CREATE TABLE `menu_special` (
  `ms_id` int(3) NOT NULL,
  `ms_mid` int(3) NOT NULL,
  `ms_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_special`
--

INSERT INTO `menu_special` (`ms_id`, `ms_mid`, `ms_image`) VALUES
(1, 3, 'paneermanjaritikka.jpg'),
(2, 9, 'murgmalaitikka.jpg'),
(3, 12, 'chickenmanjira.jpg'),
(4, 13, 'chickencheesekabab.jpg'),
(5, 51, 'paneerlababdar.jpg'),
(6, 53, 'lemonchillipaneer.jpg'),
(7, 58, 'lemonchicken.jpg'),
(8, 62, 'bhunajosh.jpg'),
(9, 30, 'dalmakhani.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `o_id` int(10) NOT NULL,
  `o_uid` int(8) NOT NULL,
  `o_mid` int(3) NOT NULL,
  `o_quantity` int(3) NOT NULL,
  `o_price` int(5) NOT NULL,
  `o_bid` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`o_id`, `o_uid`, `o_mid`, `o_quantity`, `o_price`, `o_bid`) VALUES
(1, 1, 2, 2, 400, 1),
(2, 1, 5, 1, 200, 1),
(3, 1, 6, 1, 140, 1),
(4, 1, 71, 1, 180, 2),
(5, 1, 5, 1, 200, 2),
(6, 1, 6, 1, 140, 3),
(7, 1, 7, 1, 200, 3),
(8, 1, 96, 1, 250, 4),
(9, 1, 97, 1, 180, 4),
(10, 1, 78, 2, 300, 5);

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `t_id` int(3) NOT NULL,
  `t_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`t_id`, `t_name`) VALUES
(3, 'CBD belapur'),
(1, 'nerul'),
(2, 'seawoods');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(8) NOT NULL,
  `u_fname` varchar(15) NOT NULL,
  `u_lname` varchar(15) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_pswd` varchar(40) NOT NULL,
  `u_phone` varchar(10) NOT NULL,
  `u_address` varchar(100) NOT NULL,
  `u_tid` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_fname`, `u_lname`, `u_email`, `u_pswd`, `u_phone`, `u_address`, `u_tid`) VALUES
(1, 'mansi', 'khamkar', 'mansi@gmail.com', 'a4db21c69d5d1db6f8b3a9a4ca53c769', '8692023065', 'R.C.F. Colony, Type 4, 5/28', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `bill_user_id` (`b_uid`),
  ADD KEY `b_tid` (`b_tid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `cart_user_id` (`c_uid`),
  ADD KEY `cart_menu_id` (`c_mid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`m_id`),
  ADD UNIQUE KEY `m_name` (`m_name`),
  ADD KEY `menu_cat_id` (`m_cat`);

--
-- Indexes for table `menu_category`
--
ALTER TABLE `menu_category`
  ADD PRIMARY KEY (`mc_id`),
  ADD UNIQUE KEY `mc_name` (`mc_name`);

--
-- Indexes for table `menu_special`
--
ALTER TABLE `menu_special`
  ADD PRIMARY KEY (`ms_id`),
  ADD KEY `special_menu_id` (`ms_mid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `order_user_id` (`o_uid`),
  ADD KEY `order_menu_id` (`o_mid`),
  ADD KEY `order_bill_id` (`o_bid`);

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`t_id`),
  ADD UNIQUE KEY `town_name` (`t_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `user_email` (`u_email`),
  ADD KEY `u_tid` (`u_tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `c_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `m_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `menu_category`
--
ALTER TABLE `menu_category`
  MODIFY `mc_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `menu_special`
--
ALTER TABLE `menu_special`
  MODIFY `ms_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `t_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `fk_bill_town_id` FOREIGN KEY (`b_tid`) REFERENCES `town` (`t_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_menu_id` FOREIGN KEY (`c_mid`) REFERENCES `menu` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_user_id` FOREIGN KEY (`c_uid`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_cat_id` FOREIGN KEY (`m_cat`) REFERENCES `menu_category` (`mc_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `menu_special`
--
ALTER TABLE `menu_special`
  ADD CONSTRAINT `fk_special_menu_id` FOREIGN KEY (`ms_mid`) REFERENCES `menu` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_bill_id` FOREIGN KEY (`o_bid`) REFERENCES `bill` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_menu_id` FOREIGN KEY (`o_mid`) REFERENCES `menu` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_user_id` FOREIGN KEY (`o_uid`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_town_id` FOREIGN KEY (`u_tid`) REFERENCES `town` (`t_id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
