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


ALTER TABLE `t_spta` ADD COLUMN `tgl_timbang` DATE NULL AFTER `ari_tgl`;

ALTER TABLE `t_meja_tebu` CHANGE `kode_meja_tebu` `kode_meja_tebu` VARCHAR(5) CHARSET latin1 COLLATE latin1_swedish_ci NULL COMMENT 'meja tebu'; 


/* Trigger structure for table `sap_field_spt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_spt_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_spt_insert` AFTER INSERT ON `sap_field_spt` FOR EACH ROW BEGIN
	update sap_field set spt_status = 1, spt_tgl = now() where kode_blok = NEW.no_petak;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_ari` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_ari_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_ari_insert` AFTER INSERT ON `t_ari` FOR EACH ROW BEGIN
	declare nourut int;
	SELECT IFNULL(MAX(no_urut_analisa_rendemen),0)+1 into nourut FROM t_spta b WHERE date(ari_tgl)=date(NEW.tgl_ari);
	update t_spta set ari_status=if(NEW.ditolak_ari = 1,2,1),ari_tgl=NEW.tgl_ari,
	no_urut_analisa_rendemen = if(no_urut_analisa_rendemen=0,nourut,no_urut_analisa_rendemen) where id=NEW.id_spta;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_meja_tebu` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_mejatebu_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_mejatebu_insert` AFTER INSERT ON `t_meja_tebu` FOR EACH ROW BEGIN
	declare nourut int;
	declare nettostatus int;
	DECLARE temp_persen DOUBLE;
	DECLARE temp_tglmejatebu DATETIME;
	DECLARE temp_noblok VARCHAR(20);
	DECLARE temp_netto_final double;
	
	
	
	SELECT IFNULL(MAX(no_urut_analisa_rendemen),0)+1,timb_netto_status into nourut,nettostatus FROM t_meja_tebu a JOIN t_spta b ON a.id_spta=b.id WHERE gilingan=NEW.gilingan AND b.hari_giling=get_hari_giling();
	update t_spta set meja_tebu_status=1,meja_tebu_tgl=NEW.tgl_meja_tebu,hari_giling=get_hari_giling(),tgl_giling=get_tgl_giling(),
	no_urut_analisa_rendemen = IF(no_urut_analisa_rendemen=0,nourut,no_urut_analisa_rendemen)
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
	 
	 
    END */$$


DELIMITER ;

/* Trigger structure for table `t_selektor` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_selektor_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_selektor_insert` AFTER INSERT ON `t_selektor` FOR EACH ROW BEGIN
    declare temp_noblok varchar(20);
	
	update t_spta set selektor_status=if(NEW.ditolak_sel=1,2,1),selektor_tgl=NEW.tgl_selektor WHERE id=NEW.id_spta;
	 
    END */$$


DELIMITER ;

/* Trigger structure for table `t_selektor` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_selektor_update` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_selektor_update` AFTER UPDATE ON `t_selektor` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
    if NEW.tanaman_status = 1 then
	SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spta;
	UPDATE sap_field SET luas_tebang = luas_tebang+NEW.ha_tertebang WHERE kode_blok=temp_noblok;
    end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_spta` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_gen_no_spta` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_gen_no_spta` BEFORE INSERT ON `t_spta` FOR EACH ROW BEGIN
	DECLARE nilaimax INT;
	SELECT IFNULL(MAX(RIGHT(no_spat,4))+1,1) into nilaimax FROM `t_spta` WHERE tgl_spta = NEW.tgl_spta;
	SET NEW.no_spat = CONCAT(NEW.kode_plant,'-',DATE_FORMAT(DATE(NEW.tgl_spta),'%d%m%Y'),'-',LPAD(nilaimax,4,'0'));
    END */$$


DELIMITER ;

/* Trigger structure for table `t_timbang_material` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_tiket_material` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_tiket_material` BEFORE INSERT ON `t_timbang_material` FOR EACH ROW BEGIN
DECLARE nilaimax INT;
	SELECT IFNULL(MAX(RIGHT(no_tiket,4))+1,1) INTO nilaimax FROM `t_timbang_material` WHERE DATE(tgl_timbang_1) = DATE(NOW());
	SET NEW.no_tiket = CONCAT(DATE_FORMAT(DATE(NEW.tgl_timbang_1),'%d%m%Y'),'-MT-',LPAD(nilaimax,4,'0'));
	
    END */$$


DELIMITER ;

/* Trigger structure for table `t_timbangan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_timbangan_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_timbangan_insert` AFTER INSERT ON `t_timbangan` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
	if NEW.netto != 0 and NEW.bruto = 0 then
	/*jika timbang langsung netto*/
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spat;
		update t_spta set timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto,timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto,tgl_timbang = get_tgl_giling() where id = NEW.id_spat;
		
	elseif NEW.netto != 0 AND NEW.bruto != 0 THEN
	/*jika timbang langsung netto*/
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spat;
		UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto,timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto,tgl_timbang = get_tgl_giling() WHERE id = NEW.id_spat;
		
	ELSEIF NEW.netto = 0 and NEW.bruto != 0 then
	/*jika timbang bruto - tara*/
		UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto WHERE id = NEW.id_spat;
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_timbangan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_timbangan_update` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_timbangan_update` BEFORE UPDATE ON `t_timbangan` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
    declare temp_persen double;
    declare temp_tglmejatebu datetime;
    DECLARE statusmejatebu int;
	if NEW.netto != 0 then
		SELECT kode_blok,meja_tebu_tgl,meja_tebu_status INTO temp_noblok,temp_tglmejatebu,statusmejatebu FROM t_spta WHERE id=NEW.id_spat;
		
		if statusmejatebu = 1 then
		SELECT IF(a.`rafraksi_aktif`=1,b.`persen_rafaksi`,0) into temp_persen FROM t_meja_tebu a INNER JOIN m_rafaksi b ON a.`kondisi_tebu`=b.`nilai` where a.id_spta = NEW.id_spat;
		UPDATE t_spta SET timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto WHERE id = NEW.id_spat;
		set NEW.rafaksi_prosentis = temp_persen;
		SET NEW.netto_rafaksi = (NEW.netto*temp_persen)/100;
		set NEW.netto_final = NEW.netto -  (NEW.netto*temp_persen)/100;
		SET NEW.tgl_rafaksi = temp_tglmejatebu;
		UPDATE sap_field SET total_tebang = (total_tebang+NEW.netto_final) WHERE kode_blok=temp_noblok;
		end if;
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_ubah_timbangan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_no_ajuan_timbangan` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_no_ajuan_timbangan` BEFORE INSERT ON `t_ubah_timbangan` FOR EACH ROW BEGIN

DECLARE nilaimax INT;

	SELECT IFNULL(MAX(RIGHT(no_ajuan,4))+1,1) INTO nilaimax FROM `t_ubah_timbangan` WHERE DATE(tgl_perubahan) = DATE(NOW());

	SET NEW.no_ajuan = CONCAT(SUBSTRING(new.no_spat,1,4),'-',DATE_FORMAT(DATE(NOW()),'%d%m%y'),'-T-',LPAD(nilaimax,4,'0'));

	SET new.tgl_perubahan = NOW();

    END */$$


DELIMITER ;

/* Function  structure for function  `get_hablur_ari` */

/*!50003 DROP FUNCTION IF EXISTS `get_hablur_ari` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_hablur_ari`(netto double,rendemen double(10,2)) RETURNS double
BEGIN
    declare hasil double;
    set hasil = netto*rendemen/100;
	return ROUND_UP(hasil,2);
    END */$$
DELIMITER ;

/* Function  structure for function  `get_hari_giling` */

