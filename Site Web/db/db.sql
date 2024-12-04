-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 14 mai 2023 à 16:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `coquill'coin`
--
CREATE DATABASE IF NOT EXISTS `coquill'coin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `coquill'coin`;

-- --------------------------------------------------------

--
-- Structure de la table `coquillage`
--

CREATE TABLE `coquillage` (
  `NUM_ANNONCE` int(11) NOT NULL,
  `PHOTO` varchar(100) NOT NULL,
  `PHOTO2` varchar(100) NOT NULL,
  `PHOTO3` varchar(50) NOT NULL,
  `TITRE` varchar(100) NOT NULL,
  `PRIX` int(11) NOT NULL,
  `LOCALISATION` varchar(200) NOT NULL,
  `ESPACE_HABITABLE` int(11) NOT NULL,
  `NB_PIECE` int(11) NOT NULL,
  `NB_ETAGE` int(11) NOT NULL,
  `COULEUR1` varchar(20) NOT NULL,
  `COULEUR2` varchar(20) NOT NULL,
  `COULEUR3` varchar(20) NOT NULL,
  `TACHE` tinyint(1) NOT NULL,
  `RAYURE` tinyint(1) NOT NULL,
  `DESCRIPTION` varchar(500) NOT NULL,
  `DATE_MISE_EN_LIGNE` varchar(20) NOT NULL,
  `IDENTIFIANT_UTILISATEUR` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `coquillage`
--

INSERT INTO `coquillage` (`NUM_ANNONCE`, `PHOTO`, `PHOTO2`, `PHOTO3`, `TITRE`, `PRIX`, `LOCALISATION`, `ESPACE_HABITABLE`, `NB_PIECE`, `NB_ETAGE`, `COULEUR1`, `COULEUR2`, `COULEUR3`, `TACHE`, `RAYURE`, `DESCRIPTION`, `DATE_MISE_EN_LIGNE`, `IDENTIFIANT_UTILISATEUR`) VALUES
(1, 'coquillage1.jpg', '', '', 'Beau coquillage, idéal pour un couple. 30 cm2', 50, 'Océan Atlantique Nord', 30, 3, 0, 'Blanc', 'Crème', '', 0, 1, 'Beau coquillage, idéal pour un couple. 30 cm2\r\nBonne surface carré, placement agréable au fond de l\'océan atlantique.\r\nCoquillage meublée avec déco chaleureuse et agréable.\r\nN\'hésitez pas à contacter', '2023-01-20', 'LaPalette'),
(2, 'coquillage2.jpg', '', '', 'Superbe coquillage de luxe. Véranda et piscine intégrées.', 620, 'Manche', 50, 7, 7, 'Blanc', 'Crème', '', 0, 0, 'Coquillage de luxe, grand espace, contient tout le confort dont vous aurez besoin.\r\nPossibilité de faire de longues nages avec ces 2 piscines intégrées (un bassin d\'eau douce et un d\'eau de mer)', '2023-05-04 16:39:56', 'SpirituelleDeMer08'),
(3, 'coquillage3.png', '', '', 'Coquille propre cherche locataire', 65, 'Océan Atlantique Nord', 28, 2, 0, 'Orange', '', '', 0, 0, 'Coquillage avec 2 pièces.\r\nDécoration vintage.\r\nContactez moi si intéressé', '2023-02-16 16:23:01', '12huit'),
(4, 'coquillage4.png', '', '', 'Superbe 7 pièces pour colocation dans la bonne humeur', 170, 'Mer des Caraïbes', 65, 7, 6, 'Blanc', 'Marron', '', 1, 0, 'Bonjour,\r\n\r\nVoici le coquillage que je propose. Il contient 6 étages et possède 7 chambres. Les baux de location sont individuel.\r\n\r\nN\'hésitez pas à me contacter pour plus de détails.', '2023-02-21 15:02:32', 'Mouleur03'),
(5, 'coquillage5.jpg', '', '', 'Coquille aux couleurs de l’océan -spirale parfaite et structure nacrée.', 500, 'Mer Méditerranée', 24, 4, 3, 'Blanc', 'Turquoise', '', 0, 1, 'Superbe coquillage aux couleurs de l\'océan.\r\nBien inestimable exceptionnellement mis en vente suite à des contraintes familiales.\r\nLe prix est à titre indicatif est peut être renégocier en fonction de la popularité de l\'annonce. Pas en dessous de 450 perle de nacre quand même', '2022-03-01 12:32:01', 'ExpertCoquillage69'),
(6, 'coquillage6.jpg', '', '', 'Cherche acheteur pour cette coquille de près de 30cm2', 90, 'Golfe de Gascogne', 28, 5, 4, 'Blanc', 'Marron', 'Orange', 1, 1, 'Coquillage contenant tout le nécessaire à vivre.\r\nContient une petite kitchenette et un nécessaire à drap.\r\nTrès bon appartement pour étudiant ou jeune diplomé.\r\nN\'hésitez pas à me contacter', '2013-02-12 15:26:25', 'Mouleur03'),
(7, 'coquillage7.jpg', '', '', 'Superbe coquillage designé par un célèbre architecte de Pompéi', 50000, 'Océan Indien', 120, 7, 5, 'Blanc', '', '', 0, 0, 'Coquille incroyable sculptée dans du marbre à fleur de falaise. Ces formes généreuses vont vous éblouir et sa blancheur immaculée permet un excellent stockage de la chaleur.', '2022-02-12 12:23:01', 'L’eaurizon'),
(8, 'coquillage8.jpg', '', '', 'Villa de 15 pièces en plein coeur de l’océan Indien', 30000, 'Océan Indien', 75, 15, 15, 'Blanc', 'Marron', '', 0, 1, 'Villa au cœur de l\'océan indien dans un quartier peuplé et dynamique. Proximité avec les grands courants marins avec vue sur le lagon des sirènes', '2023-04-07 02:25:36', 'L’eaurizon'),
(9, 'coquillage9.jpg', 'coquillage9_b.jpg', '', 'Coquille disponible - je suis joignable au téléphone', 10, 'Bassin d’Arcachon', 11, 1, 0, 'Blanc', 'Marron', '', 1, 1, 'Je loue une coquille pour étudiant en centre-ville.', '2023-04-07 03:25:21', 'herm38'),
(10, 'coquillage10.jpg', '', '', 'Belle coquille contenant 2 pièces, parfait pour personne seule ou couple', 340, 'Mer Méditerranée', 26, 2, 0, 'Blanc', 'Marron', 'Oange', 1, 0, 'Beau coquillage situé dans un quartier tranquille de mer Méditerrannée. \r\nParfait pou une personne seul ou un couple cherchant stabilité et tranquillité.', '2023-01-05 00:36:23', 'ExpertCoquillage69');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `ID` int(11) NOT NULL,
  `NUM_UTILISATEUR` int(11) NOT NULL,
  `NUM_COQUILLAGE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`ID`, `NUM_UTILISATEUR`, `NUM_COQUILLAGE`) VALUES
(11, 0, 9),
(12, 0, 10);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID` int(11) NOT NULL,
  `IDENTIFIANT_UTILISATEUR` varchar(30) NOT NULL,
  `MDP` varchar(20) NOT NULL,
  `NOM` varchar(30) NOT NULL,
  `PRENOM` varchar(30) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `NUM_TEL` int(10) NOT NULL,
  `PLAGE` varchar(60) NOT NULL,
  `LATITUDE` int(11) NOT NULL,
  `LONGITUDE` int(11) NOT NULL,
  `DESCRIPTION` varchar(500) NOT NULL,
  `ANCIENNETE` varchar(30) NOT NULL,
  `EXIGENCES` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID`, `IDENTIFIANT_UTILISATEUR`, `MDP`, `NOM`, `PRENOM`, `EMAIL`, `NUM_TEL`, `PLAGE`, `LATITUDE`, `LONGITUDE`, `DESCRIPTION`, `ANCIENNETE`, `EXIGENCES`) VALUES
(1, 'herm38', 'herm38', 'Hermite', 'Bernard', 'bernardherm@hotmail.com', 423652536, 'Ile aux Oiseaux', 45, -1, 'Je suis à la recherche de la bonne coquille. Celle qui me fera voyager au quotidien et qui me fera rêver.', '2002', ''),
(2, '12huit', 'Douzaine12@Huitre', 'Douzaine', 'Huitre', 'douzehuitre@gmail.com', 423632145, 'Playa Isla Verde', 18, -66, 'Bonjour,\r\n\r\nNous sommes à la recherche d\'un coquillage à partager pour une collocation de 12.', '2014-02-23 16:12:00', 'Grand logement'),
(3, 'SpirituelleDeMer08', 'spartfsd', 'Spirule', 'Iné', 'spiruline@gmail.com', 653241256, 'Plage Dragey-Rothon', 48, -2, 'Je suis à la recherche de surprises et d\'aventure spirituelle. J\'espère pouvoir partager mon savoir pour réussir à communier et à communiquer avec vous autres.', '2021-02-05', 'Avoir un esprit atypique'),
(4, 'ExpertCoquillage69', 'ExpertCoquillage69', 'Escargot', 'Toto', 'totargot@gmail.com', 785654525, 'Baie de Ramla', 36, 48, 'Bonjour, \r\nJe suis un expert en coquille et je souhaite vous faire partager mon expertise en vous proposant des bons plans coquillage !\r\nA bientôt ;)', '2005-02-12 16:45:23', 'Etudiant(e) ou jeune diplômé(e) de préférence'),
(5, 'Mouleur03', 'Mouleur03', 'Docteur', 'moule', 'docteurmamoule@gmail.com', 752310447, 'Plage de Malendure', 16, -61, 'Bonjour,\r\n\r\nVends coquillage.\r\nAPPEL DIRECT VENDEUR', '2015-06-03 12:02:23', 'Tout profil accepté'),
(6, 'L’eaurizon', 'L’eaurizon', 'Damme', 'Claude', 'claudevandamme@gmail.com', 856321402, 'Plage de l’Hermitage', -21, 55, 'Bonjour cher connaisseur, connaisseuse,\r\n\r\nFort de mon expertise dans le milieu coquillé depuis mon plus jeune âge, je collectionne des coquillages précieux et exotiques.\r\n\r\nJe mets certains de mes biens les plus précieux en vente suite à un changement de mer, j’espère trouver une personne sérieuse et intéressé qui sera en prendre soin à son tour,\r\n\r\nEn vous priant d’agréer, Madame, Monsieur, l’expression de mes salutations distinguées\r\n', '2021-02-03 18:25:03', 'Personne ayant une certaine maturité'),
(7, 'LaPalette', 'LaPalette', 'Lacolle', 'Patelle', 'collatelle@ensc.fr', 652321201, 'Cambridge Beaches', 32, -64, 'Bonjour,\r\n\r\nJe vends plusieurs types de coquillages, soyez libre de m’appeler ou de laisser un message si une annonce vous intéresse.', '2016-01-12 15:17:03', 'RAS'),
(9, 'cr', 'ce', '', '', 'crochet@gmail.com', 0, '', 0, 0, '', '2023-05-14 16:02:11', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `coquillage`
--
ALTER TABLE `coquillage`
  ADD PRIMARY KEY (`NUM_ANNONCE`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `coquillage`
--
ALTER TABLE `coquillage`
  MODIFY `NUM_ANNONCE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
