<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tbiayaangkutanmodel extends SB_Model 
{

	public $table = 't_angkutan';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_angkutan.* FROM vw_upah_angkut as t_angkutan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_angkutan.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
