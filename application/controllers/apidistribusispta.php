<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apidistribusispta extends SB_Controller
{
	public $module 		= 'tkuotaspta';
	function __construct() {
        parent::__construct();
        $this->load->model('tkuotasptamodel');
		$this->model = $this->tkuotasptamodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	"SPTA Mobile",
			'pageNote'	=>  "API SPTA Mobile",
			'pageModule'	=> 'tkuotaspta',
		));
        
    }

    function login()
    {
        $user = $_REQUEST['username'];
        $pass = md5($_REQUEST['password']);

        $result = $this->db->get_where('tb_users', array('username'=>$user, 'password' => $pass, 'group_id' => 22));


        if($result->num_rows() == 1){
            $msg = array('msg' => '1', 'status' => 'true','data' => $result->row());
        }else{
            $msg = array('msg' => '0', 'status' => 'false' , 'data' => '');
        }
        echo json_encode($msg);
    }

    function detailUser()
    {
        $id = $_REQUEST['id'];

        $result = $this->db->get_where('tb_users', array('id'=>$id));


        if($result->num_rows() == 1){
            $msg = array('msg' => '1', 'status' => 'true','data' => $result->row());
        }else{
            $msg = array('msg' => '0', 'status' => 'false' , 'data' => '');
        }
        echo json_encode($msg);
    }

    function dashboard()
    {
    	$username = $_REQUEST['username'];
    	$tgl = $_REQUEST['tgl'];

    	$sql = $this->db->query("SELECT IFNULL(kode_affd,'') AS kode_affd,IFNULL(tgl_spta,DATE(NOW())) AS tgl_spta,COUNT(id) AS kuota,IFNULL(SUM(selektor_status),0) AS selektor,IFNULL(SUM(timb_netto_status),0) AS timbang,IFNULL(SUM(meja_tebu_status),0) AS giling FROM t_spta WHERE 
(kode_affd = '$username' OR persno_pta = '$username') AND tgl_spta = '$tgl'")->row();
    	if($sql)
    	{
    		 $msg = array('msg' => '1', 'status' => 'true','data' => $sql);
        }else{
            $msg = array('msg' => '0', 'status' => 'false', 'data' => '');
        }

        echo json_encode($msg);

    }

    function listSPTA()
    {
    	$username = $_REQUEST['username'];
    	$tgl = $_REQUEST['tgl'];
    	$status = $_REQUEST['status'];
    	$wh = " AND status_distribusi = 0";
    	if($status == 1){
    		$wh = " AND status_distribusi != 0";
    	}

    	$sql = $this->db->query("SELECT a.id,a.`no_spat`,a.`kode_affd`,b.`deskripsi_blok`,a.`kode_kat_lahan`,a.`rfid_sticker`,a.`status_distribusi`,a.`persno_mandor`,a.`vendor_angkut`,a.`id_truck` FROM t_spta a INNER JOIN sap_field b ON a.`kode_blok`=b.`kode_blok` WHERE 
(kode_affd = '$username' OR persno_pta = '$username') AND tgl_spta = '$tgl' $wh")->result();

    	if($sql)
    	{
    		 $msg = array('msg' => '1', 'status' => 'true','data' => $sql);
        }else{
            $msg = array('msg' => '0', 'status' => 'false', 'data' => '');
        }
        echo json_encode($msg);

    }

    function getVendor()
    {
    	$sqlvendor = $this->db->query("SELECT * FROM m_vendor where status = 1")->result();
    	if($sqlvendor)
    	{
    		 $msg = array('msg' => '1', 'status' => 'true','data' => $sqlvendor);
        }else{
            $msg = array('msg' => '0', 'status' => 'false', 'data' => '');
        }
        echo json_encode($msg);
    }

    function getTruk()
    {
    	$vendor = $_REQUEST['vendor'];
    	$sqltruk = $this->db->query("SELECT * FROM m_truk_gps where vendor_id = '$vendor' and status=0")->result();
    	if($sqltruk)
    	{
    		 $msg = array('msg' => '1', 'status' => 'true','data' => $sqltruk);
        }else{
            $msg = array('msg' => '0', 'status' => 'false', 'data' => '');
        }
        echo json_encode($msg);
    }

    function simpanDistribusi(){
        $r = $_POST;
        $msg = array('msg' => '0', 'status' => 'false', 'data' => '');
        $data = array();
        $data['rfid_sticker'] = $r['rfid_sticker'];
        $data['rfid_sticker_tagging'] = date('Y-m-d H:i:s');
        $data['rfid_sticker_status'] = 1;
        $data['id_truck'] = $r['id_truck'];
        $data['persno_mandor'] = $r['persno_mandor'];
        $data['status_distribusi'] = 1;
        $data['tgl_distribusi'] = date('Y-m-d H:i:s');
        $id =  $r['id'];
        $this->db->where('id', $id);
        $this->db->update('t_spta', $data);
        $msg = array('msg' => '1', 'status' => 'true','data' => "Berhasil Simpan..");
        
        $sql = $this->db->query('UPDATE m_truk_gps SET status=1,task_update=now() WHERE id="'.$data['id_truck'].'"');

        echo json_encode($msg);
    }

    function datamandor(){
        $arr = array();
        $sql = $this->db->query("SELECT * FROM sap_m_karyawan where id_jabatan = 3 order by name asc")->result();

        if($sql){
            $arr['stt'] = 1;
            $arr['data'] = $sql;
        }else{
            $arr['stt'] = 0;
        }
        echo json_encode($arr);
    }


}