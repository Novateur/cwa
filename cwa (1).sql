-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 11:09 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `date_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `date_time`) VALUES
(1, '4', '1', 'This is not a cool topic to write on', '2017-02-20 12:28:45'),
(2, '4', '1', 'This topic is interesting, i think am in for itvbnl;''lkjhcvx', '2017-02-21 12:28:45'),
(3, '4', '2', 'this is  a test', '2017-02-22 03:36:02'),
(4, '4', '2', 'this is  a test ooooo', '2017-02-22 03:36:05'),
(11, '4', '1', 'gggdhghfghghfhf', '2017-03-01 12:35:52'),
(12, '5', '1', 'hbjjhjkjkjkhjnbnmnmb', '2017-03-01 03:53:11'),
(13, '5', '1', 'jhjhjgjhjhjj gjhjhjgjhj', '2017-03-01 03:53:24'),
(14, '6', '1', 'aghgfdsa JHGFDSA', '2017-03-01 04:08:20'),
(15, '4', '2', 'dhgfds', '2017-03-02 11:20:28'),
(18, '4', '2', 'fgchxjzkl:Zxkhttp://h', '2017-03-03 03:06:58'),
(20, '4', '3', 'jkjhgjkhgj', '2017-03-03 04:16:57'),
(25, '4', '9', 'hdhfhhf hfhfduiuiriur oioidlklfjhfjf iuiiuriuiur', '2017-03-05 04:23:07'),
(26, '4', '9', 'dsdertrergfdf hkjhygh iuyi', '2017-03-05 04:40:30'),
(27, '4', '9', 'sdfdsa SGAHSAHGHS', '2017-03-07 01:40:07'),
(28, '4', '10', 'dfdsasdfghgfdidiuiff', '2017-03-17 05:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `post_id`, `user_id`, `content`, `date_time`, `status`) VALUES
(5, '2', '4', '4124CON4237.pdf', '2017-03-03 04:01:07', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `caused_by` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `post_id`, `action`, `date_time`, `status`, `caused_by`) VALUES
(1, '4', '1', 'commented', '2017-02-28 11:42:15', 1, 'writer'),
(2, '4', '2', 'requested', '2017-02-28 12:04:16', 1, 'writer'),
(7, '5', '2', 'commented', '2017-03-01 09:40:48', 1, 'publisher'),
(8, '4', '1', 'commented', '2017-03-01 12:35:52', 1, 'writer'),
(9, '5', '1', 'commented', '2017-03-01 03:53:11', 1, 'publisher'),
(10, '5', '1', 'commented', '2017-03-01 03:53:24', 1, 'publisher'),
(11, '6', '1', 'commented', '2017-03-01 04:08:20', 1, 'writer'),
(12, '4', '2', 'commented', '2017-03-02 11:20:28', 1, 'writer'),
(13, '5', '2', 'commented', '2017-03-03 01:20:21', 1, 'publisher'),
(14, '5', '2', 'commented', '2017-03-03 03:05:50', 1, 'publisher'),
(15, '4', '2', 'commented', '2017-03-03 03:06:58', 1, 'writer'),
(16, '5', '2', 'commented', '2017-03-03 03:07:17', 1, 'publisher'),
(17, '4', '3', 'commented', '2017-03-03 04:16:57', 1, 'writer'),
(26, '4', '9', 'commented', '2017-03-05 04:40:30', 1, 'writer'),
(27, '4', '9', 'requested', '2017-03-06 03:23:04', 1, 'writer'),
(28, '4', '8', 'requested', '2017-03-07 12:32:35', 0, 'writer'),
(29, '4', '9', 'commented', '2017-03-07 01:40:07', 1, 'writer'),
(30, '4', '10', 'commented', '2017-03-17 05:21:28', 0, 'writer');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post` text COLLATE utf8_unicode_ci,
  `publisher_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_of_content` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `post`, `publisher_id`, `type_of_content`, `price`, `date_time`) VALUES
