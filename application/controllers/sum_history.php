<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sum_history extends SB_Controller
{

	protected $layout 	= "layouts/main";
	public $module 		= 'sum_history';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();

		$this->load->model('sum_historymodel');
		$this->model = $this->sum_historymodel;
		$idx = $this->model->primaryKey;

		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'sum_history',
		));
		$this->col = array();
		$this->con = array();
		$inf = $this->info['config']['grid'];
		$inf = SiteHelpers::array_sort($inf, 'sortlist', SORT_ASC);
		$in=0;
		foreach ($inf as $key => $t) {
			if($t['view'] =='1'){
				$in++;
				$this->col[$in] = $t['field'];
				$this->con[$in] = $t['conn'];
			}
		}
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
	}

	function index()
	{
		if($this->access['is_view'] ==0)
		{
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		// Group users permission
		$this->data['access']		= $this->access;
        
		// Render into template
		$this->data['content'] = $this->load->view('sum_history/index',$this->data, true );
    $this->load->view('layouts/main', $this->data );
	}

	public function viewPasokSisteb($tgl){
		$this->load->model('dashboardtimbanganmodel');
		$this->model = $this->dashboardtimbanganmodel;
    	$htm_header = '<table class="table"><thead><tr>
        		<th style="padding: 0 0 0 7px;">RAYON</th>
            	<th style="text-align:right">MANUAL</th>
            	<th style="text-align:right; padding: 0 5px 0 5px">SEMI MEKANIS</th>
                <th style="padding: 0 5px 0 5px;text-align:right">MEKANIS CIMA</th>
                <th style="padding: 0 5px 0 5px;text-align:right">MEKANIS BUMA</th>
                <th style="padding: 0 5px 0 5px;text-align:right">LUAS TEBANG</th>
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
    	$mekanis_buma_ts = 0;
    	$mekanis_buma_tr = 0;
    	$mekanis_buma_tsi = 0;
    	$netto_ts = 0.00;
    	$netto_tr = 0.00;
    	$netto_tsi = 0.00;
    	$luas_ts = 0.00;
    	$luas_tr = 0.00;
    	$luas_tsi = 0.00;
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
                    <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($row->mekanis_buma,2).'</td>
                    <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($row->ha_tebang,2).'</td>
                    <td style="text-align:right; padding:0 0 0 0px;">'.number_format($row->netto,2).'</td>
                </tr>';
            	switch ($row->tstr){
                	case 'TS' :
                		$manual_ts += $row->manual;
                		$semi_mekanis_ts += $row->semi_mekanis;
                		$mekanis_ts += $row->mekanis;
                		$mekanis_buma_ts += $row->mekanis_buma;
                		$netto_ts += $row->netto;
                		$luas_ts += $row->ha_tebang;
                		break;
                	case 'TR' :
                		$manual_tr += $row->manual;
                		$semi_mekanis_tr += $row->semi_mekanis;
                		$mekanis_tr += $row->mekanis;
                		$mekanis_buma_tr += $row ->mekanis_buma;
                		$netto_tr += $row->netto;
                		$luas_tr += $row->ha_tebang;
                		break;
                	case 'TSI' :
                		$manual_tsi += $row->manual;
                		$semi_mekanis_tsi += $row->semi_mekanis;
                		$mekanis_tsi += $row->mekanis;
                		$mekanis_buma_tsi += $row->mekanis_buma;
                		$netto_tsi += $row->netto;
                		$luas_tsi += $row->ha_tebang;
                		break;
                }
            }
        	$htm_content .= '<tr style="font-weight:bold;background:#B6B6B6;">
                		<td style="padding: 0 0 0 7px;">Total TS</td>
                    	<td style="text-align:right;">'.number_format($manual_ts,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($semi_mekanis_ts,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_ts,2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_buma_ts,2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($luas_ts,2).'</td>
                    	<td style="text-align:right;">'.number_format($netto_ts,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold;background:#929292;color:white">
                		<td style="padding: 0 0 0 7px;">Total TR</td>
                    	<td style="text-align:right;">'.number_format($manual_tr,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($semi_mekanis_tr,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_tr,2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_buma_tr,2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($luas_tr,2).'</td>
                    	<td style="text-align:right;">'.number_format($netto_tr,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold;background:#B6B6B6;">
                		<td style="padding: 0 0 0 7px;">Total TSI</td>
                    	<td style="text-align:right;">'.number_format($manual_tsi,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($semi_mekanis_tsi,2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_tsi,2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($mekanis_buma_tsi,2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format($luas_tsi,2).'</td>
                    	<td style="text-align:right;">'.number_format($netto_tsi,2).'</td>
                	</tr>';
        	$htm_content .= '<tr style="font-weight:bold; color:white; background:black;">
                		<td style="padding: 0 0 0 7px;">Total Pasok</td>
                    	<td style="text-align:right;">'.number_format(($manual_ts + $manual_tr + $manual_tsi),2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format(($semi_mekanis_ts + $semi_mekanis_tr + $semi_mekanis_tsi),2).'</td>
                    	<td style="text-align:right; padding: 0 10px 0 5px">'.number_format(($mekanis_ts + $mekanis_tr + $mekanis_tsi),2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format(($mekanis_buma_ts + $mekanis_buma_tr + $mekanis_buma_tsi),2).'</td>
                        <td style="text-align:right; padding: 0 10px 0 5px">'.number_format(($luas_ts + $luas_tr + $luas_tsi),2).'</td>
                    	<td style="text-align:right;">'.number_format(($netto_ts + $netto_tr + $netto_tsi),2).'</td>
                	</tr>';
        } else {
        	echo '<br>Not an object or array';
        }
    	$htm_footer_end = '</table>';
    	echo $htm_header.$htm_content.$htm_footer_end;
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

}
