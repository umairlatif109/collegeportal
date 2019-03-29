fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#showAllTimetables").DataTable({'ajax':fileurl+'admin/getalltimetables.php'});
table.ajax.reload( null, false );

$("#subjectId").attr("disabled","disabled");
$("#teacherId").attr("disabled","disabled");

$("#editSubjectId").attr("disabled","disabled");
$("#editTeacherId").attr("disabled","disabled");

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
			$("#teacherId").attr("disabled","disabled");
			$("#subjectId").find("option").remove();
			$("#teacherId").find("option").remove();
		}

});

$("#subjectId").change(function(){ // this will get all teachres when subject and class will be changed

	class_id = $("#classId").val();
	subject_id = $("#subjectId").val();
		if(class_id > 0 && subject_id > 0){
			$.ajax({
				url:fileurl+"admin/gettimetableteachers.php",
				type:"post",
				dataType:"json",
				data:{class_id:class_id,subject_id:subject_id},
				success:function(result){
					$("#teacherId").html("<option value = '0'>--- Select Teacher ---</option>");
					$("#teacherId").removeAttr("disabled");
					for (var i = 0; i < result.data.length; i++) {
						$("#teacherId").append("<option value = "+result.data[i][1]+" >"+result.data[i][0]+"</option>");
					}
				}

			});
		}
		else{
			$("#teacherId").attr("disabled","disabled");
			$("#teacherId").val("");
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
			$("#editTeacherId").attr("disabled","disabled");
			$("#editSubjectId").find("option").remove();
			$("#editTeacherId").find("option").remove();
		}

});

//this is for edit timetable dialog
$("#editSubjectId").change(function(){ // this will get all teachres when subject and class will be changed

	class_id = $("#editClassId").val();
	subject_id = $("#editSubjectId").val();
		if(class_id > 0 && subject_id > 0){
			$.ajax({
				url:fileurl+"admin/gettimetableteachers.php",
				type:"post",
				dataType:"json",
				data:{class_id:class_id,subject_id:subject_id},
				success:function(result){
					$("#editTeacherId").html("<option value = '0'>--- Select Teacher ---</option>");
					$("#editTeacherId").removeAttr("disabled");
					for (var i = 0; i < result.data.length; i++) {
						$("#editTeacherId").append("<option value = "+result.data[i][1]+" >"+result.data[i][0]+"</option>");
					}
				}

			});
		}
		else{
			$("#editTeacherId").attr("disabled","disabled");
			$("#editTeacherId").val("");
		}

});





$("#saveTimeTable").submit(function(){// submit form 


	classId = $("#classId").val();
	subjectId = $("#subjectId").val();
	teacherId = $("#teacherId").val();
	roomId = $("#roomId").val();
	selectDay = $("#selectDay").val();
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
	if(teacherId == 0 || teacherId == ""){
		$("#teacherId").closest(".form-group").addClass("has-danger");
		$("#teacherId").after("<span class='text-danger' > Select <b>Teacher </b> </span>");
	}
	else{
		$("#teacherId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#teacherId").closest(".text-danger").remove();
	}
	if(roomId == "0" || roomId ==""){
		$("#roomId").closest(".form-group").addClass("has-danger");
		$("#roomId").after("<span class='text-danger' > Select <b>Room </b> </span>");
	}
	else{
		$("#roomId").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#roomId").closest(".text-danger").remove();
	}
	if(selectDay == "0" || selectDay == ""){
		$("#selectDay").closest(".form-group").addClass("has-danger");
		$("#selectDay").after("<span class='text-danger' > Select <b>Day </b> </span>");
	}
	else{
		$("#selectDay").closest(".form-group").addClass("has-success").removeClass("has-danger");
		$("#selectDay").closest(".text-danger").remove();
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
	if(classId!=0 && subjectId!=0 && teacherId!= 0 && roomId!=0 && selectDay!=0 && startTime && endTime){

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
					$("#teacherId").attr("disabled","disabled");
					$("#subjectId").find("option").remove();
					$("#teacherId").find("option").remove();
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



function editTimeTable(editTimeTableId = null){
			$.ajax({
				url:fileurl+"admin/singletimetable.php",
				type:"post",
				data:{editTimeTableId:editTimeTableId},
				dataType:"json",
				success:function(result)
				{

					$("#editTimeTableId").val(result.timetable_id);
					$("#editClassId").val(result.class_id);
					$("#editSubjectId").val(result.subject_id);
					$("#editTeacherId").val(result.teacher_id);
					$("#editRoomId").val(result.room_id);
					$("#editSelectDay").val(result.day);
					$("#editSartTime").val(result.start_time);
					$("#editEndTime").val(result.end_time);

					$("#editSubjectId").removeAttr("disabled");
					$("#editTeacherId").removeAttr("disabled");

					$("#updateForm").submit(function(){// submit form 


						editClassId = $("#editClassId").val();
						editSubjectId = $("#editSubjectId").val();
						editTeacherId = $("#editTeacherId").val();
						editRoomId = $("#editRoomId").val();
						editSelectDay = $("#editSelectDay").val();
						editSartTime = $("#editSartTime").val();
						editEndTime = $("#editEndTime").val();

						$(".text-danger").remove();

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
						if(editTeacherId == "0" || editTeacherId == ""){
							$("#editTeacherId").closest(".form-group").addClass("has-danger");
							$("#editTeacherId").after("<span class='text-danger' > Select <b>Teacher </b> </span>");
						}
						else{
							$("#editTeacherId").closest(".form-group").addClass("has-success").removeClass("has-danger");
							$("#editTeacherId").closest(".text-danger").remove();
						}
						if(editRoomId == "0" || editRoomId ==""){
							$("#editRoomId").closest(".form-group").addClass("has-danger");
							$("#editRoomId").after("<span class='text-danger' > Select <b>Room </b> </span>");
						}
						else{
							$("#editRoomId").closest(".form-group").addClass("has-success").removeClass("has-danger");
							$("#editRoomId").closest(".text-danger").remove();
						}
						if(editSelectDay == "0" || editSelectDay == ""){
							$("#editSelectDay").closest(".form-group").addClass("has-danger");
							$("#editSelectDay").after("<span class='text-danger' > Select <b>Day </b> </span>");
						}
						else{
							$("#editSelectDay").closest(".form-group").addClass("has-success").removeClass("has-danger");
							$("#editSelectDay").closest(".text-danger").remove();
						}
						if(editSartTime == "0" || editSartTime==""){
							$("#editSartTime").closest(".form-group").addClass("has-danger");
							$("#editSartTime").after("<span class='text-danger' > Enter <b>Start Time </b> </span>");
						}
						else{
							$("#editSartTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
							$("#editSartTime").closest(".text-danger").remove();
						}
						if(editEndTime == "0" || editEndTime ==""){
							$("#editEndTime").closest(".form-group").addClass("has-danger");
							$("#editEndTime").after("<span class='text-danger' > Enter <b>End Time </b> </span>");
						}
						else{
							$("#editEndTime").closest(".form-group").addClass("has-success").removeClass("has-danger");
							$("#editEndTime").closest(".text-danger").remove();
						}
						if(editClassId && editSubjectId && editTeacherId && editRoomId && editSelectDay && editSartTime && editEndTime){

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
										form[0].reset();
					               }
					           }
					       });
						}
						return false;
					});
				}
			});
}








function deleteTimeTable(timetable_id = null){
	if(timetable_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deletetimetable.php",
			type:"post",
			data:{timetable_id: timetable_id},
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