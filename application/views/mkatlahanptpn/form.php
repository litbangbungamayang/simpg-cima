<section class="content-header">
    <h1>
        <?php echo $pageTitle ;?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('mkatlahanptpn') ?>"><?php echo $pageTitle ?></a></li>
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
                    <form action="<?php echo site_url('mkatlahanptpn/save/'.$row['id_kat_ptp']); ?>" class='form-horizontal'
                          parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" >


                        <div class="col-md-12">

                            <div class="form-group hidethis " style="display:none;">
                                <label for="Id Kat Ptp" class=" control-label col-md-4 text-left"> Id Kat Ptp </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_kat_ptp'];?>' name='id_kat_ptp'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Kode PTP" class=" control-label col-md-4 text-left"> Kode PTP </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_kat_ptp'];?>' name='kode_kat_ptp'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Keterangan" class=" control-label col-md-4 text-left"> Keterangan </label>
                                <div class="col-md-8">
                                    <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ket_kat_ptp'];?>' name='ket_kat_ptp'   /> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Kode SAP" class=" control-label col-md-4 text-left"> Kode SAP </label>
                                <div class="col-md-8">
                                    <select name='kat_sap' rows='5' id='kat_sap' code='{$kat_sap}'
                                            class='form-control input-sm select2 ' style='width: 100%;'   ></select> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Status Blok SAP" class=" control-label col-md-4 text-left"> Status Blok SAP </label>
                                <div class="col-md-8">

                                    <?php $status_blok_sap = explode(',',$row['status_blok_sap']);
                                    $status_blok_sap_opt = array( 'PC' => 'PC' ,  'R1' => 'R1' ,  'R2' => 'R2' ,  'R3' => 'R3' , ); ?>
                                    <select name='status_blok_sap[]' rows='5'  multiple  class='form-control input-sm select2' style='width: 100%;'  >
                                        <?php
                                        foreach($status_blok_sap_opt as $key=>$val)
                                        {
                                            echo "<option  value ='$key' ".(in_array($key,$status_blok_sap) ? " selected='selected' " : '' ).">$val</option>";
                                        }
                                        ?></select> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Jenis Tanah SAP" class=" control-label col-md-4 text-left"> Jenis Tanah SAP </label>
                                <div class="col-md-8">

                                    <?php $jenis_tanah_sap = explode(',',$row['jenis_tanah_sap']);
                                    $jenis_tanah_sap_opt = array( '04' => '04' ,  '05' => '05' , ); ?>
                                    <select name='jenis_tanah_sap[]' rows='5'  multiple  class='form-control input-sm select2' style='width: 100%;'  >
                                        <?php
                                        foreach($jenis_tanah_sap_opt as $key=>$val)
                                        {
                                            echo "<option  value ='$key' ".(in_array($key,$jenis_tanah_sap) ? " selected='selected' " : '' ).">$val</option>";
                                        }
                                        ?></select> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                            <div class="form-group  " >
                                <label for="Tipe" class=" control-label col-md-4 text-left"> Tipe </label>
                                <div class="col-md-8">

                                    <?php $tipe_kat_lahan = explode(',',$row['tipe_kat_lahan']);
                                    $tipe_kat_lahan_opt = array( 'TS' => 'TS' ,  'TR' => 'TR' , ); ?>
                                    <select name='tipe_kat_lahan' rows='5'   class='form-control input-sm select2' style='width: 100%;' >
                                        <?php
                                        foreach($tipe_kat_lahan_opt as $key=>$val)
                                        {
                                            echo "<option  value ='$key' ".($row['tipe_kat_lahan'] == $key ? " selected='selected' " : '' ).">$val</option>";
                                        }
                                        ?></select> <br />
                                    <i> <small></small></i>
                                </div>
                            </div>
                        </div>



                        <div style="clear:both"></div>

                        <div class="toolbar-line text-center">

                            <input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
                            <a href="<?php echo site_url('mkatlahanptpn');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {

        $("#kat_sap").jCombo("<?php echo site_url('mkatlahanptpn/comboselect?filter=sap_m_kat_lahan:nama_kat_lahan:nama_kat_lahan') ?>",
            {  selected_value : '<?php echo $row["kat_sap"] ?>' });

    });
</script>