
<link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/bootstrap.min.css">
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
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" >
LAPORAN LIST SPTA  DICETAK<br /><?php echo $title;?> 
</td>
</tr>
</table>
<hr />
dicetak pada <?php echo date('Y-m-d H:i:s');?>
<table class="tableizer-table">
<thead>


<tr class="tableizer-firstrow">
<th>NO</th><th>NO SPTA</th><th>AFD</th><th>Kategori</th><th>No Petak</th><th>Kebun</th><th>Petani</th><th>Angkutan</th><th>Tebangan</th><th>Vendor</th></tr></thead>
<tbody>
<?php
$no=1;
$akt = 0;
 foreach($result as $r){

	 ?>
	 <tr>
	 <td><?php echo $no;?></td>
	 <td><?php echo $r->no_spat;?></td>
	 <td><?php echo $r->divisi;?></td>
	 <td><?php echo $r->kode_kat_lahan;?></td>
	 <td><?php echo $r->kode_blok;?></td>
	 <td><?php echo $r->deskripsi_blok;?></td>
	 <td><?php echo $r->nama_petani;?></td>
	 <td><?php echo $r->jenis_spta;?></td>
	 <td><?php echo $r->stt_ta_text;?></td>
	 <td><?php echo $r->nama_vendor;?></td>
	 </tr>
	 <?php
	$no++;
	$akt++;
 }
?>
</tbody>

<tr style="font-weight:bold;background:#104E8B;color:white">
<td colspan="10" align="center"> TOTAL SEMUA (<?php echo $no-1;?>) </td>
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