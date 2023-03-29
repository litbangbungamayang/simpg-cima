<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('trubahari') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">


		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('trubahari/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Spta    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_spta'];?>' name='id_spta' id='id_spta'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Spta    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_spta'];?>' name='no_spta' onkeyup="getNoSPTA(event,this.value)"  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Persen Brix Ari    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['persen_brix_ari'];?>' name='persen_brix_ari' id='persen_brix_ari' readonly  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Persen Pol Ari    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['persen_pol_ari'];?>' name='persen_pol_ari' id='persen_pol_ari' readonly  /> 						
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Ba    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_ba'];?>' name='no_ba' readonly  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> R Persen Brix Ari    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['r_persen_brix_ari'];?>' name='r_persen_brix_ari' id='r_persen_brix_ari'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> R Persen Pol Ari    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['r_persen_pol_ari'];?>' name='r_persen_pol_ari' id='r_persen_pol_ari'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Alasan    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['alasan'];?>' name='alasan' required   /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('trubahari');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 $('form input').on('keypress', function(e) {
            return e.which !== 13;
        });
        $('#no_spta').focus();


        if($('#no_spta').val() !== ""){
           // setNoSPTA($('#no_spta').val());
        }
});

function getNoSPTA(e,nospta){
        nospta = nospta.toUpperCase();

        if(e.keyCode == 13 && nospta != ''){
            var x = nospta.split("-");
            if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('trubahari/cekspta');?>",
                    data: {nospta:nospta},
                    dataType: 'json',
                    success: function (dat) {
                        if(dat.stt == 1){
                        	$('#id_spta').val(dat.data.id);
                            $('#persen_brix_ari').val(dat.data.persen_brix_ari);
                            $('#persen_pol_ari').val(dat.data.persen_pol_ari);

                            $('#r_persen_brix_ari').val(dat.data.persen_brix_ari);
                            $('#r_persen_pol_ari').val(dat.data.persen_pol_ari);

                        }else{
                            alert('data dengan No SPTA '+nospta+' tidak boleh diedit lagi');
                        }

                    }
                });

            }else{
                alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
                $('#no_spta').val('');
            }
        }
    }
</script>		 