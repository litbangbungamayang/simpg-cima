<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mtimbangan') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mtimbangan/save/'.$row['id_timbangan']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-4">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Timbangan    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_timbangan'];?>' name='id_timbangan'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Timbangan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_timbangan'];?>' name='kode_timbangan'  required /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Api Key    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['api_key'];?>' name='api_key'   /> 						
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Nama Timbangan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_timbangan'];?>' name='nama_timbangan'  required /> 						
								  </div> 
			</div>
			
			<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Jenis Timbangan  <span class="asterix"> * </span>  </label>									
									  
					<?php $jenis_timbangan = explode(',',$row['jenis_timbangan']);
					$jenis_timbangan_opt = array( 'JEMBATAN' => 'JEMBATAN' ,  'DCS' => 'DCS' , ); ?>
					<select name='jenis_timbangan' rows='5' required  class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($jenis_timbangan_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['jenis_timbangan'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mtimbangan');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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