/*!50003 DROP FUNCTION IF EXISTS `get_hari_giling` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_hari_giling`() RETURNS int(11)
BEGIN
	declare hargil int;
	declare temptgl date;
	declare temphargil int;
	
	select ifnull(max(tgl_giling),get_tgl_giling()) into temptgl from t_spta;
	
	set temphargil = datediff(get_tgl_giling(),temptgl);
	if temphargil = 0 then
		set temphargil = 1;
	end if;
	
	SELECT IFNULL(MAX(hari_giling),(SELECT IFNULL(MAX(hari_giling),0) FROM t_spta)+temphargil) into hargil FROM t_spta WHERE tgl_giling=get_tgl_giling();
	return hargil;
    END */$$
DELIMITER ;

/* Function  structure for function  `get_kode_kat_lahan_ptp` */

/*!50003 DROP FUNCTION IF EXISTS `get_kode_kat_lahan_ptp` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_kode_kat_lahan_ptp`(`_ket_sap` VARCHAR(10),`_jenis_tanah_sap` VARCHAR(10),`_status_blok_sap` VARCHAR(10)) RETURNS varchar(10) CHARSET latin1
BEGIN
	#Routine body goes here...
	DECLARE _kode_kat_ptp VARCHAR(10);
SELECT 
    a.kode_kat_ptp INTO _kode_kat_ptp
  FROM
    m_kat_lahan_ptp as a
  WHERE kat_sap = _ket_sap 
    AND `jenis_tanah_sap` LIKE CONCAT('%', TRIM(IFNULL(_jenis_tanah_sap, '')), '%') 
    AND `status_blok_sap` LIKE CONCAT('%', TRIM(IFNULL(_status_blok_sap, '')), '%');
	RETURN _kode_kat_ptp;
END */$$
DELIMITER ;

/* Function  structure for function  `get_tgl_giling` */

/*!50003 DROP FUNCTION IF EXISTS `get_tgl_giling` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_tgl_giling`() RETURNS date
BEGIN
	DECLARE tgl date;
	SELECT IF(STR_TO_DATE(now(),'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(now()),' 05:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(NOW(),'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(NOW(),'%Y-%m-%d')) into tgl;
	return tgl;
    END */$$
DELIMITER ;

/* Function  structure for function  `NewProc` */

/*!50003 DROP FUNCTION IF EXISTS `NewProc` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `NewProc`(`_ket_sap` VARCHAR(10),`_jenis_tanah_sap` VARCHAR(10),`_status_blok_sap` VARCHAR(10)) RETURNS int(11)
BEGIN
	#Routine body goes here...
	DECLARE _kode_kat_ptp VARCHAR(10);
SELECT 
    a.kode_kat_ptp INTO _kode_kat_ptp
  FROM
    m_kat_lahan_ptp as a
  WHERE kat_sap = _ket_sap 
    AND `jenis_tanah_sap` LIKE CONCAT(TRIM(IFNULL(_jenis_tanah_sap, '')), '%') 
    AND `status_blok_sap` LIKE CONCAT(TRIM(IFNULL(_status_blok_sap, '')), '%');
	RETURN _kode_kat_ptp;
END */$$
DELIMITER ;

/* Function  structure for function  `ROUND_UP` */

/*!50003 DROP FUNCTION IF EXISTS `ROUND_UP` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `ROUND_UP`(num DECIMAL(32,16), places INT) RETURNS decimal(32,2)
    DETERMINISTIC
RETURN CASE WHEN num < 0
THEN - ceil(abs(num) * power(10, places)) / power(10, places)
ELSE ceil(abs(num) * power(10, places)) / power(10, places)
END */$$
DELIMITER ;

/* Function  structure for function  `get_rendemen_bagihasil_ptr` */

/*!50003 DROP FUNCTION IF EXISTS `get_rendemen_bagihasil_ptr` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_rendemen_bagihasil_ptr`( vkat varchar(2), vrendemen double(10,2)) RETURNS double(10,4)
BEGIN
	/* jika rendemen < = 6 bagihasil = 66 % */
	/* jika rendemen >  6 bagihasil = 66 % dan < = 7.99 => 66% + (selisih dari 6 * 70%)*/
	/* jika rendemen >=  8 bagihasil =  66% + (selisih dari 6 * 75%)*/
	declare hslrendemen double(10,4);
	DECLARE temphslrendemen1 DOUBLE(10,4);
	DECLARE temphslrendemen2 DOUBLE(10,4);
	DECLARE temphslrendemen3 DOUBLE(10,4);
	declare selisih double(10,2);
	
	
	if vkat = 'TR' then
	if vrendemen <= 6 then
		set hslrendemen = vrendemen * 66 / 100;
	elseif vrendemen > 6 and vrendemen <= 8 then
		set temphslrendemen1  = 6.00 * 66 / 100;
		set selisih = vrendemen - 6.00;
		SET temphslrendemen2  = selisih * 70 / 100;
		set hslrendemen = temphslrendemen1+temphslrendemen2;
	elseif vrendemen > 8 then
		SET temphslrendemen1  = 6.00 * 66 / 100;
		set temphslrendemen2 = 2.00 * 70 / 100;
		SET selisih = vrendemen - 8.00;
		SET temphslrendemen3  = selisih * 75 / 100;
		SET hslrendemen = temphslrendemen1+temphslrendemen2+temphslrendemen3;
	end if;
	else
	 set hslrendemen = 0;
	end if;
	
	return hslrendemen;
    END */$$
DELIMITER ;

/*Table structure for table `vw_ari_data` */

DROP TABLE IF EXISTS `vw_ari_data`;

/*!50001 DROP VIEW IF EXISTS `vw_ari_data` */;
/*!50001 DROP TABLE IF EXISTS `vw_ari_data` */;

/*!50001 CREATE TABLE  `vw_ari_data`(
 `no_spat` varchar(50) ,
 `id_ari` int(11) ,
 `id_spta` int(11) ,
 `persen_brix_ari` double(10,2) ,
 `persen_pol_ari` double(10,2) ,
 `ph_ari` double(10,2) ,
 `hk` double(10,2) ,
 `nilai_nira` double(10,2) ,
 `faktor_rendemen` double(10,2) ,
 `faktor_konversi` double(10,2) ,
 `rendemen_individu` double(10,2) ,
 `faktor_regresi` double(10,4) ,
 `rendemen_ari` double(10,2) ,
 `hablur_ari` double(10,2) ,
 `ditolak_ari` smallint(1) ,
 `ditolak_alasan` text ,
 `tgl_ari` datetime ,
 `ptgs_ari` varchar(100) 
)*/;

/*Table structure for table `vw_detail_kuota_kkw` */

DROP TABLE IF EXISTS `vw_detail_kuota_kkw`;

/*!50001 DROP VIEW IF EXISTS `vw_detail_kuota_kkw` */;
/*!50001 DROP TABLE IF EXISTS `vw_detail_kuota_kkw` */;

/*!50001 CREATE TABLE  `vw_detail_kuota_kkw`(
 `idkuotakkw` bigint(11) ,
 `divisi` varchar(11) ,
 `kode_blok` varchar(20) ,
 `deskripsi_blok` varchar(255) ,
 `kepemilikan` varchar(6) ,
 `periode` varchar(3) ,
 `luas_ha` double(10,3) ,
 `kuota_spta` bigint(11) ,
 `id_spta_kuota_kkw` int(11) ,
 `id_spta_kuota` int(11) 
)*/;

/*Table structure for table `vw_lap_har_pengolahan_sum` */

DROP TABLE IF EXISTS `vw_lap_har_pengolahan_sum`;

/*!50001 DROP VIEW IF EXISTS `vw_lap_har_pengolahan_sum` */;
/*!50001 DROP TABLE IF EXISTS `vw_lap_har_pengolahan_sum` */;

