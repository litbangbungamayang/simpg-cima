<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tupahtebang') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border" id="printed">
				
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
							<td style="text-align: right;"><?php echo number_format($a->tarif,2);?></td>
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
				</div>
			</div>
<a href="<?php echo site_url('tbiayaangkutan');?>" class="btn btn-sm btn-warning"> << Back </a>
				<a href="javascript:printContent('printed')" class="btn btn-sm btn-danger"> <i class="fa fa-print"></i> Cetak </a>
				<?php
				if($row['status'] == 0){
					?>
					<a href="<?php echo site_url('tbiayaangkutan/validasi/'.$id);?>" class="btn btn-sm btn-info"> <i class="fa fa-check	"></i> Validasi </a>
					<?php
				}
				?>
				

	</div>
</div>
</section>