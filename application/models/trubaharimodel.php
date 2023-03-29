<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trubaharimodel extends SB_Model 
{

	public $table = 't_ubah_ari';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_ubah_ari.* FROM t_ubah_ari   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_ubah_ari.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
