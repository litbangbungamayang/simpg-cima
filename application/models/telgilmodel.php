<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Telgilmodel extends SB_Model 
{

	public $table = 'm_kendaraan_tma';
	public $primaryKey = 'id_kendaraan_tma';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_kendaraan_tma.* FROM m_kendaraan_tma   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_kendaraan_tma.id_kendaraan_tma IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
