<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpotongandomodel extends SB_Model 
{

	public $table = 'm_potongan_do';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_potongan_do.* FROM m_potongan_do   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_potongan_do.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
