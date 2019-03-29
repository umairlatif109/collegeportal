fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#makeuptimetable").DataTable({'ajax':fileurl+'teacher/getallmakeup.php'});
table.ajax.reload( null, false );

$("#subjectId").attr("disabled","disabled");
$("#teacherName").attr("disabled","disabled");
$("#makeupDate").datepicker({
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
					console.log(result[0]['subject_id']);
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
	roomId = $("#roomId").val();
	makeupDate = $("#makeupDate").val();
	startTime = $("#startTime").val();
	endTime = $("#endTime").val();

	$(".text-danger").remove();

	if(classId == "0" || classId == ""){
		$("#classId").closest(".form-group").addClass("has-danger");
		$("#classId").after("<span class='text-danger' > Select <b>Class </b> </span>");
	}
	else{
		$("#classId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#classId").closest(".text-danger").remove();
	}
	if(subjectId == "0" || subjectId == ""){
		$("#subjectId").closest(".form-group").addClass("has-danger");
		$("#subjectId").after("<span class='text-danger' > Select <b>Subject </b> </span>");
	}
	else{
		$("#subjectId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#subjectId").closest(".text-danger").remove();
	}
	if(roomId == "0" || roomId ==""){
		$("#roomId").closest(".form-group").addClass("has-danger");
		$("#roomId").after("<span class='text-danger' > Select <b>Room </b> </span>");
	}
	else{
		$("#roomId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#roomId").closest(".text-danger").remove();
	}
	if(startTime == "0" || startTime==""){
		$("#startTime").closest(".form-group").addClass("has-danger");
		$("#startTime").after("<span class='text-danger' > Enter <b>Start Time </b> </span>");
	}
	else{
		$("#startTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#startTime").closest(".text-danger").remove();
	}
	if(endTime == "0" || endTime ==""){
		$("#endTime").closest(".form-group").addClass("has-danger");
		$("#endTime").after("<p class='text-danger' > Enter <b>End Time </b> </p>");
	}
	else{
		$("#endTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#endTime").closest(".text-danger").remove();
	}
	if(endTime <= startTime){
		$("#endTime").closest(".form-group").addClass("has-danger");
		$("#endTime").after("<span class='text-danger' > Enter <b>Valid Time</b> </span>");
	}
	else{
		$("#endTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#endTime").closest(".text-danger").remove();
	}
	if(makeupDate == ""){
		$("#makeupDate").closest(".form-group").addClass("has-danger");
		$("#makeupDate").after("<span class='text-danger' > Choose <b>MakeUp Date</b> </span>");
	}
	else{
		$("#makeupDate").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#makeupDate").closest(".text-danger").remove();
	}
	if(classId && subjectId && makeupDate && roomId && startTime && endTime && startTime < endTime){
        form = $(this);
        $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize(),
           dataType:"json",
           success:function(result){
               if(result['success'] == true)
               {
	               	$("#subjectId").attr("disabled","disabled");
					$("#subjectId").find("option").remove();
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					form[0].reset();
               		$("#makeupModal").modal('hide');
					table.ajax.reload( null, false );
					$(".form-group").removeClass("has-error").removeClass("has-success text-success");		
               }
               else
               {
               		$("#makeupModal").modal('hide');
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });
	}
	return false;
});


function deleteMakeup(makeup_id = null){
	if(makeup_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"teacher/deletemakeup.php",
			type:"post",
			data:{makeup_id: makeup_id},
			dataType:"json",
			success:function(result){
				if(result.success == true)
				{
					$("#deleteModal").modal('hide');
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					table.ajax.reload( null,false );
				}
			}
		});
		});
	}
}