<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/12/2018
 * Time: 5:09 PM
 */
class Apitimbanganmodel extends SB_Model
{


    public function __construct() {
        parent::__construct();

    }

    public function CekSpatResultId($no_spat)
    {
        $this->db->start_cache();
        $sql = "SELECT * FROM t_spta WHERE no_spat = '$no_spat'";
        $query = $this->db->query($sql);
        $id_spat = $query->row();
        $this->db->stop_cache();
        $this->db->flush_cache();
        return $id_spat;
    }

    public function CekBrutoById($id_spat)
    {
        $this->db->start_cache();
        $qry = "SELECT id_spat FROM t_timbangan WHERE id_spat = '$id_spat'";
        $cek_bruto = $this->db->query($qry);

        if(count($cek_bruto->row()) == 0){
            return true;
        }else{
            return false;
        }
    }
	
	public function TaraRfid($rfid)
	{
		$this->db->select('*');
		$this->db->from('m_truk_gps');
		$this->db->where('rfid_sticker', $rfid);
		$result = $this->db->get();
		return $result->row();
	}

    public function Noloko()
    {
        $this->db->select('*');
        $this->db->from('m_no_loko');
        $cek_bruto = $this->db->get();
        return $cek_bruto->result();
    }

    public function TaraLori($no_lori)
    {
        $sql = "SELECT 
                  id,
                  IFNULL(grade, '-') AS grade,
                  tara,
                  IFNULL(taradate, '-') AS taradate,
                  IFNULL(usertara, '-') AS usertara,
                  IFNULL(kode_plant, '-') AS kode_plant 
                FROM
              m_lori  WHERE nolori = '$no_lori'";
        $lori = $this->db->query($sql);
        return $lori->row();
    }


    public function UpdateNetto($where , $data)
    {
        $this->db->where($where);
        $this->db->update('t_timbangan', $data);
    }

    public function cekStatusSpat($no_spat, $status, $value_status)
    {
        $sql = "SELECT id FROM t_spta WHERE no_spat = '$no_spat' AND $status = '$value_status'";
        $id_spat = $this->db->query($sql);
        return count($id_spat->row());
    }

    public function VByNoSpat($no_spat)
    {
        $query = $this->Query() . ' WHERE t_spta.no_spat = "'.$no_spat.'"   GROUP BY t_spta.id';

        $results = $this->db->query($query)->result();
        return $results;
    }
	
	public function VByRfid($rfid)
    {
        $query = $this->queryRfid() . ' WHERE t_spta.rfid_sticker = "'.$rfid.'" AND rfid_sticker_status = 1 GROUP BY t_spta.id ';
        $results = $this->db->query($query)->result();
        return $results;
    }

    public function VByNoLori($no_lori)
    {
        $query = $this->Query() . " WHERE t_selektor.no_angkutan = '$no_lori'
        and t_spta.selektor_status = '1' and t_spta.timb_netto_status = '0' and t_spta.meja_tebu_status = '0'
          GROUP BY t_spta.id";

        $results = $this->db->query($query)->row();
        return $results;
    }

    public function ListPenimbangan($status)
    {
        $query = "";
        if($status == "selektor"){
            $query = $this->Query() . ' WHERE t_spta.selektor_status = "1" and t_spta.timb_netto_status = "0"';
        }elseif ($status == "ari"){
            $query = $this->Query() . ' WHERE t_spta.ari_status = "1" and t_spta.timb_netto_status = "0"';
        }elseif ($status == "bruto"){
            $query = $this->Query() . ' WHERE t_spta.timb_bruto_status = "1"';
        }elseif ($status == "netto"){
            $query = $this->Query() . ' WHERE t_spta.timb_netto_status = "1"';
        }

        $results = $this->db->query($query)->result();
        return $results;

    }

    public function VwTimbanganCetakLori($train_stat, $no_loko)
    {
        $this->db->select('id');
        $this->db->where('train_stat', $train_stat);
        $this->db->where('no_loko', $no_loko);
        $this->db->from('vw_t_timbangan');
        $spat = $this->db->result();
        return $spat;
    }

    public function listAfd()
    {
        $qry = "SELECT * FROM sap_m_affdeling";
        $result = $this->db->query($qry)->result();
        return $result;
    }

    public function Angkutan()
    {
        $data = array(
            ['angkutan' =>'TRUK'],
            ['angkutan' =>'LORI'],
            ['angkutan' =>'ODONG2'],
            ['angkutan' =>'TRAKTOR']
        );

        return $data;
    }

