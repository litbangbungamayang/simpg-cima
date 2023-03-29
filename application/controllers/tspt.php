<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tspt extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tspt';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tsptmodel');
		$this->model = $this->tsptmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tspt',
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
		$results = $this->model->getRowspdx( $params );
		//var_dump($results);die();
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
            if($dt->no_surat != ''){
            	$btn .= '<a href="'.site_url('tspt/show/'.$dt->kode_blok).'" target="_blank" class="tips "  title="Cetak SPT"><i class="fa  fa-print"></i>  </a> &nbsp;&nbsp;';
            }
            if($dt->no_surat == '' && $this->access['is_edit'] ==1){
            	$btn .= '<a href="javascript:getformspt(\''.$dt->kode_blok.'\')" class="tips "  title="Isi Hasil Analisa"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
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
		
		$this->data['content'] = $this->load->view('tspt/index',$this->data, true );
		
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
			//$this->data['row'] =  $row;
			$this->data['row'] = $this->db->query("SELECT a.*,b.`deskripsi_blok`,b.`kode_varietas`,b.`kepemilikan`,b.`luas_ha`,d.`name` FROM `sap_field_spt` a 
INNER JOIN `sap_field` b ON a.`no_petak`=b.`kode_blok`
INNER JOIN `sap_m_affdeling` c ON c.`kode_affd`=b.`divisi`
INNER JOIN `sap_m_karyawan` d ON d.`Persno`=c.`Persno` WHERE a.no_petak='$id'")->row_array();
		} else {
			$this->data['row'] = $this->model->getColumnTable('sap_field_spt'); 
		}
		
		$this->data['id'] = $id;
		echo $this->data['content'] =  $this->load->view('tspt/view', $this->data ,true);	  
		//$this->load->view('layouts/main',$this->data);
	}
  
	function add( $id = null ) 
	{
		

		$row = $this->model->getRow( $id );
		if($row)
		{
			$this->data['row'] =  $row;
		} else {

			$this->data['row'] = $this->model->getColumnTable('sap_field_spt'); 
			$this->data['row']['no_petak'] = $id;
		}
	
		$this->data['id'] = $id;
		echo $this->data['content'] = $this->load->view('tspt/form',$this->data, true );		
	  	
	
	}

	function getnosurat(){

	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$a = $this->db->query("SELECT LPAD(IFNULL(MAX(LEFT(no_surat,5))+1,1),5,'0') AS nosurat FROM `sap_field_spt` ")->row();
			$data['user_act'] =$this->session->userdata('fid');
			$data['tgl_act'] =date('Y-m-d H:i:s');
			$data['status'] =1;
			$data['no_surat'] =$a->nosurat.'/TMA/SPT/'.CNF_TAHUNGILING;

			$ID = $this->model->insertRow($data , '');
			// Input logs
			if( $this->input->get( 'no_petak' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tspt/add/'.$ID,301);
			} else {
				redirect( 'tspt',301);
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
