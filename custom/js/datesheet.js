fileurl ="http://localhost/collegeportal/php_actions/";
table = $("#showAllDateSheets").DataTable({'ajax':fileurl+'admin/getalldatesheets.php'});
table.ajax.reload( null, false );

$("#subjectId").attr("disabled","disabled");
$("#date").datepicker({
	minDate:new Date()
});
$("#editDate").datepicker({
	minDate:new Date()
});


$("#editExamId").change(function(){ // when exam type is changed this will get all subject according to exam type

	exam_type_id = $(this).val();
		if(exam_type_id > 0){
			$.ajax({

				url:fileurl+"admin/getexamclasses.php",
				type:"post",
				dataType:"json",
				data:{exam_type_id:exam_type_id},
				success:function(result){
					if(result.data.length > 0){
						$("#editClassId").html("<option value = '0'>--- Select Class ---</option>");
						$("#editClassId").removeAttr("disabled");
						for (var i = 0; i < result.data.length; i++) {
							$("#editClassId").append("<option value = "+result.data[i][0]+" >"+result.data[i][1]+"</option>");
						}
					}
					else{
						$("#editClassId").attr("disabled","disabled");
						$("#editClassId").find("option").remove();
						$("#editClassId").html("<option value = '-1'>--- No Class Scheduled ---</option>");
						$("#editSubjectId").attr("disabled","disabled");
						$("#editSubjectId").find("option").remove();
					}
				}

			});
		}
		else{
			$("#editClassId").attr("disabled","disabled");
			$("#editSubjectId").attr("disabled","disabled");
			$("#editClassId").find("option").remove();
			$("#editSubjectId").find("option").remove();
		}

});



$("#examId").change(function(){ // when exam type is changed this will get all subject according to exam type

	exam_type_id = $(this).val();
		if(exam_type_id > 0){
			$.ajax({

				url:fileurl+"admin/getexamclasses.php",
				type:"post",
				dataType:"json",
				data:{exam_type_id:exam_type_id},
				success:function(result){
					if(result.data.length > 0){
						$("#classId").html("<option value = '0'>--- Select Class ---</option>");
						$("#classId").removeAttr("disabled");
						for (var i = 0; i < result.data.length; i++) {
							$("#classId").append("<option value = "+result.data[i][0]+" >"+result.data[i][1]+"</option>");
						}
					}
					else{
						$("#classId").attr("disabled","disabled");
						$("#classId").find("option").remove();
						$("#classId").html("<option value = '-1'>--- No Class Scheduled ---</option>");
						$("#subjectId").attr("disabled","disabled");
						$("#subjectId").find("option").remove();
					}
				}

			});
		}
		else{
			$("#classId").attr("disabled","disabled");
			$("#subjectId").attr("disabled","disabled");
			$("#classId").find("option").remove();
			$("#subjectId").find("option").remove();
		}

});


$("#classId").change(function(){ // when class is changed this will get all subject according to class

	class_id = $(this).val();
		if(class_id > 0){
			$.ajax({

				url:fileurl+"admin/gettimetablesubjects.php",
				type:"post",
				dataType:"json",
				data:{class_id:class_id},
				success:function(result){
					$("#subjectId").html("<option value = '0'>--- Select Subject ---</option>");
					$("#subjectId").removeAttr("disabled");
					for (var i = 0; i < result.data.length; i++) {
						$("#subjectId").append("<option value = "+result.data[i][1]+" >"+result.data[i][0]+"</option>");
					}
				}

			});
		}
		else{
			$("#subjectId").attr("disabled","disabled");
			$("#subjectId").find("option").remove();
		}

});


//this is for edit timetable dialog
$("#editClassId").change(function(){ // when class is changed this will get all subject according to class

	class_id = $(this).val();
		if(class_id > 0){
			$.ajax({

				url:fileurl+"admin/gettimetablesubjects.php",
				type:"post",
				dataType:"json",
				data:{class_id:class_id},
				success:function(result){
					$("#editSubjectId").html("<option value = '0'>--- Select Subject ---</option>");
					$("#editSubjectId").removeAttr("disabled");
					for (var i = 0; i < result.data.length; i++) {
						$("#editSubjectId").append("<option value = "+result.data[i][1]+" >"+result.data[i][0]+"</option>");
					}
				}

			});
		}
		else{
			$("#editSubjectId").attr("disabled","disabled");
			$("#editSubjectId").find("option").remove();
		}

});

