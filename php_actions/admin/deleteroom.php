<?php 
	include "../connection.php";

	global $con;
	$valid = array("success" => false,"message" => array());
	$room_id = $_POST['room_id'];
	$query = "DELETE from room_information where room_id = $room_id";
	$result = mysqli_query($con,$query);

	if($room_id)
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