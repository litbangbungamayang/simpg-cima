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
    <style type="text/css">
    	th {
    		text-align: center;
    		color: white;
    		background-color: #00c0ef !important;
    		vertical-align: middle;
    	}
    	.table>tbody>tr>td,  .table>tfoot>tr>td,  .table>thead>tr>td {
    		padding: 5px;
    		text-align: center;
    	}
    </style>
 </head>
 <body>
 <section class="content">

 	    <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: linear-gradient(
          rgba(0, 0, 0, 0.5), 
          rgba(0, 0, 0, 0.2)
        ),url('<?=base_url('bgdash.jpg');?>');">
                  <h3 class="widget-user-username"><?=CNF_PG;?></h3>
                  <h5 class="widget-user-desc">Giling Tanggal 19 Mei 2019 Hari ke 5</h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="<?=base_url('userpic.jpg');?>">
                </div>
                <div class="box-footer" style="padding-top: 10px">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">32,000 Ton</h5>
                        <span class="description-text">Tebu Masuk s/d</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">13,000 Ton</h5>
                        <span class="description-text">Tebu Digiling s/d</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">35 Ton</h5>
                        <span class="description-text">Produksi SHS s/d</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>

<table style="width: 100%" class="table table-sm table-bordered table-striped">
	<thead>
	<tr>
		<th rowspan="2" style="vertical-align: middle;">JAM</th>
		<th colspan="2">TEBU GILING</th>
		<th colspan="2">NPP</th>
		<th colspan="2">NIRA MENTAH</th>
		<th colspan="2">GILINGAN AKHIR</th>
		<th colspan="2">DISKAP</th>
		<th colspan="2">AMPAS</th>
		<th colspan="2">DISKAP</th>
		<th rowspan="2" style="vertical-align: middle;"> % <br />BLOTONG</th>
		<th colspan="2">TETES</th>
		<th rowspan="2" style="vertical-align: middle;">PRODUKSI<br /> SHS</th>
	</tr>
	<tr>
		<th>Hi</th>
		<th>s/d</th>
		<th>BRIX</th>
		<th>HK</th>
		<th>BRIX</th>
		<th>HK</th>
		<th>BRIX</th>
		<th>HK</th>
		<th>BRIX</th>
		<th>HK</th>
		<th>BRIX</th>
		<th>HK</th>
		<th>BRIX</th>
		<th>HK</th>
		<th>BRIX</th>
		<th>HK</th>
	</tr>
	</thead>
	<tbody>
		<?php
				$j = 6;
			for ($i=0; $i < 24; $i++) { 
						if($j == 24){
							$j = 0;
						}
				?>

				<tr>
					<td>&nbsp;<?=$j++.':00';?></td>
					<td> 845.98 </td>
					<td> 845.98 </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
					<td> - </td>
				</tr>
				<?php
			}
		?>
	</tbody>
</table>
</section>


</body>
</html>