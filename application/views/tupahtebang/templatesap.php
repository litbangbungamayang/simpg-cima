<!--
test view untuk excel nya
 -->
<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
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


<table class="tableizer-table">
<thead>
<tr class="tableizer-firstrow">
<th>Custom Field</th>
<th>BKPF-BUKRS
Type: C(04)</th>
<th>BKPF-BLDAT
Type: C(08)</th>
<th>BKPF-BUDAT
Type: C(08)</th>
<th>BKPF-GJAHR
Type: C(04)</th>
<th>BKPF-MONAT
Type: C(04)</th>
<th>BKPF-BLART
Type: C(02)</th>
<th>BKPF-BKTXT
Type: C(25)</th>
<th>BSEG-BUZEI
Type: C(03)</th>
<th>BKPF-WAERS
Type: C(03)</th>
<th>BSEG-WRBTR
Type: C(13)</th>
<th>BSEG-HKONT
Type: C(08)</th>
<th>BSEG-KUNNR
Type: C(08)</th>
<th>BSEG-LIFNR
Type: C(08)</th>
<th>BSEG-UMSKZ
Type: C(08)</th>
<th>BSEG-MWSKZ
Type: C(02)</th>
<th>BSEG-VALUT
Type: C(08)</th>
<th>BSEG-ZUONR
Type: C(18)</th>
<th>BSEG-SGTXT
Type: C(50)</th>
<th>BSEG-PRCTR
Type: C(10)</th>
<th>BSEG-KOSTL
Type: C(10)</th>
<th>BSEG-FISTL
Type: C(10)</th>
<th>BSEG-FIPOS
Type: C(08)</th>
<th>BSEG-PROJK
Type: C(99)</th>
<th>BSEG-ANLN1
Type: C(99)</th>
<th>BSEG-ZTERM
Type: C(04)</th>
<th>BSEG-ZFBDT
Type: C(08)</th>
<th>BSEG-ZLSCH
Type: C(08)</th>
</tr>
<tr class="tableizer-firstrow">
<th>Sequence No</th>
<th>Company Code</th>
<th>Document Date</th>
<th>Posting Date</th>
<th>Fiscal Year</th>
<th>Fiscal Period</th>
<th>Document Type</th>
<th>Document Header Text</th>
<th>Item No.</th>
<th>Currency</th>
<th> Amount in Document Currency </th>
<th>G/L Account</th>
<th>Customer</th>
<th>Vendor</th>
<th>Special G/L</th>
<th>Tax Code</th>
<th>Value Date</th>
<th>Assignment</th>
<th>Item Text</th>
<th>Profit Center</th>
<th>Cost Center</th>
<th>Fund Center</th>
<th>Commitment Item</th>
<th>WBS Element</th>
<th>Main Asset Number</th>
<th>Payment Terms</th>
<th>Baseline Date</th>
<th>Payment Method</th></tr></thead>
<?php
$s8 = 1;
foreach ($jurnals as $jurnal) {
	
$nominalupah = 0;
$nominalpremi = 0;
foreach($coldefadd as $kol1)
{
	$nm = $kol1->kodekolom;
	$nominalupah += $jurnal->$nm;
}

foreach($coldefrem as $kol1)
{
	//$nm = $kol1->kodekolom;
	//$nominalupah -= $jurnal->$nm;
}

foreach($colnondefadd as $kol1)
{
	$nm = $kol1->kodekolom;
	$nominalpremi += $jurnal->$nm;
}

foreach($colnondefrem as $kol1)
{
	//$nm = $kol1->kodekolom;
	//$nominalpremi -= $jurnal->$nm;
}

?>


<tbody>
 <tr>
 <td><?php echo $s8;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->postingdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>1</td>
 <td>IDR</td>
 <td><?php echo $nominalupah;?></td>
 <td><?php  if($jurnal->id_petani_sap=='') echo '51100722';?></td>
 <td><?php  echo $jurnal->id_petani_sap;?></td>
 <td>&nbsp;</td>
 <td><?php  if($jurnal->id_petani_sap!='') echo '8';?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UT'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Upah Tebang <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>ZT01</td>
 <td><?php echo ($jurnal->postingdate);?></td>
 <td>&nbsp;</td>
 </tr>
 <tr>
 <td><?php echo $s8;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->postingdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>2</td>
 <td>IDR</td>
 <td><?php echo $nominalupah*-1;?></td>
 <td>21030078</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UT'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Upah Tebang <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
 <?php
 if(CNF_COMPANYCODE == 'N011'){
 ?>
 <td><?php echo str_replace('0','',CNF_COMPANYCODE).''.CNF_PLANCODE?>000</td>
 <?php
}else{
?>
 <td><?php echo CNF_PLANCODE;?>100000</td>
 <?php	
}
 ?>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td></td></tr>

 <?php
 	if($nominalpremi != 0){
 		$s8++;
 		?>
 		<tr>
 <td><?php echo $s8;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->postingdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>1</td>
 <td>IDR</td>
 <td><?php echo $nominalpremi;?></td>
 <td><?php  if($jurnal->id_petani_sap=='') echo '51100723';?></td>
 <td><?php  echo $jurnal->id_petani_sap;?></td>
 <td>&nbsp;</td>
 <td><?php  if($jurnal->id_petani_sap!='') echo '9';?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UT'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Premi Tebang <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>ZT01</td>
 <td><?php echo ($jurnal->postingdate);?></td>
 <td>&nbsp;</td>
 </tr>
 <tr>
 <td><?php echo $s8;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->postingdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>2</td>
 <td>IDR</td>
 <td><?php echo $nominalpremi*-1;?></td>
 <td>21030078</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UT'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Premi Tebang <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
<?php
 if(CNF_COMPANYCODE == 'N011'){
 ?>
 <td><?php echo str_replace('0','',CNF_COMPANYCODE).''.CNF_PLANCODE?>000</td>
 <?php
}else{
?>
 <td><?php echo CNF_PLANCODE;?>100000</td>
 <?php	
}
 ?>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td></td></tr>
 		<?php
 	}
 ?>
</tbody>
<?php
$s8++;
}
?>
</table>