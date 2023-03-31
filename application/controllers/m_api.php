<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_api extends SB_Controller
{

	function testing(){
		echo $_SERVER['PHP_AUTH_USER'];
	}

	function login(){
		if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){
			$usr = $_SERVER['PHP_AUTH_USER'];
			$pwd = $_SERVER['PHP_AUTH_PW'];
			$request = array('usr' => $usr, 'pwd' => $pwd);
			$this->load->model('mobilemodel');
			echo $this->mobilemodel->login($request);
		} else {
			header('WWW-Authenticate: Basic realm="SPTA Online"');
			header('HTTP/1.0 401 Unauthorized');
			header('Content-type: application/json; charset=utf-8');
			$resp = (object) [
				'success' => false,
				'code' => 401,
				'data' => [],
				'message' => 'user not authorized' 
			];
			echo json_encode($resp);
		}
	}

	function petak(){
		$persno = $this->input->get('persno');
		$this->load->model('mobilemodel');
		echo $this->mobilemodel->petak($persno);
	}

	function truk(){
		$persno = $this->input->get('persno');
		$this->load->model('mobilemodel');
		echo $this->mobilemodel->truk($persno);
	}
}