<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tdo extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tdo';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tdomodel');
		$this->model = $this->tdomodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tdo',
		));
		$this->col = array();
		$this->con = array();
		$inf = $this->info['config']['grid'];
		$inf = SiteHelpers::array_sort($inf, 'sortlist', SORT_ASC);
		$in=0;
		foreach ($inf as $key => $t) {
			if($t['view'] =='1'){
				
				$in++;
				$this->col[$in] = $t['field'];
				$this->con[$in] = $t['conn'];
				
			}
			
		}
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	function grids($jenis='x',$periode='x'){
		
		$sort = $this->model->primaryKey; 
		$order = 'asc';
		$filter = "";
		$idpetani = '';$kodeblok = '';
		if(isset($_REQUEST['idpetani'])) $idpetani = $_REQUEST['idpetani'];
		if(isset($_REQUEST['kodeblok'])) $kodeblok = $_REQUEST['kodeblok'];

		if($jenis != 'x'){
			$filter .= " AND jenis_do = '$jenis'";
		}
		if($periode != 'x'){
			$filter .= " AND id_periode = '$periode'";
		}
		if($idpetani != ''){
			$filter .= " AND id_petani_sap = '$idpetani'";
		}
		if($kodeblok != ''){
			$filter .= " AND kode_blok = '$kodeblok'";
		}
		//$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		//order 
		if(isset($_POST['order']))
        {
            if(($_POST['order']['0']['column'])==0){
        		$sort = $this->col[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}else{
            	$sort = $this->col[($_POST['order']['0']['column'])];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

        $filter2 = "";
        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter2 .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter2 .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

        if($filter2 != '') $filter2 .= ")";
        $filter = $filter.$filter2; 

		$params = array(
			'limit'		=> $_POST['start'],
			'page'		=> $_POST['length'],
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		if($field == 'netto_tebu' || $field == 'total_pendapatan_bersih' || $field == 'total_pendapatan' || $field == 'total_potongan'){
            			$row[] = number_format($dt->$field,0,',','.');
            		}else if($field == 'gula_100'){
            			$row[] = number_format($dt->$field,2,',','.');
            		}else if($field == 'status_do'){
            			$stt = array('Buat','Verifikasi');
            			$row[] = $stt[$dt->$field];
            		}else{
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
				}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href="javascript:SximoModal(\''.site_url('tdo/show/'.$dt->$idku).'\',\'View DO\',\'700px\')"  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }

            if($dt->status_do == 1){
            	$btn .= '<a href="'.site_url('tdo/printsendiri/'.$dt->$idku).'"  class="tips " target="_blank" title="Print DO"><i class="fa  fa-print"></i>  </a> &nbsp;&nbsp;';
            }
            
           
 			$row[] = $btn;
            $data[] = $row;
            $no++;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $totalfil,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

	}
	
	function index() 
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
		
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		// Group users permission
		$this->data['access']		= $this->access;
		// Render into template
		
		$this->data['content'] = $this->load->view('tdo/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $this->db->query("SELECT * FROM vw_t_do WHERE id=$id")->row();
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_do'); 
		}
		
		$this->data['id'] = $id;
		echo $this->data['content'] =  $this->load->view('tdo/view', $this->data ,true);	  
		//$this->load->view('layouts/main',$this->data);
	}
  
	function add( $id = null ) 
	{
		if($this->access['is_edit'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
		
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		// Group users permission
		$this->data['access']		= $this->access;
		// Render into template
		$this->data['content'] = $this->load->view('tdo/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}

	function downloadtemplatepot(){
		$idpetani = '';$kodeblok = '';$jenis = 'x';$periode = 'x';
		if(isset($_REQUEST['id_petani_sap'])) $idpetani = $_REQUEST['id_petani_sap'];
		if(isset($_REQUEST['kode_blok'])) $kodeblok = $_REQUEST['kode_blok'];
		if(isset($_REQUEST['jenis'])) $jenis = $_REQUEST['jenis'];
		if(isset($_REQUEST['periode'])) $periode = $_REQUEST['periode'];
		$filter = '';

		if($jenis != 'x'){
			$filter .= " AND jenis_do = '$jenis'";
		}
		if($periode != 'x'){
			$filter .= " AND id_periode = '$periode'";
		}
		if($idpetani != ''){
			$filter .= " AND id_petani_sap = '$idpetani'";
		}
		if($kodeblok != ''){
			$filter .= " AND kode_blok = '$kodeblok'";
		}
		//echo $filter;die();
		header("Content-disposition: attachment; filename=TEMPLATE_POTONGAN_".$periode.".xls");
        header("Content-Type: application/vnd.ms-excel");
		$sql = $this->db->query("SELECT * FROM vw_t_do WHERE 0=0 $filter")->result();
		$no=1;

		echo "<table><thead><tr bgcolor='silver'><th>NO</th><th>ID_DO</th><th>NO_DO</th><th>ID_PERIODE</th><th>KODE_BLOK</th><th>ID_PETANI</th><th>NAMA_PETANI</th><th>DESKRIPSI_BLOK</th><th>NETTO_TEBU</th><th>TOTAL_PENDAPATAN</th>";
		$sqlhead1 = $this->db->query("SELECT CONCAT(a.`id`,'-',posisi,'-',REPLACE(a.`nama_potongan`,' ','_')) AS nama_pot
 FROM m_potongan_do a where a.status=1 order by a.id ASC")->result();
			foreach($sqlhead1 as $hd1){
				echo "<th>".$hd1->nama_pot."</th>";
			}
		echo "</tr></thead>";
		foreach ($sql as $key) {
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$key->id."</td>";
			echo "<td>".$key->no_do."</td>";
			echo "<td>".$key->id_periode."</td>";
			echo "<td>".$key->kode_blok."</td>";
			echo "<td>".$key->id_petani_sap."</td>";
			echo "<td>".$key->nama_petani."</td>";
			echo "<td>".$key->deskripsi_blok."</td>";
			echo "<td>".$key->netto_tebu."</td>";
			echo "<td>".number_format($key->total_pendapatan)."</td>";
			$sqlhead2 = $this->db->query("SELECT IFNULL(b.`nominal`,0) AS nominal
 FROM m_potongan_do a
LEFT JOIN (SELECT * FROM `t_do_potongan` WHERE id_do=$key->id) b ON a.`id`=b.`id_potongan` where a.status=1 order by a.id ASC")->result();
			foreach($sqlhead2 as $hd){
				echo "<td bgcolor='yellow'>".$hd->nominal."</td>";
			}
		}
	}
	
	function generatepotongan(){
		ini_set('memory_limit', '4048M');

		$idpetani = '';$kodeblok = '';$jenis = 'x';$periode = 'x';
		if(isset($_REQUEST['id_petani_sap'])) $idpetani = $_REQUEST['id_petani_sap'];
		if(isset($_REQUEST['kode_blok'])) $kodeblok = $_REQUEST['kode_blok'];
		if(isset($_REQUEST['jenis'])) $jenis = $_REQUEST['jenis'];
		if(isset($_REQUEST['periode'])) $periode = $_REQUEST['periode'];
		$filter = '';

		if($jenis != 'x'){
			$filter .= " AND jenis_do = '$jenis'";
		}
		if($periode != 'x'){
			$filter .= " AND id_periode = '$periode'";
		}
		if($idpetani != ''){
			$filter .= " AND id_petani_sap = '$idpetani'";
		}
		if($kodeblok != ''){
			$filter .= " AND kode_blok = '$kodeblok'";
		}
		//echo $filter;die();
		$sql = $this->db->query("SELECT * FROM t_do WHERE 0=0 $filter")->result();
		$x = 0;
		foreach ($sql as $key) {
			$this->db->query("DELETE FROM t_do_potongan WHERE id_do=$key->id");
			$mpot = "SELECT *,
CASE
	WHEN jenis_potongan = 0 THEN 0
	WHEN jenis_potongan = 2 THEN (SELECT SUM(pot_upah_tebang) FROM `t_do_detail` WHERE id_periode = $periode AND kode_blok = '$key->kode_blok')
	WHEN jenis_potongan = 1 THEN (SELECT SUM(pot_upah_angkut) FROM `t_do_detail` WHERE id_periode = $periode AND kode_blok = '$key->kode_blok')
	WHEN jenis_potongan = 3 THEN (SELECT netto_tebu FROM `t_do` WHERE id_periode=$periode AND kode_blok='$key->kode_blok')*nominal
	WHEN jenis_potongan = 4 THEN ROUND((SELECT gula_90 FROM `t_do` WHERE id_periode=$periode AND kode_blok='$key->kode_blok')/50,0)*nominal
	WHEN jenis_potongan = 5 THEN ROUND((SELECT gula_10 FROM `t_do` WHERE id_periode=$periode AND kode_blok='$key->kode_blok')/50,0)*nominal
	WHEN jenis_potongan = 6 THEN 0
END AS nominal_pot
FROM 
m_potongan_do
WHERE STATUS = 1";
			$rsmpot = $this->db->query($mpot)->result();
			$totpot = 0;
			foreach ($rsmpot as $val) {
				$d = array('id_do'=>$key->id,'id_potongan'=>$val->id,'nominal'=>$val->nominal_pot,'nama_potongan'=>$val->nama_potongan,'posisi'=>$val->posisi);
				$this->db->insert('t_do_potongan',$d);
				$totpot = $totpot+$val->nominal_pot;
			}

			$this->db->query("UPDATE t_do SET total_potongan = $totpot,total_pendapatan_bersih = total_pendapatan-$totpot where id=$key->id");
			$x++;
		}

		$this->session->set_flashdata('message',SiteHelpers::alert('success',$x." DO telah tergenerate Potongannya!!"));
		redirect('tdo/add',301);
	}


	function importpotongan(){
		echo $this->load->view('tdo/uploadpotongan',null, true );
	}

	function uploadpotongan(){
		ini_set('memory_limit', '4048M');
		ini_set('upload_max_filesize','30M');
		ini_set('post_max_size','30M');

		include (APPPATH.'/third_party/SpreadsheetReader.php');
		$file = 'TEMP_POT.xlsx';
		if(move_uploaded_file($_FILES['template_potongan']['tmp_name'], $file)){
			try{
				$files = $file;
				$Spreadsheet = new SpreadsheetReader($files);

				$Sheets = $Spreadsheet -> Sheets();
				$BaseMem = memory_get_usage();
				$Spreadsheet -> ChangeSheet(0);
				$totdata = 0;
				$idpot = array();
				$posisipot = array();
				$namapot = array();
				
				$x=0;
				foreach ($Spreadsheet as $key => $row)
				{
					if($key == 0){
						for($col=10;$col<count($row);$col++){
							$colsplit = explode('-', $row[$col]);
							$idpot[$col] = $colsplit[0];
							$posisipot[$col] = $colsplit[1];
							$namapot[$col] = str_replace("_"," ",$colsplit[2]);
						}
					}else{
						$this->db->query("DELETE FROM t_do_potongan WHERE id_do='".$row[1]."'");
						$totpot = 0;
						for($co=10;$co<count($row);$co++){
							$d = array('id_do'=>$row[1],'id_potongan'=>$idpot[$co],'nominal'=>$row[$co],
								'nama_potongan'=>$namapot[$co],'posisi'=>$posisipot[$co]);
				$this->db->insert('t_do_potongan',$d);
				$totpot = $totpot+$row[$co];
						}
						$this->db->query("UPDATE t_do SET total_potongan = $totpot,total_pendapatan_bersih = total_pendapatan-$totpot where id='".$row[1]."'");
						$x++;
					}
				}
				echo "Total ".$x." DO, Potongannya berhasil diupload, Silahkan di cek..";
			}catch (Exception $E)
			{
				echo $E -> getMessage();
			}
		}
	}

	function formverifikasi(){
		echo $this->load->view('tdo/formverifikasi',null, true );
	}

	function formcancelverifikasi(){
		echo $this->load->view('tdo/formcancelverif',null, true );
	}

	function viewverif(){
		$idperiod = $_REQUEST['idperiode'];
		$row = $this->db->query("SELECT * FROM t_periode_do WHERE id=$idperiod")->row_array();
		$this->data['row'] = $row;
		echo $this->load->view('tdo/viewverif',$this->data, true );
	}

	function verifikasido(){
		$idperiod = $_REQUEST['idperiode'];
		$row = $this->db->query("UPDATE t_do set status_do = 1,verif_act='".$this->session->userdata('fid')."',verif_date=now() WHERE id_periode=$idperiod");
		$totrow = $this->db->affected_rows();
		echo $totrow." DO berhasil di verikasi Oleh ".$this->session->userdata('fid');
		$this->db->query("UPDATE t_periode_do SET status=1,tgl_act=now(),user_act='".$this->session->userdata('fid')."' WHERE id=$idperiod");
		//input ke buku hutang bahwa sudah menjadi potongan
		$sqlpot = $this->db->query("SELECT a.nominal,c.`id_petani_sap`,c.`no_do`,d.id as id_pinjaman,d.saldo_kredit
FROM `t_do_potongan` a 
INNER JOIN `m_potongan_do` b ON a.`id_potongan`=b.`id` 
INNER JOIN t_do c ON c.`id`=a.`id_do`
INNER JOIN t_pinjaman_petani d ON d.`id_petani_sap`=c.`id_petani_sap`
WHERE b.`jenis_potongan`=6 AND a.`nominal` > 0 AND c.`status_do`=1 AND c.`id_periode`=$idperiod order by c.id_petani_sap")->result();
		$sisas = 0;$idpetani = '';$nominalpot = 0;$saldos = 0;
		foreach ($sqlpot as $kes) {
			if($idpetani != $kes->id_petani_sap){
				$sisas = 0;
				$nominalpot = 0;$saldos = 0;
			}
			$idpetani = $kes->id_petani_sap;
			$nominalpot += $kes->nominal;
			$sisas = $kes->saldo_kredit - $nominalpot;
			//$saldos += $kes->saldo_kredit;
			
			$data = array(
			'tgl'			=>date('Y-m-d'),
			'jenis_tx'		=>2,
			'no_ref'		=>$kes->no_do,
			'id_pinjaman'	=>$kes->id_pinjaman,
			'id_petani_sap'	=>$kes->id_petani_sap,
			'kredit'		=>$kes->nominal,
			'saldo'			=>$sisas,
			'saldo_sebelumnya'=>$sisas+$kes->nominal,
			'user_act'		=>$this->session->userdata('fid'),
			'tgl_act'		=>date('Y-m-d H:i:s')
		);
			$this->db->insert('t_pinjaman_petani_detail',$data);
			$this->db->query("UPDATE t_pinjaman_petani SET saldo_kredit=".$sisas.",last_update=NOW(),user_update='".$this->session->userdata('fid')."' where id=".$kes->id_pinjaman);
			
		}

	}

	function cancelverifikasido(){
		$idperiod = $_REQUEST['idperiode'];
		$row = $this->db->query("UPDATE t_do set status_do = 0,verif_act='',verif_date='' WHERE id_periode=$idperiod");
		$totrow = $this->db->affected_rows();
		echo $totrow." DO berhasil di Cancel Verifikasi Oleh ".$this->session->userdata('fid');
		$this->db->query("UPDATE t_periode_do SET status=0,tgl_act=now(),user_act='".$this->session->userdata('fid')."' WHERE id=$idperiod");

		$this->db->query("DELETE a.* FROM t_pinjaman_petani_detail a INNER JOIN t_do b ON a.`no_ref`=b.`no_do` WHERE b.`id_periode`=$idperiod");
		$this->db->query("UPDATE t_pinjaman_petani a 
INNER JOIN t_do b ON b.`id_petani_sap`=a.`id_petani_sap`
SET a.saldo_kredit = (SELECT SUM(debet)-SUM(kredit) FROM t_pinjaman_petani_detail WHERE id_pinjaman = a.`id`)
WHERE b.`id_periode`=$idperiod");

	}

	function printsendiri( $id = null) 
	{
		
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $this->db->query("SELECT * FROM vw_t_do WHERE id=$id")->row();
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_do'); 
		}
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tdo/view', $this->data ,true);	  
		$this->load->view('layouts/kosongcetakqr', $this->data );
	}

	function printall90( $id = null) 
	{
		
		$row =  $this->db->query("SELECT * FROM vw_t_do WHERE id_periode=$id")->result();
		if($row)
		{
			$this->data['content'] = '';
			foreach($row as $r){
				$this->data['do'] = $r;
				$this->data['id'] = $r->id;
				$this->data['content'] .=  $this->load->view('tdo/cetak90', $this->data ,true);
			}

			  
			$this->load->view('layouts/kosongcetakqr', $this->data );
		} else {
			redirect('tdo',301);
		}
		
	}

	function printallkwt( $id = null) 
	{
		
		$row =  $this->db->query("SELECT * FROM vw_t_do WHERE id_periode=$id")->result();
		if($row)
		{
			$this->data['content'] = '';
			foreach($row as $r){
				$this->data['do'] = $r;
				$this->data['id'] = $r->id;
				$this->data['content'] .=  $this->load->view('tdo/cetakkwt', $this->data ,true);
			}

			  
			$this->load->view('layouts/kosongcetakqr', $this->data );
		} else {
			redirect('tdo',301);
		}
		
	}
	
	function printalllampiran( $id = null) 
	{
		
		$row =  $this->db->query("SELECT * FROM vw_t_do WHERE id_periode=$id")->result();
		if($row)
		{
			$this->data['content'] = '';
			foreach($row as $r){
				$this->data['do'] = $r;
				$this->data['id'] = $r->id;
				$this->data['content'] .=  $this->load->view('tdo/cetaklampiran', $this->data ,true);
			}

			  
			$this->load->view('layouts/kosongcetakqr', $this->data );
		} else {
			redirect('tdo',301);
		}
		
	}

	function printall10( $id = null) 
	{
		
		$row =  $this->db->query("SELECT * FROM vw_t_do WHERE id_periode=$id and is_natura=1")->result();
		if($row)
		{
			$this->data['content'] = '';
			foreach($row as $r){
				$this->data['do'] = $r;
				$this->data['id'] = $r->id;
				$this->data['content'] .=  $this->load->view('tdo/cetak10', $this->data ,true);
			}

			  
			$this->load->view('layouts/kosongcetakqr', $this->data );
		} else {
			redirect('tdo',301);
		}
		
	}

	function exporttoexcel(){

		$idpetani = '';$kodeblok = '';$jenis = 'x';$periode = 'x';
		if(isset($_REQUEST['id_petani_sap'])) $idpetani = $_REQUEST['id_petani_sap'];
		if(isset($_REQUEST['kode_blok'])) $kodeblok = $_REQUEST['kode_blok'];
		if(isset($_REQUEST['jenis'])) $jenis = $_REQUEST['jenis'];
		if(isset($_REQUEST['periode'])) $periode = $_REQUEST['periode'];
		$filter = '';

		if($jenis != 'x'){
			$filter .= " AND jenis_do = '$jenis'";
		}
		if($periode != 'x'){
			$filter .= " AND id_periode = '$periode'";
		}
		if($idpetani != ''){
			$filter .= " AND id_petani_sap = '$idpetani'";
		}
		if($kodeblok != ''){
			$filter .= " AND kode_blok = '$kodeblok'";
		}

		$per = $this->db->query("SELECT * FROM t_periode_do where id = $periode")->row();

		$this->data['row'] = $this->db->query("SELECT * FROM t_periode_do where id = $periode")->row_array();
		//$this->data['id'] = $id;
		$rx = $this->load->view('tperiodegiling/viewcetak', $this->data ,true);
		//echo $filter;die();
		header("Content-disposition: attachment; filename=DO_".CNF_PG."_".$per->nama_periode.".xls");
        header("Content-Type: application/vnd.ms-excel");
		$sql = $this->db->query("SELECT * FROM vw_t_do WHERE 0=0 $filter")->result();
		$no=1;

		//sql potongan head
		$sqlpot = $this->db->query("SELECT nama_potongan FROM `t_do_potongan` a INNER JOIN t_do b ON a.`id_do`=b.`id` WHERE 0=0 $filter GROUP BY id_potongan ORDER BY id_potongan ASC")->result();
		$thpot = '';$colspan = 0;
		foreach ($sqlpot as $key) {
			$colspan++;
			$thpot .= "<th bgcolor='silver'>".$key->nama_potongan."</th>";
		}

		echo "<table><thead>
		<tr><td colspan='19' align='center'>DATA DO PERIODE $per->nama_periode</td></tr>
		<tr><td colspan='19' align='center'>".CNF_PG."</td></tr>
		<tr><td colspan='19' align='center'>".SiteHelpers::daterpt($per->tgl_awal)." s/d ".SiteHelpers::daterpt($per->tgl_akhir)."</td></tr>
		<tr>
		<tr><td colspan='19' align='center'>
".$rx."
		</td></tr>
		<th bgcolor='silver'>NO</th>
		<th bgcolor='silver'>ID_DO</th>
		<th bgcolor='silver'>NO_DO</th>
		<th bgcolor='silver'>PERIODE</th>
		<th bgcolor='silver'>KODE_BLOK</th>
		<th bgcolor='silver'>ID_PETANI</th>
		<th bgcolor='silver'>NAMA_PETANI</th>
		<th bgcolor='silver'>DESKRIPSI_BLOK</th>
		<th bgcolor='silver'>HA_TERGILING</th>
		<th bgcolor='silver'>NETTO_TEBU</th>
		<th bgcolor='silver'>GULA_100</th>
		<th bgcolor='silver'>GULA_90</th>
		<th bgcolor='silver'>GULA_10</th>
		<th bgcolor='silver'>TETES_PTR</th>
		<th bgcolor='silver'>HARGA_GULA</th>
		<th bgcolor='silver'>HARGA_TETES</th>
		<th bgcolor='silver'>TOTAL_PENDAPATAN</th>".
		$thpot."
		<th bgcolor='silver'>TOTAL_POTONGAN</th>
		<th bgcolor='silver'>TOTAL_BERSIH</th>";
		echo "</tr></thead>";
		$totalgula100 = 0;
		$totalgula90 = 0;
		$totalgula10 = 0;
		$totalpendapatan = 0;
		$totalpotongan = 0;
		$totalbersih = 0;
		$totaltebu = 0;
		$totaltetes = 0;
		foreach ($sql as $key) {
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$key->id."</td>";
			echo "<td>".$key->no_do."</td>";
			echo "<td>".$key->nama_periode."</td>";
			echo "<td>".$key->kode_blok."</td>";
			echo "<td>".$key->id_petani_sap."</td>";
			echo "<td>".$key->nama_petani."</td>";
			echo "<td>".$key->deskripsi_blok."</td>";
			echo "<td>".$key->ha_tergiling."</td>";
			echo "<td>".$key->netto_tebu."</td>";
			echo "<td>".number_format($key->gula_100,2)."</td>";
			echo "<td>".number_format($key->gula_90,2)."</td>";
			echo "<td>".number_format($key->gula_10,2)."</td>";
			echo "<td>".number_format($key->berat_tetes,2)."</td>";
			echo "<td>".number_format($key->harga_gula)."</td>";
			echo "<td>".number_format($key->harga_tetes)."</td>";
			echo "<td>".number_format($key->total_pendapatan)."</td>";
			//sql potongan detail
			$sqlpot = $this->db->query("SELECT a.nominal FROM `t_do_potongan` a INNER JOIN t_do b ON a.`id_do`=b.`id` WHERE 0=0 $filter and b.id = ".$key->id." GROUP BY id_potongan ORDER BY id_potongan ASC")->result();
		
		foreach ($sqlpot as $keys) {
			echo "<td bgcolor='yellow'>".number_format($keys->nominal)."</td>";
		}

			echo "<td>".number_format($key->total_potongan)."</td>";
			echo "<td>".number_format($key->total_pendapatan_bersih)."</td>";
			echo "</tr>";
			$totaltetes += $key->berat_tetes;
			$totaltebu += $key->netto_tebu;
			$totalgula100 += $key->gula_100;
			$totalgula90 += $key->gula_90;
			$totalgula10 += $key->gula_10;
			$totalpendapatan += $key->total_pendapatan;
			$totalpotongan += $key->total_potongan;
			$totalbersih += $key->total_pendapatan_bersih;
			
		}

		echo "<tr>";
			echo "<td colspan='9' bgcolor='yellow'> T O T A L</td>";
			echo "<td bgcolor='yellow'>".number_format($totaltebu)."</td>";
			echo "<td bgcolor='yellow'>".number_format($totalgula100,2)."</td>";
			echo "<td bgcolor='yellow'>".number_format($totalgula90,2)."</td>";
			echo "<td bgcolor='yellow'>".number_format($totalgula10,2)."</td>";
			echo "<td bgcolor='yellow'>".number_format($totaltetes,2)."</td>";
			echo "<td bgcolor='yellow'></td>";
			echo "<td bgcolor='yellow'></td>";
			echo "<td bgcolor='yellow'>".number_format($totalpendapatan)."</td>";
			echo "<td bgcolor='yellow' colspan=".$colspan."></td>";
			echo "<td bgcolor='yellow'>".number_format($totalpotongan)."</td>";
			echo "<td bgcolor='yellow'>".number_format($totalbersih)."</td>";
			echo "</tr>";


			echo "<tr><td></td>";
			echo "</tr>";
			echo "<tr><td colspan=5 align=center><br />".date('d M Y')."</td><td colspan=9>&nbsp;</td><td></td></tr>";
			echo "<tr><td colspan=8 align=center>Manajer Keuangan<br /><br/><br /><br/><br /><br/>..............</td>
			<td colspan=9>&nbsp;</td><td colspan=5 align=center>General Manager<br /><br/><br /><br/><br /><br/>".CNF_GM."</td></tr>";
			echo "</tr>";

	}


}
