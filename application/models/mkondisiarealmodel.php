<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mkondisiarealmodel extends SB_Model 
{

	public $table = 'sap_m_kondisi_areal';
	public $primaryKey = 'id_kondisi_areal';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_m_kondisi_areal.* FROM sap_m_kondisi_areal   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_m_kondisi_areal.id_kondisi_areal IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
