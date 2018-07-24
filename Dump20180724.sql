CREATE DATABASE  IF NOT EXISTS `luvmanagement_itam` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `luvmanagement_itam`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 10.10.1.6    Database: luvmanagement_itam
-- ------------------------------------------------------
-- Server version	5.5.55-0+deb8u1

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
-- Temporary view structure for view `GetLoginableUsers`
--

DROP TABLE IF EXISTS `GetLoginableUsers`;
/*!50001 DROP VIEW IF EXISTS `GetLoginableUsers`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `GetLoginableUsers` AS SELECT 
 1 AS `cus_pk`,
 1 AS `usr_pk`,
 1 AS `usr_email`,
 1 AS `usr_username`,
 1 AS `usr_password`,
 1 AS `cus_password`,
 1 AS `usr_country`,
 1 AS `cus_acct_fk`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `it_acct`
--

DROP TABLE IF EXISTS `it_acct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_acct` (
  `acct_pk` int(11) NOT NULL AUTO_INCREMENT,
  `acct_creator_fk` int(11) DEFAULT NULL,
  `acct_companyname` varchar(85) DEFAULT NULL,
  `acct_maximum_users` int(11) DEFAULT '3',
  `acct_maximum_equipment` int(11) DEFAULT '10',
  `acct_credit` int(11) DEFAULT NULL,
  `acct_wo_prefix` varchar(25) DEFAULT NULL,
  `acct_wo_starting_number` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`acct_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=18702 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_checklist`
--

DROP TABLE IF EXISTS `it_checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_checklist` (
  `chkl_pk` int(11) NOT NULL AUTO_INCREMENT,
  `chkl_acct_fk` int(11) DEFAULT NULL,
  `chkl_wotjob_fk` int(11) NOT NULL,
  `chkl_jobl_fk` int(11) DEFAULT NULL,
  `chkl_creationDate` datetime DEFAULT NULL,
  `chkl_creator_fk` int(11) DEFAULT NULL,
  `chkl_modifiedDate` datetime DEFAULT NULL,
  PRIMARY KEY (`chkl_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_checklist_item`
--

DROP TABLE IF EXISTS `it_checklist_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_checklist_item` (
  `chkli_pk` int(11) NOT NULL AUTO_INCREMENT,
  `chkli_acct_fk` int(11) DEFAULT NULL,
  `chkli_chkl_fk` int(11) DEFAULT NULL,
  `chkli_jobli_fk` int(11) DEFAULT NULL,
  `chkli_passed` bit(1) DEFAULT NULL,
  `chkli_note` varchar(186) DEFAULT NULL,
  PRIMARY KEY (`chkli_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_cli`
--

DROP TABLE IF EXISTS `it_cli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_cli` (
  `cli_pk` int(11) NOT NULL AUTO_INCREMENT,
  `cli_code` varchar(18) NOT NULL,
  `cli_acct_fk` int(11) NOT NULL,
  `cli_company` varchar(75) DEFAULT NULL,
  `cli_address1` varchar(45) DEFAULT NULL,
  `cli_address2` varchar(45) DEFAULT NULL,
  `cli_postal_code` varchar(45) DEFAULT NULL,
  `cli_city` varchar(45) DEFAULT NULL,
  `cli_phone` varchar(20) DEFAULT NULL,
  `cli_contact_name` varchar(45) DEFAULT NULL,
  `cli_contact_email` varchar(45) DEFAULT NULL,
  `cli_county` varchar(45) DEFAULT NULL,
  `cli_state` varchar(2) DEFAULT NULL,
  `cli_country` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cli_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_con`
--

DROP TABLE IF EXISTS `it_con`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_con` (
  `con_pk` int(11) NOT NULL AUTO_INCREMENT,
  `con_acct_fk` int(11) NOT NULL,
  `con_cli_fk` int(11) DEFAULT NULL,
  `con_fac_fk` int(11) DEFAULT NULL,
  `con_dep_fk` int(11) DEFAULT NULL,
  `con_type` varchar(14) DEFAULT NULL,
  `con_fname` varchar(45) DEFAULT NULL,
  `con_lname` varchar(45) DEFAULT NULL,
  `con_notes` text,
  `con_phone` varchar(11) DEFAULT NULL,
  `con_email` varchar(280) DEFAULT NULL,
  `con_address` varchar(160) DEFAULT NULL,
  `con_postal_code` varchar(19) DEFAULT NULL,
  `con_city` varchar(45) DEFAULT NULL,
  `con_county` varchar(45) DEFAULT NULL,
  `con_state` varchar(86) DEFAULT NULL,
  `con_country` varchar(112) DEFAULT NULL,
  `con_deleteDate` datetime DEFAULT NULL,
  PRIMARY KEY (`con_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_costType`
--

DROP TABLE IF EXISTS `it_costType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_costType` (
  `costType_pk` int(11) NOT NULL AUTO_INCREMENT,
  `costType_acct_fk` int(11) DEFAULT NULL,
  `costType_code` varchar(18) DEFAULT NULL,
  `costType_name` varchar(85) DEFAULT NULL,
  `costType_rateCode_fk` int(11) DEFAULT NULL,
  `costType_unitCost` decimal(18,2) DEFAULT NULL,
  `costType_creator_fk` int(11) DEFAULT NULL,
  `costType_createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`costType_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_counter`
--

DROP TABLE IF EXISTS `it_counter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_counter` (
  `count_pk` int(11) NOT NULL AUTO_INCREMENT,
  `count_acct_fk` int(11) DEFAULT NULL,
  `count_module_fk` int(11) DEFAULT NULL,
  `count_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`count_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_country`
--

DROP TABLE IF EXISTS `it_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_country` (
  `country_pk` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`country_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_county`
--

DROP TABLE IF EXISTS `it_county`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_county` (
  `county_pk` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`county_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_cus`
--

DROP TABLE IF EXISTS `it_cus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_cus` (
  `cus_pk` int(11) NOT NULL AUTO_INCREMENT,
  `cus_acct_fk` int(11) DEFAULT NULL,
  `cus_usr_fk` int(11) DEFAULT NULL,
  `cus_parent_fk` int(11) DEFAULT NULL,
  `cus_companyname` varchar(128) DEFAULT NULL,
  `cus_password` varbinary(2048) DEFAULT NULL,
  PRIMARY KEY (`cus_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=18704 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_dep`
--

DROP TABLE IF EXISTS `it_dep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_dep` (
  `dep_pk` int(11) NOT NULL AUTO_INCREMENT,
  `dep_code` varchar(18) NOT NULL,
  `dep_acct_fk` int(11) NOT NULL,
  `dep_fac_fk` int(11) NOT NULL,
  `dep_name` varchar(45) DEFAULT NULL,
  `dep_desc` varchar(732) DEFAULT NULL,
  `dep_phone` varchar(45) DEFAULT NULL,
  `dep_contact_name` varchar(85) DEFAULT NULL,
  `dep_contact_email` varchar(180) DEFAULT NULL,
  `dep_address1` varchar(45) DEFAULT NULL,
  `dep_address2` varchar(45) DEFAULT NULL,
  `dep_city` varchar(45) DEFAULT NULL,
  `dep_postal_code` int(15) DEFAULT NULL,
  `dep_county` varchar(45) DEFAULT NULL,
  `dep_state` varchar(2) DEFAULT NULL,
  `dep_country` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dep_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_edit_history`
--

DROP TABLE IF EXISTS `it_edit_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_edit_history` (
  `eh_pk` int(11) NOT NULL AUTO_INCREMENT,
  `eh_parent_fk` int(11) DEFAULT NULL,
  `eh_acct_fk` int(11) NOT NULL,
  `eh_usr_fk` int(11) NOT NULL,
  `eh_module_fk` int(11) NOT NULL,
  `eh_field_fk` int(11) NOT NULL,
  `eh_value` varchar(760) DEFAULT NULL,
  `eh_timestamp` datetime NOT NULL,
  `eh_final` bit(1) DEFAULT NULL,
  `eh_original` bit(1) DEFAULT NULL,
  PRIMARY KEY (`eh_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_equip`
--

DROP TABLE IF EXISTS `it_equip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_equip` (
  `eq_pk` int(11) NOT NULL AUTO_INCREMENT,
  `eq_acct_fk` int(11) NOT NULL,
  `eq_parent_fk` int(11) DEFAULT NULL,
  `eq_cli_fk` int(11) DEFAULT NULL,
  `eq_fac_fk` int(11) DEFAULT NULL,
  `eq_dep_fk` int(11) DEFAULT NULL,
  `eq_code` varchar(20) DEFAULT NULL,
  `eq_serial_number` varchar(137) DEFAULT NULL,
  `eq_manufacturer` varchar(120) DEFAULT NULL,
  `eq_model` varchar(120) DEFAULT NULL,
  `eq_item_type` varchar(138) DEFAULT NULL,
  `eq_mac_address` varbinary(6) DEFAULT NULL,
  `eq_ip_address` varchar(15) DEFAULT NULL,
  `eq_subnet` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`eq_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_equip_jobs`
--

DROP TABLE IF EXISTS `it_equip_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_equip_jobs` (
  `eqj_pk` int(11) NOT NULL AUTO_INCREMENT,
  `eqj_eq_fk` int(11) DEFAULT NULL,
  `eqj_jobl_fk` int(11) DEFAULT NULL,
  `eqj_order` int(11) DEFAULT NULL,
  `eqj_required` bit(1) DEFAULT b'0',
  `eqj_acct_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`eqj_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_fac`
--

DROP TABLE IF EXISTS `it_fac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_fac` (
  `fac_pk` int(11) NOT NULL AUTO_INCREMENT,
  `fac_code` varchar(18) NOT NULL,
  `fac_acct_fk` int(11) NOT NULL,
  `fac_cli_fk` int(11) NOT NULL,
  `fac_name` varchar(45) DEFAULT NULL,
  `fac_phone` varchar(20) DEFAULT NULL,
  `fac_address1` varchar(45) DEFAULT NULL,
  `fac_address2` varchar(45) DEFAULT NULL,
  `fac_postal_code` varchar(15) DEFAULT NULL,
  `fac_city` varchar(45) DEFAULT NULL,
  `fac_county` varchar(45) DEFAULT NULL,
  `fac_state` varchar(2) DEFAULT NULL,
  `fac_country` varchar(45) DEFAULT NULL,
  `fac_contact_name` varchar(45) DEFAULT NULL,
  `fac_email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`fac_pk`),
  KEY `fac_cli_fk_idx` (`fac_cli_fk`),
  CONSTRAINT `fac_cli_fk` FOREIGN KEY (`fac_cli_fk`) REFERENCES `it_cli` (`cli_pk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_inventory`
--

DROP TABLE IF EXISTS `it_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_inventory` (
  `inv_pk` int(11) NOT NULL AUTO_INCREMENT,
  `inv_acct_fk` int(11) NOT NULL,
  `inv_parent_fk` int(11) DEFAULT NULL,
  `inv_ratecode_fk` int(11) DEFAULT NULL,
  `inv_cli_fk` int(11) DEFAULT NULL,
  `inv_fac_fk` int(11) DEFAULT NULL,
  `inv_dep_fk` int(11) DEFAULT NULL,
  `inv_code` varchar(20) DEFAULT NULL,
  `inv_serial_number` varchar(137) DEFAULT NULL,
  `inv_manufacturer` varchar(120) DEFAULT NULL,
  `inv_model` varchar(120) DEFAULT NULL,
  `inv_item_type` varchar(138) DEFAULT NULL,
  `inv_createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`inv_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_inventoryStock`
--

DROP TABLE IF EXISTS `it_inventoryStock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_inventoryStock` (
  `invst_pk` int(11) NOT NULL AUTO_INCREMENT,
  `invst_inv_fk` int(11) NOT NULL,
  `invst_acct_fk` int(11) NOT NULL,
  `invst_con_fk` int(11) DEFAULT NULL,
  `invst_ship_fk` int(11) DEFAULT NULL,
  `invst_quantity` decimal(18,2) DEFAULT NULL,
  `invst_cost` decimal(18,2) DEFAULT NULL,
  `invst_adjustment_type` int(1) DEFAULT NULL,
  `invst_notes` text,
  `invst_createdDate` datetime DEFAULT NULL,
  `invst_quantity_left` decimal(18,2) DEFAULT NULL,
  `invst_quantity_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`invst_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_itemType`
--

DROP TABLE IF EXISTS `it_itemType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_itemType` (
  `itemType_pk` int(11) NOT NULL AUTO_INCREMENT,
  `itemType_moduleID` int(11) DEFAULT NULL,
  `itemType_name` varchar(45) DEFAULT NULL,
  `itemType_acct_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`itemType_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_jobLibrary`
--

DROP TABLE IF EXISTS `it_jobLibrary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_jobLibrary` (
  `jobl_pk` int(11) NOT NULL AUTO_INCREMENT,
  `jobl_name` varchar(82) DEFAULT NULL,
  `jobl_acct_fk` int(11) DEFAULT NULL,
  `jobl_code` varchar(45) DEFAULT NULL,
  `jobl_ratecode_fk` int(11) DEFAULT NULL,
  `jobl_description` varchar(732) DEFAULT NULL,
  PRIMARY KEY (`jobl_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_jobLibraryItem`
--

DROP TABLE IF EXISTS `it_jobLibraryItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_jobLibraryItem` (
  `jobli_pk` int(11) NOT NULL AUTO_INCREMENT,
  `jobli_acct_fk` int(11) DEFAULT NULL,
  `jobli_creator_fk` int(11) DEFAULT NULL,
  `jobli_jobl_fk` int(11) DEFAULT NULL,
  `jobli_name` varchar(45) DEFAULT NULL,
  `jobli_order` int(11) DEFAULT NULL,
  `jobli_pass_required` bit(1) DEFAULT b'0',
  `jobli_notes_required` bit(1) DEFAULT b'0',
  `jobli_notes` bit(1) DEFAULT b'0',
  PRIMARY KEY (`jobli_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_part`
--

DROP TABLE IF EXISTS `it_part`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_part` (
  `part_fk` int(11) NOT NULL AUTO_INCREMENT,
  `part_acct_fk` int(11) DEFAULT NULL,
  `part_pur_fk` int(11) DEFAULT NULL,
  `part_code` varchar(45) DEFAULT NULL,
  `part_description` varchar(732) DEFAULT NULL,
  `part_ven_fk` int(11) DEFAULT NULL,
  `part_usr_fk` int(11) DEFAULT NULL COMMENT 'creator user fk',
  `part_createdDate` int(11) DEFAULT NULL,
  `part_cost_adjustment` decimal(18,2) DEFAULT NULL COMMENT 'percentage to adjust the cost of the part if sold regularly',
  PRIMARY KEY (`part_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_partAdjustment`
--

DROP TABLE IF EXISTS `it_partAdjustment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_partAdjustment` (
  `partAdj_pk` int(11) NOT NULL AUTO_INCREMENT,
  `partAdj_acct_fk` varchar(45) DEFAULT NULL,
  `partAdj_part_fk` int(11) DEFAULT NULL,
  `partAdj_quantity` decimal(18,2) DEFAULT NULL,
  `partAdj_quantityType` int(11) DEFAULT NULL,
  `partAdj_unitCost` decimal(18,2) DEFAULT NULL,
  `partAdj_AdjustmentType` int(11) DEFAULT NULL COMMENT '0 = new purchase\n1 = sold item\n2 = Manual Adjustment',
  `partAdj_creator_fk` int(11) DEFAULT NULL COMMENT 'usr_fk the creator of the record',
  `partAdj_createdDate` datetime DEFAULT NULL,
  `partAdj_con_fk` int(11) DEFAULT NULL COMMENT 'who we sold it too. or bought it from depending on situation.',
  PRIMARY KEY (`partAdj_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_pm_schedule`
--

DROP TABLE IF EXISTS `it_pm_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_pm_schedule` (
  `pms_pk` int(11) NOT NULL AUTO_INCREMENT,
  `pms_acct_fk` int(11) DEFAULT NULL,
  `pms_item_fk` int(11) DEFAULT NULL,
  `pms_item_type` int(11) DEFAULT NULL COMMENT '1 = Equipment, 2 = IT Equipment, 3 = Product',
  `pms_interval_type` int(11) DEFAULT NULL COMMENT '0 = nothing, 1 = meter, 2 = days, 3 = months, 4 = year',
  `pms_interval` int(11) DEFAULT NULL COMMENT 'This is the number that belongs to the interval type to specify how often the pm work order will be made.',
  `pms_daysPriorCreate` int(11) DEFAULT NULL COMMENT 'this is the amount of days to create the work order before the pm date if not null or more than 0 than automated pm''s are enabled.',
  `pms_startDate` datetime DEFAULT NULL,
  `pms_nextDate` datetime DEFAULT NULL,
  `pms_wo_wtype_fk` int(11) DEFAULT NULL,
  `pms_wo_woss_fk` int(11) DEFAULT NULL,
  `pms_wo_rateCode_fk` int(11) DEFAULT NULL,
  `pms_wo_creator_fk` int(11) DEFAULT NULL,
  `pms_wo_assigned_fk` int(11) DEFAULT NULL,
  `pms_wo_requestor_fk` int(11) DEFAULT NULL,
  `pms_wo_jobl_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`pms_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_prod`
--

DROP TABLE IF EXISTS `it_prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_prod` (
  `prod_pk` int(11) NOT NULL AUTO_INCREMENT,
  `prod_acct_fk` int(11) NOT NULL,
  `prod_cli_fk` int(11) DEFAULT NULL,
  `prod_fac_fk` int(11) DEFAULT NULL,
  `prod_dep_fk` int(11) DEFAULT NULL,
  `prod_ven_fk` int(11) NOT NULL,
  `prod_name` varchar(80) DEFAULT NULL,
  `prod_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`prod_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='IT Software Product';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_purchase`
--

DROP TABLE IF EXISTS `it_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_purchase` (
  `pur_pk` int(11) NOT NULL,
  `pur_acct_fk` int(11) NOT NULL,
  `pur_creator_fk` int(11) NOT NULL,
  `pur_ven_fk` int(11) DEFAULT NULL,
  `pur_distributor` varchar(128) DEFAULT NULL,
  `pur_item_fk` int(11) NOT NULL,
  `pur_itemType` int(11) NOT NULL COMMENT 'Item Type 1 is equipment item type 2 is software for now.',
  `pur_price` decimal(18,2) NOT NULL,
  `pur_quantity` int(11) NOT NULL,
  `pur_date` datetime DEFAULT NULL,
  `pur_approver` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`pur_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_rateCode`
--

DROP TABLE IF EXISTS `it_rateCode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_rateCode` (
  `rateCode_pk` int(11) NOT NULL AUTO_INCREMENT,
  `rateCode_acct_fk` int(11) NOT NULL,
  `rateCode_name` varchar(45) DEFAULT NULL,
  `rateCode_code` varchar(18) DEFAULT NULL,
  `rateCode_hourly_cost` decimal(18,2) DEFAULT NULL,
  `rateCode_part_multiplier` decimal(18,2) DEFAULT NULL,
  `rateCode_labor_multiplier` decimal(18,2) DEFAULT NULL,
  `rateCode_charge_multiplier` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`rateCode_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_rentable`
--

DROP TABLE IF EXISTS `it_rentable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_rentable` (
  `ren_pk` int(11) NOT NULL AUTO_INCREMENT,
  `ren_acct_fk` int(11) NOT NULL,
  `ren_inv_fk` int(11) DEFAULT NULL,
  `ren_invst_fk` int(11) DEFAULT NULL,
  `ren_con_fk` int(11) DEFAULT NULL,
  `ren_createdDate` datetime DEFAULT NULL,
  `ren_shippedDate` datetime DEFAULT NULL,
  `ren_arrivedDate` datetime DEFAULT NULL,
  `ren_startDate` datetime DEFAULT NULL,
  `ren_endDate` datetime DEFAULT NULL,
  `ren_completed` datetime DEFAULT NULL,
  PRIMARY KEY (`ren_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_shipping`
--

DROP TABLE IF EXISTS `it_shipping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_shipping` (
  `ship_pk` int(11) NOT NULL AUTO_INCREMENT,
  `ship_acct_fk` int(11) NOT NULL,
  `ship_tag_fk` int(11) DEFAULT NULL,
  `ship_tag_type_fk` int(11) DEFAULT NULL,
  `ship_desc` text,
  PRIMARY KEY (`ship_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_shiptrack`
--

DROP TABLE IF EXISTS `it_shiptrack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_shiptrack` (
  `stra_pk` int(11) NOT NULL AUTO_INCREMENT,
  `stra_acct_fk` int(11) NOT NULL,
  `stra_ship_fk` int(11) DEFAULT NULL,
  `stra_start_date` datetime DEFAULT NULL,
  `stra_end_date` datetime DEFAULT NULL,
  `stra_tracking_number` varchar(236) DEFAULT NULL,
  `stra_desc` text,
  PRIMARY KEY (`stra_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_soft_item`
--

DROP TABLE IF EXISTS `it_soft_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_soft_item` (
  `sitem_pk` int(11) NOT NULL AUTO_INCREMENT,
  `sitem_acct_fk` int(11) DEFAULT NULL,
  `sitem_cli_fk` int(11) DEFAULT NULL,
  `sitem_fac_fk` int(11) DEFAULT NULL,
  `sitem_dep_fk` int(11) DEFAULT NULL,
  `sitem_prod_fk` int(11) DEFAULT NULL,
  `sitem_eq_fk` int(11) DEFAULT NULL,
  `sitem_usr_fk` int(11) DEFAULT NULL,
  `sitem_key` varchar(512) DEFAULT NULL,
  `sitem_seats` int(11) DEFAULT '1',
  `sitem_start` datetime DEFAULT NULL,
  `sitem_end` datetime DEFAULT NULL,
  `sitem_expires` bit(1) DEFAULT NULL,
  PRIMARY KEY (`sitem_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='IT Software Assignable Key';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_state`
--

DROP TABLE IF EXISTS `it_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_state` (
  `state_pk` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`state_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_sug`
--

DROP TABLE IF EXISTS `it_sug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_sug` (
  `sug_pk` int(11) NOT NULL AUTO_INCREMENT,
  `sug_parent_fk` int(11) DEFAULT NULL,
  `sug_acct_fk` int(11) NOT NULL,
  `sug_creator_fk` int(11) NOT NULL,
  `sug_subject` varchar(75) DEFAULT NULL,
  `sug_message` varchar(400) NOT NULL,
  `sug_date` datetime NOT NULL,
  PRIMARY KEY (`sug_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_user_salt`
--

DROP TABLE IF EXISTS `it_user_salt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_user_salt` (
  `usalt_pk` int(11) NOT NULL AUTO_INCREMENT,
  `usalt_usr_fk` int(11) DEFAULT NULL,
  `usalt_secret` varchar(45) NOT NULL,
  `usalt_createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`usalt_pk`),
  UNIQUE KEY `usalt_usr_fk_UNIQUE` (`usalt_usr_fk`)
) ENGINE=InnoDB AUTO_INCREMENT=2378 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_usr`
--

DROP TABLE IF EXISTS `it_usr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_usr` (
  `usr_pk` int(11) NOT NULL AUTO_INCREMENT,
  `usr_acct_fk` int(11) DEFAULT NULL,
  `usr_cli_fk` int(11) DEFAULT NULL,
  `usr_fac_fk` int(11) DEFAULT NULL,
  `usr_dep_fk` int(11) DEFAULT NULL,
  `usr_fname` varchar(85) DEFAULT NULL,
  `usr_lname` varchar(85) DEFAULT NULL,
  `usr_address1` varchar(45) DEFAULT NULL,
  `usr_address2` varchar(45) DEFAULT NULL,
  `usr_postal_code` varchar(15) DEFAULT NULL,
  `usr_city` varchar(90) DEFAULT NULL,
  `usr_state` varchar(2) DEFAULT NULL,
  `usr_county` varchar(128) DEFAULT NULL,
  `usr_country` varchar(162) DEFAULT NULL,
  `usr_username` varchar(72) DEFAULT NULL,
  `usr_email` varchar(150) DEFAULT NULL,
  `usr_password` varbinary(2048) DEFAULT NULL,
  `usr_domain` varchar(100) DEFAULT NULL,
  `usr_netbios` varchar(45) DEFAULT NULL,
  `usr_ou` varchar(45) DEFAULT NULL,
  `usr_portal_login` bit(1) DEFAULT b'0',
  `usr_title` varchar(80) DEFAULT NULL,
  `usr_manager` varchar(80) DEFAULT NULL,
  `usr_phonenumber` varchar(18) DEFAULT NULL,
  `usr_rateCode_fk` int(11) DEFAULT NULL,
  `usr_hourly_cost` decimal(18,2) DEFAULT NULL,
  `usr_hire_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`usr_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=3359 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_ven`
--

DROP TABLE IF EXISTS `it_ven`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_ven` (
  `ven_pk` int(11) NOT NULL AUTO_INCREMENT,
  `ven_acct_fk` int(11) DEFAULT NULL,
  `ven_cli_fk` int(11) DEFAULT NULL,
  `ven_fac_fk` int(11) DEFAULT NULL,
  `ven_dep_fk` int(11) DEFAULT NULL,
  `ven_con_fk` int(11) DEFAULT NULL,
  `ven_name` varchar(85) DEFAULT NULL,
  `ven_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ven_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorder`
--

DROP TABLE IF EXISTS `it_workorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorder` (
  `wo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wo_acct_fk` int(11) DEFAULT NULL,
  `wo_cli_fk` int(11) DEFAULT NULL,
  `wo_fac_fk` int(11) DEFAULT NULL,
  `wo_dep_fk` int(11) DEFAULT NULL,
  `wo_ss_fk` int(11) DEFAULT NULL,
  `wo_number` varchar(75) DEFAULT NULL,
  `wo_item_fk` int(11) DEFAULT NULL,
  `wo_itemType_fk` int(11) DEFAULT NULL,
  `wo_charge` bit(1) DEFAULT b'0',
  `wo_notify` bit(1) DEFAULT b'0',
  `wo_wtype_fk` int(11) DEFAULT NULL,
  `wo_requestDate` datetime DEFAULT NULL,
  `wo_startDate` datetime DEFAULT NULL,
  `wo_endDate` datetime DEFAULT NULL,
  `wo_request` varchar(768) DEFAULT NULL,
  `wo_con_fk` int(11) DEFAULT NULL,
  `wo_creator_fk` int(11) DEFAULT NULL,
  `wo_createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`wo_pk`),
  UNIQUE KEY `wo_number_UNIQUE` (`wo_number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderCost`
--

DROP TABLE IF EXISTS `it_workorderCost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderCost` (
  `wocost_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wocost_acct_fk` int(11) DEFAULT NULL,
  `wocost_wotask_fk` int(11) DEFAULT NULL,
  `wocost_rateCode_fk` int(11) DEFAULT NULL,
  `wocost_costType_fk` int(11) DEFAULT NULL,
  `wocost_quantity` decimal(18,2) DEFAULT NULL,
  `wocost_creator_fk` int(11) DEFAULT NULL,
  `wocost_createdDate` datetime DEFAULT NULL,
  `wocost_completionDate` datetime DEFAULT NULL,
  PRIMARY KEY (`wocost_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderLabor`
--

DROP TABLE IF EXISTS `it_workorderLabor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderLabor` (
  `wolabor_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wolabor_acct_fk` int(11) DEFAULT NULL,
  `wolabor_wotask_fk` int(11) DEFAULT NULL,
  `wolabor_rateCode_fk` int(11) DEFAULT NULL,
  `wolabor_costType_fk` int(11) DEFAULT NULL,
  `wolabor_quantity` decimal(18,2) DEFAULT NULL,
  `wolabor_creator_fk` int(11) DEFAULT NULL,
  `wolabor_createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`wolabor_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderLaborComment`
--

DROP TABLE IF EXISTS `it_workorderLaborComment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderLaborComment` (
  `wolaborcom_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wolaborcom_acct_fk` int(11) DEFAULT NULL,
  `wolaborcom_wolabor_fk` int(11) DEFAULT NULL,
  `wolaborcom_wotask_fk` int(11) DEFAULT NULL,
  `wolaborcom_creator_fk` int(11) DEFAULT NULL,
  `wolaborcom_createdDate` datetime DEFAULT NULL,
  `wolaborcom_comment` text,
  `wolaborcom_customerComment` bit(1) DEFAULT NULL,
  PRIMARY KEY (`wolaborcom_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderPart`
--

DROP TABLE IF EXISTS `it_workorderPart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderPart` (
  `wopart_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wopart_wotask_fk` int(11) DEFAULT NULL,
  `wopart_acct_fk` int(11) DEFAULT NULL,
  `wopart_rateCode_fk` int(11) DEFAULT NULL,
  `wopart_partAdj_fk` int(11) DEFAULT NULL,
  `wopart_part_fk` int(11) DEFAULT NULL,
  `wopart_creator_fk` int(11) DEFAULT NULL,
  `wopart_noCharge` bit(1) DEFAULT NULL,
  `wopart_createdDate` datetime DEFAULT NULL,
  PRIMARY KEY (`wopart_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderStatus`
--

DROP TABLE IF EXISTS `it_workorderStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderStatus` (
  `woss_pk` int(11) NOT NULL AUTO_INCREMENT,
  `woss_acct_fk` int(11) DEFAULT NULL,
  `woss_name` varchar(45) DEFAULT NULL,
  `woss_code` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`woss_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderTask`
--

DROP TABLE IF EXISTS `it_workorderTask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderTask` (
  `wotask_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wotask_wo_fk` int(11) DEFAULT NULL,
  `wotask_rateCode_fk` int(11) DEFAULT NULL,
  `wotask_usr_fk` int(11) DEFAULT NULL,
  `wotask_createdDate` datetime DEFAULT NULL,
  `wotask_completionDate` datetime DEFAULT NULL,
  `wotask_dueDate` datetime DEFAULT NULL,
  `wotask_issueCode_fk` int(11) DEFAULT NULL,
  `wotask_failed` bit(1) DEFAULT NULL,
  `wotask_notlocated` bit(1) DEFAULT NULL,
  PRIMARY KEY (`wotask_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderTaskComment`
--

DROP TABLE IF EXISTS `it_workorderTaskComment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderTaskComment` (
  `wotaskcom_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wotaskcom_acct_fk` int(11) DEFAULT NULL,
  `wotaskcom_wotask_fk` int(11) DEFAULT NULL,
  `wotaskcom_usr_fk` int(11) DEFAULT NULL,
  `wotaskcom_createdDate` datetime DEFAULT NULL,
  `wotaskcom_comment` text,
  `wotaskcom_customerComment` bit(1) DEFAULT NULL,
  PRIMARY KEY (`wotaskcom_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderTaskJobs`
--

DROP TABLE IF EXISTS `it_workorderTaskJobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderTaskJobs` (
  `wotjob_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wotjob_wotask_fk` int(11) DEFAULT NULL,
  `wotjob_jobl_fk` int(11) DEFAULT NULL,
  `wotjob_chkl_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`wotjob_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderTaskSchedule`
--

DROP TABLE IF EXISTS `it_workorderTaskSchedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderTaskSchedule` (
  `wotaskSchedule_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wotaskSchedule_acct_fk` int(11) DEFAULT NULL,
  `wotaskSchedule_woTask_fk` int(11) DEFAULT NULL,
  `wotaskSchedule_usr_fk` int(11) DEFAULT NULL COMMENT 'The assigned technician to the repair.',
  `wotaskSchedule_completionDate` datetime DEFAULT NULL,
  PRIMARY KEY (`wotaskSchedule_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `it_workorderType`
--

DROP TABLE IF EXISTS `it_workorderType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `it_workorderType` (
  `wtype_pk` int(11) NOT NULL AUTO_INCREMENT,
  `wtype_acct_fk` int(11) DEFAULT NULL,
  `wtype_parent_fk` int(11) DEFAULT NULL,
  `wtype_name` varchar(45) DEFAULT NULL,
  `wtype_code` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`wtype_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` char(128) NOT NULL,
  `set_time` char(10) NOT NULL,
  `data` text NOT NULL,
  `session_key` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'luvmanagement_itam'
--

--
-- Dumping routines for database 'luvmanagement_itam'
--
/*!50003 DROP PROCEDURE IF EXISTS `itm_AdminGetAllSuggestions` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_AdminGetAllSuggestions`()
BEGIN
	
		SELECT sug_pk, sug_parent_fk, sug_subject, acct_companyname, usr_username
		FROM it_sug
			LEFT JOIN it_acct ON acct_pk = sug_acct_fk
			LEFT JOIN it_usr ON usr_pk = sug_creator_fk
			WHERE sug_parent_fk IS NULL
			ORDER BY acct_companyname ASC;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_AdminGetSuggestions` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_AdminGetSuggestions`(IN SearchType INT)
BEGIN
	SELECT usr_username, sug_pk, sug_subject, sug_message, sug_date, acct_companyname
	FROM it_sug
		LEFT JOIN it_acct ON acct_pk = sug_acct_fk
		LEFT JOIN it_usr ON usr_pk = sug_creator_fk
		WHERE sug_parent_fk = SearchType OR sug_pk = SearchType
		ORDER BY sug_date ASC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_count` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_count`(IN AccountID INT(11), IN ModuleID INT(11))
BEGIN
	DECLARE Last_number INT(35);
    DECLARE New_Number INT(35);
    SET Last_number = (SELECT count_count FROM it_counter WHERE count_acct_fk = AccountID 
    AND count_module_fk = ModuleID ORDER BY count_count DESC LIMIT 1);
    
    SET New_Number = (Last_number + 1);
    
    INSERT INTO it_counter (`count_acct_fk`,`count_module_fk`,`count_count`) VALUES (AccountID,  ModuleID, New_Number);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateAccount` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateAccount`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT,
IN username VARCHAR(72), IN email_address VARCHAR(150), IN Pwd VARBINARY(2048), IN title VARCHAR(80), 
IN firstname VARCHAR(85), IN lastname VARCHAR(85),
IN manager varchar(80), IN hire_date TIMESTAMP,
IN address1 VARCHAR(45), IN address2 VARCHAR(45),
IN city VARCHAR(90), IN state VARCHAR(2), 
IN county VARCHAR(128), IN country VARCHAR(162), 
IN post_code VARCHAR(15), IN Credits INT, IN PortalLogin BIT, IN ParentID INT)
BEGIN
	DECLARE usr_fk INT;
    DECLARE cus_fk INT;
    DECLARE parent_pk INT;
	DECLARE UserExists INT;
    DECLARE UserExistsName INT;
	DECLARE user_salt_pk INT;
	DECLARE randomSalt VARCHAR(11);
    SET UserExists = (SELECT COUNT(usr_email) FROM it_usr WHERE usr_email = email_address);
    SET UserExistsName = (SELECT COUNT(usr_username) FROM it_usr WHERE usr_username = username);
    IF UserExists > 0 OR UserExistsName > 0 THEN
		SELECT -2 AS 'error';
	ELSE
		CALL itm_GenerateRandomSalt(@rndS);
		SET randomSalt = @rndS;
		INSERT INTO `it_user_salt` (`usalt_secret`, `usalt_createdDate`) VALUES (randomSalt, NOW());
		SET user_salt_pk = LAST_INSERT_ID();
		
		INSERT INTO it_usr (usr_cli_fk, usr_fac_fk, usr_dep_fk, usr_acct_fk, usr_fname, usr_lname, usr_address1, usr_address2, usr_city, usr_state, 
					usr_county, usr_country, usr_postal_code, usr_username, usr_email, usr_password, usr_portal_login, usr_hire_date, usr_manager, usr_title) 
				VALUES (ClientID, FacilityID, DepartmentID, AccountID, firstname, lastname, address1, address2, city, state, 
						county, country, post_code, username, email_address, SHA2(512, CONCAT(randomSalt, Pwd)), PortalLogin, hire_date, manager, title);
		SET usr_fk = LAST_INSERT_ID();
		INSERT INTO it_cus (cus_acct_fk, cus_usr_fk, cus_parent_fk, cus_companyname, cus_password) VALUES (AccountID, usr_fk, ParentID, NULL, SHA2(512, CONCAT(randomSalt, Pwd)));
        SET cus_fk = LAST_INSERT_ID();
		UPDATE `it_user_salt` SET usalt_usr_fk = usr_fk WHERE usalt_pk = user_salt_pk;
        SELECT usr_fk AS 'User ID', cus_fk AS 'Customer ID', AccountID AS 'Account ID';
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateClient` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `itm_CreateClient`(IN AccountID INT, IN cli_code INT, IN Company VARCHAR(75), IN Address1 VARCHAR(45), 
									IN Address2 VARCHAR(45), IN PostalCode VARCHAR(45), IN City VARCHAR(75), IN Phone VARCHAR(20),
									IN ContName VARCHAR(45), IN ContEmail VARCHAR(45), IN County VARCHAR(75), IN State VARCHAR(45), 
                                    IN Country VARCHAR(75))
BEGIN
	INSERT INTO it_cli (`cli_acct_fk`, `cli_code`, `cli_company`, `cli_address1`, `cli_address2`, `cli_postal_code`, `cli_city`, `cli_phone`, 
						`cli_contact_name`, `cli_contact_email`,`cli_county`, `cli_state`, `cli_country`) 
					VALUES (AccountID, cli_code, Company, Address1, Address2, PostalCode, City, Phone,
							ContName, ContEmail, County, State, Country);
	SELECT LAST_INSERT_ID();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateContact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateContact`(
		IN con_acct_fk INT, IN con_cli_fk INT, IN con_fac_fk INT, IN con_dep_fk INT, IN con_type VARCHAR(14), 
		IN con_fname VARCHAR(45), IN con_lname VARCHAR(45), IN con_phone VARCHAR(11), IN con_email VARCHAR(280), 
        IN con_notes TEXT(450), IN con_address VARCHAR(160), IN con_postal_code VARCHAR(19), IN con_city VARCHAR(45), 
        IN con_county VARCHAR(45), IN con_state VARCHAR(86), IN con_country VARCHAR(112))
BEGIN
	
    INSERT INTO it_con (`con_acct_fk`, `con_cli_fk`, `con_fac_fk`, `con_dep_fk`,
						`con_type`, `con_fname`, `con_lname`, `con_phone`, `con_email`,
						`con_notes`, `con_address`, `con_postal_code`, `con_city`,
						`con_county`, `con_state`, `con_country`) 
                        VALUES (con_acct_fk, con_cli_fk, con_fac_fk, con_dep_fk,
								con_type, con_fname, con_lname, con_phone, con_email,
								con_notes, con_address, con_postal_code, con_city,
								con_county, con_state, con_country);
    SELECT LAST_INSERT_ID();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateCustomerAccount` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateCustomerAccount`(IN companyName VARCHAR(85), IN parent_fk INT,
												IN username VARCHAR(72), IN email_address VARCHAR(150), IN Pwd VARBINARY(2048), 
												IN firstname VARCHAR(85), IN lastname VARCHAR(85),
                                                IN address1 VARCHAR(45), IN address2 VARCHAR(45),
												IN city VARCHAR(90), IN state VARCHAR(2), 
                                                IN county VARCHAR(128), IN country VARCHAR(162), 
                                                IN post_code VARCHAR(15), IN MaximumUsers INT, IN MaximumEquipment INT, IN Credits INT)
BEGIN
	DECLARE UserExists INT;
    DECLARE usr_fk INT;
    DECLARE acct_fk INT;
    DECLARE cus_fk INT;
	DECLARE user_salt_pk INT;
	DECLARE randomSalt VARCHAR(11);
    SET UserExists = (SELECT COUNT(usr_email) FROM it_usr WHERE usr_email = email_address);
    IF UserExists > 0 THEN
		SELECT -2 AS 'error';
	ELSE
		CALL itm_GenerateRandomSalt(@rndS);
		SET randomSalt = @rndS;
		INSERT INTO `it_user_salt` (`usalt_secret`, `usalt_createdDate`) VALUES (randomSalt, NOW());
		SET user_salt_pk = LAST_INSERT_ID();
	
		INSERT INTO it_usr (usr_fname, usr_lname, usr_address1, usr_address2, usr_city, usr_state, usr_county, usr_country, usr_postal_code, usr_username, usr_email, usr_password, usr_portal_login) 
					VALUES (firstname, lastname, address1, address2, city, state, county, country, post_code, username, email_address, SHA2(512, CONCAT(randomSalt, Pwd)), 1);
		SET usr_fk = LAST_INSERT_ID();
		UPDATE `it_user_salt` SET `usalt_usr_fk` = usr_fk WHERE `usalt_pk` = user_salt_pk;
		INSERT INTO it_acct (acct_creator_fk, acct_companyname, acct_maximum_users, acct_maximum_equipment, acct_credit) VALUES (usr_fk, companyName, 
								CASE MaximumUsers WHEN NULL THEN 10 ELSE MaximumUsers END, CASE MaximumEquipment WHEN NULL THEN 18 ELSE MaximumEquipment END, Credits);
		SET acct_fk = LAST_INSERT_ID();
		INSERT INTO it_cus (cus_acct_fk, cus_usr_fk, cus_parent_fk, cus_companyname, cus_password) VALUES (acct_fk, usr_fk, parent_fk, companyName, SHA2(512, CONCAT(randomSalt, Pwd)));
        SET cus_fk = LAST_INSERT_ID();
		UPDATE it_usr SET usr_acct_fk = acct_fk WHERE usr_pk = usr_fk;
        /*INSERT INTO it_column_labels 
			(`cola_acct_fk`, `cola_column`, `cola_label`, `cola_user_label`, `cola_table`)
				SELECT acct_fk, `cola_column`, `cola_label`, `cola_user_label`, `cola_table` 
					FROM `it_column_labels` 
						WHERE `cola_acct_fk` = 0;*/
        SELECT usr_fk AS 'User ID', cus_fk AS 'Customer ID', acct_fk AS 'Account ID';
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateDepartment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateDepartment`(IN AccountID INT, IN FacilityID INT, IN DepartmentCode VARCHAR(18), 
										IN DepartmentName VARCHAR(45), IN contact_name VARCHAR(80), IN phone VARCHAR(45), 
                                        IN contact_email VARCHAR(180), IN Description VARCHAR(732),
                                        IN Address1 VARCHAR(45), IN Address2 VARCHAR(45),
                                        IN City VARCHAR(45), IN postal_code INT(15), IN County VARCHAR(45), 
                                        IN State VARCHAR(2), 
                                        IN Country VARCHAR(45))
BEGIN
	DECLARE DepID INT;
    
    INSERT INTO it_dep (`dep_acct_fk`, `dep_fac_fk`, `dep_code`, `dep_name`, `dep_contact_name`, `dep_phone`,`dep_contact_email`, `dep_desc`,
					 `dep_address1`, `dep_address2`, `dep_city`, `dep_postal_code`, `dep_county`, `dep_state`, `dep_country`) 
			VALUES (AccountID, FacilityID, DepartmentCode, DepartmentName, contact_name, phone, contact_email, Description, Address1, Address2,  
					 City, postal_code, County, State, Country);
    SET DepID = LAST_INSERT_ID();
    SELECT DepID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateEquipment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateEquipment`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN ParentCode INT,
										IN EquipmentCode VARCHAR(20), IN eq_serial_number VARCHAR(137), IN eq_item_type VARCHAR(138), IN eq_manu VARCHAR(120), IN eq_mod VARCHAR(120),
										IN pur_itemType INT, IN pur_cost DECIMAL(18, 2), IN pur_date DATETIME, IN pur_distributor VARCHAR(128), IN pur_approveby VARCHAR(128))
