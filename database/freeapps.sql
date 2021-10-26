-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 12:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freeapps`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `a_id` bigint(20) UNSIGNED NOT NULL,
  `a_name` varchar(300) DEFAULT NULL,
  `photo` varchar(300) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `link` varchar(2000) DEFAULT NULL,
  `category` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`a_id`, `a_name`, `photo`, `description`, `link`, `category`) VALUES
(1, 'Adobe Photoshop CC 2020 Free Download', 'ps.png', 'Adobe Photoshop is an imposing photo editing application which is being used worldwide. Released more than 30 years ago, Photoshop has become the industryâ€™s standard in the field of raster graphics editing as well as digital arts. The popularity of Photoshop can be judged by the fact that a new verb was coined for image editing i.e. â€œPhotoshoppedâ€. Since 1988 Adobe Photoshop has come up in many versions and the one we are reviewing here is Adobe Photoshop CC 2020. You can also download Adobe Photoshop CC 2019.', 'http://51.77.53.146/Getintopc.com/Adobe_Photoshop_2020_v21.0.2.57x64_Multilingual.zip?md5=3M3-kACNq-7cFwEGkJhXWw&expires=1582497870', 'Photo Editing'),
(2, 'Windows 10 Pro Updated Jan 2020 Free Download', 'windows10.svg', 'Windows 10 Pro is an operating system from Microsoft that has become popular among the masses due to itâ€™s stability as well as security aspects. Windows was first developed more than 30 years ago and since then it has become the number one choice for most of the users all around the globe. Windows 10 is the latest offering and it has also come up in many different builds. The one we are reviewing is Windows 10 Pro Updated Jan 2020. You can also download Windows 10 Pro x64 Updated Oct 2019.', 'http://51.75.145.212/Getintopc.com/W10X64.PROVL.ENU.JAN2020.ISO?md5=y1pSdHEN7LUfFUIe7t9nCA&expires=1582547232', 'Operating Systems'),
(3, 'FL Studio Producer Edition + Signature Bundle v20.6.1 2019 Download', 'flstudio.jpg', 'FL Studio Producer Edition is an imposing application which lets you create your own music. It allows you to create your own tracks of almost any style plus it also allows you to record the vocals to mix it. You can also edit your music and can also cut any portion. FL Studio has got 14 years of innovative development experience behind it. You can also download FL Studio Producer Edition + Signature Bundle v20.5.', 'http://54.36.174.175/Getintopc.com/FL_Studio_Producer_Edition_20.6.1_Build_1513.zip?md5=a6ZXAxcy05SOo4EyQOmu1A&expires=1582933840', 'Music'),
(4, 'Database Workbench Pro Free Download', 'dbwb.png', 'Database Workbench Pro is a comprehensive application aimed to provide users with a platform through which users can develop with multiple database engines. With the integration of the application in the workflow will improve and boost productivity as it has useful, required and powerful tools, and features. It has a clean, tidy and straightforward user interface with all tools assigned clearly for easy and quick navigation. Users can reverse engineer the database without requiring additional application and with fewer steps possible. You can also download Absolute Database.', 'http://51.77.53.163/Getintopc.com/Database_Workbench_Pro_5.5.0.270.zip?md5=BWQ1oHeI4ireGewILIoIFQ&expires=1582986721', 'Database'),
(5, 'AVG Internet Security 2019 Free Download', 'avg.png', 'AVG Internet Security is the most used and famous antivirus through which users can protect their computer and identity from the internet. It prevents Viruses, Spyware, Hacks, Spam, or other malicious activity reaching toward users computer. It blocks the application containing viruses and spyware before installing or extracting on the userâ€™s computer. It also monitors users browsers and prevents users to browse through unwanted or vulnerable websites. You can also download Advanced Systemcare Ultimate 12.', 'http://51.75.145.216/Getintopc.com/AVG.IS.19.7.3103.zip?md5=qfXd35up5eZlZmRB0oXbdw&expires=1582986999', 'Antivirus'),
(6, 'Starry Night Pro Plus 2020 Free Download', 'sn8.jpg', 'Starry Night Pro Plus 2020 is an interactive application through which users can observe stars, planets, galaxy, comets, moon, or entire sky. Users can analyze and determine the sky. It like a map of the sky in the userâ€™s hand. It doesnâ€™t require any geeky knowledge to operate the application, basic operation and users can extract detailed information related to desired star or masses. It has real-life images for better and high-quality observation. You can also download Aquaforest PDFToolKit.', 'http://51.77.53.163/Getintopc.com/Starry_Night_Pro_Plus_v8.0.6.zip?md5=-7-hENwVonHKbIpbqxCSvg&expires=1582987309', 'Utilities'),
(7, 'MusicLab â€“ RealLPC VST Free Download', 'mslab.jpg', 'MusicLab â€“ RealLPC VST is an impressive Les Paul Custom, a cult guitar from American company Gibson which is played by  lots of musicians all around the globe. RealPLC application is an addition to  RealStrat covering both the reference guitar sounds. You can also download MusicLab RealGuitar.', 'http://54.36.174.171/Getintopc.com/MusicLab.RealLPC.v5.0.0.7457.zip?md5=msJt4N-axXBZAOKPqPOuVA&expires=1583054183', 'Music');

-- --------------------------------------------------------

--
-- Table structure for table `favs`
--

CREATE TABLE `favs` (
  `f_id` bigint(20) UNSIGNED NOT NULL,
  `f_u_id` bigint(20) UNSIGNED NOT NULL,
  `f_a_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favs`
--

INSERT INTO `favs` (`f_id`, `f_u_id`, `f_a_id`) VALUES
(2, 4, 5),
(7, 2, 4),
(9, 2, 5),
(10, 2, 6),
(18, 1, 2),
(19, 2, 1),
(22, 1, 7),
(23, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `password`, `usertype`, `name`, `surname`, `email`) VALUES
(1, 'admin', '1a1dc91c907325c69271ddf0c944bc72', 'admin', 'admin', 'Admin', 'admin@gmail.com'),
(2, 'mario', 'aeb34368c5d53aee32431b5386f71c56', 'user', 'Super', 'Mario', 'mario@gmail.com'),
(3, 'grida', 'baea37f0541e71c07ee573c58d32ca16', 'user', 'Grida', 'Duma', 'grida@gmail.com'),
(4, 'noizy', '662f8c9542ae3c217994aef792a3b453', 'user', 'Rigels', 'Rajku', 'noizy@gmail.com'),
(5, 'aldi', 'e292b1d68c8b480c49074ff1b6e266b8', 'user', 'Aldi', 'AL', 'al@gmail.com'),
(6, 'zemrababit', 'b623a7cebe5be1abc1409e528f6b4451', 'user', 'Ardi', 'Daullxhiu', 'ardi123@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `a_id` (`a_id`);

--
-- Indexes for table `favs`
--
ALTER TABLE `favs`
  ADD PRIMARY KEY (`f_id`),
  ADD UNIQUE KEY `f_id` (`f_id`),
  ADD KEY `f_u_id` (`f_u_id`),
  ADD KEY `f_a_id` (`f_a_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `a_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favs`
--
ALTER TABLE `favs`
  MODIFY `f_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favs`
--
ALTER TABLE `favs`
  ADD CONSTRAINT `favs_ibfk_1` FOREIGN KEY (`f_u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `favs_ibfk_2` FOREIGN KEY (`f_a_id`) REFERENCES `apps` (`a_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
