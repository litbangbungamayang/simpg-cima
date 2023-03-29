<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mmaterialmodel extends SB_Model 
{

	public $table = 'm_material';
	public $primaryKey = 'id_material';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_material.* FROM m_material   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_material.id_material IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
