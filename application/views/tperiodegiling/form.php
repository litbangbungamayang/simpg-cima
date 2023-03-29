<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tperiodegiling') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tperiodegiling/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-4">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Nama Periode" class=" control-label col-md-4 text-left"> Nama Periode <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_periode'];?>' name='nama_periode'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Awal" class=" control-label col-md-4 text-left"> Tgl Awal <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl_awal'];?>' name='tgl_awal'
				style='width:150px !important;'	  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Akhir" class=" control-label col-md-4 text-left"> Tgl Akhir <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl_akhir'];?>' name='tgl_akhir'
				style='width:150px !important;'	  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="Harga Gula" class=" control-label col-md-4 text-left"> Harga Gula <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['harga_gula'];?>' name='harga_gula'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Harga Tetes" class=" control-label col-md-4 text-left"> Harga Tetes <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['harga_tetes'];?>' name='harga_tetes'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jenis DO" class=" control-label col-md-4 text-left"> Jenis DO </label>
									<div class="col-md-8">
									  
					<?php $jenis_do = explode(',',$row['jenis_do']);
					$jenis_do_opt = array( '0' => '90 % - 10 %' ,  '1' => '95 % - 5 %' ,  '2' => '100 %' , ); ?>
					<select name='jenis_do' rows='5'   class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($jenis_do_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['jenis_do'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="Fix Cost" class=" control-label col-md-4 text-left"> Fix Cost </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['fix_cost'];?>' name='fix_cost'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Variable Cost" class=" control-label col-md-4 text-left"> Variable Cost </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['variable_cost'];?>' name='variable_cost'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tperiodegiling');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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