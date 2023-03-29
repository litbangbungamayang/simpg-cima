<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/7/2018
 * Time: 10:04 PM
 */
class Lapharpengolahanmodel extends SB_Model
{
    public function __construct() {
        parent::__construct();

    }

    public function HaTertebang($harigiling, $sd = false, $transfer = false)
    {
        $operator = " = ";
        if($sd){
            $operator = " < ";
        }
        $wh = $operator." ".$harigiling;
        $not = " NOT ";
        if($transfer){
            $not = " ";
        }
        $qry = "SELECT
                sum(a.ha_tertebang) as ha_tertebang,
                SUBSTRING(b.kode_kat_lahan, 1, 2) AS kategori
                FROM
                t_selektor AS a
                INNER JOIN t_spta AS b ON b.id = a.id_spta
                WHERE hari_giling $wh
                and $not (b.kode_kat_lahan = 'TS-TR')
                GROUP BY
                SUBSTRING(b.kode_kat_lahan, 1, 2)";
        $query = $this->db->query($qry);
        $result = $query->result();
        return $result;
    }


    public function HaTergiling($harigiling, $sd = false, $transfer = false)
    {
        $operator = " = ";
        if($sd){
            $operator = " < ";
        }
        $wh = $operator." ".$harigiling;
        $not = " NOT ";
        if($transfer){
            $not = " ";
        }
        $qry = "SELECT
                sum(a.ha_tertebang) as ha_tertebang,
                SUBSTRING(b.kode_kat_lahan, 1, 2) AS kategori
                FROM
                t_selektor AS a
                INNER JOIN t_spta AS b ON b.id = a.id_spta
                WHERE hari_giling $wh 
                and a.tanaman_status = 1
                and $not (b.kode_kat_lahan = 'TS-TR')
                GROUP BY
                SUBSTRING(b.kode_kat_lahan, 1, 2)";
        $query = $this->db->query($qry);
        $result = $query->result();
        return $result;
    }



    public function TebuDitebang($harigiling, $sd = false, $transfer = false)
    {
        $operator = " = ";
        if($sd){
            $operator = " < ";
        }
        $wh = $operator." ".$harigiling;
        $not = " NOT ";
        if($transfer){
            $not = " ";
        }
        $qry = "SELECT
                a.netto_final as netto,
                SUBSTRING(b.kode_kat_lahan, 1, 2) AS kategori
                FROM
                t_timbangan AS a
                INNER JOIN t_spta AS b ON b.id = a.id_spat
                WHERE hari_giling $wh 
                and $not (b.kode_kat_lahan = 'TS-TR')
                GROUP BY
                SUBSTRING(b.kode_kat_lahan, 1, 2)";
        $query = $this->db->query($qry);
        $result = $query->result();
        return $result;
    }

    public function TebuDigiling($harigiling, $sd = false, $transfer = false)
    {
        $operator = " = ";
        if($sd){
            $operator = " < ";
        }
        $wh = $operator." ".$harigiling;
        $not = " NOT ";
        if($transfer){
            $not = " ";
        }
        $qry = "SELECT
                a.netto_final as netto,
                SUBSTRING(b.kode_kat_lahan, 1, 2) AS kategori
                FROM
                t_timbangan AS a
                INNER JOIN t_spta AS b ON b.id = a.id_spat
                WHERE hari_giling $wh 
                and $not (b.kode_kat_lahan = 'TS-TR')
                GROUP BY
                SUBSTRING(b.kode_kat_lahan, 1, 2)";
        $query = $this->db->query($qry);
        $result = $query->result();
        return $result;
    }


}