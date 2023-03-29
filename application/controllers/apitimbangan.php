<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apitimbangan extends SB_Controller
{
    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Api Timbangan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'apitimbangan',
        ));

    }

    function index()
    {

    }

    function login()
    {
        $user = $this->GetPost('username');
        $pass = md5($this->GetPost('password'));

        $result = $this->db->get_where('tb_users', array('username'=>$user, 'password' => $pass, 'group_id' => 8));


        if($result->num_rows() == 1){
            $msg = array('msg' => 'success', 'status' => 'true');
        }else{
            $msg = array('msg' => 'failure', 'status' => 'false');
        }
        echo json_encode($msg);
    }

    /**
     * @return array
     */
    function bynospat()
    {
        $no_spat = $this->input->get('no_spat');
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VByNoSpat($no_spat);

        if(count($result) == 1){
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
	
	function byrfid()
    {
        $rfid = $this->input->get('rfid');
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VByRfid($rfid);

        if(count($result) == 1){
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

	function tararfid()
	{
		$this->load->model('apitimbanganmodel');
		$rfid = $this->GetPost('rfid');
        $result = $this->apitimbanganmodel->TaraRfid($rfid);
		if(count($result) == 1){
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

    function bynolori($no_lori)
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VByNoLori($no_lori);


        if(count($result) == 1){
            foreach ($result as $key => $value) {
                if (is_null($value)) {
                    $result->$key = "";
                }
            }
            $output = array(
                'result' => array($result),
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

    function freetruck($id){
       $this->db->query("UPDATE m_truk_gps SET status=1,task_update=now(),id_spta=0 where id_spta='".$id."'");
    }

    function simpandcs()
    {
        try{
            $no_spat = $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            $netto = $this->GetPost('netto');
            $multi_sling = $this->GetPost('multi_sling');
            $tgl_timbang = $this->getDateNow();
            $lokasi_timbang = $this->GetPost('kode_timbangan');
            $ptgs_timbang = $this->GetPost('ptgs_timbang');

            if($status_nett == 0){
                $data = array(
                    'id_spat' => $id_spat[0]->id,
                    'bruto' => "0",
                    'tara' => "0",
                    'netto' => $netto,
                    'netto_final' => $netto,
                    'multi_sling' => $multi_sling,
                    'tgl_netto' => $tgl_timbang,
                    'tgl_tara' => $tgl_timbang,
                    'tgl_bruto' => $tgl_timbang,
                    'lokasi_timbang_1' => $lokasi_timbang,
                    'lokasi_timbang_2' => $lokasi_timbang,
                    'ptgs_timbang_1' => $ptgs_timbang,
                    'ptgs_timbang_2' => $ptgs_timbang,
                );

                if($this->GetPost('no_transloading') != "") {

                    $transloading_status = $this->GetPost('transloading_status');
                    $no_transloading = $this->GetPost('no_transloading');
                    $ptgs_transloading = $this->GetPost('ptgs_timbang');
                    $tgl_transloading = $tgl_timbang;
                    $multi_sling = $this->GetPost('multi_sling');

                    $data += array(
                        'transloading_status' => $this->GetPost('transloading_status'),
                        'no_transloading' => $this->GetPost('no_transloading'),
                        'ptgs_transloading' => $this->GetPost('ptgs_timbang'),
                        'tgl_transloading' => date('Y-m-d H:i:s'),
                        'multi_sling' => $this->GetPost('multi_sling'),
                    );

                    $this->inputLogs("t_timbangan:insert=id_spat:".$id_spat[0]->id.";bruto:0;tara:0;netto:$netto;netto_final:$netto;
                    tgl_netto:$tgl_timbang;tgl_tara:$tgl_timbang;lokasi_timbang_2:$lokasi_timbang;
                    ptgs_timbang_2:$ptgs_timbang;transloading_status:$transloading_status;no_transloading:$no_transloading;
                    ptgs_transloading:$ptgs_transloading;tgl_transloading:$tgl_transloading;multi_sling:$multi_sling");

                }else{
                    $this->inputLogs("t_timbangan:insert=id_spat:".$id_spat[0]->id.";bruto:0;tara:0;netto:$netto;netto_final:$netto;
                    tgl_netto:$tgl_timbang;tgl_tara:$tgl_timbang;lokasi_timbang_2:$lokasi_timbang;
                    ptgs_timbang_2:$ptgs_timbang;");
                }

                $this->db->set($data);
                $this->db->insert('t_timbangan');

                 $this->db->query("UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl='$tgl_timbang',timb_netto_status=1,timb_netto_tgl='$tgl_timbang',tgl_timbang=get_tgl_giling(),rfid_sticker_closetag=now(),rfid_sticker_status=2 WHERE id='".$id_spat[0]->id."'");
                 $this->freetruck($id_spat[0]->id);

                $this->inputLogs("t_timbangan:insert=id:".$id_spat[0]->id.";");

                $result = array(
                    'msg' => $this->GetPost('no_spat'),
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{
                $result = array(
                    'msg' => "Sudah pernah melakukan penimbangan Netto",
                    'status' => 'false'
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

    function simpanbrutojembatan()
    {
        try{
            $no_spat = $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);

            $cek_bruto =  $this->apitimbanganmodel->CekBrutoById($id_spat[0]->id);

            if($cek_bruto){
                $bruto = $this->GetPost('bruto');
                $tgl_bruto = date('Y-m-d H:i:s');
                $lokasi_timbang_1 = $this->GetPost('kode_timbangan');
                $ptgs_timbang_1 = $this->GetPost('ptgs_timbang');
                $data = array(
                    'id_spat' => $id_spat[0]->id,
                    'bruto' => $bruto,
                    'tgl_bruto' => $tgl_bruto,
                    'lokasi_timbang_1' => $lokasi_timbang_1,
                    'ptgs_timbang_1' => $ptgs_timbang_1,
                    'ptgs_timbang_1' => $ptgs_timbang_1,
                );

                $this->db->set($data);
                $this->db->insert('t_timbangan');

                $this->db->where(array('id' => $id_spat[0]->id));
                $this->db->update('t_spta', array('timb_bruto_status' => "1"));

                $result = array(
                    'msg' => $this->GetPost('no_spat'),
                    'status' => 'true'
                );

                $this->inputLogs("t_timbangan:insert=id:".$id_spat[0]->id.";bruto:$bruto;tgl_bruto:$tgl_bruto;
                lokasi_timbang_1:$lokasi_timbang_1;ptgs_timbanga_1:$ptgs_timbang_1");

                echo json_encode($result);
            }else{
                $result = array(
                    'msg' => 'sudah pernah timbang bruto',
                    'status' => 'false'
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

    function simpannettojembatan()
    {
        try{
            $no_spat = $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');
            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            $tara = $this->GetPost('tara');
            $netto = $this->GetPost('netto');
            $tgl_timbang = $this->getDateNow();
            $lokasi_timbang_2 = $this->GetPost('kode_timbangan');
            $ptgs_timbang_2 = $this->GetPost('ptgs_timbang');


            if($status_nett == 0){
                $data_netto = array(
                    'tara' => $tara,
                    'netto' => $netto,
                    'netto_final' => $netto,
                    'tgl_netto' => $tgl_timbang,
                    'tgl_tara' => $tgl_timbang,
                    'lokasi_timbang_2' => $lokasi_timbang_2,
                    'ptgs_timbang_2' => $ptgs_timbang_2,
                );



                if($this->GetPost('no_transloading') != "") {
                    $transloading_status = $this->GetPost('transloading_status');
                    $no_transloading = $this->GetPost('no_transloading');
                    $ptgs_transloading = $this->GetPost('ptgs_timbang');
                    $tgl_transloading = $tgl_timbang;

                    $data_netto += array(
                        'transloading_status' => $transloading_status,
                        'no_transloading' => $no_transloading,
                        'ptgs_transloading' => $ptgs_transloading,
                        'tgl_transloading' => $tgl_transloading,
                    );

                    $this->inputLogs("t_timbangan:update=id_spat:".$id_spat[0]->id.";tara:$tara;netto:$netto;netto_final:$netto;
                    tgl_netto:$tgl_timbang;tgl_tara:$tgl_timbang;lokasi_timbang_2:$lokasi_timbang_2;
                    ptgs_timbang_2:$ptgs_timbang_2;transloading_status:$transloading_status;no_transloading:$no_transloading;
                    ptgs_transloading:$ptgs_transloading;tgl_transloading:$tgl_transloading");

                }else{
                    $this->inputLogs("t_timbangan:update=id_spat:".$id_spat[0]->id."tara:$tara;netto:$netto;netto_final:$netto;
                    tgl_netto:$tgl_timbang;tgl_tara:$tgl_timbang;lokasi_timbang_2:$lokasi_timbang_2;
                    ptgs_timbang_2:$ptgs_timbang_2;");
                }

                $where = array('id_spat' => $id_spat[0]->id);
                $this->apitimbanganmodel->UpdateNetto($where, $data_netto);


                $this->db->query("UPDATE t_spta SET timb_netto_status=1,timb_netto_tgl='$tgl_timbang',tgl_timbang=get_tgl_giling(),rfid_sticker_closetag=now(),rfid_sticker_status=2 WHERE id='".$id_spat[0]->id."'");

                $this->freetruck($id_spat[0]->id);

                $result = array(
                    'msg' => $this->GetPost('no_spat'),
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{
                $result = array(
                    'msg' => 'Sudah melakukan penimbangan Netto',
                    'status' => 'false'
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
	
	

    function simpanlori()
    {
        try{
            $no_spat =  $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');
            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);

            if(count($id_spat) == 1){
                $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);


                $bruto = $this->GetPost('bruto');
                $tara = $this->GetPost('tara');
                $netto = $this->GetPost('netto');
                $lokasi_timbang_1 = $this->GetPost('kode_timbangan');
                $ptgs_timbang_1 = $this->GetPost('ptgs_timbang');
                $no_lori = $this->GetPost('no_lori');
                $train_stat = $this->GetPost('train_stat');
                $no_loko = $this->GetPost('no_loko');

                if($status_nett == 0){
                    $data = array(
                        'id_spat' => $id_spat[0]->id,
                        'bruto' => $bruto,
                        'tara' => $tara,
                        'netto' => $netto,
                        'netto_final' => $netto,
                        'tgl_netto' => $this->getDateNow(),
                        'tgl_tara' => $this->getDateNow(),
                        'tgl_bruto' => $this->getDateNow(),
                        'lokasi_timbang_1' => $lokasi_timbang_1,
                        'lokasi_timbang_2' => $lokasi_timbang_1,
                        'ptgs_timbang_1' => $ptgs_timbang_1,
                        'ptgs_timbang_2' => $ptgs_timbang_1,
                        'no_lori' => $no_lori,
                        'train_stat' => $train_stat,
                        'no_loko' => $no_loko
                    );
                    $tgl_timbang = date('Y-m-d H:i:s');
                    $this->db->set($data);
                    $this->db->insert('t_timbangan');

                     $this->db->query("UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl='$tgl_timbang',timb_netto_status=1,timb_netto_tgl='$tgl_timbang',tgl_timbang=get_tgl_giling() WHERE id='".$id_spat[0]->id."'");
                     
                    $this->inputLogs("t_timbangan:insert=id_spat:".$id_spat[0]->id."bruto:$bruto;tara:$tara;
                    netto:$netto;netto_final:$netto;tgl_netto:$tgl_timbang;tgl_tara:$tgl_timbang;tgl_bruto:$tgl_timbang;
                    lokasi_timbang_1:$lokasi_timbang_1;lokasi_timbang_2:$lokasi_timbang_1;ptgs_timbang_1:$ptgs_timbang_1;
                    ptgs_timbang_2:$ptgs_timbang_1;no_lori:$no_lori;train_stat:$train_stat;no_loko:$no_loko");

                    $result = array(
                        'msg' => "SPAT $no_spat Tersimpan",
                        'status' => 'true'
                    );
                    echo json_encode($result);

                }else{

                    $result = array(
                        'msg' => "SPAT $no_spat Sudah melakukan penimbangan",
                        'status' => 'false'
                    );
                    echo json_encode($result);

                }
            }else{
                $result = array(
                    'msg' => "No SPAT $no_spat tidak ditemukan",
                    'status' => 'false'
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
	
	

    function taralori($no_lori)
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->TaraLori($no_lori);

        echo json_encode($result);
    }

    function validasilori($no_lori)
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->TaraLori($no_lori);
        if(count($result) > 0){
            $output = array(
                'result' => $result,
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => array(),
                'msg' => 'error',
                'status' => 'false'
            );
        }
        echo json_encode($output);
    }

    function noloko()
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->NoLoko();
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



    public function cetaklori($train_stat, $no_loko)
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VwTimbanganCetakLori($train_stat, $no_loko);

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

    function cektara()
    {
        $nolori = $this->GetPost('nolori');
        $qry = "SELECT * FROM m_lori WHERE nolori = '$nolori'";
        $row = $this->db->query($qry)->row();
        if(count($row) == 0){
            $result = array(
                'msg' => "No Lori $nolori valid",
                'status' => 'true'
            );
        }else{
            $result = array(
                'msg' => "Data No Lori $nolori telah ada dengan tara $row->tara",
                'status' => 'false'
            );
        }

        echo json_encode($result);
    }

    function simpantaralori()
    {

        $no_lori = $this->GetPost('no_lori');
        $tara = $this->GetPost('tara');
        $ptgs_timbang = $this->GetPost('ptgs_timbang');

        if($no_lori !== "" && $tara !== "" && $ptgs_timbang !== ""){
            $this->load->model('apitimbanganmodel');
            $result = $this->apitimbanganmodel->TaraLori($no_lori);

            try{
                if(count($result) > 0){
                    $where = array('nolori' => $no_lori);
                    $this->db->where($where);
                    $this->db->update('m_lori', array(
                        'tara' => $tara,
                        'usertara' => $ptgs_timbang,
                        'taradate' => $this->getDateNow()
                    ));
                }else{
                    $this->db->set(array(
                        'nolori' => $no_lori,
                        'tara' => $tara,
                        'usertara' => $ptgs_timbang,
                        'taradate' => $this->getDateNow()
                    ));
                    $this->db->insert('m_lori');
                }
                $result = array(
                    'msg' => "Berhasil simpan data Lori : $no_lori Tara : $tara",
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

    function updatenolori()
    {
        $no_spat = $this->GetPost('no_spat');
        $no_lori = $this->GetPost('no_lori');
        $train_stat = $this->GetPost('train_stat');
        try{
            $qry = "SELECT * FROM t_spta WHERE no_spat = '$no_spat'";
            $result = $this->db->query($qry)->row();

            $this->db->where(array('id_spta' => $result->id));
            $this->db->update('t_selektor', array(
                'no_angkutan' => $no_lori,
                'no_trainstat' => $train_stat
            ));
            $result = array(
                'msg' => "SPAT $no_spat Terupdate",
                'status' => 'true'
            );
            echo json_encode($result);
        }catch (Exception $ex){

        }

    }

    function exceltaralori(){
        $query = "SELECT * FROM m_lori";

        $results = $this->db->query($query)->result();
        $this->data['rows'] = $results;

        $file = "Master-LORI.xls";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
        echo $this->load->view('mlori/downloadreportexcel',$this->data, true );
    }

    function viewtaralori(){
        $query = "SELECT * FROM m_lori";

        $results = $this->db->query($query)->result();
        $this->data['rows'] = $results;

        echo $this->load->view('mlori/downloadreportexcel',$this->data );
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
}