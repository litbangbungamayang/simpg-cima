<html>
<head>
    <style type="text/css">
        table.tableizer-table {
            font-size: 12px;
            border: 1px solid #CCC;
            font-family: Arial;
            width:100%;
            border-collapse: collapse;
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
</head>
<body>

<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
    <tbody>
    <tr>

        <td align="left"  style="font-size:11px;font-family:Arial;">
            <b><?=CNF_NAMAPERUSAHAAN;?></b><br />
            <?=CNF_PG;?>
            <?=CNF_ALAMAT;?>
        </td>
        <td align="center" style="font-size:14px" >
            LAPORAN TIMBANGAN LORI<br />
        </td>
    </tr>
</table>
<hr />
<table style="height: 5px;font-family:Monospace;" border="0" width="20%">
    <tbody>
    <tr>
        <td>No Trainstat</td>
        <td>:</td>
        <td><?php echo @$no_trainstat; ?></td>
    </tr>
    <tr>
        <td>No Loko</td>
        <td>:</td>
        <td><?php echo @$no_loko; ?></td>
    </tr>
    </tbody>
</table>
<br>
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>No</th>
        <th>SPTA</th>
        <th>Kategori</th>
        <th>No Petak</th>
        <th>Kebun</th>
        <th>Nama Petani</th>
        <th>No Lori</th>
        <th>Bruto</th>
        <th>Tara</th>
        <th>Netto</th>
        <th>Tgl Netto</th>
        <th>PTA</th>
        <th>mandor</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($lori)){?>
        <?php $i=1;$totalunit=0;$totallori=0; ?>
        <?php foreach ($lori as $loko_data){ 
            $totallori+=$loko_data->netto;
            $totalunit++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $loko_data->no_spat; ?></td>
                <td><?php echo $loko_data->kepemilikan; ?></td>
                <td><?php echo $loko_data->kode_blok; ?></td>
                <td><?php echo "(".$loko_data->divisi.") ".$loko_data->deskripsi_blok; ?></td>
                <td><?php echo $loko_data->nama_petani; ?></td>
                <td><?php echo $loko_data->no_lori; ?></td>
                <td style="text-align: right;"><?php echo $loko_data->bruto; ?></td>
                <td style="text-align: right;"><?php echo $loko_data->tara; ?></td>
                <td style="text-align: right;"><?php echo $loko_data->netto; ?></td>
                <td><?php echo $loko_data->timb_netto_tgl; ?></td>
                <td><?php echo $loko_data->mandor; ?></td>
                <td><?php echo $loko_data->pta; ?></td>
            </tr>
            <?php $i++;?>
        <?php } ?>
            <tr>
                <td colspan="5">TOTAL </td>
                <td> </td>
                <td ><?php echo $totalunit.' LORI '; ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><?php echo number_format($totallori); ?> KG</td>
                <td colspan="4"></td>
            </tr>
    <?php }  ?>
    
    </tbody>
    <tfoot>


    </tfoot>
</table>
<hr />
<table style="width:100%;font-family: Monospace">
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
</body>
</html>