BEGIN
	DECLARE ItemPk INT;
	DECLARE ParentFk INT;
    SET ParentFk = NULL;
	IF ParentCode IS NOT NULL THEN
		SELECT (ParentFk = eq_pk) FROM it_equip WHERE eq_code = ParentCode;
    END IF;
    
	INSERT INTO it_equip (eq_acct_fk, eq_parent_fk, eq_cli_fk, eq_fac_fk, eq_dep_fk, eq_code, eq_serial_number, eq_manufacturer, eq_model, eq_item_type) 
		VALUES (AccountID, ParentFk, ClientID, FacilityID, DepartmentID, EquipmentCode, eq_serial_number, eq_manu, eq_mod, eq_item_type);
	SET ItemPk = LAST_INSERT_ID();
    
    INSERT INTO it_purchase (pur_acct_fk, pur_distributor, pur_item_fk, pur_itemType, pur_price, pur_quantity, pur_date, pur_approver)
		VALUES (AccountID, pur_distributor, ItemPk, pur_itemType, pur_cost, 1.0, pur_date, pur_approveby);
	SELECT ItemPk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateFac` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `itm_CreateFac`(IN AccountID INT, IN cli_fk INT, IN facName VARCHAR(75), IN facCode VARCHAR(20), 
									IN ContName VARCHAR(45), IN ContEmail VARCHAR(45),IN Phone VARCHAR(20), IN Address1 VARCHAR(45), IN Address2 VARCHAR(45),
									IN postal_code INT, IN City VARCHAR(45), IN County VARCHAR(45), 
                                    IN State VARCHAR(2), IN Country VARCHAR(45))
BEGIN
	INSERT INTO it_fac (`fac_acct_fk`, `fac_cli_fk`, `fac_name`,  `fac_code`, `fac_contact_name`, `fac_email`, `fac_phone`, `fac_address1`, `fac_address2`, 
						`fac_postal_code`, `fac_city`, `fac_county`, `fac_state`, `fac_country`
                        ) 
    VALUES (AccountID, cli_fk, facName, facCode, Phone, Address1, Address2, postal_code, City, County, State, Country, ContName, ContEmail);
	SELECT LAST_INSERT_ID();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateInventory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateInventory`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT,
										IN inv_code_str VARCHAR(20), IN inv_rate_code VARCHAR(18), IN inv_serial_number VARCHAR(137), IN inv_manu VARCHAR(120), IN inv_mod VARCHAR(120))
