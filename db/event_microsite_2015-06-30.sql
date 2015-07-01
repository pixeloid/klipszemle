# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: event_microsite
# Generation Time: 2015-06-30 07:24:08 +0000
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
	(1,'Lifestyle Hotel Mátra****','3233 Mátraháza',''),
	(2,'Hotel Sissi Budapest***','H-1094 Budapest, Angyal utca 33.',''),
	(3,'Hotel Thomas Budapest***','H-1094 Budapest, Liliom utca 44.',''),
	(4,'Leonardo Hotel Budapest****','1094 Budapest, Tompa u. 30-34.',''),
	(5,'Hotel Palazzo Zichy****','1088 Budapest, Lőrinc pap tér 2.',''),
	(6,'Four Points by Sheraton','6000 Kecskemét, Izsáki út 6.',' www.fourpointskecskemet.hu'),
	(7,'Sport Hotel','6000 Kecskemét, Izsáki út 15.',' www.sporthotelkecskemet.hu');

/*!40000 ALTER TABLE `Accomodation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Dining
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Dining`;

CREATE TABLE `Dining` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,0) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `dining_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_57E3EA871F7E88B` (`event_id`),
  KEY `IDX_57E3EA845CD4C1` (`dining_type_id`),
  CONSTRAINT `FK_57E3EA845CD4C1` FOREIGN KEY (`dining_type_id`) REFERENCES `DiningType` (`id`),
  CONSTRAINT `FK_57E3EA871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `Event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Dining` WRITE;
/*!40000 ALTER TABLE `Dining` DISABLE KEYS */;

INSERT INTO `Dining` (`id`, `price`, `event_id`, `dining_type_id`)
VALUES
	(1,5250,4,2),
	(2,5250,4,5),
	(3,7000,4,5);

/*!40000 ALTER TABLE `Dining` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table DiningDate
# ------------------------------------------------------------

DROP TABLE IF EXISTS `DiningDate`;

CREATE TABLE `DiningDate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dining_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6D50C1C3C5A30C08` (`dining_id`),
  CONSTRAINT `FK_6D50C1C3C5A30C08` FOREIGN KEY (`dining_id`) REFERENCES `Dining` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `DiningDate` WRITE;
/*!40000 ALTER TABLE `DiningDate` DISABLE KEYS */;

INSERT INTO `DiningDate` (`id`, `dining_id`, `date`)
VALUES
	(1,1,'2015-10-01'),
	(2,1,'2015-10-02'),
	(3,1,'2015-10-03'),
	(4,2,'2015-10-01'),
	(5,3,'2015-10-02');

/*!40000 ALTER TABLE `DiningDate` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table diningdate_diningreservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `diningdate_diningreservation`;

CREATE TABLE `diningdate_diningreservation` (
  `diningdate_id` int(11) NOT NULL,
  `diningreservation_id` int(11) NOT NULL,
  PRIMARY KEY (`diningdate_id`,`diningreservation_id`),
  KEY `IDX_BB8ED2DE30E128D6` (`diningdate_id`),
  KEY `IDX_BB8ED2DE9E3351D7` (`diningreservation_id`),
  CONSTRAINT `FK_BB8ED2DE30E128D6` FOREIGN KEY (`diningdate_id`) REFERENCES `DiningDate` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_BB8ED2DE9E3351D7` FOREIGN KEY (`diningreservation_id`) REFERENCES `DiningReservation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `diningdate_diningreservation` WRITE;
/*!40000 ALTER TABLE `diningdate_diningreservation` DISABLE KEYS */;

INSERT INTO `diningdate_diningreservation` (`diningdate_id`, `diningreservation_id`)
VALUES
	(1,1),
	(1,2),
	(1,3),
	(1,4),
	(1,5),
	(1,6),
	(1,7),
	(1,12),
	(1,14),
	(1,15),
	(1,18),
	(1,19),
	(1,20),
	(1,21),
	(1,22),
	(1,25),
	(1,31),
	(1,32),
	(1,33),
	(1,36),
	(1,37),
	(1,38),
	(1,39),
	(1,40),
	(1,41),
	(1,42),
	(1,43),
	(1,44),
	(1,45),
	(1,46),
	(1,47),
	(1,48),
	(1,49),
	(1,50),
	(1,51),
	(1,52),
	(1,53),
	(1,56),
	(1,59),
	(1,60),
	(1,61),
	(1,63),
	(1,64),
	(1,65),
	(1,66),
	(1,67),
	(1,68),
	(1,69),
	(1,70),
	(1,71),
	(1,72),
	(1,73),
	(1,77),
	(1,80),
	(1,81),
	(1,82),
	(1,83),
	(1,84),
	(1,85),
	(1,89),
	(1,90),
	(1,91),
	(1,92),
	(1,93),
	(1,94),
	(1,95),
	(1,96),
	(1,97),
	(1,98),
	(1,99),
	(1,103),
	(1,104),
	(1,105),
	(1,106),
	(1,107),
	(1,108),
	(1,110),
	(2,1),
	(2,2),
	(2,3),
	(2,4),
	(2,5),
	(2,6),
	(2,7),
	(2,12),
	(2,14),
	(2,15),
	(2,16),
	(2,17),
	(2,18),
	(2,19),
	(2,20),
	(2,31),
	(2,32),
	(2,33),
	(2,36),
	(2,38),
	(2,39),
	(2,40),
	(2,41),
	(2,42),
	(2,43),
	(2,53),
	(2,56),
	(2,60),
	(2,62),
	(2,63),
	(2,64),
	(2,65),
	(2,66),
	(2,67),
	(2,68),
	(2,69),
	(2,71),
	(2,72),
	(2,81),
	(2,84),
	(2,85),
	(2,89),
	(2,90),
	(2,91),
	(2,92),
	(2,93),
	(2,94),
	(2,95),
	(2,96),
	(2,97),
	(2,98),
	(2,103),
	(2,105),
	(2,106),
	(2,110),
	(2,111),
	(3,1),
	(3,3),
	(3,4),
	(3,5),
	(3,6),
	(3,8),
	(3,12),
	(3,18),
	(3,19),
	(3,20),
	(3,21),
	(3,22),
	(3,26),
	(3,52),
	(3,53),
	(3,56),
	(3,58),
	(3,60),
	(3,62),
	(3,63),
	(3,69),
	(3,72),
	(3,73),
	(3,81),
	(3,84),
	(3,103),
	(3,110),
	(3,111),
	(4,1),
	(4,2),
	(4,3),
	(4,4),
	(4,5),
	(4,6),
	(4,7),
	(4,8),
	(4,12),
	(4,14),
	(4,15),
	(4,17),
	(4,18),
	(4,19),
	(4,20),
	(4,21),
	(4,22),
	(4,25),
	(4,26),
	(4,30),
	(4,31),
	(4,32),
	(4,33),
	(4,34),
	(4,36),
	(4,38),
	(4,39),
	(4,40),
	(4,41),
	(4,42),
	(4,43),
	(4,53),
	(4,56),
	(4,58),
	(4,60),
	(4,61),
	(4,63),
	(4,64),
	(4,65),
	(4,66),
	(4,67),
	(4,68),
	(4,69),
	(4,70),
	(4,71),
	(4,72),
	(4,73),
	(4,74),
	(4,75),
	(4,78),
	(4,79),
	(4,80),
	(4,81),
	(4,82),
	(4,84),
	(4,85),
	(4,86),
	(4,87),
	(4,88),
	(4,89),
	(4,90),
	(4,91),
	(4,92),
	(4,93),
	(4,94),
	(4,95),
	(4,96),
	(4,97),
	(4,98),
	(4,102),
	(4,103),
	(4,104),
	(4,105),
	(4,107),
	(4,108),
	(4,109),
	(4,110),
	(4,111),
	(5,111);

/*!40000 ALTER TABLE `diningdate_diningreservation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table DiningReservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `DiningReservation`;

CREATE TABLE `DiningReservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_registration_id` int(11) DEFAULT NULL,
  `special` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_895139274AEEEB73` (`event_registration_id`),
  CONSTRAINT `FK_895139274AEEEB73` FOREIGN KEY (`event_registration_id`) REFERENCES `EventRegistration` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `DiningReservation` WRITE;
/*!40000 ALTER TABLE `DiningReservation` DISABLE KEYS */;

INSERT INTO `DiningReservation` (`id`, `event_registration_id`, `special`)
VALUES
	(1,6,'Vega'),
	(2,7,'laktóz érzékeny leszek'),
	(3,8,'Vega'),
	(4,9,'laktóz érzékeny'),
	(5,10,NULL),
	(6,11,NULL),
	(7,12,NULL),
	(8,13,NULL),
	(9,14,NULL),
	(10,15,'A regisztrációt az Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítvány fizeti.A szállást én.'),
	(11,16,NULL),
	(12,17,NULL),
	(13,18,NULL),
	(14,19,NULL),
	(15,20,NULL),
	(16,21,NULL),
	(17,22,NULL),
	(18,23,NULL),
	(19,24,NULL),
	(20,25,NULL),
	(21,26,NULL),
	(22,27,NULL),
	(23,28,NULL),
	(24,29,NULL),
	(25,30,NULL),
	(26,31,NULL),
	(27,32,NULL),
	(28,33,NULL),
	(29,34,NULL),
	(30,35,NULL),
	(31,36,NULL),
	(32,37,NULL),
	(33,38,NULL),
	(34,39,NULL),
	(35,40,NULL),
	(36,41,NULL),
	(37,42,NULL),
	(38,43,NULL),
	(39,44,NULL),
	(40,45,NULL),
	(41,46,NULL),
	(42,47,NULL),
	(43,48,NULL),
	(44,49,NULL),
	(45,50,NULL),
	(46,51,NULL),
	(47,52,NULL),
	(48,53,NULL),
	(49,54,NULL),
	(50,55,NULL),
	(51,56,NULL),
	(52,57,NULL),
	(53,58,NULL),
	(54,59,NULL),
	(55,60,NULL),
	(56,61,NULL),
	(57,62,NULL),
	(58,63,NULL),
	(59,64,NULL),
	(60,65,NULL),
	(61,66,NULL),
	(62,67,'A regisztrációt meghívott vendégként a szervező fizeti'),
	(63,68,NULL),
	(64,69,NULL),
	(65,70,NULL),
	(66,71,NULL),
	(67,72,NULL),
	(68,73,NULL),
	(69,74,'Tagdijat szedem,regisztrÃ¡ciÃ³nÃ¡l egy asztal Ã©s kÃ©t szÃ©k,nem orvos,asszisztens vagyok,regisztr.d'),
	(70,75,NULL),
	(71,76,NULL),
	(72,77,'TagdÃ­jat szedem,asztal Ã©s kÃ©t szÃ©k,asszisztens vagyok,asszintensi regisztrÃ¡ciÃ³s dÃ­j'),
	(73,78,NULL),
	(74,79,NULL),
	(75,80,NULL),
	(76,81,NULL),
	(77,82,NULL),
	(78,83,NULL),
	(79,84,NULL),
	(80,85,NULL),
	(81,86,NULL),
	(82,87,NULL),
	(83,88,NULL),
	(84,89,'Tagdíjt szedek,egy asztal,két szék'),
	(85,90,NULL),
	(86,91,NULL),
	(87,92,NULL),
	(88,93,NULL),
	(89,94,NULL),
	(90,95,NULL),
	(91,96,NULL),
	(92,97,NULL),
	(93,98,NULL),
	(94,99,NULL),
	(95,100,NULL),
	(96,101,NULL),
	(97,102,NULL),
	(98,103,NULL),
	(99,104,NULL),
	(100,105,NULL),
	(101,106,NULL),
	(102,107,NULL),
	(103,108,NULL),
	(104,109,NULL),
	(105,110,NULL),
	(106,111,NULL),
	(107,112,NULL),
	(108,113,NULL),
	(109,114,NULL),
	(110,115,NULL),
	(111,116,NULL);

/*!40000 ALTER TABLE `DiningReservation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table DiningType
# ------------------------------------------------------------

DROP TABLE IF EXISTS `DiningType`;

CREATE TABLE `DiningType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `DiningType` WRITE;
/*!40000 ALTER TABLE `DiningType` DISABLE KEYS */;

INSERT INTO `DiningType` (`id`, `name`)
VALUES
	(1,'Ebéd'),
	(2,'Svédasztalos ebéd'),
	(3,'Vacsora'),
	(4,'Gálavacsora'),
	(5,'Vacsora nem szállóvendégek részére');

