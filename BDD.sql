-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 mai 2025 à 15:31
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mission1`
--
CREATE DATABASE IF NOT EXISTS `mission1` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `mission1`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_salle`
--

CREATE TABLE `categorie_salle` (
  `id` int(11) NOT NULL,
  `libelle` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie_salle`
--

INSERT INTO `categorie_salle` (`id`, `libelle`) VALUES
(1, 'Réunion'),
(2, 'avec équipements'),
(3, 'Amphi');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_login` varchar(20) NOT NULL,
  `mdp` varchar(20) DEFAULT NULL,
  `utilisateur_id` int(11) DEFAULT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_login`, `mdp`, `utilisateur_id`, `statut`) VALUES
('cbandilella', 'pass123', 1, 4),
('gsilbert', 'password789', 3, 2),
('lpernot', 'strongpass', 5, 1),
('lsteph', '$2y$10$0RbAHxwOM4DM3', 6, 3),
('nlievin', 'oijoij', 7, 3),
('test', '$2y$10$wWqCWNf94/d3j', 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `salle_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `periode` int(11) NOT NULL,
  `statusReservation` enum('Provisoire','Confirmé','Annulé') NOT NULL DEFAULT 'Provisoire'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `utilisateur_id`, `salle_id`, `date`, `periode`, `statusReservation`) VALUES
