<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tevaluasitebang extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tevaluasitebang';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tevaluasitebangmodel');
		$this->model = $this->tevaluasitebangmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tevaluasitebang',
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
	
	
	function gridsLain(){
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
            	$sort = $this->col[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

     //   $filterx = " AND divisi = '$afd'";

        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

        if($filter != '')  $filter .= ')';
      //  $filter .= $filterx;

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
            for ($i=0; $i < count($this->col) ; $i++) { 
			
            		$field = $this->col[$i+1];
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
          //  if($dt->aff_tebang == 0){
            	$btn .= '<a href="javascript:details(\''.$dt->$idku.'\','.$dt->luas_ha.')" class="tips "  title="Detail"><i class="fa  fa-search"></i> Detail </a>';
          //  }
            	
            
           
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

	function grids($afd){
		
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
            	$sort = $this->col[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

        $filterx = " AND divisi = '$afd'";

        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

        if($filter != '')  $filter .= ')';
        $filter .= $filterx;

		$params = array(
			'limit'		=> $_POST['start'],
			'page'		=> $_POST['length'],
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRownew( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            for ($i=0; $i < count($this->col) ; $i++) { 
			
            		$field = $this->col[$i+1];
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
          //  if($dt->aff_tebang == 0){
            	$btn .= '<a href="javascript:details(\''.$dt->$idku.'\','.$dt->luas_ha.')" class="tips "  title="Detail"><i class="fa  fa-search"></i> Detail </a>';
          //  }
            	
            
           
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
		$this->data['rowdetail'] = $this->model->getafd();
		// Render into template
		
		$this->data['content'] = $this->load->view('tevaluasitebang/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function details() 
	{
		$kodeblok = $_POST['kode_blok'];
		$luasha = $_POST['luasha'];
		
		$wh = " AND a.kode_blok='$kodeblok'";
		
		$sql = "SELECT a.id,a.`no_spat`,a.tgl_spta,tgl_timbang,c.`netto` as netto_final,a.`jenis_spta`,
		a.selektor_tgl,b.ha_tertebang,b.tanaman_status
		 FROM t_spta a
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN t_selektor b on b.id_spta = a.id
WHERE a.`timb_netto_status` = 1 $wh GROUP BY a.id";
		
		$th = $this->db->query($sql)->result();
		$htm = "<tr><td colspan='8' style='text-align:center'>
		<input type='hidden' value='$kodeblok' id='kodeblok1' name='kodeblok' />
		<input type='hidden' value='$luasha' id='luasha1'  />
		<b>PETAK $kodeblok</b></td></tr>";
		$no=1;

		$havalid = 0;
		$habelum = 0;
		$ton = 0;

		$arter = array('1'=>'Ya','0'=>'Tidak');
				$arterx = array('1'=>'Manual','2'=>'Semi Mekanisasi','3'=>'Mekanisasi');
		foreach($th as $tb){
			if($tb->tanaman_status == 1){
				$havalid += $tb->ha_tertebang;
			}else{
				$habelum += $tb->ha_tertebang;
			}
			$ton += $tb->netto_final;
			$r = '';
			$htm .= "<tr>";
			
				$htm .= "<td>".$no."</td>";
				
				$no++;
				
			if($tb->tanaman_status == 1){
				$htm .= "<td><a href='".$r."' class='addrowall'><i class='fa fa-check'></i></a></td>";
				$htm .=  "
				<td>".$tb->no_spat."</td>
				<td>".$tb->tgl_spta."</td>
				<td>".$tb->jenis_spta."</td>
				<td>".$tb->selektor_tgl."</td>
				<td>".$tb->tgl_timbang."</td>
				<td class='number'>".number_format($tb->netto_final)."</td>";
				$htm .=	"<td class='number'>".$tb->ha_tertebang."</td>";
		}else{
			$htm .= '<td><input type="checkbox" id="cek_'.$tb->id.'" class="input" name="cek['.$tb->id.']"
               onclick="cekdataha(this.checked,'.$tb->id.')" /></td>';
			$htm .=  "
				<td>".$tb->no_spat."</td>
				<td>".$tb->tgl_spta."</td>
				<td>".$tb->jenis_spta."</td>
				<td>".$tb->selektor_tgl."</td>
				<td>".$tb->tgl_timbang."</td>
				<td class='number'>".number_format($tb->netto_final)."</td>";
			$htm .=	"<td class='number'><input type='number' id='ha_".$tb->id."' class='number inline input' value='".$tb->ha_tertebang."'  /></td>";
		}
			$htm .= "</tr>";
		

		}
		
		$htm .= "<tr><td colspan='8' style='text-align:right'>Ha Belum Validasi</td>
		<td class='number'><b>".number_format($habelum,3)." Ha</b></td></tr>";
		$htm .= "<tr><td colspan='8' style='text-align:right'>Ha Validasi</td>
		<td class='number'><b>".number_format($havalid,3)." Ha</b></td></tr>";
		$htm .= "<tr><td colspan='8' style='text-align:right'>Luas Petak</td>
		<td class='number'><b>".number_format($luasha,3)." Ha</b></td></tr>";
		if($havalid != 0){
		$htm .= "<tr><td colspan='8' style='text-align:right'>Protas Terhadap Ha Validasi</td>
		<td class='number'><b>".number_format(($ton/1000)/$havalid,2)." Ton/Ha</b></td></tr>";
		}
		echo $htm;
	}
  

	function downloadtemplate_petak($kodeblok, $luasha) 
	{
		$file = "TEMPLATE-".$kodeblok.".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		
		$wh = " AND a.kode_blok='$kodeblok'";
		
		$sql = "SELECT a.id,a.`no_spat`,a.tgl_spta,tgl_timbang,c.`netto` as netto_final,a.`jenis_spta`,
		a.selektor_tgl,b.ha_tertebang,b.tanaman_status
		 FROM t_spta a
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN t_selektor b on b.id_spta = a.id
WHERE a.`timb_netto_status` = 1 $wh GROUP BY a.id";
		
		$th = $this->db->query($sql)->result();
		$htm = "<table>     <thead>
				<tr><td colspan='8' style='text-align:center'>
						<b>PETAK $kodeblok</b></td></tr>
				        <tr>
				            <th>No</th>
				            <th>No SPTA</th>
				            <th>Tgl SPTA</th>
				            <th>Jenis SPTA</th>
				            <th>Tgl Masuk</th>
				            <th>Tgl Timbang</th>
				            <th>Netto</th>
				            <th>Ha</th>
				        </tr>
				        </thead>";
		$no=1;

		$havalid = 0;
		$habelum = 0;
		$ton = 0;

		$arter = array('1'=>'Ya','0'=>'Tidak');
				$arterx = array('1'=>'Manual','2'=>'Semi Mekanisasi','3'=>'Mekanisasi');
		foreach($th as $tb){
			if($tb->tanaman_status == 1){
				$havalid += $tb->ha_tertebang;
			}else{
				$habelum += $tb->ha_tertebang;
			}
			$ton += $tb->netto_final;
			$r = '';
			$htm .= "<tr>";
			
				$htm .= "<td>".$no."</td>";
				
				$no++;
				
			if($tb->tanaman_status == 1){
				$htm .=  "
				<td>".$tb->no_spat."</td>
				<td>".$tb->tgl_spta."</td>
				<td>".$tb->jenis_spta."</td>
				<td>".$tb->selektor_tgl."</td>
				<td>".$tb->tgl_timbang."</td>
				<td class='number'>".number_format($tb->netto_final)."</td>";
				$htm .=	"<td class='number'>".$tb->ha_tertebang."</td>";
		}else{
			$htm .=  "
				<td style='background:yellow;'>".$tb->no_spat."</td>
				<td style='background:yellow;'>".$tb->tgl_spta."</td>
				<td style='background:yellow;'>".$tb->jenis_spta."</td>
				<td style='background:yellow;'>".$tb->selektor_tgl."</td>
				<td style='background:yellow;'>".$tb->tgl_timbang."</td>
				<td style='background:yellow;' class='number'>".number_format($tb->netto_final)."</td>";
			$htm .=	"<td class='number'>".$tb->ha_tertebang."</td>";
		}
			$htm .= "</tr>";
		

		}
		$htm .= "</table>";
	
		echo $htm;
	}

	function uploadsend(){
		 //var_dump($_FILES);die();
		ini_set('memory_limit', '4048M');
		ini_set('upload_max_filesize','30M');
		ini_set('post_max_size','30M');
		$user = $this->session->userdata('fid');
		$totdata = 0;
		// include APPPATH."/third_party/PHPExcel/IOFactory.php";

		//include (APPPATH.'/third_party/php-excel-reader/excel_reader2.php');
		// include (APPPATH.'/third_party/SpreadsheetReader.php');
		// $file = '';
    	$this->load->library("excel");

			$inputFileName = 'TEMP_TEMPLATE_EVALUASI_TAN.xls';


		if(move_uploaded_file($_FILES['template_eva']['tmp_name'], $inputFileName)){
			//chmod($file, 0777);
				    	// include 'PHPExcel/IOFactory.php';
			//  Read your Excel workbook
			try {
			    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
			    $objPHPExcel = $objReader->load($inputFileName);
			} catch(Exception $e) {
			    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}

			//  Get worksheet dimensions
			$sheet = $objPHPExcel->getSheet(0); 
			$highestRow = $sheet->getHighestRow(); 
			$highestColumn = $sheet->getHighestColumn();

			$arr_rowData = array();
			//  Loop through each row of the worksheet in turn
			for ($row = 3; $row <= $highestRow; $row++){ 
			    //  Read a row of data into an array
			    $rowData = $sheet->rangeToArray('H' . $row . ':' . $highestColumn . $row,
			                                    NULL,
			                                    TRUE,
			                                    TRUE);
			    $rowDatawh = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
			                                    NULL,
			                                    TRUE,
			                                    TRUE);


			    // array_push($arr_rowData, $rowData);
			    //  Insert row data array into your database of choice here
			    $sql = "UPDATE t_selektor a inner join t_spta b on a.id_spta = b.id set a.ha_tertebang='".$rowData[0][0]."',a.tanaman_status=1,a.tanaman_user='$user',a.tanaman_act=now() WHERE b.no_spat = '".$rowDatawh[0][0]."'";
			    $this->db->query($sql);
			    $totdata++;

			    // echo $rowData[0][0];
			    // print_r("<br>");
			}
			echo ($totdata)." Data Berhasil Diupload Silahkan cek di Table !!";
			// $data['read'] = $arr_rowData;
			// print_r($arr_rowData);
}else{
	echo 'File Gagal Upload !! Max Upload Filesize '.ini_get('upload_max_filesize');
}
}
  
  	function formupload(){

		echo $this->load->view('tevaluasitebang/formupload',null, true );
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
			$this->data['row'] = $this->model->getColumnTable('sap_field'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tevaluasitebang/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		if(isset($_POST['cek'])){
			$ax = $_POST['cek'];
		$kodepetak = $_POST['kodeblok'];

		foreach ($ax as $id=>$ha) {
			$this->updatehektar($ha,$id);
		}	

		$this->setupdateha($kodepetak);
		}else{
			echo ".Pilih Dulu, SPTA yang akan di validasi !!*";
		}
		
	}

	

	function updatehektar($ha,$id)
	{

		$user = $this->session->userdata('fid');
		$tgl = date('Y-m-d H:i:s');
	//	$ha = $_POST['ha'];
	//	$id = $_POST['id'];

		$r = $this->db->query("SELECT b.kode_blok,luas_tebang,luas_ha,aff_tebang FROM t_spta a 
			INNER JOIN sap_field b on a.kode_blok=b.kode_blok where a.id=$id")->row_array();
		$kodepetak = $r['kode_blok'];
		$luas_tebang = floatval($r['luas_tebang']);
		$luas_ha = floatval($r['luas_ha']);
		$aff = $r['aff_tebang'];

		if($aff == 0){
		if($luas_ha > ($luas_tebang+$ha)){
			$sql = "UPDATE t_selektor set ha_tertebang='$ha',tanaman_status=1,tanaman_user='$user',tanaman_act=now() WHERE id_spta = $id";
		$this->db->query($sql);
		echo "1.Hektar Berhasil diupdate..*";
				$this->inputLogs("3.Hektar Sudah Update pada Petak ".$kodepetak." dengan tambahan ".$ha." Ha");
		}else{
			$axs = number_format($luas_tebang,3) + number_format(trim($ha),3);
			$sisa = number_format($luas_ha,3) - number_format($axs,3);
			$sisap = ($sisa / $luas_ha)*100;

			$sisax = $luas_ha-($luas_tebang); 
			$sisapx = ($sisax / $luas_ha)*100; 

			//echo "Luas ha : ".$luas_ha." & luas tebang".$axs." & sisa ha nya".($sisa);
			if($sisap < 0 && $sisapx > 0){

			//	$up = $this->db->query("UPDATE sap_field set aff_tebang=1 where kode_blok = '$kodepetak'");
				echo "2.Hektar Error, Sisa Luas adalah ".number_format($luas_ha-$luas_tebang,3,',','.')." Ha *";

			}else if($sisap < 0 && $sisapx < 0){

				//$up = $this->db->query("UPDATE sap_field set aff_tebang=1 where kode_blok = '$kodepetak'");
				//echo "2.Hektar Error, Sisa Luas adalah ".number_format($luas_ha-$luas_tebang,3,',','.')." Ha *";
				//$this->inputLogs("2.Aff otomatis karena petak ".$kodepetak." minus sisa hektarnya.");

			}else{
				$sql = "UPDATE t_selektor set ha_tertebang='$ha',tanaman_status=1,tanaman_user='$user',tanaman_act=now() WHERE id_spta = $id";
				
				$this->db->query($sql);
				//$up = $this->db->query("UPDATE sap_field set aff_tebang=1 where kode_blok = '$kodepetak'");
				echo "3.Hektar Sudah Update dan Petak ".$kodepetak." Otomatis Aff Tebang.*";
				//$this->inputLogs("3.Hektar Sudah Update dan Petak ".$kodepetak." Otomatis Aff Tebang.");
            	$this->inputLogs("3.Hektar Sudah Update");
			}
		}
	}else{
		$sql = "UPDATE t_selektor set ha_tertebang='0',tanaman_status=1,tanaman_user='$user',tanaman_act=now() WHERE id_spta = $id";
		$this->db->query($sql);
		echo "3.Master field sudah Aff, dan hektar berhasil di update*";
				$this->inputLogs("3.Hektar Sudah Update pada Petak ".$kodepetak." dengan tambahan ".$ha." Ha");

	}

		
		
	}

	function updatesetaff()
	{
		$id = $_POST['kodepetak'];
		$sql = "UPDATE sap_field set aff_tebang=1 where kode_blok = '$id'";
		$this->db->query($sql);
		$this->inputLogs(" ID : $id  , Set Aff Successfull");
		
	}

	function setupdateha($kodepetak){

		$sqld = $this->db->query("SELECT SUM(b.`ha_tertebang`) as hatebang,SUM(netto)  as netto
			FROM t_spta a 
			INNER JOIN t_selektor b ON a.`id`=b.`id_spta` 
			INNER JOIN t_timbangan c on c.id_spat=a.id
			WHERE a.`kode_blok` = '$kodepetak' and b.tanaman_status=1")->row();

		$ha = $sqld->hatebang;
		$netto = $sqld->netto;
		$up = $this->db->query("UPDATE sap_field set luas_tebang='$ha',total_tebang='$netto' where kode_blok = '$kodepetak'");

	}


	function updatehaall(){
		$s = $this->db->query("SELECT kode_blok FROM sap_field WHERE luas_tebang != 0")->result();
		foreach ($s as $k) {

			$this->setupdateha($k->kode_blok);
			echo $k->kode_blok.'<br />';
		}
	}

	function printprotas(){
		 $file = "Laporan Produksi Petak.xls";
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=$file");
		$a = $this->db->query("SELECT * FROM vw_masterfield_data ORDER BY divisi")->result();
		 $this->data['result'] = $a;
        $this->load->view('tevaluasitebang/print',$this->data);
	}




}
