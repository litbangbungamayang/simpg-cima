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

<td align="left"  style="font-size:11px" colspan="6">
<b><?php echo CNF_NAMAPERUSAHAAN; ?></b><br />
	<?php echo CNF_PG; ?> 
	<?php echo CNF_ALAMAT; ?>
</td>
<td align="center" style="font-size:13px" colspan="5">
LAPORAN SELEKTOR HARIAN<br />
<?php echo $title; ?> 
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow">
<th>NO</th><th>NO Urut</th><th>NO SPTA</th><th>AFD</th><th>Mandor</th><th>PTA</th><th>No Petak</th><th>Kebun</th><th>Kategori</th><th>Angkutan</th><th>No Angkutan</th><th>Supir</th><th>Brix</th><th>pH</th><th>Terbakar</th><th>Ha Tertebang</th><th>Tebang</th><th>Selektor</th><th>Bruto</th><th>Netto</th><th>Ditolak</th><th>Alasan</th></tr></thead>
<tbody>
<?php
$no=1;
$angkut = '';
$akt = 0;
 foreach($result as $r){

 		if($angkut != $r->jenis_spta && $no != 1){
		?>
		<tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="21"> JUMLAH <?php echo  $angkut.' ('.$akt.')'; ?> </td></tr>
		<?php
		$akt = 0;
	 }
	 
	 if($angkut != $r->jenis_spta){
		echo '<tr><td colspan="21" ><b>'.$r->jenis_spta.'</b></td></tr>';
		$angkut = $r->jenis_spta;
	 }
	 ?>
	 <tr>
	 <td><?php echo $no; ?></td>
	 <td><?php echo $r->no_urut; ?></td>
	 <td><?php echo $r->no_spat; ?></td>
	 <td><?php echo $r->kode_affd; ?></td>
	 <td><?php echo $r->mandor; ?></td>
	 <td><?php echo $r->pta; ?></td>
	 <td><?php echo $r->kode_blok; ?></td>
	 <td><?php echo $r->deskripsi_blok; ?></td>
	 <td><?php echo $r->kode_kat_lahan; ?></td>
	 <td><?php echo $r->jenis_spta; ?></td>
	 <td><?php echo $r->no_angkutan; ?></td>
	 <td><?php echo $r->ptgs_angkutan; ?></td>
	 <td><?php echo $r->brix_sel; ?></td>
	 <td><?php echo $r->ph_sel; ?></td>
	 <td><?php echo $r->terbakar_sel; ?></td>
	 <td><?php echo $r->ha_tertebang; ?></td>
	 <td><?php echo $r->tgl_tebang; ?></td>
	 <td><?php echo $r->tgl_selektor; ?></td>
	 <td><?php echo $r->timb_bruto_tgl; ?></td>
	 <td><?php echo $r->timb_netto_tgl; ?></td>
	 <td><?php echo $r->ditolak_sel; ?></td>
	 <td><?php echo $r->ditolak_alasan; ?></td>
	 <?php
	$no++;
	$akt++;
 }
?>
</tbody>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="21" align="center"> JUMLAH <?php echo $angkut; ?> (<?php echo $akt; ?>) </td></tr>
<tfoot><tr style="font-weight:bold;background:#104E8B;color:white">
<td colspan="21" align="center"> TOTAL SEMUA (<?php echo $no-1; ?>) </td></tr></tfoot>
</table>
<hr />
<table style="width:100%">
<tr><td style="width: 60%"><br>
			<br />	
			<br />	
			<br />
			</td><td style="width: 20%" >&nbsp;</td>
			<td align="center"> <?php echo CNF_PG.' ,'.SiteHelpers::datereport(date('Y-m-d')); ?>
			<br /><br /><br />
			<br /><br />	
			<br />	
			<br />
			..........................
			<br />	
			</td></tr>
		</table>