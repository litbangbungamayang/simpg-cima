<style>
/* @font-face kit by Fonts2u (https://fonts2u.com) */ 
@font-face {font-family:"dot-matrix";src:url("<?=base_url('adminlte/font/1979_dot_matrix.eot');?>?") format("eot"),url("<?=base_url('adminlte/font/1979_dot_matrix.woff');?>") format("woff"),url("<?=base_url('adminlte/font/1979_dot_matrix.ttf');?>") format("truetype"),url("<?=base_url('adminlte/font/1979_dot_matrix.svg#1979-Dot-Matrix');?>") format("svg");font-weight:normal;font-style:normal;}
</style>

<page size="A4" style="font-size:10px;font-family: 'dot-matrix'">
<table style="width: 100%; margin-left: auto; margin-right: auto;" border="1" cellspacing="0" cellpadding="1">
<tbody>
<tr>
<td style="font-size:11px;padding-right:10px" align="right"><b>LAMPIRAN<br />NO DOCUMENT : <?=$do->no_do;?><br />TGL DOCUMENT : <?=date('j M Y', strtotime($do->tgl_act));?></b></td>
</tr>
<tr style="height: 99px;">
<td style="height: 99px;padding:10px" colspan="4">
<table style="width: 100%;">
<tbody>
<tr style="height: 13px;">
<td style="height: 13px;">NO PETAK</td>
<td style="height: 13px;"><?=$do->kode_blok;?></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">KATEGORI</td>
<td style="height: 13px;"><?=$do->kepemilikan;?></td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;">LUAS TERGILING</td>
<td style="height: 13px;"><?=number_format($do->ha_tergiling,3);?> Ha</td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">NAMA PEMILIK</td>
<td style="height: 13px;"><?=$do->nama_petani;?></td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;">KEBUN</td>
<td style="height: 13px;"><?=$do->deskripsi_blok;?></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">BERAT TEBU</td>
<td style="height: 13px;"><?=number_format($do->netto_tebu);?> Kg</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;">WILAYAH KKW</td>
<td style="height: 13px;"><?=$do->divisi;?></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">TETES PTR</td>
<td style="height: 13px;"><?=number_format($do->berat_tetes,2);?> Kg</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;"></td>
<td style="height: 13px;"></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">GULA / KUI TEBU</td>
<td style="height: 13px;"><?=number_format(($do->gula_100/($do->netto_tebu/100)),2);?> Kg</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 63px;">
<td style="height: 63px;padding:3px" colspan="4">
<table style="width: 100%; margin-left: auto; margin-right: auto;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 13px;">
<td style="height: 13px;" align="center" colspan="3"><b>GULA</b></td>
<td style="height: 13px;" align="center" rowspan="3"><b>
<p>PERIODE <?=strtoupper($do->nama_periode);?></p>
<p>Giling Tgl <?=date('j M Y', strtotime($do->tgl_awal));?> s/d <?=date('j M Y', strtotime($do->tgl_akhir));?></p></b>
</td>
</tr>
<?
$seratus = $do->gula_100;
$sembilan = $do->gula_90;
$sepuluh = $do->gula_10;
$hgula = floor($sembilan*$do->harga_gula);
$htetes = floor($do->berat_tetes*$do->harga_tetes);
if($sepuluh != 0){
?>
<tr style="height: 13px;">
<td style="height: 13px;" align="center"><b>100%<br />Kg</b></td>
<td style="height: 13px;" align="center"><b>DO<br />Kg</b></td>
<td style="height: 13px;" align="center"><b>Natura<br />Kg</b></td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;" align="center"><br /><?=number_format($seratus,2);?></td>
<td style="height: 13px;" align="center"><br /><?=number_format($sembilan,2);?></td>
<td style="height: 13px;" align="center"><br /><?=number_format($sepuluh,2);?></td>
</tr>
<?
}else{
?>
<tr style="height: 13px;">
<td style="height: 13px;" align="center"><b>100%<br />Kg</b></td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;" align="center"><br /><?=number_format($sembilan,2);?></td>
</tr>
<?
}
?>


</tbody>
</table>
</td>
</tr>
<tr style="height: 80px;">
<td style="height: 80px;padding:10px" colspan="4">
<table style="width: 100%;">
<tbody>
<tr>
<td colspan="3"><b><u>PENDAPATAN PETANI</u></b></td>

