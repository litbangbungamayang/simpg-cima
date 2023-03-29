<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mmtruckgps extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'mmtruckgps';
	public $per_page	= '10';
	public $idx			= '';

	//public static $host='http://103.5.50.118:8082';
	public static $host='http://gps.ptpn11.co.id:8082';
	private static $adminEmail='admin';
	private static $adminPassword='admin';
	public static $cookie;
	private static $jsonA='Accept: application/json';
	private static $jsonC='Content-Type: application/json';
	private static $urlEncoded='Content-Type: application/x-www-form-urlencoded';

	function __construct() {
		parent::__construct();
		
		$this->load->model('mmtruckgpsmodel');
		$this->model = $this->mmtruckgpsmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'mmtruckgps',
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
            	$btn .= '<a href='.site_url('mmtruckgps/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('mmtruckgps/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('mmtruckgps/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('mmtruckgps/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('m_truk_gps'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('mmtruckgps/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('m_truk_gps'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('mmtruckgps/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));

			$idserv = $this->db->query("SELECT id_gps_server FROM m_truk_gps WHERE id=$ID")->row();
			if($idserv->id_gps_server != '0'){
				$idserv = $this->apiSave($idserv->id_gps_server,$data['nopol_truk'].' - '.$data['namatruk'],$data['imei'],$data['no_hp'],'PUT');
			}else{
				if($data['imei'] != '0' || $data['imei'] != '' || $data['imei'] !='-'){
					$idserv = $this->apiSave(-1,$data['nopol_truk'].' - '.$data['namatruk'],$data['imei'],$data['no_hp'],'POST');
				$this->db->query("UPDATE m_truk_gps set id_gps_server='$idserv' WHERE id=$ID");
				}
				
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
				redirect( 'mmtruckgps/add/'.$ID,301);
			} else {
				redirect( 'mmtruckgps',301);
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
			
		$id = $_POST['id'];

		$idserv = $this->db->query("SELECT id_gps_server FROM m_truk_gps WHERE id=$id")->row();
			if($idserv->id_gps_server != '0'){

				header('Content-Type: application/json');
				$data='email=admin&password=admin';
				$a = self::curl('/api/session','POST','',$data,array(self::$urlEncoded));
				$b = self::curl('/api/devices/'.$idserv->id_gps_server,'DELETE',self::$cookie,json_encode(array()),array(self::$jsonC));
				//echo json_encode($b);
			}

		$this->model->destroy($_POST['id']);
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}


	function getroute(){
		$id = $_POST['id'];
	}


	function apiSave($id,$name,$imei,$nohp,$task)
	{
		//$ch = curl_init();
		$data2 = array(
  "id"=> $id,
  "name"=> $name,
  "uniqueId"=> $imei,
  "phone"=> $nohp,
  "model"=> "",
  "contact"=> "",
  "category"=> null,
  "status"=> null,
  "lastUpdate"=> null,
  "groupId"=> 0,
  "disabled"=> false);
		header('Content-Type: application/json');
		
		$data='email='.CNF_PLANCODE.'&password='.CNF_PLANCODE;
	
		$a = self::curl('/api/session','POST','',$data,array(self::$urlEncoded));
		$r = json_decode($a->response);

		//echo json_encode($r->attributes->notificationTokens);
		
		if($task == 'PUT'){
			$b = self::curl('/api/devices/'.$id,$task,self::$cookie,json_encode($data2),array(self::$jsonC));
			$r = json_decode($b->response);
		}else{
			$b = self::curl('/api/devices',$task,self::$cookie,json_encode($data2),array(self::$jsonC));	
			$r = json_decode($b->response);
		}
		
		
		return $r->id;
		//echo json_encode($b).' '.$task.' '.json_encode($data2);
		//self::curl('/api/devices','POST',$sessionId,$data,array(self::$jsonC));
		die();
	}

	function monitoringtruk()
	{
		//if(CNF_PLANCODE != 'KP04'){
		//	redirect( 'mmtruckgps',301);
		//}else{
		$this->data['id'] = 'all';
		$this->data['content'] =  $this->load->view('mmtruckgps/gps', $this->data ,true);	
		$this->load->view('layouts/main', $this->data );
		//}
	}

	function detailtruck($id){
		$a = $this->db->query("SELECT *,a.nopol_truk as nopol FROM m_truk_gps a LEFT JOIN vw_spta_digital b ON b.id_truck=a.id where id_gps_server = $id")->row();
		echo json_encode($a);
	}

	function listtruck(){
		$a = $this->db->query("SELECT * FROM m_truk_gps ")->result();
		echo json_encode($a);
	}

	function historytruck($idtruk){
		/*$from_str = '2017-07-25 00:00:10';
		$to_str = '2017-07-25 10:10:10';

		$from_obj = new DateTime($from_str);
		$to_obj = new DateTime($to_str);


		$from_iso = substr($from_obj->format(DateTime::ATOM),0,-6).'.000Z';
		$to_iso = substr($to_obj->format(DateTime::ATOM),0,-6).'.000Z';

		$route=self::reportRoute($idtruk,'',$from_iso,$to_iso,self::$cookie);
		echo $route->response;*/
		$date = date('Y-m-d');
		$from_str =  date('Y-m-d H:i:s', strtotime($date. ' -3 days'));
		$to_str = date('Y-m-d H:i:s');

		$from_obj = new DateTime($from_str);
		$to_obj = new DateTime($to_str);


		$from_iso = substr($from_obj->format(DateTime::ATOM),0,-6).'.000Z';
		$to_iso = substr($to_obj->format(DateTime::ATOM),0,-6).'.000Z';
		$data='deviceId='.$idtruk.'&from='.$from_iso.'&type=allEvents&to='.$to_iso.'&page=1&start=0&limit=25';

		$username = CNF_PLANCODE;
		$password = CNF_PLANCODE;

		//echo "http://gps.ptpn11.co.id:8082/api/reports/route?".$data;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,"http://gps.ptpn11.co.id:8082/api/reports/route?".$data);
			curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
			$json = curl_exec($ch);
			$json = json_decode($json);
			echo json_encode( $json );

	}


	public static function reportRoute($deviceId,$groupId,$from,$to,$cookie) {

        $data='deviceId='.$deviceId.'&groupId='.$groupId.'&from='.$from.'&to='.$to;

        return self::curl('/api/reports/route?'.$data,'GET',$cookie ,'',array());
    }


	public static function curl($task,$method,$cookie,$data,$header) {
	
	$res=new stdClass();
	$res->responseCode='';
	$res->error='';
	$header[]="Cookie: ".$cookie;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://gps.ptpn11.co.id:8082".$task);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	
	if($method=='POST' || $method=='PUT' || $method=='DELETE') {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	
	curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
	$data=curl_exec($ch);
	$size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	
	if (preg_match('/^Set-Cookie:\s*([^;]*)/mi', substr($data, 0, $size), $c) == 1) self::$cookie = $c[1];
		$res->response = substr($data, $size);
	
	if(!curl_errno($ch)) {
		$res->responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	}
	else {
		$res->responseCode=400;
		$res->error= curl_error($ch);
	}
	
	curl_close($ch);
	return $res;
	}
}





