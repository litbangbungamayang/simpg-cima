<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mafdelingmodel extends SB_Model 
{

	public $table = 'sap_m_affdeling';
	public $primaryKey = 'id_affdeling';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_m_affdeling.* FROM vw_master_afdeling as sap_m_affdeling  ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_m_affdeling.id_affdeling IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
