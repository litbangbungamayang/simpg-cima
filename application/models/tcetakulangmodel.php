<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tcetakulangmodel extends SB_Model 
{

	public $table = 't_spta';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_spta.* FROM t_spta   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_spta.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
