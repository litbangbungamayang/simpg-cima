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

        <td align="left"  style="font-size:11px" colspan="4">
            <b><?=CNF_NAMAPERUSAHAAN;?></b><br />
            <?=CNF_PG;?>
            <?=CNF_ALAMAT;?>
        </td>
        <td align="center" style="font-size:13px" colspan="4">
            LAPORAN TIMBANGAN MATERIAL<br />
            <?php echo $tgl1. " sampai " .$tgl2?>
        </td>
    </tr>
</table>
<hr />
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>NO</th>
        <th>NO TIKET</th>
        <th>KODE MATERIAL</th>
        <th>NAMA MATERIAL</th>
        <th>KODE RELASI</th>
        <th>NAMA RELASI</th>
        <th>NO KENDARAAN</th>
        <th>NAMA SUPIR</th>
        <th>JENIS TRANSAKSI</th>
        <th>TIMBANG 1</th>
        <th>TGL TIMBANG 1</th>
        <th>TIMBANG 2</th>
        <th>TGL TIMBANG 2</th>
        <th>NETTO</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $ha = 0;
    $netto = 0;
    $i=0;
    foreach ($transaksi as $trans){
        $netto_trans = 0;
        echo '<tr style="font-weight:bold;background:#9d9d9d;color:white">
        <td colspan="14" align="left"> '.$trans->no_transaksi.' </td>
        </tr>';
        foreach($result as $r){
            if($trans->no_transaksi == $r->no_transaksi){
                echo '<tr>
                <td align="center"> '.($i+1).' </td>
                <td align="center"> '.$r->no_tiket.' </td>
                <td align="center"> '.$r->kode_material.' </td>
                <td align="center"> '.$r->nama_material.' </td>
                <td align="center"> '.$r->kode_relasi.' </td>
                <td align="center"> '.$r->nama_relasi.' </td>
                <td align="center"> '.$r->no_kendaraan.'</td>
                <td align="center"> '.$r->nama_supir.'</td>
                <td align="center"> '.$r->jenis_transaksi.'</td>
                <td align="right"> '.number_format($r->timbang_1, 0).'</td>
                <td align="center"> '.$r->tgl_timbang_1.'</td>
                <td align="right"> '.number_format($r->timbang_2, 0).'</td>
                <td align="center"> '.$r->tgl_timbang_2.'</td>
                <td align="right"> '.number_format($r->netto,0).'</td>
                </tr>';
                $netto += $r->netto;
                $netto_trans += $r->netto;
                $i++;
            }
        }
    ?>
    <tr style="font-weight:bold;background:#00c0ef;color:white">
        <td colspan="13">NETTO <?php echo $trans->no_transaksi; ?></td>
        <td align="right"><?php echo number_format($netto_trans,0);?></td>
    </tr>
    <?php
    }

    ?>

    </tbody>
    <tfoot>
    <tr style="font-weight:bold;background:#3c8dbc;color:white">
        <td colspan="13"> JUMLAH NETTO TOTAL </td>
        <td align="right"><?php echo number_format($netto,0);?></td>
    </tr>
    </tfoot>
</table>
<hr />
<table style="width:100%">
    <tr><td style="width: 60%"><br>
            <br />
            <br />
            <br />
        </td><td style="width: 20%" >&nbsp;</td>
        <td align="center"> <?=CNF_PG.' ,'.SiteHelpers::datereport(date('Y-m-d'));?>
            <br /><br /><br />
            <br /><br />
            <br />
            <br />
            ..........................
            <br />

        </td></tr>
</table>