(1, 2, 6, '2023-06-06', 1, 'Confirmé'),
(2, 6, 5, '2023-06-09', 2, 'Confirmé'),
(3, 6, 10, '2023-06-09', 3, 'Provisoire'),
(4, 7, 4, '2023-06-07', 2, 'Confirmé'),
(5, 2, 6, '2023-06-01', 1, 'Annulé'),
(6, 3, 6, '2023-06-05', 2, 'Provisoire'),
(7, 4, 6, '2023-06-10', 3, 'Provisoire'),
(8, 5, 1, '2023-06-15', 1, 'Annulé'),
(9, 6, 5, '2023-06-15', 2, 'Provisoire'),
(10, 7, 6, '2023-06-15', 3, 'Provisoire'),
(11, 1, 2, '2024-10-01', 1, 'Annulé'),
(12, 3, 4, '2024-09-28', 2, 'Annulé'),
(13, 5, 6, '2024-09-30', 3, 'Annulé'),
(14, 2, 1, '2024-10-15', 1, 'Confirmé'),
(15, 3, 3, '2024-10-18', 2, 'Provisoire'),
(16, 4, 5, '2024-10-19', 3, 'Provisoire'),
(17, 6, 7, '2024-10-20', 1, 'Provisoire'),
(18, 7, 6, '2024-10-21', 2, 'Provisoire'),
(19, 1, 10, '2024-10-22', 3, 'Provisoire'),
(20, 7, 4, '2024-10-25', 1, 'Provisoire'),
(23, 3, 10, '2024-11-14', 1, 'Confirmé'),
(24, 1, 10, '2024-11-14', 2, 'Annulé'),
(25, 1, 10, '2024-11-14', 2, 'Confirmé'),
(27, 1, 2, '2024-11-13', 1, 'Provisoire'),
(28, 3, 3, '2024-11-29', 1, 'Provisoire'),
(29, 3, 2, '2024-11-28', 1, 'Provisoire'),
(30, 1, 1, '2024-11-13', 0, 'Annulé'),
(31, 2, 5, '2024-11-06', 1, 'Confirmé'),
(33, 2, 1, '2024-11-27', 1, 'Provisoire'),
(34, 4, 2, '2024-12-31', 1, 'Confirmé'),
(35, 3, 2, '2024-12-05', 1, 'Provisoire'),
(36, 3, 2, '2024-12-05', 11, 'Provisoire'),
(37, 1, 1, '2024-12-10', 1, 'Provisoire'),
(38, 2, 5, '2024-12-09', 5, 'Provisoire'),
(39, 1, 2, '2024-12-09', 1, 'Provisoire'),
(41, 5, 1, '2024-12-10', 1, 'Provisoire'),
(42, 1, 1, '2024-12-18', 1, 'Provisoire'),
(45, 7, 4, '2025-02-20', 74, 'Confirmé'),
(46, 7, 1, '2024-12-11', 1, 'Provisoire'),
(47, 7, 5, '2024-12-29', 1, 'Annulé'),
(48, 3, 12, '2024-12-20', 11, 'Provisoire'),
(51, 7, 1, '2024-12-13', 1, 'Provisoire'),
(52, 7, 1, '2024-12-20', 9, 'Provisoire'),
(53, 3, 1, '2024-12-13', 9, 'Provisoire'),
(54, 7, 4, '2024-12-12', 1, 'Provisoire'),
(55, 7, 2, '2025-03-06', 6, 'Provisoire'),
(56, 3, 3, '2025-04-10', 1, 'Provisoire');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `salle_nom` varchar(32) NOT NULL,
  `categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `salle_nom`, `categorie`) VALUES
(1, 'Daum', 1),
(2, 'Corbin', 1),
(3, 'Baccarat', 1),
(4, 'Longwy', 1),
(5, 'Multimédia', 2),
(6, 'Amphithéâtre', 3),
(7, 'Lamour', 1),
(8, 'Grüber', 1),
(9, 'Majorelle', 1),
(10, 'Salle de restauration', 2),
(11, 'Galerie', 1),
(12, 'Salle informatique', 2),
(13, 'Hall de accueil', 2),
(14, 'Gallé', 1);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `TypeStatut` int(11) NOT NULL,
  `libelleStatut` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`TypeStatut`, `libelleStatut`) VALUES
(1, 'Administrateur'),
(2, 'Secretariat'),
(3, 'Responsable'),
(4, 'Utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

CREATE TABLE `structure` (
  `id` int(11) NOT NULL,
  `libelle` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `structure`
--

INSERT INTO `structure` (`id`, `libelle`) VALUES
(1, 'Ligue'),
(2, 'Club sportif'),
(3, 'Comité départemental'),
(4, 'Association'),
(5, 'Lycée'),
(6, 'Collège'),
(7, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `utilisateur_id` int(11) NOT NULL,
  `nom` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `structure_id` int(11) NOT NULL,
  `structure_nom` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `structure_adresse` varchar(80) COLLATE latin1_general_ci NOT NULL,
  `mail` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='utilisateurs ';

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `nom`, `prenom`, `structure_id`, `structure_nom`, `structure_adresse`, `mail`) VALUES
(1, 'BANDILELLA', 'CLEMENT', 1, 'Ligue Volley Ball Lorraine', '30, rue Widric 1er 54600 Villers lès Nancy', 'cbandilella@llgvolleyball.fr'),
(2, 'BIACQUEL', 'VERONIQUE', 1, 'Ligue escrime Lorraine', '5, rue des trois épis 54600 Villers lès Nancy', 'biancquel.veronique23@llgescrime.fr'),
(3, 'SILBERT', 'GILLES', 2, 'Sporting Club Ennery', '48 Rue Marcel Decker, 57365 Ennery', 'sportingclubennery589@gmail.com'),
(4, 'TORTEMANN', 'PIERRE', 4, 'Association Sportive Nancy Lorraine (ASNL)', '30, rue Widric 1er 54600 Villers lès Nancy', 'contactASNL@laposte.fr'),
(5, 'PERNOT', 'LEA', 5, 'Lyccée public Frederic Chopin', '39 rue du Sergent Blandan 54000 Nancy', 'lea.pernot@ac-lorraine.fr'),
(6, 'ZUEL', 'STEPHANIE', 7, 'Fivess nnNordon', '5 Pl. Aimé Morot 54000 Nancy', 'zuel.s@fivesnordon.ue'),
(7, 'LIEVIN', 'NATHAN', 3, 'FFT- COMITE DEPARTEMENTAL DE TENNIS DE MOSELLE ', '42, ruee de la commanderie 54840 Sexey les bois', 'lievinn@fft.fr');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie_salle`
--
ALTER TABLE `categorie_salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `fk_compte` (`utilisateur_id`),
  ADD KEY `statut` (`statut`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainteUtilisateurId` (`utilisateur_id`),
  ADD KEY `contrainteSalleId` (`salle_id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contrainteCategorieId` (`categorie`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`TypeStatut`);

--
-- Index pour la table `structure`
--
ALTER TABLE `structure`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`utilisateur_id`),
  ADD KEY `contrainteStructureId` (`structure_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie_salle`
--
ALTER TABLE `categorie_salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `statut`
--
ALTER TABLE `statut`
  MODIFY `TypeStatut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `structure`
--
ALTER TABLE `structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
