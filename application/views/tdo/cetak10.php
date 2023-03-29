<style>

/* @font-face kit by Fonts2u (https://fonts2u.com) */ 
@font-face {font-family:"dot-matrix";src:url("<?=base_url('adminlte/font/1979_dot_matrix.eot');?>?") format("eot"),url("<?=base_url('adminlte/font/1979_dot_matrix.woff');?>") format("woff"),url("<?=base_url('adminlte/font/1979_dot_matrix.ttf');?>") format("truetype"),url("<?=base_url('adminlte/font/1979_dot_matrix.svg#1979-Dot-Matrix');?>") format("svg");font-weight:normal;font-style:normal;}

</style>
<body style="font-family: 'dot-matrix';font-size:10px">
	<page>
<table style="width: 100%; margin-left: auto; margin-right: auto;" border="1" cellspacing="0" cellpadding="1">
<tbody>
<tr style="height: 26px;">
<td align="center">

<img src="<?php echo base_url(CNF_COMPANYCODE.'.png');?>" height="52px" style="margin:5px" />
</td>
<td style="font-size:10px;height: 26px;padding-right:10px" align="center">
	<b><?=strtoupper(CNF_NAMAPERUSAHAAN);?><br /><?=strtoupper(CNF_PG);?></b></td>
<td style="font-size:10px;height: 26px;" align="center"><b>PERMINTAAN<br />PENGELUARAN GULA NATURA </b></td>
<td style="font-size:10px;height: 26px;padding-right:10px" align="right"><b>NO DO : <?=$do->no_do;?><br />TGL DO : <?=date('j M Y', strtotime($do->tgl_act));?></b></td>
</tr>
<tr >
<td style="padding:2px" colspan="4">
<table style="width: 100%;">
<tbody>
<tr style="height: 13px;">
<td style="height: 13px;">NO PETAK</td>
<td style="height: 13px;"><?=$do->kode_blok;?></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">KATEGORI</td>
<td style="height: 13px;"><?=$do->kepemilikan;?></td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;">LUAS TERGILING</td>
<td style="height: 13px;"><?=number_format($do->ha_tergiling,3);?> Ha</td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">NAMA PEMILIK</td>
<td style="height: 13px;"><?=$do->nama_petani;?></td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;">KEBUN</td>
<td style="height: 13px;"><?=$do->deskripsi_blok;?></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">BERAT TEBU</td>
<td style="height: 13px;"><?=number_format($do->netto_tebu);?> Kg</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;">WILAYAH KKW</td>
<td style="height: 13px;"><?=$do->divisi;?></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">TETES PTR</td>
<td style="height: 13px;"><?=number_format($do->berat_tetes,2);?> Kg</td>
</tr>
</tbody>
</table>
</td>
</tr>

<tr>
<td style="padding:2px" colspan="4">
<table style="width: 100%;" border="1px">
<tbody>
<tr>

<td align="center">TAHUN GILING <?=CNF_TAHUNGILING;?></td>
<td align="center"> GULA NATURA MILIK PTR</td>
<td align="center">PENGAMBILAN</td>

</tr>
<?
$seratus = $do->gula_100;
$sembilan = $do->gula_90;
$sepuluh = $do->gula_10;
?>
<tr>

<td align="center"><b>
<p>PERIODE <?=$do->nama_periode;?></p>
<p><?=date('j M Y', strtotime($do->tgl_awal));?> s/d <?=date('j M Y', strtotime($do->tgl_akhir));?></p></b></td>
<td align="center" style="padding:10px">
<table width="100%">
<tr>
<td>GULA NATURA </td>
<td> <b><?=$sepuluh;?></b> Kilogram</td>
</tr>
<tr>
<td colspan="2" align="center"><i>
</i><br /></td>
</tr>
<tr>
<td>KARUNG + INTERBAG </td>
<td> <b><?=round($sepuluh/50,0);?></b> Lembar</td>
</tr>
</table>
</td>
<td align="center"><b>GUDANG <?=strtoupper(CNF_PG);?><br /><u> PENGAMBILAN S/D TANGGAL<br />
<? echo date('j M Y', strtotime("+16 days")); ?>
</u></b></td>

</tr>

</tbody>
</table>
</td>
</tr>

<tr style="height: 13px;">
<td style="height: 13px;" colspan="2" align="center">
<p>&nbsp;<br />&nbsp;<br />PENERIMA</p>
<p>&nbsp;</p>
<p><?=$do->nama_petani;?></p>
</td>
<td style="height: 13px;" colspan="2" align="center">
<p>&nbsp;<?=CNF_PG;?>, <?=siteHelpers::datereporthidejam($do->tgl_act);?><br /><?=CNF_NAMAPERUSAHAAN;?><br /><?=strtoupper(CNF_PG);?></p>
<p>&nbsp;</p>
<p><?=strtoupper(CNF_GM);?><br />General Manager</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table style="width: 100%;border: 1px solid black">
	<tr>
		<td style="width: 100px" align="center"><div class="qrcodedata" id="qrcode<?=$do->no_bon_gudang;?>" data-qr="<?=$do->no_bon_gudang;?>"></div></td>
		<td style="font-size: 10px"> <i> QR Code ini di gunakan saat pengambilan gula di gudang <?=CNF_PG;?><br />
			bukti ini hanya bisa digunakan 1x pengambilan gula.<br />
			Ref Code : <?=$do->no_bon_gudang;?></i>
		</td>
	</tr>
</table>
</page>

<div class="pagebreak"></div>
