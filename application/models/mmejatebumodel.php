<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mmejatebumodel extends SB_Model 
{

	public $table = 'm_mejatebu';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_mejatebu.* FROM m_mejatebu   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_mejatebu.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
