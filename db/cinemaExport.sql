-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour cinema_maximefutterer
CREATE DATABASE IF NOT EXISTS `cinema_maximefutterer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cinema_maximefutterer`;

-- Listage de la structure de table cinema_maximefutterer. acteur
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_acteur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `acteur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.acteur : ~10 rows (environ)
REPLACE INTO `acteur` (`id_acteur`, `id_personne`) VALUES
	(1, 2),
	(2, 3),
	(3, 4),
	(4, 5),
	(5, 6),
	(6, 7),
	(7, 8),
	(8, 9),
	(9, 11),
	(10, 12);

-- Listage de la structure de table cinema_maximefutterer. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `id_film` int NOT NULL,
  `id_acteur` int NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_acteur`,`id_role`),
  KEY `id_acteur` (`id_acteur`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `casting_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `casting_ibfk_2` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`),
  CONSTRAINT `casting_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.casting : ~13 rows (environ)
REPLACE INTO `casting` (`id_film`, `id_acteur`, `id_role`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(2, 4, 9),
	(2, 5, 4),
	(2, 6, 5),
	(5, 6, 12),
	(6, 6, 13),
	(2, 7, 6),
	(3, 7, 7),
	(3, 8, 8),
	(4, 9, 10),
	(5, 10, 11);

-- Listage de la structure de table cinema_maximefutterer. classer
CREATE TABLE IF NOT EXISTS `classer` (
  `id_film` int NOT NULL,
  `id_genre` int NOT NULL,
  PRIMARY KEY (`id_film`,`id_genre`),
  KEY `id_genre` (`id_genre`),
  CONSTRAINT `classer_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `classer_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.classer : ~6 rows (environ)
REPLACE INTO `classer` (`id_film`, `id_genre`) VALUES
	(1, 1),
	(1, 2),
	(2, 4),
	(3, 4),
	(4, 4),
	(3, 5);

-- Listage de la structure de table cinema_maximefutterer. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `sortieFr` int NOT NULL,
  `duree` int NOT NULL,
  `note` float NOT NULL DEFAULT '0',
  `synopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `affiche` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `id_realisateur` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_realisateur` (`id_realisateur`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_realisateur`) REFERENCES `realisateur` (`id_realisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.film : ~6 rows (environ)
REPLACE INTO `film` (`id_film`, `titre`, `sortieFr`, `duree`, `note`, `synopsis`, `affiche`, `id_realisateur`) VALUES
	(1, 'Star Wars : Episode IV, A New Hope', 1977, 121, 9, NULL, 'https://m.media-amazon.com/images/M/MV5BOTA5NjhiOTAtZWM0ZC00MWNhLThiMzEtZDFkOTk2OTU1ZDJkXkEyXkFqcGdeQXVyMTA4NDI1NTQx._V1_.jpg', 1),
	(2, 'Pulp Fiction', 1994, 154, 9, NULL, 'https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', 2),
	(3, 'Kill Bill: Volume 1', 2003, 111, 8, NULL, 'https://m.media-amazon.com/images/M/MV5BNzM3NDFhYTAtYmU5Mi00NGRmLTljYjgtMDkyODQ4MjNkMGY2XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_FMjpg_UX1000_.jpg', 2),
	(4, 'Oppenheimer', 2023, 181, 9, NULL, 'https://m.media-amazon.com/images/M/MV5BMDBmYTZjNjUtN2M1MS00MTQ2LTk2ODgtNzc2M2QyZGE5NTVjXkEyXkFqcGdeQXVyNzAwMjU2MTY@._V1_.jpg', 3),
	(5, 'Django Unchained', 2012, 165, 9, NULL, 'https://m.media-amazon.com/images/M/MV5BMjIyNTQ5NjQ1OV5BMl5BanBnXkFtZTcwODg1MDU4OA@@._V1_.jpg', 2),
	(6, 'Les Huits Salopards', 2015, 187, 8, NULL, 'https://m.media-amazon.com/images/M/MV5BMjA1MTc1NTg5NV5BMl5BanBnXkFtZTgwOTM2MDEzNzE@._V1_.jpg', 2);

-- Listage de la structure de table cinema_maximefutterer. genre
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int NOT NULL AUTO_INCREMENT,
  `nomGenre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_genre`),
  UNIQUE KEY `nomGenre` (`nomGenre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.genre : ~5 rows (environ)
REPLACE INTO `genre` (`id_genre`, `nomGenre`) VALUES
	(5, 'Action'),
	(2, 'Fantaisie'),
	(3, 'Horreur'),
	(1, 'Science Fiction'),
	(4, 'Thriller');

-- Listage de la structure de table cinema_maximefutterer. personne
CREATE TABLE IF NOT EXISTS `personne` (
  `id_personne` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `dateNaissance` date NOT NULL,
  `sexe` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `biographie` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.personne : ~12 rows (environ)
REPLACE INTO `personne` (`id_personne`, `nom`, `prenom`, `dateNaissance`, `sexe`, `biographie`, `image`) VALUES
	(1, 'Lucas', 'George', '1944-05-14', 'M', NULL, 'https://fr.web.img6.acsta.net/pictures/15/12/18/10/51/568937.jpg'),
	(2, 'Hamill', 'Mark', '1951-09-25', 'M', NULL, 'https://fr.web.img6.acsta.net/pictures/19/06/20/12/55/1998268.jpg'),
	(3, 'Ford', 'Harrison', '1942-07-13', 'M', NULL, 'https://m.media-amazon.com/images/M/MV5BMTY4Mjg0NjIxOV5BMl5BanBnXkFtZTcwMTM2NTI3MQ@@._V1_.jpg'),
	(4, 'Fisher', 'Carrie', '1956-10-21', 'F', NULL, 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d1/Carrie_Fisher_2013.jpg/1200px-Carrie_Fisher_2013.jpg'),
	(5, 'Tarantino', 'Quentin', '1963-03-27', 'M', NULL, 'https://fr.web.img3.acsta.net/pictures/19/05/22/10/33/5945451.jpg'),
	(6, 'Travolta', 'John', '1954-02-18', 'M', NULL, 'https://m.media-amazon.com/images/M/MV5BMTMyMjZlYzgtZWRjMC00OTRmLTllZTktMmM1ODVmNjljMTQyXkEyXkFqcGdeQXVyMTExNzQ3MzAw._V1_.jpg'),
	(7, 'Jackson', 'Samuel L.', '1948-12-21', 'M', NULL, 'https://fr.web.img5.acsta.net/pictures/15/07/27/12/24/354255.jpg'),
	(8, 'Thurman', 'Uma', '1970-04-29', 'F', NULL, 'https://m.media-amazon.com/images/M/MV5BMjMxNzk1MTQyMl5BMl5BanBnXkFtZTgwMDIzMDEyMTE@._V1_.jpg'),
	(9, 'Liu', 'Lucy', '1968-12-02', 'F', NULL, 'https://m.media-amazon.com/images/M/MV5BOTgxODE0MjI5Ml5BMl5BanBnXkFtZTcwMjkxMzMzMg@@._V1_FMjpg_UX1000_.jpg'),
	(10, 'Nolan', 'Christopher', '1970-07-30', 'M', NULL, 'https://m.media-amazon.com/images/M/MV5BNjE3NDQyOTYyMV5BMl5BanBnXkFtZTcwODcyODU2Mw@@._V1_FMjpg_UX1000_.jpg'),
	(11, 'Murphy', 'Cillian', '1976-05-25', 'M', NULL, 'https://m.media-amazon.com/images/M/MV5BMDUxY2M1NTQtNzcwNC00ZDljLTk4YjctYzJjZGNiYTc0YTE1XkEyXkFqcGdeQXVyMTY5MDA5MDc3._V1_.jpg'),
	(12, 'Waltz', 'Christoph', '1956-10-04', 'M', NULL, 'https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/171314_v9_bb.jpg');

-- Listage de la structure de table cinema_maximefutterer. realisateur
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_realisateur` int NOT NULL AUTO_INCREMENT,
  `id_personne` int NOT NULL,
  PRIMARY KEY (`id_realisateur`),
  UNIQUE KEY `id_personne` (`id_personne`),
  CONSTRAINT `realisateur_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id_personne`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.realisateur : ~0 rows (environ)
REPLACE INTO `realisateur` (`id_realisateur`, `id_personne`) VALUES
	(1, 1),
	(2, 5),
	(3, 10);

-- Listage de la structure de table cinema_maximefutterer. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `nomRole` (`nomRole`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table cinema_maximefutterer.role : ~0 rows (environ)
REPLACE INTO `role` (`id_role`, `nomRole`) VALUES
	(7, 'Beatrix Kiddo'),
	(11, 'Dr King Schultz'),
	(2, 'Han Solo'),
	(10, 'J. Robert Oppenheimer'),
	(9, 'Jimmie Dimmick'),
	(5, 'Jules Winnfield'),
	(1, 'Luke Skywalker'),
	(13, 'Major Marquis Warren'),
	(6, 'Mia Wallace'),
	(8, 'O-Ren Ishii'),
	(3, 'Princess Leïa'),
	(12, 'Stephen'),
	(4, 'Vincent Vega');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
