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
	}
	.tableizer-table th {
		background-color: #104E8B; 
		color: #FFF;
		font-weight: bold;
		border: 1px solid #CCC;
		height:20px;padding:2px;
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
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>
<tr>

<td align="left"  style="font-size:11px" colspan="6">
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="10" >
REKAPITULASI UPAH TEBANG <br />
<?=$title;?> 
</td>
</tr>
</table>
				<hr />
				<table class="tableizer-table">
				<thead><tr style="background-color: #104E8B;color: white;">
					<th>No</th>
					<th>NAMA MANDOR</th>
					<th>No Angkutan</th>
					<th>Tebu (kg)</th>
					<?php
						foreach($coldefadd as $kol1)
						{
							echo '<th>'.$kol1->nama_pekerjaan_tma.'</th>';
						}
					?>
					<th>Jumlah</th>
					<?php
						foreach($coldefrem as $kol1)
						{
							echo '<th>'.$kol1->nama_pekerjaan_tma.'</th>';
						}
					?>
					<th>Total</th>
					<th>Total YL</th>
					<th>Total S/d Hi</th>
					</tr>
				<thead>
				<tbody>
				<?php
				$no = 0;
				$temno = 0;
				$jnetto = 0;
				$jadd = 0;
				$jrem = 0;
				$jbersih = 0;
				$tjnetto = 0;
				$tjadd = 0;
				$tjrem = 0;
				$tjbersih = 0;
				$mandor="";$mandorx = '';
				$sttlyl = 0;
				$sttlsd = 0;$nox=1;
						$arradd = array(array());
						$arrrem = array(array());


						$tarradd = array(array());
						$tarrrem = array(array());
					foreach($detail as $d){

						if($mandor != $d->persno_mandor){


							if($temno != 0){
								?>
					
						<tr style="background-color: white;color: black;">
						<td colspan=""><?php echo $nox++;?></td><td><?php echo $mandor." ".$mandorx;?></td>
						<td style="text-align:center"><?php echo $no;?> ANGKUTAN</td>
					<td style="text-align:right"><?php echo number_format($jnetto,2);?></td>
					<?php
						foreach($coldefadd as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($arradd[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<td style="text-align:right">'.number_format($ttl,2).'</td>';
						}
					?>
					<td style="text-align:right"><?php echo number_format($jadd,2);?></td>
					<?php
						foreach($coldefrem as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($arrrem[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<td style="text-align:right">'.number_format($ttl,2).'</td>';
						}


					?>
					<td style="text-align:right"><?php echo number_format($jbersih,2);?></td>
					
							<td style="background-color: red;color: white;font-weight: bold"><?php echo number_format($ttlyl,2);?></td>
							<td style="background-color: red;color: white;font-weight: bold;text-align: right;"><?php echo number_format($jbersih+$ttlyl,2);?></td>
					</tr>
								<?php

						$sttlyl += $ttlyl;
						$sttlsd += ($jbersih+$ttlyl);
							}

							$mandor = $d->persno_mandor;
							$mandorx = $d->mandor_nama;
							$ttlyl = $d->ttlyl;
							$no=0;
							$arradd = array(array());
							$arrrem = array(array());
							$jadd=0;
							$jrem=0;
							$jbersih=0;
							$jnetto=0;


						}
						$temno++;
						$no++;
						$add = 0;
						$rem = 0;
						$bersih = 0;
						$jnetto += $d->netto;
						$tjnetto += $d->netto;
						?>
						<!--tr>
					<td><?php echo $no;?></td>
					<td><?php echo $d->kode_blok;?></td>
					<td><?php echo $d->no_spat;?></td>
					<td><?php echo $d->no_angkutan;?></td>
					<td style="text-align:right"><?php echo number_format($d->netto,2);?></td-->
					<?php
						foreach($coldefadd as $kol1)
						{
							$nm = $kol1->kodekolom;
							if($kol1->satuan == 1){
								$add += ($d->$nm*1);
								$arradd[$nm][] = $d->$nm*1;
								$tarradd[$nm][] = $d->$nm*1;
						//	echo '<td style="text-align:right">'.number_format($d->$nm*1,2).'</td>';
							}else{
								$add += ($d->$nm);
								$arradd[$nm][] = $d->$nm;
								$tarradd[$nm][] = $d->$nm;
							//echo '<td style="text-align:right">'.number_format($d->$nm,2).'</td>';
							}
							
						}
						$jadd += $add;
						$tjadd += $add;
					?>
					<!--td style="text-align:right"><?php echo number_format($add,2);?></td-->
					<?php
						foreach($coldefrem as $kol1)
						{
							$nm = $kol1->kodekolom;
							if($kol1->satuan == 1){
								$rem += ($d->$nm*1);
								$arrrem[$nm][] = $d->$nm*1;
								$tarrrem[$nm][] = $d->$nm*1;
							//echo '<td style="text-align:right">'.number_format($d->$nm*1,2).'</td>';
							}else{
								$rem += ($d->$nm);
								$arrrem[$nm][] = $d->$nm;
								$tarrrem[$nm][] = $d->$nm;
							//echo '<td style="text-align:right">'.number_format($d->$nm,2).'</td>';
							}
							//$rem += ($d->$nm*1);
							//$arrrem[$nm][] = $d->$nm*1;
						}
						
						
						$jbersih += ($add-$rem);
						$tjbersih += ($add-$rem);
					?>
					<!--td style="text-align:right"><?php echo number_format($add-$rem,2);?></td>
					</tr-->
						<?php

						
					}
				?>
					
				</tbody>
				<?
				if(isset($arradd['k1'])){

				?>
					<tr style="background-color: white;color: black;">
						<td colspan=""><?php echo $nox++;?></td><td><?php echo $mandor." ".$mandorx;?></td>
						<td style="text-align:center"><?php echo $no;?> ANGKUTAN</td>
					<td style="text-align:right"><?php echo number_format($jnetto,2);?></td>
					<?php
						foreach($coldefadd as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($arradd[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<td style="text-align:right">'.number_format($ttl,2).'</td>';
						}
					?>
					<td style="text-align:right"><?php echo number_format($jadd,2);?></td>
					<?php
						foreach($coldefrem as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($arrrem[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<td style="text-align:right">'.number_format($ttl,2).'</td>';
						}

						$sttlyl += $ttlyl;
						$sttlsd += ($jbersih+$ttlyl);
					?>
					<td style="text-align:right"><?php echo number_format($jbersih,2);?></td>
					<td style="background-color: red;color: white;font-weight: bold"><?php echo number_format($ttlyl,2);?></td>
							<td style="background-color: red;color: white;font-weight: bold;text-align: right;"><?php echo number_format($jbersih+$ttlyl,2);?></td>
					</tr>
					<tr style="background-color: black;color: white;">
						<th colspan="2"> GRAND TOTAL</th>
						<th style="text-align:center"><?php echo $temno;?> ANGKUTAN</th>
					<th style="text-align:right"><?php echo number_format($tjnetto,2);?></th>
					<?php
						foreach($coldefadd as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($tarradd[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<th style="text-align:right">'.number_format($ttl,2).'</th>';
						}
					?>
					<th style="text-align:right"><?php echo number_format($tjadd,2);?></th>
					<?php
						foreach($coldefrem as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($tarrrem[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<th style="text-align:right">'.number_format($ttl,2).'</th>';
						}



					?>
					<th style="text-align:right"><?php echo number_format($tjbersih,2);?></th>
					<td style="background-color: red;color: white;font-weight: bold"><?php echo number_format($allsisalalu,2);?></td>
							<td style="background-color: red;color: white;font-weight: bold;text-align: right;"><?php echo number_format($allsisasemua,2);?></td>
					</tr>
					<?php
					}
					?>
				</table>

				
				<hr />
				
				<p style="page-break-after: always;">&nbsp;</p>
			