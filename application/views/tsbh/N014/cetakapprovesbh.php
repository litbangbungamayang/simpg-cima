<style type="text/css">
	table.tableizer-table {
		border-collapse: collapse;
		font-size: 12px;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
		width: 100%;

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
APPROVE BAGI HASIL<br />
<?=$title;?> 
</td>
</tr>
</table>
<?php
$ktotal = 0;
$rtotal = 0;
$rpetani = 0;
$kpetani = 0;
$kpg = 0;
$gpetani = 0;
$gpg = 0;
$tpetani = 0;
$tpg = 0;
$tnetto = 0;
?>
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow"><th>No</th><th>No SPTA</th><th>No Petak</th><th>Petani</th><th>Netto Tebu</th><th>Jenis SPTA</th><th>No Kendaraan</th><th>Kategori</th><th>Kualitas</th><th>Kristal Total</th><th>R. Total</th><th>R. Petani</th><th>Kristal Petani</th><th>Kristal PG</th><th>Gula Petani</th><th>Gula PG</th><th>Tetes Petani</th><th>Tetes PG</th></tr></thead>
<tbody>
<?php
$i =1;
foreach ($rows as $key) {
	?>
	<tr><td><?php echo $i++;?></td><td><?php echo $key->no_spat;?></td><td><?php echo $key->kode_blok;?></td><td><?php echo $key->nama_petani;?></td><td><?php echo $key->netto_final;?></td><td><?php echo $key->jenis_spta;?></td><td><?php echo $key->no_angkutan;?></td><td><?php echo $key->kode_kat_lahan;?></td><td><?php echo $key->kondisi_tebu;?></td><td><?php echo $key->hablur_ari;?></td><td><?php echo $key->rendemen_ari;?></td><td><?php echo $key->rendemen_ptr;?></td><td><?php echo ROUND($key->gula_ptr/1.003,2);?></td><td><?php echo ROUND($key->gula_pg/1.003,2);?></td><td><?php echo $key->gula_ptr;?></td><td><?php echo $key->gula_pg;?></td><td><?php echo $key->tetes_ptr;?></td><td><?php echo $key->tetes_pg;?></td></tr>
	<?php
	$tnetto		+= $key->netto_final;
	$ktotal 	+= $key->hablur_ari;
	//$rtotal 	= 0;
	//$rpetani 	= 0;
	$kpetani 	+= ROUND($key->gula_ptr/1.003,2);
	$kpg 		+= ROUND($key->gula_pg/1.003,2);
	$gpetani 	+= $key->gula_ptr;
	$gpg 		+= $key->gula_pg;
	$tpetani 	+= $key->tetes_ptr;
	$tpg 		+= $key->tetes_pg;
}
?>
 
 <tfoot><tr class="tableizer-firstrow"><th colspan="4">Jumlah</th><th style="text-align: right;"><?php echo number_format($tnetto);?></th><th colspan="4">Jumlah</th><th style="text-align: right;"><?php echo number_format($ktotal,2);?></th><th></th><th></th><th style="text-align: right;"><?php echo number_format($kpetani,2);?></th><th style="text-align: right;"><?php echo number_format($kpg,2);?></th><th style="text-align: right;"><?php echo number_format($gpetani,2);?></th><th style="text-align: right;"><?php echo number_format($gpg,2);?></th><th style="text-align: right;"><?php echo number_format($tpetani,2);?></th><th style="text-align: right;"><?php echo number_format($tpg,2);?></th></tr></tfoot>
 
</tbody></table>
<hr />
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>
<tr>

<td align="center"  style="font-size:13px">
<b>Manajer Pengolahan</b><br />
	<br />
	<br />
	<br />
	<br />
	<br />
	.........................
</td>

<td align="center"  style="font-size:13px">
<b>Manajer Tanaman</b><br />
	<br />
	<br />
	<br />
	<br />
	<br />
	.........................
</td>

<td align="center"  style="font-size:13px">
<b>Manajer Keuangan</b><br />
	<br />
	<br />
	<br />
	<br />
	<br />
	.........................
</td>

</tr>
</table>
<script type="text/javascript">
	window.print();
	
</script>