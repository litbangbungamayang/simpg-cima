<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mrelasimodel extends SB_Model 
{

	public $table = 'm_relasi';
	public $primaryKey = 'id_relasi';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_relasi.* FROM m_relasi   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_relasi.id_relasi IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
