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
/* Trigger structure for table `t_selektor` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_selektor_update` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_selektor_update` AFTER UPDATE ON `t_selektor` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
	INSERT tb_logs_sync_process (t_table,t_id,tgl_inp,t_status) VALUES ('t_selektor',NEW.id_spta,NOW(),0);
#    if NEW.tanaman_status = 1 then
#	SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spta;
#	UPDATE sap_field SET luas_tebang = luas_tebang+NEW.ha_tertebang WHERE kode_blok=temp_noblok;
#    end if;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
