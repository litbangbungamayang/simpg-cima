<html>
<head>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- DataTables -->

    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>adminlte/plugins/datatables/jquery.dataTables.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/plugins/datatables/dataTables.bootstrap.css">


    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/plugins/datepicker/datepicker3.css">

    <!-- DataTables -->

    <script src="<?php echo base_url();?>adminlte/plugins/jQuery/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url();?>adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
</head>
<body>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php include_once "menu.php"; ?>
        </div>
        <div class="col-xs-12">

            <div class="col-xs-6 col-md-4"></div>
            <div>
                <form class="form-inline">
                    <input type="text" class="form-control" name="no_trainstat" id="no_trainstat" placeholder="No Trainstat">
                    <select class="form-control" name="no_loko" id="no_loko">
                        <option></option>
                        <?php foreach ($loko as $data_loko){ ?>
                        <option value="<?php echo $data_loko->no_loko; ?>"><?php echo $data_loko->no_loko; ?></option>
                        <?php }?>
                    </select>
                    <input type="text" class="form-control datepicker" id="tgl_timbang" name="tgl_timbang" placeholder="Tgl Timbang">
                    <button type="button" class="btn" onclick="reloadTabel()">View</button>
                    <button type="button" class="btn" onclick="printOpen()">Cetak</button>
                </form>
            </div>

        </div>
    </div>
    <div class="table-responsive" style="padding: 30px;">
        <table id="antrian" class="table table-bordered display col-md-8" style="font-size: 12px">
            <thead>
            <tr>
                <th>SPTA</th>
                <th>Kategori</th>
                <th>No Petak</th>
                <th>Nama Petani</th>
                <th>No Lori</th>
                <th>Bruto</th>
                <th>Tara</th>
                <th>Netto</th>
                <th>Tgl Bruto</th>
                <th>Tgl Netto</th>
                <th>No Trainstat</th>
                <th>No Loko</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>SPTA</th>
                <th>Kategori</th>
                <th>No Petak</th>
                <th>Nama Petani</th>
                <th>No Lori</th>
                <th>Bruto</th>
                <th>Tara</th>
                <th>Netto</th>
                <th>Tgl Bruto</th>
                <th>Tgl Netto</th>
                <th>No Trainstat</th>
                <th>No Loko</th>
            </tr>
            </tfoot>
        </table>
    </div>
</section>

</body>
<script>

    $(document).ready(function() {
        $('#tgl_timbang').datepicker({ format: 'yyyy-mm-dd' });

        var tabel_lori = $('#antrian').DataTable( {
            "ajax": "<?php echo site_url('dashboardtimbangan/datalori');?>?no_trainstat="+$('#no_trainstat').val()+
            '&no_loko='+$('select[name=no_loko]').val()+'&tgl_timbang='+$('#tgl_timbang').val(),
            "paging" : false,
            "columns": [
                { "data": "no_spat" },
                { "data": "kepemilikan" },
                { "data": "kode_blok" },
                { "data": "nama_petani" },
                { "data": "no_angkutan" },
                { "data": "bruto" },
                { "data": "tara" },
                { "data": "netto" },
                { "data": "timb_bruto_tgl" },
                { "data": "timb_netto_tgl" },
                { "data": "no_trainstat" },
                { "data": "no_loko" }
            ]
        });

        window.lol = function(){
            tabel_lori.ajax.reload( null, false );
        }

    });

    function reloadTabel() {

    }
    function printOpen() {

        var url = "<?php echo site_url('dashboardtimbangan/printlori');?>?no_trainstat="+$('#no_trainstat').val()+
            '&no_loko='+$('select[name=no_loko]').val()+'&tgl_timbang='+$('#tgl_timbang').val();
        window.open(url, '_blank');
        //alert($('#no_trainstat').val()+"-"+$('select[name=no_loko]').val()+"-"+$('#tgl_timbang').val());
    }
</script>

</html>