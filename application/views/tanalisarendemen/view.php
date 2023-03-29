<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tanalisarendemen') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Id Ari</td>
						<td><?php echo $row['id_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Id Spta</td>
						<td><?php echo $row['id_spta'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Brix Ari</td>
						<td><?php echo $row['brix_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Pol Ari</td>
						<td><?php echo $row['pol_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ph Ari</td>
						<td><?php echo $row['ph_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Suhu Ari</td>
						<td><?php echo $row['suhu_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl</td>
						<td><?php echo $row['tgl_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User</td>
						<td><?php echo $row['ptgs_ari'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tanalisarendemen');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  