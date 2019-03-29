fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#showAllStudents").DataTable({"ajax":fileurl+"admin/getallstudents.php"});
table.ajax.reload(null,false);

$("#studentRegisterDate").datepicker();
$("#editStudentRegisterDate").datepicker();

$("#saveform").submit(function(){

	$(".text-danger").remove();

	classId = $("#classId").val();
	rollNo = $("#rollNo").val();
	studentName = $("#studentName").val();
	parentId = $("#parentId").val();
	studentAddress = $("#studentAddress").val();
	studentEmail = $("#studentEmail").val();
	gender = $("input[type=radio][name=gender]:checked").val();
	studentCnic = $("#studentCnic").val();
	studentPhone = $("#studentPhone").val();
	studentPic = $("#studentPic").val();
	studentUserName = $("#studentUserName").val();
	studentPassword = $("#studentPassword").val();
	studentRegisterDate = $("#studentRegisterDate").val();

	if(classId == "0"){
		$("#classId").closest(".form-group").addClass("has-danger");
		$("#classId").after("<span class='text-danger' > Select <b>Class</b></span>");
	}
	else{
		$("#classId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#classId").closest(".text-danger").remove();
	}
	if(rollNo == "0"){
		$("#rollNo").closest(".form-group").addClass("has-danger");
		$("#rollNo").after("<span class='text-danger' > No <b>Roll No</b></span>");
	}
	else{
		$("#rollNo").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#rollNo").closest(".text-danger").remove();
	}
	if(studentName == ""){
		$("#studentName").closest(".form-group").addClass("has-danger");
		$("#studentName").after("<span class='text-danger' > Enter <b>Student Name</b></span>");
	}
	else{
		$("#studentName").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentName").closest(".text-danger").remove();
	}
	if(parentId == "0"){
		$("#parentId").closest(".form-group").addClass("has-danger");
		$("#parentId").after("<span class='text-danger' > Choose <b>Parent</b></span>");
	}
	else{
		$("#parentId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#parentId").closest(".text-danger").remove();
	}
	if(studentAddress == ""){
		$("#studentAddress").closest(".form-group").addClass("has-danger");
		$("#studentAddress").after("<span class='text-danger' > Enter <b>Student Address</b></span>");
	}
	else{
		$("#studentAddress").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentAddress").closest(".text-danger").remove();
	}
	if(studentEmail == ""){
		$("#studentEmail").closest(".form-group").addClass("has-danger");
		$("#studentEmail").after("<span class='text-danger' > Enter <b>Student Email</b></span>");
	}
	else{
		$("#studentEmail").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentEmail").closest(".text-danger").remove();
	}
	if(studentCnic == "0" || studentCnic == "" || studentCnic.length < 13){
		$("#studentCnic").closest(".form-group").addClass("has-danger");
		$("#studentCnic").after("<span class='text-danger' > Enter <b>Student CNIC</b></span>");
	}
	if(studentCnic.length > 13){
		$("#studentCnic").closest(".form-group").addClass("has-danger");
		$("#studentCnic").after("<span class='text-danger' > Enter <b>13 Digits CNIC No.</b></span>");
	}
	else{
		$("#studentCnic").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentCnic").closest(".text-danger").remove();
	}
	if(studentPhone == "0" || studentPhone == "" || studentPhone.length < 11){
		$("#studentPhone").closest(".form-group").addClass("has-danger");
		$("#studentPhone").after("<span class='text-danger' > Enter <b>Student Phone</b></span>");
	}
	if(studentPhone.length > 12){
		$("#StudentPhone").closest(".form-group").addClass("has-danger");
		$("#StudentPhone").after("<span class='text-danger' > Enter <b>11 Digits Phone No.</b></span>");
	}
	else{
		$("#studentPhone").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentPhone").closest(".text-danger").remove();
	}
	if(studentPic == ""){
		$("#studentPic").closest(".form-group").addClass("has-danger");
		$("#studentPic").after("<span class='text-danger' > Choose <b>Student Pic</b></span>");
	}
	else{
		$("#studentPic").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentPic").closest(".text-danger").remove();
	}
	if(studentUserName == ""){
		$("#studentUserName").closest(".form-group").addClass("has-danger");
		$("#studentUserName").after("<span class='text-danger'> Enter <b>Student Username</b></span>");
	}
	else{
		$("#studentUserName").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentUserName").closest(".text-danger").remove();
	}
	if(studentPassword == ""){
		$("#studentPassword").closest(".form-group").addClass("has-danger");
		$("#studentPassword").after("<span class='text-danger' > Enter <b>Password</b></span>");
	}
	else{
		$("#studentPassword").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentPassword").closest(".text-danger").remove();
	}
	if(studentRegisterDate == ""){
		$("#studentRegisterDate").closest(".form-group").addClass("has-danger");
		$("#studentRegisterDate").after("<span class='text-danger' > Choose <b>Register Date</b></span>");
	}
	else{
		$("#studentRegisterDate").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#studentRegisterDate").closest(".text-danger").remove();
	}
	if(classId && rollNo && studentName && parentId && studentAddress && studentEmail && gender && studentCnic.length == 13 && studentPhone.length == 12 && studentPic && studentUserName && studentPassword && studentRegisterDate){
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


$("#classId").change(function(){// when select tag is value will be changed this functionality will be worked.

	class_id = $("#classId").val(); // get classId from classId select tag

	if(class_id > 0){
		
		if(class_id){
		$.ajax({
			url: fileurl+"admin/getrollno.php", 
	        type: "post",
	        data: {class_id:class_id},
	        dataType:"json",
	        success: function (result) {
	            if(result.success == true){
	            	$("#rollNo").val(result.message);
	            	$("#btnStudent").removeAttr("disabled");
	            }
	            else if(result.success == false){
	            	$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
	            	$("#rollNo").val("0");
	            	$("#btnStudent").attr("disabled","disabled");
	            }
	            else{
	            	$("#rollNo").val("0");
	            }
              	 
	        }
		});

	}

	}
	else{
		$("#rollNo").val("0");
	}
});



function editStudent(editStudentId = null){
	if(editStudentId){
		$.ajax({
			url:fileurl+"admin/singlestudent.php",
			type:"post",
			data:{editStudentId:editStudentId},
			dataType:"json",
			success:function(result)
			{
				$("#editStudentId").val(result.student_id);
				$("#editStudentName").val(result.student_name);
				$("#editParentId").val(result.parent_id);
				$("#editStudentAddress").val(result.student_address);
				$("#editStudentEmail").val(result.student_email);
				$("#editGender").val(result.student_gender);
				$("#editStudentCnic").val(result.student_cnic);
				$("#editStudentPhone").val(result.student_phone);
				$("#imagePrev").attr("src",result.student_image);
				$("#editStudentUserName").val(result.student_username);
				$("#editStudentPassword").val(result.student_password);
				$("#editStudentRegisterDate").val(result.registration_date);
			}
		});
	}
}

$("#updateForm").submit(function(){

	$(".text-danger").remove();
	editStudentId = $("#editStudentId").val();
	editStudentName = $("#editStudentName").val();
	editParentId = $("#editParentId").val();
	editStudentAddress = $("#editStudentAddress").val();
	editStudentEmail = $("#editStudentEmail").val();
	editGender = $("#editGender").val();
	editStudentCnic = $("#editStudentCnic").val();
	editStudentPhone = $("#editStudentPhone").val();
	editStudentPic = $("#editStudentPic").val();
	editStudentUserName = $("#editStudentUserName").val();
	editStudentPassword = $("#editStudentPassword").val();
	editStudentRegisterDate = $("#editStudentRegisterDate").val();


	if(editStudentName == ""){
		$("#editStudentName").closest(".form-group").addClass("has-danger");
		$("#editStudentName").after("<span class='text-danger' > Enter <b>Student Name</b></span>");
	}
	else{
		$("#editStudentName").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentName").closest(".text-danger").remove();
	}
	if(editParentId == "0"){
		$("#editParentId").closest(".form-group").addClass("has-danger");
		$("#editParentId").after("<span class='text-danger' > Choose <b>Parent</b></span>");
	}
	else{
		$("#editParentId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editParentId").closest(".text-danger").remove();
	}
	if(editStudentAddress == ""){
		$("#editStudentAddress").closest(".form-group").addClass("has-danger");
		$("#editStudentAddress").after("<span class='text-danger' > Enter <b>Student Address</b></span>");
	}
	else{
		$("#editStudentAddress").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentAddress").closest(".text-danger").remove();
	}
	if(editStudentEmail == ""){
		$("#editStudentEmail").closest(".form-group").addClass("has-danger");
		$("#editStudentEmail").after("<span class='text-danger' > Enter <b>Student Email</b></span>");
	}
	else{
		$("#editStudentEmail").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentEmail").closest(".text-danger").remove();
	}
	if(editStudentCnic == "0" || editStudentCnic == "" || editStudentCnic.length < 13){
		$("#editStudentCnic").closest(".form-group").addClass("has-danger");
		$("#editStudentCnic").after("<span class='text-danger' > Enter <b>Student CNIC</b></span>");
	}
	if(editStudentCnic.length > 13){
		$("#editStudentCnic").closest(".form-group").addClass("has-danger");
		$("#editStudentCnic").after("<span class='text-danger' > Enter <b>13 Digits CNIC</b></span>");
	}
	else{
		$("#editStudentCnic").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentCnic").closest(".text-danger").remove();
	}
	if(editStudentPhone == "0" || editStudentPhone == "" || editStudentPhone.length < 11){
		$("#editStudentPhone").closest(".form-group").addClass("has-danger");
		$("#editStudentPhone").after("<span class='text-danger' > Enter <b>Student Phone</b></span>");
	}
	if(editStudentPhone.length > 11){
		$("#editStudentPhone").closest(".form-group").addClass("has-danger");
		$("#editStudentPhone").after("<span class='text-danger' > Enter <b>11 Digits Phone No.</b></span>");
	}
	else{
		$("#editStudentPhone").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentPhone").closest(".text-danger").remove();
	}
	// if(studentPic == ""){
	// 	$("#studentPic").closest(".form-group").addClass("has-danger");
	// 	$("#studentPic").after("<span class='text-danger' > Choose <b>Student Pic</b></span>");
	// }
	// else{
	// 	$("#studentPic").closest(".form-group").removeClass("has-danger").addClass("has-success ");
	// 	$("#studentPic").closest(".text-danger").remove();
	// }
	if(editStudentUserName == ""){
		$("#editStudentUserName").closest(".form-group").addClass("has-danger");
		$("#editStudentUserName").after("<span class='text-danger'> Enter <b>Student Username</b></span>");
	}
	else{
		$("#editStudentUserName").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentUserName").closest(".text-danger").remove();
	}
	if(editStudentPassword == ""){
		$("#editStudentPassword").closest(".form-group").addClass("has-danger");
		$("#editStudentPassword").after("<span class='text-danger' > Enter <b>Password</b></span>");
	}
	else{
		$("#editStudentPassword").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentPassword").closest(".text-danger").remove();
	}
	if(editStudentRegisterDate == ""){
		$("#editStudentRegisterDate").closest(".form-group").addClass("has-danger");
		$("#editStudentRegisterDate").after("<span class='text-danger' > Choose <b>Register Date</b></span>");
	}
	else{
		$("#editStudentRegisterDate").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#editStudentRegisterDate").closest(".text-danger").remove();
	}

	if(editStudentId && editStudentName && editParentId && editStudentAddress && editStudentEmail && editGender && editStudentCnic.length == 13 && editStudentPhone.length == 11 && editStudentUserName && editStudentPassword && editStudentRegisterDate){

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
					$(".messages").html("<span class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> "+ result.message +"</span>");
					$(".messages").focus();
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


function deleteStudent(student_id = null){
	if(student_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deletestudent.php",
			type:"post",
			data:{student_id: student_id},
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