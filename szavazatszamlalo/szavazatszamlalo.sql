-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Nov 26. 23:23
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szavazatszamlalo`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `ID` int(11) NOT NULL,
  `felhasznalonev` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` char(60) NOT NULL,
  `utolsobelepes` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='síma felhasználó adatai';

--
-- A tábla adatainak kiíratása `felhasznalo`
--

INSERT INTO `felhasznalo` (`ID`, `felhasznalonev`, `email`, `jelszo`, `utolsobelepes`) VALUES
(22, 'sandor', 'sandorlovag15@gmail.com', '$2y$10$S2531j4x9tpZ6VS24bdV4eddQ/stssp7Un0Fw.9lQ4IwXIi1Rbvi6', '2023-11-23 16:58:05'),
(23, 'matyasakiraly', 'matyaskiraly00@gmail.lov', '$2y$10$PV7kneTl38c7db3Vx9l9qe9Jkls8CGZdQT7hGLXS5KX3W0zLLFpr6', '2023-11-26 19:34:37'),
(24, 'vorosjanos', 'voros_janos98@gmail.lon', '$2y$10$Jt.XKxPv/sXej/4uPCWIeeD0GIovyTXKTT.6vmjaZKGzRs.dguNna', '2023-11-25 13:35:35'),
(25, 'nagyvaradibence', 'valakivaradi@gmail.com', '$2y$10$vf/qTWBihbUOJD8QxivImOLkyxIZ.whBY3kKxPaDrKxhiuVtE8PkW', '2023-11-25 13:36:00'),
(26, 'csakasajt', 'veradibence12@freemail.hu', '$2y$10$J193eISa/7gyFRFST9YBOeXF2qFQyOD0vsNNT42v5sw05FlowezC6', '2023-11-25 13:36:24'),
(27, 'sóspeter', 'nagyososapeter@gmail.hu', '$2y$10$kfKnxbO552MVa1CaNasT2uk3j.FVjhkwXtsKAemXEmrNXV6WDdEde', '2023-11-25 13:36:59'),
(28, 'vanessszzzaaa', 'sokvanessza@freemail.hu', '$2y$10$XF/qppuYE8z5ZSQpw667w.edPW6gUB/jOIlAc5k/9kAigGSs0hDZu', '2023-11-25 15:42:52'),
(29, 'Haláljozsef', 'jozsefhali@gmail.com', '$2y$10$1wu1egMiK7Q98BGzBwuxQ.PilQCvsGohaTV.bUXV0fPlgqw0VkyqS', '2023-11-25 15:43:20'),
(30, 'vangnaki', 'szianaki@gamil.com', '$2y$10$HlkPUJG/gPpfrXfEtogAm.EZiOmQTQKG78PBYS6QKByTpePXRVg6m', '2023-11-25 15:44:27'),
(31, 'tamsnagyorma', 'tamas12n45@gmail.lon', '$2y$10$fj7kPBSwCgdGzYx8SZzovenHK/k6DSWjfFUtgOz3tMetE5tPwNmbm', '2023-11-25 15:45:01'),
(32, 'bencsolovag', 'bencsolavon@uradalom.lov', '$2y$10$kzaAEfcbBjXNIgfeHI0k/e0neSkONtGWbrsJsQpb/eGMyp0RZUYlm', '2023-11-25 15:45:37'),
(33, 'lovassaki', 'lovasaki@freemail.hu', '$2y$10$e6mHzCgZe2YHFJhdeRyCy.XNDOoEu8u7hx6125LNdV5wpY7QQz2O6', '2023-11-25 15:46:08'),
(34, 'belakis', 'belaKIS@gmail.com', '$2y$10$JkNlFk1sK3/gMKwmlBiUU.bkpW3QPbzbzONGYK7PAWHiByP0tCZJW', '2023-11-25 15:46:36'),
(35, 'vasapeter', 'vasasaspeter54@gmail.com', '$2y$10$Jz8SzqkoQgc5ystEQugkdO.ANn0svfkofJrklFSkPpCYh5MGzQUcy', '2023-11-26 14:32:35'),
(36, 'sandorné', 'nagysandorné23@freemail.lo', '$2y$10$NovdU1FWCAD6.EAU5n1o0enEcohWhzIY6B6kvLhGrvRX9FD04Dawm', '2023-11-26 14:33:09'),
(37, 'magyrhuszar', 'magyarhuszar@gmail.lov', '$2y$10$HkG5jst1BXS5.eANIruE7uZfpTwcp3KL4OsdrxL9BizRfg3gxmhvC', '2023-11-26 14:33:31'),
(38, 'boldogazasszo', 'boldoganaztazia45@freemail.ho', '$2y$10$iD8H1gJqSx0e.iYKAj2UouC01oqNYrq7hirW1xeMa5J1aLjO/RoTq', '2023-11-26 14:34:21'),
(39, 'istvanakovacs', 'istvan2342fg@uradalom.hu', '$2y$10$F6AojBd3jee/4YIbhDY4VugAB/BuNMaZZ9dpKtqA7YhXAcr2gjp0O', '2023-11-26 19:47:43'),
(40, 'keres', 'keresakeres@uradalom.hu', '$2y$10$5Xl0qx2J.6ctfWBYY.VyXOBDqqP/6Atqd1iIR4OI/jtwym4iODfbm', '2023-11-26 15:47:56'),
(41, 'valaki', 'valakideki@uradalom.hu', '$2y$10$hOx25eHF3GhNFWiDBMOhCeSzX/JJ2r2Nk.qKV1D9bxAsM22oTO6wi', '2023-11-26 15:48:21'),
(42, 'GépesPál', 'Pál2gépeS]uradalom.hu', '$2y$10$mvUGS/XbBSIrxkNIH9F9ceBaG3LDbZfZ2vUqevz5Cv22TBlOkhKcS', '2023-11-26 15:48:50'),
(43, 'tolvajmárk', 'márkakinemtolvaj@uradalom.hu', '$2y$10$NnfvwJRCxrV3xfQb9F4ikemRyWzXj6Ff5hb1apDI0Kk6BknRoRoGe', '2023-11-26 15:49:29'),
(44, 'csakaki', 'valaki2@gmail.com', '$2y$10$ixDbwj92m1dv8qWN5il46eZLyC2bYxmo0TgonSds16qF03HZpIqJ.', '2023-11-26 17:46:55'),
(45, 'csaki', '22', '$2y$10$cUbJlqi9LwNOctBgg2/Ibur7slaUBHmbtgoMiKNULWfFeajfGtscm', '2023-11-26 17:18:23');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `indul`
--

