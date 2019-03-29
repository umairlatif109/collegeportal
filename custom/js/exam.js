fileurl ="http://localhost/collegeportal/php_actions/";
table = $("#showAllExams").DataTable({'ajax':fileurl+'admin/getallexams.php'});
table.ajax.reload( null, false );


$("#startDate").datepicker({
	minDate:new Date()
});
$("#endDate").datepicker({
	minDate:new Date()
});
$("#editStartDate").datepicker({
	minDate:new Date()
});
$("#editEndDate").datepicker({
	minDate:new Date()
});


$("#saveExam").submit(function(){

	examName = $("#examName").val();
	startDate = $("#startDate").val();
	endDate = $("#endDate").val();
	classId = $("#classId").val();

	$(".text-danger").remove();

	if(examName == "0"){
		$("#examName").closest(".form-group").addClass("has-danger");
		$("#examName").after("<span class='text-danger'>Enter <b>Exam</b></span>");
	}
	else{
		$("#examName").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#examName").closest(".text-danger").remove();
	}

	if(startDate == ""){
		$("#startDate").closest(".form-group").addClass("has-danger");
		$("#startDate").after("<span class='text-danger'>Enter <b>Start Date</b></span>");
	}
	else{
		$("#startDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#startDate").closest(".text-danger").remove();
	}
	if(endDate == ""){
		$("#endDate").closest(".form-group").addClass("has-danger");
		$("#endDate").after("<span class='text-danger'>Enter <b>End Date</b></span>");
	}
	else{
		$("#endDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#endDate").closest(".text-danger").remove();
	}
	if(endDate <= startDate){
		$("#endDate").closest(".form-group").addClass("has-danger");
		$("#endDate").after("<p class='text-danger'>Enter <b>Valid Date</b></p>");
	}
	else{
		$("#endDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#endDate").closest(".text-danger").remove();
	}
	if(classId == 0){
		$("#classId").closest(".form-group").addClass("has-danger");
		$("#classId").after("<span class='text-danger'>Choose <b>Class</b></span>");
	}
	else{
		$("#classId").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#classId").closest(".text-danger").remove();
	}

	if(examName && startDate && endDate && classId && startDate < endDate){

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
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });
	}
	return false;
});


function editExam(exam_id = null){
	if(exam_id){
		$.ajax({
			url:fileurl+"admin/singleexam.php",
			type:"post",
			data:{exam_id:exam_id},
			dataType:"json",
			success:function(result)
			{
				$("#editExamId").val(result.exam_id);
				$("#editExamName").val(result.exam_type_id);
				$("#editClassId").val(result.class_id);
				$("#editStartDate").val(result.start_date);
				$("#editEndDate").val(result.end_date);
			}
		});
	}
}

$("#updateForm").submit(function(){

	examId = $("#editExamId").val();
	examName = $("#editExamName").val();
	startDate = $("#editStartDate").val();
	endDate = $("#editEndDate").val();
	classId = $("#editClassId").val();

	$(".text-danger").remove();

	if(examName == "0"){
		$("#editExamName").closest(".form-group").addClass("has-danger");
		$("#editExamName").after("<span class='text-danger'>Enter <b>Exam</b></span>");
	}
	else{
		$("#editExamName").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#editExamName").closest(".text-danger").remove();
	}

	if(startDate == ""){
		$("#editStartDate").closest(".form-group").addClass("has-danger");
		$("#editStartDate").after("<span class='text-danger'>Enter <b>Start Date</b></span>");
	}
	else{
		$("#editStartDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#editStartDate").closest(".text-danger").remove();
	}
	if(endDate == ""){
		$("#editEndDate").closest(".form-group").addClass("has-danger");
		$("#editEndDate").after("<span class='text-danger'>Enter <b>End Date</b></span>");
	}
	else{
		$("#editEndDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#editEndDate").closest(".text-danger").remove();
	}
	if(endDate <= startDate){
		$("#editEndDate").closest(".form-group").addClass("has-danger");
		$("#editEndDate").after("<p class='text-danger'>Enter <b>Valid Date</b></p>");
	}
	else{
		$("#editEndDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#editEndDate").closest(".text-danger").remove();
	}
	if(classId == 0){
		$("#editClassId").closest(".form-group").addClass("has-danger");
		$("#editClassId").after("<span class='text-danger'>Choose <b>Class</b></span>");
	}
	else{
		$("#editClassId").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#editClassId").closest(".text-danger").remove();
	}

	if(examName && startDate && endDate && classId && startDate < endDate){

        form = $(this);
        $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
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


function deleteExam(exam_id = null){
	if(exam_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deleteexam.php",
			type:"post",
			data:{exam_id: exam_id},
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