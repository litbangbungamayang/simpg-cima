<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tanalisarendemen extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tanalisarendemen';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tanalisarendemenmodel');
		$this->model = $this->tanalisarendemenmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'].' '.date('d M Y'),
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tanalisarendemen',
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
	
	function gridMejaTebu(){
		$result = $this->db->query('SELECT a.id,a.`no_spat`,a.`meja_tebu_tgl`,b.`warna_meja_tebu`,b.`kode_meja_tebu`,no_urut_analisa_rendemen FROM t_spta  a INNER JOIN t_meja_tebu b ON a.`id`=b.`id_spta` WHERE meja_tebu_status = 1 AND ari_status = 0 AND b.gilingan = "'.$this->session->userdata('gilingan').'" ORDER BY a.`meja_tebu_tgl` ASC LIMIT 15 ')->result();
		$data = array();
		foreach ($result as $dt) {
			$spta = $dt->no_spat;
			$row = array();
            $row[] = '<span style="background:'.$dt->warna_meja_tebu.';padding:5px">'.$dt->kode_meja_tebu.'</span>';
            $row[] = $dt->no_spat;
            $row[] = $dt->meja_tebu_tgl;
			
			$btn = '<a href="#" onclick="getDataSPTA(\''.$spta.'\')"  class="tips "  title="Get Data"><i class="fa  fa-arrow-circle-right"></i>  </a>';
			$row[] = $btn;
			$data[] = $row;
		}
		
		$output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => 10,
                        "recordsFiltered" => 0,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

    function gridSelektor(){
	    $qry = "SELECT 
                  a.id,
                  a.`no_spat`,
                  a.`kode_affd`,
                  d.`name`
                FROM
                  t_spta a 
                    INNER JOIN t_selektor c ON a.id = c.`id_spta`
                    INNER JOIN `sap_m_karyawan` d ON c.`persno_mandor_tma` = d.`Persno`
                WHERE `selektor_status` = 1 AND `ari_status` = 0 AND SUBSTRING(`kode_kat_lahan`, 1,2) = 'TS'";
        $result = $this->db->query($qry)->result();
        $data = array();
        foreach ($result as $dt) {
            $spta = $dt->no_spat;
            $row = array();
            $row[] = $spta;
            $row[] = $dt->name;
            $row[] = $dt->kode_affd;

            $btn = '<a href="#" onclick="getDataSPTATS(\''.$spta.'\')"  class="tips "  title="Get Data"><i class="fa  fa-arrow-circle-right"></i>  </a>';
            $row[] = $btn;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => 10,
            "recordsFiltered" => 0,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	function grids(){
		
		$sort = $this->model->primaryKey; 
		$order = 'asc';
		$filter = "AND date(tgl_ari) = date(NOW())";
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
          //  $row[] = $dt->no_spat;
            $row[] = $dt->tgl_ari;
            $row[] = $dt->persen_brix_ari;
            $row[] = $dt->persen_pol_ari;
            $row[] = $dt->ph_ari;
            		/*$row[] = $dt->hk;
            		$row[] = $dt->nilai_nira;
            		$row[] = $dt->rendemen_ari;*/
            $row[] = $dt->ptgs_ari;
          
            $data[] = $row;
            $no++;
        }

        //var_dump($data);die();

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
		
		//jombangmetod

	if(CNF_KONSEP == 1){
		if(CNF_METODE == 1){
		
		$this->data['content'] = $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/formAri',$this->data, true );
		}else{
		$this->data['content'] = $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/form',$this->data, true );
		}

		$this->data['content'] .= $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/index',$this->data, true );
	}


		//jatmed
	if(CNF_KONSEP == 2){
		$this->data['content'] = $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/formjatmed',$this->data, true );
		$this->data['content'] .= $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/indexjatmed',$this->data, true );
	}


		//kedawungmed

	if(CNF_KONSEP == 3){
		$this->data['content'] = $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/formkedawung',$this->data, true );
		$this->data['content'] .= $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/indexkedawung',$this->data, true );
	}


/*
		
		if(CNF_METODE == 1){
		
		$this->data['content'] = $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/formAri',$this->data, true );
		}else{
		$this->data['content'] = $this->load->view('tanalisarendemen/'.CNF_COMPANYCODE.'/form',$this->data, true );
		}
*/

		
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

	function indexevaluasi(){
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
		
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		// Group users permission
		$this->data['access']		= $this->access;
		// Render into template
		
		$this->data['content'] = $this->load->view('tanalisarendemen/evaluasiari',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
	}


	function addupload( $id = null ) 
	{
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		
		$this->data['content'] = $this->load->view('tanalisarendemen/formupload',null, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}


	function upload(){
		include APPPATH."/third_party/PHPExcel/IOFactory.php";
		try {
		$objPHPExcel = PHPExcel_IOFactory::load($_FILES['master_field']['tmp_name']);
		} catch(ErrorException $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			exit();
		}

		$ix = 0;
		$num=$objPHPExcel->getSheetCount() ;
		$objPHPExcel->setActiveSheetIndex(0);
		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		//var_dump($allDataInSheet);die();
		$totupload  = 0;
		$tots = 0;
		$tmpkodepetak = "";
		for($i=2;$i<=$arrayCount;$i++){
			$brix = trim($allDataInSheet[$i]["G"]);
			$pol = trim($allDataInSheet[$i]["J"]);
			$ph = trim($allDataInSheet[$i]["K"]);
			$tgl = trim($allDataInSheet[$i]["A"]);
			$jam = trim($allDataInSheet[$i]["B"]);

			if($brix !=0){
			$hk = ($pol / $brix) * 100;
			$nilai_nira = $pol - ( 0.4 * ($brix - $pol));
			$rendemen_ari = $nilai_nira * PN_FAKTOR_RENDEMEN;

			$sql = $this->db->query("UPDATE t_ari a INNER JOIN t_spta b ON a.`id_spta`=b.`id` SET 
a.`persen_brix_ari`= '".$brix."',
a.`persen_pol_ari`= '".$pol."',
a.`hk`= '".$hk."',
a.`nilai_nira`= '".$nilai_nira."',
a.`rendemen_ari`= '".$rendemen_ari."',
a.`ph_ari`= '".$ph."',
a.`tgl_ari` = '".$tgl." ".$jam."'
WHERE b.`no_spat`='".trim($allDataInSheet[$i]["C"])."' AND a.sbh_ari_status=0");
			
		$aft = $this->db->affected_rows();
		if($aft==1){
		 $tots++;
		}else{
			$tmpkodepetak .= ",".trim($allDataInSheet[$i]["C"]);
		}
		}
		$totupload++;
		}
		//	die();
			$this->inputLogs(" Upload data hasil analisa oleh ".$this->session->userdata('fid').' dengan data '.$totupload.' Row.. Berhasil Teranalisa '.$tots.', Gagal Teranalisa SPTA : '.$tmpkodepetak.' Karena Belum Masuk coresampler');
			
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Upload data hasil analisa oleh ".$this->session->userdata('fid').' dengan data '.$totupload.' Row.. Berhasil Teranalisa '.$tots.', Gagal Teranalisa SPTA : '.$tmpkodepetak.' Karena Belum Masuk coresampler'));
			
			redirect( 'tanalisarendemen/indexevaluasi',301);
			
		
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
			$this->data['row'] = $this->model->getColumnTable('t_ari'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tanalisarendemen/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_ari'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tanalisarendemen/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data['tgl_ari'] = $_POST['tgl_ari'].' '.$_POST['jam_ari'];
			$data['ptgs_ari'] = $this->session->userdata('fid');

			//default hitungan hk.. semua sama
			if($_POST['persen_brix_ari'] != 0){
			$hk = ($_POST['persen_pol_ari'] / $_POST['persen_brix_ari']) * 100;
			$nilai_nira = $_POST['persen_pol_ari'] - ( 0.4 * ($_POST['persen_brix_ari'] - $_POST['persen_pol_ari']));
			}else{
				$hk=0;
				$nilai_nira =0;
			}

			$faktor_rendemen = $_POST['faktor_rendemen'];
			
			


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
				$data['rendemen_individu'] = $rawal;
				$rendemen_ari = $rawal * $_POST['faktor_konversi'];
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
				$nilai_nira = $nilai_nira * $_POST['faktor_regresi'];
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

			//PTPN 2
			/*
			all PG
			jomed rendemen
			faktor rendemen = faktor perah = dinamis per analisa
			sama dengan ptpn 11 tanpa kelebihan 8
			55 dan 45
			*/
			if(CNF_COMPANYCODE == 'N002'){
				$rendemen_ari = $nilai_nira * $faktor_rendemen;
			}



			$data['hk'] = $hk;
			$data['nilai_nira'] = $nilai_nira;
			$data['faktor_rendemen'] = $faktor_rendemen;
			$data['rendemen_ari'] = $rendemen_ari;

			if(CNF_COMPANYCODE == 'N011'){
				$sql = $this->db->query("SELECT a.`r_spg` FROM t_spg a INNER JOIN t_spta b ON a.`kode_blok`=b.`kode_blok`
WHERE b.`id` = '".$_POST['id_spta']."'")->row();
				$data['r_spg'] = 0;
				if($sql){
					$data['r_spg'] = $sql->r_spg;
				}
			}

			
			
			
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_ari' , true ));
			// Input logs
			if( $this->input->get( 'id_ari' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			
			redirect( 'tanalisarendemen',301);
						
			
			
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
			
			
			if(CNF_METODE == 2){
			/**core sampler
				- cek status selektor diterima jika status = 1 (0 belum selektor,2 ditolak selektor)
				- cek ari sudah pernah diinput belum
			**/
			$cek = $this->db->query("SELECT id,kode_blok,kode_kat_lahan,kode_affd,
IF(selektor_status = 2,CONCAT('SPTA Ditolak SELEKTOR pada tanggal ',DATE_FORMAT(selektor_tgl,'%D %M %Y %H:%i')),IF(selektor_status=1,1,'SPTA belum di SELEKTOR ')) AS point_cek,
IF(ari_status = 1,CONCAT('SPTA Sudah di ANALISA tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),IF(ari_status=2,CONCAT('SPTA ditolak di ANALISA ARI tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),0)) AS stt FROM t_spta WHERE no_spat = '".$_POST['nospta']."'")->row();

			}else if(CNF_METODE == 1){
			/** ari
				- cek meja tebu sudah masuk belum
				- cek ari sudah pernah diinput belum
			**/
				$cek = $this->db->query("SELECT t_spta.id,t_meja_tebu.kondisi_tebu,kode_blok,kode_kat_lahan,kode_affd,
IF(meja_tebu_status = 1,1,'SPTA Belum Masuk MASUK MEJA !!') AS point_cek,
IF(ari_status = 1,CONCAT('SPTA Sudah di ANALISA tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),IF(ari_status=2,CONCAT('SPTA ditolak di ANALISA ARI tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),0)) AS stt 
FROM t_spta INNER JOIN t_meja_tebu ON t_spta.id=t_meja_tebu.id_spta WHERE no_spat = '".$_POST['nospta']."'")->row();
			
			
			}
			
			
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
