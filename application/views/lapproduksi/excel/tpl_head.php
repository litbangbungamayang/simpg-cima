<?php
$otv_qty_digiling_hi = 0;
$otv_qty_digiling_sd = 0;
$otv_qty_kristal_hi = 0;
$otv_qty_kristal_sd = 0;
?>


<tr>
    <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
    <!----------------------HI HA TERTEBANG----------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 3); ?></td>
            <?php $hi_nilai = $row_lap_timb->ha_tertebang_selektor;?>
            <?php $h_ini_ha_ditebang = $h_ini_ha_ditebang+$row_lap_timb->ha_tertebang_selektor;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD HA TERTEBANG------------------>
    <?php $status = 0;?>
    <?php $sd_nilai = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php $sd_nilai = $row_lap_sum->sum_ha_tertebang+$hi_nilai;?>
            <?php $s_dgn_ha_ditebang =$s_dgn_ha_ditebang+$sd_nilai;?>
            <td style="text-align: right"><?php echo number_format($sd_nilai, 3); ?></td>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){
        echo "<td style=\"text-align: right\">".number_format($hi_nilai, 3)."</td>";
        $s_dgn_ha_ditebang = $s_dgn_ha_ditebang + $hi_nilai;
    }?>
    <!----------------------HI QTY TERTEBANG----------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo ($row_lap_timb->netto_kg/1000); ?></td>
            <?php $hi_nilai = $row_lap_timb->netto_kg;?>
            <?php $h_ini_qty_ditebang  = $h_ini_qty_ditebang+$row_lap_timb->netto_kg;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD QTY TERTEBANG------------------>
    <?php $status = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php $sd_nilai = $row_lap_sum->sum_qty_tertebang+$hi_nilai;?>
            <?php $s_dgn_qty_ditebang =$s_dgn_qty_ditebang+$sd_nilai;?>
            <td style="text-align: right"><?php echo ($sd_nilai/1000) ; ?></td>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".($hi_nilai/1000)."</td>";
        $s_dgn_qty_ditebang  = $s_dgn_qty_ditebang  + $hi_nilai;
    }?>
    <!-----------------------HI HA TERGILING--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_ari->ha_tertebang_selektor, 3); ?></td>
            <?php $hi_nilai = $row_lap_ari->ha_tertebang_selektor;?>
            <?php $h_ini_ha_digiling = $h_ini_ha_digiling  + $row_lap_ari->ha_tertebang_selektor;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD HA TERGILING------------------------>
    <?php $status = 0;?>
    <?php $sd_nilai = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php $sd_nilai = $row_lap_sum->sum_ha_digiiling+$hi_nilai;?>
            <?php $s_dgn_ha_digiling = $s_dgn_ha_digiling +$sd_nilai;?>
            <td style="text-align: right"><?php echo number_format($sd_nilai, 3); ?></td>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai, 3)."</td>";
        $s_dgn_ha_digiling = $s_dgn_ha_digiling + $hi_nilai;
    }?>
    <!-----------------------HI QTY TERGILING--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo $row_lap_ari->netto_kg/1000; ?></td>
            <?php $hi_nilai = $row_lap_ari->netto_kg;?>
            <?php $otv_qty_digiling_hi = $row_lap_ari->netto_kg;?>
            <?php $h_ini_qty_digiling  = $h_ini_qty_digiling + $row_lap_ari->netto_kg;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD QTY TERGILING------------------------>
    <?php $status = 0;?>
    <?php $sd_nilai = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php $otv_qty_digiling_sd = $row_lap_sum->sum_qty_digiling;?>
            <?php $sd_nilai = $row_lap_sum->sum_qty_digiling+$hi_nilai;?>
            <?php $s_dgn_qty_digiling = $s_dgn_qty_digiling + $sd_nilai;?>
            <td style="text-align: right"><?php echo $sd_nilai/1000; ?></td>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".($hi_nilai/1000)."</td>";
        $s_dgn_qty_digiling = $s_dgn_qty_digiling + $hi_nilai;
    }?>
    <!-----------------------HI QTY KRISTAL--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo ($row_lap_ari->hablur_kg/1000); ?></td>
            <?php $hi_nilai = $row_lap_ari->hablur_kg;?>
            <?php $otv_qty_kristal_hi = $row_lap_ari->hablur_kg;?>
            <?php $h_ini_kristal  = $h_ini_kristal+$row_lap_ari->hablur_kg; ?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD QTY KRISTAL------------------------>
    <?php $status = 0;?>
    <?php $sd_nilai = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php $otv_qty_kristal_sd = $row_lap_sum->sum_qty_kristal; ?>
            <?php $sd_nilai  = $row_lap_sum->sum_qty_kristal+$hi_nilai; ?>
            <?php $s_dgn_kristal  = $s_dgn_kristal+$sd_nilai; ?>
            <td style="text-align: right"><?php echo ($sd_nilai/1000); ?></td>

            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".($hi_nilai/1000)."</td>";
        $s_dgn_kristal  = $s_dgn_kristal  + $hi_nilai;
    }?>
    <!-----------------------HI RENDEMEN--------------------->
    <?php $status = 0;?>
    <?php $hi_nilai = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <?php $hi_nilai = $row_lap_ari->rendemen_total;?>
            <td style="text-align: right"><?php echo $row_lap_ari->rendemen_total; ?></td>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD RENDEMEN------------------------>
    <?php $status = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php if($otv_qty_digiling_sd != 0){?>
                <?php $rend_sd = (($otv_qty_kristal_hi+$otv_qty_kristal_sd)/($otv_qty_digiling_hi+$otv_qty_digiling_sd)*100);?>
                <?php  echo "<td style=\"text-align: right\">".number_format((float)$rend_sd,2,'.','')."</td>"; ?>
                <?php  $status = 1;} ?>
        <?php } ?>
    <?php  } ?>
    <?php if($status == 0){?>
        <?php if($otv_qty_digiling_sd != 0){?>
            <?php $rend_sd = (($otv_qty_kristal_hi+$otv_qty_kristal_sd)/($otv_qty_digiling_hi+$otv_qty_digiling_sd)*100);?>
            <?php  echo "<td style=\"text-align: right\">".number_format((float)$rend_sd,2,'.','')."</td>"; ?>
        <?php  }else{ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; } ?>
    <?php } ?>
    <!-----------------------HI QTY GULA PTR--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo ($row_lap_ari->gula_ptr_kg/1000); ?></td>
            <?php $hi_nilai = $row_lap_ari->gula_ptr_kg;?>
            <?php $h_ini_gula_ptr = $h_ini_gula_ptr + $row_lap_ari->gula_ptr_kg; ?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD QTY GULA PTR------------------------>
    <?php $status = 0;?>
    <?php $sd_nilai = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php $sd_nilai = $row_lap_sum->sum_qty_gula_ptr+$hi_nilai;?>
            <?php $s_dgn_gula_ptr = $s_dgn_gula_ptr + $sd_nilai;?>
            <td style="text-align: right"><?php echo ($sd_nilai/1000); ?></td>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".($hi_nilai/1000)."</td>";
        $s_dgn_gula_ptr = $s_dgn_gula_ptr + $hi_nilai;
    }?>
    <!-----------------------HI QTY TETES PTR--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo ($row_lap_ari->tetes_ptr_kg/1000); ?></td>
            <?php $hi_nilai = $row_lap_ari->tetes_ptr_kg;?>
            <?php $h_ini_tetes_ptr = $h_ini_tetes_ptr + $row_lap_ari->tetes_ptr_kg; ?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0</td>"; }?>
    <!----------------------SD QTY TETES PTR------------------------>
    <?php $status = 0;?>
    <?php $sd_nilai = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <?php $sd_nilai  = $row_lap_sum->sum_qty_tetes_ptr+$hi_nilai; ?>
            <?php $s_dgn_tetes_ptr  = $s_dgn_tetes_ptr + $sd_nilai; ?>
            <td style="text-align: right"><?php echo ($sd_nilai/1000); ?></td>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".($hi_nilai/1000)."</td>";
        $s_dgn_tetes_ptr  = $s_dgn_tetes_ptr+$hi_nilai;
    }?>
</tr>