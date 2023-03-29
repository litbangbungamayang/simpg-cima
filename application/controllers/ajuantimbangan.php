<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajuantimbangan extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'ajuantimbangan';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('ajuantimbanganmodel');
		$this->model = $this->ajuantimbanganmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'ajuantimbangan',
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
            	$btn .= '<a href='.site_url('ajuantimbangan/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('ajuantimbangan/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('ajuantimbangan/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('ajuantimbangan/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('t_ubah_timbangan'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('ajuantimbangan/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_ubah_timbangan'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('ajuantimbangan/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_ubah_timbangan' , true ));
			// Input logs
			if( $this->input->get( 'id_ubah_timbangan' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'ajuantimbangan/add/'.$ID,301);
			} else {
				redirect( 'ajuantimbangan',301);
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

	function adminvalidasi($id)
    {
        if($this->access['is_remove'] ==0)
        {
            $this->session->set_flashdata('error',SiteHelpers::alert('error','Anda tidak berhak merubah data'));
            redirect('dashboard',301);
        }

        $qry = "SELECT * FROM t_ubah_timbangan WHERE id_ubah_timbangan = '$id'";
        $result = $this->db->query($qry)->row();

        if($result->status_validasi == '0'){
            $this->db->where(array('id_spat' => $result->id_spat));
            $this->db->update('t_timbangan',array(
                'bruto' => $result->bruto_perubahan,
                'tara' => $result->tara_perubahan,
                'netto' => $result->netto_perubahan,
                'netto_final' => $result->netto_perubahan
            ));

            $this->db->where(array('id_ubah_timbangan' => $id));
            $this->db->update('t_ubah_timbangan', array(
                'status_validasi' => 1,
                'tgl_validasi' => $this->getDateNow()
            ));

            $this->session->set_flashdata('message',SiteHelpers::alert('success','Data no SPTA '.$result->no_spat.' Telah dirubah'));
            redirect('ajuantimbangan',301);
        }else{
            $this->session->set_flashdata('error',SiteHelpers::alert('error','Data no SPTA '.$result->no_spat.' Telah divalidasi'));
            redirect('ajuantimbangan',301);
        }

    }

    function cekspta(){
        $arr['stt'] = 0;
        if($this->GetPost('nospta') != ""){
            $cek = $this->db->query("SELECT 
                                  a.id,
                                  a.no_spat,
                                  a.kode_blok,
                                  a.jenis_spta,  
                                  a.metode_tma,
                                  b.`bruto`,
                                  b.`tara`,
                                  b.`netto`,
                                  b.`netto_final`,
                                  c.`no_angkutan`,
                                  c.`ptgs_angkutan`,
                                  a.`kode_kat_lahan`,
                                  a.`id_petani_sap`,
                                  e.`nama`  
                                FROM
                                  t_spta AS a
                                 INNER JOIN t_timbangan AS b ON b.`id_spat` = a.id
                                 INNER JOIN t_selektor AS c ON c.`id_spta` = a.id
                                 LEFT JOIN sap_m_petani AS e ON e.`Customer` = a.`id_petani_sap`
                                  WHERE  a.`timb_netto_status` = 1 AND a.`sbh_status` = 0 AND 
                                  a.upah_tebang_status = 0 AND a.upah_angkut_status = 0 AND
                                  no_spat = '".$this->GetPost('nospta')."'")->row();
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

    private function GetPost($input){
        if($this->input->get($input)){
            $output = $this->input->get($input);
        }elseif($this->input->post($input)){
            $output = $this->input->post($input);
        }else{
            $output = "";
        }
        return $output;
    }

    private function getDateNow()
    {
        $sql = "SELECT NOW() as sekarang";
        $query = $this->db->query($sql);
        $sekarang = $query->row();
        return $sekarang->sekarang;
    }
}
