-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 20 avr. 2020 à 17:22
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db`
--
CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db`;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `photoNo` int(11) NOT NULL,
  `idUsers` text NOT NULL,
  `uidUsers` text NOT NULL,
  `photo` text NOT NULL,
  `dates` datetime DEFAULT current_timestamp(),
  `comment` text DEFAULT NULL,
  `like` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`photoNo`, `idUsers`, `uidUsers`, `photo`, `dates`, `comment`, `like`) VALUES
(21, '1', 'aurele', 'images/aurele/20200314093624.png', '2020-04-05 14:51:04', 'salut bg', NULL),
(48, '2', 'aurele123', 'images/aurele123/20200406053121.png', '2020-04-08 17:04:56', 'caca', NULL),
(49, '2', 'aurele123', 'images/aurele123/20200406053121.png', '2020-04-08 17:08:34', 'proute', NULL),
(50, '5', 'cacaboudin', 'images/aurele123/20200406053121.png', '2020-04-08 17:20:28', 'suce', NULL),
(51, '5', 'cacaboudin', 'images/cacaboudin/20200408052455.png', '2020-04-08 17:25:01', 'yes', NULL),
(52, '1', 'aurele', 'images/cacaboudin/20200408052455.png', '2020-04-09 17:07:40', 'caca', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` text NOT NULL,
  `photo` text NOT NULL,
  `liked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`idUsers`, `uidUsers`, `photo`, `liked`) VALUES
(1, 'aurele', 'images/aurele/20200405030014.png', 1),
(1, 'aurele', 'images/aurele/20200312102836.png', 1),
(1, 'aurele', 'images/aurele/20200314093624.png', 1),
(1, 'aurele', 'images/aurele/20200312045021.png', 1),
(2, 'aurele123', 'images/aurele/20200405030014.png', 1),
(2, 'aurele123', 'images/aurele/20200314093624.png', 1),
(2, 'aurele123', 'images/aurele/20200312102836.png', 0),
(2, 'aurele123', 'images/aurele/20200312045021.png', 1),
(2, 'aurele123', 'images/aurele/20200311074924.png', 1),
(2, 'aurele123', 'images/aurele123/20200406033148.png', 0),
(1, 'aurele', 'images/aurele123/20200406053121.png', 1),
(1, 'aurele', 'images/aurele/20200415072753.png', 0),
(1, 'aurele', 'images/aurele/20200415072632.png', 0),
(1, 'aurele111', 'images/aurele/20200415072753.png', 0),
(1, 'aurele111', 'images/aurele111/20200417034354.png', 0),
(1, 'aurele111', 'images/aurele/20200415072632.png', 0),
(1, 'aurele111', 'images/aurele/20200415061625.png', 1),
(1, 'aurele111', 'images/aurele/20200412035112.png', 1),
(2, 'aurele123', 'images/aurele111/20200420040710.png', 1),
(1, 'aurele111', 'images/aurele111/20200420040710.png', 1),
(1, 'aurele111', 'images/aurele/20200311074924.png', 1),
(1, 'aurele111', 'images/aurele/20200312045021.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `userphotos`
--

CREATE TABLE `userphotos` (
  `photoid` int(11) NOT NULL,
  `idUsers` text NOT NULL,
  `uidUsers` text NOT NULL,
  `photo` text NOT NULL,
  `dates` datetime DEFAULT NULL,
  `liked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `userphotos`
--

INSERT INTO `userphotos` (`photoid`, `idUsers`, `uidUsers`, `photo`, `dates`, `liked`) VALUES
(14, '1', 'aurele', 'images/aurele/20200311074924.png', '2020-03-11 07:49:24', 2),
(15, '1', 'aurele', 'images/aurele/20200312045021.png', '2020-03-12 04:50:21', 3),
(16, '1', 'aurele', 'images/aurele/20200312102836.png', '2020-03-12 10:28:36', 1),
(18, '1', 'aurele', 'images/aurele/20200314093624.png', '2020-03-14 09:36:24', 2),
(21, '2', 'aurele123', 'images/aurele123/20200406033148.png', '2020-04-06 03:31:48', 0),
(22, '2', 'aurele123', 'images/aurele123/20200406053058.png', '2020-04-06 05:30:58', 0),
(23, '2', 'aurele123', 'images/aurele123/20200406053121.png', '2020-04-06 05:31:21', 1),
(25, '5', 'cacaboudin', 'images/cacaboudin/20200408052455.png', '2020-04-08 05:24:55', 0),
(26, '1', 'aurele', 'images/aurele/20200412035112.png', '2020-04-12 03:51:12', 1),
(32, '1', 'aurele', 'images/aurele/20200415013616.png', '2020-04-15 01:36:16', 0),
(33, '1', 'aurele', 'images/aurele/20200415025331.png', '2020-04-15 02:53:31', 0),
(34, '1', 'aurele', 'images/aurele/20200415025804.png', '2020-04-15 02:58:04', 0),
(35, '1', 'aurele', 'images/aurele/20200415061625.png', '2020-04-15 06:16:25', 1),
(40, '1', 'aurele', 'images/aurele/20200415072632.png', '2020-04-15 07:26:32', 0),
(41, '1', 'aurele', 'images/aurele/20200415072753.png', '2020-04-15 07:27:53', 0),
(42, '1', 'aurele111', 'images/aurele111/20200417034354.png', '2020-04-17 03:43:54', 0),
(43, '1', 'aurele111', 'images/aurele111/20200420024123.png', '2020-04-20 02:41:23', 0),
(44, '1', 'aurele111', 'images/aurele111/20200420030740.png', '2020-04-20 03:07:40', 0),
(45, '1', 'aurele111', 'images/aurele111/20200420032119.png', '2020-04-20 03:21:19', 0),
(46, '1', 'aurele111', 'images/aurele111/20200420040710.png', '2020-04-20 04:07:10', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `uidUsers` tinytext NOT NULL,
  `emailUsers` tinytext NOT NULL,
  `pwdUsers` longtext NOT NULL,
  `token` longtext NOT NULL,
  `getMail` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUsers`, `uidUsers`, `emailUsers`, `pwdUsers`, `token`, `getMail`) VALUES
(1, 'aurele111', 'aurele.guitard@gmail.com', '$2y$10$Vq1ymB.pZD2y9gqntExN6uSvRDAjpu2GI46Uqkz8x4HCwwZYxkfjy', '0', 1),
(2, 'aurele123', 'aureledud@hotmail.fr', '$2y$10$viT8c.rpNRkEQsACz4taVuDvUPg9zkIv/w7PwnAls.3sG4d4lhTIi', '0', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`photoNo`);

--
-- Index pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Index pour la table `userphotos`
--
ALTER TABLE `userphotos`
  ADD PRIMARY KEY (`photoid`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `photoNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `userphotos`
--
ALTER TABLE `userphotos`
  MODIFY `photoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
