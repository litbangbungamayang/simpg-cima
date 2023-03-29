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
/*Table structure for table `vw_laporan_prod` */

DROP TABLE IF EXISTS `vw_laporan_prod`;

/*!50001 CREATE TABLE  `vw_laporan_prod`(
 `id` int(11) ,
 `no_spat` varchar(50) ,
 `kat_ptp` varchar(10) ,
 `kode_kat_lahan` varchar(11) ,
 `jenis_tanah` varchar(3) ,
 `status_blok` varchar(3) ,
 `ha_tertebang_selektor` double(10,3) ,
 `luas_ditebang_field` double(10,3) ,
 `luas_total_field` double(10,3) ,
 `netto` int(8) ,
 `gula_ptr` double(10,2) ,
 `gula_pg` double(10,2) ,
 `tetes_pg` double(10,2) ,
 `tetes_ptr` double(10,2) ,
 `hablur_ari` double(10,2) ,
 `rendemen_ptr` double(10,4) ,
 `hari_giling` int(10) ,
 `tgl_giling` date ,
 `tgl_timbang` datetime ,
 `kode_plant_trasnfer` varchar(5) ,
 `selektor_status` smallint(1) ,
 `timb_netto_status` smallint(1) ,
 `ari_status` smallint(1) ,
 `meja_tebu_status` smallint(1) ,
 `sbh_status` smallint(1) 
)*/;

/*View structure for view vw_laporan_prod */

/*!50001 DROP TABLE IF EXISTS `vw_laporan_prod` */;
/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_laporan_prod` AS select `a`.`id` AS `id`,`a`.`no_spat` AS `no_spat`,`get_kode_kat_lahan_ptp`(`a`.`kode_kat_lahan`,`b`.`jenis_tanah`,`b`.`status_blok`) AS `kat_ptp`,`a`.`kode_kat_lahan` AS `kode_kat_lahan`,`b`.`jenis_tanah` AS `jenis_tanah`,`b`.`status_blok` AS `status_blok`,`g`.`ha_tertebang` AS `ha_tertebang_selektor`,`b`.`luas_tebang` AS `luas_ditebang_field`,`b`.`luas_ha` AS `luas_total_field`,`e`.`netto_final` AS `netto`,`f`.`gula_ptr` AS `gula_ptr`,`f`.`gula_pg` AS `gula_pg`,`f`.`tetes_pg` AS `tetes_pg`,`f`.`tetes_ptr` AS `tetes_ptr`,`f`.`hablur_ari` AS `hablur_ari`,`f`.`rendemen_ptr` AS `rendemen_ptr`,`a`.`hari_giling` AS `hari_giling`,`a`.`tgl_giling` AS `tgl_giling`,`e`.`tgl_netto` AS `tgl_timbang`,`a`.`kode_plant_trasnfer` AS `kode_plant_trasnfer`,`a`.`selektor_status` AS `selektor_status`,`a`.`timb_netto_status` AS `timb_netto_status`,`a`.`ari_status` AS `ari_status`,`a`.`meja_tebu_status` AS `meja_tebu_status`,`a`.`sbh_status` AS `sbh_status` from ((((`t_spta` `a` join `sap_field` `b` on((`b`.`kode_blok` = `a`.`kode_blok`))) join `t_timbangan` `e` on((`e`.`id_spat` = `a`.`id`))) left join `t_ari` `f` on((`f`.`id_spta` = `a`.`id`))) join `t_selektor` `g` on((`g`.`id_spta` = `a`.`id`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
