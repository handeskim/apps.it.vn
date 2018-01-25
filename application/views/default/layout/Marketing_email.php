<section class="content">
<div class="row">
  <div class="col-md-12">
    <?php echo $error;?>

	<form method="post" action="upload_email" enctype="multipart/form-data" />

		<input type="file" name="userfile" size="100" />

		<br /><br />

		<input type="submit" value="upload" />

	</form>
  </div>
</div>
</section>