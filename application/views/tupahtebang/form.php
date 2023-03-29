<link rel="stylesheet" href="<?php echo base_url();?>/adminlte/plugins/toast/toast.css">
<script src="<?php echo base_url();?>/adminlte/plugins/toast/toast.js"></script>

<?php

$t = $this->db->query("SELECT * FROM m_pekerjaan_tma where status_pekerjaan != 2 ORDER BY id_pekerjaan_tma ASC")->result();


?>
  <!--dialog box isi upah-->
	  <div class="modal fade" tabindex="-1" role="dialog" id="modal-upah">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Isi Upah Tebang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table style="width:100%" border="1" cellspacing="0" >
		<thead>
		<tr>
			<th style="width:450px;padding:5px">Nama Upah</th>
			<th style='padding:5px'>Nominal</th>
			<th style='padding:5px'>Satuan</th>
		</tr>
		</thead>
		<tbody>
		<?php

		

		$arkolom = array();
		$sat = array('1'=>'per Kg','2'=>'per Angkutan');
		foreach($t as $tb){

			$arkolom[] = '<input class=\'inlinecs number '.$tb->kodekolom.'\' name=\''.$tb->kodekolom.'[]\' type=\'text\' value=\''.$tb->nominal_default.'\' >';
								echo "<tr><td style='padding:5px'>".$tb->nama_pekerjaan_tma."</td><td><input class='number dataxs' value='".$tb->nominal_default."' id='".$tb->kodekolom."'></td>
								<td style='padding:5px'>".$sat[$tb->satuan]."</td></tr>";
							}
		?>
		</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="isiDataTemp()">Isi Upah Tebang</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--end dialog upah!-->

<!--dialog box list timbang-->
	  <div class="modal fade" tabindex="-1" role="dialog" id="modal-timbangan" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:850px">
      <div class="modal-header">
        <h5 class="modal-title">List Data Timbangan </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="datax" >
		<thead>
		<tr>
			<th>No</th>
			<th>x</th>
			<th>Kode Blok</th>
			<th>No SPTA</th>
			<th>No Angkutan</th>
			<th>Tgl Timb.</th>
			<th>Netto</th>
			<th>Kategori</th>
			<th>Jenis SPTA</th>
			<th>Tebangan</th>
			<th>Terbakar</th>
			<th>Mutu</th>
			<th>Tebang</th>
			<th>Masuk</th>
		</tr>
		</thead>
		<tbody id="bodylist">
			
		</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addall()">Pilih Semua</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--end dialog list timbang!-->

<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tupahtebang') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
		   <form action="<?php echo site_url('tupahtebang/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 

            <div class="col-xs-3">
              <div class="box box-danger">
              	<div class="box-header with-border">


		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		

<div class="col-md-12">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Tgl  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl'];?>' name='tgl'  required /> 						
								  </div> 					
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> No Bukti  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_bukti'];?>' name='no_bukti'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Blok  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_blok'];?>' name='kode_blok' id='kode_blok'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> PTA  <span class="asterix"> * </span>  </label>									
									  <select name='persno_pta' rows='5' id='persno_pta' code='{$persno_pta}' 
							class='form-control input-sm select2 ' style='width: 100%;' required  ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Mandor  <span class="asterix"> * </span>  </label>									
									  <select name='persno_mandor' rows='5' id='persno_mandor' code='{$persno_mandor}' 
							class='form-control input-sm select2 ' style='width: 100%;' required  ></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Keterangan    </label>									
									  <textarea name='keterangan' rows='2' id='keterangan' class='form-control input-sm '  
				           ><?php echo $row['keterangan'] ;?></textarea> 						
								  </div> 
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Tgl Timbang <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl'];?>' id='tgl_1'   /> 						
								  </div>
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> s/d Hari </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='1' id='sdhari'   /> 						
								  </div>

								  <div class="form-group  col-md-12" >
								  <select class="form-control" id="jenis_tebangan" >
			<option value="1">Manual</option>
			<option value="2">Semi Mekanisasi</option>
			<option value="3">Mekanisasi</option>
		</select>
								  </div>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		 
			
			<a  href="javascript:cariData()" class="btn btn-sm btn-warning" ><i class="fa fa-search"></i> Cari Data </a>
			<a href="javascript:getIsiUpahtebang()" class="btn btn-sm btn-danger"><i class="fa fa-edit"></i> Isi Upah </a>

			<a href="<?php echo site_url('tupahtebang');?>" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> Kembali </a>

			
			
 		</div>
			  		
		

	</div>
	</div>
