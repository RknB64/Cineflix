-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mariadb:3306
-- Généré le : ven. 26 avr. 2024 à 08:06
-- Version du serveur : 10.4.33-MariaDB-1:10.4.33+maria~ubu2004
-- Version de PHP : 8.2.8

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
(1, '2024-02-22 19:28:49.000000', '2024-02-21 19:28:49.000000', 2, 1, 1);

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
  `estAdmin` int(11) DEFAULT NULL,
  `id_ville` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`id`, `nom`, `prenom`, `mail`, `password`, `points`, `date_creation`, `estAdmin`, `id_ville`) VALUES
(1, 'moatasm', 'hajjo', 'hajjo.dev@gmail.com', '2015', 4, '2024-04-15 09:45:36', 0, 2),
(2, 'jean', 'test$', 'test@mail.com', '123', 12, '2024-04-15 09:45:36', 0, 2),
(3, 'Bob', 'Marley', 'bo@mail.com', '$2y$10$hpODrIItalNtKBnQE13jHOnGdSsRof19QyWoUJjNRlvJK7t4UeVYm', 0, '2024-04-15 09:45:36', 0, 1),
(4, 'Bob', 'Marley', 'bo@mail.com', '$2y$10$zeGLx2AlWQZEyD9H8M6yPe4lSgo0GIc79UgAF1lT2t7t.eZfhDQMC', 0, '2024-04-15 09:45:36', 0, 1),
(5, 'test', 'test', 'nonasldfkj@mail.com', '$2y$10$FOxh8IWoHd6MW8L9xo4JDuO2/Eu6pmpEbFveQS3Xz5bmav2C6/zhK', 0, '2024-04-15 09:45:36', 0, 1),
(10, 'hello', 'there', 'th@mail.com', '$2y$10$Buq45mU4eZe6RnkZBdPUiuilnvneIJby/bN.NHuie3kov0s4EDFje', 0, '2024-04-15 11:28:13', 0, 1),
(11, '', 'test', '', '$2y$10$RrauDJ9RWJ6neSRmcFO8Nu7go1vqbGNmXGchqLP0sKVH79BE5boxG', 0, '2024-04-15 11:44:36', 0, 1),
(13, 'sandy', 'rivers', 'sn@mail', '$2y$10$h8LSTWio.SGAes4j/19Pb.HOCYm.7lh4WZUDQtpKmWH5YqHJ/qMvi', 0, '2024-04-18 11:44:05', 0, 19),
(14, 'bob', 'lorient', 'lo@mail.com', '$2y$10$NTmpQAt6YjYQBHg8RlkVFO7zcpiLryWqfDHPoaLA1rVAc9zZuzqSu', 0, '2024-04-22 08:02:39', 0, 1),
(15, 'merge', 'mergington', 'mm@mail', '$2y$10$76ElRQlCDqpbL3RhhrLc8..Ry0ChpQQ9U267BJGEbDoclKQM4aqy2', 0, '2024-04-23 09:40:14', 0, 88);

-- --------------------------------------------------------

--
-- Structure de la table `cinema`
--

