<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tevaluasitebang') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Id Field</td>
						<td><?php echo $row['id_field'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Komoditas</td>
						<td><?php echo $row['kode_komoditas'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Company Code</td>
						<td><?php echo $row['company_code'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Plant</td>
						<td><?php echo $row['kode_plant'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Divisi</td>
						<td><?php echo $row['divisi'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Blok</td>
						<td><?php echo $row['kode_blok'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Valid From</td>
						<td><?php echo $row['valid_from'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Valid To</td>
						<td><?php echo $row['valid_to'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tanggal Mulai</td>
						<td><?php echo $row['tanggal_mulai'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Sampai</td>
						<td><?php echo $row['sampai'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Project Definition</td>
						<td><?php echo $row['project_definition'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Land Clearing</td>
						<td><?php echo $row['land_clearing'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Immature</td>
						<td><?php echo $row['immature'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Mature</td>
						<td><?php echo $row['mature'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Others</td>
						<td><?php echo $row['others'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Deskripsi Blok</td>
						<td><?php echo $row['deskripsi_blok'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Luas Tanam</td>
						<td><?php echo $row['luas_tanam'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tahun Tanam</td>
						<td><?php echo $row['tahun_tanam'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Periode</td>
						<td><?php echo $row['periode'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status Blok</td>
						<td><?php echo $row['status_blok'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kepemilikan</td>
						<td><?php echo $row['kepemilikan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Id Petani Sap</td>
						<td><?php echo $row['id_petani_sap'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jenis Tanah</td>
						<td><?php echo $row['jenis_tanah'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Total Pokok</td>
						<td><?php echo $row['total_pokok'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Total Tebang</td>
						<td><?php echo $row['total_tebang'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Luas Ha</td>
						<td><?php echo $row['luas_ha'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Luas Tebang</td>
						<td><?php echo $row['luas_tebang'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kondisi Areal</td>
						<td><?php echo $row['kondisi_areal'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Varietas</td>
						<td><?php echo $row['kode_varietas'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Gis Id</td>
						<td><?php echo $row['gis_id'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Total Pokok Produktif</td>
						<td><?php echo $row['total_pokok_produktif'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jarak Blok Ke Pabrik</td>
						<td><?php echo $row['jarak_blok_ke_pabrik'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jml Batang Juring</td>
						<td><?php echo $row['jml_batang_juring'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jml Juring Ha</td>
						<td><?php echo $row['jml_juring_ha'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Taksasi Pandang</td>
						<td><?php echo $row['taksasi_pandang'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Berat Per M</td>
						<td><?php echo $row['berat_per_m'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Rata Tgi Batang</td>
						<td><?php echo $row['rata_tgi_batang'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tevaluasitebang');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  