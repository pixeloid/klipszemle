# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Database: event_microsite
# Generation Time: 2015-02-01 14:49:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table DiningReservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `DiningReservation`;

CREATE TABLE `DiningReservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_registration_id` int(11) DEFAULT NULL,
  `dining_date_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8951392779876E39` (`dining_date_id`),
  KEY `IDX_895139274AEEEB73` (`event_registration_id`),
  CONSTRAINT `FK_895139274AEEEB73` FOREIGN KEY (`event_registration_id`) REFERENCES `EventRegistration` (`id`),
  CONSTRAINT `FK_8951392779876E39` FOREIGN KEY (`dining_date_id`) REFERENCES `DiningDate` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
