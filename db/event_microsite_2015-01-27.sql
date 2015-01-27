# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: event_microsite
# Generation Time: 2015-01-27 18:02:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Accomodation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Accomodation`;

CREATE TABLE `Accomodation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Accomodation` WRITE;
/*!40000 ALTER TABLE `Accomodation` DISABLE KEYS */;

INSERT INTO `Accomodation` (`id`, `name`, `address`, `url`)
VALUES
	(1,'Corvin Hotel Budapest','H-1094 Budapest, Angyal utca 31.',''),
	(2,'Hotel Sissi Budapest***','H-1094 Budapest, Angyal utca 33.',''),
	(3,'Hotel Thomas Budapest***','H-1094 Budapest, Liliom utca 44.',''),
	(4,'Leonardo Hotel Budapest****','1094 Budapest, Tompa u. 30-34.',''),
	(5,'Hotel Palazzo Zichy****','1088 Budapest, Lőrinc pap tér 2.',''),
	(6,'Four Points by Sheraton','6000 Kecskemét, Izsáki út 6.','');

/*!40000 ALTER TABLE `Accomodation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table AccomodationReservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AccomodationReservation`;

CREATE TABLE `AccomodationReservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_registration_id` int(11) DEFAULT NULL,
  `accomodation_id` int(11) DEFAULT NULL,
  `room_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `persons` smallint(6) NOT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EF53A34B4AEEEB73` (`event_registration_id`),
  KEY `IDX_EF53A34BFD70509C` (`accomodation_id`),
  CONSTRAINT `FK_EF53A34B4AEEEB73` FOREIGN KEY (`event_registration_id`) REFERENCES `EventRegistration` (`id`),
  CONSTRAINT `FK_EF53A34BFD70509C` FOREIGN KEY (`accomodation_id`) REFERENCES `Accomodation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `AccomodationReservation` WRITE;
/*!40000 ALTER TABLE `AccomodationReservation` DISABLE KEYS */;

INSERT INTO `AccomodationReservation` (`id`, `event_registration_id`, `accomodation_id`, `room_type`, `persons`, `check_in`, `check_out`)
VALUES
	(3,4,2,'single',1,'2015-06-18','2015-06-21'),
	(4,5,4,'single',1,'2015-06-19','2015-06-21');

/*!40000 ALTER TABLE `AccomodationReservation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table AccomodationRoom
# ------------------------------------------------------------

DROP TABLE IF EXISTS `AccomodationRoom`;

CREATE TABLE `AccomodationRoom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `roomtype_id` int(11) DEFAULT NULL,
  `accomodation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1A695B8E71F7E88B` (`event_id`),
  KEY `IDX_1A695B8E7D31ADD1` (`roomtype_id`),
  KEY `IDX_1A695B8EFD70509C` (`accomodation_id`),
  CONSTRAINT `FK_1A695B8E71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `Event` (`id`),
  CONSTRAINT `FK_1A695B8E7D31ADD1` FOREIGN KEY (`roomtype_id`) REFERENCES `RoomType` (`id`),
  CONSTRAINT `FK_1A695B8EFD70509C` FOREIGN KEY (`accomodation_id`) REFERENCES `Accomodation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `AccomodationRoom` WRITE;
/*!40000 ALTER TABLE `AccomodationRoom` DISABLE KEYS */;

INSERT INTO `AccomodationRoom` (`id`, `price`, `event_id`, `roomtype_id`, `accomodation_id`)
VALUES
	(1,18000,2,1,5),
	(2,11000,2,2,5);

