 <section class="content" style="padding:0px">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">

		 <form action="<?php echo site_url('tkuotaspta/saveOrder'); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" id="frmOrder" enctype="multipart/form-data" > 

		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="id_spta_kuota" value="<?php echo $id_spta_kuota; ?>" />
		<input type="hidden" name="id_spta_kuota_kkw" value="<?php echo $id_spta_kuota_kkw; ?>" />
		<input type="hidden" name="afdeling" value="<?php echo $afdeling; ?>" />
		<input type="hidden" name="id_petani_sap" value="<?php echo $id_petani_sap; ?>" />
		<input type="hidden" name="kategori" value="<?php echo $kategori; ?>" />
<div class="col-md-12">
<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Tgl SPTA <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<input type='text' class='form-control input-sm' placeholder='' value='<?php echo $tgl_spta; ?>' name='tgl_spta' readonly  required /> <br />
	</div> 
	</div> 
	
<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Kode Petak <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<input type='text' class='form-control input-sm' placeholder='' value='<?php echo $kode_blok;?>' name='kode_blok' readonly  required /> <br />
	</div> 
	</div> 
	<?php if(CNF_COMPANYCODE == 'N011' || CNF_COMPANYCODE == 'N009'){ 
		$jnsKat = substr($kategori, 0,2);
		?>
<div class="form-group  " >

	<label for="Company Code" class=" control-label col-md-4 text-left"> 
	<?php if($kategori == 'TS-SP' || $jnsKat == 'TR'){ ?>
	Jenis Pembayaran <span class="asterix"> * </span>
	<?php } ?>
	</label>
<div class="col-md-4">
	<div class="checkbox">
                  <label>
					<input type="hidden" id="spt0" name="spt" value="0">
					<?php if($kategori == 'TS-SP' || $jnsKat == 'TR'){ ?>
                    <input type="checkbox" id="spt1" name="spt" value="1"   > SPT
					<?php } ?>
                  </label>
                </div> 
	</div>
	<div class="col-md-4">
	<div class="checkbox">
                  <label>
					<input type="hidden" id="natura0" name="natura" value="0">
					<?php if($kategori == 'TS-SP' || $jnsKat == 'TR'){
						$cekspg = $this->db->query("SELECT persen_10 FROM t_spg WHERE kode_blok = '$kode_blok' ")->row();
						$sttspg = '';
						if($cekspg){
							if($cekspg->persen_10 == 1) $sttspg = 'checked';
						}
						?>
                    <input type="checkbox" id="natura1" name="natura" value="1" onchange="onchangeNatura()" <?php echo $sttspg; ?> > Natura 10%
					<?php } ?>
                  </label>
                </div> 
	</div>
</div>
<?php } ?>
<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Jumlah Order <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<input type='number' class='form-control input-sm' placeholder='masukan order spta' value='' name='kouta_tot'  required  id='kouta_tot' /> <br />
	</div> 
	</div> 


	
<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Jenis Tebangan <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<select class="form-control" name="jenis_tebangan" >
			<option value="1">Manual</option>
			<option value="2">Semi Mekanisasi</option>
			<option value="3">Mekanisasi</option>
		</select>
		<br />
	</div> 
	</div> 

	<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> </label>
	<div class="col-md-4">
	<div class="checkbox">
                  <label>
					<input type="hidden" id="tebang_pg0" name="tebang_pg" value="0">
                    <input type="checkbox" id="tebang_pg1" name="tebang_pg" value="1" onchange="onchangeTpg()"> Tebang PG
                  </label>
                </div> 
	</div>
	<div class="col-md-4">
	<div class="checkbox">
                  <label>
					<input type="hidden" id="angkut_pg0" name="angkut_pg" value="0">
                    <input type="checkbox" id="angkut_pg1" name="angkut_pg" value="1" onchange="onchangeApg()"> Angkut PG
                  </label>
                </div> 
	</div>
	
</div>

<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Nama PTA <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<select id="persno_pta" name="persno_pta"  required class="form-control input-sm select2"></select> <br /><br />
	</div> 
	</div>

	<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> JENIS SPTA <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<select class="form-control" name="jenis_spta" id="jenis_spta" >
			<option value="">- PILIH JENIS ANGKUTAN -</option>
			<option value="TRUK">TRUK</option>
		</select>
		<br />
	</div> 
	</div> 
	
	<div class="form-group  vendor" >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Vendor Angkutan <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<select id="vendor_id" name="vendor_id" class="form-control input-sm"></select> <br /><br />
	</div> 
	</div>
	
	<div class="form-group  vendor" >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Biaya Jarak <span class="asterix"> * </span></label>
	<div class="col-md-8">
		<select id="jarak_id" name="jarak_id" class="form-control input-sm"></select> <br /><br />
	</div> 
	</div>

	<div class="form-group  "  >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Transfer Ke PG </label>
	<div class="col-md-8">
		<select id="transfer_ke" name="transfer_ke" required class="form-control input-sm select2"></select><br /><br />
	</div> 
	</div> 
	<div class="form-group  " >
	<label for="Company Code" class=" control-label col-md-4 text-left"> Transfer Dari PG </label>
	<div class="col-md-8">
		<select id="transfer_dari" name="transfer_dari" required class="form-control input-sm select2"></select> <br />
	</div> 
	</div>



