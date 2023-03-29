<section class="content-header">
    <h1>
        Laporan Hasil Pasti Pabrik Gula
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('tlapharpeng') ?>">HAPAS PTPN</a></li>
        <li class="active"> Form </li>
    </ol>
</section>

<?
$gid = $this->session->userdata('gid');
$tan = '';$peng='';
if( $gid == '11' ){
$tan = '';$peng='display:none;';
}else if($gid == '10'){
$tan = 'display:none;';$peng='';
}
?>
<section class="content">

<form action="<?php echo site_url('thapas/save'); ?>" method="post" id="frmlap">
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
                                padding: 2px;
                                margin: 3px;
                                border: 1px solid #CCC;
                            }
                            .tableizer-table th {
                                background-color: #104E8B;
                                color: #FFF;
                                font-weight: bold;
                                height:25px;padding:10px;
                            }
                            .number{
                                width: 150px
                            }
                        </style>
                        <!-- hidden field -->
                        <input type="hidden" name="company_code" value="<?php echo CNF_COMPANYCODE;?>">
                        <input type="hidden" name="plant_code" value="<?php echo CNF_PLANCODE;?>">
                        <input type="hidden" name="thn_giling" value="<?php echo CNF_TAHUNGILING;?>">
                        <input type="hidden" name="id" value="<?=$row->id;?>">
                        <?php
                        $sql = "select concat(IF(LEFT(kode_kat_lahan,5) = 'TS-ST','TS',IF(LEFT(kode_kat_lahan,5) = 'TS-SP','TR',LEFT(kode_kat_lahan,2))),'-TR') as kode,kode_plant_trasnfer from t_spta where kode_plant_trasnfer != kode_plant and kode_plant_trasnfer != '' and sbh_status > 0 group by IF(LEFT(kode_kat_lahan,5) = 'TS-ST','TS',IF(LEFT(kode_kat_lahan,5) = 'TS-SP','TR',LEFT(kode_kat_lahan,2))),kode_plant_trasnfer order by kode_plant_trasnfer asc";
                        $a = $this->db->query($sql)->result();
                        $transfer = array();
                        foreach($a as $b){
                            $transfer[$b->kode][] = $b->kode_plant_trasnfer;
                        }


                        
                       // var_dump($transfer);
                        ?>

