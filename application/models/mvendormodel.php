<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mvendormodel extends SB_Model 
{

	public $table = 'm_vendor';
	public $primaryKey = 'kode_vendor';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_vendor.* FROM m_vendor   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_vendor.kode_vendor IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
