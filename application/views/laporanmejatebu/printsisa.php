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
LAPORAN TEBU TERSEDIA <br />
<?php echo $title;?> 
</td>
</tr>
</table>
<hr />
dicetak pada <?php echo date('Y-m-d H:i:s');?>
<table class="tableizer-table">
<thead>

<tr><th colspan="14">TOTAL TERTIMBANG S/D <?php echo $titlex;?> </th>
<th style="text-align: right;"> <?php echo number_format($timbangsd->total,0); ?> </th>
<th colspan="3"></th></tr>
<tr><th colspan="14">TOTAL TERGILING S/D <?php echo $titlex;?> </th>
<th style="text-align: right;"> <?php echo number_format($gilingsd->total,0); ?> </th>
<th colspan="3"></th></tr>

<tr class="tableizer-firstrow">
<th>NO</th><th>NO SPTA</th><th>AFD</th><th>No Petak</th><th>Kebun</th><th>Petani</th><th>Kategori</th><th>Angkutan</th><th>No Angkutan</th><th>transloading</th><th>TEBANGAN</th><th>Terbakar</th><th>Bruto</th><th>Tara</th><th>Netto</th><th>Tgl Tebang</th><th>Tgl Selektor</th><th>Tgl Timbang</th></tr></thead>
<tbody>
<?php
$no=1;
$kodemt = '';
$akt = 0;
$nettofinal=0;
$tgltimbang = '';
 foreach($result as $r){
 		if($tgltimbang == '' || $tgltimbang != $r->tgl_timbang){
 			?>
 			<tr><td colspan="7">Tgl Timbang <?php echo SiteHelpers::datereport($r->tgl_timbang);?></td></tr>
 			<?
 			$tgltimbang = $r->tgl_timbang;
 		}
	 ?>
	 <tr>
	 <td><?php echo $no;?></td>
	 <td><?php echo $r->no_spat;?></td>
	 <td><?php echo $r->kode_affd;?></td>
	 <td><?php echo $r->kode_blok;?></td>
	 <td><?php echo $r->deskripsi_blok;?></td>
	 <td><?php echo $r->nama_petani;?></td>
	 <td><?php echo $r->kode_kat_lahan;?></td>
	 <td><?php echo $r->jenis_spta;?></td>
	 <td><?php echo $r->no_angkutan;?></td>
	 <td><?php echo $r->no_transloading;?></td>
	 <td><?php echo $r->stt_ta_text;?></td>
	 <td><?php echo $r->terbakar_sel;?></td>
	 <td style="text-align: right;"><?php echo number_format($r->bruto,0);?></td>
	 <td style="text-align: right;"><?php echo number_format($r->tara,0);?></td>
	 <td style="text-align: right;"><?php echo number_format($r->netto,0);?></td>
	 <td style="text-align: center;"><?php echo $r->tgl_tebang;?></td>
	 <td style="text-align: center;"><?php echo $r->selektor_tgl;?></td>
	 <td style="text-align: center;"><?php echo $r->timb_netto_tgl;?></td>
	 </tr>
	 <?php
	$no++;
	$akt++;
	$nettofinal+=$r->netto;
 }
?>
</tbody>

<tr style="font-weight:bold;background:#104E8B;color:white">
<td colspan="14" align="center"> TOTAL SEMUA (<?php echo $no-1;?>) </td>
<td align="center"> <?php echo number_format($nettofinal,0); ?> </td>
<td style="font-weight:bold;background:#104E8B;color:white" colspan="3"></td>
</tr>


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