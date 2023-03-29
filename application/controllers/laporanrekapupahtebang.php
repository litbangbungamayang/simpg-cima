<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporanrekapupahtebang extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'laporanrekapupahtebang';
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
		$this->data['content'] =  $this->load->view('laporanrekapupahtebang/index', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	
	function printlaporan(){
		$wh = 'WHERE 0=0';
		$wh2 = '';

		$tgl1 = $_REQUEST['tgl1'];
		$tgl2 = $_REQUEST['tgl2'];
		$bln  = $_REQUEST['bln'];
		$thn  = $_REQUEST['thn'];
		$rjns = $_REQUEST['rjns'];

		$jns = $_REQUEST['jns'];
		$kat = $_REQUEST['kat'];
		$petak = $_REQUEST['petak'];
		$angkutan = $_REQUEST['angkutan'];
		$jnstgl = $_REQUEST['jnstgl'];

		$this->data['title'] = "SEMUA KATEGORI ";
		if($kat != ''){

			if (!empty($kat)) {
				if($kat == 'TSN'){
					$wh .= " AND (c.kode_kat_lahan LIKE 'TS%' AND c.kode_kat_lahan != 'TS-SP')";
					$wh2 .= " AND (b1.kode_kat_lahan LIKE 'TS%' AND b1.kode_kat_lahan != 'TS-SP')";
				}else if($kat == 'TRN'){
					$wh .= " AND (c.kode_kat_lahan LIKE 'TR%' OR c.kode_kat_lahan = 'TS-SP')";
					$wh2 .= " AND (b1.kode_kat_lahan LIKE 'TR%' OR b1.kode_kat_lahan = 'TS-SP')";
				}else{
					$wh .= " AND c.kode_kat_lahan LIKE '$kat%'";
					$wh2 .= " AND b1.kode_kat_lahan LIKE '$kat%'";
				}
			}

			$this->data['title'] = "KATEGORI $kat ";
		}

		
		if($angkutan != ''){
			$wh .= " AND c.jenis_spta = '$angkutan'";
			$wh2 .= " AND b1.jenis_spta = '$angkutan'";
			$this->data['title'] .= "ANGKUTAN $angkutan <br />";
		}else{
			$this->data['title'] .= "SEMUA ANGKUTAN <br />";
		}

		
		
		if($rjns == 1 && $jns != 4) {
			$wh .= " AND a.tgl BETWEEN '$tgl1' and '$tgl2'";
			$this->data['title'] .= 	"PERIODE TANGGAL ".SiteHelpers::datereport($tgl2).' <br />';	
		}else{
			if($jnstgl == 1){

				$wh .= " AND a.tgl BETWEEN '$tgl1' and '$tgl2'";
				$this->data['title'] .= 	"<b style='color:red'>PERIODE TIMBANG</b><br /> TANGGAL ".SiteHelpers::datereport($tgl1).' s/d '.SiteHelpers::datereport($tgl2).'<br />';	
			}else{

				$wh .= " AND c.tgl_giling BETWEEN '$tgl1' and '$tgl2'";
				$this->data['title'] .= 	"<b style='color:red'>PERIODE GILING</b><br /> TANGGAL ".SiteHelpers::datereport($tgl1).' s/d '.SiteHelpers::datereport($tgl2).'<br />';	
			}

			if($petak != '') $wh .= " AND a.kode_blok = '$petak'";
			
		}
		


		if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
				$file = "Rekapitulasi Upah Tebang - Tgl ".SiteHelpers::datereport($tgl2).".xls";
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=$file");
			}

		
			$this->data['coldefadd'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan!=2 and jenis=1 order by id_pekerjaan_tma asc")->result();
			$this->data['coldefrem'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan!=2 and jenis=2 order by id_pekerjaan_tma asc")->result();

			if($jns == 1){
			$result = $this->db->query("SELECT 0 AS ttlyl,
a.`kode_blok`,c.`no_spat`,a.persno_mandor,e.`name` AS mandor_nama,f.`name` AS pta_nama,d.`no_angkutan`,b.*
 FROM t_upah_tebang a 
INNER JOIN t_upah_tebang_detail b ON a.`id`=b.`id_upah_tebang`
INNER JOIN t_spta c ON c.`id`=b.`id_spta`
INNER JOIN t_selektor d ON d.`id_spta`=c.`id` 
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 3) e ON e.`Persno`=a.`persno_mandor`
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 2) f ON f.`Persno`=c.`persno_pta`  $wh
ORDER BY d.`persno_mandor_tma`")->result();
			$rt = $this->db->query("SELECT SUM(a1.`total_bersih`) AS total 
				FROM t_upah_tebang_detail a1 
				INNER JOIN t_upah_tebang b1 ON a1.`id_upah_tebang`=b1.`id` WHERE b1.tgl < '$tgl2'")->row();

			$rx = $this->db->query("SELECT SUM(a1.`total_bersih`) AS total 
				FROM t_upah_tebang_detail a1 
				INNER JOIN t_upah_tebang b1 ON a1.`id_upah_tebang`=b1.`id` WHERE b1.tgl <= '$tgl2'")->row();

			$this->data['detail'] = $result;
			$this->data['allsisalalu'] = $rt->total;
			$this->data['allsisasemua'] = $rx->total;

		$this->load->view('laporanrekapupahtebang/permandor',$this->data);
		}else if($jns == 3){
			$result = $this->db->query("SELECT 0 AS ttlyl,
a.`kode_blok`,c.`no_spat`,a.persno_mandor,e.`name` AS mandor_nama,f.`name` AS pta_nama,d.`no_angkutan`,b.*
 FROM t_upah_tebang a 
INNER JOIN t_upah_tebang_detail b ON a.`id`=b.`id_upah_tebang`
INNER JOIN t_spta c ON c.`id`=b.`id_spta`
INNER JOIN t_selektor d ON d.`id_spta`=c.`id` 
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 3) e ON e.`Persno`=a.`persno_mandor`
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 2) f ON f.`Persno`=c.`persno_pta`  $wh
ORDER BY d.`persno_mandor_tma`")->result();
			$rt = $this->db->query("SELECT SUM(a1.`total_bersih`) AS total 
				FROM t_upah_tebang_detail a1 
				INNER JOIN t_upah_tebang b1 ON a1.`id_upah_tebang`=b1.`id` WHERE b1.tgl < '$tgl2'")->row();

			$rx = $this->db->query("SELECT SUM(a1.`total_bersih`) AS total 
				FROM t_upah_tebang_detail a1 
				INNER JOIN t_upah_tebang b1 ON a1.`id_upah_tebang`=b1.`id` WHERE b1.tgl <= '$tgl2'")->row();

			$this->data['detail'] = $result;
			$this->data['allsisalalu'] = $rt->total;
			$this->data['allsisasemua'] = $rx->total;
		$this->load->view('laporanrekapupahtebang/permandorrekap',$this->data);
		}else if($jns == 2){
			$result = $this->db->query("SELECT no_bukti,a.`kode_blok`,c.`no_spat`,a.persno_mandor,e.`name` AS mandor_nama,f.`name` AS pta_nama,d.`no_angkutan`,b.*
 FROM t_upah_tebang a 
INNER JOIN t_upah_tebang_detail b ON a.`id`=b.`id_upah_tebang`
INNER JOIN t_spta c ON c.`id`=b.`id_spta`
INNER JOIN t_selektor d ON d.`id_spta`=c.`id` 
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 3) e ON e.`Persno`=a.`persno_mandor`
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 2) f ON f.`Persno`=c.`persno_pta`  $wh
ORDER BY a.`no_bukti`")->result();
			$this->data['detail'] = $result;
		$this->load->view('laporanrekapupahtebang/pertransaksi',$this->data);


		}else{
			$result = $this->db->query("SELECT a.tgl,no_bukti,a.`kode_blok`,c.`no_spat`,a.persno_mandor,e.`name` AS mandor_nama,f.`name` AS pta_nama,d.`no_angkutan`,b.*
 FROM t_upah_tebang a 
INNER JOIN t_upah_tebang_detail b ON a.`id`=b.`id_upah_tebang`
INNER JOIN t_spta c ON c.`id`=b.`id_spta`
INNER JOIN t_selektor d ON d.`id_spta`=c.`id` 
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 3) e ON e.`Persno`=a.`persno_mandor`
INNER JOIN (SELECT * FROM sap_m_karyawan WHERE id_jabatan = 2) f ON f.`Persno`=c.`persno_pta`  $wh
ORDER BY a.`no_bukti`")->result();
			$this->data['detail'] = $result;
			$this->data['titlepetak'] = $_REQUEST['petak'];
		$this->load->view('laporanrekapupahtebang/perpetak',$this->data);



		}

		
		
		
		
		
	}
}