<div id="content" style="overflow-x:scroll;"><style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

tbody td,tbody th {
    border: 1px solid #eee;
    text-align: left;
    padding: 2px;
    font-size: 10px;
    white-space: nowrap;
}

thead td,thead th {
    text-align: left;
    padding: 2px;
    font-size: 10px;
    white-space: nowrap;
}

tfoot td,tfoot th {
    text-align: left;
    padding: 2px;
    font-size: 10px;
    white-space: nowrap;
}
.btn-cetak{
    position: fixed;
    width: 50px;
    height: 50px;
    border-radius: 50px;
    margin-top: -13px;
    right: 160px;
    top: 18px;
}
.btn-excel{
    position: fixed;
    width: 50px;
    height: 50px;
    border-radius: 50px;
    margin-top: -13px;
    right: 100px;
    top: 18px;
}


</style>
<table>
	<thead>
       <tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td colspan="9" style="text-align:center;font-weight:bold;">LAPORAN  EVALUASI GILING <?php echo CNF_TAHUNGILING;?></td>
</tr>
<tr>
<td colspan="2">PERIODE  :</td>
<td colspan="6"><?php echo date("d/m/Y", strtotime($evaluasi[0]->PERIODE)); ?></td>
</tr>
<tr>
<td colspan="2">PG              :</td>
<td colspan="6"><?php echo $unit[0]->namapg; ?></td>
</tr>
    </thead>
   <tbody>
   
