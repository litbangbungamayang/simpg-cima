/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.1.36-MariaDB 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;
insert into `tb_menu` ( `parent_id`, `module`, `url`, `menu_name`, `menu_type`, `role_id`, `deep`, `ordering`, `position`, `menu_icons`, `active`, `access_data`, `allow_guest`, `menu_lang`, `entry_by`) values('74','tspg',NULL,'TSPG','internal','0','0','0','sidebar',NULL,'1','{\"1\":\"1\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"0\",\"10\":\"1\",\"11\":\"0\",\"12\":\"0\",\"13\":\"0\",\"14\":\"0\"}','0',NULL,'22');

create table `t_spg` (
	`id` int (11),
	`id_petani` varchar (300),
	`kode_blok` varchar (300),
	`r_spg` double ,
	`persen_10` smallint (1),
	`created_at` timestamp 
); 

ALTER TABLE `t_spg` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`id`);