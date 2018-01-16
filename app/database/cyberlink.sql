-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 16, 2018 at 11:05 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyberlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` INTEGER NOT NULL PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `votes_id` int(255) NOT NULL,
  `timeOfSub` int(11) NOT NULL,
  `rank` int(255) NOT NULL
);

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `url`, `image`, `user_id`, `votes_id`, `timeOfSub`, `rank`) VALUES
(83, 'Batman!', 'nananananananananana!', 'ads', 'uploads/791515844368.png', 79, 0, 1515844368, 0),
(84, 'Barbapapa', 'Do you feel me!', 'sad', 'uploads/811515844473.jpeg', 81, 0, 1515844473, 0),
(87, 'T-rex', 'I drive Rolls Royce cause its good for my voice!', 'Argh!', 'uploads/781515880695.png', 78, 0, 1515880695, 0),
(88, 'The bridge', 'This is just a stupid bridge! Please don&#39;t vote it up', 'dasklvmslavml', 'uploads/781515966583.jpg', 78, 0, 1515966583, 0),
(90, 'Albert är bäst', 'This is my website', 'www.albertnorberg.com', 'uploads/781516038277.jpg', 78, 0, 1516038277, 0),
(96, 'dsfafads', 'afdafds', 'fadsfds', 'uploads/781516039233.jpg', 78, 0, 1516039233, 0),
(97, 'batan', 'adfsafsdadsf', 'www.google.com', 'uploads/781516093775.jpg', 78, 0, 1516093775, 0),
(98, 'dgsfdfx', 'gfnfg', 'www.google.com', 'img/post.svg', 78, 0, 1516093853, 0),
(99, 'ngxfnxfgn', 'nxfgnfg', 'kjdkxdpf', 'img/post.svg', 78, 0, 1516093927, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` INTEGER NOT NULL PRIMARY KEY,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `password` text NOT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `bio`, `avatar`, `password`) VALUES
(78, 'Albert', 'albert.norberg@gmail.com', 'This my bio', 'uploads/78.jpg', '$2y$10$TstVE2fhfx3cmXOTOSVB1.oNvlLncVpMq8FK5q1qfO/QTWeAd740K'),
(79, 'Sebbe', 'seb.wallin@gmail.com', 'I am the brother of the creator this lovely website!', 'uploads/79.jpg', '$2y$10$eFqNhZYq5jpMxvi0V5TCB.mOL4udUhVPg0.DBgWrwxqwtsqZSR7vi'),
(80, 'herus', 'nowequ@gmail.com', 'I am Herus', 'uploads/80.jpg', '$2y$10$3sJjzZtwAb5iCWNyXCYONOxNYvpXdg7GhT/SjwkjEIlDnZOe.fEtW'),
(81, 'Danielle', 'dan.ii@hotmail.com', '', 'img/user.png', '$2y$10$Y5LwIaApjHw.766aYa6KZeqlLddhowUbQo22RKmeUv1uxUMGV4wMK'),
(82, 'xudobywefe', 'fucoxydod@gmail.com', '', 'img/user.png', '$2y$10$ap.RIBq9.XtohyvGT3z7GOBCwATOfRasB75bSfzHX0qzNDzkhRtIy'),
(83, 'pigub', 'tupukububi@hotmail.com', '', 'img/user.png', '$2y$10$OdiHhcm7FVfaKD7L3AwlC.HjJgYvzkiel5MhVExlHsg4GUX4etVFq'),
(84, 'xanezybag', 'kona@gmail.com', '', 'img/user.png', '$2y$10$8y/tEpwRvU878JcI8ifAweTpFg13ve1JIURFQbvRKqzvC9DQhUy4C'),
(85, 'parasoqo', 'raqyj@hotmail.com', '', 'img/user.png', '$2y$10$cvfk7cP4z63nEkH7SprJq.GBNFowJF0JIIFUr3.eSB4FiAIbmjA1C');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` INTEGER NOT NULL PRIMARY KEY,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `vote` int(255) NOT NULL
);

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `user_id`, `post_id`, `vote`) VALUES
(90, 78, 82, -1),
(91, 79, 83, 1),
(92, 79, 82, 1),
(93, 81, 84, 1),
(94, 81, 83, -1),
(95, 81, 82, 1),
(96, 79, 84, 1),
(97, 0, 85, 0),
(98, 78, 86, 0),
(99, 78, 87, -1),
(100, 0, 82, -1),
(101, 0, 83, -1),
(102, 0, 84, -1),
(103, 78, 83, -1),
(104, 82, 82, 1),
(105, 82, 83, -1),
(106, 82, 84, 1),
(107, 82, 87, 1),
(108, 83, 82, 1),
(109, 83, 83, -1),
(110, 83, 84, 1),
(111, 83, 87, 1),
(112, 78, 84, 1),
(113, 78, 88, 1),
(114, 81, 88, 1),
(115, 81, 87, 1),
(116, 84, 83, -1),
(117, 84, 82, 1),
(118, 84, 88, 1),
(119, 84, 87, -1),
(120, 84, 84, 1),
(121, 85, 83, -1),
(122, 85, 87, 1),
(123, 85, 82, 0),
(124, 85, 88, 1),
(125, 78, 89, 1),
(126, 78, 90, -1),
(127, 78, 91, 0),
(128, 78, 92, 0),
(129, 78, 93, 0),
(130, 78, 94, 0),
(131, 78, 95, 0),
(132, 78, 96, 0),
(133, 79, 90, -1),
(134, 79, 96, -1),
(135, 78, 97, 0),
(136, 78, 98, 0),
(137, 78, 99, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
-- ALTER TABLE `posts`
--   ADD PRIMARY KEY (`id`);
--
-- --
-- -- Indexes for table `users`
-- --
-- ALTER TABLE `users`
--   ADD PRIMARY KEY (`user_id`);
--
-- --
-- -- Indexes for table `votes`
-- --
-- ALTER TABLE `votes`
--   ADD PRIMARY KEY (`vote_id`);
--
-- --
-- AUTO_INCREMENT for dumped tables
--

--
-- -- AUTO_INCREMENT for table `posts`
-- --
-- ALTER TABLE `posts`
--   MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
-- --
-- -- AUTO_INCREMENT for table `users`
-- --
-- ALTER TABLE `users`
--   MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
-- --
-- -- AUTO_INCREMENT for table `votes`
-- --
-- ALTER TABLE `votes`
--   MODIFY `vote_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
