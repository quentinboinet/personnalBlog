-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 25 avr. 2019 à 07:30
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `personnalblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postId` int(11) NOT NULL,
  `authorId` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `creationDate` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_comment_fk` (`postId`),
  KEY `authorId` (`authorId`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `postId`, `authorId`, `content`, `creationDate`, `status`) VALUES
(12, 7, NULL, 'Test\r\nOK', 1554973922, 1),
(14, 7, 6, 'Test\r\nRetour', 1555320546, 1),
(15, 7, 6, 'Essai', 1555320568, 1),
(16, 10, 6, 'Test\r\nCommentaire', 1555321716, 1),
(17, 10, 6, 'Hello\r\nOK', 1555335535, 1),
(20, 7, NULL, 'Essai d\'ajout\r\nValidation OK ?', 1555340952, 1),
(21, 14, 6, 'Voila\r\nOK', 1556022661, 1),
(22, 14, 6, 'Un autre commentaire\r\nValidé !', 1556022676, 1),
(23, 14, NULL, 'Commentaire de l\'utilisateur\r\nTest', 1556023026, 1),
(25, 15, 6, 'Essai heure commentaire', 1556027610, 1),
(26, 15, 6, 'Test\r\nOK', 1556028801, 1),
(27, 10, NULL, 'Essai d\'ajout\r\nOK', 1556030758, 1);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorId` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `chapo` text NOT NULL,
  `content` tinytext NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `creationDate` int(11) NOT NULL,
  `lastModifiedDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `authorId` (`authorId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `authorId`, `title`, `chapo`, `content`, `picture`, `creationDate`, `lastModifiedDate`) VALUES
(7, NULL, 'Les lacs de Savoie 45', 'Chapo modifié', 'Le lac d\'Annecy, etc..\r\nOK', 'https://www.onetwotrips.com/wp-content/uploads/2017/07/annecy-Zimmerman76-848x400.jpg', 1554298399, 1555320675),
(10, 6, 'Les trails de Chambéry 1', 'Chapo trails', 'Test\r\nEssai\r\nAjout d\'un article\r\nOK\r\nVoila', 'http://4.bp.blogspot.com/-_BSF0Dkd0M4/TndPKPW0MqI/AAAAAAAACBg/vgViKSYYQA4/s1600/IMG_0922-1.jpg', 1555321668, 1555335632),
(15, 6, 'Test', 'Voila', 'Bravo', 'public/images/defaultCover.jpg', 1556026742, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `lastName`, `firstName`, `type`) VALUES
(6, 'quentin@activup.net', '$2y$10$FOCIwt/UeTl5CNfCCvT33O25BoxW5RKyOiECbrqlO/9urXMOwcfJ.', 'Boinet', 'Quentin', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
