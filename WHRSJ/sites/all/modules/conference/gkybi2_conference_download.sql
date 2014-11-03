-- MySQL dump 10.13  Distrib 5.5.27, for Linux (x86_64)
--
-- Host: localhost    Database: gkybi6
-- ------------------------------------------------------
-- Server version	5.5.27-log

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
-- Table structure for table `gkybi2_conference_download`
--

DROP TABLE IF EXISTS `gkybi2_conference_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gkybi2_conference_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `filepath` varchar(255) DEFAULT NULL,
  `description` text,
  `timestamp` int(11) unsigned NOT NULL,
  `filesize` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gkybi2_conference_download`
--

LOCK TABLES `gkybi2_conference_download` WRITE;
/*!40000 ALTER TABLE `gkybi2_conference_download` DISABLE KEYS */;
INSERT INTO `gkybi2_conference_download` VALUES (1,'28次院长书记联席会会议纪要.doc','word文件','','全国省（市、自治区）科学院第28次院长书记联席会议纪要文件。',1349837453,'31 kB'),(2,'28次院长书记联席会议合影照片.jpg','图片文件','','全国省（市、自治区）科学院第28次院长书记联席会议参会人员合影照片',1349837641,'10.3 MB'),(3,'VTS_01_1.VOB','视频文件','','武汉院党委书记程百炼致欢迎词、湖北省科技厅厅长刘传铁讲话、武汉市人民政府副市长邢早忠讲话、东湖开发区管委会副主任夏亚民主题演讲',1349839451,'0.99 GB'),(4,'VTS_01_2.VOB','视频文件','','北京院、上海院、陕西院、河北院相关领导发言',1349840727,'0.99 GB'),(5,'VTS_01_3.VOB','视频文件','','河北省科学院省政协副主席、院长王刚发言.',1349840877,'162 MB'),(6,'VTS_02_1.VOB','视频文件','','河北院、河南院发言',1349841099,'0.99 GB'),(7,'VTS_02_2.VOB','视频文件','','河南院、贵州院发言',1349843617,'0.99 GB'),(8,'VTS_02_3.VOB','视频文件','','贵州科学院发言',1349843875,'141 MB'),(9,'VTS_03_1.VOB','视频文件','','武汉院、黑龙江院发言',1349844180,'0.99 GB'),(10,'VTS_03_2.VOB','视频文件','','黑龙江院、广西院、重庆院发言',1349844378,'0.99 GB'),(11,'VTS_03_3.VOB','视频文件','','山东院、广东院、江西院发言。',1349844608,'743 MB'),(12,'VTS_04_1.VOB','视频文件','','云南院、甘肃院、湖南院发言。',1349844924,'0.99 GB'),(13,'VTS_04_2.VOB','视频文件','','沈阳院发言、会议闭幕式。',1349845175,'617 MB');
/*!40000 ALTER TABLE `gkybi2_conference_download` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-10-10 13:02:17
