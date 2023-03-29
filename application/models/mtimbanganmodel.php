<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mtimbanganmodel extends SB_Model 
{

	public $table = 'm_timbangan';
	public $primaryKey = 'id_timbangan';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_timbangan.* FROM m_timbangan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_timbangan.id_timbangan IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
