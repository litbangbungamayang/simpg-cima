<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tperiodegiling extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tperiodegiling';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tperiodegilingmodel');
		$this->model = $this->tperiodegilingmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tperiodegiling',
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
            		if($field == 'harga_gula' || $field == 'harga_tetes' || $field == 'netto_tebu_total' || $field == 'total_do' || $field == 'total_natura' || $field == 'total_tetes'){
            			$row[] = number_format($dt->$field,2);
            		}else if($field == 'status'){
            			$arx = array('0'=>'Buka','1'=>'Tutup');
            			$row[] = $arx[$dt->$field];
            		}else if($field == 'jenis_do'){
            			$arx = array('0'=>'90%-10%','1'=>'95%-5%','2'=>'100%');
            			$row[] = $arx[$dt->$field];
            		}else{
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
				}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1 ){
            	$btn .= '<a href='.site_url('tperiodegiling/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1 && $dt->status == 0){
            	$btn .= '<a href='.site_url('tperiodegiling/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1 && $dt->status == 0){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tperiodegiling/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('tperiodegiling/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('t_periode_do'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tperiodegiling/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_periode_do'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tperiodegiling/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}

	function prosesdo($periodid){
		$period = $this->db->query("SELECT * FROM t_periode_do WHERE id = '$periodid'")->row();
		if($period){
			//mencari do master
			$sqldeldo = $this->db->query("DELETE FROM t_do where id_periode = '$periodid'");
			$sqldeldo = $this->db->query("DELETE FROM t_do_detail where id_periode = '$periodid'");
			$sqldo = $this->db->query("SELECT 
SQL_NO_CACHE 
IF(kode_kat_lahan='TS-SP',1,0) AS jenis_do,
a.`kode_blok`,
a1.`id_petani_sap`,
a1.`kepemilikan`,
SUM(IFNULL(b1.`ha_tertebang`,0)) AS ha_tertebang,
a1.`luas_ha`,
sum(b.netto_final) as netto_tebu,
SUM(d.`gula_ptr`) AS gula_100,
SUM(d.`sembilanpuluh_persen`) AS gula_90,
SUM(d.`sepuluh_persen`) AS gula_10,
SUM(d.`tetes_ptr`) AS tetes_ptr,
IF(SUM(d.`sepuluh_persen`) > 0,1,0) AS is_natura
FROM t_spta a
INNER JOIN sap_field a1 ON a1.`kode_blok`=a.`kode_blok`
INNER JOIN t_timbangan b ON a.`id`=b.`id_spat`
INNER JOIN t_selektor b1 ON b1.`id_spta`=a.`id`
INNER JOIN t_meja_tebu c ON c.`id_spta`=a.`id`
INNER JOIN t_ari d ON d.`id_spta`=a.`id`
WHERE 0=0 AND (kode_kat_lahan = 'TS-SP' OR LEFT(kode_kat_lahan,2) = 'TR') AND a.`sbh_status`>3
AND a.`tgl_giling` BETWEEN '".$period->tgl_awal."' AND '".$period->tgl_akhir."'
GROUP BY a.`kode_blok`")->result();
			$no=0;
			foreach ($sqldo as $k) {
				$no++;
				$nogudang = '';
				$isnatura = 0;
				$gula100 = $k->gula_100;
				$gulanatura = 0;
				$gulado = 0;
				if($period->jenis_do == 0){
					//90-10%
					$isnatura = 1;
					$gulanatura = round($k->gula_100*10/100);
					$gulado = $gula100-$gulanatura;

				}else if($period->jenis_do == 1){
					//95-5%
					$isnatura = 1;
					$gulanatura = round($k->gula_100*5/100);
					$gulado = $gula100-$gulanatura;

				}else if($period->jenis_do == 2){
					//100%
					$isnatura = 0;
					$gulanatura = 0;
					$gulado = $gula100-$gulanatura;

				}
				if($isnatura == 1){
					$nogudang = str_pad($no,4,'0',STR_PAD_LEFT).''.str_pad($periodid,3,'0',STR_PAD_LEFT).'NTR'.CNF_TAHUNGILING;
				}
				$dt = array(
					'jenis_do'=>$k->jenis_do,
					'no_do'=> str_pad($no,4,'0',STR_PAD_LEFT).''.str_pad($periodid,3,'0',STR_PAD_LEFT).''.CNF_TAHUNGILING,
					'id_periode'=>$periodid,
					'kode_blok'=>$k->kode_blok,
					'id_petani_sap'=>$k->id_petani_sap,
					'ha_tergiling'=>$k->ha_tertebang,
					'netto_tebu'=>$k->netto_tebu,
					'ha_pokok'=>$k->luas_ha,
					'gula_100'=>$gula100,
					'gula_90'=>$gulado,
					'gula_10'=>$gulanatura,
					'harga_gula'=>$period->harga_gula,
					'berat_tetes'=>$k->tetes_ptr,
					'harga_tetes'=>$period->harga_tetes,
					'total_pendapatan'=>($gulado*$period->harga_gula)+($k->tetes_ptr*$period->harga_tetes),
					'total_potongan'=>0,
					'total_pendapatan_bersih'=>($gulado*$period->harga_gula)+($k->tetes_ptr*$period->harga_tetes),
					'user_act'=>$this->session->userdata('fid'),
					'tgl_act'=>date('Y-m-d H:i:s'),
					'status_do'=>0,
					'is_natura'=> $isnatura,
					'no_bon_gudang'=>$nogudang
				);

				$this->db->insert('t_do', $dt);
			}

			//rekap detail ke do detail
			$sqldetaildo = $this->db->query("INSERT INTO `t_do_detail` SELECT 
SQL_NO_CACHE
'' AS id,
".$periodid." as idperiod, 
a.`id` AS id_spta,
a.`kode_blok`,
a.`kode_kat_lahan`,
a.`no_spat`,
a.`id_petani_sap`,
b.`netto_final`,
a.`tgl_spta`,
a.`tgl_timbang`,
a.`tgl_giling`,
b1.`no_angkutan`,
b1.`ha_tertebang`,
IFNULL(IF(a.tebang_pg=0,0,(SELECT total_bersih FROM `t_upah_tebang_detail` WHERE id_spta=a.id)),0) AS pot_upah_tebang,
IFNULL(IF(a.angkut_pg=0,0,(SELECT total FROM `t_angkutan_detail` WHERE id_spta=a.id)),0) AS pot_upah_angkut,
c.`kondisi_tebu`,
d.`rendemen_ari`,
d.`gula_ptr`,
d.`sembilanpuluh_persen`,
d.`sepuluh_persen`,
d.`tetes_ptr`
FROM t_spta a
INNER JOIN sap_field a1 ON a1.`kode_blok`=a.`kode_blok`
INNER JOIN t_timbangan b ON a.`id`=b.`id_spat`
INNER JOIN t_selektor b1 ON b1.`id_spta`=a.`id`
INNER JOIN t_meja_tebu c ON c.`id_spta`=a.`id`
INNER JOIN t_ari d ON d.`id_spta`=a.`id`
WHERE 0=0 AND (kode_kat_lahan = 'TS-SP' OR LEFT(kode_kat_lahan,2) = 'TR') AND a.`sbh_status`>3
AND a.`tgl_giling` BETWEEN '".$period->tgl_awal."' AND '".$period->tgl_akhir."'");

			//update recap do
			$sqlrecap = $this->db->query("SELECT
			SUM(IF(jenis_do=0,netto_tebu,0)) AS netto_tebu_sbh,
			SUM(IF(jenis_do=1,netto_tebu,0)) AS netto_tebu_spt,
			SUM(netto_tebu) AS netto_tebu_total, 
SUM(IF(jenis_do=0,gula_90,0)) AS gula_do_sbh,
SUM(IF(jenis_do=0,1,0)) AS lembar_do_sbh,
SUM(IF(jenis_do=0,gula_10,0)) AS gula_natura_sbh,
SUM(IF(jenis_do=0,is_natura,0)) AS lembar_natura_sbh,
SUM(IF(jenis_do=1,gula_90,0)) AS gula_do_spt,
SUM(IF(jenis_do=1,1,0)) AS lembar_do_spt,
SUM(IF(jenis_do=1,gula_10,0)) AS gula_natura_spt,
SUM(IF(jenis_do=1,is_natura,0)) AS lembar_natura_spt,
SUM(IF(jenis_do=0,gula_90,0))*harga_gula AS rupiah_do_sbh,
SUM(IF(jenis_do=1,gula_90,0))*harga_gula AS rupiah_do_spt,
SUM(gula_90)*harga_gula AS total_do,
SUM(gula_10) AS total_natura,
SUM(IF(jenis_do=1,berat_tetes,0)) AS tetes_spt,
SUM(IF(jenis_do=0,berat_tetes,0)) AS tetes_sbh,
SUM(berat_tetes) AS total_tetes,
SUM(berat_tetes)*harga_tetes AS rupiah_total_tetes
FROM t_do WHERE id_periode =$periodid")->row();
			if($sqlrecap){
				$rt = array(
					'netto_tebu_sbh'=>$sqlrecap->netto_tebu_sbh,
					'netto_tebu_spt'=>$sqlrecap->netto_tebu_spt,
					'netto_tebu_total'=>$sqlrecap->netto_tebu_total,
					'gula_do_sbh'=>$sqlrecap->gula_do_sbh,
					'lembar_do_sbh'=>$sqlrecap->lembar_do_sbh,
					'gula_natura_sbh'=>$sqlrecap->gula_natura_sbh,
					'lembar_natura_sbh'=>$sqlrecap->lembar_natura_sbh,
					'gula_do_spt'=>$sqlrecap->gula_do_spt,
					'lembar_do_spt'=>$sqlrecap->lembar_do_spt,
					'gula_natura_spt'=>$sqlrecap->gula_natura_spt,
					'lembar_natura_spt'=>$sqlrecap->lembar_natura_spt,
					'rupiah_do_sbh'=>$sqlrecap->rupiah_do_sbh,
					'rupiah_do_spt'=>$sqlrecap->rupiah_do_spt,
					'total_do'=>$sqlrecap->total_do,
					'total_natura'=>$sqlrecap->total_natura,
					'tetes_spt'=>$sqlrecap->tetes_spt,
					'tetes_sbh'=>$sqlrecap->tetes_sbh,
					'total_tetes'=>$sqlrecap->total_tetes,
					'rupiah_total_tetes'=>$sqlrecap->rupiah_total_tetes
				);

				$this->db->where('id', $periodid);
				$this->db->update('t_periode_do', $rt);
			}
			$this->session->set_flashdata('message',SiteHelpers::alert('success',"DO Tergenerate ".$sqlrecap->lembar_do_sbh." Lembar DO SBH dan ".$sqlrecap->lembar_do_spt." Lembar DO SPT. Lihat Detail <a href='".site_url('tdo')."'>Klik disini</a>"));
		}else{
			$this->session->set_flashdata('message',SiteHelpers::alert('success',"DO tidak tergenerate.."));
		}
		redirect( 'tperiodegiling/show/'.$periodid,301);
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
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
				redirect( 'tperiodegiling/add/'.$ID,301);
			} else {
				redirect( 'tperiodegiling',301);
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
			$periodid = $_POST['id'];
			
		$this->model->destroy($_POST['id']);
			$sqldeldo = $this->db->query("DELETE FROM t_do where id_periode = '$periodid'");
			$sqldeldo = $this->db->query("DELETE FROM t_do_detail where id_periode = '$periodid'");
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}


}
