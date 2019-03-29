fileurl ="http://localhost/collegeportal/php_actions/";

$("#subjectId").attr("disabled","disabled");
$(".marksCard").hide();

$("#date").datepicker();

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
	date = $("#date").val();

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
	if(date == 0){
		$("#date").closest(".form-group").addClass("has-danger");
		$("#date").after("<span class='text-danger'>Select Year</span>");
	}
	else{
		$("#date").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#date").closest(".text-danger").remove();
	}

	if(classId > 0 && subjectId > 0){
		form = $(this);
        $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize(),
           dataType:"json",
           success:function(result){
               if(result['success'] == true)
               {	
               	console.log(result.data.length);
               		$(".marksCard").show();
               		$(".marks-area").empty();
               		for (var i = 0; i < result['data'].length; i++) {
               			$(".marks-area").append("<tr><td>"+result['data'][i][0]+"</td><td>"+result['data'][i][1]+"</td><td>"+result['data'][i][2]+"</td></tr>");	
               		}	
               }
               else if(result['success'] == false)
               {	console.log(result);
               		$(".marks-area").empty();
               		$(".marksCard").hide();
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.data +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });
	}
	return false;

});