(1, 'Effects of short story', 'The short story has been considered both an apprenticeship form preceding more lengthy works, and a crafted form in its own right, collected together in books of similar length, price, and distribution as novels. Short story writers may define their works as part of the artistic and personal expression of the form. They may also attempt to resist categorization by genre and fixed formation.ffdddjkfkjk kjkfjkjkfkf', '5', 'written', '5000', '2017-02-21 12:28:45'),
(2, 'The Nigerian economy', 'A short story is a piece of prose fiction that can be read in one sitting. Emerging from earlier oral storytelling traditions in the 17th century, the short story has grown to encompass a body of work so diverse as to defy easy characterization.', '5', 'written', '9000', '2017-02-20 12:28:45'),
(3, 'Killing of twins', 'MarySlesor lol, my spelling is wrong. Stop the killing of twins', '5', 'Video', '6000', '2017-02-27 12:52:48'),
(7, 'treweytrewtre', '&lt;ul&gt;&lt;li&gt;vcxvcxbvcvcv&lt;/li&gt;&lt;li&gt;fhjdkkjfdkjhfdkjjf&lt;/li&gt;&lt;li&gt;jkfjfhkjkfhjhjjfj&lt;/li&gt;&lt;li&gt;hjfkkfjjjhfkjkf&lt;/li&gt;&lt;/ul&gt;', '5', 'Written', '6000', '2017-02-27 02:09:30'),
(9, 'American Government', '&lt;span style="color:#202121;font-family:Roboto, serif;font-size:17px;background-color:#f4f7f6;"&gt;posts&amp;nbsp;as they certainly offer high quality typefaces and deserve to be considered. It&amp;rsquo;s important to be aware that web fonts can generate inadequate visualizations on &lt;strong&gt;operating systems&lt;/strong&gt; which&amp;nbsp;have subpixel rendering turned off in the case of&amp;nbsp;Windows XP. They&amp;nbsp;can also be&amp;nbsp;represented differently depending on the browser used to visualize them. The aim&amp;nbsp;of this post is to facilitate&amp;nbsp;&lt;/span&gt;&lt;span style="margin:0px;padding:0px;box-sizing:inherit;color:#202121;font-family:Roboto, serif;font-size:17px;background-color:#f4f7f6;"&gt;the choice of a series of fonts&lt;/span&gt;&lt;span style="color:#202121;font-family:Roboto, serif;font-size:17px;background-color:#f4f7f6;"&gt;&amp;nbsp;(out of the hundreds available) whose technical and visual characteristics make them&amp;nbsp;&lt;/span&gt;&lt;span style="margin:0px;padding:0px;box-sizing:inherit;color:#202121;font-family:Roboto, serif;font-size:17px;background-color:#f4f7f6;"&gt;more readable and compatible&lt;/span&gt;&lt;span style="color:#202121;font-family:Roboto, serif;font-size:17px;background-color:#f4f7f6;"&gt;&amp;nbsp;with a&amp;nbsp;wide variety of &lt;strong&gt;devices, browsers &lt;/strong&gt;and operating systems.&lt;/span&gt;', '5', 'Written', '10000', '2017-03-05 04:41:22'),
(10, 'Friends not foes', 'We are &lt;strong&gt;friends&lt;/strong&gt; and not &lt;strong&gt;foes&lt;/strong&gt; irrespective of the level, tribe, religion and culture. I pray you understand that. Life is too &lt;span style="text-decoration:underline;"&gt;&lt;em&gt;&lt;strong&gt;short&lt;/strong&gt;&lt;/em&gt;&lt;/span&gt;.&lt;strong&gt;&lt;/strong&gt;', '5', 'Written', '3000', '2017-03-07 01:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add1` text COLLATE utf8_unicode_ci,
  `add2` text COLLATE utf8_unicode_ci,
  `qualifications` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `phone`, `email`, `password`, `photo`, `add1`, `add2`, `qualifications`) VALUES
(4, 'Novateur Nigeria', '07060815446', 'info@novateur.ng', '3ad17e661bfeec9970fbc375b08610b4dac11849', 'avatar.jpg', 'NAIC (Nigerian Agricultural Insurance Corporation) House, CBD, Abuja', 'House 70 Patnasonic Estate, Mbora, Abuja.', 'Savvy Web/Mobile Developer with technical software development. Expert in a variety of platforms languages , in-depth understanding of web technologies with a focus on delivering innovative business solutions, bringing superior design and debugging capabilities, innovative problem solving skills and dedication to quality.\n\nHighly dependable and a supportive and enthusiastic team player dedicated to streamlining processes and efficiently resolving project issues.\n\nHappy to be part of a dynamic software development team.\n\nFluent in Ionic,Angular js,lua,Python, Javascript, Java, PHP and can adapt to/learn new languages and application development technology.');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `update_level` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `post_id`, `user_id`, `status`, `date_time`, `update_level`) VALUES
(11, '1', '4', '0', '2017-02-23 01:53:13', NULL),
(12, '2', '4', '1', '2017-02-28 12:04:16', 'completed'),
(16, '9', '4', '0', '2017-03-06 03:23:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add1` text COLLATE utf8_unicode_ci,
  `add2` text COLLATE utf8_unicode_ci,
  `qualifications` text COLLATE utf8_unicode_ci,
  `gender` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_origin` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priviledge` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `title`, `name`, `phone`, `email`, `password`, `photo`, `add1`, `add2`, `qualifications`, `gender`, `state_origin`, `username`, `priviledge`) VALUES
(4, 'Mr', 'Akobundu Michael', '07060815446', 'akobundumichael94@gmail.com', '3ad17e661bfeec9970fbc375b08610b4dac11849', 'bun_2.jpg', 'NAIC (Nigerian Agricultural Insurance Corporation) House, CBD, Abuja', 'House 70 Patnasonic Estate, Mbora, Abuja.', 'Savvy Web/Mobile Developer with technical software development. Expert in a variety of platforms languages , in-depth understanding of web technologies with a focus on delivering innovative business solutions, bringing superior design and debugging capabilities, innovative problem solving skills and dedication to quality.\r\n\r\nHighly dependable and a supportive and enthusiastic team player dedicated to streamlining processes and efficiently resolving project issues.\r\n\r\nHappy to be part of a dynamic software development team.\r\n\r\nFluent in Ionic,Angular js,lua,Python, Javascript, Java, PHP and can adapt to/learn new languages and application development technology.', 'Male', 'Abia', 'bundle', 'writer'),
(5, NULL, 'Novateur Nigeria', '07060815446', 'info@novateur.ng', '3ad17e661bfeec9970fbc375b08610b4dac11849', 'avatar.jpg', 'NAIC (Nigerian Agricultural Insurance Corporation) House, CBD, Abuja', 'House 70 Patnasonic Estate, Mbora, Abuja.', NULL, NULL, NULL, NULL, 'publisher'),
(6, NULL, 'Michael Test', '0909987878', 'test@test.com', 'b547b91173389fa5fd9ca2a29aff5f588475c30f', 'avatar.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
