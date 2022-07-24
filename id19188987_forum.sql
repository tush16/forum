-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2022 at 01:33 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id19188987_forum`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`id19188987_root`@`%` PROCEDURE `getClubArchive` ()  SELECT * FROM club_archives$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club_description` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`club_id`, `club_name`, `club_description`, `created`, `image`) VALUES
(1, 'Nature Watch', 'The Nature club believes that nature teaches life’s lessons in its own subtle ways and enables our youth to share their responsibilities in maintaining a healthy environment and to take steps to avoid environmental degradation in their individual capacity as well as in a group.', '2022-01-14 16:41:56', 'NATURE CLUB.png'),
(2, 'Tech Minds', 'Coding is arguably one of the most important skills for current as well as future generations to learn. For young learners, programming helps to gain problem-solving skills i.e. to solve a problem in a logical as well as creative way.', '2022-01-14 16:45:42', 'techminds.png'),
(3, 'Journal Club', 'Ever need to know what you did on a specific day? This is one way a journal can be invaluable — documenting what you did and where you were.', '2022-01-14 16:49:06', 'journelclub.png'),
(4, 'i-Care', 'The iCare Group is a student-formed organization that believes and works over community events with the intention of spreading social benevolence ', '2022-01-14 16:52:47', 'icare.png'),
(5, 'Nurses Association', 'Nurses play a key role in Hospitals. They communicate with patients, understand them and take exceptional care of them along with administering medicines. With growing patient expectations and needs, the role of a nurse is also evolving.', '2022-01-16 16:15:41', 'acharyanurse.png'),
(14, 'Model United Nations', 'Model United Nations is an academic simulation of the United Nations where students play the role of delegates from different countries and attempt to solve real world issues with the policies and perspectives of their assigned country. For example, a student may be assigned the United Kingdom and will have to solve global topics such as nuclear non-pro', '2022-03-23 12:12:19', 'acharyaunitednations.png');

--
-- Triggers `clubs`
--
DELIMITER $$
CREATE TRIGGER `On_delete` BEFORE DELETE ON `clubs` FOR EACH ROW INSERT INTO club_archives
SET club_id = OLD.club_id, club_name = OLD.club_name,
club_description = OLD.club_description, created = OLD.created
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `club_archives`
--