CREATE TABLE `cinema` (
  `id` int(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `id_ville` int(20) NOT NULL,
  `id_affiche` int(11) NOT NULL,
  `adresse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `cinema`
--

INSERT INTO `cinema` (`id`, `nom`, `id_ville`, `id_affiche`, `adresse`) VALUES
(1, 'city', 1, 1, '2 rue des poussins'),
(2, 'Starlight Cinema', 1, 1, '123 Main Street'),
(3, 'Dreamland Theater', 2, 1, '456 Elm Avenue'),
(4, 'Silver Screen Multiplex', 3, 1, '789 Oak Boulevard'),
(5, 'CineMagic Palace', 4, 1, '101 Maple Lane'),
(6, 'Majestic Movie House', 6, 1, '234 Cedar Road'),
(7, 'Sunset Cinema', 7, 1, '567 Pine Street'),
(8, 'Royal Theater', 9, 1, '890 Birch Avenue'),
(9, 'Golden Globe Cinemas', 10, 1, '1234 Walnut Drive'),
(10, 'Cinema Paradiso', 11, 1, '5678 Cherry Lane'),
(11, 'Riviera Movie Theater', 12, 1, '9012 Sycamore Court'),
(12, 'Empire Cinemas', 13, 1, '3456 Willow Way'),
(13, 'Olympus Cineplex', 14, 1, '7890 Spruce Street'),
(14, 'Prestige Cinematheque', 15, 1, '123 Elm Street'),
(15, 'Galaxy Cinemas', 16, 1, '456 Oak Avenue'),
(16, 'Cineplex Deluxe', 17, 1, '789 Maple Road'),
(17, 'CineSphere', 18, 1, '1011 Pine Drive'),
(18, 'Vista Cinema', 19, 1, '1213 Cedar Street'),
(19, 'Orpheum Theater', 20, 1, '1415 Birch Avenue'),
(20, 'Arcade Movie House', 21, 1, '1617 Walnut Drive'),
(21, 'Odeon Cinemas', 22, 1, '1819 Cherry Lane'),
(22, 'Rex Theater', 80, 1, '2021 Sycamore Court'),
(23, 'Grand Cinematique', 81, 1, '2223 Willow Way'),
(24, 'Cinema Royale', 82, 1, '2425 Spruce Street'),
(25, 'Metroplex Cinemas', 83, 1, '2627 Elm Street'),
(26, 'CineArts', 84, 1, '2829 Oak Avenue'),
(27, 'Capitol Cinema', 85, 1, '3031 Maple Road'),
(28, 'CineMagic', 86, 1, '3233 Pine Drive'),
(29, 'CineDome', 87, 1, '3435 Cedar Street'),
(30, 'CineStar', 88, 1, '3637 Birch Avenue'),
(31, 'Cinema Nova', 89, 1, '3839 Walnut Drive'),
(32, 'Cinema Grandeur', 90, 1, '4041 Cherry Lane'),
(33, 'Cinema de Lux', 91, 1, '4243 Sycamore Court'),
(34, 'Cinema Enigma', 92, 1, '4445 Willow Way'),
(35, 'Cinema Odyssey', 93, 1, '4647 Spruce Street'),
(36, 'Cinema Elite', 94, 1, '4849 Elm Street'),
(37, 'Cinema Fusion', 95, 1, '5051 Oak Avenue'),
(38, 'Cinema Spectra', 96, 1, '5253 Maple Road'),
(39, 'Cinema Oasis', 97, 1, '5455 Pine Drive'),
(40, 'Cinema Solstice', 98, 1, '5657 Cedar Street');

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE `film` (
  `id` int(20) NOT NULL,
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

INSERT INTO `film` (`id`, `titre`, `description`, `duree`, `etat`, `id_affiche`, `date_sortie`, `date_expiration`) VALUES
(1, 'Fast and Furious ', 'action ', '1H50', 'cinema', 1, '2024-04-16 11:25:22', '2024-06-16 11:25:22'),
(2, 'John wick', 'action', '1H50', 'cinema', 2, '2024-04-16 11:31:42', '2024-06-16 11:31:42'),
(3, 'Casino', 'drama', '3H10', 'streaming', 4, '2024-04-16 11:33:33', '2024-06-16 11:33:33'),
(4, 'Public Enemy', 'crime', '2H20', 'cinema', 5, '2024-04-16 11:33:33', '2024-06-16 11:33:33');

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
(2, 1, 100),
(3, 2, 120),
(4, 3, 150),
(5, 4, 80),
(6, 5, 200),
(7, 6, 110),
(8, 7, 90),
(9, 8, 130),
(10, 9, 100),
(11, 10, 160),
(12, 11, 140),
(13, 12, 170),
(14, 13, 190),
(15, 14, 180),
(16, 15, 210),
(17, 16, 220),
(18, 17, 240),
(19, 18, 250),
(20, 19, 260),
(21, 20, 230),
(22, 21, 200),
(23, 22, 180),
(24, 23, 150),
(25, 24, 170),
(26, 25, 190),
(27, 26, 220),
(28, 27, 240),
(29, 28, 260),
(30, 29, 280),
(31, 30, 300),
(32, 31, 320),
(33, 32, 340),
(34, 33, 360),
(35, 34, 380),
(36, 35, 400),
(37, 36, 420),
(38, 37, 440),
(39, 38, 460),
(40, 39, 480),
(41, 40, 500);

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
(2, '2024-04-23 08:12:51', 1, 1),
(3, '2024-02-23 20:00:00', 2, 1),
(4, '2024-02-24 18:45:00', 3, 1),
(5, '2024-02-25 19:00:00', 4, 1),
(6, '2024-02-22 20:00:00', 2, 2),
(7, '2024-02-23 19:30:00', 3, 2),
(8, '2024-02-24 20:15:00', 4, 2),
(9, '2024-02-25 18:30:00', 1, 2),
(10, '2024-02-22 18:45:00', 3, 3),
(11, '2024-02-23 19:00:00', 4, 3),
(12, '2024-02-24 20:30:00', 1, 3),
(13, '2024-02-25 18:00:00', 2, 3),
(14, '2024-02-22 20:15:00', 4, 4),
(15, '2024-02-23 18:30:00', 1, 4),
(16, '2024-02-24 19:45:00', 2, 4),
(17, '2024-02-25 20:00:00', 3, 4),
(18, '2024-02-22 19:30:13', 1, 5),
(19, '2024-02-23 20:00:00', 2, 5),
(20, '2024-02-24 18:45:00', 3, 5),
(21, '2024-02-25 19:00:00', 4, 5),
(22, '2024-02-22 20:00:00', 2, 6),
(23, '2024-02-23 19:30:00', 3, 6),
(24, '2024-02-24 20:15:00', 4, 6),
(25, '2024-02-25 18:30:00', 1, 6),
(26, '2024-02-22 18:45:00', 3, 7),
(27, '2024-02-23 19:00:00', 4, 7),
(28, '2024-02-24 20:30:00', 1, 7),
(29, '2024-02-25 18:00:00', 2, 7),
(30, '2024-02-22 20:15:00', 4, 8),
(31, '2024-02-23 18:30:00', 1, 8),
(32, '2024-02-24 19:45:00', 2, 8),
(33, '2024-02-25 20:00:00', 3, 8);

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
(1, 'Lorient', 'Bretagne-56'),
(2, 'Vannes', 'Bretagne-56'),
(3, 'Rennes', 'Bretagne-56'),
(4, 'Saint-Malo', 'Bretagne-56'),
(6, 'Brest', 'Bretagne-56'),
(7, 'Quimper', 'Bretagne-56'),
(9, 'Saint-Brieuc', 'Bretagne-56'),
(10, 'Dinan', 'Bretagne-56'),
(11, 'Auray', 'Bretagne-56'),
(12, 'Fougères', 'Bretagne-56'),
(13, 'Concarneau', 'Bretagne-56'),
(14, 'Morlaix', 'Bretagne-56'),
(15, 'Pontivy', 'Bretagne-56'),
(16, 'Lannion', 'Bretagne-56'),
(17, 'Guingamp', 'Bretagne-56'),
(18, 'Douarnenez', 'Bretagne-56'),
(19, 'Ploërmel', 'Bretagne-56'),
(20, 'Landerneau', 'Bretagne-56'),
(21, 'Châteaulin', 'Bretagne-56'),
(22, 'Redon', 'Bretagne-56'),
(80, 'Guidel', 'Bretagne-56'),
(81, 'Paimpol', 'Bretagne-56'),
(82, 'Perros-Guirec', 'Bretagne-56'),
(83, 'Dinard', 'Bretagne-56'),
(84, 'Combourg', 'Bretagne-56'),
(85, 'Dol-de-Bretagne', 'Bretagne-56'),
(86, 'Jugon-les-Landes', 'Bretagne-56'),
(87, 'Hédé-Bazouges', 'Bretagne-56'),
(88, 'Louvigné-du-Désert', 'Bretagne-56'),
(89, 'Ménéac', 'Bretagne-56'),
(90, 'Guer', 'Bretagne-56'),
(91, 'Josselin', 'Bretagne-56'),
(92, 'Malestroit', 'Bretagne-56'),
(93, 'Le Faouët', 'Bretagne-56'),
(94, 'Gourin', 'Bretagne-56'),
(95, 'Riec-sur-Bélon', 'Bretagne-56'),
(96, 'Pont-Aven', 'Bretagne-56'),
(97, 'Cléden-Poher', 'Bretagne-56'),
(98, 'Huelgoat', 'Bretagne-56');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_billet` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `adherent`
--
ALTER TABLE `adherent`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `cinema`
--
ALTER TABLE `cinema`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `seance`
--
ALTER TABLE `seance`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

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
  ADD CONSTRAINT `fk_seance_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_seance_salle` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stream`
--
ALTER TABLE `stream`
  ADD CONSTRAINT `fk_stream_adherent` FOREIGN KEY (`id_adherent`) REFERENCES `adherent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stream_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `fk_tarif_cinema` FOREIGN KEY (`id_cinema`) REFERENCES `cinema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tarif_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;