<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mkaryawanmodel extends SB_Model 
{

	public $table = 'sap_m_karyawan';
	public $primaryKey = 'Persno';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_m_karyawan.* FROM vw_master_karyawan as sap_m_karyawan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_m_karyawan.id_karyawan IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
