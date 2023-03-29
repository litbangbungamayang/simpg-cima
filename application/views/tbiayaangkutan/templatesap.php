<!--
test view untuk excel nya
 -->
<?php

?>

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
<tbody>
<?php
$no=0;
foreach ($rows as $jurnal) {
	$no++;
	if($jurnal->jenis_spta == 'TRUK'){
		//if($jurnal->jenis_spta == 'TRUK'){
		?>
		<tr>
 <td><?php echo $no;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>1</td>
 <td>IDR</td>
 <td><?php echo $jurnal->total;?></td>
 <td>&nbsp;</td>
 <td>
 <?php 
if($jurnal->katkode == 'TR') echo $jurnal->id_petani_sap;
 ?></td>
 <td>&nbsp;</td>
 <td><?php 
if($jurnal->katkode == 'TR') echo '0';
 ?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UAT'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Upah Angkutan Truk <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>ZT01</td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td>&nbsp;</td>
 </tr>
 <tr>
 <td><?php echo $no;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>2</td>
 <td>IDR</td>
 <td><?php echo $jurnal->total*-1;?></td>
 <td><?php 
if($jurnal->katkode == 'TR') echo '21030116'; else echo '21030116';
 ?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UAT'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Upah Angkutan Truk <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
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
	//}
	}else{

		//lori
		?>
		<tr>
 <td><?php echo $no;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>1</td>
 <td>IDR</td>
 <td><?php echo $jurnal->total;?></td>
 <td><?php 
if($jurnal->katkode == 'TS') echo '51100153';
 ?></td>
 <td><?php 
if($jurnal->katkode == 'TR') echo $jurnal->id_petani_sap;
 ?></td>
 <td>&nbsp;</td>
 <td><?php 
if($jurnal->katkode == 'TR') echo 'O';
 ?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UAL'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Upah Angkutan Lori <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>ZT01</td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td>&nbsp;</td>
 </tr>
 <tr>
 <td><?php echo $no;?></td>
 <td><?php echo CNF_COMPANYCODE;?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo ($jurnal->documentdate);?></td>
 <td><?php echo CNF_TAHUNGILING;?></td>
 <td><?php echo ($jurnal->postingmonth);?></td>
 <td>ZT</td>
 <td><?php echo $jurnal->kode_blok;?></td>
 <td>2</td>
 <td>IDR</td>
 <td><?php echo $jurnal->total*-1;;?></td>
 <td><?php 
if($jurnal->katkode == 'TR') echo '51100611'; else echo '51100153';
 ?></td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td><?php echo CNF_PLANCODE.'UAL'.$jurnal->katkode.''.$jurnal->katdate;?></td>
 <td>Upah Angkutan Lori <?php echo $jurnal->kepemilikan;?> Petak No <?php echo $jurnal->kode_blok;?></td>
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
 <td><?php echo str_replace('0','',CNF_COMPANYCODE).''.str_replace('P','',CNF_PLANCODE);?>0102</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td>&nbsp;</td>
 <td></td></tr>
		
		<?php
	}
	
}
?>
 

 
</tbody></table>