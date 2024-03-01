-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 01 mars 2024 à 18:28
-- Version du serveur :  10.3.39-MariaDB-0ubuntu0.20.04.2
-- Version de PHP : 7.3.33-14+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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

CREATE TABLE `achat` (
  `id_billet` int(20) NOT NULL,
  `horaire_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `date_d’achat` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `nb_places_achetees` int(10) NOT NULL,
  `id_adherent` int(20) NOT NULL,
  `id_seance` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `achat`
--

INSERT INTO `achat` (`id_billet`, `horaire_date`, `date_d’achat`, `nb_places_achetees`, `id_adherent`, `id_seance`) VALUES
(1, '2024-02-22 19:28:49.000000', '2024-02-21 19:28:49.000000', 2, 1, 1),
(2, '2024-03-07 19:17:41.000000', '2024-03-01 18:18:42.623468', 3, 2, 1),
(3, '2024-04-11 19:27:14.000000', '2024-03-07 19:27:14.000000', 1, 4, 5),
(4, '2024-03-07 19:27:14.000000', '2024-05-08 19:27:14.000000', 2, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `id` int(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `points` int(10) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `compte` varchar(20) NOT NULL,
  `id_ville` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id`, `nom`, `prenom`, `mail`, `password`, `points`, `date_creation`, `compte`, `id_ville`) VALUES
(1, 'moatasm', 'hajjo', 'hajjo.dev@gmail.com', '2015', 4, '2024-02-29 16:24:32', 'admin', 2),
(2, 'Le Reurti', 'Mickey', '187killa@jamel.com', 'mdptropdur', 30, '2024-03-01 18:12:55', 'adherent', 1),
(3, 'Jon', 'Johnny', 'jone.jones@jon.jo', 'JonJon', 50, '2024-03-01 18:15:20', 'adherent', 1),
(4, 'Kazama', 'Jin', 'jin.kazama@tekken.co', 'devil', 30000, '2024-03-01 18:15:20', 'adherent', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

CREATE TABLE `cinema` (
  `id` int(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_ville` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `cinema`
--

INSERT INTO `cinema` (`id`, `nom`, `id_ville`) VALUES
(1, 'city', 1),
(2, 'cineville', 2),
(3, 'garenne', 1);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `Id` int(20) NOT NULL,
  `titre` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duree` varchar(5) NOT NULL,
  `etat` enum('cinema','streaming') NOT NULL,
  `id_affiche` int(20) NOT NULL,
  `date_sortie` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_expiration` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `film`
--

INSERT INTO `film` (`Id`, `titre`, `description`, `duree`, `etat`, `id_affiche`, `date_sortie`, `date_expiration`) VALUES
(1, 'Fast and Furious ', 'action ', '1H50', 'cinema', 1, '2024-02-14 18:44:26', '2024-02-22 18:44:26'),
(2, 'John Wick', 'Un homme d\'une extrême concentration', '2H00', 'streaming', 2, '2024-03-01 17:57:41', '2025-01-01 13:14:09'),
(3, 'Pirates des Caraibes', 'Fantastique', '2H30', 'cinema', 3, '2024-03-01 17:57:48', '2025-03-01 18:52:39'),
(4, 'Casino', 'Mafia', '3H00', 'cinema', 4, '2024-03-01 18:02:08', '2025-03-01 18:52:39'),
(5, 'Public Enemies', 'Biopic', '2H20', 'cinema', 5, '2024-03-01 18:05:04', '2025-08-01 19:04:18');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(20) NOT NULL,
  `id_cinema` int(20) NOT NULL,
  `nb_place` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `id_cinema`, `nb_place`) VALUES
(1, 1, 2),
(2, 2, 50),
(3, 3, 40),
(4, 1, 30),
(5, 1, 40),
(6, 2, 50),
(7, 2, 60),
(8, 3, 40),
(9, 3, 30);

-- --------------------------------------------------------

--
-- Structure de la table `seance`
--

CREATE TABLE `seance` (
  `id` int(20) NOT NULL,
  `horaire_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_film` int(20) NOT NULL,
  `id_salle` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `seance`
--

INSERT INTO `seance` (`id`, `horaire_date`, `id_film`, `id_salle`) VALUES
(1, '2024-02-22 19:30:13', 1, 1),
(2, '2024-03-14 19:24:16', 2, 5),
(3, '2024-03-30 19:24:16', 5, 8),
(4, '2024-05-09 19:25:07', 3, 5),
(5, '2024-05-15 19:25:07', 3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `stream`
--

CREATE TABLE `stream` (
  `date_achat` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `date_expiration` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000',
  `id_film` int(20) NOT NULL,
  `id_adherent` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `stream`
--

INSERT INTO `stream` (`date_achat`, `date_expiration`, `id_film`, `id_adherent`) VALUES
('2024-02-15 16:26:14.000000', '2024-02-20 16:26:14.000000', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE `tarif` (
  `id_cinema` int(20) NOT NULL,
  `id_film` int(20) NOT NULL,
  `prix_semaine` float NOT NULL,
  `prix_weekend` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id_cinema`, `id_film`, `prix_semaine`, `prix_weekend`) VALUES
(1, 1, 10.3, 12.3);

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `id` int(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `region` enum('Bretagne-56','Normandie-28') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`id`, `nom`, `region`) VALUES
(1, 'vannes', 'Bretagne-56'),
(2, 'lorient', 'Bretagne-56');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `achat`
--
ALTER TABLE `achat`
  ADD PRIMARY KEY (`id_billet`),
  ADD KEY `fk_achat_seance` (`id_seance`),
  ADD KEY `fk_achat_adherent` (`id_adherent`) USING BTREE;

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adherent_ville` (`id_ville`);

--
-- Index pour la table `cinema`
--
ALTER TABLE `cinema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cinema_ville` (`id_ville`);

--
-- Index pour la table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_salle_cinema` (`id_cinema`);

--
-- Index pour la table `seance`
--
ALTER TABLE `seance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seance_film` (`id_film`),
  ADD KEY `fk_seance_salle` (`id_salle`);

--
-- Index pour la table `stream`
--
ALTER TABLE `stream`
  ADD KEY `fk_stream_film` (`id_film`),
  ADD KEY `fk_stream_adherent` (`id_adherent`);

--
-- Index pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD KEY `fk_tarif_cinema` (`id_cinema`),
  ADD KEY `fk_tarif_film` (`id_film`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `achat`
--
ALTER TABLE `achat`
  MODIFY `id_billet` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `achat_ibfk_1` FOREIGN KEY (`id_adherent`) REFERENCES `adherent` (`id`),
  ADD CONSTRAINT `achat_ibfk_2` FOREIGN KEY (`id_seance`) REFERENCES `seance` (`id`);

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
