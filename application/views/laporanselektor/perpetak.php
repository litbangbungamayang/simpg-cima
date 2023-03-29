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
LAPORAN SELEKTOR HARIAN PER PETAK<br />
<?=$title;?> 
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow">
<th>AFD</th>
<th>No Petak</th>
<th>Kebun</th>
<th>Kategori</th>
<th>Luas Ha</th>
<th>Ha Tervalidasi</th>
<th>Ha Tertebang</th>
<th>Truck</th>
<th>Lori</th>
<th>Odong2</th>
<th>Traktor</th>
<th>Jumlah</th>
</tr></thead>
<tbody>
<?php
$truk = 0;
$lori = 0;
$odong2 = 0;
$traktor = 0;
$jumlah = 0;

$total_luas_ha = 0;
$total_tertebang = 0;
$total_sisa = 0;
foreach($result as $r){
    echo '<tr>
    <td> '.$r->kode_affd.' </td>
    <td> '.$r->kode_blok.' </td>
    <td> '.$r->deskripsi_blok.' </td>
    <td> '.$r->kode_kat_lahan.'</td>
    <td align="center"> '.$r->luas_ha.'</td>
    <td align="center"> '.$r->luas_tebang.'</td>
    <td align="center"> '.$r->tertebang.'</td>
    <td align="center"> '.$r->truk.' </td>
    <td align="center"> '.$r->lori.' </td>
    <td align="center"> '.$r->odong2.' </td>
    <td align="center"> '.$r->traktor.' </td>
    <td align="center"> '.$r->jumlah.' </td>
    </tr>';
    
    $total_luas_ha = $total_luas_ha+$r->luas_ha;
    $total_tertebang = $total_tertebang+$r->tertebang;

    $truk = $truk+$r->truk;
    $lori = $lori+$r->lori;
    $odong2 = $odong2+$r->odong2;
    $traktor = $traktor+$r->traktor;
    $jumlah = $jumlah+$r->jumlah;

}



?>
</tbody>
<tfoot><tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="6"> JUMLAH </td>
<td align="center"><?php echo $total_tertebang;?></td>
<td align="center"><?php echo $truk;?></td>
<td align="center"><?php echo $lori;?></td>
<td align="center"><?php echo $odong2;?></td>
<td align="center"><?php echo $traktor;?></td>
<td align="center"><?php echo $jumlah;?></td>
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