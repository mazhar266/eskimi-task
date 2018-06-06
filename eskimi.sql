-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 27, 2018 at 05:08 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eskimi`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `parent` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`, `status`) VALUES
(1, 'Java', NULL, 1),
(2, 'PHP', NULL, 1),
(4, 'JavaScript', NULL, 1),
(5, 'Ruby', NULL, 1),
(6, 'Go', NULL, 1),
(7, 'Elixir', 8, 1),
(8, 'Erlang', NULL, 1),
(9, 'Scala', 1, 1),
(10, 'Clojure', 1, 1),
(11, 'Groovy', 1, 1),
(12, 'Symfony', 2, 1),
(14, 'Spring Framework', 1, 1),
(16, 'test', NULL, 1),
(17, 'Play Framework', 9, 1),
(19, 'Play Framework', 1, 1),
(24, 'Auth', 17, 1),
(25, 'a', 24, 1),
(26, 'b', 25, 1),
(27, 'b', 25, 1),
(28, 'b', 25, 1),
(29, 'c', 27, 1),
(30, 'd', 29, 1),
(31, 'ddd', 29, 1),
(33, 'dd', 29, 1),
(35, 'Django', 3, 1),
(36, 'Flask', 3, 1),
(37, 'Pyramid', 3, 1),
(38, 'Rails', 5, 1),
(39, 'Sinatra', 5, 1),
(40, 'Express', 42, 1),
(41, 'Frontend', 4, 1),
(42, 'Backend', 4, 1),
(43, 'Koa', 42, 1),
(44, 'Sails', 42, 1),
(45, 'React', 41, 1),
(46, 'Angular', 41, 1),
(47, 'Vue', 41, 1),
(49, 'CodeIgniter', 2, 1),
(50, 'CakePHP', 2, 1),
(51, 'Laravel', 2, 1),
(52, 'Phalcon', 2, 1),
(53, 'Revel', 6, 1),
(54, 'Beego', 6, 1),
(55, 'Phoenix', 7, 1),
(56, 'ChicagoBoss', 8, 1),
(57, 'Zotonic', 8, 1),
(58, 'Luminus', 10, 1),
(59, 'Grails', 11, 1),
(60, 'Gin', 6, 1),
(61, 'Python', NULL, 1),
(62, 'Django', 61, 1),
(63, 'Flask', 61, 1),
(64, 'Pyramid', 61, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text,
  `category` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `body`, `category`) VALUES
(1, 'test', 'Donec rutrum congue leo eget malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Nulla porttitor accumsan tincidunt. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Pellentesque in ipsum id orci porta dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed porttitor lectus nibh. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 17),
(2, 'another test', 'Pellentesque in ipsum id orci porta dapibus. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Cras ultricies ligula sed magna dictum porta. Proin eget tortor risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada.', 26);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `status`) VALUES
(1, 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecadk32duem01vZsQ2lB8g0s', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
