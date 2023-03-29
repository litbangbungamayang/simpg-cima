<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tcetakulang extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tcetakulang';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tcetakulangmodel');
		$this->model = $this->tcetakulangmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tcetakulang',
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

	function grids($tgl='',$afd = '0'){
		
		$sort = $this->model->primaryKey; 
		$order = 'asc';
		$filter = "";
		
		if($tgl != ''){
			$filter .= ' AND tgl_spta = "'.$tgl.'"';
		}
		
		if($afd != '0'){
			$filter .= ' AND kode_affd = "'.$afd.'"';
		}
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
		$filterx = '';
        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filterx .= " AND ( ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filterx .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }
		
		if($filterx != '') $filterx .= ')';
		$filter = $filter.$filterx;
		

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
		$idku = $this->model->primaryKey;

		foreach ($rows as $dt) {
            $row = array();
            if($this->access['is_edit'] ==1 && $dt->selektor_status == 0 && $dt->retur_status == 0){
           		$row[] = '<input type="checkbox" class="cekretur" name="idx[]" value="'.$dt->$idku.'">';
        	}else{
        		$row[] = '';
        	}

            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }
 
            //add html for action
            $btn ='';
            if($this->access['is_detail'] ==1 && $dt->retur_status == 0){
            	$btn .= '<a href='.site_url('tcetakulang/cetakulang/'.$dt->$idku).' target="_blank"  class="tips "  title="view"><i class="fa  fa-print"></i> Cetak Ulang </a> &nbsp;&nbsp;<br />';
            }
            if($this->access['is_edit'] ==1 && $dt->selektor_status == 0 && $dt->retur_status == 0){
            	//$btn .= '<a href=javascript:getRetur('.$dt->$idku.')  class="tips "  title="Edit"><i class="fa  fa-share"></i> Retur </a> &nbsp;&nbsp;';
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
		
		$this->data['content'] = $this->load->view('tcetakulang/index',$this->data, true );
		
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
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_spta'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tcetakulang/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
  
	function retur() 
	{
		
		$this->data['id'] = $_GET['id'];
		$this->data['tgl_spta'] = $_GET['tgl'];
		echo $this->data['content'] = $this->load->view('tcetakulang/form',$this->data, true );		
	  	//$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
			$id = $_POST['id'];
			$a = explode(',', $id);
			$r = 0;
			for($i = 0; $i<count($a);$i++){
				//echo $a[$i];
				$data['id'] = $a[$i];
				$data['retur_status'] = 1;
				$data['retur_tgl'] = date('Y-m-d H:i:s');
				$data['retur_alasan'] = $_POST['retur_alasan'];
				//var_dump($data);
				$ID = $this->model->insertRow($data , $data['id']);
				$this->inputLogs(" ID : $ID  , berhasil di retur");
				$r++;

				$sql = "UPDATE t_spta_kuota_tot a INNER JOIN t_spta b ON a.`kode_blok`=b.`kode_blok` SET a.kouta_tot = (a.kouta_tot-1) 
WHERE a.tgl_spta = b.`tgl_spta` AND b.`id`='".$data['id']."'";
				$this->db->query($sql);

			}

			$this->db->query("UPDATE t_spta_kuota set retur=(retur+".$r.") WHERE tgl_spta='".$_POST['tgl_spta']."'");
			
			// Input logs
			
			//$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			
			//
			
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success',$r." SPTA Berhasil di Retur !!"));
			
			redirect( 'tcetakulang',301);
					
			
			
		
	}

	function cetakulang($id)
	{
		$a = $this->db->query("SELECT no_spat,a.kode_blok,tgl_spta,c.divisi,e.`karyawan`,d.`nama_petani`,f.`name` AS nama_pta,tgl_expired,jenis_spta,tebang_pg,angkut_pg,metode_tma,IF(kode_plant_trasnfer!='',CONCAT(c.`deskripsi_blok`,' TRANSFER DARI ',kode_plant_trasnfer),IF(kode_plant_ke != '', CONCAT(c.`deskripsi_blok`,' TRANSFER KE ',kode_plant_ke),c.`deskripsi_blok`)) AS deskripsi_blok,c.`luas_tanam`,c.`periode`,c.`status_blok`,c.`kepemilikan`,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,v.nama_vendor,a.spt_status,a.natura_status, c.others
        FROM t_spta a 
INNER JOIN sap_field c ON a.kode_blok=c.`kode_blok` 
INNER JOIN vw_master_afdeling e ON e.`kode_affd`=c.`divisi`
INNER JOIN sap_m_karyawan f ON f.`Persno`=a.persno_pta
LEFT JOIN sap_petani d ON d.`id_petani_sap`=c.`id_petani_sap`
LEFT JOIN m_vendor v ON v.id_vendor=a.`vendor_angkut`
 WHERE a.id='$id' GROUP BY a.`id`")->result();
		$html = '';$i=1; $tgl = '';
		foreach($a as $b){
			$this->data['row'] =$b; 
			$html .= $this->load->view('tcetakulang/cetakulang',$this->data, true);
			if($i == 1){
			$i=0;
				$html .= '<div class="pagebreak"> </div>';
			}
			$i++;
		}
		
		$this->data['content'] = $html;
		$this->data['title'] = 'Cetak Ulang SPTA';
		//$this->data['tgl'] = $tgl;
		$this->load->view('layouts/kosongCetakulang', $this->data );
	}


	function printlist(){
		$a = $_REQUEST['tgl'];
		$b = $_REQUEST['afd'];
		$c = $_REQUEST['jenis'];
		$wh = '';
		if($a != '') $wh .= " AND tgl_spta = '$a'";
		if($b != '') $wh .= " AND c.divisi = '$b'";

		$sql = $this->db->query("SELECT no_spat,a.kode_blok,tgl_spta,c.divisi,e.`karyawan`,d.`nama_petani`,f.`name` AS nama_pta,tgl_expired,jenis_spta,tebang_pg,angkut_pg,metode_tma,IF(kode_plant_trasnfer!='',CONCAT(c.`deskripsi_blok`,' TRANSFER DARI ',kode_plant_trasnfer),IF(kode_plant_ke != '', CONCAT(c.`deskripsi_blok`,' TRANSFER KE ',kode_plant_ke),c.`deskripsi_blok`)) AS deskripsi_blok,c.`luas_tanam`,c.`periode`,c.`status_blok`,c.`kepemilikan`,kode_kat_lahan, IF(CONCAT(tebang_pg,angkut_pg) = '11','TAPG',IF(CONCAT(tebang_pg,angkut_pg) = '10','TPGAS',IF(CONCAT(tebang_pg,angkut_pg)='01','TSAPG','TAS'))) AS stt_ta_text,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,v.nama_vendor FROM t_spta a 
INNER JOIN sap_field c ON a.kode_blok=c.`kode_blok` 
INNER JOIN vw_master_afdeling e ON e.`kode_affd`=c.`divisi`
INNER JOIN sap_m_karyawan f ON f.`Persno`=a.persno_pta
LEFT JOIN sap_petani d ON d.`id_petani_sap`=c.`id_petani_sap`
LEFT JOIN m_vendor v ON v.id_vendor=a.`vendor_angkut`
 WHERE 0=0 $wh GROUP BY a.`id` ORDER BY c.divisi")->result();


        $this->data['result'] = $sql;

		$this->data['title'] =  "TANGGAL ".SiteHelpers::datereport($a);
       // $this->load->view('tcetakulang/cetaklist',$this->data);

		if($c == 1){
	        $this->data['content'] = $this->load->view('tcetakulang/cetaklist',$this->data, true);
			$this->data['title'] = 'Cetak List SPTA';
			//$this->data['tgl'] = $tgl;
			$this->load->view('layouts/kosongCetakulang', $this->data );
		}else{
			$file = "List SPTA  - TGL ".SiteHelpers::datereport($a).".xls";
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=$file");

                echo $this->load->view('tcetakulang/cetaklist',$this->data, true);
		}

	}


}
