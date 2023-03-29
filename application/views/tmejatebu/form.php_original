<?php
 header("Access-Control-Allow-Origin: *");
?>
<script src="<?php echo base_url(); ?>sximo/js/plugins/filesaver.js"></script>
<div class="col-md-4">


 <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<span style="font-size:20px;padding-bottom:10px;padding">
            <center style="padding:10px;background:<?php echo $warna_meja_tebu; ?>;"><b><?php echo $pageTitle.' - '.$kode_meja_tebu ; ?> </b></center>
          </span>
              <div class="box" style="border-top:3px solid <?php echo $warna_meja_tebu; ?>">
              	<div class="box-header with-border">


          
          
        
		
		 <form action="<?php echo site_url('tmejatebu/save/'); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" id="dataku-<?php echo $kode_meja_tebu; ?>" > 


<div class="col-md-12">
	<?php
	if($cctv_on == 1){
	?>
	<video autoplay="true" id="videoElement-<?php echo $kode_meja_tebu; ?>" style="width: 100%" src="<?php echo $cctv_url; ?>"  >
			
		</video>
	<?php
	}else if($cctv_on == 2 || $cctv_on == 3 ){
		?>
	<img  id="videoElement-<?php echo $kode_meja_tebu; ?>" style="width: 100%" src="<?php echo $cctv_url; ?>"  >
	<?php
	}
	?>
	<canvas id="canvas-element-<?php echo $kode_meja_tebu; ?>" style="display: none;" ></canvas>
	




<div class="form-group  " >
									<label for="ipt" class=" control-label "> No SPTA  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='pastikan crusor disini untuk scan barcode'  id='no_spta-<?php echo $kode_meja_tebu; ?>' autocomplete="off" onkeyup="getNoSPTA<?php echo $kode_meja_tebu; ?>(event,this.value)"  required /> 						
								  </div>
									
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Kode Blok / No Petak  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='kode_petak-<?php echo $kode_meja_tebu; ?>'  required /> 						
								  </div>
								  
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Kategori  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='kategori-<?php echo $kode_meja_tebu; ?>'  required /> 						
								  </div>
								  
								   					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Spta  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' name='id_spta' id='id_spta-<?php echo $kode_meja_tebu; ?>'  required /> 						
								  </div> 
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Mejatebu    </label>									
									  <input type='text' class='form-control input-sm' name='id_mejatebu'   /> 						
								  </div> 					
								  					
								 
			
									
								  <div class="form-group  " >
								  <div class="col-md-6">
									<label for="ipt" class=" control-label ">Meja Tebu    </label>									
									  <input type='text' class='form-control input-sm' readonly name='kode_meja_tebu'    value="<?php echo $kode_meja_tebu; ?>" />
									
									<input type='hidden' class='form-control input-sm' readonly name='warna_meja_tebu'    value="<?php echo $warna_meja_tebu; ?>" />
									
									<input type='hidden' class='form-control input-sm' readonly name='gilingan'    value="<?php echo $this->session->userdata('gilingan'); ?>" />
								  </div>

								  <div class="col-md-6">
									<label for="ipt" class=" control-label ">No Lori    </label>									
									  <input type='text' class='form-control input-sm' readonly id="no_transloading-<?php echo $kode_meja_tebu; ?>" />
								
								  </div> 
								  <div class="col-md-12">
									<label for="ipt" class=" control-label "> Kondisi Tebu  <span class="asterix"> * </span>  </label>									
									  <select name='kondisi_tebu' rows='5' id='kondisi_tebu-<?php echo $kode_meja_tebu; ?>' code='{$kondisi_tebu}' 
							class='form-control input-sm  ' style='width: 100%;' required  ></select> 			
							</div>		
								  <!--div class="col-md-6">
								  <label for="ipt" class=" control-label "> Daduk  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='daduk'  required />  
								  </div>
								  </div>
								  <div class="form-group  " >
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Sogolan  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='sogolan'  required /> 	
								  </div>
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Non Tebu  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='non_tebu'  required /> 		
								  </div>
								  </div><div class="form-group  " >
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Akar Tanah  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='akar_tanah'  required /> 
								  </div>
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Pucuk  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='pucuk'  required /> 
								  </div-->
								</div>
								 	
								  
								  <!--div class="form-group  " >				
								  <div class="col-md-4">
								  <br />
								  <div class="checkbox" style="margin-left:-20px">
								  <label>
									<input type="checkbox" name="terbakar" value="1" > <br /> <br /><b><span style="color:white;background:red; padding:3px"> TERBAKAR</span></b>
								  </label>
								</div> 		
								</div> 
								
								<div class="col-md-4">
								<br />
								  <div class="checkbox" style="margin-left:-20px">
								  <label>
									<input type="checkbox" name="cacahan" value="1"> <br /> <br /><b><span style="color:white;background:red; padding:3px"> CACAHAN</span></b>
								  </label>
								</div> 		
								</div> 
								
								<div class="col-md-4">
								<br />
								  <div class="checkbox" style="margin-left:-20px">
								  <label>
									<input type="checkbox"  name="brondolan" value="1"><br /> <br /> <b><span style="color:white;background:red; padding:3px"> BRONDOLAN</span></b>
								  </label>
								</div> 		
								</div> 
								  </div-->
													
								   
			</div>
			
			
			
		
			<div style="clear:both"></div>	
			<hr />
				
 		<div class="toolbar-line text-center">		
			<input type="submit" name="" style="display: none" id="sub-<?php echo $kode_meja_tebu; ?>">
			<input type="button" name="submit" onclick="getImageVideo<?php echo $kode_meja_tebu; ?>()" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tmejatebu'); ?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
			
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
		$(".sidebar-toggle").trigger("click");
		$('#no_spta-<?php echo $kode_meja_tebu; ?>').focus();
		$('form input').on('keypress', function(e) {
		return e.which !== 13;
	});
	
		$("#kondisi_tebu-<?php echo $kode_meja_tebu; ?>").jCombo("<?php echo site_url('tmejatebu/comboselect?filter=m_rafaksi:nilai:nilai') ?>",
		{  selected_value : '' });

	<?php
	if($cctv_on == 3){
		?>
		var time = 0;
		setInterval(function() {
		$('#videoElement-<?php echo $kode_meja_tebu; ?>').attr('src','<?php echo $cctv_url; ?>?t='+time);
		time++;
	}, 10000); 
		<?php
	}
	?>
	

});



