<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mjarakmodel extends SB_Model 
{

	public $table = 'm_biaya_jarak';
	public $primaryKey = 'id_jarak';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_biaya_jarak.* FROM m_biaya_jarak   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_biaya_jarak.id_jarak IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
