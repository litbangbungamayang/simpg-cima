<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('trubahselektor') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('trubahselektor/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Spta    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_spta'];?>' name='id_spta' id='id_spta'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Spta    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_spta'];?>' name='no_spta' onkeyup="getNoSPTA(event,this.value)"  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Persno Mandor    </label>									
									  <select name='persno_mandor' rows='5' id='persno_mandor' code='{$persno_mandor}' 
							class='form-control input-sm  ' style='width: 100%;' readonly  ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Brix Sel    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['brix_sel'];?>' name='brix_sel' id='brix_sel'  readonly /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label ">Kode Potongan/Premi</label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['trainstat_sel'];?>' name='trainstat_sel' id='trainstat_sel' readonly  /> 						
								  </div> 	

								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Ditolak Sel    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ditolak_sel'];?>' name='ditolak_sel' id='ditolak_sel' readonly  /> 						
								  </div>
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Terbakar Sel    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['terbakar_sel'];?>' name='terbakar_sel' id='terbakar_sel' readonly  /> 						
								  </div> 				
								   
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Ba    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_ba'];?>' name='no_ba' readonly  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Edit Mandor    </label>									
									  <select name='r_perno_mandor' rows='5' id='r_perno_mandor' code='{$r_perno_mandor}' 
							class='form-control input-sm  ' style='width: 100%;'   ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Edit  Brix Sel    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['r_brix_sel'];?>' name='r_brix_sel' id='r_brix_sel'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Edit Potongan/Premi</label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['r_trainstat'];?>' name='r_trainstat' id='r_trainstat'   /> 						
								  </div> 					
								  <div class="form-group  " id="ditolakset">
									<label for="ipt" class=" control-label "> Edit Ditolak Sel    </label>									
									  
					<?php $r_ditolak_sel = explode(',',$row['r_ditolak_sel']);
					$r_ditolak_sel_opt = array( '0' => 'Tidak' ,  '1' => 'Ya' , ); ?>
					<select name='r_ditolak_sel' id='r_ditolak_sel' rows='5'   class='form-control input-sm ' style='width: 100%;' > 
						<?php 
						foreach($r_ditolak_sel_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['r_ditolak_sel'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div>

								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Edit Terbakar Sel    </label>									
									  <?php $r_terbakar_sel = explode(',',$row['r_terbakar_sel']);
										$r_terbakar_sel_opt = array( '0' => 'Tidak' ,  '1' => 'Ya' , ); ?>
										<select name='r_terbakar_sel' id='r_terbakar_sel' rows='5'   class='form-control input-sm ' style='width: 100%;' > 
											<?php 
											foreach($r_terbakar_sel_opt as $key=>$val)
											{
												echo "<option  value ='$key' ".($row['r_terbakar_sel'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
											}						
											?></select> 						
								  </div> 					
								  
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Alasan    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['alasan'];?>' name='alasan'  required /> 						
								  </div>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('trubahselektor');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#persno_mandor").jCombo("<?php echo site_url('trubahselektor/comboselect?filter=sap_m_karyawan:Persno:name:id_jabatan:3') ?>",
		{  selected_value : '<?php echo $row["persno_mandor"] ?>' });
		
		$("#r_perno_mandor").jCombo("<?php echo site_url('trubahselektor/comboselect?filter=sap_m_karyawan:Persno:name:id_jabatan:3') ?>",
		{  selected_value : '<?php echo $row["r_perno_mandor"] ?>' });

		$('form input').on('keypress', function(e) {
            return e.which !== 13;
        });
        $('#no_spta').focus();


        if($('#no_spta').val() !== ""){
           // setNoSPTA($('#no_spta').val());
        }
		 	 
});

function getNoSPTA(e,nospta){
        nospta = nospta.toUpperCase();

        if(e.keyCode == 13 && nospta != ''){
            var x = nospta.split("-");
            if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('trubahselektor/cekspta');?>",
                    data: {nospta:nospta},
                    dataType: 'json',
                    success: function (dat) {
                    	console.log(dat);
                        if(dat.stt == 1){
                        	$('#id_spta').val(dat.data.id);
                            $('#persno_mandor').val(dat.data.persno_mandor_tma);
                            $('#brix_sel').val(dat.data.brix_sel);
                            $('#trainstat_sel').val(dat.data.no_trainstat);
                            $('#ditolak_sel').val(dat.data.ditolak_sel);
                            $('#terbakar_sel').val(dat.data.terbakar_sel);

                            if(dat.data.timb_bruto_status == 1){
                            	$('#ditolakset').hide();
                            }else{
                            	$('#ditolakset').show();
                            }

                            $('#r_perno_mandor').val(dat.data.persno_mandor_tma);
                            $('#r_brix_sel').val(dat.data.brix_sel);
                            $('#r_ph_sel').val(dat.data.ph_sel);
                            $('#r_ditolak_sel').val(dat.data.ditolak_sel);
                        }else{
                            alert('data dengan No SPTA '+nospta+' tidak boleh diedit lagi');
                        }

                    }
                });

            }else{
                alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
                $('#no_spta').val('');
            }
        }
    }

    
</script>		 