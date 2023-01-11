-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 jan. 2023 à 23:05
-- Version du serveur : 5.7.40
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `classes`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `firstname` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastname` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `firstname`, `lastname`) VALUES
(1, 'test', 'test', 'test@example.com', 'Test', 'User'),
(2, 'sdfsdf', 'sdfsfsdfsdf', 'sdfst@example.com', '2sffff', '2Ufdfdf'),
(3, '3333', '33333333', '333st@example.com', '333est', '333ser'),
(4, '44444st', '44444st', '44442st@example.com', '44444est', '4444ser'),
(5, '55555est', '555555est', '55555t@example.com', '5555st', '5555ser');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
