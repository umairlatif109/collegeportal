fileurl ="http://localhost/collegeportal/php_actions/";
table = $("#showAllLectures").DataTable({'ajax':fileurl+'teacher/getalllectures.php'});
table.ajax.reload( null, false );

$("#date").datepicker({
	minDate:new Date()
});

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
	lectureNo = $("#lectureNo").val();
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
	if(uploadFile == ""){
		$("#uploadFile").closest(".form-group").addClass("has-danger");
		$("#uploadFile").after("<span class='text-danger' > Choose File</span>");
	}
	else{
		$("#uploadFile").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#uploadFile").closest(".text-danger").remove();
	}
	if(lectureNo == ""){
		$("#lectureNo").closest(".form-group").addClass("has-danger");
		$("#lectureNo").after("<span class='text-danger' > Enter Lecture No.</span>");
	}
	else{
		$("#lectureNo").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#lectureNo").closest(".text-danger").remove();
	}
	if(description == ""){
		$("#description").closest(".form-group").addClass("has-danger");
		$("#description").after("<span class='text-danger' > Enter Lecture Description</span>");
	}
	else{
		$("#description").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#description").closest(".text-danger").remove();
	}
	if(date == ""){
		$("#date").closest(".form-group").addClass("has-danger");
		$("#date").after("<span class='text-danger' > Enter Lecture date</span>");
	}
	else{
		$("#date").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#date").closest(".text-danger").remove();
	}

	if(classId && subjectId && uploadFile && lectureNo && description && date){
		form = $(this);
		formdata = new FormData(this); // new FormData gets fields values as well as file attached with this form
		
	    $.ajax({
	        url: form.attr("action"),
	        type: form.attr("method"),
	        data: formdata,
        	dataType:"json",
	        success: function (result) {
	            if(result['success']==true){
	            	$("#classId").val("");
	            	$("#subjectId").attr("disabled","disabled");
					$("#subjectId").find("option").remove();
					$("#uploadFile").val("");
					$("#description").val("");
					$("#date").val("");
					$("#lectureNo").val("");
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



function deleteLecture(lecture_id = null){
	if(lecture_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"teacher/deletelecture.php",
			type:"post",
			data:{lecture_id: lecture_id},
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