<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tkuotaspta extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tkuotaspta';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tkuotasptamodel');
		$this->model = $this->tkuotasptamodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tkuotaspta',
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
            	$btn .= '<a href='.site_url('tkuotaspta/show/'.$dt->$idku).'  class="tips "  title="Detail Order SPTA"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1 && $dt->tgl_spta >= date('Y-m-d')){
            	$btn .= '<a href='.site_url('tkuotaspta/add/'.$dt->$idku).'  class="tips "  title="Edit Kuota Harian"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1 && $dt->simpan == 0){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tkuotaspta/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Hapus Kuota Harian"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('tkuotaspta/index',$this->data, true );
		
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
		$rowdetail = $this->db->query("SELECT a.*,(SELECT IFNULL(SUM(kouta_tot),0) FROM t_spta_kuota_tot WHERE id_spta_kuota_kkw = a.id) as terpakai,b.`kode_affd`,b.`nama_afdeling`,c.`name` FROM `t_spta_kuota_kkw` a 
INNER JOIN `sap_m_affdeling` b ON a.id_affd=b.`id_affdeling`
INNER JOIN sap_m_karyawan c ON c.`Persno`=b.`Persno` WHERE a.id_spta_kuota='$id' ORDER BY b.kode_affd")->result();
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_spta_kuota'); 
		}

		$gid = $this->session->userdata('gid');
		$group = $this->db->query("select * from tb_groups where group_id = '".$gid."'")->row();
		$this->data['group'] = $group;
		$this->data['id'] = $id;
		$this->data['rowdetail'] = $rowdetail;
		$this->data['content'] =  $this->load->view('tkuotaspta/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	
	
	function getlistSptaKkw($id){
		$rowdetail = $this->db->query("SELECT a.*,(SELECT IFNULL(SUM(kouta_tot),0) FROM t_spta_kuota_tot WHERE id_spta_kuota_kkw = a.id) as terpakai,b.`kode_affd`,b.`nama_afdeling`,c.`name` FROM `t_spta_kuota_kkw` a 
INNER JOIN `sap_m_affdeling` b ON a.id_affd=b.`id_affdeling`
INNER JOIN sap_m_karyawan c ON c.`Persno`=b.`Persno` WHERE a.id_spta_kuota='$id' ORDER BY b.kode_affd")->result();
		$tmp = "";
		foreach($rowdetail as $rd){
			
        $tmp .= '<li><a href="javascript:getTables('.$rd->id.',\''.$rd->kode_affd.'\',\''.$rd->nama_afdeling.' - '.$rd->name.'\','.$rd->id_spta_kuota.')">'.$rd->nama_afdeling.' - '.$rd->name.'<span class="pull-right badge bg-red">'.($rd->kuota_spta-$rd->terpakai).'</span></a></li>';
				
		}
		echo $tmp;
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
			$this->data['row'] = $this->model->getColumnTable('t_spta_kuota'); 
			$this->data['row']['kode_plant']   = CNF_PLANCODE;
			$this->data['row']['tahun_giling'] = CNF_TAHUNGILING;
			$date = new DateTime('+1 day');
			$this->data['row']['tgl_spta'] = $date->format('Y-m-d');
			$this->data['row']['ptgs_input'] =$this->session->userdata('fid');
			$this->data['row']['tgl_input'] = date('Y-m-d H:i:s');
			$th = $this->db->query("SELECT ifnull(count(id),0) as ttl from t_spta_kuota WHERE tgl_spta = '".$date->format('Y-m-d')."'")->row();
			if($th->ttl > 0){
				$this->session->set_flashdata('message',SiteHelpers::alert('error'," Kuota SPTA Tgl <b>".$date->format('d M Y')."</b> Sudah Pernah diinputkan Silahkan Edit Data !"));
				redirect( 'tkuotaspta',301);

			}
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tkuotaspta/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}


	function addtoday( $id = null ) 
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
			$this->data['row'] = $this->model->getColumnTable('t_spta_kuota'); 
			$this->data['row']['kode_plant']   = CNF_PLANCODE;
			$this->data['row']['tahun_giling'] = CNF_TAHUNGILING;
			$date = new DateTime('+0 day');
			$this->data['row']['tgl_spta'] = $date->format('Y-m-d');
			$this->data['row']['ptgs_input'] =$this->session->userdata('fid');
			$this->data['row']['tgl_input'] = date('Y-m-d H:i:s');
			$th = $this->db->query("SELECT ifnull(count(id),0) as ttl from t_spta_kuota WHERE tgl_spta = '".$date->format('Y-m-d')."'")->row();
			if($th->ttl > 0){
				$this->session->set_flashdata('message',SiteHelpers::alert('error'," Kuota SPTA Tgl <b>".$date->format('d M Y')."</b> Sudah Pernah diinputkan Silahkan Edit Data !"));
				redirect( 'tkuotaspta',301);

			}
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tkuotaspta/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function getlistSptaKkwadd(){
		$tgl_spta = $_POST['tgl_spta'];
		$a = $this->db->query("SELECT 
  a.*,
  b.`name`,
  c.id AS id_kuota_spta,
  IFNULL(kuota_spta,0) AS quota 
FROM
  sap_m_affdeling a 
  INNER JOIN sap_m_karyawan b 
    ON a.`Persno` = b.`Persno` 
  LEFT JOIN (SELECT 
      id,kuota_spta,id_affd
    FROM
      t_spta_kuota_kkw 
    WHERE tgl_spta = '".$tgl_spta."') AS c ON c.id_affd=a.`id_affdeling` ORDER BY a.nama_afdeling")->result();
			$no=1;
			$html = '';
			foreach($a as $b){
				$html .='<input type="hidden" name="idquota['.$b->id_affdeling.']" value="'.$b->id_kuota_spta.'" />
				<tr>
				  <td>'.$no++.'</td>
				  <td>'.$b->nama_afdeling.'</td>
				  <td>'.$b->name.'</td>
				  <td><input type=\'text\' class=\'form-control input-sm number qto\' value=\''.$b->quota.'\' name=\'quota['.$b->id_affdeling.']\' onkeyup="hitung()"   /></td>
				  </tr>';
				  
			}
			
			echo $html;
	}
	
	
	function order($idkuotadetail = null,$petak = null,$idkuotakkw = null,$idkuota = null,$tglspta = null){
		$this->data['tgl_spta'] = $tglspta;
		$this->data['id_spta_kuota'] = $idkuota;
		$this->data['id_spta_kuota_kkw'] = $idkuotakkw;
		$this->data['kode_blok'] = $petak;
		$blk = $this->db->query('SELECT divisi,id_petani_sap,kepemilikan,jarak_blok_ke_pabrik FROM sap_field WHERE kode_blok="'.$petak.'"')->row();

		$jrk = $this->db->query('SELECT id_jarak FROM m_biaya_jarak WHERE '.$blk->jarak_blok_ke_pabrik.' BETWEEN km_min AND km_max ')->row();
		$this->data['afdeling'] = $blk->divisi;
		$this->data['id_petani_sap'] = $blk->id_petani_sap;
		$this->data['kategori'] = $blk->kepemilikan;
		$this->data['idjrk'] = '';
		if($jrk){
		$this->data['idjrk'] = $jrk->id_jarak;
	}
		$this->data['id'] = $idkuotadetail;

		echo $this->load->view('tkuotaspta/formorder',$this->data, true);	
	}
	
	function saveorder(){
		//var_dump($_POST);
		//CEK SISA
		$sisa = $this->db->query("SELECT kuota_spta,(SELECT IFNULL(SUM(kouta_tot),0) FROM t_spta_kuota_tot WHERE id_spta_kuota_kkw = a.id) as terpakai FROM `t_spta_kuota_kkw` a 
INNER JOIN `sap_m_affdeling` b ON a.id_affd=b.`id_affdeling`
INNER JOIN sap_m_karyawan c ON c.`Persno`=b.`Persno` WHERE a.id='".$_POST['id_spta_kuota_kkw']."'")->row();

		$ss = $sisa->kuota_spta-$sisa->terpakai;

		if($ss >= $_POST['kouta_tot']){




		$sql = "UPDATE t_spta_kuota_tot SET kouta_tot=kouta_tot+".$_POST['kouta_tot'].",ptgs_input='".$this->session->userdata('fid')."',tgl_input=now() where id='".$_POST['id']."'";
		$this->db->query($sql);
		$afftectedRows = $this->db->affected_rows();
		if($afftectedRows == 0){
			$tempdata = array(
				'tgl_spta' => $_POST['tgl_spta'],
				'kode_blok' => $_POST['kode_blok'],
				'kouta_tot' => $_POST['kouta_tot'],
				'tgl_input' => date('Y-m-d H:i:s'),
				'ptgs_input' => $this->session->userdata('fid'),
				'id_spta_kuota' => $_POST['id_spta_kuota'],
				'id_spta_kuota_kkw' => $_POST['id_spta_kuota_kkw']
			);
			
			$this->db->insert('t_spta_kuota_tot',$tempdata);
		}
		
		$sql = $this->db->query("UPDATE t_spta_kuota SET simpan=(SELECT SUM(kouta_tot) FROM t_spta_kuota_tot WHERE id_spta_kuota=".$_POST['id_spta_kuota'].") WHERE id='".$_POST['id_spta_kuota']."'");
		
		//input ke spta table
		for($i=0;$i<$_POST['kouta_tot'];$i++){
			$epdate = $_POST['tgl_spta'];
			if(CNF_COMPANYCODE == 'N011'){
				$tempdat = array(
					'kode_plant' => CNF_PLANCODE,
					'kode_blok' => $_POST['kode_blok'],
					'tgl_spta' => $_POST['tgl_spta'],
					'tgl_expired' => date('Y-m-d 05:59:59', strtotime($epdate. ' + 1 days')),
					'kode_affd' => $_POST['afdeling'],
					'persno_pta' => $_POST['persno_pta'],
					'id_petani_sap' => $_POST['id_petani_sap'],
					'kode_kat_lahan' => $_POST['kategori'],
					'tebang_pg' => $_POST['tebang_pg'],
					'angkut_pg' => $_POST['angkut_pg'],
					'kode_plant_trasnfer' => $_POST['transfer_dari'],
					'kode_plant_ke' => $_POST['transfer_ke'],
					'metode_tma' => $_POST['jenis_tebangan'],
					'buat_spta_status' => 1,
					'buat_spta_tgl' => date('Y-m-d H:i:s'),
					'vendor_angkut' => $_POST['vendor_id'],
					'jarak_id' => $_POST['jarak_id'],
					'jenis_spta' => $_POST['jenis_spta'],
					'natura_status' => $_POST['natura'],
					'spt_status' => $_POST['spt']
				);
			}else{
				$tempdat = array(
					'kode_plant' => CNF_PLANCODE,
					'kode_blok' => $_POST['kode_blok'],
					'tgl_spta' => $_POST['tgl_spta'],
					'tgl_expired' => date('Y-m-d 05:59:59', strtotime($epdate. ' + 1 days')),
					'kode_affd' => $_POST['afdeling'],
					'persno_pta' => $_POST['persno_pta'],
					'id_petani_sap' => $_POST['id_petani_sap'],
					'kode_kat_lahan' => $_POST['kategori'],
					'tebang_pg' => $_POST['tebang_pg'],
					'angkut_pg' => $_POST['angkut_pg'],
					'kode_plant_trasnfer' => $_POST['transfer_dari'],
					'kode_plant_ke' => $_POST['transfer_ke'],
					'metode_tma' => $_POST['jenis_tebangan'],
					'buat_spta_status' => 1,
					'buat_spta_tgl' => date('Y-m-d H:i:s'),
					'vendor_angkut' => $_POST['vendor_id'],
					'jarak_id' => $_POST['jarak_id'],
					'jenis_spta' => $_POST['jenis_spta']
				);
			}

			$this->db->insert('t_spta',$tempdat);
		}
		}else{
			echo "Error, Order SPTA tidak boleh lebih  sisa Kuota, Total tersisa $ss SPTA ";
		}
	}
	
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			
			$this->load->model('tkuotakkwmodel');
		
			foreach ($_POST['quota'] as $in => $val) {
				$tempdata = array(
					'tgl_spta'=> $_POST['tgl_spta'],
					'id_affd'=> $in,
					'id_spta_kuota'=> $ID,
					'kode_plant'=> CNF_PLANCODE,
					'kuota_spta'=> $val,
					'tgl_input'=> date('Y-m-d H:i:s'),
					'ptgs_input'=> $this->session->userdata('fid')
				);
				
				$this->tkuotakkwmodel->insertRowUpdate($tempdata , $_POST['idquota'][$in]);
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
				redirect( 'tkuotaspta/add/'.$ID,301);
			} else {
				redirect( 'tkuotaspta',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}
	
	function cetakspta($tgl,$pta,$kat){
		$wh = ' AND c.kepemilikan LIKE "'.$kat.'%"';
		if($kat == 'X') $wh = '';
		$wh .= " AND a.tgl_spta='$tgl' AND a.persno_pta='$pta'";
		
		$a = $this->db->query("SELECT no_spat,a.kode_blok,jenis_spta,tgl_spta,c.divisi,e.`karyawan`,d.`nama_petani`,f.`name` AS nama_pta,tgl_expired,tebang_pg,angkut_pg,metode_tma,IF(kode_plant_trasnfer!='',CONCAT(c.`deskripsi_blok`,' TRANSFER DARI ',kode_plant_trasnfer),IF(kode_plant_ke != '', CONCAT(c.`deskripsi_blok`,' TRANSFER KE ',kode_plant_ke),c.`deskripsi_blok`)) AS deskripsi_blok,c.`luas_tanam`,c.`periode`,c.`status_blok`,c.`kepemilikan`,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,v.nama_vendor,a.spt_status,a.natura_status, c.others 
FROM t_spta a 
INNER JOIN sap_field c ON a.kode_blok=c.`kode_blok` 
INNER JOIN vw_master_afdeling e ON e.`kode_affd`=c.`divisi`
INNER JOIN sap_m_karyawan f ON f.`Persno`=a.persno_pta
LEFT JOIN sap_petani d ON d.`id_petani_sap`=c.`id_petani_sap` 
LEFT JOIN m_vendor v ON v.id_vendor=a.`vendor_angkut`
WHERE 0=0 AND cetak_spta_status=0 $wh GROUP BY a.`id`")->result();
		$html = '';$i=1;
		foreach($a as $b){
			$this->data['row'] =$b; 
			//$this->data['barcode'] = '<img src="'.$this->generateBarcode($b->no_spat).'">';
			//for($i=0;$i<100;$i++){
				$html .= $this->load->view('tkuotaspta/cetakspta',$this->data, true);
			//}

			if($i == CNF_HAL){
				$html .= '<p style="page-break-after: always;">&nbsp;</p>';
				$i=0;
			}
			$i++;
		}
		
		$this->data['content'] = $html;
		$this->data['title'] = 'Cetak SPTA';
		$this->data['tgl'] = $tgl;
		$this->data['pta'] = $pta;
		$this->data['kat'] = $kat;
		$this->data['petak'] = '';
		$this->data['afd'] = '';
		$this->load->view('layouts/kosong', $this->data );
	}


	function cetaksptapetak($tgl,$petak){
		$wh = " AND a.tgl_spta='$tgl' AND a.kode_blok='$petak'";
		
		$a = $this->db->query("SELECT no_spat,a.kode_blok,jenis_spta,tgl_spta,c.divisi,e.`karyawan`,d.`nama_petani`,f.`name` AS nama_pta,tgl_expired,tebang_pg,angkut_pg,metode_tma,IF(kode_plant_trasnfer!='',CONCAT(c.`deskripsi_blok`,' TRANSFER DARI ',kode_plant_trasnfer),IF(kode_plant_ke != '', CONCAT(c.`deskripsi_blok`,' TRANSFER KE ',kode_plant_ke),c.`deskripsi_blok`)) AS deskripsi_blok,c.`luas_tanam`,c.`periode`,c.`status_blok`,c.`kepemilikan`,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,v.nama_vendor,a.spt_status,a.natura_status, c.others
        FROM t_spta a 
INNER JOIN sap_field c ON a.kode_blok=c.`kode_blok` 
INNER JOIN vw_master_afdeling e ON e.`kode_affd`=c.`divisi`
INNER JOIN sap_m_karyawan f ON f.`Persno`=a.persno_pta
LEFT JOIN sap_petani d ON d.`id_petani_sap`=c.`id_petani_sap` 
LEFT JOIN m_vendor v ON v.id_vendor=a.`vendor_angkut`
WHERE 0=0 AND cetak_spta_status=0 $wh GROUP BY a.`id`")->result();
		$html = '';$i=1;
		foreach($a as $b){
			$this->data['row'] =$b; 
			//$this->data['barcode'] = '<img src="'.$this->generateBarcode($b->no_spat).'">';
			//for($i=0;$i<100;$i++){
				$html .= $this->load->view('tkuotaspta/cetakspta',$this->data, true);
			//}

			if($i == CNF_HAL){
				$html .= '<p style="page-break-after: always;">&nbsp;</p>';
				$i=0;
			}
			$i++;
		}
		
		$this->data['content'] = $html;
		$this->data['title'] = 'Cetak SPTA';
		$this->data['tgl'] = $tgl;
		$this->data['pta'] = '';
		$this->data['kat'] = 'X';
		$this->data['petak'] = $petak;
		$this->data['afd'] = '';
		$this->load->view('layouts/kosong', $this->data );
	}


	function cetaksptaafd($tgl,$afd){
		$wh .= " AND a.tgl_spta='$tgl' AND c.divisi='$afd'";
		
		$a = $this->db->query("SELECT no_spat,a.kode_blok,jenis_spta,tgl_spta,c.divisi,e.`karyawan`,d.`nama_petani`,f.`name` AS nama_pta,tgl_expired,tebang_pg,angkut_pg,metode_tma,IF(kode_plant_trasnfer!='',CONCAT(c.`deskripsi_blok`,' TRANSFER DARI ',kode_plant_trasnfer),IF(kode_plant_ke != '', CONCAT(c.`deskripsi_blok`,' TRANSFER KE ',kode_plant_ke),c.`deskripsi_blok`)) AS deskripsi_blok,c.`luas_tanam`,c.`periode`,c.`status_blok`,c.`kepemilikan`,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,v.nama_vendor, c.others 
        FROM t_spta a 
INNER JOIN sap_field c ON a.kode_blok=c.`kode_blok` 
INNER JOIN vw_master_afdeling e ON e.`kode_affd`=c.`divisi`
INNER JOIN sap_m_karyawan f ON f.`Persno`=a.persno_pta
LEFT JOIN sap_petani d ON d.`id_petani_sap`=c.`id_petani_sap` 
LEFT JOIN m_vendor v ON v.id_vendor=a.`vendor_angkut`
WHERE 0=0 AND cetak_spta_status=0 $wh GROUP BY a.`id`")->result();
		$html = '';$i=1;
		foreach($a as $b){
			$this->data['row'] =$b; 
			//$this->data['barcode'] = '<img src="'.$this->generateBarcode($b->no_spat).'">';
			//for($i=0;$i<100;$i++){
				$html .= $this->load->view('tkuotaspta/cetakspta',$this->data, true);
			//}

			if($i == CNF_HAL){
				$html .= '<p style="page-break-after: always;">&nbsp;</p>';
				$i=0;
			}
			$i++;
		}
		
		$this->data['content'] = $html;
		$this->data['title'] = 'Cetak SPTA';
		$this->data['tgl'] = $tgl;
		$this->data['pta'] = '';
		$this->data['kat'] = 'X';
		$this->data['petak'] = '';
		$this->data['afd'] = $afd;
		$this->load->view('layouts/kosong', $this->data );
	}
	
	function updatestatuscetak(){
		if(isset($_POST['tgl_spta'])){
			$kat = $_POST['kat'];
			$tgl = $_POST['tgl_spta'];
			$pta = $_POST['pta'];
			$afd = $_POST['afd'];
			$petak = $_POST['petak'];
			$wh = "AND tgl_spta='$tgl'";
			
			if($kat != 'X') $wh .= " AND kode_kat_lahan LIKE '$kat%'";
			if($pta != '') $wh .= "  AND persno_pta='$pta'";
			if($afd != '') $wh .= "  AND kode_affd='$afd'";
			if($petak != '') $wh .= "  AND kode_blok='$petak'";
			
			
			
		$ax = $this->db->query("UPDATE t_spta 
		SET cetak_spta_status=1,cetak_spta_tgl=now() WHERE 0=0 $wh");

		$th = $this->db->query("SELECT COUNT(id) as ttl FROM t_spta WHERE cetak_spta_status=1 AND tgl_spta='$tgl'")->row();
			if($th){
				$row = $th->ttl;
				$this->db->query("UPDATE t_spta_kuota SET cetak=$row where tgl_spta='".$_POST['tgl_spta']."'");
				echo 'ok';
			}else{
				echo 'false';
			}
		}
	}
	
	function generateBarcode($kode){
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
	}

	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{ 
			echo "err : maaf anda tidak memiliki hak untuk menghapus data";
	  	}
			
		$this->model->destroy($_POST['id']);
		$this->db->query("DELETE FROM t_spta_kuota_kkw where id_spta_kuota=".$_POST['id']);
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}


}
