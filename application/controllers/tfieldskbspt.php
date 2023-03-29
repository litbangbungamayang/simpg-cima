<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tfieldskbspt extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tfieldskbspt';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tfieldskbsptmodel');
		$this->model = $this->tfieldskbsptmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tfieldskbspt',
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
            	$btn .= '<a href='.site_url('tfieldskbspt/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('tfieldskbspt/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	//$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tfieldskbspt/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('tfieldskbspt/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('t_field_skb_spt'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tfieldskbspt/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_field_skb_spt'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tfieldskbspt/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_field_skb' , true ));
			// Input logs
			if( $this->input->get( 'id_field_skb' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tfieldskbspt/add/'.$ID,301);
			} else {
				redirect( 'tfieldskbspt',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function simpanskbspt()
    {


        $rules = array(
            array(
                'field' => 'id_field_skb',
                'label' => 'id_field_skb',
                'rules' => 'required'
            ),array(
                'field' => 'id_spta',
                'label' => 'id_spta',
                'rules' => 'required'
            ),array(
                'field' => 'no_spta',
                'label' => 'no_spta',
                'rules' => 'required'
            ),array(
                'field' => 'kode_blok_awal',
                'label' => 'kode_blok_awal',
                'rules' => 'required'
            ),array(
                'field' => 'kode_blok_perubahan',
                'label' => 'kode_blok_perubahan',
                'rules' => 'required'
            ),


        );

        $this->form_validation->set_rules( $rules );
        if( $this->form_validation->run() )
        {

            $id_field_skb = $this->input->post('id_field_skb');
            $id_spta = $this->input->post('id_spta');
            $no_spta = $this->input->post('no_spta');
            $kode_blok_awal = $this->input->post('kode_blok_awal');
            $kode_blok_perubahan = $this->input->post('kode_blok_perubahan');
            $id_petani_sap = $this->input->post('id_petani_sap');
            $kepemilikan = $this->input->post('kategori_spta');
            $kode_affd_perubahan = $this->input->post('kode_affd_perubahan');

            $data = array(
                'id_field_skb' => $id_field_skb,
                'id_spta' => $id_spta,
                'no_spat' => $no_spta,
                'kode_blok_awal' => $kode_blok_awal,
                'kode_blok_perubahan' => $kode_blok_perubahan,
                'id_petani_sap' => $id_petani_sap,
                'kode_kat_lahan' => $kepemilikan,
                'kode_affd_perubahan' => $kode_affd_perubahan

            );

            $cek_spta = "SELECT count(id_spta) as jumlah from t_skbspt where no_spat = '$no_spta'";
            $cek_result = $this->db->query($cek_spta)->row();
            if($cek_result->jumlah == 0){
                $this->db->insert('t_skbspt', $data);
                if( $this->input->get( 'id_field_skb' , true ) =='')
                {
                    $this->inputLogs("No SPTA : $no_spta  , Berhasil di daftarkan");
                }
                // Redirect after save
                $this->session->set_flashdata('message',SiteHelpers::alert('success'," Data $no_spta has been saved succesfuly !"));
                redirect( 'tfieldskbspt/show/'.$id_field_skb,301);
            }else{
                $data =	array(
                    'message'	=> 'Ops , SPTA '. $no_spta .' Sudah Terdaftar',
                    'errors'	=> validation_errors('<li>', '</li>')
                );
                $this->displayError($data);
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

	function sptaterdaftar($id = null)
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
            $this->data['row'] = $this->model->getColumnTable('t_field_skb_spt');
        }

        $info = $this->model->makeInfo('listskbspt');
        $this->data['tableGrid'] 	= $info['config']['grid'];

        $this->data['id'] = $id;
        $this->data['content'] =  $this->load->view('tfieldskbspt/view_terdaftar', $this->data ,true);
        $this->load->view('layouts/main',$this->data);
    }

    function sptatidaksesuai($id = null)
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
            $this->data['row'] = $this->model->getColumnTable('t_field_skb_spt');
        }

        $info = $this->model->makeInfo('listskbspt');
        $this->data['tableGrid'] 	= $info['config']['grid'];

        $this->data['id'] = $id;
        $this->data['content'] =  $this->load->view('tfieldskbspt/view_ditolak', $this->data ,true);
        $this->load->view('layouts/main',$this->data);
    }

    function sptadisetujui($id = null)
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
            $this->data['row'] = $this->model->getColumnTable('t_field_skb_spt');
        }

        $info = $this->model->makeInfo('listskbspt');
        $this->data['tableGrid'] 	= $info['config']['grid'];

        $this->data['id'] = $id;
        $this->data['content'] =  $this->load->view('tfieldskbspt/view_disetujui', $this->data ,true);
        $this->load->view('layouts/main',$this->data);
    }




    function jsonfield($kode_blok)
    {
        $qry = "select a.kode_blok, a.deskripsi_blok, a.divisi, a.kepemilikan from sap_field as a 
                where a.kode_blok = '$kode_blok'";

        $result = $this->db->query($qry)->row();

        $arr['stt'] = 1;
        if($result){
            $arr['stt'] = 1;
            $arr['data'] = $result;
        }else{
            $arr['stt'] = 0;
        }
        echo json_encode($arr);
    }

    function jsonspat()
    {
        $no_spta = $this->GetPost('nospta');
        $qry = "select a.id, a.no_spat, b.kode_blok, b.kepemilikan, 
        c.nama_petani, a.id_petani_sap b.deskripsi_blok,
        if(a.tebang_pg = 1, if(a.angkut_pg = 1, 'TAPG', 'TPGAS'), 
        if(a.tebang_pg = 0, if(a.angkut_pg = 1, 'TSAPG', 'TAS'), '')) as angkutan
        FROM
          t_spta AS a 
          LEFT JOIN sap_petani AS c 
            ON c.id_petani_sap = a.id_petani_sap 
          JOIN sap_field AS b 
            ON b.kode_blok = a.kode_blok 
        WHERE a.no_spat = '$no_spta' AND a.sbh_status = 0 ";
        $result = $this->db->query($qry)->row();

        $arr['stt'] = 1;
        if($result){
            $arr['stt'] = 1;
            $arr['data'] = $result;
        }else{
            $arr['stt'] = 0;
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

}
