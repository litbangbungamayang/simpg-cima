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
            LAPORAN TARA LORI<br />
        </td>
    </tr>
</table>
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>No</th>
        <th>No Lori</th>
        <th>Tara</th>
        <th>Tanggal</th><th>Operator</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($rows as $key) {
        ?>
        <tr>
            <td><?php echo $key->id;?></td>
            <td><?php echo $key->nolori;?></td>
            <td><?php echo $key->tara;?></td>
            <td><?php echo $key->taradate;?></td>
            <td><?php echo $key->usertara;?></td>
        </tr>
        <?php
    }
    ?>


    </tbody></table>