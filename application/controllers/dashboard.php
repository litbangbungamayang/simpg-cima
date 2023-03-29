<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends SB_Controller {

    protected $layout 	= "layouts/main";
	public $module 		= 'penjualan';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();


		if(!$this->session->userdata('logged_in')) redirect('user/login',301);

	}

	public function index()
	{
		$this->data = array();



		$this->data['content'] = $this->load->view('dashboard_cima',$this->data,true);
		$this->load->view('layouts/main',$this->data);
	}

	public function viewari()
	{
		$this->data = array();



		//$this->data['content'] = $this->load->view('layouts/dashari',$this->data,true);
		$this->load->view('layouts/dashari',$this->data);
	}


	public function viewpabrik()
	{
		$this->data = array();



		//$this->data['content'] = $this->load->view('layouts/dashari',$this->data,true);
		$this->load->view('layouts/dashpabrik',$this->data);
	}

	public function postgantimejatebu(){
		$this->session->set_userdata(array(
				'gilingan'		=> $_POST['mejatebu']
			));
		redirect('dashboard');
	}

	public function getDevGiling(){
        $qry_hargil = "SELECT get_tgl_giling() AS tgl_giling";
        $result = $this->db->query($qry_hargil)->row();
        $hargil = $result->tgl_giling;
        $c = curl_init('http://devproduksi.ptpn11.co.id/simpgdb/index.php/Apigiling/gilingperjam?tgl='.$hargil.'&CC='.CNF_COMPANYCODE.'&PC='.CNF_PLANCODE);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);
        echo $html;
    }

    public function gettgl(){
    	$a = $this->db->query("SELECT get_tgl_giling() AS tgl ")->row();
    	echo $a->tgl;
    }

    public function getlastari(){
    	$a = $this->db->query("SELECT * FROM t_ari order by id_ari desc limit 1")->row();
    	if($a){
    		echo json_encode(array('dtt'=>$a));
    	}else{
    		echo json_encode(array('dtt'=>0));
    	}
    }


	public function viewIntegrasi($tgl){
    	$htm_header = '<table class="table"><thead><tr>
        		<th style="padding: 0px 0px 0px 7px;">JAM</th>
            	<th style="text-align:right">SELEKTOR (UNIT)</th>
            	<th style="text-align:right">TIMBANGAN (TON)</th>
                <th style="text-align:right; padding: 0px 7px 0px 0px;">GILING (TON)</th>
            </tr></thead>';
    	$this->load->model('dashboardtimbanganmodel');
    	$this->model = $this->dashboardtimbanganmodel;
    	$content = $this->model->getIntegrasi($tgl);
    	$htm_content = '';
    	$jml_selektor = 0;
    	$jml_timbangan = 0.0;
    	$jml_digiling = 0.0;
    	if (is_array($content) || is_object($content)){
        	foreach ($content as $row){
            	$selektor = 0;
            	$timbangan = 0.0;
            	$digiling = 0.0;
            	(is_null($row->selektor)) ? $selektor = 0 : $selektor = $row->selektor;
            	(is_null($row->timbangan)) ? $timbangan = 0 : $timbangan = $row->timbangan;
            	(is_null($row->digiling)) ? $digiling = 0 : $digiling = $row->digiling;
            	$htm_content .= '<tr style="border-top: 1px solid #F0F0F0;">
                	<td style="color:blue; padding: 0px 0px 0px 7px; font-weight: bold;">'.$row->jam.':00'.'</td>
                    <td style="text-align:right; color:red; font-weight: bold;">'.$selektor.'</td>
                    <td style="text-align:right; color:red; font-weight: bold;">'.number_format($timbangan,2).'</td>
                    <td style="text-align:right; color:red;  font-weight: bold; padding: 0px 7px 0px 0px;">'.number_format($digiling,2).'</td>
                </tr>';
            	$jml_selektor += $row->selektor;
            	$jml_timbangan += $row->timbangan;
            	$jml_digiling += $row->digiling;
            }
        	$htm_content .= '<tr style="background:black; color:white;  font-weight: bold;">
                	<td style="padding: 0px 0px 0px 7px;">TOTAL</td>
                    <td style="text-align:right;">'.$jml_selektor.'</td>
                    <td style="text-align:right;">'.number_format($jml_timbangan,2).'</td>
                    <td style="text-align:right; padding: 0px 7px 0px 0px;">'.number_format($jml_digiling,2).'</td>
                </tr>';
        }
    	$htm_footer_end = '</table>';
    	echo $htm_header.$htm_content.$htm_footer_end;
    }

	public function viewSisaTebu(){
    	$this->load->model('dashboardtimbanganmodel');
    	$this->model = $this->dashboardtimbanganmodel;
    	$content = $this->model->getSisaTebuCaneyard();
    	$tebu_transfer = json_decode($this->model->getTebuBuma());
    	//var_dump($tebu_transfer);
    	$htm = '<div> Total tebu masuk s.d. saat ini : '.number_format($content[0]->tebu_masuk,2).' ton</div>';
    	$htm = $htm.'<div> Total tebu digiling s.d. saat ini : '.number_format($content[0]->tebu_giling,2).' ton</div>';
    	$htm = $htm.'<div> Sisa tebu saat ini (SIMPG) : '.number_format($content[0]->tebu_masuk - $content[0]->tebu_giling ,2).' ton</div>';
    	echo $htm;
    }

	public function viewPasokRayon($tgl){
    	$this->load->model('dashboardtimbanganmodel');
    	$this->model = $this->dashboardtimbanganmodel;
    	$htm_header = '<table class="table"><thead><tr>
        		<th style="padding: 0 0 0 7px;">RAYON</th>
            	<th style="text-align:right">ANTRIAN</th>
            	<th style="text-align:right; padding: 0 5px 0 5px">CANEYARD</th>
                <th style="padding: 0 5px 0 5px;text-align:right">TOTAL</th>
            	<th style="text-align:right; padding: 0 7 0 0px;">TON TEBU</th>
            </tr></thead>';
    	$content = $this->model->getDataPasok($tgl);
    	$htm_content = '';
    	$antrian_ts = 0;
    	$antrian_tr = 0;
    	$antrian_tsi = 0;
    	$caneyard_ts = 0;
    	$caneyard_tr = 0;
    	$caneyard_tsi = 0;
    	$total_ts = 0;
    	$total_tr = 0;
    	$total_tsi = 0;
    	$netto_ts = 0.00;
    	$netto_tr = 0.00;
    	$netto_tsi = 0.00;
    	if (is_array($content) || is_object($content)){
        	foreach($content as $row){
            	$nama_rayon = "";
            	if ($row->rayon == "RY LIT"){
                	$nama_rayon = "LITBANG";
                } else {
                	$nama_rayon = $row->rayon;
                }
            	$htm_content .= '<tr>
                	<td style="padding:0 0 0 7px;">'.$nama_rayon.'</td>
                    <td style="text-align:right;">'.$row->antrian.'</td>
                    <td style="text-align:right; padding: 0 10px 0 5px">'.$row->caneyard.'</td>
                    <td style="text-align:right; padding: 0 10px 0 5px">'.$row->totalrit.'</td>
                    <td style="text-align:right; padding:0 0 0 0px;">'.number_format($row->netto,2).'</td>
                </tr>';
            	switch ($row->tstr){
                	case 'TS' :
                		$antrian_ts += $row->antrian;
                		$caneyard_ts += $row->caneyard;
                		$total_ts += $row->totalrit;
                		$netto_ts += $row->netto;
                		break;
                	case 'TR' :
                		$antrian_tr += $row->antrian;
                		$caneyard_tr += $row->caneyard;
                		$total_tr += $row->totalrit;
                		$netto_tr += $row->netto;
                		break;
                	case 'TSI' :
                		$antrian_tsi += $row->antrian;
                		$caneyard_tsi += $row->caneyard;
                		$total_tsi += $row->totalrit;
                		$netto_tsi += $row->netto;
                		break;
                }
            }
        	$htm_content .= '<tr style="font-weight:bold;background:#B6B6B6;">
                		<td style="padding: 0 0 0 7px;">Total TS</td>
                    	<td style="text-align:right;">'.$antrian_ts.'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.$caneyard_ts.'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.$total_ts.'</td>
                    	<td style="text-align:right;">'.number_format($netto_ts,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold;background:#929292;color:white">
                		<td style="padding: 0 0 0 7px;">Total TR</td>
                    	<td style="text-align:right;">'.$antrian_tr.'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.$caneyard_tr.'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.$total_tr.'</td>
                    	<td style="text-align:right;">'.number_format($netto_tr,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold;background:#B6B6B6;">
                		<td style="padding: 0 0 0 7px;">Total TSI</td>
                    	<td style="text-align:right;">'.$antrian_tsi.'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.$caneyard_tsi.'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.$total_tsi.'</td>
                    	<td style="text-align:right;">'.number_format($netto_tsi,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold; color:white; background:black;">
                		<td style="padding: 0 0 0 7px;">Total Pasok</td>
                    	<td style="text-align:right;">'.($antrian_ts + $antrian_tr + $antrian_tsi).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.($caneyard_ts + $caneyard_tr + $caneyard_tsi).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.($total_ts + $total_tr + $total_tsi).'</td>
                    	<td style="text-align:right;">'.number_format(($netto_ts + $netto_tr + $netto_tsi),2).'</td>
                	</tr>';
        } else {
        	echo '<br>Not an object or array';
        }
    	$htm_footer_end = '</table>';
    	echo $htm_header.$htm_content.$htm_footer_end;
    }

    public function viewPasokSisteb($tgl){
      $this->load->model('dashboardtimbanganmodel');
    	$this->model = $this->dashboardtimbanganmodel;
    	$htm_header = '<table class="table"><thead><tr>
        		<th style="padding: 0 0 0 7px;">RAYON</th>
            	<th style="text-align:right">MANUAL</th>
            	<th style="text-align:right; padding: 0 5px 0 5px">SEMI MEKANIS</th>
                <th style="padding: 0 5px 0 5px;text-align:right">MEKANIS</th>
            	<th style="text-align:right; padding: 0 7 0 0px;">TOTAL</th>
            </tr></thead>';
    	$content = $this->model->getDataSisteb($tgl);
    	$htm_content = '';
    	$manual_ts = 0;
    	$manual_tr = 0;
    	$manual_tsi = 0;
    	$semi_mekanis_ts = 0;
    	$semi_mekanis_tr = 0;
    	$semi_mekanis_tsi = 0;
    	$mekanis_ts = 0;
    	$mekanis_tr = 0;
    	$mekanis_tsi = 0;
    	$netto_ts = 0.00;
    	$netto_tr = 0.00;
    	$netto_tsi = 0.00;
    	if (is_array($content) || is_object($content)){
        	foreach($content as $row){
            	$nama_rayon = "";
            	if ($row->rayon == "RY LIT"){
                	$nama_rayon = "LITBANG";
                } else {
                	$nama_rayon = $row->rayon;
                }
            	$htm_content .= '<tr >
                	<td style="padding:0 0 0 7px;">'.$nama_rayon.'</td>
                    <td style="text-align:right;">'.number_format($row->manual,2).'</td>
                    <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($row->semi_mekanis,2).'</td>
                    <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($row->mekanis,2).'</td>
                    <td style="text-align:right; padding:0 0 0 0px;">'.number_format($row->netto,2).'</td>
                </tr>';
            	switch ($row->tstr){
                	case 'TS' :
                		$manual_ts += $row->manual;
                		$semi_mekanis_ts += $row->semi_mekanis;
                		$mekanis_ts += $row->mekanis;
                		$netto_ts += $row->netto;
                		break;
                	case 'TR' :
                		$manual_tr += $row->manual;
                		$semi_mekanis_tr += $row->semi_mekanis;
                		$mekanis_tr += $row->mekanis;
                		$netto_tr += $row->netto;
                		break;
                	case 'TSI' :
                		$manual_tsi += $row->manual;
                		$semi_mekanis_tsi += $row->semi_mekanis;
                		$mekanis_tsi += $row->mekanis;
                		$netto_tsi += $row->netto;
                		break;
                }
            }
        	$htm_content .= '<tr style="font-weight:bold;background:#B6B6B6;">
                		<td style="padding: 0 0 0 7px;">Total TS</td>
                    	<td style="text-align:right;">'.number_format($manual_ts,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($semi_mekanis_ts,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_ts,2).'</td>
                    	<td style="text-align:right;">'.number_format($netto_ts,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold;background:#929292;color:white">
                		<td style="padding: 0 0 0 7px;">Total TR</td>
                    	<td style="text-align:right;">'.number_format($manual_tr,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($semi_mekanis_tr,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_tr,2).'</td>
                    	<td style="text-align:right;">'.number_format($netto_tr,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold;background:#B6B6B6;">
                		<td style="padding: 0 0 0 7px;">Total TSI</td>
                    	<td style="text-align:right;">'.number_format($manual_tsi,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($semi_mekanis_tsi,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_tsi,2).'</td>
                    	<td style="text-align:right;">'.number_format($netto_tsi,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold; color:white; background:black;">
                		<td style="padding: 0 0 0 7px;">Total Pasok</td>
                    	<td style="text-align:right;">'.number_format(($manual_ts + $manual_tr + $manual_tsi),2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format(($semi_mekanis_ts + $semi_mekanis_tr + $semi_mekanis_tsi),2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format(($mekanis_ts + $mekanis_tr + $mekanis_tsi),2).'</td>
                    	<td style="text-align:right;">'.number_format(($netto_ts + $netto_tr + $netto_tsi),2).'</td>
                	</tr>';
        } else {
        	echo '<br>Not an object or array';
        }
    	$htm_footer_end = '</table>';
    	echo $htm_header.$htm_content.$htm_footer_end;
    }

    public function viewperjam($tgl,$jns){
		//jns 1 selektor,2 timbangan, 3 gilingan
		$tgl = str_replace('%20', '', $tgl);
		$cc = CNF_COMPANYCODE;
		echo $tgl;
		$leftjoin = '';
		$fieldj = "";
		if($jns == 1){
			if($cc == 'N011' || $cc == 'N009' || $cc == 'N002'){
				$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Lori</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
			}else{
            	if($cc == 'N007'){
                	$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right"; style="padding: 0px 7px 0px 0px;">Total</th>
                              </tr>
                            </thead>';
                } else {
					$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Odong2</th>
                                <th class="text-right" >Traktor</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
                }
			}

			$fieldj = "jm.`jam` as jjm,selektor.*";
        	if ($cc == 'N091'){
            	$leftjoin = "LEFT JOIN (SELECT COUNT(id_spta) AS ttl,SUM(IF(b.`jenis_spta`='TRUK',1,0)) AS truk,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`='$tgl' AND a.`ditolak_sel` = 0
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS selektor ON selektor.jam=jm.jam";
            } else {
			$leftjoin = "LEFT JOIN (SELECT COUNT(id_spta) AS ttl,SUM(IF(b.`jenis_spta`='TRUK',1,0)) AS truk,SUM(IF(b.`jenis_spta`='LORI',1,0)) AS lori,SUM(IF(b.`jenis_spta`='ODONG2',1,0)) AS odong2,SUM(IF(b.`jenis_spta`='TRAKTOR',1,0)) AS traktor,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`='$tgl' AND a.`ditolak_sel` = 0
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS selektor ON selektor.jam=jm.jam";
            }
		}else if($jns == 2){
			if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
				$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Lori</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
			}else{
				if($cc == 'N007'){
                	$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right"; style="padding: 0px 7px 0px 0px;">Total</th>
                              </tr>
                            </thead>';
                } else {
					$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Odong2</th>
                                <th class="text-right" >Traktor</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
                }
			}
			$fieldj = "jm.`jam` as jjm,timbangan.*";
			$leftjoin = "LEFT JOIN (SELECT SUM(a.`netto_final`) AS ttl,SUM(IF(b.`jenis_spta`='TRUK',a.`netto_final`,0)) AS truk,SUM(IF(b.`jenis_spta`='LORI',a.`netto_final`,0)) AS lori,SUM(IF(b.`jenis_spta`='ODONG2',a.`netto_final`,0)) AS odong2,SUM(IF(b.`jenis_spta`='TRAKTOR',a.`netto_final`,0)) AS traktor,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_timbang`='$tgl'
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS timbangan ON timbangan.jam=jm.jam";
		}else{
        	if ($cc == 'N007'){
            	$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Gil 1</th>
                                <th class="text-right" style="padding: 0px 7px 0px 0px;">Total</th>
                              </tr>
                            </thead>';
            } else {
				$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Gil 1</th>
                                <th class="text-right" >Gil 2</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
            }
			$fieldj = "jm.`jam` as jjm,giling.*";
			$leftjoin = "LEFT JOIN (SELECT SUM(a.`netto_final`) AS ttl,SUM(IF(c.`gilingan`='1',a.`netto_final`,0)) AS gil1,SUM(IF(c.`gilingan`='5',a.`netto_final`,0)) AS gil2,CONVERT(DATE_FORMAT(b.`meja_tebu_tgl`,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id`
INNER JOIN t_meja_tebu c ON c.id_spta = b.`id` WHERE b.`tgl_giling`='$tgl'
GROUP BY DATE_FORMAT(b.`meja_tebu_tgl`,'%H')) AS giling ON giling.jam=jm.jam";
		}
		$sql = $this->db->query("SELECT $fieldj FROM t_lap_jam jm
				$leftjoin
 ORDER BY jm.`id`")->result();
		$ttltruk=0;$ttllori=0;$ttlodong2=0;$ttltraktor=0;$ttlall=0;
		$ttlgil1=0;$ttlgil2=0;
		foreach($sql as $r){
			if($jns == 1){
				if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
					$htm .="<tr>
					<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
					<td style='text-align:right;'>".number_format($r->truk)."</td>
					<td style='text-align:right;'>".number_format($r->lori)."</td>
					<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl)."</td></tr>";
				}else{
                	if ($cc == 'N007'){
                    	$htm .="<tr>
                    		<td style='text-align:left;color:blue;font-weight:bold; padding: 0px 0px 0px 0px'>".$r->jjm.":00</td>
                    		<td style='text-align:right;'>".number_format($r->truk)."</td>
                    		<td style='text-align:right;color:red;font-weight:bold; padding: 0px 7px 0px 0px'>".number_format($r->ttl)."</td></tr>";
                    } else {
										$htm .="<tr>
					<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
					<td style='text-align:right;'>".number_format($r->truk)."</td>
					<td style='text-align:right;'>".number_format($r->odong2)."</td>
					<td style='text-align:right;'>".number_format($r->traktor)."</td>
					<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl)."</td></tr>";
                    }
				}

				$ttltruk += $r->truk;
				$ttllori += $r->lori;
				$ttlodong2 += $r->odong2;
				$ttltraktor += $r->traktor;
				$ttlall += $r->ttl;

			}else if($jns == 2){
				if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
					$htm .="<tr>
				<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
				<td style='text-align:right;'>".number_format($r->truk/1000,2)."</td>
				<td style='text-align:right;'>".number_format($r->lori/1000,2)."</td>
				<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl/1000,2)."</td></tr>";
				}else{
                	if ($cc == 'N007'){
                    	$htm .="<tr>
							<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
							<td style='text-align:right;'>".number_format($r->truk/1000,2)."</td>
							<td style='text-align:right;color:red;font-weight:bold; padding: 0px 7px 0px 0px'>".number_format($r->ttl/1000,2)."</td></tr>";
                    } else {
					$htm .="<tr>
				<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
				<td style='text-align:right;'>".number_format($r->truk/1000,2)."</td>
				<td style='text-align:right;'>".number_format($r->odong2/1000,2)."</td>
				<td style='text-align:right;'>".number_format($r->traktor/1000,2)."</td>
				<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl/1000,2)."</td></tr>";
                    }
				}

				$ttltruk += $r->truk;
				$ttllori += $r->lori;
				$ttlodong2 += $r->odong2;
				$ttltraktor += $r->traktor;
				$ttlall += $r->ttl;

			}else{
            	if ($cc == 'N007'){
                	$htm .="<tr>
						<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
						<td style='text-align:right;'>".number_format($r->gil1/1000,2)."</td>
						<td style='text-align:right;color:red;font-weight:bold; padding: 0px 7px 0px 0px'>".number_format($r->ttl/1000,2)."</td></tr>";
                } else {
					$htm .="<tr>
						<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
						<td style='text-align:right;'>".number_format($r->gil1/1000,2)."</td>
						<td style='text-align:right;'>".number_format($r->gil2/1000,2)."</td>
						<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl/1000,2)."</td></tr>";
                }
				$ttlgil1 += $r->gil1;
				$ttlgil2 += $r->gil2;
				$ttlall += $r->ttl;
			}
		}

		if($jns == 1){
			if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
				$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk)."</td><td align='right'>".number_format($ttllori)."</td><td align='right'>".number_format($ttlall)."</td></tr>";
			}else{
            	if ($cc == 'N007'){
                	$htm .= "<tr style='background:black;color:white'><td style='padding: 0px 0px 0px 7px;'>TOTAL</td><td align='right'>".number_format($ttltruk)."</td><td style='color:white;text-align:right; padding: 0px 7px 0px 0px'>".number_format($ttlall)."</td></tr>";
                } else {
					$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk)."</td><td align='right'>".number_format($ttlodong2)."</td><td align='right'>".number_format($ttltraktor)."</td><td align='right'>".number_format($ttlall)."</td></tr>";
                }
			}

		}else if($jns == 2){
			if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
				$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk/1000,2)."</td><td align='right'>".number_format($ttllori/1000,2)."</td><td align='right'>".number_format($ttlall/1000,2)."</td></tr>";
			}else{
            	if ($cc == 'N007'){
                	$htm .= "<tr style='background:black;color:white;'><td style='padding:0px 0px 0px 7px;'>TOTAL</td><td align='right'>".number_format($ttltruk/1000,2)."</td><td style='text-align:right; padding:0px 7px 0px 0px'>".number_format($ttlall/1000,2)."</td></tr>";
                } else {
					$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk/1000,2)."</td><td align='right'>".number_format($ttlodong2/1000,2)."</td><td align='right'>".number_format($ttltraktor/1000,2)."</td><td align='right'>".number_format($ttlall/1000,2)."</td></tr>";
                }
			}
		}else{
        	if ($cc == 'N007'){
            	$htm .= "<tr style='background:black;color:white'><td style='padding:0px 0px 0px 7px;'>TOTAL</td><td align='right'>".number_format($ttlgil1/1000,2)."</td><td  style='text-align:right; padding:0px 7px 0px 0px'>".number_format($ttlall/1000,2)."</td></tr>";
            } else {
				$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttlgil1/1000,2)."</td><td align='right'>".number_format($ttlgil2/1000,2)."</td><td align='right'>".number_format($ttlall/1000,2)."</td></tr>";
            }
		}

		echo $htm.'</table>';

	}







}
