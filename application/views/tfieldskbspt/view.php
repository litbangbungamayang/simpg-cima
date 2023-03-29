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
                <li class="active"><a href="<?php echo site_url('tfieldskbspt/show/'.$row['id_field_skb']);?>"><i class="fa fa-download"></i> PENDAFTARAN SPTA </a></li>
                <li><a href="<?php echo site_url('tfieldskbspt/sptaterdaftar/'.$row['id_field_skb']);?>"><i class="fa fa-upload"></i> SPTA TERDAFTAR </a></li>
                <li><a href="<?php echo site_url('tfieldskbspt/sptatidaksesuai/'.$row['id_field_skb']);?>"><i class="fa fa-upload"></i> SPTA TIDAK SESUAI SKB </a></li>
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
                                <form action="<?php echo site_url('tfieldskbspt/simpanskbspt/'); ?>" class='form-horizontal' parsley-validate='true' novalidate='true' id="frmskbspt" method="post" enctype="multipart/form-data" >
                                    <div class="col-md-6">
                                        <div class="form-group hidethis " style="display:none;">
                                            <label for="Id Field Skb" class=" control-label col-md-4 text-left"> Id Field Skb </label>
                                            <div class="col-md-8">
                                                <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_field_skb'];?>' name='id_field_skb' id="id_field_skb"  /> <br />
                                                <input type="hidden" id="kode_blok_perubahan" name="kode_blok_perubahan" value='<?php echo $row['kode_blok'];?>'/>
                                                <input type="hidden" id="id_petani_sap" name="id_petani_sap"/>
                                                <input type="hidden" id="id_spta" name="id_spta"/>
                                                <input type='hidden' name='kode_affd_perubahan' id='kode_affd_perubahan' /> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                        <div class="form-group  " >
                                            <label for="no_spta" class=" control-label col-md-4 text-left"> No SPTA </label>
                                            <div class="col-md-8">
                                                <input type='text' autocomplete="off" onkeyup="getNoSPTA(event, this.value)"  class='form-control input-sm' placeholder='pastikan crusor disini untuk scan barcode' name='no_spta' id="no_spta" required /> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                        <div class="form-group  " >
                                            <label for="petani" class=" control-label col-md-4 text-left"> Nama Petani </label>
                                            <div class="col-md-8">
                                                <input type='text' class='form-control input-sm' placeholder='' name='petani' id='petani'  readonly /> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                        <div class="form-group  " >
                                            <label for="deskripsi" class=" control-label col-md-4 text-left"> Deskripsi </label>
                                            <div class="col-md-8">
                                                <input type='text' class='form-control input-sm' placeholder='' name='deskripsi_spta' id='deskripsi_spta'  readonly /> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group  " >
                                            <label for="Kode Blok" class=" control-label col-md-4 text-left"> Kode Blok </label>
                                            <div class="col-md-8">
                                                <input type='text' class='form-control input-sm' placeholder='' name='kode_blok_awal' id='kode_blok_awal' readonly   /> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                        <div class="form-group  " >
                                            <label for="Harga Per Kg" class=" control-label col-md-4 text-left"> Angkutan </label>
                                            <div class="col-md-8">
                                                <input type='text' class='form-control input-sm' placeholder=''  name='angkutan' id='angkutan' readonly    /> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                        <div class="form-group  " >
                                            <label for="kepemilikan" class=" control-label col-md-4 text-left"> Kategori </label>
                                            <div class="col-md-8">
                                                <input type='text' class='form-control input-sm' placeholder=''  name='kategori_spta' id='kategori_spta' readonly   /> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div class="toolbar-line text-center">
                                        <input id="kirim_data" type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>"  disabled/>
                                    </div>
                                </form>
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
                        $('#kode_affd_perubahan').val(dat.data.divisi);
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

    function getNoSPTA(e,nospta){
        nospta = nospta.toUpperCase();

        if(e.keyCode == 13 && nospta != ''){
            e.preventDefault();

            var x = nospta.split("-");
            if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('tfieldskbspt/jsonspat');?>",
                    data: {nospta:nospta},
                    dataType: 'json',
                    success: function (dat) {
                        if(dat.stt == 1){
                            $('#id_spta').val(dat.data.id);
                            $('#petani').val(dat.data.nama_petani);
                            $('#deskripsi_spta').val(dat.data.deskripsi_blok);
                            $('#kode_blok_awal').val(dat.data.kode_blok);
                            $('#angkutan').val(dat.data.angkutan);
                            $('#kategori_spta').val(dat.data.kepemilikan);
                            $('#id_petani_sap').val(dat.data.id_petani_sap);
                            $('#kirim_data').prop('disabled', false);
                        }else{
                            alert('No SPTA '+nospta+' sudah tidak dapat di daftarkan karena bersetatus SBH')
                        }

                    }
                });


            }else{
                alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
                $('#no_spta').val('');
            }

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
                    $('#kode_affd_perubahan').val(dat.data.divisi);
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
</script>