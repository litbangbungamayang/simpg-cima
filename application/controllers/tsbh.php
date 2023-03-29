<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tsbh extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tsbh';
	public $per_page	= '10';
	public $idx			= '';
	public $fltr 		= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tsbhmodel');
		$this->model = $this->tsbhmodel;
		$idx = $this->model->primaryKey;
		$this->fltr = '';
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tsbh',
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

	function grids($stt,$tgl1,$tgl2){
		
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
		
		if($stt != 0){
			$tx = $stt-1;
			$filter .= " AND sbh_status IN ($tx,$stt) AND tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		}else{
			$filter .= " AND sbh_status >= 2 AND tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		}
         
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
				$term = $_POST['search']['value'];
            	$filter .= " AND (no_spat like '%$term%' OR kode_kat_lahan like '%$term%' OR kode_blok  like '%$term%' OR kode_blok  like '%$term%' OR jenis_spta  like '%$term%' OR deskripsi_blok  like '%$term%' OR nama_petani  like '%$term%')";
            }
        
        $this->session->set_userdata(array('filt_sbh' => $filter));

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
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
					$st = array('0'=>'ARI','1'=>'SBH','2'=>'PENGOLAHAN','3'=>'TANAMAN','4'=>'A.K.U');
					if($field == 'sbh_status'){
						$dt->$field = $st[$dt->$field];
					}
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }
 
            
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
			
			$this->data['content'] = $this->load->view('tsbh/'.CNF_COMPANYCODE.'/index',$this->data, true );

		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

	function add(){

		echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/form',null, true );
	}
	
	function upload() 
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
		
		$this->data['content'] = $this->load->view('tsbh/'.CNF_COMPANYCODE.'/indexupload',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function pengolahan() 
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
		
		$this->data['content'] = $this->load->view('tsbh/'.CNF_COMPANYCODE.'/indexpengolahan',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function tanaman() 
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
		
		$this->data['content'] = $this->load->view('tsbh/'.CNF_COMPANYCODE.'/indextanaman',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function aku() 
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
		
		$this->data['content'] = $this->load->view('tsbh/'.CNF_COMPANYCODE.'/indexaku',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

    function pengdownload()
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

        $this->data['content'] = $this->load->view('tsbh/'.CNF_COMPANYCODE.'/pengdownload',$this->data, true );

        $this->load->view('layouts/main', $this->data );

    }

    function excelsap($tgl1,$tgl2)
    {
        $this->load->model('apisapsbhmodel');
        $result = $this->apisapsbhmodel->getSbhBeetwen($tgl1,$tgl2);
        $data['result'] = $result;
        header("Content-disposition: attachment; filename=".str_replace('-', '',$tgl1).'_sbh_'." ".str_replace('-', '',$tgl2).".xls");
        header("Content-Type: application/vnd.ms-excel");
        $this->load->view('tsbh/'.CNF_COMPANYCODE.'/tpl_sap', $data);
    }

    function gridssbh($stt,$tgl1,$tgl2){

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

        if($stt != 0){
            $tx = $stt-1;
            $filter .= " AND sbh_status = 4 AND tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
        }else{
            $filter .= " AND  tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
        }


        if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            $term = $_POST['search']['value'];
            $filter .= " AND (no_spat like '%$term%' OR kode_kat_lahan like '%$term%' OR kode_blok  like '%$term%' OR kode_blok  like '%$term%' OR jenis_spta  like '%$term%' OR deskripsi_blok  like '%$term%' OR nama_petani  like '%$term%')";
        }

        $this->session->set_userdata(array('filt_sbh' => $filter));

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
        $rows = $results['rows'];
        $total = $results['total'];
        $totalfil = $results['totalfil'];

        //run data to view
        $data = array();$no=0;
        foreach ($rows as $dt) {
            $row = array();
            for ($i=0; $i < count($this->col) ; $i++) {
                $field = $this->col[$i+1];
                $st = array('0'=>'ARI','1'=>'SBH','2'=>'PENGOLAHAN','3'=>'TANAMAN','4'=>'A.K.U');
                if($field == 'sbh_status'){
                    $dt->$field = $st[$dt->$field];
                }
                $conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
                $row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }


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

    function downloadedtemplate($jns,$tgl1,$tgl2){
		$sort = $this->model->primaryKey; 
		$order = 'asc';

		$filter = " AND  tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		if($jns == 2){
			$filter .= " AND sbh_status <= 2";	
		}
		if($jns == 3){
			$filter .= " AND sbh_status = 1";
		} 

		$filter .= $this->session->userdata('filt_sbh');
		$params = array(
			'limit'		=> 0,
			'page'		=> 0,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRowspdx( $params );
		$this->data['rows'] = $results['rows'];
		//$total = $results['total'];
		//$totalfil = $results['totalfil'];
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		//var_dump($this->data['tableGrid']);die();
		if($jns == 1){
		$this->data['title'] = 'PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		$file = "SBH-".$this->data['title'].".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadreport',$this->data, true );
		}

		if($jns == 2){
		$this->data['title'] = 'TEMPLATE PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		$file = "SBH-".$this->data['title'].".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");

			if(CNF_KONSEP == 2){
				echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadtemplatejatnew',$this->data, true );
			}else if(CNF_KONSEP == 3){
				echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadtemplatekednew',$this->data, true );
			}else{
				echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadtemplatenew',$this->data, true );
			}
		}

		if($jns == 3){
		$this->data['title'] = 'PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/cetakapprovesbh',$this->data, true );
		}

		//var_dump($rows);
	}

	function downloaded($jns,$tgl1,$tgl2){
		$sort = $this->model->primaryKey; 
		$order = 'asc';

		$filter = " AND  tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		if($jns == 2){
			$filter .= " AND sbh_status <= 2";	
		}
		if($jns == 3){
			$filter .= " AND sbh_status = 1";
		} 

		$filter .= $this->session->userdata('filt_sbh');
		$params = array(
			'limit'		=> 0,
			'page'		=> 0,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRowspdx( $params );
		$this->data['rows'] = $results['rows'];
		//$total = $results['total'];
		//$totalfil = $results['totalfil'];
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		//var_dump($this->data['tableGrid']);die();
		if($jns == 1){
		$this->data['title'] = 'PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		$file = "SBH-".$this->data['title'].".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadreport',$this->data, true );
		}

		if($jns == 2){
		$this->data['title'] = 'TEMPLATE PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		$file = "SBH-".$this->data['title'].".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");

			if(CNF_KONSEP == 2){
				echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadtemplatejat',$this->data, true );
			}else{
				echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadtemplate',$this->data, true );
			}
		}

		if($jns == 3){
		$this->data['title'] = 'PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/cetakapprovesbh',$this->data, true );
		}

		//var_dump($rows);
	}


	function downloadedprognosa($jns,$tgl1,$tgl2){
		$sort = $this->model->primaryKey; 
		$order = 'asc';

		$filter = " AND  tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		$filter .= " AND sbh_status > 2";	

		//$filter .= $this->session->userdata('filt_sbh');
		$params = array(
			'limit'		=> 0,
			'page'		=> 0,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRowspdx( $params );
		$this->data['rows'] = $results['rows'];
		//$total = $results['total'];
		//$totalfil = $results['totalfil'];
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$file = 'Prognosa Template '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2).'.xls';
		//var_dump($this->data['tableGrid']);die();
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$file");
		$this->data['title'] = 'PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/templateprognosa',$this->data, true );
		

		//var_dump($rows);
	}


	function downloadlembarkerja($jns,$tgl1,$tgl2){
		$sort = $this->model->primaryKey; 
		$order = 'asc';

		$filter = " AND  tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		if($jns == 2){
			$filter .= " AND sbh_status = 4";	
		}

		$sql = "SELECT '' AS no_ajuan,CONCAT(DATE_FORMAT('$tgl1','%j'),DATE_FORMAT('$tgl2','%j')) AS periode,a.`id_petani_sap`,d.`nama_petani`,d.`kode_kelompok`,SUM(b.`netto_final`) AS netto,
