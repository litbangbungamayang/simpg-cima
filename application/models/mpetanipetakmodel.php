<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpetanipetakmodel extends SB_Model 
{

	public $table = 'sap_petani';
	public $primaryKey = 'id_petani_sap';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_petani.* FROM sap_petani   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_petani.id_petani IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
