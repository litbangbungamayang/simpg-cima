<form action="<?php echo site_url('tsbh/uploadsend'); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" id="frmSbh" enctype="multipart/form-data" > 


<div class="col-md-12">
	 <div class="form-group  " >
									<label for="template_sbh" class=" control-label col-md-4 text-left"> Upload Data Excel SBH </label>
									<div class="col-md-8">
									  <input type='file' class='form-control input-sm' placeholder='' name='template_sbh' accept=".xlsx"  /> <br />
									  <i> <small></small></i>
									 </div> 
	</div> 						
</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<a href="javascript:uploadsend()" class="tips btn btn-xs btn-success"  title="Upload Data">
		<i class="fa fa-upload"></i>&nbsp;Upload Data</a> 
 		</div>
			  		
		</form>

<script type="text/javascript">
	function uploadsend(){
		var formData = new FormData($("#frmSbh")[0]);
		$.ajax({
    url: "<?php echo site_url('tsbh/uploadsend');?>",
    type: "POST",
    data : formData,
    processData: false,
    contentType: false,
    beforeSend: function() {
    	return confirm("Apakah anda yakin upload data ini ?");
    },
    success: function(data){

    	reloadGrid();
    	alert(data);
    },
    error: function(xhr, ajaxOptions, thrownError) {
       console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
});
	}
</script>