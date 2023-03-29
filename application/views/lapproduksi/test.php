<style type="text/css">
    table.tableizer-table {
        font-size: 12px;
        border: 1px solid #CCC;
        font-family: Arial, Helvetica, sans-serif;
        width:100%;
    }
    .tableizer-table td {
        padding: 4px;
        margin: 3px;
        border: 1px solid #CCC;
    }
    .tableizer-table th {
        background-color: #104E8B;
        color: #FFF;
        font-weight: bold;
        height:25px;padding:10px;
        border: 1px solid #ffffff;
    }
</style>
<?php


$all_total_ha_ditebang = 0;
$all_total_qty_ditebang = 0;
$all_total_ha_digiling = 0;
$all_total_qty_digiling = 0;
$all_total_qty_digiling_kg = 0;
$all_total_hablur = 0;
$all_total_hablur_kg = 0;
$all_total_gula_ptr = 0;
$all_total_tetes_ptr = 0;

$all_sd_total_ha_ditebang = 0;
$all_sd_total_qty_ditebang = 0;
$all_sd_total_ha_digiling = 0;
$all_sd_total_qty_digiling = 0;
$all_sd_total_qty_digiling_kg = 0;
$all_sd_total_hablur = 0;
$all_sd_total_hablur_kg = 0;
$all_sd_total_gula_ptr = 0;
$all_sd_total_tetes_ptr = 0;