/*!40000 ALTER TABLE `DiningType` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Event`;

CREATE TABLE `Event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `tagline` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FA6F25A3989D9B62` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;

INSERT INTO `Event` (`id`, `name`, `start`, `end`, `tagline`, `location`, `slug`)
VALUES
	(1,'espcr','2015-06-19','2015-06-20',NULL,NULL,'espcr'),
	(2,'mgyaitt','2015-05-24','2015-05-25','Magyar Gyermekaneszteziológiai és Intenzív Terápiás Társaság 2015. évi Tudományos Ülése',NULL,'mgyaitt'),
	(4,'MGYGT 2015','2015-10-03','2015-10-03','Magyar Gyermekaneszteziológiai és Intenzív Terápiás Társaság 2015. évi Tudományos Ülése',NULL,'mgygt');

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
  `title` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `paymentmethod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoiceType_sponsored` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billingName_sponsored` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billingAddress_sponsored` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billingContactPerson_sponsored` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billingName_transfer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billingAddress_transfer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra1` int(11) DEFAULT NULL,
  `extra2` int(11) DEFAULT NULL,
  `extra3` int(11) DEFAULT NULL,
  `extra4` int(11) DEFAULT NULL,
  `created` date NOT NULL,
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

INSERT INTO `EventRegistration` (`id`, `user_id`, `firstname`, `lastname`, `title`, `institution`, `country`, `address`, `phone`, `fax`, `email`, `city`, `postal`, `registrant_type_id`, `regnumber`, `event_id`, `paymentmethod`, `invoiceType_sponsored`, `billingName_sponsored`, `billingAddress_sponsored`, `billingContactPerson_sponsored`, `billingName_transfer`, `billingAddress_transfer`, `extra1`, `extra2`, `extra3`, `extra4`, `created`)
VALUES
	(1,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00'),
	(2,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00'),
	(3,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00'),
	(4,1,'kiss','Bél','Mr.','qwrfwerf0','AF','werfwerfwer','12341234',NULL,'werfw@sdfvsd.hu','werfgwerfgwerf','24',NULL,NULL,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00'),
	(5,2,'Oláh','Gergely','Mr.','qwrfwerf0','AL','werfwerfwer','+36709439436',NULL,'olah.gergely@pixeloid.hu','werfgwerfgwerf','24',NULL,NULL,NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0000-00-00'),
	(6,2,'sdfvs','Gergely','Dr.','Budapest','HU','fvsdfv','+36709439436','sdfvsd','olah.gergely@pixeloid.hu','asdfvsdfvsd','123123',5,'123412312',2,'transfer','elolegszamla',NULL,NULL,NULL,'Kiss Béla','lsidufhv psdufhvpsd ihvpsdivdsfvsdfv',1,1,1,NULL,'0000-00-00'),
	(7,3,'veres','emese','Dr.','mis','HU','fgkj','oizhjgfr',NULL,'emese.veres@misandbos.hu','buapó','1234',4,'1234',2,'sponsored','elolegszamla','Mis & Bos kft.','hhjjbh df Budqapest , wéodubef','Horváthné Tihanyi Barbara - 20/419-9219','zfj','h',1,0,0,NULL,'0000-00-00'),
	(8,4,'Kiss','Béla','Dr.','Kaposvár, Hungary','HU','asdfvsdfv sdfvs','87687687686','87687687676','info@pixeloid.hu','Miskolc','2233',5,'23234234',2,'transfer','elolegszamla',NULL,NULL,NULL,'Kiss Béla','ewerwerv wervewrvewrv',1,1,1,NULL,'0000-00-00'),
	(9,3,'veres','emese','Dr.','fghn','HU','wedrfg','dfgthzj',NULL,'emese.veres@misandbos.hu','dfghj','1234',1,'1234',2,'transfer','elolegszamla','doé','dofé','zfuoé','tzerui','sd',1,1,1,NULL,'0000-00-00'),
	(10,3,'veres','gizi','Dr.','jihug','HU','frtgh','rfrgf',NULL,'emese.veres@misandbos.hu','poigh','3214',1,'1234',2,'sponsored','elolegszamla','ldezle','d6lke8ld','eileil',NULL,NULL,1,1,1,NULL,'2015-03-04'),
	(11,5,'Szentirmai','Réka','Dr.','Heim Pál Gyermekkórház Egészségügyi Szakkönyvtár, Budapest, Magyarország','HU','Üllői út 86.','06203927912',NULL,'szentirmai.reka@hotmail.com','Budapest','1089',1,'56230',2,'transfer','elolegszamla',NULL,NULL,NULL,'xxx','xxx',1,1,1,NULL,'2015-03-04'),
	(12,6,'Praefort','László','dr.','Medve-barlang','HU','Galamb u. 10/B fsz. 2.','20/9659-558','-','old.bear69@yahoo.com','Szeged','6725',3,'21668',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Praefort László','6725 Szeged, Galamb u. 10/B fsz. 2.',1,1,1,NULL,'2015-03-12'),
	(13,7,'Tövisházi','Gyula','Dr.','Szent Márton Gyermekmentőszolgálat Kha','HU','Esztergomi út 42.','+36204621719',NULL,'tovishazigyula@gmail.com','Budapest','1138',1,'70759',2,'sponsored','elolegszamla','Szent Márton Gyermekmentőszolgálat Közhasznú Alapítvány','1061 Budapest Andrássy út 10.','László Krisztina: laszlok@gyermekrohamkocsi.hu, 20/9130727',NULL,NULL,1,1,1,NULL,'2015-03-12'),
	(14,8,'Varju','Kornelia','Dr.','Hospital Universitario Miguel Servet, Paseo Isabel la Catolica, Zaragoza, Spanyolország','ES','Calle San Pablo 23 3D','+36702294572',NULL,'vnellus@freemail.hu','Zaragoza','50003',1,'59702',2,'transfer','elolegszamla',NULL,NULL,NULL,'Varju Kornelia','Zaragoza 50003 Calle San Pablo 23 3D España',1,1,1,NULL,'2015-03-12'),
	(15,9,'Péter','Ádám','Dr.','Heim Pál Gyermekkórház','HU','Üllői út 86','06302734033',NULL,'peteradam21@yahoo.com','Budapest','1086',1,'64598',2,'transfer','elolegszamla',NULL,NULL,NULL,'Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítvány','1086 Budapest Üllői 86',1,0,0,NULL,'2015-03-12'),
	(16,10,'Próba','Betti','Dr.','YXU, London, Ontario, Kanada','HU','xy','12345','1234566','szabobernadett92@gmail.com','bp','1111',1,'12345',2,'transfer','elolegszamla',NULL,NULL,NULL,'yx','xy',1,0,0,NULL,'2015-03-13'),
	(17,11,'Jenei','Márta Kata','Dr.','Egyesített Szent István és Szent László Kórház és Rendelőintézet Szent László Kórháza, Budapest, Gyáli út, Magyarország','HU','Albert Flórián út 5-7.','+36/70-570-7541','06/1-455-8295','martakata@gmail.com','Budapest','1097',1,'70255',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Jenei Márta Kata','1097 Budapest, Albert Flórián út 5-7.',1,1,1,NULL,'2015-03-13'),
	(18,12,'Lődi','Ágnes','Dr.','SZTE ÁOK AITI','HU','Pozsonyi u. 23.','303267176',NULL,'lodiagnes@gmail.com','Szeged','6724',1,'45325',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr Lődi Ágnes','6724. Szeged Pozsonyi u. 23.',1,0,1,NULL,'2015-03-15'),
	(19,13,'Erdei','Zsuzsanna','Dr.','Semmelweis Egyetem I. Sz. Gyermekgyógyászati Klinika, Budapest, Bókay János utca, Magyarország','HU','Veres Péter utca 4. 2/9.','36-30/2888687',NULL,'erdei.zsuzsanna87@gmail.com','Dunakeszi','2120',3,'76447',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Erdei Zsuzsanna','2120 Dunakeszi, Veres Péter utca 4. 2/9.',1,0,1,NULL,'2015-03-15'),
	(20,14,'Oláh','Roland','Dr.','Szent János Kórház, Budapest, Magyarország','HU','Veres Péter utca 4. 2/9.','36-30/8947135','-','olah.roland1987@gmail.com','Dunakeszi','2120',4,'75196',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Oláh Roland','2120 Dunakeszi, Veres Péter utca 4. 2/9.',0,0,0,NULL,'2015-03-15'),
	(21,15,'Tálosi','Gyula','Dr.','BKMK Gyermekosztály','HU','Nyíri út 38.','06302497387',NULL,'talosigy@gmail.com','Kecskemét','6000',1,'52729',2,'sponsored','elolegszamla','A Szabó Bernadettel történt előzetes egyeztetésnek megfelelően üléselnökként nem kell részvételi díjat fizetnem.','Mis & Bos Kft.','Mis & Bos Kft. – Szabó Bernadett',NULL,NULL,0,1,1,NULL,'2015-03-15'),
	(22,16,'khgvz','kzgukz','Dr.','kuzgouz','HU','liuhgliug','asdvasdv','adfvsdfv','kuzgouizgzu@sfgsdfg.hu','kuzfgkuzg','kuzg75',4,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'sdfvsdfv','sdfv',1,1,1,NULL,'2015-03-17'),
	(23,17,'Hatvani','Krisztina','dr.','Heim Pál Gyermekkórház Egészségügyi Szakkönyvtár, Budapest, Magyarország','HU','Üllői út 86.','0620/9527674','-','hatvanikrisztina@freemail.hu','Budapest','1089',2,'191892',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítvány','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100 mellék:1269',NULL,NULL,1,1,0,NULL,'2015-03-18'),
	(24,18,'Péter','Gabriella','dr.','Heim Pál Gyermekkórház Egészségügyi Szakkönyvtár, Budapest, Magyarország','HU','Üllői út 86.','0630/5269213','-','tamaspetergabi@gmail.com','Budapest','1089',2,'127045',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítvány','Budapest 1089 Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100 mellék:1269',NULL,NULL,1,1,0,NULL,'2015-03-18'),
	(25,19,'Nógrádi','Judit','Dr.','Heim Pál Gyermekkorház','HU','Üllői út 86.','06703927176',NULL,'nogradijudit82@gmail.com','Budapest','1089',1,'69994',2,'sponsored','elolegszamla','Szent Mátron Gyermekmentő Közhasznú Alapítvány(regisztrációs díj, szállás, vacsora, díszvacsora), Intenzív Kezelést Igénylő Gyermekek Megmentéséért alapítvány (ebéd 04.24-25.)','1061 Budapest, Andrássy út 10., 1089 Budapestm Üllői út 86.','László Krisztina, Kézérné Bozóky Klára',NULL,NULL,1,1,1,NULL,'2015-03-18'),
	(26,20,'Király','Jenőné','Dr.','MH Egészségügyi Központ, Budapest, Róbert Károly körút, Magyarország','HU','Róbert Károly 44','0036308246022',NULL,'Bumbulusz@freemail.hu','Budapest','1134',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Alapítvány Károsodott Újszülöttek és Koraszülöttek Rehabilitációjára','2000 Szentendre, Kökény u.4',1,1,1,NULL,'2015-03-18'),
	(27,20,'Csiki','Andrea','Dr.','MH Egészségügyi Központ, Budapest, Róbert Károly körút, Magyarország','HU','Róbert Károly 44','0036308246022',NULL,'Bumbulusz@freemail.hu','Budapest','1134',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Alapítvány Károsodott Újszülöttek és Koraszülöttek Rehabilitációjára','2000 Szentendre, Kökény u.4',1,1,1,NULL,'2015-03-18'),
	(28,21,'Opris','Nicolae','Dr.','Bács-Kiskun Megyei Kórház Szegedi Tudományegyetem Általános Orvostudományi Kar Oktató Kórháza, Kecskemét, Nyíri út, Magyarország','HU','Hetény-Szarkás tanya 356','06703626953',NULL,'qkiwasp@gmail.com','Kecskemét','6044',1,'62994',2,'transfer','elolegszamla',NULL,NULL,NULL,'Lumb-Doc BT','6000 Kecskemét , Alkony u. 65',1,1,1,NULL,'2015-03-18'),
	(29,22,'Dobos','Viktor','Prof.','Heim Pál Gyermekkórház AITO','HU','Üllői út 86.','20/824-3480',NULL,'dobos824@gmail.com','Budapest','1089',2,'186008',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentéséért Alapítvány','1089 Budapest Üllő út 86.','Kéziné Bozóky Klára 459-9106/1269',NULL,NULL,1,0,0,NULL,'2015-03-19'),
	(30,23,'Vojcek','Eszter','Dr.','SZTE Szent-Györgyi Albert Klinikai Központ, Szeged, Magyarország','HU','Korányi fasor 14-15','06705561188',NULL,'vojcekeszter@gmail.com','Szeged','6722',1,'71557',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr Vojcek Eszter','6722 Szeged Petőfi S sgt 40/a 4/2',1,1,1,NULL,'2015-03-19'),
	(31,24,'Pálfi','Anikó','Dr.','Szt. János Kórház','HU','Pannónia u. 72-74.','70/585 0780',NULL,'palfianiko001@gmail.com','Budapest','1133',1,'66890',2,'sponsored','elolegszamla','Numil kft.','1134 Budapest, Róbert Károly Krt. 82-84','Kürti Máté, 30/267 4804',NULL,NULL,1,0,1,NULL,'2015-03-19'),
	(32,25,'Karda','Anna','Dr.','FMC Dialízis Center Kft.Kecskemét.','HU','László Károly u 18','20/337 7954',NULL,'a.karda@freemail.hu','Kecskemét','6000',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Karda Anna','6000 Kecskemét László károly u 18',1,0,0,NULL,'2015-03-19'),
	(33,26,'Próba','Betti','Dr.','gfzh','JP','hkjk','4645','589656','bernadett.szabo@misandbos.hu','jhkj','jhkjkl',2,'5656154',2,'transfer','elolegszamla',NULL,NULL,NULL,'ilzoi','uhliujoéikhfuzkz',1,1,1,NULL,'2015-03-20'),
	(34,28,'casdcasdc','sadcsadcsadc',NULL,'sdfvsdfv','HU','adcsadcs','adcasd','csadcasdasd','c@sdfvsd.hu','csadcs','sad',4,'asdcsad',2,'transfer','elolegszamla',NULL,NULL,NULL,'asdfvdsf','vsdfvds',1,1,1,NULL,'2015-03-20'),
	(35,29,'Cserbák','Anna','Dr.','Bátor Tábor Alapítvány - Hatvan, Magyarország','HU','Harmat uca 12. fsz.36.','+3630-8236503',NULL,'cserbi@gmail.com','Budapest','1102',1,'63052',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr Cserbák Anna','1102 Budapest, Harmat utca 12.',1,0,1,NULL,'2015-03-22'),
	(36,30,'Szilágyi','Adrienn','Dr.','Szabolcs-Szatmár-Bereg Megyei Kórházak és Egyetemi Oktatókórház, Gyermekosztály, Nyíregyháza, Magyarország','HU','Szent István út 68.','06303744962',NULL,'md.szilagyi@gmail.com','Nyíregyháza','4400',1,'72314',2,'transfer','elolegszamla',NULL,NULL,NULL,'Szabolcs-Szatmár-Bereg Megyei Kórházak és Egyetemi Oktatókórház','4400 Nyíregyháza, Szent István út 68.',1,0,0,NULL,'2015-03-23'),
	(37,31,'Biszku','Beáta','Dr.','Szabolcs-Szatmár-Bereg Megyei Kórházak és Egyetemi Oktatókórház Nyíregyháza, Gyermekosztály','HU','Haladás u.26','06204577228',NULL,'beab74@freemail.hu','Nyíregyháza','4400',1,'58588',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Biszku Beáta','4400 Nyíregyháza, Haladás u. 26',1,0,0,NULL,'2015-03-23'),
	(38,30,'Szilágyi','Adrienn','Dr.','Szabolcs-Szatmár-Bereg Megyei Kórházak és Egyetemi Oktatókórház, Gyermekosztály Nyíregyháza, Magyarország','HU','Szent István út 68.','06303744962',NULL,'md.szilagyi@gmail.com','Nyíregyháza','4400',1,'72314',2,'transfer','elolegszamla',NULL,NULL,NULL,'Szabolcs-Szatmár-Bereg Megyei Kórházak és Egyetemi Oktatókórház','4400 Nyíregyháza, Szent István út 68.',1,0,0,NULL,'2015-03-23'),
	(39,32,'Fodor-Papp','Zoltán','dr.','Fejér megyei Szent György Kórház, Székesfehérvár, Seregélyesi út, Magyarország','HU','Széchenyi u. 98.','06-20-2067863',NULL,'dfpz@freemail.hu','Székesfehérvár','8000',1,'57746',2,'transfer','elolegszamla',NULL,NULL,NULL,'dr.Fodor-Papp Zoltán','8000 Székesfehérvár Széchenyi u. 98.',1,1,1,NULL,'2015-03-23'),
	(40,33,'Loboda','Endre','Dr.','Városi Kórház Siófok','HU','Semmelweis u. 1.','20/5509182',NULL,'loboda.endre@siokorhaz.hu','Siófok','8600',1,'40811',2,'transfer','elolegszamla',NULL,NULL,NULL,'EDI-RAD Kft','2458 KULCS BEM U. 4.',1,0,0,NULL,'2015-03-23'),
	(41,34,'Vilmányi','Bernadett','Dr.','Fejér megyei Szent György Kórház, Székesfehérvár, Seregélyesi út, Magyarország','HU','Vadász u. 6.','+36303243852',NULL,'bernadett.vilmanyi@gmail.com','Paks','7030',1,'65762/1',2,'transfer','elolegszamla',NULL,NULL,NULL,'Fejér Megyei Szent György Egyetemi Oktató Kórház','8000 Székesfehérvár Seregélyesi út 3.',0,1,1,NULL,'2015-03-23'),
	(42,35,'dsafvds','fvs','Prof.','dfvdsfvdsfvdsfvdsfvdsfvds','HU','fvdsfvdsf','fvdsfvsdfv','vdsfvds','dsfvdsfvds@sdfvdsfv.hu','dsfvds','fvdsfv',3,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'dfvsdfv','sdfvs',2,1,1,NULL,'2015-03-24'),
	(43,36,'Maráczi','Veronika','dr.','Heim Pál Gyermekkórház Egészségügyi Szakkönyvtár, Budapest, Magyarország','HU','Baross u. 32. 5./1','06204810781',NULL,'marver78@gmail.com','Budapest','1085',1,'63717',2,'transfer','elolegszamla',NULL,NULL,NULL,'dr. Maráczi Veronika','1085 Budapest, Baross u. 32',1,1,1,NULL,'2015-03-24'),
	(44,37,'Galvácsné Székely','Hajnalka',NULL,'BAZ Megyei Kórház és Egyetemi Oktató Kórház Velkey László Gyermekegészségügyi Központ AITO, Miskolc, Szentpéteri kapu, Magyarország','HU','Szentpéteri kapu 72.76','06 20 430 3280',NULL,'gyekint@bazmkorhaz.hu','Miskolc','3526',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'B-A-Z Megyei Kórház Gyermek Intenzív Osztály betegeinek gyógyulásáért Alapítvány','3526 Miskolc Szentpéteri kapu 72-76',1,0,0,NULL,'2015-03-25'),
	(45,37,'Egri','Viktória',NULL,'BAZ Megyei Kórház és Egyetemi Oktató Kórház Velkey László Gyermekegészségügyi Központ AITO, Miskolc, Szentpéteri kapu, Magyarország','HU','Szentpéteri kapu 72-76','06 20 9613 525',NULL,'gyekint@bazmkorhaz.hu','Miskolc','3526',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'B-A-Z Megyei Kórház Gyermek Intenzív Osztály betegeinek gyógyulásáért Alapítvány','3526 Miskolc, Szentpéteri kapu 72-76.',1,0,0,NULL,'2015-03-25'),
	(46,37,'Ormay','Cecília','Dr.','BAZ Megyei Kórház és Egyetemi Oktató Kórház Velkey László Gyermekegészségügyi Központ AITO Miskolc, Szentpéteri kapu, Magyarország','HU','Szentpéteri kapu 72-76','06 20 566 8483',NULL,'gyekint@bazmkorhaz.hu','Miskolc','3526',1,'56530',2,'transfer','elolegszamla',NULL,NULL,NULL,'B-A-Z Megyei Kórház Gyermek Intenzív Osztály betegeinek gyógyulásáért Alapítvány','3526 Miskolc Szentpéteri kapu 72-76.',1,1,1,NULL,'2015-03-25'),
	(47,37,'Béres','Ildikó','Dr.','BAZ Megyei Kórház és Egyetemi Oktató Kórház Velkey László Gyermekegészségügyi Központ AITO Miskolc, Szentpéteri kapu, Magyarország','HU','Szentpéter kapu 72-76','06 20 483 0367',NULL,'gyekint@bazmkorhaz.hu','Miskolc','35263',1,'52406',2,'transfer','elolegszamla',NULL,NULL,NULL,'B-A-Z Megyei Kórház Gyermek Intenzív Osztály betegeinek gyógyulásáért Alapítvány','3526 Miskolc Szentpéteri kapu 72-76.',1,1,1,NULL,'2015-03-25'),
	(48,37,'Bolyos','Aranka','Dr.','BAZ Megyei Kórház és Egyetemi Oktató Kórház Velkey László Gyermekegészségügyi Központ AITO Miskolc, Szentpéteri kapu, Magyarország','HU','Szentpéteri kapu 72-76','06 20 561 6069',NULL,'gyekint@bazmkorhaz.hu','Miskolc','3526',1,'35579',2,'transfer','elolegszamla',NULL,NULL,NULL,'B-A-Z Megyei Kórház Gyermek Intenzív Osztály betegeinek gyógyulásáért Alapítvány','3526 Miskolc Szentpéteri kapu 72-76.',1,0,1,NULL,'2015-03-25'),
	(49,38,'Csete','Krisztina',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','20/3706200','-','csetekriszta@gmail.com','Budapest','1089',2,'226254',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(50,39,'Berecz','Dóra',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','+3630/3708697','-','itaure333@freemail.hu','Budapest','1089',2,'216470',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(51,40,'Germus-Pölöskey','Mariann',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','+3630/7323872','-','poloskaym@freemail.hu','Budapest','1089',2,'130583',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(52,41,'Hertling','Tamás',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','+3670/6022385','-','hertlingtamas@gmail.com','Budapest','1089',2,'192476',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(53,42,'Karsai','Mária',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','+3630/4284768','-','salsi@freemail.hu','Budapest','1089',2,'226278',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(54,43,'Kucsera','Anett',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','+3670/6274951','-','kucseraanett@freemail.hu','Budapest','1089',2,'91031',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(55,44,'Nagy','Judit',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','+3630/3192917','-','n.jucus001@freemail.hu','Budapest','1089',2,'208739',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(56,45,'Kereszti','Zsuzsanna',NULL,'Heim Pál Gyermekkórház','HU','Üllői út 86.','+3620/3112911','-','kereszti.zsuzsanna@gmail.com','Budapest','1089',2,'191949',2,'sponsored','elolegszamla','Intenzív Kezelést Igénylő Gyermekek Megmentésért Alapítványt','1089 Budapest Üllői út 86.','Kézérné Bozóky Klára 06-1/459-9100  1269 mellék',NULL,NULL,2,1,0,NULL,'2015-03-25'),
	(57,46,'Szűcs','Andrea','Dr.','FAI rent-a-jet AG, Flughafenstraße, Nürnberg, Németország','HU','Podmaniczky 17.','+36703895233',NULL,'andreakinga.szucs@gmail.com','Budapest','1065',1,'59322',2,'transfer','elolegszamla',NULL,NULL,NULL,'SZAKDR BT','1065 Budapest Podmaniczky u. 17.',1,0,1,NULL,'2015-03-26'),
	(58,47,'ihoughou','ihouhoh','Dr.','gfziggui','HU','hoghoguik','hgkghkghk',NULL,'hohouhli@joi.hu','Budapest','1161',1,'jijij',2,'transfer','elolegszamla',NULL,NULL,NULL,'iohoklihboli','nljhbouho',1,1,1,NULL,'2015-03-26'),
	(59,48,'Schneider','júlia','dr.','Metohé kft','HU','Bem tér 14/C','70/3132327',NULL,'metohe@hu.inter.net','Győr','9024',1,'45460',2,'transfer','elolegszamla',NULL,NULL,NULL,'METOHÉ Kft.','9024 Győr. Bem tér 14/C',0,0,0,NULL,'2015-03-26'),
	(60,49,'Pap','Zsolt','Dr.','MRE Bethesda Gyermekkórház','HU','Mátyás tér 10-11, I.em 110.','70-330-9139',NULL,'pap.zsolt@gmail.com','Budapest','1084',1,'70950',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr Pap Zsolt','3400 Mezőkövesd, Varjú utca 28.',0,0,0,NULL,'2015-03-26'),
	(61,50,'Miseje','Orsolya','Dr.','Heim Pál kórház','HU','Üllői út 86.','30-236-6892',NULL,'miseje.orsolya@gmail.com','Budapest','1089',1,'55245',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr.Miseje Orsolya','Heim Pál Gyermekkórház, Intenzív osztály, Budapest, 1089. Üllői út 86.',1,1,1,NULL,'2015-03-27'),
	(62,51,'Hangodi','Erika',NULL,'Budapest, Péterfy Sándor utca, Magyarország','HU','Páskomliget u 42.','706305054',NULL,'ehangodi@windowslive.com','Budapest','1156',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Hangodi Erika','1156. Bp. Páskomliget u 42.',1,0,0,NULL,'2015-03-27'),
	(63,52,'Balázs','Gergely','Dr.','Debreceni Egyetem Orvos-és Egészségtudományi Centrum, Debrecen, Nagyerdei körút, Magyarország','HU','Szotyori u. 88/3.','+36304840922',NULL,'balazs.gergely@med.unideb.hu','Debrecen','4031',1,'70977',2,'sponsored','elolegszamla','Szent Márton Gyermekmentő Szolgálat Közhasznú Alapítvány','1061 Budapest, Andrássy út 10.','Boldizsár Mária',NULL,NULL,1,1,1,NULL,'2015-03-27'),
	(64,53,'Németh','Balázs','Dr.','Heim Pál Gyermekkórház KAITO','HU','Üllői út 86','0614599106',NULL,'nemeth.balazs.dr@gmail.com','Budapest','1089',1,'65658',2,'sponsored','elolegszamla','Intenzív kezelést igénylő gyermekek megmentéséért Alapítvány','Budapest 1089, Üllői út 86','Bozóki Klára Heim Pál Gyeremekkórház tel:0614599100',NULL,NULL,1,0,0,NULL,'2015-03-28'),
	(65,54,'Sápi','Erzsébet','Dr.','Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','06703820435','0612998116','drsapierzsebet@gmail.com','Budapest','1096',1,'36556',2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,0,1,NULL,'2015-03-28'),
	(66,55,'Székely','Edgár','Dr.','Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','0612151220','0612998116','edgar@kardio.hu','Budapest','1096',1,'55445',2,'sponsored','elolegszamla','A szervező','A szervező címe','Meghívott előadó,a szervező fizeti',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(67,54,'Székely','Edgár','Dr.','Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','06703820435','0612998116','drsapierzsebet@gmail.com','Budapest','1096',1,'55445',2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(68,54,'Szani','Anikó','Dr.','Szent Imre Kórház, Budapest, Tétényi út, Magyarország','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',1,'55274',2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(69,54,'Petőné Szalay','katalin',NULL,'Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',2,NULL,2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(70,54,'Kásáné Simó','Györgyi',NULL,'Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',2,NULL,2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(71,54,'Róth','Szilvia',NULL,'Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',2,NULL,2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(72,54,'Vajda Imréné','Krisztina',NULL,'Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',2,NULL,2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(73,54,'Gergely','Mihály','Dr.','Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',1,'63709',2,'sponsored','elolegszamla','Medexpert Kft','1037 Budapest Törökkő u.5-7.','Csuka Domonkos ügyvez.igazgató   06309425021',NULL,NULL,1,1,1,NULL,'2015-03-28'),
	(74,54,'Majoros','Edit',NULL,'Gottsegen GyÃ¶rgy OrszÃ¡gos KardiolÃ³giai IntÃ©zet, Budapest, Haller utca, MagyarorszÃ¡g','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',1,'00000000',2,'sponsored','elolegszamla','MGYAITT','1146 Budapest  Bethesda u.3-5.','Dr.SÃ¡pi ErzsÃ©bet 06703820435  kÃ¼ldÃ©s:GOKI,1096 Bp.Haller u.29.',NULL,NULL,1,0,0,NULL,'2015-03-30'),
	(75,56,'Ablonczy','LÃ¡szlÃ³','Dr.','Gottsegen GyÃ¶rgy OrszÃ¡gos KardiolÃ³giai IntÃ©zet, GyermekszÃ­v KÃ¶zpont','HU','Haller u.29.','+36-70-3820305','+36-1-2157441','ablonczyl@gmail.com','Budapest','1096',1,'51375',2,'transfer','elolegszamla',NULL,NULL,NULL,'Gottsegen GyÃ¶rgy OrszÃ¡gos KardiolÃ³giai IntÃ©zet','1096 Budapest, Haller u.29.',1,0,0,NULL,'2015-03-30'),
	(76,57,'VilmÃ¡nyi','Csaba','Dr.','Gottsegen GyÃ¶rgy OrszÃ¡gos KardiolÃ³giai IntÃ©zet, Budapest, Haller utca, MagyarorszÃ¡g','HU','Haller u. 29','+36703389335',NULL,'csvilmanyi@gmail.com','Budapest','1096',1,'64991',2,'transfer','elolegszamla',NULL,NULL,NULL,'Gottsegen GyÃ¶rgy OrszÃ¡gos KardiolÃ³giai IntÃ©zet','1096 Budapest Haller u. 29',0,1,1,NULL,'2015-03-30'),
	(77,54,'Majoros','Edit',NULL,'Gottsegen GyÃ¶rgy OrszÃ¡gos KardiolÃ³giai IntÃ©zet, Budapest, Haller utca, MagyarorszÃ¡g','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',1,'nem vagyok orvos',2,'sponsored','elolegszamla','MGYAITT','1146 Budapest  Bethesda u.3-5.','Dr.SÃ¡pi ErzsÃ©bet 06703820435  kÃ¼ldÃ©s:GOKI,1096 Bp.Haller u.29.',NULL,NULL,1,0,0,NULL,'2015-03-30'),
	(78,26,'PrÃ³ba','Bernadett','Dr.','guhil','MC','jgiuhpÃ©lÃ¡p','326453','24652','bernadett.szabo@misandbos.hu','ukhoijo','1233333',1,'1234566666',2,'transfer','elolegszamla',NULL,NULL,NULL,'zrfui','uzgilup',1,0,0,NULL,'2015-03-30'),
	(79,58,'sfvsd','fvsdfv','dr.','sdfvsdf','HU','dfvsdfvsdf','dfvsdf','sdfvsdf','vsdfvs@sdfvsdfv.hu','fvsdfvs','vsdfvsdf',2,'dsfv',2,'transfer','elolegszamla',NULL,NULL,NULL,'kuzgiuzgi','kuzglou',0,1,1,NULL,'2015-03-30'),
	(80,59,'sdfv','sfvsdf','Dr.','vsdfvs','HU','fvsdfvsdfv','sdfvsdfvsdfvsdfvsdfv','sdfvsdfvsdfv','sdfvsd@sdfvsdfvs.hu','sdfvs','dfvsdfv',2,'adfvsdfv',2,'transfer','elolegszamla',NULL,NULL,NULL,'sd','vsdfvsdfv',1,1,1,NULL,'2015-03-30'),
	(81,60,'sdfvsdfv','sdfvs','Prof.','dfvsdfv','AF','dfvsf','sdfvsd','fvsfvs','sdfvsdf@sdfvsdfv.hu','sdfvsd','fvsdfvs',4,'dvsdfvsdfv',2,'transfer','elolegszamla',NULL,NULL,NULL,'vsdfv','sdf',1,0,1,NULL,'2015-03-30'),
	(82,61,'sdfvsd','dfvsd','dr.','fvsdfv','AF','vsdfv','dfgbndgb','sd','sdfvsdfv@sdfvsdfv.hu','sdf','sdfv',3,'sdfvs',2,'transfer','elolegszamla',NULL,NULL,NULL,'bdfgbd','dfg',1,NULL,NULL,NULL,'2015-03-30'),
	(83,62,'Gál','Péter','Dr.','SZTE Gyermekklinika','HU','Közép-kapu 5.','30/349-5823',NULL,'galpeter78@gmail.com','Szeged','6725',1,'63296',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Gál Péter','6725 Szeged, Közép-kapu u. 5.',0,0,1,NULL,'2015-03-30'),
	(84,63,'Cseh','Zsófia','Dr.','SZTE Gyermekklinika','HU','Aulich Lajos u. 40.','70/324-9190',NULL,'drcsehzsofia@gmail.com','Veszprém','8200',1,'74274',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Gál Péter','6725 Szeged, Közép-kapu u. 5.',1,0,1,NULL,'2015-03-30'),
	(85,64,'Szabó','Adrienn','Dr.','Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u. 29.','+3612151220','+3612157067','borszadri@gmail.com','Budapest','1096',1,'69869',2,'transfer','elolegszamla',NULL,NULL,NULL,'Gottsegen György Országos Kardiológiai Intézet','1096 Budapest, Haller u. 29.',1,0,1,NULL,'2015-03-30'),
	(86,65,'gajgioja','lyvhoiklhjiylag','Dr.','yjvékjya','HU','yklnklna','ogaholg','nvnagkla','yklvnjal@iooaj.com','nyklngklya','mvyém',1,'jipyjpgja',2,'transfer','elolegszamla',NULL,NULL,NULL,'émnxéméhsm','ékxygsmjh',1,1,1,NULL,'2015-03-30'),
	(87,66,'Lakatos','Erzsébet','Dr.','DE KK Gyermekklinika','HU','Hatvan u. 2-4. IV/14','30/3249522',NULL,'erzske@gmail.com','Debrecen','4025',1,'71039',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr Kunné Dr Lakatos Erzsébet','4025 Debrcen, Hatvan u. 2-4.',1,0,1,NULL,'2015-03-30'),
	(88,67,'Mézes','Mónika','Dr.','Megyei Kórház, Bács-Kiskun, Kecskemét, Nyíri út, Magyarország','HU','Nyíri út 38.','06706198184',NULL,'drmezesmonika@gmail.com','Kecskemét','6000',1,'74316',2,'sponsored','elolegszamla','Kecskeméti Gyermekosztályért Alapítvány','6000 Kecskemét Izsáki út 5.','Dr. Baltás Géza 06305748317 baltas@t-online.hu',NULL,NULL,0,1,1,NULL,'2015-03-30'),
	(89,54,'Majoros','Edit',NULL,'Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u.29.','0612151220','0612998116','drsapierzsebet@gmail.com','Budapest','1096',2,NULL,2,'sponsored','elolegszamla','MGYAITT','1146 Budapest Bethesda u.3-5.','Dr.Sápi Erzsébet 06703820435 postacím GOKI,1096 Bp.Haller u.29.',NULL,NULL,1,0,0,NULL,'2015-03-30'),
	(90,68,'Kövesi','Tamás','Dr.','PTE KK AITI','HU','Papnövelde u. 24/2.','(20) 9255664',NULL,'kovesi.tamas@pte.hu','Pécs','7621',1,'44763',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Kövesi Tamás','7621 Pécs, Papnövelde u. 24/2.',1,0,1,NULL,'2015-03-30'),
	(91,69,'Kis-Tamás','Melinda','dr.','Semmelweis Egyetem Budapest, Aneszteziológiai és Intenzív Terápiás Klinika','HU','Kútvölgyi út 49','+36206632503',NULL,'kistamel@gmail.com','Budapest','1125',1,'65625',2,'transfer','elolegszamla',NULL,NULL,NULL,'Recro-Med Kft.','1125 Budapest Kútvölgyi út 49.',0,0,1,NULL,'2015-03-31'),
	(92,70,'Márton','Györgyi','dr.','Heim Pál Gyermekkórház','HU','Ernő u. 30-34. 4.em./415.','+36308237931',NULL,'marton.gyorgyi7@gmail.com','Budapest','1096',3,'78290',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Márton Györgyi','1096, Budapest, Ernő u. 30-34. 4.em./415.',1,1,0,NULL,'2015-03-31'),
	(93,71,'Takács','Laura','dr.','Heim Pál, Budapest, Rezső tér, Magyarország','HU','Vörösmarty 10/B','+36205330002',NULL,'takacslaura03@gmail.com','Edelény','3780',3,'79393',2,'transfer','elolegszamla',NULL,NULL,NULL,'dr. Takács Laura','3780 Edelény, Vörösmarty út 10/b',1,0,0,NULL,'2015-03-31'),
	(94,72,'Andorka','Csilla','Dr.','SE I. sz. Gyermekgyógyászati Klinika','HU','Bókay u. 53.','0630/3734921',NULL,'csilla.andorka@gmail.com','Budapest','1083',1,'74404',2,'sponsored','elolegszamla','Bókay Gyermekklinikáért Alapítvány','1083 Budapest, Bókay u. 53.',NULL,NULL,NULL,1,1,1,NULL,'2015-03-31'),
	(95,73,'Csekő','Anna','Dr.','SE I. sz Gyermekgyógyászati Klinika','HU','Bókay u. 53.','0630/3966574',NULL,'cseko.anna@gmail.com','Budapest','1083',1,'71683',2,'sponsored','elolegszamla','Bókay Gyermekklinikáért Alapítvány','1083 Budapest, Bókay u. 53.',NULL,NULL,NULL,1,1,1,NULL,'2015-03-31'),
	(96,56,'Ablonczy','László','Dr.','Gottsegen György Országos Kardiológiai Intézet','HU','Haller u.29.','+36-70-3820305','+36-1-2157441','ablonczyl@gmail.com','Budapest','1096',1,'51375',2,'transfer','elolegszamla',NULL,NULL,NULL,'Gottsegen György Országos Kardiológiai Intézet','1096 Budapest, Haller u.29.',1,0,0,NULL,'2015-03-31'),
	(97,57,'Vilmányi','Csaba','Dr.','Gottsegen György Országos Kardiológiai Intézet, Budapest, Haller utca, Magyarország','HU','Haller u. 29','+36703389335',NULL,'csvilmanyi@gmail.com','Budapest','1096',1,'64991',2,'transfer','elolegszamla',NULL,NULL,NULL,'Gottsegen György Országos Kardiológiai Intézet','1096 Budapest Haller u. 29.',0,1,1,NULL,'2015-03-31'),
	(98,74,'Androsits','Helga',NULL,'SE I.sz Gyermekgyekgyógyászati Klinika','HU','Margaréta utca 15','+36208232285',NULL,'andrositshelga@gmail.com','Pomáz','2013',2,NULL,2,'sponsored','elolegszamla','Bókay Gyermekklinikáért Közhasznú Alapítvány','1083, Budapest, Bókay János u. 53-54.',NULL,NULL,NULL,1,1,1,NULL,'2015-03-31'),
	(99,75,'Oprea','Angela',NULL,'SE I. sz. Gyermekklinika','HU','Bókay u. 53.','0670/5557245',NULL,'opreaangi@yahoo.com','Budapest','1083',2,NULL,2,'sponsored','elolegszamla','Bókay Gyermekklinikáért Alapítvány','1083 Budapest, Bókay u. 53.',NULL,NULL,NULL,1,0,0,NULL,'2015-03-31'),
	(100,76,'Kovács','Katalin',NULL,'SE I. sz. Gyermekklinika','HU','Bókay u. 53.','0620/6632542',NULL,'koka80@freemail.hu','Budapest','1083',2,NULL,2,'sponsored','elolegszamla','Bókay Gyermekklinikáért Alapítvány','1083 Budapest, Bókay u. 53.',NULL,NULL,NULL,1,1,1,NULL,'2015-03-31'),
	(101,77,'Jermendy','Ágnes','Dr.','SE I. sz. Gyermekklinika','HU','Bókay u. 53.','0620/4600798',NULL,'jermendy@gmail.com','Budapest','1083',1,'68349',2,'sponsored','elolegszamla','Bókay Gyermekklinikáért Alapítvány','1083 Budapest, Bókay u. 53.',NULL,NULL,NULL,1,1,1,NULL,'2015-03-31'),
	(102,78,'Vatai','Barbara','Dr.','I. sz. Gyermekklinika, Budapest, Bókay János utca, Magyarország','HU','Bókay J u 53-54','06206632763',NULL,'vatai.barbara@med.semmelweis-univ.hu','Budapest','1183',1,'69228',2,'sponsored','elolegszamla','Bókay Gyermekklinikáért Közhasznú Alapítvány','1183, Budapest, Bókay J. u. 53-54.','Dr. Lódi Csaba',NULL,NULL,1,NULL,1,NULL,'2015-04-08'),
	(103,79,'Lódi','Csaba','Dr.','I. sz. Gyermekklinika, Budapest, Bókay János utca, Magyarország','HU','Bókay u. 53.','06203290703',NULL,'lodics@gmail.com','Budapest','1083',1,'63142',2,'transfer','elolegszamla',NULL,NULL,NULL,'Bókay Gyermekklinikáért Alapítvány','1083 Budapest, Bókay u. 53.',1,0,1,NULL,'2015-04-09'),
	(104,80,'Varróné Erdei','Krisztina',NULL,'Heim Pál Gyermekkórház Aneszteziológiai és Intenziv Terápiás Osztály','HU','Rozmaring u. 8.','06306394942',NULL,'varroneerdeikrisztina@gmail.com','Kerepes','2144',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Erdei Krisztina','2144 Kerepes Rozmaring u. 8.',2,0,0,NULL,'2015-04-10'),
	(105,81,'Poharelec','Istvánné',NULL,'SZTE Szent-Györgyi Albert Klinikai Központ, Szeged, Hungary','HU','Szatymaz, I. körzet, 1057. hrsz.','304887993',NULL,'bognaragnes@hotmail.com','Szeged','6725',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Sáry Bognár Bt','6725 Szeged Felhő u. 17.',1,0,0,NULL,'2015-04-12'),
	(106,81,'Bognár','Ágnes','Dr.','SZTE Szent-Györgyi Albert Klinikai Központ, Szeged, Magyarország','HU','Felhő u. 17.','304887993',NULL,'bognaragnes@hotmail.com','Szeged','6725',1,'44400',2,'transfer','elolegszamla',NULL,NULL,NULL,'Sáry Bognár Bt','6725 Szeged Felfő 17. 3/4',1,1,1,NULL,'2015-04-12'),
	(107,81,'Bognár','Ágnes','Dr.','SZTE Szent-Györgyi Albert Klinikai Központ, Szeged, Magyarország','HU','Felhő u. 17.','304887993',NULL,'bognaragnes@hotmail.com','Szeged','6725',1,'44400',2,'transfer','elolegszamla',NULL,NULL,NULL,'Sáry Bognár Bt','6725 Szeged, Felhő 17 3/4',1,1,1,NULL,'2015-04-12'),
	(108,82,'Kósik','Nándor','Dr.','Heim Pál Gyermekkórház','HU','Üllői út 86.','06 20 430 7891',NULL,'kosiknandor@gmail.com','Budapest','1089',1,'66218',2,'sponsored','elolegszamla','HUMAN Bio Plazma LLC','2100 Gödöllő,  Táncsics Mihály út 80.','Varga Zsolt, e-mail: zs.varga@humanked.com, tel: 06 30 619 6789',NULL,NULL,1,1,1,NULL,'2015-04-13'),
	(109,83,'Nagy','Róbert','Dr.','Egyesített Szent István és Szent László Kórház - Rendelőintézet, Budapest, Nagyvárad tér, Magyarország','HU','Albert Flórián út 5-7.','+36304009215','+3614558295','rdrnagy@gmail.com','Budapest','1097',1,'63160',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Nagy Róbert','2120 Dunakeszi Huszka Jenő utca 27.',1,0,1,NULL,'2015-04-18'),
	(110,84,'Magyar','István','dr.','Jósa András Kórház, Nyíregyháza, Szent István utca, Magyarország','HU','Malom u. 23.','30/307-4383',NULL,'magyarist0105@gmail.com','Nyíregyháza','4400',1,'45888',2,'transfer','elolegszamla',NULL,NULL,NULL,'Dr. Magyar István','4400 Nyíregyháza  Tűzoltó u. 5.',1,1,0,NULL,'2015-04-20'),
	(111,85,'szebellédi','Szilvia',NULL,'Péterfy Sándor utcai Kórház Rendelőintézet és Baleseti Központ','HU','fiumei út 17','06703376458',NULL,'sylvyleady@freemail.hu','budapest','1081',2,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Szebellédi Szilvia','1024 Budapest Baka utca 4 fsz.1',0,0,0,NULL,'2015-04-21'),
	(112,86,'Kocsis','Katalin','Dr.','Szent Borbála Kórház, Tatabánya, Dózsa György Way, Hungary','HU','Dózsa u. 77.','30/9776863',NULL,'kocsiskatalindr@gmail.com','Tatabánya','2800',1,'48715',2,'sponsored','elolegszamla','\"A Gyermekekért, a 21. Századért Alapítvány\"','2800 Tatabánya, Dózsa György u. 77.','dr Czelecz Zsuzsanna',NULL,NULL,0,0,0,NULL,'2015-04-21'),
	(113,87,'Fónagy','Eszter','dr.','PTE KK AITI','HU','Szigeti út 6./B','20/6292414',NULL,'eszterfonagy@gmail.com','Pécs','7624',3,'70428',2,'sponsored','elolegszamla','Dr. Török Endre Alapítvány','7624 Pécs Ifjúság út 13','dr. Tornai Zoltán 20/9580427, tornai.zoltan@pte.hu  A regisztrációs díjat, valamint a szállást szponzorálják, az étkezést nem! Ennek megfelelően kérnénk a számla kiállítását. Köszönjük!',NULL,NULL,1,1,1,NULL,'2015-04-21'),
	(114,88,'Csorba','Szilvia',NULL,'Heim Pál Gyermekkórház Egészségügyi Szakkönyvtár, Budapest, Magyarország','HU','Telepi út 14.','06209615878',NULL,'csorbaszilviaa@gmail.com','Vecsés','2220',3,NULL,2,'transfer','elolegszamla',NULL,NULL,NULL,'Csorba Szilvia','2220 Vecsés Telepi út 14',1,1,0,NULL,'2015-04-22'),
	(115,89,'Tóth','Dániel','Dr.','Heim Pál Gyermekkórház, Budapest, Magyarország','HU','Üllői út 86.','+36308261630',NULL,'tothdanieldr@gmail.com','Budapest','1089',1,'71550',2,'sponsored','elolegszamla','HUMAN BioPlazma LLC','H-2100 Gödöllő, Táncsics M. út 80.','Varga Zsolt +36 30 619 6789','Human BioPlazma LLC','H-2100 Gödöllő, Táncsics M. út 80.',1,1,1,NULL,'2015-04-22'),
	(116,90,'werf','werf','Dr.','werfwerf','HU','fwerfwerfew','2345234525',NULL,'rfwerf@sfvsdfvs.hu','fwefrwer','werfwer',1,'wrfwerfwerf',4,'sponsored','elolegszamla','qwefqwef','qwefwqef','wqeqef',NULL,NULL,1,NULL,NULL,NULL,'2015-06-29');

/*!40000 ALTER TABLE `EventRegistration` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table eventregistration_extraprogram
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eventregistration_extraprogram`;

CREATE TABLE `eventregistration_extraprogram` (
  `eventregistration_id` int(11) NOT NULL,
  `extraprogram_id` int(11) NOT NULL,
  PRIMARY KEY (`eventregistration_id`,`extraprogram_id`),
  KEY `IDX_863F5F7B800064BF` (`eventregistration_id`),
  KEY `IDX_863F5F7B81087A01` (`extraprogram_id`),
  CONSTRAINT `FK_863F5F7B800064BF` FOREIGN KEY (`eventregistration_id`) REFERENCES `EventRegistration` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_863F5F7B81087A01` FOREIGN KEY (`extraprogram_id`) REFERENCES `ExtraProgram` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table ExtraProgram
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ExtraProgram`;

CREATE TABLE `ExtraProgram` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6A7E4ACB71F7E88B` (`event_id`),
  CONSTRAINT `FK_6A7E4ACB71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `Event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `ExtraProgram` WRITE;
/*!40000 ALTER TABLE `ExtraProgram` DISABLE KEYS */;

