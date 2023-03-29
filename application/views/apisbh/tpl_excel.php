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
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>no_spat</th>
        <th>kode_kat_lahan</th>
        <th>kode_plant</th>
        <th>company_code</th>
        <th>kode_affd</th>
        <th>kode_blok</th>
        <th>tgl_spta</th>
        <th>cetak_spta_tgl</th>
        <th>tebang_pg</th>
        <th>angkut_pg</th>
        <th>jenis_spta</th>
        <th>no_angkutan</th>
        <th>no_transloading</th>
        <th>id_petani</th>
        <th>nama_petani</th>
        <th>deskripsi_blok</th>
        <th>luas_ha</th>
        <th>ha_tertebang</th>
        <th>tgl_tebang</th>
        <th>brix_sel</th>
        <th>ph_sel</th>
        <th>selektor_tgl</th>
        <th>timb_netto_tgl</th>
        <th>tgl_jam_giling</th>
        <th>tgl_giling</th>
        <th>bruto</th>
        <th>tara</th>
        <th>netto_final</th>
        <th>kondisi_tebu</th>
        <th>tgl_periode</th>
        <th>terbakar</th>
        <th>cacahan</th>
        <th>brondolan</th>
        <th>persen_brix_ari</th>
        <th>persen_pol_ari</th>
        <th>ph_ari</th>
        <th>hk</th>
        <th>nilai_nira</th>
        <th>faktor_rendemen</th>
        <th>rendemen_ari</th>
        <th>hablur_ari</th>
        <th>gula_total</th>
        <th>tetes_total</th>
        <th>rendemen_ptr</th>
        <th>gula_ptr</th>
        <th>tetes_ptr</th>
        <th>gula_pg</th>
        <th>tetes_pg</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($result as $r){ ?>
        <tr class="tableizer-firstrow">
            <td><?php echo $r->no_spat; ?></td>
            <td><?php echo $r->kode_kat_lahan; ?></td>
            <td><?php echo $r->kode_plant; ?></td>
            <td><?php echo $r->company_code; ?></td>
            <td><?php echo $r->kode_affd; ?></td>
            <td><?php echo $r->kode_blok; ?></td>
            <td><?php echo $r->tgl_spta; ?></td>
            <td><?php echo $r->cetak_spta_tgl; ?></td>
            <td><?php echo $r->tebang_pg; ?></td>
            <td><?php echo $r->angkut_pg; ?></td>
            <td><?php echo $r->jenis_spta; ?></td>
            <td><?php echo $r->no_angkutan; ?></td>
            <td><?php echo $r->no_transloading; ?></td>
            <td><?php echo $r->id_petani; ?></td>
            <td><?php echo $r->nama_petani; ?></td>
            <td><?php echo $r->deskripsi_blok; ?></td>
            <td><?php echo $r->luas_ha; ?></td>
            <td><?php echo $r->ha_tertebang; ?></td>
            <td><?php echo $r->tgl_tebang; ?></td>
            <td><?php echo $r->brix_sel; ?></td>
            <td><?php echo $r->ph_sel; ?></td>
            <td><?php echo $r->selektor_tgl; ?></td>
            <td><?php echo $r->timb_netto_tgl; ?></td>
            <td><?php echo $r->tgl_jam_giling; ?></td>
            <td><?php echo $r->tgl_giling; ?></td>
            <td><?php echo $r->bruto; ?></td>
            <td><?php echo $r->tara; ?></td>
            <td><?php echo $r->netto_final; ?></td>
            <td><?php echo $r->kondisi_tebu; ?></td>
            <td><?php echo $r->tgl_periode; ?></td>
            <td><?php echo $r->terbakar; ?></td>
            <td><?php echo $r->cacahan; ?></td>
            <td><?php echo $r->brondolan; ?></td>
            <td><?php echo $r->persen_brix_ari; ?></td>
            <td><?php echo $r->persen_pol_ari; ?></td>
            <td><?php echo $r->ph_ari; ?></td>
            <td><?php echo $r->hk; ?></td>
            <td><?php echo $r->nilai_nira; ?></td>
            <td><?php echo $r->faktor_rendemen; ?></td>
            <td><?php echo $r->rendemen_ari; ?></td>
            <td><?php echo $r->hablur_ari; ?></td>
            <td><?php echo $r->gula_total; ?></td>
            <td><?php echo $r->tetes_total; ?></td>
            <td><?php echo $r->rendemen_ptr; ?></td>
            <td><?php echo $r->gula_ptr; ?></td>
            <td><?php echo $r->tetes_ptr; ?></td>
            <td><?php echo $r->gula_pg; ?></td>
            <td><?php echo $r->tetes_pg; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>