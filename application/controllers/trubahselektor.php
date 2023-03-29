<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trubahselektor extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'trubahselektor';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('trubahselektormodel');
		$this->model = $this->trubahselektormodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'trubahselektor',
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
        	$arstatustx = array("1"=>"Buat","2"=>"Disetujui");
    	//var_dump($rows);
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		if($field == 'status'){
            			$row[] = $arstatustx[$dt->status];
            		}else{
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('trubahselektor/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1   && $dt->status == 1){
            	$btn .= '<a href='.site_url('trubahselektor/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1   && $dt->status == 1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('trubahselektor/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('trubahselektor/index',$this->data, true );
		
    	//var_dump($this->info);
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
			$this->data['row'] = $this->model->getColumnTable('t_ubah_selektor'); 
		}
    	//var_dump($row);
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('trubahselektor/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_ubah_selektor'); 
			$d = $this->db->query("SELECT IFNULL(MAX(RIGHT(no_ba,4))+1,1) as nilaimax FROM `t_ubah_selektor`")->row();
			$this->data['row']['no_ba'] = "BA/SIMPG-SEL/".CNF_PLANCODE."/".date('Y')."/".str_pad($d->nilaimax,4,'0',STR_PAD_LEFT);
		}
		//var_dump($this->data['row']);
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('trubahselektor/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();
		//var_dump($this->validateForm());
		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			if($data['id'] == ''){
				$data['status'] = 1;
				$data['tgl_create'] = date('Y-m-d H:i:s');
				$data['user_create'] = $this->session->userdata('fid');
				$data['alasan'] = $_POST['alasan'];
            	var_dump($data);
			}

			$usr = $this->session->userdata('fid');
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("BA No ".$_POST['no_ba']." Sudah Dibuat Oleh ".$usr);
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success',"Data perubahan berhasil disimpan!"));
        	
			if($this->input->post('apply'))
			{
				redirect( 'trubahselektor/add/'.$ID,301);
			} else {
				redirect( 'trubahselektor',301);
			}
            
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}


	function setujui($id){
		$a = $this->model->getRow( $id );
		$ax = "UPDATE t_selektor SET terbakar_sel='".$a['r_terbakar_sel']."',ditolak_sel='".$a['r_ditolak_sel']."',brix_sel='".$a['r_brix_sel']."',no_trainstat='".$a['r_trainstat']."',ph_sel='".$a['r_ph_sel']."',persno_mandor_tma='".$a['r_perno_mandor']."' WHERE id_spta='".$a['id_spta']."'";
		if($a['r_ditolak_sel'] == 1){
            $ab = "UPDATE t_spta SET selektor_status = 2 WHERE id = ".$a['id_spta'];
            $this->db->query($ab);
        }

		//var_dump($ax);die();
		$ax1 = $this->db->query($ax);
		$usr = $this->session->userdata('fid');
		$b = $this->db->query("UPDATE t_ubah_selektor SET status='2',tgl_approve=NOW(),user_approve='$usr' WHERE id=$id");
		$this->inputLogs("BA No ".$a->no_ba." Sudah Disetujui Oleh ".$usr);
		$this->session->set_flashdata('message',SiteHelpers::alert('success'," BA Berhasil di Approve !"));
			
		redirect( 'trubahselektor/show/'.$id,301);
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

	function cekspta(){
		$arr['stt'] = 0;
		if(isset($_POST['nospta'])){
			$cek = $this->db->query("SELECT a.id,persno_mandor_tma,b.no_trainstat,ditolak_sel,brix_sel,ph_sel,
            timb_bruto_status, terbakar_sel FROM t_spta a INNER JOIN t_selektor b on a.id=b.id_spta WHERE no_spat = '".$_POST['nospta']."' AND a.`upah_tebang_status`= 0")->row();
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
