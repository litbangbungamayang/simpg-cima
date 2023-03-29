<div id="report">
   <style>
      table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 99%;
      }
      td, th {

      padding: 2px;
      font-size: 10px;
      white-space: nowrap;
      }
      tbody tr td{
        border: 1px solid #000000;
        padding: 2px;
        font-size: 10px;
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
            <th colspan="10" align="center" bold style="text-align:center;">LAPORAN TELEGRAM GILING TAHUN  <?php echo CNF_TAHUNGILING;?></th>
         </tr>
         <tr>
            <td colspan="10">PERIODE <?php echo date("d/m/Y", strtotime($produksi[0]->PERIODE)); ?></td>
         </tr>
         <tr>
            <td colspan="10">PABRIK GULA <?php echo strtoupper($unit[0]->namapg); ?></td>
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
            <td></td>
         </tr>
         <tr>
            <td colspan="2">MULAI GILING :</td>
            <td><?php echo date("d/m/Y", strtotime($produksi[0]->MULAI_GILING)); ?></td>
            <td align="right">AKHIR GILING :</td>
            <td><?php echo date("d/m/Y", strtotime($produksi[0]->AKHIR_GILING)); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="right">TETES PETANI :</td>
            <td><?php echo $produksi[0]->TETES_PETANI; ?></td>
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
            <td></td>
         </tr>
         </thead>
         <tbody>
         <tr>
            <td>NO</td>
            <td>KODE</td>
            <td>URAIAN</td>
            <td>HA DIGIL</td>
            <td>HA BELUM</td>
            <td>TON TEBU</td>
            <td>TON HABL</td>
            <td>TEBU/HA</td>
            <td>HABL/HA</td>
            <td>REND</td>
         </tr>
         <tr>
            <td>I</td>
            <td colspan="9"> TEBU SENDIRI (TS)</td>
         </tr>
         <tr>
            <td>1</td>
            <td>1111</td>
            <td>TSS- I  HG</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>2</td>
            <td>1112</td>
            <td>TSS- II  HG</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>3</td>
            <td>1113</td>
            <td>TSS- III  HG</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_III_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_III_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_III_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_III_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_III_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_III_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_III_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>4</td>
            <td>1119</td>
            <td>Sub Jumlah/Rata TSS-HG</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAHRATA_TSS_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAHRATA_TSS_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAHRATA_TSS_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAHRATA_TSS_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAHRATA_TSS_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAHRATA_TSS_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAHRATA_TSS_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>5</td>
            <td>1121</td>
            <td>TST-I   HG</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>6</td>
            <td>1122</td>
            <td>TST-II  HG</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>7</td>
            <td>1123</td>
            <td>TST-III HG</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_III_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_III_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_III_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_III_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_III_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_III_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_III_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>8</td>
            <td>1129</td>
            <td>Sub Jumlah / Rata TST-HG</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>9</td>
            <td>1199</td>
            <td>Sub Jumlah/ Rata HG</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_HG_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_HG_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_HG_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_HG_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_HG_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_HG_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_HG_REND,2); ?></td>
         </tr>
         <tr>
            <td>10</td>
            <td>1211</td>
            <td>TSS-I  IP</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_IP_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_IP_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_IP_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_IP_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_IP_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_IP_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_IP_REND,2); ?></td>
         </tr>
         <tr>
            <td>11</td>
            <td>1212</td>
            <td>TSS-II IP</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_IP_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_IP_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_IP_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_IP_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_IP_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_IP_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_IP_REND,2); ?></td>
         </tr>
         <tr>
            <td>12</td>
            <td>1219</td>
            <td>Sub Jumlah/ Rata TSS-IP</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_IP_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_IP_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_IP_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_IP_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_IP_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_IP_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_IP_REND,2); ?></td>
         </tr>
         <tr>
            <td>13</td>
            <td>1311</td>
            <td>TST-I IP</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_IP_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_IP_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_IP_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_IP_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_IP_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_IP_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_IP_REND,2); ?></td>
         </tr>
         <tr>
            <td>14</td>
            <td>1312</td>
            <td>TST-II IP</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_IP_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_IP_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_IP_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_IP_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_IP_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_IP_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_IP_REND,2); ?></td>
         </tr>
         <tr>
            <td>15</td>
            <td>1319</td>
            <td>Sub Jumlah/ Rata TST-IP</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_IP_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_IP_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_IP_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_IP_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_IP_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_IP_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_IP_REND,2); ?></td>
         </tr>
         <tr>
            <td>16</td>
            <td>1411</td>
            <td>TSS-I  KN</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KN_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KN_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KN_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KN_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KN_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KN_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KN_REND,2); ?></td>
         </tr>
         <tr>
            <td>17</td>
            <td>1412</td>
            <td>TSS-II KN</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KN_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KN_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KN_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KN_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KN_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KN_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KN_REND,2); ?></td>
         </tr>
         <tr>
            <td>18</td>
            <td>1419</td>
            <td>Sub Jumlah/ Rata TSS-KN</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KN_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KN_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KN_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KN_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KN_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KN_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KN_REND,2); ?></td>
         </tr>
         <tr>
            <td>19</td>
            <td>1511</td>
            <td>TST-I  KN</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KN_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KN_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KN_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KN_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KN_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KN_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KN_REND,2); ?></td>
         </tr>
         <tr>
            <td>20</td>
            <td>1512</td>
            <td>TST-II KN </td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KN__HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KN__HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KN__TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KN__TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KN__TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KN__HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KN__REND,2); ?></td>
         </tr>
         <tr>
            <td>21</td>
            <td>1519</td>
            <td>Sub Jumlah/ Rata TST-KN</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KN_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KN_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KN_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KN_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KN_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KN_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KN_REND,2); ?></td>
         </tr>
         <tr>
            <td>22</td>
            <td>1611</td>
            <td>TSS-I  KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_I_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>23</td>
            <td>1612</td>
            <td>TSS-II  KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TSS_II_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>24</td>
            <td>1619</td>
            <td>Sub Jumlah/ Rata TSS-KS</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TSS_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>25</td>
            <td>1711</td>
            <td>TST-I  KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_I_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>26</td>
            <td>1712</td>
            <td>TST-II  KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TST_II_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>27</td>
            <td>1719</td>
            <td>Sub Jumlah/ Rata TST-KS</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TST_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>28</td>
            <td>1811</td>
            <td>TS-SP</td>
            <td align="right"><?php echo number_format($produksi[0]->TS_SP_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_SP_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_SP_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_SP_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_SP_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_SP_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_SP_REND,2); ?></td>
         </tr>
         <tr>
            <td>29</td>
            <td>1812</td>
            <td>TS-ST</td>
            <td align="right"><?php echo number_format($produksi[0]->TS_ST_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_ST_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_ST_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_ST_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_ST_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_ST_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_ST_REND,2); ?></td>
         </tr>
         <tr>
            <td>30</td>
            <td>1819</td>
            <td>Sub Jumlah/ Rata SPT</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_SPT_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_SPT_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_SPT_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_SPT_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_SPT_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_SPT_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_SPT_REND,2); ?></td>
         </tr>
         <tr>
            <td>31</td>
            <td>1911</td>
            <td>TS-TR</td>
            <td align="right"><?php echo number_format($produksi[0]->TS_TR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_TR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_TR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_TR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_TR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_TR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_TR_REND,2); ?></td>
         </tr>
         <tr>
            <td>32</td>
            <td>1912</td>
            <td>TS-BB</td>
            <td align="right"><?php echo number_format($produksi[0]->TS_BB_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_BB_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_BB_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_BB_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_BB_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_BB_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TS_BB_REND,2); ?></td>
         </tr>
         <tr>
            <td>33</td>
            <td>1999</td>
            <td>JUMLAH/RATA TS</td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TS_REND,2); ?></td>
         </tr>
         <tr>
            <td>II</td>
            <td colspan="9">TEBU RAKYAT (TR)</td>
         </tr>
         <tr>
            <td>1</td>
            <td>2111</td>
            <td>TRS-I KD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KD_REND,2); ?></td>
         </tr>
         <tr>
            <td>2</td>
            <td>2112</td>
            <td>TRS-II KD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KD_REND,2); ?></td>
         </tr>
         <tr>
            <td>3</td>
            <td>2119</td>
            <td>Sub Jumlah / Rata TRS -KD</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KD_REND,2); ?></td>
         </tr>
         <tr>
            <td>4</td>
            <td>2211</td>
            <td>TRT-I KD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KD_REND,2); ?></td>
         </tr>
         <tr>
            <td>5</td>
            <td>2212</td>
            <td>TRT-II KD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KD_REND,2); ?></td>
         </tr>
         <tr>
            <td>6</td>
            <td>2219</td>
            <td>Sub Jumlah / Rata TRT -KD</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KD_REND,2); ?></td>
         </tr>
         <tr>
            <td>7</td>
            <td>2311</td>
            <td>TRS-I KL</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KL_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KL_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KL_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KL_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KL_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KL_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KL_REND,2); ?></td>
         </tr>
         <tr>
            <td>8</td>
            <td>2312</td>
            <td>TRS-II KL</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KL_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KL_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KL_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KL_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KL_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KL_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KL_REND,2); ?></td>
         </tr>
         <tr>
            <td>9</td>
            <td>2319</td>
            <td>Sub Jumlah / Rata TRS -KL</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KL_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KL_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KL_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KL_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KL_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KL_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KL_REND,2); ?></td>
         </tr>
         <tr>
            <td>10</td>
            <td>2411</td>
            <td>TRT-I KL</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KL_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KL_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KL_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KL_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KL_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KL_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KL_REND,2); ?></td>
         </tr>
         <tr>
            <td>11</td>
            <td>2412</td>
            <td>TRT-II KL</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KL_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KL_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KL_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KL_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KL_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KL_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KL_REND,2); ?></td>
         </tr>
         <tr>
            <td>12</td>
            <td>2419</td>
            <td>Sub Jumlah / Rata TRT -KL</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KL_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KL_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KL_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KL_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KL_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KL_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KL_REND,2); ?></td>
         </tr>
         <tr>
            <td>13</td>
            <td>2511</td>
            <td>TRS-I MD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MD_REND,2); ?></td>
         </tr>
         <tr>
            <td>14</td>
            <td>2512</td>
            <td>TRS-II MD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MD_REND,2); ?></td>
         </tr>
         <tr>
            <td>15</td>
            <td>2519</td>
            <td>Sub Jumlah / Rata TRS -MD</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MD_REND,2); ?></td>
         </tr>
         <tr>
            <td>16</td>
            <td>2611</td>
            <td>TRT-I MD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MD_REND,2); ?></td>
         </tr>
         <tr>
            <td>17</td>
            <td>2612</td>
            <td>TRT-II MD</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MD_REND,2); ?></td>
         </tr>
         <tr>
            <td>18</td>
            <td>2619</td>
            <td>Sub Jumlah / Rata TRT - MD</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MD_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MD_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MD_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MD_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MD_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MD_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MD_REND,2); ?></td>
         </tr>
         <tr>
            <td>19</td>
            <td>2711</td>
            <td>TRS-I ML</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_ML_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_ML_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_ML_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_ML_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_ML_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_ML_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_ML_REND,2); ?></td>
         </tr>
         <tr>
            <td>20</td>
            <td>2712</td>
            <td>TRS-II ML</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_ML_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_ML_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_ML_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_ML_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_ML_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_ML_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_ML_REND,2); ?></td>
         </tr>
         <tr>
            <td>21</td>
            <td>2719</td>
            <td>Sub Jumlah / Rata TRS -ML</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_ML_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_ML_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_ML_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_ML_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_ML_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_ML_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_ML_REND,2); ?></td>
         </tr>
         <tr>
            <td>22</td>
            <td>2811</td>
            <td>TRT-I ML</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_ML_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_ML_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_ML_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_ML_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_ML_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_ML_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_ML_REND,2); ?></td>
         </tr>
         <tr>
            <td>23</td>
            <td>2812</td>
            <td>TRT-II ML</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_ML_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_ML_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_ML_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_ML_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_ML_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_ML_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_ML_REND,2); ?></td>
         </tr>
         <tr>
            <td>24</td>
            <td>2819</td>
            <td>Sub Jumlah / Rata TRT-ML</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_ML_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_ML_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_ML_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_ML_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_ML_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_ML_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_ML_REND,2); ?></td>
         </tr>
         <tr>
            <td>25</td>
            <td>2911</td>
            <td>TRS-I KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>26</td>
            <td>2912</td>
            <td>TRS-II KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>27</td>
            <td>2919</td>
            <td>Sub Jumlah / Rata TRS -KD</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>28</td>
            <td>3011</td>
            <td>TRT-I KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>29</td>
            <td>3012</td>
            <td>TRT-II KS</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>30</td>
            <td>3019</td>
            <td>Sub Jumlah / Rata TRS -KS</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_KS_REND,2); ?></td>
         </tr>
         <tr>
            <td>31</td>
            <td>3111</td>
            <td>TRS-I MR</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_I_MR_REND,2); ?></td>
         </tr>
         <tr>
            <td>32</td>
            <td>3112</td>
            <td>TRS-II MR</td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRS_II_MR_REND,2); ?></td>
         </tr>
         <tr>
            <td>33</td>
            <td>3119</td>
            <td>Sub Jumlah / Rata TRS -MR</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRS_MR_REND,2); ?></td>
         </tr>
         <tr>
            <td>34</td>
            <td>3211</td>
            <td>TRT-I MR</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_I_MR_REND,2); ?></td>
         </tr>
         <tr>
            <td>35</td>
            <td>3212</td>
            <td>TRT-II MR</td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TRT_II_MR_REND,2); ?></td>
         </tr>
         <tr>
            <td>36</td>
            <td>3219</td>
            <td>Sub Jumlah / Rata TRT - MR</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TRT_MR_REND,2); ?></td>
         </tr>
         <tr>
            <td>37</td>
            <td>3311</td>
            <td>TR-TK</td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TK_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TK_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TK_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TK_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TK_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TK_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TK_REND,2); ?></td>
         </tr>
         <tr>
            <td>38</td>
            <td>3312</td>
            <td>TR-TM</td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TM_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TM_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TM_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TM_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TM_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TM_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->TR_TM_REND,2); ?></td>
         </tr>
         <tr>
            <td>39</td>
            <td>3319</td>
            <td>Sub Jumlah / Rata TR TRANS</td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TR_TRANS_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TR_TRANS_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TR_TRANS_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TR_TRANS_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TR_TRANS_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TR_TRANS_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->SUB_JUMLAH_RATA_TR_TRANS_REND,2); ?></td>
         </tr>
         <tr>
            <td>40</td>
            <td>3399</td>
            <td>JUMLAH/RATA TR</td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TR_TON_HABL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAHRATA_TR_REND,2); ?></td>
         </tr>
         <tr>
            <td>41</td>
            <td>4999</td>
            <td>JUMLAH / RATA- RATA TS + TR</td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAH_RATA_RATA_TS_TR_HA_DIGIL,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAH_RATA_RATA_TS_TR_HA_BELUM,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAH_RATA_RATA_TS_TR_TON_TEBU,2); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAH_RATA_RATA_TS_TR_TON_HABL,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAH_RATA_RATA_TS_TR_TEBU_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAH_RATA_RATA_TS_TR_HABL_HA,1); ?></td>
            <td align="right"><?php echo number_format($produksi[0]->JUMLAH_RATA_RATA_TS_TR_REND,2); ?></td>
         </tr>    
         </tbody>
         </table>
         <br>
         <table>
         <thead>
         <tr>
            <td colspan="4">DATA PABRIKASI</td>

            <td></td>
            <td colspan="4">RINCIAN GULA</td>

         </tr>
         </thead>
         <tbody>
         <tr>
            <td>I</td>
            <td colspan="3">TON PRODUKSI</td>
            <td rowspan="49" style="border-top: none;border-bottom: none;"></td>
            <td>NO.</td>
            <td>KODE</td>
            <td>URAIAN</td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>a. 1111</td>
            <td>GKP I</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->GKP_I,2); ?></td>
            <td>A.</td>
            <td colspan="3">EX. TEBU SENDIRI</td>
         </tr>
         <tr>
            <td></td>
            <td>b. 1121</td>
            <td>GKP II</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->GKP_II,2); ?></td>
            <td></td>
            <td>a. 1111</td>
            <td>GKP I</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_I_EX_TEBU_SENDIRI,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 1131</td>
            <td>TETES</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->TETES,2); ?></td>
            <td></td>
            <td>b. 1121</td>
            <td>GKP II</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_II_EX_TEBU_SENDIRI,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>d. 1199</td>
            <td>Jumlah</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->JUMLAH_EX_TEBU_SENDIRI,2); ?></td>
         </tr>
         <tr>
            <td>II</td>
            <td colspan="3">KECEPATAN GILING (TON)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>a. 2111</td>
            <td>Kap. Giling Excl. (KES)</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KAP_GILING_EXCL_KES,2); ?></td>
            <td>B.</td>
            <td colspan="3">TEBU RAKYAT</td>
         </tr>
         <tr>
            <td></td>
            <td>b. 2121</td>
            <td>Kap. Giling Incl. (KIS) tnp HR</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KAP_GILING_INCL_KIS_TNP_HR,2); ?></td>
            <td>1</td>
            <td>BAGIAN PG</td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 2131</td>
            <td>Kap. Giling Incl. (KIS) dg HR</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KAP_GILING_INCL_KIS_DG_HR,2); ?></td>
            <td></td>
            <td>a. 2111</td>
            <td>GKP I</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_I_BAGIAN_PG,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>b. 2121</td>
            <td>GKP II</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_II_BAGIAN_PG,2); ?></td>
         </tr>
         <tr>
            <td>III</td>
            <td>a. 3111</td>
            <td>% jam stop Luar PG (tanpa HR)</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->PERSEN_JAM_STOP_LUAR_PG_TANPA_HR,2); ?></td>
            <td></td>
            <td>d. 2199</td>
            <td>Jumlah</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->JUMLAH_BAGIAN_PG,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>b. 3121</td>
            <td>% jam stop luar PG  (dg HR)</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->PERSEN_JAM_STOP_LUAR_PG_DG_HR,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 3131</td>
            <td>% jam stop dalam PG</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->PERSEN_JAM_STOP_DALAM_PG,2); ?></td>
            <td>2</td>
            <td colspan="3">BAGIAN P.T.R.</td>
         </tr>
         <tr>
            <td></td>
            <td>d. 3141</td>
            <td>Hari Gil. excl jam stop</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->HARI_GIL_EXCL_JAM_STOP,2); ?></td>
            <td></td>
            <td>a. 2211</td>
            <td>GKP I</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_I_BAGIAN_PTR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>e. 3151</td>
            <td>Hari Gil. incl jam stop (tanpa HR)</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->HARI_GIL_INCL_JAM_STOP_TANPA_HR,2); ?></td>
            <td></td>
            <td>b. 2221</td>
            <td>GKP II</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_II_BAGIAN_PTR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>f. 3161</td>
            <td>Hari Gil. incl jam stop (dg HR)</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->HARI_GIL_INCL_JAM_STOP_DG_HR,2); ?></td>
            <td></td>
            <td>d. 2299</td>
            <td>Jumlah</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->JUMLAH_BAGIAN_PTR,2); ?></td>
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
         </tr>
         <tr>
            <td>IV</td>
            <td>a. 4111</td>
            <td>Sabut % tebu</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->SABUT_PERSEN_TEBU,2); ?></td>
            <td>3</td>
            <td colspan="3">JUMLAH EX TR</td>
         </tr>
         <tr>
            <td></td>
            <td>b. 4121</td>
            <td>Imbibisi % sabut</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->IMBIBISI_PERSEN_SABUT,2); ?></td>
            <td></td>
            <td>a. 2311</td>
            <td>GKP I</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_I_JUMLAH_EX_TR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 4131</td>
            <td>Kadar nira tebu</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KADAR_NIRA_TEBU,2); ?></td>
            <td></td>
            <td>b. 2321</td>
            <td>GKP II</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_II_JUMLAH_EX_TR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>d. 4141</td>
            <td>HPG 12.5</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->HPG_125,2); ?></td>
            <td></td>
            <td>d. 2399</td>
            <td>Jumlah</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->JUMLAH_JUMLAH_EX_TR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>e. 4151</td>
            <td>HPB Total</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->HPB_TOTAL,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>f. 4161</td>
            <td>PSHK.</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->PSHK,2); ?></td>
            <td>C.</td>
            <td colspan="3">EX GULA SISAN</td>
         </tr>
         <tr>
            <td></td>
            <td>g. 4171</td>
            <td>Nilai nira npp</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->NILAI_NIRA_NPP,2); ?></td>
            <td></td>
            <td>a. 3111</td>
            <td>GKP I</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_I_EX_GULA_SISAN,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>f. 4181</td>
            <td>ME</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->ME,2); ?></td>
            <td></td>
            <td>b. 3121</td>
            <td>GKP II</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_II_EX_GULA_SISAN,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>g. 4191</td>
            <td>BHR </td>
            <td align="right"><?php echo number_format($fabrikasi[0]->BHR,2); ?></td>
            <td></td>
            <td>d. 3199</td>
            <td>Jumlah</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->JUMLAH_EX_GULA_SISAN,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>f. 4163</td>
            <td>OR</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->OR_PABRIKASI,2); ?></td>
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
            <td>D.</td>
            <td>EX ROW SUGAR</td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td>V</td>
            <td>a. 5111</td>
            <td>HK nira mentah</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->HK_NIRA_MENTAH,2); ?></td>
            <td></td>
            <td>a. 4111</td>
            <td>GKP I</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_I_EX_ROW_SUGAR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>b. 5121</td>
            <td>HK tetes</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->HK_TETES,2); ?></td>
            <td></td>
            <td>b. 4121</td>
            <td>GKP II</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->GKP_II_EX_ROW_SUGAR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 5131</td>
            <td>Rendemen Winter</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->RENDEMEN_WINTER,2); ?></td>
            <td></td>
            <td>d. 4199</td>
            <td>Jumlah</td>
            <td align="right"><?php echo number_format($rincian_gula[0]->JUMLAH_EX_ROW_SUGAR,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>d. 5141</td>
            <td>Faktor Rendemen</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->FAKTOR_RENDEMEN,2); ?></td>
            <td>F.</td>
            <td>JUMLAH</td>
            <td></td>
            <td align="right"><?php echo number_format($rincian_gula[0]->JUMLAH,2); ?></td>
         </tr>
         <tr>
            <td>VI</td>
            <td>a. 6111</td>
            <td>Rendemen Ketel</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->RENDEMEN_KETEL,2); ?></td>
            <td>G.</td>
            <td>TETES HAK PETANI</td>
            <td></td>
            <td align="right"><?php echo number_format($rincian_gula[0]->TETES_HAK_PETANI,2); ?></td>
         </tr>
         <tr>
            <td></td>
            <td>b. 6121</td>
            <td>Kcal/brix n.mentah</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KCALBRIX_NMENTAH,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 6131</td>
            <td>Kg uap/Kg tebu</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KG_UAPKG_TEBU,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td>VII</td>
            <td colspan="3">PERSEDIAAN</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td colspan="3">a. Hasil Tahun Lalu :</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;7111</td>
            <td>TON GKP I</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->TON_GKP_I_LALU,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;7121</td>
            <td>TON GKP II</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->TON_GKP_II_LALU,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td colspan="3">b. Hasil Tahun Ini :</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;7211</td>
            <td>TON GKP I</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->TON_GKP_I_INI,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>&nbsp;&nbsp;&nbsp;7221</td>
            <td>TON GKP II</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->TON_GKP_II_INI,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 7311</td>
            <td>TON  TETES</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->TON_TETES_INI,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>d. 7411</td>
            <td>Lembar Karung</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->LEMBAR_KARUNG,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td>VIII</td>
            <td colspan="3">PEMB.HASIL (TON)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>a. 8111</td>
            <td>Kristal PG.</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KRISTAL_PG,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>b. 8121</td>
            <td>Kristal Petani</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KRISTAL_PETANI,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
         <tr>
            <td></td>
            <td>c. 8131</td>
            <td>Kristal Ex TS</td>
            <td align="right"><?php echo number_format($fabrikasi[0]->KRISTAL_EX_TS,2); ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
         </tr>
        
      </tbody>
   </table>
   </div>