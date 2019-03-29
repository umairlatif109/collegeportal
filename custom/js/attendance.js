fileurl ="http://localhost/collegeportal/php_actions/";
$("#attendanceCard").hide();

$("#selectSubject").change(function(){

	selectSubject = $(this).val();
	if(selectSubject == -1){
		$("#lectureTopic").attr("readonly","readonly");
		$("#lectureTopic").val("");
	}
	else{
		$("#lectureTopic").removeAttr("readonly");
	}

});

$("#makeAttendanceForm").submit(function(){

	$(".text-danger").remove();

	selectSubject = $("#selectSubject").val();
	lectureTopic = $("#lectureTopic").val();

	if(selectSubject == -1){
		$("#selectSubject").closest(".form-group").addClass("has-danger");
		$("#selectSubject").after("<span class='text-danger'>Select Subject</span>");
	}
	else{
		$("#selectSubject").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#selectSubject").closest(".text-danger").remove();
	}
	if(lectureTopic == ""){
		$("#lectureTopic").closest(".form-group").addClass("has-danger");
		$("#lectureTopic").after("<span class='text-danger'>Enter Lecture Topic</span>");
	}
	else{
		$("#lectureTopic").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#lectureTopic").closest(".text-danger").remove();
	}

	if(selectSubject && lectureTopic){
		form = $(this);
        $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize(),
           dataType:"json",
           success:function(result){
               if(result['success'] == true)
               {
               		$("#attendance-area").empty();
               		for (var i = 0; i < result['data'].length; i++) {
               			$(".attendance-area").append("<tr>"+result['data'][i][0]+"<td>"+result['data'][i][1]+"<td>"+result['data'][i][2]+"<td>"+result['data'][i][3]+"</td></td></tr>");	
               		}
					
					$("#selectSubject").off("click");
					$("#lectureTopic").attr("readonly","readonly");
					$("#makeAttendance").attr("disabled","disabled");

					$("#attendanceCard").show();
					
               }
               else
               {
               		$(".amessage").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.data +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
					console.log(result.data);
               }
           }
       });
	}
	return false;
});


$("#attendanceForm").submit(function(){

	form = $(this);
	data = form.serialize();
	$.ajax({
		url:form.attr("action"),
		method:form.attr("method"),
		dataType:"json",
		data:data+"&classId="+$("#classId").val()+"&selectSubject="+$("#selectSubject").val()+"&lectureTopic="+$("#lectureTopic").val()+"&date="+$("#date").val(),
		success:function(result){
               if(result['success'] == true)
               {
               		$("#attendanceForm").hide();
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					$(".form-group").removeClass("has-error").removeClass("has-success text-success");
					console.log(result['sms']);		
               }
               else
               {
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
		}
	});
	return false;
});