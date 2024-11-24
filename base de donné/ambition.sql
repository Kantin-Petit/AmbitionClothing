-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Mai 2020 à 15:21
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ambition`
--

-- --------------------------------------------------------

--
-- Structure de la table `boutique`
--

CREATE TABLE IF NOT EXISTS `boutique` (
  `nom` text NOT NULL,
  `description` text NOT NULL,
  `collection` text NOT NULL,
  `prix` varchar(10) NOT NULL,
  `img` text NOT NULL,
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `stockS` int(11) NOT NULL,
  `stockM` int(11) NOT NULL,
  `stockL` int(11) NOT NULL,
  `stockXL` int(11) NOT NULL,
  `stockXXL` int(11) NOT NULL,
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Contenu de la table `boutique`
--

INSERT INTO `boutique` (`nom`, `description`, `collection`, `prix`, `img`, `numero`, `type`, `stockS`, `stockM`, `stockL`, `stockXL`, `stockXXL`) VALUES
('T-shirt ambition', 'T-shirt blanc avec « – Ambition – » au centre.  100% coton biologique.', 'BASIC', '14.99', 'img/T-shirt ambition centre.png', 46, 'tshirts', 0, 0, 0, 0, 0),
('T-shirt ambition', 'T-shirt blanc avec « – Ambition – » sur le coeur.  100% coton biologique.', 'BASIC', '14.99', 'img/T-shirt ambition droite.png', 47, 'tshirts', 0, 0, 0, 0, 0),
('T-shirt scara-b', 'T-shirt blanc avec « – Ambition – » au centre et scarabée au dos.  100% coton biologique.', 'BASIC', '14.99', 'img/T-shirt scara-b.jpeg', 49, 'tshirts', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `mon_compte`
--

CREATE TABLE IF NOT EXISTS `mon_compte` (
  `id` varchar(10) NOT NULL,
  `article` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `taille` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `etat` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bons` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cadeau` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `adresse` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `prix` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `numero` int(11) NOT NULL,
  `nombre` bigint(20) NOT NULL AUTO_INCREMENT,
  `Nom Prenom` text NOT NULL,
  PRIMARY KEY (`nombre`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `adresse` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`email`, `password`, `id`, `adresse`) VALUES
('admin@page', '$2y$12$hRcPxwsorV9ieadtNMa5B.tLzlCqx7vazZptFR0nKjqqMFvFpsFMu', 0, ''),
('kantinpetit@gmail.com', '$2y$12$cYwC1h9Lya/ooPck3DFXnefAem6G9/M2DbTk7wKM4aAKT/kZVk3ee', 3, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
