-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 17 Avril 2015 à 12:09
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `alluco`
--

-- --------------------------------------------------------

--
-- Structure de la table `accesoire`
--

CREATE TABLE IF NOT EXISTS `accesoire` (
  `reference` varchar(10) NOT NULL,
  `id_gamme` int(11) NOT NULL,
  `nom_accesoire` varchar(70) NOT NULL,
  PRIMARY KEY (`reference`),
  KEY `id_gamme` (`id_gamme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `accesoire`
--

INSERT INTO `accesoire` (`reference`, `id_gamme`, `nom_accesoire`) VALUES
(' 4119', 3, 'pied de support pour poteau F50-101'),
(' 4121', 3, 'ied de support pour poteau F50-100'),
(' 4165', 3, '14 4165 support mural de main courante F50-200'),
(' 4166', 3, '14 4166 support pour poteau F50-100'),
(' 4168', 3, '14 4168 fixation de vitrage 8-10mm'),
(' 4169B', 3, '14 4169B support de main courante F50-200 poteau F50-100 exterieur'),
(' 4173', 3, '14 4173  fixation de vitrage 8-10mm(glass support 8-10mm)'),
(' 4179', 3, 'support de main courante F50-200 poteau F50-101'),
(' 4182', 3, 'verrou pour poteau F50-100'),
(' 4184', 3, 'SUPPORT DE POTEAU EXTERIEUR f 50-101'),
(' 4186', 3, 'Verrou pour poteau F50-100'),
(' 4188', 3, 'Sous-sol support pour poteau F50-102'),
(' 4189', 3, 'verrou pour potau F50-100'),
(' 4191', 3, 'rt de vitrage 8-10 mm pour poteau F50-103'),
(' 4192', 3, 'support de vitrage 8-10mm pour poteau F50-103'),
(' 4193', 3, 'support de vitrage 8-10 mm pour poteau F50-102    /106'),
(' 4194', 3, 'support mural pour poteau F50-100'),
(' 4218', 3, 'jonction de main courante Ø50'),
(' 4219', 3, 'jonction coudé 90°  de main courante ()50'),
(' 4224', 3, 'jonction de poteau F50-100 (joint vertical)'),
(' 4225', 3, 'jonction de potaeu F50-100 avec profilé Ø26 (appui interieur)'),
(' 4228', 3, 'jonction 90° pour profilé () 16'),
(' 4229', 3, 'jonction 135° pour profilé Ø16'),
(' 4230', 3, 'jonction de profilé Ø16'),
(' 4231', 3, 'jonction coudé 90° de main courante Ø50poteau poteau F50-100'),
(' 4232', 3, 'jonction de poteau F50-100 avec profilé F50-302'),
(' 4235', 3, 'jonction coudé 90° de main courante Ø50   poteau F50-101'),
(' 4241', 3, 'jonction de main courante Ø50(interieur)'),
(' 4249', 3, 'jonction de main courante droite'),
(' 4302', 3, 'jonction coudé pour profilé Ø16'),
(' 4316', 3, 'support de main courante Ø 50 poteau F50-100'),
(' 4328', 3, 'jonction F50-102'),
(' 4333', 3, 'jonction reglable F50-307'),
(' 4337', 3, 'jonction  F50-100 avec f50-201'),
(' 4341', 3, 'jonction F50-100 et le profilé F50-302'),
(' 4343', 3, 'jonction entre le poteau 4620 et le profilé Ø16'),
(' 4434', 3, 'bouchon de main courante F 50-200'),
(' 4435', 3, 'bouchon de profilé F50-301(Ø16*3.5)'),
(' 4437', 3, 'finition de profilé Ø 16'),
(' 4438', 3, 'bouchon de profilé F50-300 (Ø16*1.3)'),
(' 4448', 3, 'bouchon de poteau F50-102'),
(' 4451', 3, 'bouchon de main courante F50-203'),
(' 4510', 3, 'bouchon de poteau F50-100'),
(' 4611', 3, 'rosace Ø100 de verre'),
(' 4618', 3, 'rosace pour profilé Ø16'),
(' F50-101', 1, 'poteau de support Ø50'),
('4112', 3, 'external support foot for 50-100 column pied de support exterieure pou'),
('4115', 3, 'support foot for 50-100 pied de support pour colonne F50-100'),
('4116', 3, 'suppot for F50-100 rail top support de main couranteF50-100'),
('4117', 3, 'pied de support pour poteau F50-100'),
('4122', 3, '14 4122 pied de support pour poteau F50-102/106'),
('4167', 3, '14 4167 sous sol support pour poteaux f50-100&F50-101'),
('4169', 3, '14 4169 support de main courante-poteau'),
('4172', 3, '14 4172  fixation de vitrage 6-8mm(glass support 6-8mm)'),
('4177', 3, 'charniere de poteau F50-100'),
('4180', 3, 'support de main courante F50-200 poteau F50-101( exterieur)'),
('4181', 3, 'single glass support 8-10mm fixation de vitrage 8-10mm simple'),
('4190', 3, 'support de vitrage 8-10 mm pour poteau F50-102'),
('4240', 3, 'jonction F50-307 avec F50-102'),
('4243', 3, 'jonction de 90°de rail Ø30'),
('4244', 3, 'jonction de poteau f50-102 avec profilé f26 (connexion interne)'),
('4245', 3, 'jonction de poteau F50-102/106 avec profilé F50-302'),
('4250', 3, 'cornière de jonction de la main courante F50-201'),
('4312', 3, 'jonction de poteau F50-100 avec profile Ø16'),
('4314', 3, 'support de main courante'),
('4319', 3, 'jonction réglable de main courante Ø50'),
('4322', 3, 'jonction de rosace pour verre avec profilé Ø16'),
('4329', 3, 'jonction reglable de main courante Ø50'),
('4332', 3, 'jonction reglable F50-201'),
('4335', 3, 'jonction entre le poteau F50-100 et le profilé Ø 50'),
('4342', 3, 'jonction de cornière ajustable du profilé F50-302'),
('4436', 3, 'bouchon de poteau F50-100'),
('4443', 3, 'bouchon de poteau F50-101'),
('4444', 3, 'bouchon de profilé F50-302 (K16*16)'),
('4446', 3, 'bouchon de rail F50-307'),
('4447', 3, 'bouchon de main courante F50-201'),
('4452', 3, 'bouchon de rail F50-310'),
('4509Z', 3, 'Couvre jointe de la main courante ()50 avec bouchon'),
('4513', 3, 'bouchon de poteau F50-101'),
('4514', 3, 'bouchon de poteau F50-102'),
('4515', 3, 'bouchon de main courante F50-201/203'),
('F50-100', 1, 'poteau de support Ø42'),
('F50-102', 1, ' poteau de support 40x40'),
('F50-103', 1, ' poteau de support Ø42'),
('F50-106', 1, 'poteau de support 40x40'),
('F50-121', 1, ' bouchon de poteau'),
('F50-122', 1, 'bouchon de poteau'),
('F50-123', 1, 'bouchon de poteau'),
('F50-200', 1, ' main courante Ø50'),
('F50-201', 1, ' main courante 30x80'),
('F50-203', 1, '  main courante divisible 30x8'),
('F50-223', 1, 'couvercle de main courante div'),
('F50-300', 1, 'F50-300'),
('F50-301', 1, '  profilé Ø16x3.5'),
('F50-302', 1, 'profilé K16x16x2'),
('F50-303', 1, ' profilé Ø136 avec lamelle pou'),
('F50-304', 1, 'profile Ø26'),
('F50-305', 1, ' guide de vitrage'),
('F50-306', 1, 'guide perforé Ø26 pour profilé'),
('F50-307', 1, 'rail Ø30'),
('F50-308', 1, ' poteau K12x12x2'),
('F50-310', 1, 'RAIL POUR DU VITRAGE DE 10-12M'),
('F50-311', 1, ' couvercle du rail F50-310 et '),
('F50-327', 1, 'bouchon de rail'),
('F50-3K10', 1, ' bouchon de rail');

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE IF NOT EXISTS `actualite` (
  `id_actu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_actu` varchar(30) NOT NULL,
  `photo_actu` varchar(30) NOT NULL,
  `ph_2` varchar(50) DEFAULT NULL,
  `ph_3` varchar(50) DEFAULT NULL,
  `ph_4` varchar(50) DEFAULT NULL,
  `ph_5` varchar(50) DEFAULT NULL,
  `ph_6` varchar(50) DEFAULT NULL,
  `sujet_actu` text NOT NULL,
  `date_actu` datetime NOT NULL,
  PRIMARY KEY (`id_actu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `actualite`
--

INSERT INTO `actualite` (`id_actu`, `nom_actu`, `photo_actu`, `ph_2`, `ph_3`, `ph_4`, `ph_5`, `ph_6`, `sujet_actu`, `date_actu`) VALUES
(2, '', 'Medibat 2015.jpg', 'null', 'null', 'null', 'null', 'null', '<span style="font-weight: normal;">&nbsp;Nous aurons tout le plaisir de vous accueillir sur notre stand </span><b><u>N°82 Hall 4</u></b><span style="font-weight: normal;"> au Salon "</span><b style="font-weight: normal;">Medibat</b>" du 04 au 07 Mars et découvrir nos nouveautés 2015. &nbsp;', '2015-02-19 09:24:42');

-- --------------------------------------------------------

--
-- Structure de la table `article_assosiee`
--

CREATE TABLE IF NOT EXISTS `article_assosiee` (
  `num_art` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) DEFAULT NULL,
  `nom_sous_prod` varchar(40) DEFAULT NULL,
  `nom_complément` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`num_art`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `article_assosiee`
--

INSERT INTO `article_assosiee` (`num_art`, `id_prod`, `nom_sous_prod`, `nom_complément`) VALUES
(1, 4, 'LM 55 Silencieuse', NULL),
(2, 4, 'LM 55 Silencieuse', NULL),
(3, 4, 'LM 55 Silencieuse', NULL),
(4, 4, 'LM 55 Silencieuse', NULL),
(5, 4, 'LM 55 Silencieuse', NULL),
(6, 4, 'LM 55 Silencieuse', NULL),
(7, 5, 'LM 55 Silencieuse', NULL),
(8, 5, 'LM 55 Silencieuse', NULL),
(9, 5, 'LM 55 Silencieuse', NULL),
(10, 5, 'LM 55 Silencieuse', NULL),
(11, 5, 'LM 55 Silencieuse', NULL),
(12, 5, 'LM 55 Silencieuse', NULL),
(13, 5, 'LM 55 Silencieuse', NULL),
(14, 6, 'LM 55 Silencieuse', NULL),
(15, 5, 'LM 55 Silencieuse', NULL),
(16, 6, 'LM 55 Silencieuse', NULL),
(17, 5, 'LM 55 Silencieuse', NULL),
(18, 6, 'LM 55 Silencieuse', NULL),
(19, 5, 'LM 55 Silencieuse', NULL),
(20, 6, 'LM 55 Silencieuse', NULL),
(21, 5, 'LM 55 Silencieuse', NULL),
(22, 6, 'LM 55 Silencieuse', NULL),
(23, 5, 'LM 55 Silencieuse', NULL),
(24, 6, 'LM 55 Silencieuse', NULL),
(25, 5, 'LM 55 Silencieuse', NULL),
(26, 6, 'LM 55 Silencieuse', NULL),
(27, 7, 'LM 55 Silencieuse', NULL),
(28, 5, 'LM 55 Silencieuse', NULL),
(29, 6, 'LM 55 Silencieuse', NULL),
(30, 7, 'LM 55 Silencieuse', NULL),
(31, 5, 'LM 55 Silencieuse', NULL),
(32, 6, 'LM 55 Silencieuse', NULL),
(33, 7, 'LM 55 Silencieuse', NULL),
(34, 5, 'LM 55 Silencieuse', NULL),
(35, 6, 'LM 55 Silencieuse', NULL),
(36, 7, 'LM 55 Silencieuse', NULL),
(37, 5, 'LM 55 Silencieuse', NULL),
(38, 6, 'LM 55 Silencieuse', NULL),
(39, 7, 'LM 55 Silencieuse', NULL),
(40, 5, 'LM 55 Silencieuse', NULL),
(41, 6, 'LM 55 Silencieuse', NULL),
(42, 7, 'LM 55 Silencieuse', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `certificat`
--

CREATE TABLE IF NOT EXISTS `certificat` (
  `photo_certif` varchar(50) NOT NULL,
  `description` text,
  `num_certif` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`num_certif`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `certificat`
--

INSERT INTO `certificat` (`photo_certif`, `description`, `num_certif`) VALUES
('AL 220 iFT.jpg', '', 1),
('AL 450.jpg', '', 2),
('HORIZON_H-Rings_GIORDANO.jpg', '', 3),
('ACCORD_GIORDANO.jpg', '', 4);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(30) NOT NULL,
  `prenom_client` varchar(30) NOT NULL,
  `mat_fiscal` varchar(30) DEFAULT NULL,
  `e_mail` varchar(40) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `adr_client` varchar(50) DEFAULT NULL,
  `tel_client` varchar(15) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `code_postal` varchar(4) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `societe` varchar(30) DEFAULT NULL,
  `genre` varchar(8) NOT NULL,
  `tel2_client` varchar(15) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `type_client` varchar(13) NOT NULL,
  `profession` varchar(15) NOT NULL,
  `info_complementaire` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `mat_fiscal`, `e_mail`, `mdp`, `adr_client`, `tel_client`, `ville`, `code_postal`, `pays`, `societe`, `genre`, `tel2_client`, `fax`, `type_client`, `profession`, `info_complementaire`) VALUES
(2, '', '', NULL, 'alluco159753demco', '159753', NULL, '', '', '', '', NULL, '', NULL, NULL, '', '', NULL),
(4, 'braham', 'hamdi', '', 'hamid.braham@gmail.com', 'allucopass', 'av habib bourguiba', '22832097', 'TÃ©boulba', '', '', '', 'Monsieur', '', '', 'Professionnel', 'Autres', ''),
(5, 'KAZEZ', 'SLAHEDDINE', '632858KAP000', 'btckazez@yahoo.fr', 'adam2014', '21 rue d''alger', '98224888', 'bizerte', '7000', 'tunisie', 'cabinet de comptabilite', 'Monsieur', '23524076', '72439088', 'Particulier', 'Autres', ''),
(6, 'Zgolli', 'Ridha', '', 'ridha.zgolli@enit.rnu.tn', 'ridhazgolli', 'Korba', '98435068', 'Korba', '', 'Tunisie', '', 'Monsieur', '', '', 'Particulier', 'Autres', ''),
(7, 'Chahed', 'Mouna', '', 'manou092@hotmail.com', '!Z0uzou', 'Tunis', '25500888', 'Tunis', '', '', '', 'Madame', '', '', 'Particulier', 'Autres', ''),
(8, 'BAKLOUTI', 'ISMAIL', '', 'sfaxalu@gmail.com', 'ismail&tarekÃ©nabil"', 'sfax', '28432000', 'sfax', '', 'tunisie', '', 'Monsieur', '', '', 'Particulier', 'Architecte', ''),
(9, 'badreddine ', 'Samia ', '', 's_hamda@yahoo.fr', 'Samia', 'CitÃ© des oranges ', '22 234  500', 'Manouba', '2010', 'Tunisie', '', 'Madame', '', '', 'Particulier', 'Autres', ''),
(10, 'TOUHAMI', 'BRAHIM', '', 'brahimtouhami@hotmail.com', 'TOUHAMI', '2 rue Med Ali LAAJIMI', '98694348', 'Tozeur', '2200', 'TUNISIE', 'TIBEAU Architecture', 'Monsieur', '0', '', 'Professionnel', 'Architecte', 'Systeme AccordÃ©on de 4.50 x 3 '),
(11, 'Salah', 'Seif', '', 'seif.salah@gmail.com', 'Alphatester123', '148 R1', '93969674', 'Monastir', '5000', 'Tunisie', '', 'Monsieur', '', '', 'Particulier', 'Architecte', '');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `num_cmd` int(11) NOT NULL AUTO_INCREMENT,
  `command` varchar(40) NOT NULL COMMENT 'commande sous format pdf',
  `date_cmd` datetime NOT NULL,
  `id_client` int(11) NOT NULL,
  `etat` varchar(25) DEFAULT NULL,
  `commentaire` varchar(150) DEFAULT NULL COMMENT 'commentaire sur l''état de commande en cours',
  PRIMARY KEY (`num_cmd`),
  KEY `id_client` (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`num_cmd`, `command`, `date_cmd`, `id_client`, `etat`, `commentaire`) VALUES
(2, 'SousseMahdia.pdf', '2014-11-12 11:32:44', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `complément_sous_produit`
--

CREATE TABLE IF NOT EXISTS `complément_sous_produit` (
  `id_complément` int(11) NOT NULL AUTO_INCREMENT,
  `nom_complément` varchar(30) NOT NULL,
  `id_gamme` int(11) NOT NULL,
  `id_sousprod` int(11) NOT NULL,
  `photo_ref` varchar(45) NOT NULL,
  `description` text,
  `fichetech` varchar(45) DEFAULT NULL,
  `video` varchar(45) DEFAULT NULL,
  `date` datetime NOT NULL,
  `etat` varchar(10) NOT NULL,
  PRIMARY KEY (`id_complément`),
  KEY `id_gamme` (`id_gamme`),
  KEY `id_sousprod` (`id_sousprod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `complément_sous_produit`
--

INSERT INTO `complément_sous_produit` (`id_complément`, `nom_complément`, `id_gamme`, `id_sousprod`, `photo_ref`, `description`, `fichetech`, `video`, `date`, `etat`) VALUES
(1, 'Lame C', 4, 12, 'Lame C.pdf', 'La protection solaire Calero 100C-V est un auvent vertical constitué de lames en forme C.<br>En fonction de l écartement des lames, les lames peuvent être éclipsées sous un angle d incidence solaire de 40°, 45° ou 50°.<br>Profils porteurs : profil léger (P035), profil mi-lourd (P036) ou profil lourd (P037) à fixer sur la structure existante.<div style="font-style: normal;"><br><b>Caractéristiques techniques :</b></div><div style="font-style: normal;"><b><br></b>Lames ouvertes en forme C (100 x 25) en alliage EN AW-6060 T66 (AlMgSi0, F22).<br>Fixations en inox.</div><div style="font-style: normal;"><br><b>Traitement de surface :</b></div><div><b style="font-style: normal;"><br></b><i><u>Finition standard:</u></i><br>Anodisé ton naturel (F1) - Minimum 20 microns. <br>Variante pour l anodisation ton naturel (F1) est le thermolaquage en RAL 9006 <br>Thermolaquage dans toutes les teintes RAL? 60 microns en moyenne.</div><div><br><i><u>Finition sur demande:</u></i><br>En cas de conditions extrêmes et milieux agressifs (littoral, environnement industriel, piscine,?) Thermolaquage dans toutes les teintes RAL Anodisé ton naturel (F1) - Minimum 25 microns.<br></div>', 'Lame C.pdf', 'null', '2014-11-14 17:15:29', 'en ligne'),
(2, 'Lame 34Z', 4, 12, 'CLS34Z.gif', 'Les bardages à lames filantes (petites lames forme Z) assurent une ventilation permanente, résistent aux conditions atmosphériques et protègent contre les regards des passants.<br>Toutes les parties sont en aluminium de haute qualité ce qui garantit leur durabilité<br>La longueur standard des lames et des porteurs est de 6000 mm.<br>Une fois attachées, les lames ne peuvent pas être enlevées sans les endommager.<div style="font-weight: normal; font-style: normal;"><br><b>Données techniques :</b></div><div style="font-weight: normal; font-style: normal;"><b><br></b>- Porteurs: P016 (14 mm), P010 (50 mm) et P011 (80 mm)<br>- Epaisseur de profil: min. 1,1 mm<br>- Hauteur de lame: 39 mm<br>- Pas des lames: 34 mm<br>- Surface visuelle libre: 68%<br>- Surface physique libre: 35%<br>- Calcul de dimensionnement sur demande<br>- Moustiquaire INOX (AlSI 304) 2,3 x 2,3mm</div><div style="font-style: normal;"><br><b>Traitement de surface</b></div><div style="font-weight: normal;"><br><i><u>Finition standard:</u></i><br>Anodisé ton naturel (F1) - Minimum 20 microns. <br>Variante pour l anodisation ton naturel (F1) est le thermolaquage en RAL 9006 <br>Thermolaquage dans toutes les teintes RAL? 60 microns en moyenne.<br><br><i><u>Finition sur demande:</u></i><br>En cas de conditions extrêmes et milieux agressifs (littoral, environnement industriel, piscine,?) Thermolaquage dans toutes les teintes RAL<br> Anodisé ton naturel (F1) - Minimum 25 microns.<br></div>', 'Lame 34Z.pdf', 'null', '2014-11-14 17:16:15', 'en ligne'),
(3, 'Lame 65Z', 4, 12, 'CLS65Z (1).gif', 'Les bardages à lames filantes (petites lames forme Z) assurent une ventilation permanente, résistent aux conditions atmosphériques et protègent contre les regards des passants.<br>Toutes les parties sont en aluminium de haute qualité ce qui garantit leur durabilité<br>La longueur standard des lames et des porteurs est de 6000 mm.<br>Une fois attachées, les lames ne peuvent plus être enlevées sans les endommager.<div style="font-style: normal;"><br><b>Données techniques</b></div><div style="font-style: normal;"><br>- Porteurs: P016 (14 mm), P010 (50 mm) et P011 (80 mm)<br>- Epaisseur de profil: min. 1,1 mm<br>- Hauteur de lame: 39 mm<br>- Pas des lames: 34 mm<br>- Surface visuelle libre: 68%<br>- Surface physique libre: 35%<br>- Calcul de dimensionnement sur demande<br>- Moustiquaire INOX (AlSI 304) 2,3 x 2,3mm</div><div style="font-style: normal;"><br><b>Traitement de surface</b></div><div><b style="font-style: normal;"><br></b><i><u>Finition standard:</u></i><br>Anodisé ton naturel (F1) - Minimum 20 microns. <br>Variante pour l?anodisation ton naturel (F1) est le thermolaquage en RAL 9006 <br>Thermolaquage dans toutes les teintes RAL &nbsp;60 microns en moyenne.</div><div><br><i><u>Finition sur demande:</u></i><br>En cas de conditions extrêmes et milieux agressifs (littoral, environnement industriel, piscine) Thermolaquage dans toutes les teintes RAL <br>Anodisé ton naturel (F1) - Minimum 25 microns.<br></div>', 'Lame 65Z.pdf', 'null', '2014-11-14 17:17:27', 'en ligne'),
(4, 'Moteur Era M ', 6, 19, 'Era-M.jpg', '', 'Era-M.pdf', NULL, '2014-06-21 00:38:37', 'en ligne'),
(5, 'Moteur Neo L ', 6, 19, 'Neo-L.jpg', '', 'Neo-L.pdf', NULL, '2014-06-21 00:43:31', 'en ligne'),
(6, 'Era P', 6, 21, 'Era P1.jpg', '', NULL, NULL, '2014-06-21 00:55:21', 'en ligne'),
(7, 'Era MiniWay', 6, 21, 'MW2.jpg', '', NULL, NULL, '2014-06-21 00:56:12', 'en ligne');

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

CREATE TABLE IF NOT EXISTS `galerie` (
  `num_image` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(80) NOT NULL,
  PRIMARY KEY (`num_image`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=180 ;

--
-- Contenu de la table `galerie`
--

INSERT INTO `galerie` (`num_image`, `image`) VALUES
(5, 'F50_Accord_Round_Detail_02b.jpg'),
(7, 'F50_Horizon H-Rings_05_DETAIL.jpg'),
(8, 'F50_Horizon H-Rings_06_DETAIL.jpg'),
(9, 'F50_Horizon U_Rail Detail_01.jpg'),
(10, 'F50_Horizon U_Rail Detail_02.jpg'),
(11, 'F50_Horizon U_Rail.jpg'),
(13, 'F50_Horizon U-Rail_04_DETAIL.jpg'),
(14, 'F50_Horizon U-Rail_DETAIL_03.jpg'),
(16, 'F50_Horizon_A_detail_4168.jpg'),
(17, 'F50_skala_01_DETAIL_1.jpg'),
(18, 'F50_skala_01_DETAIL_2.jpg'),
(19, 'F50_SKALA_ST_B copy.jpg'),
(24, 'F50_SKALA_ST_DETAIL_02.jpg'),
(32, 'Crystal Line_F85_ENDO_TYPE_C_03.jpg'),
(33, 'Crystal Line_F85_EX_RESID_B_13.jpg'),
(34, 'Crystal Line_F85_EXOT_PROFIL_EXPLODE.jpg'),
(35, 'Crystal Line_Koup_A2.jpg'),
(36, 'Crystal Line_Koup_B2.jpg'),
(37, 'Crystal Line_KOUP_F85-451.jpg'),
(38, 'Crystal Line_koup_new.jpg'),
(40, 'Crystal Line_Type A.jpg'),
(41, 'Crystal Line_Type B_HotelRoom_01.jpg'),
(42, 'Crystal Line_Type B_Patio_01.jpg'),
(43, 'Crystal Line_Type C_Balcony_02.jpg'),
(44, 'Crystal Line_Type CU 3.jpg'),
(45, 'Crystal Line_Type CU.jpg'),
(46, 'Crystal Line_Type DS _03Detail.jpg'),
(47, 'Crystal Line_Type DS.jpg'),
(48, 'Crystal Line_Type DS_02.jpg'),
(49, 'Crystal Line_Type A F85_ED_HOTEL pose a la francaise.jpg'),
(50, 'Classic_01.jpg'),
(51, 'Classic_02.jpg'),
(52, 'AL 220.jpg'),
(57, 'AL 220_detail 2.jpg'),
(58, 'AL 220_detail 3.jpg'),
(63, 'AL 450_detail.jpg'),
(64, 'MR 34Z SM_gris 1.JPG'),
(65, 'MR 34Z SM_gris 2.JPG'),
(66, 'MR 34Z SM_gris 3.JPG'),
(67, 'MR 34Z SM_gris 4.JPG'),
(68, 'MR 34Z SM_gris 5.JPG'),
(69, 'MR 34Z SM_gris 6.JPG'),
(70, 'MR 34Z SM_noir 1.JPG'),
(71, 'MR 34Z SM_noir 2.JPG'),
(72, 'MR 34Z SM_noir 3.JPG'),
(73, 'MR 34Z FL_beige 1.JPG'),
(74, 'MR 34Z FL_beige 2.JPG'),
(75, 'MR 34Z FL_beige 3.JPG'),
(76, 'MR 34Z FL_beige.JPG'),
(77, 'MR 34Z FL_bleu 1.JPG'),
(78, 'MR 34Z FL_bleu 2.JPG'),
(79, 'MR 34Z FL_bleu 3.JPG'),
(80, 'MR 34Z FL_bleu.JPG'),
(81, 'MR 34Z FL_rouge 1.JPG'),
(82, 'MR 34Z FL_rouge.JPG'),
(83, 'MR 34Z FL_vert 1.JPG'),
(84, 'MR 34Z FL_vert.JPG'),
(85, 'Brise Soleil_1.JPG'),
(86, 'Brise Soleil_2.JPG'),
(87, 'Brise Soleil_3.JPG'),
(88, 'Brise Soleil_4.JPG'),
(89, 'Brise Soleil_5.JPG'),
(90, 'Brise Soleil_6.JPG'),
(91, 'Brise Soleil_7.jpg'),
(93, 'Screen_1.jpg'),
(94, 'Screen_2.jpg'),
(97, 'Screen_5.jpg'),
(98, 'Screen_6.jpg'),
(99, 'Screen_7.jpg'),
(101, 'Moteur Era M _Guide.jpg'),
(102, 'Moteur Era M _Photo Technique.jpg'),
(104, 'Moteur Neo L _Guide2.jpg'),
(105, 'Moteur Neo L _Photo-technique.jpg'),
(106, 'Era P_Guide.jpg'),
(107, 'Era P1.jpg'),
(108, 'Era P1S.jpg'),
(109, 'Era P6.jpg'),
(110, 'Era P6S.jpg'),
(111, 'Era MiniWay_1.jpg'),
(112, 'Era MiniWay_2.jpg'),
(113, 'Era MiniWay_3.jpg'),
(114, 'AL 200.png'),
(117, 'LM-55.jpg'),
(124, 'aa.jpg'),
(142, 'F50_Accord Escalier.jpg'),
(154, 'AL 450 (2).jpg'),
(155, 'LM 55 Silencieuse.jpg'),
(156, 'LM-60.jpg'),
(157, 'LM 60.jpg'),
(158, 'LM 757.jpg'),
(159, 'LM 100.jpg'),
(160, 'LM 55 Injectée.jpg'),
(161, 'LM 55  Injectée.jpg'),
(167, 'Screen 2.jpg'),
(169, 'F50 Accord Detail.jpg'),
(170, 'Moteur Era M.jpg'),
(174, 'Brises Soleil Fixes.jpg'),
(175, 'Brises Soleil Fixes 1.jpg'),
(176, 'Brises soleil coulissantes.jpg'),
(177, 'Brises soleil coulissantes 1.jpg'),
(178, 'Toiture de terrasse 2.jpg'),
(179, 'Toiture de terrasse.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `gamme_produit`
--

CREATE TABLE IF NOT EXISTS `gamme_produit` (
  `id_gamme` int(11) NOT NULL AUTO_INCREMENT,
  `nom_gamme` varchar(30) NOT NULL,
  `photo_ref` varchar(45) NOT NULL,
  `description` text,
  `fichetech` varchar(45) DEFAULT NULL,
  `video` varchar(45) DEFAULT NULL,
  `date` datetime NOT NULL,
  `etat` varchar(10) NOT NULL,
  PRIMARY KEY (`id_gamme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `gamme_produit`
--

INSERT INTO `gamme_produit` (`id_gamme`, `nom_gamme`, `photo_ref`, `description`, `fichetech`, `video`, `date`, `etat`) VALUES
(1, 'Profilés en aluminium', 'AL-220 1.jpg', '<span style="font-weight: normal;">Grâce à des systèmes de </span><b>profilés en aluminium</b> innovants et créatifs, Alluco offre des solutions sur mesure permettant l intégration dans tout espace architectural et unissant la sécurité, l esthétique, le confort et l économie d énergie.', 'null', 'null', '2014-12-02 12:53:30', 'en ligne'),
(2, 'Lames Volets', 'LM-55.jpg', '<span style="font-weight: normal;">A travers sa large gamme de produits, </span>Alluco vous apporte la solution "<b>lames &nbsp;volets &nbsp;en aluminium</b>" qui s adapte parfaitement à tout espace architectural ainsi que leurs accessoires: moteurs, coulisses, joints...<div style="font-weight: normal;"><br></div><div style="font-weight: normal;">Ses lames extrudées ou injectées avec mousse polyuréthane de haute densité, unissent la sécurité et le confort.</div>', 'lames volets-FINAL.pdf', 'null', '2014-12-02 12:50:23', 'en ligne'),
(3, 'Gardes Corps', 'Accord Escalier.jpg', 'Face<span style="font-weight: normal;"> à l évolution de l architecture de bâtiment, <font color="#3366ff">Alluco</font>, vous offre une large gamme de </span><b>garde corps en aluminium</b><span style="font-weight: normal;">,  qui </span><b style="font-weight: normal;">répond</b><span style="font-weight: normal;"> parfaitement à toutes vos exigences tout en respectant les spécificités de votre environnement.&nbsp;</span>', 'null', 'null', '2014-11-19 10:54:42', 'en ligne'),
(4, 'Protection Solaire', 'Protection Solaire.jpg', '', 'null', 'null', '2014-12-18 11:33:01', 'en ligne'),
(5, 'Grilles de Ventilation', 'MR34Z-FL.gif', '<span style="font-weight: normal;">Allergie, Cancer, Cardiopathie, et plusieurs autres maladies sont souvent dues à un air pollué.<br>A cet effet, Alluco vous apporte la solution de «Ventilation » qui vise à créer un climat intérieur sain et confortable.<br>Ses </span><b>grilles de ventilation</b>, en applique ou à encastrer,  ont comme critères principaux:<div style="font-weight: normal;"><br>- Le débit,</div><div style="font-weight: normal;"><br>- L étanchéité à l eau,</div><div style="font-weight: normal;"><br>- L esthétique</div>', 'null', 'null', '2014-11-19 12:22:34', 'en ligne'),
(6, 'Systèmes Nice', 'commande.jpg', '<p class="MsoNormal">Distributeur exclusif en Tunisie de la gamme Nice, Alluco\r\nvous offre un système d automatisation à la pointe de la technologie&nbsp; afin de rendre votre habitation unique, confortable\r\net sécurisante en un simple clic.&nbsp;</p>', 'null', 'null', '2014-09-13 11:07:25', 'en ligne'),
(7, 'Accessoires', 'arton50.jpg', '', 'null', 'null', '2014-09-13 08:35:31', 'hors ligne');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_message` datetime NOT NULL,
  `objet_mess` varchar(50) NOT NULL,
  `corp_mess` text NOT NULL,
  `numtele` varchar(20) NOT NULL,
  `Profession` varchar(15) DEFAULT NULL,
  `societe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_client` (`id_client`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `id_client`, `nom`, `prenom`, `email`, `date_message`, `objet_mess`, `corp_mess`, `numtele`, `Profession`, `societe`) VALUES
(1, NULL, 'braham', 'hamdi', 'hamdi.braham@gmail.com', '2014-11-12 11:24:22', 'test', 'test', '22832097', 'Autres', ''),
(2, NULL, 'Antonioei', 'AntonioeiOV', 'antonionoma@mail.ru', '2015-01-05 07:25:49', '', 'Great looking site. Assume you did a great deal of <a href=http://www.onlinecigarettestoreus.com/buy-cigarettes-from-mexico/>buy cigarettes from mexico</a> your very own  coding.', '123456', 'Architecte', 'Banking, mortgage'),
(3, NULL, 'janfaoui', 'houssem', 'hossjanfaoui@outlook.fr', '2015-03-07 15:38:22', 'demande d''information', 'salut ! s''il vous plait est ce que je peux avoir la fiche technique catalogue et profilÃ©s de porte pliante  et merci', '22999664', 'Menuisier', 'l''art d''alu'),
(4, NULL, '', '', '', '2015-03-26 15:36:43', '', 'fd', '', 'Architecte', ''),
(5, NULL, 'najjar', 'wael', 'w.najjarrr@gmail.com', '2015-04-08 21:43:08', 'demande de reccrutment', 'responsable commercial client revendeur (tpr)', '53100101', 'Autres', 'TPR'),
(6, NULL, 'Bouchehda', 'Hasna', 'boucheha.hasna@gmail.com', '2015-04-10 15:31:46', 'Demande d''emploi', 'Bonsoir;\r\nJe voudrais savoir si vous acceptÃ© des candidatures libre afin que je puisse postuler mes documents.\r\nMerci d''avance', '28451288', 'Autres', '');

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE IF NOT EXISTS `partenaire` (
  `num_part` int(11) NOT NULL AUTO_INCREMENT,
  `photo_part` varchar(40) NOT NULL,
  PRIMARY KEY (`num_part`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `partenaire`
--

INSERT INTO `partenaire` (`num_part`, `photo_part`) VALUES
(4, 'alllll.jpg'),
(5, 'Nice3alle5er.jpg'),
(6, 'SDC.jpg'),
(7, 'SIBOALL .jpg');

-- --------------------------------------------------------

--
-- Structure de la table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `num_ph` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  PRIMARY KEY (`num_ph`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `slider`
--

INSERT INTO `slider` (`num_ph`, `image`) VALUES
(6, 'accord.jpg'),
(14, 'Brise Soleil_6.JPG'),
(20, 'baniere2.jpg'),
(21, 'cryc2u.jpg'),
(22, 'F50 Horizon.jpg'),
(23, 'F50 Vertical.jpg'),
(24, 'baniere1.jpg'),
(27, 'proooooh.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sous_produit`
--

CREATE TABLE IF NOT EXISTS `sous_produit` (
  `id_sousprod` int(11) NOT NULL AUTO_INCREMENT,
  `id_gamme` int(11) NOT NULL,
  `nom_sous_prod` varchar(30) NOT NULL,
  `photo_ref` varchar(45) NOT NULL,
  `description` text,
  `fichetech` varchar(45) DEFAULT NULL,
  `video` varchar(45) DEFAULT NULL,
  `date` datetime NOT NULL,
  `etat` varchar(10) NOT NULL,
  `tableau1` varchar(50) DEFAULT NULL,
  `tableau2` varchar(50) DEFAULT NULL,
  `ph_technique` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sousprod`),
  KEY `id_gamme` (`id_gamme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `sous_produit`
--

INSERT INTO `sous_produit` (`id_sousprod`, `id_gamme`, `nom_sous_prod`, `photo_ref`, `description`, `fichetech`, `video`, `date`, `etat`, `tableau1`, `tableau2`, `ph_technique`) VALUES
(4, 2, 'LM 55 Silencieuse', 'LM-55.jpg', '<span style="font-weight: normal;">Porte de sécurité en </span><b>lames aluminium extrudées</b> avec profil pvc en partie haute et basse. Réduction du bruit lors de l enroulement du tablier.<div style="font-weight: normal;"><br></div>', 'LM 55.pdf', 'null', '2014-11-12 17:11:19', 'en ligne', '55.jpg', '55diametre.jpg', 'lm55.jpg'),
(5, 2, 'LM 60', 'LM-60.jpg', 'Porte enroulable composée de lames Aluminium extrudées optimisant l enroulement dans un espace réduit', 'LM 60 silencieuse.pdf', 'null', '2014-07-08 03:19:44', 'en ligne', '60caractech.jpg', '60diame.jpg', '60.jpg'),
(6, 2, 'LM 757', 'LM-757.jpg', 'Profilé d aluminium extrudé avec système autobloquant (profiles S),<div>fonction anti soulévement.</div>', 'LM 757.pdf', 'null', '2014-11-12 16:57:42', 'en ligne', '757caractech.jpg', '757diam.jpg', '757.jpg'),
(7, 2, 'LM 100', 'LM-100.jpg', '-Lame volet roulant recommandée pour la sécurité et l esthétisme,<div>-Se décline en lames micro-perforées pour ventiler ou en lames hublot avec plexiglass</div>', 'LM 100.pdf', 'null', '2014-11-12 17:10:40', 'en ligne', '100caractech.jpg', '100diam.jpg', '100.jpg'),
(8, 2, 'LM 55 Injectée', 'LM-INJ-55.jpg', '-Lame Injectée avec mousse Polyuréthane,<div>-Assurer une isolation thermique et phonique.&nbsp;</div>', 'LM 55 injecte.pdf', 'null', '2014-07-08 03:21:17', 'en ligne', '55injectecaractech.jpg', '55injectediam.jpg', '55injecte.jpg'),
(9, 3, 'F50', 'Accord Escalier.jpg', '<p class="MsoNormal" style="text-align: justify; text-indent: 14.2pt;">Le système de\r\ngarde corps «&nbsp;F50&nbsp;» est un système de profilés en aluminium soumis à\r\nun procédé d <b>anodisation d une épaisseur</b> <b>de 20 micron</b>s caractérisée par une\r\nhaute qualité et un luisant unique. De cette manière, ces garde corps offrent\r\ndes avantages aptes devant les systèmes d acier inoxydable&nbsp;: une haute\r\nesthétique et une économie plus importante.</p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal; text-align: justify; text-indent: 14.2pt;">La gamme de\r\nF50 Railing System est très large et peut être appliquée dans tout espace\r\narchitectural&nbsp;:</p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal; margin-bottom: 0.0001pt; text-align: justify; text-indent: 14.2pt;">- Des\r\ngarde-corps pour des balcons et des escaliers extérieurs, avec une apparence distinguée\r\net une résistance spéciale aux conditions environnementales diverses. </p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal; margin-bottom: 0.0001pt; text-align: justify;">Ils sont adéquats pour\r\ndes résidences modernes, des édifices Commerciaux et &nbsp;professionnels.</p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal; margin-bottom: 0.0001pt; text-align: justify; text-indent: 14.2pt;"><o:p>&nbsp;</o:p></p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal; margin-bottom: 0.0001pt; text-align: justify; text-indent: 14.2pt;">- Des\r\ngarde-corps pour des escaliers intérieurs et des planchers de résidences et\r\nd?espaces professionnels et de loisir (comme des hôtels, des restaurants, ...)\r\nqui donnent une sensation d haute esthétique dans l espace.</p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal;"><o:p>&nbsp;</o:p></p>', 'Garde Corps F50.pdf', 'null', '2014-11-12 17:23:20', 'en ligne', 'null', 'null', 'null'),
(10, 3, 'Crystal Line', 'Crystal LineType C2U.jpg', '<span style="font-weight: normal;">Le système </span><b>Crystal line</b><span style="font-weight: normal;"> est idéal pour des applications à des balcons et des escaliers ayant des exigences architecturales élevées.<br>Il offre un résultat impressionnant en matière d"esthétique et de fonctionnement, sans limiter la vue et il est facile à entretenir.<br> Il est conçu et fabriqué selon les normes UNI EN </span><b>10807 &amp; NF P01-013.</b> <br><br>Le système <b>Crystal line</b> est disponible en 3 modèles principaux : Apparent (Pose à la française), Encastré, Externe (pose en applique). Chacun des modèles peut avoir d"autres applications. <br>Il peut être placé sur un parapet ou sur un sol final avec un vitrage de 16 ou 20mm (triplex, securit) d épaisseur. La base du système est couverte par des caches latéraux permettant le remplacement du vitrage sans détériorer le système ou le sol final.&nbsp;<br>', 'Garde Corps Crystal_line.pdf', 'null', '2014-11-19 16:11:44', 'en ligne', 'null', 'null', 'null'),
(11, 3, 'Classic', 'Classic_02.jpg', 'Nos  gardes corps traditionnels en aluminium sont issus d une gamme très variée de modèles en alliage aluminium durables et respectant les propriétés anticorrosion.<br>Ils sont accompagnés d"une multitude d accessoires offrant des solutions pour de multiples structures. <br>Ils sont certifiés selon les normes Internationales, pour vous assurer une sécurité maximale et un résultat de qualité pour toutes les constructions.<br>Ce système s"applique sur des balcons, des clôtures ou des rampants intérieurs et extérieurs, en répondant à tout projet d"installation. Résistants au passage du temps, ils ne nécessitent pas d"entretien spécial, car leur surface est déjà traitée contre la salinité (seaside class).&nbsp;<br>', 'null', 'null', '2014-09-12 14:27:13', 'hors ligne', 'null', 'null', 'null'),
(12, 4, 'Brises Soleil', 'Brises Soleil.jpg', '<span style="font-weight: normal;"><span style="font-weight: normal;"><br>Les grandes surfaces vitrées peuvent mener à des situations inconfortables comme la surchauffe ou l aveuglement dû à trop de lumière.<br>Afin de créer un environnement agréable, où la lumière naturelle est contrôlée et le contact visuel avec l extérieur est préservé, Alluco vous offre des systèmes de </span><b>brises soleil en aluminium</b> qui peuvent être installés, sur vos façades,</span><b> fixes ou coulissants.&nbsp;</b><br>Ces systèmes de  <b style="font-weight: normal;">protections solaires</b> sont développés par <b style="font-weight: normal;">des profilés en aluminium extrudés</b> ouverts :&nbsp;<div style="font-weight: normal;"><br>- Lame C : Lames, en forme convexe<br>- Lame Z : Lames apportant une efficacité d occultation maximum.<br></div>', 'null', 'null', '2014-12-16 11:06:29', 'en ligne', 'null', 'null', 'null'),
(13, 4, 'Screen', 'Screen_6.jpg', 'Parce que toute nouvelle tendance se traduit par un produit, Alluco lance un nouveau concept de protection solaire "Fixscreen".<div>Unissant le confort et le design séduisant, le "Fixscreen" vous offre une atmosphère agréable et royale. </div>', 'Screen.pdf', 'null', '2014-11-11 09:44:15', 'en ligne', 'null', 'null', 'null'),
(14, 4, 'Toiture de Terrasse', 'Algarve .jpg', '<p class="MsoNormal" style="font-weight: normal;">A travers sa gamme royale de toiture de terrasse, Alluco\r\nvous invite à profiter de votre extérieur, le jour comme la nuit, à tout moment\r\nde l année.</p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal;">Elle s intègre dans des styles architecturaux contemporains\r\nou classiques en assurant un design splendide et séduisant.</p>\r\n\r\n<p class="MsoNormal">Conçue par des<b> lames en aluminium extrudées et orientables,</b> &nbsp;&nbsp;l Algarve\r\noffre un confort&nbsp; physique, thermique et\r\nvisuel.</p>\r\n\r\n<p class="MsoNormal" style="font-weight: normal;">En position fermée, ses lames forment une toiture étanche en\r\ncas de pluie une gouttière permet d évacuer l eau vers les colonnes.&nbsp;</p>', 'null', 'null', '2014-12-19 08:51:22', 'en ligne', 'null', 'null', 'null'),
(15, 5, 'Grille à poser en applique', 'MR34Z-SM.gif', '<b style="font-style: normal;">Données techniques</b><div style="font-weight: normal; font-style: normal;">-Profilé en aluminium extrudé EN AW-6060 T66 (AlMgSi0,5 F22)<br>-Epaisseur profilé : min. 1,1 mm<br>-Hauteur de lame : 39 mm<br>-Pas de lame : 34 mm<br>-Epaisseur : 36 mm<br>-Surface visuelle libre : 68 %<br>-Surface physique libre : 35 %<br>-Calcul de dimension sur demande.<br>-Moustiquaire RVS (AISI 304) 2,3 x 2,3 mm<br>-Renfort supplémentaire nécessaire si la largeur de la grille excède les 700 mm</div><div style="font-weight: normal;"><br><b style="font-style: normal;">Traitement de surface</b><br><i>Finition standard:</i><br>Anodisé ton naturel (F1) - Minimum 20 microns. <br>Variante pour l"anodisation ton naturel (F1) est le thermolaquage en RAL 9006 <br>Thermolaquage dans toutes les teintes RAL &nbsp;- 60 microns en moyenne.<div><br><i>Finition sur demande:</i></div><div style="font-style: normal; font-weight: normal;">En cas de conditions extrêmes et milieux agressifs (littoral, environnement industriel, piscine,) Thermolaquage dans toutes les teintes RAL&nbsp;</div><div style="font-style: normal; font-weight: normal;">Anodisé ton naturel (F1) - Minimum 25 microns.</div><div style="font-style: normal; font-weight: normal;"><br><b>Montage:</b></div><div style="font-style: normal; font-weight: normal;">A l"aide des accessoires prévus lors de la livraison<br>Formes<br>Rectangulaire, rond, carré<br>Applications<br>Brise vue, occultation, ventilation intense<br>Modalités de commande<br>Dimension : largeur (L) x hauteur (H)<br>Quantité<br>Finition souhaitée (F1, couleur RAL)<br>Options<br>Treillis galvanisé 6,3 x 6,3 mm<br></div></div>', 'En applique.pdf', 'null', '2014-11-12 14:23:23', 'en ligne', 'null', 'null', 'null'),
(16, 5, 'Grille à encastrer    ', 'fl.jpg', '<b style="font-style: normal;">Données techniques</b><br>-Profilé en aluminium extrudé EN AW-6060 T66 (AlMgSi0,5 F22)<br>-Epaisseur de profil : min. 1,1 mm<br>-Hauteur de lame : 39 mm<br>-Pas des lames : 34 mm<br>-Profondeur d"encastrement : 30,6 mm<br>-Recouvrement du cadre : 20,8 mm <br>-Surface visuelle libre : 68 %<br>-Surface physique libre : 35 %<br>-Calcul de dimension sur demande..<br>-Moustiquaire INOX (AISI 304) 2,3 x 2,3 mm<br>-Renfort supplémentaire nécessaire si la largeur de la grille est supérieure à 500 mm<div><br><b style="font-style: normal;">Traitement de surface</b><br><i>Finition standard:</i><br>Anodisé ton naturel (F1) - Minimum 20 microns. <br>Variante pour l"anodisation ton naturel (F1) est le thermolaquage en RAL 9006 <br>Thermolaquage dans toutes les teintes RAL- 60 microns en moyenne.<br><i>Finition sur demande:</i><br>En cas de conditions extrêmes et milieux agressifs (littoral, environnement industriel, piscine,) Thermolaquage dans toutes les teintes RAL <br>Anodisé ton naturel (F1) - Minimum 25 microns.</div><div><br><b>Fixation</b><br>Doguets sur demande</div><div><br><b>Applications</b><br>Rectangulaire, ronde, carrée</div><div><br><b>Applications</b><br>Apport et extraction d air<br><br><br><b>Modalités de commande</b><br>Dimensions : largeur (L) x hauteur (H)&nbsp;</div><div><br><b>Quantité</b><br>Finition souhaitée (F1, couleur RAL)<br></div>', 'Encastrer.pdf', 'null', '2014-11-12 15:11:23', 'en ligne', 'null', 'null', 'null'),
(17, 7, 'Giesses', '', '', 'null', 'null', '2014-06-21 01:02:16', 'hors ligne', NULL, NULL, NULL),
(18, 7, 'Alluco', '', '', 'null', 'null', '2014-06-21 01:02:36', 'hors ligne', NULL, NULL, NULL),
(19, 6, 'Moteurs Nice ', 'Era-M.jpg', 'Grâce aux Moteurs Tubulaires « Nice», Alluco vous offre un maximum de confort, économie d énergie, et sécurité.<div><br><b>Avantages :</b></div><div><b><br></b>- Simple et pratique : réglage simple des positions limites de montée et de descente grâce à la fin de course mécanique.<br>- Facile à installer grâce à la tête compacte.<br></div>', 'null', 'null', '2014-09-13 11:09:57', 'en ligne', 'null', 'null', 'null'),
(20, 1, 'AL 220', 'AL-220 1.jpg', 'C est un système coulissant à rupture de pont thermique exceptionnellement flexible et glissant. Ses qualités ont font le choix idéal pour de nombreuses applications architecturales. Il offre une imperméabilité absolue grâce à ses joints spéciaux péri métriques, isolation thermique, isolation acoustique et sécurité maximale avec des serrures multiples. Il peut supporter le poids du verre, jusqu à 200 kg, par châssis et inclut l élévation et du mécanisme pour faciliter la manipulation et le bon fonctionnement. En option, il peut être utilisé comme un système de coulissement simple avec des roues conventionnelles.<div style="font-style: normal;"><br></div><div><p class="MsoNormal" style="margin-bottom: 0.0001pt;"><u><b>Les\r\ncaractéristiques techniques</b><span style="font-size: 10pt; color: rgb(79, 126, 144);">&nbsp;:</span></u></p><p class="MsoNormal" style="margin-bottom: 0.0001pt;">- Largeur du châssis : 45mm<br>- Dimensions de double rail : hauteur 48,9mm / largeur 115mm<br>- Polyamide : 32mm<br></p>\r\n\r\n</div>', 'AL 220 FT.pdf', 'null', '2014-11-12 10:04:04', 'en ligne', 'null', 'null', 'null'),
(21, 6, 'Emetteurs', 'Era +MiniWay.jpg', 'Les émetteurs Era vous offre la solution idéale pour le pilotage des systèmes multiutilisateurs en toute simplicité.', NULL, NULL, '2014-06-21 00:53:14', 'en ligne', NULL, NULL, NULL),
(33, 1, 'AL 450', 'AL 450.jpg', '<p class="MsoNormal"><span style="font-size:10.0pt;line-height:115%;mso-bidi-font-family:\r\nCalibri;mso-bidi-theme-font:minor-latin;mso-bidi-font-weight:bold">C est un\r\nsystème oscillo battant à rupture de pont thermique de haute performance\r\noffrant une sécurité absolue par moyen d''un blocage péri métrique.<o:p></o:p></span></p>\r\n\r\n<p class="MsoNormal"><span style="font-size:10.0pt;line-height:115%;mso-bidi-font-family:\r\nCalibri;mso-bidi-theme-font:minor-latin;mso-bidi-font-weight:bold">La série\r\ndonne la possibilité de construire des bases de conditions météorologiques\r\ndéfavorables grâce à l''utilisation de polyamides spécialement renforcé 24mm.<o:p></o:p></span></p>\r\n\r\n<p class="MsoNormal"><span style="font-size:10.0pt;line-height:115%;mso-bidi-font-family:\r\nCalibri;mso-bidi-theme-font:minor-latin;mso-bidi-font-weight:bold">La sécurité\r\nmaximale fournit par l''utilisation de multiples fermetures combinées avec la\r\nhaute performance de l''isolation thermique et acoustique garantit une\r\nexcellente qualité, la fonctionnalité et l''économie d''énergie significative&nbsp; <o:p></o:p></span></p>\r\n\r\n<p class="MsoNormal" style="margin-bottom: 0.0001pt;"><b>&nbsp;</b></p>\r\n\r\n<p class="MsoNormal" style="margin-bottom: 0.0001pt;"><b>&nbsp;</b></p>\r\n\r\n<p class="MsoNormal" style="margin-bottom: 0.0001pt;"><b>Les caractéristiques\r\ntechniques:<o:p></o:p></b></p>\r\n\r\n<ul type="disc">\r\n <li class="MsoNormal"><span style="font-size:10.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\n     mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin;mso-fareast-language:\r\n     FR">Largeur du battant 67mm<o:p></o:p></span></li>\r\n <li class="MsoNormal"><span style="font-size:10.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\n     mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin;mso-fareast-language:\r\n     FR">Largeur minimale du dormant 59.5mm<o:p></o:p></span></li>\r\n <li class="MsoNormal"><span style="font-size:10.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\n     mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin;mso-fareast-language:\r\n     FR">Du vitrage jusqu''à 44mm<o:p></o:p></span></li>\r\n <li class="MsoNormal"><span style="font-size:10.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;\r\n     mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin;mso-fareast-language:\r\n     FR">Polyamide d?origine allemande de 24&nbsp;<o:p></o:p></span></li>\r\n</ul>', 'AL 450 FT.pdf', NULL, '2014-11-12 15:27:30', 'en ligne', NULL, NULL, NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `accesoire`
--
ALTER TABLE `accesoire`
  ADD CONSTRAINT `accesoire_ibfk_1` FOREIGN KEY (`id_gamme`) REFERENCES `gamme_produit` (`id_gamme`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE;

--
-- Contraintes pour la table `complément_sous_produit`
--
ALTER TABLE `complément_sous_produit`
  ADD CONSTRAINT `compl@0pment_sous_produit_ibfk_1` FOREIGN KEY (`id_gamme`) REFERENCES `gamme_produit` (`id_gamme`) ON DELETE CASCADE,
  ADD CONSTRAINT `compl@0pment_sous_produit_ibfk_3` FOREIGN KEY (`id_sousprod`) REFERENCES `sous_produit` (`id_sousprod`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sous_produit`
--
ALTER TABLE `sous_produit`
  ADD CONSTRAINT `sous_produit_ibfk_1` FOREIGN KEY (`id_gamme`) REFERENCES `gamme_produit` (`id_gamme`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
