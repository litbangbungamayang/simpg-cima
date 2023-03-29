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
                    <h3 class="box-title"><?php echo $pageTitle ;?></h3>
                    <div class="box-tools pull-right">

                    </div>
                </div>

                <div class="box-body">

                    <div class="page-content-wrapper m-t">

                        <div class="sbox animated fadeIn">
                            <div class="sbox-content">

                                <?php echo $this->session->flashdata('message');?>
                                <div class="table-responsive">
                                    <form action="<?php echo site_url('lapproduksi/show/'); ?>" class='form-horizontal'
                                          parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" >


                                        <div class="col-md-12">

                                            <div class="form-group  " >
                                                <label for="Hari Giling" class=" control-label col-md-4 text-left"> Tgl Giling </label>
                                                <div class="col-md-8">
                                                    <!--<input type='number' class='form-control input-sm number' placeholder='' value='<?php //echo $hari_giling->hari_giling;?>' name='hari_giling'   /> <br />-->
                                                    <input type='text' class='form-control input-sm date' placeholder=''  name='hari_giling'   /> <br />
                                                    <i> <small></small></i>
                                                </div>
                                            </div>

                                            <div style="clear:both"></div>

                                            <div class="toolbar-line text-center">

                                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Tampilkan"/>

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
                "url": "<?php echo site_url('lapproduksi/grids')?>",
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
