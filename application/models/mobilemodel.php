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

	public function getDataTimbang($input){
  	$query =
    "
    select
      spta.no_spat, fld.kode_blok, fld.deskripsi_blok, (timb.netto_final) as netto, date_format(spta.tgl_timbang, '%d-%m-%Y') as tgl_timbang,
      cs.RAFAKSI, cs.HK, cs.KNPP, cs.NNPP
    from t_timbangan timb
      join t_spta spta on spta.id = timb.id_spat
      join t_selektor sel on sel.id_spta = spta.id
      join TBL_CORELAB cs on cs.NUMERATOR = spta.no_spat
        join sap_field fld on fld.kode_blok = spta.kode_blok
    where spta.tgl_timbang = ? and spta.kode_blok = ?
    ";
  	return json_encode($this->db->query($query, array($input["tgl_timbang"], $input["kode_blok"]))->result());
  }

  public function getDataTimbangPeriode($request){
    $query =
    "
      select *, date_format(spta.tgl_timbang, '%d-%m-%Y') as tgl_timbang from t_timbangan timb
        join t_spta spta on spta.id = timb.id_spat
        join t_selektor sel on sel.id_spta = spta.id
        join TBL_CORELAB cs on cs.NUMERATOR = spta.no_spat
      where spta.tgl_timbang >= ? and spta.tgl_timbang <= ?
    ";
    return json_encode($this->db->query($query, array($request["tgl_timbang_awal"], $request["tgl_timbang_akhir"]))->result());
  }

  public function getDataTimbangPeriodeGroup($request){
    $query =
    "
    select
    	spta.no_spat, fld.kode_blok, fld.deskripsi_blok, sum(timb.netto_final) as netto, date_format(spta.tgl_timbang, '%d-%m-%Y') as tgl_timbang,
      cs.RAFAKSI, cs.HK, cs.KNPP, cs.NNPP
    from t_timbangan timb
    	join t_spta spta on spta.id = timb.id_spat
    	join t_selektor sel on sel.id_spta = spta.id
    	join TBL_CORELAB cs on cs.NUMERATOR = spta.no_spat
      join sap_field fld on fld.kode_blok = spta.kode_blok
    where spta.tgl_timbang >= ?
      and spta.tgl_timbang <= ?
      and spta.kode_affd = concat('AFD',?)
      and spta.simtr_status = 0
    group by spta.tgl_timbang, fld.kode_blok
    ";
    return json_encode($this->db->query($query, array($request["tgl_timbang_awal"], $request["tgl_timbang_akhir"], $request["afd"]))->result());
  }

  public function updateIdPbtma($request){
    $query =
    "
    update t_spta set simtr_status = 1, simtr_id_pbtma = ?, simtr_tgl = now()
    where spta.kode_blok = ? and spta.tgl_timbang = ?
    ";
    return json_encode($this->db->query($query, array($request["id_pbtma"], $request["kode_blok"], $request["tgl_timbang"])));
  }

  public function getAllPetakKebunByKepemilikan($request){
    $query =
    "
      select *, vts.nama_varietas as nama_varietas
      from sap_field fld
        join sap_m_varietas vts on fld.kode_varietas = vts.id_varietas
      where kepemilikan = ? and fld.mature = ?
    ";
    return json_encode($this->db->query($query, array($request["kepemilikan"], $request["tahun_giling"]))->result());
  }

	public function getDataDaily($tglTimbang){
    $query = "call get_rend_cs(?)";
    return json_encode($this->db->query($query, array($tglTimbang))->result());
  }

  public function getLaporanAri($tglTimbang){
    $query = "call laporan_ari(?)";
    return json_encode($this->db->query($query, array($tglTimbang))->result());
  }

  public function getMonitoringIntegrasi($tglTimbang){
  	$query = "call monitoring_integrasi(?)";
  	return json_encode($this->db->query($query, array($tglTimbang))->result());
  }

  public function getTebuGilingSekarang(){
  	$query = "call get_tebuGiling_sekarang()";
  	return json_encode($this->db->query($query)->result());
  }

  public function getTebuGilingJamIni(){
  	$query = "call get_tebuGiling_jamIni()";
  	return json_encode($this->db->query($query)->result());
  }

  public function cekDuplikatFaktor($tglTimbang){
  	$query = "select count(*) as faktor from tbl_faktor where tgl_timbang = ?";
    return json_encode($this->db->query($query, array($tglTimbang))->result());
  }

  public function setFaktor($request){
  	$query = "insert into tbl_faktor set tgl_timbang = ?, faktor_efektif = ?";
  	$result = json_encode($this->db->query($query, array($request["tgl_timbang"], $request["faktor"])));
  	$result = $this->db->affected_rows();
  	return $result;
  }

  public function getFaktor(){
  	$query = "select * from tbl_faktor";
  	return json_encode($this->db->query($query)->result());
  }

  public function getTebuBuma(){
  	$query = "select sum(timb.netto_final/1000) as ton_tebu 
		from t_spta spta
			join t_timbangan timb on spta.id = timb.id_spat
		where kode_blok = 'BMCANEYARD'";
  	return json_encode($this->db->query($query)->result());
  }

  public function getDataDashboard(){
  	$query = "call dashboard_kombinasi()";
  	return json_encode($this->db->query($query)->result());
  }

  public function getLastLhp(){
    $query = "select max(tgl_giling) as last_lhp from t_lap_harian_pengolahan_ptpn";
    return json_encode($this->db->query($query)->result());
  }

  public function getDataLastLhp(){
    $query = "select * from t_lap_harian_pengolahan_ptpn where tgl_giling = (select max(tgl_giling) from t_lap_harian_pengolahan_ptpn)";
    return json_encode($this->db->query($query)->result());
  }

  public function getTbSetting(){
    $query = "select * from tb_setting";
    return json_encode($this->db->query($query)->result());
  }

  public function getDataTimeSeries($request){
    //========== TODO FOR DEBUGGING ========
    //$request['tgl_awal'] = "2020-08-01";
    //$request['tgl_akhir'] = "2020-08-31";
    //======================================
    /*
    $query_select = "select hari_giling, tgl_giling, ";
    foreach ($request['jenis_data'] as $jenis_data) {
      if($jenis_data == "sisa_tebu"){
        $query_select .= " (ton_tebang_total_sd-ton_giling_total_sd) as sisa_tebu, ";
      } else {
        $query_select .= " ".$jenis_data.", ";
      }
    }
    */
    $query_select = "select *, (ton_tebang_total_sd-ton_giling_total_sd) as sisa_tebu, ";
    $query_select .= " 0 as batas from t_lap_harian_pengolahan_ptpn laphar where tgl_giling >= ? and tgl_giling <= ?";
    return json_encode($this->db->query($query_select, array($request['tgl_awal'], $request['tgl_akhir']))->result());
    //var_dump(json_encode($this->db->query($query_select, array($request['tgl_awal'], $request['tgl_akhir']))->result()));
  }

}
