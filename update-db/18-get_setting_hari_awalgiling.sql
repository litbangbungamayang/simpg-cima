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
/*Table structure for table `tb_setting` */

DROP TABLE IF EXISTS `tb_setting`;

CREATE TABLE `tb_setting` (
  `awal_giling` date DEFAULT NULL,
  `faktor_konv` double(4,2) DEFAULT NULL,
  `faktor_rend` double(4,2) DEFAULT NULL,
  `faktor_perah` double(4,2) DEFAULT NULL,
  `log_simpan` datetime DEFAULT NULL,
  `log_user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_setting` */

/* Function  structure for function  `get_hari_giling` */

/*!50003 DROP FUNCTION IF EXISTS `get_hari_giling` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_hari_giling`() RETURNS int(11)
BEGIN
	declare hargil int;
	declare temptgl date;
	declare temphargil int;
	select ifnull(awal_giling,now()) into temptgl from tb_setting;
	set temphargil = datediff(get_tgl_giling(),ifnull(temptgl,get_tgl_giling()));
	set hargil = temphargil+1;
	
	return hargil;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
