<!-- <section class="content" style="padding-bottom: 0px"> -->
<!-- 	<div class="row"> -->
<!-- 		<div class="col-xs-12"> -->
<!-- 			<div class="box box-danger"> -->
<!-- 				<div class="box-header with-border">	 -->
<!-- 					<div class="col-md-12"> -->
<!-- 						<div class="box box-widget widget-user"> -->
<!-- 							<div class="widget-user-header bg-aqua-active"> -->
<!-- 								<h5 class="widget-user-username">SIMPG - <? echo CNF_PG;?></h5> -->
			  					<?
                            		echo form_open('dashboard/postgantimejatebu');
              	 					if ($this->session->userdata('fid') == 'Operator Meja Tebu'){
									echo '
                                    	<section class="content" style="padding-bottom: 0px">
                     					<div class="col-md-3">
			  								<select id="mejatebu" name="mejatebu" class="form-control"></select>
			  		 					</div>
              		 					<div class="col-md-3">
			  								<button type="submit" class="btn btn-danger"  style="height: 30px;" > Ganti Gilingan </button>
			  		 					</div>
                                        </section>';
									}
									echo form_close();
								?>
<!-- 							</div> -->
<!-- 						</div> -->
<!-- 					</div> -->
<!-- 				</div>	 -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 	</div> -->
<!-- </section> -->
<section>

</section>

<section class="content" style="padding-top: 0px">
<!--
<div class="box box-warning">
	<? echo "DARI SINI"; ?>
	<div class="box-header with-border">

        <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
			<p><i><b>SPTA</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-print"></i>
            </div>
          </div>
        </div>

    <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <p><i><b>Selektor</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-truck"></i>
            </div>

          </div>
        </div>
    <?php
    if(CNF_METODE == 2){
      ?>
    <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <p><i><b>CS</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-flask"></i>
            </div>

          </div>
        </div>
    <?php
    }
    ?>
    <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <p><i><b>Timbang</i></b></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-tags"></i>
            </div>

          </div>
        </div>

    <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-blue">
            <div class="inner">
              <p><i><b>Meja Tebu</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-gears"></i>
            </div>

          </div>
        </div>

    <?php
    if(CNF_METODE == 1){
      ?>
    <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <p><i><b>ARI</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-flask"></i>
            </div>
          </div>
    </div>
    <?php
    }
    ?>
    <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <p><i><b>Bagi Hasil</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-money"></i>
            </div>
          </div>
    </div>
          </div>
      <? echo "DISINI"; ?>
      </div>
-->
<!-- <div class="box box-default"> -->
<input type="hidden" id="tgl" />
  <div class="box-header with-border">
<!--
  <div class="col-md-2 col-xs-12">
  <table style="padding: 3px;margin: 3px; width: 100%;">
      <thead>
      <tr>
     <th colspan="6" style="background: #36a65a36;padding: 3px;text-align: center">SELEKTOR (UNIT)</th>
      </tr>
      </thead>
      <tbody id="selektordata"></tbody>
      </table>
  </div>
-->
<!--
  <div class="col-md-3  col-xs-12">
  <table style="padding: 3px;margin: 3px; width: 100%;">
      <thead>
      <tr>
      <th colspan="6" style="background: #3bc0f038;padding: 3px;text-align: center">TIMBANGAN (TON)</th>
      </tr>
      </thead>
      <tbody id="timbangandata"></tbody>
      </table>
  </div>
-->
  <!--
  <div class="col-md-3 col-xs-12">
  <table  style="padding: 1px;margin: 3px;width: 100%;">
      <thead>
      <tr>
      <th colspan="6" style="background: #dd4b393d;padding: 3px;text-align: center">GILING (TON)</th>
      </tr>
      </thead>
      <tbody id="gilingandata"></tbody>
  </table>
  </div>
  -->
	  <div class = "col-md-6 col-xs-12">
	  	<div class = "box box-solid box-primary">
	    	<div class = "box-header">
	        	<h3 class="box-title">Pasok per Rayon</h3>
	        </div>
	    	<div class="box-body">
	        	<table style = "padding: 3px; margin: 3px; width: 100%">
	            	<tbody id = "pasokrayondata"></tbody>
	        	</table>
	    	</div>
	    </div>
			<div class = "box box-solid box-primary">
	    	<div class = "box-header">
	      	<h3 class="box-title">Pasok per Sistem Tebang</h3>
	      </div>
	    	<div class="box-body">
	        <table style = "padding: 3px; margin: 3px; width: 100%">
	        	<tbody id = "pasoksisteb"></tbody>
	        </table>
	    	</div>
	    </div>

	  </div>
		<div class="col-md-6 col-xs-12">
	    	<div class = "box box-solid box-primary">
	        	<div class = "box-header"><h3 class = "box-title">Data per Jam</h3></div>
	        	<div class = "box-body">
					<table  style="padding: 3px;margin: 3px;width: 100%">
	    				<tbody id="integrasi"></tbody>
					</table>
	        	</div>
	    	</div>
				<div class = "box box-solid box-primary">
		    	<div class = "box-header"><h3 class = "box-title">Sisa Tebu Caneyard (SIMPG)</h3>
						<!--         	<div><canvas id="myChart" style = "width: 100%"></canvas></div> --></div>
		    	<div class = "box-body" id="sisatebu"></div>
		  	</div>
		</div>

  </div>
