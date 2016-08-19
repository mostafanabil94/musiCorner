-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 19, 2016 at 02:09 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicorner`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(15) NOT NULL,
  `friend1_id` int(15) NOT NULL,
  `friend2_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `friend1_id`, `friend2_id`) VALUES
(4, 3, 1),
(5, 2, 3),
(6, 3, 2),
(15, 1, 2),
(16, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `moods`
--

CREATE TABLE `moods` (
  `id` int(15) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moods`
--

INSERT INTO `moods` (`id`, `name`) VALUES
(1, 'happy'),
(2, 'sad'),
(3, 'energetic'),
(4, 'romantic'),
(5, 'light');

-- --------------------------------------------------------

--
-- Table structure for table `music list`
--

CREATE TABLE `music list` (
  `id` int(15) NOT NULL,
  `name` text NOT NULL,
  `picture` varchar(250) NOT NULL,
  `youtube link` varchar(1000) NOT NULL,
  `mood` text NOT NULL,
  `added by` varchar(150) NOT NULL,
  `artist` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `music list`
--

INSERT INTO `music list` (`id`, `name`, `picture`, `youtube link`, `mood`, `added by`, `artist`) VALUES
(1, 'Happy', 'img/Pharrell_Williams_-_Happy.jpg', 'https://www.youtube.com/watch?v=y6Sxv-sUYtM', '1', '1', 'Pharrell Williams'),
(2, 'Counting Stars', 'img/counting stars.jpg', 'https://www.youtube.com/watch?v=hT_nvWreIhg', '1', '1', 'OneRepublic'),
(3, 'Formidable', 'img/Stromae-Formidable.jpg', 'https://www.youtube.com/watch?v=S_xH7noaqTA', '2', '2', 'Stromae'),
(4, 'Snow', 'img/2001-a-space-odyssey-wallpaper.jpg', 'https://www.youtube.com/watch?v=pjmL5WWgO6o', '3', '1', 'Nathalie Saba'),
(11, 'Song', 'img/2001-a-space-odyssey-wallpaper.jpg', 'google.com', '5', '9', 'Amr Diab'),
(12, 'Song2', 'img//2001-a-space-odyssey-wallpaper.jpg', 'google.com', '5', '1', 'Ana');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `full name` text NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `profile picture` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full name`, `username`, `email`, `password`, `profile picture`) VALUES
(1, 'Mostafa Nabil', 'mostafanabil94', 'mostafanabil94@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(2, 'Abdelrahman Osama', '3abkareenno', 'abdelrahman.osama93@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(3, 'mahmoud amin', 'aminawe', 'amin@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(7, 'Ahmed Hani', 'ahmedhani93', 'hani@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(9, 'Ahmed Talaat', 'ahmedtalaat', 'ahmedtalaat@gmail.com', '202cb962ac59075b964b07152d234b70', ''),
(10, 'Nabil Gamal', 'nabilgamal63', 'nabilgamal63@gmail.com', '202cb962ac59075b964b07152d234b70', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moods`
--
ALTER TABLE `moods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music list`
--
ALTER TABLE `music list`
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
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `moods`
--
ALTER TABLE `moods`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `music list`
--
ALTER TABLE `music list`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
