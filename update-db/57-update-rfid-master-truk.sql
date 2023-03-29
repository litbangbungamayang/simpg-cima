ALTER TABLE `m_truk_gps` ADD COLUMN `id_spta` INT(50) DEFAULT 0 NULL AFTER `id_gps_server`; 

ALTER TABLE `m_truk_gps` CHANGE `status` `status` SMALLINT(1) DEFAULT 1 NULL COMMENT '1. free 2. on task';

CREATE ALGORITHM=UNDEFINED  SQL SECURITY DEFINER VIEW `vw_spta_digital` AS (
select
  `a`.`no_spat`             AS `no_spat`,
  `a`.`tgl_spta`            AS `tgl_spta`,
  `b`.`nama_vendor`         AS `nama_vendor`,
  `c`.`deskripsi_blok`      AS `deskripsi_blok`,
  `c`.`kode_blok`           AS `kode_blok`,
  `c`.`divisi`              AS `divisi`,
  `a`.`rfid_sticker`        AS `rfid_sticker`,
  `a`.`rfid_sticker_status` AS `rfid_sticker_status`,
  `a`.`id_truck`            AS `id_truck`,
  `d`.`nopol_truk`          AS `nopol_truk`,
  `a`.`persno_mandor`       AS `persno_mandor`
from (((`t_spta` `a`
     join `m_vendor` `b`
       on ((`a`.`vendor_angkut` = `b`.`id_vendor`)))
    join `sap_field` `c`
      on ((`c`.`kode_blok` = `a`.`kode_blok`)))
   join `m_truk_gps` `d`
     on ((`d`.`id` = `a`.`id_truck`)))
where (`a`.`rfid_sticker_status` = 1)) 