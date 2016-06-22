-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: DEPENSES_DB
-- ------------------------------------------------------
-- Server version	5.7.11

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
-- Table structure for table `xpenses`
--

DROP TABLE IF EXISTS `xpenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xpenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_depense` date NOT NULL COMMENT 'date de depense\n',
  `montant` decimal(8,2) NOT NULL COMMENT 'somme depensee ',
  `produit` varchar(100) NOT NULL,
  `type_payment` varchar(45) NOT NULL DEFAULT 'Carte' COMMENT 'type de payment utilise: carte, cheque, liquide..',
  `compte` varchar(45) NOT NULL DEFAULT 'LCL' COMMENT 'compte utilise: bnp, lcl, unicredit, genius card  etc…',
  `categorie_produit` varchar(45) NOT NULL DEFAULT 'Alimentation' COMMENT 'categorie: nutrition, habiliment, voyage, …',
  `partenaire` varchar(45) NOT NULL,
  `contrib_partenaire` decimal(4,2) DEFAULT NULL,
  `lieu_achat` varchar(100) NOT NULL,
  `raison` text COMMENT 'raison de la depense\n',
  `imprevu` varchar(5) NOT NULL DEFAULT 'No',
  `recurrent` varchar(5) DEFAULT 'No' COMMENT 'Indicate if the expense is recurrent or not the possible values are : Monthly , weekly , daily\n',
  `description` text,
  `photo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin7;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xpenses`
--

