<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Senddatatoserver extends CI_Controller {
	public function syncByLog()
	{
		$result = $this->db->query('SELECT * FROM tb_logs_sync_process where t_status = 0 limit 100')->result();
		
		$sptaid = array(); $sptalogid = array();
		$selid = array(); $sellogid = array();
		$timid = array(); $timlogid = array();
		$mtid = array(); $mtlogid = array();
		$ariid = array(); $arilogid = array();
		
		foreach ($result as $key => $value) { 
			if ($value->t_table === "t_spta") {
				//$arr['spta'][] = $value->t_id;
				array_push($sptaid,$value->t_id);
				array_push($sptalogid,$value->id);
				
			}else if ($value->t_table === "t_selektor") {
				//$this->gett_selektor($value->t_id,$value->id);
				array_push($selid,$value->t_id);
				array_push($sellogid,$value->id);
				
			}else if ($value->t_table === "t_timbangan") {
				//$this->gett_timbangan($value->t_id,$value->id);
				array_push($timid,$value->t_id);
				array_push($timlogid,$value->id);
				
			}else if ($value->t_table === "t_meja_tebu") {
				//$this->gett_meja_tebu($value->t_id);
				array_push($mtid,$value->t_id);
				array_push($mtlogid,$value->id);
				
			}else if ($value->t_table === "t_ari") {
				//$this->gett_ari($value->t_id,$value->id);
				array_push($ariid,$value->t_id);
				array_push($arilogid,$value->id);
				
			}
		}
		
		
		if (!empty($sptaid)) {
			$this->gett_spta($sptaid,$sptalogid); 
		}
		
		if (!empty($selid)) {
			$this->gett_selektor($selid,$sellogid);
		}
		
		if (!empty($timid)) {
			$this->gett_timbangan($timid,$timlogid);
		}
		
		if (!empty($mtid)) {
			$this->gett_meja_tebu($mtid,$mtlogid);
		}
		
		if (!empty($ariid)) {
			$this->gett_ari($ariid,$arilogid); 
		}
		
		
		
		
	}
	public function gett_spta($id,$idlog)
	{
		if(CNF_COMPANYCODE == 'N011'){
			$hostx = '10.20.1.13';
		}else{
			$hostx = 'devproduksi.ptpn11.co.id';
		}
		$id = implode(",", $id);
		$idlog = implode(",", $idlog);
		
		if($id != ''){
		$result = $this->db->query('SELECT * FROM t_spta where id IN ('.$id.')');
		$datax = json_encode($result->result());
		$result->free_result();

		$url= 'http://'.$hostx.'/simpgdb/index.php/dashboard/Uploadt_spta/'.CNF_COMPANYCODE.'/'.CNF_PLANCODE;
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POST, true);
	    $post = array(
	        "data" => base64_encode($datax)
	    );
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
	    $response = curl_exec($ch);
		
	    

		// Check HTTP status code
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
				 $a = $this->db->query("DELETE FROM tb_logs_sync_process WHERE id IN (".$idlog.")");
				// $a->free_result();
			break;
		  }
		}
		echo $response;
		curl_close($ch);
		
	    
		}
		
	}
	public function gett_selektor($id,$idlog)
		{
			if(CNF_COMPANYCODE == 'N011'){
			$hostx = '10.20.1.13';
		}else{
			$hostx = 'devproduksi.ptpn11.co.id';
		}
			$id = implode(",", $id);
			$idlog = implode(",", $idlog);
		
		if($id != ''){
			$result = $this->db->query('SELECT * FROM t_selektor where id_spta  IN ('.$id.')');
			$datax = json_encode($result->result());
			$result->free_result();

			$url = 'http://'.$hostx.'/simpgdb/index.php/dashboard/Uploadt_selektor/'.CNF_COMPANYCODE.'/'.CNF_PLANCODE;
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode($datax)
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
			
			// Check HTTP status code
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
				$a = $this->db->query("DELETE FROM tb_logs_sync_process WHERE id IN (".$idlog.")");
				// $a->free_result();
			break;
		  }
		}
		
		    echo $response;
		    curl_close($ch);
		}
		}
	public function gett_timbangan($id,$idlog)
		{
			if(CNF_COMPANYCODE == 'N011'){
			$hostx = '10.20.1.13';
		}else{
			$hostx = 'devproduksi.ptpn11.co.id';
		}

			$id = implode(",", $id);
			$idlog = implode(",", $idlog);
		
		if($id != ''){
			$result = $this->db->query('SELECT * FROM t_timbangan where id_spat IN ('.$id.')');
			$datax = json_encode($result->result());
			$result->free_result();
			$url = 'http://'.$hostx.'/simpgdb/index.php/dashboard/Uploadt_timbangan/'.CNF_COMPANYCODE.'/'.CNF_PLANCODE;
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode($datax)
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
			
			// Check HTTP status code
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
				$a = $this->db->query("DELETE FROM tb_logs_sync_process WHERE id IN (".$idlog.")");
				// $a->free_result();
			break;
		  }
		}
		
		    echo $response;
		    curl_close($ch);
		}
		}
	public function gett_meja_tebu($id,$idlog)
		{
			if(CNF_COMPANYCODE == 'N011'){
			$hostx = '10.20.1.13';
		}else{
			$hostx = 'devproduksi.ptpn11.co.id';
		}
			$id = implode(",", $id);
			$idlog = implode(",", $idlog);
			
			if($id != ''){
		
			$result = $this->db->query('SELECT * FROM t_meja_tebu where id_spta IN ('.$id.')');
			$datax = json_encode($result->result());
			$result->free_result();
			$url = 'http://'.$hostx.'/simpgdb/index.php/dashboard/Uploadt_meja_tebu/'.CNF_COMPANYCODE.'/'.CNF_PLANCODE;
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode($datax)
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
			
			// Check HTTP status code
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
				$a = $this->db->query("DELETE FROM tb_logs_sync_process WHERE id IN (".$idlog.")");
				// $a->free_result();
			break;
		  }
		}
		
		    echo $response;
		    curl_close($ch);
			}
		}
	public function gett_ari($id,$idlog)
		{
			if(CNF_COMPANYCODE == 'N011'){
			$hostx = '10.20.1.13';
		}else{
			$hostx = 'devproduksi.ptpn11.co.id';
		}

			$id = implode(",", $id);
			$idlog = implode(",", $idlog);
			
			if($id != ''){
			$result = $this->db->query('SELECT * FROM t_ari where id_spta IN ('.$id.')');
			$datax = json_encode($result->result());
			$result->free_result();
			$url = 'http://'.$hostx.'/simpgdb/index.php/dashboard/Uploadt_ari/'.CNF_COMPANYCODE.'/'.CNF_PLANCODE;
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode($datax)
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
			
			// Check HTTP status code
		if (!curl_errno($ch)) {
		  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
			case 200:  # OK
				$a = $this->db->query("DELETE FROM tb_logs_sync_process WHERE id IN (".$idlog.")");
				// $a->free_result();
			break;
		  }
		}
		
		    echo $response;
		    curl_close($ch);
			}
		}
}
/* End of file senddatatoserver.php */
/* Location: .//C/Users/hendrik/AppData/Local/Temp/fz3temp-1/senddatatoserver.php */