INSERT INTO `ExtraProgram` (`id`, `event_id`, `name`, `price`)
VALUES
	(1,4,'Posztgraduális program',0);

/*!40000 ALTER TABLE `ExtraProgram` ENABLE KEYS */;
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

LOCK TABLES `RegistrantType` WRITE;
/*!40000 ALTER TABLE `RegistrantType` DISABLE KEYS */;

INSERT INTO `RegistrantType` (`id`, `name`, `price_before`, `price_after`)
VALUES
	(1,'MGYGT tag',16000,18000),
	(2,'Nem MGYGT tag',20000,22000),
	(3,'Szakdolgozó',8000,11000),
	(4,'Rezidens, nappali PhD hallgató',12000,14000),
	(5,'Kiállító',20000,25000),
	(6,'Napijegy',10000,12000),
	(7,'Orvostanhallgató',0,0),
	(8,'Nyugdíjas',0,0);

/*!40000 ALTER TABLE `RegistrantType` ENABLE KEYS */;
UNLOCK TABLES;


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



# Dump of table Room
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Room`;

CREATE TABLE `Room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `roomtype_id` int(11) DEFAULT NULL,
  `accomodation_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D2ADFEA571F7E88B` (`event_id`),
  KEY `IDX_D2ADFEA57D31ADD1` (`roomtype_id`),
  KEY `IDX_D2ADFEA5FD70509C` (`accomodation_id`),
  CONSTRAINT `FK_D2ADFEA571F7E88B` FOREIGN KEY (`event_id`) REFERENCES `Event` (`id`),
  CONSTRAINT `FK_D2ADFEA57D31ADD1` FOREIGN KEY (`roomtype_id`) REFERENCES `RoomType` (`id`),
  CONSTRAINT `FK_D2ADFEA5FD70509C` FOREIGN KEY (`accomodation_id`) REFERENCES `Accomodation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Room` WRITE;
