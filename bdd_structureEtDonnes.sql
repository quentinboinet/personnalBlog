-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 10 avr. 2019 à 09:08
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
  `authorId` int(11) NOT NULL,
  `content` text NOT NULL,
  `creationDate` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_comment_fk` (`authorId`),
  KEY `post_comment_fk` (`postId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `postId`, `authorId`, `content`, `creationDate`, `status`) VALUES
(1, 6, 1, 'Très bel article, bravo !\r\n:)', 1554384940, 1),
(2, 6, 1, 'Je m\'attendais à mieux de votre part.\r\nVraiment déçu c\'est dommage.', 1554384999, 1),
(3, 6, 6, 'Hello\r\nTest d\'ajout d\'un commentaire', 1554739565, 0),
(4, 5, 6, 'Commentaire les lacs de Savoie.\r\nOK', 1554814006, 0),
(5, 6, 6, 'Bonjour, commentaire en validation.', 1554814527, 1);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `chapo` text NOT NULL,
  `content` tinytext NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `creationDate` int(11) NOT NULL,
  `lastModifiedDate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_post_fk` (`authorId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `authorId`, `title`, `chapo`, `content`, `picture`, `creationDate`, `lastModifiedDate`) VALUES
(1, 1, 'Test d\'article', 'Bonjour, résumé de cet article, blah blah', 'Contenu\r\nOK', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Belv%C3%A9d%C3%A8re_Lac_du_Bourget%2C_Grande_Molli%C3%A8re_%28%C3%A9t%C3%A9_2016%29.JPG/1200px-Belv%C3%A9d%C3%A8re_Lac_du_Bourget%2C_Grande_Molli%C3%A8re_%28%C3%A9t%C3%A9_2016%29.JPG', 1554220588, 1554220588),
(2, 1, 'article n°2', 'Résumé de l\'article 2', 'Ca marche !', 'https://db-service.toubiz.de/var/plain_site/storage/images/orte/zermatt/matterhorn/davidson-07-001/1370955-1-ger-DE/Davidson-07-001_front_large.jpg', 1554220784, 1554220784),
(3, 1, 'Test d\'article 3', 'Bonjour, résumé de cet article, blah blah', 'Contenu\r\nOK', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Belv%C3%A9d%C3%A8re_Lac_du_Bourget%2C_Grande_Molli%C3%A8re_%28%C3%A9t%C3%A9_2016%29.JPG/1200px-Belv%C3%A9d%C3%A8re_Lac_du_Bourget%2C_Grande_Molli%C3%A8re_%28%C3%A9t%C3%A9_2016%29.JPG', 1554298265, 1554298265),
(4, 1, 'Mon super article !', 'Chapo de l\'article 4', 'Essai', 'https://www.savoie-mont-blanc.com/var/smb/storage/images/media/images/visites-et-decouvertes/nature/panorama-sur-le-lac-d-aiguebelette-1/13205-9-fre-FR/Panorama-sur-le-lac-d-Aiguebelette-1_default_format.jpg', 1554298285, 1554298285),
(5, 1, 'Les lacs de Savoie', 'Article sur les lacs de Savoie', 'Le lac d\'Annecy, etc..', 'https://www.onetwotrips.com/wp-content/uploads/2017/07/annecy-Zimmerman76-848x400.jpg', 1554298399, 1554298399),
(6, 1, 'article n°2', 'Résumé de l\'article 2', 'Ca marche !', 'https://db-service.toubiz.de/var/plain_site/storage/images/orte/zermatt/matterhorn/davidson-07-001/1370955-1-ger-DE/Davidson-07-001_front_large.jpg', 1554298449, 1554298489);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `lastName`, `firstName`, `type`) VALUES
(6, 'quentin@activup.net', '$2y$10$FOCIwt/UeTl5CNfCCvT33O25BoxW5RKyOiECbrqlO/9urXMOwcfJ.', 'Boinet', 'Quentin', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
