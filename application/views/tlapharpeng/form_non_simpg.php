<section class="content-header">
    <h1>
        <?php echo $pageTitle ;?> 
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('tlapharpeng') ?>"><?php echo $pageTitle ?></a></li>
        <li class="active"> Form </li>
    </ol>
</section>


<section class="content">

<form action="<?php echo site_url('tlapharpeng/save'); ?>" method="post">
    <div class="row">
        <div class="col-md-6 col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="page-content-wrapper m-t">
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
                        <!-- hidden field -->
                        <input type="hidden" name="company_code" value="<?php echo CNF_COMPANYCODE;?>">
                        <input type="hidden" name="plant_code" value="<?php echo CNF_PLANCODE;?>">
                        <input type="hidden" name="thn_giling" value="<?php echo CNF_TAHUNGILING;?>">
                        <input type="hidden" name="id" value="">

                        <input type="hidden" name="sbh_tr_sd" id="sbh_tr_sd" value="">
                        <input type="hidden" name="sbh_tr_ts_saudara_sd" id="sbh_tr_ts_saudara_sd" value="">
                        <input type="hidden" name="sbh_ts_sd" id="sbh_ts_sd" value="">
                        <input type="hidden" name="sbh_ts_tr_sd" id="sbh_ts_tr_sd" value="">
                        <input type="hidden" name="sbh_ts_ts_saudara_sd" id="sbh_ts_ts_saudara_sd" value="">

                        <table class="tableizer-table">
                            <thead>
                            <tr>
                                    <td>&nbsp;Hari Giling</td>
                                    <td>
                                        <input type="text" id="hargil" required name="hari_giling" class='form-control input-sm' autocomplete="off"  onkeyup="gettglGiling(this.value,'0000-00-00',event)" />
                                    </td>
                                    <td>&nbsp;Tanggal</td>
                                    <td><input type="text" readonly tabindex="-1" required name="tgl_giling" id="tgl_giling" class='form-control input-sm' onchange="gettglGiling(0,this.value,)"/></td>
                                </tr>
                            <tr class="tableizer-firstrow">
                                <th>KETERANGAN</th>
                                <th>HI</th>
                                <th>YLL</th>
                                <th>SD. HI</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="color:red;font-weight:bold">
                                <td width="250px" colspan="2"> HEKTAR DITEBANG </td>
                                
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><input type="number" step="any" class="number" name="ha_tebang_ts" id="ha_tebang_ts" onkeyup="total1('ha_tebang_ts','ha_tebang_ts_saudara','ha_tebang_tr','ha_tebang_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_ts_sd" name="ha_tebang_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="ha_tebang_ts_saudara" id="ha_tebang_ts_saudara" onkeyup="total1('ha_tebang_ts','ha_tebang_ts_saudara','ha_tebang_tr','ha_tebang_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_ts_saudara_sd" name="ha_tebang_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="number" step="any"  class="number" name="ha_tebang_tr" id="ha_tebang_tr" onkeyup="total1('ha_tebang_ts','ha_tebang_ts_saudara','ha_tebang_tr','ha_tebang_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_tr_sd" name="ha_tebang_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" >
                                <td style="color:white;"> TOTAL </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="ha_tebang_total" readonly id="ha_tebang_total"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_tebang_total_sd" name="ha_tebang_total_sd" readonly></td>
                            </tr>
                            <tr style="color:red;font-weight:bold">
                                <td colspan="2"> TEBU DITEBANG </td>
                                
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><input type="number" step="any" class="number" name="ton_tebang_ts" id="ton_tebang_ts" onkeyup="total1('ton_tebang_ts','ton_tebang_ts_saudara','ton_tebang_tr','ton_tebang_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_ts_sd" name="ton_tebang_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="ton_tebang_ts_saudara" id="ton_tebang_ts_saudara" onkeyup="total1('ton_tebang_ts','ton_tebang_ts_saudara','ton_tebang_tr','ton_tebang_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_ts_saudara_sd" name="ton_tebang_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="number" step="any" class="number" name="ton_tebang_tr" id="ton_tebang_tr" onkeyup="total1('ton_tebang_ts','ton_tebang_ts_saudara','ton_tebang_tr','ton_tebang_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_tr_sd" name="ton_tebang_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" >
                                <td style="color:white;"> TOTAL </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="ton_tebang_total" readonly id="ton_tebang_total"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_tebang_total_sd" name="ton_tebang_total_sd" readonly></td>
                            </tr>
                            <tr style="color:red;font-weight:bold">
                                <td colspan="2"> HEKTAR DIGILING </td>
                                
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><input type="number" step="any" class="number" name="ha_giling_ts" id="ha_giling_ts" onkeyup="total1('ha_giling_ts','ha_giling_ts_saudara','ha_giling_tr','ha_giling_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_ts_sd" name="ha_giling_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="ha_giling_ts_saudara" id="ha_giling_ts_saudara" onkeyup="total1('ha_giling_ts','ha_giling_ts_saudara','ha_giling_tr','ha_giling_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_ts_saudara_sd" name="ha_giling_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="number" step="any" class="number" name="ha_giling_tr" id="ha_giling_tr" onkeyup="total1('ha_giling_ts','ha_giling_ts_saudara','ha_giling_tr','ha_giling_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_tr_sd" name="ha_giling_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" >
                                <td style="color:white;"> TOTAL </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="ha_giling_total" readonly id="ha_giling_total"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ha_giling_total_sd" name="ha_giling_total_sd" readonly></td>
                            </tr>
                            <tr style="color:red;font-weight:bold">
                                <td colspan="2"> TEBU DIGILING </td>
                                
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                           <tr>
                                <td> TS </td>
                                <td><input type="number" step="any" class="number" name="ton_giling_ts" id="ton_giling_ts" onkeyup="total1('ton_giling_ts','ton_giling_ts_saudara','ton_giling_tr','ton_giling_total');onkeyrendemen();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_ts_sd" name="ton_giling_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="ton_giling_ts_saudara" id="ton_giling_ts_saudara" onkeyup="total1('ton_giling_ts','ton_giling_ts_saudara','ton_giling_tr','ton_giling_total');onkeyrendemen();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_ts_saudara_sd" name="ton_giling_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="number" step="any" class="number"  name="ton_giling_tr" id="ton_giling_tr" onkeyup="total1('ton_giling_ts','ton_giling_ts_saudara','ton_giling_tr','ton_giling_total');onkeyrendemen();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_tr_sd" name="ton_giling_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" >
                                <td style="color:white;"> TOTAL </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="ton_giling_total" readonly id="ton_giling_total"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="ton_giling_total_sd" name="ton_giling_total_sd" readonly></td>
                            </tr>
                            

                            <tr style="color:red;font-weight:bold">
                                <td colspan="2"> KRISTAL </td>
                                
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                
                                <td><input type="number" step="any" class="number" name="kristal_ts" id="kristal_ts" onkeyup="total1('kristal_ts','kristal_ts_saudara','kristal_tr','kristal_total');onkeyrendemen();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_ts_sd" name="kristal_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="kristal_ts_saudara" id="kristal_ts_saudara"  onkeyup="total1('kristal_ts','kristal_ts_saudara','kristal_tr','kristal_total');onkeyrendemen();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_ts_saudara_sd" name="kristal_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="number" step="any" class="number" name="kristal_tr" id="kristal_tr"  onkeyup="total1('kristal_ts','kristal_ts_saudara','kristal_tr','kristal_total');onkeyrendemen();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_tr_sd" name="kristal_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" >
                                <td style="color:white;"> TOTAL </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="kristal_total" readonly id="kristal_total"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="kristal_total_sd" name="kristal_total_sd" readonly></td>
                            </tr>
                            
                            <tr style="color:red;font-weight:bold">
                                <td colspan="2"> RENDEMEN </td>
                                
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            
                            <tr>
                                <td> TS </td>
                                
                                <td><input type="number" step="any" class="number" name="rend_ts" id="rend_ts"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_ts_sd" name="rend_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="rend_ts_saudara" id="rend_ts_saudara"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_ts_saudara_sd" name="rend_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="number" step="any" class="number" name="rend_tr" id="rend_tr"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_tr_sd" name="rend_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" >
                                <td style="color:white;"> TOTAL </td>
                                <td><input type="number" step="any" class="number" name="rend_total"  id="rend_total"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="rend_total_sd" name="rend_total_sd" readonly></td>
                            </tr>

                            <tr style="color:red;font-weight:bold" >
                                <td colspan="2"> GULA BAGI HASIL </td>
                                
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><input type="number" step="any" class="number" name="gula_pg_ts" id="gula_pg_ts"  onkeyup="total1('gula_pg_ts','gula_pg_eks_ts_saudara','gula_pg_eks_tr','gula_pg_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_ts_sd" name="gula_pg_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> EKS. TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="gula_pg_eks_ts_saudara" id="gula_pg_eks_ts_saudara"  onkeyup="total1('gula_pg_ts','gula_pg_eks_ts_saudara','gula_pg_eks_tr','gula_pg_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_eks_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_eks_ts_saudara_sd" name="gula_pg_eks_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> EKS . TR </td>
                                <td><input type="number" step="any" class="number" name="gula_pg_eks_tr" id="gula_pg_eks_tr"  onkeyup="total1('gula_pg_ts','gula_pg_eks_ts_saudara','gula_pg_eks_tr','gula_pg_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_eks_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_eks_tr_sd" name="gula_pg_eks_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#ea6d6d">
                                <td style="color:white;font-weight:bold"> MILIK PG </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="gula_pg_total" id="gula_pg_total" readonly onchange="total1('gula_pg_total','gula_tr_ts_saudara','gula_tr_bagihasil','gula_produksi')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_pg_total_sd" name="gula_pg_total_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> MILIK TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="gula_tr_ts_saudara" id="gula_tr_ts_saudara" onkeyup="total1('gula_pg_total','gula_tr_ts_saudara','gula_tr_bagihasil','gula_produksi')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_tr_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_tr_ts_saudara_sd" name="gula_tr_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> MILIK TR </td>
                                <td><input type="number" step="any" class="number" name="gula_tr_bagihasil" id="gula_tr_bagihasil" onkeyup="total1('gula_pg_total','gula_tr_ts_saudara','gula_tr_bagihasil','gula_produksi')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_tr_bagihasil_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_tr_bagihasil_sd" name="gula_tr_bagihasil_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#036f06" >
                                <td style="color:white;font-weight:bold"> GULA PRODUKSI </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="gula_produksi" id="gula_produksi" onkeyup="isigulaproduksi()"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_produksi_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="gula_produksi_sd" name="gula_produksi_sd" readonly></td>
                            </tr>

                                <tr>
                                    <td>  Gula Ex.Sisan  </td>
                                    <td><input type="number" onkeyup="total1('gula_produksi','gula_ex_sisan','0','jml_gula_all');" step="any" class="number" name="gula_ex_sisan" id="gula_ex_sisan"></td>
                                    <td><input type="number" step="any" class="number" id="gula_ex_sisan_yl" readonly></td>
                                    <td><input type="number" step="any" class="number" id="gula_ex_sisan_sd" name="gula_ex_sisan_sd" readonly></td>
                                </tr>
                                <tr bgcolor="#3c8dbc" >
                                <td style="color:white;font-weight:bold">  TOTAL GULA </td>
                                    <td><input type="number" step="any" class="number" id="jml_gula_all"></td>
                                    <td><input type="number" step="any" class="number" id="jml_gula_all_yl" readonly></td>
                                    <td><input type="number" step="any" class="number" id="jml_gula_all_sd"  readonly></td>
                                </tr>
                                <tr>
                                    <td> Sisan diolah </td>
                                    <td><input type="number" step="any" class="number" onkeyup="total1('sisan_diolah','0','0','0')" name="sisan_diolah" id="sisan_diolah"></td>
                                    <td><input type="number" step="any" class="number" id="sisan_diolah_yl" readonly></td>
                                    <td><input type="number" step="any" class="number" id="sisan_diolah_sd" name="sisan_diolah_sd" readonly></td>
                                </tr>
                            <tr style="color:red;font-weight:bold">
                                <td colspan="2"> TEBU TERBAKAR </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><input type="number" step="any" class="number" name="tebu_terbakar_ts" id="tebu_terbakar_ts"  onkeyup="total1('tebu_terbakar_ts','tebu_terbakar_ts_saudara','tebu_terbakar_tr','tebu_terbakar_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_ts_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_ts_sd" name="tebu_terbakar_ts_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="number" step="any" class="number" name="tebu_terbakar_ts_saudara" id="tebu_terbakar_ts_saudara" onkeyup="total1('tebu_terbakar_ts','tebu_terbakar_ts_saudara','tebu_terbakar_tr','tebu_terbakar_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_ts_saudara_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_ts_saudara_sd" name="tebu_terbakar_ts_saudara_sd" readonly></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="number" step="any" class="number" name="tebu_terbakar_tr" id="tebu_terbakar_tr" onkeyup="total1('tebu_terbakar_ts','tebu_terbakar_ts_saudara','tebu_terbakar_tr','tebu_terbakar_total')"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_tr_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_tr_sd" name="tebu_terbakar_tr_sd" readonly></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" >
                                <td style="color:white;font-weight:bold"> TOTAL </td>
                                <td><input type="number" step="any" class="number" tabindex="-1" name="tebu_terbakar_total" id="tebu_terbakar_total"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_total_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="tebu_terbakar_total_sd" name="tebu_terbakar_total_sd" readonly></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-12">
            <div class="box box-danger">


                <div class="box-body">

                    <div class="page-content-wrapper m-t">
                            <table class="tableizer-table">
                                <thead>
                                <tr class="tableizer-firstrow">
                                    <th>KETERANGAN</th>
                                    <th>HI</th>
                                    <th>YLL</th>
                                    <th>SD. HI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="250px"> Jam berht.A </td>
                                    <td><input type="number" step="any" class="number" name="jam_berhenti_a" id="jam_berhenti_a" onkeyup="total1('jam_berhenti_a','jam_berhenti_b','0','total_jb');hitungjamgiling();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="jam_berhenti_a_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="jam_berhenti_a_sd" name="jam_berhenti_a_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td width="250px"> Jam berht.B </td>
                                   <td><input type="number" step="any" class="number"   name="jam_berhenti_b" id="jam_berhenti_b" onkeyup="total1('jam_berhenti_a','jam_berhenti_b','0','total_jb');hitungjamgiling();"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="jam_berhenti_b_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="jam_berhenti_b_sd" name="jam_berhenti_b_sd" readonly></td>
                                </tr>

                                <tr>
                                    <td>  Keterangan JB </td>
                                    <td colspan="3"><input type="text" placeholder="Keterangan berhenti"  name="keterangan_jb" id="keterangan_jb" style="width: 100%"></td>
                                </tr>

                                <tr bgcolor="#3c8dbc" >
                                <td style="color:white;font-weight:bold">  A + B </td>
                                    
                                  <td><input type="number" readonly step="any" class="number" tabindex="-1"  name="total_jb" id="total_jb"></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="total_jb_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="total_jb_sd"  name="total_jb_sd" readonly></td>
                                </tr>
                                <tr bgcolor="#ea6d6d">
                                    <td style="color:white;font-weight:bold"> Jam Berhnt. HR</td>
                                    <td><input type="number" step="any" class="number"  name="jb_hr" id="jb_hr" onkeyup="total1('jb_hr','0','0','0');hitungjamgiling();"></td>
                                    <td><input type="number" step="any" class="number" tabindex="-1" id="jb_hr_yl" readonly></td>
                                    <td><input type="number" step="any" class="number" tabindex="-1" id="jb_hr_sd" name="jb_hr_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> Jam gil. </td>
                                    <td><input type="number" step="any" class="number" tabindex="-1" name="jam_giling" id="jam_giling" readonly ></td>
                                <td><input type="number" step="any"  class="number" tabindex="-1" id="jam_giling_yl" readonly></td>
                                <td><input type="number" step="any" class="number" tabindex="-1" id="jam_giling_sd" name="jam_giling_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> Jam kamp. </td>
                                    <td><input type="number" onkeyup="hitungjamgiling();" step="any" class="number" name="jam_kampanye" id="jam_kampanye"></td>
                                	<td><input type="number" step="any" class="number" tabindex="-1" id="jam_kampanye_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" tabindex="-1" id="jam_kampanye_sd" name="jam_kampanye_sd" readonly></td>
                                </tr>
                                <tr bgcolor="#ea6d6d">
                                    <td style="color:white;font-weight:bold"> Jam kamp. HR </td>
                                    <td><input type="number" onkeyup="hitungjamgiling();" readonly step="any" class="number" name="jam_kampanye_hr" id="jam_kampanye_hr"></td>
                                    <td><input type="number" step="any" class="number" tabindex="-1" id="jam_kampanye_hr_yl" readonly></td>
                                    <td><input type="number" step="any" class="number" tabindex="-1" id="jam_kampanye_hr_sd" name="jam_kampanye_hr_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr bgcolor="#3c8dbc">
                                    <td style="color:white;font-weight:bold"> K.I.S. Exlusif HR</td>
                                    <td><input type="number" readonly step="any"  tabindex="-1" class="number" name="kis" id="kis"></td>
                                	<td><input type="number" step="any" class="number" tabindex="-1" id="kis_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" tabindex="-1" id="kis_sd" name="kis_sd" readonly></td>
                                </tr>

                                <tr bgcolor="#ea6d6d">
                                    <td style="color:white;font-weight:bold"> K.I.S. Inclusif HR</td>
                                    <td><input type="number" readonly step="any"  tabindex="-1" class="number" name="kis_inc" id="kis_inc"></td>
                                    <td><input type="number" step="any" class="number" tabindex="-1" id="kis_inc_yl" readonly></td>
                                    <td><input type="number" step="any" class="number" tabindex="-1" id="kis_inc_sd" name="kis_inc_sd" readonly></td>
                                </tr>

                                <tr bgcolor="#3c8dbc">
                                    <td style="color:white;font-weight:bold"> K.E.S. </td>
                                    <td><input type="number" readonly step="any"  tabindex="-1" class="number" name="kes" id="kes"></td>
                                	<td><input type="number" step="any" class="number" tabindex="-1" id="kes_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" tabindex="-1" id="kes_sd" name="kes_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> A% J.gl. </td>
                                    <td><input type="number" step="any" readonly class="number" name="jba_persen_jamgil" id="jba_persen_jamgil"></td>
                                	<td><input type="number" step="any" class="number" id="jba_persen_jamgil_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="jba_persen_jamgil_sd" name="jba_persen_jamgil_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> B% J.gl. </td>
                                    <td><input type="number" step="any" readonly class="number" name="jbb_persen_jamgil" id="jbb_persen_jamgil"></td>
                                	<td><input type="number" step="any" class="number" id="jbb_persen_jamgil_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="jbb_persen_jamgil_sd" name="jbb_persen_jamgil_sd" readonly></td>
                                </tr>


                                <tr bgcolor="#3c8dbc" >
                                <td style="color:white;font-weight:bold"> A  +  B </td>
                                    <td><input type="number" step="any" readonly class="number" name="total_persen_jamgil" id="total_persen_jamgil"></td>
                                	<td><input type="number" step="any" class="number" id="total_persen_jamgil_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="total_persen_jamgil_sd" name="total_persen_jamgil_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                
                                <tr>
                                    <td> Tetes Produksi </td>
                                    
                                    <td><input type="number" step="any" class="number" name="tetes_produksi" id="tetes_produksi" onkeyup="total1('tetes_produksi','tetes_sisan','tetes_sto','tetes_total',0,'tetes_ex_repro')"></td>
                                	<td><input type="number" step="any" class="number" id="tetes_produksi_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="tetes_produksi_sd" name="tetes_produksi_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> Tetes Ex.Sisan  </td>
                                    <td><input type="number" step="any" class="number" onkeyup="total1('tetes_produksi','tetes_sisan','tetes_sto','tetes_total',0,'tetes_ex_repro')" name="tetes_sisan" id="tetes_sisan"></td>
                                	<td><input type="number" step="any" class="number" id="tetes_sisan_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="tetes_sisan_sd" name="tetes_sisan_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> Tetes STO  </td>
                                    <td><input type="number" step="any" class="number" onkeyup="total1('tetes_produksi','tetes_sisan','tetes_sto','tetes_total',0,'tetes_ex_repro')" name="tetes_sto" id="tetes_sto"></td>
                                	<td><input type="number" step="any" class="number" id="tetes_sto_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="tetes_sto_sd" name="tetes_sto_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> Tetes Ex. Repro Tahun Lalu </td>
                                    
                                    <td><input type="number" step="any" class="number" onkeyup="total1('tetes_produksi','tetes_sisan','tetes_sto','tetes_total',0,'tetes_ex_repro')" name="tetes_ex_repro" id="tetes_ex_repro" ></td>
                                	<td><input type="number" step="any" class="number" id="tetes_ex_repro_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="tetes_ex_repro_sd" name="tetes_ex_repro_sd" readonly></td>
                                </tr>
                                <tr bgcolor="#3c8dbc" >
                                <td style="color:white;font-weight:bold">  JUMLAH TETES </td>
                                    
                                    <td><input type="number" step="any" class="number" readonly name="tetes_total" id="tetes_total"></td>
                                	<td><input type="number" step="any" class="number" id="tetes_total_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="tetes_total_sd" name="tetes_total_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> RESIDU (Liter) </td>
                                    <td><input type="number" step="any" class="number" name="residu" id="residu" onkeyup="total1('residu','0','0','0')"></td>
                                    <td><input type="number" step="any" class="number" id="residu_yl" readonly></td>
                                    <td><input type="number" step="any" class="number" id="residu_sd" name="residu_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> TON BBA </td>
                                    <td><input type="number" step="any" class="number" name="bba_ton" id="bba_ton" onkeyup="total1('bba_ton','0','0','0')"></td>
                                	<td><input type="number" step="any" class="number" id="bba_ton_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="bba_ton_sd" name="bba_ton_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> RUPIAH BBA </td>
                                    <td><input type="number" step="any" class="number" name="bba_rupiah" id="bba_rupiah" onkeyup="total1('bba_rupiah','0','0','0')"></td>
                                	<td><input type="number" step="any" class="number" id="bba_rupiah_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="bba_rupiah_sd" name="bba_rupiah_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> GULA REPRO tahun lalu </td>
                                    
                                    <td><input type="number" step="any" class="number" onkeyup="total1('gula_repro_thn_lalu','0','0','0')"  name="gula_repro_thn_lalu" id="gula_repro_thn_lalu"></td>
                                	<td><input type="number" step="any" class="number" id="gula_repro_thn_lalu_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="gula_repro_thn_lalu_sd" name="gula_repro_thn_lalu_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> RAW SUGAR </td>
                                    
                                    <td><input type="number" step="any" class="number" name="raw_sugar_diolah" id="raw_sugar_diolah" onkeyup="total1('raw_sugar_diolah','0','0','0')"></td>
                                	<td><input type="number" step="any" class="number" id="raw_sugar_diolah_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="raw_sugar_diolah_sd" name="raw_sugar_diolah_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td> GULA REPRO tahun ini </td>
                                    
                                    <td><input type="number" step="any" class="number" name="gula_repro_thn_ini" id="gula_repro_thn_ini"  onkeyup="total1('gula_repro_thn_ini','0','0','0')"></td>
                                	<td><input type="number" step="any" class="number" id="gula_repro_thn_ini_yl" readonly></td>
                                	<td><input type="number" step="any" class="number" id="gula_repro_thn_ini_sd" name="gula_repro_thn_ini_sd" readonly></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>  TON AMPAS </td>
                                    <td><input type="number" step="any" class="number" name="ampas_ton" id="ampas_ton"></td>
                                    <td>  </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td> % Pol AMPAS </td>
                                    <td><input type="number" step="any" class="number" name="persen_pol_ampas" id="persen_pol_ampas"></td>
                                    <td>  </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> TON BLOTONG </td>
                                    <td><input type="number" step="any" class="number" name="blotong_ton" id="blotong_ton"></td>
                                    <td>  </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td> % POL BLOTONG </td>
                                    <td><input type="number" step="any" class="number" name="persen_pol_blotong" id="persen_pol_blotong"></td>
                                    <td>  </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> TON POL DALAM HASIL + TAKSASI </td>
                                    <td><input type="number" step="any" class="number" name="pol_dlm_hasil_taksasi_ton" id="pol_dlm_hasil_taksasi_ton"></td>
                                    <td>  </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td> % POL DALAM HASIL + TAKSASI </td>
                                    <td><input type="number" step="any" class="number" name="pol_dlm_hasil_taksasi_persenpol" id="pol_dlm_hasil_taksasi_persenpol"></td>
                                    <td>  </td>
                                    <td> </td>
                                </tr>

                                <tr>
                                    <td> ICUMSA </td>
                                    <td><input type="number" step="any" class="number" name="icumsa" id="icumsa"></td>
                                    <td>  </td>
                                    <td> </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                
                                </tbody>
                            </table>
                            <div class="toolbar-line text-center">
                                <input type="submit" class="btn btn-primary btn-sm" value="Simpan" />
                                <a href="<?php echo site_url('tlapharpeng');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</section>
<script type="text/javascript">
    $(document).ready(function() {
       $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }


    $('input').each(function() {
    var readonly = $(this).attr("readonly");
    if(readonly && readonly.toLowerCase()!=='false') { // this is readonly
        $(this).css("background", "rgb(224, 255, 227)");
    }
});


  });
    });

    var gulatr = 0; var gulatrtssaudara=0;var gulats=0;gulatstr=0;gulatstssaudara=0;
    function gettglGiling(hg){

        if(hg != '' || hg != 0){
        $.ajax({
       type: 'POST',
          url: '<?php echo site_url('tlapharpeng/getharitglgiling');?>/'+hg, 
          dataType : 'json',
          success: function (data) {
           // alert(data.hg);

           gulatr = data.skgsbh.sbh_tr_sd;
           gulatrtssaudara = data.skgsbh.sbh_tr_ts_saudara_sd;
           gulats = data.skgsbh.sbh_ts_sd;
           gulatstr = data.skgsbh.sbh_ts_tr_sd;
           gulatstssaudara = data.skgsbh.sbh_ts_ts_saudara_sd;

           $('#sbh_tr_sd').val(gulatr);
           $('#sbh_tr_ts_saudara_sd').val(gulatrtssaudara);
           $('#sbh_ts_sd').val(gulats);
           $('#sbh_ts_tr_sd').val(gulatstr);
           $('#sbh_ts_ts_saudara_sd').val(gulatstssaudara);


            $.each(data.col,function(k,v){
                    //  console.log(k+" : "+ v);  
                    $('#'+v.Field).val('');   
            });

            $.each(data.yl,function(k,v){
                    //  console.log(k);  
                    $('#'+k+'_yl').val(v);   
            });

            //kis kes yng lalu
            
        var tebugilingsdyl = $('#ton_giling_total_yl').val();
        var jksdyl = $('#jam_kampanye_yl').val();
        var jkhrsdyl = $('#jam_kampanye_hr_yl').val();
        var jgsdyl = $('#jam_giling_yl').val();

        //sd
        var faktorjam = 24;
        if($('#hargil').val() == 2){
            faktorjam = jksdyl;
        }

        var kissdyl = faktorjam*tebugilingsdyl/jksdyl;
        var kishrsdyl = faktorjam*tebugilingsdyl/jkhrsdyl;
        var kessdyl = faktorjam*tebugilingsdyl/jgsdyl;


        $('#kis_yl').val(kissdyl.toFixed(2));
        $('#kis_inc_yl').val(kishrsdyl.toFixed(2));
        $('#kes_yl').val(kessdyl.toFixed(2));



            $.each(data.skg,function(k,v){
                    //  console.log(k+" : "+ v);  
                    $('#'+k).val(v);   
            });

            //datasbh
            $.each(data.col,function(k,v){
                    if(v.Field != 'rend_ts' && v.Field != 'rend_tr' && v.Field != 'rend_ts_saudara'&& v.Field != 'rend_total_sd'){
                    if($('#'+v.Field+'_yl').val() == '') $('#'+v.Field+'_yl').val(0);
                    var tempsd = parseFloat($('#'+v.Field+'').val()) + parseFloat($('#'+v.Field+'_yl').val());

                    $('#'+v.Field+'_sd').val(tempsd.toFixed(3)); 
                    }else{
                        var kristalsdts = parseFloat($('#kristal_ts_sd').val());
                        var tongilingsdts = parseFloat($('#ton_giling_ts_sd').val());
                        var rendts = ((kristalsdts/tongilingsdts)*100).toFixed(2);

                        var kristalsdtssaudara = parseFloat($('#kristal_ts_saudara_sd').val());
                        var tongilingsdsaudara = parseFloat($('#ton_giling_ts_saudara_sd').val());
                        var rendtssaudara = ((kristalsdtssaudara/tongilingsdsaudara)*100).toFixed(2);

                        var kristassdtr = parseFloat($('#kristal_tr_sd').val());
                        var tongilingtr = parseFloat($('#ton_giling_tr_sd').val());
                        var rendtr = ((kristassdtr/tongilingtr)*100).toFixed(2);

                        var kristalsd = parseFloat($('#kristal_total_sd').val());
                        var tongilingsd = parseFloat($('#ton_giling_total_sd').val());
                        var redall = ((kristalsd/tongilingsd)*100).toFixed(2);
                        $('#rend_ts_sd').val(rendts);
                        $('#rend_ts_saudara_sd').val(rendtssaudara);
                        $('#rend_tr_sd').val(rendtr);
                        $('#rend_total_sd').val(redall);
                    }  
            });

            $.each(data.skgsbh,function(k,v){
                  //  console.log(k+" : "+ v);  
                    $('#'+k).val(v);   
            });

            total1('ha_giling_ts','ha_giling_ts_saudara','ha_giling_tr','ha_giling_total');
            total1('ton_giling_ts','ton_giling_ts_saudara','ton_giling_tr','ton_giling_total');
            total1('kristal_ts','kristal_ts_saudara','kristal_tr','kristal_total');
            total1('ha_tebang_ts','ha_tebang_ts_saudara','ha_tebang_tr','ha_tebang_total');
            total1('ton_tebang_ts','ton_tebang_ts_saudara','ton_tebang_tr','ton_tebang_total');
            total1('tebu_terbakar_ts','tebu_terbakar_ts_saudara','tebu_terbakar_tr','tebu_terbakar_total');

                      
            //rendemen
            hitungrendemen('ton_giling_ts','kristal_ts','rend_ts');
            hitungrendemen('ton_giling_tr','kristal_tr','rend_tr');
            hitungrendemen('ton_giling_ts_saudara','kristal_ts_saudara','rend_ts_saudara');
            hitungrendemen('ton_giling_total','kristal_total','rend_total');

            hitungjamgiling();

            //end data sbh

            $("#hari_giling").val(data.head.hg);
            $("#tgl_giling").val(data.head.tgl);
            }
            });
        }
    }

    function onkeyrendemen(){
            hitungrendemen('ton_giling_ts','kristal_ts','rend_ts');
            hitungrendemen('ton_giling_tr','kristal_tr','rend_tr');
            hitungrendemen('ton_giling_ts_saudara','kristal_ts_saudara','rend_ts_saudara');
            hitungrendemen('ton_giling_total','kristal_total','rend_total');
    }

    function hitungrendemen(v1,v2,v3){
        hitungrendemensd(v1,v2,v3);
        v1 = parseFloat($('#'+v1).val());
        v2 = parseFloat($('#'+v2).val());
        var rv3 = v2/v1*100;
        $('#'+v3).val(rv3.toFixed(2));
    }

    function hitungrendemensd(v1,v2,v3){
        //alert(v2/v1*100+' '+v3+'_sd');

        v1 = parseFloat($('#'+v1+'_sd').val());
        v2 = parseFloat($('#'+v2+'_sd').val());
        var rv3 = v2/v1*100;

        $('#'+v3+'_sd').val(rv3.toFixed(2));
    }

    //hektar tebang
    function total1(v1,v2,v3,vtotal,opt=0,v4=0) {
        v1v = $('#'+v1).val(); if(v1v == '' || v1 == '0') v1v=0;
        v2v = $('#'+v2).val(); if(v2v == '' || v2 == '0') v2v=0;
        v3v = $('#'+v3).val(); if(v3v == '' || v3 == '0') v3v=0;
        v4v = $('#'+v4).val(); if(v4v == '' || v4 == '0') v4v=0;

        vtot =  parseFloat(v1v)+parseFloat(v2v)+parseFloat(v3v)+parseFloat(v4v);
        if(opt==0){
            $('#'+vtotal).val(vtot.toFixed(3));
        }
        // body...
        hitungsd(v1,v2,v3,vtotal,v4);
    }

    function hitungsd(v1,v2,v3,vtotal,v4=0){
        v1hi = $('#'+v1).val(); if(v1hi == '' || v1 == '0') v1hi=0;
        v2hi = $('#'+v2).val(); if(v2hi == '' || v2 == '0') v2hi=0;
        v3hi = $('#'+v3).val(); if(v3hi == '' || v3 == '0') v3hi=0;
        v4hi = $('#'+v4).val(); if(v4hi == '' || v4 == '0') v4hi=0;

        v1yl = $('#'+v1+'_yl').val(); if(v1yl == '' || v1 == '0') v1yl=0;
        v2yl = $('#'+v2+'_yl').val(); if(v2yl == '' || v2 == '0') v2yl=0;
        v3yl = $('#'+v3+'_yl').val(); if(v3yl == '' || v3 == '0') v3yl=0;
        v4yl = $('#'+v4+'_yl').val(); if(v4yl == '' || v4 == '0') v4yl=0;

        v1sd = parseFloat(v1hi)+parseFloat(v1yl);
        v2sd = parseFloat(v2hi)+parseFloat(v2yl);
        v3sd = parseFloat(v3hi)+parseFloat(v3yl);
        v4sd = parseFloat(v4hi)+parseFloat(v4yl);

        $('#'+v1+'_sd').val(parseFloat(v1sd).toFixed(3));
        $('#'+v2+'_sd').val(parseFloat(v2sd).toFixed(3));
        $('#'+v3+'_sd').val(parseFloat(v3sd).toFixed(3));
        $('#'+v4+'_sd').val(parseFloat(v4sd).toFixed(3));
        var ttlsd = v1sd+v2sd+v3sd+v4sd;
        $('#'+vtotal+'_sd').val(parseFloat(ttlsd).toFixed(3));
    }

    function isigulaproduksi(){
        var prod = parseFloat($('#gula_produksi').val());
        var prodtryl = parseFloat($('#gula_tr_bagihasil_yl').val());
        var prodtsextryl = parseFloat($('#gula_pg_eks_tr_yl').val());

        var tothutangtr = gulatr-prodtryl;
        var xgulatstr = gulatstr - prodtsextryl;
       // console.log(tothutangtr);
        var tempgula=0;
        if(tothutangtr < prod){
                $('#gula_tr_bagihasil').val(tothutangtr.toFixed(3));
            tempgula = prod - tothutangtr;
            if(tempgula > xgulatstr){
                $('#gula_pg_eks_tr').val(xgulatstr.toFixed(3));
                tempgula = tempgula - xgulatstr;
                $('#gula_pg_ts').val(tempgula.toFixed(3));
            }else{
                $('#gula_pg_eks_tr').val(tempgula.toFixed(3));
                $('#gula_pg_ts').val(0);
            }
        }else{
            $('#gula_tr_bagihasil').val(prod.toFixed(3));
            $('#gula_pg_eks_tr').val(0);
            $('#gula_pg_ts').val(0);
        }
        
        total1('gula_pg_ts','gula_pg_eks_ts_saudara','gula_pg_eks_tr','gula_pg_total');
        total1('gula_pg_total','gula_tr_ts_saudara','gula_tr_bagihasil','gula_produksi',1);
        total1('gula_produksi','gula_ex_sisan','0','jml_gula_all');
    }


    function hitungjamgiling(v=''){

        var jbhrx = $('#jb_hr').val(); if(jbhrx == '') jbhrx=0;

        var jkhrinc = parseFloat(jbhrx)+parseFloat($('#jam_kampanye').val());
        $('#jam_kampanye_hr').val(jkhrinc.toFixed(2));

        var jkyll = $('#jam_kampanye_yl').val(); if(jkyll == '') jkyll=0;
        var jgyll = $('#jam_giling_yl').val(); if(jgyll == '') jgyll=0;
        var jkhryll = $('#jam_kampanye_hr_yl').val(); if(jkhryll == '') jkhryll=0;


        var tebugiling = $('#ton_giling_total').val();
        var tebugilingsd = $('#ton_giling_total_sd').val();

        var jamkampanye = $('#jam_kampanye').val(); if(jamkampanye == '') jamkampanye=0;
        var jamkampanyehr = $('#jam_kampanye_hr').val(); if(jamkampanyehr == '') jamkampanyehr=0;

        var jksd = parseFloat(jkyll)+parseFloat(jamkampanye);

        


        $('#jam_kampanye_sd').val(jksd.toFixed(2));
        //$('#jam_kampanye_hr_sd').val(jkhrsd.toFixed(2));
        hitungsd('jam_kampanye_hr','0','0','0');

        

        
        var totjamberhenti = $('#total_jb').val(); if(totjamberhenti == '') totjamberhenti=0;
        var totjamberhentihr = $('#jb_hr').val(); if(totjamberhentihr == '') totjamberhentihr=0;

        var jamgiling = parseFloat(jamkampanye)-parseFloat(totjamberhenti);
        $('#jam_giling').val(parseFloat(jamgiling).toFixed(2));
        var jgsd = parseFloat(jamgiling)+parseFloat(jgyll);
        $('#jam_giling_sd').val(jgsd.toFixed(2));

        var kis=0;
        var kes = 0;
        var kishr = 0;
        
        if(tebugiling != 0){
            kis = (jamkampanye*tebugiling/jamkampanye).toFixed(2);
            kishr = (jamkampanyehr*tebugiling/jamkampanyehr).toFixed(2);
            kes = (jamkampanye*tebugiling/jamgiling).toFixed(2);
            $('#kis').val(kis);
            $('#kis_inc').val(kishr);
            $('#kes').val(kes);
        }

        var jkhrsd = parseFloat($('#jam_kampanye_hr_sd').val());
        var faktorjam = 24;
        if($('#hargil').val() == 1){
            faktorjam = jamkampanye;
        }

        //sd
        var kissd= faktorjam*tebugilingsd/jksd;
        var kishrsd= faktorjam*tebugilingsd/jkhrsd;
        var kessd = faktorjam*tebugilingsd/jgsd;

        
        $('#kis_sd').val(kissd.toFixed(2));
        $('#kis_inc_sd').val(kishrsd.toFixed(2));
        $('#kes_sd').val(kessd.toFixed(2));

        hitungpersenjamberhenti();
        hitungpersenjamberhenti('_yl');
        hitungpersenjamberhenti('_sd');

    }

    function hitungpersenjamberhenti(v=''){
        var jba = $('#jam_berhenti_a'+v).val(); if(jba == '') jba=0;
        var jbb = $('#jam_berhenti_b'+v).val(); if(jbb == '') jbb=0;
        var jamgiling = $('#jam_giling'+v).val(); if(jamgiling == '') jamgiling=0;

        var pa = parseFloat(jba/jamgiling).toFixed(2);
        var pb = parseFloat(jbb/jamgiling).toFixed(2);

        $('#jba_persen_jamgil'+v).val(parseFloat(pa).toFixed(2));
        $('#jbb_persen_jamgil'+v).val(parseFloat(pb).toFixed(2));
        
        total1('jba_persen_jamgil','jbb_persen_jamgil','0','total_persen_jamgil');

    }


    //tebu tebang
    //hektar giling
    //tebu giling
    //kristal
    //rendemen
    //gula hasil
    //tebu terbakar

</script>