/*!40000 ALTER TABLE `Room` DISABLE KEYS */;

INSERT INTO `Room` (`id`, `event_id`, `roomtype_id`, `accomodation_id`, `price`)
VALUES
	(1,2,1,6,18000),
	(2,2,2,6,11000),
	(3,2,1,7,12000),
	(4,2,2,7,7000),
	(5,2,3,7,9000),
	(6,2,4,7,6000),
	(7,2,5,7,11000),
	(8,2,6,7,7500),
	(9,2,7,7,6500),
	(10,2,8,7,3800),
	(11,1,2,7,3800),
	(12,1,4,7,3800),
	(13,4,1,1,25000),
	(14,4,2,1,16000);

/*!40000 ALTER TABLE `Room` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table RoomReservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `RoomReservation`;

CREATE TABLE `RoomReservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventRegistration_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `persons` smallint(6) NOT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `roommate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1B2878788C55A21` (`eventRegistration_id`),
  KEY `IDX_1B28787854177093` (`room_id`),
  CONSTRAINT `FK_1B28787854177093` FOREIGN KEY (`room_id`) REFERENCES `Room` (`id`),
  CONSTRAINT `FK_1B2878788C55A21` FOREIGN KEY (`eventRegistration_id`) REFERENCES `EventRegistration` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `RoomReservation` WRITE;
/*!40000 ALTER TABLE `RoomReservation` DISABLE KEYS */;

