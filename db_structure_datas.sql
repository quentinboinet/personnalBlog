-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : quentinbae371.mysql.db
-- Généré le :  lun. 29 avr. 2019 à 16:56
-- Version du serveur :  5.6.42-log
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `quentinbae371`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `authorId` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `creationDate` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `postId`, `authorId`, `content`, `creationDate`, `status`) VALUES
(29, 19, 6, 'Pour y être allé, je recommande  ! Nous avons passé de merveilleuses vacances.', 1556547947, 1),
(30, 16, 6, 'Superbe lac !\r\nJe recommande particulièrement la plage proche de la sortie d\'autoroute.', 1556547987, 1),
(33, 19, 8, 'La visite de la vieille ville est tout autant sublime !', 1556548312, 1),
(34, 18, 8, 'Ma femme et moi y avons passé un week-end en juillet.\r\nLa couleur de l\'eau est paradisiaque !', 1556548360, 1);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `authorId` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `chapo` text NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `creationDate` int(11) NOT NULL,
  `lastModifiedDate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `authorId`, `title`, `chapo`, `content`, `picture`, `creationDate`, `lastModifiedDate`) VALUES
(16, 6, 'Le lac d\'aiguebelette', 'Principal lac de l\'Avant-Pays savoyard, dans l\'extrémité sud du massif du Jura, il est situé à environ 10 kilomètres de Chambéry et à environ 100 kilomètres de Lyon. Il possède une superficie de 545 hectares et est à ce titre le septième lac naturel français.', 'Bordé à l\'est par la chaîne de l\'Épine qui culmine avec le mont Grelle à 1 425 mètres et à l\'ouest par le mont Tournier, sa profondeur maximale est de 71 mètres. Au premier regard, il se caractérise par sa couleur souvent verte, alors que, dans la même région, le lac d\'Annecy est plus bleu et le lac du Bourget plus souvent gris acier.\r\n\r\nLe lac d\'Aiguebelette est un lac privé qui appartient à la famille de Rivérieulx de Chambost de Lépin et à Électricité de France, qui ont confié sa gestion à la Communauté de Communes du Lac d\'Aiguebelette. Ses rives se partagent quant à elles entre cinq communes riveraines que sont : Aiguebelette-le-Lac, Lépin-le-Lac, Saint-Alban-de-Montbel, Novalaise et Nances. Dans la partie sud du lac se trouvent deux îles, entourées de roselières.\r\n\r\nAfin de préserver la qualité de ses eaux et de son environnement, les bateaux à moteur sont interdits sur le lac depuis un arrêté de 1967. Il est en outre depuis mars 2015 la première réserve naturelle régionale d\'eau douce en France. ', 'https://www.alti-mag.com/wp-content/uploads/2017/12/IMG_6267-820x547.jpg', 1556545495, 1556546897),
(17, 6, 'Le lac Léman', 'Le Léman, appelé aussi par tautologie lac Léman mais aussi lac de Genève, est un lac d\'origine glaciaire situé en Suisse et en France ; par sa superficie, c\'est le plus grand lac alpin et subalpin d\'Europe centrale et d\'Europe de l\'Ouest. ', 'Son nom, probablement d\'origine celtique, nous est parvenu via le latin « Lacus Lemanus ».\r\n\r\nLe lac, d\'une longueur d\'environ 72,8 km et d\'une largeur maximale inférieure à 14 km, est en forme de croissant (ou d\'une virgule) orienté de l\'est vers l\'ouest. Le rivage nord et les deux extrémités sont suisses et sont partagé entre les cantons de Genève, de Vaud et du Valais, le rivage sud est français dépendant du département de la Haute-Savoie et de la région Auvergne-Rhône-Alpes. La frontière passe au milieu du lac.\r\n\r\nLe Léman est traversé d\'est en ouest par le Rhône, fleuve franco-suisse qui, avec 75 % des apports, constitue le principal affluent du lac. Sa formation a des origines multiples : plissement tectonique pour la partie du Grand-Lac et action du glacier du Rhône pour le Petit-Lac (entre Yvoire et Genève). Il s\'est constitué lors du retrait progressif du glacier du Rhône après la dernière période glaciaire, il y a près de 16 000 ans. Ses berges ont été fortement artificialisées.\r\n\r\nEn 2006, selon une étude de la CIPEL (commission franco-suisse chargée de surveiller l’évolution de la qualité des eaux du Léman, du Rhône et de leurs affluents), seulement 3 % de côtes sont encore sauvages. Hors 23 % de prés semi-naturels et de cultures, environ 60 % des berges et abords sont aménagés, enrochés, pavés, privatisés, ce qui limite probablement l\'expression de l\'écopotentialité du site. ', 'public/images/defaultCover.jpg', 1556545609, 1556546760),
(18, 6, 'Le lac du Bourget', 'Lac post-glaciaire du massif du Jura, le lac du Bourget a été formé à l\'issue de la dernière glaciation de Würm, il y a environ 19 000 ans, par le retrait du grand glacier alpin du quaternaire. C\'est le plus grand lac naturel d\'origine glaciaire entièrement situé en France, la plus grande partie du Léman étant située en Suisse. ', 'Son nom actuel, lié à la commune qui borde sa partie méridionale, n\'a été utilisé qu\'à compter du XIIIe siècle. Artistiquement, le lac est particulièrement lié à la présence du poète Alphonse de Lamartine qui y écrivit des poèmes, dont Le Lac dédié à la femme qu\'il aime, Julie Charles, lors de son séjour en octobre 1816.\r\n\r\nAu niveau touristique, le lac compte de nombreuses plages aménagées sur ses rives, des bases de loisirs, de nombreux sites touristiques, le plus célèbre étant l\'abbaye royale d\'Hautecombe où reposent de nombreux souverains de la Maison de Savoie. La ville riveraine la plus importante par sa population étant Aix-les-Bains, une des plus célèbres villes thermales françaises, comptant un peu moins de 30 000 habitants et qui accueille un festival pop-rock, Musilac, à proximité des rives du lac. ', 'https://www.aixlesbains.fr/var/aixinter/storage/images/media/images/vue-du-belvedere-de-la-chambotte/591695-1-fre-FR/Vue-du-belvedere-de-la-Chambotte_full.jpg', 1556545722, 1556546623),
(19, 6, 'Le lac d\'Annecy', 'Le lac d\'Annecy appartient au domaine public de l’État et la seule île qu\'il comprend, l\'île des Cygnes, est artificielle et se trouve en face d\'Annecy. Il existe une piste cyclable dénommée « la Voie Verte du lac d’Annecy », située en rive ouest du lac en site propre sur une distance de 33 km et gérée par le SILA. ', 'Le lac d\'Annecy est un lac de France situé dans les Alpes, en Haute-Savoie et en région Auvergne-Rhône-Alpes. Par sa superficie, il est le deuxième lac d\'origine glaciaire de France après celui du Bourget, très proche, et exception faite de la partie française du lac Léman.\r\n\r\nLe lac s’est formé, à la fin de la Glaciation de Würm, c\'est-à-dire durant une période située entre 17000 av. J.-C. et 15000 av. J.-C., correspondant à la fonte progressive des grands glaciers alpins. Il est alimenté par sept ruisseaux et torrents, nés dans les montagnes environnantes et une puissante source sous-lacustre.\r\n\r\nLe bassin est encadré au nord par l\'agglomération d’Annecy, à l’est par le massif des Bornes, à l’ouest par le massif des Bauges et au sud la dépression de Faverges qui prolonge le Bout-du-Lac.\r\n\r\nLe lac déverse son trop-plein d’eau dans le Thiou qui alimente le Fier au nord-ouest de la commune d\'Annecy, celui-ci se jetant ensuite directement dans le Rhône. Le lac est un site touristique très attractif, connu pour ses nombreuses activités nautiques, le parapente, et ses qualités environnementales permettant l\'observation d\'une nature préservée. ', 'https://www.allobroges.com/wp-content/uploads/2014/01/lac-annecy2.jpg', 1556545839, 1556547694),
(20, 6, 'Le lac du Mont-Cenis', 'Le lac du Mont-Cenis est un lac situé dans le massif du Mont-Cenis à 1 974 m d\'altitude sur la commune de Val-Cenis. ', 'Le lac du Mont-Cenis est situé sur le passage le plus fréquenté au Moyen Âge entre l\'Europe de l\'Ouest et la péninsule italienne, le col du Mont-Cenis, sur l\'axe Lyon-Turin-Milan, alors que le col du Montgenèvre nécessitait un premier franchissement, celui du col du Lautaret et que le col du Petit-Saint-Bernard était plus haut de 107 mètres. \r\n\r\nSi on attribue une contenance de 315 millions de mètres cubes à lac de barrage, il est la sixième plus grande retenue d\'eau artificielle française, située à près de 2 000 mètres d\'altitude1. Se trouvant entièrement sur le territoire français, le lac est situé sur le versant italien du col du Mont-Cenis. Rattachée à la vallée de la Maurienne tant d\'un point de vue historique, culturel et économique, la combe est administrée par la commune de Val-Cenis. Autour du lac se trouvent la Pointe de Ronce (3 612 m), la Pointe du Lamet (3 504 m), le Mont Giusalet (3 312 m), le Mont Malamot (2 917 m) et le Signal du Petit Mont-Cenis (3 162 m).\r\n\r\nDe par son emplacement, l\'émissaire naturel du lac est la Cenise (Cenischia en italien), qui elle-même se jette dans la Doire Ripaire, affluent du Pô. Le lac fait donc partie du bassin versant du Pô. ', 'https://www.savoie-mont-blanc.com/var/smb/storage/images/media/images/visites-et-decouvertes/nature/lac-du-mont-cenis-avec-le-fort-de-ronce/12471-7-fre-FR/Lac-du-Mont-Cenis-avec-le-fort-de-Ronce_format_1200x600.jpg', 1556547016, 1556547016);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `lastName`, `firstName`, `type`) VALUES
(6, 'quentin@activup.net', '$2y$10$FOCIwt/UeTl5CNfCCvT33O25BoxW5RKyOiECbrqlO/9urXMOwcfJ.', 'Boinet', 'Quentin', 1),
(8, 'quentinboinet@live.fr', '$2y$10$eqtf4yGf2pZy5PbLYN18w.ad7I7AmH2kd.FdMiCrlpZwH/JwX.ML.', 'Dupont', 'Jean', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comment_fk` (`postId`),
  ADD KEY `authorId` (`authorId`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorId` (`authorId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
