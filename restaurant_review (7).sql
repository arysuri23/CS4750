-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2023 at 06:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_review`
--

-- --------------------------------------------------------

--
-- Table structure for table `adds`
--

CREATE TABLE `adds` (
  `email` varchar(300) NOT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adds`
--

INSERT INTO `adds` (`email`, `restaurant_id`) VALUES
('britneylover123@gmail.com', 8),
('charlotte@hotmail.com', 9),
('icanmanage@gmail.com', 10),
('idobemanaging@gmail.com', 2),
('joocemanager@gmail.com', 7),
('manager1@gmail.com', 3),
('manager3@gmail.com', 4),
('managurrr@virginia.edu', 1),
('restaurantmanager@hotmail.com', 5),
('themanager@yahoo.com', 6);

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `answer_text` varchar(300) NOT NULL,
  `answer_date` date NOT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `answer_text`, `answer_date`, `question_id`) VALUES
(1, 'We use a special blend of olive oil and grease to get that extra bend!', '2022-03-30', 1),
(2, 'Refunds are returned to the card that was originally charged', '2022-04-07', 2),
(3, 'There\'s a garage on the corner of Market and Main!', '2022-04-07', 3),
(4, 'From 2-5pm today!', '2022-04-04', 4),
(5, 'Google maps', '2022-04-05', 5),
(6, 'It is part of our limited Shrek Fish deal', '2022-04-06', 6),
(7, 'Sir, this is a Wendy\'s', '2022-04-06', 7),
(8, 'Sorry about that! Our website is experiencing tenchical difficulties. Stay tuned!', '2022-04-07', 8),
(9, 'Follow the link titled \'Careers\' at the bottom of the page!', '2022-04-08', 9),
(10, 'Unfortunately those only come with kids\' meals.', '2022-04-09', 10);

-- --------------------------------------------------------

--
-- Table structure for table `google_users`
--

