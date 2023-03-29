<?php
//if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
$request_headers        = apache_request_headers();
print_r ($request_headers);
$http_origin            = $request_headers['Referer'];
print_r ("origin: ".$http_origin);
$allowed_http_origins   = array(
                            "http://simtr.bcn.web.id",
                            "http://localhost"
                          );
if (in_array($http_origin, $allowed_http_origins)){
    header("Access-Control-Allow-Origin: " . $http_origin);
};
*/

class Api_bcn extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function getDataTimbang(){
    	$this->load->model('api_bcn_model');
    	$kode_blok = $this->input->get("kode_blok");
    	$tgl_timbang = $this->input->get("tgl_timbang");
      $request = array('kode_blok' => $kode_blok, 'tgl_timbang' => $tgl_timbang);
    	echo $this->api_bcn_model->getDataTimbang($request);
    }

    public function getDataTimbangPeriode(){
      $this->load->model("api_bcn_model");
      $tgl_timbang_awal = $this->input->get("tgl_timbang_awal");
      $tgl_timbang_akhir = $this->input->get("tgl_timbang_akhir");
      $request = array("tgl_timbang_awal" => $tgl_timbang_awal, "tgl_timbang_akhir" => $tgl_timbang_akhir);
      echo $this->api_bcn_model->getDataTimbangPeriode($request);
    }

    public function getDataTimbangPeriodeGroup(){
      $this->load->model("api_bcn_model");
      $tgl_timbang_awal = $this->input->get("tgl_timbang_awal");
      $tgl_timbang_akhir = $this->input->get("tgl_timbang_akhir");
      $afd = $this->input->get("afd");
      $request = array("tgl_timbang_awal" => $tgl_timbang_awal, "tgl_timbang_akhir" => $tgl_timbang_akhir, "afd" => $afd);
      echo $this->api_bcn_model->getDataTimbangPeriodeGroup($request);
    }

    public function updateSimpgFlag(){
      $this->load->model("api_bcn_model");
      $tgl_timbang = $this->input->get("tgl_timbang");
      $kode_blok = $this->input->get("kode_blok");
      $request = array("tgl_timbang" => $tgl_timbang, "kode_blok" => $kode_blok);
      echo $this->api_bcn_model->updateSimpgFlag($request);
    }

    public function setPbtma(){
      $id_dokumen = $this->input->post("id_dokumen");
      $data_pbtma = $this->input->post("array_data");
      echo(json_encode($data_pbtma[0]));
      error_log($data_pbtma,0);
    }

    public function getAllPetakKebunByKepemilikan(){
      $this->load->model("api_bcn_model");
      $kepemilikan = "";
      $post_kepemilikan = $this->input->get("kepemilikan");
      $tahun_giling = $this->input->get("tahun_giling");
      switch($post_kepemilikan){
        case "ts":
          $kepemilikan = "ts-hg";
          break;
        case "tr":
          $kepemilikan = "tr-kr";
          break;
        case "tsi":
          $kepemilikan = "ts-ip";
          break;
      }
      $request = array("kepemilikan" => $kepemilikan, "tahun_giling" => $tahun_giling);
      echo $this->api_bcn_model->getAllPetakKebunByKepemilikan($request);
    }

	public function getDataDaily(){
      $this->load->model("api_bcn_model");
      $tglTimbang = $this->input->get("tglTimbang");
      echo $this->api_bcn_model->getDataDaily($tglTimbang);
    }

    public function getLaporanAri(){
      $this->load->model("api_bcn_model");
      $tglTimbang = $this->input->get("tglTimbang");
      echo $this->api_bcn_model->getLaporanAri($tglTimbang);
    }

	public function getMonitoringIntegrasi(){
      $this->load->model("api_bcn_model");
      $tglTimbang = $this->input->get("tglTimbang");
      echo $this->api_bcn_model->getMonitoringIntegrasi($tglTimbang);
    }

	public function getTebuGilingSekarang(){
    	$this->load->model("api_bcn_model");
    	echo $this->api_bcn_model->getTebuGilingSekarang();
    }
	
	public function getTebuGilingJamIni(){
    	$this->load->model("api_bcn_model");
    	echo $this->api_bcn_model->getTebuGilingJamIni();
    }

	public function cekDuplikatFaktor(){
    	$this->load->model("api_bcn_model");
    	$tglTimbang = $this->input->get("tglTimbang");
    	echo $this->api_bcn_model->cekDuplikatFaktor($tglTimbang);
    }
	
	public function setFaktor(){
    	$this->load->model("api_bcn_model");
    	$tgl_timbang = $this->input->post("tgl_timbang");
    	$faktor = $this->input->post("faktor");
    	$request = array("tgl_timbang" => $tgl_timbang, "faktor" => $faktor);
    	echo ($this->api_bcn_model->setFaktor($request));
    	//echo "CURL RESPONSE OK";
    }
	
	public function getFaktor(){
    	$this->load->model("api_bcn_model");
    	echo ($this->api_bcn_model->getFaktor());
    }

	public function getTebuBuma(){
    	$this->load->model("api_bcn_model");
    	echo ($this->api_bcn_model->getTebuBuma());
    }

	public function tes(){
   	  echo "OKE";
    }

	public function getDataDashboard(){
    	$this->load->model("api_bcn_model");
    	echo $this->api_bcn_model->getDataDashboard();
    }

  	public function getLastLhp(){
    	$this->load->model("api_bcn_model");
    	echo $this->api_bcn_model->getLastLhp();
  	}

	public function getDataLastLhp(){
    	$this->load->model("api_bcn_model");
    	echo $this->api_bcn_model->getDataLastLhp();
  	}

  public function getTbSetting(){
    $this->load->model("api_bcn_model");
    echo $this->api_bcn_model->getTbSetting();
  }

  public function getDataTimeSeries(){
    $this->load->model("api_bcn_model");
    $request = $this->input->post();
    echo $this->api_bcn_model->getDataTimeSeries($request);
    //var_dump($request);
  }

  public function testing(){
    echo "OK";
  }

}
