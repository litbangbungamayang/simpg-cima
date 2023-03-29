

<tr style="background-color: <?php echo $color;?>">
    <td><?php echo $title_tpl?> </td>
    <td style="text-align: right"><?php echo number_format($tpl_h_ini_ha_ditebang ,3); ?></td>
    <td style="text-align: right"><?php echo number_format($tpl_s_dgn_ha_ditebang ,3); ?></td>
    <td style="text-align: right"><?php echo $tpl_h_ini_qty_ditebang/1000; ?></td>
    <td style="text-align: right"><?php echo $tpl_s_dgn_qty_ditebang/1000; ?></td>
    <td style="text-align: right"><?php echo number_format($tpl_h_ini_ha_digiling,3);?></td>
    <td style="text-align: right"><?php echo number_format($tpl_s_dgn_ha_digiling,3); ?></td>
    <td style="text-align: right"><?php echo $tpl_h_ini_qty_digiling/1000; ?></td>
    <td style="text-align: right"><?php echo $tpl_s_dgn_qty_digiling/1000; ?></td>
    <td style="text-align: right"><?php echo $tpl_h_ini_kristal/1000; ?></td>
    <td style="text-align: right"><?php echo $tpl_s_dgn_kristal/1000; ?></td>
    <td style="text-align: right"><?php echo @number_format(($tpl_h_ini_kristal/$tpl_h_ini_qty_digiling)*100, 2); ?></td>
    <td style="text-align: right"><?php echo @number_format(($tpl_s_dgn_kristal/$tpl_s_dgn_qty_digiling)*100,2); ?></td>
    <td style="text-align: right"><?php echo $tpl_h_ini_gula_ptr/1000; ?></td>
    <td style="text-align: right"><?php echo $tpl_s_dgn_gula_ptr/1000; ?></td>
    <td style="text-align: right"><?php echo $tpl_h_ini_tetes_ptr/1000;?></td>
    <td style="text-align: right"><?php echo $tpl_s_dgn_tetes_ptr/1000;?></td>
</tr>
<?php
$tpl_h_ini_ha_ditebang = 0;
$tpl_h_ini_qty_ditebang = 0;
$tpl_h_ini_ha_digiling = 0;
$tpl_h_ini_qty_digiling = 0;
$tpl_h_ini_kristal = 0;
$tpl_h_ini_gula_ptr = 0;
$tpl_h_ini_tetes_ptr = 0;

$tpl_s_dgn_ha_ditebang = 0;
$tpl_s_dgn_qty_ditebang = 0;
$tpl_s_dgn_ha_digiling= 0;
$tpl_s_dgn_qty_digiling = 0;
$tpl_s_dgn_kristal = 0;
$tpl_s_dgn_gula_ptr = 0;
$tpl_s_dgn_tetes_ptr = 0;
?>