<section class="content-header">
    <h1>
        <?php echo $pageTitle ;?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('ajuantimbangan') ?>"><?php echo $pageTitle ?></a></li>
        <li class="active"> Form </li>
    </ol>
</section>

<?php
$ubah="";
if ($row['status_validasi'] == "1"){
    $ubah = "readonly";
}
?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">


                    <?php echo $this->session->flashdata('message');?>
                    <ul class="parsley-error-list">
                        <?php echo $this->session->flashdata('errors');?>
                    </ul>
                    <form action="<?php echo site_url('ajuantimbangan/save/'.$row['id_ubah_timbangan']); ?>" class='form-horizontal'
                          parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" >


                        <div class="col-md-6">

                            <div class="form-group hidethis " style="display:none;">
                                <label for="Id Ubah Timbangan" class=" control-label col-md-4 text-left"> Id Ubah Timbangan </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_ubah_timbangan'];?>' name='id_ubah_timbangan'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group hidethis " style="display:none;">
                                <label for="Id Spat" class=" control-label col-md-4 text-left"> Id Spat </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_spat'];?>' name='id_spat' id='id_spat'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="No Spat" class=" control-label col-md-4 text-left"> No Spat <span class="asterix"> * </span></label>
                                <div class="col-md-8">
                                    <input type='text' onkeyup="getNoSPTA(event,this.value)" class='form-control input-sm' placeholder='no spat' value='<?php echo $row['no_spat'];?>' name='no_spat'  id='no_spat'  <?php echo $ubah;?> /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Bruto Awal" class=" control-label col-md-4 text-left"> Bruto Awal <span class="asterix"> * </span>  </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['bruto_awal'];?>' name='bruto_awal'  id='bruto_awal'   readonly/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Tara Awal" class=" control-label col-md-4 text-left"> Tara Awal <span class="asterix"> * </span>  </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tara_awal'];?>' name='tara_awal' id='tara_awal'   readonly/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Netto Awal" class=" control-label col-md-4 text-left"> Netto Awal <span class="asterix"> * </span>  </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['netto_awal'];?>' name='netto_awal' id='netto_awal'   readonly/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Netto Awal" class=" control-label col-md-4 text-left"> No Petak/Petani  </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder=''  name='no_petak_petani' id='no_petak_petani'   readonly/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Netto Awal" class=" control-label col-md-4 text-left"> No Kend/Supir </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder=''  name='no_kend_supir' id='no_kend_supir'   readonly/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group hidethis " style="display:none;">
                                <label for="User Pengajuan" class=" control-label col-md-4 text-left"> User Pengajuan </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['user_pengajuan'];?>' name='user_pengajuan'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group  " >
                                <label for="No Ajuan" class=" control-label col-md-4 text-left"> No Ajuan </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_ajuan'];?>' name='no_ajuan'   readonly/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>


                            <div class="form-group  " >
                                <label for="Bruto Perubahan" class=" control-label col-md-4 text-left"> Bruto Perubahan <span class="asterix"> * </span>  </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['bruto_perubahan'];?>' name='bruto_perubahan'   <?php echo $ubah;?>/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Tara Perubahan" class=" control-label col-md-4 text-left"> Tara Perubahan <span class="asterix"> * </span> </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tara_perubahan'];?>' name='tara_perubahan'   <?php echo $ubah;?>/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Netto Perubahan" class=" control-label col-md-4 text-left"> Netto Perubahan <span class="asterix"> * </span> </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['netto_perubahan'];?>' name='netto_perubahan'   <?php echo $ubah;?>/> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group hidethis " style="display:none;">
                                <label for="Tgl Pengajuan" class=" control-label col-md-4 text-left"> Tgl Pengajuan </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_perubahan'];?>' name='tgl_perubahan'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Alasan Perubahan" class=" control-label col-md-4 text-left"> Alasan Perubahan <span class="asterix"> * </span> </label>
                                <div class="col-md-8">
									  <textarea name='alasan_perubahan' rows='2' id='alasan_perubahan' class='form-control input-sm ' <?php echo $ubah;?>><?php echo $row['alasan_perubahan'] ;?></textarea> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  hidethis " style="display:none;">
                                <label for="Status Validasi" class=" control-label col-md-4 text-left"> Status Validasi </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['status_validasi'];?>' name='status_validasi'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group hidethis " style="display:none;">
                                <label for="Tgl Validasi" class=" control-label col-md-4 text-left"> Tgl Validasi </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_validasi'];?>' name='tgl_validasi'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group hidethis " style="display:none;">
                                <label for="User Validator" class=" control-label col-md-4 text-left"> User Validator </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['user_validator'];?>' name='user_validator'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                        </div>



                        <div style="clear:both"></div>

                        <div class="toolbar-line text-center">

                            <input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
                            <a href="<?php echo site_url('ajuantimbangan');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function() {

        $('form input').on('keypress', function(e) {
            return e.which !== 13;
        });
        $('#no_spat').focus();


        if($('#no_spat').val() !== ""){
            setNoSPTA($('#no_spat').val());
        }


    });

    <?php

    if (isset($row['id_ubah_timbangan'])){ ?>
    function setNoSPTA(nospta) {
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('ajuantimbangan/cekspta');?>",
            data: {nospta:nospta},
            dataType: 'json',
            success: function (dat) {
                if(dat.data.nama != null)
                {
                    nama = dat.data.nama;
                }else{
                    nama = '-'
                }
                $('#no_petak_petani').val(dat.data.kode_blok+' ('+dat.data.kode_kat_lahan+')'+' / '+nama);
                $('#no_kend_supir').val(dat.data.no_angkutan+' / '+dat.data.ptgs_angkutan);
                $('#id_spat').val(dat.data.id);
            }
        });
    }
    <?php }
    ?>



    function getNoSPTA(e,nospta){
        nospta = nospta.toUpperCase();

        if(e.keyCode == 13 && nospta != ''){
            var x = nospta.split("-");
            if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('ajuantimbangan/cekspta');?>",
                    data: {nospta:nospta},
                    dataType: 'json',
                    success: function (dat) {
                        if(dat.stt == 1){
                            $('#bruto_awal').val(dat.data.bruto);
                            $('#tara_awal').val(dat.data.tara);
                            $('#netto_awal').val(dat.data.netto);
                            if(dat.data.nama != null)
                            {
                                nama = dat.data.nama;
                            }else{
                                nama = '-'
                            }
                            $('#no_petak_petani').val(dat.data.kode_blok+' ('+dat.data.kode_kat_lahan+')'+' / '+nama);
                            $('#no_kend_supir').val(dat.data.no_angkutan+' / '+dat.data.ptgs_angkutan);
                            $('#id_spat').val(dat.data.id);
                        }else{
                            alert('data timbangan dengan No SPTA '+nospta+' sudah tidak dapat di ganti')
                        }

                    }
                });

            }else{
                alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
                $('#no_spta').val('');
            }
        }
    }



</script>