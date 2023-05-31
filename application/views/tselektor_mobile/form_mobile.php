<section class="content-header">
	<h1>
	<?php echo $pageTitle ;?>
	</h1>
	<ol class="breadcrumb">
		<li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tselektor_mobile') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-danger">
				<div class="box-header with-border">
					<ul class="parsley-error-list">
						<?php echo $this->session->flashdata('errors');?>
					</ul>
					<?
						if($this->session->flashdata('qr_error')){
							echo "<div class='alert alert-danger'>";
							echo "<strong>Error!</strong> ".$this->session->flashdata('qr_error');
							echo "</div>";
						}
					?>
					<form action="<?php echo site_url('tselektor_mobile/save'); ?>" class='form-vertical' parsley-validate='true' id="frmSelektor" novalidate="false" method="post" enctype="multipart/form-data" >
						<div class="row">
							<!-- Blok data SPTA -->
							<div class="col-md-6">
								<div class="form-group col-md-12" >
									<label for="ipt" class=" control-label "> Scan QR Code  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' placeholder='Letakkan cursor disini untuk scan QR'  id='no_spta' autocomplete="off" onkeyup="bacaQrcode(event,this.value)"  required />
								</div>
								<div class="form-group col-md-6">
									<label for="ipt" class=" control-label "> Tgl Tebang  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm date' name='tgl_tebang' value="" id='tgl_tebang' required readonly />
								</div>
								<div class="form-group col-md-6">
									<label for="ipt" class=" control-label "> Jam  <span class="asterix"> * </span>  </label>
									<input type='text' max="5" class='form-control input-sm' name='jam_tebang' id='jam_tebang' placeholder="06:00"  required readonly/>
								</div>
								<div class="form-group col-md-6" style="">
									<label for="ipt" class=" control-label ">Brix<span class="asterix"> * </span></label>
									<input type='number' value="0" class='form-control input-sm' name='brix_sel' id='brix_sel'  required />
								</div>
								<div class="form-group col-md-6" style="">
									<label for="ipt" class=" control-label "> Ph  <span class="asterix"> * </span>  </label>
									<input type='number' value="0" class='form-control input-sm' name='ph_sel'  id='ph_sel' required />
								</div>
								<div class="form-group col-md-6">
									<label for="ipt" class=" control-label "> Luas Tebang <span class="asterix"> * </span>  </label>
									<input type='number' onkeyup="cekha(this.value)" class='form-control input-sm' name='ha_tertebang' id="hektar_tertebang"  required readonly/>
								</div>
								<div class="form-group col-md-6">
									<label for="ipt" class=" control-label "> No Angkutan   <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' id='no_angkutan' name='no_angkutan' style="text-transform:uppercase" autocomplete="off"  onkeyup="getTara(this.value);" placeholder="NOMOR TRUK" required readonly/>
								</div>
								<div class="form-group col-md-12">
									<label for="ipt" class=" control-label "> Petugas Angkut   <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' id='ptgs_angkutan' style="text-transform:uppercase" name='ptgs_angkutan' placeholder="NAMA SOPIR/OPERATOR" required readonly/>
								</div>
							</div>
							<!-- Blok data Mandor Tebang dan Premi -->
							<div class="col-md-6">
								<div class="form-group col-md-12" >
									<label for="ipt" class=" control-label "> Mandor Tebang / Renteng  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' name='persno_mandor_tma' id='persno_mandor_tma'  required readonly/>
								</div>
								<div class="form-group col-md-12" >
									<label for="ipt" class=" control-label "> Kode Premi/Penalti    </label>
									<input type='text' class='form-control input-sm' placeholder=''  name='no_trainstat'  id= "trainstat_input" value="" readonly/>
								</div>
								<div class="col-md-6">
									<div class="checkbox">
										<label>
											<input type="text" name="terbakar_sel" id="hid_terbakar_sel" value="0" style="display:none" />
											<input type="checkbox" id="terbakar_sel" name="terbakar_sel" value="1"/><span style="color:white;background:red;">TERBAKAR</span>
										</label>
									</div>
								</div>
								<div class="from-group col-md-6">
									<div class="checkbox">
										<label>
											<input type="text" name="ditolak_sel" id="hid_ditolak_sel" value="0" style="display:none" />
											<input type="checkbox" id="ditolak_sel" name="ditolak_sel" value="1" class="checkbox"/><span style="color:white;background:black;">DITOLAK</span>
										</label>
									</div>
								</div>
								<div class="from-group col-md-12">
									<div class="checkbox">
										<label>
											<input type="text" name="trash_sel" id="hid_trash_sel" value="0" style="display:none" />
											<input type="checkbox" id="trash_sel1" name="trash_sel" value="1" class="checkbox"/><span style="color:white;background:purple;">SAMPLE TRASH</span>
										</label>
									</div>
								</div>
								<div class="form-group col-md-6" style="display:none;">
									<div class="checkbox">
										<label>
											<input type="checkbox" id="daduk_sel" name="daduk_sel" value="1" class="checkbox"/><span style="color:black;background:yellow;">DADUK</span>
										</label>
									</div>
								</div>
	              <div class="form-group col-md-6" style="display:none;">
									<div class="checkbox">
										<label>
											<input type="checkbox" id="pucuk_sel" name="pucuk_sel" value="1"class="checkbox"/><span style="color:white;background:green;">PUCUK</span>
										</label>
									</div>
								</div>
		            <div class="col-md-12" >
									<label for="ipt" class=" control-label ">Alasan Ditolak</label>
									<textarea name='ditolak_alasan' rows='2' id='ditolak_alasan' class='form-control input-sm ' style="width:100%"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- Blok data petak kebun -->
							<div class="col-md-6">
								<div class="form-group col-md-12" >
									<label for="ipt" class=" control-label "> Kode Blok / No Petak  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' readonly  id='kode_petak' name="kode_blok"  required />
								</div>
								<div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Kategori  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' readonly  name="kategori" id='kategori'  required />
								</div>
								<div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Afdeling  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' readonly  name="kode_afd" id='afdeling'  required />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group  col-md-5" >
									<label for="ipt" class=" control-label "> Angkutan  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' readonly  id='jenis_angkutan'  required />
								</div>
								<div class="form-group  col-md-7" >
									<label for="ipt" class=" control-label "> Jenis Tebangan  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' readonly  name="jenis_tebangan" id='jenis_tebangan'  required />
								</div>
								<div class="form-group col-md-12" >
									<label for="ipt" class=" control-label "> Kategori Tebangan  <span class="asterix"> * </span>  </label>
									<input type='text' class='form-control input-sm' readonly  id='kat_tebangan'  required />
								</div>
							</div>
							<!-- Hidden blok -->
							<input type="text" name="persno" id="persno" style="display:none" />
							<input type="text" name="tgl_do" id="tgl_do" style="display:none" />
							<input type="text" name="jam_do" id="jam_do" style="display:none" />
							<input type="text" name="no_hv" id="no_hv" style="display:none" />
							<input type="text" name="op_hv" id="op_hv" style="display:none" />
							<input type="text" name="no_st_gl" id="no_st_gl" style="display:none" />
							<input type="text" name="op_st_gl" id="op_st_gl" style="display:none" />
							<input type="text" name="posisi" id="posisi" style="display:none" />
							<input type="text" name="username" id="username" style="display:none" />
						</div>
						<div style="clear:both"></div>
						<div class="toolbar-line text-center">
							<input type="submit" value="Submit" name="submit" class="btn btn-primary btn-sm">
							<a href="<?php echo site_url('tselektor_mobile');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
	
