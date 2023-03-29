<style type="text/css">
    table.tableizer-table {
        border-collapse: collapse;
        font-size: 12px;
        border: 1px solid #CCC;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;

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
    }
</style>
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
    <tbody>
    <tr>

        <td align="left"  style="font-size:11px" colspan="4" >
            <b><?=CNF_NAMAPERUSAHAAN;?></b><br />
            <?=CNF_PG;?>
            <?=CNF_ALAMAT;?>
        </td>
        <td align="center" style="font-size:13px" colspan="4" >
            LAPORAN TARA TRUK<br />
        </td>
    </tr>
</table>
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>No</th>
        <th>No POL</th>
        <th>Supir</th>
        <th>Tanggal</th>
        <th>Zona</th>
        <th>Km Max</th>
        <th>Km Min</th>
        <th>Tara</th>
        <th>Operator</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($rows as $key) {
        ?>
        <tr>
            <td><?php echo $key->id_tara_truk;?></td>
            <td><?php echo $key->no_pol;?></td>
            <td><?php echo $key->nama_supir;?></td>
            <td><?php echo $key->tgl_tara;?></td>
            <td><?php echo $key->kode_jarak;?></td>
            <td><?php echo $key->km_min;?></td>
            <td><?php echo $key->km_max;?></td>
            <td><?php echo $key->tara;?></td>
            <td><?php echo $key->ptgs_timbang;?></td>
        </tr>
        <?php
    }
    ?>


    </tbody></table>