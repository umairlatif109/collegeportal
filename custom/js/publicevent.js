fileurl ="http://localhost/collegeportal/php_actions/";

$("#limit").change(function(){
	limit = $("#limit").val();
	
	if(limit){
		$.ajax({
			url:fileurl+"teacher/limited_events.php",
			type:"post",
			data:{limit:limit},
			dataType:"json",
			success:function(result){
				$("#loadevents").empty();
				for (var i = 0; i < result.length; i++) {
					$("#loadevents").append("<div class='card-body bg-secondary'><h3 style='padding-bottom:5px;border-bottom:2px solid #3498DB;'' >"+result[i][0]+"</h3><p class='text-justify'>"+result[i][1]+"</p><p><span style='padding-bottom:5px;border-bottom:2px solid #3498DB;'><b>"+result[i][2]+"</b></span></p></div><br>");
				};
			}
		});
	}
});