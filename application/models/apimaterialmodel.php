<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/24/2018
 * Time: 2:29 PM
 */
class apimaterialmodel extends SB_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getMaterial($search)
    {
        $sql = "SELECT a.* FROM m_material AS a WHERE a.`kode_material` LIKE '%$search%' OR a.`nama_material` LIKE '%$search%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getMaterialAll()
    {
        $sql = "SELECT a.* FROM m_material AS a";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getRelasi($search)
    {
        $sql = "SELECT a.* FROM m_relasi AS a WHERE a.`kode_relasi` LIKE '%$search%' OR a.`nama_relasi` LIKE '%$search%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getRelasiAll()
    {
        $sql = "SELECT a.* FROM m_relasi AS a ";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTTransaksi($no_transaski)
    {
        $sql = "SELECT * FROM t_transaksi_material AS a WHERE a.`no_transaksi` LIKE '%$no_transaski%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTTransaksiByNo($no_transaski)
    {
        $sql = "SELECT * FROM t_transaksi_material AS a WHERE a.`no_transaksi` = '$no_transaski'";

        $result = $this->db->query($sql);
        return $result->row();
    }

    public function getTmaterialTransaksi($no_transaski, $tgl_1, $tgl_2)
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`no_transaksi` LIKE '%$no_transaski%'
                AND (DATE(tgl_timbang_1) BETWEEN '$tgl_1' AND '$tgl_2')";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTmaterialTiket($no_tiket)
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`no_tiket` = '$no_tiket'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function searchTmaterialTiket($no_tiket)
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`no_tiket` LIKE '%$no_tiket%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTimbangBynoTransaksi($no_transaksi)
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`no_transaksi` = '$no_transaksi'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTimbangBynoTransaksiNoId($no_transaksi)
    {
        $sql = "SELECT a.no_tiket,
                a.kode_material,
                a.nama_material,
                a.kode_relasi,
                a.nama_relasi,
                a.no_kendaraan,
                a.nama_supir,
                a.timbang_1,
                a.timbang_2,
                a.netto,
                a.tgl_timbang_1,
                a.tgl_timbang_2,
                a.jenis_transaksi,
                a.no_transaksi,
                a.status_timbang_1,
                a.status_timbang_2,
                a.ptgs_timbang FROM t_timbang_material AS a WHERE a.`no_transaksi` = '$no_transaksi'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTimbangByTimbang1()
    {
        $sql = "SELECT a.no_tiket,
                a.kode_material,
                a.nama_material,
                a.kode_relasi,
                a.nama_relasi,
                a.no_kendaraan,
                a.nama_supir,
                a.timbang_1,
                a.tgl_timbang_1,
                a.jenis_transaksi,
                a.no_transaksi,
                a.status_timbang_1 FROM t_timbang_material AS a WHERE a.`status_timbang_2` =''";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getLaporanNoTransaksi($tgl1, $tgl2)
    {
        $sql = "SELECT a.* FROM t_transaksi_material AS a WHERE a.`date_create` BETWEEN '$tgl1' AND '$tgl2' ";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getLaporanTimbangByTgl($tgl1, $tgl2)
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`tgl_timbang_2` BETWEEN '$tgl1' AND '$tgl2' ";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getLaporanTimbangByTglNoId($tgl1, $tgl2)
    {
        $sql = "SELECT a.no_tiket,
                a.kode_material,
                a.nama_material,
                a.kode_relasi,
                a.nama_relasi,
                a.no_kendaraan,
                a.nama_supir,
                a.timbang_1,
                a.timbang_2,
                a.netto,
                a.tgl_timbang_1,
                a.tgl_timbang_2,
                a.jenis_transaksi,
                a.no_transaksi,
                a.status_timbang_1,
                a.status_timbang_2,
                a.ptgs_timbang FROM t_timbang_material AS a WHERE a.`tgl_timbang_2` BETWEEN '$tgl1' AND '$tgl2' ";

        $result = $this->db->query($sql);
        return $result->result();
    }


    public function getNoTransaksiTimbangByTgl($tgl1, $tgl2)
    {
        $sql = "SELECT a.no_transaksi FROM t_timbang_material AS a WHERE a.`tgl_timbang_2` BETWEEN '$tgl1' AND '$tgl2' GROUP BY no_transaksi";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getNoTransaksiTimbang1()
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`status_timbang_2` = 0";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTmaterialMaterial($search_material)
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`kode_material` LIKE '%$search_material%' OR a.nama_material LIKE '%$search_material%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTmaterialRelasi($search_relasi)
    {
        $sql = "SELECT a.* FROM t_timbang_material AS a WHERE a.`kode_relasi` LIKE '%$search_relasi%' OR a.nama_relasi LIKE '%$search_relasi%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getZonaJarak()
    {
        $sql = "SELECT * FROM m_biaya_jarak";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getAffdeling()
    {
        $sql = "SELECT * FROM sap_m_affdeling";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTarabyNopol($nopol)
    {
      $sql = "SELECT * FROM m_tara_truk WHERE no_pol = '$nopol'";
      $result = $this->db->query($sql);
      return $result->result();
    }
}