</div>	

<div class="col-md-9">
<div class="box box-danger">
              	<div class="box-header with-border">
              	<div class="box-tools pull-right">
              	<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
              	</div>
              	<hr />

				<table class="table table-striped" id="gridv">
					<thead>
						<th>x</th>
						<th>SPTA</th>
						<th>NoPol</th>
						<th>Jenis</th>
						<th>Netto</th>
						<th>Tebangan</th>
						<th>Terbakar</th>
						<th>Mutu</th>
						<th>Tebang</th>
						<th>Masuk</th>
						<?php
							
							foreach($t as $tb){
								echo "<th>".$tb->nama_pekerjaan_tma."</th>";
							}
						?>
					</thead>
				<table>
</div>
</div>
</div>
</form>
				
</div>	

      </section>
	  
	
	  
	 <script type="text/javascript" src="<?php echo base_url();?>adminlte/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js"></script>
	 
	 
 		 
<script type="text/javascript">
var table;
var datasetx = [];
var dataset = [];

Array.prototype.remove = function() {
    var what, a = arguments, L = a.length, ax;
    while (L && this.length) {
        what = a[--L];
        while ((ax = this.indexOf(what)) !== -1) {
            this.splice(ax, 1);
        }
    }
    return this;
};

$(document).ready(function() { 
		$(".sidebar-toggle").trigger("click");
		$("#persno_pta").jCombo("<?php echo site_url('tupahtebang/comboselect?filter=sap_m_karyawan:Persno:name:id_jabatan:2') ?>",
		{  selected_value : '<?php echo $row["persno_pta"] ?>' });
		
		$("#persno_mandor").jCombo("<?php echo site_url('tupahtebang/comboselect?filter=sap_m_karyawan:Persno:name|Persno:id_jabatan:3') ?>",
		{  selected_value : '<?php echo $row["persno_mandor"] ?>' });
		$('#modal-upah').modal('hide');  

		if("<?php echo $row['kode_blok'];?>" == ''){
		autocompleted();	
		}else{
			$('#kode_blok').attr('readonly','true');
			<?php
			$i = 0;
			if(isset($detail)){
			foreach($detail as $key) {

				$ardet = array();
				$arter = array('1'=>'Ya','0'=>'Tidak');
				$arterx = array('1'=>'Manual','2'=>'Semi Mekanisasi','3'=>'Mekanisasi');
				$ardet[] = "<a href='javascript:removeData(\\\"".$key->id_spta."\\\")'> del</a>";
					$ardet[] = $key->no_spat;
					$ardet[] = $key->no_angkutan;
					$ardet[] = $key->jenis_spta;
					$ardet[] = "<input type='text' name='netto[]' readonly value='".$key->netto."' class='inlinecs number'><input type='hidden' readonly name='idx[]' value='".$key->id_spta."'>";
					$ardet[] = $arterx[$key->metode_tma];
					$ardet[] = $arter[$key->terbakar_sel];
					$ardet[] = $key->kondisi_tebu;
					$ardet[] = $key->tgl_tebang;
					$ardet[] = $key->tgl_selektor;		
				foreach($t as $tb){
					
					$nmkol = $tb->kodekolom;
					if($tb->satuan == 1){
						$ardet[] = '<input class=\'inlinecs number '.$tb->kodekolom.'\' name=\''.$tb->kodekolom.'[]\' type=\'text\' value=\''.$key->$nmkol/$key->netto.'\' >';
					}else{
						$ardet[] = '<input class=\'inlinecs number '.$tb->kodekolom.'\' name=\''.$tb->kodekolom.'[]\' type=\'text\' value=\''.$key->$nmkol.'\' >';
					}
					
				}
				?>
				dataset.push(<?php echo $key->id_spta;?>);
				datasetx.push([<?php echo '"'.implode('","', $ardet).'"' ?>]);
				console.log(datasetx);
				<?php
			}
		}
			?>
			setTimeout(function(){
				table.clear(); 
				table.rows.add(datasetx);
			    table.draw();
			}
			    ,1000);
		}

});