    public function DataTahun()
    {
        $tahun = date('Y');
        $satu = 1; $dua = 2;
        $data = array(
            ['tahun' => "".($tahun-$dua).""],
            ['tahun' => "".($tahun-$satu).""],
            ['tahun' => $tahun],
            ['tahun' => "".($tahun+$satu).""],
            ['tahun' => "".($tahun+$dua).""]
        );
        return $data;
    }

    public function jenisLaporan()
    {
        $data = array(
            ['id'=> '1','jenis' => 'Per PETAK'],
            ['id'=> '2','jenis' => 'Per SPTA'],
        );

        return $data;
    }

    private function Query()
    {
        $qry = "SELECT 
                  t_spta.id,
                  t_spta.no_spat,
                  t_spta.kode_plant,
                  CONCAT(t_spta.kode_blok, ' (',CONCAT(IF(t_spta.metode_tma=1,'MNL ',IF(t_spta.metode_tma=2,'SMK ','MK '))),
                  IF(t_spta.angkut_pg = 1, CONCAT(' - ',bj.keterangan,')'),')')) AS kode_blok,
                  t_spta.persno_pta,
                  t_spta.id_petani_sap,
                  t_spta.tebang_pg,
                  t_spta.angkut_pg,
                  t_spta.metode_tma,
                  t_spta.kode_affd,
                  t_spta.selektor_status,
                  t_spta.selektor_tgl,
                  t_spta.pintu_masuk_status,
                  t_spta.pintu_masuk_tgl,
                  t_spta.timb_bruto_status,
                  t_spta.timb_bruto_tgl,
                  t_spta.timb_netto_status,
                  t_spta.timb_netto_tgl,
                  t_spta.meja_tebu_status,
                  t_spta.meja_tebu_tgl,
                  t_spta.ari_status,
                  t_spta.ari_tgl,
                  t_spta.hari_giling,
                  t_spta.tgl_giling,
                  sap_petani.`nama_petani` AS nama_petani,
                  CONCAT(pta.`name`, '-(', cc.Persno,' - ',cc.name,')') AS nama_pta,
                  t_spta.kode_kat_lahan,
                  t_selektor.tgl_tebang,
                  t_selektor.no_angkutan,
                  t_selektor.ptgs_angkutan,
                  t_selektor.no_trainstat,
                  t_selektor.no_urut_timbang,
                  sap_field.deskripsi_blok,
                  kkw.`name` AS nama_kkw,
                  t_timbangan.transloading_status,
                  t_timbangan.bruto,
                  t_timbangan.tara,
                  t_timbangan.netto,
                  t_timbangan.lokasi_timbang_1,
                  t_timbangan.lokasi_timbang_2,
                  t_timbangan.id_timbangan,
                  t_timbangan.tgl_bruto,
                  t_timbangan.tgl_tara,
                  t_timbangan.tgl_netto,
                  t_timbangan.no_transloading,
                  t_timbangan.ptgs_transloading,
                  t_timbangan.ptgs_timbang_1,
                  t_timbangan.ptgs_timbang_2,
                  t_timbangan.tgl_transloading,
                  t_timbangan.multi_sling,
                  t_timbangan.train_stat,
                  t_timbangan.no_lori,
                  t_timbangan.netto_final,
                  t_timbangan.netto_rafaksi,
                  t_timbangan.rafaksi_prosentis,
                  b.`kondisi_tebu` 
                FROM
                  t_spta 
                  LEFT JOIN sap_petani 
                    ON t_spta.id_petani_sap = sap_petani.`id_petani_sap`
                  INNER JOIN sap_m_karyawan AS pta 
                    ON t_spta.persno_pta = pta.Persno 
                  INNER JOIN t_selektor 
                    ON t_selektor.id_spta = t_spta.id 
                  INNER JOIN sap_field 
                    ON t_spta.kode_blok = sap_field.kode_blok 
                  INNER JOIN sap_m_affdeling AS aff1 
                    ON t_spta.kode_affd = aff1.kode_affd 
                  INNER JOIN sap_m_karyawan AS kkw 
                    ON aff1.Persno = kkw.Persno 
                  LEFT JOIN t_timbangan 
                    ON t_spta.id = t_timbangan.id_spat 
                  LEFT JOIN t_meja_tebu AS b 
                    ON t_spta.id = b.`id_spta`
                  INNER JOIN sap_m_karyawan AS cc 
                    ON t_selektor.`persno_mandor_tma` = cc.Persno
                  LEFT JOIN m_biaya_jarak AS bj
        ON bj.id_jarak = t_spta.jarak_id";
        return $qry;
    }
	
