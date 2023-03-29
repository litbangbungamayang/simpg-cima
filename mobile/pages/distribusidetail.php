<!DOCTYPE html>
<html>
	<head>
		<title> Dsitribusi SPAT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='
			sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
			<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
			<link href="//netdna.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
			<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
			<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
			<script src="//netdna.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
												<script type="text/javascript">
				list_vendor();
				list_mandor();
				function list_vendor() {
				 	$.ajax({
		                url : 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/simpg/index.php/apidistribusispta/getVendor',
		                type: 'GET',
		                dataType: 'json',
		                success: function(data)
		                {	
		                	$("#vendor").html("");
		                	for (var i = 0; i < data.data.length; i++) {
       				                	$("#vendor").append('<option value="'+data.data[i].id_vendor+'">'+data.data[i].nama_vendor+'</option>');	
		                	}
		                					list_angkutan($("#vendor").val());
		                },
		                error: function (jqXHR, textStatus, errorThrown)
		                {
		                }
		                });
				 }

				 function list_angkutan(vendor) {
				 	$.ajax({
		                url : 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/simpg/index.php/apidistribusispta/getTruk?vendor='+vendor,
		                type: 'GET',
		                dataType: 'json',
		                success: function(data)
		                {	
		                	$("#angkutan").html("");
		                	for (var i = 0; i < data.data.length; i++) {
       				                	$("#angkutan").append('<option value="'+data.data[i].id+'-'+data.data[i].rfid_sticker+'">'+data.data[i].namatruk+' - '+data.data[i].nopol_truk+'</option>');	
		                	}
		                },
		                error: function (jqXHR, textStatus, errorThrown)
		                {
		                }
		                });
				 }

				 function list_mandor() {
				 	$.ajax({
		                url : 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/simpg/index.php/apidistribusispta/datamandor',
		                type: 'GET',
		                dataType: 'json',
		                success: function(data)
		                {	
		                	$("#mandor").html("");
		                	for (var i = 0; i < data.data.length; i++) {
       				                	$("#mandor").append('<option value="'+data.data[i].Persno+'">'+data.data[i].name+'</option>');	
		                	}
		                },
		                error: function (jqXHR, textStatus, errorThrown)
		                {
		                }
		                });
				 }
				 function save() {
				 	var idtruk = $("#angkutan").val().split("-")[0];
				 	var rfid = $("#angkutan").val().split("-")[1];
				 	var persno = $("#mandor").val();
				 	var spta = "<?php echo $_GET['spta']; ?>";
				 	$.ajax({
		                url : 'http://<?php echo $_SERVER['HTTP_HOST']; ?>/simpg/index.php/apidistribusispta/simpanDistribusi',
		                type: 'POST',
		                data: {id_truk:idtruk, rfid_sticker: rfid, persno_mandor: persno, id: spta},
		                dataType: 'text',
		                success: function(data)
		                {	
		                	swal({title: "SUKSES", text: "simpan data sukses!", type: "success"},
							   function(){ 
							       location.reload();
							   }
							);
		                },
		                error: function (jqXHR, textStatus, errorThrown)
		                {
		                	// alert(textStatus);
		                	swal("ERROR", textStatus, "error");
		                }
		                });
				 }
				 
			</script>
			<style type="text/css">
				.div-main {
					padding: 12px;
    				background: #6f6d6d;
    				color: #FFF;
    				font-size: 13px;
				}
			</style>
		</head>
		<body>
			<div class="div-main">
				<div><?php echo $_GET['spta']; ?></div>
				<div>Nomor Petak <?php echo $_GET['spta']; ?></div>
			</div>
			<form>	
			<div style="padding: 15px;">			
			<label style="font-weight: bold;">Vendor</label>
			<select name="vendor" id="vendor" onchange="list_angkutan($(this).val());" style="width: 100%;height: 33px;" placeholder="Pilih Vendor">
				<option disabled selected>Pilih Vendor</option>
			</select>

			<label style="font-weight: bold;">Angkutan</label>
			<select name="angkutan" id="angkutan" style="width: 100%;height: 33px;" placeholder="Pilih Angkutan">
				<option disabled selected>Pilih Angkutan</option>
			</select>

			<label style="font-weight: bold;">Mandor</label>
			<select name="mandor" id="mandor" style="width: 100%;height: 33px;" placeholder="Pilih Mandor">
				<option disabled selected>Pilih Mandor</option>
			</select>
			<br>	
			<br>	
			<button id="simpan" onclick="save()" type="button" class="btn btn-success" style="width: 100%">SIMPAN</button>
			</div>
			</form>
		</body>
	</html>