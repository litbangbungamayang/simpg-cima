<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 4/23/2018
 * Time: 11:11 PM
 */
class apilaptimbangan extends SB_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('mmasterfieldmodel');
        $this->model = $this->mmasterfieldmodel;
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Laporan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'laporan',
        ));
    }

    function index(){
        $this->data['content'] =  $this->load->view('laporantimbangan/index_timbangan', $this->data ,true);
        $this->load->view('layouts/cetak',$this->data);
    }

    function afdlist()
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->listAfd();
        if(count($result) > 0){
            foreach ($result[0] as $key => $value) {
                if (is_null($value)) {
                    $result[0]->$key = "";
                }
            }
            $output = array(
                'result' => $result,
                'count' => count($result),
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => array(),
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }
        echo json_encode($output);
    }

    function jenisangkutan()
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->Angkutan();
        if(count($result) > 0){
            foreach ($result[0] as $key => $value) {
                if (is_null($value)) {
                    $result[0]->$key = "";
                }
            }
            $output = array(
                'result' => $result,
                'count' => count($result),
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => array(),
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }
        echo json_encode($output);
    }

    function jenislaporan()
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->jenisLaporan();
        if(count($result) > 0){
            foreach ($result[0] as $key => $value) {
                if (is_null($value)) {
                    $result[0]->$key = "";
                }
            }
            $output = array(
                'result' => $result,
                'count' => count($result),
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => array(),
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }
        echo json_encode($output);
    }

    function tahunlap()
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->DataTahun();
        if(count($result) > 0){
            foreach ($result[0] as $key => $value) {
                if (is_null($value)) {
                    $result[0]->$key = "";
                }
            }
            $output = array(
                'result' => $result,
                'count' => count($result),
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => array(),
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }
        echo json_encode($output);
    }

    function printlaporan(){
        $wh = 'WHERE 0=0';
        $wh2 = 'WHERE 0=0';
        $slfield = "";
        $vn7 = "";

        $tgl1 = $_REQUEST['tgl1'];
        $tgl2 = $_REQUEST['tgl2'];
        $bln  = $_REQUEST['bln'];
        $thn  = $_REQUEST['thn'];
        $rjns = $_REQUEST['rjns'];
        $jns  = $_REQUEST['jns'];


        $kat  		= $_REQUEST['kat'];
        $angkutan  	= $_REQUEST['angkutan'];
        $afd  		= $_REQUEST['divisi'];
        $petak  	= $_REQUEST['kode_blok'];
        $tebangan  	= $_REQUEST['tebangan'];


        if($rjns == 1) {
            $wh .= " AND date(tgl_timbang) between '$tgl1' and '$tgl2'";
            $this->data['title'] = 	"PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).' <br />';
        }
        if($rjns == 2) {
            $wh .= " AND MONTH(tgl_timbang) = '$bln' and YEAR(tgl_timbang) = '$thn'";
            $this->data['title'] = 	"BULAN ".SiteHelpers::blnreport($bln)." TAHUN ".$thn.' <br />';
        }
        if($rjns == 3) {
            $wh .= " AND  YEAR(tgl_timbang) = '$thn'";
            $this->data['title'] = 	"TAHUN ".$thn.' <br />';
        }

        if($tebangan != '' && $jns != 1){
            $wh2 .= " AND  a.stt_ta = '$tebangan'";
            $kettimb = array('00'=>'TAS','11'=>'TAPG','10'=>'TPGAS','01'=>'TSAPG');
            $this->data['title'] .= 	" TEBANGAN ".$kettimb[$tebangan];
        }

        if($kat != ''){
            $wh .= " AND  kode_kat_lahan LIKE '$kat%'";
            $this->data['title'] .= 	" KATEGORI ".$kat;
        }

        if($angkutan != ''){
            $wh .= " AND  jenis_spta = '$angkutan'";
            $this->data['title'] .= 	" ANGKUTAN ".$angkutan;
        }

        if($afd != ''){
            $wh2 .= " AND  d.divisi = '$afd'";
            $this->data['title'] .= 	"<br /> AFDELING ".$afd;
        }

        if($petak != ''){
            $wh2 .= " AND  a.kode_blok = '$petak'";
            $this->data['title'] .= 	" PETAK ".$petak;
        }





        if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
            $file = "Laporan Timbangan - PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).".xls";
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=$file");
        }

        if($jns == 1){
            if(CNF_COMPANYCODE == 'N007'){
                $slfield = "b.no_hv,b.op_hv,b.no_stipping,b.op_stipping,b.no_gl,b.op_gl,";
                $vn7 = "perpetakn7";
            }else{
                $vn7 = "perpetak";
            }
            $sql = "SELECT a.`kode_blok`,d.`deskripsi_blok`,e.`nama_petani`,   b.persno_mandor_tma ,o.name AS mandor, a.persno_pta,
  w.name AS pta, $slfield a.`kode_kat_lahan`,SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,SUM(a.`odong2`) AS odong2,SUM(a.`traktor`) AS traktor,
d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang, c.lokasi_timbang_1 AS lokasi_tembang_1, c.lokasi_timbang_2 AS lokasi_tembang_2,
SUM(c.netto_final) AS netto, c.lokasi_timbang_1,c.lokasi_timbang_2,
(d.luas_ha-(SUM(b.ha_tertebang))) AS sisa FROM 
(SELECT *,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori,IF(jenis_spta='ODONG2',1,0) AS odong2,IF(jenis_spta='TRAKTOR',1,0) AS traktor FROM t_spta $wh) AS a
INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap`  INNER JOIN sap_m_karyawan o 
    ON o.Persno = b.persno_mandor_tma
  INNER JOIN sap_m_karyawan w 
    ON w.Persno = a.persno_pta  $wh2 GROUP BY a.`kode_blok`";
            $result = $this->db->query($sql)->result();

            $this->data['result'] = $result;
            $this->load->view('laporantimbangan/'.$vn7,$this->data);
        }else{
            if(CNF_COMPANYCODE == 'N007'){
                $slfield = "b.no_hv,b.op_hv,b.no_stipping,b.op_stipping,b.no_gl,b.op_gl,";
                $vn7 = "persptan7";
            }else{
                $vn7 = "perspta";
            }
            $sql = "SELECT a.no_spat,a.`kode_blok`,d.`deskripsi_blok`,d.divisi,e.`nama_petani`, b.persno_mandor_tma ,o.name AS mandor, a.persno_pta,
  w.name AS pta, $slfield a.`kode_kat_lahan`,b.no_angkutan,c.no_transloading,SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,SUM(a.`odong2`) AS odong2,SUM(a.`traktor`) AS traktor,
d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang, c.lokasi_timbang_1 AS lokasi_tembang_1, c.lokasi_timbang_2 AS lokasi_tembang_2,
c.`netto_final` AS netto, c.lokasi_timbang_1,c.lokasi_timbang_2,
a.stt_ta,
IF (a.metode_tma = 1, \"MANUAL\", IF (a.metode_tma = 2 , \"SEMI MEKANISASI\", IF(a.metode_tma = 3, \"MEKANISASI\", ''))) AS metode_tma,
  s.`kode_jarak`,
  s.`keterangan`,
  IF(b.`terbakar_sel` = 1, 'TERBAKAR', IF(b.`terbakar_sel` = 0, \"HIJAU\", \"-\")) AS terbakar_sel,
IF(a.stt_ta = '11','TAPG',IF(a.stt_ta = '10','TPGAS',IF(a.stt_ta='01','TSAPG','TAS'))) AS stt_ta_text,
(d.luas_ha-(SUM(b.ha_tertebang))) AS sisa,a.`timb_netto_tgl` FROM 
(SELECT *,CONCAT(tebang_pg,angkut_pg) AS stt_ta,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori,IF(jenis_spta='ODONG2',1,0) AS odong2,IF(jenis_spta='TRAKTOR',1,0) AS traktor FROM t_spta $wh) AS a
INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap` INNER JOIN sap_m_karyawan o 
    ON o.Persno = b.persno_mandor_tma
    LEFT JOIN m_biaya_jarak s
    ON s.`id_jarak` = a.jarak_id 
  INNER JOIN sap_m_karyawan w 
    ON w.Persno = a.persno_pta $wh2 GROUP BY a.`id` ORDER BY a.stt_ta";
            $result = $this->db->query($sql)->result();

            $this->data['result'] = $result;
            $this->load->view('laporantimbangan/'.$vn7,$this->data);
        }


    }

    function petakget(){
        $g = $_GET;
        $src = $g['term'];
        $limit = $g['limit'];
        //var_dump($src);die();
        $a = $this->db->query("SELECT kode_blok,divisi,deskripsi_blok,kepemilikan FROM sap_field WHERE 0=0 and (kode_blok like '%$src%' OR deskripsi_blok like '%$src%') limit $limit")->result();
        $suburbs = array();
        foreach ($a as $d) {
            $suburbs[] = array( 'divisi' => $d->divisi,'kode_blok' => $d->kode_blok,'kepemilikan' => $d->kepemilikan , 'deskripsi_blok'=>$d->deskripsi_blok);
        }
        echo json_encode( $suburbs );
    }
}