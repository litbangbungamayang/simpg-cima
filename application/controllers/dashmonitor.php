<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashmonitor extends SB_Controller {

    protected $layout 	= "layouts/main";
	public $module 		= 'penjualan';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();
		
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	public function index()
	{

		echo $this->data['content'] = $this->load->view('dashmonitor',$this->data,true);
		//$this->load->view('layouts/main',$this->data);
	}


	///function untek cek kontroller aktif///
	public function pingAddress($ip){
   /* $socket = @fsockopen($ip, 80, $errno, $errstr, 1);
        if($socket){
                return true;
            fclose($socket);
        }else{
            return false;
        } */
        return true;
    }

    public function datasensor()
    {
    	///Setting IP kontroller
    $ip1 = "10.4.21.46";         /// Kontroller Boiler 
    $ip2 = "10.4.21.47";         /// Kontroller Milling 1
    $ip3 = "10.4.21.48";         /// Kontroller Milling 2


    	////Ambil Data Kontroller Mass Flow Boiler///

    if ($this->pingAddress($ip1)==true){
        $ch1 = curl_init();
        $sch1 = "http://".$ip1."/ch1/";
        curl_setopt($ch1, CURLOPT_URL, $sch1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        $output1 = curl_exec($ch1);
        curl_close($ch1);
        //echo $output;
        $data1 = substr($output1, 4);
    
        $ch2 = curl_init();
        $sch2 = "http://".$ip1."/ch2/";
        curl_setopt($ch2, CURLOPT_URL, $sch2);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        $output2 = curl_exec($ch2);
        curl_close($ch2);
        //echo $output;
        $data2 = substr($output2, 4);

        $ch3 = curl_init();
        $sch3 = "http://".$ip1."/ch3/";
        curl_setopt($ch3, CURLOPT_URL, $sch3);
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
        $output3 = curl_exec($ch3);
        curl_close($ch3);
        //echo $output;
        $data3 = substr($output3, 4);

        $ch4 = curl_init();
        $sch4 = "http://".$ip1."/ch4/";
        curl_setopt($ch4, CURLOPT_URL, $sch4);
        curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);
        $output4 = curl_exec($ch4);
        curl_close($ch4);
        //echo $output;
        $data4 = substr($output4, 4);

    }else{
        $data1 = 0;
        $data2 = 0;
        $data3 = 0;
        $data4 = 0;
    }


    ///Range data sensor dan pembulatan untuk stasiun boiler///
    $minflow = 0;
    $maxflow = 30;
    $pembulatan1 = 1;

    if ($data1 > 0) {
        $val1 = round((((int)$data1 / 1023) * ($maxflow - $minflow)), $pembulatan1 ) + $minflow;
    }else{
        $val1= 0;
    }

    if ($data2 > 0) {
        $val2 = round((((int)$data2 / 1023) * ($maxflow - $minflow)), $pembulatan1 ) + $minflow;
    }else{
        $val2= 0;
    }

    if ($data3 > 0) {
        $val3 = round((((int)$data3 / 1023) * ($maxflow - $minflow)), $pembulatan1 ) + $minflow;
    }else{
        $val3= 0;
    }

    if ($data4 > 0) {
        $val4 = round((((int)$data4 / 1023) * ($maxflow - $minflow)), $pembulatan1 ) + $minflow;
    }else{
        $val4= 0;
    }


////Ambil Data Kontroller 1 RPM Milling///
 
    if ($this->pingAddress($ip2)==true){
        $ch5 = curl_init();
        $sch5 = "http://".$ip2."/ch1/";
        curl_setopt($ch5, CURLOPT_URL, $sch5);
        curl_setopt($ch5, CURLOPT_RETURNTRANSFER, 1);
        $output5 = curl_exec($ch5);
        curl_close($ch5);
        //echo $output;
        $data5 = substr($output5, 4);
    
        $ch6 = curl_init();
        $sch6 = "http://".$ip2."/ch2/";
        curl_setopt($ch6, CURLOPT_URL, $sch6);
        curl_setopt($ch6, CURLOPT_RETURNTRANSFER, 1);
        $output6 = curl_exec($ch6);
        curl_close($ch6);
        //echo $output;
        $data6 = substr($output6, 4);

        $ch7 = curl_init();
        $sch7 = "http://".$ip2."/ch3/";
        curl_setopt($ch7, CURLOPT_URL, $sch7);
        curl_setopt($ch7, CURLOPT_RETURNTRANSFER, 1);
        $output7 = curl_exec($ch7);
        curl_close($ch7);
        //echo $output;
        $data7 = substr($output7, 4);

        $ch8 = curl_init();
        $sch8 = "http://".$ip2."/ch4/";
        curl_setopt($ch8, CURLOPT_URL, $sch8);
        curl_setopt($ch8, CURLOPT_RETURNTRANSFER, 1);
        $output8 = curl_exec($ch8);
        curl_close($ch8);
        //echo $output;
        $data8 = substr($output8, 4);

    }else{
        $data5 = 0;
        $data6 = 0;
        $data7 = 0;
        $data8 = 0;
    }

////Ambil Data Kontroller 2 RPM Milling///
    
    if ($this->pingAddress($ip3)==true){
        $ch9 = curl_init();
        $sch9 = "http://".$ip3."/ch1/";
        curl_setopt($ch9, CURLOPT_URL, $sch9);
        curl_setopt($ch9, CURLOPT_RETURNTRANSFER, 1);
        $output9 = curl_exec($ch9);
        curl_close($ch9);
        //echo $output;
        $data9 = substr($output9, 4);
    
        $ch10 = curl_init();
        $sch10 = "http://".$ip3."/ch2/";
        curl_setopt($ch10, CURLOPT_URL, $sch10);
        curl_setopt($ch10, CURLOPT_RETURNTRANSFER, 1);
        $output10 = curl_exec($ch10);
        curl_close($ch10);
        //echo $output;
        $data10 = substr($output10, 4);

        /*$ch11 = curl_init();
        $sch11 = "http://".$ip3."/ch3/";
        curl_setopt($ch11, CURLOPT_URL, $sch11);
        curl_setopt($ch11, CURLOPT_RETURNTRANSFER, 1);
        $output11 = curl_exec($ch11);
        curl_close($ch11);
        //echo $output;
        $data11 = substr($output11, 4);

        $ch12 = curl_init();
        $sch12 = "http://".$ip3."/ch4/";
        curl_setopt($ch12, CURLOPT_URL, $sch12);
        curl_setopt($ch12, CURLOPT_RETURNTRANSFER, 1);
        $output12 = curl_exec($ch12);
        curl_close($ch12);
        //echo $output;
        $data12 = substr($output12, 4);*/

    }else{
        $data9 = 0;
        $data10 = 0;
        //$data11 = 0;
        //$data12 = 0;
    }


    ///Range data sensor dan pembulatan untuk stasiun milling///
    $minrpm = 0;
    $maxrpm = 8000;
    $pembulatan2 = 0;

    if ($data5 > 0) {
        $val5 = round((((int)$data5 / 1023) * ($maxrpm - $minrpm)), $pembulatan2 ) + $minrpm;
    }else{
        $val5= 0;
    }

    if ($data6 > 0) {
        $val6 = round((((int)$data6 / 1023) * ($maxrpm - $minrpm)), $pembulatan2 ) + $minrpm;
    }else{
        $val6= 0;
    }

    if ($data7 > 0) {
        $val7 = round((((int)$data7 / 1023) * ($maxrpm - $minrpm)), $pembulatan2 ) + $minrpm;
    }else{
        $val7= 0;
    }

    if ($data8 > 0) {
        $val8 = round((((int)$data8 / 1023) * ($maxrpm - $minrpm)), $pembulatan2 ) + $minrpm;
    }else{
        $val8= 0;
    }

    if ($data9 > 0) {
        $val9 = round((((int)$data9 / 1023) * ($maxrpm - $minrpm)), $pembulatan2 ) + $minrpm;
    }else{
        $val9= 0;
    }

    if ($data10 > 0) {
        $val10 = round((((int)$data10 / 1023) * ($maxrpm - $minrpm)), $pembulatan2 ) + $minrpm;
    }else{
        $val10= 0;
    }


    //value gauge
    $valgauge1 = round(((int)$data1 / 1023) * 100 , 0);
    $valgauge2 = round(((int)$data2 / 1023) * 100 , 0);
    $valgauge3 = round(((int)$data3 / 1023) * 100 , 0);
    $valgauge4 = round(((int)$data4 / 1023) * 100 , 0);
    $valgauge5 = round(((int)$data5 / 1023) * 100 , 0);
    $valgauge6 = round(((int)$data6 / 1023) * 100 , 0);
    $valgauge7 = round(((int)$data7 / 1023) * 100 , 0);
    $valgauge8 = round(((int)$data8 / 1023) * 100 , 0);
    $valgauge9 = round(((int)$data9 / 1023) * 100 , 0);
    $valgauge10 = round(((int)$data10 / 1023) * 100 , 0);

    $ax = array($val1,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9,$val10);
    echo json_encode(array('data' => $ax,'tgl' => date('H:i:s - d F Y') ));

    }
	
	
	
	
	
}
