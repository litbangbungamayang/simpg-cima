<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mpetanipetak extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'mpetanipetak';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('mpetanipetakmodel');
		$this->model = $this->mpetanipetakmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'mpetanipetak',
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
		
		$sort = $this->model->primaryKey; 
		$order = 'asc';
		$filter = "";
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

        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

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
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('mpetanipetak/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('mpetanipetak/addform/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==4){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('mpetanipetak/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('mpetanipetak/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('sap_petani'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('mpetanipetak/form', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}


	function addform($id = null){
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		$row = $this->model->getRow( $id );
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('sap_petani'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('mpetanipetak/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	}


	function addupload(){
		//if($id =='')
		if($this->access['is_add'] ==0) redirect('dashboard',301);

		$this->data['content'] = $this->load->view('mpetanipetak/formupload',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	}


	function upload(){
		include APPPATH."/third_party/PHPExcel/IOFactory.php";
		try {
		$objPHPExcel = PHPExcel_IOFactory::load($_FILES['petani_petak']['tmp_name']);
		} catch(ErrorException $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			exit();
		}

		$ix = 0;
		$num=$objPHPExcel->getSheetCount() ;
		for($r=0;$r<$num;$r++){
	    	$objPHPExcel->setActiveSheetIndex($r);
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
			//var_dump($allDataInSheet);die();
			$totupload  = 0;
			$totdecline = 0;
			$tmpidsap = "";
			for($i=2;$i<=$arrayCount;$i++){
				if($allDataInSheet[$i]["A"] != ''){
				$tempdata = array(
					'id_petani_sap' 			=> trim($allDataInSheet[$i]["A"]), 
					'nama_petani' 				=> trim($allDataInSheet[$i]["C"]), 
					'no_ktp' 					=> trim($allDataInSheet[$i]["I"]), 
					'alamat_petani' 			=> trim($allDataInSheet[$i]["H"]), 
					'kota_petani' 				=> trim($allDataInSheet[$i]["E"]), 
					'reconciliation_account' 	=> trim($allDataInSheet[$i]["G"]), 
					'region' 					=> trim($allDataInSheet[$i]["F"]),
					'kode_kelompok' 			=> trim($allDataInSheet[$i]["J"]),
				);
				//var_dump($tempdata);
				$ID = $this->model->insertRowUpdate($tempdata , trim($allDataInSheet[$i]["A"]));
				$totupload++;
			}
			}
		}

		$this->inputLogs(" Upload data master Petani oleh ".$this->session->userdata('fid').' dengan data '.$totupload.' Berhasil');
			
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Upload data master Petani oleh ".$this->session->userdata('fid').' dengan data '.$totupload.' Berhasil'));
			
			redirect( 'mpetanipetak',301);
	}
  
	function add( $id = null ) 
	{
		/*
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		//ambil data petani di petak 
		$dsn1 = 'mysqli://root:master123456@10.20.1.13/simpg_master';
		$this->db1 = $this->load->database($dsn1, true);
		$ax = $this->db1->query("SELECT b.Customer,nama,external_bp,Street,City,recon_att,b.DGroup FROM sap_field a
INNER JOIN sap_m_petani b ON a.`id_petani_sap`=b.Customer
 WHERE id_petani_sap != '' AND a.kode_plant='".CNF_PLANCODE."' GROUP BY id_petani_sap")->result();
		$totdata = 0;
		foreach($ax as $ab){
			$tempdata = array(
				'id_petani_sap' => $ab->Customer,
				'nama_petani' => $ab->nama,
				'no_ktp' => $ab->external_bp,
				'alamat_petani' => $ab->Street,
				'kota_petani' => $ab->City,
				'reconciliation_account' => $ab->recon_att,
				'region' => $ab->DGroup
			);
			$ID = $this->model->insertRowUpdate($tempdata , $ab->Customer);
			$totdata++;
			
		}
	
	$this->inputLogs(" sinkronisasi data petani oleh ".$this->session->userdata('fid').' dengan data '.$totdata.' Berhasil');
			
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," sinkronisasi data petani oleh ".$this->session->userdata('fid').' dengan data '.$totdata.' Berhasil'));
			*/
			
			redirect( 'mpetanipetak',301);
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			// Input logs
			if( $this->input->get( 'id_petani' , true ) =='')
			{
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_petani_sap' , true ));
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {

			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_petani_sap' , true ));
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'mpetanipetak/addform/'.$ID,301);
			} else {
				redirect( 'mpetanipetak',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function cleansingdata()
	{
		$data = $this->db->query('SELECT * FROM sap_petani WHERE id_petani_sap = ""')->result();
		foreach ($data as $value) {
			$this->db->query('delete from sap_petani where id_petani = '.$value->id_petani);
		}
		// print_r($data);
		echo "Cleansing Sukses";
	}

	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{ 
			echo "err : maaf anda tidak memiliki hak untuk menghapus data";
	  	}
			
		$this->model->destroy($_POST['id']);
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}


}
