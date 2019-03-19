-- MySQL dump 10.13  Distrib 5.6.22, for Win64 (x86_64)
--
-- Host: localhost    Database: prcs
-- ------------------------------------------------------
-- Server version	5.6.22-log

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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inn` bigint(12) NOT NULL,
  `director` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `inn_UNIQUE` (`inn`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Компания 20',111111111110,'Иванов Никодим Петрович','Санкт-Петербург, Невский пр-т, д. 2654654',3),(2,'Компания 12',555111111112,'Вырвикишко Александр Петрович','Санкт-Петербург, Невский пр-т, д. 10',2),(3,'Компания 94',941111111114,'Фаулз','Санкт-Петербург, Невский пр-т, д. 18',2),(4,'Компания 16',611111111116,'Достоевкий Фёдор Петрович','Санкт-Петербург, Невский пр-т, д. 6',2),(5,'Компания 588',588111111118,'Злобин Александр Васильевич','Санкт-Петербург, Невский пр-т, д. 14',2),(6,'Компания 11',111111111121,'Нечаев Павел Петрович','Санкт-Петербург, Невский пр-т, д. 11',2),(7,'Компания 15',111111111125,'Шереметьев Михаил Петрович','Санкт-Петербург, Невский пр-т, д. 7',2),(8,'Компания 19',111111111129,'Петров Светозар Петрович','Санкт-Петербург, Невский пр-т, д. 3',2),(9,'Компания 02',111111111132,'Гейтс Билл','Санкт-Петербург, Невский пр-т, д. 20',2),(10,'Компания 14',111111111134,'Никодимов Эраст Петрович','Санкт-Петербург, Невский пр-т, д. 8',2),(11,'Компания 06',111111111136,'Никулин Юрий Владимирович','Санкт-Петербург, Невский пр-т, д. 16',2),(12,'Компания 18',111111111138,'Сидоров Добрыня Петрович','Санкт-Петербург, Невский пр-т, д. 4',2),(13,'Компания 01',111111111141,'Рукоплещев Рукоплеск Рукопожатович','Санкт-Петербург, Невский пр-т, д. 21',2),(14,'Компания 13',111111111143,'Чернопупенко Роман Петрович','Санкт-Петербург, Невский пр-т, д. 9',2),(15,'Компания 05',111111111145,'Смоктуновский Иннокентий Михайлович','Санкт-Петербург, Невский пр-т, д. 17',2),(16,'Компания 17',111111111147,'Поттер Гарри Петрович','Санкт-Петербург, Невский пр-т, д. 5',2),(17,'Компания 09',111111111149,'Незлобин Александр Васильевич','Санкт-Петербург, Невский пр-т, д. 13',2),(18,'Компания 21',111111111151,'Васильев Эрнест Петрович','Санкт-Петербург, Невский пр-т, д. 1',2),(19,'Компания 10',111111111160,'Люблин Евгений Петрович','Санкт-Петербург, Невский пр-т, д. 12',2),(20,'Компания 03',111111111163,'Сапковский Анджей','Санкт-Петербург, Невский пр-т, д. 19',2),(21,'Компания 07',111111111167,'Светлов Пароход Иванович','Санкт-Петербург, Невский пр-т, д. 15',2),(24,'Копания №1',111222333444,'Директор компании №1','Адрес компании №1',2);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies_history`
--

DROP TABLE IF EXISTS `companies_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inn` bigint(12) NOT NULL,
  `director` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adress` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `last_change` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  CONSTRAINT `com_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_history`
--

LOCK TABLES `companies_history` WRITE;
/*!40000 ALTER TABLE `companies_history` DISABLE KEYS */;
INSERT INTO `companies_history` VALUES (3,1,'Компания 20',111111111110,'Иванов Никодим Петрович','Санкт-Петербург, Невский пр-т, д. 2654654',4,'2019-03-19 00:34:14'),(4,1,'Компания 20',111111111110,'Иванов Никодим Петрович','Санкт-Петербург, Невский пр-т, д. 2654654',3,'2019-03-19 01:47:14'),(10,2,'Компания 12',555111111112,'Вырвикишко Александр Петрович','Санкт-Петербург, Невский пр-т, д. 10',4,'2019-03-19 02:36:49'),(11,2,'Компания 12',555111111112,'Вырвикишко Александр Петрович','Санкт-Петербург, Невский пр-т, д. 10',2,'2019-03-19 02:37:07'),(12,3,'Компания 94',941111111114,'Фаулз','Санкт-Петербург, Невский пр-т, д. 18',4,'2019-03-19 02:49:17'),(13,3,'Компания 94',941111111114,'Фаулз','Санкт-Петербург, Невский пр-т, д. 18',2,'2019-03-19 02:49:58'),(14,4,'Компания 156',156111111116,'Достоевкий Фёдор Петрович','Санкт-Петербург, Невский пр-т, д. 6',0,'2019-03-19 02:51:48'),(15,5,'Компания 588',588111111118,'Злобин Александр Васильевич','Санкт-Петербург, Невский пр-т, д. 14',4,'2019-03-19 02:53:26'),(16,21,'Компания 22',111111111211,'Директор компании 22','Адрес компании 22',1,'2019-03-19 07:31:14'),(17,5,'Компания 588',588111111118,'Злобин Александр Васильевич','Санкт-Петербург, Невский пр-т, д. 14',2,'2019-03-19 21:26:54'),(19,4,'Компания 16',611111111116,'Достоевкий Фёдор Петрович','Санкт-Петербург, Невский пр-т, д. 6',4,'2019-03-19 23:38:08'),(20,4,'Компания 16',611111111116,'Достоевкий Фёдор Петрович','Санкт-Петербург, Невский пр-т, д. 6',2,'2019-03-19 23:38:35'),(21,24,'Копания №1',111222333444,'Директор компании №1','Адрес компании №1',5,'2019-03-20 00:41:44'),(22,24,'Копания №1',111222333444,'Директор компании №1','Адрес компании №1',2,'2019-03-20 00:50:45');
/*!40000 ALTER TABLE `companies_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(1) NOT NULL,
  `status_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (0,'Редактируется'),(1,'Модерируется'),(2,'Проверено'),(3,'Создано'),(4,'Удалено'),(5,'Архив');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-20  0:52:45