/*!40000 ALTER TABLE `AccomodationRoom` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Dining
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Dining`;

CREATE TABLE `Dining` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `dates` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table Event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Event`;

CREATE TABLE `Event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;

INSERT INTO `Event` (`id`, `name`, `start`, `end`)
VALUES
	(1,'espcr','2015-06-19','2015-06-20'),
	(2,'mgyaitt','2015-05-24','2015-05-25');

/*!40000 ALTER TABLE `Event` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table EventRegistration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `EventRegistration`;

CREATE TABLE `EventRegistration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postal` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `registrant_type_id` int(11) DEFAULT NULL,
  `regnumber` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A10E2FDBA76ED395` (`user_id`),
  KEY `IDX_A10E2FDBDF376EF8` (`registrant_type_id`),
  KEY `IDX_A10E2FDB71F7E88B` (`event_id`),
  CONSTRAINT `FK_A10E2FDB71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `Event` (`id`),
  CONSTRAINT `FK_A10E2FDBA76ED395` FOREIGN KEY (`user_id`) REFERENCES `SiteUser` (`id`),
  CONSTRAINT `FK_A10E2FDBDF376EF8` FOREIGN KEY (`registrant_type_id`) REFERENCES `RegistrantType` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `EventRegistration` WRITE;
/*!40000 ALTER TABLE `EventRegistration` DISABLE KEYS */;

INSERT INTO `EventRegistration` (`id`, `user_id`, `firstname`, `lastname`, `title`, `institution`, `country`, `address`, `phone`, `fax`, `email`, `city`, `postal`, `registrant_type_id`, `regnumber`, `event_id`)
VALUES
	(1,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL),
	(2,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL),
	(3,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL),
	(4,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL),
	(5,2,'Oláh','Gergely','Mr.','qwrfwerf0','AL','werfwerfwer','+36709439436',NULL,'olah.gergely@pixeloid.hu','werfgwerfgwerf','24',NULL,NULL,NULL);

/*!40000 ALTER TABLE `EventRegistration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Presentation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Presentation`;

CREATE TABLE `Presentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table RegistrantType
# ------------------------------------------------------------

DROP TABLE IF EXISTS `RegistrantType`;

CREATE TABLE `RegistrantType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price_before` decimal(10,0) NOT NULL,
  `price_after` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table RegistrantType_Event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `RegistrantType_Event`;

CREATE TABLE `RegistrantType_Event` (
  `registranttype_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`registranttype_id`,`event_id`),
  KEY `IDX_24537BD19D497D04` (`registranttype_id`),
  KEY `IDX_24537BD171F7E88B` (`event_id`),
  CONSTRAINT `FK_24537BD171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `Event` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_24537BD19D497D04` FOREIGN KEY (`registranttype_id`) REFERENCES `RegistrantType` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table RoomType
# ------------------------------------------------------------

DROP TABLE IF EXISTS `RoomType`;

CREATE TABLE `RoomType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `RoomType` WRITE;
/*!40000 ALTER TABLE `RoomType` DISABLE KEYS */;

INSERT INTO `RoomType` (`id`, `name`)
VALUES
	(1,'Egyágyas szoba'),
	(2,'Kétágyas szoba'),
	(3,'Apartman 2 fő részére'),
	(4,'Apartman 3 fő részére'),
	(5,'Lakosztály 2 fő részére'),
	(6,'Lakosztály 3 fő részére'),
	(7,'Lakosztály 4 fő részére');

/*!40000 ALTER TABLE `RoomType` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table SiteUser
# ------------------------------------------------------------

DROP TABLE IF EXISTS `SiteUser`;

CREATE TABLE `SiteUser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_6D2133FB92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_6D2133FBA0D96FBF` (`email_canonical`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `SiteUser` WRITE;
/*!40000 ALTER TABLE `SiteUser` DISABLE KEYS */;

INSERT INTO `SiteUser` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`)
VALUES
	(1,'werfw@sdfvsd.hu','werfw@sdfvsd.hu','werfw@sdfvsd.hu','werfw@sdfvsd.hu',0,'jcgrxnqblu04wsokowgsskg4soocggs','9vUXjnTQ',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(2,'olah.gergely@pixeloid.hu','olah.gergely@pixeloid.hu','olah.gergely@pixeloid.hu','olah.gergely@pixeloid.hu',0,'99yp1cue3bwgck04s40cog0o8080gw4','LbtUeQ8z',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL);

/*!40000 ALTER TABLE `SiteUser` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