IF(a.`tebang_pg`=1,SUM(b.`netto_final`),0) AS tebang_pg,
IF(a.`angkut_pg`=1,SUM(b.`netto_final`),0) AS angkut_pg,
SUM(c.`sembilanpuluh_persen`) AS sembilanpuluh_persen,
SUM(c.`sepuluh_persen`) AS sepuluh_persen,
SUM(c.`gula_ptr`) AS gula_ptr,
SUM(c.`gula_pg`) AS gula_pg,
SUM(c.`gula_ptr`) AS gula_ptr,
SUM(c.`tetes_ptr`) AS tetes_ptr,
SUM(c.`tetes_pg`) AS tetes_pg
 FROM t_spta a 
INNER JOIN t_timbangan b ON a.`id`=b.`id_spat`
INNER JOIN t_ari c ON c.`id_spta`=a.`id`
INNER JOIN sap_field e on e.kode_blok=a.kode_blok
INNER JOIN sap_petani d ON d.`id_petani_sap`=e.`id_petani_sap` WHERE 0=0 $filter
GROUP BY a.`id_petani_sap`";
		$this->data['result'] = $this->db->query($sql)->result();

		
		$this->data['title'] = 'LEMBARKERJA PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		$file = "LK-".$this->data['title'].".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		echo $this->load->view('tsbh/'.CNF_COMPANYCODE.'/downloadlembarkerja',$this->data, true );
		

		//var_dump($rows);
	}


	function uploadsend(){
		 //var_dump($_FILES);die();
		ini_set('memory_limit', '4048M');
		ini_set('upload_max_filesize','30M');
		ini_set('post_max_size','30M');
		// include APPPATH."/third_party/PHPExcel/IOFactory.php";

		//include (APPPATH.'/third_party/php-excel-reader/excel_reader2.php');
		include (APPPATH.'/third_party/SpreadsheetReader.php');
		$file = 'TEMP_SBH.xlsx';

		if(move_uploaded_file($_FILES['template_sbh']['tmp_name'], $file)){
		//chmod($file, 0777);
try
	{
		$files = $file;
		$Spreadsheet = new SpreadsheetReader($files);

		$Sheets = $Spreadsheet -> Sheets();
		$BaseMem = memory_get_usage();
		$Spreadsheet -> ChangeSheet(0);
		$totdata = 0;
		if($Sheets[0] == 'SBH-TEMPLATE'){
			//var_dump($Spreadsheet);die();

			foreach ($Spreadsheet as $Key => $Row)
			{
				
				if($Key > 2){
					if(trim($Row[1]) != ''){
					if(CNF_COMPANYCODE == 'N011'){
					if(CNF_KONSEP == 2){
						//coresapler
						$tempdataari = array(
						'id_ari'	 		=> trim($Row[1]), 
						'id_spta' 			=> trim($Row[0]), 
						'persen_brix_ari' 	=> trim($Row[37]), 
						'persen_pol_ari' 	=> trim($Row[38]), 
						'ph_ari' 			=> trim($Row[39]), 
						'hk' 				=> trim($Row[40]), 
						'nilai_nira' 		=> trim($Row[41]), 
						'faktor_rendemen' 	=> trim($Row[42]), 
						'rendemen_ari' 		=> trim($Row[45]),
						'faktor_konversi'   => trim($Row[44]),
						'rendemen_individu' => trim($Row[43]), 
						'hablur_ari' 		=> trim($Row[46]), 
						'gula_total' 		=> trim($Row[47]), 
						'tetes_total' 		=> trim($Row[48]), 
						'rendemen_ptr' 		=> trim($Row[49]), 
						'gula_ptr' 			=> trim($Row[52]), 
						'tetes_ptr' 		=> trim($Row[55]),
						'sembilanpuluh_persen' 	=> trim($Row[54]),
						'sepuluh_persen' 		=> trim($Row[53]),
						'kopensasi_gula' 		=> trim($Row[51]), 
						'gula_pg' 			=> trim($Row[56]), 
						'tetes_pg' 			=> trim($Row[57]),
						'sbh_ari_status'	=> '1',
						'sbh_ari_user'		=> $this->session->userdata('fid'),
						'sbh_ari_tgl'		=> date('Y-m-d H:i:s')
					);

					}else if(CNF_KONSEP == 1){
						//ari
					$tempdataari = array(
						'id_ari'	 		=> trim($Row[1]), 
						'id_spta' 			=> trim($Row[0]), 
						'persen_brix_ari' 	=> trim($Row[36]), 
						'persen_pol_ari' 	=> trim($Row[37]), 
						'ph_ari' 			=> trim($Row[38]), 
						'hk' 				=> trim($Row[39]), 
						'nilai_nira' 		=> trim($Row[40]), 
						'faktor_rendemen' 	=> trim($Row[41]), 
						'rendemen_ari' 		=> trim($Row[42]), 
						'hablur_ari' 		=> trim($Row[43]), 
						'gula_total' 		=> trim($Row[44]), 
						'tetes_total' 		=> trim($Row[45]), 
						'rendemen_ptr' 		=> trim($Row[46]), 
						'gula_ptr' 			=> trim($Row[49]), 
						'tetes_ptr' 		=> trim($Row[52]),
						'sembilanpuluh_persen' 	=> trim($Row[51]),
						'sepuluh_persen' 		=> trim($Row[50]),
						'kopensasi_gula' 		=> trim($Row[48]), 
						'gula_pg' 			=> trim($Row[53]), 
						'tetes_pg' 			=> trim($Row[54]),
						'sbh_ari_status'	=> '1',
						'sbh_ari_user'		=> $this->session->userdata('fid'),
						'sbh_ari_tgl'		=> date('Y-m-d H:i:s')
					);
				}else{
					//kedawung
					$tempdataari = array(
						'id_ari'	 		=> trim($Row[1]), 
						'id_spta' 			=> trim($Row[0]), 
						'persen_brix_ari' 	=> trim($Row[37]), 
						'persen_pol_ari' 	=> trim($Row[38]), 
						'ph_ari' 			=> trim($Row[39]), 
						'hk' 				=> trim($Row[40]), 
						'nilai_nira' 		=> trim($Row[41]), 
						'faktor_rendemen' 	=> trim($Row[42]), 
						'rendemen_ari' 		=> trim($Row[43]), 
						'hablur_ari' 		=> trim($Row[44]), 
						'gula_total' 		=> trim($Row[45]), 
						'tetes_total' 		=> trim($Row[46]), 
						'rendemen_ptr' 		=> trim($Row[47]), 
						'gula_ptr' 			=> trim($Row[50]), 
						'tetes_ptr' 		=> trim($Row[53]),
						'sembilanpuluh_persen' 	=> trim($Row[52]),
						'sepuluh_persen' 		=> trim($Row[51]),
						'kopensasi_gula' 		=> trim($Row[49]), 
						'gula_pg' 			=> trim($Row[54]), 
						'tetes_pg' 			=> trim($Row[55]),
						'sbh_ari_status'	=> '1',
						'sbh_ari_user'		=> $this->session->userdata('fid'),
						'sbh_ari_tgl'		=> date('Y-m-d H:i:s')
				);
				}
			}else{

				if(CNF_KONSEP == 2){
						//coresapler
						$tempdataari = array(
						'id_ari'	 		=> trim($Row[1]), 
						'id_spta' 			=> trim($Row[0]), 
						'persen_brix_ari' 	=> trim($Row[34]), 
						'persen_pol_ari' 	=> trim($Row[35]), 
						'ph_ari' 			=> trim($Row[36]), 
						'hk' 				=> trim($Row[37]), 
						'nilai_nira' 		=> trim($Row[38]), 
						'faktor_rendemen' 	=> trim($Row[39]), 
						'rendemen_ari' 		=> trim($Row[42]),
						'faktor_konversi'   => trim($Row[41]),
						'rendemen_individu' => trim($Row[40]), 
						'hablur_ari' 		=> trim($Row[43]), 
						'gula_total' 		=> trim($Row[44]), 
						'tetes_total' 		=> trim($Row[45]), 
						'rendemen_ptr' 		=> trim($Row[46]), 
						'gula_ptr' 			=> trim($Row[47]), 
						'tetes_ptr' 		=> trim($Row[48]), 
						'gula_pg' 			=> trim($Row[49]), 
						'tetes_pg' 			=> trim($Row[50]),
						'sbh_ari_status'	=> '1',
						'sbh_ari_user'		=> $this->session->userdata('fid'),
						'sbh_ari_tgl'		=> date('Y-m-d H:i:s')
					);

					}else{
						//ari
					$tempdataari = array(
						'id_ari'	 		=> trim($Row[1]), 
						'id_spta' 			=> trim($Row[0]), 
						'persen_brix_ari' 	=> trim($Row[34]), 
						'persen_pol_ari' 	=> trim($Row[35]), 
						'ph_ari' 			=> trim($Row[36]), 
						'hk' 				=> trim($Row[37]), 
						'nilai_nira' 		=> trim($Row[38]), 
						'faktor_rendemen' 	=> trim($Row[39]), 
						'rendemen_ari' 		=> trim($Row[40]), 
						'hablur_ari' 		=> trim($Row[41]), 
						'gula_total' 		=> trim($Row[42]), 
						'tetes_total' 		=> trim($Row[43]), 
						'rendemen_ptr' 		=> trim($Row[44]), 
						'gula_ptr' 			=> trim($Row[45]), 
						'tetes_ptr' 		=> trim($Row[46]), 
						'gula_pg' 			=> trim($Row[47]), 
						'tetes_pg' 			=> trim($Row[48]),
						'sbh_ari_status'	=> '1',
						'sbh_ari_user'		=> $this->session->userdata('fid'),
						'sbh_ari_tgl'		=> date('Y-m-d H:i:s')
					);
				}

			}

			$this->db->where('id_ari', trim($Row[1]));
			$this->db->where('id_spta', trim($Row[0]));
			$this->db->where('pengolahan_status', '0');
			$this->db->update('t_ari', $tempdataari);


			$tempspta = array(
					'sbh_status' 	=> '1',
					'sbh_tgl'		=> date('Y-m-d H:i:s')
				);

			$this->db->where('id', trim($Row[0]));
			$this->db->where('sbh_status < ', 2);
			$this->db->update('t_spta', $tempspta);
			
			
			 $totdata++;
					}
				}
				}

				echo ($totdata)." Data SBH Berhasil Diupload Silahkan cek di Table Sebelum di approve !!";
			
		}else{
			echo "Nama Sheet Template File Excel Salah..";
		}
		}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}
}else{
	echo 'File Gagal Upload !! Max Upload Filesize '.ini_get('upload_max_filesize');
}


		/*

		 $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		 	$cacheSettings = array( 'memoryCacheSize' => '8MB');
			PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings); 

		$target = basename($_FILES['template_sbh']['name']) ;
    
		if(move_uploaded_file($_FILES['template_sbh']['tmp_name'], $target)){
			chmod($target,0777);

		

		try {
		$objPHPExcel = PHPExcel_IOFactory::load($target);
		} catch(ErrorException $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			exit();
		}

	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		$totupload  = 0;
		$totdecline = 0;
		//var_dump(trim($allDataInSheet[3]["A"]));
		if($allDataInSheet[3]["A"] == 'ID SPTA' &&  $allDataInSheet[3]["B"] == 'ID ARI'){
		for($i=4;$i<=$arrayCount;$i++){
			$tempdataari = array(
					'id_ari'	 	=> trim($allDataInSheet[$i]["B"]), 
					'id_spta' 		=> trim($allDataInSheet[$i]["A"]), 
					'persen_brix_ari' 		=> trim($allDataInSheet[$i]["AI"]), 
					'persen_pol_ari' 		=> trim($allDataInSheet[$i]["AJ"]), 
					'ph_ari' 		=> trim($allDataInSheet[$i]["AK"]), 
					'hk' 			=> trim($allDataInSheet[$i]["AL"]), 
					'nilai_nira' 	=> trim($allDataInSheet[$i]["AM"]), 
					'faktor_rendemen' 		=> trim($allDataInSheet[$i]["AN"]), 
					'rendemen_ari' 	=> trim($allDataInSheet[$i]["AO"]), 
					'hablur_ari' 	=> trim($allDataInSheet[$i]["AP"]), 
					'gula_total' 	=> trim($allDataInSheet[$i]["AQ"]), 
					'tetes_total' 	=> trim($allDataInSheet[$i]["AR"]), 
					'rendemen_ptr' 	=> trim($allDataInSheet[$i]["AS"]), 
					'gula_ptr' 		=> trim($allDataInSheet[$i]["AT"]), 
					'tetes_ptr' 	=> trim($allDataInSheet[$i]["AU"]), 
					'gula_pg' 		=> trim($allDataInSheet[$i]["AV"]), 
					'tetes_pg' 		=> trim($allDataInSheet[$i]["AW"]),
					'sbh_ari_status'				=> '1',
					'sbh_ari_user'				=> $this->session->userdata('fid'),
					'sbh_ari_tgl'				=> date('Y-m-d H:i:s')
				);

			$tempspta = array(
					'sbh_status' => '1',
					'sbh_tgl'	=> date('Y-m-d H:i:s')
				);

			$this->db->where('id_ari', trim($allDataInSheet[$i]["B"]));
			$this->db->where('id_spta', trim($allDataInSheet[$i]["A"]));
			$this->db->where('pengolahan_status', '0');
			$this->db->update('t_ari', $tempdataari);


			$this->db->where('id', trim($allDataInSheet[$i]["A"]));
			$this->db->where('sbh_status < ', 2);
			$this->db->update('t_spta', $tempspta);

			//var_dump($tempdataari);
		}
		echo ($i-4)." Data SBH Berhasil Diupload Silahkan cek di Table Sebelum di approve !!";
	}else{
		echo "Format tempate salah !! Silahakan Download template SBH dari SIMPG !!";
	}
	}*/
}
	
	

	function approved(){
		$stt = $_POST['stt'];
		$tgl1 = $_POST['tgl1'];
		$tgl2 = $_POST['tgl2'];
		$cancel = $_POST['cancel'];

		if($stt == 1){
			//pengolahan
			$stx = 1;
			$sty = 2;
			$sttz = 1;
			if($cancel == 1){
				$stx = 2;
				$sty = 1;
				$sttz = 0;
			}
			$sql = "UPDATE t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
SET a.`pengolahan_status`=$sttz,a.`pengolahan_tgl`=NOW(),b.`sbh_status`=$sty,b.`sbh_tgl`=NOW(),a.`pengolahan_user`='".$this->session->userdata('fid')."'
WHERE b.`tgl_giling` BETWEEN '".$tgl1."' AND '".$tgl2."' AND b.`sbh_status`=$stx";
		}

		if($stt == 2){
			//tanaman
			$stx = 2;
			$sty = 3;
			$sttz = 1;
			if($cancel == 1){
				$stx = 3;
				$sty = 2;
				$sttz = 0;
			}

			$sql = "UPDATE t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
SET a.`tanaman_status`=$sttz,a.`tanaman_tgl`=NOW(),b.`sbh_status`=$sty,b.`sbh_tgl`=NOW(),a.`tanaman_user`='".$this->session->userdata('fid')."'
WHERE b.`tgl_giling` BETWEEN '".$tgl1."' AND '".$tgl2."' AND b.`sbh_status`=$stx";
		}

		if($stt == 3){
			//aku
			$stx = 3;
			$sty = 4;
			$sttz = 1;
			if($cancel == 1){
				$stx = 4;
				$sty = 3;
				$sttz = 0;
			}
			$sql = "UPDATE t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
SET a.`aku_status`=$sttz,a.`aku_tgl`=NOW(),b.`sbh_status`=$sty,b.`sbh_tgl`=NOW(),a.`aku_user`='".$this->session->userdata('fid')."'
WHERE b.`tgl_giling` BETWEEN '".$tgl1."' AND '".$tgl2."' AND b.`sbh_status`=$stx";
		}

		$this->db->query($sql);
		$afftectedRows = $this->db->affected_rows();
		if($cancel == 1){
			echo ($afftectedRows/2).' Berhasil di Cancel Approve !!';
		}else{
			echo ($afftectedRows/2).' Berhasil di Approve !!';	
		}
		
	}


}
