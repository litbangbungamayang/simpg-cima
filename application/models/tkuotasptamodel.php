<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tkuotasptamodel extends SB_Model 
{

	public $table = 't_spta_kuota';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_spta_kuota.* FROM t_spta_kuota   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_spta_kuota.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
