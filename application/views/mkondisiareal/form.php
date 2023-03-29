<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mkondisiareal') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mkondisiareal/save/'.$row['id_kondisi_areal']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-4">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id Kondisi Areal" class=" control-label col-md-4 text-left"> Id Kondisi Areal </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_kondisi_areal'];?>' name='id_kondisi_areal'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Nama Komoditi" class=" control-label col-md-4 text-left"> Nama Komoditi <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <?php $nama_komoditi = explode(",",$row['nama_komoditi']); ?>
					 <label class='checked checkbox-inline'>   
					<input type='checkbox' name='nama_komoditi[]' value ='' requred  class='' 
					<?php if(in_array('',$nama_komoditi)) echo 'checked';?> 
					 />  </label>  <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="Kode Kondisi Areal" class=" control-label col-md-4 text-left"> Kode Kondisi Areal <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_kondisi_areal'];?>' name='kode_kondisi_areal'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="Ket Kondisi Areal" class=" control-label col-md-4 text-left"> Ket Kondisi Areal <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ket_kondisi_areal'];?>' name='ket_kondisi_areal'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mkondisiareal');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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