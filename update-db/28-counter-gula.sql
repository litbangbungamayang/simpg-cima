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
/*Table structure for table `t_counter_gula` */

DROP TABLE IF EXISTS `t_counter_gula`;

CREATE TABLE `t_counter_gula` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `jalur` varchar(2) DEFAULT NULL,
  `cekscale` int(20) DEFAULT NULL,
  `conveyor` int(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jam` varchar(5) DEFAULT NULL,
  `status` smallint(1) DEFAULT NULL COMMENT '1. asli sensor 2. revisi',
  `lates_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `t_counter_gula_detail` */

DROP TABLE IF EXISTS `t_counter_gula_detail`;

CREATE TABLE `t_counter_gula_detail` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `jalur` varchar(2) DEFAULT NULL,
  `cekscale` smallint(1) DEFAULT NULL,
  `conveyor` smallint(1) DEFAULT NULL,
  `tgl_pengakuan` date DEFAULT NULL,
  `jam_pengakuan` time DEFAULT NULL,
  `tgl_act` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jalur` (`jalur`,`cekscale`),
  KEY `tgl_pengakuan` (`tgl_pengakuan`),
  KEY `jam_pengakuan` (`jam_pengakuan`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
