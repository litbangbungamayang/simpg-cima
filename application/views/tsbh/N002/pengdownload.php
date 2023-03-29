<?php usort($tableGrid, "SiteHelpers::_sort"); ?>




<section class="content">
    <div class="row">

        <div class="col-xs-12">
            <ul class="nav nav-tabs" style="margin:10px 0;background:#dedede">
                <li ><a href="<?php echo site_url('tsbh');?>"><i class="fa fa-download"></i> View & Download SBH </a></li>
                <?php
                $gid = $this->session->userdata('gid');
                switch ($gid) {
                    case '7' :
                        ?>
                        <li><a href="<?php echo site_url('tsbh/upload');?>"><i class="fa fa-upload"></i> Upload SBH  </a></li>
                        <?php
                        break;
                    case '10':
                        ?>
                        <li><a href="<?php echo site_url('tsbh/upload');?>"><i class="fa fa-upload"></i> Upload SBH  </a></li>
                        <li><a href="<?php echo site_url('tsbh/pengolahan');?>"><i class="fa fa-check-square"></i> Approve Pengolahan </a></li>
                        <li class="active"><a href="<?php echo site_url('tsbh/akudownload');?>"><i class="fa fa-flag-checkered"></i> File SBH untuk SAP  </a></li>
                        <?php
                        break;
                    case '11':
                        ?>

                        <li><a href="<?php echo site_url('tsbh/tanaman');?>"><i class="fa fa-check-circle"></i> Approve Tanaman </a></li>
                        <?php
                        break;
                    case '12':
                        ?>

                        <li><a href="<?php echo site_url('tsbh/aku');?>"><i class="fa fa-flag-checkered"></i> Approve AKU </a></li>

                        <?php
                        break;



                }
                ?>
            </ul>
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Approve Keuangan</h3>
                    <div class="box-tools pull-right">
                        Tanggal Giling : &nbsp;&nbsp;&nbsp;
                        <input type="text" class="date" id="tgl1" value="<?php echo date('Y-m-d');?>">&nbsp;&nbsp;s/d&nbsp;&nbsp;<input type="text" class="date" id="tgl2"  value="<?php echo date('Y-m-d');?>">
                        <a href="javascript:reloadGrid()" class="tips btn btn-xs btn-info"  title="View">
                            <i class="fa fa-search"></i>&nbsp;View </a>
                        <a href="javascript:downloadExcel()" class="tips btn btn-xs btn-danger"  title="View">
                            <i class="fa fa-download"></i>&nbsp;Download Excel SAP </a>

                    </div>
                </div>

                <div class="box-body">

                    <div class="page-content-wrapper m-t">

                        <div class="sbox animated fadeIn">
                            <div class="sbox-content">

                                <?php echo $this->session->flashdata('message');?>
                                <table class="table table-striped table-bordered nowrap" id="gridv" >
                                    <thead>
                                    <tr>

                                        <?php foreach ($tableGrid as $k => $t) : ?>
                                            <?php if($t['view'] =='1'): ?>
                                                <th><?php echo $t['label'] ?></th>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tr>
                                    </thead>

                                    <tfoot align="right">
                                    <tr>
                                        <th colspan="14" style="background: #dd4b39;color:white"> Jumlah </th>
                                        <th id ='hatebang'></th>
                                        <th colspan="15" style="background: #dd4b39;color:white"> Jumlah </th>
                                        <th></th>
                                        <th colspan="8" style="background: #dd4b39;color:white"> Jumlah </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th  style="background: #dd4b39;color:white"> Jumlah </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>


                                </table>

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
    jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
        return this.flatten().reduce( function ( a, b ) {
            if ( typeof a === 'string' ) {
                a = a.replace(/[^\d.-]/g, '') * 1;
            }
            if ( typeof b === 'string' ) {
                b = b.replace(/[^\d.-]/g, '') * 1;
            }

            return a + b;
        }, 0 );
    } );

    var table;
    $(document).ready(function(){


        table = $('#gridv').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "scrollY":        "600px",
            "scrollX":        true,
            "autoWidth": true,

            "scrollCollapse": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('tsbh/gridssbh')?>/4/"+$('#tgl1').val()+'/'+$('#tgl2').val(),
                "type": "POST"
            },




            //Set column definition initialisation properties.
            "columnDefs": [
                {  "targets": [1,3,2,5],"width": "100px" },
                {  "targets": [6],"width": "70px" },
                {  "targets": [0],"width": "20px" },
                { className: "number", "targets": [ 14,30,39,40,41,43,44,45,46 ] },
                {  "targets": [ -1 ], "orderable": false },
            ],
            "fixedColumns":  {
                leftColumns: 6
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // total_salary over all pages
                var ha = api.column( 14 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var netto = api.column( 30 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var hablur = api.column( 39 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var gtt = api.column( 40 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var ttt = api.column( 41 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var gptr = api.column( 43 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var tptr = api.column( 44 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var gpg = api.column( 45 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );

                var tpg = api.column( 46 ).data().reduce( function (a, b) {
                    var x = intVal(a) + intVal(b);

                    return x;
                },0 );



                // ttx = parseFloat(ttx);
                //total_salary = parseFloat(total_salary);
                // Update footer
                $( api.column( 14 ).footer() ).html(ha.toFixed(4));
                $( api.column( 30 ).footer() ).html(netto.toFixed(0));
                $( api.column( 39 ).footer() ).html(hablur.toFixed(2));
                $( api.column( 40 ).footer() ).html(gtt.toFixed(2));
                $( api.column( 41 ).footer() ).html(ttt.toFixed(2));
                $( api.column( 43 ).footer() ).html(gptr.toFixed(2));
                $( api.column( 44 ).footer() ).html(tptr.toFixed(2));
                $( api.column( 45 ).footer() ).html(gpg.toFixed(2));
                $( api.column( 46 ).footer() ).html(tpg.toFixed(2));
            }


        });


    });

    function reloadGrid(){
        // $("#gridv").DataTable();
        //table.destroy();
        table.ajax.url( "<?php echo site_url('tsbh/gridssbh')?>/4/"+$('#tgl1').val()+'/'+$('#tgl2').val() ).load();

    }


    function downloadExcel(){

        var url = "<?php echo site_url('tsbh/excelsap');?>/"+$('#tgl1').val()+'/'+$('#tgl2').val();
        window.open(url,'_blank');
    }


</script>
