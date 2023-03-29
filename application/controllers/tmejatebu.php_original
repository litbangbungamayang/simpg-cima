<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tmejatebu extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tmejatebu';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tmejatebumodel');
		$this->model = $this->tmejatebumodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tmejatebu',
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
		if(!$this->session->userdata('gilingan')) redirect('dashboard',301);
		
	}

	function grids(){
		
		$sort = 'tgl_meja_tebu'; 
		$order = 'DESC';
		$filter = " AND gilingan = '".$this->session->userdata('gilingan')."'";
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
		$filx ='';
        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filx .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filx .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }
		
		if($filx != '') $filx .= ')';
		$filter = $filter.$filx;

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
					if($field == 'no_spat'){
						$row[] = '<span style="padding:10px;background:'.$dt->warna_meja_tebu.'"><b>'.$dt->$field.'</b></span>';
					}else{
						$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
						$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            
           
 			//$row[] = $btn;
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
		
		$this->data['hargil'] 			= $this->db->query('SELECT get_hari_giling() as hargil')->row();
		
		$fd = $this->db->query("SELECT * FROM m_mejatebu WHERE parent='".$this->session->userdata('gilingan')."' ORDER BY kode")->result();
		
		$this->data['content'] = '';
		
		$rx = 0;
		foreach($fd as $r){
			$rx++;
			$this->data['kode_meja_tebu'] = $r->kode;
			$this->data['warna_meja_tebu'] = $r->warna;
			$this->data['cctv_on'] = $r->cctv_on;
			$this->data['cctv_url'] = $r->cctv_url;
			$this->data['content'] .= $this->load->view('tmejatebu/form',$this->data, true );
		}

		if($rx > 1){
			$rx = 12;
		}else{
			$rx = 8;
		}
		
		$this->data['col'] = $rx;
		$this->data['content'] .= $this->load->view('tmejatebu/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('t_meja_tebu'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tmejatebu/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_meja_tebu'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tmejatebu/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data['ptgs_meja_tebu'] = $this->session->userdata('fid');
			$data['tgl_meja_tebu']  = date('Y-m-d H:i:s');
			$data['rafraksi_aktif']  = CNF_RAFAKSI;
			
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_mejatebu' , true ));

			if($data['kondisi_tebu'] == CNF_MUTU_TERBAKAR){
				$s = $this->db->query('UPDATE t_selektor SET terbakar_sel = 1 WHERE id_spta="'.$data['id_spta'].'"');
			}
			
			$this->db->query('UPDATE t_spta SET rfid_sticker_status = 2 WHERE id ="'.$data['id_spta'].'"');
			
			$this->db->select('*');
			$this->db->where('id', $data['id_spta']);
			$rfid_result = $this->db->get('t_spta')->row();
			
			if($rfid_result->rfid_sticker != ""){
			$qry_rfid =$this->db->query('UPDATE m_truk_gps SET status = 0 WHERE rfid_sticker="'.$rfid_result->rfid_sticker.'"');	
			}
			 
			
			// Input logs
			if( $this->input->get( 'id_mejatebu' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tmejatebu/add/'.$ID,301);
			} else {
				redirect( 'tmejatebu',301);
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
	
	function cekspta(){
		$arr['stt'] = 0;
		if(isset($_POST['nospta'])){
			
			$cek = $this->db->query("SELECT a.id,kode_blok,IFNULL(b.no_transloading,'-') as no_trans,kode_kat_lahan,kode_affd,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,
IF(meja_tebu_status = 1,CONCAT('SPTA sudah Masuk Meja Tebu Pada ',DATE_FORMAT(meja_tebu_tgl,'%d %M %Y Jam %H:%i')),'0') AS ed,
IF(timb_bruto_status=0,'SPTA Belum Masuk Timbangan',IF(timb_netto_status=0,'Truk belum timbang netto!',1)) AS stt,c.terbakar_sel,
metode_tma FROM t_spta a 
LEFT JOIN t_selektor c ON c.id_spta=a.id
LEFT JOIN t_timbangan b on b.id_spat=a.id WHERE no_spat = '".$_POST['nospta']."'")->row();
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
