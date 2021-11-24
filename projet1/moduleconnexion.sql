-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 nov. 2021 à 09:54
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `prenom`, `nom`, `password`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$RjxvuTXe3kmbXqboQPbgZ.YYPv05CmqXwD8/T6n5VdcWLVUVP49Dm'),
(2, 'Laure5', 'laure', 'martinet', '$2y$10$nm23QhgUUZznjRzuPz4AfuOkD6Qt.KEfBSTe6/HOndCcrEIjgb0Uy'),
(3, 'Hubert4', 'hubert', 'olive', '$2y$10$ZLqhW9bFwhpumdKXo8cy5Oez0EiIpYybfhYbT.lbZHcUZ3YBBViDm'),
(4, 'pierre45', 'pierre', 'pierre', '$2y$10$7xdTvtlkjnEf9r5GtMrlj.05ZDdq9/JYQ47tFbOnNcqnrKqGLNEe2'),
(5, 'Loupette1', 'loupettezboub', 'loupet', '$2y$10$oJQ/uTsRKCSlF5Nb0RE0fOJocLWoEK74Ft/hNZnHBgbicH8sk0kaG'),
(6, 'Seth17', 'Seth', 'God', '$2y$10$/XEk9cYi1TaO9qYsR25Q/OyDWROVSUBmM4uJrrwm/B4msD6nu3LGG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
