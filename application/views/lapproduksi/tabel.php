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
/**------------------------------TS------------------*/
$all_hi_ts_ha_ditebang = 0;
$all_hi_ts_qty_ditebang = 0;
$all_hi_ts_ha_digiling = 0;
$all_hi_ts_qty_digiling = 0;
$all_hi_ts_kristal = 0;
$all_hi_ts_gula_ptr = 0;
$all_hi_ts_tetes_ptr = 0;

$all_sd_ts_ha_ditebang = 0;
$all_sd_ts_qty_ditebang = 0;
$all_sd_ts_ha_digiling = 0;
$all_sd_ts_qty_digiling = 0;
$all_sd_ts_kristal = 0;
$all_sd_ts_gula_ptr = 0;
$all_sd_ts_tetes_ptr = 0;
/**------------------------------TS------------------*/

/**------------------------------TR------------------*/
$all_hi_tr_ha_ditebang = 0;
$all_hi_tr_qty_ditebang = 0;
$all_hi_tr_ha_digiling = 0;
$all_hi_tr_qty_digiling = 0;
$all_hi_tr_kristal = 0;
$all_hi_tr_gula_ptr = 0;
$all_hi_tr_tetes_ptr = 0;

$all_sd_tr_ha_ditebang = 0;
$all_sd_tr_qty_ditebang = 0;
$all_sd_tr_ha_digiling = 0;
$all_sd_tr_qty_digiling = 0;
$all_sd_tr_kristal = 0;
$all_sd_tr_gula_ptr = 0;
$all_sd_tr_tetes_ptr = 0;
/**------------------------------TR------------------*/


