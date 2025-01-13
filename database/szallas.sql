-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Dec 05. 18:58
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Importálásnál nézzük hogy van-e allatorokbefogado adatbázis, ha nincs akkor hozzuk létre
CREATE DATABASE IF NOT EXISTS `szallas`;
USE `szallas`;

--
-- Adatbázis: `szallas`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalas`
--

CREATE TABLE `foglalas` (
  `id` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `fizetendo` int(11) NOT NULL,
  `datum` datetime NOT NULL DEFAULT current_timestamp(),
  `vendeg_id` int(11) NOT NULL,
  `szoba_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `foglalas`
--

INSERT INTO `foglalas` (`id`, `checkin`, `checkout`, `fizetendo`, `datum`, `vendeg_id`, `szoba_id`) VALUES
(6, '2024-12-02', '2024-12-08', 476000, '2024-11-24 14:08:59', 7, 5),
(7, '2024-11-27', '2024-11-28', 134000, '2024-11-24 16:52:09', 20, 1),
(8, '2024-12-22', '2024-12-28', 756000, '2024-11-24 16:57:30', 20, 3),
(9, '2024-11-24', '2024-11-24', 89000, '2024-11-24 17:03:46', 20, 6),
(10, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:05:06', 3, 4),
(11, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:08:03', 23, 4),
(12, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:08:14', 3, 4),
(13, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:08:56', 3, 4),
(14, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:10:03', 3, 4),
(15, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:12:27', 3, 4),
(16, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:12:36', 22, 4),
(17, '2024-11-24', '2024-11-24', 32000, '2024-11-24 17:13:02', 22, 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `foglalas_szolgaltatas`
--

CREATE TABLE `foglalas_szolgaltatas` (
  `szolgaltatas_id` int(11) NOT NULL,
  `foglalas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `foglalas_szolgaltatas`
--

INSERT INTO `foglalas_szolgaltatas` (`szolgaltatas_id`, `foglalas_id`) VALUES
(1, 6),
(1, 8),
(2, 8),
(4, 6),
(5, 6),
(5, 7),
(5, 8);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szoba`
--

CREATE TABLE `szoba` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `felnottek` int(10) DEFAULT NULL,
  `gyerekek` int(10) DEFAULT NULL,
  `ar` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `szoba`
--

INSERT INTO `szoba` (`id`, `nev`, `felnottek`, `gyerekek`, `ar`) VALUES
(1, 'Klasszikus szoba', 4, 2, '62000'),
(2, 'Prémium szoba', 5, 2, '127000'),
(3, 'Családi szoba', 6, 4, '83000'),
(4, 'Egyágyas szoba', 1, 0, '32000'),
(5, 'Kétágyas szoba', 2, 2, '45000'),
(6, 'Üzleti szoba', 4, 0, '89000');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szolgaltatas`
--

CREATE TABLE `szolgaltatas` (
  `id` int(11) NOT NULL,
  `nev` varchar(100) NOT NULL,
  `ar` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `szolgaltatas`
--

INSERT INTO `szolgaltatas` (`id`, `nev`, `ar`) VALUES
(1, 'Wellness', '15000'),
(2, 'Csomagmegőrző', '2000'),
(3, 'Konferenciaterem', '1000'),
(4, 'Zárt parkoló', '3000'),
(5, 'Sportklub', '5000');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vendeg`
--

CREATE TABLE `vendeg` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `vendeg`
--

INSERT INTO `vendeg` (`id`, `full_name`, `email`, `password`) VALUES
(3, '', '', ''),
(7, '', '', ''),
(8, '', '', ''),
(10, '', '', ''),
(19, '', '', ''),
(20, '', '', ''),
(21, 'test', 'test@gmail.com', '$2y$10$9ZO4Vu.izsEol/9PdWTVI.qDe0nKcYDKs0vAvd.BuW34EsU9yjhqO'),
(22, 'Teszt', 'vendeg@vendeg.hu', '$2y$10$HLbnTOxDmP5roiDpUdxhu.mZqiRuGAXd6isUyYzkIXdKu1yIfLx5y'),
(23, 'ferimó', 'feri@feri.hu', '$2y$10$vLhWbn5mwZdVOzkWfpghLuPDyAfN.iozbOWzJ/IGESWEC45b7Ypse');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `foglalas`
--
ALTER TABLE `foglalas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `szoba_id` (`szoba_id`),
  ADD KEY `vendeg_id` (`vendeg_id`);

--
-- A tábla indexei `foglalas_szolgaltatas`
--
ALTER TABLE `foglalas_szolgaltatas`
  ADD PRIMARY KEY (`szolgaltatas_id`,`foglalas_id`),
  ADD KEY `szolgaltatas_id` (`szolgaltatas_id`,`foglalas_id`),
  ADD KEY `foglalas_id` (`foglalas_id`);

--
-- A tábla indexei `szoba`
--
ALTER TABLE `szoba`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `szolgaltatas`
--
ALTER TABLE `szolgaltatas`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `vendeg`
--
ALTER TABLE `vendeg`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `foglalas`
--
ALTER TABLE `foglalas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `szoba`
--
ALTER TABLE `szoba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `szolgaltatas`
--
ALTER TABLE `szolgaltatas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `vendeg`
--
ALTER TABLE `vendeg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `foglalas`
--
ALTER TABLE `foglalas`
  ADD CONSTRAINT `foglalas_ibfk_1` FOREIGN KEY (`vendeg_id`) REFERENCES `vendeg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foglalas_ibfk_2` FOREIGN KEY (`szoba_id`) REFERENCES `szoba` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `foglalas_szolgaltatas`
--
ALTER TABLE `foglalas_szolgaltatas`
  ADD CONSTRAINT `foglalas_szolgaltatas_ibfk_1` FOREIGN KEY (`foglalas_id`) REFERENCES `foglalas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foglalas_szolgaltatas_ibfk_2` FOREIGN KEY (`szolgaltatas_id`) REFERENCES `szolgaltatas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