BEGIN
	DECLARE ItemPk INT;
	DECLARE RateCodePk INT;
    SET ItemPk = -1;
    SET RateCodePk = NULL;
	IF inv_rate_code IS NOT NULL THEN
		SET RateCodePk = (SELECT rateCode_pk FROM it_rateCode WHERE rateCode_code = inv_rate_code AND rateCode_acct_fk = AccountID);
    END IF;
    IF (SELECT COUNT(`inv_code`) FROM it_inventory WHERE `inv_code` = inv_code_str AND inv_acct_fk = AccountID GROUP BY `inv_code`) > 0 THEN
		SET ItemPk = -2;
	ELSE
        INSERT INTO it_inventory (`inv_acct_fk`, `inv_cli_fk`, `inv_fac_fk`, `inv_dep_fk`, `inv_ratecode_fk`, `inv_code`, `inv_serial_number`, `inv_manufacturer`, `inv_model`, `inv_createdDate`)
			VALUES(AccountID, ClientID, FacilityID, DepartmentID, RateCodePk, inv_code_str, inv_serial_number, inv_manu, inv_mod, NOW());
		SET ItemPk = LAST_INSERT_ID();
    END IF;
	SELECT ItemPk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateJob` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateJob`(IN AccountID INT, IN UserID INT(11), IN joblName VARCHAR(82), IN joblCode VARCHAR(45), IN joblRateCode INT(11), 
													IN joblDesc VARCHAR(732))