/*
if (navigator.mediaDevices.getUserMedia) {
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function (stream) {
      video.srcObject = stream;
    })
    .catch(function (err0r) {
      console.log("Something went wrong!");
    });
}
*/

function getImageVideo<?php echo $kode_meja_tebu; ?>(){ 
	var video<?php echo $kode_meja_tebu; ?> = document.querySelector("#videoElement-<?php echo $kode_meja_tebu; ?>");
	var spta = $('#no_spta-<?php echo $kode_meja_tebu; ?>').val();
	var mt = '<?php echo $kode_meja_tebu; ?>';
	var nilai = $('#kondisi_tebu-<?php echo $kode_meja_tebu; ?>').val();
	var today = (new Date()).toString();

	var canvas = document.querySelector("#canvas-element-<?php echo $kode_meja_tebu; ?>");
	<?php
	if($cctv_on == 1){
	?>
	
	 canvas.width = video<?php echo $kode_meja_tebu; ?>.videoWidth;
  	 canvas.height = video<?php echo $kode_meja_tebu; ?>.videoHeight;
  	 
  	 var images = video<?php echo $kode_meja_tebu; ?>;
  	 images.onload = function() {
			   canvas.getContext('2d').drawImage(images, 0, 0);
	};
     images.crossOrigin = '*';
     //image.src = video<?php echo $kode_meja_tebu; ?>;
  	 canvas.getContext('2d').drawImage(video<?php echo $kode_meja_tebu; ?>, 0, 0);
  	 canvas.getContext('2d').font = "14pt Calibri";
  	 canvas.getContext('2d').fillStyle = "white";
     canvas.getContext('2d').fillText(spta+" / "+today+' / '+nilai+' / '+mt, 20, 20);
     
  //$('#tempimg<?php echo $kode_meja_tebu; ?>').attr("src",canvas.toDataURL("image/jpeg"));
  canvas.toBlob(function(blob) {
    	saveAs(blob, spta+".jpg");
    	 $('#sub-<?php echo $kode_meja_tebu; ?>').trigger('click');
    	
});
 
  <?php
	}else if($cctv_on == 2 || $cctv_on == 3){
		?>
		var images = document.querySelector("videoElement-<?php echo $kode_meja_tebu; ?>");
		
		var newImg = new Image();
		newImg.src = document.getElementById("videoElement-<?php echo $kode_meja_tebu; ?>").getAttribute('src');
		curHeight = newImg.height;
		curWidth = newImg.width;
		
  	// images.onload = function() {
  				canvas.width = curWidth;
  	 			canvas.height = curHeight;
			    canvas.getContext('2d').drawImage(newImg, 0, 0);
			  // images.crossOrigin = 'anonymous';
     		  // images.src = document.getElementById("videoElement-<?php echo $kode_meja_tebu; ?>").getAttribute('src');
	//};
     
     canvas.getContext('2d').font = "14pt Calibri";
  	 canvas.getContext('2d').fillStyle = "white";
     canvas.getContext('2d').fillText(spta+" / "+today+' / '+nilai+' / '+mt, 20, 20);
     canvas.toBlob(function(blob) {
    	saveAs(blob, spta+".jpg");
    	$('#sub-<?php echo $kode_meja_tebu; ?>').trigger('click');
	});

		<?php
	}else{
		?>
			$('#sub-<?php echo $kode_meja_tebu; ?>').trigger('click');
		<?php
	}
  ?>

    	//

}

