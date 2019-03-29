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
///////////////////////////////////
// Teacher Student chat function //
///////////////////////////////////

function student_teacher_chat(student_id = null, student_name = null,teacher_id = null){

	$(".msg_box").show();
	$(".msg_wrapper").show();
	$("#chatwith").val(student_id);
	$("#userName").text(student_name);

	s = $("#chatwith").val();

	if(s && teacher_id){
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
						data:{student_id:s,teacher_id:teacher_id,msg:msg,send_msg:1},
						success:function(result){
							get_chat(s,teacher_id);
						}
					});
					$(this).val("");
				}
			}
		});

		get_chat(s,teacher_id);
	}
	$(".msg_body").scrollTop($(".msg_body")[0].scrollHeight);
}

/////////////////////////////////////////////////////////////////////////////////////////////////
// setInterval (predefinded) function calls the get_chat() function to get chat after 1 second //
/////////////////////////////////////////////////////////////////////////////////////////////////
setInterval(function(){
	if($('#chatwith').val()!='' && $("#chatfrom").val()!=''){
		get_chat($('#chatwith').val(),$("#chatfrom").val());
		console.log("Getting T -> S");
	}
}, 1000);

function get_chat(student_id = null,teacher_id = null,parent=false){
	if(parent==false){
		$.ajax({
			url:fileurl+"teacher/get_student_teacher_chat.php",
			type:"post",
			data:{student_id:student_id, teacher_id:teacher_id, get_msgs:1},
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



setInterval(checkForUpdates, 1000);

function checkForUpdates() {
	
	lastTime = (new Date());
   $.ajax({
   		url:fileurl+"teacher/check_new_msg_from_student.php",
   		type:"post",
		data:{lastTime:lastTime},   		
   		dataType:"json",
   		success:function(new_msg){
   			if(new_msg.success == true){
   				student_teacher_new_msg_chat(new_msg.message.student_id, new_msg.message.student_name, new_msg.message.teacher_id);
   				console.log(new_msg);
   			}
   		}
   });
}


function student_teacher_new_msg_chat(s,s_name,teacher_id){


	$(".msg_box").show();
	$(".msg_wrapper").show();
	$("#chatwith").val(s);
	$("#userName").text(s_name);
	$("#chatfrom").val(teacher_id);


	if(s && teacher_id){
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
						data:{student_id:s,teacher_id:teacher_id,msg:msg,send_msg:1},
						success:function(result){
							get_chat(s,teacher_id);
						}
					});
					$(this).val("");
				}
			}
		});

		get_chat(s,teacher_id,false);
	}

}




$(".msg_box").mouseover(function(){
   $.ajax({
   		url:fileurl+"teacher/normal_msg.php",
   		type:"post",
		data:{student_id:$("#chatwith").val()},
   		success:function(normal_msg){
   			console.log("normal_msg: "+normal_msg);
   		}
   });
});