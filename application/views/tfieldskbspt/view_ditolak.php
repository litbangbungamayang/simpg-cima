<section class="content-header">
    <h1>
        PENDAFTARAN SPTA untuk SPT
    </h1>
    <ol class="breadcrumb">

        <li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
        <li><a href="<?php echo site_url('tfieldskbspt') ?>"><?php echo $pageTitle ?></a></li>
        <li class="active"> Detail </li>
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
                    <div class='form-horizontal' parsley-validate='true' novalidate='true' >


                        <div class="col-md-6">

                            <div class="form-group hidethis " style="display:none;">
                                <label for="Id Field Skb" class=" control-label col-md-4 text-left"> Id Field Skb </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_field_skb'];?>' name='id_field_skb' id="id_field_skb"  /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Kode Blok" class=" control-label col-md-4 text-left"> Kode Blok </label>
                                <div class="col-md-8">
                                    <input type='text' onkeyup="getKodeBlok(event, this.value)" class='form-control input-sm' placeholder='' value='<?php echo $row['kode_blok'];?>' name='kode_blok' id="kode_blok"  disabled="disabled"/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Harga Per Kg" class=" control-label col-md-4 text-left"> Harga Per Kg </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['harga_per_kg'];?>' name='harga_per_kg' id="harga_per_kg"  disabled="disabled" /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Harga Per Kg" class=" control-label col-md-4 text-left"> Keterangan </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['keterangan'];?>' name='keterangan' id="keterangan"   disabled="disabled"/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group  " >
                                <label for="Kode Blok" class=" control-label col-md-4 text-left"> Affd </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' name='affd' id='affd' disabled="disabled"  /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Harga Per Kg" class=" control-label col-md-4 text-left"> Deskripsi </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder=''  name='deskripsi' id='deskripsi' disabled="disabled"   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="kepemilikan" class=" control-label col-md-4 text-left"> Kategori </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder=''  name='kepemilikan' id='kepemilikan' disabled="disabled"   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
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
                <li><a href="<?php echo site_url('tfieldskbspt/show/'.$row['id_field_skb']);?>"><i class="fa fa-download"></i> PENDAFTARAN SPTA </a></li>
                <li><a href="<?php echo site_url('tfieldskbspt/sptaterdaftar/'.$row['id_field_skb']);?>"><i class="fa fa-upload"></i> SPTA TERDAFTAR </a></li>
                <li class="active"><a href="<?php echo site_url('tfieldskbspt/sptatidaksesuai/'.$row['id_field_skb']);?>"><i class="fa fa-upload"></i> SPTA TIDAK SESUAI SKB </a></li>
                <li><a href="<?php echo site_url('tfieldskbspt/sptadisetujui/'.$row['id_field_skb']);?>"><i class="fa fa-check-square"></i> SPTA SESUAI SKB </a></li>
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
        $('#kode_blok').focus();

        if($('#kode_blok').val() !== ""){
            setKodeBlok($('#kode_blok').val());
        }
    });

    function getKodeBlok(e, kode_blok) {
        if(e.keyCode > 14 && kode_blok != ''){
            $.ajax({
                type: 'GET',
                url: "<?php echo site_url('tfieldskbspt/jsonfield');?>/" + kode_blok,
                dataType: 'json',
                success: function (dat) {
                    if(dat.stt == 1){
                        $('#affd').val(dat.data.divisi);
                        $('#deskripsi').val(dat.data.deskripsi_blok);
                        $('#kepemilikan').val(dat.data.kepemilikan);
                    }else{
                        alert('data petak tidak ada')
                    }

                }
            });
            //alert("test enter " + kode_blok)
        }
    }



    <?php

    if (isset($row['id_field_skb'])){ ?>
    function setKodeBlok(kode_blok) {
        $.ajax({
            type: 'GET',
            url: "<?php echo site_url('tfieldskbspt/jsonfield');?>/" + kode_blok,
            dataType: 'json',
            success: function (dat) {
                if(dat.stt == 1){
                    $('#affd').val(dat.data.divisi);
                    $('#deskripsi').val(dat.data.deskripsi_blok);
                    $('#kepemilikan').val(dat.data.kepemilikan);
                }else{
                    alert('data petak tidak ada')
                }

            }
        });
    }
    <?php }
    ?>

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
                "url": "<?php echo site_url('listskbspt/gridstidaksesuai')?>",
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