<table class="tableizer-table">
                            <thead>
                            <tr>
                                    <td>&nbsp;Tgl Awal Giling</td>
                                    <td>
                                        <input type="date" id="tgl_awal" required name="tgl_awal" class='form-control input-sm' autocomplete="off"  onkeyup="" readonly value="<?=PN_AWAL_GILING;?>" />
                                    </td>
                                
                                    <td>&nbsp;Tanggal Akhir Giling</td>
                                    <td><input type="date" required onchange="gethari()" name="tgl_akhir" id="tgl_akhir" class='form-control input-sm' value="<?=$row->tgl_akhir;?>" /></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;Stop HR. Idul Fitri</td>
                                    <td>
                                        <input type="date" id="tgl_stop_hif"  name="tgl_stop_hif" class='form-control input-sm' autocomplete="off" value="<?=$row->tgl_stop_hif;?>"  />
                                    </td>
                                
                                    <td>&nbsp;Start HR. Idul Fitri</td>
                                    <td><input type="date"  name="tgl_start_hif" id="tgl_start_hif" class='form-control input-sm'
                                        value="<?=$row->tgl_start_hif;?>"/></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;Stop HR. Idul Adha</td>
                                    <td>
                                        <input type="date" id="tgl_stop_hia"  name="tgl_stop_hia" class='form-control input-sm' autocomplete="off" value="<?=$row->tgl_stop_hia;?>"  />
                                    </td>
                                
                                    <td>&nbsp;Start HR. Idul Adha</td>
                                    <td><input type="date"  name="tgl_start_hia" id="tgl_start_hia" class='form-control input-sm'
                                    value="<?=$row->tgl_start_hia;?>" /></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;Hr. Penyelesaian</td>
                                    <td>
                                        <input type="text" id="jml_hari_penyelesaian" required name="jml_hari_penyelesaian" class='form-control input-sm' autocomplete="off" value="<?=$row->jml_hari_penyelesaian;?>"  />
                                    </td>
                                
                                    <td>&nbsp;Jml Hr. Giling Inc. JB</td>
                                    <td><input type="text"  required name="jml_hari_gil_inc_jb" id="jml_hari_gil_inc_jb" class='form-control input-sm' value="<?=$row->jml_hari_gil_inc_jb;?>" /></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center"><a href="javascript:getData()" class="btn btn-primary">AMBIL DATA</a></td>
                                </tr>
                            </thead>
                        </table>
                                <table class="tableizer-table" style="<?=$tan;?>">
                            <tr class="tableizer-firstrow">
                                <th colspan="4">LUAS HEKTAR</th>
                            </tr>
                            
                            <?php
                            //luas
                            $th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01%' order by kode")->result();
                            foreach ($th as $ks) {
                                if($ks->parent == '' && $ks->jenis == 0){
                                    ?>
                            <tr style="color:red;font-weight:bold"><td width="250px" colspan="4"> <?=$ks->uraian;?> </td></tr>
                                    <?
                                }else if($ks->jenis == 2){
                                    ?>
                            <tr><td colspan="3" style="color: blue"><b> <?=$ks->uraian;?> </b></td><td><input type="number" step="any" class="number <?=$ks->parent;?>_luas"  id="<?=$ks->kode;?>_luas" name="<?=$ks->kode;?>_luas" readonly style="background-color: red;color:white" value="<?=$ks->luas;?>"></td></tr>
                                    <?
                                }else if($ks->jenis == 3){
                                    ?>
                            <tr style="background-color: orange"><td colspan="3" style="color: black"><b> <?=$ks->uraian;?> </b></td><td><input type="number" step="any" class="number <?=$ks->parent;?>_luas"  id="<?=$ks->kode;?>_luas" name="<?=$ks->kode;?>_luas" readonly style="background-color: black;color:white" value="<?=$ks->luas;?>"></td></tr>
                                    <?
                                }else if($ks->jenis == 0){
                                    ?>
                            <tr><td colspan="3"> <?=$ks->uraian;?> </td><td><input type="number" step="any" class="number <?=$ks->parent;?>_luas"  id="<?=$ks->kode;?>_luas" name="<?=$ks->kode;?>_luas" readonly style="background-color: yellow" value="<?=$ks->luas;?>"></td></tr>
                                    <?
                                }else{
                                    $pg = '';$ro = 'readonly';$kodep = '';
                                    if($ks->transfer != '0'){

                                        if(isset($transfer[$ks->kategori][$ks->transfer-1])){
                                            $kodep=$transfer[$ks->kategori][$ks->transfer-1];
                                            $pg = $kontrol->getnamaunit($kodep);
                                            $ro = '';
                                        }
                                        ?>
                                        <input type="hidden" name="<?=$ks->kode;?>_plant" value="<?=$kodep;?>">
                                <tr><td colspan="3"> <?=$ks->uraian.' '.$pg ;?>  </td><td><input type="number" step="any" class="number <?=$ks->parent;?>_luas"  value="<?=$ks->luas;?>" id="<?=$ks->kode;?>_luas<?=$kodep;?>" name="<?=$ks->kode;?>_luas" <?=$ro;?>></td></tr>  
                                <?
                                    }else{
                                    ?>
                            <tr><td colspan="3"> <?=$ks->uraian;?> </td><td><input type="number" step="any" class="number <?=$ks->parent;?>_luas"  id="<?=$ks->kode;?>_luas" value="<?=$ks->luas;?>" name="<?=$ks->kode;?>_luas"></td></tr>       
                                    <?
                                }
                                }
                            }
                            ?>
                         </table>
                                <table class="tableizer-table" style="<?=$peng;?>">
                            <tr class="tableizer-firstrow">
                                <th colspan="4">TON TEBU GILING</th>
                            </tr>
                            </thead>
                            <?php
                            //ton tebu giling
                            $th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01%' order by kode")->result();
                            foreach ($th as $ks) {
                                if($ks->parent == '' && $ks->jenis == 0){
                                    ?>
                            <tr style="color:red;font-weight:bold"><td width="250px" colspan="4"> <?=$ks->uraian;?> </td></tr>
                                    <?
                                }else if($ks->jenis == 2){
                                    ?>
                            <tr><td colspan="3" style="color: blue"><b> <?=$ks->uraian;?> </b></td><td><input type="number" step="any" class="number <?=$ks->parent;?>_ton_tebu"  id="<?=$ks->kode;?>_ton_tebu" name="<?=$ks->kode;?>_ton_tebu" readonly style="background-color: red;color:white" value="<?=$ks->ton_tebu;?>"></td></tr>
                                    <?
                                }else if($ks->jenis == 3){
                                    ?>
                            <tr style="background-color: orange"><td colspan="3" style="color: black"><b> <?=$ks->uraian;?> </b></td><td><input type="number" step="any" class="number <?=$ks->parent;?>_ton_tebu"  id="<?=$ks->kode;?>_ton_tebu" name="<?=$ks->kode;?>_ton_tebu" readonly style="background-color: black;color:white" value="<?=$ks->ton_tebu;?>"></td></tr>
                                    <?
                                }else if($ks->jenis == 0){
                                    ?>
                            <tr><td colspan="3"> <?=$ks->uraian;?> </td><td><input type="number" step="any" class="number <?=$ks->parent;?>_ton_tebu"  id="<?=$ks->kode;?>_ton_tebu" name="<?=$ks->kode;?>_ton_tebu" readonly style="background-color: yellow" value="<?=$ks->ton_tebu;?>"></td></tr>
                                    <?
                                }else{
                                    $pg = '';$ro = 'readonly';$kodep = '';
                                    if($ks->transfer != '0'){

                                        if(isset($transfer[$ks->kategori][$ks->transfer-1])){
                                            $kodep=$transfer[$ks->kategori][$ks->transfer-1];
                                            $pg = $kontrol->getnamaunit($kodep);
                                            $ro = '';
                                        }
                                        ?>
                                        <input type="hidden" name="<?=$ks->kode;?>_plant" value="<?=$kodep;?>">
                                <tr><td colspan="3"> <?=$ks->uraian.' '.$pg ;?>  </td><td><input type="number" step="any" class="number <?=$ks->parent;?>_ton_tebu"  value="<?=$ks->ton_tebu;?>" id="<?=$ks->kode;?>_ton_tebu<?=$kodep;?>" name="<?=$ks->kode;?>_ton_tebu" <?=$ro;?>></td></tr>  
                                <?
                                    }else{
                                    ?>
                            <tr><td colspan="3"> <?=$ks->uraian;?> </td><td><input type="number" step="any" class="number <?=$ks->parent;?>_ton_tebu"  id="<?=$ks->kode;?>_ton_tebu" value="<?=$ks->ton_tebu;?>" name="<?=$ks->kode;?>_ton_tebu"></td></tr>       
                                    <?
                                }
                                }
                            }
                            ?>
                             </table>
                    </div>
                    </div>
            </div>
        </div>
        <div class="col-md-6 col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="page-content-wrapper m-t">
                       
                                <table class="tableizer-table" style="<?=$peng;?>">
                            <thead>
                                <tr style="visibility: hidden;"><td colspan="4" ><input type="number" step="any" class="form-control input-sm" readonly style="background-color: white"></td></tr>
                                <tr style="visibility: hidden;"><td colspan="4" ><input type="number" step="any" class="form-control input-sm" readonly style="background-color: white"></td></tr>
                                <tr style="visibility: hidden;"><td colspan="4" ><input type="number" step="any" class="form-control input-sm" readonly style="background-color: white"></td></tr>
                                <tr style="visibility: hidden;"><td colspan="4" ><input type="number" step="any" class="form-control input-sm" readonly style="background-color: white"></td></tr>
                                <tr class="tableizer-firstrow">
                                <th >HABLUR</th><th>TON HABLUR</th><th>SBH GULA PTR</th><th>SBH GUMIL</th>
                            </tr>
                            </thead>
                            <?php
                            //hablur
                            $th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode like '01%' order by kode")->result();
                            foreach ($th as $ks) {
                                if($ks->parent == '' && $ks->jenis == 0){
                                    ?>
                            <tr style="color:red;font-weight:bold"><td width="250px" colspan="4"> <?=$ks->uraian;?> </td></tr>
                                    <?
                                }else if($ks->jenis == 2){
                                    ?>
                            <tr><td style="color: blue"><b> <?=$ks->uraian;?> </b></td>
                                <td><input type="number" step="any" 
                                    class="number <?=$ks->parent;?>_hablur"  
                                    id="<?=$ks->kode;?>_hablur" 
                                    name="<?=$ks->kode;?>_hablur" readonly 
                                    style="background-color: red;color:white" value="<?=$ks->ton_hablur;?>"></td>

                                <td><input type="number" step="any" 
                                    class="number <?=$ks->parent;?>_gula_ptr"  
                                    id="<?=$ks->kode;?>_gula_ptr" 
                                    name="<?=$ks->kode;?>_gula_ptr" readonly 
                                    style="background-color: red;color:white" value="<?=$ks->ton_gula_ptr;?>"></td>

                                <td><input type="number" step="any" 
                                    class="number <?=$ks->parent;?>_gumil"  
                                    id="<?=$ks->kode;?>_gumil" 
                                    name="<?=$ks->kode;?>_gumil" readonly 
                                    style="background-color: red;color:white" value="<?=$ks->ton_gula_milik;?>"></td>

                                </tr>
                                    <?
                                }else if($ks->jenis == 3){
                                    ?>
                            <tr style="background-color: orange">
                                <td  style="color: black"><b> <?=$ks->uraian;?> </b></td>
                                <td><input type="number" step="any" 
                                    class="number <?=$ks->parent;?>_hablur"  
                                    id="<?=$ks->kode;?>_hablur" 
                                    name="<?=$ks->kode;?>_hablur" readonly 
                                    style="background-color: black;color:white" value="<?=$ks->ton_hablur;?>"></td>

                                <td><input type="number" step="any" 
                                    class="number <?=$ks->parent;?>_gula_ptr"  
                                    id="<?=$ks->kode;?>_gula_ptr" 
                                    name="<?=$ks->kode;?>_gula_ptr" readonly 
                                    style="background-color: black;color:white" value="<?=$ks->ton_gula_ptr;?>"></td>

                                <td><input type="number" step="any" 
                                    class="number <?=$ks->parent;?>_gumil"  
                                    id="<?=$ks->kode;?>_gumil" 
                                    name="<?=$ks->kode;?>_gumil" readonly 
                                    style="background-color: black;color:white" value="<?=$ks->ton_gula_milik;?>"></td>
                                </tr>
                                    <?
                                }else if($ks->jenis == 0){
                                    ?>
                            <tr><td > <?=$ks->uraian;?> </td>
                                 <td><input type="number" step="any" readonly
                                        class="number <?=$ks->parent;?>_hablur"  
                                        value="<?=$ks->ton_hablur;?>" 
                                        id="<?=$ks->kode;?>_hablur" style="background-color: yellow;" name="<?=$ks->kode;?>_hablur" ></td>
                                        <td><input type="number" step="any" readonly
                                        class="number <?=$ks->parent;?>_gula_ptr"  
                                        value="<?=$ks->ton_gula_ptr;?>" 
                                        id="<?=$ks->kode;?>_gula_ptr" style="background-color: yellow;" name="<?=$ks->kode;?>_gula_ptr" ></td>
                                        <td><input type="number" step="any"  readonly
                                        class="number <?=$ks->parent;?>_gumil"  
                                        value="<?=$ks->ton_gula_milik;?>" 
                                        id="<?=$ks->kode;?>_gumil" style="background-color: yellow;" name="<?=$ks->kode;?>_gumil" ></td>
                            </tr>
                                    <?
                                }else{
                                    $pg = '';$ro = 'readonly';$kodep = '';
                                    if($ks->transfer != '0'){

                                        if(isset($transfer[$ks->kategori][$ks->transfer-1])){
                                            $kodep=$transfer[$ks->kategori][$ks->transfer-1];
                                            $pg = $kontrol->getnamaunit($kodep);
                                            $ro = '';
                                        }
                                        ?>
                                        <input type="hidden" name="<?=$ks->kode;?>_plant" value="<?=$kodep;?>">
                                <tr><td > <?=$ks->uraian.' '.$pg ;?>  </td>
                                    <td><input type="number" step="any" 
                                        class="number <?=$ks->parent;?>_hablur"  
                                        value="<?=$ks->ton_hablur;?>" 
                                        id="<?=$ks->kode;?>_hablur<?=$kodep;?>" name="<?=$ks->kode;?>_hablur" <?=$ro;?>></td>
                                        <td><input type="number" step="any" 
                                        class="number <?=$ks->parent;?>_gula_ptr"  
                                        value="<?=$ks->ton_gula_ptr;?>" 
                                        id="<?=$ks->kode;?>_gula_ptr<?=$kodep;?>" name="<?=$ks->kode;?>_gula_ptr" onkeyup="hitungcek('<?=$ks->kode;?>')" <?=$ro;?>></td>
                                        <td><input type="number" step="any" 
                                        class="number <?=$ks->parent;?>_gumil"  
                                        value="<?=$ks->ton_gula_milik;?>" 
                                        id="<?=$ks->kode;?>_gumil<?=$kodep;?>" name="<?=$ks->kode;?>_gumil" <?=$ro;?>></td>
                                    </tr>  
                                <?
                                    }else{
                                    ?>
                            <tr><td > <?=$ks->uraian;?> </td>
                                <td><input type="number" step="any" 
                                        class="number <?=$ks->parent;?>_hablur"  
                                        value="<?=$ks->ton_hablur;?>" 
                                        id="<?=$ks->kode;?>_hablur" name="<?=$ks->kode;?>_hablur" ></td>
                                        <td><input type="number" step="any" 
                                        class="number <?=$ks->parent;?>_gula_ptr"  
                                        value="<?=$ks->ton_gula_ptr;?>" 
                                        id="<?=$ks->kode;?>_gula_ptr" name="<?=$ks->kode;?>_gula_ptr" onkeyup="hitungcek('<?=$ks->kode;?>')" ></td>
                                        <td><input type="number" step="any" 
                                        class="number <?=$ks->parent;?>_gumil"  
                                        value="<?=$ks->ton_gula_milik;?>" 
                                        id="<?=$ks->kode;?>_gumil" name="<?=$ks->kode;?>_gumil" ></td>       
                                    <?
                                }
                                }
                            }
                            ?>
                         <tr class="tableizer-firstrow">
                                <th colspan="4">URAIAN</th>
                            </tr>
                            </thead>
                            <?php
                            $th = $this->db->query("SELECT * FROM t_hapas_detail_copy where kode not like '01%' order by kode")->result();
                            $valplant = '';
                            foreach ($th as $ks) {
                                if($ks->parent == '' && $ks->jenis == 0){
                                    if($ks->kode == '05'){
                                        $valplant = $ks->plant_code;
                                        ?>
                                        <tr style="color:red;font-weight:bold"><td width="300px" colspan="3" > <?=$ks->uraian;?> 
                                        </td><td><select id="05_plant" name="05_plant" class="select2" style="width: 200px"></select>
                                    </td>
                                        </tr>
                                        <?
                                    }else{
                                    ?>
                            <tr style="color:red;font-weight:bold"><td width="250px" colspan="4"> <?=$ks->uraian;?> </td></tr>
                                    <?
                                }
                                }else if($ks->jenis == 2){
                                    ?>
                            <tr><td colspan="3" style="color: blue"><b> <?=$ks->uraian;?> </b></td><td><input type="number" step="any" class="number <?=$ks->parent;?>"  id="<?=$ks->kode;?>" name="<?=$ks->kode;?>" readonly style="background-color: red;color:white" value="<?=$ks->nilai;?>"></td></tr>
                                    <?
                                }else if($ks->jenis == 3){
                                    ?>
                            <tr style="background-color: orange"><td colspan="3" style="color: black"><b> <?=$ks->uraian;?> </b></td><td><input type="number" step="any" class="number <?=$ks->parent;?>"  id="<?=$ks->kode;?>" name="<?=$ks->kode;?>" readonly style="background-color: black;color:white" value="<?=$ks->nilai;?>"></td></tr>
                                    <?
                                }else if($ks->jenis == 0){
                                    ?>
                            <tr><td colspan="3"> <?=$ks->uraian;?> </td><td><input type="number" step="any" class="number <?=$ks->parent;?>"  id="<?=$ks->kode;?>" value="<?=$ks->nilai;?>" name="<?=$ks->kode;?>" readonly style="background-color: yellow"></td></tr>
                                    <?
                                }else{
                                    $pg = '';$ro = 'readonly';$kodep='';
                                    if($ks->transfer != '0'){

                                        if(isset($transfer[$ks->kategori][$ks->transfer-1])){
                                            $kodep=$transfer[$ks->kategori][$ks->transfer-1];
                                            $pg = $kontrol->getnamaunit($kodep);
                                            $ro = '';
                                        }
                                        ?>
                                        <input type="hidden" name="<?=$ks->kode;?>_plant" value="<?=$kodep;?>">
                                <tr><td colspan="3"> <?=$ks->uraian.' '.$pg ;?>  </td><td><input type="number" step="any" class="number <?=$ks->parent;?>"  value="<?=$ks->nilai;?>" id="<?=$ks->kode;?>" name="<?=$ks->kode;?>" <?=$ro;?>></td></tr>  
                                <?
                                    }else{
                                    ?>
                            <tr><td colspan="3"> <?=$ks->uraian;?> </td><td><input type="number" step="any" class="number <?=$ks->parent;?>"  id="<?=$ks->kode;?>"  onkeyup="hitungagain('<?=$ks->kode;?>')" value="<?=$ks->nilai;?>" name="<?=$ks->kode;?>"></td></tr>       
                                    <?
                                }
                                }
                            }
                            ?>
                             </table>
                    </div>
                </div>
            </div>
        </div>

                        
                  <div class="toolbar-line text-center">
                                <input type="submit" class="btn btn-primary btn-sm" value="Simpan" id="btnsimpan" />
                                <a href="<?php echo site_url('thapas');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
                            </div>     
                
    </div>
