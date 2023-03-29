<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('mmejatebu') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Kode</td>
						<td><?php echo $row['kode'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Nama</td>
						<td><?php echo $row['nama'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Warna</td>
						<td><?php echo $row['warna'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Parent</td>
						<td><?php echo $row['parent'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CCTV Status</td>
						<td><?php echo $row['cctv_on'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>CCTV URL</td>
						<td><?php echo $row['cctv_url'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User</td>
						<td><?php echo $row['user_act'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Update</td>
						<td><?php echo $row['tgl_act'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('mmejatebu');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  