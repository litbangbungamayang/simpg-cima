
DROP TABLE t_lap_produksi_pengolahan;
DROP TABLE t_lap_produksi_pengolahan_trans;

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
  `tgl_giling` date DEFAULT NULL,
  PRIMARY KEY (`id_laporan_produksi_trans`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


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
  `tgl_giling` date DEFAULT NULL,
  PRIMARY KEY (`id_laporan_produksi`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
