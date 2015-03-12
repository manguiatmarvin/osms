-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: osms
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1-log

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
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acl_roles`
--

LOCK TABLES `acl_roles` WRITE;
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` VALUES (221,'guest','index'),(222,'guest','login'),(223,'guest','authenticate'),(224,'hr-manager','authenticate'),(225,'hr-manager','index'),(227,'hr-manager','logout'),(228,'hr-manager','view'),(230,'hr-manager','Profile.index'),(231,'hr-manager','Profile.view'),(232,'hr-manager','my-attendance'),(233,'hr-manager','Profile.my-attendance'),(234,'hr-manager','my-memos'),(235,'hr-manager','Profile.my-memos'),(236,'hr-manager','my-leaves'),(237,'hr-manager','Profile.my-leaves'),(238,'hr-manager','my-evaluations'),(239,'hr-manager','Profile.my-evaluations'),(240,'hr-manager','my-quizzes'),(241,'hr-manager','Profile.my-quizzes'),(242,'hr-manager','my-feedbacks'),(243,'hr-manager','Profile.my-feedbacks'),(244,'hr-manager','my-clubs'),(245,'hr-manager','Profile.my-clubs'),(246,'hr-manager','my-points'),(247,'hr-manager','Profile.my-points'),(248,'employee','authenticate'),(249,'employee','index'),(250,'employee','logout'),(251,'employee','view'),(252,'employee','Profile.index'),(253,'employee','Profile.view'),(254,'employee','my-attendance'),(255,'employee','Profile.my-attendance'),(256,'employee','my-memos'),(257,'employee','Profile.my-memos'),(258,'employee','my-leaves'),(259,'employee','Profile.my-leaves'),(260,'employee','my-evaluations'),(261,'employee','Profile.my-evaluations'),(262,'employee','my-quizzes'),(263,'employee','Profile.my-quizzes'),(264,'employee','my-feedbacks'),(265,'employee','Profile.my-feedbacks'),(266,'employee','my-clubs'),(267,'employee','Profile.my-clubs'),(268,'employee','my-points'),(269,'employee','Profile.my-points'),(270,'hr-manager','Hr.index'),(271,'hr-manager','Hr.employee'),(272,'hr-manager','employee'),(273,'hr-manager','add-customer'),(274,'hr-manager','Hr.add-customer'),(275,'hr-manager','create-memo'),(276,'hr-manager','attendance-monitor'),(277,'hr-manager','Hr.create-memo'),(278,'hr-manager','Hr.attendance-monitor'),(279,'hr-manager','scheduling'),(280,'hr-manager','Hr.scheduling'),(281,'hr-manager','evaluation'),(282,'hr-manager','Hr.evaluation'),(283,'hr-manager','leave-monitor'),(284,'hr-manager','Hr.leave-monitor'),(285,'hr-manager','create-quiz'),(286,'hr-manager','Hr.create-quiz'),(287,'hr-manager','create-news'),(288,'hr-manager','Hr.create-news'),(289,'hr-manager','points'),(290,'hr-manager','Hr.points'),(291,'hr-manager','clubs'),(292,'hr-manager','Hr.clubs'),(293,'hr-manager','add-employee'),(294,'hr-manager','Hr.add-employee'),(295,'hr-manager','json-get-employee-list-by-name'),(296,'hr-manager','Hr.json-get-employee-list-by-name'),(297,'hr-manager','assign-schedule-employee'),(298,'hr-manager','Hr.assign-schedule-employee'),(299,'hr-manager','assign-schedule-team'),(300,'hr-manager','Hr.assign-schedule-team'),(301,'hr-manager','assign-sched-to-employee'),(302,'hr-manager','Hr.assign-sched-to-employee');
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
INSERT INTO `employee_evaluation` VALUES (1,'Evaluation1',NULL,90,'pending',1,0,'0000-00-00 00:00:00','2015-02-28','2015-01-13 01:57:44'),(2,'Evaluation2XX',NULL,NULL,'approved',1,0,'2014-10-02 00:00:00','0000-00-00','2014-10-24 16:14:07'),(3,'Evaluation13',NULL,NULL,'pending',2,0,'0000-00-00 00:00:00','0000-00-00','2015-02-13 03:37:22'),(4,'asdsXXX','sd',NULL,'pending',2,0,'0000-00-00 00:00:00','0000-00-00','2014-10-27 15:01:22'),(5,'evaluation3','ed eval3',NULL,'pending',2,0,'0000-00-00 00:00:00','2014-10-11','2014-10-24 18:11:09'),(6,'Evaluation3','Marvin\'s evaluation updated to Feb 2 2015',56,'pending',1,0,'0000-00-00 00:00:00','0000-00-00','2015-02-16 07:06:51'),(7,'ed final evaluation','this is edgar final evaluation',NULL,'pending',2,0,'0000-00-00 00:00:00','0000-00-00','2014-10-27 15:01:18'),(8,'final and last evaluation','this will be the final and last evaluation to becoming a CEO of the compay',56,'pending',1,0,'0000-00-00 00:00:00','0000-00-00','2015-02-16 07:06:44'),(9,'java OOp','wewe',NULL,'pending',3,11,'2014-10-28 14:59:42','0000-00-00','2014-10-28 14:59:42'),(10,'First evaluation','this is Niks first evaluation after job offer\r\n',NULL,'pending',5,11,'2014-11-04 11:13:38','0000-00-00','2014-11-04 11:13:38');
/*!40000 ALTER TABLE `employee_evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_feedback`
--

DROP TABLE IF EXISTS `employee_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback` text,
  `create_date` datetime DEFAULT NULL,
  `from_user_id` varchar(45) DEFAULT NULL,
  `to_employee_id` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_feedback`
--

LOCK TABLES `employee_feedback` WRITE;
/*!40000 ALTER TABLE `employee_feedback` DISABLE KEYS */;
INSERT INTO `employee_feedback` VALUES (1,'Edgar help me setup new virtual host ','2015-02-10 14:51:14','12','2','1'),(2,'Edgar Lifted the toilet seat','2015-02-12 14:51:14','12','2','1'),(3,'Edgar Stayed late to finish his work','2015-02-10 14:51:14','19','2','1'),(4,'Edgar introduced a bug on our CRM','2015-02-10 14:51:14','14','2','0');
/*!40000 ALTER TABLE `employee_feedback` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_files`
--

LOCK TABLES `employee_files` WRITE;
/*!40000 ALTER TABLE `employee_files` DISABLE KEYS */;
INSERT INTO `employee_files` VALUES (49,'2','userfile4_2_5422c873eb0a1.doc','resume','2014-09-24 21:34:43',4),(50,'3','userfile7_3_5422c88bb459e.doc','Jo','2014-09-24 21:35:07',7),(51,'2','userfile7_2_5422c894147c4.doc','res','2014-09-24 21:35:16',7),(54,'2','userfile3_2_5424ed5c3892f.doc','resume','2014-09-26 12:36:44',3),(55,'1','userfile3_1_5424ed985f752.jpg','my gf','2014-09-26 12:37:44',3),(56,'1','userfile6_1_5424ee2ee4f7d.jpg','resume picture','2014-09-26 12:40:14',6),(57,'3','userfile5_3_542ce69f5e476.sss','j Lawrence Job Offer','2014-10-02 13:46:07',5),(60,'1','userfile1_1_54c2089146f6f.png','kriss','2015-01-23 02:38:41',1),(61,'3','userfile1_3_54ddc52b4a822.pdf','jo','2015-02-13 03:34:35',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_logins`
--

LOCK TABLES `employee_logins` WRITE;
/*!40000 ALTER TABLE `employee_logins` DISABLE KEYS */;
INSERT INTO `employee_logins` VALUES (74,1,0,'2015-02-18 15:48:14','192.168.60.92'),(75,1,0,'2015-02-18 15:52:35','192.168.60.92'),(76,7,0,'2015-02-24 19:09:34','192.168.60.109'),(77,1,0,'2015-03-02 16:10:48','192.168.1.3'),(78,1,0,'2015-03-02 16:43:46','192.168.1.3'),(79,1,0,'2015-03-02 18:38:42','192.168.1.3'),(80,7,0,'2015-03-02 18:58:38','192.168.1.3'),(81,1,0,'2015-03-02 19:11:06','192.168.1.3'),(82,7,0,'2015-03-02 19:54:19','192.168.1.3'),(83,7,0,'2015-03-02 20:05:12','192.168.1.3'),(84,1,0,'2015-03-02 20:32:58','192.168.1.3'),(85,7,0,'2015-03-02 20:33:08','192.168.1.3'),(86,7,0,'2015-03-02 20:33:20','192.168.1.3'),(87,7,0,'2015-03-02 20:34:16','192.168.1.3'),(88,1,0,'2015-03-03 10:47:31','192.168.2.33'),(89,1,0,'2015-03-03 13:16:13','192.168.2.33'),(90,1,0,'2015-03-03 14:22:27','192.168.2.33'),(91,1,0,'2015-03-03 14:31:14','192.168.2.33'),(92,1,0,'2015-03-03 14:32:33','192.168.2.33'),(93,1,0,'2015-03-03 14:48:12','192.168.2.33'),(94,1,0,'2015-03-03 14:48:56','192.168.2.33'),(95,1,0,'2015-03-05 11:14:18','192.168.60.158'),(96,7,0,'2015-03-05 11:14:31','192.168.60.158'),(97,7,0,'2015-03-05 11:17:49','192.168.60.158'),(98,7,0,'2015-03-05 12:36:14','192.168.60.158'),(99,1,0,'2015-03-05 12:36:22','192.168.60.158'),(100,7,0,'2015-03-05 15:17:13','192.168.60.158'),(101,1,0,'2015-03-05 15:17:24','192.168.60.158'),(102,1,0,'2015-03-05 15:36:53','192.168.60.158'),(103,1,0,'2015-03-05 15:39:51','192.168.60.158'),(104,1,0,'2015-03-05 15:53:14','192.168.60.158'),(105,1,0,'2015-03-05 16:41:32','192.168.60.158'),(106,1,0,'2015-03-05 17:17:20','192.168.60.158'),(107,1,0,'2015-03-05 17:44:14','192.168.60.158'),(108,1,0,'2015-03-08 20:12:04','192.168.100.4'),(109,7,0,'2015-03-08 20:12:19','192.168.100.4'),(110,1,0,'2015-03-08 20:51:43','192.168.100.4'),(111,1,0,'2015-03-08 20:53:08','192.168.100.4'),(112,7,0,'2015-03-08 21:53:08','192.168.100.4'),(113,7,0,'2015-03-08 21:53:30','192.168.100.4'),(114,1,0,'2015-03-09 16:44:15','192.168.100.4'),(115,1,0,'2015-03-09 17:50:29','192.168.100.4'),(116,1,0,'2015-03-09 19:46:40','192.168.100.4'),(117,1,0,'2015-03-09 20:51:30','192.168.100.4'),(118,1,0,'2015-03-09 22:33:26','192.168.100.4'),(119,1,0,'2015-03-10 11:26:49','192.168.60.158'),(120,1,0,'2015-03-10 18:51:23','192.168.60.158');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_quiz`
--

LOCK TABLES `employee_quiz` WRITE;
/*!40000 ALTER TABLE `employee_quiz` DISABLE KEYS */;
INSERT INTO `employee_quiz` VALUES (1,'basic brain test',93,1,'2015-02-17 00:59:55','2015-02-17 00:59:55'),(2,'java OOp',98,1,'2014-10-27 19:08:20','2014-10-27 19:08:20'),(4,'reb',90,3,'2014-11-04 16:56:15','2014-11-04 16:56:15'),(5,'designs',90,3,'2014-11-04 16:56:23','2014-11-04 16:56:23'),(6,'Basic Scalla Programming',89,1,'2015-01-13 01:55:34','2015-01-13 01:55:34'),(7,'iq test',89,2,'2015-02-12 05:23:38','2015-02-12 05:23:38'),(8,'basic oop test',90,2,'2015-02-13 03:38:14','2015-02-13 03:38:14');
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
  `schedule_id` varchar(45) DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,11,'2012-10-03','',1),(2,13,'2014-10-23','1',1),(3,12,'2014-10-28','2',1),(4,14,'2014-10-28',NULL,1),(5,15,'2014-10-28',NULL,1),(6,16,'2014-10-28','2',1),(7,17,'2014-10-28','1',1),(8,0,'0000-00-00',NULL,0);
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
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_name` varchar(45) DEFAULT NULL,
  `mon` varchar(45) DEFAULT NULL,
  `tue` varchar(45) DEFAULT NULL,
  `wed` varchar(45) DEFAULT NULL,
  `thur` varchar(45) DEFAULT NULL,
  `fri` varchar(45) DEFAULT NULL,
  `sat` varchar(45) DEFAULT NULL,
  `sun` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `schedules_name_UNIQUE` (`schedule_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (1,'AM-10-7P-MF','10:00a-7:00p','10:00a-7:00p','10:00a-7:00p','10:00a-7:00p','10:00a-7:00p','','','2015-03-01 00:00:00',NULL),(2,'PM1-10P-MF','1:00p-10:00p','1:00p-10:00p','1:00p-10:00p','1:00p-10:00p','1:00p-10:00p','','','2015-03-01 00:00:00',NULL);
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (10,11,'Marvin','Manguiat','U','2007-01-09',1,'#64 dela rosa st. makati city','123456','901223221','Programming since 2006, i can handle medium to large complex system.','2011-01-05','2015-02-03 20:19:02','/img/avatar/user11.png'),(11,12,'Mason','Salillas','x','1981-07-08',1,'Bulacan Philippines','36985212','09178858475','I\'m Jason Salillias, From Bulacan MM.','0000-00-00','2014-10-27 19:30:34','/img/avatar/user12.png'),(12,13,'Edgar','Delacruz','Pugi','1900-04-27',1,'sfdsfdf','435454545','23434343434','ed','0000-00-00','2014-10-03 12:36:18','/img/avatar/user13.png'),(13,14,'Peter ','Dinklage','M','1969-10-15',1,'Morristown, New Jersey','4512125','09198852124',' Emmy Award and Golden Globe winner','2014-10-28','2014-10-28 00:00:00','/img/avatar/user14.png'),(14,15,'Nikolaj','Waldau','Coster','1970-07-27',1,'Rudkøbing, Denmark','5623251','09184547','Danish actor, producer, and screenwriter. He attended Statens Teaterskole in Copenhagen in 1993. In the United States, he played Detective John Amsterdam on the short-lived Fox television series New Amsterdam, as well as appearing as Frank Pike in the 2009 Fox television film Virtuality, originally intended as a pilot. Since April 2011, he became known to a broad audience by playing the role of Jaime Lannister in the HBO series Game of Thrones','0000-00-00','2014-10-28 15:13:19','/img/avatar/user15.png'),(15,16,'Malena','Headey','M','1973-10-03',2,'Hamilton, Bermuda','5625214','0919852514','British actress, she was born in Bermuda, to parents from Yorkshire, England, where she was also raised. She is the daughter of Sue and John Headey, a police officer. Headey is best known for her appearances in The Brothers Grimm (2005), Possession (2002), and The Remains of the Day (1993). Headey stars as Queen Gorgo, a heroic Spartan woman in the period film 300 (2006), by director Zack Snyder.','0000-00-00','2014-10-28 15:18:20','/img/avatar/user16.png'),(16,17,'Isaac','Wrighttttttttttt','Hempstead','1999-04-09',1,'England, UK','5623528','09184517','Isaac Hempstead-Wright is an English actor. He began his professional acting career at the age of eleven, Hempstead-Wright is best known for his role as Bran Stark on the HBO series Game of Thrones, which earned him a Young Artist Award nomination as Best Young Supporting Actor in a TV Series','0000-00-00','2014-10-28 15:25:58','/img/avatar/user17.png'),(17,19,'client001','client','c','1970-04-09',1,'US','123658','09154258','','0000-00-00','2015-02-12 02:30:53','/img/avatar/user19.png'),(18,20,'Rex','Villanueva','c','2000-07-07',1,'amsndfjasbdsadsadsadsd','123658','09154258','Hello this Rex','0000-00-00','2015-02-13 01:52:25','/img/avatar/user20.png');
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
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'mmanguiat','secret123','marvin.manguiat@sourcefit.com','hr-manager'),(12,'jsalillas','secret123','jayson.salillas@sourcefit.com','employee'),(13,'edelacruz','secret123','edgar.delacruz@sourcefit.com','employee'),(14,'peterdinklage','secret123','peterdinklage@yahoo.com','employee'),(15,'nikolacosterwaldau','secret123','nikolacosterwaldau@yahoo.com','employee'),(16,'lenaheadey','secret123','lenaheadey@gmail.com','employee'),(17,'isaachempstead','secret123','isaachempstead@gmail.com','employee'),(18,'nivramstrikes','secret123','nivramstrikes@gmail.com','employee'),(19,'client001','secret123','client001@gmail.com','client'),(20,'rexv','secret123','rexv@sourcefit.com','employee');
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

-- Dump completed on 2015-03-12 11:59:05
