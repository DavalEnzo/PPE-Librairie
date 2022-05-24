-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 24 mai 2022 à 10:18
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
-- Base de données : `bibliotheque`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `insert_livre_with_auteur`$$
CREATE  PROCEDURE `insert_livre_with_auteur` ()  BEGIN
	INSERT INTO ecrit (idAuteur, idLivre) VALUES ((SELECT max(idAuteur) FROM auteurs),(SELECT max(idLivre) FROM bibliotheque));
END$$

DROP PROCEDURE IF EXISTS `select_allComs_user`$$
CREATE  PROCEDURE `select_allComs_user` (IN `p_idUtilisateur` INT)  BEGIN
	SELECT c.*, u.nom, u.prenom, u.photoProfile, u.idUtilisateur, b.Titre  FROM commentaires AS c LEFT JOIN utilisateurs as u on u.idUtilisateur = c.idUtilisateur LEFT JOIN livres as b on c.idLivre = b.idLivre Where c.idUtilisateur = p_idUtilisateur ORDER BY c.date_heure;
END$$

DROP PROCEDURE IF EXISTS `select_commentaires_by_user_and_livre`$$
CREATE  PROCEDURE `select_commentaires_by_user_and_livre` (IN `p_idLivre` INT)  BEGIN
	SELECT c.*, u.nom, u.prenom, u.photoProfile, u.idUtilisateur  FROM commentaires AS c LEFT JOIN utilisateurs as u on u.idUtilisateur = c.idUtilisateur Where c.idLivre = p_idLivre ORDER BY c.date_heure;
END$$

DROP PROCEDURE IF EXISTS `select_commentaires_non_approuve`$$
CREATE  PROCEDURE `select_commentaires_non_approuve` ()  BEGIN

	SELECT idCommentaire, contenu, CONCAT(CONCAT(utilisateurs.prenom, ' '), utilisateurs.nom) AS utilisateur, bibliotheque.Titre, commentaires.date_heure, verif FROM `commentaires` LEFT JOIN bibliotheque USING (idLivre) LEFT JOIN utilisateurs USING (idUtilisateur) WHERE verif = 0;
    
END$$

DROP PROCEDURE IF EXISTS `select_genre_with_livre_and_auteur`$$
CREATE  PROCEDURE `select_genre_with_livre_and_auteur` (`p_idGenre` INT)  BEGIN
	SELECT * FROM genres INNER JOIN bibliotheque USING(idGenre) LEFT JOIN ecrit USING(idLivre) WHERE idGenre = p_idGenre;
END$$

DROP PROCEDURE IF EXISTS `select_panier`$$
CREATE  PROCEDURE `select_panier` (IN `p_idPanier` INT, IN `p_idUtilisateur` INT)  BEGIN
	SELECT *, editeurs.nom as nomEditeur FROM paniers INNER JOIN stockage USING (idPanier) INNER JOIN livres ON stockage.idLivre = livres.idLivre INNER JOIN editeurs ON livres.idEditeur = 					editeurs.idEditeur INNER JOIN utilisateurs USING (idUtilisateur) WHERE idPanier = p_idPanier AND idUtilisateur = p_idUtilisateur;
END$$

DROP PROCEDURE IF EXISTS `verif_commentaire`$$
CREATE  PROCEDURE `verif_commentaire` ()  BEGIN

	DECLARE nbComms INT DEFAULT 0;

	SELECT COUNT(*) INTO nbComms
	FROM commentaires WHERE verif = 0;
    
        CASE nbComms
            WHEN 0 THEN
                SELECT 0;
            ELSE
                SELECT nbComms;
        END CASE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `access_logs`
--

DROP TABLE IF EXISTS `access_logs`;
CREATE TABLE IF NOT EXISTS `access_logs` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `access_logs`
--

