<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tpinjamanpetani') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				<div class="table-responsive" id="printarea">
					<?php echo $this->session->flashdata('message');?>
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='10%' class='label-view text-right'>No Pinjaman</td>
						<td><?php echo $row['no_pinjaman'] ;?> </td>

						
					
						
					
						<td width='10%' class='label-view text-right'>Tgl Pencairan</td>
						<td><?php echo $row['tgl_pencairan'] ;?> </td>
						

						<td width='10%' class='label-view text-right'>Pokok Pinjaman</td>
						<td align="right"><?php echo number_format($row['pokok_pinjaman']) ;?> </td>
					
						
						
					</tr>
				
					<tr>
						
						
						<td width='15%' class='label-view text-right'>Penyalur</td>
						<td><?php echo $row['penyalur'] ;?> </td>

						<td width='15%' class='label-view text-right'>Nama Petani</td>
						<td><?php echo $row['id_petani_sap'] ;?> / <?php echo $row['nama_petani'] ;?> </td>
					
						<td width='15%' class='label-view text-right'>Bunga Per Tahun</td>
						<td align="right"><?php echo $row['bunga_per_tahun'] ;?> </td>
						
					
						
						
					</tr>
				
					<tr>
						
						<td width='15%' class='label-view text-right'>Keterangan</td>
						<td><?php echo $row['keterangan'] ;?> </td>
						<td width='15%' class='label-view text-right'>Last Update</td>
						<td><?php echo $row['last_update'] ;?> </td>
						<td width='15%' class='label-view text-right'>Saldo Pinjaman</td>
						<td align="right"><?php echo number_format($row['saldo_kredit']) ;?> </td>
						
					</tr>
				
					<tr>
						
						
					</tr>
				
				
						</tbody>	
					</table>   
					<div class="pull-right">
						<a href="javascript:SximoModal('<?=site_url('tpinjamanpetani/adddetail').'/'.$id;?>','Form Manual')" class="btn btn-primary"><i class="fa fa-plus"></i> Transaksi Manual</a>
					</div>
					<table class="table table-striped table-bordered" >
						<thead>
							<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Keterangan</th>
							<th>Debet</th>
							<th>Kredit</th>
							<th>Saldo</th>
						</tr>
						</thead>
						<tbody>
					<?
					$row = $this->db->query("SELECT * FROM t_pinjaman_petani_detail WHERE id_pinjaman=$id")->result();
					$no=0;
					foreach($row as $rx){
						$no++;
					?> 
						<tr>
							<td><?=$no;?></td>
							<td><?=SiteHelpers::datereport($rx->tgl);?></td>
							<td><?php
							switch ($rx->jenis_tx) {
								case 1:
									echo "Pencairan Pinjaman #".$rx->no_ref.' <br />'.$rx->keterangan;
								break;
								case 2:
									echo "Potongan DO <a href=\"javascript:SximoModal('".site_url('tpinjamanpetani/showdo').'/'.$rx->no_ref."','DO Petani')\" >#".$rx->no_ref.'</a> <br />'.$rx->keterangan;
								break;
								case 3:
									echo "Pembayaran Langsung <a href=\"javascript:SximoModal('".site_url('tpinjamanpetani/adddetail').'/'.$id.'/'.$rx->id."','Form Manual')\" >#".$rx->no_ref.'</a> <br />'.$rx->keterangan;
								break;
								
							}
							?></td>
							<td align="right"><?=number_format($rx->debet);?></td>
							<td align="right"><?=number_format($rx->kredit);?></td>
							<td align="right"><?=number_format($rx->saldo);?></td>
						</tr>
					<?
					}
					?>
					</tbody>
				</table>
				</div>
				<center>
				<a href="<?php echo site_url('tpinjamanpetani');?>" class="btn btn-sm btn-warning"> << Back </a>
				<a href="<?php echo site_url('tpinjamanpetani/cetak').'/'.$id;?>" target="_blank" class="btn btn-sm btn-danger"> <i class="fa fa-print"></i> Cetak </a>
			</center>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  