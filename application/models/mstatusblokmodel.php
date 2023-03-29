<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mstatusblokmodel extends SB_Model 
{

	public $table = 'sap_m_status_blok';
	public $primaryKey = 'id_status_blok';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_m_status_blok.* FROM sap_m_status_blok   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_m_status_blok.id_status_blok IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
