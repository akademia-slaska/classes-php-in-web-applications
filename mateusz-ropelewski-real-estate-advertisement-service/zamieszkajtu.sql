-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 19, 2025 at 09:17 AM
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
-- Database: `zamieszkajtu`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `id` int(11) NOT NULL,
  `tytul` varchar(100) DEFAULT NULL,
  `typ` enum('Mieszkanie','Dom','Działka') DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `adres` varchar(255) DEFAULT NULL,
  `miasto` varchar(100) DEFAULT NULL,
  `cena` decimal(10,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ogloszenia`
--

INSERT INTO `ogloszenia` (`id`, `tytul`, `typ`, `opis`, `adres`, `miasto`, `cena`, `user_id`) VALUES
(11, 'Dom jednorodzinny! TANIO!!!', 'Dom', 'fdsfdsfds', 'ul. Jana 50', 'Kołobrzeg', 432527.00, 3),
(12, 'Działka na Sprzedaż', 'Działka', 'dnsofndowfndocnwdoicndiwo', 'ul. Ćwiartki 3', 'Wrocław', 175000.00, 3),
(13, 'Mieszkanie 45m2 Katowice', 'Mieszkanie', 'dsiadbaodanboindsnd', 'Rolna 43/4', 'Katowice', 450000.00, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `imie` varchar(50) DEFAULT NULL,
  `nazwisko` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefon` varchar(15) DEFAULT NULL,
  `haslo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `imie`, `nazwisko`, `email`, `telefon`, `haslo`) VALUES
(1, 'Mateusz', 'Iks', 'aaauuuu123@gamil.com', '555555555', '$2y$10$AnfQd9FiwvPttqM6kuKJL.7Z5mhTzJsnFpCAgAFJIWbYRhpRy20SS'),
(3, 'mat', 'tam', 'mattam@gmail.com', '511111111', '$2y$10$oAXin8SLGbOfKHab7PpKHuMLc0YAn0dDSHwrgsmDqb3xneVrDVroi');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia`
--

CREATE TABLE `zdjecia` (
  `id` int(11) NOT NULL,
  `ogloszenie_id` int(11) DEFAULT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdjecia`
--

INSERT INTO `zdjecia` (`id`, `ogloszenie_id`, `url`) VALUES
(9, 11, 'uploads/674e1349c1fb5.jpg'),
(10, 11, 'uploads/674e1349c302e.jpg'),
(11, 12, 'uploads/678cb07aef8ef.jpg'),
(12, 13, 'uploads/678cb0f2c1687.jpg'),
(13, 13, 'uploads/678cb0f2c4924.jpg'),
(14, 13, 'uploads/678cb0f2c6c68.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeksy dla tabeli `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ogloszenie_id` (`ogloszenie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zdjecia`
--
ALTER TABLE `zdjecia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD CONSTRAINT `ogloszenia_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD CONSTRAINT `zdjecia_ibfk_1` FOREIGN KEY (`ogloszenie_id`) REFERENCES `ogloszenia` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
