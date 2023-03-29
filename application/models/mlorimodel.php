<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mlorimodel extends SB_Model 
{

	public $table = 'm_lori';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_lori.* FROM m_lori   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_lori.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
