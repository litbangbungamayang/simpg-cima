<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mpotongando') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mpotongando/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Urutan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['urutan'];?>' name='urutan'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Nama Potongan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_potongan'];?>' name='nama_potongan'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Jenis Potongan  <span class="asterix"> * </span>  </label>									
									  
					<?php $jenis_potongan = explode(',',$row['jenis_potongan']);
					$jenis_potongan_opt = array( '0' => 'Manual' ,  '1' => 'Upah Angkut' ,  '2' => 'Upah Tebang' ,  '3' => 'Per Kg Tebu' ,  '4' => 'Per 50Kg Gula 90%' ,  '5' => 'Per 50Kg Gula 10%' ,  '6' => 'Potongan Pinjaman Petani' , ); ?>
					<select name='jenis_potongan' rows='5' required  class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($jenis_potongan_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['jenis_potongan'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Nominal    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nominal'];?>' name='nominal'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Posisi  <span class="asterix"> * </span>  </label>									
									  
					<?php $posisi = explode(',',$row['posisi']);
					$posisi_opt = array( '0' => 'Kanan' ,  '1' => 'Kiri' , ); ?>
					<select name='posisi' rows='5' required  class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($posisi_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['posisi'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Status    </label>									
									  
					<?php $status = explode(',',$row['status']);
					$status_opt = array( '1' => 'Aktif' ,  '2' => 'Non Aktif' , ); ?>
					<select name='status' rows='5'   class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mpotongando');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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