</form>
</section>

<script type="text/javascript">
    $(document).ready(function(){

        $('.sidebar-toggle').trigger('click');

        $("#05_plant").jCombo("<?php echo site_url('thapas/comboselect?filter=sap_plant:kode_plant:nama_plant'); ?>",
        {  selected_value : '<?=$valplant;?>' , initial_text:'- pilih plant -' });

        //luas
        $(".0101_luas").bind("keyup change", function(e) {
                sumdata('010107_luas','0101_luas','010206_luas','0102_luas','010108_luas','010207_luas','0103_luas');
        });

        $(".010107_luas").bind("keyup change", function(e) {
                sumdata('010107_luas','0101_luas','010206_luas','0102_luas','010108_luas','010207_luas','0103_luas');
        });

        $(".0102_luas").bind("keyup change", function(e) {
               sumdata('010107_luas','0101_luas','010206_luas','0102_luas','010108_luas','010207_luas','0103_luas');
        });

        $(".010206_luas").bind("keyup change", function(e) {
               sumdata('010107_luas','0101_luas','010206_luas','0102_luas','010108_luas','010207_luas','0103_luas');
        });

        //ton tebu
        $(".0101_ton_tebu").bind("keyup change", function(e) {
                sumdata('010107_ton_tebu','0101_ton_tebu','010206_ton_tebu','0102_ton_tebu','010108_ton_tebu','010207_ton_tebu','0103_ton_tebu');
        });

        $(".010107_ton_tebu").bind("keyup change", function(e) {
               sumdata('010107_ton_tebu','0101_ton_tebu','010206_ton_tebu','0102_ton_tebu','010108_ton_tebu','010207_ton_tebu','0103_ton_tebu');
        });

        $(".0102_ton_tebu").bind("keyup change", function(e) {
              sumdata('010107_ton_tebu','0101_ton_tebu','010206_ton_tebu','0102_ton_tebu','010108_ton_tebu','010207_ton_tebu','0103_ton_tebu');
        });

        $(".010206_ton_tebu").bind("keyup change", function(e) {
              sumdata('010107_ton_tebu','0101_ton_tebu','010206_ton_tebu','0102_ton_tebu','010108_ton_tebu','010207_ton_tebu','0103_ton_tebu');
        });

        //ton hablur
        $(".0101_hablur").bind("keyup change", function(e) {
                sumdata('010107_hablur','0101_hablur','010206_hablur','0102_hablur','010108_hablur','010207_hablur','0103_hablur');
        });

        $(".010107_hablur").bind("keyup change", function(e) {
                sumdata('010107_hablur','0101_hablur','010206_hablur','0102_hablur','010108_hablur','010207_hablur','0103_hablur');
        });

        $(".0102_hablur").bind("keyup change", function(e) {
                sumdata('010107_hablur','0101_hablur','010206_hablur','0102_hablur','010108_hablur','010207_hablur','0103_hablur');
        });

        $(".010206_hablur").bind("keyup change", function(e) {
                sumdata('010107_hablur','0101_hablur','010206_hablur','0102_hablur','010108_hablur','010207_hablur','0103_hablur');
        });
        
    });

    function hitungcek(vcode){
        var hblr = $('#'+vcode+"_hablur").val();
        var gula = hblr*1.003;
        var sbhtr = $('#'+vcode+"_gula_ptr").val();
        console.log(sbhtr);
        var gumil = gula - (sbhtr*1);
        $('#'+vcode+"_gumil").val(gumil.toFixed(4));

        sumdata('010107_gula_ptr','0101_gula_ptr','010206_gula_ptr','0102_gula_ptr','010108_gula_ptr','010207_gula_ptr','0103_gula_ptr');
        sumdata('010107_gumil','0101_gumil','010206_gumil','0102_gumil','010108_gumil','010207_gumil','0103_gumil');

    }

    function sumdata(tssaudara,ts,trsaudara,tr,total1,total2,total3){
        var ls = 0;var lss = 0;
        $('.'+tssaudara).each(function(i, obj) {
            var x =0;
            if($(obj).val()!= 0)   x = parseFloat($(obj).val());
            lss = lss + x;
            //console.log(lss);
        });

        $('.'+ts).each(function(i, obj) {
            var x = 0;
            if($(obj).val()!= 0)   x = parseFloat($(obj).val());
            ls = ls + x;

        });

        var lr = 0;var lrs = 0;
        $('.'+trsaudara).each(function(i, obj) {
            var x =0;
            if($(obj).val()!= 0)   x = parseFloat($(obj).val());
            lrs = lrs + x;
            //console.log(lss);
        });

        $('.'+tr).each(function(i, obj) {
            var x = 0;
            if($(obj).val()!= 0)   x = parseFloat($(obj).val());
            lr = lr + x;

        });

        
        var tx = ls+lss;
        var trx = lr+lrs;
        $('#'+tssaudara).val(lss.toFixed(4));
        $('#'+ts).val(tx.toFixed(4));
        $('#'+total1).val(tx.toFixed(4));

        $('#'+trsaudara).val(lrs.toFixed(4));
        $('#'+tr).val(trx.toFixed(4));
        $('#'+total2).val(trx.toFixed(4));
        var ttl= tx+trx;
        $('#'+total3).val(ttl.toFixed(4));
    }

    function gethari(){
        var d1 = new Date($('#tgl_awal').val());
        var d2 = new Date($('#tgl_akhir').val());
        var timeDiff = d2.getTime() - d1.getTime();
        var DaysDiff = timeDiff / (1000 * 3600 * 24);
        $('#jml_hari_gil_inc_jb').val(DaysDiff+1);
    }
    var gumil = $('#010101_gumil').val()*1;
    function hitungagain(vkode){
        if(vkode == '0402'){
            var xs = $('#0402').val()/1.003;
            $('#0401').val(xs.toFixed(4));
        }

        if(vkode == '0403'){
            var xs = $('#0403').val()*1;
            var xx = $('#0103_gula_ptr').val();
            var xl = $('#010101_hablur').val()*1.003;

            var cx =   xs -xx -$('#010107_gumil').val() - $('#010102_gumil').val() - $('#010207_gumil').val() ;
           // var xp = xl - cx;
        //    var gumil = $('#010101_hablur').val()*1.003;
        //cx = Match.round(cx*1000)/1000
            var egumil = cx;
            $('#010101_gumil').val(egumil.toFixed(3));
            sumdata('010107_gumil','0101_gumil','010206_gumil','0102_gumil','010108_gumil','010207_gumil','0103_gumil');

            //$('#0404').val(xp.toFixed(4));
        }
        var lr = 0;
        $('.0409').each(function(i, obj) {
            var x = 0;
            if($(obj).val()!= 0)   x = parseFloat($(obj).val());
            lr = lr + x;
            $('#0409').val(lr.toFixed(4));
        });
    }


    function getData(){
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('thapas/ambildata');?>",
            dataType: 'json',
            success: function (dat) {
                var murni = dat.murni;
                var transfer = dat.transfer;
                var lp = dat.lp;


                $.each(murni,function(i, obj) {
                    if(obj.kode == 'TR'){
                        $('#010201_luas').val(obj.ha*1);
                        $('#010201_ton_tebu').val(obj.ton*1);
                        $('#010201_hablur').val(obj.hablur_total*1);
                        $('#010201_gula_ptr').val(obj.gula_ptr*1);
                        $('#010201_gumil').val(obj.gula_pg*1);
                    }
                    if(obj.kode == 'TS'){
                        $('#010101_luas').val(obj.ha*1);
                        $('#010101_ton_tebu').val(obj.ton*1);
                        $('#010101_hablur').val(obj.hablur_total*1);
                        $('#010101_gula_ptr').val(obj.gula_ptr*1);
                        $('#010101_gumil').val(obj.gula_pg*1);
                        
                    }
                    if(obj.kode == 'SPT'){
                        $('#010102_luas').val(obj.ha*1);
                        $('#010102_ton_tebu').val(obj.ton*1);
                        $('#010102_hablur').val(obj.hablur_total*1);
                        $('#010102_gula_ptr').val(obj.gula_ptr*1);
                        $('#010102_gumil').val(obj.gula_pg*1);
                    }
                });

                $.each(transfer,function(i, obj) {
                    if(obj.kode == 'TR'){
                        $('#010202_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);
                        $('#010203_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);
                        $('#010204_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);
                        $('#010205_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);

                        $('#010202_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);
                        $('#010203_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);
                        $('#010204_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);
                        $('#010205_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);

                        $('#010202_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);
                        $('#010203_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);
                        $('#010204_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);
                        $('#010205_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);

                        
                        $('#010202_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);
                        $('#010203_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);
                        $('#010204_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);
                        $('#010205_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);

                        $('#010202_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);
                        $('#010203_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);
                        $('#010204_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);
                        $('#010205_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);

                        
                    }
                    if(obj.kode == 'TS'){
                        $('#010103_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);
                        $('#010104_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);
                        $('#010105_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);
                        $('#010106_luas'+obj.kode_plant_trasnfer).val(obj.ha*1);

                       $('#010103_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);
                       $('#010104_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);
                       $('#010105_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);
                       $('#010106_ton_tebu'+obj.kode_plant_trasnfer).val(obj.ton*1);


                        $('#010103_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);
                        $('#010104_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);
                        $('#010105_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);
                        $('#010106_hablur'+obj.kode_plant_trasnfer).val(obj.hablur_total*1);

                        $('#010103_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);
                        $('#010104_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);
                        $('#010105_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);
                        $('#010106_gula_ptr'+obj.kode_plant_trasnfer).val(obj.gula_ptr*1);

                        $('#010103_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);
                        $('#010104_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);
                        $('#010105_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);
                        $('#010106_gumil'+obj.kode_plant_trasnfer).val(obj.gula_pg*1);
                        
                    }
                    
                });

                 sumdata('010107_luas','0101_luas','010206_luas','0102_luas','010108_luas','010207_luas','0103_luas');
                 sumdata('010107_ton_tebu','0101_ton_tebu','010206_ton_tebu','0102_ton_tebu','010108_ton_tebu','010207_ton_tebu','0103_ton_tebu');
                 sumdata('010107_hablur','0101_hablur','010206_hablur','0102_hablur','010108_hablur','010207_hablur','0103_hablur');
                 sumdata('010107_gula_ptr','0101_gula_ptr','010206_gula_ptr','0102_gula_ptr','010108_gula_ptr','010207_gula_ptr','0103_gula_ptr');
                 sumdata('010107_gumil','0101_gumil','010206_gumil','0102_gumil','010108_gumil','010207_gumil','0103_gumil');
                 hitungagain('0408');

                 $.each(lp,function(i, obj) {
                    var hblrthnlalu = obj.gula_ex_sisan_sd*1/1.003;
                    $('#0402').val(obj.gula_ex_sisan_sd*1);
                    $('#0401').val(hblrthnlalu.toFixed(3));
                    $('#0403').val(obj.gula_produksi_sd*1);
                    $('#0404').val(obj.shs_ex_ms_thnini*1);
                    $('#0405').val(obj.tetes_produksi_sd*1);
                    $('#0406').val(obj.tetes_sisan_sd*1);
                    $('#0407').val(obj.tetes_sto_sd*1);
                    $('#0408').val(0);
                    hitungagain('0403');
                });


            }
        });
    }
</script>