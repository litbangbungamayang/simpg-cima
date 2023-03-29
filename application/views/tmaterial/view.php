<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tmaterial') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='30%' class='label-view text-right'>No Tiket</td>
						<td><?php echo $row['no_tiket'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Material</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['kode_material'],'kode_material','1:m_material:kode_material:nama_material') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Nama Material</td>
						<td><?php echo $row['nama_material'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Relasi</td>
						<td><?php echo $row['kode_relasi'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Nama Relasi</td>
						<td><?php echo $row['nama_relasi'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Kendaraan</td>
						<td><?php echo $row['no_kendaraan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Nama Supir</td>
						<td><?php echo $row['nama_supir'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Timbang 1</td>
						<td><?php echo $row['timbang_1'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Timbang 2</td>
						<td><?php echo $row['timbang_2'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Netto</td>
						<td><?php echo $row['netto'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Timbang 1</td>
						<td><?php echo $row['tgl_timbang_1'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Timbang 2</td>
						<td><?php echo $row['tgl_timbang_2'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jenis Transaksi</td>
						<td><?php echo $row['jenis_transaksi'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Transaksi</td>
						<td><?php echo $row['no_transaksi'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status Timbang 1</td>
						<td><?php echo $row['status_timbang_1'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status Timbang 2</td>
						<td><?php echo $row['status_timbang_2'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ptgs Timbang</td>
						<td><?php echo $row['ptgs_timbang'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tmaterial');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  