<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporanari extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'laporanari';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	'Laporan',
			'pageNote'	=>  'SIM PG',
			'pageModule'	=> 'laporan',
		));
	}

	function index(){
		$this->data['content'] =  $this->load->view('laporanari/index', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	
	function printlaporan(){
		$wh = 'WHERE 0=0';

		$tglgiling = $_REQUEST['tglgiling'];
		if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
			$file = "Laporan ARI AFDELING - PERIODE ".SiteHelpers::datereport($tglgiling).".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		}
		$this->data['title'] = 'TANGGAL GILING '.SiteHelpers::daterpt($tglgiling);
		if(CNF_METODE ==1){
		$sql = "SELECT DATE_FORMAT(tgl_ari,'%d-%m-%Y %H:%i') AS tgl_analisa,
b.`no_spat`,b.`kode_blok`,f.`nama_petani`,d.`netto_final`,IF(b.`jenis_spta`='TRUK',c.`no_angkutan`,'-') AS truk,IF(b.`jenis_spta`='LORI',c.`no_angkutan`,'-') AS lori ,
b.`kode_kat_lahan`,a.`persen_brix_ari`,a.`persen_pol_ari`,a.`ph_ari`,a.`hk`,a.`nilai_nira`,a.`rendemen_ari`,a.`hablur_ari`,e.deskripsi_blok,b.kode_affd,e1.kondisi_tebu
FROM t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
INNER JOIN t_selektor c ON c.`id_spta`=a.`id_spta`
INNER JOIN t_timbangan d ON d.`id_spat`=b.`id`
INNER JOIN sap_field e ON e.`kode_blok`=b.`kode_blok` 
INNER JOIN t_meja_tebu e1 on e1.id_spta = b.id
LEFT JOIN sap_petani f ON f.`id_petani_sap`=e.`id_petani_sap`
WHERE 0=0 AND b.tgl_giling = '$tglgiling' 
GROUP BY b.id ORDER BY kode_affd ASC";
}else{
	$sql = "SELECT DATE_FORMAT(tgl_ari,'%d-%m-%Y %H:%i') AS tgl_analisa,
b.`no_spat`,b.`kode_blok`,f.`nama_petani`,d.`netto_final`,IF(b.`jenis_spta`='TRUK',c.`no_angkutan`,'-') AS truk,IF(b.`jenis_spta`='LORI',c.`no_angkutan`,'-') AS lori ,
b.`kode_kat_lahan`,a.`persen_brix_ari`,a.`persen_pol_ari`,a.`ph_ari`,a.`hk`,a.`nilai_nira`,a.`rendemen_ari`,a.`hablur_ari`,e.deskripsi_blok,b.kode_affd,e1.kondisi_tebu
FROM t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
INNER JOIN t_selektor c ON c.`id_spta`=a.`id_spta`
INNER JOIN t_timbangan d ON d.`id_spat`=b.`id`
INNER JOIN sap_field e ON e.`kode_blok`=b.`kode_blok` 
LEFT JOIN t_meja_tebu e1 on e1.id_spta = b.id
LEFT JOIN sap_petani f ON f.`id_petani_sap`=e.`id_petani_sap`
WHERE 0=0 AND b.tgl_timbang = '$tglgiling' 
GROUP BY b.id ORDER BY kode_affd ASC";
}
$result = $this->db->query($sql)->result();
		
		$this->data['result'] = $result;
		$this->load->view('laporanari/hasilanalisa',$this->data);
	}

	function printlaporanspat(){
		$wh = 'WHERE 0=0';

		$tglgiling = $_REQUEST['tglgiling'];

		if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
			$file = "Laporan ARI SPAT - PERIODE ".SiteHelpers::datereport($tglgiling).".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		}
		
		$this->data['title'] = 'TANGGAL GILING '.SiteHelpers::daterpt($tglgiling);

		if(CNF_METODE ==1){
			$sql = "select 
		  a.no_urut_analisa_rendemen,
		  a.meja_tebu_tgl,
		  a.no_spat,
		  a.kode_blok,
		  b.no_angkutan,	
		  c.netto,
		  d.persen_brix_ari,
		  d.persen_pol_ari,d.rendemen_individu,e1.kondisi_tebu
		from
		t_spta a
		inner join t_selektor b on a.id = b.id_spta
		inner join t_timbangan c on a.id = c.id_spat
		inner join t_ari d on a.id = d.id_spta
		INNER JOIN t_meja_tebu e1 on e1.id_spta = a.id
		where Date(a.tgl_giling) = '$tglgiling'
		order by a.no_urut_analisa_rendemen";
		}else{
			$sql = "select 
		  a.no_urut_analisa_rendemen,
		  a.meja_tebu_tgl,
		  a.no_spat,
		  a.kode_blok,
		  b.no_angkutan,	
		  c.netto,
		  d.persen_brix_ari,
		  d.persen_pol_ari,d.rendemen_individu,e1.kondisi_tebu
		from
		t_spta a
		inner join t_selektor b on a.id = b.id_spta
		inner join t_timbangan c on a.id = c.id_spat
		inner join t_ari d on a.id = d.id_spta
		LEFT JOIN t_meja_tebu e1 on e1.id_spta = a.id
		where Date(a.tgl_timbang) = '$tglgiling'
		order by d.tgl_ari ASC";
		}
		
		$result = $this->db->query($sql)->result();
		
		$this->data['result'] = $result;
		$this->load->view('laporanari/hasilanalisaspat',$this->data);
	}
}