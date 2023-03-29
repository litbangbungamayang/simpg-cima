/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.19-MariaDB : Database - db_simpg
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `t_hapas` */

DROP TABLE IF EXISTS `t_hapas`;

CREATE TABLE `t_hapas` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `company_code` varchar(6) DEFAULT NULL,
  `plant_code` varchar(6) DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `tgl_stop_hif` date DEFAULT NULL,
  `tgl_start_hif` date DEFAULT NULL,
  `tgl_stop_hia` date DEFAULT NULL,
  `tgl_start_hia` date DEFAULT NULL,
  `jml_hari_penyelesaian` int(10) DEFAULT NULL,
  `jml_hari_gil_inc_jb` int(10) DEFAULT NULL,
  `datecreate` date DEFAULT NULL,
  `usercreate` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_hapas` */

/*Table structure for table `t_hapas_detail_copy` */

DROP TABLE IF EXISTS `t_hapas_detail_copy`;

CREATE TABLE `t_hapas_detail_copy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code_company` varchar(10) DEFAULT NULL,
  `code_plant` varchar(10) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `parent` varchar(10) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `nilai` double(200,4) DEFAULT '0.0000',
  `luas` double(200,4) DEFAULT '0.0000',
  `ton_tebu` double(200,4) DEFAULT '0.0000',
  `ton_hablur` double(200,4) DEFAULT '0.0000',
  `ton_gula` double(200,4) DEFAULT '0.0000',
  `ton_gula_ptr` double(200,4) DEFAULT '0.0000',
  `ton_gula_milik` double(200,4) DEFAULT '0.0000',
  `jenis` smallint(1) DEFAULT '0' COMMENT '1. header 2. value',
  `kategori` varchar(5) DEFAULT NULL COMMENT 'TS,TS-TR,TR-TR',
  `plant_code` varchar(5) DEFAULT NULL,
  `transfer` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `t_hapas_detail_copy` */

insert  into `t_hapas_detail_copy`(`id`,`code_company`,`code_plant`,`kode`,`parent`,`uraian`,`nilai`,`luas`,`ton_tebu`,`ton_hablur`,`ton_gula`,`ton_gula_ptr`,`ton_gula_milik`,`jenis`,`kategori`,`plant_code`,`transfer`) values (2,'N011','KP12','0101','01','TEBU SENDIRI',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,2,NULL,'',0),(3,'N011','KP12','010101','0101','TS',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TS','',0),(4,'N011','KP12','010102','0101','SPT',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'SPT','',0),(5,'N011','KP12','010103','010107','TS dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TS-TR','',1),(6,'N011','KP12','010104','010107','TS dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TS-TR','',2),(7,'N011','KP12','010105','010107','TS dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TS-TR','',3),(8,'N011','KP12','010106','010107','TS dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TS-TR','',4),(9,'N011','KP12','010107','010000','Total TS Saudara',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0,NULL,'',10),(10,'N011','KP12','010108','010000','Total TS + TS Saudara',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0,'TS','',0),(11,'N011','KP12','0102','01','TEBU RAKYAT (TR)',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,2,NULL,'',0),(12,'N011','KP12','010201','0102','TR SENDIRI',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TR','',0),(13,'N011','KP12','010202','010206','TR dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TR-TR','',1),(14,'N011','KP12','010203','010206','TR dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TR-TR','',2),(15,'N011','KP12','010204','010206','TR dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TR-TR','',3),(16,'N011','KP12','010205','010206','TR dari',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,'TR-TR','',4),(17,'N011','KP12','010206','010000','TOTAL TR Sesaudara',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0,NULL,'',0),(18,'N011','KP12','010207','010000','Total TR Inc PG Sesaudara',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0,NULL,'',0),(55,'N011','KP12','0401',NULL,'Ton Hablur ex MS Tahun Lalu',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(56,'N011','KP12','0402',NULL,'Ton SHS ex MS Tahun yll',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(57,'N011','KP12','0403',NULL,'Ton SHS dihasilkan tahun ini',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(58,'N011','KP12','0404',NULL,'Ton SHS ex MS tahun ini',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(59,'N011','KP12','0405','0409','Ton Tetes sesuai LP 1',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(60,'N011','KP12','0406','0409','Ton Tetes  ex MS tahun yll',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(61,'N011','KP12','0407','0409','Ton Tetes  STO',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(62,'N011','KP12','0408','0409','Ton Tetes  ex RS',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(63,'N011','KP12','05',NULL,'OLAH MS',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0,NULL,'',10),(64,'N011','KP12','0501','05','Ton hablur ex MS tahun yll ',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(65,'N011','KP12','0502','05','Ton SHS ex MS tahun yll ',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(66,'N011','KP12','0503','05','Ton Tetes  ex MS tahun yll ',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,1,NULL,'',0),(67,'N011','KP12','0103','01000','TOTAL TS + TR',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,3,NULL,'',0),(70,'N011','KP12','0409','01000','Ton TETES Total',0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0.0000,0,NULL,'',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


insert into `tb_menu` (`parent_id`, `module`, `url`, `menu_name`, `menu_type`, `role_id`, `deep`, `ordering`, `position`, `menu_icons`, `active`, `access_data`, `allow_guest`, `menu_lang`, `entry_by`) values('0','thapas','','Hasil Pasti','internal','0','0','24','sidebar','fa fa-file','1','{\"1\":\"1\",\"2\":\"1\",\"3\":\"0\",\"4\":\"0\",\"6\":\"0\",\"7\":\"1\",\"8\":\"0\",\"9\":\"0\",\"10\":\"1\",\"11\":\"1\",\"12\":\"1\",\"13\":\"1\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\"}','0',NULL,'22');

