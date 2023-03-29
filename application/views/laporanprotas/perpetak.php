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

<td align="left"  style="font-size:11px">
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" >
LAPORAN PROTAS PER PETAK<br />
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead>
<tr class="tableizer-firstrow">
	<th>NO</th>
	<th style="width: 200px">NAMA PETANI</th>
	<th style="width: 200px">KODE BLOK</th>
	<th>AFD</th>
	<th>DESKRIPSI</th>
	<th>AFF TEBANG</th>
	<th>VARIETAS</th>
	<th>KATEGORI</th>
	<th>STATUS</th>
	<th>LUAS</th>
	<th>TERTEBANG</th>
	<th>SISA</th>
	<th>JML TAPG</th>
	<th>JML TPGAS</th>
	<th>JML TSAPG</th>
	<th>JML TAS</th>
	<th>TAPG (Kg)</th>
	<th>TPGAS (Kg)</th>
	<th>TSAPG (Kg)</th>
	<th>TAS (Kg)</th>
	<th>ORDER SPTA</th>
	<th>AWAL CETAK SPTA</th>
	<th>AKHIR CETAK SPTA</th>
	<th>JANGKA WAKTU SPTA (Hari)</th>
	<th>SPTA TERTIMBANG SD Hi</th>
	<th>SPTA TERGILING SD Hi</th>
	<th>SPTA DLM PROSES SBH</th>
	<th>DITOLAK</th>
	<th>KEBERSIHAN A</th>
	<th>KEBERSIHAN B</th>
	<th>KEBERSIHAN C</th>
	<th>KEBERSIHAN D</th>
	<th>KEBERSIHAN E</th>
	<th>TERBAKAR</th>
	<th>NETTO(Kg)</th>
	<th>NETTO YG SUDAH SBH(Kg)</th>
	<th>GULA RELEASE(Kg)</th>
	<th>PROTAS(Kg)</th>
	<th>R</th>
	<th>UPAH TEBANG(Rp.)</th>
	<th>UPAH ANGKUT(Rp.)</th>
</tr>
</thead>
<tbody>
<?php
$i=1;
 foreach($result as $r){
?>
<tr class="tableizer-firstrow">
	<td><?php echo $i;?></td>
	<td><?php echo $r->nama_petani;?></td>
	<td><?php echo $r->kode_blok;?></td>
	<td><?php echo $r->divisi;?></td>
	<td><?php echo $r->deskripsi_blok;?></td>
	<td><?php echo $r->aff_tebang;?></td>
	<td><?php echo $r->kode_varietas;?></td>
	<td><?php echo $r->kepemilikan;?></td>
	<td><?php echo $r->status_blok;?></td>
	<td><?php echo $r->luas_ha;?></td>
	<td><?php echo $r->tertebang;?></td>
	<td><?php echo $r->sisa;?></td>
	<td><?php echo $r->tapg;?></td>
	<td><?php echo $r->tpgas;?></td>
	<td><?php echo $r->tsapg;?></td>
	<td><?php echo $r->tas;?></td>
	<td><?php echo number_format($r->tapg_kg,2);?></td>
	<td><?php echo number_format($r->tpgas_kg,2);?></td>
	<td><?php echo number_format($r->tsapg_kg,2);?></td>
	<td><?php echo number_format($r->tas_kg,2);?></td>
	<td><?php echo $r->order_spta;?></td>
	<td><?php echo $r->tgl_awal_cetak;?></td>
	<td><?php echo $r->tgl_akhir_cetak;?></td>
	<td><?php echo $r->jangka_waktu;?></td>
	<td><?php echo $r->spta_tertimbang_sd;?></td>
	<td><?php echo $r->spta_tergiling_sd;?></td>
	<td><?php echo $r->spta_on_proses;?></td>
	<td><?php echo $r->ditolak;?></td>
	<td><?php echo $r->mutu_a;?></td>
	<td><?php echo $r->mutu_b;?></td>
	<td><?php echo $r->mutu_c;?></td>
	<td><?php echo $r->mutu_d;?></td>
	<td><?php echo $r->mutu_e;?></td>
	<td><?php echo $r->terbakar_selektor;?></td>
	<td><?php echo number_format($r->netto,0);?></td>
	<td><?php echo number_format($r->netto_release,0);?></td>
	<td><?php echo number_format($r->gula_release,2);?></td>
	<td><?php echo number_format($r->protas,2);?></td>
	<td><?php echo $r->r_release;?></td>
	<td><?php echo number_format($r->upah_tebang,2);?></td>
	<td><?php echo number_format($r->upah_angkut,2);?></td>
</tr>
<?php
$i++;	 
 }
?>
</tbody>
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