<script type="text/javascript">
$(document).ready(function() {
	var idselektor = '<?php echo $this->session->flashdata('idselektor')?>';
	if(idselektor != ''){
		window.open('<?php echo site_url('tselektor/cetak')?>/'+idselektor,'_blank');
	}
	$(".sidebar-toggle").trigger("click");
	$('#manual').hide();
	$("#persno_mandor_tma").jCombo("<?php echo site_url('tselektor/comboselect?filter=sap_m_karyawan:Persno:Persno|name:id_jabatan:3') ?>",
	{  selected_value : '' });

	$('form input').on('keypress', function(e) {
		return e.which !== 13;
	});
	$('#no_spta').focus();
	<?php
		$idx = $this->session->flashdata('idselektor');
		if(isset($dx) && $idx != ''){
			?>
			window.open('<?php echo site_url('tselektor/cetak/'.$idx);?>','_blank');
			<?php
		}
		?>
//	getev();
});


function getTara(id){
	noreg = id;
	if(noreg != ''){
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('tselektor_mobile/cektara');?>",
			data: {noreg:noreg},
			dataType: 'json',
			success: function (dat) {
				if(dat.stt == 1){
					$('#no_angkutan').val(dat.data.no_pol);
					$('#ptgs_angkutan').val(dat.data.nama_supir);
				}else{
					$('#ptgs_angkutan').val('');
				}
			}
		});
	}
}

