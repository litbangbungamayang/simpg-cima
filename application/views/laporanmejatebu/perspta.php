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
LAPORAN MEJA TEBU HARIAN<br />
<?=$title;?> 
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow">
<th>NO</th><th>MT</th><th>NO SPTA</th><th>AFD</th><th>Mandor</th><th>PTA</th><th>No Petak</th><th>Kebun</th><th>Kategori</th><th>Angkutan</th><th>No Angkutan</th><th>transloading</th><th>Netto</th><th>Brix</th><th>pH</th><th>Terbakar</th><th>Kualitas</th><th>Ha Tertebang</th><th>Tebang</th><th>Selektor</th><th>Meja Tebu</th></tr></thead>
<tbody>
<?php
$no=1;
$kodemt = '';
$akt = 0;
$nettofinal=0;
 foreach($result as $r){

 		if($kodemt != $r->kode_meja_tebu && $no != 1){
		?>
		<?php
		$akt = 0;
		//$nettofinal = 0;
	 }
	 
	 if($kodemt != $r->kode_meja_tebu){
		//echo '<tr><td colspan="19" ><b>'.$r->kode_meja_tebu.'</b></td></tr>';
		$kodemt = $r->kode_meja_tebu;
	 }
	 ?>
	 <tr>
	 <td><?php echo $no;?></td>
	 <td><?php echo $r->kode_meja_tebu;?></td>
	 <td><?php echo $r->no_spat;?></td>
	 <td><?php echo $r->kode_affd;?></td>
	 <td><?php echo $r->mandor;?></td>
	 <td><?php echo $r->pta;?></td>
	 <td><?php echo $r->kode_blok;?></td>
	 <td><?php echo $r->deskripsi_blok;?></td>
	 <td><?php echo $r->kode_kat_lahan;?></td>
	 <td><?php echo $r->jenis_spta;?></td>
	 <td><?php echo $r->no_angkutan;?></td>
	 <td><?php echo $r->no_transloading;?></td>
	 <td><?php echo number_format($r->netto,0);?></td>
	 <td><?php echo $r->brix_sel;?></td>
	 <td><?php echo $r->ph_sel;?></td>
	 <td><?php echo $r->terbakar_sel;?></td>
	 <td><?php echo $r->kondisi_tebu;?></td>
	 <td><?php echo $r->ha_tertebang;?></td>
	 <td><?php echo $r->tgl_tebang;?></td>
	 <td><?php echo $r->tgl_selektor;?></td>
	 <td><?php echo $r->tgl_meja_tebu;?></td>
	 <?php
	$no++;
	$akt++;
	$nettofinal+=$r->netto;
 }
?>
</tbody>

<tfoot><tr style="font-weight:bold;background:#104E8B;color:white">
<td colspan="11" align="center"> TOTAL SEMUA (<?php echo $no-1;?>) </td>
<td align="center"> <?php echo number_format($nettofinal,0); ?> </td>
<td style="font-weight:bold;background:#104E8B;color:white" colspan="8"></td>
</tr></tfoot>
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