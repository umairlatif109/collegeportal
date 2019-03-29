fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#showAllParents").DataTable({'ajax':fileurl+'admin/getallparents.php'});
table.ajax.reload( null, false );

$("#saveParent").submit(function(){


	$(".text-danger").remove();

	parentName = $("#parentName").val();
	parentAddress = $("#parentAddress").val();
	parentEmail = $("#parentEmail").val();
	gender = $("input[type=radio][name=gender]:checked").val();
	parentPhone = $("#parentPhone").val();
	parentUserName = $("#parentUserName").val();
	parentPassword = $("#parentPassword").val();

	if(parentName == ""){
		$("#parentName").closest(".form-group").addClass("has-danger");
		$("#parentName").after("<span class='text-danger'>Enter <b>Parent Name</b></span>");
	}
	else{
		$("#parentName").closest(".text-danger").remove();
		$("#parentName").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}
	if(parentAddress == ""){
		$("#parentAddress").closest(".form-group").addClass("has-danger");
		$("#parentAddress").after("<span class='text-danger'>Enter <b>Parent Address</b></span>");
	}
	else{
		$("#parentAddress").closest(".text-danger").remove();
		$("#parentAddress").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}
	if(parentEmail == ""){
		$("#parentEmail").closest(".form-group").addClass("has-danger");
		$("#parentEmail").after("<span class='text-danger'>Enter <b>Parent Email</b></span>");
	}
	else{
		$("#parentEmail").closest(".text-danger").remove();
		$("#parentEmail").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}
	if(parentPhone == "0" || parentPhone.length < 11){
		$("#parentPhone").closest(".form-group").addClass("has-danger");
		$("#parentPhone").after("<span class='text-danger'>Enter <b>Valid Parent Phone</b></span>");
	}
	if(parentPhone.length > 11){
		$("#parentPhone").closest(".form-group").addClass("has-danger");
		$("#parentPhone").after("<span class='text-danger'>Enter <b>11 Digits Phone No</b></span>");
	}
	else{
		$("#parentPhone").closest(".text-danger").remove();
		$("#parentPhone").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}
	if(parentUserName == ""){
		$("#parentUserName").closest(".form-group").addClass("has-danger");
		$("#parentUserName").after("<span class='text-danger'>Enter <b>Parent Username</b></span>");
	}
	else{
		$("#parentUserName").closest(".text-danger").remove();
		$("#parentUserName").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}  

	if(parentPassword == ""){
		$("#parentPassword").closest(".form-group").addClass("has-danger");
		$("#parentPassword").after("<span class='text-danger'>Enter <b>Parent Password</b></span>");
	}  
	else{
		$("#parentPassword").closest(".text-danger").remove();
		$("#parentPassword").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}   
	if(parentName && parentAddress && parentEmail && gender && parentPhone.length == 11 && parentUserName && parentPassword){
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



function editParent(editParentId = null){

	if(editParentId){
		$.ajax({
			url:fileurl+"admin/singleparent.php",
			type:"post",
			data:{editParentId:editParentId},
			dataType:"json",
			success:function(result)
			{
				console.log(result);

				$("#editParentId").val(result.parent_id);
				$("#editParentName").val(result.parent_name);
				$("#editParentAddress").val(result.parent_address);
				$("#editParentEmail").val(result.parent_email);
				$("#editGender").val(result.parent_gender);
				$("#editParentPhone").val(result.parent_phone);
				$("#editParentUserName").val(result.parent_username);
				$("#editParentPassword").val(result.parent_password);



				$("#updateForm").submit(function(){


					$(".text-danger").remove();

					editParentName = $("#editParentName").val();
					editParentAddress = $("#editParentAddress").val();
					editParentEmail = $("#editParentEmail").val();
					editGender = $("#editGender").val();
					editParentPhone = $("#editParentPhone").val();
					editParentUserName = $("#editParentUserName").val();
					editParentPassword = $("#editParentPassword").val();

					if(editParentName == ""){
						$("#editParentName").closest(".form-group").addClass("has-danger");
						$("#editParentName").after("<span class='text-danger'>Enter <b>Parent Name</b></span>");
					}
					else{
						$("#editParentName").closest(".text-danger").remove();
						$("#editParentName").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}
					if(editParentAddress == ""){
						$("#editParentAddress").closest(".form-group").addClass("has-danger");
						$("#editParentAddress").after("<span class='text-danger'>Enter <b>Parent Address</b></span>");
					}
					else{
						$("#editParentAddress").closest(".text-danger").remove();
						$("#editParentAddress").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}
					if(editParentEmail == ""){
						$("#editParentEmail").closest(".form-group").addClass("has-danger");
						$("#editParentEmail").after("<span class='text-danger'>Enter <b>Parent Email</b></span>");
					}
					else{
						$("#editParentEmail").closest(".text-danger").remove();
						$("#editParentEmail").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}
					if(editParentPhone == "0" || editParentPhone == "" || editParentPhone.length < 11){
						$("#editParentPhone").closest(".form-group").addClass("has-danger");
						$("#editParentPhone").after("<span class='text-danger'>Enter <b>Parent Phone</b></span>");
					}
					if(editParentPhone.length > 11){
						$("#editParentPhone").closest(".form-group").addClass("has-danger");
						$("#editParentPhone").after("<span class='text-danger'>Enter <b>11 Digits Phone No.</b></span>");
					}
					else{
						$("#editParentPhone").closest(".text-danger").remove();
						$("#editParentPhone").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}
					if(editParentUserName == ""){
						$("#editParentUserName").closest(".form-group").addClass("has-danger");
						$("#editParentUserName").after("<span class='text-danger'>Enter <b>Parent Username</b></span>");
					}
					else{
						$("#editParentUserName").closest(".text-danger").remove();
						$("#editParentUserName").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}  

					if(editParentPassword == ""){
						$("#editParentPassword").closest(".form-group").addClass("has-danger");
						$("#editParentPassword").after("<span class='text-danger'>Enter <b>Parent Password</b></span>");
					}  
					else{
						$("#editParentPassword").closest(".text-danger").remove();
						$("#editParentPassword").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}   
					if(editParentName && editParentAddress && editParentEmail && editGender && editParentPhone.length == 11 && editParentUserName && editParentPassword){
						form = $(this);
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
				               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
									$('.alert-danger').show(0).delay(2000).hide(0);
				               }
					       }
						});
						console.log(form.serialize());
					}
					return false;
				});


			}
		});
	}
}



function deleteParent(parent_id = null){
	if(parent_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deleteparent.php",
			type:"post",
			data:{parent_id: parent_id},
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