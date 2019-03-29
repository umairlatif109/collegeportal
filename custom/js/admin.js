fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#showAllUsers").DataTable({'ajax':fileurl+"admin/getallusers.php"});
table.ajax.reload( null, false );

$("#saveAdmin").submit(function(){
	$(".text-danger").remove();
	adminName = $("#adminName").val();
	adminUsername = $("#adminUsername").val();
	adminPassword = $("#adminPassword").val();

	if(adminName == ""){
		$("#adminName").closest(".form-group").addClass("has-danger");
		$("#adminName").after("<span class='text-danger'>Enter <b>Admin Name</b></span>");
	}
	else{
		$("#adminName").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#adminName").closest(".text-danger").remove();
	}
	if(adminUsername == ""){
		$("#adminUsername").closest(".form-group").addClass("has-danger");
		$("#adminUsername").after("<span class='text-danger'>Enter <b>Admin Username</b></span>");
	}
	else{
		$("#adminUsername").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#adminUsername").closest(".text-danger").remove();
	}
	if(adminPassword == ""){
		$("#adminPassword").closest(".form-group").addClass("has-danger");
		$("#adminPassword").after("<span class='text-danger'>Enter <b>Password</b></span>");
	}
	else{
		$("#adminPassword").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#adminPassword").closest(".text-danger").remove();
	}
	if(adminName && adminUsername && adminPassword){
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
					$(".form-group").removeClass("has-error").removeClass("has-success ");		
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





function editAdmin(editUserId = null){
	if(editUserId){
		$.ajax({
			url:fileurl+"admin/singleuser.php",
			type:"post",
			data:{editUserId:editUserId},
			dataType:"json",
			success:function(result)
			{
				$("#editUserId").val(result.admin_id);
				$("#editAdminName").val(result.admin_name);
				$("#editAdminUsername").val(result.admin_username);
				$("#editAdminPassword").val(result.admin_password);
				$(".text-danger").remove();
				$("#updateForm").submit(function(){


					editAdminName = $("#editAdminName").val();
					editAdminUsername = $("#editAdminUsername").val();
					editAdminPassword = $("#editAdminPassword").val();

					$(".text-danger").remove();

					if(editAdminName == ""){
						$("#editAdminName").closest(".form-group").addClass("has-danger");
						$("#editAdminName").after("<span class='text-danger'>Enter <b>Admin Name</b></span>");
					}
					else{
						$("#editAdminName").removeClass("has-danger").addClass("has-success");
						$("#editAdminName").closest(".text-danger").remove();
					}
					if(editAdminUsername == ""){
						$("#editAdminUsername").closest(".form-group").addClass("has-danger");
						$("#editAdminUsername").after("<span class='text-danger'>Enter <b>Admin Username</b></span>");
					}
					else{
						$("#editAdminUsername").removeClass("has-danger").addClass("has-success");
						$("#editAdminUsername").closest(".text-danger").remove();
					}
					if(editAdminPassword == ""){
						$("#editAdminPassword").closest(".form-group").addClass("has-danger");
						$("#editAdminPassword").after("<span class='text-danger'>Enter <b>Admin Password</b></span>");
					}
					else{
						$("#editAdminPassword").removeClass("has-danger").addClass("has-success");
						$("#editAdminPassword").closest(".text-danger").remove();
					}
					if(editAdminName && editAdminUsername && editAdminPassword){
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
									$(".form-group").removeClass("has-error").removeClass("has-success ");		
				               }
				               else
				               {
				               		$(".messages").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> "+ result.message +"</div>");
									$('.alert-danger').show(0).delay(2000).hide(0);
				               }
				           }
				       });
					}
					
					return false;
				});
			}

		});
	}
}





function deleteAdmin(admin_id = null){
	if(admin_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deleteuser.php",
			type:"post",
			data:{admin_id: admin_id},
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

