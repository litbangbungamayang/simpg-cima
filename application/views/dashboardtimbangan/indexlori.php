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

    <!-- DataTables -->

    <script src="<?php echo base_url();?>adminlte/plugins/jQuery/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url();?>adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
</head>
<body>
<div class="table-responsive" style="padding: 30px;">
    <table id="antrian" class="table table-bordered display col-md-8" style="font-size: 12px">
        <thead>
        <tr>
            <th>No Urut Selektor</th>
            <th>SPTA</th>
            <th>No Lori</th>
            <th>Tara</th>
            <th>Tgl Selektor</th>
            <th>No Trainstat</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>No Urut Selektor</th>
            <th>SPTA</th>
            <th>No Lori.</th>
            <th>Tara</th>
            <th>Tgl Selektor</th>
            <th>No Trainstat</th>
        </tr>
        </tfoot>
    </table>
</div>
</body>
<script>
    $(document).ready(function() {
        var tabel_antrian = $('#antrian').DataTable( {
            "ajax": "<?php echo site_url('dashboardtimbangan/data/LORI');?>",
            "paging" : false,
            "columns": [
                { "data": "no" },
                { "data": "no_spat" },
                { "data": "no_angkutan" },
                { "data": "tara" },
                { "data": "tgl_selektor" },
                { "data": "no_trainstat" }
            ]
        } );

        setInterval( function () {
            tabel_antrian.ajax.reload( null, false ); // user paging is not reset on reload
        }, 50000 );
    } );
</script>

</html>