/*!50001 CREATE TABLE  `vw_lap_har_pengolahan_sum`(
 `jam_berhenti_a_sum` double ,
 `jam_berhenti_b_sum` double ,
 `jam_kampanye_sum` double ,
 `kis_sum` double ,
 `kes_sum` double ,
 `prod_gula_sum` double ,
 `ex_sisan_gula_sum` double ,
 `sisan_diolah_sum` double ,
 `prod_tetes_sum` double ,
 `ex_sisan_tetes_sum` double ,
 `sto_tetes_sum` double ,
 `ex_repro_tll_sum` double ,
 `bba_sum` double ,
 `rupiah_bba_sum` double ,
 `gula_repro_tll_sum` double ,
 `raw_sugar_sum` double ,
 `gula_repro_th_ini_sum` double ,
 `ton_ampas_sum` double ,
 `persen_pol_ampas_sum` double ,
 `ton_blotong_sum` double ,
 `persen_pol_blotong_sum` double ,
 `ton_pol_dlm_hasil_plus_taksasi_sum` double ,
 `persen_pol_dlm_hasil_plus_taksasi_sum` double ,
 `tahun_giling` smallint(5) 
)*/;

/*Table structure for table `vw_master_afdeling` */

DROP TABLE IF EXISTS `vw_master_afdeling`;

/*!50001 DROP VIEW IF EXISTS `vw_master_afdeling` */;
/*!50001 DROP TABLE IF EXISTS `vw_master_afdeling` */;

/*!50001 CREATE TABLE  `vw_master_afdeling`(
 `id_affdeling` int(5) ,
 `nama_afdeling` varchar(100) ,
 `plant_kode` varchar(4) ,
 `Persno` varchar(11) ,
 `kode_affd` varchar(6) ,
 `karyawan` varchar(100) 
)*/;

/*Table structure for table `vw_master_karyawan` */

DROP TABLE IF EXISTS `vw_master_karyawan`;

/*!50001 DROP VIEW IF EXISTS `vw_master_karyawan` */;
/*!50001 DROP TABLE IF EXISTS `vw_master_karyawan` */;

/*!50001 CREATE TABLE  `vw_master_karyawan`(
 `id_karyawan` int(10) ,
 `Persno` varchar(11) ,
 `company_code` varchar(4) ,
 `plant_kode` varchar(5) ,
 `name` varchar(100) ,
 `id_jabatan` int(5) ,
 `nama_jabatan` varchar(100) 
)*/;

/*Table structure for table `vw_master_mejatebu` */

DROP TABLE IF EXISTS `vw_master_mejatebu`;

/*!50001 DROP VIEW IF EXISTS `vw_master_mejatebu` */;
/*!50001 DROP TABLE IF EXISTS `vw_master_mejatebu` */;

/*!50001 CREATE TABLE  `vw_master_mejatebu`(
 `id` smallint(1) ,
 `parent` smallint(1) ,
 `kode` varchar(4) ,
 `nama` varchar(100) ,
 `warna` varchar(100) ,
 `user_act` varchar(100) ,
 `tgl_act` datetime 
)*/;

/*Table structure for table `vw_master_pekerjaan_tma` */

DROP TABLE IF EXISTS `vw_master_pekerjaan_tma`;

/*!50001 DROP VIEW IF EXISTS `vw_master_pekerjaan_tma` */;
/*!50001 DROP TABLE IF EXISTS `vw_master_pekerjaan_tma` */;

/*!50001 CREATE TABLE  `vw_master_pekerjaan_tma`(
 `id_pekerjaan_tma` int(255) ,
 `nama_pekerjaan_tma` varchar(255) ,
 `nominal_atas` double ,
 `nominal_bawah` double ,
 `nominal_default` double ,
 `satuan` varchar(100) ,
 `tercetak_spat` smallint(1) ,
 `status_pekerjaan` smallint(1) ,
 `jenis` smallint(1) ,
 `satuan_text` varchar(18) ,
 `spat_text` varchar(5) ,
 `default_text` varchar(13) ,
 `jenis_txt` varchar(8) 
)*/;

/*Table structure for table `vw_masterfield_data` */

DROP TABLE IF EXISTS `vw_masterfield_data`;

/*!50001 DROP VIEW IF EXISTS `vw_masterfield_data` */;
/*!50001 DROP TABLE IF EXISTS `vw_masterfield_data` */;

/*!50001 CREATE TABLE  `vw_masterfield_data`(
 `divisi` varchar(11) ,
 `kepemilikan` varchar(6) ,
 `kode_blok` varchar(20) ,
 `deskripsi_blok` varchar(255) ,
 `nama_petani` varchar(255) ,
 `luas_ha` double(10,3) ,
 `luas_tebang` double(10,3) ,
 `sisa` varchar(21) ,
 `total_pokok` double ,
 `total_tebang` double ,
 `aff_tebang` smallint(1) 
)*/;

/*Table structure for table `vw_mejatebu_data` */

DROP TABLE IF EXISTS `vw_mejatebu_data`;

/*!50001 DROP VIEW IF EXISTS `vw_mejatebu_data` */;
/*!50001 DROP TABLE IF EXISTS `vw_mejatebu_data` */;

/*!50001 CREATE TABLE  `vw_mejatebu_data`(
 `no_spat` varchar(50) ,
 `id_mejatebu` int(11) ,
 `id_spta` int(11) ,
 `daduk` smallint(1) ,
 `sogolan` smallint(1) ,
 `pucuk` smallint(1) ,
 `akar_tanah` smallint(1) ,
 `non_tebu` smallint(1) ,
 `terbakar` smallint(1) ,
 `cacahan` smallint(1) ,
 `brondolan` smallint(1) ,
 `kondisi_tebu` varchar(1) ,
 `ptgs_meja_tebu` varchar(100) ,
 `gilingan` smallint(1) ,
 `kode_meja_tebu` varchar(5) ,
 `warna_meja_tebu` varchar(10) ,
 `tgl_meja_tebu` datetime ,
 `rafraksi_aktif` smallint(1) 
)*/;

/*Table structure for table `vw_sbh_data` */

DROP TABLE IF EXISTS `vw_sbh_data`;

/*!50001 DROP VIEW IF EXISTS `vw_sbh_data` */;
/*!50001 DROP TABLE IF EXISTS `vw_sbh_data` */;

/*!50001 CREATE TABLE  `vw_sbh_data`(
 `sbh_status` smallint(1) ,
 `id_ari` int(11) ,
 `id` int(11) ,
 `no_spat` varchar(50) ,
 `kode_kat_lahan` varchar(11) ,
 `kode_plant` varchar(5) ,
 `kode_affd` varchar(11) ,
 `kode_blok` varchar(20) ,
 `tgl_spta` date ,
 `tebang_pg` smallint(1) ,
 `angkut_pg` smallint(1) ,
 `jenis_spta` varchar(10) ,
 `no_angkutan` varchar(20) ,
 `nama_petani` varchar(255) ,
 `id_petani` varchar(20) ,
 `deskripsi_blok` varchar(255) ,
 `luas_ha` double(10,3) ,
 `ha_tertebang` double(10,3) ,
 `tgl_tebang` datetime ,
 `brix_sel` double(10,2) ,
 `ph_sel` double(10,2) ,
 `ditolak_sel` smallint(1) ,
 `ditolak_alasan` text ,
 `cetak_spta_tgl` datetime ,
 `selektor_tgl` datetime ,
 `timb_netto_tgl` datetime ,
 `meja_tebu_tgl` datetime ,
 `ari_tgl` datetime ,
 `sbh_tgl` varchar(19) ,
 `hari_giling` int(10) ,
 `tgl_giling` date ,
 `bruto` int(8) ,
 `tara` int(8) ,
 `netto_final` int(8) ,
 `kondisi_tebu` varchar(1) ,
 `daduk` smallint(1) ,
 `sogolan` smallint(1) ,
 `pucuk` smallint(1) ,
 `akar_tanah` smallint(1) ,
 `non_tebu` smallint(1) ,
 `terbakar` smallint(1) ,
 `cacahan` smallint(1) ,
 `brondolan` smallint(1) ,
 `persen_brix_ari` double(10,2) ,
 `persen_pol_ari` double(10,2) ,
 `ph_ari` double(10,2) ,
 `hk` double(10,2) ,
 `nilai_nira` double(10,2) ,
 `faktor_rendemen` double(10,2) ,
 `rendemen_ari` double(10,2) ,
 `aku_tgl` datetime ,
 `hablur_ari` double(19,2) ,
 `gula_total` double(19,2) ,
 `tetes_total` double(16,2) ,
 `rendemen_ptr` double(10,4) ,
 `gula_ptr` double(19,2) ,
 `tetes_ptr` double(19,2) ,
 `gula_pg` double(19,2) ,
 `tetes_pg` double(19,2) 
)*/;