INSERT INTO `access_logs` (`idLog`, `idUtilisateur`, `ip`, `date`) VALUES
(1, 1, '::1', '2022-03-17 09:42:58'),
(2, 1, '::1', '2022-03-17 09:44:11'),
(3, 1, '::1', '2022-03-17 09:57:31'),
(4, 1, '::1', '2022-03-17 09:58:45'),
(5, 1, '::1', '2022-03-17 09:59:20'),
(6, 1, '::1', '2022-03-17 10:29:15'),
(7, 1, '::1', '2022-03-17 10:31:33'),
(8, 1, '::1', '2022-03-17 11:00:50'),
(9, 1, '::1', '2022-03-17 11:01:18'),
(10, 1, '::1', '2022-03-17 11:01:28'),
(11, 1, '::1', '2022-03-17 11:01:43'),
(12, 1, '::1', '2022-03-17 11:02:06'),
(13, 1, '::1', '2022-03-17 11:02:32'),
(14, 1, '::1', '2022-03-17 11:07:41'),
(15, 1, '::1', '2022-03-17 11:07:53'),
(16, 1, '::1', '2022-03-17 11:08:21'),
(17, 1, '::1', '2022-03-17 11:08:34'),
(18, 1, '::1', '2022-03-17 11:09:43'),
(19, 1, '::1', '2022-03-17 11:10:36'),
(20, 1, '::1', '2022-03-17 11:44:19'),
(21, 1, '::1', '2022-03-17 11:46:15'),
(22, 1, '::1', '2022-03-17 11:47:50'),
(23, 1, '::1', '2022-03-17 12:20:51'),
(24, 1, '::1', '2022-03-17 12:26:39'),
(25, 1, '::1', '2022-03-17 12:27:28'),
(26, 1, '::1', '2022-03-17 12:28:38'),
(27, 1, '::1', '2022-03-17 12:56:21'),
(28, 1, '::1', '2022-03-17 12:58:10'),
(29, 1, '::1', '2022-03-17 12:58:22'),
(30, 1, '::1', '2022-03-17 13:00:04'),
(31, 1, '::1', '2022-03-17 13:00:40'),
(32, 1, '::1', '2022-03-17 15:01:43'),
(33, 20, '::1', '2022-03-17 15:53:30'),
(34, 20, '::1', '2022-03-17 15:53:56'),
(35, 20, '::1', '2022-03-17 15:57:11'),
(36, 1, '::1', '2022-03-17 15:57:40'),
(37, 1, '::1', '2022-03-17 16:35:56'),
(38, 1, '::1', '2022-03-17 17:50:54'),
(39, 1, '::1', '2022-03-17 17:53:48'),
(40, 1, '::1', '2022-03-17 17:57:07'),
(41, 1, '::1', '2022-03-18 10:51:26'),
(42, 1, '::1', '2022-03-18 10:52:04'),
(43, 1, '::1', '2022-03-18 10:52:30'),
(44, 1, '::1', '2022-03-18 11:03:48'),
(45, 1, '::1', '2022-03-18 11:05:09'),
(46, 1, '::1', '2022-03-18 11:06:06'),
(47, 1, '::1', '2022-03-18 11:06:56'),
(48, 1, '::1', '2022-03-29 11:33:02'),
(49, 23, '127.0.0.1', '2022-03-29 12:25:45'),
(50, 23, '::1', '2022-03-29 17:14:18'),
(51, 23, '127.0.0.1', '2022-03-31 09:33:19'),
(52, 23, '::1', '2022-03-31 09:34:30'),
(53, 23, '127.0.0.1', '2022-03-31 09:37:01'),
(54, 23, '127.0.0.1', '2022-03-31 09:54:54'),
(55, 23, '127.0.0.1', '2022-03-31 09:55:01'),
(56, 23, '127.0.0.1', '2022-04-14 11:21:56'),
(57, 20, '127.0.0.1', '2022-04-14 14:24:09'),
(58, 20, '127.0.0.1', '2022-04-14 15:06:37'),
(59, 20, '127.0.0.1', '2022-04-14 16:46:26'),
(60, 24, '::1', '2022-05-24 09:21:17'),
(61, 1, '::1', '2022-05-24 09:21:33'),
(62, 24, '::1', '2022-05-24 09:48:13'),
(63, 1, '::1', '2022-05-24 09:48:26'),
(64, 1, '::1', '2022-05-24 09:52:54'),
(65, 24, '::1', '2022-05-24 10:01:44'),
(66, 1, '::1', '2022-05-24 10:01:52'),
(67, 1, '::1', '2022-05-24 10:02:18'),
(68, 1, '::1', '2022-05-24 10:02:56'),
(69, 1, '::1', '2022-05-24 10:03:51');

--
-- Déclencheurs `access_logs`
--
DROP TRIGGER IF EXISTS `delete_tentatives_connexion_after_insert_access_logs`;
DELIMITER $$
CREATE TRIGGER `delete_tentatives_connexion_after_insert_access_logs` AFTER INSERT ON `access_logs` FOR EACH ROW BEGIN
DELETE FROM tentatives_connexion WHERE ip = new.ip;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `idAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `codePostal` int(10) NOT NULL,
  `complementAdresse` varchar(50) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idAdresse`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`idAdresse`, `libelle`, `ville`, `codePostal`, `complementAdresse`, `idUtilisateur`) VALUES
