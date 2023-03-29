<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpremimodel extends SB_Model 
{

	public $table = 'm_premi';
	public $primaryKey = 'id_premi';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_premi.* FROM m_premi   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_premi.id_premi IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