BEGIN
	DECLARE JobID INT;
    DECLARE ratecode_pk INT;
	SET JobID = NULL;
    SET ratecode_pk = NULL;
    IF length(joblRateCode) > 0 THEN
		SELECT ratecode_pk = rateCode_pk FROM it_rateCode WHERE rateCode_code = joblRateCode;
    END IF;
    IF (SELECT COUNT(`jobl_pk`) FROM `it_jobLibrary` WHERE `jobl_name` = joblName OR `jobl_code` = joblCode) < 1 THEN
		INSERT INTO it_jobLibrary (jobl_acct_fk, jobl_name, jobl_code, jobl_ratecode_fk, jobl_description)
			VALUES (AccountID, joblName, joblCode, joblRateCode, joblDesc);
		SET JobID = LAST_INSERT_ID();
	ELSE
		SET JobID = -1;
    END IF;
    SELECT JobID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateJobItem` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateJobItem`(IN AccountID INT, IN UserID INT, IN JobID INT, IN JobOrder INT, IN PassRequired BIT, 
										IN EnableNotes BIT, IN NotesRequired BIT, IN ItemName VARCHAR(45))
BEGIN
	DECLARE JobItemID INT;
	IF JobID >= 0 THEN
		INSERT INTO it_jobLibraryItem (`jobli_acct_fk`, `jobli_creator_fk`, `jobli_jobl_fk`, `jobli_order`, `jobli_name`, `jobli_pass_required`, `jobli_notes`, `jobli_notes_required`) 
								VALUES (AccountID, UserID, JobID, JobOrder, ItemName, PassRequired, EnableNotes, NotesRequired);
		SET JobItemID = LAST_INSERT_ID();
		SELECT JobItemID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreatePMSchedule` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreatePMSchedule`(
        IN AccountID INT, IN UserID INT, IN ItemType INT, IN ItemID INT, IN IntervalType INT, IN IntervalValue INT, 
		IN daysPriorCreation INT, IN startDate VARCHAR(30), IN wo_wtype_fk INT, IN wo_woss_fk INT, IN wo_rateCode_fk INT,
		IN wo_creator_fk INT, IN wo_assigned_fk INT, IN wo_requestor_fk INT, IN wo_jobl_fk INT
	)
BEGIN
	DECLARE pmID INT;
    SET pmID = -1;
    IF ItemType = 1 THEN
		INSERT INTO `it_pm_schedule` 
		(
			`pms_acct_fk`, `pms_item_fk`, `pms_item_type`, `pms_interval_type`, 
			`pms_interval`, `pms_daysPriorCreate`, `pms_startDate`, `pms_nextDate`,
			`pms_wo_wtype_fk`, `pms_wo_woss_fk`, `pms_wo_rateCode_fk`, `pms_wo_creator_fk`,
			`pms_wo_assigned_fk`, `pms_wo_requestor_fk`, `pms_wo_jobl_fk`
		) 
		VALUES
		(
			AccountID, ItemID, ItemType, IntervalType, IntervalValue, daysPriorCreation, CASE WHEN startDate IS NULL THEN NULL ELSE STR_TO_DATE(startDate, '%m/%d/%Y') END, 
			NULL, wo_wtype_fk,
			wo_woss_fk, wo_rateCode_fk, wo_creator_fk, wo_assigned_fk, wo_requestor_fk, wo_jobl_fk
		);
		SET pmID = LAST_INSERT_ID();
    END IF;
    SELECT pmID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateRateCode` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateRateCode`(IN AccountID INT, IN RCName VARCHAR(48), IN RCCode VARCHAR(18), IN RCHourlyCost DEC(18,2), IN RCPartMult DEC(18,2), 
													IN RCLaborMult DEC(18,2), IN RCChargeMult DEC(18,2))
BEGIN
	/* Check to see if rate code exists already */
	DECLARE rateCodePk INT;
    IF (SELECT COUNT(rateCode_code) FROM it_rateCode WHERE rateCode_code = RCCode OR rateCode_name = RCName) < 1 THEN
		INSERT INTO it_rateCode (rateCode_acct_fk, rateCode_name, rateCode_code, rateCode_hourly_cost, rateCode_part_multiplier,
		rateCode_labor_multiplier, rateCode_charge_multiplier)
			VALUES (AccountID, RCName, RCCode, RCHourlyCost, RCPartMult, RCLaborMult, RCChargeMult);
		SET rateCodePk = LAST_INSERT_ID();
    ELSE
		SET rateCodePk = -1;
    END IF;
    SELECT rateCodePk AS 'rateCodeID';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateRentable` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateRentable`(IN AccountID INT, IN ItemCode VARCHAR(20), IN ContactName VARCHAR(486), IN startDate VARCHAR(30), IN endDate VARCHAR(30), 
										IN shippingDate VARCHAR(30), IN arrivedDate VARCHAR(30))
BEGIN
	DECLARE RenPk INT;
    DECLARE ItemPk INT;
    DECLARE ContactPk INT;
    
    SET ItemPk = NULL;
    SET ContactPk = NULL;
    SET RenPk = -1;
    
    IF ItemCode IS NOT NULL THEN
		SET ItemPk = (SELECT inv_pk FROM it_inventory WHERE inv_acct_fk = AccountID AND inv_code = ItemCode);
    END IF;
    IF ContactName IS NOT NULL THEN
		SET ContactPk = (SELECT con_pk FROM it_con WHERE con_acct_fk = AccountID AND CONCAT(con_fname, ' ', con_lname) = ContactName);
    END IF;
    INSERT INTO it_rentable 
			(`ren_acct_fk`, `ren_inv_fk`, `ren_con_fk`, `ren_createdDate`, `ren_shippedDate`, `ren_arrivedDate`, `ren_startDate`, `ren_endDate`) 
				VALUES (AccountID, ItemPk, ContactPk, NOW(),
					CASE WHEN startDate IS NULL THEN NULL ELSE STR_TO_DATE(startDate, '%m/%d/%Y') END,
                    CASE WHEN endDate IS NULL THEN NULL ELSE STR_TO_DATE(endDate, '%m/%d/%Y') END,
                    CASE WHEN shippingDate IS NULL THEN NULL ELSE STR_TO_DATE(shippingDate, '%m/%d/%Y') END,
                    CASE WHEN arrivedDate IS NULL THEN NULL ELSE STR_TO_DATE(arrivedDate, '%m/%d/%Y') END);
	SET RenPk = LAST_INSERT_ID();
    SELECT RenPk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateShipmentDetail` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_CreateShipmentDetail`(IN AccountID INT, IN tag_type_fk INT, IN tag_fk INT, IN Descp VARCHAR(130))
