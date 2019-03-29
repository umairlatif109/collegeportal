<?php 
	include "../connection.php";

	global $con;
	$messages['data'] = array();

//////////////////////////////////
// teacher send msgs to student //
//////////////////////////////////

	if(isset($_POST['send_msg'])){
		$student_id = $_POST['student_id'];
		$teacher_id = $_POST['teacher_id'];
		$messages['data'][] = "S: ".$student_id." T: ".$teacher_id;

		$msg = mysqli_real_escape_string($con,$_POST['msg']);
		//from_send = 1 means that teacher send the msg...
		$query = "insert into student_teacher_chat_information(student_id,teacher_id,msg,from_send,unread) values ($student_id,$teacher_id,'$msg',1,1)";
		$result = mysqli_query($con,$query);
		if($result){
			$messages['data'][] = "saved";
		}
		else{
			$messages['data'][] = mysqli_error($con);
		}
	}

//////////////////////////////////
// student send msgs to teacher //
//////////////////////////////////

	if(isset($_POST['send_msg2'])){
		$student_id = $_POST['student_id'];
		$teacher_id = $_POST['teacher_id'];
		$messages['data'][] = "S: ".$student_id." T: ".$teacher_id;

		$msg = mysqli_real_escape_string($con,$_POST['msg']);
		//from_send = 0 means that student send the msg...
		$query = "insert into student_teacher_chat_information(student_id,teacher_id,msg,from_send,unread) values ($student_id,$teacher_id,'$msg',0,1)";
		$result = mysqli_query($con,$query);
		if($result){
			$messages['data'][] = "saved";
		}
		else{
			$messages['data'][] = mysqli_error($con);
		}
	}

////////////////////////////////
// teaher send msgs to parent //
////////////////////////////////

	if(isset($_POST['send_msgP'])){
		$parent_id = $_POST['parent_id'];
		$teacher_id = $_POST['teacher_id'];
		$messages['data'][] = "P: ".$parent_id." T: ".$teacher_id;

		$msg = mysqli_real_escape_string($con,$_POST['msg']);
		//from_send = 1 means that teacher send the msg...
		$query = "insert into parent_teacher_chat_information(parent_id,teacher_id,msg,send_from,unread) values ($parent_id,$teacher_id,'$msg',1,1)";
		$result = mysqli_query($con,$query);
		if($result){
			$messages['data'][] = "saved";
		}
		else{
			$messages['data'][] = mysqli_error($con);
		}
	}

////////////////////////////////
// parent send msgs to teacher //
////////////////////////////////

	if(isset($_POST['send_msgP2'])){
		$parent_id = $_POST['parent_id'];
		$teacher_id = $_POST['teacher_id'];
		$messages['data'][] = "P: ".$parent_id." T: ".$teacher_id;

		$msg = mysqli_real_escape_string($con,$_POST['msg']);
		//from_send = 1 means that teacher send the msg...
		$query = "insert into parent_teacher_chat_information(parent_id,teacher_id,msg,send_from,unread) values ($parent_id,$teacher_id,'$msg',0,1)";
		$result = mysqli_query($con,$query);
		if($result){
			$messages['data'][] = "saved";
		}
		else{
			$messages['data'][] = mysqli_error($con);
		}
	}

	echo json_encode($messages);

 ?>