INSERT INTO `RoomReservation` (`id`, `eventRegistration_id`, `room_id`, `persons`, `check_in`, `check_out`, `roommate`)
VALUES
	(1,6,5,1,'2015-05-23','2015-05-24',NULL),
	(2,7,2,1,'2015-05-23','2015-05-24','Mikike'),
	(3,8,6,1,'2015-05-23','2015-05-24','Pista'),
	(4,9,2,1,'2015-05-23','2015-05-24','Barbi'),
	(5,10,2,1,'2015-05-23','2015-05-25','mindegy'),
	(6,11,2,1,'2015-05-23','2015-05-25',NULL),
	(7,12,10,1,'2015-05-23','2015-05-23',NULL),
	(8,13,4,1,'2015-05-23','2015-05-24','Dobos Viktor'),
	(9,14,1,1,'2015-05-23','2015-05-23',NULL),
	(10,15,2,1,'2015-05-23','2015-05-24','Kósik Nándor'),
	(11,16,1,1,'2015-05-23','2015-05-23',NULL),
	(12,17,2,1,'2015-05-23','2015-05-25',NULL),
	(13,18,1,1,'2015-05-23','2015-05-23',NULL),
	(14,19,2,1,'2015-05-23','2015-05-24','Dr. Oláh Roland'),
	(15,20,2,1,'2015-05-23','2015-05-24','Dr. Erdei Zsuzsanna'),
	(16,21,1,1,'2015-05-24','2015-05-24',NULL),
	(17,22,NULL,1,'2015-05-23','2015-05-24',NULL),
	(18,23,2,1,'2015-05-23','2015-05-25','Sikó-Laky Ivett'),
	(19,24,2,1,'2015-05-23','2015-05-25',NULL),
	(20,25,4,1,'2015-05-23','2015-05-25','dr. Kőhalmi Barbara'),
	(21,26,2,1,'2015-05-23','2015-05-25','Csiki Andrea'),
	(22,27,2,1,'2015-05-23','2015-05-25','Király Jenőné'),
	(23,28,NULL,1,'2015-04-23','2015-05-24',NULL),
	(24,29,NULL,1,'2015-05-23','2015-05-24',NULL),
	(25,30,NULL,1,'2015-05-23','2015-05-24',NULL),
	(26,31,2,1,'2015-05-23','2015-05-25','Dr. Lantos Lajos'),
	(27,32,1,1,'2015-05-24','2015-05-24',NULL),
	(28,33,NULL,1,'2015-05-23','2015-05-24',NULL),
	(29,34,1,1,'2015-05-23','2015-05-24',NULL),
	(30,35,2,1,'2015-04-24','2015-04-25','Dr Kis-Tamás Melinda'),
	(31,36,6,1,'2015-05-23','2015-05-24','Dr. Lakatos Erzsébet, Dr. Biszku Beáta'),
	(32,37,6,1,'2015-05-23','2015-05-25','Dr.Szilágyi Adrienn, Dr.Lakatos Erzsébet'),
	(33,38,6,1,'2015-05-23','2015-05-25','Dr. Lakatos Erzsébet, Dr. Biszku Beáta'),
	(34,39,4,1,'2015-04-24','2015-04-25','dr.Fodor László'),
	(35,40,NULL,1,'2015-05-23','2015-05-24',NULL),
	(36,41,2,1,'2015-05-24','2015-05-25','dr. Vilmányi Csaba'),
	(37,42,2,1,'2015-05-23','2015-05-24',NULL),
	(38,43,8,1,'2015-04-23','2015-04-25','dr. Miseje Orsolya, dr. Kiss Viktória'),
	(39,44,2,1,'2015-05-24','2015-05-25','Egri Viktória'),
	(40,45,2,1,'2015-05-24','2015-05-25','Galvácsné Székely Hajnalka'),
	(41,46,2,1,'2015-05-24','2015-05-25','dr. Béres Ildikó'),
	(42,47,2,1,'2015-05-24','2015-05-25','dr. Ormay Cecília'),
	(43,48,1,1,'2015-05-24','2015-05-25',NULL),
	(44,49,NULL,1,'2015-05-23','2015-05-24',NULL),
	(45,50,NULL,1,'2015-05-23','2015-05-24',NULL),
	(46,51,NULL,1,'2015-05-23','2015-05-24',NULL),
	(47,52,NULL,1,'2015-05-23','2015-05-24',NULL),
	(48,53,NULL,1,'2015-05-23','2015-05-24',NULL),
	(49,54,NULL,1,'2015-05-23','2015-05-24',NULL),
	(50,55,NULL,1,'2015-05-23','2015-05-24',NULL),
	(51,56,NULL,1,'2015-05-23','2015-05-24',NULL),
	(52,57,1,1,'2015-05-23','2015-05-24',NULL),
	(53,58,NULL,1,'2015-05-23','2015-05-24',NULL),
	(54,59,2,1,'2015-04-24','2015-04-25','hozzátartozóm'),
	(55,60,1,1,'2015-04-23','2015-04-25',NULL),
	(56,61,8,1,'2015-05-23','2015-05-25','Dr.Kiss Viktória, Dr.Maráczi Vera'),
	(57,62,NULL,1,'2015-05-23','2015-05-24',NULL),
	(58,63,4,1,'2015-05-23','2015-05-25',NULL),
	(59,64,NULL,1,'2015-05-23','2015-05-24',NULL),
	(60,65,1,1,'2015-04-23','2015-04-25','--------------------------------------'),
	(61,66,2,1,'2015-05-24','2015-05-25','Dr.Szani Anikó'),
	(62,67,2,1,'2015-04-23','2015-04-24','Dr.Szani Anikó'),
	(63,68,2,1,'2015-04-23','2015-04-25','Dr.Székely Edgár'),
	(64,69,2,1,'2015-04-24','2015-04-25','Kásáné Simó Györgyi'),
	(65,70,2,1,'2015-04-24','2015-04-25','Petőné Szalay Katalin'),
	(66,71,2,1,'2015-04-24','2015-04-25','Vajda Imréné/ Jakab Krisztina/'),
	(67,72,2,1,'2015-05-23','2015-05-24','Róth Szilvia'),
	(68,73,1,1,'2015-04-24','2015-04-25',NULL),
	(69,74,1,1,'2015-04-23','2015-04-25',NULL),
	(70,75,1,1,'2015-05-24','2015-05-25',NULL),
	(71,76,2,1,'2015-05-24','2015-05-25','dr. VilmÃ¡nyi Bernadett'),
	(72,77,1,1,'2015-04-23','2015-04-25',NULL),
	(73,78,5,1,'2015-05-23','2015-05-25',NULL),
	(74,79,7,1,'2015-05-23','2015-05-24',NULL),
	(75,80,7,1,'2015-05-23','2015-05-24',NULL),
	(76,81,10,1,'2015-05-23','2015-05-24',NULL),
	(77,82,6,1,'2015-05-23','2015-05-24',NULL),
	(78,83,2,1,'2015-04-24','2015-04-25','Cseh Zsófia'),
	(79,84,2,1,'2015-04-24','2015-04-25','Gál Péter'),
	(80,85,1,1,'2015-05-24','2015-05-25',NULL),
	(81,86,NULL,1,'2015-05-23','2015-05-24',NULL),
	(82,87,6,1,'2015-04-23','2015-04-25','Szilágyi Adrienn, Biszku Beáta'),
	(83,88,NULL,1,'2015-05-23','2015-05-24',NULL),
	(84,89,1,1,'2015-04-23','2015-04-25',NULL),
	(85,90,1,1,'2015-05-24','2015-05-25',NULL),
	(86,91,2,1,'2015-05-24','2015-05-25','dr. Cserbák Anna'),
	(87,92,6,1,'2015-04-24','2015-04-25','dr. Takács Laura, Csorba Szilvia'),
	(88,93,6,1,'2015-04-24','2015-04-25','dr. Márton Györgyi, dr. Csorba Szilvia'),
	(89,94,2,1,'2015-04-24','2015-04-25','Dr Jermendy Ágnes'),
	(90,95,2,1,'2015-04-24','2015-04-25','Dr Vatai Barbara'),
	(91,96,1,1,'2015-05-24','2015-05-25',NULL),
	(92,97,2,1,'2015-05-24','2015-05-25','dr. Vilmányi Bernadett'),
	(93,98,2,1,'2015-05-24','2015-05-25','Dr Erdei Zsuzsanna'),
	(94,99,2,1,'2015-04-24','2015-04-25','Kovács Katalin'),
	(95,100,2,1,'2015-04-24','2015-04-25','Oprea Angéla'),
	(96,101,2,1,'2015-04-24','2015-04-25','Dr Andorka Csilla'),
	(97,102,2,1,'2015-04-24','2015-04-25','Dr. Csekő Anna'),
	(98,103,1,1,'2015-04-24','2015-04-25',NULL),
	(99,104,NULL,1,'2015-05-23','2015-05-24',NULL),
	(100,105,NULL,1,'2015-05-23','2015-05-24',NULL),
	(101,106,NULL,1,'2015-05-23','2015-05-24',NULL),
	(102,107,NULL,1,'2015-05-23','2015-05-24',NULL),
	(103,108,2,1,'2015-05-23','2015-05-25','dr. Péter Ádám, de csak a pénteki napon érkezik. 23-án engem lehet egyágyas szobában is elhelyezni, vagy másik szobatársat választani.'),
	(104,109,1,1,'2015-05-24','2015-05-25',NULL),
	(105,110,1,1,'2015-05-24','2015-05-25',NULL),
	(106,111,1,1,'2015-04-24','2015-04-25',NULL),
	(107,112,2,1,'2015-05-24','2015-05-25','Czegka Miklós -házastárs'),
	(108,113,1,1,'2015-04-24','2015-04-25',NULL),
	(109,114,6,1,'2015-05-24','2015-05-25','Dr.Takács Laura, Dr. Márton Györgyi'),
	(110,115,2,1,'2015-05-23','2015-05-25','Péter Gabriella'),
	(111,116,13,1,'2015-05-23','2015-05-24',NULL);