/*Table structure for table `vw_selektor_data` */

DROP TABLE IF EXISTS `vw_selektor_data`;

/*!50001 DROP VIEW IF EXISTS `vw_selektor_data` */;
/*!50001 DROP TABLE IF EXISTS `vw_selektor_data` */;

/*!50001 CREATE TABLE  `vw_selektor_data`(
 `no_spat` varchar(50) ,
 `kode_blok` varchar(20) ,
 `deskripsi_blok` varchar(255) ,
 `kode_kat_lahan` varchar(11) ,
 `mandor` varchar(100) ,
 `id_selektor` int(11) ,
 `id_spta` int(11) ,
 `persno_mandor_tma` varchar(11) ,
 `tgl_tebang` datetime ,
 `no_angkutan` varchar(20) ,
 `ptgs_angkutan` varchar(100) ,
 `ha_tertebang` double(10,3) ,
 `terbakar_sel` smallint(1) ,
 `ditolak_sel` smallint(1) ,
 `ditolak_alasan` text ,
 `brix_sel` double(10,2) ,
 `ph_sel` double(10,2) ,
 `tgl_pintumasuk` datetime ,
 `ptgs_pintumasuk` varchar(100) ,
 `no_urut_timbang` int(5) ,
 `no_trainstat` varchar(8) ,
 `no_hv` varchar(10) ,
 `op_hv` varchar(100) ,
 `no_stipping` varchar(10) ,
 `op_stipping` varchar(100) ,
 `no_gl` varchar(10) ,
 `op_gl` varchar(100) ,
 `ptgs_selektor` varchar(100) ,
 `tgl_selektor` datetime ,
 `tgl_urut` date ,
 `no_urut` int(10) 
)*/;

/*Table structure for table `vw_spt_data` */

DROP TABLE IF EXISTS `vw_spt_data`;

/*!50001 DROP VIEW IF EXISTS `vw_spt_data` */;
/*!50001 DROP TABLE IF EXISTS `vw_spt_data` */;

/*!50001 CREATE TABLE  `vw_spt_data`(
 `kode_blok` varchar(20) ,
 `divisi` varchar(11) ,
 `luas_ha` double(10,3) ,
 `tahun_tanam` decimal(4,0) ,
 `periode` varchar(3) ,
 `status_blok` varchar(3) ,
 `kepemilikan` varchar(6) ,
 `kode_varietas` varchar(4) ,
 `no_petak` varchar(100) ,
 `no_surat` varchar(150) ,
 `h_brix_kebun` double(10,2) ,
 `h_brix` double(10,2) ,
 `h_pol` double(10,2) ,
 `h_fk` double(10,2) ,
 `h_kp` double(10,2) ,
 `h_kdt` double(10,2) ,
 `h_tscore` double(10,2) ,
 `h_tglanalisa` date ,
 `keterangan` text ,
 `user_act` varchar(100) ,
 `tgl_act` datetime ,
 `status` smallint(1) 
)*/;

/*Table structure for table `vw_spta_luas_field_sap_kat_ptp` */

DROP TABLE IF EXISTS `vw_spta_luas_field_sap_kat_ptp`;

/*!50001 DROP VIEW IF EXISTS `vw_spta_luas_field_sap_kat_ptp` */;
/*!50001 DROP TABLE IF EXISTS `vw_spta_luas_field_sap_kat_ptp` */;

/*!50001 CREATE TABLE  `vw_spta_luas_field_sap_kat_ptp`(
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
 `nama_petani` varchar(255) ,
 `selektor_status` smallint(1) ,
 `timb_netto_status` smallint(1) ,
 `ari_status` smallint(1) 
)*/;

/*Table structure for table `vw_t_timbangan` */

DROP TABLE IF EXISTS `vw_t_timbangan`;

/*!50001 DROP VIEW IF EXISTS `vw_t_timbangan` */;
/*!50001 DROP TABLE IF EXISTS `vw_t_timbangan` */;

/*!50001 CREATE TABLE  `vw_t_timbangan`(
 `no_spat` varchar(50) ,
 `timb_bruto_status` smallint(1) ,
 `timb_netto_status` smallint(1) ,
 `timb_netto_tgl` datetime ,
 `timb_bruto_tgl` datetime ,
 `kode_blok` varchar(20) ,
 `nama_petani` varchar(255) ,
 `deskripsi_blok` varchar(255) ,
 `id_timbangan` int(11) ,
 `id_spat` int(11) ,
 `lokasi_timbang_1` varchar(10) ,
 `lokasi_timbang_2` varchar(10) ,
 `bruto` int(8) ,
 `tara` int(8) ,
 `netto` int(8) ,
 `netto_final` int(8) ,
 `netto_rafaksi` int(8) ,
 `rafaksi_prosentis` double ,
 `tgl_bruto` datetime ,
 `tgl_tara` datetime ,
 `tgl_netto` datetime ,
 `tgl_rafaksi` datetime ,
 `transloading_status` smallint(1) ,
 `no_transloading` varchar(10) ,
 `ptgs_transloading` varchar(100) ,
 `ptgs_timbang_1` varchar(100) ,
 `ptgs_timbang_2` varchar(100) ,
 `tgl_transloading` datetime ,
 `multi_sling` varchar(100) ,
 `netto_sebelum_koreksi` int(8) ,
 `ket_koreksi_timbangan` text ,
 `train_stat` varchar(8) ,
 `no_lori` varchar(8) ,
 `no_loko` varchar(8) 
)*/;

/*Table structure for table `vw_upah_angkut` */

DROP TABLE IF EXISTS `vw_upah_angkut`;

/*!50001 DROP VIEW IF EXISTS `vw_upah_angkut` */;
/*!50001 DROP TABLE IF EXISTS `vw_upah_angkut` */;

/*!50001 CREATE TABLE  `vw_upah_angkut`(
 `id` int(10) ,
 `kode_tx` varchar(20) ,
 `tgl` date ,
 `vendor_id` int(10) ,
 `tgl_awal` date ,
 `tgl_akhir` date ,
 `total` double ,
 `status` smallint(1) ,
 `user_act` varchar(100) ,
 `tgl_act` datetime ,
 `nama_vendor` varchar(255) 
)*/;

/*Table structure for table `vw_upah_tebang` */

DROP TABLE IF EXISTS `vw_upah_tebang`;

/*!50001 DROP VIEW IF EXISTS `vw_upah_tebang` */;
/*!50001 DROP TABLE IF EXISTS `vw_upah_tebang` */;

