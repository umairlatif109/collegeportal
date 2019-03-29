fileurl ="http://localhost/collegeportal/php_actions/";

$("#teacherHireDate").datepicker();
$("#editTeacherHireDate").datepicker();

table = $("#showAllTeachers").DataTable({"ajax":fileurl+"admin/getallteachers.php"});

table.ajax.reload(null,false);


$("#subjectId").attr("disabled","disabled");


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


$("#saveTeacher").submit(function(){

	teacherName = $("#teacherName").val();
	teacherAddress = $("#teacherAddress").val();
	teacherQualification = $("#teacherQualification").val();
	gender = $("input[type=radio][name=gender]:checked").val();
	teacherPhone = $("#teacherPhone").val();
	teacherEmail = $("#teacherEmail").val();
	teacherCnic = $("#teacherCnic").val();
	teacherPic = $("#teacherPic").val();
	teacherUserName = $("#teacherUserName").val();
	teacherPassword = $("#teacherPassword").val();
	teacherHireDate = $("#teacherHireDate").val();
	
	$(".text-danger").remove();

	if(teacherName == ""){
		$("#teacherName").closest(".form-group").addClass("has-danger");
		$("#teacherName").after("<span class='text-danger'>Enter <b>Teacher Name</b></span>").focus();
	}
	else{
		$("#teacherName").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#teacherName").closest(".text-danger").remove();
	}

	if(teacherAddress == ""){
		$("#teacherAddress").closest(".form-group").addClass("has-danger");
		$("#teacherAddress").after("<span class='text-danger'>Enter <b>Teacher Address</b></span>").focus();
	}
	else{
		$("#teacherAddress").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#teacherAddress").closest(".text-danger").remove();
	}

	if(teacherQualification == ""){
		$("#teacherQualification").closest(".form-group").addClass("has-danger");
		$("#teacherQualification").after("<span class='text-danger'>Enter <b>Teacher Qualification</b></span>").focus();
	}
	else{
		$("#teacherQualification").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#teacherQualification").closest(".text-danger").remove();
	}

	if(teacherPhone == "0" || teacherPhone == "" || teacherPhone.length < 11){
		$("#teacherPhone").closest(".form-group").addClass("has-danger");
		$("#teacherPhone").after("<span class='text-danger'>Enter <b>Teacher Phone</b></span>").focus();
	}
	if(teacherPhone.length > 11){
		$("#teacherPhone").closest(".form-group").addClass("has-danger");
		$("#teacherPhone").after("<span class='text-danger'>Enter <b>11 Digits Phone No.</b></span>").focus();
	}
	else{
		$("#teacherPhone").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#teacherPhone").closest(".text-danger").remove();
	}

	if(teacherEmail == ""){
		$("#teacherEmail").closest(".form-group").addClass("has-danger");
		$("#teacherEmail").after("<span class='text-danger'>Enter <b>Teacher Email</b></span>").focus();
	}
	else{
		$("#teacherEmail").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#teacherEmail").closest(".text-danger").remove();
	}

	if(teacherCnic == "" || teacherCnic == "0" || teacherCnic.length < 13){
		$("#teacherCnic").closest(".form-group").addClass("has-danger");
		$("#teacherCnic").after("<span class='text-danger'>Enter <b>Teacher CNIC</b></span>").focus();
	}
	if(teacherCnic.length > 13){
		$("#teacherCnic").closest(".form-group").addClass("has-danger");
		$("#teacherCnic").after("<span class='text-danger'>Enter <b>13 Digits CNIC</b></span>").focus();
	}
	else{
		$("#teacherCnic").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#teacherCnic").closest(".text-danger").remove();
	}

	if(teacherPic== ""){
		$("#teacherPic").closest(".form-group").addClass("has-danger");
		$("#teacherPic").after("<span class='text-danger'>Select <b>Teacher Pic</b></span>").focus();
	}
	else{
		$("#teacherPic").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#teacherPic").closest(".text-danger").remove();
	}

	if(teacherUserName == ""){
		$("#teacherUserName").closest(".form-group").addClass("has-danger");
		$("#teacherUserName").after("<span class='text-danger'>Enter <b>Teacher Username</b></span>").focus();
	}
	else{
		$("#teacherUserName").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#teacherUserName").closest(".text-danger").remove();
	}

	if(teacherPassword == ""){
		$("#teacherPassword").closest(".form-group").addClass("has-danger");
		$("#teacherPassword").after("<span class='text-danger'>Enter <b>Password</b></span>").focus();
	}
	else{
		$("#teacherPassword").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#teacherPassword").closest(".text-danger").remove();
	}

	if(teacherHireDate == ""){
		$("#teacherHireDate").closest(".form-group").addClass("has-danger");
		$("#teacherHireDate").after("<span class='text-danger'>Enter <b>Teacher Hire Date</b></span>").focus();
	}
	else{
		$("#teacherHireDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#teacherHireDate").closest(".text-danger").remove();
	}

	if(teacherName && teacherAddress && teacherQualification && gender && teacherPhone.length == 11 && teacherEmail && teacherCnic.length == 13 && teacherPic && teacherUserName && teacherPassword && teacherHireDate){
		form = $(this);
		formdata = new FormData(this); // new FormData gets fields values as well as file attached with this form
		
	    $.ajax({
	        url: form.attr("action"),
	        type: form.attr("method"),
	        data: formdata,
	        dataType:"json",
	        success: function (result) {
	            if(result['success'] == true)
               {
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					form[0].reset();
					table.ajax.reload( null, false );
					console.log(result);
					$(".form-group").removeClass("has-error").removeClass("has-success text-success");		
               }
               else
               {
               		console.log(result);
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
	        },
	        cache: false,			//
	        contentType: false,		// these three lines are about submit form with file means image
	        processData: false		//
	    });
	}

	return false;
});


function editTeacher(editTeacherId = null){
	if(editTeacherId){
		$.ajax({
			url:fileurl+"admin/singleteacher.php",
			type:"post",
			data:{editTeacherId:editTeacherId},
			dataType:"json",
			success:function(result)
			{
				$("#editTeacherId").val(result.teacher_id);
				$("#editTeacherName").val(result.teacher_name);
				$("#editTeacherAddress").val(result.teacher_address);
				$("#editTeacherQualification").val(result.teacher_qualification);
				$("#editGender").val(result.teacher_gender);
				$("#editTeacherPhone").val(result.teacher_phone);
				$("#editTeacherEmail").val(result.teacher_email);
				$("#editTeacherCnic").val(result.teacher_cnic);
				$("#editTeacherUserName").val(result.teacher_username);
				$("#editTeacherPassword").val(result.teacher_password);
				$("#editTeacherHireDate").val(result.hire_date);
				$("#imagePrev").attr("src",result.student_image);

				$("#updateForm").submit(function(){
	
					editTeacherName = $("#editTeacherName").val();
					editTeacherAddress = $("#editTeacherAddress").val();
					editTeacherQualification = $("#editTeacherQualification").val();
					editGender = $("#editGender").val();
					editTeacherPhone = $("#editTeacherPhone").val();
					editTeacherEmail = $("#editTeacherEmail").val();
					editTeacherCnic = $("#editTeacherCnic").val();
					editTeacherPic = $("#editTeacherPic").val();
					editTeacherUserName = $("#editTeacherUserName").val();
					editTeacherPassword = $("#editTeacherPassword").val();
					editTeacherHireDate = $("#editTeacherHireDate").val();
					
					$(".text-danger").remove();

					if(editTeacherName == ""){
						$("#editTeacherName").closest(".form-group").addClass("has-danger");
						$("#editTeacherName").after("<span class='text-danger'>Enter <b>Teacher Name</b></span>").focus();
					}
					else{
						$("#editTeacherName").closest(".form-group").removeClass("has-danger").addClass("has-success ");
						$("#editTeacherName").closest(".text-danger").remove();
					}

					if(editTeacherAddress == ""){
						$("#editTeacherAddress").closest(".form-group").addClass("has-danger");
						$("#editTeacherAddress").after("<span class='text-danger'>Enter <b>Teacher Address</b></span>").focus();
					}
					else{
						$("#editTeacherAddress").closest(".form-group").removeClass("has-danger").addClass("has-success ");
						$("#editTeacherAddress").closest(".text-danger").remove();
					}

					if(editTeacherQualification == ""){
						$("#editTeacherQualification").closest(".form-group").addClass("has-danger");
						$("#editTeacherQualification").after("<span class='text-danger'>Enter <b>Teacher Qualification</b></span>").focus();
					}
					else{
						$("#editTeacherQualification").closest(".form-group").removeClass("has-danger").addClass("has-success ");
						$("#editTeacherQualification").closest(".text-danger").remove();
					}

					if(editTeacherPhone == "" || editTeacherPhone == "0" || editTeacherPhone.length < 11){
						$("#editTeacherPhone").closest(".form-group").addClass("has-danger");
						$("#editTeacherPhone").after("<span class='text-danger'>Enter <b>Teacher Phone</b></span>").focus();
					}
					if(editTeacherPhone.length > 11){
						$("#editTeacherPhone").closest(".form-group").addClass("has-danger");
						$("#editTeacherPhone").after("<span class='text-danger'>Enter <b>11 Digits Phone No.</b></span>").focus();
					}
					else{
						$("#editTeacherPhone").closest(".form-group").removeClass("has-danger").addClass("has-success ");
						$("#editTeacherPhone").closest(".text-danger").remove();
					}

					if(editTeacherEmail == ""){
						$("#editTeacherEmail").closest(".form-group").addClass("has-danger");
						$("#editTeacherEmail").after("<span class='text-danger'>Enter <b>Teacher Email</b></span>").focus();
					}
					else{
						$("#editTeacherEmail").closest(".form-group").removeClass("has-danger").addClass("has-success ");
						$("#editTeacherEmail").closest(".text-danger").remove();
					}

					if(editTeacherCnic == "" || editTeacherCnic == "0" || editTeacherCnic.length < 13){
						$("#editTeacherCnic").closest(".form-group").addClass("has-danger");
						$("#editTeacherCnic").after("<span class='text-danger'>Enter <b>Teacher CNIC</b></span>").focus();
					}
					if(editTeacherCnic.length > 13){
						$("#editTeacherCnic").closest(".form-group").addClass("has-danger");
						$("#editTeacherCnic").after("<span class='text-danger'>Enter <b>13 Digits CNIC</b></span>").focus();
					}
					else{
						$("#editTeacherCnic").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editTeacherCnic").closest(".text-danger").remove();
					}

					// if(editTeacherPic== ""){
					// 	$("#editTeacherPic").closest(".form-group").addClass("has-danger");
					// 	$("#editTeacherPic").after("<span class='text-danger'>Select <b>Teacher Pic</b></span>").focus();
					// }
					// else{
					// 	$("#editTeacherPic").closest(".form-group").removeClass("has-danger").addClass("has-success");
					// 	$("#editTeacherPic").closest(".text-danger").remove();
					// }

					if(editTeacherUserName == ""){
						$("#editTeacherUserName").closest(".form-group").addClass("has-danger");
						$("#editTeacherUserName").after("<span class='text-danger'>Enter <b>Teacher Username</b></span>").focus();
					}
					else{
						$("#editTeacherUserName").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editTeacherUserName").closest(".text-danger").remove();
					}

					if(editTeacherPassword == ""){
						$("#editTeacherPassword").closest(".form-group").addClass("has-danger");
						$("#editTeacherPassword").after("<span class='text-danger'>Enter <b>Password</b></span>").focus();
					}
					else{
						$("#editTeacherPassword").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editTeacherPassword").closest(".text-danger").remove();
					}

					if(editTeacherHireDate == ""){
						$("#editTeacherHireDate").closest(".form-group").addClass("has-danger");
						$("#editTeacherHireDate").after("<span class='text-danger'>Enter <b>Teacher Hire Date</b></span>").focus();
					}
					else{
						$("#editTeacherHireDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editTeacherHireDate").closest(".text-danger").remove();
					}

					if(editTeacherName && editTeacherAddress  && editTeacherQualification && editGender && editTeacherPhone.length == 11 && editTeacherEmail && editTeacherCnic.length == 13 && editTeacherUserName && editTeacherPassword && editTeacherHireDate){
						
						updateForm = $(this);// gets form

						updateFormData = new FormData(this); // get form data with image
						
						//calling ajax function
						$.ajax({
					        url: updateForm.attr("action"),
					        type: updateForm.attr("method"),
					        data: updateFormData,
					        dataType:"json",
					        success: function (result) {
					            if(result.success == true){
										$("#updateModal").modal('hide');
										$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
										$('.alert-success').show(0).delay(2000).hide(0);
										updateForm[0].reset();
										table.ajax.reload( null, false );
										$(".form-group").removeClass("has-error").removeClass("has-success");
									}
									else
									{
										$(".message").html("<span class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</span>");
										$(".message").focus();
										$('.alert-danger').show(0).delay(2000).hide(0);
										$(".form-group").removeClass("has-error").removeClass("has-success");
									}
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
					}
					return false;
				});
			}
		});
	}
}


function deleteTeacher(teacher_id = null){
	if(teacher_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deleteteacher.php",
			type:"post",
			data:{teacher_id: teacher_id},
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


// this function will be called when click on view button
function teacherSubject(teacherId = null){
	if(teacherId){
		getall_subjects(teacherId);
		$("#teacherId").val(teacherId);	
	}
}


// update teacher 
$("#teacherSubjectForm").submit(function(){
			teacherId =  $("#teacherId").val();
			classId = $("#classId").val();
			subjectId = $("#subjectId").val();

			$(".text-danger").remove();

			if(classId == "0"){
				$("#classId").closest(".form-group").addClass("has-danger");
				$("#classId").after("<span class='text-danger'>Select <b>Class</b></span>");
			}
			else{
				$("#classId").closest(".form-group").removeClass("has-danger").addClass("has-success");
				$(".text-danger").remove();
			}

			if(subjectId == "0"){
				$("#subjectId").closest(".form-group").addClass("has-danger");
				$("#subjectId").after("<span class='text-danger'>Select <b>Subject</b></span>");
			}
			else{
				$("#subjectId").closest(".form-group").removeClass("has-danger").addClass("has-success");
				$(".text-danger").remove();
			}

			if(teacherId && classId > 0 && subjectId > 0){
				form = $(this);
				$.ajax({

					url:form.attr("action"),
					method:form.attr("method"),
					data:form.serialize(),
					dataType:"json",
					success:function(result){

						if(result.success == true){
							getall_subjects(teacherId);
							$(".messages").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
							$('.alert-success').show(0).delay(2000).hide(0);
							form[0].reset();
							$(".form-group").removeClass("has-error").removeClass("has-success");
						}
						else
						{
							$(".messages").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
							$('.alert-danger').show(0).delay(2000).hide(0);
							form[0].reset();
							$(".form-group").removeClass("has-error").removeClass("has-success");
						}
					}
				});
			}
			return false;
		});


//Delete Teacher subject record from teacher_subject_information 
function deleteSubject(ts_id = null){
	teacher_id = $("#teacherId").val();
	if(ts_id){
		$.ajax({
			url:fileurl+"admin/delete_teacher_subjects.php",
			type:"post",
			data:{ts_id: ts_id},
			dataType:"json",
			success:function(result){
				if(result.success == true)
				{
					$(".messages").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					getall_subjects(teacher_id);
				}
			}
		});
	}
}


//This function will get all subject from the teacher_subject_information and show it to the table #tcsr
function getall_subjects(teacher_id){
	$(".tablebody").empty();
	$.ajax({
		url:fileurl+"admin/getall_teacher_subjects.php",
		method:"post",
		dataType:"json",
		data:{teacher_id,teacher_id},
		success:function(r){
			if(r.data.length>0){
				for (var i =0; i < r.data.length; i++) {
					$("#tcsr").append("<tr><td>"+r.data[i][0]+"</td><td>"+ r.data[i][1] + "</td><td>"+ r.data[i][2] +"</tr>");
				}
			}
			else{
				$("#tcsr").append("<tr><td colspan='3' class='text-center' > No Subject Found. </td></tr>");
			}
			console.log(r);
		}
	});
}