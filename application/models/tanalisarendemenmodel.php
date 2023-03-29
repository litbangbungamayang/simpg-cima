<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tanalisarendemenmodel extends SB_Model 
{

	public $table = 't_ari';
	public $primaryKey = 'id_ari';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_ari.* FROM vw_ari_data as t_ari   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_ari.id_ari IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