<div style="clear:both"></div>	

				
 		<div class="toolbar-line text-center">		
			<hr />
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="javascript:closeModalOrder()" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>
		
<script>
var tempJarak = false;
var tempJarakPilih = false;

var tempVendor = false;
var tempVendorPilih = false;
$(document).ready(function(){ 
$( "#spt1" ).on( "click", function(){
//	$(this).prop('checked', true).attr("readonly")
});
	<?php
	if(CNF_COMPANYCODE == 'N011' || CNF_COMPANYCODE == 'N009'){
		if($kategori == 'TS-SP' || $jnsKat == 'TR'){
		?>
		onchangeSpt();
		onchangeNatura();
		<?
	}
	}
	?>
	
	$(".select2").select2({ width: '100%' });
	$('.vendor').hide();
	 
	$("#persno_pta").jCombo("<?php echo site_url('tkuotaspta/comboselect?filter=vw_master_karyawan:Persno:name:id_jabatan:2'); ?>",
		{  selected_value : '', initial_text:'- PILIH NAMA PTA -' });
		
	$("#transfer_dari").jCombo("<?php echo site_url('tkuotaspta/comboselect?filter=sap_plant:kode_plant:nama_plant'); ?>",
		{  selected_value : '' , initial_text:'- pilih jika tebu transfer Dari -' });

	$("#transfer_ke").jCombo("<?php echo site_url('tkuotaspta/comboselect?filter=sap_plant:kode_plant:nama_plant'); ?>",
		{  selected_value : '' , initial_text:'- pilih jika tebu transfer Ke -' });
		
	$("#vendor_id").jCombo("<?php echo site_url('tkuotaspta/comboselect?filter=m_vendor:id_vendor:nama_vendor'); ?>",
		{  selected_value : '' , initial_text:'- pilih jika diangkut Vendor -' });
		
	$("#jarak_id").jCombo("<?php echo site_url('tkuotaspta/comboselect?filter=m_biaya_jarak:id_jarak:keterangan'); ?>",
		{  selected_value : '' , initial_text:'- pilih jarak ke pabrik -' });
	
	var frm = $('#frmOrder');
    frm.submit(function (ev) {
		ev.preventDefault();
		
		if(tempJarak){
			if($('#jarak_id').val() != ''){ tempJarakPilih = true;}else{ tempJarakPilih=false; }
		}else{
			tempJarakPilih = true;
		}


		if(tempVendor){
			if($('#vendor_id').val() != ''){ tempVendorPilih = true;}else{ tempVendorPilih=false; }
		}else{
			tempVendorPilih = true;
		}
		
		var kuota = ($('#kouta_tot').val());
		//console.log(kuota);

		if(kuota != '' &&  kuota > 0 && kuota < 200 && $('#jenis_spta').val()!='' && $('#persno_pta').val()!='' && tempJarakPilih && tempVendorPilih){
			
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
            	if(data == ''){
                alert('Data Berhasil Disimpan !!');
            }else{
            	alert(data);
            }
				 $('#sximo-modal').modal('hide');
				reloadgrid();
				refreshKkw();
				
            }
        });
		}else{
			alert('Form Belum lengkap silahkan lengkapi lagi / maximal 200 spta per petak!!');
		}

        
    });
});

function closeModalOrder(){
	$('#sximo-modal').modal('hide');
}

function onchangeTpg(){
	if(document.getElementById("tebang_pg1").checked) {
		document.getElementById('tebang_pg0').disabled = true;
	}else{
		document.getElementById('tebang_pg0').disabled = false;
	}
}
<?php if(CNF_COMPANYCODE == 'N011'){ ?>
function onchangeSpt(){
	if(document.getElementById("spt1").checked) {
		document.getElementById('spt0').disabled = true;
	}else{
		document.getElementById('spt0').disabled = false;
	}
}

function onchangeNatura(){
	if(document.getElementById("natura1").checked) {
		document.getElementById('natura0').disabled = true;
	}else{
		document.getElementById('natura0').disabled = false;
	}
}
<?php } ?>

function onchangeApg(){
	if(document.getElementById("angkut_pg1").checked) {
		document.getElementById('angkut_pg0').disabled = true;
		$('.vendor').show();
		$('#jarak_id').prop('required',true);
		tempJarak = true;
		tempVendor = true;
		$('#jarak_id').val('<?php echo $idjrk; ?>');
	}else{
		document.getElementById('angkut_pg0').disabled = false;
		$('.vendor').hide();
		$('#vendor_id').val('');
		$('#jarak_id').val('');
		$('#jarak_id').prop('required',false);
		tempJarak = false;
		tempVendor = false;
	}
}


</script>
<style>
input[type="checkbox"][readonly] {
  pointer-events: none;
}
</style>