/*!50001 CREATE TABLE  `vw_upah_tebang`(
 `id` int(20) ,
 `tgl` date ,
 `no_bukti` varchar(10) ,
 `kode_blok` varchar(100) ,
 `persno_pta` varchar(11) ,
 `persno_mandor` varchar(11) ,
 `keterangan` text ,
 `ttl_item` int(10) ,
 `status` smallint(1) ,
 `user_act` varchar(100) ,
 `tgl_act` datetime ,
 `deskripsi_blok` varchar(255) ,
 `kepemilikan` varchar(6) ,
 `luas_ha` double(10,3) ,
 `pta` varchar(100) ,
 `mandor` varchar(100) ,
 `nama_petani` varchar(255) 
)*/;

/*View structure for view vw_ari_data */

/*!50001 DROP TABLE IF EXISTS `vw_ari_data` */;
/*!50001 DROP VIEW IF EXISTS `vw_ari_data` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_ari_data` AS (select `a`.`no_spat` AS `no_spat`,`b`.`id_ari` AS `id_ari`,`b`.`id_spta` AS `id_spta`,`b`.`persen_brix_ari` AS `persen_brix_ari`,`b`.`persen_pol_ari` AS `persen_pol_ari`,`b`.`ph_ari` AS `ph_ari`,`b`.`hk` AS `hk`,`b`.`nilai_nira` AS `nilai_nira`,`b`.`faktor_rendemen` AS `faktor_rendemen`,`b`.`faktor_konversi` AS `faktor_konversi`,`b`.`rendemen_individu` AS `rendemen_individu`,`b`.`faktor_regresi` AS `faktor_regresi`,`b`.`rendemen_ari` AS `rendemen_ari`,`b`.`hablur_ari` AS `hablur_ari`,`b`.`ditolak_ari` AS `ditolak_ari`,`b`.`ditolak_alasan` AS `ditolak_alasan`,`b`.`tgl_ari` AS `tgl_ari`,`b`.`ptgs_ari` AS `ptgs_ari` from (`t_spta` `a` join `t_ari` `b` on((`a`.`id` = `b`.`id_spta`)))) */;

/*View structure for view vw_detail_kuota_kkw */

/*!50001 DROP TABLE IF EXISTS `vw_detail_kuota_kkw` */;
/*!50001 DROP VIEW IF EXISTS `vw_detail_kuota_kkw` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_detail_kuota_kkw` AS (select ifnull(`b`.`id`,0) AS `idkuotakkw`,`a`.`divisi` AS `divisi`,`a`.`kode_blok` AS `kode_blok`,`a`.`deskripsi_blok` AS `deskripsi_blok`,`a`.`kepemilikan` AS `kepemilikan`,`a`.`periode` AS `periode`,`a`.`luas_ha` AS `luas_ha`,ifnull(`b`.`kouta_tot`,0) AS `kuota_spta`,`b`.`id_spta_kuota_kkw` AS `id_spta_kuota_kkw`,`b`.`id_spta_kuota` AS `id_spta_kuota` from (`sap_field` `a` left join `t_spta_kuota_tot` `b` on((`a`.`kode_blok` = `b`.`kode_blok`)))) */;

/*View structure for view vw_lap_har_pengolahan_sum */

/*!50001 DROP TABLE IF EXISTS `vw_lap_har_pengolahan_sum` */;
/*!50001 DROP VIEW IF EXISTS `vw_lap_har_pengolahan_sum` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_lap_har_pengolahan_sum` AS select sum(`t_lap_harian_pengolahan`.`jam_berhenti_a`) AS `jam_berhenti_a_sum`,sum(`t_lap_harian_pengolahan`.`jam_berhenti_b`) AS `jam_berhenti_b_sum`,sum(`t_lap_harian_pengolahan`.`jam_kampanye`) AS `jam_kampanye_sum`,sum(`t_lap_harian_pengolahan`.`kis`) AS `kis_sum`,sum(`t_lap_harian_pengolahan`.`kes`) AS `kes_sum`,sum(`t_lap_harian_pengolahan`.`prod_gula`) AS `prod_gula_sum`,sum(`t_lap_harian_pengolahan`.`ex_sisan_gula`) AS `ex_sisan_gula_sum`,sum(`t_lap_harian_pengolahan`.`sisan_diolah`) AS `sisan_diolah_sum`,sum(`t_lap_harian_pengolahan`.`prod_tetes`) AS `prod_tetes_sum`,sum(`t_lap_harian_pengolahan`.`ex_sisan_tetes`) AS `ex_sisan_tetes_sum`,sum(`t_lap_harian_pengolahan`.`sto_tetes`) AS `sto_tetes_sum`,sum(`t_lap_harian_pengolahan`.`ex_repro_tll`) AS `ex_repro_tll_sum`,sum(`t_lap_harian_pengolahan`.`bba`) AS `bba_sum`,sum(`t_lap_harian_pengolahan`.`rupiah_bba`) AS `rupiah_bba_sum`,sum(`t_lap_harian_pengolahan`.`gula_repro_tll`) AS `gula_repro_tll_sum`,sum(`t_lap_harian_pengolahan`.`raw_sugar`) AS `raw_sugar_sum`,sum(`t_lap_harian_pengolahan`.`gula_repro_th_ini`) AS `gula_repro_th_ini_sum`,sum(`t_lap_harian_pengolahan`.`ton_ampas`) AS `ton_ampas_sum`,sum(`t_lap_harian_pengolahan`.`persen_pol_ampas`) AS `persen_pol_ampas_sum`,sum(`t_lap_harian_pengolahan`.`ton_blotong`) AS `ton_blotong_sum`,sum(`t_lap_harian_pengolahan`.`persen_pol_blotong`) AS `persen_pol_blotong_sum`,sum(`t_lap_harian_pengolahan`.`ton_pol_dlm_hasil_plus_taksasi`) AS `ton_pol_dlm_hasil_plus_taksasi_sum`,sum(`t_lap_harian_pengolahan`.`persen_pol_dlm_hasil_plus_taksasi`) AS `persen_pol_dlm_hasil_plus_taksasi_sum`,`t_lap_harian_pengolahan`.`tahun_giling` AS `tahun_giling` from `t_lap_harian_pengolahan` group by `t_lap_harian_pengolahan`.`tahun_giling` */;

/*View structure for view vw_master_afdeling */

/*!50001 DROP TABLE IF EXISTS `vw_master_afdeling` */;
/*!50001 DROP VIEW IF EXISTS `vw_master_afdeling` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_master_afdeling` AS (select `a`.`id_affdeling` AS `id_affdeling`,`a`.`nama_afdeling` AS `nama_afdeling`,`a`.`plant_kode` AS `plant_kode`,`a`.`Persno` AS `Persno`,`a`.`kode_affd` AS `kode_affd`,`b`.`name` AS `karyawan` from (`sap_m_affdeling` `a` join `sap_m_karyawan` `b` on((convert(`a`.`Persno` using utf8) = `b`.`Persno`)))) */;

/*View structure for view vw_master_karyawan */

/*!50001 DROP TABLE IF EXISTS `vw_master_karyawan` */;
/*!50001 DROP VIEW IF EXISTS `vw_master_karyawan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_master_karyawan` AS (select `a`.`id_karyawan` AS `id_karyawan`,`a`.`Persno` AS `Persno`,`a`.`company_code` AS `company_code`,`a`.`plant_kode` AS `plant_kode`,`a`.`name` AS `name`,`a`.`id_jabatan` AS `id_jabatan`,`b`.`nama_jabatan` AS `nama_jabatan` from (`sap_m_karyawan` `a` join `m_jabatan` `b` on((`a`.`id_jabatan` = `b`.`id_jabatan`)))) */;

/*View structure for view vw_master_mejatebu */

