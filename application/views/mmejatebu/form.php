<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mmejatebu') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mmejatebu/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Parent" class=" control-label col-md-4 text-left"> Parent </label>
									<div class="col-md-8">
									  <select name='parent' rows='5' id='parent' code='{$parent}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode" class=" control-label col-md-4 text-left"> Kode <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode'];?>' name='kode'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="User Act" class=" control-label col-md-4 text-left"> User Act </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['user_act'];?>' name='user_act'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="Tgl Act" class=" control-label col-md-4 text-left"> Tgl Act </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_act'];?>' name='tgl_act'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="Nama" class=" control-label col-md-4 text-left"> Nama <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama'];?>' name='nama'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Warna" class=" control-label col-md-4 text-left"> Warna </label>
									<div class="col-md-8">
									  
					<?php $warna = explode(',',$row['warna']);
					$warna_opt = array( 'red' => 'Merah' ,  'yellow' => 'Kuning' ,  'green' => 'Hijau' , ); ?>
					<select name='warna' rows='5'   class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($warna_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['warna'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Cctv On" class=" control-label col-md-4 text-left"> Cctv On </label>
									<div class="col-md-8">
									  
					<?php $cctv_on = explode(',',$row['cctv_on']);
					$cctv_on_opt = array( '0' => 'Non Aktif' ,  '1' => 'Aktif' , '2' => 'Aktif Gambar' , '3' => 'Aktif Gambar Inteval'); ?>
					<select name='cctv_on' rows='5'   class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($cctv_on_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['cctv_on'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Cctv Url" class=" control-label col-md-4 text-left"> Cctv Url </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['cctv_url'];?>' name='cctv_url'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mmejatebu');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#parent").jCombo("<?php echo site_url('mmejatebu/comboselect?filter=m_mejatebu:id:nama') ?>",
		{  selected_value : '<?php echo $row["parent"] ?>' });
		 	 
});
</script>		 