<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trubahsptamodel extends SB_Model 
{

	public $table = 't_ubah_spta';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_ubah_spta.* FROM t_ubah_spta   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_ubah_spta.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
