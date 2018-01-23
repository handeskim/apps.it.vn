$(document).ready(function(){
	$("#BtnSearchProducts").click(function(e){
		$("#reponse_products_search").empty();
		var product_inbox = $("#inboxSearchProducts").val();
		var name_pepr = $("#NameSearchProducts").val();
		var InfoItemProduct = '';
		if(product_inbox === '' || product_inbox === ''){
			$("#reponse_products_search").append(html_error_product);
		}else{
			search_product_item(product_inbox,name_pepr);
		}
	});
	function search_product_item(id,name_pepr){
		$.ajax({ 
			type: 'GET', 
			url: BASE_URL+'apps/api/search_product_item', 
			data: { code_products: id, name_pepr:name_pepr}, 
			dataType: 'json',
			success: function (ResponseProductSearch) { 
				if(ResponseProductSearch.result == null || ResponseProductSearch.result == '' ||  ResponseProductSearch.result == 'null'){
					$("#reponse_products_search").append('sản phẩm không có vui lòng tìm lại');
				}else{
					var list_temp = html_list_search_products(ResponseProductSearch.result);
					$("#reponse_products_search").append(list_temp);
					$.each(ResponseProductSearch.result, function(i, item) {
						$('#submitbutton'+item.id).click(function() {
							var items = $("#inputid").val();
							$.get( BASE_URL+"cms/order_new/AddCart", { id: items,} ).done(function( newItemCart ) {
								$('#bodyAddCart').append(newItemCart);
								$("#addToCartFormPem"+item.id).empty();
							});
							
						});
					});
				}
				
			}
		});
	}
	
	function html_list_search_products(list){
		var temp = '<ul id="ulFromCart" style="list-style:  none;background: #00c0ef;text-align: center;"><button class="btn"id="resetFrom"><i class="fa fa-trash">remove</i></button>';
		$.each(list, function(i, item) {
			temp += '<li><form id="addToCartFormPem'+item.id+'" name="addToCartForm"><input type="hidden" id="inputid" value="'+item.id+'"/><span>'+item.code_products+' </span><spanstyle="margin-right: 10px;" >'+item.name_products+'</span><span style="margin-left: 10px;" class="btn btn-success btn-small" id="submitbutton'+item.id+'">  <i id="addToCartValue" class="fa fa-cart-plus"> </i></span></form></li>';
		});	
		temp += '</ul>';
		return temp;
	}
	function html_error_product(){
		var temp_html_error_product = 'sản phẩm không tồn tại vui lòng thử lại';
		return temp_html_error_product;
	}
	
	
});
function submitDetailsForm() {
	$("#error_codecode").empty();
	var CodeOrder = $("#CodeOrder").val();
	var NameCheckCustomer = $("#NameCheckCustomer").val();
	if(CodeOrder === '' || CodeOrder === null ){
		$("#error_codecode").append('vui lòng không bỏ trống Mã Đơn hàng (Bưu Chính)');
		return false;
	}else{
		if(NameCheckCustomer == 1){
			var CodeCustomer = $("#CodeCustomer").val();
			if(CodeCustomer === '' || CodeCustomer === null ){
				$("#error_codecode").append('vui lòng không bỏ trống Mã khách hàng');
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
		
	}
  
}
function temp_old_customer(){
	$("#template_customer").empty();
	var temp ='<div id="Customer_old">';
		temp +='<label >Mã khách hàng</label>';
		temp +='<input id="CodeCustomer" type="text" class="form-control" name="CodeCustomer" value="" placeholder="Mã khách hàng - xxxxx" required></div>';
	$("#template_customer").append(temp);
}
function temp_new_customer(){
	$("#template_customer").empty();
	var temp ='<div id="Customer_New"> ';
		temp +='<label >Tên Khách hàng</label>';
		temp +='<input id="name_customer" type="text" class="form-control" name="name_customer" value="" placeholder="Mã khách hàng - xxxxx" required>';
		temp +='<label >Địa Chỉ Khách hàng</label>';
		temp +='<input id="addr_customer" type="text" class="form-control" name="addr_customer" value="" placeholder="Địa Chỉ Khách hàng- xxxxx" required>';
		temp +='<label >Email Khách hàng</label>';
		temp +='<input id="email_customer" type="text" class="form-control" name="email_customer" value="" placeholder="Email Khách hàng - xxxxx" required>';
		temp +='<label >Số ĐT Khách hàng</label>';
		temp +='<input id="phone_customer" type="text" class="form-control" name="phone_customer" value="" placeholder="Số ĐT Khách hàng - xxxxx" required>';
		temp +='<div class="form-group">';
		temp +='<label for="exampleInputEmail1">Ghi chú Khách hàng</label>';
		temp +=' <textarea name="note_customer" rows="3" cols="50">Ghi chú</textarea>';
		temp +='</div>';
		temp +='</div>';
		
	$("#template_customer").append(temp);
}
$(function() {
	temp_old_customer()
	$('#NameCheckCustomer').change(function(){
		if($('#NameCheckCustomer').val() == 2) {
			temp_new_customer();
		} else {
			temp_old_customer();
		} 
	});
});