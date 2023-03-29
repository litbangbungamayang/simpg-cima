<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mkatlahanptpnmodel extends SB_Model 
{

	public $table = 'm_kat_lahan_ptp';
	public $primaryKey = 'id_kat_ptp';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_kat_lahan_ptp.* FROM m_kat_lahan_ptp   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_kat_lahan_ptp.id_kat_ptp IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
