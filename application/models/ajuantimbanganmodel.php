<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajuantimbanganmodel extends SB_Model 
{

	public $table = 't_ubah_timbangan';
	public $primaryKey = 'id_ubah_timbangan';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_ubah_timbangan.* FROM t_ubah_timbangan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_ubah_timbangan.id_ubah_timbangan IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
