<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mjabatanmodel extends SB_Model 
{

	public $table = 'm_jabatan';
	public $primaryKey = 'id_jabatan';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_jabatan.* FROM m_jabatan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_jabatan.id_jabatan IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
