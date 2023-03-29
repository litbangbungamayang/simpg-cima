<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('taratruck') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>No Pol</td>
						<td><?php echo $row['no_pol'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'> Supir</td>
						<td><?php echo $row['nama_supir'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl</td>
						<td><?php echo $row['tgl_tara'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Zona</td>
						<td><?php echo SiteHelpers::gridDisplayView($row['zona'],'zona','1:m_biaya_jarak:kode_jarak:kode_jarak') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tara</td>
						<td><?php echo $row['tara'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Petugas</td>
						<td><?php echo $row['ptgs_timbang'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('taratruck');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  