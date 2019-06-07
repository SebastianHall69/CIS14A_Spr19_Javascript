-- MySQL dump 10.16  Distrib 10.1.36-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: sebast49_storefront
-- ------------------------------------------------------
-- Server version	10.1.36-MariaDB

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
-- Table structure for table `entity_account`
--

DROP TABLE IF EXISTS `entity_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_username` varchar(30) NOT NULL,
  `account_password` varchar(30) NOT NULL,
  `account_type` varchar(6) DEFAULT 'user',
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_username` (`account_username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_account`
--

LOCK TABLES `entity_account` WRITE;
/*!40000 ALTER TABLE `entity_account` DISABLE KEYS */;
INSERT INTO `entity_account` VALUES (1,'SebastianHall69','Password69','admin'),(2,'mandi','cecil','user'),(3,'rat','gingers','user'),(4,'arkhamknight','batman','user'),(5,'RatBuyer','ratbuyer','user'),(6,'ben','password','admin');
/*!40000 ALTER TABLE `entity_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_cart`
--

DROP TABLE IF EXISTS `entity_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `cart_json_text` text NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_cart`
--

LOCK TABLES `entity_cart` WRITE;
/*!40000 ALTER TABLE `entity_cart` DISABLE KEYS */;
INSERT INTO `entity_cart` VALUES (6,'{\"products\":[{\"id\":1,\"quantity\":140,\"name\":\"Buff Rat\",\"imgPath\":\"images/buffrat.png\",\"price\":15.99,\"ordered\":5,\"subtotal\":79.95}],\"taxrate\":0.08,\"total\":86.346}');
/*!40000 ALTER TABLE `entity_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity_product`
--

DROP TABLE IF EXISTS `entity_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_quantity` int(11) DEFAULT '0',
  `product_name` varchar(50) NOT NULL,
  `product_img_path` varchar(255) DEFAULT 'default/image/path.png',
  `product_price` float DEFAULT '0',
  `product_category` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name` (`product_name`),
  UNIQUE KEY `product_name_2` (`product_name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity_product`
--

LOCK TABLES `entity_product` WRITE;
/*!40000 ALTER TABLE `entity_product` DISABLE KEYS */;
INSERT INTO `entity_product` VALUES (1,145,'Buff Rat','images/buffrat.png',15.99,'rat'),(2,48,'Small Rat','images/smallrat.png',7.99,'rat'),(3,810,'Medium Rat','images/mediumrat.png',12.99,'rat'),(4,13,'Massive Rat','images/massiverat.png',179.99,'rat'),(5,273,'Elongated Rat','images/elongatedrat.png',19.99,'rat'),(6,55284,'Miniature Rat','images/miniaturerat.png',0.49,'rat'),(7,750,'Wide Rat','images/widerat.png',11.99,'rat'),(8,272,'Hairy Rat','images/hairyrat.png',2.99,'rat'),(9,35,'Sneaky Rat','images/sneakyrat.png',22.99,'rat'),(10,1,'King Rat','images/kingrat.png',999.99,'rat'),(11,25,'Ghost Rat','images/ghostrat.png',3.99,'rat'),(12,1,'Chuck E Cheese','images/chuckecheese.png',480.99,'rat'),(13,100,'Moderate Mouse','images/moderatemouse.png',1.99,'mouse'),(14,50,'Red Squirrel','images/redsquirrel.png',12.99,'squirrel'),(15,20,'Black Squirrel','images/blacksquirrel.png',5.99,'squirrel'),(16,100,'White Squirrel','images/whitesquirrel.png',9.99,'squirrel'),(17,35,'Mega Mouse','images/megamouse.png',6.99,'mouse'),(18,20,'Harry Rat','images/harryrat.png',259.99,'rat'),(20,2000000,'Communist Rat','images/communistrat.png',0.19,'rat'),(21,15,'High Definition Rat','images/highdefrat.png',29.99,'rat'),(22,40,'Hunchback Rat','images/hunchbackrat.png',4.82,'rat'),(23,5,'Scary Rat','images/scaryrat.png',12.99,'rat'),(24,300,'Pink Squirrel','images/pinksquirrel.png',8.99,'squirrel'),(25,150,'Yellow Squirrel','images/yellowsquirrel.png',7.99,'squirrel'),(26,34,'Blue Squirrel','images/bluesquirrel.png',5.99,'squirrel'),(27,69,'Green Squirrel','images/greensquirrel.png',69.69,'squirrel'),(28,10,'Copyright Mouse','images/copyrightmouse.png',1399.99,'mouse'),(29,10000,'Basic Mouse','images/basicmouse.png',1.99,'mouse'),(30,15,'People Mouse','images/peoplemouse.png',22.29,'mouse');
/*!40000 ALTER TABLE `entity_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xref_account_cart`
--

DROP TABLE IF EXISTS `xref_account_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_account_cart` (
  `account_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  KEY `account_id` (`account_id`),
  KEY `cart_id` (`cart_id`),
  CONSTRAINT `xref_account_cart_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `entity_account` (`account_id`),
  CONSTRAINT `xref_account_cart_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `entity_cart` (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xref_account_cart`
--

LOCK TABLES `xref_account_cart` WRITE;
/*!40000 ALTER TABLE `xref_account_cart` DISABLE KEYS */;
INSERT INTO `xref_account_cart` VALUES (1,6);
/*!40000 ALTER TABLE `xref_account_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sebast49_storefront'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-03  9:46:54
