<?php 
	include "../connection.php";

	global $con;
	$messages['data'] = array();
	$parent_id = $_POST['parent_id'];
	$teacher_id = $_POST['teacher_id'];

//////////////////////////////////////////
// getting msgs with respect to teacher //
//////////////////////////////////////////

	if (isset($_POST['get_msgP'])) {

		$query = "SELECT msg_id,parent_id,teacher_id,msg,date_format(date, '%M %d, %Y %h:%i:%s') as date,send_from from parent_teacher_chat_information where parent_id = $parent_id and teacher_id = $teacher_id";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0){
			while ($rowMsg = mysqli_fetch_assoc($result)) {
				if($rowMsg['send_from'] == 1){ // it means get the msgs send by the teacher
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

/////////////////////////////////////////
// getting msgs with respect to parent //
/////////////////////////////////////////

		if (isset($_POST['get_msgP2'])) {
		
		$query = "SELECT msg_id,parent_id,teacher_id,msg,msg,date_format(date, '%M %d, %Y %h:%i:%s') as date,send_from from parent_teacher_chat_information where parent_id = $parent_id and teacher_id = $teacher_id";
		$result = mysqli_query($con,$query);

		if($result && mysqli_num_rows($result) > 0){
			while ($rowMsg = mysqli_fetch_assoc($result)) {
				if($rowMsg['send_from'] == 1){ // it means get the msgs send by the teacher
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