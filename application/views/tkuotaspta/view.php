<!--dialog box pilihan print-->
	  <div class="modal fade" tabindex="-1" role="dialog" id="modal-cetak" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title">Filter Cetak  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<select class="form-control " id="pta-cetak"></select>		
<hr />
		<select class="form-control" id="kat-cetak">
		<option value="X">SEMUA</option>
		<option value="TS">TS</option>
		<option value="TR">TR</option>
</select>		<br />
	</div> 
      <div class="modal-footer">
		<button type="button" class="btn btn-primary" onclick="cetak()">Cetak</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--end dialog !-->

<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tkuotaspta') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				
				<div class="col-md-3">
				
				<div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <h3 class="widget-user-username" style="margin-left:10px"><i class="fa fa-qrcode"></i> Giling <?php echo $row['tahun_giling'] ;?></h3>
              <h5 class="widget-user-desc" style="margin-left:10px">SPTA tgl <?php echo SiteHelpers::datereport($row['tgl_spta']);?></h5>
            </div>
			<br />
			<center>
			 <a href="<?php echo site_url('tkuotaspta');?>" class="btn btn-sm btn-warning"> <i class="fa fa-table"></i> Kembali </a>
		  <a href="javascript:filterCetak(0)" class="btn btn-sm btn-danger"> <i class="fa fa-qrcode"></i> Cetak SPTA </a>
		  <!--a href="javascript:filterCetak(1)" target="_blank" class="btn btn-sm btn-info"> <i class="fa fa-print"></i> Cetak List </a-->
		  
		  </center>
		  <hr />
		  
            <div class="box-footer no-padding" style="max-height:450px;min-height:480px;overflow:auto">
              <ul class="nav nav-stacked" id="listKkw">
			  <?php
				foreach($rowdetail as $rd){
				if($group->name != "KP10" && $group->name != "KP15" ){
			  	?>
                <li><a href="javascript:getTables(<?php echo $rd->id;?>,'<?php echo $rd->kode_affd;?>','<?php echo $rd->nama_afdeling.' - '.$rd->name; ?>',<?php echo $rd->id_spta_kuota;?>)"><?php echo $rd->kode_affd.' - '.$rd->name; ?> <span class="pull-right badge bg-red"><?php echo $rd->kuota_spta-$rd->terpakai;?></span></a></li>
				
				<?php
				}else{
						if($rd->kode_affd == CNF_AFD_JATIROTO && $group->name == "KP10"){ ?>
							<li><a href="javascript:getTables(<?php echo $rd->id;?>,'<?php echo $rd->kode_affd;?>','<?php echo $rd->nama_afdeling.' - '.$rd->name; ?>',<?php echo $rd->id_spta_kuota;?>)"><?php echo $rd->kode_affd.' - '.$rd->name; ?> <span class="pull-right badge bg-red"><?php echo $rd->kuota_spta-$rd->terpakai;?></span></a></li>
				<?php	}
						if($rd->kode_affd == CNF_AFD_ASEMBAGUS && $group->name == "KP15" ){ ?>
							<li><a href="javascript:getTables(<?php echo $rd->id;?>,'<?php echo $rd->kode_affd;?>','<?php echo $rd->nama_afdeling.' - '.$rd->name; ?>',<?php echo $rd->id_spta_kuota;?>)"><?php echo $rd->kode_affd.' - '.$rd->name; ?> <span class="pull-right badge bg-red"><?php echo $rd->kuota_spta-$rd->terpakai;?></span></a></li>
				<?php 	}
					}
				}
				?>
				
              </ul>
            </div>
          </div>
		  
		 
				</div>
				
				<div class="col-md-9">
				<fieldset><legend>Order SPTA <span id="title_order"></span></legend>
				<div class="col-md-6">
					<label for="ipt" class=" control-label "> Bulan Tanam  </label>									
					<select id="bulan_tanam" class="form-control select2" onchange="reloadgrid()">
					<option value=""> - pilih bulan tanam - </option>
					<?php
						for($r=1;$r<13;$r++){
							echo '<option value="'.$r.'A">'.$r.'A</option>';
							echo '<option value="'.$r.'B">'.$r.'B</option>';
						}
					?>
					</select>
				
				</div>
				<div class="col-md-6">
					<label for="ipt" class=" control-label "> Kategori  </label>									
					<select id="kategori" class="form-control select2" onchange="reloadgridChange(this.value)">
					</select>
				</div>
				<div class="col-md-12">
				<hr />
				 <div class="table-responsive">
				<table class="table table-bordered display" id="gridv">
					<thead>
						<tr>
							<th> No </th>
							<th> Kode Blok </th>
							<th> Deskripsi Blok </th>
							<th> Bulan Tanam </th>
							<th> Kategori </th>
							<th>Luas (Ha)</th>
							<th>Order</th>
							<th>Action</th>
						  </tr>
					</thead>

					

				</table>
				</div>
				</div>
				</fieldset>
				</div>
				
				
				<div style="clear:both"></div>	
				
			</div>
		</div>		
	

	</div>