<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td width="250px">GULA</td>
<td>: <?=$sembilan;?></td>
<td>Kg x Rp.</td>
<td align="right"><?=number_format($do->harga_gula);?></td>
<td width="10%" align="right"> = Rp. </td><td align="right"><?=number_format($hgula);?></td>
</tr>
<tr>
<td>TETES</td>
<td>: <?=number_format($do->berat_tetes,2);?></td>
<td>Kg &nbsp;x Rp.</td>
<td align="right"><?=number_format($do->harga_tetes);?></td>
<td align="right"> = Rp. </td><td align="right"><?=number_format($htetes);?></td>
</tr>
<tr>
<td colspan="3"><i>Jumlah Pendapatan Petani</i></td>
<td>&nbsp;</td>
<td align="right"> = Rp. </td><td align="right" style="border-top:1px solid black">
<?
$total = round($hgula)+round($htetes);
echo '<b>'.number_format($total).'</b>';
?>

</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;" colspan="4">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;" colspan="4"><br />&nbsp;&nbsp;<b>PINJAMAN / KEWAJIBAN &amp; IURAN PTR KE PG :</b><br />
<table style="width:95%;margin:10px;" >
	<?
	//cari yang terbanyak dulu
	$sqlcx = $this->db->query("SELECT SUM(IF(posisi=0,1,0)) AS kanan,SUM(IF(posisi=1,1,0)) AS kiri FROM `t_do_potongan` WHERE id_do = $do->id")->row();
	
	if($sqlcx->kanan > $sqlcx->kiri){
		$banyak = 0;$sedikit = 1;
	} else{
		$banyak = 1;$sedikit = 0;
	}
	$k = array();
	$inc = 0;$tot2=0;
	$do_det_2 = $this->db->query("SELECT * FROM t_do_potongan WHERE id_do = $do->id and posisi=$sedikit order by id_potongan")->result_array();
	$do_det_1 = $this->db->query("SELECT * FROM t_do_potongan WHERE id_do = $do->id and posisi=$banyak order by id_potongan")->result_array();
	foreach ($do_det_2 as $det2) {
		
		$k[$inc] = '<td>'.$det2['nama_potongan'].'</td><td > = Rp. </td><td align="right" width="10%">'.number_format($det2['nominal']).'</td>';
		$inc++;
		$tot2+=$det2['nominal'];
	}
	$i=0;$tot1 =0;
	foreach ($do_det_1 as $det1) {
		?>
			<tr>
		<td ><?=$det1['nama_potongan'];?></td><td > = Rp. </td><td align="right" width="10%"><?=number_format($det1['nominal'])?></td><td width="5%">&nbsp;</td>
		<?  
		if(isset($k[$i])) echo $k[$i];
		$i++;
		$tot1+=$det1['nominal'];?>
	</tr>
		<?
	}
	$totalpotongan = $tot1+$tot2;
	$totalbersih = $total-$totalpotongan;
	?>
	<tr><td></td>
		<td style="border-top:1px solid black"> = Rp. </td><td align="right" style="border-top:1px solid black"><?=number_format($tot1)?></td>
		<td></td><td></td>
		<td style="border-top:1px solid black"> = Rp. </td><td align="right"  style="border-top:1px solid black"><?=number_format($tot2)?></td></tr>
</table>

<table style="width:97%;margin:10px">
<tr><td align="center"><b>Jumlah Pinjaman/Kewajiban dan Iuran PTR ke PG</b></td><td style="border-bottom:1px solid black"> = Rp. </td><td align="right" style="border-bottom:1px solid black"><?=number_format($totalpotongan);?></td></tr>
<tr><td align="center"><b>Pendapatan bersih Petani Tebu Rakyat</b></td><td style="border-bottom:1px solid black"> = Rp. </td><td align="right" style="border-bottom:1px solid black"><b><?=number_format($totalbersih);?></b></td></tr>
</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;" colspan="4" align="center">
	<br />
<i><b><?=siteHelpers::terbilang(($totalbersih));?> Rupiah</b></i>
</td>
</tr>

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</page>
<div class="pagebreak"></div>