?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Produksi Hari Giling ke <?php echo $hari_giling;?></h3>
                    <div class="box-tools pull-right">


                    </div>
                </div>

                <div class="box-body">

                    <div class="page-content-wrapper m-t">

                        <div class="sbox animated fadeIn">
                            <div class="sbox-content" style="height:650px;padding:10px;overflow:auto" id="report" >
                                <form action="<?php echo site_url("lapproduksi/save");?>" method="post">
                                    <div class="table-responsive">
                                        <input type="hidden" name="hari_giling" value="<?php echo $hari_giling; ?>">
                                        <?php
                                        function replaceKat($kat){
                                            $result = str_replace(" ", "_", $kat);
                                            $output = str_replace("-", "_", $result);
                                            return $output;
                                        }
                                        ?>
                                        <table class="tableizer-table">
                                            <thead>
                                            <tr style="background-color: #104E8B" class="tableizer-firstrow">
                                                <th style="text-align: center" rowspan="2">KATEGORI</th>
                                                <th style="text-align: center" colspan="2">HA TERTEBANG</th>
                                                <th style="text-align: center" colspan="2">QTY TERTEBANG</th>
                                                <th style="text-align: center" colspan="2">HA TERGILING</th>
                                                <th style="text-align: center" colspan="2">QTY TERGILING</th>
                                                <th style="text-align: center" colspan="2">QTY KRISTAL</th>
                                                <th style="text-align: center" colspan="2">RENDEMEN</th>
                                                <th style="text-align: center" colspan="2">QTY GULA PTR</th>
                                                <th style="text-align: center" colspan="2">QTY TETES PTR</th>
                                            </tr>
                                            <tr style="background-color: #104E8B;" class="tableizer-firstrow">
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                                <th style="text-align: center">HI</th>
                                                <th style="text-align: center">SD</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php require_once "ts_lokal.php"; ?>
                                            <?php
                                            $all_total_ha_ditebang += $total_ha_ditebang;
                                            $all_total_qty_ditebang += $total_qty_ditebang;
                                            $all_total_ha_digiling += $total_ha_digiling;
                                            $all_total_qty_digiling += $total_qty_digiling;
                                            $all_total_qty_digiling_kg += $total_qty_digiling_kg;
                                            $all_total_hablur += $total_hablur;
                                            $all_total_hablur_kg += $total_hablur_kg;
                                            $all_total_gula_ptr += $total_gula_ptr;
                                            $all_total_tetes_ptr += $total_tetes_ptr;

                                            $all_sd_total_ha_ditebang += $sd_total_ha_ditebang;
                                            $all_sd_total_qty_ditebang += $sd_total_qty_ditebang;
                                            $all_sd_total_ha_digiling += $sd_total_ha_digiling;
                                            $all_sd_total_qty_digiling += $sd_total_qty_digiling;
                                            $all_sd_total_qty_digiling_kg += $sd_total_qty_digiling_kg;
                                            $all_sd_total_hablur += $sd_total_hablur;
                                            $all_sd_total_hablur_kg += $sd_total_hablur_kg;
                                            $all_sd_total_gula_ptr += $sd_total_gula_ptr;
                                            $all_sd_total_tetes_ptr += $sd_total_tetes_ptr;
                                            ?>
                                            <?php require_once "ts_tr.php";?>
                                            <?php
                                            $all_total_ha_ditebang += $total_ha_ditebang;
                                            $all_total_qty_ditebang += $total_qty_ditebang;
                                            $all_total_ha_digiling += $total_ha_digiling;
                                            $all_total_qty_digiling += $total_qty_digiling;
                                            $all_total_qty_digiling_kg += $total_qty_digiling_kg;
                                            $all_total_hablur += $total_hablur;
                                            $all_total_hablur_kg += $total_hablur_kg;
                                            $all_total_gula_ptr += $total_gula_ptr;
                                            $all_total_tetes_ptr += $total_tetes_ptr;

                                            $all_sd_total_ha_ditebang += $sd_total_ha_ditebang;
                                            $all_sd_total_qty_ditebang += $sd_total_qty_ditebang;
                                            $all_sd_total_ha_digiling += $sd_total_ha_digiling;
                                            $all_sd_total_qty_digiling += $sd_total_qty_digiling;
                                            $all_sd_total_qty_digiling_kg += $sd_total_qty_digiling_kg;
                                            $all_sd_total_hablur += $sd_total_hablur;
                                            $all_sd_total_hablur_kg += $sd_total_hablur_kg;
                                            $all_sd_total_gula_ptr += $sd_total_gula_ptr;
                                            $all_sd_total_tetes_ptr += $sd_total_tetes_ptr;
                                            ?>
                                            <?php require_once "spt.php"; ?>
                                            <?php
                                            $all_total_ha_ditebang += $total_ha_ditebang;
                                            $all_total_qty_ditebang += $total_qty_ditebang;
                                            $all_total_ha_digiling += $total_ha_digiling;
                                            $all_total_qty_digiling += $total_qty_digiling;
                                            $all_total_qty_digiling_kg += $total_qty_digiling_kg;
                                            $all_total_hablur += $total_hablur;
                                            $all_total_hablur_kg += $total_hablur_kg;
                                            $all_total_gula_ptr += $total_gula_ptr;
                                            $all_total_tetes_ptr += $total_tetes_ptr;

                                            $all_sd_total_ha_ditebang += $sd_total_ha_ditebang;
                                            $all_sd_total_qty_ditebang += $sd_total_qty_ditebang;
                                            $all_sd_total_ha_digiling += $sd_total_ha_digiling;
                                            $all_sd_total_qty_digiling += $sd_total_qty_digiling;
                                            $all_sd_total_qty_digiling_kg += $sd_total_qty_digiling_kg;
                                            $all_sd_total_hablur += $sd_total_hablur;
                                            $all_sd_total_hablur_kg += $sd_total_hablur_kg;
                                            $all_sd_total_gula_ptr += $sd_total_gula_ptr;
                                            $all_sd_total_tetes_ptr += $sd_total_tetes_ptr;

                                            ?>

                                            <tr style="background-color: #00e765">
                                                <td><strong>JUMLAH TS</strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_ha_ditebang, 2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_ha_ditebang == 0 ? number_format($all_total_ha_ditebang, 2) : number_format($all_sd_total_ha_ditebang+$all_total_ha_ditebang, 2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_qty_ditebang,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_qty_ditebang == 0 ? number_format($all_total_qty_ditebang, 2) : number_format($all_sd_total_qty_ditebang+$all_total_qty_ditebang,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_ha_digiling,2);?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_ha_digiling == 0 ? number_format($all_total_ha_digiling,2) : number_format($all_sd_total_ha_digiling+$all_total_ha_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_qty_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_qty_digiling == 0 ? number_format($all_total_qty_digiling,2) : number_format($all_sd_total_qty_digiling+$all_total_qty_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_hablur,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_hablur == 0 ? number_format($all_total_hablur,2) : number_format($all_sd_total_hablur+$all_total_hablur,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo @number_format(($all_total_hablur_kg/$all_total_qty_digiling_kg)*100,2,'.',''); ?></strong></td>
                                                <?php $hablur_sd = $all_sd_total_hablur_kg+$all_total_hablur_kg; ?>
                                                <?php $digiling_sd = $all_sd_total_qty_digiling_kg+$all_total_qty_digiling_kg; ?>
                                                <td style="text-align: right"><strong><?php echo @number_format(($hablur_sd/$digiling_sd)*100,2,'.',''); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_gula_ptr,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_gula_ptr == 0 ? number_format($all_total_gula_ptr, 2) : number_format($all_sd_total_gula_ptr+$all_total_gula_ptr,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_tetes_ptr,2);?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_tetes_ptr == 0 ? number_format($all_total_tetes_ptr,2) : number_format($all_sd_total_tetes_ptr+$all_total_tetes_ptr,2);?></strong></td>
                                            </tr>

                                            <?php
                                            $tot_tr_total_ha_ditebang = 0;
                                            $tot_tr_total_qty_ditebang = 0;
                                            $tot_tr_total_ha_digiling = 0;
                                            $tot_tr_total_qty_digiling = 0;
                                            $tot_tr_total_qty_digiling_kg = 0;
                                            $tot_tr_total_hablur = 0;
                                            $tot_tr_total_hablur_kg = 0;
                                            $tot_tr_total_gula_ptr = 0;
                                            $tot_tr_total_tetes_ptr = 0;

                                            $tot_tr_sd_total_ha_ditebang = 0;
                                            $tot_tr_sd_total_qty_ditebang = 0;
                                            $tot_tr_sd_total_ha_digiling = 0;
                                            $tot_tr_sd_total_qty_digiling = 0;
                                            $tot_tr_sd_total_qty_digiling_kg = 0;
                                            $tot_tr_sd_total_hablur = 0;
                                            $tot_tr_sd_total_hablur_kg = 0;
                                            $tot_tr_sd_total_gula_ptr = 0;
                                            $tot_tr_sd_total_tetes_ptr = 0;

                                            ?>
                                            <?php require_once "tr_lokal.php"; ?>
                                            <?php
                                            $tot_tr_total_ha_ditebang += $total_ha_ditebang;
                                            $tot_tr_total_qty_ditebang += $total_qty_ditebang;
                                            $tot_tr_total_ha_digiling += $total_ha_digiling;
                                            $tot_tr_total_qty_digiling += $total_qty_digiling;
                                            $tot_tr_total_qty_digiling_kg += $total_qty_digiling_kg;
                                            $tot_tr_total_hablur += $total_hablur;
                                            $tot_tr_total_hablur_kg += $total_hablur_kg;
                                            $tot_tr_total_gula_ptr += $total_gula_ptr;
                                            $tot_tr_total_tetes_ptr += $total_tetes_ptr;

                                            $tot_tr_sd_total_ha_ditebang += $sd_total_ha_ditebang;
                                            $tot_tr_sd_total_qty_ditebang += $sd_total_qty_ditebang;
                                            $tot_tr_sd_total_ha_digiling += $sd_total_ha_digiling;
                                            $tot_tr_sd_total_qty_digiling += $sd_total_qty_digiling;
                                            $tot_tr_sd_total_qty_digiling_kg += $sd_total_qty_digiling_kg;
                                            $tot_tr_sd_total_hablur += $sd_total_hablur;
                                            $tot_tr_sd_total_hablur_kg += $sd_total_hablur_kg;
                                            $tot_tr_sd_total_gula_ptr += $sd_total_gula_ptr;
                                            $tot_tr_sd_total_tetes_ptr += $sd_total_tetes_ptr;

                                            ?>
                                            <?php
                                            $all_total_ha_ditebang += $total_ha_ditebang;
                                            $all_total_qty_ditebang += $total_qty_ditebang;
                                            $all_total_ha_digiling += $total_ha_digiling;
                                            $all_total_qty_digiling += $total_qty_digiling;
                                            $all_total_qty_digiling_kg += $total_qty_digiling_kg;
                                            $all_total_hablur += $total_hablur;
                                            $all_total_hablur_kg += $total_hablur_kg;
                                            $all_total_gula_ptr += $total_gula_ptr;
                                            $all_total_tetes_ptr += $total_tetes_ptr;

                                            $all_sd_total_ha_ditebang += $sd_total_ha_ditebang;
                                            $all_sd_total_qty_ditebang += $sd_total_qty_ditebang;
                                            $all_sd_total_ha_digiling += $sd_total_ha_digiling;
                                            $all_sd_total_qty_digiling += $sd_total_qty_digiling;
                                            $all_sd_total_qty_digiling_kg += $sd_total_qty_digiling_kg;
                                            $all_sd_total_hablur += $sd_total_hablur;
                                            $all_sd_total_hablur_kg += $sd_total_hablur_kg;
                                            $all_sd_total_gula_ptr += $sd_total_gula_ptr;
                                            $all_sd_total_tetes_ptr += $sd_total_tetes_ptr;

                                            ?>

                                            <?php require_once "tr_tk.php"; ?>
                                            <?php
                                            $tot_tr_total_ha_ditebang += $total_ha_ditebang;
                                            $tot_tr_total_qty_ditebang += $total_qty_ditebang;
                                            $tot_tr_total_ha_digiling += $total_ha_digiling;
                                            $tot_tr_total_qty_digiling += $total_qty_digiling;
                                            $tot_tr_total_qty_digiling_kg += $total_qty_digiling_kg;
                                            $tot_tr_total_hablur += $total_hablur;
                                            $tot_tr_total_hablur_kg += $total_hablur_kg;
                                            $tot_tr_total_gula_ptr += $total_gula_ptr;
                                            $tot_tr_total_tetes_ptr += $total_tetes_ptr;

                                            $tot_tr_sd_total_ha_ditebang += $sd_total_ha_ditebang;
                                            $tot_tr_sd_total_qty_ditebang += $sd_total_qty_ditebang;
                                            $tot_tr_sd_total_ha_digiling += $sd_total_ha_digiling;
                                            $tot_tr_sd_total_qty_digiling += $sd_total_qty_digiling;
                                            $tot_tr_sd_total_qty_digiling_kg += $sd_total_qty_digiling_kg;
                                            $tot_tr_sd_total_hablur += $sd_total_hablur;
                                            $tot_tr_sd_total_hablur_kg += $sd_total_hablur_kg;
                                            $tot_tr_sd_total_gula_ptr += $sd_total_gula_ptr;
                                            $tot_tr_sd_total_tetes_ptr += $sd_total_tetes_ptr;

                                            ?>
                                            <?php
                                            $all_total_ha_ditebang += $total_ha_ditebang;
                                            $all_total_qty_ditebang += $total_qty_ditebang;
                                            $all_total_ha_digiling += $total_ha_digiling;
                                            $all_total_qty_digiling += $total_qty_digiling;
                                            $all_total_qty_digiling_kg += $total_qty_digiling_kg;
                                            $all_total_hablur += $total_hablur;
                                            $all_total_hablur_kg += $total_hablur_kg;
                                            $all_total_gula_ptr += $total_gula_ptr;
                                            $all_total_tetes_ptr += $total_tetes_ptr;

                                            $all_sd_total_ha_ditebang += $sd_total_ha_ditebang;
                                            $all_sd_total_qty_ditebang += $sd_total_qty_ditebang;
                                            $all_sd_total_ha_digiling += $sd_total_ha_digiling;
                                            $all_sd_total_qty_digiling += $sd_total_qty_digiling;
                                            $all_sd_total_qty_digiling_kg += $sd_total_qty_digiling_kg;
                                            $all_sd_total_hablur += $sd_total_hablur;
                                            $all_sd_total_hablur_kg += $sd_total_hablur_kg;
                                            $all_sd_total_gula_ptr += $sd_total_gula_ptr;
                                            $all_sd_total_tetes_ptr += $sd_total_tetes_ptr;
                                            ?>

                                            <tr style="background-color: #00e765">
                                                <td><strong>JUMLAH TR</strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($tot_tr_total_ha_ditebang, 2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $tot_tr_sd_total_ha_ditebang == 0 ? number_format($tot_tr_total_ha_ditebang, 2) : number_format($all_sd_total_ha_ditebang+$all_total_ha_ditebang, 2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($tot_tr_total_qty_ditebang,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $tot_tr_sd_total_qty_ditebang == 0 ? number_format($tot_tr_total_qty_ditebang, 2) : number_format($tot_tr_sd_total_qty_ditebang+$all_total_qty_ditebang,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($tot_tr_total_ha_digiling,2);?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $tot_tr_sd_total_ha_digiling == 0 ? number_format($tot_tr_total_ha_digiling,2) : number_format($tot_tr_sd_total_ha_digiling+$all_total_ha_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($tot_tr_total_qty_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $tot_tr_sd_total_qty_digiling == 0 ? number_format($tot_tr_total_qty_digiling,2) : number_format($tot_tr_sd_total_qty_digiling+$all_total_qty_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($tot_tr_total_hablur,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $tot_tr_sd_total_hablur == 0 ? number_format($tot_tr_total_hablur,2) : number_format($tot_tr_sd_total_hablur+$all_total_hablur,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo @number_format(($tot_tr_total_hablur_kg/$tot_tr_total_qty_digiling_kg)*100,2,'.',''); ?></strong></td>
                                                <?php $hablur_sd = $tot_tr_sd_total_hablur_kg+$tot_tr_total_hablur_kg; ?>
                                                <?php $digiling_sd = $tot_tr_sd_total_qty_digiling_kg+$tot_tr_total_qty_digiling_kg; ?>
                                                <td style="text-align: right"><strong><?php echo @number_format(($hablur_sd/$digiling_sd)*100,2,'.',''); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_gula_ptr,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $tot_tr_sd_total_gula_ptr == 0 ? number_format($tot_tr_total_gula_ptr, 2) : number_format($tot_tr_sd_total_gula_ptr+$all_total_gula_ptr,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_tetes_ptr,2);?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $tot_tr_sd_total_tetes_ptr == 0 ? number_format($tot_tr_total_tetes_ptr,2) : number_format($tot_tr_sd_total_tetes_ptr+$all_total_tetes_ptr,2);?></strong></td>
                                            </tr>

                                            <tr style="background-color: #00c0ef">
                                                <td><strong>TOTAL KESELURUHAN</strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_ha_ditebang, 2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_ha_ditebang == 0 ? number_format($all_total_ha_ditebang, 2) : number_format($all_sd_total_ha_ditebang+$all_total_ha_ditebang, 2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_qty_ditebang,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_qty_ditebang == 0 ? number_format($all_total_qty_ditebang, 2) : number_format($all_sd_total_qty_ditebang+$all_total_qty_ditebang,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_ha_digiling,2);?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_ha_digiling == 0 ? number_format($all_total_ha_digiling,2) : number_format($all_sd_total_ha_digiling+$all_total_ha_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_qty_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_qty_digiling == 0 ? number_format($all_total_qty_digiling,2) : number_format($all_sd_total_qty_digiling+$all_total_qty_digiling,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_hablur,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_hablur == 0 ? number_format($all_total_hablur,2) : number_format($all_sd_total_hablur+$all_total_hablur,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo @number_format(($all_total_hablur_kg/$all_total_qty_digiling_kg)*100,2,'.',''); ?></strong></td>
                                                <?php $hablur_sd = $all_sd_total_hablur_kg+$all_total_hablur_kg; ?>
                                                <?php $digiling_sd = $all_sd_total_qty_digiling_kg+$all_total_qty_digiling_kg; ?>
                                                <td style="text-align: right"><strong><?php echo @number_format(($hablur_sd/$digiling_sd)*100,2,'.',''); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_gula_ptr,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_gula_ptr == 0 ? number_format($all_total_gula_ptr, 2) : number_format($all_sd_total_gula_ptr+$all_total_gula_ptr,2); ?></strong></td>
                                                <td style="text-align: right"><strong><?php echo number_format($all_total_tetes_ptr,2);?></strong></td>
                                                <td style="text-align: right"><strong><?php echo $all_sd_total_tetes_ptr == 0 ? number_format($all_total_tetes_ptr,2) : number_format($all_sd_total_tetes_ptr+$all_total_tetes_ptr,2);?></strong></td>
                                            </tr>

                                            <tr style="background-color: #104E8B;" class="tableizer-firstrow">

                                                <td style="text-align: center" rowspan="2"></td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                                <td style="text-align: center">HI</td>
                                                <td style="text-align: center">SD</td>
                                            </tr>
                                            <tr style="background-color: #104E8B" class="tableizer-firstrow">
                                                <td style="text-align: center" colspan="2">HA TERTEBANG</td>
                                                <td style="text-align: center" colspan="2">QTY TERTEBANG</td>
                                                <td style="text-align: center" colspan="2">HA TERGILING</td>
                                                <td style="text-align: center" colspan="2">QTY TERGILING</td>
                                                <td style="text-align: center" colspan="2">QTY KRISTAL</td>
                                                <td style="text-align: center" colspan="2">RENDEMEN</td>
                                                <td style="text-align: center" colspan="2">QTY GULA PTR</td>
                                                <td style="text-align: center" colspan="2">QTY TETES PTR</td>
                                            </tr>

                                            </tbody>
                                        </table>


                                        <div style="clear:both"></div>
                                    </div>

                                    <div style="clear:both"></div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class='form-horizontal'>
                                            <div class="col-md-12">
                                                <div class="form-group" >
                                                    <div class="toolbar-line text-center">
                                                        <a target="_blank" href="<?php echo site_url("lapproduksi/exceldwonload?hari_giling=$hari_giling");?>" class="btn btn-success">EXCEL</a>
                                                        <button type="submit" class="btn btn-primary">POSTING</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

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