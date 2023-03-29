<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mafdeling') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mafdeling/save/'.$row['id_affdeling']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id Affdeling" class=" control-label col-md-4 text-left"> Id Affdeling </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_affdeling'];?>' name='id_affdeling'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Plant Kode" class=" control-label col-md-4 text-left"> Plant Kode <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['plant_kode'];?>' name='plant_kode' readonly required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Afdeling (sama dengan SAP)" class=" control-label col-md-4 text-left"> Kode Afdeling (sama dengan SAP) <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_affd'];?>' name='kode_affd'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="Nama Afdeling" class=" control-label col-md-4 text-left"> Nama Afdeling <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_afdeling'];?>' name='nama_afdeling'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Karyawan" class=" control-label col-md-4 text-left"> Karyawan <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='Persno' rows='5' id='Persno' code='{$Persno}' 
							class='form-control input-sm select2 ' style='width: 100%;' required  ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mafdeling');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#Persno").jCombo("<?php echo site_url('mafdeling/comboselect?filter=vw_master_karyawan:Persno:name:id_jabatan:1') ?>",
		{  selected_value : '<?php echo $row["Persno"] ?>' });
		 	 
});
</script>		 