<?php 
	include "../connection.php";

	global $con;
	$messages['data'] = array();
	$student_id = $_POST['student_id'];
	$teacher_id = $_POST['teacher_id'];

//////////////////////////////////////////
// getting msgs with respect to teacher //
//////////////////////////////////////////

	if (isset($_POST['get_msgs'])) {

		$query = "SELECT msg_id,student_id,teacher_id,msg,msg,date_format(date, '%M %d, %Y %h:%i:%s') as date,from_send from student_teacher_chat_information where student_id = $student_id and teacher_id = $teacher_id";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0){
			while ($rowMsg = mysqli_fetch_assoc($result)) {
				if($rowMsg['from_send'] == 1){ // it means get the msgs send by the teacher
					$from = "<div class='msg_b'> {$rowMsg['msg']} <div class='date_time text-center'><b>{$rowMsg['date']}</b></div></div>";
					$messages['data'][] = $from;
				}
				else{
					$to = "<div class='msg_a'> {$rowMsg['msg']} <div class='date_time text-center'><b>{$rowMsg['date']}</b></div></div>";
					$messages['data'][] = $to;
				}

			}
		}
		else{
			$messages['data'][] = "<center>No Message</center>";
		}
	}

///////////////////////////////////////////
// getting msgs with respect to student  //
///////////////////////////////////////////

		if (isset($_POST['get_msgs2'])) {
		
		$query = "SELECT msg_id,student_id,teacher_id,msg,msg,date_format(date, '%M %d, %Y %h:%i:%s') as date,from_send from student_teacher_chat_information where student_id = $student_id and teacher_id = $teacher_id";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0){
			while ($rowMsg = mysqli_fetch_assoc($result)) {
				if($rowMsg['from_send'] == 1){ // it means get the msgs send by the teacher
					$from = "<div class='msg_a'> {$rowMsg['msg']} <div class='date_time text-center'><b>{$rowMsg['date']}</b></div></div>";
					$messages['data'][] = $from;
				}
				else{
					$to = "<div class='msg_b'> {$rowMsg['msg']} <div class='date_time text-center'><b>{$rowMsg['date']}</b></div></div>";
					$messages['data'][] = $to;
				}

			}
		}
		else{
			$messages['data'][] = "<center>No Message</center>";
		}
	}

	echo json_encode($messages);

?>