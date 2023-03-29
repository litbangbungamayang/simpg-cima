<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tkuotaspta') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tkuotaspta/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-3">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tahun Giling    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tahun_giling'];?>' name='tahun_giling' readonly  /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Ptgs Input    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ptgs_input'];?>' name='ptgs_input'   /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Tgl Input    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_input'];?>' name='tgl_input' readonly  /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Kode Plan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_plant'];?>' name='kode_plant'  required /> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tgl SPTA  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm ' placeholder='' value='<?php echo $row['tgl_spta'];?>' name='tgl_spta' id='tgl_spta' onchange="refreshKkw()" readonly 'required parsley-type='dateIso'  /> 						
								  </div> 
			</div>
			
			<div class="col-md-2">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kuota Harian   <span class="asterix"> * </span>   </label>									
									  <input type='text' onkeyup="hitung()"  class='form-control input-sm number' placeholder='' value='<?php echo $row['kuota_harian'];?>' name='kuota_harian' id='kuota_harian' required <?php if($row['id'] != '') echo 'readonly'; ?>  /> 						
								  </div> 
			</div>
			
			<div class="col-md-2">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kuota Tambahan  </label>									
									  <input type='text' class='form-control input-sm number' placeholder='' value='<?php echo $row['kuota_tambahan'];?>' onkeyup="hitung()" id='kuota_tambahan' name='kuota_tambahan' <?php if($row['id'] == '') echo 'readonly'; ?>   /> 						
								  </div> 
			</div>
			
			<div class="col-md-2">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Sisa Kuota  </label>									
									  <input type='text' class='form-control input-sm number' placeholder=''  id='sisa_kuota' readonly  /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
			
			<table class="table table-bordered display" id="gridv">
        <thead>
			<tr>
				<th> No </th>
				<th> Afdeling </th>
				<th> KKW/Sinder </th>
				<th> Kuota SPTA </th>
			</tr>
			</thead>
			<tbody id="listKkw">
			</tbody>
			</table>
				
			
			<div style="clear:both"></div>	
			
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tkuotaspta');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 refreshKkw();
 	 $('#tgl_spta').datepicker({
    startDate: '-0d',
    endDate: '+2d',
    format:'yyyy-mm-dd'
}).on('changeDate',function(e){
    $(this).datepicker('hide');
});
});

function refreshKkw(){
	var html = "";
	$.ajax({
		type: 'POST',
            url: "<?php echo site_url('tkuotaspta/getlistSptaKkwadd');?>",
			data:{tgl_spta:$('#tgl_spta').val()},
            success: function (data) {
                $('#listKkw').html(data);
				hitung();
            }
	});
}

function hitung(){
	var sisa = 0;
	var det = 0;
	var tambahan = $('#kuota_tambahan').val()*1;
	var qt_harian = $('#kuota_harian').val()*1;
	$(".qto").each(function() {
		det += $(this).val()*1;
	});
	
	sisa = (qt_harian+tambahan) - det;
	$('#sisa_kuota').val(sisa);
}
</script>		 