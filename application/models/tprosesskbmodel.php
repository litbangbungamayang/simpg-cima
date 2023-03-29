<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tprosesskbmodel extends SB_Model 
{

	public $table = 't_skbspt';
	public $primaryKey = 'id_skbspt';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT t_skbspt.*, b.netto_final, b.tgl_netto, c.rendemen_ari, c.tgl_ari, d.tgl_timbang as tgl_timbang_spta, d.tgl_giling as tgl_giling_spta from t_skbspt 
 join t_timbangan as b on b.id_spat = t_skbspt.id_spta
 join t_ari as c on c.id_spta = t_skbspt.id_spta
 join t_spta as d on d.id = t_skbspt.id_spta  ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_skbspt.id_skbspt IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}


	public function QuerySeleksi($tgl_giling)
	{
		$query = "SELECT t_skbspt.*, b.netto_final, b.tgl_netto, c.rendemen_ari, c.tgl_ari, 
                 d.tgl_timbang as tgl_timbang_spta, d.tgl_giling as tgl_giling_spta from t_skbspt 
				 join t_timbangan as b on b.id_spat = t_skbspt.id_spta
				 join t_ari as c on c.id_spta = t_skbspt.id_spta
				 join t_spta as d on d.id = t_skbspt.id_spta
				 where c.rendemen_ari > (select r_min_skb from tb_setting limit 1) 
				 and d.tgl_giling = '$tgl_giling' and d.sbh_status = 0 and d.ari_status = 1";

		$result = $this->db->query($query);
		return $result;
	}

}

?>
