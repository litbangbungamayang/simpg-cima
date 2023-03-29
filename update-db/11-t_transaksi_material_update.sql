/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.10-MariaDB : Database - simpg_ptpn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `t_transaksi_material` */

DROP TABLE IF EXISTS `t_transaksi_material`;

CREATE TABLE `t_transaksi_material` (
  `id_transaksi` int(255) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(255) NOT NULL,
  `keterangan_transaksi` text,
  `jenis_transaksi` enum('Penerimaan','Pengiriman') DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`,`no_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
