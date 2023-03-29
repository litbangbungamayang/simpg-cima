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

<td align="left"  style="font-size:11px" colspan="10" >
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="7" >
TEMPLATE BAGI HASIL<br />
<?=$title;?> 
</td>
</tr>
</table>
<table class="tableizer-table">
<thead>
			<tr>
			<th>ID SPTA</th>
			<th>ID ARI</th>
			<th>SBH STATUS</th>
			<th>NO SPTA</th>
			<th>KATEGORI</th>
			<th>KODE PLANT</th>
			<th>KODE AFD</th>
			<th>KODE BLOK</th>
			<th>TGL SPTA</th>
			<th>TEBANG PG</th>
			<th>ANGKUT PG</th>
			<th>JENIS SPTA</th>
			<th>NO ANGKUTAN</th>
			<th>PETANI</th>
			<th>SPT STATUS</th>
			<th>NATURA STATUS</th>
			<th>R SPG</th>
			<th>DESKRIPSI BLOK</th>
			<th>LUAS HA</th>
			<th>HA TERTEBANG</th>
			<th>TGL TEBANG</th>
			<th>BRIX SEL</th>
			<th>PH SEL</th>
			<th>DITOLAK SEL</th>
			<th>DITOLAK ALASAN</th>
			<th>CETAK SPTA TGL</th>
			<th>SELEKTOR TGL</th>
			<th>TIMB NETTO TGL</th>
			<th>MEJA TEBU TGL</th>
			<th>ARI TGL</th>
			<th>SBH TGL</th>
			<th>HARI GILING</th>
			<th>TGL GILING</th>
			<th>BRUTO</th>
			<th>TARA</th>
			<th>NETTO</th>
			<th>KONDISI TEBU</th>
			<th>PERSEN BRIX ARI</th>
			<th>PERSEN POL ARI</th>
			<th>PH ARI</th>
			<th>HK</th>
			<th>NILAI NIRA</th>
			<th>FR</th>
			<th>REND ARI</th>
			<th>HABLUR ARI</th>
			<th>GULA TOTAL</th>
			<th>TETES TOTAL</th>
			<th>GULA PTR SBH</th>
			<th>GULA PTR PER KG TEBU</th>
			<th>KOPENSASI GULA</th>
			<th>GULA PTR 100%</th>
			<th>GULA PTR 10%</th>
			<th>GULA PTR 90%</th>
			<th>TETES PTR</th>
			<th>GULA PG INC GS</th>
			<th>TETES PG</th>

			  </tr>
        </thead>
<tbody>
<?php

foreach ($rows as $key) {
	$i = 0;
	echo '<tr>';
	echo '<td>'.$key->id.'</td>';
	echo '<td>'.$key->id_ari.'</td>';
	echo '<td>'.$key->sbh_status.'</td>';
	echo '<td>'.$key->no_spat.'</td>';
	echo '<td>'.$key->kode_kat_lahan.'</td>';
	echo '<td>'.$key->kode_plant.'</td>';
	echo '<td>'.$key->kode_affd.'</td>';
	echo '<td>'.$key->kode_blok.'</td>';
	echo '<td>'.$key->tgl_spta.'</td>';
	echo '<td>'.$key->tebang_pg.'</td>';
	echo '<td>'.$key->angkut_pg.'</td>';
	echo '<td>'.$key->jenis_spta.'</td>';
	echo '<td>'.$key->no_angkutan.'</td>';
	echo '<td>'.$key->nama_petani.'</td>';
	echo '<td>'.$key->spt_status.'</td>';
	echo '<td>'.$key->natura_status.'</td>';
	echo '<td>'.$key->r_spg.'</td>';
	echo '<td>'.$key->deskripsi_blok.'</td>';
	echo '<td>'.$key->luas_ha.'</td>';
	echo '<td>'.$key->ha_tertebang.'</td>';
	echo '<td>'.$key->tgl_tebang.'</td>';
	echo '<td>'.$key->brix_sel.'</td>';
	echo '<td>'.$key->ph_sel.'</td>';
	echo '<td>'.$key->ditolak_sel.'</td>';
	echo '<td>'.$key->ditolak_alasan.'</td>';
	echo '<td>'.$key->cetak_spta_tgl.'</td>';
	echo '<td>'.$key->selektor_tgl.'</td>';
	echo '<td>'.$key->timb_netto_tgl.'</td>';
	echo '<td>'.$key->meja_tebu_tgl.'</td>';
	echo '<td>'.$key->ari_tgl.'</td>';
	echo '<td>'.$key->sbh_tgl.'</td>';
	echo '<td>'.$key->hari_giling.'</td>';
	echo '<td>'.$key->tgl_giling.'</td>';
	echo '<td>'.$key->bruto.'</td>';
	echo '<td>'.$key->tara.'</td>';
	echo '<td>'.$key->netto_final.'</td>';
	echo '<td>'.$key->kondisi_tebu.'</td>';
	echo '<td bgcolor="yellow">'.$key->persen_brix_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->persen_pol_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->ph_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->hk.'</td>';
	echo '<td bgcolor="yellow">'.$key->nilai_nira.'</td>';
	echo '<td bgcolor="yellow">'.$key->faktor_rendemen.'</td>';
	echo '<td bgcolor="yellow">'.$key->rendemen_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->hablur_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->gula_total.'</td>';
	echo '<td bgcolor="yellow">'.$key->tetes_total.'</td>';
	echo '<td bgcolor="yellow">'.$key->rendemen_ptr.'</td>';
	echo '<td bgcolor="yellow">'.$key->r_spg.'</td>';
	echo '<td bgcolor="yellow">'.$key->kopensasi_gula.'</td>';
	echo '<td bgcolor="yellow">'.$key->gula_ptr.'</td>';
	echo '<td bgcolor="yellow">'.$key->sepuluh_persen.'</td>';
	echo '<td bgcolor="yellow">'.$key->sembilanpuluh_persen.'</td>';
	echo '<td bgcolor="yellow">'.$key->tetes_ptr.'</td>';
	echo '<td bgcolor="yellow">'.$key->gula_pg.'</td>';
	echo '<td bgcolor="yellow">'.$key->tetes_pg.'</td>';
	echo '</tr>';
	
}
?>
 
 
</tbody></table>