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

DROP VIEW IF EXISTS `vw_laporan_prod`;

/*View structure for view vw_laporan_prod */

/*!50001 DROP TABLE IF EXISTS `vw_laporan_prod` */;
/*!50001 DROP VIEW IF EXISTS `vw_laporan_prod` */;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_laporan_prod` AS select `a`.`id` AS `id`,`a`.`no_spat` AS `no_spat`,`get_kode_kat_lahan_ptp`(`a`.`kode_kat_lahan`,`b`.`jenis_tanah`,`b`.`status_blok`) AS `kat_ptp`,`a`.`kode_kat_lahan` AS `kode_kat_lahan`,`b`.`jenis_tanah` AS `jenis_tanah`,`b`.`status_blok` AS `status_blok`,`g`.`ha_tertebang` AS `ha_tertebang_selektor`,`b`.`luas_tebang` AS `luas_ditebang_field`,`b`.`luas_ha` AS `luas_total_field`,`e`.`netto_final` AS `netto`,`f`.`gula_ptr` AS `gula_ptr`,`f`.`gula_pg` AS `gula_pg`,`f`.`tetes_pg` AS `tetes_pg`,`f`.`tetes_ptr` AS `tetes_ptr`,`f`.`hablur_ari` AS `hablur_ari`,`f`.`rendemen_ptr` AS `rendemen_ptr`,`a`.`hari_giling` AS `hari_giling`,`a`.`tgl_giling` AS `tgl_giling`,`a`.`tgl_timbang` AS `tgl_timbang`,`a`.`kode_plant_trasnfer` AS `kode_plant_trasnfer`,`a`.`selektor_status` AS `selektor_status`,`a`.`timb_netto_status` AS `timb_netto_status`,`a`.`ari_status` AS `ari_status`,`a`.`meja_tebu_status` AS `meja_tebu_status`,`a`.`sbh_status` AS `sbh_status` from ((((`t_spta` `a` join `sap_field` `b` on((`b`.`kode_blok` = `a`.`kode_blok`))) join `t_timbangan` `e` on((`e`.`id_spat` = `a`.`id`))) left join `t_ari` `f` on((`f`.`id_spta` = `a`.`id`))) join `t_selektor` `g` on((`g`.`id_spta` = `a`.`id`)));

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
