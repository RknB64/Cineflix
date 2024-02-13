-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 11 fév. 2024 à 13:45
-- Version du serveur :  11.2.2-MariaDB
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_cineflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `id_billet` int(20) NOT NULL AUTO_INCREMENT,
  `horaire_date` timestamp(6) NOT NULL,
  `date_d’achat` timestamp(6) NOT NULL,
  `nb_places_achetees` int(10) NOT NULL,
  `id_adherent` int(20) NOT NULL,
  `id_seance` int(20) NOT NULL,
  PRIMARY KEY (`id_billet`),
  KEY `fk_achat_seance` (`id_seance`),
  KEY `fk_achat_adhernet` (`id_adherent`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `achat`
--

INSERT INTO `achat` (`id_billet`, `horaire_date`, `date_d’achat`, `nb_places_achetees`, `id_adherent`, `id_seance`) VALUES
(1, '2024-02-22 19:28:49.000000', '2024-02-21 19:28:49.000000', 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

DROP TABLE IF EXISTS `adherent`;
CREATE TABLE IF NOT EXISTS `adherent` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(10) NOT NULL,
  `date_creation` timestamp NOT NULL,
  `compte` varchar(20) NOT NULL,
  `id_ville` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_adherent_ville` (`id_ville`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id`, `nom`, `prenom`, `mail`, `password`, `points`, `date_creation`, `compte`, `id_ville`) VALUES
(1, 'moatasm', 'hajjo', 'hajjo.dev@gmail.com', '2015', 4, '2024-02-29 16:24:32', 'admin', 2);

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

DROP TABLE IF EXISTS `cinema`;
CREATE TABLE IF NOT EXISTS `cinema` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `id_ville` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cinema_ville` (`id_ville`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `cinema`
--

INSERT INTO `cinema` (`id`, `nom`, `id_ville`) VALUES
(1, 'city', 1);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `Id` int(20) NOT NULL AUTO_INCREMENT,
  `titre` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duree` varchar(5) NOT NULL,
  `etat` enum('cinema','streaming') NOT NULL,
  `id_affiche` int(20) NOT NULL,
  `date_sortie` timestamp NOT NULL,
  `date_expiration` timestamp NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`Id`, `titre`, `description`, `duree`, `etat`, `id_affiche`, `date_sortie`, `date_expiration`) VALUES
(1, 'Fast and Furious ', 'action ', '1H50', 'cinema', 1, '2024-02-14 18:44:26', '2024-02-22 18:44:26');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

DROP TABLE IF EXISTS `salle`;
CREATE TABLE IF NOT EXISTS `salle` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_cinema` int(20) NOT NULL,
  `nb_place` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_salle_cinema` (`id_cinema`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `id_cinema`, `nb_place`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

DROP TABLE IF EXISTS `seance`;
CREATE TABLE IF NOT EXISTS `seance` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `horaire_date` timestamp NOT NULL,
  `id_film` int(20) NOT NULL,
  `id_salle` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_seance_film` (`id_film`),
  KEY `fk_seance_salle` (`id_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id`, `horaire_date`, `id_film`, `id_salle`) VALUES
(1, '2024-02-22 19:30:13', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stream`
--

DROP TABLE IF EXISTS `stream`;
CREATE TABLE IF NOT EXISTS `stream` (
  `date_achat` timestamp(6) NOT NULL,
  `date_expiration` timestamp(6) NOT NULL,
  `id_film` int(20) NOT NULL,
  `id_adherent` int(20) NOT NULL,
  KEY `fk_stream_film` (`id_film`),
  KEY `fk_stream_adherent` (`id_adherent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `stream`
--

INSERT INTO `stream` (`date_achat`, `date_expiration`, `id_film`, `id_adherent`) VALUES
('2024-02-15 16:26:14.000000', '2024-02-20 16:26:14.000000', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
CREATE TABLE IF NOT EXISTS `tarif` (
  `id_cinema` int(20) NOT NULL,
  `id_film` int(20) NOT NULL,
  `prix_semaine` float NOT NULL,
  `prix_weekend` float NOT NULL,
  KEY `fk_tarif_cinema` (`id_cinema`),
  KEY `fk_tarif_film` (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id_cinema`, `id_film`, `prix_semaine`, `prix_weekend`) VALUES
(1, 1, 10.3, 12.3);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

DROP TABLE IF EXISTS `ville`;
CREATE TABLE IF NOT EXISTS `ville` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `region` enum('Bretagne-56','Normandie-28') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `nom`, `region`) VALUES
(1, 'vannes', 'Bretagne-56'),
(2, 'lorient', 'Bretagne-56');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `fk_adherent_ville` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cinema`
--
ALTER TABLE `cinema`
  ADD CONSTRAINT `fk_cinema_ville` FOREIGN KEY (`id_ville`) REFERENCES `ville` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `fk_salle_cinema` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `seance`
--
ALTER TABLE `seance`
  ADD CONSTRAINT `fk_seance_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seance_salle` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stream`
--
ALTER TABLE `stream`
  ADD CONSTRAINT `fk_stream_adherent` FOREIGN KEY (`id_adherent`) REFERENCES `adherent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stream_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`Id`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `fk_tarif_cinema` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tarif_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
