fileurl ="http://localhost/collegeportal/php_actions/";
table = $("#showAllRooms").DataTable({'ajax':fileurl+'admin/getallrooms.php'});
table.ajax.reload( null, false );

$("#saveClassRoom").submit(function(){

	roomNo = $("#roomNo").val();
	roomName = $("#roomName").val();

	$(".text-danger").remove();

	if(roomNo == "0"){
		$("#roomNo").closest(".form-group").addClass("has-danger");
		$("#roomNo").after("<span class='text-danger'>Enter <b>Room No</b></span>");
	}
	else{
		$("#roomNo").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$(".text-danger").remove();
	}

	if(roomName == ""){
		$("#roomName").closest(".form-group").addClass("has-danger");
		$("#roomName").after("<span class='text-danger'>Enter <b>Room Name</b></span>");
	}
	else{
		$("#roomName").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$(".text-danger").remove();
	}

	if(roomNo && roomName){
		$("#roomNo").closest(".form-group").removeClass("has-danger").addClass("has-success");
		$("#roomName").closest(".form-group").removeClass("has-danger").addClass("has-success");
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
               		$(".message").html("<div class='alert alert-danger' role='alert'><i class='glyphicon glyphicon-remove'></i> "+ result.message +"</div>");
					$('.alert-danger').show(0).delay(2000).hide(0);
               }
           }
       });
	}
	return false;
});

function editRoom(editRoomId = null){
	if(editRoomId){
		$.ajax({
			url:fileurl+"admin/singleroom.php",
			type:"post",
			data:{editRoomId:editRoomId},
			dataType:"json",
			success:function(result)
			{
				$("#editRoomId").val(result.room_id);
				$("#editRoomNo").val(result.room_no);
				$("#editRoomName").val(result.room_name);

				$("#updateForm").submit(function(){

					$(".text-danger").remove();
					room_no = $("#editRoomNo").val();
					room_name = $("#editRoomName").val();

					if(room_no == "" || room_no == "0")
					{
						$("#editRoomNo").closest(".form-group").addClass("has-danger");
						$("#editRoomNo").after("<span class='text-danger'>Enter <b>Room No</b></span>");
					}
					else
					{
						$("#editRoomNo").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$(".text-danger").remove();
					}
					if(room_name == "")
					{
						$("#editRoomName").closest(".form-group").addClass("has-danger");
						$("#editRoomName").after("<span class='text-danger'>Enter <b>Room Name</b></span>");
					}
					else
					{
						$("#editRoomName").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$(".text-danger").remove();
					}

					if(room_no && room_name){
						$("#editRoomNo").closest(".form-group").removeClass("has-danger").addClass("has-success");
						$("#editRoomName").closest(".form-group").removeClass("has-danger").addClass("has-success");
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


function deleteRoom(room_id = null){
	if(room_id)
	{
		$("#confirmDelete").click(function(){
			$.ajax({
			url:fileurl+"admin/deleteroom.php",
			type:"post",
			data:{room_id: room_id},
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