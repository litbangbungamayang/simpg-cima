<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/13/2018
 * Time: 5:02 PM
 */
class Dashboardtimbanganmodel extends CI_Model
{
    function __construct(){
    	$this->cima_env = "http://simpgcima.ptpn7.com/index.php/api_bcn/";
    }

	function getCurl($request){
    	$db_server = $request["db_server"];
    	$url = str_replace(" ", "", $request["url"]);
    	$curl = curl_init();
    	curl_setopt_array($curl, array(
      		CURLOPT_URL => $db_server.$url,
      		CURLOPT_RETURNTRANSFER => true,
      		CURLOPT_TIMEOUT => 30,
      		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      		CURLOPT_CUSTOMREQUEST => "GET",
      		CURLOPT_HTTPHEADER => array(
        		"cache-control: no-cache"
      		),
    	));
    	$response = curl_exec($curl);
    	$error = curl_error($curl);
    	curl_close($curl);
    	return $response; // output as json encoded
  	}

	public function getTebuBuma(){
    	$request = array("db_server" => $this->cima_env,
    		"url" => "getTebuBuma");
    	return ($this->getCurl($request));
  	}

    public function AntrianTruk()
    {
        $qry = $this->QryDataSelektor() . " AND b.jenis_spta != 'LORI' LIMIT 50";
        $result = $this->db->query($qry);
        $data = array();
        foreach ($result->result() as $tx){
            $data[] = array(
                'no' => $tx->no_urut,
                'no_spat' => $tx->no_spat,
                'no_angkutan' => $tx->no_angkutan,
                'tgl_selektor' => $tx->tgl_selektor,
                'bruto' => $tx->bruto,
                'timb_bruto_tgl' => $tx->timb_bruto_tgl,
                'waktu_tunggu' => $tx->waktu_tunggu,
                'jenis_spta' => $tx->jenis_spta,
            );
        }
        return $data;
    }

    public function AntrianLori()
    {
        $qry = $this->QryDataSelektorLori() . " AND b.jenis_spta = 'LORI' LIMIT 150";
        $result = $this->db->query($qry);
        $data = array();
        foreach ($result->result() as $tx){
            $data[] = array(
                'no' => $tx->no_urut,
                'no_spat' => $tx->no_spat,
                'no_angkutan' => $tx->no_angkutan,
                'tara' => $tx->tara,
                'tgl_selektor' => $tx->tgl_selektor,
                'no_trainstat' => $tx->no_trainstat,
                'jenis_spta' => $tx->jenis_spta,
            );
        }
        return $data;
    }

    public function AntrianSisapagi()
    {
        $qry = $this->QryDataAntrianSisaPagi();
        $result = $this->db->query($qry);
        $data = array();
        foreach ($result->result() as $tx){
            $data[] = array(
                'no_spat' => $tx->no_spat,
                'no_angkutan' => $tx->no_angkutan,
                'tgl_selektor' => $tx->tgl_selektor,
                'tgl_timbang' => $tx->tgl_timbang,
                'netto' => $tx->netto,
                'jenis_spta' => $tx->jenis_spta,
                'no_transloading' => $tx->no_transloading,
                'waktu_tunggu' => $tx->waktu_tunggu,
            );
        }
        return $data;
    }

    public function PrintDataCetakLori($trainstat, $noloko, $tgl_timbang)
    {
         $qry = $this->QryDataCetakTimbang() . " AND b.jenis_spta = 'LORI'
        AND a.no_trainstat = '$trainstat' AND c.no_loko = '$noloko' AND b.tgl_timbang = '$tgl_timbang' GROUP BY b.id ";
        $result = $this->db->query($qry)->result();
        return $result;
    }

    public function DataCetakLori($trainstat, $noloko)
    {
        $qry = $this->QryDataCetakTimbang() . " AND b.jenis_spta = 'LORI'
        AND a.no_trainstat = '$trainstat' AND c.no_loko = '$noloko'";
        $result = $this->db->query($qry);
        $data = array();
        foreach ($result->result() as $tx){
            $data[] = array(
                'no' => $tx->no_urut,
                'no_spat' => $tx->no_spat,
                'no_angkutan' => $tx->no_angkutan,
                'tgl_selektor' => $tx->tgl_selektor,
                'no_trainstat' => $tx->no_trainstat,
                'no_loko' => $tx->no_loko,
                'no_lori' => $tx->no_lori,
                'jenis_spta' => $tx->jenis_spta,
                'timb_bruto_tgl' => $tx->timb_bruto_tgl,
                'timb_netto_tgl' => $tx->timb_netto_tgl,
                'bruto' => $tx->bruto,
                'tara' => $tx->tara,
                'netto' => $tx->netto,
                'waktu_tunggu' => $tx->waktu_tunggu,
            );
        }
        return $data;
    }

