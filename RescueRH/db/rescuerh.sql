-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 avr. 2024 à 09:50
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
-- Base de données : `rescuerh`
--

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

CREATE TABLE `conge` (
  `idConge` int(11) NOT NULL,
  `statutConcerne` enum('salarie','alternant','stagiaire','administrateur') NOT NULL,
  `titreConge` varchar(400) NOT NULL,
  `nbJours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conge`
--

INSERT INTO `conge` (`idConge`, `statutConcerne`, `titreConge`, `nbJours`) VALUES
(1, 'salarie', 'Mariage ou PACS (du salarié)', 4),
(2, 'salarie', 'Mariage d\'un enfant', 1),
(3, 'salarie', 'Naissance ou adoption d\'un enfant ', 3),
(4, 'salarie', 'Décès conjoint', 5),
(5, 'salarie', 'Décès famille', 3),
(6, 'salarie', 'Désignation comme tuteur d\'un enfant', 3),
(7, 'salarie', 'Survenue d\'un handicap (enfant)', 4),
(9, 'salarie', 'Survenue d\'un handicap (conjoint)', 2),
(10, 'salarie', 'Enfant malade (<16ans)', 3),
(11, 'salarie', 'Vacances salarie', 30),
(12, 'alternant', 'Vacances alternant', 30),
(13, 'stagiaire', 'Vacances stagiaire', 5);

-- --------------------------------------------------------

--
-- Structure de la table `congeemploye`
--

CREATE TABLE `congeemploye` (
  `idCongeEmploye` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `titreConge` varchar(400) NOT NULL,
  `dateConge` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `congeemploye`
--

INSERT INTO `congeemploye` (`idCongeEmploye`, `idUtilisateur`, `titreConge`, `dateConge`) VALUES
(1, 1, 'Vacances salarie', '2024-03-04'),
(2, 1, 'Vacances salarie', '2024-02-14'),
(3, 1, 'Vacances salarie', '2024-03-27'),
(4, 1, 'Vacances salarie', '2024-03-27'),
(5, 1, 'Vacances salarie', '2024-03-29'),
(6, 1, 'Vacances salarie', '2024-04-10');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `idEvenement` int(11) NOT NULL,
  `dateEvenement` date NOT NULL,
  `titre` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`idEvenement`, `dateEvenement`, `titre`, `description`) VALUES
(1, '2024-03-04', 'Anniv Agnès', 'Anniversaire de Agnès'),
(2, '2024-02-22', 'Anniv François', 'Anniversaire François');

-- --------------------------------------------------------

--
-- Structure de la table `heuresprevues`
--

CREATE TABLE `heuresprevues` (
  `idHeure` int(11) NOT NULL,
  `mois` int(11) NOT NULL,
  `annee` year(4) NOT NULL,
  `heuresPrevues` time NOT NULL,
  `nbJoursAnnualisation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `heuresprevues`
--

INSERT INTO `heuresprevues` (`idHeure`, `mois`, `annee`, `heuresPrevues`, `nbJoursAnnualisation`) VALUES
(1, 1, '2024', '07:00:00', -3),
(2, 2, '2024', '07:00:00', -3),
(3, 3, '2024', '07:00:00', -3),
(4, 4, '2024', '07:00:00', 0),
(5, 5, '2024', '08:00:00', 3),
(6, 6, '2024', '08:00:00', 3),
(7, 7, '2024', '08:00:00', 3),
(8, 8, '2024', '08:00:00', 3),
(9, 9, '2024', '08:00:00', 3),
(10, 10, '2024', '07:00:00', 0),
(11, 11, '2024', '07:00:00', -3),
(12, 12, '2024', '07:00:00', -3);

-- --------------------------------------------------------

--
-- Structure de la table `joursnontravailles`
--

CREATE TABLE `joursnontravailles` (
  `idJours` int(11) NOT NULL,
  `dateArret` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `joursnontravailles`
--

INSERT INTO `joursnontravailles` (`idJours`, `dateArret`) VALUES
(1, '2024-01-08'),
(2, '2024-01-09'),
(3, '2024-01-19');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `statut` enum('salarie','alternant','stagiaire','administrateur') NOT NULL,
  `dateArrivee` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `mdp`, `nom`, `prenom`, `statut`, `dateArrivee`) VALUES
(1, '$2y$10$kM6JcR9ROwqX3B4034.mzenY9VtJ51qKsgM6/8/eyGLw3EzfL5X9q', 'Capitaine', 'Agnès', 'salarie', '2023-02-20'),
(6, '$2y$10$YEpi493dNKtWRW2qZxyMH.vXDNhXSdJtLeQ2kL1urVCbeu11/Bp6C', 'CapitaineAdmin', 'Agnès', 'administrateur', '2023-02-20'),
(7, '$2y$10$4V6ZZb.cQ9kgBdkDZ3NTMuQiAuW1bC4ZApW0HaOXLi0sCtgIX64Xe', 'Doe', 'John', 'alternant', '2023-02-20'),
(8, '$2y$10$v0n961Ys46NA2Z8fxyCgeOSuBANZP/ep94G8kr0s5G6Wr/x4awR2q', 'Nomdustagiaire', 'Prenomdustagiaire', 'stagiaire', '2023-02-20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conge`
--
ALTER TABLE `conge`
  ADD PRIMARY KEY (`idConge`);

--
-- Index pour la table `congeemploye`
--
ALTER TABLE `congeemploye`
  ADD PRIMARY KEY (`idCongeEmploye`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`idEvenement`);

--
-- Index pour la table `heuresprevues`
--
ALTER TABLE `heuresprevues`
  ADD PRIMARY KEY (`idHeure`);

--
-- Index pour la table `joursnontravailles`
--
ALTER TABLE `joursnontravailles`
  ADD PRIMARY KEY (`idJours`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `idConge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `congeemploye`
--
ALTER TABLE `congeemploye`
  MODIFY `idCongeEmploye` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `idEvenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `heuresprevues`
--
ALTER TABLE `heuresprevues`
  MODIFY `idHeure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `joursnontravailles`
--
ALTER TABLE `joursnontravailles`
  MODIFY `idJours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
