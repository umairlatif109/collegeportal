<?php 
	include "../connection.php";

	global $con;

	$date =  $_POST['lastTime'];

	$valid = array("success" => false, "message" => null);

	
	$query = "SELECT
				parent_information.parent_name,
				parent_information.parent_id,
				teacher_information.teacher_id
			from 
				teacher_information,
				parent_information,
				parent_teacher_chat_information
			where 
			teacher_information.teacher_id = parent_teacher_chat_information.teacher_id
			and parent_information.parent_id = parent_teacher_chat_information.parent_id
			and parent_teacher_chat_information.date > '$date' 
			and parent_teacher_chat_information.send_from = 0
			and parent_teacher_chat_information.unread = 1 
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