<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ws extends SB_Controller
{
	function __construct() {
        parent::__construct();
        
    }

    function masterfield(){
    	
    	$data = array();
    	$limit = isset($_GET['limit']) ? $_GET['limit']:''; 
        $offset = isset($_GET['page']) ? $_GET['page']:'';
        $kodeblok = isset($_GET['kodeblok']) ? $_GET['kodeblok']:'';
        $afd = isset($_GET['afd']) ? $_GET['afd']:'';
        if($limit == '') $limit = 10;
        if($offset != '') $offset = $limit * ($offset-1);

    	$a = $this->db->query("SELECT count(*) as total FROM sap_field")->row();
    	$data['total_all'] = $a->total;

    	 $this->db->from('sap_field');

    	  if($kodeblok !='' || $afd != '') {
    	  	if($kodeblok != '') $this->db->where('kode_blok',$kodeblok);
    	  	if($afd != '') $this->db->where('divisi',$afd);
    	  }else{
    	 	if($limit !='') $this->db->limit($limit);
         	if($limit !=''&&$offset!='') $this->db->limit($limit,$offset);
     	}

         $dx = $this->db->get();
         $data['total_filter'] = $dx->num_rows();
         $data['data'] = $dx->result();

    	echo json_encode($data,true);
    }
}
