<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('trubahselektor') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

        <?php
        	$arstatus = array("1"=>"Ya","0"=>"Tidak");
        	$arstatustx = array("1"=>"Buat","2"=>"Validasi");
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
						<td><b><?php echo $row['no_spta'] ;?> </td>
						<td width='20%' class='label-view text-right'>No Ba</td>
						<td><b><?php echo $row['no_ba'] ;?> </td>
						
					</tr>
				
					
				
					<tr>
						<td width='20%' class='label-view text-right'>Persno Mandor</td>
						<td><b><?php echo $row['persno_mandor'] ;?> - <?php echo SiteHelpers::gridDisplayView($row['persno_mandor'],'mandor','1:sap_m_karyawan:Persno:name') ;?> </td>
						<td width='20%' class='label-view text-right'>Edit Perno Mandor</td>
						<td><b><?php echo $row['r_perno_mandor'] ;?> - <?php echo SiteHelpers::gridDisplayView($row['r_perno_mandor'],'mandor','1:sap_m_karyawan:Persno:name') ;?> </td>
						
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Brix Sel</td>
						<td><b><?php echo $row['brix_sel'] ;?> </td>
						<td width='20%' class='label-view text-right'>Edit Brix Sel</td>
						<td><b><?php echo $row['r_brix_sel'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Potongan/Premi</td>
						<td><b><?php echo $row['trainstat_sel'] ;?> </td>
						<td width='20%' class='label-view text-right'>Edit Potongan/Premi</td>
						<td><b><?php echo $row['r_trainstat'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Ditolak Sel</td>
						<td><b><?php echo $arstatus[$row['ditolak_sel']] ;?> </td>
						<td width='20%' class='label-view text-right'>Edit Ditolak Sel</td>
						<td><b><?php echo $arstatus[$row['r_ditolak_sel']] ;?> </td>
						
					</tr>

					<tr>
						<td width='20%' class='label-view text-right'>Terbakar Sel</td>
						<td><b><?php echo $arstatus[$row['terbakar_sel']] ;?> </td>
						<td width='20%' class='label-view text-right'>Edit Terbakar Sel</td>
						<td><b><?php echo $arstatus[$row['r_terbakar_sel']] ;?> </td>
						
					</tr>
				
				
					<tr>
						<td width='20%' class='label-view text-right'>Status</td>
						<td><b><?php echo $arstatustx[$row['status']] ;?> </td>
						<td width='20%' class='label-view text-right'>Alasan</td>
						<td><b><?php echo $row['alasan'] ;?> </td>
						
					</tr>
				
					
				
					<tr>
						<td width='20%' class='label-view text-right'>User Create</td>
						<td><b><?php echo $row['user_create'] ;?> </td>
						<td width='20%' class='label-view text-right'>User Approve</td>
						<td><b><?php echo $row['user_approve'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='20%' class='label-view text-right'>Tgl Create</td>
						<td><b><?php echo $row['tgl_create'] ;?> </td>
						<td width='20%' class='label-view text-right'>Tgl Approve</td>
						<td><b><?php echo $row['tgl_approve'] ;?> </td>
						
					</tr>
				
					
				
						</tbody>	
					</table>    
				</div>
				<center>
				<a href="<?php echo site_url('trubahselektor');?>" class="btn btn-sm btn-warning"> << Back </a>
				<?php if($row['status'] == 1 && $this->session->userdata('gid') == 13){
					?>
					<a href="javascript:getsetujui()" class="btn btn-sm btn-danger"> Setujui Perubahan </a>
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
	
	function getsetujui(){
		if(confirm("Apakah anda menyetujui perubahan ini ? ")){
			window.location = "<?php echo site_url('trubahselektor/setujui').'/'.$row['id'];?>";
		}
	}
</script>