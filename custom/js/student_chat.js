fileurl ="http://localhost/collegeportal/php_actions/";

$(".msg_body").scrollTop($(".msg_body")[0].scrollHeight);

$(".chat_head").click(function(){
	$(".chat_body").slideToggle(100);
});
$("#userName").click(function(){
	$(".msg_wrapper").toggle(10);
});
$(".close_chat").click(function(){
	$(".msg_box").hide();
});

//////////////
// Student  //
//////////////

function student_teacher_chat2(student_id = null,teacher_id = null, teacher_name = null){

	$(".msg_box").show();
	$(".msg_wrapper").show();
	$('#userName').text(teacher_name);
	$("#chatwith").val(teacher_id);

	t = $("#chatwith").val();

	if(t && student_id){
		$("#chat_message").keypress(function(e){
			if(e.keyCode == 13){
				msg = $(this).val();
				if(msg != ""){
					$.ajax({
						url:fileurl+"teacher/student_teacher_chat.php",
						type:"post",
						data:{student_id:student_id,teacher_id:t,msg:msg,send_msg2:1},
						success:function(result){
							get_chat2(student_id,t);
						}
					});
					$(this).val("");
				}
			}
		});

		get_chat2(student_id,t);
	}
	$(".msg_body").scrollTop($(".msg_body")[0].scrollHeight);
}


setInterval(function(){get_chat2($('#chatfrom').val(),$("#chatwith").val()); console.log("Getting")}, 3000);


function get_chat2(student_id = null,teacher_id = null){

	$.ajax({
			url:fileurl+"teacher/get_student_teacher_chat.php",
			type:"post",
			data:{student_id:student_id, teacher_id:teacher_id, get_msgs2:1},
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


///////////////////////////////////////////////////////////////////////
// this function will check for the new msg                          //
// if new msg comes from the student then tab msg tab will be opened //
///////////////////////////////////////////////////////////////////////

setInterval(checkForUpdates, 1000);

function checkForUpdates() {
	
	lastTime = (new Date());
   $.ajax({
   		url:fileurl+"teacher/check_new_msg_from_teacher.php",
   		type:"post",
		data:{lastTime:lastTime},   		
   		dataType:"json",
   		success:function(new_msg){
   			if(new_msg.success == true){
   				student_teacher_new_msg_chat(new_msg.message.student_id, new_msg.message.teacher_id, new_msg.message.teacher_name);
   				console.log(new_msg);
   			}
   		}
   });
}





function student_teacher_new_msg_chat(student_id, t, t_name){

	$(".msg_box").show();
	$(".msg_wrapper").show();
	$('#userName').text(t_name);
	$("#chatwith").val(t);
	$("#chatfrom").val(student_id);

		if(t && student_id){
		$("#chat_message").keypress(function(e){
			if(e.keyCode == 13){
				msg = $(this).val();
				if(msg != ""){
					$.ajax({
						url:fileurl+"teacher/student_teacher_chat.php",
						type:"post",
						data:{student_id:student_id,teacher_id:t,msg:msg,send_msg2:1},
						success:function(result){
							get_chat2(student_id,t);
						}
					});
					$(this).val("");
				}
			}
		});

		get_chat2(student_id,t);
	}
}

////////////////////////////////////////////////////////////////////////
// when new msg comes then it will a unread msg...                    //
// when teacher comes mouse to the msg tab then it will be readed msg //
////////////////////////////////////////////////////////////////////////

$(".msg_box").mouseover(function(){
   $.ajax({
   		url:fileurl+"teacher/normal_msg.php",
   		type:"post",
		data:{teacher_id:$("#chatwith").val()},
   		success:function(normal_msg){
   			console.log("normal_msg: "+normal_msg);
   		}
   });
});