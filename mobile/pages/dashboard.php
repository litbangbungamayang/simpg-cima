<?php 
	  include '../curl.php';
?>
			<style type="text/css">
				label{
					text-align: center;
				    width: 100%;
    				color: #FFF;
    				margin-bottom: 0;
				}
				.list-group-item {
				    border: 0;
				}
			</style>
		</head>
		<body>
			<ul class="list-group">
				  <li class="list-group-item"  style="padding: 0px;">
				  	<div>
				  		<img src="images.jpg" style="width: 100%;height: 173px;">
				  		<div style="position: absolute;z-index: 1;top: 27px;width: 100%;">
				  			<img src="person.png" style="width: 80px;border-radius: 50%;display: table;margin: 0 auto;background: #eee;padding: 7px;">
				  			<label style="line-height: 0;"><?php echo $dashboard->kode_affd; ?></label><br>
				  			<label>PG. Pagotan</label>
				  		</div>
				  	</div>	
				  </li>
				  <li class="list-group-item">
				  	<div style="font-weight: bold;">Kuota SPTA</div>	
				  	<div>Tanggal <?php echo tanggal_indo($dashboard->tgl_spta); ?></div>
				  	<a href="#" class="badge badge-secondary" style="position: absolute;top: 16px;right: 23px;font-size: 26px;"><?php echo $dashboard->kuota; ?></a>	
				  </li>
				  <li class="list-group-item" style="padding: 8px;">	
				  	<div style="padding: 12px;background: #eee;margin-bottom: 5px;">
				  		Selektor
				  		<a href="#" class="badge badge-success" style="float: right;font-size: 15px;"><?php echo $dashboard->selektor; ?></a>
				  	</div>
				  	<div style="padding: 12px;background: #eee;margin-bottom: 5px;">
				  		Timbang
				  		<a href="#" class="badge badge-primary" style="float: right;font-size: 15px;"><?php echo $dashboard->timbang; ?></a>
				  	</div>
				  	<div style="padding: 12px;background: #eee;margin-bottom: 5px;">
				  		Giling
				  		<a href="#" class="badge badge-danger" style="float: right;font-size: 15px;"><?php echo $dashboard->giling; ?></a>
				  	</div>
				  </li>
				</ul>
