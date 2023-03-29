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

<td align="left"  style="font-size:11px" colspan="7" >
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="4" >
LAPORAN BAGI HASIL<br />
<?=$title;?> 
</td>
</tr>
</table>
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow"><th>Jam</th><th>No SPTA</th><th>No Petak</th><th>Petani</th><th>Netto Tebu</th><th>Jenis SPTA</th><th>No Kendaraan</th><th>Kategori</th><th>Kualitas</th><th>Kristal Total</th><th>R. Total</th><th>R. Petani</th><th>Kristal Petani</th><th>Kristal PG</th><th>Gula Petani</th><th>Gula PG</th><th>Tetes Petani</th><th>Tetes PG</th></tr></thead>
<tbody>
<?php
foreach ($rows as $key) {
	?>
	<tr><td><?php echo $key->ari_tgl;?></td><td><?php echo $key->no_spat;?></td><td><?php echo $key->kode_blok;?></td><td><?php echo $key->nama_petani;?></td><td><?php echo $key->netto_final;?></td><td><?php echo $key->jenis_spta;?></td><td><?php echo $key->no_angkutan;?></td><td><?php echo $key->kode_kat_lahan;?></td><td><?php echo $key->kondisi_tebu;?></td><td><?php echo $key->hablur_ari;?></td><td><?php echo $key->rendemen_ari;?></td><td><?php echo $key->rendemen_ptr;?></td><td><?php echo ROUND($key->gula_ptr/1.003,2);?></td><td><?php echo ROUND($key->gula_pg/1.003,2);?></td><td><?php echo $key->gula_ptr;?></td><td><?php echo $key->gula_pg;?></td><td><?php echo $key->tetes_ptr;?></td><td><?php echo $key->tetes_pg;?></td></tr>
	<?php
}
?>
 
 
</tbody></table>