<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo  CNF_APPNAME ;?></title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins-->
    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>sximo/js/plugins/gangue/jquery-gauge.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->  

<script src="<?php echo base_url();?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>sximo/js/plugins/jquery.cookie.js"></script>
<script src="<?php echo base_url();?>/adminlte/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>/adminlte/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url();?>/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>/adminlte/plugins/fastclick/fastclick.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>/adminlte/plugins/select2/select2.full.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url();?>/adminlte/plugins/iCheck/icheck.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>/adminlte/dist/js/app.min.js"></script>

    <script src="<?php echo base_url();?>sximo/js/plugins/gangue/jquery-gauge.min.js"></script>

<style type="text/css">
.number{
  text-align: right;
}
</style>
</head>

<body>

<body class="hold-transition skin-blue sidebar-mini">

<section class="content" style="background-color: #6e6e6e;min-height: 750px">


  <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border" id="printed">
<div class="row">
  
<h1><center><b><?=CNF_PG;?></b> | <b><span id="tgls"></span></b></center></h1>

      <div class="row" style="margin: 0px">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="fr">0</h3>

              <p>Faktor Rendemen</p>
            </div>
            <div class="icon">
              <i class="fa fa-hand-o-right" ></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><span id="brix">0</span> <sup style="font-size: 20px">%</sup></h3>

              <p>Persen Brix</p>
            </div>
            <div class="icon">
              <i class="fa fa-hand-o-right"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="ph">0</h3>

              <p>Ph</p>
            </div>
            <div class="icon">
              <i class="fa  fa-hand-o-right"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><span id="pol">0</span> <sup style="font-size: 20px">%</sup></h3>

              <p>Persen POL</p>
            </div>
            <div class="icon">
              <i class="fa fa-hand-o-right"></i>
            </div>
            
          </div>
        </div>
        <!-- ./col -->
      </div>

</div>
      </div>
  </div>
</div>


<style type="text/css">
  .info-box-number {
    display: block;
    font-weight: bold;
    font-size: 38px;
}

.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: white;
  color: black;
}
</style>
<div class="row" style="margin: 0px">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-arrows-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">HKNPP</span>
              <span class="info-box-number" id="hknpp">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa  fa-exchange"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Nilai Nira</span>
              <span class="info-box-number" id="nira">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa  fa-check-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Rendemen</span>
              <span class="info-box-number" id="rend">0</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
      </div>
      </section>

      </div>

 
 </div>
 <footer class="main-footer footer" style="margin-left: 0px">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.0
    </div>
    <strong>Copyright © 2018 <a href="#">SIMPG - PT. Perkebunan Nusantara XI</a>.</strong> All rights
    reserved.
  </footer>

  <script type="text/javascript">
    function reloadData(){
     $.ajax({
            url: "<?=site_url('dashboard/getlastari');?>",
            dataType: "json",
            type: "POST",
            success: function(data){
                //console.log(data);
                if(data.dtt != 0){
                  var x = data.dtt;
                  $('#fr').html(x.faktor_rendemen);
                  $('#brix').html(x.persen_brix_ari);
                  $('#pol').html(x.persen_pol_ari);
                  $('#ph').html(x.ph_ari);
                  $('#hknpp').html(x.hk);
                  $('#nira').html(x.nilai_nira);
                  $('#rend').html(x.rendemen_ari);
                  $('#tgls').html(x.tgl_ari);
                }else{
                  stt = "Free";
                }
            }
        });
    }

    setInterval(reloadData, 3000);
  </script>