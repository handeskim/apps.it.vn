<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url();?>/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href=<?php echo base_url();?>/public/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/public/dist/css/AdminLTE.min.css">

<style type="text/css">
@media print
{
    .header { display: none; }
    #printable { display: block; }
    @page { margin: 0; }
      body { margin: 1.6cm; }
}
.header_info_cart {
    margin: 10px;
    background: #ecf0f5;
    height: 45px;
    padding: 15px;
    text-align: left;
    text-transform: uppercase;
    color: #333;
    border-bottom: 2px solid #fff212;
    font-size: 16px;
}
</style>
</head>
<body>
<div >
<div class="header" style="margin-bottom: 50px; width: 100%;float: left;">
<button class="btn btn-default header_li" onClick="window.print()">Print this page</button>
</div>
</div>
	<div class="container">
	
		<div class="row">
			<div class="col-md-12">
				
			</div>
			<div class="col-md-12">
				<?php echo $content; ?>
			</div>
			<div class="col-md-12">
				
			</div>
		</div>
	</div>
<div >
<div class="header" style="margin-bottom: 50px; width: 100%;float: left;">
<button class="btn btn-default header_li" onClick="window.print()">Print this page</button>
</div>
</div>
	
	
</body>