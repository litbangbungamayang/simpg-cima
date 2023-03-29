<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Taratruckmodel extends SB_Model 
{

	public $table = 'm_tara_truk';
	public $primaryKey = 'id_tara_truk';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_tara_truk.* FROM m_tara_truk   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_tara_truk.id_tara_truk IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
