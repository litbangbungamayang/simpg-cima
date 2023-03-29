<?php
$id = $_GET["id"];
$date = date("Y-m-d");
$dashboard = dashboard($id, $date);
function dashboard($id, $date){
	$field = array(
		"username" => $id,
		"tgl" => $date
	);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://10.4.11.11/simpg/index.php/apidistribusispta/dashboard");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$field);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	curl_close ($ch);
	$output = json_decode($server_output); 
	$data = $output->data;
	return $data;
}

function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>