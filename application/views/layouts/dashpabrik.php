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
  
<h3><center><b><?=CNF_PG;?></b> | <b><span id="tgls"></span></b></center></h3>
<input type="hidden" id="tgl" />
      <div class="row" style="margin: 0px">

        <div class="col-md-3 col-xs-12">
  <!--gilingan-->
  <table  style="padding: 3px;margin: 3px;width: 100%;font-size: 22px;font-family: Calibri;font-weight: bold">
      <thead>
      <tr>
      <th colspan="6" style="background: #dd4b393d;padding: 3px;text-align: center">GILING (TON)</th>
      </tr>
      </thead>
      <tbody id="gilingandata"></tbody>
      </table>
  </div>

 <div class="col-md-3 col-xs-12" style="width: 37.5%">
<img id="videoElement-MT02" style="width: 100%;height: 320px" src="http://10.4.13.42/axis-cgi/mjpg/video.cgi">
</div>
 <div class="col-md-3 col-xs-12" style="width: 37.5%">
<img id="videoElement-MT02" style="width: 100%;height: 320px" src="http://10.4.13.39/axis-cgi/mjpg/video.cgi">
</div>

  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>GILINGAN 1</b></span></center>
          <div class="small-box bg-aqua">

            <div class="inner">
              <h3 id="vgil1">0</h3>
              <p style="font-size: 19;font-weight: bold">RPM</p>
            </div>
            <div class="icon" style="float: right;margin-left: 45px;">
            <canvas id="gil1" style="width: 100%"></canvas>
               </div>
            <br />
            <br />
            <br />
            
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>GILINGAN 2</b></span></center>
          <div class="small-box bg-aqua">

            <div class="inner">
              <h3 id="vgil2">0</h3>
              <p style="font-size: 19;font-weight: bold">RPM</p>
            </div>
            <div class="icon" style="float: right;margin-left: 45px;">
            <canvas id="gil2" style="width: 100%"></canvas>
               </div>
            <br />
            <br />
            <br />
            
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>GILINGAN 3</b></span></center>
          <div class="small-box bg-aqua">

            <div class="inner">
              <h3 id="vgil3">0</h3>
              <p style="font-size: 19;font-weight: bold">RPM</p>
            </div>
            <div class="icon" style="float: right;margin-left: 45px;">
            <canvas id="gil3" style="width: 100%"></canvas>
               </div>
            <br />
            <br />
            <br />
            
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>GILINGAN 4</b></span></center>
          <div class="small-box bg-aqua">

            <div class="inner">
              <h3 id="vgil4">0</h3>
              <p style="font-size: 19;font-weight: bold">RPM</p>
            </div>
            <div class="icon" style="float: right;margin-left: 45px;">
            <canvas id="gil4" style="width: 100%"></canvas>
               </div>
            <br />
            <br />
            <br />
            
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>GILINGAN 5</b></span></center>
          <div class="small-box bg-aqua">

            <div class="inner">
              <h3 id="vgil5">0</h3>
              <p style="font-size: 19;font-weight: bold">RPM</p>
            </div>
            <div class="icon" style="float: right;margin-left: 45px;">
            <canvas id="gil5" style="width: 100%"></canvas>
               </div>
            <br />
            <br />
            <br />
            
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>UNIGATOR</b></span></center>
          <div class="small-box bg-aqua">

            <div class="inner">
              <h3 id="vuni">0</h3>
              <p style="font-size: 19;font-weight: bold">RPM</p>
            </div>
            <div class="icon" style="float: right;margin-left: 45px;">
            <canvas id="uni" style="width: 100%"></canvas>
               </div>
            <br />
            <br />
            <br />
            
          </div>
        </div>
        

        <div class="col-lg-2 col-xs-6" style="width: 18.75%">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>KETEL 1</b></span></center>
          <div class="small-box " style="background-color: #7c8f4e;color:white">

            <div class="inner">
              <h3 id="vketel1">0</h3>
              <p style="font-size: 19;font-weight: bold">Ton / Jam</p>
            </div>
            <div class="icon" style="float: right;margin-left: 75px;">
            <canvas id="ketel1" style="width: 100%"></canvas>
               </div>
            <br />
            
          </div>
        </div>

        <div class="col-lg-2 col-xs-6" style="width: 18.75%">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>KETEL 2</b></span></center>
          <div class="small-box bg-yellow">

            <div class="inner">
              <h3 id="vketel2">0</h3>
              <p style="font-size: 19;font-weight: bold">Ton / Jam</p>
            </div>
            <div class="icon" style="float: right;margin-left: 75px;">
            <canvas id="ketel2" style="width: 100%"></canvas>
               </div>
            <br />
            
          </div>
        </div>

        <div class="col-lg-3 col-xs-6" style="width: 18.75%">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>KETEL 3</b></span></center>
          <div class="small-box" style="background-color: #7c7c7c;color:white">

            <div class="inner">
              <h3 id="vketel3">0</h3>
              <p style="font-size: 19;font-weight: bold">Ton / Jam</p>
            </div>
            <div class="icon" style="float: right;margin-left: 75px;">
            <canvas id="ketel3" style="width: 100%"></canvas>
               </div>
            <br />
            
          </div>
        </div>
        <div class="col-lg-2 col-xs-6" style="width: 18.75%">
          <!-- small box -->
           <center><span style="font-size: 17px"><b>KETEL 4</b></span></center>
          <div class="small-box" style="background-color: #ef877b;color:white">

            <div class="inner">
              <h3 id="vketel4">0</h3>
              <p style="font-size: 19;font-weight: bold">Ton / Jam</p>
            </div>
            <div class="icon" style="float: right;margin-left: 75px;">
            <canvas id="ketel4" style="width: 100%"></canvas>
               </div>
            <br />
            
          </div>
        </div>

        
       

        
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
      </section>

      </div>

 
 </div>
 

  <script type="text/javascript">
    var ketel1,ketel2,ketel3,ketel4,gil1,gil2,gil3,gil4,gil5,uni;
    $(document).ready(function(){
  
      getdata();
      initdash();
  setInterval(function(){
    getsensor();

  }, 2000);

  setInterval(function(){
    getdata();

  }, 20000);
});


    function initdash(){
      var ketelopt = {
  angle: 0.06, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 0.82, // Relative radius
  pointer: {
    length: 0.45, // // Relative to gauge radius
    strokeWidth: 0.04, // The thickness
    color: '#000000' // Fill color
  },
staticZones: [
   {strokeStyle: "#30B32D", min: 0, max: 5}, // Red from 100 to 130
   {strokeStyle: "#FFDD00", min: 5, max: 25}, // Yellow
   {strokeStyle: "#F03E3E", min: 25, max: 30} // Red
],
staticLabels: {
  font: "10px sans-serif",  // Specifies font
  labels: [0, 10, 15, 25, 30],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  // renderTicks is Optional
  renderTicks: {
    divisions: 5,
    divWidth: 0.9,
    divLength: 0.48,
    divColor: '#333333',
    subDivisions: 6,
    subLength: 0.32,
    subWidth: 0.6,
    subColor: '#666666'
  }
  
};

var rpmopt = {
  angle: 0.06, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 0.82, // Relative radius
  pointer: {
    length: 0.45, // // Relative to gauge radius
    strokeWidth: 0.04, // The thickness
    color: '#000000' // Fill color
  },
staticZones: [
   {strokeStyle: "#30B32D", min: 0, max: 100}, // Red from 100 to 130
   {strokeStyle: "#FFDD00", min: 100, max: 750}, // Yellow
   {strokeStyle: "#F03E3E", min: 750, max: 1000} // Red
],
staticLabels: {
  font: "10px sans-serif",  // Specifies font
  labels: [0, 100, 300, 500, 1000],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  // renderTicks is Optional
  renderTicks: {
    divisions: 5,
    divWidth: 0.9,
    divLength: 0.48,
    divColor: '#333333',
    subDivisions: 6,
    subLength: 0.32,
    subWidth: 0.6,
    subColor: '#666666'
  }
  
};

var rpmopt1 = {
  angle: 0.06, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 0.82, // Relative radius
  pointer: {
    length: 0.45, // // Relative to gauge radius
    strokeWidth: 0.04, // The thickness
    color: '#000000' // Fill color
  },
staticZones: [
   {strokeStyle: "#30B32D", min: 0, max: 1000}, // Red from 100 to 130
   {strokeStyle: "#FFDD00", min: 1000, max: 6000}, // Yellow
   {strokeStyle: "#F03E3E", min: 6000, max: 8000} // Red
],
staticLabels: {
  font: "10px sans-serif",  // Specifies font
  labels: [1000, 3000, 5000, 7000, 8000],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
  // renderTicks is Optional
  renderTicks: {
    divisions: 5,
    divWidth: 0.9,
    divLength: 0.48,
    divColor: '#333333',
    subDivisions: 6,
    subLength: 0.32,
    subWidth: 0.6,
    subColor: '#666666'
  }
  
};
var target1 = document.getElementById('ketel1'); // your canvas element
 ketel1 = new Gauge(target1).setOptions(ketelopt); // create sexy gauge!
ketel1.maxValue = 30; // set max gauge value
ketel1.setMinValue(0);  // Prefer setter over gauge.minValue = 0
ketel1.animationSpeed = 36; // set animation speed (32 is default value)
ketel1.set(0); // set actual value

var target2 = document.getElementById('ketel2'); // your canvas element
 ketel2 = new Gauge(target2).setOptions(ketelopt); // create sexy gauge!
ketel2.maxValue = 30; // set max gauge value
ketel2.setMinValue(0);  // Prefer setter over gauge.minValue = 0
ketel2.animationSpeed = 36; // set animation speed (32 is default value)
ketel2.set(0); // set actual value

var target3 = document.getElementById('ketel3'); // your canvas element
 ketel3 = new Gauge(target3).setOptions(ketelopt); // create sexy gauge!
ketel3.maxValue = 30; // set max gauge value
ketel3.setMinValue(0);  // Prefer setter over gauge.minValue = 0
ketel3.animationSpeed = 36; // set animation speed (32 is default value)
ketel3.set(0); // set actual value

var target4 = document.getElementById('ketel4'); // your canvas element
 ketel4 = new Gauge(target4).setOptions(ketelopt); // create sexy gauge!
ketel4.maxValue = 30; // set max gauge value
ketel4.setMinValue(0);  // Prefer setter over gauge.minValue = 0
ketel4.animationSpeed = 36; // set animation speed (32 is default value)
ketel4.set(0); // set actual value

var target5 = document.getElementById('gil1'); // your canvas element
 gil1 = new Gauge(target5).setOptions(rpmopt); // create sexy gauge!
gil1.maxValue = 1000; // set max gauge value
gil1.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gil1.animationSpeed = 36; // set animation speed (32 is default value)
gil1.set(0); // set actual value

var target6 = document.getElementById('gil2'); // your canvas element
 gil2 = new Gauge(target6).setOptions(rpmopt); // create sexy gauge!
gil2.maxValue = 1000; // set max gauge value
gil2.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gil2.animationSpeed = 36; // set animation speed (32 is default value)
gil2.set(0); // set actual value

var target7 = document.getElementById('gil3'); // your canvas element
 gil3 = new Gauge(target7).setOptions(rpmopt); // create sexy gauge!
gil3.maxValue = 1000; // set max gauge value
gil3.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gil3.animationSpeed = 36; // set animation speed (32 is default value)
gil3.set(0); // set actual value

var target8 = document.getElementById('gil4'); // your canvas element
 gil4 = new Gauge(target8).setOptions(rpmopt); // create sexy gauge!
gil4.maxValue = 1000; // set max gauge value
gil4.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gil4.animationSpeed = 36; // set animation speed (32 is default value)
gil4.set(0); // set actual value

var target9 = document.getElementById('gil5'); // your canvas element
 gil5 = new Gauge(target9).setOptions(rpmopt); // create sexy gauge!
gil5.maxValue = 1000; // set max gauge value
gil5.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gil5.animationSpeed = 36; // set animation speed (32 is default value)
gil5.set(0); // set actual value

var target10 = document.getElementById('uni'); // your canvas element
 uni = new Gauge(target10).setOptions(rpmopt1); // create sexy gauge!
uni.maxValue = 8000; // set max gauge value
uni.setMinValue(0);  // Prefer setter over gauge.minValue = 0
uni.animationSpeed = 36; // set animation speed (32 is default value)
uni.set(0); // set actual value

      getsensor();

    }


    function getdata(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/gettgl');?>', 
          dataType : 'html',
          success: function (data) { 
            $("#tgl").val(data);
            getgilingan();
          }
        });
}


function getsensor(){
   $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashmonitor/datasensor');?>', 
          dataType : 'json',
          success: function (data) { 
            var x = data.data;

            $('#tgls').html(data.tgl);

           ketel1.set(x[0]);
           $('#vketel1').html(x[0]);

           ketel2.set(x[1]);
           $('#vketel2').html(x[1]);

           ketel3.set(x[2]);
           $('#vketel3').html(x[2]);

           ketel4.set(x[3]);
           $('#vketel4').html(x[3]);

           gil1.set(x[4]);
           $('#vgil1').html(x[4]);

           gil2.set(x[5]);
           $('#vgil2').html(x[5]);

           gil3.set(x[6]);
           $('#vgil3').html(x[6]);

           gil4.set(x[7]);
           $('#vgil4').html(x[7]);

           gil5.set(x[8]);
           $('#vgil5').html(x[8]);

           uni.set(x[9]);
           $('#vuni').html(x[9]);
          }
        });
}

function getgilingan(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewperjam');?>/'+$("#tgl").val()+"/3", 
          dataType : 'html',
          success: function (data) { 
            $("#gilingandata").html(data);
          }
        });
}
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

  //  setInterval(reloadData, 3000);
  </script>