function getNoSPTA<?php echo $kode_meja_tebu; ?>(e,nospta){
	nospta = nospta.toUpperCase();
	
	if(e.keyCode == 13 && nospta != ''){
		var x = nospta.split("-");
		if(x[0] == '<?php echo CNF_PLANCODE; ?>' && nospta.length == 18){
			$.ajax({
            type: 'POST',
            url: "<?php echo site_url('tmejatebu/cekspta'); ?>",
            data: {nospta:nospta},
			dataType: 'json',
            success: function (dat) {
				if(dat.stt == 1){
					if(dat.data.ed == 0 && dat.data.stt == 1){
						//alert(dat.data.terbakar_sel);


						$('#kode_petak-<?php echo $kode_meja_tebu; ?>').val(dat.data.kode_blok);
						$('#id_spta-<?php echo $kode_meja_tebu; ?>').val(dat.data.id);
						$('#kategori-<?php echo $kode_meja_tebu; ?>').val(dat.data.kode_kat_lahan);
						$('#no_transloading-<?php echo $kode_meja_tebu; ?>').val(dat.data.no_trans);
						$('#no_spta-<?php echo $kode_meja_tebu; ?>').attr('readonly',true);
						
						$('#kondisi_tebu-<?php echo $kode_meja_tebu; ?>').focus();

						if(dat.data.terbakar_sel == 1){
							$('#kondisi_tebu-<?php echo $kode_meja_tebu; ?>').val('<?php echo CNF_MUTU_TERBAKAR; ?>');	
						}

					}else{
						
							var al = dat.data.ed;
							if(dat.data.ed == 0){
								al = dat.data.stt;
							}
							alert(al);
						
						$('#no_spta-<?php echo $kode_meja_tebu; ?>').val('');
					}
					
				}else{
					alert('Data SPTA '+nospta+' Tidak ditemukan dalam database kami! silahkan hubungi Bagian Tanaman <?php echo CNF_PG; ?>');
					$('#no_spta-<?php echo $kode_meja_tebu; ?>').val('');
				}
            }
        });
		}else{
			alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG; ?>');
			$('#no_spta-<?php echo $kode_meja_tebu; ?>').val('');
		}
	}
}
</script>	
</div>	 