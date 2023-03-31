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

  public function truk($persno){
    $query = "select tara.no_pol, tara.nama_supir 
      from m_tara_truk tara
        join t_relasi_truk_pta relasi on relasi.no_pol = tara.no_pol
      where relasi.persno = ?";
    $result_truk = $this->db->query($query, array($persno))->result();
    $resp = (object) [
          'success' => true,
          'code' => 200,
          'data' => $result_truk,
          'message' => 'success get data truk' 
        ];
    return json_encode($resp);
  }

}
