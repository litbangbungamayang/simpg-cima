<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mstatusblok') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mstatusblok/save/'.$row['id_status_blok']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id Status Blok" class=" control-label col-md-4 text-left"> Id Status Blok </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_status_blok'];?>' name='id_status_blok'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Status Blok" class=" control-label col-md-4 text-left"> Kode Status Blok <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_status_blok'];?>' name='kode_status_blok'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="Nama Status Blok" class=" control-label col-md-4 text-left"> Nama Status Blok <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_status_blok'];?>' name='nama_status_blok'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mstatusblok');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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