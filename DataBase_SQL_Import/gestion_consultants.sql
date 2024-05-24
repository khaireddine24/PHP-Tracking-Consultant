-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 mai 2024 à 21:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_consultants`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'Ahmed Ahmed', 'ahmed20@gmail.com', '123');

-- --------------------------------------------------------

--
-- Structure de la table `consultants`
--

CREATE TABLE `consultants` (
  `consultant_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `cin` varchar(8) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `country_of_residence` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `confpassword` varchar(100) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT '''pending'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consultants`
--

INSERT INTO `consultants` (`consultant_id`, `first_name`, `last_name`, `cin`, `date_of_birth`, `place_of_birth`, `country_of_residence`, `email`, `pass`, `confpassword`, `registration_date`, `status`) VALUES
(8901, 'hazem', 'ben ali', '10236549', '2024-12-31', 'nabeul', 'tunisia', 'hazem@gmail.com', '100', '100', '2024-05-19 22:46:31', '\'pending\'');

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `consultant_id` int(11) NOT NULL,
  `CinCopy` blob NOT NULL,
  `PermisCopy` blob NOT NULL,
  `FileSimulation` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `document`
--

INSERT INTO `document` (`id`, `consultant_id`, `CinCopy`, `PermisCopy`, `FileSimulation`) VALUES
(7, 8901, 0x436f6e73526f2e706e67, 0x4167656e74526f2e706e67, 0x636f7572732d61726272655f636f6d70726573732e706466);

-- --------------------------------------------------------

--
-- Structure de la table `hr_agents`
--

CREATE TABLE `hr_agents` (
  `hr_agent_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hr_agents`
--

INSERT INTO `hr_agents` (`hr_agent_id`, `first_name`, `last_name`, `email`, `pass`) VALUES
(3, 'khaireddine', 'Ihrissane', 'khaireddine100@hotmail.com', '500'),
(4, 'faiza', 'khalfaoui', 'faiza1@gmail.com', '200');

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

CREATE TABLE `missions` (
  `mission_id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `filed_of_activity` varchar(100) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_representative_position` varchar(100) NOT NULL,
  `mission_start_date` date NOT NULL,
  `mission_end_date` date NOT NULL,
  `daily_rate` int(11) NOT NULL,
  `consultant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `missions`
--

INSERT INTO `missions` (`mission_id`, `position`, `filed_of_activity`, `client_name`, `client_representative_position`, `mission_start_date`, `mission_end_date`, `daily_rate`, `consultant_id`) VALUES
(6, 'poste1', 'mp', 'kilani', 'hr', '2024-12-31', '2025-12-31', 1, 8901),
(7, 'poste20', 'Dev', 'kali', 'poste10', '2023-12-31', '2024-12-31', 3, 8901);

-- --------------------------------------------------------

--
-- Structure de la table `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` int(11) NOT NULL,
  `consultant_id` int(11) NOT NULL,
  `transfer_type` varchar(100) NOT NULL DEFAULT '',
  `beneficiary` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transfer_date` datetime NOT NULL DEFAULT current_timestamp(),
  `hr_agent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transfers`
--

INSERT INTO `transfers` (`transfer_id`, `consultant_id`, `transfer_type`, `beneficiary`, `amount`, `transfer_date`, `hr_agent_id`) VALUES
(5, 8901, 'participation', 'b1', 12.05, '2024-05-20 10:52:43', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `consultants`
--
ALTER TABLE `consultants`
  ADD PRIMARY KEY (`consultant_id`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consultant_id` (`consultant_id`) USING BTREE;

--
-- Index pour la table `hr_agents`
--
ALTER TABLE `hr_agents`
  ADD PRIMARY KEY (`hr_agent_id`);

--
-- Index pour la table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`mission_id`),
  ADD KEY `fk_consultant_id` (`consultant_id`);

--
-- Index pour la table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `fk_consultant_id1` (`consultant_id`),
  ADD KEY `idAgent` (`hr_agent_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `consultants`
--
ALTER TABLE `consultants`
  MODIFY `consultant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8902;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `hr_agents`
--
ALTER TABLE `hr_agents`
  MODIFY `hr_agent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `missions`
--
ALTER TABLE `missions`
  MODIFY `mission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`consultant_id`) REFERENCES `consultants` (`consultant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `fk_consultant_id` FOREIGN KEY (`consultant_id`) REFERENCES `consultants` (`consultant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `fk_agent_id` FOREIGN KEY (`hr_agent_id`) REFERENCES `hr_agents` (`hr_agent_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultant_id1` FOREIGN KEY (`consultant_id`) REFERENCES `consultants` (`consultant_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
