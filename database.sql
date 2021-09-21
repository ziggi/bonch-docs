-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 21, 2021 at 06:31 PM
-- Server version: 5.7.27-30
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vh26404_bonch`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(20) UNSIGNED NOT NULL,
  `Name` varchar(256) NOT NULL DEFAULT '',
  `Label` varchar(256) NOT NULL DEFAULT '',
  `ShortLabel` varchar(32) NOT NULL DEFAULT '',
  `Visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Label`, `ShortLabel`, `Visible`) VALUES
(1, 'angliyskiy', 'Английский язык', 'Английский', 1),
(2, 'imos', 'История мировой отечественной связи', 'ИМОС', 1),
(3, 'informatika', 'Информатика', 'Информатика', 1),
(4, 'it', 'Информационные технологии', 'ИТ', 1),
(5, 'istoriya', 'История', 'История', 1),
(6, 'kgg', 'Компьютерная графика и геометрия', 'КГГ', 1),
(7, 'kulturologiya', 'Культурология', 'Культурология', 1),
(8, 'matan', 'Математический анализ', 'Матан', 1),
(9, 'msvpid', 'Методы и средства визуального представления информации в дизайне', 'МСВПИД', 1),
(10, 'oaig', 'Основы алгебры и геометрии', 'ОАиГ', 1),
(11, 'odpi', 'Основы деловой прикладной информатики', 'ОДПИ', 1),
(12, 'saodiss', 'Структуры и алгоритмы обработки данных в информационных системах и сетях', 'САОДИСС', 1),
(13, 'sociologiya', 'Социология', 'Социология', 1),
(14, 'fizika', 'Физика', 'Физика', 1),
(15, 'fizra', 'Физическая культура', 'Физра', 1),
(16, 'himiya', 'Химия', 'Химия', 1),
(17, 'istd', 'Информационные системы и технологии в дизайне', 'ИСТД', 1),
(18, 'ais', 'Архитектура информационных систем', 'АИС', 1),
(19, 'tpr', 'Теория принятия решений', 'ТПР', 1),
(20, 'religiovedenie', 'Религиоведение', 'Религиоведение', 1),
(21, 'kr', 'Культура речи', 'КР', 1),
(22, 'dm', 'Дискретная математика', 'ДМ', 1),
(23, 'oty', 'Основы теории управления', 'ОТУ', 1),
(24, 'ee', 'Электротехника и электроника', 'ЭЭ', 1),
(25, 'iss', 'Информационные системы и сети', 'ИСС', 1),
(27, 'opgd', 'Основы проектной графики и дизайна', 'ОПГД', 1),
(28, 'os', 'Операционные системы', 'ОС', 1),
(29, 'tips', 'Теория информационных процессов и систем', 'ТИПС', 1),
(30, 'tmkm', 'Теория массовых коммуникаций и массмедиа', 'ТМКМ', 0),
(31, 'ekologiya', 'Экология', 'Экология', 1),
(32, 'tp', 'Технологии программирования', 'ТП', 1),
(33, 'id', 'Информационный дизайн', 'ИД', 1),
(34, 'tiid', 'Технология искусственного интеллекта в дизайне', 'ТИИД', 1),
(35, 'toi', 'Технологии обработки информации', 'ТОИ', 1),
(36, 'isis', 'Инструментальные средства информационных систем', 'ИСИС', 0),
(37, 'ud', 'Управление данными', 'УД', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `ID` int(20) UNSIGNED NOT NULL,
  `Hash` varchar(32) NOT NULL DEFAULT '',
  `FileName` varchar(128) NOT NULL DEFAULT '',
  `Downloads` int(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Id` int(20) UNSIGNED NOT NULL,
  `Type` varchar(128) NOT NULL DEFAULT '',
  `Name` varchar(128) NOT NULL DEFAULT '',
  `About` text NOT NULL,
  `Description` longtext NOT NULL,
  `CategoryID` int(20) NOT NULL DEFAULT '0',
  `CreationDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `EditionDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FileID` int(32) UNSIGNED NOT NULL DEFAULT '0',
  `PackFileHash` varchar(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `Title` varchar(128) NOT NULL DEFAULT '',
  `Text` longtext NOT NULL,
  `Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `ID` int(20) UNSIGNED NOT NULL,
  `Position` int(20) NOT NULL DEFAULT '0',
  `Name` varchar(64) NOT NULL,
  `Title` varchar(128) NOT NULL,
  `Text` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `Id` int(20) UNSIGNED NOT NULL,
  `Type` varchar(128) NOT NULL DEFAULT '',
  `Name` varchar(128) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`Id`, `Type`, `Name`) VALUES
(1, 'lection', 'Лекции'),
(2, 'lab', 'Лабораторные'),
(3, 'coursework', 'Курсовые работы'),
(4, 'other', 'Разное'),
(5, 'practice', 'Практика');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `Id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `Id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
