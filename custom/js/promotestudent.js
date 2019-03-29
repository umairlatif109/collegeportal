fileurl ="http://localhost/collegeportal/php_actions/";

$("#getStudentsForm").submit(function(){

	class_id =  $("#classId").val();
	to_class_id = $("#toClassId").val();

	$(".text-danger").remove();

	if(class_id == 0){
		$("#classId").closest(".form-group").addClass("has-danger");
		$("#classId").after("<span class='text-danger'>Select <b>Class Name</b></span>");
	}
	else{
		$("#classId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#classId").closest(".text-danger").remove();
	}
	if(to_class_id == 0){
		$("#toClassId").closest(".form-group").addClass("has-danger");
		$("#toClassId").after("<span class='text-danger'>Select <b>Class Name</b></span>");
	}
	else{
		$("#toClassId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#toClassId").closest(".text-danger").remove();
	}

	if(to_class_id !=0 && class_id !=0 && to_class_id == class_id){
		$("#toClassId").closest(".form-group").addClass("has-danger");
		$("#toClassId").after("<span class='text-danger'>Can't Promote to same class, Change it</span>");
	}
	else{
		$("#toClassId").closest(".form-group").removeClass("has-danger").addClass("has-success ");
		$("#toClassId").closest(".text-danger").remove();
	}

	if(class_id > 0 && to_class_id > 0 && to_class_id != class_id){

		$.ajax({
			url:fileurl+"admin/get_students_for_promotion.php",
			type:"post",
			data:{class_id: class_id},
			dataType:"json",
			success:function(result){
				if(result.success == true)
				{
					$("#getStudents").attr("disabled","disabled");
					$("#studentCard").css("display","block");
					$(".student-area").empty();
					for(i = 0; i < result.message.length; i++){
						$(".student-area").append("<tr>"+"<td>"+"<input type='hidden' name='student_id[]' value="+result.message[i]['student_id']+" />"+result.message[i]['roll_no']+"</td>"+"<td>"+result.message[i]['student_name']+"</td>"+"</tr>");
					}
				}
			}
		});
	}

	return false;
});


$("#studentsForm").submit(function(){

	form = $(this);

	$.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize()+"&class_id="+$("#classId").val()+"&to_class_id="+$("#toClassId").val(),
           dataType:"json",
           success:function(result){
               if(result['success'] == true)
               {
					$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
					$('.alert-success').show(0).delay(2000).hide(0);
					$("#studentCard").css("display","none");	
               }
               else
               {
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });

	return false;
});