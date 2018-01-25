$(function(){
	$("#ResponseResultsInfo").empty();
	$.ajax({ 
		type: 'GET', 
		url: BASE_URL+'apps/api/info', 
		dataType: 'json',
		success: function (reponse) { 
			$("#ResponseResultsInfo").empty();
			if(reponse.results == null || reponse.results == '' ||  reponse.results == 'null'){
				$("#ResponseResultsInfo").append('');
			}else{
				var temp_search = html_temp_search_results(reponse);
				$("#ResponseResultsInfo").append(temp_search);
			}
		}
	});
});