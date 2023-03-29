<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tcancelselektormodel extends SB_Model 
{

	public $table = 't_cancel_selektor';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_cancel_selektor.* FROM t_cancel_selektor   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_cancel_selektor.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
