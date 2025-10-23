# ************************************************************
# Sequel Ace SQL dump
# Version 20095
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.4.6)
# Database: Student_TrackerV2
# Generation Time: 2025-10-23 09:30:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Grades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Grades`;

CREATE TABLE `Grades` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `grade` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_id` (`student_id`,`subject`),
  CONSTRAINT `Grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `Grades` WRITE;
/*!40000 ALTER TABLE `Grades` DISABLE KEYS */;

INSERT INTO `Grades` (`id`, `student_id`, `subject`, `grade`)
VALUES
	(1,'S001','Maths',90),
	(2,'S001','English',80),
	(3,'S002','Maths',75),
	(4,'S002','English',85),
	(5,'S003','Maths',88),
	(6,'S003','English',92),
	(7,'S004','Maths',95),
	(8,'S004','English',78),
	(9,'S005','Maths',65),
	(10,'S005','English',70),
	(22,'68f9f13e889ee','Maths',16),
	(23,'68f9f13e889ee','English',20),
	(34,'68f9f2b97777f','Maths',100),
	(38,'68f9f2b97777f','Science',90);

/*!40000 ALTER TABLE `Grades` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Students
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Students`;

CREATE TABLE `Students` (
  `id` varchar(100) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `Students` WRITE;
/*!40000 ALTER TABLE `Students` DISABLE KEYS */;

INSERT INTO `Students` (`id`, `name`)
VALUES
	('68f9f13e889ee','Test'),
	('68f9f2b97777f','Test II'),
	('S001','Alice'),
	('S002','Bob'),
	('S003','Charlie'),
	('S004','Diana'),
	('S005','Ethan');

/*!40000 ALTER TABLE `Students` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
