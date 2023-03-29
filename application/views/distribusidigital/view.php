		<div class="form-group  " >
		<label for="Kode Jarak" class=" control-label col-md-4 text-left"> No SPTA <span class="asterix">  </span></label>
		<div class="col-md-8">
			<input type='hidden' id="id_spta"  value='<?=$row->id;?>' readonly /> 
		 	<input type='text' class='form-control input-sm' placeholder='' value='<?=$row->no_spat;?>' readonly /> 
		</div></div> 

		<div class="form-group  " >
		<label for="Kode Jarak" class=" control-label col-md-4 text-left"> Petak <span class="asterix">  </span></label>
		<div class="col-md-8">
		 <input type='text' class='form-control input-sm' placeholder='' value='<?=$row->kode_blok;?>' readonly /> 
		
		 <input type='text' class='form-control input-sm' placeholder='' value='<?=$row->deskripsi_blok;?>' readonly  /> 
		</div></div> 

		<div class="form-group  " >
		<label for="Kode Jarak" class=" control-label col-md-4 text-left"> Mandor <span class="asterix">  </span></label>
		<div class="col-md-8">
		 <select id="mandor" class='form-control  input-sm' disabled ></select>
		</div></div> 

		<div class="form-group  " >
		<label for="Kode Jarak" class=" control-label col-md-4 text-left"> Truk <span class="asterix">  </span></label>
		<div class="col-md-8">
		 <select id="truk" class='form-control input-sm' disabled ></select> 
		</div></div> 


<script type="text/javascript">
	$(document).ready(function(){

		$("#mandor").jCombo("<?php echo site_url('distribusidigital/comboselect?filter=sap_m_karyawan:Persno:name:Persno:').$row->persno_mandor; ?>",
		{  selected_value : '<?=$row->persno_mandor;?>' });

		$("#truk").jCombo("<?php echo site_url('distribusidigital/comboselect?filter=m_truk_gps:id:nopol_truk|namatruk:id:').$row->id_truck; ?>",
		{  selected_value : '<?=$row->id_truck;?>' });

	});
</script>