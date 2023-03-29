<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tlapharpengmodel extends SB_Model 
{

	public $table = 't_lap_harian_pengolahan_ptpn';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_lap_harian_pengolahan_ptpn.* FROM t_lap_harian_pengolahan_ptpn   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_lap_harian_pengolahan_ptpn.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
