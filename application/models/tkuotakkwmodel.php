<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tkuotakkwmodel extends SB_Model 
{

	public $table = 't_spta_kuota_kkw';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_spta_kuota_kkw.* FROM t_spta_kuota_kkw   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_spta_kuota_kkw.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
