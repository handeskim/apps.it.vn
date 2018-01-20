<script src="<?php echo base_url();?>public/bower_components/ckeditor/ckeditor.js"> </script>
<section class="content">
<div class="row">
  <div class="col-md-12">
       <form role="form">
            <div class="form-group">
                <label for="ProductLabel">Nhập mã sản phẩm </label>
                  <input type="text" class="form-control" id="ProductLabel" placeholder="Mã sản phẩm ">
                  <button class="btn btn-default"> Thêm sản phẩm</button>
             </div>           

            <div class="box box-info">
                <div class="box-header">
                <h3 class="box-title">Tạo mới đơn hàng</h3>
                </div>
                <div class="box-body pad">
                    <div class="form-group">
                          <label for="exampleInputEmail1">Hướng dẫn sử dụng</label>
                          <textarea id="use_guide" name="manuals" rows="10" cols="80">Nội dung Hướng dẫn sử dụng</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ghi chú</label>
                         <textarea id="note" name="note" rows="3" cols="80">Ghi chú</textarea>
                    </div>
                </div>
            </div>
            
       </form>
  </div>
</div>
</section>
<script>
  $(function () {
     CKEDITOR.replace('use_guide')
     CKEDITOR.replace('note')
    $('.textarea').wysihtml5()
  })
</script>