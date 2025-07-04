-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for job
CREATE DATABASE IF NOT EXISTS `job` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `job`;

-- Dumping structure for table job.applicants
CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) NOT NULL,
  `jobId` int(11) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `status` enum('new','reviewed','shortlisted','rejected') NOT NULL DEFAULT 'new',
  `experience` int(11) NOT NULL DEFAULT 0,
  `joiningDate` date DEFAULT NULL,
  `coverLetter` text DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `diplome` varchar(100) DEFAULT NULL,
  `etablissement` varchar(150) DEFAULT NULL,
  `annee` varchar(20) DEFAULT NULL,
  `competences` text DEFAULT NULL,
  `langues` text DEFAULT NULL,
  `date_entree` date DEFAULT NULL,
  `cv_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `jobId` (`jobId`),
  CONSTRAINT `applicants_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  CONSTRAINT `applicants_ibfk_2` FOREIGN KEY (`jobId`) REFERENCES `jobs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.applicants: ~0 rows (approximately)

-- Dumping structure for table job.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `numberOfJobs` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.categories: ~10 rows (approximately)
INSERT INTO `categories` (`id`, `title`, `numberOfJobs`) VALUES
	(1, 'Développement Web', 10),
	(2, 'Développement Mobile', 10),
	(3, 'Cybersécurité', 10),
	(4, 'Science des Données & Analyse', 10),
	(5, 'Développement Logiciel', 10),
	(6, 'Support IT & Administration', 10),
	(7, 'Gestion de Bases de Données', 10),
	(8, 'Intelligence Artificielle & Machine Learning', 10),
	(9, 'UI/UX & Design Graphique', 10),
	(10, 'Réseaux & Télécommunications', 10);

-- Dumping structure for table job.featuredjobs
CREATE TABLE IF NOT EXISTS `featuredjobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobId` (`jobId`),
  CONSTRAINT `featuredjobs_ibfk_1` FOREIGN KEY (`jobId`) REFERENCES `jobs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.featuredjobs: ~0 rows (approximately)

-- Dumping structure for table job.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postedBy` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `salaryRange` varchar(255) DEFAULT NULL,
  `duration` enum('part-time','full-time','contract','internship') NOT NULL,
  `type` enum('remote','onsite','mission') NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp(),
  `skills` text DEFAULT NULL,
  `status` enum('active','closed') NOT NULL DEFAULT 'active',
  `numberOfApplicants` int(11) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `requirements` text NOT NULL,
  `specializations` varchar(255) NOT NULL,
  `experience` enum('entry-level','mid-level','senior-level','expert-level') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postedBy` (`postedBy`),
  KEY `category` (`category`),
  CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`postedBy`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.jobs: ~2 rows (approximately)
INSERT INTO `jobs` (`id`, `postedBy`, `category`, `title`, `companyName`, `location`, `salaryRange`, `duration`, `type`, `datePosted`, `skills`, `status`, `numberOfApplicants`, `description`, `requirements`, `specializations`, `experience`) VALUES
	(33, 'aa-685aae752ec82', 9, 'Designer Graphique', 'Ecole', 'Tout le maroc', 'MAD 7000-10000', 'full-time', 'remote', '2025-06-24 14:59:00', 'Adobe Photoshop, Illustrator, InDesign, Canva', 'active', 0, 'Nous recherchons un Graphiste talentueux et créatif pour rejoindre notre équipe. Vous serez responsable de la conception visuelle et de la création de supports graphiques variés (print, web, réseaux sociaux, branding, etc.) afin de valoriser l’image de notre entreprise et de nos clients.', 'Diplôme en design graphique, arts visuels ou équivalent\r\n\r\nMaîtrise des logiciels de création graphique : Adobe Photoshop, Illustrator, InDesign, etc.\r\n\r\nExcellente sensibilité artistique et sens du détail\r\n\r\nCapacité à travailler en équipe et à respecter les délais', '41', 'expert-level'),
	(34, 'je-6828a8ed3f379', 1, 'Developpeur Front End', 'YSNet', 'Meknes, Maroc', 'MAD 6000-10000', 'full-time', 'onsite', '2025-06-24 15:03:19', 'HTML, CSS , Bootstrap , JavaScript , React.js , Vue.js', 'active', 0, 'Nous recherchons un développeur front-end intermédiaire passionné et rigoureux pour rejoindre notre équipe. Vous participerez au développement et à la maintenance des interfaces web en assurant une expérience utilisateur fluide et performante. Vous travaillerez en étroite collaboration avec les designers UX/UI et les développeurs back-end pour implémenter des solutions modernes et efficaces.', 'Expérience confirmée (2 à 5 ans) en développement front-end\r\n\r\nMaîtrise de HTML5, CSS3, JavaScript (ES6+) et d’au moins un framework moderne (React, Vue ou Angular)\r\n\r\nBonne connaissance des principes de responsive design et d’accessibilité web\r\n\r\nMaîtrise des outils de gestion de versions (Git)', '1', 'mid-level');

