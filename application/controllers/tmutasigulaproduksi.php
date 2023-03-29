<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tmutasigulaproduksi extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tmutasigulaproduksi';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tmutasigulaproduksimodel');
		$this->model = $this->tmutasigulaproduksimodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tmutasigulaproduksi',
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
            	$btn .= '<a href='.site_url('tmutasigulaproduksi/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('tmutasigulaproduksi/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tmutasigulaproduksi/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('tmutasigulaproduksi/index',$this->data, true );
		
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
			$this->data['detail'] =  $this->db->query("SELECT b.*,a.id as id_mj,a.jenis_produksi as nm_jenis,IFNULL(tahun_produksi,YEAR(NOW())) as thn_prd FROM m_jenis_produksi a LEFT JOIN (SELECT * FROM `t_mutasi_produksi_gula_detail` WHERE id_mutasi_produksi = '".$row['id']."')  b ON a.`id`=b.`jenis_produksi` ORDER BY a.kode")->result();
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_mutasi_produksi_gula'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tmutasigulaproduksi/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}

	function cetak( $id = null) 
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
			$this->data['detail'] =  $this->db->query("SELECT b.*,a.id as id_mj,a.jenis_produksi as nm_jenis,IFNULL(tahun_produksi,YEAR(NOW())) as thn_prd FROM m_jenis_produksi a LEFT JOIN (SELECT * FROM `t_mutasi_produksi_gula_detail` WHERE id_mutasi_produksi = '".$row['id']."')  b ON a.`id`=b.`jenis_produksi` ORDER BY a.kode")->result();
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_mutasi_produksi_gula'); 
		}
		
		$this->data['id'] = $id;
		echo $this->data['content'] =  $this->load->view('tmutasigulaproduksi/cetak', $this->data ,true);	  
		//$this->load->view('layouts/kosongcetakqr',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('t_mutasi_produksi_gula'); 
			$d = $this->db->query("SELECT IFNULL(MAX(RIGHT(no_berita_acara,4))+1,1) as nilaimax FROM `t_mutasi_produksi_gula`")->row();
			$this->data['row']['no_berita_acara'] = "BA/MTS-PRD/".CNF_PLANCODE."/".date('Y')."/".str_pad($d->nilaimax,4,'0',STR_PAD_LEFT);
			$this->data['row']['company_plant'] = CNF_COMPANYCODE;
			$this->data['row']['code_plant'] = CNF_PLANCODE;
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tmutasigulaproduksi/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		//var_dump($_POST);die();
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data['tanggal_jam_ba'] = $_POST['tanggal_ba'].' '.$_POST['jam_ba'].':00';
			$data['tgl_act'] = date('Y-m-d H:i:s');
			$data['user_act'] = $this->session->userdata('fid');

			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			foreach ($_POST['jenis_produksi'] as $in => $val) {
				if($val!=''){
					$dat = array( 
						'id_mutasi_produksi'=>$ID,
						'jenis_produksi'=>$_POST['jenis_produksi'][$in],
						'tahun_produksi'=>$_POST['tahun_produksi'][$in],
						'keterangan'=>$_POST['keterangan'][$in],
						'total_sd_yl'=>$_POST['total_sd_yl'][$in],
                        'total_hi'=>$_POST['total_hi'][$in],
						'total_sd_hi'=>$_POST['total_sd_hi'][$in],
                        'tgl_produksi'=>$_POST['tanggal_produksi']);
					$this->db->insert( 't_mutasi_produksi_gula_detail',$dat);

					
				}
			}

			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tmutasigulaproduksi/add/'.$ID,301);
			} else {
				redirect( 'tmutasigulaproduksi',301);
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

	function getcounterdata(){
		$tgl = $_POST['tgl'];
		$sql = $this->db->query("SELECT IFNULL(SUM(conveyor),0) AS zak,IFNULL(SUM(conveyor)*50/1000,0) AS ton  FROM `t_counter_gula` WHERE tgl = '$tgl'")->row();
		echo json_encode($sql);
	}

	function cekdata(){

	}

	function getdetail(){
		$tgl = $_POST['tgl'];
		$rx = $this->db->query("SELECT max(tanggal_produksi) as tgl FROM t_mutasi_produksi_gula")->row();
		if($rx){
			if($tgl > $rx->tgl)  $tgl = $rx->tgl;
		}

		$sql = $this->db->query("SELECT b.*,a.id as id_mj,a.jenis_produksi as nm_jenis,IFNULL(tahun_produksi,YEAR(NOW())) as thn_prd FROM m_jenis_produksi a LEFT JOIN (SELECT keterangan,jenis_produksi,tahun_produksi,total_sd_hi as total_sd_yl,total_sd_hi as total_sd_hi,0 as total_hi FROM `t_mutasi_produksi_gula_detail` WHERE tgl_produksi = '$tgl')  b ON a.`id`=b.`jenis_produksi` ORDER BY a.kode")->result();
		$htm ='';
		$i=0;
		foreach ($sql as $k) {
			$htm .= "<tr>
				<td><input type='hidden' name='jenis_produksi[]' value='".$k->id_mj."' >".$k->nm_jenis."</td>
				<td><input type='number' class='number' name='tahun_produksi[]' value='".$k->thn_prd."'></td>
				<td><input type='text' name='keterangan[]' value='".$k->keterangan."'></td>
				<td><input type='number' class='number ttlyl' readonly name='total_sd_yl[]' id='total_sd_yl_".$i."' value='".$k->total_sd_yl."'></td>
				<td><input type='number' class='number ttlhi' onkeyup='hitung(".$i.")' name='total_hi[]' id='total_hi_".$i."' value='".$k->total_hi."'></td>
				<td><input type='number' class='number ttlsd' readonly name='total_sd_hi[]' id='total_sd_hi_".$i."' value='".$k->total_sd_hi."'></td>
				
			</tr>";
			$i++;
		}
		
		echo $htm;
	}


}
