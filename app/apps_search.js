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
	
});