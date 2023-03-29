<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('taratruck') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('taratruck/save/'.$row['id_tara_truk']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id Tara Truk" class=" control-label col-md-4 text-left"> Id Tara Truk </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_tara_truk'];?>' name='id_tara_truk'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No Pol" class=" control-label col-md-4 text-left"> No Pol </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_pol'];?>' name='no_pol'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Supir" class=" control-label col-md-4 text-left"> Supir </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_supir'];?>' name='nama_supir'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl" class=" control-label col-md-4 text-left"> Tgl </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['tgl_tara'];?>' name='tgl_tara'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Zona" class=" control-label col-md-4 text-left"> Zona </label>
									<div class="col-md-8">
									  <select name='zona' rows='5' id='zona' code='{$zona}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tara" class=" control-label col-md-4 text-left"> Tara </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tara'];?>' name='tara'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Petugas" class=" control-label col-md-4 text-left"> Petugas </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ptgs_timbang'];?>' name='ptgs_timbang'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('taratruck');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#zona").jCombo("<?php echo site_url('taratruck/comboselect?filter=m_biaya_jarak:kode_jarak:kode_jarak') ?>",
		{  selected_value : '<?php echo $row["zona"] ?>' });
		 	 
});
</script>		 