$("#saveDateSheet").submit(function(){

	$(".text-danger").remove();
	classId = $("#classId").val();
	subjectId = $("#subjectId").val();
	roomId = $("#roomId").val();
	date = $("#date").val();
	startTime = $("#startTime").val();
	endTime = $("#endTime").val();
	examId = $('#examId').val();
	console.log(roomId);
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
	if(date == "0" || date ==""){
		$("#date").closest(".form-group").addClass("has-danger");
		$("#date").after("<span class='text-danger' > Select <b>Date </b> </span>");
	}
	else{
		$("#date").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#date").closest(".text-danger").remove();
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
		$("#endTime").after("<span class='text-danger' > Enter <b>End Time </b> </span>");
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
	if(examId == "0"){
		$("#examId").closest(".form-group").addClass("has-danger");
		$("#examId").after("<span class='text-danger' > Enter <b>Valid Time</b> </span>");
	}
	else{
		$("#examId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#examId").closest(".text-danger").remove();
	}
	if(classId != 0 && subjectId != 0 && roomId != 0 && date && endTime > startTime && startTime && endTime && examId !=0 ){
        form = $(this);
        $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize(),
           dataType:"json",
           success:function(result){
               if(result['success'] == true)
               {
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					form[0].reset();
					table.ajax.reload( null, false );
					$(".form-group").removeClass("has-error").removeClass("has-success text-success");		
               }
               else
               {
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });
	}

	return false;
});



function editDateSheet(editDateSheetId = null){
	$.ajax({
		url:fileurl+"admin/singledatesheet.php",
		type:"post",
		data:{editDateSheetId:editDateSheetId},
		dataType:"json",
		success:function(result)
		{
			console.log(result);
			$("#editDateSheetId").val(result.datesheet_id);
			$("#editExamId").val(result.exam_type_id);
			$("#editClassId").val(result.class_id);
			$("#editSubjectId").val(result.subject_id);
			$("#editRoomId").val(result.room_id);
			$("#editDate").val(result.datesheet_date);
			$("#editStartTime").val(result.start_time);
			$("#editEndTime").val(result.end_time);
		}

	});	

}

$("#updateForm").submit(function(){
	
	$(".text-danger").remove();

	editClassId = $("#editClassId").val();
	editSubjectId = $("#editSubjectId").val();
	editRoomId = $("#editRoomId").val();
	editDate = $("#editDate").val();
	editStartTime = $("#editStartTime").val();
	editEndTime = $("#editEndTime").val();

	if(editClassId == "0" || editClassId == ""){
		$("#editClassId").closest(".form-group").addClass("has-danger");
		$("#editClassId").after("<span class='text-danger' > Select <b>Class </b> </span>");
	}
	else{
		$("#editClassId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#editClassId").closest(".text-danger").remove();
	}
	if(editSubjectId == "0" || editSubjectId == ""){
		$("#editSubjectId").closest(".form-group").addClass("has-danger");
		$("#editSubjectId").after("<span class='text-danger' > Select <b>Subject </b> </span>");
	}
	else{
		$("#editSubjectId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#editSubjectId").closest(".text-danger").remove();
	}
	if(editRoomId == "0" || editRoomId ==""){
		$("#editRoomId").closest(".form-group").addClass("has-danger");
		$("#editRoomId").after("<span class='text-danger' > Select <b>Room </b> </span>");
	}
	else{
		$("#editRoomId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#editRoomId").closest(".text-danger").remove();
	}
	if(editDate == "0" || editDate == ""){
		$("#editDate").closest(".form-group").addClass("has-danger");
		$("#editDate").after("<span class='text-danger' > Choose <b>Date </b> </span>");
	}
	else{
		$("#editDate").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#editDate").closest(".text-danger").remove();
	}
	if(editStartTime == "0" || editStartTime==""){
		$("#editStartTime").closest(".form-group").addClass("has-danger");
		$("#editSartTime").after("<span class='text-danger' > Enter <b>Start Time </b> </span>");
	}
	else{
		$("#editStartTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#editStartTime").closest(".text-danger").remove();
	}
	if(editEndTime == "0" || editEndTime ==""){
		$("#editEndTime").closest(".form-group").addClass("has-danger");
		$("#editEndTime").after("<span class='text-danger' > Enter <b>End Time </b> </span>");
	}
	else{
		$("#editEndTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#editEndTime").closest(".text-danger").remove();
	}

	if(editEndTime <= editStartTime){
		$("#editEndTime").closest(".form-group").addClass("has-danger");
		$("#editEndTime").after("<span class='text-danger' > Enter <b>Valid Time </b> </span>");
	}
	else{
		$("#editEndTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#editEndTime").closest(".text-danger").remove();
	}
	if(editClassId !=0 && editSubjectId !=0 && editRoomId !=0 && editDate && editEndTime > editStartTime && editStartTime && editEndTime){

	form = $(this);
	console.log(form);
	$.ajax({
	   url: form.attr("action"),
	   method:form.attr("method"),
	   data:form.serialize(),
	   dataType:"json",
	   success:function(result){
	       if(result['success'] == true)
	       {
	       		$("#updateModal").modal('hide');
				$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
				$('.alert-success').show(0).delay(2000).hide(0);
				form[0].reset();
				table.ajax.reload( null, false );
				$(".form-group").removeClass("has-error").removeClass("has-success text-success");		
	       }
	       else
	       {
	       		$("#updateModal").modal('hide');
	       		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
				$('.alert-danger').show(0).delay(2000).hide(0);
	       }
	   }
	});
	}

	return false;
});



function deleteDateSheet(datesheet_id = null){
	if(datesheet_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deletedateseet.php",
			type:"post",
			data:{datesheet_id: datesheet_id},
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