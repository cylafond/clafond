-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 06 août 2022 à 17:47
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `colnet`
--
DROP DATABASE IF EXISTS `colnet`; 
CREATE DATABASE `colnet`;
USE `colnet`;
-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `codePermanent` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomComplet` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moyenne` double NOT NULL,
  `codeGroupe` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`codePermanent`, `nomComplet`, `adresse`, `telephone`, `moyenne`, `codeGroupe`) VALUES
('BERK110998', 'Kim Bergeron', '1300 Rue des Ursulines', '418-331-3985', 17.75, 'WEBA21L'),
('BERS031293', 'Sonia Bergeron', '500 Rue Saint-Jean', '418-999-1133', 18.5, 'WEBA21H'),
('BOUM091193', 'Mélanie boutin', '1400 Rue Sherbrooke', '438-500-1265', 20, 'WEBA21C'),
('CREF031192', 'Francis Crevier', '22 Rue Sherbrooke', '514-479-5582', 7, 'WEBA21C'),
('DUFS230192', 'Simon Dufour', '15 Avenue de la Liberté', '514-998-1265', 8.5, 'WEBA21L'),
('FREJ221192', 'Johanne Frechette', '1300 Rue Labrecque', '418-122-4423', 8.25, 'WEBA21H'),
('HEWD231298', 'Danny Hewitt', '22 Rue des Forges', '514-222-3475', 20, 'WEBA21L'),
('LAMA041190', 'Alain Lamelin', '1800 Rue des Sentinelles', '418-554-1255', 11.5, 'WEBA21H'),
('PERG080294', 'Gilles Perrond', '20 Rue Saint-Denis', '438-599-7787', 12.25, 'WEBA21C'),
('PRAS261188', 'Samuel Pratte', '1400 Rue Hart', '514-431-3975', 18.75, 'WEBA21L'),
('SAVA091193', 'Alain Savoie', '20 Rue Saint-Simonne-Monet-Chartrand', '438-499-9987', 13, 'WEBA21C'),
('TURS091193', 'Simon Turmel', '1200 Rue Papineau', '418-399-1187', 19.5, 'WEBA21H');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `code` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`code`, `nom`, `type`) VALUES
('WEBA21C', 'Techniques de développement web A21', 'En classe'),
('WEBA21H', 'Techniques de développement web A21', 'Hybride'),
('WEBA21L', 'Techniques de développement web A21', 'En ligne');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(60) UNSIGNED NOT NULL,
  `nomComplet` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codePostal` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motDePasse` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`codePermanent`),
  ADD KEY `fk_codeGroupe` (`codeGroupe`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(60) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `fk_codeGroupe` FOREIGN KEY (`codeGroupe`) REFERENCES `groupe` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
