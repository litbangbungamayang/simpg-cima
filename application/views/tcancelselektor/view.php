<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tcancelselektor') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>
<?php
$ar = array('1'=>'Diajukan','2'=>'Disetujui');
?>
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
						<center><h3><b><?php echo $ar[$row['status']];?> </b></h3></center>
					<tr>

						<td width='30%' class='label-view text-right'>No Spta</td>
						<td><?php echo $row['no_spta'] ;?> </td>
						<td width='30%' class='label-view text-right'>Alasan</td>
						<td><?php echo $row['alasan'] ;?> </td>
						
					</tr>
				
					<tr>
					<td colspan="4"><center>
					<div id="showhasil">

					</div>
					</center>
					</td>
				
					<tr>
						<td width='30%' class='label-view text-right'>User Pembuat</td>
						<td><?php echo $row['user_add'] ;?> </td>
						<td width='30%' class='label-view text-right'>Tgl Usulan</td>
						<td><?php echo $row['tgl_add'] ;?> </td>
						
					</tr>
				
				
					<tr>
						<td width='30%' class='label-view text-right'>User Approve</td>
						<td><?php echo $row['user_appr'] ;?> </td>
						<td width='30%' class='label-view text-right'>Tgl Approve</td>
						<td><?php echo $row['tgl_appr'] ;?> </td>
						
					</tr>
				
					<tr>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tcancelselektor');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
<script type="text/javascript">
$(document).ready(function() { 

		$.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('tcancelselektor/cekspta/2');?>",
                    data: {nospta:'<?php echo $row['no_spta'] ;?>'},
                    dataType: 'json',
                    success: function (dat) {
                        if(dat.stt == 1){
                        	$('#id_spta').val(dat.data.id);
                        	$('#showhasil').html(dat.hasil);
                        	$('#showhasil').show();

                        }else{

                        	$('#showhasil').hide();
                        	$('#showhasil').html('');
                            alert('data dengan No SPTA '+nospta+' tidak boleh diedit lagi');
                        }

                    }
                });
	});
</script>
	  