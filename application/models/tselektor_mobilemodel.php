<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tselektor_mobilemodel extends SB_Model 
{

	public $table = 't_selektor';
	public $primaryKey = 'id_selektor';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_selektor.* FROM t_selektor   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_selektor.id_selektor IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
