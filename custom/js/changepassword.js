fileurl ="http://localhost/collegeportal/php_actions/";

$("#updateForm").submit(function(){

	$(".text-danger").remove();
	currentPassword = $("#currentPassword").val();
	newPassword = $("#newPassword").val();
	confirmPassword = $("#confirmPassword").val();

	if(currentPassword == ""){
		$("#currentPassword").closest(".form-group").addClass("has-danger");
		$("#currentPassword").after("<span class='text-danger'>Enter <b>Password</b></span>");
	}
	else{
		$("#currentPassword").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#currentPassword").closest(".text-danger").remove();
	}
	if(newPassword == ""){
		$("#newPassword").closest(".form-group").addClass("has-danger");
		$("#newPassword").after("<span class='text-danger'>Enter <b>New Password</b></span>");
	}
	else if(newPassword.length <= 7){
		$("#newPassword").closest(".form-group").addClass("has-danger");
		$("#newPassword").after("<span class='text-danger'>Password Length Should be 8 or more</span>");
	}
	else{
		$("#newPassword").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#newPassword").closest(".text-danger").remove();
	}
	if(confirmPassword == ""){
		$("#confirmPassword").closest(".form-group").addClass("has-danger");
		$("#confirmPassword").after("<span class='text-danger'>Enter <b>Confirm Password</b></span>");
	}
	else if(confirmPassword.length <= 7){
		$("#confirmPassword").closest(".form-group").addClass("has-danger");
		$("#confirmPassword").after("<span class='text-danger'>Password Length Should be 8 or more</span>");
	}
	else{
		$("#confirmPassword").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#confirmPassword").closest(".text-danger").remove();
	}

	if(newPassword != confirmPassword){
		$("#confirmPassword").closest(".form-group").addClass("has-danger");
		$("#confirmPassword").after("<p class='text-danger'>Password Mismatch</p>");
	}
	if(currentPassword && newPassword.length > 7 && confirmPassword.length > 7 && newPassword == confirmPassword){
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
					$(".form-group").removeClass("has-error").removeClass("has-success");		
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