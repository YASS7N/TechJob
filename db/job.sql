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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.applicants: ~4 rows (approximately)
INSERT INTO `applicants` (`id`, `userId`, `jobId`, `cv`, `status`, `experience`, `joiningDate`, `coverLetter`, `nom`, `email`, `telephone`, `adresse`, `github`, `diplome`, `etablissement`, `annee`, `competences`, `langues`, `date_entree`, `cv_filename`) VALUES
	(24, 'yf-68389cf693b45', 34, '', 'new', 2, NULL, NULL, 'Yassin Fikri', 'yassin.fikri00@gmail.com', '+212762695921', '13 Boulevard Bir Anzarane, Meknès', 'https://github.com/YASS7N', 'Technicien Specialisé', 'EPIM', '2023-2025', 'HTML,CSS,Javascript,PHP,MYSQL', 'Français,Anglais,Arabe', '2025-07-05', '6869255e2cbb2_Yassin_Fikri_CV_2025.pdf'),
	(32, 'bo-686c0b6231164', 34, '', 'new', 2, NULL, NULL, 'Brahim Ouazzani', 'brahimouazzani@gmail.com', '0660004194', 'Place d\'armes, Meknès', 'https://github.com/brahim9090', 'Technicien Specialisé', 'EPIM', '2023-2025', 'HTML5, CSS3, JavaScript,Responsive Design, Figma', 'Français,Arabe', '2025-08-01', '686c67ab1e6b9_brahim_cv.pdf'),
	(34, 'me-686c6abbc7d38', 34, '', 'new', 3, NULL, NULL, 'Mohammed El Alami', 'mohammedalami@gmail.com', '0614567890', 'Zitoune, Meknès', 'https://github.com/mohammed', 'Technicien License', 'OFPPT', '2021-2024', 'HTML5, CSS3, JavaScript,Responsive Design, Figma etc...', 'Français,Anglais,Arabe', '2025-09-01', '686c6b663671f_mohammed_cv.pdf'),
	(35, 'ha-686c6e2e31479', 34, '', 'new', 5, NULL, NULL, 'Hatim Alaoui', 'hatimalaoui@gmail.com', '+212762695921', 'Marjane, Meknès', 'https://github.com/Hatim', 'Technicien Specialisé', 'EST', '2020-2022', 'HTML5, CSS3, JavaScript,Responsive Design, Figma', 'Français,Arabe', '2025-08-01', '686c6e9842784_mohammed_cv.pdf');

-- Dumping structure for table job.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `numberOfJobs` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.featuredjobs: ~4 rows (approximately)
INSERT INTO `featuredjobs` (`id`, `jobId`) VALUES
	(11, 34),
	(14, 35),
	(16, 36),
	(13, 37),
	(15, 38);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.jobs: ~6 rows (approximately)
