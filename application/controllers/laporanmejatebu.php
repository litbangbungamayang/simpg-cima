<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 2/28/2018
 * Time: 11:22 AM
 */
class laporanmejatebu extends SB_Controller
{
    protected $layout 	= "layouts/main";
    public $module 		= 'laporanmejatebu';
    public $per_page	= '10';

    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Laporan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'laporan',
        ));
    }

    function index(){
        $this->data['content'] =  $this->load->view('laporanmejatebu/index', $this->data ,true);
        $this->load->view('layouts/main',$this->data);
    }

    function printlaporan(){
        $wh = 'WHERE 0=0';

        $tgl1 = $_REQUEST['tgl1'];
        $tgl2 = $_REQUEST['tgl2'];
        $bln  = $_REQUEST['bln'];
        $thn  = $_REQUEST['thn'];
        $rjns = $_REQUEST['rjns'];
        $jns  = $_REQUEST['jns'];
        $metode_tma     = $_REQUEST['metode_tma'];

        if($rjns == 1) {
            $wh .= " AND date(tgl_giling) between '$tgl1' and '$tgl2'";
            $this->data['title'] = 	"PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2);
        }
        if($rjns == 2) {
            $wh .= " AND MONTH(tgl_giling) = '$bln' and YEAR(tgl_giling) = '$thn'";
            $this->data['title'] = 	"BULAN ".SiteHelpers::blnreport($bln)." TAHUN ".$thn;
        }
        if($rjns == 3) {
            $wh .= " AND  YEAR(tgl_giling) = '$thn'";
            $this->data['title'] = 	"TAHUN ".$thn;
        }
        if($metode_tma != ''){
            if ($jns == 1 || $jns == 4 ) {
                $wh .= " AND  b.metode_tma = '$metode_tma'";    
            }else{
                $wh .= " AND  a.metode_tma = '$metode_tma'";
            }
            if ($metode_tma == 1) {
                $title = "MANUAL";
            }else if($metode_tma == 2){
                $title = "SEMI";
            }else if($metode_tma == 3){
                $title = "MEKANISASI";
            }         
            $this->data['title'] .=     "<br> METODE TMA ".$title;
        }

        if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
                $file = "Laporan Meja Tebu - PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).".xls";
                header("Content-type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=$file");
            }

        if($jns == 1){
        $sql = "SELECT
  `b`.`no_spat`           AS `no_spat`,
  `b`.`kode_blok`         AS `kode_blok`,
  `e`.`deskripsi_blok`    AS `deskripsi_blok`,
  `b`.`kode_kat_lahan`    AS `kode_kat_lahan`,
  `c`.`name`              AS `mandor`,
   f.name as pta,
   b.`jenis_spta`,
   b.kode_affd,
   a.*,d.netto,d.no_transloading,b.hari_giling,b.tgl_giling,a1.tgl_meja_tebu,a1.kondisi_tebu,a1.kode_meja_tebu
FROM t_meja_tebu a1 
     INNER JOIN `t_selektor` `a` ON a1.id_spta=a.id_spta
     INNER JOIN `t_spta` `b` ON `a`.`id_spta` = `b`.`id`
     INNER JOIN t_timbangan d on b.id = d.id_spat
     INNER JOIN `sap_m_karyawan` `c`  ON `c`.`Persno` = CONVERT(`a`.`persno_mandor_tma` USING utf8)
     INNER JOIN `sap_field` `e` ON `e`.`kode_blok` = `b`.`kode_blok` 
	 INNER JOIN sap_m_karyawan as f ON f.Persno = b.persno_pta
	 $wh GROUP BY b.`id`
ORDER BY `a1`.`tgl_meja_tebu`,a1.kode_meja_tebu ASC";

        $result = $this->db->query($sql)->result();

        $this->data['result'] = $result;
        $this->load->view('laporanmejatebu/perspta',$this->data);
        }else if($jns == 2){
        $sql = "SELECT 
            `a`.`no_spat`,
                a.`kode_blok`,
                d.`deskripsi_blok`,
                e.`nama_petani`,
                a.`kode_kat_lahan`,
                SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,
                d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang,
                SUM(c.`netto_final`) AS netto,
                (d.luas_ha-(SUM(b.ha_tertebang))) AS sisa,
                count(if(x.kondisi_tebu='A', x.kondisi_tebu, NULL)) as A, 
                count(if(x.kondisi_tebu='B', x.kondisi_tebu, NULL)) as B, 
                count(if(x.kondisi_tebu='C', x.kondisi_tebu, NULL)) as C, 
                count(if(x.kondisi_tebu='D', x.kondisi_tebu, NULL)) as D, 
                count(if(x.kondisi_tebu='E', x.kondisi_tebu, NULL)) as E 
                FROM 
                (SELECT *,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori FROM t_spta $wh) AS a
                INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
                INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
                INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
                INNER JOIN t_meja_tebu x on x.id_spta = a.id
                LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap` GROUP BY a.`kode_blok`";

        $result = $this->db->query($sql)->result();

        $this->data['result'] = $result;
        $this->load->view('laporanmejatebu/print',$this->data);

        }else if($jns == 3){
            $this->data['title'] =  "TANGGAL ".SiteHelpers::datereport($tgl1);
            $this->data['titlex'] =  "TANGGAL ".SiteHelpers::datereport(date('Y-m-d', strtotime("-1 day")));
            $sqltimbang = $this->db->query("SELECT SUM(netto_final) AS total FROM t_timbangan a INNER JOIN t_spta b ON a.id_spat=b.id WHERE (b.tgl_timbang < '$tgl1') OR (b.`tgl_giling` < '$tgl1' AND b.`tgl_timbang` = '$tgl1')")->row();
            $sqlgiling = $this->db->query("select sum(netto_final) as total from t_timbangan a inner join t_spta b on a.id_spat=b.id where b.meja_tebu_status=1 and b.tgl_giling < '$tgl1'")->row();
            $sqlspa = $this->db->query("SELECT SQL_NO_CACHE 
                no_spat,
            a.`kode_blok`,
            a.kode_affd,
                d.`deskripsi_blok`,
                e.`nama_petani`,
                a.`kode_kat_lahan`,
                a.jenis_spta,
                c.no_angkutan,
                b.no_transloading,selektor_tgl,timb_netto_tgl,tgl_tebang,tgl_timbang,
                IF(CONCAT(tebang_pg,angkut_pg) = '11','TAPG',IF(CONCAT(tebang_pg,angkut_pg) = '10','TPGAS',IF(CONCAT(tebang_pg,angkut_pg)='01','TSAPG','TAS'))) AS stt_ta_text,
        IF(c.`terbakar_sel` = 1, 'TERBAKAR', IF(c.`terbakar_sel` = 0, \"TIDAK\", \"-\")) AS terbakar_sel,
                b.bruto,b.tara,
                b.netto
                FROM t_spta a 
            INNER JOIN t_timbangan b ON b.id_spat = a.id
            INNER JOIN t_selektor c ON c.id_spta=a.id 
            INNER JOIN sap_field d ON d.kode_blok=a.kode_blok
            LEFT JOIN sap_petani e ON e.`id_petani_sap`=d.`id_petani_sap`
            WHERE a.tgl_timbang < '$tgl1' AND (ISNULL(a.tgl_giling) OR a.tgl_giling='$tgl1') ORDER BY tgl_timbang,a.selektor_tgl ASC")->result();

        $this->data['timbangsd'] = $sqltimbang;
        $this->data['gilingsd'] = $sqlgiling;
        $this->data['result'] = $sqlspa;
        $this->load->view('laporanmejatebu/printsisa',$this->data);

        }else if($jns == 4){
            $sql = "SELECT
  `b`.`no_spat`           AS `no_spat`,
  `b`.`kode_blok`         AS `kode_blok`,
  `e`.`deskripsi_blok`    AS `deskripsi_blok`,
  `b`.`kode_kat_lahan`    AS `kode_kat_lahan`,
  `c`.`name`              AS `mandor`,
   b.`jenis_spta`,
   b.kode_affd,
   a.*
FROM `t_selektor` `a`
     INNER JOIN `t_spta` `b` ON `a`.`id_spta` = `b`.`id`
     INNER JOIN `sap_m_karyawan` `c`  ON `c`.`Persno` = CONVERT(`a`.`persno_mandor_tma` USING utf8)
     INNER JOIN `sap_field` `e` ON `e`.`kode_blok` = `b`.`kode_blok` 
     WHERE b.selektor_status = 1 AND b.timb_bruto_status = 0 AND DATEDIFF(DATE(NOW()),DATE(b.selektor_tgl)) > 2
      GROUP BY b.`id`
ORDER BY `a`.`tgl_selektor` ASC";

        $result = $this->db->query($sql)->result();

        $this->data['result'] = $result;
        $this->load->view('laporanmejatebu/printselektorkabur',$this->data);
        }
    }


}