/*!40000 ALTER TABLE `RoomReservation` ENABLE KEYS */;
UNLOCK TABLES;


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
	(7,'Lakosztály 4 fő részére'),
	(8,'Pótágy');

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
	(2,'olah.gergely@pixeloid.hu','olah.gergely@pixeloid.hu','olah.gergely@pixeloid.hu','olah.gergely@pixeloid.hu',1,'99yp1cue3bwgck04s40cog0o8080gw4','vN+iVFX2GF8xnkxLN1ivQ8d7MJNt6gwcsNjJYvmrbMibF2fPvmGVDF5mAvMYoxpwhRtcPIejLEjmwbxXf6rmPw==','2015-04-10 14:57:01',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL),
	(3,'emese.veres@misandbos.hu','emese.veres@misandbos.hu','emese.veres@misandbos.hu','emese.veres@misandbos.hu',1,'akxexy51x340oc88sc8g444o44koo4g','tGsA4g22MZ9TFgPIbkgfT2MXZVouZ2C/VN59j+SIZ5gBQFSI1RmHDZJCkLIRQysFUbFaINWLd+2kPXfrsZC9bA==','2015-03-16 11:56:11',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL),
	(4,'info@pixeloid.hu','info@pixeloid.hu','info@pixeloid.hu','info@pixeloid.hu',1,'5629bc68twkk4840ww0w04goswc4ogw','4okqaihHcgzX++tQCaSv/9RpfIzbHuGOFOi5kW1N/+siPJt2CLll+5vvROJh9sVnvBkyQVJNsTqeGjmCrpYnhQ==','2015-03-04 13:15:15',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(5,'szentirmai.reka@hotmail.com','szentirmai.reka@hotmail.com','szentirmai.reka@hotmail.com','szentirmai.reka@hotmail.com',1,'puez8z21m40oc0c8gsww0wsw4k48kgg','ThNn9wtqjMC+dbiDRwUN8xCJdrcE6Oi8V7CE3ukMyniFvr1sjoH5rErUUBh8jkKY3+z/KN3N6NJsKZmq/yiFcA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(6,'old.bear69@yahoo.com','old.bear69@yahoo.com','old.bear69@yahoo.com','old.bear69@yahoo.com',1,'b35xmwggqg0ksskggggg8sww44wgwsg','vO0eNE1OVtInA2iRsgUsXFMoX9Ya8g13Y5M+mfJuWlEYauyMW654WWtJkRu9sbHRr6Bi5fd+1xeUghFbEJkJ2g==','2015-03-12 15:11:09',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(7,'tovishazigyula@gmail.com','tovishazigyula@gmail.com','tovishazigyula@gmail.com','tovishazigyula@gmail.com',1,'c6jqxycle9csskwwksgsk044oc44kks','BLOfKLxzZgOkNiPSfqunR0RmQyH/GmfVAnhpcYC/VfhGRxHFqrF2ftMNDxQbjQ6ys/HoolDS16n8iyBdyUcuyA==','2015-03-18 16:56:57',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(8,'vnellus@freemail.hu','vnellus@freemail.hu','vnellus@freemail.hu','vnellus@freemail.hu',1,'2zdkkv534q4gwcog8s00g088k0ssggw','FxUUGWxc5HMYgJRmDgpEsfnaael2lCtCzKDPIkPhn5fMZmVoVSwPCsEFMf6vAfSkdeTIO/43zvLiCYhKYVpNpQ==','2015-03-19 16:32:40',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(9,'peteradam21@yahoo.com','peteradam21@yahoo.com','peteradam21@yahoo.com','peteradam21@yahoo.com',1,'pp3pz7kb1v4owosoc80ckcoskc4kw88','/2Aw30d4RKRi/bMosDnWn6oc2lemO47LxwGjHJOsBe3D3i8urjehIgr/1mmbOwvKZDqz0+Wm5u9kM/ZH5rDPgA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(10,'szabobernadett92@gmail.com','szabobernadett92@gmail.com','szabobernadett92@gmail.com','szabobernadett92@gmail.com',1,'kvcchpxqr34gcsoso4gs44gs840scco','bVqM8tLsRlZwId3JJILda4DTk5cJbVqgmS/40qIJ9pk+xxwmfBK4aOFsgVm0tGImRucWEAPUGZcsR4dUJHJbog==','2015-04-30 11:42:34',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL),
	(11,'martakata@gmail.com','martakata@gmail.com','martakata@gmail.com','martakata@gmail.com',1,'a97qqo7co80gw8cgcs4gkscg4os44w8','smUOItsJifyryRV9Adm14Vgk53b4CXv/ffNYTduyuDXJGokQK99/yBg6C3SM/YkgCxUnSbVjCE7i6NqR4A+J5A==','2015-04-08 11:32:31',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(12,'lodiagnes@gmail.com','lodiagnes@gmail.com','lodiagnes@gmail.com','lodiagnes@gmail.com',1,'5d0otpdubvk0oo8ok4sos40808gkkoc','MR2TiMGtywPZ6z0+3i1CRx6Udff7cVtbxiOoE2Q2lXy+oxhn63A6tKQtVc/MdArsm66/eriBt0tdnbUPXC5/aQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(13,'erdei.zsuzsanna87@gmail.com','erdei.zsuzsanna87@gmail.com','erdei.zsuzsanna87@gmail.com','erdei.zsuzsanna87@gmail.com',1,'hxy0ezj2xxk4cgwoocosk00ko4oc8sk','MEFl0DMu00tYP7+G3zS+rffG7aVqRzEQxMA9Lamo4URoQLjtDvfKjhb3PutcWWv3XlKK4Ljk1rySvFqTE9SPOQ==','2015-04-20 13:40:20',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(14,'olah.roland1987@gmail.com','olah.roland1987@gmail.com','olah.roland1987@gmail.com','olah.roland1987@gmail.com',1,'5aev1k1l0isk08wo0kscww4swwgkc40','PProRGC5Vi0beaqdlcVXyRidA459nvpcHNVJXw0ruJ4qiiBT16cJzkj1/aN5ZOq8nSb/7Ajtbl8992OsS4PaNw==','2015-03-15 22:45:14',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(15,'talosigy@gmail.com','talosigy@gmail.com','talosigy@gmail.com','talosigy@gmail.com',1,'9f10rtd5abs4o8w488g4cg8coco0808','8+YGpyN28zyVe73Hg7XAMWA2chMX+eqlkzg/2Qs4Qkrus81GEXTX7W5dfePpEsES6d2uW65LbpNu12ihbaTDTw==','2015-03-15 22:44:35',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(16,'kuzgouizgzu@sfgsdfg.hu','kuzgouizgzu@sfgsdfg.hu','kuzgouizgzu@sfgsdfg.hu','kuzgouizgzu@sfgsdfg.hu',1,'nmf62ig9k80gww8cg4k8os48kw0sggk','Oy94qDyBYyrnAuU1dfhFFc9Nq1hT++0z3L5Xw4szL3CrpxgZFBqFwbZur7oHMCHG4yzCOcz5ADjV57oL0EssmQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(17,'hatvanikrisztina@freemail.hu','hatvanikrisztina@freemail.hu','hatvanikrisztina@freemail.hu','hatvanikrisztina@freemail.hu',1,'3ph20qk7w4mcwsoows0sswsow08kkwk','vfAxhJ/ismN+ytFzUtfCKWe4jyH5R8eQXDGc0Hw39XLbnOuoGXOkOdPInYJ1LtKX+lowfCkOYqf8DWhm4kJsCA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(18,'tamaspetergabi@gmail.com','tamaspetergabi@gmail.com','tamaspetergabi@gmail.com','tamaspetergabi@gmail.com',1,'qsqnem9n5og0ccgsocc4c0c0ocockwo','MHVjHM/ocPCJtMcDaDDBU9fQQAQL51YE3B+hmM3h6htB+19boGwi6yDO8tviwbWO9oEOT7wS8ZzuI3QzQEDh8w==','2015-03-18 13:30:36',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(19,'nogradijudit82@gmail.com','nogradijudit82@gmail.com','nogradijudit82@gmail.com','nogradijudit82@gmail.com',1,'czt7234au4g08c8gwwkgosg08ocs8gw','rvZkkFmk4JjyOB1cP1O1+zkgjmTgEnXfyG9VyGFG5A88DD3EZU/VpH5QW0vO9XkZ7LVY+iGv2ErUGxtzZBOl1w==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(20,'Bumbulusz@freemail.hu','bumbulusz@freemail.hu','Bumbulusz@freemail.hu','bumbulusz@freemail.hu',1,'c82119sz5i8kgos848okwcgk00sc4wg','uPrCmQZJgUjSB5+Zz0Kz+BZlX5Xmvw6oSCGIuOhyPM8uabCFIWU6VAr6ZeH3kRXWfBsHl3we/oPy9rdEPjJASA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(21,'qkiwasp@gmail.com','qkiwasp@gmail.com','qkiwasp@gmail.com','qkiwasp@gmail.com',1,'l1iiqyyvsw00ks8sc88cc08c8owo8s4','7KVUqI708s3+flZMazLwhdKvCtgi5YWyxY9GpWhkl1SjdQsJFymyjOlIq2ICJRqurBZfRYSd7RnavxApYg5hEw==','2015-03-21 07:58:48',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(22,'dobos824@gmail.com','dobos824@gmail.com','dobos824@gmail.com','dobos824@gmail.com',1,'jg1qbctxbdsk0gk4sgccw0ks88o4o0k','Njbu/0NcRJqjgQZTp9VDonSe7AUw6N1SGqc7K+Q61zEI3HL/JrYossFnZyrHQM4eHfDYC0vZFiM4KozYJMCjCA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(23,'vojcekeszter@gmail.com','vojcekeszter@gmail.com','vojcekeszter@gmail.com','vojcekeszter@gmail.com',1,'2oqkkb9bzpa848k048gcww4k4gg84ck','1qwmO5w1NSNtJL+cg5gKMUP/rJrgegrK2ynQZ+avE2qtF2pZqtTmHcNYNaY0nwuYrBwF8f1w/S6M9FLpYy8h9Q==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(24,'palfianiko001@gmail.com','palfianiko001@gmail.com','palfianiko001@gmail.com','palfianiko001@gmail.com',1,'2s5xykg2556o888kkggswokk8ccso0g','kFYX0qDgDpU0yOrdwRnqW6JEAdQXbkGoleu9ZeWxLAG5mZYraY4nJYf1NQpGRwCSOvCZIQMVwatZpOhapnL+IQ==','2015-04-21 10:31:05',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(25,'a.karda@freemail.hu','a.karda@freemail.hu','a.karda@freemail.hu','a.karda@freemail.hu',1,'iaf6jy6ljzkskg4cg8s8gk4wkkss0sw','30BNcQFEgMXobVto41ZUM1qt++Vr2XvKp1UeH7Zki/+pZ7TZpj8/7V7CbG6attKPrrhdnzPRkbOl9vB9LvnHBA==','2015-03-22 20:21:13',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(26,'bernadett.szabo@misandbos.hu','bernadett.szabo@misandbos.hu','bernadett.szabo@misandbos.hu','bernadett.szabo@misandbos.hu',1,'pcfoc4tnglc4s0444csgkwwss0osc8w','GXTaWj4Ur7/JUkSgMx2czIswf2qCoHjEomg21/+uU3BrfGSQp10vulYck4oZ+TcVtexZ+5dyMx/7LSxyXPEd8w==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(27,'casdc@sdfvsdv.hu','casdc@sdfvsdv.hu','casdc@sdfvsdv.hu','casdc@sdfvsdv.hu',1,'pi4ml49f96sgk0w8gswc088wgkgcs84','+JT8FKaPzld5b+9czF4pAw8wLjOHZsiFxCSbJxOQGJitHKK4jJl6C+WK9GqnUpZGmfJqaq+XEWVDJuAcwdlYEg==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(28,'c@sdfvsd.hu','c@sdfvsd.hu','c@sdfvsd.hu','c@sdfvsd.hu',1,'jievdc02xx4wg4sw88ck4w8o4ks48cs','fnkZCjzlKU5MsnceKQW/MCQwyK78wW70c3eM/YZDYyg2fMRn/AqS4P1PZ9CjYLQ6vYa4QtYwvpwqxzIMdPi3zg==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(29,'cserbi@gmail.com','cserbi@gmail.com','cserbi@gmail.com','cserbi@gmail.com',1,'54quyf9u8ko4sggg4wwwsws0k0sk004','JHgRApmzy2xNgOdrgqYY8lileIbc/sdmpINGiqdITdx9z1S26Rq73NkupHYLdeMp/zgCy892zPj1glqENT8T0Q==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(30,'md.szilagyi@gmail.com','md.szilagyi@gmail.com','md.szilagyi@gmail.com','md.szilagyi@gmail.com',1,'ahfrmnaukhcsowwcowcwscows04sk4s','U53JkK5YjbUKxvumtRjfmDG0FOP3n+X4/+lsjJm1RHpNtV2vo+kox8hFqLjC0cHXcA+GbwRVglvsqOsAv9vD+g==','2015-04-22 18:33:49',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(31,'beab74@freemail.hu','beab74@freemail.hu','beab74@freemail.hu','beab74@freemail.hu',1,'61ithmgqrv480k00sgscos4c88g0wcs','rh/PZutvebhcGrhiZR2mI2khcx8/2ruQJKrANiOUJHMM3qgsn97L72p4XjbtZNPPQi2YY0P/am7w/lT2+43OCQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(32,'dfpz@freemail.hu','dfpz@freemail.hu','dfpz@freemail.hu','dfpz@freemail.hu',1,'hqtbpmls07408gw088kwkcss8cwgc4w','cqH73L0ZmCv4Uvn8mKs0eGoFCDD0cilwuzx28jDqoKssrhNcPOucwMvQwDqQ6jA/VqFZiVFhgGHL6eDIf0TWig==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(33,'loboda.endre@siokorhaz.hu','loboda.endre@siokorhaz.hu','loboda.endre@siokorhaz.hu','loboda.endre@siokorhaz.hu',1,'hh06hyryxkgs8kgokkgkwsc0o4scoo8','XGJLjoT9Y8rSRNJ+l2koGln6vapPfwQ19do31w1htAN9BDgCqSWZ5XHJqVx+q7L4QhHFqAJkRJ3YzfV+xFj6pA==','2015-03-24 08:51:24',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(34,'bernadett.vilmanyi@gmail.com','bernadett.vilmanyi@gmail.com','bernadett.vilmanyi@gmail.com','bernadett.vilmanyi@gmail.com',1,'4nskkygew7c4gcosww88kwskok0kw4k','vkKaTO9j4WPu1fMR/hBNvK0Fq/5TN/V9ojvkL/qVM3YMTtD7yH5SeX4ESuzCc0zc80bqUB689GOd+3QeolLeIg==','2015-03-23 22:08:23',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(35,'dsfvdsfvds@sdfvdsfv.hu','dsfvdsfvds@sdfvdsfv.hu','dsfvdsfvds@sdfvdsfv.hu','dsfvdsfvds@sdfvdsfv.hu',1,'n6mdhhxvfcgs0wwcskwocosgg0s4wg0','udcP2/OC7W54jeAH8w3TYUmtpjgPLO6+KR65/g62zVl8MZLYo9k6twqmrsKKrLQ7s5RpiWfTXIjLtVvH46waQw==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(36,'marver78@gmail.com','marver78@gmail.com','marver78@gmail.com','marver78@gmail.com',1,'aq383hu950gkocgc8sowcgs0000wc48','DkbIZCQnXWK+mNL/vdKe4Eydckixja1fZIfyef+MtzaRRxlrOUHGNKDXtfATuB4kT0szLGrEG1XWhBnjyfROaA==','2015-04-03 01:10:22',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(37,'gyekint@bazmkorhaz.hu','gyekint@bazmkorhaz.hu','gyekint@bazmkorhaz.hu','gyekint@bazmkorhaz.hu',1,'jaqjmfvn7lwggw8o0ookg4k4g8gwowo','Ba0lX4BLHgBeZ1jiMS9oioYPqihU4HA3QTCIAevA/FpcW/Qiswf2ai1lShZ+5BmhnJ9rumZ0dxUCq8imwRmIVw==','2015-04-22 08:02:15',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(38,'csetekriszta@gmail.com','csetekriszta@gmail.com','csetekriszta@gmail.com','csetekriszta@gmail.com',1,'nnbiu72eu9wgw0k8kgws0sogg0swcsg','mzByGVJzSXNAoyvbOXFcIZqbJCQrc3/oKfESyk/0RnLULDFS4TFkJb4S7aQ2Cct1ZrJgdmRHvbK+MCSI5okuug==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(39,'itaure333@freemail.hu','itaure333@freemail.hu','itaure333@freemail.hu','itaure333@freemail.hu',1,'omn3iccvccgwk0kw80wo88oco0g8okk','vAcgtBTlfK/vL6ffeCxd1mJGNk4KWWPok2nix/pgADCSzFDJUn9nAiDD2hnfhGovFC9cRFPBuNzsmfygeWGSSQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(40,'poloskaym@freemail.hu','poloskaym@freemail.hu','poloskaym@freemail.hu','poloskaym@freemail.hu',1,'mz70wrxzuog8w4gk8gwc00c448448cg','FE/VBxDNNr2F0ZYiGnNh0TQvK18yiEu1Y5J5FLtndiCYre6BCQVp7zk1VB9vUn9aYOf/vcHc9r8dd7dymS/FMg==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(41,'hertlingtamas@gmail.com','hertlingtamas@gmail.com','hertlingtamas@gmail.com','hertlingtamas@gmail.com',1,'356zp34c8ig4ccggoko84gk88oskgg','QBfcfIEoneYqm0bARZG1HEJtRKA4J62A1HkM3Jz7ijxfvfA40o3CJdsR3Hc3rqLrzWLr7EhWL/lkIf29YzwaCw==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(42,'salsi@freemail.hu','salsi@freemail.hu','salsi@freemail.hu','salsi@freemail.hu',1,'gsy8ioaf75cswwssg8sowwcows8w0ks','mIT+Hgm3DrnQVbALfFO2Lm15L2KaICoH0EAmcaZQQGE1FFfq1KH+0DfzdUsHb7+eqROhYsd+aOAhYdqiBBTbTA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(43,'kucseraanett@freemail.hu','kucseraanett@freemail.hu','kucseraanett@freemail.hu','kucseraanett@freemail.hu',1,'kfjkdefigao0gwkgosoko08k48g8ck0','9XJLmOFVjLAHPysoPXWVB7B8g8HpwMaY565c1Os1dEg15aIU0VGakSH/oarUivQ/5BaFliah4hlXY0rKxfOp1g==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(44,'n.jucus001@freemail.hu','n.jucus001@freemail.hu','n.jucus001@freemail.hu','n.jucus001@freemail.hu',1,'ks3w6v92twgk0sk0gw4kwc0k0skg08s','zmetKejyQzD9tWLhRkzB8u6xGlBcsl0PzhIynBe9gsvF/gOZ7dCAv/QOnLPMEReeRkjoH2nbFDXBGhEKvrc9Hg==','2015-04-22 01:03:21',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(45,'kereszti.zsuzsanna@gmail.com','kereszti.zsuzsanna@gmail.com','kereszti.zsuzsanna@gmail.com','kereszti.zsuzsanna@gmail.com',1,'hzumfj99okggoow0c44cos0os0ss884','VOBO4Zcgxjy2QDb1Wxh/tQuJJoWqcCDoIiniDQ6+b9jVP8r/t6LTtIqRa78INdI5HYP5Va9nLdYjangFA+KG7Q==','2015-04-14 22:31:03',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(46,'andreakinga.szucs@gmail.com','andreakinga.szucs@gmail.com','andreakinga.szucs@gmail.com','andreakinga.szucs@gmail.com',1,'k8wkf5aq49w0k4swokso88gkcggog00','IC8GEnDtcqvw4AYHEKKlGvVbZjTCOoka6tdUjZIvTuBtZE6BGt9+8J5mtSS7mz+/i305WVyB3gRznkvxwBMKJg==','2015-04-24 14:05:15',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(47,'hohouhli@joi.hu','hohouhli@joi.hu','hohouhli@joi.hu','hohouhli@joi.hu',1,'ahpi7vc4f34k4gwgkgw8cks08gcss4w','IwaxGgxNp9/sC6RqglATeKiTAlYEb3thJj07hWxaGPa4tx4sT4165yIwr9kjKcAsp3a0wk87LgZVYtsVOKa/Yg==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(48,'metohe@hu.inter.net','metohe@hu.inter.net','metohe@hu.inter.net','metohe@hu.inter.net',1,'hd0pw9ofs7k88ksw0kwgokgg4s40gg0','lPfXd5R3Fi3tpDFxLvjAYZ0boEV6ZAVak5Do5SmWar+vVyUmJvoz3dd9r8MCsM36wkT69X9mMeIQTwfUdOUtuQ==','2015-03-27 13:06:01',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(49,'pap.zsolt@gmail.com','pap.zsolt@gmail.com','pap.zsolt@gmail.com','pap.zsolt@gmail.com',1,'r29ivyi72eoscowg80k0800wsc0oook','9FHJ9K8ComGfjH8AWhrdejyyKlUJroHg+oM8Za9gPMxpACl3M69rkO9Q95BtY0++rZBkH6FkMdF61XRwR84TLw==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(50,'miseje.orsolya@gmail.com','miseje.orsolya@gmail.com','miseje.orsolya@gmail.com','miseje.orsolya@gmail.com',1,'fvn9d5bzsv4kskwc88kc0osgssc0o8g','4sqctwme4t06AMg0qODiD+BpD7Lx9z9Z4hul8nXYeJWKRw3njlCXVZpxiaeQIVCOdXvDJeM1bBVV0tqwWIBY0g==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(51,'ehangodi@windowslive.com','ehangodi@windowslive.com','ehangodi@windowslive.com','ehangodi@windowslive.com',1,'cjhnnkqjjxcko4kk4ck04wk808ggcgc','hY/eEJgZeeOpd++j+qPylY6ru5stvVcVWgBihnKYrbgBaYnaLFyZGHiIon403s+ZAolrk/2/atPYN4q1eWhudA==','2015-04-20 14:48:39',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(52,'balazs.gergely@med.unideb.hu','balazs.gergely@med.unideb.hu','balazs.gergely@med.unideb.hu','balazs.gergely@med.unideb.hu',1,'rkpamtvz08gsoo8gswoo48sso88ssko','UW1XggQWou02kHvjln9dWTVDdWGr7prOuMhgT8XbvsQLvyYxaYSgyXIzRqsKwvFIpzLM2mQXZWxy3djHWcMXrQ==','2015-04-24 18:12:26',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(53,'nemeth.balazs.dr@gmail.com','nemeth.balazs.dr@gmail.com','nemeth.balazs.dr@gmail.com','nemeth.balazs.dr@gmail.com',1,'regtsj2k43k4kskocw0gsww0088k4w4','xg1pYlSCLGUahrj/bKO0qxpWWjxZmwrI2yQeVcywtzda1oSIy6DoIXXWtXMHjVNAmU1x9UL+ztRo9PN1OJKFsw==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(54,'drsapierzsebet@gmail.com','drsapierzsebet@gmail.com','drsapierzsebet@gmail.com','drsapierzsebet@gmail.com',1,'ayfldqsyfjksockosgww4wg0wgckkwg','xBZqN0EgxXsLqn5xIsxy1JTdgt8FaX4vPtCfx3xId5wi0MzJPd7kCjH0DiqRt32wgs3SFhWvVbiAeU5VmeAjuw==','2015-03-30 13:27:44',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(55,'edgar@kardio.hu','edgar@kardio.hu','edgar@kardio.hu','edgar@kardio.hu',1,'o97ubzl1nc0k4owww8gk80c00wwg4gc','8LPPLXChgNl/ti/6uHe6OV6scQ1qgZLGEjnENefZu6vsGymGT78ceefAgjBLCHMXdIZORItHD+lThxY0TgNVjg==','2015-03-30 13:17:11',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(56,'ablonczyl@gmail.com','ablonczyl@gmail.com','ablonczyl@gmail.com','ablonczyl@gmail.com',1,'s1itk18qn4g800koc00g088gk0swskg','NnwzTsKzwPsquHtpBOvGGxLMr7vQ/kcY18pdACbN4cIYpfePCHoUSf07kL1fAWNKKGGGGSiL8GddN6uddo6pgA==','2015-04-02 12:04:35',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(57,'csvilmanyi@gmail.com','csvilmanyi@gmail.com','csvilmanyi@gmail.com','csvilmanyi@gmail.com',1,'s14zeoaa31wcoock800osgsc8oogwkg','vWI8RBEMsTmOBZlWorEFg+JWtlFOm3c02Xsy2ROKYB+wQ1FS+IzZkwMNxfIvesx+vU1ycYx9NfMG43uz5zny4A==','2015-04-02 12:09:53',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(58,'vsdfvs@sdfvsdfv.hu','vsdfvs@sdfvsdfv.hu','vsdfvs@sdfvsdfv.hu','vsdfvs@sdfvsdfv.hu',1,'hp0sb2dpztsgwwwkc4g0g0kkow40gok','aACrQa/80+QMKEzJoL5Vss7SBgaVcVhVD92UY7llbLLtzHG5sUsz3ggaKyoMo8RfAUKJCBmRahPmNsWhUpb4aw==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(59,'sdfvsd@sdfvsdfvs.hu','sdfvsd@sdfvsdfvs.hu','sdfvsd@sdfvsdfvs.hu','sdfvsd@sdfvsdfvs.hu',1,'95f36use5poogo04wggcco4cs04gwcg','YtuqkfIOygQEOCLKVmCz90jRc+7uWzM1oyAkNFxypALk6q2ZIAweLqIp2eJrDDO4KQzuYPtBhTy2bZaIrw0F1w==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(60,'sdfvsdf@sdfvsdfv.hu','sdfvsdf@sdfvsdfv.hu','sdfvsdf@sdfvsdfv.hu','sdfvsdf@sdfvsdfv.hu',1,'k3vxu7u2fggwosksokcsg8skocgw4s8','vSAzBbiOIqugNQJLqwLdEoZSi/T58iomKnjP8Dnx4e8NkfxEko7xbuJn3z38QR36wqRBiuRZfMa+Hxy+llIO4A==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(61,'sdfvsdfv@sdfvsdfv.hu','sdfvsdfv@sdfvsdfv.hu','sdfvsdfv@sdfvsdfv.hu','sdfvsdfv@sdfvsdfv.hu',1,'ahwbxiygx8g0koww844skw4g0wogso8','/INDtxddQhvDW2l8zDIBzdml4td59xDtFFdBfVBDD3/7wYu/BF5t54pi3Q08dEgyG571gmnUL/5QSf1nHnDK1A==','2015-03-31 09:34:01',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(62,'galpeter78@gmail.com','galpeter78@gmail.com','galpeter78@gmail.com','galpeter78@gmail.com',1,'7jceqxmjsqw4wwogc4kg8owc80og408','Hh1Xcz49hzHZ7phxE01lvUP+dBHMA9gEq4nQAVkirrevwpZjBG4D1QPt3j1JWWybJKjJ9lJQbcM8fCfvG2YOWQ==','2015-04-03 01:17:56',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(63,'drcsehzsofia@gmail.com','drcsehzsofia@gmail.com','drcsehzsofia@gmail.com','drcsehzsofia@gmail.com',1,'7abd8dfg7zc4o088go8kgws4sowggkg','ucpR3GJeb+sDUvJXW7K3FPDwsaUPgaVlRlxuA0rVjEUb6mgTobyG9SGQHWW5dpf7zGMzMH0wXpiaWOGKEPiyyQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(64,'borszadri@gmail.com','borszadri@gmail.com','borszadri@gmail.com','borszadri@gmail.com',1,'sb6mhsjdzbk8wgw4gs4o8ksow0c8ogw','UI0O4pNyQXbLEq32Uh6Z/ys8nxBer6GyugLCauqqqSN3cyy/DpQg4p/ClSrw0LcqhzDfiEfWq9/BhHeZjtlCtQ==','2015-04-02 12:10:53',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(65,'yklvnjal@iooaj.com','yklvnjal@iooaj.com','yklvnjal@iooaj.com','yklvnjal@iooaj.com',1,'7x2i1bxjmp0kgog4sc4oksoww48o0ww','XkHeewGjyFvQ+CNUPSJ9+HlbLywg6qJb3UDqozPxSILqnZkvmAnK08yX21/deO9S/MLa3XQd9IZwezJsNQBBnA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(66,'erzske@gmail.com','erzske@gmail.com','erzske@gmail.com','erzske@gmail.com',1,'f3s2y10gx5w0ggs4w8gw8occg0w0gow','XReG17hREWNJE2HhTwBlpWEJjq/WH9CfvcedEVXWMHQydy/lcBXn6UAwA5Hu/8QX2u3dTJjtd8Wn0Bmhoayu6Q==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(67,'drmezesmonika@gmail.com','drmezesmonika@gmail.com','drmezesmonika@gmail.com','drmezesmonika@gmail.com',1,'q98w6hmsfasc8s80kss0ggsk0o0gkoc','N7zOoa2eK7r6Gt9VQX3Ruxpi7XGc7xGDTheqNj0Tge4gUhXhf1bNc6cIFkSD9vh+D6TsCWb+Pu6eepPI70EHRA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(68,'kovesi.tamas@pte.hu','kovesi.tamas@pte.hu','kovesi.tamas@pte.hu','kovesi.tamas@pte.hu',1,'ght29idzwwoc8s8004scsw0wksk4o4c','Np8qKNg4ti33W+NBCF1v3+wA1YhDWEo1eJk+4UN7kHiworJj9O0N4srNoit+HCzIylDlmq9wveTi7Ii/nsomMQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(69,'kistamel@gmail.com','kistamel@gmail.com','kistamel@gmail.com','kistamel@gmail.com',1,'to05yfxnuhc8wokwwggkw4k408c0www','ZFXeECujsLe9+6q1e94dnOtyyOVfqzsm4RCSYIJiky2xJpLmC8sTnYbvtau192nvfVgUgV9AmwYbuDm9mTy4Pw==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(70,'marton.gyorgyi7@gmail.com','marton.gyorgyi7@gmail.com','marton.gyorgyi7@gmail.com','marton.gyorgyi7@gmail.com',1,'9k43zsh94xs0kc4c0k4cwc8cc84g0og','MXHBtLwqli7K2RM2xqE2x98epiMUrcpU1FA+xvvB3hh1b48EOui3dk8x2nlw2ws/4+yxXseX0PTPfOT/rvmE9w==','2015-04-22 10:25:22',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(71,'takacslaura03@gmail.com','takacslaura03@gmail.com','takacslaura03@gmail.com','takacslaura03@gmail.com',1,'agmykym744oo0ksso8ckowggcwg0gks','L+M4HBcgQXOZx0z4zoQumoni1Ffts1d7obWcNJoI0pUbOR3fnYgfh+pgzeclED58nHrHlWbRsJ4vMpasfDFFWA==','2015-04-23 22:31:00',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(72,'csilla.andorka@gmail.com','csilla.andorka@gmail.com','csilla.andorka@gmail.com','csilla.andorka@gmail.com',1,'a9ryy6vmlao8ok0w4co484gk8gk8g8w','gBOC2l91eOTcyNZhRbRafysyI7e4UrPT0cm0gfOGQgkG+GIRz4RkwqdIwX5gGw38Ji/efA0Tf0jlg8eZqzhtPw==','2015-04-07 18:34:54',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(73,'cseko.anna@gmail.com','cseko.anna@gmail.com','cseko.anna@gmail.com','cseko.anna@gmail.com',1,'sqyuw5gaxsg8g4so880kcwkws4g8sog','XAqm3iEWyzKAkNt/145w3Kq6xs58hRNV3VtUXp5MV2t1QHV+lHaH4aPTfLH1tP6yJXIuc282HnA7dHntE91QDw==','2015-04-10 19:07:11',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(74,'andrositshelga@gmail.com','andrositshelga@gmail.com','andrositshelga@gmail.com','andrositshelga@gmail.com',1,'617rytdiz58ogcsoskc88g0gcgcs4kc','s5CguTmvwXWC8TQR5vuHivY/AKTdt/mOk5st4x9gbbKQ02twuF2xxY4Yh96/Qo0PYiS7LkLGGbngtiSxnTYrCQ==','2015-04-01 00:10:50',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(75,'opreaangi@yahoo.com','opreaangi@yahoo.com','opreaangi@yahoo.com','opreaangi@yahoo.com',1,'k8kvgjevls00gwsk40ggs8gs0kksko4','olHR2qJWXmvAi6Pqr6JT7PLI4dxPwF0kalKKtoeT2gc5o4g6B2xaUdQEwkJuEit+z5hs4g4D3uhJ3ZS6kW6jCg==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(76,'koka80@freemail.hu','koka80@freemail.hu','koka80@freemail.hu','koka80@freemail.hu',1,'3senglwnp6askogw4g8swgcoc8880ow','nhgDA8XTfAG74LmRqOtg4dhn1wG3XW77sYdgMNkBSCvSweJSjOnc1IWXolefPFeh4uVdfsrioI/OZ0FhQ33cWA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(77,'jermendy@gmail.com','jermendy@gmail.com','jermendy@gmail.com','jermendy@gmail.com',1,'5l4w2vb66m8008swskc4cw0okogwk8s','0T/I1hDr8Zm9oDy7DuJBVVHKp7uvqzcffNYaFCEgkCtGubTupDfPa8OjQFhOPs8poV53z3979f15OWPAL6gErQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(78,'vatai.barbara@med.semmelweis-univ.hu','vatai.barbara@med.semmelweis-univ.hu','vatai.barbara@med.semmelweis-univ.hu','vatai.barbara@med.semmelweis-univ.hu',1,'2pd7tprvkzgg8sgk8sg080w48ogggs0','AdlNQasBQR+FYX/SNJChXPg8iDhOgp6vrnD/VyP+Wg8Jd2XNUBId4rsXAeQO6zK1oSpi8l8BcgKLjIPpWIzkAg==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(79,'lodics@gmail.com','lodics@gmail.com','lodics@gmail.com','lodics@gmail.com',1,'pidx3l0cp9ckgckokskw0g004osc8os','JD/3r/r3j6Xd0Z2qaPLSTFHeV48vkKs98r2M4Xu5lfp0hzEze109SzjZY7YDPEF7CmgBY6H1R0JfbBzRUriB3w==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(80,'varroneerdeikrisztina@gmail.com','varroneerdeikrisztina@gmail.com','varroneerdeikrisztina@gmail.com','varroneerdeikrisztina@gmail.com',1,'jacsfmeopcocs444cscs4ggkck0cgs0','CwdANUhBx9a4ef3G4Q6NSaXlyaUotOcT0nBW4NB7GmQAoK61Kgvyz6+8M5rhYUM0Hl1kHvu4jNBYndOvy5rO7A==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(81,'bognaragnes@hotmail.com','bognaragnes@hotmail.com','bognaragnes@hotmail.com','bognaragnes@hotmail.com',1,'1sghbmjeka4gw4wcooskk084csccoco','4QdZWEIoJW/GharTRISO6i8aML2NI03YNAMgXN7OxbEm3Jz1Kn/FMzEwh9pjmgG4n8lPRim+tb30Tay7+yw8Sw==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(82,'kosiknandor@gmail.com','kosiknandor@gmail.com','kosiknandor@gmail.com','kosiknandor@gmail.com',1,'2xgmbobl8rs484gos8k0k4s8gc8gosg','gy1jjSlcK/0nXk9sxaUP4MvmXnnpjntt13aB9UBjfDjOpUc9bJLRpuGiLazKSGA/NOey09QvrZk1VKTH7aCpSA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(83,'rdrnagy@gmail.com','rdrnagy@gmail.com','rdrnagy@gmail.com','rdrnagy@gmail.com',1,'a3g7v9g3rvkgowo04wk08o0sg4sws4w','caaP+0M2RghKGemEJaELPlUOfsMN4hzBxzPyY0brV008b/gYCXBbT81keU4u9MCNMMv3KcaL5NsIFwrbNQLTNQ==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(84,'magyarist0105@gmail.com','magyarist0105@gmail.com','magyarist0105@gmail.com','magyarist0105@gmail.com',1,'5fzb9qo5724g8s0c4s8ggwsoogk4wk0','j+4y/9zSqJQ3dtdygS6WPQa9BA4UMA7YR14viBc35ZPxG++ObAQE6VBfM2nnQ6D8uQ61gUMV1fXxTHyldGjr9Q==','2015-04-22 22:47:29',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(85,'sylvyleady@freemail.hu','sylvyleady@freemail.hu','sylvyleady@freemail.hu','sylvyleady@freemail.hu',1,'rknd6adg668wg4w80ck4kwogsgs0480','A81J/HBPBg2N3otJKs6o0iW9IDtHPrSSsEtMJ0IIpc6Jz/1v3tmnlqZbk7wYgR6Jwze8XEUEfyxAI2JgBeAJ3w==','2015-04-23 07:51:09',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(86,'kocsiskatalindr@gmail.com','kocsiskatalindr@gmail.com','kocsiskatalindr@gmail.com','kocsiskatalindr@gmail.com',1,'3b90ng6i7j28w8wswcgo0wkwwg00c8k','suomvm9aken0LXNEPDJSkjB9HydmHMU/G+3FP08/ng0pVpFV2Rx4I7GH5BK2Y8e7zqWuO5JFXUsbBwIsSzYCmA==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(87,'eszterfonagy@gmail.com','eszterfonagy@gmail.com','eszterfonagy@gmail.com','eszterfonagy@gmail.com',1,'jd1te2422bcwkwwg4ok88s8kocg4c4','fKFIqVyTjHSQ9tyCdcLU5TNsl+ozmjJke+FYWkTGQ8FaSPiC5FfQwvGlUgSRPQ1HrUGogzr88h7exXdgtjj7Vg==','2015-04-21 13:09:43',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(88,'csorbaszilviaa@gmail.com','csorbaszilviaa@gmail.com','csorbaszilviaa@gmail.com','csorbaszilviaa@gmail.com',1,'r2zilbshbzksogc8wk44484gcosococ','4DcN8rVNuzhyzCKVB6mN6qpzZBZOnPM8gXWatRy/yltdVH4rK0pMnCjcNkoyObbExprBV9lNMyLdnaavoko1Vg==','2015-04-23 09:51:29',0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(89,'tothdanieldr@gmail.com','tothdanieldr@gmail.com','tothdanieldr@gmail.com','tothdanieldr@gmail.com',1,'j2n06gnwd9cgsosswo4scgg48kckgg8','EuwzHu1Ik42mYZwou4ha5BQX+CxOiDncoFTdn3mYeQoERjMX4Y/hKMFyzOJQoMx4TIUbApMc0nQZIDfbpypd5w==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL),
	(90,'rfwerf@sfvsdfvs.hu','rfwerf@sfvsdfvs.hu','rfwerf@sfvsdfvs.hu','rfwerf@sfvsdfvs.hu',1,'nkedqkis7c0gs00gocgscc8gos80s48','LbbZ/XH5OjZMnAgg/sqhStKOHDYt7/xJ8mMo+AUyideAhGU9982kfBPq+af+CCtFsfFh7KxJk80w/t3VYTxcTg==',NULL,0,0,NULL,NULL,NULL,'a:0:{}',0,NULL);

/*!40000 ALTER TABLE `SiteUser` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