function getIsiUpahtebang(){
	$('#modal-upah').modal('show'); 
}

Date.prototype.addDays = function(days) {
    this.setDate(this.getDate() + parseInt(days));
    return this;
};

function cariData(){
	var d = new Date($('#tgl_1').val());
	var x = d.addDays($('#sdhari').val()-1).toISOString().slice(0,10);
	$.ajax({
		url : "<?php echo site_url('tupahtebang/getlistTimbangan');?>",
		method : "POST",
		data : {kode_blok:$('#kode_blok').val(),pta:$('#persno_pta').val(),mandor:$('#persno_mandor').val(),tgla:$('#tgl_1').val(),tglb:x,jenis_tebangan:$('#jenis_tebangan').val()},
		success : function(a){
			
			$('#bodylist').html(a); 
			$('#modal-timbangan').modal('show');
		}
	});
}

 $(function () {
       // $("#gridv").DataTable();
        table = $('#gridv').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
		  "scrollY":   "600px",
		  "scrollX":        true,
          "autoWidth": true,
		  
          "scrollCollapse": true,
 
        //Set column definition initialisation properties.
        "columnDefs": [
		{  "targets": [1],"width": "100px" }, 
		{  "targets": [2,3],"width": "70px" },
        {  "targets": [ -1 ], "orderable": false },
        ], 
		"fixedColumns":  {
			leftColumns: 4
		}
        });
      });
	  
function addall(){
	$(".addrowall").each(function(n,el) {
		var urlx = $(this).attr('href');
		//console.log(urlx);
		 eval(urlx.replace('javascript:',''));

	});
}
	  
	  
function addrow(id,nospta,noken,jenis,netto,terbakar,nilaitebu,tebang,masuk,tebangan){
	if (dataset.indexOf(id) === -1) {
		dataset.push(id);
		datasetx.push(["<a href='javascript:removeData(\""+id+"\")'> del</a>",nospta,noken,jenis,"<input type='text' name='netto[]' readonly value='"+netto+"' class='inlinecs number'><input type='hidden' readonly name='idx[]' value='"+id+"'>",tebangan,terbakar,nilaitebu,tebang,masuk,
		<?php echo '"'.implode('","', $arkolom).'"' ?>]);

		$.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:"Berhasil Ditambahkan no spta "+nospta  ,
                icon: 'info',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',
                hideAfter: 2000,
                showHideTransition: 'slide',
                position: 'top-right',  // To change the background
            });


	}
	else {
	  console.log("Sudah Pernah Ditambahkan");
	  $.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:"SPTA Sudah Ditambahkan "+nospta ,
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',
                hideAfter: 2000,
                showHideTransition: 'slide',
                position: 'bottom-right',  // To change the background
            });

	}
	
	table.clear(); 
	table.rows.add(datasetx);
    table.draw();
}

function removeData(id){
	var x = dataset.indexOf(id);
	console.log(x);
	dataset.remove(id);
	console.log(dataset);
	console.log(datasetx);
	datasetx.splice(x, 1);
	console.log(datasetx);

	table.clear(); 
	table.rows.add(datasetx);
    table.draw();
}


function isiDataTemp(){
	$('.dataxs').each(function(i, obj) {
		var vl = $(this).val();
		var temp = $(this).attr("id");
		$('.'+temp).val(vl);
		console.log(temp);
		
});
}

function autocompleted(){
    
	var myData = $("#kode_blok").tautocomplete({
		width: "500px",
		id:"kode_blok",
		columns: ['Afd', 'Kode','Kategori', 'Deskripsi'],
		hide: [true,true,true,true],
		placeholder: "Cari Petak",
		theme: "white",
		norecord: "No Records Found",
		ajax: {
                        url: "<?php echo site_url('tupahtebang/petakget')?>",
                        type: "GET",
                        success: function (data) {
                            return data;
                        }
                    },
        onchange: function () {
        			var all = myData.all();
        			console.log(all);
        			$('#kode_blok').val(all.Kode);
        		//	alert(all.fksatbesar);

        			setTimeout(function(){ 
        				$('#persno_pta').select(); 
        			},200);
                }
	});
}


	

</script>		 