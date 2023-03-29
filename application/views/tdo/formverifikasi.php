

<div class="col-md-12">
	 <div class="form-group  " >
									<label for="template_potongan" class=" control-label col-md-4 text-left"> Periode </label>
									<div class="col-md-8">
									  <select class="form-control" id="periodeverif" name="periode" onchange="periodreload()">
                      <?php
                      $s = $this->db->query("SELECT * FROM t_periode_do where status=0 order by id")->result();
                      foreach($s as $d){
                        ?>
                        <option value="<?php echo $d->id;?>"><?php echo $d->nama_periode;?></option>
                        <?
                      }
                      ?>
                      
                    </select>  
									 </div> 
	</div> 						
</div>
<hr />
<div class="col-md-12" id="contentverif">
  </div>
			
			
		
			<div style="clear:both"><br /></div>	
				
 		<div class="toolbar-line text-center">		
			
			<a href="javascript:verifikasido()" class="tips btn btn-xs btn-success"  title="Verifikasi Data">
		<i class="fa fa-check"></i>&nbsp;Verifikasi Data</a> 

 		</div>
			  		
	

<script type="text/javascript">
  $(document).ready(function(){
      periodreload();
  });

  function periodreload(){
    var idperiod = $('#periodeverif').val();
    $.ajax({
    url: "<?php echo site_url('tdo/viewverif');?>",
    type: "POST",
    data : {idperiode:idperiod},
    dataType: 'html',
    success: function(data){
      $('#contentverif').html(data);
    },
    error: function(xhr, ajaxOptions, thrownError) {
       console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
});
  }

	function verifikasido(){
    var idperiod = $('#periodeverif').val();
		$.ajax({
    url: "<?php echo site_url('tdo/verifikasido');?>",
    type: "POST",
    data : {idperiode:idperiod},
    dataType: 'html',
    beforeSend: function() {
    	return confirm("Apakah anda yakin verifikasi data DO pada periode ini ?");
    },
    success: function(data){

    	reloaddata();
    	alert(data);
      window.location = '<?=site_url("tdo");?>';
    },
    error: function(xhr, ajaxOptions, thrownError) {
       console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
});
	}

  function cancelverifikasido(){
    var idperiod = $('#periodeverif').val();
    $.ajax({
    url: "<?php echo site_url('tdo/cancelverifikasido');?>",
    type: "POST",
    data : {idperiode:idperiod},
    dataType: 'html',
    beforeSend: function() {
      return confirm("Apakah anda yakin cancel verifikasi data DO pada periode ini ?");
    },
    success: function(data){

      reloaddata();
      alert(data);
      window.location = '<?=site_url("tdo");?>';
    },
    error: function(xhr, ajaxOptions, thrownError) {
       console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
});
  }
</script>