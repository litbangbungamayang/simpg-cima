<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tsbh') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Persen Brix Ari</td>
						<td><?php echo $row['persen_brix_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Persen Pol Ari</td>
						<td><?php echo $row['persen_pol_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ph Ari</td>
						<td><?php echo $row['ph_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hk</td>
						<td><?php echo $row['hk'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Nilai Nira</td>
						<td><?php echo $row['nilai_nira'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Faktor Rendemen</td>
						<td><?php echo $row['faktor_rendemen'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Rendemen Ari</td>
						<td><?php echo $row['rendemen_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hablur Ari</td>
						<td><?php echo $row['hablur_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Gula Total</td>
						<td><?php echo $row['gula_total'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tetes Total</td>
						<td><?php echo $row['tetes_total'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Rendemen Ptr</td>
						<td><?php echo $row['rendemen_ptr'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Gula Ptr</td>
						<td><?php echo $row['gula_ptr'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tetes Ptr</td>
						<td><?php echo $row['tetes_ptr'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Gula Pg</td>
						<td><?php echo $row['gula_pg'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tetes Pg</td>
						<td><?php echo $row['tetes_pg'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ditolak Ari</td>
						<td><?php echo $row['ditolak_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ditolak Alasan</td>
						<td><?php echo $row['ditolak_alasan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Ari</td>
						<td><?php echo $row['tgl_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ptgs Ari</td>
						<td><?php echo $row['ptgs_ari'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Sbh</td>
						<td><?php echo $row['tgl_sbh'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ptgs Sbh</td>
						<td><?php echo $row['ptgs_sbh'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tsbh');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  