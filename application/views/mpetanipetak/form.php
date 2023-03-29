<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mpetanipetak') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mpetanipetak/save/'.$row['id_petani']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> ID Petani SIMPG    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_petani'];?>' name='id_petani' readonly   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> ID Petani SAP  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_petani_sap'];?>' name='id_petani_sap' readonly required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Nama Petani  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_petani'];?>' name='nama_petani'  readonly required /> 						
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No KTP  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_ktp'];?>' name='no_ktp'  required  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Alamat Petani  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['alamat_petani'];?>' name='alamat_petani' readonly  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kota Petani  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kota_petani'];?>' name='kota_petani'  required readonly /> 						
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Kelompok  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_kelompok'];?>' name='kode_kelompok'   required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Reconciliation Account  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['reconciliation_account'];?>' name='reconciliation_account' readonly required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Region  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['region'];?>' name='region'  required readonly /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mpetanipetak');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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