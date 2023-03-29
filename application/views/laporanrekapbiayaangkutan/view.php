<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border: 1px solid #CCC;
		font-family: Arial, Helvetica, sans-serif;
		width:100%;
	}
	.tableizer-table td {
		padding: 3px;
		margin: 1px;
		border : 1px solid black;
	}
	.tableizer-table th {
		background-color: #104E8B;
		color: #FFF;
		font-weight: bold;
		border: 1px solid #CCC;
		height:20px;padding:5px;
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
		<td style="font-size:15px;text-align:center;"><b>PER VENDOR<br /><?php echo CNF_PG;?> / <?php echo $kat;?></b></td>
	</tr>
	<tr>
		<td style="text-align:center;">PERIODE TANGGAL <?php echo SiteHelpers::daterpt($date1);?> S/D <?php echo SiteHelpers::daterpt($date2);?> </td>
	</tr>
</table>
<br />
<?php
$par = "";
$grandno=1;
$grandttl = 0;
$countvendor = 0;
foreach ($detail as $key => $val) {
$par = $detail[$key-1]->vendor_angkut;
if ($par != $val->vendor_angkut ) {
	
?>
<table class="tableizer-table">
	<thead>
		<tr>
			<td colspan="2" style="text-align: center; background:red;color:#FFF;"><?php echo $val->nama_vendor;?></td>
			<td colspan="8"></td>
		</tr>
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
		$tnetto = 0;
			$par1 = $detail[$key]->vendor_angkut;
			foreach ($detail as $a) {
				if ($a->vendor_angkut == $par1) {
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
			<td style="text-align: right;"><?php echo number_format($a->tarif,2);?></td>
			<td style="text-align: right;"><?php echo number_format($a->total);?></td>
			<?php
			$ttl += $a->total;
			$tnetto += $a->netto;
			}
			}
			?>
		</tbody>
		<tr>
			<th style="text-align: center" colspan="6">JUMLAH ( <?php echo $no-1;?> TRUK/LORI )</th>
			<th style="text-align: right; "><?php echo number_format($tnetto);?></th>
			<th style="text-align: right; " colspan="2"></th>
			<th style="text-align: right; "><?php echo number_format($ttl);?></th>
		</tr>
		<?php
			$countvendor++;
		 }
		$grandno++;
		$grandttl += $val->total;
		} ?>
		<tr>
			<th style="text-align: center" colspan="9">JUMLAH ( <?php echo $grandno-1;?> TRUK/LORI )</th>
			<th style="text-align: right; "><?php echo number_format($grandttl);?></th>
		</tr>
	</table>
	<i style="font-size: 10px">Dicetak Pada Tanggal <?php echo date('Y-m-d H:i:s');?></i>
	<hr />

	<?php if ($countvendor == 1) {?>
	<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
		<tbody>
			<tr>
				<td align="center"  style="font-size:13px">
					<br />
					<br />
					<br />
					Mengetahui
					<br />
					<b>MANAGER AKU</b>
					<br />
					<br />
					<br />
					<br />
					<?php echo $this->session->userdata('fid');?>
				</td>
				
				<td align="center"  style="font-size:13px">
					<?php echo CNF_PG.', '.SiteHelpers::datereport(date('Y-m-d'));?><br />
					<b><?php echo $row['nama_vendor'];?></b><br />
					Menyatakan dengan sebenarnya<br />bahwa hasil timbang dan jumlah truk<br />Telah Sesuai
					<br />
					<br />
					<br />
					<br />
					.........................
				</td>
			</tr>
		</table>
		<?php } ?>