function getPetak(kodePetak){
	if(kodePetak != ''){
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('tselektor_mobile/cekPetak');?>",
			data: {kode_petak:kodePetak},
			dataType: 'json',
			success: function (data) {
				$("#kategori").val(data.kepemilikan);
				$("#afdeling").val(data.divisi);
			}
		});
	}
}

function getBrix(kodePetak){
	if(kodePetak != ''){
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('tselektor_mobile/cekBrix');?>",
			data: {kode_petak:kodePetak},
			dataType: 'json',
			success: function (data) {
				random_ph = 5 + Math.random();
				$("#brix_sel").val(data.h_brix);
				$("#ph_sel").val(random_ph);
			}
		});
	}
}

function getPta(kodePta){
	if(kodePta != ''){
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('tselektor_mobile/cekPta'); ?>",
			data: {kodePta:kodePta},
			dataType: 'json',
			success: function(data){
				$("#persno_mandor_tma").val(data.Persno + '-' + data.name);
			}
		})
	}
}

function getNoTruk(){
notruk = $("#no_angkutan").val();

// if(e.keyCode == 13 && notruk != ''){
$.ajax({
type: 'POST',
url: "<?php echo site_url('tselektor/cektruk');?>",
data: {notruk:notruk},
dataType: 'json',
success: function (dat) {
	if(dat.stt == 1){
		if (window.confirm("Nomer Angkutan "+notruk+" sudah pernah masuk hari ini, dengan nomer spat "+dat.data.no_spat))
			{
			    // $("form").submit();
			    $("#kliksubmit").click();
			}
		else
			{
			    // $("form").submit();
			}
	}else if (dat.stt == 0){ 		
			$("#kliksubmit").click();
	}else{
		$("#kliksubmit").click();
	}
	$("#trainstat_input").val('');
}
});
// }
}

function getNoSPTA(e,nospta){
	nospta = nospta.toUpperCase();
	if(e.keyCode == 13 && nospta != ''){
		var x = nospta.split("-");
		if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url('tselektor/cekspta');?>",
				data: {nospta:nospta},
				dataType: 'json',
				success: function (dat) {
					if(dat.stt == 1){
						if(dat.data.berlaku == 1 && dat.data.ed == 0 && dat.data.stt == 0){
							$('#afdeling').val(dat.data.kode_affd);
							$('#kode_petak').val(dat.data.kode_blok);
							$('#id_spta').val(dat.data.id);
							$('#kategori').val(dat.data.kode_kat_lahan);
							$('#jenis_tebangan').val(dat.data.txt_metode_tma);
							$('#jenis_angkutan').val(dat.data.jenis_spta);
							$('#kat_tebangan').val(dat.data.kat_spta);
							$('#no_spta').attr('readonly',true);
							$('#jam_tebang').focus();
							if(dat.data.metode_tma == 2){
								$('#manual').show();
								$('.mekanisasi').hide();
							}else if(dat.data.metode_tma == 3){
								$('#manual').show();
								$('.mekanisasi').show();
							}if(dat.data.metode_tma == 1){
								$('#manual').hide();
							}
						}else{
							if(dat.data.berlaku == 1){
								var al = dat.data.ed;
								if(dat.data.ed == 0){
									al = dat.data.stt;
								}
								alert(al);
							}else{
								alert(dat.data.berlaku);
							}
							$('#no_spta').val('');
						}
					}else{
					alert('Data SPTA '+nospta+' tidak ditemukan dalam database kami! Silahkan hubungi Bagian Tanaman <?php echo CNF_PG;?>');
					$('#no_spta').val('');
					}
				}
			});
		}else{
		alert('No SPTA tidak sesuai format <?php echo CNF_PG;?>');
		$('#no_spta').val('');
		}
	}
}

