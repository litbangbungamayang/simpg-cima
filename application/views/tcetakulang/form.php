

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">


		<?php echo $this->session->flashdata('message');?>
			
		 <form action="<?php echo site_url('tcetakulang/save/'); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  
									  <input type='hidden' class='form-control input-sm' placeholder='' value='<?php echo $id;?>' name='id'   /> 
									  <input type='hidden' class='form-control input-sm' placeholder='' value='<?php echo $tgl_spta;?>' name='tgl_spta'   /> 
								 					
								 					
								  					
								  <div class="form-group  " >
									<label for="Retur Alasan" class=" control-label col-md-4 text-left"> Retur Alasan * </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' name='retur_alasan' required   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  					
								  
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 
});
</script>		 