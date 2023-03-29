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
            LAPORAN DATA TRANSAKSI MATERIAL <br />
            <?php echo $tgl1. " sampai " .$tgl2?>
        </td>
    </tr>
</table>
<hr />
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>NO</th>
        <th>NO TRANSAKSI</th>
        <th>KETERANGAN</th>
        <th>TANGGAL</th>
        <th>JENIS</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $i=0;

    foreach($result as $r){

        echo '<tr>
<td align="center"> '.($i+1).' </td>
<td align="center"> '.$r->no_transaksi.' </td>
<td align="center"> '.$r->keterangan_transaksi.' </td>
<td align="center"> '.$r->date_create.' </td>
<td align="center"> '.$r->jenis_transaksi.' </td>
</tr>';
        $i++;
    }
    ?>

    </tbody>
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