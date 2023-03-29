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
/*Table structure for table `m_kat_lahan_ptp` */

DROP TABLE IF EXISTS `m_kat_lahan_ptp`;

CREATE TABLE `m_kat_lahan_ptp` (
  `id_kat_ptp` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kat_ptp` varchar(10) DEFAULT NULL,
  `ket_kat_ptp` varchar(200) DEFAULT NULL,
  `kat_sap` varchar(10) DEFAULT NULL,
  `status_blok_sap` varchar(20) DEFAULT NULL,
  `jenis_tanah_sap` varchar(20) DEFAULT NULL,
  `tipe_kat_lahan` enum('TS','TR') DEFAULT 'TS',
  PRIMARY KEY (`id_kat_ptp`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `m_kat_lahan_ptp` */

insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (1,'TSS-I HG','TS SAWAH PC HGU','TS-HG','PC','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (2,'TSS-II HG','TS SAWAH RATOON I HGU','TS-HG','R1','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (3,'TSS-III HG','TS SAWAH RATOON II HGU','TS-HG','R2,R3','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (4,'TST-I HG','TS TEGALAN PC HGU','TS-HG','PC','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (5,'TST-II HG','TS TEGALAN RATOON I HGU','TS-HG','R1','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (6,'TST-III HG','TS TEGALAN RATOON II HGU','TS-HG','R2,R3','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (7,'TSS-I IP','TS SAWAH PC IPL','TS-IP','PC','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (8,'TSS-II IP','TS SAWAH RATOON IPL','TS-IP','R1,R2,R3','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (9,'TST-I IP','TS TEGALAN PC IPL','TS-IP','PC','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (10,'TST-II IP','TS TEGALAN RATOON IPL','TS-IP','R1,R2,R3','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (11,'TSS-I KN','TS SAWAH PC KEBUN KONVERSI','TS-KN','PC','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (12,'TSS-II KN','TS SAWAH RATOON KEBUN KONVERSI','TS-KN','R1,R2,R3','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (13,'TST-I KN','TS TEGALAN PC KEBUN KONVERSI','TS-KN','PC','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (14,'TST-II KN ','TS TEGALAN RATOON KEBUN KONVERSI','TS-KN','R1,R2,R3','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (15,'TSS-I KS','TS SAWAH PC KERJASAMA USAHA','TS-KS','PC','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (16,'TSS-II KS','TS SAWAH RATOON KERJASAMA USAHA','TS-KS','R1,R2,R3','04','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (17,'TST-I KS','TS TEGALAN PC KERJASAMA USAHA','TS-KS','PC','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (18,'TST-II KS','TS TEGALAN RATOON KERJASAMA USAHA','TS-KS','R1,R2,R3','05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (19,'TS-SP','TS SPT KUANTA','TS-SP','PC,R1,R2','04,05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (20,'TS-ST','TS SPT TEGAKAN','TS-ST','PC,R1,R2','04,05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (21,'TS-TR','TS TRANSFER','TS-TR','PC,R1,R2','04,05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (22,'TS-BB','TS EKS BIBITAN YANG DIGILING','TS-BB','PC,R1,R2','04,05','TS');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (23,'TRS-I KD','TR SAWAH PC KREDIT DLM WIL','TR-KD','PC','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (24,'TRS-II KD','TR SAWAH RATOON KREDIT DLM WIL','TR-KD','R1,R2,R3','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (25,'TRT-I KD','TR TEGALAN PC KREDIT DLM WIL','TR-KD','PC','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (26,'TRT-II KD','TR TEGALAN RATOON KREDIT DLM WIL','TR-KD','R1,R2,R3','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (27,'TRS-I KL','TR SAWAH PC KREDIT LUAR WIL','TR-KL','PC','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (28,'TRS-II KL','TR SAWAH RATOON KREDIT LUAR WIL','TR-KL','R1,R2,R3','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (29,'TRT-I KL','TR TEGALAN PC KREDIT LUAR WIL','TR-KL','PC','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (30,'TRT-II KL','TR TEGALAN RATOON KREDIT LUAR WIL','TR-KL','R1,R2,R3','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (31,'TRS-I MD','TR SAWAH PC MITRA DLM WIL','TR-MD','PC','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (32,'TRS-II MD','TR SAWAH RATOON MITRA DLM WIL','TR-MD','R1,R2,R3','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (33,'TRT-I MD','TR TEGALAN PC MITRA DLM WIL','TR-MD','PC','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (34,'TRT-II MD','TR TEGALAN RATOON MITRA DLM WIL','TR-MD','R1,R2,R3','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (35,'TRS-I ML','TR SAWAH PC MITRA LUAR WIL','TR-ML','PC','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (36,'TRS-II ML','TR SAWAH RATOON MITRA LUAR WIL','TR-ML','R1,R2,R3','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (37,'TRT-I ML','TR TEGALAN PC MITRA LUAR WIL','TR-ML','PC','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (38,'TRT-II ML','TR TEGALAN RATOON MITRA LUAR WIL','TR-ML','R1,R2,R3','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (39,'TRS-I KS','TR SAWAH PC KERJA SAMA LUAR WIL','TR-KS','PC','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (40,'TRS-II KS','TR SAWAH RATOON KERJA SAMA LUAR WIL','TR-KS','R1,R2,R3','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (41,'TRT-I KS','TR TEGALAN PC KERJA SAMA LUAR WIL','TR-KS','PC','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (42,'TRT-II KS','TR TEGALAN RATOON KERJA SAMA LUAR WIL','TR-KS','R1,R2,R3','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (43,'TRS-I MR','TR SAWAH PC MANDIRI LUAR WIL','TR-MR','PC','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (44,'TRS-II MR','TR SAWAH RATOON MANDIRI LUAR WIL','TR-MR','R1,R2,R3','04','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (45,'TRT-I MR','TR TEGALAN PC MANDIRI LUAR WIL','TR-MR','PC','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (46,'TRT-II MR','TR TEGALAN RATOON MANDIRI LUAR WIL','TR-MR','R1,R2,R3','05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (47,'TR-TK','TR TRANSFER KREDIT','TR-TK','PC,R1,R2','04,05','TR');
insert  into `m_kat_lahan_ptp`(`id_kat_ptp`,`kode_kat_ptp`,`ket_kat_ptp`,`kat_sap`,`status_blok_sap`,`jenis_tanah_sap`,`tipe_kat_lahan`) values (48,'TR-TM','TR TRANSFER MITRA','TR-TM','PC,R1,R2','04,05','TR');

/*Table structure for table `sap_m_kat_lahan` */

DROP TABLE IF EXISTS `sap_m_kat_lahan`;

CREATE TABLE `sap_m_kat_lahan` (
  `id_kat_lahan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kat_lahan` varchar(20) DEFAULT NULL,
  `jenis_kategori_lahan` enum('TS','TR') DEFAULT NULL,
  PRIMARY KEY (`id_kat_lahan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `sap_m_kat_lahan` */

insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (1,'TR-KS','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (2,'TR-MT','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (3,'TS-KP','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (4,'TS-KS','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (5,'TS-SP','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (6,'TS-ST','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (7,'TR-KM','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (8,'TR-KR','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (9,'TR-LD','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (10,'TR-MD','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (11,'TR-TR','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (12,'TS-BB','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (13,'TS-DE','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (14,'TS-HG','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (15,'TS-IP','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (16,'TS-KN','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (17,'TS-TR','TS');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (18,'TR-TK','TR');
insert  into `sap_m_kat_lahan`(`id_kat_lahan`,`nama_kat_lahan`,`jenis_kategori_lahan`) values (19,'TR-TM','TR');

/*Table structure for table `t_lap_produksi_pengolahan` */

DROP TABLE IF EXISTS `t_lap_produksi_pengolahan`;

CREATE TABLE `t_lap_produksi_pengolahan` (
  `id_laporan_produksi` int(255) NOT NULL AUTO_INCREMENT,
  `tgl_laporan_produksi` date NOT NULL,
  `hari_giling` int(5) NOT NULL,
  `kode_kat_lahan` varchar(20) NOT NULL,
  `kat_ptpn` varchar(20) NOT NULL,
  `kat_kepemilikan` varchar(20) NOT NULL,
  `ha_tertebang` double DEFAULT NULL,
  `qty_tertebang` double DEFAULT NULL,
  `ha_digiling` double DEFAULT NULL,
  `qty_digiling` double DEFAULT NULL,
  `qty_kristal` double DEFAULT NULL,
  `rendemen` double DEFAULT NULL,
  `qty_gula_ptr` double DEFAULT NULL,
  `qty_tetes_ptr` double DEFAULT NULL,
  PRIMARY KEY (`id_laporan_produksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_lap_produksi_pengolahan` */

/*Table structure for table `t_lap_produksi_pengolahan_trans` */

DROP TABLE IF EXISTS `t_lap_produksi_pengolahan_trans`;

CREATE TABLE `t_lap_produksi_pengolahan_trans` (
  `id_laporan_produksi_trans` int(255) NOT NULL AUTO_INCREMENT,
  `tgl_laporan_produksi_trans` date NOT NULL,
  `hari_giling` int(5) NOT NULL,
  `kode_kat_lahan` varchar(20) NOT NULL,
  `kat_ptpn` varchar(20) NOT NULL,
  `kat_kepemilikan` varchar(20) NOT NULL,
  `plant` varchar(10) NOT NULL,
  `ha_tertebang` double DEFAULT NULL,
  `qty_tertebang` double DEFAULT NULL,
  `ha_digiling` double DEFAULT NULL,
  `qty_digiling` double DEFAULT NULL,
  `qty_kristal` double DEFAULT NULL,
  `rendemen` double DEFAULT NULL,
  `qty_gula_ptr` double DEFAULT NULL,
  `qty_tetes_ptr` double DEFAULT NULL,
  PRIMARY KEY (`id_laporan_produksi_trans`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_lap_produksi_pengolahan_trans` */


/*View structure for view vw_spta_luas_field_sap_kat_ptp */

/*!50001 DROP TABLE IF EXISTS `vw_spta_luas_field_sap_kat_ptp` */;
/*!50001 */
DROP VIEW IF EXISTS `vw_spta_luas_field_sap_kat_ptp` ;

/*!50001 */
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_spta_luas_field_sap_kat_ptp` AS (select `a`.`id` AS `id`,`a`.`no_spat` AS `no_spat`,`get_kode_kat_lahan_ptp`(`a`.`kode_kat_lahan`,`b`.`jenis_tanah`,`b`.`status_blok`) AS `kat_ptp`,`a`.`kode_kat_lahan` AS `kode_kat_lahan`,`b`.`jenis_tanah` AS `jenis_tanah`,`b`.`status_blok` AS `status_blok`,`g`.`ha_tertebang` AS `ha_tertebang_selektor`,`b`.`luas_tebang` AS `luas_ditebang_field`,`b`.`luas_ha` AS `luas_total_field`,`e`.`netto_final` AS `netto`,`f`.`gula_ptr` AS `gula_ptr`,`f`.`gula_pg` AS `gula_pg`,`f`.`tetes_pg` AS `tetes_pg`,`f`.`tetes_ptr` AS `tetes_ptr`,`f`.`hablur_ari` AS `hablur_ari`,`f`.`rendemen_ptr` AS `rendemen_ptr`,`a`.`hari_giling` AS `hari_giling`,`a`.`tgl_giling` AS `tgl_giling`,`e`.`tgl_netto` AS `tgl_timbang`,`a`.`kode_plant_trasnfer` AS `kode_plant_trasnfer`,`d`.`nama_petani` AS `nama_petani`,`a`.`selektor_status` AS `selektor_status`,`a`.`timb_netto_status` AS `timb_netto_status`,`a`.`ari_status` AS `ari_status`,`a`.`meja_tebu_status` AS `meja_tebu_status`,`a`.`sbh_status` AS `sbh_status` from ((((((`t_spta` `a` join `sap_field` `b` on((`b`.`kode_blok` = `a`.`kode_blok`))) join `sap_m_kat_lahan` `c` on((`c`.`nama_kat_lahan` = `a`.`kode_kat_lahan`))) left join `sap_petani` `d` on((`d`.`id_petani_sap` = `a`.`id_petani_sap`))) join `t_timbangan` `e` on((`e`.`id_spat` = `a`.`id`))) left join `t_ari` `f` on((`f`.`id_spta` = `a`.`id`))) join `t_selektor` `g` on((`g`.`id_spta` = `a`.`id`))) where (`a`.`timb_netto_status` = 1));

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
