<?php
$h_ini_ha_ditebang = 0;
$h_ini_qty_ditebang = 0;
$h_ini_ha_digiling = 0;
$h_ini_qty_digiling = 0;
$h_ini_kristal = 0;
$h_ini_gula_ptr = 0;
$h_ini_tetes_ptr = 0;

$s_dgn_ha_ditebang = 0;
$s_dgn_qty_ditebang = 0;
$s_dgn_ha_digiling = 0;
$s_dgn_qty_digiling = 0;
$s_dgn_kristal = 0;
$s_dgn_gula_ptr = 0;
$s_dgn_tetes_ptr = 0;
?>
<tr>
    <td style="text-align: center;background-color: #00c0ef" colspan="17">TS LOKAL</td>
</tr>
<?php foreach ($kode_kat_ts as $row_kode_kat){?>
    <?php $jenis_lahan_tpl = "TS"; ?>
    <?php if($row_kode_kat->kode_kat_ptp != "TS-TR" && $row_kode_kat->kode_kat_ptp != "TS-SP" && $row_kode_kat->kode_kat_ptp != "TS-ST"){?>
        <?php include "tpl_head.php" ?>
    <?php } ?>
<?php } ?>
<?php include "sum_ts.php";?>
<?php
$tpl_h_ini_ha_ditebang   = $h_ini_ha_ditebang;
$tpl_h_ini_qty_ditebang  = $h_ini_qty_ditebang;
$tpl_h_ini_ha_digiling   = $h_ini_ha_digiling;
$tpl_h_ini_qty_digiling  = $h_ini_qty_digiling;
$tpl_h_ini_kristal       = $h_ini_kristal;
$tpl_h_ini_gula_ptr      = $h_ini_gula_ptr;
$tpl_h_ini_tetes_ptr     = $h_ini_tetes_ptr;

$tpl_s_dgn_ha_ditebang   = $s_dgn_ha_ditebang;
$tpl_s_dgn_qty_ditebang  = $s_dgn_qty_ditebang;
$tpl_s_dgn_ha_digiling   = $s_dgn_ha_digiling;
$tpl_s_dgn_qty_digiling  = $s_dgn_qty_digiling;
$tpl_s_dgn_kristal       = $s_dgn_kristal;
$tpl_s_dgn_gula_ptr      = $s_dgn_gula_ptr;
$tpl_s_dgn_tetes_ptr     = $s_dgn_tetes_ptr;
?>

<?php $title_tpl = "TOTAL TS LOKAL"?>
<?php $color = "#9d9d9d"?>
<?php include "tpl_sum.php";?>

