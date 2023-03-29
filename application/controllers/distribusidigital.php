<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Distribusidigital extends SB_Controller
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

    function index()
    {

		$this->data['content'] = $this->load->view('distribusidigital/index',null, true );
    	$this->load->view('layouts/main', $this->data );
    }

    function form($id){

    	$sql = $this->db->query("SELECT a.id,a.no_spat,b.`kode_blok`,b.`deskripsi_blok`,a.id_truck,a.persno_mandor FROM t_spta a INNER JOIN sap_field b ON a.`kode_blok`=b.`kode_blok` WHERE a.id = $id")->row();

    	$this->data['row'] = $sql;
    	echo $this->load->view('distribusidigital/form',$this->data, true );
    }

    function view($id){

    	$sql = $this->db->query("SELECT a.id,a.no_spat,b.`kode_blok`,b.`deskripsi_blok`,a.id_truck,a.persno_mandor FROM t_spta a INNER JOIN sap_field b ON a.`kode_blok`=b.`kode_blok` WHERE a.id = $id")->row();

    	$this->data['row'] = $sql;
    	echo $this->load->view('distribusidigital/view',$this->data, true );
    }

    function simpandata(){
    	$id = $_POST['id'];
    	$mandor = $_POST['mandor'];
    	$truk = $_POST['truk'];
        $rfidsticker = '';

        $sqltruk = $this->db->query("SELECT * FROM m_truk_gps WHERE id=$truk")->row();
        if($sqltruk) {
            $rfidsticker = $sqltruk->rfid_sticker;
            $sql = $this->db->query("UPDATE t_spta set id_truck=$truk,persno_mandor='$mandor',tgl_distribusi=now(),status_distribusi=1,rfid_sticker='$rfidsticker',rfid_sticker_tagging=now(),rfid_sticker_status=1 where id=$id"); 

        }else{
          $sql = $this->db->query("UPDATE t_spta set id_truck=$truk,persno_mandor='$mandor',tgl_distribusi=now(),status_distribusi=1 where id=$id");  
        }
            
    	   

    	if($sql){
    		$this->db->query("UPDATE m_truk_gps set status=2,last_update=now(),id_spta = $id where id=$truk");
    	}
    }

    function dataList(){
    	$tgl = $_POST['tgl'];
    	$filter = $_POST['filter'];
    	$jns = $_POST['jenis'];
    	$username = $this->session->userdata('lastid');

    	$wh = " AND a.tgl_spta = '$tgl'";
    	if($filter != '') $wh .= " AND (b.kode_blok LIKE '%$filter%' OR b.deskripsi_blok LIKE '%$filter%')";

    	$sql = $this->db->query("SELECT a.id,a.no_spat,b.`kode_blok`,b.`deskripsi_blok` FROM t_spta a INNER JOIN sap_field b ON a.`kode_blok`=b.`kode_blok` WHERE 0=0 AND angkut_pg = 1 $wh AND a.`status_distribusi` = $jns AND (kode_affd = '$username' OR persno_pta = '$username')")->result();

    	$html = '';
    	if($sql)
    	{

    		foreach ($sql as $k) {
    			$html .= '<tr>
    			<td>No SPTA<br /><b>'.$k->no_spat.'</b><br />Kode Blok<br /><b>'.$k->kode_blok.'</b><br />Deskripsi<br /><b>'.$k->deskripsi_blok.'</b></td>';
    			if($jns == 1){
    				$html .= '<td><a href="javascript:viewDistribusi('.$k->id.')"  class="tips "  title="View"><i class="fa  fa-table"></i> </a></td>
    			</tr>';
    			}else{
    				$html .= '<td><a href="javascript:formDistribusi('.$k->id.')"  class="tips "  title="Distribusi"><i class="fa  fa-gear"></i> </a></td>
    			</tr>';
    			}
    			
    		}
        }else{
            $html .= '<tr>
    			<td colspan="2"> Data Kosong </td>
    			</tr>';
        }
        echo $html;
    }
}