function replaceKat($kat){
    $result = str_replace(" ", "_", $kat);
    $output = str_replace("-", "_", $result);
    return $output;
}
?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Produksi Tanggal Giling ke <?php echo $hari_giling;?> </h3>
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
                                        <input type="hidden" name="tgl_giling" value="<?php echo $hari_giling; ?>">


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

                                            <?php include "tpl_master/ts_lokal.php"; ?>
                                            <?php include "tpl_master/ts_saudara.php"; ?>
                                            <?php include "tpl_master/ts_spt.php"; ?>

                                            <?php
                                            $tpl_h_ini_ha_ditebang   = $all_hi_ts_ha_ditebang;
                                            $tpl_h_ini_qty_ditebang  = $all_hi_ts_qty_ditebang;
                                            $tpl_h_ini_ha_digiling   = $all_hi_ts_ha_digiling;
                                            $tpl_h_ini_qty_digiling  = $all_hi_ts_qty_digiling;
                                            $tpl_h_ini_kristal       = $all_hi_ts_kristal;
                                            $tpl_h_ini_gula_ptr      = $all_hi_ts_gula_ptr;
                                            $tpl_h_ini_tetes_ptr     = $all_hi_ts_tetes_ptr;

                                            $tpl_s_dgn_ha_ditebang   = $all_sd_ts_ha_ditebang;
                                            $tpl_s_dgn_qty_ditebang  = $all_sd_ts_qty_ditebang;
                                            $tpl_s_dgn_ha_digiling   = $all_sd_ts_ha_digiling;
                                            $tpl_s_dgn_qty_digiling  = $all_sd_ts_qty_digiling;
                                            $tpl_s_dgn_kristal       = $all_sd_ts_kristal;
                                            $tpl_s_dgn_gula_ptr      = $all_sd_ts_gula_ptr;
                                            $tpl_s_dgn_tetes_ptr     = $all_sd_ts_tetes_ptr;
                                            ?>

                                            <?php $title_tpl = "TOTAL ALL TS"?>
                                            <?php $color = "#00e765"?>
                                            <?php include "tpl_master/tpl_sum.php";?>

                                            <!-------------------------------BATAS TS----------------------->

                                            <?php include "tpl_master/tr_lokal.php"; ?>
                                            <?php include "tpl_master/tr_saudara.php"; ?>

                                            <?php
                                            $tpl_h_ini_ha_ditebang   = $all_hi_tr_ha_ditebang;
                                            $tpl_h_ini_qty_ditebang  = $all_hi_tr_qty_ditebang;
                                            $tpl_h_ini_ha_digiling   = $all_hi_tr_ha_digiling;
                                            $tpl_h_ini_qty_digiling  = $all_hi_tr_qty_digiling;
                                            $tpl_h_ini_kristal       = $all_hi_tr_kristal;
                                            $tpl_h_ini_gula_ptr      = $all_hi_tr_gula_ptr;
                                            $tpl_h_ini_tetes_ptr     = $all_hi_tr_tetes_ptr;

                                            $tpl_s_dgn_ha_ditebang   = $all_sd_tr_ha_ditebang;
                                            $tpl_s_dgn_qty_ditebang  = $all_sd_tr_qty_ditebang;
                                            $tpl_s_dgn_ha_digiling   = $all_sd_tr_ha_digiling;
                                            $tpl_s_dgn_qty_digiling  = $all_sd_tr_qty_digiling;
                                            $tpl_s_dgn_kristal       = $all_sd_tr_kristal;
                                            $tpl_s_dgn_gula_ptr      = $all_sd_tr_gula_ptr;
                                            $tpl_s_dgn_tetes_ptr     = $all_sd_tr_tetes_ptr;
                                            ?>

                                            <?php $title_tpl = "TOTAL ALL TR"?>
                                            <?php $color = "#00e765"?>
                                            <?php include "tpl_master/tpl_sum.php";?>


                                            <?php
                                            $tpl_h_ini_ha_ditebang   += $all_hi_ts_ha_ditebang;
                                            $tpl_h_ini_qty_ditebang  += $all_hi_ts_qty_ditebang;
                                            $tpl_h_ini_ha_digiling   += $all_hi_ts_ha_digiling;
                                            $tpl_h_ini_qty_digiling  += $all_hi_ts_qty_digiling;
                                            $tpl_h_ini_kristal       += $all_hi_ts_kristal;
                                            $tpl_h_ini_gula_ptr      += $all_hi_ts_gula_ptr;
                                            $tpl_h_ini_tetes_ptr     += $all_hi_ts_tetes_ptr;

                                            $tpl_s_dgn_ha_ditebang   += $all_sd_ts_ha_ditebang;
                                            $tpl_s_dgn_qty_ditebang  += $all_sd_ts_qty_ditebang;
                                            $tpl_s_dgn_ha_digiling   += $all_sd_ts_ha_digiling;
                                            $tpl_s_dgn_qty_digiling  += $all_sd_ts_qty_digiling;
                                            $tpl_s_dgn_kristal       += $all_sd_ts_kristal;
                                            $tpl_s_dgn_gula_ptr      += $all_sd_ts_gula_ptr;
                                            $tpl_s_dgn_tetes_ptr     += $all_sd_ts_tetes_ptr;

                                            $tpl_h_ini_ha_ditebang   += $all_hi_tr_ha_ditebang;
                                            $tpl_h_ini_qty_ditebang  += $all_hi_tr_qty_ditebang;
                                            $tpl_h_ini_ha_digiling   += $all_hi_tr_ha_digiling;
                                            $tpl_h_ini_qty_digiling  += $all_hi_tr_qty_digiling;
                                            $tpl_h_ini_kristal       += $all_hi_tr_kristal;
                                            $tpl_h_ini_gula_ptr      += $all_hi_tr_gula_ptr;
                                            $tpl_h_ini_tetes_ptr     += $all_hi_tr_tetes_ptr;

                                            $tpl_s_dgn_ha_ditebang   += $all_sd_tr_ha_ditebang;
                                            $tpl_s_dgn_qty_ditebang  += $all_sd_tr_qty_ditebang;
                                            $tpl_s_dgn_ha_digiling   += $all_sd_tr_ha_digiling;
                                            $tpl_s_dgn_qty_digiling  += $all_sd_tr_qty_digiling;
                                            $tpl_s_dgn_kristal       += $all_sd_tr_kristal;
                                            $tpl_s_dgn_gula_ptr      += $all_sd_tr_gula_ptr;
                                            $tpl_s_dgn_tetes_ptr     += $all_sd_tr_tetes_ptr;
                                            ?>

                                            <?php $title_tpl = "JUMLAH TOTAL"?>
                                            <?php $color = "#ABC6DD"?>
                                            <?php include "tpl_master/tpl_sum.php";?>



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