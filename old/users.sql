-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 mai 2024 à 15:21
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `torn`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `third_name` varchar(255) NOT NULL,
  `fourth_name` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `education_level` enum('L3','M2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `second_name`, `third_name`, `fourth_name`, `full_name`, `email`, `password`, `education_level`) VALUES
(2, 'fff', 'ssss', 'zzzzz', 'oooo', 'heloo', 'dikraboubidi@gmail.com', '$2y$10$.L/s2mkj4pIW4.R.NVUEM.85KITV15Q5GvzvoZgDiUWL0iXSOxbui', 'L3'),
(3, 'zara', 'godchi', 'amz', 'baba', 'mamaty', 'dikrabou@gmail.com', '$2y$10$RV7GyUeP497MUmQyzKi98uofFS0kmJTirD50ocCrLdsAjIODxrq8S', 'M2'),
(4, 'safia', 'hoda', 'dikra', 'assia', 'groupe', 'gyzyziozi@gmail.com', '$2y$10$zkVpEhSYM8w8AeBEQ/l67O3o/ifdeDqECF8RVH.4zwXXexK6rs.XW', 'M2'),
(5, 'dikra', 'iuy', 'djfirhfu', 'erjkejhfer', 'rozejreijr', 'foufa@gmail.com', '$2y$10$By2wsGbMj1T0o.Xf7/aZG.jg2gFM.H/UVOQWv//jGeXNvhFri7F2C', 'M2'),
(6, 'dikra', '', '', '', 'groupe1', 'foufita@gmail.com', '$2y$10$l0FCLa4G4JazZR1khqq.B.7LBz24ABCAk0MOPHsmTtmfbnXF4.W92', 'M2'),
(7, 'safia', 'hoda', 'dikra', 'assia', 'RAZAN', 'gdtysttsrfatzf@gmail.com', '$2y$10$nDwzeaLoCtfl8GqB.DGXTeZL6weCqk0iSOCS1yAHLPRZwBQ7y46Fq', 'M2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