BEGIN
	DECLARE shp_pk INT;
	SET shp_pk = -1;
	INSERT INTO `it_shipping` (`ship_acct_fk`, `ship_tag_type_fk`, `ship_tag_fk`, `ship_desc`) VALUES (AccountID, tag_type_fk, tag_fk, Descp);
	SET shp_pk = LAST_INSERT_ID();
	SELECT shp_pk AS "ship_pk";
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateShipTrack` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_CreateShipTrack`(IN AccountID INT, IN shipPk INT, IN startDate VARCHAR(25), IN endDate VARCHAR(25), IN trackingID VARCHAR(120), IN descrip VARCHAR(260))
BEGIN
	DECLARE shipMainID INT;
	DECLARE ship_sub_pk INT;
	-- CASE WHEN startDate IS NULL THEN NULL ELSE STR_TO_DATE(startDate, '%m/%d/%Y') END
	IF shipPk < 0 THEN
		SELECT -2 AS 'Error';
	ELSE
		INSERT INTO it_shiptrack (`stra_acct_fk`, `stra_ship_fk`, `stra_start_date`, `stra_end_date`, `stra_tracking_number`, `stra_desc`)
			VALUES (AccountID, shipPk, 
				CASE WHEN startDate IS NULL THEN NULL ELSE STR_TO_DATE(startDate, '%m/%d/%Y') END,
				CASE WHEN endDate IS NULL THEN NULL ELSE STR_TO_DATE(endDate, '%m/%d/%Y') END,
				trackingID,
				descrip
			);
		SET ship_sub_pk = LAST_INSERT_ID();
		SELECT ship_sub_pk;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateSuggestion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateSuggestion`(IN AccountID INT, IN ParentID INT, IN CreatorID INT, IN Sug_Subject VARCHAR(75), 
										IN Sug_Message VARCHAR(400) )
BEGIN
	INSERT INTO it_sug ( `sug_parent_fk`,`sug_acct_fk`, `sug_creator_fk`, `sug_subject`, `sug_message`, `sug_date`) 
			VALUES (ParentID, AccountID, CreatorID, Sug_Subject, Sug_Message, NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateVendor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateVendor`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN VenName VARCHAR(85), IN VenCode VARCHAR(45))
BEGIN
	DECLARE ven INT;
    
	INSERT INTO it_ven (ven_acct_fk, ven_cli_fk, ven_fac_fk, ven_dep_fk, ven_name, ven_code)
    VALUES (AccountID, ClientID, FacilityID, DepartmentID, VenName, VenCode);
    
    SET ven = LAST_INSERT_ID();
    SELECT ven AS 'VendorID';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateWorkOrder` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_CreateWorkOrder`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, 
															IN WO_Status INT, IN WO_ID VARCHAR(75), IN ItemID INT,
                                                            IN Charge bit(1), IN Notify bit(1), IN WO_TypeID INT, IN RequestDate VARCHAR(30),
                                                            IN StartDate VARCHAR(30), IN EndDate VARCHAR(30), IN Request VARCHAR(768), 
                                                            IN ContactID INT,  IN CompletionDate VARCHAR(30), IN CreatorID INT)
BEGIN
	DECLARE wo_pk INT;
    DECLARE CreatedDate datetime;
    DECLARE ItemTypeID INT;
    DECLARE New_Number INT(35);
    SET wo_pk = NULL;
    SET CreatedDate = NOW();
    SET ItemTypeID = 0;
    CALL itm_count(AccountID, '24');
    SET New_Number = (SELECT count_count FROM it_counter WHERE count_acct_fk = AccountID 
		AND count_module_fk = 24 ORDER BY count_count DESC LIMIT 1);
	INSERT INTO it_workorder 
		(`wo_acct_fk`,`wo_cli_fk`,`wo_fac_fk`,`wo_dep_fk`,`wo_ss_fk`,`wo_number`,`wo_item_fk`,`wo_itemType_fk`,`wo_charge`,
        `wo_notify`,`wo_wtype_fk`,`wo_requestDate`,`wo_startDate`,`wo_endDate`,`wo_request`,`wo_con_fk`,
        `wo_creator_fk`,`wo_createdDate`) 
        VALUES (AccountID, ClientID, FacilityID, DepartmentID, WO_Status, New_Number,
			ItemID, ItemTypeID, Charge, Notify, WO_TypeID, 
            CASE WHEN RequestDate IS NULL THEN NULL ELSE STR_TO_DATE(RequestDate, '%m/%d/%Y') END,
			CASE WHEN StartDate IS NULL THEN NULL ELSE STR_TO_DATE(StartDate, '%m/%d/%Y') END,
			CASE WHEN EndDate IS NULL THEN NULL ELSE STR_TO_DATE(EndDate, '%m/%d/%Y') END,
            Request, ContactID, CreatorID, CreatedDate);
        SET wo_pk = LAST_INSERT_ID();
        SELECT wo_pk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateWOStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateWOStatus`(IN AccountID INT, IN StatusName VARCHAR(45))
BEGIN
	DECLARE wossID INT;
	INSERT INTO it_workorderStatus (`woss_name`, `woss_acct_fk`) VALUES (StatusName, AccountID);
    SET wossID = LAST_INSERT_ID();
    SELECT wossID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateWOTask` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_CreateWOTask`(IN wo_fk INT, IN wo_rateCode_fk INT, IN wo_user_fk INT, 
									IN wo_createdDate VARCHAR(30), IN wo_completionDate VARCHAR(30), 
                                    IN wo_dueDate VARCHAR(30), IN wo_issueCode_fk INT, IN wo_failed BOOL, 
                                    IN wo_task_notlocated BOOL, IN ClientPk INT)
BEGIN
	DECLARE wotask_pk INT;
    SET wotask_pk = NULL;
    
	INSERT INTO it_workorderTask 
		(`wotask_wo_fk`, `wotask_rateCode_fk`, `wotask_usr_fk`, `wotask_createdDate`, `wotask_completionDate`, 
        `wotask_dueDate`, `wotask_issueCode_fk`, `wotask_failed`, `wotask_notlocated`,`wotask_client_fk`)
        VALUES (wo_fk, wp_rateCode, wo_user_fk, 
			CASE WHEN wo_createdDate IS NULL THEN NULL ELSE STR_TO_DATE(wo_createdDate, '%m/%d/%Y') END,
			CASE WHEN wo_completionDate IS NULL THEN NULL ELSE STR_TO_DATE(wo_completionDate, '%m/%d/%Y') END,
			CASE WHEN wo_dueDate IS NULL THEN NULL ELSE STR_TO_DATE(wo_dueDate, '%m/%d/%Y') END,
            wo_issueCode, wo_failed, wo_task_notlocated, ClientPk);
		SET wotask_pk =  LAST_INSERT_ID();
        SELECT wotask_pk;
	END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_CreateWOType` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_CreateWOType`(IN AccountID INT, IN ParentID INT, IN WOTypeName VARCHAR(45), IN WOTypeCode VARCHAR(18))
BEGIN
	DECLARE wTypeID INT;
    SET wTypeID = -1;
    INSERT INTO it_workorderType (`wtype_acct_fk`, `wtype_parent_fk`, `wtype_name`, `wtype_code`) VALUES (AccountID, ParentID, WOTypeName, WOTypeCode);
    SET wTypeID = LAST_INSERT_ID();
    SELECT wTypeID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_DeleteContact` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_DeleteContact`(IN AccountID INT, IN UserID INT, IN ContactID INT)
BEGIN
	UPDATE it_con SET con_deleteDate = NOW() WHERE con_pk = ContactID AND con_acct_fk = AccountID;
    SELECT con_pk, con_deleteDate FROM it_con WHERE con_pk = ContactID AND con_acct_fk = AccountID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_EquipmentSearch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_EquipmentSearch`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT)
BEGIN
    IF FacilityID IS NOT NULL THEN
		SELECT DISTINCT dep_pk, dep_name FROM it_equip
			LEFT JOIN it_dep ON dep_pk = eq_dep_fk
			LEFT JOIN it_fac ON fac_pk = dep_fac_fk
            LEFT JOIN it_cli ON cli_pk = fac_cli_fk
				WHERE eq_acct_fk = AccountID AND dep_fac_fk = FacilityID AND fac_cli_fk = ClientID;
    ELSEIF ClientID IS NOT NULL THEN
		SELECT DISTINCT fac_pk, fac_name FROM it_equip
			LEFT JOIN it_fac ON fac_pk = eq_fac_fk
				WHERE eq_acct_fk = AccountID AND fac_cli_fk = ClientID;
	ELSE
		SELECT DISTINCT cli_pk, cli_company AS 'cli_name' FROM it_equip
			LEFT JOIN it_cli ON cli_pk = eq_cli_fk
				WHERE eq_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GenerateRandomSalt` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GenerateRandomSalt`(OUT randomSalt VARCHAR(11))
BEGIN
	SELECT CONCAT(SUBSTRING(MD5(CONV(
          FLOOR(
            RAND() * 36),
      10, 36)), 1, 10), ELT(1 + FLOOR(RAND() * 32),
      '`', '~', '!', '@', '#', '$', '%', '^',
      '&', '*', '(', ')', '-', '=', '_', '+',
      '[', ']', '{', '}', '\\', '/', '|', '?',
      ';', ':', '\'', '"', ',', '.', '<', '>')) INTO randomSalt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetAllAccounts` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetAllAccounts`()
BEGIN
	SELECT  acct_pk, acct_creator_fk, acct_companyname, acct_maximum_users, acct_maximum_equipment, 
			acct_credit 
	FROM it_acct  LEFT JOIN it_usr ON usr_acct_fk = acct_creator_fk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetBillableStatistics` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetBillableStatistics`(IN AccountID INT)
BEGIN
	SELECT acct_companyname AS 'CompanyName', acct_maximum_users AS 'musers', acct_maximum_equipment AS 'mequipment', acct_credit AS 'credit', 
		acct_wo_prefix AS 'woprefix', acct_wo_starting_number AS 'wo_start_num',
		(SELECT COUNT(eq_pk) FROM it_equip WHERE eq_acct_fk = AccountID) AS 'cequipment',
        (SELECT COUNT(usr_pk) FROM GetLoginableUsers WHERE cus_acct_fk = AccountID) AS 'cusers'
        FROM it_acct WHERE acct_pk = AccountID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetClientInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetClientInfo`(IN AccountID INT, IN CliPK INT)
BEGIN
	SELECT cli_code, cli_company, cli_address1, cli_address2, cli_postal_code, cli_city,
			cli_phone, cli_contact_name, cli_contact_email, cli_county, cli_state, cli_country
    FROM it_cli
    WHERE cli_acct_fk = AccountID AND cli_pk = CliPK;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetClientList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `itm_GetClientList`(IN AccountID INT)
BEGIN
	SELECT * FROM it_cli 
    LEFT JOIN it_fac on fac_cli_fk = cli_pk 
    WHERE cli_acct_fk = AccountID and fac_pk IS NOT NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetContactACS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetContactACS`(IN AccountID INT, IN UserID INT, IN wsearch VARCHAR(300))
BEGIN
DECLARE wildSearch VARCHAR(301);
	IF wsearch IS NULL OR length(wsearch) < 1 THEN
		SELECT con_pk, con_lname, con_fname, con_email, con_phone FROM it_con WHERE con_acct_fk = AccountID AND con_deleteDate IS NULL;
    else
		SET wildSearch = CONCAT(wsearch, '%');
		SELECT con_pk, con_lname, con_fname, con_email, con_phone FROM it_con WHERE con_acct_fk = AccountID 
				AND (CONCAT(con_fname, " ", con_lname) LIKE wildSearch OR con_email LIKE wildSearch) AND con_deleteDate IS NULL;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetContactInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetContactInfo`(IN AccountID INT, IN UserID INT, IN ContactID INT)
BEGIN
	SELECT con_pk, con_cli_fk, con_fac_fk, con_dep_fk, con_type, 
		con_fname, con_lname, con_phone, con_email, con_notes,
		con_address, con_postal_code, con_city, con_county, 
		con_state, con_country 
	FROM it_con 
		WHERE con_acct_fk = AccountID AND con_pk = ContactID AND con_deleteDate IS NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetContactList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetContactList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT)
BEGIN
	IF DepartmentID IS NOT NULL THEN
		SELECT con_pk, con_type, con_fname, con_lname, con_phone, con_email FROM it_con WHERE con_acct_fk = AccountID 
							AND con_dep_fk = DepartmentID AND con_fac_fk = FacilityID AND con_cli_fk = ClientID AND con_deleteDate IS NULL;
    ELSEIF FacilityID IS NOT NULL THEN
		SELECT con_pk, con_type, con_fname, con_lname, con_phone, con_email FROM it_con WHERE con_acct_fk = AccountID AND con_fac_fk = FacilityID 
							AND con_cli_fk = ClientID AND con_deleteDate IS NULL;
    ELSEIF ClientID IS NOT NULL THEN
		SELECT con_pk, con_type, con_fname, con_lname, con_phone, con_email FROM it_con WHERE con_acct_fk = AccountID 
							AND con_cli_fk = ClientID AND con_deleteDate IS NULL;
    ELSE
		SELECT con_pk, con_type, con_fname, con_lname, con_phone, con_email FROM it_con WHERE con_acct_fk = AccountID AND con_deleteDate IS NULL;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetContactOrgs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetContactOrgs`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT)