    public function QryDataSelektorLori()
    {
        $qry = "SELECT a.`no_urut`, b.`no_spat`, a.`no_angkutan`, d.tara,
                a.`tgl_selektor`, IFNULL(b.`timb_bruto_tgl`,'-') AS timb_bruto_tgl, IFNULL(c.`bruto`,0) AS bruto, b.`jenis_spta`,
                a.`no_trainstat`, a.`no_urut`, a.`no_urut_timbang`,
                IFNULL(CONCAT(
                FLOOR(HOUR(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)) / 24), ' h ',
                MOD(HOUR(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)), 24), ' j ',
                MINUTE(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)), ' m'), '-') AS waktu_tunggu
                FROM t_selektor a
                INNER JOIN t_spta AS b ON b.id = a.`id_spta`
                LEFT JOIN t_timbangan AS c ON c.`id_spat` = a.`id_spta`
                LEFT JOIN m_lori AS d ON d.nolori = a.no_angkutan
                WHERE NOT (b.`timb_netto_status` = 1) AND
                (a.`tgl_selektor` >= NOW() - INTERVAL 2 DAY)";

        return $qry;
    }

    public function QryDataSelektor()
    {
        $qry = "SELECT a.`no_urut`, b.`no_spat`, a.`no_angkutan`,
                a.`tgl_selektor`, IFNULL(b.`timb_bruto_tgl`,'-') AS timb_bruto_tgl, IFNULL(c.`bruto`,0) AS bruto, b.`jenis_spta`,
                a.`no_trainstat`, a.`no_urut`, a.`no_urut_timbang`,
                IFNULL(CONCAT(
                FLOOR(HOUR(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)) / 24), ' h ',
                MOD(HOUR(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)), 24), ' j ',
                MINUTE(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)), ' m'), '-') AS waktu_tunggu
                FROM t_selektor a
                INNER JOIN t_spta AS b ON b.id = a.`id_spta`
                LEFT JOIN t_timbangan AS c ON c.`id_spat` = a.`id_spta`
                WHERE NOT (b.`timb_netto_status` = 1) AND
                (a.`tgl_selektor` >= NOW() - INTERVAL 2 DAY)";

        return $qry;
    }

    public function QryDataAntrianSisaPagi()
    {
        $qry = "SELECT
                    b.`no_spat`,
                    a.`no_angkutan`,
                    a.`tgl_selektor`,
                    IFNULL( b.`tgl_timbang`, '-' ) AS tgl_timbang,
                    IFNULL( c.`netto`, 0 ) AS netto,
                    b.`jenis_spta`,
                c.no_transloading,
                IFNULL(
                CONCAT(
                FLOOR( HOUR ( TIMEDIFF( NOW( ), b.timb_netto_tgl ) ) / 24 ),
                ' h ',
                MOD ( HOUR ( TIMEDIFF( NOW( ), b.timb_netto_tgl ) ), 24 ),
                ' j ',
                MINUTE ( TIMEDIFF( NOW( ), b.timb_netto_tgl ) ),
                ' m'
                ),
                '-'
                ) AS waktu_tunggu
                FROM
                    t_selektor a
                    INNER JOIN t_spta AS b ON b.id = a.`id_spta`
                    LEFT JOIN t_timbangan AS c ON c.`id_spat` = a.`id_spta`
                WHERE
                    (b.tgl_timbang BETWEEN (NOW() - INTERVAL 30 DAY) AND (NOW())) AND ( b.`timb_netto_status` = 1 )
                    AND b.meja_tebu_status = 0
                    AND NOT ( b.jenis_spta = 'LORI' )";

        return $qry;
    }

    public function QryDataCetakTimbang()
    {
        $qry = "SELECT
                  a.`no_urut`,
                  b.`no_spat`,
                  a.`no_angkutan`,
                  a.`tgl_selektor`,
                  IFNULL(b.`timb_bruto_tgl`, '-') AS timb_bruto_tgl,
                  IFNULL(c.`bruto`, 0) AS bruto,
                  IFNULL(c.`tara`, 0) AS tara,
                  IFNULL(c.`netto`, 0) AS netto,
                  IFNULL(b.`timb_netto_tgl`, '-') AS timb_netto_tgl,
                  b.`jenis_spta`,
                  b.`kode_blok`,
                  d.`deskripsi_blok`,
                  d.`kepemilikan`,
                  e.`nama_petani`,
                  a.`no_trainstat`,
                  c.`no_loko`,
                  c.`no_lori`,
                  a.`no_urut`,
                  a.`no_urut_timbang`,
                  f.`name` as mandor,
                  g.`name` as pta,
                  d.`divisi`
                FROM
                  t_selektor a
                  INNER JOIN t_spta AS b
                    ON b.id = a.`id_spta`
                  INNER JOIN t_timbangan AS c
                    ON c.`id_spat` = a.`id_spta`
                  INNER JOIN sap_field AS d
                    ON d.`kode_blok` = b.`kode_blok`
                  LEFT JOIN `sap_petani` AS e
                    ON e.`id_petani_sap` = d.`id_petani_sap`
                  INNER JOIN sap_m_karyawan AS f
                    ON f.`Persno` = a.`persno_mandor_tma`
                  INNER JOIN sap_m_karyawan AS g
                    ON g.`Persno` = b.`persno_pta`
                WHERE (b.`timb_netto_status` = 1) ";

        return $qry;
    }

	public function getDataPasok($tgl){
    	$result = $this->db->query('call temp_monitoring_pasok("'.$tgl.'")')->result();
    	return $result;
    }

  public function getDataSisteb($tgl){
    $result = $this->db->query('call monitoring_sisteb("'.$tgl.'")')->result();
    return $result;
  }

	public function getIntegrasi($tgl){
    	return $result = $this->db->query('call monitoring_integrasi("'.$tgl.'")')->result();
    }

	public function getDataTimbang($input){
    	$query = "select *,date_format(spta.tgl_timbang, '%d-%m-%Y') as tgl_timbang from t_timbangan timb
        	join t_spta spta on timb.id_spat = spta.id
            join t_selektor sel on sel.id_spta = spta.id
            join TBL_CORELAB cs on cs.NUMERATOR = spta.no_spat
			where spta.kode_blok = ? and spta.tgl_timbang = ?";
    	return json_encode($this->db->query($query, array($input["kode_blok"], $input["tgl_timbang"]))->result());
    }

	public function test($input){
    	return json_encode("OK");
    }

	public function getSisaTebuCaneyard(){
    	$result = $this->db->query('call info_caneyard')->result();
    	return $result;
    }
}