function bacaQrcode(e, qrcode){
	qrcode = qrcode.toUpperCase();
	params = new URLSearchParams(qrcode);
	if(e.keyCode == 13 && qrcode != ''){
		let objDataSpta = {};
		params.forEach((value, key)=>{
			//console.log(key, value);
			if(objDataSpta[key] !== undefined){
				objDataSpta[key] = [objDataSpta[key]];
				objDataSpta[key].push(value);
			} else {
				objDataSpta[key] = value;
			}
		})
		console.log(objDataSpta);
		//assign ke form
		tgl_tebang = new Date(objDataSpta.DATE+"T00:00:00.000Z");
		tgl_tebang_str = tgl_tebang.getFullYear() + "-" + (tgl_tebang.getMonth() + 1).toString().padStart(2, "0") + "-" + tgl_tebang.getDate().toString().padStart(2, "0");
		sisteb = objDataSpta.SISTEB;
		switch (sisteb){
			case "SEM":
				sisteb = "SEMI MEKANIS";
				break;
			case "MAN":
				sisteb = "MANUAL";
				break;
			case "TRN":
				sisteb = "TRANSLOADING";
				break;
			case "MKS":
				sisteb = "MEKANIS";
				break;
		}
		$("#tgl_tebang").val(tgl_tebang_str);
		$("#jam_tebang").val(objDataSpta.JAM_TEBANG);
		$("#no_angkutan").val(objDataSpta.TRUK);
		$("#kode_petak").val(objDataSpta.PETAK);
		$("#hektar_tertebang").val(objDataSpta.LUAS);
		$("#jenis_tebangan").val(sisteb);
		$("#jenis_angkutan").val("TRUK");
		$("#trainstat_input").val(objDataSpta.PREMI + "," + objDataSpta.PENALTI);
		$("#kat_tebangan").val("TAPG");
		$("#persno").val(objDataSpta.PTA);
		$("#tgl_do").val(objDataSpta.DATE);
		$("#jam_do").val(objDataSpta.TIME);
		$("#posisi").val(objDataSpta.POS);
		$("#username").val(objDataSpta.USERNAME);
		if(objDataSpta.HIJAU == "N" && $("#terbakar_sel").is(":checked") === false){
			$("#terbakar_sel").iCheck('toggle');
		} else {
			if(objDataSpta.HIJAU == "Y" && $("#terbakar_sel").is(":checked") === true){
				$("#terbakar_sel").iCheck('toggle');
			}
		}
		getPetak(objDataSpta.PETAK);
		getTara(objDataSpta.TRUK);
		getPta(objDataSpta.PTA);
		getBrix(objDataSpta.PETAK);
	}
}


function cekha(a){
if('<?php echo CNF_COMPANYCODE;?>' == 'N007'){
if(a > 0.9){
alert('Hektar tidak boleh melebihi 0.9 hektar');
$('#hektar_tertebang').val(0);
}else if(a < 0){
alert('Hektar tidak boleh kurang dari 0 hektar');
$('#hektar_tertebang').val(0);
}
}else{
if(a > 0.90){
alert('Hektar tidak boleh melebihi 0.9 hektar');
$('#hektar_tertebang').val(0);
}else if(a < 0){
alert('Hektar tidak boleh kurang dari 0 hektar');
$('#hektar_tertebang').val(0);
}
}
}
</script>