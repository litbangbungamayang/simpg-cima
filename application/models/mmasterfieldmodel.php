<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mmasterfieldmodel extends SB_Model 
{

	public $table = 'sap_field';
	public $primaryKey = 'kode_blok';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_field.* FROM sap_field   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_field.id_field IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
