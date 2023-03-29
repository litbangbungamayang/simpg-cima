<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Thapas extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tsbh';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tsbhmodel');
		$this->model = $this->tsbhmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'mvarietas',
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
            	$btn .= '<a href='.site_url('mvarietas/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('mvarietas/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('mvarietas/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		$row = $this->db->query("SELECT * FROM t_hapas")->row();
		$this->data['kontrol']		= $this;
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$headerdata = new \stdClass;
		$headerdata->company_code = '';
    	$headerdata->plant_code = '';
    	$headerdata->tgl_awal = '';
    	$headerdata->tgl_akhir = '';
    	$headerdata->tgl_stop_hif = '';
    	$headerdata->tgl_start_hif = '';
    	$headerdata->tgl_stop_hia = '';
    	$headerdata->tgl_start_hia = '';
    	$headerdata->jml_hari_penyelesaian = '';
    	$headerdata->jml_hari_gil_inc_jb = '';
			$this->data['row'] = $headerdata; 
		}

		$this->data['cetak'] = 	  $this->load->view('tlapharpeng/cetakhapas',$this->data, true );
		$this->data['content'] = $this->load->view('tlapharpeng/hapasindex',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

	function numberformat($numb,$r){
		if($numb == 0){
			return '-';
		}else{
			return number_format($numb,$r);
		}
	}
	function add() 
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
		$this->data['kontrol']		= $this;

		$row = $this->db->query("SELECT * FROM t_hapas")->row();
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$headerdata = new \stdClass;
		$headerdata->company_code = '';
    	$headerdata->plant_code = '';
    	$headerdata->tgl_awal = '';
    	$headerdata->tgl_akhir = '';
    	$headerdata->tgl_stop_hif = '';
    	$headerdata->tgl_start_hif = '';
    	$headerdata->tgl_stop_hia = '';
    	$headerdata->tgl_start_hia = '';
    	$headerdata->jml_hari_penyelesaian = '';
    	$headerdata->jml_hari_gil_inc_jb = '';
    	$headerdata->id = '';
			$this->data['row'] = $headerdata; 
		}
		
		$this->data['content'] = $this->load->view('tlapharpeng/hapasindex2',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

	function daterpt($tgl){
		if($tgl != ''){
	$bln = array('01'=>'Januari','02'=>'Febuari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
	$tgl = explode('-',$tgl);
	return $tgl[2].' '.$bln[$tgl[1]].' '.$tgl[0];
}else{
	return '';
}
}

	function cetak(){
		$row = $this->db->query("SELECT * FROM t_hapas")->row();
		$this->data['kontrol']		= $this;
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
	$headerdata = new \stdClass;
		$headerdata->company_code = '';
    	$headerdata->plant_code = '';
    	$headerdata->tgl_awal = '';
    	$headerdata->tgl_akhir = '';
    	$headerdata->tgl_stop_hif = '';
    	$headerdata->tgl_start_hif = '';
    	$headerdata->tgl_stop_hia = '';
    	$headerdata->tgl_start_hia = '';
    	$headerdata->jml_hari_penyelesaian = '';
    	$headerdata->jml_hari_gil_inc_jb = '';
			$this->data['row'] = $headerdata; 
		}
		
		echo $this->load->view('tlapharpeng/cetakhapas',$this->data, true );
	}

	function getnamaunit($kode){
		if($kode != ''){
        $thx = $this->db->query("SELECT * FROM sap_plant where kode_plant = '$kode'")->row();
        return $thx->nama_plant;
    	}else{
    		return '';
    	}
    }
/*
    function savev2(){
    	var_dump($_POST);die();
    	$headerdata = array();
    	$headerdata['company_code'] = $_POST['company_code'];
    	$headerdata['plant_code'] = $_POST['plant_code'];
    	$headerdata['tgl_awal'] = $_POST['tgl_awal'];
    	$headerdata['tgl_akhir'] = $_POST['tgl_akhir'];
    	$headerdata['tgl_stop_hif'] = $_POST['tgl_stop_hif'];
    	$headerdata['tgl_start_hif'] = $_POST['tgl_start_hif'];
    	$headerdata['tgl_stop_hia'] = $_POST['tgl_stop_hia'];
    	$headerdata['tgl_start_hia'] = $_POST['tgl_start_hia'];
    	$headerdata['jml_hari_penyelesaian'] = $_POST['jml_hari_penyelesaian'];
    	$headerdata['jml_hari_gil_inc_jb'] = $_POST['jml_hari_gil_inc_jb'];

    	if($_POST['id'] == ''){
    	$this->db->query("DELETE FROM t_hapas");
    	$this->db->insert('t_hapas',$headerdata);
	    }else{
	    	$this->db->where('id', $_POST['id']);
			$this->db->update('t_hapas', $headerdata);
	    }

	    $as = $this->db->query("SELECT * FROM t_hapas_detail")->result();
	    foreach($as as $re){
	    	if($re->kode == '05' ){
	    		$plant = '';$rax = array();
	    	if(isset($_POST[$re->kode.'_plant'])){
	    		$plant = $_POST[$re->kode.'_plant'];
	    	}
	    	$rax['plant_code'] = $plant;
		    	$rax['id_hapas'] = $_POST['id'];
		    	$this->db->where('kode', $re->kode);
				$this->db->update('t_hapas_detail', $rax);

	    	}else{
	    	$plant = '';$rax = array();
	    	if(isset($_POST[$re->kode.'_plant'])){
	    		$plant = $_POST[$re->kode.'_plant'];
	    	}
	    	if(isset($_POST[$re->kode])){
		    	$rax['nilai'] = $_POST[$re->kode];
		    	$rax['plant_code'] = $plant;
		    	$rax['id_hapas'] = $_POST['id'];
		    	$this->db->where('kode', $re->kode);
				$this->db->update('t_hapas_detail', $rax);
			}
		}

	    }
    }*/

    function save(){
    //	var_dump($_POST);die();
    	$headerdata = array();
    	$headerdata['company_code'] = $_POST['company_code'];
    	$headerdata['plant_code'] = $_POST['plant_code'];
    	$headerdata['tgl_awal'] = $_POST['tgl_awal'];
    	$headerdata['tgl_akhir'] = $_POST['tgl_akhir'];
    	$headerdata['tgl_stop_hif'] = $_POST['tgl_stop_hif'];
    	$headerdata['tgl_start_hif'] = $_POST['tgl_start_hif'];
    	$headerdata['tgl_stop_hia'] = $_POST['tgl_stop_hia'];
    	$headerdata['tgl_start_hia'] = $_POST['tgl_start_hia'];
    	$headerdata['jml_hari_penyelesaian'] = $_POST['jml_hari_penyelesaian'];
    	$headerdata['jml_hari_gil_inc_jb'] = $_POST['jml_hari_gil_inc_jb'];
    	$headerdata['datecreate'] = date('Y-m-d');
    	$headerdata['usercreate'] = $this->session->userdata('fid');

    	if($_POST['id'] == ''){
    	$this->db->query("DELETE FROM t_hapas");
    	$this->db->insert('t_hapas',$headerdata);
	    }else{
	    	$this->db->where('id', $_POST['id']);
			$this->db->update('t_hapas', $headerdata);
	    }

	    $as = $this->db->query("SELECT * FROM t_hapas_detail_copy")->result();
	    foreach($as as $re){
	    	if($re->kode == '05' ){
	    		$plant = '';$rax = array();
	    	if(isset($_POST[$re->kode.'_plant'])){
	    		$plant = $_POST[$re->kode.'_plant'];
	    	}
	    	$rax['plant_code'] = $plant;
		    	$rax['code_plant'] = $_POST['plant_code'];
	    		$rax['code_company'] =  $_POST['company_code'];
		    	$this->db->where('kode', $re->kode);
				$this->db->update('t_hapas_detail_copy', $rax);

	    	}else{
	    	$plant = '';$rax = array();
	    	if(isset($_POST[$re->kode.'_plant'])){
	    		$plant = $_POST[$re->kode.'_plant'];
	    	}
	    	//if(isset($_POST[$re->kode])){
	    		$rax['code_plant'] = $_POST['plant_code'];
	    		$rax['code_company'] =  $_POST['company_code'];
	    		$rax['nilai'] = isset($_POST[$re->kode]) ? $_POST[$re->kode]:0;
		    	$rax['luas'] = isset($_POST[$re->kode.'_luas']) ? $_POST[$re->kode.'_luas']:0;
		    	$rax['ton_tebu'] = isset($_POST[$re->kode.'_ton_tebu']) ? $_POST[$re->kode.'_ton_tebu']:0;
		    	$rax['ton_hablur'] = isset($_POST[$re->kode.'_hablur']) ? $_POST[$re->kode.'_hablur']:0;
		    	$rax['ton_gula'] = isset($_POST[$re->kode.'_hablur']) ? ($_POST[$re->kode.'_hablur']*1.003):0;
		    	$rax['ton_gula_ptr'] = isset($_POST[$re->kode.'_gula_ptr']) ? $_POST[$re->kode.'_gula_ptr']:0;
		    	$rax['ton_gula_milik'] = isset($_POST[$re->kode.'_gumil']) ? $_POST[$re->kode.'_gumil']:0;
		    	$rax['plant_code'] = $plant;
		    	//var_dump($rax);
		    	$this->db->where('kode', $re->kode);
				$this->db->update('t_hapas_detail_copy', $rax);
			//}

				//
		}

	    }

	    redirect('thapas',301);
    }


    function ambildata(){
    	$sql1 = $this->db->query("SELECT kode,kode_plant_trasnfer,sum(ha) as ha,sum(ton) as ton,sum(hablur_total) as hablur_total,sum(gula_total) as gula_total, sum(gula_ptr) as gula_ptr,sum(gula_pg) as gula_pg from (SELECT IF(LEFT(kode_kat_lahan,5) = 'TS-ST','TS',IF(LEFT(kode_kat_lahan,5) = 'TS-SP','TR',LEFT(kode_kat_lahan,2))) AS kode,kode_plant_trasnfer,SUM(c.`ha_tertebang`) AS ha, 
SUM(e.`netto_final`)/1000 AS ton,
SUM(hablur_ari)/1000 AS hablur_total,
SUM(gula_total)/1000 AS gula_total,
SUM(gula_ptr)/1000 AS gula_ptr,
SUM(gula_pg)/1000 AS gula_pg
FROM t_spta a 
INNER JOIN t_selektor c ON c.`id_spta`=a.`id`
INNER JOIN t_timbangan e ON e.`id_spat`=a.`id`
INNER JOIN t_ari d ON d.`id_spta`=a.`id`
WHERE kode_plant_trasnfer != '' AND ISNULL(kode_plant_trasnfer) = false AND YEAR(tgl_spta) = '".CNF_TAHUNGILING."'
GROUP BY kode_kat_lahan,kode_plant_trasnfer) as cx group by kode,kode_plant_trasnfer ORDER BY kode_plant_trasnfer ASC")->result();

    	$sql2 = $this->db->query("SELECT kode,sum(ha) as ha,sum(ton) as ton,sum(hablur_total) as hablur_total,sum(gula_total) as gula_total, sum(gula_ptr) as gula_ptr,sum(gula_pg) as gula_pg from (SELECT IF(LEFT(kode_kat_lahan,5) = 'TS-ST','SPT',IF(LEFT(kode_kat_lahan,5) = 'TS-SP','TR',LEFT(kode_kat_lahan,2))) AS kode,kode_plant_trasnfer,SUM(c.`ha_tertebang`) AS ha, 
SUM(e.`netto_final`)/1000 AS ton,
SUM(hablur_ari)/1000 AS hablur_total,
SUM(gula_total)/1000 AS gula_total,
SUM(gula_ptr)/1000 AS gula_ptr,
SUM(gula_pg)/1000 AS gula_pg
FROM t_spta a 
INNER JOIN t_selektor c ON c.`id_spta`=a.`id`
INNER JOIN t_timbangan e ON e.`id_spat`=a.`id`
INNER JOIN t_ari d ON d.`id_spta`=a.`id`
WHERE (kode_plant_trasnfer = '' || ISNULL(kode_plant_trasnfer) || kode_plant_trasnfer = '".CNF_PLANCODE."') AND YEAR(tgl_spta) = '".CNF_TAHUNGILING."'
GROUP BY kode_kat_lahan) as cx group by kode")->result();

    	$sql3 = $this->db->query("SELECT  ROUND((kristal_total_sd*1.003)-gula_produksi_sd,3) AS shs_ex_ms_thnini,gula_produksi_sd,gula_ex_sisan_sd,tetes_produksi_sd,tetes_sisan_sd,tetes_sto_sd FROM `t_lap_harian_pengolahan_ptpn` ORDER BY hari_giling DESC LIMIT 1")->result();

    	$ax = array("transfer"=>$sql1,"murni"=>$sql2,"lp"=>$sql3);
    	echo json_encode($ax);
    }
	
	

}
