<style>
.number {
    text-align: right;
}
table, td, th {
    border: 1px solid black;
    padding: 1px 6px;
    font-family: Tahoma;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th {
    text-align: center;
}
.null-border tr td{
  border:0;
  padding: 1px 2px;
}
table.null-border{
  border:0;
  margin-bottom: 15px;
}
.spottr{
  background: #b2def9;
  font-weight: bold;
}

</style>

<table class="null-border">
  <tr>
      <td style="width: 18%;">PABRIK GULA</td>
        <td>:</td>
        <td><?php echo CNF_PG;?></td>
        <td rowspan="3" style="text-align:center" > LAPORAN HARIAN<br /><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></td>
    <tr>
    <tr>
      <td>TANGGAL</td>
        <td>:</td>
        <td><?php echo SiteHelpers::datereport($rw->tgl_giling);?></td>
    <tr>
    <tr>
      <td>HARI GILING KE</td>
        <td>:</td>
        <td><?php echo ($rw->hari_giling);?></td>
    <tr>
</table>

<table>
  <tr style="background: #3e3eb7;color: #FFF;">
    <th style="width: 21%;padding: 16px;">KETERANGAN</th>
    <th style="width: 7%;">NO</th>
    <th style="width: 11%;">URAIAN</th>
    <th style="width: 22%;">HARI INI</th>
    <th style="width: 22%;">S/D. HARI INI</th>
  </tr>
  <tr>
    <td rowspan="4">TEBU DIGILING</td>
    <td align="center">-1.1-</td>
    <td>TS</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_ts+$rw->ton_giling_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_ts_sd+$rw->ton_giling_ts_saudara_sd, 3); ?></td>
  </tr>
  
  <tr>
    <td align="center">-1.2-</td>
    <td>SPT</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_spt, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_spt_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-1.3-</td>
    <td>TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_tr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_tr_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">1</td>
    <td>TS + TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_total, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_total_sd, 3); ?></td>
  </tr>
  
  <tr>
    <td rowspan="3">KECEPATAN GILING</td>
    <td align="center">-2.1-</td>
    <td>KIS eks. HR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kis, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kis_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-2.2-</td>
    <td>KIS Incl. HR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kis_inc, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kis_inc_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">3</td>
    <td>KES</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kes, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kes_sd, 3); ?></td>
  </tr>
  
  <tr>
    <td rowspan="3">JAM BERHENTI GILING</td>
    <td align="center">4</td>
    <td>A</td>
    <td class="number"><?php echo SiteHelpers::terjemahjam($rw->jam_berhenti_a, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::terjemahjam($rw->jam_berhenti_a_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">5</td>
    <td>B</td>
    <td class="number"><?php echo SiteHelpers::terjemahjam($rw->jam_berhenti_b, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::terjemahjam($rw->jam_berhenti_b_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">6</td>
    <td>A + B</td>
    <td class="number"><?php echo SiteHelpers::terjemahjam($rw->total_jb, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::terjemahjam($rw->total_jb_sd, 3); ?></td>
  </tr>
  
  <tr>
    <td>SUPLESI RESIDU</td>
    <td align="center">7</td>
    <td>LITER</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->residu, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->residu_sd, 3); ?></td>
  </tr>
  
  <tr>
    <td rowspan="2">SUPLESI BAHAN BAKAR</td>
    <td align="center">8</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->bba_ton, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->bba_ton_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">9</td>
    <td>RUPIAH</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->bba_rupiah, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->bba_rupiah_sd, 3); ?></td>
  </tr>
  
  <tr>
    <td rowspan="9">PRODUKSI GULA SHS (TON)</td>
    <td class="spottr" align="center">10</td>
    <td class="spottr">TOTAL</td>
    <td class="spottr number"><?php echo SiteHelpers::numberformat($rw->gula_produksi, 3); ?></td>
    <td class="spottr number"><?php echo SiteHelpers::numberformat($rw->gula_produksi_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">11</td>
    <td>MLK PG</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_total, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_total_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-11.1-</td>
    <td>- TS</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_ts, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_ts_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-11.2-</td>
    <td>- 34 % PTR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_eks_tr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_eks_tr_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-11.3-</td>
    <td>- Dari TS Sdr</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_eks_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_eks_ts_saudara_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-11.4-</td>
    <td>- Dari SPT</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_spt, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_pg_spt_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">12</td>
    <td>MLK PTR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_tr_bagihasil+$rw->gula_tr_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_tr_bagihasil_sd+$rw->gula_tr_ts_saudara_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-12.2-</td>
    <td>- BAGI HASIL PTR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_tr_bagihasil, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_tr_bagihasil_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-12.3-</td>
    <td>- BAGI HASIL PG. LAIN</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_tr_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_tr_ts_saudara_sd, 3); ?></td>
  </tr>
  <tr>
    <td>GULA SISAN TH. LALU DIOLAH</td>
    <td align="center">13</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->sisan_diolah, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->sisan_diolah_sd, 3); ?></td>
  </tr>
  <tr>
    <td>GKP EX. GULA SISAN</td>
    <td align="center">14</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_ex_sisan, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_ex_sisan_sd, 3); ?></td>
  </tr>
  <tr>
    <td>GKP EX. Th. LALU (REPROSES)</td>
    <td align="center">15</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_repro_thn_lalu, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_repro_thn_lalu_sd, 3); ?></td>
  </tr>
  <tr>
    <td>GKP EX. Th. INI (REPROSES)</td>
    <td align="center">16</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_repro_thn_ini, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->gula_repro_thn_ini_sd, 3); ?></td>
  </tr>
  <tr>
    <td>GKP EX RAW SUGAR DIOLAH</td>
    <td align="center">17</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->raw_sugar_diolah, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->raw_sugar_diolah_sd, 3); ?></td>
  </tr>
  <tr>
    <td>ICUMSA</td>
    <td align="center">18</td>
    <td>UI</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->icumsa, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->icumsa_sd, 3); ?></td>
  </tr>
  <tr>
    <td rowspan="2">TETES</td>
    <td align="center">19</td>
    <td>PRODUKSI</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tetes_produksi, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tetes_produksi_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">20</td>
    <td>STO TETES</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tetes_sto, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tetes_sto_sd, 3); ?></td>
  </tr>
  <tr>
    <td rowspan="4">RENDEMEN (%)</td>
    <td align="center">21</td>
    <td>TS</td>
    <td class="number"><?php 
    if(($rw->ton_giling_ts+$rw->ton_giling_ts_saudara) != 0){
    echo SiteHelpers::numberformat((($rw->kristal_ts+$rw->kristal_ts_saudara)/($rw->ton_giling_ts+$rw->ton_giling_ts_saudara))*100, 3);
    } ?></td>
    <td class="number"><?php 
    if(($rw->ton_giling_ts_sd+$rw->ton_giling_ts_saudara_sd) != 0){
      echo SiteHelpers::numberformat((($rw->kristal_ts_sd+$rw->kristal_ts_saudara_sd)/($rw->ton_giling_ts_sd+$rw->ton_giling_ts_saudara_sd))*100, 3);
      } ?></td>
  </tr>

   <tr>
    <td align="center">22</td>
    <td>SPT</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_spt, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_spt_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">23</td>
    <td>TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_tr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_tr_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">24</td>
    <td>TS + TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_total, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_total_sd, 3); ?></td>
  </tr>
  <tr>
    <td rowspan="4">HABLUR DIHASILKAN</td>
    <td align="center">-25.1-</td>
    <td>TS</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_ts+$rw->kristal_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_ts_sd+$rw->kristal_ts_saudara_sd, 3); ?></td>
  </tr>

  <tr>
    <td align="center">-25.2-</td>
    <td>SPT</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_spt, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_spt_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-25.3-</td>
    <td>TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_tr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_tr_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">26</td>
    <td>TS + TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_total, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->kristal_total_sd, 3); ?></td>
  </tr>
  <tr>
    <td rowspan="3">TON TS PG SAUDARA</td>
    <td align="center">27</td>
    <td>MASUK</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_tebang_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_tebang_ts_saudara_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">28</td>
    <td>DIGILING</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_giling_ts_saudara_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">29</td>
    <td>RENDEMEN</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->rend_ts_saudara_sd, 3); ?></td>
  </tr>
 
  <tr>
    <td rowspan="4">HA DITEBANG</td>
    <td align="center">-30.1-</td>
    <td>TS</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_ts+$rw->ha_tebang_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_ts_sd+$rw->ha_tebang_ts_saudara_sd, 3); ?></td>
  </tr>
 
  <tr>
    <td align="center">-30.2-</td>
    <td>SPT</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_spt, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_spt_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-30.3-</td>
    <td>TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_tr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_tr_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">30</td>
    <td>TS + TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_total, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_tebang_total_sd, 3); ?></td>
  </tr>
  <tr>
    <td rowspan="4">HA DIGILING</td>
    <td align="center">-31.1-</td>
    <td>TS</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_ts+$rw->ha_giling_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_ts_sd+$rw->ha_giling_ts_saudara_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-31.2-</td>
    <td>SPT</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_spt, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_spt_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-31.3-</td>
    <td>TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_tr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_tr_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">31</td>
    <td>TS + TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_total, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ha_giling_total_sd, 3); ?></td>
  </tr>
  <tr>
    <td>SISA TEBU DI EMPLASEMEN</td>
    <td align="center">32</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ton_tebang_total_sd-$rw->ton_giling_total_sd, 3); ?></td>
    <td class="number">-</td>
  </tr>
  <tr>
    <td rowspan="4">TEBU TERBAKAR</td>
    <td align="center">-33.1-</td>
    <td>TS</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_ts+$rw->tebu_terbakar_ts_saudara, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_ts_sd+$rw->tebu_terbakar_ts_saudara_sd, 3); ?></td>
  </tr>

  <tr>
    <td align="center">-33.2-</td>
    <td>SPT</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_spt, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_spt_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">-33.3-</td>
    <td>TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_tr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_tr_sd, 3); ?></td>
  </tr>
  <tr class="spottr">
    <td align="center">33</td>
    <td>TS + TR</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_total, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tebu_terbakar_total_sd, 3); ?></td>
  </tr>
  <tr>
    <td rowspan="2">TETES</td>
    <td align="center">34</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tetes_produksi, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->tetes_produksi_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">35</td>
    <td>% POL</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->persen_pol_tetes, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->persen_pol_tetes_sd, 3); ?></td>
  </tr>

  <tr>
    <td rowspan="2">AMPAS</td>
    <td align="center">36</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ampas_ton, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ampas_ton_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">37</td>
    <td>% POL</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->persen_pol_ampas, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->persen_pol_ampas_sd, 3); ?></td>
  </tr>

  <tr>
    <td rowspan="2">BLOTONG</td>
    <td align="center">38</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->blotong_ton, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->blotong_ton_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">39</td>
    <td>% POL</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->persen_pol_blotong, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->persen_pol_blotong_sd, 3); ?></td>
  </tr>

  <tr>
    <td rowspan="2">POL DALAM HASIL + TAKSASI</td>
    <td align="center">40</td>
    <td>TON</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->pol_dlm_hasil_taksasi_ton, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->pol_dlm_hasil_taksasi_ton_sd, 3); ?></td>
  </tr>
  <tr>
    <td align="center">41</td>
    <td>% POL</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->pol_dlm_hasil_taksasi_persenpol, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->pol_dlm_hasil_taksasi_persenpol_sd, 3); ?></td>
  </tr>

  <tr>
    <td style="padding: 20px;">KET. JAM BERHENTI GILING</td>
    <td align="center">42</td>
    <td></td>
    <td colspan="2" ><?php echo $rw->keterangan_jb; ?></td>
  </tr>

