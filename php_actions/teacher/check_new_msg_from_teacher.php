<?php 
	include "../connection.php";

	global $con;

	$date =  $_POST['lastTime'];

	$valid = array("success" => false, "message" => null);

	
	$query = "SELECT
				teacher_information.teacher_name,
				teacher_information.teacher_id,
				student_information.student_id
			from 
				teacher_information,
				student_information,
				student_teacher_chat_information
			where 
			teacher_information.teacher_id = student_teacher_chat_information.teacher_id
			and student_information.student_id = student_teacher_chat_information.student_id
			and student_teacher_chat_information.date > '$date' 
			and student_teacher_chat_information.from_send = 1
			and student_teacher_chat_information.unread = 1 
			order by msg_id desc limit 1";
		$result = mysqli_query($con,$query);
		if($result){
			if( mysqli_num_rows($result) > 0){
				$valid['success'] = true;
				while ($row = mysqli_fetch_assoc($result)) {
					$valid['message'] = $row;
				}
				
			}
			else{
				$valid['success'] = false;
				$valid['message'] = "no: ";
			}
			
		}
		else{
			$valid['success'] = true;
			$valid['message'] = mysqli_error($con);
		}

		echo json_encode($valid);
?>