<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tperiodegilingmodel extends SB_Model 
{

	public $table = 't_periode_do';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_periode_do.* FROM t_periode_do   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_periode_do.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
