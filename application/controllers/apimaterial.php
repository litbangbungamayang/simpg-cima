<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/24/2018
 * Time: 1:43 PM
 */
class Apimaterial  extends SB_Controller
{

    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Api Timbangan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'apimaterial',
        ));
    }

    function carimaterial()
    {
        $search = $this->input->get('search');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getMaterial($search);

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
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }

    function carirelasi()
    {
        $search = $this->input->get('search');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getRelasi($search);

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
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }

    function gettiket()
    {
        $search = $this->input->get('no_tiket');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getTmaterialTiket($search);

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
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }

    function caritransaksi()
    {
        $search = $this->input->get('search');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getTTransaksi($search);

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
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }

    function simpanmaterial()
    {
        try{
            $this->load->model('apimaterialmodel');

            $no_transaksi = $this->GetPost('no_transaksi');
            $jenis_transaksi = $this->GetPost('jenis_transaksi');
            $supir = $this->GetPost('nama_supir');
            $no_kendaraan = $this->GetPost('no_kendaraan');
            $kode_barang = $this->GetPost('kode_material');
            $nama_barang = $this->GetPost('nama_material');
            $kode_relasi = $this->GetPost('kode_relasi');
            $nama_relasi = $this->GetPost('nama_relasi');
            $timbang_1 = $this->GetPost('timbang_1');


            $no_tiket = $this->GetPost('no_tiket');

            $transaksi = $this->apimaterialmodel->getTmaterialTiket($no_tiket);

            if(count($transaksi) == 0){

                $data = array(
                    'no_transaksi' => $no_transaksi,
                    'jenis_transaksi' => $jenis_transaksi,
                    'nama_supir' => $supir,
                    'no_kendaraan' => $no_kendaraan,
                    'kode_material' => $kode_barang,
                    'nama_material' => $nama_barang,
                    'kode_relasi' => $kode_relasi,
                    'nama_relasi' => $nama_relasi,
                    'timbang_1' => $timbang_1,
                    'tgl_timbang_1' =>date('Y-m-d H:i:s'),
                    'status_timbang_1' => "1"
                );

                $this->db->set($data);
                $this->db->insert('t_timbang_material');
                $insert_id = $this->db->insert_id();
                $sql = "select no_tiket from t_timbang_material where id_t_material = '$insert_id'";
                $hasil = $this->db->query($sql);
                $return_no_tiket = $hasil->row();

                $result = array(
                    'msg' => ' '.$return_no_tiket->no_tiket,
                    'status' => 'true'
                );
                echo json_encode($result);
            }else if(count($transaksi) == 1){

                $ptgs_timbang = $this->GetPost('ptgs_timbang');
                $timbang_2 = $this->GetPost('timbang_2');
                $netto = $this->GetPost('netto');

                $data = array(
                    'ptgs_timbang' => $ptgs_timbang,
                    'timbang_2' => $timbang_2,
                    'netto' => $netto,
                    'tgl_timbang_2' =>date('Y-m-d H:i:s'),
                    'status_timbang_2' => "1"
                );

                $this->db->where(array('no_tiket' => $no_tiket));
                $this->db->update('t_timbang_material', $data);

                $result = array(
                    'msg' => "update ".$no_transaksi,
                    'status' => 'true'
                );
                echo json_encode($result);
            }

        }catch(Exception $ex){
            $result = array(
                'msg' => $ex,
                'status' => 'false'
            );
            echo json_encode($result);
        }
    }

    function simpanttransaksi()
    {
        try{
            $this->load->model('apimaterialmodel');

            $no_transaksi = $this->GetPost('no_transaksi');
            $keterangan_transaksi = $this->GetPost('keterangan_transaksi');
            $jenis_transaksi_post = $this->GetPost('jenis_transaksi');

            $transaksi = $this->apimaterialmodel->getTTransaksiByNo($no_transaksi);

            if(count($transaksi) == 0){

                $data = array(
                    'no_transaksi' => $no_transaksi,
                    'keterangan_transaksi' => $keterangan_transaksi,
                    'jenis_transaksi' => $jenis_transaksi_post,
                    'date_create' => $this->getDateNow()
                );

                $this->db->set($data);
                $this->db->insert('t_transaksi_material');

                $result = array(
                    'msg' => $no_transaksi,
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{

                $data = array(
                    'keterangan_transaksi' => $keterangan_transaksi,
                    'jenis_transaksi' => $jenis_transaksi_post
                );

                $this->db->where(array('no_transaksi' => $no_transaksi));
                $this->db->update('t_transaksi_material', $data);

                $result = array(
                    'msg' => "update ".$no_transaksi,
                    'status' => 'true'
                );
                echo json_encode($result);
            }

        }catch (Exception $ex){
            $result = array(
                'msg' => $ex,
                'status' => 'false'
            );
            echo json_encode($result);
        }
    }

    function simpantaratruk()
    {

        $no_pol = $this->GetPost('no_pol');
        $nama_supir = $this->GetPost('nama_supir');
        $zona = $this->GetPost('zona');
        $tara = $this->GetPost('tara');
        $ptgs_timbang = $this->GetPost('ptgs_timbang');
        $kategori = $this->GetPost('kategori');

        $row_zona = $this->db->query("select * from m_biaya_jarak where kode_jarak = '$zona'")->row();

        if($no_pol !== "" && $tara !== "" && $ptgs_timbang !== ""){
            $this->load->model('apitimbanganmodel');
            $result = $this->apitimbanganmodel->TaraLori($no_pol);

            try{
                if(count($result) > 0){
                    $where = array('no_pol' => $no_pol);
                    $this->db->where($where);
                    $this->db->update('m_tara_truk', array(
                        'tara' => $tara,
                        'zona' => $row_zona->id_jarak,
                        'nama_supir' => $nama_supir,
                        'ptgs_timbang' => $ptgs_timbang,
                        'kategori' => $kategori,
                        'tgl_tara' => $this->getDateNow()
                    ));
                }else{
                    $this->db->set(array(
                        'no_pol' => $no_pol,
                        'tara' => $tara,
                        'zona' => $row_zona->id_jarak,
                        'nama_supir' => $nama_supir,
                        'ptgs_timbang' => $ptgs_timbang,
                        'kategori' => $kategori,
                        'tgl_tara' => $this->getDateNow()
                    ));
                    $this->db->insert('m_tara_truk');
                }
                $result = array(
                    'msg' => "Berhasil simpan data No Pol : $no_pol Tara : $tara",
                    'status' => 'false'
                );
                echo json_encode($result);
            }catch (Exception $ex){
                $result = array(
                    'msg' => $ex,
                    'status' => 'false'
                );
                echo json_encode($result);
            }
        }else{
            $result = array(
                'msg' => 'parameter tidak lengkap',
                'status' => 'false'
            );
            echo json_encode($result);
        }

    }

    function zonajarak()
    {
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getZonaJarak();

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
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }



    function exceltaratruk(){
        $query = "SELECT a.*, b.* FROM m_tara_truk as a
                  inner join m_biaya_jarak as b on b.id_jarak = a.zona";

        $results = $this->db->query($query)->result();
        $this->data['rows'] = $results;

        $file = "Master-truk.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
        echo $this->load->view('apimaterial/taratrukexcel',$this->data, true );
    }

    function laporanbyno()
    {
        $search = $this->GetPost('q');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getTimbangBynoTransaksi($search);

        $this->data['result'] = $result;
        $this->data['title'] = $search;
        echo $this->load->view('apimaterial/laporanbyno',$this->data);
    }

    function laporanbynojson()
    {
        $search = $this->GetPost('q');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getTimbangBynoTransaksiNoId($search);

        $count = count($result);
        $data = array('result'=>$result,'count'=>$count,'msg'=>'success');
        echo json_encode($data);
    }

    function laporantransaksibytgl()
    {
        $tgl1 = $this->GetPost('tgl1');
        $tgl2 = $this->GetPost('tgl2');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getLaporanNoTransaksi($tgl1, $tgl2);

        $this->data['result'] = $result;
        $this->data['tgl1'] = $tgl1;
        $this->data['tgl2'] = $tgl2;
        echo $this->load->view('apimaterial/laporantransaksibytgl',$this->data);
    }

    function laporantimbanganbytgl()
    {
        $tgl1 = $this->GetPost('tgl1');
        $tgl2 = $this->GetPost('tgl2');
        $this->load->model('apimaterialmodel');
        $transaksi = $this->apimaterialmodel->getNoTransaksiTimbangByTgl($tgl1, $tgl2);
        $result = $this->apimaterialmodel->getLaporanTimbangByTgl($tgl1, $tgl2);

        $this->data['transaksi'] = $transaksi;
        $this->data['result'] = $result;
        $this->data['tgl1'] = $tgl1;
        $this->data['tgl2'] = $tgl2;
        echo $this->load->view('apimaterial/laporantimbanganbytgl',$this->data);
    }

    function laporantimbanganbytgljson()
    {
        $tgl1 = $this->GetPost('tgl1');
        $tgl2 = $this->GetPost('tgl2');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getLaporanTimbangByTglNoId($tgl1, $tgl2);

        $count = count($result);
        $data = array('result'=>$result,'count'=>$count,'msg'=>'success');
        echo json_encode($data);
    }


    function blumtimbangkedua()
    {
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getTimbangByTimbang1();

        $count = count($result);
        $data = array('result'=>$result,'count'=>$count,'msg'=>'success');
        echo json_encode($data);
    }

    function laporantimbangantimbangsatu()
    {
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getNoTransaksiTimbang1();

        $this->data['result'] = $result;
        echo $this->load->view('apimaterial/laptimbangsatu',$this->data);
    }

    private function GetPost($input){
        if($this->input->get($input)){
            $output = $this->input->get($input);
        }elseif($this->input->post($input)){
            $output = $this->input->post($input);
        }else{
            $output = "";
        }
        return $output;
    }

    private function getDateNow()
    {
        $sql = "SELECT NOW() as sekarang";
        $query = $this->db->query($sql);
        $sekarang = $query->row();
        return $sekarang->sekarang;
    }

    function gettara()
    {
        $search = $this->GetPost('no_pol');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getTarabyNopol($search);

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
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }
}
