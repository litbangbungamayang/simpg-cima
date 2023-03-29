<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tlapharpeng extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tlapharpeng';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tlapharpengmodel');
		$this->model = $this->tlapharpengmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tlapharpeng',
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
		
		//if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
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
            		if($field == 'status'){
            			if($dt->status == 1) $row[] = 'Buat';
            			else $row[] = 'Validasi';
            		}else{
            			$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
						$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('tlapharpeng/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            
            if($this->access['is_remove'] ==1 && $dt->status == 0){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tlapharpeng/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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

	function validasidata($id,$hg){
		$this->inputLogs("Validasi Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$hg);
		$this->db->query("UPDATE t_lap_harian_pengolahan_ptpn SET status = 2,tgl_validasi=NOW(),user_validasi='".$this->session->userdata('fid')."' WHERE id = $id");
		$this->session->set_flashdata('message',SiteHelpers::alert('success','Berhasil validasi data..'));
		$this->senddataserver($id);
			redirect('tlapharpeng/show/'.$id,301);
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
		
		$this->data['content'] = $this->load->view('tlapharpeng/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$row = $this->db->query("SELECT * FROM t_lap_harian_pengolahan_ptpn WHERE id='".$id."'")->row();
		if($row)
		{
			$this->data['rw'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_lap_harian_pengolahan'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tlapharpeng/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
		if($row->status == 2){
			//$this->senddataserver($id);
		}
	}


	function printxs( $id = null) 
	{ 
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		


		$row = $this->db->query("SELECT * FROM t_lap_harian_pengolahan_ptpn WHERE id='".$id."'")->row();
		if($row)
		{
			$this->data['rw'] =  $row;
			$this->inputLogs("Print Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$row->hari_giling);
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_lap_harian_pengolahan'); 
		}
		
		$this->data['id'] = $id;
		echo  $this->load->view('tlapharpeng/print', $this->data ,true);	  
		
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
			$this->data['row'] = $this->model->getColumnTable('t_lap_harian_pengolahan'); 
		}
		
		$this->data['id'] = $id;
    	$this->data['content'] = $this->load->view('tlapharpeng/form',$this->data, true );
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $_POST;
			//var_dump($data);die();
			$this->db->query("DELETE FROM t_lap_harian_pengolahan_ptpn WHERE plant_code='".$data['plant_code']."' AND hari_giling='".$data['hari_giling']."'");

			$data['tgl_created'] = date('Y-m-d H:i:s');
			$data['user_created'] = $this->session->userdata('fid');
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("Generate Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$data['hari_giling']);
			} else {
				$this->inputLogs("Generate Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$data['hari_giling']);
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tlapharpeng/add/'.$ID,301);
			} else {
				redirect( 'tlapharpeng',301);
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


	function getharitglgiling($hg){
    	//$hg=1;
		if($hg != 0){
			$hg = $hg-1;
			$sql = "SELECT '".($hg+1)."' as hg,DATE_ADD(DATE(IFNULL(awal_giling,NOW())),INTERVAL ".$hg." DAY) AS tgl FROM tb_setting";
			$r = $this->db->query($sql)->row();


			$pg = CNF_PLANCODE;
		//var_dump("WAKWAW");
			$colom = $this->db->query("SHOW COLUMNS FROM `t_lap_harian_pengolahan_ptpn`")->result();

			$sqldt = $this->db->query("SELECT 
  `id` AS `id`,
  `company_code` AS `company_code`,
  `plant_code` AS `plant_code`,
  `hari_giling` AS `hari_giling`,
  `tgl_giling` AS `tgl_giling`,
  `thn_giling` AS `thn_giling`,
  `kis_sd` AS `kis`,
  `kis_inc_sd` AS `kis_inc`,
  `kes_sd` AS `kes`,
  `ha_tebang_tr_sd` AS `ha_tebang_tr`,
  `ha_tebang_ts_sd` AS `ha_tebang_ts`,
  `ha_tebang_spt_sd` AS `ha_tebang_spt`,
  `ha_tebang_ts_saudara_sd` AS `ha_tebang_ts_saudara`,
  `ha_tebang_total_sd` AS `ha_tebang_total`,
  `ton_tebang_tr_sd` AS `ton_tebang_tr`,
  `ton_tebang_ts_sd` AS `ton_tebang_ts`,
  `ton_tebang_spt_sd` AS `ton_tebang_spt`,
  `ton_tebang_ts_saudara_sd` AS `ton_tebang_ts_saudara`,
  `ton_tebang_total_sd` AS `ton_tebang_total`,
  `ha_giling_tr_sd` AS `ha_giling_tr`,
  `ha_giling_ts_sd` AS `ha_giling_ts`,
  `ha_giling_spt_sd` AS `ha_giling_spt`,
  `ha_giling_ts_saudara_sd` AS `ha_giling_ts_saudara`,
  `ha_giling_total_sd` AS `ha_giling_total`,
  `ton_giling_tr_sd` AS `ton_giling_tr`,
  `ton_giling_ts_sd` AS `ton_giling_ts`,
  `ton_giling_spt_sd` AS `ton_giling_spt`,
  `ton_giling_ts_saudara_sd` AS `ton_giling_ts_saudara`,
  `ton_giling_total_sd` AS `ton_giling_total`,
  `kristal_tr_sd` AS `kristal_tr`,
  `kristal_ts_sd` AS `kristal_ts`,
  `kristal_spt_sd` AS `kristal_spt`,
  `kristal_ts_saudara_sd` AS `kristal_ts_saudara`,
  `kristal_total_sd` AS `kristal_total`,
  `rend_tr_sd` AS `rend_tr`,
  `rend_ts_sd` AS `rend_ts`,
  `rend_spt_sd` AS `rend_spt`,
  `rend_ts_saudara_sd` AS `rend_ts_saudara`,
  `rend_total_sd` AS `rend_total`,
  `gula_pg_ts_sd` AS `gula_pg_ts`,
  `gula_pg_spt_sd` AS `gula_pg_spt`,
  `gula_pg_eks_ts_saudara_sd` AS `gula_pg_eks_ts_saudara`,
  `gula_pg_eks_tr_sd` AS `gula_pg_eks_tr`,
  `gula_pg_total_sd` AS `gula_pg_total`,
  `gula_tr_bagihasil_sd` AS `gula_tr_bagihasil`,
  `gula_tr_ts_saudara_sd` AS `gula_tr_ts_saudara`,
  `gula_produksi_sd` AS `gula_produksi`,
  `gula_ex_sisan_sd` AS `gula_ex_sisan`,
  `sisan_diolah_sd` AS `sisan_diolah`,
  `raw_sugar_diolah_sd` AS `raw_sugar_diolah`,
  `gula_repro_thn_lalu_sd` AS `gula_repro_thn_lalu`,
  `gula_repro_thn_ini_sd` AS `gula_repro_thn_ini`,
  `tetes_produksi_sd` AS `tetes_produksi`,
  `tetes_sisan_sd` AS `tetes_sisan`,
  `tetes_sto_sd` AS `tetes_sto`,
  `tetes_ex_repro_sd` AS `tetes_ex_repro`,
  `tetes_total_sd` AS `tetes_total`,
  `tebu_terbakar_tr_sd` AS `tebu_terbakar_tr`,
  `tebu_terbakar_ts_sd` AS `tebu_terbakar_ts`,
  `tebu_terbakar_spt_sd` AS `tebu_terbakar_spt`,
  `tebu_terbakar_ts_saudara_sd` AS `tebu_terbakar_ts_saudara`,
  `tebu_terbakar_total_sd` AS `tebu_terbakar_total`,
  `jam_berhenti_a_sd` AS `jam_berhenti_a`,
  `jam_berhenti_b_sd` AS `jam_berhenti_b`,
  `total_jb_sd` AS `total_jb`,
  `jb_hr_sd` AS `jb_hr`,
  `jam_giling_sd` AS `jam_giling`,
  `jam_kampanye_sd` AS `jam_kampanye`,
  `jam_kampanye_hr_sd` AS `jam_kampanye_hr`,
  `jba_persen_jamgil_sd` AS `jba_persen_jamgil`,
  `jbb_persen_jamgil_sd` AS `jbb_persen_jamgil`,
  `total_persen_jamgil_sd` AS `total_persen_jamgil`,
  `pol_tebu_sd` AS `pol_tebu`,
  `ton_pol_tebu_sd` AS `ton_pol_tebu`,
  `persen_pol_tetes_sd` AS `persen_pol_tetes`,
  `ton_pol_tetes_sd` AS `ton_pol_tetes`,
  `k_dlm_tetes_sd` AS `k_dlm_tetes`,
  `ampas_ton_sd` AS `ampas_ton`,
  `persen_pol_ampas_sd` AS `persen_pol_ampas`,
  `pol_ampas_ton_sd` AS `pol_ampas_ton`,
  `k_dlm_ampas_sd` AS `k_dlm_ampas`,
  `blotong_ton_sd` AS `blotong_ton`,
  `persen_pol_blotong_sd` AS `persen_pol_blotong`,
  `pol_blotong_ton_sd` AS `pol_blotong_ton`,
  `k_dlm_blotong_sd` AS `k_dlm_blotong`,
  `pol_dlm_hasil_taksasi_ton_sd` AS `pol_dlm_hasil_taksasi_ton`,
  `pol_dlm_hasil_taksasi_persenpol_sd` AS `pol_dlm_hasil_taksasi_persenpol`,
  `pol_taksasi_ton_sd` AS `pol_taksasi_ton`,
  `ton_taksasi_tebu_sd` AS `ton_taksasi_tebu`,
  `pol_dlm_hasil_taksasi_xtebu_sd` AS `pol_dlm_hasil_taksasi_xtebu`,
  `ef_ov_sd` AS `ef_ov`,
  `k_dlm_total_sd` AS `k_dlm_total`,
  `ef_me_sd` AS `ef_me`,
  `ef_bhr_sd` AS `ef_bhr`,
  `ef_or_sd` AS `ef_or`,
  `residu_sd` AS `residu`,
  `bba_ton_sd` AS `bba_ton`,
  `bba_rupiah_sd` AS `bba_rupiah`,
  `icumsa_sd` AS `icumsa`,
  `sbh_tr_sd` AS `sbh_tr`,
  `sbh_tr_ts_saudara_sd` AS `sbh_tr_ts_saudara`,
  `sbh_ts_sd` AS `sbh_ts`,
  `sbh_ts_tr_sd` AS `sbh_ts_tr`,
  `sbh_ts_ts_saudara_sd` AS `sbh_ts_ts_saudara`,
  `status` AS `status` 
FROM
  `t_lap_harian_pengolahan_ptpn`  WHERE hari_giling = '".($hg)."' AND plant_code = '".$pg."'")->row();


$sqlhutanggula = "SELECT b.`kode_kat_lahan`,SUM(gula_ptr)/1000 AS gula_ptr,SUM(gula_pg)/1000 AS gulapg,SUM(a.`gula_total`)/1000 AS totalgula
FROM t_ari a INNER JOIN t_spta b ON b.`id`=a.`id_spta` 
WHERE b.`tgl_giling` <= '".$r->tgl."' 
GROUP BY b.`kode_kat_lahan`";
			$rwsqlhutang = $this->db->query($sqlhutanggula)->result();
			$gulaptr = 0;
			$gulamiliktssaudara = 0;
			$gulaspt = 0;
			$gulapgextr = 0;
			$gulapg = 0;
			$gulapgextssaudara = 0;
			foreach ($rwsqlhutang as $v) {
				if($v->kode_kat_lahan == 'TS-TR'){
					$gulamiliktssaudara += $v->gulapg;
				}else if($v->kode_kat_lahan == 'TS-SP'){
					$gulaspt += $v->gulapg;
					$gulaptr += $v->gula_ptr;
				}else if(substr($v->kode_kat_lahan,0,2) == 'TS'){
					$gulapg += $v->gulapg;
				}else{
					$gulaptr += $v->gula_ptr;
					$gulapgextr += $v->gulapg;
				}
			}


			/*query hari ini simpg*/
			$sqlhidigiling = $this->db->query("SELECT 
IF(b.`kode_kat_lahan` = 'TS-IP','TS-IP',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR'))) AS kode_kat_lahan,
ROUND(SUM(hablur_ari)/1000,3) AS kristal,SUM(c.`netto_final`)/1000 AS tebudigiling,
SUM(d.ha_tertebang) AS ha_digiling,
sum(IF(d.terbakar_sel = 1,c.netto_final,0))/1000 as tebuterbakar
 FROM t_ari a 
 INNER JOIN t_spta b ON b.`id`=a.`id_spta` 
 INNER JOIN t_timbangan c ON c.`id_spat`=b.`id`
 INNER JOIN t_selektor d ON d.id_spta = b.id
 INNER JOIN t_meja_tebu e ON e.id_spta = b.id
 WHERE b.tgl_giling ='".$r->tgl."'
GROUP BY IF(b.`kode_kat_lahan` = 'TS-IP','TS-IP',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR')))")->result();
			$tongilingts=0;$tongilingtr=0;$tongilingtransfer=0;$tongilingspt=0;
			$hagilingts=0;$hagilingtr=0;$hagilingtransfer=0;$hagilingspt=0;
			$hablurts=0;$hablurtr=0;$hablurtransfer=0;$hablurspt=0;
			$tebuterbakarts=0;$tebuterbakartr=0;$tebuterbakartransfer=0;$tebuterbakarspt=0;
			foreach ($sqlhidigiling as $k) {
				if($k->kode_kat_lahan == 'TS-IP'){
					$tongilingtransfer+= $k->tebudigiling;
					$hagilingtransfer+=$k->ha_digiling;
					$hablurtransfer+=$k->kristal;
					$tebuterbakartransfer+=$k->tebuterbakar;
				}else if($k->kode_kat_lahan == 'TS-SP'){
					$tongilingspt+= $k->tebudigiling;
					$hagilingspt+=$k->ha_digiling;
					$hablurspt+=$k->kristal;
					$tebuterbakarspt+=$k->tebuterbakar;
				}else if($k->kode_kat_lahan == 'TS'){
					$tongilingts+= $k->tebudigiling;
					$hagilingts+=$k->ha_digiling;
					$hablurts+=$k->kristal;
					$tebuterbakarts+=$k->tebuterbakar;
				}else if($k->kode_kat_lahan == 'TR'){
					$tongilingtr+= $k->tebudigiling;
					$hagilingtr+=$k->ha_digiling;
					$hablurtr+=$k->kristal;
					$tebuterbakartr+=$k->tebuterbakar;
				}
			}

			if($hg == 0){
            
            	$qry = "SELECT 
IF(b.`kode_kat_lahan` = 'TS-IP','TS-IP',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR'))) AS kode_kat_lahan,SUM(c.`netto_final`)/1000 AS tebuditebang,
SUM(d.ha_tertebang) AS ha_ditebang
 FROM  t_spta b  
 INNER JOIN t_timbangan c ON c.`id_spat`=b.`id`
 INNER JOIN t_selektor d ON d.id_spta = b.id
 WHERE b.tgl_timbang <= ? GROUP BY IF(b.`kode_kat_lahan` = 'TS-IP','TS-IP',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR')))";
            	$var_tgl = $r->tgl;
            $sqlhiditebang = $this->db->query($qry, array($var_tgl))->result();
            /*
				$sqlhiditebang = $this->db->query("SELECT 
IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR'))) AS kode_kat_lahan,SUM(c.`netto_final`)/1000 AS tebuditebang,
SUM(d.ha_tertebang) AS ha_ditebang
 FROM  t_spta b  
 INNER JOIN t_timbangan c ON c.`id_spat`=b.`id`
 INNER JOIN t_selektor d ON d.id_spta = b.id
 WHERE b.tgl_timbang <= '".$var_tgl."' GROUP BY IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR')))")->result();
			*/
            //$cekQry = $this->db->query("SELECT SUM(timb.netto)/1000 as jml FROM t_spta spta join t_timbangan timb on spta.id = timb.id_spat WHERE spta.tgl_timbang <= '".$r->tgl."'")->result();
            //$cekQry = $this->db->query($qry)->result();
            //var_dump($cekQry);
			}else{
				$sqlhiditebang = $this->db->query("SELECT 
IF(b.`kode_kat_lahan` = 'TS-IP','TS-IP',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR'))) AS kode_kat_lahan,SUM(c.`netto_final`)/1000 AS tebuditebang,
SUM(d.ha_tertebang) AS ha_ditebang
 FROM  t_spta b  
 INNER JOIN t_timbangan c ON c.`id_spat`=b.`id`
 INNER JOIN t_selektor d ON d.id_spta = b.id
 WHERE b.tgl_timbang ='".$r->tgl."'
GROUP BY IF(b.`kode_kat_lahan` = 'TS-IP','TS-IP',
IF(b.`kode_kat_lahan` = 'TS-SP','TS-SP',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR')))")->result();	
			};
			
			$tontebangts=0;$tontebangtr=0;$tontebangtransfer=0;$tontebangspt=0;
			$hatebangts=0;$hatebangtr=0;$hatebangtransfer=0;$hatebangspt=0;
			foreach ($sqlhiditebang as $k) {
				if($k->kode_kat_lahan == 'TS-IP'){
					$tontebangtransfer+= $k->tebuditebang;
					$hatebangtransfer+=$k->ha_ditebang;
				}else if($k->kode_kat_lahan == 'TS-SP'){
					$tontebangspt+= $k->tebuditebang;
					$hatebangspt+=$k->ha_ditebang;
				}else if($k->kode_kat_lahan == 'TS'){
					$tontebangts+= $k->tebuditebang;
					$hatebangts+=$k->ha_ditebang;
				}else if($k->kode_kat_lahan == 'TR'){
					$tontebangtr+= $k->tebuditebang;
					$hatebangtr+=$k->ha_ditebang;
				}
			}

			$skgsbh = array(
				'ha_tebang_tr'=>$hatebangtr,
				'ha_tebang_ts'=>$hatebangts,
				'ha_tebang_spt'=>$hatebangspt,
				'ha_tebang_ts_saudara'=>$hatebangtransfer,
				'ton_tebang_tr'=>$tontebangtr,
				'ton_tebang_ts'=>$tontebangts,
				'ton_tebang_spt'=>$tontebangspt,
				'ton_tebang_ts_saudara'=>$tontebangtransfer,
				'ha_giling_tr'=>$hagilingtr,
				'ha_giling_ts'=>$hagilingts,
				'ha_giling_spt'=>$hagilingspt,
				'ha_giling_ts_saudara'=>$hagilingtransfer,
				'ton_giling_tr'=>$tongilingtr,
				'ton_giling_ts'=>$tongilingts,
				'ton_giling_spt'=>$tongilingspt,
				'ton_giling_ts_saudara'=>$tongilingtransfer,
				'tebu_terbakar_ts'=>$tebuterbakarts,
				'tebu_terbakar_tr'=>$tebuterbakartr,
				'tebu_terbakar_spt'=>$tebuterbakarspt,
				'tebu_terbakar_ts_saudara'=>$tebuterbakartransfer,
				'kristal_tr'=>$hablurtr,
				'kristal_ts'=>$hablurts,
				'kristal_spt'=>$hablurspt,
				'kristal_ts_saudara'=>$hablurtransfer,
				'sbh_tr_sd' => $gulaptr,'sbh_tr_ts_saudara_sd' => $gulamiliktssaudara,'sbh_ts_sd' => $gulapg,'sbh_ts_tr_sd' => $gulapgextr,'sbh_ts_ts_saudara_sd' => $gulapgextssaudara,'sbh_spt_sd' => $gulaspt);



			$sqlskg = $this->db->query("SELECT * FROM t_lap_harian_pengolahan_ptpn WHERE hari_giling = '".($hg+1)."' AND plant_code = '".$pg."'")->row();
			$arr = array('head'=>$r,'col'=>$colom,'skg'=>$sqlskg,'yl'=>$sqldt,'skgsbh'=>$skgsbh);
        $cekQry = $this->db->query("SELECT SUM(netto) FROM t_timbangan")->result();
        	//var_dump($var_tgl);
			echo json_encode($arr);
			//echo json_encode($sqlhiditebang);
		}
	}


	function datacek($kode,$hg){
		$a = $this->db->query("SELECT id from t_lap_harian_pengolahan_ptpn where plant_code = '".$kode."' AND hari_giling='".$hg."' AND status != 1")->row();
		if($a){
			echo '0';
		}else{
			echo '0';
		}
	}


	function senddataserver($id){
		//if(CNF_COMPANYCODE == 'N011'){
		//	$hostx = '10.20.1.13';
		//}else{
			$hostx = 'devproduksi.ptpn11.co.id';
		//}
		$result = $this->db->query('SELECT * FROM t_lap_harian_pengolahan_ptpn WHERE id="'.$id.'"');
		$datax = json_encode($result->result());
		$result->free_result();

		$row = $result->row();

		$url= 'http://'.$hostx.'/simpgdb/index.php/Lapharian/uploadlap/'.$row->company_code.'/'.$row->plant_code.'/'.$row->hari_giling;
		//echo $url;
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POST, true);
	    $post = array(
	        "data" => base64_encode($datax)
	    );
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
	    $response = curl_exec($ch);
		
		
		// Check HTTP status code
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
				 //$a = $this->db->query("DELETE FROM tb_logs_sync_process WHERE id IN (".$idlog.")");
				// $a->free_result();
			break;
		  }
		}
		
	    echo $response;
	    curl_close($ch);
	}

}
