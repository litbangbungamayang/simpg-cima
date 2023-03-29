<section class="content-header">
    <h1>
        <?php
        $ar = 'ARI';

        if(CNF_METODE ==2){
            $ar = 'CORE SAMPLER';
        }

        echo $pageTitle .' - '.$ar;?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('tanalisarendemen') ?>"><?php echo $pageTitle ?></a></li>
        <li class="active"> Form </li>
    </ol>
</section>
<div class="col-md-4">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header with-border">

                        <table class="table table-bordered display" id="gridvx">
                            <thead>
                            <tr>
                                <th>No SPTA</th>
                                <th>Mandor</th>
                                <th>Affd</th>
                                <th width="20px">ACT</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="col-md-8">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header with-border">

                        <form action="<?php echo site_url('tanalisarendemen/save/'); ?>" class='form-vertical'
                              parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" >
                            <div class="col-md-6">
                                <div class="form-group  " >
                                <input type='hidden' name='faktor_rendemen'  id='faktor_rendemen'  value="0.66" />

                                    <label for="ipt" class=" control-label "> No SPTA  <span class="asterix"> * </span>  </label>
                                    <input type='text' class='form-control input-sm' placeholder='pastikan crusor disini untuk scan barcode' autocomplete="off"  id='no_spta' onkeyup="getNoSPTA(event,this.value)"  required />
                                </div>
                                <div class="form-group col-md-6 " >
                                    <label for="ipt" class=" control-label "> Kategori  <span class="asterix"> * </span>  </label>
                                    <input type='text' class='form-control input-sm' readonly  id='kategori'  required />
                                </div>

                                <div class="form-group col-md-6 " >
                                    <label for="ipt" class=" control-label "> Afdeling  <span class="asterix"> * </span>  </label>
                                    <input type='text' class='form-control input-sm' readonly  id='afdeling'  required />
                                </div>

                                <div class="form-group col-md-8" >
                                    <label for="ipt" class=" control-label "> Tgl Ari    </label>
                                    <input type='text' class='form-control input-sm date' name='tgl_ari' value="<?php echo date('Y-m-d');?>" readonly   />
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="ipt" class=" control-label "> Jam  <span class="asterix"> * </span>  </label>

                                    <input type='text' max="5" class='form-control input-sm' name='jam_ari' value="<?php echo date('H:i');?>" placeholder="06:00"  required />
                                </div>
                                <div class="form-group hidethis " style="display:none;">
                                    <label for="ipt" class=" control-label "> Id Spta  <span class="asterix"> * </span>  </label>
                                    <input type='text' class='form-control input-sm' name='id_spta'  id='id_spta'  required />
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group col-md-4 " >
                                    <label for="ipt" class=" control-label "> % Brix  <span class="asterix"> * </span>  </label>
                                    <input type='number' class='form-control input-sm' name='persen_brix_ari' value="0" required />
                                </div>
                                <div class="form-group col-md-4 " >
                                    <label for="ipt" class=" control-label "> % Pol  <span class="asterix"> * </span>  </label>
                                    <input type='number' class='form-control input-sm'  name='persen_pol_ari' value="0" required />
                                </div>

                                <div class="form-group col-md-4 " >
                                    <label for="ipt" class=" control-label "> pH  <span class="asterix"> * </span>  </label>
                                    <input type='number' value="0" class='form-control input-sm'  name='ph_ari' required />
                                </div>
                                <?php
                                if(CNF_METODE == 2){
                                    ?>
                                    <div class="form-group col-md-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="ditolak_ari" value="1" > <br /><b><span style="color:white;background:red; padding:2px"> DITOLAK</span></b>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-8	 " >
                                        <label for="ipt" class=" control-label "> Alasan Ditolak    </label>
                                        <textarea name='ditolak_alasan' rows='4' id='ditolak_alasan' class='form-control input-sm '></textarea>
                                    </div>
                                    <?php
                                }
                                ?>


                            </div>


                            





                            <div style="clear:both"></div>

                            <div class="toolbar-line text-center">

                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
                                <a href="<?php echo site_url('tanalisarendemen');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $(".sidebar-toggle").trigger("click");
        $('#no_spta').focus();
        $('form input').on('keypress', function(e) {
            return e.which !== 13;
        });



    });

    function getNoSPTA(e,nospta){
        nospta = nospta.toUpperCase();

        if(e.keyCode == 13 && nospta != ''){
            var x = nospta.split("-");
            if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('tanalisarendemen/cekspta');?>",
                    data: {nospta:nospta},
                    dataType: 'json',
                    success: function (dat) {
                        if(dat.stt == 1){
                            if(dat.data.point_cek == 1 && dat.data.stt == 0){
                                $('#afdeling').val(dat.data.kode_affd);
                                $('#kode_petak').val(dat.data.kode_blok);
                                $('#id_spta').val(dat.data.id);
                                $('#kategori').val(dat.data.kode_kat_lahan);
                                $('#no_spta').attr('readonly',true);

                            }else{

                                var al = dat.data.point_cek;
                                if(dat.data.point_cek == 1){
                                    al = dat.data.stt;
                                }
                                alert(al);

                                $('#no_spta').val('');
                            }

                        }else{
                            alert('Data SPTA '+nospta+' Tidak ditemukan dalam database kami! silahkan hubungi Bagian Tanaman <?php echo CNF_PG;?>');
                            $('#no_spta').val('');
                        }
                    }
                });
            }else{
                alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
                $('#no_spta').val('');
            }
        }
    }

    function getDataSPTATS(nospta){
        var x = nospta.split("-");
        if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('tanalisarendemen/cekspta');?>",
                data: {nospta:nospta},
                dataType: 'json',
                success: function (dat) {
                    if(dat.stt == 1){

                        if(dat.data.point_cek == 1 && dat.data.stt == 0){
                            if(dat.data.kondisi_tebu == 'D' || dat.data.kondisi_tebu == 'E'){
                                $('#no_spta').val(nospta+' / '+dat.data.kondisi_tebu);
                            }else{
                                $('#no_spta').val(nospta);
                            }

                            $('#afdeling').val(dat.data.kode_affd);
                            $('#kode_petak').val(dat.data.kode_blok);
                            $('#id_spta').val(dat.data.id);
                            $('#kategori').val(dat.data.kode_kat_lahan);
                            $('#no_spta').attr('readonly',true);
                            $('#persen_brix_ari').focus();
                        }else{

                            var al = dat.data.point_cek;
                            if(dat.data.point_cek == 1){
                                al = dat.data.stt;
                            }
                            alert(al);

                            $('#no_spta').val('');
                        }

                    }else{
                        alert('Data SPTA '+nospta+' Tidak ditemukan dalam database kami! silahkan hubungi Bagian Tanaman <?php echo CNF_PG;?>');
                        $('#no_spta').val('');
                    }
                }
            });
        }else{
            alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
            $('#no_spta').val('');
        }
    }

    var tablex;
    $(function () {
        // $("#gridv").DataTable();
        tablex = $('#gridvx').DataTable({

            scrollCollapse: true,
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('tanalisarendemen/gridSelektor')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                }
            ]
        });
    });
</script>