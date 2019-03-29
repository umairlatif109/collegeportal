fileurl ="http://localhost/collegeportal/php_actions/";
table = $("#showAllClasses").DataTable({'ajax':fileurl+'admin/getallclasses.php'});
table.ajax.reload( null, false );


$("#saveClass").submit(function(){

	
	$(".text-danger").remove();

	className = $("#className").val();
	if(className == ""){
		$("#className").closest(".form-group").addClass("has-danger");
		$("#className").after("<span class='text-danger'>Enter <b>Class Name</b></span>");
	}
	else
	{
		$("#className").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$(".text-danger").remove();
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


function editClass(editClassId = null){
	if(editClassId){
		$.ajax({
			url:fileurl+"admin/singleclass.php",
			type:"post",
			data:{editClassId:editClassId},
			dataType:"json",
			success:function(result)
			{
				$("#editClassId").val(result.class_id);
				$("#editClassName").val(result.class_name);

				$("#updateForm").submit(function(){
					class_name = $("#editClassName").val();
					$(".text-danger").remove();
					if(class_name == "")
					{
						$("#editClassName").after("<p class='text-danger' >Enter Name</p>");
						$("#editClassName").closest(".form-group").addClass("has-error");
					}
					else{
						$(".text-danger").remove();
						$("#editName").closest(".form-group").removeClass("has-error").addClass("has-success");

						form = $(this);

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
										$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
										$('.alert-danger').show(0).delay(2000).hide(0);
										$(".form-group").removeClass("has-error").removeClass("has-success");
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


function deleteClass(class_id = null){
	if(class_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deleteclass.php",
			type:"post",
			data:{class_id: class_id},
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

function selectSubject(class_id = null){
	
	if(class_id){
		class_subjects(class_id);
		$("#subjectId").empty();
		$("#classId").val(class_id);
		$.ajax({
			url:fileurl+"admin/getallsubjects.php",
			method:"post",
			dataType:"json",
			success:function(result){
				for (var i = 0; i < result.data.length; i++) {
					$("#subjectId").append("<option value = "+result.data[i][0]+" >"+result.data[i][1]+"</option>");
				}
			}
		});
	}

}


$("#subjectForm").submit(function(){
	c_id = $("#classId").val();
	s_id = $("#subjectId").val();
	if(c_id && s_id){
		cs_form = $(this);
		$.ajax({
			url:cs_form.attr("action"),
			method:cs_form.attr("method"),
			data:cs_form.serialize(),
			dataType:"json",
			success:function(result){
					if(result.success == true){
						class_subjects(c_id);
						$(".messages").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
						$('.alert-success').show(0).delay(2000).hide(0);
						cs_form[0].reset();
						$(".form-group").removeClass("has-error").removeClass("has-success");
					}
					else
					{
						$("#subjectModal").modal('hide');	
						$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
						$('.alert-danger').show(0).delay(2000).hide(0);
						cs_form[0].reset();
						$(".form-group").removeClass("has-error").removeClass("has-success");
					}
			}
		});	
	}			

	return false;
});

function class_subjects(class_id){
		$(".tablebody").empty();
		$.ajax({
			url:fileurl+"admin/getallclasssubjects.php",
			method:"post",
			dataType:"json",
			data:{class_id,class_id},
			success:function(r){
				if(r.data.length>0){
					for (var i =0; i < r.data.length; i++) {
						$("#csr").append("<tr><td>"+r.data[i][0]+"</td><td>"+ r.data[i][1] + "</td></tr>");
					}
				}
				else{
					$("#csr").append("<tr><td colspan='2' class='text-center' > No Subject Found. </td></tr>");
				}
			}
		});
}


function deleteSubject(cs_id = null){

	class_id = $("#classId").val();

	if(cs_id){
		$.ajax({
			url:fileurl+"admin/deleteclasssubjects.php",
			type:"post",
			data:{cs_id: cs_id},
			dataType:"json",
			success:function(result){
				if(result.success == true)
				{
					$(".messages").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					class_subjects(class_id);
				}
			}
		});
	}
}