<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tevaluasitebangmodel extends SB_Model 
{

	public $table = 'sap_field';
	public $primaryKey = 'kode_blok';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_field.* FROM vw_masterfield_data as sap_field   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_field.kode_blok IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}

	public function getafd(){
		$sql = "SELECT a.`kode_affd`,b.`name`,a.`nama_afdeling` FROM sap_m_affdeling a INNER JOIN sap_m_karyawan b ON a.`Persno`=b.`Persno` ";
		$b = $this->db->query($sql)->result();
		return $b;
	}

	public function getRownew( $args )
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
		$limitConditional =  "LIMIT $limit , $page" ;
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';
		
		
		$rows = array();
		$asc = "SELECT
  `a`.`divisi`         AS `divisi`,
  `a`.`kepemilikan`    AS `kepemilikan`,
  `a`.`kode_blok`     AS `kode_blok`,
 CONCAT('<span class=\"badge bg-red\">',SUM(IF(tanaman_status=0,1,0)),'</span> ', `a`.`deskripsi_blok`) AS `deskripsi_blok`,
  `b`.`nama_petani`    AS `nama_petani`,
  `a`.`luas_ha`        AS `luas_ha`,
  `a`.`luas_tebang`    AS `luas_tebang`,
  CONCAT(ROUND((((`a`.`luas_ha` - `a`.`luas_tebang`) / `a`.`luas_ha`) * 100),2),' %') AS `sisa`,
  `a`.`total_pokok`    AS `total_pokok`,
  `a`.`total_tebang`   AS `total_tebang`,
  `a`.`aff_tebang`     AS `aff_tebang`,timb_netto_status,tanaman_status
FROM `sap_field` `a`
   LEFT JOIN `sap_petani` `b` ON `a`.`id_petani_sap` = `b`.`id_petani_sap`
   INNER JOIN t_spta c ON c.kode_blok=a.kode_blok
   INNER JOIN t_selektor d ON d.id_spta=c.id
   WHERE `timb_netto_status` = 1 AND tanaman_status = 0 GROUP BY `a`.`kode_blok`
				";
		$query = $this->db->query(" SELECT * FROM (". $asc.") as xd WHERE 0=0
			{$params} 
 {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();
		$key = '';
		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		//$counter_select =  'SELECT count('.$key.') as total FROM ('.$asc." GROUP BY `a`.`kode_blok` ".')';
		//echo 	$counter_select; exit;
		$query = $this->db->query( 'SELECT count('.$key.') as total FROM vw_masterfield_data   GROUP BY `kode_blok`');
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$total = $res[0]->total;

		$query = $this->db->query( "SELECT count(".$key.") as total FROM vw_masterfield_data WHERE 0=0 {$params}  GROUP BY `kode_blok` ");
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$totalfil = $res[0]->total;
		$query->free_result();

		return $results = array('rows'=> $result , 'total' => $total, 'totalfil' => $totalfil);


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
		$limitConditional =  "LIMIT $limit , $page" ;
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';
		
		
		$rows = array();
		$asc = "SELECT a.id,
				a.`no_spat`,
				c.`netto_final`,
				a.kode_blok,
				d.nama_petani,
				b.ha_tertebang FROM t_spta a
				INNER JOIN t_selektor b ON a.id=b.id_spta
				INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
				left join sap_petani d ON d.id_petani_sap = a.id_petani_sap
				WHERE a.`timb_netto_status` = 1 AND b.tanaman_status = 0";
		$query = $this->db->query( $asc."
			{$params} ". $this->queryGroup() ." {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();
		$key = '';
		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$counter_select = preg_replace( '/[\s]*SELECT(.*)FROM/Usi', 'SELECT count('.$key.') as total FROM ( SELECT a.id FROM ', "".$asc."" );
		//echo 	$counter_select; exit;
		$query = $this->db->query( $counter_select .') as '.$table);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$total = $res[0]->total;

		$query = $this->db->query( $counter_select . " {$params} " . ') as '.$table);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$totalfil = $res[0]->total;
		$query->free_result();

		return $results = array('rows'=> $result , 'total' => $total, 'totalfil' => $totalfil);


	}
	
}

?>
