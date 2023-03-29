/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.19-MariaDB : Database - db_simpg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `sap_plant` */

DROP TABLE IF EXISTS `sap_plant`;

CREATE TABLE `sap_plant` (
  `id_plant` int(255) NOT NULL AUTO_INCREMENT,
  `nama_plant` varchar(255) DEFAULT NULL,
  `kode_plant` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id_plant`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `sap_plant` */

insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (1,'PG. JATIBARANG','IP29');
insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (2,'PG. PANGKA','IP30');
insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (3,'PG. SUMBERHARJO','IP31');
insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (4,'PG. SRAGI','IP32');
insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (5,'PG. RENDENG','IP33');
insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (6,'PG. MOJO','IP34');
insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (7,'PG. TASIKMADU','IP35');
insert  into `sap_plant`(`id_plant`,`nama_plant`,`kode_plant`) values (8,'PG. GONDANG BARU','IP36');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
