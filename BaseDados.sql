-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: economize
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.34-MariaDB

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
-- Table structure for table `conta`
--

DROP TABLE IF EXISTS `conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conta` (
  `id_conta` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `valor_inicial` decimal(12,2) DEFAULT '0.00',
  `valor_atual` decimal(12,2) DEFAULT '0.00',
  `total_receita` decimal(12,2) DEFAULT '0.00',
  `total_despesa` decimal(12,2) DEFAULT '0.00',
  `fk_id_tipo_conta` tinyint(4) NOT NULL,
  `fk_id_utilizador` bigint(20) NOT NULL,
  PRIMARY KEY (`id_conta`),
  KEY `fk_id_tipo_conta` (`fk_id_tipo_conta`),
  KEY `fk1_id_utilizador` (`fk_id_utilizador`),
  CONSTRAINT `fk1_id_utilizador` FOREIGN KEY (`fk_id_utilizador`) REFERENCES `utilizador` (`id_utilizador`),
  CONSTRAINT `fk_id_tipo_conta` FOREIGN KEY (`fk_id_tipo_conta`) REFERENCES `tipo_conta` (`id_tipo_conta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conta`
--

LOCK TABLES `conta` WRITE;
/*!40000 ALTER TABLE `conta` DISABLE KEYS */;
/*!40000 ALTER TABLE `conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_conta`
--

DROP TABLE IF EXISTS `tipo_conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_conta` (
  `id_tipo_conta` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_conta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_conta`
--

LOCK TABLES `tipo_conta` WRITE;
/*!40000 ALTER TABLE `tipo_conta` DISABLE KEYS */;
INSERT INTO `tipo_conta` VALUES (1,'Conta à Ordem'),(2,'Conta Poupança'),(3,'Conta Salário');
/*!40000 ALTER TABLE `tipo_conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_transacao`
--

DROP TABLE IF EXISTS `tipo_transacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_transacao` (
  `id_tipo_transacao` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tipo_transacao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_transacao`
--

LOCK TABLES `tipo_transacao` WRITE;
/*!40000 ALTER TABLE `tipo_transacao` DISABLE KEYS */;
INSERT INTO `tipo_transacao` VALUES (1,'Receita'),(2,'Despesa');
/*!40000 ALTER TABLE `tipo_transacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transacao`
--

DROP TABLE IF EXISTS `transacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transacao` (
  `id_transacao` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `data_transacao` datetime NOT NULL,
  `fk_id_tipo_transacao` tinyint(4) NOT NULL,
  `fk_id_conta` bigint(20) NOT NULL,
  `fk_id_utilizador` bigint(20) NOT NULL,
  PRIMARY KEY (`id_transacao`),
  KEY `fk_id_tipo_transacao` (`fk_id_tipo_transacao`),
  KEY `fk_id_conta` (`fk_id_conta`),
  KEY `fk_id_utilizador` (`fk_id_utilizador`),
  CONSTRAINT `fk_id_conta` FOREIGN KEY (`fk_id_conta`) REFERENCES `conta` (`id_conta`),
  CONSTRAINT `fk_id_tipo_transacao` FOREIGN KEY (`fk_id_tipo_transacao`) REFERENCES `tipo_transacao` (`id_tipo_transacao`),
  CONSTRAINT `fk_id_utilizador` FOREIGN KEY (`fk_id_utilizador`) REFERENCES `utilizador` (`id_utilizador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transacao`
--

LOCK TABLES `transacao` WRITE;
/*!40000 ALTER TABLE `transacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `transacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilizador`
--

DROP TABLE IF EXISTS `utilizador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilizador` (
  `id_utilizador` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilizador`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilizador`
--

LOCK TABLES `utilizador` WRITE;
/*!40000 ALTER TABLE `utilizador` DISABLE KEYS */;
/*!40000 ALTER TABLE `utilizador` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-18 17:33:09
