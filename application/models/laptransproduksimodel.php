<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 5/3/2018
 * Time: 9:52 PM
 */
class Laptransproduksimodel extends SB_Model
{
    public $table = 't_lap_produksi_pengolahan_trans';
    public $primaryKey = 'id_laporan_produksi_trans';

    public function __construct() {
        parent::__construct();

    }

    public function Insert($data)
    {
        $this->db->set($data);
        $this->db->insert('t_lap_produksi_pengolahan_trans');
    }

    public function Update($kat, $plant, $hari_giling, $data)
    {
        $where = array(
            'hari_giling' => $hari_giling,
            'kat_ptpn' => $kat,
            'plant' => $plant
        );
        $this->db->where($where);
        $this->db->update('t_lap_produksi_pengolahan_trans', $data);
    }

    public function CekLaporanExist($kat, $plant, $hari_giling)
    {
        $sql = "SELECT COUNT(a.`id_laporan_produksi_trans`) AS jumlah FROM `t_lap_produksi_pengolahan_trans`AS a
                WHERE a.hari_giling = '$hari_giling' AND a.kat_ptpn = '$kat' AND a.plant = '$plant'";
        $result = $this->db->query($sql);
        $count = $result->row();
        return $count->jumlah;
    }
}