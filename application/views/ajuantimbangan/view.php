<section class="content-header">
    <h1>
        <?php echo $pageTitle ;?>
    </h1>
    <ol class="breadcrumb">

        <li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
        <li><a href="<?php echo site_url('ajuantimbangan') ?>"><?php echo $pageTitle ?></a></li>
        <li class="active"> Detail </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" >
                            <tbody>

                            <tr>
                                <td width='30%' class='label-view text-right'>Id Ubah Timbangan</td>
                                <td><?php echo $row['id_ubah_timbangan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Id Spat</td>
                                <td><?php echo $row['id_spat'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>No Spat</td>
                                <td><?php echo $row['no_spat'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>No Ajuan</td>
                                <td><?php echo $row['no_ajuan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Netto Awal</td>
                                <td><?php echo $row['netto_awal'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Netto Perubahan</td>
                                <td><?php echo $row['netto_perubahan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Tara Awal</td>
                                <td><?php echo $row['tara_awal'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Tara Perubahan</td>
                                <td><?php echo $row['tara_perubahan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Bruto Awal</td>
                                <td><?php echo $row['bruto_awal'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Bruto Perubahan</td>
                                <td><?php echo $row['bruto_perubahan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Tgl Ajuan</td>
                                <td><?php echo $row['tgl_perubahan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Alasan Perubahan</td>
                                <td><?php echo $row['alasan_perubahan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>User Pengajuan</td>
                                <td><?php echo $row['user_pengajuan'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>User Validator</td>
                                <td><?php echo $row['user_validator'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Status Validasi</td>
                                <td><?php echo $row['status_validasi'] ;?> </td>

                            </tr>

                            <tr>
                                <td width='30%' class='label-view text-right'>Tgl Validasi</td>
                                <td><?php echo $row['tgl_validasi'] ;?> </td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <a href="<?php echo site_url('ajuantimbangan');?>" class="btn btn-sm btn-warning"> << Back </a>
                    <?php if($row['status_validasi'] == "0"){?>
                    <a href="<?php echo site_url('ajuantimbangan/adminvalidasi/'.$row['id_ubah_timbangan']);?>" class="btn btn-sm btn-danger pull-right"> Setujui </a>
                    <?php }?>
                </div>
            </div>


        </div>
    </div>
</section>
