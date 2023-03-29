<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mupahtebangmodel extends SB_Model 
{

	public $table = 'm_pekerjaan_tma';
	public $primaryKey = 'id_pekerjaan_tma';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_pekerjaan_tma.* FROM vw_master_pekerjaan_tma as m_pekerjaan_tma   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_pekerjaan_tma.id_pekerjaan_tma IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