BEGIN
    IF FacilityID IS NOT NULL THEN
		SELECT DISTINCT dep_pk, dep_name FROM it_con
			LEFT JOIN it_dep ON dep_pk = con_dep_fk
			LEFT JOIN it_fac ON fac_pk = dep_fac_fk
            LEFT JOIN it_cli ON cli_pk = fac_cli_fk
				WHERE con_acct_fk = AccountID AND dep_fac_fk = FacilityID AND fac_cli_fk = ClientID AND con_deleteDate IS NULL;
    ELSEIF ClientID IS NOT NULL THEN
		SELECT DISTINCT fac_pk, fac_name FROM it_con
			LEFT JOIN it_fac ON fac_pk = con_fac_fk
				WHERE con_acct_fk = AccountID AND fac_cli_fk = ClientID AND con_deleteDate IS NULL;
	ELSE
		SELECT DISTINCT cli_pk, cli_company AS 'cli_name' FROM it_con
			LEFT JOIN it_cli ON cli_pk = con_cli_fk
				WHERE con_acct_fk = AccountID AND con_deleteDate IS NULL;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetDepartmentInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetDepartmentInfo`(IN AccountID INT, IN DepPK INT)
BEGIN
	SELECT
		dep_name, dep_code, dep_contact_name, dep_phone, dep_contact_email, dep_desc,
        dep_address1, dep_address2, dep_city, dep_state, dep_county, dep_country, dep_postal_code
		
    FROM it_dep
        
    WHERE dep_acct_fk = AccountID AND dep_pk = DepPK;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetDepartmentList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetDepartmentList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT)
BEGIN
	SELECT dep_pk, dep_code, dep_code, dep_name, dep_phone, dep_contact_name, dep_contact_email FROM it_dep 
		LEFT JOIN it_fac ON fac_pk = FacilityID
			WHERE dep_acct_fk = AccountID AND dep_fac_fk = FacilityID AND fac_cli_fk = ClientID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetEquipInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetEquipInfo`(IN AccountID INT, IN EquipmentPK INT)
BEGIN
	SELECT
		eq_cli_fk, cli_code, cli_company AS 'cli_name',
		eq_fac_fk, fac_code, fac_name,
		eq_dep_fk, dep_code, dep_name, dep_desc,
		eq_code, eq_serial_number, eq_manufacturer, eq_model, eq_item_type, eq_mac_address, eq_ip_address, eq_subnet
    FROM it_equip
		LEFT JOIN it_cli ON cli_pk = eq_cli_fk
        LEFT JOIN it_fac ON fac_pk = eq_fac_fk
        LEFT JOIN it_dep ON dep_pk = eq_dep_fk
    WHERE eq_acct_fk = AccountID AND eq_pk = EquipmentPK;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetEquipment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetEquipment`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN SoftwareID INT)
BEGIN
	IF DepartmentID IS NOT NULL THEN
		SELECT eq_pk, eq_code, eq_manufacturer, eq_model, eq_item_type FROM it_equip WHERE eq_acct_fk = AccountID AND eq_dep_fk = DepartmentID AND eq_fac_fk = FacilityID AND eq_cli_fk = ClientID;
    ELSEIF FacilityID IS NOT NULL THEN
		SELECT eq_pk, eq_code, eq_manufacturer, eq_model, eq_item_type FROM it_equip WHERE eq_acct_fk = AccountID AND eq_fac_fk = FacilityID AND eq_cli_fk = ClientID;
    ELSEIF ClientID IS NOT NULL THEN
		SELECT eq_pk, eq_code, eq_manufacturer, eq_model, eq_item_type FROM it_equip WHERE eq_acct_fk = AccountID AND eq_cli_fk = ClientID;
    ELSEIF EquipmentID IS NOT NULL THEN
		SELECT eq_pk, eq_code, eq_manufacturer, eq_model, eq_item_type FROM it_equip WHERE eq_acct_fk = AccountID;
    ELSEIF SoftwareID IS NOT NULL THEN
		SELECT eq_pk, eq_code, eq_manufacturer, eq_model, eq_item_type FROM it_equip WHERE eq_acct_fk = AccountID;
    ELSE
		SELECT eq_pk, eq_code, eq_manufacturer, eq_model, eq_item_type FROM it_equip WHERE eq_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetEquipmentAC` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetEquipmentAC`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN wildSearch VARCHAR(18))
BEGIN
	DECLARE searchString VARCHAR(22);
	SET searchString = CONCAT(wildSearch, '%');
    IF FacilityID IS NOT NULL THEN
		SELECT eq_pk, eq_code FROM it_equip
			LEFT JOIN it_dep ON dep_pk = eq_dep_fk
			LEFT JOIN it_fac ON fac_pk = dep_fac_fk
            LEFT JOIN it_cli ON cli_pk = fac_cli_fk
				WHERE eq_acct_fk = AccountID AND dep_fac_fk = FacilityID AND fac_cli_fk = ClientID AND (`eq_code` LIKE searchString OR `eq_item_type` LIKE searchString);
    ELSEIF ClientID IS NOT NULL THEN
		SELECT eq_pk, eq_code FROM it_equip
			LEFT JOIN it_fac ON fac_pk = eq_fac_fk
				WHERE eq_acct_fk = AccountID AND fac_cli_fk = ClientID AND (`eq_code` LIKE searchString OR `eq_item_type` LIKE searchString);
	ELSE
		SELECT eq_pk, eq_code FROM it_equip
			LEFT JOIN it_cli ON cli_pk = eq_cli_fk
				WHERE eq_acct_fk = AccountID AND (`eq_code` LIKE searchString OR `eq_item_type` LIKE searchString);
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetEquipmentByMac` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetEquipmentByMac`(IN AccountID INT, IN MacAddress VARBINARY(6))
BEGIN
	SELECT * FROM it_equip WHERE eq_acct_fk = AccountID AND eq_mac_address = MacAddress;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetFacilityInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetFacilityInfo`(IN AccountID INT, IN FacPK INT)
BEGIN
	SELECT
		fac_code, fac_name, fac_contact_name, fac_email, fac_phone, fac_address1, fac_address2, 
        fac_postal_code, fac_city, fac_county, fac_state, fac_country 
    FROM it_fac
    WHERE fac_acct_fk = AccountID AND fac_pk = FacPK;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetFacilityList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetFacilityList`(IN AccountID INT, IN ClientID INT)
BEGIN
	SELECT fac_pk, fac_code, fac_name, fac_contact_name, fac_phone, fac_email, fac_state, fac_city FROM it_fac
    LEFT JOIN it_cli on fac_cli_fk = cli_pk
    WHERE fac_acct_fk = AccountID AND fac_cli_fk = ClientID and cli_pk IS NOT NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetInventory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetInventory`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT)
BEGIN
	IF DepartmentID IS NOT NULL THEN
		SELECT inv_pk, inv_code, inv_manufacturer, inv_model, inv_serial_number FROM it_inventory 
				WHERE inv_acct_fk = AccountID AND inv_dep_fk = DepartmentID 
					AND inv_fac_fk = FacilityID AND inv_cli_fk = ClientID;
    ELSEIF FacilityID IS NOT NULL THEN
		SELECT inv_pk, inv_code, inv_manufacturer, inv_model, inv_serial_number FROM it_inventory 
				WHERE inv_acct_fk = AccountID AND inv_fac_fk = FacilityID AND inv_cli_fk = ClientID;
    ELSEIF ClientID IS NOT NULL THEN
		SELECT inv_pk, inv_code, inv_manufacturer, inv_model, inv_serial_number FROM it_inventory 
				WHERE inv_acct_fk = AccountID AND inv_cli_fk = ClientID;
    ELSE
		SELECT inv_pk, inv_code, inv_manufacturer, inv_model, inv_serial_number FROM it_inventory WHERE inv_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetInventoryAC` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetInventoryAC`(IN AccountID INT, IN UserID INT, IN wildSearch VARCHAR(20))
BEGIN
	IF wildSearch IS NULL OR length(wildSearch) < 1 THEN
		SELECT inv_pk, inv_code, inv_model FROM it_inventory WHERE inv_acct_fk = AccountID;
    ELSE
		SELECT inv_pk, inv_code, inv_model FROM it_inventory WHERE inv_acct_fk = AccountID AND inv_code LIKE CONCAT(wildSearch, '%');
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetInventoryInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetInventoryInfo`(IN AccountID INT, IN InventoryID INT)
BEGIN
	SELECT
		inv_cli_fk, cli_code, cli_company AS 'cli_name',
		inv_fac_fk, fac_code, fac_name,
		inv_dep_fk, dep_code, dep_name, dep_desc, rateCode_code,
		inv_ratecode_fk, inv_code, inv_serial_number,
		inv_manufacturer, inv_model, inv_item_type, inv_createdDate
    FROM it_inventory
		LEFT JOIN it_cli ON cli_pk = inv_cli_fk
        LEFT JOIN it_fac ON fac_pk = inv_fac_fk
        LEFT JOIN it_dep ON dep_pk = inv_dep_fk
        LEFT JOIN it_rateCode ON rateCode_pk = inv_ratecode_fk
    WHERE inv_acct_fk = AccountID AND inv_pk = InventoryID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetJobLibraryInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetJobLibraryInfo`(IN AccountID INT, IN JobLPK INT)
BEGIN
	SELECT
		jobl_pk, jobl_name, jobl_code, rateCode_code AS ratecode, jobl_description
    FROM it_jobLibrary
        LEFT JOIN it_rateCode ON rateCode_acct_fk = jobl_acct_fk AND rateCode_pk = jobl_ratecode_fk
	WHERE jobl_acct_fk = AccountID AND jobl_pk = JobLPK;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetJobLibraryInfoList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetJobLibraryInfoList`(IN AccountID INT, IN JobLPK INT)
BEGIN
	SELECT
		jobli_pk, jobli_order, jobli_name, CAST(jobli_pass_required AS signed) as jobli_pass_required, CAST(jobli_notes AS signed) AS jobli_notes
    FROM it_jobLibraryItem
	WHERE jobli_acct_fk = AccountID AND jobli_jobl_fk = JobLPK;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetJobLibraryList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetJobLibraryList`(IN AccountID INT, IN search VARCHAR(75))
BEGIN
	IF search IS NOT NULL
	THEN
		SELECT
			jobl_pk, jobl_acct_fk, jobl_name, jobl_code, rateCode_code AS jobl_ratecode, jobl_description
		FROM it_jobLibrary
			LEFT JOIN it_rateCode ON rateCode_acct_fk = jobl_acct_fk AND rateCode_pk = jobl_ratecode_fk
		WHERE 
			jobl_acct_fk = AccountID AND (jobl_code LIKE CONCAT('%', search, '%') OR jobl_name LIKE CONCAT('%', search, '%'));
	ELSE
		SELECT
			jobl_pk, jobl_acct_fk, jobl_name, jobl_code, rateCode_code AS jobl_ratecode, jobl_description
		FROM it_jobLibrary
			LEFT JOIN it_rateCode ON rateCode_acct_fk = jobl_acct_fk AND rateCode_pk = jobl_ratecode_fk
		WHERE 
			jobl_acct_fk = AccountID;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetJobLibrarySearch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetJobLibrarySearch`(IN AccountID INT)
BEGIN
	SELECT
		jobl_acct_fk, jobl_name, jobl_code, jobl_ratecode_fk, jobl_description, 
        jobli_jobl_fk, jobli_order, jobli_name, jobli_pass_required, jobli_notes, jobli_acct_fk
	FROM it_jobLibrary, it_jobLibraryItem
		LEFT JOIN it_jobl ON jobl_pk = jobli_jobl_fk
	WHERE 
		jobl_acct_fk = AccountID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetKeyList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetKeyList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN ProductID INT)
BEGIN

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetPMScheduleByItemID` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetPMScheduleByItemID`(IN AccountID INT, IN UserID INT, IN ItemID INT, IN ItemTypeID INT)
BEGIN
	IF ItemTypeID = 1 THEN
		SELECT pms_pk, pms_item_type, pms_interval, pms_daysPriorCreate, pms_startDate, pms_nextDate, 
				wtype_code, woss_code, rateCode_code, CreatorUser.usr_username, AssignedUser.usr_username, CONCAT(con_fname, ' ', con_lname), jobl_code FROM it_pm_schedule
			LEFT JOIN it_rateCode ON rateCode_pk = pms_wo_rateCode_fk
            LEFT JOIN it_workorderStatus ON woss_pk = pms_wo_woss_fk
            LEFT JOIN it_workorderType ON wtype_pk = pms_wo_wtype_fk
            LEFT JOIN it_usr CreatorUser ON CreatorUser.usr_pk = pms_wo_creator_fk
            LEFT JOIN it_usr AssignedUser ON AssignedUser.usr_pk = pms_wo_assigned_fk
            LEFT JOIN it_con ON con_pk = pms_wo_requestor_fk
            LEFT JOIN it_jobLibrary ON pms_wo_jobl_fk = jobl_pk
						WHERE pms_acct_fk = AccountID AND pms_item_type = ItemTypeID AND pms_item_fk = ItemID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetRateCodeInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetRateCodeInfo`(IN AccountID INT, IN RateCodePk INT)
