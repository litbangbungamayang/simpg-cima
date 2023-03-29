ALTER TABLE `t_spta_kuota` ADD UNIQUE INDEX (`tgl_spta`); 

ALTER TABLE `t_spta_kuota_kkw` ADD UNIQUE INDEX (`id_affd`, `id_spta_kuota`); 

ALTER TABLE `t_spta_kuota_tot` ADD UNIQUE INDEX (`kode_blok`, `id_spta_kuota_kkw`); 