</div>
</section>

<script>
var table='';
var idk = 0;
var afdx = '';
var idsptakuota = 0;

$(document).ready(function(){
	
	$("#kategori").jCombo("<?php echo site_url('tkuotaspta/comboselect?filter=sap_m_kat_lahan:nama_kat_lahan:nama_kat_lahan') ?>",
		{  selected_value : '' });
	
	$("#pta-cetak").jCombo("<?php echo site_url('tkuotaspta/comboselect?filter=vw_master_karyawan:Persno:name:id_jabatan:2') ?>",
		{  selected_value : '', initial_text:'- PILIH NAMA PTA -' });
		
	$(".select2").select2({ width: '100%' });
	//reloadgrid();
});
function getTables(a,b,c,d){
	
	idk = a;
	afdx = b;
	idsptakuota = d;
	reloadgrid(a,b);
	$('#title_order').html(c);
}

function reloadgridChange(ax){
	if(ax == '' && table!= ''){
		reloadgrid();
	}else if(ax != ''){
		reloadgrid();
	}
}

function formOrder(idkuotadetail,kodepetak){
	SximoModal('<?php echo site_url('tkuotaspta/order');?>/'+idkuotadetail+'/'+kodepetak+'/'+idk+'/'+idsptakuota+'/<?php echo $row['tgl_spta'];?>','Order SPTA');
}


function cetaksptaperpetak(petak){
	var url = '<?php echo site_url('tkuotaspta/cetaksptapetak');?>/<?php echo $row['tgl_spta'];?>/'+petak;
	var win = window.open(url, '_blank');
			win.focus();
}

function refreshKkw(){
	var html = "";
	$.ajax({
		type: 'POST',
            url: "<?php echo site_url('tkuotaspta/getlistSptaKkw/'.$id);?>",
            success: function (data) {
                $('#listKkw').html(data);
				
            }
	});
}


function reloadgrid(idkuotakkw=idk,afd=afdx) {
		var bulan = $('#bulan_tanam').val();
		var kategori = $('#kategori').val();
		
		if(table!='') table.destroy();
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
            "url": "<?php echo site_url('tdetailkuotakkw/grids')?>?idkuotakkw="+idkuotakkw+"&afd="+afd+"&period="+bulan+"&kategori="+kategori,
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
        });
 }
 var pil = 0;
 function filterCetak(a){
	 pil = a;
	$('#modal-cetak').modal('show'); 
 }
 
 function cetak(){
	 if($('#pta-cetak').val() != ''){
		 var url;
		if(pil==0){
			url = '<?php echo site_url('tkuotaspta/cetakspta');?>/<?php echo $row['tgl_spta'];?>/'+$('#pta-cetak').val()+'/'+$('#kat-cetak').val();
		}else{
			url = '<?php echo site_url('tkuotaspta/cetaklist');?>/<?php echo $row['tgl_spta'];?>/'+$('#pta-cetak').val()+'/'+$('#kat-cetak').val();
		}
		var win = window.open(url, '_blank');
			win.focus();
	}else{
		alert('Pilih Nama PTA Terlebih Dahulu');
	}
 }
</script>
	  