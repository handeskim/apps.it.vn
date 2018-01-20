<script src="<?php echo base_url();?>public/bower_components/ckeditor/ckeditor.js"> </script>
<section class="content">
<div class="row">
  <div class="col-md-12">
       <form role="form">
            <div class="box box-info">
                <div class="box-header">
                <h3 class="box-title">Hướng dẫn sử dụng
                </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                <form>
                        <textarea id="use_guide" name="manuals" rows="10" cols="80">
                            Nội dung Hướng dẫn sử dụng
                        </textarea>
                </form>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header">
                <h3 class="box-title">Ghi chú
                </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body pad">
                <form>
                    <textarea id="use_guide" name="manuals" rows="3" cols="80">
                         Ghi chú
                    </textarea>
                </form>
                </div>
            </div>
       </form>
  </div>
</div>
</section>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('use_guide')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>