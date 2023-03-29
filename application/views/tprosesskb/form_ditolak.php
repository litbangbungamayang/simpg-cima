<section class="content-header">
    <h1>
        <?php echo $pageTitle ;?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('tprosesskb') ?>"><?php echo $pageTitle ?></a></li>
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
                    <div class='form-horizontal' >

                        <div class="box-tools pull-left">
                            Tanggal Giling : &nbsp;&nbsp;&nbsp;
                            <input type="text" class="date" id="tgl_giling" value="<?php echo date('Y-m-d');?>" >&nbsp;
                            <a href="javascript:reloadGrid()" class="tips btn btn-xs btn-info"  title="View">
                                <i class="fa fa-search"></i>&nbsp;View </a>
                            <a href="javascript:download()" class="tips btn btn-xs btn-danger"  title="View">
                                <i class="fa fa-download"></i>&nbsp;Prosess</a>

                        </div>
                        <div style="clear:both"></div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12">
            <ul class="nav nav-tabs" style="margin:10px 0;background:#dedede">
                <li><a href="<?php echo site_url('tprosesskb/'.$row['id_field_skb']);?>"><i class="fa fa-check-square"></i> SPTA SESUAI SKB </a></li>
                <li class="active"><a href="<?php echo site_url('tprosesskb/ditolak/'.$row['id_field_skb']);?>"><i class="fa fa-upload"></i> SPTA TIDAK SESUAI SKB </a></li>
            </ul>
            <div class="box box-danger">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">

                    </div>
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
                                            <th><?php //echo $this->lang->line('core.btn_action'); ?></th>
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

<script type="text/javascript">
    $(document).ready(function() {

    });


    function reloadGrid(){
        // $("#gridv").DataTable();
        //table.destroy();
        table.ajax.url( "<?php echo site_url('tprosesskb/grids')?>/2/"+$('#tgl_giling').val()).load();

    }

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
                "url": "<?php echo site_url('tprosesskb/grids')?>/2/"+$('#tgl_giling').val(),
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
    });
</script>