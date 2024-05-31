-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 11:42 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `przepisy`
--
CREATE DATABASE IF NOT EXISTS `przepisy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `przepisy`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `log_events`
--

CREATE TABLE `log_events` (
  `id` int(11) NOT NULL,
  `czas` datetime DEFAULT NULL,
  `typ_zdarzenia` varchar(255) DEFAULT NULL,
  `wiadomosc` text DEFAULT NULL,
  `tytul_przepisu` varchar(255) DEFAULT NULL,
  `uzytkownik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_events`
--

INSERT INTO `log_events` (`id`, `czas`, `typ_zdarzenia`, `wiadomosc`, `tytul_przepisu`, `uzytkownik`) VALUES
(1, '2024-01-18 22:15:59', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(2, '2024-01-18 22:18:33', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(3, '2024-01-18 22:20:20', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(4, '2024-01-18 22:20:31', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(5, '2024-01-18 22:27:58', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(6, '2024-01-18 22:28:41', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(7, '2024-01-18 22:30:01', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(8, '2024-01-18 22:30:54', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(9, '2024-01-18 22:37:06', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(10, '2024-01-18 22:50:18', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(11, '2024-01-19 12:20:11', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(12, '2024-01-19 12:20:15', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(13, '2024-01-19 12:20:17', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(14, '2024-01-19 12:20:22', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(15, '2024-01-19 12:20:59', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(16, '2024-01-19 12:21:35', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(17, '2024-01-19 12:21:46', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(18, '2024-01-19 12:22:31', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(19, '2024-01-19 12:23:19', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(20, '2024-01-19 12:23:22', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(21, '2024-01-20 14:46:07', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(22, '2024-01-20 14:46:12', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(23, '2024-01-20 14:52:22', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(24, '2024-01-20 17:07:11', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(25, '2024-01-20 17:09:05', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(26, '2024-01-20 17:09:20', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(27, '2024-01-20 17:10:54', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(28, '2024-01-20 18:06:55', 'Success', 'Użytkownik \'ma\' zalogował się.', '', 'ma'),
(29, '2024-01-20 18:09:16', 'Success', 'Użytkownik \'ma\' został wylogowany.', '', 'ma'),
(30, '2024-01-20 18:09:40', 'Success', 'Użytkownik \'ma\' zalogował się.', '', 'ma'),
(31, '2024-01-20 18:13:28', 'Success', 'Użytkownik \'ma\' został wylogowany.', '', 'ma'),
(32, '2024-01-20 18:13:35', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(33, '2024-01-20 18:29:16', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(34, '2024-01-28 18:43:38', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(35, '2024-02-05 17:38:45', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(36, '2024-02-05 17:38:48', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(37, '2024-02-05 17:40:37', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(38, '2024-02-05 17:40:42', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(39, '2024-02-05 17:40:47', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(40, '2024-02-05 17:40:50', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(41, '2024-02-05 17:42:19', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(42, '2024-02-05 17:42:22', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(43, '2024-02-05 18:12:17', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(44, '2024-02-05 18:12:41', 'Success', 'Użytkownik \'nowy\' zalogował się.', '', 'nowy'),
(45, '2024-02-05 18:17:36', 'Success', 'Użytkownik \'nowy\' został wylogowany.', '', 'nowy'),
(46, '2024-02-05 18:17:39', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(47, '2024-02-08 16:08:17', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(48, '2024-02-08 16:08:19', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(49, '2024-02-08 16:08:22', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(50, '2024-02-08 16:08:24', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(51, '2024-02-08 16:08:35', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(52, '2024-02-08 16:10:33', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(53, '2024-02-08 16:14:03', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(54, '2024-02-08 16:14:13', 'Success', 'Użytkownik \'ab\' został wylogowany.', '', 'ab'),
(55, '2024-02-08 16:14:19', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(56, '2024-02-08 16:14:27', 'Success', 'Użytkownik \'ab\' został wylogowany.', '', 'ab'),
(57, '2024-02-08 16:14:33', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(58, '2024-02-08 16:18:00', 'Success', 'Użytkownik \'ab\' został wylogowany.', '', 'ab'),
(59, '2024-02-08 16:18:03', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(60, '2024-02-08 16:18:06', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(61, '2024-02-08 16:19:01', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(62, '2024-02-08 16:19:42', 'Success', 'Użytkownik \'ab\' został wylogowany.', '', 'ab'),
(63, '2024-02-08 16:22:24', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(64, '2024-02-08 16:23:02', 'Success', 'Użytkownik \'ab\' został wylogowany.', '', 'ab'),
(65, '2024-02-08 16:23:13', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(66, '2024-02-08 16:23:20', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(67, '2024-02-08 16:23:26', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(68, '2024-02-08 16:23:47', 'Success', 'Użytkownik \'ab\' zalogował się.', '', 'ab'),
(69, '2024-02-08 16:25:04', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(70, '2024-02-08 16:25:09', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(71, '2024-02-08 16:25:28', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(72, '2024-02-08 16:25:28', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(73, '2024-02-08 16:25:35', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(74, '2024-02-08 16:26:36', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(75, '2024-02-08 16:26:40', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(76, '2024-02-08 16:27:15', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(77, '2024-02-08 16:27:45', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(78, '2024-02-08 16:27:52', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(79, '2024-02-08 16:30:28', 'Success', 'Użytkownik \'ac\' zalogował się.', '', 'ac'),
(80, '2024-02-08 16:30:31', 'Success', 'Użytkownik \'ac\' został wylogowany.', '', 'ac'),
(81, '2024-02-08 16:30:49', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(82, '2024-02-08 16:30:56', 'Success', 'Użytkownik \'ac\' zalogował się.', '', 'ac'),
(83, '2024-02-08 16:31:10', 'Success', 'Użytkownik \'ac\' zalogował się.', '', 'ac'),
(84, '2024-02-08 16:31:42', 'Success', 'Użytkownik \'ac\' został wylogowany.', '', 'ac'),
(85, '2024-02-08 16:31:50', 'Success', 'Użytkownik \'ac\' zalogował się.', '', 'ac'),
(86, '2024-02-08 16:34:56', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(87, '2024-02-08 16:36:00', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(88, '2024-02-08 16:36:09', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(89, '2024-02-08 16:38:27', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(90, '2024-02-08 16:38:58', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(91, '2024-02-08 16:39:05', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(92, '2024-02-08 16:39:11', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(93, '2024-02-08 16:42:52', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(94, '2024-02-08 16:42:53', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(95, '2024-02-08 16:43:01', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(96, '2024-02-08 16:43:08', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(97, '2024-02-08 16:44:53', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(98, '2024-02-08 16:45:18', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(99, '2024-02-08 16:45:26', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(100, '2024-02-08 16:55:21', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(101, '2024-02-08 17:14:35', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(102, '2024-02-08 17:15:23', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(103, '2024-02-08 17:15:37', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(104, '2024-02-08 17:16:54', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(105, '2024-02-08 17:16:55', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(106, '2024-02-08 17:17:03', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(107, '2024-02-08 17:18:05', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(108, '2024-02-08 17:20:00', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(109, '2024-02-08 17:20:45', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(110, '2024-02-08 17:21:41', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(111, '2024-02-08 17:21:59', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(112, '2024-02-08 17:22:15', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(113, '2024-02-08 17:49:19', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(114, '2024-02-08 17:49:25', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(115, '2024-02-08 17:49:28', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(116, '2024-02-08 17:49:48', 'Success', 'Użytkownik \'b\' zalogował się.', '', 'b'),
(117, '2024-02-08 17:49:59', 'Success', 'Użytkownik \'b\' został wylogowany.', '', 'b'),
(118, '2024-02-08 17:50:06', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(119, '2024-02-08 18:05:25', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(120, '2024-02-08 18:05:33', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(121, '2024-02-08 18:05:49', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(122, '2024-02-08 18:19:11', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(123, '2024-02-08 18:25:40', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(124, '2024-02-08 18:25:48', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(125, '2024-02-08 18:25:54', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(126, '2024-02-08 18:28:21', 'Success', 'Użytkownik \'frodo\' zalogował się.', '', 'frodo'),
(127, '2024-02-08 18:28:25', 'Success', 'Użytkownik \'frodo\' został wylogowany.', '', 'frodo'),
(128, '2024-02-08 18:31:13', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(129, '2024-02-08 18:35:28', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(130, '2024-02-08 18:37:48', 'Success', 'Użytkownik \'kra\' zalogował się.', '', 'kra'),
(131, '2024-02-08 18:42:30', 'Success', 'Użytkownik \'kra\' został wylogowany.', '', 'kra'),
(132, '2024-02-08 18:42:39', 'Success', 'Użytkownik \'ag\' zalogował się.', '', 'ag'),
(133, '2024-02-08 18:42:44', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(134, '2024-02-08 18:44:34', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(135, '2024-02-08 18:44:39', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(136, '2024-02-09 14:23:00', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(137, '2024-02-09 14:23:49', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(138, '2024-02-09 14:23:54', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(139, '2024-02-09 14:24:02', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(140, '2024-02-09 14:37:00', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(141, '2024-02-09 14:38:04', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(142, '2024-02-09 14:44:10', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(143, '2024-02-09 14:44:18', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(144, '2024-02-09 14:45:16', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(145, '2024-02-09 14:45:25', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(146, '2024-02-09 14:54:35', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(147, '2024-02-09 14:54:49', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(148, '2024-02-09 14:59:08', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(149, '2024-02-09 14:59:19', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(150, '2024-02-09 15:00:00', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(151, '2024-02-09 15:00:07', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(152, '2024-02-09 15:03:07', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(153, '2024-02-09 15:03:14', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(154, '2024-02-09 15:07:50', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(155, '2024-02-09 15:09:14', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(156, '2024-02-09 15:09:53', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(157, '2024-02-09 15:11:16', 'Success', 'Użytkownik \'c\' zalogował się.', '', 'c'),
(158, '2024-02-09 15:12:30', 'Success', 'Użytkownik \'c\' został wylogowany.', '', 'c'),
(159, '2024-02-09 15:12:38', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(160, '2024-02-09 15:15:39', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(161, '2024-02-09 15:15:45', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(162, '2024-02-09 15:15:51', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(163, '2024-02-09 15:19:23', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(164, '2024-02-14 16:41:25', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(165, '2024-02-14 16:43:28', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(166, '2024-02-14 16:59:49', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(167, '2024-02-14 16:59:52', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(168, '2024-02-14 16:59:57', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(169, '2024-02-14 17:39:42', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(170, '2024-02-14 17:39:51', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(171, '2024-02-14 17:39:58', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(172, '2024-02-15 10:42:26', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(173, '2024-02-15 18:31:42', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(174, '2024-02-16 11:47:53', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(175, '2024-02-16 16:13:26', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(176, '2024-02-16 16:18:29', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(177, '2024-02-16 16:18:43', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(178, '2024-02-16 16:19:08', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(179, '2024-02-26 10:20:38', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(180, '2024-02-26 10:37:15', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(181, '2024-02-26 10:37:47', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(182, '2024-02-26 10:42:47', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(183, '2024-02-26 10:42:56', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(184, '2024-02-26 10:47:39', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(185, '2024-02-26 10:48:53', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(186, '2024-02-26 10:52:41', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(187, '2024-02-26 10:52:50', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(188, '2024-02-26 11:47:53', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(189, '2024-02-26 11:59:12', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(190, '2024-02-26 12:07:32', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(191, '2024-02-26 13:01:24', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(192, '2024-02-26 13:02:32', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(193, '2024-02-26 14:23:41', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(194, '2024-02-26 14:23:48', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(195, '2024-02-26 14:23:55', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(196, '2024-02-26 14:24:04', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(197, '2024-02-26 14:24:41', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(198, '2024-02-26 14:28:00', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(199, '2024-02-26 14:28:02', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(200, '2024-02-26 14:28:46', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(201, '2024-02-26 14:28:54', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(202, '2024-02-26 14:29:05', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(203, '2024-02-26 14:30:22', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(204, '2024-02-26 14:31:58', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(205, '2024-02-26 14:32:17', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(206, '2024-02-26 14:32:20', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(207, '2024-02-26 14:35:20', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(208, '2024-02-26 14:35:26', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(209, '2024-02-26 14:48:37', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(210, '2024-02-26 14:48:40', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(211, '2024-02-26 14:48:46', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(212, '2024-02-26 14:48:49', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(213, '2024-02-26 14:55:32', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(214, '2024-02-26 14:55:41', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(215, '2024-02-26 15:01:48', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(216, '2024-02-26 15:01:54', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(217, '2024-02-26 15:02:01', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(218, '2024-02-26 15:02:37', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(219, '2024-02-26 15:04:35', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(220, '2024-02-26 15:04:38', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(221, '2024-02-26 15:05:57', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(222, '2024-02-26 15:06:00', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(223, '2024-02-26 15:08:35', 'Success', 'Użytkownik \'battlefield0909@gmail.com\' zalogował się.', '', 'battlefield0909@gmail.com'),
(224, '2024-02-26 15:08:42', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(225, '2024-02-26 15:09:26', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(226, '2024-02-26 15:12:13', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(227, '2024-02-26 15:12:24', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(228, '2024-02-26 15:13:28', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(229, '2024-02-26 15:14:40', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(230, '2024-02-26 15:19:20', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(231, '2024-02-26 15:19:23', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(232, '2024-02-26 15:23:59', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(233, '2024-02-26 15:28:49', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(234, '2024-02-26 15:29:46', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(235, '2024-02-26 15:30:45', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(236, '2024-02-26 16:27:10', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(237, '2024-02-26 16:30:18', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(238, '2024-02-26 16:53:00', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(239, '2024-02-26 17:53:27', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(240, '2024-02-26 17:53:48', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(241, '2024-02-26 18:32:18', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(242, '2024-02-26 18:32:55', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(243, '2024-02-26 18:32:59', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(244, '2024-02-26 18:33:07', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(245, '2024-02-26 18:33:09', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(246, '2024-02-26 18:42:24', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(247, '2024-02-26 19:05:22', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(248, '2024-02-26 19:07:52', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(249, '2024-02-26 19:44:35', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(250, '2024-02-26 20:00:39', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(251, '2024-02-26 20:03:11', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(252, '2024-02-26 20:20:53', 'Success', 'Użytkownik \'a\' zalogował się.', '', 'a'),
(253, '2024-02-26 20:30:52', 'Success', 'Użytkownik \'a\' został wylogowany.', '', 'a'),
(254, '2024-02-26 20:46:51', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(255, '2024-02-26 21:11:07', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(256, '2024-02-26 21:12:26', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(257, '2024-02-26 21:15:17', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(258, '2024-02-26 21:22:33', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(259, '2024-02-26 21:23:40', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(260, '2024-02-26 21:24:14', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(261, '2024-02-26 21:27:28', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(262, '2024-02-26 21:41:48', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(263, '2024-02-27 09:42:59', 'Success', 'Użytkownik \'battlefield0909@gmail.com\' zalogował się.', '', 'battlefield0909@gmail.com'),
(264, '2024-02-27 09:45:27', 'Success', 'Użytkownik \'battlefield0909@gmail.com\' został wylogowany.', '', 'battlefield0909@gmail.com'),
(265, '2024-02-27 09:46:21', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(266, '2024-02-27 09:48:47', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(267, '2024-02-27 09:49:29', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(268, '2024-02-27 10:33:50', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(269, '2024-02-27 10:33:59', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(270, '2024-02-27 10:34:04', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(271, '2024-02-27 10:35:46', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(272, '2024-02-27 10:35:55', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(273, '2024-02-27 10:41:15', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(274, '2024-02-27 10:41:46', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(275, '2024-02-27 10:46:59', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(276, '2024-02-27 10:47:29', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(277, '2024-02-27 10:49:00', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(278, '2024-02-27 10:52:38', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(279, '2024-02-27 10:56:24', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(280, '2024-02-27 10:56:43', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(281, '2024-02-27 10:57:10', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(282, '2024-02-27 11:01:14', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(283, '2024-02-27 11:01:49', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(284, '2024-02-27 11:05:06', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(285, '2024-02-27 11:05:40', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(286, '2024-02-27 11:09:15', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(287, '2024-02-27 11:09:38', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(288, '2024-02-27 11:15:15', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(289, '2024-02-27 11:15:52', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej'),
(290, '2024-02-27 11:20:03', 'Success', 'Użytkownik \'Maciej\' został wylogowany.', '', 'Maciej'),
(291, '2024-02-27 11:20:42', 'Success', 'Użytkownik \'Maciej\' zalogował się.', '', 'Maciej');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przepisy_dodane`
--

CREATE TABLE `przepisy_dodane` (
  `id` int(11) NOT NULL,
  `tytul` varchar(32) NOT NULL,
  `opis` varchar(1024) NOT NULL,
  `przepis_uzytkownika` varchar(64) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ulubione_przepisy` int(11) DEFAULT 0,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `haslo` varchar(500) NOT NULL,
  `email` varchar(64) NOT NULL,
  `reset_pin` varchar(16) DEFAULT NULL,
  `reset_pin_expiration` datetime DEFAULT NULL,
  `kod_aktywacyjny` varchar(255) DEFAULT NULL,
  `aktywowane` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`, `reset_pin`, `reset_pin_expiration`, `kod_aktywacyjny`, `aktywowane`) VALUES
(17, 'a', '$2y$10$f13NyaINuMC5r98V6ZFLdOQv4RKgXNeEbh014drHJYSDSKU9SMmWu', 'a@a.a', NULL, NULL, NULL, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `log_events`
--
ALTER TABLE `log_events`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `przepisy_dodane`
--
ALTER TABLE `przepisy_dodane`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_events`
--
ALTER TABLE `log_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `przepisy_dodane`
--
ALTER TABLE `przepisy_dodane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
