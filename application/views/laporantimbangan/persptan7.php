<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border: 1px solid #CCC;
		font-family: Arial, Helvetica, sans-serif;
		width:250%;
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

<td align="left"  style="font-size:11px" colspan="4">
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?>
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="4">
LAPORAN TIMBANGAN PER SPTA<br />
<?=$title;?>
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow">
    <th>NO</th>
    <th>NO SPTA</th>
    <th>AFD</th>
    <th>KODE PETAK</th>
	<th>PEN/NON PEN</th>
    <th>KEBUN</th>
    <th>SAMPEL TRASH</th>
    <th>KATEGORI</th>
    <th>MANDOR</th>
    <th>JENIS TEBANG</th>
    <th>PTA</th>
    <th>NO HV</th>
	<th>OP HV</th>
	<th>NO STIPPING</th>
	<th>OP STIPPING</th>
	<th>NO GL</th>
	<th>OP GL</th>
    <th>No Truk</th>
    <th>Zona</th>
    <th>KODE PREMI/PENALTI</th>
    <th>TRUK</th>
    <th>LORI</th>
    <th>ODONG2</th>
	<th>TRAKTOR</th>
	<th>HEKTAR</th>
    <th>QTY TEBU</th>
    <th>JENIS TEBU</th>
    <th>KODE TIMBANGAN</th>
    <th>KATEGORI TEBANG</th>
	<th>TGL TIMBANGAN</th></tr>
</thead>
<tbody>
<?php
$truk 		= 0;
$lori 		= 0;
$odong2 	= 0;
$traktor 	= 0;

$ha = 0;
$netto = 0;
$tha = 0;
$kat = '';
$i=0;

$gtruk = 0;$glori = 0;$gha = 0;$gnetto = 0;$gtha = 0;$godong2 = 0;$gtraktor = 0;
 foreach($result as $r){


	 if($kat != $r->stt_ta_text && $i != 0){
		?>
		<tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="20"> JUMLAH <?php echo $kat;?> </td><td align="center"><?php echo $truk;?></td><td align="center"><?php echo $lori;?></td><td align="center"><?php echo $odong2;?></td><td align="center"><?php echo $traktor;?></td><td align="right"><?php echo number_format($ha,4);?></td><td align="right"><?php echo number_format($netto,0);?></td><td></td><td align="right"></td><td coslpan="3"></td><td></td></tr>
		<?php
		$truk = 0;$lori = 0;$ha = 0;$netto = 0;$tha = 0;$i=0; $odong2 = 0;$traktor = 0;
	 }

	 if($kat != $r->stt_ta_text){
		echo '<tr><td colspan="23" ><b>'.$r->stt_ta_text.'</b></td></tr>';
		$kat = $r->stt_ta_text;
	 }
	 $trash = '';
 	 if($r->cek_trash == 'Y'){
     	$trash = 'background:red; color:white;';
     }
	 echo '<tr><td> '.($i+1).' </td>
	 <td> '.$r->no_spat.' </td>
	 <td> '.$r->divisi.' </td>
	 <td> '.$r->kode_blok.' </td>
     <td align="center" style='.$trash.'> '.$r->others.' </td>
	 <td> '.$r->deskripsi_blok.' </td>
	 <td align="center" style='.$trash.'> '.$r->cek_trash.' </td>
	 <td> '.$r->kode_kat_lahan.'</td>
	 <td> '.$r->persno_mandor_tma.' / '.$r->mandor.'</td>
	 <td> '.$r->metode_tma.'</td>
	 <td>'.$r->persno_pta.' / '.$r->pta.'</td>
	 <td>  '.$r->no_hv.' </td>
        <td>  '.$r->op_hv.' </td>
        <td>  '.$r->no_stipping.' </td>
        <td>  '.$r->op_stipping.' </td>
        <td>  '.$r->no_gl.' </td>
        <td>  '.$r->op_gl.' </td>
	 <td> '.$r->no_angkutan.'</td>
	 <td> '.$r->kode_jarak.'</td>
	 <td> '.$r->no_trainstat.'</td>
	 <td align="center"> '.$r->truk.' </td>
	 <td align="center"> '.$r->lori.' </td>
	 <td align="center"> '.$r->odong2.' </td>
	 <td align="center"> '.$r->traktor.' </td>
	 <td align="right"> '.$r->tertebang.' </td>
	<td align="right"> '.number_format($r->netto,0).' </td>
	<td align="right"> '.$r->terbakar_sel.' </td>
	<td align="center"> '.$r->lokasi_timbang_1." - ".$r->lokasi_timbang_2.' </td>
	<td align="center"> '.$r->stt_ta_text.' </td>
    <td align="right"> '.$r->timb_netto_tgl.' </td>
   </tr>';
	 $truk += $r->truk;
	$lori += $r->lori;
	$odong2 += $r->odong2;
	$traktor += $r->traktor;
	$ha += $r->tertebang;
	$netto += $r->netto;

	$gtruk += $r->truk;
	$glori += $r->lori;
	$godong2 += $r->odong2;
	$gtraktor += $r->traktor;
	$gha += $r->tertebang;
	$gnetto += $r->netto;
	$i++;
 }
?>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="20"> JUMLAH <?php echo $kat;?> </td><td align="center"><?php echo $truk;?></td><td align="center"><?php echo $lori;?></td><td align="center"><?php echo $odong2;?></td><td align="center"><?php echo $traktor;?></td><td align="right"><?php echo number_format($ha,4);?></td><td align="right"><?php echo number_format($netto,0);?></td><td></td><td align="right"></td><td></td><td></td></tr>
</tbody>
<tfoot><tr style="font-weight:bold;background:#104E8B;color:white">
    <td colspan="20"> GRAND TOTAL </td><td align="center"><?php echo $gtruk;?></td><td align="center"><?php echo $glori;?></td><td align="center"><?php echo $godong2;?></td><td align="center"><?php echo $gtraktor;?></td><td align="right"><?php echo number_format($gha,4);?></td><td align="right"><?php echo number_format($gnetto,0);?></td><td></td><td align="right"></td><td></td><td></td></tr></tfoot>
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
