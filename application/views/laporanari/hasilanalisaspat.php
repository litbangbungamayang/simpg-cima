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
LAPORAN ANALISA ARI<br />
<?=$title;?> 
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead>
	<tr class="tableizer-firstrow">
		<th>NO URUT ANALISA</th>
		<th>TGL MEJA TEBU</th>
		<th>NO SPAT</th>
		<th>KODE BLOK</th>
		<th>NO KENDARAAN</th>
		<th>NETTO</th>
		<th>MUT TEBU</th>
		<th>% BRIX</th>
		<th>% POL</th>
	</tr>
</thead>
<tbody>
<?php
$no=0;
$kodemt = '';
$akt = 0;
$nettofinal = 0;
 foreach($result as $r){
 	$no++;

	 echo '<tr>
				<td> '.$r->no_urut_analisa_rendemen.' </td>
				<td> '.$r->meja_tebu_tgl.' </td>
				<td> '.$r->no_spat.' </td>
				<td> '.$r->kode_blok.' </td>
				<td align="center"> '.$r->no_angkutan.' </td>
				<td align="right"> '.number_format($r->netto,0).'</td>
				<td align="center"> '.$r->kondisi_tebu.' </td>
				<td align="right"> '.number_format($r->persen_brix_ari,2).' </td>
				<td align="right"> '.number_format($r->persen_pol_ari,2).' </td>
			</tr>';
	 $akt++;
	 $nettofinal+=$r->netto;
	 
 }
?>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="5"> JUMLAH <?php echo  $kodemt.' ('.$akt.' Analisa)';?> </td>
<td  align="right">  <?php echo number_format($nettofinal,0); ?> </td>
<td colspan="8">  </td></tr>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
</tbody>
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