INSERT INTO `jobs` (`id`, `postedBy`, `category`, `title`, `companyName`, `location`, `salaryRange`, `duration`, `type`, `datePosted`, `skills`, `status`, `numberOfApplicants`, `description`, `requirements`, `specializations`, `experience`) VALUES
	(34, 'je-6828a8ed3f379', 1, 'Developpeur Front End', 'YSNet', 'Meknes, Maroc', 'MAD 6000-10000', 'full-time', 'onsite', '2025-06-24 15:03:19', 'HTML, CSS , Bootstrap , JavaScript , React.js , Vue.js', 'active', 0, 'Nous recherchons un développeur front-end intermédiaire passionné et rigoureux pour rejoindre notre équipe. Vous participerez au développement et à la maintenance des interfaces web en assurant une expérience utilisateur fluide et performante. Vous travaillerez en étroite collaboration avec les designers UX/UI et les développeurs back-end pour implémenter des solutions modernes et efficaces.', 'Expérience confirmée (2 à 5 ans) en développement front-end\r\n\r\nMaîtrise de HTML5, CSS3, JavaScript (ES6+) et d’au moins un framework moderne (React, Vue ou Angular)\r\n\r\nBonne connaissance des principes de responsive design et d’accessibilité web\r\n\r\nMaîtrise des outils de gestion de versions (Git)', '1', 'mid-level'),
	(35, 'ha-686c0ce134d66', 3, 'Analyste en sécurité', 'STE DataLimited', 'Casablanca, Maroc', 'MAD 10000-150000', 'full-time', 'onsite', '2025-07-07 19:31:58', 'Connaissance des principes de la sécurité des systèmes d\'information.', 'active', 0, 'En tant qu\'Analyste en sécurité, vous serez responsable de l\'identification, de la gestion et de la résolution des incidents de sécurité. Vous surveillerez les systèmes pour détecter toute activité suspecte et proposerez des solutions pour renforcer la sécurité de l\'infrastructure informatique. Vous travaillerez en étroite collaboration avec les équipes techniques pour assurer la conformité aux normes de sécurité et la protection des données sensibles.', 'Diplôme en informatique ou dans un domaine lié à la cybersécurité.\r\n\r\nExpérience pratique ou stage en sécurité des systèmes d\'information (souhaité).\r\n\r\nBonne maîtrise du français et de l\'anglais (écrit et oral).', '11', 'senior-level'),
	(36, 'jk-68374716d9a61', 9, 'UI/UX Designer', 'DesignTech Solutions', 'Tout le maroc', 'MAD 8000-12000', 'contract', 'remote', '2025-07-07 19:36:35', 'Maîtrise des outils de design comme Sketch, Figma, Adobe XD, et InVision.', 'active', 0, 'En tant que UI/UX Designer, vous serez responsable de la conception et de l\'optimisation des interfaces utilisateur pour nos produits numériques. Vous collaborerez avec les équipes de développement et de marketing pour créer des expériences utilisateur exceptionnelles. Vous serez impliqué dans la recherche utilisateur, la définition des parcours utilisateurs, et la création de designs visuellement attractifs et fonctionnels.', 'Diplôme en design graphique, en interaction utilisateur (UX/UI) ou dans un domaine similaire.\r\n\r\nExpérience dans un rôle de UI/UX Design, même sous forme de stage ou projet freelance.\r\n\r\nPortfolio avec des exemples de projets réalisés.', '41', 'expert-level'),
	(37, 'fb-686c0abd87777', 1, 'Développeur Full Stack', 'TechInnovate Maroc', 'Rabat, Maroc', 'MAD 12000-15000', 'full-time', 'onsite', '2025-07-07 19:39:20', 'Maîtrise des technologies front-end (HTML, CSS, JavaScript, React, Angular, Vue.js), back-end (Node.js, Java, Python, PHP), bases de données (MySQL, PostgreSQL, MongoDB), API RESTful, Git, et bonnes pratiques de développement.', 'active', 0, 'En tant que Développeur Full Stack, vous serez responsable de la création, du développement et de la maintenance des applications web complètes, des interfaces utilisateur aux services back-end. Vous travaillerez en étroite collaboration avec les équipes produits, designers, et autres développeurs pour assurer la qualité et la performance des solutions. Vous participerez à toutes les étapes du cycle de vie des applications, de la conception à la mise en production.', 'Diplôme en informatique, génie logiciel, ou un domaine similaire.\r\n\r\nExpérience professionnelle dans le développement web full-stack.\r\n\r\nPortfolio ou exemples de projets réalisés (souhaité).\r\n\r\nBonne maîtrise de l\'anglais technique, avec une capacité à communiquer efficacement en équipe.', '3', 'expert-level'),
	(38, 'aa-686c14bd00180', 1, 'Développeur de site E-commerce (Mission)', 'Evo Clothes', 'Tout le maroc', 'MAD 5000-10000', 'full-time', 'onsite', '2025-07-07 21:15:57', 'Expertise en développement de sites e-commerce (WooCommerce, Shopify, Magento, Prestashop), HTML, CSS, JavaScript, intégration de passerelles de paiement, gestion de bases de données, optimisation SEO et expérience utilisateur.', 'active', 0, 'Nous recherchons un développeur pour créer et optimiser un site e-commerce performant et sécurisé. La mission implique le développement complet de la plateforme, l\'intégration de fonctionnalités de paiement, la gestion des stocks, et l’optimisation pour une expérience utilisateur fluide. Vous serez en charge de l’intégration de la charte graphique, des tests de performance et de la mise en ligne du site.', 'Expérience prouvée en développement de sites e-commerce (portfolio requis).\r\n\r\nBonne maîtrise des CMS et plateformes e-commerce (WooCommerce, Shopify, Magento, Prestashop).\r\n\r\nConnaissances solides en SEO, UX/UI et intégration des outils marketing (Google Analytics, Google Ads).\r\n\r\nCapacité à travailler de manière autonome et à respecter des délais serrés.', '3', 'expert-level'),
	(39, 'aa-686c14bd00180', 9, 'Designer Graphique pour Vêtements (T-shirts, Hoodies, etc.)', 'Evo Clothes', 'Tout le maroc', 'MAD 2000-5000', 'part-time', 'remote', '2025-07-07 21:24:42', 'Maîtrise des logiciels de design (Adobe Illustrator, Photoshop), créativité dans la conception de graphiques pour vêtements, sens du style et des tendances, compréhension des techniques d\'impression (sérigraphie, impression numérique), capacité à travailler avec des briefs créatifs.', 'active', 0, 'Nous recherchons un designer graphique passionné pour créer des designs uniques et tendances pour nos collections de t-shirts, hoodies et autres vêtements. Vous serez responsable de la création de graphiques attrayants qui captent l’attention, tout en respectant les tendances actuelles du marché de la mode. Vous travaillerez en étroite collaboration avec notre équipe pour produire des designs originaux et prêts pour', 'Expérience préalable dans la création de graphiques pour vêtements ou produits similaires.\r\n\r\nPortfolio avec des exemples de créations pour des vêtements (souhaité).\r\n\r\nBonne maîtrise des outils de conception (Adobe Illustrator, Photoshop, etc.).\r\n\r\nCapacité à respecter les délais et à gérer plusieurs projets à la fois.', '42', 'expert-level'),
	(40, 'je-6828a8ed3f379', 1, 'Developpeur BackEnd', 'YSNet', 'Casablanca, Maroc', 'MAD 10000-15000', 'full-time', 'onsite', '2025-07-08 02:07:34', 'PHP, Laravel, MySQL, REST API, Git, Docker', 'closed', 0, 'Nous recherchons un Développeur Back-End senior talentueux et motivé pour rejoindre notre équipe technique à Casablanca. Vous serez responsable de la conception, du développement et de la maintenance des services back-end pour nos applications web. Vous collaborerez étroitement avec l’équipe front-end, DevOps et produit pour livrer des solutions robustes, évolutives et performantes.', 'Minimum 5 ans d’expérience en développement back-end.\r\n\r\nExcellente maîtrise de PHP et du framework Laravel.\r\n\r\nBonne compréhension des bases de données relationnelles (MySQL).\r\n\r\nExpérience dans la conception d’API RESTful.\r\n\r\nMaîtrise des outils de versioning (Git).', '2', 'senior-level');

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
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expires` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table job.users: ~10 rows (approximately)
INSERT INTO `users` (`userId`, `fullname`, `username`, `email`, `phone`, `password`, `role`, `profile_picture`, `description`, `reset_token`, `token_expires`) VALUES
	('686a81b2200ca', 'Yassin Fikri', 'AdminYassin', 'yassin.fikri00@gmail.com', '0762695921', 'yassinelf', 'admin', NULL, NULL, NULL, NULL),
	('aa-686c14bd00180', 'Ahmed Amrani', 'AhmedAmrani', 'ahmedamrani01@gmail.com', '0652695121', '$2y$10$o3qfWu5fKQeDfbdSx1wvgO1up2Yjq1sQdMJihwqKtHzlSZsFacNEG', 'employer', NULL, NULL, NULL, NULL),
	('bo-686c0b6231164', 'Brahim Ouazzani', 'Brahim', 'brahimouazzani@gmail.com', '0660004194', '$2y$10$g8x6RtReIo1x6CTaIKIxpOjLAB8E7wFDwobX0spN5EKnvVfykJJTO', 'applicant', NULL, NULL, NULL, NULL),
	('fb-686c0abd87777', 'Fatima Zahra Bennani', 'Fatima Zahra Bennani', 'fatimazahra12@gmail.com', '0612345678', '$2y$10$jIGGgM4BhIi8ICzQG9EN3eOGjXI6J8oIj29zTctGI.Vm5HWE8sVJa', 'employer', NULL, NULL, NULL, NULL),
	('ha-686c0ce134d66', 'Hamza Alaoui', 'Hamza Alaoui', 'hamza.alaoui05@gmail.com', '0614567890', '$2y$10$/qP7VFRstqVLt1sbvNE7DenN5Q.R9ZxMHWE48aaHkxgVlJUogtVnC', 'employer', NULL, NULL, NULL, NULL),
	('ha-686c6e2e31479', 'Hatim Alaoui', 'Hatim', 'hatimalaoui@gmail.com', '0776564121', '$2y$10$0arXDadcv4pL0zngP4cv1ecRwdt3vRgcmlLwhpxH9CCt9OSQH4C.2', 'applicant', NULL, NULL, NULL, NULL),
	('je-6828a8ed3f379', 'Othmane Bouziane', 'Othmane', 'Othmane@gmail.com', '0762695921', '$2y$10$scepp4g/KwVUEn8S.QX2ZOn9jB8QTzzO0FdYDY6n0sa4HeZfz1r4e', 'employer', NULL, '', NULL, NULL),
	('jk-68374716d9a61', 'Jawad Kadi', 'Jawad_Kadi', 'jawadkadi@gmail.com', '0776564121', '$2y$10$sFz2JsvMpApxkzkT8jrBoON5eYJk0sFvWFtiqpKZd.tsYGPdU17u.', 'employer', NULL, NULL, NULL, NULL),
	('kh-686c2e8f004f5', 'Khalid Hakimi', 'KhalidHakimi', 'khalidhakimi@gmail.com', '0761623545', '$2y$10$z8IgJrZfmi7YTGu4DSKpbuzsA6lpStNvm4BpXfwixNaxnuJ4It7A6', 'employer', NULL, NULL, NULL, NULL),
	('me-686c6abbc7d38', 'Mohammed El Alami', 'Mohammed', 'mohammedalami@gmail.com', '0614567890', '$2y$10$JEabq2mAwwF6oX051lIrW.wrURu9d6NC3aQo9kfjYSd/FFikt99We', 'applicant', NULL, NULL, NULL, NULL),
	('yf-68389cf693b45', 'Yassin Fikri', 'Yassin', 'yassin.fikri00@gmail.com', '0762695921', '$2y$10$hWnE96XGJS/M2PGf7QNEFOaPyoBd3pZSEIGEG5W/G0twfED22o9a.', 'applicant', NULL, NULL, '1ea795eda7bc40aed93cc9776654b4cd1193315460b44a75ea0624992ca9b22c', '2025-07-07 20:06:57');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
