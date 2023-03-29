<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tmutasigulaproduksi') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tmutasigulaproduksi/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-3">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Berita Acara    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_berita_acara'];?>' name='no_berita_acara' readonly  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tanggal Jam    </label>									
									  <div class="row"><div class="col-md-7">
				<input type='date' class='form-control input-sm ' placeholder='' value='<?php echo $row['tanggal_jam_ba'];?>' name='tanggal_ba'	 required  /> </div>
				<div class="col-md-5">									  
				<input type='time' class='form-control input-sm' placeholder='' value='<?php echo $row['tanggal_jam_ba'];?>' name='jam_ba'	required  /> 	</div>
				</div>					
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tanggal Produksi    </label>									
									  <input type='date' class='form-control input-sm' placeholder='' value='<?php echo $row['tanggal_produksi'];?>' required name='tanggal_produksi' id="tglprod" onchange="detaildata()" /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Company Plant    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['company_plant'];?>' name='company_plant'   /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Code Plant    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['code_plant'];?>' name='code_plant'   /> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Zak Gula Counter    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['zak_gula_counter'];?>' name='zak_gula_counter' id='zak_gula_counter' readonly   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Ton Gula Counter    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ton_gula_counter'];?>' name='ton_gula_counter' id='ton_gula_counter' readonly  /> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Zak Gula Diserahkan    </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='<?php echo $row['zak_gula_diserahkan'];?>' name='zak_gula_diserahkan' id='zak_gula_diserahkan' required  /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Ton Gula Diserahkan    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ton_gula_diserahkan'];?>' name='ton_gula_diserahkan' onkeyup="hitunghead()" id='ton_gula_diserahkan' required  /> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
									 <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kardus Gula Ritel    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kardus_gula'];?>' name='kardus_gula' id='kardus_gula' required   /> 						
								  </div>
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Ton Gula Ritel    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ton_gula_ritel'];?>' name='ton_gula_ritel' onkeyup="hitunghead()" id='ton_gula_ritel' required  /> 						
								  </div> 					
								  					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Total Ton    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['total_ton'];?>' name='total_ton' id='total_ton' required readonly  /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
			<table class="table table-bordered display dataTable no-footer" id="detail">
                <thead>
					<tr>
					<th >Jenis Produksi</th>
					<th  style="text-align: center;"  width="100px">Tahun Produksi</th>
					<th width="100px">Keterangan</th>
					<th width="100px">Total sd YL</th>
                    <th width="150px">Total Hi</th>
                    <th width="150px">Total sd Hi</th>
                </tr>
            </thead>
            <tbody id="detaildata">
            	
            </tbody>
            <tfoot>
					<tr>
					<th >Total</th>
					<th  style="text-align: center;"  width="100px"></th>
					<th width="100px"></th>
					<th width="100px"><input type="number" readonly class="number" id="ttlyl"></th>
                    <th width="150px"><input type="number" readonly class="number" id="ttlhi"></th>
                    <th width="150px"><input type="number" readonly class="number" id="ttlsd"></th>
                </tr>
            </tfoot>
        </table>
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tmutasigulaproduksi');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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

function getcounterdata(){
	$.ajax({
            type: "POST",
            url: "<?=site_url('tmutasigulaproduksi/getcounterdata');?>",
            data: {tgl:$('#tglprod').val()},
            dataType:'json',
            success: function (data) {
                console.log(data);
                $('#zak_gula_counter').val(data.zak);
                $('#ton_gula_counter').val(data.ton);

                $('#zak_gula_diserahkan').val(data.zak);
                $('#ton_gula_diserahkan').val(data.ton);
                $('#kardus_gula').val(0);
                $('#ton_gula_ritel').val(0);
                hitunghead();
            }
        });
}

function hitunghead(){
	var tonzak = parseFloat($('#ton_gula_diserahkan').val());
	var tonritel = parseFloat($('#ton_gula_ritel').val());

	var total = tonzak + tonritel;
	$('#total_ton').val(total);
}

function detaildata(){
	$.ajax({
            type: "POST",
            url: "<?=site_url('tmutasigulaproduksi/getdetail');?>",
            data: {tgl:$('#tglprod').val()},
            success: function (data) {
                
                $('#detaildata').html(data);
                hitungsemua();
                getcounterdata();
            }
        });
}

function hitung(i){
	var yl = parseFloat($('#total_sd_yl_'+i).val());
	var hi = parseFloat($('#total_hi_'+i).val());
//	
	if(hi == '') hi =0;
	if($('#total_sd_yl_'+i).val() == "") yl =0;
	var ht = yl+hi;
	console.log(hi+' '+yl);
	var sdhi = $('#total_sd_hi_'+i).val(ht.toFixed(3));

	hitungsemua();
}


function hitungsemua(){
	var ttlyl = 0;
	$(".ttlyl").each(function(){
		var x = parseFloat($(this).val());
		if($(this).val() == "") x = 0;
		ttlyl += x;
	});

	var ttlhi = 0;
	$(".ttlhi").each(function(){
		var x = parseFloat($(this).val());
		if($(this).val() == "") x = 0;
		ttlhi += x;
	});

	var ttlsd = 0;
	$(".ttlsd").each(function(){
		var x = parseFloat($(this).val());
		if($(this).val() == "") x = 0;
		ttlsd += x;
	});

	$('#ttlyl').val(ttlyl.toFixed(3));
	$('#ttlsd').val(ttlsd.toFixed(3));
	$('#ttlhi').val(ttlhi.toFixed(3));
}
</script>		 