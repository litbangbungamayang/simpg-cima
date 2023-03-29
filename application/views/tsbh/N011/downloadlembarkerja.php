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

<td align="left"  style="font-size:11px" colspan="10" >
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="7" >
INTERNAL CHECK A.K.U<br />
<?=$title;?> 
</td>
</tr>
</table>
<table class="tableizer-table">
<thead>
			<tr>
			<th rowspan="2">NO AJUAN</th>
			<th  rowspan="2">PERIODE</th>
			<th rowspan="2">ID PETANI</th>
			<th rowspan="2">NAMA PETANI</th>
			<th rowspan="2">KODE KELOMPOK</th>
			<th rowspan="2">TEBU (Kg)</th>
			<th colspan="2">TMA TEBU TR OLEH PG (Kg)</th>
			<th colspan="3">GULA EX TR</th>
			<th rowspan="2">GULA PG</th>
			<th rowspan="2">GULA EX TR</th>
			<th rowspan="2">TETES PG</th>
			<th rowspan="2">TETES EX TR</th>

			  </tr>
			  <tr>
			
			<th>ANGKUT PG</th>
			<th>TEBANG PG</th>
			<th>GULA 90%</th>
			<th>GULA 10%</th>
			<th>GULA 100%</th>
			  </tr>
        </thead>
<tbody>
<?php

foreach ($result as $key) {
	$i = 0;
	echo '<tr>';
	echo '<td>'.$key->no_ajuan.'</td>';
	echo '<td>'.$key->periode.'</td>';
	echo '<td>'.$key->id_petani_sap.'</td>';
	echo '<td>'.$key->nama_petani.'</td>';
	echo '<td>'.$key->kode_kelompok.'</td>';
	echo '<td>'.$key->netto.'</td>';
	echo '<td>'.$key->tebang_pg.'</td>';
	echo '<td>'.$key->angkut_pg.'</td>';
	echo '<td>'.$key->sembilanpuluh_persen.'</td>';
	echo '<td>'.$key->sepuluh_persen.'</td>';
	echo '<td>'.$key->gula_ptr.'</td>';
	echo '<td>'.$key->gula_pg.'</td>';
	echo '<td>'.$key->gula_ptr.'</td>';
	echo '<td>'.$key->tetes_pg.'</td>';
	echo '<td>'.$key->tetes_ptr.'</td>';
	echo '</tr>';
	
}
?>
 
 
</tbody></table>