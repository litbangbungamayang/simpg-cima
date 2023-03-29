<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tdetailkuotakkw extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tdetailkuotakkw';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tdetailkuotakkwmodel');
		$this->model = $this->tdetailkuotakkwmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tdetailkuotakkw',
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
		//if($_REQUEST['idkuotakkw'] != '0') $filter = ' AND kepemilikan="'.$_REQUEST['kategori'].'"';
		
		
        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }
		if($filter != '') $filter .= ')';
		if($_REQUEST['afd'] != '') $filter .= ' AND divisi="'.$_REQUEST['afd'].'"';
		if($_REQUEST['period'] != '') $filter .= ' AND periode="'.$_REQUEST['period'].'"';
		if($_REQUEST['kategori'] != '')  $filter .= ' AND kepemilikan="'.$_REQUEST['kategori'].'"';

		$params = array(
			'limit'		=> $_POST['start'],
			'page'		=> $_POST['length'],
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRowspdx( $params , $_REQUEST['idkuotakkw']);
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
            if($dt->aff_tebang == 0){
            	$btn .= '<a href="javascript:formOrder(\''.$dt->idkuotakkw.'\',\''.$dt->kode_blok.'\')"  class="tips "  title="Order SPTA"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;'; 
            	if($dt->kuota_spta > 0){
            	$btn .= '<a href="javascript:cetaksptaperpetak(\''.$dt->kode_blok.'\')"  class="tips "  title="Cetak SPTA Per Petak"><i class="fa  fa-print"></i>  </a> &nbsp;&nbsp;'; 
            	}
            }else{
            	$btn .= "Sudah Aff";
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
		
		$this->data['content'] = $this->load->view('tdetailkuotakkw/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('sap_field'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tdetailkuotakkw/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
  
	function add( $id = null ) 
	{
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		$row = $this->model->getRow( $id );
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('sap_field'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tdetailkuotakkw/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_field' , true ));
			// Input logs
			if( $this->input->get( 'id_field' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tdetailkuotakkw/add/'.$ID,301);
			} else {
				redirect( 'tdetailkuotakkw',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
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