CREATE TABLE `google_users` (
  `id` int(11) NOT NULL,
  `google_id` varchar(150) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `google_users`
--

INSERT INTO `google_users` (`id`, `google_id`, `name`, `email`, `profile_image`) VALUES
(1, '1', 'Ary', 'ary@gmail.com', 'pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `reviewer_email` varchar(300) NOT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`reviewer_email`, `restaurant_id`) VALUES
('abraham123@gmail.com', 2),
('cornbreadjesus@gmail.com', 1),
('gordonramsey@gmail.com', 9),
('jimbo12345@gmail.com', 2),
('kiheishamer@gmail.com', 9),
('miles_rates@gmail.com', 1),
('theaustralianguy@gmail.com', 5),
('thegoodrater@gmail.com', 1),
('thegoodrater@gmail.com', 2),
('therater@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question_text` varchar(300) NOT NULL,
  `question_date` date NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `answered` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question_text`, `question_date`, `restaurant_id`, `answered`) VALUES
(1, 'Why are your tacos soggy', '2022-03-29', 1, NULL),
(2, 'How are refunds processed', '2022-04-01', 2, NULL),
(3, 'Where can I find parking', '2022-04-04', 3, NULL),
(4, 'When is happy hour', '2022-04-04', 4, NULL),
(5, 'Do you know the way', '2022-04-04', 5, NULL),
(6, 'Why was your fish green', '2022-04-05', 6, NULL),
(7, 'When will the McRib return', '2022-04-05', 7, NULL),
(8, 'Why can\'t I order online?', '2022-04-06', 8, NULL),
(9, 'Where can I apply for a job', '2022-04-07', 9, NULL),
(10, 'Why didn\'t I get a toy with my order today?', '2022-04-08', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `restaurant_id` int(100) NOT NULL,
  `image_url` varchar(300) NOT NULL,
  `address` varchar(300) NOT NULL,
  `on_elevate` tinyint(1) NOT NULL,
  `open` time NOT NULL,
  `close` time NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`restaurant_id`, `image_url`, `address`, `on_elevate`, `open`, `close`, `name`) VALUES
(1, 'image1.jpg', '1234 Main St.', 1, '11:00:00', '19:00:00', 'Asado'),
(2, 'image24.jpg', '32 North Ave.', 0, '12:00:00', '20:00:00', 'The Virginian'),
(3, 'img123.jpg', '60 Ninth St.', 0, '11:00:00', '19:30:00', 'Got Dumplings'),
(4, 'logo.jpg', '1600 Pennsylvania Ave.', 0, '08:00:00', '13:00:00', 'Mellow Mushroom'),
(5, 'restaurant_image', '1800 Jefferson Park Ave.', 1, '13:00:00', '21:30:00', 'Insomnia Cookies'),
(6, 'screen_shot.png', '999 Elliewood Rd.', 0, '12:00:00', '19:00:00', 'Bodos Bagels'),
(7, 'thejuice.jpeg', '1 Juice Ave.', 1, '01:00:00', '23:00:00', 'Corner Juice'),
(8, 'boylan.png', '12 Grimmauld Pl.', 0, '15:00:00', '02:00:00', 'Boylan Heights'),
(9, 'logo.jpg', '74 Chancellor\'s Street', 0, '11:00:00', '19:00:00', 'Pronto'),
(10, 'logo.png', '88th Ninth St.', 1, '11:00:00', '19:30:00', 'Roots');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_cuisine`
--

CREATE TABLE `restaurant_cuisine` (
  `restaurant_id` int(11) NOT NULL,
  `cuisine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant_cuisine`
--

INSERT INTO `restaurant_cuisine` (`restaurant_id`, `cuisine`) VALUES
(1, 'Mexican'),
(2, 'Southern'),
(3, 'Chinese'),
(4, 'Italian'),
(5, 'Dessert'),
(6, 'Breakfast Bagels'),
(7, 'Breakfast'),
(8, 'Burgers'),
(9, 'Italian'),
(10, 'Rice Bowls/Salads');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_manager`
--

CREATE TABLE `restaurant_manager` (
  `email` varchar(100) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant_manager`
--

INSERT INTO `restaurant_manager` (`email`, `name`) VALUES
('Britneylover123@gmail.com', 'Joseph Dillard'),
('Charlotte@gmail.com', 'Charlotte Bell'),
('icanmanage@gmail.com', 'Chris Oh'),
('idobemanaging@gmail.com', 'Brandon White'),
('joocemanager@gmail.com', 'Thomas Shelby'),
('manager1@gmail.com', 'Patrick Smith'),
('manager3@gmail.com', 'Mary Lane'),
('managurrr@virginia.edu', 'Jack Smith'),
('restaurantmanager@gmail.com', 'John Paul'),
('themanager@gmail.com', 'Lauren Cox');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `overall_rating` int(11) NOT NULL,
  `service_rating` int(11) NOT NULL,
  `food_rating` int(11) NOT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `overall_rating`, `service_rating`, `food_rating`, `comment`, `restaurant_id`, `email`) VALUES
(1, 1, 1, 2, 'awful experience', 1, 'rater1@gmail.com'),
(2, 5, 5, 4, 'mid tbh', 1, 'thegoodrater@gmail.com'),
(3, 4, 3, 4, 'great experience', 2, 'jimbo12345@gmail.com'),
(4, 3, 5, 2, 'honestly could be better', 2, 'therater@gmail.com'),
(5, 5, 3, 3, 'decent', 1, 'miles_rates@gmail.com'),
(6, 5, 2, 5, 'i liked it! got to watch #got with my hubby there', 5, 'theaustralianguy@gmail.com'),
(7, 2, 1, 1, 'Made me want to throw up', 1, 'cornbreadjesus@gmail.com'),
(8, 3, 1, 4, 'when will kihei retire?', 9, 'kiheishamer@virginia.edu'),
(9, 5, 4, 5, 'great food! service wasn\'t great though', 9, 'gordonramsey@gmail.com'),
(10, 5, 5, 3, 'I want to rate it higher but the fish was green', 2, 'abraham123@gmail.com');

--
-- Triggers `review`
--
DELIMITER $$
CREATE TRIGGER `food_rating_trigger` BEFORE INSERT ON `review` FOR EACH ROW BEGIN
    IF new.food_rating > 5 THEN
        SET new.food_rating = 5;
    ELSEIF new.food_rating < 1 THEN
        SET new.food_rating = 1;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `overall_rating_trigger` BEFORE INSERT ON `review` FOR EACH ROW BEGIN
    IF new.overall_rating > 5 THEN
        SET new.overall_rating = 5;
    ELSEIF new.overall_rating < 1 THEN
        SET new.overall_rating = 1;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `service_rating_trigger` BEFORE INSERT ON `review` FOR EACH ROW BEGIN
    IF new.service_rating > 5 THEN
        SET new.service_rating = 5;
    ELSEIF new.service_rating < 1 THEN
        SET new.service_rating = 1;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reviewer`
--

CREATE TABLE `reviewer` (
  `email` varchar(100) NOT NULL,
  `display_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviewer`
--

INSERT INTO `reviewer` (`email`, `display_name`) VALUES
('abraham123@gmail.com', 'Lincoln Trissel'),
('cornbreadjesus@gmail.com', 'Elena Belena'),
('gordonramsey@gmail.com', 'Bobby Flay'),
('jimbo12345@gmail.com', 'Jim Ryan'),
('kiheishamer@virginia.edu', 'Armaan Franklin'),
('miles_rates@gmail.com', 'Miles Wilcox'),
('rater1@gmail.com', 'Justin Bieber'),
('theaustralianguy@gmail.com', 'Chris Hemsworth'),
('thegoodrater@gmail.com', 'John Cena'),
('therater@gmail.com', 'Bob Roberto');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `password`) VALUES
('britneylover123@gmail.com', 'f12'),
('charlotte@hotmail.com', 'nadsiov89rq4'),
('icanmanage@gmail.com', 'fioh43uqhj'),
('idobemanaging@gmail.com', 'corgis'),
('jimbo12345@yahoo.com', 'GoHoos1!'),
('joocemanager@gmail.com', 'dngjbsad'),
('managurrr@virginia.edu', 'password123'),
('rater1@hotmail.com', 'rater123'),
('thegoodrater@hotmail.com', 'UVA1234'),
('themanager@yahoo.com', 'gsiuvs8hoahjn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adds`
--
ALTER TABLE `adds`
  ADD PRIMARY KEY (`email`,`restaurant_id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `google_users`
--
ALTER TABLE `google_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`reviewer_email`,`restaurant_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `restaurant_cuisine`
--
ALTER TABLE `restaurant_cuisine`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `restaurant_manager`
--
ALTER TABLE `restaurant_manager`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `reviewer`
--
ALTER TABLE `reviewer`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `google_users`
--
ALTER TABLE `google_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
