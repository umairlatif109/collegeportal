fileurl ="http://localhost/collegeportal/php_actions/";

$("#subjectId").attr("disabled","disabled");
$(".marksCard").hide();

$("#date").datepicker({
	minDate:new Date()
});

$("#classId").change(function(){ // when class is changed this will get all subject according to class

	class_id = $(this).val();
	teacher_id = $("#teacherId").val();
		if(class_id > 0){
			$.ajax({

				url:fileurl+"teacher/getteachersubjects.php",
				type:"post",
				dataType:"json",
				data:{classId:class_id,teacherId:teacher_id},
				success:function(result){
					$("#subjectId").html("<option value = '0'>--- Select Subject ---</option>");
					$("#subjectId").removeAttr("disabled");
					for (var i = 0; i < result.length; i++) {
						$("#subjectId").append("<option value = "+result[i]['subject_id']+" >"+result[i]['subject_name']+"</option>");
					}
				}

			});
		}
		else{
			$("#subjectId").attr("disabled","disabled");
			$("#subjectId").find("option").remove();
		}

});


$("#saveForm").submit(function(){

	classId = $("#classId").val();
	subjectId = $("#subjectId").val();

	$(".text-danger").remove();

	if(classId == 0){
		$("#classId").closest(".form-group").addClass("has-danger");
		$("#classId").after("<span class='text-danger'>Select Class</span>");
	}
	else{
		$("#classId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#classId").closest(".text-danger").remove();
	}
	if(subjectId == 0){
		$("#subjectId").closest(".form-group").addClass("has-danger");
		$("#subjectId").after("<span class='text-danger'>Select Subject</span>");
	}
	else{
		$("#subjectId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#subjectId").closest(".text-danger").remove();
	}

	if(classId > 0 && subjectId > 0 && date ){
		form = $(this);
        $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize(),
           dataType:"json",
           success:function(result){
               if(result['success'] == true)
               {	
               		$(".marks-area").empty();
               		for (var i = 0; i < result['data'].length; i++) {
               			$(".marks-area").append("<tr>"+result['data'][i][0]+"<td>"+result['data'][i][1]+"<td>"+result['data'][i][2]+"<td>"+result['data'][i][3]+"</td></td></tr>");	
               		}
					$("#classId").off("click");
					$("#subjectId").off("click");
					$("#lectureTopic").attr("readonly","readonly");
					$("#generateResultBtn").attr("disabled","disabled");

					$(".marksCard").show();
					$("#generateResult").hide();

					
               }
               else if(result['success'] == false)
               {	console.log(result);
               		$(".marks-area").empty();
               		$(".marksCard").hide();
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.quiz +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });
	}
	return false;

});


$("#marksForm").submit(function(){

	form = $(this);
	data = form.serialize();
	$.ajax({
		url:form.attr("action"),
		method:form.attr("method"),
		dataType:"json",
		data:data+"&classId="+$("#classId").val()+"&subjectId="+$("#subjectId").val()+"&teacherId="+$("#teacherId").val()+"&date="+$("#date").val(),
		success:function(result){
               if(result['success'] == true)
               {
               		$("#marksForm").hide();
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					$(".form-group").removeClass("has-error").removeClass("has-success text-success");
					$(".ok2").append("<a class='btn btn-warning text-white mr-3' href='viewquiz.php'>View Quiz Marks</a>");		
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