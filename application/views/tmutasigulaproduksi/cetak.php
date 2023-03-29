<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo  CNF_APPNAME ;?> </title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
<script src="<?php echo base_url();?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>/adminlte/plugins/barcode/barcode128.js"></script>

<table style="width:98%;font-size:10px;height: 5px;font-family:Monospace;border-collapse: collapse;" border="1"  >
				<tr>
					<td style="font-size:13px;text-align:center;"><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></td>
					<td rowspan="3" style="width: 30%;text-align: center">
					
							
							<svg class="barcode"
  jsbarcode-format="code128"
  jsbarcode-value="<?php echo $row['no_berita_acara'] ;?>"
  jsbarcode-textmargin="0"
  jsbarcode-height="70"
  jsbarcode-width="1"
  jsbarcode-fontSize="12">
</svg> 
					</td>
				</tr>
				<tr>
					<td style="font-size:15px;text-align:center;"><b><?php echo CNF_PG;?></b></td>
				</tr>
				<tr>
					<td style="text-align:center;"><span style="font-size: 13px">BERITA ACARA<br />PENYERAHAN GULA PRODUKSI<br />GILING TAHUN <?=CNF_TAHUNGILING;?></span></td>
				</tr>
				</table>
				<table class="tableizer-table" style="height: 5px;font-family:Monospace;width: 95%;margin: 15px">
					<tr>
						<td>Pada hari ini tanggal</td><td>:</td><td><?php echo SiteHelpers::formatdatetime($row['tanggal_jam_ba'] );?> </td><td> Telah diserahkan Gula</td>
					</tr>
					<tr>
						<td>Produksi tanggal</td><td>:</td><td><?php echo SiteHelpers::datereport($row['tanggal_produksi'] );?> </td><td> Ke GUDANG GULA </td>
					</tr>
					<tr>
						<td>Jumlah</td><td>:</td><td style="text-align: right;"><?php echo $row['zak_gula_diserahkan'];?> Zak</td><td>&nbsp;&nbsp;&nbsp;<?php echo $row['ton_gula_diserahkan'];?> Ton</td>
					</tr>
					<?
					if($row['kardus_gula'] != 0 && $row['kardus_gula'] != ''){
					?>
					<tr>
						<td></td><td></td><td style="text-align: right;"><?php echo $row['kardus_gula'];?> Kardus</td><td>&nbsp;<u>&nbsp;&nbsp;<?php echo $row['ton_gula_ritel'];?> Ton</u></td>
					</tr>

					<tr>
						<td></td><td></td><td style="text-align: right;"></td><td>&nbsp;&nbsp;&nbsp;<?php echo $row['total_ton'];?> Ton</td>
					</tr>
					
					<?
					}
					?>
					<tr>
						<td >Dengan rincian sebagai berikut </td><td>:</td>
					</tr>
					<tr>
						<td colspan="5">
							<br />
							<table style="width:100%;font-size:10px;height: 5px;font-family:Monospace;border-collapse: collapse;" border="1" >
                <thead>
					<tr>
					<th >Jenis Produksi</th>
					<th  style="text-align: center;"  width="100px">Tahun Produksi</th>
					<th width="100px">Total sd YL</th>
                    <th width="150px">Total Hi</th>
                    <th width="150px">Total sd Hi</th>
                </tr>
            </thead>
            <tbody id="detaildata">
            	<?
            	foreach ($detail as $key) {
            		if($key->total_sd_hi != 0){
            		?>
            		<tr>
            		<td><?=$key->nm_jenis;?> <?=$key->keterangan;?></td>
            		<td style="text-align: center"><?=$key->thn_prd;?></td>
            		<td style="text-align: right;"><?=$key->total_sd_yl;?> Ton&nbsp;&nbsp;</td>
            		<td style="text-align: right;"><?=$key->total_hi;?> Ton&nbsp;&nbsp;</td>
            		<td style="text-align: right;"><?=$key->total_sd_hi;?> Ton&nbsp;&nbsp;</td>
            	</tr>
            		<?
            		}
            	}
            	?>
            </tbody>
            
        </table>
        <br />
						</td>
					</tr>
					<tr>
						<td colspan="4">Demikian berita acara ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</td>
					</tr>
				</table>
<table  style="height: 5px;font-family:Monospace;" border="0" width="95%">
<tbody>

<tr>

<td align="center"  >
<br />
<b>Yang menerima</b><br />
	<br />
	<br />
	<br />
	<br />
	.............<br />
	Kepala Gudang
</td>

<td align="center"  style="width: 30%">
<br />
</td>

<td align="center"  >
<?php echo CNF_PG.', ';?><?php echo SiteHelpers::datereporthidejam($row['tanggal_jam_ba'] );?><br />
<b>Yang menyerahkan</b><br />
	<br />
	<br />
	<br />
	<br />
	...........................<br />
	Assisten Manajer Pengolahan
</td>

</tr>
<table/>
<br />
<table style="height: 5px;font-family:Monospace;" border="0" width="95%">
<tr>

<td align="center"  >
<br /><br />
	<br />
	<br />
	<br />
	<br />
	.............<br />
	Manajer QA
</td>

<td align="center" style="width: 30%" >
Menyetujui<br /><br />
	<br />
	<br />
	<br />
	<br />
	.............<br />
	Manajer AKU
</td>

<td align="center"  ><br />
<br /><br />
	<br />
	<br />
	<br />
	.............<br />
	Manajer Pengolahan
</td>

</tr>
</table>

<script type="text/javascript">
$(document).ready(function(){
	//window.print();
	JsBarcode(".barcode").init();
	
	setTimeout(function () { window.print();}, 2000);
	setTimeout(function () { window.close();}, 3000);
});


</script>
</html>