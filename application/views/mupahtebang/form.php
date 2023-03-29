<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mupahtebang') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mupahtebang/save/'.$row['id_pekerjaan_tma']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Pekerjaan Tma    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_pekerjaan_tma'];?>' name='id_pekerjaan_tma'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Nama Pekerjaan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_pekerjaan_tma'];?>' name='nama_pekerjaan_tma'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tercetak SPTA  <span class="asterix"> * </span>  </label>									
									  
					<?php $tercetak_spat = explode(',',$row['tercetak_spat']);
					$tercetak_spat_opt = array( '0' => 'Tidak' ,  '1' => 'Ya' , ); ?>
					<select name='tercetak_spat' rows='5' required  class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($tercetak_spat_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['tercetak_spat'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Status Pekerjaan  <span class="asterix"> * </span>  </label>									
									  
					<?php $status_pekerjaan = explode(',',$row['status_pekerjaan']);
					$status_pekerjaan_opt = array( '0' => 'Tidak Default' ,  '1' => 'Default' , '2'=> 'Non Aktif', ); ?>
					<select name='status_pekerjaan' rows='5' required  class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($status_pekerjaan_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['status_pekerjaan'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 					
								  
			</div>
			
			<div class="col-md-6">
									<div class="form-group  " >
									<label for="ipt" class=" control-label "> Jenis  <span class="asterix"> * </span>  </label>									
									  
					<?php $jenis = explode(',',$row['jenis']);
					$jenis_opt = array( '1' => 'Upah' ,  '2' => 'Potongan' , ); ?>
					<select name='jenis' rows='5' required  class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($jenis_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['jenis'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 
								  
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Nominal Default  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nominal_default'];?>' name='nominal_default'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Satuan  <span class="asterix"> * </span>  </label>									
									  
					<?php $satuan = explode(',',$row['satuan']);
					$satuan_opt = array( '1' => 'Bobot/Kg' ,  '2' => 'Angkutan/truk/lori' , ); ?>
					<select name='satuan' rows='5' required  class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($satuan_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['satuan'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mupahtebang');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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