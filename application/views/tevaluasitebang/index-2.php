<link rel="stylesheet" href="<?php echo base_url();?>/adminlte/plugins/toast/toast.css">
<script src="<?php echo base_url();?>/adminlte/plugins/toast/toast.js"></script>

<?php usort($tableGrid, "SiteHelpers::_sort"); ?>
<section class="content-header">
    <h1>
        <?php echo $pageTitle ;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><?php echo $pageNote ;?></li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">

                </div>

                <div class="box-body">

                    <div class="page-content-wrapper m-t">

                        <div class="sbox animated fadeIn">
                            <div class="sbox-content">

                                <!--div class="col-md-3">

				<div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-aqua">
              <h3 class="widget-user-username" style="margin-left:10px"><i class="fa fa-qrcode"></i> Giling <?php echo CNF_TAHUNGILING;?></h3>
              <h5 class="widget-user-desc" style="margin-left:10px"></h5>
            </div>
			<br />
			<center>
			 <a href="<?php echo site_url('tevaluasitebang');?>" class="btn btn-sm btn-warning"> <i class="fa fa-table"></i> Kembali </a>

		  </center>
		  <hr />
            <div class="box-footer no-padding" style="max-height:450px;min-height:480px;overflow:auto">
              <ul class="nav nav-stacked" id="listKkw">
			  <?php
                                foreach($rowdetail as $rd){
                                    ?>
                <li><a href="javascript:getTables(<?php echo $rd->id;?>,'<?php echo $rd->kode_affd;?>','<?php echo $rd->nama_afdeling.' - '.$rd->name; ?>',<?php echo $rd->id_spta_kuota;?>)"><?php echo $rd->nama_afdeling.' - '.$rd->name; ?> <span class="pull-right badge bg-red"><?php echo $rd->kuota_spta-$rd->terpakai;?></span></a></li>
				<?php
                                }
                                ?>
              </ul>
            </div>
          </div>


				</div-->

                                <div class="col-md-5">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered nowrap" id="gridv2" style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th> SPTA </th>
                                                <th> Kode Blok </th>
                                                <th> Petani </th>
                                                <th> Netto </th>
                                                <th> Hektar </th>
                                                <th> Act </th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>

                                </div>

                                <div class="col-md-7">
                                    <table class="table table-striped table-bordered nowrap" id="gridv">
                                        <thead>
                                        <tr>
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
<script type="text/javascript" src="<?php echo base_url();?>adminlte/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js"></script>

<script>
    var table,tables;
    $(document).ready(function(){
        $(".sidebar-toggle").trigger("click");
    });

    $(function () {
        // $("#gridv").DataTable();
        table = $('#gridv').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "scrollY":        "600px",
            "scrollX":        true,
            "autoWidth": true,

            "scrollCollapse": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('tevaluasitebang/grids')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {  "targets": [3,6,7,8,9],"width": "50px" },
                {  "targets": [1,2],"width": "120px" },
                {"targets": [ -1 ], "orderable": false },
                { className: "number", "targets": [ 4,5,6,7,8 ] }
            ],
            "fixedColumns":  {
                leftColumns: 4
            }
        });
    });

    $(function () {
        // $("#gridv").DataTable();
        tables = $('#gridv2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('tevaluasitebang/gridsLain')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {  "targets": [3],"width": "50px" },
                {  "targets": [1,2],"width": "150px" },
                {"targets": [ -1 ], "orderable": false },
                { className: "number", "targets": [ 3,4] }
            ]
        });
    });

    function updatehektar(id){
        if($('#ha_'+id).val() > 0){
        $.ajax({
            method  : "POST",
            url		:	"<?php echo site_url('tevaluasitebang/updatehektar');?>",
            data    : {id:id,ha:$('#ha_'+id).val()},
            success	: 	function(result){

                if(r[0] == '1'){
                    $.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:r[1] ,
                icon: 'info',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',  
                hideAfter: 4000,
                showHideTransition: 'slide',
                position: 'top-center',  // To change the background
            });
                }else{
                    $.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:r[1] ,
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',
                hideAfter: 4000,
                showHideTransition: 'slide',
                position: 'top-center',  // To change the background
            });
                }
            
                table.ajax.reload();
                tables.ajax.reload();
            }
        });
    }else{
        alert('Ha Tidak boleh 0 atau kurang dari 0');
    }
    }

    function setaff(kodepetak){
        $.ajax({
            method  : "POST",
            url   : "<?php echo site_url('tevaluasitebang/updatesetaff');?>",
            data    : {kodepetak:kodepetak},
            beforeSend:function(){
                return confirm("Apakah anda yakin petak "+kodepetak+" sudah aff tebang ?");
            },
            success :   function(result){
                table.ajax.reload();
                tables.ajax.reload();
                alert('aff tebang petak '+kodepetak+' Berhasil');
            }
        });
    }
</script>
