<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tfieldskbsptmodel extends SB_Model 
{

	public $table = 't_field_skb_spt';
	public $primaryKey = 'id_field_skb';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_field_skb_spt.* FROM t_field_skb_spt   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_field_skb_spt.id_field_skb IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