<!-- </div> -->
</section>


<script>

// fetch("http://simpgbuma.ptpn7.com/index.php/apibuma/getDataIntegrasiTimbangan?tgl=2019-10-04", {
// 	mode: 'no-cors',
// 	method: 'get',
//   	headers: {
//     	"Content-Type": "text/plain",
//     	'Authorization': 'Basic ' + btoa("optanaman:optanaman"),
//   	}
// .then(function(response) { return response.json() })
// .then(function(json) {
//   // use the json
// });
/*
fetch('simpgbuma.ptpn7.com/index.php/apibuma/getDataIntegrasiTimbangan?tgl=2019-10-04', {
	method: 'GET',
	mode: 'no-cors',
	headers: {
    	'Content-Type': 'text/plain',
    	'Authorization': 'Basic ' + btoa('optanaman:optanaman'),
    }
})
.then(function(response) { return response.json(); })
.then(function(json) {
  // use the json
});
*/
var data = {
  labels: ["January", "February", "March", "April", "May", "June", "July","August", "November", "December"],
  datasets: [
      {
          label: "Sodium intake",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [0,0]
      },
      {
          label: "Sugar intake",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [128, 148, 140, 119, 186, 127, 190]
      }
  ]
}

var lineChartCanvas = $('#myChart').get(0).getContext('2d');
var lineChart = new Chart(lineChartCanvas,{
                type: 'line',
                data: data
            });
</script>

<script>
var table;
 $(function () {
       // $("#gridv").DataTable();
      });

$(document).ready(function(){
	$("#mejatebu").jCombo("<?php echo site_url('mmejatebu/comboselect?filter=vw_master_mejatebu:id:kode|nama') ?>",
		{  selected_value : '<?php echo $this->session->userdata('gilingan');?>', initial_text : ' - Aktifkan Gilingan -' });
  getdata();
 // setInterval(getdata, 60000);
});

function fetchChart(){
	$.ajax({
    	type: 'POST',
    	url: '<? echo site_url('')?>/'+$("#tgl").val(),
    	success: function (data) {
        	lineChartData = JSON.parse(data).timbangan; //parse the data into JSON
        	var ctx = document.getElementById("myChart_x").getContext("2d");
        	var myLineChart = new Chart(ctx, {
            	type: 'line',
            	data: lineChartData
        	});
    	}
	});
}

function getdata(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/gettgl');?>',
          dataType : 'html',
          success: function (data) {
            $("#tgl").val(data);
          	//getselektor();
            getPasok();
          	getIntegrasi();
          	getSisaTebu();
						getPasokSisteb();
          	//fetchChart();
          	//gettimbangan();
          }
        });
}

function getselektor(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewperjam');?>/'+$("#tgl").val()+"/1",
          dataType : 'html',
          success: function (data) {
            $("#selektordata").html(data);
            gettimbangan();
          }
        });
}

function gettimbangan(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewperjam');?>/'+$("#tgl").val()+"/2",
          dataType : 'html',
          success: function (data) {
            $("#timbangandata").html(data);
            getgilingan();
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
          	getPasok();
          }
        });
}

function getPasok(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewPasokRayon');?>/'+$("#tgl").val(),
          dataType : 'html',
          success: function (data) {
            $("#pasokrayondata").html(data);
          }
        });
}

function getIntegrasi(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewIntegrasi');?>/'+$("#tgl").val(),
          dataType : 'html',
          success: function (data) {
            $("#integrasi").html(data);
          }
        });
}

function getSisaTebu(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewSisaTebu');?>/',
          dataType : 'html',
          success: function (data) {
            $("#sisatebu").html(data);
          }
        });
}

function getPasokSisteb(){
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url('dashboard/viewPasokSisteb');?>/'+$("#tgl").val(),
		dataType: 'html',
		success: function (data){
			$("#pasoksisteb").html(data);
		}
	});
}


</script>
