
<script src="<?php echo base_url();?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<table style="margin-left:60%;width:30%;font-size:10px;height: 5px;font-family:Monospace;border-collapse: collapse;" border="1"  >
				<tr>
					<td style="font-size:13px;text-align:center;"><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></td>
					
				</tr>
				<tr>
					<td style="font-size:15px;text-align:center;"><b><?php echo CNF_PG;?></b></td>
				</tr>
				<tr>
					<td style="text-align:center;"><span style="font-size: 15px">SURAT PERINTAH TEBANG</span></td>
				</tr>
				</table>
              
 <table class="tableizer-table" style="height: 5px;font-family:Monospace;width: 90%;padding: 10px">
<thead><tr class="tableizer-firstrow">
<th style="width: 100px">Kepada</th><th style="width: 100px">&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr></thead><tbody>
 <tr><td>Sdr</td><td >: <?php echo $row['name'];?></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>Di</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>Tempat</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td colspan="8">SURAT PERINTAH TEBANG</td></tr>
 <tr><td colspan="8">&nbsp;</td></tr>
 <tr><td colspan="8">Dengan ini diperintahkan kepada saudara untuk melaksanakan Tebang Muat pada :</td></tr>
 <tr><td>&nbsp;</td><td >No Petak</td><td colspan="5" style="font-weight: bold"><i><?php echo $row['no_petak'];?></i></td></tr>
 <tr><td>&nbsp;</td><td>Kategori</td><td colspan="5" style="font-weight: bold"><i><?php echo $row['kepemilikan'];?></i></td></tr>
 <tr><td>&nbsp;</td><td>Deskripsi </td><td colspan="5" style="font-weight: bold"><i><?php echo $row['deskripsi_blok'];?></i></td></tr>
 <tr><td>&nbsp;</td><td>Varietas</td><td colspan="5" style="font-weight: bold"><i><?php echo $row['kode_varietas'];?></i></td></tr>
 <tr><td>&nbsp;</td><td>Luas</td><td colspan="5" style="font-weight: bold"><i><?php echo $row['luas_ha'];?> Ha</i></td></tr>
 <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>Hasil Analisa</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>% Brix Analisa</td><td style="font-weight: bold"><i><?php echo $row['h_brix'];?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>% Pol Analisa</td><td style="font-weight: bold"><i><?php echo $row['h_pol'];?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>FK</td><td style="font-weight: bold"><i><?php echo $row['h_fk'];?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>KP</td><td style="font-weight: bold"><i><?php echo $row['h_kp'];?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>K.DT</td><td style="font-weight: bold"><i><?php echo $row['h_kdt'];?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>T-Score</td><td style="font-weight: bold"><i><?php echo $row['h_tscore'];?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>Tgl Analisa</td><td style="font-weight: bold"><i><?php echo SiteHelpers::datereport($row['h_tglanalisa']);?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>Keterangan</td><td style="font-weight: bold"><i><?php echo ($row['keterangan']);?></i></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
 <tr><td colspan="8">Demikian untuk menjadi periksa dan dilaksanakan dengan sebaik-baiknya</td></tr>
 <tr><td>&nbsp;</td><td colspan="1">Keterangan Brix Kebun</td><td style="font-weight: bold"><i><?php echo $row['h_brix_kebun'];?></i></td></tr>
</tbody></table>	
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>

<tr>

<td align="center"  style="font-size:13px">
<br />
<b>Manajer Tanaman</b><br />
	<br />
	<br />
	<br />
	.........................
</td>

<td align="center"  style="font-size:13px">
<br />
</td>

<td align="center"  style="font-size:13px">
<?php echo CNF_PG.', '.SiteHelpers::datereport(date('Y-m-d'));?><br />
<b>Manajer QA</b><br />
	<br />
	<br />
	<br />
	.........................
</td>

</tr>
</table>

<script type="text/javascript">
$(document).ready(function(){
	//window.print();
	
	setTimeout(function () { window.print();}, 2000);
	setTimeout(function () { window.close();}, 3000);
});


</script>