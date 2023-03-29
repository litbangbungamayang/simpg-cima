<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tdomodel extends SB_Model 
{

	public $table = 't_do';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT t_do.* FROM vw_t_do as t_do
  ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_do.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
