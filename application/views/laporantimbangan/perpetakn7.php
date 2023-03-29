<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border: 1px solid #CCC;
		font-family: Arial, Helvetica, sans-serif;
		width:100%;
	}
	.tableizer-table td {
		padding: 4px;
		margin: 3px;
		border: 1px solid #CCC;
	}
	.tableizer-table th {
		background-color: #104E8B;
		color: #FFF;
		font-weight: bold;
		height:25px;padding:10px;
	}
</style>
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>
<tr>

<td align="left"  style="font-size:11px">
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?>
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" >
LAPORAN TIMBANGAN HARIAN PER PETAK<br />
<?=$title;?>
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow">
<!--
<th>NOMER PETAK</th>
<th>KEBUN</th>
<th>NAMA PETANI</th>
<th>KATEGORI</th>
<th>MANDOR</th>
<th>PTA</th>
<th>NO HV</th>
<th>OP HV</th>
<th>NO STIPPING</th>
<th>OP STIPPING</th>
<th>NO GL</th>
<th>OP GL</th>
<th>TRUK</th>
<th>LORI</th>
<th>ODONG2</th>
<th>TRAKTOR</th>
<th>HEKTAR</th>
<th>QTY TEBU</th>
<th>SISA HEKTAR</th>
<th>Tebu/Ha</th>
<th>MULAI TEBANG</th></tr>
-->
<th>KODE PETAK</th>
<th>PEN/NON-PEN</th>
<th>AFD</th>
<th>DESKRIPSI PETAK</th>
<th>KATG</th>
<th>MT</th>
<th>VARIETAS</th>
<th>LUAS BAKU (HA)</th>
<th>LUAS TERTEBANG (HA)</th>
<th>TEBU (TON)</th>
<th>RIT</th>
<th>SISA HEKTAR</th>
<th>PROTAS (TON/HA)</th>
<th>MULAI TEBANG</th>
<th>AKHIR TEBANG</th>
<th>AFF TEBANG</th>
<th>TON TAKMAR</th>
<th>TON SISA TEBU</th>
</tr>
</thead>
<tbody>
<?php
$truk = 0;
$lori = 0;
$odong2 = 0;
$traktor = 0;

$ha = 0;
$ha_pen = 0.00;
$luas_baku = 0;
$luas_baku_pen = 0;
$netto = 0;
$netto_pen = 0;
$tha = 0;
$protas = 0.00;
$protas_pen = 0.00;
$protas_non_pen = 0.00;
 foreach($result as $r){
 	if($r->tertebang > 0){
    	$protas = number_format((($r->netto)/1000)/$r->tertebang,2);
    }
	 echo '<tr><td> '.$r->kode_blok.' </td>
     		   <td> '.$r->others.' </td>
     		   <td> '.$r->divisi.' </td>
	 		   <td> '.$r->deskripsi_blok.' </td>
	 		   <td> '.$r->status_blok.' </td>
               <td> '.$r->periode.' </td>
               <td> '.$r->nama_varietas.' </td>
							 <td> '.$r->luas_ha.' </td>
	 		   <td align="right"> '.$r->tertebang.' </td>
	 		   <td align="right"> '.number_format(($r->netto)/1000,2).' </td>
               <td align="right"> '.$r->truk.'</td>
	 		   <td align="right"> '.$r->sisa.' </td>
	 		   <td align="right"> '.$protas.' </td>
               <td align="center"> '.$r->awal_tebang.' </td>
               <td align="center"> '.$r->akhir_tebang.' </td>
               <td align="center"> '.$r->aff_tebang.' </td>
               <td align="right"> '.number_format($r->takmar,2).' </td>
               <td align="right"> '.number_format($r->sisa_tebu,2).' </td>
	 		   </tr>';
	$truk += $r->truk;
	$lori += $r->lori;
	$odong2 += $r->odong2;
	$traktor += $r->traktor;
	$luas_baku += $r->luas_ha;
	$ha += $r->tertebang;
	$netto += $r->netto;
	//$tha += $r->netto/$r->tertebang;
	//$tha += $r->netto/$r->tertebang;
	//------- DATA PETAK PEN --------//
	if($r->others == 'PEN'){
    	$ha_pen += $r->tertebang;
    	$netto_pen += $r->netto;
    	$luas_baku_pen += $r->luas_ha;
    	$protas_pen = number_format((($netto_pen)/1000)/$ha_pen,2);
    }
 	if(($ha-$ha_pen) > 0){
    	$protas_non_pen = number_format((($netto-$netto_pen)/1000)/($ha-$ha_pen),2);
    }
	$protas_total = number_format((($netto)/1000)/$ha,2);
 }
?>
</tbody>
<tfoot>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
	<td colspan="7"> RATA2 PETAK PEN </td>
	<td align="right"><?php echo $luas_baku_pen;?></td>
	<td align="right"><?php echo $ha_pen;?></td>
	<td align="right"><?php echo number_format($netto_pen/1000,2);?></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format($protas_pen,2);?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
	<td colspan="7"> RATA2 PETAK NON PEN </td>
	<td align="right"><?php echo $luas_baku-$luas_baku_pen;?></td>
	<td align="right"><?php echo $ha-$ha_pen;?></td>
	<td align="right"><?php echo number_format(($netto-$netto_pen)/1000,2);?></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format($protas_non_pen,2);?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
	<td colspan="7"> JUMLAH </td>
	<td align="right"><?php echo $luas_baku;?></td>
	<td align="right"><?php echo $ha;?></td>
	<td align="right"><?php echo number_format($netto,0);?></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format($protas_total,2);?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</tfoot>
</table>
<hr />
<table style="width:100%">
<tr><td style="width: 60%"><br>
			<br />
			<br />
			<br />
			</td><td style="width: 20%" >&nbsp;</td>
			<td align="center"> <?=CNF_PG.' ,'.SiteHelpers::datereport(date('Y-m-d'));?>
			<br /><br /><br />
			<br /><br />
			<br />
			<br />
			..........................
			<br />

			</td></tr>
		</table>
