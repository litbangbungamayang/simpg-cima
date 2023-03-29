<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tkuotakkw') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tkuotakkw/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  <div class="form-group  " >
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Spta" class=" control-label col-md-4 text-left"> Tgl Spta </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_spta'];?>' name='tgl_spta'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Id Affd" class=" control-label col-md-4 text-left"> Id Affd </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_affd'];?>' name='id_affd'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Id Spta Kuota" class=" control-label col-md-4 text-left"> Id Spta Kuota </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_spta_kuota'];?>' name='id_spta_kuota'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Plant" class=" control-label col-md-4 text-left"> Kode Plant </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_plant'];?>' name='kode_plant'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kuota Spta" class=" control-label col-md-4 text-left"> Kuota Spta </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kuota_spta'];?>' name='kuota_spta'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Input" class=" control-label col-md-4 text-left"> Tgl Input </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['tgl_input'];?>' name='tgl_input'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ptgs Input" class=" control-label col-md-4 text-left"> Ptgs Input </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ptgs_input'];?>' name='ptgs_input'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tkuotakkw');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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