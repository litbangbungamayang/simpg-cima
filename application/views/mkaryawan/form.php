<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mkaryawan') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mkaryawan/save/'.$row['Persno']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id Karyawan" class=" control-label col-md-4 text-left"> Id Karyawan </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_karyawan'];?>' name='id_karyawan'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="ID SAP" class=" control-label col-md-4 text-left"> ID SAP <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['Persno'];?>' name='Persno'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  
								  
								  <div class="form-group  " >
									<label for="Nama" class=" control-label col-md-4 text-left"> Nama <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['name'];?>' name='name'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jabatan" class=" control-label col-md-4 text-left"> Jabatan <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <select name='id_jabatan' rows='5' id='id_jabatan' code='{$id_jabatan}' 
							class='form-control input-sm select2 ' style='width: 100%;' required  ></select> <br />
									  <i> <small></small></i>
									 </div>  
								  </div> 
			</div>
			
			<div class="col-md-6">
									
						<div class="form-group  " >
									<label for="Company Code" class=" control-label col-md-4 text-left"> Company Code <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['company_code'];?>' name='company_code' readonly  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Plant Kode" class=" control-label col-md-4 text-left"> Plant Kode <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['plant_kode'];?>' name='plant_kode'  readonly  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 		  
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mkaryawan');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#id_jabatan").jCombo("<?php echo site_url('mkaryawan/comboselect?filter=m_jabatan:id_jabatan:nama_jabatan') ?>",
		{  selected_value : '<?php echo $row["id_jabatan"] ?>' });
		 	 
});
</script>		 