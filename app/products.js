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
					$('#submitbutton').click(function() {
						var items = $("#inputid").val();
						
						$.get( BASE_URL+"cms/order_new/AddCart", { id: items,} ).done(function( newItemCart ) {
							$('#bodyAddCart').append(newItemCart);
							$("#addToCartFormPem").empty();
						});
						
					});
				}
				
			}
		});
	}
	
	function html_list_search_products(list){
		var temp = '<ul style="list-style:  none;background: #00c0ef;text-align: center;">';
		$.each(list, function(i, item) {
			temp += '<li><form id="addToCartFormPem" name="addToCartForm"><input type="hidden" id="inputid" value="'+item.id+'"/><span>'+item.code_products+' </span><spanstyle="margin-right: 10px;" >'+item.name_products+'</span><span style="margin-left: 10px;" class="btn btn-success btn-small" id="submitbutton">  <i id="addToCartValue" class="fa fa-cart-plus"> </i></span></form></li>';
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
$(function() {
	$('#Customer_New').hide(); 
	$('#NameCheckCustomer').change(function(){
		if($('#NameCheckCustomer').val() == 2) {
			$('#Customer_New').show(); 
			$('#Customer_old').hide(); 
		} else {
			$('#Customer_New').hide(); 
			$('#Customer_old').show(); 
		} 
	});
});