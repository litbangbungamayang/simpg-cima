<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Trubahari extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'trubahari';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('trubaharimodel');
		$this->model = $this->trubaharimodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'trubahari',
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
        	$arstatustx = array("1"=>"Buat","2"=>"Disetujui Man QC","3"=>"Disetujui Man Pengolahan");
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
            	$btn .= '<a href='.site_url('trubahari/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1   && $dt->status == 1){
            	$btn .= '<a href='.site_url('trubahari/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1   && $dt->status == 1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('trubahari/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('trubahari/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('t_ubah_ari'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('trubahari/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_ubah_ari'); 
			$d = $this->db->query("SELECT IFNULL(MAX(RIGHT(no_ba,4))+1,1) as nilaimax FROM `t_ubah_ari`")->row();
			$this->data['row']['no_ba'] = "BA/SIMPG-ARI/".CNF_PLANCODE."/".date('Y')."/".str_pad($d->nilaimax,4,'0',STR_PAD_LEFT);
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('trubahari/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			if($data['id'] == ''){
				$data['status'] = 1;
				$data['tgl_create'] = date('Y-m-d H:i:s');
				$data['user_create'] = $this->session->userdata('fid');
				$data['alasan'] = $_POST['alasan'];
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
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'trubahari/add/'.$ID,301);
			} else {
				redirect( 'trubahari',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function setujuiqc($id){
		$usr = $this->session->userdata('fid');
		$b = $this->db->query("UPDATE t_ubah_ari SET status='2',tgl_approve=NOW(),user_approve='$usr' WHERE id=$id");
		$this->inputLogs("BA No ".$a->no_ba." Sudah Disetujui Oleh ".$usr);
		$this->session->set_flashdata('message',SiteHelpers::alert('success'," BA Berhasil di Approve !"));
		redirect( 'trubahari/show/'.$id,301);
	}

	function setujui($id){
		$ab = $this->model->getRow( $id );
		$persenbrix = $ab['r_persen_brix_ari'];
		$persenpol =  $ab['r_persen_pol_ari'];
		$rendemen_individu = 0;

		$a = $this->db->query("SELECT * FROM t_ari WHERE id_spta='".$ab['id_spta']."'")->row_array();

		//default hitungan hk.. semua sama
			if($persenbrix != 0){
			$hk = ($persenpol / $persenbrix) * 100;
			$nilai_nira = $persenpol - ( 0.4 * ($persenbrix - $persenpol));
			}else{
				$hk=0;
				$nilai_nira =0;
			}

			$faktor_rendemen = $a['faktor_rendemen'];
			//PTPN 11
			/*
			hitungan rendemen jatiroto method
			faktor perah asumsi sama dengan faktor rendemen
			R awal = nilai_nira * faktor_perah;
			R hasil = R awal * faktor konversi;
			*/
			//N11 jatmed start
			if(CNF_COMPANYCODE == 'N011' && CNF_KONSEP == 2){
				$rawal = $nilai_nira * $faktor_rendemen;
				$rendemen_individu = $rawal;
				$rendemen_ari = $rawal * $a['faktor_konversi'];
			}
			//jatmed end

			/*
			hitungan rendemen jomed method
			R = nilai_nira * faktor_rendemen;
			*/

			//N11 jombang metode start
			if(CNF_COMPANYCODE == 'N011' && CNF_KONSEP == 1){

				$rendemen_ari = $nilai_nira * $faktor_rendemen;
			}
			//N11 jombang metode end

			/*
			hitungan rendemen kedawung method
			nilai nira kedawung = nilai nira jomed * faktor regresi;
			R = nilai_nira kedawung * faktor_rendemen;
			*/

			//N11 Kedawung metode start
			if(CNF_COMPANYCODE == 'N011' && CNF_KONSEP == 3){
				$nilai_nira = $nilai_nira * $a['faktor_regresi'];
				$rendemen_ari = $nilai_nira * $faktor_rendemen;
			}
			//N11 Kedawung metode end


			

			//PTPN 9 
			/*
			all PG
			jomed rendemen
			faktor rendemen = 0.66
			
			sama dengan ptpn 11 tanpa kelebihan 8
			66 dan 34
			*/

			if(CNF_COMPANYCODE == 'N009' || CNF_COMPANYCODE == 'N00I'){
				$rendemen_ari = $nilai_nira * $faktor_rendemen;
			}

			//PTPN 14
			/*
			all PG
			jomed rendemen
			faktor rendemen = faktor perah = periodik
			sama dengan ptpn 11 tanpa kelebihan 8
			66 dan 34
			*/
			if(CNF_COMPANYCODE == 'N014'){
				$rendemen_ari = $nilai_nira * $faktor_rendemen;
			}

			//PTPN 7
			/*
			all PG
			jomed rendemen
			faktor rendemen = faktor perah = dinamis per analisa
			sama dengan ptpn 11 tanpa kelebihan 8
			55 dan 45
			*/
			if(CNF_COMPANYCODE == 'N007'){
				$rendemen_ari = $nilai_nira * $faktor_rendemen;
			}

			$sql = "UPDATE t_ari SET persen_brix_ari='$persenbrix',persen_pol_ari='$persenpol',hk='$hk',rendemen_ari='$rendemen_ari',rendemen_individu='$rendemen_individu',nilai_nira='$nilai_nira' WHERE id_spta='".$ab['id_spta']."' and sbh_ari_status=0";
			$this->db->query($sql);

		$usr = $this->session->userdata('fid');
		$b = $this->db->query("UPDATE t_ubah_ari SET status='3',tgl_approve=NOW(),user_approve='$usr' WHERE id=$id");
		$this->inputLogs("BA No ".$a->no_ba." Sudah Disetujui Oleh ".$usr);
		$this->session->set_flashdata('message',SiteHelpers::alert('success'," BA Berhasil di Approve !"));
			
		redirect( 'trubahari/show/'.$id,301);
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
			$cek = $this->db->query("SELECT a.id,b.`persen_brix_ari`,b.`persen_pol_ari` FROM t_spta a INNER JOIN t_ari b ON a.id=b.id_spta WHERE no_spat = '".$_POST['nospta']."' AND a.`sbh_status`= 0 ")->row();
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
