<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mvarietasmodel extends SB_Model 
{

	public $table = 'sap_m_varietas';
	public $primaryKey = 'id_varietas';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_m_varietas.* FROM sap_m_varietas   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_m_varietas.id_varietas IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
