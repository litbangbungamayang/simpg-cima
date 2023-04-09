<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tselektor_mobile') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Id Selektor</td>
						<td><?php echo $row['id_selektor'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Id Spta</td>
						<td><?php echo $row['id_spta'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Persno Mandor Tma</td>
						<td><?php echo $row['persno_mandor_tma'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Tebang</td>
						<td><?php echo $row['tgl_tebang'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Angkutan</td>
						<td><?php echo $row['no_angkutan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ptgs Angkutan</td>
						<td><?php echo $row['ptgs_angkutan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ha Tertebang</td>
						<td><?php echo $row['ha_tertebang'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Terbakar Sel</td>
						<td><?php echo $row['terbakar_sel'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ditolak Sel</td>
						<td><?php echo $row['ditolak_sel'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ditolak Alasan</td>
						<td><?php echo $row['ditolak_alasan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Brix Sel</td>
						<td><?php echo $row['brix_sel'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ph Sel</td>
						<td><?php echo $row['ph_sel'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Pintumasuk</td>
						<td><?php echo $row['tgl_pintumasuk'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ptgs Pintumasuk</td>
						<td><?php echo $row['ptgs_pintumasuk'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Urut Timbang</td>
						<td><?php echo $row['no_urut_timbang'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Trainstat</td>
						<td><?php echo $row['no_trainstat'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Hv</td>
						<td><?php echo $row['no_hv'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Op Hv</td>
						<td><?php echo $row['op_hv'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Stipping</td>
						<td><?php echo $row['no_stipping'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Op Stipping</td>
						<td><?php echo $row['op_stipping'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Gl</td>
						<td><?php echo $row['no_gl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Op Gl</td>
						<td><?php echo $row['op_gl'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ptgs Selektor</td>
						<td><?php echo $row['ptgs_selektor'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Selektor</td>
						<td><?php echo $row['tgl_selektor'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tanaman Status</td>
						<td><?php echo $row['tanaman_status'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tanaman User</td>
						<td><?php echo $row['tanaman_user'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tanaman Act</td>
						<td><?php echo $row['tanaman_act'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Urut</td>
						<td><?php echo $row['no_urut'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Urut</td>
						<td><?php echo $row['tgl_urut'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tselektor_mobile');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  