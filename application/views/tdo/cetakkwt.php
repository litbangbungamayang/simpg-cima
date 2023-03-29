<style>

/* @font-face kit by Fonts2u (https://fonts2u.com) */ 
@font-face {font-family:"dot-matrix";src:url("<?=base_url('adminlte/font/1979_dot_matrix.eot');?>?") format("eot"),url("<?=base_url('adminlte/font/1979_dot_matrix.woff');?>") format("woff"),url("<?=base_url('adminlte/font/1979_dot_matrix.ttf');?>") format("truetype"),url("<?=base_url('adminlte/font/1979_dot_matrix.svg#1979-Dot-Matrix');?>") format("svg");font-weight:normal;font-style:normal;}



</style>

<page size="A4" style="font-size:10px;font-family: 'dot-matrix'">
<table style="width: 100%; margin-left: auto; margin-right: auto;" border="1" cellspacing="0" cellpadding="1">
<tbody>
<tr style="height: 26px;">
<td align="center">

<img src="<?php echo base_url(CNF_COMPANYCODE.'.png');?>" height="52px" style="margin:5px" />
</td>
<td style="font-size:11px;height: 26px;padding-right:10px" align="center">
	<b><?=strtoupper(CNF_NAMAPERUSAHAAN);?><br /><?=strtoupper(CNF_PG);?></b></td>
<td style="font-size:11px;height: 26px;" align="center"><b>BUKTI PEMBAYARAN PETANI <br /><?=CNF_TAHUNGILING;?><br />
<?php 
if($do->jenis_do == 1){
	//echo 'SISTEM PEMBELIAN TEBU';
}else{
	//echo 'SISTEM BAGI HASIL';
}
?></b></td>
<td style="font-size:11px;height: 26px;padding-right:10px" align="right"><b>No Document : <?=$do->no_do;?><br />Tgl Document : <?=date('j M Y', strtotime($do->tgl_act));?></b></td>
</tr>
<tr style="height: 99px;">
<td style="height: 99px;padding:10px" colspan="4">
<table style="width: 100%;">
<tbody>
<tr style="height: 13px;">
<td style="height: 13px;">NO PETAK</td>
<td style="height: 13px;"><?=$do->kode_blok;?></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">&nbsp;</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;">WILAYAH KKW</td>
<td style="height: 13px;"><?=$do->divisi;?></td>
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
<td style="height: 13px;"></td>
<td style="height: 13px;"></td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">&nbsp;</td>
<td style="height: 13px;">&nbsp;</td>
</tr>
<tr>
	<td colspan="5" style="text-align: center"><b><u><p>Giling Tgl <?=date('j M Y', strtotime($do->tgl_awal));?> s/d <?=date('j M Y', strtotime($do->tgl_akhir));?></p></u></b></td>
	</tr>
</tbody>
</table>
</td>
</tr>
<tr style="height: 23px;">
<td style="height: 23px;padding:3px;" colspan="4">
	<table width="100%">
		<tr><td>
<b>Jumlah Yang Harus Dibayarkan</b></td><td style="text-align: right;"><b>: Rp. <?=number_format($do->total_pendapatan_bersih);?></b></td>
</tr>
</table>

</td>
</tr>
<tr style="height: 13px;">
<td style="height: 13px;text-align: center;" colspan="4" ><br /><i><b><?=siteHelpers::terbilang(($do->total_pendapatan_bersih));?> Rupiah</b></i>
<br /></td>
</tr>
	

<tr style="height: 13px;">
<td style="height: 13px;" colspan="2" width="50%" align="center">
	<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
	
</td>
<td style="height: 13px;" colspan="2" align="center">
<p>&nbsp;<?=CNF_PG;?>, <?=siteHelpers::datereporthidejam($do->tgl_act);?><br /><?=CNF_NAMAPERUSAHAAN;?><br /><?=strtoupper(CNF_PG);?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
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
</page>
<div class="pagebreak"></div>