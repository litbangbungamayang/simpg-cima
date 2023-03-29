CREATE TABLE `t_counter_gula_detail` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `jalur` varchar(2) DEFAULT NULL,
  `kode_sensor` varchar(2) DEFAULT NULL,
  `value` smallint(1) DEFAULT NULL,
  `tgl_act` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;