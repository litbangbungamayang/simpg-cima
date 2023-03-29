<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apirawsugar extends SB_Controller
{
	function __construct() {
        parent::__construct();
        
    }

    function simpandata()
    {
        try{
            $no_spat = $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            $keterangan = $this->GetPost('keterangan');
            $keterangan_dua = $this->GetPost('keterangan_dua');
            $bruto = $this->GetPost('bruto');
            $tara = $this->GetPost('tara');
            $netto = $this->GetPost('netto');
            $tgl_bruto = date('Y-m-d H:i:s');
            $tgl_tara = date('Y-m-d H:i:s');
            $tgl_netto = date('Y-m-d H:i:s');
            $tgl_timbang = $this->getTglGiling();
            $operator = $this->GetPost('operator');
            $kode_timbangan = $this->GetPost('kode_timbangan');

            if($netto > 10){
            	$data = array(
					'keterangan' => $keterangan,
		            'keterangan_dua' => $keterangan_dua,
		            'bruto' => $bruto,
		            'tara' => $tara,
		            'netto' => $netto,
		            'tgl_bruto' => $tgl_bruto,
		            'tgl_tara' => $tgl_tara,
		            'tgl_netto' => $tgl_netto,
		            'tgl_timbang' => $tgl_timbang,
		            'operator_timbangan' => $operator,
		            'kode_timbangan' => $kode_timbangan
            	);

                $this->db->insert('t_timbangan_raw_sugar', $data);
                $insert_id = $this->db->insert_id();

                $this->inputLogs("t_timbangan_raw_sugar:insert=id:".$insert_id.";bruto:$bruto;tara:$tara;netto:$netto;
                    tgl_netto:$tgl_netto;tgl_tara:$tgl_tara;tgl_bruto:$tgl_bruto;keterangan:$keterangan;keterangan_dua:$keterangan_dua;
                    operator:$operator;kode_timbangan:kode_timbangan");

                $result = array(
                    'msg' => $insert_id,
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{
            	$result = array(
                    'msg' => 'gagal insert netto harus lebih dari 10 kg',
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

    function getrawtimbangan()
    {
    	$id = $this->GetPost('id');
    	$sql = "SELECT * FROM t_timbangan_raw_sugar where id = $id";
    	$result = $this->db->query($sql);
    	$count = $this->db->query($sql)->num_rows();

    	$data = array(
    		'result' => $result->row(),
    		'count' => $count	
    	);

    	echo json_encode($data);
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

    private function getTglGiling()
    {
        $sql = "SELECT get_tgl_giling() as sekarang";
        $query = $this->db->query($sql);
        $sekarang = $query->row();
        return $sekarang->sekarang;
    }

}