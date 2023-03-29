<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo  CNF_APPNAME ;?> | <?php echo $title;?></title>
<link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
<script src="<?php echo base_url();?>/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url();?>/adminlte/plugins/barcode/barcode128.js"></script>
   <style>
    @media print
{
   .pagebreak { page-break-after: always; display:none; }
   .page {
		size: 180mm 420mm;
	}
}

   </style>
<body> 
<?php echo $content;?>
</body>

<script type="text/javascript">
$(document).ready(function(){
	//window.print();
	JsBarcode(".barcode").init();
	
	setTimeout(function () { window.print();}, 2000);
	setTimeout(function () { window.close();}, 3000);
});


</script>
</html>
