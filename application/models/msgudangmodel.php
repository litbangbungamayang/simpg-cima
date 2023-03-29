<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Msgudangmodel extends SB_Model 
{

	public $table = 'b_ms_unit';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT b_ms_unit.* FROM b_ms_unit   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE b_ms_unit.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
