<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tmaterialmodel extends SB_Model 
{

	public $table = 't_timbang_material';
	public $primaryKey = 'id_t_material';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_timbang_material.* FROM t_timbang_material   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_timbang_material.id_t_material IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