/*!50001 DROP TABLE IF EXISTS `vw_master_mejatebu` */;
/*!50001 DROP VIEW IF EXISTS `vw_master_mejatebu` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_master_mejatebu` AS (select `m_mejatebu`.`id` AS `id`,`m_mejatebu`.`parent` AS `parent`,`m_mejatebu`.`kode` AS `kode`,`m_mejatebu`.`nama` AS `nama`,`m_mejatebu`.`warna` AS `warna`,`m_mejatebu`.`user_act` AS `user_act`,`m_mejatebu`.`tgl_act` AS `tgl_act` from `m_mejatebu` where (`m_mejatebu`.`parent` = 0)) */;

/*View structure for view vw_master_pekerjaan_tma */

/*!50001 DROP TABLE IF EXISTS `vw_master_pekerjaan_tma` */;
/*!50001 DROP VIEW IF EXISTS `vw_master_pekerjaan_tma` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_master_pekerjaan_tma` AS (select `m_pekerjaan_tma`.`id_pekerjaan_tma` AS `id_pekerjaan_tma`,`m_pekerjaan_tma`.`nama_pekerjaan_tma` AS `nama_pekerjaan_tma`,`m_pekerjaan_tma`.`nominal_atas` AS `nominal_atas`,`m_pekerjaan_tma`.`nominal_bawah` AS `nominal_bawah`,`m_pekerjaan_tma`.`nominal_default` AS `nominal_default`,`m_pekerjaan_tma`.`satuan` AS `satuan`,`m_pekerjaan_tma`.`tercetak_spat` AS `tercetak_spat`,`m_pekerjaan_tma`.`status_pekerjaan` AS `status_pekerjaan`,`m_pekerjaan_tma`.`jenis` AS `jenis`,if((`m_pekerjaan_tma`.`satuan` = 1),'Bobot/Kg','Angkutan/Truk/Lori') AS `satuan_text`,if((`m_pekerjaan_tma`.`tercetak_spat` = 1),'Ya','Tidak') AS `spat_text`,if((`m_pekerjaan_tma`.`status_pekerjaan` = 1),'Default',if((`m_pekerjaan_tma`.`status_pekerjaan` = 2),'Non Aktif','Tidak Default')) AS `default_text`,if((`m_pekerjaan_tma`.`jenis` = 1),'Upah','Potongan') AS `jenis_txt` from `m_pekerjaan_tma`) */;

/*View structure for view vw_masterfield_data */

/*!50001 DROP TABLE IF EXISTS `vw_masterfield_data` */;
/*!50001 DROP VIEW IF EXISTS `vw_masterfield_data` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_masterfield_data` AS (select `a`.`divisi` AS `divisi`,`a`.`kepemilikan` AS `kepemilikan`,`a`.`kode_blok` AS `kode_blok`,`a`.`deskripsi_blok` AS `deskripsi_blok`,`b`.`nama_petani` AS `nama_petani`,`a`.`luas_ha` AS `luas_ha`,`a`.`luas_tebang` AS `luas_tebang`,concat(round((((`a`.`luas_ha` - `a`.`luas_tebang`) / `a`.`luas_ha`) * 100),2),' %') AS `sisa`,`a`.`total_pokok` AS `total_pokok`,`a`.`total_tebang` AS `total_tebang`,`a`.`aff_tebang` AS `aff_tebang` from (`sap_field` `a` left join `sap_petani` `b` on((`a`.`id_petani_sap` = `b`.`id_petani_sap`))) group by `a`.`kode_blok`) */;

/*View structure for view vw_mejatebu_data */

/*!50001 DROP TABLE IF EXISTS `vw_mejatebu_data` */;
/*!50001 DROP VIEW IF EXISTS `vw_mejatebu_data` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_mejatebu_data` AS (select `b`.`no_spat` AS `no_spat`,`a`.`id_mejatebu` AS `id_mejatebu`,`a`.`id_spta` AS `id_spta`,`a`.`daduk` AS `daduk`,`a`.`sogolan` AS `sogolan`,`a`.`pucuk` AS `pucuk`,`a`.`akar_tanah` AS `akar_tanah`,`a`.`non_tebu` AS `non_tebu`,`a`.`terbakar` AS `terbakar`,`a`.`cacahan` AS `cacahan`,`a`.`brondolan` AS `brondolan`,`a`.`kondisi_tebu` AS `kondisi_tebu`,`a`.`ptgs_meja_tebu` AS `ptgs_meja_tebu`,`a`.`gilingan` AS `gilingan`,`a`.`kode_meja_tebu` AS `kode_meja_tebu`,`a`.`warna_meja_tebu` AS `warna_meja_tebu`,`a`.`tgl_meja_tebu` AS `tgl_meja_tebu`,`a`.`rafraksi_aktif` AS `rafraksi_aktif` from (`t_meja_tebu` `a` join `t_spta` `b` on((`a`.`id_spta` = `b`.`id`)))) */;

/*View structure for view vw_sbh_data */

