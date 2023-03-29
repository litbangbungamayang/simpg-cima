<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mlokolorimodel extends SB_Model 
{

	public $table = 'm_no_loko';
	public $primaryKey = 'id_loko';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_no_loko.* FROM m_no_loko   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_no_loko.id_loko IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
