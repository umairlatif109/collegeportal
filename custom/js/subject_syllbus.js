fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#showAllContents").DataTable({"ajax": fileurl+"admin/getallsubject_syllbus.php"});
table.ajax.reload(null,false);
$("#saveform").submit(function(){

	$(".text-danger").remove();
	classId = $("#classId").val();
	subjectId = $("#subjectId").val();
	subjectContents = CKEDITOR.instances.subjectContents.getData();

	if(classId == "0"){
		$("#classId").closest(".form-group").addClass("has-danger");
		$("#classId").after("<span class='text-danger' > Select <b>Class</b> </span>");
	}
	else{
		$("#classId").closest(".text-danger").remove();
		$("#classId").closest(".form-group").removeClass("has-danger").addClass("has-success");	
	}

	if(subjectId == "0"){
		$("#subjectId").closest(".form-group").addClass("has-danger");
		$("#subjectId").after("<span class='text-danger' > Select <b>Subject</b> </span>");
	}
	else{
		$("#subjectId").closest(".text-danger").remove();
		$("#subjectId").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}

	if(subjectContents == ""){
		$("#subjectContents").closest(".form-group").addClass("has-danger");
		$("#subjectContents").after("<span class='text-danger' > Enter <b>Subject Contents</b> </span>");
	}
	else{
		$("#subjectContents").closest(".text-danger").remove();
		$("#subjectContents").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}

	if(subjectId && classId && subjectContents ){

		$("#subjectContents").val(CKEDITOR.instances.subjectContents.getData());

		console.log($("#subjectContents").val());
		form = $(this);

		$.ajax({
			url:form.attr("action"),
			method:form.attr("method"),
			data:form.serialize(),
			dataType:"json",
			success:function(result){
				if(result['success'] == true){
					CKEDITOR.instances.subjectContents.setData("");
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					form[0].reset();
					table.ajax.reload( null, false );
					$(".form-group").removeClass("has-error").removeClass("has-success text-success");		
               }
               else{
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }			
           }
		});
	}

	return false;
});

function editContents(editContentId = null){

	if(editContentId){
		$.ajax({
			url:fileurl+"admin/singlesubject_syllbus.php",
			type:"post",
			data:{editContentId:editContentId},
			dataType:"json",
			success:function(result)
			{
				$("#EditSsId").val(result.ss_id);
				$("#editClassId").val(result.class_id);
				$("#editSubjectId").val(result.subject_id);
				$("#editSubjectContents").text(result.subject_contents);
				CKEDITOR.instances.editSubjectContents.setData($("#editSubjectContents").val());

				$("#updateForm").submit(function(){
					$(".text-danger").remove();
					
					editClassId = $("#editClassId").val();
					editSubjectId = $("#editSubjectId").val();
					editSubjectContents = CKEDITOR.instances.editSubjectContents.getData();

					if(editClassId == "0"){
						$("#editClassId").closest(".form-group").addClass("has-danger");
						$("#editClassId").after("<span class='text-danger' >Select <b>Class</b></span>");
					}
					else{
						$("#editClassId").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editClassId").closest(".text-danger").remove();
					}

					if(editSubjectId == "0"){
						$("#editSubjectId").closest(".form-group").addClass("has-danger");
						$("#editSubjectId").after("<span class='text-danger' >Select <b>Subject</b></span>");
					}
					else{
						$("#editSubjectId").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editSubjectId").closest(".text-danger").remove();
					}

					if(editSubjectContents == "" ){
						$("#editSubjectContents").closest(".form-group").addClass("has-danger");
						$("#editSubjectContents").after("<span class='text-danger' >Enter <b>Contents</b></span>");
					}
					else{
						$("#editSubjectContents").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editSubjectContents").closest(".text-danger").remove();
					}

					if(editClassId && editSubjectId && editSubjectContents){

						$("#editSubjectContents").val(CKEDITOR.instances.editSubjectContents.getData());

						$("#editClassId").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editSubjectId").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editSubjectContents").closest(".form-group").removeClass("has-danger").addClass("has-success");

						$(".text-danger").remove();
				        form = $(this);
				        console.log(form.serialize());
				        $.ajax({
				           url: form.attr("action"),
				           method:form.attr("method"),
				           data:form.serialize(),
				           dataType:"json",
				           success:function(result){
				               if(result['success'] == true)
				               {
				               		CKEDITOR.instances.editSubjectContents.setData("");
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
			}
		});
	}
}

function deleteContent(content_id = null){
	if(content_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/delete_subject_syllbus.php",
			type:"post",
			data:{content_id: content_id},
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