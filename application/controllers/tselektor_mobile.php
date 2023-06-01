<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tselektor_mobile extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tselektor_mobile';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tselektor_mobilemodel');
		$this->model = $this->tselektor_mobilemodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tselektor_mobile',
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
            	$btn .= '<a href='.site_url('tselektor_mobile/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('tselektor_mobile/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tselektor_mobile/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		//$this->data['content'] = $this->load->view('tselektor_mobile/index',$this->data, true );
		$this->data['content'] = $this->load->view('tselektor_mobile/form_mobile',$this->data, true );

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
			$this->data['row'] = $this->model->getColumnTable('t_selektor'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tselektor_mobile/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_selektor'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tselektor_mobile/form_mobile',$this->data, true );		
	  	$this->data['content'] = $this->load->view('tselektor_mobile/index',$this->data, true );
		$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		if(isset($_POST)){
			$data = $_POST;
			// setting tanggal spta //
			date_default_timezone_set('Asia/Jakarta');
			$tgl_spta = new DateTime(date("Y-m-d"));
			$tgl_expired = new DateTime(date("Y-m-d"));
			if(date("H") < 6){
				$tgl_spta->modify("-1 day");
				$tgl_expired->modify("-1 day");
			}
			$tgl_expired->modify("+1 day +5 hour +59 minutes +59 seconds")->format("Y-m-d H:i:s");
			$jenis_tebangan = "";
			switch($data["jenis_tebangan"]){
				case "MANUAL":
					$jenis_tebangan = 1;
					break;
				case "SEMI MEKANIS":
					$jenis_tebangan = 2;
					break;
				case "MEKANIS":
					$jenis_tebangan = 3;
					break;
				case "TRANSLOADING":
					$jenis_tebangan = 4;
					break;
			}
			//------------------------
			$dataSpta = array(
				'kode_plant' => CNF_PLANCODE,
				'kode_blok' => $data["kode_blok"],
				'tgl_spta' => $tgl_spta->format("Y-m-d"),
				'tgl_expired' => $tgl_expired->format("Y-m-d H:i:s"),
				'kode_affd' => $data["kode_afd"],
				'persno_pta' => $data["persno"],
				'id_petani_sap' => "0",
				'kode_kat_lahan' => $data['kategori'],
				'tebang_pg' => 1,
				'angkut_pg' => 1,
				'kode_plant_trasnfer' => "",
				'kode_plant_ke' => "",
				'metode_tma' => $jenis_tebangan,
				'buat_spta_status' => 1,
				'buat_spta_tgl' => date('Y-m-d H:i:s'),
				'vendor_angkut' => 1,
				'jarak_id' => 1,
				'jenis_spta' => "TRUK"
			);
			$dataSubmit = array(
				'kode_petak' => $data["kode_blok"],
				'persno_pta' => $data["persno"],
				'nomor_truk' => $data["no_angkutan"],
				'sisteb' => $jenis_tebangan,
				'tgl_tiket' => $data["tgl_do"],
				'jam_tiket' => $data["jam_do"],
				'tgl_tebang' => $data["tgl_tebang"],
				'jam_tebang' => $data["jam_tebang"],
				'posisi' => $data["posisi"],
				'luas' => $data["ha_tertebang"],
				'hijau' => $data["terbakar_sel"],
				'premi_penalti' => $data["no_trainstat"],
				'no_gl' => $data["no_st_gl"],
				'no_harvester' => $data["no_hv"],
				'username' => $data["username"] 
			);
			//var_dump($dataSubmit); die();
			$query = "select count(*) as jml from t_submit_qr where kode_petak = ? and tgl_tiket = ? and jam_tiket = ?";
			$result = $this->db->query($query, array($data["kode_blok"], $data["tgl_do"], $data["jam_do"]))->result();
			if($result[0]->jml > 0){
				header("Location: ".site_url('tselektor_mobile'));
				$this->session->set_flashdata('qr_error', 'Data SPTA tersebut sudah pernah masuk sebelumnya!');
				die();
			};
			//TODO: LANJUTKAN PROSES SUBMIT DATA MENTAH QR
			$this->db->insert('t_submit_qr', $dataSubmit);
			$this->db->insert('t_spta', $dataSpta);
			$insert_id_spta = $this->db->insert_id();
			
			/* ============ INSERT DATA SELEKTOR ============== */
			$tgl_tebang = $data["tgl_tebang"] . " " . $data["jam_tebang"] . ":00";
			$dataSelektor = array(
				'id_spta' => $insert_id_spta,
				'persno_mandor_tma' => $data["persno"],
				'tgl_tebang' => $tgl_tebang,
				'no_angkutan' => $data["no_angkutan"],
				'ptgs_angkutan' => $data["ptgs_angkutan"],
				'ha_tertebang' => $data["ha_tertebang"],
				'terbakar_sel' => $data["terbakar_sel"],
				'ditolak_sel' => $data["ditolak_sel"],
				'ditolak_alasan' => $data["ditolak_alasan"],
				'brix_sel' => $data["brix_sel"],
				'ph_sel' => $data["ph_sel"],
				'no_trainstat' => $data["no_trainstat"],
				'no_hv' => $data["no_hv"],
				'op_hv' => $data["op_hv"],
				'no_stipping' => $data["no_st_gl"],
				'op_stipping' => $data["op_st_gl"],
				'tgl_pintumasuk' => "0000-00-00 00:00:00",
				'ptgs_pintumasuk' => '0',
				'ptgs_selektor' => $this->session->userdata('fid'),
				'tgl_selektor' => date('Y-m-d H:i:s')
			);
			$this->db->insert('t_selektor', $dataSelektor);
			$insert_id_selektor = $this->db->insert_id();
			/* ================================================ */
			$this->cetakSpta($tgl_spta->format("Y-m-d"), $data["kode_blok"]);
			//$this->cetakSptaOnline($insert_id_spta);
		}
		
	}

	function cetakSpta($tgl_spta, $kode_blok){
		$wh = " AND a.tgl_spta='$tgl_spta' AND a.kode_blok='$kode_blok'";
		
		$a = $this->db->query("SELECT no_spat,a.kode_blok,jenis_spta,tgl_spta,c.divisi,e.`karyawan`,d.`nama_petani`,f.`name` AS nama_pta,tgl_expired,tebang_pg,angkut_pg,metode_tma,IF(kode_plant_trasnfer!='',CONCAT(c.`deskripsi_blok`,' TRANSFER DARI ',kode_plant_trasnfer),IF(kode_plant_ke != '', CONCAT(c.`deskripsi_blok`,' TRANSFER KE ',kode_plant_ke),c.`deskripsi_blok`)) AS deskripsi_blok,c.`luas_tanam`,c.`periode`,c.`status_blok`,c.`kepemilikan`,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,v.nama_vendor,a.spt_status,a.natura_status, c.others, sel.terbakar_sel, sel.ha_tertebang, sel.op_gl, sel.no_gl, sel.op_hv, sel.no_hv, sel.op_stipping, sel.no_stipping, sel.tgl_tebang, sel.no_angkutan, sel.ptgs_angkutan
					FROM t_spta a 
			INNER JOIN sap_field c ON a.kode_blok=c.`kode_blok` 
			INNER JOIN vw_master_afdeling e ON e.`kode_affd`=c.`divisi`
			INNER JOIN sap_m_karyawan f ON f.`Persno`=a.persno_pta
			INNER JOIN t_selektor sel on sel.id_spta = a.id
			LEFT JOIN sap_petani d ON d.`id_petani_sap`=c.`id_petani_sap` 
			LEFT JOIN m_vendor v ON v.id_vendor=a.`vendor_angkut`
			WHERE 0=0 AND cetak_spta_status=0 $wh GROUP BY a.`id`")->result();
		$html = '';$i=1;
		//var_dump($tgl_spta); die();
		foreach($a as $b){
			$this->data['row'] =$b; 
			//$this->data['barcode'] = '<img src="'.$this->generateBarcode($b->no_spat).'">';
			//for($i=0;$i<100;$i++){
				$html .= $this->load->view('tselektor_mobile/cetakspta',$this->data, true);
			//}

			if($i == CNF_HAL){
				$html .= '<p style="page-break-after: always;">&nbsp;</p>';
				$i=0;
			}
			$i++;
			
		}
		//var_dump($wh); die();
		$this->data['content'] = $html;
		$this->data['title'] = 'Cetak SPTA';
		$this->data['tgl'] = $tgl_spta;
		$this->data['pta'] = '';
		$this->data['kat'] = 'X';
		$this->data['petak'] = $kode_blok;
		$this->data['afd'] = '';
		$this->load->view('layouts/kosong_mobile', $this->data );
	
	}

	function cetakSptaOnline($id_spta){
		$query = "select 
				spta.no_spat,
				fld.kode_blok,
				fld.deskripsi_blok,
				if(spta.metode_tma = 1, 'MANUAL', if(spta.metode_tma = 2, 'SEMI MEKANIS', if(spta.metode_tma = 3, 'MEKANIS', 'TRANSLOADING'))) as txt_metode_tma,
				kary.name as nama_pta,
				sel.ptgs_angkutan,
				sel.ha_tertebang,
				sel.tgl_tebang,
				sel.op_hv,
				sel.no_hv,
				sel.op_stipping,
				sel.no_stipping,
				sel.op_gl,
				sel.no_gl,
				sel.no_trainstat as penalti
			from t_spta spta
			join t_selektor sel on spta.id = sel.id_spta
			join sap_field fld on fld.kode_blok = spta.kode_blok
			join sap_m_karyawan kary on kary.Persno = spta.persno_pta
			join vw_master_afdeling afd on afd.kode_affd = fld.divisi
			where spta.id = ?";
		$spta_result = $this->db->query($query, array($id_spta))->result();
		//var_dump($spta_result); die();
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

	function cektara(){
		$arr['stt'] = 0;
		if(isset($_POST['noreg'])){
			$cek = $this->db->query("SELECT no_pol,kategori, nama_supir, CONCAT(no_pol, '-', nama_supir) AS texts FROM `m_tara_truk`  WHERE no_pol = '".$_POST['noreg']."'")->row();
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

	function cekPetak(){
		if(isset($_POST['kode_petak'])){
			$kode_petak = $_POST['kode_petak'];
			$petak = $this->db->query("select * from sap_field where kode_blok = '".$kode_petak."'")->row();
			if($petak){
				echo json_encode($petak);
			}
		}
	}

	function cekBrix(){
		if(isset($_POST['kode_petak'])){
			$kode_petak = $_POST['kode_petak'];
			$petak = $this->db->query("select * from sap_field_spt where no_petak = '".$kode_petak."'")->row();
			if($petak){
				echo json_encode($petak);
			}
		}
	}

	function cekPta(){
		if(isset($_POST['kodePta'])){
			$kodePta = $_POST['kodePta'];
			$pta = $this->db->query("select * from sap_m_karyawan where persno = '".$kodePta."'")->row();
			if($pta){
				echo json_encode($pta);
			}
		}
	}

	function generateSpta(){
		if(isset($_POST)){
			$dataInput = $_POST;
			echo($dataInput);
			/*
			$dataSpta = array(
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
			*/
		}
	}


}
