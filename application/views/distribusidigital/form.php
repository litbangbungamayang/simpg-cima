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
		 <select id="mandor" class='form-control  select2' style="width: 100%" ></select>
		</div></div> 

		<div class="form-group  " >
		<label for="Kode Jarak" class=" control-label col-md-4 text-left"> Truk <span class="asterix">  </span></label>
		<div class="col-md-8">
		 <select id="truk" class='form-control select2' style="width: 100%" ></select> 
		</div></div> 

		<div class="toolbar-line text-center">		
			
			<a href="javascript:simpan()" class="btn btn-sm btn-primary">Simpan </a>
			<a href="javascript:cancel()" class="btn btn-sm btn-warning">Batal </a>
 		</div>

<script type="text/javascript">
	$(document).ready(function(){

		$("#mandor").jCombo("<?php echo site_url('distribusidigital/comboselect?filter=sap_m_karyawan:Persno:name:id_jabatan:3') ?>",
		{  selected_value : '' });

		$("#truk").jCombo("<?php echo site_url('distribusidigital/comboselect?filter=m_truk_gps:id:nopol_truk|namatruk:status:1') ?>",
		{  selected_value : '' });

		$('.select2').select2();
	});

	function cancel(){
		$('#sximo-modal').modal('hide');
	}

	function simpan(){
		var truk = $('#truk').val();
		var mandor = $('#mandor').val();

		if(truk != '' && mandor != ''){

			$.ajax({
		type: 'POST',
            url: "<?php echo site_url('distribusidigital/simpandata');?>",
			data:{id:$('#id_spta').val(),mandor:$('#mandor').val(),truk:truk},
			dataType:'html',
            success: function (data) {
                cancel();
                filterdata(5);
            },
             error: function (request, status, error) {
				
    		}
	});

		}else{
			alert("Data Tidak boleh kosong");
		}
	}
</script>