BEGIN
	SELECT
		rateCode_name, rateCode_code, rateCode_hourly_cost, rateCode_part_multiplier,
        rateCode_labor_multiplier, rateCode_charge_multiplier
    FROM it_rateCode
	WHERE rateCode_acct_fk = AccountID AND rateCode_pk = RateCodePK;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetRateCodeList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetRateCodeList`(IN AccountID INT, IN wildSearch VARCHAR(78))
BEGIN
	DECLARE searchString VARCHAR(79);
	IF wildSearch IS NOT NULL AND length(wildSearch) > 0 THEN
        SET searchString = CONCAT(wildSearch, '%');
		SELECT
			rateCode_pk, rateCode_acct_fk, rateCode_name, rateCode_code, rateCode_hourly_cost
		FROM it_rateCode
		WHERE 
			rateCode_acct_fk = AccountID AND (`rateCode_code` LIKE searchString OR `rateCode_name` LIKE searchString);
	ELSE
		SELECT
			rateCode_pk, rateCode_acct_fk, rateCode_name, rateCode_code, rateCode_hourly_cost
		FROM it_rateCode
		WHERE 
			rateCode_acct_fk = AccountID;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetRented` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetRented`(IN AccountID INT, IN InvID INT)
BEGIN
	IF InvID IS NOT NULL THEN
		SELECT ren_pk, inv_code, CONCAT(con_fname, ' ', con_lname) AS 'con_name', ren_shippedDate, ren_arrivedDate, ren_startDate, ren_endDate FROM it_rentable
			LEFT JOIN it_con ON con_pk = ren_con_fk
            LEFT JOIN it_inventory ON inv_pk = ren_inv_fk
				WHERE ren_acct_fk = AccountID AND ren_inv_fk = InvID;
	ELSE
		SELECT -1 AS 'Error';
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetRentInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetRentInfo`(IN AccountID INT, IN ItemID INT)
BEGIN
	SELECT 
			`ren_acct_fk`,
			`ren_inv_fk`,
			`ren_invst_fk`,
			`ren_con_fk`,
			`ren_createdDate`,
			`ren_shippedDate`,
			`ren_arrivedDate`,
			`ren_startDate`,
			`ren_endDate`,
			`ren_completed`
		FROM `it_rentable`
			WHERE `ren_acct_fk` = AccountID AND `ren_pk` = ItemID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetRentList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetRentList`(IN AccountID INT, IN ContactID INT)
BEGIN
	IF ContactID IS NOT NULL THEN
		SELECT ren_pk, inv_code, CONCAT(con_fname, ' ', con_lname) AS 'con_name', ren_shippedDate, ren_arrivedDate, ren_startDate, ren_endDate FROM it_rentable
			LEFT JOIN it_con ON con_pk = ren_con_fk
            LEFT JOIN it_inventory ON inv_pk = ren_inv_fk
				WHERE ren_acct_fk = AccountID AND ren_con_fk = ContactID;
	ELSE
		SELECT ren_pk, inv_code, CONCAT(con_fname, ' ', con_lname) AS 'con_name', ren_shippedDate, ren_arrivedDate, ren_startDate, ren_endDate FROM it_rentable
			LEFT JOIN it_con ON con_pk = ren_con_fk
            LEFT JOIN it_inventory ON inv_pk = ren_inv_fk
				WHERE ren_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetRentOrgs` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetRentOrgs`(IN AccountID INT, IN ContactID INT)
BEGIN
    IF ContactID IS NOT NULL THEN
		SELECT DISTINCT con_pk, CONCAT(con_fname, ' ', con_lname) AS 'con_name' FROM it_rentable
			LEFT JOIN it_con ON con_pk = ren_con_fk
				WHERE ren_acct_fk = AccountID AND ren_con_fk = ContactID;
    ELSE
		SELECT DISTINCT con_pk, CONCAT(con_fname, ' ', con_lname) AS 'con_name' FROM it_rentable
			LEFT JOIN it_con ON con_pk = ren_con_fk
				WHERE ren_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetReportTables` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetReportTables`(IN acct_id INT)
BEGIN
	DECLARE records_exist INT;
	SET records_exist = -1;

	SET records_exist = (SELECT cola_pk FROM itam_GetColumnsView WHERE cola_acct_fk = acct_id LIMIT 1);
	IF records_exist > 0 THEN
		SELECT DISTINCT cola_table FROM itam_GetColumnsView WHERE cola_acct_fk = acct_id;
	ELSE
		SELECT DISTINCT cola_table FROM itam_GetColumnsView WHERE cola_acct_fk = 0;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetShipmentDetails` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetShipmentDetails`(IN AccountID INT, IN tag_type INT, IN tag_fk INT)
BEGIN
	SELECT `ship_pk`, `ship_acct_fk`, `ship_tag_fk`, `ship_tag_type_fk`, `ship_desc` FROM `it_shipping` WHERE `ship_acct_fk` = AccountID AND `ship_tag_type_fk` = tag_type AND `ship_tag_fk` = tag_fk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetSoftwareProductList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetSoftwareProductList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT)
BEGIN
	#If Client Facility and Department are null then we use equipment
    IF DepartmentID IS NOT NULL THEN
		SELECT * FROM it_soft WHERE soft_acct_fk = AccountID AND soft_cli_fk = ClientID AND soft_fac_fk = FacilityID AND soft_dep_fk = DepartmentID;
	ELSEIF FacilityID IS NOT NULL THEN
		SELECT * FROM it_soft WHERE soft_acct_fk = AccountID AND soft_cli_fk = ClientID AND soft_fac_fk = FacilityID;
    ELSEIF ClientID IS NOT NULL THEN
		SELECT * FROM it_soft WHERE soft_acct_fk = AccountID AND soft_cli_fk = ClientID;
    ELSEIF EquipmentID IS NOT NULL THEN
		SELECT * FROM it_soft WHERE soft_acct_fk = AccountID AND soft_eq_fk = EquipmentID;
    ELSE
		SELECT * FROM it_soft WHERE soft_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetSuggestions` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetSuggestions`(IN AccountID INT, IN ParentID INT, IN UserID INT)
BEGIN
	IF ParentID IS NULL THEN
		SELECT sug_pk, sug_parent_fk, sug_acct_fk, sug_creator_fk, sug_subject, sug_message, sug_date FROM it_sug 
			WHERE sug_acct_fk = AccountID AND sug_parent_fk IS NULL AND sug_creator_fk = UserID
				ORDER BY sug_date ASC;
	ELSE
		SELECT sug_pk, sug_parent_fk, sug_acct_fk, sug_creator_fk, sug_subject, sug_message, sug_date, usr_username
        FROM it_sug
        LEFT JOIN it_usr ON usr_pk = sug_creator_fk
			WHERE sug_acct_fk = AccountID AND (sug_parent_fk = ParentID OR sug_pk = ParentID) AND sug_creator_fk = UserID
				ORDER BY sug_date ASC;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetTableColumnData` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetTableColumnData`(IN acct_id INT, IN tblName VARCHAR(78))
BEGIN
	DECLARE records_exist INT;
	SET records_exist = -1;

	SET records_exist = (SELECT cola_pk FROM itam_GetColumnsView WHERE cola_table = tblName AND cola_acct_fk = acct_id LIMIT 1);
	IF records_exist > 0 THEN
		SELECT * FROM itam_GetColumnsView WHERE cola_table = tblName AND cola_acct_fk = acct_id;
	ELSE
		SELECT * FROM itam_GetColumnsView WHERE cola_table = tblName AND cola_acct_fk = 0;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetTrackingHistory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetTrackingHistory`(IN AccountID INT, IN shipping_pk INT)
BEGIN
	SELECT `stra_pk`, `stra_ship_fk`, `stra_start_date`, `stra_end_date`, `stra_tracking_number`, `stra_desc` FROM `it_shiptrack`
		WHERE `stra_acct_fk` = AccountID AND `stra_ship_fk` = shipping_pk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetUserInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetUserInfo`(IN AccountID INT, IN UserPk INT)
BEGIN
	IF AccountID IS NULL THEN
		SELECT
			usr_cli_fk, cli_code, cli_company AS 'cli_name',
			usr_fac_fk, fac_code, fac_name,    
			usr_dep_fk, dep_code, dep_name, dep_desc,
			usr_fname, usr_lname,
			usr_address1, usr_address2, usr_postal_code, usr_city, usr_state, usr_county, usr_country, 
			usr_username, usr_email,
			usr_domain, usr_netbios, usr_ou,
			usr_portal_login,
			usr_title, usr_manager, usr_phonenumber
			FROM it_usr
			LEFT JOIN it_cli ON cli_pk = usr_cli_fk
			LEFT JOIN it_fac ON fac_pk = usr_fac_fk
			LEFT JOIN it_dep ON dep_pk = usr_dep_fk
				WHERE usr_acct_fk IS NULL 
					AND usr_pk = UserPk;
		ELSE
			SELECT
				usr_cli_fk, cli_code, cli_company AS 'cli_name',
				usr_fac_fk, fac_code, fac_name,    
				usr_dep_fk, dep_code, dep_name, dep_desc,
				usr_fname, usr_lname,
				usr_address1, usr_address2, usr_postal_code, usr_city, usr_state, usr_county, usr_country, 
				usr_username, usr_email,
				usr_domain, usr_netbios, usr_ou,
				usr_portal_login,
				usr_title, usr_manager, usr_phonenumber
				FROM it_usr
				LEFT JOIN it_cli ON cli_pk = usr_cli_fk
				LEFT JOIN it_fac ON fac_pk = usr_fac_fk
				LEFT JOIN it_dep ON dep_pk = usr_dep_fk
					WHERE usr_acct_fk = AccountID 
						AND usr_pk = UserPk;
        END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetUsersList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetUsersList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN OrgSearch boolean)
BEGIN
	IF OrgSearch IS TRUE THEN
        IF FacilityID IS NOT NULL THEN
			SELECT dep_pk, dep_name FROM it_dep
				LEFT JOIN it_fac ON fac_pk = dep_fac_fk
					 WHERE dep_acct_fk = AccountID AND dep_fac_fk = FacilityID AND fac_cli_fk = ClientID;
        ELSEIF ClientID IS NOT NULL THEN
			SELECT fac_pk, fac_name FROM it_fac
					 WHERE fac_acct_fk = AccountID AND fac_cli_fk = ClientID;
		ELSE
			SELECT cli_pk, cli_company AS 'cli_name' FROM it_cli
					 WHERE cli_acct_fk = AccountID;
        END IF;
    ELSE
		IF DepartmentID IS NOT NULL THEN
			SELECT usr_pk, cli_company AS 'cli_name', cli_code, fac_name, fac_code, dep_name, dep_code, usr_fname AS 'firstname', 
					usr_lname AS 'lastname', usr_email, usr_username, usr_portal_login FROM it_usr
				LEFT JOIN it_fac ON fac_pk = usr_fac_fk
                LEFT JOIN it_cli ON cli_pk = usr_cli_fk
                LEFT JOIN it_dep ON dep_pk = usr_dep_fk
					WHERE usr_acct_fk = AccountID AND usr_dep_fk = DepartmentID;
        ELSEIF FacilityID IS NOT NULL THEN
			SELECT usr_pk, cli_company AS 'cli_name', cli_code, fac_name, fac_code, dep_name, dep_code, usr_fname AS 'firstname', 
					usr_lname AS 'lastname', usr_email, usr_username, usr_portal_login FROM it_usr
				LEFT JOIN it_fac ON fac_pk = usr_fac_fk
                LEFT JOIN it_cli ON cli_pk = usr_cli_fk
                LEFT JOIN it_dep ON dep_pk = usr_dep_fk
					WHERE usr_acct_fk = AccountID AND usr_fac_fk = FacilityID;
        ELSEIF ClientID IS NOT NULL THEN
			SELECT usr_pk, cli_company AS 'cli_name', cli_code, fac_name, fac_code, dep_name, dep_code, usr_fname AS 'firstname', 
					usr_lname AS 'lastname', usr_email, usr_username, usr_portal_login FROM it_usr
				LEFT JOIN it_fac ON fac_pk = usr_fac_fk
                LEFT JOIN it_cli ON cli_pk = usr_cli_fk
                LEFT JOIN it_dep ON dep_pk = usr_dep_fk
					WHERE usr_acct_fk = AccountID AND usr_cli_fk = ClientID;
        ELSE
			SELECT usr_pk, cli_company AS 'cli_name', cli_code, fac_name, fac_code, dep_name, dep_code, usr_fname AS 'firstname', 
					usr_lname AS 'lastname', usr_email, usr_username, usr_portal_login FROM it_usr
				LEFT JOIN it_fac ON fac_pk = usr_fac_fk
                LEFT JOIN it_cli ON cli_pk = usr_cli_fk
                LEFT JOIN it_dep ON dep_pk = usr_dep_fk
					WHERE usr_acct_fk = AccountID;
		END IF;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetVendorList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetVendorList`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT, IN OrgSearch boolean)
