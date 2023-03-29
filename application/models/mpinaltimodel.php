<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpinaltimodel extends SB_Model 
{

	public $table = 'm_pinalty';
	public $primaryKey = 'id_pinalty';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_pinalty.* FROM m_pinalty   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_pinalty.id_pinalty IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
