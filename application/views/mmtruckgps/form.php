<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('mmtruckgps') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('mmtruckgps/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="Id" class=" control-label col-md-4 text-left"> Id </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Vendor" class=" control-label col-md-4 text-left"> Vendor </label>
									<div class="col-md-8">
									  <select name='vendor_id' rows='5' id='vendor_id' code='{$vendor_id}' 
							class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Nopol Truk" class=" control-label col-md-4 text-left"> Nopol Truk <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['nopol_truk'];?>' name='nopol_truk'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No Rangka" class=" control-label col-md-4 text-left"> No Rangka <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['norangka'];?>' name='norangka'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="Nama Truk" class=" control-label col-md-4 text-left"> Nama Truk </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['namatruk'];?>' name='namatruk'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="IMEI GPS" class=" control-label col-md-4 text-left"> IMEI GPS </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['imei'];?>' name='imei'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="No HP GPS" class=" control-label col-md-4 text-left"> No HP GPS <span class="asterix"> * </span></label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_hp'];?>' name='no_hp'  required /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="RFID Sticker" class=" control-label col-md-4 text-left"> RFID Sticker </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' id="rfid_sticker" placeholder='' value='<?php echo $row['rfid_sticker'];?>' name='rfid_sticker' readonly   /> <br />
									  <input type="button" onclick="getsocket()" value="GET">
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('mmtruckgps');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#vendor_id").jCombo("<?php echo site_url('mmtruckgps/comboselect?filter=m_vendor:id_vendor:nama_vendor') ?>",
		{  selected_value : '<?php echo $row["vendor_id"] ?>' });
		 	 
});

function getsocket(){
	//var socket = new WebSocket("ws://10.47.103.23:12345");
	var socket = new WebSocket("ws://127.0.0.1:8088");
	socket.onmessage = function (evt) { 
                  var received_msg = evt.data;
                  console.log(received_msg);
                  $('#rfid_sticker').val(received_msg);

                 // alert("Message is received...");
               };
}
</script>		 
