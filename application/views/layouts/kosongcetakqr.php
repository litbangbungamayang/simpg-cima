<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo  CNF_APPNAME ;?> | Cetak</title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
<script src="<?php echo base_url();?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>/adminlte/plugins/barcode/qrcode.js"></script>
   <style>
    @media print
{
   .pagebreak { page-break-after: always; }
   
}

   </style>
<body> 
<?php echo $content;?>
</body>

<script type="text/javascript">
$(document).ready(function(){
	$('.qrcodedata').each(function(i, obj) {
    //test
    	//new QRCode($('#qrcodedata'),"asd");
    	//$(this).attr('data-qr');

    	var qrcode = new QRCode(document.getElementById("qrcode"+$(this).attr('data-qr')), {
    text: $(this).attr('data-qr'),
    width: 58,
    height: 58,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
	});

	alert("Data Siap di Print, gunakan Ctrl+shift+p , untuk print !!");
	//setTimeout(function () { window.close();}, 3000);
});


</script>
</html>
