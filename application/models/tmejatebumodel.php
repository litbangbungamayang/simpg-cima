<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tmejatebumodel extends SB_Model 
{

	public $table = 't_meja_tebu';
	public $primaryKey = 'id_mejatebu';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_meja_tebu.* FROM vw_mejatebu_data as t_meja_tebu   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_meja_tebu.id_mejatebu IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
