<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mmtruckgpsmodel extends SB_Model 
{

	public $table = 'm_truk_gps';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_truk_gps.* FROM m_truk_gps   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_truk_gps.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