	private function queryRfid()
	{
		$str = "SELECT 
                  t_spta.id,
                  t_spta.no_spat,
                  t_spta.kode_plant,
                  CONCAT(t_spta.kode_blok, ' (',CONCAT(IF(t_spta.metode_tma=1,'MNL ',IF(t_spta.metode_tma=2,'SMK ','MK '))),
                  IF(t_spta.angkut_pg = 1, CONCAT(' - ',bj.keterangan,')'),')')) AS kode_blok,
                  t_spta.persno_pta,
                  t_spta.id_petani_sap,
                  t_spta.tebang_pg,
                  t_spta.angkut_pg,
                  t_spta.metode_tma,
                  t_spta.kode_affd,
                  t_spta.selektor_status,
                  t_spta.selektor_tgl,
                  t_spta.pintu_masuk_status,
                  t_spta.pintu_masuk_tgl,
                  t_spta.timb_bruto_status,
                  t_spta.timb_bruto_tgl,
                  t_spta.timb_netto_status,
                  t_spta.timb_netto_tgl,
                  t_spta.meja_tebu_status,
                  t_spta.meja_tebu_tgl,
                  t_spta.ari_status,
                  t_spta.ari_tgl,
                  t_spta.hari_giling,
                  t_spta.tgl_giling,
                  sap_petani.`nama_petani` AS nama_petani,
                  CONCAT(pta.`name`, '-(', cc.Persno,' - ',cc.name,')') AS nama_pta,
                  t_spta.kode_kat_lahan,
                  t_selektor.tgl_tebang,
                  t_selektor.no_angkutan,
                  t_selektor.ptgs_angkutan,
                  t_selektor.no_trainstat,
                  t_selektor.no_urut_timbang,
                  sap_field.deskripsi_blok,
                  kkw.`name` AS nama_kkw,
                  t_timbangan.transloading_status,
                  t_timbangan.bruto,
                  t_timbangan.tara,
                  t_timbangan.netto,
                  t_timbangan.lokasi_timbang_1,
                  t_timbangan.lokasi_timbang_2,
                  t_timbangan.id_timbangan,
                  t_timbangan.tgl_bruto,
                  t_timbangan.tgl_tara,
                  t_timbangan.tgl_netto,
                  t_timbangan.no_transloading,
                  t_timbangan.ptgs_transloading,
                  t_timbangan.ptgs_timbang_1,
                  t_timbangan.ptgs_timbang_2,
                  t_timbangan.tgl_transloading,
                  t_timbangan.multi_sling,
                  t_timbangan.train_stat,
                  t_timbangan.no_lori,
                  t_timbangan.netto_final,
                  t_timbangan.netto_rafaksi,
                  t_timbangan.rafaksi_prosentis,
                  b.`kondisi_tebu`,
				  truck.rfid_sticker,
				  truck.tara as tara_rfid				  
                FROM
                  t_spta 
                  LEFT JOIN sap_petani 
                    ON t_spta.id_petani_sap = sap_petani.`id_petani_sap`
                  INNER JOIN sap_m_karyawan AS pta 
                    ON t_spta.persno_pta = pta.Persno 
                  INNER JOIN t_selektor 
                    ON t_selektor.id_spta = t_spta.id 
                  INNER JOIN sap_field 
                    ON t_spta.kode_blok = sap_field.kode_blok 
                  INNER JOIN sap_m_affdeling AS aff1 
                    ON t_spta.kode_affd = aff1.kode_affd 
                  INNER JOIN sap_m_karyawan AS kkw 
                    ON aff1.Persno = kkw.Persno 
                  LEFT JOIN t_timbangan 
                    ON t_spta.id = t_timbangan.id_spat 
                  LEFT JOIN t_meja_tebu AS b 
                    ON t_spta.id = b.`id_spta`
                  INNER JOIN sap_m_karyawan AS cc 
                    ON t_selektor.`persno_mandor_tma` = cc.Persno
                  LEFT JOIN m_biaya_jarak AS bj
					ON bj.id_jarak = t_spta.jarak_id
				  LEFT JOIN m_truk_gps as truck 
					ON t_spta.rfid_sticker=truck.rfid_sticker";
		return $str;
	}

}