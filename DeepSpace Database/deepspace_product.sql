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
  `stock` int NOT NULL,
  PRIMARY KEY (`id_p`),
  UNIQUE KEY `idproduct_UNIQUE` (`id_p`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Black Hoodie',1500,'Gildan Heavyweight Hoodie ','impr_952672-PDP.jpg',482),
(2,'Women Flower texture Dress',6000,'Orange Woman dress with flowers texture','womendress-orang.jpg',99),
(3,'Women Red-dress',5000,'Stylish DarkGray suit with Gray pants ','womendress-red.jpg',240),
(4,'Black suit',2500,'Stylish black suit with black pants ','mensuit-black1.jpg',92),
(5,'Black suit',2600,'Stylish black suit with black pants ','mensuit-black2.jpg',584),
(6,'Blue suit',2700,'Stylish Blue suit with blue pants ','mensuit-blue.jpg',790),
(7,'men red jacket',2350,'american style men red jacket','jacket-1.jpg',160),
(8,'Men Blue T-shirt',1200,'Blue t-shirt Blank','tshirt-blue.jpg',240),
(9,'Men dark blue t-shirt',1250,'Dark blue men t-shirt','tshirt-darkblue.jpg',502),
(10,'Men gray t-shirt',1250,'Men gray t-shirt blank no textrue ','tshirt-gray.jpg',240),
(11,'Men Green T-shirt',2350,'Men Green t-shirt ','tshirt-green2.jpg',241),
(12,'women blue dress',4000,'Stylish Light blue women dress ','womendress-lightblue.jpg',159),
(13,'blue and Black suit',3500,'Stylish black and blue suit with blue jeans','mensuit-blueandblack.jpg',666),
(14,'men texture t-shirt',2770,'textrue men t-shirt with openning','t-shirt-1.png',144),
(15,'men gray t-shirt',2450,'dark gray t-shirt for men ','tshirt-darkgray.jpg',135),
(16,'men light gray t-shirt',2350,'ligth gray men t-shirt','tshirt-lightblue.jpg',154),
(17,'Blue Women dress',2350,'Blue women dress blank no textures','womendress-blue.jpg',165),
(18,'Light gray suit',1230,'Stylish light Gray suit with light Gray pants ','mensuit-lightgray2.jpg',200),
(19,'Black men t-shirt',2115,'Converse t-shirt for men','polo-shirt-4.png',774),
(20,'Men white t-shirt',1450,'White t-shirt for men ','polo-shirt-2.png',126),
(21,'Men gray t-shirt',1450,'Gray t-shirt for men','polo-shirt-1.png',386),
(22,'men blue texture t-shirt',2350,'texture blue t-shirt','tshirt-2.jpg',120),
(23,'Men blue t-shirt',1550,'Pink t-shirt for men ','tshirt-pink.jpg',170),
(24,'Women black dress',7510,'Black and white dress for women','womendress-blackwhite.jpg',253),
(25,'Dark Blue suit',2500,'Stylish Dark Blue suit with Blue pants ','mensuit-darkblue.jpg',310),
(26,'Light gray suit',2350,'Stylish ligth Gray suit with ligtht Gray pants ','mensuit-lightgray.jpg',159),
(27,'darkgray suit',3000,'Stylish darkgray suit with darkgray pants ','mensuit-darkgray.jpg',549),
(28,'gray suit',2500,'Stylish gray suit with gray pants ','mensuit-gray.jpg',819),
(29,'light blue t-shirt',1265,'light blue t-shirt','polo-shirt-5.png',180),
(30,'mix t-shirt',2350,'flower and butterfly texure men-women t-shirt ','tshirt-3.jpeg',125),
(31,'men black t-shirt',1255,'men black t-shirt','tshirt-black.jpg',30),
(32,'men black t-shirt',1235,'Stylish black t-shirt ','tshirt-4.jpg',252),
(33,'men red t-shirt',500,'Men red t-shirt','tshirt-red.jpg',200),
(34,'Light blue women dress',3500,'light blue women dress','womendress-ligthblue2.jpg',142),
(35,'texture women dress',3000,'flower texture women dress','womendress-mix.jpg',140),
(36,'Men blue suit',2500,'Stylish blue men suit','suit-1.jpg',42),
(37,'women black dress',4500,'Black dress for women','womendress-black.jpg',115),
(38,'Butterfly t-shirt',1000,'T-shirt with a butterfly texture ','tshirt-1.jpeg',160);




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

-- Dump completed on 2024-06-24 12:35:41
