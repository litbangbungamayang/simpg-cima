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
    }
</style>
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
    <tbody>
    <tr>

        <td align="left"  style="font-size:11px">
            <b><?=CNF_NAMAPERUSAHAAN;?></b><br />
            <?=CNF_PG;?>
            <?=CNF_ALAMAT;?>
        </td>
        <td colspan="5">&nbsp;</td>
        <td align="center" style="font-size:13px" >
            LAPORAN HASIL PRODUSKI PETAK<br />
            <i>Didownload Tanggal <?php echo date('Y-m-d H:i:s');?></i>
        </td>
    </tr>
</table>
<hr />
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>AFDELING</th>
        <th>KATEGORI</th>
        <th>KODE PETAK</th>
        <th>DESKRIPSI</th>
        <th>SISA</th>
        <th>TOTAL POKOK</th>
        <th>TOTAL TEBANG (Kg)</th>
        <th>Luas Pokok (Ha)</th>
        <th>Luas Tebang (Ha)</th>
        <th>Aff Tebang</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $tottebang = 0;
    $luasha = 0;
    $luastebang = 0;

    $tottebang1 = 0;
    $luasha1 = 0;
    $luastebang1 = 0;
    $no=1;
    $divisi ='';
    foreach($result as $r){
        

        if($no!=1 && $divisi !=$r->divisi ){
            ?>
        <tr style="font-size: 12px;color:red;font-weight: bold">
        <td colspan="6">TOTAL AFDELING <?php echo $divisi;?></td>
        <td align="right"><?php echo number_format($tottebang,0);?></td>
        <td align="right"><?php echo number_format($luasha,3);?></td>
        <td align="right"><?php echo number_format($luastebang,3);?></td>
        <td >-</td>
        </tr>
            <?
           // $divisi =$r->divisi;
            $tottebang = 0;
            $luasha = 0;
            $luastebang = 0;
        }

        if($divisi != $r->divisi){
        echo '<tr><td colspan="9" ><b> PETAK '.$r->divisi.'</b></td></tr>';
        $divisi = $r->divisi;
     }

        echo '<tr ><td> '.$r->divisi.
            ' </td><td> '.$r->kepemilikan.
            ' </td><td> '.$r->kode_blok.
            ' </td><td> '.$r->deskripsi_blok.
            ' </td><td align="right"> '.$r->sisa.
            ' </td><td align="right"> '.$r->total_pokok.
            ' </td><td align="right"> '.number_format($r->total_tebang,0).
            ' </td><td align="right"> '.$r->luas_ha.
            ' </td><td align="right"> '.$r->luas_tebang.
            ' </td><td align="right"> '.$r->aff_tebang.' </td></tr>';
        $tottebang += $r->total_tebang;
        $luasha += $r->luas_ha;
        $luastebang += $r->luas_tebang;

        $tottebang1 += $r->total_tebang;
        $luasha1 += $r->luas_ha;
        $luastebang1 += $r->luas_tebang;
        
        $no++;
    }
    ?>
    </tbody>
    <tr style="font-size: 12px;color:red;font-weight: bold">
        <td colspan="6">TOTAL AFDELING <?php echo $divisi;?></td>
        <td align="right"><?php echo number_format($tottebang,0);?></td>
        <td align="right"><?php echo number_format($luasha,3);?></td>
        <td align="right"><?php echo number_format($luastebang,3);?></td>
        <td >-</td>
        </tr>
        <tr style="font-size: 14px;font-weight: bold">
        <td colspan="6">TOTAL SEMUA</td>
        <td align="right"><?php echo number_format($tottebang1,0);?></td>
        <td align="right"><?php echo number_format($luasha1,3);?></td>
        <td align="right"><?php echo number_format($luastebang1,3);?></td>
        <td >-</td>
        </tr>
</table>
<hr />