LOCK TABLES `xpenses` WRITE;
/*!40000 ALTER TABLE `xpenses` DISABLE KEYS */;
INSERT INTO `xpenses` VALUES (1,'2016-03-25',60.00,'resto camer','Carte','LCL','Alimentation','',0.50,'Paris ','premier salaire','N',NULL,'payer le resto a francis, Amadou, la nga de Francis. Feter mon premier salaire',NULL),(7,'2016-03-28',6.00,'Huile amande douce','Contant','contant','Cometique','',0.50,'Paris Chateau rouge','Soin dermatologique','N',NULL,'Achat d\'huile de huile d\'amande douce pour soin dermatologique',NULL),(8,'2016-03-28',3.00,'Huile de Coco','Contant','contant','Cosmetique','',0.50,'paris chateau rouge','Soin dermatologique','N',NULL,'Achat d\'huile de coco pour traitement dermatologique',NULL),(9,'2016-03-28',10.00,'Kebbab','Contant','Contant','Alimentation','',0.50,'Paris resto Turque ','dejeuner','N','N','Dejeuner avec Francis et Amadou dans le 20eme Arr',NULL),(10,'2016-03-28',8.99,'Huile D\' Argan 100% pur','Carte','BNP','Cosmetique','N',0.50,'Paris place de la Nation','Soin dermatologique','N','N','Achat de l\'huile d\'argan 100% pur pour traitement dermatologique',NULL),(11,'2016-03-28',9.99,'Aderma Gel Mousseux nettoyant visage','Carte','BNP','Cosmetique ','N',0.50,'Paris place de la Nationa- SELARL NATION PHARMACIE','Soin dermatologique','N','N','Achat gel nettoyant pour visage et corp',NULL),(12,'2016-03-28',1.00,'Don','Contant','Contant','Don','N',0.50,'Paris entree metro place de la Nation','Don','Y','N','Don',NULL),(13,'2016-03-28',6.50,'Glycerine Pur','Carte','LCL','Cosmetique','N',0.50,'Paris Place de la Nation','Soin Dermatologique','N','Y','Soin dermatologique',NULL),(14,'2016-03-29',50.00,'Resto Cisco','Carte','BNP','Alimentation','N',0.50,'Paris Issy les Moulineaux','Alimenation','N','Y','recharge badge Resto ',NULL),(15,'2016-03-29',72.90,'Tondeuse Panasonic','Carte','LCL','Bien-etre','N',0.50,'Amazon.de','Tondeuse','N','N','tondeuse panasonic barbe et cheveux',NULL),(16,'2016-04-01',70.00,'abonnement mensuel ratp','Carte','LCL','Transport','N',0.50,'Paris station luxembourg','abbonement transport','N','Y','abbonement transport mensuel',NULL),(17,'2016-04-02',35.00,'Drinks','Carta','LCL','Divertissement','N',0.50,'Paris Quartier Latin','Sortie avec Omolayo ','Y','N','sortie quartier latin avec Omolayo',NULL),(18,'2016-04-03',16.00,'Drinks','Contant','Contant','Divertissement','N',0.50,'Paris auartier Latin','Sortie avec Anna B.','N','N','Sortie au quartier Latin avec Anna',NULL),(19,'2016-04-03',10.50,'resto Vietnamien','Contant','Contant','Alimentation','N',0.50,'Paris  5eme arrondissement Hanon resto ','Diner','N','N','diner',NULL),(20,'2016-04-04',20.00,'Poisson braise','Contant','Contant','Alimentation','N',0.50,'Paris 18eme arr resto togolais','Diner','Y','N','diner dans le 18eme',NULL),(21,'2016-04-04',43.00,'Envois argent','Contant','Contant','Transfert d argent','N',0.50,'paris MoneyGram saint michel','pour les besoin d audrey','N','Y','argent pour les besoins de Audrey',NULL),(22,'2016-04-04',9.33,'Denrees alimentaire','Carte','LCL','Alimentation','N',0.50,'Paris Monopri Boulevard Saint Michel ','Alimentation','N','N','alimentation',NULL),(23,'2016-04-06',50.00,'Resto cisco','Carte','LCL','Alimentation','N',0.50,'Paris Issy les Moulinaux','recharge carte resto Cisco','N','Y','rechanrge carte resto cisco',NULL),(24,'2016-04-08',33.80,'Course au LIDL','Carte','LCL','Alimentation','N',0.50,'Paris strasbourg Saint-Denis','course pour alimentation','N','N','course pour alimentation au lidl de Strasbourg Saint Denis',NULL),(25,'2016-04-09',12.00,'Drinks','Carte','LCL','Divertissement','N',0.50,'Bar luxembourg','Sortie improvisee avec Anna B','Y','N','Sortie avec anna B. au Irish Pub luxembourg',NULL),(26,'2016-04-09',7.20,'Course au Trois fois Rien sainr michel','Contant','Contant','Alimentation','N',0.50,'Trois fois Rien Saint Michel','Course alimentation ','Y','N','course',NULL),(27,'2016-04-10',100.00,'Trafert d\'argent','Contant','Contact','Transfert argent','N',0.50,'Money Gram saint michel','transfert d\'argent a raissa pour la scolarite','N','N','Transfert d\'argent a Raissa',NULL),(28,'2016-04-10',30.00,'Poisson braise','Carte','LCL','alimentation','N',0.50,'Paris Resto Africain Evasion ','sortie le week end','N','N','sortie le week end',NULL),(29,'2016-04-16',16.00,'Poisson frais ','Contant','Contant','Alimentation','N',0.50,'Paris Chateau rouge','poisson braise','N','N','course au chateau rouge',NULL),(30,'2016-04-16',5.40,'Huile d \'argan','Contant','Contant','cosmetique','N',0.50,'Paris Chateau rouge','soin problem de peau','N','N','Achat produit pour soin de peau',NULL),(31,'2016-04-15',15.00,'photo ID - 16','Carte','LCL','Administratif','N',0.50,'Kodak Paris rue des Lombars ','Photo titre de sejour','N','N','photo carte d\'identite',NULL),(32,'2016-04-16',25.73,'Course Lidl ','Carte','LCL','Alimentation','N',0.50,'LIDL Paris strasbourg saint denis','course pour alimentation','N','N','course alimentation ',NULL),(33,'2016-04-16',18.00,'Course chateau rouge','Contant','Contant','Alimentation ','N',0.50,'Chateau Rouge Paris','course Alimentation ','N','N','course alimentation africaine:plantain, piment, jinjinbrem fruits',NULL),(34,'2016-04-16',6.50,'caffee Gare de Lyon ','Carte','LCL','Divertissement','N',0.50,'Gare de Lyon Paris','Caffee en attendant le train de Celine- cousine louise','Y','N','j\'ai cappuccino pour moi plud caffe offert a celine la cousine de Louise',NULL),(35,'2016-04-19',12.04,'Course MONOP Saint-Michel','Carte','LCL','Alimenttation','N',0.50,'Monop Paris Saint-Michel','achat huile d\'olive patte et ginginbre','N','N','course',NULL),(36,'2016-04-25',18.86,'Course MONOP Saint-Michel','Carte','LCL','Alimentation','N',0.50,'Monoo Saint-michel Paris','course alimentation','N','N','course',NULL),(37,'2016-04-25',14.95,'Course Picard Pantheon','Carte','LCL','Alimentation','N',0.50,'Picard Pantheon','course Alimentation','N','N','Achat 4 paves de saumon',NULL),(38,'2016-04-25',4.80,'Course Trois Fois Rien','Contant','Contant','Alimentation','N',0.50,'Trois Foix Rien Saint- michel Paris','course alimentation','N','N','Achat dentifrice sauce tomate',NULL),(39,'2016-04-23',5.00,'Taxi ','Contant','Contant','Transport','N',0.50,'Paris','completement des frais de taxi','N','N','taxi yetch de resto Le Cop Noir a royer collard- complement des frais payer par francis',NULL),(40,'2016-04-27',10.00,'Drink','Contant','Contant','Divertissement','N',0.50,'Paris boulevard Wide open space bar','Drink with Omolayo','Y','N','drink ',NULL),(41,'2016-04-27',50.00,'Resto Cisco','Carte','LCL','Alimentation','N',0.50,'Cisco Paris','recharge carte resto cisco','N','N','recharge carte resto cisco',NULL),(42,'2016-04-30',26.77,'Huile de coco Argan, neutrogena','Carte','LCL','Cosmetique','N',0.50,'Paris la defense - pharmacie du RER. Defense','soin de peau','N','N','huile d\'argan, huile de coco, neutrogena',NULL),(43,'2016-05-01',18.75,'Resto Autogrill','Carte','LCL','Alimentation','N',0.50,'Autogrill - Cote France, Aire de Morainvillliers','Dejeuner a l\'autogrill','Y','N','dejeuner a l\'aire de l\'autoroute',NULL),(44,'2016-05-01',14.00,'Drink','Carte','LCL','Divertissement','N',0.50,'Paris Odeon','Sortie avec Antonelq','Y','N','Deux drinks offert par Olivier',NULL),(45,'2016-05-01',13.70,'Payage','Carte','LCL','Voiture','N',0.50,'Vers parc de Maurice Monet','Payage','N','N','payage en allant au parc de Maurice Monet',NULL),(46,'2016-05-01',23.22,'Essence','Carte','LCL','Voiture','N',0.50,'Air de Morainvillier','essence','N','N','essence voiture',NULL),(47,'2016-05-01',70.00,'Recharge Navigo','Carte','LCL','Transport','N',0.50,'RER Luxembourg','Recharge Navigo','N','Y','recharge Navigo',NULL),(48,'2016-05-04',37.50,'Drink + planche','Carte','LCL','Divertissement','Y',0.50,'Le HIBOU paris Odeon','sortie avec Louise','N','N','sortie avec louise - Planche,drinks',NULL),(49,'2016-05-14',14.50,'dejeuner kebbab','Contant','Contant','Alimentation','Y',0.50,'Paris Monparnasse','dejeuner','N','N','dejeuner kebbab',NULL),(50,'2016-05-14',21.00,'Nespresso','Carte','LCL','Cadeau','Y',0.50,'Nepresso store paris monparnasse','Cadeau Mamy louise','Y','N','Cadeau mamy louise',NULL),(51,'2016-05-09',28.00,'Pizza ','Carte','LCL','Alimentation','Y',0.50,'Paris saint michel','Diner','N','N','Diner pres Mud day',NULL),(52,'2016-05-10',22.30,'Top sushi','Carte','LCL','Alimentation','Y',0.50,'Paris top sushi saint michel','diner olivier et louise','Y','N','diner sushi olivier et Louise',NULL),(53,'2016-05-13',17.00,'Cine ','Carte','LCL','Divertissement','Y',0.50,'UGC les Halles','Cine ','N','N','film le chasseur et la reine',NULL),(54,'2016-05-10',189.40,'fixation grille pare chock fiat','Carte','LCL','Voiture','N',0.50,'Garage de Luca Monrouge','reparation voiture','N','N','fixation grille pare chock achat et remplacement des essui galce plus controle de niveau',NULL),(55,'2016-05-10',50.00,'Resto Cisco','Carte','LCL','Alimentation','N',0.50,'Praris Issy les Mouineau','recharge carte resto cisco','N','Y','Recharge carte pour resto Cisco',NULL),(56,'2016-05-09',69.18,'Course Lidl','Carte','LCl','Alimentation','Y',0.50,'lidl ','course','N','N','course provision avec louise',NULL),(57,'2016-05-06',26.60,'Essence','Carte','LCL','Voiture','N',0.50,'ELF Malakoff','carburan voiture','N','N','carburan voiture',NULL);
/*!40000 ALTER TABLE `xpenses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-22 17:20:53
