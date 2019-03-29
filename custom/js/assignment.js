fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#showAllAssignments").DataTable({'ajax':fileurl+'teacher/getallassignments.php'});
table.ajax.reload( null, false );

$("#subjectId").attr("disabled","disabled");
$("#endDate").datepicker({
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
	uploadFile = $("#uploadFile").val();
	endDate = $("#endDate").val();
	description = $("#description").val();
	date = $("#date").val();
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
	if(endDate == ""){
		$("#endDate").closest(".form-group").addClass("has-danger");
		$("#endDate").after("<span class='text-danger'>Enter <b>End Date</b></span>");
	}
	else{
		$("#endDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$(".text-danger").remove();
	}
	if(endDate <= date){
		$("#endDate").closest(".form-group").addClass("has-danger");
		$("#endDate").after("<p class='text-danger'>Enter <b>Valid Date</b></p>");
	}
	else{
		$("#endDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$(".text-danger").remove();
	}

	if(description == ""){
		$("#description").closest(".form-group").addClass("has-danger");
		$("#description").after("<span class='text-danger' > Enter Description</span>");
	}
	else{
		$("#description").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#description").closest(".text-danger").remove();
	}	
	if(uploadFile == ""){
		$("#uploadFile").closest(".form-group").addClass("has-danger");
		$("#uploadFile").after("<span class='text-danger' > Choose File</span>");
	}
	else{
		$("#uploadFile").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#uploadFile").closest(".text-danger").remove();
	}

	if(classId && subjectId && uploadFile && endDate > date && date && description){
		form = $(this);
		formdata = new FormData(this); // new FormData gets fields values as well as file attached with this form
		
	    $.ajax({
	        url: form.attr("action"),
	        type: form.attr("method"),
	        data: formdata,
        	dataType:"json",
	        success: function (result) {
	        	console.log(result);
	            if(result['success']==true){
	            	$("#classId").val("");
	            	// $("#subjectId").attr("disabled","disabled");
					$("#subjectId").find("option").remove();
					$("#uploadFile").val("");
					$("#endDate").val("");
					$("#description").val("");
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					table.ajax.reload( null, false );
	            }
	            else{
	            	$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
	            }
	        },
	        cache: false,			//
	        contentType: false,		// these three lines are about submit form with file
	        processData: false		//
	    });
	}

	return false;

});



function marks(student_id = null,ta_id = null){
	if(student_id && ta_id)
	{
		$("#student_id").val(student_id);
		$("#ta_id").val(ta_id);
	}
}


$("#marksForm").submit(function(){
	
	oMarks = $("#oMarks").val();
	if(oMarks == ""){
		$("#oMarks").closest(".form-group").addClass("has-danger");
		$("#oMarks").after("<span class='text-danger' > Enter Obtained Marks</span>");
	}
	else{
		$("#oMarks").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#oMarks").closest(".text-danger").remove();
	}

	if(oMarks){
		form = $(this);
		console.log(form.serialize());
        $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize(),
           dataType:"json",
           success:function(result){
               if(result['success'] == true)
               {
					$(".messages").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					form[0].reset();
					$("#oMarks").attr("disabled","disabled");
					$("#marksModal").modal('hide');	
					table.ajax.reload( null, false );
					$(".form-group").removeClass("has-error").removeClass("has-success");		
               }
               else
               {
               		$(".messages").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });
	}
	return false;
});



function deleteAssignment(assignment_id = null){
	if(assignment_id){
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"teacher/deleteassignment.php",
			type:"post",
			data:{assignment_id: assignment_id},
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