
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">


		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('tpinjamanpetani/savedetail'); ?>" class='form-vertical' 
		  method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $rowdetail['id'];?>' name='id'   /> 
									  <input type="hidden" name="id_pinjaman" value='<?php echo $row['id'];?>' />	
									  <input type="hidden" name="id_petani_sap" value='<?php echo $row['id_petani_sap'];?>' />	
									  <input type="hidden" name="sisa_saldo" value='<?php echo $row['saldo_kredit'];?>' />	
									  <input type="hidden" name="no_ref" value='<?php echo $rowdetail['no_ref'];?>' />		
									  <input type="hidden" name="saldo_sebelumnya" value='<?php echo $rowdetail['saldo_sebelumnya'];?>' />						
								  </div> 
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Pinjaman    </label>							
									<input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_pinjaman'];?>' name='no_pinjaman' readonly  /> 
									  						
								  </div> 
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tanggal    </label>							
									<input type='date' class='form-control input-sm' placeholder='' required  name='tgl' value='<?php echo $rowdetail['tgl'];?>'   /> 
									  						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Jenis Transaksi    </label>							
									<select class="form-control" name="jenis_tx">
										<option value="3">Pembayaran Langsung</option>	
									</select>	
									  						
								  </div> 					
								  					
								 <div class="form-group  " >
									<label for="ipt" class=" control-label "> Nominal    </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' required value='<?php echo $rowdetail['kredit'];?>' name='nominal' autocomplete="off"   /> 						
								  </div> 

								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Keterangan    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $rowdetail['keterangan'];?>' name='keterangan' autocomplete="off"   /> 						
								  </div> 
			</div>
			
			
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			<?
      if( $rowdetail['id'] == '' ){
      ?>
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tpinjamanpetani');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
			<?
		}
			?>
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