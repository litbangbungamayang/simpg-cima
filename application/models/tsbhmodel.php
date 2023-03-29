<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tsbhmodel extends SB_Model 
{

	public $table = 't_ari';
	public $primaryKey = 'id_ari';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_ari.* FROM vw_sbh_data as t_ari   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_ari.id_ari IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
	public function getRowspdx( $args )
	{
		$table = $this->table;
		$key = $this->primaryKey;

		extract( array_merge( array(
			'page' 		=> '0' ,
			'limit'  	=> '0' ,
			'sort' 		=> '' ,
			'order' 	=> '' ,
			'params' 	=> '' ,
			'global'	=> '1'
		), $args ));
		
		//$offset = ($page-1) * $limit ;
		//$offset = $page-1 ;
		//$limitConditional =  "LIMIT $limit , $page" ;
		$limitConditional = '';
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';
		
		
		$rows = array();
		$query = $this->db->query( "SELECT SQL_NO_CACHE * FROM (". $this->querySbh() . " WHERE 0=0 {$params} GROUP BY `a`.`id`) as ax {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();

		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$counter_select = "SELECT count(id) as total from (". $this->querySbh() . " WHERE 0=0 {$params} GROUP BY `a`.`id`) as ax";
		//echo 	$counter_select; exit;
		$query = $this->db->query( $counter_select );
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$total = $res[0]->total;

		$query = $this->db->query( $counter_select);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$totalfil = $res[0]->total;
		$query->free_result();

		return $results = array('rows'=> $result , 'total' => $total, 'totalfil' => $totalfil);


  }
  
  function querySbh()
	{
    $query = "";
		if(CNF_COMPANYCODE != 'N011')
		{
			$query =  "SELECT 
  `a`.`sbh_status`      AS `sbh_status`,
  `f`.`id_ari`          AS `id_ari`,
  `a`.`id`              AS `id`,
  `a`.`no_spat`         AS `no_spat`,
  `a`.`kode_kat_lahan`  AS `kode_kat_lahan`,
  `a`.`kode_plant`      AS `kode_plant`,
  `a`.`kode_affd`       AS `kode_affd`,
  `a`.`kode_blok`       AS `kode_blok`,
  `a`.`tgl_spta`        AS `tgl_spta`,
  `a`.`tebang_pg`       AS `tebang_pg`,
  `a`.`angkut_pg`       AS `angkut_pg`,
  `a`.`jenis_spta`      AS `jenis_spta`,
  `c`.`no_angkutan`     AS `no_angkutan`,
  IF(`g`.`nama_petani`  = '','-',`g`.`nama_petani`)    AS `nama_petani`,
  `b`.`deskripsi_blok`  AS `deskripsi_blok`,
  `b`.`luas_ha`         AS `luas_ha`,
  `c`.`ha_tertebang`    AS `ha_tertebang`,
  `c`.`tgl_tebang`      AS `tgl_tebang`,
  `c`.`brix_sel`        AS `brix_sel`,
  `c`.`ph_sel`          AS `ph_sel`,
  `c`.`ditolak_sel`     AS `ditolak_sel`,
  IF(`c`.`ditolak_alasan` = '','-',`c`.`ditolak_alasan`)  AS `ditolak_alasan`,
  `a`.`cetak_spta_tgl`  AS `cetak_spta_tgl`,
  `a`.`selektor_tgl`    AS `selektor_tgl`,
  `a`.`timb_netto_tgl`  AS `timb_netto_tgl`,
  `a`.`meja_tebu_tgl`   AS `meja_tebu_tgl`,
  `a`.`ari_tgl`         AS `ari_tgl`,
  `a`.`sbh_tgl`         AS `sbh_tgl`,
  `a`.`hari_giling`     AS `hari_giling`,
  `a`.`tgl_giling`      AS `tgl_giling`,
  `d`.`bruto`           AS `bruto`,
  `d`.`tara`            AS `tara`,
  `d`.`netto_final`     AS `netto_final`,
  `e`.`kondisi_tebu`    AS `kondisi_tebu`,
  `e`.`daduk`           AS `daduk`,
  `e`.`sogolan`         AS `sogolan`,
  `e`.`pucuk`           AS `pucuk`,
  `e`.`akar_tanah`      AS `akar_tanah`,
  `e`.`non_tebu`        AS `non_tebu`,
  `e`.`terbakar`        AS `terbakar`,
  `e`.`cacahan`         AS `cacahan`,
  `e`.`brondolan`       AS `brondolan`,
  `f`.`persen_brix_ari` AS `persen_brix_ari`,
  `f`.`persen_pol_ari`  AS `persen_pol_ari`,
  `f`.`ph_ari`          AS `ph_ari`,
  `f`.`hk`              AS `hk`,
  `f`.`nilai_nira`      AS `nilai_nira`,
  `f`.`faktor_rendemen` AS `faktor_rendemen`,
  f.rendemen_individu,
  f.faktor_konversi,
  `f`.`rendemen_ari`    AS `rendemen_ari`,
  ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2) AS `hablur_ari`,
  ROUND(IF((`f`.`gula_total` = 0),(IF((`f`.`hablur_ari` = 0),ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2) AS `gula_total`,
  IF((`f`.`tetes_total` = 0),ROUND(((4.5 * `d`.`netto_final`) / 100),2),`f`.`tetes_total`) AS `tetes_total`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR'),IF((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(LEFT(`a`.`kode_kat_lahan`,2),`f`.`rendemen_ari`),`f`.`rendemen_ptr`),0) AS `rendemen_ptr`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR'),ROUND(IF((`f`.`gula_ptr` = 0),(((`d`.`netto_final` * IF((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(LEFT(`a`.`kode_kat_lahan`,2),`f`.`rendemen_ari`),`f`.`rendemen_ptr`)) / 100) * 1.003),`f`.`gula_ptr`),2),0) AS `gula_ptr`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR'),ROUND(IF((`f`.`tetes_ptr` = 0),((3 * `d`.`netto_final`) / 100),`f`.`tetes_ptr`),2),0) AS `tetes_ptr`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR'),ROUND(IF((`f`.`gula_pg` = 0),(ROUND(IF((`f`.`gula_total` = 0),(IF((`f`.`hablur_ari` = 0),ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2) - ROUND(IF((`f`.`gula_ptr` = 0),(((`d`.`netto_final` * IF((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(LEFT(`a`.`kode_kat_lahan`,2),`f`.`rendemen_ari`),`f`.`rendemen_ptr`)) / 100) * 1.003),`f`.`gula_ptr`),2)),`f`.`gula_pg`),2),ROUND(IF((`f`.`gula_total` = 0),(IF((`f`.`hablur_ari` = 0),ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2)) AS `gula_pg`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR'),ROUND(IF((`f`.`tetes_pg` = 0),(IF((`f`.`tetes_total` = 0),((4.5 * `d`.`netto_final`) / 100),`f`.`tetes_total`) - IF((`f`.`tetes_ptr` = 0),((3 * `d`.`netto_final`) / 100),`f`.`tetes_ptr`)),`f`.`tetes_pg`),2),IF((`f`.`tetes_total` = 0),ROUND(((4.5 * `d`.`netto_final`) / 100),2),`f`.`tetes_total`)) AS `tetes_pg`
FROM ((((((`t_spta` `a`
        JOIN `sap_field` `b`
          ON ((`a`.`kode_blok` = `b`.`kode_blok`)))
       JOIN `t_selektor` `c`
         ON ((`c`.`id_spta` = `a`.`id`)))
      JOIN `t_timbangan` `d`
        ON ((`d`.`id_spat` = `a`.`id`)))
     JOIN `t_meja_tebu` `e`
       ON ((`e`.`id_spta` = `a`.`id`)))
    JOIN `t_ari` `f`
      ON ((`f`.`id_spta` = `a`.`id`)))
   LEFT JOIN `sap_petani` `g`
     ON ((`g`.`id_petani_sap` = `b`.`id_petani_sap`)))";
		}else{
			$query = "SELECT 
  `a`.`sbh_status`      AS `sbh_status`,
  `f`.`id_ari`          AS `id_ari`,
  `a`.`id`              AS `id`,
  `a`.`no_spat`         AS `no_spat`,
  `a`.`kode_kat_lahan`  AS `kode_kat_lahan`,
  `a`.`kode_plant`      AS `kode_plant`,
  `a`.`kode_affd`       AS `kode_affd`,
  `a`.`kode_blok`       AS `kode_blok`,
  `a`.`tgl_spta`        AS `tgl_spta`,
  `a`.`tebang_pg`       AS `tebang_pg`,
  `a`.`angkut_pg`       AS `angkut_pg`,
  `a`.`jenis_spta`      AS `jenis_spta`,
  `c`.`no_angkutan`     AS `no_angkutan`,
  g.id_petani_sap    AS `id_petani_sap`,
  IF(`g`.`nama_petani`  = '','-',IFNULL(`g`.`nama_petani`,'-'))    AS `nama_petani`,
  `b`.`deskripsi_blok`  AS `deskripsi_blok`,
  `b`.`luas_ha`         AS `luas_ha`,
  `a`.`spt_status`      AS `spt_status`,
  `a`.`natura_status`   AS `natura_status`,
  `c`.`ha_tertebang`    AS `ha_tertebang`,
  `c`.`tgl_tebang`      AS `tgl_tebang`,
  `c`.`brix_sel`        AS `brix_sel`,
  `c`.`ph_sel`          AS `ph_sel`,
  `c`.`ditolak_sel`     AS `ditolak_sel`,
  IF(`c`.`ditolak_alasan` = '','-',IFNULL(`c`.`ditolak_alasan`,'-'))  AS `ditolak_alasan`,
  `a`.`cetak_spta_tgl`  AS `cetak_spta_tgl`,
  `a`.`selektor_tgl`    AS `selektor_tgl`,
  `a`.`timb_netto_tgl`  AS `timb_netto_tgl`,
  `a`.`meja_tebu_tgl`   AS `meja_tebu_tgl`,
  `a`.`ari_tgl`         AS `ari_tgl`,
  IFNULL(`a`.`sbh_tgl`,'-')         AS `sbh_tgl`,
  `a`.`hari_giling`     AS `hari_giling`,
  `a`.`tgl_giling`      AS `tgl_giling`,
  `d`.`bruto`           AS `bruto`,
  `d`.`tara`            AS `tara`,
  `d`.`netto_final`     AS `netto_final`,
  `e`.`kondisi_tebu`    AS `kondisi_tebu`,
  `e`.`daduk`           AS `daduk`,
  `e`.`sogolan`         AS `sogolan`,
  `e`.`pucuk`           AS `pucuk`,
  `e`.`akar_tanah`      AS `akar_tanah`,
  `e`.`non_tebu`        AS `non_tebu`,
  `e`.`terbakar`        AS `terbakar`,
  `e`.`cacahan`         AS `cacahan`,
  `e`.`brondolan`       AS `brondolan`,
  `f`.`persen_brix_ari` AS `persen_brix_ari`,
  `f`.`persen_pol_ari`  AS `persen_pol_ari`,
  `f`.`ph_ari`          AS `ph_ari`,
  `f`.`hk`              AS `hk`,
  `f`.`nilai_nira`      AS `nilai_nira`,
  `f`.`faktor_rendemen` AS `faktor_rendemen`,
  f.rendemen_individu,
  f.faktor_konversi,
  `f`.`rendemen_ari`    AS `rendemen_ari`,
  ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2) AS `hablur_ari`,
  ROUND(IF((`f`.`gula_total` = 0),(IF((`f`.`hablur_ari` = 0),ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2) AS `gula_total`,
  IF((`f`.`tetes_total` = 0),ROUND(((4.5 * `d`.`netto_final`) / 100),2),`f`.`tetes_total`) AS `tetes_total`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR' OR a.kode_kat_lahan = 'TS-SP'),IF((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(IF(a.kode_kat_lahan = 'TS-SP','TR',LEFT(`a`.`kode_kat_lahan`,2)),`f`.`rendemen_ari`),`f`.`rendemen_ptr`),0) AS `rendemen_ptr`,
   f.r_spg        AS r_spg, 
   f.kopensasi_gula,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR' OR a.kode_kat_lahan = 'TS-SP'),ROUND(IF((`f`.`gula_ptr` = 0),(((`d`.`netto_final` * IF((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(IF(a.kode_kat_lahan = 'TS-SP','TR',LEFT(`a`.`kode_kat_lahan`,2)),`f`.`rendemen_ari`),`f`.`rendemen_ptr`)) / 100) * 1.003),`f`.`gula_ptr`),2),0) AS `gula_ptr`,
   f.sembilanpuluh_persen AS sembilanpuluh_persen, f.sepuluh_persen AS sepuluh_persen,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR' OR a.kode_kat_lahan = 'TS-SP'),ROUND(IF((`f`.`tetes_ptr` = 0),((3 * `d`.`netto_final`) / 100),`f`.`tetes_ptr`),2),0) AS `tetes_ptr`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR' OR a.kode_kat_lahan = 'TS-SP'),ROUND(IF((`f`.`gula_pg` = 0),(ROUND(IF((`f`.`gula_total` = 0),(IF((`f`.`hablur_ari` = 0),ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2) - ROUND(IF((`f`.`gula_ptr` = 0),(((`d`.`netto_final` * IF((`f`.`rendemen_ptr` = 0),`get_rendemen_bagihasil_ptr`(IF(a.kode_kat_lahan = 'TS-SP','TR',LEFT(`a`.`kode_kat_lahan`,2)),`f`.`rendemen_ari`),`f`.`rendemen_ptr`)) / 100) * 1.003),`f`.`gula_ptr`),2)),`f`.`gula_pg`),2),ROUND(IF((`f`.`gula_total` = 0),(IF((`f`.`hablur_ari` = 0),ROUND(IF((`f`.`hablur_ari` = 0),((`f`.`rendemen_ari` * `d`.`netto_final`) / 100),`f`.`hablur_ari`),2),`f`.`hablur_ari`) * 1.003),`f`.`gula_total`),2)) AS `gula_pg`,
  IF((LEFT(`a`.`kode_kat_lahan`,2) = 'TR' OR a.kode_kat_lahan = 'TS-SP'),ROUND(IF((`f`.`tetes_pg` = 0),(IF((`f`.`tetes_total` = 0),((4.5 * `d`.`netto_final`) / 100),`f`.`tetes_total`) - IF((`f`.`tetes_ptr` = 0),((3 * `d`.`netto_final`) / 100),`f`.`tetes_ptr`)),`f`.`tetes_pg`),2),IF((`f`.`tetes_total` = 0),ROUND(((4.5 * `d`.`netto_final`) / 100),2),`f`.`tetes_total`)) AS `tetes_pg`
FROM ((((((`t_spta` `a`
        JOIN `sap_field` `b`
          ON ((`a`.`kode_blok` = `b`.`kode_blok`)))
       JOIN `t_selektor` `c`
         ON ((`c`.`id_spta` = `a`.`id`)))
      JOIN `t_timbangan` `d`
        ON ((`d`.`id_spat` = `a`.`id`)))
     JOIN `t_meja_tebu` `e`
       ON ((`e`.`id_spta` = `a`.`id`)))
    JOIN `t_ari` `f`
      ON ((`f`.`id_spta` = `a`.`id`)))
   LEFT JOIN `sap_petani` `g`
     ON ((`g`.`id_petani_sap` = `b`.`id_petani_sap`)))";
    }
    
	return $query;
	}
}

?>
