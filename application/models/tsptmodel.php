<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tsptmodel extends SB_Model 
{

	public $table = 'sap_field_spt';
	public $primaryKey = 'no_petak';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_field_spt.* FROM vw_spt_data as sap_field_spt   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE 0=0  ";
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
		$limitConditional =  "LIMIT $limit , $page" ;
		//$limitConditional = '';
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';
		
		
		$rows = array();
		$query = $this->db->query( "SELECT * FROM  vw_spt_data as sap_field_spt WHERE 0=0  {$params} ". $this->queryGroup() ." {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();

		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$counter_select = "SELECT count(kode_blok) as total from vw_spt_data ". $this->queryWhere();
		//echo 	$counter_select; exit;
		$query = $this->db->query( $counter_select );
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$total = $res[0]->total;

		$query = $this->db->query( $counter_select ." {$params} ". $this->queryGroup());
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$totalfil = $res[0]->total;
		$query->free_result();
		


		return $results = array('rows'=> $result , 'total' => $total, 'totalfil' => $totalfil);


	}
	
}

?>
