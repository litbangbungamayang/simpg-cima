<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trubahselektormodel extends SB_Model 
{

	public $table = 't_ubah_selektor';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_ubah_selektor.* FROM t_ubah_selektor   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_ubah_selektor.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
