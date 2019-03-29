<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$event_id = $_POST['event_id'];
	$query = "DELETE from event_information where event_id = $event_id";
	$result = mysqli_query($con,$query);

	if($event_id)
	{
		if($result){
			$valid['success'] = true;
			$valid['message'] = "Deleted Successfully.";
		}
		else{
			$valid['success'] = false;
			$valid['message'] = "Failed To Delete"; 
		}

		echo json_encode($valid);
	}

 ?>