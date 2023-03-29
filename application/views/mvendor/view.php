<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('mvendor') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Nama Vendor</td>
						<td><?php echo $row['nama_vendor'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kode Vendor</td>
						<td><?php echo $row['kode_vendor'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td><?php echo $row['status'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('mvendor');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  