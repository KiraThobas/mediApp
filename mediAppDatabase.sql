-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 24. čen 2017, 23:20
-- Verze serveru: 5.7.17
-- Verze PHP: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `ktumovacz3`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `name`) VALUES
(1, 'astma'),
(2, 'skolioza'),
(3, 'zlomená noha');

-- --------------------------------------------------------

--
-- Struktura tabulky `patient`
--

CREATE TABLE `patient` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `address` text COLLATE utf8_czech_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `patient`
--

INSERT INTO `patient` (`id`, `name`, `surname`, `address`, `phone`, `birthdate`) VALUES
(48, 'Martin', 'Štika', 'Dlouhá 4,\r\nPraha 102 00', '+42045735663', '1967-04-06'),
(47, 'Josef', 'Barabela', 'Pod kopcem 3/23,\r\nPraha 102 00', '+420748596037', '2017-04-06'),
(49, 'Petr', 'Černý', 'Průběžná 6/9,\r\nPraha 100 00', '+420589475114', '1984-12-06'),
(50, 'Milena', 'Malá', 'Evropská 90,\r\nPraha 106 00', '+420597259632', '1970-01-01'),
(53, 'Karolína', 'Světlá', 'Potočná 19,\r\nPraha 100 02', '+420689489541', '1970-01-01');

-- --------------------------------------------------------

--
-- Struktura tabulky `patient_diagnosis`
--

CREATE TABLE `patient_diagnosis` (
  `patient_id` int(10) UNSIGNED DEFAULT NULL,
  `diagnosis_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `patient_diagnosis`
--

INSERT INTO `patient_diagnosis` (`patient_id`, `diagnosis_id`) VALUES
(49, 3),
(48, 3),
(49, 2),
(47, 3),
(50, 2),
(47, 2),
(53, 1);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `patient_diagnosis`
--
ALTER TABLE `patient_diagnosis`
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `diagnosis_id` (`diagnosis_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
