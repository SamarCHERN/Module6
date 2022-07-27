-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 26 juil. 2022 à 15:43
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbapi`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_de_publication` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `auteur`, `date_de_publication`) VALUES
(1, 'titre1', 'contenu1', 'auteur1', 'date_de_publication1'),
(2, 'titre2', 'contenu2', 'auteur2', 'date_de_publication2'),
(3, 'titre3', 'contenu3', 'auteur3', 'date_de_publication3'),
(4, 'titre4', 'contenu4', 'auteur4', 'date_de_publication4');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220721090740', '2022-07-21 11:07:50', 243),
('DoctrineMigrations\\Version20220722152827', '2022-07-22 17:28:42', 377);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@talan.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$Z081YW1uMVVGSi5CWVhMRA$R3Gn8v6H68UY3DFCw6/kEOnUYMBSBkOIDTZXY1vXYUE'),
(2, 'habib@talan.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$dEJNR0k0Mk00Ukh1dGdXYw$Kq+bD2a0B239IzAkNWcEs2egFqRXMLpQ4g7t/RXlvaY'),
(3, 'samar@talan.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$bjRyNGxkN3BtMFdiRkR5Ug$mgh/GV6yJIQf/uttrneOul5M1XrDXGo0kJtGwkepP1A'),
(4, 'kenza@talan.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$Q2tzOE1IL0VZcG5oSE9VYw$13O5Gp7RmU2mbt3hsgLzfb0JTinSmUc4W6aDs6v8VCY'),
(5, 'rania@talan.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$VW8vMlE4a29sSC5jQmc3bg$m4pN7FewQ6PpnEpS1eNqEJP2DJaXLRWjPgYepAsxK/U');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
