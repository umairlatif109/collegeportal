fileurl ="http://localhost/collegeportal/php_actions/";

$(".chat_head").click(function(){
	$(".chat_body").slideToggle(100);
});
$(".msg_head").click(function(){
	$(".msg_wrapper").toggle(10);
});
$(".close_chat").click(function(){
	$(".msg_box").hide();
});


function parent_teacher_chat(teacher_id = null, teacher_name = null,parent_id = null){

	$(".msg_body").empty();

	$(".msg_box").show();
	$(".msg_wrapper").show();

	$("#chatwith").val(teacher_id);
	$("#userName").text(teacher_name);
	t = $("#chatwith").val();
	if(t && parent_id){
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
						data:{parent_id:parent_id,teacher_id:t,msg:msg,send_msgP2:1},
						success:function(result){
							get_parent_teacher_chat(t,parent_id);
						}
					});
					$(this).val("");
				}
			}
		});

		get_parent_teacher_chat(t,parent_id);
	}
	$(".msg_body").scrollTop($(".msg_body")[0].scrollHeight);
}

function get_parent_teacher_chat(teacher_id = null,parent_id = null){
	if(parent_id!=null && teacher_id!=null){
		$.ajax({
			url:fileurl+"teacher/get_parent_teacher_chat.php",
			type:"post",
			data:{parent_id:parent_id, teacher_id:teacher_id, get_msgP2:1},
			dataType:"json",
			success:function(result){
				$(".msg_body").empty().html("<div class='msg_insert'></div>");
				for(i = 0; i < result.data.length; i++){
					$(".msg_insert").before(result.data[i]);
					$(".msg_body").scrollTop($(".msg_body")[0].scrollHeight);
				}
			}
		});
	}
}

setInterval(function(){
	if($('#chatwith').val()!='' && $("#chatfrom").val()!=''){
		get_parent_teacher_chat($('#chatwith').val(),$("#chatfrom").val());
		console.log("Getting T-> P");
	}
}, 1000);



setInterval(checkForUpdates, 1000);

function checkForUpdates() {
	
	lastTime = (new Date());
   $.ajax({
   		url:fileurl+"teacher/check_new_msg_from_teacher_to_parent.php",
   		type:"post",
		data:{lastTime:lastTime},   		
   		dataType:"json",
   		success:function(new_msg){
   			if(new_msg.success == true){

   				parent_teacher_new_msg_chat(new_msg.message.teacher_id, new_msg.message.teacher_name, new_msg.message.parent_id);
   				console.log(new_msg);
   			}
   		}
   });
}


function parent_teacher_new_msg_chat(t = null, teacher_name = null,parent_id = null){

	$(".msg_body").empty();

	$(".msg_box").show();
	$(".msg_wrapper").show();

	$("#chatwith").val(t);
	$("#userName").text(teacher_name);
	t = $("#chatwith").val();
	if(t && parent_id){
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
						data:{parent_id:parent_id,teacher_id:t,msg:msg,send_msgP2:1},
						success:function(result){
							get_parent_teacher_chat(t,parent_id);
						}
					});
					$(this).val("");
				}
			}
		});

		get_parent_teacher_chat(t,parent_id);
	}

}


$(".msg_box").mouseover(function(){
   $.ajax({
   		url:fileurl+"teacher/normal_msg.php",
   		type:"post",
		data:{teacher_id_for_parent:$("#chatwith").val()},
   		success:function(normal_msg){
   			console.log("normal_msg: "+normal_msg);
   		}
   });
});