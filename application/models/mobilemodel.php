<?php
//if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/13/2018
 * Time: 5:02 PM
 */
class Mobilemodel extends CI_Model
{
    function __construct()
    {
    }

  public function login($request){
    $query = "
      select * from t_pta_mobile where persno = ? and pwd = ?
    ";
    $result_login = $this->db->query($query, array($request["usr"], $request["pwd"]))->row();
    if(!$result_login){
      header('WWW-Authenticate: Basic');
			header('HTTP/1.0 400 Bad Request');
      header('Content-type: application/json; charset=utf-8');
      $resp = (object) [
				'success' => false,
				'code' => 400,
				'data' => [],
				'message' => 'invalid username or password' 
			];
      return json_encode($resp);
    } else {
      $token = bin2hex(random_bytes(32));
      $query_token = "insert into t_token_mobile (access_token) values(?)";
      if ($this->db->query($query_token, array($token))){
        $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => [
            'access_token' => $token,
            'persno' => $result_login->persno,
            'wilayah' => $result_login->wilayah
          ],
          'message' => 'login successful' 
        ];
        return json_encode($resp);
      } else {
        header('WWW-Authenticate: Basic');
        header('HTTP/1.0 400 Bad Request');
        header('Content-type: application/json; charset=utf-8');
        $resp = (object) [
          'success' => false,
          'code' => 400,
          'data' => [],
          'message' => 'Bad server request' 
        ];
        return json_encode($resp);
      }
    }
  }

  public function petak($persno){
    $query = "select fld.id_field, fld.kode_plant, fld.divisi, fld.kode_blok, fld.deskripsi_blok
      from t_pta_mobile ptam
        join t_wilayah wil on ptam.wilayah = wil.wilayah
        join sap_field fld on fld.divisi = wil.divisi
      where ptam.persno = ? and fld.spt_status = ?";
    $result_petak = $this->db->query($query, array($persno, '1'))->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => $result_petak,
          'message' => 'success get data petak' 
        ];
    return json_encode($resp);
  }

  public function buka_petak($kode_blok){
    $query = "update sap_field set spt_status = 1, spt_tgl = CURRENT_TIMESTAMP() where kode_blok = ? ";
    $result = $this->db->query($query, array($kode_blok));
    return json_encode($result);
  }

  public function truk(){
    $query = "select tara.no_pol, tara.nama_supir, relasi.persno as persno_pta 
      from m_tara_truk tara
        join t_relasi_truk_pta relasi on relasi.no_pol = tara.no_pol";
    $result_truk = $this->db->query($query)->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => $result_truk,
          'message' => 'success get data truk' 
        ];
    return json_encode($resp);
  }

  public function pta($persno){
    /*$query = "select mkar.id_karyawan, mkar.Persno, mkar.company_code, mkar.plant_kode, mkar.name, mkar.id_jabatan 
        from t_pta_mobile ptam1
        left outer join t_pta_mobile ptam2 on ptam1.wilayah = ptam2.wilayah
        join sap_m_karyawan mkar on mkar.Persno = ptam2.persno
      where ptam1.persno = ? and mkar.id_jabatan = 3";
    */
    $query = "select kary.* from t_pta_mobile mob
      join t_pta_wilayah wil on mob.wilayah = wil.wilayah
      join sap_m_karyawan kary on kary.Persno = wil.Persno
      where mob.persno = ?";
    $result_pta = $this->db->query($query, array($persno))->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'primary_key' => 'id_karyawan',
          'data' => $result_pta,
          'message' => 'success get data PTA' 
        ];
    return json_encode($resp);
  }

  public function premi(){
    $query = "select * from t_premi_penalti where jenis = ?";
    $result_premi = $this->db->query($query, array("PREMI"))->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => $result_premi,
          'message' => 'success get data premi' 
        ];
    return json_encode($resp);
  }

  public function penalti(){
    $query = "select * from t_premi_penalti where jenis = ?";
    $result_premi = $this->db->query($query, array("PENALTI"))->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => $result_premi,
          'message' => 'success get data penalti' 
        ];
    return json_encode($resp);
  }

  public function gl(){
    $query = "select * from t_gl_harvester where jenis = ?";
    $result_gl = $this->db->query($query, array("GL"))->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => $result_gl,
          'message' => 'success get data grab loader' 
        ];
    return json_encode($resp);
  }

  public function harvester(){
    $query = "select * from t_gl_harvester where jenis = ?";
    $result_hv = $this->db->query($query, array("HARVESTER"))->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => $result_hv,
          'message' => 'success get data harvester' 
        ];
    return json_encode($resp);
  }

  public function versi(){
    $query = "select *, CONCAT(major,'.',minor,'.',patch) as txt from t_versi_mobile where tgl_versi = (select max(tgl_versi) from t_versi_mobile)";
    $result_versi = $this->db->query($query)->row();
    $resp = (object) [
        'success' => true,
        'code' => 200,
        'versi' => $result_versi->txt,
        'message' => 'success get versi'
      ];
    return json_encode($resp);
  }

  public function tes_api($payload){
    $query = "insert into t_tes_api (payload) values(?)";
    $result = $this->db->query($query,  array($payload));
    $status = false;
    if ($this->db->insert_id()){
      $status = true;
    }
		//echo json_encode($response);
    return $result;
  }

}
