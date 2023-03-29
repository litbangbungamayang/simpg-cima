<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tpinjamanpetani extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tpinjamanpetani';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tpinjamanpetanimodel');
		$this->model = $this->tpinjamanpetanimodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tpinjamanpetani',
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
            		if($field == 'pokok_pinjaman'){
            			$row[] = number_format($dt->$field);
            		}else if($field == 'saldo_kredit'){
            			if($dt->$field == 0){
            				$row[] = '<span class="badge bg-green">'.number_format($dt->$field).'</span>';
            			}else{
            				$row[] = '<span class="badge bg-red">'.number_format($dt->$field).'</span>';
            			}
            		}else{
            			$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
						$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );	
            		}
            		
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('tpinjamanpetani/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1 && $dt->user_update == ''){
            	$btn .= '<a href='.site_url('tpinjamanpetani/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1 && $dt->user_update == ''){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tpinjamanpetani/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('tpinjamanpetani/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

	function cetakreport() 
	{
		header("Content-disposition: attachment; filename=REKAP_HUTANG_PETANI_".CNF_PG."_".date('Y_m_d').".xls");
        header("Content-Type: application/vnd.ms-excel");

		$sl = $this->db->query("SELECT * FROM vw_t_pinjaman_petani order by saldo_kredit DESC")->result();
		echo "<table style='width:100%'><thead>
		<tr><td colspan='10' align='center'>DATA PINJAMAN PETANI TAHUN GILING ".CNF_TAHUNGILING."</td></tr>
		<tr><td colspan='10' align='center'>".CNF_PG."</td></tr>
		<tr><td colspan='10' align='center'>SAMPAI DENGAN TANGGAL ".SiteHelpers::daterpt(date('Y-m-d'))."</td></tr>
		<tr>
		<th bgcolor='silver'>NO</th>
		<th bgcolor='silver'>NO PINJAMAN</th>
		<th bgcolor='silver'>TGL PENCAIRAN</th>
		<th bgcolor='silver'>PENYALUR</th>
		<th bgcolor='silver'>ID PETANI</th>
		<th bgcolor='silver'>NAMA PETANI</th>
		<th bgcolor='silver'>POKOK PINJAMAN</th>
		<th bgcolor='silver'>BUNGA</th>
		<th bgcolor='silver'>SISA PINJAMAN</th>
		<th bgcolor='silver'>UPDATE</th>
		</tr></thead><tbody>";
		$no=1;$totpokok = 0;$totall = 0;
		foreach ($sl as $key) {
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$key->no_pinjaman."</td>";
			echo "<td>".$key->penyalur."</td>";
			echo "<td>".$key->tgl_pencairan."</td>";
			echo "<td>".$key->id_petani_sap."</td>";
			echo "<td>".$key->nama_petani."</td>";
			echo "<td>".$key->pokok_pinjaman."</td>";
			echo "<td>".$key->bunga_per_tahun."</td>";
			echo "<td>".$key->saldo_kredit."</td>";
			echo "<td>".$key->last_update."</td>";
			echo "</tr>";
			$totall +=$key->saldo_kredit;
			$totpokok +=$key->pokok_pinjaman;
		}
		echo "<tr>";
			echo "<td bgcolor='yellow' colspan='6' style='text-align:center'>T O T A L</td>";
			echo "<td bgcolor='yellow'>".$totpokok."</td>";
			echo "<td bgcolor='yellow'></td>";
			echo "<td bgcolor='yellow'>".$totall."</td>";
			echo "<td bgcolor='yellow'></td>";
			echo "</tr>";
		echo "</tbody></table>";
	  
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
			$this->data['row'] = $this->model->getColumnTable('t_pinjaman_petani'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tpinjamanpetani/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}


	function cetak( $id = null) 
	{
		
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_pinjaman_petani'); 
		}
		
		$this->data['id'] = $id;
		echo $this->load->view('tpinjamanpetani/cetak', $this->data ,true);	 
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
			$this->data['row'] = $this->model->getColumnTable('t_pinjaman_petani'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tpinjamanpetani/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}

	function adddetail( $id_pinjaman,$id = null ) 
	{

		$row = $this->model->getRow( $id_pinjaman );
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_pinjaman_petani'); 
		}

		$rowdetail = $this->db->query("SELECT * FROM t_pinjaman_petani_detail where id='$id'")->row_array();
		if($rowdetail){
			$this->data['rowdetail'] =  $rowdetail;
		}else{
			$this->data['rowdetail'] = $this->model->getColumnTable('t_pinjaman_petani_detail'); 
		}
	
		$this->data['id'] = $id;
		echo $this->data['content'] = $this->load->view('tpinjamanpetani/formdetail',$this->data, true );		
	  	//$this->load->view('layouts/main', $this->data );
	
	}

	function showdo($x){
		$this->data['do'] = $this->db->query("SELECT * FROM vw_t_do WHERE no_do='$x'")->row();
		echo $this->data['content'] = $this->load->view('tdo/cetak90',$this->data, true );
	}

	function savedetail(){
		$d = $_POST;
		$no = $d['no_ref'];
		if($d['id']==''){
			$r = $this->db->query("SELECT IFNULL(MAX(id)+1,1) as id FROM t_pinjaman_petani_detail")->row();
			$no = str_pad($r->id,3,'0',STR_PAD_LEFT).'/'.$d['jenis_tx'].'/'.CNF_TAHUNGILING;
			$sisasaldo = ($d['sisa_saldo']-$d['nominal']);
			$saldoyl = $d['sisa_saldo'];
		}else{
			$sisasaldo = ($d['saldo_sebelumnya']-$d['nominal']);
			$saldoyl = $d['saldo_sebelumnya'];
		}
		
		$data = array(
			'tgl'			=>$d['tgl'],
			'jenis_tx'		=>$d['jenis_tx'],
			'no_ref'		=>$no,
			'id_pinjaman'	=>$d['id_pinjaman'],
			'id_petani_sap'	=>$d['id_petani_sap'],
			'kredit'		=>$d['nominal'],
			'saldo'			=>$sisasaldo,
			'saldo_sebelumnya'=>$saldoyl,
			'user_act'		=>$this->session->userdata('fid'),
			'tgl_act'		=>date('Y-m-d H:i:s'),
			'keterangan'	=>$d['keterangan']
		);

		if($d['id']==''){
			$this->db->insert('t_pinjaman_petani_detail',$data);
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Transaksi Berhasil ditambahkan ! No Ref ".$no));
			
		}else{
			$this->db->where('id',$d['id']);
			$this->db->update('t_pinjaman_petani_detail',$data);
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Transaksi Berhasil Dirubah ! No Ref ".$no));
			
		}

		$this->db->query("UPDATE t_pinjaman_petani SET saldo_kredit=$sisasaldo,last_update=NOW(),user_update='".$this->session->userdata('fid')."' where id=".$d['id_pinjaman']);
		redirect( 'tpinjamanpetani/show/'.$d['id_pinjaman'],301);
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();

			if($data['id'] ==''){
				$ds = $this->db->query("SELECT IFNULL(MAX(LEFT(no_pinjaman,3)*1)+1,1) AS nonex FROM t_pinjaman_petani")->row();
				$data['no_pinjaman'] = str_pad($ds->nonex,3,'0',STR_PAD_LEFT).'/'.CNF_PLANCODE.'/'.CNF_COMPANYCODE.'/'.CNF_TAHUNGILING;
			}

			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			// Input logs
			if( $data['id'] =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
				
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
				$this->db->query("DELETE from t_pinjaman_petani_detail where id=$ID");
			}
			$d = $data;
			$dat = array(
				'tgl'			=>$d['tgl_pencairan'],
				'jenis_tx'		=>1,
				'no_ref'		=>$d['no_pinjaman'],
				'id_pinjaman'	=>$ID,
				'id_petani_sap'	=>$d['id_petani_sap'],
				'debet'			=>$d['saldo_kredit'],
				'saldo'			=>$d['saldo_kredit'],
				'saldo_sebelumnya'=>0,
				'user_act'		=>$this->session->userdata('fid'),
				'tgl_act'		=>date('Y-m-d H:i:s')
			);
			$this->db->insert('t_pinjaman_petani_detail',$dat);
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tpinjamanpetani/add/'.$ID,301);
			} else {
				redirect( 'tpinjamanpetani',301);
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
		$this->db->query("DELETE FROM t_pinjaman_petani_detail WHERE id_pinjaman='".$_POST['id']."'");
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}


}
