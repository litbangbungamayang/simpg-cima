<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mkategorimodel extends SB_Model 
{

	public $table = 'sap_m_kat_lahan';
	public $primaryKey = 'id_kat_lahan';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_m_kat_lahan.* FROM sap_m_kat_lahan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_m_kat_lahan.id_kat_lahan IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