-- Dumping structure for table job.secteurs_activite
CREATE TABLE IF NOT EXISTS `secteurs_activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_secteur` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_secteur` (`nom_secteur`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.secteurs_activite: ~20 rows (approximately)
INSERT INTO `secteurs_activite` (`id`, `nom_secteur`) VALUES
	(5, 'Analyse de Données'),
	(13, 'Big Data'),
	(14, 'Blockchain'),
	(20, 'Consulting IT'),
	(3, 'Cybersécurité'),
	(9, 'Design Graphique'),
	(16, 'Développement Jeux Vidéo'),
	(2, 'Développement Mobile'),
	(1, 'Développement Web'),
	(18, 'E-commerce'),
	(12, 'Gestion de Projet'),
	(7, 'Infogérance / Cloud'),
	(4, 'Intelligence Artificielle'),
	(15, 'Internet des Objets (IoT)'),
	(11, 'Marketing Digital'),
	(19, 'Réalité Virtuelle / Augmentée'),
	(6, 'Réseaux et Systèmes'),
	(8, 'Support Technique'),
	(17, 'Test et Qualité Logicielle'),
	(10, 'UX/UI Design');

-- Dumping structure for table job.specializations
CREATE TABLE IF NOT EXISTS `specializations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `specializations_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.specializations: ~50 rows (approximately)
INSERT INTO `specializations` (`id`, `name`, `category_id`) VALUES
	(1, 'Développeur Frontend', 1),
	(2, 'Développeur Backend', 1),
	(3, 'Développeur Full-Stack', 1),
	(4, 'Développeur WordPress', 1),
	(5, 'Web Designer', 1),
	(6, 'Développeur Android', 2),
	(7, 'Développeur iOS', 2),
	(8, 'Développeur Flutter', 2),
	(9, 'Développeur React Native', 2),
	(10, 'Designer UI/UX Mobile', 2),
	(11, 'Analyste en sécurité', 3),
	(12, 'Hacker éthique', 3),
	(13, 'Ingénieur en sécurité réseau', 3),
	(14, 'Consultant en cybersécurité', 3),
	(15, 'Répondant aux incidents', 3),
	(16, 'Data Scientist', 4),
	(17, 'Analyste de données', 4),
	(18, 'Ingénieur en apprentissage automatique', 4),
	(19, 'Ingénieur en intelligence artificielle', 4),
	(20, 'Analyste en Business Intelligence', 4),
	(21, 'Ingénieur logiciel', 5),
	(22, 'Ingénieur DevOps', 5),
	(23, 'Développeur systèmes embarqués', 5),
	(24, 'Développeur de jeux vidéo', 5),
	(25, 'Développeur d’applications de bureau', 5),
	(26, 'Administrateur système', 6),
	(27, 'Spécialiste support IT', 6),
	(28, 'Administrateur réseau', 6),
	(29, 'Ingénieur cloud', 6),
	(30, 'Technicien IT', 6),
	(31, 'Administrateur de bases de données', 7),
	(32, 'Développeur SQL', 7),
	(33, 'Ingénieur en données', 7),
	(34, 'Spécialiste Big Data', 7),
	(35, 'Expert en bases NoSQL', 7),
	(36, 'Chercheur en IA', 8),
	(37, 'Ingénieur en deep learning', 8),
	(38, 'Ingénieur en traitement du langage naturel (NLP)', 8),
	(39, 'Ingénieur en vision par ordinateur', 8),
	(40, 'Ingénieur en robotique', 8),
	(41, 'Designer UI/UX', 9),
	(42, 'Designer produit', 9),
	(43, 'Designer d’interaction', 9),
	(44, 'Designer visuel', 9),
	(45, 'Illustrateur numérique', 9),
	(46, 'Ingénieur réseau', 10),
	(47, 'Administrateur télécom', 10),
	(48, 'Spécialiste VoIP', 10),
	(49, 'Consultant en infrastructures réseaux', 10),
	(50, 'Ingénieur en systèmes embarqués', 10);

-- Dumping structure for table job.tailles_entreprise
CREATE TABLE IF NOT EXISTS `tailles_entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taille` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `taille` (`taille`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.tailles_entreprise: ~4 rows (approximately)
INSERT INTO `tailles_entreprise` (`id`, `taille`) VALUES
	(1, '1-10 employés'),
	(3, '100+ employés'),
	(2, '11-50 employés'),
	(4, '51-200 employés');

-- Dumping structure for table job.users
CREATE TABLE IF NOT EXISTS `users` (
  `userId` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','applicant','employer') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.users: ~7 rows (approximately)
INSERT INTO `users` (`userId`, `fullname`, `username`, `email`, `phone`, `password`, `role`, `profile_picture`, `description`) VALUES
	('aa-685aae752ec82', 'Ahmed Alaoui', 'Ahmed', 'ahmed@gmail.com', '0661628964', '$2y$10$d89/fuORTiYQS7wGOe1xxOA2XAdrvu7N4BsEzq1P0Woxu/Jg74.HW', 'employer', NULL, NULL),
	('ar-68374523ecf7d', 'Ahmed Regragui', 'AhmedRegragui', 'ahmedregragui@gmail.com', '065498752', '$2y$10$ctZJinYSd5YWNLuGvuE3juN5y8WS01i9si5NIA8m5fk3Q34FUtaFW', 'employer', NULL, NULL),
	('je-6828a8ed3f379', 'Yahou', 'JobEmployer', 'yassinfikryy@gmail.com', '0762695921', '$2y$10$scepp4g/KwVUEn8S.QX2ZOn9jB8QTzzO0FdYDY6n0sa4HeZfz1r4e', 'employer', NULL, ''),
	('jk-68374716d9a61', 'Jawad Kadi', 'Jawad_Kadi', 'jawadkadi@gmail.com', '0776564121', '$2y$10$sFz2JsvMpApxkzkT8jrBoON5eYJk0sFvWFtiqpKZd.tsYGPdU17u.', 'employer', NULL, NULL),
	('ut-6855e85f9c582', 'User Test', 'UserTest', 'yassin.fikri00@gmail.com', '0762695921', '$2y$10$gO06rYtSZ38j3P.7iH8U5e9lkE88GRRvq5.4FxJYpmZ9f2Ff8LduK', 'applicant', NULL, NULL),
	('wa-68374656bb66a', 'Walid Alaoui', 'Walid', 'walid@gmail.com', '0761627055', '$2y$10$fro/.5DIcSQxnHJdakhCeek/9iAJnt6QNBnie/BvjxcyMaTUw2Ami', 'employer', NULL, NULL),
	('yf-68389cf693b45', 'Yassin Fikri', 'Yassin', 'yassin.fikri00@gmail.com', '0762695921', '$2y$10$hWnE96XGJS/M2PGf7QNEFOaPyoBd3pZSEIGEG5W/G0twfED22o9a.', 'applicant', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
