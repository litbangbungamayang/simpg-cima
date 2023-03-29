CREATE TABLE `t_timbangan_raw_sugar` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  `keterangan_dua` text,
  `bruto` double DEFAULT NULL,
  `tara` double DEFAULT NULL,
  `netto` double DEFAULT NULL,
  `tgl_bruto` datetime DEFAULT NULL,
  `tgl_tara` datetime DEFAULT NULL,
  `tgl_netto` datetime DEFAULT NULL,
  `tgl_timbang` date DEFAULT NULL,
  `operator_timbangan` varchar(300) DEFAULT NULL,
  `kode_timbangan` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