/*!50001 DROP TABLE IF EXISTS `vw_sbh_data` */;
/*!50001 DROP VIEW IF EXISTS `vw_sbh_data` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_sbh_data` AS (select sql_no_cache `a`.`sbh_status` AS `sbh_status`,`f`.`id_ari` AS `id_ari`,`a`.`id` AS `id`,`a`.`no_spat` AS `no_spat`,`a`.`kode_kat_lahan` AS `kode_kat_lahan`,`a`.`kode_plant` AS `kode_plant`,`a`.`kode_affd` AS `kode_affd`,`a`.`kode_blok` AS `kode_blok`,`a`.`tgl_spta` AS `tgl_spta`,`a`.`tebang_pg` AS `tebang_pg`,`a`.`angkut_pg` AS `angkut_pg`,`a`.`jenis_spta` AS `jenis_spta`,`c`.`no_angkutan` AS `no_angkutan`,`g`.`nama_petani` AS `nama_petani`,`g`.`id_petani_sap` AS `id_petani`,`b`.`deskripsi_blok` AS `deskripsi_blok`,`b`.`luas_ha` AS `luas_ha`,`c`.`ha_tertebang` AS `ha_tertebang`,`c`.`tgl_tebang` AS `tgl_tebang`,`c`.`brix_sel` AS `brix_sel`,`c`.`ph_sel` AS `ph_sel`,`c`.`ditolak_sel` AS `ditolak_sel`,`c`.`ditolak_alasan` AS `ditolak_alasan`,`a`.`cetak_spta_tgl` AS `cetak_spta_tgl`,`a`.`selektor_tgl` AS `selektor_tgl`,`a`.`timb_netto_tgl` AS `timb_netto_tgl`,`a`.`meja_tebu_tgl` AS `meja_tebu_tgl`,`a`.`ari_tgl` AS `ari_tgl`,ifnull(`a`.`sbh_tgl`,'-') AS `sbh_tgl`,`a`.`hari_giling` AS `hari_giling`,`a`.`tgl_giling` AS `tgl_giling`,`d`.`bruto` AS `bruto`,`d`.`tara` AS `tara`,`d`.`netto_final` AS `netto_final`,`e`.`kondisi_tebu` AS `kondisi_tebu`,`e`.`daduk` AS `daduk`,`e`.`sogolan` AS `sogolan`,`e`.`pucuk` AS `pucuk`,`e`.`akar_tanah` AS `akar_tanah`,`e`.`non_tebu` AS `non_tebu`,`e`.`terbakar` AS `terbakar`,`e`.`cacahan` AS `cacahan`,`e`.`brondolan` AS `brondolan`,`f`.`persen_brix_ari` AS `persen_brix_ari`,`f`.`persen_pol_ari` AS `persen_pol_ari`,`f`.`ph_ari` AS `ph_ari`,`f`.`hk` AS `hk`,`f`.`nilai_nira` AS `nilai_nira`,`f`.`faktor_rendemen` AS `faktor_rendemen`,`f`.`rendemen_ari` AS `rendemen_ari`,`f`.`aku_tgl` AS `aku_tgl`,round(if((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2) AS `hablur_ari`,round(if((`f`.`gula_total` = 0),(if((`f`.`hablur_ari` = 0),round(if((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2) AS `gula_total`,if((`f`.`tetes_total` = 0),round(((4.5 * `d`.`netto_final`) / 100),2),`f`.`tetes_total`) AS `tetes_total`,if((left(`a`.`kode_kat_lahan`,2) = 'TR'),if((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(left(`a`.`kode_kat_lahan`,2),`f`.`rendemen_ari`),`f`.`rendemen_ptr`),0) AS `rendemen_ptr`,if((left(`a`.`kode_kat_lahan`,2) = 'TR'),round(if((`f`.`gula_ptr` = 0),(((`d`.`netto_final` * if((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(left(`a`.`kode_kat_lahan`,2),`f`.`rendemen_ari`),`f`.`rendemen_ptr`)) / 100) * 1.003),`f`.`gula_ptr`),2),0) AS `gula_ptr`,if((left(`a`.`kode_kat_lahan`,2) = 'TR'),round(if((`f`.`tetes_ptr` = 0),((3 * `d`.`netto_final`) / 100),`f`.`tetes_ptr`),2),0) AS `tetes_ptr`,if((left(`a`.`kode_kat_lahan`,2) = 'TR'),round(if((`f`.`gula_pg` = 0),(round(if((`f`.`gula_total` = 0),(if((`f`.`hablur_ari` = 0),round(if((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2) - round(if((`f`.`gula_ptr` = 0),(((`d`.`netto_final` * if((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(left(`a`.`kode_kat_lahan`,2),`f`.`rendemen_ari`),`f`.`rendemen_ptr`)) / 100) * 1.003),`f`.`gula_ptr`),2)),`f`.`gula_pg`),2),round(if((`f`.`gula_total` = 0),(if((`f`.`hablur_ari` = 0),round(if((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2)) AS `gula_pg`,if((left(`a`.`kode_kat_lahan`,2) = 'TR'),round(if((`f`.`tetes_pg` = 0),(if((`f`.`tetes_total` = 0),((4.5 * `d`.`netto_final`) / 100),`f`.`tetes_total`) - if((`f`.`tetes_ptr` = 0),((3 * `d`.`netto_final`) / 100),`f`.`tetes_ptr`)),`f`.`tetes_pg`),2),if((`f`.`tetes_total` = 0),round(((4.5 * `d`.`netto_final`) / 100),2),`f`.`tetes_total`)) AS `tetes_pg` from ((((((`t_spta` `a` join `sap_field` `b` on((`a`.`kode_blok` = `b`.`kode_blok`))) join `t_selektor` `c` on((`c`.`id_spta` = `a`.`id`))) join `t_timbangan` `d` on((`d`.`id_spat` = `a`.`id`))) join `t_meja_tebu` `e` on((`e`.`id_spta` = `a`.`id`))) join `t_ari` `f` on((`f`.`id_spta` = `a`.`id`))) left join `sap_petani` `g` on((`g`.`id_petani_sap` = `b`.`id_petani_sap`))) group by `a`.`id`) */;

/*View structure for view vw_selektor_data */

/*!50001 DROP TABLE IF EXISTS `vw_selektor_data` */;
/*!50001 DROP VIEW IF EXISTS `vw_selektor_data` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_selektor_data` AS (select `b`.`no_spat` AS `no_spat`,`b`.`kode_blok` AS `kode_blok`,`e`.`deskripsi_blok` AS `deskripsi_blok`,`b`.`kode_kat_lahan` AS `kode_kat_lahan`,`c`.`name` AS `mandor`,`a`.`id_selektor` AS `id_selektor`,`a`.`id_spta` AS `id_spta`,`a`.`persno_mandor_tma` AS `persno_mandor_tma`,`a`.`tgl_tebang` AS `tgl_tebang`,`a`.`no_angkutan` AS `no_angkutan`,`a`.`ptgs_angkutan` AS `ptgs_angkutan`,`a`.`ha_tertebang` AS `ha_tertebang`,`a`.`terbakar_sel` AS `terbakar_sel`,`a`.`ditolak_sel` AS `ditolak_sel`,`a`.`ditolak_alasan` AS `ditolak_alasan`,`a`.`brix_sel` AS `brix_sel`,`a`.`ph_sel` AS `ph_sel`,`a`.`tgl_pintumasuk` AS `tgl_pintumasuk`,`a`.`ptgs_pintumasuk` AS `ptgs_pintumasuk`,`a`.`no_urut_timbang` AS `no_urut_timbang`,`a`.`no_trainstat` AS `no_trainstat`,`a`.`no_hv` AS `no_hv`,`a`.`op_hv` AS `op_hv`,`a`.`no_stipping` AS `no_stipping`,`a`.`op_stipping` AS `op_stipping`,`a`.`no_gl` AS `no_gl`,`a`.`op_gl` AS `op_gl`,`a`.`ptgs_selektor` AS `ptgs_selektor`,`a`.`tgl_selektor` AS `tgl_selektor`,`a`.`tgl_urut` AS `tgl_urut`,`a`.`no_urut` AS `no_urut` from (((`t_selektor` `a` join `t_spta` `b` on((`a`.`id_spta` = `b`.`id`))) join `sap_m_karyawan` `c` on((`c`.`Persno` = convert(`a`.`persno_mandor_tma` using utf8)))) join `sap_field` `e` on((`e`.`kode_blok` = `b`.`kode_blok`))) order by `a`.`tgl_selektor` desc) */;

/*View structure for view vw_spt_data */

/*!50001 DROP TABLE IF EXISTS `vw_spt_data` */;
/*!50001 DROP VIEW IF EXISTS `vw_spt_data` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_spt_data` AS (select `a`.`kode_blok` AS `kode_blok`,`a`.`divisi` AS `divisi`,`a`.`luas_ha` AS `luas_ha`,`a`.`tahun_tanam` AS `tahun_tanam`,`a`.`periode` AS `periode`,`a`.`status_blok` AS `status_blok`,`a`.`kepemilikan` AS `kepemilikan`,`a`.`kode_varietas` AS `kode_varietas`,`b`.`no_petak` AS `no_petak`,`b`.`no_surat` AS `no_surat`,`b`.`h_brix_kebun` AS `h_brix_kebun`,`b`.`h_brix` AS `h_brix`,`b`.`h_pol` AS `h_pol`,`b`.`h_fk` AS `h_fk`,`b`.`h_kp` AS `h_kp`,`b`.`h_kdt` AS `h_kdt`,`b`.`h_tscore` AS `h_tscore`,`b`.`h_tglanalisa` AS `h_tglanalisa`,`b`.`keterangan` AS `keterangan`,`b`.`user_act` AS `user_act`,`b`.`tgl_act` AS `tgl_act`,`b`.`status` AS `status` from (((`sap_field` `a` join `sap_m_affdeling` `d` on((`d`.`kode_affd` = `a`.`divisi`))) join `sap_m_karyawan` `e` on((`e`.`Persno` = convert(`d`.`Persno` using utf8)))) left join `sap_field_spt` `b` on((`a`.`kode_blok` = `b`.`no_petak`))) group by `a`.`kode_blok`) */;

/*View structure for view vw_spta_luas_field_sap_kat_ptp */

