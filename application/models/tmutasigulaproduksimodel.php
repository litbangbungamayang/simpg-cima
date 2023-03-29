<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tmutasigulaproduksimodel extends SB_Model 
{

	public $table = 't_mutasi_produksi_gula';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_mutasi_produksi_gula.* FROM t_mutasi_produksi_gula   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_mutasi_produksi_gula.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
