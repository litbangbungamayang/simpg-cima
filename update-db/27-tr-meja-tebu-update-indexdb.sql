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
/*Table structure for table `m_temp_nourut` */

DROP TABLE IF EXISTS `m_temp_nourut`;

CREATE TABLE `m_temp_nourut` (
  `tgl_giling` date DEFAULT NULL,
  `nourut` int(10) DEFAULT NULL,
  `gilingan` int(1) DEFAULT NULL,
  `dateupdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `m_temp_nourut` */

/* Trigger structure for table `t_meja_tebu` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_mejatebu_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_mejatebu_insert` AFTER INSERT ON `t_meja_tebu` FOR EACH ROW BEGIN
	declare nourutx int;
	declare nettostatus int;
	DECLARE temp_persen DOUBLE;
	DECLARE temp_tglmejatebu DATETIME;
	DECLARE temp_noblok VARCHAR(20);
	DECLARE temp_netto_final double;
	declare temp_tglgil date;
	
	set temp_tglgil = get_hari_giling();
	set nourutx = 0;
	
	select ifnull(nourut,0) into nourutx from m_temp_nourut where tgl_giling = get_tgl_giling() and gilingan=NEW.gilingan;
	if nourutx = 0 then
		insert m_temp_nourut values(get_tgl_giling(),1,NEW.gilingan,now());
		set nourutx = 1;
	else
		update m_temp_nourut set nourut = (nourutx+1), dateupdate = now() where gilingan=NEW.gilingan;
		SET nourutx = (nourutx+1);
	end if;
	#SELECT IFNULL(MAX(no_urut_analisa_rendemen),0)+1 into nourut FROM t_meja_tebu a JOIN t_spta b ON a.id_spta=b.id 
	#WHERE gilingan=NEW.gilingan AND b.hari_giling=get_hari_giling();
	#set @test = 11;
	
	
	select timb_netto_status into nettostatus from t_spta where id = NEW.id_spta;
	
	update t_spta set meja_tebu_status=1,meja_tebu_tgl=NEW.tgl_meja_tebu,hari_giling=get_hari_giling(),tgl_giling=get_tgl_giling(),
	no_urut_analisa_rendemen = IF(no_urut_analisa_rendemen=0,nourutx,no_urut_analisa_rendemen)
	 where id=NEW.id_spta;
	 
	 if nettostatus = 1 then
		SELECT IF(a.`rafraksi_aktif`=1,b.`persen_rafaksi`,0) INTO temp_persen FROM t_meja_tebu a INNER JOIN m_rafaksi b ON a.`kondisi_tebu`=b.`nilai` WHERE a.id_spta = NEW.id_spta;
		update t_timbangan set netto_final = (netto - (temp_persen*netto/100)),
		netto_rafaksi = (temp_persen*netto/100),
		rafaksi_prosentis = temp_persen,
		tgl_rafaksi = now() where id_spat = NEW.id_spta; 
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spta;
		
		SElect netto_final into temp_netto_final FROM t_timbangan WHERE id_spat = NEW.id_spta; 
		UPDATE sap_field SET total_tebang = (total_tebang+temp_netto_final) WHERE kode_blok=temp_noblok;
		
		
	 end if;
	 
	INSERT tb_logs_sync_process (t_table,t_id,tgl_inp,t_status) VALUES ('t_meja_tebu',NEW.id_spta,NOW(),0);
	 
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
