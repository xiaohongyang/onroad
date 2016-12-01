-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: 192.168.10.10    Database: onroad
-- ------------------------------------------------------
-- Server version	5.7.12-0ubuntu1.1

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
-- Table structure for table `tq_migration`
--

DROP TABLE IF EXISTS `tq_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tq_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tq_migration`
--

LOCK TABLES `tq_migration` WRITE;
/*!40000 ALTER TABLE `tq_migration` DISABLE KEYS */;
INSERT INTO `tq_migration` VALUES ('m000000_000000_base',1480074817),('m161125_113645_createUserTable',1480074884),('m161125_121720_create_user_table',1480121398),('m161125_132615_create_user_info_table',1480121467),('m161125_143842_alter_column_for_table_user',1480121468),('m161125_161306_set_default_value_for_password_colomn_in_user_table',1480121648),('m161126_025731_alter_coloumn_mobile_for_user_table',1480129166),('m161126_030005_alter_column_user_id_for_table_user_info',1480129274),('m161126_112817_add_column_timeliness_for_table_user_info',1480159866);
/*!40000 ALTER TABLE `tq_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tq_user`
--

DROP TABLE IF EXISTS `tq_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tq_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL COMMENT '用户手机',
  `authKey` varchar(100) NOT NULL DEFAULT '' COMMENT 'authKey',
  `accessToken` varchar(100) NOT NULL DEFAULT '' COMMENT 'accessToken',
  `created_at` int(10) DEFAULT '0' COMMENT '添加时间',
  `updated_at` int(10) DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tq_user`
--

LOCK TABLES `tq_user` WRITE;
/*!40000 ALTER TABLE `tq_user` DISABLE KEYS */;
INSERT INTO `tq_user` VALUES (95,'','','15995716427','','',0,0),(97,'','','15995716423','','',0,0),(98,'','','15995716111','','',0,0),(99,'','','15971624441','','',1480160357,1480160357),(105,'','','15050163921','','',1480256464,1480256464),(106,'','','15050163929','','',1480257803,1480257803);
/*!40000 ALTER TABLE `tq_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tq_user_info`
--

DROP TABLE IF EXISTS `tq_user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tq_user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户表id',
  `sex` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1男,2女,3未知',
  `clock_time_hour` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '上班hour部分',
  `clock_time_minutes` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '上班minutes部分',
  `off_duty_hour` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '下班hour部分',
  `off_duty_minutes` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '下班minutes部分',
  `home_address` varchar(255) NOT NULL DEFAULT '' COMMENT '家庭住址',
  `home_longitude` varchar(100) NOT NULL DEFAULT '' COMMENT '家庭住址经度',
  `home_latitude` varchar(100) NOT NULL DEFAULT '' COMMENT '家庭住址纬度',
  `company_address` varchar(255) NOT NULL DEFAULT '' COMMENT '公司地址',
  `company_longitude` varchar(100) NOT NULL DEFAULT '' COMMENT '公司地址经度',
  `company_latitude` varchar(100) NOT NULL DEFAULT '' COMMENT '公司地址纬度',
  `role` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1乘客 2司机',
  `id_card_front` varchar(255) NOT NULL DEFAULT '' COMMENT '身份证正面照片',
  `id_card_back` varchar(255) NOT NULL DEFAULT '' COMMENT '身份证反面照片',
  `driver_card` varchar(255) NOT NULL DEFAULT '' COMMENT '驾驶证照片',
  `timeliness` smallint(1) unsigned NOT NULL DEFAULT '1' COMMENT '时效性 1准时, 2一般, 3不准时',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tq_user_info`
--

LOCK TABLES `tq_user_info` WRITE;
/*!40000 ALTER TABLE `tq_user_info` DISABLE KEYS */;
INSERT INTO `tq_user_info` VALUES (31,95,1,7,30,17,30,'33','homeLongitude','homeLatitude','44','companyLongitude','companyLatitude',2,'uploads/95/idCardFront.jpg','uploads/95/idCardBack.jpg','uploads/95/driverCard.jpg',1),(32,97,1,7,30,17,30,'33','homeLongitude','homeLatitude','44','companyLongitude','companyLatitude',2,'uploads/97/idCardFront.jpg','uploads/97/idCardBack.jpg','uploads/97/driverCard.png',1),(33,98,1,9,30,17,30,'杭州','120.161693','30.280059','下沙','120.127735','30.147679',2,'uploads/98/idCardFront.jpg','uploads/98/idCardBack.jpg','uploads/98/driverCard.png',1),(34,99,1,9,30,17,30,'杭州','120.161693','30.280059','杭州西湖延安路80号','120.141375','30.257806',2,'uploads/99/idCardFront.jpg','uploads/99/idCardBack.jpg','uploads/99/driverCard.jpg',2),(39,105,1,9,30,17,30,'杭州西湖延安路1号','120.170737','30.266971','杭州西湖延安路250号','120.141375','30.257806',2,'uploads/105/idCardFront.jpg','uploads/105/idCardBack.png','uploads/105/driverCard.jpg',2),(40,106,2,9,30,17,30,'杭州','120.161693','30.280059','杭州下沙','120.127735','30.147679',1,'','','',3);
/*!40000 ALTER TABLE `tq_user_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-28 20:37:10
