	<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border-collapse: collapse;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
		width:100%;
	} 
	.tableizer-table td {
		padding: 2px;
		margin: 1px;
		border : 1px solid black;
	}
	.tableizer-table th {
		background-color: #104E8B; 
		color: #FFF;
		font-weight: bold;
		border: 1px solid #CCC;
		height:20px;padding:3px;
		text-align: center;
	}
	
	@media print {
  table.tableizer-table {
    font-size: 12px;
		border: 1px solid #CCC; 
		font-family: monospace;
		width:100%;
  }
  
  .tableizer-table td th{
    font-size: 12px;
		font-family: monospace;

  }
  
  table td{
    	font-size: 12px;
		font-family: monospace; 
		
  }


  
  
}
</style>
				<table style="width:100%;font-size:10px" >
				<tr>
					<td style="font-size:13px;text-align:center;"><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></td>
					
				</tr>
				<tr>
					<td style="font-size:15px;text-align:center;"><b><?php echo CNF_PG;?></b></td>
				</tr>
				<tr>
					<td style="text-align:center;"><span style="font-size: 15px">DAFTAR BIAYA ANGKUTAN <?php echo $row['nama_vendor'];?></span></td>
				</tr>
				<tr>
					<td style="text-align:center;">PERIODE TANGGAL <?php echo SiteHelpers::daterpt($row['tgl_awal']);?> S/D <?php echo SiteHelpers::daterpt($row['tgl_akhir']);?> </td>
				</tr>
				</table>
				<br />
				<table class="tableizer-table">
				<thead>
				<tr>
					<th>No</th>
					<th>Tgl Timbang</th>
					<th>SPTA</th>
					<th>Kode Blok</th>
					<th>Kebun</th>
					<th>No. Kend</th>
					<th>Netto (kg)</th>
					<th>Jarak</th>
					<th>Tarif</th>
					<th>Jumlah</th>
				</tr>
				</thead>
				<tbody>
					<?php
					$no=1;
					$ttl = 0;
						foreach ($detail as $a) {
							?>
							<tr>
							<td style="text-align: center"><?php echo $no++;?></td>
							<td style="text-align: center"><?php echo $a->txt_tgl_timb;?></td>
							<td style="text-align: center"><?php echo $a->no_spat;?></td>
							<td style="text-align: center"><?php echo $a->kode_blok;?></td>
							<td><?php echo $a->deskripsi_blok;?></td>
							<td style="text-align: center"><?php echo $a->no_angkutan;?></td>
							<td style="text-align: right;"><?php echo number_format($a->netto);?></td>
							<td><?php echo $a->keterangan;?></td>
							<td style="text-align: right;"><?php echo number_format($a->tarif);?></td>
							<td style="text-align: right;"><?php echo number_format($a->total);?></td>
							<?php
							$ttl += $a->total;
						}
					?>
				</tbody>
				<tfoot>
				<tr>
					<th style="text-align: center" colspan="9">JUMLAH ( <?php echo $no-1;?> TRUK )</th>
					<th style="text-align: right; "><?php echo number_format($ttl);?></th>
				</tr>
				</tfoot>
				</table>
				
				<i style="font-size: 10px">Dicetak Pada Tanggal <?php echo date('Y-m-d H:i:s');?></i>
				<hr />
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>

<tr>

<td align="center"  style="font-size:13px">
<br />
<b>Operator Upah Angkutan</b><br />
	<br />
	<br />
	<br />
	<?php echo $this->session->userdata('fid');?>
</td>

<td align="center"  style="font-size:13px">
<br />
<b>Manajer Keuangan</b><br />
	<br />
	<br />
	<br />
	.........................
</td>

<td align="center"  style="font-size:13px">
<br />
<b>Manajer Tanaman</b><br />
	<br />
	<br />
	<br />
	.........................
</td>

<td align="center"  style="font-size:13px">
<?php echo CNF_PG.', '.SiteHelpers::datereport($row['tgl']);?><br />
<b><?php echo $row['nama_vendor'];?></b><br />
	<br />
	<br />
	<br />
	.........................
</td>

</tr>
</table>
<p style="page-break-after: always;">&nbsp;</p>