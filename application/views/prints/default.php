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
</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php echo $content; ?>
			</div>
			<div class="col-md-12">
				<div class="box-footer">
					<div class="header" style="margin-bottom: 50px; width: 100%;float: left;">
					<button class="btn btn-default header_li" onClick="window.print()">Print this page</button>
					</div>
				  </div>
			</div>
		</div>
	</div>
	<form enctype="multipart/form-data">
<input id="upload" type=file   accept="text/html" name="files[]" size=30>
</form>

<textarea class="form-control" rows=35 cols=120 id="ms_word_filtered_html"></textarea>

<script>
function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // use the 1st file from the list
    f = files[0];

    var reader = new FileReader();

    // Closure to capture the file information.
    reader.onload = (function(theFile) {
        return function(e) {

          jQuery( '#ms_word_filtered_html' ).val( e.target.result );
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsText(f);
  }

  document.getElementById('upload').addEventListener('change', handleFileSelect, false);
</script>
</body>