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
			<link rel="stylesheet" type="text/css" href="style.css">
			<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.4/dist/sweetalert2.all.min.js"></script>
			<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
			<script src="//netdna.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
			<style type="text/css">
				a{
					color: #333;
				}
				a:focus{
					text-decoration: none;
				}
				.lbl{
					color: #333;
					text-align: left;
				}
				.form-group {
				    margin-bottom: 8px;
				}
			</style>
		</head>
		<body>
			<div class="container" style="margin-top: 15px;">
				<div class="row">
					<div class="col-12 col-md-12">
						<form>
							<div class="form-group">
								<label class="lbl" for="unit">Unit</label>
								<input type="email" class="form-control" id="unit">
							</div>
							<div class="form-group">
								<label class="lbl" for="exampleInputEmail1">Username</label>
								<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>
							<div class="form-group">
								<label class="lbl" for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1">
							</div>
							<div class="form-group">
								<label class="lbl" for="exampleInputPassword2">Ulangi Password</label>
								<input type="password" class="form-control" id="exampleInputPassword2">
							</div>
							
							<button type="submit" class="btn btn-primary" style="width: 100%;margin-top: 10px;">SIMPAN</button>
														<a href="logout:1" class="btn btn-alert" style="width: 100%;margin-top: 10px;">LOGOUT</a>
						</form>
					</div>
				</div>
			</div>
		</body>
	</html>
