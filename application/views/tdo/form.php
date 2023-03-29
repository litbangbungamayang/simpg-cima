<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tdo') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
          </ol>
        </section>

 <section class="content">
 	<div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Proses Potongan DO</h3>
                  <div class="box-body">

  <div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
  <div class="sbox-content">
  	<form action="<?php echo site_url('tdo/generatepotongan'); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" id="formgenerate" >
  <div class="col-md-3"> 
    <div class="form-group  " >
                  <label for="ipt" class=" control-label "> Jenis Do    </label>                  
                    <select class="form-control" id="jenis_do" name="jenis">
                      <option value="x">SEMUA</option>
                      <option value="0">SBH</option>
                      <option value="1">SPT</option>
                    </select>            
                  </div>
                  </div>        
                  <div class="col-md-3">  
                  <div class="form-group  " >
                  <label for="ipt" class=" control-label "> Periode    </label>                  
                    <select class="form-control" id="periode" name="periode">
                      <?php
                      $s = $this->db->query("SELECT * FROM t_periode_do WHERE status=0 order by id")->result();
                      foreach($s as $d){
                        ?>
                        <option value="<?php echo $d->id;?>"><?php echo $d->nama_periode;?></option>
                        <?
                      }
                      ?>
                      
                    </select>             
                  </div>     
                  </div> 
                  <div class="col-md-3">     
                  <div class="form-group  " >
                  <label for="ipt" class=" control-label "> Kode Blok    </label>                 
                    <input type='text' class='form-control input-sm' placeholder='' id='kode_blok' name="kode_blok"   />             
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group  " >
                  <label for="ipt" class=" control-label "> ID Petani SAP    </label>                 
                    <input type='text' class='form-control input-sm' placeholder=''  id='id_petani_sap' name="id_petani_sap"   />             
                  </div> 
                  </div> 
                  <div class="col-md-12 text-center">    
      <a href="javascript:generatepotongandefault()" class="btn btn-sm btn-warning"> <i class="fa fa-cogs" ></i> Generate Potongan </a>
      <a href="javascript:downloadtemplatepot()" class="btn btn-sm btn-info"> <i class="fa fa-download" ></i> Export Template Potongan </a>
      <a href="javascript:importpotongan()" class="btn btn-sm btn-primary"> <i class="fa fa-upload" ></i> Import Potongan </a>

      <?
      if($this->session->userdata('gid') == 1 || $this->session->userdata('gid') == 12){
      ?>
      <a href="javascript:formverifikasi()" class="btn btn-sm btn-success"> <i class="fa fa-check" ></i> Verifikasi DO</a>
      <a href="javascript:formcancelverifikasi()" class="btn btn-sm btn-danger"> <i class="fa fa-times" ></i> Cancel DO</a>
      <?
    }
      ?>
    </div>
                 </form> 
                </div>
  
</div>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>
          

<div class="row">
            <div class="col-xs-12">

              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">List Data</h3>
                  
                </div>

	 <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
	<div class="sbox-content">	

	<?php echo $this->session->flashdata('message');?>
	 <div class="table-responsive">
    <table class="table table-bordered display" id="gridv">
        <thead>
			<tr>
				<th> No </th>

				<?php foreach ($tableGrid as $k => $t) : ?>
					<?php if($t['view'] =='1'): ?>
						<th><?php echo $t['label'] ?></th>
					<?php endif; ?>
				<?php endforeach; ?>
				<th><?php echo $this->lang->line('core.btn_action'); ?></th>
			  </tr>
        </thead>

        

    </table>
	</div>
	
	</div>
</div>


	</div>
</div>
</div>
          </div>
          </div>
      </section>
			 
<script>
var table;


 $(function () {
       // $("#gridv").DataTable();
        table = $('#gridv').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('tdo/grids')?>/x/x?idpetani=kosong",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },{ className: "number", "targets": [ 6,7,8,9,10 ] },
        ],
        });
      });

$(document).ready(function(){
	reloaddata();
});

 function reloaddata(){
  table.ajax.url( "<?php echo site_url('tdo/grids')?>/"+$('#jenis_do').val()+'/'+$('#periode').val()+'?idpetani='+$('#id_petani_sap').val()+'&kodeblok='+$('#kode_blok').val() ).load();
 }

 function generatepotongandefault(){
 	if(confirm("Apakah anda yakin untuk generate Potongan Default Untuk Periode ini, Data Potongan akan dikembalikan ke default  ?")){
 		$('#formgenerate').submit()
 	}
 }

 function downloadtemplatepot(){
 	var url = "<?php echo site_url('tdo/downloadtemplatepot');?>?id_petani_sap="+$('#id_petani_sap').val()+"&kode_blok="+$('#kode_blok').val()+"&periode="+$('#periode').val()+"&jenis="+$('#jenis_do').val()
 	window.open(url);
 }

 function importpotongan(){
 	SximoModal('<?php echo site_url('tdo/importpotongan');?>','Upload Potongan','500px');
 }

 function formverifikasi(){
  SximoModal('<?php echo site_url('tdo/formverifikasi');?>','Verifikasi DO','500px');
 }

 function formcancelverifikasi(){
  SximoModal('<?php echo site_url('tdo/formcancelverifikasi');?>','Cancel Verifikasi DO','500px');
 }
</script>		 