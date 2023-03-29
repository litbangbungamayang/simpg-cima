<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mjenistanahmodel extends SB_Model 
{

	public $table = 'sap_m_jenis_tanah';
	public $primaryKey = 'id_jenis_tanah';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_m_jenis_tanah.* FROM sap_m_jenis_tanah   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_m_jenis_tanah.id_jenis_tanah IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
