-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: deepspace
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id_p` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `imag` varchar(45) NOT NULL,
  PRIMARY KEY (`id_p`),
  UNIQUE KEY `idproduct_UNIQUE` (`id_p`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Black Hoodie',1500,'Gildan Heavyweight Hoodie ','impr_952672-PDP.jpg');
INSERT INTO `product` VALUES (2,'Black suit',2500,'Stylish black suit with black pants ','mensuit-black1.jpg');
INSERT INTO `product` VALUES (3,'Black suit',2600,'Stylish black suit with black pants ','mensuit-black3.jpg');
INSERT INTO `product` VALUES (4'Blue suit',2700,'Stylish Blue suit with blue pants ','mensuit-blue.jpg');
INSERT INTO `product` VALUES (5,'blue and Black suit',3500,'Stylish black and blue suit with blue jeans','mensuit-blueandblack.jpg');
INSERT INTO `product` VALUES (6,'Dark Blue suit',2500,'Stylish Dark Blue suit with Blue pants ','mensuit-darkblue.jpg');
INSERT INTO `product` VALUES (7,'darkgray suit',3000,'Stylish darkgray suit with darkgray pants ','mensuit-darkgray.jpg');
INSERT INTO `product` VALUES (8,'gray suit',2500,'Stylish gray suit with gray pants ','mensuit-gray.jpg');
INSERT INTO `product` VALUES (9,'Light gray suit',2350,'Stylish DarkGray suit with Gray pants ','mensuit-lightgray.jpg');

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-14 18:13:22
