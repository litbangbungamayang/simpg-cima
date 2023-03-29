<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mmasterfield') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mmasterfield/save/'.$row['kode_blok']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-3">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Field    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_field'];?>' name='id_field'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Komoditas  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_komoditas'];?>' readonly name='kode_komoditas'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Company Code  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['company_code'];?>' readonly name='company_code'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Plant  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_plant'];?>' readonly name='kode_plant'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Afdeling  <span class="asterix"> * </span>  </label>									
									  <select name='divisi' rows='5' id='divisi' code='{$divisi}' 
							class='form-control input-sm select2 ' style='width: 100%;' required  ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tahun Tanam  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tahun_tanam'];?>' readonly name='tahun_tanam'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Periode  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['periode'];?>' name='periode'  required /> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Blok  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_blok'];?>' name='kode_blok'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kategori  <span class="asterix"> * </span>  </label>									
									  <select name='kepemilikan' rows='5' id='kepemilikan' code='{$kepemilikan}' 
							class='form-control input-sm select2 ' style='width: 100%;' required  ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Deskripsi Blok    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['deskripsi_blok'];?>' name='deskripsi_blok'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Project Definition    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['project_definition'];?>' name='project_definition'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Luas Tanam  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['luas_tanam'];?>' name='luas_tanam'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Luas Ha  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['luas_ha'];?>' name='luas_ha'  required /> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Petani    </label>									
									  <select name='id_petani_sap' rows='5' id='id_petani_sap' code='{$id_petani_sap}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Status Blok    </label>									
									  <select name='status_blok' rows='5' id='status_blok' code='{$status_blok}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Jenis Tanah    </label>									
									  <select name='jenis_tanah' rows='5' id='jenis_tanah' code='{$jenis_tanah}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kondisi Areal    </label>									
									  <select name='kondisi_areal' rows='5' id='kondisi_areal' code='{$kondisi_areal}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Varietas    </label>									
									  <select name='kode_varietas' rows='5' id='kode_varietas' code='{$kode_varietas}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Gis ID    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['gis_id'];?>' name='gis_id'   /> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Jarak Blok Ke Pabrik  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['jarak_blok_ke_pabrik'];?>' name='jarak_blok_ke_pabrik'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Jml Batang Juring    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['jml_batang_juring'];?>' name='jml_batang_juring'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Jml Juring Ha    </label>									
									  <textarea name='jml_juring_ha' rows='2' id='jml_juring_ha' class='form-control input-sm '  
				           ><?php echo $row['jml_juring_ha'] ;?></textarea> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Taksasi Pandang    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['taksasi_pandang'];?>' name='taksasi_pandang'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Berat Per M    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['berat_per_m'];?>' name='berat_per_m'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Rata Tgi Batang    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['rata_tgi_batang'];?>' name='rata_tgi_batang'   /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mmasterfield');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#divisi").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_m_affdeling:kode_affd:nama_afdeling') ?>",
		{  selected_value : '<?php echo $row["divisi"] ?>' });
		
		$("#kepemilikan").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_m_kat_lahan:nama_kat_lahan:nama_kat_lahan') ?>",
		{  selected_value : '<?php echo $row["kepemilikan"] ?>' });
		
		$("#id_petani_sap").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_petani:id_petani_sap:id_petani_sap|alamat_petani') ?>",
		{  selected_value : '<?php echo $row["id_petani_sap"] ?>' });
		
		$("#status_blok").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_m_status_blok:kode_status_blok:nama_status_blok') ?>",
		{  selected_value : '<?php echo $row["status_blok"] ?>' });
		
		$("#jenis_tanah").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_m_jenis_tanah:kode_jenis_tanah:nama_jenis_tanah') ?>",
		{  selected_value : '<?php echo $row["jenis_tanah"] ?>' });
		
		$("#kondisi_areal").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_m_kondisi_areal:kode_kondisi_areal:ket_kondisi_areal') ?>",
		{  selected_value : '<?php echo $row["kondisi_areal"] ?>' });
		
		$("#kode_varietas").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_m_varietas:kode_varietas:nama_varietas') ?>",
		{  selected_value : '<?php echo $row["kode_varietas"] ?>' });
		 	 
});
</script>		 