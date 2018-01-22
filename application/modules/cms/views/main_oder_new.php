<script src="<?php echo base_url();?>public/bower_components/ckeditor/ckeditor.js"> </script>
<script src="<?php echo base_url();?>app/products.js"> </script>
<script src="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<section class="content">
	<div class="row">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Tạo mới đơn hàng</h3>
			</div>
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-6">
							<label for="ProductLabel">Nhập mã sản phẩm </label>
							<input id="inboxSearchProducts" type="text" class="form-control" id="ProductLabel" value="" placeholder="Mã sản phẩm ">
						 </div>  
						 <div class="col-md-6">
							<label for="ProductLabel">(Tìm theo mã sản phẩm)</label>
							<select id="NameSearchProducts" name="NameSearchProducts" class="form-control"> 
									<option value="1"> Mã sản phẩm</option>
									<option value="2"> Tên sản phẩm</option>
									<option value="3"> Nhãn sản phẩm</option>
							</select>
							<button style="margin-top: 10px;" id="BtnSearchProducts" class="btn btn-default" >Tìm kiếm</button>
						 </div>  
					 </div>     
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<div id="reponse_products_search"></div>
						</div>
					</div>     
				</div>
				<div class="col-md-12">
					<form id="formId" role="form" action="" method="post" onsubmit="return submitDetailsForm()">
						<hr>
						<div class="form-group col-md-12">
							<div id="item_cart">
								<div class="col-md-6">
									<label >Mã đơn hàng</label>
									<input id="CodeOrder" type="text" class="form-control" id="CodeOrder" name="CodeOrder" value="" placeholder="Mã đơn hàng - mã vận đơn">
								</div>
								<div class="col-md-6">
									<label for="exampleInputEmail1">Nhà cung cấp dịch vụ</label>
									<select name="NamePost" class="form-control"> 
										<option value="1"> VNPost</option>
										<option value="2"> Viettel Post</option>
									</select>
								</div>
								
							</div>
							
						</div>
						<div class="form-group col-md-12" style="margin-top: 10px;float:  left;width: 100%;">
						<hr>
								<label>Thông tin Giỏ hàng</label>
								<div id="item_cart">
									<table style="text-align: center;" id="bodyAddCart" class="table table-bordered"> 
										<thead>
										  <tr>
											 <th style="text-align: center;" >Mã sản phẩm</th>
											 <th style="text-align: center;" >Tên sản phẩm</th>
											 <th style="text-align: center;" >Nhãn sản phẩm</th>
											 <th style="text-align: center;" >Số lượng </th>
											 <th style="text-align: center;" >Giá </th>
										  </tr>
										</thead>
										<tbody >
										
										</tbody>
									</table>
								</div>
						</div>
						<div class="form-group col-md-12" style="">
						<hr>
							<label>Thông tin khách hàng</label>
							<div id="item_customer">
								<div class="col-md-2">
									<label for="exampleInputEmail1">Khách hàng</label>
									<select id="NameCheckCustomer" name="NameCheckCustomer" class="form-control"> 
										<option value="1"> Cũ</option>
										<option value="2"> Mới</option>
									</select>
								</div>
								<div class="col-md-8">
									
									<div class="col-md-12">
										<div id="Customer_old"> 
											<label >Mã khách hàng</label>
											<input id="CodeCustomer" type="text" class="form-control" name="CodeCustomer" value="" placeholder="Mã khách hàng - xxxxx">
										</div>
									</div>
									<div class="col-md-12">
										<div id="Customer_New"> 
											<label >Tên Khách hàng</label>
											<input id="name_customer" type="text" class="form-control" name="name_customer" value="" placeholder="Mã khách hàng - xxxxx">
											<label >Địa Chỉ Khách hàng</label>
											<input id="addr_customer" type="text" class="form-control" name="addr_customer" value="" placeholder="Địa Chỉ Khách hàng- xxxxx">
											<label >Email Khách hàng</label>
											<input id="email_customer" type="text" class="form-control" name="email_customer" value="" placeholder="Email Khách hàng - xxxxx">
											<label >Số ĐT Khách hàng</label>
											<input id="phone_customer" type="text" class="form-control" name="phone_customer" value="" placeholder="Số ĐT Khách hàng - xxxxx">
											<div class="form-group">
												<label for="exampleInputEmail1">Ghi chú Khách hàng</label>
												 <textarea id="note_customer" name="note_customer" rows="3" cols="50">Ghi chú</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" style="">
						<hr>
							
							<div id="item_customer">
								<div class="col-md-2">
									<label for="exampleInputEmail1">Lịch gọi lại</label>
									<select id="NameCheckCallBack" name="NameCheckCallBack" class="form-control"> 
										<option value="2"> Không</option>
										<option value="1"> Có</option>
									</select>
								</div>
								<div class="col-md-8">
									
									<div class="col-md-12">
										<div id="CallBack"> 
											<label>Ngày gọi lại</label>
											<input id="date_allBack" type="text" class="form-control" name="date_allBack" value="" placeholder="mm-dd-yyyy">
											<label for="exampleInputEmail1">Ghi chú gọi lại</label>
											<textarea id="note_callback" name="note_callback" rows="3" cols="50">Ghi chú</textarea>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
						<hr>
							  <label for="exampleInputEmail1">Hướng dẫn sử dụng đơn hàng</label>
							  <textarea id="use_guide" name="manuals" rows="10" cols="80">Nội dung Hướng dẫn sử dụng</textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Ghi chú đơn hàng</label>
							 <textarea id="note" name="note" rows="3" cols="50">Ghi chú</textarea>
						</div>
						
						<div class="form-group col-md-12">
							<input type="hidden" name="cmd" value="1000"/>
							<input type="submit" class="btn btn-danger btn-small" value="Thêm Đơn Hàng"/>
							
						</div>
						<div class="form-group col-md-12">
							<div id="error_codecode"> </div>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
  $(function () {
     CKEDITOR.replace('use_guide')
     CKEDITOR.replace('note')
     CKEDITOR.replace('note_customer')
     CKEDITOR.replace('note_callback')
    $('.textarea').wysihtml5()
  });
$('#date_allBack').datepicker({
  autoclose: true
});
</script>
<style>
#error_codecode {
	color:red;
}
</style>