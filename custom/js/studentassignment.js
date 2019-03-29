fileurl ="http://localhost/collegeportal/php_actions/";

$("#uploadAssignment").submit(function(){
	uploadFile = $("#studentAssignment").val();
	if(uploadFile==""){
		$('#uploadAssignment').addClass('has-danger');
	}
	else{
		$('#uploadAssignment').removeClass('has-danger').addClass('has-success');
	}
	if(uploadFile){
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
					location.reload();
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
})