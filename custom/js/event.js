fileurl ="http://localhost/collegeportal/php_actions/";

table = $("#showAllEvents").DataTable({'ajax':fileurl+'admin/getallevents.php'});
table.ajax.reload( null, false );
$("#eventDate").datepicker({
	minDate:new Date()
});
$("#editEventDate").datepicker({
	minDate:new Date()
});


$("#saveEvent").submit(function(){

	eventTitle = $("#eventTitle").val();
	eventDetail = CKEDITOR.instances.eventDetail.getData();//$("#eventDetail").val();
	eventDate = $("#eventDate").val();

	$(".text-danger").remove();

	if(eventTitle == "")
	{
		$("#eventTitle").closest(".form-group").addClass("has-danger");
		$("#eventTitle").after("<span class='text-danger'> Enter <b>Event Titile</b> </span>");
	}
	else
	{
		$("#eventTitle").closest(".text-danger").remove();
		$("#eventTitle").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}
	if(eventDetail == "")
	{
		$("#eventDetail").closest(".form-group").addClass("has-danger");
		$("#eventDetail").after("<span class='text-danger'> Enter <b>Event Detail</b> </span>");
	}
	else
	{
		$("#eventDetail").closest(".text-danger").remove();
		$("#eventDetail").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}
	if(eventDate == "")
	{
		$("#eventDate").closest(".form-group").addClass("has-danger");
		$("#eventDate").after("<span class='text-danger'> Enter <b>Event Date</b> </span>");
	}
	else
	{
		$("#eventDate").closest(".text-danger").remove();
		$("#eventDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
	}

	if(eventTitle && eventDetail && eventDate){

		$("#eventDetail").val(CKEDITOR.instances.eventDetail.getData());
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
						$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
						$('.alert-success').show(0).delay(2000).hide(0);
						form[0].reset();
						CKEDITOR.instances.eventDetail.setData("");
						table.ajax.reload( null, false );
						$(".form-group").removeClass("has-error").removeClass("has-success text-success");		
	               }
	               else
	               {
	               		$(".messages").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> "+ result.message +"</div>");
						$('.alert-danger').show(0).delay(2000).hide(0);
						form[0].reset();
	               }
	           }
		});
	}
	return false;
});



function editEvent(editEventId = null){

	if(editEventId){
		$.ajax({
			url:fileurl+"admin/singleevent.php",
			type:"post",
			data:{editEventId:editEventId},
			dataType:"json",
			success:function(result)
			{
				$("#editEventId").val(result.event_id);
				$("#editEventTitle").val(result.event_title);
				$("#editEventStatus").val(result.event_status);
				$("#editEventDetail").text(result.event_detail);
				CKEDITOR.instances.editEventDetail.setData($("#editEventDetail").val());
				$("#editEventDate").val(result.event_date);

				$("#updateForm").submit(function(){

					$(".text-danger").remove();
					
					editEventId = $("#editEventId").val();
					editEventTitle = $("#editEventTitle").val();
					editEventDetail = CKEDITOR.instances.editEventDetail.getData();
					editEventStatus = $("#editEventStatus").val();
					editEventDate = $("#editEventDate").val();


					if(editEventTitle == "")
					{
						$("#editEventTitle").closest(".form-group").addClass("has-danger");
						$("#editEventTitle").after("<span class='text-danger'> Enter <b>Event Titile</b> </span>");
					}
					else
					{
						$("#editEventTitle").closest(".text-danger").remove();
						$("#editEventTitle").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}
					if(editEventDetail == "")
					{
						$("#editEventDetail").closest(".form-group").addClass("has-danger");
						$("#editEventDetail").after("<span class='text-danger'> Enter <b>Event Detail</b> </span>");
					}
					else
					{
						$("#editEventDetail").closest(".text-danger").remove();
						$("#editEventDetail").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}
					if(editEventStatus == "")
					{
						$("#editEventStatus").closest(".form-group").addClass("has-danger");
						$("#editEventStatus").after("<span class='text-danger'> Set <b>Event Status</b> </span>");
					}
					else
					{
						$("#editEventStatus").closest(".text-danger").remove();
						$("#editEventStatus").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}
					if(editEventDate == "")
					{
						$("#editEventDate").closest(".form-group").addClass("has-danger");
						$("#editEventDate").after("<span class='text-danger'> Enter <b>Event Date</b> </span>");
					}
					else
					{
						$("#editEventDate").closest(".text-danger").remove();
						$("#editEventDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
					}

					if(editEventTitle && editEventDetail && editEventStatus && editEventDate){

						$("#editEventTitle").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editEventDetail").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editEventStatus").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editEventDate").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$(".text-danger").remove();

						$("#editEventDetail").val(CKEDITOR.instances.editEventDetail.getData());
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
				               		$("#updateModal").modal('hide');
									$(".message").html("<div class='alert alert-success' role='alert'><i class='glyphicon glyphicon-ok-sign'></i> "+ result.message +"</div>");
									$('.alert-success').show(0).delay(2000).hide(0);
									form[0].reset();
									table.ajax.reload( null, false );
									$(".form-group").removeClass("has-error").removeClass("has-success text-success");		
				               }
				               else
				               {
				               		$(".messages").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> "+ result.message +"</div>");
									$('.alert-danger').show(0).delay(2000).hide(0);
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



function deleteEvent(event_id = null){
	if(event_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deleteevent.php",
			type:"post",
			data:{event_id: event_id},
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
