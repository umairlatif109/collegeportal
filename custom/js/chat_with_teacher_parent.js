fileurl ="http://localhost/collegeportal/php_actions/";

$(".chat").click(function(){
	$(".chat_body").slideToggle(100);
});
$(".msg_head").click(function(){
	$(".msg_wrapper").toggle(10);

});
$(".close_chat").click(function(){
	$(".msg_box").hide();
});


$("#chat_with_teacher_parent").change(function(){
	chat_with_teacher_parent_value = $("#chat_with_teacher_parent").val();

	if(chat_with_teacher_parent_value == 1){
		$("#chatForm").submit();
	}

	if(chat_with_teacher_parent_value == 2){
		$("#chatForm").submit();
	}
});


function parent_teacher_chat(parent_id = null, parent_name = null,teacher_id = null){

	$(".msg_body").empty();
	$(".msg_body").addClass("msg_body_teacher");
	$(".msg_body_teacher").removeClass("msg_body");

	$(".msg_box").show();
	$(".msg_wrapper").show();

	$("#chatwith").remove();
	$(".msg_head").append("<input type='hidden' name='chatwith' id='chatwithP' value="+parent_id+">");
	$("#userName").text(parent_name);

	p = $("#chatwithP").val();

	if(p && teacher_id){
		$("#chat_message").keypress(function(e){
			//////////////////////////////////////////
			// means that when Enter key is pressed //
			//////////////////////////////////////////
			if(e.keyCode == 13){ 
				msg = $(this).val();
				if(msg != ""){
					$.ajax({
						url:fileurl+"teacher/student_teacher_chat.php",
						type:"post",
						data:{parent_id:p,teacher_id:teacher_id,msg:msg,send_msgP:1},
						success:function(result){
							get_parent_teacher_chat(p,teacher_id);
						}
					});
					$(this).val("");
				}
			}
		});

		get_parent_teacher_chat(p,teacher_id);
	}
	$(".msg_body_teacher").scrollTop($(".msg_body_teacher")[0].scrollHeight);
}


function get_parent_teacher_chat(parent_id = null,teacher_id = null){
	if(parent_id!=null && teacher_id!=null){
		$.ajax({
			url:fileurl+"teacher/get_parent_teacher_chat.php",
			type:"post",
			data:{parent_id:parent_id, teacher_id:teacher_id, get_msgP:1},
			dataType:"json",
			success:function(result){
				$(".msg_body_teacher").empty().html("<div class='msg_insert'></div>");
				for(i = 0; i < result.data.length; i++){
					$(".msg_insert").before(result.data[i]);
					$(".msg_body_teacher").scrollTop($(".msg_body_teacher")[0].scrollHeight);
				}
			}
		});
	}
}

setInterval(function(){
	if($('#chatwithP').val()!='' && $("#chatfrom").val()!=''){
		get_parent_teacher_chat($('#chatwithP').val(),$("#chatfrom").val());
		console.log("Getting T-> P");
	}
}, 1000);


setInterval(checkForUpdates, 1000);

function checkForUpdates() {
	
	lastTime = (new Date());
   $.ajax({
   		url:fileurl+"teacher/check_new_msg_from_parent.php",
   		type:"post",
		data:{lastTime:lastTime},   		
   		dataType:"json",
   		success:function(new_msg){
   			if(new_msg.success == true){

   				parent_teacher_new_msg_chat(new_msg.message.parent_id, new_msg.message.parent_name, new_msg.message.teacher_id);
   				console.log(new_msg);
   			}
   		}
   });
}


function parent_teacher_new_msg_chat(p = null, parent_name = null,teacher_id = null){



$(".msg_body").empty();
	$(".msg_body").addClass("msg_body_teacher");
	$(".msg_body_teacher").removeClass("msg_body");

	$(".msg_box").show();
	$(".msg_wrapper").show();

	$("#chatwith").remove();
	$(".msg_head").append("<input type='hidden' name='chatwith' id='chatwithP' value="+p+">");
	$("#userName").text(parent_name);


	if(p && teacher_id){
		$("#chat_message").keypress(function(e){
			//////////////////////////////////////////
			// means that when Enter key is pressed //
			//////////////////////////////////////////
			if(e.keyCode == 13){ 
				msg = $(this).val();
				if(msg != ""){
					$.ajax({
						url:fileurl+"teacher/student_teacher_chat.php",
						type:"post",
						data:{parent_id:p,teacher_id:teacher_id,msg:msg,send_msgP:1},
						success:function(result){
							get_parent_teacher_chat(p,teacher_id);
						}
					});
					$(this).val("");
				}
			}
		});

		get_parent_teacher_chat(p,teacher_id);
	}



}

$(".msg_box").mouseover(function(){
   $.ajax({
   		url:fileurl+"teacher/normal_msg.php",
   		type:"post",
		data:{parent_id:$("#chatwithP").val()},
   		success:function(normal_msg){
   			console.log("normal_msg: "+normal_msg);
   		}
   });
});