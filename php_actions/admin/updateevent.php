<?php
	include "../connection.php";
	global $con;
	$valid = array('success' => false, 'message' => array());

	if($_POST){
		$event_id = $_POST['editEventId'];
		$event_title = $_POST['editEventTitle'];
		$event_detail = $_POST['editEventDetail'];
		$event_status = $_POST['editEventStatus'];
		$event_date = $_POST['editEventDate'];

		$query = "UPDATE event_information set event_title='$event_title', event_detail='$event_detail', event_status = '$event_status', event_date = STR_TO_DATE('$event_date','%m/%d/%Y') where event_id = $event_id";
		$result = mysqli_query($con,$query);

		if($result)
		{
			$valid['success'] = true;
			$valid['message'] = "Successfully Updated.";
		}
		else
		{
			$valid['success'] = false;
			$valid['message'] = "Failed To Save";
		}


		echo json_encode($valid);
	}
		

?> 