BEGIN
	IF OrgSearch IS TRUE THEN
		IF FacilityID IS NOT NULL THEN
			SELECT DISTINCT dep_pk, dep_name FROM it_ven
				LEFT JOIN it_dep ON dep_pk = ven_dep_fk
					WHERE ven_acct_fk = AccountID AND ven_fac_fk = FacilityID AND ven_cli_fk = ClientID;
		ELSEIF ClientID IS NOT NULL THEN
			SELECT DISTINCT fac_pk, fac_name FROM it_ven
				LEFT JOIN it_fac ON fac_pk = ven_fac_fk
					WHERE ven_acct_fk = AccountID AND ven_cli_fk = ClientID;
		ELSE
			SELECT DISTINCT cli_pk, cli_company AS 'cli_name' FROM it_ven
				LEFT JOIN it_cli ON cli_pk = ven_cli_fk
					WHERE ven_acct_fk = AccountID AND cli_pk IS NOT NULL;
		END IF;
	ELSE
		IF DepartmentID IS NOT NULL THEN
			SELECT ven_pk, cli_company AS 'cli_name', cli_code, fac_name, fac_code, dep_name, dep_code, ven_name, ven_code FROM it_ven
				LEFT JOIN it_fac on fac_pk = ven_fac_fk
                LEFT JOIN it_cli on cli_pk = ven_cli_fk
                LEFT JOIN it_dep on dep_pk = ven_dep_fk
					WHERE ven_acct_fk = AccountID AND ven_cli_fk = ClientID AND ven_fac_fk = FacilityID AND ven_dep_fk = DepartmentID;
		ELSEIF FacilityID IS NOT NULL THEN
			SELECT ven_pk, cli_company AS 'cli_name', cli_code, fac_name, fac_code, dep_name, dep_code, ven_name, ven_code FROM it_ven
				LEFT JOIN it_fac on fac_pk = ven_fac_fk
                LEFT JOIN it_cli on cli_pk = ven_cli_fk
                LEFT JOIN it_dep on dep_pk = ven_dep_fk
					WHERE ven_acct_fk = AccountID AND ven_cli_fk = ClientID AND ven_fac_fk = FacilityID;
		ELSEIF ClientID IS NOT NULL THEN 
			SELECT ven_pk, cli_company AS 'cli_name', cli_code, fac_name, fac_code, dep_name, dep_code, ven_name, ven_code FROM it_ven
				LEFT JOIN it_fac on fac_pk = ven_fac_fk
                LEFT JOIN it_cli on cli_pk = ven_cli_fk
                LEFT JOIN it_dep on dep_pk = ven_dep_fk
					WHERE ven_acct_fk = AccountID AND ven_cli_fk = ClientID;
		ELSE 
			SELECT ven_pk, '' AS 'cli_name', '', '', '', '', '', ven_name, ven_code FROM it_ven
					WHERE ven_acct_fk = AccountID AND ven_cli_fk IS NULL AND ven_fac_fk IS NULL AND ven_dep_fk IS NULL;
		END IF;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetVenInfo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetVenInfo`(IN AccountID INT, IN VenPk INT)
BEGIN
	SELECT
		ven_name, ven_code, COUNT(prod_acct_fk) AS ven_total_products, COUNT(prod_acct_fk) AS ven_total_licenses,
        cli_company AS ven_client, fac_name AS ven_facility, dep_name AS ven_department, CONCAT(con_fname, " ", con_lname) AS ven_contact
		
		FROM it_prod, it_ven
		LEFT JOIN it_cli ON cli_pk = ven_cli_fk
		LEFT JOIN it_fac ON fac_pk = ven_fac_fk
		LEFT JOIN it_dep ON dep_pk = ven_dep_fk
        LEFT JOIN it_con ON con_pk = ven_con_fk
			WHERE ven_acct_fk = AccountID AND ven_pk = VenPk AND prod_acct_fk = AccountID AND prod_ven_fk = ven_pk;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetWorkOrderNumber` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetWorkOrderNumber`(IN AccountID INT)
BEGIN
	DECLARE WO_NUMBER INT(35);
    DECLARE WO_NUMBER_CONC VARCHAR(35);
    DECLARE WO_START_NUM INT(35);
    DECLARE WO_PREFIX VARCHAR(35);
    
    SET WO_NUMBER = (SELECT count_count FROM it_counter WHERE count_acct_fk = AccountID ORDER BY count_count DESC LIMIT 1);
    SET WO_PREFIX = (SELECT acct_wo_prefix FROM it_acct WHERE acct_pk = AccountID);
    
	IF WO_NUMBER IS NULL THEN  
		SET WO_START_NUM = (SELECT acct_wo_starting_number FROM it_acct WHERE acct_pk = AccountID) - 1;
        
        INSERT INTO it_counter (`count_acct_fk`,`count_module_fk`,`count_count`) VALUES (AccountID, '24', WO_START_NUM);
		SET WO_NUMBER = WO_START_NUM + 1;
        
        #SELECT WO_START_NUM;
	ELSE 
		SET WO_NUMBER = (WO_NUMBER + 1);
		#INSERT INTO it_counter (`count_acct_fk`,`count_module_fk`,`count_count`) VALUES (AccountID, '24', WO_NUMBER);
    END IF;
    #SELECT WO_NUMBER;
    SET WO_NUMBER_CONC = CONCAT(WO_PREFIX, WO_NUMBER);
    SELECT WO_NUMBER_CONC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetWOStatusAC` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetWOStatusAC`(IN AccountID INT, IN wildSearch VARCHAR(48))
BEGIN
	IF wildSearch IS NOT NULL THEN
		SELECT DISTINCT woss_pk, woss_name FROM it_workorderStatus WHERE woss_acct_fk = AccountID AND (woss_code LIKE CONCAT(wildSearch, '%') OR woss_name LIKE CONCAT(wildSearch, '%'));
    ELSE
		SELECT woss_pk, woss_name FROM it_workorderStatus WHERE woss_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetWOTypeDetail` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetWOTypeDetail`(IN AccountID INT, IN WTypeID INT)
BEGIN
	SELECT `wtype_pk`, `wtype_acct_fk`, `wtype_parent_fk`, `wtype_name`, `wtype_code` FROM it_workorderType WHERE `wtype_acct_fk` = AccountID AND `wtype_pk` = WTypeID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetWOTypeList` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_GetWOTypeList`(IN AccountID INT, IN ParentID INT)
BEGIN
	IF ParentID IS NULl THEN
		SELECT `wtype_pk`, `wtype_name`, `wtype_code` FROM `it_workorderType` WHERE `wtype_acct_fk` = AccountID AND `wtype_parent_fk` IS NULL;
    ELSE
		SELECT `wtype_pk`, `wtype_name`, `wtype_code` FROM `it_workorderType` WHERE `wtype_acct_fk` = AccountID AND `wtype_parent_fk` = ParentID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_GetWOTypeListACS` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_GetWOTypeListACS`(IN AccountID INT, IN search VARCHAR(45))
BEGIN
	IF search IS NULL THEN
		SELECT `wtype_pk`, `wtype_name`, `wtype_code` FROM `it_workorderType` WHERE `wtype_acct_fk` = AccountID;
    ELSE
		SELECT `wtype_pk`, `wtype_name`, `wtype_code` FROM `it_workorderType` WHERE `wtype_acct_fk` = AccountID AND `wtype_name` LIKE CONCAT('%', search, '%');
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_LoginCustomer` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_LoginCustomer`(IN email_address VARCHAR(150), IN username VARCHAR(150), IN _password VARBINARY(2048))
BEGIN
	DECLARE salt VARCHAR(11);
	DECLARE usr_pkResult INT;

	SET usr_pkResult = (SELECT `usr_pk` FROM GetLoginableUsers WHERE `usr_email` = username OR `usr_username` = username);
	SET salt = (SELECT `usalt_secret` FROM `it_user_salt` WHERE `usalt_usr_fk` = usr_pkResult);

	IF salt IS NULL THEN
	
	SELECT cus_acct_fk AS 'AccountID', usr_pk AS 'UserID', cus_pk AS 'CustomerID', usr_country AS 'Country'
		FROM GetLoginableUsers WHERE usr_email = username OR usr_username = username 
			AND (usr_password = _password OR cus_password = _password);
	ELSE
		SELECT cus_acct_fk AS 'AccountID', usr_pk AS 'UserID', cus_pk AS 'CustomerID', usr_country AS 'Country'
		FROM GetLoginableUsers WHERE usr_email = username OR usr_username = username 
			AND (usr_password = SHA2(512, CONCAT(salt, _password)) OR cus_password = SHA2(512, CONCAT(salt, _password)));
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_StartEditHistory
` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_StartEditHistory
`(IN AccountID INT, IN UserID INT, IN ModuleID INT, IN FieldID INT, IN ValueData VARCHAR(760))
BEGIN
	DECLARE ParentPk INT;
    INSERT INTO it_edit_history (eh_parent_fk, eh_acct_fk, eh_usr_fk, eh_module_fk, eh_field_fk, eh_value, eh_timestamp, eh_final, eh_original)
		VALUES (-1, AccountID, UserID, ModuleID, FieldID, ValueData, NOW(), FALSE, TRUE);
	SET ParentPk = LAST_INSERT_ID();
    SELECT ParentPk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_StartEditHistory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_StartEditHistory`(IN AccountID INT, IN UserID INT, IN ModuleID INT, IN FieldID INT, IN ValueData VARCHAR(760))
BEGIN
	DECLARE ParentPk INT;
    INSERT INTO it_edit_history (eh_parent_fk, eh_acct_fk, eh_usr_fk, eh_module_fk, eh_field_fk, eh_value, eh_timestamp, eh_final, eh_original)
		VALUES (ParentPK, AccountID, UserID, ModuleID, FieldID, ValueData, NOW(), FALSE, TRUE);
	SET ParentPk = LAST_INSERT_ID();
    SELECT ParentPk;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_StopEditHistory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_StopEditHistory`(IN AccountID INT, IN UserID INT, IN RecordPk INT, IN ModuleID INT, IN FieldID INT, 
IN TableName VARCHAR(78), IN FieldPrefix VARCHAR(10), IN FieldKey VARCHAR(45), IN ValueData VARCHAR(760), IN Svalue BIT)
BEGIN
	DECLARE EditPk INT;
    INSERT INTO it_edit_history (eh_acct_fk, eh_usr_fk, eh_module_fk, eh_field_fk, eh_value, eh_timestamp, eh_final, eh_original)
		VALUES (AccountID, UserID, ModuleID, FieldID, ValueData, NOW(), TRUE, FALSE);
	SET EditPk = LAST_INSERT_ID();
    
    SET @FinalEditTableField = CONCAT('UPDATE `',TableName,'` SET `',FieldPrefix,'_',FieldKey,'` = ');
    IF Svalue THEN 
		SET @FinalEditTableField = CONCAT(@FinalEditTableField, QUOTE(ValueData), ' WHERE `', FieldPrefix, '_', 'pk`', ' = ', RecordPk);
    ELSE
		SET @FinalEditTableField = CONCAT(@FinalEditTableField, ValueData, ' WHERE `', FieldPrefix, '_', 'pk`', ' = ', RecordPk);
    END IF;
    SET @FinalEditTableField = CONCAT(@FinalEditTableField, ';');
    PREPARE stmt FROM @FinalEditTableField;
    EXECUTE stmt;
    SELECT ROW_COUNT();
    DEALLOCATE PREPARE stmt;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_ValidateRateCode` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`itman`@`%` PROCEDURE `itm_ValidateRateCode`(IN AccountID INT, IN RCName VARCHAR(45), IN RCCode VARCHAR(18), IN Switch BIT)
BEGIN
	IF(Switch = 0) THEN
		SELECT COUNT(rateCode_pk) 
		FROM it_rateCode 
		WHERE rateCode_acct_fk = AccountID AND rateCode_name = RCName;
	ELSE
		SELECT COUNT(rateCode_pk)
		FROM it_rateCode
		WHERE rateCode_acct_fk = AccountID AND rateCode_code = RCCode;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `itm_WorkOrderSearch` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `itm_WorkOrderSearch`(IN AccountID INT, IN ClientID INT, IN FacilityID INT, IN DepartmentID INT)
BEGIN
    IF FacilityID IS NOT NULL THEN
		SELECT DISTINCT dep_pk, dep_name FROM it_workorder
			LEFT JOIN it_dep ON dep_pk = wo_dep_fk
			LEFT JOIN it_fac ON fac_pk = dep_fac_fk
            LEFT JOIN it_cli ON cli_pk = fac_cli_fk
				WHERE wo_acct_fk = AccountID AND dep_fac_fk = FacilityID AND fac_cli_fk = ClientID;
    ELSEIF ClientID IS NOT NULL THEN
		SELECT DISTINCT fac_pk, fac_name FROM it_workorder
			LEFT JOIN it_fac ON fac_pk = wo_fac_fk
				WHERE eq_acct_fk = AccountID AND fac_cli_fk = ClientID;
	ELSE
		SELECT DISTINCT cli_pk, cli_company AS 'cli_name' FROM it_workorder
			LEFT JOIN it_cli ON cli_pk = wo_cli_fk
				WHERE wo_acct_fk = AccountID;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ltm_CreateRentable` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `ltm_CreateRentable`( IN AccountID INT, IN ClientName VARCHAR(457), IN ItemCode VARCHAR(20), IN RentStart VARCHAR(50), IN RentEnd VARCHAR(50),
													IN ShippingStart VARCHAR(50), IN ShippingEnd VARCHAR(50))
BEGIN
	DECLARE InventoryID INT;
    DECLARE ContactID INT;
    DECLARE RentPk INT;
    
    SET ContactID = NULL;
    SET InventoryID = NULL;
    SET RentPk = -1;
    
    IF ClientName != NULL THEN
		SET ContactID = (SELECT con_pk FROM it_con WHERE con_acct_fk = AccountID AND CONCAT(con_fname, ' ', con_lname) = ClientName);
    END IF;
    IF ItemCode IS NOT NULL THEN
		SELECT * FROM it_inventory WHERE inv_acct_fk = 5 AND inv_code = ItemCode LIMIT 0, 1;
    END IF;
    /*INSERT INTO it_rentable (`ren_acct_fk`, `ren_inv_fk`, `ren_con_fk`, `ren_createdDate`, `ren_shippedDate`, `ren_arrivedDate`, `ren_startDate`, `ren_endDate`) 
					VALUES (AccountID, InventoryID, ContactID, NOW(), 
                    CASE WHEN ShippingStart IS NULL THEN ShippingStart ELSE STR_TO_DATE(ShippingStart, '%c/%e/%Y') END, 
                    CASE WHEN ShippingEnd IS NULL THEN ShippingEnd ELSE STR_TO_DATE(ShippingEnd, '%c/%e/%Y') END, 
                    CASE WHEN RentStart IS NULL THEN RentStart ELSE STR_TO_DATE(RentStart, '%c/%e/%Y') END, 
                    CASE WHEN RentEnd IS NULL THEN RentEnd ELSE STR_TO_DATE(RentEnd, '%c/%e/%Y') END);
	SET RentPk = LAST_INSERT_ID();
    SELECT RentPk;*/
    #SELECT ItemCode, InventoryID,ClientName, ContactID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `GetLoginableUsers`
--

/*!50001 DROP VIEW IF EXISTS `GetLoginableUsers`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `GetLoginableUsers` AS select `it_cus`.`cus_pk` AS `cus_pk`,`it_usr`.`usr_pk` AS `usr_pk`,`it_usr`.`usr_email` AS `usr_email`,`it_usr`.`usr_username` AS `usr_username`,`it_usr`.`usr_password` AS `usr_password`,`it_cus`.`cus_password` AS `cus_password`,`it_usr`.`usr_country` AS `usr_country`,`it_cus`.`cus_acct_fk` AS `cus_acct_fk` from (`it_cus` left join `it_usr` on((`it_usr`.`usr_pk` = `it_cus`.`cus_usr_fk`))) where (`it_usr`.`usr_portal_login` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-24 11:36:23
