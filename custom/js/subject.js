fileurl =location.protocol+"//"+location.host+"/php_actions/";

table = $("#showAllSubjects").DataTable({'ajax':fileurl+'admin/getallsubjects.php'});
table.ajax.reload( null, false );

$("#saveSubject").submit(function(){

	
	$(".text-danger").remove();

	subjectName = $("#subjectName").val();
	tMarks = $("#tMarks").val();
	pMarks = $("#pMarks").val();


	if(subjectName == ""){
		$("#subjectName").closest(".form-group").addClass("has-danger");
		$("#subjectName").after("<span class='text-danger'>Enter <b>Subject Name</b></span>");
	}
	else
	{
		$("#subjectName").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#subjectName").closest(".text-danger").remove();
	}
	if(tMarks == ""){
		$("#tMarks").closest(".form-group").addClass("has-danger");
		$("#tMarks").after("<span class='text-danger'>Enter <b>Total Marks</b></span>");
	}
	else
	{
		$("#tMarks").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#tMarks").closest(".text-danger").remove();
	}
	if(pMarks == ""){
		$("#pMarks").closest(".form-group").addClass("has-danger");
		$("#pMarks").after("<span class='text-danger'>Enter <b>Passing Marks</b></span>");
	}
	else
	{
		$("#pMarks").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#pMarks").closest(".text-danger").remove();
	}

	if(subjectName && tMarks > 0 && pMarks > 0){
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
					form[0].reset();
               }
           }
       });
	}
	return false;
});


function editSubject(editSubjectId = null){
	if(editSubjectId){
		$.ajax({
			url:fileurl+"admin/singlesubject.php",
			type:"post",
			data:{editSubjectId:editSubjectId},
			dataType:"json",
			success:function(result)
			{
				$("#editSubjectId").val(result.subject_id);
				$("#editSubjectName").val(result.subject_name);
				$("#editTmarks").val(result.t_marks);
				$("#editPmarks").val(result.p_marks);

				$("#updateForm").submit(function(){

					subject_name = $("#editSubjectName").val();
					editTmarks = $("#editTmarks").val();
					editPmarks = $("#editPmarks").val();

					$(".text-danger").remove();
					if(subject_name == "")
					{
						$("#editSubjectName").after("<p class='text-danger' >Enter Name</p>");
						$("#editSubjectName").closest(".form-group").addClass("has-error");
					}
					else{
						$(".text-danger").remove();
						$("#editSubjectName").closest(".form-group").removeClass("has-error").addClass("has-success");
					}

					if(editTmarks == ""){
						$("#editTmarks").closest(".form-group").addClass("has-danger");
						$("#editTmarks").after("<span class='text-danger'>Enter <b>Total Marks</b></span>");
					}
					else
					{
						$("#editTmarks").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editTmarks").closest(".text-danger").remove();
					}
					if(editPmarks == ""){
						$("#editPmarks").closest(".form-group").addClass("has-danger");
						$("#editPmarks").after("<span class='text-danger'>Enter <b>Passing Marks</b></span>");
					}
					else
					{
						$("#editPmarks").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editPmarks").closest(".text-danger").remove();
					}
					if(subject_name && editTmarks > 0 && editPmarks > 0){
						

						form = $("#updateForm");

						$.ajax({
							url:form.attr("action"),
							type:form.attr("method"),
							data:form.serialize(),
							dataType:"json",
							success:function(result){
									if(result.success == true){
										$("#updateModal").modal('hide');
										$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
										$('.alert-success').show(0).delay(2000).hide(0);
										form[0].reset();
										table.ajax.reload( null, false );
										$(".form-group").removeClass("has-error").removeClass("has-success");
									}
									else
									{
										$("#updateModal").modal('hide');
										$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
										$('.alert-danger').show(0).delay(2000).hide(0);
										$(".form-group").removeClass("has-error").removeClass("has-success");
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
}


function deleteSubject(subject_id = null){
	if(subject_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deletesubject.php",
			type:"post",
			data:{subject_id: subject_id},
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