/*!50001 DROP TABLE IF EXISTS `vw_spta_luas_field_sap_kat_ptp` */;
/*!50001 DROP VIEW IF EXISTS `vw_spta_luas_field_sap_kat_ptp` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_spta_luas_field_sap_kat_ptp` AS (select `a`.`id` AS `id`,`a`.`no_spat` AS `no_spat`,`get_kode_kat_lahan_ptp`(`a`.`kode_kat_lahan`,`b`.`jenis_tanah`,`b`.`status_blok`) AS `kat_ptp`,`a`.`kode_kat_lahan` AS `kode_kat_lahan`,`b`.`jenis_tanah` AS `jenis_tanah`,`b`.`status_blok` AS `status_blok`,`g`.`ha_tertebang` AS `ha_tertebang_selektor`,`b`.`luas_tebang` AS `luas_ditebang_field`,`b`.`luas_ha` AS `luas_total_field`,`e`.`netto_final` AS `netto`,`f`.`gula_ptr` AS `gula_ptr`,`f`.`gula_pg` AS `gula_pg`,`f`.`tetes_pg` AS `tetes_pg`,`f`.`tetes_ptr` AS `tetes_ptr`,`f`.`hablur_ari` AS `hablur_ari`,`f`.`rendemen_ptr` AS `rendemen_ptr`,`a`.`hari_giling` AS `hari_giling`,`a`.`tgl_giling` AS `tgl_giling`,`e`.`tgl_netto` AS `tgl_timbang`,`a`.`kode_plant_trasnfer` AS `kode_plant_trasnfer`,`d`.`nama_petani` AS `nama_petani`,`a`.`selektor_status` AS `selektor_status`,`a`.`timb_netto_status` AS `timb_netto_status`,`a`.`ari_status` AS `ari_status` from ((((((`t_spta` `a` join `sap_field` `b` on((`b`.`kode_blok` = `a`.`kode_blok`))) join `sap_m_kat_lahan` `c` on((`c`.`nama_kat_lahan` = `a`.`kode_kat_lahan`))) left join `sap_petani` `d` on((`d`.`id_petani_sap` = `a`.`id_petani_sap`))) join `t_timbangan` `e` on((`e`.`id_spat` = `a`.`id`))) left join `t_ari` `f` on((`f`.`id_spta` = `a`.`id`))) join `t_selektor` `g` on((`g`.`id_spta` = `a`.`id`))) where (`a`.`timb_netto_status` = 1)) */;

/*View structure for view vw_t_timbangan */

/*!50001 DROP TABLE IF EXISTS `vw_t_timbangan` */;
/*!50001 DROP VIEW IF EXISTS `vw_t_timbangan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_t_timbangan` AS select `t_spta`.`no_spat` AS `no_spat`,`t_spta`.`timb_bruto_status` AS `timb_bruto_status`,`t_spta`.`timb_netto_status` AS `timb_netto_status`,`t_spta`.`timb_netto_tgl` AS `timb_netto_tgl`,`t_spta`.`timb_bruto_tgl` AS `timb_bruto_tgl`,`t_spta`.`kode_blok` AS `kode_blok`,`sap_petani`.`nama_petani` AS `nama_petani`,`sap_field`.`deskripsi_blok` AS `deskripsi_blok`,`t_timbangan`.`id_timbangan` AS `id_timbangan`,`t_timbangan`.`id_spat` AS `id_spat`,`t_timbangan`.`lokasi_timbang_1` AS `lokasi_timbang_1`,`t_timbangan`.`lokasi_timbang_2` AS `lokasi_timbang_2`,`t_timbangan`.`bruto` AS `bruto`,`t_timbangan`.`tara` AS `tara`,`t_timbangan`.`netto` AS `netto`,`t_timbangan`.`netto_final` AS `netto_final`,`t_timbangan`.`netto_rafaksi` AS `netto_rafaksi`,`t_timbangan`.`rafaksi_prosentis` AS `rafaksi_prosentis`,`t_timbangan`.`tgl_bruto` AS `tgl_bruto`,`t_timbangan`.`tgl_tara` AS `tgl_tara`,`t_timbangan`.`tgl_netto` AS `tgl_netto`,`t_timbangan`.`tgl_rafaksi` AS `tgl_rafaksi`,`t_timbangan`.`transloading_status` AS `transloading_status`,`t_timbangan`.`no_transloading` AS `no_transloading`,`t_timbangan`.`ptgs_transloading` AS `ptgs_transloading`,`t_timbangan`.`ptgs_timbang_1` AS `ptgs_timbang_1`,`t_timbangan`.`ptgs_timbang_2` AS `ptgs_timbang_2`,`t_timbangan`.`tgl_transloading` AS `tgl_transloading`,`t_timbangan`.`multi_sling` AS `multi_sling`,`t_timbangan`.`netto_sebelum_koreksi` AS `netto_sebelum_koreksi`,`t_timbangan`.`ket_koreksi_timbangan` AS `ket_koreksi_timbangan`,`t_timbangan`.`train_stat` AS `train_stat`,`t_timbangan`.`no_lori` AS `no_lori`,`t_timbangan`.`no_loko` AS `no_loko` from (((`t_timbangan` join `t_spta` on((`t_spta`.`id` = `t_timbangan`.`id_spat`))) join `sap_field` on((`sap_field`.`kode_blok` = `t_spta`.`kode_blok`))) left join `sap_petani` on((`sap_petani`.`id_petani` = `t_spta`.`id_petani_sap`))) */;

/*View structure for view vw_upah_angkut */

/*!50001 DROP TABLE IF EXISTS `vw_upah_angkut` */;
/*!50001 DROP VIEW IF EXISTS `vw_upah_angkut` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_upah_angkut` AS (select `a`.`id` AS `id`,`a`.`kode_tx` AS `kode_tx`,`a`.`tgl` AS `tgl`,`a`.`vendor_id` AS `vendor_id`,`a`.`tgl_awal` AS `tgl_awal`,`a`.`tgl_akhir` AS `tgl_akhir`,`a`.`total` AS `total`,`a`.`status` AS `status`,`a`.`user_act` AS `user_act`,`a`.`tgl_act` AS `tgl_act`,`b`.`nama_vendor` AS `nama_vendor` from (`t_angkutan` `a` join `m_vendor` `b` on((`a`.`vendor_id` = `b`.`id_vendor`)))) */;

/*View structure for view vw_upah_tebang */

/*!50001 DROP TABLE IF EXISTS `vw_upah_tebang` */;
/*!50001 DROP VIEW IF EXISTS `vw_upah_tebang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_upah_tebang` AS (select `a`.`id` AS `id`,`a`.`tgl` AS `tgl`,`a`.`no_bukti` AS `no_bukti`,`a`.`kode_blok` AS `kode_blok`,`a`.`persno_pta` AS `persno_pta`,`a`.`persno_mandor` AS `persno_mandor`,`a`.`keterangan` AS `keterangan`,`a`.`ttl_item` AS `ttl_item`,`a`.`status` AS `status`,`a`.`user_act` AS `user_act`,`a`.`tgl_act` AS `tgl_act`,`b`.`deskripsi_blok` AS `deskripsi_blok`,`b`.`kepemilikan` AS `kepemilikan`,`b`.`luas_ha` AS `luas_ha`,`c`.`name` AS `pta`,`d`.`name` AS `mandor`,`e`.`nama_petani` AS `nama_petani` from ((((`t_upah_tebang` `a` join `sap_field` `b` on((`a`.`kode_blok` = `b`.`kode_blok`))) join `sap_m_karyawan` `c` on((`c`.`Persno` = convert(`a`.`persno_pta` using utf8)))) join `sap_m_karyawan` `d` on((`d`.`Persno` = convert(`a`.`persno_mandor` using utf8)))) left join `sap_petani` `e` on((`e`.`id_petani_sap` = `b`.`id_petani_sap`))) group by `a`.`id`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
