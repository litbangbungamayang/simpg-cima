<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporanprotas extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'laporanprotas';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	'Laporan',
			'pageNote'	=>  'SIMPG',
			'pageModule'	=> 'laporan',
		));
	}

	function index(){
		$this->data['content'] =  $this->load->view('laporanprotas/index', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	
	function printlaporan(){
		$wh = 'where 0=0';
		$slfield = "";
		$afd  		= $_REQUEST['divisi'];
		$petak  	= $_REQUEST['kode_blok'];
		$this->data['title'] = "";
		
		$wh .= " and  d.divisi = '$afd'";

		if($petak != ''){
			$wh .= " AND  a.kode_blok = '$petak'";
			$this->data['title'] .= 	" PETAK ".$petak;
		}
		
		$sql = "SELECT
      e.nama_petani,d.kode_blok,d.divisi,d.id_petani_sap,d.aff_tebang,
      d.kode_varietas,d.kepemilikan,d.status_blok,d.`luas_ha`, d.deskripsi_blok,
	  SUM( b.ha_tertebang ) AS tertebang,
      (d.luas_ha - (SUM(b.ha_tertebang))) AS sisa,
      sum(case when concat(a.tebang_pg,a.angkut_pg)=11 then 1 else 0 end) as tapg,
      sum(case when concat(a.tebang_pg,a.angkut_pg)=10 then 1 else 0 end) as tpgas,
      sum(case when concat(a.tebang_pg,a.angkut_pg)=01 then 1 else 0 end) as tsapg,
      sum(case when concat(a.tebang_pg,a.angkut_pg)=00 then 1 else 0 end) as tas,  
      sum(case when concat(a.tebang_pg,a.angkut_pg)=11 then c.netto_final else 0 end) as tapg_kg,
      sum(case when concat(a.tebang_pg,a.angkut_pg)=10 then c.netto_final else 0 end) as tpgas_kg,
      sum(case when concat(a.tebang_pg,a.angkut_pg)=01 then c.netto_final else 0 end) as tsapg_kg,
      sum(case when concat(a.tebang_pg,a.angkut_pg)=00 then c.netto_final else 0 end) as tas_kg, 
      count(a.id) as order_spta,
			min(a.tgl_spta) as tgl_awal_cetak,
			max(a.tgl_spta) as tgl_akhir_cetak,
			datediff(max(a.tgl_spta), min(a.tgl_spta)) as jangka_waktu,
      count(case when a.timb_netto_status=1 then 1 else 0 end) as spta_tertimbang_sd,
      count(case when a.meja_tebu_status=1 then 1 else 0 end) as spta_tergiling_sd,
      sum(case when i.kondisi_tebu='A' then 1 else 0 end) as mutu_a,
      sum(case when i.kondisi_tebu='B' then 1 else 0 end) as mutu_b,
      sum(case when i.kondisi_tebu='C' then 1 else 0 end) as mutu_c,
      sum(case when i.kondisi_tebu='D' then 1 else 0 end) as mutu_d,
      sum(case when i.kondisi_tebu='E' then 1 else 0 end) as mutu_e,
      sum(case when b.terbakar_sel=1 then 1 else 0 end) as terbakar_selektor,
      sum(case when b.ditolak_sel=1 then 1 else 0 end) as ditolak,
      sum(case when a.sbh_status=4 then 1 else 0 end) as spta_on_proses,
      sum(f.gula_total) as gula_total,
      sum(case when a.sbh_status=4 then f.gula_total else 0 end)  as gula_release,
      sum(c.netto_final) AS netto,
      sum(case when a.sbh_status=4 then c.netto_final else 0 end) as netto_release,
      sum(c.netto_final)/d.luas_ha as protas,
    format(sum(case when a.sbh_status=4 then f.gula_total else 0 end)/
    sum(case when a.sbh_status=4 then c.netto_final else 0 end)*100, 2) as r_release,
    sum(g.total_bersih) as upah_tebang,
    sum(h.total) as upah_angkut
    FROM t_spta as a
      left join t_selektor b on b.id_spta = a.id
      left join t_timbangan c on c.id_spat = a.id
      left join sap_field d on d.kode_blok = a.kode_blok
      left join sap_petani e on e.id_petani_sap = a.id_petani_sap      
      left join t_ari f on f.id_spta = a.id
      left join t_upah_tebang_detail as g on g.id_spta=a.id
      left join t_angkutan_detail as h on h.id_spta=a.id
      left join t_meja_tebu as i on i.id_spta=a.id
    $wh
    GROUP BY
      a.kode_blok";
		$result = $this->db->query($sql)->result();
		
		$this->data['result'] = $result;
		if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
				$file = "Laporan PROTAS -  $afd.xls";
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=$file");
		}
		$this->load->view('laporanprotas/perpetak',$this->data);
		
		
	}
}