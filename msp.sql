-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: msp
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actual_overhead_collection_level`
--

DROP TABLE IF EXISTS `actual_overhead_collection_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_collection_level` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `qty` double(17,4) DEFAULT NULL,
  `warehouse` bigint(20) DEFAULT NULL,
  `capacity` double(17,4) DEFAULT NULL,
  `procurement_center` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packing_material_type` bigint(20) DEFAULT NULL,
  `standard_packing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_packing_bags` bigint(20) DEFAULT NULL,
  `unit_cost` decimal(20,4) DEFAULT NULL,
  `total_cost_of_packaging_material` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_collection_level`
--

LOCK TABLES `actual_overhead_collection_level` WRITE;
/*!40000 ALTER TABLE `actual_overhead_collection_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_collection_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_collection_level_haat`
--

DROP TABLE IF EXISTS `actual_overhead_collection_level_haat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_collection_level_haat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `collection_level_id` bigint(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_collection_level_haat`
--

LOCK TABLES `actual_overhead_collection_level_haat` WRITE;
/*!40000 ALTER TABLE `actual_overhead_collection_level_haat` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_collection_level_haat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_detail`
--

DROP TABLE IF EXISTS `actual_overhead_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` int(11) NOT NULL,
  `proposal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_detail`
--

LOCK TABLES `actual_overhead_detail` WRITE;
/*!40000 ALTER TABLE `actual_overhead_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_estimated_wastages`
--

DROP TABLE IF EXISTS `actual_overhead_estimated_wastages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_estimated_wastages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `procurement_quantity` decimal(20,4) DEFAULT NULL,
  `procurement_value` decimal(20,4) DEFAULT NULL,
  `estimated_driage_percentage` decimal(20,4) DEFAULT NULL,
  `estimated_driage_rs` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_estimated_wastages`
--

LOCK TABLES `actual_overhead_estimated_wastages` WRITE;
/*!40000 ALTER TABLE `actual_overhead_estimated_wastages` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_estimated_wastages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_labour_charges`
--

DROP TABLE IF EXISTS `actual_overhead_labour_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_labour_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `unit_manday_rate` decimal(20,4) DEFAULT NULL,
  `estimated_mandays` int(11) DEFAULT NULL,
  `total_estimated_cost` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_labour_charges`
--

LOCK TABLES `actual_overhead_labour_charges` WRITE;
/*!40000 ALTER TABLE `actual_overhead_labour_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_labour_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_other_costs`
--

DROP TABLE IF EXISTS `actual_overhead_other_costs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_other_costs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `other_costs` double(20,4) DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_other_costs`
--

LOCK TABLES `actual_overhead_other_costs` WRITE;
/*!40000 ALTER TABLE `actual_overhead_other_costs` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_other_costs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_service_charges`
--

DROP TABLE IF EXISTS `actual_overhead_service_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_service_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `qty_of_mfp` decimal(17,4) DEFAULT NULL,
  `primary_level_agency` int(11) DEFAULT NULL,
  `estimated_value_of_mfp_procurement` decimal(20,4) DEFAULT NULL,
  `estimated_service_charge_primary_level_agency` decimal(20,4) DEFAULT NULL,
  `service_charge_in_total_value_of_procurement` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_service_charges`
--

LOCK TABLES `actual_overhead_service_charges` WRITE;
/*!40000 ALTER TABLE `actual_overhead_service_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_service_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_service_charges_dia`
--

DROP TABLE IF EXISTS `actual_overhead_service_charges_dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_service_charges_dia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) NOT NULL,
  `dia_id` bigint(20) DEFAULT NULL,
  `estimated_value_of_procurement` double(20,4) NOT NULL,
  `service_charges_percentage` double(20,4) NOT NULL,
  `service_charge_value` double(20,4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_service_charges_dia`
--

LOCK TABLES `actual_overhead_service_charges_dia` WRITE;
/*!40000 ALTER TABLE `actual_overhead_service_charges_dia` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_service_charges_dia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_transportation_charges`
--

DROP TABLE IF EXISTS `actual_overhead_transportation_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_transportation_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `approx_distance` decimal(15,4) DEFAULT NULL,
  `type_of_transport` bigint(20) DEFAULT NULL,
  `charges_per_qunital` decimal(20,4) DEFAULT NULL,
  `estimated_total_cost_of_transportation` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_transportation_charges`
--

LOCK TABLES `actual_overhead_transportation_charges` WRITE;
/*!40000 ALTER TABLE `actual_overhead_transportation_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_transportation_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_warehouse_charges`
--

DROP TABLE IF EXISTS `actual_overhead_warehouse_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_warehouse_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `unit_storage_rate` decimal(20,4) DEFAULT NULL,
  `estimated_quantity` decimal(20,4) DEFAULT NULL,
  `total_estimated_cost` decimal(20,4) DEFAULT NULL,
  `estimation_duration_of_storage` bigint(20) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_warehouse_charges`
--

LOCK TABLES `actual_overhead_warehouse_charges` WRITE;
/*!40000 ALTER TABLE `actual_overhead_warehouse_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_warehouse_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_warehouse_labour_charges`
--

DROP TABLE IF EXISTS `actual_overhead_warehouse_labour_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_warehouse_labour_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `qty` double(17,4) DEFAULT NULL,
  `unit_rate` double(20,4) DEFAULT NULL,
  `total_estimated_cost` double(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_warehouse_labour_charges`
--

LOCK TABLES `actual_overhead_warehouse_labour_charges` WRITE;
/*!40000 ALTER TABLE `actual_overhead_warehouse_labour_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_warehouse_labour_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actual_overhead_weightment_charges`
--

DROP TABLE IF EXISTS `actual_overhead_weightment_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actual_overhead_weightment_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `type` enum('H','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haat_id` int(11) DEFAULT NULL,
  `procurement_center_id` int(11) DEFAULT NULL,
  `total_estimated_cost` double(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actual_overhead_weightment_charges`
--

LOCK TABLES `actual_overhead_weightment_charges` WRITE;
/*!40000 ALTER TABLE `actual_overhead_weightment_charges` DISABLE KEYS */;
/*!40000 ALTER TABLE `actual_overhead_weightment_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auction_committe`
--

DROP TABLE IF EXISTS `auction_committe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_committe` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auction_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auction_date` date NOT NULL,
  `hour` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `venue` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=MFP,2=Value Added',
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `auction_committe_reference_number_unique` (`reference_number`),
  KEY `auction_committe_created_by_index` (`created_by`),
  KEY `auction_committe_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_committe`
--

LOCK TABLES `auction_committe` WRITE;
/*!40000 ALTER TABLE `auction_committe` DISABLE KEYS */;
/*!40000 ALTER TABLE `auction_committe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auction_committe_members`
--

DROP TABLE IF EXISTS `auction_committe_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_committe_members` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auction_id` bigint(20) NOT NULL,
  `member_id` bigint(20) NOT NULL,
  `member_designation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auction_committe_members_created_by_index` (`created_by`),
  KEY `auction_committe_members_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_committe_members`
--

LOCK TABLES `auction_committe_members` WRITE;
/*!40000 ALTER TABLE `auction_committe_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `auction_committe_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auction_committe_mfp`
--

DROP TABLE IF EXISTS `auction_committe_mfp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_committe_mfp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auction_id` bigint(20) NOT NULL,
  `mfp` bigint(20) NOT NULL,
  `qty` decimal(15,4) DEFAULT NULL,
  `value_added_product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_added_product_qty` decimal(15,4) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auction_committe_mfp_created_by_index` (`created_by`),
  KEY `auction_committe_mfp_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_committe_mfp`
--

LOCK TABLES `auction_committe_mfp` WRITE;
/*!40000 ALTER TABLE `auction_committe_mfp` DISABLE KEYS */;
/*!40000 ALTER TABLE `auction_committe_mfp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auction_committe_value_added_products`
--

DROP TABLE IF EXISTS `auction_committe_value_added_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_committe_value_added_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auction_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auction_committe_value_added_products_created_by_index` (`created_by`),
  KEY `auction_committe_value_added_products_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_committe_value_added_products`
--

LOCK TABLES `auction_committe_value_added_products` WRITE;
/*!40000 ALTER TABLE `auction_committe_value_added_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `auction_committe_value_added_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auction_transaction`
--

DROP TABLE IF EXISTS `auction_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auction_date` date NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auction_transaction_created_by_index` (`created_by`),
  KEY `auction_transaction_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_transaction`
--

LOCK TABLES `auction_transaction` WRITE;
/*!40000 ALTER TABLE `auction_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `auction_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auction_transaction_detail`
--

DROP TABLE IF EXISTS `auction_transaction_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auction_transaction_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auction_date` date DEFAULT NULL,
  `auction_transaction_id` bigint(20) NOT NULL,
  `district_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `value_added_product` int(11) DEFAULT NULL,
  `qty` decimal(15,4) NOT NULL,
  `value` decimal(20,4) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advance_amount` decimal(20,4) NOT NULL,
  `balance_amount` decimal(20,4) NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auction_transaction_detail_created_by_index` (`created_by`),
  KEY `auction_transaction_detail_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auction_transaction_detail`
--

LOCK TABLES `auction_transaction_detail` WRITE;
/*!40000 ALTER TABLE `auction_transaction_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `auction_transaction_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bank_master`
--

DROP TABLE IF EXISTS `bank_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank_master` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_master_created_by_index` (`created_by`),
  KEY `bank_master_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank_master`
--

LOCK TABLES `bank_master` WRITE;
/*!40000 ALTER TABLE `bank_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blocks_master`
--

DROP TABLE IF EXISTS `blocks_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blocks_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blocks_master_district_id_index` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blocks_master`
--

LOCK TABLES `blocks_master` WRITE;
/*!40000 ALTER TABLE `blocks_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocks_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commission_limit`
--

DROP TABLE IF EXISTS `commission_limit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commission_limit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state` bigint(20) NOT NULL,
  `commission` decimal(15,4) NOT NULL,
  `max_aggregate_commission` decimal(15,4) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commission_limit_state_index` (`state`),
  KEY `commission_limit_created_by_index` (`created_by`),
  KEY `commission_limit_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commission_limit`
--

LOCK TABLES `commission_limit` WRITE;
/*!40000 ALTER TABLE `commission_limit` DISABLE KEYS */;
/*!40000 ALTER TABLE `commission_limit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commission_master`
--

DROP TABLE IF EXISTS `commission_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commission_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state` bigint(20) NOT NULL,
  `role` int(11) NOT NULL,
  `commission` decimal(15,4) NOT NULL,
  `max_aggregate_commission` decimal(15,4) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commission_master_state_index` (`state`),
  KEY `commission_master_role_index` (`role`),
  KEY `commission_master_created_by_index` (`created_by`),
  KEY `commission_master_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commission_master`
--

LOCK TABLES `commission_master` WRITE;
/*!40000 ALTER TABLE `commission_master` DISABLE KEYS */;
INSERT INTO `commission_master` VALUES (1,23,6,10.0000,5.0000,'1',1,1,'2021-06-09 00:45:53','2021-06-09 00:46:43'),(2,23,5,5.0000,5000.0000,'1',1,1,'2021-06-11 02:14:52','2021-06-11 02:14:52');
/*!40000 ALTER TABLE `commission_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commodity_master`
--

DROP TABLE IF EXISTS `commodity_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commodity_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commodity_master`
--

LOCK TABLES `commodity_master` WRITE;
/*!40000 ALTER TABLE `commodity_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `commodity_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_master`
--

DROP TABLE IF EXISTS `department_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_master`
--

LOCK TABLES `department_master` WRITE;
/*!40000 ALTER TABLE `department_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `department_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `designation_master`
--

DROP TABLE IF EXISTS `designation_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `designation_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `designation_master`
--

LOCK TABLES `designation_master` WRITE;
/*!40000 ALTER TABLE `designation_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `designation_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `districts_master`
--

DROP TABLE IF EXISTS `districts_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `districts_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `districts_master_state_id_index` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `districts_master`
--

LOCK TABLES `districts_master` WRITE;
/*!40000 ALTER TABLE `districts_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `districts_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education_master`
--

DROP TABLE IF EXISTS `education_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `education_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education_master`
--

LOCK TABLES `education_master` WRITE;
/*!40000 ALTER TABLE `education_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `education_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'TRIFED-Email-Template','Hi __name__,<br>\r\n\r\n		                            Sample Email.<br>\r\n\r\n		                            For testing purpose only.<br>\r\n\r\n		                            Stay safe,<br>\r\n		                            Trifed Team<br>\r\n		                            <br>\r\n		                        Trifed<br>\r\n		                        We got you covered','Trifed-Demo',NULL,NULL);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financial_year_master`
--

DROP TABLE IF EXISTS `financial_year_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `financial_year_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financial_year_master`
--

LOCK TABLES `financial_year_master` WRITE;
/*!40000 ALTER TABLE `financial_year_master` DISABLE KEYS */;
INSERT INTO `financial_year_master` VALUES (1,'2018-2019','1',0,0,'2020-10-09 05:02:17','2020-10-09 05:02:17',NULL),(2,'2019-2020','1',0,0,'2020-10-09 05:02:17','2020-10-09 05:02:17',NULL),(3,'2020-2021','1',0,0,'2020-10-09 05:02:17','2020-10-09 05:02:17',NULL),(4,'2021-2022','1',0,0,'2020-10-09 05:02:17','2020-10-09 05:02:17',NULL);
/*!40000 ALTER TABLE `financial_year_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `haat_bazaar_item_master`
--

DROP TABLE IF EXISTS `haat_bazaar_item_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `haat_bazaar_item_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `cost` decimal(20,4) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `haat_bazaar_item_master`
--

LOCK TABLES `haat_bazaar_item_master` WRITE;
/*!40000 ALTER TABLE `haat_bazaar_item_master` DISABLE KEYS */;
INSERT INTO `haat_bazaar_item_master` VALUES (1,'Haat one','haat one',2,5000.0000,'1',0,0,'2021-06-09 00:22:37','2021-06-09 23:17:36'),(2,'haat two','haat two',3,50.0000,'1',0,0,'2021-06-09 00:27:08','2021-06-09 00:27:08');
/*!40000 ALTER TABLE `haat_bazaar_item_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `haat_bazaar_master`
--

DROP TABLE IF EXISTS `haat_bazaar_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `haat_bazaar_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` int(10) unsigned NOT NULL,
  `district_id` int(10) unsigned NOT NULL,
  `haat_bazaar_id` int(10) unsigned NOT NULL,
  `nature_of_operation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `haat_bazaar_master`
--

LOCK TABLES `haat_bazaar_master` WRITE;
/*!40000 ALTER TABLE `haat_bazaar_master` DISABLE KEYS */;
INSERT INTO `haat_bazaar_master` VALUES (1,23,414,406,'Retail','1',1,1,'2021-06-09 00:02:49','2021-06-09 23:18:14');
/*!40000 ALTER TABLE `haat_bazaar_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `haat_blocks_mappings`
--

DROP TABLE IF EXISTS `haat_blocks_mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `haat_blocks_mappings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `haat_detail_id` int(10) unsigned NOT NULL,
  `block_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `haat_blocks_mappings`
--

LOCK TABLES `haat_blocks_mappings` WRITE;
/*!40000 ALTER TABLE `haat_blocks_mappings` DISABLE KEYS */;
INSERT INTO `haat_blocks_mappings` VALUES (4,1,3849,'2021-06-09 00:21:49','2021-06-09 00:21:49'),(5,1,3850,'2021-06-09 00:21:49','2021-06-09 00:21:49');
/*!40000 ALTER TABLE `haat_blocks_mappings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `haat_operating_days_mappings`
--

DROP TABLE IF EXISTS `haat_operating_days_mappings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `haat_operating_days_mappings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `haat_detail_id` int(10) unsigned NOT NULL,
  `operating_day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `haat_operating_days_mappings`
--

LOCK TABLES `haat_operating_days_mappings` WRITE;
/*!40000 ALTER TABLE `haat_operating_days_mappings` DISABLE KEYS */;
INSERT INTO `haat_operating_days_mappings` VALUES (3,1,'Sunday','2021-06-09 00:21:49','2021-06-09 00:21:49');
/*!40000 ALTER TABLE `haat_operating_days_mappings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `id_proof_master`
--

DROP TABLE IF EXISTS `id_proof_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `id_proof_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `id_proof_master`
--

LOCK TABLES `id_proof_master` WRITE;
/*!40000 ALTER TABLE `id_proof_master` DISABLE KEYS */;
INSERT INTO `id_proof_master` VALUES (1,'Aadhaar ID','1',0,0,'2020-10-09 05:02:15','2020-10-09 05:02:15',NULL),(2,'Voter ID','1',0,0,'2020-10-09 05:02:15','2020-10-09 05:02:15',NULL),(3,'PAN ID','1',0,0,'2020-10-09 05:02:15','2020-10-09 05:02:15',NULL),(4,'Other Govt ID','1',0,0,'2020-10-09 05:02:15','2020-10-09 05:02:15',NULL);
/*!40000 ALTER TABLE `id_proof_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development`
--

DROP TABLE IF EXISTS `infrastructure_development`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposal_id` bigint(20) DEFAULT NULL,
  `year_id` bigint(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `commission` float NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL COMMENT '0=pending for approval,1=approved,2=revert,3=reject',
  `submission_status` tinyint(1) NOT NULL COMMENT '0=not completed,1=completed all steps',
  `proposed_amount` decimal(20,4) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_step3_complete` tinyint(1) NOT NULL DEFAULT 0,
  `is_step2_complete` tinyint(1) NOT NULL DEFAULT 0,
  `is_step1_complete` tinyint(1) NOT NULL DEFAULT 0,
  `consolidated_id` int(11) DEFAULT NULL,
  `reference_id` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `current_status` tinyint(4) DEFAULT NULL COMMENT '0=pending,1=approved,2=revert,3=reject ',
  `is_assigned_next_level` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `current_status_log_id` int(11) DEFAULT NULL,
  `current_scrutiny_level_id` int(11) DEFAULT NULL,
  `is_released` tinyint(1) NOT NULL DEFAULT 0,
  `released_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `assigned_date` datetime DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `approval_date` datetime DEFAULT NULL,
  `approved_by` bigint(20) DEFAULT 0,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `infrastructure_development_ref_id_unique` (`ref_id`),
  KEY `infrastructure_development_year_id_index` (`year_id`),
  KEY `infrastructure_development_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development`
--

LOCK TABLES `infrastructure_development` WRITE;
/*!40000 ALTER TABLE `infrastructure_development` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_actual_detail`
--

DROP TABLE IF EXISTS `infrastructure_development_actual_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_actual_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_acutal_fund` decimal(20,4) NOT NULL,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `commission_rate` double(15,4) NOT NULL DEFAULT 0.0000,
  `proposal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=pending,1=approved,2=reject ',
  `consolidated_id` int(11) DEFAULT NULL,
  `is_assigned_next_level` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `submission_status` int(11) NOT NULL DEFAULT 1,
  `current_status_log_id` int(11) DEFAULT NULL,
  `current_scrutiny_level_id` int(11) DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_actual_detail`
--

LOCK TABLES `infrastructure_development_actual_detail` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_actual_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_actual_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_actual_haat`
--

DROP TABLE IF EXISTS `infrastructure_development_actual_haat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_actual_haat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `actual_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `spacification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` decimal(15,4) NOT NULL,
  `cost` decimal(20,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_actual_haat`
--

LOCK TABLES `infrastructure_development_actual_haat` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_actual_haat` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_actual_haat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_actual_haat_fund`
--

DROP TABLE IF EXISTS `infrastructure_development_actual_haat_fund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_actual_haat_fund` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `actual_haat_id` bigint(20) NOT NULL,
  `haat_id` int(25) DEFAULT NULL,
  `actual_required_funds` double(20,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_actual_haat_fund`
--

LOCK TABLES `infrastructure_development_actual_haat_fund` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_actual_haat_fund` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_actual_haat_fund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_actual_warehouse`
--

DROP TABLE IF EXISTS `infrastructure_development_actual_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_actual_warehouse` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `actual_id` bigint(20) NOT NULL,
  `item_id` bigint(20) NOT NULL,
  `spacification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(20,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_actual_warehouse`
--

LOCK TABLES `infrastructure_development_actual_warehouse` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_actual_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_actual_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_actual_warehouse_fund`
--

DROP TABLE IF EXISTS `infrastructure_development_actual_warehouse_fund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_actual_warehouse_fund` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `actual_ware_id` bigint(20) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `actual_required_funds` double(20,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_actual_warehouse_fund`
--

LOCK TABLES `infrastructure_development_actual_warehouse_fund` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_actual_warehouse_fund` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_actual_warehouse_fund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_assessment`
--

DROP TABLE IF EXISTS `infrastructure_development_assessment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_assessment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` bigint(20) NOT NULL,
  `haat_id` bigint(20) NOT NULL,
  `haat_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_assessment`
--

LOCK TABLES `infrastructure_development_assessment` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_assessment` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_assessment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_consolidate`
--

DROP TABLE IF EXISTS `infrastructure_development_consolidate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_consolidate` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_consolidate`
--

LOCK TABLES `infrastructure_development_consolidate` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_consolidate` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_consolidate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_consolidation`
--

DROP TABLE IF EXISTS `infrastructure_development_consolidation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_consolidation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sanction_date` date DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `is_all_approved` tinyint(10) NOT NULL DEFAULT 0,
  `is_sanctioned` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not sanctioned,1=fully sanctioned,2=partially sanctioned',
  `approved_amount` double(20,4) NOT NULL DEFAULT 0.0000,
  `sanctioned_amount` double(20,4) NOT NULL DEFAULT 0.0000,
  `balance_amount` double(20,4) NOT NULL DEFAULT 0.0000,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_consolidation`
--

LOCK TABLES `infrastructure_development_consolidation` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_consolidation` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_consolidation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_fund_received_history`
--

DROP TABLE IF EXISTS `infrastructure_development_fund_received_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_fund_received_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` bigint(20) NOT NULL,
  `bank_name` bigint(20) NOT NULL,
  `release_percent` decimal(15,4) NOT NULL,
  `released_amount` decimal(20,4) NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_fund_received_history`
--

LOCK TABLES `infrastructure_development_fund_received_history` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_fund_received_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_fund_received_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_fund_releases`
--

DROP TABLE IF EXISTS `infrastructure_development_fund_releases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_fund_releases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `assigned_to` bigint(20) NOT NULL,
  `approved_amount` double(20,4) NOT NULL,
  `sanctioned_amount` double(20,4) NOT NULL,
  `max_can_release` double(20,4) NOT NULL DEFAULT 0.0000,
  `released_amount` double(20,4) NOT NULL,
  `balance_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `is_released` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_fund_releases`
--

LOCK TABLES `infrastructure_development_fund_releases` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_fund_releases` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_fund_releases` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `infrastructure_development_fund_released_set_is_released` BEFORE UPDATE ON `infrastructure_development_fund_releases` FOR EACH ROW IF new.max_can_release = new.released_amount THEN 
        SET new.is_released = 1, new.balance_amount=new.max_can_release-new.released_amount ;ELSEIF new.released_amount > 0 THEN SET new.is_released = 2,new.balance_amount=new.max_can_release-new.released_amount ; ELSE SET new.is_released = 0,new.balance_amount=new.max_can_release-new.released_amount ; END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `infrastructure_development_funds`
--

DROP TABLE IF EXISTS `infrastructure_development_funds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_funds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proposed_id` bigint(20) NOT NULL,
  `haat_id` int(11) DEFAULT NULL,
  `infra_id` int(11) DEFAULT NULL,
  `estimated_funds` double(20,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_funds`
--

LOCK TABLES `infrastructure_development_funds` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_funds` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_funds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_haat_bazaar`
--

DROP TABLE IF EXISTS `infrastructure_development_haat_bazaar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_haat_bazaar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` bigint(20) NOT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `block_id` bigint(20) DEFAULT NULL,
  `operation_day` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_of_operation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement_fund_summary` double(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_haat_bazaar`
--

LOCK TABLES `infrastructure_development_haat_bazaar` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_haat_bazaar` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_haat_bazaar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_haat_blocks`
--

DROP TABLE IF EXISTS `infrastructure_development_haat_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_haat_blocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `haat_bazaar_id` bigint(20) NOT NULL,
  `haat_id` bigint(20) NOT NULL,
  `block_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_haat_blocks`
--

LOCK TABLES `infrastructure_development_haat_blocks` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_haat_blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_haat_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_mfp`
--

DROP TABLE IF EXISTS `infrastructure_development_mfp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_mfp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `haat_bazaar_id` bigint(20) NOT NULL,
  `haat_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_mfp`
--

LOCK TABLES `infrastructure_development_mfp` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_mfp` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_mfp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_proposed_plan`
--

DROP TABLE IF EXISTS `infrastructure_development_proposed_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_proposed_plan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` bigint(20) NOT NULL,
  `proposed_plan` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_proposed_plan`
--

LOCK TABLES `infrastructure_development_proposed_plan` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_proposed_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_proposed_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_sanction`
--

DROP TABLE IF EXISTS `infrastructure_development_sanction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_sanction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `assigned_to` bigint(20) NOT NULL,
  `approved_amount` double(20,4) NOT NULL,
  `sanctioned_amount` double(20,4) NOT NULL,
  `balance_amount` double(20,4) NOT NULL,
  `is_state_share` tinyint(4) NOT NULL,
  `transaction_id` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `maximum_sanction_percent` double(20,4) NOT NULL,
  `is_sanctioned` tinyint(4) NOT NULL COMMENT '0=pending,1=fully sanctioned,2=partially sanctioned',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_sanction`
--

LOCK TABLES `infrastructure_development_sanction` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_sanction` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_sanction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_sanction_letter`
--

DROP TABLE IF EXISTS `infrastructure_development_sanction_letter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_sanction_letter` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `is_state_share` tinyint(4) NOT NULL DEFAULT 0,
  `file_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanction_date` date NOT NULL,
  `sanctioned_amount` double(20,4) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `infrastructure_development_sanction_letter_transaction_id_unique` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_sanction_letter`
--

LOCK TABLES `infrastructure_development_sanction_letter` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_sanction_letter` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_sanction_letter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_scrutiny_level_history`
--

DROP TABLE IF EXISTS `infrastructure_development_scrutiny_level_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_scrutiny_level_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `sublevel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_scrutiny_level_history`
--

LOCK TABLES `infrastructure_development_scrutiny_level_history` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_scrutiny_level_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_scrutiny_level_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_status_log`
--

DROP TABLE IF EXISTS `infrastructure_development_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_status_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` int(11) NOT NULL,
  `consolidated_id` int(11) DEFAULT NULL,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_assigned_next_level` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_status_log`
--

LOCK TABLES `infrastructure_development_status_log` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_status_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_summary`
--

DROP TABLE IF EXISTS `infrastructure_development_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_summary` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` bigint(20) NOT NULL,
  `estimated_requirement_funds` double(20,4) DEFAULT NULL,
  `other_information` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_warehouse_facilities` double(20,4) DEFAULT NULL,
  `total_multipurpose_procurement` double(20,4) DEFAULT NULL,
  `old_fund_available` double(20,4) DEFAULT NULL,
  `total_fund_require` double(20,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_summary`
--

LOCK TABLES `infrastructure_development_summary` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_summary` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_warehouse`
--

DROP TABLE IF EXISTS `infrastructure_development_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_warehouse` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` bigint(20) NOT NULL,
  `warehouse` bigint(20) DEFAULT NULL,
  `block` bigint(20) DEFAULT NULL,
  `mfp_name` bigint(20) DEFAULT NULL,
  `storage_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage_capacity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_fund` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_warehouse`
--

LOCK TABLES `infrastructure_development_warehouse` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_warehouse_blocks`
--

DROP TABLE IF EXISTS `infrastructure_development_warehouse_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_warehouse_blocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_row_id` bigint(20) NOT NULL,
  `block_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_warehouse_blocks`
--

LOCK TABLES `infrastructure_development_warehouse_blocks` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_warehouse_blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_warehouse_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_development_warehouse_mfp`
--

DROP TABLE IF EXISTS `infrastructure_development_warehouse_mfp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_development_warehouse_mfp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_row_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_development_warehouse_mfp`
--

LOCK TABLES `infrastructure_development_warehouse_mfp` WRITE;
/*!40000 ALTER TABLE `infrastructure_development_warehouse_mfp` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_development_warehouse_mfp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_fund_released`
--

DROP TABLE IF EXISTS `infrastructure_fund_released`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_fund_released` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `assigned_to` bigint(20) NOT NULL,
  `approved_amount` double(20,4) NOT NULL,
  `sanctioned_amount` double(20,4) NOT NULL,
  `max_can_release` double(20,4) NOT NULL DEFAULT 0.0000,
  `released_amount` double(20,4) NOT NULL,
  `balance_amount` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `is_released` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_fund_released`
--

LOCK TABLES `infrastructure_fund_released` WRITE;
/*!40000 ALTER TABLE `infrastructure_fund_released` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_fund_released` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_fund_released_history`
--

DROP TABLE IF EXISTS `infrastructure_fund_released_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_fund_released_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `bank_name` bigint(20) NOT NULL,
  `release_percent` double(20,4) NOT NULL,
  `release_amount` double(20,4) NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `commission_rate` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_fund_released_history`
--

LOCK TABLES `infrastructure_fund_released_history` WRITE;
/*!40000 ALTER TABLE `infrastructure_fund_released_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_fund_released_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastructure_transaction_scrutiny_level_history`
--

DROP TABLE IF EXISTS `infrastructure_transaction_scrutiny_level_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastructure_transaction_scrutiny_level_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `infra_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `sublevel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastructure_transaction_scrutiny_level_history`
--

LOCK TABLES `infrastructure_transaction_scrutiny_level_history` WRITE;
/*!40000 ALTER TABLE `infrastructure_transaction_scrutiny_level_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastructure_transaction_scrutiny_level_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastruture_consolidation_transaction`
--

DROP TABLE IF EXISTS `infrastruture_consolidation_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastruture_consolidation_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastruture_consolidation_transaction`
--

LOCK TABLES `infrastruture_consolidation_transaction` WRITE;
/*!40000 ALTER TABLE `infrastruture_consolidation_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastruture_consolidation_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `infrastruture_transaction_logs`
--

DROP TABLE IF EXISTS `infrastruture_transaction_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `infrastruture_transaction_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `actual_infra_id` int(11) NOT NULL,
  `consolidated_id` int(11) DEFAULT NULL,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_assigned_next_level` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `infrastruture_transaction_logs`
--

LOCK TABLES `infrastruture_transaction_logs` WRITE;
/*!40000 ALTER TABLE `infrastruture_transaction_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `infrastruture_transaction_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `levels_master`
--

DROP TABLE IF EXISTS `levels_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels_master` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `levels_master_created_by_index` (`created_by`),
  KEY `levels_master_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels_master`
--

LOCK TABLES `levels_master` WRITE;
/*!40000 ALTER TABLE `levels_master` DISABLE KEYS */;
INSERT INTO `levels_master` VALUES (1,'Level1','Level1','Level1','1',1,1,NULL,'2020-10-11 23:45:25','2020-10-11 23:45:25'),(2,'Level2','Level2','Level2','1',1,1,NULL,'2020-10-11 23:45:45','2020-10-11 23:45:45'),(3,'Level3','Level3','Level3','1',1,1,NULL,'2020-10-11 23:45:57','2020-10-11 23:45:57'),(4,'Level4','Level4','Level4','1',1,1,NULL,'2020-10-11 23:46:13','2020-10-11 23:46:13'),(5,'Level5','Level5','Level5','1',1,1,NULL,'2020-10-11 23:46:27','2020-10-11 23:46:27'),(6,'Level6','Level6','Level6','1',1,1,NULL,'2020-10-11 23:46:38','2020-10-11 23:46:38'),(7,'Level7','Level7','Level7','1',1,1,NULL,'2020-10-11 23:47:30','2020-10-11 23:47:30');
/*!40000 ALTER TABLE `levels_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_coverage`
--

DROP TABLE IF EXISTS `mfp_coverage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_coverage` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `district_id` bigint(20) DEFAULT NULL,
  `previous_year_estimated_qty` double(20,4) DEFAULT NULL,
  `previous_year_estimated_value` double(20,4) DEFAULT NULL,
  `previous_year_actual_qty` double(20,4) DEFAULT NULL,
  `previous_year_actual_estimated_qty` double(20,4) DEFAULT NULL,
  `current_year_estimated_qty` double(20,4) DEFAULT NULL,
  `current_year_estimated_value` double(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_coverage`
--

LOCK TABLES `mfp_coverage` WRITE;
/*!40000 ALTER TABLE `mfp_coverage` DISABLE KEYS */;
INSERT INTO `mfp_coverage` VALUES (1,1,1,414,5.0000,5.0000,5.0000,5.0000,5.0000,5.0000,'0',2,2,'2021-06-09 23:18:40','2021-06-09 23:45:37',NULL);
/*!40000 ALTER TABLE `mfp_coverage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_coverage_haat_block`
--

DROP TABLE IF EXISTS `mfp_coverage_haat_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_coverage_haat_block` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_coverage_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `block_id` bigint(20) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_coverage_haat_block`
--

LOCK TABLES `mfp_coverage_haat_block` WRITE;
/*!40000 ALTER TABLE `mfp_coverage_haat_block` DISABLE KEYS */;
INSERT INTO `mfp_coverage_haat_block` VALUES (1,1,1,1,3849,'0',2,2,'2021-06-09 23:18:40','2021-06-09 23:18:40',NULL);
/*!40000 ALTER TABLE `mfp_coverage_haat_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_master`
--

DROP TABLE IF EXISTS `mfp_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) NOT NULL,
  `botanical_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msp_price` decimal(15,4) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mfp_master_state_id_index` (`state_id`),
  KEY `mfp_master_mfp_id_index` (`mfp_id`),
  KEY `mfp_master_created_by_index` (`created_by`),
  KEY `mfp_master_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_master`
--

LOCK TABLES `mfp_master` WRITE;
/*!40000 ALTER TABLE `mfp_master` DISABLE KEYS */;
INSERT INTO `mfp_master` VALUES (1,23,30,'banana','banana',50.0000,'','1',1,1,'2021-06-09 23:17:10','2021-06-09 23:17:10',NULL);
/*!40000 ALTER TABLE `mfp_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_price_history`
--

DROP TABLE IF EXISTS `mfp_price_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_price_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) NOT NULL,
  `botanical_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msp_price` double(17,4) NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mfp_price_history_state_id_index` (`state_id`),
  KEY `mfp_price_history_mfp_id_index` (`mfp_id`),
  KEY `mfp_price_history_created_by_index` (`created_by`),
  KEY `mfp_price_history_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_price_history`
--

LOCK TABLES `mfp_price_history` WRITE;
/*!40000 ALTER TABLE `mfp_price_history` DISABLE KEYS */;
INSERT INTO `mfp_price_history` VALUES (1,1,23,30,'banana','banana',50.0000,'','1',1,1,'2021-06-09 23:17:10','2021-06-09 23:17:10',NULL);
/*!40000 ALTER TABLE `mfp_price_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement`
--

DROP TABLE IF EXISTS `mfp_procurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_id` bigint(20) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `commission` float DEFAULT 0,
  `status` tinyint(1) NOT NULL COMMENT '0=pending for approval,1=approved,2=revert,3=reject',
  `submission_status` tinyint(1) NOT NULL COMMENT '0=not completed,1=completed all steps',
  `proposed_amount` int(11) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_step3_complete` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_step2_complete` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_step1_complete` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `consolidated_id` int(11) DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `assigned_date` datetime DEFAULT NULL,
  `current_status` tinyint(4) DEFAULT NULL COMMENT '0=pending,1=approved,2=revert,3=reject',
  `is_assigned_next_level` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `current_status_log_id` int(11) DEFAULT NULL,
  `current_scrutiny_level_id` int(11) DEFAULT NULL,
  `is_released` tinyint(1) NOT NULL DEFAULT 0,
  `released_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `has_released_to_procurement_agent` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not released,1=fully released,2=partially released',
  `released_amount_procurement_agent` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `actual_tribal_amount_paid` decimal(20,4) NOT NULL,
  `total_mfp_storage_value` decimal(20,4) NOT NULL,
  `total_overhead_paid_value` decimal(20,4) NOT NULL,
  `approval_date` datetime DEFAULT NULL,
  `approved_by` bigint(20) DEFAULT 0,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mfp_procurement_ref_id_unique` (`ref_id`),
  KEY `mfp_procurement_year_id_index` (`year_id`),
  KEY `mfp_procurement_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement`
--

LOCK TABLES `mfp_procurement` WRITE;
/*!40000 ALTER TABLE `mfp_procurement` DISABLE KEYS */;
INSERT INTO `mfp_procurement` VALUES (1,'045e607b-6a2e-4a8a-b3ab-2e15a33755dc','23000001',4,2,10,1,1,NULL,'','0','1','0','1',1,'',8,9,'2021-06-11 06:40:18',1,'0',1,145,1,654.5387,2,500.0000,50.0000,0.0000,0.0000,0.0000,'2021-06-11 06:41:31',9,2,2,'2021-06-09 23:18:40','2021-06-11 02:31:44','2021-06-11 06:31:57',NULL);
/*!40000 ALTER TABLE `mfp_procurement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_actual_detail`
--

DROP TABLE IF EXISTS `mfp_procurement_actual_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_actual_detail` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` bigint(20) NOT NULL,
  `id_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shg_id` bigint(20) NOT NULL,
  `name_of_tribal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_ifsc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `procurement_date` date NOT NULL,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `consolidated_id` int(11) NOT NULL DEFAULT 0,
  `amount_paid` decimal(20,4) NOT NULL,
  `amount_payable` decimal(20,4) NOT NULL,
  `has_receipt_generated` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=not generated,1=generated,2=partially generated',
  `is_procurement_details_submitted` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_overhead_details_submitted` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT 0,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_actual_detail`
--

LOCK TABLES `mfp_procurement_actual_detail` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_actual_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_actual_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_actual_detail_commodity`
--

DROP TABLE IF EXISTS `mfp_procurement_actual_detail_commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_actual_detail_commodity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `action_detail_id` bigint(20) NOT NULL,
  `mfp_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` decimal(15,4) NOT NULL,
  `value` decimal(20,4) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_actual_detail_commodity`
--

LOCK TABLES `mfp_procurement_actual_detail_commodity` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_actual_detail_commodity` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_actual_detail_commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_actual_mfp_storage`
--

DROP TABLE IF EXISTS `mfp_procurement_actual_mfp_storage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_actual_mfp_storage` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tribal_consolidated_id` int(11) NOT NULL,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `year_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) NOT NULL,
  `mfp_qty` decimal(15,4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_actual_mfp_storage`
--

LOCK TABLES `mfp_procurement_actual_mfp_storage` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_actual_mfp_storage` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_actual_mfp_storage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_actual_mfp_storage_other`
--

DROP TABLE IF EXISTS `mfp_procurement_actual_mfp_storage_other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_actual_mfp_storage_other` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_action_detail_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `haat_id` bigint(20) NOT NULL,
  `qty` decimal(15,4) NOT NULL,
  `value` decimal(20,4) NOT NULL,
  `mfp_procurement_id` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_uploaded` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `uploaded_on` datetime DEFAULT NULL,
  `uploaded_by` bigint(20) NOT NULL,
  `receipt_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_actual_mfp_storage_other`
--

LOCK TABLES `mfp_procurement_actual_mfp_storage_other` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_actual_mfp_storage_other` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_actual_mfp_storage_other` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_collection_level`
--

DROP TABLE IF EXISTS `mfp_procurement_collection_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_collection_level` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `qty` double(17,4) DEFAULT NULL,
  `warehouse` bigint(20) DEFAULT NULL,
  `capacity` double(17,4) DEFAULT NULL,
  `procurement_center` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packing_material_type` bigint(20) DEFAULT NULL,
  `standard_packing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` bigint(20) DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_packing_bags` bigint(20) DEFAULT NULL,
  `unit_cost` decimal(20,4) DEFAULT NULL,
  `total_cost_of_packaging_material` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_collection_level`
--

LOCK TABLES `mfp_procurement_collection_level` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_collection_level` DISABLE KEYS */;
INSERT INTO `mfp_procurement_collection_level` VALUES (1,1,1,5.0000,1,5.0000,'5',1,'5',1,'L',5,1.0000,5.0000,2,2,'2021-06-09 23:21:36','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,5.0000,1,5.0000,'5',1,'5',1,'L',5,1.0000,5.0000,2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_collection_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_collection_level_haat`
--

DROP TABLE IF EXISTS `mfp_procurement_collection_level_haat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_collection_level_haat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `collection_level_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_collection_level_haat`
--

LOCK TABLES `mfp_procurement_collection_level_haat` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_collection_level_haat` DISABLE KEYS */;
INSERT INTO `mfp_procurement_collection_level_haat` VALUES (2,1,2,1,2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38');
/*!40000 ALTER TABLE `mfp_procurement_collection_level_haat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_commodity`
--

DROP TABLE IF EXISTS `mfp_procurement_commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_commodity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `procurement_id` int(11) DEFAULT NULL,
  `mfp_seasonality_id` bigint(20) DEFAULT NULL,
  `commodity_id` bigint(20) DEFAULT NULL,
  `haat` bigint(20) DEFAULT NULL,
  `blocks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastqty` double(17,4) DEFAULT NULL,
  `lastval` double(20,4) DEFAULT NULL,
  `currentqty` double(17,4) DEFAULT NULL,
  `currentval` double(20,4) DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_commodity`
--

LOCK TABLES `mfp_procurement_commodity` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_commodity` DISABLE KEYS */;
INSERT INTO `mfp_procurement_commodity` VALUES (1,1,1,NULL,1,1,'3849',5.0000,50.0000,5.0000,250000.0000,2,2,'2021-06-09 23:20:30','2021-06-09 23:20:30',NULL);
/*!40000 ALTER TABLE `mfp_procurement_commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_commodity_history`
--

DROP TABLE IF EXISTS `mfp_procurement_commodity_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_commodity_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `procurement_id` int(11) DEFAULT NULL,
  `mfp_seasonality_id` bigint(20) DEFAULT NULL,
  `year_id` bigint(20) DEFAULT NULL,
  `commodity_id` bigint(20) DEFAULT NULL,
  `haat` bigint(20) DEFAULT NULL,
  `blocks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` decimal(17,4) DEFAULT NULL,
  `val` decimal(20,4) DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_commodity_history`
--

LOCK TABLES `mfp_procurement_commodity_history` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_commodity_history` DISABLE KEYS */;
INSERT INTO `mfp_procurement_commodity_history` VALUES (1,1,NULL,1,3,1,1,'3849',5.0000,50.0000,2,2,'2021-06-09 23:20:30','2021-06-09 23:20:30',NULL);
/*!40000 ALTER TABLE `mfp_procurement_commodity_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_consolidate`
--

DROP TABLE IF EXISTS `mfp_procurement_consolidate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_consolidate` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_consolidate`
--

LOCK TABLES `mfp_procurement_consolidate` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_consolidate` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_consolidate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_consolidated_transaction`
--

DROP TABLE IF EXISTS `mfp_procurement_consolidated_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_consolidated_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` int(11) NOT NULL,
  `year_id` smallint(4) NOT NULL,
  `current_status` tinyint(4) DEFAULT NULL,
  `remarks` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_to` bigint(15) NOT NULL,
  `assigned_by` bigint(15) NOT NULL,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `commission_rate` double(15,4) NOT NULL DEFAULT 0.0000,
  `remaining_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_consolidated_transaction`
--

LOCK TABLES `mfp_procurement_consolidated_transaction` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_consolidated_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_consolidated_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_consolidated_tribal_transaction`
--

DROP TABLE IF EXISTS `mfp_procurement_consolidated_tribal_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_consolidated_tribal_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_consolidated_tribal_transaction`
--

LOCK TABLES `mfp_procurement_consolidated_tribal_transaction` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_consolidated_tribal_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_consolidated_tribal_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_consolidation`
--

DROP TABLE IF EXISTS `mfp_procurement_consolidation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_consolidation` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `is_all_approved` tinyint(4) NOT NULL DEFAULT 0,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sanction_date` date DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `is_sanctioned` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=not sanctioned,1=fully sanctioned,2=partially sanctioned',
  `approved_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `sanctioned_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `balance_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_consolidation`
--

LOCK TABLES `mfp_procurement_consolidation` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_consolidation` DISABLE KEYS */;
INSERT INTO `mfp_procurement_consolidation` VALUES (1,'23_1',23,4,1,'1','x345','2021-06-11',NULL,NULL,0,275595.2450,275595.2450,0.0000,5,5,'2021-06-11 01:08:13','2021-06-11 01:28:54');
/*!40000 ALTER TABLE `mfp_procurement_consolidation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_cost_of_packing_material`
--

DROP TABLE IF EXISTS `mfp_procurement_cost_of_packing_material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_cost_of_packing_material` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `corresponding_procument_center` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packing_material_type` bigint(20) DEFAULT NULL,
  `bag_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specifications` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `standard_packing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `total_packing_bags` int(11) DEFAULT NULL,
  `unit_cost` decimal(20,4) DEFAULT NULL,
  `total_cost_of_packing_material` decimal(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_cost_of_packing_material`
--

LOCK TABLES `mfp_procurement_cost_of_packing_material` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_cost_of_packing_material` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_cost_of_packing_material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_dia_release`
--

DROP TABLE IF EXISTS `mfp_procurement_dia_release`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_dia_release` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `procurement_agent` bigint(20) NOT NULL,
  `total_mfp` int(11) NOT NULL,
  `total_quantity` decimal(20,4) DEFAULT NULL,
  `total_value` decimal(20,4) NOT NULL,
  `total_released_to_procurement_agent` decimal(20,4) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_dia_release`
--

LOCK TABLES `mfp_procurement_dia_release` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_dia_release` DISABLE KEYS */;
INSERT INTO `mfp_procurement_dia_release` VALUES (1,1,10,1,5.0000,250000.0000,450.0000,2,'2021-06-11 02:31:43','2021-06-11 02:31:43');
/*!40000 ALTER TABLE `mfp_procurement_dia_release` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_dia_release_bank`
--

DROP TABLE IF EXISTS `mfp_procurement_dia_release_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_dia_release_bank` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_dia_release_id` bigint(20) NOT NULL,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `procurement_agent` bigint(20) NOT NULL,
  `bank_id` bigint(20) NOT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `release_amount` decimal(20,4) NOT NULL,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `commission_rate` double(15,4) NOT NULL DEFAULT 0.0000,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_dia_release_bank`
--

LOCK TABLES `mfp_procurement_dia_release_bank` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_dia_release_bank` DISABLE KEYS */;
INSERT INTO `mfp_procurement_dia_release_bank` VALUES (1,1,1,10,1,'55555','2021-06-11',450.0000,50.0000,10.0000,2,'2021-06-11 02:31:43','2021-06-11 02:31:43');
/*!40000 ALTER TABLE `mfp_procurement_dia_release_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_dia_release_commodity`
--

DROP TABLE IF EXISTS `mfp_procurement_dia_release_commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_dia_release_commodity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_dia_release_id` bigint(20) NOT NULL,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `procurement_agent` bigint(20) NOT NULL,
  `mfp_id` int(11) NOT NULL,
  `qty` decimal(15,4) NOT NULL,
  `value` decimal(20,4) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_dia_release_commodity`
--

LOCK TABLES `mfp_procurement_dia_release_commodity` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_dia_release_commodity` DISABLE KEYS */;
INSERT INTO `mfp_procurement_dia_release_commodity` VALUES (1,1,1,10,1,5.0000,250000.0000,2,'2021-06-11 02:31:54','2021-06-11 02:31:54');
/*!40000 ALTER TABLE `mfp_procurement_dia_release_commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_dia_release_summary`
--

DROP TABLE IF EXISTS `mfp_procurement_dia_release_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_dia_release_summary` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `procurement_agent` bigint(20) NOT NULL,
  `total_mfp` int(11) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_value` decimal(20,4) NOT NULL,
  `total_released_to_procurement_agent` decimal(20,4) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_dia_release_summary`
--

LOCK TABLES `mfp_procurement_dia_release_summary` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_dia_release_summary` DISABLE KEYS */;
INSERT INTO `mfp_procurement_dia_release_summary` VALUES (1,'eafe7e07-5dc1-42f5-bced-a90c856978e0',1,10,1,5,250000.0000,450.0000,2,'2021-06-11 02:31:43','2021-06-11 02:31:54');
/*!40000 ALTER TABLE `mfp_procurement_dia_release_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_disposal`
--

DROP TABLE IF EXISTS `mfp_procurement_disposal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_disposal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_disposal`
--

LOCK TABLES `mfp_procurement_disposal` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_disposal` DISABLE KEYS */;
INSERT INTO `mfp_procurement_disposal` VALUES (1,1,1,2,2,'2021-06-09 23:21:36','2021-06-09 23:45:37','2021-06-09 23:45:37'),(2,1,1,2,2,'2021-06-09 23:45:37','2021-06-09 23:45:37',NULL);
/*!40000 ALTER TABLE `mfp_procurement_disposal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_disposal_warehouse`
--

DROP TABLE IF EXISTS `mfp_procurement_disposal_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_disposal_warehouse` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_procurement_disposal_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `qty` decimal(15,4) DEFAULT NULL,
  `value` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_disposal_warehouse`
--

LOCK TABLES `mfp_procurement_disposal_warehouse` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_disposal_warehouse` DISABLE KEYS */;
INSERT INTO `mfp_procurement_disposal_warehouse` VALUES (1,1,1,1,5.0000,5.0000,2,2,'2021-06-09 23:21:36','2021-06-09 23:45:37','2021-06-09 23:45:37'),(2,1,2,1,5.0000,5.0000,2,2,'2021-06-09 23:45:37','2021-06-09 23:45:37',NULL);
/*!40000 ALTER TABLE `mfp_procurement_disposal_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_disposal_warehouse_months`
--

DROP TABLE IF EXISTS `mfp_procurement_disposal_warehouse_months`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_disposal_warehouse_months` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_procurement_disposal_id` bigint(20) DEFAULT NULL,
  `mfp_procurement_disposal_warehouse_id` bigint(20) DEFAULT NULL,
  `month` bigint(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_disposal_warehouse_months`
--

LOCK TABLES `mfp_procurement_disposal_warehouse_months` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_disposal_warehouse_months` DISABLE KEYS */;
INSERT INTO `mfp_procurement_disposal_warehouse_months` VALUES (1,1,1,1,2,2,2,'2021-06-09 23:21:36','2021-06-09 23:45:37','2021-06-09 23:45:37'),(2,1,2,2,2,2,2,'2021-06-09 23:45:37','2021-06-09 23:45:37',NULL);
/*!40000 ALTER TABLE `mfp_procurement_disposal_warehouse_months` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_estimated_losses_history`
--

DROP TABLE IF EXISTS `mfp_procurement_estimated_losses_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_estimated_losses_history` (
  `mfp_procurement_id` bigint(20) NOT NULL DEFAULT 0,
  `mfp_id` bigint(20) DEFAULT NULL,
  `year_id` bigint(20) DEFAULT NULL,
  `qty` decimal(15,4) DEFAULT NULL,
  `value` decimal(20,4) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_estimated_losses_history`
--

LOCK TABLES `mfp_procurement_estimated_losses_history` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_estimated_losses_history` DISABLE KEYS */;
INSERT INTO `mfp_procurement_estimated_losses_history` VALUES (1,1,4,5.0000,5.0000,2,2,'2021-06-09 23:45:37','2021-06-09 23:45:37'),(1,1,3,5.0000,5.0000,2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38');
/*!40000 ALTER TABLE `mfp_procurement_estimated_losses_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_estimated_wastages`
--

DROP TABLE IF EXISTS `mfp_procurement_estimated_wastages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_estimated_wastages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `procurement_quantity` decimal(15,4) DEFAULT NULL,
  `procurement_value` decimal(20,4) DEFAULT NULL,
  `estimated_driage_percentage` decimal(15,4) DEFAULT NULL,
  `estimated_driage_rs` decimal(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_estimated_wastages`
--

LOCK TABLES `mfp_procurement_estimated_wastages` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_estimated_wastages` DISABLE KEYS */;
INSERT INTO `mfp_procurement_estimated_wastages` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,'1',2,2,'2021-06-09 23:21:37','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,1,5.0000,2.5000,5.0000,0.1200,'0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_estimated_wastages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_fund_received_history`
--

DROP TABLE IF EXISTS `mfp_procurement_fund_received_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_fund_received_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `released_amount` decimal(20,4) NOT NULL,
  `bank_name` int(11) NOT NULL,
  `release_percent` decimal(15,4) NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_fund_received_history`
--

LOCK TABLES `mfp_procurement_fund_received_history` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_fund_received_history` DISABLE KEYS */;
INSERT INTO `mfp_procurement_fund_received_history` VALUES (1,1,654.5387,1,5.0000,'54634','2021-06-11',6,'2021-06-11 02:14:58','2021-06-11 02:14:58');
/*!40000 ALTER TABLE `mfp_procurement_fund_received_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_fund_released`
--

DROP TABLE IF EXISTS `mfp_procurement_fund_released`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_fund_released` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `assigned_to` bigint(20) NOT NULL,
  `approved_amount` decimal(20,4) NOT NULL,
  `sanctioned_amount` decimal(20,4) NOT NULL,
  `max_can_release` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `released_amount` decimal(20,4) NOT NULL,
  `balance_amount` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `is_released` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_fund_released`
--

LOCK TABLES `mfp_procurement_fund_released` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_fund_released` DISABLE KEYS */;
INSERT INTO `mfp_procurement_fund_released` VALUES (1,1,8,275595.2450,275595.2450,275595.2450,13779.7623,261815.4827,0.0000,2,0,0,NULL,'2021-06-11 02:11:05'),(2,1,6,275595.2450,275595.2450,13779.7623,654.5387,13090.7742,34.4494,2,0,0,NULL,'2021-06-11 02:14:58');
/*!40000 ALTER TABLE `mfp_procurement_fund_released` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_fund_released_history`
--

DROP TABLE IF EXISTS `mfp_procurement_fund_released_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_fund_released_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `release_id` bigint(20) NOT NULL,
  `consolidated_id` bigint(20) NOT NULL,
  `bank_name` bigint(20) NOT NULL,
  `release_percent` decimal(15,4) NOT NULL,
  `release_amount` decimal(20,4) NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `commission_rate` decimal(15,4) NOT NULL DEFAULT 0.0000,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_fund_released_history`
--

LOCK TABLES `mfp_procurement_fund_released_history` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_fund_released_history` DISABLE KEYS */;
INSERT INTO `mfp_procurement_fund_released_history` VALUES (2,1,1,1,5.0000,13779.7623,'456654','2021-06-11',0.0000,0.0000,8,'2021-06-11 02:11:05','2021-06-11 02:11:05'),(3,2,1,1,5.0000,654.5387,'54634','2021-06-11',34.4494,5.0000,6,'2021-06-11 02:14:58','2021-06-11 02:14:58');
/*!40000 ALTER TABLE `mfp_procurement_fund_released_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_fund_transactions`
--

DROP TABLE IF EXISTS `mfp_procurement_fund_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_fund_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `particulars` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debit` double(20,4) NOT NULL,
  `credit` double(20,4) NOT NULL,
  `balance` double(20,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_fund_transactions`
--

LOCK TABLES `mfp_procurement_fund_transactions` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_fund_transactions` DISABLE KEYS */;
INSERT INTO `mfp_procurement_fund_transactions` VALUES (1,8,'Fund released to account number 456654 and commission received Rs.0 by rate 0 % ',13779.7623,0.0000,0.0000,'2021-06-11 02:11:05','2021-06-11 02:11:05'),(2,8,'Fund received  ',0.0000,13779.7623,0.0000,'2021-06-11 02:11:05','2021-06-11 02:11:05'),(3,6,'Fund released to account number 54634 and commission received Rs.34.4494 by rate 5.0000 % ',654.5387,34.4494,0.0000,'2021-06-11 02:14:58','2021-06-11 02:14:58'),(4,2,'Fund received  for proposal id23000001',0.0000,654.5387,0.0000,'2021-06-11 02:14:58','2021-06-11 02:14:58'),(6,2,'Fund released to procurement agent for proposal id 23000001 and commission received 10.0000%',450.0000,50.0000,0.0000,'2021-06-11 02:31:43','2021-06-11 02:31:43'),(7,10,'Fund released proposal id 23000001',0.0000,450.0000,0.0000,'2021-06-11 02:31:43','2021-06-11 02:31:43');
/*!40000 ALTER TABLE `mfp_procurement_fund_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_generate_receipt`
--

DROP TABLE IF EXISTS `mfp_procurement_generate_receipt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_generate_receipt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_detail_id` bigint(20) NOT NULL,
  `receipt_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dated` date NOT NULL,
  `shg_id` bigint(20) NOT NULL,
  `name_of_tribal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_of_rupees` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(20,4) NOT NULL,
  `rest_amount` decimal(20,4) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mfp_procurement_generate_receipt_receipt_id_unique` (`receipt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_generate_receipt`
--

LOCK TABLES `mfp_procurement_generate_receipt` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_generate_receipt` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_generate_receipt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_labour_charges`
--

DROP TABLE IF EXISTS `mfp_procurement_labour_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_labour_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `unit_manday_rate` int(11) DEFAULT NULL,
  `estimated_mandays` double(20,4) DEFAULT NULL,
  `total_estimated_cost` double(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_labour_charges`
--

LOCK TABLES `mfp_procurement_labour_charges` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_labour_charges` DISABLE KEYS */;
INSERT INTO `mfp_procurement_labour_charges` VALUES (1,1,1,1,5,5.0000,25.0000,'1',2,2,'2021-06-09 23:21:36','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,1,5,5.0000,25.0000,'0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_labour_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_nodal`
--

DROP TABLE IF EXISTS `mfp_procurement_nodal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_nodal` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp` bigint(20) NOT NULL,
  `year` int(11) NOT NULL,
  `procurement_qty` decimal(15,4) NOT NULL,
  `procurement_value` decimal(15,4) NOT NULL,
  `disposal_qty` decimal(15,4) NOT NULL,
  `disposal_value` decimal(15,4) NOT NULL,
  `losses_qty` decimal(15,4) NOT NULL,
  `losses_value` decimal(15,4) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_nodal`
--

LOCK TABLES `mfp_procurement_nodal` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_nodal` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_nodal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_other_costs`
--

DROP TABLE IF EXISTS `mfp_procurement_other_costs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_other_costs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `other_costs` decimal(20,4) DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_other_costs`
--

LOCK TABLES `mfp_procurement_other_costs` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_other_costs` DISABLE KEYS */;
INSERT INTO `mfp_procurement_other_costs` VALUES (1,1,1,NULL,NULL,'1',2,2,'2021-06-09 23:21:37','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,5.0000,'test','0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_other_costs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_plan`
--

DROP TABLE IF EXISTS `mfp_procurement_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_plan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year_id` bigint(20) NOT NULL,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mfp_procurement_plan_year_id_index` (`year_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_plan`
--

LOCK TABLES `mfp_procurement_plan` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_plan` DISABLE KEYS */;
INSERT INTO `mfp_procurement_plan` VALUES (1,4,1,'0',2,2,'2021-06-09 23:20:30','2021-06-09 23:20:30',NULL);
/*!40000 ALTER TABLE `mfp_procurement_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_sanction`
--

DROP TABLE IF EXISTS `mfp_procurement_sanction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_sanction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `is_state_share` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=ministry,1=state',
  `assigned_to` bigint(20) NOT NULL,
  `approved_amount` decimal(20,4) NOT NULL,
  `sanctioned_amount` decimal(20,4) NOT NULL,
  `balance_amount` decimal(20,4) NOT NULL,
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `is_sanctioned` tinyint(1) NOT NULL COMMENT '0=pending,1=fully sanctioned,2=partially sanctioned',
  `maximum_sanction_percent` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_sanction`
--

LOCK TABLES `mfp_procurement_sanction` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_sanction` DISABLE KEYS */;
INSERT INTO `mfp_procurement_sanction` VALUES (1,1,0,9,275595.2450,206696.4338,0.0000,'dfghfd654','2021-06-11',1,75,'2021-06-11 01:11:31','2021-06-11 01:16:57'),(2,1,1,8,275595.2450,68898.8112,0.0001,'cvbe','2021-06-11',2,25,NULL,'2021-06-11 01:28:54');
/*!40000 ALTER TABLE `mfp_procurement_sanction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_sanction_letter`
--

DROP TABLE IF EXISTS `mfp_procurement_sanction_letter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_sanction_letter` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `consolidated_id` bigint(20) NOT NULL,
  `is_state_share` tinyint(4) NOT NULL DEFAULT 0,
  `file_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanction_date` date NOT NULL,
  `sanctioned_amount` double(20,4) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_sanction_letter`
--

LOCK TABLES `mfp_procurement_sanction_letter` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_sanction_letter` DISABLE KEYS */;
INSERT INTO `mfp_procurement_sanction_letter` VALUES (1,1,0,'x345','2021-06-11',206696.4337,'dfg543','2021-06-11',9,9,'2021-06-11 01:12:36','2021-06-11 01:12:36'),(2,1,0,'x345','2021-06-11',0.0001,'dfghfd654','2021-06-11',9,9,'2021-06-11 01:16:57','2021-06-11 01:16:57'),(3,1,0,'x345','0000-00-00',68898.8112,'cvbe','2021-06-11',8,8,'2021-06-11 01:28:54','2021-06-11 01:28:54');
/*!40000 ALTER TABLE `mfp_procurement_sanction_letter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_service_charges`
--

DROP TABLE IF EXISTS `mfp_procurement_service_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_service_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `qty_of_mfp` decimal(17,4) DEFAULT NULL,
  `primary_level_agency` int(11) DEFAULT NULL,
  `estimated_value_of_mfp_procurement` decimal(20,4) DEFAULT NULL,
  `estimated_service_charge_primary_level_agency` decimal(20,4) DEFAULT NULL,
  `service_charge_in_total_value_of_procurement` decimal(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_service_charges`
--

LOCK TABLES `mfp_procurement_service_charges` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_service_charges` DISABLE KEYS */;
INSERT INTO `mfp_procurement_service_charges` VALUES (1,1,1,NULL,NULL,250000.0000,NULL,NULL,'1',2,2,'2021-06-09 23:21:37','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,5.0000,1,250000.0000,12500.0000,5.0000,'0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_service_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_service_charges_at_dia`
--

DROP TABLE IF EXISTS `mfp_procurement_service_charges_at_dia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_service_charges_at_dia` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `dia_id` bigint(20) DEFAULT NULL,
  `estimated_value_of_procurement` decimal(20,4) DEFAULT NULL,
  `service_charges_percentage` decimal(20,4) DEFAULT NULL,
  `service_charge_value` decimal(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_service_charges_at_dia`
--

LOCK TABLES `mfp_procurement_service_charges_at_dia` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_service_charges_at_dia` DISABLE KEYS */;
INSERT INTO `mfp_procurement_service_charges_at_dia` VALUES (1,1,1,414,2.5000,NULL,NULL,'1',2,2,'2021-06-09 23:21:37','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,414,2.5000,5.0000,0.1250,'0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_service_charges_at_dia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_status_log`
--

DROP TABLE IF EXISTS `mfp_procurement_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_status_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` int(11) NOT NULL,
  `consolidated_id` int(11) DEFAULT NULL,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_assigned_next_level` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_status_log`
--

LOCK TABLES `mfp_procurement_status_log` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_status_log` DISABLE KEYS */;
INSERT INTO `mfp_procurement_status_log` VALUES (1,1,NULL,NULL,2,3,1,'1','ok',2,3,'2021-06-11 01:01:57','2021-06-11 01:04:01'),(2,1,NULL,NULL,3,4,1,'1','ok',3,4,'2021-06-11 01:04:01','2021-06-11 01:05:10'),(3,1,NULL,NULL,4,13,1,'1','ok',4,13,'2021-06-11 01:05:10','2021-06-11 01:06:37'),(4,1,1,NULL,13,5,1,'1','ok',13,5,'2021-06-11 01:06:37','2021-06-11 01:08:13'),(5,1,1,NULL,5,6,1,'1','ok',5,6,'2021-06-11 01:08:13','2021-06-11 01:09:16'),(6,1,1,NULL,6,8,1,'1','ok',6,8,'2021-06-11 01:09:16','2021-06-11 01:10:18'),(7,1,1,NULL,8,9,1,'1','ok',8,9,'2021-06-11 01:10:18','2021-06-11 01:11:31');
/*!40000 ALTER TABLE `mfp_procurement_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_summary`
--

DROP TABLE IF EXISTS `mfp_procurement_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_summary` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `any_other_available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_fund_require` decimal(20,4) DEFAULT NULL,
  `total_fund_require` decimal(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_summary`
--

LOCK TABLES `mfp_procurement_summary` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_summary` DISABLE KEYS */;
INSERT INTO `mfp_procurement_summary` VALUES (1,1,'ok',500.0000,275595.2450,'0',2,2,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL);
/*!40000 ALTER TABLE `mfp_procurement_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_transaction`
--

DROP TABLE IF EXISTS `mfp_procurement_transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_transaction` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) NOT NULL,
  `consolidated_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `year_id` tinyint(4) NOT NULL,
  `mfp_procurement_id` bigint(20) NOT NULL,
  `transaction_consolidated_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `commission_rate` double(15,4) NOT NULL DEFAULT 0.0000,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_transaction`
--

LOCK TABLES `mfp_procurement_transaction` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_transaction_status_log`
--

DROP TABLE IF EXISTS `mfp_procurement_transaction_status_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_transaction_status_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `consolidated_id` int(11) NOT NULL,
  `reference_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_assigned_next_level` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_transaction_status_log`
--

LOCK TABLES `mfp_procurement_transaction_status_log` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_transaction_status_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_procurement_transaction_status_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_transportation_charges`
--

DROP TABLE IF EXISTS `mfp_procurement_transportation_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_transportation_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `approx_distance` decimal(15,4) DEFAULT NULL,
  `type_of_transport` bigint(20) DEFAULT NULL,
  `qty` decimal(15,4) DEFAULT NULL,
  `charges_per_qunital` decimal(15,4) DEFAULT NULL,
  `estimated_total_cost_of_transportation` decimal(15,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_transportation_charges`
--

LOCK TABLES `mfp_procurement_transportation_charges` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_transportation_charges` DISABLE KEYS */;
INSERT INTO `mfp_procurement_transportation_charges` VALUES (1,1,1,1,5.0000,1,5.0000,5.0000,25.0000,'1',2,2,'2021-06-09 23:21:36','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,1,5.0000,1,5.0000,5.0000,25.0000,'0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_transportation_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_warehouse_charges`
--

DROP TABLE IF EXISTS `mfp_procurement_warehouse_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_warehouse_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `unit_storage_rate` double(17,4) DEFAULT NULL,
  `estimated_quantity` double(17,4) DEFAULT NULL,
  `total_estimated_cost` double(20,4) DEFAULT NULL,
  `estimation_duration_of_storage` double(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_warehouse_charges`
--

LOCK TABLES `mfp_procurement_warehouse_charges` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_warehouse_charges` DISABLE KEYS */;
INSERT INTO `mfp_procurement_warehouse_charges` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',2,2,'2021-06-09 23:21:37','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,1,1,5.0000,5.0000,25000.0000,5.0000,'0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_warehouse_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_warehouse_labour_charges`
--

DROP TABLE IF EXISTS `mfp_procurement_warehouse_labour_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_warehouse_labour_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `warehouse_id` bigint(20) DEFAULT NULL,
  `qty` double(17,4) DEFAULT NULL,
  `unit_rate` double(20,4) DEFAULT NULL,
  `total_estimated_cost` double(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_warehouse_labour_charges`
--

LOCK TABLES `mfp_procurement_warehouse_labour_charges` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_warehouse_labour_charges` DISABLE KEYS */;
INSERT INTO `mfp_procurement_warehouse_labour_charges` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,'1',2,2,'2021-06-09 23:21:37','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,1,5.0000,5.0000,25.0000,'0',2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_warehouse_labour_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_procurement_weightment_charges`
--

DROP TABLE IF EXISTS `mfp_procurement_weightment_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_procurement_weightment_charges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `type` enum('H','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haat_id` int(11) DEFAULT NULL,
  `procurement_center_id` int(11) DEFAULT NULL,
  `total_estimated_cost` double(20,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_procurement_weightment_charges`
--

LOCK TABLES `mfp_procurement_weightment_charges` WRITE;
/*!40000 ALTER TABLE `mfp_procurement_weightment_charges` DISABLE KEYS */;
INSERT INTO `mfp_procurement_weightment_charges` VALUES (1,1,1,'H',1,NULL,5.0000,NULL,2,2,'2021-06-09 23:21:36','2021-06-09 23:45:38','2021-06-09 23:45:38'),(2,1,1,'H',1,NULL,5.0000,NULL,2,2,'2021-06-09 23:45:38','2021-06-09 23:45:38',NULL);
/*!40000 ALTER TABLE `mfp_procurement_weightment_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_seasonality`
--

DROP TABLE IF EXISTS `mfp_seasonality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_seasonality` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_seasonality`
--

LOCK TABLES `mfp_seasonality` WRITE;
/*!40000 ALTER TABLE `mfp_seasonality` DISABLE KEYS */;
INSERT INTO `mfp_seasonality` VALUES (1,1,1,'0',2,2,'2021-06-09 23:18:40','2021-06-09 23:18:40',NULL);
/*!40000 ALTER TABLE `mfp_seasonality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_seasonality_commodity`
--

DROP TABLE IF EXISTS `mfp_seasonality_commodity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_seasonality_commodity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_seasonality_id` bigint(20) DEFAULT NULL,
  `haat_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) DEFAULT NULL,
  `qty` decimal(17,4) DEFAULT NULL,
  `value` decimal(17,4) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_seasonality_commodity`
--

LOCK TABLES `mfp_seasonality_commodity` WRITE;
/*!40000 ALTER TABLE `mfp_seasonality_commodity` DISABLE KEYS */;
INSERT INTO `mfp_seasonality_commodity` VALUES (1,1,1,1,1,5.0000,250000.0000,'0',2,2,'2021-06-09 23:18:40','2021-06-09 23:18:40',NULL);
/*!40000 ALTER TABLE `mfp_seasonality_commodity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_seasonality_commodity_month`
--

DROP TABLE IF EXISTS `mfp_seasonality_commodity_month`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_seasonality_commodity_month` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `mfp_seasonality_id` bigint(20) DEFAULT NULL,
  `mfp_seasonality_commodity_id` bigint(20) DEFAULT NULL,
  `month` bigint(20) DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_seasonality_commodity_month`
--

LOCK TABLES `mfp_seasonality_commodity_month` WRITE;
/*!40000 ALTER TABLE `mfp_seasonality_commodity_month` DISABLE KEYS */;
INSERT INTO `mfp_seasonality_commodity_month` VALUES (1,1,1,1,2,'0',2,2,'2021-06-09 23:18:40','2021-06-09 23:18:40',NULL);
/*!40000 ALTER TABLE `mfp_seasonality_commodity_month` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_storage_actual_haat`
--

DROP TABLE IF EXISTS `mfp_storage_actual_haat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_storage_actual_haat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_storage_actua_other_id` bigint(20) NOT NULL,
  `haat_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_storage_actual_haat`
--

LOCK TABLES `mfp_storage_actual_haat` WRITE;
/*!40000 ALTER TABLE `mfp_storage_actual_haat` DISABLE KEYS */;
/*!40000 ALTER TABLE `mfp_storage_actual_haat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_storage_haat`
--

DROP TABLE IF EXISTS `mfp_storage_haat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_storage_haat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_storage_id` bigint(20) DEFAULT NULL,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `haat` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_storage_haat`
--

LOCK TABLES `mfp_storage_haat` WRITE;
/*!40000 ALTER TABLE `mfp_storage_haat` DISABLE KEYS */;
INSERT INTO `mfp_storage_haat` VALUES (1,1,1,1,'2021-06-09 23:20:30','2021-06-09 23:20:30',NULL);
/*!40000 ALTER TABLE `mfp_storage_haat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mfp_storage_plan`
--

DROP TABLE IF EXISTS `mfp_storage_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mfp_storage_plan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` bigint(20) DEFAULT NULL,
  `procurement_id` int(11) DEFAULT NULL,
  `mfp_name` bigint(20) DEFAULT NULL,
  `warehouse` bigint(20) DEFAULT NULL,
  `storage_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warehouse_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `storage_capacity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_storage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_draft` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mfp_storage_plan`
--

LOCK TABLES `mfp_storage_plan` WRITE;
/*!40000 ALTER TABLE `mfp_storage_plan` DISABLE KEYS */;
INSERT INTO `mfp_storage_plan` VALUES (1,1,1,1,1,'Cold','Owned','5','5','0',2,2,'2021-06-09 23:20:30','2021-06-09 23:20:30',NULL);
/*!40000 ALTER TABLE `mfp_storage_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=234 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_10_12_080028_user_management_schemas',1),(9,'2019_10_12_082605_user_roles_and_mappings',1),(10,'2019_10_12_103333_add_user_extra_fields',1),(11,'2019_10_12_104412_user_permission_schemas',1),(12,'2019_10_12_122019_state_level_role_mapping_schema',1),(13,'2019_10_14_084025_create_districts_master',1),(14,'2019_10_14_084516_create_blocks_master',1),(15,'2019_10_14_085127_create_id_proof_master',1),(16,'2019_10_14_085318_create_village_master',1),(17,'2019_10_16_071238_create_education_master',1),(18,'2019_10_16_131514_create_bank_master',1),(19,'2019_10_17_134609_create_designation_master',1),(20,'2019_10_17_134656_create_department_master',1),(21,'2019_10_21_082948_create_user_password_history_table',1),(22,'2019_10_21_171357_create_year_master',1),(23,'2019_10_21_171405_create_commodity_master',1),(24,'2019_10_23_072515_create_email_templates_table',1),(25,'2019_11_21_121533_state_level_fund_flow_relationship',1),(26,'2019_12_03_110004_create_financial_year_master',1),(27,'2020_02_03_151753_create_notifications_table',1),(28,'2020_02_18_093955_create_users_activity_table',1),(29,'2020_04_23_112226_create_refresh_token_table',1),(30,'2020_06_18_161054_update_user_bank_details_table',1),(31,'2020_07_13_140913_update_user_table',1),(32,'2020_07_13_140927_update_user_bank_table',1),(33,'2020_07_24_061652_create_users_allowed_states',1),(34,'2020_08_13_092231_create_sanction_letter_histoiry',1),(35,'2020_09_07_081347_create_haat_bazaar_details_table',1),(36,'2020_09_09_062721_create_packing_master_table',1),(37,'2020_09_14_113419_create_haat_bazaar_item_master',1),(38,'2020_09_14_175607_create_haat_operating_days_mappings_table',1),(39,'2020_09_14_175803_create_haat_blocks_mappings_table',1),(40,'2020_09_15_050322_create_warehouse_item_master',1),(41,'2020_09_15_162403_create_mfp_master_table',1),(42,'2020_09_16_122646_create_multipurpose_procurement_centre_item_master',1),(43,'2020_09_16_190125_create_mfp_price_history_table',1),(44,'2020_09_17_071637_update_haat_bazaar_item_master',1),(45,'2020_09_17_071934_update_warehouse_item_master',1),(46,'2020_09_17_071958_update_multipurpose_procurement_centre_item_master',1),(47,'2020_09_17_161932_create_commission_master',1),(48,'2020_09_18_063903_create_warehouse_master_table',1),(49,'2020_09_18_140810_create_commission_limit_table',1),(50,'2020_09_24_042101_create_mfp_procurement_table',1),(51,'2020_09_24_044315_create_mfp_coverage_table',1),(52,'2020_09_25_132440_create_mfp_storage_plan',1),(53,'2020_09_26_115149_create_mfp_procurement_plan',1),(54,'2020_09_29_162430_create_mfp_procurement_commodity',1),(55,'2020_09_30_142220_create_mfp_procurement_step3_table',1),(56,'2020_10_05_110356_create_mfp_procurement_commodity_history',1),(57,'2020_10_05_172207_update_procurement_commodity',1),(58,'2020_10_05_173738_create_mfp_storage_haat',1),(59,'2020_10_06_103418_update_mfp_storage_table',1),(60,'2020_10_06_104225_create_mfp_procurement_collection_level_table',1),(61,'2020_10_06_130628_create_infrastructure_development_table',1),(62,'2020_10_07_095708_create_mfp_procurement_collection_level_haat_table',1),(63,'2020_10_07_170608_create_mfp_procurement_step4_table',1),(64,'2020_10_08_042357_update_type_id_mfp_procurement_weightment_chargesTable',1),(65,'2020_10_08_062835_create_category_table',1),(66,'2020_10_08_112659_create_infrastructure_development_warehouse_table',1),(67,'2020_10_09_095558_create_infrastructure_development_funds_table',1),(68,'2020_10_09_095838_update_infrastructure_development_tables',1),(69,'2020_10_12_062342_create_state_role_sublevel_table',2),(70,'2020_10_12_084654_update_users_add_level_id',3),(71,'2020_10_12_102341_create_infrastructure_development_summary_table',4),(72,'2020_10_12_121822__update_infrastructure_haat_bazaar_table',4),(73,'2020_10_13_050946_update_mfp_procurement_add_commission',5),(74,'2020_10_13_060742_create_scrutiny_level_mfp_procurement_history_table',6),(79,'2020_10_13_085607_update_mfp_procurement_add_assigned_to',7),(81,'2020_10_13_091346_create_mfp_procurement_status_log_table',8),(82,'2020_10_12_100024_update_transportation_charges_table',9),(83,'2020_10_12_122306_update_mfp_procurement_table',9),(84,'2020_10_13_232342_create_mfp_procurement_consolidate_table',9),(85,'2020_10_14_102814_update_mfp_procurement_add_current_status_log_id',10),(86,'2020_10_15_061212_update_state_role_add_roleid',11),(87,'2020_10_14_093611_create_infrastructure_development_scrutiny_level_history_table',12),(88,'2020_10_14_093652_create_infrastructure_development_status_log_table',12),(89,'2020_10_14_111048_update_infrastructure_development_commision',12),(90,'2020_10_15_175901_update_infrastructuredevelopment_table',12),(91,'2020_10_16_114600_create_mfp_procurement_consolidation_table',12),(92,'2020_10_16_123245_update_mfp_procurement_status_log',13),(93,'2020_10_19_070929_update_consolidated_add_state_year',14),(94,'2020_10_16_151527_update_infra_development_table',15),(95,'2020_10_17_175900_update_mfp_procurement_service_charges_at_dia',15),(96,'2020_10_20_122354_update_infrastructure_dev_table',15),(97,'2020_10_20_122729_create_infrastructure_development_consolidation_table',15),(98,'2020_10_20_124731_create_infrastructure_development_consolidate_table',15),(99,'2020_10_22_170611_update_mfp_procurement',15),(100,'2020_10_26_163851_create_mfp_procurement_nodal',16),(101,'2020_10_26_180145_update_infrastructure_dev_table',16),(102,'2020_10_27_115928_update_infra_summary_table',16),(103,'2020_10_29_144651_create_procurement_center_master',16),(104,'2020_10_30_173535_update_step3_table',16),(105,'2020_11_04_070618_update_mfp_consolidation_add_approved_amount',17),(106,'2020_11_05_050855_update_mfp_procurement_add_isallapproved',18),(107,'2020_11_05_094530_create_mfp_procurement_sanction_letter_table',19),(108,'2020_11_06_111318_update_infrastructure_consoldation_table',20),(109,'2020_11_09_155152_create_infrastructure_development_sanction_letter_table',20),(110,'2020_11_09_173105_create_primary_level_agency',20),(111,'2020_11_11_110052_create_mfp_procurement_sanction_table',20),(112,'2020_11_12_104223_update_mfp_procurement_sanction_change_datatype',21),(113,'2020_11_13_042241_update_mfp_procurement_add_filenumber',22),(114,'2020_11_18_053616_update_mfp_procurement_sanction_change_datatype',23),(115,'2020_11_19_101508_create_mfp_procurement_fund_released_table',24),(116,'2020_11_12_130537_update_infrastructure_all_table',25),(117,'2020_11_12_154640_create_infrastructure_development_sanction_table',25),(118,'2020_11_13_134114_update_infra_sanction_table',25),(119,'2020_11_18_134317_update_infrastructure_table',25),(120,'2020_11_20_165653_create_infrastructure_development_fund_releases_table',25),(121,'2020_11_23_085842_create_mfp_procurement_fund_released_history_table',25),(122,'2020_11_26_075443_update_mfp_procurement_add_is_released',26),(123,'2020_11_24_130549_create_infrastructure_fund_released',27),(124,'2020_11_24_164011_create_infrastructure_fund_released_history_table',27),(125,'2020_12_04_093447_create_mfp_procurement_dia_release',27),(126,'2020_12_02_180114_update_infrastructure_development_add_is_released',28),(127,'2020_12_09_104909_create_mfp_procurement_dia_release_summary_table',28),(128,'2020_12_11_121158_update_mfp_seasionality_commodity',29),(129,'2020_12_11_125612_update_estimated_wastages',29),(130,'2020_12_15_100350_create_mfp_procurement_action_detail_table',30),(131,'2020_12_17_185110_create_mfp_procurement_actual_mfp_storage_table',31),(132,'2020_12_17_185204_create_mfp_procurement_actual_mfp_storage_other_table',31),(133,'2020_12_21_063947_update_mfp_procurement_actual_detail_add_ref_id',31),(134,'2020_12_21_153345_update_mfp_procurement_actual_mfp_storage',32),(135,'2020_12_23_060528_create_mfp_procurement_generate_receipt_table',32),(136,'2020_12_30_155414_create_infrastructure_development_actual_detail_table',33),(137,'2020_12_30_155433_create_infrastructure_development_actual_haat_table',33),(138,'2020_12_30_155446_create_infrastructure_development_actual_warehouse_table',33),(139,'2020_12_30_161020_create_infrastructure_development_actual_warehouse_fund_table',33),(140,'2020_12_30_161029_create_infrastructure_development_actual_haat_fund_table',33),(141,'2021_01_05_122940_update_infrastructure_development_actual_haat_funds_table',33),(142,'2021_01_05_123241_update_infrastructure_development_actual_warehouse_funds_table',33),(143,'2021_01_05_125411_update_infrastructure_development_actual_haats_table',33),(144,'2021_01_05_125551_update_infrastructure_development_actual_warehouses_table',33),(145,'2021_01_06_044425_update_change_mfp_procurement_consolidation_datatype',33),(146,'2020_12_29_125130_create_actual_overhead_details',34),(147,'2020_12_30_191342_update_actual_overhead_weighment_charges_',34),(148,'2021_01_07_122842_update_actual_overhead_service_details_dia',34),(149,'2021_01_07_123116_create_actual_overhead',34),(150,'2021_01_07_124658_update_actual_overhead_other_costs',34),(151,'2021_01_08_125527_create_shgtables_table',35),(152,'2021_01_11_112508_update_infra_actual_details_table',35),(153,'2021_01_11_172527_create_infrastruture_consolidation_transaction_table',35),(154,'2021_01_11_175847_create_infrastruture_transaction_logs_table',35),(155,'2021_01_13_112109_create_auction_committe_table',35),(156,'2021_01_13_103914_create_infrastructure_transaction_scrutiny_level_history_table',36),(157,'2021_01_15_042454_update_users_activity_add_module',36),(158,'2021_01_18_115308_create_auction_transaction_detail_table',37),(159,'2021_01_18_155842_update_infra_actual_detail_table',38),(160,'2021_01_11_134919_update_mfp_procurement_actual_detail',39),(161,'2021_01_11_165418_create_mfp_procurement_consolidated_transaction',39),(162,'2021_01_11_165504_create_mfp_procurement_transaction_status_log',39),(163,'2021_01_12_115925_update_mfp_procurement_consolidated_transaction_add_year_id',39),(164,'2021_01_12_120650_update_mfp_procurement_transaction_status_log_add_consolidated_id',39),(165,'2021_01_12_133449_update_mfp_procurement_transaction_status_log_update_column',39),(166,'2021_01_13_181532_update_mfp_procurement_add_column_is_actual_overhead_submitted',39),(167,'2021_01_20_173819_update_mfp_seasonality_value_type',40),(168,'2021_01_20_181754_update_actual_details_data_table',40),(169,'2021_01_22_174126_update_infra_step_datatype_table',40),(170,'2021_01_25_143620_update_infra_sanction_datatype_table',40),(171,'2021_01_29_113944_update_actual_overhead_weightment_charges',1),(172,'2021_02_01_105936_update_mfp_procurement_actual_detail_add_status',41),(173,'2021_02_02_135723_update_mfp_procurement_actual_mfp_storage_add_mfp_procurement_id',41),(174,'2021_02_04_054748_create_user_mapped_to_haatbazaar_table',41),(175,'2021_02_09_093037_update_mfp_procurement_add_approvaldate',42),(176,'2021_02_10_102641_update_auction_committe_add_valueadded',43),(177,'2021_02_09_162801_update_infractual_progressdetails_table',44),(178,'2021_02_10_104843_create_auction_committe_value_added_products_table',44),(179,'2021_02_11_091739_update_auction_committe_value_added_products_add_auction_id',45),(180,'2021_02_10_173741_update_infraconsolidationtran_table',46),(181,'2021_02_11_101256_update_auction_transaction_add_type',46),(182,'2021_02_11_133241_update_actual_infra_detailstable_table',47),(183,'2021_02_11_164958_create_mfp_procurement_consolidated_tribal_transaction',47),(184,'2021_02_12_162010_update_mfp_procurement_actual_mfp_storage_add_consolidated_id',47),(185,'2021_02_12_164656_update_actual_overhead_add_consolidated_id',47),(186,'2021_02_12_173309_create_mfp_procurement_transaction_table',47),(187,'2021_02_16_105930_update_actual_other_detail_table',48),(188,'2021_02_16_115530_update_mfp_procurment_add_used_amount_column_table',49),(189,'2021_02_18_054908_create_msp_market_price_table',50),(190,'2021_02_17_164956_update_mfp_procurement_drop_column_is_actual_overhead_submitted',51),(191,'2021_02_18_144737_update_mfp_procurement_generate_receipt_update_column',51),(192,'2021_02_19_065251_update_msp_market_price_add_submission_date',51),(193,'2021_02_19_104852_update_msp_market_price_table',52),(194,'2021_02_19_152107_update_mfp_procurement_transaction_add_district_id',53),(195,'2021_02_22_113147_create_user_mapped_to_warehouse_table',53),(196,'2021_02_22_154606_update_mfp_procurement_actual_mfp_storage_other_add_is_uploaded_uploaded_on_column',54),(197,'2021_02_26_043501_update_mfp_procurement_add_submission_date',55),(198,'2021_03_01_113621_update_infrastructure_development_add_subbmission_date',56),(199,'2021_03_01_150806_update_table_column_numeric_to_decimal',56),(200,'2021_03_02_093703_update_infrastructure_table_column_numeric_to_decimal',56),(201,'2021_03_03_161513_update_all_table_column_numeric_to_decimal',56),(202,'2021_03_04_055042_update_decimalcolummns',56),(203,'2021_03_08_150027_update_mfp_procurement_transaction_table',57),(204,'2021_03_17_111211_update_mfp_procurement_fund_released_add_balance_amount',58),(205,'2021_03_17_112540_add_trigger',59),(206,'2020_11_18_053616_update_mfp_procurement_sanction_change_datatypes',60),(207,'2021_03_17_111211_update_infrastructure_fund_released_add_balance_amount',60),(208,'2021_03_17_112540_add_trigger_infrastructure',60),(209,'2021_03_24_104040_create_mfp_storage_actual_haat_table',60),(210,'2021_03_30_112408_create_infrastructure_development_haat_blocks_table',61),(211,'2021_03_30_131009_create_infrastructure_development_warehouse_blocks_table',61),(212,'2021_03_30_131023_create_infrastructure_development_warehouse_mfp_table',61),(213,'2021_03_30_170658_update_infrastructure_development_haat_fund_table',61),(214,'2021_03_31_130846_update_add_infra_id_fund_tavle',61),(215,'2021_04_05_090817_update_estimated_losses_history_table_add_mfp_procurement_id',62),(216,'2021_04_13_053034_update_columns_decimal_dia_release',63),(217,'2021_04_20_110142_update_mfp_procurement_add_approved_by',63),(218,'2021_04_21_093217_update_infrastructure_approved_by_column_table',64),(219,'2021_04_21_100516_update_infrastructure_approved_date_column_table',64),(220,'2021_04_21_115709_update_collength_fundrequiresummary',64),(221,'2021_04_22_051326_update_decimalsfieldslength',64),(222,'2021_04_27_055654_update_approved_by_column_table',65),(223,'2021_04_29_110527_update_column_length_mfp_procurrement_consolidation',65),(224,'2021_05_06_110545_add_shg_gatherer_column_ref_id',66),(225,'2021_05_10_085736_update_fund_released_add_commission',67),(226,'2021_05_11_065345_upate_commission_ammount_for_dia',68),(227,'2021_05_11_045659_update_infra_fund_release_commission_table',69),(228,'2021_05_11_065150_update_infra_fund_release_add_commission_table',69),(229,'2021_05_12_051243_update_infrastructure_add_commission_column_table',69),(230,'2021_05_13_080148_update_infra_actual_add_create_column_table',69),(231,'2021_05_31_064303_update_haat_id_in_mfp_seasonality_commodity',69),(232,'2021_06_04_060313_update_sanction_letter_amount_decimal',70),(233,'2021_06_11_070027_create_mfp_procurement_fund_transactions_table',71);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msp_market_price`
--

DROP TABLE IF EXISTS `msp_market_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msp_market_price` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `haat_master_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) NOT NULL,
  `msp_price` decimal(20,4) NOT NULL,
  `market_price` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL,
  `status_update_date` datetime DEFAULT NULL,
  `status_changed_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msp_market_price`
--

LOCK TABLES `msp_market_price` WRITE;
/*!40000 ALTER TABLE `msp_market_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `msp_market_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msp_market_price_log`
--

DROP TABLE IF EXISTS `msp_market_price_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msp_market_price_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `msp_market_price_id` bigint(20) NOT NULL,
  `haat_master_id` bigint(20) NOT NULL,
  `mfp_id` bigint(20) NOT NULL,
  `msp_price` decimal(20,4) NOT NULL,
  `market_price` decimal(20,4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Approved,2=Reverted,3=Rejected',
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_update_date` date DEFAULT NULL,
  `status_changed_by` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msp_market_price_log`
--

LOCK TABLES `msp_market_price_log` WRITE;
/*!40000 ALTER TABLE `msp_market_price_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `msp_market_price_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multipurpose_procurement_centre_item_master`
--

DROP TABLE IF EXISTS `multipurpose_procurement_centre_item_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `multipurpose_procurement_centre_item_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `cost` bigint(20) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multipurpose_procurement_centre_item_master`
--

LOCK TABLES `multipurpose_procurement_centre_item_master` WRITE;
/*!40000 ALTER TABLE `multipurpose_procurement_centre_item_master` DISABLE KEYS */;
INSERT INTO `multipurpose_procurement_centre_item_master` VALUES (1,'Multipurpose Procurement Centre Items','Multipurpose Procurement Centre Items',5,10,'1',0,0,'2021-06-09 00:49:10','2021-06-09 00:56:27');
/*!40000 ALTER TABLE `multipurpose_procurement_centre_item_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('0e610f20-01ea-46aa-9742-c132c4c1bcff','App\\Notifications\\MfpProcurementDiaReleased','App\\Models\\User',10,'{\"message\":\"MFP Procurement fund released for proposal id 23000001 of Rs. 450 done by dai\",\"action\":\"http:\\/\\/localhost\\/msp\\/fund-management\\/mfp_procurement_release_fund_agent.php\"}',NULL,'2021-06-11 02:31:54','2021-06-11 02:31:54'),('0f7f3ba1-60b1-4fda-adea-6c5be0cfa039','App\\Notifications\\DiaAccessCommisionNotification','App\\Models\\User',8,'{\"message\":\"MFP Procurement commission amount is exceded from max aggregate for proposal_id 23000001 .\",\"action\":\"http:\\/\\/localhost\\/msp\\/fund-management\\/commission_received_by_dia.php?proposal_id=1\"}',NULL,'2021-06-11 02:31:54','2021-06-11 02:31:54'),('19b5d63d-43d2-4b74-8f05-defd831fe1eb','App\\Notifications\\MfpProcurementAssignNextLevel','App\\Models\\User',13,'{\"message\":\"You have received MFP procurement  request with proposal id 23000001 for verification.\",\"action\":\"http:\\/\\/localhost\\/msp\\/project-proposal\\/view-mfp-procurement.php?id=045e607b-6a2e-4a8a-b3ab-2e15a33755dc\"}',NULL,'2021-06-11 01:05:10','2021-06-11 01:05:10'),('2f94d936-140b-42b3-9430-70b795b694e0','App\\Notifications\\MfpProcurementConsolidationAssignNextLevel','App\\Models\\User',8,'{\"message\":\"Consolidation for year 2021-2022 with consolidation id 23_1 has been assigned by sia\",\"action\":\"http:\\/\\/localhost\\/msp\\/proposal-verification\\/mfp-procurement-verification.php?tab=4\"}',NULL,'2021-06-11 01:09:16','2021-06-11 01:09:16'),('331a58d7-ba74-4275-9f20-7193745f3d72','App\\Notifications\\DiaAccessCommisionNotification','App\\Models\\User',9,'{\"message\":\"MFP Procurement commission amount is exceded from max aggregate for proposal_id 23000001 .\",\"action\":\"http:\\/\\/localhost\\/msp\\/fund-management\\/commission_received_by_dia.php?proposal_id=1\"}',NULL,'2021-06-11 02:31:49','2021-06-11 02:31:49'),('54e68de7-d3c8-4036-b32d-32ce3c50f986','App\\Notifications\\MfpProcurementConsolidationAssignNextLevel','App\\Models\\User',9,'{\"message\":\"Consolidation for year 2021-2022 with consolidation id 23_1 has been assigned by nodal\",\"action\":\"http:\\/\\/localhost\\/msp\\/proposal-verification\\/mfp-procurement-verification.php?tab=4\"}',NULL,'2021-06-11 01:10:18','2021-06-11 01:10:18'),('5d2153fb-7ea0-4942-a3b2-3866b89df033','App\\Notifications\\MfpProcurementFundReleased','App\\Models\\User',6,'{\"message\":\"MFP Procurement fund released for consolidated id 23_1 of Rs. 13779.7623 done by nodal\",\"action\":\"http:\\/\\/localhost\\/msp\\/fund-management\\/mfp_procurement_release_fund.php\"}',NULL,'2021-06-11 02:11:05','2021-06-11 02:11:05'),('9d0bbdef-ed39-4b03-a79b-8bb2c6474977','App\\Notifications\\MfpProcurementApprove','App\\Models\\User',2,'{\"message\":\"MFP Procurement for 2021-2022 with proposal id 23000001 has been Approved by ministry\",\"action\":\"http:\\/\\/localhost\\/msp\\/project-proposal\\/view-mfp-procurement.php?id=045e607b-6a2e-4a8a-b3ab-2e15a33755dc\"}',NULL,'2021-06-11 01:11:31','2021-06-11 01:11:31'),('a77ceeed-d25c-489c-9a43-037a85c6c5d5','App\\Notifications\\MfpProcurementAssignNextLevel','App\\Models\\User',4,'{\"message\":\"You have received MFP procurement  request with proposal id 23000001 for verification.\",\"action\":\"http:\\/\\/localhost\\/msp\\/project-proposal\\/view-mfp-procurement.php?id=045e607b-6a2e-4a8a-b3ab-2e15a33755dc\"}',NULL,'2021-06-11 01:04:01','2021-06-11 01:04:01'),('afaa800f-9cd3-4c1b-895a-b5c3ce5fed63','App\\Notifications\\MfpProcurementFundReceived','App\\Models\\User',2,'{\"message\":\"MFP Procurement fund released for proposal id 23000001 of Rs. 654.5387000000001 done by sia\",\"action\":\"http:\\/\\/localhost\\/msp\\/fund-management\\/mfp_procurement_received_fund.php\"}',NULL,'2021-06-11 02:14:58','2021-06-11 02:14:58'),('c92c4fe0-b654-45d9-91db-03ece7c4c5ad','App\\Notifications\\MfpProcurementAssignNextLevel','App\\Models\\User',5,'{\"message\":\"You have received MFP procurement  request with proposal id 23000001 for verification.\",\"action\":\"http:\\/\\/localhost\\/msp\\/project-proposal\\/view-mfp-procurement.php?id=045e607b-6a2e-4a8a-b3ab-2e15a33755dc\"}',NULL,'2021-06-11 01:06:37','2021-06-11 01:06:37'),('f095a0ac-f13c-44bb-9c83-b8c6bc6abc03','App\\Notifications\\MfpProcurementConsolidatedNextLevel','App\\Models\\User',6,'{\"message\":\"You have received MFP procurement consolidated Proposals of MANIPUR state request with consolidated id 23_1 for verification.\",\"action\":\"http:\\/\\/localhost\\/msp\\/proposal-verification\\/consolidated-proposal-verification.php?id=1\"}',NULL,'2021-06-11 01:08:18','2021-06-11 01:08:18'),('fd9829f8-77b7-4ab4-bea8-57ac11606332','App\\Notifications\\MfpProcurementSubmission','App\\Models\\User',3,'{\"message\":\"You have received MFP procurement request with proposal id 23000001 for verification.\",\"action\":\"http:\\/\\/localhost\\/msp\\/project-proposal\\/view-mfp-procurement.php?id=045e607b-6a2e-4a8a-b3ab-2e15a33755dc\"}',NULL,'2021-06-11 01:01:57','2021-06-11 01:01:57');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('0019daf350be6bd48888cacc698193b182f5c3b35d13d6af9d514611ed403af683d1df014ccfba3b',9,14,'MyApp','[]',1,'2021-05-12 01:22:07','2021-05-12 01:22:07','2021-05-13 06:52:06'),('0036b13f09d289273bcd6324b76ba3688cc36054fa0af284aa099e02029e122417023269b1345bed',2,5,'MyApp','[]',1,'2020-10-23 03:41:05','2020-10-23 03:41:05','2020-10-24 09:11:04'),('006083b5c25f57855fe5279da7b9b4326b93ebbe85b367b13ecefefb09d44453f28681f9154124f6',2,5,'MyApp','[]',1,'2020-10-13 01:21:17','2020-10-13 01:21:17','2020-10-14 06:51:17'),('00c3d224d325d27f8b9718683006f2094cc85c393c875dde963212de2514308e196e0932f9fc8504',1,11,'MyApp','[]',1,'2021-01-22 00:02:58','2021-01-22 00:02:58','2021-01-23 05:32:58'),('011994e6b0211496e52fee066b7547700b1cbe82276d4c590618e0db9e5da39bf94662226b617320',1,5,'MyApp','[]',1,'2020-10-11 23:32:45','2020-10-11 23:32:45','2020-10-13 05:02:40'),('011a912a4d93efa55599a92c18f9e5e16313677be084b06b759b131a39406ffd55009fd86a0fbbd2',1,8,'MyApp','[]',1,'2021-01-04 07:00:07','2021-01-04 07:00:07','2021-01-05 12:30:07'),('0123d125c0b98fa39ab9140ea493486f5ce67cde20b633b0c921a0d4914bcd82239ecd1192a258bc',5,5,'MyApp','[]',1,'2020-10-19 23:22:43','2020-10-19 23:22:43','2020-10-21 04:52:40'),('012b56ff49b33461726f553ad5d490222b909bb6bd7af0e091adadaf1fd56514dcb521b443e40a13',5,14,'MyApp','[]',1,'2021-05-04 04:07:53','2021-05-04 04:07:53','2021-05-05 09:37:52'),('012cc99b5ed0709e952ced30268101bfe7a47471255f690b320209d4fa0befd916410efb888c3ea9',4,5,'MyApp','[]',1,'2020-11-25 22:45:00','2020-11-25 22:45:00','2020-11-27 04:15:00'),('01e7e66211adfe537015b0b09d1b51b3f5b827c657bd8a04b43230f3083b4dd24e50c18957b30ee2',10,11,'MyApp','[]',1,'2021-01-25 03:05:36','2021-01-25 03:05:36','2021-01-26 08:35:30'),('01ec4421e422e2d193c9db8eeebe14d3438b29e04fe9d40bfbe2debdfd74fa0c479a66c21f2751c6',2,5,'MyApp','[]',1,'2020-10-13 05:22:21','2020-10-13 05:22:21','2020-10-14 10:52:21'),('01f4c88add85fd0d180feeb7bd1c5e38ae2eed6aab5ab291c9c3199fec9ad4fa2d1e79657142db37',2,5,'MyApp','[]',1,'2020-10-26 03:35:35','2020-10-26 03:35:35','2020-10-27 09:05:35'),('0270a4c5fa0f8d68f23d05c029f5596015efec549e48f8e9495f64b6660f1318528c7b5e3058ae85',2,11,'MyApp','[]',1,'2021-01-28 04:35:42','2021-01-28 04:35:42','2021-01-29 10:05:42'),('02a46f0c8bdc0adb7667e8351d3b75979941d908307e973e778e5c3c4bfb5e68d495394ccd918571',2,8,'MyApp','[]',1,'2021-01-04 03:51:49','2021-01-04 03:51:49','2021-01-05 09:21:49'),('0331d291306a4aff7349da876fbf05024780c708892f907fe65ac15e6860f7c85739630f134d155c',4,5,'MyApp','[]',1,'2020-10-26 04:28:32','2020-10-26 04:28:32','2020-10-27 09:58:32'),('0380c17eebc0b35686bfbd604f6e1199c4f66ed98fd662df26b71c9ac338b1bc95c80c318a278e52',3,14,'MyApp','[]',1,'2021-04-20 06:50:09','2021-04-20 06:50:09','2021-04-21 12:20:09'),('03864fb23fda589b48a94cef351b4f01fe5bac87e9053dd289c4e09b8b3e0322baecb2c6e9d8b2e1',8,11,'MyApp','[]',1,'2021-01-25 05:47:15','2021-01-25 05:47:15','2021-01-26 11:17:14'),('0392089aa01c287b874ce6de504a9888494174b136cf865b99bf3d056a78a23c51ffc6c429bb8aa2',6,14,'MyApp','[]',1,'2021-02-26 01:00:12','2021-02-26 01:00:12','2021-02-27 06:30:12'),('0398e77f3ec40d4a0401aee4c2043b42431765d4d8f59946a11919b9c7a7b2509b650fcd2f9bdff5',2,11,'MyApp','[]',1,'2021-02-03 01:25:27','2021-02-03 01:25:27','2021-02-04 06:55:26'),('03a339b95393f68a207351c2960f65d9e3d9eee3335e6adcbc647f219cdff7efb32497a26bcf15d6',8,11,'MyApp','[]',1,'2021-01-12 23:18:53','2021-01-12 23:18:53','2021-01-14 04:48:53'),('03ed907d93e481656b368ea57c570da56c7a26c73d71add5411e2581d08eecc62c66441133b4a61d',1,11,'MyApp','[]',1,'2021-01-25 05:47:42','2021-01-25 05:47:42','2021-01-26 11:17:42'),('0402790ff8903a31d95141ec1e0338b309adc38abd44d73994704d39ddb8142a79e24c009595b20e',1,5,'MyApp','[]',1,'2020-11-26 03:48:48','2020-11-26 03:48:48','2020-11-27 09:18:48'),('0488d3869cf9202811184ab048319aad89186d04e541e370e878e53e83f4f26f4d4dd9fd855f8a5d',5,5,'MyApp','[]',1,'2020-12-16 01:56:21','2020-12-16 01:56:21','2020-12-17 07:26:20'),('049808b94d68ceb98d9e66fb4ebe1441a758632e4d7227b16f804b609f2f898033b81d48cb893a27',18,14,'MyApp','[]',0,'2021-02-17 03:23:07','2021-02-17 03:23:07','2021-02-18 08:53:07'),('04dbb28668db9e0296903a62e12c79a3c905b60ea454d2c9cb55c4be63e5963ef82665b9a4312bd9',1,14,'MyApp','[]',1,'2021-03-08 00:36:06','2021-03-08 00:36:06','2021-03-09 06:06:06'),('0562d8bf234a7befbbd7cce82e6e36fb2aea1438926f5a12eed2e6c2795dc1c797c24ded895cbd0a',2,14,'MyApp','[]',1,'2021-02-16 04:36:40','2021-02-16 04:36:40','2021-02-17 10:06:39'),('057f6f117cc2522065d144ffe8b2a4a7c9ac7ab1f2b06bc47f5ea3ac49f64e1a5206e93afa8ec6c2',2,14,'MyApp','[]',1,'2021-05-03 23:27:22','2021-05-03 23:27:22','2021-05-05 04:57:21'),('05a923bdac6a7749a3c0dda1e491b9b5030720d257939a65e59d328ba57050cd70a51847db2b0e43',10,11,'MyApp','[]',1,'2021-02-01 23:38:47','2021-02-01 23:38:47','2021-02-03 05:08:47'),('062cef6936dfb4da30b1fdd93610995eb6ee17febb594d2e5df4be391d5c1ad33f21eb95e80526d4',8,5,'MyApp','[]',1,'2020-12-11 05:21:05','2020-12-11 05:21:05','2020-12-12 10:51:05'),('0655cae1ae47b6d76da858f8ff420e492e0dd850eee53fd9e46439db20197ee76903a68c95a2504a',8,5,'MyApp','[]',1,'2020-12-16 03:03:06','2020-12-16 03:03:06','2020-12-17 08:33:06'),('0687a589a5dc04b91d8b35eb488988f2bb8365e51748628c15a39b268c85c6cd83f51e7092a25136',8,5,'MyApp','[]',1,'2020-11-23 04:26:48','2020-11-23 04:26:48','2020-11-24 09:56:48'),('069ed6a35e2749ee09ae9ea5c1bda19f05ea0975349c1cf316440d51f1f9c35f8c80123769b84048',6,5,'MyApp','[]',1,'2020-10-19 23:37:51','2020-10-19 23:37:51','2020-10-21 05:07:51'),('06df8396476c01cbfa1e7d296dc0924f53db4ba77e47ccf01ff6ecdd092880f3e2713e44af63aec0',3,14,'MyApp','[]',1,'2021-04-06 02:02:38','2021-04-06 02:02:38','2021-04-07 07:32:38'),('071b11e2cb8d924f48f35bf9131206ce6c3f25748076bcda507c32e722be35bb53c13cfcc78f2554',6,5,'MyApp','[]',1,'2020-10-21 05:45:06','2020-10-21 05:45:06','2020-10-22 11:15:06'),('075b115935a031c7232e9fedd3c866420b184f97ba1d6bf62eaaea3ea1f22678b9627677754f36a0',6,5,'MyApp','[]',1,'2020-10-23 04:09:35','2020-10-23 04:09:35','2020-10-24 09:39:35'),('07862b0ca4bdf8171e8946496309bfc39fa276eca0b5bebb08e883a1e1dda489be7f948e0c7c7fe2',3,5,'MyApp','[]',1,'2020-11-05 00:17:41','2020-11-05 00:17:41','2020-11-06 05:47:41'),('07d4f01c9973cf0791128e4741ab098069ffb60037dd69fc7cc4f79faeb1038089880dbad951eec7',13,14,'MyApp','[]',1,'2021-05-04 04:08:22','2021-05-04 04:08:22','2021-05-05 09:38:21'),('08021a3ecb43b3e2ae726f8772ace5a396674377e1176aca1a10e26423cbcaef0ee27d91e405c1af',10,14,'MyApp','[]',1,'2021-03-22 03:02:12','2021-03-22 03:02:12','2021-03-23 08:32:11'),('08ac25f06c97c0cefcb644de0e47f4e2e107bd9a28cb670d7f71efcd826ee45b3116c03639383f47',4,5,'MyApp','[]',1,'2020-10-20 02:13:20','2020-10-20 02:13:20','2020-10-21 07:43:20'),('08daa36b29d85f79f770897071801eead99451027d1fb453611f7cd4bb550c49f97710d5abdc20e8',2,5,'MyApp','[]',1,'2020-12-09 03:44:52','2020-12-09 03:44:52','2020-12-10 09:14:51'),('09561776a8bf26b9221e52767cee16a487c1b26ebd7084f5f84743ca449eba451ab0614c3d07d205',5,5,'MyApp','[]',1,'2020-11-26 23:07:51','2020-11-26 23:07:51','2020-11-28 04:37:51'),('0987f25f62929ed845c0ce87901333c2b018adb7afefd9143b4df396137fe7b4359d88eef310ec9a',18,14,'MyApp','[]',1,'2021-02-18 23:09:39','2021-02-18 23:09:39','2021-02-20 04:39:38'),('09a7f9b1e9c9ed025a39d20b456db2cfbf400af0c4aeb4568f18358f0e2ce0b91a7628ab5798dce8',2,14,'MyApp','[]',1,'2021-02-09 01:36:36','2021-02-09 01:36:36','2021-02-10 07:06:36'),('0a7a38ea98408f6c6048b4d034dfde2f4a2414d6dcf6e9d5441e21608bd0b3beb9ab79ad5cc6d0b4',1,14,'MyApp','[]',1,'2021-04-12 05:37:20','2021-04-12 05:37:20','2021-04-13 11:07:20'),('0b44b586f3f93f371aad28d99155476690989b750ffaf9a2459ff3d17ab960aadf835d57b9256e42',10,14,'MyApp','[]',1,'2021-05-14 03:38:43','2021-05-14 03:38:43','2021-05-15 09:08:41'),('0bd813f61a80065cd774ba0d9208e863f68dfca69d6a0015a9dfb8c234c8a79cab0d1225f5c2decb',4,5,'MyApp','[]',1,'2020-11-05 00:22:11','2020-11-05 00:22:11','2020-11-06 05:52:11'),('0bd88227716731492d3d1b28731fb407bfeed32a6058b2853311f4c4c7d6377772e8a7388a4c01f3',8,5,'MyApp','[]',1,'2020-12-16 03:02:17','2020-12-16 03:02:17','2020-12-17 08:32:16'),('0be3b5c530fe68e94a5c38c59eb0502996fedd237d49800115ea0d2ad98e6bb50c7e2e76738933b1',6,5,'MyApp','[]',1,'2020-11-03 02:55:12','2020-11-03 02:55:12','2020-11-04 08:25:12'),('0c20eda9f97b5a6415701290df9a6a6fcdcc1132a7f6cd4276d1f0d829eea064cc1e858a86ec5f10',8,14,'MyApp','[]',1,'2021-03-12 04:34:24','2021-03-12 04:34:24','2021-03-13 10:04:24'),('0c36e3057e79d244ce2801576d3cef941aef0f8a0bcdef99fba73bcd55e5bc8a393c06b61568d424',1,14,'MyApp','[]',1,'2021-06-09 23:14:31','2021-06-09 23:14:31','2021-06-11 04:44:31'),('0c57256d8e938509860be53554ef6a459d25c770cf439a9dc23a023d31d1d687bbc95589d0aeebed',8,5,'MyApp','[]',1,'2020-12-13 23:43:48','2020-12-13 23:43:48','2020-12-15 05:13:48'),('0c8beddcb56a5e8f9cbc9ef6422d116fff71cfdbdcfe2952828c40820e1856ca08f24931f149f991',2,11,'MyApp','[]',1,'2021-02-02 03:40:51','2021-02-02 03:40:51','2021-02-03 09:10:51'),('0cc76ef66a1d913aba947b88f7327bd7b47a4949c8d3b2752d17eb20bdbcd54d3708d3f8811f71b7',4,5,'MyApp','[]',1,'2020-10-16 03:17:30','2020-10-16 03:17:30','2020-10-17 08:47:28'),('0cca01b20e46b8744081813aa96fd64227a464afdb24c47aafe2531204489762a697baaef241b3b2',2,14,'MyApp','[]',1,'2021-04-21 00:12:30','2021-04-21 00:12:30','2021-04-22 05:42:29'),('0cda42713c9848924003479c2f526f3840f0b379b599e4323d7bab96ac96c62d9450a52766c80bbd',1,5,'MyApp','[]',0,'2020-11-11 06:31:52','2020-11-11 06:31:52','2020-11-12 12:01:52'),('0cec77d0a1ef09c8a15a65bf357278f910565770ebf08af6367722b0009edea2caa459057e45f930',9,14,'MyApp','[]',1,'2021-04-22 00:27:35','2021-04-22 00:27:35','2021-04-23 05:57:35'),('0d22a47e798b40a7d8613ca8d12920fc26a187bf56feea04ecf20d8b035be76bd6c3a24c005587ae',8,5,'MyApp','[]',1,'2020-11-05 00:35:54','2020-11-05 00:35:54','2020-11-06 06:05:53'),('0d560e2ed0b37a2ff7bb99520704005f9d293aabcb528d2f4e662ef23b5ade1e7fe661ed9edf9ce4',9,11,'MyApp','[]',1,'2021-01-22 01:08:59','2021-01-22 01:08:59','2021-01-23 06:38:59'),('0d686564a6a279f43f22e98b270d139f5cdd345155cefd867b11a26015c7a251b942de7a40556a05',1,11,'MyApp','[]',1,'2021-01-06 22:52:06','2021-01-06 22:52:06','2021-01-08 04:22:06'),('0d8c773f4dccec69b64d74bd3793fbc9dc996bf4a1ddbf69d9563ae26efdbdea07c4d665438ba004',10,11,'MyApp','[]',0,'2021-02-05 00:27:27','2021-02-05 00:27:27','2021-02-06 05:57:27'),('0db96e02fe3aa08e26db10499a0df8de7bfac0eeb8e70bb8325c9930731f1df8571da6b254e76451',3,5,'MyApp','[]',1,'2020-10-14 01:43:24','2020-10-14 01:43:24','2020-10-15 07:13:24'),('0dbce46921d3051b9f2d12d610e475aa4f9c9a34fdae1800c59c09577a984b9efd32a09a447c004f',2,14,'MyApp','[]',1,'2021-04-12 23:19:52','2021-04-12 23:19:52','2021-04-14 04:49:52'),('0ddb5e2b2a7b1197e1c06d39f234868541e5ee0e62e8ef092e9504cf31a7fb0ee7f6a86fa1d0d237',9,5,'MyApp','[]',1,'2020-11-11 05:13:09','2020-11-11 05:13:09','2020-11-12 10:43:09'),('0df6a9419bc3027c2859538ed06457501de5ccc0c67cc4b4ea3f2ee16846ed64bef8ed9bc6cfc13d',10,14,'MyApp','[]',1,'2021-02-16 00:15:32','2021-02-16 00:15:32','2021-02-17 05:45:32'),('0e0c19b016a743eb657ea34b99823d8dcccc1b27180a298fb04346172161931660b6e62f34636746',10,14,'MyApp','[]',1,'2021-06-02 00:59:56','2021-06-02 00:59:56','2021-06-03 06:29:56'),('0e5148e14c9a04f0348aad7686ef22e4d5ec8c26e8fa1d8e98aab164b26996427f9f6374021b2711',9,5,'MyApp','[]',1,'2020-12-16 02:31:04','2020-12-16 02:31:04','2020-12-17 08:01:04'),('0ebf4245c90d81a3bf7b1ac05f0fc2e3d6d87ad387c153b4648e9f6ea059a014e9dfc125d2506c7d',2,14,'MyApp','[]',1,'2021-05-10 23:51:51','2021-05-10 23:51:51','2021-05-12 05:21:50'),('0ecc8cc1743ff76aba06fe03e0f3c01e0d90ce6b8f2ce1b50fa6e2bab8b3636b00e0722882595bcb',13,14,'MyApp','[]',1,'2021-04-21 23:33:11','2021-04-21 23:33:11','2021-04-23 05:03:11'),('0f0f3cb8969bc3bc3b2388f3e8b2c780a789e9542f3d0c3cbc5f65f53400a0aa6f5fd30c1009ed64',2,5,'MyApp','[]',1,'2020-10-13 04:24:29','2020-10-13 04:24:29','2020-10-14 09:54:28'),('0f3ce72c7f811011666fd7cc2460142bbc5dff8ee724010ccc4b68f27e192e92b01fd7eeb08998b1',8,5,'MyApp','[]',1,'2020-11-19 02:02:04','2020-11-19 02:02:04','2020-11-20 07:32:02'),('0f912cc2258bd0133dd0d63b8a90ba11a7667d71c587275acc047a821c48964f098e67e26316e455',10,11,'MyApp','[]',1,'2021-01-15 03:12:29','2021-01-15 03:12:29','2021-01-16 08:42:29'),('0fcdd90f5fcda48310f353faf7b8551c451f7ffdf630c33afe4077e23b97d314784f93156ba0a4e4',2,14,'MyApp','[]',1,'2021-04-21 04:46:37','2021-04-21 04:46:37','2021-04-22 10:16:37'),('0fce92ad3e65b5b48affb8749d7f982a98c19ff9497ecea8a7999263d7e2a8d27d974df280f3401a',8,11,'MyApp','[]',1,'2021-01-15 01:21:32','2021-01-15 01:21:32','2021-01-16 06:51:32'),('0ff2e85303dc4302ada26f5730ef579686e97b08517e38168735c0be1010b9dd5ef754e1c385be14',1,11,'MyApp','[]',1,'2021-01-07 23:42:58','2021-01-07 23:42:58','2021-01-09 05:12:58'),('1062b5e54a8629fea2b8dd15356fd0773aacb67a8f2f4c454374596c50aa42b3e17022edddc8c165',6,5,'MyApp','[]',1,'2020-12-11 05:02:40','2020-12-11 05:02:40','2020-12-12 10:32:40'),('10949117750cca9e36f209d2a1d4a56f8cdd944580ff8cd484023fe6e69ae11d23d23ad744e1a86c',4,5,'MyApp','[]',1,'2020-11-12 05:01:09','2020-11-12 05:01:09','2020-11-13 10:31:08'),('10adf1768420e20bc03db11fe56f4a7d6cdf913bcf521db0a41f5da6322f1a7d570d68e68a428dd8',8,14,'MyApp','[]',1,'2021-03-25 00:06:23','2021-03-25 00:06:23','2021-03-26 05:36:23'),('1110d7c73f255ad33953e08a4448292ff44562702d752f0599c0f38f6b85929fc742fb1c215ce9a8',9,14,'MyApp','[]',1,'2021-05-09 23:32:28','2021-05-09 23:32:28','2021-05-11 05:02:26'),('1164827fc6ff2b4140ae079e11b65f9ee37e0b0c24de8371c14bf07812e32b17b0e3cbd475785370',13,11,'MyApp','[]',0,'2021-01-21 06:24:56','2021-01-21 06:24:56','2021-01-22 11:54:56'),('1206cfb04e787fa273e4ca7dc3d609504ce24b77d9e6f5510588be660deba976943841505aca3f7c',8,14,'MyApp','[]',1,'2021-02-26 06:57:40','2021-02-26 06:57:40','2021-02-27 12:27:39'),('1280c66fccb7dff81fb9e656f99dbf7a48e639922f86052cf2fa30d993ab31e89e195429f26f1676',9,5,'MyApp','[]',1,'2020-11-11 22:42:42','2020-11-11 22:42:42','2020-11-13 04:12:42'),('128fc61f2834778953edbd113dd10ff9b74643d3606eee55dfd016918734e6264186dac857f8d444',6,14,'MyApp','[]',1,'2021-04-06 01:11:39','2021-04-06 01:11:39','2021-04-07 06:41:38'),('129be908220bbf2670f03fcd1240fa45bf32b73e51414df153feba292533d3e9a01b61a4b0ecfe16',2,5,'MyApp','[]',1,'2020-12-11 05:54:20','2020-12-11 05:54:20','2020-12-12 11:24:20'),('12a3bc12837306124b58e5747aa29f147f6a3b4fcf2d205319de65182d8789910c245d87c0e1dbe1',1,5,'MyApp','[]',1,'2020-11-20 00:09:44','2020-11-20 00:09:44','2020-11-21 05:39:44'),('12b8ccb69c96dcaeaed5c8377a9eb4e92c960b3336f242fd95912cf3dd1404db888b51ddf99864a6',6,14,'MyApp','[]',1,'2021-05-12 06:07:21','2021-05-12 06:07:21','2021-05-13 11:37:21'),('1383758c3dd76a4700a88eaeb1492c14419f84a8a6aceee3a59dafb25754b2504cf31c98af05831c',6,14,'MyApp','[]',1,'2021-05-10 23:41:59','2021-05-10 23:41:59','2021-05-12 05:11:58'),('139da9db11a30ce7767793ddda0b4eb55134391330755f69327d6879422ed6335e73d1a6e793d1cf',6,11,'MyApp','[]',1,'2021-01-21 05:10:27','2021-01-21 05:10:27','2021-01-22 10:40:27'),('13ca9c481bf93219f0cf7a7cdde5c7d41e7237f6a322fd62631108315f108601fc3289dae1844f7e',4,14,'MyApp','[]',1,'2021-03-17 00:06:04','2021-03-17 00:06:04','2021-03-18 05:36:04'),('13ed761a980c5b13320d804767c465fc93d57d13ff092b4d01ade389cef0f3d1762ab58afe78b923',1,14,'MyApp','[]',1,'2021-06-14 01:47:08','2021-06-14 01:47:08','2021-06-15 07:17:06'),('14103fb8462e16cf37d97fa1e3324a7ad3ead638c52a563da330df20ff209bb31ea976c550b9e22c',6,5,'MyApp','[]',1,'2020-12-16 01:59:20','2020-12-16 01:59:20','2020-12-17 07:29:20'),('1459a0f28aead3d39210a320ff83b4573ae5672ec6846fa93cbf22146500692cdc89f66eb7d157d2',1,5,'MyApp','[]',1,'2020-12-15 05:16:06','2020-12-15 05:16:06','2020-12-16 10:46:06'),('14632cfe5a69f937f7ae5367bb99b6f70c722f4f08c7c98595d613eb6eb20d6506954daed9d830fd',2,5,'MyApp','[]',1,'2020-11-27 01:15:24','2020-11-27 01:15:24','2020-11-28 06:45:24'),('1512f84541f785346146b8205108bbc66277af611ca1f1a669d01647b3054fdd6a3551ff4550184b',8,14,'MyApp','[]',1,'2021-03-24 23:17:44','2021-03-24 23:17:44','2021-03-26 04:47:44'),('152d4d932a9a0be260ddc8e6a95c826a2888dd15d0fde51e069691cf91fc9cd2c7ec3175361d4541',1,5,'MyApp','[]',1,'2020-12-11 05:00:39','2020-12-11 05:00:39','2020-12-12 10:30:39'),('1541edf76e5010a803b264733df490223e5c118450d2055e0df0eb5853724fdb28de3e5f64ff64e6',10,11,'MyApp','[]',1,'2021-01-08 02:35:50','2021-01-08 02:35:50','2021-01-09 08:05:50'),('1550f17c915ac3ff3e6c1b0b8035ff4e2aff9bf2d3463d60864170f2a836afa6b5c411225d758a95',1,14,'MyApp','[]',1,'2021-05-03 23:24:09','2021-05-03 23:24:09','2021-05-05 04:54:09'),('159282cbac8e8eac17d82495270fb7257bff073dd9e66ea5dca3024ff66ddbf4fa02b7f4af436bf1',2,14,'MyApp','[]',1,'2021-04-07 06:39:50','2021-04-07 06:39:50','2021-04-08 12:09:49'),('1630d9d44702ff359044f27421d1d3596eef609633be09a5c32cf4a90e49c7983a25442c65c520c3',10,11,'MyApp','[]',1,'2021-02-05 00:05:19','2021-02-05 00:05:19','2021-02-06 05:35:18'),('1652232400544be344d40f6a529c3f99894a8599c376a89271fde4482c6bf3bd85905e431e0d8786',9,14,'MyApp','[]',1,'2021-04-07 05:17:38','2021-04-07 05:17:38','2021-04-08 10:47:37'),('1757e23db8ee5bd5585df071e0a8bda5c4967d83fa48abdac8bb18cdf9e56de1ce5bc7451f07f149',1,5,'MyApp','[]',1,'2020-11-11 05:12:29','2020-11-11 05:12:29','2020-11-12 10:42:27'),('17625d33a2738954d5d10aa54deef3eefd61e6ea212b29c5e1a50dbd6cb32bf15af8953ae9fcde0f',2,14,'MyApp','[]',1,'2021-03-25 00:08:41','2021-03-25 00:08:41','2021-03-26 05:38:41'),('176f6f70898d9e4dcda77bd40d8378e07e94e8431bb081f3e8f334f31f3d0ef9c2f1a6b78ce2216e',5,14,'MyApp','[]',1,'2021-05-07 03:42:52','2021-05-07 03:42:52','2021-05-08 09:12:52'),('17c71bf986c2246c6e709200c9a6827a3fbd5663785889312ec7481e5d83b1a3d8177d43dd9c1b53',1,5,'MyApp','[]',1,'2020-12-10 04:58:58','2020-12-10 04:58:58','2020-12-11 10:28:58'),('1811fb31958bc216969eb4ceda226180120e5d0821d9b2719836a6d22c8e006c62af712de222131b',3,5,'MyApp','[]',1,'2020-11-03 00:11:46','2020-11-03 00:11:46','2020-11-04 05:41:46'),('181a6ab9e6e151f17e15dca3758ef529a1fcf38480498fd70904d7084e1cdcfe4e19279730e5ed82',13,14,'MyApp','[]',1,'2021-03-17 00:06:45','2021-03-17 00:06:45','2021-03-18 05:36:45'),('18979fde15b2af0875fa1c54807be495a9e35b0f561cfdf570430eef53b4561a07ebf5e78c76dee2',3,11,'MyApp','[]',1,'2021-01-08 06:34:52','2021-01-08 06:34:52','2021-01-09 12:04:52'),('18d351825f736004821247cb5cb2e6396cdd4548a9fd8d8dac87413d4f570d871128c54283a41bec',8,14,'MyApp','[]',1,'2021-02-26 00:46:39','2021-02-26 00:46:39','2021-02-27 06:16:39'),('190233e62c917c4c79d243d6eae514fe80e22e8cdebcd8e064eb1706ed436ebff09f382a4ff81d24',4,14,'MyApp','[]',1,'2021-04-06 01:17:24','2021-04-06 01:17:24','2021-04-07 06:47:24'),('19320296aa3f769bc232135cff79b7047f1d9cab10227a6f0c153ddd7990cdd3fcfd4c61caa1096b',6,11,'MyApp','[]',0,'2021-01-11 22:37:01','2021-01-11 22:37:01','2021-01-13 04:07:01'),('194dc2ea5344bcde7a71fc3e194707023b055f746620cecc379853235caef0a6084881158c5fd139',8,5,'MyApp','[]',1,'2020-12-16 02:59:17','2020-12-16 02:59:17','2020-12-17 08:29:17'),('19556e5a9307134659cb05340a7e552adbd01a28150f774c6ac768d619feb52e6787004f171766df',18,14,'MyApp','[]',1,'2021-02-23 00:30:22','2021-02-23 00:30:22','2021-02-24 06:00:22'),('19f09d74b4f81bb1a0523136a2145497c6d583ff8bfb6b05aa86980f7b2f544b0fbca1089eb8c743',3,5,'MyApp','[]',1,'2020-10-15 04:05:41','2020-10-15 04:05:41','2020-10-16 09:35:41'),('1a23dadb83433dcb600cf344b7fc52892005087a824df8385747265c94f6c92d6ec166e95b64b612',1,5,'MyApp','[]',1,'2020-12-02 01:00:54','2020-12-02 01:00:54','2020-12-03 06:30:53'),('1a2ab934c39a96e0087e466dddfba871f27a40922427b9292a9a818a1ae2e3d33c51cf026c7e90bb',1,5,'MyApp','[]',1,'2020-10-29 00:20:30','2020-10-29 00:20:30','2020-10-30 05:50:30'),('1a43f14512dc3d12f1cadc1db40859b436e7a089c226d45749d9fc7e96be4947f14e108ec03ddc6b',1,14,'MyApp','[]',1,'2021-02-08 03:08:30','2021-02-08 03:08:30','2021-02-09 08:38:24'),('1a64e8d94a6e8c55fa22f11d049f1bdc454467675315b0e397e3f1e7cd2bb3cb6fd9bcf29d876f30',2,5,'MyApp','[]',1,'2020-10-26 03:16:33','2020-10-26 03:16:33','2020-10-27 08:46:32'),('1a765b6e17431ee2e2efdffe34a20c21c2430a787c9de87569b3128c8274aefbe5197214b0f4594c',10,11,'MyApp','[]',1,'2021-01-07 23:44:00','2021-01-07 23:44:00','2021-01-09 05:14:00'),('1aa747a719615cfbcce7f6440cde11393236bdfdf3519368a96b4b79716e2a204411fc4f9e4f3d09',1,14,'MyApp','[]',1,'2021-05-19 03:42:51','2021-05-19 03:42:51','2021-05-20 09:12:50'),('1ad5217b4a1df42a4b8e54ed11cb00c0fc7369a70ee594ca677c975e3eb2d96e71ac785ef9620ea6',2,11,'MyApp','[]',1,'2021-02-02 00:54:16','2021-02-02 00:54:16','2021-02-03 06:24:15'),('1afcfbca2b1dab773d0f7ffd64cd1a7acbc353c2b7877760baa6533661df58161864f2d029f24c6c',6,11,'MyApp','[]',1,'2021-01-06 05:23:26','2021-01-06 05:23:26','2021-01-07 10:53:26'),('1b0b3b10563f16b34e12bfc0a5faeaa6204f68d530aec8ad2dfa9b8fdb1be5d8ed2afa900959b263',2,11,'MyApp','[]',1,'2021-01-06 07:27:34','2021-01-06 07:27:34','2021-01-07 12:57:34'),('1b3ac26159c613e4f29099c140c8dc0a82ae598693c9448f1a98c9ccfbf1e7cb6bf8560e245b82c2',8,5,'MyApp','[]',1,'2020-11-13 03:00:06','2020-11-13 03:00:06','2020-11-14 08:30:06'),('1b433ec175e046e272696e6980b20613ac22a54216b3f81aa25b69dfcc0ef85856b5bc1edde54539',5,14,'MyApp','[]',1,'2021-03-24 23:15:49','2021-03-24 23:15:49','2021-03-26 04:45:49'),('1b4bfe15ecb804a9da4f50155bf2231bc9ecd69bdce74ab4dd729170f2c6f62e6f8c7637d3fc9a40',1,11,'MyApp','[]',1,'2021-01-07 02:58:53','2021-01-07 02:58:53','2021-01-08 08:28:53'),('1b531fe0ecd529a40099597754041bbb51bc350b7c299e7024aac297d9fa5cf749f9d0452a6a14da',6,5,'MyApp','[]',1,'2020-10-19 03:46:08','2020-10-19 03:46:08','2020-10-20 09:16:07'),('1b8b0b5b7da526d2a49f7542b454cc3982b42ef922c0162bea834db4cb36e60d6210c501ff1a87ab',18,14,'MyApp','[]',1,'2021-02-19 06:04:51','2021-02-19 06:04:51','2021-02-20 11:34:51'),('1c0fcafc8dc61a7b2f822a47afedc3a0a37c55f915499c48888266e876073fe891c97fa8e9f8a43d',2,5,'MyApp','[]',1,'2020-12-08 05:57:03','2020-12-08 05:57:03','2020-12-09 11:27:03'),('1c447dee22fc8222213d39fa6fe9c8fcb12b69e6ce295fa578fb0f12fd7ebf3cacb80e49397f1757',1,8,NULL,'[]',0,'2020-12-28 03:49:04','2020-12-28 03:49:04','2020-12-29 09:19:04'),('1c5d01eb3dcee769c432b5ed02fcbfb38fc9acda53da6865f2ee879ca369c061d32e48f0bbc92ec7',8,11,'MyApp','[]',1,'2021-01-14 00:05:15','2021-01-14 00:05:15','2021-01-15 05:35:15'),('1c74587bec20ab73baa78f72bf5e08478aacc4de9d7236de921e68110848e4d2b4020ee76b3c9cb1',5,5,'MyApp','[]',1,'2020-10-16 05:56:34','2020-10-16 05:56:34','2020-10-17 11:26:34'),('1c9f065b88f81979669c31a526d92e931ecb8d2a7188dd532b62c0098d5d305f108fe4736099884f',2,14,'MyApp','[]',1,'2021-06-04 07:34:49','2021-06-04 07:34:49','2021-06-05 13:04:49'),('1cbeb9e3eabce1941d162c687af5069000b958e69c4e8f931a22db2fe23c3abe3121073955265d0a',9,14,'MyApp','[]',1,'2021-03-17 00:13:53','2021-03-17 00:13:53','2021-03-18 05:43:53'),('1d187d8efa0957755d062cfcca30d80e2817329517b8b189c166e9921832b35640c31b8ada97bfa9',8,5,'MyApp','[]',1,'2020-10-20 07:38:36','2020-10-20 07:38:36','2020-10-21 13:08:36'),('1d3935065a87618a999b430be72d963a33651210dc19b6c2cc7838fde8ccce222c75895ff875ccc0',9,5,'MyApp','[]',1,'2020-12-16 02:30:00','2020-12-16 02:30:00','2020-12-17 08:00:00'),('1de5595c46bcbc8f79afbf98ad27101795090ad1cff43352f34b0c3fb907803bd433a588ee4bfbbd',9,5,'MyApp','[]',1,'2020-10-29 00:59:21','2020-10-29 00:59:21','2020-10-30 06:29:20'),('1e14324289eff9481ca24377aedd40cd3fcec06a8d6f6a1b65985adc8eb8a7b3be2ad7952f383163',1,5,'MyApp','[]',1,'2020-10-27 08:27:00','2020-10-27 08:27:00','2020-10-28 13:57:00'),('1e9afe6e5185b78ba4a9407c735d8ea154547b5a97facafec0ac15abf47c4f559835d3006c76e4db',1,5,'MyApp','[]',1,'2020-12-04 00:25:50','2020-12-04 00:25:50','2020-12-05 05:55:50'),('1e9d4a54a62d98941080640c00d794e5e25b7390b5e1e4ef5edb54c8faf9d3188edc5e75bd13f248',3,14,'MyApp','[]',1,'2021-03-01 04:51:21','2021-03-01 04:51:21','2021-03-02 10:21:20'),('1ec70d044d9d02e4e2bed532c9d3de4b3a1ae92b636e53620de8905cb98fd4903daf53df067719c4',3,5,'MyApp','[]',1,'2020-11-03 00:00:43','2020-11-03 00:00:43','2020-11-04 05:30:43'),('1edc3a31da8bcdf140ec61291c721f523eb49bc9e8373879e97702d6cf68a91cb4fd1762da568a0c',10,14,'MyApp','[]',1,'2021-02-08 00:26:32','2021-02-08 00:26:32','2021-02-09 05:56:31'),('1f03909ad5bb517c93bcf5a0781e9d2fb220442c77e29265ba55bfcc7d5a8b15d29fe3c44eb87b20',5,5,'MyApp','[]',1,'2020-11-25 22:43:57','2020-11-25 22:43:57','2020-11-27 04:13:57'),('1f5029112ad2854c0209d796193a127c49d9934f94e8fa38884e4d587f5e0833ad109a7f041ef22a',2,14,'MyApp','[]',1,'2021-05-13 01:23:27','2021-05-13 01:23:27','2021-05-14 06:53:27'),('1f5ec65a870f0a832f0abe98720e1612a5a67b0b9d8fb8a31cea0f2f58f8e33a46daa4161d85cab0',1,11,'MyApp','[]',1,'2021-01-27 01:14:29','2021-01-27 01:14:29','2021-01-28 06:44:27'),('1f78b22fd7272946c0ee7d8d7783d209611e01f2ad406c8ebf1d98ba4ca890a8e3f398055149e14f',1,11,'MyApp','[]',1,'2021-01-06 07:10:38','2021-01-06 07:10:38','2021-01-07 12:40:37'),('1ff4ef2a44d1fd6df4f5dedbff25486ab74b3d66becae753104a384973829f0fd574fd27ea3abd3c',1,5,'MyApp','[]',1,'2020-10-29 04:17:32','2020-10-29 04:17:32','2020-10-30 09:47:32'),('207099a661511dcea242e487e04dcc5ddbfed91b4da55b13401585ccc9f1748947e75edf3788718d',2,14,'MyApp','[]',1,'2021-02-22 00:56:19','2021-02-22 00:56:19','2021-02-23 06:26:19'),('2077721469a0cb5e1e59de08696db375a4e92b47383bb61298e2906d25d210e74f24e2b4aeeeec94',1,11,'MyApp','[]',0,'2021-01-05 22:27:13','2021-01-05 22:27:13','2021-01-07 03:57:12'),('207cbcbb8254a0bdbcaa05650a3a736e07cba20bf5d96489a961ed4b86d94076b6ed71c3a4ae6cf8',10,11,'MyApp','[]',1,'2021-01-07 07:29:02','2021-01-07 07:29:02','2021-01-08 12:59:02'),('208697e9fcdf87980eb0233a7a04c56982613b05e3a600878271deba265f5ad959f3ff6f17e8541a',8,11,'MyApp','[]',1,'2021-01-11 04:50:31','2021-01-11 04:50:31','2021-01-12 10:20:30'),('20a03473f71d5db8194d48b48196cc4af9832fb3ea5dd5c8bb3fe6813b095ffa756cc02126b124e7',6,5,'MyApp','[]',1,'2020-11-25 23:31:35','2020-11-25 23:31:35','2020-11-27 05:01:34'),('20c85ade69725ed044cea7a49b0bf5a6c955a78476542b7e8c5e9cce24d69a03795d63d1c9348e8e',2,14,'MyApp','[]',1,'2021-02-22 00:52:52','2021-02-22 00:52:52','2021-02-23 06:22:52'),('2114238a3a40d8a2966fd61506a59b1070ed09b9fd9dc04dc972d7082d454dbcfc74ee032f8c7315',4,5,'MyApp','[]',1,'2020-11-05 00:18:52','2020-11-05 00:18:52','2020-11-06 05:48:52'),('2115ce5c40ed238cb01ff881e477eb19379c0477869366a0143bfbf6a44584218b2167a06c80e58a',9,5,'MyApp','[]',1,'2020-11-17 23:31:45','2020-11-17 23:31:45','2020-11-19 05:01:44'),('21213f9e0d72435d92ec16e0d09256542a724db22beba64a005ef1a3907155ac248e93428b442347',8,5,'MyApp','[]',1,'2020-12-16 02:26:36','2020-12-16 02:26:36','2020-12-17 07:56:36'),('215de3543379831d7d882d889ea4c0835326654aa574060d5240296b4c36c8c5479fae3bceea0aca',2,5,'MyApp','[]',1,'2020-10-16 00:45:42','2020-10-16 00:45:42','2020-10-17 06:15:42'),('21b0933bd8f337ed61dca2dd336269159cff54435712a04408219142ac83d895ab2aa6e3ca527d5b',2,14,'MyApp','[]',1,'2021-02-23 01:23:17','2021-02-23 01:23:17','2021-02-24 06:53:17'),('21f9fafa751bd40c75c0086d89f29ee32ab7db6b98aef8b21b539167c080de47826525516b0e6f59',2,11,'MyApp','[]',1,'2021-01-28 03:07:02','2021-01-28 03:07:02','2021-01-29 08:37:02'),('224b291f53d3ebbe587907725c9bbcfd361af2c9be2337ff52ac0261ec7d0494624707a2f9a3c88e',2,14,'MyApp','[]',1,'2021-05-18 03:16:45','2021-05-18 03:16:45','2021-05-19 08:46:43'),('225d8c3a07b0c5845d097e9913cd171c97b85289405581dac08657c61e4a883d173b41e34f63e1f3',1,5,'MyApp','[]',1,'2020-12-16 04:35:09','2020-12-16 04:35:09','2020-12-17 10:05:09'),('22c0510f3f01bce4b9ffd41d4c0e92dcef0d727103fdd880a74c6907266ff81e377c3ce7a54d2a78',5,5,'MyApp','[]',1,'2020-12-11 04:59:56','2020-12-11 04:59:56','2020-12-12 10:29:55'),('22e899ce1fdacb98f1af8d6ecebcd26d774912e985d9402a4cc53ff9694d340e2f7fad8b4468012a',5,5,'MyApp','[]',1,'2020-10-26 01:16:46','2020-10-26 01:16:46','2020-10-27 06:46:45'),('23648dc68f1b74818f920e1d874b997472195c8c054c82fb8ec415991854d8dc64e8a06621bb42d5',2,14,'MyApp','[]',0,'2021-05-14 05:03:03','2021-05-14 05:03:03','2021-05-15 10:33:03'),('23c93821415213b79d73dddb5a25244d3fd9f62ae08a23abf1a260aeb0dad24a326aebb3c1f90ea9',3,5,'MyApp','[]',1,'2020-10-16 01:11:02','2020-10-16 01:11:02','2020-10-17 06:41:02'),('23f25dce62539268cc4afe42253df523ad90016c9b1735cefb1c5263a872be1b84db9ffb2f1841ea',10,14,'MyApp','[]',1,'2021-04-12 05:24:50','2021-04-12 05:24:50','2021-04-13 10:54:50'),('24441e5a5a17ad1f4c1e1b06ad4afed6c9ee6bc2f0a3cd77669c6f0552fea9c2e0cf26494c3908a3',10,14,'MyApp','[]',1,'2021-05-03 05:11:47','2021-05-03 05:11:47','2021-05-04 10:41:46'),('24512076077690166f9bd2430f63baafc6fb52c0b9b3361fc9f7991c6b26215c5278874b53cfa5b2',8,14,'MyApp','[]',1,'2021-03-17 03:43:02','2021-03-17 03:43:02','2021-03-18 09:13:02'),('247279df9a340f235cea3b9cc63bbae51109445646508068765d69f433d20b7a9122e13a7f20d470',1,11,'MyApp','[]',1,'2021-02-04 00:35:07','2021-02-04 00:35:07','2021-02-05 06:05:07'),('24bca5ea996314884f622221f3ab012eeeafe15d2a4558533a11836a20d9e9d20615fb1b0ecfcd68',2,14,'MyApp','[]',1,'2021-03-08 07:36:08','2021-03-08 07:36:08','2021-03-09 13:06:06'),('24e59bfb23c6d41cfc9e4ee0b44e4542d65a06454e81f7334294f510cd68b939740dee4d7e9bbf41',1,14,'MyApp','[]',1,'2021-02-23 03:07:32','2021-02-23 03:07:32','2021-02-24 08:37:32'),('250cfed999732ca49745d5fde7bd3525b3300e0a2d3ae2a36a6c8e79543dea58cabcfcd215af6212',8,14,'MyApp','[]',1,'2021-03-16 23:51:29','2021-03-16 23:51:29','2021-03-18 05:21:27'),('2557bdbe36da81ddc9e3c770915236b6ffabcaf012b0d72812166c705eaf3c1bdb6648e46211e2f3',1,14,'MyApp','[]',1,'2021-02-26 06:34:37','2021-02-26 06:34:37','2021-02-27 12:04:37'),('25741f9052c76de071c84d292eff397505bfe1acf60f7b8eb23a438a308af38edc69807c5db389ae',10,14,'MyApp','[]',1,'2021-04-12 06:28:58','2021-04-12 06:28:58','2021-04-13 11:58:58'),('25ad8993524d6f3a28f68c10db93a2923e44f7404fac041fd374c26963f0dc451fde681ae9d508fe',2,5,'MyApp','[]',1,'2020-12-22 04:40:03','2020-12-22 04:40:03','2020-12-23 10:10:03'),('260657e3c2e598fb2c2c738b2ce41f60bff7c4cb9713ce72a61985f4d9381b8911139868219707d4',1,5,'MyApp','[]',1,'2020-11-04 23:11:25','2020-11-04 23:11:25','2020-11-06 04:41:25'),('261af761cd62c928998a1a92facf1989dff3da6a0bd29efd84e2f05cd44ab4243c56eb3e819930d3',1,14,'MyApp','[]',1,'2021-05-13 03:25:19','2021-05-13 03:25:19','2021-05-14 08:55:18'),('2625d849a65d4103bec3b1d8799ffff6d6aa4854db990308de6504f6db033c0a4c25c5f2477be25a',4,14,'MyApp','[]',1,'2021-06-01 00:32:56','2021-06-01 00:32:56','2021-06-02 06:02:56'),('268ddb87df4d489f2ee23076c1a5abe562eee9e9006d1e3121c48e978fb88fbddc1aeb6f52563994',7,5,'MyApp','[]',1,'2020-10-29 01:30:56','2020-10-29 01:30:56','2020-10-30 07:00:56'),('268fda005286aa320bdf202afccf7387986866eb45bb821eb5f72242f592b5190ccefda92e8568db',8,11,'MyApp','[]',1,'2021-01-13 22:45:36','2021-01-13 22:45:36','2021-01-15 04:15:36'),('26ebe0b548a8b42d9694358cfefbc2cddcc3e54d48e465f1190c52e3a7f10332f765b7fd533b5be2',10,14,'MyApp','[]',1,'2021-05-14 06:02:32','2021-05-14 06:02:32','2021-05-15 11:32:32'),('27ac9166f332ac4739adaaa40ed879749f4f673e46f07607bb6cca063868f22ae2caeedc8855cf2a',3,11,'MyApp','[]',1,'2021-01-11 05:32:27','2021-01-11 05:32:27','2021-01-12 11:02:26'),('27c96882f83ff2d3f231c92b26698656856a6414977d36b2628d3efa21dc87d896a0e1f99160fd11',9,5,'MyApp','[]',1,'2020-10-21 03:54:59','2020-10-21 03:54:59','2020-10-22 09:24:59'),('283fab93213f9c8dcef81d169f853f0e79b506fe93e06951999035929c156f3eb9e7ce4f33d3d032',9,14,'MyApp','[]',1,'2021-05-10 00:28:57','2021-05-10 00:28:57','2021-05-11 05:58:57'),('288e9d4a8b580bf6f78e0dbab391790af2b166dbe0c0d3ddd9db8d5403cbbaf3a5c5482e31cfa4cf',9,11,'MyApp','[]',1,'2021-01-15 01:27:30','2021-01-15 01:27:30','2021-01-16 06:57:30'),('28c4759594799330a375be13b4ef0ad8d609580d2c1e9fbdeef0a03069a1d020d119ae1e35782ffc',6,5,'MyApp','[]',1,'2020-12-22 00:57:41','2020-12-22 00:57:41','2020-12-23 06:27:39'),('28c9153a8db2400768d4c7406471952e1cc7551e95df6587a868c3b59a65c7188ece85c40d57e8e7',9,5,'MyApp','[]',1,'2020-12-22 06:31:05','2020-12-22 06:31:05','2020-12-23 12:01:05'),('28cbe8ec9690f83ba4ea95b175e143200e6d2e8693524f348c7e0c71ab9319d3b0b0284702a53c64',6,5,'MyApp','[]',1,'2020-12-11 06:12:53','2020-12-11 06:12:53','2020-12-12 11:42:53'),('294a02c28791895686fad6087734fb38e3965aa797d4cfc0b32761185e92fdb05e494a5b54cf8bba',6,14,'MyApp','[]',1,'2021-05-10 03:34:38','2021-05-10 03:34:38','2021-05-11 09:04:37'),('2953a37eff4ff280e92e4de1b83ff78b7a663bf5b77567e75a2cba68ae86b02e8d932a0b7ba93885',2,5,'MyApp','[]',1,'2020-12-02 01:02:08','2020-12-02 01:02:08','2020-12-03 06:32:08'),('296b068b0b8b25a8e6d87cae0e4456300a8541095832570eab02b28838665caff98c6bf1300fd33a',6,14,'MyApp','[]',1,'2021-05-10 00:36:54','2021-05-10 00:36:54','2021-05-11 06:06:54'),('299c15dd29c34dfbffacda163681fa883f2fe7437eeeb4f970bd2cbe784314c4855a9eaf98be388d',6,14,'MyApp','[]',1,'2021-04-12 05:39:58','2021-04-12 05:39:58','2021-04-13 11:09:58'),('2a118d37589c76fa86737b1547fc0626210b3cbceccbdae163e1e511e84c34ba5302f4be0738daac',2,14,'MyApp','[]',1,'2021-02-09 04:25:46','2021-02-09 04:25:46','2021-02-10 09:55:45'),('2a610c18dcd69b788c1ed36ac7a007dfd419e1df9ad57d87102210d160f30f3c9d231b33f39b3b97',2,8,'MyApp','[]',1,'2020-12-28 04:27:33','2020-12-28 04:27:33','2020-12-29 09:57:33'),('2acbff6172be6cdf5587a74cca5caaee65046bd745f4663c11ae7f0bf2ea25ed85a2617e5c55a83e',6,14,'MyApp','[]',1,'2021-03-12 04:38:48','2021-03-12 04:38:48','2021-03-13 10:08:48'),('2af5dd4726e692434baf6955b2bda242f202ac52934ceced11ad0e935e67a3834a438288e6bd5bb4',3,5,'MyApp','[]',1,'2020-11-12 04:06:22','2020-11-12 04:06:22','2020-11-13 09:36:21'),('2bb06c6fdcb794845291ed2e70825fddf5d42b9d015c445da8eb003a0c562a1fc6efc6a92f670eca',9,11,'MyApp','[]',1,'2021-01-06 05:15:33','2021-01-06 05:15:33','2021-01-07 10:45:32'),('2bb1edf323dcd5de6f42193b641a772a4a0b7fe43acb408251c5ef71e5a7d36b970a5ab2a5fbbf24',8,5,'MyApp','[]',1,'2020-11-26 01:34:09','2020-11-26 01:34:09','2020-11-27 07:04:08'),('2c5aea5afe3d9fd0a8dcf46526ee0a1e4fcb44ce220fb2a1ccb00d0578abff484c5e7080058bbe5c',13,14,'MyApp','[]',1,'2021-03-12 04:21:03','2021-03-12 04:21:03','2021-03-13 09:51:02'),('2c5dd274f77ed75ba849f364d2c4f6222923e5dff012671f605c9b3627104589f4f91f04d433bec5',3,5,'MyApp','[]',1,'2020-10-14 00:14:49','2020-10-14 00:14:49','2020-10-15 05:44:49'),('2cbfa5171cdc552f8f3b31e3cec12d82ab3a5f2047127f66d7b0d63eb5f5e3f70f488d48b69a5f13',2,8,'MyApp','[]',1,'2021-01-04 23:49:07','2021-01-04 23:49:07','2021-01-06 05:19:07'),('2d80f13cd443c812b98a77d535e957683735998db574ec6db1b3d2581f63187626401e019b533f1b',5,5,'MyApp','[]',1,'2020-10-20 07:32:07','2020-10-20 07:32:07','2020-10-21 13:02:07'),('2e19b7789ba0a0457dcd8892d02f73ce1ec8373662f79ed478a0095f93fb425522f1fe7a2e5728fc',10,11,'MyApp','[]',1,'2021-01-24 23:34:44','2021-01-24 23:34:44','2021-01-26 05:04:42'),('2e2beb71c7d27c038bd8c79e067fd6903c2b69e12c49cd4fd883a59909dcdd17aa6fad8c1c822b2f',9,5,'MyApp','[]',1,'2020-10-21 03:56:58','2020-10-21 03:56:58','2020-10-22 09:26:58'),('2e3c547ea6bc20b044aacb0dfee1766d2ae4db9d025474c212cf9d9dfef330299d4431ddcf352968',4,5,'MyApp','[]',1,'2020-11-26 23:06:53','2020-11-26 23:06:53','2020-11-28 04:36:53'),('2e790298a27f8d4bdc9a2c16f367ed6b043e59e66ad40bc318dfe1e82e1ab844ff626a617e28d8a0',1,5,'MyApp','[]',1,'2020-11-04 05:19:18','2020-11-04 05:19:18','2020-11-05 10:49:18'),('2ea51225866b8295f31a0117f7bc2e1dc41bcee1197623d41ec7c05f66c5f5b1f3db82f6c7fd00ca',1,5,'MyApp','[]',1,'2020-10-13 04:11:24','2020-10-13 04:11:24','2020-10-14 09:41:23'),('2eb4700811806209f8b6b38010791975144dadafdf2e283e139bd5a2f6a5331dbceff3d68dab4beb',9,14,'MyApp','[]',1,'2021-05-18 06:02:57','2021-05-18 06:02:57','2021-05-19 11:32:57'),('2ed805180ea05ce72a2c2b503148e8bf2bd3fc3386a71e560b1ab3eeacfb25793d00d60256d18394',5,14,'MyApp','[]',1,'2021-06-11 01:07:37','2021-06-11 01:07:37','2021-06-12 06:37:36'),('2ed972927922a2d0f40dfefb52210a13f896411d7ff3659e62c680e3e80b0801d60c01b106e82074',2,11,'MyApp','[]',1,'2021-01-15 01:56:21','2021-01-15 01:56:21','2021-01-16 07:26:20'),('2ef3b2c35e16ae79f9bfbb05d9132e3ba2beededa8cf7f77df87bcec735a5b8d5a545861677e0138',8,14,'MyApp','[]',1,'2021-03-17 06:00:01','2021-03-17 06:00:01','2021-03-18 11:30:00'),('2f0e814fd38901335f547a739639cd7116cd1f8abbe12ee74f0a64d232e08516a10bfbd72ba33116',8,5,'MyApp','[]',1,'2020-10-23 05:46:09','2020-10-23 05:46:09','2020-10-24 11:16:08'),('2f482c4e86c23f0686d3373e8a58eacb9d48ab880f2f98fd45bf0442132a51b5d72239eaddac21e7',8,14,'MyApp','[]',1,'2021-06-11 01:09:59','2021-06-11 01:09:59','2021-06-12 06:39:58'),('2f5eda9744856ad75468f150c5d01720681c193067ecc84b4b39159a0c3d7108608cdbfeefcc30d0',1,14,'MyApp','[]',1,'2021-02-21 23:49:38','2021-02-21 23:49:38','2021-02-23 05:19:37'),('2fb602c64f38b7cd44776294ddf27b1d8c63e72c89184685752dbb43732b639fbbc40ee11ab0ae4f',2,14,'MyApp','[]',1,'2021-05-14 04:46:12','2021-05-14 04:46:12','2021-05-15 10:16:11'),('2fccc5a3a29c0447bc4d2d8ed68eb35ff08932c3f5c5e4d0eeed5db1bae5bbbbb6e9e96e07e10f04',2,5,'MyApp','[]',1,'2020-12-23 06:30:18','2020-12-23 06:30:18','2020-12-24 12:00:18'),('302aad183c23c54ac99bfee2464ac8a182409007edc7e83a6f6e4e3da252187464a21fccc792c69f',1,11,'MyApp','[]',1,'2021-01-21 06:46:26','2021-01-21 06:46:26','2021-01-22 12:16:26'),('309eaf1a660169c0d13d9dd6b4ba7df40e02d62e5d35dc1f0a54b9479bbc0b11347faab157f0ab62',1,5,'MyApp','[]',1,'2020-11-03 04:25:09','2020-11-03 04:25:09','2020-11-04 09:55:08'),('30a358937952ffd861b7358ae379ad1d88adccf68d13e877ed41956235d0153ec92860d48aee5c46',10,14,'MyApp','[]',0,'2021-05-14 06:20:49','2021-05-14 06:20:49','2021-05-15 11:50:47'),('30c6227f446f93a0e9041b583e8aac218b5d2b761fca83d158ebef5d6ceee02f8a8f4b34c9055cce',9,14,'MyApp','[]',1,'2021-05-10 23:48:27','2021-05-10 23:48:27','2021-05-12 05:18:26'),('30d64395384b96d137f48a5fcd0665c52d59cd7172d4569310becbeeb60fc955e16ccd9dad60561e',9,5,'MyApp','[]',1,'2020-11-12 01:07:37','2020-11-12 01:07:37','2020-11-13 06:37:36'),('30de6acbb86fe3a54cfad8671d5429bb0c6792590428eeede358973b1f776ea4674d9c7df994345c',1,14,'MyApp','[]',1,'2021-02-16 01:40:44','2021-02-16 01:40:44','2021-02-17 07:10:43'),('30ed250cbad5dd2ee15c905609d7a031ed8a93da8707ac772089c1fd4f4141dcdb7af88c88662731',10,14,'MyApp','[]',1,'2021-05-19 01:03:06','2021-05-19 01:03:06','2021-05-20 06:33:06'),('30f49c95e0d1eb26581c606f8674a96fdb3e1916cdd810a6a05f17143a9cc780249f64c55f7623d7',10,14,'MyApp','[]',1,'2021-03-12 04:58:29','2021-03-12 04:58:29','2021-03-13 10:28:29'),('30fd14954646808075975f3de91520eea1f51685649189ed9fe128847beab41cd2f847c889d69e86',10,14,'MyApp','[]',0,'2021-05-28 01:32:22','2021-05-28 01:32:22','2021-05-29 07:02:20'),('316a0b5fc8809f8905449dca6f8787d285c2752dd0155e534f024c17754de21052da4fe35b5b1de2',1,5,'MyApp','[]',1,'2020-10-15 06:13:13','2020-10-15 06:13:13','2020-10-16 11:43:13'),('31ac238be961b842d4cb5269fe46823777661d78780ab0ec66dfd584909ea12004933c8349118abb',8,14,'MyApp','[]',1,'2021-02-11 03:44:04','2021-02-11 03:44:04','2021-02-12 09:14:01'),('31b1966361f784648086f0ef9cf6b6eb4b97a2d0794729f05012a39a1153db0b4e14d363ad6af98f',2,11,'MyApp','[]',1,'2021-02-01 23:47:33','2021-02-01 23:47:33','2021-02-03 05:17:33'),('322a227e74ea10f4fa742f5660a52554dd79e3e43dba260e86fceb34271278356d2abfc854039e5b',9,5,'MyApp','[]',1,'2020-12-16 03:54:40','2020-12-16 03:54:40','2020-12-17 09:24:40'),('3335066fb237367cee140fa1a1b7d33e5cbb6b6ec65a9a5f698d498c4c9a14a5bc21dc4077b4afb1',8,14,'MyApp','[]',1,'2021-06-04 00:27:44','2021-06-04 00:27:44','2021-06-05 05:57:44'),('33367b085555bf8dda80a602004f5fe7e9044e56360c0fcc5dcf4dadfb016f69644f13377c322d81',5,5,'MyApp','[]',1,'2020-10-26 04:36:53','2020-10-26 04:36:53','2020-10-27 10:06:53'),('3377f7e1dc5480400ae13e4a139c9d493798fe483fdf05774676eeeea3f6be1e6d009896ed6c94b3',8,14,'MyApp','[]',1,'2021-04-20 06:41:01','2021-04-20 06:41:01','2021-04-21 12:11:01'),('33fd4916a2251a9b177d7e2049032217012f4167f4a0f237971a7c3eb3e6a56f6ff84cfdd9091b11',10,5,'MyApp','[]',1,'2020-12-10 03:41:29','2020-12-10 03:41:29','2020-12-11 09:11:29'),('346b8c93423516a2a271f44d82d9bee87a9d82246415704abdb5844cf438499076370d75e425aee3',3,5,'MyApp','[]',1,'2020-10-15 04:05:00','2020-10-15 04:05:00','2020-10-16 09:35:00'),('3482360f4c550b3bb5831ed8150f30f27571e3d74244a4ba36dafdd308bd8393e8bbdd0e45882867',9,5,'MyApp','[]',1,'2020-11-12 23:01:25','2020-11-12 23:01:25','2020-11-14 04:31:25'),('34886ea5bcc0aafbaf4a6844999c0f03ce44ad53f4fdab93be4ff448a52e1f19c5fc98afb5b0509a',8,11,'MyApp','[]',1,'2021-02-03 00:14:28','2021-02-03 00:14:28','2021-02-04 05:44:27'),('3498008e6f29bf828262838bdfec07628c7d8812fb606c872c3442c7569ee0a88de36a4ea9d4a6b4',6,5,'MyApp','[]',1,'2020-12-13 23:45:58','2020-12-13 23:45:58','2020-12-15 05:15:58'),('34f01b04e7b90737a2e6cce7d142b22efb1dff0aaaa2c17f37738ea77143cf0a0b22557db6adaeab',2,14,'MyApp','[]',1,'2021-03-24 22:58:48','2021-03-24 22:58:48','2021-03-26 04:28:48'),('350b8ef19db2a0ee72179bcef18f22e671ee906696319b9cc4eab662bfe55088fff48e065113dc8a',2,11,'MyApp','[]',1,'2021-02-01 23:36:19','2021-02-01 23:36:19','2021-02-03 05:06:18'),('351d862fbcba48520c88cb61ccb3566af672beea961ebc8db564e374b7d5cfe388e8f8944d0b4c19',10,5,'MyApp','[]',1,'2020-12-17 23:42:48','2020-12-17 23:42:48','2020-12-19 05:12:48'),('356b53b51559e77344de52b6a79be3a514927e8a259ad7a52d143f32c9d615c361b6d66b859548b4',10,5,'MyApp','[]',1,'2020-12-22 23:49:09','2020-12-22 23:49:09','2020-12-24 05:19:09'),('3579ab3388319f0dac2e0e95676eade7ceeadced12b686505bfb92e79c3ac909708ded3a9fa18b29',1,14,'MyApp','[]',1,'2021-03-15 22:55:45','2021-03-15 22:55:45','2021-03-17 04:25:42'),('35974127295876a7161c4a6ee4ebd32d8c523df7d7fe1daf35c15843f30a79d2d1f8a6f6bd0b3818',13,14,'MyApp','[]',1,'2021-04-20 06:41:38','2021-04-20 06:41:38','2021-04-21 12:11:38'),('35c734b0afdeeac406faff2035afd47af70d9fc43a561817a6050c36cbc256f15fa5a7237c513141',3,5,'MyApp','[]',1,'2020-10-15 06:33:35','2020-10-15 06:33:35','2020-10-16 12:03:35'),('35d32d4efa529a1f6046f6d6ad8d93f3130379e098c864fcf10142f6cdbfa4c0f8341b78153cd8f7',10,14,'MyApp','[]',1,'2021-02-11 03:50:27','2021-02-11 03:50:27','2021-02-12 09:20:27'),('35e7d62add9bddaafbbcf91130320b57b6c3def8afed9a251411840a7cc373bc4015c4e2e08dc54f',9,11,'MyApp','[]',1,'2021-01-21 23:46:12','2021-01-21 23:46:12','2021-01-23 05:16:12'),('370150d22245fa835081e77d3a0062ab208f5634a7d8c107671807e34e32e13f90b92df6b4e385c9',5,14,'MyApp','[]',1,'2021-05-06 23:10:35','2021-05-06 23:10:35','2021-05-08 04:40:35'),('370cde1c1af2a9a0b452ac56b3454b9309c15042ed23501b3cc789c3861f975f956838a11de98232',8,11,'MyApp','[]',1,'2021-01-06 05:21:35','2021-01-06 05:21:35','2021-01-07 10:51:34'),('3735ea819dff5db95c18b8271e461f35f85cf8df36d5715b107d69acef1bc08b7fb1605ddd316d0c',8,14,'MyApp','[]',1,'2021-05-10 23:47:17','2021-05-10 23:47:17','2021-05-12 05:17:17'),('3737769bf8ccd9d6956ee9141b29e9f0d861f6fc46927d0eca42b837c41d53467a2cb333a49a8858',2,14,'MyApp','[]',1,'2021-05-31 04:12:12','2021-05-31 04:12:12','2021-06-01 09:42:10'),('373f7384882646346451e290b14de97deab1f6de1b1b3c3198614444fe28a5cef0a76ac5883811b9',9,14,'MyApp','[]',1,'2021-05-10 23:45:52','2021-05-10 23:45:52','2021-05-12 05:15:52'),('3786834459402ed7f487231d40875ed616789876b467819e17f352a84c3aa254fc778b90f88e40c1',5,5,'MyApp','[]',1,'2020-11-05 00:22:59','2020-11-05 00:22:59','2020-11-06 05:52:59'),('37e4e1782dd166e8bcaeda3cc401d077bc32e17d142fe084618230d45a98af64fa377e463b4b7541',2,14,'MyApp','[]',1,'2021-03-17 00:37:51','2021-03-17 00:37:51','2021-03-18 06:07:50'),('37fa8ae674890efdb3b467f889a2bd93731f8e2d0a3a58a26e1db3a12f4e453f2fa80bac4a2df9c5',8,11,'MyApp','[]',1,'2021-01-21 23:47:32','2021-01-21 23:47:32','2021-01-23 05:17:32'),('381399950aa2011a7029eadb96e04c999cf7ecf3aef0a07df3e14e1cc8deb92977dac8f3013c26c1',2,8,'MyApp','[]',1,'2021-01-05 03:42:34','2021-01-05 03:42:34','2021-01-06 09:12:34'),('381ad79d02d1c311c8ff3d7d1a2e826958b148ae9d45ddcee19cf0db3ba403bd9bd0750a573f6fd4',4,11,'MyApp','[]',1,'2021-01-21 04:57:18','2021-01-21 04:57:18','2021-01-22 10:27:17'),('383a60845375175d71d50583dabb082f6f48d10171e60875819e65edac53c2f6dbd9fac9ddda74b5',9,5,'MyApp','[]',1,'2020-11-04 05:17:28','2020-11-04 05:17:28','2020-11-05 10:47:28'),('3889536dd0e9e924627f81fb99be732aaf4684b0407daf78cc593ec60f4f52aebad73927df57be6e',2,5,'MyApp','[]',1,'2020-12-04 00:26:44','2020-12-04 00:26:44','2020-12-05 05:56:44'),('389157d4c2b64fb1d211f589046afcd44f7a6fa24e96f441cc521cc21102deb2bd6db4cfa3933cd3',8,11,'MyApp','[]',1,'2021-01-25 05:50:27','2021-01-25 05:50:27','2021-01-26 11:20:27'),('390b4515be9038b18f9357d9965503ae36d516dc7a1d172d21e3146df3744ee77736861dba967c8d',6,14,'MyApp','[]',1,'2021-02-25 06:03:11','2021-02-25 06:03:11','2021-02-26 11:33:11'),('39139f61cc4785e513f58774f8d4f67929ddca12a3c8a2423776ca7a93dfc40609014a50c62cf944',9,11,'MyApp','[]',1,'2021-01-15 01:26:28','2021-01-15 01:26:28','2021-01-16 06:56:28'),('391c3df0f335034301f30ee6a63db634d54228d73dd615c645d2c4324eb62cdb2c19f6f3c08e73b7',1,11,'MyApp','[]',0,'2021-01-06 22:48:41','2021-01-06 22:48:41','2021-01-08 04:18:40'),('3950b26fcccf0277dbc811fc26f0b102c5a8a1f4eceb23343ad451b7a041c173004e1e95d4dc9d0d',1,11,'MyApp','[]',1,'2021-01-21 03:16:47','2021-01-21 03:16:47','2021-01-22 08:46:47'),('39742275b6c30638d74a801adda900ed3513d8c97542cb58212db742d2ad233390f6bf230228f3e8',1,5,'MyApp','[]',1,'2020-11-05 00:49:01','2020-11-05 00:49:01','2020-11-06 06:19:01'),('3a000e6560b02f0feb0634410b158c499463ca2fd124e9ca8151aab5e72a489bdc97d0bccf3f7850',3,14,'MyApp','[]',1,'2021-05-28 05:14:53','2021-05-28 05:14:53','2021-05-29 10:44:52'),('3a14d84220a2b41567c51cdca926d1c19001bd6a8cfb8bc79653ad6af7b597bbf47c65c45381ea5f',3,14,'MyApp','[]',1,'2021-05-14 06:00:29','2021-05-14 06:00:29','2021-05-15 11:30:28'),('3a506f46b680b9139b9b76fea6c41514add773996846985dd3b164991eddc6961ee7e761eb59c52b',6,14,'MyApp','[]',1,'2021-04-13 04:19:13','2021-04-13 04:19:13','2021-04-14 09:49:12'),('3a6b1768bd9746ed463562e86fee77ce00005dc22839f9a458ca2052015487c1a760da5b472d1137',2,5,'MyApp','[]',1,'2020-11-26 05:15:18','2020-11-26 05:15:18','2020-11-27 10:45:18'),('3a74a32c64a76f0ca89b6fb460be78ff1d7cd452d8e636db24ad6cb9d5320898c03698bbfda6ce4e',1,5,'MyApp','[]',0,'2020-11-30 05:40:30','2020-11-30 05:40:30','2020-12-01 11:10:30'),('3ab4e3ddac85813c3a0f6125282a82759746d369eeb8f6a9e2a0a1e2196cbec301382c3b66685351',8,11,'MyApp','[]',1,'2021-01-21 23:32:00','2021-01-21 23:32:00','2021-01-23 05:01:59'),('3ae97d9db45ef34991f5cd742fe20c4f8981ec6940b2d00fe2aef67b3613c95ebdbbb1b860eec366',2,14,'MyApp','[]',1,'2021-05-12 05:19:59','2021-05-12 05:19:59','2021-05-13 10:49:57'),('3b07c32de0e69c038080b6dd9de46c43ad9804f7d2495d5a4fee7b36323fe531061679d933150fdc',8,11,'MyApp','[]',1,'2021-01-14 01:12:53','2021-01-14 01:12:53','2021-01-15 06:42:52'),('3b3554ab02d702f9e166634631a10c43ab716b36689ddafbf8107b72cc2ff99c9ff7a706eaa72df0',10,11,'MyApp','[]',1,'2021-01-17 23:15:28','2021-01-17 23:15:28','2021-01-19 04:45:25'),('3b3a2570bcd87d98a20905023f26fbbd4972201953b21496f7271dd7f454ea8046c0d36d1be4d76d',4,5,'MyApp','[]',1,'2020-10-21 00:11:13','2020-10-21 00:11:13','2020-10-22 05:41:13'),('3b9efd72f76844b0d5e3f71255fa6edfdc45eaef8970de290198c4860f74914810c66a21b4ee81db',6,14,'MyApp','[]',1,'2021-05-10 05:05:10','2021-05-10 05:05:10','2021-05-11 10:35:07'),('3c5742496a6951b503ab4e659261a78dda3c8aa3ffaf9eb6b7df26362f2587cf6aedc2906fd3fe28',9,14,'MyApp','[]',0,'2021-04-14 00:08:18','2021-04-14 00:08:18','2021-04-15 05:38:17'),('3c5db44f24e76095b1bf39805d596f684fc34c19c01962181f691939b406f61fee83024ca9861b66',1,5,'MyApp','[]',1,'2020-12-11 00:50:42','2020-12-11 00:50:42','2020-12-12 06:20:40'),('3cf23ca171fc78024c143b7ba0aa291311c5d5088ad40908790547c1cfce38dc1c8cecad807f0a45',2,14,'MyApp','[]',1,'2021-03-12 01:53:41','2021-03-12 01:53:41','2021-03-13 07:23:40'),('3d5b737d6254109edc34e96a6f8ed60df19868a604189d2a515f7471767542c92fbf72123d914881',2,14,'MyApp','[]',1,'2021-03-16 07:25:05','2021-03-16 07:25:05','2021-03-17 12:55:05'),('3dc120b3fb6bda2ddaab5a657e40ef9845f5477dcfb92b2e5a82ccc6af1a55f42082ff4ef592d33f',6,14,'MyApp','[]',1,'2021-04-21 23:35:45','2021-04-21 23:35:45','2021-04-23 05:05:45'),('3dfee0003c92c30d8f93dae1fd8b8608d6af27b0c2ea3d7e9343ab59519277a801a5a9bd695c5222',6,5,'MyApp','[]',1,'2020-10-16 05:07:10','2020-10-16 05:07:10','2020-10-17 10:37:09'),('3e11dacf1e5f4c7708cfb6e94a5e8314ef73341f0dcca44f1ba814fad076ef02d20dbdd9ad9b4ddd',10,14,'MyApp','[]',1,'2021-03-30 03:22:29','2021-03-30 03:22:29','2021-03-31 08:52:28'),('3e1feaa843dd47b0248cc040720489d5ee408dd48e8aaeb49e77735133879fab21b789b39bb6d8b8',4,11,'MyApp','[]',1,'2021-01-08 06:36:51','2021-01-08 06:36:51','2021-01-09 12:06:51'),('3e34b934261be581d5143a899b76f7be2c30f402b158356a0605a4dcc1052322fb932dd6f8d299c8',2,5,'MyApp','[]',1,'2020-12-04 01:00:25','2020-12-04 01:00:25','2020-12-05 06:30:25'),('3e6d9ba987edfc70df7efed6a194dd012c3722d31059b861441d370a99b1a3069d24bcd2c148f6c1',2,14,'MyApp','[]',1,'2021-03-30 03:31:51','2021-03-30 03:31:51','2021-03-31 09:01:51'),('3e7eaa01ff1b4a8f307202c617c4254304a2874ac5ce1032c7785f19ac67471a7515e38881be4991',6,5,'MyApp','[]',1,'2020-12-16 02:24:35','2020-12-16 02:24:35','2020-12-17 07:54:34'),('3f921db66b76e3d1b745b30c32107f4ffa7d43c13f1fd0c01699ed65200fb180208120b96a75301d',2,5,'MyApp','[]',1,'2020-12-08 05:12:22','2020-12-08 05:12:22','2020-12-09 10:42:22'),('3fcc944f616887649ffae851e7f296b463bb0e9cfd9c9ad68f6073048bd17d791c1848098db9fb26',8,14,'MyApp','[]',1,'2021-04-28 23:05:17','2021-04-28 23:05:17','2021-04-30 04:35:16'),('3fd8ac7959afb510c52d0c971b84dcef7c06dbce2a078cad65ead56e341fc073ca8edca78e72e895',8,11,'MyApp','[]',1,'2021-01-14 01:18:16','2021-01-14 01:18:16','2021-01-15 06:48:16'),('403ef02eef65ac25ee75d752b19d4895d9bc7e58ea6031f48a98dc17bbf5d81a8b73d338f5623bb3',1,5,'MyApp','[]',1,'2020-10-16 05:09:01','2020-10-16 05:09:01','2020-10-17 10:39:01'),('40a1f4b05a073fda4fc2e829b3cb52147ce19d28d2ba69be7d1aa468ca2df7f5ee7cf8646645f19d',6,14,'MyApp','[]',1,'2021-04-12 06:17:05','2021-04-12 06:17:05','2021-04-13 11:47:04'),('40a7c256631f6105a999d107c24a142f4f4316ee6a5e51fd44f8949f04500460dfbb0f8f9961d27a',1,11,'MyApp','[]',1,'2021-02-03 03:28:26','2021-02-03 03:28:26','2021-02-04 08:58:26'),('40bb63ecd12f9e0d19941da6d8a29e60793b0aa551e43487761223d96ac0207725c3fc2f3c0f3403',6,5,'MyApp','[]',1,'2020-10-23 04:07:45','2020-10-23 04:07:45','2020-10-24 09:37:45'),('411febffdc52f1227bb743a2d092efc066566d5becb96a67a30a09ae229b5d06b0538171b68e5fa2',1,14,'MyApp','[]',1,'2021-03-02 01:15:47','2021-03-02 01:15:47','2021-03-03 06:45:47'),('41632e0107ee1f41f87a2fd033373898c2c02ad602f5ce4d23eae68abfc7f031a90af7dedcb2e2e5',2,14,'MyApp','[]',1,'2021-04-05 01:17:04','2021-04-05 01:17:04','2021-04-06 06:47:00'),('41fe2b738b8962b1e84763eb8a27a0288a62aba08b9d39daf9bca05adc398fa331615d8fee5f5668',2,8,'MyApp','[]',1,'2021-01-04 03:28:32','2021-01-04 03:28:32','2021-01-05 08:58:31'),('422c613b46b17a1a7bf052cc9eff13348f97cd9e4f4796c4baa78ebc33fb8b5527a75d9872f79bb6',8,5,'MyApp','[]',1,'2020-11-12 03:48:50','2020-11-12 03:48:50','2020-11-13 09:18:49'),('4241ed15d8be9d2faf7957da9990822291d2da7d9037a5d6f3aedbdd883ada2bb407c98afb49c928',2,5,'MyApp','[]',1,'2020-10-12 04:36:04','2020-10-12 04:36:04','2020-10-13 10:06:04'),('429068e0b5f27b7abf82e859567fe7d464b12e6043213de61ba2a7e99cc0fcf76631853ad46d50de',3,8,'MyApp','[]',1,'2021-01-04 04:44:47','2021-01-04 04:44:47','2021-01-05 10:14:47'),('42ea5e1160c1e2c098d847918f6d2e96a90ae2153f97eb3fb6e4ccdadfc05d474a7a5e0b0cf6498f',6,11,'MyApp','[]',1,'2021-02-03 03:28:07','2021-02-03 03:28:07','2021-02-04 08:58:06'),('42fb0a501db8447cf1f7054159ecd8e8ef2eba218c2b83d101eb322bd6c7fb5ab47078b94f7549a5',4,14,'MyApp','[]',1,'2021-03-17 00:04:07','2021-03-17 00:04:07','2021-03-18 05:34:07'),('4324fd6f9fae9bc1c607bb4204f43c73103f5bef4711c86cce7f8954e9253d94734aa5f2ba67c913',10,11,'MyApp','[]',1,'2021-02-04 04:47:28','2021-02-04 04:47:28','2021-02-05 10:17:27'),('43556af804b3f06eb5fa1331dcd9387c6a1eb149b4e867f99e033c4af70b247054c77a4306f94171',8,5,'MyApp','[]',1,'2020-12-22 06:11:34','2020-12-22 06:11:34','2020-12-23 11:41:34'),('438b30297a68c094c15c5ec7b8d179f60ecf243c4de07018b8b6b16df83e6b8bd20e0444ff2228f6',12,11,'MyApp','[]',1,'2021-01-22 00:03:49','2021-01-22 00:03:49','2021-01-23 05:33:48'),('43cde0044204baa40cf9e2eef186c5f79906765623187b516513ad0949e7627f7356e0704f20e313',9,14,'MyApp','[]',1,'2021-05-12 00:56:43','2021-05-12 00:56:43','2021-05-13 06:26:43'),('442480f8b5b955d96eaaea418f0eed885c5c5624ae54146f461ae9c0ea479dd87a2da8042025712f',4,11,'MyApp','[]',1,'2021-01-15 01:13:17','2021-01-15 01:13:17','2021-01-16 06:43:17'),('44c4839373884c1bf790d9305ede1decf60f060280a7cd08e4e59b525c79293e1491a62c92cacecc',2,5,'MyApp','[]',1,'2020-12-04 03:03:20','2020-12-04 03:03:20','2020-12-05 08:33:20'),('44ddcf84b070b7bd5e0d4034776b6b496413319981f7985f6d2cc503a781fed05acb979ee5e6c9d0',3,5,'MyApp','[]',1,'2020-10-13 05:33:59','2020-10-13 05:33:59','2020-10-14 11:03:59'),('44f0176eb2be30efa9efd6d369e240fc7ee6b163b21d8c598f79a170ee850fa6871b971c149da374',1,8,'MyApp','[]',1,'2021-01-05 06:55:59','2021-01-05 06:55:59','2021-01-06 12:25:58'),('4577ea2b808412e2c8d695167404b5def6f3a1dddb3f53c62c0c88d6b23f4a6a1bbd510a6cf56986',6,14,'MyApp','[]',1,'2021-02-26 06:59:44','2021-02-26 06:59:44','2021-02-27 12:29:44'),('459facdbb447f43160c5bb144fe3f45c0dd5b6c1970286c331e6a6d8b5595bd4c9292ffb9a4b2fa3',8,14,'MyApp','[]',1,'2021-04-22 00:36:08','2021-04-22 00:36:08','2021-04-23 06:06:08'),('45c59ce6c2e0e14501477a7320a814dedbf7e6f132669011d4344fb2ce326fe28e53e5716549e58f',2,11,'MyApp','[]',1,'2021-01-06 03:52:42','2021-01-06 03:52:42','2021-01-07 09:22:42'),('45c5ab69448e6663c334c869322698c6ad3fd94a9bc2a09dfb0945ecdd03598db0aa42e6fa50f6bd',2,5,'MyApp','[]',1,'2020-12-16 03:05:19','2020-12-16 03:05:19','2020-12-17 08:35:19'),('45cca4839dcf52625221740649d6b270844cc62209075aec999497735162b95f1300cb741587a117',10,14,'MyApp','[]',1,'2021-04-12 23:36:18','2021-04-12 23:36:18','2021-04-14 05:06:18'),('45ddce2902d81c713b727c67bcff6879fea5a0e1ff0c2cd96c9f37423403aec359bc5b5d91952c21',3,5,'MyApp','[]',1,'2020-11-05 00:19:50','2020-11-05 00:19:50','2020-11-06 05:49:49'),('462a56381010ee5f31f6d2480a439cb6bdbe95ebc7e52e0dfd9a4f68e9d9cb95ff8bf500b4cfd09b',8,5,'MyApp','[]',1,'2020-10-21 03:17:26','2020-10-21 03:17:26','2020-10-22 08:47:26'),('46966e0dce73020c25071d56a2311fd31fa0407b9343d6d0895cd871f9935957b83a750d43d7c1bc',10,14,'MyApp','[]',1,'2021-05-14 05:14:54','2021-05-14 05:14:54','2021-05-15 10:44:53'),('46aa6bd71fa9e9350339c25683e4cb2b75f662305db795e57191319a0134a7172a6cbc5fdedf39b4',2,14,'MyApp','[]',1,'2021-06-02 00:41:00','2021-06-02 00:41:00','2021-06-03 06:10:59'),('46c10d6326979818ca2eff266bbd4af2396e494e692142578a99f96fd3de74fe17dfb66c5d49ad59',3,14,'MyApp','[]',1,'2021-03-12 02:01:26','2021-03-12 02:01:26','2021-03-13 07:31:26'),('477700883433c8379934f41b6cc239513abdae52dbd0e985cca1ae291ab28fc1b74c35191c5dd947',6,5,'MyApp','[]',1,'2020-10-26 00:03:49','2020-10-26 00:03:49','2020-10-27 05:33:49'),('4793df04e418f688e9ae1464bca8147eabce601145ad959036e1656d8651f246945219225db2907c',10,5,'MyApp','[]',1,'2020-12-16 23:41:31','2020-12-16 23:41:31','2020-12-18 05:11:31'),('4799a72f9d2e407d368256a5b12ef58cca6f6816dfeac34365397805cb254382b46f888f5a006176',9,5,'MyApp','[]',1,'2020-12-16 02:47:27','2020-12-16 02:47:27','2020-12-17 08:17:27'),('48021e161c9b55917ec79d4f261cac5ac0b57dd9e4c3dd7a2422e67712d3912e2f617c3da30c811a',6,5,'MyApp','[]',1,'2020-12-16 02:25:02','2020-12-16 02:25:02','2020-12-17 07:55:02'),('4817aacf2589565ec879113a8a849950fb5e49e741bd5a3aa619b8f9e26baf9df87719beaab7f009',8,8,'MyApp','[]',1,'2021-01-04 05:28:07','2021-01-04 05:28:07','2021-01-05 10:58:07'),('4823a243025cb9d6df3500c7b5564a3f06dd633e03db8827ad81fbd686d03365274333ba8e925d4c',7,14,'MyApp','[]',1,'2021-05-30 23:33:05','2021-05-30 23:33:05','2021-06-01 05:03:04'),('485f3fae7a6bbdbf3af600ced09f5bd98a6b83105d150e5ec818415ffa5f729de4895e95d0575703',1,14,'MyApp','[]',1,'2021-06-09 00:01:55','2021-06-09 00:01:55','2021-06-10 05:31:48'),('48b143118dac2c0cd8c6b6fb0a040f5be1adc125964038fa496d6868bab192e81091578e80284465',8,11,'MyApp','[]',1,'2021-02-03 06:07:02','2021-02-03 06:07:02','2021-02-04 11:37:02'),('48c0c183f9b4fcdf64ea60ed4f1a1a53e055a0e3d169077be01dc8f0c93a6f2cc7b241540d1a9fa6',10,14,'MyApp','[]',1,'2021-02-16 00:23:51','2021-02-16 00:23:51','2021-02-17 05:53:51'),('48c19a46ffbe98ff82144548dae64f20ef449848b69e9c3647a9320e56038b6f16f3adfbdddb7e9a',4,14,'MyApp','[]',1,'2021-04-07 06:59:00','2021-04-07 06:59:00','2021-04-08 12:29:00'),('49378a183c0e4980763e63eb9fe07be370c31ae0de99149b6b85ad301071174602a7f96c4f501ef7',6,11,'MyApp','[]',1,'2021-01-11 05:35:11','2021-01-11 05:35:11','2021-01-12 11:05:11'),('496fbb295bd17bea385776c6cf10d758e5d8104d764c349ca78f679631cefd31694ab9a5b0eef935',1,5,'MyApp','[]',1,'2020-10-12 22:46:20','2020-10-12 22:46:20','2020-10-14 04:16:17'),('49b81d9c99dff4ca9fc001f5ad2eaceaad2cd5a9006bdd92c1b652ec69d2e8f9dcc849fae2055ab0',4,14,'MyApp','[]',1,'2021-05-04 04:09:07','2021-05-04 04:09:07','2021-05-05 09:39:07'),('49d7d12dd865d4fd9ac47f0870811c1b3c51b310be494a69fd8e0661a18be863a2299c27995fa042',2,5,'MyApp','[]',1,'2020-12-23 23:42:21','2020-12-23 23:42:21','2020-12-25 05:12:18'),('4a8f0f88062bb73b39beaf2d6694cf784f6b8d3f7142eab0b51a6a06824eb36bb8dfb846809f5b2a',7,5,'MyApp','[]',1,'2020-10-29 00:18:00','2020-10-29 00:18:00','2020-10-30 05:48:00'),('4a9369c57981f8720710d55ffc9b4a5acd7d9d312182aebe604b3c30ef4e8b45b5550ee1457e0cee',3,5,'MyApp','[]',1,'2020-12-11 04:58:12','2020-12-11 04:58:12','2020-12-12 10:28:12'),('4aa2ecb37937db66a64a01354b5b3aa64296abc1c0034d5294d562cd3e3f3d3f9d8c289c71449c5e',9,14,'MyApp','[]',1,'2021-03-01 05:12:53','2021-03-01 05:12:53','2021-03-02 10:42:53'),('4aab78ea89cefbe11dc5148db6df828bf8c0f25c2e729621d5f217693cc0c6640a595533b35d2757',4,14,'MyApp','[]',1,'2021-05-07 03:31:02','2021-05-07 03:31:02','2021-05-08 09:01:02'),('4af2c66cde9266df56333df36986644c78ed5fe99c1096c3773cf034b6b7a31c12f2f1633c787728',5,5,'MyApp','[]',1,'2020-12-11 05:01:36','2020-12-11 05:01:36','2020-12-12 10:31:36'),('4b3060fa17e923b20985188a1177f8923877986703ae84587528ef437109dfb054889cd61ee6da4b',3,5,'MyApp','[]',1,'2020-11-12 05:00:07','2020-11-12 05:00:07','2020-11-13 10:30:07'),('4b49ddd4c0b8e31d0dfa045b3d2d78c044bbf4baf3e6e2513e7dfd08c08e8f17bda138fe08307777',2,14,'MyApp','[]',1,'2021-05-11 23:51:59','2021-05-11 23:51:59','2021-05-13 05:21:59'),('4b83bbe2fdb291d8a4f53975fbcbc71736c46701443632ed02221e718132f131697d0d957fd85f91',6,14,'MyApp','[]',1,'2021-05-12 05:59:01','2021-05-12 05:59:01','2021-05-13 11:28:58'),('4b846104e2bf045fe761778145f2f7af06b5b8b2b93d429b77a3b8546ab89c2592306ee1928095cf',9,14,'MyApp','[]',1,'2021-04-06 01:05:21','2021-04-06 01:05:21','2021-04-07 06:35:20'),('4be986197e4fb72162736345072c4d7dcd3d495affa67546f73db027787442d9c86f34c7689bba5c',8,14,'MyApp','[]',1,'2021-06-02 00:55:21','2021-06-02 00:55:21','2021-06-03 06:25:21'),('4c4a34ca25edcbe64d0d283f555b75ff537b1d934ddfc325d7337d04d4cf982dfe4f7ac896c13d20',2,5,'MyApp','[]',1,'2020-10-13 05:35:29','2020-10-13 05:35:29','2020-10-14 11:05:28'),('4c9844b59272bf86b5304a078a83091996fdc68dd060def67603ce71788abc4ca330336c5caa5eca',8,11,'MyApp','[]',1,'2021-01-12 07:31:27','2021-01-12 07:31:27','2021-01-13 13:01:27'),('4ce4e4faa2419471c53c2efd3f6e930d810165f4fcf4dcb1775620f5c760484d652e7e6089a783e9',5,5,'MyApp','[]',1,'2020-12-22 05:43:04','2020-12-22 05:43:04','2020-12-23 11:13:04'),('4cea1f74ee9550c1b1b68cc872b3df70066e7de72e2b47b9af711bacdea45f9511b6e34091b58bf0',2,5,'MyApp','[]',1,'2020-11-26 05:16:49','2020-11-26 05:16:49','2020-11-27 10:46:49'),('4d046f6f8b00288f33f32f0f37f2dbd905ed59ab2c8f7a3f4c01f86f607823d858bfd1d193150cd8',1,11,'MyApp','[]',0,'2021-01-06 06:07:35','2021-01-06 06:07:35','2021-01-07 11:37:35'),('4d182cfc607d1d3a5be8f605675d12473f1bbcbc98ccf8067eb394f103419c6d56b2356eca2abc62',2,14,'MyApp','[]',1,'2021-04-07 06:57:32','2021-04-07 06:57:32','2021-04-08 12:27:31'),('4d2e26789483c456125b7ecf9761881bc6068bcdd5ff1e5d5e3f63abfe1bdd34f03e4533f406b799',9,5,'MyApp','[]',1,'2020-11-05 00:11:16','2020-11-05 00:11:16','2020-11-06 05:41:16'),('4d6cfe35135213d611146acf0b5a149ccd4f5b870d792afcfeda2f4abb9590bb189e38ef91b60d5a',2,11,'MyApp','[]',1,'2021-02-03 05:49:53','2021-02-03 05:49:53','2021-02-04 11:19:52'),('4d80f75c11088a058916be3fa370f2b8bb3fe9b30ede7437425cd952083bf8f4210e9940f1f78c15',1,5,'MyApp','[]',1,'2020-11-20 04:40:41','2020-11-20 04:40:41','2020-11-21 10:10:41'),('4e4eeb87db3e18404cd876b972fa86a0959cd7e89872c3128d04de0dc7709471b33720517f3c3cce',8,14,'MyApp','[]',1,'2021-02-10 03:47:37','2021-02-10 03:47:37','2021-02-11 09:17:34'),('4e57d862a37efb3e903f999971d9f75f2accd921788cd31613d9d74de7dfcee63393ad9e400495e2',2,14,'MyApp','[]',1,'2021-03-10 05:35:29','2021-03-10 05:35:29','2021-03-11 11:05:29'),('4e9a978b29407a24f358fe1c99a22e8b6dab6d66f23e74685e40d59783869021025167757f5f1ae5',5,5,'MyApp','[]',1,'2020-10-29 04:18:26','2020-10-29 04:18:26','2020-10-30 09:48:26'),('4e9b0cd1087b8ba1d66cbe7f2ee848da592b6e13943fcfbe0924f112bba4210d782684a201c3018e',6,5,'MyApp','[]',1,'2020-10-26 04:35:05','2020-10-26 04:35:05','2020-10-27 10:05:04'),('4eca942d65c7c8c1dffc85fbf6c0d3e41a8b4ebca1a978b141161a34dddfc181e5945ac68716cd18',10,11,'MyApp','[]',1,'2021-02-04 23:54:11','2021-02-04 23:54:11','2021-02-06 05:24:11'),('4edeef4bf5db12a160fe47f92c0812d463e1ef90feab31464195065bd262f901efc48a0b8e5b1bf5',2,5,'MyApp','[]',1,'2020-12-16 03:06:28','2020-12-16 03:06:28','2020-12-17 08:36:28'),('4ef5c5faa0c990e8f6a3d05b36d82a23aca49339d425c15551aeabf37aeb0c6d3dea005222298247',6,14,'MyApp','[]',1,'2021-02-25 04:05:28','2021-02-25 04:05:28','2021-02-26 09:35:27'),('4f1fb5a3bcde1ba5b6aebb69ddcdb11dd25f323e258b007209cf5242a761b400f7c7f91bfbff1fc7',9,14,'MyApp','[]',1,'2021-03-18 07:34:36','2021-03-18 07:34:36','2021-03-19 13:04:36'),('4f8387b268547a38376068d1b87c36cf5afc8ad4ef2e6496a2364f83e7c07528d60d9329b24128b8',2,5,'MyApp','[]',1,'2020-12-10 05:01:39','2020-12-10 05:01:39','2020-12-11 10:31:39'),('500d7af31b665762b7780208020ef13905d781eac5081383722d7087940688680f7cd86385ff50c8',1,11,'MyApp','[]',1,'2021-02-02 23:22:13','2021-02-02 23:22:13','2021-02-04 04:52:13'),('508725b31989f69ba880a3387466a1d6b550a7fa6b5b1cb74ca4cef4363efc9d8c7f14e4e58ff8ca',3,5,'MyApp','[]',1,'2020-10-26 03:26:16','2020-10-26 03:26:16','2020-10-27 08:56:16'),('508f97293cee84d949c1339aec1e9524955207eee8a37161c287f8cbcea29a613018173e1e9c0e63',1,5,'MyApp','[]',1,'2020-12-18 08:47:01','2020-12-18 08:47:01','2020-12-19 14:17:01'),('50c74dee70eaffce1b6f576cb83886cdd87ab2859677c0714cccbc20024c6b7826a23920e5e2b05f',4,5,'MyApp','[]',1,'2020-10-26 04:35:43','2020-10-26 04:35:43','2020-10-27 10:05:43'),('50e540563adceb0fffde6bca972dd2496af9e6094610ddf7c357d49e03952c935dba12bd8450a0c7',1,8,'MyApp','[]',1,'2021-01-04 23:50:56','2021-01-04 23:50:56','2021-01-06 05:20:56'),('50ea5c138cc57f9cf322789171bdc9759eeb4a4dc06d0a32e859a21c9e13bd511a41529a798f0ba3',2,5,'MyApp','[]',1,'2020-10-12 23:31:11','2020-10-12 23:31:11','2020-10-14 05:01:11'),('512b70829092d179c026d7b0389e41ce6f016e0b0581d145b00bfd1377f70b1497a6400da10c80f5',6,14,'MyApp','[]',1,'2021-05-07 02:11:01','2021-05-07 02:11:01','2021-05-08 07:41:01'),('5135a0f40e7576999a42bfdb4354b8fc3714fd2fee12daa868a39990907387bdc7cdc02dade965ce',9,5,'MyApp','[]',1,'2020-11-12 05:05:01','2020-11-12 05:05:01','2020-11-13 10:35:01'),('514355bc1eb61d92e11ee4ad71fdf38f9f00f356fdf5865e800155d621e1ff898eb298c86f85cf27',6,14,'MyApp','[]',1,'2021-06-02 00:51:24','2021-06-02 00:51:24','2021-06-03 06:21:24'),('51e2049280cebe182106e0608cce1c5c064ae564e99bb4554ba7fcba1b36eee11eb9151d0a0708b8',13,14,'MyApp','[]',1,'2021-06-11 01:06:11','2021-06-11 01:06:11','2021-06-12 06:36:11'),('51e205bc9abccdc71d3ce1a02e824d6f2932aae63219addbbeb479434f6a5a8f0c9733a4a0b0826e',9,5,'MyApp','[]',1,'2020-12-11 05:09:19','2020-12-11 05:09:19','2020-12-12 10:39:19'),('520d3d81f6f85a5cc023bd5c40c12002d9450c38fcf791ca4f4551d825237f8881ebadc5a7a67c5d',3,5,'MyApp','[]',1,'2020-10-26 03:37:06','2020-10-26 03:37:06','2020-10-27 09:07:05'),('523b9dc6e4de6ecd1b28f9933c79c5b83b1d7b609c1dbb7d13945245283aac1a07e32eccdca6e934',1,5,'MyApp','[]',1,'2020-11-04 00:01:16','2020-11-04 00:01:16','2020-11-05 05:31:15'),('524b6f36bf8f47a579a4b64a36d7dc1e0fc594a76471dbdec0b8f4c9962fb90c20daa685992696cc',9,5,'MyApp','[]',1,'2020-10-26 23:19:56','2020-10-26 23:19:56','2020-10-28 04:49:56'),('52502a8895a0d6cfc43c5674fe9451d164d5f817ed3bf827d57524eab9e8260898cec73bc896372b',1,14,'MyApp','[]',1,'2021-04-21 06:59:42','2021-04-21 06:59:42','2021-04-22 12:29:42'),('52a74c55cd6bdd30bb16c6b6727ebc5b8d928c6885f63afef1f9176cdb76cfb3ae662ad23ab42264',9,14,'MyApp','[]',1,'2021-03-24 23:18:30','2021-03-24 23:18:30','2021-03-26 04:48:30'),('52b0eea5baca857ddabd66563b879792a2245556d91cd44d438e1c5a782d01acb66f00d24c9cdd15',6,14,'MyApp','[]',1,'2021-02-25 04:43:33','2021-02-25 04:43:33','2021-02-26 10:13:32'),('52ca886b1e747c4ea68bddb6d3a5cd234114018abf4c2b68a24694497fca249c5eccf35215ac5d94',9,14,'MyApp','[]',1,'2021-04-12 04:44:56','2021-04-12 04:44:56','2021-04-13 10:14:55'),('534782fe6385704a30aeb86b4092100128e67bd2d6f09f0bc30b425c7db22bf37d3dad1ae6f32e43',8,5,'MyApp','[]',1,'2020-11-19 04:51:08','2020-11-19 04:51:08','2020-11-20 10:21:08'),('535b36d5eca8432eeb10c90745938bc384552610d1836e88597a88f1479c52344a28562a68db6115',10,14,'MyApp','[]',1,'2021-06-11 02:32:50','2021-06-11 02:32:50','2021-06-12 08:02:50'),('536a4190956cb3bfbb2aca6dc76beb2b702584cd943172a8f77866107cd6e0bc913cab96458b0ecf',1,14,'MyApp','[]',1,'2021-05-13 03:20:11','2021-05-13 03:20:11','2021-05-14 08:50:11'),('537bdfbaefa3b9ba722a58504ef7ccc7340136c1d5103315e8b3175dbe63a13f9a22295fd07fc37d',1,5,'MyApp','[]',1,'2020-12-15 22:50:55','2020-12-15 22:50:55','2020-12-17 04:20:54'),('53931124cfbaf6b528d937c8812e77bdc955cb2c5e6654c89cb0d1c65f524cc8db8f420f26506a51',1,11,'MyApp','[]',1,'2021-01-07 00:50:15','2021-01-07 00:50:15','2021-01-08 06:20:15'),('53b5464d76a7102624d3de5e99b9796f838c9d32afe497da61d41110da0a8be19e61a6d7b43085ff',2,14,'MyApp','[]',1,'2021-04-21 03:19:10','2021-04-21 03:19:10','2021-04-22 08:49:10'),('53b68adfd684dd927865a80841daf0b943a3c1c29574612baf5d7cad7aca6405481e7b631beb7fb5',6,11,'MyApp','[]',1,'2021-01-19 03:08:39','2021-01-19 03:08:39','2021-01-20 08:38:38'),('53c79369370dcc1b184b746b8ee67545fa7bb049b2dc2de4cb3bd52d118bb52b22f7fb8b14506964',18,14,'MyApp','[]',1,'2021-02-22 01:50:05','2021-02-22 01:50:05','2021-02-23 07:20:05'),('53e7c698fa259e8b753f449d77b712dc60fa3253584c950551b86cdeca0dc46e40542c16b5e36340',2,11,'MyApp','[]',1,'2021-02-03 00:15:07','2021-02-03 00:15:07','2021-02-04 05:45:07'),('542456a3ce7394e6c304f32f0ee9f8196573d86a3fffdf98a7c9f59071ab6429a0c2dbee674637cc',6,11,'MyApp','[]',1,'2021-01-11 06:42:00','2021-01-11 06:42:00','2021-01-12 12:12:00'),('543ab6d7817e5152b938fd48d7065c4385065dc552e62af33dc8a280616bb8333d3d12aacf94a7a9',5,11,'MyApp','[]',1,'2021-01-15 01:15:17','2021-01-15 01:15:17','2021-01-16 06:45:17'),('551669886575ff16b89f62c0e5fac1c83f72e5e1fbc9b4d21a1c1f61a6b916274722a674f921fea1',2,11,'MyApp','[]',1,'2021-01-28 06:58:07','2021-01-28 06:58:07','2021-01-29 12:28:07'),('554389bad668781d59a51a9f7035755b66bcf5ca1531f4fcf1b35d1a32a7df62ca5e7f191e99525a',9,14,'MyApp','[]',1,'2021-06-02 00:53:59','2021-06-02 00:53:59','2021-06-03 06:23:59'),('558f0b11f2d4c833db9a3410005da210c39eadc3df2b54b3cf4f542456d542f0bc8c5b47f259daef',1,5,'MyApp','[]',1,'2020-12-02 03:54:14','2020-12-02 03:54:14','2020-12-03 09:24:14'),('55953b20160e8aa2a5661883a56fe4d11d456244a6c0ab8be6d0ad3138ec0766b493162c4462d09e',6,11,'MyApp','[]',1,'2021-01-18 07:24:44','2021-01-18 07:24:44','2021-01-19 12:54:44'),('55ae974ebc7449b0d20bd01512d2497c9212eab8e9fc65de64e96e0375cb8812475f0dca333c3779',6,8,'MyApp','[]',1,'2021-01-04 04:56:34','2021-01-04 04:56:34','2021-01-05 10:26:34'),('566170e68f79dbc788fdebc188b11bb5a49945f79e8d290d44e7b4b798b49f333a3dfff2430fe6d7',10,14,'MyApp','[]',1,'2021-03-25 06:06:06','2021-03-25 06:06:06','2021-03-26 11:36:05'),('567fed90fef3f3752cc90821a664a0efc3516109f90f4aaf3cc77835e5335c26d4c441311c837d9e',10,11,'MyApp','[]',1,'2021-01-07 23:58:06','2021-01-07 23:58:06','2021-01-09 05:28:06'),('5682688a1ff74f2fa4d2a9ad67ec65b3b9763da58ae2694250c6fe788fbdd530acf987682855818f',2,14,'MyApp','[]',1,'2021-06-02 00:57:29','2021-06-02 00:57:29','2021-06-03 06:27:29'),('56934e0703d7326e10dde30461fe92bc299b29745e049699f6f195fcd86a6debb7d3e07d79bd8e59',10,14,'MyApp','[]',1,'2021-03-22 23:05:16','2021-03-22 23:05:16','2021-03-24 04:35:14'),('576324a20e6cba0739fdbb9f8d3f9d8ea5200fe76591271f42e6d2e375a188c08a26de0b29104eb1',13,14,'MyApp','[]',1,'2021-03-24 23:11:54','2021-03-24 23:11:54','2021-03-26 04:41:53'),('57cadf63101623c6fe8a520812a2c666b710d1941050fab2755c70e0740d336ae1e946952bde6f0b',1,14,'MyApp','[]',1,'2021-05-31 06:11:53','2021-05-31 06:11:53','2021-06-01 11:41:53'),('587cf44c1d1961bdfcf6361eae6082022e2468fdcca0add9691d80e6606d63aa296d23a43636f9b9',9,5,'MyApp','[]',1,'2020-11-04 00:10:06','2020-11-04 00:10:06','2020-11-05 05:40:06'),('591e7d3aaf677393ffe4860ea8cebba45cf8c2e990778044a981e98a104f6b26bbcdf92d542cfa26',8,11,'MyApp','[]',1,'2021-01-14 23:38:24','2021-01-14 23:38:24','2021-01-16 05:08:24'),('59360a43072cf176a1348f181c0c4601a02cde8378406c0ac24f5b99148bdaa3bf4b55b21576ff78',2,5,'MyApp','[]',1,'2020-12-01 23:24:50','2020-12-01 23:24:50','2020-12-03 04:54:49'),('597ddff43dad00f30c414cd120c3110cb14e138fe0104ec21197d6339136fb020d39808847df3111',6,5,'MyApp','[]',1,'2020-10-22 00:00:30','2020-10-22 00:00:30','2020-10-23 05:30:28'),('59a7c724c05dacf72baceb4d5bb3d7a5e8c41e794013a4fce9888b1876d706df484021e0ba8c5d18',9,14,'MyApp','[]',1,'2021-04-21 23:39:01','2021-04-21 23:39:01','2021-04-23 05:09:00'),('59ad760000f8d75040781f230dedd4a8a935f90398e810ef2c4a34f2e18a1f598470164a676f64af',4,14,'MyApp','[]',1,'2021-03-12 04:18:22','2021-03-12 04:18:22','2021-03-13 09:48:22'),('5a2a06d1f77093da9bb90378ac9dc98f2ff5c17df81d1872fe801dfa20c725149b4ceac18e948ce6',6,14,'MyApp','[]',1,'2021-03-08 02:02:49','2021-03-08 02:02:49','2021-03-09 07:32:49'),('5a9e8ec177c2fb48b7f889e3b923da942caed7e482070feb83fbd09b405aa66d492203fb1793e24e',8,14,'MyApp','[]',1,'2021-04-12 06:52:44','2021-04-12 06:52:44','2021-04-13 12:22:43'),('5ac70e3793117c60655348fe06e167540a213faf93c34982a5a2259e0ecddab5b884623c73e49904',8,5,'MyApp','[]',0,'2020-11-25 04:15:44','2020-11-25 04:15:44','2020-11-26 09:45:42'),('5b3dc84a3d4c6d25c45cf4281642b6c4c18e2aa31d1bdf27e4a216d466ef01a40bdfa4b92f755509',5,5,'MyApp','[]',1,'2020-10-20 02:06:05','2020-10-20 02:06:05','2020-10-21 07:36:05'),('5b4f1574bc8b7088037daa465c726ef6c08ce77f3878ccea29d860cea8fad2f451125f1c16df2d7d',9,8,'MyApp','[]',1,'2021-01-04 05:14:07','2021-01-04 05:14:07','2021-01-05 10:44:07'),('5b5079c3574ddfafeb1fc8f047e6dc631b3b9740e19b9a6fbfb7fc407eb711453ca350dc3f905bb6',10,14,'MyApp','[]',1,'2021-02-23 06:21:47','2021-02-23 06:21:47','2021-02-24 11:51:47'),('5beaeeed9234659e23a205f5c9d4e0f2da3ab79e636f5424861c9cdc8c36eeef6b01a25f895cc46a',2,5,'MyApp','[]',1,'2020-12-10 04:17:01','2020-12-10 04:17:01','2020-12-11 09:47:01'),('5c5eb816756c6177f9eecb3f48695fa69e00e123ae64dd89e56b7cb8accbca2af59981049359c1a5',1,11,'MyApp','[]',1,'2021-01-05 07:07:51','2021-01-05 07:07:51','2021-01-06 12:37:51'),('5ccd82d75094f5b64888b1bb4493d9293666dbba489760ed291f4591f3ef61ecc67d57100f7e4245',1,14,'MyApp','[]',1,'2021-04-07 23:21:55','2021-04-07 23:21:55','2021-04-09 04:51:54'),('5d063e30ebca2a9c27fac9382bef7463118df9c13cf7fbc8e198c84c056126934f6572199afa642a',4,14,'MyApp','[]',1,'2021-03-24 23:07:34','2021-03-24 23:07:34','2021-03-26 04:37:34'),('5d35f4159158e75ba83512f06eabeb3b9b512a774430ffc0448b33e72a0fcef2ec77a51d46327270',2,14,'MyApp','[]',0,'2021-03-08 07:38:02','2021-03-08 07:38:02','2021-03-09 13:08:01'),('5d616c5c351ba19d08e8cca784022ef8e72d875fdd5d2d4865f970e045252cb8ce020242d10744e0',9,5,'MyApp','[]',1,'2020-12-16 02:33:12','2020-12-16 02:33:12','2020-12-17 08:03:12'),('5d87885728c1fb86c18796d982833f10b1aa396eeecafd4445e8e7fccfd3cdd8941569e0deb4b261',4,11,'MyApp','[]',1,'2021-01-08 06:25:23','2021-01-08 06:25:23','2021-01-09 11:55:23'),('5d8792e8de56724fa4ff53b205e9e138bc7463d7abf01b18ce610ffce24141bd937548e69d9a55d6',8,14,'MyApp','[]',1,'2021-04-13 00:45:59','2021-04-13 00:45:59','2021-04-14 06:15:58'),('5dabccee60d7c25ed6e39581f5cb311f97be9a1ccde7597686bbd8dc1a72441c7d6e1798d19a3a0c',3,5,'MyApp','[]',1,'2020-10-15 05:28:04','2020-10-15 05:28:04','2020-10-16 10:58:04'),('5dcfc156b19b8db4ae1a0fdbb3dcc1812656201dd5b24ce6c1b7b2e8d976339257cab8e5e72dda49',5,8,'MyApp','[]',1,'2021-01-04 03:49:13','2021-01-04 03:49:13','2021-01-05 09:19:12'),('5e08b6febc40eee47791f4743ff8a37f5bf84a2b61b7b1616a1883778ac2c8a5812702201256a12a',1,14,'MyApp','[]',1,'2021-04-12 23:06:00','2021-04-12 23:06:00','2021-04-14 04:35:59'),('5eafcd4138e0a61410dcc05a1c133bbc0731922a48fec72a92f41c02837e12cd1bf49cf0731c6673',1,14,'MyApp','[]',1,'2021-05-02 23:42:08','2021-05-02 23:42:08','2021-05-04 05:12:08'),('5eda622dd4a98c0ee36be653bb2929fbb8a783720e6f9852fdb07cc92070653894b1725daa54baee',3,5,'MyApp','[]',1,'2020-12-16 01:51:34','2020-12-16 01:51:34','2020-12-17 07:21:34'),('5ee18b3b270f688420cf08480d21b9071e742e0f011a524226c8e2e57bafe809c4276660fc72e9bf',6,11,'MyApp','[]',1,'2021-01-14 00:09:53','2021-01-14 00:09:53','2021-01-15 05:39:53'),('5f01668b88f090d4901598a171c7608b32087e6515a8cdebd1d15e9abd3efc488bbc9b9561294136',1,14,'MyApp','[]',1,'2021-02-11 05:27:49','2021-02-11 05:27:49','2021-02-12 10:57:49'),('5fad05f70f3c5af43ab70968ed61fa84e1a265d06519ab9e595646b1851d27976ab1677938c47279',1,11,'MyApp','[]',1,'2021-01-11 23:23:43','2021-01-11 23:23:43','2021-01-13 04:53:42'),('5fdb65d7e609f784309e2309e0bb632ddfcb1af0fed3947845bb3046da8c7374d651c0acffe12568',3,5,'MyApp','[]',1,'2020-10-16 00:44:43','2020-10-16 00:44:43','2020-10-17 06:14:43'),('60070f81af3be182b9914fd90760b042b3e47b4232c9c35f6032309a74b33c5b07f08d60344bbc92',5,14,'MyApp','[]',1,'2021-04-21 23:34:54','2021-04-21 23:34:54','2021-04-23 05:04:54'),('6022f95814f12b308ae0d770f51a1886e0bfc37e7902f1e95843117ecc645b5c41288cb4ca674605',8,5,'MyApp','[]',1,'2020-12-13 23:38:55','2020-12-13 23:38:55','2020-12-15 05:08:55'),('60a7aa3571677cb8cb598e409764d08ec654bb55ff9f342e248cdc888e41e05fc7f09e5fde52b0dc',6,14,'MyApp','[]',1,'2021-06-02 00:50:08','2021-06-02 00:50:08','2021-06-03 06:20:08'),('60bd64019496fe05b7d5557756744d2887906e18211fa032c097ff6eca86a8622504b752d2e73aba',1,5,'MyApp','[]',1,'2020-12-10 05:01:20','2020-12-10 05:01:20','2020-12-11 10:31:20'),('60d70c1833b8ebe1ffc30f1fd11357d6646ff6befb83ac5813f91b35a2281b94c776a194f562d753',8,11,'MyApp','[]',1,'2021-01-08 05:40:26','2021-01-08 05:40:26','2021-01-09 11:10:26'),('60f7f082c46ebba996f1eb7652ffd01ae3b0270ac77a6e3babfd3a808616cbe7623f466a8a1fc891',2,14,'MyApp','[]',1,'2021-03-12 03:22:05','2021-03-12 03:22:05','2021-03-13 08:52:04'),('61847fa3ac24b981706c856add03b0adbda9aca17c817dcceff80bfb51e1d7043e1c7c19d11ca476',8,8,'MyApp','[]',1,'2021-01-04 06:59:14','2021-01-04 06:59:14','2021-01-05 12:29:13'),('61ace1a099328353e4824b3aa57ca15b04ef151ad07875563e275222303818f3f458e7a0f9b97098',9,5,'MyApp','[]',1,'2020-11-04 05:16:22','2020-11-04 05:16:22','2020-11-05 10:46:22'),('61c1e5ddc4416bb8c9f2d1512233930148bb721b9d99ba39ad6f49c9ad51cf953c14f6238c2bb7cb',8,5,'MyApp','[]',0,'2020-11-23 00:37:31','2020-11-23 00:37:31','2020-11-24 06:07:29'),('621afdd29941041b4e1424c25fe8b0461ce99c36e327149a41773e8018c93555c9b7314cb5903c05',3,14,'MyApp','[]',1,'2021-04-06 01:16:07','2021-04-06 01:16:07','2021-04-07 06:46:07'),('621eb2b20abb495b20296ba5bf5159bc5093e7dccb7d547953ae279b8d8ac2135faa24394be81d09',1,5,'MyApp','[]',1,'2020-11-18 03:31:28','2020-11-18 03:31:28','2020-11-19 09:01:28'),('625d9c623bec818e3e91990bdfbb49096f4699e61ac2da228eef8c5fcfc8d73263950e9c2ec5f947',10,14,'MyApp','[]',1,'2021-03-23 06:50:10','2021-03-23 06:50:10','2021-03-24 12:20:10'),('629b7343ab4877d1be3ad70a9849ae0356e62b9b78e05abee96187eca1d0fdbeaaf8de300ad5dc98',8,11,'MyApp','[]',1,'2021-01-14 22:59:33','2021-01-14 22:59:33','2021-01-16 04:29:33'),('62efc5eae777ec22e5769197fee6b5907159bb2c2143739068875509f17a61bb81050a7377e9a368',9,14,'MyApp','[]',1,'2021-02-23 03:15:09','2021-02-23 03:15:09','2021-02-24 08:45:09'),('62fc7727fc910b23982d19f2448b803ba63ba4c0e161235da06afaea60400d1e1d9f4034739b7e15',10,5,'MyApp','[]',1,'2020-12-23 05:46:14','2020-12-23 05:46:14','2020-12-24 11:16:14'),('6315e7c8ced7f8d18d4ea83c04bb65c0760eedf5fec959f1bb526f498e46445e18ab6e2e3e4aea0c',5,5,'MyApp','[]',1,'2020-11-12 04:05:52','2020-11-12 04:05:52','2020-11-13 09:35:52'),('631aa08da0aa7ebda1ff9fb7d5c4f35119af3a43ca0f4c1a9069f424365762fdfcd4b7023b15d6a9',2,14,'MyApp','[]',1,'2021-05-07 03:21:01','2021-05-07 03:21:01','2021-05-08 08:51:01'),('634a6984ca245bc2e71567d4fa5056633c6837d4ef94f739caac2fd2694baffcd20ede8166fa51bf',10,14,'MyApp','[]',1,'2021-02-09 01:38:15','2021-02-09 01:38:15','2021-02-10 07:08:15'),('63a6ce30c6623d41717ce0e44b8f0ca33ec5c13a1dda5897ab6bd3b2aff65d368df080341b8cf43e',2,11,'MyApp','[]',1,'2021-01-14 22:44:51','2021-01-14 22:44:51','2021-01-16 04:14:51'),('642dfb918e49c526365fe27494874884779e52e929810276ff0b283231cb7f1b8a637ba4391d4195',10,5,'MyApp','[]',1,'2020-12-21 00:53:51','2020-12-21 00:53:51','2020-12-22 06:23:51'),('646041844d397904c0aaf472bb52fcf76d4f19dea30f6b4c5e40c7df2f95fb0be41462de548556a2',8,14,'MyApp','[]',1,'2021-04-06 00:48:08','2021-04-06 00:48:08','2021-04-07 06:18:06'),('649b651634653ecc310b3750ede1bb8d81fa0ac1aa81ba5829e8568ff7dd42758ed1a51a0d486bf5',10,14,'MyApp','[]',0,'2021-02-26 07:05:54','2021-02-26 07:05:54','2021-02-27 12:35:54'),('64e1044e67aa0b048f443e6c4f12367222467ed189e2e55c3cd9d4994cc87ea6d8d29b4631ce6b0d',9,5,'MyApp','[]',1,'2020-11-13 04:01:18','2020-11-13 04:01:18','2020-11-14 09:31:18'),('64f2fd9fac09c6db08fca7bceade34f67a8a309d2572c8dcca259a0f03639f6d03bfedf52e4ad199',9,11,'MyApp','[]',1,'2021-01-05 23:09:24','2021-01-05 23:09:24','2021-01-07 04:39:24'),('6526efba65387ae64f58f27142d64f73383350c3a3bb8ef4a897a5b295067785a75dec5be7b6ab03',2,14,'MyApp','[]',1,'2021-05-03 05:48:26','2021-05-03 05:48:26','2021-05-04 11:18:25'),('65379b6bae3697037ccd7dcb2dee3222446436e565c4b3002062ff2cacdbe1ac4fa4e201e4cf3099',1,5,'MyApp','[]',1,'2020-10-12 23:15:17','2020-10-12 23:15:17','2020-10-14 04:45:17'),('65452ee0c6ff77b3b421e9f492ea1a414712c9346baa95398385e242316ff2ca66c17a04e511f08d',8,5,'MyApp','[]',1,'2020-11-25 05:51:41','2020-11-25 05:51:41','2020-11-26 11:21:40'),('655a857eaa5b8a1ea70101eea5bed81ed41ac16292de297affdfc9ed8b482ec09b795f5c40f29ec3',6,14,'MyApp','[]',1,'2021-02-25 05:53:52','2021-02-25 05:53:52','2021-02-26 11:23:52'),('657ae21a4b3d0039cafbeecf76e36f9c43cf5c08e446e00d08ae994146436fe6fe0145cd579a3645',2,11,'MyApp','[]',1,'2021-01-14 23:11:06','2021-01-14 23:11:06','2021-01-16 04:41:06'),('65a03ae122d71ff4d8e213479029a4b74e8e9ff83de9ff8e8ed5bcf5fb43cd9a1faa4f3cc47be400',1,11,'MyApp','[]',1,'2021-01-05 07:15:22','2021-01-05 07:15:22','2021-01-06 12:45:21'),('65dfe9d1c546c62df8d27e3a8476f9541bd5b143047d020a0cb7c6c3e10dbf9c8359717c3fa45acf',3,14,'MyApp','[]',1,'2021-04-21 06:32:56','2021-04-21 06:32:56','2021-04-22 12:02:55'),('66099767a25bd6a300ed46a2128c7cb3d50f9e9ba4f1416d40d760ea63684a868465c009b4a2fe2d',6,5,'MyApp','[]',1,'2020-10-26 04:56:33','2020-10-26 04:56:33','2020-10-27 10:26:33'),('663689e7c5ffd0890f335c12c60c1d70c6950e25a95a90a74ab2930ec1716d5d5b92eb9cdc040377',1,5,'MyApp','[]',1,'2020-11-04 03:37:21','2020-11-04 03:37:21','2020-11-05 09:07:20'),('6649be2e526d41e44f0e02f369c3010eb3b00dd1a5fc83e2091e258c0ba743fd4ec21808bd56e199',8,14,'MyApp','[]',1,'2021-04-20 03:06:36','2021-04-20 03:06:36','2021-04-21 08:36:33'),('666134f8d28e055b09206a774df531cc60ac7bd26bef64776600ed58468bd1cfa7deeafa97a9dc75',8,5,'MyApp','[]',1,'2020-11-19 04:50:03','2020-11-19 04:50:03','2020-11-20 10:20:03'),('66a1fef2e795c530a8482a26106495ad84a3c8f683b7c82b547e17e5f8f849bedd76f52fb932c838',2,11,'MyApp','[]',1,'2021-01-06 07:24:52','2021-01-06 07:24:52','2021-01-07 12:54:52'),('671df0a36f7001dc6fcdeeed0f62342a4d6bc9f40afa22124f0585ba230aeaaa79d347480ed5a051',4,14,'MyApp','[]',1,'2021-03-18 02:17:52','2021-03-18 02:17:52','2021-03-19 07:47:52'),('673617b74b1d90a511a301a4a6dcb0d9be128f000bb65e26304a1ac10a76e5f7a39973ea7c578010',4,5,'MyApp','[]',1,'2020-12-13 23:29:35','2020-12-13 23:29:35','2020-12-15 04:59:35'),('675e1a9f0d5601553b95e2c31cc7f12d0ee30b6b68c3323df99a197b5921225b0282a2a9bceabb9c',13,14,'MyApp','[]',1,'2021-05-07 02:10:17','2021-05-07 02:10:17','2021-05-08 07:40:16'),('6767acf97db378b038a5e361599de7d7b2603f6b1e506b708d3b614e0693198d5a1c62088269547c',9,14,'MyApp','[]',1,'2021-02-25 05:59:41','2021-02-25 05:59:41','2021-02-26 11:29:40'),('67d4abd202c216a84f745d970005cbcdf8b2ddc2680014f3551f57fa5b6976daf8e0aa2998152898',2,5,'MyApp','[]',1,'2020-11-30 04:34:05','2020-11-30 04:34:05','2020-12-01 10:04:05'),('67e76b57bfe463c3b89a6084d717a3dfeba29fba38c838a0d06328099fd88b29bebfc609ca7f98f8',8,5,'MyApp','[]',1,'2020-10-23 04:10:36','2020-10-23 04:10:36','2020-10-24 09:40:35'),('67e8ccb47cae24e1c67863243c83939a8c566304cd53cb47d59e24391ffc95b4b00af307dc863f33',6,5,'MyApp','[]',1,'2020-12-16 03:12:32','2020-12-16 03:12:32','2020-12-17 08:42:32'),('68221016c668dbeaa2d559b0f4322138fada40130ed485e2ee6f913f05c2f44d1e897004c559177b',8,14,'MyApp','[]',1,'2021-04-22 00:40:26','2021-04-22 00:40:26','2021-04-23 06:10:25'),('6844e25ca213df7ae4696f49a714e5964f5f2e4b6e02f4fc423f3405e47b04317c69336503a96c10',2,5,'MyApp','[]',1,'2020-10-14 06:53:48','2020-10-14 06:53:48','2020-10-15 12:23:48'),('68a816035c3195c970797336dcd230962a7a3713dfcced395a5d2f571895cb6f51bad60af46af4ff',2,14,'MyApp','[]',1,'2021-05-17 23:55:32','2021-05-17 23:55:32','2021-05-19 05:25:24'),('68daf2e57dc4544315122c998960316f97539fafa88e89c0bc4450acb73027fd2eed3db48e74fc09',2,5,'MyApp','[]',1,'2020-12-16 03:13:28','2020-12-16 03:13:28','2020-12-17 08:43:28'),('68ded72bafbf217435e9d0cb68c7a32bcacb3d5a70efcadf856f38467b87064ee30cd378f2dabac0',8,5,'MyApp','[]',1,'2020-11-13 05:59:27','2020-11-13 05:59:27','2020-11-14 11:29:27'),('68e9593b83185728971481976cf37d2972c86a29aedc395b8d1aa674c2d1b05e466f43edb0270979',5,14,'MyApp','[]',1,'2021-04-20 06:40:34','2021-04-20 06:40:34','2021-04-21 12:10:33'),('68f126dc4cc96dd915933640375cfaa779160c31ecb1794d30b582a111ff3427e26eb9b697ed13d2',1,5,'MyApp','[]',1,'2020-11-30 23:24:09','2020-11-30 23:24:09','2020-12-02 04:54:09'),('68f700b325b3a547b2f78e7a845418be28c8a76379c9c3451e4c7d020d8e0409f1c093382984f9b9',2,5,'MyApp','[]',1,'2020-10-22 03:52:04','2020-10-22 03:52:04','2020-10-23 09:22:04'),('69a2221c3f6eae1136f89cb8c2e0c584e757b2a87676f333a920e97ff562f23a923a7dd4848c781c',8,14,'MyApp','[]',1,'2021-05-18 23:56:10','2021-05-18 23:56:10','2021-05-20 05:26:06'),('69f0e958e30da39c4aa3f6f46decf9043380695ed9ef26ccbc6ecb8d94ed8645a4d9da8588da5601',8,5,'MyApp','[]',1,'2020-11-12 04:03:59','2020-11-12 04:03:59','2020-11-13 09:33:59'),('6a31609ced9cc3d568a5818847dc161c3218d0e7e4824c97862f154c95ca73fb44760697edd91dd1',8,14,'MyApp','[]',1,'2021-05-02 23:23:51','2021-05-02 23:23:51','2021-05-04 04:53:51'),('6a9c81ee807e22b201b179daa2582856ccc00a12c56f9a728b81b19665031cf6e8a1f6fddb501211',1,8,'MyApp','[]',1,'2021-01-05 06:36:17','2021-01-05 06:36:17','2021-01-06 12:06:16'),('6adfe6560054f4abaf623f03ec13ace89849856593807912a52d193c1ec319fa860faf7c389b557c',1,5,'MyApp','[]',1,'2020-10-12 23:30:52','2020-10-12 23:30:52','2020-10-14 05:00:52'),('6aecb277c84a0e5fbb8c70a6c44acb3470164cf7a9448951e5c46ac0b5939b580fb0f9c136350c30',5,5,'MyApp','[]',1,'2020-10-19 03:45:08','2020-10-19 03:45:08','2020-10-20 09:15:06'),('6aeefdc98a603befc55ed4458b9d6bd045321ac3fdd45a5f8d429d077f86a243ac7c8888f95ecbbb',10,14,'MyApp','[]',1,'2021-03-23 05:40:27','2021-03-23 05:40:27','2021-03-24 11:10:23'),('6b2662b968954ecb7536437e9ce4f816d31f1aff44e2b00148dae4f3aa9cc42e63e6598f8905e50b',8,5,'MyApp','[]',1,'2020-11-12 05:04:03','2020-11-12 05:04:03','2020-11-13 10:34:03'),('6b47430a4fad4a717a9aa47cad0671fed02ebfae52ad3ef46d3ea0b31d573aaf5ba328c19a498a68',6,5,'MyApp','[]',1,'2020-11-26 01:31:13','2020-11-26 01:31:13','2020-11-27 07:01:13'),('6b47e31638555a390c01e784859eda0e6c44b83ecab61fa562cc85f360ed4826257a190ea02f9127',6,14,'MyApp','[]',1,'2021-02-26 06:26:08','2021-02-26 06:26:08','2021-02-27 11:56:08'),('6bb093c17ec4bfda316c16113ac169c8daffde126b08b72e74ccad4b0e138990f3d1121010689b68',4,5,'MyApp','[]',1,'2020-10-23 04:06:11','2020-10-23 04:06:11','2020-10-24 09:36:11'),('6bcb5529a150a3ca1a39d4cbab66d47fbeb42c7eb2626984566d7a532bfd06188db22438953f6be1',2,14,'MyApp','[]',1,'2021-05-11 05:04:24','2021-05-11 05:04:24','2021-05-12 10:34:24'),('6c6428e2c5704fba10b02eaf83068448ac81a4ca0605344944a0123b9902858619572d8fac870db7',6,14,'MyApp','[]',1,'2021-03-26 04:12:41','2021-03-26 04:12:41','2021-03-27 09:42:41'),('6c6826065e7d73b5884641cb039850741bfc46c298704deb560da239b9bbc63179a6a67d53dbf0e5',3,14,'MyApp','[]',1,'2021-04-07 06:58:03','2021-04-07 06:58:03','2021-04-08 12:28:02'),('6ca0b70e50c6c137a40e27a03ebd8c1d182dcd625795df25cee4d5a9eb1eb0b883aafd3a7afe9043',2,5,'MyApp','[]',1,'2020-12-24 03:10:35','2020-12-24 03:10:35','2020-12-25 08:40:35'),('6cba3d93aca0ba6aac134875eed4d40cc7e61e6c26b1442ffdeaad08d38f8b14fc0b31f53914fd2f',10,14,'MyApp','[]',1,'2021-03-30 06:27:06','2021-03-30 06:27:06','2021-03-31 11:57:06'),('6cce97f2f8392bc5a9846c11fea2adfc170a2e46cac0cd4604d9dca164fdf69b45da3539f6a3b7b7',2,11,'MyApp','[]',1,'2021-01-06 23:33:02','2021-01-06 23:33:02','2021-01-08 05:03:02'),('6d01044519aa76b39068eefe5074c6425d7b256429eade23b8db55dfa74636e6c4348a1b8b2fe534',10,14,'MyApp','[]',1,'2021-03-30 03:52:33','2021-03-30 03:52:33','2021-03-31 09:22:33'),('6d19d138770a3df3fe2816ea6c8d590dc33426286f01b4aa106b69484c1983b00f84138d56ff4830',8,14,'MyApp','[]',1,'2021-05-31 05:55:48','2021-05-31 05:55:48','2021-06-01 11:25:48'),('6d1c46d77de09cdc87e5c3a5d118f22a1558e6462eb5411f0440d362155abe2e03ec6a2535de9334',10,14,'MyApp','[]',1,'2021-03-09 06:25:10','2021-03-09 06:25:10','2021-03-10 11:55:09'),('6d28b8cc8a378042f31ef7f77a286201c3422c0a4003bacf4fa52669075a4404bfdbc3e1c352ecf7',4,8,'MyApp','[]',1,'2021-01-04 04:52:07','2021-01-04 04:52:07','2021-01-05 10:22:06'),('6d7137b022cf296f877b9394d82510f1a0a8d4fcd968e2339b9c4d861e4e08db56254b40ba6c51e1',8,11,'MyApp','[]',1,'2021-01-20 01:35:43','2021-01-20 01:35:43','2021-01-21 07:05:42'),('6db70857f43f4fcad722c0aba32799e19cb746fa26a66c64198bfd53d9e35fcc05a05eb478b2c928',9,14,'MyApp','[]',1,'2021-03-18 01:51:42','2021-03-18 01:51:42','2021-03-19 07:21:42'),('6dba07dd1535779d02c6c253ad734e64e319bf58c60f581324e08fcbb7d4a12726cec2af1404aecc',1,5,'MyApp','[]',1,'2020-11-05 22:38:15','2020-11-05 22:38:15','2020-11-07 04:08:15'),('6dbe1b95060caf6360dda3c286416d32bf2d864b68b3672f1fb1cef7cd4daabacddb0036934872ef',4,5,'MyApp','[]',1,'2020-11-03 00:24:04','2020-11-03 00:24:04','2020-11-04 05:54:04'),('6dd31bfe4c6590721955a35c748ecbc4e138c9f6b1f750aba43c0627285226d5fb40fe04a2e155cc',8,14,'MyApp','[]',1,'2021-03-18 00:50:18','2021-03-18 00:50:18','2021-03-19 06:20:17'),('6dec525c2159b5abe4f053ac3101d21b706ea4074637a1fe2d48ab5f213e4999f69e18563b8336e4',1,14,'MyApp','[]',1,'2021-06-02 03:13:31','2021-06-02 03:13:31','2021-06-03 08:43:29'),('6df41ad22d701deb7ec79189868feecd3bc7a3cf5278dc5ce3f5b9c7384595f8d0203f32ee87c151',18,14,'MyApp','[]',1,'2021-02-17 03:23:17','2021-02-17 03:23:17','2021-02-18 08:53:17'),('6e50b828516cfefc056f23219761266049d9046607483f90999863060a8257b47a6d4d06bf3596ca',1,11,'MyApp','[]',1,'2021-01-19 04:18:57','2021-01-19 04:18:57','2021-01-20 09:48:56'),('6e65e9418f855666680a571b16350d7f9be5517aedff267967741f41ab337d84fea771727b2e4398',10,14,'MyApp','[]',1,'2021-03-24 23:30:13','2021-03-24 23:30:13','2021-03-26 05:00:13'),('6e973aee4165c5ed72d18e2363082c45d2fbda6e49b320e8c68a2bf865ac917e3f8c1e781ae50c28',5,5,'MyApp','[]',1,'2020-10-20 01:57:46','2020-10-20 01:57:46','2020-10-21 07:27:46'),('6ea99a0e269e6378dd5e2ac732197daf18b7c5246d2ad08f80166f06f0c16703eb513b94e5ca42e4',10,5,'MyApp','[]',1,'2020-12-22 23:26:07','2020-12-22 23:26:07','2020-12-24 04:56:06'),('6ec2310d43d0781b1614a185503be552dd1c9a38c65aacedd85303dc701d7807960a3581ccaa8209',2,5,'MyApp','[]',1,'2020-12-02 04:43:07','2020-12-02 04:43:07','2020-12-03 10:13:07'),('6f10b9ba5463e7935e0980621bb8a4a3de041195d73788073f278f0e59726001a6e178187dc091e8',6,14,'MyApp','[]',1,'2021-02-26 00:44:57','2021-02-26 00:44:57','2021-02-27 06:14:57'),('6f5962394ae125b73f41f598fd4574b79949af0560bea5f97f6d4bdb9676d6649169a785c58842b6',10,14,'MyApp','[]',1,'2021-03-23 00:29:50','2021-03-23 00:29:50','2021-03-24 05:59:50'),('6f86a3fda2a49ecdbfa3b35a22a7bfca0945364fac1c30fb870b45cef5861fa6fe2b4698504085d9',10,14,'MyApp','[]',1,'2021-03-25 23:37:15','2021-03-25 23:37:15','2021-03-27 05:07:12'),('701c4c6cd4ad18aa86eea57ae54cf94455707e44155bb845bdfb801f8323e3a10764629209680ece',6,5,'MyApp','[]',1,'2020-11-05 00:23:45','2020-11-05 00:23:45','2020-11-06 05:53:45'),('7072481644666221c1cb1946097507888cce7c069b8d9abbfaf8e12c46a4803d34daa49633b27522',1,5,'MyApp','[]',1,'2020-12-11 05:08:07','2020-12-11 05:08:07','2020-12-12 10:38:07'),('70823af24ee3fa689da114b13d21ea7cc1b4506283c966a534730398da58aba336c86cd91bc220b2',2,5,'MyApp','[]',1,'2020-11-29 23:13:23','2020-11-29 23:13:23','2020-12-01 04:43:20'),('7083f06ce45f98d752c87274c93950626e1064a6166d2c3f302657c07c26c222d818f753c4a1817a',2,14,'MyApp','[]',1,'2021-04-20 04:26:42','2021-04-20 04:26:42','2021-04-21 09:56:42'),('70b03822337c50f7acf2aeed6e36b8355090d9ba3c233d0c90eb19e4c1eac52b9ec7e890dc352174',6,14,'MyApp','[]',0,'2021-02-11 06:30:52','2021-02-11 06:30:52','2021-02-12 12:00:51'),('710dab4e60448727371fb099ea79c03a6509f4392a628d1e1541ee9b6bba39b04c09e89f37382ac4',1,14,'MyApp','[]',1,'2021-03-07 23:30:41','2021-03-07 23:30:41','2021-03-09 05:00:39'),('71f55014c21eab2b0ab9e1349704594075f136526d51d6546449bfe7d568802315fb7c0566283e77',8,14,'MyApp','[]',1,'2021-04-21 23:37:52','2021-04-21 23:37:52','2021-04-23 05:07:52'),('7255c5565f450c84f039a7ab794d3a6dc892e85c05ac3a84a7b275d2622d84713760d3faf6aaa782',6,11,'MyApp','[]',1,'2021-02-03 06:12:33','2021-02-03 06:12:33','2021-02-04 11:42:33'),('727681ab2e6102654746933049b2395c9e2ed184f10c8ee5de8969c56af786d14339f55687c5cae4',1,14,'MyApp','[]',1,'2021-03-26 04:12:16','2021-03-26 04:12:16','2021-03-27 09:42:16'),('72a5379fd1326e0193cabea3b9b78cc0df597f299e65e4ce9ceffa1ab1b06819790ea405c993f3b9',2,14,'MyApp','[]',1,'2021-03-11 23:13:11','2021-03-11 23:13:11','2021-03-13 04:43:08'),('72ad8094f6845f650a00f0b7ebc47142a5ea50c312b10bab70d117f5d44233fb2b2319639fade184',8,14,'MyApp','[]',1,'2021-05-12 01:22:54','2021-05-12 01:22:54','2021-05-13 06:52:54'),('72e0456b2ee8dac2134d886ac741ac0ea786fb6f49971a679723cf65caa8df3abcb45cd6644db3d1',8,14,'MyApp','[]',1,'2021-06-01 00:32:15','2021-06-01 00:32:15','2021-06-02 06:02:14'),('735ab5f2cc9872844936b33d137743792dd21af024db29c4dcd5f8b0d6370325a511ae74ce44442d',2,14,'MyApp','[]',1,'2021-03-17 23:00:03','2021-03-17 23:00:03','2021-03-19 04:30:02'),('73fb29ce9bfa79c7b7a7db061dabb7594dae8b30775e05e9f768870e9ed4e985a0a97e863106cae0',8,5,'MyApp','[]',1,'2020-11-17 23:27:00','2020-11-17 23:27:00','2020-11-19 04:56:58'),('74274456eae5c1538a74c498c0aa4855ea2965f803fac7a423f761ca6c9f1bfc13caaaedc64c3acf',2,14,'MyApp','[]',1,'2021-02-08 23:21:12','2021-02-08 23:21:12','2021-02-10 04:51:09'),('742bf0a0b9b2fc10e009ae071ce8c60e3934ecca73eee2ffce5f204fec78c0711bdb18ddff4b0a47',4,11,'MyApp','[]',1,'2021-01-21 06:53:18','2021-01-21 06:53:18','2021-01-22 12:23:18'),('746c4939717332863c712cf4f005065ac615460a845b8de615d334a62073005d8cb5e716424b366f',3,14,'MyApp','[]',1,'2021-06-11 01:03:17','2021-06-11 01:03:17','2021-06-12 06:33:17'),('74b7598867faf3d6adbf4a894114c6bf2862b7cfaee91e4ddc9e36e918dc5fffee7698eccd45bbf7',6,11,'MyApp','[]',1,'2021-01-18 03:56:09','2021-01-18 03:56:09','2021-01-19 09:26:05'),('74e49c041af5621606420f088f12090fe138bb3ba85ec9f04d6529dc9aa4883c753dadb074d87e10',9,14,'MyApp','[]',1,'2021-03-17 23:41:23','2021-03-17 23:41:23','2021-03-19 05:11:22'),('751412c86457f93a85004d4c669f0e61d3816c5db2d5a94f94dd8b90e32005b8910d973d7b5f9b2c',10,11,'MyApp','[]',1,'2021-01-21 03:43:25','2021-01-21 03:43:25','2021-01-22 09:13:24'),('75720421114ab0339e998ae7da7e3b8034159e984f28c920b68d7fb946917c385d8fb629d6063f65',8,14,'MyApp','[]',1,'2021-02-10 04:23:11','2021-02-10 04:23:11','2021-02-11 09:53:11'),('75b016563175970f3992bfd41d0b0321d6c9915ca311510f2d83e3eea19ac6d4f1803a15245537f9',1,11,'MyApp','[]',1,'2021-01-20 01:33:34','2021-01-20 01:33:34','2021-01-21 07:03:34'),('761b7d8de261e4ee77599200e9925342bda5c2a33ab2bd109adaed7b619596e6ad552648519cf853',1,8,'MyApp','[]',1,'2021-01-03 22:38:07','2021-01-03 22:38:07','2021-01-05 04:08:05'),('76cf0a4e2e3616aeb2099582ac73bdd53fe7b56f4432132f1a4b29803eda0b9a6adaa19a4fd85afb',2,11,'MyApp','[]',1,'2021-01-05 23:40:41','2021-01-05 23:40:41','2021-01-07 05:10:40'),('76d33ce6afae22d0dac4f1919d2bc820123427915a4faa5cb78320fb9a8941f2d20f9497f15c75d6',8,14,'MyApp','[]',1,'2021-04-28 23:13:07','2021-04-28 23:13:07','2021-04-30 04:43:07'),('7714e8c1f22ac72edd626818422240c877a769207205704ab53d9caa27836f7240c34d901e5e763a',8,14,'MyApp','[]',1,'2021-03-01 05:09:29','2021-03-01 05:09:29','2021-03-02 10:39:29'),('773fa6824eb404c81d610b376eecac2d9cbf0bd96c55705788cd5f2a127c3a28b3f7464cb690552e',2,14,'MyApp','[]',1,'2021-04-22 00:44:07','2021-04-22 00:44:07','2021-04-23 06:14:07'),('77567db5b55b3e610344d1e7ac7acaaa45d8117c5b0d26b9c0e945c49a5f99e12e783a1100dd3e38',1,14,'MyApp','[]',1,'2021-03-02 03:15:23','2021-03-02 03:15:23','2021-03-03 08:45:23'),('777699ed79fae18b0dad1a24e7d92e10a6aa2902c73ea6508e47b1285d69b095e470cc75bdf1e287',2,14,'MyApp','[]',1,'2021-06-11 01:01:13','2021-06-11 01:01:13','2021-06-12 06:31:12'),('778674d89f5c6ae260f4054bb18de37cf9244609b365c348e56e0b1f609967d5490044dfbbd7399d',8,11,'MyApp','[]',1,'2021-01-22 01:12:00','2021-01-22 01:12:00','2021-01-23 06:42:00'),('77927162148fec73eb2522b0f7318ffe9a03881e5f6a4ed38c575dbd81f8e3fd2584eded1ea82dd4',4,5,'MyApp','[]',1,'2020-12-16 01:52:57','2020-12-16 01:52:57','2020-12-17 07:22:56'),('77a5fedb55c088c54875ffa1f1096c0e0213cd5ca6d937799966514f3418565a155cb0ec2da38713',1,5,'MyApp','[]',1,'2020-12-02 04:45:33','2020-12-02 04:45:33','2020-12-03 10:15:33'),('78306a42cc5e0dae314a353f881e5c61cfa419109959fc58c463c15041918971c8d88dccb3157c00',1,5,'MyApp','[]',0,'2020-10-20 07:39:07','2020-10-20 07:39:07','2020-10-21 13:09:07'),('78bcf437d3a2ffc0b6f12c224e9b4b86c79db76a0a5deb1c48a0e37c8513fa7d1a661eb46b6dddd9',2,8,'MyApp','[]',1,'2021-01-05 03:22:03','2021-01-05 03:22:03','2021-01-06 08:52:02'),('78bf40507e7e751e3a3e6d1cac3799f0c1d9ba429967c9af8ad421dc83377701c469a0cedd62ed8b',6,11,'MyApp','[]',1,'2021-01-19 04:26:35','2021-01-19 04:26:35','2021-01-20 09:56:35'),('7938dac2fc698fb5ff2e03497784dbfd5a3d9a9e91ce9e95fb43b4cc49816d68857a6644342d5af1',8,5,'MyApp','[]',1,'2020-10-21 00:27:46','2020-10-21 00:27:46','2020-10-22 05:57:46'),('79af64e6e8e744099f4a82f28dc22208f7627f94196f29f3333905140f2b254592b7a34d4318fabf',4,5,'MyApp','[]',1,'2020-12-11 04:59:17','2020-12-11 04:59:17','2020-12-12 10:29:17'),('7a00e614c98c6b210a91ae5f83805f95815cd76aa61be773f42485346eb266c38fe3a0a41bbb6f42',1,14,'MyApp','[]',1,'2021-02-22 00:55:09','2021-02-22 00:55:09','2021-02-23 06:25:09'),('7a50c0ede831c71dba9b4fccc584ccdf287a42bf71ee81c0d844c051d1b79a9ba026d97f74a48949',5,5,'MyApp','[]',1,'2020-11-02 23:49:12','2020-11-02 23:49:12','2020-11-04 05:19:11'),('7a618b3dfb12045178b9b7c7ab0e3ce50a1e66979556f9d189c9e0b73bd25c5372c3ba6fdc4b3132',5,5,'MyApp','[]',1,'2020-11-12 05:01:49','2020-11-12 05:01:49','2020-11-13 10:31:49'),('7ab86ed68c1db3b59286b6f943e6748caff34d770819d6db0b6c5e218265d3d952155a04348e5e79',4,5,'MyApp','[]',1,'2020-10-20 02:05:06','2020-10-20 02:05:06','2020-10-21 07:35:06'),('7ac12d91ce87d78f78595531a2fdcb108894533a185d7eabf7b63d2cf3c8a168670f598ef432cc3f',2,14,'MyApp','[]',1,'2021-03-16 23:56:01','2021-03-16 23:56:01','2021-03-18 05:26:01'),('7b74cba0e56e43ad1be90d6fc7b26e251b9ff01c4ce98c51e97774009541b47c540f9fbba7444070',4,5,'MyApp','[]',1,'2020-12-22 05:42:13','2020-12-22 05:42:13','2020-12-23 11:12:13'),('7b952281a76f5cea4ba179f0e79ff3c933be61df4d7ea77fe0f5cedefcc7afe41e1fa3db2283c7fc',2,14,'MyApp','[]',1,'2021-05-03 00:46:37','2021-05-03 00:46:37','2021-05-04 06:16:36'),('7b9ee40a4cfd314b17e95c0996f62316496d0631867a00a43e06bfcb28f99c9c8a9076d015f0b7d7',9,14,'MyApp','[]',1,'2021-03-12 04:32:21','2021-03-12 04:32:21','2021-03-13 10:02:21'),('7bd6b88fc7c8e4916dd526b440b000db25d783cb71ccd82516660b7366f72460bdb5aa5962c5a5d7',1,14,'MyApp','[]',0,'2021-03-08 07:36:36','2021-03-08 07:36:36','2021-03-09 13:06:35'),('7c40604e6ff0607db20c46828c52558b4c07c1d8127682652f3881906a99afbfbf64f47bcb1d6437',6,5,'MyApp','[]',1,'2020-12-22 02:03:09','2020-12-22 02:03:09','2020-12-23 07:33:09'),('7c9db42d7167a2d4120c13fd90a4b20604dac226ed73e5f98be8bc99cdf4e835b366a5b761d2d1d0',6,14,'MyApp','[]',1,'2021-03-17 00:11:12','2021-03-17 00:11:12','2021-03-18 05:41:12'),('7cfd3a943ec88e2e0bbd97a866d7012b61fcf16089898a15e0d40814a36b440fb39f68b6864a67c4',2,5,'MyApp','[]',1,'2020-10-12 04:34:47','2020-10-12 04:34:47','2020-10-13 10:04:47'),('7d336f8e6e3ac8dd2b5e809b73c86ec6186cba5ca159e8ce4a33c4a3f743b70c53c5b017b94eb432',7,14,'MyApp','[]',1,'2021-03-26 04:08:52','2021-03-26 04:08:52','2021-03-27 09:38:51'),('7d3c30dbcfee7aceca3eda0399cc4331b090a71a2776ede87923a7d125d407a80550e0783af81466',4,14,'MyApp','[]',1,'2021-02-25 07:40:11','2021-02-25 07:40:11','2021-02-26 13:10:11'),('7d3c50e8af5337f19891bbcacaaa3fa1083d52463c485acd85b4a38d2fc6e99e684d107cb69b3c0e',9,14,'MyApp','[]',1,'2021-03-17 03:42:07','2021-03-17 03:42:07','2021-03-18 09:12:07'),('7d9bf6810dc2bdd228aad90fc36abcd731d956b8c4e26557b44dd33601d7da37a1e72faea2f90ecb',3,5,'MyApp','[]',1,'2020-11-26 23:05:49','2020-11-26 23:05:49','2020-11-28 04:35:49'),('7ddff24ad2081a1f51e81b507de19151c68b712f6646867e4adf89767bc6f2347485571802ffa01b',1,8,'MyApp','[]',1,'2021-01-05 03:27:58','2021-01-05 03:27:58','2021-01-06 08:57:57'),('7df2f1fa89961467522349651ddb9e28fcc90e708c9365386f56441a471e50799f4b64e69360b3e5',6,8,'MyApp','[]',1,'2021-01-05 04:48:51','2021-01-05 04:48:51','2021-01-06 10:18:51'),('7ea1bcf9087c5044fbffed5b73a27b7b82cee460275a6bfe6c55cc7d917757acbed07749fd212f50',9,14,'MyApp','[]',1,'2021-05-30 23:32:05','2021-05-30 23:32:05','2021-06-01 05:02:05'),('7ebb548d46d07c12a60b87716f4caf425686261b1ba472c15a3a7836d81424fb07604ef980ca5a5f',5,11,'MyApp','[]',1,'2021-01-11 05:34:07','2021-01-11 05:34:07','2021-01-12 11:04:06'),('7eeb365283fba063e6f066ecc7a7c38c096e94f321ef5a0f8ad314c11c3247e0f3635cd35c9dded2',6,14,'MyApp','[]',1,'2021-03-25 00:07:38','2021-03-25 00:07:38','2021-03-26 05:37:38'),('7f7b757b2b5ecd310732e67a0c36582d77fba7d3b048e975e147d7930c0f8ff66cc89f22747763e8',6,14,'MyApp','[]',1,'2021-04-28 23:03:59','2021-04-28 23:03:59','2021-04-30 04:33:56'),('7feeb69371a17f79f21c3c5583d202419ac6c911f8b29384ac37b6a831e1bcaf6034f256a70c29b7',1,8,NULL,'[]',0,'2020-12-28 03:48:48','2020-12-28 03:48:48','2020-12-29 09:18:47'),('7ffce41e37297f5768820278c29c1dd6e9e203a6b23cdd48f6aa984a4533d3f7837175e8a371c8f4',1,14,'MyApp','[]',1,'2021-06-02 04:00:58','2021-06-02 04:00:58','2021-06-03 09:30:58'),('801de51b4c801a4bfb686924e15a30e3b3e0357b411c6062de825d4b89a9b51ff3bbe9dad29e6e17',2,5,'MyApp','[]',1,'2020-12-16 01:42:14','2020-12-16 01:42:14','2020-12-17 07:12:14'),('8050fdcdddf5ea0a01be175d302765b568e2af6d76349c5de8dcdcc5a3502421856ec0dd9258f8ef',1,5,'MyApp','[]',1,'2020-11-09 03:45:55','2020-11-09 03:45:55','2020-11-10 09:15:55'),('813206b9af5e7c23f602e5d9ab74c48e43587aa21d180f74434f3afd0fc6b28398e117cc4fff85ea',8,5,'MyApp','[]',1,'2020-11-13 04:05:41','2020-11-13 04:05:41','2020-11-14 09:35:41'),('8169f6f974df7f182e95063052065f3d9fb9f2fe785510060d020c9952fe310313e161df23ba60aa',6,5,'MyApp','[]',1,'2020-11-25 22:38:50','2020-11-25 22:38:50','2020-11-27 04:08:50'),('81dd338109c01819c95099082c41feef5e70adb98f81a6099cd8bb2fadf0113c496b0e63180a3db8',2,5,'MyApp','[]',1,'2020-12-08 01:53:20','2020-12-08 01:53:20','2020-12-09 07:23:20'),('81f3316d44a7680513a58c53ae47f7db9b9c2bc943a6e6c793e0d5290ed13b16936dc8d175075c86',13,14,'MyApp','[]',1,'2021-03-24 23:09:42','2021-03-24 23:09:42','2021-03-26 04:39:42'),('81fecadfd0dd2cad4efb6874732d3becced6e1f945dfef1a0fa587d40e3a353f96904620a3fe7e6a',8,5,'MyApp','[]',1,'2020-11-11 07:23:58','2020-11-11 07:23:58','2020-11-12 12:53:58'),('82085ca76332529f80262905b538fa917789bf3f3cd5f9a39522353ea5de4c7ac8899f0698dbd423',2,5,'MyApp','[]',1,'2020-11-29 23:58:10','2020-11-29 23:58:10','2020-12-01 05:28:10'),('82279e6aa17ada527e1232e18598dfe55fab405e018e94f863ea652e757d51bcb8ac957f4fd1be7b',6,5,'MyApp','[]',1,'2020-11-03 01:01:08','2020-11-03 01:01:08','2020-11-04 06:31:08'),('825af74f6e0964782b1e6436e4a6b3e884ecc359c341c7d182336aa57377cee395e179254d7d54a0',6,5,'MyApp','[]',1,'2020-10-21 00:26:22','2020-10-21 00:26:22','2020-10-22 05:56:22'),('827a10974cf3c47c33fd3b58bdc8eb3894c543faede2fdc39cd0204ec7e54681b6a95277b8544c44',2,11,'MyApp','[]',1,'2021-01-06 02:29:05','2021-01-06 02:29:05','2021-01-07 07:59:05'),('82e0ce03ae2ceca5a9bb88802c2ef31c80896bbedae651a3d6f6dc5671a430b0570332283e01edef',9,5,'MyApp','[]',1,'2020-12-02 03:55:26','2020-12-02 03:55:26','2020-12-03 09:25:25'),('82f9e3a37a335903a38d45d0433931fef8cb250a7f4ab5cd266e42db301972080e016a68c5e4ad30',8,5,'MyApp','[]',1,'2020-11-18 00:13:18','2020-11-18 00:13:18','2020-11-19 05:43:18'),('833b7b594ca96de7712470a18c9103b1b160d57a4e109ff2f39af697f2e1e8be751e06508544d625',2,14,'MyApp','[]',1,'2021-03-18 04:24:39','2021-03-18 04:24:39','2021-03-19 09:54:39'),('836025de3f66e927d10960d6d0a4806e5769936054483055e84a98044c4afe33a93f49f09f915bf7',3,5,'MyApp','[]',1,'2020-12-13 23:27:59','2020-12-13 23:27:59','2020-12-15 04:57:59'),('836811f5bade3d4e308bc6eb7f732659ef9ae53e8c4001a8ee3d1f863ee824bf6ca44b6e987bcf51',2,14,'MyApp','[]',1,'2021-05-19 01:18:00','2021-05-19 01:18:00','2021-05-20 06:48:00'),('837d9ca913637e3f2e832da4a34e721b12d700f7303bf17e8e701ac1f6447608c51e822aebae94df',2,14,'MyApp','[]',1,'2021-05-13 03:19:27','2021-05-13 03:19:27','2021-05-14 08:49:27'),('8400ce9041079c9a955a0c12daba9b0be67f685782a135c0b75bffe11b7cab950493e07f4b6d0687',1,11,'MyApp','[]',1,'2021-01-06 07:25:48','2021-01-06 07:25:48','2021-01-07 12:55:47'),('840113a74202b300e43cd39777470ca00647811d89b05e42b52efbc864e5f83bbf7e86f98a9c1086',8,5,'MyApp','[]',1,'2020-12-16 02:58:03','2020-12-16 02:58:03','2020-12-17 08:28:02'),('844265a89f4014ca2cbca99e75131738a1372eb9393ef406d90e9153811309799cd846a25b0be925',9,14,'MyApp','[]',1,'2021-05-07 03:54:26','2021-05-07 03:54:26','2021-05-08 09:24:26'),('8489ac441d43de1781ed9ca1ae01456c1a05e29efa38fa11192aab6fad651f7e788e73702ea1124c',13,14,'MyApp','[]',1,'2021-05-07 03:32:30','2021-05-07 03:32:30','2021-05-08 09:02:30'),('848a2ced2e25052814ec01a62e7b1330a032ef0583e84f1601e555e90e9ba236b4a8210ab1b6249b',9,5,'MyApp','[]',1,'2020-11-04 05:20:45','2020-11-04 05:20:45','2020-11-05 10:50:44'),('84cef720525f018b1866b465eb56296eb21f2fe24cb0f0373aee41f41bc7f4b2228618c68c082850',1,5,'MyApp','[]',1,'2020-12-04 03:54:13','2020-12-04 03:54:13','2020-12-05 09:24:13'),('8524ee869a5a82cd7329aeceaf5b31692dfe8b995b9509a56672b60a3bb201df587ba7bc79a90075',6,5,'MyApp','[]',1,'2020-10-20 07:36:18','2020-10-20 07:36:18','2020-10-21 13:06:18'),('8536ecb8b6cee8b429ade04be8e0cc6c504292af1b420dbdcde859005ec27964051a8b80aead1759',2,14,'MyApp','[]',1,'2021-04-06 01:12:32','2021-04-06 01:12:32','2021-04-07 06:42:32'),('855561d3f51a8a82bbd030882336e18fe3ef470747af94eec64045f9c20ce7061ffd65e626f236e0',1,11,'MyApp','[]',1,'2021-01-29 05:07:05','2021-01-29 05:07:05','2021-01-30 10:37:04'),('85a9df37a1da205bb613fee9bded38cddc4582cd4bdde273674b5dd4a36f9b350773a639d5b74eab',2,11,'MyApp','[]',1,'2021-02-02 00:25:48','2021-02-02 00:25:48','2021-02-03 05:55:48'),('8612820b80be0cc4768ebd6f71709ef8f6aa733291f8224e66fa21518a268ce608208107976f38e4',2,14,'MyApp','[]',1,'2021-05-31 05:28:58','2021-05-31 05:28:58','2021-06-01 10:58:57'),('867bafe617a96d5be2b28bc186c0b242be52ab6304349b1e9bb2aef948fb1fe42e06d54052e01278',2,5,'MyApp','[]',1,'2020-12-11 03:19:33','2020-12-11 03:19:33','2020-12-12 08:49:33'),('86b01b5f7ce6e1262a2925e8f9eacdecd3641149c0e458e15e3a57d7b4a66975e0bb0849bc5f9f27',2,5,'MyApp','[]',1,'2020-10-15 06:32:41','2020-10-15 06:32:41','2020-10-16 12:02:40'),('86b2ba872b26690ae653bceda2fa5bb801b7ab47846c64e95ef451e802a478a81c6e3827fd06e725',6,14,'MyApp','[]',1,'2021-05-10 04:10:49','2021-05-10 04:10:49','2021-05-11 09:40:49'),('86c08563db66bc03b32af23f2752fea398444967c267c714000a564d766eac19ffb915a290298f62',8,14,'MyApp','[]',1,'2021-05-10 00:33:55','2021-05-10 00:33:55','2021-05-11 06:03:54'),('86e09cbd219cd6dc87bf0d7cf3935115a2c47c61a73f00cb1680a2086ca674c26b136f87dba70962',9,11,'MyApp','[]',1,'2021-01-05 23:06:48','2021-01-05 23:06:48','2021-01-07 04:36:47'),('870e77c321e2429c72e90cc69a359c9a36546766e171e5e211af2fb54c3528da42b20a1877f70b3b',2,14,'MyApp','[]',1,'2021-03-21 23:01:20','2021-03-21 23:01:20','2021-03-23 04:31:18'),('871fa242b0aa830073ac3fc63d081b916d029e7eaae160a97eed4c5b54c1aa6d63ee03ddc85ec4a9',9,8,'MyApp','[]',1,'2021-01-04 05:45:49','2021-01-04 05:45:49','2021-01-05 11:15:48'),('87ed90c8f56eec6100cddd4ba328b9841ab2ee197d5a2f62b55a05b939a24ae9620f9d1f62536ad6',2,5,'MyApp','[]',1,'2020-11-26 22:55:36','2020-11-26 22:55:36','2020-11-28 04:25:36'),('883396b678a79f81bebb889ce9e4c77e71e8f82171f1c9cc09a6981139f7c9d31aab6448908eb1cd',2,8,'MyApp','[]',1,'2021-01-05 03:11:38','2021-01-05 03:11:38','2021-01-06 08:41:38'),('88a5e4120237f62aaed7fac6bb4993473bd36f71d9db0e362148f5f19a5336ad140ea538a076d962',4,14,'MyApp','[]',1,'2021-04-07 06:57:00','2021-04-07 06:57:00','2021-04-08 12:27:00'),('88a7a21db1ff34c7adfe5fba2e3f0b9ba0ff8fe15a3267e8cc1b9a37df2552675cc18a865c411759',1,5,'MyApp','[]',1,'2020-12-15 23:33:31','2020-12-15 23:33:31','2020-12-17 05:03:31'),('88b23aa5ba0eb0ebc057dc488c9839eb7077df7e4609fa7835569ebc93486c1a15e47c8d5be4c2ee',8,5,'MyApp','[]',1,'2020-12-16 02:28:58','2020-12-16 02:28:58','2020-12-17 07:58:58'),('88b8d8afd6e7b98a47d4fbc213ef9a8c7b0fd36647363abfb8287184ca3d1096219b12fb084d2cc0',6,14,'MyApp','[]',1,'2021-04-20 06:55:08','2021-04-20 06:55:08','2021-04-21 12:25:08'),('88f118fdfe0402f52eaf6f32ba9b6a7d44ec58fa8f0cbcc67b2253fc2c322f8fe0dc945a3a6eef1f',1,8,NULL,'[]',0,'2020-12-28 03:55:06','2020-12-28 03:55:06','2020-12-29 09:25:06'),('89033d70d36b14d64696823466419b236caf63f85c5c7ec89620df000aa8bdc0f82f63b7e06775f6',8,11,'MyApp','[]',1,'2021-02-03 04:01:36','2021-02-03 04:01:36','2021-02-04 09:31:36'),('894c73bbf1a73edaa2f3b85a03937f2716f2c4dc61cf71248368b3b33272101a45e980ed52904edb',8,11,'MyApp','[]',1,'2021-01-12 23:17:40','2021-01-12 23:17:40','2021-01-14 04:47:38'),('895fc881364b522e83c331d6eb3fcf048bc476eda228fb8f2c7655bf99f5cf200d89321ad24cdec0',6,14,'MyApp','[]',1,'2021-05-12 04:09:41','2021-05-12 04:09:41','2021-05-13 09:39:30'),('896b1f020f7659a5aa6456df676a275e9bc1913122d09e0e6426b671f52dd09f4a39ae7c079ddff7',9,5,'MyApp','[]',1,'2020-11-12 02:10:20','2020-11-12 02:10:20','2020-11-13 07:40:19'),('89ef295aad17f6b0e79d06c215e4cf6cde923ae5016835719463f797843a531dd6e8ed6c4af6c32f',10,14,'MyApp','[]',1,'2021-05-03 01:16:31','2021-05-03 01:16:31','2021-05-04 06:46:31'),('8a59ceb6a1f849ff90b954d0ee37e8c740ce093b88914b2c038b439bed1177453c492a1c2dfe8203',2,14,'MyApp','[]',1,'2021-02-26 07:00:41','2021-02-26 07:00:41','2021-02-27 12:30:41'),('8ab261c25141b57ae3f215cb3f3d727ee595fc66c8e24918144b63923ca6228c50164a97e70c3758',3,5,'MyApp','[]',1,'2020-10-15 03:04:53','2020-10-15 03:04:53','2020-10-16 08:34:45'),('8aebdcfbd9619c28527a04ea44418704bc9c311476c95b7ff707d4825a0e90540cb315a1181b12e5',1,11,'MyApp','[]',0,'2021-01-08 07:27:32','2021-01-08 07:27:32','2021-01-09 12:57:31'),('8af05436fc8b863633b66862c00c90560a36af9edc79a938abf7270471a0021a81e535c4afdfe9c7',2,11,'MyApp','[]',1,'2021-01-15 01:06:42','2021-01-15 01:06:42','2021-01-16 06:36:42'),('8b1a68fad3f2504c3b1e6436ef3d3d13e1cfc67ebc5054332a475669976395a855e3b746fff912e5',9,14,'MyApp','[]',1,'2021-04-20 06:17:29','2021-04-20 06:17:29','2021-04-21 11:47:29'),('8bf8a8573992615273de0eacce419eba410e567f179797580804960b1b7874a249e22dc732bf90c3',18,14,'MyApp','[]',1,'2021-02-22 22:51:32','2021-02-22 22:51:32','2021-02-24 04:21:27'),('8c1af191914f673d82f08637b0e770394d1b85e786132543dbf3a8f6044df2f19020c1d9509d0f39',5,5,'MyApp','[]',1,'2020-11-09 03:48:46','2020-11-09 03:48:46','2020-11-10 09:18:45'),('8c2b82651477fe2a7d8cc1117fdf21074fe73cf9f87ef944daea85be2340a9cbd69507e4382e8a97',2,5,'MyApp','[]',1,'2020-12-08 23:38:38','2020-12-08 23:38:38','2020-12-10 05:08:38'),('8c41e057a38ef32325cf91cc14c4a50391798fe75c94a2e22f019b3f9b06b5435e65940239fc7a80',9,5,'MyApp','[]',1,'2020-12-11 05:13:30','2020-12-11 05:13:30','2020-12-12 10:43:29'),('8c49b5dfc374edd439a23f469449c10c74fc22a4dff922ece3bc0e22064a59381a55bbbac9186c92',8,14,'MyApp','[]',1,'2021-03-24 23:28:06','2021-03-24 23:28:06','2021-03-26 04:58:05'),('8c51090aa5886f1ef21a7694a51e5b75d93baba46a98097708badaa74f705270b553fbe81844f5da',2,5,'MyApp','[]',1,'2020-10-13 03:11:22','2020-10-13 03:11:22','2020-10-14 08:41:22'),('8c6e4b2bfe46cea0f4c4114acef02c37e53e9555310063485bd19576900aad2af6ce040020f9bdf4',8,14,'MyApp','[]',1,'2021-06-11 02:09:21','2021-06-11 02:09:21','2021-06-12 07:39:21'),('8c9df360830b49b88e4280e52bc6e65c03c3f18bb17ab8aaddcf9863d9b792dbf4eff33cbfd00811',4,14,'MyApp','[]',1,'2021-05-04 03:13:51','2021-05-04 03:13:51','2021-05-05 08:43:51'),('8d77aba98deaf64d7d80d7aaacc36efb9e0469db3b08c23574bb35db4b12ec95ba15430cee176da5',10,14,'MyApp','[]',1,'2021-03-22 07:32:14','2021-03-22 07:32:14','2021-03-23 13:02:13'),('8d8bd2f29a503636ebd679a510b244d85a2db0af419870d394dc92ef72704ab0a997dc23da82fd5f',2,5,'MyApp','[]',1,'2020-12-22 03:43:47','2020-12-22 03:43:47','2020-12-23 09:13:47'),('8de073de5b61b2938a89b97122493cd651170f121f4c0bffe21b24e08a8132a5e3175ad792fa6838',9,14,'MyApp','[]',1,'2021-03-08 00:34:36','2021-03-08 00:34:36','2021-03-09 06:04:36'),('8e1384987c1d5a2200636cd949b335f9e23be49c4dfc0d79f31849ad7f2f1528595d8b17fa01aee1',3,5,'MyApp','[]',1,'2020-10-21 05:01:18','2020-10-21 05:01:18','2020-10-22 10:31:17'),('8eaf8613e6210f4c145a1e6f4a2b250f8952b6c0262a6c177fa3f2c482eb1285fbe374142735fd5e',2,14,'MyApp','[]',1,'2021-05-11 03:41:12','2021-05-11 03:41:12','2021-05-12 09:11:11'),('8ec4f2abd1f823635e4f37c9cfb42088ee1ee0d08ab347c66a8289e95c84dd61bdf5354e9f8cf348',1,5,'MyApp','[]',1,'2020-11-02 03:31:00','2020-11-02 03:31:00','2020-11-03 09:01:00'),('8ef03ec026c1195f669fd4d64eb4f846cf01ef77ddcafbc4debe7309618642fad7df65c365fb4c5f',2,14,'MyApp','[]',1,'2021-04-29 22:58:46','2021-04-29 22:58:46','2021-05-01 04:28:44'),('8f12d448f17555e1d0248024f8567fa570a2c626516c79ed02c6bef1410bcca28cda1ab25b2338cc',9,14,'MyApp','[]',1,'2021-03-16 07:26:54','2021-03-16 07:26:54','2021-03-17 12:56:54'),('8f30b43d20c0f8d001d8789b260f0425eb0bb536e06cc3cca3b57b8abbb782704321ca5efaa578a6',10,11,'MyApp','[]',1,'2021-01-21 00:02:17','2021-01-21 00:02:17','2021-01-22 05:32:16'),('8f496bf12db18ef6756d3117fa4af1008dffc0fd75f67efae071339c867cf517311c945631c13c73',3,5,'MyApp','[]',1,'2020-12-22 05:07:12','2020-12-22 05:07:12','2020-12-23 10:37:12'),('8f4eb0a551c2db86dd976e363a088197f7d3ebdf4dd5c1961419dc11f7f8c355c98b9ffe8f10c2ba',9,5,'MyApp','[]',1,'2020-11-11 07:30:09','2020-11-11 07:30:09','2020-11-12 13:00:09'),('8f71a79ad6ba0188941dabcded4eae99b06a008fdacfbfbce238e6902ca8a61c9b85e31138bfc061',2,14,'MyApp','[]',1,'2021-05-03 03:27:11','2021-05-03 03:27:11','2021-05-04 08:57:10'),('8f79aee552f148b88c4eb2af651d8f390022f4fe496eb064177748ca69ad7796bfedbb6c5a085cc4',1,5,'MyApp','[]',1,'2020-12-11 05:56:20','2020-12-11 05:56:20','2020-12-12 11:26:20'),('8fe4d75cf4f540fd2869b4080567a48ea8f49431176088571b57fb555ad50bdace005b6d22c56533',9,5,'MyApp','[]',1,'2020-11-09 04:53:34','2020-11-09 04:53:34','2020-11-10 10:23:33'),('903056b9b3930fa7946586e51f269a1988971a9c35e798f7b1c773883bd6737907a3807ea1acc982',1,5,'MyApp','[]',1,'2020-12-22 04:51:16','2020-12-22 04:51:16','2020-12-23 10:21:16'),('904ad79fb3ea949c1e13fa4781f5dc7300c7f0e9806862fbfd74b75b528a42df729ff6c9f7a4b735',10,14,'MyApp','[]',1,'2021-02-15 00:28:18','2021-02-15 00:28:18','2021-02-16 05:58:16'),('90d70dee33ec64456c5eb8603f03180aeb00528f61edb752f3754b2d54c8a2a49fdedaa7655edbc8',9,5,'MyApp','[]',1,'2020-11-11 07:02:30','2020-11-11 07:02:30','2020-11-12 12:32:29'),('91470a9433f1b62c5519484efc15778514d8258f534ec268c911d8a32afc8bf4d4e3fb30a0c3c662',3,14,'MyApp','[]',1,'2021-06-02 00:47:15','2021-06-02 00:47:15','2021-06-03 06:17:14'),('9189794bb669b5f2c0340a60a5e7a06c6b9d8138ab0851115f51317cea74880c86bc71c66f14baea',1,11,'MyApp','[]',1,'2021-01-12 03:04:11','2021-01-12 03:04:11','2021-01-13 08:34:11'),('9198874d70db47534977efb009ec5cd033fb4c02ffb75db1f6f85b703bc7d1fe3c9243597bf203ec',6,11,'MyApp','[]',1,'2021-01-12 00:23:27','2021-01-12 00:23:27','2021-01-13 05:53:27'),('91add2d6c210976d906fdde36722051a39308e2da76e3f1581c84240e083e4909a78f0f7ab5734db',13,14,'MyApp','[]',1,'2021-04-06 00:48:50','2021-04-06 00:48:50','2021-04-07 06:18:50'),('91b2aa5e97cd5b9ea232f82fc9764cde9a68d6a52730184b76dc9205ea4140c561c718ef36a1de9d',10,14,'MyApp','[]',1,'2021-03-10 03:50:49','2021-03-10 03:50:49','2021-03-11 09:20:48'),('91c210af8e8195d3ab02484929a9e5ccf8360e894e6c0b145dc95dc3deef774f345b5be797649516',1,8,'MyApp','[]',1,'2021-01-05 06:58:04','2021-01-05 06:58:04','2021-01-06 12:28:03'),('91e3fec7c11cb6e28985ff112c13dceb994183e0e50831b32f2cdfe87af188e006ca7c058054a968',1,5,'MyApp','[]',1,'2020-11-12 02:29:08','2020-11-12 02:29:08','2020-11-13 07:59:07'),('923c4160a908722e8bfd338d0946ddc76b360c53d7af0b94ce3ae8c5ee505150c398b6933b07a384',10,14,'MyApp','[]',1,'2021-05-02 23:18:09','2021-05-02 23:18:09','2021-05-04 04:48:09'),('9269c547f94531bfaa93c50e996eba280e4afd7878a9855e08bc9e9e80bba565f94a3e23942a09c8',5,5,'MyApp','[]',1,'2020-10-21 05:04:14','2020-10-21 05:04:14','2020-10-22 10:34:14'),('92b28c03f31e7f5be992fcdbeac2dca8940c3921d34897f64dd7e5b5bcfedd02677fdf75e535a522',10,14,'MyApp','[]',1,'2021-05-13 00:40:11','2021-05-13 00:40:11','2021-05-14 06:10:11'),('92db51af4872cff51fd248d54059e13b3e3d7edfb429f46fa6dbcfa3ec03007562454d70ff653088',3,5,'MyApp','[]',1,'2020-12-22 04:49:21','2020-12-22 04:49:21','2020-12-23 10:19:21'),('930af7c27989cce51f973821ea89c3c64c28444fa43d98f7683a09004ac84f69352b33400858f9ec',1,8,NULL,'[]',0,'2020-12-28 03:42:13','2020-12-28 03:42:13','2020-12-29 09:12:12'),('931ecf53e6dec84805700ade68fcc9e5c13f5c18270d79841140e90c43a7b4d964ac3d0f119f2c3f',1,11,'MyApp','[]',1,'2021-01-18 05:26:37','2021-01-18 05:26:37','2021-01-19 10:56:36'),('933b44b565978335eb23b02b5ea67f0dc23c86f730e52fbaf25cd30e8eccd9b68b4c8933fce7b7a2',9,5,'MyApp','[]',1,'2020-12-13 23:40:27','2020-12-13 23:40:27','2020-12-15 05:10:27'),('934ac97fb4a226fe6012f0abff71fb0112912792581c11b80e3b92c61c54eefa4949a0bbf02523b6',9,5,'MyApp','[]',1,'2020-11-27 00:18:21','2020-11-27 00:18:21','2020-11-28 05:48:21'),('935dee415c6ad550aecac36d0ffec4429e8314fce34038fb46c1256b4dfa684eaf979d81b31c396f',9,14,'MyApp','[]',1,'2021-05-19 00:04:00','2021-05-19 00:04:00','2021-05-20 05:34:00'),('93875de4bb0b324af5b43b821d7d0e912563c95dc8dc3393678a8c310865d87e3b0be296fb73281e',2,5,'MyApp','[]',1,'2020-12-10 05:35:06','2020-12-10 05:35:06','2020-12-11 11:05:06'),('93c3a161b098a67477a1413d8e47780ebdd5c36a7e1e9febfbfff0ae4c93c1c4af38a73321e2061b',4,11,'MyApp','[]',1,'2021-01-08 06:27:29','2021-01-08 06:27:29','2021-01-09 11:57:28'),('93e3fca3ae00137c11607e7999bf4a4c5fdc038569dbde125e99c5a5c93395b77d13b755381d06e5',2,5,'MyApp','[]',1,'2020-10-29 04:07:46','2020-10-29 04:07:46','2020-10-30 09:37:44'),('941c929183f13a99bc7113615a86a6d9739ff0c0599b87dbb1825cb9682960eacafc98987796d786',2,5,'MyApp','[]',1,'2020-11-09 04:35:40','2020-11-09 04:35:40','2020-11-10 10:05:40'),('9447592c26789dc2ca975f5ae54c1d274e04c9a859722bd83f064cc5982b4917758c7a554b1921bb',1,14,'MyApp','[]',1,'2021-02-16 00:16:04','2021-02-16 00:16:04','2021-02-17 05:46:04'),('94784b2ef845bac56cf56f065ebe10744b3f58f711bacd95b81b7b9b90b7a3a64294c2540af1332a',3,14,'MyApp','[]',1,'2021-04-07 06:52:43','2021-04-07 06:52:43','2021-04-08 12:22:43'),('94e89b1e1daaabfad95c49600dd706c97cc1ecc32643c98d985abca0b9ddf9ea952d3b5d72e370cf',2,5,'MyApp','[]',1,'2020-12-13 23:17:19','2020-12-13 23:17:19','2020-12-15 04:47:15'),('951e533d0cca460603595233211dac90089ff715b3cdc72e12452bc8a1f6e3b98ccbf73f7889895a',2,14,'MyApp','[]',1,'2021-03-12 04:20:17','2021-03-12 04:20:17','2021-03-13 09:50:17'),('95599f462ad81fd83bb1c772a075a700c35895a7d43fecada3b3fc0747745f0625cfe80be8345cab',1,11,'MyApp','[]',1,'2021-02-04 03:52:20','2021-02-04 03:52:20','2021-02-05 09:22:20'),('95f7a859e0ef36db98a801a16eb302cc19af832869ce129e6f29d3eac4f452d11014d6a94e585acf',1,5,'MyApp','[]',1,'2020-12-15 00:25:36','2020-12-15 00:25:36','2020-12-16 05:55:35'),('95f7ff9e25ecae7e2c5ae47960577dc77ad1328c8309d4e2eab4086053a06882d771f2db6e5aaa2b',9,5,'MyApp','[]',1,'2020-11-19 04:50:43','2020-11-19 04:50:43','2020-11-20 10:20:42'),('9615b5991c650dc019f88863e23cd6a29d352536ff515a672113426ffae0334e1aac0a70dd27c8c4',5,8,'MyApp','[]',1,'2021-01-04 03:54:19','2021-01-04 03:54:19','2021-01-05 09:24:18'),('96562f769cbaf3e04f186f8b8aff38ddf3f727d534ba919b09361b8ef80450a7da519865af1df209',2,8,'MyApp','[]',1,'2021-01-05 00:05:05','2021-01-05 00:05:05','2021-01-06 05:35:05'),('9662ea80a5753e5e1bb43535378496624a18ad21f60d25f4202025dbc0f16129abfc6b3067901aec',1,14,'MyApp','[]',1,'2021-02-17 03:02:34','2021-02-17 03:02:34','2021-02-18 08:32:33'),('9686fbf930296092c4d4f396c20823f52d4393a44964116c5f203b25c5b19fda91bea1afe2b07407',3,14,'MyApp','[]',1,'2021-03-24 23:03:15','2021-03-24 23:03:15','2021-03-26 04:33:15'),('979dceb97fc07077c5079dffa10e26ea3eebaa834e39af41216d56c3288d4b19d78bb0ad5e7ac6bc',10,14,'MyApp','[]',1,'2021-04-08 00:19:30','2021-04-08 00:19:30','2021-04-09 05:49:29'),('97a96d9557634d6e2cc79593b4f4ef14f4a26aced0eeef4bce62341d0e4eddcf00ae8062b8ba03e4',18,14,'MyApp','[]',1,'2021-02-19 01:27:44','2021-02-19 01:27:44','2021-02-20 06:57:43'),('97e0f0ba374fcf953319413d1dc0044bcb69ed3c6026d3d32a6d7883813ec4a8d713d00b669d1cf5',6,14,'MyApp','[]',1,'2021-05-07 03:45:24','2021-05-07 03:45:24','2021-05-08 09:15:24'),('9805542b3e3b15499a9fbb3cbae8eeb9bff10954cdbc26febfbaedc0a5464b01e034a7859c471fdd',10,14,'MyApp','[]',1,'2021-02-23 03:34:44','2021-02-23 03:34:44','2021-02-24 09:04:44'),('983c4542e521278b0c0a70cfce830809c1e0d312351e3b74c242c034665d26602bf3a98c1dfa1e97',2,14,'MyApp','[]',1,'2021-03-18 05:50:29','2021-03-18 05:50:29','2021-03-19 11:20:29'),('984d113cb8cb73edd5d612dbc79e1a51e45001458e19a3dbe9a609faac71abd78daf23d07a0c8d7b',1,5,'MyApp','[]',1,'2020-12-24 03:09:47','2020-12-24 03:09:47','2020-12-25 08:39:46'),('988591d1d4ec20c30da642dfcc4cc74ec8d23a7cd13a5d3d5afb1d9ea18b37bea9b398a032789411',9,5,'MyApp','[]',1,'2020-12-11 03:31:25','2020-12-11 03:31:25','2020-12-12 09:01:25'),('9891e8e9af2dcb4dfbe471a1548145b0410e6bcf291fa374ac0a40d7450b7877cd8b89d1e5df734a',2,14,'MyApp','[]',1,'2021-04-05 03:52:46','2021-04-05 03:52:46','2021-04-06 09:22:46'),('98ab6a8f4f75b96cd3fae54f990339678d5af79df7622c6524da40a860955e26b2b1ac4270b01332',8,5,'MyApp','[]',0,'2020-11-18 04:46:12','2020-11-18 04:46:12','2020-11-19 10:16:12'),('98e8662ac0696be75b2965542c89b18e012523dd8439304b317cce39f65f4f5dfa6fd8a31d61d2b2',1,5,'MyApp','[]',1,'2020-10-11 23:38:53','2020-10-11 23:38:53','2020-10-13 05:08:53'),('9907abd9b7878b35dba44b26132113476f72b031ab36b0dd4f574e49729d73bdc4bd9544b51d0087',3,14,'MyApp','[]',1,'2021-02-25 23:11:38','2021-02-25 23:11:38','2021-02-27 04:41:37'),('992757239d799615b56b6e7060a15143713124d10e889ac2b87e07f293735c7f77e2ddc306361411',4,14,'MyApp','[]',1,'2021-03-12 02:03:29','2021-03-12 02:03:29','2021-03-13 07:33:29'),('9979a0f8d7e6d8a6794be2085fb1d4974b1133ad1037a25839daa3fd461022662abab2295409e75b',1,11,'MyApp','[]',1,'2021-02-03 06:36:53','2021-02-03 06:36:53','2021-02-04 12:06:53'),('9987606ba221c6c897ac76aae1544c6811bcaa67f50955a78e60512644b79f3a57831066178dd013',9,5,'MyApp','[]',1,'2020-12-14 03:56:21','2020-12-14 03:56:21','2020-12-15 09:26:21'),('99a13ea79e009417e4da1a295ebd16209b25197e6b6c340e3ed52ddefc534a72a840bf375ca933eb',8,14,'MyApp','[]',1,'2021-03-17 23:49:30','2021-03-17 23:49:30','2021-03-19 05:19:29'),('99ab5e3a2f86f80f384ff49f0f6fd13eddbac34d31a091536f2a6d56002eb3a5e8187bbff81d55d1',8,5,'MyApp','[]',1,'2020-11-12 05:22:01','2020-11-12 05:22:01','2020-11-13 10:52:01'),('99e253ee640c1e92df6e41df8ba95f5b9f8583aafef87366a1a6145436c9ddad787c1b5cc0703967',3,14,'MyApp','[]',1,'2021-02-21 23:47:01','2021-02-21 23:47:01','2021-02-23 05:17:01'),('9a9ca4ae2493082e6313e0f6be1d214de31bf050618f9c99c6688ae6b74480ce6c1387ef9d2d92fb',10,14,'MyApp','[]',1,'2021-05-03 03:24:15','2021-05-03 03:24:15','2021-05-04 08:54:14'),('9ac0567167f2f7c0b9a16dee97181b5136849cd3bc874008488e3edd508e185237b14ba7e2c83c5d',3,5,'MyApp','[]',1,'2020-10-26 03:28:53','2020-10-26 03:28:53','2020-10-27 08:58:53'),('9b21ef5b13762493c6b403b18f5b18fdc1e44e310edf6d40f6954fd71098e39e01db2e14c47cddb8',1,14,'MyApp','[]',1,'2021-06-02 01:57:43','2021-06-02 01:57:43','2021-06-03 07:27:43'),('9b58ea17426165b60476a8fc81d558a35215f1146153ba0d185ad33d22bdf2a5cc3037d71b679ea5',8,5,'MyApp','[]',1,'2020-11-24 03:23:32','2020-11-24 03:23:32','2020-11-25 08:53:32'),('9b5ddd11036a7d971334dd9a2b9d9a3f4086fec3b8c2839c535e43fa1d962a6b5b0070106204f298',1,14,'MyApp','[]',1,'2021-05-12 01:31:08','2021-05-12 01:31:08','2021-05-13 07:01:08'),('9b7bbdcdad13de21bd000be12d75761fbbacc79368d49cc684ffc2fb0d24d957f1b7dbcf04cbe66d',6,11,'MyApp','[]',1,'2021-02-02 00:53:08','2021-02-02 00:53:08','2021-02-03 06:23:08'),('9baf8457a6182fd01cd8c4ecd1f6e1d72837c2081db9a7273cac9642ebba66a2ca6d33480b2022c4',6,5,'MyApp','[]',1,'2020-10-19 04:13:21','2020-10-19 04:13:21','2020-10-20 09:43:21'),('9bea65efb8c4973ac77db1ad7aa92c5df332c5effc79cc4b7f9fea3919f3d9e6be28ba3beb21fd21',10,11,'MyApp','[]',1,'2021-01-07 23:37:42','2021-01-07 23:37:42','2021-01-09 05:07:41'),('9bf9dd843cde8f323824ff7986981560ef8f927e59527eedbeece38b55f216b0da53972384a9d25c',18,14,'MyApp','[]',1,'2021-02-23 05:08:48','2021-02-23 05:08:48','2021-02-24 10:38:47'),('9bff7553e78be434657a94b02df2af8d3e744fde854a9cd2214f7caff14d116ee38993807cbe57e1',6,5,'MyApp','[]',1,'2020-12-01 23:15:05','2020-12-01 23:15:05','2020-12-03 04:45:03'),('9c1eb5157d32b189232dc7b76bcf03f360ee63008e2f82bfa24a90c9bd0498c490da969e79645d7e',5,11,'MyApp','[]',1,'2021-01-08 06:39:14','2021-01-08 06:39:14','2021-01-09 12:09:13'),('9c9fb17bbce29387f265fbe984caba743ea9597ea1f3efab1182efeadf4bdbb013267a9a43ad2135',1,14,'MyApp','[]',1,'2021-02-16 03:48:04','2021-02-16 03:48:04','2021-02-17 09:18:03'),('9ca40543751431c40fb4438a00236ffdd15aa09a13f852b872f938d193ab00bc1b7a1e83fc8743b2',1,11,'MyApp','[]',1,'2021-02-04 22:59:01','2021-02-04 22:59:01','2021-02-06 04:28:59'),('9db0c86de3d0440cb18df128caf45d7ecb9ba31acad13a5b98a29c4f9198b385b45786db348dd3a4',2,5,'MyApp','[]',1,'2020-12-03 23:09:33','2020-12-03 23:09:33','2020-12-05 04:39:29'),('9db928cdb7125c5d1eb8274d0fff32a9121f17e45bfbba6267539eb4cdec370eb1cb00cef54451bf',9,14,'MyApp','[]',1,'2021-03-16 07:21:15','2021-03-16 07:21:15','2021-03-17 12:51:12'),('9de630ebd42655dd5c88120681f6fcdad63f4a21a0a0e9c1daf921b7e705e60a5d771c9dc4f65d20',2,5,'MyApp','[]',1,'2020-10-13 22:48:55','2020-10-13 22:48:55','2020-10-15 04:18:51'),('9dfda10d1458af22535307c96f608e884a1ed3c77096320c13c90237b02ad0f063140f54175b1117',10,11,'MyApp','[]',1,'2021-01-07 23:49:38','2021-01-07 23:49:38','2021-01-09 05:19:38'),('9e1c1d067795ca82a42f1ddf304d051dd02e7c1f4afbc9e7dad1f1e8b7b5ae0bfc28a19c1c679a52',4,5,'MyApp','[]',1,'2020-10-26 03:46:39','2020-10-26 03:46:39','2020-10-27 09:16:39'),('9e4ff83ea0d7fbdef9ad09ca25dbf7aeeeef96db117aeb3da0a39c39a054746915a9b9df49683b08',2,11,'MyApp','[]',1,'2021-01-07 23:50:09','2021-01-07 23:50:09','2021-01-09 05:20:08'),('9e642a267bebfbd2047ddb292dc661e1fa8d64f513930f6e4692d48eb117ddc424fd833a0a029cd0',5,14,'MyApp','[]',1,'2021-03-17 00:07:58','2021-03-17 00:07:58','2021-03-18 05:37:58'),('9e71e1792ca01d185a43cb6d8e6e87b1e1bbaf46bca07f63d7748f493cc56b4fd1c73b11ee7c6301',6,11,'MyApp','[]',1,'2021-02-03 00:31:55','2021-02-03 00:31:55','2021-02-04 06:01:55'),('9eb536c2338c6ce1eabb175accb6514b0b3044b4e85071f1792e57ff0802378d33f001d3f1714324',6,11,'MyApp','[]',1,'2021-01-15 01:19:50','2021-01-15 01:19:50','2021-01-16 06:49:50'),('9ee99027c4fa166cecdc392442e16f15e876370be29b0d2a2261b91237d3172a8629c17ca109a2be',1,5,'MyApp','[]',1,'2020-12-21 00:43:21','2020-12-21 00:43:21','2020-12-22 06:13:20'),('9ef9e9de367e640753bc2c1a7e79cf0f74ee2cb8d6202a1b3f92491a75d8b9d837429861d6003d34',1,5,'MyApp','[]',1,'2020-11-05 03:51:35','2020-11-05 03:51:35','2020-11-06 09:21:33'),('9f6249577f853c9a2ef71381c847138ca686b125e81cdc1d503d2ca098c2eea5eab35edbb13d2a40',3,5,'MyApp','[]',1,'2020-10-21 00:09:14','2020-10-21 00:09:14','2020-10-22 05:39:14'),('9fc220539e904a6b0eef5b127eaa635acbdf36964388606633ce1e5589428211f79137ac86f7fe96',5,5,'MyApp','[]',1,'2020-11-09 04:51:10','2020-11-09 04:51:10','2020-11-10 10:21:10'),('a0890829d3f390c044c3aed63b6ea05d49d512b0b88fe42d7da9ce4c28c2f4f42db3b52bffe53d53',6,11,'MyApp','[]',1,'2021-01-12 04:18:04','2021-01-12 04:18:04','2021-01-13 09:48:04'),('a0c682767bffe68a52b2556a09b01b6db4a65baa66fc2c8e6db9ec3ac70d82d25c447cb50425b375',2,14,'MyApp','[]',1,'2021-04-12 06:02:57','2021-04-12 06:02:57','2021-04-13 11:32:57'),('a0e2a84c0a7f9a0d7a26e9d51315704d1727fb0234c4f7cc8f2943d422d1167f8120d10b7d42f933',1,14,'MyApp','[]',0,'2021-06-27 02:12:59','2021-06-27 02:12:59','2021-06-28 07:42:59'),('a12572a5314e72052d6b1fda05e3ad923cc98cf4bd1c6202b0352a0607b607a580f1e7d7caac93e2',1,5,'MyApp','[]',1,'2020-10-13 03:07:41','2020-10-13 03:07:41','2020-10-14 08:37:39'),('a160bd428c72a227cd72d3d0b92d0528a45804db8c02ab3f867f8e4462a03d3f5dde1892451a4e80',1,5,'MyApp','[]',1,'2020-12-21 00:52:24','2020-12-21 00:52:24','2020-12-22 06:22:24'),('a195e715cf809ea383578cac32238ce919cc58924111f34967cfe91a4b9cdab5c946e20c42b9616e',6,5,'MyApp','[]',1,'2020-10-19 01:23:48','2020-10-19 01:23:48','2020-10-20 06:53:48'),('a1a2e6a979da8db597b6f46e36ca88e40c9b3389a203a8b522c8fd04e0062a2835f76b160a4c5def',1,5,'MyApp','[]',1,'2020-12-01 23:23:41','2020-12-01 23:23:41','2020-12-03 04:53:41'),('a1a4b485992e4a111330a6b1d1633179106e75f2d242c4cb94f216b7b0f243f5073773cd760727b4',4,5,'MyApp','[]',1,'2020-10-26 04:55:59','2020-10-26 04:55:59','2020-10-27 10:25:59'),('a1c9cb418bb6ad01a1fde16000de5cf3a08ae585bbc7dbef310dd1e6453a6d9e63ef5dcd58b28819',2,14,'MyApp','[]',1,'2021-05-02 23:11:16','2021-05-02 23:11:16','2021-05-04 04:41:15'),('a1cbded3fc32c0686e745b25618b3fc5c8af60296fe8076ab6e852d68f3afd79e56b5ce64167f994',1,5,'MyApp','[]',1,'2020-11-05 23:18:05','2020-11-05 23:18:05','2020-11-07 04:48:05'),('a26b3621b3955bbfe31de72a53c43c3033f024a663b925315b363b572926680ff7346ff761d77aff',1,14,'MyApp','[]',1,'2021-05-12 06:02:36','2021-05-12 06:02:36','2021-05-13 11:32:35'),('a2a537e9262d11d23f644f10dc4b9f74d82bf8169b3254c7b8c4cc0af4cc5514adf64c545b87b2ce',3,5,'MyApp','[]',1,'2020-10-14 03:11:23','2020-10-14 03:11:23','2020-10-15 08:41:23'),('a2bec558ac8f9c377e8f325e6d818011fc387ca08b6a9da0785d8ab48f05c9c6f8832fdfd7dad821',1,5,'MyApp','[]',1,'2020-10-12 23:44:25','2020-10-12 23:44:25','2020-10-14 05:14:25'),('a2ee9f5e049b43c49e6d3ff63addd6629860d88da5f77c23cd276e91e4751d2d1581a106cd1ba689',9,5,'MyApp','[]',1,'2020-10-21 05:46:28','2020-10-21 05:46:28','2020-10-22 11:16:28'),('a3072e873c19b75dbe649ddd550ffda482b30eb883ad5c132fec17d234d6f03b5e04cc46d0a4b572',2,14,'MyApp','[]',1,'2021-05-31 00:53:13','2021-05-31 00:53:13','2021-06-01 06:23:13'),('a3297933a4ceb462427c270b13d57b32ce96dccb0fed51fd6be41afd13601b9463630bea2d31013e',13,14,'MyApp','[]',1,'2021-05-14 06:08:45','2021-05-14 06:08:45','2021-05-15 11:38:44'),('a34661e891a63adb041999b9d81ac8cd10a6fea49bdca2e499750961b727e181d2285cddbfa1a356',2,14,'MyApp','[]',1,'2021-05-19 01:17:41','2021-05-19 01:17:41','2021-05-20 06:47:41'),('a38155fafb30fc68f19cdfe98a0b4f9b8f7622d17a9a6e4d18922740c5149009cdc01848695bd9a8',2,5,'MyApp','[]',1,'2020-10-21 04:47:48','2020-10-21 04:47:48','2020-10-22 10:17:48'),('a39c3835068776745fbe5f4c35f5ac3814378eb8fef7a833de4b5a57880b266094b87e3bb2da7141',8,11,'MyApp','[]',1,'2021-02-03 03:35:14','2021-02-03 03:35:14','2021-02-04 09:05:13'),('a3a77571cb4bdfaf32dac1cadf2ee7485ea93ee3b9cffa32013d5795ccc3b7f79fcb99d8ebb49796',10,5,'MyApp','[]',1,'2020-12-15 01:53:08','2020-12-15 01:53:08','2020-12-16 07:23:07'),('a3f19505625326010a333d542d4189b36df1f9d7c7462b770a090bf3cf45077616d16ded5c683b0f',1,11,'MyApp','[]',1,'2021-01-21 06:22:27','2021-01-21 06:22:27','2021-01-22 11:52:27'),('a4043751fc7de50119c8bcab63d29249dccb9bb34e8bf4b450c0510fb370982c3664297c0c32ec39',1,5,'MyApp','[]',1,'2020-10-12 03:15:40','2020-10-12 03:15:40','2020-10-13 08:45:38'),('a41dbaa250e97123500790d17ef0303247da64c4da2e8556d69ee06bf4a42135a02dec52b5709b6d',5,11,'MyApp','[]',1,'2021-01-21 23:18:38','2021-01-21 23:18:38','2021-01-23 04:48:38'),('a428122556ab717a6d8e354962cd549777b0389518f2fb85ba18d014cbc08c17fc7573f34605a90b',8,5,'MyApp','[]',1,'2020-12-11 03:32:24','2020-12-11 03:32:24','2020-12-12 09:02:24'),('a46b5565d9a69266e3cc898c26c19e773cb5dd1eaf2910122c11bbff58804f34fa763b7197c7ebe1',5,14,'MyApp','[]',1,'2021-03-26 04:11:01','2021-03-26 04:11:01','2021-03-27 09:41:01'),('a47f3616d4fb56ad1106a12ccf3df473b6b2501121d4dadfa871c6edb9e51e58969cb76a7284054b',3,5,'MyApp','[]',1,'2020-10-26 03:52:20','2020-10-26 03:52:20','2020-10-27 09:22:20'),('a483021123e8344cb4970d09c196344bdf43f6dde2af1b741ec0776e6cd7f496ac0fb6bbd2726980',2,5,'MyApp','[]',1,'2020-12-11 05:58:47','2020-12-11 05:58:47','2020-12-12 11:28:47'),('a48aceec5a3befc7302f899d140c5a4568fa8d3d5a1ba6884c683ca178646a27ec3ff002b77bd99d',5,5,'MyApp','[]',1,'2020-11-03 00:59:57','2020-11-03 00:59:57','2020-11-04 06:29:57'),('a4c7192301c4ce1716f29d46468180602930f9bc1da0afb505d2d4c04bdaf9314d09de510e8150eb',8,11,'MyApp','[]',1,'2021-01-13 00:16:44','2021-01-13 00:16:44','2021-01-14 05:46:44'),('a4d19f14ba95db06359e6195d256b4c601b45f1c288cd6a3de9b05c09f2e85b79b9cf1cc38633b14',8,14,'MyApp','[]',1,'2021-06-11 01:28:30','2021-06-11 01:28:30','2021-06-12 06:58:30'),('a52bbf8909cc8c97c6c06444a32353af14ee9fbf1e21a289d5d996c0156851ab4d30260bdf0a954b',2,14,'MyApp','[]',1,'2021-04-12 03:18:33','2021-04-12 03:18:33','2021-04-13 08:48:30'),('a5a1da84511566162d50e80c968e664690bdc15b912af399cb20d12d262f1d4ddbbc61c9ed85f302',5,14,'MyApp','[]',1,'2021-03-12 04:19:49','2021-03-12 04:19:49','2021-03-13 09:49:49'),('a60d5e2ba6288dff55543cdf31a5cc0f6f3593d4501f96789e6f858cd14bb27c088570f67a5dae0f',9,5,'MyApp','[]',1,'2020-11-04 05:20:04','2020-11-04 05:20:04','2020-11-05 10:50:04'),('a61a4f85ce91c784fdf2b0dc3dffe8cb174d370c7bd48c7d5a3f69f28279651deb171064beef74c9',6,5,'MyApp','[]',1,'2020-10-19 06:45:55','2020-10-19 06:45:55','2020-10-20 12:15:54'),('a6e18e404a73e4deabe55c71166f72b26384fac06bf537103ae18ca947f6cef9cb316708e9e5674c',2,14,'MyApp','[]',0,'2021-05-11 23:49:06','2021-05-11 23:49:06','2021-05-13 05:19:01'),('a759c2f67fc6e3e0bd9a8ffb764d23d1ac5b159c687903a5f4d339df2be323d9ef75fc2f703db0c9',5,8,'MyApp','[]',1,'2021-01-04 04:54:05','2021-01-04 04:54:05','2021-01-05 10:24:05'),('a75dd59f1980e20b3e3e9c27640db26d7226ac9717206f591be30fe8569490d0ad2e8eedd6eb745f',8,14,'MyApp','[]',1,'2021-06-02 00:52:19','2021-06-02 00:52:19','2021-06-03 06:22:19'),('a760acbd3af160b2c5aea0b37c7e4a8f9e59a4519a787e849a333c4d41bd7f9c1e075266df73b555',2,8,'MyApp','[]',1,'2021-01-03 23:13:23','2021-01-03 23:13:23','2021-01-05 04:43:23'),('a7f3c28833f65e46ee50d876402839d8f36bb7ff8c3bd0c8d577ec04968b3c032c8ede130e0d778b',7,5,'MyApp','[]',1,'2020-10-21 03:39:43','2020-10-21 03:39:43','2020-10-22 09:09:43'),('a831d6a76b1e3d6973495ca752e0642c2182dcc269f9a15953f5b571b3dc5d0b120bcc10d171f6c6',8,5,'MyApp','[]',1,'2020-11-20 01:01:07','2020-11-20 01:01:07','2020-11-21 06:31:07'),('a860831b615fecb9e53838a78672ae96325881b216ecf1e5f11d1f5c14c8d91733b63eb76bbe6233',8,14,'MyApp','[]',1,'2021-02-10 06:55:30','2021-02-10 06:55:30','2021-02-11 12:25:29'),('a86d6b97df324f81a9574e21060903b38987ef391c88a84231cfe58978be78e76cf00e084839a132',1,11,'MyApp','[]',1,'2021-01-28 06:53:29','2021-01-28 06:53:29','2021-01-29 12:23:28'),('a88e993ec4d5fd7638fa70486b4de7287cb518f4cfd79e8839dadbb382de69dbfeb5df30231716f9',5,14,'MyApp','[]',1,'2021-05-04 04:11:10','2021-05-04 04:11:10','2021-05-05 09:41:10'),('a8adf58907c9a41418367aee50bc7eb97eb92e885d590f236e8beba061fc86addf6eaf5bdceaea67',2,14,'MyApp','[]',1,'2021-03-12 04:41:29','2021-03-12 04:41:29','2021-03-13 10:11:29'),('a8ba354ae06de46a5f66b57ccfcea4b830d495503b58726cef3e837148656f47192794f5bc09679f',2,14,'MyApp','[]',1,'2021-05-13 05:57:51','2021-05-13 05:57:51','2021-05-14 11:27:50'),('a8c83b92546ff82445e1d05a686c3467ae98056a6a262cb859f0b2ae8992e8fb5e25149adc8b00f9',1,14,'MyApp','[]',1,'2021-05-11 04:56:43','2021-05-11 04:56:43','2021-05-12 10:26:42'),('a90fde49fb16ad8c6647b03facf7b5c80798bc752c0999b3b1540e62213621565ba83049e2e889c0',8,14,'MyApp','[]',1,'2021-04-13 00:55:17','2021-04-13 00:55:17','2021-04-14 06:25:17'),('a92e365f8f630837bca0874925b8f301e5319336904bbb4741d65e87ee21d7cd3ab418e2120dc8f1',8,5,'MyApp','[]',0,'2020-12-16 02:27:47','2020-12-16 02:27:47','2020-12-17 07:57:47'),('a973b9cf011399c34456d5c6bf297bb3684b359db0f846ff9a122eff25cd7c10dd02fad941aa2496',5,14,'MyApp','[]',1,'2021-04-07 07:01:14','2021-04-07 07:01:14','2021-04-08 12:31:13'),('a9be783f0c8978f9a89c859fee8189a3194d1bf75c15f0c3f07805a8cff1114e3fd1c3c82b1cca4e',2,11,'MyApp','[]',1,'2021-01-27 23:22:16','2021-01-27 23:22:16','2021-01-29 04:52:15'),('a9d2624b2d3796ffd3e0bbb73de2e14d8da6ddbaaf93f8a3034f2501eb7e4d83cd1d4971f700c4e4',2,5,'MyApp','[]',0,'2020-10-29 01:35:36','2020-10-29 01:35:36','2020-10-30 07:05:36'),('aa43117c7058c1049a4f95aa5ed6e81ec1b340afe909eadf62e1dfb86369e9145091ba3b4bc69e99',10,14,'MyApp','[]',1,'2021-03-24 22:41:21','2021-03-24 22:41:21','2021-03-26 04:11:17'),('aabc23f3fdaac8411ffb33843c28df8872cc3e803f12a2dd159e8a2fffb06a90be584e111e71b875',6,14,'MyApp','[]',1,'2021-03-12 04:24:45','2021-03-12 04:24:45','2021-03-13 09:54:45'),('aad0f9b0665279a3d29df1924bdc6b73adb181713ef764faf9127f383409a347d8e5f21cdbd3dfc5',5,5,'MyApp','[]',1,'2020-10-26 04:50:46','2020-10-26 04:50:46','2020-10-27 10:20:46'),('aaee10fea6f181031546e8147089df79924e7fa25ad1f5de612cd2285fec5366f9949ab9bd27ec3d',1,5,'MyApp','[]',1,'2020-11-26 05:41:49','2020-11-26 05:41:49','2020-11-27 11:11:48'),('ab703facb22eadd2c38834983ce73d0dfd4b85a6593178b073cb27a17a602670e2064e331ce80421',13,14,'MyApp','[]',1,'2021-06-03 23:36:47','2021-06-03 23:36:47','2021-06-05 05:06:45'),('abfdc8179758292028734a35c98e5b170771f3b06b52c70725185f5565d4326561d8f65da387c873',1,14,'MyApp','[]',1,'2021-02-17 00:06:21','2021-02-17 00:06:21','2021-02-18 05:36:20'),('ac5413c9b5a4cfd0ed5e4e324e2ee97fc64717652a48bcc70e833d06f0460701860b91346990c444',2,14,'MyApp','[]',1,'2021-03-18 03:22:13','2021-03-18 03:22:13','2021-03-19 08:52:12'),('ac54eb1d964b196cfabe8d0e2026f31bf3155ee2e02d8652bbd613f1bb634932714ae09b59fa5ecd',9,5,'MyApp','[]',1,'2020-11-04 01:22:35','2020-11-04 01:22:35','2020-11-05 06:52:35'),('ac55012e9f48d97cd33e7a7b3f9e535dc5706e9fbb8461dc53598f0cde72fb0f238674f279de8069',6,5,'MyApp','[]',1,'2020-12-22 06:09:49','2020-12-22 06:09:49','2020-12-23 11:39:49'),('ac5d0a9af6ad43a03e0d016100d0d9cefe43dad370a0e45b8db1e3de2a52473400612d42f78a2363',2,14,'MyApp','[]',1,'2021-02-16 00:42:44','2021-02-16 00:42:44','2021-02-17 06:12:43'),('acc2eb3149f3a6582c8b1a8186817905c8c0b2ec7f31a13f7012d94c0f5c9b4cc5f67f334ec62ede',2,14,'MyApp','[]',1,'2021-03-12 02:58:49','2021-03-12 02:58:49','2021-03-13 08:28:48'),('ad08cae2a0d9a2f698950b82e343b766f010392456d1a2c87cd70215577e9c8f4e31e6a2915122d2',1,14,'MyApp','[]',1,'2021-06-11 02:14:10','2021-06-11 02:14:10','2021-06-12 07:44:10'),('ad2ddb71df9339e40aa6100bd5400ba8782bc8bb18fb2c58905037a8ec3beb747514494209e134f5',6,5,'MyApp','[]',1,'2020-12-13 23:37:17','2020-12-13 23:37:17','2020-12-15 05:07:17'),('ad461092cccaea73b64658e70e9ba8470a93876ba7a82efbd505ec96ec97219506d179fe53f8c78a',1,11,'MyApp','[]',1,'2021-02-03 00:35:10','2021-02-03 00:35:10','2021-02-04 06:05:10'),('ad4df2509dc5d35c53705be5788f05a76397f5b5fb06716cb9398f355eecc3c7e81c233debf54565',2,14,'MyApp','[]',1,'2021-06-08 00:46:39','2021-06-08 00:46:39','2021-06-09 06:16:36'),('ad5db7cd5789a4787ff3d1f3fcc5ed1141d9a68695459c1810ebefc6468ebd3016585d6ae1d76e1c',4,14,'MyApp','[]',1,'2021-04-20 06:57:12','2021-04-20 06:57:12','2021-04-21 12:27:12'),('adf99bccf069a8af4b50232a4386832ead9000d0a29d6d4e216e3d743325601d0a00448cbc889eb2',10,14,'MyApp','[]',1,'2021-05-19 03:14:11','2021-05-19 03:14:11','2021-05-20 08:44:11'),('ae0ee2623459e8f22b69bca409d67718c5b9677f46a4a3ef6f3e57e1295255d9ce4bc5c40ce1309c',2,11,'MyApp','[]',1,'2021-01-12 02:09:15','2021-01-12 02:09:15','2021-01-13 07:39:15'),('ae4aa185e287062b2e4d025e27869ddf6ab0e283b1053410ab9c1f11a2be038b13e5c27ec10a6dbf',6,14,'MyApp','[]',1,'2021-04-13 03:48:57','2021-04-13 03:48:57','2021-04-14 09:18:57'),('aedd371b91a9f3adf112571c5d2a1288a8936988c10d8b5585aa23f6cf73f1f9336739907dd866da',6,14,'MyApp','[]',1,'2021-02-11 03:52:08','2021-02-11 03:52:08','2021-02-12 09:22:08'),('af6bcfec2a74c45eea84379f1382196b70d0aab33ca726ec3d60214c2787018cd332366603241700',6,14,'MyApp','[]',1,'2021-03-24 23:16:50','2021-03-24 23:16:50','2021-03-26 04:46:50'),('afb0d531478d676024ff47db467d9c08aa20bb078053797de13e8408876f020d6ab21519cd2e2d46',10,14,'MyApp','[]',1,'2021-05-13 00:10:47','2021-05-13 00:10:47','2021-05-14 05:40:45'),('afd5e20095c5d1c146ae77c55e1d63444d50fa4f23b68770859963b7ee2a9b2bea9e86e6ef2b369b',1,11,'MyApp','[]',1,'2021-01-08 01:06:38','2021-01-08 01:06:38','2021-01-09 06:36:38'),('b03d4f52ab355f14bda7e3a2d7fe904afba011785c67d094db867fbcd9ce0ba5537b1a4ca5aacdbe',2,14,'MyApp','[]',1,'2021-03-10 07:01:53','2021-03-10 07:01:53','2021-03-11 12:31:53'),('b04aa5a803b7b30e2786272a547cf41360aeb69f7e0ff13296997eebef14a06a9e857b7049d06873',13,14,'MyApp','[]',1,'2021-05-06 23:09:14','2021-05-06 23:09:14','2021-05-08 04:39:14'),('b074296bc0aa65bc63974b7413ea03c779968af718ba84472712b3efcae6261796669ed1982824f7',13,14,'MyApp','[]',1,'2021-04-20 06:53:04','2021-04-20 06:53:04','2021-04-21 12:23:04'),('b085f24bb9b8dcd5d983d187109931f530a3127ddcf184ad46016d5658c0256ed80f65d18a839432',2,5,'MyApp','[]',1,'2020-10-14 00:13:30','2020-10-14 00:13:30','2020-10-15 05:43:30'),('b08ef2e83ad34927fb8c5d6291a8aee5926aba2cc4f1a98895d3ddd965d4fa91fcce624b00db3ede',1,11,'MyApp','[]',1,'2021-02-03 23:41:36','2021-02-03 23:41:36','2021-02-05 05:11:35'),('b11d816bcdf6efb5b80059a7c13f782e739cda901090bdddf1a0b3844316bb36af36887d596c49ad',3,8,'MyApp','[]',1,'2021-01-04 04:42:29','2021-01-04 04:42:29','2021-01-05 10:12:29'),('b12c8c1574e4b34d7ccdbd456f68d43e5eac1ab1dcc386f6358d934bfa131f7d49681e27f62c6ee5',2,11,'MyApp','[]',1,'2021-01-11 03:57:44','2021-01-11 03:57:44','2021-01-12 09:27:43'),('b143a7bb14749efe94523afb2398690acfa57b1b00b32304ee41ec63286d43d94c6241fca3fc4267',6,5,'MyApp','[]',1,'2020-11-12 04:05:33','2020-11-12 04:05:33','2020-11-13 09:35:33'),('b153f60a7c8bdb0ccadaeda61203f01ef12de6857ab25547ad007c9e8e4117f028473561dd7f88d9',2,11,'MyApp','[]',1,'2021-01-28 05:29:35','2021-01-28 05:29:35','2021-01-29 10:59:34'),('b1c9948ae073b053e7b77c9b68bf68f3b2909f95540318830f224cb3966b05397b211a9aca116599',1,5,'MyApp','[]',1,'2020-10-12 04:35:09','2020-10-12 04:35:09','2020-10-13 10:05:09'),('b252867087f77928250fa3045cb6e7ef33ac88187c99208e4326e59e77f7071de257805a975ebc1a',7,5,'MyApp','[]',1,'2020-10-29 00:23:06','2020-10-29 00:23:06','2020-10-30 05:53:05'),('b2b1f2f6283cbed97c93e048ec90ad5dd622a21e0c57bafb327ea29ba53b23fb9deb41d5f123ebdd',1,14,'MyApp','[]',1,'2021-06-27 02:10:06','2021-06-27 02:10:06','2021-06-28 07:40:01'),('b2db53be05e9ce7ab53d4a1dddd42a67492a19cdce9fe63d42b81ae3646381f22acea070ec5d1ff9',10,14,'MyApp','[]',1,'2021-02-09 05:34:41','2021-02-09 05:34:41','2021-02-10 11:04:40'),('b3235d42ce5f40b3f4e276c326818c972ae05d9752b4d2903f76605e1d527ebda711b0cfdd02bbc9',8,11,'MyApp','[]',1,'2021-02-03 03:27:33','2021-02-03 03:27:33','2021-02-04 08:57:32'),('b33a88ae2e212f87ab93a52c481db0a6b7f248877e81fe8a46f1b60863ade03135badf0eacb8165a',1,14,'MyApp','[]',1,'2021-02-17 03:23:53','2021-02-17 03:23:53','2021-02-18 08:53:53'),('b34c2c96de949944bb2bdfc1f2fb3b972b528cff09aecd9c2a4e08d875474ad87af670cc72349f9f',2,5,'MyApp','[]',1,'2020-12-16 03:06:40','2020-12-16 03:06:40','2020-12-17 08:36:39'),('b352782c1639a86ecb2b66c3d11151ca28b12c51e5d77c3096cdaa3a176d3d2703638a10e2ce5424',1,14,'MyApp','[]',1,'2021-02-22 00:31:59','2021-02-22 00:31:59','2021-02-23 06:01:59'),('b3dccc57447ae9b91327cf32da7280d5803b1812e0bc4411c1819fc9834cbd181aa70c2f194661f6',5,5,'MyApp','[]',1,'2020-10-19 00:32:05','2020-10-19 00:32:05','2020-10-20 06:02:05'),('b4153b9985f32bc318eae310970ef68bd1656005d7119491bdb879d1a1b7ed527b14ba493a24b1b1',1,14,'MyApp','[]',1,'2021-02-11 03:50:47','2021-02-11 03:50:47','2021-02-12 09:20:47'),('b431f703073478c2ce7ff115dd3a05410faeefd1a1cb86044b970cf375223199194fc810b5d2392a',8,11,'MyApp','[]',1,'2021-01-13 04:18:30','2021-01-13 04:18:30','2021-01-14 09:48:30'),('b4ce6a014bf7e3962a2377ded0772399b0505cfaf64cdd35220a46e6a37a7789473be0a656587e5a',1,5,'MyApp','[]',1,'2020-10-15 23:32:12','2020-10-15 23:32:12','2020-10-17 05:02:10'),('b51954bca3a0812f23b2ef6b803b23a6343eaf65539242d76ef1f257e909d2ef4a9bc0ed0aabe47c',9,14,'MyApp','[]',1,'2021-06-03 07:44:29','2021-06-03 07:44:29','2021-06-04 13:14:28'),('b536aeb5d1c70912b99e52f295369605ffcdc740e20bcc46aef81f69f1a07348aa1317d6f4953285',9,5,'MyApp','[]',1,'2020-11-13 05:56:50','2020-11-13 05:56:50','2020-11-14 11:26:50'),('b5c5571d00d2a13c55644162a8e6eb6fdd66812da4997c07121ae1bdf5c23df0870885e7844b5e9f',2,14,'MyApp','[]',1,'2021-05-31 06:09:45','2021-05-31 06:09:45','2021-06-01 11:39:45'),('b69072100fd9a25e2b2ae03fdd45746d0cd827521e98a4cd3c4676b55b42d74a3ab1a2ba77072735',9,5,'MyApp','[]',0,'2020-11-11 06:30:54','2020-11-11 06:30:54','2020-11-12 12:00:54'),('b6c09d86be75b7db8a93dbd7908b3eb16a9c32e10a3a0f63e0cd70b95ef1c481c32f2a2954d4376c',1,14,'MyApp','[]',1,'2021-03-03 04:04:16','2021-03-03 04:04:16','2021-03-04 09:34:15'),('b6c7b723afbbdca666517c06288a98477170f0c239ba61ffad165a18f128af766a56e0377ab5097a',5,11,'MyApp','[]',1,'2021-01-21 06:45:08','2021-01-21 06:45:08','2021-01-22 12:15:08'),('b7a64b6814405e73efb8ff8d312754cdc3e95e9c44f03339db16983a3fa1e17d2ce76c26e8c4d44b',8,5,'MyApp','[]',1,'2020-10-20 23:46:45','2020-10-20 23:46:45','2020-10-22 05:16:44'),('b87a569ca3bcc5b44f1e0ee48ab20c787de2ededcaed52f8677bad69a113542d1ca981b4bbfb72b5',10,11,'MyApp','[]',1,'2021-01-07 23:55:47','2021-01-07 23:55:47','2021-01-09 05:25:47'),('b91eee16f96231d1544bed687dddaeaf059adf1f99eff293fc69a17e6f957763113d95aa4ba5b77d',4,5,'MyApp','[]',1,'2020-10-26 04:38:29','2020-10-26 04:38:29','2020-10-27 10:08:28'),('b932cd2a457514168cada006ad35de4c693df15ab509a85ef54550a4a3bd4c3535f704ad3b8c2ce1',1,5,'MyApp','[]',1,'2020-10-13 04:03:44','2020-10-13 04:03:44','2020-10-14 09:33:44'),('b96633bdb13138cbc0e47fabda3386bded79324f6d3a56b54cf918b3f7a9c35f25fa9f037e9dd0a9',2,11,'MyApp','[]',1,'2021-02-02 23:11:11','2021-02-02 23:11:11','2021-02-04 04:41:11'),('b97465857379f501d0155a7e1b59b8a50ba26e89a68e1b0917b0977c18a80f15e5599d20979ca77a',10,11,'MyApp','[]',1,'2021-01-25 05:41:38','2021-01-25 05:41:38','2021-01-26 11:11:31'),('b984ac5db5d796396b5cd6b96b1c1b0e900b2d96d9016977771a53efe07d349180c58e0ef4d07088',8,11,'MyApp','[]',1,'2021-01-13 07:11:46','2021-01-13 07:11:46','2021-01-14 12:41:45'),('b9f0036e31b822e5edd58040335be43417e6ad6bbffd6ed95f374bc8cf75ebb5fd3a6ed442247f37',6,14,'MyApp','[]',1,'2021-06-11 01:08:50','2021-06-11 01:08:50','2021-06-12 06:38:50'),('ba09a7e58ca76d3c4c94d76dc15bc88749b5dbc6d33120cc2f1843933ae74da287b6bfb1986f2bf7',11,11,'MyApp','[]',1,'2021-02-03 04:02:39','2021-02-03 04:02:39','2021-02-04 09:32:39'),('baac1d4d2d12b9366801580317552f5a0de8219ff162c6792977535e2979124df603e8219826f630',5,5,'MyApp','[]',1,'2020-10-16 05:59:27','2020-10-16 05:59:27','2020-10-17 11:29:27'),('bad37544bcde1eafc62bbd9ffee357601772792bba4386f0ad08fe03e55cde2d9625eb33d8f5c0fc',10,11,'MyApp','[]',1,'2021-02-02 03:42:07','2021-02-02 03:42:07','2021-02-03 09:12:07'),('bb133cdcd24018b04a1ee39e4402ccd96f2ea61ab1d559931595cc1c71ffaf06e745c940a8d1bcf3',2,14,'MyApp','[]',1,'2021-02-22 00:56:33','2021-02-22 00:56:33','2021-02-23 06:26:32'),('bbd425426c0c36404de1153eb699000514ef2ea2b58357433baf7d97fb4d74385e4d00c305513ebc',5,14,'MyApp','[]',1,'2021-02-26 00:38:11','2021-02-26 00:38:11','2021-02-27 06:08:10'),('bc7806a004bb7abfe7a6891363681f25a82cd91fd318f110c4f40d7287a0a4d9d1caff37d02371d8',2,14,'MyApp','[]',1,'2021-05-19 00:58:39','2021-05-19 00:58:39','2021-05-20 06:28:39'),('bc7d1b4ee45eb4948c181b288042dd54630c0429276b8b70e85b20cfae48993d7cbd3777e4556d60',6,14,'MyApp','[]',1,'2021-03-26 04:13:38','2021-03-26 04:13:38','2021-03-27 09:43:37'),('bcdb3de99af29380e3a35e57055645abc751ca14837c04fa5b2958012fc7ba09ed4f4f95045da8bb',10,14,'MyApp','[]',1,'2021-04-22 00:56:33','2021-04-22 00:56:33','2021-04-23 06:26:33'),('bcf335d0e51f95580a56a750bad7f22d3db90f981e2f6fdfbf0da12fe994d81c99a0c1766127bbf7',5,5,'MyApp','[]',1,'2020-10-20 02:12:07','2020-10-20 02:12:07','2020-10-21 07:42:07'),('bd1d7ba741511f57e97068006464e1a5c1b4f09d7773aa73d54fde2a622278aaefabd8280def87c4',6,5,'MyApp','[]',1,'2020-10-26 04:41:12','2020-10-26 04:41:12','2020-10-27 10:11:12'),('bd1e194d300b245d07d07acfcaa2fd888b822463c0500ecf8a38b8039104296be085314cf556b5a1',6,14,'MyApp','[]',1,'2021-04-12 05:36:51','2021-04-12 05:36:51','2021-04-13 11:06:51'),('bd34317a0b535bd6389ea88b8e7f74618194ce7ce742ab00b923f8d235878d4cb02dcb33808094c2',6,11,'MyApp','[]',1,'2021-01-25 05:43:11','2021-01-25 05:43:11','2021-01-26 11:13:11'),('bd480245f34319b5142dc89b0f05737742079041163fa85ac7aebde343908936a7c21b9b0ba9eed6',6,8,'MyApp','[]',1,'2021-01-05 05:17:47','2021-01-05 05:17:47','2021-01-06 10:47:47'),('bd530b79ea421ed3a0c4cc41e09809c69ce76896ae2bd2283fe36134dc61accd34dc3a9bd9abf85e',11,11,'MyApp','[]',1,'2021-02-03 03:59:22','2021-02-03 03:59:22','2021-02-04 09:29:22'),('bd5e2748c77a5ac4c4edd030a2e2f7ab2041616b0a2e450297bd2f395e2a5c0ccd646f17323e9049',1,5,'MyApp','[]',1,'2020-10-12 00:42:30','2020-10-12 00:42:30','2020-10-13 06:12:30'),('bd6eb0cf78fbc15b90c5cff53619c0e565138d9e3cfda61b9b5768f28a3a66a9794eb9f44a13434d',2,5,'MyApp','[]',1,'2020-12-10 04:42:20','2020-12-10 04:42:20','2020-12-11 10:12:20'),('bd9d08e5dbedb8cd371a9030a3cc2dc736090cb2352dcbce03b697a1edced9e009e1258e3ecaee6a',2,14,'MyApp','[]',1,'2021-04-28 23:48:44','2021-04-28 23:48:44','2021-04-30 05:18:44'),('bda75eab83438952056e6a7bdc97663b3edf06b0441abece093955b36b638df8d236bc01c8a80805',3,5,'MyApp','[]',1,'2020-10-14 01:42:54','2020-10-14 01:42:54','2020-10-15 07:12:54'),('bdae3f74beaaf85d3d30db57ba2dce2fd6725641125533969d9131c3ca30a74f2152dae43e488730',5,14,'MyApp','[]',1,'2021-06-02 00:49:23','2021-06-02 00:49:23','2021-06-03 06:19:23'),('bdf6619ff7b59994e94d51f58793e79909a94c3ba96c5cc3bda34fd088004a8055f5cf3cf2092350',1,14,'MyApp','[]',1,'2021-03-02 00:12:46','2021-03-02 00:12:46','2021-03-03 05:42:44'),('be07f5768235dd6dd1c94cb194ebca6442cf5597e6e40ea73551069850ccd24dd6c4e55723e65e4b',7,14,'MyApp','[]',1,'2021-05-02 23:32:01','2021-05-02 23:32:01','2021-05-04 05:02:01'),('bea5ab6841535e1d3c74b6ee89ed005741712a0e07d8a811801c7f53b30c63f47b9a84012e79900d',8,14,'MyApp','[]',1,'2021-02-23 03:26:48','2021-02-23 03:26:48','2021-02-24 08:56:48'),('bee144206fba80d62fb7b736209b368650d8e6737aa98b8c7a7677279f45e94ecad9d4db1b03a2a0',9,5,'MyApp','[]',1,'2020-12-22 04:36:23','2020-12-22 04:36:23','2020-12-23 10:06:23'),('bf16fe81798c8ef0b3669404f466511ba1e71821e168f287367cd388a5a67dad4d5b8ee3b68f888f',8,5,'MyApp','[]',1,'2020-10-26 04:59:09','2020-10-26 04:59:09','2020-10-27 10:29:09'),('bf47cb1b4da784a31d6993c3b6428b088e4e02d7cf63190a7715577c6c81d87225ba40969fdc0e41',3,11,'MyApp','[]',1,'2021-01-21 22:51:04','2021-01-21 22:51:04','2021-01-23 04:21:03'),('bf87e4b1d0f7834fccbddec66a8f345636f1c0ecc19fa662539729e4dce0e0ec7442eac6184be7b4',1,5,'MyApp','[]',1,'2020-11-03 00:04:20','2020-11-03 00:04:20','2020-11-04 05:34:20'),('bfed98f66d39ff5879f51294e021c833482d4baee3e667f78a2026cd04d725151fa31b0664a9342c',6,14,'MyApp','[]',1,'2021-03-24 23:10:46','2021-03-24 23:10:46','2021-03-26 04:40:46'),('c06fa02100e15ddb821c1e85f22cf1ab8ef69413753e93f8c0d7bbf5560d63d1b5f510d0ed82fcf9',4,5,'MyApp','[]',1,'2020-10-21 00:23:23','2020-10-21 00:23:23','2020-10-22 05:53:23'),('c0739002e4c8e98f37f9577168c29f3be8aebe228c8e93d457fae63b320b2e792efae97a9a7ed586',10,11,'MyApp','[]',1,'2021-01-08 03:25:07','2021-01-08 03:25:07','2021-01-09 08:55:07'),('c0f32fc6f3b6b086e1c0cbebd8d9ebf029b06a82191d9cb51ebc05c93c8a3c001e6cb9f40f9c0f6d',4,14,'MyApp','[]',1,'2021-04-20 06:52:08','2021-04-20 06:52:08','2021-04-21 12:22:08'),('c0f7073c1912aa52aef01a2ca6e5c640dd0330f7b218caa95d1a96bb3370582d997298781992560e',8,11,'MyApp','[]',1,'2021-01-15 01:37:47','2021-01-15 01:37:47','2021-01-16 07:07:47'),('c0f9715ad52451ffc4ded8d50f998e25959fbe8a5bcf7fb298c3e95923ee41f96e7959bf4f6f0424',2,11,'MyApp','[]',1,'2021-02-04 04:46:34','2021-02-04 04:46:34','2021-02-05 10:16:34'),('c10ef001f2ad380b9b5fd3af2184bb37344cadb9452c58f15f9ad367584bacdbd5636c69036199f4',9,5,'MyApp','[]',1,'2020-10-28 23:39:13','2020-10-28 23:39:13','2020-10-30 05:09:11'),('c1a97c2962d6951ce5ecadd168f69f051ad7f8a5e45c3835b5285ae6aa247e5331c290001540d3c7',6,11,'MyApp','[]',1,'2021-01-15 01:43:45','2021-01-15 01:43:45','2021-01-16 07:13:45'),('c1f60bd9c7e07c4e4750fbaa0d7d662deccccdc95bece36f1154bf16995268f4cc9c37363c482c9f',6,5,'MyApp','[]',1,'2020-11-26 02:58:56','2020-11-26 02:58:56','2020-11-27 08:28:56'),('c211e33f258e71cbe409bdd1b489ef0c7b68d9a4b71d4f0b5d1ae8ec8c992edbe8038bba6c4f8e1c',6,14,'MyApp','[]',1,'2021-03-08 00:37:49','2021-03-08 00:37:49','2021-03-09 06:07:49'),('c2a984f5a5ad1973114488509c5800835cdb3e9702e7e4b5d9763fb44307a8a4f9c16f407cb208e9',8,5,'MyApp','[]',1,'2020-11-12 02:28:33','2020-11-12 02:28:33','2020-11-13 07:58:32'),('c2ce469addff132a1e7a137c1a22eeda0039fbee171a70d91a1f1ccc4d0de28f8379715e48f218e7',10,14,'MyApp','[]',1,'2021-05-03 00:49:15','2021-05-03 00:49:15','2021-05-04 06:19:14'),('c3084461457bb7f53bf0f2b4106d15bf4c3e37942b99d8d9769ce54009fcfd699ac43297e52e0af4',1,8,'MyApp','[]',1,'2021-01-04 04:43:59','2021-01-04 04:43:59','2021-01-05 10:13:59'),('c30e1f178418ea2c525aaba3f727b2fe478b04cba76f71569abf7bbb7c075549ac429eceeeb77489',2,5,'MyApp','[]',1,'2020-12-24 03:08:57','2020-12-24 03:08:57','2020-12-25 08:38:56'),('c3186666ae222ac373aeaf2d41bf92fe77e0cedb6e7f8d1e71b5044351e8b216eb5a420c6826b4f2',1,5,'MyApp','[]',1,'2020-11-25 22:40:54','2020-11-25 22:40:54','2020-11-27 04:10:54'),('c3609888bc1c210e21b6bbbadb52d9bdbff6d72b792974d2fbd147db033909fe6acd2728b4d0fff3',6,14,'MyApp','[]',1,'2021-03-17 23:31:39','2021-03-17 23:31:39','2021-03-19 05:01:39'),('c382619ab00879634bdd1a79b697cc0d1e0ef04e8b5de1cf1e866e716dd5aa42cb842039e6c5827f',6,14,'MyApp','[]',1,'2021-02-11 05:28:41','2021-02-11 05:28:41','2021-02-12 10:58:40'),('c384bf1d1cd3b0e9c712085455d4ee432e539a5a063b42bb477965b03bd4d0a31b6801e648e6539d',2,5,'MyApp','[]',1,'2020-11-09 01:31:08','2020-11-09 01:31:08','2020-11-10 07:01:08'),('c385904d6e5acea282e949fa56c530607b4f7f81355edcb87cc82eb7f44b998fb3569f80d01a7adf',2,11,'MyApp','[]',1,'2021-01-28 02:09:07','2021-01-28 02:09:07','2021-01-29 07:39:07'),('c39dba6f3cbee3e8b0d7823cb4369139dc690e37279c7de5b5a213318d5827d9bf46335e0425340b',10,11,'MyApp','[]',1,'2021-02-04 04:45:49','2021-02-04 04:45:49','2021-02-05 10:15:49'),('c39e5924ff5549df4b525d855598238eefcbe8541856e5d906c49683727a9904aaf0d0c96cfb4ef7',1,14,'MyApp','[]',1,'2021-02-24 23:07:01','2021-02-24 23:07:01','2021-02-26 04:36:55'),('c528ead4a0a0c2a7c56d6c4d98b43f7d957f32f4d845a9ecd986b99a01921fb9632129b98ea9755a',1,5,'MyApp','[]',1,'2020-12-14 23:05:16','2020-12-14 23:05:16','2020-12-16 04:35:16'),('c543cdec85b7c4fe2db91dde2777fbeffd85b6d8eac975856982cedc74cc789f5faafed9ce16ebed',10,14,'MyApp','[]',1,'2021-03-24 22:58:29','2021-03-24 22:58:29','2021-03-26 04:28:28'),('c54c9ef8c96f737fe2c31a500bfea1ee35b58c08fd5f488635848c81b0e23cbb1c2b58853bf52001',5,14,'MyApp','[]',1,'2021-03-24 23:08:28','2021-03-24 23:08:28','2021-03-26 04:38:27'),('c6498c351dddada3bdb0e74ca3f0a3d30740cd7e0382f108a749f083d2f1d883051c36e209f6f92a',10,14,'MyApp','[]',1,'2021-03-03 03:55:02','2021-03-03 03:55:02','2021-03-04 09:24:57'),('c6906656f78da872c56c648f32728fc6bfcba7151af45a5fe02cd674a1a5d10a2025c91663d28b1c',6,5,'MyApp','[]',1,'2020-11-27 00:14:10','2020-11-27 00:14:10','2020-11-28 05:44:09'),('c69c473968a54332f9775ec484a15edafad3bd3a92cd7d77086116c99ad503158b6ec71ef2733846',2,11,'MyApp','[]',1,'2021-01-08 06:29:10','2021-01-08 06:29:10','2021-01-09 11:59:10'),('c6aadcefb427d478c54be683a3f26d64f22d7b69d87380c159a13e0055039fa4b4dc4948cd83d8b9',2,14,'MyApp','[]',1,'2021-05-11 05:37:10','2021-05-11 05:37:10','2021-05-12 11:07:10'),('c6b9db91d2983c5a80dba53d88d9a517a4745858c5735d854e19d809e2f25f1f1b8eab445fc8e991',2,14,'MyApp','[]',1,'2021-05-11 05:05:14','2021-05-11 05:05:14','2021-05-12 10:35:14'),('c71184ab1508126adaa4798422bcbe622cbc048e42affe1d3c80f3b171e7c79c68673a99dec7e611',8,5,'MyApp','[]',1,'2020-10-21 05:45:38','2020-10-21 05:45:38','2020-10-22 11:15:38'),('c72a03e2129698025761dc4531f26e4368f4468f9bfcce9a52145c89f852d96318d5028641574130',6,5,'MyApp','[]',1,'2020-10-19 00:25:57','2020-10-19 00:25:57','2020-10-20 05:55:56'),('c733448d48d04bd944d5cd5cc003ea04c2f0368e24860ec7258847ebee3c68c3cf547b304227d416',10,11,'MyApp','[]',1,'2021-01-08 04:05:53','2021-01-08 04:05:53','2021-01-09 09:35:53'),('c75ec1fbb890d70b1736a9996845c31ad7c69adf240a83997dcffdb33cf60b9be923f7fa64ff72e9',10,11,'MyApp','[]',1,'2021-01-20 04:47:16','2021-01-20 04:47:16','2021-01-21 10:17:15'),('c783fa5daf92ff704ea7fe34e2ce9bd7bd3ed7f51856e97a183e67f386b69e2a5751139c873f880e',1,14,'MyApp','[]',1,'2021-05-13 03:22:20','2021-05-13 03:22:20','2021-05-14 08:52:20'),('c7912af7a0a1ffdb2c5b5dd7e07abfbf4c1ca80a1ddfb7044c97db3a54350dc63d701746e0724c6f',9,11,'MyApp','[]',1,'2021-01-08 05:44:14','2021-01-08 05:44:14','2021-01-09 11:14:13'),('c80e8c9644f3d40c9391161e20a5c31ce54c6befade32cc7e69fdf7e45e759f045b49c067e53f2b3',10,11,'MyApp','[]',1,'2021-01-20 03:02:39','2021-01-20 03:02:39','2021-01-21 08:32:39'),('c82041238f54fae02b501b17f633360af6faf4f546714d67a7fef4bf7332892ada6e7150c9cdeb2a',6,5,'MyApp','[]',1,'2020-10-21 05:19:27','2020-10-21 05:19:27','2020-10-22 10:49:26'),('c844afb4beab1419d74571386328a8787a5118f8f764a272d87b8f7421ac3a00241e3c1643e03c2e',10,5,'MyApp','[]',1,'2020-12-10 03:43:55','2020-12-10 03:43:55','2020-12-11 09:13:55'),('c885a6566bf634845f9e8a3c5ed4e6dbe7ebbd27d1e0ffc8e53c98cfd5b5a5da821db2e0227ac594',4,14,'MyApp','[]',1,'2021-06-02 00:48:09','2021-06-02 00:48:09','2021-06-03 06:18:08'),('c88e5864a6889fc52bda40ef3c8de57f7c054ac974a312a7bd25054551cf19ae352bd1455b4539e6',1,11,'MyApp','[]',0,'2021-01-06 05:31:26','2021-01-06 05:31:26','2021-01-07 11:01:26'),('c8be69a4a20cff9596f807ff9b63f683324960bf22071feb7d5b851ef968134242ebcf022b29f82c',5,5,'MyApp','[]',1,'2020-10-21 05:07:55','2020-10-21 05:07:55','2020-10-22 10:37:55'),('c8e3dbaabd63e796fcf0f0ed7f020d843ec621ef075b1c39ccd27487ace45a4f2607a0cf1f4b9e70',6,11,'MyApp','[]',1,'2021-01-13 23:50:06','2021-01-13 23:50:06','2021-01-15 05:20:06'),('c8fabd0e0ed23929759d32388586d235456f92c2f80640f2d8fad2ecc5007c826ad81cbb70d1ffe3',6,11,'MyApp','[]',1,'2021-01-12 05:38:34','2021-01-12 05:38:34','2021-01-13 11:08:34'),('c934285c34e78f6b23c438f964fc0033869f5ba64040d837381027c23574f122e1fa62668c202456',1,5,'MyApp','[]',1,'2020-12-17 23:41:24','2020-12-17 23:41:24','2020-12-19 05:11:21'),('c94b4a047203ca246b1a77ebc8aaf808fe2d744800e844cc2317328d50485d9314e545004a5b5408',8,5,'MyApp','[]',1,'2020-11-24 01:26:27','2020-11-24 01:26:27','2020-11-25 06:56:27'),('c95411c3cd484c525d20786f0bde819730b7522ed6738a39b7f79f5d47ca263926c96503dd6ca76f',1,11,'MyApp','[]',1,'2021-02-04 23:52:29','2021-02-04 23:52:29','2021-02-06 05:22:29'),('c955afe69ee97034e86dce2d62af62d61b544428c71ade8cdf9f6b41ea73259548e6a6d72864a3f4',1,5,'MyApp','[]',1,'2020-10-09 05:04:35','2020-10-09 05:04:35','2020-10-10 10:34:35'),('c97cad382f0e24742ba23fecff965b210795b7de64b927c5a705c0bb8a9e17e2420db6491c50804e',2,11,'MyApp','[]',1,'2021-01-28 00:50:51','2021-01-28 00:50:51','2021-01-29 06:20:51'),('c98f7aedb1576afb9070080fc417d58300522ed0410ad104ac2c7813b0f54a8e0ee2be15afae1dbc',2,5,'MyApp','[]',1,'2020-12-07 00:05:22','2020-12-07 00:05:22','2020-12-08 05:35:20'),('c9fb32184a4125b1a0383e520ba9c2a03e8940c961ee9991aaeb667cc25cb13956d9c4d951e76b20',8,14,'MyApp','[]',1,'2021-03-12 04:29:42','2021-03-12 04:29:42','2021-03-13 09:59:42'),('ca631e6ff45d015ef13767f6bcbf027c4453f960dab7984a1cdeff4e1f6b0e1a1c960e98e996bf4f',2,14,'MyApp','[]',1,'2021-06-03 06:46:17','2021-06-03 06:46:17','2021-06-04 12:16:10'),('ca8673f9258ca499351840c629bec18a66fc5b35ec113f049d765bac083e125b6631f9f44ad33052',6,11,'MyApp','[]',1,'2021-01-11 23:49:01','2021-01-11 23:49:01','2021-01-13 05:19:01'),('cab0f2fe019298d59257201d3019e9429ac5d76f20d7311e14789a99c5db8f4d88e37d37e079e37b',2,5,'MyApp','[]',1,'2020-12-13 23:50:26','2020-12-13 23:50:26','2020-12-15 05:20:25'),('cac169a5a2a5d5ba6762f233176431ee29457f5cf18986d114473ee4fc74519e1b41f7a412303f31',8,5,'MyApp','[]',1,'2020-12-11 05:54:46','2020-12-11 05:54:46','2020-12-12 11:24:46'),('cad72e95c81edc595783dd38e6227d59203571b4f66a48cfbbf9619b46f5b2e8b23413dbd9a4af5d',2,14,'MyApp','[]',1,'2021-06-04 06:56:19','2021-06-04 06:56:19','2021-06-05 12:26:16'),('cb08737b7e2de4df70a20f5a8e4efd5f193396d052b1e01fb8f830f93d630f0701454653918f9eb6',5,14,'MyApp','[]',1,'2021-04-20 06:54:18','2021-04-20 06:54:18','2021-04-21 12:24:18'),('cb2016abccb0f60a3694528be113ce87c53018e83590085b6b9990ac9cc1a6f3ecf3d22d679eebf2',1,5,'MyApp','[]',1,'2020-12-16 05:03:00','2020-12-16 05:03:00','2020-12-17 10:32:59'),('cb3c863ae13e4f2b98bb35771a1e13a9ea922518c039d36379e62adc214e40f06dfa4a1e10e2dbbe',2,14,'MyApp','[]',1,'2021-02-22 00:31:30','2021-02-22 00:31:30','2021-02-23 06:01:30'),('cb4754ff50570c5f066cefb61ca009cc55c332b760501edab044e47da770108157bf426dd8b602f3',13,14,'MyApp','[]',1,'2021-04-07 07:00:11','2021-04-07 07:00:11','2021-04-08 12:30:10'),('cb536760ed69d2c096b69313c7453c4cc27ff9e63584f8f76809a40055fe26f257afc8cd0ce46483',9,8,'MyApp','[]',1,'2021-01-04 05:15:57','2021-01-04 05:15:57','2021-01-05 10:45:57'),('cb64a06b13925606c916722f2538b7bc3430617b43bf057b18482f5e23297bc4cc1d6a17c2cae2b0',9,14,'MyApp','[]',1,'2021-04-20 05:45:27','2021-04-20 05:45:27','2021-04-21 11:15:27'),('cbe43540047b59b4459f758b543148fbf1a2058ac8aeecdc55986144c69fc92416740a8b7bd49de4',10,5,'MyApp','[]',1,'2020-12-23 03:07:53','2020-12-23 03:07:53','2020-12-24 08:37:38'),('cbf65788a2482371508c98a11750e9f7f0805c21a2002a885c6ad160c89d86b2dd8522af027a5075',3,5,'MyApp','[]',1,'2020-10-16 01:14:51','2020-10-16 01:14:51','2020-10-17 06:44:50'),('cc1acc1b5c615a2b5f230893de47f580ad1104a6af7d4eb5e534f29fd9feef7e81bc252e9a2c39a3',2,14,'MyApp','[]',1,'2021-02-25 22:59:39','2021-02-25 22:59:39','2021-02-27 04:29:38'),('cc372dba922e0e5ba56c69a77b9e11f76e96b6c5d9d944416b88591296e0a2709461eb776d93700d',6,11,'MyApp','[]',1,'2021-01-18 23:28:31','2021-01-18 23:28:31','2021-01-20 04:58:29'),('cccd960220f243637b7c2a74530b3a7030d6abeb52c3f8554c25a8a8152da2ef72d6e054939b570d',3,5,'MyApp','[]',1,'2020-12-22 04:55:45','2020-12-22 04:55:45','2020-12-23 10:25:45'),('cce01db4d68910d1ba5a9191df01e5ffd356325a1999bf8db2bd18cf9893e93b9e0c0f7d9efd95c2',2,14,'MyApp','[]',1,'2021-06-02 01:47:52','2021-06-02 01:47:52','2021-06-03 07:17:51'),('cd318cd1feabb73abbdd85ca7aff13f5a7960baab11afc4d2639ce33ff62da89074d14f8a844ceab',13,14,'MyApp','[]',1,'2021-05-06 23:07:16','2021-05-06 23:07:16','2021-05-08 04:37:16'),('cd44f41c592693aaa2f7855fba4c18052080b2fd66bf6ef083da3e316264fccce10cafeca1801ac1',4,11,'MyApp','[]',1,'2021-01-08 06:34:20','2021-01-08 06:34:20','2021-01-09 12:04:20'),('cd93db7133cc57221efb40994dccc86a3b63c27637480cd2c3975e07e650b0d0773f807e4bbcce6f',5,5,'MyApp','[]',1,'2020-10-16 05:31:18','2020-10-16 05:31:18','2020-10-17 11:01:18'),('cdd893e59d52c2b12cb8401101bb7605206b541a1bec2feea0e000afae22c273881eb8301955ffad',1,5,'MyApp','[]',1,'2020-11-26 05:16:04','2020-11-26 05:16:04','2020-11-27 10:46:03'),('cdf01c9e2b93429e2ddb5aadca899f526284da511b6824212d969a2af231802d11561872e0d2d904',2,14,'MyApp','[]',1,'2021-06-09 23:10:59','2021-06-09 23:10:59','2021-06-11 04:40:57'),('ce418d1e743258e7e76c3f29cad8ae6c2303761fc580ea4de5623ad44db4d07239b6631f0ba0f97f',6,14,'MyApp','[]',1,'2021-05-04 05:37:13','2021-05-04 05:37:13','2021-05-05 11:07:13'),('ce735405c1003480bbfe79aaac17b1166198810cadf4d0c20fb79dc0de435f1cccec3f52d08106dc',2,14,'MyApp','[]',1,'2021-05-18 05:40:55','2021-05-18 05:40:55','2021-05-19 11:10:54'),('ce7a8bf801e706413b2a7bcd6c277cee36d898e8f853cc38630b664ecfbdbb89ff951df7bdfdfae3',6,14,'MyApp','[]',1,'2021-02-26 00:40:10','2021-02-26 00:40:10','2021-02-27 06:10:10'),('cef30227a796867ae493c49d6ced7860125db9e10e499b16f301e531ecf793ed55bebc3f24c81a37',1,11,'MyApp','[]',1,'2021-01-12 23:18:01','2021-01-12 23:18:01','2021-01-14 04:48:00'),('cf2f9bfa6d5be4267ce25ee8db86fba5aa9092e12d029f1879d3d4c9a7563b7b818c072f823c26e0',2,5,'MyApp','[]',1,'2020-10-14 03:03:29','2020-10-14 03:03:29','2020-10-15 08:33:27'),('cf450dbda2416e358bbe564346633d789883a8ae05ad84f30eb2285cd9b43f347e2e1e95c8e0fd04',1,5,'MyApp','[]',1,'2020-11-02 00:42:12','2020-11-02 00:42:12','2020-11-03 06:12:10'),('cf5b709f068c15fd0ddf3e0cd5c987b4214d9d59cd68bc751430a18e53951d8a4240d8df5435b9f7',2,14,'MyApp','[]',1,'2021-03-16 07:36:45','2021-03-16 07:36:45','2021-03-17 13:06:45'),('cfe8caca6014a099c6ec70767243a938f8ddbc1cd868402a862a6dce95ec2db381dc216494ca6153',9,5,'MyApp','[]',1,'2020-11-05 00:49:46','2020-11-05 00:49:46','2020-11-06 06:19:46'),('d07289aa11f4c955936b218e05a655ddf0714930b0b5b0723aeeb358286bb453d765c4b52323210d',6,14,'MyApp','[]',1,'2021-04-20 03:08:00','2021-04-20 03:08:00','2021-04-21 08:37:59'),('d07d2a2368a9a89e7f425597ecd339208ac226050e8b868defc9d96b0f0aa89d5e23545d4f784fe8',8,14,'MyApp','[]',1,'2021-04-22 01:25:35','2021-04-22 01:25:35','2021-04-23 06:55:35'),('d09d70cedac0d1b6abc565e80074e1e2d805fc6f281848f7de74343d082a6d191e3d61a6add641b3',1,5,'MyApp','[]',1,'2020-10-15 00:43:47','2020-10-15 00:43:47','2020-10-16 06:13:47'),('d0b4488e237423f2a582abf88b7f02806d660fca6813eba5d414ca9808f30dae2d64e969d8078998',1,8,NULL,'[]',0,'2020-12-28 03:44:10','2020-12-28 03:44:10','2020-12-29 09:14:10'),('d0e4aa86fc5b31ebfda3cb12d92adc5ca612bca8605c6c1805d17690090417180b730a8ba3a0d152',4,5,'MyApp','[]',1,'2020-10-21 05:02:51','2020-10-21 05:02:51','2020-10-22 10:32:51'),('d107102f41618db6526df1143c7de61f57ae0ed7bf3deea038a4c7054b0380509344b0bf4c5831b6',18,14,'MyApp','[]',1,'2021-02-17 23:02:37','2021-02-17 23:02:37','2021-02-19 04:32:37'),('d10a26a9787a7289d0dafb381d36688e9244ea941a884019e0bd3324296df9675f9f076ba1cc7eec',1,5,'MyApp','[]',1,'2020-12-08 05:27:53','2020-12-08 05:27:53','2020-12-09 10:57:53'),('d123aefbbcf687712fb60422c4469605754046c6d26e8b15ed0020ad24288bbc04c7591198b743bc',1,14,'MyApp','[]',1,'2021-05-03 00:53:29','2021-05-03 00:53:29','2021-05-04 06:23:29'),('d1759b5339099c511bc02a3c3a84ee6414ad5c44f859917f79d780ca7e6c3c339cb7f26fb51a3ad5',10,14,'MyApp','[]',1,'2021-05-04 06:51:40','2021-05-04 06:51:40','2021-05-05 12:21:37'),('d17b32670cd6562450e5c4f19e9e257d3e1b4c963cee3999760453219db3140f4f331a27daae91fc',1,11,'MyApp','[]',1,'2021-01-06 06:07:34','2021-01-06 06:07:34','2021-01-07 11:37:34'),('d1b14aef759d5e6ba0f49f6441831cb9cbcc1b739e1d78f1253529a40efb9699437cb95c0953a029',5,5,'MyApp','[]',1,'2020-10-16 05:42:01','2020-10-16 05:42:01','2020-10-17 11:12:01'),('d20202e50c3773e661ca30dcd20f5e45329c974225bb85385fc07c7753213103d08462e8689d573f',2,11,'MyApp','[]',1,'2021-02-04 04:44:28','2021-02-04 04:44:28','2021-02-05 10:14:27'),('d2724693efc75e1405b987c7c7cf43d236def0bae3fc59c588ebeac995d252c1e1b23d062f58e82f',10,14,'MyApp','[]',1,'2021-05-14 04:07:00','2021-05-14 04:07:00','2021-05-15 09:36:59'),('d37be8b538430e84faf49165d74419a21501dd2343d7534184137164f2cd3d3d731be446a62849f6',9,14,'MyApp','[]',1,'2021-04-13 01:17:57','2021-04-13 01:17:57','2021-04-14 06:47:57'),('d42a72118a4ec462d3ec0555acd2e622c54d688c72736f09ca5cc8778aad029493016288741ac122',3,11,'MyApp','[]',1,'2021-01-15 01:10:22','2021-01-15 01:10:22','2021-01-16 06:40:22'),('d4b3a9f2ec7f94cb1e9577dab630d7c6609e3f036f8f0d454071e64389c80b5c1bee54c05a1fb6d8',10,14,'MyApp','[]',1,'2021-03-21 23:49:59','2021-03-21 23:49:59','2021-03-23 05:19:58'),('d4b644f11d4ebb9852ed3afbc5519bf81d68d55018a6016c007de5133c7cbe969735484f77673b3a',2,14,'MyApp','[]',1,'2021-02-26 06:25:08','2021-02-26 06:25:08','2021-02-27 11:55:05'),('d4c1f44959a567f0a58d1b2377e773a31dbd039d06ded4e0447a2d1396f2d4a5e90cd9abe48a9912',6,5,'MyApp','[]',1,'2020-10-26 01:49:38','2020-10-26 01:49:38','2020-10-27 07:19:38'),('d504c4789827617be2355d8d4b8792b5927d7626323b10e9fc82b00a6b9540fe997aea86b6e8ed31',2,14,'MyApp','[]',1,'2021-02-23 01:15:59','2021-02-23 01:15:59','2021-02-24 06:45:59'),('d5219e1ac4a113a6d9528750dfd6aa083f24dd5d37bd7fc6b116fe37d566fef387a7a6688cfa0e79',10,14,'MyApp','[]',1,'2021-06-02 00:39:46','2021-06-02 00:39:46','2021-06-03 06:09:43'),('d54ad8d62fcb71de4590f6e7005789a9a6efc930b49cad1c5eb307cfcd7dc578c99c12aa5e8eb853',2,14,'MyApp','[]',1,'2021-06-09 04:10:11','2021-06-09 04:10:11','2021-06-10 09:40:11'),('d55e03c5e25debd4e7078a9d0b21e70bce3e44dfb88a5bed2db43fa58543d30b69c6c4e767f82a30',8,5,'MyApp','[]',1,'2020-12-11 05:03:42','2020-12-11 05:03:42','2020-12-12 10:33:42'),('d57d6cc401654b6fae1c58f27ad280e16fd6a8400fc3cebe0236d85a29ba082cb7822eaf3e94bc17',4,5,'MyApp','[]',1,'2020-12-22 01:48:37','2020-12-22 01:48:37','2020-12-23 07:18:37'),('d5acd43554ec0a60b4349eda7094ea71382af5e6355f4dd05174f87704c6fdfa798a091c33686adc',1,5,'MyApp','[]',1,'2020-12-02 03:29:31','2020-12-02 03:29:31','2020-12-03 08:59:30'),('d5b9fc5225c128c7239b454b8249a827dec921cd686700acb208a6e1a2fb01f42c9dcb31af3edaeb',3,14,'MyApp','[]',1,'2021-03-17 00:01:52','2021-03-17 00:01:52','2021-03-18 05:31:52'),('d5cbb8cfdb6f068ef792dabf8200183be74e1010c06f62e4b4d1bb96bb22b786f6b12de105572855',6,14,'MyApp','[]',1,'2021-06-02 00:56:32','2021-06-02 00:56:32','2021-06-03 06:26:32'),('d68e9cda007f5d357f482cfadf7b2cc9e092883cfdf6e12ee0199f0dcc6b5a945bc0aa6f1c7a53c6',10,5,'MyApp','[]',1,'2020-12-21 03:22:12','2020-12-21 03:22:12','2020-12-22 08:52:12'),('d6a9ae0720b5cb44c746f7840f570da391f6db8a20c7300e9f82ef289363672577839e4ad98dd6d1',2,14,'MyApp','[]',1,'2021-02-15 23:25:18','2021-02-15 23:25:18','2021-02-17 04:55:15'),('d6c35510b3c51d69353231dd8640e0936f8f123496774d627e5d091072273cc34ef2b87eef78ca18',8,14,'MyApp','[]',1,'2021-05-10 04:04:01','2021-05-10 04:04:01','2021-05-11 09:34:00'),('d6da069543b08546bc041cb06935b3945553715dda6e7c5c5e4e5689a4d77dab2b338103c0c0cc47',8,14,'MyApp','[]',1,'2021-02-26 06:27:46','2021-02-26 06:27:46','2021-02-27 11:57:46'),('d798bbb8a8edc47d30fcea64fa1e6b254349598a406edb927fc614cfa2bb0850de760ca9ba7c023f',8,8,'MyApp','[]',1,'2021-01-04 05:09:45','2021-01-04 05:09:45','2021-01-05 10:39:45'),('d7bad32a7baea86689344a1e14edad8daab3b129e306381a454394ef0324ea50f610ffa480d23c14',6,5,'MyApp','[]',1,'2020-12-11 05:55:54','2020-12-11 05:55:54','2020-12-12 11:25:54'),('d7be168ef76d575095c805f2f326c191b2f99bc0957d8dbc868d0badb1a5ac3ef22c9a7ba00570e0',2,14,'MyApp','[]',1,'2021-05-12 00:41:21','2021-05-12 00:41:21','2021-05-13 06:11:20'),('d7d817bd9168f4488ea37174d7cb2858fdecf6c5ca9f74e306962503a920dd1b4ed389c8f99e88ac',6,14,'MyApp','[]',1,'2021-05-06 23:22:20','2021-05-06 23:22:20','2021-05-08 04:52:20'),('d80e0c0402366ff661059154977bedfec7d0dd6fc1cb6551a9c61e595e007966a358a41aec7e04c2',1,5,'MyApp','[]',1,'2020-10-16 05:57:58','2020-10-16 05:57:58','2020-10-17 11:27:58'),('d83fc8982f5f28a9c98ca3f84c20d7444e40ca38b8169b6d51dc76482bd42fc059c3df74ed4bb758',12,11,'MyApp','[]',1,'2021-01-21 23:58:54','2021-01-21 23:58:54','2021-01-23 05:28:54'),('d879074ce07b3ac838665ad261df83e12d5356768176baeba4e529438070470599af682b5e4acc92',5,5,'MyApp','[]',1,'2020-10-21 00:23:52','2020-10-21 00:23:52','2020-10-22 05:53:52'),('d8b7000ec900f26a8be7101b9706786d460be0b0f133f3816785e1595db4e34538fbe59471658bca',3,5,'MyApp','[]',1,'2020-10-23 04:04:22','2020-10-23 04:04:22','2020-10-24 09:34:22'),('d8be124f5f92e15abc33d9d094cbb62f8c2da7d8ac395a4e311822b713b466b92a078cd9d4bbdbde',10,14,'MyApp','[]',1,'2021-03-25 00:26:42','2021-03-25 00:26:42','2021-03-26 05:56:42'),('d9252536851f27c1a48e3e26d874ba3e103aee5066065d073095e1cd76a6f87d0eb01b626c09d392',6,14,'MyApp','[]',1,'2021-04-29 23:09:18','2021-04-29 23:09:18','2021-05-01 04:39:18'),('d93f9113cbb62e2e2e1b28d1d492c77dcbb9e575c57f2ba0e78fd3243314f669cfbabc57f6d42531',10,14,'MyApp','[]',1,'2021-05-14 04:59:47','2021-05-14 04:59:47','2021-05-15 10:29:46'),('d94013f9482f9031f48ef27e23c1728af59d94ddac497de437f8380342990962ed8d57fc73e928be',1,5,'MyApp','[]',1,'2020-10-16 00:04:54','2020-10-16 00:04:54','2020-10-17 05:34:54'),('d9b84f8e4687648647528dcf95982d3884606dfd791874cf16c231e753ab6b2d2135698fdec014d7',2,8,'MyApp','[]',1,'2021-01-04 04:36:15','2021-01-04 04:36:15','2021-01-05 10:06:15'),('d9f899915b4d65c3465bfca446737fb0dd3f12c8d2abd47c1e01b0b32ad13263929f837a6066fa53',2,5,'MyApp','[]',1,'2020-10-15 00:12:28','2020-10-15 00:12:28','2020-10-16 05:42:27'),('da22f0d370f38012e0e772e1fe42ac3cfea5f6cf7ce29e47ce5c33bc5699cfbd565b0682a8aa6a87',4,5,'MyApp','[]',1,'2020-11-25 22:46:06','2020-11-25 22:46:06','2020-11-27 04:16:05'),('da6a2d4cbba88de0b8b1e877c7563867bdc443d040a2792d464068da7065d57787cf38ca2e6bfacd',5,5,'MyApp','[]',1,'2020-10-23 04:08:06','2020-10-23 04:08:06','2020-10-24 09:38:05'),('da6c5e9ef4f64e45d89e049ec22260d408a0348791c5af80f21d1ceaa968e2def359d0ff83f4a309',1,5,'MyApp','[]',1,'2020-10-12 04:54:50','2020-10-12 04:54:50','2020-10-13 10:24:50'),('da91e69f5ffaeb530fa1de9c5503d9a4e10122c1b4031600272ef24c7d6d6487c4dbbfa0fab8e686',1,5,'MyApp','[]',1,'2020-11-08 23:52:31','2020-11-08 23:52:31','2020-11-10 05:22:29'),('daaae7b8d9c3eae63db3c07786d7a487df93313144c05c8f24df5d9d9844d74ee3769f0758d4888e',8,5,'MyApp','[]',0,'2020-11-20 03:59:53','2020-11-20 03:59:53','2020-11-21 09:29:53'),('db62f1000cbc7b9a7a3bee789ff4c6740538927bf4c8f89d9005a105d0aa61d5d8d60ebd472e1d40',8,14,'MyApp','[]',1,'2021-02-26 06:58:59','2021-02-26 06:58:59','2021-02-27 12:28:58'),('db6453aa89cac067d501e9a55ed0e34aa7c71e462d999924ec542b995c9eaefd075df25bc8c38afa',1,11,'MyApp','[]',1,'2021-01-21 05:56:21','2021-01-21 05:56:21','2021-01-22 11:26:21'),('db8206701efaf477d85e132d6ed7093c5fdff566c7d9acab9e3d355874d6888d780f11f59e2eadaf',8,11,'MyApp','[]',1,'2021-01-14 00:45:47','2021-01-14 00:45:47','2021-01-15 06:15:47'),('dba0eeebe53722b07597dfec68315ca01a0ff68751270b98766026ff3c28ac7b70ea5c0e771aa29f',5,5,'MyApp','[]',1,'2020-12-16 01:57:35','2020-12-16 01:57:35','2020-12-17 07:27:35'),('dc05c65d5d14db694a0ad9b40a67f44fba16a590646b7e19a6e2814c4effe52bbf4f0d48fcf061a2',2,5,'MyApp','[]',1,'2020-11-03 00:01:28','2020-11-03 00:01:28','2020-11-04 05:31:28'),('dc193a0d78fe95bc915e79ff1cd569d4e58beb6d5c5c0999b35ad969aadcc639dfc73f2813ada169',18,14,'MyApp','[]',1,'2021-02-23 01:21:36','2021-02-23 01:21:36','2021-02-24 06:51:35'),('dc549ce2fb278b79866e6dc8c21d184a77bef48cc876a954cfa6e04cb69452ad5fd6f2e29fd6c74f',6,14,'MyApp','[]',1,'2021-02-11 03:50:05','2021-02-11 03:50:05','2021-02-12 09:20:05'),('dcceb26bb864aac9d66d2474a9687985e6ad1fac2b1c398a9dbf463d16de109aa887cb456a36718b',2,5,'MyApp','[]',1,'2020-12-23 06:27:11','2020-12-23 06:27:11','2020-12-24 11:57:10'),('dd06e8d7ad11dcdff943674fa6a0dddbe4b0290cb55cdc9ebd0ed22c939da4187f48137189e9b193',8,14,'MyApp','[]',0,'2021-04-12 06:18:39','2021-04-12 06:18:39','2021-04-13 11:48:39'),('dd46c6bef82b9254a9d01effcd310a1d0abec7e1d3884d1f2e289e49b6d6573d36ae91bfb47779da',10,14,'MyApp','[]',1,'2021-05-28 04:18:22','2021-05-28 04:18:22','2021-05-29 09:48:19'),('dd66808bedbe845d8a1deffccd0e2f543ae0ecfce476b1acfa07913e2ac63ddd33b5782cd9710224',4,11,'MyApp','[]',1,'2021-01-11 05:33:22','2021-01-11 05:33:22','2021-01-12 11:03:22'),('ddb5de62ad2110d2d66e22835c2b8adf1d8aa7b29ebe450819874bac350338210ed8073ac5a87660',2,14,'MyApp','[]',1,'2021-03-12 04:10:17','2021-03-12 04:10:17','2021-03-13 09:40:17'),('ddde5b2e5e6ce6eae6fae2e1c4b562a8cdb92815fd6e2d2925e5e5db217a5c326b2e4f8cbe0b2674',10,8,'MyApp','[]',1,'2020-12-28 06:39:12','2020-12-28 06:39:12','2020-12-29 12:09:11'),('dde6564e3bf27cd3a0fe75f734b69cb40af1b5f9ba9427a37f127d5ed50a304931a8bacf79281d1e',1,11,'MyApp','[]',1,'2021-01-14 01:00:47','2021-01-14 01:00:47','2021-01-15 06:30:47'),('de174a052897bb49da19a6e790b2e14573aa268e39a827fb388c3e496a077f54a746a48206bc785f',8,11,'MyApp','[]',1,'2021-01-12 05:39:26','2021-01-12 05:39:26','2021-01-13 11:09:26'),('de49b47e012420a51b23c5cdf14ac53279ffe8381f3b02899820aadc6a4a79822a4c731503d31b12',5,5,'MyApp','[]',1,'2020-12-13 23:30:49','2020-12-13 23:30:49','2020-12-15 05:00:49'),('de7961c5a0f5fdb95e73a84f80ed1a4957d22645afec872a7fd70f1fb4e7d81cd1b0052b04de8946',2,5,'MyApp','[]',1,'2020-12-07 22:58:53','2020-12-07 22:58:53','2020-12-09 04:28:52'),('de7c8c25bef82f76bb564830f0b304b912b7f21494b8be62f13eb526ee603606212dc1ebc9635866',6,14,'MyApp','[]',1,'2021-02-09 01:37:50','2021-02-09 01:37:50','2021-02-10 07:07:49'),('deada33ef3acf2f731511adea3abf43e89f0e86aa846ad67cfd5988a854ca69c3857b79e9a8b24c7',6,14,'MyApp','[]',1,'2021-04-22 01:27:31','2021-04-22 01:27:31','2021-04-23 06:57:31'),('debd6045ebbb6de515d2c90a7995e5cfcdcb133d3edf6e0eec69a7b33d7ff626d6b6596eee7a6075',2,5,'MyApp','[]',1,'2020-12-02 04:46:26','2020-12-02 04:46:26','2020-12-03 10:16:25'),('defa7a6bd25cdcf565848ac0b15cc9059698bf5cffe3872b412b222e7a50111f17936f9c6ca23e9a',7,14,'MyApp','[]',1,'2021-05-18 04:11:55','2021-05-18 04:11:55','2021-05-19 09:41:54'),('df8154e4c91f39b93e9e70f922529820c2244684766830290917fb66b8df29105a330cb4506188d4',9,5,'MyApp','[]',1,'2020-11-10 04:38:48','2020-11-10 04:38:48','2020-11-11 10:08:48'),('dfabd1432a3645e193ca6b40aa4ce1a6f8c0cff6ed3ff579a4de64943208708313b49210a7980d54',2,14,'MyApp','[]',0,'2021-05-13 03:23:31','2021-05-13 03:23:31','2021-05-14 08:53:30'),('dfb49af67e6f56788751146a0aaf4e76eb5da6c7b47e2a4b252149c24029a72a373c40bc1371713e',1,5,'MyApp','[]',0,'2020-11-03 04:25:51','2020-11-03 04:25:51','2020-11-04 09:55:51'),('dfdae29448d3f5260d8b4b084b78fe3cf5cebc345e63e0f641d232b00969c111c3bc5158686bf12c',1,14,'MyApp','[]',1,'2021-06-11 01:00:06','2021-06-11 01:00:06','2021-06-12 06:30:03'),('dfe1d431cd43049989181a3004ad201ce4aff03e54d593af790d1b914cd86aa64d784a2fadc62709',9,14,'MyApp','[]',1,'2021-04-20 06:57:48','2021-04-20 06:57:48','2021-04-21 12:27:48'),('e054cfabd1596577ea7d1c1f159d5ec17046e5748ac2ddc6e8d3943bb474e98fa9265227b014b4e1',2,5,'MyApp','[]',1,'2020-12-16 03:13:44','2020-12-16 03:13:44','2020-12-17 08:43:44'),('e05b0e057e9c457bb30ea17ad4a439bf579851501b235e5a6a65abdd5f232faed9a6d701e5629900',18,14,'MyApp','[]',1,'2021-02-19 02:04:16','2021-02-19 02:04:16','2021-02-20 07:34:16'),('e05f85341f25401a7081b895b70a73d50a2932464e72e1254c4eb97bb4bae29b8ce7636245ba75c5',9,14,'MyApp','[]',1,'2021-05-10 00:32:07','2021-05-10 00:32:07','2021-05-11 06:02:07'),('e0e20a00790f755dc6c257b9cde2adb0d549df5fa965a05581b8cbf809fbd5828eebf510f99fbf98',9,8,'MyApp','[]',1,'2021-01-05 00:04:19','2021-01-05 00:04:19','2021-01-06 05:34:19'),('e126557da132f60ed6ecbeff3b23da53ea1f95a18872f76d6a40619959d6451aacbfc6c8254c8dd6',2,14,'MyApp','[]',1,'2021-05-31 00:39:10','2021-05-31 00:39:10','2021-06-01 06:09:10'),('e13918f3ee86f2746ee6e7f31b9c4591bb734a7b1dc3813676d8d0660557eea4d922a0fef68dbff2',9,5,'MyApp','[]',1,'2020-11-04 00:07:20','2020-11-04 00:07:20','2020-11-05 05:37:20'),('e140ff3f09ee941a21bb06c71f4c0d60a940a5599e670528e2e4de6b283ea76213f2f7dfe2c17f5a',3,5,'MyApp','[]',1,'2020-10-14 06:38:05','2020-10-14 06:38:05','2020-10-15 12:08:05'),('e155ee8d34896e9949eb475c1a0df8ddf542fc527ef063ad8fa743146ab1dbd4a4fdb73a8adacd76',2,5,'MyApp','[]',1,'2020-10-16 00:11:57','2020-10-16 00:11:57','2020-10-17 05:41:57'),('e19d6d24e8216212f91cf0cc42757d6a87c271167ad464e7470e730bf2220f2dff37fde3989ef51a',1,11,'MyApp','[]',0,'2021-01-06 22:50:59','2021-01-06 22:50:59','2021-01-08 04:20:59'),('e1dfa896ec2be0069a62b4576d8e8ae8abff4ecc7deb206659329136a35a7ddb05d812157b6d4c0c',2,5,'MyApp','[]',1,'2020-10-20 23:56:34','2020-10-20 23:56:34','2020-10-22 05:26:33'),('e20df627b25be8f649abe24fd2e70d58eb6710321798629b2306432949ae96b93ae8eebaeb4b9938',5,5,'MyApp','[]',1,'2020-10-19 00:58:06','2020-10-19 00:58:06','2020-10-20 06:28:05'),('e264de56ce5cab48c419eafdd82b80ed998fc7b7c7c293afd360c61a2b6f13b3b7c3e672e631c129',2,14,'MyApp','[]',1,'2021-06-11 02:31:00','2021-06-11 02:31:00','2021-06-12 08:00:59'),('e295926d70b4f8ec9536557bea3c0ec918a9c7411ca74d06e173c740a14ab6f6b875d7bcf1b7b601',6,5,'MyApp','[]',1,'2020-11-26 03:49:48','2020-11-26 03:49:48','2020-11-27 09:19:47'),('e33e5974d71bc3a66ee254ba03d4c21020321996d7acd2742e7b2df70c7d072aa0b3840d4d738d04',1,14,'MyApp','[]',1,'2021-06-09 03:24:56','2021-06-09 03:24:56','2021-06-10 08:54:55'),('e34b86cc268bfa787263f0c74b9f2bd6475a46a9b6f5b7e2d4adbb0444788501eb058948296e7445',2,14,'MyApp','[]',1,'2021-03-31 05:00:19','2021-03-31 05:00:19','2021-04-01 10:30:14'),('e368133e4e40f1845271be0621143284eda768f75078c0bcd160c7abb58933b2e4c897d312a9cab2',5,14,'MyApp','[]',1,'2021-05-06 23:06:24','2021-05-06 23:06:24','2021-05-08 04:36:23'),('e39d9698aeda3702d0326df1a705e4ec9b77f2d4a6bb15e2716d9dfeafe4bc0d82b4c80804883c7b',6,5,'MyApp','[]',1,'2020-12-11 05:57:26','2020-12-11 05:57:26','2020-12-12 11:27:26'),('e3a3f048081a2d97d94a1af0047260e9e5616ee1e4d9d4ddc52ab2bea0dceaef06fe9ec8e76c5745',4,14,'MyApp','[]',1,'2021-04-21 06:34:00','2021-04-21 06:34:00','2021-04-22 12:04:00'),('e3b158cdd74bdf43c8d0ee830b0ac63746addc33304abdf8f02101da058e505699555ab895fc4006',2,5,'MyApp','[]',1,'2020-11-12 04:51:50','2020-11-12 04:51:50','2020-11-13 10:21:50'),('e3b732e82b708ca551a9ed96e2bc6b8daaeded5b2f622fd9882b6b99be5103ce0af6cbfcdf14e109',9,11,'MyApp','[]',1,'2021-01-22 00:44:23','2021-01-22 00:44:23','2021-01-23 06:14:23'),('e4014ab3658871936544473e4cb2c5f4efd4a4709f511b4fd030f5e9e5f9e3ff754988226e0e63c5',6,5,'MyApp','[]',1,'2020-11-12 05:02:37','2020-11-12 05:02:37','2020-11-13 10:32:37'),('e40f98bbe05db94e16eaaaf772935ab7dbbf180188d67b4156f4d25433459dce3739fd5d9c525421',9,5,'MyApp','[]',1,'2020-12-11 05:04:27','2020-12-11 05:04:27','2020-12-12 10:34:27'),('e4267d04be20f40347ba44367657a7d5fd15dc98872eec3b310e2a7c221c64e5eeeb8148c94cb0a8',8,5,'MyApp','[]',1,'2020-10-20 23:33:15','2020-10-20 23:33:15','2020-10-22 05:03:12'),('e42ebc4054779214237d88f2f4bf375b13f14b00b42c61da2860c1a2f1a127eef304a5780213618f',8,11,'MyApp','[]',1,'2021-01-14 22:39:50','2021-01-14 22:39:50','2021-01-16 04:09:49'),('e49ca6f1cfe9049fcfabe29c6967a26bdb20031a12faee7a6bf9b483040d3ad5cdc6a49116060e59',3,5,'MyApp','[]',1,'2020-12-22 04:54:03','2020-12-22 04:54:03','2020-12-23 10:24:03'),('e4a240eb4c6dafdc64f754e91b7f954102a01b4798ad4e32755fadd77f795e98fbd41a0abf0a3da4',8,5,'MyApp','[]',1,'2020-11-05 00:26:47','2020-11-05 00:26:47','2020-11-06 05:56:47'),('e4c7e740978d0f39880ad7535c5e1f295f23c5a058ca2517792fdaf9bae85c885c535a3560c90605',2,5,'MyApp','[]',1,'2020-11-12 04:06:52','2020-11-12 04:06:52','2020-11-13 09:36:52'),('e5142c4531be21468ca9bfd692e66be47b71b0cf25b9efe07bc8226b0d2bbe8602d0e529d9ab23d5',8,5,'MyApp','[]',1,'2020-11-23 23:29:29','2020-11-23 23:29:29','2020-11-25 04:59:29'),('e538f710ce5e51cb7b8435c97984ff3899acad901844664b38d67e92c776bde00e7741cb9d90ba95',8,14,'MyApp','[]',1,'2021-02-25 06:19:37','2021-02-25 06:19:37','2021-02-26 11:49:36'),('e545f9e93b5f9b4d93c62a440c58069f163769bec1bf1ceb16661c3f8c2e906e5d0d047727211ccb',2,14,'MyApp','[]',1,'2021-06-09 23:15:50','2021-06-09 23:15:50','2021-06-11 04:45:50'),('e5871a8e2ac97e8054cfb74fe4f823e88fe3ec8afbe3146c01a23bb1968d03876425b47c5383981b',2,5,'MyApp','[]',1,'2020-12-22 04:54:22','2020-12-22 04:54:22','2020-12-23 10:24:22'),('e58cdac01a43c917a1769c32a7b6c5e578ed1e31c8fe6af01d49404fd60d071e0dd46180dc1153c9',10,5,'MyApp','[]',1,'2020-12-21 00:47:05','2020-12-21 00:47:05','2020-12-22 06:17:05'),('e5cae981823ed336d678b37f9ae4a31ee9b42974c35cdf8160e60be58d86bdd2c16113458fccad49',3,11,'MyApp','[]',1,'2021-01-21 06:45:34','2021-01-21 06:45:34','2021-01-22 12:15:34'),('e6d76db788a44e71c124a4731990e82519fcd573bea2954fd3fd9a722ab3466b38df2bf8cfffa889',8,5,'MyApp','[]',1,'2020-12-16 02:59:55','2020-12-16 02:59:55','2020-12-17 08:29:55'),('e6e4f109f8a0e19cccf7b4d9f430cba2e0741901806a0f4a3a6e7f52d5c5b0c1737b020a7deab6ec',9,5,'MyApp','[]',1,'2020-11-05 00:37:14','2020-11-05 00:37:14','2020-11-06 06:07:14'),('e73097458d9161df6d351cb0e3d611678d005479e13bcb0829f1f262d8f35c9d538aa8389bcc77ac',2,5,'MyApp','[]',1,'2020-11-05 00:12:02','2020-11-05 00:12:02','2020-11-06 05:42:02'),('e7507c672976f16dce99e74bbae5eab03b4d426273b6c6da283382e4bba748320cf08fe0ed889264',2,5,'MyApp','[]',1,'2020-12-21 23:58:54','2020-12-21 23:58:54','2020-12-23 05:28:53'),('e79524330131e7e264c7fd01815d0e03d16babf1a229ffeb196e1649fbc743cc002a3c33258b16a5',3,14,'MyApp','[]',1,'2021-03-12 04:16:39','2021-03-12 04:16:39','2021-03-13 09:46:39'),('e7fa5dac1490f59bbdd15ad91a68020e1e9b0ab47590da1f4ccddef9523c0d39faeab798bee2be47',5,14,'MyApp','[]',1,'2021-03-17 00:05:35','2021-03-17 00:05:35','2021-03-18 05:35:35'),('e83f263c9b118e734b4f513a312fb8233c02cb24c4080a9c7ea23656ff7e30185bf892568b775e98',3,14,'MyApp','[]',1,'2021-05-19 03:38:35','2021-05-19 03:38:35','2021-05-20 09:08:34'),('e84511152bd99d174aaa92d6bbd4924f2a5ce2a253e8bef2da1ca961cc7b1391dcafefa11ac4bf03',6,11,'MyApp','[]',1,'2021-01-27 07:24:54','2021-01-27 07:24:54','2021-01-28 12:54:51'),('e86acda3f89bda2ee18d61c696e1e9d9f1203fbb67407ef14a202bb3d0b14475574667c5a5a2b675',1,11,'MyApp','[]',1,'2021-02-05 00:01:15','2021-02-05 00:01:15','2021-02-06 05:31:15'),('e871d0c2a50a5b79790114d1f056411fe4646d854ef37b12bd1a398c94defee74512f9a30d18396f',1,5,'MyApp','[]',1,'2020-10-13 04:27:41','2020-10-13 04:27:41','2020-10-14 09:57:41'),('e87329e708d80240f67a51c447af47efbdaa38172966e1f7854c35ecffb99ba4396670ddfddfaebf',1,5,'MyApp','[]',1,'2020-10-28 23:55:01','2020-10-28 23:55:01','2020-10-30 05:25:01'),('e87a0931c6c744dc5c78754d6f73ddbfda7643df9281a3fdcbc01b32847b6bb8d1f8a892d15ac594',8,11,'MyApp','[]',1,'2021-01-13 00:16:55','2021-01-13 00:16:55','2021-01-14 05:46:55'),('e8ab9fd7c23cbdbd8a8c58c4e6c08a3fcc297ce75500d499b0a606e143a17ed1ac9c9796e4bf5653',10,11,'MyApp','[]',1,'2021-01-08 04:06:05','2021-01-08 04:06:05','2021-01-09 09:36:05'),('e8e7a99ee2bb2e37acc1cea059ae46d646981ab141ee7a797c4df000b98bcdab2a231578b69e4773',9,5,'MyApp','[]',1,'2020-10-23 04:30:57','2020-10-23 04:30:57','2020-10-24 10:00:57'),('e8f4b2af78c4f78485fbe6a106d28e71d54ed7d06f231815545020086883b4fff689809f4879630b',2,11,'MyApp','[]',1,'2021-02-03 04:41:40','2021-02-03 04:41:40','2021-02-04 10:11:39'),('e94cf38a063e1fdd6164918699b24b460fe0b485f6ed86503295276a86110a074c16e3c098667667',10,11,'MyApp','[]',1,'2021-02-02 07:06:56','2021-02-02 07:06:56','2021-02-03 12:36:52'),('e980c26a73572299f9f77b364e555da91c183648347e18d6e22cda1ecd62d3048b3d4526056edba6',1,8,'MyApp','[]',1,'2021-01-05 03:15:58','2021-01-05 03:15:58','2021-01-06 08:45:58'),('e9afa66e25c70373204e607d79d7b3db494eba48678cd521463a86467dbbcb4fc035a7fd9a800a84',18,14,'MyApp','[]',1,'2021-02-21 23:25:24','2021-02-21 23:25:24','2021-02-23 04:55:23'),('e9d8d8f4f32c73b5ad4d6f67358292493393ae04fdb7032d1e9fc660a6ff1d9aef900011dd87138e',6,11,'MyApp','[]',1,'2021-01-18 06:49:49','2021-01-18 06:49:49','2021-01-19 12:19:48'),('e9daf6dfab3d73ad11203e185d8709da0f98fa6ab9960ba4029b2a848e0f3747105335ac08bd42d9',4,14,'MyApp','[]',1,'2021-06-11 01:04:46','2021-06-11 01:04:46','2021-06-12 06:34:45'),('e9fced5141043ece8f3e72a578ba527f127579a175356cfdaf4074da96f40198c65fb38c0c68b31f',2,14,'MyApp','[]',1,'2021-03-17 07:38:20','2021-03-17 07:38:20','2021-03-18 13:08:19'),('ea0f70452df8b3531ca92606a2a4e371d99d10ac39b3b0b6102f78cdeaedf5a41995b2d0ae9208d8',2,11,'MyApp','[]',1,'2021-01-07 23:38:21','2021-01-07 23:38:21','2021-01-09 05:08:21'),('ea4421014c0086cc091155c00dbacfd56fff2f3af61ad65acee2d6377a519902ee6b4cd018fb4519',2,5,'MyApp','[]',1,'2020-11-27 02:33:13','2020-11-27 02:33:13','2020-11-28 08:03:13'),('ea89e85a221857532bdd5a2193cb4b41b816fd357c970d8f55fc8143707874822772652da9b35264',5,5,'MyApp','[]',1,'2020-10-26 04:50:03','2020-10-26 04:50:03','2020-10-27 10:20:03'),('eae447ac9e68612776a0a2eb1d5358719dfea3f6481939acf5c4b9a7769f3db6533962515ca47068',2,14,'MyApp','[]',1,'2021-05-13 03:21:27','2021-05-13 03:21:27','2021-05-14 08:51:27'),('eb1c7822b7e8e67db8c5064af565edbe5f0b64fa49a4774e706cfc0c9248111297fc3575eb75720a',8,5,'MyApp','[]',1,'2020-11-19 23:56:13','2020-11-19 23:56:13','2020-11-21 05:26:13'),('eb5505f714ada30497b2a38d743adff619081191a5e8cc48e8e67fb279d6cfb3d5b5420247e01d3a',1,5,'MyApp','[]',1,'2020-10-20 23:44:46','2020-10-20 23:44:46','2020-10-22 05:14:46'),('eb6f9192964b3c9f76b910019d463ce34b2ffc704ea9ab1701c853db394dbfe0bbca82fb61144e2a',1,5,'MyApp','[]',1,'2020-12-10 03:42:09','2020-12-10 03:42:09','2020-12-11 09:12:09'),('ebd95291123db09cd3f3ffbb6e7f906c30ce5d11c3d8e1123e369e4790247fc8eac4c24cf7f0d728',1,5,'MyApp','[]',0,'2020-11-02 04:34:21','2020-11-02 04:34:21','2020-11-03 10:04:21'),('ebda9aea0dffde9a327a047252334f9a1579a6885a94e419f0c0e8086f4cce58dfead7aa08a3f1e3',18,14,'MyApp','[]',1,'2021-02-23 01:24:13','2021-02-23 01:24:13','2021-02-24 06:54:13'),('ec1bf613825f0b757bcee9211b4798a4549c5ce981f130d105c7859a6debf658c63365646197bf50',2,14,'MyApp','[]',1,'2021-04-28 00:39:25','2021-04-28 00:39:25','2021-04-29 06:09:22'),('ec37b6d92627e3fde1e4f3a8c1ddeb791a8a7aa92b37dc0d7a8d695dd52b4ede265f4e2cf479bd8b',10,14,'MyApp','[]',1,'2021-06-11 04:33:23','2021-06-11 04:33:23','2021-06-12 10:03:22'),('ec64ef31c89142ee44b5f462d4736149b8f3fba225433533fcc1d2403237a3f0c5147b104bd947c9',10,11,'MyApp','[]',1,'2021-01-07 23:44:51','2021-01-07 23:44:51','2021-01-09 05:14:50'),('ed1eae999140f86bc090d7ce81c12b6e9f20b67277d95ea88f077f48200017d834f9b67094897bfe',1,5,'MyApp','[]',1,'2020-11-09 00:10:45','2020-11-09 00:10:45','2020-11-10 05:40:45'),('ed839026b0da8d72cb87d5b708d8be13c43cd8b78a54402e021781f77322fce60e4841c746720a2a',10,14,'MyApp','[]',1,'2021-03-17 23:12:50','2021-03-17 23:12:50','2021-03-19 04:42:50'),('edadaf883ebe0f1f285f62efe043ce84bfcebd6b1fcc23f1f62012f193f2bdd2879c1e9e63e07cc1',1,5,'MyApp','[]',1,'2020-10-21 03:55:53','2020-10-21 03:55:53','2020-10-22 09:25:53'),('edd3099fb58044350c43adcfcd4e552e609657a1efa4f7ab37efa2306fd515690e52314fb8b3f635',5,14,'MyApp','[]',1,'2021-02-26 00:45:58','2021-02-26 00:45:58','2021-02-27 06:15:57'),('ee003c4aa152e63a24e91470131d332cc88ae2233399d1868b510cf00483aff380b1221f1136b231',9,5,'MyApp','[]',1,'2020-10-26 05:05:08','2020-10-26 05:05:08','2020-10-27 10:35:08'),('ee2fe9ae42d2f8c72c0dc6e3e6fd60e6a4b3cc1c4490e09210eda2a1d76daab1eb3442bf61436616',6,14,'MyApp','[]',1,'2021-04-22 00:39:40','2021-04-22 00:39:40','2021-04-23 06:09:40'),('ee39111d229fcc7922de3c8724a727e23d1dff7e5d1a58c8d3d78b2064dda1d440c053a8fc1e9e37',3,5,'MyApp','[]',1,'2020-10-14 04:38:51','2020-10-14 04:38:51','2020-10-15 10:08:51'),('ee738f1540b6d92affc1348d33dad20ca8c9f83c0d0e67504a0e4ac6dc760caf893534d3dad99af1',4,14,'MyApp','[]',1,'2021-03-12 02:02:35','2021-03-12 02:02:35','2021-03-13 07:32:35'),('eec8dbc390b73cd7e8b051b5a0e72a21c21c16736ba36fd41538b86a81a588a19415e96dcbc04906',2,5,'MyApp','[]',1,'2020-12-11 04:16:11','2020-12-11 04:16:11','2020-12-12 09:46:11'),('eedf3a952b6f97c0681e6b3046b7eb5cb0ae11d55dd39fb178607b8bb945c8f1503d45d8e02f38c1',9,14,'MyApp','[]',1,'2021-06-11 01:11:06','2021-06-11 01:11:06','2021-06-12 06:41:05'),('eefbed1f7596e9f1863580cb7547bc102c6edf7832c0045e0b4c34611374ecbef83fd4fdb85eacaa',1,5,'MyApp','[]',1,'2020-11-04 05:16:44','2020-11-04 05:16:44','2020-11-05 10:46:44'),('ef1386d6fa4fc543171a3852fc2dfa47b734037557c4e928e95f4804caf92f3c38456ee5447af93f',6,5,'MyApp','[]',1,'2020-12-22 05:44:31','2020-12-22 05:44:31','2020-12-23 11:14:31'),('ef651a611e87057fb00d08d3e9c2710c916a80577c57e180c220a1ec31c0308ca5dc1671354407de',1,5,'MyApp','[]',1,'2020-12-11 05:12:29','2020-12-11 05:12:29','2020-12-12 10:42:29'),('efc70893903335cf2cffdcd008109e68829fe9f921bd3df5114a7d933c4105f34c32e004de9b7a72',5,5,'MyApp','[]',1,'2020-12-22 03:52:41','2020-12-22 03:52:41','2020-12-23 09:22:41'),('efc82b504f3c6c1f69c72d9e5853a5e0224797ef5df8e55fdf412ddc076b6de23bd43389e861e3d2',9,5,'MyApp','[]',1,'2020-12-02 03:41:08','2020-12-02 03:41:08','2020-12-03 09:11:07'),('f049d9a0c7cbd927a76379a879a5f0c07fefbcc54cd9c963fb7275d00d55708a3287ff2f0012ada2',2,5,'MyApp','[]',1,'2020-12-18 03:34:48','2020-12-18 03:34:48','2020-12-19 09:04:47'),('f0ac0d1995829cbe7427f0d50147a9cdc7c6650a1313dca8e1b06f70fcbb872e2af58f0f1d95348f',1,14,'MyApp','[]',1,'2021-02-16 05:35:51','2021-02-16 05:35:51','2021-02-17 11:05:50'),('f0c90ba5094e7dd65bc1a1d7cf5668c119da9d041316f7a51edd7bc016d7d0bd0601e785e9d71333',9,5,'MyApp','[]',1,'2020-11-12 03:49:23','2020-11-12 03:49:23','2020-11-13 09:19:23'),('f0e0db46509189f26dd2e27049767a5aeaad7b583b8718e84a33e6029175643434afb1bf47e79daa',6,11,'MyApp','[]',1,'2021-01-20 00:14:01','2021-01-20 00:14:01','2021-01-21 05:44:00'),('f11898f7c178e6ac4d2c6a7b7077b10fb697f086673edb04137664a8ad4e59d88c765a5f2306f6ee',2,5,'MyApp','[]',1,'2020-12-02 00:05:24','2020-12-02 00:05:24','2020-12-03 05:35:24'),('f13806a890b107d936d175cbdf615d648e1bcf945fd83bc0ac761c96aa8287df55e47ca63b042293',18,14,'MyApp','[]',1,'2021-02-17 04:18:23','2021-02-17 04:18:23','2021-02-18 09:48:23'),('f16964ffd3ac7a040da2806d4d5bf5236569320593c3630e144277cdee80bff86376af7c3488b9b3',10,14,'MyApp','[]',1,'2021-03-22 00:49:34','2021-03-22 00:49:34','2021-03-23 06:19:34'),('f19e56a2bb224ee417a0b785d752c05481655965828097070762dbdd1a5d07033d9c4b7f5de07163',6,5,'MyApp','[]',1,'2020-12-23 06:29:30','2020-12-23 06:29:30','2020-12-24 11:59:30'),('f1d1455effb31fb745b377084614af3035fdc41b8b112be815aa95fbb25fcc19b9a5d267d7b933e5',2,14,'MyApp','[]',1,'2021-03-18 23:11:05','2021-03-18 23:11:05','2021-03-20 04:41:03'),('f1f0bd5cae5398b295e75be9deeac473feffc50d4b6332c091a216a8903e9926db0df8f779283c90',10,14,'MyApp','[]',1,'2021-05-30 23:16:46','2021-05-30 23:16:46','2021-06-01 04:46:42'),('f1f1df60444ee412aaac7d4fe9e567e548120d5f1955ba8b2e1073975e42f317dd8402077eaa25a0',8,5,'MyApp','[]',1,'2020-12-11 06:14:56','2020-12-11 06:14:56','2020-12-12 11:44:56'),('f258960c45a526214d25822485236b84657755401fc01d71e91f1ed4ca39fd7f95248af2d7383602',8,5,'MyApp','[]',1,'2020-12-16 03:00:58','2020-12-16 03:00:58','2020-12-17 08:30:58'),('f291896396cff1443ac16bde307f29109b648c511244b4ef12c150a5ec57a30bab3b6959b30195a7',3,14,'MyApp','[]',1,'2021-05-07 03:29:05','2021-05-07 03:29:05','2021-05-08 08:59:05'),('f2b525ac65a010ae71095b0e931839845a375fa7add3b1381cc9f556460d2f5fda3ac203035af216',2,5,'MyApp','[]',1,'2020-11-27 06:16:05','2020-11-27 06:16:05','2020-11-28 11:46:05'),('f2d3110f45b2e3055862ad374c3a19c5f813afa9976ac1f5c32ddaed38a1c7f6d2a2af9bafbd7560',1,5,'MyApp','[]',1,'2020-10-16 01:01:50','2020-10-16 01:01:50','2020-10-17 06:31:49'),('f2d55353c9198c373a344e6e590be0775cd7a27c37027614f71ea8f00e26776a3b81143d44b9c1e1',8,11,'MyApp','[]',1,'2021-01-08 06:26:55','2021-01-08 06:26:55','2021-01-09 11:56:55'),('f2ede06e317c61acd412eca0da6d7de0203911a241303e9c72b5cc911cb54e0a5733170d5bccf36d',6,5,'MyApp','[]',1,'2020-10-19 06:45:01','2020-10-19 06:45:01','2020-10-20 12:15:00'),('f2f3670699eda2a9d68921b2b0a4382189c67d97475a3b8f73605c7b33696a577756e8d962cbd3b6',5,14,'MyApp','[]',1,'2021-03-12 04:22:50','2021-03-12 04:22:50','2021-03-13 09:52:50'),('f3b0ef370ff4ee7c46e591c64894d7edd94c76099cd0bd1b6b773b619e307ec49b4b77a3b1575c36',2,14,'MyApp','[]',1,'2021-04-05 03:09:46','2021-04-05 03:09:46','2021-04-06 08:39:45'),('f3cc5bd90e02a495784ec7545b77130080a687e4c6d8501197804a8cf5c71c6266fa9f1e1c3c8569',2,14,'MyApp','[]',1,'2021-02-22 03:22:28','2021-02-22 03:22:28','2021-02-23 08:52:26'),('f419d17f653ea4917ab49817423ce2717a4619e03b73723f8f162007141c22a1dd2bc8ab8b5d8975',2,14,'MyApp','[]',1,'2021-02-23 03:07:57','2021-02-23 03:07:57','2021-02-24 08:37:56'),('f4cdf63617590d83d940e20d099b6de99b5db26779a1ee53f509a14112495b70769a70fd23f5f568',8,14,'MyApp','[]',1,'2021-02-09 01:37:12','2021-02-09 01:37:12','2021-02-10 07:07:12'),('f4d498cecf223d38f9f4d2ed37e42ecf78f3c83ebf6bdef7c42b071ebe0457dd13a8dd9952271ce9',8,14,'MyApp','[]',1,'2021-03-17 00:12:57','2021-03-17 00:12:57','2021-03-18 05:42:56'),('f4e75e26144a820c11722d9b0e335cfb3ce8ec65c453eff358c07d9ed8b36dad0b21c5334527b4ac',10,11,'MyApp','[]',1,'2021-01-07 23:41:29','2021-01-07 23:41:29','2021-01-09 05:11:29'),('f58e8b201cf48652bf1d43c2fa4da662c94445912e8f47988afe48106e729f02b97522e42a0dff9a',8,14,'MyApp','[]',1,'2021-02-09 00:30:53','2021-02-09 00:30:53','2021-02-10 06:00:50'),('f5bf88a436748f1fea58cf17308265d6804832082ea0fa8f83a451b64f30dc78adb14ee47d69f631',2,5,'MyApp','[]',1,'2020-10-15 01:28:15','2020-10-15 01:28:15','2020-10-16 06:58:14'),('f5ef83c92b4181c5134d8db3a54e33bec71bf2fccadc4eb2c539b13e652599e6886213ef34ef93a1',3,14,'MyApp','[]',1,'2021-04-07 03:42:19','2021-04-07 03:42:19','2021-04-08 09:12:13'),('f61fc2892a021ebdcd882d8c721de7f2b20d70b224b6d8e1d3fe874d20185202a795012c9e652d77',2,5,'MyApp','[]',1,'2020-12-09 05:20:53','2020-12-09 05:20:53','2020-12-10 10:50:53'),('f64fc68b02bf2a11f7bab2eb77dc35e6be670a29be6b8dfe5f3124a998f53b854c9b225a8c8f2692',5,14,'MyApp','[]',1,'2021-06-02 00:50:39','2021-06-02 00:50:39','2021-06-03 06:20:39'),('f7386ab35dcb2b948baa0a15870d140d8233bdf6c632213fbe1137ab1501f91ff6dd0d36ed659b55',5,5,'MyApp','[]',1,'2020-10-16 07:10:30','2020-10-16 07:10:30','2020-10-17 12:40:30'),('f739d718026844c92007f4e27d0ef4c1870f8b0e4276717b49ddd52805cfc6c1bf8b81593b074377',6,11,'MyApp','[]',1,'2021-01-08 05:38:25','2021-01-08 05:38:25','2021-01-09 11:08:25'),('f74a13e7f6743fd4eb4269e9266e51db0c825a305fb3bb3294dad0c3ccf110f0e58438f6af215820',10,14,'MyApp','[]',1,'2021-03-30 00:09:27','2021-03-30 00:09:27','2021-03-31 05:39:24'),('f76a6aad90a7696d13b700930bcd7ae31011a1032f9885830c5209660acf122332906810f0ab57f9',1,5,'MyApp','[]',1,'2020-11-11 06:30:25','2020-11-11 06:30:25','2020-11-12 12:00:25'),('f782682b4cb0d31f826c5fb0eba9090ed23c842a2bd531b7bc0e2f9796d9ea7fdcd55f53d4d9d7e3',3,5,'MyApp','[]',1,'2020-11-03 00:10:07','2020-11-03 00:10:07','2020-11-04 05:40:06'),('f79e27e35912240178f3927b0612483e5a303ebf0028d8d246402bf32f1dc9d825b0917e5268f8f7',1,5,'MyApp','[]',1,'2020-11-05 05:01:20','2020-11-05 05:01:20','2020-11-06 10:31:20'),('f7b50492e6b65af130b30b0d817dfa1474c0dbab0c03ed81d03df1609a9d0a99c314622479a16ee9',6,5,'MyApp','[]',1,'2020-10-20 01:31:43','2020-10-20 01:31:43','2020-10-21 07:01:43'),('f7c1d88a7c7ccb095d5e331c32abf2540fa34bc47ba665240bb04f35a0a0743e4641c4cad84fde8b',13,14,'MyApp','[]',1,'2021-06-02 00:48:45','2021-06-02 00:48:45','2021-06-03 06:18:45'),('f7ca455152d0d228e9d7435e0db36f1225b270b55f19fc3c3c44da405df06bbb28c233a79e20f1f7',1,8,'MyApp','[]',1,'2020-12-28 03:58:20','2020-12-28 03:58:20','2020-12-29 09:28:20'),('f7d0d895478ba34ebc9ec427923cd5d5707603f2ba5d0e0283d19fa549f2f705b9f3776ba6972605',5,5,'MyApp','[]',1,'2020-10-26 04:39:37','2020-10-26 04:39:37','2020-10-27 10:09:37'),('f7dc71c4e008e2be8b8090ee6ea4620df6028315dc2e4c4d75be757b84729d8cf8277d22f70e5b4b',4,5,'MyApp','[]',1,'2020-10-16 05:43:19','2020-10-16 05:43:19','2020-10-17 11:13:19'),('f7fae4feee4e05dfe053bb05b3ded4ee8e9203243279030c08d1a1a23d011b6268e26606d2d59b9c',9,5,'MyApp','[]',1,'2020-11-04 23:40:26','2020-11-04 23:40:26','2020-11-06 05:10:26'),('f8420b9eca5a26e2de1fcbe09efbe0d82a3ace3f5d573a734ec27fbe952269bb5c7fa3cdf3544168',2,14,'MyApp','[]',1,'2021-03-24 22:58:02','2021-03-24 22:58:02','2021-03-26 04:28:02'),('f8775037787e5e84090216c7b7c9946d23d2e6ebecc92c3a3598172eef760dc71504cf4ca3b79728',2,5,'MyApp','[]',1,'2020-10-13 00:47:56','2020-10-13 00:47:56','2020-10-14 06:17:56'),('f899ad5731f791d5ae2210e7d1cc9862c00e9720858dc55f1ff69bcf24cd7429cbc404740e78bafe',2,11,'MyApp','[]',1,'2021-01-28 06:56:18','2021-01-28 06:56:18','2021-01-29 12:26:17'),('f8cb0ba08e3ae86327df0a4ff6606ab3e7e87ed6d2af34707f4c47b2b7ec75fcb2a6840be30b9179',4,14,'MyApp','[]',1,'2021-02-26 00:21:16','2021-02-26 00:21:16','2021-02-27 05:51:16'),('f930f8333f2a165330ad6c78876c4f3232c05b83f1cb871088a52ad87ffcedc9224d940d93b1afd9',3,5,'MyApp','[]',1,'2020-10-16 03:18:21','2020-10-16 03:18:21','2020-10-17 08:48:21'),('f93fa82aaf0273a6ec68355859f96338a7b9e2f7ac2c8f85a4da3c1226b36cabe4f6d51acbd243ef',10,14,'MyApp','[]',1,'2021-05-13 03:11:34','2021-05-13 03:11:34','2021-05-14 08:41:33'),('f9667a62d8bf5fdec4dc1915de59e3d5bb0a8b1ed9fb7d3fd7bb070e1dac8aac8b7dc982930e1f1d',9,14,'MyApp','[]',1,'2021-03-12 05:57:43','2021-03-12 05:57:43','2021-03-13 11:27:43'),('f9c883a52ae383453e893f0939fae3755a1503f7c5eaff2d565f7c790d0335d3d4b3a12999c888f8',1,11,'MyApp','[]',1,'2021-01-20 23:22:48','2021-01-20 23:22:48','2021-01-22 04:52:46'),('f9ca9568ef4fc987d9c073026cc75d214c8cbf12e596b206c70b8251da7abab8d54d839ca7e69c7d',10,14,'MyApp','[]',1,'2021-03-08 01:06:47','2021-03-08 01:06:47','2021-03-09 06:36:47'),('fa224593e80786a7c14daa567c58aeaa19be1357b7deb35bdf347ccc50e18c007e02dde5f927436a',2,5,'MyApp','[]',1,'2020-12-09 23:15:00','2020-12-09 23:15:00','2020-12-11 04:45:00'),('fa29655479b733c329cc67a0f2df079f9d78e18eeac015630a51aebf0364470f801a323d1222a491',9,14,'MyApp','[]',1,'2021-02-26 06:28:51','2021-02-26 06:28:51','2021-02-27 11:58:51'),('fa7e3d950c4b39181cdc87463818d1c62fd52cf843c3e9fe0817b47654cf551ae2d4c1f43a742daf',8,14,'MyApp','[]',1,'2021-04-13 04:50:50','2021-04-13 04:50:50','2021-04-14 10:20:49'),('fb0d5b7a144008be87c12b0c634ea3ccc21f21e032bc6e44fb6eadf05662ac39835c451f5ea1e913',3,14,'MyApp','[]',1,'2021-04-20 06:42:34','2021-04-20 06:42:34','2021-04-21 12:12:34'),('fb223f2514dff1ab108496e481acec89613542393c194e6108b891a62b9583a1371f3ed78d3b8d8e',8,5,'MyApp','[]',1,'2020-11-12 02:29:58','2020-11-12 02:29:58','2020-11-13 07:59:57'),('fb574d3341b07551002ba4a14b09a69dec76eb6898c4b8bde1e407894d4f9d3627a5e672b7c527e7',8,11,'MyApp','[]',1,'2021-01-21 05:11:04','2021-01-21 05:11:04','2021-01-22 10:41:04'),('fb9f1d0b5a910744bf6956ecbe3819216d749375991399abdb523e7ffd90262430d1e89e5ce5e55f',8,14,'MyApp','[]',1,'2021-05-07 03:50:32','2021-05-07 03:50:32','2021-05-08 09:20:32'),('fba1f79c6c8ce9d9c922091277c98691978c66e982728cf0152d978ac8a85e75b7fbf68a4ddbc35c',13,14,'MyApp','[]',1,'2021-04-28 23:07:49','2021-04-28 23:07:49','2021-04-30 04:37:49'),('fc11b7a741506b03174bd89dc6e85450b0e0f499cd600fe5ce7bb333d8f2a4d93e87c9ec513b5456',4,14,'MyApp','[]',1,'2021-05-06 23:07:40','2021-05-06 23:07:40','2021-05-08 04:37:39'),('fc4470706344a21f8efc56ecc3fc0473740889541d7c89632d98fc3b4abc36f1a8b45662dd1b9bcc',6,14,'MyApp','[]',1,'2021-06-03 23:37:57','2021-06-03 23:37:57','2021-06-05 05:07:57'),('fc8b07e7520efabe39ae9ac0001cc4877860f23edf7ebfbcb77a36ffb66fe569bcafd2cbae6b95a9',5,11,'MyApp','[]',1,'2021-01-14 00:45:15','2021-01-14 00:45:15','2021-01-15 06:15:14'),('fcd8ead956599ef57dd1f8e7f235d306c6c27db85effe2ec6b462691c1b884fc860f715dc083410b',10,14,'MyApp','[]',1,'2021-05-13 01:22:03','2021-05-13 01:22:03','2021-05-14 06:52:03'),('fcdf9b2f3752cc262e473087af653bc1fc90eaa349cad9fb158d55b580a708fe3580d9fda0d8eec3',13,14,'MyApp','[]',1,'2021-05-04 04:10:06','2021-05-04 04:10:06','2021-05-05 09:40:06'),('fd3d203f2714606c9c0661764a8057180f4b34b9901d86710f40389f05d1edf7389bb710e4d1f06d',2,11,'MyApp','[]',1,'2021-01-11 05:28:25','2021-01-11 05:28:25','2021-01-12 10:58:25'),('fd9b67c334df4e34d1540b18a611b14803cb1ed480603370ca54063de7c9f9dd6719a5c7e2530929',10,5,'MyApp','[]',1,'2020-12-21 00:10:06','2020-12-21 00:10:06','2020-12-22 05:40:04'),('fe033f46f34e1952941f287cf82e1e3958f28f129056aaed7bd3a5a78cbbab1aed8e30ab2695166f',1,5,'MyApp','[]',1,'2020-12-16 01:40:24','2020-12-16 01:40:24','2020-12-17 07:10:24'),('fe23b8b360b68970b414bfa26424596d850fe5b73eae5e69850ccb56d0f73ad2689f9dd60974a0be',6,5,'MyApp','[]',1,'2020-11-23 05:39:46','2020-11-23 05:39:46','2020-11-24 11:09:45'),('fe69b26706363830189dc7d1be3a0aa7b5da5ed48d3eb22c0c47ad2b8bd030117487a206011fdfa4',1,5,'MyApp','[]',1,'2020-11-11 07:17:57','2020-11-11 07:17:57','2020-11-12 12:47:57'),('fe81ac610510a3f0c0deedea94ef2499e6027ad44ebb06f314190db3f5ed93ba3492c6b1901c40dc',2,8,'MyApp','[]',1,'2021-01-04 04:43:39','2021-01-04 04:43:39','2021-01-05 10:13:39'),('fe912b6c3d08ae824cef8aa24e440e7b54b14d89f8443687c19ce77d2b2f436dda0d6a7d8389b38b',2,5,'MyApp','[]',1,'2020-12-10 22:58:24','2020-12-10 22:58:24','2020-12-12 04:28:24'),('fed9662a6c9d81a2a9be633e91b4e1a59022f6a3045b2931037202b4b6113dbd3ea047195fbd7766',2,14,'MyApp','[]',1,'2021-04-21 23:30:29','2021-04-21 23:30:29','2021-04-23 05:00:28'),('fee2e9a4265dff65b875f5473c691771ada70950dc9dd70ebbe9808ca73f6db77301a768e8ba11cb',4,5,'MyApp','[]',1,'2020-10-20 06:36:17','2020-10-20 06:36:17','2020-10-21 12:06:16'),('ff25fd83695b7526a6ee7df0c332c76cd0e5414eee80f73036e8e6f3fd498aa7036751da091183f3',6,14,'MyApp','[]',1,'2021-06-11 02:12:54','2021-06-11 02:12:54','2021-06-12 07:42:54'),('ff46a48b946b42aa86e8df1e67721cf0aff1c330031569a0c224e59adfa5d4ad75be592a447a385a',4,5,'MyApp','[]',1,'2020-11-26 22:54:40','2020-11-26 22:54:40','2020-11-28 04:24:40'),('ff606d52538dcc784643c0df27c1be350c9317a01b377852dfb75768c4f5a6e61cc1b552b2fc7099',6,11,'MyApp','[]',1,'2021-01-21 23:23:06','2021-01-21 23:23:06','2021-01-23 04:53:05');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Laravel Personal Access Client','UGHi7AM8QduO8BK8FvzsdwzxWVOuIylx7QycAR2d','http://localhost',1,0,0,'2020-10-09 05:03:11','2020-10-09 05:03:11'),(2,NULL,'Laravel Password Grant Client','4J7WbuiqeM3sZlIYLEEsLA3UmEdDV4VfuBWTzeCD','http://localhost',0,1,0,'2020-10-09 05:03:11','2020-10-09 05:03:11'),(3,NULL,'Laravel Personal Access Client','wMRHeMAFN6ebtudgKmzqwp97qNAH5JvITz7JOmRZ','http://localhost',1,0,0,'2020-10-09 05:03:38','2020-10-09 05:03:38'),(4,NULL,'Laravel Password Grant Client','Kqz1WdihFDSRJvd77uGkL6yvMKGYX47wr5oGs0oB','http://localhost',0,1,0,'2020-10-09 05:03:38','2020-10-09 05:03:38'),(5,NULL,'msp','eLIzUmjcR5yuXyniAio1sNTPCTtdJRy87Ej0Zelk','http://localhost',1,0,0,'2020-10-09 05:04:12','2020-10-09 05:04:12'),(6,NULL,'Laravel Personal Access Client','zIQf099b6irNO467S636gJgL7l3VBJtkOkHqQJFY','http://localhost',1,0,0,'2020-12-28 03:41:43','2020-12-28 03:41:43'),(7,NULL,'Laravel Password Grant Client','iG0g5NuP0YpflRkesv2T0S2egbb7itat0I90ZBy1','http://localhost',0,1,0,'2020-12-28 03:41:43','2020-12-28 03:41:43'),(8,NULL,'mspformfp','Z3d6BDEocNtLTn9iBzPYHCgRuamqLWOHGWNZ2Mni','http://localhost',1,0,0,'2020-12-28 03:41:53','2020-12-28 03:41:53'),(9,NULL,'Laravel Personal Access Client','p5xbWd54PnzHpIh6j3aIPWgr25f4WQFYRTHF3My5','http://localhost',1,0,0,'2021-01-05 07:06:51','2021-01-05 07:06:51'),(10,NULL,'Laravel Password Grant Client','APSZSeEv8TAJ7lN6M6MSlScCZKk6GJZxPAYVomFe','http://localhost',0,1,0,'2021-01-05 07:06:51','2021-01-05 07:06:51'),(11,NULL,'msp','NUqvivdH92Fi5vx9e3FgsIFFOb5mVLpcLXppY2G2','http://localhost',1,0,0,'2021-01-05 07:07:00','2021-01-05 07:07:00'),(12,NULL,'Laravel Personal Access Client','le4nWKVwmNawJeBwnUqKexqB2HbTzFTM3ORY7PcH','http://localhost',1,0,0,'2021-02-05 01:11:02','2021-02-05 01:11:02'),(13,NULL,'Laravel Password Grant Client','054Q0aMjPqVqFORu3ClCUZbiPmUkqv0VfZuzexjT','http://localhost',0,1,0,'2021-02-05 01:11:02','2021-02-05 01:11:02'),(14,NULL,'csv','hxPUTRiFc87yXyXkk9nao8NHCIeLwBBbk0qAPHH2','http://localhost',1,0,0,'2021-02-05 01:11:18','2021-02-05 01:11:18');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2020-10-09 05:03:11','2020-10-09 05:03:11'),(2,3,'2020-10-09 05:03:38','2020-10-09 05:03:38'),(3,5,'2020-10-09 05:04:12','2020-10-09 05:04:12'),(4,6,'2020-12-28 03:41:43','2020-12-28 03:41:43'),(5,8,'2020-12-28 03:41:54','2020-12-28 03:41:54'),(6,9,'2021-01-05 07:06:51','2021-01-05 07:06:51'),(7,11,'2021-01-05 07:07:01','2021-01-05 07:07:01'),(8,12,'2021-02-05 01:11:02','2021-02-05 01:11:02'),(9,14,'2021-02-05 01:11:18','2021-02-05 01:11:18');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packing_master`
--

DROP TABLE IF EXISTS `packing_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packing_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bag_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bag_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specifications` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packing_master`
--

LOCK TABLES `packing_master` WRITE;
/*!40000 ALTER TABLE `packing_master` DISABLE KEYS */;
INSERT INTO `packing_master` VALUES (1,'ABC','ABC','12','1',1,1,'2021-06-09 00:47:34','2021-06-09 03:53:15'),(2,'ABC2','ABC2','ABC','1',1,1,'2021-06-09 03:39:54','2021-06-09 03:39:54'),(3,'ABC3','ABC3','31','1',1,1,'2021-06-09 03:53:48','2021-06-09 03:53:48');
/*!40000 ALTER TABLE `packing_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_alias_index` (`alias`),
  KEY `permissions_created_by_index` (`created_by`),
  KEY `permissions_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'master_management_view','View','master_management','View',0,0,NULL,'2021-05-12 06:02:03','2021-05-12 06:02:03'),(2,'master_management_add','Add','master_management','Add',0,0,NULL,'2021-05-12 06:02:03','2021-05-12 06:02:03'),(3,'master_management_edit','Edit','master_management','Edit',0,0,NULL,'2021-05-12 06:02:03','2021-05-12 06:02:03'),(4,'master_management_status','Status','master_management','Status',0,0,NULL,'2021-05-12 06:02:03','2021-05-12 06:02:03'),(5,'role_view','View','role','View',0,0,NULL,'2021-05-12 06:02:03','2021-05-12 06:02:03'),(6,'role_add','Add','role','Add',0,0,NULL,'2021-05-12 06:02:03','2021-05-12 06:02:03'),(7,'role_edit','Edit','role','Edit',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(8,'role_status','Status','role','Status',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(9,'role_mapping_view','View','role_mapping','View',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(10,'role_mapping_add','Add','role_mapping','Add',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(11,'role_mapping_edit','Edit','role_mapping','Edit',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(12,'role_mapping_status','Status','role_mapping','Status',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(13,'user_management_add','Add','user_management','Add',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(14,'user_management_edit','Edit','user_management','Edit',0,0,NULL,'2021-05-12 06:02:04','2021-05-12 06:02:04'),(15,'user_management_view','View','user_management','User Listing View ',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(16,'user_management_status','Status','user_management','Status',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(17,'user_management_set_user_wise_permission','Set User Wise Permission','user_management','Set User Wise Permission',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(18,'mfp_procurement_plan_view','View','mfp_procurement_plan','Mfp Procurement Plan View',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(19,'mfp_procurement_plan_add','Add','mfp_procurement_plan','Mfp Procurement Plan Add',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(20,'mfp_procurement_plan_edit','Edit','mfp_procurement_plan','Mfp Procurement Plan Edit',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(21,'mfp_procurement_plan_view_mfp_list','View Mfp List','mfp_procurement_plan','MFP Procurement Listing',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(22,'infrastructure_development_view','View','infrastructure_development','View',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(23,'infrastructure_development_add','Add','infrastructure_development','Add',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(24,'infrastructure_development_edit','Edit','infrastructure_development','Edit',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(25,'infrastructure_development_status','Status','infrastructure_development','Status',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(26,'mfp_details_add','Add','mfp_details','Add',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(27,'mfp_details_view','View','mfp_details','View',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(28,'fund_management_approved_consolidate_view','Approved Consolidate View','fund_management','MFP Procurement Generate Sanction List',0,0,NULL,'2021-05-12 06:02:05','2021-05-12 06:02:05'),(29,'fund_management_generate_sanction_letter','Generate Sanction Letter','fund_management','Enable Generate Sanction Letter Button',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(30,'fund_management_view_sanction_letter','View Sanction Letter','fund_management','Enable Generated Sanction Letter View Link',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(31,'fund_management_release_fund','Release Fund','fund_management','MFP Procurement Release Fund List',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(32,'fund_management_view_mfp_procurement_received_fund','View Mfp Procurement Received Fund','fund_management','View Mfp Procurement Received Fund',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(33,'fund_management_view_procurement_agent_fund_details','View Procurement Agent Fund Details','fund_management','View Procurement Agent Fund Details',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(34,'fund_management_view_procurement_agent_received_fund','View Procurement Agent Received Fund','fund_management','View Procurement Agent Received Fund',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(35,'fund_management_infrastructure_development_received_fund','Infrastructure Development Received Fund','fund_management','Infrastructure Development Received Fund',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(36,'mfp_procurement_actual_details_view','View','mfp_procurement_actual_details','View',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(37,'mfp_procurement_actual_details_add','Add','mfp_procurement_actual_details','Add',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(38,'mfp_procurement_actual_details_generate_receipt','Generate Receipt','mfp_procurement_actual_details','Generate Receipt',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(39,'mfp_procurement_actual_details_view_generated_receipt','View Generated Receipt','mfp_procurement_actual_details','View Generated Receipt',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(40,'auction_create_committe','Create Committe','auction','Create Committe',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(41,'auction_view_committe','View Committe','auction','View Committe',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(42,'fund_management_infrastructure_progress_list','Infrastructure Progress List','fund_management','Infrastructure Progress List',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(43,'fund_management_infrastructure_progress_details','Infrastructure Progress Details','fund_management','Infrastructure Progress Details',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(44,'fund_management_infrastructure_transaction_details','Infrastructure Transaction Details','fund_management','Infrastructure Transaction Details',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(45,'fund_management_received_infrastructure_consolidated_proposal','Received Infrastructure Consolidated Proposal','fund_management','Received Infrastructure Consolidated Proposal',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(46,'fund_management_view_dia_commission_details','View Dia Commission Details','fund_management','View Commission Details Of DIA',0,0,NULL,'2021-05-12 06:02:06','2021-05-12 06:02:06'),(47,'fund_management_view_sia_commission_details','View Sia Commission Details','fund_management','View Commission Details Of SIA',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(48,'mfp_procurement_transaction_details_view','View','mfp_procurement_transaction_details','View',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(49,'mfp_procurement_transaction_details_approve_revert_reject','Approve Revert Reject','mfp_procurement_transaction_details','Approve Revert Reject',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(50,'mfp_procurement_transaction_details_consolidated_transaction_view_PA','Consolidated Transaction View PA','mfp_procurement_transaction_details','Consolidated Transaction View PA',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(51,'mfp_procurement_transaction_details_consolidated_transaction_view','Consolidated Transaction View','mfp_procurement_transaction_details','Consolidated Transaction View',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(52,'auction_create_transaction_detail','Create Transaction Detail','auction','Create Transaction Detail',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(53,'auction_view_transaction_detail','View Transaction Detail','auction','View Transaction Detail',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(54,'msp_market_price_approval','Approval','msp_market_price','Approval',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(55,'msp_market_price_add','Add','msp_market_price','Add',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(56,'msp_market_price_edit','Edit','msp_market_price','Edit',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(57,'msp_market_price_view_pending','View Pending','msp_market_price','View Pending',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07'),(58,'msp_market_price_view_approved','View Approved','msp_market_price','View Approved',0,0,NULL,'2021-05-12 06:02:07','2021-05-12 06:02:07');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions_`
--

DROP TABLE IF EXISTS `permissions_`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions_` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_alias_index` (`alias`),
  KEY `permissions_created_by_index` (`created_by`),
  KEY `permissions_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions_`
--

LOCK TABLES `permissions_` WRITE;
/*!40000 ALTER TABLE `permissions_` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions_` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `primary_level_agency`
--

DROP TABLE IF EXISTS `primary_level_agency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `primary_level_agency` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `primary_level_agency`
--

LOCK TABLES `primary_level_agency` WRITE;
/*!40000 ALTER TABLE `primary_level_agency` DISABLE KEYS */;
INSERT INTO `primary_level_agency` VALUES (1,'ABC',1,1,NULL,NULL,NULL),(2,'DEF',2,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `primary_level_agency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procurement_center_master`
--

DROP TABLE IF EXISTS `procurement_center_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procurement_center_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `procurement_center_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procurement_center_master`
--

LOCK TABLES `procurement_center_master` WRITE;
/*!40000 ALTER TABLE `procurement_center_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `procurement_center_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refresh_token`
--

DROP TABLE IF EXISTS `refresh_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refresh_token` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `hash_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expire_time` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refresh_token`
--

LOCK TABLES `refresh_token` WRITE;
/*!40000 ALTER TABLE `refresh_token` DISABLE KEYS */;
INSERT INTO `refresh_token` VALUES (1,1,'e05717ba95e08d52c588f0c5509705661','2020-10-24 10:10:35',NULL,'2020-10-09 05:04:35','2020-10-09 05:04:35'),(2,1,'88c2885342bc409f0948128353d6627f2','2020-10-27 05:10:45',NULL,'2020-10-11 23:32:46','2020-10-11 23:32:46'),(3,1,'dfbf3aa3474d4bdb3d704d5e2deb95ff3','2020-10-27 05:10:54',NULL,'2020-10-11 23:38:54','2020-10-11 23:38:54'),(4,1,'452ab52357b16ecf2e2b73901bfe72804','2020-10-27 06:10:30',NULL,'2020-10-12 00:42:30','2020-10-12 00:42:30'),(5,1,'b5d3e17f0844081beea19e7e6007c8e85','2020-10-27 08:10:40',NULL,'2020-10-12 03:15:40','2020-10-12 03:15:40'),(6,2,'53e08afadc2800b704ec2ff7d8f4c9ca6','2020-10-27 10:10:47',NULL,'2020-10-12 04:34:47','2020-10-12 04:34:47'),(7,1,'c40fb36836f214ee395a0c9a316a1d5a7','2020-10-27 10:10:09',NULL,'2020-10-12 04:35:09','2020-10-12 04:35:09'),(8,2,'00d4b3568ab7805574d9bd0016ea64758','2020-10-27 10:10:04',NULL,'2020-10-12 04:36:04','2020-10-12 04:36:04'),(9,1,'e1fb90ebb0a97d02bcebd57f0ec7d9379','2020-10-27 10:10:50',NULL,'2020-10-12 04:54:50','2020-10-12 04:54:51'),(10,1,'3ff4bd8eece5b789de47fd1fb31f39fe10','2020-10-28 04:10:21',NULL,'2020-10-12 22:46:21','2020-10-12 22:46:21'),(11,1,'cb7746e0040c856350205e0a8e2f194911','2020-10-28 04:10:17',NULL,'2020-10-12 23:15:17','2020-10-12 23:15:17'),(12,1,'b6f4c990640bccbb39853fbf04dae7d812','2020-10-28 05:10:52',NULL,'2020-10-12 23:30:52','2020-10-12 23:30:52'),(13,2,'812fab1c2fd2aaae34c549989b79a6f013','2020-10-28 05:10:11',NULL,'2020-10-12 23:31:11','2020-10-12 23:31:11'),(14,1,'49c2cb99fe1df6b5640df5be3bb2f52d14','2020-10-28 05:10:25',NULL,'2020-10-12 23:44:25','2020-10-12 23:44:25'),(15,2,'af1bb5df21bbebd4285d88364499949f15','2020-10-28 06:10:57',NULL,'2020-10-13 00:47:57','2020-10-13 00:47:57'),(16,2,'06e18960875654745d5e22afe557e8b416','2020-10-28 06:10:18',NULL,'2020-10-13 01:21:18','2020-10-13 01:21:18'),(17,1,'1c65642b302c481fbac66fa81279688217','2020-10-28 08:10:42',NULL,'2020-10-13 03:07:42','2020-10-13 03:07:42'),(18,2,'f412a980c35982e5efd460999abbd35518','2020-10-28 08:10:22',NULL,'2020-10-13 03:11:22','2020-10-13 03:11:22'),(19,1,'00f0b2439f9ffad07b666d943d2a9c7f19','2020-10-28 09:10:44',NULL,'2020-10-13 04:03:44','2020-10-13 04:03:44'),(20,1,'093a4dc2cc67e1107a02a788e7e161a520','2020-10-28 09:10:24',NULL,'2020-10-13 04:11:24','2020-10-13 04:11:24'),(21,2,'85a6d7f44247c1b785ba493a3214f9d721','2020-10-28 09:10:29',NULL,'2020-10-13 04:24:29','2020-10-13 04:24:29'),(22,1,'4f8c6510a911cd827c8ba335ebbd370922','2020-10-28 09:10:42',NULL,'2020-10-13 04:27:42','2020-10-13 04:27:42'),(23,2,'7148bc18f0422a83abb9911812ac1f0123','2020-10-28 10:10:21',NULL,'2020-10-13 05:22:21','2020-10-13 05:22:21'),(24,3,'fb4078c41cdfb73c2e8639b2d76e132424','2020-10-28 11:10:59',NULL,'2020-10-13 05:33:59','2020-10-13 05:33:59'),(25,2,'47891bd630580941e171b3c6a506b06b25','2020-10-28 11:10:29',NULL,'2020-10-13 05:35:29','2020-10-13 05:35:29'),(26,2,'bb8ecb5f3e63541425b968530932765426','2020-10-29 04:10:55',NULL,'2020-10-13 22:48:55','2020-10-13 22:48:55'),(27,2,'4c55cfb01c1037df01c0beb5e1ee0c7327','2020-10-29 05:10:30',NULL,'2020-10-14 00:13:30','2020-10-14 00:13:30'),(28,3,'54ab7818c40c61d02d0946f2cb3ce6a328','2020-10-29 05:10:49',NULL,'2020-10-14 00:14:49','2020-10-14 00:14:49'),(29,3,'b86be87bff2ed0f0f44a58259212180629','2020-10-29 07:10:55',NULL,'2020-10-14 01:42:55','2020-10-14 01:42:55'),(30,3,'7acc83dba4984ad7861b3ddee92a5f4730','2020-10-29 07:10:25',NULL,'2020-10-14 01:43:25','2020-10-14 01:43:25'),(31,2,'1b1800538881be75d72f88d81ba48cde31','2020-10-29 08:10:30',NULL,'2020-10-14 03:03:30','2020-10-14 03:03:30'),(32,3,'8f484b9f57d14ac8e7bd96f5185c639d32','2020-10-29 08:10:23',NULL,'2020-10-14 03:11:23','2020-10-14 03:11:23'),(33,3,'656f0a04ec208fa16973970ce6513c2033','2020-10-29 10:10:51',NULL,'2020-10-14 04:38:51','2020-10-14 04:38:51'),(34,3,'d529b3e8c9005441fd678e5e4d1f651034','2020-10-29 12:10:05',NULL,'2020-10-14 06:38:05','2020-10-14 06:38:05'),(35,2,'d970b842b0d99759aee1cdeb547e56de35','2020-10-29 12:10:48',NULL,'2020-10-14 06:53:48','2020-10-14 06:53:49'),(36,2,'97ad50b4bc7ab3376d6177e5055b899e36','2020-10-30 05:10:28',NULL,'2020-10-15 00:12:28','2020-10-15 00:12:28'),(37,1,'7833d735bc5e814a79e2feee3b09297537','2020-10-30 06:10:47',NULL,'2020-10-15 00:43:47','2020-10-15 00:43:47'),(38,2,'06099e9c8bf48ebe22894012b8047b0738','2020-10-30 06:10:15',NULL,'2020-10-15 01:28:15','2020-10-15 01:28:15'),(39,3,'0047c3bd61240d6aa09b6c09504eab8f39','2020-10-30 08:10:54',NULL,'2020-10-15 03:04:54','2020-10-15 03:04:54'),(40,3,'694dda0819b2af02ca6679bdcf3bdc0540','2020-10-30 09:10:00',NULL,'2020-10-15 04:05:00','2020-10-15 04:05:00'),(41,3,'2dbeeb9e7011edbc22ee5da2d976924441','2020-10-30 09:10:41',NULL,'2020-10-15 04:05:41','2020-10-15 04:05:41'),(42,3,'13214eed86ad98d2df4127511884740242','2020-10-30 10:10:04',NULL,'2020-10-15 05:28:04','2020-10-15 05:28:04'),(43,1,'69bdb946f8cf6f6c9c6aa577051a261343','2020-10-30 11:10:13',NULL,'2020-10-15 06:13:13','2020-10-15 06:13:13'),(44,2,'62504400f8b0a05a2e80ebd52cb5d54644','2020-10-30 12:10:41',NULL,'2020-10-15 06:32:41','2020-10-15 06:32:41'),(45,3,'29b0cc6dbed781556d84ae7660f8083745','2020-10-30 12:10:35',NULL,'2020-10-15 06:33:35','2020-10-15 06:33:36'),(46,1,'3d8e2e4fc44c151e20c35e33281b7bf946','2020-10-31 05:10:13',NULL,'2020-10-15 23:32:13','2020-10-15 23:32:13'),(47,1,'d2af5ec047831c778b9f5b840b746ee447','2020-10-31 05:10:54',NULL,'2020-10-16 00:04:54','2020-10-16 00:04:54'),(48,2,'c4326d8bcb64a966f85d55c28fe7c4c048','2020-10-31 05:10:57',NULL,'2020-10-16 00:11:57','2020-10-16 00:11:57'),(49,3,'a2f82e027c6a9edb266ac66c91c6be4e49','2020-10-31 06:10:44',NULL,'2020-10-16 00:44:44','2020-10-16 00:44:44'),(50,2,'24bc735238a476695efa08975b0886fb50','2020-10-31 06:10:42',NULL,'2020-10-16 00:45:42','2020-10-16 00:45:42'),(51,1,'07aaa5d20328ad7e1ecb5b7ec7a5d14551','2020-10-31 06:10:50',NULL,'2020-10-16 01:01:50','2020-10-16 01:01:50'),(52,3,'c8b41e71af50440855e9ab0ef17193e452','2020-10-31 06:10:02',NULL,'2020-10-16 01:11:02','2020-10-16 01:11:03'),(53,3,'63b4062dde3e6c372cde8d410eb64a1c53','2020-10-31 06:10:51',NULL,'2020-10-16 01:14:51','2020-10-16 01:14:51'),(54,4,'4645796108b94cc339c8c58c7b1bb25d54','2020-10-31 08:10:30',NULL,'2020-10-16 03:17:30','2020-10-16 03:17:30'),(55,3,'e361dedb2f43d97f80f932a0572b79d155','2020-10-31 08:10:22',NULL,'2020-10-16 03:18:22','2020-10-16 03:18:22'),(56,6,'9c92d391411da1509ad911fbb40302a056','2020-10-31 10:10:10',NULL,'2020-10-16 05:07:10','2020-10-16 05:07:10'),(57,1,'b126f43133f04d0023e27bb7ee007c1557','2020-10-31 10:10:01',NULL,'2020-10-16 05:09:01','2020-10-16 05:09:01'),(58,5,'0cb5299e293547c3406c533fcdb7537c58','2020-10-31 11:10:19',NULL,'2020-10-16 05:31:19','2020-10-16 05:31:19'),(59,5,'ab03a01899c30dc7235cd0e3e835838259','2020-10-31 11:10:02',NULL,'2020-10-16 05:42:02','2020-10-16 05:42:02'),(60,4,'80a1b88424de6c55b1f63a17cddc103b60','2020-10-31 11:10:19',NULL,'2020-10-16 05:43:19','2020-10-16 05:43:19'),(61,5,'bd48d238db0e30ad272b46ab01eacbe561','2020-10-31 11:10:34',NULL,'2020-10-16 05:56:34','2020-10-16 05:56:34'),(62,1,'fc2df39694c2489c9ccd3e2eeae4546962','2020-10-31 11:10:58',NULL,'2020-10-16 05:57:58','2020-10-16 05:57:58'),(63,5,'683f3d56cdc71d820371472f6f3c8d5463','2020-10-31 11:10:27',NULL,'2020-10-16 05:59:27','2020-10-16 05:59:27'),(64,5,'8f4b50e7844829c9c80365683646fe9f64','2020-10-31 12:10:30',NULL,'2020-10-16 07:10:30','2020-10-16 07:10:30'),(65,6,'f9c85a3ab3d940999094c612fa6f6b4365','2020-11-03 05:11:58',NULL,'2020-10-19 00:25:58','2020-10-19 00:25:58'),(66,5,'997ebdd45234624384895d715a8d834666','2020-11-03 06:11:05',NULL,'2020-10-19 00:32:05','2020-10-19 00:32:05'),(67,5,'5c49f1f49a6cbafa4c458e7375729b4367','2020-11-03 06:11:06',NULL,'2020-10-19 00:58:06','2020-10-19 00:58:06'),(68,6,'4127bdee0c8f01c18e2522b190d7cdf368','2020-11-03 06:11:48',NULL,'2020-10-19 01:23:48','2020-10-19 01:23:48'),(69,5,'4b13d3a857c45e1f8d535c259f46996b69','2020-11-03 09:11:09',NULL,'2020-10-19 03:45:09','2020-10-19 03:45:09'),(70,6,'0bbb9808fae0a5046e29661bb9a4387370','2020-11-03 09:11:08',NULL,'2020-10-19 03:46:08','2020-10-19 03:46:08'),(71,6,'29757dbda5ca73fd133a4cfaa02ee9f871','2020-11-03 09:11:21',NULL,'2020-10-19 04:13:21','2020-10-19 04:13:21'),(72,6,'516e57526bf6f3ce3f0e0a446546e6a872','2020-11-03 12:11:01',NULL,'2020-10-19 06:45:01','2020-10-19 06:45:01'),(73,6,'675f24e485fd6332a1aa9d8133152f2373','2020-11-03 12:11:55',NULL,'2020-10-19 06:45:55','2020-10-19 06:45:55'),(74,5,'2fbe6f1aae1d26a5fbf35b11081a438074','2020-11-04 04:11:44',NULL,'2020-10-19 23:22:44','2020-10-19 23:22:44'),(75,6,'2e2f8026bd94f4af0dfe988a186c82c675','2020-11-04 05:11:51',NULL,'2020-10-19 23:37:51','2020-10-19 23:37:51'),(76,6,'3714eaa9183c395d609f5f66ffc5a7a676','2020-11-04 07:11:43',NULL,'2020-10-20 01:31:43','2020-10-20 01:31:43'),(77,5,'9a5033a0cabcce2b1cf11024a805c2bc77','2020-11-04 07:11:46',NULL,'2020-10-20 01:57:46','2020-10-20 01:57:46'),(78,4,'ef74054d2d48a5d88b0304b284cda71878','2020-11-04 07:11:06',NULL,'2020-10-20 02:05:06','2020-10-20 02:05:06'),(79,5,'6b7f957b7b1670bceff9fab1fb00c5e879','2020-11-04 07:11:05',NULL,'2020-10-20 02:06:05','2020-10-20 02:06:05'),(80,5,'1e8ada2df201ba077552b6a6d75e219180','2020-11-04 07:11:07',NULL,'2020-10-20 02:12:07','2020-10-20 02:12:07'),(81,4,'01369c119c8d5cabfe4beb10af9120e181','2020-11-04 07:11:20',NULL,'2020-10-20 02:13:20','2020-10-20 02:13:20'),(82,4,'9d474a6a056b3ac649a2aae3a01d678d82','2020-11-04 12:11:18',NULL,'2020-10-20 06:36:18','2020-10-20 06:36:18'),(83,5,'0573f53a013fee5d51eae3ad93bc586283','2020-11-04 13:11:07',NULL,'2020-10-20 07:32:07','2020-10-20 07:32:07'),(84,6,'5a2b99492c0985ddd8fd29fad676a3f784','2020-11-04 13:11:18',NULL,'2020-10-20 07:36:18','2020-10-20 07:36:18'),(85,8,'f5bf95f3a27926206089202dc01ad30885','2020-11-04 13:11:36',NULL,'2020-10-20 07:38:36','2020-10-20 07:38:36'),(86,1,'d6a7ecc88080e0d89dfab6646f5779fe86','2020-11-04 13:11:07',NULL,'2020-10-20 07:39:07','2020-10-20 07:39:07'),(87,8,'32a1d497f39e20eade4528dcacd507ae87','2020-11-05 05:11:15',NULL,'2020-10-20 23:33:15','2020-10-20 23:33:15'),(88,1,'50ae0360d1338b6b7d4bc4999c3732d588','2020-11-05 05:11:46',NULL,'2020-10-20 23:44:46','2020-10-20 23:44:46'),(89,8,'801bd794e7b06b81a980308a409d1fec89','2020-11-05 05:11:45',NULL,'2020-10-20 23:46:45','2020-10-20 23:46:45'),(90,2,'925f86452d38e2464164affd41319a3890','2020-11-05 05:11:34',NULL,'2020-10-20 23:56:34','2020-10-20 23:56:34'),(91,3,'1e677dcd0662448e079e1da7b940b2e991','2020-11-05 05:11:14',NULL,'2020-10-21 00:09:14','2020-10-21 00:09:14'),(92,4,'1cfb51889df27c4f21952e102627f03892','2020-11-05 05:11:13',NULL,'2020-10-21 00:11:13','2020-10-21 00:11:13'),(93,4,'9c4fff1e168fd99fe8f14cb00a79e7e693','2020-11-05 05:11:24',NULL,'2020-10-21 00:23:24','2020-10-21 00:23:24'),(94,5,'df23dd5bc31997664d9c2b2e9fa65e7e94','2020-11-05 05:11:52',NULL,'2020-10-21 00:23:52','2020-10-21 00:23:52'),(95,6,'7e99c927e5779cb457d738bcb9b0810e95','2020-11-05 05:11:22',NULL,'2020-10-21 00:26:22','2020-10-21 00:26:23'),(96,8,'01a6c4dd1496b803e3a60750479d68e796','2020-11-05 05:11:46',NULL,'2020-10-21 00:27:46','2020-10-21 00:27:46'),(97,8,'03b31edc77d3a4e43f888b094554727597','2020-11-05 08:11:27',NULL,'2020-10-21 03:17:27','2020-10-21 03:17:27'),(98,7,'1e95102653822bbe8148cc4d29126c8898','2020-11-05 09:11:43',NULL,'2020-10-21 03:39:43','2020-10-21 03:39:44'),(99,9,'abe53f2581d9e21c727b634d1e99fc3999','2020-11-05 09:11:59',NULL,'2020-10-21 03:54:59','2020-10-21 03:54:59'),(100,1,'136af09464037e9f346a0d2e3d4d0a96100','2020-11-05 09:11:53',NULL,'2020-10-21 03:55:53','2020-10-21 03:55:53'),(101,9,'bf3f39cde9b0dc19f69838babafdb080101','2020-11-05 09:11:58',NULL,'2020-10-21 03:56:58','2020-10-21 03:56:58'),(102,2,'1fb8b7fb4c10eadc0cb3a645727a882f102','2020-11-05 10:11:49',NULL,'2020-10-21 04:47:49','2020-10-21 04:47:49'),(103,3,'3f6e66b863359f14cc69f2f97c81638c103','2020-11-05 10:11:18',NULL,'2020-10-21 05:01:18','2020-10-21 05:01:18'),(104,4,'5fb5a36e9177ed16bb3bbdd617859809104','2020-11-05 10:11:51',NULL,'2020-10-21 05:02:51','2020-10-21 05:02:51'),(105,5,'63f0064dd8e07bebcc11ea97fe78c5a6105','2020-11-05 10:11:14',NULL,'2020-10-21 05:04:14','2020-10-21 05:04:14'),(106,5,'f3989a1f081732df4aad18072a4322a6106','2020-11-05 10:11:55',NULL,'2020-10-21 05:07:55','2020-10-21 05:07:55'),(107,6,'91636db01f8e6078305a98900c0d975b107','2020-11-05 10:11:27',NULL,'2020-10-21 05:19:27','2020-10-21 05:19:27'),(108,6,'c7c673455212ba4e53b7dbf8c9bab4f3108','2020-11-05 11:11:06',NULL,'2020-10-21 05:45:06','2020-10-21 05:45:06'),(109,8,'0c79702e612ac10775969f2e5359b0db109','2020-11-05 11:11:38',NULL,'2020-10-21 05:45:38','2020-10-21 05:45:38'),(110,9,'12fac69ca6cdeaf81fb2984f1d1cebe1110','2020-11-05 11:11:28',NULL,'2020-10-21 05:46:28','2020-10-21 05:46:29'),(111,6,'5f8e8b2fa0f6f8cc02003df9584c5707111','2020-11-06 05:11:30',NULL,'2020-10-22 00:00:30','2020-10-22 00:00:30'),(112,2,'4c14e99d118ab4ded31e817f0e63b8e2112','2020-11-06 09:11:04',NULL,'2020-10-22 03:52:04','2020-10-22 03:52:04'),(113,2,'5cab6085014e8bbe5ee3b2f978237a9c113','2020-11-07 09:11:05',NULL,'2020-10-23 03:41:05','2020-10-23 03:41:05'),(114,3,'752890df5712f8874364073027f1d8ca114','2020-11-07 09:11:22',NULL,'2020-10-23 04:04:22','2020-10-23 04:04:22'),(115,4,'2562a348bd488d5dbcd44c2ed9fd961a115','2020-11-07 09:11:11',NULL,'2020-10-23 04:06:11','2020-10-23 04:06:11'),(116,6,'0a024a9a99406b9e42350dc5861f38b4116','2020-11-07 09:11:45',NULL,'2020-10-23 04:07:45','2020-10-23 04:07:45'),(117,5,'0a681f5821074aab32e7de711bc39f68117','2020-11-07 09:11:06',NULL,'2020-10-23 04:08:06','2020-10-23 04:08:06'),(118,6,'5e2dd89295f9204ab7f3dfad038e9ab2118','2020-11-07 09:11:35',NULL,'2020-10-23 04:09:35','2020-10-23 04:09:35'),(119,8,'776fed45ce750a3913fa6fa1fdb71fc0119','2020-11-07 09:11:36',NULL,'2020-10-23 04:10:36','2020-10-23 04:10:36'),(120,9,'7c8854ae50d49e448597564f4ab7e9d4120','2020-11-07 10:11:57',NULL,'2020-10-23 04:30:57','2020-10-23 04:30:57'),(121,8,'a0668449627ba817e4d4571ad3720bde121','2020-11-07 11:11:09',NULL,'2020-10-23 05:46:09','2020-10-23 05:46:09'),(122,6,'d2ad28ce161a0420329b430784330b8e122','2020-11-10 05:11:49',NULL,'2020-10-26 00:03:49','2020-10-26 00:03:49'),(123,5,'20c899a49a37e01250135b2ae7ffbced123','2020-11-10 06:11:46',NULL,'2020-10-26 01:16:46','2020-10-26 01:16:46'),(124,6,'72e6a97a680ca04c1a4b331c20d02ef8124','2020-11-10 07:11:38',NULL,'2020-10-26 01:49:38','2020-10-26 01:49:38'),(125,2,'d36010f1188710eefcfa2ed2d799decb125','2020-11-10 08:11:33',NULL,'2020-10-26 03:16:33','2020-10-26 03:16:33'),(126,3,'da35db80f99f4134b4fdbc99c323f274126','2020-11-10 08:11:16',NULL,'2020-10-26 03:26:16','2020-10-26 03:26:16'),(127,3,'ece06239221140a95f98dde6b3a1b710127','2020-11-10 08:11:53',NULL,'2020-10-26 03:28:53','2020-10-26 03:28:53'),(128,2,'bf4eefc81cece382a71b7440e0c55cf7128','2020-11-10 09:11:35',NULL,'2020-10-26 03:35:35','2020-10-26 03:35:35'),(129,3,'7ffb0e92e7c46c2e50f751af51a9e886129','2020-11-10 09:11:06',NULL,'2020-10-26 03:37:06','2020-10-26 03:37:06'),(130,4,'78c635f6af99c30aed90e041c0473c42130','2020-11-10 09:11:39',NULL,'2020-10-26 03:46:39','2020-10-26 03:46:39'),(131,3,'8a54a2961a5bd4b8cbf1191872f60979131','2020-11-10 09:11:20',NULL,'2020-10-26 03:52:20','2020-10-26 03:52:20'),(132,4,'687185f0a5763fe257588ca7846a123e132','2020-11-10 09:11:32',NULL,'2020-10-26 04:28:32','2020-10-26 04:28:32'),(133,6,'e52262a8c8a6b0a3d025bfc7edd53872133','2020-11-10 10:11:05',NULL,'2020-10-26 04:35:05','2020-10-26 04:35:05'),(134,4,'b2ff6dc31286f3e28a2f5a9f15b9d3bc134','2020-11-10 10:11:43',NULL,'2020-10-26 04:35:43','2020-10-26 04:35:43'),(135,5,'365a0ab87021f3dc8516291c9c1356e3135','2020-11-10 10:11:53',NULL,'2020-10-26 04:36:53','2020-10-26 04:36:53'),(136,4,'d989d1a88ce8a8295f1ee6ccc391ad55136','2020-11-10 10:11:29',NULL,'2020-10-26 04:38:29','2020-10-26 04:38:29'),(137,5,'e9d0cedaa1819fc02ece5875ae41c44c137','2020-11-10 10:11:37',NULL,'2020-10-26 04:39:37','2020-10-26 04:39:37'),(138,6,'44e82ccfa2961f8a9d72dc4db45e511a138','2020-11-10 10:11:12',NULL,'2020-10-26 04:41:12','2020-10-26 04:41:12'),(139,5,'fe0c25bb916378eee5d9c33068aab0b9139','2020-11-10 10:11:03',NULL,'2020-10-26 04:50:03','2020-10-26 04:50:03'),(140,5,'0bda14eecffd8abcf3b726f9eb6b1a66140','2020-11-10 10:11:46',NULL,'2020-10-26 04:50:46','2020-10-26 04:50:46'),(141,4,'d7f1b78f7b913a6044d974c7db4dcd88141','2020-11-10 10:11:59',NULL,'2020-10-26 04:55:59','2020-10-26 04:55:59'),(142,6,'be914b912b42095bff2292d4068e3e1b142','2020-11-10 10:11:33',NULL,'2020-10-26 04:56:33','2020-10-26 04:56:33'),(143,8,'f49df6afc7ede64c290ea548fc6877ac143','2020-11-10 10:11:09',NULL,'2020-10-26 04:59:09','2020-10-26 04:59:09'),(144,9,'4383494fc89e32974904d9f732c09098144','2020-11-10 10:11:09',NULL,'2020-10-26 05:05:09','2020-10-26 05:05:09'),(145,9,'db91b62a83ba153070d86e340bde9b2d145','2020-11-11 04:11:56',NULL,'2020-10-26 23:19:56','2020-10-26 23:19:56'),(146,1,'33c5438e2e01546b8fbb64a5781c13e8146','2020-11-11 13:11:01',NULL,'2020-10-27 08:27:01','2020-10-27 08:27:01'),(147,9,'9097f95195d18d802e3ce8fb82ac1bc5147','2020-11-13 05:11:14',NULL,'2020-10-28 23:39:14','2020-10-28 23:39:14'),(148,1,'67e0dd3df5341908b10cb482b2104402148','2020-11-13 05:11:01',NULL,'2020-10-28 23:55:01','2020-10-28 23:55:01'),(149,7,'bf8f08b1965b0631061180cb7cc4d712149','2020-11-13 05:11:00',NULL,'2020-10-29 00:18:00','2020-10-29 00:18:00'),(150,1,'f5d07597aea18df3cd7697931dd6ef53150','2020-11-13 05:11:30',NULL,'2020-10-29 00:20:30','2020-10-29 00:20:30'),(151,7,'73d3cbb93db34824bd331e19fa97717f151','2020-11-13 05:11:06',NULL,'2020-10-29 00:23:06','2020-10-29 00:23:06'),(152,9,'f59c166d3fb66ae0c060fc8194547b40152','2020-11-13 06:11:21',NULL,'2020-10-29 00:59:21','2020-10-29 00:59:21'),(153,7,'96c63fdd3fc69386ce7dbb5849bb7d73153','2020-11-13 07:11:56',NULL,'2020-10-29 01:30:56','2020-10-29 01:30:56'),(154,2,'5be88a4ed3cc521f64a7122719b7f03d154','2020-11-13 07:11:36',NULL,'2020-10-29 01:35:36','2020-10-29 01:35:36'),(155,2,'763292d242c6c1d3523e9094bec5c538155','2020-11-13 09:11:46',NULL,'2020-10-29 04:07:46','2020-10-29 04:07:46'),(156,1,'edb88057fdb56cccd1bbde377a1a3f2b156','2020-11-13 09:11:32',NULL,'2020-10-29 04:17:32','2020-10-29 04:17:32'),(157,5,'db3868c4a36dd4d5e1d82d85cb06de6f157','2020-11-13 09:11:26',NULL,'2020-10-29 04:18:26','2020-10-29 04:18:26'),(158,1,'f354678aceccc20609502798350db71e158','2020-11-17 06:11:12',NULL,'2020-11-02 00:42:12','2020-11-02 00:42:12'),(159,1,'bf67c964680693b81bf0184d6e3e9542159','2020-11-17 09:11:00',NULL,'2020-11-02 03:31:00','2020-11-02 03:31:00'),(160,1,'27e9e91b7b0be8bca4c17d0b43b410f7160','2020-11-17 10:11:21',NULL,'2020-11-02 04:34:21','2020-11-02 04:34:21'),(161,5,'9a0c08a1bf466efa45f8ff04de898dd9161','2020-11-18 05:11:12',NULL,'2020-11-02 23:49:12','2020-11-02 23:49:12'),(162,3,'323f99db2df1d48705c0258a9af83d28162','2020-11-18 05:11:43',NULL,'2020-11-03 00:00:43','2020-11-03 00:00:43'),(163,2,'786179f1ec6195476e8f89b591a8add7163','2020-11-18 05:11:28',NULL,'2020-11-03 00:01:28','2020-11-03 00:01:28'),(164,1,'fce37cab7705b8d39f2dae9627ec88f1164','2020-11-18 05:11:20',NULL,'2020-11-03 00:04:20','2020-11-03 00:04:20'),(165,3,'97c3d0830c662bba26d295e047bda863165','2020-11-18 05:11:07',NULL,'2020-11-03 00:10:07','2020-11-03 00:10:07'),(166,3,'9e7c814b837e6d8aaaf1e1b980ce1515166','2020-11-18 05:11:47',NULL,'2020-11-03 00:11:47','2020-11-03 00:11:47'),(167,4,'9ccd9f99ef44576788155d0ae1a706dc167','2020-11-18 05:11:04',NULL,'2020-11-03 00:24:04','2020-11-03 00:24:04'),(168,5,'fbaa7f190e81ef92eafe0a60578272fd168','2020-11-18 06:11:57',NULL,'2020-11-03 00:59:57','2020-11-03 00:59:57'),(169,6,'6e2a1163a78a5f01023a20884081a098169','2020-11-18 06:11:08',NULL,'2020-11-03 01:01:08','2020-11-03 01:01:08'),(170,6,'def65fb5546c1dfb93a8a9e9bfe65f00170','2020-11-18 08:11:12',NULL,'2020-11-03 02:55:12','2020-11-03 02:55:12'),(171,1,'f94452ff5ac989cd1bef2c2dc729c9e6171','2020-11-18 09:11:10',NULL,'2020-11-03 04:25:10','2020-11-03 04:25:10'),(172,1,'cdda6f2f0f8590144bf1eac46b5ee829172','2020-11-18 09:11:52',NULL,'2020-11-03 04:25:52','2020-11-03 04:25:52'),(173,1,'464cbee1d1317f2552a0eaab4dcc4e40173','2020-11-19 05:11:16',NULL,'2020-11-04 00:01:16','2020-11-04 00:01:16'),(174,9,'159af88eada2170857ea62e7122642bd174','2020-11-19 05:11:20',NULL,'2020-11-04 00:07:20','2020-11-04 00:07:20'),(175,9,'482a27997396565836d0787189fea668175','2020-11-19 05:11:07',NULL,'2020-11-04 00:10:07','2020-11-04 00:10:07'),(176,9,'57ac4ac738f13d5b2de2f314723d6c16176','2020-11-19 06:11:35',NULL,'2020-11-04 01:22:35','2020-11-04 01:22:35'),(177,1,'bbe1dd439f2abbe3d505c32f19827de0177','2020-11-19 09:11:21',NULL,'2020-11-04 03:37:21','2020-11-04 03:37:21'),(178,9,'2073954df24a82570ba6f8ceb9ac76cc178','2020-11-19 10:11:22',NULL,'2020-11-04 05:16:22','2020-11-04 05:16:22'),(179,1,'ff848df24c15dc40cca782aa7f054de6179','2020-11-19 10:11:44',NULL,'2020-11-04 05:16:44','2020-11-04 05:16:44'),(180,9,'d5ec5964e6c880352e881af93d96f49f180','2020-11-19 10:11:28',NULL,'2020-11-04 05:17:28','2020-11-04 05:17:28'),(181,1,'eeaf826014e689f0476610e4baac5878181','2020-11-19 10:11:18',NULL,'2020-11-04 05:19:18','2020-11-04 05:19:18'),(182,9,'87874f1cb0933d2f1dd5668e1f82eeef182','2020-11-19 10:11:05',NULL,'2020-11-04 05:20:05','2020-11-04 05:20:05'),(183,9,'c8d5b043232ba595c6d0a2d3fe92fc25183','2020-11-19 10:11:45',NULL,'2020-11-04 05:20:45','2020-11-04 05:20:45'),(184,1,'2772147793e2b9ad17973b619314286b184','2020-11-20 04:11:25',NULL,'2020-11-04 23:11:25','2020-11-04 23:11:25'),(185,9,'2679478bd02288b953128382db53973b185','2020-11-20 05:11:26',NULL,'2020-11-04 23:40:26','2020-11-04 23:40:26'),(186,9,'077dd8525e2626eea98fcd3748968afe186','2020-11-20 05:11:16',NULL,'2020-11-05 00:11:16','2020-11-05 00:11:16'),(187,2,'20131d8cc405ee51149823282bd6ba71187','2020-11-20 05:11:03',NULL,'2020-11-05 00:12:03','2020-11-05 00:12:03'),(188,3,'18aeb18712c5b90490095bf31e1897b6188','2020-11-20 05:11:41',NULL,'2020-11-05 00:17:41','2020-11-05 00:17:41'),(189,4,'89c52372204bea48445b8b610219d1c7189','2020-11-20 05:11:53',NULL,'2020-11-05 00:18:53','2020-11-05 00:18:53'),(190,3,'e5bb7263cdfffc501d174b88695292cd190','2020-11-20 05:11:50',NULL,'2020-11-05 00:19:50','2020-11-05 00:19:50'),(191,4,'e1f2377607396717883d5166d69ed693191','2020-11-20 05:11:11',NULL,'2020-11-05 00:22:11','2020-11-05 00:22:11'),(192,5,'f65396c0c97e0f49f79906850c8e77a2192','2020-11-20 05:11:59',NULL,'2020-11-05 00:22:59','2020-11-05 00:22:59'),(193,6,'1a5930c0e395bd48a488625afd24266a193','2020-11-20 05:11:45',NULL,'2020-11-05 00:23:45','2020-11-05 00:23:45'),(194,8,'c0d141df65f2aca33c4658997b88b3d4194','2020-11-20 05:11:47',NULL,'2020-11-05 00:26:47','2020-11-05 00:26:47'),(195,8,'60a4d7358359fa3cb6adff5a2384050c195','2020-11-20 06:11:54',NULL,'2020-11-05 00:35:54','2020-11-05 00:35:54'),(196,9,'d2bb0d2ee122638169a4a918469e49a1196','2020-11-20 06:11:14',NULL,'2020-11-05 00:37:14','2020-11-05 00:37:14'),(197,1,'edda09ca9b2d4ce6c8f7ca84fc3fb05d197','2020-11-20 06:11:01',NULL,'2020-11-05 00:49:01','2020-11-05 00:49:01'),(198,9,'bae9f96754fd7f6ecf02eae60a7a3ba7198','2020-11-20 06:11:46',NULL,'2020-11-05 00:49:46','2020-11-05 00:49:46'),(199,1,'3573c963d93bcfaf56a6724f5ff9fe87199','2020-11-20 09:11:36',NULL,'2020-11-05 03:51:36','2020-11-05 03:51:36'),(200,1,'8c8db4d755ef157dbb0036eda606ea59200','2020-11-20 10:11:20',NULL,'2020-11-05 05:01:20','2020-11-05 05:01:20'),(201,1,'d852932fc3aeefe88bce5b719daa9de9201','2020-11-21 04:11:16',NULL,'2020-11-05 22:38:16','2020-11-05 22:38:16'),(202,1,'c98a5b7db519faa950ba795af4de88f8202','2020-11-21 04:11:05',NULL,'2020-11-05 23:18:05','2020-11-05 23:18:05'),(203,1,'ba2476815f8874658a54b03c87578bd9203','2020-11-24 05:11:32',NULL,'2020-11-08 23:52:32','2020-11-08 23:52:32'),(204,1,'4e5a11e53b42e826409cca090577520d204','2020-11-24 05:11:46',NULL,'2020-11-09 00:10:46','2020-11-09 00:10:46'),(205,2,'3707f4d47e15efd402bebf4e3144ef57205','2020-11-24 07:11:08',NULL,'2020-11-09 01:31:08','2020-11-09 01:31:08'),(206,1,'c2fc34e70355034e795273437438ba1d206','2020-11-24 09:11:55',NULL,'2020-11-09 03:45:55','2020-11-09 03:45:55'),(207,5,'373f2d73d4cf4c0e8ee4da0a95dde72f207','2020-11-24 09:11:46',NULL,'2020-11-09 03:48:46','2020-11-09 03:48:46'),(208,2,'6aea276f6a96ec9bdbc8a0fdc15cf25a208','2020-11-24 10:11:40',NULL,'2020-11-09 04:35:40','2020-11-09 04:35:40'),(209,5,'701bd0a8ca29ceaa844a696a67b8be76209','2020-11-24 10:11:10',NULL,'2020-11-09 04:51:10','2020-11-09 04:51:10'),(210,9,'c0b77d01c0b23a4f6a4fc33e02196447210','2020-11-24 10:11:34',NULL,'2020-11-09 04:53:34','2020-11-09 04:53:34'),(211,9,'f505f88a8381c913e0b9d171f404e866211','2020-11-25 10:11:48',NULL,'2020-11-10 04:38:48','2020-11-10 04:38:48'),(212,1,'3209c397bb4d97a35500092b39baca8d212','2020-11-26 10:11:29',NULL,'2020-11-11 05:12:29','2020-11-11 05:12:29'),(213,9,'2fb27d45da84a6a4d49cabaa0b24760f213','2020-11-26 10:11:09',NULL,'2020-11-11 05:13:09','2020-11-11 05:13:09'),(214,1,'b5a36cdcab8afdfcada183d13bcd165d214','2020-11-26 12:11:25',NULL,'2020-11-11 06:30:25','2020-11-11 06:30:25'),(215,9,'2400e7102365289476ab4a297faa02d7215','2020-11-26 12:11:54',NULL,'2020-11-11 06:30:54','2020-11-11 06:30:54'),(216,1,'ac37660e4c9b340ffc4dc77d2d2e61bb216','2020-11-26 12:11:52',NULL,'2020-11-11 06:31:52','2020-11-11 06:31:52'),(217,9,'96ff3855df942fb1cf2a95b3b877b24d217','2020-11-26 12:11:30',NULL,'2020-11-11 07:02:30','2020-11-11 07:02:30'),(218,1,'ebdea4c516b78c29c835e50f16a09160218','2020-11-26 12:11:57',NULL,'2020-11-11 07:17:57','2020-11-11 07:17:57'),(219,8,'f17e3a4ecfff3d2ae1ee5c8c965e0927219','2020-11-26 12:11:58',NULL,'2020-11-11 07:23:58','2020-11-11 07:23:58'),(220,9,'5abf6369105ca35ebbff32d94792a970220','2020-11-26 13:11:09',NULL,'2020-11-11 07:30:09','2020-11-11 07:30:09'),(221,9,'059ef4c705a0c62fa767fb3db44f5a12221','2020-11-27 04:11:42',NULL,'2020-11-11 22:42:42','2020-11-11 22:42:42'),(222,9,'30b893856c21e4d504c422af87576154222','2020-11-27 06:11:37',NULL,'2020-11-12 01:07:37','2020-11-12 01:07:37'),(223,9,'90f5a5795fadc0062420ce90a7f625d4223','2020-11-27 07:11:20',NULL,'2020-11-12 02:10:20','2020-11-12 02:10:20'),(224,8,'22da5d85c1254b35542b06c6916d2a03224','2020-11-27 07:11:33',NULL,'2020-11-12 02:28:33','2020-11-12 02:28:33'),(225,1,'fa151adcc9c506c75afd839823cf1b80225','2020-11-27 07:11:08',NULL,'2020-11-12 02:29:08','2020-11-12 02:29:08'),(226,8,'7ce8019f8f5a5d946b6788f15d01eebb226','2020-11-27 07:11:58',NULL,'2020-11-12 02:29:58','2020-11-12 02:29:58'),(227,8,'3bd19b2b86166f7ec112d0e871ec6c2f227','2020-11-27 09:11:50',NULL,'2020-11-12 03:48:50','2020-11-12 03:48:50'),(228,9,'78d10c2f73c4ed962041c99f3cc5c36c228','2020-11-27 09:11:23',NULL,'2020-11-12 03:49:23','2020-11-12 03:49:23'),(229,8,'d2217bb027380b3e15a6a231d73d433c229','2020-11-27 09:11:59',NULL,'2020-11-12 04:03:59','2020-11-12 04:03:59'),(230,6,'6af1fe982b5ebb30b415d65899978e3a230','2020-11-27 09:11:33',NULL,'2020-11-12 04:05:33','2020-11-12 04:05:33'),(231,5,'ad7a821881ccaabe576063e4828eba8a231','2020-11-27 09:11:52',NULL,'2020-11-12 04:05:52','2020-11-12 04:05:52'),(232,3,'9da25affab0b57ca31f428b26c8bd7c6232','2020-11-27 09:11:22',NULL,'2020-11-12 04:06:22','2020-11-12 04:06:22'),(233,2,'ade5746316537eaca1a8a6d4d45d9c44233','2020-11-27 09:11:52',NULL,'2020-11-12 04:06:52','2020-11-12 04:06:53'),(234,2,'27b01b1d88cc6d1a9f1c00e4f05c8121234','2020-11-27 10:11:50',NULL,'2020-11-12 04:51:50','2020-11-12 04:51:50'),(235,3,'3cd70da60d7ef5182863bf3ded896db7235','2020-11-27 10:11:08',NULL,'2020-11-12 05:00:08','2020-11-12 05:00:08'),(236,4,'6e8f872f7b2136e17105626ffd95eaef236','2020-11-27 10:11:09',NULL,'2020-11-12 05:01:09','2020-11-12 05:01:09'),(237,5,'74ecdb00c20f83d0d50391d277dd68cd237','2020-11-27 10:11:50',NULL,'2020-11-12 05:01:50','2020-11-12 05:01:50'),(238,6,'ffe3205181aed37ea31827826bdd0038238','2020-11-27 10:11:37',NULL,'2020-11-12 05:02:37','2020-11-12 05:02:37'),(239,8,'5e3fe2abf5d60283580cba4281fcc904239','2020-11-27 10:11:03',NULL,'2020-11-12 05:04:03','2020-11-12 05:04:03'),(240,9,'c35b8e0aaf17a1dbb81ceaa43b99f1d2240','2020-11-27 10:11:01',NULL,'2020-11-12 05:05:01','2020-11-12 05:05:01'),(241,8,'d1a53e100de7aefaf88d7b9fde46daf2241','2020-11-27 10:11:01',NULL,'2020-11-12 05:22:01','2020-11-12 05:22:01'),(242,9,'d86849fcc0c38a360f556f989f559fc0242','2020-11-28 04:11:25',NULL,'2020-11-12 23:01:25','2020-11-12 23:01:25'),(243,8,'72d8cb0ac5d74fcb45c7c1d336d59c7e243','2020-11-28 08:11:06',NULL,'2020-11-13 03:00:06','2020-11-13 03:00:06'),(244,9,'909be1251d1bb7f3d92672623e1ae399244','2020-11-28 09:11:18',NULL,'2020-11-13 04:01:18','2020-11-13 04:01:18'),(245,8,'0a97e6c37d6d3c63417611b98544f5ba245','2020-11-28 09:11:41',NULL,'2020-11-13 04:05:41','2020-11-13 04:05:41'),(246,9,'4beb4a7d0b108af3799806077f16b239246','2020-11-28 11:11:50',NULL,'2020-11-13 05:56:50','2020-11-13 05:56:50'),(247,8,'311916658dc81210c2b9f3add1ecff5c247','2020-11-28 11:11:27',NULL,'2020-11-13 05:59:27','2020-11-13 05:59:27'),(248,8,'dad0d88ac8df77441c4a436f9c648222248','2020-12-03 04:12:01',NULL,'2020-11-17 23:27:01','2020-11-17 23:27:01'),(249,9,'c5bdb8fac0f4c41c0b54a3dcdb9899a7249','2020-12-03 05:12:45',NULL,'2020-11-17 23:31:45','2020-11-17 23:31:45'),(250,8,'efde7b7200ac518b1733a05504c00492250','2020-12-03 05:12:18',NULL,'2020-11-18 00:13:18','2020-11-18 00:13:18'),(251,1,'dfb03369cb44bd1a4946b2ed07b38b43251','2020-12-03 09:12:28',NULL,'2020-11-18 03:31:28','2020-11-18 03:31:28'),(252,8,'91aa02fb0d3a47384392a7eb36cfb4d6252','2020-12-03 10:12:12',NULL,'2020-11-18 04:46:12','2020-11-18 04:46:12'),(253,8,'7bb4329dad39d407b86e960cb6bb41d9253','2020-12-04 07:12:04',NULL,'2020-11-19 02:02:04','2020-11-19 02:02:04'),(254,8,'8b68bc2ac63f60dd4dd77636bbb443f2254','2020-12-04 10:12:03',NULL,'2020-11-19 04:50:03','2020-11-19 04:50:04'),(255,9,'03cab57f0b8c27a4ef6ea0b8cbdd4cd8255','2020-12-04 10:12:43',NULL,'2020-11-19 04:50:43','2020-11-19 04:50:43'),(256,8,'297bbb70f33d7a342a5f66648a39fdf1256','2020-12-04 10:12:08',NULL,'2020-11-19 04:51:08','2020-11-19 04:51:08'),(257,8,'5cfdf08f29af9bf9688c9c232a3032b7257','2020-12-05 05:12:13',NULL,'2020-11-19 23:56:13','2020-11-19 23:56:13'),(258,1,'69e7d6170b1a6f7961bbd9cd52736b25258','2020-12-05 05:12:44',NULL,'2020-11-20 00:09:44','2020-11-20 00:09:44'),(259,8,'e016e3cac0c99e879f8f4d2ad910997b259','2020-12-05 06:12:07',NULL,'2020-11-20 01:01:07','2020-11-20 01:01:07'),(260,8,'bb8c20c7562561823bb1313802bbcf51260','2020-12-05 09:12:53',NULL,'2020-11-20 03:59:53','2020-11-20 03:59:53'),(261,1,'0e771ff250ee6fa77e018e5261846ce0261','2020-12-05 10:12:41',NULL,'2020-11-20 04:40:41','2020-11-20 04:40:41'),(262,8,'061922316ba966a00400cf0856f8d776262','2020-12-08 06:12:31',NULL,'2020-11-23 00:37:31','2020-11-23 00:37:31'),(263,8,'f9f38a86e29f3cd39b5c995259001e6f263','2020-12-08 09:12:48',NULL,'2020-11-23 04:26:48','2020-11-23 04:26:49'),(264,6,'a1ca1d4c853507e954e6f793475aaf59264','2020-12-08 11:12:46',NULL,'2020-11-23 05:39:46','2020-11-23 05:39:46'),(265,8,'dd657fb073336b10b90fd0ec30d4ff17265','2020-12-09 04:12:29',NULL,'2020-11-23 23:29:29','2020-11-23 23:29:29'),(266,8,'cf423fe4cb6293a1308324e69706f6ce266','2020-12-09 06:12:27',NULL,'2020-11-24 01:26:27','2020-11-24 01:26:27'),(267,8,'9e924b36bcd116d422a148121627935f267','2020-12-09 08:12:32',NULL,'2020-11-24 03:23:32','2020-11-24 03:23:33'),(268,8,'95fc9077666a9b829ade75e416c1d643268','2020-12-10 09:12:44',NULL,'2020-11-25 04:15:44','2020-11-25 04:15:44'),(269,8,'60a863e8886fb6fd8dd375fa92e3d102269','2020-12-10 11:12:41',NULL,'2020-11-25 05:51:41','2020-11-25 05:51:41'),(270,6,'adef30cc39e60dceb7792a2a3fe5fcd0270','2020-12-11 04:12:51',NULL,'2020-11-25 22:38:51','2020-11-25 22:38:51'),(271,1,'ce1f2b0ec0a833c399dda6a68264ebd4271','2020-12-11 04:12:54',NULL,'2020-11-25 22:40:54','2020-11-25 22:40:54'),(272,5,'9d3f96165a153a78637b8ebc9a8c6db6272','2020-12-11 04:12:57',NULL,'2020-11-25 22:43:57','2020-11-25 22:43:57'),(273,4,'9cb2a99962517273e0124d1d14477f14273','2020-12-11 04:12:00',NULL,'2020-11-25 22:45:00','2020-11-25 22:45:00'),(274,4,'a1d7242fd2119e191122448c467f3d37274','2020-12-11 04:12:06',NULL,'2020-11-25 22:46:06','2020-11-25 22:46:06'),(275,6,'a8ee6eb2e6324b5253d3d2d9f5878ebf275','2020-12-11 05:12:35',NULL,'2020-11-25 23:31:35','2020-11-25 23:31:35'),(276,6,'6458bd4a7929a73d7962978967ec9fe3276','2020-12-11 07:12:13',NULL,'2020-11-26 01:31:13','2020-11-26 01:31:13'),(277,8,'01142d58e8979f9b18a7551541a1b38c277','2020-12-11 07:12:09',NULL,'2020-11-26 01:34:09','2020-11-26 01:34:09'),(278,6,'dbd3b4c4869354ecb514e1bb3527a818278','2020-12-11 08:12:56',NULL,'2020-11-26 02:58:56','2020-11-26 02:58:56'),(279,1,'ce4baeaa9e61a1152597efb2aba68bc8279','2020-12-11 09:12:48',NULL,'2020-11-26 03:48:48','2020-11-26 03:48:48'),(280,6,'9b2a0d76870e5c040b8a8a3ae605cd38280','2020-12-11 09:12:48',NULL,'2020-11-26 03:49:48','2020-11-26 03:49:48'),(281,2,'45da241996936701811862ccdc4314a7281','2020-12-11 10:12:18',NULL,'2020-11-26 05:15:18','2020-11-26 05:15:18'),(282,1,'5f6c06782b22a7dd9d983c69985a916d282','2020-12-11 10:12:04',NULL,'2020-11-26 05:16:04','2020-11-26 05:16:04'),(283,2,'f01cc1d954699dbea8d56be09b4812f0283','2020-12-11 10:12:49',NULL,'2020-11-26 05:16:49','2020-11-26 05:16:49'),(284,1,'6b49758c3d04e61414392a83b94e7660284','2020-12-11 11:12:49',NULL,'2020-11-26 05:41:49','2020-11-26 05:41:49'),(285,4,'b47085d12b6f74f30ca22b82eeb09af8285','2020-12-12 04:12:40',NULL,'2020-11-26 22:54:40','2020-11-26 22:54:40'),(286,2,'0fbc9547565f7da7d2d03f0b75319922286','2020-12-12 04:12:36',NULL,'2020-11-26 22:55:36','2020-11-26 22:55:36'),(287,3,'f9feaf382e7c49726917e89eae6da0bb287','2020-12-12 04:12:49',NULL,'2020-11-26 23:05:49','2020-11-26 23:05:49'),(288,4,'54325761dbb39af9152bf6625ada89b0288','2020-12-12 04:12:53',NULL,'2020-11-26 23:06:53','2020-11-26 23:06:53'),(289,5,'f979bff8b981955de02fd1405ac0a2da289','2020-12-12 04:12:51',NULL,'2020-11-26 23:07:51','2020-11-26 23:07:51'),(290,6,'25e6946e85c79bc929338e5fc098577a290','2020-12-12 05:12:10',NULL,'2020-11-27 00:14:10','2020-11-27 00:14:10'),(291,9,'dc813e7b63a622dcc9bc30aac716dd6c291','2020-12-12 05:12:21',NULL,'2020-11-27 00:18:21','2020-11-27 00:18:21'),(292,2,'2032e5e54a1b0e3d4f55d025a96ebe96292','2020-12-12 06:12:24',NULL,'2020-11-27 01:15:24','2020-11-27 01:15:24'),(293,2,'9144135f70d04ced9ea7f9b144b1817a293','2020-12-12 08:12:13',NULL,'2020-11-27 02:33:13','2020-11-27 02:33:13'),(294,2,'8d99135a190216000a6cde3fdf9e80b7294','2020-12-12 11:12:05',NULL,'2020-11-27 06:16:05','2020-11-27 06:16:06'),(295,2,'95ef15dca0331fbf2c479cc6c6bf5040295','2020-12-15 04:12:23',NULL,'2020-11-29 23:13:23','2020-11-29 23:13:23'),(296,2,'87b34dac7432feba310056af172daf66296','2020-12-15 05:12:10',NULL,'2020-11-29 23:58:10','2020-11-29 23:58:10'),(297,2,'74f1e89e8cc2b615b6266847bfe94e91297','2020-12-15 10:12:05',NULL,'2020-11-30 04:34:05','2020-11-30 04:34:05'),(298,1,'1ba8422be4f89cf2d7c4e311909bef3f298','2020-12-15 11:12:31',NULL,'2020-11-30 05:40:31','2020-11-30 05:40:31'),(299,1,'268d83f267d15d28e355c45f0e0f014e299','2020-12-16 04:12:09',NULL,'2020-11-30 23:24:09','2020-11-30 23:24:09'),(300,6,'471a5b28d1bcadac0579a294cc7b6fa9300','2020-12-17 04:12:05',NULL,'2020-12-01 23:15:05','2020-12-01 23:15:05'),(301,1,'c51dc54c7c37dd853fe2606d427b5c6a301','2020-12-17 04:12:41',NULL,'2020-12-01 23:23:41','2020-12-01 23:23:41'),(302,2,'490b44a939c63f282c49e639e4007e70302','2020-12-17 04:12:50',NULL,'2020-12-01 23:24:50','2020-12-01 23:24:50'),(303,2,'4349bc1479382341b3e21bfab687e815303','2020-12-17 05:12:24',NULL,'2020-12-02 00:05:24','2020-12-02 00:05:24'),(304,1,'2f9ad61d979774d08a5d1aff79f18a97304','2020-12-17 06:12:54',NULL,'2020-12-02 01:00:54','2020-12-02 01:00:54'),(305,2,'8c457c58908ac4bdaca91f14827ade97305','2020-12-17 06:12:08',NULL,'2020-12-02 01:02:08','2020-12-02 01:02:08'),(306,1,'e49ce8129dbcaaf1ad74004ba1f80d4d306','2020-12-17 08:12:31',NULL,'2020-12-02 03:29:31','2020-12-02 03:29:31'),(307,9,'c26092b24910c0627aab14cc785dd2a6307','2020-12-17 09:12:08',NULL,'2020-12-02 03:41:08','2020-12-02 03:41:08'),(308,1,'222e8b14feab021caad1bf5691ba75b7308','2020-12-17 09:12:14',NULL,'2020-12-02 03:54:14','2020-12-02 03:54:14'),(309,9,'ffd67205f90b10d76e4859603a7d8a5b309','2020-12-17 09:12:26',NULL,'2020-12-02 03:55:26','2020-12-02 03:55:26'),(310,2,'b77a9e350ac8f3e8b6f5cb93169991ce310','2020-12-17 10:12:07',NULL,'2020-12-02 04:43:07','2020-12-02 04:43:07'),(311,1,'030c45e16bd48356c784bc0ae18eb636311','2020-12-17 10:12:33',NULL,'2020-12-02 04:45:33','2020-12-02 04:45:33'),(312,2,'76f93557307d493499a5d8dfdf150920312','2020-12-17 10:12:26',NULL,'2020-12-02 04:46:26','2020-12-02 04:46:26'),(313,2,'b2adefe3d7b828b85c004317ed0d3430313','2020-12-19 04:12:33',NULL,'2020-12-03 23:09:33','2020-12-03 23:09:33'),(314,1,'6ce06d1ea6a2ab073879dcb68ef85eba314','2020-12-19 05:12:50',NULL,'2020-12-04 00:25:50','2020-12-04 00:25:50'),(315,2,'7ff4c1140cd8fbe0b108fc3dbc4fbaf9315','2020-12-19 05:12:44',NULL,'2020-12-04 00:26:44','2020-12-04 00:26:44'),(316,2,'8c4eaea0c84e5db13f79f6cf66059b8c316','2020-12-19 06:12:25',NULL,'2020-12-04 01:00:25','2020-12-04 01:00:25'),(317,2,'44886f6d08a030483e4148ea9eb4e3ad317','2020-12-19 08:12:20',NULL,'2020-12-04 03:03:20','2020-12-04 03:03:20'),(318,1,'88a0c2783c600ced32048f82a15947c5318','2020-12-19 09:12:13',NULL,'2020-12-04 03:54:13','2020-12-04 03:54:13'),(319,2,'70ca0b569675cd9dab763b8d4f24493a319','2020-12-22 05:12:22',NULL,'2020-12-07 00:05:22','2020-12-07 00:05:22'),(320,2,'b0a18ec31d220344226cd4c457b81bce320','2020-12-23 04:12:53',NULL,'2020-12-07 22:58:53','2020-12-07 22:58:53'),(321,2,'be3b2881d8ab01a77b71ebd69b6b1c5b321','2020-12-23 07:12:20',NULL,'2020-12-08 01:53:20','2020-12-08 01:53:20'),(322,2,'fdabb8120a658b48668b5f473d44346e322','2020-12-23 10:12:22',NULL,'2020-12-08 05:12:22','2020-12-08 05:12:22'),(323,1,'a2e5bf73475ea225b746f8f057422fed323','2020-12-23 10:12:53',NULL,'2020-12-08 05:27:53','2020-12-08 05:27:53'),(324,2,'6c8b910dd5765b3d6e4e5d377dfd5cab324','2020-12-23 11:12:03',NULL,'2020-12-08 05:57:03','2020-12-08 05:57:03'),(325,2,'f6396817f5a36160c240d16b4a8b8430325','2020-12-24 05:12:38',NULL,'2020-12-08 23:38:38','2020-12-08 23:38:38'),(326,2,'2e90236528324ec4cc2718f9fddc4640326','2020-12-24 09:12:52',NULL,'2020-12-09 03:44:52','2020-12-09 03:44:52'),(327,2,'d4847cd5d48a286484e19b0ccbc43576327','2020-12-24 10:12:53',NULL,'2020-12-09 05:20:53','2020-12-09 05:20:53'),(328,2,'8a58eb0854c767db4409343b51aa9a6d328','2020-12-25 04:12:00',NULL,'2020-12-09 23:15:00','2020-12-09 23:15:01'),(329,10,'515984ead3829fe55221e1d1fc96cd0f329','2020-12-25 09:12:29',NULL,'2020-12-10 03:41:29','2020-12-10 03:41:29'),(330,1,'e155a015100bf29c11fe448663d63731330','2020-12-25 09:12:09',NULL,'2020-12-10 03:42:09','2020-12-10 03:42:09'),(331,10,'76bc9348e46f056e9d51d3a575f48436331','2020-12-25 09:12:55',NULL,'2020-12-10 03:43:55','2020-12-10 03:43:55'),(332,2,'b1ecf4820641a1701bd289385b4b728a332','2020-12-25 09:12:01',NULL,'2020-12-10 04:17:01','2020-12-10 04:17:01'),(333,2,'f04e2bb3b004a3039c5320595d7fb32b333','2020-12-25 10:12:21',NULL,'2020-12-10 04:42:21','2020-12-10 04:42:21'),(334,1,'0b55e0050c30643d17cf9e2a8c9abf68334','2020-12-25 10:12:58',NULL,'2020-12-10 04:58:58','2020-12-10 04:58:58'),(335,1,'2f698afbe11d065c41f025ff8359921d335','2020-12-25 10:12:20',NULL,'2020-12-10 05:01:20','2020-12-10 05:01:20'),(336,2,'8aa89a3a0817e13bf4d85113ab5d4ffd336','2020-12-25 10:12:39',NULL,'2020-12-10 05:01:39','2020-12-10 05:01:39'),(337,2,'303cdf5341d46265ca4c6088a9e01004337','2020-12-25 11:12:07',NULL,'2020-12-10 05:35:07','2020-12-10 05:35:07'),(338,2,'b84eedc781951b7bd1191fd208a35ac3338','2020-12-26 04:12:24',NULL,'2020-12-10 22:58:24','2020-12-10 22:58:25'),(339,1,'e97f2fd6527e843122403770f5312143339','2020-12-26 06:12:42',NULL,'2020-12-11 00:50:42','2020-12-11 00:50:43'),(340,2,'8e98eafc6fcb5dfc12da6ba6d6e52fd0340','2020-12-26 08:12:33',NULL,'2020-12-11 03:19:33','2020-12-11 03:19:33'),(341,9,'538d99ec9257ea97b968771d3eea0585341','2020-12-26 09:12:25',NULL,'2020-12-11 03:31:25','2020-12-11 03:31:25'),(342,8,'27f392ff65666b6a0ea7e056b1c4641a342','2020-12-26 09:12:24',NULL,'2020-12-11 03:32:24','2020-12-11 03:32:24'),(343,2,'d620a5404513b753d6ffe97c3a308f56343','2020-12-26 09:12:11',NULL,'2020-12-11 04:16:11','2020-12-11 04:16:11'),(344,3,'fae503328094c8008741addd238aa32d344','2020-12-26 10:12:12',NULL,'2020-12-11 04:58:12','2020-12-11 04:58:13'),(345,4,'40a208016ddd6792d482f1fc4cfe2cfc345','2020-12-26 10:12:17',NULL,'2020-12-11 04:59:17','2020-12-11 04:59:17'),(346,5,'b8f62b3c104039c833db97fde984b66f346','2020-12-26 10:12:56',NULL,'2020-12-11 04:59:56','2020-12-11 04:59:56'),(347,1,'be2d48bdbc247f9c4f5888f081d21088347','2020-12-26 10:12:39',NULL,'2020-12-11 05:00:39','2020-12-11 05:00:39'),(348,5,'51cd470c42370e949365d031ea030e55348','2020-12-26 10:12:36',NULL,'2020-12-11 05:01:36','2020-12-11 05:01:36'),(349,6,'6db301fb1a16a534e2150d76ab41b556349','2020-12-26 10:12:40',NULL,'2020-12-11 05:02:40','2020-12-11 05:02:40'),(350,8,'b8eab0cd28ec506f9defb82f55186e84350','2020-12-26 10:12:42',NULL,'2020-12-11 05:03:42','2020-12-11 05:03:42'),(351,9,'137ee6cbea915b24c778d43211a02c67351','2020-12-26 10:12:27',NULL,'2020-12-11 05:04:27','2020-12-11 05:04:27'),(352,1,'b8408325b31927fd8d706cf58c0e7659352','2020-12-26 10:12:07',NULL,'2020-12-11 05:08:07','2020-12-11 05:08:07'),(353,9,'0ff933746c3f3c50d791fe2d98848def353','2020-12-26 10:12:19',NULL,'2020-12-11 05:09:19','2020-12-11 05:09:20'),(354,1,'8cf4fc5b265e5e0170e8da57c2b94f31354','2020-12-26 10:12:29',NULL,'2020-12-11 05:12:29','2020-12-11 05:12:29'),(355,9,'7f957c690d2f88cdb5cfb9997a99b291355','2020-12-26 10:12:30',NULL,'2020-12-11 05:13:30','2020-12-11 05:13:30'),(356,8,'3fee7b26f85418912241b44e37480f29356','2020-12-26 10:12:05',NULL,'2020-12-11 05:21:05','2020-12-11 05:21:05'),(357,2,'625663fa47f5d582ff3206f4b663189e357','2020-12-26 11:12:20',NULL,'2020-12-11 05:54:20','2020-12-11 05:54:20'),(358,8,'19b4ea52509f40bcf8ff1faa4e486667358','2020-12-26 11:12:47',NULL,'2020-12-11 05:54:47','2020-12-11 05:54:47'),(359,6,'6dfccf41159bacc65df5de0942ce7562359','2020-12-26 11:12:54',NULL,'2020-12-11 05:55:54','2020-12-11 05:55:54'),(360,1,'4eb802a7643155d66e6424d93c000a0b360','2020-12-26 11:12:20',NULL,'2020-12-11 05:56:20','2020-12-11 05:56:20'),(361,6,'25657d5c11dcdbd2e4f2311d83698699361','2020-12-26 11:12:27',NULL,'2020-12-11 05:57:27','2020-12-11 05:57:27'),(362,2,'9ea2b704e58965abcf420bec4a0c7ec6362','2020-12-26 11:12:47',NULL,'2020-12-11 05:58:47','2020-12-11 05:58:47'),(363,6,'be2722fb6de219bd581708d63050dcdf363','2020-12-26 11:12:54',NULL,'2020-12-11 06:12:54','2020-12-11 06:12:54'),(364,8,'7e7d566173d265151ca016f63c5eebd1364','2020-12-26 11:12:56',NULL,'2020-12-11 06:14:56','2020-12-11 06:14:56'),(365,2,'79dc7cf5a2e39eb61f6b35f25991358f365','2020-12-29 04:12:19',NULL,'2020-12-13 23:17:19','2020-12-13 23:17:19'),(366,3,'ec4974b8e72bcf50e5452b7edd3d832b366','2020-12-29 04:12:59',NULL,'2020-12-13 23:27:59','2020-12-13 23:27:59'),(367,4,'f99ed40813d331012565dac102c35986367','2020-12-29 04:12:35',NULL,'2020-12-13 23:29:35','2020-12-13 23:29:35'),(368,5,'18a6052acaa2fa4bf30d414c8da8370e368','2020-12-29 05:12:49',NULL,'2020-12-13 23:30:49','2020-12-13 23:30:49'),(369,6,'d8601230fa904bdb7993dfa9c31620da369','2020-12-29 05:12:17',NULL,'2020-12-13 23:37:17','2020-12-13 23:37:17'),(370,8,'02b0d2daee7b5afedc43d4999d870252370','2020-12-29 05:12:55',NULL,'2020-12-13 23:38:55','2020-12-13 23:38:56'),(371,9,'709fbfd44aa44cff8f9bdfa7efff9d23371','2020-12-29 05:12:27',NULL,'2020-12-13 23:40:27','2020-12-13 23:40:27'),(372,8,'26be36e21a92db68d6d3fc4863d2290c372','2020-12-29 05:12:48',NULL,'2020-12-13 23:43:48','2020-12-13 23:43:48'),(373,6,'959a73c411f2d84a8c2672fa04ce1e6f373','2020-12-29 05:12:59',NULL,'2020-12-13 23:45:59','2020-12-13 23:45:59'),(374,2,'be7ca201ef1c49ed59a4a81ad392eec7374','2020-12-29 05:12:26',NULL,'2020-12-13 23:50:26','2020-12-13 23:50:26'),(375,9,'85597ea90358ebcd2c61a9f25bb84d03375','2020-12-29 09:12:21',NULL,'2020-12-14 03:56:21','2020-12-14 03:56:21'),(376,1,'ec2ac6b1e0f580a7709cbbead641d959376','2020-12-30 04:12:16',NULL,'2020-12-14 23:05:16','2020-12-14 23:05:17'),(377,1,'f6b241d264e2cd8801339c6e3578aab7377','2020-12-30 05:12:36',NULL,'2020-12-15 00:25:36','2020-12-15 00:25:36'),(378,10,'898b28e5359dd1298fa9af3c7fe40d6a378','2020-12-30 07:12:08',NULL,'2020-12-15 01:53:08','2020-12-15 01:53:08'),(379,1,'3aab113c6e5a4f7f1926ca6defcf64e4379','2020-12-30 10:12:06',NULL,'2020-12-15 05:16:06','2020-12-15 05:16:06'),(380,1,'4989c6f3823974af39bc7f04fc94d46a380','2020-12-31 04:12:55',NULL,'2020-12-15 22:50:55','2020-12-15 22:50:55'),(381,1,'acab5c8b2e16ae39087dd13b69b12196381','2020-12-31 05:12:31',NULL,'2020-12-15 23:33:31','2020-12-15 23:33:31'),(382,1,'ea17ffd9a3289f4d8d65a5bdb3ab3b1a382','2020-12-31 07:12:24',NULL,'2020-12-16 01:40:24','2020-12-16 01:40:25'),(383,2,'40c14919d62ac812cc5cb448ab69e5de383','2020-12-31 07:12:14',NULL,'2020-12-16 01:42:14','2020-12-16 01:42:14'),(384,3,'f0adc8c2601911bda22f6978d6c76c0c384','2020-12-31 07:12:34',NULL,'2020-12-16 01:51:34','2020-12-16 01:51:34'),(385,4,'1f011f4f3e32afcefa926be97360a154385','2020-12-31 07:12:57',NULL,'2020-12-16 01:52:57','2020-12-16 01:52:57'),(386,5,'1012ffeb77456766c45a030a0929d3c0386','2020-12-31 07:12:21',NULL,'2020-12-16 01:56:21','2020-12-16 01:56:21'),(387,5,'9527e9b724884c41029fe9744b5e1977387','2020-12-31 07:12:35',NULL,'2020-12-16 01:57:35','2020-12-16 01:57:35'),(388,6,'2f50a1139faf021cfbb47b96b39311ff388','2020-12-31 07:12:20',NULL,'2020-12-16 01:59:20','2020-12-16 01:59:20'),(389,6,'a65c6a005aaf2fc7410ccada428b7005389','2020-12-31 07:12:35',NULL,'2020-12-16 02:24:35','2020-12-16 02:24:35'),(390,6,'1f6170bb5adf9b984ee76b72a7432eb9390','2020-12-31 07:12:02',NULL,'2020-12-16 02:25:02','2020-12-16 02:25:02'),(391,8,'a2240a883c5c39924698080f1f03ec1d391','2020-12-31 07:12:36',NULL,'2020-12-16 02:26:36','2020-12-16 02:26:36'),(392,8,'2f3fbc3b8ec8c810994cb2f746aa86f5392','2020-12-31 07:12:47',NULL,'2020-12-16 02:27:47','2020-12-16 02:27:47'),(393,8,'c03136ee9d68df796ae6db5d5d57805f393','2020-12-31 07:12:58',NULL,'2020-12-16 02:28:58','2020-12-16 02:28:58'),(394,9,'6869c6270f780b0649a9c206b1fbcf40394','2020-12-31 08:12:00',NULL,'2020-12-16 02:30:00','2020-12-16 02:30:00'),(395,9,'d4103784e69c328a9afb211ff2769e21395','2020-12-31 08:12:05',NULL,'2020-12-16 02:31:05','2020-12-16 02:31:05'),(396,9,'a9e4d1b02f75a2faa2efe09e0f028882396','2020-12-31 08:12:12',NULL,'2020-12-16 02:33:12','2020-12-16 02:33:12'),(397,9,'177a43c686b4874b93a6ab4012ab08eb397','2020-12-31 08:12:27',NULL,'2020-12-16 02:47:27','2020-12-16 02:47:27'),(398,8,'904535b501f358489d9641fbe8f42aad398','2020-12-31 08:12:03',NULL,'2020-12-16 02:58:03','2020-12-16 02:58:03'),(399,8,'79e56aca31f177a25495368595bb36bb399','2020-12-31 08:12:17',NULL,'2020-12-16 02:59:17','2020-12-16 02:59:17'),(400,8,'22520497aba6b0fc061dc77d3c9af543400','2020-12-31 08:12:55',NULL,'2020-12-16 02:59:55','2020-12-16 02:59:55'),(401,8,'a93fe814f7602a93adb51614497d1adb401','2020-12-31 08:12:58',NULL,'2020-12-16 03:00:58','2020-12-16 03:00:58'),(402,8,'4ccb407b15a2109d01f2b81e028c182d402','2020-12-31 08:12:17',NULL,'2020-12-16 03:02:17','2020-12-16 03:02:17'),(403,8,'83ebc5def0c903659e8523959b671e0d403','2020-12-31 08:12:06',NULL,'2020-12-16 03:03:06','2020-12-16 03:03:06'),(404,2,'5e697b4a14e1c4ad668b9ded777d5ab0404','2020-12-31 08:12:19',NULL,'2020-12-16 03:05:19','2020-12-16 03:05:19'),(405,2,'88cb4e7ba9dfa8da275735019bc77147405','2020-12-31 08:12:28',NULL,'2020-12-16 03:06:28','2020-12-16 03:06:28'),(406,2,'642cc4778f7ee3f36305fa11bb65eff2406','2020-12-31 08:12:40',NULL,'2020-12-16 03:06:40','2020-12-16 03:06:40'),(407,6,'06730e36e7a7776721578b032e3ffc4c407','2020-12-31 08:12:32',NULL,'2020-12-16 03:12:32','2020-12-16 03:12:32'),(408,2,'9a04023a106009038fa58f499b003057408','2020-12-31 08:12:28',NULL,'2020-12-16 03:13:28','2020-12-16 03:13:28'),(409,2,'9b8ceb41a84988b602e5391efc51bc55409','2020-12-31 08:12:44',NULL,'2020-12-16 03:13:44','2020-12-16 03:13:44'),(410,9,'e6fcca696623a2dee45fca61ae93998d410','2020-12-31 09:12:40',NULL,'2020-12-16 03:54:40','2020-12-16 03:54:40'),(411,1,'02d94724c71cda1a6bc308b21f5a6b86411','2020-12-31 10:12:10',NULL,'2020-12-16 04:35:10','2020-12-16 04:35:10'),(412,1,'0342e19ec2861b9de676b79b307dd942412','2020-12-31 10:12:00',NULL,'2020-12-16 05:03:00','2020-12-16 05:03:00'),(413,10,'5987a5898de0f985966644ebe00a56da413','2021-01-01 05:01:31',NULL,'2020-12-16 23:41:31','2020-12-16 23:41:31'),(414,1,'8be7260c89d70e2ec815490cc094bfad414','2021-01-02 05:01:25',NULL,'2020-12-17 23:41:25','2020-12-17 23:41:25'),(415,10,'24ab2c8dfbc3060d8e9b433619f4aa88415','2021-01-02 05:01:49',NULL,'2020-12-17 23:42:49','2020-12-17 23:42:49'),(416,2,'46edd17c6bc3050d1356b2b2eda02333416','2021-01-02 09:01:49',NULL,'2020-12-18 03:34:49','2020-12-18 03:34:49'),(417,1,'cd4cb70e49a1fb763b6e7be789371496417','2021-01-02 14:01:01',NULL,'2020-12-18 08:47:01','2020-12-18 08:47:02'),(418,10,'c145a0cd549037729aff2bf19876c019418','2021-01-05 05:01:06',NULL,'2020-12-21 00:10:06','2020-12-21 00:10:06'),(419,1,'d240cfa32390cb1319b9f5ae3a38fcc1419','2021-01-05 06:01:21',NULL,'2020-12-21 00:43:21','2020-12-21 00:43:21'),(420,10,'39ea7635e7665085bae43e560eb73912420','2021-01-05 06:01:05',NULL,'2020-12-21 00:47:05','2020-12-21 00:47:05'),(421,1,'ed46f5eb6762d0ed88a1bc40c8318d8e421','2021-01-05 06:01:24',NULL,'2020-12-21 00:52:24','2020-12-21 00:52:24'),(422,10,'c6a15b419a9870503e50b386aa4ffb5c422','2021-01-05 06:01:52',NULL,'2020-12-21 00:53:52','2020-12-21 00:53:52'),(423,10,'1917cf02c9c4f284f5b73cbc9cc8e8a8423','2021-01-05 08:01:13',NULL,'2020-12-21 03:22:13','2020-12-21 03:22:13'),(424,2,'98be82b2ff818de596399b1c2bef9ae9424','2021-01-06 05:01:54',NULL,'2020-12-21 23:58:54','2020-12-21 23:58:54'),(425,6,'8d4fb2f1a4b217ce2efd50d776f8859b425','2021-01-06 06:01:41',NULL,'2020-12-22 00:57:41','2020-12-22 00:57:41'),(426,4,'c582adfc9528772987962dac48a2099e426','2021-01-06 07:01:37',NULL,'2020-12-22 01:48:37','2020-12-22 01:48:37'),(427,6,'a984fcee63f32c81bb2e93e2607229a2427','2021-01-06 07:01:09',NULL,'2020-12-22 02:03:09','2020-12-22 02:03:09'),(428,2,'a4753849b3159d0823f151d1bd3d9565428','2021-01-06 09:01:48',NULL,'2020-12-22 03:43:48','2020-12-22 03:43:48'),(429,5,'2f810c6cf93fedcbc0bfa631ccd2d23c429','2021-01-06 09:01:41',NULL,'2020-12-22 03:52:41','2020-12-22 03:52:41'),(430,9,'dbe819f62299aa19ded8b3f9a6d36d5f430','2021-01-06 10:01:24',NULL,'2020-12-22 04:36:24','2020-12-22 04:36:24'),(431,2,'31a08a9f756d804fa4ec4dc36ec9dc6f431','2021-01-06 10:01:03',NULL,'2020-12-22 04:40:03','2020-12-22 04:40:03'),(432,3,'1d230600952ada9b8de54e33469ad0dc432','2021-01-06 10:01:21',NULL,'2020-12-22 04:49:21','2020-12-22 04:49:21'),(433,1,'cd9331de37dcc9df88fa0e59f86298b8433','2021-01-06 10:01:16',NULL,'2020-12-22 04:51:16','2020-12-22 04:51:16'),(434,3,'c7e4f39ca8144324da6cc5eb3d17cc15434','2021-01-06 10:01:03',NULL,'2020-12-22 04:54:03','2020-12-22 04:54:03'),(435,2,'008ccdde2254ec5d57955ce3f9a2e0f6435','2021-01-06 10:01:23',NULL,'2020-12-22 04:54:23','2020-12-22 04:54:23'),(436,3,'7578d22e74ed5a2da251ccb41e5cf6bd436','2021-01-06 10:01:45',NULL,'2020-12-22 04:55:45','2020-12-22 04:55:45'),(437,3,'d2ea104eec329cea273fd820bde3791d437','2021-01-06 10:01:12',NULL,'2020-12-22 05:07:12','2020-12-22 05:07:12'),(438,4,'37fca3496acb9554563c938375491861438','2021-01-06 11:01:13',NULL,'2020-12-22 05:42:13','2020-12-22 05:42:13'),(439,5,'4627e9d1ed710130aacfef291712fb51439','2021-01-06 11:01:04',NULL,'2020-12-22 05:43:04','2020-12-22 05:43:04'),(440,6,'c95f1f83de21402e3326f98f286f3af7440','2021-01-06 11:01:31',NULL,'2020-12-22 05:44:31','2020-12-22 05:44:31'),(441,6,'1a6315e0667b82fcfbc3ac27db6e608c441','2021-01-06 11:01:49',NULL,'2020-12-22 06:09:49','2020-12-22 06:09:49'),(442,8,'fc3122407bd75edd93700f260aeaec8b442','2021-01-06 11:01:34',NULL,'2020-12-22 06:11:34','2020-12-22 06:11:34'),(443,9,'1943ae5c4cb8b9ceaa9e5a41286a50c2443','2021-01-06 12:01:05',NULL,'2020-12-22 06:31:05','2020-12-22 06:31:05'),(444,10,'39369b0fbe804c4960d36fb3ad8b47f9444','2021-01-07 04:01:07',NULL,'2020-12-22 23:26:07','2020-12-22 23:26:07'),(445,10,'c35e7acbfa50be9a6d1b11b23da82724445','2021-01-07 05:01:09',NULL,'2020-12-22 23:49:09','2020-12-22 23:49:09'),(446,10,'45d80184be7232bd8300019b2b6116ae446','2021-01-07 08:01:54',NULL,'2020-12-23 03:07:54','2020-12-23 03:07:54'),(447,10,'e78d195b446649ba268961c3cd16377d447','2021-01-07 11:01:14',NULL,'2020-12-23 05:46:14','2020-12-23 05:46:14'),(448,2,'e51d124bd2c49bf351db420f13f45bf6448','2021-01-07 11:01:11',NULL,'2020-12-23 06:27:11','2020-12-23 06:27:11'),(449,6,'2bf235e835745f0f203ee741ff4192c8449','2021-01-07 11:01:30',NULL,'2020-12-23 06:29:30','2020-12-23 06:29:30'),(450,2,'d87800f52c5f80bdcb5bacdc5d06c70b450','2021-01-07 12:01:18',NULL,'2020-12-23 06:30:18','2020-12-23 06:30:18'),(451,2,'9f4e197f80e93d78c8fb83bd3552ad28451','2021-01-08 05:01:22',NULL,'2020-12-23 23:42:22','2020-12-23 23:42:22'),(452,2,'4af47f9a7bfcbca44d280eba93ce52fa452','2021-01-08 08:01:57',NULL,'2020-12-24 03:08:57','2020-12-24 03:08:57'),(453,1,'47ae608f4e9804368419a9f834d418b5453','2021-01-08 08:01:47',NULL,'2020-12-24 03:09:47','2020-12-24 03:09:47'),(454,2,'7f50e06c60a8a18226acd2851d9df532454','2021-01-08 08:01:35',NULL,'2020-12-24 03:10:35','2020-12-24 03:10:36'),(455,1,'0a283c33b617b1444065e9f342c030f8455','2021-01-12 09:01:20',NULL,'2020-12-28 03:58:20','2020-12-28 03:58:20'),(456,2,'7969a11925952337a09394c3d5142036456','2021-01-12 09:01:33',NULL,'2020-12-28 04:27:33','2020-12-28 04:27:33'),(457,10,'ed36b241dbc8d04a48b8c072b7081e04457','2021-01-12 12:01:13',NULL,'2020-12-28 06:39:13','2020-12-28 06:39:13'),(458,1,'8774c3fe29d2438d457e79fa87e3e029458','2021-01-19 04:01:08',NULL,'2021-01-03 22:38:08','2021-01-03 22:38:08'),(459,2,'ace508e0a7fa9854da8e138e02f5c42f459','2021-01-19 04:01:24',NULL,'2021-01-03 23:13:24','2021-01-03 23:13:24'),(460,2,'91349793880d17277a4d5b8485c7973e460','2021-01-19 08:01:33',NULL,'2021-01-04 03:28:33','2021-01-04 03:28:33'),(461,5,'e0287a50b44c307826ff4846f137b09e461','2021-01-19 09:01:13',NULL,'2021-01-04 03:49:13','2021-01-04 03:49:13'),(462,2,'c002176d40d1afb41627595cfcb9faa4462','2021-01-19 09:01:49',NULL,'2021-01-04 03:51:49','2021-01-04 03:51:49'),(463,5,'78fc752436039c7d52b892ed197daebf463','2021-01-19 09:01:19',NULL,'2021-01-04 03:54:19','2021-01-04 03:54:19'),(464,2,'fd2cf8852c53193884db8b29fdae2a8b464','2021-01-19 10:01:15',NULL,'2021-01-04 04:36:15','2021-01-04 04:36:15'),(465,3,'c46afe1910b7571d779c893d7c83b95f465','2021-01-19 10:01:29',NULL,'2021-01-04 04:42:29','2021-01-04 04:42:29'),(466,2,'04bbd82d6b32f68b5f83a51a2ae5b726466','2021-01-19 10:01:39',NULL,'2021-01-04 04:43:39','2021-01-04 04:43:39'),(467,1,'8b22d113de0f8d8b20054a0005972be7467','2021-01-19 10:01:59',NULL,'2021-01-04 04:43:59','2021-01-04 04:43:59'),(468,3,'8319fe70af221fe3acb1300f856ae5f5468','2021-01-19 10:01:47',NULL,'2021-01-04 04:44:47','2021-01-04 04:44:47'),(469,4,'550f7ce459d18d43aa2ff551f6223162469','2021-01-19 10:01:07',NULL,'2021-01-04 04:52:07','2021-01-04 04:52:07'),(470,5,'25f2eea9d9fe730d4468a3411f269f2a470','2021-01-19 10:01:05',NULL,'2021-01-04 04:54:05','2021-01-04 04:54:05'),(471,6,'c103e6fa43e41c6a6d6cf268faf55426471','2021-01-19 10:01:34',NULL,'2021-01-04 04:56:34','2021-01-04 04:56:34'),(472,8,'d80be9996ab528af682e3fc5794157d3472','2021-01-19 10:01:45',NULL,'2021-01-04 05:09:45','2021-01-04 05:09:45'),(473,9,'b626cc09bc1e636c159caa2dfcbcfb60473','2021-01-19 10:01:07',NULL,'2021-01-04 05:14:07','2021-01-04 05:14:07'),(474,9,'8caef2408bb48afee8796d130f9b73b6474','2021-01-19 10:01:57',NULL,'2021-01-04 05:15:57','2021-01-04 05:15:57'),(475,8,'baf120c138fcb46d52642b6518141e45475','2021-01-19 10:01:07',NULL,'2021-01-04 05:28:07','2021-01-04 05:28:07'),(476,9,'00c0066970fa9f1e9cac4a3aeef7de04476','2021-01-19 11:01:50',NULL,'2021-01-04 05:45:50','2021-01-04 05:45:50'),(477,8,'4be067bd710692d44572de930145674c477','2021-01-19 12:01:14',NULL,'2021-01-04 06:59:14','2021-01-04 06:59:14'),(478,1,'0faf04a0d23a900cf010bab9e2c71ee6478','2021-01-19 12:01:08',NULL,'2021-01-04 07:00:08','2021-01-04 07:00:08'),(479,2,'fa33ec634f42285f880eee62241d06e2479','2021-01-20 05:01:07',NULL,'2021-01-04 23:49:07','2021-01-04 23:49:07'),(480,1,'e0cfeef3fc03577fb89064629edde11f480','2021-01-20 05:01:56',NULL,'2021-01-04 23:50:56','2021-01-04 23:50:56'),(481,9,'c22885bd695eedba7e0c6f898763a0e1481','2021-01-20 05:01:19',NULL,'2021-01-05 00:04:19','2021-01-05 00:04:19'),(482,2,'ef0368f05e7a8fafa635c57cfb02904f482','2021-01-20 05:01:05',NULL,'2021-01-05 00:05:05','2021-01-05 00:05:05'),(483,2,'7d868dc452af7054c74c5ee6804c0dfe483','2021-01-20 08:01:39',NULL,'2021-01-05 03:11:39','2021-01-05 03:11:39'),(484,1,'7e5ce72f27a975eeecf283b4fd64849e484','2021-01-20 08:01:59',NULL,'2021-01-05 03:15:59','2021-01-05 03:15:59'),(485,2,'89f4db76db8544a9973eafd10a89625e485','2021-01-20 08:01:03',NULL,'2021-01-05 03:22:03','2021-01-05 03:22:03'),(486,1,'445a340653e0bc7c45a32723577d092c486','2021-01-20 08:01:58',NULL,'2021-01-05 03:27:58','2021-01-05 03:27:58'),(487,2,'e3ae7ecf23c10d89da2b71164bacf758487','2021-01-20 09:01:34',NULL,'2021-01-05 03:42:34','2021-01-05 03:42:34'),(488,6,'dbaced6fc8db9c3883c7c31f36e277a8488','2021-01-20 10:01:51',NULL,'2021-01-05 04:48:51','2021-01-05 04:48:51'),(489,6,'aec6d9363fad0dec67874764ddfaf548489','2021-01-20 10:01:47',NULL,'2021-01-05 05:17:47','2021-01-05 05:17:47'),(490,1,'aa849a88b169f5cfe31ccd9b342b3862490','2021-01-20 12:01:17',NULL,'2021-01-05 06:36:17','2021-01-05 06:36:17'),(491,1,'e450bcb8893d3c405e7813c427592ea6491','2021-01-20 12:01:59',NULL,'2021-01-05 06:55:59','2021-01-05 06:55:59'),(492,1,'e09cf60ba8cdec34e75611027cef10d6492','2021-01-20 12:01:04',NULL,'2021-01-05 06:58:04','2021-01-05 06:58:04'),(493,1,'acfdabd0edbbd497712611ef1bededa1493','2021-01-20 12:01:51',NULL,'2021-01-05 07:07:51','2021-01-05 07:07:52'),(494,1,'4e08be176c816b0ca5ff267fc6afe466494','2021-01-20 12:01:22',NULL,'2021-01-05 07:15:22','2021-01-05 07:15:22'),(495,1,'f0332488456033d1a0ddbb209b5b8494495','2021-01-21 03:01:13',NULL,'2021-01-05 22:27:13','2021-01-05 22:27:13'),(496,9,'755a93da45072dec20b88c519a95b271496','2021-01-21 04:01:48',NULL,'2021-01-05 23:06:48','2021-01-05 23:06:48'),(497,9,'e455e99e084ac4bfbba02f5b61cd7af0497','2021-01-21 04:01:24',NULL,'2021-01-05 23:09:24','2021-01-05 23:09:24'),(498,2,'ed68bc145df97139cde66daba17267ee498','2021-01-21 05:01:41',NULL,'2021-01-05 23:40:41','2021-01-05 23:40:41'),(499,2,'098052e2b4f75048508d72956d5d233d499','2021-01-21 07:01:05',NULL,'2021-01-06 02:29:05','2021-01-06 02:29:05'),(500,2,'764b2062b9f9df21af16e22fad69c585500','2021-01-21 09:01:42',NULL,'2021-01-06 03:52:42','2021-01-06 03:52:42'),(501,9,'540a2ff76397e8ab19011060edbfe092501','2021-01-21 10:01:33',NULL,'2021-01-06 05:15:33','2021-01-06 05:15:33'),(502,8,'0240bf084022478a3f2dc9824b2f8233502','2021-01-21 10:01:35',NULL,'2021-01-06 05:21:35','2021-01-06 05:21:35'),(503,6,'1ade6d0fab3f020f4d12d56300eb2d44503','2021-01-21 10:01:27',NULL,'2021-01-06 05:23:27','2021-01-06 05:23:27'),(504,1,'1b7cc603355b9bf3efbd248ebdd16419504','2021-01-21 11:01:27',NULL,'2021-01-06 05:31:27','2021-01-06 05:31:27'),(505,1,'2e5550cbba4b1a3d7c4910a39d386e8f505','2021-01-21 11:01:34',NULL,'2021-01-06 06:07:34','2021-01-06 06:07:34'),(506,1,'909ad3a4d91fbee7b8c230df780a7a01506','2021-01-21 11:01:35',NULL,'2021-01-06 06:07:35','2021-01-06 06:07:35'),(507,1,'9f9a6f14c6951555bbe3c9525c381aae507','2021-01-21 12:01:38',NULL,'2021-01-06 07:10:38','2021-01-06 07:10:38'),(508,2,'7392861586148c7029ac2934d4f42f2b508','2021-01-21 12:01:52',NULL,'2021-01-06 07:24:52','2021-01-06 07:24:52'),(509,1,'a388d80724b643cbc13a4976778a58c1509','2021-01-21 12:01:48',NULL,'2021-01-06 07:25:48','2021-01-06 07:25:48'),(510,2,'f2e051b4739024007241bb6caa1ca43d510','2021-01-21 12:01:34',NULL,'2021-01-06 07:27:34','2021-01-06 07:27:34'),(511,1,'7465533a32fa553239569b40164f5c01511','2021-01-22 04:01:41',NULL,'2021-01-06 22:48:41','2021-01-06 22:48:41'),(512,1,'acd8fa585af6ae927e69e87778aef6cc512','2021-01-22 04:01:59',NULL,'2021-01-06 22:50:59','2021-01-06 22:50:59'),(513,1,'af02a7a3779c80444ab6ca91c9b32a4e513','2021-01-22 04:01:06',NULL,'2021-01-06 22:52:06','2021-01-06 22:52:06'),(514,2,'23698b9c87ca44f31d6aa3ee1bd7066b514','2021-01-22 05:01:02',NULL,'2021-01-06 23:33:02','2021-01-06 23:33:02'),(515,1,'c1616f5761814389a3557b34dbb3af12515','2021-01-22 06:01:15',NULL,'2021-01-07 00:50:15','2021-01-07 00:50:15'),(516,1,'5724c9564953818df445b579426687e7516','2021-01-22 08:01:54',NULL,'2021-01-07 02:58:54','2021-01-07 02:58:54'),(517,10,'9857dc796342b6bdb23680e7627cdf08517','2021-01-22 12:01:02',NULL,'2021-01-07 07:29:02','2021-01-07 07:29:02'),(518,10,'b9308f0e7112a1748bbcef0370bb4144518','2021-01-23 05:01:43',NULL,'2021-01-07 23:37:43','2021-01-07 23:37:43'),(519,2,'b1518b16b40b05382ee2fff0227d2b39519','2021-01-23 05:01:21',NULL,'2021-01-07 23:38:21','2021-01-07 23:38:21'),(520,10,'e4d9eba8b80399f449ba63162afb4724520','2021-01-23 05:01:29',NULL,'2021-01-07 23:41:29','2021-01-07 23:41:29'),(521,1,'710f9a2968f70d75e8f568729a971db1521','2021-01-23 05:01:58',NULL,'2021-01-07 23:42:58','2021-01-07 23:42:59'),(522,10,'2ddb622cb76b75d16668f15c3cb76121522','2021-01-23 05:01:00',NULL,'2021-01-07 23:44:00','2021-01-07 23:44:00'),(523,10,'c40335e1995ac7db3bb35f1ec81c2e9b523','2021-01-23 05:01:51',NULL,'2021-01-07 23:44:51','2021-01-07 23:44:51'),(524,10,'067bee55e27882a1bc68c5dd46940467524','2021-01-23 05:01:38',NULL,'2021-01-07 23:49:38','2021-01-07 23:49:38'),(525,2,'f92fbd02a5f96775e4a11720f19d4d1a525','2021-01-23 05:01:09',NULL,'2021-01-07 23:50:09','2021-01-07 23:50:09'),(526,10,'83a594d1257129ac54dccaeb3c74dd1d526','2021-01-23 05:01:47',NULL,'2021-01-07 23:55:47','2021-01-07 23:55:47'),(527,10,'00818835b55cdfc3dbe2a96615997084527','2021-01-23 05:01:06',NULL,'2021-01-07 23:58:06','2021-01-07 23:58:06'),(528,1,'d7dfd7fadd51fb346052c158b7e9136f528','2021-01-23 06:01:39',NULL,'2021-01-08 01:06:39','2021-01-08 01:06:39'),(529,10,'380ec8a51adb4484803f2161167869e3529','2021-01-23 08:01:50',NULL,'2021-01-08 02:35:50','2021-01-08 02:35:50'),(530,10,'e5df08e8a5f47b1ed658d69c79868ddb530','2021-01-23 08:01:07',NULL,'2021-01-08 03:25:07','2021-01-08 03:25:07'),(531,10,'4353e32b98ddae55eef869864c0c8995531','2021-01-23 09:01:53',NULL,'2021-01-08 04:05:53','2021-01-08 04:05:54'),(532,10,'a8616b31bd907bd5829c7383ced93abd532','2021-01-23 09:01:05',NULL,'2021-01-08 04:06:05','2021-01-08 04:06:05'),(533,6,'ac581e3d7ced88f99c89c366873074b9533','2021-01-23 11:01:25',NULL,'2021-01-08 05:38:25','2021-01-08 05:38:25'),(534,8,'1b713808296325e6ea1d64055305b50e534','2021-01-23 11:01:26',NULL,'2021-01-08 05:40:27','2021-01-08 05:40:27'),(535,9,'d6c56c7e9d37ebed360e02bfae2e581b535','2021-01-23 11:01:14',NULL,'2021-01-08 05:44:14','2021-01-08 05:44:14'),(536,4,'8d986140df7b4ec153049df511f957bd536','2021-01-23 11:01:23',NULL,'2021-01-08 06:25:23','2021-01-08 06:25:23'),(537,8,'edde0e9d480d3971b3adfa8e6f6951c2537','2021-01-23 11:01:55',NULL,'2021-01-08 06:26:55','2021-01-08 06:26:55'),(538,4,'311c44a589892080a454f2b8118c9985538','2021-01-23 11:01:29',NULL,'2021-01-08 06:27:29','2021-01-08 06:27:29'),(539,2,'80b9cd53dcb70868c1f46a8e3cc99168539','2021-01-23 11:01:11',NULL,'2021-01-08 06:29:11','2021-01-08 06:29:11'),(540,4,'41f48716bdbe2a36b30646f7cbc77f1e540','2021-01-23 12:01:20',NULL,'2021-01-08 06:34:20','2021-01-08 06:34:20'),(541,3,'ca418c6e1f5b9567bb18c755d256548f541','2021-01-23 12:01:52',NULL,'2021-01-08 06:34:52','2021-01-08 06:34:52'),(542,4,'57e49fd3b475ead5f662ed46f470b456542','2021-01-23 12:01:51',NULL,'2021-01-08 06:36:51','2021-01-08 06:36:51'),(543,5,'e5554aaa73a4d4fdc55a449ab04c024f543','2021-01-23 12:01:14',NULL,'2021-01-08 06:39:14','2021-01-08 06:39:14'),(544,1,'d9e36ea70da9b44277a95a2cec7136a8544','2021-01-23 12:01:32',NULL,'2021-01-08 07:27:32','2021-01-08 07:27:32'),(545,2,'f3509fd10ae8548a3a60a34cf46f2801545','2021-01-26 09:01:44',NULL,'2021-01-11 03:57:44','2021-01-11 03:57:44'),(546,8,'b5aaf8ecb8aeabf8f2a58f4b1e2a25fa546','2021-01-26 10:01:31',NULL,'2021-01-11 04:50:31','2021-01-11 04:50:31'),(547,2,'3d1a6e149bb24031bc3b9118b8e08a41547','2021-01-26 10:01:25',NULL,'2021-01-11 05:28:25','2021-01-11 05:28:25'),(548,3,'6c0ca18b49e67359fd304e3fa2e5e530548','2021-01-26 11:01:27',NULL,'2021-01-11 05:32:27','2021-01-11 05:32:27'),(549,4,'f00f3a572865d05a3b394d4318744967549','2021-01-26 11:01:22',NULL,'2021-01-11 05:33:22','2021-01-11 05:33:22'),(550,5,'0030330711754609d2ab7c111f490133550','2021-01-26 11:01:07',NULL,'2021-01-11 05:34:07','2021-01-11 05:34:07'),(551,6,'88d61bdac803ce236bb05cfbbcb60a79551','2021-01-26 11:01:12',NULL,'2021-01-11 05:35:12','2021-01-11 05:35:12'),(552,6,'da5bdcfee31352cdf998e3eb4fc6ad00552','2021-01-26 12:01:00',NULL,'2021-01-11 06:42:00','2021-01-11 06:42:00'),(553,6,'829f149652652f4d21bff2941a06f890553','2021-01-27 04:01:01',NULL,'2021-01-11 22:37:01','2021-01-11 22:37:01'),(554,1,'692abc1fb0ae0fc678cbc63f1df34ec6554','2021-01-27 04:01:43',NULL,'2021-01-11 23:23:43','2021-01-11 23:23:43'),(555,6,'77a54b61a8b08b709dffd70f9272ed49555','2021-01-27 05:01:01',NULL,'2021-01-11 23:49:01','2021-01-11 23:49:01'),(556,6,'848a9e26637dd3c5c20d02832a87919c556','2021-01-27 05:01:27',NULL,'2021-01-12 00:23:27','2021-01-12 00:23:27'),(557,2,'1e9a0012ac12572a3db096d1fca1e5d6557','2021-01-27 07:01:15',NULL,'2021-01-12 02:09:15','2021-01-12 02:09:15'),(558,1,'c19cdef340da8d5db7e03989577735d6558','2021-01-27 08:01:12',NULL,'2021-01-12 03:04:12','2021-01-12 03:04:12'),(559,6,'ec7e3c38db68d59b174bfeb65826955c559','2021-01-27 09:01:05',NULL,'2021-01-12 04:18:05','2021-01-12 04:18:05'),(560,6,'dbbd1e8dd363cd9060a18838a8fee8b4560','2021-01-27 11:01:35',NULL,'2021-01-12 05:38:35','2021-01-12 05:38:35'),(561,8,'a1a76d77975b347644648b868e829723561','2021-01-27 11:01:26',NULL,'2021-01-12 05:39:26','2021-01-12 05:39:27'),(562,8,'3334424b239403d104333e5e0a5a135e562','2021-01-27 13:01:27',NULL,'2021-01-12 07:31:27','2021-01-12 07:31:27'),(563,8,'4cd4a5664d0119485b169f7c372d1e4a563','2021-01-28 04:01:40',NULL,'2021-01-12 23:17:40','2021-01-12 23:17:40'),(564,1,'0925ab46bb52fbcb100386633a7b3a2e564','2021-01-28 04:01:01',NULL,'2021-01-12 23:18:01','2021-01-12 23:18:01'),(565,8,'96bfa2c6d2fc1c957316ad90bdeb3d39565','2021-01-28 04:01:53',NULL,'2021-01-12 23:18:53','2021-01-12 23:18:53'),(566,8,'d40225c45587742014b396b0a8976742566','2021-01-28 05:01:44',NULL,'2021-01-13 00:16:44','2021-01-13 00:16:44'),(567,8,'7511cdd870dfb39ad7d3e488323e606c567','2021-01-28 05:01:56',NULL,'2021-01-13 00:16:56','2021-01-13 00:16:56'),(568,8,'adc93f22b559ac4c0c01e852b99c02b3568','2021-01-28 09:01:30',NULL,'2021-01-13 04:18:30','2021-01-13 04:18:30'),(569,8,'a00a434fcb1cdfe2f70a3df9ec5e3b62569','2021-01-28 12:01:46',NULL,'2021-01-13 07:11:46','2021-01-13 07:11:46'),(570,8,'74ff6a91228d7ac0790e12ef67785973570','2021-01-29 04:01:36',NULL,'2021-01-13 22:45:36','2021-01-13 22:45:36'),(571,6,'98df8eb6f9f926099a6cebcfc7dc43fd571','2021-01-29 05:01:06',NULL,'2021-01-13 23:50:06','2021-01-13 23:50:06'),(572,8,'585b24017863304fd3f121216a86b9a2572','2021-01-29 05:01:16',NULL,'2021-01-14 00:05:16','2021-01-14 00:05:16'),(573,6,'70e575696eabfb2124a475549b598ddb573','2021-01-29 05:01:53',NULL,'2021-01-14 00:09:53','2021-01-14 00:09:53'),(574,5,'8bbd44f79eee7971f33cb3db62571acc574','2021-01-29 06:01:15',NULL,'2021-01-14 00:45:15','2021-01-14 00:45:15'),(575,8,'8c13da703109659b31a4d0a2077e1b8e575','2021-01-29 06:01:47',NULL,'2021-01-14 00:45:47','2021-01-14 00:45:47'),(576,1,'6f2325280dae8786ec5b2af05283be95576','2021-01-29 06:01:47',NULL,'2021-01-14 01:00:47','2021-01-14 01:00:48'),(577,8,'d6955ce136a9027e5299d767d569131d577','2021-01-29 06:01:53',NULL,'2021-01-14 01:12:53','2021-01-14 01:12:53'),(578,8,'23e09708d045da8e646cba2d1ba52f67578','2021-01-29 06:01:16',NULL,'2021-01-14 01:18:16','2021-01-14 01:18:16'),(579,8,'78e3b710065568c4a23355390403f8e4579','2021-01-30 04:01:51',NULL,'2021-01-14 22:39:51','2021-01-14 22:39:51'),(580,2,'97290745b272bea2a5d036762feeaec6580','2021-01-30 04:01:52',NULL,'2021-01-14 22:44:52','2021-01-14 22:44:52'),(581,8,'92515954e2811a52604c40094323a298581','2021-01-30 04:01:34',NULL,'2021-01-14 22:59:34','2021-01-14 22:59:34'),(582,2,'917c105a02bfa4f5c2642086ee4c4711582','2021-01-30 04:01:06',NULL,'2021-01-14 23:11:06','2021-01-14 23:11:06'),(583,8,'88cc20aff95b8b5c09e0009dde1c661e583','2021-01-30 05:01:24',NULL,'2021-01-14 23:38:24','2021-01-14 23:38:24'),(584,2,'6bbb515af3f55d1be7f1c43b8bd17af0584','2021-01-30 06:01:42',NULL,'2021-01-15 01:06:42','2021-01-15 01:06:42'),(585,3,'bffff5266ccdf2ed16b0a12db6f2b6cf585','2021-01-30 06:01:22',NULL,'2021-01-15 01:10:22','2021-01-15 01:10:22'),(586,4,'11eaaaba34ae8be1d66a6721c84bd9f9586','2021-01-30 06:01:17',NULL,'2021-01-15 01:13:17','2021-01-15 01:13:17'),(587,5,'f9b646bce5618504f82791d6c24d9c20587','2021-01-30 06:01:17',NULL,'2021-01-15 01:15:17','2021-01-15 01:15:17'),(588,6,'517123b7fea250450b3ef7e7e508128c588','2021-01-30 06:01:50',NULL,'2021-01-15 01:19:50','2021-01-15 01:19:50'),(589,8,'853ca3c9bbec2ea175d51cae8cfb7e28589','2021-01-30 06:01:32',NULL,'2021-01-15 01:21:32','2021-01-15 01:21:32'),(590,9,'c7453d22c22b4a2f0a0888b8f1c72cd7590','2021-01-30 06:01:28',NULL,'2021-01-15 01:26:28','2021-01-15 01:26:29'),(591,9,'61b5a525f7a79d43f0fe1c5c5fc732ae591','2021-01-30 06:01:30',NULL,'2021-01-15 01:27:30','2021-01-15 01:27:30'),(592,8,'3daa90d9d0cab839146813b96b4a23aa592','2021-01-30 07:01:48',NULL,'2021-01-15 01:37:48','2021-01-15 01:37:48'),(593,6,'b4e2608d06520c14bc3389985c8eb908593','2021-01-30 07:01:45',NULL,'2021-01-15 01:43:45','2021-01-15 01:43:45'),(594,2,'722398e8c761d94ae276a36199c54d58594','2021-01-30 07:01:21',NULL,'2021-01-15 01:56:21','2021-01-15 01:56:21'),(595,10,'5aeffee810724e746caca084daa180d2595','2021-01-30 08:01:29',NULL,'2021-01-15 03:12:29','2021-01-15 03:12:29'),(596,10,'6cf7c92478a8cbd7122ae0424ae260c5596','2021-02-02 04:02:29',NULL,'2021-01-17 23:15:29','2021-01-17 23:15:29'),(597,6,'d804fade50e52cdf8636f4e6b6b84e27597','2021-02-02 09:02:09',NULL,'2021-01-18 03:56:09','2021-01-18 03:56:09'),(598,1,'d6af37d7f1569f66b9ea70bcc3814ba9598','2021-02-02 10:02:37',NULL,'2021-01-18 05:26:37','2021-01-18 05:26:37'),(599,6,'d1a23a481e013804fb5db0d0871cc550599','2021-02-02 12:02:49',NULL,'2021-01-18 06:49:49','2021-01-18 06:49:49'),(600,6,'01bea918d2f263878214753bcb08f520600','2021-02-02 12:02:45',NULL,'2021-01-18 07:24:45','2021-01-18 07:24:45'),(601,6,'e34541d7c49a86a073c2853723dc6a2d601','2021-02-03 04:02:31',NULL,'2021-01-18 23:28:31','2021-01-18 23:28:31'),(602,6,'70497b26b64914e19f8d42f45a67e25f602','2021-02-03 08:02:39',NULL,'2021-01-19 03:08:39','2021-01-19 03:08:39'),(603,1,'b1547efd3e22b3b7026ae9fff3627196603','2021-02-03 09:02:57',NULL,'2021-01-19 04:18:57','2021-01-19 04:18:57'),(604,6,'6c869f54e33d3c76a2b03ab409559ffe604','2021-02-03 09:02:35',NULL,'2021-01-19 04:26:35','2021-01-19 04:26:36'),(605,6,'ce594ec1c232f338f9fb85fa4db9cc47605','2021-02-04 05:02:01',NULL,'2021-01-20 00:14:01','2021-01-20 00:14:01'),(606,1,'c20315a62b3df789fa3ab489718ffc5c606','2021-02-04 07:02:34',NULL,'2021-01-20 01:33:34','2021-01-20 01:33:35'),(607,8,'d9b5186643580113e4f5eb413b5cdc01607','2021-02-04 07:02:43',NULL,'2021-01-20 01:35:43','2021-01-20 01:35:43'),(608,10,'31a88ba91386ac16c098380487b34756608','2021-02-04 08:02:40',NULL,'2021-01-20 03:02:40','2021-01-20 03:02:40'),(609,10,'03f7fd33a50f61edfa6522079a290eeb609','2021-02-04 10:02:16',NULL,'2021-01-20 04:47:16','2021-01-20 04:47:16'),(610,1,'19a179d0c4d7f2477a18084799c2bf2d610','2021-02-05 04:02:48',NULL,'2021-01-20 23:22:48','2021-01-20 23:22:48'),(611,10,'0cd9d82f151aab67264ed289f1d30a54611','2021-02-05 05:02:17',NULL,'2021-01-21 00:02:17','2021-01-21 00:02:17'),(612,1,'ce62fc8d21f5ab7ca886f05bf03cd869612','2021-02-05 08:02:48',NULL,'2021-01-21 03:16:48','2021-01-21 03:16:48'),(613,10,'769064a6767b35bb8986b55b850f5438613','2021-02-05 09:02:25',NULL,'2021-01-21 03:43:25','2021-01-21 03:43:25'),(614,4,'9c2e3915d32e226731a9dc7a14845581614','2021-02-05 10:02:19',NULL,'2021-01-21 04:57:19','2021-01-21 04:57:19'),(615,6,'f8a49f6e45bf40d8902741ca1cd76cee615','2021-02-05 10:02:27',NULL,'2021-01-21 05:10:27','2021-01-21 05:10:27'),(616,8,'78947c83df21e7d5c308dd133178533d616','2021-02-05 10:02:04',NULL,'2021-01-21 05:11:04','2021-01-21 05:11:04'),(617,1,'bcc55bf8591ee48f81f997d185f24be7617','2021-02-05 11:02:22',NULL,'2021-01-21 05:56:22','2021-01-21 05:56:22'),(618,1,'b71c55a04a23cd0fb919f8d49ab27765618','2021-02-05 11:02:28',NULL,'2021-01-21 06:22:28','2021-01-21 06:22:28'),(619,13,'3666d9f7ad3e88a4027105d643e02b28619','2021-02-05 11:02:56',NULL,'2021-01-21 06:24:56','2021-01-21 06:24:56'),(620,5,'846f84f427889bb2f2508172cce7928c620','2021-02-05 12:02:08',NULL,'2021-01-21 06:45:08','2021-01-21 06:45:08'),(621,3,'4a6ae329b23e6eb629054afa2a452a85621','2021-02-05 12:02:34',NULL,'2021-01-21 06:45:34','2021-01-21 06:45:34'),(622,1,'cf6dd1a90458268e56ab170a12b599e6622','2021-02-05 12:02:26',NULL,'2021-01-21 06:46:26','2021-01-21 06:46:26'),(623,4,'0362e74ae5d0b8b30dca650b254d35cc623','2021-02-05 12:02:18',NULL,'2021-01-21 06:53:18','2021-01-21 06:53:18'),(624,3,'d4ae20a45f0eca2ebd8ef5c16462ca3f624','2021-02-06 04:02:04',NULL,'2021-01-21 22:51:04','2021-01-21 22:51:04'),(625,5,'19493366a279bca3022d2b2b8c8d63cc625','2021-02-06 04:02:38',NULL,'2021-01-21 23:18:38','2021-01-21 23:18:38'),(626,6,'a9a6132741599fcd84b8c5e725e6b98c626','2021-02-06 04:02:06',NULL,'2021-01-21 23:23:06','2021-01-21 23:23:06'),(627,8,'316f315c7aec868853addc0cde918f8e627','2021-02-06 05:02:00',NULL,'2021-01-21 23:32:00','2021-01-21 23:32:00'),(628,9,'f15cbc0c36536004443bfb096a12a37a628','2021-02-06 05:02:12',NULL,'2021-01-21 23:46:12','2021-01-21 23:46:12'),(629,8,'87615cd4bc7dad40b2fbe968c5d65952629','2021-02-06 05:02:32',NULL,'2021-01-21 23:47:32','2021-01-21 23:47:32'),(630,12,'69615cb0bfcb3e93d00a3e0ca434443a630','2021-02-06 05:02:54',NULL,'2021-01-21 23:58:54','2021-01-21 23:58:54'),(631,1,'23d21b6a26abf12e2c38bc1c2ffce7ff631','2021-02-06 05:02:58',NULL,'2021-01-22 00:02:58','2021-01-22 00:02:58'),(632,12,'b200d87035d3eb9fc607fc64278899bf632','2021-02-06 05:02:49',NULL,'2021-01-22 00:03:49','2021-01-22 00:03:49'),(633,9,'c41f039d0436b3bf4e9d58d8c4ddcd6a633','2021-02-06 06:02:23',NULL,'2021-01-22 00:44:23','2021-01-22 00:44:23'),(634,9,'858e18c0eda1882e778449dd0fa16f2e634','2021-02-06 06:02:59',NULL,'2021-01-22 01:08:59','2021-01-22 01:08:59'),(635,8,'7e88cf5f29f2a0cce411c42e05365a04635','2021-02-06 06:02:00',NULL,'2021-01-22 01:12:00','2021-01-22 01:12:00'),(636,10,'db1ae795c363cd5f55d9586c70fd90f4636','2021-02-09 05:02:44',NULL,'2021-01-24 23:34:44','2021-01-24 23:34:44'),(637,10,'d581823150d8106da3980b7516ad98fe637','2021-02-09 08:02:37',NULL,'2021-01-25 03:05:37','2021-01-25 03:05:37'),(638,10,'0da87d9ff8abad78529deccc3e87e8a9638','2021-02-09 11:02:40',NULL,'2021-01-25 05:41:40','2021-01-25 05:41:40'),(639,6,'5940cf27ba8262a9877b4a89824a01cc639','2021-02-09 11:02:11',NULL,'2021-01-25 05:43:11','2021-01-25 05:43:11'),(640,8,'57ae12b88114f80498c6c7cbbf419234640','2021-02-09 11:02:16',NULL,'2021-01-25 05:47:16','2021-01-25 05:47:16'),(641,1,'88681ead8a860fb5e12c415aab34174e641','2021-02-09 11:02:43',NULL,'2021-01-25 05:47:43','2021-01-25 05:47:43'),(642,8,'2b2c881c4aa3d35947a0abb87bb6de6a642','2021-02-09 11:02:27',NULL,'2021-01-25 05:50:27','2021-01-25 05:50:28'),(643,1,'9d6aff8492eb38a47329222d82846027643','2021-02-11 06:02:29',NULL,'2021-01-27 01:14:29','2021-01-27 01:14:29'),(644,6,'60a503e2141ec9cca2952de4e35d1f5a644','2021-02-11 12:02:55',NULL,'2021-01-27 07:24:55','2021-01-27 07:24:55'),(645,2,'b9c03928ec2e01b74a07c848242b452d645','2021-02-12 04:02:16',NULL,'2021-01-27 23:22:16','2021-01-27 23:22:16'),(646,2,'c4fd27369407a8c3baf40d930f13fc5e646','2021-02-12 06:02:51',NULL,'2021-01-28 00:50:51','2021-01-28 00:50:51'),(647,2,'ce75009cf78b0a11da4a8bbb9e28cb50647','2021-02-12 07:02:08',NULL,'2021-01-28 02:09:08','2021-01-28 02:09:08'),(648,2,'af67afd785e787d7263e1664ffb8d257648','2021-02-12 08:02:02',NULL,'2021-01-28 03:07:02','2021-01-28 03:07:02'),(649,2,'d8bc130082935d9c146cfb763aa66821649','2021-02-12 10:02:42',NULL,'2021-01-28 04:35:42','2021-01-28 04:35:42'),(650,2,'cede13408e4726d89ae7874bd5562d9c650','2021-02-12 10:02:35',NULL,'2021-01-28 05:29:35','2021-01-28 05:29:35'),(651,1,'62ad3576216229cb934e526fef31bf32651','2021-02-12 12:02:30',NULL,'2021-01-28 06:53:30','2021-01-28 06:53:30'),(652,2,'95738cf8771de1b7611c83eb51871f90652','2021-02-12 12:02:18',NULL,'2021-01-28 06:56:18','2021-01-28 06:56:18'),(653,2,'62eb3341e6aac661a38e7f7be9c4cd6e653','2021-02-12 12:02:07',NULL,'2021-01-28 06:58:07','2021-01-28 06:58:07'),(654,1,'529a93d4fc428d24adac8fd6b34b5e34654','2021-02-13 10:02:05',NULL,'2021-01-29 05:07:05','2021-01-29 05:07:06'),(655,2,'7029bc4965b218a9f92ec02df89658ff655','2021-02-17 05:02:19',NULL,'2021-02-01 23:36:19','2021-02-01 23:36:19'),(656,10,'dcc0c4fc75ef6430d81330f741695d32656','2021-02-17 05:02:47',NULL,'2021-02-01 23:38:47','2021-02-01 23:38:47'),(657,2,'265a6ca2b7c3749ca3b1f5a5c001ad23657','2021-02-17 05:02:33',NULL,'2021-02-01 23:47:33','2021-02-01 23:47:33'),(658,2,'bb8acb376d4e5778f0f3155c36f91d17658','2021-02-17 05:02:48',NULL,'2021-02-02 00:25:48','2021-02-02 00:25:48'),(659,6,'36a3292c57efad5b6504cf6ef1c92fcc659','2021-02-17 06:02:08',NULL,'2021-02-02 00:53:08','2021-02-02 00:53:08'),(660,2,'aa74b2cca28a80fa5332bbfd599a1527660','2021-02-17 06:02:16',NULL,'2021-02-02 00:54:16','2021-02-02 00:54:16'),(661,2,'4ba3621efeb5c6a8fcbf1077eb0ef5de661','2021-02-17 09:02:52',NULL,'2021-02-02 03:40:52','2021-02-02 03:40:52'),(662,10,'1dc7a8a306521041cd26dd1244a9f22a662','2021-02-17 09:02:08',NULL,'2021-02-02 03:42:08','2021-02-02 03:42:08'),(663,10,'4e4f831cbea8ff6f82ccca6c10089128663','2021-02-17 12:02:57',NULL,'2021-02-02 07:06:57','2021-02-02 07:06:57'),(664,2,'7fd7645ac1145297080033a275a2d940664','2021-02-18 04:02:11',NULL,'2021-02-02 23:11:11','2021-02-02 23:11:12'),(665,1,'e215b335b7ca8d5e5a5861d4725a26be665','2021-02-18 04:02:13',NULL,'2021-02-02 23:22:13','2021-02-02 23:22:13'),(666,8,'927b57f3dfbb3b3a66b78ae4243000a2666','2021-02-18 05:02:28',NULL,'2021-02-03 00:14:28','2021-02-03 00:14:28'),(667,2,'2bf137cea2d3dab4059d35567bbd36b5667','2021-02-18 05:02:07',NULL,'2021-02-03 00:15:07','2021-02-03 00:15:07'),(668,6,'7010eea687da79603ad8208a7ce107a7668','2021-02-18 06:02:56',NULL,'2021-02-03 00:31:56','2021-02-03 00:31:56'),(669,1,'575684b10ad8e7b4b30e9fd95d8f1eb9669','2021-02-18 06:02:11',NULL,'2021-02-03 00:35:11','2021-02-03 00:35:11'),(670,2,'35885b1f8a2b1c4f4c65e0816c7d2bd7670','2021-02-18 06:02:27',NULL,'2021-02-03 01:25:27','2021-02-03 01:25:27'),(671,8,'d6364aa1a34c47f44e5ae04ebc9c0fa0671','2021-02-18 08:02:33',NULL,'2021-02-03 03:27:33','2021-02-03 03:27:33'),(672,6,'a27b22f3c59fe870943a2b798857fd72672','2021-02-18 08:02:07',NULL,'2021-02-03 03:28:07','2021-02-03 03:28:07'),(673,1,'0df0f889362883b57dcb5437289bcef1673','2021-02-18 08:02:26',NULL,'2021-02-03 03:28:26','2021-02-03 03:28:26'),(674,8,'2ac1d1a6bd3d6119fc145c5136fe17d7674','2021-02-18 09:02:14',NULL,'2021-02-03 03:35:14','2021-02-03 03:35:14'),(675,11,'f9cbd5a8d734ac1b65b2f636f30b556d675','2021-02-18 09:02:22',NULL,'2021-02-03 03:59:22','2021-02-03 03:59:22'),(676,8,'42ed5ae1d06362be0caf1f7187d4506e676','2021-02-18 09:02:36',NULL,'2021-02-03 04:01:36','2021-02-03 04:01:36'),(677,11,'c7d7e24654ec3874683c6d9bbc4e0d77677','2021-02-18 09:02:39',NULL,'2021-02-03 04:02:39','2021-02-03 04:02:39'),(678,2,'cf21444b5d75b2da5ef861d1dfc5de4e678','2021-02-18 10:02:40',NULL,'2021-02-03 04:41:40','2021-02-03 04:41:40'),(679,2,'7e8929f3b2ab9b739f59474ea500c571679','2021-02-18 11:02:53',NULL,'2021-02-03 05:49:53','2021-02-03 05:49:53'),(680,8,'4cb7b9506559db292a8941e46d0b4cc8680','2021-02-18 11:02:03',NULL,'2021-02-03 06:07:03','2021-02-03 06:07:03'),(681,6,'5257979124cdb57e123be8146067e286681','2021-02-18 11:02:33',NULL,'2021-02-03 06:12:33','2021-02-03 06:12:33'),(682,1,'98b825829420d61f866f1ad0219cbb11682','2021-02-18 12:02:53',NULL,'2021-02-03 06:36:53','2021-02-03 06:36:53'),(683,1,'87e0f0b2d19a8142cdce2e29d75bcc21683','2021-02-19 05:02:36',NULL,'2021-02-03 23:41:36','2021-02-03 23:41:36'),(684,1,'f1a5067f3a4eb836b7726a4204a48f51684','2021-02-19 06:02:07',NULL,'2021-02-04 00:35:07','2021-02-04 00:35:07'),(685,1,'de7af14890a7a47a87ec3676c5f41d10685','2021-02-19 09:02:20',NULL,'2021-02-04 03:52:20','2021-02-04 03:52:20'),(686,2,'4b3decc2962ddc702be58ad0ab4cafa6686','2021-02-19 10:02:29',NULL,'2021-02-04 04:44:29','2021-02-04 04:44:29'),(687,10,'f880c7372fa03fedbe7505bda693e429687','2021-02-19 10:02:50',NULL,'2021-02-04 04:45:50','2021-02-04 04:45:50'),(688,2,'ae3c2a33b69c00838d3fecb78af16117688','2021-02-19 10:02:35',NULL,'2021-02-04 04:46:35','2021-02-04 04:46:36'),(689,10,'302ea90fa1ec631400e1e2498ae15feb689','2021-02-19 10:02:28',NULL,'2021-02-04 04:47:28','2021-02-04 04:47:28'),(690,1,'446ca7b7e67d00d56d77b1cba916e916690','2021-02-20 04:02:02',NULL,'2021-02-04 22:59:02','2021-02-04 22:59:02'),(691,1,'50357d926cd8bc9043db9b1839e96983691','2021-02-20 05:02:30',NULL,'2021-02-04 23:52:30','2021-02-04 23:52:30'),(692,10,'cac04cfe96c2b0aa7ca0f584a125400f692','2021-02-20 05:02:11',NULL,'2021-02-04 23:54:11','2021-02-04 23:54:11'),(693,1,'9d0d350d42fd8ed9cf0d7f677005abde693','2021-02-20 05:02:15',NULL,'2021-02-05 00:01:15','2021-02-05 00:01:15'),(694,10,'c4a0bd49029a3fcb0fd22fea0465c4df694','2021-02-20 05:02:19',NULL,'2021-02-05 00:05:19','2021-02-05 00:05:19'),(695,10,'88a0c604e980ea4f9eb5f18ecd546e4f695','2021-02-20 05:02:27',NULL,'2021-02-05 00:27:27','2021-02-05 00:27:27'),(696,10,'c2c43460dd092dba341e1186793d7ca5696','2021-02-23 05:02:32',NULL,'2021-02-08 00:26:32','2021-02-08 00:26:33'),(697,1,'3f6a36ba5769f2fa3755bd9a441f709f697','2021-02-23 08:02:31',NULL,'2021-02-08 03:08:31','2021-02-08 03:08:31'),(698,2,'8bde2f81b1d3c4b27e2c6f0639f8a7b3698','2021-02-24 04:02:13',NULL,'2021-02-08 23:21:13','2021-02-08 23:21:13'),(699,8,'2b43e40f44c316fe2866602b97f4a88d699','2021-02-24 06:02:53',NULL,'2021-02-09 00:30:53','2021-02-09 00:30:53'),(700,2,'06ee6b3a0406472c8ad857786db6c937700','2021-02-24 07:02:37',NULL,'2021-02-09 01:36:37','2021-02-09 01:36:37'),(701,8,'d9e038b662ebf25dcaf8b81174e11ec5701','2021-02-24 07:02:12',NULL,'2021-02-09 01:37:12','2021-02-09 01:37:12'),(702,6,'50397c0b68970f819c49be71aae50a24702','2021-02-24 07:02:50',NULL,'2021-02-09 01:37:50','2021-02-09 01:37:50'),(703,10,'1423e431a58bbd4b1709c80c3b159477703','2021-02-24 07:02:15',NULL,'2021-02-09 01:38:15','2021-02-09 01:38:15'),(704,2,'b1e9c12a0ad2b7928d72ad707b1fc048704','2021-02-24 09:02:46',NULL,'2021-02-09 04:25:46','2021-02-09 04:25:47'),(705,10,'f76dbb4f30512853e8b8b200579c01f7705','2021-02-24 11:02:41',NULL,'2021-02-09 05:34:41','2021-02-09 05:34:41'),(706,8,'78497c6013c107af8bd8739b7be601e5706','2021-02-25 09:02:37',NULL,'2021-02-10 03:47:37','2021-02-10 03:47:37'),(707,8,'a7dd042a3fa42ae215b880482b3aa389707','2021-02-25 09:02:11',NULL,'2021-02-10 04:23:11','2021-02-10 04:23:11'),(708,8,'0aa4e997d6e227b1124e3e4e5b122251708','2021-02-25 12:02:30',NULL,'2021-02-10 06:55:30','2021-02-10 06:55:30'),(709,8,'b973f228e548d0c699633acce1a2f9e2709','2021-02-26 09:02:04',NULL,'2021-02-11 03:44:04','2021-02-11 03:44:04'),(710,6,'75553b2966837e486808e52abe1ab53f710','2021-02-26 09:02:05',NULL,'2021-02-11 03:50:05','2021-02-11 03:50:05'),(711,10,'59f27770f7c9135578153bf4585908ff711','2021-02-26 09:02:27',NULL,'2021-02-11 03:50:27','2021-02-11 03:50:27'),(712,1,'4c752976d54d5fa41cfeecd42fc8ce3f712','2021-02-26 09:02:47',NULL,'2021-02-11 03:50:47','2021-02-11 03:50:47'),(713,6,'8e2ae88af92bb737bf2c7e3c18b023c7713','2021-02-26 09:02:08',NULL,'2021-02-11 03:52:08','2021-02-11 03:52:08'),(714,1,'844847d5ea9d1a7d6935d9562a4020c1714','2021-02-26 10:02:49',NULL,'2021-02-11 05:27:49','2021-02-11 05:27:50'),(715,6,'33c3a56a6486e7ac7377258e90db52be715','2021-02-26 10:02:41',NULL,'2021-02-11 05:28:41','2021-02-11 05:28:41'),(716,6,'4c66db7e2c1d23eeb8c03e9f08c5ad3e716','2021-02-26 12:02:52',NULL,'2021-02-11 06:30:52','2021-02-11 06:30:52'),(717,10,'b76ceb22e9f6d6e3ee18a8cc1c339679717','2021-03-02 05:03:18',NULL,'2021-02-15 00:28:18','2021-02-15 00:28:18'),(718,2,'dbe8b70df3a0cbf652527e4af45954e5718','2021-03-03 04:03:19',NULL,'2021-02-15 23:25:19','2021-02-15 23:25:19'),(719,10,'8a4581ec62838776e7a8d17e10970851719','2021-03-03 05:03:33',NULL,'2021-02-16 00:15:33','2021-02-16 00:15:33'),(720,1,'ef06c8039c4c70a13e85458e157c1722720','2021-03-03 05:03:05',NULL,'2021-02-16 00:16:05','2021-02-16 00:16:05'),(721,10,'1ef7b8678c2d21a2d10885a12a3f8e48721','2021-03-03 05:03:51',NULL,'2021-02-16 00:23:51','2021-02-16 00:23:52'),(722,2,'0241cc94ccdf4ccdeb90768f1c1042f8722','2021-03-03 06:03:44',NULL,'2021-02-16 00:42:44','2021-02-16 00:42:44'),(723,1,'26d509b760e807f3925354ef644eb05b723','2021-03-03 07:03:44',NULL,'2021-02-16 01:40:44','2021-02-16 01:40:44'),(724,1,'2e1e50501b96a6e92f391a72b6cfb25b724','2021-03-03 09:03:04',NULL,'2021-02-16 03:48:04','2021-02-16 03:48:04'),(725,2,'9fcf6aa9bf553f5203ea259fc30335c4725','2021-03-03 10:03:40',NULL,'2021-02-16 04:36:40','2021-02-16 04:36:40'),(726,1,'d20c892a22cc1766662d2c0941b3aabc726','2021-03-03 11:03:52',NULL,'2021-02-16 05:35:52','2021-02-16 05:35:52'),(727,1,'9df7ad814f785299c92440acb38c3e9f727','2021-03-04 05:03:21',NULL,'2021-02-17 00:06:21','2021-02-17 00:06:21'),(728,1,'d77278d6ed8661fac313b0c732a53951728','2021-03-04 08:03:34',NULL,'2021-02-17 03:02:34','2021-02-17 03:02:34'),(729,18,'a286a6e98f73b79cd0b1b0b4d7362310729','2021-03-04 08:03:08',NULL,'2021-02-17 03:23:08','2021-02-17 03:23:08'),(730,18,'088f3acf8ad804af0b7a149a3a6eab3b730','2021-03-04 08:03:17',NULL,'2021-02-17 03:23:17','2021-02-17 03:23:17'),(731,1,'8a36e7e3b550e0ba017df0810d09b2f0731','2021-03-04 08:03:53',NULL,'2021-02-17 03:23:53','2021-02-17 03:23:54'),(732,18,'0db204bcd288915dbf20e281180a8b9a732','2021-03-04 09:03:23',NULL,'2021-02-17 04:18:23','2021-02-17 04:18:24'),(733,18,'25211e91d738cdcda2989841ffc4c185733','2021-03-05 04:03:37',NULL,'2021-02-17 23:02:37','2021-02-17 23:02:37'),(734,18,'54a38b3b023a6c187c2e2e3f0c323286734','2021-03-06 04:03:39',NULL,'2021-02-18 23:09:39','2021-02-18 23:09:39'),(735,18,'eb5fde33643ed5d02499d21f679e3af5735','2021-03-06 06:03:44',NULL,'2021-02-19 01:27:44','2021-02-19 01:27:44'),(736,18,'ba971e5478fcd8170277e1672cd8ad10736','2021-03-06 07:03:17',NULL,'2021-02-19 02:04:17','2021-02-19 02:04:17'),(737,18,'a291abd76a60116164a244eaf72f46a0737','2021-03-06 11:03:51',NULL,'2021-02-19 06:04:51','2021-02-19 06:04:52'),(738,18,'60a1337b1b248147e3d7f0c1cdc36104738','2021-03-09 04:03:24',NULL,'2021-02-21 23:25:24','2021-02-21 23:25:24'),(739,3,'11bf83ff1d637393a0b855866516ab7c739','2021-03-09 05:03:01',NULL,'2021-02-21 23:47:01','2021-02-21 23:47:02'),(740,1,'bb1d01186d1f5d9fbb26473c216e895e740','2021-03-09 05:03:38',NULL,'2021-02-21 23:49:38','2021-02-21 23:49:38'),(741,2,'d2c9b750200340c2b1396889306ca63c741','2021-03-09 06:03:30',NULL,'2021-02-22 00:31:30','2021-02-22 00:31:30'),(742,1,'851a4b8defc368e1f275bf16a5769272742','2021-03-09 06:03:59',NULL,'2021-02-22 00:31:59','2021-02-22 00:31:59'),(743,2,'63825b92ac63c4b74a7765d410ed54ae743','2021-03-09 06:03:52',NULL,'2021-02-22 00:52:52','2021-02-22 00:52:53'),(744,1,'2f8a79972f3c8f257863b3d172ef9099744','2021-03-09 06:03:10',NULL,'2021-02-22 00:55:10','2021-02-22 00:55:10'),(745,2,'13195212cb1836ad144e023ce518e00b745','2021-03-09 06:03:19',NULL,'2021-02-22 00:56:19','2021-02-22 00:56:19'),(746,2,'88e02177959557e36cf3b6769f3fde1a746','2021-03-09 06:03:33',NULL,'2021-02-22 00:56:33','2021-02-22 00:56:33'),(747,18,'1896e721353304cca91ee57eefc0f6ac747','2021-03-09 07:03:06',NULL,'2021-02-22 01:50:06','2021-02-22 01:50:06'),(748,2,'0581530831e8fd420e485fdc3fe7ce03748','2021-03-09 08:03:28',NULL,'2021-02-22 03:22:28','2021-02-22 03:22:28'),(749,18,'4e52a92640066f8ea01276a97448541c749','2021-03-10 04:03:34',NULL,'2021-02-22 22:51:34','2021-02-22 22:51:34'),(750,18,'2df127b7ebf92f835b1692daa8ef3fcf750','2021-03-10 06:03:22',NULL,'2021-02-23 00:30:22','2021-02-23 00:30:22'),(751,2,'f07a85361d271642ab5644db495808fe751','2021-03-10 06:03:00',NULL,'2021-02-23 01:16:00','2021-02-23 01:16:00'),(752,18,'15a3e63d489c206427aa293eb874908f752','2021-03-10 06:03:36',NULL,'2021-02-23 01:21:36','2021-02-23 01:21:36'),(753,2,'4efff112b03898213f70534db429b7b8753','2021-03-10 06:03:17',NULL,'2021-02-23 01:23:17','2021-02-23 01:23:17'),(754,18,'5731b5536d4cad0ded30d3674e539f9f754','2021-03-10 06:03:13',NULL,'2021-02-23 01:24:13','2021-02-23 01:24:14'),(755,1,'0bf70e5f37cbcb2e8cd2167439c90371755','2021-03-10 08:03:33',NULL,'2021-02-23 03:07:33','2021-02-23 03:07:33'),(756,2,'e31a399e8690fed05742392f4cdce7e4756','2021-03-10 08:03:57',NULL,'2021-02-23 03:07:57','2021-02-23 03:07:57'),(757,9,'c973ec4298535b9ad07bcc1cebf8e1ee757','2021-03-10 08:03:09',NULL,'2021-02-23 03:15:09','2021-02-23 03:15:09'),(758,8,'c9be2fa5bdd127c9c32e2b9b1811c61f758','2021-03-10 08:03:49',NULL,'2021-02-23 03:26:49','2021-02-23 03:26:49'),(759,10,'7e3de33d17e30d0541bafb7695bf19cf759','2021-03-10 09:03:44',NULL,'2021-02-23 03:34:44','2021-02-23 03:34:44'),(760,18,'87baff7e9c3c2d5950cfdfb7f94c33d4760','2021-03-10 10:03:48',NULL,'2021-02-23 05:08:48','2021-02-23 05:08:48'),(761,10,'e228f7c9b829ec4196691c86f9ea83e8761','2021-03-10 11:03:47',NULL,'2021-02-23 06:21:47','2021-02-23 06:21:47'),(762,1,'4410ec125650a6f688f67d4cfb432c2f762','2021-03-12 04:03:05',NULL,'2021-02-24 23:07:05','2021-02-24 23:07:05'),(763,6,'e2daf7d484a89fd3bde38b710d46cef3763','2021-03-12 09:03:28',NULL,'2021-02-25 04:05:28','2021-02-25 04:05:28'),(764,6,'a12de3a3253ed4f0031f883ba3463035764','2021-03-12 10:03:33',NULL,'2021-02-25 04:43:33','2021-02-25 04:43:33'),(765,6,'9c475ca5a79af149e7ff0ce61c960154765','2021-03-12 11:03:53',NULL,'2021-02-25 05:53:53','2021-02-25 05:53:53'),(766,9,'18ad8c992e6eb0f0357af4e7c9912b5e766','2021-03-12 11:03:41',NULL,'2021-02-25 05:59:41','2021-02-25 05:59:41'),(767,6,'4074a0f8888fb718bff7177c7fe2f0f3767','2021-03-12 11:03:11',NULL,'2021-02-25 06:03:11','2021-02-25 06:03:11'),(768,8,'336b32f921ed1f150e8a24db569c7790768','2021-03-12 11:03:37',NULL,'2021-02-25 06:19:37','2021-02-25 06:19:37'),(769,4,'069f6adb2c49c9066000df8a9d5674ef769','2021-03-12 13:03:11',NULL,'2021-02-25 07:40:11','2021-02-25 07:40:11'),(770,2,'6bdadda0038d2cca25a122cb0c17ed08770','2021-03-13 04:03:39',NULL,'2021-02-25 22:59:39','2021-02-25 22:59:39'),(771,3,'34016229d3e7c8f48dd0cc906a062517771','2021-03-13 04:03:38',NULL,'2021-02-25 23:11:38','2021-02-25 23:11:38'),(772,4,'f311924d83c136969a4b936cfb8ec078772','2021-03-13 05:03:17',NULL,'2021-02-26 00:21:17','2021-02-26 00:21:17'),(773,5,'44a2661284859b86bbe5c70dff63f0cc773','2021-03-13 06:03:11',NULL,'2021-02-26 00:38:11','2021-02-26 00:38:11'),(774,6,'db8527cc312ceafcb66122e72157a4bc774','2021-03-13 06:03:11',NULL,'2021-02-26 00:40:11','2021-02-26 00:40:11'),(775,6,'5284ed0b1d9d58e2955db2d412be19fa775','2021-03-13 06:03:58',NULL,'2021-02-26 00:44:58','2021-02-26 00:44:58'),(776,5,'e205edf39db32a4a2dd324ceb4967bfd776','2021-03-13 06:03:58',NULL,'2021-02-26 00:45:58','2021-02-26 00:45:58'),(777,8,'1e5110bffce1f5ec009ee967fa83be69777','2021-03-13 06:03:40',NULL,'2021-02-26 00:46:40','2021-02-26 00:46:41'),(778,6,'37fc3ac1e7bdf28166fec572cbe7c8ae778','2021-03-13 06:03:12',NULL,'2021-02-26 01:00:12','2021-02-26 01:00:12'),(779,2,'770ae285384d983534d66b3be9716964779','2021-03-13 11:03:08',NULL,'2021-02-26 06:25:08','2021-02-26 06:25:09'),(780,6,'4abd0d2e857e74d75a746efa0ebd5495780','2021-03-13 11:03:08',NULL,'2021-02-26 06:26:08','2021-02-26 06:26:08'),(781,8,'6fa83c507b73ebdb62139bb828ea79ee781','2021-03-13 11:03:47',NULL,'2021-02-26 06:27:47','2021-02-26 06:27:47'),(782,9,'6393b252a3216082a73c185ae10b7042782','2021-03-13 11:03:51',NULL,'2021-02-26 06:28:51','2021-02-26 06:28:51'),(783,1,'0df868e8fb4d5a26ae30a342cd29c14e783','2021-03-13 12:03:37',NULL,'2021-02-26 06:34:37','2021-02-26 06:34:37'),(784,8,'c6a98d69c5207ad3bc21973bd6a72925784','2021-03-13 12:03:41',NULL,'2021-02-26 06:57:41','2021-02-26 06:57:41'),(785,8,'56a2928858e48072552271cf37d7545d785','2021-03-13 12:03:59',NULL,'2021-02-26 06:58:59','2021-02-26 06:58:59'),(786,6,'116aff538b1c00d583b4ff825e0daa59786','2021-03-13 12:03:45',NULL,'2021-02-26 06:59:45','2021-02-26 06:59:45'),(787,2,'d533a95d89dee9645d0d41fd1e538404787','2021-03-13 12:03:41',NULL,'2021-02-26 07:00:41','2021-02-26 07:00:41'),(788,10,'c40783ba1708352c4f6d04017fd64cfe788','2021-03-13 12:03:55',NULL,'2021-02-26 07:05:55','2021-02-26 07:05:55'),(789,3,'d3d4df82d63ed75b579309100c26f763789','2021-03-16 10:03:21',NULL,'2021-03-01 04:51:21','2021-03-01 04:51:21'),(790,8,'f43f0a72d4f7b38552f8e0a31ca683c4790','2021-03-16 10:03:29',NULL,'2021-03-01 05:09:29','2021-03-01 05:09:29'),(791,9,'4930952d7fab66291fae6c60c1375355791','2021-03-16 10:03:54',NULL,'2021-03-01 05:12:54','2021-03-01 05:12:54'),(792,1,'9710c193c8d745edc3fb01a10c0baad3792','2021-03-17 05:03:47',NULL,'2021-03-02 00:12:47','2021-03-02 00:12:47'),(793,1,'5b2b8928c5acbe57f23fa1fa232accea793','2021-03-17 06:03:48',NULL,'2021-03-02 01:15:48','2021-03-02 01:15:48'),(794,1,'7a4eb1047fa832b74086d98b795cc87d794','2021-03-17 08:03:24',NULL,'2021-03-02 03:15:24','2021-03-02 03:15:24'),(795,10,'49619c52ee82f612f77d989ca531bf2e795','2021-03-18 09:03:03',NULL,'2021-03-03 03:55:03','2021-03-03 03:55:03'),(796,1,'56bd7e30330bf365fa28447f99f84cc6796','2021-03-18 09:03:16',NULL,'2021-03-03 04:04:16','2021-03-03 04:04:16'),(797,1,'93fcd5080488800ff26417fbdf168dea797','2021-03-23 05:03:41',NULL,'2021-03-07 23:30:41','2021-03-07 23:30:42'),(798,9,'da68d802f0cb14f5eaaa960d1ae8dbce798','2021-03-23 06:03:36',NULL,'2021-03-08 00:34:36','2021-03-08 00:34:36'),(799,1,'755e891ca497a43d1ce2a5cb439e3736799','2021-03-23 06:03:06',NULL,'2021-03-08 00:36:06','2021-03-08 00:36:06'),(800,6,'f4ca867a23c8732995b1ba7f99d10e99800','2021-03-23 06:03:49',NULL,'2021-03-08 00:37:49','2021-03-08 00:37:49'),(801,10,'c2995fa4652a9bc6eba5d182521decde801','2021-03-23 06:03:48',NULL,'2021-03-08 01:06:48','2021-03-08 01:06:48'),(802,6,'fd98757d68f135b7931af443dbab6e55802','2021-03-23 07:03:50',NULL,'2021-03-08 02:02:50','2021-03-08 02:02:50'),(803,2,'8349bd56a010dd044cf54b199fa9d850803','2021-03-23 13:03:09',NULL,'2021-03-08 07:36:09','2021-03-08 07:36:09'),(804,1,'b48484eba42ac10f099de687185de779804','2021-03-23 13:03:36',NULL,'2021-03-08 07:36:36','2021-03-08 07:36:36'),(805,2,'f32bd45413c23eb4e2be522b4ece9991805','2021-03-23 13:03:02',NULL,'2021-03-08 07:38:02','2021-03-08 07:38:02'),(806,10,'33976e8de0c37a748eccfc1c916745ff806','2021-03-24 11:03:11',NULL,'2021-03-09 06:25:11','2021-03-09 06:25:11'),(807,10,'6a9f997b4327af0e9f3031239e3d41d1807','2021-03-25 09:03:50',NULL,'2021-03-10 03:50:50','2021-03-10 03:50:50'),(808,2,'c48bf34e0d8a6ed9f60b7a4bac27a3fc808','2021-03-25 11:03:29',NULL,'2021-03-10 05:35:29','2021-03-10 05:35:29'),(809,2,'a147da7c3115ff0d18b1f890428862a0809','2021-03-25 12:03:53',NULL,'2021-03-10 07:01:53','2021-03-10 07:01:53'),(810,2,'805194a717c1cfba44b623165319f207810','2021-03-27 04:03:11',NULL,'2021-03-11 23:13:11','2021-03-11 23:13:12'),(811,2,'d8ffebda5cdecdef168ea1824c5b5037811','2021-03-27 07:03:42',NULL,'2021-03-12 01:53:42','2021-03-12 01:53:42'),(812,3,'47bc1682fa483048fd306be7a2c6ccc0812','2021-03-27 07:03:26',NULL,'2021-03-12 02:01:26','2021-03-12 02:01:26'),(813,4,'759ef49ed0e5fbbb9f6fab14837dc1c2813','2021-03-27 07:03:35',NULL,'2021-03-12 02:02:35','2021-03-12 02:02:35'),(814,4,'a89df880aa956aeb0256eac05f30d18b814','2021-03-27 07:03:30',NULL,'2021-03-12 02:03:30','2021-03-12 02:03:30'),(815,2,'07d72d5167ae99b45c5f85c8f128c38b815','2021-03-27 08:03:49',NULL,'2021-03-12 02:58:49','2021-03-12 02:58:49'),(816,2,'33759143c63336122237a114aaa3a042816','2021-03-27 08:03:05',NULL,'2021-03-12 03:22:05','2021-03-12 03:22:05'),(817,2,'6cd35e041f23bb43eec08d4285622afb817','2021-03-27 09:03:17',NULL,'2021-03-12 04:10:17','2021-03-12 04:10:17'),(818,3,'e016eb4c61fa80238a74fc954595a1d0818','2021-03-27 09:03:39',NULL,'2021-03-12 04:16:39','2021-03-12 04:16:39'),(819,4,'bc1c2baabdd1b2c290a580b958be70fb819','2021-03-27 09:03:22',NULL,'2021-03-12 04:18:22','2021-03-12 04:18:22'),(820,5,'2448af025cff5cacfa8775c64c7a99d0820','2021-03-27 09:03:50',NULL,'2021-03-12 04:19:50','2021-03-12 04:19:50'),(821,2,'d774a7b8a411fb825623b421e7b3fdaf821','2021-03-27 09:03:17',NULL,'2021-03-12 04:20:17','2021-03-12 04:20:17'),(822,13,'96bff7aa503b51e2a24df87eb150881e822','2021-03-27 09:03:03',NULL,'2021-03-12 04:21:03','2021-03-12 04:21:03'),(823,5,'258b9caaefef50da70c61052a46e6438823','2021-03-27 09:03:50',NULL,'2021-03-12 04:22:50','2021-03-12 04:22:50'),(824,6,'5be9d981f924de3a48a63f9a96d67c35824','2021-03-27 09:03:45',NULL,'2021-03-12 04:24:45','2021-03-12 04:24:45'),(825,8,'0d535783fcb62c4ad88d03460e20f9d7825','2021-03-27 09:03:42',NULL,'2021-03-12 04:29:42','2021-03-12 04:29:42'),(826,9,'9e75965eb16b94561bedbac3c0f9258d826','2021-03-27 10:03:21',NULL,'2021-03-12 04:32:21','2021-03-12 04:32:21'),(827,8,'b02ba41e9c9fd305b80310d0c925270c827','2021-03-27 10:03:24',NULL,'2021-03-12 04:34:24','2021-03-12 04:34:24'),(828,6,'d040c4c5a19469c8d20726cf4778b55e828','2021-03-27 10:03:48',NULL,'2021-03-12 04:38:48','2021-03-12 04:38:48'),(829,2,'8a9033210df0a6c9f136831298706573829','2021-03-27 10:03:29',NULL,'2021-03-12 04:41:29','2021-03-12 04:41:30'),(830,10,'e64db4333a2e4a2e1c4b7b8bcff72097830','2021-03-27 10:03:29',NULL,'2021-03-12 04:58:29','2021-03-12 04:58:29'),(831,9,'63a0f2a9235c5cb69805b1a9e5241e4d831','2021-03-27 11:03:43',NULL,'2021-03-12 05:57:43','2021-03-12 05:57:43'),(832,1,'c60c09e96527209422e3ef01e8ed4029832','2021-03-31 04:03:45',NULL,'2021-03-15 22:55:45','2021-03-15 22:55:46'),(833,9,'7041a79cd2bc3254bca00f2f05695b1d833','2021-03-31 12:03:16',NULL,'2021-03-16 07:21:16','2021-03-16 07:21:16'),(834,2,'ff4fbec7844b1e8d6f6a0374f0cd50f3834','2021-03-31 12:03:05',NULL,'2021-03-16 07:25:05','2021-03-16 07:25:06'),(835,9,'439b36511493ca0a83d3ace8312f015c835','2021-03-31 12:03:55',NULL,'2021-03-16 07:26:55','2021-03-16 07:26:55'),(836,2,'eab479e34a926e8867e24cd2f1c90034836','2021-03-31 13:03:45',NULL,'2021-03-16 07:36:45','2021-03-16 07:36:45'),(837,8,'150cbb61925a17d2b8c3a23901a498b7837','2021-04-01 05:04:30',NULL,'2021-03-16 23:51:30','2021-03-16 23:51:30'),(838,2,'a55365d3afd57cad6e2ea8121553e1a8838','2021-04-01 05:04:01',NULL,'2021-03-16 23:56:01','2021-03-16 23:56:01'),(839,3,'b368675de85d93e43208800db1d98429839','2021-04-01 05:04:52',NULL,'2021-03-17 00:01:52','2021-03-17 00:01:52'),(840,4,'28c15273ce92b31a454ae926b883380f840','2021-04-01 05:04:08',NULL,'2021-03-17 00:04:08','2021-03-17 00:04:08'),(841,5,'4d431920eb5bae79f6abf26874c05a21841','2021-04-01 05:04:35',NULL,'2021-03-17 00:05:35','2021-03-17 00:05:35'),(842,4,'041aea07c771846459fe5f50209ab84e842','2021-04-01 05:04:04',NULL,'2021-03-17 00:06:04','2021-03-17 00:06:04'),(843,13,'1c4c8eedbd904436276641ae3480ceb4843','2021-04-01 05:04:45',NULL,'2021-03-17 00:06:45','2021-03-17 00:06:45'),(844,5,'8c83547a50284c33ff7d523dc2393131844','2021-04-01 05:04:58',NULL,'2021-03-17 00:07:58','2021-03-17 00:07:58'),(845,6,'f2e6192787ee5bba4a173260d30744fa845','2021-04-01 05:04:12',NULL,'2021-03-17 00:11:12','2021-03-17 00:11:12'),(846,8,'bd67d14f98890f3d8379a701c07e20e1846','2021-04-01 05:04:57',NULL,'2021-03-17 00:12:57','2021-03-17 00:12:57'),(847,9,'7d410f5d7ef717369394d20d43a58212847','2021-04-01 05:04:54',NULL,'2021-03-17 00:13:54','2021-03-17 00:13:54'),(848,2,'ce27de4f2a7ccda1e9b6f5535de963aa848','2021-04-01 06:04:52',NULL,'2021-03-17 00:37:52','2021-03-17 00:37:52'),(849,9,'3dc1756c01230bf40beb825111d2fb95849','2021-04-01 09:04:07',NULL,'2021-03-17 03:42:07','2021-03-17 03:42:07'),(850,8,'ef0eb059fdccd004415f58f15aded692850','2021-04-01 09:04:02',NULL,'2021-03-17 03:43:02','2021-03-17 03:43:02'),(851,8,'307984735a5eee81008740b7ee96379b851','2021-04-01 11:04:01',NULL,'2021-03-17 06:00:01','2021-03-17 06:00:01'),(852,2,'96229badc523b56001aac4f4bc2e300e852','2021-04-01 13:04:20',NULL,'2021-03-17 07:38:20','2021-03-17 07:38:20'),(853,2,'94976c1cd3175b45f1fec11d10052f72853','2021-04-02 04:04:03',NULL,'2021-03-17 23:00:03','2021-03-17 23:00:03'),(854,10,'ab125a4cc7a77b22421e84a50daba865854','2021-04-02 04:04:51',NULL,'2021-03-17 23:12:51','2021-03-17 23:12:51'),(855,6,'a732e9a3fd2506ca4aa86c1488d45f68855','2021-04-02 05:04:39',NULL,'2021-03-17 23:31:39','2021-03-17 23:31:39'),(856,9,'26555e7e02d216a7f9a75f4e961476b2856','2021-04-02 05:04:23',NULL,'2021-03-17 23:41:23','2021-03-17 23:41:23'),(857,8,'f147c659287a6ea8c2cda8f0f47395af857','2021-04-02 05:04:30',NULL,'2021-03-17 23:49:30','2021-03-17 23:49:30'),(858,8,'dc1d3f232c5ecd7820a6a3d01609432a858','2021-04-02 06:04:18',NULL,'2021-03-18 00:50:18','2021-03-18 00:50:18'),(859,9,'2573f4efbc7c47cc9c4e6d06e506e133859','2021-04-02 07:04:43',NULL,'2021-03-18 01:51:43','2021-03-18 01:51:43'),(860,4,'d989307df1ee83f03ff2f400f114e5bf860','2021-04-02 07:04:52',NULL,'2021-03-18 02:17:52','2021-03-18 02:17:52'),(861,2,'23a07d1d88d920ae1940bef2823478f7861','2021-04-02 08:04:13',NULL,'2021-03-18 03:22:13','2021-03-18 03:22:13'),(862,2,'99a50b056affc5e1a67ff9d13d7f19d1862','2021-04-02 09:04:39',NULL,'2021-03-18 04:24:39','2021-03-18 04:24:39'),(863,2,'3957e4c3e83ba41ec0d3cb37a840e26e863','2021-04-02 11:04:29',NULL,'2021-03-18 05:50:29','2021-03-18 05:50:29'),(864,9,'7855dd7cf43a762005aa7992d3642223864','2021-04-02 13:04:36',NULL,'2021-03-18 07:34:36','2021-03-18 07:34:36'),(865,2,'5aa14487612df25a821ccb159b107735865','2021-04-03 04:04:06',NULL,'2021-03-18 23:11:06','2021-03-18 23:11:06'),(866,2,'7f7bed3b2ffd49c5ce5c71eb131a2523866','2021-04-06 04:04:20',NULL,'2021-03-21 23:01:20','2021-03-21 23:01:20'),(867,10,'e13af5f963efd945a1e7579dc1a29761867','2021-04-06 05:04:59',NULL,'2021-03-21 23:49:59','2021-03-21 23:49:59'),(868,10,'b890bd9e567a4068dd4bb7c674d7972f868','2021-04-06 06:04:35',NULL,'2021-03-22 00:49:35','2021-03-22 00:49:35'),(869,10,'60a3148b3990f080e713b9cff7655dfc869','2021-04-06 08:04:12',NULL,'2021-03-22 03:02:12','2021-03-22 03:02:12'),(870,10,'4811388bf06295d4b2b2bcd33bd136cc870','2021-04-06 13:04:14',NULL,'2021-03-22 07:32:14','2021-03-22 07:32:14'),(871,10,'18e2cc602395e805db150232a8851e52871','2021-04-07 04:04:16',NULL,'2021-03-22 23:05:16','2021-03-22 23:05:16'),(872,10,'e4dede974c199108e6a3fbdfbc2ff394872','2021-04-07 05:04:51',NULL,'2021-03-23 00:29:51','2021-03-23 00:29:51'),(873,10,'676464c01ddf50ec0c814f588ecdd0c4873','2021-04-07 11:04:28',NULL,'2021-03-23 05:40:28','2021-03-23 05:40:28'),(874,10,'4ab8b0f5660254b02976bed285bd168a874','2021-04-07 12:04:10',NULL,'2021-03-23 06:50:10','2021-03-23 06:50:10'),(875,10,'e41524bc4d1465f4236ffb81eb18d067875','2021-04-09 04:04:22',NULL,'2021-03-24 22:41:22','2021-03-24 22:41:23'),(876,2,'62c895c9198413528cb8846c1d30d171876','2021-04-09 04:04:02',NULL,'2021-03-24 22:58:02','2021-03-24 22:58:03'),(877,10,'738618613fe05652f4dafb312e4c0d5f877','2021-04-09 04:04:29',NULL,'2021-03-24 22:58:29','2021-03-24 22:58:29'),(878,2,'76798883d8b441eecaeebc072986e96b878','2021-04-09 04:04:48',NULL,'2021-03-24 22:58:48','2021-03-24 22:58:48'),(879,3,'6c4c5bab1b70a8cd0b94f531ed12e222879','2021-04-09 04:04:15',NULL,'2021-03-24 23:03:15','2021-03-24 23:03:15'),(880,4,'625e86cbeebff8d9c0eef3b3fbc60ce6880','2021-04-09 04:04:34',NULL,'2021-03-24 23:07:34','2021-03-24 23:07:34'),(881,5,'bf795b6f3becf07e790cc978584b5c4b881','2021-04-09 04:04:28',NULL,'2021-03-24 23:08:28','2021-03-24 23:08:28'),(882,13,'9d1c8fb6d2f36c0a2cf28c9d51978f3a882','2021-04-09 04:04:42',NULL,'2021-03-24 23:09:42','2021-03-24 23:09:42'),(883,6,'adbe33b69109575bccc90fc996727b1b883','2021-04-09 04:04:46',NULL,'2021-03-24 23:10:46','2021-03-24 23:10:46'),(884,13,'5fea5564d129805d8fddbaa16ee03d63884','2021-04-09 04:04:54',NULL,'2021-03-24 23:11:54','2021-03-24 23:11:54'),(885,5,'0951fffea46f9b36ba2468e05aac71c3885','2021-04-09 04:04:49',NULL,'2021-03-24 23:15:49','2021-03-24 23:15:50'),(886,6,'34fc4c880fc0b08bc378fba0a71e20fe886','2021-04-09 04:04:50',NULL,'2021-03-24 23:16:50','2021-03-24 23:16:50'),(887,8,'fb83681be3a0494a5ea91c4e23cc9247887','2021-04-09 04:04:45',NULL,'2021-03-24 23:17:45','2021-03-24 23:17:45'),(888,9,'394a5c7c41c6e78fd6269543c6d5d367888','2021-04-09 04:04:30',NULL,'2021-03-24 23:18:30','2021-03-24 23:18:30'),(889,8,'37d48f6b801918e2a02ccf33b6004856889','2021-04-09 04:04:06',NULL,'2021-03-24 23:28:06','2021-03-24 23:28:06'),(890,10,'2ffe771b631d3ce55e8e6a10daaea788890','2021-04-09 05:04:13',NULL,'2021-03-24 23:30:13','2021-03-24 23:30:13'),(891,8,'c2b4a7d348e1c6045a89fda9cbc88cde891','2021-04-09 05:04:23',NULL,'2021-03-25 00:06:23','2021-03-25 00:06:23'),(892,6,'e7a715baf8adcdc88893e733ef3995cc892','2021-04-09 05:04:38',NULL,'2021-03-25 00:07:38','2021-03-25 00:07:38'),(893,2,'e9a03e9ae0a283ee582c681354723598893','2021-04-09 05:04:41',NULL,'2021-03-25 00:08:41','2021-03-25 00:08:41'),(894,10,'c6a9368801bd09d23ee64a6f10fb8a6b894','2021-04-09 05:04:42',NULL,'2021-03-25 00:26:42','2021-03-25 00:26:42'),(895,10,'23f844c7c1886e83a094eeac0892b879895','2021-04-09 11:04:06',NULL,'2021-03-25 06:06:06','2021-03-25 06:06:06'),(896,10,'7315ff6dfec5667333832a5bd3304cd0896','2021-04-10 05:04:16',NULL,'2021-03-25 23:37:16','2021-03-25 23:37:16'),(897,7,'8fa1002d52341596f63226bfd11d914c897','2021-04-10 09:04:52',NULL,'2021-03-26 04:08:52','2021-03-26 04:08:52'),(898,5,'da1ed6b701f6b550b170a6aa4858c68b898','2021-04-10 09:04:02',NULL,'2021-03-26 04:11:02','2021-03-26 04:11:02'),(899,1,'c717b481d9b7dcb4350922a7b12fad8c899','2021-04-10 09:04:16',NULL,'2021-03-26 04:12:16','2021-03-26 04:12:16'),(900,6,'f0ef1af65a3e1d28355f876873902396900','2021-04-10 09:04:41',NULL,'2021-03-26 04:12:41','2021-03-26 04:12:41'),(901,6,'83f2785e79138ce7e4fa92e617b20bf4901','2021-04-10 09:04:38',NULL,'2021-03-26 04:13:38','2021-03-26 04:13:38'),(902,10,'5bebf5d3386d3b226b34b237d05e732c902','2021-04-14 05:04:28',NULL,'2021-03-30 00:09:28','2021-03-30 00:09:28'),(903,10,'3f8613b4345f36a423ce8a5eaa714c2f903','2021-04-14 08:04:29',NULL,'2021-03-30 03:22:29','2021-03-30 03:22:29'),(904,2,'b9eba0778f5ec975f45c9b773fb5a1c5904','2021-04-14 09:04:51',NULL,'2021-03-30 03:31:51','2021-03-30 03:31:51'),(905,10,'308b7764b64ab7663e8397a1f803f24e905','2021-04-14 09:04:34',NULL,'2021-03-30 03:52:34','2021-03-30 03:52:34'),(906,10,'644b78d9889015c19ecb428f81358786906','2021-04-14 11:04:07',NULL,'2021-03-30 06:27:07','2021-03-30 06:27:07'),(907,2,'7e67deeb9b871667148e26701fe4382d907','2021-04-15 10:04:19',NULL,'2021-03-31 05:00:19','2021-03-31 05:00:19'),(908,2,'5af30edd877d9961122a06ca2e87a802908','2021-04-20 06:04:05',NULL,'2021-04-05 01:17:05','2021-04-05 01:17:05'),(909,2,'18c411012f78633306beecbcd306ff6a909','2021-04-20 08:04:46',NULL,'2021-04-05 03:09:46','2021-04-05 03:09:46'),(910,2,'e8c60f359749411d9f244ee558220f87910','2021-04-20 09:04:46',NULL,'2021-04-05 03:52:46','2021-04-05 03:52:46'),(911,8,'931b8983df49a492ee8d01f0cac9d281911','2021-04-21 06:04:09',NULL,'2021-04-06 00:48:09','2021-04-06 00:48:09'),(912,13,'c65a2bf103acbf6b587eaf31c0d6a1eb912','2021-04-21 06:04:51',NULL,'2021-04-06 00:48:51','2021-04-06 00:48:51'),(913,9,'e9d2d09f2cda4ed0e61e34dcd74f745f913','2021-04-21 06:04:21',NULL,'2021-04-06 01:05:21','2021-04-06 01:05:21'),(914,6,'ef44eb3320a1850bdb35c07824dcded3914','2021-04-21 06:04:39',NULL,'2021-04-06 01:11:39','2021-04-06 01:11:39'),(915,2,'547e02b5315a9361e2f87487153f5146915','2021-04-21 06:04:32',NULL,'2021-04-06 01:12:32','2021-04-06 01:12:32'),(916,3,'d7bf173bd97dce416e7dd2a21be37b09916','2021-04-21 06:04:08',NULL,'2021-04-06 01:16:08','2021-04-06 01:16:08'),(917,4,'b7e8615e32edb7a9a2b5213dcda3c43a917','2021-04-21 06:04:24',NULL,'2021-04-06 01:17:24','2021-04-06 01:17:24'),(918,3,'03f62eddad51297455e76305a961d1fb918','2021-04-21 07:04:39',NULL,'2021-04-06 02:02:39','2021-04-06 02:02:39'),(919,3,'2c1359476f7ae21f84f0e00bdc25903c919','2021-04-22 09:04:20',NULL,'2021-04-07 03:42:20','2021-04-07 03:42:20'),(920,9,'7344ff1cce35889993e2d177d1507e39920','2021-04-22 10:04:38',NULL,'2021-04-07 05:17:38','2021-04-07 05:17:38'),(921,2,'f8138991726e93ba35d6d602e402e257921','2021-04-22 12:04:50',NULL,'2021-04-07 06:39:50','2021-04-07 06:39:50'),(922,3,'d87cac2fbe3ff8044ac2b7d6cce03347922','2021-04-22 12:04:43',NULL,'2021-04-07 06:52:43','2021-04-07 06:52:44'),(923,4,'01c18fdd201fe749642b0889b53d582b923','2021-04-22 12:04:01',NULL,'2021-04-07 06:57:01','2021-04-07 06:57:01'),(924,2,'283cf824fc19f85bfee2969914e679fd924','2021-04-22 12:04:32',NULL,'2021-04-07 06:57:32','2021-04-07 06:57:32'),(925,3,'2556864a583f8d3f38cce8c30f5a2a77925','2021-04-22 12:04:03',NULL,'2021-04-07 06:58:03','2021-04-07 06:58:03'),(926,4,'78adda6819917e95207a4767596f72bb926','2021-04-22 12:04:00',NULL,'2021-04-07 06:59:00','2021-04-07 06:59:00'),(927,13,'f90af57c67706c24d4b3d2cade77b6fb927','2021-04-22 12:04:11',NULL,'2021-04-07 07:00:11','2021-04-07 07:00:11'),(928,5,'1f1fcfdf70b99193579bfec997331779928','2021-04-22 12:04:14',NULL,'2021-04-07 07:01:14','2021-04-07 07:01:14'),(929,1,'b8a218e90a296fb5d464c71293c21095929','2021-04-23 04:04:55',NULL,'2021-04-07 23:21:55','2021-04-07 23:21:55'),(930,10,'5aec9b148a36b100b6831314d8754ab0930','2021-04-23 05:04:31',NULL,'2021-04-08 00:19:31','2021-04-08 00:19:31'),(931,2,'af75fcc2ccf2a29049d3de8afbbb4020931','2021-04-27 08:04:34',NULL,'2021-04-12 03:18:34','2021-04-12 03:18:34'),(932,9,'d7c9498346b6e083cbdaf1e389d06386932','2021-04-27 10:04:56',NULL,'2021-04-12 04:44:56','2021-04-12 04:44:56'),(933,10,'b89160522c9771d7c6bc2a43de063f24933','2021-04-27 10:04:50',NULL,'2021-04-12 05:24:50','2021-04-12 05:24:50'),(934,6,'dcdce73b2304ff48ecb7993475edc8fc934','2021-04-27 11:04:52',NULL,'2021-04-12 05:36:52','2021-04-12 05:36:52'),(935,1,'7e4cef049f2c630aa9b41d5b87486853935','2021-04-27 11:04:21',NULL,'2021-04-12 05:37:21','2021-04-12 05:37:21'),(936,6,'247dddf8d55ad3ee53506a043d2719b5936','2021-04-27 11:04:58',NULL,'2021-04-12 05:39:58','2021-04-12 05:39:58'),(937,2,'d7db075036133d7ea380062d6a82a9cf937','2021-04-27 11:04:57',NULL,'2021-04-12 06:02:57','2021-04-12 06:02:57'),(938,6,'389ad83d68584e8adce3faf9c0b12c51938','2021-04-27 11:04:05',NULL,'2021-04-12 06:17:05','2021-04-12 06:17:05'),(939,8,'9e36a4d39e90e10ba23c94b17153668a939','2021-04-27 11:04:40',NULL,'2021-04-12 06:18:40','2021-04-12 06:18:40'),(940,10,'e82c99164e4291d5b5cdca43f1293008940','2021-04-27 11:04:58',NULL,'2021-04-12 06:28:58','2021-04-12 06:28:58'),(941,8,'99bf9cdbc8ee870a97438eb64b566309941','2021-04-27 12:04:44',NULL,'2021-04-12 06:52:44','2021-04-12 06:52:44'),(942,1,'e6e722348150b5bfaf2ebd013762c834942','2021-04-28 04:04:00',NULL,'2021-04-12 23:06:00','2021-04-12 23:06:00'),(943,2,'217839b6c767b9eee17b780fddbca84e943','2021-04-28 04:04:52',NULL,'2021-04-12 23:19:52','2021-04-12 23:19:52'),(944,10,'980d8a198199d41c6f28b04478ef73f0944','2021-04-28 05:04:18',NULL,'2021-04-12 23:36:18','2021-04-12 23:36:18'),(945,8,'1a0ebae4f35c2a6ce3ca1a5d2e2118c8945','2021-04-28 06:04:59',NULL,'2021-04-13 00:45:59','2021-04-13 00:45:59'),(946,8,'2768d4af71e7cb02431b2d71e7f5ebdb946','2021-04-28 06:04:18',NULL,'2021-04-13 00:55:18','2021-04-13 00:55:18'),(947,9,'2b69ab7147aed1a8481c2e8e7f0d7bc6947','2021-04-28 06:04:57',NULL,'2021-04-13 01:17:57','2021-04-13 01:17:57'),(948,6,'981d1e5962cf267093c2334025a4347a948','2021-04-28 09:04:57',NULL,'2021-04-13 03:48:57','2021-04-13 03:48:57'),(949,6,'f75bf29e9a11e743005a2fec1e318413949','2021-04-28 09:04:14',NULL,'2021-04-13 04:19:14','2021-04-13 04:19:14'),(950,8,'57087cfda2a89a304877193c411363da950','2021-04-28 10:04:50',NULL,'2021-04-13 04:50:50','2021-04-13 04:50:50'),(951,9,'1323ea7c340e1dd2c62290f5ee7c0286951','2021-04-29 05:04:18',NULL,'2021-04-14 00:08:18','2021-04-14 00:08:19'),(952,8,'87565fa355d555be0551e21c916d9476952','2021-05-05 08:05:36',NULL,'2021-04-20 03:06:36','2021-04-20 03:06:36'),(953,6,'c432fa6855aa889b8e70a80a70479cd1953','2021-05-05 08:05:00',NULL,'2021-04-20 03:08:00','2021-04-20 03:08:00'),(954,2,'d86e5257b97799ee30794b0ead58ed7f954','2021-05-05 09:05:43',NULL,'2021-04-20 04:26:43','2021-04-20 04:26:43'),(955,9,'ff20421d5fc6bc56eea536cbd30620dd955','2021-05-05 11:05:27',NULL,'2021-04-20 05:45:27','2021-04-20 05:45:27'),(956,9,'2eaee1463f674b8574675a2311e98256956','2021-05-05 11:05:29',NULL,'2021-04-20 06:17:29','2021-04-20 06:17:29'),(957,5,'e84080647b4150929c3c00ac7d79b53b957','2021-05-05 12:05:34',NULL,'2021-04-20 06:40:34','2021-04-20 06:40:34'),(958,8,'f7b0bce6cfb952a88c0dcb026d6421fb958','2021-05-05 12:05:01',NULL,'2021-04-20 06:41:01','2021-04-20 06:41:01'),(959,13,'809b127e671e3256e35a62c486063280959','2021-05-05 12:05:39',NULL,'2021-04-20 06:41:39','2021-04-20 06:41:39'),(960,3,'9d0c2d799a35dce606011ff8b9cb16fe960','2021-05-05 12:05:35',NULL,'2021-04-20 06:42:35','2021-04-20 06:42:35'),(961,3,'03c1a48b365b9f96a3a75b2bafe24529961','2021-05-05 12:05:10',NULL,'2021-04-20 06:50:10','2021-04-20 06:50:10'),(962,4,'8e62854f96c4584fef3f2a198638d699962','2021-05-05 12:05:09',NULL,'2021-04-20 06:52:09','2021-04-20 06:52:09'),(963,13,'a23afaa14ed029d4f42428012b10350c963','2021-05-05 12:05:04',NULL,'2021-04-20 06:53:04','2021-04-20 06:53:04'),(964,5,'994f2d844c7ea2d0861aef184a803b69964','2021-05-05 12:05:19',NULL,'2021-04-20 06:54:19','2021-04-20 06:54:19'),(965,6,'5c2445349a85e57dd0a9b8b1d4cab752965','2021-05-05 12:05:08',NULL,'2021-04-20 06:55:08','2021-04-20 06:55:08'),(966,4,'e7e54ea223fbbcad5489331b553c5168966','2021-05-05 12:05:12',NULL,'2021-04-20 06:57:12','2021-04-20 06:57:12'),(967,9,'69b1518861ba095ba6db1724a51b6f4b967','2021-05-05 12:05:48',NULL,'2021-04-20 06:57:48','2021-04-20 06:57:48'),(968,2,'3097bb9c2f8a7b377d80a50de5129d0e968','2021-05-06 05:05:30',NULL,'2021-04-21 00:12:30','2021-04-21 00:12:30'),(969,2,'46b28c142c9ea1145995bf2f8c399d83969','2021-05-06 08:05:11',NULL,'2021-04-21 03:19:11','2021-04-21 03:19:11'),(970,2,'2af4f039a004270ef86ab832031d5eb5970','2021-05-06 10:05:38',NULL,'2021-04-21 04:46:38','2021-04-21 04:46:38'),(971,3,'1bc080e3dc5da823e8357aaa192f5950971','2021-05-06 12:05:56',NULL,'2021-04-21 06:32:56','2021-04-21 06:32:56'),(972,4,'e4b217c300338d4a1f942fe0c63620d1972','2021-05-06 12:05:01',NULL,'2021-04-21 06:34:01','2021-04-21 06:34:01'),(973,1,'52337d42be63f8198c1295cd7e571133973','2021-05-06 12:05:43',NULL,'2021-04-21 06:59:43','2021-04-21 06:59:43'),(974,2,'50fa9f29020f8236ac2bfaa06385c71b974','2021-05-07 05:05:29',NULL,'2021-04-21 23:30:29','2021-04-21 23:30:29'),(975,13,'b64d5d7aeb95847d09289c481985a567975','2021-05-07 05:05:12',NULL,'2021-04-21 23:33:12','2021-04-21 23:33:12'),(976,5,'b2dbc75874d1f4b75f0de1c5a679771b976','2021-05-07 05:05:54',NULL,'2021-04-21 23:34:54','2021-04-21 23:34:54'),(977,6,'4ea429bc04e83e958ff8427097b439a3977','2021-05-07 05:05:45',NULL,'2021-04-21 23:35:45','2021-04-21 23:35:45'),(978,8,'a7e1a3dacc4ca51a3ae09ce3b4b72f7b978','2021-05-07 05:05:52',NULL,'2021-04-21 23:37:52','2021-04-21 23:37:52'),(979,9,'e9eba9b713aa1fa10c89e1a4decd145c979','2021-05-07 05:05:01',NULL,'2021-04-21 23:39:01','2021-04-21 23:39:01'),(980,9,'1198e7d4098fab7f6405a16530d15c4a980','2021-05-07 05:05:35',NULL,'2021-04-22 00:27:35','2021-04-22 00:27:35'),(981,8,'7a0f0d75a41b4551348d6aef46bdb69d981','2021-05-07 06:05:08',NULL,'2021-04-22 00:36:08','2021-04-22 00:36:08'),(982,6,'a85555c92e349525dbe1909b6c24d832982','2021-05-07 06:05:42',NULL,'2021-04-22 00:39:42','2021-04-22 00:39:42'),(983,8,'536467824eed842a50df899e5aa30a2a983','2021-05-07 06:05:26',NULL,'2021-04-22 00:40:26','2021-04-22 00:40:26'),(984,2,'07d90987e2e68eb823d0538e575009c8984','2021-05-07 06:05:07',NULL,'2021-04-22 00:44:07','2021-04-22 00:44:07'),(985,10,'ab06d243e197a56493e6ee1309cc9471985','2021-05-07 06:05:33',NULL,'2021-04-22 00:56:33','2021-04-22 00:56:33'),(986,8,'456534163bc493708d734d8ec5fab583986','2021-05-07 06:05:36',NULL,'2021-04-22 01:25:36','2021-04-22 01:25:36'),(987,6,'aa0d5d9800291011fa2613f0610a1dae987','2021-05-07 06:05:31',NULL,'2021-04-22 01:27:31','2021-04-22 01:27:31'),(988,2,'9de93c59a7d4fbda2787d3872183da69988','2021-05-13 06:05:26',NULL,'2021-04-28 00:39:26','2021-04-28 00:39:26'),(989,6,'7da015bd96f4d4357dba0eddccf19403989','2021-05-14 04:05:59',NULL,'2021-04-28 23:04:00','2021-04-28 23:04:00'),(990,8,'319ae48c2971a6ea147f08f0db24dcae990','2021-05-14 04:05:17',NULL,'2021-04-28 23:05:17','2021-04-28 23:05:17'),(991,13,'accae921da73ce83bc4f7b4d493cb9c0991','2021-05-14 04:05:49',NULL,'2021-04-28 23:07:49','2021-04-28 23:07:49'),(992,8,'d0220e8b902c56506b07b49dfc4a8a14992','2021-05-14 04:05:08',NULL,'2021-04-28 23:13:08','2021-04-28 23:13:08'),(993,2,'bf7256dcbda1fd8ce13a39b77a6bb104993','2021-05-14 05:05:44',NULL,'2021-04-28 23:48:44','2021-04-28 23:48:44'),(994,2,'3fa9797429758297a05421d5c4d44761994','2021-05-15 04:05:47',NULL,'2021-04-29 22:58:47','2021-04-29 22:58:47'),(995,6,'c37917fd4423c479b9cee896077cb14b995','2021-05-15 04:05:19',NULL,'2021-04-29 23:09:19','2021-04-29 23:09:19'),(996,2,'118b245ded79277518610a97a9de2113996','2021-05-18 04:05:16',NULL,'2021-05-02 23:11:17','2021-05-02 23:11:17'),(997,10,'b4434a4af8418bd5567a0387f11fdd35997','2021-05-18 04:05:10',NULL,'2021-05-02 23:18:10','2021-05-02 23:18:10'),(998,8,'3e76ba2aa35f8bbeb697744c8ef8d3c7998','2021-05-18 04:05:51',NULL,'2021-05-02 23:23:51','2021-05-02 23:23:51'),(999,7,'eda4b5bb17fae83fe32614b25c2c2876999','2021-05-18 05:05:02',NULL,'2021-05-02 23:32:02','2021-05-02 23:32:02'),(1000,1,'7e2c8408958b21a60d85b6f65746ac421000','2021-05-18 05:05:09',NULL,'2021-05-02 23:42:09','2021-05-02 23:42:09'),(1001,2,'6a7c54df0b220a6fd2acd12194c92aff1001','2021-05-18 06:05:37',NULL,'2021-05-03 00:46:37','2021-05-03 00:46:37'),(1002,10,'f6e6a7ce3b6a1b6d775f78f03181bef61002','2021-05-18 06:05:15',NULL,'2021-05-03 00:49:15','2021-05-03 00:49:15'),(1003,1,'9c5b5b49f92801fa0fb853743491a1cc1003','2021-05-18 06:05:29',NULL,'2021-05-03 00:53:29','2021-05-03 00:53:29'),(1004,10,'f4ff85230ccfcba0fe8ece229b6679ef1004','2021-05-18 06:05:31',NULL,'2021-05-03 01:16:31','2021-05-03 01:16:31'),(1005,10,'8c8d9770c2ad141b6c9696f5b3638d8e1005','2021-05-18 08:05:15',NULL,'2021-05-03 03:24:15','2021-05-03 03:24:15'),(1006,2,'fb0ec958e61c9ab6fd50e1e725667f631006','2021-05-18 08:05:11',NULL,'2021-05-03 03:27:11','2021-05-03 03:27:11'),(1007,10,'db2842c668027a2e80157610f1b5aa3b1007','2021-05-18 10:05:48',NULL,'2021-05-03 05:11:48','2021-05-03 05:11:48'),(1008,2,'cb9188e5a52a2895ad764ff804ade45d1008','2021-05-18 11:05:26',NULL,'2021-05-03 05:48:26','2021-05-03 05:48:26'),(1009,1,'54462bf6f9a2424733f950efd468d9981009','2021-05-19 04:05:09',NULL,'2021-05-03 23:24:09','2021-05-03 23:24:09'),(1010,2,'482a9a87fa19dae5cf15e4738f764df11010','2021-05-19 04:05:22',NULL,'2021-05-03 23:27:22','2021-05-03 23:27:22'),(1011,4,'e1d0aab2b808d1e5741b4cec0581cc801011','2021-05-19 08:05:51',NULL,'2021-05-04 03:13:51','2021-05-04 03:13:51'),(1012,5,'8f5caf5260de8f207dae544d2cb86a971012','2021-05-19 09:05:53',NULL,'2021-05-04 04:07:53','2021-05-04 04:07:53'),(1013,13,'a462561c92967d41e5a460f019b9f1a41013','2021-05-19 09:05:22',NULL,'2021-05-04 04:08:22','2021-05-04 04:08:22'),(1014,4,'b0aec416bf22345c22cfc20fd09504ea1014','2021-05-19 09:05:07',NULL,'2021-05-04 04:09:07','2021-05-04 04:09:07'),(1015,13,'d7b2f4d65c4c87bbefed21c0b9730c941015','2021-05-19 09:05:06',NULL,'2021-05-04 04:10:06','2021-05-04 04:10:06'),(1016,5,'8aeaf04192ac469c463a62c7ce3bbce81016','2021-05-19 09:05:11',NULL,'2021-05-04 04:11:11','2021-05-04 04:11:11'),(1017,6,'2427d56d874d47733895b7e1cd63dff41017','2021-05-19 11:05:13',NULL,'2021-05-04 05:37:13','2021-05-04 05:37:13'),(1018,10,'fc6734bc8b4eff69928a8ca267d912331018','2021-05-19 12:05:40',NULL,'2021-05-04 06:51:40','2021-05-04 06:51:40'),(1019,5,'39cd715aa493dc9487944c71324d4b561019','2021-05-22 04:05:25',NULL,'2021-05-06 23:06:25','2021-05-06 23:06:25'),(1020,13,'c81e10f54e291f29248206bf0f5dc7e01020','2021-05-22 04:05:16',NULL,'2021-05-06 23:07:16','2021-05-06 23:07:16'),(1021,4,'8f62577bed54ac0e4f49e9a919c47ab01021','2021-05-22 04:05:40',NULL,'2021-05-06 23:07:40','2021-05-06 23:07:40'),(1022,13,'7af45cdfb086370ee20535787f45f9e41022','2021-05-22 04:05:14',NULL,'2021-05-06 23:09:14','2021-05-06 23:09:14'),(1023,5,'0f620c16606529b60a2fdf3fae4b00f81023','2021-05-22 04:05:35',NULL,'2021-05-06 23:10:35','2021-05-06 23:10:36'),(1024,6,'00ed7b5ed0ef3fdb3cdb9ca7b8a24e631024','2021-05-22 04:05:21',NULL,'2021-05-06 23:22:21','2021-05-06 23:22:21'),(1025,13,'49ec42f36a05e8f7e9cd5422af6410861025','2021-05-22 07:05:17',NULL,'2021-05-07 02:10:18','2021-05-07 02:10:18'),(1026,6,'ef8966590bd48de22ee886b4615e6f841026','2021-05-22 07:05:01',NULL,'2021-05-07 02:11:01','2021-05-07 02:11:01'),(1027,2,'3a396197599bd8fe6b290c1ca291c6af1027','2021-05-22 08:05:02',NULL,'2021-05-07 03:21:02','2021-05-07 03:21:02'),(1028,3,'97ded6d3192aa4b8eeff0423753e104a1028','2021-05-22 08:05:06',NULL,'2021-05-07 03:29:06','2021-05-07 03:29:06'),(1029,4,'0a54b27afddfa315a730fa24759baa0d1029','2021-05-22 09:05:02',NULL,'2021-05-07 03:31:02','2021-05-07 03:31:02'),(1030,13,'7cc4d86d5ebc9ee299f8f1011eec87d11030','2021-05-22 09:05:30',NULL,'2021-05-07 03:32:30','2021-05-07 03:32:30'),(1031,5,'5f01f9f7de78097d2da539f8d95359551031','2021-05-22 09:05:52',NULL,'2021-05-07 03:42:52','2021-05-07 03:42:53'),(1032,6,'c06a5dfb9ab595ea69e78a9dafcf6a851032','2021-05-22 09:05:24',NULL,'2021-05-07 03:45:24','2021-05-07 03:45:24'),(1033,8,'dda1346440a8a0c5a7df8110417a4fcb1033','2021-05-22 09:05:32',NULL,'2021-05-07 03:50:32','2021-05-07 03:50:32'),(1034,9,'1c3951d3d474d021015ddfb26bf67d6c1034','2021-05-22 09:05:26',NULL,'2021-05-07 03:54:26','2021-05-07 03:54:26'),(1035,9,'bb7203180e16ad98fd208e110e3904551035','2021-05-25 05:05:29',NULL,'2021-05-09 23:32:29','2021-05-09 23:32:29'),(1036,9,'9756761f34246271575baa586d3f60f51036','2021-05-25 05:05:57',NULL,'2021-05-10 00:28:57','2021-05-10 00:28:57'),(1037,9,'5974a61b73971428ed2ba68b91d58e161037','2021-05-25 06:05:07',NULL,'2021-05-10 00:32:07','2021-05-10 00:32:07'),(1038,8,'241cdded34fdc4ccb90ba78669f670e01038','2021-05-25 06:05:55',NULL,'2021-05-10 00:33:55','2021-05-10 00:33:55'),(1039,6,'efb71d87c91f0ddb9d5035259a3a975f1039','2021-05-25 06:05:54',NULL,'2021-05-10 00:36:54','2021-05-10 00:36:54'),(1040,6,'67b33c7ba221f1489899fe7fd15509321040','2021-05-25 09:05:38',NULL,'2021-05-10 03:34:38','2021-05-10 03:34:38'),(1041,8,'ab74278d0567e3168961d110c878f5991041','2021-05-25 09:05:01',NULL,'2021-05-10 04:04:01','2021-05-10 04:04:01'),(1042,6,'bd9b1d01157c8ee7f75f9ef9143cd8421042','2021-05-25 09:05:49',NULL,'2021-05-10 04:10:49','2021-05-10 04:10:49'),(1043,6,'2441873ea79d4193b185ce69d07c95dd1043','2021-05-25 10:05:11',NULL,'2021-05-10 05:05:11','2021-05-10 05:05:11'),(1044,6,'857bd98ddf5d904c24aa2e6bf9c27e861044','2021-05-26 05:05:59',NULL,'2021-05-10 23:41:59','2021-05-10 23:41:59'),(1045,9,'2e52416d70ed7b1b421adef504c4be591045','2021-05-26 05:05:52',NULL,'2021-05-10 23:45:52','2021-05-10 23:45:52'),(1046,8,'d1134ad1f4d9b6868995d11b5049991c1046','2021-05-26 05:05:17',NULL,'2021-05-10 23:47:17','2021-05-10 23:47:17'),(1047,9,'3579e1f14e73b03bf42fa4d41fe654be1047','2021-05-26 05:05:27',NULL,'2021-05-10 23:48:27','2021-05-10 23:48:27'),(1048,2,'4398f467d37805d8e46f191f0cd463a11048','2021-05-26 05:05:51',NULL,'2021-05-10 23:51:51','2021-05-10 23:51:51'),(1049,2,'aa4e5de4d7c089f8c4295465fb9257761049','2021-05-26 09:05:13',NULL,'2021-05-11 03:41:13','2021-05-11 03:41:13'),(1050,1,'ea99b7303cba6c04076cc121d758d6c01050','2021-05-26 10:05:44',NULL,'2021-05-11 04:56:44','2021-05-11 04:56:44'),(1051,2,'6ef79878dbc5abbb14018575ff8789dd1051','2021-05-26 10:05:24',NULL,'2021-05-11 05:04:24','2021-05-11 05:04:24'),(1052,2,'d3ac020a79791d25859bd8db42f316d01052','2021-05-26 10:05:15',NULL,'2021-05-11 05:05:15','2021-05-11 05:05:15'),(1053,2,'c01eac17e676e8e510d280d9d4137f291053','2021-05-26 11:05:10',NULL,'2021-05-11 05:37:10','2021-05-11 05:37:10'),(1054,2,'7568da8300fc93952c7fbf68e57fc3f61054','2021-05-27 05:05:06',NULL,'2021-05-11 23:49:06','2021-05-11 23:49:07'),(1055,2,'aa03f932f9ca03783f9b2348cb1fb8ce1055','2021-05-27 05:05:59',NULL,'2021-05-11 23:51:59','2021-05-11 23:51:59'),(1056,2,'cf24e19a6aee9f74b821e93fefd65d0c1056','2021-05-27 06:05:21',NULL,'2021-05-12 00:41:21','2021-05-12 00:41:21'),(1057,9,'61c3081961e7e1d5bc376783fa8731761057','2021-05-27 06:05:43',NULL,'2021-05-12 00:56:43','2021-05-12 00:56:43'),(1058,9,'23f31859cedbd7f1d93a46b053f5f6111058','2021-05-27 06:05:07',NULL,'2021-05-12 01:22:07','2021-05-12 01:22:07'),(1059,8,'2363c46bb7a1c6e83a2847bdd8f7ce1a1059','2021-05-27 06:05:55',NULL,'2021-05-12 01:22:55','2021-05-12 01:22:55'),(1060,1,'444f92d03866c3b82853dfc297da491b1060','2021-05-27 07:05:09',NULL,'2021-05-12 01:31:09','2021-05-12 01:31:09'),(1061,6,'829273ceb1047e6aeb1c251784d3743a1061','2021-05-27 09:05:43',NULL,'2021-05-12 04:09:43','2021-05-12 04:09:43'),(1062,2,'5a05076b3713403e1e15d4d3b0f76cfa1062','2021-05-27 10:05:59',NULL,'2021-05-12 05:19:59','2021-05-12 05:19:59'),(1063,6,'427f28970d417521eeb88cbc7e149a351063','2021-05-27 11:05:02',NULL,'2021-05-12 05:59:02','2021-05-12 05:59:02'),(1064,1,'48ec7d8c45e952112833f5b800ec29e51064','2021-05-27 11:05:36',NULL,'2021-05-12 06:02:36','2021-05-12 06:02:36'),(1065,6,'1672075981a6ed36ec4063c3030821c31065','2021-05-27 11:05:21',NULL,'2021-05-12 06:07:21','2021-05-12 06:07:22'),(1066,10,'ec7fcd585c069eb4cbc310b481d3d7cc1066','2021-05-28 05:05:47',NULL,'2021-05-13 00:10:47','2021-05-13 00:10:47'),(1067,10,'dd7ac949a48d64eac5b83ac0025e21ba1067','2021-05-28 06:05:12',NULL,'2021-05-13 00:40:12','2021-05-13 00:40:12'),(1068,10,'63a6965af1fa908f55373e164865ab521068','2021-05-28 06:05:04',NULL,'2021-05-13 01:22:04','2021-05-13 01:22:04'),(1069,2,'b3cb91bf0acdef8e3658e74c9c4275f81069','2021-05-28 06:05:27',NULL,'2021-05-13 01:23:27','2021-05-13 01:23:27'),(1070,10,'e050f7f38363c9d4e9c29f06f8f2c40c1070','2021-05-28 08:05:34',NULL,'2021-05-13 03:11:34','2021-05-13 03:11:34'),(1071,2,'5b6797e5ce35dc566276ab8aa78c18221071','2021-05-28 08:05:27',NULL,'2021-05-13 03:19:27','2021-05-13 03:19:27'),(1072,1,'599edd8a2e16eca1dec86f3840006fb81072','2021-05-28 08:05:11',NULL,'2021-05-13 03:20:11','2021-05-13 03:20:11'),(1073,2,'53f61694474f18ee3d2f27cb0d5ac5fa1073','2021-05-28 08:05:27',NULL,'2021-05-13 03:21:27','2021-05-13 03:21:27'),(1074,1,'70a69ad20a186d3ec9f45ccbe67749631074','2021-05-28 08:05:20',NULL,'2021-05-13 03:22:20','2021-05-13 03:22:20'),(1075,2,'a4cba894e256bd7b723820cfd505c58a1075','2021-05-28 08:05:31',NULL,'2021-05-13 03:23:31','2021-05-13 03:23:31'),(1076,1,'3f2df920dc269513f9dbc57f5d6348d51076','2021-05-28 08:05:19',NULL,'2021-05-13 03:25:19','2021-05-13 03:25:19'),(1077,2,'63c812e31eeabf0c73e0abe423e145621077','2021-05-28 11:05:51',NULL,'2021-05-13 05:57:51','2021-05-13 05:57:51'),(1078,10,'840cd1a76ba075919638ccd2759f323b1078','2021-05-29 09:05:43',NULL,'2021-05-14 03:38:43','2021-05-14 03:38:43'),(1079,10,'65b16fa042ca9fd7849538863ac010c21079','2021-05-29 09:05:00',NULL,'2021-05-14 04:07:00','2021-05-14 04:07:00'),(1080,2,'697d76b5a51d75e71e03572740c3e3441080','2021-05-29 10:05:12',NULL,'2021-05-14 04:46:12','2021-05-14 04:46:12'),(1081,10,'f07976967be96834b5e4b27613cbbe681081','2021-05-29 10:05:47',NULL,'2021-05-14 04:59:47','2021-05-14 04:59:47'),(1082,2,'9168efe7755b653c7fe6aec3a22826861082','2021-05-29 10:05:03',NULL,'2021-05-14 05:03:03','2021-05-14 05:03:03'),(1083,10,'ab91316569569f23da89415004164f4d1083','2021-05-29 10:05:54',NULL,'2021-05-14 05:14:54','2021-05-14 05:14:54'),(1084,3,'ecec110093a6bd063dfd8ac0e7da33e01084','2021-05-29 11:05:29',NULL,'2021-05-14 06:00:29','2021-05-14 06:00:29'),(1085,10,'768809edc5ae623164c884f4108305771085','2021-05-29 11:05:32',NULL,'2021-05-14 06:02:32','2021-05-14 06:02:32'),(1086,13,'6b78cf285056e096814941aa10c7fefd1086','2021-05-29 11:05:45',NULL,'2021-05-14 06:08:45','2021-05-14 06:08:45'),(1087,10,'338b6c540a9dd824346d6fc1a9808aaa1087','2021-05-29 11:05:49',NULL,'2021-05-14 06:20:49','2021-05-14 06:20:49'),(1088,2,'87d399c976e45776f93c391ad14a5cad1088','2021-06-02 05:06:34',NULL,'2021-05-17 23:55:34','2021-05-17 23:55:35'),(1089,2,'350d3406bf43a56255c0ca7a1d35162e1089','2021-06-02 08:06:46',NULL,'2021-05-18 03:16:46','2021-05-18 03:16:46'),(1090,7,'fbab8d9b9d5294af2d1adb24e1ccfb5b1090','2021-06-02 09:06:55',NULL,'2021-05-18 04:11:55','2021-05-18 04:11:55'),(1091,2,'16d8e766694aeb1ab9a00ae117bd81941091','2021-06-02 11:06:56',NULL,'2021-05-18 05:40:56','2021-05-18 05:40:56'),(1092,9,'3a1113ee63e6782bb064e59e9e40ef291092','2021-06-02 11:06:57',NULL,'2021-05-18 06:02:57','2021-05-18 06:02:57'),(1093,8,'6c8e2bb4f598af82fa0c12043fe8df8d1093','2021-06-03 05:06:10',NULL,'2021-05-18 23:56:10','2021-05-18 23:56:10'),(1094,9,'c0035c82e0e7087a74a09d4aa4ace0951094','2021-06-03 05:06:00',NULL,'2021-05-19 00:04:00','2021-05-19 00:04:00'),(1095,2,'8a315d8ad9803480ed6115e567f370971095','2021-06-03 06:06:39',NULL,'2021-05-19 00:58:39','2021-05-19 00:58:39'),(1096,10,'664b67bb08477cf75804eb4ef11bd21a1096','2021-06-03 06:06:06',NULL,'2021-05-19 01:03:06','2021-05-19 01:03:06'),(1097,2,'34514ef04547aef91702ccb107a27ff71097','2021-06-03 06:06:42',NULL,'2021-05-19 01:17:42','2021-05-19 01:17:42'),(1098,2,'00f3e9621801920ac08f775e664d162d1098','2021-06-03 06:06:02',NULL,'2021-05-19 01:18:02','2021-05-19 01:18:02'),(1099,10,'f0677849fa4ea4c6273a48772e6a21d01099','2021-06-03 08:06:11',NULL,'2021-05-19 03:14:11','2021-05-19 03:14:11'),(1100,3,'b46ccfb78bc9724591c5db3ad4cc2e491100','2021-06-03 09:06:35',NULL,'2021-05-19 03:38:35','2021-05-19 03:38:35'),(1101,1,'e97afdf109c6db1b97a8a303329e20a01101','2021-06-03 09:06:51',NULL,'2021-05-19 03:42:51','2021-05-19 03:42:51'),(1102,10,'151414ef18dac900f48256ef2938f0841102','2021-06-12 07:06:23',NULL,'2021-05-28 01:32:23','2021-05-28 01:32:23'),(1103,10,'e3a98fd566ef6deeddf9ddd602d0765f1103','2021-06-12 09:06:22',NULL,'2021-05-28 04:18:22','2021-05-28 04:18:22'),(1104,3,'bf446e81615f61a3267312e694443fa41104','2021-06-12 10:06:53',NULL,'2021-05-28 05:14:53','2021-05-28 05:14:53'),(1105,10,'7894c9b8fc79f2e2c4033f2f31c849d31105','2021-06-15 04:06:46',NULL,'2021-05-30 23:16:46','2021-05-30 23:16:46'),(1106,9,'af98ba21c822807ed0a227ade364b4a21106','2021-06-15 05:06:05',NULL,'2021-05-30 23:32:05','2021-05-30 23:32:05'),(1107,7,'2e1de24dbbcc3c01b2d43fb42df4e3f71107','2021-06-15 05:06:05',NULL,'2021-05-30 23:33:05','2021-05-30 23:33:05'),(1108,2,'230f60592d5a381807bcbe8d806e0abe1108','2021-06-15 06:06:11',NULL,'2021-05-31 00:39:11','2021-05-31 00:39:11'),(1109,2,'daaeb027473f4d1cf6ca4ce0e1ee9b2c1109','2021-06-15 06:06:13',NULL,'2021-05-31 00:53:13','2021-05-31 00:53:13'),(1110,2,'f297c05975d8716605b09a33f01a40511110','2021-06-15 09:06:12',NULL,'2021-05-31 04:12:12','2021-05-31 04:12:12'),(1111,2,'03bd9eeed490f6ee8ee6ea463d3cf1611111','2021-06-15 10:06:58',NULL,'2021-05-31 05:28:58','2021-05-31 05:28:58'),(1112,8,'8b2471d074a2600129d173dbbe1600e51112','2021-06-15 11:06:49',NULL,'2021-05-31 05:55:49','2021-05-31 05:55:49'),(1113,2,'c2b223a4ace2cd3b83fd706e2f631b1f1113','2021-06-15 11:06:46',NULL,'2021-05-31 06:09:46','2021-05-31 06:09:46'),(1114,1,'9a43f4b7171e9a8274318683d044a0381114','2021-06-15 11:06:54',NULL,'2021-05-31 06:11:54','2021-05-31 06:11:54'),(1115,8,'564f9c60e8b94407844a69dfbd3b862e1115','2021-06-16 06:06:15',NULL,'2021-06-01 00:32:15','2021-06-01 00:32:15'),(1116,4,'1b466dd48dedab8e83d605bc48ef6dc91116','2021-06-16 06:06:56',NULL,'2021-06-01 00:32:56','2021-06-01 00:32:56'),(1117,10,'c5ceacbbcec47297b65af0033e11ba941117','2021-06-17 06:06:46',NULL,'2021-06-02 00:39:46','2021-06-02 00:39:46'),(1118,2,'1b998b4b24ba55ca072cbb0427559ddd1118','2021-06-17 06:06:00',NULL,'2021-06-02 00:41:00','2021-06-02 00:41:00'),(1119,3,'45a76e42cdaa98252e8deb72a27d8dc61119','2021-06-17 06:06:15',NULL,'2021-06-02 00:47:15','2021-06-02 00:47:15'),(1120,4,'1ed9619301c30d8edb473379714496421120','2021-06-17 06:06:09',NULL,'2021-06-02 00:48:09','2021-06-02 00:48:09'),(1121,13,'cb2d196dbd86304d10d8a14378adc8c11121','2021-06-17 06:06:45',NULL,'2021-06-02 00:48:45','2021-06-02 00:48:45'),(1122,5,'1e226147f4bfcc399f029c89e5ce0baa1122','2021-06-17 06:06:23',NULL,'2021-06-02 00:49:23','2021-06-02 00:49:23'),(1123,6,'6703df26c6a8e26b7d447b7afc12c5a41123','2021-06-17 06:06:09',NULL,'2021-06-02 00:50:09','2021-06-02 00:50:09'),(1124,5,'965aafbaae24cff80466dcc89d6137ec1124','2021-06-17 06:06:39',NULL,'2021-06-02 00:50:39','2021-06-02 00:50:39'),(1125,6,'4e545466f1c2db220073b567660938c61125','2021-06-17 06:06:24',NULL,'2021-06-02 00:51:24','2021-06-02 00:51:24'),(1126,8,'b4d06ea796657314e14f7c7c52384a381126','2021-06-17 06:06:19',NULL,'2021-06-02 00:52:19','2021-06-02 00:52:19'),(1127,9,'8cc0bf1f494a15a68fa0a3802b6206591127','2021-06-17 06:06:59',NULL,'2021-06-02 00:53:59','2021-06-02 00:53:59'),(1128,8,'b666e7e899912f811c7b1c463a2c8c061128','2021-06-17 06:06:21',NULL,'2021-06-02 00:55:21','2021-06-02 00:55:21'),(1129,6,'0b638a45df33dac69cd21c4f9d3a4e0c1129','2021-06-17 06:06:32',NULL,'2021-06-02 00:56:32','2021-06-02 00:56:32'),(1130,2,'52264b4a9e1fa6f0a30454fa70998f0d1130','2021-06-17 06:06:30',NULL,'2021-06-02 00:57:30','2021-06-02 00:57:30'),(1131,10,'1c5bd1f4d3d3352c1c7f03addae056b41131','2021-06-17 06:06:56',NULL,'2021-06-02 00:59:56','2021-06-02 00:59:56'),(1132,2,'3d70b6e79a0ff433c89ec2bd15161c021132','2021-06-17 07:06:52',NULL,'2021-06-02 01:47:53','2021-06-02 01:47:53'),(1133,1,'5634c464fc732828937fcabc1e5131181133','2021-06-17 07:06:44',NULL,'2021-06-02 01:57:44','2021-06-02 01:57:44'),(1134,1,'8bc5bcd5c6e0f10704464eea8e4d915a1134','2021-06-17 08:06:31',NULL,'2021-06-02 03:13:31','2021-06-02 03:13:31'),(1135,1,'88b5c82730fa6acf86576f95c6aed3e71135','2021-06-17 09:06:58',NULL,'2021-06-02 04:00:58','2021-06-02 04:00:58'),(1136,2,'859fd508712b421f5de4c50c0aa6aab41136','2021-06-18 12:06:17',NULL,'2021-06-03 06:46:17','2021-06-03 06:46:17'),(1137,9,'b405418d7a4f1cf5f780936201aef71a1137','2021-06-18 13:06:29',NULL,'2021-06-03 07:44:29','2021-06-03 07:44:29'),(1138,13,'fce3ec128defa6fdbdb28d4d201712601138','2021-06-19 05:06:48',NULL,'2021-06-03 23:36:48','2021-06-03 23:36:48'),(1139,6,'35e9266a89df27ed9159a58aca879b391139','2021-06-19 05:06:58',NULL,'2021-06-03 23:37:58','2021-06-03 23:37:58'),(1140,8,'e6fa50606fcd3c5cc8e264ac1a215ad21140','2021-06-19 05:06:44',NULL,'2021-06-04 00:27:44','2021-06-04 00:27:45'),(1141,2,'b9653b71d55c3b9987b5f7c44a7b5b281141','2021-06-19 12:06:20',NULL,'2021-06-04 06:56:20','2021-06-04 06:56:20'),(1142,2,'fe8e80187a3b2603d821026c96e0ce091142','2021-06-19 13:06:49',NULL,'2021-06-04 07:34:49','2021-06-04 07:34:49'),(1143,2,'2903cb54df1f75361d027166380e198b1143','2021-06-23 06:06:40',NULL,'2021-06-08 00:46:40','2021-06-08 00:46:40'),(1144,1,'b3d313d36196cda83488a3ff5cef69561144','2021-06-24 05:06:57',NULL,'2021-06-09 00:01:57','2021-06-09 00:01:57'),(1145,1,'c3844db5d36c40e8bd0be2e7934746e01145','2021-06-24 08:06:56',NULL,'2021-06-09 03:24:56','2021-06-09 03:24:56'),(1146,2,'6e35600483b98019afd863aed9cd2d351146','2021-06-24 09:06:11',NULL,'2021-06-09 04:10:11','2021-06-09 04:10:11'),(1147,2,'7e1031effd26d1c733cf9c9c4ed2d8d91147','2021-06-25 04:06:00',NULL,'2021-06-09 23:11:00','2021-06-09 23:11:00'),(1148,1,'ee1c5f4d22f3dbfd5b00a3200aa5837b1148','2021-06-25 04:06:31',NULL,'2021-06-09 23:14:31','2021-06-09 23:14:31'),(1149,2,'ab3ff22ebec4575a9d0f1d1d46df3d0b1149','2021-06-25 04:06:52',NULL,'2021-06-09 23:15:52','2021-06-09 23:15:52'),(1150,1,'2257a55ff39f1a07cfbff7a9acb199151150','2021-06-26 06:06:06',NULL,'2021-06-11 01:00:06','2021-06-11 01:00:07'),(1151,2,'fca8d501698fc9da65146460ff2668e31151','2021-06-26 06:06:13',NULL,'2021-06-11 01:01:13','2021-06-11 01:01:13'),(1152,3,'dd0a63ef2241c928185bcfaf17ca3c421152','2021-06-26 06:06:17',NULL,'2021-06-11 01:03:17','2021-06-11 01:03:17'),(1153,4,'edb753ae502a13b6054e71cc9fa1c6251153','2021-06-26 06:06:46',NULL,'2021-06-11 01:04:46','2021-06-11 01:04:46'),(1154,13,'42b5e39fa757ea6b740ac7242f3dfad01154','2021-06-26 06:06:11',NULL,'2021-06-11 01:06:11','2021-06-11 01:06:11'),(1155,5,'a8eb6b55664c298e570c8195779de8cd1155','2021-06-26 06:06:37',NULL,'2021-06-11 01:07:37','2021-06-11 01:07:37'),(1156,6,'7ef6119eb4090e0b3dc897685539db281156','2021-06-26 06:06:51',NULL,'2021-06-11 01:08:51','2021-06-11 01:08:51'),(1157,8,'38615f37a1a12c1366df6e47e30b780f1157','2021-06-26 06:06:59',NULL,'2021-06-11 01:09:59','2021-06-11 01:09:59'),(1158,9,'58ecf98327f3a14835bdcd497a8d03ac1158','2021-06-26 06:06:06',NULL,'2021-06-11 01:11:06','2021-06-11 01:11:06'),(1159,8,'eeedc053c4515ac7d790cb6baa135ccf1159','2021-06-26 06:06:30',NULL,'2021-06-11 01:28:30','2021-06-11 01:28:30'),(1160,8,'2dc500241503570992dd1470f49176b91160','2021-06-26 07:06:21',NULL,'2021-06-11 02:09:21','2021-06-11 02:09:21'),(1161,6,'0790f4944214f3f49c7a7a27df82f7fe1161','2021-06-26 07:06:54',NULL,'2021-06-11 02:12:54','2021-06-11 02:12:54'),(1162,1,'97d5c277695bf1e30cdf03514855aa491162','2021-06-26 07:06:11',NULL,'2021-06-11 02:14:11','2021-06-11 02:14:11'),(1163,2,'3ae0fd1bf6f2835043d34dbdee760be61163','2021-06-26 08:06:00',NULL,'2021-06-11 02:31:00','2021-06-11 02:31:00'),(1164,10,'7d9822382df95b5921e0b7330a22cfb01164','2021-06-26 08:06:50',NULL,'2021-06-11 02:32:50','2021-06-11 02:32:50'),(1165,10,'54bf6e609d69a08dbd584a140bc6c6091165','2021-06-26 10:06:23',NULL,'2021-06-11 04:33:23','2021-06-11 04:33:23'),(1166,1,'5187e0c29dd12d92c6a70f6c9f58e62b1166','2021-06-29 07:06:08',NULL,'2021-06-14 01:47:08','2021-06-14 01:47:08'),(1167,1,'b31303845923dffd6a06deb943abf61d1167','2021-07-12 07:07:06',NULL,'2021-06-27 02:10:06','2021-06-27 02:10:06'),(1168,1,'d27e509bf3ef876db7517dce89b4914d1168','2021-07-12 07:07:00',NULL,'2021-06-27 02:13:00','2021-06-27 02:13:00');
/*!40000 ALTER TABLE `refresh_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permissions_relationship`
--

DROP TABLE IF EXISTS `role_permissions_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_permissions_relationship` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `role_permissions_relationship_role_id_index` (`role_id`),
  KEY `role_permissions_relationship_permission_id_index` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permissions_relationship`
--

LOCK TABLES `role_permissions_relationship` WRITE;
/*!40000 ALTER TABLE `role_permissions_relationship` DISABLE KEYS */;
INSERT INTO `role_permissions_relationship` VALUES (3,18,'2020-12-16 05:02:18','2020-12-16 05:02:18'),(3,28,'2020-12-16 05:02:18','2020-12-16 05:02:18'),(3,29,'2020-12-16 05:02:18','2020-12-16 05:02:18'),(4,13,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,14,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,15,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,16,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,17,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,18,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,26,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,27,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,28,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,29,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,31,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,39,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,40,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(4,48,'2021-01-25 05:50:04','2021-01-25 05:50:04'),(11,52,'2021-02-22 00:26:38','2021-02-22 00:26:38'),(11,53,'2021-02-22 00:26:38','2021-02-22 00:26:38'),(11,54,'2021-02-22 00:26:38','2021-02-22 00:26:38'),(11,55,'2021-02-22 00:26:38','2021-02-22 00:26:38'),(7,18,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(7,33,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(7,34,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(7,36,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(7,37,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(7,38,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(7,39,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(2,9,'2021-05-12 06:06:35','2021-05-12 06:06:35'),(2,15,'2021-05-12 06:06:35','2021-05-12 06:06:35'),(2,18,'2021-05-12 06:06:35','2021-05-12 06:06:35'),(2,28,'2021-05-12 06:06:35','2021-05-12 06:06:35'),(2,47,'2021-05-12 06:06:35','2021-05-12 06:06:35'),(2,36,'2021-05-12 06:06:35','2021-05-12 06:06:35'),(5,18,'2021-05-12 06:06:53','2021-05-12 06:06:53'),(5,31,'2021-05-12 06:06:53','2021-05-12 06:06:53'),(5,47,'2021-05-12 06:06:53','2021-05-12 06:06:53'),(5,50,'2021-05-12 06:06:53','2021-05-12 06:06:53'),(6,13,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,14,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,15,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,16,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,17,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,18,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,19,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,20,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,21,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,22,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,23,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,24,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,25,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,31,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,32,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,33,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,46,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,48,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,49,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(6,51,'2021-05-13 03:21:08','2021-05-13 03:21:08');
/*!40000 ALTER TABLE `role_permissions_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sanction_letter_history`
--

DROP TABLE IF EXISTS `sanction_letter_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sanction_letter_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sanction_letter_id` bigint(20) unsigned NOT NULL,
  `snd_id` bigint(20) unsigned NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `state_id` tinyint(3) unsigned NOT NULL,
  `file_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `financial_year` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sanctioned_date` date NOT NULL,
  `sanctioned_amount` decimal(15,4) NOT NULL,
  `released_amount` decimal(15,4) NOT NULL,
  `balance_amount` decimal(15,4) NOT NULL,
  `is_inprincipal` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sanction_letter_history_user_id_index` (`user_id`),
  KEY `sanction_letter_history_state_id_index` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sanction_letter_history`
--

LOCK TABLES `sanction_letter_history` WRITE;
/*!40000 ALTER TABLE `sanction_letter_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `sanction_letter_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scrutiny_level_mfp_procurement_history`
--

DROP TABLE IF EXISTS `scrutiny_level_mfp_procurement_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scrutiny_level_mfp_procurement_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mfp_procurement_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `sublevel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scrutiny_level_mfp_procurement_history`
--

LOCK TABLES `scrutiny_level_mfp_procurement_history` WRITE;
/*!40000 ALTER TABLE `scrutiny_level_mfp_procurement_history` DISABLE KEYS */;
INSERT INTO `scrutiny_level_mfp_procurement_history` VALUES (1,1,23,1,6,1,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL),(2,1,23,1,6,2,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL),(3,1,23,1,6,3,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL),(4,1,23,2,5,1,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL),(5,1,23,2,5,2,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL),(6,1,23,3,4,2,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL),(7,1,23,4,3,1,'2021-06-11 01:01:57','2021-06-11 01:01:57',NULL);
/*!40000 ALTER TABLE `scrutiny_level_mfp_procurement_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shg_bank_account_details`
--

DROP TABLE IF EXISTS `shg_bank_account_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shg_bank_account_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shg_id` bigint(20) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(18) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landline_no` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_self` enum('1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specify_other` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_type` int(11) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL DEFAULT 0,
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shg_bank_account_details_shg_id_index` (`shg_id`),
  KEY `shg_bank_account_details_phone_type_index` (`phone_type`),
  KEY `shg_bank_account_details_created_by_index` (`created_by`),
  KEY `shg_bank_account_details_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shg_bank_account_details`
--

LOCK TABLES `shg_bank_account_details` WRITE;
/*!40000 ALTER TABLE `shg_bank_account_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `shg_bank_account_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shg_gatherer_groups_relation`
--

DROP TABLE IF EXISTS `shg_gatherer_groups_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shg_gatherer_groups_relation` (
  `group_id` int(11) NOT NULL,
  `shg_id` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `shg_gatherer_groups_relation_group_id_index` (`group_id`),
  KEY `shg_gatherer_groups_relation_shg_id_index` (`shg_id`),
  KEY `shg_gatherer_groups_relation_created_by_index` (`created_by`),
  KEY `shg_gatherer_groups_relation_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shg_gatherer_groups_relation`
--

LOCK TABLES `shg_gatherer_groups_relation` WRITE;
/*!40000 ALTER TABLE `shg_gatherer_groups_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `shg_gatherer_groups_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shg_gatherers`
--

DROP TABLE IF EXISTS `shg_gatherers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shg_gatherers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_of_tribal` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `tribal_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_year` int(11) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `is_mobile` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_value` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `district` bigint(20) NOT NULL,
  `block` bigint(20) NOT NULL,
  `gram_panchayat` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `village` int(11) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `education` int(11) NOT NULL,
  `occupation` int(11) NOT NULL,
  `existing_membership` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shg_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shg_nrlm_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shg_other_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_office_bearer` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bearer_role` int(11) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `is_ews` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_name` int(11) DEFAULT NULL,
  `is_gathering_mfp` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_members` tinyint(4) DEFAULT NULL,
  `name_of_proposed` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `financial_year` int(11) DEFAULT NULL,
  `is_married` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_type` int(11) NOT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_id` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted_from` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=>Vdvk,1=>MSP',
  `created_by` bigint(20) unsigned NOT NULL DEFAULT 0,
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shg_gatherers_state_index` (`state`),
  KEY `shg_gatherers_district_index` (`district`),
  KEY `shg_gatherers_block_index` (`block`),
  KEY `shg_gatherers_education_index` (`education`),
  KEY `shg_gatherers_occupation_index` (`occupation`),
  KEY `shg_gatherers_bearer_role_index` (`bearer_role`),
  KEY `shg_gatherers_category_index` (`category`),
  KEY `shg_gatherers_vehicle_type_index` (`vehicle_type`),
  KEY `shg_gatherers_created_by_index` (`created_by`),
  KEY `shg_gatherers_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shg_gatherers`
--

LOCK TABLES `shg_gatherers` WRITE;
/*!40000 ALTER TABLE `shg_gatherers` DISABLE KEYS */;
/*!40000 ALTER TABLE `shg_gatherers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state_level_fund_flow_relationship`
--

DROP TABLE IF EXISTS `state_level_fund_flow_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state_level_fund_flow_relationship` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` tinyint(4) NOT NULL,
  `level_id` tinyint(4) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_level_fund_flow_relationship_state_id_index` (`state_id`),
  KEY `state_level_fund_flow_relationship_level_id_index` (`level_id`),
  KEY `state_level_fund_flow_relationship_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state_level_fund_flow_relationship`
--

LOCK TABLES `state_level_fund_flow_relationship` WRITE;
/*!40000 ALTER TABLE `state_level_fund_flow_relationship` DISABLE KEYS */;
/*!40000 ALTER TABLE `state_level_fund_flow_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state_level_role_relationship`
--

DROP TABLE IF EXISTS `state_level_role_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state_level_role_relationship` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` tinyint(4) NOT NULL,
  `level_id` tinyint(4) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_level_role_relationship_state_id_index` (`state_id`),
  KEY `state_level_role_relationship_level_id_index` (`level_id`),
  KEY `state_level_role_relationship_role_id_index` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state_level_role_relationship`
--

LOCK TABLES `state_level_role_relationship` WRITE;
/*!40000 ALTER TABLE `state_level_role_relationship` DISABLE KEYS */;
INSERT INTO `state_level_role_relationship` VALUES (39,1,1,6,0,0,'2020-10-13 04:11:59','2020-10-13 04:11:59',NULL),(40,1,2,5,0,0,'2020-10-13 04:11:59','2020-10-13 04:11:59',NULL),(41,1,3,4,0,0,'2020-10-13 04:11:59','2020-10-13 04:11:59',NULL),(43,5,1,6,0,0,'2020-10-13 04:12:32','2020-10-13 04:12:32',NULL),(76,23,1,6,0,0,'2021-02-26 06:48:52','2021-02-26 06:48:52',NULL),(77,23,2,5,0,0,'2021-02-26 06:48:52','2021-02-26 06:48:52',NULL),(78,23,3,4,0,0,'2021-02-26 06:48:52','2021-02-26 06:48:52',NULL),(79,23,4,3,0,0,'2021-02-26 06:48:52','2021-02-26 06:48:52',NULL);
/*!40000 ALTER TABLE `state_level_role_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state_role_sublevel`
--

DROP TABLE IF EXISTS `state_role_sublevel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state_role_sublevel` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `statelevel_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `sublevel_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state_role_sublevel`
--

LOCK TABLES `state_role_sublevel` WRITE;
/*!40000 ALTER TABLE `state_role_sublevel` DISABLE KEYS */;
INSERT INTO `state_role_sublevel` VALUES (81,39,1,1,0,1,'2020-10-13 04:11:59','2020-10-13 04:11:59'),(82,39,1,1,0,2,'2020-10-13 04:11:59','2020-10-13 04:11:59'),(83,40,1,2,0,1,'2020-10-13 04:11:59','2020-10-13 04:11:59'),(84,41,1,3,0,1,'2020-10-13 04:11:59','2020-10-13 04:11:59'),(87,43,5,1,0,1,'2020-10-13 04:12:32','2020-10-13 04:12:32'),(88,43,5,1,0,2,'2020-10-13 04:12:32','2020-10-13 04:12:32'),(89,43,5,1,0,3,'2020-10-13 04:12:32','2020-10-13 04:12:32'),(145,76,23,1,6,1,'2021-02-26 06:48:52','2021-02-26 06:48:52'),(146,76,23,1,6,2,'2021-02-26 06:48:52','2021-02-26 06:48:52'),(147,76,23,1,6,3,'2021-02-26 06:48:52','2021-02-26 06:48:52'),(148,77,23,2,5,1,'2021-02-26 06:48:52','2021-02-26 06:48:52'),(149,77,23,2,5,2,'2021-02-26 06:48:52','2021-02-26 06:48:52'),(150,78,23,3,4,2,'2021-02-26 06:48:52','2021-02-26 06:48:52'),(151,79,23,4,3,1,'2021-02-26 06:48:52','2021-02-26 06:48:52');
/*!40000 ALTER TABLE `state_role_sublevel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states_master`
--

DROP TABLE IF EXISTS `states_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states_master` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `states_master_created_by_index` (`created_by`),
  KEY `states_master_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states_master`
--

LOCK TABLES `states_master` WRITE;
/*!40000 ALTER TABLE `states_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `states_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_bank_details`
--

DROP TABLE IF EXISTS `user_bank_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_bank_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ac_holder_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ac_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_bank_details_bank_ac_no_unique` (`bank_ac_no`),
  KEY `user_bank_details_user_id_index` (`user_id`),
  KEY `user_bank_details_created_by_index` (`created_by`),
  KEY `user_bank_details_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_bank_details`
--

LOCK TABLES `user_bank_details` WRITE;
/*!40000 ALTER TABLE `user_bank_details` DISABLE KEYS */;
INSERT INTO `user_bank_details` VALUES (1,10,'ANURAG',NULL,'PNB','0774001500260590','PNB0056',NULL,2,1,NULL,'2020-12-02 01:04:33','2021-01-05 03:20:52'),(2,11,'dfgfgd',NULL,'dfgdfg','345543345543','dfg34543',NULL,8,8,NULL,'2021-01-12 23:20:54','2021-01-12 23:20:54'),(3,1,NULL,'test',NULL,NULL,NULL,'9874563210',0,0,NULL,'2021-01-21 03:37:07','2021-01-21 03:37:20');
/*!40000 ALTER TABLE `user_bank_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `pin_code` int(11) DEFAULT NULL,
  `landline_no` bigint(20) DEFAULT NULL,
  `id_proof_type` int(11) DEFAULT NULL,
  `id_proof_value` varchar(17) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_details_user_id_index` (`user_id`),
  KEY `user_details_id_proof_type_index` (`id_proof_type`),
  KEY `user_details_department_index` (`department`),
  KEY `user_details_designation_index` (`designation`),
  KEY `user_details_created_by_index` (`created_by`),
  KEY `user_details_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,1,NULL,1,1,1,NULL,NULL,1,'1','fgfg',NULL,NULL,0,0,NULL,NULL,'2021-01-21 03:37:07'),(2,2,'1990-01-02',23,414,0,NULL,NULL,1,'123654851563','test',1,2,1,1,NULL,'2020-10-12 03:35:28','2020-11-30 05:48:00'),(3,3,'1990-01-05',23,414,0,NULL,NULL,1,'632598745266','tt',1,1,1,1,NULL,'2020-10-12 04:08:22','2020-10-15 23:57:59'),(4,4,'1990-02-07',23,414,0,NULL,NULL,1,'658965412365','modinagar',1,1,1,1,NULL,'2020-10-15 23:48:17','2020-10-15 23:48:32'),(5,5,'1980-06-03',23,0,0,NULL,NULL,1,'563214587456','ok',1,1,1,1,NULL,'2020-10-15 23:54:55','2020-10-15 23:55:16'),(6,6,'1980-06-09',23,NULL,0,NULL,NULL,1,'125632547896','ok',1,1,1,1,NULL,'2020-10-15 23:57:15','2020-10-15 23:57:15'),(7,7,'1990-02-06',23,NULL,0,NULL,NULL,1,'325641259632','ok',1,1,1,1,NULL,'2020-10-16 00:00:12','2020-10-16 00:00:12'),(8,8,'1980-06-10',23,NULL,0,NULL,NULL,1,'325698521456','dd',1,1,1,1,NULL,'2020-10-16 00:02:12','2020-10-16 00:02:12'),(9,9,'1990-06-05',NULL,NULL,0,NULL,NULL,1,'325698745221','ll',1,2,1,1,NULL,'2020-10-16 00:03:48','2020-10-16 00:03:48'),(10,10,'1990-01-01',23,414,0,NULL,NULL,1,'521456325412','ok',1,1,2,1,NULL,'2020-12-02 01:04:33','2021-01-05 03:20:52'),(11,11,'1987-11-14',23,414,0,NULL,NULL,1,'456321123654','gali number 5,block b ,Rishabh Vihar\r\nmodinagar',1,1,8,8,NULL,'2021-01-12 23:20:54','2021-01-12 23:23:16'),(12,12,'1980-03-05',0,0,0,NULL,NULL,5,'4563214563','dfgdfg',1,1,1,1,NULL,'2021-01-21 03:18:57','2021-01-21 03:19:15'),(13,13,'1980-02-05',23,414,0,NULL,NULL,1,'123654789258','sdfg',1,1,1,1,NULL,'2021-01-21 06:24:14','2021-01-21 06:24:14'),(18,18,'1990-02-05',23,414,0,NULL,NULL,1,'456852145632','Modinagar',1,1,1,1,NULL,'2021-02-04 00:44:52','2021-02-04 01:23:28'),(19,1,'1990-01-02',0,0,0,NULL,NULL,1,'123654851543','test',1,2,1,1,NULL,'2020-10-12 03:35:28','2020-11-30 05:48:00');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mapped_to_haatbazaar`
--

DROP TABLE IF EXISTS `user_mapped_to_haatbazaar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_mapped_to_haatbazaar` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `haat_bazaar_id` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mapped_to_haatbazaar`
--

LOCK TABLES `user_mapped_to_haatbazaar` WRITE;
/*!40000 ALTER TABLE `user_mapped_to_haatbazaar` DISABLE KEYS */;
INSERT INTO `user_mapped_to_haatbazaar` VALUES (6,18,2,1,1,'2021-02-04 01:23:28','2021-02-04 01:23:28'),(7,18,1,1,1,'2021-02-04 01:23:28','2021-02-04 01:23:28');
/*!40000 ALTER TABLE `user_mapped_to_haatbazaar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_mapped_to_warehouse`
--

DROP TABLE IF EXISTS `user_mapped_to_warehouse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_mapped_to_warehouse` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_mapped_to_warehouse`
--

LOCK TABLES `user_mapped_to_warehouse` WRITE;
/*!40000 ALTER TABLE `user_mapped_to_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_mapped_to_warehouse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_password_history`
--

DROP TABLE IF EXISTS `user_password_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_password_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `hash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_password_history`
--

LOCK TABLES `user_password_history` WRITE;
/*!40000 ALTER TABLE `user_password_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_password_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions_relationship`
--

DROP TABLE IF EXISTS `user_permissions_relationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permissions_relationship` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `user_permissions_relationship_user_id_index` (`user_id`),
  KEY `user_permissions_relationship_permission_id_index` (`permission_id`),
  KEY `user_permissions_relationship_created_by_index` (`created_by`),
  KEY `user_permissions_relationship_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions_relationship`
--

LOCK TABLES `user_permissions_relationship` WRITE;
/*!40000 ALTER TABLE `user_permissions_relationship` DISABLE KEYS */;
INSERT INTO `user_permissions_relationship` VALUES (18,52,1,0,'2021-02-22 00:48:38','2021-02-22 00:48:38'),(18,53,1,0,'2021-02-22 00:48:38','2021-02-22 00:48:38'),(18,54,1,0,'2021-02-22 00:48:38','2021-02-22 00:48:38'),(18,55,1,0,'2021-02-22 00:48:38','2021-02-22 00:48:38'),(10,18,1,0,'2021-03-03 04:14:29','2021-03-03 04:14:29'),(10,33,1,0,'2021-03-03 04:14:29','2021-03-03 04:14:29'),(10,34,1,0,'2021-03-03 04:14:29','2021-03-03 04:14:29'),(10,36,1,0,'2021-03-03 04:14:29','2021-03-03 04:14:29'),(10,37,1,0,'2021-03-03 04:14:29','2021-03-03 04:14:29'),(10,38,1,0,'2021-03-03 04:14:29','2021-03-03 04:14:29'),(10,39,1,0,'2021-03-03 04:14:29','2021-03-03 04:14:29'),(2,13,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,14,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,15,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,16,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,17,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,18,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,19,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,20,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,31,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,32,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,33,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,46,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,48,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,49,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15'),(2,51,1,0,'2021-05-13 03:23:15','2021-05-13 03:23:15');
/*!40000 ALTER TABLE `user_permissions_relationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_type` enum('2','1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_roles_created_by_index` (`created_by`),
  KEY `user_roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'Super Administrator','super_admin','','0','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(2,'TRIFED User','trifed_user','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(3,'Ministry User','ministry_user','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(4,'Nodal Department','nd','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(5,'State Implementing Agent','sia','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(6,'District Implementation Agency/Implementation Agency','district_inspection_agency','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(7,'Procurement Agent','procurement_agent','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(8,'Auction Committee','auction_committee','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(9,'Warehouse User','warehouse_user','','1','1',1,1,NULL,'2020-10-09 05:02:09','2020-10-09 05:02:09'),(10,'Buyer','buyer','','1','1',1,1,NULL,'2020-10-09 05:02:10','2020-10-09 05:02:10'),(11,'Trade Surveyors','trade_surveyor','','1','1',1,1,NULL,'2020-10-09 05:02:10','2020-10-09 05:02:10');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(3) unsigned NOT NULL,
  `level_id` tinyint(4) DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verify_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `failed_attempts` tinyint(1) NOT NULL DEFAULT 0,
  `blocked_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_index` (`role`),
  KEY `users_created_by_index` (`created_by`),
  KEY `users_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'super.admin','Super',NULL,'admin','anuragkrgupta14@gamil.com',1,NULL,0,0,'1','9910785273',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'testemailtoken1',NULL,'2021-06-04 08:24:07',NULL,0,NULL),(2,'dia_manipur','dai',NULL,'manipur','dia_manipur@yopmail.com',6,NULL,1,1,'1','4569874563',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'dia_manipur@yopmail.com','2020-10-12 03:35:28','2020-10-12 04:30:24',NULL,0,NULL),(3,'dia_manipur_level1','dia',NULL,'manipur','dia_+manipur2@yopmail.com',6,1,1,1,'1','8569874521',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'dia_+manipur2@yopmail.com','2020-10-12 04:08:22','2020-10-15 23:57:59',NULL,0,NULL),(4,'dia_manipur_level2','dia','manipur','level','dia_manipur_level2@yopmail.com',6,2,1,1,'1','2563214563',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'dia_manipur_level2@yopmail.com','2020-10-15 23:48:17','2020-10-15 23:48:17',NULL,0,NULL),(5,'sia_manipur_level1','sia','manipur','levelone','sia_manipur_level1@yopmail.com',5,1,1,1,'1','5823645698',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'sia_manipur_level1@yopmail.com','2020-10-15 23:54:55','2020-10-15 23:54:55',NULL,0,NULL),(6,'sia_manipur_level2','sia','maniour','level two','sia_manipur_level2@yopmail.com',5,2,1,1,'1','6325698745',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'sia_manipur_level2@yopmail.com','2020-10-15 23:57:15','2020-10-15 23:57:15',NULL,0,NULL),(7,'nodal_manipur_level1','nodal','manipur','level one','nodal_manipur_level1@yopmail.com',4,1,1,1,'1','6589654785',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'nodal_manipur_level1@yopmail.com','2020-10-16 00:00:12','2020-10-16 00:00:12',NULL,0,NULL),(8,'nodal_manipur_level2','nodal','manipur','leveltwo','nodal_manipur_level2@yopmail.com',4,2,1,1,'1','4521458745',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'nodal_manipur_level2@yopmail.com','2020-10-16 00:02:12','2020-10-16 00:02:12',NULL,0,NULL),(9,'ministry','ministry',NULL,'user','ministry@yopmail.com',3,1,1,1,'1','5214563258',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'ministry@yopmail.com','2020-10-16 00:03:48','2020-10-16 00:03:48',NULL,0,NULL),(10,'pa_senapati','pa',NULL,'agent','pa@yopmail.com',7,1,2,1,'1','4569874563',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'pa@yopmail.com','2020-12-02 01:04:33','2021-01-05 03:20:52',NULL,0,NULL),(11,'auction_committee','Anurag',NULL,NULL,'anuragkrgupta14@gmail.com',8,NULL,8,8,'1','6396989896',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'anuragkrgupta14@gmail.com','2021-01-12 23:20:54','2021-01-12 23:20:54',NULL,0,NULL),(12,'trifed_user_test','trifed',NULL,'test','trifed_user_test@yopmail.com',2,1,1,1,'1','4565654878',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'trifed_user_test@yopmail.com','2021-01-21 03:18:57','2021-01-21 03:18:57',NULL,0,NULL),(13,'dia_manipur_level3','dia',NULL,'level','dia_manipur_level3@yopmail.com',6,3,1,1,'1','4569874569',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'dia_manipur_level3@yopmail.com','2021-01-21 06:24:13','2021-01-21 06:24:13',NULL,0,NULL),(18,'trader_manipurone','trader',NULL,'manipur','trader1_manipur@uneecops.com',11,NULL,1,1,'1','4569874563',NULL,'$2y$10$J07HYSKSIWyjsMKKNFB5Jew0ZvE5j1zHyrJri.fR/2O6EB4zwrVyG',NULL,'trader1_manipur@uneecops.com','2021-02-04 00:44:52','2021-02-04 00:44:52',NULL,0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_activity`
--

DROP TABLE IF EXISTS `users_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_activity` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL DEFAULT 0,
  `updated_by` bigint(20) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_activity_created_by_index` (`created_by`),
  KEY `users_activity_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3751 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_activity`
--

LOCK TABLES `users_activity` WRITE;
/*!40000 ALTER TABLE `users_activity` DISABLE KEYS */;
INSERT INTO `users_activity` VALUES (1,1,'127.0.0.1','Login',NULL,0,0,'2020-10-09 05:04:35','2020-10-09 05:04:35'),(2,1,'127.0.0.1','Login',NULL,0,0,'2020-10-11 23:32:46','2020-10-11 23:32:46'),(3,0,'127.0.0.1','Login Failed With Username :dia_manipur',NULL,0,0,'2020-10-11 23:33:18','2020-10-11 23:33:18'),(4,0,'127.0.0.1','Login Failed With Username :dia_manipur',NULL,0,0,'2020-10-11 23:33:26','2020-10-11 23:33:26'),(5,1,'127.0.0.1','Login',NULL,0,0,'2020-10-11 23:38:54','2020-10-11 23:38:54'),(6,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-11 23:43:21','2020-10-11 23:43:21'),(7,1,'127.0.0.1','User List',NULL,0,0,'2020-10-11 23:43:22','2020-10-11 23:43:22'),(8,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:43:39','2020-10-11 23:43:39'),(9,1,'127.0.0.1','Created Level',NULL,0,0,'2020-10-11 23:45:25','2020-10-11 23:45:25'),(10,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:45:27','2020-10-11 23:45:27'),(11,1,'127.0.0.1','Created Level',NULL,0,0,'2020-10-11 23:45:45','2020-10-11 23:45:45'),(12,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:45:47','2020-10-11 23:45:47'),(13,1,'127.0.0.1','Created Level',NULL,0,0,'2020-10-11 23:45:57','2020-10-11 23:45:57'),(14,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:45:59','2020-10-11 23:45:59'),(15,1,'127.0.0.1','Created Level',NULL,0,0,'2020-10-11 23:46:13','2020-10-11 23:46:13'),(16,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:46:15','2020-10-11 23:46:15'),(17,1,'127.0.0.1','Created Level',NULL,0,0,'2020-10-11 23:46:27','2020-10-11 23:46:27'),(18,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:46:28','2020-10-11 23:46:28'),(19,1,'127.0.0.1','Created Level',NULL,0,0,'2020-10-11 23:46:38','2020-10-11 23:46:38'),(20,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:46:39','2020-10-11 23:46:39'),(21,1,'127.0.0.1','Created Level',NULL,0,0,'2020-10-11 23:47:30','2020-10-11 23:47:30'),(22,1,'127.0.0.1','Level List',NULL,0,0,'2020-10-11 23:47:31','2020-10-11 23:47:31'),(23,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-11 23:47:38','2020-10-11 23:47:38'),(24,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-11 23:47:38','2020-10-11 23:47:38'),(25,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-11 23:48:33','2020-10-11 23:48:33'),(26,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-11 23:55:21','2020-10-11 23:55:21'),(27,1,'127.0.0.1','User List',NULL,0,0,'2020-10-11 23:55:22','2020-10-11 23:55:22'),(28,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-11 23:55:24','2020-10-11 23:55:24'),(29,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-11 23:58:50','2020-10-11 23:58:50'),(30,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-11 23:58:51','2020-10-11 23:58:51'),(31,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-11 23:58:53','2020-10-11 23:58:53'),(32,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:01:35','2020-10-12 00:01:35'),(33,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:01:36','2020-10-12 00:01:36'),(34,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:07:35','2020-10-12 00:07:35'),(35,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:07:35','2020-10-12 00:07:35'),(36,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:07:45','2020-10-12 00:07:45'),(37,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:07:46','2020-10-12 00:07:46'),(38,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:07:57','2020-10-12 00:07:57'),(39,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:07:57','2020-10-12 00:07:57'),(40,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:08:17','2020-10-12 00:08:17'),(41,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:08:18','2020-10-12 00:08:18'),(42,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:09:52','2020-10-12 00:09:52'),(43,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:09:53','2020-10-12 00:09:53'),(44,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:10:00','2020-10-12 00:10:00'),(45,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:16:20','2020-10-12 00:16:20'),(46,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:16:32','2020-10-12 00:16:32'),(47,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:17:07','2020-10-12 00:17:07'),(48,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:17:08','2020-10-12 00:17:08'),(49,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:17:08','2020-10-12 00:17:08'),(50,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:17:08','2020-10-12 00:17:08'),(51,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 00:42:30','2020-10-12 00:42:30'),(52,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:42:52','2020-10-12 00:42:52'),(53,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:42:52','2020-10-12 00:42:52'),(54,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 00:43:53','2020-10-12 00:43:53'),(55,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 00:43:54','2020-10-12 00:43:54'),(56,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:06:22','2020-10-12 01:06:22'),(57,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:06:23','2020-10-12 01:06:23'),(58,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:06:23','2020-10-12 01:06:23'),(59,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:06:23','2020-10-12 01:06:23'),(60,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:08:21','2020-10-12 01:08:21'),(61,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:08:21','2020-10-12 01:08:21'),(62,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:08:22','2020-10-12 01:08:22'),(63,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:08:22','2020-10-12 01:08:22'),(64,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:09:13','2020-10-12 01:09:13'),(65,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:09:14','2020-10-12 01:09:14'),(66,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:09:14','2020-10-12 01:09:14'),(67,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:09:14','2020-10-12 01:09:14'),(68,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:10:35','2020-10-12 01:10:35'),(69,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:10:36','2020-10-12 01:10:36'),(70,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:10:38','2020-10-12 01:10:38'),(71,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:13:29','2020-10-12 01:13:29'),(72,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:13:30','2020-10-12 01:13:30'),(73,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:16:25','2020-10-12 01:16:25'),(74,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:27:09','2020-10-12 01:27:09'),(75,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:28:11','2020-10-12 01:28:11'),(76,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:28:11','2020-10-12 01:28:11'),(77,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:28:27','2020-10-12 01:28:27'),(78,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:29:09','2020-10-12 01:29:09'),(79,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:29:09','2020-10-12 01:29:09'),(80,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:29:18','2020-10-12 01:29:18'),(81,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:29:26','2020-10-12 01:29:26'),(82,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:30:05','2020-10-12 01:30:05'),(83,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:30:06','2020-10-12 01:30:06'),(84,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:30:06','2020-10-12 01:30:06'),(85,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:30:07','2020-10-12 01:30:07'),(86,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:30:22','2020-10-12 01:30:22'),(87,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:30:23','2020-10-12 01:30:23'),(88,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:30:23','2020-10-12 01:30:23'),(89,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:30:24','2020-10-12 01:30:24'),(90,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:31:25','2020-10-12 01:31:25'),(91,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:31:25','2020-10-12 01:31:25'),(92,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:31:26','2020-10-12 01:31:26'),(93,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:31:26','2020-10-12 01:31:26'),(94,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:39:27','2020-10-12 01:39:27'),(95,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:39:28','2020-10-12 01:39:28'),(96,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:39:28','2020-10-12 01:39:28'),(97,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:39:28','2020-10-12 01:39:28'),(98,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:53:40','2020-10-12 01:53:40'),(99,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:53:41','2020-10-12 01:53:41'),(100,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:53:41','2020-10-12 01:53:41'),(101,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:53:41','2020-10-12 01:53:41'),(102,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 01:53:56','2020-10-12 01:53:56'),(103,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:53:57','2020-10-12 01:53:57'),(104,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:53:57','2020-10-12 01:53:57'),(105,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 01:53:57','2020-10-12 01:53:57'),(106,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:00:18','2020-10-12 02:00:18'),(107,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:00:19','2020-10-12 02:00:19'),(108,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:00:19','2020-10-12 02:00:19'),(109,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:00:20','2020-10-12 02:00:20'),(110,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:01:29','2020-10-12 02:01:29'),(111,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:01:31','2020-10-12 02:01:31'),(112,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:01:31','2020-10-12 02:01:31'),(113,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:01:33','2020-10-12 02:01:33'),(114,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:02:12','2020-10-12 02:02:12'),(115,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:02:12','2020-10-12 02:02:12'),(116,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:02:13','2020-10-12 02:02:13'),(117,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:02:13','2020-10-12 02:02:13'),(118,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:11:53','2020-10-12 02:11:53'),(119,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:12:45','2020-10-12 02:12:45'),(120,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:13:02','2020-10-12 02:13:02'),(121,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:13:03','2020-10-12 02:13:03'),(122,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:13:03','2020-10-12 02:13:03'),(123,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:13:04','2020-10-12 02:13:04'),(124,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:13:30','2020-10-12 02:13:30'),(125,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:13:30','2020-10-12 02:13:30'),(126,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:13:32','2020-10-12 02:13:32'),(127,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:13:34','2020-10-12 02:13:34'),(128,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:17:23','2020-10-12 02:17:23'),(129,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:24','2020-10-12 02:17:24'),(130,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:26','2020-10-12 02:17:26'),(131,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:27','2020-10-12 02:17:27'),(132,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:17:48','2020-10-12 02:17:48'),(133,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:49','2020-10-12 02:17:49'),(134,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:49','2020-10-12 02:17:49'),(135,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:50','2020-10-12 02:17:50'),(136,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:17:59','2020-10-12 02:17:59'),(137,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:59','2020-10-12 02:17:59'),(138,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:17:59','2020-10-12 02:17:59'),(139,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:00','2020-10-12 02:18:00'),(140,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:18:09','2020-10-12 02:18:09'),(141,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:10','2020-10-12 02:18:10'),(142,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:10','2020-10-12 02:18:10'),(143,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:10','2020-10-12 02:18:10'),(144,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:18:19','2020-10-12 02:18:19'),(145,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:20','2020-10-12 02:18:20'),(146,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:20','2020-10-12 02:18:20'),(147,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:20','2020-10-12 02:18:20'),(148,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:18:26','2020-10-12 02:18:26'),(149,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:26','2020-10-12 02:18:26'),(150,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:40','2020-10-12 02:18:40'),(151,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:18:49','2020-10-12 02:18:49'),(152,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:19:05','2020-10-12 02:19:05'),(153,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 02:19:20','2020-10-12 02:19:20'),(154,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:19:22','2020-10-12 02:19:22'),(155,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:19:22','2020-10-12 02:19:22'),(156,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:19:22','2020-10-12 02:19:22'),(157,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 02:19:23','2020-10-12 02:19:23'),(158,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 03:15:40','2020-10-12 03:15:40'),(159,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 03:16:01','2020-10-12 03:16:01'),(160,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 03:16:02','2020-10-12 03:16:02'),(161,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 03:16:03','2020-10-12 03:16:03'),(162,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 03:32:25','2020-10-12 03:32:25'),(163,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-12 03:35:28','2020-10-12 03:35:28'),(164,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 03:35:31','2020-10-12 03:35:31'),(165,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 03:35:33','2020-10-12 03:35:33'),(166,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:36:22','2020-10-12 03:36:22'),(167,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:36:24','2020-10-12 03:36:24'),(168,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 03:36:31','2020-10-12 03:36:31'),(169,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 03:36:33','2020-10-12 03:36:33'),(170,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 03:36:34','2020-10-12 03:36:34'),(171,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:36:53','2020-10-12 03:36:53'),(172,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:36:54','2020-10-12 03:36:54'),(173,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:37:19','2020-10-12 03:37:19'),(174,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:37:21','2020-10-12 03:37:21'),(175,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:37:48','2020-10-12 03:37:48'),(176,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:37:50','2020-10-12 03:37:50'),(177,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 03:38:10','2020-10-12 03:38:10'),(178,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:38:14','2020-10-12 03:38:14'),(179,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:38:15','2020-10-12 03:38:15'),(180,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 03:38:21','2020-10-12 03:38:21'),(181,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 03:38:24','2020-10-12 03:38:24'),(182,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 03:38:25','2020-10-12 03:38:25'),(183,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:38:38','2020-10-12 03:38:38'),(184,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:38:39','2020-10-12 03:38:39'),(185,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:38:50','2020-10-12 03:38:50'),(186,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:38:52','2020-10-12 03:38:52'),(187,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:40:59','2020-10-12 03:40:59'),(188,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:41:17','2020-10-12 03:41:17'),(189,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:42:13','2020-10-12 03:42:13'),(190,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:42:23','2020-10-12 03:42:23'),(191,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:42:25','2020-10-12 03:42:25'),(192,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 03:44:17','2020-10-12 03:44:17'),(193,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 03:44:19','2020-10-12 03:44:19'),(194,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 03:44:20','2020-10-12 03:44:20'),(195,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:44:23','2020-10-12 03:44:23'),(196,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:44:24','2020-10-12 03:44:24'),(197,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 03:44:31','2020-10-12 03:44:31'),(198,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:49:46','2020-10-12 03:49:46'),(199,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:49:48','2020-10-12 03:49:48'),(200,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 03:50:02','2020-10-12 03:50:02'),(201,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 03:50:04','2020-10-12 03:50:04'),(202,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 03:56:44','2020-10-12 03:56:44'),(203,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 03:57:20','2020-10-12 03:57:20'),(204,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 03:58:33','2020-10-12 03:58:33'),(205,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 03:59:14','2020-10-12 03:59:14'),(206,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:04:15','2020-10-12 04:04:15'),(207,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:04:40','2020-10-12 04:04:40'),(208,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:05:11','2020-10-12 04:05:11'),(209,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:05:51','2020-10-12 04:05:51'),(210,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:06:25','2020-10-12 04:06:25'),(211,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:06:26','2020-10-12 04:06:26'),(212,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:06:27','2020-10-12 04:06:27'),(213,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:06:29','2020-10-12 04:06:29'),(214,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-12 04:08:14','2020-10-12 04:08:14'),(215,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-12 04:08:22','2020-10-12 04:08:22'),(216,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:08:24','2020-10-12 04:08:24'),(217,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:08:25','2020-10-12 04:08:25'),(218,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 04:08:28','2020-10-12 04:08:28'),(219,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 04:08:30','2020-10-12 04:08:30'),(220,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:08:35','2020-10-12 04:08:35'),(221,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:08:40','2020-10-12 04:08:40'),(222,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:08:42','2020-10-12 04:08:42'),(223,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:08:43','2020-10-12 04:08:43'),(224,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:09:44','2020-10-12 04:09:44'),(225,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:09:45','2020-10-12 04:09:45'),(226,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:10:34','2020-10-12 04:10:34'),(227,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:10:35','2020-10-12 04:10:35'),(228,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:12:23','2020-10-12 04:12:23'),(229,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:12:24','2020-10-12 04:12:24'),(230,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 04:13:47','2020-10-12 04:13:47'),(231,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 04:13:48','2020-10-12 04:13:48'),(232,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 04:13:48','2020-10-12 04:13:48'),(233,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 04:13:49','2020-10-12 04:13:49'),(234,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 04:30:00','2020-10-12 04:30:00'),(235,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 04:30:00','2020-10-12 04:30:00'),(236,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 04:30:00','2020-10-12 04:30:00'),(237,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 04:30:01','2020-10-12 04:30:01'),(238,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:30:08','2020-10-12 04:30:08'),(239,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:30:10','2020-10-12 04:30:10'),(240,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 04:30:16','2020-10-12 04:30:16'),(241,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 04:30:18','2020-10-12 04:30:18'),(242,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:30:24','2020-10-12 04:30:24'),(243,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:30:26','2020-10-12 04:30:26'),(244,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:30:27','2020-10-12 04:30:27'),(245,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 04:30:30','2020-10-12 04:30:30'),(246,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 04:30:32','2020-10-12 04:30:32'),(247,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:30:40','2020-10-12 04:30:40'),(248,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:30:42','2020-10-12 04:30:42'),(249,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:30:43','2020-10-12 04:30:43'),(250,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 04:30:45','2020-10-12 04:30:45'),(251,1,'127.0.0.1','User View',NULL,0,0,'2020-10-12 04:30:47','2020-10-12 04:30:47'),(252,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-12 04:31:04','2020-10-12 04:31:04'),(253,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:31:06','2020-10-12 04:31:06'),(254,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:31:07','2020-10-12 04:31:07'),(255,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 04:34:13','2020-10-12 04:34:13'),(256,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 04:34:15','2020-10-12 04:34:15'),(257,2,'127.0.0.1','Login',NULL,0,0,'2020-10-12 04:34:47','2020-10-12 04:34:47'),(258,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 04:35:09','2020-10-12 04:35:09'),(259,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 04:35:17','2020-10-12 04:35:17'),(260,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-12 04:35:24','2020-10-12 04:35:24'),(261,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-12 04:35:24','2020-10-12 04:35:24'),(262,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-12 04:35:24','2020-10-12 04:35:24'),(263,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-12 04:35:46','2020-10-12 04:35:46'),(264,2,'127.0.0.1','Login',NULL,0,0,'2020-10-12 04:36:04','2020-10-12 04:36:04'),(265,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 04:54:51','2020-10-12 04:54:51'),(266,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 05:05:21','2020-10-12 05:05:21'),(267,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:05:22','2020-10-12 05:05:22'),(268,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:05:22','2020-10-12 05:05:22'),(269,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:05:23','2020-10-12 05:05:23'),(270,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 05:33:43','2020-10-12 05:33:43'),(271,1,'127.0.0.1','User List',NULL,0,0,'2020-10-12 05:33:44','2020-10-12 05:33:44'),(272,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-12 05:33:51','2020-10-12 05:33:51'),(273,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 05:35:34','2020-10-12 05:35:34'),(274,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:35:35','2020-10-12 05:35:35'),(275,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:35:35','2020-10-12 05:35:35'),(276,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:35:36','2020-10-12 05:35:36'),(277,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 05:36:07','2020-10-12 05:36:07'),(278,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:36:08','2020-10-12 05:36:08'),(279,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:36:09','2020-10-12 05:36:09'),(280,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:36:09','2020-10-12 05:36:09'),(281,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 05:51:26','2020-10-12 05:51:26'),(282,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:51:27','2020-10-12 05:51:27'),(283,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:51:27','2020-10-12 05:51:27'),(284,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 05:51:28','2020-10-12 05:51:28'),(285,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 22:46:21','2020-10-12 22:46:21'),(286,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 23:15:18','2020-10-12 23:15:18'),(287,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 23:16:09','2020-10-12 23:16:09'),(288,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 23:16:10','2020-10-12 23:16:10'),(289,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 23:16:10','2020-10-12 23:16:10'),(290,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 23:16:11','2020-10-12 23:16:11'),(291,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-12 23:30:28','2020-10-12 23:30:28'),(292,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 23:30:28','2020-10-12 23:30:28'),(293,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 23:30:29','2020-10-12 23:30:29'),(294,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 23:30:29','2020-10-12 23:30:29'),(295,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-12 23:30:29','2020-10-12 23:30:29'),(296,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 23:30:52','2020-10-12 23:30:52'),(297,2,'127.0.0.1','Login',NULL,0,0,'2020-10-12 23:31:11','2020-10-12 23:31:11'),(298,1,'127.0.0.1','Login',NULL,0,0,'2020-10-12 23:44:25','2020-10-12 23:44:25'),(299,2,'127.0.0.1','Login',NULL,0,0,'2020-10-13 00:47:57','2020-10-13 00:47:57'),(300,2,'127.0.0.1','Login',NULL,0,0,'2020-10-13 01:21:18','2020-10-13 01:21:18'),(301,1,'127.0.0.1','Login',NULL,0,0,'2020-10-13 03:07:42','2020-10-13 03:07:42'),(302,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-13 03:09:22','2020-10-13 03:09:22'),(303,1,'127.0.0.1','User List',NULL,0,0,'2020-10-13 03:09:24','2020-10-13 03:09:24'),(304,2,'127.0.0.1','Login',NULL,0,0,'2020-10-13 03:11:22','2020-10-13 03:11:22'),(305,1,'127.0.0.1','Login',NULL,0,0,'2020-10-13 04:03:44','2020-10-13 04:03:44'),(306,1,'127.0.0.1','Login',NULL,0,0,'2020-10-13 04:11:24','2020-10-13 04:11:24'),(307,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-13 04:11:54','2020-10-13 04:11:54'),(308,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-13 04:11:55','2020-10-13 04:11:55'),(309,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-13 04:11:55','2020-10-13 04:11:55'),(310,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-13 04:11:55','2020-10-13 04:11:55'),(311,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-13 04:12:04','2020-10-13 04:12:04'),(312,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-13 04:12:04','2020-10-13 04:12:04'),(313,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-13 04:12:26','2020-10-13 04:12:26'),(314,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-13 04:12:27','2020-10-13 04:12:27'),(315,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-13 04:12:37','2020-10-13 04:12:37'),(316,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-13 04:12:38','2020-10-13 04:12:38'),(317,2,'127.0.0.1','Login',NULL,0,0,'2020-10-13 04:24:29','2020-10-13 04:24:29'),(318,1,'127.0.0.1','Login',NULL,0,0,'2020-10-13 04:27:42','2020-10-13 04:27:42'),(319,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-13 04:28:17','2020-10-13 04:28:17'),(320,1,'127.0.0.1','User List',NULL,0,0,'2020-10-13 04:28:18','2020-10-13 04:28:18'),(321,2,'127.0.0.1','Login',NULL,0,0,'2020-10-13 05:22:22','2020-10-13 05:22:22'),(322,3,'127.0.0.1','Login',NULL,0,0,'2020-10-13 05:33:59','2020-10-13 05:33:59'),(323,2,'127.0.0.1','Login',NULL,0,0,'2020-10-13 05:35:29','2020-10-13 05:35:29'),(324,2,'127.0.0.1','Login',NULL,0,0,'2020-10-13 22:48:55','2020-10-13 22:48:55'),(325,2,'127.0.0.1','Login',NULL,0,0,'2020-10-14 00:13:30','2020-10-14 00:13:30'),(326,3,'127.0.0.1','Login',NULL,0,0,'2020-10-14 00:14:49','2020-10-14 00:14:49'),(327,3,'127.0.0.1','Login',NULL,0,0,'2020-10-14 01:42:55','2020-10-14 01:42:55'),(328,3,'127.0.0.1','Login',NULL,0,0,'2020-10-14 01:43:25','2020-10-14 01:43:25'),(329,2,'127.0.0.1','Login',NULL,0,0,'2020-10-14 03:03:30','2020-10-14 03:03:30'),(330,3,'127.0.0.1','Login',NULL,0,0,'2020-10-14 03:11:23','2020-10-14 03:11:23'),(331,3,'127.0.0.1','Login',NULL,0,0,'2020-10-14 04:38:51','2020-10-14 04:38:51'),(332,3,'127.0.0.1','Login',NULL,0,0,'2020-10-14 06:38:05','2020-10-14 06:38:05'),(333,2,'127.0.0.1','Login',NULL,0,0,'2020-10-14 06:53:49','2020-10-14 06:53:49'),(334,2,'127.0.0.1','Login',NULL,0,0,'2020-10-15 00:12:28','2020-10-15 00:12:28'),(335,1,'127.0.0.1','Login',NULL,0,0,'2020-10-15 00:43:47','2020-10-15 00:43:47'),(336,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 00:44:03','2020-10-15 00:44:03'),(337,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:03','2020-10-15 00:44:03'),(338,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:04','2020-10-15 00:44:04'),(339,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:04','2020-10-15 00:44:04'),(340,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:04','2020-10-15 00:44:04'),(341,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 00:44:52','2020-10-15 00:44:52'),(342,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:53','2020-10-15 00:44:53'),(343,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:53','2020-10-15 00:44:53'),(344,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:53','2020-10-15 00:44:53'),(345,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:44:54','2020-10-15 00:44:54'),(346,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 00:45:52','2020-10-15 00:45:52'),(347,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:45:52','2020-10-15 00:45:52'),(348,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:45:53','2020-10-15 00:45:53'),(349,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:45:53','2020-10-15 00:45:53'),(350,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:45:53','2020-10-15 00:45:53'),(351,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 00:47:13','2020-10-15 00:47:13'),(352,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:47:14','2020-10-15 00:47:14'),(353,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:47:14','2020-10-15 00:47:14'),(354,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:47:15','2020-10-15 00:47:15'),(355,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:47:15','2020-10-15 00:47:15'),(356,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 00:48:02','2020-10-15 00:48:02'),(357,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:48:02','2020-10-15 00:48:02'),(358,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:48:03','2020-10-15 00:48:03'),(359,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:48:03','2020-10-15 00:48:03'),(360,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:48:03','2020-10-15 00:48:03'),(361,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 00:49:21','2020-10-15 00:49:21'),(362,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:49:22','2020-10-15 00:49:22'),(363,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:49:22','2020-10-15 00:49:22'),(364,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:49:23','2020-10-15 00:49:23'),(365,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 00:49:23','2020-10-15 00:49:23'),(366,2,'127.0.0.1','Login',NULL,0,0,'2020-10-15 01:28:15','2020-10-15 01:28:15'),(367,3,'127.0.0.1','Login',NULL,0,0,'2020-10-15 03:04:54','2020-10-15 03:04:54'),(368,3,'127.0.0.1','Login',NULL,0,0,'2020-10-15 04:05:00','2020-10-15 04:05:00'),(369,3,'127.0.0.1','Login',NULL,0,0,'2020-10-15 04:05:41','2020-10-15 04:05:41'),(370,3,'127.0.0.1','Login',NULL,0,0,'2020-10-15 05:28:04','2020-10-15 05:28:04'),(371,1,'127.0.0.1','Login',NULL,0,0,'2020-10-15 06:13:13','2020-10-15 06:13:13'),(372,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 06:13:31','2020-10-15 06:13:31'),(373,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 06:13:31','2020-10-15 06:13:31'),(374,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 06:13:32','2020-10-15 06:13:32'),(375,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 06:13:32','2020-10-15 06:13:32'),(376,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 06:13:32','2020-10-15 06:13:32'),(377,2,'127.0.0.1','Login',NULL,0,0,'2020-10-15 06:32:41','2020-10-15 06:32:41'),(378,3,'127.0.0.1','Login',NULL,0,0,'2020-10-15 06:33:36','2020-10-15 06:33:36'),(379,1,'127.0.0.1','Login',NULL,0,0,'2020-10-15 23:32:13','2020-10-15 23:32:13'),(380,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 23:32:33','2020-10-15 23:32:33'),(381,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:34','2020-10-15 23:32:34'),(382,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:34','2020-10-15 23:32:34'),(383,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:35','2020-10-15 23:32:35'),(384,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:35','2020-10-15 23:32:35'),(385,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 23:32:52','2020-10-15 23:32:52'),(386,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:52','2020-10-15 23:32:52'),(387,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:53','2020-10-15 23:32:53'),(388,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:53','2020-10-15 23:32:53'),(389,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-15 23:32:53','2020-10-15 23:32:53'),(390,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:33:09','2020-10-15 23:33:09'),(391,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:33:11','2020-10-15 23:33:11'),(392,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:33:16','2020-10-15 23:33:16'),(393,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:41:24','2020-10-15 23:41:24'),(394,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:43:33','2020-10-15 23:43:33'),(395,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:44:47','2020-10-15 23:44:47'),(396,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:44:59','2020-10-15 23:44:59'),(397,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:47:41','2020-10-15 23:47:41'),(398,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:47:54','2020-10-15 23:47:54'),(399,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:48:09','2020-10-15 23:48:09'),(400,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:48:17','2020-10-15 23:48:17'),(401,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:48:23','2020-10-15 23:48:23'),(402,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:48:24','2020-10-15 23:48:24'),(403,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 23:48:27','2020-10-15 23:48:27'),(404,1,'127.0.0.1','User View',NULL,0,0,'2020-10-15 23:48:29','2020-10-15 23:48:29'),(405,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-15 23:48:32','2020-10-15 23:48:32'),(406,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:48:34','2020-10-15 23:48:34'),(407,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:48:35','2020-10-15 23:48:35'),(408,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:48:38','2020-10-15 23:48:38'),(409,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:54:55','2020-10-15 23:54:55'),(410,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:54:57','2020-10-15 23:54:57'),(411,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:54:58','2020-10-15 23:54:58'),(412,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:55:02','2020-10-15 23:55:02'),(413,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:55:08','2020-10-15 23:55:08'),(414,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 23:55:11','2020-10-15 23:55:11'),(415,1,'127.0.0.1','User View',NULL,0,0,'2020-10-15 23:55:13','2020-10-15 23:55:13'),(416,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-15 23:55:16','2020-10-15 23:55:16'),(417,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:55:18','2020-10-15 23:55:18'),(418,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:55:19','2020-10-15 23:55:19'),(419,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:55:23','2020-10-15 23:55:23'),(420,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:57:09','2020-10-15 23:57:09'),(421,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:57:15','2020-10-15 23:57:15'),(422,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:57:16','2020-10-15 23:57:16'),(423,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:57:17','2020-10-15 23:57:17'),(424,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 23:57:26','2020-10-15 23:57:26'),(425,1,'127.0.0.1','User View',NULL,0,0,'2020-10-15 23:57:28','2020-10-15 23:57:28'),(426,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:57:31','2020-10-15 23:57:31'),(427,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-15 23:57:43','2020-10-15 23:57:43'),(428,1,'127.0.0.1','User View',NULL,0,0,'2020-10-15 23:57:45','2020-10-15 23:57:45'),(429,1,'127.0.0.1','Updated User',NULL,0,0,'2020-10-15 23:57:58','2020-10-15 23:57:58'),(430,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:58:00','2020-10-15 23:58:00'),(431,1,'127.0.0.1','User List',NULL,0,0,'2020-10-15 23:58:01','2020-10-15 23:58:01'),(432,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-15 23:58:18','2020-10-15 23:58:18'),(433,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-15 23:59:50','2020-10-15 23:59:50'),(434,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-16 00:00:06','2020-10-16 00:00:06'),(435,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-16 00:00:11','2020-10-16 00:00:11'),(436,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-16 00:00:13','2020-10-16 00:00:13'),(437,1,'127.0.0.1','User List',NULL,0,0,'2020-10-16 00:00:14','2020-10-16 00:00:14'),(438,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-16 00:00:18','2020-10-16 00:00:18'),(439,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-16 00:02:07','2020-10-16 00:02:07'),(440,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-16 00:02:12','2020-10-16 00:02:12'),(441,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-16 00:02:17','2020-10-16 00:02:17'),(442,1,'127.0.0.1','User List',NULL,0,0,'2020-10-16 00:02:18','2020-10-16 00:02:18'),(443,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-16 00:02:28','2020-10-16 00:02:28'),(444,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-16 00:03:42','2020-10-16 00:03:42'),(445,1,'127.0.0.1','Created User',NULL,0,0,'2020-10-16 00:03:47','2020-10-16 00:03:47'),(446,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-16 00:03:50','2020-10-16 00:03:50'),(447,1,'127.0.0.1','User List',NULL,0,0,'2020-10-16 00:03:51','2020-10-16 00:03:51'),(448,1,'127.0.0.1','Login',NULL,0,0,'2020-10-16 00:04:54','2020-10-16 00:04:54'),(449,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 00:08:05','2020-10-16 00:08:05'),(450,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 00:08:10','2020-10-16 00:08:10'),(451,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 00:08:10','2020-10-16 00:08:10'),(452,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 00:08:11','2020-10-16 00:08:11'),(453,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 00:09:21','2020-10-16 00:09:21'),(454,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 00:09:26','2020-10-16 00:09:26'),(455,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 00:09:27','2020-10-16 00:09:27'),(456,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 00:09:27','2020-10-16 00:09:27'),(457,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 00:10:08','2020-10-16 00:10:08'),(458,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 00:10:08','2020-10-16 00:10:08'),(459,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 00:10:08','2020-10-16 00:10:08'),(460,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-16 00:10:14','2020-10-16 00:10:14'),(461,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 00:10:18','2020-10-16 00:10:18'),(462,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 00:10:19','2020-10-16 00:10:19'),(463,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 00:10:19','2020-10-16 00:10:19'),(464,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-16 00:10:41','2020-10-16 00:10:41'),(465,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 00:10:52','2020-10-16 00:10:52'),(466,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 00:11:18','2020-10-16 00:11:18'),(467,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 00:11:18','2020-10-16 00:11:18'),(468,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 00:11:19','2020-10-16 00:11:19'),(469,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 00:11:22','2020-10-16 00:11:22'),(470,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 00:11:22','2020-10-16 00:11:22'),(471,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 00:11:23','2020-10-16 00:11:23'),(472,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-16 00:11:30','2020-10-16 00:11:30'),(473,2,'127.0.0.1','Login',NULL,0,0,'2020-10-16 00:11:57','2020-10-16 00:11:57'),(474,0,'127.0.0.1','Login Failed With Username :dia_manipur2',NULL,0,0,'2020-10-16 00:44:28','2020-10-16 00:44:28'),(475,3,'127.0.0.1','Login',NULL,0,0,'2020-10-16 00:44:44','2020-10-16 00:44:44'),(476,2,'127.0.0.1','Login',NULL,0,0,'2020-10-16 00:45:42','2020-10-16 00:45:42'),(477,1,'127.0.0.1','Login',NULL,0,0,'2020-10-16 01:01:50','2020-10-16 01:01:50'),(478,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 01:02:00','2020-10-16 01:02:00'),(479,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-16 01:02:02','2020-10-16 01:02:02'),(480,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-16 01:02:02','2020-10-16 01:02:02'),(481,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-16 01:02:03','2020-10-16 01:02:03'),(482,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-16 01:02:03','2020-10-16 01:02:03'),(483,3,'127.0.0.1','Login',NULL,0,0,'2020-10-16 01:11:03','2020-10-16 01:11:03'),(484,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 01:13:59','2020-10-16 01:13:59'),(485,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 01:14:05','2020-10-16 01:14:05'),(486,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 01:14:14','2020-10-16 01:14:14'),(487,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 01:14:16','2020-10-16 01:14:16'),(488,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 01:14:17','2020-10-16 01:14:17'),(489,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 01:14:17','2020-10-16 01:14:17'),(490,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-16 01:14:24','2020-10-16 01:14:24'),(491,3,'127.0.0.1','Login',NULL,0,0,'2020-10-16 01:14:51','2020-10-16 01:14:51'),(492,4,'127.0.0.1','Login',NULL,0,0,'2020-10-16 03:17:30','2020-10-16 03:17:30'),(493,3,'127.0.0.1','Login',NULL,0,0,'2020-10-16 03:18:22','2020-10-16 03:18:22'),(494,6,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:07:10','2020-10-16 05:07:10'),(495,1,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:09:01','2020-10-16 05:09:01'),(496,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 05:09:10','2020-10-16 05:09:10'),(497,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 05:09:16','2020-10-16 05:09:16'),(498,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 05:09:17','2020-10-16 05:09:17'),(499,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 05:09:17','2020-10-16 05:09:17'),(500,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-16 05:09:32','2020-10-16 05:09:32'),(501,5,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:31:19','2020-10-16 05:31:19'),(502,5,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:42:02','2020-10-16 05:42:02'),(503,4,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:43:19','2020-10-16 05:43:19'),(504,0,'127.0.0.1','Login Failed With Username :sia_level1',NULL,0,0,'2020-10-16 05:56:23','2020-10-16 05:56:23'),(505,5,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:56:34','2020-10-16 05:56:34'),(506,1,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:57:58','2020-10-16 05:57:58'),(507,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-16 05:58:04','2020-10-16 05:58:04'),(508,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-16 05:58:09','2020-10-16 05:58:09'),(509,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-16 05:58:09','2020-10-16 05:58:09'),(510,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-16 05:58:10','2020-10-16 05:58:10'),(511,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-16 05:58:27','2020-10-16 05:58:27'),(512,5,'127.0.0.1','Login',NULL,0,0,'2020-10-16 05:59:27','2020-10-16 05:59:27'),(513,5,'127.0.0.1','Login',NULL,0,0,'2020-10-16 07:10:30','2020-10-16 07:10:30'),(514,0,'127.0.0.1','Login Failed With Username :sia_manipur2',NULL,0,0,'2020-10-19 00:18:16','2020-10-19 00:18:16'),(515,0,'127.0.0.1','Login Failed With Username :sia_manipur2',NULL,0,0,'2020-10-19 00:25:35','2020-10-19 00:25:35'),(516,6,'127.0.0.1','Login',NULL,0,0,'2020-10-19 00:25:58','2020-10-19 00:25:58'),(517,5,'127.0.0.1','Login',NULL,0,0,'2020-10-19 00:32:05','2020-10-19 00:32:05'),(518,5,'127.0.0.1','Login',NULL,0,0,'2020-10-19 00:58:06','2020-10-19 00:58:06'),(519,6,'127.0.0.1','Login',NULL,0,0,'2020-10-19 01:23:48','2020-10-19 01:23:48'),(520,5,'127.0.0.1','Login',NULL,0,0,'2020-10-19 03:45:09','2020-10-19 03:45:09'),(521,6,'127.0.0.1','Login',NULL,0,0,'2020-10-19 03:46:08','2020-10-19 03:46:08'),(522,6,'127.0.0.1','Login',NULL,0,0,'2020-10-19 04:13:22','2020-10-19 04:13:22'),(523,6,'127.0.0.1','Login',NULL,0,0,'2020-10-19 06:45:01','2020-10-19 06:45:01'),(524,6,'127.0.0.1','Login',NULL,0,0,'2020-10-19 06:45:55','2020-10-19 06:45:55'),(525,5,'127.0.0.1','Login',NULL,0,0,'2020-10-19 23:22:44','2020-10-19 23:22:44'),(526,6,'127.0.0.1','Login',NULL,0,0,'2020-10-19 23:37:51','2020-10-19 23:37:51'),(527,6,'127.0.0.1','Login',NULL,0,0,'2020-10-20 01:31:43','2020-10-20 01:31:43'),(528,5,'127.0.0.1','Login',NULL,0,0,'2020-10-20 01:57:46','2020-10-20 01:57:46'),(529,4,'127.0.0.1','Login',NULL,0,0,'2020-10-20 02:05:06','2020-10-20 02:05:06'),(530,5,'127.0.0.1','Login',NULL,0,0,'2020-10-20 02:06:05','2020-10-20 02:06:05'),(531,5,'127.0.0.1','Login',NULL,0,0,'2020-10-20 02:12:07','2020-10-20 02:12:07'),(532,4,'127.0.0.1','Login',NULL,0,0,'2020-10-20 02:13:20','2020-10-20 02:13:20'),(533,4,'127.0.0.1','Login',NULL,0,0,'2020-10-20 06:36:18','2020-10-20 06:36:18'),(534,5,'127.0.0.1','Login',NULL,0,0,'2020-10-20 07:32:07','2020-10-20 07:32:07'),(535,6,'127.0.0.1','Login',NULL,0,0,'2020-10-20 07:36:19','2020-10-20 07:36:19'),(536,8,'127.0.0.1','Login',NULL,0,0,'2020-10-20 07:38:36','2020-10-20 07:38:36'),(537,1,'127.0.0.1','Login',NULL,0,0,'2020-10-20 07:39:07','2020-10-20 07:39:07'),(538,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-20 07:39:20','2020-10-20 07:39:20'),(539,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-20 07:39:21','2020-10-20 07:39:21'),(540,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-20 07:39:21','2020-10-20 07:39:21'),(541,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-20 07:39:21','2020-10-20 07:39:21'),(542,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-20 07:39:22','2020-10-20 07:39:22'),(543,8,'127.0.0.1','Login',NULL,0,0,'2020-10-20 23:33:15','2020-10-20 23:33:15'),(544,1,'127.0.0.1','Login',NULL,0,0,'2020-10-20 23:44:46','2020-10-20 23:44:46'),(545,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-20 23:45:20','2020-10-20 23:45:20'),(546,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-20 23:45:44','2020-10-20 23:45:44'),(547,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-20 23:45:49','2020-10-20 23:45:49'),(548,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-20 23:45:53','2020-10-20 23:45:53'),(549,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-20 23:45:53','2020-10-20 23:45:53'),(550,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-20 23:45:54','2020-10-20 23:45:54'),(551,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-20 23:46:15','2020-10-20 23:46:15'),(552,8,'127.0.0.1','Login',NULL,0,0,'2020-10-20 23:46:45','2020-10-20 23:46:45'),(553,2,'127.0.0.1','Login',NULL,0,0,'2020-10-20 23:56:34','2020-10-20 23:56:34'),(554,3,'127.0.0.1','Login',NULL,0,0,'2020-10-21 00:09:14','2020-10-21 00:09:14'),(555,4,'127.0.0.1','Login',NULL,0,0,'2020-10-21 00:11:13','2020-10-21 00:11:13'),(556,4,'127.0.0.1','Login',NULL,0,0,'2020-10-21 00:23:24','2020-10-21 00:23:24'),(557,5,'127.0.0.1','Login',NULL,0,0,'2020-10-21 00:23:52','2020-10-21 00:23:52'),(558,6,'127.0.0.1','Login',NULL,0,0,'2020-10-21 00:26:23','2020-10-21 00:26:23'),(559,8,'127.0.0.1','Login',NULL,0,0,'2020-10-21 00:27:46','2020-10-21 00:27:46'),(560,8,'127.0.0.1','Login',NULL,0,0,'2020-10-21 03:17:27','2020-10-21 03:17:27'),(561,7,'127.0.0.1','Login',NULL,0,0,'2020-10-21 03:39:44','2020-10-21 03:39:44'),(562,9,'127.0.0.1','Login',NULL,0,0,'2020-10-21 03:54:59','2020-10-21 03:54:59'),(563,1,'127.0.0.1','Login',NULL,0,0,'2020-10-21 03:55:53','2020-10-21 03:55:53'),(564,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-21 03:56:01','2020-10-21 03:56:01'),(565,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-21 03:56:13','2020-10-21 03:56:13'),(566,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-21 03:56:13','2020-10-21 03:56:13'),(567,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-21 03:56:14','2020-10-21 03:56:14'),(568,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-21 03:56:37','2020-10-21 03:56:37'),(569,9,'127.0.0.1','Login',NULL,0,0,'2020-10-21 03:56:58','2020-10-21 03:56:58'),(570,2,'127.0.0.1','Login',NULL,0,0,'2020-10-21 04:47:49','2020-10-21 04:47:49'),(571,3,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:01:18','2020-10-21 05:01:18'),(572,4,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:02:51','2020-10-21 05:02:51'),(573,5,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:04:14','2020-10-21 05:04:14'),(574,5,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:07:55','2020-10-21 05:07:55'),(575,6,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:19:27','2020-10-21 05:19:27'),(576,6,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:45:06','2020-10-21 05:45:06'),(577,8,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:45:38','2020-10-21 05:45:38'),(578,9,'127.0.0.1','Login',NULL,0,0,'2020-10-21 05:46:29','2020-10-21 05:46:29'),(579,6,'127.0.0.1','Login',NULL,0,0,'2020-10-22 00:00:30','2020-10-22 00:00:30'),(580,2,'127.0.0.1','Login',NULL,0,0,'2020-10-22 03:52:04','2020-10-22 03:52:04'),(581,2,'127.0.0.1','Login',NULL,0,0,'2020-10-23 03:41:05','2020-10-23 03:41:05'),(582,3,'127.0.0.1','Login',NULL,0,0,'2020-10-23 04:04:22','2020-10-23 04:04:22'),(583,4,'127.0.0.1','Login',NULL,0,0,'2020-10-23 04:06:11','2020-10-23 04:06:11'),(584,6,'127.0.0.1','Login',NULL,0,0,'2020-10-23 04:07:45','2020-10-23 04:07:45'),(585,5,'127.0.0.1','Login',NULL,0,0,'2020-10-23 04:08:06','2020-10-23 04:08:06'),(586,6,'127.0.0.1','Login',NULL,0,0,'2020-10-23 04:09:35','2020-10-23 04:09:35'),(587,8,'127.0.0.1','Login',NULL,0,0,'2020-10-23 04:10:36','2020-10-23 04:10:36'),(588,9,'127.0.0.1','Login',NULL,0,0,'2020-10-23 04:30:57','2020-10-23 04:30:57'),(589,8,'127.0.0.1','Login',NULL,0,0,'2020-10-23 05:46:09','2020-10-23 05:46:09'),(590,6,'127.0.0.1','Login',NULL,0,0,'2020-10-26 00:03:49','2020-10-26 00:03:49'),(591,5,'127.0.0.1','Login',NULL,0,0,'2020-10-26 01:16:46','2020-10-26 01:16:46'),(592,6,'127.0.0.1','Login',NULL,0,0,'2020-10-26 01:49:38','2020-10-26 01:49:38'),(593,2,'127.0.0.1','Login',NULL,0,0,'2020-10-26 03:16:33','2020-10-26 03:16:33'),(594,3,'127.0.0.1','Login',NULL,0,0,'2020-10-26 03:26:16','2020-10-26 03:26:16'),(595,3,'127.0.0.1','Login',NULL,0,0,'2020-10-26 03:28:53','2020-10-26 03:28:53'),(596,2,'127.0.0.1','Login',NULL,0,0,'2020-10-26 03:35:36','2020-10-26 03:35:36'),(597,3,'127.0.0.1','Login',NULL,0,0,'2020-10-26 03:37:06','2020-10-26 03:37:06'),(598,4,'127.0.0.1','Login',NULL,0,0,'2020-10-26 03:46:39','2020-10-26 03:46:39'),(599,3,'127.0.0.1','Login',NULL,0,0,'2020-10-26 03:52:20','2020-10-26 03:52:20'),(600,4,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:28:32','2020-10-26 04:28:32'),(601,6,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:35:05','2020-10-26 04:35:05'),(602,4,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:35:43','2020-10-26 04:35:43'),(603,5,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:36:53','2020-10-26 04:36:53'),(604,4,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:38:29','2020-10-26 04:38:29'),(605,5,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:39:37','2020-10-26 04:39:37'),(606,6,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:41:12','2020-10-26 04:41:12'),(607,5,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:50:03','2020-10-26 04:50:03'),(608,5,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:50:46','2020-10-26 04:50:46'),(609,4,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:55:59','2020-10-26 04:55:59'),(610,6,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:56:33','2020-10-26 04:56:33'),(611,8,'127.0.0.1','Login',NULL,0,0,'2020-10-26 04:59:09','2020-10-26 04:59:09'),(612,9,'127.0.0.1','Login',NULL,0,0,'2020-10-26 05:05:09','2020-10-26 05:05:09'),(613,9,'127.0.0.1','Login',NULL,0,0,'2020-10-26 23:19:56','2020-10-26 23:19:56'),(614,1,'127.0.0.1','Login',NULL,0,0,'2020-10-27 08:27:01','2020-10-27 08:27:01'),(615,9,'127.0.0.1','Login',NULL,0,0,'2020-10-28 23:39:14','2020-10-28 23:39:14'),(616,1,'127.0.0.1','Login',NULL,0,0,'2020-10-28 23:55:01','2020-10-28 23:55:01'),(617,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-28 23:55:14','2020-10-28 23:55:14'),(618,1,'127.0.0.1','Level View',NULL,0,0,'2020-10-28 23:55:15','2020-10-28 23:55:15'),(619,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-28 23:55:44','2020-10-28 23:55:44'),(620,1,'127.0.0.1','User List',NULL,0,0,'2020-10-28 23:55:45','2020-10-28 23:55:45'),(621,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-28 23:55:49','2020-10-28 23:55:49'),(622,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-28 23:56:14','2020-10-28 23:56:14'),(623,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-28 23:56:52','2020-10-28 23:56:52'),(624,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:11:35','2020-10-29 00:11:35'),(625,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:17:02','2020-10-29 00:17:02'),(626,1,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:17:03','2020-10-29 00:17:03'),(627,1,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:17:07','2020-10-29 00:17:07'),(628,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-29 00:17:20','2020-10-29 00:17:20'),(629,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-29 00:17:23','2020-10-29 00:17:23'),(630,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-29 00:17:23','2020-10-29 00:17:23'),(631,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-29 00:17:24','2020-10-29 00:17:24'),(632,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-29 00:17:35','2020-10-29 00:17:35'),(633,7,'127.0.0.1','Login',NULL,0,0,'2020-10-29 00:18:00','2020-10-29 00:18:00'),(634,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:18:05','2020-10-29 00:18:05'),(635,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:18:16','2020-10-29 00:18:16'),(636,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:18:19','2020-10-29 00:18:19'),(637,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:18:55','2020-10-29 00:18:55'),(638,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:19:23','2020-10-29 00:19:23'),(639,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:19:45','2020-10-29 00:19:45'),(640,1,'127.0.0.1','Login',NULL,0,0,'2020-10-29 00:20:30','2020-10-29 00:20:30'),(641,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:20:39','2020-10-29 00:20:39'),(642,1,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:20:39','2020-10-29 00:20:39'),(643,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-29 00:20:45','2020-10-29 00:20:45'),(644,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-29 00:20:49','2020-10-29 00:20:49'),(645,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-29 00:20:49','2020-10-29 00:20:49'),(646,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-29 00:20:50','2020-10-29 00:20:50'),(647,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-29 00:21:02','2020-10-29 00:21:02'),(648,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:21:07','2020-10-29 00:21:07'),(649,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:21:19','2020-10-29 00:21:19'),(650,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:21:22','2020-10-29 00:21:22'),(651,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:22:09','2020-10-29 00:22:09'),(652,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-29 00:22:22','2020-10-29 00:22:22'),(653,0,'127.0.0.1','Login Failed With Username :nodal_manipur_level1@yopmail.com',NULL,0,0,'2020-10-29 00:22:51','2020-10-29 00:22:51'),(654,7,'127.0.0.1','Login',NULL,0,0,'2020-10-29 00:23:06','2020-10-29 00:23:06'),(655,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:23:11','2020-10-29 00:23:11'),(656,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:23:36','2020-10-29 00:23:36'),(657,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:23:39','2020-10-29 00:23:39'),(658,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-29 00:26:56','2020-10-29 00:26:56'),(659,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:26:59','2020-10-29 00:26:59'),(660,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:27:01','2020-10-29 00:27:01'),(661,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:27:44','2020-10-29 00:27:44'),(662,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:27:45','2020-10-29 00:27:45'),(663,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:29:26','2020-10-29 00:29:26'),(664,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:29:27','2020-10-29 00:29:27'),(665,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:29:44','2020-10-29 00:29:44'),(666,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:29:45','2020-10-29 00:29:45'),(667,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:29:47','2020-10-29 00:29:47'),(668,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:35:20','2020-10-29 00:35:20'),(669,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 00:46:57','2020-10-29 00:46:57'),(670,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 00:46:58','2020-10-29 00:46:58'),(671,9,'127.0.0.1','Login',NULL,0,0,'2020-10-29 00:59:21','2020-10-29 00:59:21'),(672,7,'127.0.0.1','Login',NULL,0,0,'2020-10-29 01:30:56','2020-10-29 01:30:56'),(673,7,'127.0.0.1','User Role',NULL,0,0,'2020-10-29 01:31:02','2020-10-29 01:31:02'),(674,7,'127.0.0.1','User Role',NULL,0,0,'2020-10-29 01:31:10','2020-10-29 01:31:10'),(675,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 01:34:25','2020-10-29 01:34:25'),(676,7,'127.0.0.1','User List',NULL,0,0,'2020-10-29 01:34:26','2020-10-29 01:34:26'),(677,7,'127.0.0.1','User Management Role',NULL,0,0,'2020-10-29 01:34:31','2020-10-29 01:34:31'),(678,2,'127.0.0.1','Login',NULL,0,0,'2020-10-29 01:35:36','2020-10-29 01:35:36'),(679,2,'127.0.0.1','Login',NULL,0,0,'2020-10-29 04:07:46','2020-10-29 04:07:46'),(680,1,'127.0.0.1','Login',NULL,0,0,'2020-10-29 04:17:32','2020-10-29 04:17:32'),(681,1,'127.0.0.1','User Role',NULL,0,0,'2020-10-29 04:17:41','2020-10-29 04:17:41'),(682,1,'127.0.0.1','Permission List',NULL,0,0,'2020-10-29 04:17:45','2020-10-29 04:17:45'),(683,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-10-29 04:17:45','2020-10-29 04:17:45'),(684,1,'127.0.0.1','Role View',NULL,0,0,'2020-10-29 04:17:46','2020-10-29 04:17:46'),(685,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-10-29 04:17:56','2020-10-29 04:17:56'),(686,5,'127.0.0.1','Login',NULL,0,0,'2020-10-29 04:18:26','2020-10-29 04:18:26'),(687,5,'127.0.0.1','User List',NULL,0,0,'2020-10-29 04:18:34','2020-10-29 04:18:34'),(688,5,'127.0.0.1','User List',NULL,0,0,'2020-10-29 04:18:44','2020-10-29 04:18:44'),(689,5,'127.0.0.1','User List',NULL,0,0,'2020-10-29 04:18:59','2020-10-29 04:18:59'),(690,1,'127.0.0.1','Login',NULL,0,0,'2020-11-02 00:42:12','2020-11-02 00:42:12'),(691,1,'127.0.0.1','Login',NULL,0,0,'2020-11-02 03:31:00','2020-11-02 03:31:00'),(692,1,'127.0.0.1','Login',NULL,0,0,'2020-11-02 04:34:21','2020-11-02 04:34:21'),(693,5,'127.0.0.1','Login',NULL,0,0,'2020-11-02 23:49:12','2020-11-02 23:49:12'),(694,3,'127.0.0.1','Login',NULL,0,0,'2020-11-03 00:00:43','2020-11-03 00:00:43'),(695,2,'127.0.0.1','Login',NULL,0,0,'2020-11-03 00:01:28','2020-11-03 00:01:28'),(696,1,'127.0.0.1','Login',NULL,0,0,'2020-11-03 00:04:20','2020-11-03 00:04:20'),(697,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-03 00:04:30','2020-11-03 00:04:30'),(698,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-03 00:04:35','2020-11-03 00:04:35'),(699,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-03 00:04:37','2020-11-03 00:04:37'),(700,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-03 00:04:42','2020-11-03 00:04:42'),(701,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-03 00:04:42','2020-11-03 00:04:42'),(702,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-03 00:04:43','2020-11-03 00:04:43'),(703,3,'127.0.0.1','Login',NULL,0,0,'2020-11-03 00:10:07','2020-11-03 00:10:07'),(704,3,'127.0.0.1','Login',NULL,0,0,'2020-11-03 00:11:47','2020-11-03 00:11:47'),(705,4,'127.0.0.1','Login',NULL,0,0,'2020-11-03 00:24:04','2020-11-03 00:24:04'),(706,5,'127.0.0.1','Login',NULL,0,0,'2020-11-03 00:59:57','2020-11-03 00:59:57'),(707,6,'127.0.0.1','Login',NULL,0,0,'2020-11-03 01:01:09','2020-11-03 01:01:09'),(708,6,'127.0.0.1','Login',NULL,0,0,'2020-11-03 02:55:12','2020-11-03 02:55:12'),(709,1,'127.0.0.1','Login',NULL,0,0,'2020-11-03 04:25:10','2020-11-03 04:25:10'),(710,1,'127.0.0.1','Login',NULL,0,0,'2020-11-03 04:25:52','2020-11-03 04:25:52'),(711,1,'127.0.0.1','Login',NULL,0,0,'2020-11-04 00:01:16','2020-11-04 00:01:16'),(712,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 00:07:20','2020-11-04 00:07:20'),(713,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 00:10:07','2020-11-04 00:10:07'),(714,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 01:22:35','2020-11-04 01:22:35'),(715,1,'127.0.0.1','Login',NULL,0,0,'2020-11-04 03:37:21','2020-11-04 03:37:21'),(716,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 05:16:22','2020-11-04 05:16:22'),(717,1,'127.0.0.1','Login',NULL,0,0,'2020-11-04 05:16:44','2020-11-04 05:16:44'),(718,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-04 05:16:52','2020-11-04 05:16:52'),(719,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-04 05:17:00','2020-11-04 05:17:00'),(720,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-04 05:17:01','2020-11-04 05:17:01'),(721,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-04 05:17:01','2020-11-04 05:17:01'),(722,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-04 05:17:10','2020-11-04 05:17:10'),(723,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 05:17:28','2020-11-04 05:17:28'),(724,1,'127.0.0.1','Login',NULL,0,0,'2020-11-04 05:19:18','2020-11-04 05:19:18'),(725,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-04 05:19:22','2020-11-04 05:19:22'),(726,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-04 05:19:26','2020-11-04 05:19:26'),(727,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-04 05:19:26','2020-11-04 05:19:26'),(728,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-04 05:19:27','2020-11-04 05:19:27'),(729,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-04 05:19:34','2020-11-04 05:19:34'),(730,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-04 05:19:36','2020-11-04 05:19:36'),(731,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-04 05:19:37','2020-11-04 05:19:37'),(732,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-04 05:19:37','2020-11-04 05:19:37'),(733,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-04 05:19:48','2020-11-04 05:19:48'),(734,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 05:20:05','2020-11-04 05:20:05'),(735,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-04 05:20:30','2020-11-04 05:20:30'),(736,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 05:20:45','2020-11-04 05:20:45'),(737,1,'127.0.0.1','Login',NULL,0,0,'2020-11-04 23:11:25','2020-11-04 23:11:25'),(738,9,'127.0.0.1','Login',NULL,0,0,'2020-11-04 23:40:26','2020-11-04 23:40:26'),(739,9,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:11:16','2020-11-05 00:11:16'),(740,2,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:12:03','2020-11-05 00:12:03'),(741,3,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:17:41','2020-11-05 00:17:41'),(742,4,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:18:53','2020-11-05 00:18:53'),(743,3,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:19:50','2020-11-05 00:19:50'),(744,4,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:22:11','2020-11-05 00:22:11'),(745,5,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:22:59','2020-11-05 00:22:59'),(746,6,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:23:45','2020-11-05 00:23:45'),(747,8,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:26:47','2020-11-05 00:26:47'),(748,8,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:35:54','2020-11-05 00:35:54'),(749,9,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:37:14','2020-11-05 00:37:14'),(750,1,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:49:01','2020-11-05 00:49:01'),(751,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-05 00:49:14','2020-11-05 00:49:14'),(752,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-05 00:49:21','2020-11-05 00:49:21'),(753,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-05 00:49:21','2020-11-05 00:49:21'),(754,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-05 00:49:21','2020-11-05 00:49:21'),(755,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-05 00:49:28','2020-11-05 00:49:28'),(756,9,'127.0.0.1','Login',NULL,0,0,'2020-11-05 00:49:46','2020-11-05 00:49:46'),(757,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:30:52','2020-11-05 01:30:52'),(758,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:32:03','2020-11-05 01:32:03'),(759,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:32:08','2020-11-05 01:32:08'),(760,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:33:00','2020-11-05 01:33:00'),(761,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:34:46','2020-11-05 01:34:46'),(762,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:36:57','2020-11-05 01:36:57'),(763,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:37:05','2020-11-05 01:37:05'),(764,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:40:28','2020-11-05 01:40:28'),(765,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:43:13','2020-11-05 01:43:13'),(766,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:44:29','2020-11-05 01:44:29'),(767,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 01:44:58','2020-11-05 01:44:58'),(768,1,'127.0.0.1','Login',NULL,0,0,'2020-11-05 03:51:36','2020-11-05 03:51:36'),(769,1,'127.0.0.1','Login',NULL,0,0,'2020-11-05 05:01:20','2020-11-05 05:01:20'),(770,1,'127.0.0.1','Login',NULL,0,0,'2020-11-05 22:38:16','2020-11-05 22:38:16'),(771,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 22:44:16','2020-11-05 22:44:16'),(772,1,'127.0.0.1','User List',NULL,0,0,'2020-11-05 22:44:17','2020-11-05 22:44:17'),(773,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-05 22:44:19','2020-11-05 22:44:19'),(774,1,'127.0.0.1','Login',NULL,0,0,'2020-11-05 23:18:05','2020-11-05 23:18:05'),(775,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-05 23:18:42','2020-11-05 23:18:42'),(776,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-05 23:18:47','2020-11-05 23:18:47'),(777,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-05 23:18:48','2020-11-05 23:18:48'),(778,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-05 23:18:48','2020-11-05 23:18:48'),(779,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-05 23:18:55','2020-11-05 23:18:55'),(780,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-05 23:33:20','2020-11-05 23:33:20'),(781,1,'127.0.0.1','Login',NULL,0,0,'2020-11-08 23:52:32','2020-11-08 23:52:32'),(782,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-09 00:09:20','2020-11-09 00:09:20'),(783,1,'127.0.0.1','User List',NULL,0,0,'2020-11-09 00:09:21','2020-11-09 00:09:21'),(784,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-09 00:09:40','2020-11-09 00:09:40'),(785,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-09 00:09:45','2020-11-09 00:09:45'),(786,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-09 00:09:45','2020-11-09 00:09:45'),(787,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-09 00:09:46','2020-11-09 00:09:46'),(788,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-09 00:10:00','2020-11-09 00:10:00'),(789,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-09 00:10:07','2020-11-09 00:10:07'),(790,1,'127.0.0.1','User List',NULL,0,0,'2020-11-09 00:10:08','2020-11-09 00:10:08'),(791,1,'127.0.0.1','Login',NULL,0,0,'2020-11-09 00:10:46','2020-11-09 00:10:46'),(792,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-09 00:10:51','2020-11-09 00:10:51'),(793,1,'127.0.0.1','User List',NULL,0,0,'2020-11-09 00:10:52','2020-11-09 00:10:52'),(794,2,'127.0.0.1','Login',NULL,0,0,'2020-11-09 01:31:08','2020-11-09 01:31:08'),(795,1,'127.0.0.1','Login',NULL,0,0,'2020-11-09 03:45:56','2020-11-09 03:45:56'),(796,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-09 03:46:03','2020-11-09 03:46:03'),(797,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-09 03:47:09','2020-11-09 03:47:09'),(798,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-09 03:47:10','2020-11-09 03:47:10'),(799,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-09 03:47:10','2020-11-09 03:47:10'),(800,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-09 03:47:46','2020-11-09 03:47:46'),(801,5,'127.0.0.1','Login',NULL,0,0,'2020-11-09 03:48:46','2020-11-09 03:48:46'),(802,5,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-09 03:48:59','2020-11-09 03:48:59'),(803,5,'127.0.0.1','User List',NULL,0,0,'2020-11-09 03:49:01','2020-11-09 03:49:01'),(804,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-09 03:49:52','2020-11-09 03:49:52'),(805,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-09 03:49:53','2020-11-09 03:49:53'),(806,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-09 03:49:53','2020-11-09 03:49:53'),(807,5,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-09 03:49:54','2020-11-09 03:49:54'),(808,5,'127.0.0.1','User List',NULL,0,0,'2020-11-09 03:49:55','2020-11-09 03:49:55'),(809,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-09 03:50:45','2020-11-09 03:50:45'),(810,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-09 03:50:46','2020-11-09 03:50:46'),(811,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-09 03:50:46','2020-11-09 03:50:46'),(812,2,'127.0.0.1','Login',NULL,0,0,'2020-11-09 04:35:40','2020-11-09 04:35:40'),(813,5,'127.0.0.1','Login',NULL,0,0,'2020-11-09 04:51:10','2020-11-09 04:51:10'),(814,9,'127.0.0.1','Login',NULL,0,0,'2020-11-09 04:53:34','2020-11-09 04:53:34'),(815,9,'127.0.0.1','Login',NULL,0,0,'2020-11-10 04:38:48','2020-11-10 04:38:48'),(816,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-10 04:38:53','2020-11-10 04:38:53'),(817,9,'127.0.0.1','User List',NULL,0,0,'2020-11-10 04:38:54','2020-11-10 04:38:54'),(818,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-10 04:39:02','2020-11-10 04:39:02'),(819,9,'127.0.0.1','User List',NULL,0,0,'2020-11-10 04:39:14','2020-11-10 04:39:14'),(820,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-10 04:39:25','2020-11-10 04:39:25'),(821,9,'127.0.0.1','User List',NULL,0,0,'2020-11-10 04:39:25','2020-11-10 04:39:25'),(822,9,'127.0.0.1','User List',NULL,0,0,'2020-11-10 04:40:12','2020-11-10 04:40:12'),(823,9,'127.0.0.1','User List',NULL,0,0,'2020-11-10 04:40:30','2020-11-10 04:40:30'),(824,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-10 04:41:38','2020-11-10 04:41:38'),(825,9,'127.0.0.1','User List',NULL,0,0,'2020-11-10 04:41:39','2020-11-10 04:41:39'),(826,9,'127.0.0.1','User List',NULL,0,0,'2020-11-10 04:42:32','2020-11-10 04:42:32'),(827,1,'127.0.0.1','Login',NULL,0,0,'2020-11-11 05:12:29','2020-11-11 05:12:29'),(828,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-11 05:12:45','2020-11-11 05:12:45'),(829,1,'127.0.0.1','User List',NULL,0,0,'2020-11-11 05:12:47','2020-11-11 05:12:47'),(830,9,'127.0.0.1','Login',NULL,0,0,'2020-11-11 05:13:09','2020-11-11 05:13:09'),(831,1,'127.0.0.1','Login',NULL,0,0,'2020-11-11 06:30:25','2020-11-11 06:30:25'),(832,9,'127.0.0.1','Login',NULL,0,0,'2020-11-11 06:30:54','2020-11-11 06:30:54'),(833,1,'127.0.0.1','Login',NULL,0,0,'2020-11-11 06:31:52','2020-11-11 06:31:52'),(834,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-11 06:31:58','2020-11-11 06:31:58'),(835,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-11 06:32:02','2020-11-11 06:32:02'),(836,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-11 06:32:03','2020-11-11 06:32:03'),(837,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-11 06:32:03','2020-11-11 06:32:03'),(838,9,'127.0.0.1','Login',NULL,0,0,'2020-11-11 07:02:30','2020-11-11 07:02:30'),(839,1,'127.0.0.1','Login',NULL,0,0,'2020-11-11 07:17:57','2020-11-11 07:17:57'),(840,8,'127.0.0.1','Login',NULL,0,0,'2020-11-11 07:23:59','2020-11-11 07:23:59'),(841,9,'127.0.0.1','Login',NULL,0,0,'2020-11-11 07:30:09','2020-11-11 07:30:09'),(842,9,'127.0.0.1','Login',NULL,0,0,'2020-11-11 22:42:42','2020-11-11 22:42:42'),(843,9,'127.0.0.1','Login',NULL,0,0,'2020-11-12 01:07:37','2020-11-12 01:07:37'),(844,9,'127.0.0.1','Login',NULL,0,0,'2020-11-12 02:10:20','2020-11-12 02:10:20'),(845,8,'127.0.0.1','Login',NULL,0,0,'2020-11-12 02:28:33','2020-11-12 02:28:33'),(846,1,'127.0.0.1','Login',NULL,0,0,'2020-11-12 02:29:08','2020-11-12 02:29:08'),(847,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-12 02:29:18','2020-11-12 02:29:18'),(848,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-12 02:29:24','2020-11-12 02:29:24'),(849,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-12 02:29:24','2020-11-12 02:29:24'),(850,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-12 02:29:24','2020-11-12 02:29:24'),(851,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-12 02:29:35','2020-11-12 02:29:35'),(852,8,'127.0.0.1','Login',NULL,0,0,'2020-11-12 02:29:58','2020-11-12 02:29:58'),(853,8,'127.0.0.1','Login',NULL,0,0,'2020-11-12 03:48:50','2020-11-12 03:48:50'),(854,9,'127.0.0.1','Login',NULL,0,0,'2020-11-12 03:49:23','2020-11-12 03:49:23'),(855,8,'127.0.0.1','Login',NULL,0,0,'2020-11-12 04:03:59','2020-11-12 04:03:59'),(856,0,'127.0.0.1','Login Failed With Username :sio_manipur_level2',NULL,0,0,'2020-11-12 04:04:30','2020-11-12 04:04:30'),(857,6,'127.0.0.1','Login',NULL,0,0,'2020-11-12 04:05:33','2020-11-12 04:05:33'),(858,5,'127.0.0.1','Login',NULL,0,0,'2020-11-12 04:05:53','2020-11-12 04:05:53'),(859,3,'127.0.0.1','Login',NULL,0,0,'2020-11-12 04:06:22','2020-11-12 04:06:22'),(860,2,'127.0.0.1','Login',NULL,0,0,'2020-11-12 04:06:53','2020-11-12 04:06:53'),(861,2,'127.0.0.1','Login',NULL,0,0,'2020-11-12 04:51:50','2020-11-12 04:51:50'),(862,3,'127.0.0.1','Login',NULL,0,0,'2020-11-12 05:00:08','2020-11-12 05:00:08'),(863,4,'127.0.0.1','Login',NULL,0,0,'2020-11-12 05:01:09','2020-11-12 05:01:09'),(864,5,'127.0.0.1','Login',NULL,0,0,'2020-11-12 05:01:50','2020-11-12 05:01:50'),(865,6,'127.0.0.1','Login',NULL,0,0,'2020-11-12 05:02:37','2020-11-12 05:02:37'),(866,8,'127.0.0.1','Login',NULL,0,0,'2020-11-12 05:04:03','2020-11-12 05:04:03'),(867,9,'127.0.0.1','Login',NULL,0,0,'2020-11-12 05:05:01','2020-11-12 05:05:01'),(868,8,'127.0.0.1','Login',NULL,0,0,'2020-11-12 05:22:01','2020-11-12 05:22:01'),(869,9,'127.0.0.1','Login',NULL,0,0,'2020-11-12 23:01:25','2020-11-12 23:01:25'),(870,8,'127.0.0.1','Login',NULL,0,0,'2020-11-13 03:00:06','2020-11-13 03:00:06'),(871,9,'127.0.0.1','Login',NULL,0,0,'2020-11-13 04:01:18','2020-11-13 04:01:18'),(872,8,'127.0.0.1','Login',NULL,0,0,'2020-11-13 04:05:41','2020-11-13 04:05:41'),(873,9,'127.0.0.1','Login',NULL,0,0,'2020-11-13 05:56:51','2020-11-13 05:56:51'),(874,8,'127.0.0.1','Login',NULL,0,0,'2020-11-13 05:59:28','2020-11-13 05:59:28'),(875,8,'127.0.0.1','Login',NULL,0,0,'2020-11-17 23:27:01','2020-11-17 23:27:01'),(876,9,'127.0.0.1','Login',NULL,0,0,'2020-11-17 23:31:45','2020-11-17 23:31:45'),(877,8,'127.0.0.1','Login',NULL,0,0,'2020-11-18 00:13:18','2020-11-18 00:13:18'),(878,1,'127.0.0.1','Login',NULL,0,0,'2020-11-18 03:31:28','2020-11-18 03:31:28'),(879,8,'127.0.0.1','Login',NULL,0,0,'2020-11-18 04:46:12','2020-11-18 04:46:12'),(880,8,'127.0.0.1','Login',NULL,0,0,'2020-11-19 02:02:04','2020-11-19 02:02:04'),(881,8,'127.0.0.1','Login',NULL,0,0,'2020-11-19 04:50:04','2020-11-19 04:50:04'),(882,9,'127.0.0.1','Login',NULL,0,0,'2020-11-19 04:50:43','2020-11-19 04:50:43'),(883,8,'127.0.0.1','Login',NULL,0,0,'2020-11-19 04:51:08','2020-11-19 04:51:08'),(884,8,'127.0.0.1','Login',NULL,0,0,'2020-11-19 23:56:13','2020-11-19 23:56:13'),(885,1,'127.0.0.1','Login',NULL,0,0,'2020-11-20 00:09:44','2020-11-20 00:09:44'),(886,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-20 00:09:49','2020-11-20 00:09:49'),(887,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-20 00:09:56','2020-11-20 00:09:56'),(888,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-20 00:09:57','2020-11-20 00:09:57'),(889,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-20 00:09:57','2020-11-20 00:09:57'),(890,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-20 00:10:05','2020-11-20 00:10:05'),(891,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-20 00:10:13','2020-11-20 00:10:13'),(892,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-20 00:10:17','2020-11-20 00:10:17'),(893,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-20 00:10:17','2020-11-20 00:10:17'),(894,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-20 00:10:18','2020-11-20 00:10:18'),(895,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-20 00:10:25','2020-11-20 00:10:25'),(896,8,'127.0.0.1','Login',NULL,0,0,'2020-11-20 01:01:07','2020-11-20 01:01:07'),(897,8,'127.0.0.1','Login',NULL,0,0,'2020-11-20 03:59:53','2020-11-20 03:59:53'),(898,1,'127.0.0.1','Login',NULL,0,0,'2020-11-20 04:40:41','2020-11-20 04:40:41'),(899,8,'127.0.0.1','Login',NULL,0,0,'2020-11-23 00:37:31','2020-11-23 00:37:31'),(900,8,'127.0.0.1','Login',NULL,0,0,'2020-11-23 04:26:49','2020-11-23 04:26:49'),(901,6,'127.0.0.1','Login',NULL,0,0,'2020-11-23 05:39:46','2020-11-23 05:39:46'),(902,8,'127.0.0.1','Login',NULL,0,0,'2020-11-23 23:29:29','2020-11-23 23:29:29'),(903,8,'127.0.0.1','Login',NULL,0,0,'2020-11-24 01:26:27','2020-11-24 01:26:27'),(904,8,'127.0.0.1','Login',NULL,0,0,'2020-11-24 03:23:33','2020-11-24 03:23:33'),(905,8,'127.0.0.1','Login',NULL,0,0,'2020-11-25 04:15:44','2020-11-25 04:15:44'),(906,8,'127.0.0.1','Login',NULL,0,0,'2020-11-25 05:51:41','2020-11-25 05:51:41'),(907,6,'127.0.0.1','Login',NULL,0,0,'2020-11-25 22:38:51','2020-11-25 22:38:51'),(908,1,'127.0.0.1','Login',NULL,0,0,'2020-11-25 22:40:54','2020-11-25 22:40:54'),(909,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-25 22:41:05','2020-11-25 22:41:05'),(910,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-25 22:41:09','2020-11-25 22:41:09'),(911,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-25 22:41:10','2020-11-25 22:41:10'),(912,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-25 22:41:10','2020-11-25 22:41:10'),(913,5,'127.0.0.1','Login',NULL,0,0,'2020-11-25 22:43:57','2020-11-25 22:43:57'),(914,4,'127.0.0.1','Login',NULL,0,0,'2020-11-25 22:45:00','2020-11-25 22:45:00'),(915,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-25 22:45:18','2020-11-25 22:45:18'),(916,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-25 22:45:29','2020-11-25 22:45:29'),(917,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-25 22:45:30','2020-11-25 22:45:30'),(918,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-25 22:45:30','2020-11-25 22:45:30'),(919,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-25 22:45:41','2020-11-25 22:45:41'),(920,4,'127.0.0.1','Login',NULL,0,0,'2020-11-25 22:46:06','2020-11-25 22:46:06'),(921,6,'127.0.0.1','Login',NULL,0,0,'2020-11-25 23:31:35','2020-11-25 23:31:35'),(922,6,'127.0.0.1','Login',NULL,0,0,'2020-11-26 01:31:13','2020-11-26 01:31:13'),(923,8,'127.0.0.1','Login',NULL,0,0,'2020-11-26 01:34:09','2020-11-26 01:34:09'),(924,6,'127.0.0.1','Login',NULL,0,0,'2020-11-26 02:58:56','2020-11-26 02:58:56'),(925,1,'127.0.0.1','Login',NULL,0,0,'2020-11-26 03:48:48','2020-11-26 03:48:48'),(926,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-26 03:48:56','2020-11-26 03:48:56'),(927,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-26 03:49:01','2020-11-26 03:49:01'),(928,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-26 03:49:01','2020-11-26 03:49:01'),(929,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-26 03:49:01','2020-11-26 03:49:01'),(930,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-26 03:49:13','2020-11-26 03:49:13'),(931,6,'127.0.0.1','Login',NULL,0,0,'2020-11-26 03:49:48','2020-11-26 03:49:48'),(932,2,'127.0.0.1','Login',NULL,0,0,'2020-11-26 05:15:18','2020-11-26 05:15:18'),(933,1,'127.0.0.1','Login',NULL,0,0,'2020-11-26 05:16:04','2020-11-26 05:16:04'),(934,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-26 05:16:09','2020-11-26 05:16:09'),(935,1,'127.0.0.1','Permission List',NULL,0,0,'2020-11-26 05:16:14','2020-11-26 05:16:14'),(936,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-11-26 05:16:14','2020-11-26 05:16:14'),(937,1,'127.0.0.1','Role View',NULL,0,0,'2020-11-26 05:16:15','2020-11-26 05:16:15'),(938,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-11-26 05:16:22','2020-11-26 05:16:22'),(939,2,'127.0.0.1','Login',NULL,0,0,'2020-11-26 05:16:49','2020-11-26 05:16:49'),(940,1,'127.0.0.1','Login',NULL,0,0,'2020-11-26 05:41:49','2020-11-26 05:41:49'),(941,0,'127.0.0.1','Login Failed With Username :sia_mainpur_level1',NULL,0,0,'2020-11-26 22:54:02','2020-11-26 22:54:02'),(942,4,'127.0.0.1','Login',NULL,0,0,'2020-11-26 22:54:40','2020-11-26 22:54:40'),(943,2,'127.0.0.1','Login',NULL,0,0,'2020-11-26 22:55:36','2020-11-26 22:55:36'),(944,3,'127.0.0.1','Login',NULL,0,0,'2020-11-26 23:05:49','2020-11-26 23:05:49'),(945,4,'127.0.0.1','Login',NULL,0,0,'2020-11-26 23:06:53','2020-11-26 23:06:53'),(946,5,'127.0.0.1','Login',NULL,0,0,'2020-11-26 23:07:51','2020-11-26 23:07:51'),(947,6,'127.0.0.1','Login',NULL,0,0,'2020-11-27 00:14:10','2020-11-27 00:14:10'),(948,9,'127.0.0.1','Login',NULL,0,0,'2020-11-27 00:18:21','2020-11-27 00:18:21'),(949,2,'127.0.0.1','Login',NULL,0,0,'2020-11-27 01:15:24','2020-11-27 01:15:24'),(950,2,'127.0.0.1','Login',NULL,0,0,'2020-11-27 02:33:13','2020-11-27 02:33:13'),(951,2,'127.0.0.1','Login',NULL,0,0,'2020-11-27 06:16:06','2020-11-27 06:16:06'),(952,2,'127.0.0.1','Login',NULL,0,0,'2020-11-29 23:13:23','2020-11-29 23:13:23'),(953,2,'127.0.0.1','Login',NULL,0,0,'2020-11-29 23:58:10','2020-11-29 23:58:10'),(954,2,'127.0.0.1','Login',NULL,0,0,'2020-11-30 04:34:05','2020-11-30 04:34:05'),(955,1,'127.0.0.1','Login',NULL,0,0,'2020-11-30 05:40:31','2020-11-30 05:40:31'),(956,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-30 05:42:14','2020-11-30 05:42:14'),(957,1,'127.0.0.1','User List',NULL,0,0,'2020-11-30 05:42:15','2020-11-30 05:42:15'),(958,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-30 05:42:16','2020-11-30 05:42:16'),(959,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-30 05:47:41','2020-11-30 05:47:41'),(960,1,'127.0.0.1','User List',NULL,0,0,'2020-11-30 05:47:42','2020-11-30 05:47:42'),(961,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-30 05:47:53','2020-11-30 05:47:53'),(962,1,'127.0.0.1','User View',NULL,0,0,'2020-11-30 05:47:55','2020-11-30 05:47:55'),(963,1,'127.0.0.1','Updated User',NULL,0,0,'2020-11-30 05:47:59','2020-11-30 05:47:59'),(964,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-11-30 05:48:02','2020-11-30 05:48:02'),(965,1,'127.0.0.1','User List',NULL,0,0,'2020-11-30 05:48:03','2020-11-30 05:48:03'),(966,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-30 05:49:23','2020-11-30 05:49:23'),(967,1,'127.0.0.1','User View',NULL,0,0,'2020-11-30 05:49:25','2020-11-30 05:49:25'),(968,1,'127.0.0.1','Updated User',NULL,0,0,'2020-11-30 05:49:50','2020-11-30 05:49:50'),(969,1,'127.0.0.1','Updated User',NULL,0,0,'2020-11-30 05:50:00','2020-11-30 05:50:00'),(970,1,'127.0.0.1','User Role',NULL,0,0,'2020-11-30 05:53:49','2020-11-30 05:53:49'),(971,1,'127.0.0.1','User View',NULL,0,0,'2020-11-30 05:53:51','2020-11-30 05:53:51'),(972,1,'127.0.0.1','Updated User',NULL,0,0,'2020-11-30 05:53:58','2020-11-30 05:53:58'),(973,1,'127.0.0.1','Updated User',NULL,0,0,'2020-11-30 05:59:56','2020-11-30 05:59:56'),(974,1,'127.0.0.1','Updated User',NULL,0,0,'2020-11-30 06:00:01','2020-11-30 06:00:01'),(975,1,'127.0.0.1','Login',NULL,0,0,'2020-11-30 23:24:09','2020-11-30 23:24:09'),(976,6,'127.0.0.1','Login',NULL,0,0,'2020-12-01 23:15:05','2020-12-01 23:15:05'),(977,1,'127.0.0.1','Login',NULL,0,0,'2020-12-01 23:23:41','2020-12-01 23:23:41'),(978,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-01 23:23:57','2020-12-01 23:23:57'),(979,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-01 23:24:09','2020-12-01 23:24:09'),(980,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-01 23:24:09','2020-12-01 23:24:09'),(981,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-01 23:24:18','2020-12-01 23:24:18'),(982,2,'127.0.0.1','Login',NULL,0,0,'2020-12-01 23:24:50','2020-12-01 23:24:50'),(983,2,'127.0.0.1','Login',NULL,0,0,'2020-12-02 00:05:24','2020-12-02 00:05:24'),(984,1,'127.0.0.1','Login',NULL,0,0,'2020-12-02 01:00:54','2020-12-02 01:00:54'),(985,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-02 01:01:00','2020-12-02 01:01:00'),(986,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-02 01:01:07','2020-12-02 01:01:07'),(987,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-02 01:01:07','2020-12-02 01:01:07'),(988,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-02 01:01:44','2020-12-02 01:01:44'),(989,2,'127.0.0.1','Login',NULL,0,0,'2020-12-02 01:02:08','2020-12-02 01:02:08'),(990,2,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 01:02:14','2020-12-02 01:02:14'),(991,2,'127.0.0.1','User List',NULL,0,0,'2020-12-02 01:02:15','2020-12-02 01:02:15'),(992,2,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 01:02:17','2020-12-02 01:02:17'),(993,2,'127.0.0.1','Created User',NULL,0,0,'2020-12-02 01:04:32','2020-12-02 01:04:32'),(994,2,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 01:04:38','2020-12-02 01:04:38'),(995,2,'127.0.0.1','User List',NULL,0,0,'2020-12-02 01:04:39','2020-12-02 01:04:39'),(996,2,'127.0.0.1','User Role',NULL,0,0,'2020-12-02 01:04:43','2020-12-02 01:04:43'),(997,2,'127.0.0.1','User View',NULL,0,0,'2020-12-02 01:04:45','2020-12-02 01:04:45'),(998,2,'127.0.0.1','Updated User',NULL,0,0,'2020-12-02 01:04:50','2020-12-02 01:04:50'),(999,2,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 01:04:52','2020-12-02 01:04:52'),(1000,2,'127.0.0.1','User List',NULL,0,0,'2020-12-02 01:04:53','2020-12-02 01:04:53'),(1001,1,'127.0.0.1','Login',NULL,0,0,'2020-12-02 03:29:31','2020-12-02 03:29:31'),(1002,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-02 03:29:36','2020-12-02 03:29:36'),(1003,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-02 03:29:46','2020-12-02 03:29:46'),(1004,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-02 03:29:47','2020-12-02 03:29:47'),(1005,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-02 03:30:35','2020-12-02 03:30:35'),(1006,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-02 03:30:36','2020-12-02 03:30:36'),(1007,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-02 03:40:16','2020-12-02 03:40:16'),(1008,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-02 03:40:23','2020-12-02 03:40:23'),(1009,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-02 03:40:27','2020-12-02 03:40:27'),(1010,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-02 03:40:27','2020-12-02 03:40:27'),(1011,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-02 03:40:49','2020-12-02 03:40:49'),(1012,9,'127.0.0.1','Login',NULL,0,0,'2020-12-02 03:41:08','2020-12-02 03:41:08'),(1013,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 03:41:17','2020-12-02 03:41:17'),(1014,9,'127.0.0.1','User List',NULL,0,0,'2020-12-02 03:41:18','2020-12-02 03:41:18'),(1015,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 03:41:38','2020-12-02 03:41:38'),(1016,9,'127.0.0.1','User List',NULL,0,0,'2020-12-02 03:41:39','2020-12-02 03:41:39'),(1017,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 03:51:18','2020-12-02 03:51:18'),(1018,9,'127.0.0.1','User List',NULL,0,0,'2020-12-02 03:51:20','2020-12-02 03:51:20'),(1019,9,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-02 03:53:05','2020-12-02 03:53:05'),(1020,9,'127.0.0.1','User List',NULL,0,0,'2020-12-02 03:53:07','2020-12-02 03:53:07'),(1021,1,'127.0.0.1','Login',NULL,0,0,'2020-12-02 03:54:14','2020-12-02 03:54:14'),(1022,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-02 03:54:23','2020-12-02 03:54:23'),(1023,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-02 03:54:32','2020-12-02 03:54:32'),(1024,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-02 03:54:32','2020-12-02 03:54:32'),(1025,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-02 03:54:51','2020-12-02 03:54:51'),(1026,9,'127.0.0.1','Login',NULL,0,0,'2020-12-02 03:55:26','2020-12-02 03:55:26'),(1027,9,'127.0.0.1','Created Designation',NULL,0,0,'2020-12-02 03:56:15','2020-12-02 03:56:15'),(1028,9,'127.0.0.1','Created Department',NULL,0,0,'2020-12-02 03:57:28','2020-12-02 03:57:28'),(1029,2,'127.0.0.1','Login',NULL,0,0,'2020-12-02 04:43:07','2020-12-02 04:43:07'),(1030,1,'127.0.0.1','Login',NULL,0,0,'2020-12-02 04:45:34','2020-12-02 04:45:34'),(1031,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-02 04:45:43','2020-12-02 04:45:43'),(1032,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-02 04:45:49','2020-12-02 04:45:49'),(1033,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-02 04:45:50','2020-12-02 04:45:50'),(1034,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-02 04:45:58','2020-12-02 04:45:58'),(1035,2,'127.0.0.1','Login',NULL,0,0,'2020-12-02 04:46:26','2020-12-02 04:46:26'),(1036,2,'127.0.0.1','Login',NULL,0,0,'2020-12-03 23:09:33','2020-12-03 23:09:33'),(1037,2,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-03 23:25:04','2020-12-03 23:25:04'),(1038,2,'127.0.0.1','User List',NULL,0,0,'2020-12-03 23:25:05','2020-12-03 23:25:05'),(1039,1,'127.0.0.1','Login',NULL,0,0,'2020-12-04 00:25:50','2020-12-04 00:25:50'),(1040,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-04 00:25:57','2020-12-04 00:25:57'),(1041,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-04 00:26:05','2020-12-04 00:26:05'),(1042,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-04 00:26:05','2020-12-04 00:26:05'),(1043,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-04 00:26:16','2020-12-04 00:26:16'),(1044,2,'127.0.0.1','Login',NULL,0,0,'2020-12-04 00:26:44','2020-12-04 00:26:44'),(1045,2,'127.0.0.1','Login',NULL,0,0,'2020-12-04 01:00:25','2020-12-04 01:00:25'),(1046,2,'127.0.0.1','Login',NULL,0,0,'2020-12-04 03:03:20','2020-12-04 03:03:20'),(1047,1,'127.0.0.1','Login',NULL,0,0,'2020-12-04 03:54:13','2020-12-04 03:54:13'),(1048,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-04 03:54:20','2020-12-04 03:54:20'),(1049,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-04 03:54:25','2020-12-04 03:54:25'),(1050,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-04 03:54:25','2020-12-04 03:54:25'),(1051,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-04 03:54:41','2020-12-04 03:54:41'),(1052,2,'127.0.0.1','Login',NULL,0,0,'2020-12-07 00:05:23','2020-12-07 00:05:23'),(1053,2,'127.0.0.1','Login',NULL,0,0,'2020-12-07 22:58:53','2020-12-07 22:58:53'),(1054,2,'127.0.0.1','Login',NULL,0,0,'2020-12-08 01:53:20','2020-12-08 01:53:20'),(1055,2,'127.0.0.1','Login',NULL,0,0,'2020-12-08 05:12:22','2020-12-08 05:12:22'),(1056,1,'127.0.0.1','Login',NULL,0,0,'2020-12-08 05:27:53','2020-12-08 05:27:53'),(1057,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-08 05:28:01','2020-12-08 05:28:01'),(1058,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-08 05:28:07','2020-12-08 05:28:07'),(1059,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-08 05:28:07','2020-12-08 05:28:07'),(1060,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-08 05:28:16','2020-12-08 05:28:16'),(1061,2,'127.0.0.1','Login',NULL,0,0,'2020-12-08 05:57:03','2020-12-08 05:57:03'),(1062,2,'127.0.0.1','Login',NULL,0,0,'2020-12-08 23:38:38','2020-12-08 23:38:38'),(1063,2,'127.0.0.1','Login',NULL,0,0,'2020-12-09 03:44:53','2020-12-09 03:44:53'),(1064,2,'127.0.0.1','Login',NULL,0,0,'2020-12-09 05:20:53','2020-12-09 05:20:53'),(1065,2,'127.0.0.1','Login',NULL,0,0,'2020-12-09 23:15:01','2020-12-09 23:15:01'),(1066,10,'127.0.0.1','Login',NULL,0,0,'2020-12-10 03:41:29','2020-12-10 03:41:29'),(1067,1,'127.0.0.1','Login',NULL,0,0,'2020-12-10 03:42:09','2020-12-10 03:42:09'),(1068,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-10 03:42:15','2020-12-10 03:42:15'),(1069,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-10 03:42:21','2020-12-10 03:42:21'),(1070,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-10 03:42:21','2020-12-10 03:42:21'),(1071,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-10 03:43:30','2020-12-10 03:43:30'),(1072,10,'127.0.0.1','Login',NULL,0,0,'2020-12-10 03:43:55','2020-12-10 03:43:55'),(1073,2,'127.0.0.1','Login',NULL,0,0,'2020-12-10 04:17:01','2020-12-10 04:17:01'),(1074,2,'127.0.0.1','Login',NULL,0,0,'2020-12-10 04:42:21','2020-12-10 04:42:21'),(1075,1,'127.0.0.1','Login',NULL,0,0,'2020-12-10 04:58:58','2020-12-10 04:58:58'),(1076,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-10 04:59:05','2020-12-10 04:59:05'),(1077,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-10 04:59:18','2020-12-10 04:59:18'),(1078,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-10 04:59:19','2020-12-10 04:59:19'),(1079,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-10 05:00:30','2020-12-10 05:00:30'),(1080,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-10 05:00:31','2020-12-10 05:00:31'),(1081,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-10 05:00:46','2020-12-10 05:00:46'),(1082,1,'127.0.0.1','Login',NULL,0,0,'2020-12-10 05:01:20','2020-12-10 05:01:20'),(1083,2,'127.0.0.1','Login',NULL,0,0,'2020-12-10 05:01:39','2020-12-10 05:01:39'),(1084,2,'127.0.0.1','Login',NULL,0,0,'2020-12-10 05:35:07','2020-12-10 05:35:07'),(1085,2,'127.0.0.1','Login',NULL,0,0,'2020-12-10 22:58:25','2020-12-10 22:58:25'),(1086,1,'127.0.0.1','Login',NULL,0,0,'2020-12-11 00:50:43','2020-12-11 00:50:43'),(1087,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-11 00:52:02','2020-12-11 00:52:02'),(1088,1,'127.0.0.1','User List',NULL,0,0,'2020-12-11 00:52:04','2020-12-11 00:52:04'),(1089,2,'127.0.0.1','Login',NULL,0,0,'2020-12-11 03:19:33','2020-12-11 03:19:33'),(1090,2,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-11 03:26:37','2020-12-11 03:26:37'),(1091,2,'127.0.0.1','User List',NULL,0,0,'2020-12-11 03:26:38','2020-12-11 03:26:38'),(1092,2,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-11 03:26:40','2020-12-11 03:26:40'),(1093,9,'127.0.0.1','Login',NULL,0,0,'2020-12-11 03:31:25','2020-12-11 03:31:25'),(1094,8,'127.0.0.1','Login',NULL,0,0,'2020-12-11 03:32:24','2020-12-11 03:32:24'),(1095,2,'127.0.0.1','Login',NULL,0,0,'2020-12-11 04:16:11','2020-12-11 04:16:11'),(1096,3,'127.0.0.1','Login',NULL,0,0,'2020-12-11 04:58:13','2020-12-11 04:58:13'),(1097,4,'127.0.0.1','Login',NULL,0,0,'2020-12-11 04:59:17','2020-12-11 04:59:17'),(1098,5,'127.0.0.1','Login',NULL,0,0,'2020-12-11 04:59:56','2020-12-11 04:59:56'),(1099,1,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:00:40','2020-12-11 05:00:40'),(1100,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-11 05:00:51','2020-12-11 05:00:51'),(1101,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-11 05:00:57','2020-12-11 05:00:57'),(1102,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-11 05:00:57','2020-12-11 05:00:57'),(1103,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-11 05:01:12','2020-12-11 05:01:12'),(1104,5,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:01:36','2020-12-11 05:01:36'),(1105,6,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:02:40','2020-12-11 05:02:40'),(1106,8,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:03:42','2020-12-11 05:03:42'),(1107,9,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:04:27','2020-12-11 05:04:27'),(1108,1,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:08:07','2020-12-11 05:08:07'),(1109,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-11 05:08:11','2020-12-11 05:08:11'),(1110,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-11 05:08:15','2020-12-11 05:08:15'),(1111,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-11 05:08:16','2020-12-11 05:08:16'),(1112,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-11 05:08:29','2020-12-11 05:08:29'),(1113,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-11 05:08:33','2020-12-11 05:08:33'),(1114,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-11 05:08:37','2020-12-11 05:08:37'),(1115,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-11 05:08:38','2020-12-11 05:08:38'),(1116,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-11 05:08:39','2020-12-11 05:08:39'),(1117,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-11 05:08:43','2020-12-11 05:08:43'),(1118,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-11 05:08:43','2020-12-11 05:08:43'),(1119,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-11 05:09:01','2020-12-11 05:09:01'),(1120,9,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:09:20','2020-12-11 05:09:20'),(1121,1,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:12:29','2020-12-11 05:12:29'),(1122,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-11 05:12:37','2020-12-11 05:12:37'),(1123,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-11 05:12:41','2020-12-11 05:12:41'),(1124,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-11 05:12:42','2020-12-11 05:12:42'),(1125,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-11 05:12:52','2020-12-11 05:12:52'),(1126,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-11 05:12:56','2020-12-11 05:12:56'),(1127,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-11 05:13:00','2020-12-11 05:13:00'),(1128,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-11 05:13:00','2020-12-11 05:13:00'),(1129,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-11 05:13:07','2020-12-11 05:13:07'),(1130,9,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:13:30','2020-12-11 05:13:30'),(1131,8,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:21:05','2020-12-11 05:21:05'),(1132,2,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:54:20','2020-12-11 05:54:20'),(1133,8,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:54:47','2020-12-11 05:54:47'),(1134,6,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:55:54','2020-12-11 05:55:54'),(1135,1,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:56:20','2020-12-11 05:56:20'),(1136,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-11 05:56:33','2020-12-11 05:56:33'),(1137,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-11 05:56:38','2020-12-11 05:56:38'),(1138,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-11 05:56:38','2020-12-11 05:56:38'),(1139,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-11 05:56:58','2020-12-11 05:56:58'),(1140,6,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:57:27','2020-12-11 05:57:27'),(1141,2,'127.0.0.1','Login',NULL,0,0,'2020-12-11 05:58:47','2020-12-11 05:58:47'),(1142,6,'127.0.0.1','Login',NULL,0,0,'2020-12-11 06:12:54','2020-12-11 06:12:54'),(1143,8,'127.0.0.1','Login',NULL,0,0,'2020-12-11 06:14:56','2020-12-11 06:14:56'),(1144,2,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:17:20','2020-12-13 23:17:20'),(1145,3,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:27:59','2020-12-13 23:27:59'),(1146,4,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:29:35','2020-12-13 23:29:35'),(1147,5,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:30:49','2020-12-13 23:30:49'),(1148,6,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:37:17','2020-12-13 23:37:17'),(1149,8,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:38:56','2020-12-13 23:38:56'),(1150,9,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:40:27','2020-12-13 23:40:27'),(1151,8,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:43:48','2020-12-13 23:43:48'),(1152,6,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:45:59','2020-12-13 23:45:59'),(1153,2,'127.0.0.1','Login',NULL,0,0,'2020-12-13 23:50:26','2020-12-13 23:50:26'),(1154,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:13:56','2020-12-14 03:13:56'),(1155,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:14:21','2020-12-14 03:14:21'),(1156,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:14:28','2020-12-14 03:14:28'),(1157,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:23:23','2020-12-14 03:23:23'),(1158,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:23:29','2020-12-14 03:23:29'),(1159,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:23:33','2020-12-14 03:23:33'),(1160,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:24:32','2020-12-14 03:24:32'),(1161,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:24:36','2020-12-14 03:24:36'),(1162,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:24:37','2020-12-14 03:24:37'),(1163,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:26:36','2020-12-14 03:26:36'),(1164,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:26:37','2020-12-14 03:26:37'),(1165,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:26:38','2020-12-14 03:26:38'),(1166,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:28:33','2020-12-14 03:28:33'),(1167,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:28:35','2020-12-14 03:28:35'),(1168,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:28:36','2020-12-14 03:28:36'),(1169,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:23','2020-12-14 03:39:23'),(1170,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:25','2020-12-14 03:39:25'),(1171,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:26','2020-12-14 03:39:26'),(1172,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:27','2020-12-14 03:39:27'),(1173,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:30','2020-12-14 03:39:30'),(1174,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:45','2020-12-14 03:39:45'),(1175,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:46','2020-12-14 03:39:46'),(1176,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:47','2020-12-14 03:39:47'),(1177,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:48','2020-12-14 03:39:48'),(1178,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:50','2020-12-14 03:39:50'),(1179,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:58','2020-12-14 03:39:58'),(1180,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:39:59','2020-12-14 03:39:59'),(1181,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:40:00','2020-12-14 03:40:00'),(1182,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:50:42','2020-12-14 03:50:42'),(1183,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:50:43','2020-12-14 03:50:43'),(1184,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:50:45','2020-12-14 03:50:45'),(1185,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:52:12','2020-12-14 03:52:12'),(1186,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:52:13','2020-12-14 03:52:13'),(1187,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:52:15','2020-12-14 03:52:15'),(1188,9,'127.0.0.1','Login',NULL,0,0,'2020-12-14 03:56:21','2020-12-14 03:56:21'),(1189,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:59:06','2020-12-14 03:59:06'),(1190,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 03:59:07','2020-12-14 03:59:07'),(1191,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:44:42','2020-12-14 22:44:42'),(1192,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:44:48','2020-12-14 22:44:48'),(1193,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:44:51','2020-12-14 22:44:51'),(1194,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:46:01','2020-12-14 22:46:01'),(1195,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:46:18','2020-12-14 22:46:18'),(1196,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:46:53','2020-12-14 22:46:53'),(1197,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:47:04','2020-12-14 22:47:04'),(1198,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:47:09','2020-12-14 22:47:09'),(1199,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:47:15','2020-12-14 22:47:15'),(1200,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:48:10','2020-12-14 22:48:10'),(1201,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:48:13','2020-12-14 22:48:13'),(1202,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:48:15','2020-12-14 22:48:15'),(1203,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:50:08','2020-12-14 22:50:08'),(1204,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:50:10','2020-12-14 22:50:10'),(1205,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:50:12','2020-12-14 22:50:12'),(1206,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:51:21','2020-12-14 22:51:21'),(1207,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:51:24','2020-12-14 22:51:24'),(1208,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:51:28','2020-12-14 22:51:28'),(1209,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:54:00','2020-12-14 22:54:00'),(1210,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:54:03','2020-12-14 22:54:03'),(1211,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-14 22:54:08','2020-12-14 22:54:08'),(1212,0,'127.0.0.1','Login Failed With Username :super.admin',NULL,0,0,'2020-12-14 23:05:04','2020-12-14 23:05:04'),(1213,1,'127.0.0.1','Login',NULL,0,0,'2020-12-14 23:05:17','2020-12-14 23:05:17'),(1214,1,'127.0.0.1','Created Id Proof',NULL,0,0,'2020-12-14 23:53:37','2020-12-14 23:53:37'),(1215,1,'127.0.0.1','Login',NULL,0,0,'2020-12-15 00:25:36','2020-12-15 00:25:36'),(1216,10,'127.0.0.1','Login',NULL,0,0,'2020-12-15 01:53:08','2020-12-15 01:53:08'),(1217,1,'127.0.0.1','Login',NULL,0,0,'2020-12-15 05:16:06','2020-12-15 05:16:06'),(1218,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-15 05:16:19','2020-12-15 05:16:19'),(1219,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 05:16:27','2020-12-15 05:16:27'),(1220,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 05:16:28','2020-12-15 05:16:28'),(1221,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-15 05:16:54','2020-12-15 05:16:54'),(1222,1,'127.0.0.1','Login',NULL,0,0,'2020-12-15 22:50:55','2020-12-15 22:50:55'),(1223,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-15 22:51:02','2020-12-15 22:51:02'),(1224,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 22:51:09','2020-12-15 22:51:09'),(1225,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 22:51:10','2020-12-15 22:51:10'),(1226,1,'127.0.0.1','Login',NULL,0,0,'2020-12-15 23:33:31','2020-12-15 23:33:31'),(1227,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-15 23:34:05','2020-12-15 23:34:05'),(1228,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:34:12','2020-12-15 23:34:12'),(1229,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:34:12','2020-12-15 23:34:12'),(1230,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:38:41','2020-12-15 23:38:41'),(1231,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:38:41','2020-12-15 23:38:41'),(1232,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:40:08','2020-12-15 23:40:08'),(1233,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:40:09','2020-12-15 23:40:09'),(1234,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:41:21','2020-12-15 23:41:21'),(1235,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:41:21','2020-12-15 23:41:21'),(1236,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:42:58','2020-12-15 23:42:58'),(1237,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:42:59','2020-12-15 23:42:59'),(1238,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:43:10','2020-12-15 23:43:10'),(1239,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:43:11','2020-12-15 23:43:11'),(1240,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:43:28','2020-12-15 23:43:28'),(1241,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:43:28','2020-12-15 23:43:28'),(1242,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-15 23:56:59','2020-12-15 23:56:59'),(1243,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-15 23:57:00','2020-12-15 23:57:00'),(1244,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-16 00:03:03','2020-12-16 00:03:03'),(1245,1,'127.0.0.1','User List',NULL,0,0,'2020-12-16 00:03:04','2020-12-16 00:03:04'),(1246,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-16 00:45:59','2020-12-16 00:45:59'),(1247,1,'127.0.0.1','User List',NULL,0,0,'2020-12-16 00:46:00','2020-12-16 00:46:00'),(1248,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-16 00:46:03','2020-12-16 00:46:03'),(1249,1,'127.0.0.1','Login',NULL,0,0,'2020-12-16 01:40:25','2020-12-16 01:40:25'),(1250,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 01:40:36','2020-12-16 01:40:36'),(1251,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 01:41:03','2020-12-16 01:41:03'),(1252,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 01:41:03','2020-12-16 01:41:03'),(1253,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 01:41:49','2020-12-16 01:41:49'),(1254,2,'127.0.0.1','Login',NULL,0,0,'2020-12-16 01:42:14','2020-12-16 01:42:14'),(1255,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 01:43:49','2020-12-16 01:43:49'),(1256,3,'127.0.0.1','Login',NULL,0,0,'2020-12-16 01:51:34','2020-12-16 01:51:34'),(1257,4,'127.0.0.1','Login',NULL,0,0,'2020-12-16 01:52:57','2020-12-16 01:52:57'),(1258,5,'127.0.0.1','Login',NULL,0,0,'2020-12-16 01:56:21','2020-12-16 01:56:21'),(1259,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 01:56:34','2020-12-16 01:56:34'),(1260,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 01:56:53','2020-12-16 01:56:53'),(1261,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 01:56:54','2020-12-16 01:56:54'),(1262,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 01:57:05','2020-12-16 01:57:05'),(1263,0,'127.0.0.1','Login Failed With Username :sia_manipur_level1',NULL,0,0,'2020-12-16 01:57:27','2020-12-16 01:57:27'),(1264,5,'127.0.0.1','Login',NULL,0,0,'2020-12-16 01:57:35','2020-12-16 01:57:35'),(1265,6,'127.0.0.1','Login',NULL,0,0,'2020-12-16 01:59:20','2020-12-16 01:59:20'),(1266,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 02:04:28','2020-12-16 02:04:28'),(1267,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 02:04:28','2020-12-16 02:04:28'),(1268,6,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:24:35','2020-12-16 02:24:35'),(1269,6,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:25:02','2020-12-16 02:25:02'),(1270,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:26:36','2020-12-16 02:26:36'),(1271,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 02:26:48','2020-12-16 02:26:48'),(1272,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 02:26:52','2020-12-16 02:26:52'),(1273,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 02:26:52','2020-12-16 02:26:52'),(1274,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 02:27:16','2020-12-16 02:27:16'),(1275,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:27:47','2020-12-16 02:27:47'),(1276,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:28:58','2020-12-16 02:28:58'),(1277,9,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:30:00','2020-12-16 02:30:00'),(1278,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 02:30:13','2020-12-16 02:30:13'),(1279,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 02:30:17','2020-12-16 02:30:17'),(1280,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 02:30:17','2020-12-16 02:30:17'),(1281,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 02:30:45','2020-12-16 02:30:45'),(1282,9,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:31:05','2020-12-16 02:31:05'),(1283,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 02:31:48','2020-12-16 02:31:48'),(1284,9,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:33:13','2020-12-16 02:33:13'),(1285,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 02:33:40','2020-12-16 02:33:40'),(1286,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 02:46:48','2020-12-16 02:46:48'),(1287,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 02:46:55','2020-12-16 02:46:55'),(1288,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 02:46:56','2020-12-16 02:46:56'),(1289,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 02:47:12','2020-12-16 02:47:12'),(1290,9,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:47:27','2020-12-16 02:47:27'),(1291,0,'127.0.0.1','Login Failed With Username :nodal_manipur',NULL,0,0,'2020-12-16 02:57:39','2020-12-16 02:57:39'),(1292,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:58:03','2020-12-16 02:58:03'),(1293,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 02:58:27','2020-12-16 02:58:27'),(1294,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 02:58:32','2020-12-16 02:58:32'),(1295,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 02:58:32','2020-12-16 02:58:32'),(1296,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 02:58:53','2020-12-16 02:58:53'),(1297,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:59:17','2020-12-16 02:59:17'),(1298,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 02:59:31','2020-12-16 02:59:31'),(1299,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 02:59:55','2020-12-16 02:59:55'),(1300,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 03:00:17','2020-12-16 03:00:17'),(1301,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 03:00:22','2020-12-16 03:00:22'),(1302,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 03:00:25','2020-12-16 03:00:25'),(1303,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 03:00:25','2020-12-16 03:00:25'),(1304,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 03:00:37','2020-12-16 03:00:37'),(1305,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:00:58','2020-12-16 03:00:58'),(1306,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 03:01:40','2020-12-16 03:01:40'),(1307,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 03:01:46','2020-12-16 03:01:46'),(1308,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 03:01:46','2020-12-16 03:01:46'),(1309,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:02:17','2020-12-16 03:02:17'),(1310,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 03:02:27','2020-12-16 03:02:27'),(1311,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 03:02:32','2020-12-16 03:02:32'),(1312,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 03:02:32','2020-12-16 03:02:32'),(1313,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 03:02:42','2020-12-16 03:02:42'),(1314,8,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:03:06','2020-12-16 03:03:06'),(1315,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 03:04:03','2020-12-16 03:04:03'),(1316,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 03:04:31','2020-12-16 03:04:31'),(1317,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 03:04:31','2020-12-16 03:04:31'),(1318,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 03:04:59','2020-12-16 03:04:59'),(1319,2,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:05:19','2020-12-16 03:05:19'),(1320,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 03:06:01','2020-12-16 03:06:01'),(1321,0,'127.0.0.1','Login Failed With Username :manipur',NULL,0,0,'2020-12-16 03:06:16','2020-12-16 03:06:16'),(1322,2,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:06:28','2020-12-16 03:06:28'),(1323,2,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:06:40','2020-12-16 03:06:40'),(1324,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 03:11:59','2020-12-16 03:11:59'),(1325,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 03:12:06','2020-12-16 03:12:06'),(1326,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 03:12:11','2020-12-16 03:12:11'),(1327,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 03:12:12','2020-12-16 03:12:12'),(1328,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 03:12:28','2020-12-16 03:12:28'),(1329,6,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:12:32','2020-12-16 03:12:32'),(1330,2,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:13:28','2020-12-16 03:13:28'),(1331,2,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:13:44','2020-12-16 03:13:44'),(1332,9,'127.0.0.1','Login',NULL,0,0,'2020-12-16 03:54:40','2020-12-16 03:54:40'),(1333,1,'127.0.0.1','Login',NULL,0,0,'2020-12-16 04:35:10','2020-12-16 04:35:10'),(1334,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 04:36:16','2020-12-16 04:36:16'),(1335,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-16 04:36:20','2020-12-16 04:36:20'),(1336,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-16 04:36:21','2020-12-16 04:36:21'),(1337,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:36:32','2020-12-16 04:36:32'),(1338,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:42:16','2020-12-16 04:42:16'),(1339,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:43:45','2020-12-16 04:43:45'),(1340,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:44:09','2020-12-16 04:44:09'),(1341,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:44:55','2020-12-16 04:44:55'),(1342,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:50:54','2020-12-16 04:50:54'),(1343,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:52:27','2020-12-16 04:52:27'),(1344,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:52:49','2020-12-16 04:52:49'),(1345,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:53:01','2020-12-16 04:53:01'),(1346,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:58:30','2020-12-16 04:58:30'),(1347,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 04:58:55','2020-12-16 04:58:55'),(1348,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 05:01:57','2020-12-16 05:01:57'),(1349,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-16 05:02:18','2020-12-16 05:02:18'),(1350,1,'127.0.0.1','Login',NULL,0,0,'2020-12-16 05:03:00','2020-12-16 05:03:00'),(1351,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-16 05:03:06','2020-12-16 05:03:06'),(1352,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-16 05:03:10','2020-12-16 05:03:10'),(1353,1,'127.0.0.1','User List',NULL,0,0,'2020-12-16 05:03:11','2020-12-16 05:03:11'),(1354,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-16 05:03:27','2020-12-16 05:03:27'),(1355,1,'127.0.0.1','User List',NULL,0,0,'2020-12-16 05:03:28','2020-12-16 05:03:28'),(1356,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-16 05:04:46','2020-12-16 05:04:46'),(1357,1,'127.0.0.1','User List',NULL,0,0,'2020-12-16 05:04:47','2020-12-16 05:04:47'),(1358,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-16 05:06:16','2020-12-16 05:06:16'),(1359,1,'127.0.0.1','User List',NULL,0,0,'2020-12-16 05:06:17','2020-12-16 05:06:17'),(1360,10,'127.0.0.1','Login',NULL,0,0,'2020-12-16 23:41:31','2020-12-16 23:41:31'),(1361,1,'127.0.0.1','Login',NULL,0,0,'2020-12-17 23:41:25','2020-12-17 23:41:25'),(1362,10,'127.0.0.1','Login',NULL,0,0,'2020-12-17 23:42:49','2020-12-17 23:42:49'),(1363,2,'127.0.0.1','Login',NULL,0,0,'2020-12-18 03:34:49','2020-12-18 03:34:49'),(1364,1,'127.0.0.1','Login',NULL,0,0,'2020-12-18 08:47:02','2020-12-18 08:47:02'),(1365,10,'127.0.0.1','Login',NULL,0,0,'2020-12-21 00:10:06','2020-12-21 00:10:06'),(1366,1,'127.0.0.1','Login',NULL,0,0,'2020-12-21 00:43:21','2020-12-21 00:43:21'),(1367,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-21 00:43:30','2020-12-21 00:43:30'),(1368,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-21 00:43:35','2020-12-21 00:43:35'),(1369,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-21 00:43:35','2020-12-21 00:43:35'),(1370,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-21 00:44:11','2020-12-21 00:44:11'),(1371,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-21 00:44:58','2020-12-21 00:44:58'),(1372,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-21 00:45:07','2020-12-21 00:45:07'),(1373,10,'127.0.0.1','Login',NULL,0,0,'2020-12-21 00:47:05','2020-12-21 00:47:05'),(1374,1,'127.0.0.1','Login',NULL,0,0,'2020-12-21 00:52:24','2020-12-21 00:52:24'),(1375,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-21 00:52:28','2020-12-21 00:52:28'),(1376,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-21 00:52:34','2020-12-21 00:52:34'),(1377,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-21 00:52:34','2020-12-21 00:52:34'),(1378,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-21 00:53:21','2020-12-21 00:53:21'),(1379,1,'127.0.0.1','User List',NULL,0,0,'2020-12-21 00:53:23','2020-12-21 00:53:23'),(1380,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-21 00:53:34','2020-12-21 00:53:34'),(1381,1,'127.0.0.1','User List',NULL,0,0,'2020-12-21 00:53:35','2020-12-21 00:53:35'),(1382,10,'127.0.0.1','Login',NULL,0,0,'2020-12-21 00:53:52','2020-12-21 00:53:52'),(1383,10,'127.0.0.1','Login',NULL,0,0,'2020-12-21 03:22:13','2020-12-21 03:22:13'),(1384,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:35:06','2020-12-21 23:35:06'),(1385,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:35:12','2020-12-21 23:35:12'),(1386,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:35:17','2020-12-21 23:35:17'),(1387,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:52:21','2020-12-21 23:52:21'),(1388,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:52:25','2020-12-21 23:52:25'),(1389,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:52:29','2020-12-21 23:52:29'),(1390,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:53:56','2020-12-21 23:53:56'),(1391,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:53:59','2020-12-21 23:53:59'),(1392,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:54:02','2020-12-21 23:54:02'),(1393,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:54:57','2020-12-21 23:54:57'),(1394,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:57:22','2020-12-21 23:57:22'),(1395,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:57:27','2020-12-21 23:57:27'),(1396,0,'127.0.0.1','Login Failed With Username :pa_senapati',NULL,0,0,'2020-12-21 23:57:31','2020-12-21 23:57:31'),(1397,2,'127.0.0.1','Login',NULL,0,0,'2020-12-21 23:58:54','2020-12-21 23:58:54'),(1398,6,'127.0.0.1','Login',NULL,0,0,'2020-12-22 00:57:41','2020-12-22 00:57:41'),(1399,4,'127.0.0.1','Login',NULL,0,0,'2020-12-22 01:48:38','2020-12-22 01:48:38'),(1400,6,'127.0.0.1','Login',NULL,0,0,'2020-12-22 02:03:09','2020-12-22 02:03:09'),(1401,2,'127.0.0.1','Login',NULL,0,0,'2020-12-22 03:43:48','2020-12-22 03:43:48'),(1402,5,'127.0.0.1','Login',NULL,0,0,'2020-12-22 03:52:41','2020-12-22 03:52:41'),(1403,9,'127.0.0.1','Login',NULL,0,0,'2020-12-22 04:36:24','2020-12-22 04:36:24'),(1404,2,'127.0.0.1','Login',NULL,0,0,'2020-12-22 04:40:03','2020-12-22 04:40:03'),(1405,3,'127.0.0.1','Login',NULL,0,0,'2020-12-22 04:49:21','2020-12-22 04:49:21'),(1406,1,'127.0.0.1','Login',NULL,0,0,'2020-12-22 04:51:16','2020-12-22 04:51:16'),(1407,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-22 04:53:11','2020-12-22 04:53:11'),(1408,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-22 04:53:17','2020-12-22 04:53:17'),(1409,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-22 04:53:18','2020-12-22 04:53:18'),(1410,3,'127.0.0.1','Login',NULL,0,0,'2020-12-22 04:54:03','2020-12-22 04:54:03'),(1411,2,'127.0.0.1','Login',NULL,0,0,'2020-12-22 04:54:23','2020-12-22 04:54:23'),(1412,1,'127.0.0.1','User Management Role',NULL,0,0,'2020-12-22 04:54:39','2020-12-22 04:54:39'),(1413,1,'127.0.0.1','User List',NULL,0,0,'2020-12-22 04:54:40','2020-12-22 04:54:40'),(1414,3,'127.0.0.1','Login',NULL,0,0,'2020-12-22 04:55:45','2020-12-22 04:55:45'),(1415,3,'127.0.0.1','Login',NULL,0,0,'2020-12-22 05:07:12','2020-12-22 05:07:12'),(1416,4,'127.0.0.1','Login',NULL,0,0,'2020-12-22 05:42:13','2020-12-22 05:42:13'),(1417,5,'127.0.0.1','Login',NULL,0,0,'2020-12-22 05:43:04','2020-12-22 05:43:04'),(1418,6,'127.0.0.1','Login',NULL,0,0,'2020-12-22 05:44:31','2020-12-22 05:44:31'),(1419,6,'127.0.0.1','Login',NULL,0,0,'2020-12-22 06:09:49','2020-12-22 06:09:49'),(1420,0,'127.0.0.1','Login Failed With Username :nodal_.manipur_level2',NULL,0,0,'2020-12-22 06:10:56','2020-12-22 06:10:56'),(1421,8,'127.0.0.1','Login',NULL,0,0,'2020-12-22 06:11:34','2020-12-22 06:11:34'),(1422,9,'127.0.0.1','Login',NULL,0,0,'2020-12-22 06:31:05','2020-12-22 06:31:05'),(1423,10,'127.0.0.1','Login',NULL,0,0,'2020-12-22 23:26:07','2020-12-22 23:26:07'),(1424,10,'127.0.0.1','Login',NULL,0,0,'2020-12-22 23:49:10','2020-12-22 23:49:10'),(1425,10,'127.0.0.1','Login',NULL,0,0,'2020-12-23 03:07:54','2020-12-23 03:07:54'),(1426,10,'127.0.0.1','Year List',NULL,0,0,'2020-12-23 05:10:23','2020-12-23 05:10:23'),(1427,10,'127.0.0.1','Year List',NULL,0,0,'2020-12-23 05:10:30','2020-12-23 05:10:30'),(1428,10,'127.0.0.1','Year List',NULL,0,0,'2020-12-23 05:10:40','2020-12-23 05:10:40'),(1429,10,'127.0.0.1','Login',NULL,0,0,'2020-12-23 05:46:14','2020-12-23 05:46:14'),(1430,2,'127.0.0.1','Login',NULL,0,0,'2020-12-23 06:27:11','2020-12-23 06:27:11'),(1431,6,'127.0.0.1','Login',NULL,0,0,'2020-12-23 06:29:30','2020-12-23 06:29:30'),(1432,2,'127.0.0.1','Login',NULL,0,0,'2020-12-23 06:30:18','2020-12-23 06:30:18'),(1433,2,'127.0.0.1','Login',NULL,0,0,'2020-12-23 23:42:22','2020-12-23 23:42:22'),(1434,2,'127.0.0.1','Login',NULL,0,0,'2020-12-24 03:08:58','2020-12-24 03:08:58'),(1435,1,'127.0.0.1','Login',NULL,0,0,'2020-12-24 03:09:47','2020-12-24 03:09:47'),(1436,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-24 03:09:52','2020-12-24 03:09:52'),(1437,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-24 03:09:57','2020-12-24 03:09:57'),(1438,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-24 03:10:01','2020-12-24 03:10:01'),(1439,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-24 03:10:05','2020-12-24 03:10:05'),(1440,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-24 03:10:05','2020-12-24 03:10:05'),(1441,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2020-12-24 03:10:15','2020-12-24 03:10:15'),(1442,2,'127.0.0.1','Login',NULL,0,0,'2020-12-24 03:10:36','2020-12-24 03:10:36'),(1443,1,'127.0.0.1','Login',NULL,0,0,'2020-12-28 03:58:20','2020-12-28 03:58:20'),(1444,1,'127.0.0.1','User Role',NULL,0,0,'2020-12-28 03:59:31','2020-12-28 03:59:31'),(1445,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2020-12-28 03:59:37','2020-12-28 03:59:37'),(1446,1,'127.0.0.1','Role View',NULL,0,0,'2020-12-28 03:59:37','2020-12-28 03:59:37'),(1447,2,'127.0.0.1','Login',NULL,0,0,'2020-12-28 04:27:33','2020-12-28 04:27:33'),(1448,10,'127.0.0.1','Login',NULL,0,0,'2020-12-28 06:39:13','2020-12-28 06:39:13'),(1449,1,'127.0.0.1','Login',NULL,0,0,'2021-01-03 22:38:08','2021-01-03 22:38:08'),(1450,2,'127.0.0.1','Login',NULL,0,0,'2021-01-03 23:13:24','2021-01-03 23:13:24'),(1451,2,'127.0.0.1','Login',NULL,0,0,'2021-01-04 03:28:33','2021-01-04 03:28:33'),(1452,5,'127.0.0.1','Login',NULL,0,0,'2021-01-04 03:49:13','2021-01-04 03:49:13'),(1453,2,'127.0.0.1','Login',NULL,0,0,'2021-01-04 03:51:49','2021-01-04 03:51:49'),(1454,5,'127.0.0.1','Login',NULL,0,0,'2021-01-04 03:54:19','2021-01-04 03:54:19'),(1455,2,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:36:15','2021-01-04 04:36:15'),(1456,3,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:42:29','2021-01-04 04:42:29'),(1457,2,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:43:39','2021-01-04 04:43:39'),(1458,1,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:43:59','2021-01-04 04:43:59'),(1459,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-04 04:44:06','2021-01-04 04:44:06'),(1460,1,'127.0.0.1','User List',NULL,0,0,'2021-01-04 04:44:07','2021-01-04 04:44:07'),(1461,3,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:44:47','2021-01-04 04:44:47'),(1462,4,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:52:07','2021-01-04 04:52:07'),(1463,5,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:54:05','2021-01-04 04:54:05'),(1464,6,'127.0.0.1','Login',NULL,0,0,'2021-01-04 04:56:34','2021-01-04 04:56:34'),(1465,8,'127.0.0.1','Login',NULL,0,0,'2021-01-04 05:09:45','2021-01-04 05:09:45'),(1466,9,'127.0.0.1','Login',NULL,0,0,'2021-01-04 05:14:07','2021-01-04 05:14:07'),(1467,9,'127.0.0.1','Login',NULL,0,0,'2021-01-04 05:15:58','2021-01-04 05:15:58'),(1468,8,'127.0.0.1','Login',NULL,0,0,'2021-01-04 05:28:07','2021-01-04 05:28:07'),(1469,9,'127.0.0.1','Login',NULL,0,0,'2021-01-04 05:45:50','2021-01-04 05:45:50'),(1470,8,'127.0.0.1','Login',NULL,0,0,'2021-01-04 06:59:15','2021-01-04 06:59:15'),(1471,1,'127.0.0.1','Login',NULL,0,0,'2021-01-04 07:00:08','2021-01-04 07:00:08'),(1472,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-04 07:00:19','2021-01-04 07:00:19'),(1473,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-04 07:00:25','2021-01-04 07:00:25'),(1474,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-04 07:00:29','2021-01-04 07:00:29'),(1475,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-04 07:00:30','2021-01-04 07:00:30'),(1476,2,'127.0.0.1','Login',NULL,0,0,'2021-01-04 23:49:07','2021-01-04 23:49:07'),(1477,1,'127.0.0.1','Login',NULL,0,0,'2021-01-04 23:50:56','2021-01-04 23:50:56'),(1478,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-04 23:51:09','2021-01-04 23:51:09'),(1479,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-04 23:51:18','2021-01-04 23:51:18'),(1480,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-04 23:51:26','2021-01-04 23:51:26'),(1481,1,'127.0.0.1','User List',NULL,0,0,'2021-01-04 23:51:27','2021-01-04 23:51:27'),(1482,9,'127.0.0.1','Login',NULL,0,0,'2021-01-05 00:04:19','2021-01-05 00:04:19'),(1483,2,'127.0.0.1','Login',NULL,0,0,'2021-01-05 00:05:05','2021-01-05 00:05:05'),(1484,2,'127.0.0.1','Login',NULL,0,0,'2021-01-05 03:11:39','2021-01-05 03:11:39'),(1485,1,'127.0.0.1','Login',NULL,0,0,'2021-01-05 03:15:59','2021-01-05 03:15:59'),(1486,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 03:20:18','2021-01-05 03:20:18'),(1487,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 03:20:20','2021-01-05 03:20:20'),(1488,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 03:20:42','2021-01-05 03:20:42'),(1489,1,'127.0.0.1','User View',NULL,0,0,'2021-01-05 03:20:45','2021-01-05 03:20:45'),(1490,1,'127.0.0.1','Updated User',NULL,0,0,'2021-01-05 03:20:51','2021-01-05 03:20:51'),(1491,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 03:20:54','2021-01-05 03:20:54'),(1492,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 03:20:55','2021-01-05 03:20:55'),(1493,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 03:21:06','2021-01-05 03:21:06'),(1494,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-05 03:21:12','2021-01-05 03:21:12'),(1495,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-05 03:21:13','2021-01-05 03:21:13'),(1496,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-05 03:21:27','2021-01-05 03:21:27'),(1497,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-05 03:21:35','2021-01-05 03:21:35'),(1498,2,'127.0.0.1','Login',NULL,0,0,'2021-01-05 03:22:03','2021-01-05 03:22:03'),(1499,1,'127.0.0.1','Login',NULL,0,0,'2021-01-05 03:27:58','2021-01-05 03:27:58'),(1500,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 03:28:06','2021-01-05 03:28:06'),(1501,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-05 03:28:09','2021-01-05 03:28:09'),(1502,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-05 03:28:09','2021-01-05 03:28:09'),(1503,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-05 03:28:13','2021-01-05 03:28:13'),(1504,2,'127.0.0.1','Login',NULL,0,0,'2021-01-05 03:42:34','2021-01-05 03:42:34'),(1505,6,'127.0.0.1','Login',NULL,0,0,'2021-01-05 04:48:51','2021-01-05 04:48:51'),(1506,6,'127.0.0.1','Login',NULL,0,0,'2021-01-05 05:17:47','2021-01-05 05:17:47'),(1507,1,'127.0.0.1','Login',NULL,0,0,'2021-01-05 06:36:17','2021-01-05 06:36:17'),(1508,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:36:25','2021-01-05 06:36:25'),(1509,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:37:06','2021-01-05 06:37:06'),(1510,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:26','2021-01-05 06:41:26'),(1511,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:30','2021-01-05 06:41:30'),(1512,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:32','2021-01-05 06:41:32'),(1513,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:38','2021-01-05 06:41:38'),(1514,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:42','2021-01-05 06:41:42'),(1515,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:47','2021-01-05 06:41:47'),(1516,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:50','2021-01-05 06:41:50'),(1517,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:54','2021-01-05 06:41:54'),(1518,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:41:58','2021-01-05 06:41:58'),(1519,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:42:06','2021-01-05 06:42:06'),(1520,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:46:44','2021-01-05 06:46:44'),(1521,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:47:43','2021-01-05 06:47:43'),(1522,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:51:02','2021-01-05 06:51:02'),(1523,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:52:50','2021-01-05 06:52:50'),(1524,1,'127.0.0.1','Login',NULL,0,0,'2021-01-05 06:55:59','2021-01-05 06:55:59'),(1525,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:56:06','2021-01-05 06:56:06'),(1526,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:56:14','2021-01-05 06:56:14'),(1527,1,'127.0.0.1','Login',NULL,0,0,'2021-01-05 06:58:04','2021-01-05 06:58:04'),(1528,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:58:21','2021-01-05 06:58:21'),(1529,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:59:11','2021-01-05 06:59:11'),(1530,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:59:20','2021-01-05 06:59:20'),(1531,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 06:59:50','2021-01-05 06:59:50'),(1532,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 07:00:41','2021-01-05 07:00:41'),(1533,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 07:00:46','2021-01-05 07:00:46'),(1534,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 07:00:55','2021-01-05 07:00:55'),(1535,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 07:01:21','2021-01-05 07:01:21'),(1536,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 07:07:31','2021-01-05 07:07:31'),(1537,1,'127.0.0.1','Login',NULL,0,0,'2021-01-05 07:07:52','2021-01-05 07:07:52'),(1538,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 07:08:05','2021-01-05 07:08:05'),(1539,1,'::1','Login',NULL,0,0,'2021-01-05 07:15:22','2021-01-05 07:15:22'),(1540,1,'::1','User Management Role',NULL,0,0,'2021-01-05 07:15:28','2021-01-05 07:15:28'),(1541,1,'::1','User Management Role',NULL,0,0,'2021-01-05 07:17:26','2021-01-05 07:17:26'),(1542,1,'::1','User Management Role',NULL,0,0,'2021-01-05 07:17:29','2021-01-05 07:17:29'),(1543,1,'127.0.0.1','Login',NULL,0,0,'2021-01-05 22:27:14','2021-01-05 22:27:14'),(1544,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:27:33','2021-01-05 22:27:33'),(1545,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 22:28:52','2021-01-05 22:28:52'),(1546,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:29:53','2021-01-05 22:29:53'),(1547,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 22:31:16','2021-01-05 22:31:16'),(1548,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 22:31:41','2021-01-05 22:31:41'),(1549,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:31:59','2021-01-05 22:31:59'),(1550,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:33:24','2021-01-05 22:33:24'),(1551,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:40:31','2021-01-05 22:40:31'),(1552,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 22:45:49','2021-01-05 22:45:49'),(1553,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:45:53','2021-01-05 22:45:53'),(1554,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 22:45:54','2021-01-05 22:45:54'),(1555,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:06','2021-01-05 22:46:06'),(1556,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:12','2021-01-05 22:46:12'),(1557,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:16','2021-01-05 22:46:16'),(1558,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:19','2021-01-05 22:46:19'),(1559,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:22','2021-01-05 22:46:22'),(1560,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:25','2021-01-05 22:46:25'),(1561,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:28','2021-01-05 22:46:28'),(1562,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-05 22:46:33','2021-01-05 22:46:33'),(1563,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:35','2021-01-05 22:46:35'),(1564,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:41','2021-01-05 22:46:41'),(1565,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:46:46','2021-01-05 22:46:46'),(1566,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 22:56:19','2021-01-05 22:56:19'),(1567,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 23:00:08','2021-01-05 23:00:08'),(1568,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-05 23:01:11','2021-01-05 23:01:11'),(1569,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 23:01:14','2021-01-05 23:01:14'),(1570,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 23:02:29','2021-01-05 23:02:29'),(1571,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 23:02:32','2021-01-05 23:02:32'),(1572,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 23:02:34','2021-01-05 23:02:34'),(1573,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 23:02:52','2021-01-05 23:02:52'),(1574,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 23:03:28','2021-01-05 23:03:28'),(1575,1,'127.0.0.1','User List',NULL,0,0,'2021-01-05 23:03:30','2021-01-05 23:03:30'),(1576,9,'127.0.0.1','Login',NULL,0,0,'2021-01-05 23:06:48','2021-01-05 23:06:48'),(1577,9,'127.0.0.1','Login',NULL,0,0,'2021-01-05 23:09:24','2021-01-05 23:09:24'),(1578,2,'127.0.0.1','Login',NULL,0,0,'2021-01-05 23:40:41','2021-01-05 23:40:41'),(1579,2,'127.0.0.1','Login',NULL,0,0,'2021-01-06 02:29:05','2021-01-06 02:29:05'),(1580,2,'127.0.0.1','Login',NULL,0,0,'2021-01-06 03:52:42','2021-01-06 03:52:42'),(1581,9,'127.0.0.1','Login',NULL,0,0,'2021-01-06 05:15:33','2021-01-06 05:15:33'),(1582,8,'127.0.0.1','Login',NULL,0,0,'2021-01-06 05:21:35','2021-01-06 05:21:35'),(1583,6,'127.0.0.1','Login',NULL,0,0,'2021-01-06 05:23:27','2021-01-06 05:23:27'),(1584,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 05:31:27','2021-01-06 05:31:27'),(1585,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-06 05:31:33','2021-01-06 05:31:33'),(1586,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 06:07:34','2021-01-06 06:07:34'),(1587,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 06:07:35','2021-01-06 06:07:35'),(1588,0,'127.0.0.1','Login Failed With Username :super.admin',NULL,0,0,'2021-01-06 06:07:36','2021-01-06 06:07:36'),(1589,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-06 06:08:14','2021-01-06 06:08:14'),(1590,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-06 06:08:56','2021-01-06 06:08:56'),(1591,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-06 06:08:57','2021-01-06 06:08:57'),(1592,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-06 06:09:13','2021-01-06 06:09:13'),(1593,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-06 06:09:24','2021-01-06 06:09:24'),(1594,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-06 06:09:24','2021-01-06 06:09:24'),(1595,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-06 06:10:41','2021-01-06 06:10:41'),(1596,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-06 06:10:49','2021-01-06 06:10:49'),(1597,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-06 06:10:50','2021-01-06 06:10:50'),(1598,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 07:10:38','2021-01-06 07:10:38'),(1599,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-06 07:10:45','2021-01-06 07:10:45'),(1600,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-06 07:10:51','2021-01-06 07:10:51'),(1601,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-06 07:10:51','2021-01-06 07:10:51'),(1602,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-06 07:21:17','2021-01-06 07:21:17'),(1603,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-06 07:24:05','2021-01-06 07:24:05'),(1604,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-06 07:24:15','2021-01-06 07:24:15'),(1605,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-06 07:24:19','2021-01-06 07:24:19'),(1606,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-06 07:24:22','2021-01-06 07:24:22'),(1607,1,'127.0.0.1','User List',NULL,0,0,'2021-01-06 07:24:23','2021-01-06 07:24:23'),(1608,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-06 07:24:38','2021-01-06 07:24:38'),(1609,1,'127.0.0.1','User List',NULL,0,0,'2021-01-06 07:24:40','2021-01-06 07:24:40'),(1610,2,'127.0.0.1','Login',NULL,0,0,'2021-01-06 07:24:52','2021-01-06 07:24:52'),(1611,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 07:25:48','2021-01-06 07:25:48'),(1612,2,'127.0.0.1','Login',NULL,0,0,'2021-01-06 07:27:34','2021-01-06 07:27:34'),(1613,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 22:48:41','2021-01-06 22:48:41'),(1614,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-06 22:48:53','2021-01-06 22:48:53'),(1615,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 22:50:59','2021-01-06 22:50:59'),(1616,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-06 22:51:14','2021-01-06 22:51:14'),(1617,1,'127.0.0.1','Login',NULL,0,0,'2021-01-06 22:52:06','2021-01-06 22:52:06'),(1618,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-06 22:52:27','2021-01-06 22:52:27'),(1619,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-06 22:52:33','2021-01-06 22:52:33'),(1620,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-06 22:52:34','2021-01-06 22:52:34'),(1621,2,'127.0.0.1','Login',NULL,0,0,'2021-01-06 23:33:02','2021-01-06 23:33:02'),(1622,1,'127.0.0.1','Login',NULL,0,0,'2021-01-07 00:50:15','2021-01-07 00:50:15'),(1623,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 00:50:23','2021-01-07 00:50:23'),(1624,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 00:51:08','2021-01-07 00:51:08'),(1625,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 00:51:08','2021-01-07 00:51:08'),(1626,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 00:51:23','2021-01-07 00:51:23'),(1627,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 00:58:01','2021-01-07 00:58:01'),(1628,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 00:58:11','2021-01-07 00:58:11'),(1629,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 00:58:53','2021-01-07 00:58:53'),(1630,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:10:04','2021-01-07 01:10:04'),(1631,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:10:04','2021-01-07 01:10:04'),(1632,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:11:53','2021-01-07 01:11:53'),(1633,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:11:53','2021-01-07 01:11:53'),(1634,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:24:11','2021-01-07 01:24:11'),(1635,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:24:11','2021-01-07 01:24:11'),(1636,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:24:41','2021-01-07 01:24:41'),(1637,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:24:41','2021-01-07 01:24:41'),(1638,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:25:00','2021-01-07 01:25:00'),(1639,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:25:00','2021-01-07 01:25:00'),(1640,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:26:11','2021-01-07 01:26:11'),(1641,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:26:12','2021-01-07 01:26:12'),(1642,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:26:34','2021-01-07 01:26:34'),(1643,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:26:34','2021-01-07 01:26:34'),(1644,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:27:08','2021-01-07 01:27:08'),(1645,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:27:09','2021-01-07 01:27:09'),(1646,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:27:22','2021-01-07 01:27:22'),(1647,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:27:22','2021-01-07 01:27:22'),(1648,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:29:14','2021-01-07 01:29:14'),(1649,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:29:15','2021-01-07 01:29:15'),(1650,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:29:50','2021-01-07 01:29:50'),(1651,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:29:50','2021-01-07 01:29:50'),(1652,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:32:26','2021-01-07 01:32:26'),(1653,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:32:26','2021-01-07 01:32:26'),(1654,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:33:26','2021-01-07 01:33:26'),(1655,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:33:26','2021-01-07 01:33:26'),(1656,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:34:11','2021-01-07 01:34:11'),(1657,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:34:11','2021-01-07 01:34:11'),(1658,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:37:40','2021-01-07 01:37:40'),(1659,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:37:41','2021-01-07 01:37:41'),(1660,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:38:15','2021-01-07 01:38:15'),(1661,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:38:16','2021-01-07 01:38:16'),(1662,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:39:58','2021-01-07 01:39:58'),(1663,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:39:58','2021-01-07 01:39:58'),(1664,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:41:20','2021-01-07 01:41:20'),(1665,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:41:21','2021-01-07 01:41:21'),(1666,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:41:42','2021-01-07 01:41:42'),(1667,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:41:43','2021-01-07 01:41:43'),(1668,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 01:59:04','2021-01-07 01:59:04'),(1669,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 01:59:05','2021-01-07 01:59:05'),(1670,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 02:01:21','2021-01-07 02:01:21'),(1671,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 02:01:22','2021-01-07 02:01:22'),(1672,1,'127.0.0.1','Login',NULL,0,0,'2021-01-07 02:58:54','2021-01-07 02:58:54'),(1673,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 02:59:03','2021-01-07 02:59:03'),(1674,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 02:59:09','2021-01-07 02:59:09'),(1675,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 02:59:09','2021-01-07 02:59:09'),(1676,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:04:00','2021-01-07 03:04:00'),(1677,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:04:00','2021-01-07 03:04:00'),(1678,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:06:01','2021-01-07 03:06:01'),(1679,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:06:05','2021-01-07 03:06:05'),(1680,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:06:06','2021-01-07 03:06:06'),(1681,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:07:30','2021-01-07 03:07:30'),(1682,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:07:30','2021-01-07 03:07:30'),(1683,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:07:45','2021-01-07 03:07:45'),(1684,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:07:46','2021-01-07 03:07:46'),(1685,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:09:22','2021-01-07 03:09:22'),(1686,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:09:22','2021-01-07 03:09:22'),(1687,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:09:38','2021-01-07 03:09:38'),(1688,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:09:38','2021-01-07 03:09:38'),(1689,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:09:58','2021-01-07 03:09:58'),(1690,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:09:59','2021-01-07 03:09:59'),(1691,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:13:14','2021-01-07 03:13:14'),(1692,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:13:14','2021-01-07 03:13:14'),(1693,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:15:29','2021-01-07 03:15:29'),(1694,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:15:30','2021-01-07 03:15:30'),(1695,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:16:14','2021-01-07 03:16:14'),(1696,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:16:14','2021-01-07 03:16:14'),(1697,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:22:28','2021-01-07 03:22:28'),(1698,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:22:29','2021-01-07 03:22:29'),(1699,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:23:08','2021-01-07 03:23:08'),(1700,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:23:09','2021-01-07 03:23:09'),(1701,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:26:00','2021-01-07 03:26:00'),(1702,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:26:01','2021-01-07 03:26:01'),(1703,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:27:01','2021-01-07 03:27:01'),(1704,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:27:02','2021-01-07 03:27:02'),(1705,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:30:02','2021-01-07 03:30:02'),(1706,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:30:02','2021-01-07 03:30:02'),(1707,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:30:14','2021-01-07 03:30:14'),(1708,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:30:18','2021-01-07 03:30:18'),(1709,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:30:19','2021-01-07 03:30:19'),(1710,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:30:22','2021-01-07 03:30:22'),(1711,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:30:27','2021-01-07 03:30:27'),(1712,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:30:29','2021-01-07 03:30:29'),(1713,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:30:32','2021-01-07 03:30:32'),(1714,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:30:44','2021-01-07 03:30:44'),(1715,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:30:45','2021-01-07 03:30:45'),(1716,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:33:48','2021-01-07 03:33:48'),(1717,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:33:49','2021-01-07 03:33:49'),(1718,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:34:30','2021-01-07 03:34:30'),(1719,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:34:31','2021-01-07 03:34:31'),(1720,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:34:59','2021-01-07 03:34:59'),(1721,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:34:59','2021-01-07 03:34:59'),(1722,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:35:15','2021-01-07 03:35:15'),(1723,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:35:16','2021-01-07 03:35:16'),(1724,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:37:10','2021-01-07 03:37:10'),(1725,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:37:15','2021-01-07 03:37:15'),(1726,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:37:16','2021-01-07 03:37:16'),(1727,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:38:47','2021-01-07 03:38:47'),(1728,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:38:48','2021-01-07 03:38:48'),(1729,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:38:53','2021-01-07 03:38:53'),(1730,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:38:57','2021-01-07 03:38:57'),(1731,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:38:57','2021-01-07 03:38:57'),(1732,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:45:08','2021-01-07 03:45:08'),(1733,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:45:09','2021-01-07 03:45:09'),(1734,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:45:23','2021-01-07 03:45:23'),(1735,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:45:27','2021-01-07 03:45:27'),(1736,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:45:27','2021-01-07 03:45:27'),(1737,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:46:07','2021-01-07 03:46:07'),(1738,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:46:07','2021-01-07 03:46:07'),(1739,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:46:28','2021-01-07 03:46:28'),(1740,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:46:29','2021-01-07 03:46:29'),(1741,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:46:34','2021-01-07 03:46:34'),(1742,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:46:51','2021-01-07 03:46:51'),(1743,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:46:51','2021-01-07 03:46:51'),(1744,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:49:09','2021-01-07 03:49:09'),(1745,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 03:49:32','2021-01-07 03:49:32'),(1746,1,'127.0.0.1','User List',NULL,0,0,'2021-01-07 03:49:33','2021-01-07 03:49:33'),(1747,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:50:09','2021-01-07 03:50:09'),(1748,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:50:12','2021-01-07 03:50:12'),(1749,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:50:13','2021-01-07 03:50:13'),(1750,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:50:16','2021-01-07 03:50:16'),(1751,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 03:50:20','2021-01-07 03:50:20'),(1752,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 03:50:20','2021-01-07 03:50:20'),(1753,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:50:23','2021-01-07 03:50:23'),(1754,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 03:50:32','2021-01-07 03:50:32'),(1755,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 03:50:38','2021-01-07 03:50:38'),(1756,1,'127.0.0.1','User List',NULL,0,0,'2021-01-07 03:50:39','2021-01-07 03:50:39'),(1757,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 03:54:43','2021-01-07 03:54:43'),(1758,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 03:54:59','2021-01-07 03:54:59'),(1759,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 03:55:04','2021-01-07 03:55:04'),(1760,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 03:55:06','2021-01-07 03:55:06'),(1761,1,'127.0.0.1','User List',NULL,0,0,'2021-01-07 03:55:07','2021-01-07 03:55:07'),(1762,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 03:55:17','2021-01-07 03:55:17'),(1763,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 03:55:20','2021-01-07 03:55:20'),(1764,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:01:12','2021-01-07 04:01:12'),(1765,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:01:31','2021-01-07 04:01:31'),(1766,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:01:43','2021-01-07 04:01:43'),(1767,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:01:52','2021-01-07 04:01:52'),(1768,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:01:59','2021-01-07 04:01:59'),(1769,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:02:28','2021-01-07 04:02:28'),(1770,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:02:41','2021-01-07 04:02:41'),(1771,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:03:25','2021-01-07 04:03:25'),(1772,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:03:49','2021-01-07 04:03:49'),(1773,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:06:23','2021-01-07 04:06:23'),(1774,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:06:50','2021-01-07 04:06:50'),(1775,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 04:07:37','2021-01-07 04:07:37'),(1776,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 07:29:02','2021-01-07 07:29:02'),(1777,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:37:43','2021-01-07 23:37:43'),(1778,2,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:38:21','2021-01-07 23:38:21'),(1779,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:41:29','2021-01-07 23:41:29'),(1780,1,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:42:59','2021-01-07 23:42:59'),(1781,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-07 23:43:15','2021-01-07 23:43:15'),(1782,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-07 23:43:21','2021-01-07 23:43:21'),(1783,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-07 23:43:21','2021-01-07 23:43:21'),(1784,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 23:43:41','2021-01-07 23:43:41'),(1785,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:44:00','2021-01-07 23:44:00'),(1786,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 23:44:33','2021-01-07 23:44:33'),(1787,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:44:51','2021-01-07 23:44:51'),(1788,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 23:49:22','2021-01-07 23:49:22'),(1789,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:49:38','2021-01-07 23:49:38'),(1790,2,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:50:09','2021-01-07 23:50:09'),(1791,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:55:47','2021-01-07 23:55:47'),(1792,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 23:56:55','2021-01-07 23:56:55'),(1793,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-07 23:57:01','2021-01-07 23:57:01'),(1794,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 23:57:30','2021-01-07 23:57:30'),(1795,1,'127.0.0.1','User List',NULL,0,0,'2021-01-07 23:57:31','2021-01-07 23:57:31'),(1796,1,'127.0.0.1','User View',NULL,0,0,'2021-01-07 23:57:35','2021-01-07 23:57:35'),(1797,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-07 23:57:50','2021-01-07 23:57:50'),(1798,10,'127.0.0.1','Login',NULL,0,0,'2021-01-07 23:58:06','2021-01-07 23:58:06'),(1799,1,'127.0.0.1','Login',NULL,0,0,'2021-01-08 01:06:39','2021-01-08 01:06:39'),(1800,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-08 01:06:44','2021-01-08 01:06:44'),(1801,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-08 01:06:47','2021-01-08 01:06:47'),(1802,1,'127.0.0.1','User List',NULL,0,0,'2021-01-08 01:06:48','2021-01-08 01:06:48'),(1803,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 01:06:51','2021-01-08 01:06:51'),(1804,10,'127.0.0.1','Login',NULL,0,0,'2021-01-08 02:35:50','2021-01-08 02:35:50'),(1805,10,'127.0.0.1','Login',NULL,0,0,'2021-01-08 03:25:07','2021-01-08 03:25:07'),(1806,10,'127.0.0.1','Login',NULL,0,0,'2021-01-08 04:05:54','2021-01-08 04:05:54'),(1807,10,'127.0.0.1','Login',NULL,0,0,'2021-01-08 04:06:05','2021-01-08 04:06:05'),(1808,6,'127.0.0.1','Login',NULL,0,0,'2021-01-08 05:38:25','2021-01-08 05:38:25'),(1809,8,'127.0.0.1','Login',NULL,0,0,'2021-01-08 05:40:27','2021-01-08 05:40:27'),(1810,9,'127.0.0.1','Login',NULL,0,0,'2021-01-08 05:44:14','2021-01-08 05:44:14'),(1811,4,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:25:23','2021-01-08 06:25:23'),(1812,8,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:26:55','2021-01-08 06:26:55'),(1813,4,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:27:29','2021-01-08 06:27:29'),(1814,2,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:29:11','2021-01-08 06:29:11'),(1815,4,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:34:20','2021-01-08 06:34:20'),(1816,3,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:34:52','2021-01-08 06:34:52'),(1817,4,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:36:51','2021-01-08 06:36:51'),(1818,5,'127.0.0.1','Login',NULL,0,0,'2021-01-08 06:39:14','2021-01-08 06:39:14'),(1819,1,'127.0.0.1','Login',NULL,0,0,'2021-01-08 07:27:32','2021-01-08 07:27:32'),(1820,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-08 07:27:38','2021-01-08 07:27:38'),(1821,1,'127.0.0.1','User List',NULL,0,0,'2021-01-08 07:27:39','2021-01-08 07:27:39'),(1822,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 07:27:43','2021-01-08 07:27:43'),(1823,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 07:27:50','2021-01-08 07:27:50'),(1824,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 07:29:31','2021-01-08 07:29:31'),(1825,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-08 07:30:40','2021-01-08 07:30:40'),(1826,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-08 07:30:44','2021-01-08 07:30:44'),(1827,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-08 07:30:45','2021-01-08 07:30:45'),(1828,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 07:31:30','2021-01-08 07:31:30'),(1829,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 07:32:08','2021-01-08 07:32:08'),(1830,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 07:33:03','2021-01-08 07:33:03'),(1831,1,'127.0.0.1','User View',NULL,0,0,'2021-01-08 07:33:16','2021-01-08 07:33:16'),(1832,2,'127.0.0.1','Login',NULL,0,0,'2021-01-11 03:57:44','2021-01-11 03:57:44'),(1833,8,'127.0.0.1','Login',NULL,0,0,'2021-01-11 04:50:31','2021-01-11 04:50:31'),(1834,2,'127.0.0.1','Login',NULL,0,0,'2021-01-11 05:28:25','2021-01-11 05:28:25'),(1835,3,'127.0.0.1','Login',NULL,0,0,'2021-01-11 05:32:27','2021-01-11 05:32:27'),(1836,4,'127.0.0.1','Login',NULL,0,0,'2021-01-11 05:33:22','2021-01-11 05:33:22'),(1837,5,'127.0.0.1','Login',NULL,0,0,'2021-01-11 05:34:07','2021-01-11 05:34:07'),(1838,6,'127.0.0.1','Login',NULL,0,0,'2021-01-11 05:35:12','2021-01-11 05:35:12'),(1839,6,'127.0.0.1','Login',NULL,0,0,'2021-01-11 06:42:00','2021-01-11 06:42:00'),(1840,6,'127.0.0.1','Login',NULL,0,0,'2021-01-11 22:37:01','2021-01-11 22:37:01'),(1841,1,'127.0.0.1','Login',NULL,0,0,'2021-01-11 23:23:43','2021-01-11 23:23:43'),(1842,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-11 23:23:52','2021-01-11 23:23:52'),(1843,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-11 23:23:55','2021-01-11 23:23:55'),(1844,1,'127.0.0.1','User List',NULL,0,0,'2021-01-11 23:23:56','2021-01-11 23:23:56'),(1845,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-11 23:23:59','2021-01-11 23:23:59'),(1846,1,'127.0.0.1','User View',NULL,0,0,'2021-01-11 23:24:03','2021-01-11 23:24:03'),(1847,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-11 23:24:07','2021-01-11 23:24:07'),(1848,1,'127.0.0.1','User List',NULL,0,0,'2021-01-11 23:24:09','2021-01-11 23:24:09'),(1849,1,'127.0.0.1','User View',NULL,0,0,'2021-01-11 23:24:12','2021-01-11 23:24:12'),(1850,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-11 23:24:55','2021-01-11 23:24:55'),(1851,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-11 23:25:07','2021-01-11 23:25:07'),(1852,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-11 23:25:07','2021-01-11 23:25:07'),(1853,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-11 23:45:50','2021-01-11 23:45:50'),(1854,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-11 23:45:51','2021-01-11 23:45:51'),(1855,1,'127.0.0.1','User View',NULL,0,0,'2021-01-11 23:46:16','2021-01-11 23:46:16'),(1856,1,'127.0.0.1','User View',NULL,0,0,'2021-01-11 23:46:57','2021-01-11 23:46:57'),(1857,0,'127.0.0.1','Login Failed With Username :sia_maipur_level2',NULL,0,0,'2021-01-11 23:48:14','2021-01-11 23:48:14'),(1858,0,'127.0.0.1','Login Failed With Username :sia_maipur_level2',NULL,0,0,'2021-01-11 23:48:23','2021-01-11 23:48:23'),(1859,6,'127.0.0.1','Login',NULL,0,0,'2021-01-11 23:49:01','2021-01-11 23:49:01'),(1860,6,'127.0.0.1','Login',NULL,0,0,'2021-01-12 00:23:27','2021-01-12 00:23:27'),(1861,2,'127.0.0.1','Login',NULL,0,0,'2021-01-12 02:09:15','2021-01-12 02:09:15'),(1862,1,'127.0.0.1','Login',NULL,0,0,'2021-01-12 03:04:12','2021-01-12 03:04:12'),(1863,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 03:04:21','2021-01-12 03:04:21'),(1864,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 03:18:55','2021-01-12 03:18:55'),(1865,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 03:19:10','2021-01-12 03:19:10'),(1866,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 03:23:27','2021-01-12 03:23:27'),(1867,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 03:24:29','2021-01-12 03:24:29'),(1868,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 03:26:03','2021-01-12 03:26:03'),(1869,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 03:26:54','2021-01-12 03:26:54'),(1870,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 03:27:01','2021-01-12 03:27:01'),(1871,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 03:27:05','2021-01-12 03:27:05'),(1872,1,'127.0.0.1','User List',NULL,0,0,'2021-01-12 03:27:07','2021-01-12 03:27:07'),(1873,6,'127.0.0.1','Login',NULL,0,0,'2021-01-12 04:18:05','2021-01-12 04:18:05'),(1874,6,'127.0.0.1','Login',NULL,0,0,'2021-01-12 05:38:35','2021-01-12 05:38:35'),(1875,0,'127.0.0.1','Login Failed With Username :nodal_maipur_level2',NULL,0,0,'2021-01-12 05:39:03','2021-01-12 05:39:03'),(1876,8,'127.0.0.1','Login',NULL,0,0,'2021-01-12 05:39:27','2021-01-12 05:39:27'),(1877,8,'127.0.0.1','Login',NULL,0,0,'2021-01-12 07:31:27','2021-01-12 07:31:27'),(1878,8,'127.0.0.1','Login',NULL,0,0,'2021-01-12 23:17:41','2021-01-12 23:17:41'),(1879,1,'127.0.0.1','Login',NULL,0,0,'2021-01-12 23:18:01','2021-01-12 23:18:01'),(1880,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 23:18:07','2021-01-12 23:18:07'),(1881,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-12 23:18:11','2021-01-12 23:18:11'),(1882,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-12 23:18:12','2021-01-12 23:18:12'),(1883,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-12 23:18:21','2021-01-12 23:18:21'),(1884,8,'127.0.0.1','Login',NULL,0,0,'2021-01-12 23:18:53','2021-01-12 23:18:53'),(1885,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:18:58','2021-01-12 23:18:58'),(1886,8,'127.0.0.1','User List',NULL,0,0,'2021-01-12 23:18:59','2021-01-12 23:18:59'),(1887,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:19:04','2021-01-12 23:19:04'),(1888,8,'127.0.0.1','Created User',NULL,0,0,'2021-01-12 23:20:53','2021-01-12 23:20:53'),(1889,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:20:58','2021-01-12 23:20:58'),(1890,8,'127.0.0.1','User List',NULL,0,0,'2021-01-12 23:20:59','2021-01-12 23:20:59'),(1891,8,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 23:21:10','2021-01-12 23:21:10'),(1892,8,'127.0.0.1','User View',NULL,0,0,'2021-01-12 23:21:13','2021-01-12 23:21:13'),(1893,8,'127.0.0.1','User Role',NULL,0,0,'2021-01-12 23:23:05','2021-01-12 23:23:05'),(1894,8,'127.0.0.1','User View',NULL,0,0,'2021-01-12 23:23:11','2021-01-12 23:23:11'),(1895,8,'127.0.0.1','Updated User',NULL,0,0,'2021-01-12 23:23:16','2021-01-12 23:23:16'),(1896,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:23:19','2021-01-12 23:23:19'),(1897,8,'127.0.0.1','User List',NULL,0,0,'2021-01-12 23:23:20','2021-01-12 23:23:20'),(1898,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:23:22','2021-01-12 23:23:22'),(1899,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:29:21','2021-01-12 23:29:21'),(1900,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:29:40','2021-01-12 23:29:40'),(1901,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-12 23:29:57','2021-01-12 23:29:57'),(1902,8,'127.0.0.1','Login',NULL,0,0,'2021-01-13 00:16:44','2021-01-13 00:16:44'),(1903,8,'127.0.0.1','Login',NULL,0,0,'2021-01-13 00:16:56','2021-01-13 00:16:56'),(1904,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:36:41','2021-01-13 00:36:41'),(1905,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:36:46','2021-01-13 00:36:46'),(1906,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:36:49','2021-01-13 00:36:49'),(1907,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:36:52','2021-01-13 00:36:52'),(1908,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:36:54','2021-01-13 00:36:54'),(1909,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:36:57','2021-01-13 00:36:57'),(1910,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:00','2021-01-13 00:37:00'),(1911,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:03','2021-01-13 00:37:03'),(1912,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:06','2021-01-13 00:37:06'),(1913,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:09','2021-01-13 00:37:09'),(1914,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:12','2021-01-13 00:37:12'),(1915,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:16','2021-01-13 00:37:16'),(1916,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:21','2021-01-13 00:37:21'),(1917,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:23','2021-01-13 00:37:23'),(1918,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:27','2021-01-13 00:37:27'),(1919,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:32','2021-01-13 00:37:32'),(1920,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:35','2021-01-13 00:37:35'),(1921,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 00:37:39','2021-01-13 00:37:39'),(1922,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 00:37:40','2021-01-13 00:37:40'),(1923,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:06:15','2021-01-13 01:06:15'),(1924,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 01:06:16','2021-01-13 01:06:16'),(1925,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:06:17','2021-01-13 01:06:17'),(1926,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:06:20','2021-01-13 01:06:20'),(1927,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:06:23','2021-01-13 01:06:23'),(1928,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 01:06:24','2021-01-13 01:06:24'),(1929,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:07:54','2021-01-13 01:07:54'),(1930,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:12:24','2021-01-13 01:12:24'),(1931,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 01:12:25','2021-01-13 01:12:25'),(1932,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:12:26','2021-01-13 01:12:26'),(1933,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:12:29','2021-01-13 01:12:29'),(1934,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 01:12:29','2021-01-13 01:12:29'),(1935,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:12:31','2021-01-13 01:12:31'),(1936,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 01:12:32','2021-01-13 01:12:32'),(1937,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:12:33','2021-01-13 01:12:33'),(1938,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:12:36','2021-01-13 01:12:36'),(1939,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:14:12','2021-01-13 01:14:12'),(1940,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:15:59','2021-01-13 01:15:59'),(1941,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:16:03','2021-01-13 01:16:03'),(1942,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:16:06','2021-01-13 01:16:06'),(1943,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:16:08','2021-01-13 01:16:08'),(1944,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:16:10','2021-01-13 01:16:10'),(1945,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 01:16:11','2021-01-13 01:16:11'),(1946,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:16:38','2021-01-13 01:16:38'),(1947,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:16:40','2021-01-13 01:16:40'),(1948,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:16:49','2021-01-13 01:16:49'),(1949,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:29:44','2021-01-13 01:29:44'),(1950,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:29:51','2021-01-13 01:29:51'),(1951,8,'127.0.0.1','User List',NULL,0,0,'2021-01-13 01:29:52','2021-01-13 01:29:52'),(1952,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:29:56','2021-01-13 01:29:56'),(1953,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-13 01:39:24','2021-01-13 01:39:24'),(1954,8,'127.0.0.1','Login',NULL,0,0,'2021-01-13 04:18:30','2021-01-13 04:18:30'),(1955,8,'127.0.0.1','Login',NULL,0,0,'2021-01-13 07:11:46','2021-01-13 07:11:46'),(1956,8,'127.0.0.1','Login',NULL,0,0,'2021-01-13 22:45:36','2021-01-13 22:45:36'),(1957,6,'127.0.0.1','Login',NULL,0,0,'2021-01-13 23:50:06','2021-01-13 23:50:06'),(1958,8,'127.0.0.1','Login',NULL,0,0,'2021-01-14 00:05:16','2021-01-14 00:05:16'),(1959,0,'127.0.0.1','Login Failed With Username :sia_manipur',NULL,0,0,'2021-01-14 00:09:38','2021-01-14 00:09:38'),(1960,6,'127.0.0.1','Login',NULL,0,0,'2021-01-14 00:09:53','2021-01-14 00:09:53'),(1961,5,'127.0.0.1','Login',NULL,0,0,'2021-01-14 00:45:15','2021-01-14 00:45:15'),(1962,8,'127.0.0.1','Login',NULL,0,0,'2021-01-14 00:45:47','2021-01-14 00:45:47'),(1963,1,'127.0.0.1','Login',NULL,0,0,'2021-01-14 01:00:48','2021-01-14 01:00:48'),(1964,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-14 01:01:24','2021-01-14 01:01:24'),(1965,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-14 01:01:39','2021-01-14 01:01:39'),(1966,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-14 01:01:40','2021-01-14 01:01:40'),(1967,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-14 01:05:32','2021-01-14 01:05:32'),(1968,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-14 01:05:32','2021-01-14 01:05:32'),(1969,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-14 01:05:49','2021-01-14 01:05:49'),(1970,1,'127.0.0.1','User List',NULL,0,0,'2021-01-14 01:05:50','2021-01-14 01:05:50'),(1971,1,'127.0.0.1','User View',NULL,0,0,'2021-01-14 01:05:58','2021-01-14 01:05:58'),(1972,1,'127.0.0.1','User View',NULL,0,0,'2021-01-14 01:06:33','2021-01-14 01:06:33'),(1973,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-14 01:11:09','2021-01-14 01:11:09'),(1974,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-14 01:11:09','2021-01-14 01:11:09'),(1975,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-14 01:12:14','2021-01-14 01:12:14'),(1976,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-14 01:12:15','2021-01-14 01:12:15'),(1977,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-14 01:12:23','2021-01-14 01:12:23'),(1978,8,'127.0.0.1','Login',NULL,0,0,'2021-01-14 01:12:54','2021-01-14 01:12:54'),(1979,8,'127.0.0.1','Login',NULL,0,0,'2021-01-14 01:18:16','2021-01-14 01:18:16'),(1980,8,'127.0.0.1','Login',NULL,0,0,'2021-01-14 22:39:51','2021-01-14 22:39:51'),(1981,2,'127.0.0.1','Login',NULL,0,0,'2021-01-14 22:44:52','2021-01-14 22:44:52'),(1982,8,'127.0.0.1','Login',NULL,0,0,'2021-01-14 22:59:34','2021-01-14 22:59:34'),(1983,8,'127.0.0.1','Added auction committe members of reference number refer',NULL,0,0,'2021-01-14 23:01:44','2021-01-14 23:01:44'),(1984,8,'127.0.0.1','Edited auction committe members of reference number -refer',NULL,0,0,'2021-01-14 23:02:34','2021-01-14 23:02:34'),(1985,8,'127.0.0.1','Edited auction committe members of reference number -refer','auction',0,0,'2021-01-14 23:03:32','2021-01-14 23:03:32'),(1986,2,'127.0.0.1','Login',NULL,0,0,'2021-01-14 23:11:06','2021-01-14 23:11:06'),(1987,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23414000040','mfp_procurement',0,0,'2021-01-14 23:37:18','2021-01-14 23:37:18'),(1988,8,'127.0.0.1','Login',NULL,0,0,'2021-01-14 23:38:24','2021-01-14 23:38:24'),(1989,8,'127.0.0.1','Added auction committe members of reference number -345345','auction',0,0,'2021-01-14 23:39:29','2021-01-14 23:39:29'),(1990,8,'127.0.0.1','Edited auction committe members of reference number -345345','auction',0,0,'2021-01-14 23:39:44','2021-01-14 23:39:44'),(1991,2,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:06:42','2021-01-15 01:06:42'),(1992,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000039','mfp_procurement',0,0,'2021-01-15 01:09:45','2021-01-15 01:09:45'),(1993,3,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:10:22','2021-01-15 01:10:22'),(1994,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23414000040','mfp_procurement_aproval',0,0,'2021-01-15 01:11:07','2021-01-15 01:11:07'),(1995,3,'127.0.0.1','approved Mfp procurement proposal id - 23414000040','mfp_procurement',0,0,'2021-01-15 01:11:08','2021-01-15 01:11:08'),(1996,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000039','mfp_procurement_aproval',0,0,'2021-01-15 01:12:57','2021-01-15 01:12:57'),(1997,3,'127.0.0.1','approved Mfp procurement proposal id - 23000039','mfp_procurement_aproval',0,0,'2021-01-15 01:12:58','2021-01-15 01:12:58'),(1998,4,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:13:18','2021-01-15 01:13:18'),(1999,4,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23414000040','mfp_procurement_aproval',0,0,'2021-01-15 01:14:12','2021-01-15 01:14:12'),(2000,4,'127.0.0.1','approved Mfp procurement proposal id - 23414000040','mfp_procurement_aproval',0,0,'2021-01-15 01:14:16','2021-01-15 01:14:16'),(2001,4,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000039','mfp_procurement_aproval',0,0,'2021-01-15 01:14:38','2021-01-15 01:14:38'),(2002,4,'127.0.0.1','approved Mfp procurement proposal id - 23000039','mfp_procurement_aproval',0,0,'2021-01-15 01:14:39','2021-01-15 01:14:39'),(2003,5,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:15:17','2021-01-15 01:15:17'),(2004,5,'127.0.0.1','approved Mfp procurement proposal id - 23414000040','mfp_procurement_aproval',0,0,'2021-01-15 01:15:41','2021-01-15 01:15:41'),(2005,5,'127.0.0.1','approved Mfp procurement proposal id - 23000039','mfp_procurement_aproval',0,0,'2021-01-15 01:15:57','2021-01-15 01:15:57'),(2006,5,'127.0.0.1','Revert Mfp procurement proposal id - 0501202112','mfp_procurement_aproval',0,0,'2021-01-15 01:16:25','2021-01-15 01:16:25'),(2007,5,'127.0.0.1','Proposal consolidated into 40of proposal ids - 23414000040,23000039','mfp_procurement_aproval',0,0,'2021-01-15 01:16:40','2021-01-15 01:16:40'),(2008,6,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:19:51','2021-01-15 01:19:51'),(2009,6,'127.0.0.1','Approved Mfp procurement proposal ids - 23000039,23414000040','mfp_procurement_aproval',0,0,'2021-01-15 01:20:21','2021-01-15 01:20:21'),(2010,6,'127.0.0.1','Proposal id 23000039assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-01-15 01:20:38','2021-01-15 01:20:38'),(2011,6,'127.0.0.1','Proposal id 23414000040assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-01-15 01:20:39','2021-01-15 01:20:39'),(2012,8,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:21:32','2021-01-15 01:21:32'),(2013,8,'127.0.0.1','Approved Mfp procurement proposal ids - 23000039,23414000040','mfp_procurement_aproval',0,0,'2021-01-15 01:21:59','2021-01-15 01:21:59'),(2014,8,'127.0.0.1','Proposal consolidated into 23_40 of proposal ids - 0601202112,23000041','mfp_procurement_aproval',0,0,'2021-01-15 01:25:33','2021-01-15 01:25:33'),(2015,8,'127.0.0.1','Proposal id 0601202112 assigned to ministry','mfp_procurement_aproval',0,0,'2021-01-15 01:26:00','2021-01-15 01:26:00'),(2016,8,'127.0.0.1','Proposal id 23000039 assigned to ministry','mfp_procurement_aproval',0,0,'2021-01-15 01:26:01','2021-01-15 01:26:01'),(2017,8,'127.0.0.1','Proposal id 23414000040 assigned to ministry','mfp_procurement_aproval',0,0,'2021-01-15 01:26:01','2021-01-15 01:26:01'),(2018,8,'127.0.0.1','Proposal id 23000041 assigned to ministry','mfp_procurement_aproval',0,0,'2021-01-15 01:26:04','2021-01-15 01:26:04'),(2019,9,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:26:29','2021-01-15 01:26:29'),(2020,9,'127.0.0.1','Approved Mfp procurement proposal ids - 0601202112,23000039,23414000040,23000041','mfp_procurement_aproval',0,0,'2021-01-15 01:26:51','2021-01-15 01:26:51'),(2021,9,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:27:30','2021-01-15 01:27:30'),(2022,9,'127.0.0.1','Sanction Rs.1of consolidation id 23_40','mfp_procurement_fund_sanctioned',0,0,'2021-01-15 01:36:30','2021-01-15 01:36:30'),(2023,8,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:37:48','2021-01-15 01:37:48'),(2024,8,'127.0.0.1','Sanction Rs.12of consolidation id 23_40','mfp_procurement_fund_sanctioned',0,0,'2021-01-15 01:38:36','2021-01-15 01:38:36'),(2025,8,'127.0.0.1','Fund release of Rs.0.13 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-01-15 01:42:38','2021-01-15 01:42:38'),(2026,8,'127.0.0.1','Fund release of Rs.6.43 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-01-15 01:43:08','2021-01-15 01:43:08'),(2027,0,'127.0.0.1','Login Failed With Username :sia_maipur_level2',NULL,0,0,'2021-01-15 01:43:35','2021-01-15 01:43:35'),(2028,6,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:43:46','2021-01-15 01:43:46'),(2029,6,'127.0.0.1','Fund release Rs.0.07 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-01-15 01:53:12','2021-01-15 01:53:12'),(2030,2,'127.0.0.1','Login',NULL,0,0,'2021-01-15 01:56:21','2021-01-15 01:56:21'),(2031,2,'127.0.0.1','Fund release by DIA of Rs.0.02 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-01-15 01:58:37','2021-01-15 01:58:37'),(2032,2,'127.0.0.1','Fund release by DIA of Rs.0.02 of proposal id 23414000040','mfp_procurement_fund_release',0,0,'2021-01-15 02:00:40','2021-01-15 02:00:40'),(2033,0,'127.0.0.1','Login Failed With Username :sa_senapati',NULL,0,0,'2021-01-15 03:12:03','2021-01-15 03:12:03'),(2034,10,'127.0.0.1','Login',NULL,0,0,'2021-01-15 03:12:29','2021-01-15 03:12:29'),(2035,10,'127.0.0.1','Login',NULL,0,0,'2021-01-17 23:15:29','2021-01-17 23:15:29'),(2036,6,'127.0.0.1','Login',NULL,0,0,'2021-01-18 03:56:09','2021-01-18 03:56:09'),(2037,1,'127.0.0.1','Login',NULL,0,0,'2021-01-18 05:26:37','2021-01-18 05:26:37'),(2038,6,'127.0.0.1','Login',NULL,0,0,'2021-01-18 06:49:49','2021-01-18 06:49:49'),(2039,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 06:55:24','2021-01-18 06:55:24'),(2040,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 06:55:38','2021-01-18 06:55:38'),(2041,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 06:56:14','2021-01-18 06:56:14'),(2042,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 06:57:12','2021-01-18 06:57:12'),(2043,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 06:58:07','2021-01-18 06:58:07'),(2044,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 06:59:07','2021-01-18 06:59:07'),(2045,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 07:01:30','2021-01-18 07:01:30'),(2046,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 07:01:50','2021-01-18 07:01:50'),(2047,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-18 07:02:06','2021-01-18 07:02:06'),(2048,6,'127.0.0.1','Login',NULL,0,0,'2021-01-18 07:24:45','2021-01-18 07:24:45'),(2049,6,'127.0.0.1','Login',NULL,0,0,'2021-01-18 23:28:31','2021-01-18 23:28:31'),(2050,6,'127.0.0.1','Added auction transaction detail ','auction',0,0,'2021-01-19 00:30:15','2021-01-19 00:30:15'),(2051,0,'127.0.0.1','Login Failed With Username :sia_dia_manipur',NULL,0,0,'2021-01-19 03:08:24','2021-01-19 03:08:24'),(2052,6,'127.0.0.1','Login',NULL,0,0,'2021-01-19 03:08:39','2021-01-19 03:08:39'),(2053,6,'127.0.0.1','Added auction transaction detail of reference number-24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:11:48','2021-01-19 03:11:48'),(2054,6,'127.0.0.1','Edited transaction detail of reference number -24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:36:56','2021-01-19 03:36:56'),(2055,6,'127.0.0.1','Edited transaction detail of reference number -24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:37:22','2021-01-19 03:37:22'),(2056,6,'127.0.0.1','Edited transaction detail of reference number -24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:38:09','2021-01-19 03:38:09'),(2057,6,'127.0.0.1','Edited transaction detail of reference number -24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:42:04','2021-01-19 03:42:04'),(2058,6,'127.0.0.1','Edited transaction detail of reference number -24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:42:20','2021-01-19 03:42:20'),(2059,6,'127.0.0.1','Edited transaction detail of reference number -24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:42:42','2021-01-19 03:42:42'),(2060,6,'127.0.0.1','Edited transaction detail of reference number -24b6796a-edd2-4688-84ba-c0980f415155','auction',0,0,'2021-01-19 03:59:48','2021-01-19 03:59:48'),(2061,1,'127.0.0.1','Login',NULL,0,0,'2021-01-19 04:18:57','2021-01-19 04:18:57'),(2062,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-19 04:19:06','2021-01-19 04:19:06'),(2063,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-19 04:19:16','2021-01-19 04:19:16'),(2064,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-19 04:19:16','2021-01-19 04:19:16'),(2065,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-19 04:21:06','2021-01-19 04:21:06'),(2066,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-19 04:21:07','2021-01-19 04:21:07'),(2067,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-19 04:22:30','2021-01-19 04:22:30'),(2068,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-19 04:22:37','2021-01-19 04:22:37'),(2069,1,'127.0.0.1','User List',NULL,0,0,'2021-01-19 04:22:38','2021-01-19 04:22:38'),(2070,1,'127.0.0.1','User View',NULL,0,0,'2021-01-19 04:22:44','2021-01-19 04:22:44'),(2071,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-19 04:25:52','2021-01-19 04:25:52'),(2072,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-19 04:25:57','2021-01-19 04:25:57'),(2073,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-19 04:25:57','2021-01-19 04:25:57'),(2074,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-19 04:26:12','2021-01-19 04:26:12'),(2075,6,'127.0.0.1','Login',NULL,0,0,'2021-01-19 04:26:36','2021-01-19 04:26:36'),(2076,6,'127.0.0.1','Login',NULL,0,0,'2021-01-20 00:14:01','2021-01-20 00:14:01'),(2077,1,'127.0.0.1','Login',NULL,0,0,'2021-01-20 01:33:35','2021-01-20 01:33:35'),(2078,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-20 01:33:40','2021-01-20 01:33:40'),(2079,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-20 01:33:42','2021-01-20 01:33:42'),(2080,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 01:33:43','2021-01-20 01:33:43'),(2081,1,'127.0.0.1','User View',NULL,0,0,'2021-01-20 01:33:47','2021-01-20 01:33:47'),(2082,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-20 01:34:14','2021-01-20 01:34:14'),(2083,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-20 01:34:17','2021-01-20 01:34:17'),(2084,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-20 01:34:17','2021-01-20 01:34:17'),(2085,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-20 01:35:25','2021-01-20 01:35:25'),(2086,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-20 01:35:29','2021-01-20 01:35:29'),(2087,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-20 01:35:30','2021-01-20 01:35:30'),(2088,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-20 01:35:39','2021-01-20 01:35:39'),(2089,8,'127.0.0.1','Login',NULL,0,0,'2021-01-20 01:35:43','2021-01-20 01:35:43'),(2090,10,'127.0.0.1','Login',NULL,0,0,'2021-01-20 03:02:40','2021-01-20 03:02:40'),(2091,10,'127.0.0.1','Year List',NULL,0,0,'2021-01-20 03:25:24','2021-01-20 03:25:24'),(2092,10,'127.0.0.1','Year List',NULL,0,0,'2021-01-20 03:25:40','2021-01-20 03:25:40'),(2093,10,'127.0.0.1','Year List',NULL,0,0,'2021-01-20 03:25:55','2021-01-20 03:25:55'),(2094,10,'127.0.0.1','Year List',NULL,0,0,'2021-01-20 03:26:30','2021-01-20 03:26:30'),(2095,10,'127.0.0.1','added tribal detail form of reference number 84422cdc-5ce8-4dc7-853f-99fb3e527e88','mfp_procurement_tribal_detail_form',0,0,'2021-01-20 03:44:57','2021-01-20 03:44:57'),(2096,10,'127.0.0.1','added tribal detail form of reference number 8cfb19cd-a2d6-4f04-8824-e6b8519159ff','mfp_procurement_tribal_detail_form',0,0,'2021-01-20 03:56:49','2021-01-20 03:56:49'),(2097,10,'127.0.0.1','added tribal detail form of reference number 5d3c6704-18ba-43af-a8ba-84b84c0cfe5f','mfp_procurement_tribal_detail_form',0,0,'2021-01-20 04:08:25','2021-01-20 04:08:25'),(2098,10,'127.0.0.1','added tribal detail form of reference number 65b493bf-4862-4946-9e61-2448c4aad51d','mfp_procurement_tribal_detail_form',0,0,'2021-01-20 04:08:53','2021-01-20 04:08:53'),(2099,10,'127.0.0.1','Login',NULL,0,0,'2021-01-20 04:47:16','2021-01-20 04:47:16'),(2100,1,'127.0.0.1','Login',NULL,0,0,'2021-01-20 23:22:48','2021-01-20 23:22:48'),(2101,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-20 23:23:36','2021-01-20 23:23:36'),(2102,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:23:37','2021-01-20 23:23:37'),(2103,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:23:39','2021-01-20 23:23:39'),(2104,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:23:42','2021-01-20 23:23:42'),(2105,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:23:44','2021-01-20 23:23:44'),(2106,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-20 23:45:09','2021-01-20 23:45:09'),(2107,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-20 23:45:27','2021-01-20 23:45:27'),(2108,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:45:33','2021-01-20 23:45:33'),(2109,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:45:36','2021-01-20 23:45:36'),(2110,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:45:37','2021-01-20 23:45:37'),(2111,1,'127.0.0.1','User List',NULL,0,0,'2021-01-20 23:45:53','2021-01-20 23:45:53'),(2112,10,'127.0.0.1','Login',NULL,0,0,'2021-01-21 00:02:17','2021-01-21 00:02:17'),(2113,1,'127.0.0.1','Login',NULL,0,0,'2021-01-21 03:16:48','2021-01-21 03:16:48'),(2114,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:16:55','2021-01-21 03:16:55'),(2115,1,'127.0.0.1','User List',NULL,0,0,'2021-01-21 03:16:57','2021-01-21 03:16:57'),(2116,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:17:44','2021-01-21 03:17:44'),(2117,1,'127.0.0.1','Created User',NULL,0,0,'2021-01-21 03:18:56','2021-01-21 03:18:56'),(2118,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:19:02','2021-01-21 03:19:02'),(2119,1,'127.0.0.1','User List',NULL,0,0,'2021-01-21 03:19:03','2021-01-21 03:19:03'),(2120,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-21 03:19:08','2021-01-21 03:19:08'),(2121,1,'127.0.0.1','User View',NULL,0,0,'2021-01-21 03:19:11','2021-01-21 03:19:11'),(2122,1,'127.0.0.1','Updated User',NULL,0,0,'2021-01-21 03:19:15','2021-01-21 03:19:15'),(2123,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:19:17','2021-01-21 03:19:17'),(2124,1,'127.0.0.1','User List',NULL,0,0,'2021-01-21 03:19:19','2021-01-21 03:19:19'),(2125,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:22:35','2021-01-21 03:22:35'),(2126,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:22:56','2021-01-21 03:22:56'),(2127,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:24:50','2021-01-21 03:24:50'),(2128,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 03:27:22','2021-01-21 03:27:22'),(2129,10,'127.0.0.1','Login',NULL,0,0,'2021-01-21 03:43:25','2021-01-21 03:43:25'),(2130,4,'127.0.0.1','Login',NULL,0,0,'2021-01-21 04:57:19','2021-01-21 04:57:19'),(2131,6,'127.0.0.1','Login',NULL,0,0,'2021-01-21 05:10:27','2021-01-21 05:10:27'),(2132,8,'127.0.0.1','Login',NULL,0,0,'2021-01-21 05:11:04','2021-01-21 05:11:04'),(2133,1,'127.0.0.1','Login',NULL,0,0,'2021-01-21 05:56:22','2021-01-21 05:56:22'),(2134,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-21 05:56:51','2021-01-21 05:56:51'),(2135,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 05:56:53','2021-01-21 05:56:53'),(2136,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 05:56:53','2021-01-21 05:56:53'),(2137,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 05:56:54','2021-01-21 05:56:54'),(2138,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 05:56:54','2021-01-21 05:56:54'),(2139,0,'127.0.0.1','Login Failed With Username :dia_manipur_level3',NULL,0,0,'2021-01-21 06:21:49','2021-01-21 06:21:49'),(2140,1,'127.0.0.1','Login',NULL,0,0,'2021-01-21 06:22:28','2021-01-21 06:22:28'),(2141,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 06:22:34','2021-01-21 06:22:34'),(2142,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 06:22:36','2021-01-21 06:22:36'),(2143,1,'127.0.0.1','Created User',NULL,0,0,'2021-01-21 06:24:13','2021-01-21 06:24:13'),(2144,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 06:24:18','2021-01-21 06:24:18'),(2145,1,'127.0.0.1','User List',NULL,0,0,'2021-01-21 06:24:19','2021-01-21 06:24:19'),(2146,13,'127.0.0.1','Login',NULL,0,0,'2021-01-21 06:24:56','2021-01-21 06:24:56'),(2147,13,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000042','mfp_procurement',0,0,'2021-01-21 06:44:17','2021-01-21 06:44:17'),(2148,5,'127.0.0.1','Login',NULL,0,0,'2021-01-21 06:45:08','2021-01-21 06:45:08'),(2149,3,'127.0.0.1','Login',NULL,0,0,'2021-01-21 06:45:34','2021-01-21 06:45:34'),(2150,1,'127.0.0.1','Login',NULL,0,0,'2021-01-21 06:46:26','2021-01-21 06:46:26'),(2151,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-21 06:46:35','2021-01-21 06:46:35'),(2152,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:46:36','2021-01-21 06:46:36'),(2153,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:46:37','2021-01-21 06:46:37'),(2154,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:46:37','2021-01-21 06:46:37'),(2155,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:46:38','2021-01-21 06:46:38'),(2156,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-21 06:50:14','2021-01-21 06:50:14'),(2157,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:50:15','2021-01-21 06:50:15'),(2158,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:50:16','2021-01-21 06:50:16'),(2159,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:50:16','2021-01-21 06:50:16'),(2160,1,'127.0.0.1','Level View',NULL,0,0,'2021-01-21 06:50:17','2021-01-21 06:50:17'),(2161,3,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000043','mfp_procurement',0,0,'2021-01-21 06:52:38','2021-01-21 06:52:38'),(2162,4,'127.0.0.1','Login',NULL,0,0,'2021-01-21 06:53:18','2021-01-21 06:53:18'),(2163,4,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000044','mfp_procurement',0,0,'2021-01-21 06:56:07','2021-01-21 06:56:07'),(2164,3,'127.0.0.1','Login',NULL,0,0,'2021-01-21 22:51:05','2021-01-21 22:51:05'),(2165,3,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000046','mfp_procurement',0,0,'2021-01-21 22:54:10','2021-01-21 22:54:10'),(2166,5,'127.0.0.1','Login',NULL,0,0,'2021-01-21 23:18:38','2021-01-21 23:18:38'),(2167,5,'127.0.0.1','approved Mfp procurement proposal id - 23000044','mfp_procurement_aproval',0,0,'2021-01-21 23:21:44','2021-01-21 23:21:44'),(2168,5,'127.0.0.1','approved Mfp procurement proposal id - 23000042','mfp_procurement_aproval',0,0,'2021-01-21 23:22:34','2021-01-21 23:22:34'),(2169,5,'127.0.0.1','Proposal consolidated into 23_41 of proposal ids - 23000044,23000042','mfp_procurement_aproval',0,0,'2021-01-21 23:22:44','2021-01-21 23:22:44'),(2170,6,'127.0.0.1','Login',NULL,0,0,'2021-01-21 23:23:06','2021-01-21 23:23:06'),(2171,6,'127.0.0.1','Approved Mfp procurement proposal ids - 23000042,23000044','mfp_procurement_aproval',0,0,'2021-01-21 23:24:40','2021-01-21 23:24:40'),(2172,8,'127.0.0.1','Login',NULL,0,0,'2021-01-21 23:32:00','2021-01-21 23:32:00'),(2173,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 23:32:05','2021-01-21 23:32:05'),(2174,8,'127.0.0.1','User List',NULL,0,0,'2021-01-21 23:32:06','2021-01-21 23:32:06'),(2175,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-21 23:32:54','2021-01-21 23:32:54'),(2176,8,'127.0.0.1','User List',NULL,0,0,'2021-01-21 23:32:55','2021-01-21 23:32:55'),(2177,9,'127.0.0.1','Login',NULL,0,0,'2021-01-21 23:46:12','2021-01-21 23:46:12'),(2178,8,'127.0.0.1','Login',NULL,0,0,'2021-01-21 23:47:32','2021-01-21 23:47:32'),(2179,0,'127.0.0.1','Login Failed With Username :trifed_user_test',NULL,0,0,'2021-01-21 23:58:26','2021-01-21 23:58:26'),(2180,12,'127.0.0.1','Login',NULL,0,0,'2021-01-21 23:58:54','2021-01-21 23:58:54'),(2181,1,'127.0.0.1','Login',NULL,0,0,'2021-01-22 00:02:58','2021-01-22 00:02:58'),(2182,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-22 00:03:03','2021-01-22 00:03:03'),(2183,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-22 00:03:07','2021-01-22 00:03:07'),(2184,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-22 00:03:08','2021-01-22 00:03:08'),(2185,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-22 00:03:28','2021-01-22 00:03:28'),(2186,12,'127.0.0.1','Login',NULL,0,0,'2021-01-22 00:03:49','2021-01-22 00:03:49'),(2187,9,'127.0.0.1','Login',NULL,0,0,'2021-01-22 00:44:23','2021-01-22 00:44:23'),(2188,9,'127.0.0.1','Login',NULL,0,0,'2021-01-22 01:08:59','2021-01-22 01:08:59'),(2189,8,'127.0.0.1','Login',NULL,0,0,'2021-01-22 01:12:00','2021-01-22 01:12:00'),(2190,10,'127.0.0.1','Login',NULL,0,0,'2021-01-24 23:34:44','2021-01-24 23:34:44'),(2191,10,'127.0.0.1','Year List',NULL,0,0,'2021-01-24 23:39:25','2021-01-24 23:39:25'),(2192,10,'127.0.0.1','Year List',NULL,0,0,'2021-01-24 23:52:47','2021-01-24 23:52:47'),(2193,10,'127.0.0.1','Login',NULL,0,0,'2021-01-25 03:05:37','2021-01-25 03:05:37'),(2194,10,'127.0.0.1','added tribal detail form of reference number aac24f2d-58c2-4600-a924-5bf5740b928e','mfp_procurement_tribal_detail_form',0,0,'2021-01-25 03:40:16','2021-01-25 03:40:16'),(2195,10,'127.0.0.1','Login',NULL,0,0,'2021-01-25 05:41:40','2021-01-25 05:41:40'),(2196,6,'127.0.0.1','Login',NULL,0,0,'2021-01-25 05:43:11','2021-01-25 05:43:11'),(2197,8,'127.0.0.1','Login',NULL,0,0,'2021-01-25 05:47:17','2021-01-25 05:47:17'),(2198,1,'127.0.0.1','Login',NULL,0,0,'2021-01-25 05:47:43','2021-01-25 05:47:43'),(2199,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-25 05:47:59','2021-01-25 05:47:59'),(2200,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-25 05:48:07','2021-01-25 05:48:07'),(2201,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-25 05:48:08','2021-01-25 05:48:08'),(2202,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-25 05:49:47','2021-01-25 05:49:47'),(2203,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-25 05:49:48','2021-01-25 05:49:48'),(2204,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-25 05:50:03','2021-01-25 05:50:03'),(2205,8,'127.0.0.1','Login',NULL,0,0,'2021-01-25 05:50:28','2021-01-25 05:50:28'),(2206,8,'127.0.0.1','Created Mfp','mfp_procurement',0,0,'2021-01-25 05:51:01','2021-01-25 05:51:01'),(2207,1,'127.0.0.1','Login',NULL,0,0,'2021-01-27 01:14:29','2021-01-27 01:14:29'),(2208,6,'127.0.0.1','Login',NULL,0,0,'2021-01-27 07:24:55','2021-01-27 07:24:55'),(2209,2,'127.0.0.1','Login',NULL,0,0,'2021-01-27 23:22:16','2021-01-27 23:22:16'),(2210,2,'127.0.0.1','Login',NULL,0,0,'2021-01-28 00:50:51','2021-01-28 00:50:51'),(2211,2,'127.0.0.1','Fund release by DIA of Rs.1 of proposal id 161220202','mfp_procurement_fund_release',0,0,'2021-01-28 00:54:07','2021-01-28 00:54:07'),(2212,2,'127.0.0.1','Login',NULL,0,0,'2021-01-28 02:09:08','2021-01-28 02:09:08'),(2213,2,'127.0.0.1','Login',NULL,0,0,'2021-01-28 03:07:02','2021-01-28 03:07:02'),(2214,2,'127.0.0.1','Login',NULL,0,0,'2021-01-28 04:35:43','2021-01-28 04:35:43'),(2215,2,'127.0.0.1','Login',NULL,0,0,'2021-01-28 05:29:35','2021-01-28 05:29:35'),(2216,2,'127.0.0.1','Fund release by DIA of Rs.5 of proposal id 161220202to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-01-28 06:46:06','2021-01-28 06:46:06'),(2217,1,'127.0.0.1','Login',NULL,0,0,'2021-01-28 06:53:30','2021-01-28 06:53:30'),(2218,1,'127.0.0.1','User Role',NULL,0,0,'2021-01-28 06:53:42','2021-01-28 06:53:42'),(2219,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-28 06:53:47','2021-01-28 06:53:47'),(2220,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-28 06:53:48','2021-01-28 06:53:48'),(2221,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-28 06:54:54','2021-01-28 06:54:54'),(2222,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-28 06:54:55','2021-01-28 06:54:55'),(2223,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-01-28 06:55:54','2021-01-28 06:55:54'),(2224,1,'127.0.0.1','Role View',NULL,0,0,'2021-01-28 06:55:55','2021-01-28 06:55:55'),(2225,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-01-28 06:56:02','2021-01-28 06:56:02'),(2226,2,'127.0.0.1','Login',NULL,0,0,'2021-01-28 06:56:18','2021-01-28 06:56:18'),(2227,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-28 06:57:08','2021-01-28 06:57:08'),(2228,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-28 06:57:12','2021-01-28 06:57:12'),(2229,1,'127.0.0.1','User List',NULL,0,0,'2021-01-28 06:57:13','2021-01-28 06:57:13'),(2230,1,'127.0.0.1','User List',NULL,0,0,'2021-01-28 06:57:20','2021-01-28 06:57:20'),(2231,1,'127.0.0.1','User View',NULL,0,0,'2021-01-28 06:57:25','2021-01-28 06:57:25'),(2232,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-01-28 06:57:39','2021-01-28 06:57:39'),(2233,1,'127.0.0.1','User List',NULL,0,0,'2021-01-28 06:57:40','2021-01-28 06:57:40'),(2234,2,'127.0.0.1','Login',NULL,0,0,'2021-01-28 06:58:07','2021-01-28 06:58:07'),(2235,2,'127.0.0.1','Fund release by DIA of Rs.10 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-01-28 06:59:45','2021-01-28 06:59:45'),(2236,1,'127.0.0.1','Login',NULL,0,0,'2021-01-29 05:07:06','2021-01-29 05:07:06'),(2237,2,'127.0.0.1','Login',NULL,0,0,'2021-02-01 23:36:19','2021-02-01 23:36:19'),(2238,10,'127.0.0.1','Login',NULL,0,0,'2021-02-01 23:38:47','2021-02-01 23:38:47'),(2239,2,'127.0.0.1','Login',NULL,0,0,'2021-02-01 23:47:33','2021-02-01 23:47:33'),(2240,2,'127.0.0.1','Login',NULL,0,0,'2021-02-02 00:25:48','2021-02-02 00:25:48'),(2241,2,'127.0.0.1','Fund release by DIA of Rs.1 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-02 00:28:56','2021-02-02 00:28:56'),(2242,2,'127.0.0.1','Fund release by DIA of Rs.1 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-02 00:29:59','2021-02-02 00:29:59'),(2243,6,'127.0.0.1','Login',NULL,0,0,'2021-02-02 00:53:08','2021-02-02 00:53:08'),(2244,2,'127.0.0.1','Login',NULL,0,0,'2021-02-02 00:54:16','2021-02-02 00:54:16'),(2245,2,'127.0.0.1','Fund release by DIA of Rs.25 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-02 00:58:10','2021-02-02 00:58:10'),(2246,6,'127.0.0.1','Fund release Rs.36478.52 of consolidation id 23_28','mfp_procurement_fund_release',0,0,'2021-02-02 01:06:31','2021-02-02 01:06:31'),(2247,6,'127.0.0.1','Fund release Rs.36113.74 of consolidation id 23_28','mfp_procurement_fund_release',0,0,'2021-02-02 01:07:09','2021-02-02 01:07:09'),(2248,6,'127.0.0.1','Fund release Rs.0.06 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-02-02 01:09:14','2021-02-02 01:09:14'),(2249,6,'127.0.0.1','Fund release Rs.0.06 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-02-02 01:15:31','2021-02-02 01:15:31'),(2250,6,'127.0.0.1','Fund release Rs.0.06 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-02-02 01:21:46','2021-02-02 01:21:46'),(2251,6,'127.0.0.1','Fund release Rs.0.06 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-02-02 01:24:11','2021-02-02 01:24:11'),(2252,6,'127.0.0.1','Fund release Rs.0.06 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-02-02 01:33:15','2021-02-02 01:33:15'),(2253,2,'127.0.0.1','Login',NULL,0,0,'2021-02-02 03:40:52','2021-02-02 03:40:52'),(2254,10,'127.0.0.1','Login',NULL,0,0,'2021-02-02 03:42:08','2021-02-02 03:42:08'),(2255,10,'127.0.0.1','Login',NULL,0,0,'2021-02-02 07:06:57','2021-02-02 07:06:57'),(2256,10,'127.0.0.1','added tribal detail form of reference number 5f0772d5-ff3d-4226-a234-76c263bc592f','mfp_procurement_tribal_detail_form',0,0,'2021-02-02 07:27:09','2021-02-02 07:27:09'),(2257,2,'127.0.0.1','Login',NULL,0,0,'2021-02-02 23:11:12','2021-02-02 23:11:12'),(2258,1,'127.0.0.1','Login',NULL,0,0,'2021-02-02 23:22:13','2021-02-02 23:22:13'),(2259,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-02 23:32:13','2021-02-02 23:32:13'),(2260,1,'127.0.0.1','User List',NULL,0,0,'2021-02-02 23:32:15','2021-02-02 23:32:15'),(2261,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-02 23:32:17','2021-02-02 23:32:17'),(2262,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-02 23:56:24','2021-02-02 23:56:24'),(2263,1,'127.0.0.1','User List',NULL,0,0,'2021-02-02 23:56:25','2021-02-02 23:56:25'),(2264,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-02 23:56:28','2021-02-02 23:56:28'),(2265,8,'127.0.0.1','Login',NULL,0,0,'2021-02-03 00:14:28','2021-02-03 00:14:28'),(2266,2,'127.0.0.1','Login',NULL,0,0,'2021-02-03 00:15:07','2021-02-03 00:15:07'),(2267,6,'127.0.0.1','Login',NULL,0,0,'2021-02-03 00:31:56','2021-02-03 00:31:56'),(2268,1,'127.0.0.1','Login',NULL,0,0,'2021-02-03 00:35:11','2021-02-03 00:35:11'),(2269,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-03 00:35:19','2021-02-03 00:35:19'),(2270,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-03 00:35:25','2021-02-03 00:35:25'),(2271,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-03 00:35:25','2021-02-03 00:35:25'),(2272,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 00:37:36','2021-02-03 00:37:36'),(2273,1,'127.0.0.1','User List',NULL,0,0,'2021-02-03 00:37:37','2021-02-03 00:37:37'),(2274,1,'127.0.0.1','User View',NULL,0,0,'2021-02-03 00:37:40','2021-02-03 00:37:40'),(2275,2,'127.0.0.1','Login',NULL,0,0,'2021-02-03 01:25:27','2021-02-03 01:25:27'),(2276,0,'127.0.0.1','Login Failed With Username :nodal_manipur_level2',NULL,0,0,'2021-02-03 03:27:24','2021-02-03 03:27:24'),(2277,8,'127.0.0.1','Login',NULL,0,0,'2021-02-03 03:27:33','2021-02-03 03:27:33'),(2278,6,'127.0.0.1','Login',NULL,0,0,'2021-02-03 03:28:07','2021-02-03 03:28:07'),(2279,1,'127.0.0.1','Login',NULL,0,0,'2021-02-03 03:28:26','2021-02-03 03:28:26'),(2280,8,'127.0.0.1','Login',NULL,0,0,'2021-02-03 03:35:14','2021-02-03 03:35:14'),(2284,8,'127.0.0.1','Added auction committe members of reference number -dfg564','auction',0,0,'2021-02-03 03:58:09','2021-02-03 03:58:09'),(2285,11,'127.0.0.1','Login',NULL,0,0,'2021-02-03 03:59:22','2021-02-03 03:59:22'),(2286,8,'127.0.0.1','Login',NULL,0,0,'2021-02-03 04:01:36','2021-02-03 04:01:36'),(2287,8,'127.0.0.1','Added auction committe members of reference number -fgdg','auction',0,0,'2021-02-03 04:02:17','2021-02-03 04:02:17'),(2288,11,'127.0.0.1','Login',NULL,0,0,'2021-02-03 04:02:39','2021-02-03 04:02:39'),(2289,2,'127.0.0.1','Login',NULL,0,0,'2021-02-03 04:41:40','2021-02-03 04:41:40'),(2290,2,'127.0.0.1','Login',NULL,0,0,'2021-02-03 05:49:53','2021-02-03 05:49:53'),(2291,2,'127.0.0.1','Fund release by DIA of Rs.2 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-03 06:00:46','2021-02-03 06:00:46'),(2292,2,'127.0.0.1','Fund release by DIA of Rs.2 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-03 06:02:20','2021-02-03 06:02:20'),(2293,2,'127.0.0.1','Fund release by DIA of Rs.1 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-03 06:04:02','2021-02-03 06:04:02'),(2294,2,'127.0.0.1','Fund release by DIA of Rs.1 of proposal id 161220202 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-03 06:06:18','2021-02-03 06:06:18'),(2295,8,'127.0.0.1','Login',NULL,0,0,'2021-02-03 06:07:03','2021-02-03 06:07:03'),(2296,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:07:12','2021-02-03 06:07:12'),(2297,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:07:16','2021-02-03 06:07:16'),(2298,8,'127.0.0.1','User List',NULL,0,0,'2021-02-03 06:07:17','2021-02-03 06:07:17'),(2299,8,'127.0.0.1','User List',NULL,0,0,'2021-02-03 06:11:18','2021-02-03 06:11:18'),(2301,8,'127.0.0.1','Added auction committe members of reference number -dfrg34563','auction',0,0,'2021-02-03 06:12:16','2021-02-03 06:12:16'),(2302,6,'127.0.0.1','Login',NULL,0,0,'2021-02-03 06:12:33','2021-02-03 06:12:33'),(2303,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:14:59','2021-02-03 06:14:59'),(2304,8,'127.0.0.1','User List',NULL,0,0,'2021-02-03 06:15:00','2021-02-03 06:15:00'),(2305,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:15:08','2021-02-03 06:15:08'),(2306,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:18:40','2021-02-03 06:18:40'),(2307,8,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:19:55','2021-02-03 06:19:55'),(2308,1,'127.0.0.1','Login',NULL,0,0,'2021-02-03 06:36:53','2021-02-03 06:36:53'),(2309,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-03 06:37:16','2021-02-03 06:37:16'),(2310,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:37:38','2021-02-03 06:37:38'),(2311,1,'127.0.0.1','User List',NULL,0,0,'2021-02-03 06:37:40','2021-02-03 06:37:40'),(2312,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:37:41','2021-02-03 06:37:41'),(2313,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:40:52','2021-02-03 06:40:52'),(2314,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:41:56','2021-02-03 06:41:56'),(2315,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:42:33','2021-02-03 06:42:33'),(2316,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:42:36','2021-02-03 06:42:36'),(2317,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:42:39','2021-02-03 06:42:39'),(2318,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:42:42','2021-02-03 06:42:42'),(2319,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:42:45','2021-02-03 06:42:45'),(2320,1,'127.0.0.1','User List',NULL,0,0,'2021-02-03 06:42:49','2021-02-03 06:42:49'),(2321,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-03 06:42:55','2021-02-03 06:42:55'),(2322,1,'127.0.0.1','User View',NULL,0,0,'2021-02-03 06:42:59','2021-02-03 06:42:59'),(2323,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:54:21','2021-02-03 06:54:21'),(2324,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 06:56:00','2021-02-03 06:56:00'),(2325,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 07:00:09','2021-02-03 07:00:09'),(2326,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 07:00:59','2021-02-03 07:00:59'),(2327,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 07:02:26','2021-02-03 07:02:26'),(2328,1,'127.0.0.1','Login',NULL,0,0,'2021-02-03 23:41:36','2021-02-03 23:41:36'),(2329,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 23:41:44','2021-02-03 23:41:44'),(2330,1,'127.0.0.1','User List',NULL,0,0,'2021-02-03 23:41:45','2021-02-03 23:41:45'),(2331,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 23:41:47','2021-02-03 23:41:47'),(2332,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-03 23:49:19','2021-02-03 23:49:19'),(2333,1,'127.0.0.1','Login',NULL,0,0,'2021-02-04 00:35:07','2021-02-04 00:35:07'),(2334,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 00:35:22','2021-02-04 00:35:22'),(2335,1,'127.0.0.1','User List',NULL,0,0,'2021-02-04 00:35:23','2021-02-04 00:35:23'),(2336,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 00:35:26','2021-02-04 00:35:26'),(2337,1,'127.0.0.1','Created User',NULL,0,0,'2021-02-04 00:37:24','2021-02-04 00:37:24'),(2338,1,'127.0.0.1','Created User',NULL,0,0,'2021-02-04 00:37:33','2021-02-04 00:37:33'),(2339,1,'127.0.0.1','Created User',NULL,0,0,'2021-02-04 00:38:21','2021-02-04 00:38:21'),(2340,1,'127.0.0.1','Created User',NULL,0,0,'2021-02-04 00:38:34','2021-02-04 00:38:34'),(2341,1,'127.0.0.1','Created User',NULL,0,0,'2021-02-04 00:44:51','2021-02-04 00:44:51'),(2342,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 00:44:55','2021-02-04 00:44:55'),(2343,1,'127.0.0.1','User List',NULL,0,0,'2021-02-04 00:44:56','2021-02-04 00:44:56'),(2344,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:45:20','2021-02-04 00:45:20'),(2345,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:45:23','2021-02-04 00:45:23'),(2346,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:48:02','2021-02-04 00:48:02'),(2347,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:48:05','2021-02-04 00:48:05'),(2348,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 00:48:11','2021-02-04 00:48:11'),(2349,1,'127.0.0.1','User List',NULL,0,0,'2021-02-04 00:48:12','2021-02-04 00:48:12'),(2350,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:48:29','2021-02-04 00:48:29'),(2351,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:48:32','2021-02-04 00:48:32'),(2352,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:53:22','2021-02-04 00:53:22'),(2353,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:53:25','2021-02-04 00:53:25'),(2354,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:53:44','2021-02-04 00:53:44'),(2355,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:53:46','2021-02-04 00:53:46'),(2356,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:53:54','2021-02-04 00:53:54'),(2357,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:53:57','2021-02-04 00:53:57'),(2358,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:54:25','2021-02-04 00:54:25'),(2359,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:54:28','2021-02-04 00:54:28'),(2360,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:54:42','2021-02-04 00:54:42'),(2361,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:54:45','2021-02-04 00:54:45'),(2362,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:55:31','2021-02-04 00:55:31'),(2363,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:55:34','2021-02-04 00:55:34'),(2364,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:56:21','2021-02-04 00:56:21'),(2365,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:56:24','2021-02-04 00:56:24'),(2366,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 00:56:39','2021-02-04 00:56:39'),(2367,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 00:56:42','2021-02-04 00:56:42'),(2368,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:11:50','2021-02-04 01:11:50'),(2369,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:11:53','2021-02-04 01:11:53'),(2370,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:13:21','2021-02-04 01:13:21'),(2371,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:13:24','2021-02-04 01:13:24'),(2372,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:14:03','2021-02-04 01:14:03'),(2373,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:14:06','2021-02-04 01:14:06'),(2374,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:14:52','2021-02-04 01:14:52'),(2375,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:14:55','2021-02-04 01:14:55'),(2376,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:15:57','2021-02-04 01:15:57'),(2377,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:16:00','2021-02-04 01:16:00'),(2378,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:17:15','2021-02-04 01:17:15'),(2379,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:17:18','2021-02-04 01:17:18'),(2380,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:19:36','2021-02-04 01:19:36'),(2381,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:19:39','2021-02-04 01:19:39'),(2382,1,'127.0.0.1','Updated User',NULL,0,0,'2021-02-04 01:19:50','2021-02-04 01:19:50'),(2383,1,'127.0.0.1','Updated User',NULL,0,0,'2021-02-04 01:20:35','2021-02-04 01:20:35'),(2384,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 01:20:39','2021-02-04 01:20:39'),(2385,1,'127.0.0.1','User List',NULL,0,0,'2021-02-04 01:20:40','2021-02-04 01:20:40'),(2386,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:21:45','2021-02-04 01:21:45'),(2387,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:21:48','2021-02-04 01:21:48'),(2388,1,'127.0.0.1','Updated User',NULL,0,0,'2021-02-04 01:22:00','2021-02-04 01:22:00'),(2389,1,'127.0.0.1','Updated User',NULL,0,0,'2021-02-04 01:22:46','2021-02-04 01:22:46'),(2390,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 01:22:49','2021-02-04 01:22:49'),(2391,1,'127.0.0.1','User List',NULL,0,0,'2021-02-04 01:22:50','2021-02-04 01:22:50'),(2392,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:22:52','2021-02-04 01:22:52'),(2393,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:22:55','2021-02-04 01:22:55'),(2394,1,'127.0.0.1','Updated User',NULL,0,0,'2021-02-04 01:23:01','2021-02-04 01:23:01'),(2395,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 01:23:05','2021-02-04 01:23:05'),(2396,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:23:12','2021-02-04 01:23:12'),(2397,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:23:14','2021-02-04 01:23:14'),(2398,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:23:18','2021-02-04 01:23:18'),(2399,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:23:20','2021-02-04 01:23:20'),(2400,1,'127.0.0.1','Updated User',NULL,0,0,'2021-02-04 01:23:28','2021-02-04 01:23:28'),(2401,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 01:23:31','2021-02-04 01:23:31'),(2402,1,'127.0.0.1','User List',NULL,0,0,'2021-02-04 01:23:32','2021-02-04 01:23:32'),(2403,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-04 01:23:36','2021-02-04 01:23:36'),(2404,1,'127.0.0.1','User View',NULL,0,0,'2021-02-04 01:23:38','2021-02-04 01:23:38'),(2405,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 01:23:46','2021-02-04 01:23:46'),(2406,1,'127.0.0.1','User List',NULL,0,0,'2021-02-04 01:23:48','2021-02-04 01:23:48'),(2407,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-04 01:23:49','2021-02-04 01:23:49'),(2408,1,'127.0.0.1','Login',NULL,0,0,'2021-02-04 03:52:20','2021-02-04 03:52:20'),(2409,2,'127.0.0.1','Login',NULL,0,0,'2021-02-04 04:44:29','2021-02-04 04:44:29'),(2410,10,'127.0.0.1','Login',NULL,0,0,'2021-02-04 04:45:50','2021-02-04 04:45:50'),(2411,2,'127.0.0.1','Login',NULL,0,0,'2021-02-04 04:46:36','2021-02-04 04:46:36'),(2412,10,'127.0.0.1','Login',NULL,0,0,'2021-02-04 04:47:28','2021-02-04 04:47:28'),(2413,10,'127.0.0.1','added tribal detail form of reference number 6140e4d9-6fb0-4bb3-bd1c-48ab06a0bc5f','mfp_procurement_tribal_detail_form',0,0,'2021-02-04 05:18:25','2021-02-04 05:18:25'),(2414,10,'127.0.0.1','added tribal detail form of reference number 14e0b120-a1ca-443a-b5c1-a59111a28d66','mfp_procurement_tribal_detail_form',0,0,'2021-02-04 05:20:22','2021-02-04 05:20:22'),(2415,10,'127.0.0.1','added tribal detail form of reference number 4d7433cf-0d51-42a1-b6c2-998d62dad92c','mfp_procurement_tribal_detail_form',0,0,'2021-02-04 05:33:28','2021-02-04 05:33:28'),(2416,1,'127.0.0.1','Login',NULL,0,0,'2021-02-04 22:59:02','2021-02-04 22:59:02'),(2417,1,'127.0.0.1','Login',NULL,0,0,'2021-02-04 23:52:30','2021-02-04 23:52:30'),(2418,10,'127.0.0.1','Login',NULL,0,0,'2021-02-04 23:54:11','2021-02-04 23:54:11'),(2419,1,'127.0.0.1','Login',NULL,0,0,'2021-02-05 00:01:15','2021-02-05 00:01:15'),(2420,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-05 00:01:20','2021-02-05 00:01:20'),(2421,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-05 00:01:25','2021-02-05 00:01:25'),(2422,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-05 00:01:26','2021-02-05 00:01:26'),(2423,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-02-05 00:02:01','2021-02-05 00:02:01'),(2424,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-02-05 00:03:03','2021-02-05 00:03:03'),(2425,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-05 00:03:10','2021-02-05 00:03:10'),(2426,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-05 00:03:13','2021-02-05 00:03:13'),(2427,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-05 00:03:16','2021-02-05 00:03:16'),(2428,1,'127.0.0.1','User List',NULL,0,0,'2021-02-05 00:03:17','2021-02-05 00:03:17'),(2429,1,'127.0.0.1','User View',NULL,0,0,'2021-02-05 00:03:22','2021-02-05 00:03:22'),(2430,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-05 00:03:36','2021-02-05 00:03:36'),(2431,1,'127.0.0.1','User List',NULL,0,0,'2021-02-05 00:03:38','2021-02-05 00:03:38'),(2432,10,'127.0.0.1','Login',NULL,0,0,'2021-02-05 00:05:19','2021-02-05 00:05:19'),(2433,10,'127.0.0.1','Login',NULL,0,0,'2021-02-05 00:27:27','2021-02-05 00:27:27'),(2434,10,'127.0.0.1','Generated Receipt of Actual detail reference id 65b493bf-4862-4946-9e61-2448c4aad51d','mfp_procurement_tribal_detail_form',0,0,'2021-02-05 00:28:33','2021-02-05 00:28:33'),(2435,10,'127.0.0.1','Login',NULL,0,0,'2021-02-08 00:26:33','2021-02-08 00:26:33'),(2436,1,'127.0.0.1','Login',NULL,0,0,'2021-02-08 03:08:31','2021-02-08 03:08:31'),(2437,2,'127.0.0.1','Login',NULL,0,0,'2021-02-08 23:21:13','2021-02-08 23:21:13'),(2438,0,'127.0.0.1','Login Failed With Username :nodal_manipur',NULL,0,0,'2021-02-09 00:30:39','2021-02-09 00:30:39'),(2439,8,'127.0.0.1','Login',NULL,0,0,'2021-02-09 00:30:53','2021-02-09 00:30:53'),(2440,2,'127.0.0.1','Login',NULL,0,0,'2021-02-09 01:36:37','2021-02-09 01:36:37'),(2441,8,'127.0.0.1','Login',NULL,0,0,'2021-02-09 01:37:12','2021-02-09 01:37:12'),(2442,6,'127.0.0.1','Login',NULL,0,0,'2021-02-09 01:37:50','2021-02-09 01:37:50'),(2443,10,'127.0.0.1','Login',NULL,0,0,'2021-02-09 01:38:15','2021-02-09 01:38:15'),(2444,2,'127.0.0.1','Login',NULL,0,0,'2021-02-09 04:25:47','2021-02-09 04:25:47'),(2445,2,'127.0.0.1','Fund release by DIA of Rs.1 of proposal id 141220201 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-09 04:32:42','2021-02-09 04:32:42'),(2446,10,'127.0.0.1','Login',NULL,0,0,'2021-02-09 05:34:41','2021-02-09 05:34:41'),(2447,8,'127.0.0.1','Login',NULL,0,0,'2021-02-10 03:47:37','2021-02-10 03:47:37'),(2448,8,'127.0.0.1','Login',NULL,0,0,'2021-02-10 04:23:11','2021-02-10 04:23:11'),(2449,8,'127.0.0.1','Added auction committe members of reference number -gh543','auction',0,0,'2021-02-10 05:30:31','2021-02-10 05:30:31'),(2450,8,'127.0.0.1','Added auction committe members of reference number -sdffdrewt','auction',0,0,'2021-02-10 05:32:20','2021-02-10 05:32:20'),(2451,8,'127.0.0.1','Added auction committe members of reference number -sdf35345','auction',0,0,'2021-02-10 05:34:52','2021-02-10 05:34:52'),(2452,8,'127.0.0.1','Login',NULL,0,0,'2021-02-10 06:55:31','2021-02-10 06:55:31'),(2453,8,'127.0.0.1','Edited auction committe members of reference number -sdffdrewt','auction',0,0,'2021-02-10 07:01:05','2021-02-10 07:01:05'),(2454,8,'127.0.0.1','Login',NULL,0,0,'2021-02-11 03:44:04','2021-02-11 03:44:04'),(2455,6,'127.0.0.1','Login',NULL,0,0,'2021-02-11 03:50:05','2021-02-11 03:50:05'),(2456,10,'127.0.0.1','Login',NULL,0,0,'2021-02-11 03:50:27','2021-02-11 03:50:27'),(2457,1,'127.0.0.1','Login',NULL,0,0,'2021-02-11 03:50:47','2021-02-11 03:50:47'),(2458,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-11 03:51:33','2021-02-11 03:51:33'),(2459,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-11 03:51:39','2021-02-11 03:51:39'),(2460,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-11 03:51:39','2021-02-11 03:51:39'),(2461,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-02-11 03:51:50','2021-02-11 03:51:50'),(2462,6,'127.0.0.1','Login',NULL,0,0,'2021-02-11 03:52:08','2021-02-11 03:52:08'),(2463,6,'127.0.0.1','Added auction transaction detail of reference number-8706a098-d307-42fe-83df-28972654c845','auction',0,0,'2021-02-11 04:55:58','2021-02-11 04:55:58'),(2464,6,'127.0.0.1','Added auction transaction detail of reference number-0a2d57ed-0d80-4beb-9a6a-93627e4ef475','auction',0,0,'2021-02-11 05:00:41','2021-02-11 05:00:41'),(2465,1,'127.0.0.1','Login',NULL,0,0,'2021-02-11 05:27:50','2021-02-11 05:27:50'),(2466,6,'127.0.0.1','Login',NULL,0,0,'2021-02-11 05:28:41','2021-02-11 05:28:41'),(2467,6,'127.0.0.1','Edited transaction detail of reference number -0a2d57ed-0d80-4beb-9a6a-93627e4ef475','auction',0,0,'2021-02-11 06:03:05','2021-02-11 06:03:05'),(2468,6,'127.0.0.1','Edited transaction detail of reference number -8706a098-d307-42fe-83df-28972654c845','auction',0,0,'2021-02-11 06:03:45','2021-02-11 06:03:45'),(2469,6,'127.0.0.1','Edited transaction detail of reference number -0a2d57ed-0d80-4beb-9a6a-93627e4ef475','auction',0,0,'2021-02-11 06:04:39','2021-02-11 06:04:39'),(2470,6,'127.0.0.1','Login',NULL,0,0,'2021-02-11 06:30:52','2021-02-11 06:30:52'),(2471,10,'127.0.0.1','Login',NULL,0,0,'2021-02-15 00:28:18','2021-02-15 00:28:18'),(2472,2,'127.0.0.1','Login',NULL,0,0,'2021-02-15 23:25:19','2021-02-15 23:25:19'),(2473,10,'127.0.0.1','Login',NULL,0,0,'2021-02-16 00:15:33','2021-02-16 00:15:33'),(2474,1,'127.0.0.1','Login',NULL,0,0,'2021-02-16 00:16:05','2021-02-16 00:16:05'),(2475,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-16 00:16:11','2021-02-16 00:16:11'),(2476,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-16 00:16:17','2021-02-16 00:16:17'),(2477,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-16 00:16:18','2021-02-16 00:16:18'),(2478,10,'127.0.0.1','Login',NULL,0,0,'2021-02-16 00:23:52','2021-02-16 00:23:52'),(2479,2,'127.0.0.1','Login',NULL,0,0,'2021-02-16 00:42:44','2021-02-16 00:42:44'),(2480,1,'127.0.0.1','Login',NULL,0,0,'2021-02-16 01:40:44','2021-02-16 01:40:44'),(2481,1,'127.0.0.1','Login',NULL,0,0,'2021-02-16 03:48:04','2021-02-16 03:48:04'),(2482,2,'127.0.0.1','Login',NULL,0,0,'2021-02-16 04:36:40','2021-02-16 04:36:40'),(2483,1,'127.0.0.1','Login',NULL,0,0,'2021-02-16 05:35:52','2021-02-16 05:35:52'),(2484,1,'127.0.0.1','Login',NULL,0,0,'2021-02-17 00:06:21','2021-02-17 00:06:21'),(2485,1,'127.0.0.1','Login',NULL,0,0,'2021-02-17 03:02:34','2021-02-17 03:02:34'),(2486,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-17 03:02:57','2021-02-17 03:02:57'),(2487,1,'127.0.0.1','User List',NULL,0,0,'2021-02-17 03:02:58','2021-02-17 03:02:58'),(2488,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-17 03:03:00','2021-02-17 03:03:00'),(2489,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-17 03:04:09','2021-02-17 03:04:09'),(2490,1,'127.0.0.1','User List',NULL,0,0,'2021-02-17 03:04:10','2021-02-17 03:04:10'),(2491,0,'127.0.0.1','Login Failed With Username :trader_manipurone',NULL,0,0,'2021-02-17 03:18:16','2021-02-17 03:18:16'),(2492,18,'127.0.0.1','Login',NULL,0,0,'2021-02-17 03:23:08','2021-02-17 03:23:08'),(2493,18,'127.0.0.1','Login',NULL,0,0,'2021-02-17 03:23:17','2021-02-17 03:23:17'),(2494,1,'127.0.0.1','Login',NULL,0,0,'2021-02-17 03:23:54','2021-02-17 03:23:54'),(2495,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-17 03:23:59','2021-02-17 03:23:59'),(2496,1,'127.0.0.1','User List',NULL,0,0,'2021-02-17 03:24:01','2021-02-17 03:24:01'),(2497,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-17 03:24:04','2021-02-17 03:24:04'),(2498,1,'127.0.0.1','User View',NULL,0,0,'2021-02-17 03:24:07','2021-02-17 03:24:07'),(2499,18,'127.0.0.1','Login',NULL,0,0,'2021-02-17 04:18:24','2021-02-17 04:18:24'),(2500,18,'127.0.0.1','Login',NULL,0,0,'2021-02-17 23:02:37','2021-02-17 23:02:37'),(2501,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 00:55:01','2021-02-18 00:55:01'),(2502,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 00:55:49','2021-02-18 00:55:49'),(2503,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 00:56:07','2021-02-18 00:56:07'),(2504,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 00:56:25','2021-02-18 00:56:25'),(2505,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 01:01:49','2021-02-18 01:01:49'),(2506,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 01:22:10','2021-02-18 01:22:10'),(2507,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 01:22:26','2021-02-18 01:22:26'),(2508,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 01:29:47','2021-02-18 01:29:47'),(2509,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 01:30:41','2021-02-18 01:30:41'),(2510,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 01:31:07','2021-02-18 01:31:07'),(2511,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 01:31:21','2021-02-18 01:31:21'),(2512,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-18 06:27:51','2021-02-18 06:27:51'),(2513,18,'127.0.0.1','Added Mfp Price of Mfp Id -2 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 06:36:25','2021-02-18 06:36:25'),(2514,18,'127.0.0.1','Updated Mfp Price of Mfp Id -2 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 07:54:19','2021-02-18 07:54:19'),(2515,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-18 07:54:30','2021-02-18 07:54:30'),(2516,0,'127.0.0.1','Login Failed With Username :market_price',NULL,0,0,'2021-02-18 23:09:17','2021-02-18 23:09:17'),(2517,18,'127.0.0.1','Login',NULL,0,0,'2021-02-18 23:09:40','2021-02-18 23:09:40'),(2518,18,'127.0.0.1','Added Mfp Price of Mfp Id -2 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-18 23:09:55','2021-02-18 23:09:55'),(2519,18,'127.0.0.1','Login',NULL,0,0,'2021-02-19 01:27:44','2021-02-19 01:27:44'),(2520,18,'127.0.0.1','Updated Mfp Price of Mfp Id -2 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 01:29:56','2021-02-19 01:29:56'),(2521,18,'127.0.0.1','Login',NULL,0,0,'2021-02-19 02:04:17','2021-02-19 02:04:17'),(2522,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 05:05:39','2021-02-19 05:05:39'),(2523,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 05:07:15','2021-02-19 05:07:15'),(2524,18,'127.0.0.1','Added Mfp Price of Mfp Id -2 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-19 05:23:13','2021-02-19 05:23:13'),(2525,18,'127.0.0.1','Login',NULL,0,0,'2021-02-19 06:04:52','2021-02-19 06:04:52'),(2526,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 06:05:32','2021-02-19 06:05:32'),(2527,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 06:05:38','2021-02-19 06:05:38'),(2528,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 06:06:20','2021-02-19 06:06:20'),(2529,18,'127.0.0.1','Added Mfp Price of Mfp Id -2 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 06:13:11','2021-02-19 06:13:11'),(2530,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 06:13:53','2021-02-19 06:13:53'),(2531,18,'127.0.0.1','Updated Mfp Price of Mfp Id -2 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 06:36:24','2021-02-19 06:36:24'),(2532,18,'127.0.0.1','Added Mfp Price of Mfp Id -2 and haat bazaar id-2','Mfp Market Price',0,0,'2021-02-19 06:37:00','2021-02-19 06:37:00'),(2533,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-19 06:43:42','2021-02-19 06:43:42'),(2534,18,'127.0.0.1','Login',NULL,0,0,'2021-02-21 23:25:24','2021-02-21 23:25:24'),(2535,3,'127.0.0.1','Login',NULL,0,0,'2021-02-21 23:47:02','2021-02-21 23:47:02'),(2536,1,'127.0.0.1','Login',NULL,0,0,'2021-02-21 23:49:38','2021-02-21 23:49:38'),(2537,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-21 23:49:54','2021-02-21 23:49:54'),(2538,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-21 23:49:58','2021-02-21 23:49:58'),(2539,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-21 23:49:59','2021-02-21 23:49:59'),(2540,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-21 23:51:13','2021-02-21 23:51:13'),(2541,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-21 23:51:14','2021-02-21 23:51:14'),(2542,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-21 23:55:53','2021-02-21 23:55:53'),(2543,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-21 23:55:54','2021-02-21 23:55:54'),(2544,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-21 23:56:49','2021-02-21 23:56:49'),(2545,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-21 23:56:49','2021-02-21 23:56:49'),(2546,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-21 23:57:17','2021-02-21 23:57:17'),(2547,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-21 23:57:18','2021-02-21 23:57:18'),(2548,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-21 23:57:50','2021-02-21 23:57:50'),(2549,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-21 23:57:50','2021-02-21 23:57:50'),(2550,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-22 00:07:01','2021-02-22 00:07:01'),(2551,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-22 00:07:02','2021-02-22 00:07:02'),(2552,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-22 00:07:56','2021-02-22 00:07:56'),(2553,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-22 00:07:57','2021-02-22 00:07:57'),(2554,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-22 00:26:18','2021-02-22 00:26:18'),(2555,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-22 00:26:22','2021-02-22 00:26:22'),(2556,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-22 00:26:26','2021-02-22 00:26:26'),(2557,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-22 00:26:27','2021-02-22 00:26:27'),(2558,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-02-22 00:26:38','2021-02-22 00:26:38'),(2559,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-22 00:28:21','2021-02-22 00:28:21'),(2560,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-22 00:28:21','2021-02-22 00:28:21'),(2561,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-22 00:29:59','2021-02-22 00:29:59'),(2562,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-22 00:30:00','2021-02-22 00:30:00'),(2563,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-22 00:30:56','2021-02-22 00:30:56'),(2564,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-22 00:31:01','2021-02-22 00:31:01'),(2565,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-22 00:31:01','2021-02-22 00:31:01'),(2566,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-02-22 00:31:11','2021-02-22 00:31:11'),(2567,2,'127.0.0.1','Login',NULL,0,0,'2021-02-22 00:31:30','2021-02-22 00:31:30'),(2568,1,'127.0.0.1','Login',NULL,0,0,'2021-02-22 00:31:59','2021-02-22 00:31:59'),(2569,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-22 00:32:06','2021-02-22 00:32:06'),(2570,1,'127.0.0.1','User List',NULL,0,0,'2021-02-22 00:32:08','2021-02-22 00:32:08'),(2571,1,'127.0.0.1','User View',NULL,0,0,'2021-02-22 00:32:12','2021-02-22 00:32:12'),(2572,1,'127.0.0.1','User View',NULL,0,0,'2021-02-22 00:38:11','2021-02-22 00:38:11'),(2573,1,'127.0.0.1','User View',NULL,0,0,'2021-02-22 00:38:35','2021-02-22 00:38:35'),(2574,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-22 00:38:49','2021-02-22 00:38:49'),(2575,1,'127.0.0.1','User List',NULL,0,0,'2021-02-22 00:38:50','2021-02-22 00:38:50'),(2576,1,'127.0.0.1','User View',NULL,0,0,'2021-02-22 00:48:31','2021-02-22 00:48:31'),(2577,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-22 00:48:40','2021-02-22 00:48:40'),(2578,1,'127.0.0.1','User List',NULL,0,0,'2021-02-22 00:48:41','2021-02-22 00:48:41'),(2579,2,'127.0.0.1','Login',NULL,0,0,'2021-02-22 00:52:53','2021-02-22 00:52:53'),(2580,1,'127.0.0.1','Login',NULL,0,0,'2021-02-22 00:55:10','2021-02-22 00:55:10'),(2581,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-22 00:55:15','2021-02-22 00:55:15'),(2582,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-02-22 00:55:20','2021-02-22 00:55:20'),(2583,1,'127.0.0.1','Role View',NULL,0,0,'2021-02-22 00:55:20','2021-02-22 00:55:20'),(2584,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-22 00:55:46','2021-02-22 00:55:46'),(2585,1,'127.0.0.1','User List',NULL,0,0,'2021-02-22 00:55:48','2021-02-22 00:55:48'),(2586,1,'127.0.0.1','User List',NULL,0,0,'2021-02-22 00:55:52','2021-02-22 00:55:52'),(2587,1,'127.0.0.1','User View',NULL,0,0,'2021-02-22 00:55:56','2021-02-22 00:55:56'),(2588,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-02-22 00:56:05','2021-02-22 00:56:05'),(2589,1,'127.0.0.1','User List',NULL,0,0,'2021-02-22 00:56:06','2021-02-22 00:56:06'),(2590,2,'127.0.0.1','Login',NULL,0,0,'2021-02-22 00:56:19','2021-02-22 00:56:19'),(2591,2,'127.0.0.1','Login',NULL,0,0,'2021-02-22 00:56:33','2021-02-22 00:56:33'),(2592,18,'127.0.0.1','Login',NULL,0,0,'2021-02-22 01:50:06','2021-02-22 01:50:06'),(2593,2,'127.0.0.1','Login',NULL,0,0,'2021-02-22 03:22:28','2021-02-22 03:22:28'),(2594,18,'127.0.0.1','Login',NULL,0,0,'2021-02-22 22:51:34','2021-02-22 22:51:34'),(2595,18,'127.0.0.1','Login',NULL,0,0,'2021-02-23 00:30:22','2021-02-23 00:30:22'),(2609,18,'127.0.0.1','Added Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-23 00:54:55','2021-02-23 00:54:55'),(2610,2,'127.0.0.1','Login',NULL,0,0,'2021-02-23 01:16:00','2021-02-23 01:16:00'),(2611,18,'127.0.0.1','Login',NULL,0,0,'2021-02-23 01:21:36','2021-02-23 01:21:36'),(2612,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-23 01:22:04','2021-02-23 01:22:04'),(2613,18,'127.0.0.1','Updated Mfp Price of Mfp Id -3 and haat bazaar id-1','Mfp Market Price',0,0,'2021-02-23 01:22:56','2021-02-23 01:22:56'),(2614,2,'127.0.0.1','Login',NULL,0,0,'2021-02-23 01:23:17','2021-02-23 01:23:17'),(2615,18,'127.0.0.1','Login',NULL,0,0,'2021-02-23 01:24:14','2021-02-23 01:24:14'),(2616,1,'127.0.0.1','Login',NULL,0,0,'2021-02-23 03:07:33','2021-02-23 03:07:33'),(2617,2,'127.0.0.1','Login',NULL,0,0,'2021-02-23 03:07:57','2021-02-23 03:07:57'),(2618,9,'127.0.0.1','Login',NULL,0,0,'2021-02-23 03:15:09','2021-02-23 03:15:09'),(2619,8,'127.0.0.1','Login',NULL,0,0,'2021-02-23 03:26:49','2021-02-23 03:26:49'),(2620,10,'127.0.0.1','Login',NULL,0,0,'2021-02-23 03:34:44','2021-02-23 03:34:44'),(2621,18,'127.0.0.1','Login',NULL,0,0,'2021-02-23 05:08:48','2021-02-23 05:08:48'),(2622,10,'127.0.0.1','Login',NULL,0,0,'2021-02-23 06:21:47','2021-02-23 06:21:47'),(2623,1,'127.0.0.1','Login',NULL,0,0,'2021-02-24 23:07:06','2021-02-24 23:07:06'),(2624,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-24 23:07:36','2021-02-24 23:07:36'),(2625,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:37','2021-02-24 23:07:37'),(2626,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:41','2021-02-24 23:07:41'),(2627,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:44','2021-02-24 23:07:44'),(2628,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:46','2021-02-24 23:07:46'),(2629,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:47','2021-02-24 23:07:47'),(2630,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:48','2021-02-24 23:07:48'),(2631,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:50','2021-02-24 23:07:50'),(2632,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:07:51','2021-02-24 23:07:51'),(2633,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-24 23:09:02','2021-02-24 23:09:02'),(2634,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:02','2021-02-24 23:09:02'),(2635,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-24 23:09:07','2021-02-24 23:09:07'),(2636,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:07','2021-02-24 23:09:07'),(2637,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:09','2021-02-24 23:09:09'),(2638,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:11','2021-02-24 23:09:11'),(2639,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:13','2021-02-24 23:09:13'),(2640,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:14','2021-02-24 23:09:14'),(2641,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:16','2021-02-24 23:09:16'),(2642,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:17','2021-02-24 23:09:17'),(2643,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:19','2021-02-24 23:09:19'),(2644,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:20','2021-02-24 23:09:20'),(2645,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:09:59','2021-02-24 23:09:59'),(2646,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:39','2021-02-24 23:13:39'),(2647,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-24 23:13:46','2021-02-24 23:13:46'),(2648,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:47','2021-02-24 23:13:47'),(2649,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:48','2021-02-24 23:13:48'),(2650,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:51','2021-02-24 23:13:51'),(2651,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:52','2021-02-24 23:13:52'),(2652,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:53','2021-02-24 23:13:53'),(2653,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:55','2021-02-24 23:13:55'),(2654,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:56','2021-02-24 23:13:56'),(2655,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:13:58','2021-02-24 23:13:58'),(2656,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-24 23:14:19','2021-02-24 23:14:19'),(2657,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:19','2021-02-24 23:14:19'),(2658,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:21','2021-02-24 23:14:21'),(2659,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:23','2021-02-24 23:14:23'),(2660,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:24','2021-02-24 23:14:24'),(2661,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:26','2021-02-24 23:14:26'),(2662,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:27','2021-02-24 23:14:27'),(2663,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:29','2021-02-24 23:14:29'),(2664,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:30','2021-02-24 23:14:30'),(2665,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:14:31','2021-02-24 23:14:31'),(2666,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:15:18','2021-02-24 23:15:18'),(2667,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:15:19','2021-02-24 23:15:19'),(2668,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-24 23:35:16','2021-02-24 23:35:16'),(2669,6,'127.0.0.1','Login',NULL,0,0,'2021-02-25 04:05:28','2021-02-25 04:05:28'),(2670,6,'127.0.0.1','Login',NULL,0,0,'2021-02-25 04:43:33','2021-02-25 04:43:33'),(2671,6,'127.0.0.1','Login',NULL,0,0,'2021-02-25 05:53:53','2021-02-25 05:53:53'),(2672,9,'127.0.0.1','Login',NULL,0,0,'2021-02-25 05:59:41','2021-02-25 05:59:41'),(2673,6,'127.0.0.1','Login',NULL,0,0,'2021-02-25 06:03:11','2021-02-25 06:03:11'),(2674,6,'127.0.0.1','Proposal id 23000042 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-02-25 06:18:36','2021-02-25 06:18:36'),(2675,6,'127.0.0.1','Proposal id 23000044 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-02-25 06:18:39','2021-02-25 06:18:39'),(2676,8,'127.0.0.1','Login',NULL,0,0,'2021-02-25 06:19:37','2021-02-25 06:19:37'),(2677,8,'127.0.0.1','Approved Mfp procurement proposal ids - 23000042,23000044','mfp_procurement_aproval',0,0,'2021-02-25 06:22:21','2021-02-25 06:22:21'),(2678,4,'127.0.0.1','Login',NULL,0,0,'2021-02-25 07:40:11','2021-02-25 07:40:11'),(2679,4,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-02-25 07:58:01','2021-02-25 07:58:01'),(2680,4,'127.0.0.1','approved Mfp procurement proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-02-25 07:58:02','2021-02-25 07:58:02'),(2681,2,'127.0.0.1','Login',NULL,0,0,'2021-02-25 22:59:40','2021-02-25 22:59:40'),(2682,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000048','mfp_procurement',0,0,'2021-02-25 23:10:55','2021-02-25 23:10:55'),(2683,3,'127.0.0.1','Login',NULL,0,0,'2021-02-25 23:11:38','2021-02-25 23:11:38'),(2684,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:06:01','2021-02-26 00:06:01'),(2685,3,'127.0.0.1','approved Mfp procurement proposal id - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:06:02','2021-02-26 00:06:02'),(2686,4,'127.0.0.1','Login',NULL,0,0,'2021-02-26 00:21:17','2021-02-26 00:21:17'),(2687,4,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:37:11','2021-02-26 00:37:11'),(2688,4,'127.0.0.1','approved Mfp procurement proposal id - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:37:11','2021-02-26 00:37:11'),(2689,5,'127.0.0.1','Login',NULL,0,0,'2021-02-26 00:38:11','2021-02-26 00:38:11'),(2690,5,'127.0.0.1','approved Mfp procurement proposal id - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:39:27','2021-02-26 00:39:27'),(2691,5,'127.0.0.1','Proposal consolidated into 23_42 of proposal ids - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:39:43','2021-02-26 00:39:43'),(2692,6,'127.0.0.1','Login',NULL,0,0,'2021-02-26 00:40:11','2021-02-26 00:40:11'),(2693,6,'127.0.0.1','Approved Mfp procurement proposal ids - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:41:06','2021-02-26 00:41:06'),(2694,6,'127.0.0.1','Proposal id 23000048 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-02-26 00:44:26','2021-02-26 00:44:26'),(2695,6,'127.0.0.1','Login',NULL,0,0,'2021-02-26 00:44:58','2021-02-26 00:44:58'),(2696,5,'127.0.0.1','Login',NULL,0,0,'2021-02-26 00:45:58','2021-02-26 00:45:58'),(2697,8,'127.0.0.1','Login',NULL,0,0,'2021-02-26 00:46:41','2021-02-26 00:46:41'),(2698,8,'127.0.0.1','Approved Mfp procurement proposal ids - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:47:24','2021-02-26 00:47:24'),(2699,8,'127.0.0.1','Revert Mfp procurement proposal id - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 00:59:48','2021-02-26 00:59:48'),(2700,6,'127.0.0.1','Login',NULL,0,0,'2021-02-26 01:00:12','2021-02-26 01:00:12'),(2701,2,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:25:09','2021-02-26 06:25:09'),(2702,6,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:26:08','2021-02-26 06:26:08'),(2703,6,'127.0.0.1','approved Mfp procurement proposal id - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 06:26:34','2021-02-26 06:26:34'),(2704,6,'127.0.0.1','Proposal consolidated into 23_43 of proposal ids - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 06:26:50','2021-02-26 06:26:50'),(2705,8,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:27:47','2021-02-26 06:27:47'),(2706,8,'127.0.0.1','Approved Mfp procurement proposal ids - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 06:28:09','2021-02-26 06:28:09'),(2707,8,'127.0.0.1','Proposal id 23000048 assigned to ministry','mfp_procurement_aproval',0,0,'2021-02-26 06:28:28','2021-02-26 06:28:28'),(2708,9,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:28:51','2021-02-26 06:28:51'),(2709,9,'127.0.0.1','Approved Mfp procurement proposal ids - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 06:29:11','2021-02-26 06:29:11'),(2710,1,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:34:38','2021-02-26 06:34:38'),(2711,1,'127.0.0.1','User Role',NULL,0,0,'2021-02-26 06:35:28','2021-02-26 06:35:28'),(2712,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-26 06:35:29','2021-02-26 06:35:29'),(2713,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-26 06:35:30','2021-02-26 06:35:30'),(2714,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-26 06:35:31','2021-02-26 06:35:31'),(2715,1,'127.0.0.1','Level View',NULL,0,0,'2021-02-26 06:35:32','2021-02-26 06:35:32'),(2716,9,'127.0.0.1','Approved Mfp procurement proposal ids - 23000048','mfp_procurement_aproval',0,0,'2021-02-26 06:56:35','2021-02-26 06:56:35'),(2717,9,'127.0.0.1','Sanction Rs.177075.89 of consolidation id 23_43','mfp_procurement_fund_sanctioned',0,0,'2021-02-26 06:57:19','2021-02-26 06:57:19'),(2718,8,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:57:41','2021-02-26 06:57:41'),(2719,8,'127.0.0.1','Sanction Rs.59025.29 of consolidation id 23_43','mfp_procurement_fund_sanctioned',0,0,'2021-02-26 06:58:00','2021-02-26 06:58:00'),(2720,8,'127.0.0.1','Sanction Rs.0.01 of consolidation id 23_43','mfp_procurement_fund_sanctioned',0,0,'2021-02-26 06:58:19','2021-02-26 06:58:19'),(2721,0,'127.0.0.1','Login Failed With Username :nodal_manipur_level2',NULL,0,0,'2021-02-26 06:58:50','2021-02-26 06:58:50'),(2722,8,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:58:59','2021-02-26 06:58:59'),(2723,8,'127.0.0.1','Fund release Rs.236101.19 of consolidation id 23_43','mfp_procurement_fund_release',0,0,'2021-02-26 06:59:25','2021-02-26 06:59:25'),(2724,6,'127.0.0.1','Login',NULL,0,0,'2021-02-26 06:59:45','2021-02-26 06:59:45'),(2725,6,'127.0.0.1','Fund release Rs.236101.19 of consolidation id 23_43','mfp_procurement_fund_release',0,0,'2021-02-26 07:00:22','2021-02-26 07:00:22'),(2726,2,'127.0.0.1','Login',NULL,0,0,'2021-02-26 07:00:41','2021-02-26 07:00:41'),(2727,2,'127.0.0.1','Fund release by DIA of Rs.100 of proposal id 23000048 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-26 07:02:08','2021-02-26 07:02:08'),(2728,2,'127.0.0.1','Fund release by DIA of Rs.5 of proposal id 23000048 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-02-26 07:04:46','2021-02-26 07:04:46'),(2729,10,'127.0.0.1','Login',NULL,0,0,'2021-02-26 07:05:55','2021-02-26 07:05:55'),(2730,10,'127.0.0.1','added tribal detail form of reference number 44031f50-9e3b-4d27-af4f-300ecb310018','mfp_procurement_tribal_detail_form',0,0,'2021-02-26 07:21:04','2021-02-26 07:21:04'),(2731,3,'127.0.0.1','Login',NULL,0,0,'2021-03-01 04:51:21','2021-03-01 04:51:21'),(2732,8,'127.0.0.1','Login',NULL,0,0,'2021-03-01 05:09:29','2021-03-01 05:09:29'),(2733,9,'127.0.0.1','Login',NULL,0,0,'2021-03-01 05:12:54','2021-03-01 05:12:54'),(2734,1,'127.0.0.1','Login',NULL,0,0,'2021-03-02 00:12:47','2021-03-02 00:12:47'),(2735,1,'127.0.0.1','Login',NULL,0,0,'2021-03-02 01:15:48','2021-03-02 01:15:48'),(2736,1,'127.0.0.1','Login',NULL,0,0,'2021-03-02 03:15:24','2021-03-02 03:15:24'),(2737,10,'127.0.0.1','Login',NULL,0,0,'2021-03-03 03:55:03','2021-03-03 03:55:03'),(2738,1,'127.0.0.1','Login',NULL,0,0,'2021-03-03 04:04:16','2021-03-03 04:04:16'),(2739,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-03 04:04:21','2021-03-03 04:04:21'),(2740,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-03 04:04:26','2021-03-03 04:04:26'),(2741,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-03 04:04:27','2021-03-03 04:04:27'),(2742,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-03-03 04:04:44','2021-03-03 04:04:44'),(2743,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-03-03 04:05:09','2021-03-03 04:05:09'),(2744,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-03 04:05:15','2021-03-03 04:05:15'),(2745,1,'127.0.0.1','User List',NULL,0,0,'2021-03-03 04:05:16','2021-03-03 04:05:16'),(2746,1,'127.0.0.1','User View',NULL,0,0,'2021-03-03 04:05:23','2021-03-03 04:05:23'),(2747,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-03 04:05:39','2021-03-03 04:05:39'),(2748,1,'127.0.0.1','User List',NULL,0,0,'2021-03-03 04:05:41','2021-03-03 04:05:41'),(2749,1,'127.0.0.1','User View',NULL,0,0,'2021-03-03 04:14:18','2021-03-03 04:14:18'),(2750,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-03 04:14:33','2021-03-03 04:14:33'),(2751,1,'127.0.0.1','User List',NULL,0,0,'2021-03-03 04:14:34','2021-03-03 04:14:34'),(2752,1,'127.0.0.1','Login',NULL,0,0,'2021-03-07 23:30:42','2021-03-07 23:30:42'),(2753,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-07 23:31:04','2021-03-07 23:31:04'),(2754,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-07 23:31:44','2021-03-07 23:31:44'),(2755,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-07 23:31:45','2021-03-07 23:31:45'),(2756,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:20:57','2021-03-08 00:20:57'),(2757,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:20:58','2021-03-08 00:20:58'),(2758,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:21:01','2021-03-08 00:21:01'),(2759,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:21:01','2021-03-08 00:21:01'),(2760,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:23:59','2021-03-08 00:23:59'),(2761,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:23:59','2021-03-08 00:23:59'),(2762,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:24:58','2021-03-08 00:24:58'),(2763,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:24:59','2021-03-08 00:24:59'),(2764,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:25:12','2021-03-08 00:25:12'),(2765,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:25:12','2021-03-08 00:25:12'),(2766,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:27:53','2021-03-08 00:27:53'),(2767,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:27:54','2021-03-08 00:27:54'),(2768,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:28:16','2021-03-08 00:28:16'),(2769,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:28:17','2021-03-08 00:28:17'),(2770,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-08 00:28:34','2021-03-08 00:28:34'),(2771,1,'127.0.0.1','User List',NULL,0,0,'2021-03-08 00:28:36','2021-03-08 00:28:36'),(2772,1,'127.0.0.1','User View',NULL,0,0,'2021-03-08 00:28:39','2021-03-08 00:28:39'),(2773,1,'127.0.0.1','User View',NULL,0,0,'2021-03-08 00:29:22','2021-03-08 00:29:22'),(2774,1,'127.0.0.1','User View',NULL,0,0,'2021-03-08 00:30:07','2021-03-08 00:30:07'),(2775,1,'127.0.0.1','User View',NULL,0,0,'2021-03-08 00:30:15','2021-03-08 00:30:15'),(2776,9,'127.0.0.1','Login',NULL,0,0,'2021-03-08 00:34:36','2021-03-08 00:34:36'),(2777,1,'127.0.0.1','Login',NULL,0,0,'2021-03-08 00:36:06','2021-03-08 00:36:06'),(2778,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-08 00:36:13','2021-03-08 00:36:13'),(2779,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:36:17','2021-03-08 00:36:17'),(2780,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:36:17','2021-03-08 00:36:17'),(2781,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:36:59','2021-03-08 00:36:59'),(2782,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:36:59','2021-03-08 00:36:59'),(2783,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:37:13','2021-03-08 00:37:13'),(2784,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:37:14','2021-03-08 00:37:14'),(2785,6,'127.0.0.1','Login',NULL,0,0,'2021-03-08 00:37:49','2021-03-08 00:37:49'),(2786,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-08 00:45:22','2021-03-08 00:45:22'),(2787,1,'127.0.0.1','User List',NULL,0,0,'2021-03-08 00:45:25','2021-03-08 00:45:25'),(2788,1,'127.0.0.1','User View',NULL,0,0,'2021-03-08 00:46:04','2021-03-08 00:46:04'),(2789,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-08 00:47:40','2021-03-08 00:47:40'),(2790,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:47:45','2021-03-08 00:47:45'),(2791,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:47:45','2021-03-08 00:47:45'),(2792,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-08 00:49:12','2021-03-08 00:49:12'),(2793,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:49:18','2021-03-08 00:49:18'),(2794,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:49:18','2021-03-08 00:49:18'),(2795,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:55:30','2021-03-08 00:55:30'),(2796,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:55:30','2021-03-08 00:55:30'),(2797,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 00:56:11','2021-03-08 00:56:11'),(2798,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 00:56:12','2021-03-08 00:56:12'),(2799,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-03-08 00:59:37','2021-03-08 00:59:37'),(2800,10,'127.0.0.1','Login',NULL,0,0,'2021-03-08 01:06:48','2021-03-08 01:06:48'),(2801,10,'127.0.0.1','Generated Receipt of Actual detail reference id 44031f50-9e3b-4d27-af4f-300ecb310018','mfp_procurement_tribal_detail_form',0,0,'2021-03-08 01:52:25','2021-03-08 01:52:25'),(2802,10,'127.0.0.1','Generated Receipt of Actual detail reference id 44031f50-9e3b-4d27-af4f-300ecb310018','mfp_procurement_tribal_detail_form',0,0,'2021-03-08 01:54:25','2021-03-08 01:54:25'),(2803,6,'127.0.0.1','Login',NULL,0,0,'2021-03-08 02:02:50','2021-03-08 02:02:50'),(2804,6,'127.0.0.1','Fund release Rs.0.0619 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-03-08 02:07:54','2021-03-08 02:07:54'),(2805,6,'127.0.0.1','Fund release Rs.0.0613 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-03-08 02:13:35','2021-03-08 02:13:35'),(2806,6,'127.0.0.1','Fund release Rs.0.0607 of consolidation id 23_40','mfp_procurement_fund_release',0,0,'2021-03-08 02:18:31','2021-03-08 02:18:31'),(2807,2,'127.0.0.1','Login',NULL,0,0,'2021-03-08 07:36:09','2021-03-08 07:36:09'),(2808,1,'127.0.0.1','Login',NULL,0,0,'2021-03-08 07:36:36','2021-03-08 07:36:36'),(2809,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-08 07:36:43','2021-03-08 07:36:43'),(2810,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-08 07:36:48','2021-03-08 07:36:48'),(2811,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-08 07:36:49','2021-03-08 07:36:49'),(2812,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-08 07:36:59','2021-03-08 07:36:59'),(2813,1,'127.0.0.1','User List',NULL,0,0,'2021-03-08 07:37:00','2021-03-08 07:37:00'),(2814,1,'127.0.0.1','User List',NULL,0,0,'2021-03-08 07:37:06','2021-03-08 07:37:06'),(2815,1,'127.0.0.1','User View',NULL,0,0,'2021-03-08 07:37:10','2021-03-08 07:37:10'),(2816,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-08 07:37:25','2021-03-08 07:37:25'),(2817,2,'127.0.0.1','Login',NULL,0,0,'2021-03-08 07:38:02','2021-03-08 07:38:02'),(2818,2,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-08 07:38:08','2021-03-08 07:38:08'),(2819,2,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-08 07:38:16','2021-03-08 07:38:16'),(2820,10,'127.0.0.1','Login',NULL,0,0,'2021-03-09 06:25:11','2021-03-09 06:25:11'),(2821,10,'127.0.0.1','Login',NULL,0,0,'2021-03-10 03:50:50','2021-03-10 03:50:50'),(2822,2,'127.0.0.1','Login',NULL,0,0,'2021-03-10 05:35:29','2021-03-10 05:35:29'),(2823,2,'127.0.0.1','Login',NULL,0,0,'2021-03-10 07:01:53','2021-03-10 07:01:53'),(2824,2,'127.0.0.1','Login',NULL,0,0,'2021-03-11 23:13:12','2021-03-11 23:13:12'),(2825,2,'127.0.0.1','Login',NULL,0,0,'2021-03-12 01:53:42','2021-03-12 01:53:42'),(2826,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000050','mfp_procurement',0,0,'2021-03-12 02:00:44','2021-03-12 02:00:44'),(2827,3,'127.0.0.1','Login',NULL,0,0,'2021-03-12 02:01:26','2021-03-12 02:01:26'),(2828,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-03-12 02:02:10','2021-03-12 02:02:10'),(2829,3,'127.0.0.1','approved Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-03-12 02:02:11','2021-03-12 02:02:11'),(2830,4,'127.0.0.1','Login',NULL,0,0,'2021-03-12 02:02:35','2021-03-12 02:02:35'),(2831,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-03-12 02:03:02','2021-03-12 02:03:02'),(2832,4,'127.0.0.1','approved Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-03-12 02:03:03','2021-03-12 02:03:03'),(2833,4,'127.0.0.1','Login',NULL,0,0,'2021-03-12 02:03:30','2021-03-12 02:03:30'),(2834,2,'127.0.0.1','Login',NULL,0,0,'2021-03-12 02:58:50','2021-03-12 02:58:50'),(2835,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000051','mfp_procurement',0,0,'2021-03-12 03:02:52','2021-03-12 03:02:52'),(2836,2,'127.0.0.1','Login',NULL,0,0,'2021-03-12 03:22:05','2021-03-12 03:22:05'),(2837,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000052','mfp_procurement',0,0,'2021-03-12 03:28:44','2021-03-12 03:28:44'),(2838,2,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:10:17','2021-03-12 04:10:17'),(2839,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000053','mfp_procurement',0,0,'2021-03-12 04:15:22','2021-03-12 04:15:22'),(2840,3,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:16:39','2021-03-12 04:16:39'),(2841,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:17:19','2021-03-12 04:17:19'),(2842,3,'127.0.0.1','approved Mfp procurement proposal id - 23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:17:22','2021-03-12 04:17:22'),(2843,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:17:40','2021-03-12 04:17:40'),(2844,3,'127.0.0.1','approved Mfp procurement proposal id - 23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:17:41','2021-03-12 04:17:41'),(2845,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000052','mfp_procurement_aproval',0,0,'2021-03-12 04:17:57','2021-03-12 04:17:57'),(2846,3,'127.0.0.1','approved Mfp procurement proposal id - 23000052','mfp_procurement_aproval',0,0,'2021-03-12 04:17:57','2021-03-12 04:17:57'),(2847,4,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:18:22','2021-03-12 04:18:22'),(2848,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:18:46','2021-03-12 04:18:46'),(2849,4,'127.0.0.1','approved Mfp procurement proposal id - 23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:18:46','2021-03-12 04:18:46'),(2850,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:19:06','2021-03-12 04:19:06'),(2851,4,'127.0.0.1','approved Mfp procurement proposal id - 23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:19:07','2021-03-12 04:19:07'),(2852,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000052','mfp_procurement_aproval',0,0,'2021-03-12 04:19:25','2021-03-12 04:19:25'),(2853,4,'127.0.0.1','approved Mfp procurement proposal id - 23000052','mfp_procurement_aproval',0,0,'2021-03-12 04:19:25','2021-03-12 04:19:25'),(2854,5,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:19:50','2021-03-12 04:19:50'),(2855,2,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:20:17','2021-03-12 04:20:17'),(2856,13,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:21:03','2021-03-12 04:21:03'),(2857,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:21:26','2021-03-12 04:21:26'),(2858,13,'127.0.0.1','approved Mfp procurement proposal id - 23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:21:27','2021-03-12 04:21:27'),(2859,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:21:41','2021-03-12 04:21:41'),(2860,13,'127.0.0.1','approved Mfp procurement proposal id - 23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:21:42','2021-03-12 04:21:42'),(2861,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000052','mfp_procurement_aproval',0,0,'2021-03-12 04:21:58','2021-03-12 04:21:58'),(2862,13,'127.0.0.1','approved Mfp procurement proposal id - 23000052','mfp_procurement_aproval',0,0,'2021-03-12 04:21:58','2021-03-12 04:21:58'),(2863,5,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:22:50','2021-03-12 04:22:50'),(2864,5,'127.0.0.1','approved Mfp procurement proposal id - 23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:23:11','2021-03-12 04:23:11'),(2865,5,'127.0.0.1','approved Mfp procurement proposal id - 23000052','mfp_procurement_aproval',0,0,'2021-03-12 04:23:24','2021-03-12 04:23:24'),(2866,5,'127.0.0.1','approved Mfp procurement proposal id - 23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:23:37','2021-03-12 04:23:37'),(2867,5,'127.0.0.1','Proposal consolidated into 23_44 of proposal ids - 23000053,23000052,23000051','mfp_procurement_aproval',0,0,'2021-03-12 04:23:50','2021-03-12 04:23:50'),(2868,6,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:24:45','2021-03-12 04:24:45'),(2869,6,'127.0.0.1','Approved Mfp procurement proposal ids - 23000051,23000052,23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:25:06','2021-03-12 04:25:06'),(2870,6,'127.0.0.1','Proposal id 23000051 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-03-12 04:25:42','2021-03-12 04:25:42'),(2871,6,'127.0.0.1','Proposal id 23000052 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-03-12 04:25:43','2021-03-12 04:25:43'),(2872,6,'127.0.0.1','Proposal id 23000053 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-03-12 04:25:43','2021-03-12 04:25:43'),(2873,8,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:29:42','2021-03-12 04:29:42'),(2874,8,'127.0.0.1','Approved Mfp procurement proposal ids - 23000051,23000052,23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:30:58','2021-03-12 04:30:58'),(2875,8,'127.0.0.1','Proposal id 23000051 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-12 04:31:51','2021-03-12 04:31:51'),(2876,8,'127.0.0.1','Proposal id 23000052 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-12 04:31:51','2021-03-12 04:31:51'),(2877,8,'127.0.0.1','Proposal id 23000053 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-12 04:31:51','2021-03-12 04:31:51'),(2878,9,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:32:21','2021-03-12 04:32:21'),(2879,9,'127.0.0.1','Approved Mfp procurement proposal ids - 23000051,23000052,23000053','mfp_procurement_aproval',0,0,'2021-03-12 04:32:47','2021-03-12 04:32:47'),(2880,9,'127.0.0.1','Sanction Rs.825000 of consolidation id 23_44','mfp_procurement_fund_sanctioned',0,0,'2021-03-12 04:33:56','2021-03-12 04:33:56'),(2881,8,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:34:24','2021-03-12 04:34:24'),(2882,8,'127.0.0.1','Sanction Rs.275000.0000 of consolidation id 23_44','mfp_procurement_fund_sanctioned',0,0,'2021-03-12 04:35:12','2021-03-12 04:35:12'),(2883,8,'127.0.0.1','Fund release Rs.1100000.0000 of consolidation id 23_44','mfp_procurement_fund_release',0,0,'2021-03-12 04:37:47','2021-03-12 04:37:47'),(2884,6,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:38:48','2021-03-12 04:38:48'),(2885,6,'127.0.0.1','Fund release Rs.1100000.0000 of consolidation id 23_44','mfp_procurement_fund_release',0,0,'2021-03-12 04:40:50','2021-03-12 04:40:50'),(2886,2,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:41:30','2021-03-12 04:41:30'),(2887,2,'127.0.0.1','Fund release by DIA of Rs.200000 of proposal id 23000053 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-03-12 04:45:09','2021-03-12 04:45:09'),(2888,10,'127.0.0.1','Login',NULL,0,0,'2021-03-12 04:58:29','2021-03-12 04:58:29'),(2889,10,'127.0.0.1','added tribal detail form of reference number 899f52e3-fece-4a88-803f-a704dfd8aa40','mfp_procurement_tribal_detail_form',0,0,'2021-03-12 04:59:41','2021-03-12 04:59:41'),(2890,10,'127.0.0.1','Generated Receipt of Actual detail reference id 899f52e3-fece-4a88-803f-a704dfd8aa40','mfp_procurement_tribal_detail_form',0,0,'2021-03-12 05:00:03','2021-03-12 05:00:03'),(2891,9,'127.0.0.1','Login',NULL,0,0,'2021-03-12 05:57:43','2021-03-12 05:57:43'),(2892,9,'127.0.0.1','Sanction Rs.281684.84 of consolidation id 23_40','mfp_procurement_fund_sanctioned',0,0,'2021-03-12 05:58:14','2021-03-12 05:58:14'),(2893,1,'127.0.0.1','Login',NULL,0,0,'2021-03-15 22:55:46','2021-03-15 22:55:46'),(2894,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-15 23:00:17','2021-03-15 23:00:17'),(2895,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-15 23:03:25','2021-03-15 23:03:25'),(2896,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-15 23:04:51','2021-03-15 23:04:51'),(2897,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-15 23:04:56','2021-03-15 23:04:56'),(2898,1,'127.0.0.1','User List',NULL,0,0,'2021-03-15 23:04:58','2021-03-15 23:04:58'),(2899,9,'127.0.0.1','Login',NULL,0,0,'2021-03-16 07:21:16','2021-03-16 07:21:16'),(2900,2,'127.0.0.1','Login',NULL,0,0,'2021-03-16 07:25:06','2021-03-16 07:25:06'),(2901,9,'127.0.0.1','Login',NULL,0,0,'2021-03-16 07:26:55','2021-03-16 07:26:55'),(2902,2,'127.0.0.1','Login',NULL,0,0,'2021-03-16 07:36:45','2021-03-16 07:36:45'),(2903,8,'127.0.0.1','Login',NULL,0,0,'2021-03-16 23:51:30','2021-03-16 23:51:30'),(2904,8,'127.0.0.1','Proposal id 23000042 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-16 23:55:31','2021-03-16 23:55:31'),(2905,8,'127.0.0.1','Proposal id 23000044 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-16 23:55:34','2021-03-16 23:55:34'),(2906,2,'127.0.0.1','Login',NULL,0,0,'2021-03-16 23:56:01','2021-03-16 23:56:01'),(2907,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000054','mfp_procurement',0,0,'2021-03-16 23:58:49','2021-03-16 23:58:49'),(2908,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000055','mfp_procurement',0,0,'2021-03-17 00:01:19','2021-03-17 00:01:19'),(2909,3,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:01:52','2021-03-17 00:01:52'),(2910,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:03:24','2021-03-17 00:03:24'),(2911,3,'127.0.0.1','approved Mfp procurement proposal id - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:03:24','2021-03-17 00:03:24'),(2912,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:03:41','2021-03-17 00:03:41'),(2913,3,'127.0.0.1','approved Mfp procurement proposal id - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:03:42','2021-03-17 00:03:42'),(2914,4,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:04:08','2021-03-17 00:04:08'),(2915,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:04:43','2021-03-17 00:04:43'),(2916,4,'127.0.0.1','approved Mfp procurement proposal id - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:04:44','2021-03-17 00:04:44'),(2917,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:05:03','2021-03-17 00:05:03'),(2918,4,'127.0.0.1','approved Mfp procurement proposal id - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:05:04','2021-03-17 00:05:04'),(2919,5,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:05:35','2021-03-17 00:05:35'),(2920,4,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:06:04','2021-03-17 00:06:04'),(2921,13,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:06:45','2021-03-17 00:06:45'),(2922,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:07:08','2021-03-17 00:07:08'),(2923,13,'127.0.0.1','approved Mfp procurement proposal id - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:07:09','2021-03-17 00:07:09'),(2924,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:07:28','2021-03-17 00:07:28'),(2925,13,'127.0.0.1','approved Mfp procurement proposal id - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:07:28','2021-03-17 00:07:28'),(2926,5,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:07:58','2021-03-17 00:07:58'),(2927,5,'127.0.0.1','Revert Mfp procurement proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-03-17 00:08:29','2021-03-17 00:08:29'),(2928,5,'127.0.0.1','approved Mfp procurement proposal id - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:09:59','2021-03-17 00:09:59'),(2929,5,'127.0.0.1','approved Mfp procurement proposal id - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:10:16','2021-03-17 00:10:16'),(2930,5,'127.0.0.1','Proposal consolidated into 23_45 of proposal ids - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:10:28','2021-03-17 00:10:28'),(2931,5,'127.0.0.1','Proposal consolidated into 23_46 of proposal ids - 23000054','mfp_procurement_aproval',0,0,'2021-03-17 00:10:40','2021-03-17 00:10:40'),(2932,6,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:11:12','2021-03-17 00:11:12'),(2933,6,'127.0.0.1','Proposal consolidated into 23_46 of proposal ids - 23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:11:35','2021-03-17 00:11:35'),(2934,6,'127.0.0.1','Proposal id 23000054 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-03-17 00:11:51','2021-03-17 00:11:51'),(2935,6,'127.0.0.1','Proposal id 23000055 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-03-17 00:11:52','2021-03-17 00:11:52'),(2936,6,'127.0.0.1','Approved Mfp procurement proposal ids - 23000054,23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:11:52','2021-03-17 00:11:52'),(2937,8,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:12:57','2021-03-17 00:12:57'),(2938,8,'127.0.0.1','Proposal id 23000054 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-17 00:13:25','2021-03-17 00:13:25'),(2939,8,'127.0.0.1','Proposal id 23000055 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-17 00:13:26','2021-03-17 00:13:26'),(2940,8,'127.0.0.1','Approved Mfp procurement proposal ids - 23000054,23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:13:26','2021-03-17 00:13:26'),(2941,9,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:13:54','2021-03-17 00:13:54'),(2942,9,'127.0.0.1','Proposal consolidated into 23_46 of proposal ids - 23000042,23000044','mfp_procurement_aproval',0,0,'2021-03-17 00:14:13','2021-03-17 00:14:13'),(2943,9,'127.0.0.1','Approved Mfp procurement proposal ids - 23000042,23000044,23000054,23000055','mfp_procurement_aproval',0,0,'2021-03-17 00:21:51','2021-03-17 00:21:51'),(2944,2,'127.0.0.1','Login',NULL,0,0,'2021-03-17 00:37:52','2021-03-17 00:37:52'),(2945,9,'127.0.0.1','Login',NULL,0,0,'2021-03-17 03:42:07','2021-03-17 03:42:07'),(2946,8,'127.0.0.1','Login',NULL,0,0,'2021-03-17 03:43:02','2021-03-17 03:43:02'),(2947,8,'127.0.0.1','Login',NULL,0,0,'2021-03-17 06:00:01','2021-03-17 06:00:01'),(2948,2,'127.0.0.1','Login',NULL,0,0,'2021-03-17 07:38:20','2021-03-17 07:38:20'),(2949,2,'127.0.0.1','Login',NULL,0,0,'2021-03-17 23:00:04','2021-03-17 23:00:04'),(2950,10,'127.0.0.1','Login',NULL,0,0,'2021-03-17 23:12:51','2021-03-17 23:12:51'),(2951,6,'127.0.0.1','Login',NULL,0,0,'2021-03-17 23:31:39','2021-03-17 23:31:39'),(2952,9,'127.0.0.1','Login',NULL,0,0,'2021-03-17 23:41:23','2021-03-17 23:41:23'),(2953,8,'127.0.0.1','Login',NULL,0,0,'2021-03-17 23:49:30','2021-03-17 23:49:30'),(2954,8,'127.0.0.1','Login',NULL,0,0,'2021-03-18 00:50:18','2021-03-18 00:50:18'),(2955,9,'127.0.0.1','Login',NULL,0,0,'2021-03-18 01:51:43','2021-03-18 01:51:43'),(2956,4,'127.0.0.1','Login',NULL,0,0,'2021-03-18 02:17:52','2021-03-18 02:17:52'),(2957,2,'127.0.0.1','Login',NULL,0,0,'2021-03-18 03:22:13','2021-03-18 03:22:13'),(2958,2,'127.0.0.1','Login',NULL,0,0,'2021-03-18 04:24:39','2021-03-18 04:24:39'),(2959,2,'127.0.0.1','Login',NULL,0,0,'2021-03-18 05:50:29','2021-03-18 05:50:29'),(2960,9,'127.0.0.1','Login',NULL,0,0,'2021-03-18 07:34:36','2021-03-18 07:34:36'),(2961,2,'127.0.0.1','Login',NULL,0,0,'2021-03-18 23:11:06','2021-03-18 23:11:06'),(2962,2,'127.0.0.1','Login',NULL,0,0,'2021-03-21 23:01:20','2021-03-21 23:01:20'),(2963,10,'127.0.0.1','Login',NULL,0,0,'2021-03-21 23:49:59','2021-03-21 23:49:59'),(2964,10,'127.0.0.1','Login',NULL,0,0,'2021-03-22 00:49:35','2021-03-22 00:49:35'),(2965,10,'127.0.0.1','Login',NULL,0,0,'2021-03-22 03:02:12','2021-03-22 03:02:12'),(2966,10,'127.0.0.1','Year List',NULL,0,0,'2021-03-22 06:09:23','2021-03-22 06:09:23'),(2967,10,'127.0.0.1','added tribal detail form of reference number 898d574f-eadd-4b55-a3c4-9cb441f8cf3b','mfp_procurement_tribal_detail_form',0,0,'2021-03-22 06:20:24','2021-03-22 06:20:24'),(2968,10,'127.0.0.1','Login',NULL,0,0,'2021-03-22 07:32:14','2021-03-22 07:32:14'),(2969,10,'127.0.0.1','added tribal detail form of reference number 50504a31-136f-422e-a88c-6a87db72092e','mfp_procurement_tribal_detail_form',0,0,'2021-03-22 07:36:13','2021-03-22 07:36:13'),(2970,10,'127.0.0.1','Login',NULL,0,0,'2021-03-22 23:05:16','2021-03-22 23:05:16'),(2971,10,'127.0.0.1','Generated Receipt of Actual detail reference id 50504a31-136f-422e-a88c-6a87db72092e','mfp_procurement_tribal_detail_form',0,0,'2021-03-22 23:32:15','2021-03-22 23:32:15'),(2972,10,'127.0.0.1','Generated Receipt of Actual detail reference id 898d574f-eadd-4b55-a3c4-9cb441f8cf3b','mfp_procurement_tribal_detail_form',0,0,'2021-03-22 23:36:56','2021-03-22 23:36:56'),(2973,10,'127.0.0.1','Login',NULL,0,0,'2021-03-23 00:29:51','2021-03-23 00:29:51'),(2974,10,'127.0.0.1','Login',NULL,0,0,'2021-03-23 05:40:28','2021-03-23 05:40:28'),(2975,10,'127.0.0.1','Login',NULL,0,0,'2021-03-23 06:50:11','2021-03-23 06:50:11'),(2976,10,'127.0.0.1','Login',NULL,0,0,'2021-03-24 22:41:23','2021-03-24 22:41:23'),(2977,2,'127.0.0.1','Login',NULL,0,0,'2021-03-24 22:58:03','2021-03-24 22:58:03'),(2978,10,'127.0.0.1','Login',NULL,0,0,'2021-03-24 22:58:29','2021-03-24 22:58:29'),(2979,2,'127.0.0.1','Login',NULL,0,0,'2021-03-24 22:58:48','2021-03-24 22:58:48'),(2980,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000057','mfp_procurement',0,0,'2021-03-24 23:02:41','2021-03-24 23:02:41'),(2981,3,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:03:15','2021-03-24 23:03:15'),(2982,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:06:52','2021-03-24 23:06:52'),(2983,3,'127.0.0.1','approved Mfp procurement proposal id - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:06:52','2021-03-24 23:06:52'),(2984,4,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:07:34','2021-03-24 23:07:34'),(2985,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:07:56','2021-03-24 23:07:56'),(2986,4,'127.0.0.1','approved Mfp procurement proposal id - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:07:57','2021-03-24 23:07:57'),(2987,5,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:08:28','2021-03-24 23:08:28'),(2988,13,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:09:42','2021-03-24 23:09:42'),(2989,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:10:12','2021-03-24 23:10:12'),(2990,13,'127.0.0.1','approved Mfp procurement proposal id - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:10:12','2021-03-24 23:10:12'),(2991,6,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:10:46','2021-03-24 23:10:46'),(2992,13,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:11:54','2021-03-24 23:11:54'),(2993,5,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:15:50','2021-03-24 23:15:50'),(2994,5,'127.0.0.1','approved Mfp procurement proposal id - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:16:06','2021-03-24 23:16:06'),(2995,5,'127.0.0.1','Proposal consolidated into 23_47 of proposal ids - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:16:26','2021-03-24 23:16:26'),(2996,6,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:16:50','2021-03-24 23:16:50'),(2997,6,'127.0.0.1','Proposal id 23000057 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-03-24 23:17:09','2021-03-24 23:17:09'),(2998,6,'127.0.0.1','Approved Mfp procurement proposal ids - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:17:10','2021-03-24 23:17:10'),(2999,8,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:17:45','2021-03-24 23:17:45'),(3000,8,'127.0.0.1','Proposal id 23000057 assigned to ministry','mfp_procurement_aproval',0,0,'2021-03-24 23:18:07','2021-03-24 23:18:07'),(3001,8,'127.0.0.1','Approved Mfp procurement proposal ids - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:18:08','2021-03-24 23:18:08'),(3002,9,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:18:30','2021-03-24 23:18:30'),(3003,9,'127.0.0.1','Approved Mfp procurement proposal ids - 23000057','mfp_procurement_aproval',0,0,'2021-03-24 23:18:55','2021-03-24 23:18:55'),(3004,9,'127.0.0.1','Sanction Rs.225161.3288 of consolidation id 23_47','mfp_procurement_fund_sanctioned',0,0,'2021-03-24 23:27:42','2021-03-24 23:27:42'),(3005,8,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:28:06','2021-03-24 23:28:06'),(3006,8,'127.0.0.1','Sanction Rs.75053.7762 of consolidation id 23_47','mfp_procurement_fund_sanctioned',0,0,'2021-03-24 23:28:29','2021-03-24 23:28:29'),(3007,8,'127.0.0.1','Sanction Rs.0.0001 of consolidation id 23_47','mfp_procurement_fund_sanctioned',0,0,'2021-03-24 23:29:48','2021-03-24 23:29:48'),(3008,10,'127.0.0.1','Login',NULL,0,0,'2021-03-24 23:30:13','2021-03-24 23:30:13'),(3009,8,'127.0.0.1','Login',NULL,0,0,'2021-03-25 00:06:23','2021-03-25 00:06:23'),(3010,8,'127.0.0.1','Fund release Rs.300215.1051 of consolidation id 23_47','mfp_procurement_fund_release',0,0,'2021-03-25 00:06:47','2021-03-25 00:06:47'),(3011,6,'127.0.0.1','Login',NULL,0,0,'2021-03-25 00:07:39','2021-03-25 00:07:39'),(3012,6,'127.0.0.1','Fund release Rs.300215.1051 of consolidation id 23_47','mfp_procurement_fund_release',0,0,'2021-03-25 00:08:06','2021-03-25 00:08:06'),(3013,2,'127.0.0.1','Login',NULL,0,0,'2021-03-25 00:08:41','2021-03-25 00:08:41'),(3014,2,'127.0.0.1','Fund release by DIA of Rs.50000 of proposal id 23000057 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-03-25 00:09:40','2021-03-25 00:09:40'),(3015,10,'127.0.0.1','Login',NULL,0,0,'2021-03-25 00:26:43','2021-03-25 00:26:43'),(3016,10,'127.0.0.1','added tribal detail form of reference number e88b7630-6e35-4aee-b057-83d2d728e4b2','mfp_procurement_tribal_detail_form',0,0,'2021-03-25 00:27:31','2021-03-25 00:27:31'),(3017,10,'127.0.0.1','Generated Receipt of Actual detail reference id e88b7630-6e35-4aee-b057-83d2d728e4b2','mfp_procurement_tribal_detail_form',0,0,'2021-03-25 00:27:47','2021-03-25 00:27:47'),(3018,10,'127.0.0.1','Login',NULL,0,0,'2021-03-25 06:06:06','2021-03-25 06:06:06'),(3019,10,'127.0.0.1','Year List',NULL,0,0,'2021-03-25 06:07:42','2021-03-25 06:07:42'),(3020,10,'127.0.0.1','Login',NULL,0,0,'2021-03-25 23:37:16','2021-03-25 23:37:16'),(3021,7,'127.0.0.1','Login',NULL,0,0,'2021-03-26 04:08:52','2021-03-26 04:08:52'),(3022,7,'127.0.0.1','Added auction committe members of reference number -456321','auction',0,0,'2021-03-26 04:09:34','2021-03-26 04:09:34'),(3023,7,'127.0.0.1','Added auction committe members of reference number -654456','auction',0,0,'2021-03-26 04:10:14','2021-03-26 04:10:14'),(3024,5,'127.0.0.1','Login',NULL,0,0,'2021-03-26 04:11:02','2021-03-26 04:11:02'),(3025,1,'127.0.0.1','Login',NULL,0,0,'2021-03-26 04:12:16','2021-03-26 04:12:16'),(3026,1,'127.0.0.1','User Role',NULL,0,0,'2021-03-26 04:12:22','2021-03-26 04:12:22'),(3027,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-03-26 04:12:27','2021-03-26 04:12:27'),(3028,1,'127.0.0.1','Role View',NULL,0,0,'2021-03-26 04:12:28','2021-03-26 04:12:28'),(3029,6,'127.0.0.1','Login',NULL,0,0,'2021-03-26 04:12:42','2021-03-26 04:12:42'),(3030,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-03-26 04:13:04','2021-03-26 04:13:04'),(3031,6,'127.0.0.1','Login',NULL,0,0,'2021-03-26 04:13:38','2021-03-26 04:13:38'),(3032,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-26 04:17:43','2021-03-26 04:17:43'),(3033,1,'127.0.0.1','User List',NULL,0,0,'2021-03-26 04:17:44','2021-03-26 04:17:44'),(3034,1,'127.0.0.1','User List',NULL,0,0,'2021-03-26 04:17:49','2021-03-26 04:17:49'),(3035,1,'127.0.0.1','User View',NULL,0,0,'2021-03-26 04:17:54','2021-03-26 04:17:54'),(3036,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-03-26 04:18:07','2021-03-26 04:18:07'),(3037,1,'127.0.0.1','User List',NULL,0,0,'2021-03-26 04:18:08','2021-03-26 04:18:08'),(3038,1,'127.0.0.1','User List',NULL,0,0,'2021-03-26 04:18:11','2021-03-26 04:18:11'),(3039,10,'127.0.0.1','Login',NULL,0,0,'2021-03-30 00:09:28','2021-03-30 00:09:28'),(3040,10,'127.0.0.1','Login',NULL,0,0,'2021-03-30 03:22:29','2021-03-30 03:22:29'),(3041,2,'127.0.0.1','Login',NULL,0,0,'2021-03-30 03:31:51','2021-03-30 03:31:51'),(3042,10,'127.0.0.1','Login',NULL,0,0,'2021-03-30 03:52:34','2021-03-30 03:52:34'),(3043,10,'127.0.0.1','Login',NULL,0,0,'2021-03-30 06:27:07','2021-03-30 06:27:07'),(3044,10,'127.0.0.1','added tribal detail form of reference number 99063584-26ae-415a-bc8e-a8d319673704','mfp_procurement_tribal_detail_form',0,0,'2021-03-30 07:23:17','2021-03-30 07:23:17'),(3045,2,'127.0.0.1','Login',NULL,0,0,'2021-03-31 05:00:19','2021-03-31 05:00:19'),(3046,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000056','mfp_procurement',0,0,'2021-03-31 05:06:18','2021-03-31 05:06:18'),(3047,2,'127.0.0.1','Login',NULL,0,0,'2021-04-05 01:17:05','2021-04-05 01:17:05'),(3048,2,'127.0.0.1','Login',NULL,0,0,'2021-04-05 03:09:46','2021-04-05 03:09:46'),(3049,2,'127.0.0.1','Login',NULL,0,0,'2021-04-05 03:52:46','2021-04-05 03:52:46'),(3050,8,'127.0.0.1','Login',NULL,0,0,'2021-04-06 00:48:09','2021-04-06 00:48:09'),(3051,0,'127.0.0.1','Login Failed With Username :dia_manipur_level3',NULL,0,0,'2021-04-06 00:48:44','2021-04-06 00:48:44'),(3052,13,'127.0.0.1','Login',NULL,0,0,'2021-04-06 00:48:51','2021-04-06 00:48:51'),(3053,13,'127.0.0.1','Revert Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-04-06 00:55:48','2021-04-06 00:55:48'),(3054,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-04-06 00:56:42','2021-04-06 00:56:42'),(3055,13,'127.0.0.1','approved Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-04-06 00:56:46','2021-04-06 00:56:46'),(3056,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-04-06 00:56:55','2021-04-06 00:56:55'),(3057,13,'127.0.0.1','approved Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-04-06 00:56:56','2021-04-06 00:56:56'),(3058,13,'127.0.0.1','Revert Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-04-06 01:01:16','2021-04-06 01:01:16'),(3059,9,'127.0.0.1','Login',NULL,0,0,'2021-04-06 01:05:21','2021-04-06 01:05:21'),(3060,6,'127.0.0.1','Login',NULL,0,0,'2021-04-06 01:11:39','2021-04-06 01:11:39'),(3061,2,'127.0.0.1','Login',NULL,0,0,'2021-04-06 01:12:32','2021-04-06 01:12:32'),(3062,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000058','mfp_procurement',0,0,'2021-04-06 01:15:33','2021-04-06 01:15:33'),(3063,3,'127.0.0.1','Login',NULL,0,0,'2021-04-06 01:16:08','2021-04-06 01:16:08'),(3064,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000058','mfp_procurement_aproval',0,0,'2021-04-06 01:16:41','2021-04-06 01:16:41'),(3065,3,'127.0.0.1','approved Mfp procurement proposal id - 23000058','mfp_procurement_aproval',0,0,'2021-04-06 01:16:42','2021-04-06 01:16:42'),(3066,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-06 01:17:01','2021-04-06 01:17:01'),(3067,3,'127.0.0.1','approved Mfp procurement proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-06 01:17:02','2021-04-06 01:17:02'),(3068,4,'127.0.0.1','Login',NULL,0,0,'2021-04-06 01:17:24','2021-04-06 01:17:24'),(3069,4,'127.0.0.1','Revert Mfp procurement proposal id - 23000058','mfp_procurement_aproval',0,0,'2021-04-06 01:50:06','2021-04-06 01:50:06'),(3070,4,'127.0.0.1','Revert Mfp procurement proposal id - 23000058','mfp_procurement_aproval',0,0,'2021-04-06 01:50:48','2021-04-06 01:50:48'),(3071,4,'127.0.0.1','Revert Mfp procurement proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-06 01:51:55','2021-04-06 01:51:55'),(3072,3,'127.0.0.1','Login',NULL,0,0,'2021-04-06 02:02:39','2021-04-06 02:02:39'),(3073,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000058','mfp_procurement_aproval',0,0,'2021-04-06 02:03:43','2021-04-06 02:03:43'),(3074,3,'127.0.0.1','approved Mfp procurement proposal id - 23000058','mfp_procurement_aproval',0,0,'2021-04-06 02:03:43','2021-04-06 02:03:43'),(3075,3,'127.0.0.1','Login',NULL,0,0,'2021-04-07 03:42:21','2021-04-07 03:42:21'),(3076,3,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000059','mfp_procurement',0,0,'2021-04-07 03:55:23','2021-04-07 03:55:23'),(3077,9,'127.0.0.1','Login',NULL,0,0,'2021-04-07 05:17:38','2021-04-07 05:17:38'),(3078,2,'127.0.0.1','Login',NULL,0,0,'2021-04-07 06:39:50','2021-04-07 06:39:50'),(3079,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000060','mfp_procurement',0,0,'2021-04-07 06:51:27','2021-04-07 06:51:27'),(3080,3,'127.0.0.1','Login',NULL,0,0,'2021-04-07 06:52:44','2021-04-07 06:52:44'),(3081,3,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000061','mfp_procurement',0,0,'2021-04-07 06:55:59','2021-04-07 06:55:59'),(3082,4,'127.0.0.1','Login',NULL,0,0,'2021-04-07 06:57:01','2021-04-07 06:57:01'),(3083,2,'127.0.0.1','Login',NULL,0,0,'2021-04-07 06:57:32','2021-04-07 06:57:32'),(3084,3,'127.0.0.1','Login',NULL,0,0,'2021-04-07 06:58:03','2021-04-07 06:58:03'),(3085,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000060','mfp_procurement_aproval',0,0,'2021-04-07 06:58:40','2021-04-07 06:58:40'),(3086,3,'127.0.0.1','approved Mfp procurement proposal id - 23000060','mfp_procurement_aproval',0,0,'2021-04-07 06:58:41','2021-04-07 06:58:41'),(3087,4,'127.0.0.1','Login',NULL,0,0,'2021-04-07 06:59:00','2021-04-07 06:59:00'),(3088,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000061','mfp_procurement_aproval',0,0,'2021-04-07 06:59:29','2021-04-07 06:59:29'),(3089,4,'127.0.0.1','approved Mfp procurement proposal id - 23000061','mfp_procurement_aproval',0,0,'2021-04-07 06:59:29','2021-04-07 06:59:29'),(3090,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000060','mfp_procurement_aproval',0,0,'2021-04-07 06:59:51','2021-04-07 06:59:51'),(3091,4,'127.0.0.1','approved Mfp procurement proposal id - 23000060','mfp_procurement_aproval',0,0,'2021-04-07 06:59:52','2021-04-07 06:59:52'),(3092,13,'127.0.0.1','Login',NULL,0,0,'2021-04-07 07:00:11','2021-04-07 07:00:11'),(3093,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000061','mfp_procurement_aproval',0,0,'2021-04-07 07:00:30','2021-04-07 07:00:30'),(3094,13,'127.0.0.1','approved Mfp procurement proposal id - 23000061','mfp_procurement_aproval',0,0,'2021-04-07 07:00:34','2021-04-07 07:00:34'),(3095,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000060','mfp_procurement_aproval',0,0,'2021-04-07 07:00:53','2021-04-07 07:00:53'),(3096,13,'127.0.0.1','approved Mfp procurement proposal id - 23000060','mfp_procurement_aproval',0,0,'2021-04-07 07:00:53','2021-04-07 07:00:53'),(3097,5,'127.0.0.1','Login',NULL,0,0,'2021-04-07 07:01:14','2021-04-07 07:01:14'),(3098,5,'127.0.0.1','approved Mfp procurement proposal id - 23000061','mfp_procurement_aproval',0,0,'2021-04-07 07:01:32','2021-04-07 07:01:32'),(3099,5,'127.0.0.1','approved Mfp procurement proposal id - 23000060','mfp_procurement_aproval',0,0,'2021-04-07 07:01:47','2021-04-07 07:01:47'),(3100,5,'127.0.0.1','Proposal consolidated into 23_48 of proposal ids - 23000061,23000060','mfp_procurement_aproval',0,0,'2021-04-07 07:01:56','2021-04-07 07:01:56'),(3101,1,'127.0.0.1','Login',NULL,0,0,'2021-04-07 23:21:55','2021-04-07 23:21:55'),(3102,1,'127.0.0.1','User Role',NULL,0,0,'2021-04-07 23:22:11','2021-04-07 23:22:11'),(3103,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-04-07 23:22:19','2021-04-07 23:22:19'),(3104,1,'127.0.0.1','Role View',NULL,0,0,'2021-04-07 23:22:19','2021-04-07 23:22:19'),(3105,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-04-07 23:22:54','2021-04-07 23:22:54'),(3106,1,'127.0.0.1','Role View',NULL,0,0,'2021-04-07 23:22:55','2021-04-07 23:22:55'),(3107,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-04-07 23:23:30','2021-04-07 23:23:30'),(3108,1,'127.0.0.1','Role View',NULL,0,0,'2021-04-07 23:23:30','2021-04-07 23:23:30'),(3109,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-04-07 23:23:39','2021-04-07 23:23:39'),(3110,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-07 23:23:49','2021-04-07 23:23:49'),(3111,1,'127.0.0.1','User List',NULL,0,0,'2021-04-07 23:23:52','2021-04-07 23:23:52'),(3112,1,'127.0.0.1','User View',NULL,0,0,'2021-04-07 23:23:58','2021-04-07 23:23:58'),(3113,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-07 23:24:00','2021-04-07 23:24:00'),(3114,1,'127.0.0.1','User List',NULL,0,0,'2021-04-07 23:24:07','2021-04-07 23:24:07'),(3115,1,'127.0.0.1','User View',NULL,0,0,'2021-04-07 23:24:11','2021-04-07 23:24:11'),(3116,1,'127.0.0.1','User View',NULL,0,0,'2021-04-07 23:25:51','2021-04-07 23:25:51'),(3117,10,'127.0.0.1','Login',NULL,0,0,'2021-04-08 00:19:31','2021-04-08 00:19:31'),(3118,2,'127.0.0.1','Login',NULL,0,0,'2021-04-12 03:18:34','2021-04-12 03:18:34'),(3119,9,'127.0.0.1','Login',NULL,0,0,'2021-04-12 04:44:56','2021-04-12 04:44:56'),(3120,10,'127.0.0.1','Login',NULL,0,0,'2021-04-12 05:24:50','2021-04-12 05:24:50'),(3121,6,'127.0.0.1','Login',NULL,0,0,'2021-04-12 05:36:52','2021-04-12 05:36:52'),(3122,1,'127.0.0.1','Login',NULL,0,0,'2021-04-12 05:37:21','2021-04-12 05:37:21'),(3123,1,'127.0.0.1','User Role',NULL,0,0,'2021-04-12 05:37:39','2021-04-12 05:37:39'),(3124,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-04-12 05:37:46','2021-04-12 05:37:46'),(3125,1,'127.0.0.1','Role View',NULL,0,0,'2021-04-12 05:37:46','2021-04-12 05:37:46'),(3126,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-04-12 05:37:59','2021-04-12 05:37:59'),(3127,6,'127.0.0.1','Login',NULL,0,0,'2021-04-12 05:39:58','2021-04-12 05:39:58'),(3128,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-04-12 05:40:44','2021-04-12 05:40:44'),(3129,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-04-12 05:50:17','2021-04-12 05:50:17'),(3130,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-04-12 05:50:38','2021-04-12 05:50:38'),(3131,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-04-12 05:50:50','2021-04-12 05:50:50'),(3132,2,'127.0.0.1','Login',NULL,0,0,'2021-04-12 06:02:57','2021-04-12 06:02:57'),(3133,6,'127.0.0.1','Login',NULL,0,0,'2021-04-12 06:17:06','2021-04-12 06:17:06'),(3134,8,'127.0.0.1','Login',NULL,0,0,'2021-04-12 06:18:40','2021-04-12 06:18:40'),(3135,10,'127.0.0.1','Login',NULL,0,0,'2021-04-12 06:28:58','2021-04-12 06:28:58'),(3136,8,'127.0.0.1','Login',NULL,0,0,'2021-04-12 06:52:44','2021-04-12 06:52:44'),(3137,1,'127.0.0.1','Login',NULL,0,0,'2021-04-12 23:06:00','2021-04-12 23:06:00'),(3138,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-12 23:06:10','2021-04-12 23:06:10'),(3139,1,'127.0.0.1','User List',NULL,0,0,'2021-04-12 23:06:13','2021-04-12 23:06:13'),(3140,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-12 23:06:15','2021-04-12 23:06:15'),(3141,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-12 23:07:29','2021-04-12 23:07:29'),(3142,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-12 23:07:47','2021-04-12 23:07:47'),(3143,1,'127.0.0.1','User List',NULL,0,0,'2021-04-12 23:07:49','2021-04-12 23:07:49'),(3144,1,'127.0.0.1','User Role',NULL,0,0,'2021-04-12 23:07:52','2021-04-12 23:07:52'),(3145,1,'127.0.0.1','User View',NULL,0,0,'2021-04-12 23:07:55','2021-04-12 23:07:55'),(3146,1,'127.0.0.1','User Role',NULL,0,0,'2021-04-12 23:17:22','2021-04-12 23:17:22'),(3147,1,'127.0.0.1','User View',NULL,0,0,'2021-04-12 23:17:24','2021-04-12 23:17:24'),(3148,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-12 23:17:39','2021-04-12 23:17:39'),(3149,1,'127.0.0.1','User List',NULL,0,0,'2021-04-12 23:17:40','2021-04-12 23:17:40'),(3150,2,'127.0.0.1','Login',NULL,0,0,'2021-04-12 23:19:52','2021-04-12 23:19:52'),(3151,10,'127.0.0.1','Login',NULL,0,0,'2021-04-12 23:36:18','2021-04-12 23:36:18'),(3152,8,'127.0.0.1','Login',NULL,0,0,'2021-04-13 00:45:59','2021-04-13 00:45:59'),(3153,8,'127.0.0.1','Login',NULL,0,0,'2021-04-13 00:55:18','2021-04-13 00:55:18'),(3154,9,'127.0.0.1','Login',NULL,0,0,'2021-04-13 01:17:57','2021-04-13 01:17:57'),(3155,6,'127.0.0.1','Login',NULL,0,0,'2021-04-13 03:48:57','2021-04-13 03:48:57'),(3156,6,'127.0.0.1','Login',NULL,0,0,'2021-04-13 04:19:14','2021-04-13 04:19:14'),(3157,8,'127.0.0.1','Login',NULL,0,0,'2021-04-13 04:50:50','2021-04-13 04:50:50'),(3158,9,'127.0.0.1','Login',NULL,0,0,'2021-04-14 00:08:19','2021-04-14 00:08:19'),(3159,8,'127.0.0.1','Login',NULL,0,0,'2021-04-20 03:06:36','2021-04-20 03:06:36'),(3160,8,'127.0.0.1','Added auction committe members of reference number -dfg','auction',0,0,'2021-04-20 03:07:25','2021-04-20 03:07:25'),(3161,6,'127.0.0.1','Login',NULL,0,0,'2021-04-20 03:08:00','2021-04-20 03:08:00'),(3162,2,'127.0.0.1','Login',NULL,0,0,'2021-04-20 04:26:43','2021-04-20 04:26:43'),(3163,9,'127.0.0.1','Login',NULL,0,0,'2021-04-20 05:45:27','2021-04-20 05:45:27'),(3164,9,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:17:29','2021-04-20 06:17:29'),(3165,5,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:40:34','2021-04-20 06:40:34'),(3166,8,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:41:01','2021-04-20 06:41:01'),(3167,13,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:41:39','2021-04-20 06:41:39'),(3168,3,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:42:35','2021-04-20 06:42:35'),(3169,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:48:17','2021-04-20 06:48:17'),(3170,3,'127.0.0.1','approved Mfp procurement proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:48:21','2021-04-20 06:48:21'),(3171,3,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:50:10','2021-04-20 06:50:10'),(3172,4,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:52:09','2021-04-20 06:52:09'),(3173,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:52:31','2021-04-20 06:52:31'),(3174,4,'127.0.0.1','approved Mfp procurement proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:52:31','2021-04-20 06:52:31'),(3175,13,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:53:04','2021-04-20 06:53:04'),(3176,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:53:34','2021-04-20 06:53:34'),(3177,13,'127.0.0.1','approved Mfp procurement proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:53:35','2021-04-20 06:53:35'),(3178,0,'127.0.0.1','Login Failed With Username :sia_manipur_level3',NULL,0,0,'2021-04-20 06:53:54','2021-04-20 06:53:54'),(3179,0,'127.0.0.1','Login Failed With Username :sia_manipur_level3',NULL,0,0,'2021-04-20 06:54:02','2021-04-20 06:54:02'),(3180,5,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:54:19','2021-04-20 06:54:19'),(3181,5,'127.0.0.1','approved Mfp procurement proposal id - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:54:39','2021-04-20 06:54:39'),(3182,5,'127.0.0.1','Proposal consolidated into 23_49 of proposal ids - 23000056','mfp_procurement_aproval',0,0,'2021-04-20 06:54:47','2021-04-20 06:54:47'),(3183,6,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:55:08','2021-04-20 06:55:08'),(3184,4,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:57:12','2021-04-20 06:57:12'),(3185,9,'127.0.0.1','Login',NULL,0,0,'2021-04-20 06:57:48','2021-04-20 06:57:48'),(3186,2,'127.0.0.1','Login',NULL,0,0,'2021-04-21 00:12:30','2021-04-21 00:12:30'),(3187,2,'127.0.0.1','Login',NULL,0,0,'2021-04-21 03:19:11','2021-04-21 03:19:11'),(3188,2,'127.0.0.1','Login',NULL,0,0,'2021-04-21 04:46:38','2021-04-21 04:46:38'),(3189,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000062','mfp_procurement',0,0,'2021-04-21 06:31:28','2021-04-21 06:31:28'),(3190,3,'127.0.0.1','Login',NULL,0,0,'2021-04-21 06:32:56','2021-04-21 06:32:56'),(3191,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 06:33:25','2021-04-21 06:33:25'),(3192,3,'127.0.0.1','approved Mfp procurement proposal id - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 06:33:26','2021-04-21 06:33:26'),(3193,4,'127.0.0.1','Login',NULL,0,0,'2021-04-21 06:34:01','2021-04-21 06:34:01'),(3194,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 06:34:32','2021-04-21 06:34:32'),(3195,4,'127.0.0.1','approved Mfp procurement proposal id - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 06:34:33','2021-04-21 06:34:33'),(3196,1,'127.0.0.1','Login',NULL,0,0,'2021-04-21 06:59:43','2021-04-21 06:59:43'),(3197,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-21 06:59:52','2021-04-21 06:59:52'),(3198,1,'127.0.0.1','User List',NULL,0,0,'2021-04-21 06:59:54','2021-04-21 06:59:54'),(3199,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-21 06:59:57','2021-04-21 06:59:57'),(3200,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-04-21 07:00:06','2021-04-21 07:00:06'),(3201,2,'127.0.0.1','Login',NULL,0,0,'2021-04-21 23:30:29','2021-04-21 23:30:29'),(3202,13,'127.0.0.1','Login',NULL,0,0,'2021-04-21 23:33:12','2021-04-21 23:33:12'),(3203,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 23:34:33','2021-04-21 23:34:33'),(3204,13,'127.0.0.1','approved Mfp procurement proposal id - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 23:34:35','2021-04-21 23:34:35'),(3205,5,'127.0.0.1','Login',NULL,0,0,'2021-04-21 23:34:54','2021-04-21 23:34:54'),(3206,5,'127.0.0.1','approved Mfp procurement proposal id - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 23:35:13','2021-04-21 23:35:13'),(3207,5,'127.0.0.1','Proposal consolidated into 23_50 of proposal ids - 23000062','mfp_procurement_aproval',0,0,'2021-04-21 23:35:21','2021-04-21 23:35:21'),(3208,6,'127.0.0.1','Login',NULL,0,0,'2021-04-21 23:35:45','2021-04-21 23:35:45'),(3209,6,'127.0.0.1','Proposal consolidated into 23_50 of proposal ids - 23000060,23000061','mfp_procurement_aproval',0,0,'2021-04-21 23:36:39','2021-04-21 23:36:39'),(3210,6,'127.0.0.1','Proposal id 23000060 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-04-21 23:37:18','2021-04-21 23:37:18'),(3211,6,'127.0.0.1','Proposal id 23000061 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-04-21 23:37:18','2021-04-21 23:37:18'),(3212,6,'127.0.0.1','Proposal id 23000062 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-04-21 23:37:19','2021-04-21 23:37:19'),(3213,6,'127.0.0.1','Approved MFP procurement proposal ids - 23000060,23000061,23000062','mfp_procurement_aproval',0,0,'2021-04-21 23:37:22','2021-04-21 23:37:22'),(3214,8,'127.0.0.1','Login',NULL,0,0,'2021-04-21 23:37:52','2021-04-21 23:37:52'),(3215,8,'127.0.0.1','Proposal id 23000060 assigned to ministry','mfp_procurement_aproval',0,0,'2021-04-21 23:38:37','2021-04-21 23:38:37'),(3216,8,'127.0.0.1','Proposal id 23000061 assigned to ministry','mfp_procurement_aproval',0,0,'2021-04-21 23:38:38','2021-04-21 23:38:38'),(3217,8,'127.0.0.1','Proposal id 23000062 assigned to ministry','mfp_procurement_aproval',0,0,'2021-04-21 23:38:39','2021-04-21 23:38:39'),(3218,8,'127.0.0.1','Approved MFP procurement proposal ids - 23000060,23000061,23000062','mfp_procurement_aproval',0,0,'2021-04-21 23:38:39','2021-04-21 23:38:39'),(3219,9,'127.0.0.1','Login',NULL,0,0,'2021-04-21 23:39:01','2021-04-21 23:39:01'),(3220,9,'127.0.0.1','Approved MFP procurement proposal ids - 23000060,23000061,23000062','mfp_procurement_aproval',0,0,'2021-04-21 23:39:26','2021-04-21 23:39:26'),(3221,9,'127.0.0.1','Login',NULL,0,0,'2021-04-22 00:27:35','2021-04-22 00:27:35'),(3222,9,'127.0.0.1','Sanction Rs.862884.7275 of consolidation id 23_46','mfp_procurement_fund_sanctioned',0,0,'2021-04-22 00:30:10','2021-04-22 00:30:10'),(3223,8,'127.0.0.1','Login',NULL,0,0,'2021-04-22 00:36:08','2021-04-22 00:36:08'),(3224,8,'127.0.0.1','Sanction Rs.287628.2425 of consolidation id 23_46','mfp_procurement_fund_sanctioned',0,0,'2021-04-22 00:37:26','2021-04-22 00:37:26'),(3225,6,'127.0.0.1','Login',NULL,0,0,'2021-04-22 00:39:42','2021-04-22 00:39:42'),(3226,8,'127.0.0.1','Login',NULL,0,0,'2021-04-22 00:40:26','2021-04-22 00:40:26'),(3227,8,'127.0.0.1','Fund release Rs.1150512.9700 of consolidation id 23_46','mfp_procurement_fund_release',0,0,'2021-04-22 00:42:17','2021-04-22 00:42:17'),(3228,2,'127.0.0.1','Login',NULL,0,0,'2021-04-22 00:44:07','2021-04-22 00:44:07'),(3229,2,'127.0.0.1','Fund release by DIA of Rs.200000 of proposal id 23000052 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-04-22 00:56:03','2021-04-22 00:56:03'),(3230,10,'127.0.0.1','Login',NULL,0,0,'2021-04-22 00:56:33','2021-04-22 00:56:33'),(3231,10,'127.0.0.1','added tribal detail form of reference number d8b3f05c-07c1-4af8-9628-b17ca993cd25','mfp_procurement_tribal_detail_form',0,0,'2021-04-22 01:24:38','2021-04-22 01:24:38'),(3232,8,'127.0.0.1','Login',NULL,0,0,'2021-04-22 01:25:36','2021-04-22 01:25:36'),(3233,6,'127.0.0.1','Login',NULL,0,0,'2021-04-22 01:27:31','2021-04-22 01:27:31'),(3234,2,'127.0.0.1','Login',NULL,0,0,'2021-04-28 00:39:27','2021-04-28 00:39:27'),(3235,6,'127.0.0.1','Login',NULL,0,0,'2021-04-28 23:04:00','2021-04-28 23:04:00'),(3236,8,'127.0.0.1','Login',NULL,0,0,'2021-04-28 23:05:17','2021-04-28 23:05:17'),(3237,13,'127.0.0.1','Login',NULL,0,0,'2021-04-28 23:07:49','2021-04-28 23:07:49'),(3238,8,'127.0.0.1','Login',NULL,0,0,'2021-04-28 23:13:08','2021-04-28 23:13:08'),(3239,2,'127.0.0.1','Login',NULL,0,0,'2021-04-28 23:48:45','2021-04-28 23:48:45'),(3240,2,'127.0.0.1','Login',NULL,0,0,'2021-04-29 22:58:47','2021-04-29 22:58:47'),(3241,6,'127.0.0.1','Login',NULL,0,0,'2021-04-29 23:09:19','2021-04-29 23:09:19'),(3242,2,'127.0.0.1','Login',NULL,0,0,'2021-05-02 23:11:17','2021-05-02 23:11:17'),(3243,10,'127.0.0.1','Login',NULL,0,0,'2021-05-02 23:18:10','2021-05-02 23:18:10'),(3244,8,'127.0.0.1','Login',NULL,0,0,'2021-05-02 23:23:51','2021-05-02 23:23:51'),(3245,7,'127.0.0.1','Login',NULL,0,0,'2021-05-02 23:32:02','2021-05-02 23:32:02'),(3246,7,'127.0.0.1','Edited auction committe members of reference number -456321','auction',0,0,'2021-05-02 23:41:11','2021-05-02 23:41:11'),(3247,1,'127.0.0.1','Login',NULL,0,0,'2021-05-02 23:42:09','2021-05-02 23:42:09'),(3248,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-02 23:42:29','2021-05-02 23:42:29'),(3249,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:42:30','2021-05-02 23:42:30'),(3250,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:42:40','2021-05-02 23:42:40'),(3251,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:42:44','2021-05-02 23:42:44'),(3252,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:42:48','2021-05-02 23:42:48'),(3253,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:43:03','2021-05-02 23:43:03'),(3254,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:44:47','2021-05-02 23:44:47'),(3255,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:45:46','2021-05-02 23:45:46'),(3256,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:45:53','2021-05-02 23:45:53'),(3257,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:46:02','2021-05-02 23:46:02'),(3258,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:46:14','2021-05-02 23:46:14'),(3259,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:46:41','2021-05-02 23:46:41'),(3260,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:47:20','2021-05-02 23:47:20'),(3261,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:48:32','2021-05-02 23:48:32'),(3262,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:50:45','2021-05-02 23:50:45'),(3263,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:50:54','2021-05-02 23:50:54'),(3264,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:53:04','2021-05-02 23:53:04'),(3265,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:53:10','2021-05-02 23:53:10'),(3266,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:53:15','2021-05-02 23:53:15'),(3267,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:53:19','2021-05-02 23:53:19'),(3268,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:53:25','2021-05-02 23:53:25'),(3269,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:53:33','2021-05-02 23:53:33'),(3270,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:53:36','2021-05-02 23:53:36'),(3271,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:54:30','2021-05-02 23:54:30'),(3272,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:54:54','2021-05-02 23:54:54'),(3273,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:54:59','2021-05-02 23:54:59'),(3274,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:56:21','2021-05-02 23:56:21'),(3275,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:57:22','2021-05-02 23:57:22'),(3276,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:57:34','2021-05-02 23:57:34'),(3277,1,'127.0.0.1','User List',NULL,0,0,'2021-05-02 23:57:39','2021-05-02 23:57:39'),(3278,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:05:13','2021-05-03 00:05:13'),(3279,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:10:00','2021-05-03 00:10:00'),(3280,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:11:20','2021-05-03 00:11:20'),(3281,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:11:22','2021-05-03 00:11:22'),(3282,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:11:24','2021-05-03 00:11:24'),(3283,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:12:46','2021-05-03 00:12:46'),(3284,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:13:20','2021-05-03 00:13:20'),(3285,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:22:02','2021-05-03 00:22:02'),(3286,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:22:07','2021-05-03 00:22:07'),(3287,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:22:33','2021-05-03 00:22:33'),(3288,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:31:22','2021-05-03 00:31:22'),(3289,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:31:24','2021-05-03 00:31:24'),(3290,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-03 00:34:04','2021-05-03 00:34:04'),(3291,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:34:05','2021-05-03 00:34:05'),(3292,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-03 00:34:12','2021-05-03 00:34:12'),(3293,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-03 00:34:19','2021-05-03 00:34:19'),(3294,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-03 00:34:23','2021-05-03 00:34:23'),(3295,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-03 00:34:35','2021-05-03 00:34:35'),(3296,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:34:37','2021-05-03 00:34:37'),(3297,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:34:55','2021-05-03 00:34:55'),(3298,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:35:02','2021-05-03 00:35:02'),(3299,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:35:08','2021-05-03 00:35:08'),(3300,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:35:13','2021-05-03 00:35:13'),(3301,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:35:20','2021-05-03 00:35:20'),(3302,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:35:22','2021-05-03 00:35:22'),(3303,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:35:42','2021-05-03 00:35:42'),(3304,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:35:47','2021-05-03 00:35:47'),(3305,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 00:37:25','2021-05-03 00:37:25'),(3306,2,'127.0.0.1','Login',NULL,0,0,'2021-05-03 00:46:37','2021-05-03 00:46:37'),(3307,10,'127.0.0.1','Login',NULL,0,0,'2021-05-03 00:49:15','2021-05-03 00:49:15'),(3308,1,'127.0.0.1','Login',NULL,0,0,'2021-05-03 00:53:29','2021-05-03 00:53:29'),(3309,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-03 00:53:50','2021-05-03 00:53:50'),(3310,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-03 00:53:53','2021-05-03 00:53:53'),(3311,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-03 00:53:54','2021-05-03 00:53:54'),(3312,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-03 01:02:23','2021-05-03 01:02:23'),(3313,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-03 01:02:23','2021-05-03 01:02:23'),(3314,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-03 01:02:34','2021-05-03 01:02:34'),(3315,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-03 01:02:39','2021-05-03 01:02:39'),(3316,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-03 01:02:39','2021-05-03 01:02:39'),(3317,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-03 01:04:10','2021-05-03 01:04:10'),(3318,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-03 01:04:11','2021-05-03 01:04:11'),(3319,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-05-03 01:04:22','2021-05-03 01:04:22'),(3320,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-03 01:05:47','2021-05-03 01:05:47'),(3321,1,'127.0.0.1','User List',NULL,0,0,'2021-05-03 01:05:48','2021-05-03 01:05:48'),(3322,1,'127.0.0.1','User View',NULL,0,0,'2021-05-03 01:05:52','2021-05-03 01:05:52'),(3323,1,'127.0.0.1','User View',NULL,0,0,'2021-05-03 01:06:46','2021-05-03 01:06:46'),(3324,10,'127.0.0.1','Login',NULL,0,0,'2021-05-03 01:16:31','2021-05-03 01:16:31'),(3325,10,'127.0.0.1','Login',NULL,0,0,'2021-05-03 03:24:15','2021-05-03 03:24:15'),(3326,2,'127.0.0.1','Login',NULL,0,0,'2021-05-03 03:27:12','2021-05-03 03:27:12'),(3327,10,'127.0.0.1','Login',NULL,0,0,'2021-05-03 05:11:48','2021-05-03 05:11:48'),(3328,2,'127.0.0.1','Login',NULL,0,0,'2021-05-03 05:48:26','2021-05-03 05:48:26'),(3329,1,'127.0.0.1','Login',NULL,0,0,'2021-05-03 23:24:09','2021-05-03 23:24:09'),(3330,2,'127.0.0.1','Login',NULL,0,0,'2021-05-03 23:27:22','2021-05-03 23:27:22'),(3331,4,'127.0.0.1','Login',NULL,0,0,'2021-05-04 03:13:51','2021-05-04 03:13:51'),(3332,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000059','mfp_procurement_aproval',0,0,'2021-05-04 03:14:24','2021-05-04 03:14:24'),(3333,4,'127.0.0.1','approved Mfp procurement proposal id - 23000059','mfp_procurement_aproval',0,0,'2021-05-04 03:14:25','2021-05-04 03:14:25'),(3334,4,'127.0.0.1','Revert MFP procurement proposal id - 23000058','mfp_procurement_aproval',0,0,'2021-05-04 03:44:06','2021-05-04 03:44:06'),(3335,5,'127.0.0.1','Login',NULL,0,0,'2021-05-04 04:07:53','2021-05-04 04:07:53'),(3336,13,'127.0.0.1','Login',NULL,0,0,'2021-05-04 04:08:22','2021-05-04 04:08:22'),(3337,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000059','mfp_procurement_aproval',0,0,'2021-05-04 04:08:43','2021-05-04 04:08:43'),(3338,13,'127.0.0.1','approved Mfp procurement proposal id - 23000059','mfp_procurement_aproval',0,0,'2021-05-04 04:08:44','2021-05-04 04:08:44'),(3339,4,'127.0.0.1','Login',NULL,0,0,'2021-05-04 04:09:07','2021-05-04 04:09:07'),(3340,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-05-04 04:09:29','2021-05-04 04:09:29'),(3341,4,'127.0.0.1','approved Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-05-04 04:09:29','2021-05-04 04:09:29'),(3342,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-05-04 04:09:47','2021-05-04 04:09:47'),(3343,4,'127.0.0.1','approved Mfp procurement proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-05-04 04:09:48','2021-05-04 04:09:48'),(3344,13,'127.0.0.1','Login',NULL,0,0,'2021-05-04 04:10:06','2021-05-04 04:10:06'),(3345,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-05-04 04:10:26','2021-05-04 04:10:26'),(3346,13,'127.0.0.1','approved Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-05-04 04:10:27','2021-05-04 04:10:27'),(3347,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-05-04 04:10:44','2021-05-04 04:10:44'),(3348,13,'127.0.0.1','approved Mfp procurement proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-05-04 04:10:44','2021-05-04 04:10:44'),(3349,5,'127.0.0.1','Login',NULL,0,0,'2021-05-04 04:11:11','2021-05-04 04:11:11'),(3350,5,'127.0.0.1','approved Mfp procurement proposal id - 23000059','mfp_procurement_aproval',0,0,'2021-05-04 04:11:32','2021-05-04 04:11:32'),(3351,5,'127.0.0.1','approved Mfp procurement proposal id - 23000050','mfp_procurement_aproval',0,0,'2021-05-04 04:11:46','2021-05-04 04:11:46'),(3352,5,'127.0.0.1','approved Mfp procurement proposal id - 23000046','mfp_procurement_aproval',0,0,'2021-05-04 04:12:00','2021-05-04 04:12:00'),(3353,5,'127.0.0.1','Proposal consolidated into 23_51 of proposal ids - 23000059','mfp_procurement_aproval',0,0,'2021-05-04 05:20:51','2021-05-04 05:20:51'),(3354,5,'127.0.0.1','Proposal consolidated into 23_52 of proposal ids - 23000050,23000046','mfp_procurement_aproval',0,0,'2021-05-04 05:36:46','2021-05-04 05:36:46'),(3355,6,'127.0.0.1','Login',NULL,0,0,'2021-05-04 05:37:13','2021-05-04 05:37:13'),(3356,6,'127.0.0.1','Proposal consolidated into 23_52 of proposal ids - 23000056','mfp_procurement_aproval',0,0,'2021-05-04 05:57:21','2021-05-04 05:57:21'),(3357,10,'127.0.0.1','Login',NULL,0,0,'2021-05-04 06:51:40','2021-05-04 06:51:40'),(3358,5,'127.0.0.1','Login',NULL,0,0,'2021-05-06 23:06:25','2021-05-06 23:06:25'),(3359,13,'127.0.0.1','Login',NULL,0,0,'2021-05-06 23:07:17','2021-05-06 23:07:17'),(3360,4,'127.0.0.1','Login',NULL,0,0,'2021-05-06 23:07:40','2021-05-06 23:07:40'),(3361,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000043','mfp_procurement_aproval',0,0,'2021-05-06 23:08:05','2021-05-06 23:08:05'),(3362,4,'127.0.0.1','approved Mfp procurement proposal id - 23000043','mfp_procurement_aproval',0,0,'2021-05-06 23:08:08','2021-05-06 23:08:08'),(3363,13,'127.0.0.1','Login',NULL,0,0,'2021-05-06 23:09:14','2021-05-06 23:09:14'),(3364,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000043','mfp_procurement_aproval',0,0,'2021-05-06 23:09:36','2021-05-06 23:09:36'),(3365,13,'127.0.0.1','approved Mfp procurement proposal id - 23000043','mfp_procurement_aproval',0,0,'2021-05-06 23:09:37','2021-05-06 23:09:37'),(3366,0,'127.0.0.1','Login Failed With Username :sia_manipur_level3',NULL,0,0,'2021-05-06 23:10:25','2021-05-06 23:10:25'),(3367,5,'127.0.0.1','Login',NULL,0,0,'2021-05-06 23:10:36','2021-05-06 23:10:36'),(3368,5,'127.0.0.1','approved Mfp procurement proposal id - 23000043','mfp_procurement_aproval',0,0,'2021-05-06 23:10:54','2021-05-06 23:10:54'),(3369,5,'127.0.0.1','Proposal consolidated into 23_53 of proposal ids - 23000043','mfp_procurement_aproval',0,0,'2021-05-06 23:21:53','2021-05-06 23:21:53'),(3370,6,'127.0.0.1','Login',NULL,0,0,'2021-05-06 23:22:21','2021-05-06 23:22:21'),(3371,6,'127.0.0.1','Proposal consolidated into 23_53 of proposal ids - 23000046,23000050,23000056','mfp_procurement_aproval',0,0,'2021-05-07 00:01:22','2021-05-07 00:01:22'),(3372,13,'127.0.0.1','Login',NULL,0,0,'2021-05-07 02:10:18','2021-05-07 02:10:18'),(3373,6,'127.0.0.1','Login',NULL,0,0,'2021-05-07 02:11:01','2021-05-07 02:11:01'),(3374,2,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:21:02','2021-05-07 03:21:02'),(3375,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000064','mfp_procurement',0,0,'2021-05-07 03:25:19','2021-05-07 03:25:19'),(3376,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000063','mfp_procurement',0,0,'2021-05-07 03:28:18','2021-05-07 03:28:18'),(3377,3,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:29:06','2021-05-07 03:29:06'),(3378,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:29:56','2021-05-07 03:29:56'),(3379,3,'127.0.0.1','approved Mfp procurement proposal id - 23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:29:56','2021-05-07 03:29:56'),(3380,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:30:25','2021-05-07 03:30:25'),(3381,3,'127.0.0.1','approved Mfp procurement proposal id - 23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:30:26','2021-05-07 03:30:26'),(3382,4,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:31:02','2021-05-07 03:31:02'),(3383,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:31:41','2021-05-07 03:31:41'),(3384,4,'127.0.0.1','approved Mfp procurement proposal id - 23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:31:42','2021-05-07 03:31:42'),(3385,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:32:01','2021-05-07 03:32:01'),(3386,4,'127.0.0.1','approved Mfp procurement proposal id - 23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:32:01','2021-05-07 03:32:01'),(3387,13,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:32:30','2021-05-07 03:32:30'),(3388,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:32:51','2021-05-07 03:32:51'),(3389,13,'127.0.0.1','approved Mfp procurement proposal id - 23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:32:52','2021-05-07 03:32:52'),(3390,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:33:09','2021-05-07 03:33:09'),(3391,13,'127.0.0.1','approved Mfp procurement proposal id - 23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:33:09','2021-05-07 03:33:09'),(3392,5,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:42:53','2021-05-07 03:42:53'),(3393,5,'127.0.0.1','approved Mfp procurement proposal id - 23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:43:24','2021-05-07 03:43:24'),(3394,5,'127.0.0.1','approved Mfp procurement proposal id - 23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:43:39','2021-05-07 03:43:39'),(3395,5,'127.0.0.1','Proposal consolidated into 23_54 of proposal ids - 23000064,23000063','mfp_procurement_aproval',0,0,'2021-05-07 03:44:45','2021-05-07 03:44:45'),(3396,6,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:45:24','2021-05-07 03:45:24'),(3397,6,'127.0.0.1','Proposal consolidated into 23_54 of proposal ids - 23000059','mfp_procurement_aproval',0,0,'2021-05-07 03:46:28','2021-05-07 03:46:28'),(3404,6,'127.0.0.1','Proposal id 23000059 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-05-07 03:49:48','2021-05-07 03:49:48'),(3405,6,'127.0.0.1','Proposal id 23000063 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-05-07 03:49:48','2021-05-07 03:49:48'),(3406,6,'127.0.0.1','Proposal id 23000064 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-05-07 03:49:48','2021-05-07 03:49:48'),(3407,6,'127.0.0.1','Approved MFP procurement proposal ids - 23000059,23000063,23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:49:48','2021-05-07 03:49:48'),(3408,0,'127.0.0.1','Login Failed With Username :nodal_manipur_level3',NULL,0,0,'2021-05-07 03:50:23','2021-05-07 03:50:23'),(3409,8,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:50:33','2021-05-07 03:50:33'),(3410,8,'127.0.0.1','Proposal id 23000059 assigned to ministry','mfp_procurement_aproval',0,0,'2021-05-07 03:51:24','2021-05-07 03:51:24'),(3411,8,'127.0.0.1','Proposal id 23000063 assigned to ministry','mfp_procurement_aproval',0,0,'2021-05-07 03:51:24','2021-05-07 03:51:24'),(3412,8,'127.0.0.1','Proposal id 23000064 assigned to ministry','mfp_procurement_aproval',0,0,'2021-05-07 03:51:24','2021-05-07 03:51:24'),(3413,8,'127.0.0.1','Approved MFP procurement proposal ids - 23000059,23000063,23000064','mfp_procurement_aproval',0,0,'2021-05-07 03:51:25','2021-05-07 03:51:25'),(3414,9,'127.0.0.1','Login',NULL,0,0,'2021-05-07 03:54:26','2021-05-07 03:54:26'),(3415,9,'127.0.0.1','Approved MFP procurement proposal ids - 23000059,23000063,23000064','mfp_procurement_aproval',0,0,'2021-05-07 04:05:22','2021-05-07 04:05:22'),(3416,9,'127.0.0.1','Login',NULL,0,0,'2021-05-09 23:32:29','2021-05-09 23:32:29'),(3417,9,'127.0.0.1','Login',NULL,0,0,'2021-05-10 00:28:57','2021-05-10 00:28:57'),(3418,9,'127.0.0.1','Login',NULL,0,0,'2021-05-10 00:32:08','2021-05-10 00:32:08'),(3419,9,'127.0.0.1','Sanction Rs.1000000 of consolidation id 23_54','mfp_procurement_fund_sanctioned',0,0,'2021-05-10 00:33:31','2021-05-10 00:33:31'),(3420,8,'127.0.0.1','Login',NULL,0,0,'2021-05-10 00:33:55','2021-05-10 00:33:55'),(3421,8,'127.0.0.1','Sanction Rs.1000000 of consolidation id 23_54','mfp_procurement_fund_sanctioned',0,0,'2021-05-10 00:34:47','2021-05-10 00:34:47'),(3422,8,'127.0.0.1','Fund release Rs.2000000.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 00:35:46','2021-05-10 00:35:46'),(3423,6,'127.0.0.1','Login',NULL,0,0,'2021-05-10 00:36:54','2021-05-10 00:36:54'),(3424,6,'127.0.0.1','Login',NULL,0,0,'2021-05-10 03:34:38','2021-05-10 03:34:38'),(3425,6,'127.0.0.1','Fund release Rs.20000.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 03:52:47','2021-05-10 03:52:47'),(3426,6,'127.0.0.1','Fund release Rs.20000.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 04:00:26','2021-05-10 04:00:26'),(3427,6,'127.0.0.1','Fund release Rs.20000.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 04:01:05','2021-05-10 04:01:05'),(3428,8,'127.0.0.1','Login',NULL,0,0,'2021-05-10 04:04:01','2021-05-10 04:04:01'),(3429,8,'127.0.0.1','Fund release Rs.9999.9500 of consolidation id 23_38','mfp_procurement_fund_release',0,0,'2021-05-10 04:08:30','2021-05-10 04:08:30'),(3430,8,'127.0.0.1','Fund release Rs.1899.9905 of consolidation id 23_38','mfp_procurement_fund_release',0,0,'2021-05-10 04:09:21','2021-05-10 04:09:21'),(3431,6,'127.0.0.1','Login',NULL,0,0,'2021-05-10 04:10:49','2021-05-10 04:10:49'),(3432,6,'127.0.0.1','Fund release Rs.19600.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 04:17:15','2021-05-10 04:17:15'),(3433,6,'127.0.0.1','Login',NULL,0,0,'2021-05-10 05:05:11','2021-05-10 05:05:11'),(3434,6,'127.0.0.1','Fund release Rs.20000.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 05:21:30','2021-05-10 05:21:30'),(3435,6,'127.0.0.1','Fund release Rs.19800.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 05:22:15','2021-05-10 05:22:15'),(3436,6,'127.0.0.1','Login',NULL,0,0,'2021-05-10 23:41:59','2021-05-10 23:41:59'),(3437,9,'127.0.0.1','Login',NULL,0,0,'2021-05-10 23:45:52','2021-05-10 23:45:52'),(3438,8,'127.0.0.1','Login',NULL,0,0,'2021-05-10 23:47:17','2021-05-10 23:47:17'),(3439,9,'127.0.0.1','Login',NULL,0,0,'2021-05-10 23:48:27','2021-05-10 23:48:27'),(3440,6,'127.0.0.1','Fund release Rs.19602.0000 of consolidation id 23_54','mfp_procurement_fund_release',0,0,'2021-05-10 23:49:28','2021-05-10 23:49:28'),(3441,2,'127.0.0.1','Login',NULL,0,0,'2021-05-10 23:51:51','2021-05-10 23:51:51'),(3442,2,'127.0.0.1','Fund release by DIA of Rs.1 of proposal id 23000064 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-11 01:42:39','2021-05-11 01:42:39'),(3443,2,'127.0.0.1','Fund release by DIA of Rs.0.95 of proposal id 23000064 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-11 01:56:56','2021-05-11 01:56:56'),(3444,2,'127.0.0.1','Fund release by DIA of Rs.0.95 of proposal id 23000064 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-11 01:58:19','2021-05-11 01:58:19'),(3445,2,'127.0.0.1','Login',NULL,0,0,'2021-05-11 03:41:13','2021-05-11 03:41:13'),(3446,2,'127.0.0.1','Fund release by DIA of Rs.571.6444 of proposal id 23000064 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-11 03:53:24','2021-05-11 03:53:24'),(3447,2,'127.0.0.1','Fund release by DIA of Rs.0.95 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-11 03:56:48','2021-05-11 03:56:48'),(3448,1,'127.0.0.1','Login',NULL,0,0,'2021-05-11 04:56:44','2021-05-11 04:56:44'),(3449,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-11 04:59:45','2021-05-11 04:59:45'),(3450,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-11 04:59:49','2021-05-11 04:59:49'),(3451,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-11 04:59:50','2021-05-11 04:59:50'),(3452,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-11 05:01:03','2021-05-11 05:01:03'),(3453,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-11 05:01:04','2021-05-11 05:01:04'),(3454,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-05-11 05:01:15','2021-05-11 05:01:15'),(3455,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-11 05:01:25','2021-05-11 05:01:25'),(3456,1,'127.0.0.1','User List',NULL,0,0,'2021-05-11 05:01:26','2021-05-11 05:01:26'),(3457,1,'127.0.0.1','User View',NULL,0,0,'2021-05-11 05:01:33','2021-05-11 05:01:33'),(3458,1,'127.0.0.1','User View',NULL,0,0,'2021-05-11 05:02:14','2021-05-11 05:02:14'),(3459,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-11 05:02:25','2021-05-11 05:02:25'),(3460,2,'127.0.0.1','Login',NULL,0,0,'2021-05-11 05:04:24','2021-05-11 05:04:24'),(3461,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-11 05:04:38','2021-05-11 05:04:38'),(3462,1,'127.0.0.1','User List',NULL,0,0,'2021-05-11 05:04:39','2021-05-11 05:04:39'),(3463,1,'127.0.0.1','User List',NULL,0,0,'2021-05-11 05:04:43','2021-05-11 05:04:43'),(3464,1,'127.0.0.1','User View',NULL,0,0,'2021-05-11 05:04:49','2021-05-11 05:04:49'),(3465,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-11 05:05:03','2021-05-11 05:05:03'),(3466,1,'127.0.0.1','User List',NULL,0,0,'2021-05-11 05:05:04','2021-05-11 05:05:04'),(3467,2,'127.0.0.1','Login',NULL,0,0,'2021-05-11 05:05:15','2021-05-11 05:05:15'),(3468,2,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-11 05:10:52','2021-05-11 05:10:52'),(3469,2,'127.0.0.1','Login',NULL,0,0,'2021-05-11 05:37:10','2021-05-11 05:37:10'),(3470,2,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-11 05:37:16','2021-05-11 05:37:16'),(3471,2,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-11 05:37:28','2021-05-11 05:37:28'),(3472,2,'127.0.0.1','Login',NULL,0,0,'2021-05-11 23:49:07','2021-05-11 23:49:07'),(3473,2,'127.0.0.1','Login',NULL,0,0,'2021-05-11 23:51:59','2021-05-11 23:51:59'),(3474,2,'127.0.0.1','Login',NULL,0,0,'2021-05-12 00:41:21','2021-05-12 00:41:21'),(3475,2,'127.0.0.1','Fund release by DIA of Rs.9.5 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-12 00:56:09','2021-05-12 00:56:09'),(3476,9,'127.0.0.1','Login',NULL,0,0,'2021-05-12 00:56:43','2021-05-12 00:56:43'),(3477,2,'127.0.0.1','Fund release by DIA of Rs.90 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-12 00:59:23','2021-05-12 00:59:23'),(3478,9,'127.0.0.1','Login',NULL,0,0,'2021-05-12 01:22:08','2021-05-12 01:22:08'),(3479,8,'127.0.0.1','Login',NULL,0,0,'2021-05-12 01:22:55','2021-05-12 01:22:55'),(3480,2,'127.0.0.1','Fund release by DIA of Rs.90 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-12 01:26:13','2021-05-12 01:26:13'),(3481,2,'127.0.0.1','Fund release by DIA of Rs.0.9 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-12 01:27:16','2021-05-12 01:27:16'),(3482,2,'127.0.0.1','Fund release by DIA of Rs.0.9 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-12 01:28:09','2021-05-12 01:28:09'),(3483,2,'127.0.0.1','Fund release by DIA of Rs.0.9 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-12 01:30:17','2021-05-12 01:30:17'),(3484,1,'127.0.0.1','Login',NULL,0,0,'2021-05-12 01:31:09','2021-05-12 01:31:09'),(3485,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-12 01:31:26','2021-05-12 01:31:26'),(3486,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-12 01:31:33','2021-05-12 01:31:33'),(3487,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-12 01:31:48','2021-05-12 01:31:48'),(3488,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-12 01:31:49','2021-05-12 01:31:49'),(3489,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-12 01:32:52','2021-05-12 01:32:52'),(3490,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-12 01:32:56','2021-05-12 01:32:56'),(3491,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-12 01:33:00','2021-05-12 01:33:00'),(3492,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-12 01:33:05','2021-05-12 01:33:05'),(3493,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-12 01:33:09','2021-05-12 01:33:09'),(3494,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-12 01:33:12','2021-05-12 01:33:12'),(3495,1,'127.0.0.1','User List',NULL,0,0,'2021-05-12 01:33:13','2021-05-12 01:33:13'),(3496,1,'127.0.0.1','User View',NULL,0,0,'2021-05-12 01:33:17','2021-05-12 01:33:17'),(3497,6,'127.0.0.1','Login',NULL,0,0,'2021-05-12 04:09:43','2021-05-12 04:09:43'),(3498,0,'127.0.0.1','Login Failed With Username :dia_manipur',NULL,0,0,'2021-05-12 05:18:56','2021-05-12 05:18:56'),(3499,2,'127.0.0.1','Login',NULL,0,0,'2021-05-12 05:19:59','2021-05-12 05:19:59'),(3500,6,'127.0.0.1','Login',NULL,0,0,'2021-05-12 05:59:02','2021-05-12 05:59:02'),(3501,1,'127.0.0.1','Login',NULL,0,0,'2021-05-12 06:02:36','2021-05-12 06:02:36'),(3502,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-12 06:02:53','2021-05-12 06:02:53'),(3503,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-12 06:02:57','2021-05-12 06:02:57'),(3504,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-12 06:02:58','2021-05-12 06:02:58'),(3505,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-12 06:05:19','2021-05-12 06:05:19'),(3506,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-12 06:05:20','2021-05-12 06:05:20'),(3507,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-12 06:05:38','2021-05-12 06:05:38'),(3508,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-12 06:05:43','2021-05-12 06:05:43'),(3509,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-12 06:05:43','2021-05-12 06:05:43'),(3510,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-12 06:06:08','2021-05-12 06:06:08'),(3511,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-12 06:06:08','2021-05-12 06:06:08'),(3512,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-12 06:06:22','2021-05-12 06:06:22'),(3513,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-12 06:06:26','2021-05-12 06:06:26'),(3514,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-12 06:06:26','2021-05-12 06:06:26'),(3515,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-05-12 06:06:35','2021-05-12 06:06:35'),(3516,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-12 06:06:38','2021-05-12 06:06:38'),(3517,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-12 06:06:42','2021-05-12 06:06:42'),(3518,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-12 06:06:43','2021-05-12 06:06:43'),(3519,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-05-12 06:06:53','2021-05-12 06:06:53'),(3520,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-12 06:06:59','2021-05-12 06:06:59'),(3521,6,'127.0.0.1','Login',NULL,0,0,'2021-05-12 06:07:22','2021-05-12 06:07:22'),(3522,6,'127.0.0.1','Fund release Rs.118.9994 of consolidation id 23_38','mfp_procurement_fund_release',0,0,'2021-05-12 06:25:46','2021-05-12 06:25:46'),(3523,10,'127.0.0.1','Login',NULL,0,0,'2021-05-13 00:10:47','2021-05-13 00:10:47'),(3524,10,'127.0.0.1','added tribal detail form of reference number 34136e12-3642-4cbd-8a63-f89078317b21','mfp_procurement_tribal_detail_form',0,0,'2021-05-13 00:31:35','2021-05-13 00:31:35'),(3525,10,'127.0.0.1','Generated Receipt of Actual detail reference id 34136e12-3642-4cbd-8a63-f89078317b21','mfp_procurement_tribal_detail_form',0,0,'2021-05-13 00:31:55','2021-05-13 00:31:55'),(3526,10,'127.0.0.1','Login',NULL,0,0,'2021-05-13 00:40:12','2021-05-13 00:40:12'),(3527,10,'127.0.0.1','added Mfp Storage detail ','mfp_procurement_tribal_detail_form',0,0,'2021-05-13 00:41:18','2021-05-13 00:41:18'),(3528,10,'127.0.0.1','Send proposal to next level userdia_manipur_level1 transaction id - 1','mfp_procurement_aproval',0,0,'2021-05-13 00:47:39','2021-05-13 00:47:39'),(3529,10,'127.0.0.1','Login',NULL,0,0,'2021-05-13 01:22:04','2021-05-13 01:22:04'),(3530,2,'127.0.0.1','Login',NULL,0,0,'2021-05-13 01:23:27','2021-05-13 01:23:27'),(3531,10,'127.0.0.1','Login',NULL,0,0,'2021-05-13 03:11:34','2021-05-13 03:11:34'),(3532,2,'127.0.0.1','Login',NULL,0,0,'2021-05-13 03:19:27','2021-05-13 03:19:27'),(3533,1,'127.0.0.1','Login',NULL,0,0,'2021-05-13 03:20:11','2021-05-13 03:20:11'),(3534,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-13 03:20:17','2021-05-13 03:20:17'),(3535,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-13 03:20:21','2021-05-13 03:20:21'),(3536,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-13 03:20:21','2021-05-13 03:20:21'),(3537,1,'127.0.0.1','Created Permission Mapping',NULL,0,0,'2021-05-13 03:21:08','2021-05-13 03:21:08'),(3538,2,'127.0.0.1','Login',NULL,0,0,'2021-05-13 03:21:27','2021-05-13 03:21:27'),(3539,1,'127.0.0.1','Login',NULL,0,0,'2021-05-13 03:22:20','2021-05-13 03:22:20'),(3540,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:22:27','2021-05-13 03:22:27'),(3541,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:22:31','2021-05-13 03:22:31'),(3542,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:22:35','2021-05-13 03:22:35'),(3543,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:22:39','2021-05-13 03:22:39'),(3544,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:22:42','2021-05-13 03:22:42'),(3545,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:22:45','2021-05-13 03:22:45'),(3546,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:22:49','2021-05-13 03:22:49'),(3547,1,'127.0.0.1','User List',NULL,0,0,'2021-05-13 03:22:50','2021-05-13 03:22:50'),(3548,1,'127.0.0.1','User List',NULL,0,0,'2021-05-13 03:22:56','2021-05-13 03:22:56'),(3549,1,'127.0.0.1','User View',NULL,0,0,'2021-05-13 03:23:01','2021-05-13 03:23:01'),(3550,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-05-13 03:23:17','2021-05-13 03:23:17'),(3551,1,'127.0.0.1','User List',NULL,0,0,'2021-05-13 03:23:18','2021-05-13 03:23:18'),(3552,2,'127.0.0.1','Login',NULL,0,0,'2021-05-13 03:23:31','2021-05-13 03:23:31'),(3553,1,'127.0.0.1','Login',NULL,0,0,'2021-05-13 03:25:19','2021-05-13 03:25:19'),(3554,2,'127.0.0.1','Login',NULL,0,0,'2021-05-13 05:57:51','2021-05-13 05:57:51'),(3555,10,'127.0.0.1','Login',NULL,0,0,'2021-05-14 03:38:43','2021-05-14 03:38:43'),(3556,10,'127.0.0.1','added tribal detail form of reference number c9d58cba-7c1a-4c3d-8083-9d0ae503fd05','mfp_procurement_tribal_detail_form',0,0,'2021-05-14 03:41:45','2021-05-14 03:41:45'),(3557,10,'127.0.0.1','Generated Receipt of Actual detail reference id c9d58cba-7c1a-4c3d-8083-9d0ae503fd05','mfp_procurement_tribal_detail_form',0,0,'2021-05-14 03:46:53','2021-05-14 03:46:53'),(3558,10,'127.0.0.1','added Mfp Storage detail ','mfp_procurement_tribal_detail_form',0,0,'2021-05-14 03:48:03','2021-05-14 03:48:03'),(3559,10,'127.0.0.1','Login',NULL,0,0,'2021-05-14 04:07:00','2021-05-14 04:07:00'),(3560,2,'127.0.0.1','Login',NULL,0,0,'2021-05-14 04:46:12','2021-05-14 04:46:12'),(3561,10,'127.0.0.1','Login',NULL,0,0,'2021-05-14 04:59:47','2021-05-14 04:59:47'),(3562,2,'127.0.0.1','Login',NULL,0,0,'2021-05-14 05:03:04','2021-05-14 05:03:04'),(3563,10,'127.0.0.1','Login',NULL,0,0,'2021-05-14 05:14:54','2021-05-14 05:14:54'),(3564,3,'127.0.0.1','Login',NULL,0,0,'2021-05-14 06:00:29','2021-05-14 06:00:29'),(3565,10,'127.0.0.1','Login',NULL,0,0,'2021-05-14 06:02:32','2021-05-14 06:02:32'),(3566,13,'127.0.0.1','Login',NULL,0,0,'2021-05-14 06:08:45','2021-05-14 06:08:45'),(3567,10,'127.0.0.1','Login',NULL,0,0,'2021-05-14 06:20:49','2021-05-14 06:20:49'),(3568,2,'127.0.0.1','Login',NULL,0,0,'2021-05-17 23:55:35','2021-05-17 23:55:35'),(3569,2,'127.0.0.1','Login',NULL,0,0,'2021-05-18 03:16:46','2021-05-18 03:16:46'),(3570,7,'127.0.0.1','Login',NULL,0,0,'2021-05-18 04:11:55','2021-05-18 04:11:55'),(3571,2,'127.0.0.1','Login',NULL,0,0,'2021-05-18 05:40:56','2021-05-18 05:40:56'),(3572,9,'127.0.0.1','Login',NULL,0,0,'2021-05-18 06:02:57','2021-05-18 06:02:57'),(3573,8,'127.0.0.1','Login',NULL,0,0,'2021-05-18 23:56:10','2021-05-18 23:56:10'),(3574,9,'127.0.0.1','Login',NULL,0,0,'2021-05-19 00:04:01','2021-05-19 00:04:01'),(3575,2,'127.0.0.1','Login',NULL,0,0,'2021-05-19 00:58:39','2021-05-19 00:58:39'),(3576,2,'127.0.0.1','Fund release by DIA of Rs.90 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-19 01:02:32','2021-05-19 01:02:32'),(3577,10,'127.0.0.1','Login',NULL,0,0,'2021-05-19 01:03:06','2021-05-19 01:03:06'),(3578,10,'127.0.0.1','Generated Receipt of Actual detail reference id d8b3f05c-07c1-4af8-9628-b17ca993cd25','mfp_procurement_tribal_detail_form',0,0,'2021-05-19 01:05:31','2021-05-19 01:05:31'),(3579,10,'127.0.0.1','added Mfp Storage detail ','mfp_procurement_tribal_detail_form',0,0,'2021-05-19 01:06:31','2021-05-19 01:06:31'),(3580,2,'127.0.0.1','Login',NULL,0,0,'2021-05-19 01:17:42','2021-05-19 01:17:42'),(3581,2,'127.0.0.1','Login',NULL,0,0,'2021-05-19 01:18:02','2021-05-19 01:18:02'),(3582,2,'127.0.0.1','Fund release by DIA of Rs.0.9 of proposal id 23000063 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-05-19 01:20:42','2021-05-19 01:20:42'),(3583,10,'127.0.0.1','Login',NULL,0,0,'2021-05-19 03:14:11','2021-05-19 03:14:11'),(3584,10,'127.0.0.1','Send proposal to next level userdia_manipur_level1 transaction id - 13','mfp_procurement_aproval',0,0,'2021-05-19 03:37:47','2021-05-19 03:37:47'),(3585,3,'127.0.0.1','Login',NULL,0,0,'2021-05-19 03:38:35','2021-05-19 03:38:35'),(3586,1,'127.0.0.1','Login',NULL,0,0,'2021-05-19 03:42:51','2021-05-19 03:42:51'),(3587,1,'127.0.0.1','User Role',NULL,0,0,'2021-05-19 03:42:55','2021-05-19 03:42:55'),(3588,1,'127.0.0.1','Permission Mapping View',NULL,0,0,'2021-05-19 03:43:01','2021-05-19 03:43:01'),(3589,1,'127.0.0.1','Role View',NULL,0,0,'2021-05-19 03:43:01','2021-05-19 03:43:01'),(3590,10,'127.0.0.1','added Mfp Storage detail ','mfp_procurement_tribal_detail_form',0,0,'2021-05-19 03:52:27','2021-05-19 03:52:27'),(3591,10,'127.0.0.1','Login',NULL,0,0,'2021-05-28 01:32:23','2021-05-28 01:32:23'),(3592,10,'127.0.0.1','Login',NULL,0,0,'2021-05-28 04:18:22','2021-05-28 04:18:22'),(3593,10,'127.0.0.1','added Mfp Storage detail ','mfp_procurement_tribal_detail_form',0,0,'2021-05-28 04:20:50','2021-05-28 04:20:50'),(3600,10,'127.0.0.1','Send proposal to next level userdia_manipur_level1 transaction id - 25','mfp_procurement_aproval',0,0,'2021-05-28 05:14:23','2021-05-28 05:14:23'),(3601,3,'127.0.0.1','Login',NULL,0,0,'2021-05-28 05:14:53','2021-05-28 05:14:53'),(3602,10,'127.0.0.1','Login',NULL,0,0,'2021-05-30 23:16:46','2021-05-30 23:16:46'),(3603,9,'127.0.0.1','Login',NULL,0,0,'2021-05-30 23:32:05','2021-05-30 23:32:05'),(3604,7,'127.0.0.1','Login',NULL,0,0,'2021-05-30 23:33:05','2021-05-30 23:33:05'),(3605,7,'127.0.0.1','Created Mfp','mfp_procurement',0,0,'2021-05-30 23:33:44','2021-05-30 23:33:44'),(3606,2,'127.0.0.1','Login',NULL,0,0,'2021-05-31 00:39:11','2021-05-31 00:39:11'),(3607,2,'127.0.0.1','Login',NULL,0,0,'2021-05-31 00:53:13','2021-05-31 00:53:13'),(3608,2,'127.0.0.1','Login',NULL,0,0,'2021-05-31 04:12:12','2021-05-31 04:12:12'),(3609,2,'127.0.0.1','Login',NULL,0,0,'2021-05-31 05:28:58','2021-05-31 05:28:58'),(3610,8,'127.0.0.1','Login',NULL,0,0,'2021-05-31 05:55:49','2021-05-31 05:55:49'),(3611,2,'127.0.0.1','Login',NULL,0,0,'2021-05-31 06:09:46','2021-05-31 06:09:46'),(3612,1,'127.0.0.1','Login',NULL,0,0,'2021-05-31 06:11:54','2021-05-31 06:11:54'),(3613,0,'127.0.0.1','Login Failed With Username :nodaa_manipur_level2',NULL,0,0,'2021-06-01 00:32:03','2021-06-01 00:32:03'),(3614,8,'127.0.0.1','Login',NULL,0,0,'2021-06-01 00:32:15','2021-06-01 00:32:15'),(3615,4,'127.0.0.1','Login',NULL,0,0,'2021-06-01 00:32:56','2021-06-01 00:32:56'),(3616,10,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:39:46','2021-06-02 00:39:46'),(3617,2,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:41:00','2021-06-02 00:41:00'),(3618,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000067','mfp_procurement',0,0,'2021-06-02 00:46:52','2021-06-02 00:46:52'),(3619,3,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:47:15','2021-06-02 00:47:15'),(3620,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:47:43','2021-06-02 00:47:43'),(3621,3,'127.0.0.1','approved MFP procurement proposal id - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:47:43','2021-06-02 00:47:43'),(3622,4,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:48:09','2021-06-02 00:48:09'),(3623,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:48:28','2021-06-02 00:48:28'),(3624,4,'127.0.0.1','approved MFP procurement proposal id - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:48:28','2021-06-02 00:48:28'),(3625,13,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:48:45','2021-06-02 00:48:45'),(3626,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:49:04','2021-06-02 00:49:04'),(3627,13,'127.0.0.1','approved MFP procurement proposal id - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:49:04','2021-06-02 00:49:04'),(3628,5,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:49:23','2021-06-02 00:49:23'),(3629,5,'127.0.0.1','approved MFP procurement proposal id - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:49:40','2021-06-02 00:49:40'),(3630,6,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:50:09','2021-06-02 00:50:09'),(3631,5,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:50:39','2021-06-02 00:50:39'),(3632,5,'127.0.0.1','Proposal consolidated into 23_55 of proposal ids - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:51:00','2021-06-02 00:51:00'),(3633,6,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:51:24','2021-06-02 00:51:24'),(3634,6,'127.0.0.1','Proposal id 23000067 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-06-02 00:51:49','2021-06-02 00:51:49'),(3635,6,'127.0.0.1','Approved MFP procurement proposal ids - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:51:49','2021-06-02 00:51:49'),(3636,8,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:52:20','2021-06-02 00:52:20'),(3637,8,'127.0.0.1','Proposal id 23000067 assigned to ministry','mfp_procurement_aproval',0,0,'2021-06-02 00:53:37','2021-06-02 00:53:37'),(3638,8,'127.0.0.1','Approved MFP procurement proposal ids - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:53:38','2021-06-02 00:53:38'),(3639,9,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:53:59','2021-06-02 00:53:59'),(3640,9,'127.0.0.1','Approved MFP procurement proposal ids - 23000067','mfp_procurement_aproval',0,0,'2021-06-02 00:54:27','2021-06-02 00:54:27'),(3641,9,'127.0.0.1','Sanction Rs.638256.7969 of consolidation id 23_55','mfp_procurement_fund_sanctioned',0,0,'2021-06-02 00:55:00','2021-06-02 00:55:00'),(3642,8,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:55:21','2021-06-02 00:55:21'),(3643,8,'127.0.0.1','Sanction Rs.212752.2656 of consolidation id 23_55','mfp_procurement_fund_sanctioned',0,0,'2021-06-02 00:55:40','2021-06-02 00:55:40'),(3644,8,'127.0.0.1','Fund release Rs.851009.0625 of consolidation id 23_55','mfp_procurement_fund_release',0,0,'2021-06-02 00:56:15','2021-06-02 00:56:15'),(3645,6,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:56:32','2021-06-02 00:56:32'),(3646,6,'127.0.0.1','Fund release Rs.808458.6094 of consolidation id 23_55','mfp_procurement_fund_release',0,0,'2021-06-02 00:57:07','2021-06-02 00:57:07'),(3647,2,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:57:30','2021-06-02 00:57:30'),(3648,2,'127.0.0.1','Fund release by DIA of Rs.450000 of proposal id 23000067 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-06-02 00:59:31','2021-06-02 00:59:31'),(3649,10,'127.0.0.1','Login',NULL,0,0,'2021-06-02 00:59:56','2021-06-02 00:59:56'),(3650,10,'127.0.0.1','added tribal detail form of reference number 5fe665ad-bc4e-4ae9-8338-3ef32675a996','mfp_procurement_tribal_detail_form',0,0,'2021-06-02 01:03:11','2021-06-02 01:03:11'),(3651,10,'127.0.0.1','Generated Receipt of Actual detail reference id 5fe665ad-bc4e-4ae9-8338-3ef32675a996','mfp_procurement_tribal_detail_form',0,0,'2021-06-02 01:03:21','2021-06-02 01:03:21'),(3652,10,'127.0.0.1','added Mfp Storage detail ','mfp_procurement_tribal_detail_form',0,0,'2021-06-02 01:03:55','2021-06-02 01:03:55'),(3653,2,'127.0.0.1','Login',NULL,0,0,'2021-06-02 01:47:53','2021-06-02 01:47:53'),(3654,1,'127.0.0.1','Login',NULL,0,0,'2021-06-02 01:57:44','2021-06-02 01:57:44'),(3655,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 01:59:57','2021-06-02 01:59:57'),(3656,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:02:08','2021-06-02 02:02:08'),(3657,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:03:56','2021-06-02 02:03:56'),(3658,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:04:32','2021-06-02 02:04:32'),(3659,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:06:30','2021-06-02 02:06:30'),(3660,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:09:52','2021-06-02 02:09:52'),(3661,1,'127.0.0.1','added commision master  ','master',0,0,'2021-06-02 02:17:58','2021-06-02 02:17:58'),(3662,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:18:15','2021-06-02 02:18:15'),(3663,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:18:49','2021-06-02 02:18:49'),(3664,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:23:12','2021-06-02 02:23:12'),(3665,1,'127.0.0.1','added commision master  ','master',0,0,'2021-06-02 02:26:25','2021-06-02 02:26:25'),(3666,1,'127.0.0.1','added commision master  ','master',0,0,'2021-06-02 02:26:45','2021-06-02 02:26:45'),(3667,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 02:38:14','2021-06-02 02:38:14'),(3668,1,'127.0.0.1','Login',NULL,0,0,'2021-06-02 03:13:31','2021-06-02 03:13:31'),(3669,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 03:16:08','2021-06-02 03:16:08'),(3670,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 03:17:48','2021-06-02 03:17:48'),(3671,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 03:18:27','2021-06-02 03:18:27'),(3672,1,'127.0.0.1','Login',NULL,0,0,'2021-06-02 04:00:58','2021-06-02 04:00:58'),(3673,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-02 04:03:05','2021-06-02 04:03:05'),(3674,1,'127.0.0.1','added commision master  ','master',0,0,'2021-06-02 04:03:55','2021-06-02 04:03:55'),(3675,2,'127.0.0.1','Login',NULL,0,0,'2021-06-03 06:46:17','2021-06-03 06:46:17'),(3676,9,'127.0.0.1','Login',NULL,0,0,'2021-06-03 07:44:29','2021-06-03 07:44:29'),(3677,13,'127.0.0.1','Login',NULL,0,0,'2021-06-03 23:36:48','2021-06-03 23:36:48'),(3678,6,'127.0.0.1','Login',NULL,0,0,'2021-06-03 23:37:58','2021-06-03 23:37:58'),(3679,8,'127.0.0.1','Login',NULL,0,0,'2021-06-04 00:27:45','2021-06-04 00:27:45'),(3680,2,'127.0.0.1','Login',NULL,0,0,'2021-06-04 06:56:20','2021-06-04 06:56:20'),(3681,2,'127.0.0.1','Login',NULL,0,0,'2021-06-04 07:34:49','2021-06-04 07:34:49'),(3682,2,'127.0.0.1','Login',NULL,0,0,'2021-06-08 00:46:40','2021-06-08 00:46:40'),(3683,1,'127.0.0.1','Login',NULL,0,0,'2021-06-09 00:01:57','2021-06-09 00:01:57'),(3684,1,'127.0.0.1','updated haat item master  Haat one','master',0,0,'2021-06-09 00:22:37','2021-06-09 00:22:37'),(3685,1,'127.0.0.1','updated haat item master  Haat oneone','master',0,0,'2021-06-09 00:26:41','2021-06-09 00:26:41'),(3686,1,'127.0.0.1','updated haat item master  Haat one','master',0,0,'2021-06-09 00:26:51','2021-06-09 00:26:51'),(3687,1,'127.0.0.1','updated haat item master  haat two','master',0,0,'2021-06-09 00:27:08','2021-06-09 00:27:08'),(3688,1,'127.0.0.1','updated haat item master  haat two','master',0,0,'2021-06-09 00:27:25','2021-06-09 00:27:25'),(3689,1,'127.0.0.1','added commision master  ','master',0,0,'2021-06-09 00:45:53','2021-06-09 00:45:53'),(3690,1,'127.0.0.1','updated commision master  ','master',0,0,'2021-06-09 00:46:05','2021-06-09 00:46:05'),(3691,1,'127.0.0.1','updated haat item master  Haat one','master',0,0,'2021-06-09 00:47:53','2021-06-09 00:47:53'),(3692,1,'127.0.0.1','Login',NULL,0,0,'2021-06-09 03:24:56','2021-06-09 03:24:56'),(3693,2,'127.0.0.1','Login',NULL,0,0,'2021-06-09 04:10:11','2021-06-09 04:10:11'),(3694,2,'127.0.0.1','Login',NULL,0,0,'2021-06-09 23:11:00','2021-06-09 23:11:00'),(3695,1,'127.0.0.1','Login',NULL,0,0,'2021-06-09 23:14:31','2021-06-09 23:14:31'),(3696,2,'127.0.0.1','Login',NULL,0,0,'2021-06-09 23:15:52','2021-06-09 23:15:52'),(3697,1,'127.0.0.1','Level List',NULL,0,0,'2021-06-09 23:25:09','2021-06-09 23:25:09'),(3698,1,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:00:07','2021-06-11 01:00:07'),(3699,2,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:01:13','2021-06-11 01:01:13'),(3700,2,'127.0.0.1','Submitted MFP Procurement form of proposal id -23000001','mfp_procurement',0,0,'2021-06-11 01:01:57','2021-06-11 01:01:57'),(3701,3,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:03:17','2021-06-11 01:03:17'),(3702,3,'127.0.0.1','Send proposal to next level userdia_manipur_level2 proposal id - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:04:01','2021-06-11 01:04:01'),(3703,3,'127.0.0.1','approved MFP procurement proposal id - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:04:07','2021-06-11 01:04:07'),(3704,4,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:04:46','2021-06-11 01:04:46'),(3705,4,'127.0.0.1','Send proposal to next level userdia_manipur_level3 proposal id - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:05:10','2021-06-11 01:05:10'),(3706,4,'127.0.0.1','approved MFP procurement proposal id - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:05:17','2021-06-11 01:05:17'),(3707,13,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:06:11','2021-06-11 01:06:11'),(3708,13,'127.0.0.1','Send proposal to next level usersia_manipur_level1 proposal id - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:06:37','2021-06-11 01:06:37'),(3709,13,'127.0.0.1','approved MFP procurement proposal id - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:06:42','2021-06-11 01:06:42'),(3710,5,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:07:37','2021-06-11 01:07:37'),(3711,5,'127.0.0.1','approved MFP procurement proposal id - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:08:00','2021-06-11 01:08:00'),(3712,5,'127.0.0.1','Proposal consolidated into 23_1 of proposal ids - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:08:13','2021-06-11 01:08:13'),(3713,6,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:08:51','2021-06-11 01:08:51'),(3714,6,'127.0.0.1','Proposal id 23000001 assigned to nodal_manipur_level2','mfp_procurement_aproval',0,0,'2021-06-11 01:09:16','2021-06-11 01:09:16'),(3715,6,'127.0.0.1','Approved MFP procurement proposal ids - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:09:21','2021-06-11 01:09:21'),(3716,8,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:09:59','2021-06-11 01:09:59'),(3717,8,'127.0.0.1','Proposal id 23000001 assigned to ministry','mfp_procurement_aproval',0,0,'2021-06-11 01:10:18','2021-06-11 01:10:18'),(3718,8,'127.0.0.1','Approved MFP procurement proposal ids - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:10:24','2021-06-11 01:10:24'),(3719,9,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:11:07','2021-06-11 01:11:07'),(3720,9,'127.0.0.1','Approved MFP procurement proposal ids - 23000001','mfp_procurement_aproval',0,0,'2021-06-11 01:11:36','2021-06-11 01:11:36'),(3721,9,'127.0.0.1','Sanction Rs.206696.4337 of consolidation id 23_1','mfp_procurement_fund_sanctioned',0,0,'2021-06-11 01:12:36','2021-06-11 01:12:36'),(3722,9,'127.0.0.1','Sanction Rs.0.0001 of consolidation id 23_1','mfp_procurement_fund_sanctioned',0,0,'2021-06-11 01:16:57','2021-06-11 01:16:57'),(3723,8,'127.0.0.1','Login',NULL,0,0,'2021-06-11 01:28:30','2021-06-11 01:28:30'),(3724,8,'127.0.0.1','Sanction Rs.68898.8112 of consolidation id 23_1','mfp_procurement_fund_sanctioned',0,0,'2021-06-11 01:28:54','2021-06-11 01:28:54'),(3725,8,'127.0.0.1','Login',NULL,0,0,'2021-06-11 02:09:21','2021-06-11 02:09:21'),(3726,8,'127.0.0.1','Fund release Rs.13779.7623 of consolidation id 23_1','mfp_procurement_fund_release',0,0,'2021-06-11 02:11:10','2021-06-11 02:11:10'),(3727,6,'127.0.0.1','Login',NULL,0,0,'2021-06-11 02:12:55','2021-06-11 02:12:55'),(3728,1,'127.0.0.1','Login',NULL,0,0,'2021-06-11 02:14:11','2021-06-11 02:14:11'),(3729,1,'127.0.0.1','added commision master  ','master',0,0,'2021-06-11 02:14:52','2021-06-11 02:14:52'),(3730,6,'127.0.0.1','Fund release Rs.654.5387000000001 of consolidation id 23_1','mfp_procurement_fund_release',0,0,'2021-06-11 02:15:04','2021-06-11 02:15:04'),(3731,2,'127.0.0.1','Login',NULL,0,0,'2021-06-11 02:31:00','2021-06-11 02:31:00'),(3732,2,'127.0.0.1','Fund release by DIA of Rs.450 of proposal id 23000001 to procurement agent pa_senapati','mfp_procurement_fund_release',0,0,'2021-06-11 02:32:00','2021-06-11 02:32:00'),(3733,10,'127.0.0.1','Login',NULL,0,0,'2021-06-11 02:32:50','2021-06-11 02:32:50'),(3734,10,'127.0.0.1','Login',NULL,0,0,'2021-06-11 04:33:23','2021-06-11 04:33:23'),(3735,1,'127.0.0.1','Login',NULL,0,0,'2021-06-14 01:47:08','2021-06-14 01:47:08'),(3736,1,'127.0.0.1','Login',NULL,0,0,'2021-06-27 02:10:06','2021-06-27 02:10:06'),(3737,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:10:18','2021-06-27 02:10:18'),(3738,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:10:24','2021-06-27 02:10:24'),(3739,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:10:34','2021-06-27 02:10:34'),(3740,1,'127.0.0.1','User List',NULL,0,0,'2021-06-27 02:10:37','2021-06-27 02:10:37'),(3741,1,'127.0.0.1','Login',NULL,0,0,'2021-06-27 02:13:00','2021-06-27 02:13:00'),(3742,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:13:21','2021-06-27 02:13:21'),(3743,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:15:39','2021-06-27 02:15:39'),(3744,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:17:05','2021-06-27 02:17:05'),(3745,1,'127.0.0.1','User List',NULL,0,0,'2021-06-27 02:17:07','2021-06-27 02:17:07'),(3746,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:17:14','2021-06-27 02:17:14'),(3747,1,'127.0.0.1','Created User',NULL,0,0,'2021-06-27 02:19:17','2021-06-27 02:19:17'),(3748,1,'127.0.0.1','Created User',NULL,0,0,'2021-06-27 02:19:26','2021-06-27 02:19:26'),(3749,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:19:38','2021-06-27 02:19:38'),(3750,1,'127.0.0.1','User Management Role',NULL,0,0,'2021-06-27 02:19:46','2021-06-27 02:19:46');
/*!40000 ALTER TABLE `users_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_allowed_states`
--

DROP TABLE IF EXISTS `users_allowed_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_allowed_states` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `state` bigint(20) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_allowed_states_user_id_index` (`user_id`),
  KEY `users_allowed_states_created_by_index` (`created_by`),
  KEY `users_allowed_states_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_allowed_states`
--

LOCK TABLES `users_allowed_states` WRITE;
/*!40000 ALTER TABLE `users_allowed_states` DISABLE KEYS */;
INSERT INTO `users_allowed_states` VALUES (8,2,2,1,1,'2020-11-30 05:48:00','2020-11-30 05:48:00');
/*!40000 ALTER TABLE `users_allowed_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_mapping`
--

DROP TABLE IF EXISTS `users_mapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_mapping` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) NOT NULL COMMENT 'Parent user.',
  `child_id` bigint(20) NOT NULL COMMENT 'User assigned to parent user.',
  `created_by` bigint(20) NOT NULL COMMENT 'User creating this mapping.',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_mapping_parent_id_index` (`parent_id`),
  KEY `users_mapping_child_id_index` (`child_id`),
  KEY `users_mapping_created_by_index` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_mapping`
--

LOCK TABLES `users_mapping` WRITE;
/*!40000 ALTER TABLE `users_mapping` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_mapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `village_master`
--

DROP TABLE IF EXISTS `village_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `village_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `village_master`
--

LOCK TABLES `village_master` WRITE;
/*!40000 ALTER TABLE `village_master` DISABLE KEYS */;
/*!40000 ALTER TABLE `village_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse_item_master`
--

DROP TABLE IF EXISTS `warehouse_item_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse_item_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` int(11) NOT NULL,
  `cost` decimal(20,4) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse_item_master`
--

LOCK TABLES `warehouse_item_master` WRITE;
/*!40000 ALTER TABLE `warehouse_item_master` DISABLE KEYS */;
INSERT INTO `warehouse_item_master` VALUES (1,'Warehouse one','Warehouse one',2,50.0000,'1',0,0,'2021-06-09 00:48:37','2021-06-09 23:19:07');
/*!40000 ALTER TABLE `warehouse_item_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse_master`
--

DROP TABLE IF EXISTS `warehouse_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `state_id` bigint(20) NOT NULL,
  `district_id` bigint(20) NOT NULL,
  `warehouse` bigint(20) NOT NULL,
  `corresponding_hats` bigint(20) NOT NULL,
  `storage_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_capacity` decimal(20,4) NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouse_master_created_by_index` (`created_by`),
  KEY `warehouse_master_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse_master`
--

LOCK TABLES `warehouse_master` WRITE;
/*!40000 ALTER TABLE `warehouse_master` DISABLE KEYS */;
INSERT INTO `warehouse_master` VALUES (1,23,414,143,312,'Cold',5.0000,'1',1,1,'2021-06-09 23:20:02','2021-06-09 23:20:02',NULL);
/*!40000 ALTER TABLE `warehouse_master` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse_master_block`
--

DROP TABLE IF EXISTS `warehouse_master_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse_master_block` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warehouse_id` bigint(20) NOT NULL,
  `block_id` bigint(20) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouse_master_block_created_by_index` (`created_by`),
  KEY `warehouse_master_block_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse_master_block`
--

LOCK TABLES `warehouse_master_block` WRITE;
/*!40000 ALTER TABLE `warehouse_master_block` DISABLE KEYS */;
INSERT INTO `warehouse_master_block` VALUES (1,1,3797,1,1,'2021-06-09 23:20:02','2021-06-09 23:20:02',NULL);
/*!40000 ALTER TABLE `warehouse_master_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `year_master`
--

DROP TABLE IF EXISTS `year_master`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `year_master` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `year_master`
--

LOCK TABLES `year_master` WRITE;
/*!40000 ALTER TABLE `year_master` DISABLE KEYS */;
INSERT INTO `year_master` VALUES (1,'2016','1',0,0,'2020-10-09 05:02:16','2020-10-09 05:02:16',NULL),(2,'2017','1',0,0,'2020-10-09 05:02:16','2020-10-09 05:02:16',NULL),(3,'2018','1',0,0,'2020-10-09 05:02:16','2020-10-09 05:02:16',NULL),(4,'2019','1',0,0,'2020-10-09 05:02:17','2020-10-09 05:02:17',NULL),(5,'2020','1',0,0,'2020-10-09 05:02:17','2020-10-09 05:02:17',NULL),(6,'2021','1',0,0,'2020-10-09 05:02:17','2020-10-09 05:02:17',NULL);
/*!40000 ALTER TABLE `year_master` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-01 11:37:38
