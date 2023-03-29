<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lapproduksimodel extends SB_Model
{

    public $table = 't_lap_produksi_pengolahan';
    public $primaryKey = 'id_laporan_produksi';

    public function __construct() {
        parent::__construct();

    }

    public static function querySelect(  ){


        return "   SELECT t_lap_produksi_pengolahan.* FROM t_lap_produksi_pengolahan   ";
    }
    public static function queryWhere(  ){

        return "  WHERE t_lap_produksi_pengolahan.id_laporan_produksi IS NOT NULL   ";
    }

    public static function queryGroup(){
        return "   ";
    }

    public function Insert($data)
    {
        $this->db->set($data);
        $this->db->insert('t_lap_produksi_pengolahan');
    }

    public function Update($kat, $hari_giling, $data)
    {
        $where = array(
            'hari_giling' => $hari_giling,
            'kat_ptpn' => $kat
        );
        $this->db->where($where);
        $this->db->update('t_lap_produksi_pengolahan', $data);
    }

    public function getTglGilingByHari($hari)
    {
        if($hari <= 1){
            $qry = "SELECT awal_giling AS tgl FROM tb_setting";
        }else{
            $qry = "SELECT (awal_giling + INTERVAL $hari-1 DAY) AS tgl FROM tb_setting";
        }

        $result = $this->db->query($qry)->row();
        return $result->tgl;
    }

    public function CekLaporanExist($kat, $hari_giling)
    {
        $sql = "SELECT COUNT(a.`id_laporan_produksi`) AS jumlah FROM `t_lap_produksi_pengolahan`AS a
                WHERE a.tgl_giling = '$hari_giling' AND a.kat_ptpn = '$kat'";
        $result = $this->db->query($sql);
        $count = $result->row();
        return $count->jumlah;
    }

    public function getKodeKatBySpat($jenis)
    {
        $sql = "SELECT 
                  a.`kat_ptp` AS kode_kat_ptp
                FROM
                  `vw_spta_luas_field_sap_kat_ptp` AS a 
                WHERE a.`kat_ptp` IS NOT NULL AND  SUBSTRING(a.`kat_ptp`, 1, 2) = '$jenis'
                GROUP BY a.`kat_ptp` ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKatBySpatJenis($jenis)
    {
        $sql = "SELECT 
                  a.`kat_ptp` AS kode_kat_ptp
                FROM
                  `vw_spta_luas_field_sap_kat_ptp` AS a 
                WHERE a.`kat_ptp` IS NOT NULL AND  a.`kat_ptp` = '$jenis'
                GROUP BY a.`kat_ptp` ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKatAll()
    {
        $sql = "SELECT * FROM `m_kat_lahan_ptp`   
				ORDER BY id_kat_ptp";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKat($jenis)
    {
        $sql = "SELECT * FROM `m_kat_lahan_ptp`   
				WHERE tipe_kat_lahan = '$jenis'";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKatMin($jenis)
    {
        $sql = "SELECT 
                  b.`kepemilikan` as kat_sap,
                  `get_kode_kat_lahan_ptp` (
                    `b`.`kepemilikan`,
                    `b`.`jenis_tanah`,
                    `b`.`status_blok`
                  ) AS `kode_kat_ptp`,
                  LEFT(b.`kepemilikan`, 2) AS jenis 
                FROM
                  sap_field AS b 
                  WHERE LEFT(b.`kepemilikan`, 2) = '$jenis'
                GROUP BY `get_kode_kat_lahan_ptp` (
                    `b`.`kepemilikan`,
                    `b`.`jenis_tanah`,
                    `b`.`status_blok`
                  ) ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKatNot($jenis)
    {
        $sql = "SELECT * FROM `m_kat_lahan_ptp` 
				WHERE tipe_kat_lahan = '$jenis' AND NOT (kode_kat_ptp = 'TS-TR' AND 
				kode_kat_ptp = 'TR-TK' AND 
				kode_kat_ptp = 'TR-TM')   
				ORDER BY id_kat_ptp";
        $result = $this->db->query($sql);
        return $result->result();
    }


    public function VwByKategoriByTimbangan($kategori, $hari)
    {
        $sql = "SELECT 
				a.kat_ptp,
				a.`hari_giling`,
				SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
				SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
				SUM(a.netto)/1000 AS netto
				FROM vw_spta_luas_field_sap_kat_ptp AS a
				WHERE a.`kat_ptp` = '$kategori' AND a.`tgl_giling` = '$hari'
				AND a.timb_netto_status = 1
				GROUP BY kat_ptp";
        $result = $this->db->query($sql);
        return $result->row();
    }

    public function VwByHariByTimbangan($hari)
    {
        $wr = "";
        if($hari == 1){
            $wr = "<= '".$this->getTglGilingByHari($hari)."'";
        }elseif($hari > 1){
            $wr = " = '".$this->getTglGilingByHari($hari)."'";
        }else{
            $wr = "<= '".$this->getTglGilingByHari(1)."'";
        }
        $sql = "SELECT 
				a.kat_ptp,
				a.`hari_giling`,
				SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
				SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
				SUM(a.netto)/1000 AS netto,
				SUM(a.netto) AS netto_kg
				FROM vw_laporan_prod AS a
				WHERE a.`tgl_timbang` <= '$hari'
				AND a.timb_netto_status = 1
				GROUP BY kat_ptp";
        $result = $this->db->query($sql);
        return $result->result();
    }


    public function VwByKategoriByAri($kategori, $hari)
    {
        $sql = "SELECT 
				a.kat_ptp,
				SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
				SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
				a.`hari_giling`,
				SUM(a.netto)/1000 AS netto,
				SUM(a.gula_ptr)/1000 AS gula_ptr,
				SUM(a.tetes_ptr)/1000 AS tetes_ptr,
				SUM(a.hablur_ari)/1000 AS hablur,
                ROUND(((SUM(a.`hablur_ari`)/SUM(a.`netto`))*100), 2) AS rendemen_total
				FROM vw_laporan_prod AS a
				WHERE a.`kat_ptp` = '$kategori' AND a.`tgl_giling` = '$hari'
				AND a.sbh_status = 1
				GROUP BY kat_ptp";
        $result = $this->db->query($sql);
        return $result->row();
    }

    public function VwByHariByAri($hari)
    {
        $sql = "SELECT 
				a.kat_ptp,
				SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
				SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
				a.`hari_giling`,
				SUM(a.netto)/1000 AS netto,
				SUM(a.gula_ptr)/1000 AS gula_ptr,
				SUM(a.tetes_ptr)/1000 AS tetes_ptr,
				SUM(a.hablur_ari)/1000 AS hablur,
				SUM(a.netto) AS netto_kg,
				SUM(a.gula_ptr) AS gula_ptr_kg,
				SUM(a.tetes_ptr) AS tetes_ptr_kg,
				SUM(a.hablur_ari) AS hablur_kg,
                ROUND(((SUM(a.`hablur_ari`)/SUM(a.`netto`))*100), 2) AS rendemen_total
				FROM vw_laporan_prod AS a
				WHERE a.tgl_giling = '$hari'
				GROUP BY kat_ptp";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function SumLap($kat, $hari)
    {
        $qry = "SELECT 
                SUM(a.`ha_tertebang`) AS sum_ha_tertebang,
                SUM(a.`qty_tertebang`)/1000 AS sum_qty_tertebang,
                SUM(a.`ha_digiling`) AS sum_ha_digiiling,
                SUM(a.`qty_digiling`)/1000 AS sum_qty_digiling,
                SUM(a.`qty_kristal`)/1000 AS sum_qty_kristal,
                ROUND(((SUM(a.`qty_kristal`)/SUM(a.`qty_digiling`))*100), 2) AS total_rendemen,
                SUM(a.`qty_gula_ptr`)/1000 AS sum_qty_gula_ptr,
                SUM(a.qty_tetes_ptr)/1000 AS sum_qty_tetes_ptr
                 FROM `t_lap_produksi_pengolahan` AS a
                WHERE a.tgl_giling < '$hari' AND a.kat_ptpn = '$kat'";
        $result = $this->db->query($qry);
        return $result->row();
    }

    public function SumLapHari($hari)
    {
        $qry = "SELECT 
                a.kat_ptpn,
                SUM(a.`ha_tertebang`) AS sum_ha_tertebang,
                SUM(a.`qty_tertebang`) AS sum_qty_tertebang,
                SUM(a.`ha_digiling`) AS sum_ha_digiiling,
                SUM(a.`qty_digiling`) AS sum_qty_digiling,
                SUM(a.`qty_kristal`) AS sum_qty_kristal,
                ROUND(((SUM(a.`qty_kristal`)/SUM(a.`qty_digiling`))*100), 2) AS total_rendemen,
                SUM(a.`qty_gula_ptr`) AS sum_qty_gula_ptr,
                SUM(a.qty_tetes_ptr) AS sum_qty_tetes_ptr
                 FROM `t_lap_produksi_pengolahan` AS a
                WHERE a.tgl_giling < '$hari' GROUP BY kat_ptpn ";
        $result = $this->db->query($qry);
        return $result->result();
    }

    public function SumLapTrans($hari)
    {
        $qry = "SELECT 
                a.`plant`,
                a.`plant` as kode_plant_trasnfer,
                a.`kat_ptpn`,
                SUM(a.`ha_tertebang`) AS sum_ha_tertebang,
                SUM(a.`qty_tertebang`)/1000 AS sum_qty_tertebang,
                SUM(a.`ha_digiling`) AS sum_ha_digiiling,
                SUM(a.`qty_digiling`)/1000 AS sum_qty_digiling,
                SUM(a.`qty_kristal`)/1000 AS sum_qty_kristal,
                ROUND(((SUM(a.`qty_kristal`)/SUM(a.`qty_digiling`))*100), 2) AS total_rendemen,
                SUM(a.`qty_gula_ptr`)/1000 AS sum_qty_gula_ptr,
                SUM(a.qty_tetes_ptr)/1000 AS sum_qty_tetes_ptr
                FROM `t_lap_produksi_pengolahan_trans` AS a
                WHERE a.tgl_giling < '$hari'
                GROUP BY a.kat_ptpn, a.plant ";
        $result = $this->db->query($qry);
        return $result->result();
    }

    public function GroupPlant()
    {
        $qry = "SELECT a.`kode_plant_trasnfer`, b.`nama_plant` 
                FROM t_spta AS a
                INNER JOIN sap_plant AS b ON b.`kode_plant` = a.`kode_plant_trasnfer`
                WHERE a.`kode_plant_trasnfer` != ''
                GROUP BY kode_plant_trasnfer";
        $result = $this->db->query($qry);
        return $result->result();
    }

    public function VwHariByTimbanganTransfer($hari)
    {
        $wr = "";
        if($hari == 1){
            $wr = "<= '".$this->getTglGilingByHari($hari)."'";
        }elseif($hari > 1){
            $wr = " = '".$this->getTglGilingByHari($hari)."'";
        }else{
            $wr = "<= '".$this->getTglGilingByHari(1)."'";
        }

        $qry = "SELECT 
                  a.kat_ptp,
                  a.`kode_plant_trasnfer`,
                  b.`nama_plant`,
                  a.`hari_giling`,
                  SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
                  SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
                  SUM(a.netto)/1000 AS netto, 
                  SUM(a.netto) AS netto_kg
                FROM
                  vw_laporan_prod AS a 
                  INNER JOIN sap_plant AS b 
                    ON b.`kode_plant` = a.`kode_plant_trasnfer` 
                WHERE a.`tgl_timbang` <= '$hari'
                  AND a.timb_netto_status = 1 
                  AND a.`kode_plant_trasnfer` != '' 
                GROUP BY a.`kat_ptp`,
                  a.`kode_plant_trasnfer` ";
        $result = $this->db->query($qry);
        return $result->result();
    }

    public function VwHariByAriTransfer($hari)
    {
        $qry = "SELECT 
              a.kat_ptp,
              a.`kode_plant_trasnfer`,
              b.`nama_plant`,
              SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
              SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
              a.`hari_giling`,
              SUM(a.netto)/1000 AS netto,
              SUM(a.gula_ptr)/1000 AS gula_ptr,
              SUM(a.tetes_ptr)/1000 AS tetes_ptr,
              SUM(a.hablur_ari)/1000 AS hablur,
              SUM(a.netto) AS netto_kg,
              SUM(a.gula_ptr) AS gula_ptr_kg,
              SUM(a.tetes_ptr) AS tetes_ptr_kg,
              SUM(a.hablur_ari) AS hablur_kg,
              ROUND(
                (
                  (SUM(a.`hablur_ari`) / SUM(a.`netto`)) * 100
                ),
                2
              ) AS rendemen_total 
            FROM
              vw_laporan_prod AS a 
              INNER JOIN sap_plant AS b 
                ON b.`kode_plant` = a.`kode_plant_trasnfer` 
            WHERE a.`kode_plant_trasnfer` != '' 
              AND a.`tgl_giling` = '$hari'
            GROUP BY a.`kat_ptp`, a.`kode_plant_trasnfer` ";
        $result = $this->db->query($qry);
        return $result->result();
    }

    public function PlantKategoriByTimbanganTransfer($kategori, $hari)
    {
        $qry = "SELECT 
                a.`kode_plant_trasnfer`
                FROM vw_laporan_prod AS a
                INNER JOIN sap_plant AS b ON b.`kode_plant` = a.`kode_plant_trasnfer`
                WHERE a.`kat_ptp` = '$kategori' AND a.`tgl_giling` = '$hari'
                AND a.timb_netto_status = 1
                GROUP BY a.`kode_plant_trasnfer`";
        $result = $this->db->query($qry);
        return $result->result();
    }

    public function ValidasiHaTertebang($hari_gliing)
    {
            $qry = "UPDATE t_selektor AS a
                    INNER JOIN t_spta AS b ON b.`id` =a.`id_spta`
                    SET tanaman_status = 1 WHERE b.`tgl_giling` = $hari_gliing";
            $this->db->query($qry);
    }

    public function QryTotalLappro()
    {
        $qry = "SELECT 
                hari_giling,
                FORMAT(SUM(ha_tertebang),3) AS ha_tertebang,
                SUM(qty_tertebang) AS qty_tertebang,
                FORMAT(SUM(ha_digiling),3) AS ha_digiling,
                SUM(qty_digiling) AS qty_digiling,
                SUM(qty_kristal) AS qty_kristal,
                FORMAT(SUM(qty_kristal)/SUM(qty_digiling)*100, 2) AS rendemen,
                SUM(qty_gula_ptr) AS qty_gula_ptr,
                SUM(qty_tetes_ptr) AS qty_tetes_ptr
                FROM t_lap_produksi_pengolahan GROUP BY tgl_giling";
        return $qry;
    }
}

?>