(1, '39 rue henri dunant', 'Guyancourt', 78280, '', 1),
(2, 'dufhzefzofzfzfz', 'Montigny le Bretonneux', 78180, '', 1),
(4, '2 Rue Erik Satie', 'Guyancourt', 78280, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `allowed_ips`
--

DROP TABLE IF EXISTS `allowed_ips`;
CREATE TABLE IF NOT EXISTS `allowed_ips` (
  `idUtilisateur` int(11) NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `allowed_ips`
--

INSERT INTO `allowed_ips` (`idUtilisateur`, `ip`) VALUES
(1, '::1'),
(20, '127.0.0.1');

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

DROP TABLE IF EXISTS `auteurs`;
CREATE TABLE IF NOT EXISTS `auteurs` (
  `idAuteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`idAuteur`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `auteurs`
--

INSERT INTO `auteurs` (`idAuteur`, `nom`) VALUES
(1, 'Hélène De Fougerolles'),
(2, 'Margaux Rol '),
(3, ' 	Céline Malvo'),
(21, 'Marivaux'),
(19, 'Émile Zola'),
(18, 'Marcel Proust'),
(16, 'Guy de Maupassant'),
(17, 'Victor Hugo'),
(22, 'Etienne de la boetie'),
(23, 'Karen M. McManus'),
(24, 'J.R.R. Tolkien'),
(25, 'Sun Tzu'),
(32, 'Paul Verlaine');

-- --------------------------------------------------------

--
-- Structure de la table `banned_ips`
--

DROP TABLE IF EXISTS `banned_ips`;
CREATE TABLE IF NOT EXISTS `banned_ips` (
  `idBannedIp` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`idBannedIp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `idPanier` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `prixTotal` int(11) NOT NULL,
  `idAdresse` int(11) NOT NULL,
  `dateCommande` date NOT NULL,
  `dateLivraison` date NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCommande`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `idPanier`, `idUtilisateur`, `prixTotal`, `idAdresse`, `dateCommande`, `dateLivraison`, `statut`) VALUES
(1, 9, 1, 18, 1, '2022-05-24', '2022-06-03', 3);

--
-- Déclencheurs `commandes`
--
DROP TRIGGER IF EXISTS `delete_detailcommandes_after_delete_commande`;
DELIMITER $$
CREATE TRIGGER `delete_detailcommandes_after_delete_commande` AFTER DELETE ON `commandes` FOR EACH ROW BEGIN
DELETE FROM detailcommandes WHERE old.idCommande = detailcommandes.idCommande;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text NOT NULL,
  `entete` varchar(100) DEFAULT NULL,
  `grade` int(1) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idLivre` int(11) NOT NULL,
  `date_heure` datetime NOT NULL,
  `verif` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCommentaire`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`idCommentaire`, `contenu`, `entete`, `grade`, `idUtilisateur`, `idLivre`, `date_heure`, `verif`) VALUES
(1, '                erezrtzergzerg', 'Je suis pas content !', 4, 1, 1, '2021-03-05 12:39:32', 1),
(2, 'Laissez moi vous expliquez pourquoi ce livre est le livre de la décennie apres le livre de didier.\r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. Vel blanditiis ipsa dolorem reiciendis officia dicta, ad vitae at explicabo ducimus delectus alias tenetur, rerum repellendus ea commodi architecto itaque voluptates!', 't\'inquiète pas, maman ! meilleur livre de la décennie', 5, 12, 1, '2021-11-18 16:51:06', 1),
(17, 'Je suis choqué et déçu. ', 'Une promotion de la WOKE nation', 2, 20, 3, '2022-02-15 15:52:47', 1),
(16, 'Franchement deçu de ce livre.', 'C\'est pas fou', 1, 20, 1, '2022-02-15 14:24:58', 1),
(18, 'La vie de oim c INSANE !!', 'Quel discours !', 5, 20, 28, '2022-02-17 12:43:53', 1),
(19, 'Tendre ,émouvant ,drôle, sincère.\r\nOn a envie de la connaître cette petite Camille!\r\n                    ', 'Excellente découverte ! ', 5, 23, 1, '2022-03-31 10:51:15', 1),
(20, 'Ce livre ma permis de changer la façon de voir la femme. ', 'Une véritable révélation ! ', 5, 23, 3, '2022-03-31 10:58:50', 1),
(23, 'Paul verlaine chose to speak facts !', 'FACTS !', 5, 23, 43, '2022-03-31 17:40:31', 0),
(24, 'Je suis très surpris que ce livre ne soit pas mieux référencé sur ce site malgré la qualité de son scénario et de sa plume !', 'Les deux tours !!! Un CLassique !!', 5, 20, 36, '2022-04-14 14:28:14', 1);

-- --------------------------------------------------------

--
-- Structure de la table `detailcommandes`
--

DROP TABLE IF EXISTS `detailcommandes`;
CREATE TABLE IF NOT EXISTS `detailcommandes` (
  `idDetailCommande` int(11) NOT NULL AUTO_INCREMENT,
  `idCommande` int(11) NOT NULL,
  `idLivre` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idDetailCommande`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `detailcommandes`
--

INSERT INTO `detailcommandes` (`idDetailCommande`, `idCommande`, `idLivre`, `quantite`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ecrit`
--

DROP TABLE IF EXISTS `ecrit`;
CREATE TABLE IF NOT EXISTS `ecrit` (
  `idEcrit` int(11) NOT NULL AUTO_INCREMENT,
  `idAuteur` int(11) NOT NULL,
  `idLivre` int(11) NOT NULL,
  PRIMARY KEY (`idEcrit`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ecrit`
--

INSERT INTO `ecrit` (`idEcrit`, `idAuteur`, `idLivre`) VALUES
(1, 2, 3),
(2, 3, 3),
(3, 1, 1),
(4, 16, 19),
(5, 17, 20),
(6, 18, 21),
(7, 19, 22),
(8, 17, 23),
(13, 22, 28),
(10, 18, 25),
(11, 21, 26),
(14, 23, 29),
(15, 24, 30),
(16, 25, 31),
(17, 24, 32),
(18, 24, 33),
(19, 24, 34),
(20, 24, 35),
(21, 24, 36),
(28, 32, 43);

-- --------------------------------------------------------

--
-- Structure de la table `editeurs`
--

DROP TABLE IF EXISTS `editeurs`;
CREATE TABLE IF NOT EXISTS `editeurs` (
  `idEditeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`idEditeur`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `editeurs`
--

INSERT INTO `editeurs` (`idEditeur`, `nom`) VALUES
(1, 'Fayard'),
(2, 'Michel Lafon'),
(3, 'Bossard'),
(4, 'Nathan Jeunesse'),
(5, 'Pocket'),
(6, 'Indé'),
(7, 'Albin Michel');

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `idGenre` int(11) NOT NULL AUTO_INCREMENT,
  `nomGenre` varchar(100) NOT NULL,
  `imgGenre` varchar(500) NOT NULL DEFAULT 'https://www.mesopinions.com/public/img/petition/petition-img-90900-fr.jpeg',
  PRIMARY KEY (`idGenre`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`idGenre`, `nomGenre`, `imgGenre`) VALUES
(13, 'Épistolaire', 'Categorie/GenreEpistolaire.jpg'),
(12, 'Théâtrale', 'Categorie/GenreTheatral.png'),
(15, 'Descriptif', 'Categorie/GenreDescriptif.jpg'),
(14, 'Argumentatif', 'Categorie/GenreArgumentatif.jpg'),
(11, 'Narratifs', 'Categorie/GenreNarratif.jpg'),
(10, 'Poétique', 'Categorie/GenrePoetique.jpg'),
(16, 'Graphique', 'Categorie/GenreGraphique.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `lectures`
--

DROP TABLE IF EXISTS `lectures`;
CREATE TABLE IF NOT EXISTS `lectures` (
  `idLecture` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(100) NOT NULL,
  `idLivre` int(11) NOT NULL,
  PRIMARY KEY (`idLecture`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lectures`
--

INSERT INTO `lectures` (`idLecture`, `contenu`, `idLivre`) VALUES
(1, 'livres/hugo_les_miserables_fantine.pdf', 23),
(2, 'livres/maupassant_bel_ami.pdf', 19),
(3, 'livres/hugo_dernier_jour_condamne.pdf', 20),
(4, 'livres/zola_germinal.pdf', 22),
(5, 'livres/Le_Paysan_parvenu.pdf', 26),
(6, 'livres/Discours_de_la_servitude_volontaire_Édition_1922_Texte_entier.pdf', 28),
(8, 'livres/photoLivre_Femmes.pdf', 43),
(9, 'livres/sun_tzu_art_de_la_guerre.pdf', 31),
(10, 'livres/sun_tzu_art_de_la_guerre.pdf', 31);

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `idLivre` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) NOT NULL,
  `date_sortie` varchar(100) NOT NULL,
  `Prix` float NOT NULL,
  `Photo` varchar(200) NOT NULL,
  `idGenre` int(11) DEFAULT NULL,
  `idtypeGenre` int(11) DEFAULT NULL,
  `idEditeur` int(11) DEFAULT NULL,
  `date_heure` datetime NOT NULL,
  `droit` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`idLivre`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`idLivre`, `Titre`, `date_sortie`, `Prix`, `Photo`, `idGenre`, `idtypeGenre`, `idEditeur`, `date_heure`, `droit`, `description`) VALUES
(1, 'T\'inquiète pas , maman, ça va aller', '24-02-2021', 18, 'https://static.fnac-static.com/multimedia/Images/FR/NR/f4/ab/c2/12758004/1507-1/tsp20210218115248/T-inquiete-pas-maman-ca-va-aller.jpg', 1, 1, 1, '2021-03-04 16:40:34', 0, '«  Je marche dans la rue en levant les yeux au ciel. Il paraît que c’est ultra-efficace pour éviter de pleurer. J’inspire à fond. J’écoute battre mon cœur. Je viens d\'entrer dans un tunnel immense… C’est le début du grand huit. Il va falloir que je m’accroche.   Longtemps, je n’ai pas voulu voir, pas voulu savoir. J’étais dans le déni et la mauvaise foi. J’ai joué à merveille mon rôle d’actrice lumineuse, pétillante et légère. J’avais une double vie  : celle à laquelle je voulais croire, et l’autre, celle que je vivais vraiment...  Il m’aura fallu dix ans pour accepter la différence de ma fille. Dix ans de fuite, dix ans de combat.  Je ne m\'attendais pas à un tel voyage.  Je voudrais aujourd’hui partager ce chemin de rires et de larmes, de colères, de doutes, de joies et d’amour. Parce que, si longue que puisse être la route, si gigantesques que soient les montagnes à franchir, nous avons tous le choix d’être heureux.  »'),
(3, 'Entre nos lèvres', '25-02-2021', 19.95, 'https://static.fnac-static.com/multimedia/Images/FR/NR/bf/d9/c2/12769727/1507-1/tsp20210212072103/Entre-nos-levres.jpg', 2, 22, 2, '2021-03-04 16:40:34', 0, 'Le sexe, nous sommes nombreux·ses à y penser, mais trop peu à en parler - pour de vrai. Parce qu\'en parler, ce n\'est pas seulement faire la liste exhaustive de nos partenaires, raconter nos anecdotes les plus gentiment désastreuses (parce que c\'est plus drôle), édulcorer certaines histoires et en censurer d\'autres (parce que c\'est plus facile). En parler, c\'est se livrer, partager, entrer dans la sphère intime, sans honte ni retenue, pour mieux comprendre et, surtout, se sentir compris·e.  À travers des portraits intimes de femmes (surtout) et d\'hommes (aussi), Entre nos lèvres raconte les vraies histoires, dénonce les normes, rappelle nos différences, nos libertés, et ouvre le dialogue sur des tabous qui ne devraient pas en être.  Aujourd\'hui, le podcast devient un livre et, pour la première fois, ces portraits s\'entremêlent, se répondent, et prennent vie auprès des émouvantes illustrations de l\'artiste Alexandria Coe. Vous y trouverez tous les récits qui ont déjà touché des milliers d\'auditrices et d\'auditeurs, mais aussi huit témoignages inédits. Et vous verrez, ils ont tous quelque chose à vous offrir. '),
(23, 'Les Misérables', '1862', 0, 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/40/Cosette-sweeping-les-miserables-emile-bayard-1862.jpg/378px-Cosette-sweeping-les-miserables-emile-bayard-1862.jpg', 11, 0, 1, '2021-03-04 16:40:34', 1, 'Valjean, l’ancien forçat devenu bourgeois et protecteur des faibles ; Fantine, l’ouvrière écrasée par sa condition ; le couple Thénardier, figure du mal et de l’opportunisme ; Marius, l’étudiant idéaliste ; Gavroche, le gamin des rues impertinent qui meurt sur les barricades ; Javert, la fatalité imposée par la société sous les traits d’un policier vengeur… Et, bien sûr, Cosette, l’enfant victime. Voilà comment une œuvre immense incarne son siècle en quelques destins exemplaires, figures devenues mythiques qui continuent de susciter une multitude d’adaptations. '),
(22, 'Les Rougon-Macquart, tome 13 : Germinal', ' janvier 1885', 0, 'https://www.babelio.com/couv/CVT_Germinal_4755.jpeg', 1, 0, NULL, '2021-03-04 16:40:34', 1, 'Une des grandes grèves du siècle dernier racontée par un journaliste de génie qui en a fait un réquisitoire, un formidable « J’accuse » contre le capital, le roman de la lutte des classes et de la misère ouvrière. Un livre de nuit, de violence et de sang, mais qui débouche sur l’espoir d’un monde nouveau lorsque le héros, Étienne Lantier, quittant la mine « en soldat raisonneur de la révolution, » sent naître autour de lui une « armée noire, vengeresse… dont la germination allait bientôt faire éclater la terre ». Germinal marque l’éveil du monde du travail à la conscience de ses droits et c’est au cri sans cesse repris de « Germinal ! Germinal ! » que la délégation des mineurs de Denain accompagna le convoi funèbre de Zola à travers les rues de Paris. « Le roman est le soulèvement des salariés, le coup d\'épaule donné à la société qui craque en un instant : en un mot, la lutte du capital et du travail. C\'est là qu\'est l\'importance du livre, je le veux prédisant l\'avenir, posant la question qui sera la plus importante du vingtième siècle » Zola à propos de Germinal.'),
(21, 'A la recherche du temps perdu, tome 2 : A l\'ombre des jeunes filles en fleurs', '30-11-1918', 5, 'https://images-na.ssl-images-amazon.com/images/I/41-CZzYhV9L._SX210_.jpg', 1, 0, 1, '2021-03-04 16:40:34', 0, '\"Tout d\'un coup, dans le petit chemin creux, je m\'arrêtai touché au coeur par un doux souvenir d\'enfance : je venais de reconnaître, aux feuilles découpées et brillantes qui s\'avançaient sur le seuil, un buisson d\'aubépines défleuries, hélas, depuis la fin du printemps. Autour de moi flottait une atmosphère d\'anciens mois de Marie, d\'après-midi du dimanche, de croyances, d\'erreurs oubliées. J\'aurais voulu la saisir. Je m\'arrêtai une seconde et Andrée, avec une divination charmante, me laissa causer un instant avec les feuilles de l\'arbuste. Je leur demandai des nouvelles des fleurs, ces fleurs de l\'aubépine pareilles à de gaies jeunes filles étourdies, coquettes et pieuses. \"Ces demoiselles sont parties depuis déjà longtemps\", me disaient les feuilles.\"'),
(19, 'Bel-Ami', '01-08-1979', 0, 'https://www.babelio.com/couv/bm_CVT_Bel-Ami_5950.jpg', 1, 0, NULL, '2021-03-04 16:40:34', 1, '\"Ses camarades disaient de lui : C\'est un malin, c\'est un roublard, c\'est un débrouillard qui saura se tirer d\'affaire. Et il s\'était promis en effet d\'être un malin, un roublard, un débrouillard.\" Georges Duroy, surnommé Bel-Ami, rêve d\'ascension sociale. Prêt à tout pour quitter sa mansarde et faire son entrée dans la bonne société parisienne, il use de son charme et multiplie les conquêtes pour se faire un nom. Mais où le mènera cette ambition sans scrupules ? Œuvre incontournable de Guy de Maupassant, Bel-Ami dresse un portrait satirique de la bourgeoisie parisienne du XIXe siècle où seules comptent les apparences. '),
(20, 'Le dernier jour d\'un condamné', 'février 1928', 0, 'https://www.babelio.com/couv/bm_10040_959930.jpg', 1, 0, NULL, '2021-03-04 16:40:34', 1, '\"Condamné à mort.\" Depuis que la sentence est tombée, son esprit s\'épouvante à cette idée. De son nom et de son crime, le lecteur ignore tout. Il assiste en revanche, impuissant, aux dernières pensées et à l\'affolement d\'un individu qui crie son humanité et son désir de vivre. Et découvre les rouages implacables d\'une institution aveugle, qui a pour nom \"Justice\". Indigné par le spectacle d\'une exécution à la guillotine, Victor Hugo écrit ce court roman comme un réquisitoire impitoyable contre la barbarie judiciaire doublé d\'un véritable manifeste humaniste.'),
(26, 'Le Paysan Parvenu', '1734', 0, 'https://images-na.ssl-images-amazon.com/images/I/712S9wSXJ9L.jpg', 1, 0, NULL, '2021-03-25 17:47:59', 1, 'Il n\'est guère de saison théâtrale qui ne fasse une place aux comédies de Marivaux, mais sait-on bien que le dramaturge est aussi l\'auteur de deux romans, La Vie de Marianne et Le Paysan parvenu (1734-1735), qui comptent parmi les chefs-d\'oeuvre du roman à la première personne ? Le Paysan parvenu relate la fulgurante ascension sociale de Jacob. Issu d\'une famille de vignerons de Champagne, cet homme de rien devient en sept jours un bourgeois de Paris, avant de se lancer à la conquête des titres et des biens. Les clés du succès ? Une mine sympathique, beaucoup d\'esprit, un solide sens de la répartie, des intuitions toujours justes et le don de plaire aux dames du monde... Donnant la parole à un paysan, alors qu\'écrire ses mémoires reste à l\'époque un privilège d\'aristocrate, Marivaux engage dans ce roman une réflexion de fond sur la transformation de l\'homme par la société urbaine et sur la naissance de l\'individu au XVIIIesiècle.'),
(28, 'Discours de la servitude volontaire', '1576', 0, '../membres/img/photoLivre/photoLivre-Discours de la servitude volontaire.jpg', 14, 25, 3, '2022-02-17 12:41:34', 1, 'La servitude des peuples est volontaire : ils acceptent le joug des puissants, mais vont ainsi à l\'encontre de leur nature. Pour se libérer de l\'emprise du tyran, nul besoin de violence : il suffit aux hommes de se faire amis plutôt que complices. Écrit en 1548, alors que La Boétie n\'a que dix-huit ans, ce texte, également appelé Contr\'Un, s\'inscrit dans le renouvellement de la sensibilité politique au XVIe siècle et cherche dans les comportements individuels les causes de la tyrannie. Il est suivi de De la liberté chez les Anciens et chez les Modernes '),
(29, 'Liens du sang', '2022-03-24', 17.95, '../membres/img/photoLivre/photoLivre-Liens du sang.jpeg', 11, NULL, 4, '2022-03-29 14:05:55', 0, '<strong>Vous ne verrez plus jamais votre famille de la même façon...</strong> <br>  Milly, Aubrey et Jonah sont cousins, mais ne se connaissaient pas jusqu\'à recevoir une mystérieuse invitation. Pour la première fois, leur grand-mère, richissime, leur propose de passer l\'été sur une île dont elle est propriétaire. Ils n\'ont qu\'une chose en tête : percer à jour les secrets de famille qui ont poussé la vieille femme à déshériter leurs parents. Mais les cousins ne s\'attendaient pas à découvrir des meurtres non élucidés... qui menacent de nouveau l\'île.'),
(30, 'Le Seigneur des anneaux - Tome 1', '2017-09-08', 7.95, '../membres/img/photoLivre/photoLivre-Le Seigneur des anneaux - Tome 1.jpg', 0, NULL, 5, '2022-03-29 17:36:45', 1, 'Aux temps reculés de ce récit, la Terre est peuplée d\'innombrables créatures : les Hobbits, apparentés à l\'Homme, les Elfes et les Nains vivent en paix. Une paix menacée depuis que l\'Anneau de Pouvoir, forgé par Sauron de Mordor, a été dérobé. Or cet anneau est doté d\'un pouvoir maléfique qui confère à son détenteur une autorité sans limite et fait de lui le Maître du monde. Sauron s\'est donc juré de le reconquérir...'),
(31, 'L’Art de la guerre', '450 BCE', 0, '../membres/img/photoLivre/photoLivre-L’Art de la guerre.jpg', 11, 3, 6, '2022-03-29 17:52:01', 1, 'Il y a vingt-cinq siècles, dans la Chine des \"Royaumes Combattants\", était rédigé le premier traité sur \"l\'art de la guerre\". Pour atteindre la victoire, le stratège habile s\'appuie sur sa puissance, mais plus encore le moral des hommes, les circonstances qui l\'entourent et l\'information dont il dispose. La guerre doit être remportée avant même d\'avoir engagé le combat. Sun Tzu ne décrit pas les batailles grandioses et le fracas des épées, pas plus qu\'il n\'énumère des techniques vouées à l\'obsolescence : L\'Art de la guerre est un précieux traité de stratégie, un grand classique de la pensée politique, et une leçon de sagesse à l\'usage des meneurs d\'hommes. Autant que de courage, la victoire est affaire d\'intelligence. '),
(43, 'Femmes', '2022-03-02', 0, '../membres/img/photoLivre/photoLivre-Femmes.jpeg', 10, 52, 6, '2022-03-31 17:09:27', 1, 'Receuil de poésie'),
(36, 'Le Seigneur des anneaux Tome2 :  Les Deux Tours', '2017-09-08', 7.95, '../membres/img/photoLivre/photoLivre-Le-Seigneur-des-anneaux-Tome2---Les-Deux-Tours.jpg', 11, 3, 5, '2022-03-31 14:26:45', 0, 'Frodo et ses compagnons se sont engagés à détruire l\'Anneau de Pouvoir dont Sauron cherche à s\'emparer pour asservir tous les peuples de la Terre habitée : Elfes et Nains, Hommes et Hobbits. L\'entreprise est audacieuse et les forces du Seigneur Sombre se dressent contre eux. Bientôt, pour survivre, il va leur falloir se disperser et affronter tous les dangers.'),
(35, 'Le Seigneur des anneaux Tome 3 : Le Retour du Roi', '2017-09-08', 7.95, '../membres/img/photoLivre/photoLivre-Le-Seigneur-des-anneaux-Tome-3--Le-Retour-du-Roi.jpg', 11, 3, 5, '2022-03-31 14:23:40', 0, 'Alors que tous cherchent l\'Anneau et désirent s\'approprier son funeste pouvoir, la guerre se prépare. Le Mordor s\'est armé, ses créatures malfaisantes se sont multipliées, Sauron mobilise ses troupes. La Terre du Milieu n\'a plus le choix, elle doit se défendre et, déjà, les combats font rage. Les Rohirrim se regroupent pour faire face à la menace. Mais si l\'Anneau tombe entre les mains du Seigneur Sombre, qui pourra l\'arrêter ? Tous les espoirs reposent sur Frodo. Face à la Porte Noire, celui-ci est désemparé. Comment passer et atteindre la Montagne du Feu ? Il doit tenter sa chance, en passant par le haut col de Cirith Ungol. Le simple Hobbit rassemble toutes ses forces, son courage et se dresse, seul ou presque, face au Maître de l\'Anneau.');

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `idPanier` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPanier`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`idPanier`, `idUtilisateur`, `active`) VALUES
(10, 2, 1),
(13, 20, 1),
(14, 23, 1),
(15, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stockage`
--

DROP TABLE IF EXISTS `stockage`;
CREATE TABLE IF NOT EXISTS `stockage` (
  `idStockage` int(11) NOT NULL AUTO_INCREMENT,
  `idPanier` int(11) NOT NULL,
  `idLivre` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`idStockage`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stockage`
--

INSERT INTO `stockage` (`idStockage`, `idPanier`, `idLivre`, `quantite`) VALUES
(24, 12, 1, 1),
(25, 13, 1, 1),
(22, 10, 3, 1),
(23, 11, 28, 1),
(26, 9, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tentatives_connexion`
--

DROP TABLE IF EXISTS `tentatives_connexion`;
CREATE TABLE IF NOT EXISTS `tentatives_connexion` (
  `idTentative` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`idTentative`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `typegenre`
--

DROP TABLE IF EXISTS `typegenre`;
CREATE TABLE IF NOT EXISTS `typegenre` (
  `idtypeGenre` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `imgTypeGenre` varchar(500) NOT NULL DEFAULT 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg',
  `idGenre` int(11) NOT NULL,
  PRIMARY KEY (`idtypeGenre`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typegenre`
--

INSERT INTO `typegenre` (`idtypeGenre`, `libelle`, `imgTypeGenre`, `idGenre`) VALUES
(1, 'Roman', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(52, 'Lyrique', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(3, 'Fantastique', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(4, 'Biographie', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(5, 'Nouvelle', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(6, 'Science-fiction', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(7, 'Aventures', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(8, 'Historique', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(9, 'Amour', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 11),
(10, 'Lettre', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 13),
(11, 'Épître', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 13),
(12, 'Tragédie', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(13, 'Comédie', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(14, 'Tragicomédie', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(15, 'Sotie', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(16, 'Farce', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(17, 'Moralité', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(18, 'Drame', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(19, 'Miracle', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(20, 'Mystère', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(21, 'Proverbe', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 12),
(22, 'Essai', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 14),
(23, 'Fable', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 14),
(24, 'Fabliau', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 14),
(25, 'Pamphlet', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 14),
(38, 'Portrait', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 15),
(39, 'Roman Graphique', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 16),
(40, 'Bande déssinée', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 16),
(41, 'Ballade', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(42, 'Calligramme', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(43, 'Chanson', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(44, 'Chant royal', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(45, 'Élégie', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(46, 'Épigramme', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(47, 'Épopée', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(48, 'Fable', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(49, 'Fatrasie', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(50, 'Ghazel', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10),
(51, 'Haïku', 'https://www.aproposdecriture.com/wp-content/uploads/2016/06/livre.jpg', 10);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `photoProfile` varchar(100) NOT NULL DEFAULT '../membres/photoProfile/112008_people_512x512.png',
  `idPermission` int(11) DEFAULT '0',
  `token` varchar(100) DEFAULT NULL,
  `dateMentionAcceptée` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `email`, `mdp`, `photoProfile`, `idPermission`, `token`, `dateMentionAcceptée`, `active`) VALUES
(1, 'Admin', 'Administrateur', 'admin@gmail.com', '$2y$10$iVU1rwJ/2gdwrmMX7a0xg.jO24VuKD5NAbx9ODvZVi1o5Onyx9bta', '../membres/img/photoProfile/profilePicture-idUser=1.jpg', 1, '5a2077f98c6137939e1ca14d820e59a2ed5ab446', '', 1),
(12, 'Eric', 'Francis', 'eric@gmail.com', '$2y$10$yjBKAbNLXCYHVbYyHYh8seNh484n5/7q2Gxbfh5lp0Yrq01QbrKL.', '../membres/img/photoProfile/112008_people_512x512.png', 0, NULL, '', 1),
(20, 'Madani', 'Yanis', 'madaniyanis@gmail.com', '$2y$10$opbGC6FH1IsA.Zvl46kBXuCJrtUYmx3Nys516Q1.ZXkPD2e2qEegC', '../membres/img/photoProfile/profilePicture-idUser=20.png', 1, 'a919332873e9e2412618839a4ef0372d2cd154da', '2022-02-15 12:22:11', 1),
(23, 'Tulipe', 'Rose', 'gerrard@yahoo.fr', '$2y$10$tCifVa037xN9LYNJ4.9CuOkI0tnlZFBflujnJF51MZ2hyhgR6xpsC', '../membres/img/photoProfile/profilePicture-idUser=23.png', 1, '0f094e9d4d65edc65ed715866eaa524bb282b468', '2022-03-03 11:46:53', 1),
(24, 'User', 'user', 'user@gmail.com', '$2y$10$l6eAg4hioFiSkDryOA4n1.JGPQ3YyF53c3Pd.NNxup6plRDx8Oj1S', '../membres/img/photoProfile/112008_people_512x512.png', 0, NULL, '2022-05-24 09:21:13', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
