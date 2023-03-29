<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apicoresampler extends SB_Controller
{

	function simpandata(){
		$a = $_REQUEST;
		$this->db->query("INSERT INTO tb_logs (module,task,note) values ('cs','simpandata','".serialize($a)."')");

	}

	function cekspat(){
		$a = $_REQUEST;
		$this->db->query("INSERT INTO tb_logs (module,task,note) values ('cs','cekspta','".serialize($a)."')");
	}
}