<tr>
<td style="text-align: center;">NO.</td>
<td style="text-align: center;">URAIAN</td>
<td style="text-align: center;"colspan="2">TAHUN INI</td>
<td style="text-align: center;">TAHUN LALU S/D PER INI</td>
<td style="text-align: center;">RKO / SASARAN</td>
<td style="text-align: center;">RKAP </td>
<td style="text-align: center;"colspan="2">PROSENTASE</td>
</tr>
<tr>
<td style="text-align: center;"></td>
<td style="text-align: center;"></td>
<td style="text-align: center;">PER INI</td>
<td style="text-align: center;">S/D PER INI</td>
<td style="text-align: center;"></td>
<td style="text-align: center;"></td>
<td style="text-align: center;"></td>
<td style="text-align: center;">RKO/ SASARAN</td>
<td style="text-align: center;">RKAP</td>
</tr>
<tr>
<td colspan="8">I. TANAMAN</td>
</tr>
<tr>
<td>1</td>
<td>Luas Ha</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Tebu Sendiri</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_LUAS_HA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_LUAS_HA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_LUAS_HA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_LUAS_HA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_LUAS_HA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_LUAS_HA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_LUAS_HA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Tebu Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_LUAS_HA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_LUAS_HA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_LUAS_HA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_LUAS_HA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_LUAS_HA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_LUAS_HA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_LUAS_HA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_LUAS_HA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_LUAS_HA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_LUAS_HA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_LUAS_HA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_LUAS_HA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_LUAS_HA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_LUAS_HA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>Tebu digiling (Ton)</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Tebu Sendiri</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_TEBU_DIGILING_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_TEBU_DIGILING_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_TEBU_DIGILING_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_TEBU_DIGILING_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_TEBU_DIGILING_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_TEBU_DIGILING_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_TEBU_DIGILING_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Tebu Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_TEBU_DIGILING_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_TEBU_DIGILING_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_TEBU_DIGILING_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_TEBU_DIGILING_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_TEBU_DIGILING_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_TEBU_DIGILING_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_TEBU_DIGILING_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_TEBU_DIGILING_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_TEBU_DIGILING_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_TEBU_DIGILING_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_TEBU_DIGILING_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_TEBU_DIGILING_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_TEBU_DIGILING_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_TEBU_DIGILING_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>Hablur Hasil(Ton)</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Tebu Sendiri</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR_HASILTON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR_HASILTON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR_HASILTON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR_HASILTON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR_HASILTON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR_HASILTON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR_HASILTON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Tebu Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR_HASILTON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR_HASILTON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR_HASILTON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR_HASILTON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR_HASILTON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR_HASILTON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR_HASILTON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_HASILTON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_HASILTON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_HASILTON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_HASILTON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_HASILTON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_HASILTON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_HASILTON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Rendemen</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Tebu Sendiri</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_RENDEMEN_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_RENDEMEN_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_RENDEMEN_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_RENDEMEN_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_RENDEMEN_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_RENDEMEN_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_RENDEMEN_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Tebu Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_RENDEMEN_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_RENDEMEN_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_RENDEMEN_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_RENDEMEN_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_RENDEMEN_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_RENDEMEN_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_RENDEMEN_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_RENDEMEN_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_RENDEMEN_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_RENDEMEN_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_RENDEMEN_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_RENDEMEN_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_RENDEMEN_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_RENDEMEN_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>Produktivitas (Ton Tebu/Ha)</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Tebu Sendiri</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Tebu Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKTIVITAS_TON_TEBUHA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKTIVITAS_TON_TEBUHA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>6</td>
<td>Hablur / Ha (Ton/Ha)</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Tebu Sendiri</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR__HA_TONHA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR__HA_TONHA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR__HA_TONHA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR__HA_TONHA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR__HA_TONHA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR__HA_TONHA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_SENDIRI_HABLUR__HA_TONHA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Tebu Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR__HA_TONHA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR__HA_TONHA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR__HA_TONHA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR__HA_TONHA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR__HA_TONHA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR__HA_TONHA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_PETANI_HABLUR__HA_TONHA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR__HA_TONHA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR__HA_TONHA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR__HA_TONHA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR__HA_TONHA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR__HA_TONHA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR__HA_TONHA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR__HA_TONHA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>7</td>
<td>Hablur Milik (Ton)</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Milik PG</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_HABLUR_MILIK_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_HABLUR_MILIK_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_HABLUR_MILIK_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_HABLUR_MILIK_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_HABLUR_MILIK_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PG_HABLUR_MILIK_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PG_HABLUR_MILIK_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Milik Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_HABLUR_MILIK_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_HABLUR_MILIK_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_HABLUR_MILIK_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_HABLUR_MILIK_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_HABLUR_MILIK_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_HABLUR_MILIK_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_HABLUR_MILIK_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_MILIK_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_MILIK_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_MILIK_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_MILIK_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_MILIK_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_MILIK_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_HABLUR_MILIK_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>8</td>
<td>Gula Milik</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Milik PG</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_GULA_MILIK_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_GULA_MILIK_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_GULA_MILIK_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_GULA_MILIK_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_GULA_MILIK_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PG_GULA_MILIK_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PG_GULA_MILIK_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Milik Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_GULA_MILIK_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_GULA_MILIK_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_GULA_MILIK_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_GULA_MILIK_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_GULA_MILIK_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_GULA_MILIK_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_GULA_MILIK_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_GULA_MILIK_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_GULA_MILIK_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_GULA_MILIK_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_GULA_MILIK_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_GULA_MILIK_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_GULA_MILIK_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_GULA_MILIK_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>9</td>
<td>Produksi tetes (ton)</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td>- Milik PG</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_PRODUKSI_TETES_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_PRODUKSI_TETES_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_PRODUKSI_TETES_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_PRODUKSI_TETES_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PG_PRODUKSI_TETES_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PG_PRODUKSI_TETES_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PG_PRODUKSI_TETES_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Milik Petani</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_PRODUKSI_TETES_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_PRODUKSI_TETES_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_PRODUKSI_TETES_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_PRODUKSI_TETES_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_PRODUKSI_TETES_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_PRODUKSI_TETES_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MILIK_PETANI_PRODUKSI_TETES_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td></td>
<td>- Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKSI_TETES_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKSI_TETES_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKSI_TETES_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKSI_TETES_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKSI_TETES_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKSI_TETES_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_PRODUKSI_TETES_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>10</td>
<td>% pol tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_POL_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_POL_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_POL_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_POL_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_POL_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_POL_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_POL_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>11</td>
<td>% brix tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>12</td>
<td>Nilai Nira</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NILAI_NIRA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NILAI_NIRA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NILAI_NIRA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NILAI_NIRA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NILAI_NIRA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->NILAI_NIRA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->NILAI_NIRA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>13</td>
<td>Kadar Nira Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KADAR_NIRA_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KADAR_NIRA_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KADAR_NIRA_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KADAR_NIRA_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KADAR_NIRA_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KADAR_NIRA_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KADAR_NIRA_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">II GILINGAN</td>
</tr>
<tr>
<td>1</td>
<td>KecGiling Excl (Ton)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_EXCL_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_EXCL_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_EXCL_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_EXCL_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_EXCL_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KECGILING_EXCL_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KECGILING_EXCL_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>KecGiling Incl Tanpa Hari Raya (Ton)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_TANPA_HARI_RAYA_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_TANPA_HARI_RAYA_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_TANPA_HARI_RAYA_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_TANPA_HARI_RAYA_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_TANPA_HARI_RAYA_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_TANPA_HARI_RAYA_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_TANPA_HARI_RAYA_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>KecGiling Incl Hari Raya (Ton)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_HARI_RAYA_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_HARI_RAYA_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_HARI_RAYA_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_HARI_RAYA_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_HARI_RAYA_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_HARI_RAYA_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KECGILING_INCL_HARI_RAYA_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>% Jam Berhenti A tanpa Hari Raya (Luar)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>% Jam Berhenti A dengan Hari Raya (Luar)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>6</td>
<td>% Jam Berhenti B(Dalam)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_BDALAM_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_BDALAM_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_BDALAM_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_BDALAM_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_BDALAM_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_BDALAM_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_JAM_BERHENTI_BDALAM_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>7</td>
<td>Jam Berhenti % Jam Giling</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JAM_BERHENTI_PERSEN_JAM_GILING_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JAM_BERHENTI_PERSEN_JAM_GILING_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JAM_BERHENTI_PERSEN_JAM_GILING_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JAM_BERHENTI_PERSEN_JAM_GILING_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JAM_BERHENTI_PERSEN_JAM_GILING_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JAM_BERHENTI_PERSEN_JAM_GILING_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JAM_BERHENTI_PERSEN_JAM_GILING_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>8</td>
<td>Nira mentah % tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_MENTAH_PERSEN_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_MENTAH_PERSEN_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_MENTAH_PERSEN_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_MENTAH_PERSEN_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_MENTAH_PERSEN_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->NIRA_MENTAH_PERSEN_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->NIRA_MENTAH_PERSEN_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>9</td>
<td>Imbibisi % Sabut</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->IMBIBISI_PERSEN_SABUT_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->IMBIBISI_PERSEN_SABUT_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->IMBIBISI_PERSEN_SABUT_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->IMBIBISI_PERSEN_SABUT_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->IMBIBISI_PERSEN_SABUT_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->IMBIBISI_PERSEN_SABUT_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->IMBIBISI_PERSEN_SABUT_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>10</td>
<td>HPB I</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_I_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_I_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_I_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_I_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_I_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPB_I_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPB_I_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>11</td>
<td>HPB Total</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_TOTAL_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_TOTAL_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_TOTAL_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_TOTAL_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPB_TOTAL_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPB_TOTAL_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPB_TOTAL_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>12</td>
<td>HPG</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>13</td>
<td>HPG 125</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_125_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_125_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_125_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_125_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HPG_125_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPG_125_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HPG_125_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>14</td>
<td>Pol Ampas</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_AMPAS_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_AMPAS_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_AMPAS_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_AMPAS_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_AMPAS_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_AMPAS_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_AMPAS_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>15</td>
<td>% Bahan Kering Ampas</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BAHAN_KERING_AMPAS_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BAHAN_KERING_AMPAS_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BAHAN_KERING_AMPAS_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BAHAN_KERING_AMPAS_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BAHAN_KERING_AMPAS_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BAHAN_KERING_AMPAS_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BAHAN_KERING_AMPAS_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>16</td>
<td>Sabut % tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->SABUT_PERSEN_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->SABUT_PERSEN_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->SABUT_PERSEN_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->SABUT_PERSEN_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->SABUT_PERSEN_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->SABUT_PERSEN_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->SABUT_PERSEN_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>17</td>
<td>PSHK</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PSHK_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PSHK_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PSHK_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PSHK_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PSHK_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PSHK_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PSHK_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>18</td>
<td>Nira Asli Hilang % Sabut</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_ASLI_HILANG_PERSEN_SABUT_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_ASLI_HILANG_PERSEN_SABUT_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_ASLI_HILANG_PERSEN_SABUT_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_ASLI_HILANG_PERSEN_SABUT_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->NIRA_ASLI_HILANG_PERSEN_SABUT_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->NIRA_ASLI_HILANG_PERSEN_SABUT_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->NIRA_ASLI_HILANG_PERSEN_SABUT_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>19</td>
<td>Efisiensi Gilingan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFISIENSI_GILINGAN_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFISIENSI_GILINGAN_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFISIENSI_GILINGAN_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFISIENSI_GILINGAN_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFISIENSI_GILINGAN_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->EFISIENSI_GILINGAN_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->EFISIENSI_GILINGAN_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">III PENGOLAHAN</td>
</tr>
<tr>
<td>1</td>
<td>Pol Blotong</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_BLOTONG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_BLOTONG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_BLOTONG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_BLOTONG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_BLOTONG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_BLOTONG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_BLOTONG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>Pengasingan Bukan Gula</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PENGASINGAN_BUKAN_GULA_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PENGASINGAN_BUKAN_GULA_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PENGASINGAN_BUKAN_GULA_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PENGASINGAN_BUKAN_GULA_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PENGASINGAN_BUKAN_GULA_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PENGASINGAN_BUKAN_GULA_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PENGASINGAN_BUKAN_GULA_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>Kg Air Diuapkan/m2 LP/JBp</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_AIR_DIUAPKANM2_LPJBP_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_AIR_DIUAPKANM2_LPJBP_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_AIR_DIUAPKANM2_LPJBP_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_AIR_DIUAPKANM2_LPJBP_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_AIR_DIUAPKANM2_LPJBP_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KG_AIR_DIUAPKANM2_LPJBP_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KG_AIR_DIUAPKANM2_LPJBP_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Kehilangan Pol % Pol NM</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHILANGAN_POL_PERSEN_POL_NM_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHILANGAN_POL_PERSEN_POL_NM_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHILANGAN_POL_PERSEN_POL_NM_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHILANGAN_POL_PERSEN_POL_NM_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHILANGAN_POL_PERSEN_POL_NM_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KEHILANGAN_POL_PERSEN_POL_NM_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KEHILANGAN_POL_PERSEN_POL_NM_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>Winter Rendemen</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->WINTER_RENDEMEN_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->WINTER_RENDEMEN_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->WINTER_RENDEMEN_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->WINTER_RENDEMEN_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->WINTER_RENDEMEN_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->WINTER_RENDEMEN_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->WINTER_RENDEMEN_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>6</td>
<td>BHR </td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BHR__INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BHR__SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BHR__THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BHR__RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BHR__RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->BHR__RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->BHR__RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>7</td>
<td>Pol Hasil % Pol Nira Mentah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HASIL_PERSEN_POL_NIRA_MENTAH_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HASIL_PERSEN_POL_NIRA_MENTAH_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HASIL_PERSEN_POL_NIRA_MENTAH_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>8</td>
<td>Pol Hilang dalam ampas</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_AMPAS_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_AMPAS_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_AMPAS_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_AMPAS_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_AMPAS_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_AMPAS_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_AMPAS_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>9</td>
<td>Pol Hilang dalam blotong</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_BLOTONG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_BLOTONG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_BLOTONG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_BLOTONG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_BLOTONG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_BLOTONG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_BLOTONG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>10</td>
<td>Pol Hilang dalam tetes</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_TETES_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_TETES_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_TETES_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_TETES_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_TETES_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_TETES_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_DALAM_TETES_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>11</td>
<td>Pol Hilang tak diketahui (OV)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_TAK_DIKETAHUI_OV_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_TAK_DIKETAHUI_OV_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_TAK_DIKETAHUI_OV_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_TAK_DIKETAHUI_OV_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_HILANG_TAK_DIKETAHUI_OV_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_TAK_DIKETAHUI_OV_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_HILANG_TAK_DIKETAHUI_OV_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>12</td>
<td>Total Kehilangan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TOTAL_KEHILANGAN_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TOTAL_KEHILANGAN_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TOTAL_KEHILANGAN_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TOTAL_KEHILANGAN_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TOTAL_KEHILANGAN_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TOTAL_KEHILANGAN_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TOTAL_KEHILANGAN_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">IV PABRIK</td>
</tr>
<tr>
<td>1</td>
<td>Effisiensi pabrik</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFFISIENSI_PABRIK_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFFISIENSI_PABRIK_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFFISIENSI_PABRIK_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFFISIENSI_PABRIK_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->EFFISIENSI_PABRIK_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->EFFISIENSI_PABRIK_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->EFFISIENSI_PABRIK_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>Overall recovery</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->OVERALL_RECOVERY_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->OVERALL_RECOVERY_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->OVERALL_RECOVERY_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->OVERALL_RECOVERY_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->OVERALL_RECOVERY_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->OVERALL_RECOVERY_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->OVERALL_RECOVERY_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>Faktor rendemen</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FAKTOR_RENDEMEN_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FAKTOR_RENDEMEN_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FAKTOR_RENDEMEN_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FAKTOR_RENDEMEN_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FAKTOR_RENDEMEN_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FAKTOR_RENDEMEN_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FAKTOR_RENDEMEN_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Rendemen efektif</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_EFEKTIF_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_EFEKTIF_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_EFEKTIF_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_EFEKTIF_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_EFEKTIF_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->RENDEMEN_EFEKTIF_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->RENDEMEN_EFEKTIF_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>7</td>
<td>HK Nira mentah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_NIRA_MENTAH_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_NIRA_MENTAH_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_NIRA_MENTAH_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_NIRA_MENTAH_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_NIRA_MENTAH_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_NIRA_MENTAH_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_NIRA_MENTAH_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>8</td>
<td>Kehil Pol % pol NM</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHIL_POL_PERSEN_POL_NM_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHIL_POL_PERSEN_POL_NM_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHIL_POL_PERSEN_POL_NM_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHIL_POL_PERSEN_POL_NM_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KEHIL_POL_PERSEN_POL_NM_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KEHIL_POL_PERSEN_POL_NM_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KEHIL_POL_PERSEN_POL_NM_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">V BAHAN PEMBANTU Kg per 100 TT</td>
</tr>
<tr>
<td>1</td>
<td>Kapur (Kg)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR_KG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR_KG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR_KG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR_KG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR_KG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KAPUR_KG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KAPUR_KG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>Kapur / 100 Ton Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR__100_TON_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR__100_TON_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR__100_TON_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR__100_TON_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KAPUR__100_TON_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KAPUR__100_TON_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KAPUR__100_TON_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>Belerang (Kg)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG_KG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG_KG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG_KG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG_KG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG_KG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->BELERANG_KG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->BELERANG_KG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Belerang / 100 Ton Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG__100_TON_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG__100_TON_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG__100_TON_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG__100_TON_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->BELERANG__100_TON_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->BELERANG__100_TON_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->BELERANG__100_TON_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>Asam phosphat (Kg)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT_KG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT_KG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT_KG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT_KG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT_KG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT_KG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT_KG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>6</td>
<td>Asam phosphat / 100 Ton Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT__100_TON_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT__100_TON_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT__100_TON_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT__100_TON_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT__100_TON_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT__100_TON_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->ASAM_PHOSPHAT__100_TON_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>7</td>
<td>Floculant (Kg)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT_KG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT_KG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT_KG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT_KG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT_KG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FLOCULANT_KG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FLOCULANT_KG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>8</td>
<td>Floculant / 100 Ton Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT__100_TON_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT__100_TON_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT__100_TON_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT__100_TON_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FLOCULANT__100_TON_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FLOCULANT__100_TON_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FLOCULANT__100_TON_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>9</td>
<td>Filter Aid (Kg)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID_KG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID_KG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID_KG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID_KG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID_KG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FILTER_AID_KG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FILTER_AID_KG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>10</td>
<td>Filter Aid / 100 Ton Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID__100_TON_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID__100_TON_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID__100_TON_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID__100_TON_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->FILTER_AID__100_TON_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FILTER_AID__100_TON_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->FILTER_AID__100_TON_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>11</td>
<td>Pelunak Kerak (Kg)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK_KG_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK_KG_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK_KG_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK_KG_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK_KG_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK_KG_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK_KG_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>12</td>
<td>Pelunak Kerak / 100 Ton Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK__100_TON_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK__100_TON_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK__100_TON_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK__100_TON_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK__100_TON_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK__100_TON_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PELUNAK_KERAK__100_TON_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">VI MASAKAN A</td>
</tr>
<tr>
<td>1</td>
<td>Masakan % Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_PROSEN_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_PROSEN_A,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>% Brix Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_PROSEN_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_PROSEN_A,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>HK Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_THN_LALU_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_PROSEN_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_PROSEN_A,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Purity Drop</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_THN_LALU_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_PROSEN_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_PROSEN_A,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>Kristal % Pol</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_THN_LALU_SD_INI_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_A,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_PROSEN_A,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_PROSEN_A,2); ?></td>
</tr>
<tr>
<td colspan="8">VII MASAKAN : B/R</td>
</tr>
<tr>
<td>1</td>
<td>Masakan % Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_PROSEN_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_PROSEN_B,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>% Brix Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_PROSEN_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_PROSEN_B,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>HK Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_THN_LALU_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_PROSEN_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_PROSEN_B,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Purity Drop</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_THN_LALU_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_PROSEN_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_PROSEN_B,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>Kristal % Pol</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_THN_LALU_SD_INI_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_B,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_PROSEN_B,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_PROSEN_B,2); ?></td>
</tr>
<tr>
<td colspan="8">VIII MASAKAN : C</td>
</tr>
<tr>
<td>1</td>
<td>Masakan % Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_PROSEN_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_PROSEN_C,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>% Brix Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_PROSEN_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_PROSEN_C,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>HK Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_THN_LALU_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_PROSEN_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_PROSEN_C,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Purity Drop</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_THN_LALU_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_PROSEN_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_PROSEN_C,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>Kristal % Pol</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_THN_LALU_SD_INI_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_C,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_PROSEN_C,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_PROSEN_C,2); ?></td>
</tr>
<tr>
<td colspan="8">IX MASAKAN : D</td>
</tr>
<tr>
<td>1</td>
<td>Masakan % Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKO_PROSEN_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->MASAKAN_PERSEN_TEBU_RKAP_PROSEN_D,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>% Brix Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKO_PROSEN_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_MASAKAN_RKAP_PROSEN_D,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>HK Masakan</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_THN_LALU_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKO_PROSEN_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_MASAKAN_RKAP_PROSEN_D,2); ?></td>
</tr>
<tr>
<td>4</td>
<td>Purity Drop</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_THN_LALU_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKO_PROSEN_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PURITY_DROP_RKAP_PROSEN_D,2); ?></td>
</tr>
<tr>
<td>5</td>
<td>Kristal % Pol</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_THN_LALU_SD_INI_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_D,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKO_PROSEN_D,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KRISTAL_PERSEN_POL_RKAP_PROSEN_D,2); ?></td>
</tr>
<tr>
<td>6</td>
<td>Jumlah Masakan % Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_MASAKAN_PERSEN_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_MASAKAN_PERSEN_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_MASAKAN_PERSEN_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_MASAKAN_PERSEN_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_MASAKAN_PERSEN_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_MASAKAN_PERSEN_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>7</td>
<td>Tetes % Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TETES_PERSEN_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TETES_PERSEN_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TETES_PERSEN_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TETES_PERSEN_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TETES_PERSEN_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TETES_PERSEN_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TETES_PERSEN_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>8</td>
<td>% Brix Tetes</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TETES_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TETES_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TETES_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TETES_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TETES_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TETES_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PERSEN_BRIX_TETES_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>9</td>
<td>HK Tetes</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_TETES_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_TETES_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_TETES_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_TETES_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->HK_TETES_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_TETES_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->HK_TETES_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>10</td>
<td>Pol Tetes % Nira Mentah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_TETES_PERSEN_NIRA_MENTAH_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_TETES_PERSEN_NIRA_MENTAH_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_TETES_PERSEN_NIRA_MENTAH_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_TETES_PERSEN_NIRA_MENTAH_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->POL_TETES_PERSEN_NIRA_MENTAH_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_TETES_PERSEN_NIRA_MENTAH_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->POL_TETES_PERSEN_NIRA_MENTAH_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">X RENDEMEN KETEL</td>
</tr>
<tr>
<td>1</td>
<td>Rendemen Ketel</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_KETEL_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_KETEL_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_KETEL_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_KETEL_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RENDEMEN_KETEL_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->RENDEMEN_KETEL_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->RENDEMEN_KETEL_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>Kg Uap Kg Tebu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_UAP_KG_TEBU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_UAP_KG_TEBU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_UAP_KG_TEBU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_UAP_KG_TEBU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->KG_UAP_KG_TEBU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KG_UAP_KG_TEBU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->KG_UAP_KG_TEBU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>Pemakaian BBA (Ton)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PEMAKAIAN_BBA_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PEMAKAIAN_BBA_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PEMAKAIAN_BBA_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PEMAKAIAN_BBA_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->PEMAKAIAN_BBA_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PEMAKAIAN_BBA_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->PEMAKAIAN_BBA_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">XI TEBU TERBAKAR</td>
</tr>
<tr>
<td>1</td>
<td>Tebu Terbakar TS (Ton)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TS_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TS_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TS_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TS_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TS_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TS_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TS_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>Tebu Terbakar TR (Ton)</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TR_TON_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TR_TON_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TR_TON_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TR_TON_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TR_TON_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TR_TON_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->TEBU_TERBAKAR_TR_TON_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>3</td>
<td>Jumlah</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->JUMLAH_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->JUMLAH_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td colspan="8">XII GULA SISAN / PENGERINGAN (TON)</td>
</tr>
<tr>
<td>1</td>
<td>Gula Sisan Ex Tahun Lalu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->GULA_SISAN_EX_TAHUN_LALU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->GULA_SISAN_EX_TAHUN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->GULA_SISAN_EX_TAHUN_LALU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->GULA_SISAN_EX_TAHUN_LALU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->GULA_SISAN_EX_TAHUN_LALU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->GULA_SISAN_EX_TAHUN_LALU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->GULA_SISAN_EX_TAHUN_LALU_RKO_PROSEN,2); ?></td>
</tr>
<tr>
<td>2</td>
<td>Re Proses Ex Tahun Lalu</td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RE_PROSES_EX_TAHUN_LALU_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RE_PROSES_EX_TAHUN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RE_PROSES_EX_TAHUN_LALU_THN_LALU_SD_INI,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RE_PROSES_EX_TAHUN_LALU_RKO,2); ?></td>
<td style="text-align:right"><?php echo number_format($evaluasi[0]->RE_PROSES_EX_TAHUN_LALU_RKAP,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->RE_PROSES_EX_TAHUN_LALU_RKAP_PROSEN,2); ?></td>
<td style="text-align: right"><?php echo number_format($evaluasi[0]->RE_PROSES_EX_TAHUN_LALU_RKO_PROSEN,2); ?></td>
</tr>

</tbody>
</table>

   </div>