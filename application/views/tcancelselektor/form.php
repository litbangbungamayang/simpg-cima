<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tcancelselektor') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tcancelselektor/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id' id="id"   /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Spta  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_spta'];?>' name='id_spta' id='id_spta'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No SPTA    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_spta'];?>' name='no_spta' id='no_spta' autocomplete="off" onkeyup="getNoSPTA(event,this.value)"  /> 						
								  </div> 					
								  

					<div id="showhasil">

					</div>
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Alasan    </label>									
									  <textarea name='alasan' rows='2' id='alasan' class='form-control input-sm '  
				           ><?php echo $row['alasan'] ;?></textarea> 						
								  </div> 
								  <div class="form-group status">
									<label for="ipt" class=" control-label "> Status    </label>									
									  <select id="status" name="status" class="form-control input-sm">
									  	<option value="1">Diajukan</option>
									  	<option value="2">Approve</option>
									  </select>						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tcancelselektor');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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


        if($('#id').val() != ''){
        	$('#no_spta').attr('readonly',true);
        	$.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('tcancelselektor/cekspta/2');?>",
                    data: {nospta:$('#no_spta').val()},
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

        }else{
        	$('.status').hide();
        }
});


function getNoSPTA(e,nospta){
        nospta = nospta.toUpperCase();

        if(e.keyCode == 13 && nospta != ''){
            var x = nospta.split("-");
            if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('tcancelselektor/cekspta/1');?>",
                    data: {nospta:nospta},
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

            }else{
                alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
                $('#no_spta').val('');
            }
        }
    }
</script>		 