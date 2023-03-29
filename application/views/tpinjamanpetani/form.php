<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tpinjamanpetani') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tpinjamanpetani/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Pinjaman    </label>									
									  <input type='text' class='form-control input-sm' placeholder='Automatic' value='<?php echo $row['no_pinjaman'];?>' name='no_pinjaman' readonly   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> ID Petani SAP  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_petani_sap'];?>' name='id_petani_sap'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Penyalur    </label>									
									  
					<?php $penyalur = explode(',',$row['penyalur']);
					$penyalur_opt = array( 'PKBL' => 'PKBL' ,  'BRI' => 'BRI' , ); ?>
					<select name='penyalur' rows='5'   class='form-control input-sm select2' style='width: 100%;' > 
						<?php 
						foreach($penyalur_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['penyalur'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Keterangan    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['keterangan'];?>' name='keterangan'   /> 						
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tgl Pencairan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl_pencairan'];?>' name='tgl_pencairan' readonly required /> 						
								  </div> 					
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> Pokok Pinjaman  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='<?php echo $row['pokok_pinjaman'];?>' name='pokok_pinjaman' onkeyup="hitung()" id="pokok"  required /> 						
								  </div> 					
								  <div class="form-group  col-md-3" >
									<label for="ipt" class=" control-label "> Bunga/Thn (%)  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='<?php echo $row['bunga_per_tahun'];?>' name='bunga_per_tahun' id="bunga" onkeyup="hitung()" required /> 						
								  </div> 					
								  <div class="form-group col-md-5 " >
									<label for="ipt" class=" control-label "> Sisa Pinjaman  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='<?php echo $row['saldo_kredit'];?>' name='saldo_kredit' readonly id="sisa" required /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tpinjamanpetani');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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

function hitung(){
	var pokok = parseFloat($('#pokok').val());
	var bunga = parseFloat($('#bunga').val());
	if($('#pokok').val() == '') pokok = 0;
	if($('#bunga').val() == '') bunga = 0;
	var vsisa = pokok + (pokok*bunga/100);
	console.log(pokok+' '+bunga);
	$('#sisa').val(Math.round(vsisa));
	
}
</script>		 