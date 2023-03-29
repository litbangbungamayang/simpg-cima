<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Listskbsptmodel extends SB_Model 
{

	public $table = 't_skbspt';
	public $primaryKey = 'id_skbspt';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_skbspt.* FROM t_skbspt   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_skbspt.id_skbspt IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
