<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporanselektor extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'laporanselektor';
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
		$this->data['content'] =  $this->load->view('laporanselektor/index', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	
	function printlaporan(){
		$wh = 'WHERE 0=0';

		$tgl1 = $_REQUEST['tgl1'];
		$tgl2 = $_REQUEST['tgl2'];
		$bln  = $_REQUEST['bln'];
		$thn  = $_REQUEST['thn'];
		$rjns = $_REQUEST['rjns'];
		$jns  = $_REQUEST['jns'];


		$kat  		= $_REQUEST['kat'];
		$angkutan  	= $_REQUEST['angkutan'];
		$afd  		= $_REQUEST['divisi'];
		$petak  	= $_REQUEST['kode_blok'];
		
		
		if($rjns == 1) {
			$wh .= " AND date(tgl_urut) between '$tgl1' and '$tgl2'";
			$this->data['title'] = 	"PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).' <br />';	
		}
		if($rjns == 2) {
			$wh .= " AND MONTH(tgl_urut) = '$bln' and YEAR(a.tgl_urut) = '$thn'";
			$this->data['title'] = 	"BULAN ".SiteHelpers::blnreport($bln)." TAHUN ".$thn.' <br />';
		}
		if($rjns == 3) {
			$wh .= " AND  YEAR(tgl_urut) = '$thn'";
			$this->data['title'] = 	"TAHUN ".$thn.' <br />';
		}


		if($kat != ''){
			$wh .= " AND  b.kode_kat_lahan LIKE '$kat%'";
			$this->data['title'] .= 	" KATEGORI ".$kat;
		}

		if($angkutan != ''){
			$wh .= " AND  b.jenis_spta = '$angkutan'";
			$this->data['title'] .= 	" ANGKUTAN ".$angkutan;
		}

		if($afd != ''){
			$wh .= " AND  e.divisi = '$afd'";
			$this->data['title'] .= 	"<br /> AFDELING ".$afd;
		}

		if($petak != ''){
			$wh .= " AND  e.kode_blok = '$petak'";
			$this->data['title'] .= 	" PETAK ".$petak;
		}

		if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
				$file = "Laporan Selektor - PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).".xls";
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=$file");
		}

		if($jns == 1){

		$sql = "SELECT
		`b`.`kode_blok`         AS `kode_blok`,
		`e`.`deskripsi_blok`    AS `deskripsi_blok`,
		`b`.`kode_kat_lahan`    AS `kode_kat_lahan`,
		 b.kode_affd,
		e.luas_ha,
	 	e.luas_tebang,
		   sum(a.ha_tertebang) AS tertebang,
		   e.luas_ha-sum(a.ha_tertebang) AS sisa,
		   SUM(if(b.jenis_spta='TRUK', 1, 0)) AS truk,
		   SUM(if(b.jenis_spta='LORI', 1, 0)) AS lori,
		   SUM(if(b.jenis_spta='ODONG2', 1, 0)) AS odong2,
		   SUM(if(b.jenis_spta='TRAKTOR', 1, 0)) AS traktor,
		 count(a.id_selektor) AS jumlah
		FROM `t_selektor` `a`
			INNER JOIN `t_spta` `b` ON `a`.`id_spta` = `b`.`id`
			INNER JOIN `sap_field` `e` ON `e`.`kode_blok` = `b`.`kode_blok` 
			$wh
		GROUP BY b.`kode_blok`
		ORDER BY b.kode_affd ASC";
		$result = $this->db->query($sql)->result();
				
		$this->data['result'] = $result;
		$this->load->view('laporanselektor/perpetak',$this->data);

		}elseif($jns == 2){

			$sql = "SELECT
			`b`.`no_spat`           AS `no_spat`,
			`b`.`kode_blok`         AS `kode_blok`,
			`e`.`deskripsi_blok`    AS `deskripsi_blok`,
			`b`.`kode_kat_lahan`    AS `kode_kat_lahan`,
			`c`.`name`              AS `mandor`,
			f.name as pta,
			b.`timb_bruto_tgl`,
			b.`timb_netto_tgl`,
			b.`jenis_spta`,
			b.kode_affd,
			a.*
			FROM `t_selektor` `a`
				INNER JOIN `t_spta` `b` ON `a`.`id_spta` = `b`.`id`
				INNER JOIN `sap_m_karyawan` `c`  ON `c`.`Persno` = CONVERT(`a`.`persno_mandor_tma` USING utf8)
				INNER JOIN `sap_m_karyawan` `f`  ON `f`.`Persno` = CONVERT(`b`.`persno_pta` USING utf8)
				INNER JOIN `sap_field` `e` ON `e`.`kode_blok` = `b`.`kode_blok` $wh GROUP BY b.`id`
			ORDER BY `a`.`tgl_selektor` ASC";
			$result = $this->db->query($sql)->result();
					
			$this->data['result'] = $result;
			$this->load->view('laporanselektor/perspta',$this->data);
		}

	}

}