<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tupahtebangmodel extends SB_Model 
{

	public $table = 't_upah_tebang';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_upah_tebang.* FROM vw_upah_tebang as t_upah_tebang   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_upah_tebang.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
