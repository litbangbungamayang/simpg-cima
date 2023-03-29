<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tmaterial') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tmaterial/save/'.$row['id_t_material']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  <div class="form-group  " >
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_t_material'];?>' name='id_t_material'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No Tiket" class=" control-label col-md-4 text-left"> No Tiket </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_tiket'];?>' name='no_tiket'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Material" class=" control-label col-md-4 text-left"> Kode Material </label>
									<div class="col-md-8">
									  <select name='kode_material' rows='5' id='kode_material' code='{$kode_material}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Nama Material" class=" control-label col-md-4 text-left"> Nama Material </label>
									<div class="col-md-8">
									  <select name='nama_material' rows='5' id='nama_material' code='{$nama_material}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kode Relasi" class=" control-label col-md-4 text-left"> Kode Relasi </label>
									<div class="col-md-8">
									  <select name='kode_relasi' rows='5' id='kode_relasi' code='{$kode_relasi}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Nama Relasi" class=" control-label col-md-4 text-left"> Nama Relasi </label>
									<div class="col-md-8">
									  <select name='nama_relasi' rows='5' id='nama_relasi' code='{$nama_relasi}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No Kendaraan" class=" control-label col-md-4 text-left"> No Kendaraan </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_kendaraan'];?>' name='no_kendaraan'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Nama Supir" class=" control-label col-md-4 text-left"> Nama Supir </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nama_supir'];?>' name='nama_supir'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Timbang 1" class=" control-label col-md-4 text-left"> Timbang 1 </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['timbang_1'];?>' name='timbang_1'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Timbang 2" class=" control-label col-md-4 text-left"> Timbang 2 </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['timbang_2'];?>' name='timbang_2'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Netto" class=" control-label col-md-4 text-left"> Netto </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['netto'];?>' name='netto'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Timbang 1" class=" control-label col-md-4 text-left"> Tgl Timbang 1 </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['tgl_timbang_1'];?>' name='tgl_timbang_1'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl Timbang 2" class=" control-label col-md-4 text-left"> Tgl Timbang 2 </label>
									<div class="col-md-8">
									  
				<input type='text' class='form-control input-sm datetime' placeholder='' value='<?php echo $row['tgl_timbang_2'];?>' name='tgl_timbang_2'
				style='width:150px !important;'	   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jenis Transaksi" class=" control-label col-md-4 text-left"> Jenis Transaksi </label>
									<div class="col-md-8">
									  
					<?php $jenis_transaksi = explode(',',$row['jenis_transaksi']);
					$jenis_transaksi_opt = array( 'Penerimaan' => 'Penerimaan' ,  'Pengiriman' => 'Pengiriman' , ); ?>
					<select name='jenis_transaksi' rows='5'   class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($jenis_transaksi_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['jenis_transaksi'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No Transaksi" class=" control-label col-md-4 text-left"> No Transaksi </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_transaksi'];?>' name='no_transaksi'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tmaterial');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#kode_material").jCombo("<?php echo site_url('tmaterial/comboselect?filter=m_material:kode_material:kode_material|nama_material') ?>",
		{  selected_value : '<?php echo $row["kode_material"] ?>' });
		
		$("#nama_material").jCombo("<?php echo site_url('tmaterial/comboselect?filter=m_material:nama_material:nama_material') ?>",
		{  selected_value : '<?php echo $row["nama_material"] ?>' });
		
		$("#kode_relasi").jCombo("<?php echo site_url('tmaterial/comboselect?filter=m_relasi:kode_relasi:kode_relasi|nama_relasi') ?>",
		{  selected_value : '<?php echo $row["kode_relasi"] ?>' });
		
		$("#nama_relasi").jCombo("<?php echo site_url('tmaterial/comboselect?filter=m_relasi:nama_relasi:nama_relasi') ?>",
		{  selected_value : '<?php echo $row["nama_relasi"] ?>' });
		 	 
});
</script>		 