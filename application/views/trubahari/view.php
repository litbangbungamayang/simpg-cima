<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('trubahari') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>
<?php
        	$arstatus = array("1"=>"Ya","0"=>"Tidak");
        	$arstatustx = array("1"=>"Buat","2"=>"Disetujui Man QC","3"=>"Disetujui Man Pengolahan");
        ?>

<?php echo $this->session->flashdata('message');?>
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='20%' class='label-view text-right'>No Spta</td>
						<td><?php echo $row['no_spta'] ;?> </td>
						<td width='20%' class='label-view text-right'>No Ba</td>
						<td><?php echo $row['no_ba'] ;?> </td>
					</tr>
				
				
				
					<tr>
						<td width='20%' class='label-view text-right'>Alasan</td>
						<td><?php echo $row['alasan'] ;?> </td>
						<td width='20%' class='label-view text-right'>Status</td>
						<td><?php echo $arstatustx[$row['status']] ;?> </td>
					</tr>
				
					
				
					<tr>
						<td width='20%' class='label-view text-right'>Persen Brix Ari</td>
						<td><?php echo $row['persen_brix_ari'] ;?> </td>
						<td width='20%' class='label-view text-right'>R Persen Brix Ari</td>
						<td><?php echo $row['r_persen_brix_ari'] ;?> </td>
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Persen Pol Ari</td>
						<td><?php echo $row['persen_pol_ari'] ;?> </td>
						<td width='20%' class='label-view text-right'>R Persen Pol Ari</td>
						<td><?php echo $row['r_persen_pol_ari'] ;?> </td>
					</tr>
				
					
				
					<tr>
						<td width='20%' class='label-view text-right'>User Create</td>
						<td><?php echo $row['user_create'] ;?> </td>
						<td width='20%' class='label-view text-right'>User Approve</td>
						<td><?php echo $row['user_approve'] ;?> </td>
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Tgl Create</td>
						<td><?php echo $row['tgl_create'] ;?> </td>
						<td width='20%' class='label-view text-right'>Tgl Approve</td>
						<td><?php echo $row['tgl_approve'] ;?> </td>
					</tr>
				
					
				
						</tbody>	
					</table>    
				</div>
				<center>
				<a href="<?php echo site_url('trubahari');?>" class="btn btn-sm btn-warning"> << Back </a>
				<?php if($row['status'] == 1 && $this->session->userdata('gid') == 13){
					?>
					<a href="javascript:getsetujui(1)" class="btn btn-sm btn-danger"> Approve Perubahan </a>
					<?php
				}
				?>

				<?php if($row['status'] == 2 && $this->session->userdata('gid') == 10){
					?>
					<a href="javascript:getsetujui(2)" class="btn btn-sm btn-warning"> Approve Perubahan </a>
					<?php
				}
				?>
				
				</center>
			</div>
		</div>		
	

	</div>
</div>
</section>

	  <script type="text/javascript">
	
	function getsetujui(a){
		if(confirm("Apakah anda menyetujui perubahan ini ? ")){
			if(a==1){
				window.location = "<?php echo site_url('trubahari/setujuiqc').'/'.$row['id'];?>";
			}else{
				window.location = "<?php echo site_url('trubahari/setujui').'/'.$row['id'];?>";
			}
		}
	}
</script>
	  