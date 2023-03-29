<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Thariangilingmodel extends SB_Model 
{

	public $table = 't_lap_harian_pengolahan';
	public $primaryKey = 'id_lap_harian';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_lap_harian.* FROM t_lap_harian  ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_lap_harian.id_lap_harian IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
