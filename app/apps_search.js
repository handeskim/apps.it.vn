$(function(){
	$("#advanced_search").hide();
	$("#normal_search").show();
	$("#index_search_option").change(function(){
		var OpSearch = $(this).val();
		if(OpSearch==1){
			$("#advanced_search").hide();
			$("#normal_search").show();
		}else{
			$("#advanced_search").show();
			$("#normal_search").hide();
		}
	});
	$("#normal_search").click(function(){
		normal_search_load();
	});
	
	function normal_search_load(){
		$("#ResponseResults").empty();
		$.ajax({ 
			type: 'GET', 
			url: BASE_URL+'apps/search', 
			data: $('form#frm_normal_search').serialize(), 
			dataType: 'json',
			success: function (reponse) { 
				if(reponse.results == null || reponse.results == '' ||  reponse.results == 'null'){
					$("#ResponseResults").append('<div class="callout callout-warning"><h4>Tìm kiếm thất bại!</h4><p>sản phẩm không tìm thấy vui lòng tìm lại.</p></div>');
				}else{
					$.each(reponse.results, function(i, item) {
						$("#ResponseResults").append(item.full_name);
					});
				}
			}
		});
	}
});