CREATE TABLE `indul` (
  `ID` int(11) NOT NULL,
  `j_ID` int(11) NOT NULL,
  `sz_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `indul`
--

INSERT INTO `indul` (`ID`, `j_ID`, `sz_ID`) VALUES
(6, 23, 7),
(9, 28, 16),
(10, 36, 16),
(11, 40, 16),
(12, 37, 16),
(13, 24, 17),
(14, 33, 17),
(15, 30, 17),
(16, 34, 7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jelolt`
--

CREATE TABLE `jelolt` (
  `f_ID` int(11) NOT NULL,
  `elso_nev` varchar(255) NOT NULL,
  `utolso_nev` varchar(255) NOT NULL,
  `szuletesi_datum` date DEFAULT NULL,
  `foglalkozas` varchar(255) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `jelolt`
--

INSERT INTO `jelolt` (`f_ID`, `elso_nev`, `utolso_nev`, `szuletesi_datum`, `foglalkozas`, `program`) VALUES
(23, 'Nagy', 'Matyas', '1992-02-23', ' hatalmas uralkodó', 'feketes sereggel védi az országot'),
(24, 'Voros', 'Janos', '2023-11-02', 'Hivatásos kútfúró', 'adat megyében fura becse PÉter nagyúr kútját'),
(26, 'Csaba', 'Motrár', '2022-12-06', 'Hivatásos naplopó', 'pihenés minden nap ,ezer nap'),
(28, 'Liliom', 'Vanessza', '1999-03-01', 'kertész', 'Magasfőde várának kertéjen gondozása'),
(30, 'Erős', 'Vascor', '1988-10-30', 'épító munkás', 'magasföde új házait építi'),
(33, 'Lovas', 'Berceg', '1972-02-22', 'lovag', 'havasfelföld védelme a punyákoktól'),
(34, 'Bella', 'Kiss', '1999-02-25', 'cseléd', 'Bortos Péter úr személyes cselédi munkája'),
(35, 'Vasas', 'Péter', '1976-06-26', 'bányász', 'a királyi arany érc bányában fő munka irányító felügyelése'),
(36, 'Nagy', 'Bözse', '1983-12-01', 'cseléd', 'Szente földre birtokának cselédi munkája'),
(37, 'Daliás', 'Huszar', '1982-04-11', 'huszar', 'huszarkénz szolgál Matyas királyunk seregében'),
(40, 'Varga', 'Árpád', '1975-06-06', 'kereskedő', 'hasznos anyagok eladása és vétele'),
(41, 'Valamosi', 'Sandor', '1967-04-10', 'földműves', 'magasfőde följeinek művelése');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szavaz`
--

CREATE TABLE `szavaz` (
  `ID` int(11) NOT NULL,
  `f_ID` int(11) NOT NULL,
  `j_ID` int(11) NOT NULL,
  `sz_ID` int(11) NOT NULL,
  `idopont` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `szavaz`
--

INSERT INTO `szavaz` (`ID`, `f_ID`, `j_ID`, `sz_ID`, `idopont`) VALUES
(1, 42, 24, 16, '2023-11-26 16:56:50'),
(2, 38, 36, 16, '2023-11-26 16:59:50'),
(3, 33, 40, 16, '2023-11-26 17:00:55'),
(5, 42, 36, 16, '2023-11-26 16:56:50'),
(6, 44, 36, 16, '2023-11-26 19:31:59'),
(7, 23, 23, 7, '2023-11-26 19:46:41'),
(12, 39, 30, 17, '2023-11-26 20:16:29'),
(13, 39, 33, 17, '2023-11-26 20:16:59');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szavazas`
--

CREATE TABLE `szavazas` (
  `ID` int(11) NOT NULL,
  `kiiro_ID` int(11) NOT NULL,
  `megnevezes` varchar(255) NOT NULL,
  `leiras` text NOT NULL,
  `kezdes_idopontja` timestamp NULL DEFAULT NULL,
  `zaras_idopontja` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `szavazas`
--

INSERT INTO `szavazas` (`ID`, `kiiro_ID`, `megnevezes`, `leiras`, `kezdes_idopontja`, `zaras_idopontja`) VALUES
(7, 23, 'ki az erősebb', 'az erő itt a lényeg', '2023-11-25 16:53:00', '2023-11-16 19:44:00'),
(10, 23, 'gazdagas', 'ki a leggazdagabb földesúr?', '2023-11-27 15:09:00', '2023-11-29 15:09:00'),
(12, 23, 'kinek a legzöldebb a fúje', 'nincs mit magyarázni', '2023-11-30 15:18:00', '2023-12-08 15:18:00'),
(13, 23, 'ki a legbecsültesebb?', 'nincs', '2023-11-26 15:31:00', '2023-11-30 15:28:00'),
(14, 23, 'a_váza_ügye', 'KI törte el PÉter dandár nagyúr vázáját?', '2023-11-27 15:29:00', '2023-12-08 15:29:00'),
(15, 23, 'Becsület kérdés', 'ki a legbecsületesebb?', '2023-11-27 15:32:00', '2023-12-09 15:32:00'),
(16, 39, 'Lopás', 'Ki lopja az eszközöket a kovács műhelyeból?', '2023-11-27 19:46:00', '2023-12-29 15:47:00'),
(17, 39, 'drága lányom', 'Ki lenne a lányom legjobb férje?', '2023-11-27 19:50:00', '2024-03-22 19:55:00'),
(18, 44, 'mi a legnagyobb', 'nincs', '2023-11-28 17:21:00', '2023-11-29 22:26:00'),
(19, 44, 'ki a legszebb', 'nincs mit ezen magyarázni', '2023-11-27 17:57:00', '2023-12-02 17:54:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNIQUE` (`felhasznalonev`);

--
-- A tábla indexei `indul`
--
ALTER TABLE `indul`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `j_ID` (`j_ID`),
  ADD KEY `sz_ID` (`sz_ID`) USING BTREE;

--
-- A tábla indexei `jelolt`
--
ALTER TABLE `jelolt`
  ADD PRIMARY KEY (`f_ID`);

--
-- A tábla indexei `szavaz`
--
ALTER TABLE `szavaz`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `f_ID` (`f_ID`),
  ADD KEY `j_ID` (`j_ID`),
  ADD KEY `sz_ID` (`sz_ID`);

--
-- A tábla indexei `szavazas`
--
ALTER TABLE `szavazas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `kiiro_ID` (`kiiro_ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT a táblához `indul`
--
ALTER TABLE `indul`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `szavaz`
--
ALTER TABLE `szavaz`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `szavazas`
--
ALTER TABLE `szavazas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `indul`
--
ALTER TABLE `indul`
  ADD CONSTRAINT `indul_ibfk_1` FOREIGN KEY (`sz_ID`) REFERENCES `szavazas` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `indul_ibfk_2` FOREIGN KEY (`j_ID`) REFERENCES `jelolt` (`f_ID`) ON DELETE CASCADE;

--
-- Megkötések a táblához `jelolt`
--
ALTER TABLE `jelolt`
  ADD CONSTRAINT `jelolt_ibfk_1` FOREIGN KEY (`f_ID`) REFERENCES `felhasznalo` (`ID`) ON DELETE CASCADE;

--
-- Megkötések a táblához `szavaz`
--
ALTER TABLE `szavaz`
  ADD CONSTRAINT `szavaz_ibfk_1` FOREIGN KEY (`f_ID`) REFERENCES `felhasznalo` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `szavaz_ibfk_2` FOREIGN KEY (`j_ID`) REFERENCES `jelolt` (`f_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `szavaz_ibfk_3` FOREIGN KEY (`sz_ID`) REFERENCES `szavazas` (`ID`) ON DELETE CASCADE;

--
-- Megkötések a táblához `szavazas`
--
ALTER TABLE `szavazas`
  ADD CONSTRAINT `szavazas_ibfk_1` FOREIGN KEY (`kiiro_ID`) REFERENCES `felhasznalo` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
