<section class="content-header">
    <h1>
        Laporan Hasil Pasti Pabrik Gula
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('tlapharpeng') ?>">HAPAS PTPN</a></li>
        <li class="active"> Form </li>
    </ol>
</section>


<section class="content">

    <div class="row">
        <div class="col-md-12 col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="page-content-wrapper m-t">
                    <div class="box-tools pull-right">
        <?
        $gid = $this->session->userdata('gid');
        if($gid == '10' || $gid == '11'  || $gid == '1'){
            ?>
            <a href="<?php echo site_url('thapas/add') ?>" class="tips btn btn-xs btn-info"  >
        <i class="fa fa-plus"></i>&nbsp;Input / Edit Hasil Pasti </a>
            <?
        }
        ?>
        

        <a href="<?php echo site_url('thapas/cetak') ?>" class="tips btn btn-xs btn-danger"  target="_blank" >
        <i class="fa fa-print"></i>&nbsp;Cetak Hasil Pasti </a>
       
                  </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="page-content-wrapper m-t" style="height: 500px;overflow: auto;padding:10px">
                        <?
                            echo $cetak;
                        ?>
                    </div>
                </div>
            </div>
        </div>

                            
                
    </div>
</section>

<script type="text/javascript">
   
</script>