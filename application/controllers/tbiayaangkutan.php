<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tbiayaangkutan extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tbiayaangkutan';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tbiayaangkutanmodel');
		$this->model = $this->tbiayaangkutanmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tbiayaangkutan',
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

	function grids($tgl1,$tgl2){
		
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
            		$filter .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

        if($filter != '') $filter .= ')';

        $filter .= " AND tgl BETWEEN '$tgl1' AND '$tgl2'";

        $vendor = $_GET['vendor'];
        if($vendor != '') $filter .= " AND vendor_id = $vendor";

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
		$data = array();$no=0;$stt = array('0'=>'Buat','1'=>'Validasi','2'=>'SAP');
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		if($field == 'total') {
            			$row[] = number_format($dt->$field);
            		}else if($field == 'status') {
            			$row[] = $stt[$dt->status];
            		}else{
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
				}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('tbiayaangkutan/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1 && $dt->status == 0){
            	$btn .= '<a href='.site_url('tbiayaangkutan/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            	$btn .= '<a href="javascript:validasiupahangkutan('.$dt->$idku.')"  class="tips "  title="Validasi"><i class="fa  fa-check"></i> Validasi </a> &nbsp;&nbsp;';

            }
            if($this->access['is_remove'] ==1 && $dt->status == 0){
            	$btn .= '<br /><a href="#" onclick="ConfirmDelete(\''.site_url('tbiayaangkutan/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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

	function printbukti($tgl1,$tgl2){

		$filter = " WHERE 0=0 AND tgl BETWEEN '$tgl1' AND '$tgl2'";
        
        $vendor = $_GET['vendor'];

        if($vendor != '') $filter .= " AND vendor_id = '$vendor'";

        $sql =$this->db->query("SELECT id FROM t_angkutan $filter")->result();
        $htm = '';
        foreach ($sql as $key) {
        	$htm .= $this->printoutbukti($key->id);
        }

        $this->data['content'] = $htm;
        $this->data['title'] = 'Cetak Bukti Upah Angkutan';
		$this->load->view('layouts/kosongCetakulang', $this->data );
	}


	function validasi($id){
		if($id != ''){
			$this->db->query('UPDATE t_angkutan SET status=1 WHERE id='.$id);
			redirect('tbiayaangkutan/show/'.$id,301);	
		}else{
			redirect('tbiayaangkutan',301);
		}
	}

	function validasiajax($id){
		if($id != ''){
			$this->db->query('UPDATE t_angkutan SET status=1 WHERE id='.$id);
			//redirect('tbiayaangkutan/show/'.$id,301);	
			echo "Berhasil validasi ID : ".$id;
		}else{
			echo "Gagal validasi, Karena gagal mengambil ID";
		}
	}

	function printoutbukti( $id = null) 
	{
		
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
			$sql = "SELECT a.id,a.no_spat,a.kode_blok,sf.`deskripsi_blok`,a.vendor_angkut,c.`no_angkutan`,DATE_FORMAT(a.timb_netto_tgl,'%d/%m/%Y Jam %H:%i') AS txt_tgl_timb,
a.timb_netto_tgl AS tgl_timbang,b.`netto`,d.`keterangan`,d.`biaya` AS tarif,(d.`biaya`*b.`netto`) AS jumlah,e.total FROM t_spta a 
INNER JOIN sap_field sf ON sf.`kode_blok`=a.kode_blok
INNER JOIN t_selektor c ON c.`id_spta`=a.id
INNER JOIN t_timbangan b ON a.id=b.`id_spat` 
INNER JOIN m_biaya_jarak d ON d.`id_jarak`=a.jarak_id
inner join t_angkutan_detail e ON e.id_spta=a.id
WHERE e.angkutan_id=$id";
			$this->data['detail'] =  $this->db->query($sql)->result();
		} 
		
		$this->data['id'] = $id;
		return $this->load->view('tbiayaangkutan/printout', $this->data ,true);	  
		
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
		
		$this->data['content'] = $this->load->view('tbiayaangkutan/index',$this->data, true );
		
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
			$sql = "SELECT a.id,a.no_spat,a.kode_blok,sf.`deskripsi_blok`,a.vendor_angkut,c.`no_angkutan`,DATE_FORMAT(a.timb_netto_tgl,'%d/%m/%Y Jam %H:%i') AS txt_tgl_timb,
a.timb_netto_tgl AS tgl_timbang,b.`netto`,d.`keterangan`,d.`biaya` AS tarif,(d.`biaya`*b.`netto`) AS jumlah,e.total FROM t_spta a 
INNER JOIN sap_field sf ON sf.`kode_blok`=a.kode_blok
INNER JOIN t_selektor c ON c.`id_spta`=a.id
INNER JOIN t_timbangan b ON a.id=b.`id_spat` 
INNER JOIN m_biaya_jarak d ON d.`id_jarak`=a.jarak_id
inner join t_angkutan_detail e ON e.id_spta=a.id
WHERE e.angkutan_id=$id";
			$this->data['detail'] =  $this->db->query($sql)->result();

		} else {
			$this->data['row'] = $this->model->getColumnTable('t_angkutan'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tbiayaangkutan/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}


	function downloadexcel($tgl1,$tgl2){

		$filter = " WHERE 0=0 AND a.tgl BETWEEN '$tgl1' AND '$tgl2' AND a.status > 0";

		$sql = "SELECT a.id,DATE_FORMAT(a.tgl,'%d%m%Y') AS katdate,DATE_FORMAT(a.tgl,'%Y%m%d') AS documentdate,DATE_FORMAT(a.tgl,'%c') AS postingmonth,c.`jenis_spta`,c.`kode_blok`,SUM(b.`total`) AS total,d.`kode_vendor`,c.`id_petani_sap`,c.kode_kat_lahan as kepemilikan,LEFT(c.kode_kat_lahan,2) as katkode
FROM t_angkutan a 
INNER JOIN t_angkutan_detail b ON a.`id`=b.`angkutan_id`
INNER JOIN t_spta c ON c.`id`=b.`id_spta` 
INNER JOIN m_vendor d ON d.`id_vendor`=c.`vendor_angkut` $filter
GROUP BY a.`tgl`,c.`jenis_spta`,c.`kode_blok`";
		$this->data['rows'] = $this->db->query($sql)->result();


		$files = "UA-".$tgl1.'-'.date('His');

		$this->db->query("UPDATE t_angkutan a SET a.status=2 $filter");

		$this->inputLogs("Upah Angkut Tgl ".$tgl1." Generate Excel files menjadi ".$files.".xls");

		header("Content-Type: application/xls");    
		header("Content-Disposition: attachment; filename=$files.xls");  
		header("Pragma: no-cache"); 
		header("Expires: 0");

		echo $this->load->view('tbiayaangkutan/templatesap', $this->data ,true);
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
			$this->data['row'] = $this->model->getColumnTable('t_angkutan'); 
			$this->data['row']['tgl'] = date('Y-m-d');
			$this->data['row']['tgl_awal'] = date('Y-m-d');
			$this->data['row']['tgl_akhir'] = date('Y-m-d');
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tbiayaangkutan/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		//var_dump($_POST);die();
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data['tgl_act'] = date('Y-m-d H:i:s');
			$data['user_act'] = $this->session->userdata('fid');
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));

			$this->db->query("DELETE FROM t_angkutan_detail where angkutan_id = '".$ID."'");
			$this->db->query("UPDATE t_spta a SET a.`upah_angkut_status`=0,a.`upah_angkut_tgl` = NULL WHERE a.`upah_angkut_status`='".$ID."'");
			
			foreach($_POST['idspta'] as $f=>$r){
				
				$ar = array(
				'angkutan_id'=>$ID,
				'id_spta'=>$_POST['idspta'][$f],
				'id_biaya'=>$_POST['tarif'][$f],
				'netto'=>$_POST['netto'][$f],
				'biaya'=>$_POST['tarif_n'][$f],
				'total'=>$_POST['jmlh'][$f]
				);
				
				$this->db->insert('t_angkutan_detail',$ar);
				$this->db->query("UPDATE t_spta SET jarak_id = ".$_POST['tarif'][$f]." WHERE id=$r");
			}
			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}

			$this->db->query("UPDATE t_spta a INNER JOIN t_angkutan_detail b ON a.`id`=b.`id_spta`
SET a.`upah_angkut_status`=".$ID.",a.`upah_angkut_tgl` = NOW() WHERE b.`angkutan_id`='".$ID."'");
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			
			redirect( 'tbiayaangkutan/show/'.$ID,301);
					
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function generateSelect($id){
		$htm = '';
		$d = $this->db->query("SELECT id_jarak,keterangan,biaya FROM `m_biaya_jarak` ORDER BY km_min")->result();
		foreach ($d as $kp) {
			if($kp->id_jarak == $id){
			$htm .= '<option value="'.$kp->id_jarak.'"  selected biaya="'.$kp->biaya.'">'.$kp->keterangan.'</option>';
		}else{
			$htm .= '<option value="'.$kp->id_jarak.'"  biaya="'.$kp->biaya.'">'.$kp->keterangan.'</option>';
		}
		}

		return $htm;
	}


	function getDetailEdit(){
		$id_angkutan = $_POST['id_angkutan'];
		$sql = "SELECT a.id,a.no_spat,a.kode_blok,sf.`deskripsi_blok`,a.vendor_angkut,c.`no_angkutan`,DATE_FORMAT(a.timb_netto_tgl,'%d/%m/%Y Jam %H:%i') AS txt_tgl_timb,d.id_jarak,
a.timb_netto_tgl AS tgl_timbang,c.`no_angkutan`,b.`netto`,d.`keterangan`,d.`biaya` AS tarif,(d.`biaya`*b.`netto`) AS jumlah FROM t_spta a 
INNER JOIN sap_field sf ON sf.`kode_blok`=a.kode_blok
INNER JOIN t_selektor c ON c.`id_spta`=a.id
INNER JOIN t_timbangan b ON a.id=b.`id_spat` 
INNER JOIN m_biaya_jarak d ON d.`id_jarak`=a.jarak_id
WHERE a.timb_netto_status = 1 AND a.upah_angkut_status = $id_angkutan";

		$th = $this->db->query($sql)->result();
		$htm = array('msg'=>0);
		$dt = '';
		foreach($th as $tf){
			$dt .= "<tr id='".$tf->id."'>
				<td><i class='fa fa-trash' onclick='remrow(".$tf->id.")'></i></td>
				<td>  
				<input type='hidden' name='idspta[]' id='idspta-".$tf->id."' value='".$tf->id."' />
				<input type='hidden' name='netto[]' id='netto-".$tf->id."' value='".$tf->netto."' />
				 ".$tf->txt_tgl_timb." </td>
				<td><input type='text' readonly value='".$tf->no_spat."' class='dataselect' /> </td>
				<td> ".$tf->kode_blok." </td>
				<td> ".$tf->deskripsi_blok." </td>
				<td> ".$tf->no_angkutan." </td>
				<td class='number'> ".number_format($tf->netto,0)." </td>
				<td> 

				<select style='width:100px;height:25px' onchange='changebiaya(".$tf->id.")' name='tarif[]' id='tarif-".$tf->id."' >".$this->generateSelect($tf->id_jarak)."</select> </td>
				<td ><input type='text' class='form-control input-sm number' style='width:100px;height:25px'  readonly name='tarif_n[]' id='tarif_n-".$tf->id."' value='".$tf->tarif."' /></td>
				<td ><input type='text' class='form-control input-sm number jmlh' readonly name='jmlh[]'  id='jmlh-".$tf->id."' value='".$tf->jumlah."' /></td>
			  </tr>";
		}

		if($dt != ''){
			$htm = array('msg'=>1,'nospta'=>'','row'=> $dt);
		}
		
		echo json_encode($htm);
	}
	
	function getDetail(){
		$vendor = $_POST['vendor'];
		$tglawal = $_POST['tglawal'];
		$tglakhir = $_POST['tglakhir'];
		$nospta = $_POST['nospta'];
		$wh = '';
		if($nospta != ''){
			$wh = "  AND a.no_spat='$nospta'";
		}
		
		  $sql = "SELECT a.id,a.no_spat,a.kode_blok,sf.`deskripsi_blok`,a.vendor_angkut,c.`no_angkutan`,DATE_FORMAT(a.timb_netto_tgl,'%d/%m/%Y Jam %H:%i') AS txt_tgl_timb,d.id_jarak,
a.timb_netto_tgl AS tgl_timbang,c.`no_angkutan`,b.`netto`,d.`keterangan`,d.`biaya` AS tarif,(d.`biaya`*b.`netto`) AS jumlah FROM t_spta a 
INNER JOIN sap_field sf ON sf.`kode_blok`=a.kode_blok
INNER JOIN t_selektor c ON c.`id_spta`=a.id
INNER JOIN t_timbangan b ON a.id=b.`id_spat` 
LEFT JOIN m_biaya_jarak d ON d.`id_jarak`=a.jarak_id
WHERE a.timb_netto_status = 1 AND a.upah_angkut_status = 0 AND a.angkut_pg=1 AND a.vendor_angkut=$vendor $wh AND date(a.tgl_timbang) BETWEEN '$tglawal' AND '$tglakhir' GROUP BY a.id";

		$th = $this->db->query($sql)->result();
		$htm = array('msg'=>0);
		$dt = '';

		


		foreach($th as $tf){

			if($nospta != ''){

			$htm = array('msg'=>1,'nospta'=>$nospta,'row'=>"<tr id='".$tf->id."'>
				<td><i class='fa fa-trash' onclick='remrow(".$tf->id.")'></i></td>
				<td>  
				<input type='hidden' name='idspta[]' id='idspta-".$tf->id."' value='".$tf->id."' />
				<input type='hidden' name='netto[]' id='netto-".$tf->id."' value='".$tf->netto."' />
				 ".$tf->txt_tgl_timb." </td>
				<td><input type='text' readonly value='".$tf->no_spat."' class='dataselect' /> </td>
				<td> ".$tf->kode_blok." </td>
				<td> ".$tf->deskripsi_blok." </td>
				<td> ".$tf->no_angkutan." </td>
				<td class='number'> ".number_format($tf->netto,0)." </td>
				<td> <select style='width:100px;height:25px' onchange='changebiaya(".$tf->id.")' name='tarif[]' id='tarif-".$tf->id."' >".$this->generateSelect($tf->id_jarak)."</select> </td>
				<td ><input type='text' class='form-control input-sm number' style='width:100px;height:25px'  readonly name='tarif_n[]' id='tarif_n-".$tf->id."' value='".$tf->tarif."' /></td>
				<td ><input type='text' class='form-control input-sm number jmlh' readonly name='jmlh[]'  id='jmlh-".$tf->id."' value='".$tf->jumlah."' /></td>
			  </tr>");
		}else{
			$dt .= "<tr id='".$tf->id."'>
				<td><i class='fa fa-trash' onclick='remrow(".$tf->id.")'></i></td>
				<td>  
				<input type='hidden' name='idspta[]' id='idspta-".$tf->id."' value='".$tf->id."' />
				<input type='hidden' name='netto[]' id='netto-".$tf->id."' value='".$tf->netto."' />
				 ".$tf->txt_tgl_timb." </td>
				<td><input type='text' readonly value='".$tf->no_spat."' class='dataselect' /> </td>
				<td> ".$tf->kode_blok." </td>
				<td> ".$tf->deskripsi_blok." </td>
				<td> ".$tf->no_angkutan." </td>
				<td class='number'> ".number_format($tf->netto,0)." </td>
				<td> <select style='width:100px;height:25px' onchange='changebiaya(".$tf->id.")' name='tarif[]' id='tarif-".$tf->id."' >".$this->generateSelect($tf->id_jarak)."</select> </td>
				<td ><input type='text' class='form-control input-sm number' style='width:100px;height:25px'  readonly name='tarif_n[]' id='tarif_n-".$tf->id."' value='".$tf->tarif."' /></td>
				<td ><input type='text' class='form-control input-sm number jmlh' readonly name='jmlh[]'  id='jmlh-".$tf->id."' value='".$tf->jumlah."' /></td>
			  </tr>";
		}

		}

		if($dt != ''){
			$htm = array('msg'=>1,'nospta'=>'','row'=> $dt);
		}
		
		echo json_encode($htm);
	}

	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{ 
			echo "err : maaf anda tidak memiliki hak untuk menghapus data";
	  	}
			
		$this->model->destroy($_POST['id']);
		$this->db->query("DELETE FROM t_angkutan_detail WHERE angkutan_id = '".$_POST['id']."'");
		$this->db->query("UPDATE t_spta SET upah_angkut_status=0,upah_angkut_tgl='' where upah_angkut_status = '".$_POST['id']."'");
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}

	 


}
