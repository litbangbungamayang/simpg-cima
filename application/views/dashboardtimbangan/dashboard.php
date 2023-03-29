<html>
<head>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- DataTables -->

    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/bootstrap/css/font-awesome.min.css">
    <!-- DataTables -->
    <script src="<?php echo base_url();?>adminlte/plugins/jQuery/jquery-1.12.4.min.js"></script>
</head>
<body>
<section class="content" style="padding-top: 0px">


    <div class="box box-warning">
        <div class="box-header with-border">
            <div class="col-lg-12 col-xs-12">
                <table  style="padding: 3px;margin: 3px;width: 100%;">
                    <thead>
                    <tr>
                        <th rowspan="3" style="border-bottom: 1px solid red;background: black;color: red;text-align: center;">JAM</th>
                        <th colspan="6" style="background: #36a65a36;padding: 3px;text-align: center">SELEKTOR (UNIT)</th>
                        <th colspan="6" style="background: #3bc0f038;padding: 3px;text-align: center">TIMBANG (TON)</th>
                        <th colspan="6" style="background: #dd4b393d;padding: 3px;text-align: center">GILING (TON)</th>
                    </tr>
                    <tr>
                        <th colspan="3" style="background: #36a65a36;padding: 3px;text-align: center">YL</th>
                        <th colspan="3" style="background: #36a65a36;padding: 3px;text-align: center">HI</th>
                        <th colspan="3" style="background: #3bc0f038;padding: 3px;text-align: center">YL</th>
                        <th colspan="3" style="background: #3bc0f038;padding: 3px;text-align: center">HI</th>
                        <th colspan="3" style="background: #dd4b393d;padding: 3px;text-align: center">YL</th>
                        <th colspan="3" style="background: #dd4b393d;padding: 3px;text-align: center">HI</th>
                    </tr>
                    <tr style="border-bottom: 1px solid red">
                        <th style="background: #36a65a36;padding: 3px;text-align: center">TRUK</th>
                        <th style="background: #36a65a36;padding: 3px;text-align: center">LORI</th>
                        <th style="background: #36a65a36;padding: 3px;text-align: center">TOTAL</th>


                        <th style="background: #36a65a36;padding: 3px;text-align: center">TRUK</th>
                        <th style="background: #36a65a36;padding: 3px;text-align: center">LORI</th>
                        <th style="background: #36a65a36;padding: 3px;text-align: center">TOTAL</th>

                        <th style="background: #3bc0f038;padding: 3px;text-align: center">TRUK</th>
                        <th style="background: #3bc0f038;padding: 3px;text-align: center">LORI</th>
                        <th style="background: #3bc0f038;padding: 3px;text-align: center">TOTAL</th>


                        <th style="background: #3bc0f038;padding: 3px;text-align: center">TRUK</th>
                        <th style="background: #3bc0f038;padding: 3px;text-align: center">LORI</th>
                        <th style="background: #3bc0f038;padding: 3px;text-align: center">TOTAL</th>


                        <th style="background: #dd4b393d;padding: 3px;text-align: center">TRUK</th>
                        <th style="background: #dd4b393d;padding: 3px;text-align: center">LORI</th>
                        <th style="background: #dd4b393d;padding: 3px;text-align: center">TOTAL</th>


                        <th style="background: #dd4b393d;padding: 3px;text-align: center">TRUK</th>
                        <th style="background: #dd4b393d;padding: 3px;text-align: center">LORI</th>
                        <th style="background: #dd4b393d;padding: 3px;text-align: center">TOTAL</th>
                    </tr>

                    </thead>
                    <tbody id="dataText">

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
</body>
<script>
    $(document).ready(function(){

        getdata();
        setInterval(getdata, 60000);
    });
    function getdata(){
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('dashboardtimbangan/getDashGiling');?>',
            dataType : 'html',
            success: function (data) {
                $("#dataText").html(data);
            }
        });
    }
</script>

</html>