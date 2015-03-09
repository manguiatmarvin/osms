-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: zend_tut1
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acl_roles`
--

DROP TABLE IF EXISTS `acl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(125) NOT NULL,
  `resource` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_roles`
--

LOCK TABLES `acl_roles` WRITE;
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` VALUES (10,'guest','home'),(11,'guest','viewProfile'),(12,'guest','auth'),(13,'guest','index'),(14,'employee','home'),(15,'employee','profile'),(16,'employee','view'),(17,'employee','view-profile'),(18,'employee','edit-profile'),(19,'employee','edit'),(20,'employee','settings'),(21,'employee','settings'),(22,'employee','upload-profile-picture'),(23,'employee','change-password'),(24,'employee','logout'),(25,'employee','login'),(26,'employee','auth'),(27,'employee','index'),(28,'admin','home'),(29,'admin','profile'),(30,'admin','view'),(31,'admin','change-password'),(32,'admin','employee'),(33,'admin','pre-employment'),(34,'admin','view-employee'),(35,'admin','employee-memo'),(36,'admin','employee-file'),(37,'admin','download-employee-file'),(38,'admin','delete-employee-file'),(39,'admin','add-employee-file'),(40,'admin','employee-memo'),(41,'admin','add-employee-memo'),(42,'admin','delete-employee-memo'),(43,'admin','delete-employee-memo'),(44,'admin','employee-quizzes'),(45,'admin','edit-employee-quiz'),(46,'admin','delete-employee-quiz'),(47,'admin','employee-attendance'),(48,'admin','view'),(49,'admin','settings'),(50,'admin','employee-evaluation'),(51,'admin','edit-employee-evaluation'),(52,'admin','view-candidate-profile'),(53,'admin','employee-salary'),(54,'admin','employee-clubs'),(55,'admin','employee-points'),(56,'admin','employee-feedback'),(57,'admin','logout'),(58,'admin','login'),(59,'admin','authenticate'),(60,'admin','index'),(61,'admin','viewProfile'),(63,'guest','profileLogout'),(64,'admin','profileLogout'),(65,'admin','hr'),(67,'admin','accounting'),(68,'guest','login'),(69,'guest','authenticate'),(70,'employee','viewProfile'),(71,'employee','logout'),(72,'employee','profileLogout'),(73,'admin','edit'),(74,'admin','upload-profile-picture'),(75,'guest','profile'),(76,'guest','view'),(77,'guest','edit'),(78,'guest','logout'),(79,'admin','download-employee-memo'),(80,'guest','register'),(81,'admin','register'),(82,'admin','smtp');
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `artist` (`artist`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (4,'jr','the chipmonks',2),(9,'nirvana','nevermind',2),(20,'mark lagman','patayin sa sindak ni barbara',0),(21,'ko','marlo',0),(22,'YYY','posi',1),(23,'34WWWW','LALUNA',2),(24,'new at','new',1),(25,'Yano','SM',2),(26,'REM','Fire',2);
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Rock'),(2,'Sentimental');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_evaluation`
--

DROP TABLE IF EXISTS `employee_evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `notes` text,
  `score` float DEFAULT '0',
  `status` enum('pending','rejected','approved') NOT NULL DEFAULT 'pending',
  `employee_id` int(11) NOT NULL COMMENT 'id of employee ',
  `evaluated_by` int(11) NOT NULL COMMENT 'logged in user_id can be anyone with userid ',
  `created` datetime NOT NULL,
  `evaluation_due` date NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_evaluation`
--

LOCK TABLES `employee_evaluation` WRITE;
/*!40000 ALTER TABLE `employee_evaluation` DISABLE KEYS */;
INSERT INTO `employee_evaluation` VALUES (1,'Evaluation1',NULL,90,'pending',1,0,'0000-00-00 00:00:00','2015-02-28','2015-01-13 01:57:44'),(2,'Evaluation2XX',NULL,NULL,'approved',1,0,'2014-10-02 00:00:00','0000-00-00','2014-10-24 16:14:07'),(3,'Evaluation1',NULL,NULL,'pending',2,0,'0000-00-00 00:00:00','0000-00-00','2014-10-27 15:01:27'),(4,'asdsXXX','sd',NULL,'pending',2,0,'0000-00-00 00:00:00','0000-00-00','2014-10-27 15:01:22'),(5,'evaluation3','ed eval3',NULL,'pending',2,0,'0000-00-00 00:00:00','2014-10-11','2014-10-24 18:11:09'),(6,'Evaluation3','Marvin\'s evaluation updated to Feb 2 2015',NULL,'pending',1,0,'0000-00-00 00:00:00','2015-05-30','2014-10-27 14:55:03'),(7,'ed final evaluation','this is edgar final evaluation',NULL,'pending',2,0,'0000-00-00 00:00:00','0000-00-00','2014-10-27 15:01:18'),(8,'final and last evaluation','this will be the final and last evaluation to becoming a CEO of the compay',NULL,'pending',1,0,'0000-00-00 00:00:00','2015-03-30','2014-10-27 14:55:59'),(9,'java OOp','wewe',NULL,'pending',3,11,'2014-10-28 14:59:42','0000-00-00','2014-10-28 14:59:42'),(10,'First evaluation','this is Niks first evaluation after job offer\r\n',NULL,'pending',5,11,'2014-11-04 11:13:38','0000-00-00','2014-11-04 11:13:38');
/*!40000 ALTER TABLE `employee_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_files`
--

DROP TABLE IF EXISTS `employee_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type_id` varchar(3) NOT NULL,
  `filename` varchar(175) NOT NULL,
  `description` varchar(225) NOT NULL,
  `added` datetime NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_files`
--

LOCK TABLES `employee_files` WRITE;
/*!40000 ALTER TABLE `employee_files` DISABLE KEYS */;
INSERT INTO `employee_files` VALUES (49,'2','userfile4_2_5422c873eb0a1.doc','resume','2014-09-24 21:34:43',4),(50,'3','userfile7_3_5422c88bb459e.doc','Jo','2014-09-24 21:35:07',7),(51,'2','userfile7_2_5422c894147c4.doc','res','2014-09-24 21:35:16',7),(53,'2','userfile8_2_5423c910d2400.doc','res','2014-09-25 15:49:36',8),(54,'2','userfile3_2_5424ed5c3892f.doc','resume','2014-09-26 12:36:44',3),(55,'1','userfile3_1_5424ed985f752.jpg','my gf','2014-09-26 12:37:44',3),(56,'1','userfile6_1_5424ee2ee4f7d.jpg','resume picture','2014-09-26 12:40:14',6),(57,'3','userfile5_3_542ce69f5e476.sss','j Lawrence Job Offer','2014-10-02 13:46:07',5),(60,'1','userfile1_1_54c2089146f6f.png','kriss','2015-01-23 02:38:41',1);
/*!40000 ALTER TABLE `employee_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_filetypes`
--

DROP TABLE IF EXISTS `employee_filetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_filetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_type_name` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_filetypes`
--

LOCK TABLES `employee_filetypes` WRITE;
/*!40000 ALTER TABLE `employee_filetypes` DISABLE KEYS */;
INSERT INTO `employee_filetypes` VALUES (1,'Picture'),(2,'Resume'),(3,'Job Offer'),(4,'Contract');
/*!40000 ALTER TABLE `employee_filetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_logins`
--

DROP TABLE IF EXISTS `employee_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `log_type` int(11) NOT NULL COMMENT '1 for in 0 for out',
  `time` datetime NOT NULL,
  `ip_address` text NOT NULL COMMENT 'the machine IP address use to login and log out',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_logins`
--

LOCK TABLES `employee_logins` WRITE;
/*!40000 ALTER TABLE `employee_logins` DISABLE KEYS */;
INSERT INTO `employee_logins` VALUES (1,1,0,'2014-10-27 17:01:32','192.168.4.167'),(2,1,0,'2014-10-27 18:07:25','192.168.4.167'),(3,1,0,'2014-10-27 19:04:24','192.168.4.167'),(4,1,0,'2014-10-27 19:23:25','192.168.4.167'),(5,1,0,'2014-10-27 19:26:39','192.168.4.167'),(6,1,0,'2014-10-28 14:46:22','192.168.4.167'),(7,1,0,'2014-10-28 14:47:14','192.168.4.167'),(8,1,0,'2014-10-28 14:48:40','192.168.4.167'),(9,1,0,'2014-10-28 14:51:34','192.168.4.167'),(10,1,0,'2014-10-28 14:53:16','192.168.4.167'),(11,1,0,'2014-10-28 14:55:28','192.168.4.167'),(12,1,0,'2014-10-28 14:56:12','192.168.4.167'),(13,1,0,'2014-10-28 14:57:12','192.168.4.167'),(14,1,0,'2014-10-28 15:07:01','192.168.4.167'),(15,2,0,'2014-10-28 15:10:01','192.168.4.167'),(16,4,0,'2014-10-28 15:13:24','192.168.4.167'),(17,5,0,'2014-10-28 15:18:32','192.168.4.167'),(18,6,0,'2014-10-28 15:26:02','192.168.4.167'),(19,3,0,'2015-01-09 00:34:24','192.168.4.125'),(20,3,0,'2015-01-09 01:06:10','192.168.4.125'),(21,3,0,'2015-01-09 01:07:43','192.168.4.125');
/*!40000 ALTER TABLE `employee_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_memo`
--

DROP TABLE IF EXISTS `employee_memo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_memo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(125) NOT NULL,
  `filename` varchar(125) NOT NULL,
  `issue_date` datetime NOT NULL,
  `issued_to` int(11) NOT NULL,
  `issued_by` int(11) NOT NULL COMMENT 'user id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_memo`
--

LOCK TABLES `employee_memo` WRITE;
/*!40000 ALTER TABLE `employee_memo` DISABLE KEYS */;
INSERT INTO `employee_memo` VALUES (1,'first written warning','memo_1_544613840ae41.pdf','2014-10-21 16:04:20',1,11),(2,'e','memo_3_544f3ec5add4f.ico','2014-10-28 14:59:17',3,11),(3,'ffff','memo_1_54b4cfd8b1f09.jpg','2015-01-13 01:57:12',1,11),(4,'dfdfdf','memo_1_54c208ad4f2ae.txt','2015-01-23 02:39:09',1,11);
/*!40000 ALTER TABLE `employee_memo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_notification`
--

DROP TABLE IF EXISTS `employee_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(175) NOT NULL,
  `from` int(11) NOT NULL COMMENT 'employee_id',
  `to` int(11) NOT NULL COMMENT 'employee_id',
  `link` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_notification`
--

LOCK TABLES `employee_notification` WRITE;
/*!40000 ALTER TABLE `employee_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_position`
--

DROP TABLE IF EXISTS `employee_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_position`
--

LOCK TABLES `employee_position` WRITE;
/*!40000 ALTER TABLE `employee_position` DISABLE KEYS */;
INSERT INTO `employee_position` VALUES (1,1,1,'2014-10-23 00:00:00'),(2,2,1,'2014-10-24 00:00:00');
/*!40000 ALTER TABLE `employee_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_quiz`
--

DROP TABLE IF EXISTS `employee_quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(175) NOT NULL,
  `score` float NOT NULL,
  `employee_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_quiz`
--

LOCK TABLES `employee_quiz` WRITE;
/*!40000 ALTER TABLE `employee_quiz` DISABLE KEYS */;
INSERT INTO `employee_quiz` VALUES (1,'basic brain test',93,1,'2014-10-13 17:32:50','2014-10-13 17:32:50'),(2,'java OOp',98,1,'2014-10-27 19:08:20','2014-10-27 19:08:20'),(4,'reb',90,3,'2014-11-04 16:56:15','2014-11-04 16:56:15'),(5,'designs',90,3,'2014-11-04 16:56:23','2014-11-04 16:56:23'),(6,'Basic Scalla Programming',89,1,'2015-01-13 01:55:34','2015-01-13 01:55:34');
/*!40000 ALTER TABLE `employee_quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_salary`
--

DROP TABLE IF EXISTS `employee_salary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `salary` float NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_salary`
--

LOCK TABLES `employee_salary` WRITE;
/*!40000 ALTER TABLE `employee_salary` DISABLE KEYS */;
INSERT INTO `employee_salary` VALUES (1,1,28000,'2013-04-16 00:00:00','2014-04-16 00:00:00'),(2,1,45000,'2014-10-23 00:00:00','2014-10-23 00:00:00'),(3,2,45000,'2014-10-23 00:00:00','2014-10-23 00:00:00');
/*!40000 ALTER TABLE `employee_salary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `date_hired` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,11,'2012-10-03',1),(2,13,'2014-10-23',1),(3,12,'2014-10-28',1),(4,14,'2014-10-28',1),(5,15,'2014-10-28',1),(6,16,'2014-10-28',1),(7,17,'2014-10-28',1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (1,'male'),(2,'female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(75) NOT NULL,
  `added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` VALUES (1,'PHP Developer','2014-09-15 00:00:00'),(2,'Sr. PHP Developer','2014-09-15 00:00:00'),(3,'President','2014-09-15 00:00:00'),(4,'Sr. IT Support ','2014-09-15 00:00:00'),(5,'Jr. IT Support','2014-09-15 00:00:00'),(6,'HR Head','2014-09-15 00:00:00'),(7,'HR Assistant','2014-09-15 00:00:00'),(8,'Call Center Agent','2014-09-15 00:00:00');
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `firstname` varchar(75) NOT NULL,
  `lastname` varchar(75) NOT NULL,
  `middle` varchar(75) NOT NULL,
  `birthdate` date NOT NULL,
  `gender_id` int(3) NOT NULL,
  `address` varchar(150) NOT NULL,
  `landline` varchar(50) NOT NULL,
  `cellphone` varchar(50) NOT NULL,
  `about` text NOT NULL,
  `created` date NOT NULL,
  `last_modified` datetime NOT NULL,
  `profile_pic_url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (10,11,'Marvin','Manguiat','U','2007-01-09',1,'#64 dela rosa st. makati city','123456','901223221','Programming since 2006, i can handle medium to large complex system.','2011-01-05','2015-01-09 02:54:47','/img/avatar/user11.png'),(11,12,'Jayson','Salillas','x','1981-07-08',1,'Bulacan Philippines','36985212','09178858475','I\'m Jason Salillias, From Bulacan MM.','0000-00-00','2014-10-27 19:30:34','/img/avatar/user12.png'),(12,13,'Edgar','Delacruz','Pugi','1900-04-27',1,'sfdsfdf','435454545','23434343434','ed','0000-00-00','2014-10-03 12:36:18','/img/avatar/user13.png'),(13,14,'Peter ','Dinklage','M','1969-10-15',1,'Morristown, New Jersey','4512125','09198852124',' Emmy Award and Golden Globe winner','2014-10-28','2014-10-28 00:00:00','/img/avatar/user14.png'),(14,15,'Nikolaj','Waldau','Coster','1970-07-27',1,'Rudkøbing, Denmark','5623251','09184547','Danish actor, producer, and screenwriter. He attended Statens Teaterskole in Copenhagen in 1993. In the United States, he played Detective John Amsterdam on the short-lived Fox television series New Amsterdam, as well as appearing as Frank Pike in the 2009 Fox television film Virtuality, originally intended as a pilot. Since April 2011, he became known to a broad audience by playing the role of Jaime Lannister in the HBO series Game of Thrones','0000-00-00','2014-10-28 15:13:19','/img/avatar/user15.png'),(15,16,'Lena','Headey','M','1973-10-03',2,'Hamilton, Bermuda','5625214','0919852514','British actress, she was born in Bermuda, to parents from Yorkshire, England, where she was also raised. She is the daughter of Sue and John Headey, a police officer. Headey is best known for her appearances in The Brothers Grimm (2005), Possession (2002), and The Remains of the Day (1993). Headey stars as Queen Gorgo, a heroic Spartan woman in the period film 300 (2006), by director Zack Snyder.','0000-00-00','2014-10-28 15:18:20','/img/avatar/user16.png'),(16,17,'Isaac','Wright','Hempstead','1999-04-09',1,'England, UK','5623528','09184517','Isaac Hempstead-Wright is an English actor. He began his professional acting career at the age of eleven, Hempstead-Wright is best known for his role as Bran Stark on the HBO series Game of Thrones, which earned him a Young Artist Award nomination as Best Young Supporting Actor in a TV Series','0000-00-00','2014-10-28 15:25:58','/img/avatar/user17.png');
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'mmanguiat','secret123','marvin.manguiat@sourcefit.com','admin'),(12,'jsalillas','secret123','jayson.salillas@sourcefit.com','employee'),(13,'edelacruz','secret123','edgar.delacruz@sourcefit.com','guest'),(14,'peterdinklage','secret123','peterdinklage@yahoo.com','employee'),(15,'nikolacosterwaldau','secret123','nikolacosterwaldau@yahoo.com','employee'),(16,'lenaheadey','secret123','lenaheadey@gmail.com','employee'),(17,'isaachempstead','secret123','isaachempstead@gmail.com','employee'),(18,'nivramstrikes','secret123','nivramstrikes@gmail.com','guest');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-04 10:16:59