CREATE TABLE `club_archives` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club_description` varchar(355) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `club_archives`
--

INSERT INTO `club_archives` (`club_id`, `club_name`, `club_description`, `created`) VALUES
(10, 'test', 'test', '2022-01-17 16:38:21'),
(11, 'test6 name', 'test6', '2022-01-17 17:05:12'),
(12, 'test delete', 'test delete', '2022-01-17 20:08:58'),
(13, 'test ', 'test', '2022-01-17 20:13:46'),
(6, 'Model United Nations', 'The UN Foundation is a strategic partner of the United Nations, bringing together the ideas, people, and resources it needs to drive global progress and tackle urgent problems. Our hallmark is to collaborate for lasting change and innovate to address humanity’s greatest challenges. ', '2022-01-16 16:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `thread_id` int(11) NOT NULL,
  `comment_by` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES
(1, 'where is the workshop?', 1, '1', '2022-01-15 21:26:32'),
(2, 'testing now', 1, '1', '2022-01-18 05:37:59'),
(3, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(4, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(5, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(6, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(7, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(8, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(9, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(10, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(11, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(12, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(13, 'testing now', 1, '1', '2022-01-18 05:38:13'),
(14, 'test 21', 8, '1', '2022-01-18 05:41:39'),
(15, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(16, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(17, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(18, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(19, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(20, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(21, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(22, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(23, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(24, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(25, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(26, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(27, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(28, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(29, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(30, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(31, 'test 21', 8, '1', '2022-01-18 05:41:54'),
(32, 'gh', 1, '8', '2022-06-29 10:25:40'),
(33, 'Wao janu', 1, '2', '2022-06-29 13:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `concern_id` int(11) NOT NULL,
  `concern_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `concern_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `concern_username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `concern` text COLLATE utf8_unicode_ci NOT NULL,
  `concern_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`concern_id`, `concern_name`, `concern_email`, `concern_username`, `concern`, `concern_date`) VALUES
(1, 'Tushar', 'tushar@gmail.com', 'tushar2216', 'There is some issue in the system please fix it', '2022-01-15 23:51:12'),
(2, 'Ashish', 'ashish@gmail.com', 'ashish', 'Is there a curfew?', '2022-01-15 23:56:05'),
(3, 'raj', 'tusharchoudhary8051@gmail.com', 'raj', 'hi testing thid', '2022-06-29 10:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `newsletter_user_id` int(11) NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_club_id` int(11) NOT NULL,
  `thread_user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_club_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'Nature Watch Workshop ', 'join for nature watch workshop on 25th jan 2022.', 1, 2, '2022-01-14 19:11:12'),
(2, 'Nature watch orientation', 'join for nature watch orientation program on 18th jan 2022.', 1, 3, '2022-01-14 19:32:40'),
(3, 'Test1 title', 'Test1 desc', 1, 4, '2022-01-14 22:42:34'),
(6, 'Test 2', 'Test 2 desc', 1, 1, '2022-01-14 22:44:38'),
(7, 'test3', 'test3', 1, 5, '2022-01-14 22:48:17'),
(8, 'Python coding issues', 'Contribute in issues', 2, 2, '2022-01-14 22:50:27'),
(9, 'presentation', 'how to make?', 1, 3, '2022-01-14 23:39:30'),
(10, 'Nature watch seminar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum tristique accumsan. Donec a lorem sit amet purus efficitur elementum. Cras faucibus consectetur eros et accumsan. Morbi gravida dolor sem, at ultricies nibh efficitur vitae. In viverra turpis augue, gravida egestas elit dictum ultricies. Sed mattis elementum tortor, eget molestie ex dapibus nec. Duis at nisl ut lacus dapibus eleifend. Mauris at metus eget ex malesuada volutpat. Aliquam iaculis tristique lectus, a tristique leo sagittis tempor. In at arcu vitae nibh euismod laoreet et in tellus. Nunc volutpat nisl lacus, in congue leo consequat vitae.\r\n\r\nNunc eleifend ante id consequat imperdiet. Fusce feugiat urna sed ligula luctus congue. Praesent varius, dolor eget consectetur molestie, turpis tellus sollicitudin arcu, ac varius nisi neque non orci. Donec ut dui iaculis, vulputate enim in, tincidunt purus. Proin scelerisque aliquam lorem, sit amet sodales lacus iaculis eget. Etiam tempus libero mi, et volutpat orci molestie nec. Morbi placerat, mi in laoreet rhoncus, risus felis viverra dui, non facilisis velit leo ut ante. Quisque nec viverra leo. Integer lacinia, dui quis ornare molestie, diam risus sagittis urna, a consequat lectus nibh eget mi. Vestibulum nec sapien eget risus consectetur posuere. Vivamus enim diam, convallis non egestas eget, mollis porta nunc.', 1, 1, '2022-01-15 15:13:29'),
(11, 'Nature watch seminar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec dictum tristique accumsan. Donec a lorem sit amet purus efficitur elementum. Cras faucibus consectetur eros et accumsan. Morbi gravida dolor sem, at ultricies nibh efficitur vitae. In viverra turpis augue, gravida egestas elit dictum ultricies. Sed mattis elementum tortor, eget molestie ex dapibus nec. Duis at nisl ut lacus dapibus eleifend. Mauris at metus eget ex malesuada volutpat. Aliquam iaculis tristique lectus, a tristique leo sagittis tempor. In at arcu vitae nibh euismod laoreet et in tellus. Nunc volutpat nisl lacus, in congue leo consequat vitae.\r\n\r\nNunc eleifend ante id consequat imperdiet. Fusce feugiat urna sed ligula luctus congue. Praesent varius, dolor eget consectetur molestie, turpis tellus sollicitudin arcu, ac varius nisi neque non orci. Donec ut dui iaculis, vulputate enim in, tincidunt purus. Proin scelerisque aliquam lorem, sit amet sodales lacus iaculis eget. Etiam tempus libero mi, et volutpat orci molestie nec. Morbi placerat, mi in laoreet rhoncus, risus felis viverra dui, non facilisis velit leo ut ante. Quisque nec viverra leo. Integer lacinia, dui quis ornare molestie, diam risus sagittis urna, a consequat lectus nibh eget mi. Vestibulum nec sapien eget risus consectetur posuere. Vivamus enim diam, convallis non egestas eget, mollis porta nunc.', 1, 3, '2022-01-15 15:18:01'),
(12, 'When is college open', 'tell me now', 1, 4, '2022-01-15 15:47:44'),
(13, 'lets see bbt', 'your views', 1, 4, '2022-01-15 16:02:26'),
(14, 'samplee', 'ssamplee', 2, 4, '2022-01-15 16:18:36'),
(15, 'hack', 'not gonnaa', 1, 4, '2022-01-15 16:38:51'),
(16, 'hack', '&lt;script&gt; alert(\"Hello world\"); &lt;/script&gt;', 1, 4, '2022-01-15 16:40:55'),
(17, '&lt;script&gt;alert(\"Hello! I am an alert box!!\"); &lt;/script&gt;', '&lt;script&gt;alert(\"Hello! I am an alert box!!\"); &lt;/script&gt;', 1, 4, '2022-01-15 16:42:35'),
(22, 'TEST1', 'TEST1', 3, 2, '2022-01-18 05:05:46'),
(23, 'TEST2', 'TEST2', 3, 3, '2022-01-18 05:06:45'),
(24, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:07:14'),
(25, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:07:34'),
(26, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:07:34'),
(27, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:08:06'),
(28, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:08:06'),
(29, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:08:06'),
(30, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:08:06'),
(31, 'TEST3', 'TEST3', 3, 1, '2022-01-18 05:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(5) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `fname`, `lname`, `username`, `email`, `password`, `dt`, `user_type`) VALUES
(1, 'Tushar', 'Choudhary', 'admin', 'tusharchoudhary8051@gmail.com', '$2y$10$gthGDf1qeqVqC740bVxlbekAAH/6v8jvSfLO0TmMBx4CFfNSaVy8i', '2022-01-15 14:26:59', 'admin'),
(2, 'Prerna', 'Kumari', 'prerna', 'prerna@gmail.com', '$2y$10$vFfgo9JDBUaW51NE4UOHQ.aRiOPQvLw.7WauXfGhIrU01OkoTOnLy', '2022-01-15 14:27:51', 'user'),
(3, 'ashish', 'kumar', 'ashish', 'ashish@gmail.com', '$2y$10$FarqYru2kWVT/8zf5dls5.W2uju5gaKtJVdRuM88J6A0dP7UVd3Wm', '2022-01-15 14:28:18', 'user'),
(4, 'himanshu', 'raj', 'himanshu', 'himanshu@gmail.com', '$2y$10$BKYx3TyZIwNZyi.NT22UqedyWXofi69cmMSYXnD.ou5WbQSBWs9aC', '2022-01-15 14:28:55', 'user'),
(5, 'nikhil', 'thakur', 'nikhil', 'nikhil@gmail.com', '$2y$10$uQzCrIL8nFWxbKUmIQ3zveA0oEcFUCLP9TOBLpYdLX0Ul5DNGncIa', '2022-01-15 14:29:26', 'user'),
(8, 'visiter', 'test', 'test', 'test@gmail.com', '$2y$10$bE1STDikjXpRGE9ipOoUnesnsAI2YowZAt8du6i2oD2EeDziuSoIO', '2022-06-29 15:41:10', 'user'),
(9, 'test', 'test', '_.tusharr_', 'asdasd@fasf.com', '$2y$10$xulCi1PXlrGyagc8aLK/betJkIEBzxLJg6FlLqO1rQtUcg8ZqxszC', '2022-06-29 16:34:48', 'user'),
(10, 'Tushar', 'Choudhary', 'pera', 'tusharchoudhary8051@gmail.com', '$2y$10$t8a43pPEZ9FlqT8EjUuyPOBuVCATsXn6B.wt8gkiWH5YbQ5tF0Zui', '2022-06-29 11:39:05', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`concern_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`newsletter_user_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `thread_title` (`thread_title`,`thread_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `concern_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `newsletter_user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
