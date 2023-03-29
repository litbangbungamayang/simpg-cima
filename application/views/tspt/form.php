<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tspt') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tspt/save/'.$row['no_petak']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> No Surat    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_surat'];?>' name='no_surat'  readonly  /> 						
								  </div> 					
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> No Petak    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_petak'];?>' name='no_petak' readonly  /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> Tgl Analisa  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm date' placeholder='' value='<?php echo date('Y-m-d');?>' name='h_tglanalisa'  required /> 						
								  </div> 					
								  <div class="form-group  col-md-4" >
									<label for="ipt" class=" control-label "> % Brix Analisa  </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='0' name='h_brix'  required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> % Pol Analisa  	 </label>						
									  <input type='text' class='form-control input-sm number' placeholder='' value='0' name='h_pol'  required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> FK   </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='0' name='h_fk'  required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> KP    </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='0' name='h_kp'  required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> K.DT   </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='0' name='h_kdt'  required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> T-Score   </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='0' name='h_tscore'  required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> Brix Kebun  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='<?php echo $row['h_brix_kebun'];?>' name='h_brix_kebun'  required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> Keterangan    </label>									
									  <textarea name='keterangan' rows='2' id='keterangan' class='form-control input-sm '  
				           ><?php echo $row['keterangan'] ;?></textarea> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tspt');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 $('.date').datepicker({format:'yyyy-mm-dd',}).on('changeDate',function(e){
    $(this).datepicker('hide');
  })
});
</script>		 