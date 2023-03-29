<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tselektor extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tselektor';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tselektormodel');
		$this->model = $this->tselektormodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tselektor',
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

	function grids(){
		
		$sort = 'tgl_selektor'; 
		$order = 'desc';
		$filter = " AND ptgs_selektor ='".$this->session->userdata('fid')."'";
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

        $flt = '';
        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$flt .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$flt .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

        if($flt != '') $flt .= ')';
        $filter .= $flt;

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
            //$row[] = $dt->tgl_selektor;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
					if($field == 'terbakar_sel'  || $field == 'ditolak_sel'){
						$row[] = SiteHelpers::statustxt($dt->$field);
					}else{
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '&nbsp;&nbsp;<a href='.site_url('tselektor/cetak/'.$dt->$idku).' target="_blank"  class="tips "  title="view"><i class="fa  fa-print"></i>  Struk</a> &nbsp;&nbsp;';
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

		if(CNF_RFIDSELEKTOR == 2){
			$this->data['content'] = $this->load->view('tselektor/formrfid',$this->data, true );
		}else{
			$this->data['content'] = $this->load->view('tselektor/form',$this->data, true );
		}
		
		
		$this->data['content'] .= $this->load->view('tselektor/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('t_selektor'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tselektor/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
  
	
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data['tgl_selektor'] = date('Y-m-d H:i:s');
			$data['no_angkutan'] =  strtoupper($data['no_angkutan']);
			$data['ptgs_angkutan'] = strtoupper($data['ptgs_angkutan']);
			$data['tgl_tebang'] = $_POST['tgl_tebang'].' '.$_POST['jam_tebang'].':00';
			$data['ptgs_selektor'] = $this->session->userdata('fid');
			
			// var_dump($data);die();
			
			$rx = $this->db->query('SELECT IFNULL(MAX(no_urut),0)+1 AS nourut,get_tgl_giling() AS tgl FROM t_selektor WHERE tgl_urut = get_tgl_giling() AND ptgs_selektor="'.$data['ptgs_selektor'].'"')->row();
			$data['no_urut'] = $rx->nourut;
			$data['tgl_urut'] = $rx->tgl;
			
			
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_selektor' , true ));
			
			// Input logs
			if( $this->input->get( 'id_selektor' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			$this->session->set_flashdata('idselektor', $ID);
			$this->session->set_flashdata('no_trainstat', $_POST['no_trainstat']);
			redirect( 'tselektor',301);
						
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}
	
	function cekspta(){
		$arr['stt'] = 0;
		if(isset($_POST['nospta'])){
			$cek = $this->db->query("SELECT id,kode_blok,jenis_spta,
				IF( tebang_pg = 0 AND angkut_pg = 0,'TAS',
IF( tebang_pg = 1 AND angkut_pg = 0,'TPGAS',
IF( tebang_pg = 0 AND angkut_pg = 1,'TSAPG',
IF( tebang_pg = 1 AND angkut_pg = 1,'TAPG','')))) AS kat_spta,kode_kat_lahan,kode_affd,CONCAT(tgl_spta,' 00:00:00') AS tgl_spta,tgl_expired,
IF(NOW() < CONCAT(tgl_spta,' 05:59:00'),CONCAT('SPTA Belum Berlaku, Berlaku pada ',DATE_FORMAT(tgl_spta,'%d %M %Y'),' 06:00:00'),'1') AS berlaku,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,
IF(NOW() > tgl_expired,CONCAT('SPTA sudah Expired Pada ',DATE_FORMAT(tgl_expired,'%d %M %Y Jam %H:%i')),'0') AS ed,
IF(selektor_status=0,if(retur_status=1,'SPTA Sudah di retur!',0),CONCAT('SPTA sudah Masuk Selektor Pada ',DATE_FORMAT(selektor_tgl,'%d %M %Y Jam %H:%i'))) AS stt,
metode_tma FROM t_spta WHERE no_spat = '".$_POST['nospta']."'")->row();
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$arr['data'] = $cek;
		}else{
			$arr['stt'] = 0;
		}
		
		}
		echo json_encode($arr);
	}


	function cektara(){
		$arr['stt'] = 0;
		if(isset($_POST['noreg'])){
			$cek = $this->db->query("SELECT no_pol,kategori,CONCAT(nama_supir,' ',no_pol,' ',tara,' Kg',' (',kategori,')') AS texts FROM `m_tara_truk`  WHERE no_pol = '".$_POST['noreg']."'")->row();
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$arr['data'] = $cek;
		}else{
			$arr['stt'] = 0;
		}
		
		}
		echo json_encode($arr);
	}

	function cektruk(){
		$arr['stt'] = 0;
		if(isset($_POST['notruk'])){
			$cek = $this->db->query("SELECT a.no_angkutan, b.no_spat FROM t_selektor a LEFT JOIN t_spta b ON a.id_spta = b.id WHERE no_angkutan = '".$_POST['notruk']."' AND a.tgl_selektor BETWEEN CONCAT(DATE(NOW()),' 06:00:00') AND CONCAT(DATE_ADD(DATE(NOW()), INTERVAL +1 DAY),' 05:59:00')")->row();
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$arr['data'] = $cek;
		}else{
			$arr['stt'] = 0;
		}
		
		}
		echo json_encode($arr);
	}
	
	
	function cetak($id){
		$this->data['row'] = $this->db->query("SELECT no_spat,no_angkutan,ptgs_angkutan,no_urut,tgl_selektor FROM t_selektor a INNER JOIN t_spta b ON a.id_spta=b.id WHERE a.id_selektor=$id GROUP BY b.id")->row();
		echo $this->data['content'] =  $this->load->view('tselektor/view', $this->data ,true);	  
		
	}

	function cekdatarfid(){
		$arr['stt'] = 0;
		if(isset($_POST['rfid'])){
			$cek = $this->db->query("SELECT * FROM vw_spta_digital WHERE rfid_sticker = '".$_POST['rfid']."'")->row();
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$arr['data'] = $cek;
		}else{
			$arr['stt'] = 0;
		}
		
		}
		echo json_encode($arr);
	}
	

	


}