<tr>
    <td >% Pol TEBU</td>
    <td align="center">43</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->pol_tebu, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->pol_tebu_sd, 3); ?></td>
  </tr>

<tr>
    <td >Kehilangan Dlm Ampas</td>
    <td align="center">44</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->k_dlm_ampas, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->k_dlm_ampas_sd, 3); ?></td>
  </tr>

  <tr>
    <td >Kehilangan Dlm Blotong</td>
    <td align="center">45</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->k_dlm_blotong, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->k_dlm_blotong_sd, 3); ?></td>
  </tr>

  <tr>
    <td >Kehilangan Dlm Tetes</td>
    <td align="center">46</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->k_dlm_tetes, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->k_dlm_tetes_sd, 3); ?></td>
  </tr>

  <tr>
    <td >OV</td>
    <td align="center">47</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_ov, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_ov_sd, 3); ?></td>
  </tr>

   <tr>
    <td >ME</td>
    <td align="center">48</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_me, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_me_sd, 3); ?></td>
  </tr>

   <tr>
    <td >BHR</td>
    <td align="center">49</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_bhr, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_bhr_sd, 3); ?></td>
  </tr>

   <tr>
    <td >EFESIENSI PABRIK (OR)</td>
    <td align="center">50</td>
    <td>%</td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_or, 3); ?></td>
    <td class="number"><?php echo SiteHelpers::numberformat($rw->ef_or_sd, 3); ?></td>
  </tr>

  
  
</table>
<center><p style="font-size:10px;">Dibuat Oleh <?php echo $rw->user_created;?> Tgl. <?php echo SiteHelpers::formatdatetime($rw->tgl_created);?></p></center>
<table class="null-border" style="margin-top: 20px">
  <tr>
    <td style="width: 50%; text-align: center; font-weight: bold;">GENERAL MANAGER</td>
    <td style="width: 50%; text-align: center; font-weight: bold;">MANAGER PENGOLAHAN</td>
  </tr>
  <tr>
    <td style="text-align: center;"><br /><br /><br /><br /><br /><br /><?php echo CNF_GM;?></td>
    <td style="text-align: center;"><br /><br /><br /><br /><br /><br /><?php echo CNF_MANPENGOLAHAN;?></td>
  </tr>
</table>

<script type="text/javascript">
  window.print();
 setTimeout(window.close, 100);
</script>